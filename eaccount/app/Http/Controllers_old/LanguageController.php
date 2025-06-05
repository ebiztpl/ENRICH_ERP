<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //    Important properties
    public $parentModel = Language::class;
    public $parentRoute = 'language';
    public $parentView = "admin.language";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_language') && Cache::get('total_language') != null) {
            $data['total_language'] = Cache::get('total_language');
        } else {
            $data['total_language'] = $this->parentModel::count();
            Cache::put('total_language', $data['total_language']);
        }

        if (Cache::get('total_trashed_language') && Cache::get('total_trashed_language') != null) {
            $data['total_trashed_language'] = Cache::get('total_trashed_language');
        } else {
            $data['total_trashed_language'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_language', $data['total_trashed_language']);
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
            'name' => 'required|string|unique:languages',
            'code' => 'required|alpha_dash|string|unique:languages',
            'country_name' => 'required|string'
        ]);
        $name = strtolower($request->name);
        $code = strtolower($request->code);
        if ($code == 'main') {
            Session::flash('error', 'Main is not an language name. Try another one');
            return redirect()->back();
        }
        $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
        $languages_path = $language_dir . DIRECTORY_SEPARATOR . $code;
        DB::beginTransaction();
        try {
            // copy main folder and past it on language folder
            $copy_dir = $language_dir . DIRECTORY_SEPARATOR . 'main';
            File::copyDirectory($copy_dir, $languages_path);
            $this->parentModel::create([
                'name' => $name,
                'code' => $code,
                'country_name' => $request->country_name,
                'create_by' => auth()->user()->email,
            ]);
            Cache::forget('total_language');
            Cache::forget('languages');
            Session::flash('success', "Successfully  Create");
            DB::commit();
        } catch (\Exception $e) {
            if (File::isDirectory($languages_path)) {
                File::deleteDirectory($languages_path);
            }
            Session::flash('error', $e->getMessage());
            DB::rollback();
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
            'name' => 'sometimes|string|unique:languages,name,' . $id,
            'code' => 'required|string|alpha_dash|unique:languages,code,' . $id,
            'country_name' => 'required|string'
        ]);

        $name = strtolower($request->name);
        $code = strtolower($request->code);
        if ($code == 'main') {
            Session::flash('error', 'Main is not an language name. Try another one');
            return redirect()->back();
        }
        $items = $this->parentModel::find($id);
        $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
        $new_path = $language_dir . DIRECTORY_SEPARATOR . $code;
        $old_path = $language_dir . DIRECTORY_SEPARATOR . $items->code;

        DB::beginTransaction();
        try {
            if ($old_path != $new_path) {
                rename($old_path, $new_path);
            }
            $items->name = $name;
            $items->code = $code;
            $items->country_name = $request->country_name;
            $items->update_by = auth()->user()->email;
            $items->save();
            Cache::forget('languages');
            Session::flash('success', "Update Successfully");
            DB::commit();
        } catch (\Exception $e) {
            if (File::isDirectory($new_path)) {
                rename($new_path, $old_path);
            }
            Session::flash('error', $e->getMessage());
            DB::rollBack();
        }
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
            'module_name' => 'Langeuage Manage'
        );
        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item,  'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
        return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
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
        $items->delete_by = auth()->user()->email;
        $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
        $old_path = $language_dir . DIRECTORY_SEPARATOR . $items->code;

        $items->code = $items->id . '_' . $items->code;
        $new_path = $language_dir . DIRECTORY_SEPARATOR . $items->code;

        try {
            rename($old_path, $new_path);
            $items->save();
            $items->delete();
            Cache::forget('total_trashed_language');
            Cache::forget('total_language');
            Cache::forget('languages');
            Session::flash('success', "Successfully Trashed");
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
    public function trashed()
    { \Artisan::call('cache:clear');
        $data = [];
        if (Cache::get('total_language') && Cache::get('total_language') != null) {
            $data['total_language'] = Cache::get('total_language');
        } else {
            $data['total_language'] = $this->parentModel::count();
            Cache::put('total_language', $data['total_language']);
        }

        if (Cache::get('total_trashed_language') && Cache::get('total_trashed_language') != null) {
            $data['total_trashed_language'] = Cache::get('total_trashed_language');
        } else {
            $data['total_trashed_language'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_language', $data['total_trashed_language']);
        }
        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed', $data)->with("items", $items);
    }
    public function restore($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        try {
            $items->restore();
            Cache::forget('total_trashed_language');
            Cache::forget('total_language');
            Cache::forget('languages');
            Session::flash('success', 'Successfully Restore');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function kill($id)
    { \Artisan::call('cache:clear');
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();
        try {
            if ($items->code != 'main') {
                $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
                $languages_path = $language_dir . DIRECTORY_SEPARATOR . $items->code;
                if ($items->forceDelete()) {
                    if (File::isDirectory($languages_path)) {
                        File::deleteDirectory($languages_path);
                    }
                }
            }
            Session::flash('success', 'Permanently Delete');
            Cache::forget('total_trashed_language');
            Cache::forget('total_language');
            Cache::forget('languages');
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
        $data = [];
        if (Cache::get('total_language') && Cache::get('total_language') != null) {
            $data['total_language'] = Cache::get('total_language');
        } else {
            $data['total_language'] = $this->parentModel::count();
            Cache::put('total_language', $data['total_language']);
        }

        if (Cache::get('total_trashed_language') && Cache::get('total_trashed_language') != null) {
            $data['total_trashed_language'] = Cache::get('total_trashed_language');
        } else {
            $data['total_trashed_language'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_language', $data['total_trashed_language']);
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
    { \Artisan::call('cache:clear');
        $request->validate([
            'search' => 'min:1'
        ]);
        $data = [];
        if (Cache::get('total_language') && Cache::get('total_language') != null) {
            $data['total_language'] = Cache::get('total_language');
        } else {
            $data['total_language'] = $this->parentModel::count();
            Cache::put('total_language', $data['total_language']);
        }
        if (Cache::get('total_trashed_language') && Cache::get('total_trashed_language') != null) {
            $data['total_trashed_language'] = Cache::get('total_trashed_language');
        } else {
            $data['total_trashed_language'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_language', $data['total_trashed_language']);
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

    /**
     * This function attatch default language 
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       09/27/2022
     * Time         23:39:01
     * @param       Language $language
     * @return      
     */
    public function attatchLang(Language $language)
    { \Artisan::call('cache:clear');
        if (env('DEMO_MODE')) {
            Session::flash('error', 'In demo mode actions are disabled');
        } else {

            # code...   
            DB::beginTransaction();
            try {
                DB::table('languages')->where('is_default', 1)->update(['is_default' => 0]);
                $is_default = ((bool)$language->is_default) ? false : true;
                if ($language->update(['is_default' => $is_default])) {
                    if ($is_default) {
                        config(['app.locale' => $language->code]);
                    }
                    if ($is_default) {
                        Session::flash('success', 'Application default language set successfully');
                    } else {
                        Session::flash('success', 'Application default language remove successfully');
                    }
                    DB::commit();
                } else {
                    DB::rollBack();
                    Session::flash('error', 'Something is wrong');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('error', $e->getMessage());
            }
        }
    }
    #end

    /**
     * This function 
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       09/28/2022
     * Time         23:10:52
     * @param       
     * @return      
     */
    public function configureLang(Language $language)
    { \Artisan::call('cache:clear');
        # code...   
        $code = strtolower($language->code);
        $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
        $languages_path = $language_dir . DIRECTORY_SEPARATOR . $code;
        // current root file
        $current_root_file = $languages_path . DIRECTORY_SEPARATOR . 'root.php';
        // Main rooth file
        $main_dir = $language_dir . DIRECTORY_SEPARATOR . 'main';
        $main_file_path = $main_dir . DIRECTORY_SEPARATOR . 'root.php';

        try {
            if (file_exists($current_root_file) &&  file_exists($main_file_path)) {
                // current root file
                $current_file_items = require($current_root_file);
                // root current file
                $root_file_items = require($main_file_path);
                return view('admin.language.config', compact('current_file_items', 'language', 'root_file_items'));
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    #end

    /**
     * This function store language info on file
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       10/01/2022
     * Time         17:14:47
     * @param       Request $request, Language $language
     * @return      
     */
    public function configureLangStore(Request $request, Language $language)
    { \Artisan::call('cache:clear');
        # code...   
        $code = strtolower($language->code);

        $language_dir = resource_path() . DIRECTORY_SEPARATOR . 'lang';
        $main_dir = $language_dir . DIRECTORY_SEPARATOR . 'main';
        $main_file_path = $main_dir . DIRECTORY_SEPARATOR . 'root.php';

        $languages_path = $language_dir . DIRECTORY_SEPARATOR . $code;
        // current root file
        $current_root_file = $languages_path . DIRECTORY_SEPARATOR . 'root.php';

        try {
            if (file_exists($current_root_file) && file_exists($main_file_path)) {
                // current root file
                $current_file_items = require($current_root_file);
                // root current file
                $root_file_items = require($main_file_path);
                $php_text = "<?php " . PHP_EOL . "return[" . PHP_EOL;
                foreach ($request->except('_token') as $key => $items) {
                    $php_inner = "[" . PHP_EOL;
                    foreach ($items as $keyI => $item) {
                        $update_item = ($item) ? $item : $root_file_items[$key][$keyI];
                        $php_inner .= "'" . $keyI . "'=>'" . $update_item . "'," . PHP_EOL;
                    }
                    $php_text .= "'$key'" . "=>" . $php_inner . "]," . PHP_EOL;
                }
                $php_text .= "];" . PHP_EOL;
                file_put_contents($current_root_file, $php_text);
                Session::flash('success', 'Language configration successfuly updated');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
    #end


    public function bill_recieved(Request $request)
    {
        \Artisan::call('cache:clear');
        $data = [];
    


        $data['head'] = \DB::table('income_expense_groups')->where('deleted_at',NULL)->orderBy('created_at', 'desc')->get();


        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();



         if($branch_id != 1){
            $ledger = \DB::table('income_expense_heads')->where('type',1)->whereIn('id',$checkaray)->where('deleted_at',Null)->orderBy('created_at', 'desc')->get();

         }else{
            $ledger = \DB::table('income_expense_heads')->where('type',1)->where('deleted_at',Null)->orderBy('created_at', 'desc')->get();

         }

        if($branch_id == 2){
        $expense_paid =\DB::connection('second_db')->table('staff')->where('expense_create',1)->get();
        $expense_approve =\DB::connection('second_db')->table('staff')->where('expense_approve',1)->get();

        }elseif($branch_id == 3){
            $expense_paid =\DB::connection('third_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('third_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 4){
            $expense_paid =\DB::connection('fourth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('fourth_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 11){
            $expense_paid =\DB::connection('fifth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('fifth_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 12){
            $expense_paid =\DB::connection('sixth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('sixth_db')->table('staff')->where('expense_approve',1)->get();
        }else{
            $expense_paid = array();
            $expense_approve =array();
      
        }


       
        return view( 'admin.expense'. '.index', $data)->with('ledger', $ledger)
        ->with('expense_paid', $expense_paid)->with('expense_approve', $expense_approve);

    }


    
    public function bill_recievedsubfilter(Request $request)
    {

        \Artisan::call('cache:clear');
      $group =  $request->val;
        
      $items = \DB::table('income_expense_subgroups')->where('group_id',0)->where('relation_id',$group)->orderBy('created_at', 'desc')->get();

      $a = '<option value="">Select Head</option>';
       foreach($items as $item){
        
        $a .= '<option value="'.$item->id.'">'.$item->name.'</option>';

       }
       echo  $a;
    }


    
    public function createnewlaser(Request $request)
    { \Artisan::call('cache:clear');
        $group =  $request->group;
        $subgroup =  $request->subgroup;
        $person =  $request->person;
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
       $type = \DB::table('income_expense_groups')->where('id',$group)->value('income_expense_type');

       $data = array(
        'name' =>$person,
        'unit' =>Null,
        'income_expense_type_id' =>$type,
        'income_expense_group_id' =>$group,
        'type'	 =>1,
       'created_at'  => date('Y-m-d H:i:s'),
    );
    
    $inserted_id = \DB::table('income_expense_heads')->insertGetId($data);

if($inserted_id){


    $data1 = array(
        'ledger_id' =>$inserted_id,
        'branch_id' =>$branch_id,
    );

    \DB::table('ledger_branch')->insert($data1);

}


$checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

$ledger = \DB::table('income_expense_heads')->where('type',1)->whereIn('id',$checkaray)->where('deleted_at',Null)->orderBy('created_at', 'desc')->get();

$a =  '<option value="">Select Party Name</option>';


foreach ($ledger as $ledg){
 $a .=  '<option value="'.$ledg->id.'">'.$ledg->name.'</option>';

}

     echo $a;


    }

     
    public function bill_recievedstore(Request $request)
    {
        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
       

        $request->validate([
            'head' =>'required',
        'sub_head'=> 'required',
         'ledger'=> 'required',
         'bill_no'=> 'required|unique:expense',
         'bill_date'=> 'required',
          'amount'	=>'required',
         'gst'=> 'required',
          'total_amount'=>  'required',
          'type'=> 'required',
       'submitted_by'=>  'required',
            'submitted_date'=> 'required',
            'expense_approve'=> 'required',
            'approved_date'=>  'required',
        ]);


        if ($request->hasFile('upload')) {
            $request->validate([
            'upload' => 'image',
        ]);
        }

        $date = new \DateTime($request->bill_date);
        $bill_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'


        $date2 = new \DateTime($request->submitted_date);
        $submitted_date = $date2->format('Y-m-d'); // 31-07-2012 '2008-11-11'

        $date3 = new \DateTime($request->approved_date);
        $approved_date = $date3->format('Y-m-d'); // 31-07-2012 '2008-11-11'

    $data =  array( 'head' =>$request->head,
        'sub_head'=>   $request->sub_head,
         'ledger'=>     $request->ledger,
         'bill_no'=>  $request->bill_no,
         'bill_date'=>   $bill_date,
          'bill_amount'	=>    $request->amount,
         'gst'=> $request->gst,
          'total'=>    $request->total_amount,
          'goods_services'=>  $request->type,
          'tds'=>$request->tds,
          'voucher_no'=> $request->voucher_no,
          'details'=> $request->description,
        
           'submitted_by'=>  $request->submitted_by,
            'submitted_date'=> $submitted_date,
            'approved_by'=> $request->expense_approve,
            'approved_date'=> $approved_date,
            'branch_id'=> $branch_id,
            'created_by' => auth()->user()->email,


    );
    $inserted_id = \DB::table('expense')->insertGetId($data);


    if ($request->hasFile('upload')) {
     
        $upload = $request->upload;
        $temporaryName = time() . $upload->getClientOriginalName();
        $upload->move("upload/expense", $temporaryName);
        $img = 'upload/expense/' . $temporaryName;


       
        \DB::table('expense')->where('id',$inserted_id)->update(array( 'upload'=> $img));
    }
       
     
     
    Session::flash('success', "Expense Created Successfully");
     
    return redirect()->back();
      
       
    }



      
    public function bill_recieved_list(Request $request)
    { \Artisan::call('cache:clear');

        $data = [];
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;

        $date=  $request->from;
        $billno=  trim($request->billno);
        $voucherno=  trim($request->voucherno);
        $a=  trim($request->submitted_by);
        $b=  trim($request->expense_approve);
        $c=  trim($request->paid_by);


         

        
            $bankcashbranches =\DB::table('bank_cash_branches')->where('branch_id',$branch_id)->pluck('bank_cash')->toArray();

            $bankcash =\DB::table('bank_cashes')->whereIn('id',$bankcashbranches)->get();



            if($branch_id == 2){
                $expense_create =\DB::connection('second_db')->table('staff')->where('expense_create',1)->get();
                $expense_approve =\DB::connection('second_db')->table('staff')->where('expense_approve',1)->get();

                $expense_paid =\DB::connection('second_db')->table('staff')->where('expense_paid',1)->get();        
                }elseif($branch_id == 3){
                    $expense_create =\DB::connection('third_db')->table('staff')->where('expense_create',1)->get();
                    $expense_approve =\DB::connection('third_db')->table('staff')->where('expense_approve',1)->get();

                    $expense_paid =\DB::connection('third_db')->table('staff')->where('expense_paid',1)->get();
                }elseif($branch_id == 4){
                    $expense_approve =\DB::connection('fourth_db')->table('staff')->where('expense_approve',1)->get();

                    $expense_create =\DB::connection('fourth_db')->table('staff')->where('expense_create',1)->get();

                    $expense_paid =\DB::connection('fourth_db')->table('staff')->where('expense_paid',1)->get();
                }elseif($branch_id == 11){
                    $expense_create =\DB::connection('fifth_db')->table('staff')->where('expense_create',1)->get();
                    $expense_approve =\DB::connection('fifth_db')->table('staff')->where('expense_approve',1)->get();

                    $expense_paid =\DB::connection('fifth_db')->table('staff')->where('expense_paid',1)->get();
                }elseif($branch_id == 12){
                    $expense_approve =\DB::connection('sixth_db')->table('staff')->where('expense_approve',1)->get();

                    $expense_create =\DB::connection('sixth_db')->table('staff')->where('expense_create',1)->get();

                    $expense_paid =\DB::connection('sixth_db')->table('staff')->where('expense_paid',1)->get();
                }else{
                    $expense_paid = array();
                    $expense_create = array();
                    $expense_approve = array();
                }


                if($date){
                    $datenew=explode(' and ',$date);
                    $from = date('Y-m-d 00:00:00', strtotime($datenew[0]));
                       $to = date('Y-m-d 23:59:59', strtotime($datenew[1]));
                }
          

              $query =
              \DB::table('expense')->select('expense.*')->leftJoin('bill_received_payment', 'expense.id', '=', 'bill_received_payment.exp_id');
              if($date  == true){
              $query->whereDate('expense.created_at', '>=',$from)->whereDate('expense.created_at', '<=',$to);
              }
              if($billno != ''){
                $query->where('expense.bill_no',$billno);
              }
              if($voucherno != ''){
                $query->where('expense.voucher_no',$voucherno);
              }
              if($branch_id != 1){
                $query->where('expense.branch_id',$branch_id);
              }
              if($a  != ''){
                $query->where('expense.submitted_by',$a);
              }
              if($b  != ''){
                $query->where('expense.approved_by',$b);
              }
              if($c  != ''){
                $query->where('bill_received_payment.paid_by',$c);
              }
              
            $items =  $query->orderBy('expense.created_at', 'desc')->paginate(60)->onEachSide(1);




$data['a'] = $a;
$data['b'] = $b;
$data['c'] = $c;


                $data['vouchernoo'] = $voucherno;
                $data['billnoo'] = $billno;
                $data['datee'] = $date;
                
            return view( 'admin.expense'. '.list', $data)->with('items', $items)->with('bankcash', $bankcash)->with('expense_paidd',$expense_paid)
            ->with('expense_create',$expense_create)->with('expense_approve',$expense_approve);
    
     
    }


    
    public function editexpense($id)
    {
        \Artisan::call('cache:clear');
        
        $data = [];
        $data = [];
    


        $data['head'] = \DB::table('income_expense_groups')->where('deleted_at',NULL)->orderBy('created_at', 'desc')->get();


        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();



         if($branch_id != 1){
            $ledger = \DB::table('income_expense_heads')->where('type',1)->whereIn('id',$checkaray)->where('deleted_at',Null)->orderBy('created_at', 'desc')->get();

         }else{
            $ledger = \DB::table('income_expense_heads')->where('type',1)->where('deleted_at',Null)->orderBy('created_at', 'desc')->get();

         }

        if($branch_id == 2){
        $expense_paid =\DB::connection('second_db')->table('staff')->where('expense_create',1)->get();
        $expense_approve =\DB::connection('second_db')->table('staff')->where('expense_approve',1)->get();

        }elseif($branch_id == 3){
            $expense_paid =\DB::connection('third_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('third_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 4){
            $expense_paid =\DB::connection('fourth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('fourth_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 11){
            $expense_paid =\DB::connection('fifth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('fifth_db')->table('staff')->where('expense_approve',1)->get();
        }elseif($branch_id == 12){
            $expense_paid =\DB::connection('sixth_db')->table('staff')->where('expense_create',1)->get();
            $expense_approve =\DB::connection('sixth_db')->table('staff')->where('expense_approve',1)->get();
        }else{
            $expense_paid = array();
            $expense_approve =array();
      
        }







        $item =\DB::table('expense')->where('id',$id)->first();

        return view( 'admin.expense'. '.edit', $data)->with('item', $item)->with('ledger', $ledger)
        ->with('expense_paid', $expense_paid)->with('expense_approve', $expense_approve);

    }



    
    public function expenseupdate(Request $request ,$id)
    {
        \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
       

        $request->validate([
            'head' =>'required',
        'sub_head'=> 'required',
         'ledger'=> 'required',
         'bill_no'=> 'required|unique:expense,bill_no,' . $id,
         'bill_date'=> 'required',
          'amount'	=>'required',
         'gst'=> 'required',
          'total_amount'=>  'required',
          'type'=> 'required',
       'submitted_by'=>  'required',
            'submitted_date'=> 'required',
            'expense_approve'=> 'required',
            'approved_date'=>  'required',
        ]);


        if ($request->hasFile('upload')) {
            $request->validate([
            'upload' => 'image',
        ]);
        }

        $date = new \DateTime($request->bill_date);
        $bill_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'


        $date2 = new \DateTime($request->submitted_date);
        $submitted_date = $date2->format('Y-m-d'); // 31-07-2012 '2008-11-11'

        $date3 = new \DateTime($request->approved_date);
        $approved_date = $date3->format('Y-m-d'); // 31-07-2012 '2008-11-11'

    $data =  array( 'head' =>$request->head,
        'sub_head'=>   $request->sub_head,
         'ledger'=>     $request->ledger,
         'bill_no'=>  $request->bill_no,
         'bill_date'=>   $bill_date,
          'bill_amount'	=>    $request->amount,
         'gst'=> $request->gst,
          'total'=>    $request->total_amount,
          'goods_services'=>  $request->type,
          'tds'=>$request->tds,
          'voucher_no'=> $request->voucher_no,
          'details'=> $request->description,
        
           'submitted_by'=>  $request->submitted_by,
            'submitted_date'=> $submitted_date,
            'approved_by'=> $request->expense_approve,
            'approved_date'=> $approved_date,
            'branch_id'=> $branch_id,


    );
    $inserted_id = \DB::table('expense')->where('id',$id)->update($data);


    if ($request->hasFile('upload')) {
     
        $upload = $request->upload;
        $temporaryName = time() . $upload->getClientOriginalName();
        $upload->move("upload/expense", $temporaryName);
        $img = 'upload/expense/' . $temporaryName;


       
        \DB::table('expense')->where('id',$id)->update(array( 'upload'=> $img));
    }
       
     
     
    Session::flash('success', "Expense Updated Successfully");
     
    return redirect()->route('bill_recieved_list');
      
       
    }

    
    public function bill_paymentstore(Request $request)
    {
    
        \Artisan::call('cache:clear');
       
        \Artisan::call('cache:clear');
        $request->validate([
            'amount' =>'required',
            'payment_mode' =>'required',
            'account' =>'required',
            'paid_by' =>'required',
            'payment_date' =>'required',
        ]);



        $date = new \DateTime($request->payment_date);
        $payment_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'

        

        $data =  array(
        'exp_id'   =>  $request->exp_id,
      'amount'   =>  $request->amount,
      'payment_mode'   =>  $request->payment_mode,
      'payment_details'   =>  $request->payment_details,
      'account'    =>  $request->account,
      'paid_by'   =>  $request->paid_by,
      'payment_date'   =>  $payment_date,
      'voucher_no'   =>  $request->voucher_no,
      'created_by' => auth()->user()->email,
      'created_at'  => date('Y-m-d H:i:s'),);


      \DB::table('bill_received_payment')->insert($data);
      Session::flash('success', "Bill Payment Updated Successfully");
     
      return redirect()->route('bill_recieved_list');
    }

    
    public function viewbillpayments(Request $request)
    { \Artisan::call('cache:clear');
      $val =  $request->val;


$activ = Session::get('branch_array');
$branch_id =$activ->id;
$checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();




$loops =\DB::table('bill_received_payment')->where('exp_id',$val)->get();

$a ='<div class="table-responsive"><table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    SR
                                                </th>
                                                <th>amount</th>
                                             
                                                <th>payment_mode</th>
                                                <th>payment_details</th>
                                                <th>account</th>
                                                <th>paid_by</th>
                                                <th>payment_date</th>
                                                <th>voucher_no</th>
                                                <th>created_by</th>
                                                <th>created_at</th>                                          
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        $i= 0;
                                        
                                       foreach($loops as $lop){  $i++;
$a .='<tr>';
$a .='<td>'.$i.'</td>';
$a .='<td>'.$lop->amount.'</td>';
$a .='<td>'.$lop->payment_mode.'</td>';
$a .='<td>'.$lop->payment_details??'NA'.'</td>';

$bankcash =\DB::table('bank_cashes')->where('id',$lop->account)->value('name');


$a .='<td>'.$bankcash.'</td>';


if($branch_id == 2){
    $expense_paid =\DB::connection('second_db')->table('staff')->where('id',$lop->paid_by)->first();        
    }elseif($branch_id == 3){
        $expense_paid =\DB::connection('third_db')->table('staff')->where('id',$lop->paid_by)->first();
    }elseif($branch_id == 4){
        $expense_paid =\DB::connection('fourth_db')->table('staff')->where('id',$lop->paid_by)->first();
    }elseif($branch_id == 11){
        $expense_paid =\DB::connection('fifth_db')->table('staff')->where('id',$lop->paid_by)->first();
    }elseif($branch_id == 12){
        $expense_paid =\DB::connection('sixth_db')->table('staff')->where('id',$lop->paid_by)->first();
    }else{
        $expense_paid = array();
    
  
    }


    
$a .='<td>'.$expense_paid->name??''.' '.$expense_paid->surname??'' .'</td>';

$a .='<td>'.date('d-m-Y', strtotime($lop->payment_date)).'</td>';

$a .='<td>'.$lop->voucher_no??'NA'.'</td>';
$a .='<td>'.$lop->created_by.'</td>';
$a .='<td>'.date('d-m-Y', strtotime($lop->created_at)).'</td>';

$a .='</tr>';
                                       }
                                        $a .=  '</tbody>
                                                   <thead>
                                                <tr>
                                                <th class="checkbox_custom_style text-center">
                                                SR
                                            </th>
                                            <th>amount</th>
                                         
                                            <th>payment_mode</th>
                                            <th>payment_details</th>
                                            <th>account</th>
                                            <th>paid_by</th>
                                            <th>payment_date</th>
                                            <th>voucher_no</th>
                                            <th>created_by</th>
                                            <th>created_at</th>
                                                </tr>
                                            </thead>
                                        
                                    </table></div>';

  echo $a;
    }


    
    public function bill_recievedledger(Request $request)
    { \Artisan::call('cache:clear');
        $activ = Session::get('branch_array');
        $branch_id =$activ->id;
        
      $group =  $request->val;
        

      $checkaray = \DB::table('ledger_branch')->where('branch_id',$branch_id)->pluck('ledger_id')->toArray();

      $ledger = \DB::table('income_expense_heads')->where('type',1)->whereIn('id',$checkaray)->where('deleted_at',Null)->where('income_expense_group_id',$group)->orderBy('created_at', 'desc')->get();
      
      $a = '<option value="">Select Party Name</option>';
       foreach($ledger as $item){
        
        $a .= '<option value="'.$item->id.'">'.$item->name.'</option>';

       }
       echo  $a;
    }


    public function deleteexpense($id)
    {
        \Artisan::call('cache:clear');
       $count = \DB::table('expense')->select('expense.*')->rightJoin('bill_received_payment', 'expense.id', '=', 'bill_received_payment.exp_id')->where('expense.id',$id)->count();
       if($count == 0){
        \DB::table('expense')->where('expense.id',$id)->delete();
        Session::flash('success', "Expense Deleted Successfully");
        return redirect()->back();

       }else{
        Session::flash('error', "You can not delete it.Because it has linked payments");
        return redirect()->back();
       }

    }

}



