<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class BranchController extends Controller
{

    //    Important properties
    public $parentModel = Branch::class;
    public $parentRoute = 'branch';
    public $parentView = "admin.branch";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_branches') && Cache::get('total_branches') != null) {
            $data['total_branches'] = Cache::get('total_branches');
        } else {
            $data['total_branches'] = $this->parentModel::count();
            Cache::put('total_branches', $data['total_branches']);
        }

        if (Cache::get('total_trashed_branches') && Cache::get('total_trashed_branches') != null) {
            $data['total_trashed_branches'] = Cache::get('total_trashed_branches');
        } else {
            $data['total_trashed_branches'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_branches', $data['total_trashed_branches']);
        }
        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60)->onEachSide(1);
        return view($this->parentView . '.index', $data)->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  \Artisan::call('cache:clear');
        return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  \Artisan::call('cache:clear');
        $request->validate([
            'name' => 'required|string|unique:branches',
        ]);
        try {
            $this->parentModel::create([
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
                'create_by' => auth()->user()->email,
            ]);
            Cache::forget('total_branches');
            Cache::forget('branches');
            Session::flash('success', "Successfully  Create");
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  \Artisan::call('cache:clear');
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
    {  \Artisan::call('cache:clear');
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
    {  \Artisan::call('cache:clear');
        $request->validate([
            'name' => 'sometimes|string|unique:branches,name,' . $id,
        ]);
        $items = $this->parentModel::find($id);
        $items->name = $request->name;
        $items->location = $request->location;
        $items->description = $request->description;
        $items->update_by = auth()->user()->email;

        $items->save();
        Cache::forget('branches');
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);
    }

    public function pdf(Request $request)
    {  \Artisan::call('cache:clear');
        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Branch Manage'
        );
        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item,  'extra' => $extra])->setPaper('a4', 'landscape');
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
    {  \Artisan::call('cache:clear');
        $items = $this->parentModel::find($id);
        if ($this->parentModel::find($id)->Transaction->count() > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Transaction");
            return redirect()->back();
        }
        $items->delete_by = auth()->user()->email;
        $items->name = $items->id . '_' . $items->name;
        try {
            $items->save();
            $items->delete();
            Cache::forget('total_trashed_branches');
            Cache::forget('total_branches');
            Cache::forget('branches');
            Session::flash('success', "Successfully Trashed");
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
    public function trashed()
    {  \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_branches') && Cache::get('total_branches') != null) {
            $data['total_branches'] = Cache::get('total_branches');
        } else {
            $data['total_branches'] = $this->parentModel::count();
            Cache::put('total_branches', $data['total_branches']);
        }

        if (Cache::get('total_trashed_branches') && Cache::get('total_trashed_branches') != null) {
            $data['total_trashed_branches'] = Cache::get('total_trashed_branches');
        } else {
            $data['total_trashed_branches'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_branches', $data['total_trashed_branches']);
        }
        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed', $data)->with("items", $items);
    }
    public function restore($id)
    {  \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        Cache::forget('total_trashed_branches');
        Cache::forget('total_branches');
        Cache::forget('branches');
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {  \Artisan::call('cache:clear');
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();
        if ($this->parentModel::withTrashed()->find($id)->Transaction->count() > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Transaction");
            return redirect()->back();
        }
        try {
            $items->forceDelete();
            Session::flash('success', 'Permanently Delete');
            Cache::forget('total_trashed_branches');
            Cache::forget('total_branches');
            Cache::forget('branches');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {  \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $data = [];
        if (Cache::get('total_branches') && Cache::get('total_branches') != null) {
            $data['total_branches'] = Cache::get('total_branches');
        } else {
            $data['total_branches'] = $this->parentModel::count();
            Cache::put('total_branches', $data['total_branches']);
        }

        if (Cache::get('total_trashed_branches') && Cache::get('total_trashed_branches') != null) {
            $data['total_trashed_branches'] = Cache::get('total_trashed_branches');
        } else {
            $data['total_trashed_branches'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_branches', $data['total_trashed_branches']);
        }
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate(60);
        return view($this->parentView . '.index', $data)
            ->with('items', $items);
    }

    public function trashedSearch(Request $request)
    {  \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $data = [];
        if (Cache::get('total_branches') && Cache::get('total_branches') != null) {
            $data['total_branches'] = Cache::get('total_branches');
        } else {
            $data['total_branches'] = $this->parentModel::count();
            Cache::put('total_branches', $data['total_branches']);
        }
        if (Cache::get('total_trashed_branches') && Cache::get('total_trashed_branches') != null) {
            $data['total_trashed_branches'] = Cache::get('total_trashed_branches');
        } else {
            $data['total_trashed_branches'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_branches', $data['total_trashed_branches']);
        }
        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('location', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('description', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);
        return view($this->parentView . '.trashed',  $data)
            ->with('items', $items);
    }

    //    Fixed Method for all
    public function activeAction(Request $request)
    {  \Artisan::call('cache:clear');
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
    {  \Artisan::call('cache:clear');
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
}
