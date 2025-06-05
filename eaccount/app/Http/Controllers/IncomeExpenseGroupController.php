<?php

namespace App\Http\Controllers;

use App\IncomeExpenseGroup;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class IncomeExpenseGroupController extends Controller
{

    //    Important properties
    public $parentModel = IncomeExpenseGroup::class;
    public $parentRoute = 'income_expense_group';
    public $parentView = "admin.income-expense-group";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_income_expense_groups') && Cache::get('total_income_expense_groups') != null) {
            $data['total_income_expense_groups'] = Cache::get('total_income_expense_groups');
        } else {
            $data['total_income_expense_groups'] = $this->parentModel::count();
            Cache::put('total_income_expense_groups', $data['total_income_expense_groups']);
        }
        if (Cache::get('total_trashed_income_expense_group') && Cache::get('total_trashed_income_expense_group') != null) {
            $data['total_trashed_income_expense_group'] = Cache::get('total_trashed_income_expense_group');
        } else {
            $data['total_trashed_income_expense_group'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_income_expense_group', $data['total_trashed_income_expense_group']);
        }
        $items = $this->parentModel::orderBy('id', 'DESC')->paginate(60);
        return view($this->parentView . '.index', $data)->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { \Artisan::call('cache:clear');
        $group = \DB::table('income_expense_types')->orderby('id','desc')->get();
        return view($this->parentView . '.create')->with('group',$group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Artisan::call('cache:clear');
        $request->validate([
            'type' => 'required',
            'name' => 'required|string|unique:income_expense_groups',
        ]);
        $this->parentModel::create([
            'name' => $request->name,
            'income_expense_type' => $request->type,
            'description' => $request->description,
            'created_by' => auth()->user()->email,
        ]);
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
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
        $group = \DB::table('income_expense_types')->orderby('id','desc')->get();
    
        $items = $this->parentModel::find($id);
        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.edit')->with('item', $items)->with('group',$group);
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
            'name' => 'sometimes|string|unique:income_expense_groups,name,' . $id,
             'type' => 'required'
        ]);
        $items = $this->parentModel::find($id);
        $items->name = $request->name;
        $items->description = $request->description;
        $items->income_expense_type = $request->type;
        $items->updated_by = auth()->user()->email;

        $items->save();
        Session::flash('success', "Update Successfully");
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
            'module_name' => 'Ledger Group'
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
        if (count($this->parentModel::find($id)->IncomeExpenseHeads) > 0) {  // Child has or not
            Session::flash('error', "You can not delete it.Because it has ledger items");
            return redirect()->back();
        }
        $items->deleted_by = auth()->user()->email;
        $items->name = $items->id . '_' . $items->name;
        try {
            $items->save();
            $items->delete();
            Cache::forget('total_income_expense_groups');
            Cache::forget('total_trashed_income_expense_group');
            Cache::forget('income_expense_groups');
            Session::flash('success', "Successfully Trashed");
        } catch (\Exception $e) {
            Session::flash('success', $e->getMessage());
        }
        return redirect()->back();
    }
    public function trashed()
    { \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_income_expense_groups') && Cache::get('total_income_expense_groups') != null) {
            $data['total_income_expense_groups'] = Cache::get('total_income_expense_groups');
        } else {
            $data['total_income_expense_groups'] = $this->parentModel::count();
            Cache::put('total_income_expense_groups', $data['total_income_expense_groups']);
        }
        if (Cache::get('total_trashed_income_expense_group') && Cache::get('total_trashed_income_expense_group') != null) {
            $data['total_trashed_income_expense_group'] = Cache::get('total_trashed_income_expense_group');
        } else {
            $data['total_trashed_income_expense_group'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_income_expense_group', $data['total_trashed_income_expense_group']);
        }
        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed', $data)->with("items", $items);
    }

    public function restore($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }
    public function kill($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();
        if (count($this->parentModel::withTrashed()->find($id)->IncomeExpenseHeads) > 0) {  // Child has or not
            Session::flash('error', "You can not delete it.Because it has ledger items");
            return redirect()->back();
        }
        $items->forceDelete();
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate(60);

        $data = [];
        if (Cache::get('total_income_expense_groups') && Cache::get('total_income_expense_groups') != null) {
            $data['total_income_expense_groups'] = Cache::get('total_income_expense_groups');
        } else {
            $data['total_income_expense_groups'] = $this->parentModel::count();
            Cache::put('total_income_expense_groups', $data['total_income_expense_groups']);
        }
        if (Cache::get('total_trashed_income_expense_group') && Cache::get('total_trashed_income_expense_group') != null) {
            $data['total_trashed_income_expense_group'] = Cache::get('total_trashed_income_expense_group');
        } else {
            $data['total_trashed_income_expense_group'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_income_expense_group', $data['total_trashed_income_expense_group']);
        }
        return view($this->parentView . '.index',  $data)
            ->with('items', $items);
    }

    public function trashedSearch(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $data = [];
        if (Cache::get('total_income_expense_groups') && Cache::get('total_income_expense_groups') != null) {
            $data['total_income_expense_groups'] = Cache::get('total_income_expense_groups');
        } else {
            $data['total_income_expense_groups'] = $this->parentModel::count();
            Cache::put('total_income_expense_groups', $data['total_income_expense_groups']);
        }
        if (Cache::get('total_trashed_income_expense_group') && Cache::get('total_trashed_income_expense_group') != null) {
            $data['total_trashed_income_expense_group'] = Cache::get('total_trashed_income_expense_group');
        } else {
            $data['total_trashed_income_expense_group'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_income_expense_group', $data['total_trashed_income_expense_group']);
        }
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('description', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);
        return view($this->parentView . '.trashed', $data)
            ->with('items', $items);
    }
    //    Fixed Method for all
    public function activeAction(Request $request)
    { \Artisan::call('cache:clear');
        $request->validate([
            'items' => 'required'
        ]);
        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }
            return redirect()->back();
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
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
            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
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

    public function savesubgroup(Request $request)
    {
        \Artisan::call('cache:clear');
      $ins =  array(
            'name' => $request->person,
             'relation_id' => $request->data,
        
            'created_by' => auth()->user()->email,
        );
        \DB::table('income_expense_subgroups')->insert($ins);
   
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
        Session::flash('success', "Successfully  Create");
        return redirect()->back();



    }
    public function editsubgroup(Request $request)
    {
        \Artisan::call('cache:clear');
      $ins =  array(
            'name' => $request->person,
        );
        \DB::table('income_expense_subgroups')->where('id',$request->data)->update($ins);
   
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
        Session::flash('success', "Successfully  Create");
        return redirect()->back();



    }

    
    
    public function subgroup_delete(Request $request)
    {
        \Artisan::call('cache:clear');
        $ins =  array(
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => auth()->user()->email,
        );
        \DB::table('income_expense_subgroups')->where('id',$request->data)->update($ins);
   
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
        Session::flash('success', "Successfully  Create");
        return redirect()->back();



    }
    
    public function savesubgroup0(Request $request)
    {
        \Artisan::call('cache:clear');
      $ins =  array(
            'name' => $request->person,
             'relation_id' => $request->data,
             'group_id' => 0,
            'created_by' => auth()->user()->email,
        );
        \DB::table('income_expense_subgroups')->insert($ins);
   
        Cache::forget('total_income_expense_groups');
        Cache::forget('total_trashed_income_expense_group');
        Cache::forget('income_expense_groups');
        Session::flash('success', "Successfully  Create");
        return redirect()->back();



    }
}
