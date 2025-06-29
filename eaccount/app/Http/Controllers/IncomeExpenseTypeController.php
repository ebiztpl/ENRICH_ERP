<?php

namespace App\Http\Controllers;

use App\Setting;
use App\IncomeExpenseType;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RoleManageController;

class IncomeExpenseTypeController extends Controller
{

    //    Important properties
    public $parentModel = IncomeExpenseType::class;
    public $parentRoute = 'income_expense_type';
    public $parentView = "admin.income-expense-type";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::orderBy('code', 'asc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { \Artisan::call('cache:clear');
        return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'name' => 'required|string|unique:income_expense_types',
            'code' => 'required|string|unique:income_expense_types',
        ]);
        $this->parentModel::create([
            'name' => $request->name,
            'code' => $request->code,
            'created_by' => auth()->user()->email,

        ]);
        Cache::forget('income_expense_types');
        Session::flash('success', "Successfully  Create");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    { \Artisan::call('cache:clear');
        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.show')->with('items', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::find($id);
        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.edit')->with('item', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { \Artisan::call('cache:clear');
        $request->validate([
            'name' => 'sometimes|string|unique:income_expense_types,name,' . $id,
            'code' => 'sometimes|string|unique:income_expense_types,code,' . $id,
        ]);
        $items = $this->parentModel::find($id);
        $items->name = $request->name;
        $items->code = $request->code;
        $items->updated_by = auth()->user()->email;
        $items->save();
        Session::flash('success', "Update Successfully");
        Cache::forget('income_expense_types');
        return redirect()->route($this->parentRoute);
    }

    public function pdf(Request $request)
    { \Artisan::call('cache:clear');
        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Ledger Type'
        );

        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item, 'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
        return $pdf->stream($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::find($id);
        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        if (count(IncomeExpenseType::find($id)->IncomeExpenseHeads) > 0) {  // Child has or not
            Session::flash('error', "You can not delete it.Because it has ledger items");
            return redirect()->back();
        }
        $items->delete_by = auth()->user()->email;
        $items->name = $items->id . '_' . $items->name;
        try {
            $items->save();
            $items->delete();
            Session::flash('success', "Successfully Trashed");
            Cache::forget('income_expense_types');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function trashed()
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed')->with("items", $items);
    }
    public function restore($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        Session::flash('success', 'Successfully Restore');
        Cache::forget('income_expense_types');
        return redirect()->back();
    }

    public function kill($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();
        if (count(IncomeExpenseType::withTrashed()->find($id)->IncomeExpenseHeads) > 0) {  // Child has or not
            Session::flash('error', "You can not delete it.Because it has ledger items");
            return redirect()->back();
        }
        try {
            $items->forceDelete();
            Cache::forget('income_expense_types');
            Session::flash('success', 'Permanently Delete');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
            ->paginate(60);
        return view($this->parentView . '.index')
            ->with('items', $items);
    }

    public function trashedSearch(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('code', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);

        return view($this->parentView . '.trashed')
            ->with('items', $items);
    }


    //    Fixed Method for all
    public function activeAction(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'items' => 'required'
        ]);
        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            Cache::forget('income_expense_types');
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }
            return redirect()->back();
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
            Cache::forget('income_expense_types');
            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
    }

    public function trashedAction(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'items' => 'required'
        ]);
        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {
            Cache::forget('income_expense_types');
            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
            Cache::forget('income_expense_types');
            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }
}
