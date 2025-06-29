<?php

namespace App\Http\Controllers;

use App\IncomeExpenseGroup;
use App\IncomeExpenseHead;
use App\IncomeExpenseType;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class IncomeExpenseHeadController extends Controller
{
    //    Important properties
    public $parentModel = IncomeExpenseHead::class;
    public $parentRoute = 'income_expense_head';
    public $parentView = "admin.income-expense-head";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

        $data = [];
        if (Cache::get('total_trashed_income_expense_heads') && Cache::get('total_trashed_income_expense_heads') != null) {
            $data['total_trashed_income_expense_heads'] = Cache::get('total_trashed_income_expense_heads');
        } else {
            $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->whereIn('id',$checkaray)->count();
            Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
        }
        if($branch_id == 1){
            $items = $this->parentModel::orderBy('created_at', 'desc')->with('IncomeExpenseType', 'IncomeExpenseGroup')->paginate(60);

        }else{

            $items = $this->parentModel::whereIn('id',$checkaray)->orderBy('created_at', 'desc')->with('IncomeExpenseType', 'IncomeExpenseGroup')->paginate(60);

        }
        return view($this->parentView . '.index', $data)->with('items', $items);
    }
    /**
     * This function return group & type data
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       08/12/2022
     * Time         22:44:35
     * @param       
     * @return      $data
     */
    public function __get_cache_data()
    { \Artisan::call('cache:clear');
        # code...   
        $data = [];
        if (Cache::get('income_expense_groups') && Cache::get('income_expense_groups') != null) {
            $data['income_expense_groups'] = Cache::get('income_expense_groups');
        } else {
            $data['income_expense_groups'] = IncomeExpenseGroup::all();
            Cache::put('income_expense_groups', $data['income_expense_groups']);
        }
        if (Cache::get('income_expense_types') && Cache::get('income_expense_types') != null) {
            $data['income_expense_types'] = Cache::get('income_expense_types');
        } else {
            $data['income_expense_types'] = IncomeExpenseType::all();
            Cache::put('income_expense_types', $data['income_expense_types']);
        }
        return $data;
    }
    #end

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { \Artisan::call('cache:clear');
        return view($this->parentView . '.create', $this->__get_cache_data());
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
            'name' => 'required|string|unique:income_expense_heads',
            'income_expense_type_id' => 'required|numeric|min:1',
            'income_expense_group_id' => 'required|numeric|min:1',
        ]);
      $return =  $this->parentModel::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'income_expense_type_id' => $request->income_expense_type_id,
            'income_expense_group_id' => $request->income_expense_group_id,
            'type' => $request->type,
            'created_by' => auth()->user()->email,
        ])->id;

        // echo $return;die;
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        if($branch_id != 1){
            \DB::table('ledger_branch')->insert(array('branch_id'=>$branch_id ,'ledger_id'=>$return ));
        }

        Cache::forget('income_expense_heads');
        Cache::forget('total_income_expense_heads');
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
        return view($this->parentView . '.edit', $this->__get_cache_data())->with('item', $items);
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
            'name' => 'sometimes|string|unique:income_expense_heads,name,' . $id,
            'income_expense_type_id' => 'required|numeric|min:1',
            'income_expense_group_id' => 'required|numeric|min:1',
        ]);
        $items = $this->parentModel::find($id);
        $items->name = $request->name;
        $items->unit = $request->unit;
        $items->income_expense_type_id = $request->income_expense_type_id;
        $items->income_expense_group_id = $request->income_expense_group_id;
        $items->type = $request->type;
        $items->updated_by = auth()->user()->email;
        $items->save();
        Cache::forget('income_expense_heads');
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
            'module_name' => 'Ledger Name'
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
        if (count($this->parentModel::find($id)->Transaction) > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Transaction");
            return redirect()->back();
        }
        try {
            $items->deleted_by = auth()->user()->email;
            $items->name = $items->id . '_' . $items->name;
            $items->save();
            $items->delete();
            Cache::forget('income_expense_heads');
            Session::flash('success', "Successfully Trashed");
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
    public function trashed()
    {

        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();


        $data = [];
        if (Cache::get('total_income_expense_heads') && Cache::get('total_income_expense_heads') != null) {
            $data['total_income_expense_heads'] = Cache::get('total_income_expense_heads');
        } else {
            if($branch_id == 1){

                $data['total_income_expense_heads'] = $this->parentModel::count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);
            }else{

                $data['total_income_expense_heads'] = $this->parentModel::whereIn('id',$checkaray)->count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);
            }
       
        }
        if($branch_id == 1){
            $items = $this->parentModel::onlyTrashed()->with('IncomeExpenseType', 'IncomeExpenseGroup')->paginate(60);

        }else{
            $items = $this->parentModel::onlyTrashed()->with('IncomeExpenseType', 'IncomeExpenseGroup')->whereIn('id',$checkaray)->paginate(60);

        }
        return view($this->parentView . '.trashed', $data)->with("items", $items);
    }

    public function restore($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        $items->updated_by = auth()->user()->email;
        $items->save();
        Cache::forget('total_income_expense_heads');
        Cache::forget('total_trashed_income_expense_heads');
        Cache::forget('income_expense_heads');
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }
    public function kill($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();
        if (count($this->parentModel::withTrashed()->find($id)->Transaction) > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Transaction");
            return redirect()->back();
        }
        try {
            Cache::forget('total_income_expense_heads');
            Cache::forget('total_trashed_income_expense_heads');
            $items->forceDelete();
            Cache::forget('income_expense_heads');
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


        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

        $data = [];
        if (Cache::get('total_income_expense_heads') && Cache::get('total_income_expense_heads') != null) {
            $data['total_income_expense_heads'] = Cache::get('total_income_expense_heads');
        } else {
            if($branch_id == 1){
                $data['total_income_expense_heads'] = $this->parentModel::count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);
            }else{
                $data['total_income_expense_heads'] = $this->parentModel::whereIn('id',$checkaray)->count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);
            }
           
        }
        if (Cache::get('total_trashed_income_expense_heads') && Cache::get('total_trashed_income_expense_heads') != null) {
            $data['total_trashed_income_expense_heads'] = Cache::get('total_trashed_income_expense_heads');
        } else {
            if($branch_id == 1){
                $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->count();
                Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
            }else{
                $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->whereIn('id',$checkaray)->count();
                Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
            }
          
        }
        $search = $request["search"];
        if($branch_id == 1){

            $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhereHas('IncomeExpenseType', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('IncomeExpenseGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('unit', 'like', '%' . $search . '%')
            ->with('IncomeExpenseType', 'IncomeExpenseGroup')
            ->paginate(60);
        }else{
            $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhereHas('IncomeExpenseType', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('IncomeExpenseGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('unit', 'like', '%' . $search . '%')
            ->with('IncomeExpenseType', 'IncomeExpenseGroup')->whereIn('id',$checkaray)
            ->paginate(60);
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


        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();


        if (Cache::get('total_income_expense_heads') && Cache::get('total_income_expense_heads') != null) {
            $data['total_income_expense_heads'] = Cache::get('total_income_expense_heads');
        } else {
            if($branch_id == 1){
                $data['total_income_expense_heads'] = $this->parentModel::count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);
            }else{
                $data['total_income_expense_heads'] = $this->parentModel::whereIn('id',$checkaray)->count();
                Cache::put('total_income_expense_heads', $data['total_income_expense_heads']);

            }
        
        }
        if (Cache::get('total_trashed_income_expense_heads') && Cache::get('total_trashed_income_expense_heads') != null) {
            $data['total_trashed_income_expense_heads'] = Cache::get('total_trashed_income_expense_heads');
        } else {
            if($branch_id == 1){
                $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->count();
                Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
            }else{
                $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->whereIn('id',$checkaray)->count();
                Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
            }
           
        }
        $search = $request["search"];
        if($branch_id == 1){
            $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhereHas('IncomeExpenseType', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhereHas('IncomeExpenseGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('unit', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->with('IncomeExpenseType', 'IncomeExpenseGroup')
            ->paginate(60);
        }else{
            $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhereHas('IncomeExpenseType', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhereHas('IncomeExpenseGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('unit', 'like', '%' . $search . '%')
            ->onlyTrashed()->whereIn('id',$checkaray)
            ->with('IncomeExpenseType', 'IncomeExpenseGroup')
            ->paginate(60);
        }
    
        return view($this->parentView . '.trashed',  $data)
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




    public function linking()
    { \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_trashed_income_expense_heads') && Cache::get('total_trashed_income_expense_heads') != null) {
            $data['total_trashed_income_expense_heads'] = Cache::get('total_trashed_income_expense_heads');
        } else {
            $data['total_trashed_income_expense_heads'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_income_expense_heads', $data['total_trashed_income_expense_heads']);
        }
        $items = $this->parentModel::orderBy('created_at', 'desc')->with('IncomeExpenseType', 'IncomeExpenseGroup')->paginate(60);
        $branches = \DB::table('branches')->where('deleted_at',Null)->get(); 
        return view($this->parentView . '.linking', $data)->with("items", $items)->with("branches",$branches);
    }


    
    public function savelinking(Request $request)
    {
        \Artisan::call('cache:clear');
$branch_id = $request->branch_id;
$ledger_id = $request->ledger_id;
$data_recordid = $request->data_recordid;
if($data_recordid == 0){
    if(\DB::table('ledger_branch')->where('ledger_id',$ledger_id)->where('branch_id',$branch_id)->count() > 0){
        echo 1;
    }else{
        \DB::table('ledger_branch')->insert(array('ledger_id'=>$ledger_id,'branch_id'=>$branch_id));
        echo 1;
    }
}else{
    \DB::table('ledger_branch')->where('ledger_id',$ledger_id)->where('branch_id',$branch_id)->delete();
    echo 0;
}

    }

}