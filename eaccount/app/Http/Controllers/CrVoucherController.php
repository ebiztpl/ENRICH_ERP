<?php

namespace App\Http\Controllers;

use App\BankCash;
use App\Branch;
use App\Transaction;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\IncomeExpenseHead;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CrVoucherController extends Controller
{

    //    Important properties
    public $parentModel = Transaction::class;
    public $parentRoute = 'cr_voucher';
    public $parentView = "admin.cr-voucher";

    public $voucher_type = "CV";

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



        $data = [];
        if (Cache::get('count_trashed_cv') && Cache::get('count_trashed_cv') != null) {
            $data['count_trashed_cv'] = Cache::get('count_trashed_cv');
        } else {
            $data['count_trashed_cv'] = $this->parentModel::onlyTrashed()->where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)->count();
            Cache::put('count_trashed_cv', $data['count_trashed_cv']);
        }
       

            if($branch_id == 1){
                $items = $this->parentModel::where('voucher_type', $this->voucher_type)
                ->with('Branch', 'IncomeExpenseHead', 'BankCash')
                ->orderBy('voucher_no', 'desc')
                ->paginate(60);
            }else{
                $items = $this->parentModel::where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)
                ->with('Branch', 'IncomeExpenseHead', 'BankCash')
                ->orderBy('voucher_no', 'desc')
                ->paginate(60);
            }



        return view($this->parentView . '.index', $data)->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        \Artisan::call('cache:clear');
        return view($this->parentView . '.create', $this->__getBranchBankCashIncomeExpenseHead());
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
            'branch_id' => 'required',
            'bank_cash_id' => 'required',
            'voucher_date' => 'required',
        ]);
        $date = new \DateTime($request->voucher_date);
        $voucher_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'
        $voucher_info = $this->parentModel::where('voucher_type', $this->voucher_type)
            ->withTrashed()
            ->orderBy('voucher_no', 'DESC')
            ->get()
            ->first();
      //  if (!empty($voucher_info)) {
      //      $voucher_no = $voucher_info->voucher_no + 1;
      //  } else {
      //      $voucher_no = 1;
     //   }
	 $digits = 5;
     
	  $voucher_no = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        foreach ($request->income_expense_head_id as $key => $id) {
            if ($id == 0) {
                continue;
            }
            $chq_no = null;
            if ($key == 0) {
                $chq_no = $request->cheque_number;
            }
            $this->parentModel::create([
                'voucher_no' => $voucher_no,
                'branch_id' => $request->branch_id,
                'bank_cash_id' => $request->bank_cash_id,
                'cheque_number' => $chq_no,
                'voucher_type' => $this->voucher_type,
                'voucher_date' => $voucher_date,
                'particulars' => $request->particulars,
                'income_expense_head_id' => $id,
                'cr' => $request->amount[$key],
                'created_by' => auth()->user()->email,
            ]);
        }

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
    {  \Artisan::call('cache:clear');

        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
      


        //$item = $this->parentModel::find($request->id);
        $id = $request->id;

        if($branch_id == 1){
            $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();
        }else{
            $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })->where('branch_id',$branch_id)
            ->get();

        }


      
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
    {
        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;

        if($branch_id == 1){

            $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();
        }else{

            $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)->where('branch_id',$branch_id)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();

        }


        if (count($items) <= 0) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
 
       if($branch_id == 1){
        $data['branches'] = Branch::all();
        $data['bank_cashes'] = BankCash::all();
        $data['income_expense_heads'] = IncomeExpenseHead::all();
       }else{
        $data['branches'] = Branch::where('id',$branch_id)->where('deleted_at',Null)->get();
        $data['bank_cashes'] = BankCash::all();
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

        $data['income_expense_heads'] = IncomeExpenseHead::whereIn('id',$checkaray)->where('deleted_at',Null)->get();
       }



       
        foreach ($items as $item) {
            if (($item->cr) > 0) {
                $item['amount'] = $item->cr;
            } else {
                $item['amount'] = $item->dr;
            }
        }
        return view($this->parentView . '.edit', $data)->with('item', $items);
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
            'branch_id' => 'required',
            'bank_cash_id' => 'required',
            'voucher_date' => 'required',
        ]);
        $date = new \DateTime($request->voucher_date);
        $voucher_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'
        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();
        $created_by = $items[0]->created_by;
        $this->kill($id); /// Old Item kill then new items created
        foreach ($request->income_expense_head_id as $key => $income_expense_head_id) {
            if ($income_expense_head_id == 0) {
                continue;
            }
            $chq_no = null;
            if ($key == 0) {
                $chq_no = $request->cheque_number;
            }
            $this->parentModel::create([
                'voucher_no' => $id,
                'branch_id' => $request->branch_id,
                'bank_cash_id' => $request->bank_cash_id,
                'cheque_number' => $chq_no,
                'voucher_type' => $this->voucher_type,
                'voucher_date' => $voucher_date,
                'particulars' => $request->particulars,
                'income_expense_head_id' => $income_expense_head_id,
                'cr' => $request->amount[$key],
                'created_by' => $created_by,
                'updated_by' => auth()->user()->email,
            ]);
        }
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);
    }

    public function pdf(Request $request)
    {  \Artisan::call('cache:clear');
        $id = $request->id;


        $activ = Session::get('branch_array');
        $branch_id =$activ->id;

        if($branch_id == 1){
            $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();
        }else{
            $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)->where('branch_id',$branch_id)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();


        }

      
        if (count($item) == 0) {
            Session::flash('error', "Item not found");
            return redirect()->route($this->parentRoute);
        }

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Credit Voucher Report',
            'voucher_type' => 'CREDIT VOUCHER'
        );
        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item,  'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
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
        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->get();
        if (count($items) < 1) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        foreach ($items as $item) {
            $item->deleted_by = auth()->user()->email;
            $item->save();
        }
        foreach ($items as $item) {
            $item->delete();
            Cache::forget('count_trashed_cv');
        }
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }

    public function trashed()
    {  \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $data = [];
        if (Cache::get('count_cv') && Cache::get('count_cv') != null) {
            $data['count_cv'] = Cache::get('count_cv');
        } else {
            $data['count_cv'] = $this->parentModel::where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)->count();
            Cache::put('count_cv', $data['count_cv']);
        }

 

