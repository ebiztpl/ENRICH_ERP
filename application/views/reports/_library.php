<div class="row">
    <div class="col-md-12">
        <div class="box box-primary border0 mb0 margesection">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('library_report'); ?></h3>

            </div>
            <div class="">
                <ul class="reportlists">
                    <?php if ($this->rbac->hasPrivilege('book_issue_report', 'can_view')) { ?>
                        <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/book_issue_report'); ?>"><a href="<?php echo base_url() ?>report/studentbookissuereport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('book_issue_report'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('book_due_report', 'can_view')) { ?>
                        <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/bookduereport'); ?>"><a href="<?php echo base_url() ?>report/bookduereport"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('book_due_report'); ?></a></li>
                    <?php } if ($this->rbac->hasPrivilege('book_inventory_report', 'can_view')) { ?>
                        <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/bookinventory'); ?>"><a href="<?php echo base_url() ?>report/bookinventory"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('book_inventory_report'); ?></a></li>
                        <?php
                    }
                    if ($this->rbac->hasPrivilege('book_issue_return_report', 'can_view')) {
                        ?>
                        <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/issue_returnreport'); ?>"><a href="<?php echo base_url(); ?>admin/book/issue_returnreport"><i class="fa fa-file-text-o"></i>
                                <?php echo $this->lang->line('book_issue_return_report'); ?>

                            </a></li>
                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/surrend_returnreport'); ?>"><a href="<?php echo base_url(); ?>report/surrend_returnreport"><i class="fa fa-file-text-o"></i>
                                Surrender Membership Report

                            </a></li>


                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/searchbookduplicacy'); ?>"><a href="<?php echo base_url(); ?>admin/book/searchbookduplicacy"><i class="fa fa-file-text-o"></i>
                                Book Lost Report

                            </a></li>

                            <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/bookwriteoffreport'); ?>"><a href="<?php echo base_url(); ?>admin/book/bookwriteoffreport"><i class="fa fa-file-text-o"></i>
                                Book Write Off Report

                            </a></li>
                          

                        <?php
                    }?>
                      <li class="col-lg-4 col-md-4 col-sm-6 <?php echo set_SubSubmenu('Reports/library/totalAccessionReport'); ?>"><a href="<?php echo base_url(); ?>report/totalAccessionReport"><i class="fa fa-file-text-o"></i>
                                Total Accession Number Report
                    </a></li>

                </ul>
            </div>
        </div>
    </div>
</div>