@extends('layouts.app')

<?php

$moduleName = 'Income';
$createItemName = __('root.common.edit') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Expense';
$ParentRouteName = 'bill_recieved';

?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')
    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <!-- <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div> -->
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i>
                        {{ __('root.common.home') }}</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;
                    {{ $breadcrumbCurrentName }}
                </li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName }}
                                <small>Put {{ $moduleName }} Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route('income.save.edit', ['id' => $item->id]) }}" enctype="multipart/form-data" >
                                    {{ csrf_field() }}

                                    <div class="row clearfix">



                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="head" id="head" >
                                                        <option value="">Select Group</option>
                                                        @foreach ($head as $group)
                                                            <option @if ($group->id == $item->head) selected @endif
                                                                value="{{ $group->id }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                   



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="sub_head" id="sub_head" >
                                                        <option value="">Select Sub-Group</option>
                                            
                                                    </select >
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="ledger" id="ledger" >
                                                        <option value="">Select Party Name</option>
                                                   
                                                    </select>
                                                    <label class="form-label"> Party Name</label>
                                                </div>
                                            </div>
                                      
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                             <a href="javascript:void(0)" class="btn btn-success" id="add_ledger" style="display:none">+</a>
                                        </div>

                                        

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus="" value="{{ $item->bill_no }}" name="bill_no" type="text" id="bill_no" class="form-control">
                                                    <label class="form-label">Bill No.</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ date('m/d/Y', strtotime($item->bill_date))  }}"
                                                        name="bill_date" type="text" class="form-control"
                                                        placeholder="Bill Date...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount" value="{{ $item->bill_amount }}" id="amount" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="gst" id="gst" type="number" value="{{ $item->gst }}" class="form-control amount">
                                                    <label class="form-label">GST </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="foc">
                                                    <input name="total_amount" id="total_amount" type="number" value="{{ $item->total }}"    class="form-control amount" >
                                                    <label class="form-label">Total Amount </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                 @if($item->goods_services)
                                                 <input value="Goods" name="type" type="radio" id="radio_1" class="with-gap radio-col-cyan"  @if($item->goods_services == 'Goods')  checked="" @endif>
                                                <label for="radio_1">Goods</label>
                                                <input value="Services" name="type" type="radio" id="radio_2" class="with-gap radio-col-cyan"  @if($item->goods_services == 'Services')  checked="" @endif>
                                                <label for="radio_2">Services</label>

                                                 @else
                                                 <input value="Goods" name="type" type="radio" id="radio_1" class="with-gap radio-col-cyan"   checked="" >
                                                <label for="radio_1">Goods</label>
                                                <input value="Services" name="type" type="radio" id="radio_2" class="with-gap radio-col-cyan">
                                                <label for="radio_2">Services</label>
                                                 @endif
                                              
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                             
                                                
                                                <input value="1" name="tds" type="checkbox" id="tds" @if($item->tds == '1')  checked="" @endif>
                                                <label for="tds">TDS Deductable</label>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus="" value="{{ $item->voucher_no }}"  name="voucher_no" type="text" id="voucher_no" class="form-control">
                                                    <label class="form-label">Voucher No.</label>
                                                </div>
                                            </div>
                                        </div>


                              


                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="submitted_by" id="submitted_by">
                                                        <option value="">Submitted By</option>
                                                        @foreach ($expense_paid as $ledg)
                                                            <option @if ($ledg->id == $item->submitted_by) selected @endif
                                                                value="{{ $ledg->id }}">{{ $ledg->name }} {{ $ledg->name }}{{ $ledg->surname }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-label">Submitted By</label>
                                                </div>
                                            </div>
                                      
                                        </div>

                                        
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ date('m/d/Y', strtotime($item->submitted_date))  }}"
                                                        name="submitted_date" type="text" class="form-control"
                                                        placeholder="Submitted Date...">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="expense_approve" id="expense_approve">
                                                        <option value="">Approved By</option>
                                                        @foreach ($expense_approve as $ledg)
                                                            <option @if ($ledg->id == $item->approved_by) selected @endif
                                                                value="{{ $ledg->id }}">{{ $ledg->name }} {{ $ledg->name }}{{ $ledg->surname }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-label">Approved By</label>
                                                </div>
                                            </div>
                                      
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ date('m/d/Y', strtotime($item->approved_date))  }}"
                                                        name="approved_date" type="text" class="form-control"
                                                        placeholder="Approved Date...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control no-resize" name="description" rows="1">{{ $item->details }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <div class="form-group form-float">
                                            
                                                <div class="form-line ">
                                                    <input  name="upload" type="file" id="upload" class="form-control">
                                                   
                                                </div>
                                                @if($item->upload)
                                                <a href="{{ asset($item->upload) }}" target="blank" class="btn btn-success btn-xs">view</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    {{ __('root.common.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>
@stop

@push('include-css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endpush

@push('include-js')
    <script>
        @if (Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif
        @if (Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]('{{ $error }}');
            @endforeach
        @endif

        // Validation and calculation
        var UiController = (function() {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                type: 'input[name=type]',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_type: document.querySelector(DOMString.type),
                        get_code: document.querySelector(DOMString.code),
                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        type: Fields.get_type.value == "" ? 0 : Fields.get_type.value,
                    }
                },
            }
        })();

        var MainController = (function(UICnt) {
            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var setUpEventListner = function() {
                Fields.get_form.addEventListener('submit', validation);
            };
            var validation = function(e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();
                if (input_values.name == 0) {
                    toastr["error"]('Ledger Group Name Is Required');
                    e.preventDefault();
                }
                if(input_values.type == 0){
                    toastr["error"]('Ledger Group Type Is Required');
                }
            };
            return {
                init: function() {
                    setUpEventListner();
                }
            }

        })(UiController);
        MainController.init();
    </script>
<script>
    // sub_head
    $(document).on('change', '#head', function() {
        $val = $(this).val();
     
        $('#ledger').empty();
        $('#sub_head').empty();
    $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.bill_recievedsubfilter') }}",
            data: {
                val : $val
            },
            success: function(data){  
                
                $('#sub_head').append(data);
                $('#sub_head').selectpicker('refresh');
                $('#add_ledger').hide();
    },
         
        });


        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.bill_recievedledger') }}",
            data: {
                val : $val
            },
            success: function(data){  
                $('#ledger').append(data);
                $('#ledger').selectpicker('refresh');
    },
         
        });


        
   




        
    })


    </script>