if($branch_id == 1){
    $items = $this->parentModel::onlyTrashed()
    ->where('voucher_type', $this->voucher_type)
    ->with('Branch', 'IncomeExpenseHead', 'BankCash')
    ->orderBy('deleted_at', 'desc')
    ->paginate(60);

}else{
    $items = $this->parentModel::onlyTrashed()
    ->where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)
    ->with('Branch', 'IncomeExpenseHead', 'BankCash')
    ->orderBy('deleted_at', 'desc')
    ->paginate(60);
}
       


        return view($this->parentView . '.trashed', $data)
            ->with("items", $items);
    }


    public function restore($id)
    {  \Artisan::call('cache:clear');
        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->onlyTrashed()
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->onlyTrashed()
            ->get();

        foreach ($items as $item) {
            $item->restore();
            $item->updated_by = auth()->user()->email;
            $item->save();
        }

        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {  \Artisan::call('cache:clear');
        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->withTrashed()
            ->where(function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->withTrashed()
            ->get();

        foreach ($items as $item) {
            $item->forceDelete();
        }
        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {


        \Artisan::call('cache:clear');
$activ = Session::get('branch_array');
$branch_id =$activ->id;


        $data = [];
        if (Cache::get('count_trashed_cv') && Cache::get('count_trashed_cv') != null) {
            $data['count_trashed_cv'] = Cache::get('count_trashed_cv');
        } else {
            $data['count_trashed_cv'] = $this->parentModel::onlyTrashed()->where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)->count();
            Cache::put('count_trashed_cv', $data['count_trashed_cv']);
        }




        \Artisan::call('cache:clear');

        $activ = Session::get('branch_array');
        $branch_id =$activ->id;



        $search = $request["search"];


if($branch_id == 1){
    $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
    ->where(function ($q) use ($search) {
        $q->where('voucher_no', '=', $search)
            ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
            ->orWhere('dr', '=', $search)
            ->orWhere('cheque_number', '=', $search)
            ->orWhere('cr', '=', $search)
            ->orWhere('particulars', 'like', '%' . $search . '%')
            ->orWhereHas('BankCash', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('IncomeExpenseHead', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('Branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    })
    ->paginate(60);
}else{
    $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)->where('branch_id',$branch_id)
    ->where(function ($q) use ($search) {
        $q->where('voucher_no', '=', $search)
            ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
            ->orWhere('dr', '=', $search)
            ->orWhere('cheque_number', '=', $search)
            ->orWhere('cr', '=', $search)
            ->orWhere('particulars', 'like', '%' . $search . '%')
            ->orWhereHas('BankCash', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('IncomeExpenseHead', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('Branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    })
    ->paginate(60);
}


        return view($this->parentView . '.index', $data)
            ->with('items', $items);
    }

    public function trashedSearch(Request $request)
    {  \Artisan::call('cache:clear');
        $search = $request["search"];

        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $data = [];
        if (Cache::get('count_cv') && Cache::get('count_cv') != null) {
            $data['count_cv'] = Cache::get('count_cv');
        } else {
            $data['count_cv'] = $this->parentModel::where('voucher_type', $this->voucher_type)->where('branch_id',$branch_id)->count();
            Cache::put('count_cv', $data['count_cv']);
        }



        if($branch_id == 1){

            $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->onlyTrashed()
            ->where(function ($q) use ($search) {
                $q->where('voucher_no', '=', $search)
                    ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
                    ->orWhere('dr', '=', $search)
                    ->orWhere('cheque_number', '=', $search)
                    ->orWhere('cr', '=', $search)
                    ->orWhere('particulars', 'like', '%' . $search . '%')
                    ->orWhereHas('BankCash', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('IncomeExpenseHead', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('Branch', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(60);
        }else{
            $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)->where('branch_id',$branch_id)
            ->onlyTrashed()
            ->where(function ($q) use ($search) {
                $q->where('voucher_no', '=', $search)
                    ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
                    ->orWhere('dr', '=', $search)
                    ->orWhere('cheque_number', '=', $search)
                    ->orWhere('cr', '=', $search)
                    ->orWhere('particulars', 'like', '%' . $search . '%')
                    ->orWhereHas('BankCash', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('IncomeExpenseHead', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('Branch', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(60);
        
        }
        
      

        return view($this->parentView . '.trashed',$data)
            ->with('items', $items);
    }


    //    Fixed Method for all
    public function activeAction(Request $request)
    {
        \Artisan::call('cache:clear');
        $request->validate([
            'items' => 'required'
        ]);
     
        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
              
                $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
                    ->where(function ($q) use ($id) {
                        $q->where('id', '=', $id);
                    })
                    ->get();
                if (count($items) < 1) {
                    continue;
                }
                $this->destroy($id);
            }

            return redirect()->back();
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {

                $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
                    ->withTrashed()
                    ->where(function ($q) use ($id) {
                        $q->where('id', '=', $id);
                    })
                    ->withTrashed()
                    ->get();
                if (count($items) < 1) {
                    continue;
                }
                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
    }

    public function trashedAction(Request $request)
    {
        \Artisan::call('cache:clear');
        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {
            foreach ($request->items["id"] as $id) {
                $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
                    ->onlyTrashed()
                    ->where(function ($q) use ($id) {
                        $q->where('id', '=', $id);
                    })
                    ->onlyTrashed()
                    ->get();
                if (count($items) < 1) {
                    continue;
                }
                $this->restore($id);
            }
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {
                $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
                    ->onlyTrashed()
                    ->where(function ($q) use ($id) {
                        $q->where('id', '=', $id);
                    })
                    ->onlyTrashed()
                    ->get();
                if (count($items) < 1) {
                    continue;
                }

                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }

    /**
     * This function 
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       08/15/2022
     * Time         16:43:25
     * @param       
     * @return      
     */
    public function __getBranchBankCashIncomeExpenseHead()
    {

        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;


        # code... 
        $data = [];
        if (Cache::get('branches') && Cache::get('branches') != null) {
            $data['branches'] = Cache::get('branches');
        } else {
            if($branch_id == 1){
                $data['branches'] = Branch::all();
            }else{
                $data['branches'] = Branch::where('id',$branch_id)->where('deleted_at',Null)->get();
            }
          
            Cache::put('branches', $data['branches']);
        }
        if (Cache::get('bank_cashes') && Cache::get('bank_cashes') != null) {
            $branch_array = \DB::table('bank_cash_branches')->where('branch_id',$branch_id)->pluck('bank_cash')->toArray();
            $data['bank_cashes'] = BankCash::whereIn('id',$branch_array)->orderBy('created_at', 'desc')->get();
        } else {
            $branch_array = \DB::table('bank_cash_branches')->where('branch_id',$branch_id)->pluck('bank_cash')->toArray();
            $data['bank_cashes'] = BankCash::whereIn('id',$branch_array)->orderBy('created_at', 'desc')->get();
            Cache::put('bank_cashes', $data['bank_cashes']);
        }
        if (Cache::get('income_expense_heads') && Cache::get('income_expense_heads') != null) {
            $data['income_expense_heads'] = Cache::get('income_expense_heads');
        } else {

            if($branch_id == 1){
                $data['income_expense_heads'] = IncomeExpenseHead::all();
                Cache::put('income_expense_heads', $data['income_expense_heads']);
            }else{

                $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

                
                $data['income_expense_heads'] = IncomeExpenseHead::whereIn('id',$checkaray)->where('deleted_at',Null)->get();
                Cache::put('income_expense_heads', $data['income_expense_heads']);
            }

          
        }

      
        return $data;


    }
    #end

}
