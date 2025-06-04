
<?php
$moduleName = 'Expense List';
$createItemName = __('root.common.create') . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.all');

$breadcrumbMainIcon = 'fas fa-language';
$breadcrumbCurrentIcon = 'archive';

$ParentRouteName = 'language';

$all = config('role_manage.Language.All');
$create = config('role_manage.Language.Create');
$delete = config('role_manage.Language.Delete');
$edit = config('role_manage.Language.Edit');
$pdf = config('role_manage.Language.Pdf');
$permanently_delete = config('role_manage.Language.PermanentlyDelete');
$restore = config('role_manage.Language.Restore');
$show = config('role_manage.Language.Show');
$trash_show = config('role_manage.Language.TrashShow');

?>

<?php $__env->startSection('title'); ?>
    <?php echo e($moduleName); ?> -> <?php echo e($breadcrumbCurrentName); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-bar'); ?>
    <?php echo $__env->make('includes.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left-sidebar'); ?>
    <?php echo $__env->make('includes.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="container-fluid">
            <div class="block-header <?php if($is_rtl): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <a <?php if($create == 0): ?> class="dis-none" <?php endif; ?> class="btn btn-sm btn-info waves-effect"
                    href="<?php echo e(route('bill_recieved')); ?>"><?php echo e(__('root.common.create')); ?></a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a>
                </li>
                <li><a href="<?php echo e(route('bill_recieved_list')); ?>"><i class="<?php echo e($breadcrumbMainIcon); ?>"></i>
                        &nbsp;<?php echo e($breadcrumbMainName); ?></a></li>
                <li class="active"><i
                        class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp;<?php echo e($breadcrumbCurrentName); ?>

                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            

                            <div>
                                <form class="search" action="<?php echo e(route('bill_recieved_listt')); ?>"
                                    method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row"> 
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 field_area">
                                    <input autofocus type="text" value="<?php echo e($billnoo); ?>"  name="billno" class="form-control input-sm "
                                        placeholder="Bill No." />
</div>



<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 field_area">
                                    <input autofocus type="text" name="voucherno" value="<?php echo e($vouchernoo); ?>" class="form-control input-sm "
                                        placeholder="Voucher No." />
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
<div class="input-group nk-int-st" style="border: 1px solid #ccc !important;">
				<span class="input-group-addon" style="padding-right:25px;"><i class="glyphicon glyphicon-calendar fa fa-calendar fa-lg" style="border: 1px solid #ccc !important;"></i>&nbsp;</span>
				<input type="text" name="from" id="txtFromDate" class="form-control" value="" placeholder="Select Date" autocomplete="off" style="font-size:15px;" >
			</div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="submitted_by" id="submitted_by">
                                                        <option value="">Submitted By</option>
                                                        <?php $__currentLoopData = $expense_create; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($ledg->id == $a): ?> selected <?php endif; ?>
                                                                value="<?php echo e($ledg->id); ?>"><?php echo e($ledg->name); ?> <?php echo e($ledg->surname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <label class="form-label">Submitted By</label>
                                                </div>
                                            </div>
                                      
                                        </div>



                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="expense_approve" id="expense_approve">
                                                        <option value="">Approved By</option>
                                                        <?php $__currentLoopData = $expense_approve; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($ledg->id == $b): ?> selected <?php endif; ?>
                                                                value="<?php echo e($ledg->id); ?>"><?php echo e($ledg->name); ?> <?php echo e($ledg->surname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <label class="form-label">Approved By</label>
                                                </div>
                                            </div>
                                      
                                        </div>



                                        
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="paid_by" id="paid_by">
                                                        <option value="">Paid By</option>
             
                                                    
                                                        <?php $__currentLoopData = $expense_paidd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if( $exp->id == $c): ?> selected <?php endif; ?>
                                                                value="<?php echo e($exp->id); ?>"><?php echo e($exp->name); ?> <?php echo e($exp->surname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <label class="form-label">Paid By</label>
                                                </div>
                                            </div>
                                      
                                        </div>


                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                                  <button type="submit" class="btn btn-sm btn-primary">Search</button>
</div>

</div>
                                        
                                </form>
                            </div>
                        </div>
                        <form class="actionForm" action="<?php echo e(route($ParentRouteName . '.active.action')); ?>" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                               
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        <?php echo e($items->links()); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive w-full">
                                <?php echo e(csrf_field()); ?>

                                <?php if(count($items) > 0): ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    Sr
                                                </th>
                                                <th>Head</th>
                                               <th>Sub head</th>
                                               <th>Ledger</th>
                                               <th>Bill No</th>
                                               <th>Bill Date</th>
                                               <th>Bill Amount</th>
  
                                               <th>GST</th>
                                               <th>Total Amt.</th>
                                               <th>Paid Amt.</th>
                                               <th>Balance</th>
                                               <th>goods_services</th>
                                               <th>TDS</th>
                                               <th>Voucher No.</th>
                                              
        
                                               <th>Submitted By</th>
                                               <th>Submitted Date</th>
                                               <th>Approved By</th>
                                               <th>Approved Date</th>
                                               <th>Details</th>
                                               <th>Upload</th>
                                               <th>Created At</th>
                                               <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; $array = array()?>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <?php
$pamt =\DB::table('bill_received_payment')->where('exp_id',$item->id)->sum('amount');


$fep = intval($item->total) - intval($pamt);

if(in_array($item->id, $array)){


}else{ 
$array[] = $item->id;



 ?>    




                                                <tr>
                                                <th class="checkbox_custom_style text-center" style="display:flex;justify-content:space-between">
                                                   <span> <?php echo e($i); ?> </span>
                                                   <span>
                                                   <?php if($fep == $item->total): ?>
                                                    <a style="margin-left:5px;" href="javscript:void(0)" class="btn btn-xs btn-success pay_modal" id="<?php echo e($item->id); ?>" data-id="<?php echo e($fep); ?>">Pay</a>
                                                   <?php elseif(($fep < $item->total) && ($fep != 0)): ?>
                                                   <a style="margin-left:5px;" href="javscript:void(0)" class="btn btn-xs btn-warning pay_modal" id="<?php echo e($item->id); ?>" data-id="<?php echo e($fep); ?>">Partial</a>
                                                   <a style="margin-left:5px;" href="javscript:void(0)" class="btn btn-xs btn-primary view_modal" id="<?php echo e($item->id); ?>" data-id="<?php echo e($fep); ?>">View</a>
                                                    <?php else: ?>
                                                    <a style="margin-left:5px;" href="javscript:void(0)" class="btn btn-xs btn-primary view_modal" id="<?php echo e($item->id); ?>" data-id="<?php echo e($fep); ?>">Paid</a>

                                                   <?php endif; ?>
</span>


                                                </th>
<?php
$head =\DB::table('income_expense_groups')->where('id',$item->head)->value('name');
 ?>      
                                           <td><?php echo e($head); ?></td>
<?php
$sub_head =\DB::table('income_expense_subgroups')->where('id',$item->sub_head)->value('name');
 ?> 
                                               <td><?php echo e($sub_head); ?></td>
<?php
$ledger =\DB::table('income_expense_heads')->where('id',$item->ledger)->value('name');
 ?>                                              
                                               <td><?php echo e($ledger); ?></td>
                                               <td><?php echo e($item->bill_no); ?></td>
                                               <td><?php echo e(date("d-m-Y", strtotime($item->bill_date))); ?></td>
                                               <td><?php echo e($item->bill_amount); ?></td>
  
                                               <td><?php echo e($item->gst); ?></td>
                                               <td><?php echo e($item->total); ?></td>

                                               <td><?php echo e($pamt); ?></td>

                                               <td><?php echo e($fep); ?></td>
                                               

                                               <td><?php echo e($item->goods_services); ?></td>
                                               <?php if($item->tds == 1): ?>
                                               <td>YES</td>
                                               <?php else: ?>
                                               <td>NO</td>
                                               <?php endif; ?>
                                              
                                               <td><?php echo e($item->voucher_no); ?></td>
  <?php 


  $activ = \Illuminate\Support\Facades\Session::get('branch_array');
        $branch_id =$activ->id;
  
  if($branch_id == 2){
        $expense_paid =\DB::connection('second_db')->table('staff')->where('id',$item->submitted_by)->first();
        $expense_approve =\DB::connection('second_db')->table('staff')->where('id',$item->approved_by)->first();

        }elseif($branch_id == 3){
            $expense_paid =\DB::connection('third_db')->table('staff')->where('id',$item->submitted_by)->first();
            $expense_approve =\DB::connection('third_db')->table('staff')->where('id',$item->approved_by)->first();
        }elseif($branch_id == 4){
            $expense_paid =\DB::connection('fourth_db')->table('staff')->where('id',$item->submitted_by)->first();
            $expense_approve =\DB::connection('fourth_db')->table('staff')->where('id',$item->approved_by)->first();
        }elseif($branch_id == 11){
            $expense_paid =\DB::connection('fifth_db')->table('staff')->where('id',$item->submitted_by)->first();
            $expense_approve =\DB::connection('fifth_db')->table('staff')->where('id',$item->approved_by)->first();
        }elseif($branch_id == 12){
            $expense_paid =\DB::connection('sixth_db')->table('staff')->where('id',$item->submitted_by)->first();
            $expense_approve =\DB::connection('sixth_db')->table('staff')->where('id',$item->approved_by)->first();
        }else{
            $expense_paid = array();
            $expense_approve =array();
      
        }

  ?>
        
                                               <td><?php echo e($expense_paid->name??""); ?> <?php echo e($expense_paid->surname??""); ?></td>
                                               <td><?php echo e(date("d-m-Y", strtotime($item->submitted_date))); ?></td>
                                               <td><?php echo e($expense_approve->name??""); ?> <?php echo e($expense_approve->surname??""); ?></td>
                                               <td><?php echo e(date("d-m-Y", strtotime($item->approved_date))); ?></td>
                                               <td class='shortened'><?php echo e($item->details); ?></td>
                                               <td><?php if($item->upload): ?>
                                                <a href="<?php echo e(asset($item->upload)); ?>" target="blank" class="btn btn-success btn-xs">view</a>
                                                <?php else: ?>
                                                NA
                                                <?php endif; ?></td>
                                               <td><?php echo e(date("d-m-Y", strtotime($item->created_at))); ?></td>
                                               
                                              
                                               <td class="">
                                                        <a class="btn btn-xs btn-info waves-effect" href="<?php echo e(route($ParentRouteName . '.editexpense', ['id' => $item->id])); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="material-icons">mode_edit</i></a>
                                                        <a class="btn btn-xs btn-danger waves-effect" href="<?php echo e(route($ParentRouteName . '.deleteexpense', ['id' => $item->id])); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Trash"> <i class="material-icons">delete</i></a>
        
                                                 

                                               </td>
                                                </tr>    <?php  $i++;  ?>
                                                <?php } ?>
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <thead>
                                                <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    Sr
                                                </th>
                                                <th>Head</th>
                                               <th>Sub head</th>
                                               <th>Ledger</th>
                                               <th>Bill No</th>
                                               <th>Bill Date</th>
                                               <th>Bill Amount</th>
  
                                               <th>GST</th>
                                               <th>Total Amt.</th>
                                               <th>Paid Amt.</th>
                                               <th>Balance</th>
                                               <th>goods_services</th>
                                               <th>TDS</th>
                                               <th>Voucher No.</th>
                                             
        
                                               <th>Submitted By</th>
                                               <th>Submitted Date</th>
                                               <th>Approved By</th>
                                               <th>Approved Date</th>
                                               <th>Details</th>
                                               <th>Upload</th>
                                               <th>Created At</th>
                                               <th>Action</th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger text-center">
                                                        <?php echo e(__('root.common.no_data_found')); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="pagination-and-action-area body">
                                <div>
                                    
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        <?php echo e($items->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </section>



    <div id="mymodal" class="modal fade" role="dialog">
        <form action="<?php echo e(route($ParentRouteName . '.bill_paymentstore')); ?>" method="post">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pay Bill</h4>
      </div>
      <div class="modal-body">
      <?php echo e(csrf_field()); ?>      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="foc">
                                                <input name="exp_id" value="" id="exp_id" type="hidden" class="form-control">
                                                    <input name="amount" value="<?php echo e(old('amount')); ?>" id="amount" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="payment_mode" id="payment_mode" >
                                                       
                                                      
                                            <option value="">--Select Payment Mode--</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="DD">DD</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="upi">UPI</option>
                                            <option value="card">Card</option>
                                            </select>
                                                    <label class="form-label"> Payment Mode</label>
                                                </div>
                                            </div>
                                      
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 other-input" style="display:none">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus="" value="<?php echo e(old('payment_details')); ?>" name="payment_details" type="text" id="payment_details" class="form-control">
                                                    <label class="form-label">Payment Details</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="account" id="account" >
                                                        <option value="">Select Account</option>
                                                        <?php $__currentLoopData = $bankcash; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($bank->id == old('account')): ?> selected <?php endif; ?>
                                                                value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <label class="form-label">Account</label>
                                                </div>
                                            </div>
                                      
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="paid_by" id="paid_by">
                                                        <option value="">Paid By</option>
             
                                                    
                                                        <?php $__currentLoopData = $expense_paidd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if( $exp->id == old('paid_by')): ?> selected <?php endif; ?>
                                                                value="<?php echo e($exp->id); ?>"><?php echo e($exp->name); ?> <?php echo e($exp->surname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <label class="form-label">Paid By</label>
                                                </div>
                                            </div>
                                      
                                        </div>



                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="<?php echo e(old('payment_date')); ?>"
                                                        name="payment_date" type="text" class="form-control"
                                                        placeholder="Payment Date...">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus="" value="<?php echo e(old('voucher_no')); ?>"  name="voucher_no" type="text" id="voucher_no" class="form-control">
                                                    <label class="form-label">Voucher No.</label>
                                                </div>
                                            </div>
                                        </div>


      </div>


      <div class="modal-footer">
      <button type="submit" class="btn btn-info " id="submitpay">Save</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
    </form>
</div>







<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Payments</h4>
      </div>
      <div class="modal-body" id="apdhere">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('include-css'); ?>
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('include-css'); ?>
    <!-- Wait Me Css -->
    <link href="<?php echo e(asset('asset/plugins/waitme/waitMe.css')); ?>" rel="stylesheet" />
    <!-- Colorpicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="<?php echo e(asset('asset/plugins/dropzone/dropzone.css')); ?>" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="<?php echo e(asset('asset/plugins/multi-select/css/multi-select.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="<?php echo e(asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
    
    <script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
    </script>

    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>
    <!-- Autosize Plugin Js -->
    <script>
        <?php if(Session::has('success')): ?>
            toastr["success"]('<?php echo e(Session::get('success')); ?>');
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr["error"]('<?php echo e(Session::get('error')); ?>');
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr["error"]('<?php echo e($error); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
    
    <script src="<?php echo e(asset('asset/js/dataTable.js')); ?>"></script>
    <script>
        var set_as_default = document.querySelectorAll(".set_as_default");
        set_as_default.forEach(element => {
            element.addEventListener("click", (e) => {
                Helper.ajaxRequest('GET', `language/attatchLang/${parseInt(e.target.value)}`, true);
            });
        });
        BaseController.init();
    </script>
    <script>
        

    
    $(document).ready(function(){
    var shortening_text = $(".shortened");
  
    // shortening_text.each(function() {
    //   var txt = $(this).html();
    //   if (txt.length < 40) return;
    //   $(this).html(
    //     txt.slice(0, 40) +
    //       '<span>... </span><a href="#" class="show" style="color:red">Read More</a>' +
    //       '<span style="display:none;">' +
    //       txt.slice(40, txt.length) +
    //       ' <a href="#" class="less" style="color:red">Close</a></span>'
    //   );
    // });
  
  
    shortening_text.each(function() {
      var txt = $(this).html();
      if (txt.length < 40) return;
      $(this).html(
        txt.slice(0, 40) +
          '<span>... </span><a href="#" class="show12" style="color:red">Read more</a>' +
          '<span style="display:none;">' +
          txt.slice(40, txt.length) +
          ' <a href="#" class="less12" style="color:red">Close</a></span>'
      );
    });
  
  
  
  
    $("a.show12", shortening_text).click(function(event) {
      event.preventDefault();
      $(this)
        .hide()
        .prev()
        .hide();
      $(this)
        .next()
        .show();
    });
  
    $("a.less12", shortening_text).click(function(event) {
      event.preventDefault();
      $(this)
        .parent()
        .hide()
        .prev()
        .show()
        .prev()
        .show();
    });
  });
  
  </script>
  <script>
    $(document).on("click",".pay_modal",function() {
          $aiiid = $(this).attr('id');
          $amt = $(this).attr('data-id');
          $('#exp_id').val($aiiid);
          $('#amount').val($amt);

          $('#amount').prop('max',$amt);

          $('#amount').prop('min',1);
          $("#foc").addClass("focused");
             $('#mymodal').modal('show'); 
});




$(function() {
        $(".other-input").hide();
            $("#payment_mode").change(function() {
                if(($(this).val() != 'Cash') && (($(this).val() != '')))
                { 
                    $(".other-input").show();
                }
                else
                {
                    $(".other-input").hide();
                    $('.other-input').val("");
                }
          });
    });

    $(document).on('click', '.view_modal', function() {

        $expid = $(this).attr('id');
        $('#apdhere').empty();
        
    $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "<?php echo e(route($ParentRouteName . '.viewbillpayments')); ?>",
            data: {
                val : $expid
            },
            success: function(data){  
               
                $('#apdhere').append(data);
                $('#myModal2').modal('show'); 
    },
         
        });
    });

</script>
</script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
</script>
<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<!-- Autosize Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript">
	var start =moment().startOf('month');
    var end =moment().endOf('month');
	
	function cb(start, end) {
        //$('#txtFromDate').val(start.format('YYYY-MM-DD') + ' and ' + end.format('YYYY-MM-DD'));
        $('#txtFromDate').val('<?php echo e($datee); ?>');
    }



    
	$(document).ready(function(){
	 	$('#txtFromDate').daterangepicker({
			//startDate: start,
			//endDate: end,
			autoUpdateInput: false,
			locale: {
				cancelLabel: 'Clear'
			},
			ranges: {
				'Today': [moment(), moment()], 
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
        },cb);
		cb(start, end);
		$('#txtFromDate').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD')+"" + ' and ' + ""+picker.endDate.format('YYYY-MM-DD'));
		});

		$('#txtFromDate').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	 	
	});	
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/expense/list.blade.php ENDPATH**/ ?>