<script>
$(document).on("change","#sub_head",function() {
     $value = $(this).val();
     if($value != ''){
        $('#add_ledger').show();
     }else{
        $('#add_ledger').hide();
     }

});


$(document).on("click","#add_ledger",function() {
   $group =  $('#head').val();
   $subgroup =  $('#sub_head').val();
   

   let person = prompt("Enter Ledger Name");

if (person != null) {
    $('#ledger').empty();
    $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.createnewlaser') }}",
            data: {
                group : $group,
                subgroup : $subgroup,
                person : person
            },
            success: function(data){  
                
                $('#ledger').append(data);
                $('#ledger').selectpicker('refresh');
   
    },
         
        });
}else{
    alert('Process Cancelled');
}

});








$(document).on('keyup', '#amount, #gst', function() {
    $('#total_amount').val('');
$amount = parseInt($('#amount').val());
$gst = parseInt($('#gst').val());

if(($amount != '') && ($gst != '')){
       $total = $amount * ($gst/100);
       $tot = parseInt($amount) +  parseInt($total) ;
       $('#total_amount').val($tot);
       $("#foc").addClass("focused");
       
}else{
    $('#total_amount').val('');
}

});
</script>

<script>

$(document).ready(function(){


        $val = $('#head').val();


        $('#ledger').empty();
$('#sub_head').empty();
    $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.bill_recievedsubfilter') }}",
            data: {
                val : $val
            },
            success: function(data){  
                
                $('#sub_head').append(data);
                $('#sub_head').val('{{$item->sub_head}}');
                $('#sub_head').selectpicker('refresh');
                $('#add_ledger').hide();
    },
         
        });


        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.bill_recievedledger') }}",
            data: {
                val : $val
            },
            success: function(data){  
                $('#ledger').append(data);
                $('#ledger').val('{{$item->ledger}}');
                $('#ledger').selectpicker('refresh');
    },
         
        });
    });

</script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<!-- Bootstrap Datepicker Plugin Js -->
<script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- Autosize Plugin Js -->
<script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>
<script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
@endpush
