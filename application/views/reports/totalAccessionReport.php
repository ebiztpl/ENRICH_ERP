<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php //echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_library'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>

                        <span id="newlyaappw" style="font-size: 20px;
    background-color: #72727226;
    padding: 5px;
    border-radius: 6%;"></span>
                    </div>
                    <form role="form" action="<?php echo site_url('report/getAccessionReportparameter') ?>" method="post" class="" id="reportform" >
                        <div class="box-body row"  >
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('search_type'); ?></label>
                                    <select class="form-control" name="search_type" onchange="showdate(this.value)">
                                        <?php foreach ($searchlist as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($search_type)) && ($search_type == $key)) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $search ?></option>
                                                <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                            <div id='date_result'>
                            </div>


                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Book category</label>
                                <!-- <input autofocus=""  id="book_category" name="book_category" placeholder="" type="text" class="form-control"  value="<?php echo set_value('book_category'); ?>" /> -->


                                <select autofocus="" id="book_category" name="book_category" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
foreach ($book_category as $bookcategory) {
        ?>
                                         <option value="<?php echo $bookcategory->id ?>"<?php
if ((isset($book_category)) && ($book_category == $bookcategory->id)) {
            echo "selected = selected";
        } 
        ?>  ><?php echo $bookcategory->book_category ?></option>
                                            <?php
}
    ?>
                                    </select>


                                <span class="text-danger" id="book_category_error" ><?php echo form_error('book_category'); ?></span>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="">
                        <div class="box-header ptbnull"></div>   
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('book_issue_report'); ?></h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('book_issue_report').' '.$this->customlib->get_postmessage();
                                            ?> </div>
                            <table class="table table-striped table-bordered table-hover record-list" data-export-title="<?php echo $this->lang->line('book_issue_report');
                                            $this->customlib->get_postmessage(); ?>">
                                <thead>
                                    <tr>
                                        <th>Accession No</th>
                                        <th><?php echo $this->lang->line('book_title'); ?></th>
                                        <th><?php echo $this->lang->line('book_category'); ?></th>
                                        <th>Author Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   
    </div>  
</section>
</div>

<script>


<?php
if ($search_type == 'period') {
    ?>
        $(document).ready(function () {
            showdate('period');
        });
    <?php
}
?>
</script>
<script>
$(document).ready(function() {
    initDatatable('record-list','report/getAccessionreportlist',[],[],100);
});
</script>
<script type="text/javascript">
$(document).ready(function(){ 
$(document).on('submit','#reportform',function(e){
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var $this = $(this).find("button[type=submit]:focus");  
    var form = $(this);
    var url = form.attr('action');
    var form_data = form.serializeArray();
    $.ajax({
           url: url,
           type: "POST",
           dataType:'JSON',
           data: form_data, // serializes the form's elements.
              beforeSend: function () {
                $('[id^=error]').html("");
                    $this.button('loading');
               },
              success: function(response) { // your success handler
                
                if(!response.status){
                    $.each(response.error, function(key, value) {
                    $('#book_category_error').html(value);
                    });
                }else{
                 
                   initDatatable('record-list','report/getAccessionreportlist',response.params);
                }
              },
             error: function() { // your error handler
                 $this.button('reset');
             },
             complete: function() {
               $this.button('reset');
             }
         });
        });
    });   



    $(window).load(function() {
    setTimeout(function () {
            $cou =  $('.dataTables_info').html();  
     
            var arr = $cou.split('of');
             $('#newlyaappw').html('Total Books: '+arr[1]); 
        }, 1000);
      
            
        });
</script>