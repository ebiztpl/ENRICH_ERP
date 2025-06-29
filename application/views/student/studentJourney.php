<?php
$status          = 'documents';
$admin_session   = $this->session->userdata('admin');
$currency_symbol = $admin_session['currency_symbol'];
?>
<style>
  fieldset {
    min-width: 0;
    padding: 20px;
    margin: 0;
    /* border: none; */
    border: 1px solid silver;
    margin-bottom:20px;
}
legend{
    border-bottom:unset;
    width:unset;
         margin-bottom: unset;
}
</style>

<div class="content-wrapper">
    <div class="row">
        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">
                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                            ?>
                                <li <?php
                                    if ($student["section_id"] == $svalue["section_id"]) {
                                        echo "class='active'";
                                    }
                                    ?>><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pb20">
                        <?php foreach ($class_section as $skey => $snvalue) {
                        ?>
                            <div class="tab-pane <?php
                                                    if ($student["section_id"] == $snvalue["section_id"]) {
                                                        echo "active";
                                                    }
                                                    ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                <?php
                                foreach ($studentlistbysection as $stkey => $stvalue) {
                                    if ($stvalue['section_id'] == $snvalue["section_id"]) {

                                ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "student/journey/" . $stvalue["id"] ?>">
                                                <div class="icon">
                                                    <?php if ($sch_setting->student_photo) {
                                                    ?>
                                                        <img src="<?php
                                                                    if (!empty($stvalue["image"])) {
                                                                        echo $this->media_storage->getImageURL($stvalue["image"]);
                                                                    } else {
                                                                        if ($student['gender'] == 'Female') {
                                                                            echo $this->media_storage->getImageURL("uploads/student_images/default_female.jpg");
                                                                        } elseif ($student['gender'] == 'Male') {
                                                                            echo $this->media_storage->getImageURL("uploads/student_images/default_male.jpg");
                                                                        }
                                                                    }
                                                                    ?>" alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="student-tittle"><?php echo $this->customlib->getFullName($stvalue['firstname'], $stvalue['middlename'], $stvalue['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></div>
                                            </a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </aside>
        </div>
        <!-- /.control-sidebar -->
    </div>

    <section class="content">
        <div class="row">
           
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>

                        <?php
                        if ($this->module_lib->hasActive('fees_collection')) {
                            if (($this->rbac->hasPrivilege('collect_fees', 'can_view') ||
                                $this->rbac->hasPrivilege('search_fees_payment', 'can_view') ||
                                $this->rbac->hasPrivilege('search_due_fees', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_statement', 'can_view') ||
                                $this->rbac->hasPrivilege('balance_fees_report', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_carry_forward', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_master', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_group', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_type', 'can_view') ||
                                $this->rbac->hasPrivilege('fees_discount', 'can_view') ||
                                $this->rbac->hasPrivilege('accountants', 'can_view') ||
                                $this->rbac->hasPrivilege('student_timeline', 'can_view')

                            )) {
                        ?>
                                <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('fees'); ?></a></li>
                        <?php
                            }
                        }
                        ?>

                    

                        <!------- CBSE Exam Start-------->
                        <?php
                        if ($this->module_lib->hasModule('cbseexam')) {
                        ?>
                            <li class=""><a href="#cbseexam" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('cbse_exam'); ?></a></li>
                        <?php
                        }
                        ?>
                        <!------- CBSE Exam End-------->

                  
                        <?php if ($sch_setting->upload_documents) {
                        ?>
                            <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                        <?php
                        } ?>

                

                        <?php if ($this->rbac->hasPrivilege('student_timeline', 'can_view')) { ?>

<li class=""><a href="#bookissued" data-toggle="tab" aria-expanded="true">Books Issued</a></li>
<?php } ?>



<?php if ($this->rbac->hasPrivilege('student_timeline', 'can_view')) { ?>

<li class=""><a href="#membership_renewals" data-toggle="tab" aria-expanded="true">Library Membership Renewals</a></li>
<li class=""><a href="#certificateissued" data-toggle="tab" aria-expanded="true">Certificates Issued</a></li>

<?php } ?>



                        <!------- Behaviour Report Start-------->
                        <?php
                        if ($this->module_lib->hasModule('behaviour_records')) {
                            if ($this->rbac->hasPrivilege('behaviour_records_assign_incident', 'can_view')) {

                        ?>
                                <li class=""><a href="#incident" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('student_behaviour'); ?></a></li>
                        <?php

                            }
                        }
                        ?>
                        <!------- Behaviour Report End-------->

                    
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table3 table-hover table-striped tmb0">
                                        <tbody>
											
											
                                        <tr>
                                        <td>Full Name</td>
                                        <td><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                        <td rowspan="3"><?php if ($sch_setting->student_photo) {


if (!empty($student["image"])) {

    $image_url = $this->media_storage->getImageURL($student["image"]);
} else {

    if ($student['gender'] == 'Female') {
        $image_url = $this->media_storage->getImageURL("uploads/student_images/default_female.jpg");
    } else {
        $image_url = $this->media_storage->getImageURL("uploads/student_images/default_male.jpg");
    }
}

?>
<img class="profile-user-img img-responsive img-rounded" src="<?php echo $image_url; ?>" alt="User profile picture">
<?php } ?>
                                    </td>
                                       </tr>
                            
                                       <tr>
                                        <td><?php echo $this->lang->line('admission_no'); ?></td>
                                        <td> <span class="text-aqua"><?php echo $student['admission_no']; ?></span></td>
                                          </tr>
                           
                                          <tr>
                                        <td><?php echo $this->lang->line('roll_number'); ?></td>
                                        <td> <span class="text-aqua"><?php echo $student['roll_no']; ?></td>
                                        </tr>

                                             <?php  if ($sch_setting->enrollment_no) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('enrollment_no'); ?></td>
                                                    <td><?php echo $student['enrollment_no']; ?></td>
                                                </tr>
                                            <?php
                                            }
											
                                            ?>   
                                           <?php  if ($sch_setting->SSSMID) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('SSSMID'); ?></td>
                                                    <td><?php echo $student['SSSMID']; ?></td>
                                                </tr>
                                            <?php
                                            }
											
                                            ?>   
                                           <?php  if ($sch_setting->pen_no) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('pen_no'); ?></td>
                                                    <td><?php echo $student['pen_no']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->family_mid_no) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('family_mid_no'); ?></td>
                                                    <td><?php echo $student['family_mid_no']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->apar_id) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('apar_id'); ?></td>
                                                    <td><?php echo $student['apar_id']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->abc_id) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('abc_id'); ?></td>
                                                    <td><?php echo $student['abc_id']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->scholarship_form_no) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('scholarship_form_no'); ?></td>
                                                    <td><?php echo $student['scholarship_form_no']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->subject_option) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('subjects'); ?></td>
                                                    <td><?php echo $student['subject_names']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   
                                           <?php  if ($sch_setting->school_medium) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('school_medium'); ?></td>
                                                    <td><?php echo $student['school_medium']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>   


                                        <?php
                            if ($student['is_active'] == 'no') {
                            ?>
                                <tr class="list-group-item listnoback">
                                    <td><?php echo $this->lang->line('disable_reason'); ?></td> <td ><?php echo $reason_data['reason'] ?></td>
                                </tr>
                                <tr class="list-group-item listnoback">
                                    <td><?php echo $this->lang->line('disable_note'); ?></td> <td ><?php echo $student['dis_note'] ?></td>
                                </tr>
                                <tr class="list-group-item listnoback">
                                    <td><?php echo $this->lang->line('disable_date'); ?></td> <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['disable_at'])); ?></td>
                                </tr>
                            <?php } ?>
											
											<tr>
                                                    <td>Application No.</td>
                                                    <td><?php echo $student['application_no']; ?></td>
                                                </tr>
                                            <?php if ($sch_setting->admission_date) {
                                            ?>
                                                <tr>
                                                    <td width="35%"><?php echo $this->lang->line('admission_date'); ?></td>
                                                    <td class="col-md-5">
                                                        <?php
                                                        if (!empty($student['admission_date'])) {
                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat(date("Y-m-d", strtotime($student['admission_date']))));
                                                        }
                                                        ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('date_of_birth'); ?></td>
                                                <td><?php
                                                    if (!empty($student['dob']) && $student['dob'] != '0000-00-00') {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php if ($sch_setting->category) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('category'); ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($category_list as $value) {
                                                            if ($student['category_id'] == $value['id']) {
                                                                echo $value['category'];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->mobile_no) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('mobile_number'); ?></td>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->cast) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('caste'); ?></td>
                                                    <td><?php echo $student['cast']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            if ($sch_setting->religion) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('religion'); ?></td>
                                                    <td><?php echo $student['religion']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->student_email) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('email'); ?></td>
                                                    <td><?php echo $student['email']; ?></td>
                                                </tr>
                                            <?php }

                                            ?>
                                            <?php
                                            $cutom_fields_data = get_custom_table_values($student['id'], 'students');
                                            if (!empty($cutom_fields_data)) {
                                                foreach ($cutom_fields_data as $field_key => $field_value) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $field_value->name; ?></td>
                                                        <td>
                                                            <?php
                                                            if (is_string($field_value->field_value) && is_array(json_decode($field_value->field_value, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                                                                $field_array = json_decode($field_value->field_value);
                                                                echo "<ul class='student_custom_field'>";
                                                                foreach ($field_array as $each_key => $each_value) {
                                                                    echo "<li>" . $each_value . "</li>";
                                                                }
                                                                echo "</ul>";
                                                            } else {
                                                                $display_field = $field_value->field_value;

                                                                if ($field_value->type == "link") {
                                                                    $display_field = "<a href=" . $field_value->field_value . " target='_blank'>" . $field_value->field_value . "</a>";
                                                                }
                                                                echo $display_field;
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            }

                                            if ($sch_setting->student_note) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('note'); ?></td>
                                                    <td><?php echo $student['note']; ?></td>
                                                </tr>
                                            <?php
                                            }
											
                                            ?>
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tshadow mb25 bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table3 table-hover table-striped tmb0">
                                        <tbody>
                                            <?php if ($sch_setting->current_address) { ?>
                                                <tr>
                                                    <td width="35%"><?php echo $this->lang->line('current_address'); ?></td>
                                                    <td class="col-md-5"><?php echo $student['current_address']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->permanent_address) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('permanent_address'); ?></td>
                                                    <td><?php echo $student['permanent_address']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tshadow mb25 bozero">
                                <?php if (($sch_setting->father_name) || ($sch_setting->father_phone) || ($sch_setting->father_occupation) || ($sch_setting->father_pic) || ($sch_setting->mother_name) || ($sch_setting->mother_phone) || ($sch_setting->mother_occupation) || ($sch_setting->mother_pic) || ($sch_setting->guardian_name) || ($sch_setting->guardian_occupation) || ($sch_setting->guardian_relation) || ($sch_setting->guardian_phone) || ($sch_setting->guardian_email) || ($sch_setting->guardian_pic) || ($sch_setting->guardian_address)) {
                                ?>
                                    <h3 class="pagetitleh2"><?php echo $this->lang->line('parent_guardian_detail'); ?> </h3>
                                    <div class="table-responsive around10 pt10">
                                        <table class="table3 table-hover table-striped tmb0">
                                            <?php if ($sch_setting->father_name) {
                                            ?>
                                                <tr>
                                                    <td width="35%"><?php echo $this->lang->line('father_name'); ?></td>
                                                    <td class="col-md-5"><?php echo $student['father_name']; ?></td>
                                                    <td rowspan="3"><img class="profile-user-img img-responsive img-rounded" src="<?php
                                                                                                                                    if (!empty($student["father_pic"])) {
                                                                                                                                        echo $this->media_storage->getImageURL($student["father_pic"]);
                                                                                                                                    } else {
                                                                                                                                        echo $this->media_storage->getImageURL("uploads/student_images/no_image.png");
                                                                                                                                    }
                                                                                                                                    ?>"></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->father_phone) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('father_phone'); ?></td>
                                                    <td><?php echo $student['father_phone']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->father_occupation) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('father_occupation'); ?></td>
                                                    <td><?php echo $student['father_occupation']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->mother_name) {
                                            ?>
                                                <tr class="bordertop">
                                                    <td><?php echo $this->lang->line('mother_name'); ?></td>
                                                    <td><?php echo $student['mother_name']; ?></td>
                                                    <td rowspan="3"><img class="profile-user-img img-responsive img-rounded" src="<?php
                                                                                                                                    if (!empty($student["mother_pic"])) {
                                                                                                                                        echo $this->media_storage->getImageURL($student["mother_pic"]);
                                                                                                                                    } else {
                                                                                                                                        echo $this->media_storage->getImageURL("uploads/student_images/no_image.png");
                                                                                                                                    }
                                                                                                                                    ?>"></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->mother_phone) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('mother_phone'); ?></td>
                                                    <td><?php echo $student['mother_phone']; ?></td>

                                                </tr>
                                            <?php }
                                            if ($sch_setting->mother_occupation) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('mother_occupation'); ?></td>
                                                    <td><?php echo $student['mother_occupation']; ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr class="bordertop">
                                                <td><?php if ($sch_setting->guardian_name) { ?><?php echo $this->lang->line('guardian_name');
                                                                                            } ?></td>
                                                <td><?php if ($sch_setting->guardian_name) { ?><?php echo $student['guardian_name'];
                                                                                            } ?></td>
                                                <td rowspan="3">
                                                    <?php if ($sch_setting->guardian_pic) {
                                                    ?><img class="profile-user-img img-responsive img-rounded" src="<?php
                                                                        if (!empty($student["guardian_pic"])) {
                                                                            echo $this->media_storage->getImageURL($student["guardian_pic"]);
                                                                        } else {
                                                                            echo $this->media_storage->getImageURL("uploads/student_images/no_image.png");
                                                                        }
                                                                        ?>"> <?php } ?></td>
                                            </tr>
                                            <?php if ($sch_setting->guardian_email) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('guardian_email'); ?></td>
                                                    <td><?php echo $student['guardian_email']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->guardian_relation) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('guardian_relation'); ?></td>
                                                    <td><?php echo $student['guardian_relation']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->guardian_phone) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('guardian_phone'); ?></td>
                                                    <td><?php echo $student['guardian_phone']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->guardian_occupation) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('guardian_occupation'); ?></td>
                                                    <td><?php echo $student['guardian_occupation']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->guardian_address) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('guardian_address'); ?></td>
                                                    <td><?php echo $student['guardian_address']; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if ($sch_setting->route_list) {
                            ?>
                                <?php
                                if ($this->module_lib->hasActive('transport')) {

                                    if ($student['pickup_point_name'] != '') {
                                ?>
                                        <div class="tshadow mb25  bozero">
                                            <h3 class="pagetitleh2"><?php echo $this->lang->line('route_details'); ?></h3>
                                            <div class="table-responsive around10 pt0">
                                                <table class="table3 table-hover table-striped tmb0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="35%"><?php echo $this->lang->line('pick_up_point'); ?></td>
                                                            <td class="col-md-5"><?php echo $student['pickup_point_name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('route'); ?></td>
                                                            <td><?php echo $student['route_title']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('vehicle_number'); ?></td>
                                                            <td><?php echo $student['vehicle_no']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('driver_name'); ?></td>
                                                            <td><?php echo $student['driver_name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('driver_contact'); ?></td>
                                                            <td><?php echo $student['driver_contact']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <?php if ($sch_setting->hostel_id) {
                                if ($this->module_lib->hasActive('hostel')) {

                                    if ($student['hostel_room_id'] != 0) {
                            ?>
                                        <div class="tshadow mb25  bozero">
                                            <h3 class="pagetitleh2"><?php echo $this->lang->line('hostel_details'); ?></h3>
                                            <div class="table-responsive around10 pt0">
                                                <table class="table3 table-hover table-striped tmb0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="35%"><?php echo $this->lang->line('hostel'); ?></td>
                                                            <td><?php echo $student['hostel_name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('room_no'); ?></td>
                                                            <td><?php echo $student['room_no']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('room_type'); ?></td>
                                                            <td><?php echo $student['room_type']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <div class="tshadow mb25  bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table3 table-hover table-striped tmb0">
                                        <tbody>
                                            <?php if ($sch_setting->is_blood_group) { ?>
                                                <tr>
                                                    <td width="35%"><?php echo $this->lang->line('blood_group'); ?></td>
                                                    <td class="col-md-5"><?php echo $student['blood_group']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->is_student_house) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('house'); ?></td>
                                                    <td><?php echo $student['house_name']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->student_height) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('height'); ?></td>
                                                    <td><?php echo $student['height']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->student_weight) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('weight'); ?></td>
                                                    <td><?php echo $student['weight']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->measurement_date) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('measurement_date'); ?></td>
                                                    <td><?php
                                                        if (!empty($student['measurement_date']) && $student['measurement_date'] != '0000-00-00') {
                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['measurement_date']));
                                                        }
                                                        ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->previous_school_details) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('previous_school_details'); ?></td>
                                                    <td><?php echo $student['previous_school']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->previous_school_details) { ?>
                                                <tr>
                                                    <td>Previous School Medium</td>
                                                    <td><?php echo $student['previous_school_medium']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->last_class) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('last_class'); ?></td>
                                                    <td><?php echo $student['last_class']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->national_identification_no) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('national_identification_number'); ?></td>
                                                    <td class="col-md-5"><?php echo $student['adhar_no']; ?></td>
                                                </tr>
                                            <?php }
                                              if ($sch_setting->national_identification_no_aadhaar_no) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('national_identification_no_aadhaar_no'); ?></td>
                                                    <td><?php echo $student['adhar_no']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->local_identification_no) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('local_identification_number'); ?></td>
                                                    <td><?php echo $student['samagra_id']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->bank_account_no) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('bank_account_number'); ?></td>
                                                    <td><?php echo $student['bank_account_no']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->ifsc_code) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('bank_name'); ?></td>
                                                    <td><?php echo $student['bank_name']; ?></td>
                                                </tr>
                                            <?php }
                                            if ($sch_setting->ifsc_code) { ?>
                                                <tr>
                                                    <td><?php echo $this->lang->line('ifsc_code'); ?></td>
                                                    <td><?php echo $student['ifsc_code']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php if ($this->module_lib->hasModule('behaviour_records')) {
                        ?>
                            <!------- Behaviour Report Start-------->
                            <div class="tab-pane" id="incident">
                                <div class="no-border table-responsive overflow-visible-lg">
                                    <div class="download_label"><?php echo $this->lang->line('student_behaviour'); ?></div>
                                    <table class="table table-striped table-bordered table-hover example">

                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('title'); ?></th>
                                                <th><?php echo $this->lang->line('point'); ?></th>
                                                <th><?php echo $this->lang->line('date'); ?></th>
                                                <th><?php echo $this->lang->line('description'); ?></th>
                                                <th><?php echo $this->lang->line('assign_by'); ?></th>
                                                <th class="noExport"><?php echo $this->lang->line('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($assignstudent)) {
                                            ?>

                                                <?php
                                            } else {

                                                foreach ($assignstudent as $assignstudent_value) {
                                                    $staff_id = '';
                                                    if ($assignstudent_value['staff_employee_id'] != "") {
                                                        $staff_id = ' (' . $assignstudent_value['staff_employee_id'] . ')';
                                                    }

                                                    $pointclass = '';
                                                    if ($assignstudent_value['point'] < 0) {
                                                        $pointclass = 'danger';
                                                    }
                                                ?>
                                                    <tr class="<?php echo $pointclass; ?>">
                                                        <td><?php echo $assignstudent_value['title'] ?></td>
                                                        <td><?php echo $assignstudent_value['point'] ?></td>
                                                        <td><?php echo $this->customlib->dateformat($assignstudent_value['created_at']) ?></td>
                                                        <td width="40%"> <?php echo $assignstudent_value['description'] ?></td>
                                                        <td> <?php

                                                                if ($superadmin_visible == 'disabled') {

                                                                    if ($staffrole->id == 7) {
                                                                        echo $assignstudent_value['staff_name'] . ' ' . $assignstudent_value['staff_surname'] . $staff_id;
                                                                    } elseif ($assignstudent_value['role_id'] != 7) {
                                                                        echo $assignstudent_value['staff_name'] . ' ' . $assignstudent_value['staff_surname'] . $staff_id;
                                                                    }
                                                                } else {
                                                                    echo $assignstudent_value['staff_name'] . ' ' . $assignstudent_value['staff_surname'] . $staff_id;
                                                                }
                                                                ?></td>


                                                        <td>
                                                            <a class="btn btn-default btn-xs comments overflow-inherit" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $this->lang->line('comment'); ?>" data-record-id="<?php echo $assignstudent_value['id'] ?>">
                                                                <?php if ($assignstudent_value['totalcomments']['totalcomments'] != '0') { ?><span class="comment-badges"><?php echo $assignstudent_value['totalcomments']['totalcomments']; ?></span><?php } ?><i class="fa fa-comment"></i> </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!------- Behaviour Report End-------->
                        <?php } ?>


                        <!------- CBSE Exam Start-------->
                        <?php
                        if ($this->module_lib->hasModule('cbseexam')) {  ?>
                            <div class="tab-pane" id="cbseexam">
                                <div class="dt-buttons btn-group pull-right miusDM42">
                                    <a class="btn btn-default btn-xs dt-button no_print border0" id="print" data-toggle="tooltip" data-placement="bottom" title="Print" onclick="printDivCbse()"><i class="fa fa-print"></i></a>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <?php
                                        if (!empty($exams)) {
                                            foreach ($exams as $exam_key => $exam_value) {

                                                $total_marks = 0;
                                                $total_max_marks = 0;
                                        ?>

                                                <div class="shadow-sm mb30">
                                                    <h3 class="pagetitleh2 mt10 border-b-none pl-5"><?php echo  $exam_value->name; ?></h3>
                                                    <div class="table-responsive">
                                                        <?php
                                                        if (!empty($exam_value->subjects)) {
                                                        ?>
                                                            <table class="table table-bordered table-b mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="bolds">
                                                                            <?php echo $this->lang->line('subject'); ?>
                                                                        </td>
                                                                        <?php

                                                                        foreach ($exam_value->exam_assessments as $exam_assessment_key => $exam_assessment_value) {
                                                                        ?>
                                                                            <td class="text-center bolds">

                                                                                <?php $assessment_code = ($exam_assessment_value->code == "") ? "" : " (" . $exam_assessment_value->code . ")"; ?>
                                                                                <?php echo $exam_assessment_value->name . $assessment_code; ?>


                                                                                <br />
                                                                                (<?php echo $this->lang->line('max'); ?> <?php echo $exam_assessment_value->maximum_marks; ?>)
                                                                            </td>
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                        <td class="bolds">
                                                                            <?php echo $this->lang->line('total'); ?>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                    foreach ($exam_value->subjects as $subject_key => $subject_value) {
                                                                        $subject_total = 0;
                                                                    ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php $subject_code = ($subject_value->subject_code == "") ? "" : " (" . $subject_value->subject_code . ")"; ?>
                                                                                <?php echo $subject_value->subject_name . $subject_code; ?>
                                                                            </td>
                                                                            <?php
                                                                            foreach ($exam_value->exam_assessments as $exam_assessment_key => $exam_assessment_value) {

                                                                            ?>
                                                                                <td class="text-center">
                                                                                    <?php

                                                                                    $assessment_exists =  find_subject_assessment_exists($exam_value->exam_subject_assessments, $subject_value->id, $exam_assessment_value->id);

                                                                                    if ($assessment_exists) {
                                                                                        $assessment_array = findAssessmentValue($subject_value->subject_id, $exam_assessment_value->id, $exam_value);
                                                                                        echo ($assessment_array['is_absent']) ? $this->lang->line('abs') : $assessment_array['marks'];
                                                                                        if ($assessment_array['marks'] == "N/A") {
                                                                                            $assessment_array['marks'] = 0;
                                                                                        }
                                                                                        $subject_total += $assessment_array['marks'];
                                                                                        $total_max_marks += $assessment_array['maximum_marks'];
                                                                                        $total_marks += $assessment_array['marks'];
                                                                                    } else {
                                                                                        echo "<b>xx</b>";
                                                                                    }

                                                                                    ?>
                                                                                </td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <td class="bolds">
                                                                                <?php echo  two_digit_float($subject_total); ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </tbody>

                                                            </table>
                                                        <?php

                                                        }
                                                        if ($total_max_marks > 0) {
                                                            $exam_percentage = getPercent($total_max_marks, $total_marks);
                                                        } else {
                                                            $exam_percentage = 0;
                                                        }
                                                        ?>

                                                        <table class="table table-bordered table-b mb0 bg-gray-light">
                                                            <tr>
                                                                <td class="bolds"><?php echo $this->lang->line('total_marks'); ?> : <?php echo $total_marks . "/" . $total_max_marks; ?></td>
                                                                <td class="bolds"><?php echo $this->lang->line('percentage'); ?> (%) : <?php echo $exam_percentage; ?></td>
                                                                <td class="bolds"><?php echo $this->lang->line('grade'); ?> : <?php echo getGrade($exam_value->grades, $exam_percentage); ?></td>
                                                                <td class="bolds"><?php echo $this->lang->line('rank'); ?> : <?php echo $exam_value->rank; ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                            <?php

                                            }
                                        } else {
                                            ?>
                                            <div class="alert alert-info">
                                                <?php echo $this->lang->line('no_exam_assigned'); ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        ?>
                        <!------- CBSE Exam End--------->


                        <div class="tab-pane" id="fee">
                            <?php
                            if (empty($student_due_fee) && empty($student_discount_fee)) {
                            ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->lang->line('no_record_found'); ?>
                                </div>
                            <?php
                            } else {

                                foreach ($student_due_fee as $key => $student_due_feee) {
                              
                            ?>
<?php 
$coun = 0;
$student_due_feeee = $student_due_feee;
foreach ($student_due_feeee as $keyy => $feee) {

foreach ($feee->fees as $fee_keyy => $fee_valuee) {

$coun++;
    
}}

?>
                                               <?php if($coun > 0){        ?>       
                                                <fieldset>
                                                    <?php
                                                   $this->db->select('*')->from('sessions');
                                                   $this->db->where('sessions.id', $student_due_feee[0]->session);
                                                   $query = $this->db->get();
                                                       $dat = $query->row();
                                                
                                                ?>
                                                                                  <legend>Fees of session <?=  $dat->session ?></legend>
                                                                               
                                                                      

                                <!-- <div class=""> -->
                                <table class="table table-hover  example">
                                        <thead>
                                   
                                            <tr>
                                                <th><?php echo $this->lang->line('fees_group'); ?></th>
                                                <th><?php echo $this->lang->line('fees_code'); ?></th>
                                                <!-- <th class="text text-left"><?php echo $this->lang->line('due_date'); ?></th> -->
                                                <th class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                                <th class="text text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                                <!-- <th class="text text-right"><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th> -->
                                                <!-- <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th> -->
                                                <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-right"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_amount           = 0;
                                            $total_deposite_amount  = 0;
                                            $total_fine_amount      = 0;
                                            $total_discount_amount  = 0;
                                            $total_balance_amount   = 0;
                                            $alot_fee_discount      = 0;
                                            $total_fees_fine_amount = 0;

                                            foreach ($student_due_feee as $key => $fee) {

                                              
                                                foreach ($fee->fees as $fee_key => $fee_value) {



                                                    $this->db->select()->from('student_fees_master_head');
                                                    $this->db->where('student_fees_master_head.head_id', $fee_value->fee_groups_feetype_id);
                                                    $this->db->where('student_fees_master_head.fee_master_id', $fee_value->id);
                                                    $this->db->order_by('student_fees_master_head.id', 'desc');
                                                    $queryy = $this->db->get();
                                                    
                                                    if($queryy->num_rows() > 0) {
                                                        
                                                    $fee_paid          = 0;
                                                    $fee_discount      = 0;
                                                    $fee_fine          = 0;
                                                    $alot_fee_discount = 0;

                                                    if (!empty($fee_value->amount_detail)) {
                                                        $fee_deposits = json_decode(($fee_value->amount_detail));

                                                        foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            $fee_paid     = $fee_paid + $fee_deposits_value->amount;
                                                            $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                            $fee_fine     = $fee_fine + $fee_deposits_value->amount_fine;
                                                        }
                                                    }
                                                    $total_amount           = $total_amount + $fee_value->amount;
                                                    $total_discount_amount  = $total_discount_amount + $fee_discount;
                                                    $total_deposite_amount  = $total_deposite_amount + $fee_paid;
                                                    $total_fine_amount      = $total_fine_amount + $fee_fine;
                                                    $feetype_balance        = $fee_value->amount - ($fee_paid + $fee_discount);
                                                    $total_balance_amount   = $total_balance_amount + $feetype_balance;
                                                    $total_fees_fine_amount = $total_fees_fine_amount + $fee_value->fine_amount;
                                            ?>
                                                    <?php
                                                    if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                    ?>
                                                        <tr class="danger font12">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <tr class="dark-gray">
                                                        <?php
                                                    }
                                                        ?>
                                                        <td>
                                                            <?php
                                                            if ($fee_value->is_system) {
                                                                echo $this->lang->line($fee_value->name) . " (" . $this->lang->line($fee_value->type) . ")";
                                                            } else {
                                                                echo $fee_value->name . " (" . $fee_value->type . ")";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($fee_value->is_system) {
                                                                echo $this->lang->line($fee_value->code);
                                                            } else {
                                                                echo $fee_value->code;
                                                            }
                                                            ?>
                                                        </td>
                                                        <!-- <td class="text text-left">
                                                            <?php
                                                            if ($fee_value->due_date == "0000-00-00") {
                                                            } else {
                                                                if ($fee_value->due_date) {
                                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                                }
                                                            }
                                                            ?>
                                                        </td> -->
                                                        <td class="text text-left">
                                                            <?php
                                                            if ($feetype_balance == 0) {
                                                            ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                                                                } else if (!empty($fee_value->amount_detail)) {
                                                                                                    ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                                                                    } else {
                                                                                                        ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                                                                    }
                                                                                                    ?>
                                                        </td>
                                                        <td class="text text-right"><?php echo amountFormat($fee_value->amount);
                                                                                    if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                                                    ?>

                                                                <span data-toggle="popover" class="text text-danger detail_popover"><?php echo " + " . amountFormat($fee_value->fine_amount); ?></span>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php
                                                                                        if ($fee_value->fine_amount != "") {
                                                                    ?>
                                                                        <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>
                                                                    <?php
                                                                                        }
                                                                    ?>
                                                                </div>
                                                            <?php
                                                                                    }
                                                            ?>
                                                        </td>
                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>
                                                        <!-- <td class="text text-right"><?php
                                                                                    echo amountFormat($fee_discount);
                                                                                    ?></td> -->
                                                        <!-- <td class="text text-right"><?php
                                                                                    echo amountFormat($fee_fine);
                                                                                    ?></td> -->
                                                        <td class="text text-right"><?php
                                                                                    echo amountFormat($fee_paid);
                                                                                    ?></td>
                                                        <td class="text text-right"><?php
                                                                                    $display_none = "ss-none";
                                                                                    if ($feetype_balance > 0) {
                                                                                        $display_none = "";
                                                                                        echo amountFormat($feetype_balance);
                                                                                    }
                                                                                    ?>
                                                        </td>
                                                        </tr>
                                                        <?php
                                                        if (!empty($fee_value->amount_detail)) {

                                                            $fee_deposits = json_decode(($fee_value->amount_detail));

                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                                <tr class="white-td">
                                                                    <td class="text-left"></td>
                                                                    <td class="text-left"></td>
                                                                    <!-- <td class="text-left"></td> -->
                                                                    <td class="text-left"></td>
                                                                    <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                    <td class="text text-left">

                                                                        <a href="#" data-toggle="popover" class="detail_popover"> <?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                        <div class="fee_detail_popover" style="display: none">
                                                                            <?php
                                                                            if ($fee_deposits_value->description == "") {
                                                                            ?>
                                                                                <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text text-left"><?php echo $this->lang->line(strtolower($fee_deposits_value->payment_mode)); ?></td>
                                                                    <td class="text text-center">
                                                                        <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                    </td>
                                                                    <!-- <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount_discount); ?></td> -->
                                                                    <!-- <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount_fine); ?></td> -->
                                                                    <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount); ?></td>
                                                                    <td></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                <?php
                                                } } 
                                            }
                                                ?>

                                                <?php

                                                if (!empty($transport_fees)) {
                                                    foreach ($transport_fees as $transport_fee_key => $transport_fee_value) {

                                                        $fee_paid         = 0;
                                                        $fee_discount     = 0;
                                                        $fee_fine         = 0;
                                                        $fees_fine_amount = 0;
                                                        $feetype_balance  = 0;

                                                        if (!empty($transport_fee_value->amount_detail)) {
                                                            $fee_deposits = json_decode(($transport_fee_value->amount_detail));

                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                                $fee_paid     = $fee_paid + $fee_deposits_value->amount;
                                                                $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                                $fee_fine     = $fee_fine + $fee_deposits_value->amount_fine;
                                                            }
                                                        }

                                                        $feetype_balance = $transport_fee_value->fees - ($fee_paid + $fee_discount);

                                                        if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                            $fees_fine_amount       = is_null($transport_fee_value->fine_percentage) ? $transport_fee_value->fine_amount : percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                            $total_fees_fine_amount = $total_fees_fine_amount + $fees_fine_amount;
                                                        }

                                                        $total_amount += $transport_fee_value->fees;
                                                        $total_discount_amount += $fee_discount;
                                                        $total_deposite_amount += $fee_paid;
                                                        $total_fine_amount += $fee_fine;
                                                        $total_balance_amount += $feetype_balance;

                                                        if (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                ?>
                                                            <tr class="danger font12">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <tr class="dark-gray">
                                                            <?php
                                                        }
                                                            ?>
                                                            <td align="left"><?php echo $this->lang->line('transport_fees'); ?></td>
                                                            <td align="left"><?php echo $transport_fee_value->month; ?></td>
                                                            <td align="left" class="text text-left">
                                                                <?php echo $this->customlib->dateformat($transport_fee_value->due_date); ?> </td>
                                                            <td align="left" class="text text-left width85">
                                                                <?php
                                                                if ($feetype_balance == 0) {
                                                                ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                                                                } else if (!empty($transport_fee_value->amount_detail)) {
                                                                                                    ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                                                                    } else {
                                                                                                        ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                                                                    }
                                                                                                    ?>
                                                            </td>
                                                            <td class="text text-right"><?php echo amountFormat($transport_fee_value->fees);

                                                                                        if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                                                            $tr_fine_amount = $transport_fee_value->fine_amount;
                                                                                            if ($transport_fee_value->fine_type != "" && $transport_fee_value->fine_type == "percentage") {
                                                                                                $tr_fine_amount = percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                                                            }
                                                                                        ?>
                                                                    <span data-toggle="popover" class="text text-danger detail_popover"><?php echo " + " . amountFormat($tr_fine_amount); ?></span>
                                                                    <div class="fee_detail_popover" style="display: none">
                                                                        <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>

                                                                    </div>
                                                                <?php
                                                                                        }
                                                                ?>
                                                            </td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-right"><?php
                                                                                        echo amountFormat($fee_discount);
                                                                                        ?></td>
                                                            <td class="text text-right"><?php
                                                                                        echo amountFormat($fee_fine);
                                                                                        ?></td>
                                                            <td class="text text-right"><?php
                                                                                        echo amountFormat($fee_paid);
                                                                                        ?></td>
                                                            <td class="text text-right"><?php
                                                                                        $display_none = "ss-none";
                                                                                        if ($feetype_balance > 0) {
                                                                                            $display_none = "";

                                                                                            echo amountFormat($feetype_balance);
                                                                                        }
                                                                                        ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                            if (!empty($transport_fee_value->amount_detail)) {

                                                                $fee_deposits = json_decode(($transport_fee_value->amount_detail));

                                                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            ?>
                                                                    <tr class="white-td">
                                                                        <td align="left"></td>
                                                                        <td align="left"></td>
                                                                        <td align="left"></td>
                                                                        <td align="left"></td>
                                                                        <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                        <td class="text text-left">

                                                                            <a href="#" data-toggle="popover" class="detail_popover"> <?php echo $transport_fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                            <div class="fee_detail_popover" style="display: none">
                                                                                <?php
                                                                                if ($fee_deposits_value->description == "") {
                                                                                ?>
                                                                                    <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text text-left"><?php echo $this->lang->line(strtolower($fee_deposits_value->payment_mode)); ?></td>
                                                                        <td class="text text-left">
                                                                            <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                        </td>
                                                                        <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount_discount); ?></td>
                                                                        <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount_fine); ?></td>
                                                                        <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount); ?></td>
                                                                        <td></td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                    <?php
                                                    }
                                                }

                                                    ?>

                                                    <?php




$total_bulk_discount = $this->studentfeemaster_model->getStudent_bulkdiscounts_Sum([$fee->student_session_id]);



                                                    // if (!empty($student_discount_fee)) {

                                                    //     foreach ($student_discount_fee as $discount_key => $discount_value) {
                                                    ?>
                                                            <tr class="dark-light success" >

                                                               
                                                                <td align="left" colspan="1"  style="font-size: large;color: black;">Total <?php echo $this->lang->line('discount'); ?>:</td>
                                                                <td></td> <td></td>
                                                                <td style="font-size: large;color: black;" class="text-right"> <?= amountFormat($total_bulk_discount->discount) ?></td>
                                                                
                                                               
                                                                <td align="left" class="text text-left" colspan="4">
                                                                    
                                                           
                                                                      
                                                                   
                                                                </td>

                                                                <td align="center" class="text text-center">
                                                                
                                                                <a class="btn btn-info btn-xs detailed_discount" data-id="<?= $fee->student_session_id ?>">View</a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                    //     }
                                                    // }
                                                    ?>
                                                    <tr class="box box-solid total-bg">
                                                        <td></td>
                                                        <!-- <td></td> -->
                                                        <td></td>
                                                        <td class="text text-right"> </td>
                                                        <td class="text text-right">
                                                            <?php echo $currency_symbol . amountFormat($total_amount) . "<span data-toggle='popover' class='text text-danger detail_popover'>+" . amountFormat($total_fees_fine_amount) . "</span>";
                                                            ?>
                                                            <div class="fee_detail_popover" style="display: none">
                                                                <?php
                                                                if ($total_fees_fine_amount != "") {
                                                                ?>
                                                                    <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <!-- <td class="text text-right"><?php
                                                                                    echo ($currency_symbol . amountFormat($total_discount_amount + $alot_fee_discount));
                                                                                    ?></td> -->
                                                        <!-- <td class="text text-right"><?php
                                                                                    echo ($currency_symbol . amountFormat($total_fine_amount));
                                                                                    ?></td> -->
                                                        <td class="text text-right"><?php
                                                                                    echo ($currency_symbol . amountFormat($total_deposite_amount));
                                                                                    ?></td>

                                                        <td class="text text-right"><?php
                                                                                    echo ($currency_symbol . amountFormat($total_balance_amount - $alot_fee_discount));
                                                                                    ?></td>

                                                    </tr>
                                        </tbody>
                                    </table>
                               
                                <!-- </div> -->
                                </fieldset>
                                <?php }      ?>       
                            <?php
                            } }
                            ?>

                        </div>
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <?php if ($this->session->flashdata('msg') != '') {
                                ?>
                                    <div class="alert alert-success">
                                        <?php
                                        echo $this->session->flashdata('msg');
                                        $this->session->unset_userdata('msg');
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if ($this->rbac->hasPrivilege('student', 'can_add')) { ?>
                                    <button type="button" data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i> <?php echo $this->lang->line('upload_documents'); ?></button>
                                <?php } ?>
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-striped table-bordered table-hover">
                                    
                                        <div class="row" style="margin-right:0px;margin-left:0px ">
                                      
                                                <?php
                                                if (empty($student_doc)) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($student_doc as $value) {

                                                    ?>
                                                        <div class="col-md-3">
                                                            <div class="col-md-12 text-center" style="background-color: #72727233;font-weight: bold;"><?php echo $value['title']; ?></div>
                                                            <div><img src="<?php echo site_url('student/download/' . $value['student_id'] . "/" . $value['id']); ?>" style="width:-webkit-fill-available" /></div>
                                                            <div class="mailbox-date text-center white-space-nowrap" style="background-color: #72727233">
                                                                <a href="<?php echo site_url('student/download/' . $value['student_id'] . "/" . $value['id']); ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <?php if ($this->rbac->hasPrivilege('student', 'can_delete')) { ?>
                                                                    <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                        <i class="fa fa-remove"></i>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                          
                                    </table>
                                </div>
                            </div>
                            </table>
                        </div>
                        <div class="tab-pane" id="bookissued">
                        <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('book_issued'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                    <th>Sno.</th>
                                        <th><?php echo $this->lang->line('book_title'); ?></th>
                                        <th><?php echo $this->lang->line('book_number'); ?></th>
                                        <th><?php echo $this->lang->line('issue_date'); ?></th>
                                        <th><?php echo $this->lang->line('due_return_date'); ?></th>
                                        <th><?php echo $this->lang->line('return_date'); ?></th>
                                        <th>Fine</th>
                                        <th>Fine Status</th>
                                        <!-- <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                          <?php
                        if (empty($issued_books)) {
                            ?>
                                        <?php
            } else {

                $this->db->select('sch_settings.lib_fine');
                $this->db->from('sch_settings');
                $query = $this->db->get();    
                $result = $query->row();
                $FINE =  $result->lib_fine;




                $finee= 0;
                $count = 1;
                foreach ($issued_books as $book) {

                    ?>
                                            <tr>
                                            <td class="mailbox-name">
                                                    <?php echo $count ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_title'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_no'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['issue_date'])) ?></td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['duereturn_date'])) ?></td>
                                                <td class="mailbox-name">
                                                    <?php
if ($book['return_date'] != '') {
            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['return_date']));
        }
        ?></td>
                                   
                                 <td><?php 
                                  $now = time(); // or your date as well
                                 $your_date = strtotime(date('Y-m-d', $this->customlib->dateyyyymmddTodateformat($book['duereturn_date'])));
                                 $datediff = $now - $your_date;
                                 $DIFF = round($datediff / (60 * 60 * 24)) - 2;
                                //  echo  "hritk".$DIFF;die; 
                                 $acc_fine = $FINE * $DIFF;
                           //      if(($this->lang->line($memberList->member_type) == 'Student') && $book['fine_paid'] !== '1') {

                              
                                 $tot = $acc_fine;
                                 if($tot < 0){
                                    $tot = 0;
                                 }
if($book['fine_paid'] !== '1'){
  $finee = $finee + $tot;
}

if($book['is_returned'] == 2){
    $tot = $book['late_fine'] ;
}
                             
                             
                                 
                                 
                                 echo "Rs."." ".$tot;?></td>  
                                   
                                   <td>
                                    <?php

if($book['is_returned'] != 2){
                                    if($tot > 0){
                                    if($book['fine_paid'] == 1){ 
echo "<span style='color:green'>Paid</span>";
                                       
                                       
                                    }else{
                                        echo "<span style='color:red'>Unpaid</span>";
                                    }}else{
                                        echo "<span style='color:blue'>No Due</span>";
                                    }  }else{
                                        
                                        echo "<span style='color:red'>Book Lost</span>";
                                    }?>

                                </td>
                                   <!-- <td class="mailbox-date pull-right">
                                                    <?php if ($book['is_returned'] == 0) {
            ?>
                                                        <a href="#" class="btn btn-default btn-xs" data-id="<?= $tot ?>"  data-record-id="<?php echo $book['id'] ?>" data-record-member_id="<?php echo $memid; ?>" title="<?php echo $this->lang->line('return') . " " . $book['book_title'] ?>" data-toggle="modal" data-target="#confirm-return">
                                                            <i class="fa fa-mail-reply"></i>
                                                        </a>
                                                        <?php
}if(($book['fine_paid'] == 0) && ($book['is_returned'] == 1)){?>


     <a href="javascript:void(0)" class="btn btn-info btn-xs Remove_Fine"   data-id="<?php echo $book['id'] ?>"  title="Remove Fine">
                                                         Remove Fine
                                                        </a>
 <?php } 
        ?>
                                                </td> -->
                                            </tr>
                                            <?php
$count++;
    }
}
?>

<!-- <a class="pull-right text-aqua dynamic_calc">Rs. <?= $finee??0 ?></a> -->

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                        </div>

                        
                       <!-- new tab -->
                        <?php

$this->db->select()->from('libarary_members');
$this->db->where('member_id', $student['id']);
$this->db->where('member_type', 'student');
$query = $this->db->get();
 $libarary_members_data = $query->row();


 $this->db->select()->from('student_session');
 $this->db->where('id', $student['id']);
 $query = $this->db->get();
  $student_session_lib = $query->row();



  $this->db->select()->from('sessions');
  $this->db->where('id', $student_session_lib->session_id??'');
  $query = $this->db->get();
   $student_session_lib = $query->row();

   $this->db->select()->from('renew_data');
   $this->db->where('stu_id', $student['id']);
   $query = $this->db->get();
    $renewaldatas = $query->result();
                           
                        ?>


                       <div class="tab-pane" id="membership_renewals">
                        <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Library Membership Renewals</div>
                            <table class="table table-striped table-bordered table-hover example">
                                   <thead>
                                    <tr>
                                     <th>Sr</th>
                                     <th>Library Card Number</th>
                                     <th>Renewed On</th>
                                     <th>For Session</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($libarary_members_data){ ?>
                                        <tr>
                                     <td>1</td>
                                     <td><?= $libarary_members_data->library_card_no  ?></td>
                                     <td><?= date("d-m-Y", strtotime($libarary_members_data->libaray_card_date )); ?></td>
                                     <td><?= $student_session_lib->session ?></td>
</tr>             <?php } ?>
   <?php $abc= 1; foreach($renewaldatas as $renew){$abc++; 
    
    $this->db->select()->from('sessions');
    $this->db->where('id', $renew->session);
    $query = $this->db->get();
     $student_renew_lib = $query->row();
     ?>
  <tr>
  <td><?= $abc ?></td>
  <td><?= $libarary_members_data->library_card_no  ?></td>
  <td><?=  date("d-m-Y", strtotime($renew->created_at ))  ?></td>
  <td><?= $student_renew_lib->session ?></td>
</tr> 
<?php  }?>


                                    </tbody>

                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                        </div>

                    <!-- new tab -->

                    <?php

$this->db->select()->from('certificate_issue_details');

$this->db->where('studentid', $student['id']);
$this->db->order_by('id','desc');
$query =  $this->db->get();
$cetificatesissued = $query->result();


?>


                    <div class="tab-pane" id="certificateissued">
                        <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Certificates Issued</div>
                            <table class="table table-striped table-bordered table-hover example">
                                   <thead>
                                    <tr>
                                     <th>Sr</th>
                                     <th>Certificate Name</th>
                                     <th>Issued Date</th>
                                     <th>Remark</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($cetificatesissued){ ?>
                                     <?php } ?>
   <?php $abc= 0; foreach($cetificatesissued as $renew){$abc++; 
    
    $this->db->select()->from('certificates');
    $this->db->where('id', $renew->certificate_id);
    $query = $this->db->get();
     $cer = $query->row();
     ?>
  <tr>
  <td><?= $abc ?></td>
  <td><?= $cer->certificate_name  ?></td>
  <td><?=  date("d-m-Y", strtotime($renew->certificate_issue_date ))  ?></td>
  <td><?= $renew->certificate_remark ?></td>
</tr> 
<?php  }?>


                                    </tbody>

                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                        </div>














                  

                    </div>
                </div>
    </section>
</div>

<!-- student incident comments -->
<div class="modal fade" id="commentmodel" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header d-flex justify-content-between">
                <div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="box-title"><?php echo $this->lang->line('comments'); ?></h4>
                </div>
            </div>
            <div class="">
                <div class="modal-body pt0 pb0 relative bg-e6">
                    <form id="formadd" method="post" class="ptt10 mb10 place-italic" enctype="multipart/form-data">
                        <input type="hidden" name="student_incident_id" id="student_incident_id">
                        <div class="clearfix">
                            <div class="d-flex justify-content-between gap-1">
                                <textarea name="comment" cols="10" rows="2" placeholder="<?php echo $this->lang->line('type_your_comment'); ?>" class="form-control resize-auto border-radius-1 max-height-40"></textarea>

                                <button type="submit" class="btn btn-send pr10 overflow-inherit max-height-40" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('send') ?></button>
                            </div>
                        </div>
                    </form>
                    <div class="scroll-area-inside">
                        <ul class="user-progress">
                            <div id="messagedetails"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="student_detailed_dis" class="modal fade">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Discount Assigned Details</h4>
                </div>
                <div class="modal-body" id="student_detailed_diss">

                </div>
            </div>
    </div>
</div>

<script>
    $('.comments').click(function() {
        var student_incident_id = $(this).attr('data-record-id');
        $('#student_incident_id').val(student_incident_id);

        $('#commentmodel').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        getmessage(student_incident_id);
    })

    $("#formadd").on('submit', (function(e) {
        e.preventDefault();

        var student_incident_id = $('#student_incident_id').val();

        var $this = $(this).find("button[type=submit]:focus");
        $.ajax({
            url: "<?php echo site_url("behaviour/studentincidentcomments/addmessage"); ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(res) {
                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);

                } else {
                    successMsg(res.message);
                    $('#formadd')[0].reset();
                    getmessage(student_incident_id);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }

        });
    }));

    function getmessage(student_incident_id) {
        $('#messagedetails').html('');
        $.ajax({
            url: "<?php echo site_url("behaviour/studentincidentcomments/getmessage"); ?>",
            type: "POST",
            data: {
                student_incident_id: student_incident_id
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == "success") {
                    $('#messagedetails').html(res.page);
                } else {
                    $('#messagedetails').html('');
                }
            }
        });
    }

    function delete_comment(id, student_incident_id) {
        if (confirm("<?php echo $this->lang->line('delete_confirm'); ?>") == true) {
            $.ajax({
                url: "<?php echo site_url("behaviour/studentincidentcomments/delete_comment"); ?>",
                type: "POST",
                data: {
                    id: id
                },
                success: function(res) {
                    getmessage(student_incident_id);
                }
            });
        }
    }
</script>

<script type="text/javascript">
    $("#myTimelineButton").click(function() {
        $("#reset").click();
        $('.transport_fees_title').html("<b><?php echo $this->lang->line('add_timeline'); ?></b>");
        $(".dropify-clear").click();
        $('#myTimelineModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });

    $(".myTransportFeeBtn").click(function() {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b><?php echo $this->lang->line('upload_documents'); ?></b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });
</script>
<div class="modal fade" id="myTimelineModal" role="dialog">
    <div class="modal-dialog modal-sm400">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                    <form id="timelineform" name="timelineform" method="post" enctype="multipart/form-data">
                        <div class="modal-body pb0">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div id='timeline_hide_show' class="row">
                                <input type="hidden" name="student_id" value="<?php echo $student["id"] ?>" id="student_id">
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                        <input id="timeline_title" name="timeline_title" placeholder="" type="text" class="form-control" />
                                        <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input id="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getSchoolDateFormat())); ?>" name="timeline_date" placeholder="" type="text" class="form-control date" />
                                        <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea id="timeline_desc" name="timeline_desc" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <div class=""><input id="timeline_doc_id" name="timeline_doc" placeholder="" type="file" class="filestyle form-control" data-height="40" value="<?php echo set_value('timeline_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="labeltopmb0"><?php echo $this->lang->line('visible_to_this_person'); ?></label>
                                        <input class="valign-top" id="visible_check" checked="checked" name="visible_check" value="yes" placeholder="" type="checkbox" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                            <button type="reset" id="reset" style="display: none" class="btn btn-info pull-right"><?php echo $this->lang->line('reset'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog modal-sm400">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <input type="hidden" class="form-control" id="transport_student_session_id" value="0" readonly="readonly" />
                        <form id="form1" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="modal-body pt0 pb0">
                                <div id='upload_documents_hide_show'>
                                    <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?><small class="req"> *</small></label>
                                        <input id="first_title" name="first_title" placeholder="" type="text" class="form-control" value="<?php echo set_value('first_title'); ?>" />
                                        <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('documents'); ?><small class="req"> *</small></label>
                                        <div class=""><input id="first_doc_id" name="first_doc" placeholder="" type="file" class="filestyle form-control" data-height="40" value="<?php echo set_value('first_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="clear:both">
                                <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title_logindetail"></h4>
            </div>
            <div class="modal-body_logindetail">
            </div>
            <div class="modal-footer clearboth">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disable_modal" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('disable_student') ?></h4>
            </div>
            <form role="form" id="disable_form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label><small class="req"> *</small>

                                        <input type="hidden" name="student_id" id="disstudent_id">
                                        <select class="form-control" name="reason" id="reason">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php
                                            foreach ($reason as $value) {
                                            ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['reason'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                        <input name="disable_date" id="disable_date" class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" type="text" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right paddA10">
                        <button class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- cutom -->
<div class="modal fade" id="dropout_modal" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Dropout Student</h4>
            </div>
            <form role="form" id="dropout_form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label><small class="req"> *</small>

                                        <input type="hidden" name="student_id" id="disstudent_idd">
                                        <select class="form-control" name="reason" id="reason">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php
                                            foreach ($reason as $value) {
                                            ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['reason'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                        <input name="disable_date" id="disable_date" class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" type="text" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right paddA10">
                        <button class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- cutom -->

<div class="modal fade" id="edittimelineModal" role="dialog">
    <div class="modal-dialog modal-sm400">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_timeline'); ?></h4>
            </div>
            <form id="edittimelineform" name="timelineform" method="post" action="<?php echo base_url() . "admin/timeline/add_staff_timeline" ?>" enctype="multipart/form-data">
                <div class="modal-body pb0">
                    <?php echo $this->customlib->getCSRF(); ?>
                    <div id="edittimelinedata"></div>
                </div>
                <div class="modal-footer" style="clear:both">
                    <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                    <button type="reset" id="reset" style="display: none" class="btn btn-info pull-right"><?php echo $this->lang->line('reset'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#myTransportFeesModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
            $(".dropify-clear").click();
        })
    });

    $("#timelineform").on('submit', (function(e) {
        e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");
        $.ajax({
            url: "<?php echo site_url("admin/timeline/add") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));

    function delete_timeline(id) {
        var student_id = $("#student_id").val();
        if (confirm('<?php echo $this->lang->line("delete_confirm") ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/timeline/delete_timeline/',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.status == 'success') {
                        successMsg(res.message);
                        window.location.reload(true);
                    }
                },
                error: function() {
                    alert("<?php echo $this->lang->line('fail'); ?>");
                }
            });
        }
    }

    function disable_student(id) {
        if (confirm("Are you sure you_want to disable this student")) {
            $('#disstudent_id').val(id);
            $('#disable_modal').modal('show');
            $('#note').val('');
            $('#reason').val('');
        }
    }

    function dropout_student(id) {
        if (confirm("Are you sure you want to dropout this student")) {
        $('#disstudent_idd').val(id);
        $('#dropout_modal').modal('show');
        $('#note').val('');
        $('#reason').val('');
    }
}



    $("#disable_form").on('submit', (function(e) {
        e.preventDefault();
        var id = $('#disstudent_id').val();
        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/disable_reason") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');

            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again') ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));


    
    $("#dropout_form").on('submit', (function(e) {
        e.preventDefault();
        var id = $('#disstudent_id').val();
        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/dropout_reason") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');

            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again') ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));




    function disable(id) {
        if (confirm("<?php echo $this->lang->line('are_you_sure_you_want_to_disable_this_student') ?>")) {
            var student_id = '<?php echo $student["id"] ?>';
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {
                    'student_id': student_id
                },
                dataType: "json",
                success: function(response) {
                    var userid = response.id;
                    changeStatus(userid, 'no', 'student');
                }
            });
        } else {
            return false;
        }
    }

    function enable(id, status, role) {
        if (confirm("<?php echo $this->lang->line('are_you_sure_you_want_to_enable_this_record'); ?>")) {
            var student_id = '<?php echo $student["id"] ?>';

            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {
                    'student_id': student_id
                },
                dataType: "json",
                success: function(response) {

                    var userid = response.id;
                    changeStatus(userid, 'yes', 'student');
                }
            });

            $.ajax({
                type: "post",
                url: base_url + "student/enablestudent/" + student_id,
                data: {
                    'student_id': student_id
                },
                dataType: "json",
                success: function(data) {
                    window.location.reload(true);

                }
            });

        } else {
            return false;
        }
    }

    function dropout_disable(id) {

        // alert(id);
        if (confirm("Are you sure you want to enable dropout this record")) {
            var student_id = '<?php echo $student["id"] ?>';

            // $.ajax({
            //     type: "post",
            //     url: base_url + "student/getUserLoginDetails",
            //     data: {
            //         'student_id': student_id
            //     },
            //     dataType: "json",
            //     success: function(response) {

            //         var userid = response.id;
            //         changeStatus(userid, 'yes', 'student');
            //     }
            // });

            $.ajax({
                type: "post",
                url: base_url + "student/disabledropout/" + student_id,
                data: {
                    'student_id': student_id
                },
                dataType: "json",
                success: function(data) {
                    window.location.reload(true);

                }
            });

        } else {
            return false;
        }
    }



    function changeStatus(rowid, status = 'no', role = 'student') {
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "POST",
            url: base_url + "admin/users/changeStatus",
            data: {
                'id': rowid,
                'status': status,
                'role': role
            },
            dataType: "json",
            success: function(data) {
                successMsg(data.msg);
            }
        });
    }

    $(document).ready(function() {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });

    function send_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_session_id = '<?php echo $student['student_session_id']; ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $student['username']; ?>';
        var password = '<?php echo $student['password']; ?>';
        var contact_no = '<?php echo $student['mobileno']; ?>';
        var email = '<?php echo $student['email']; ?>';
        var admission_no = '<?php echo $student['admission_no']; ?>';

        $.ajax({
            type: "post",
            url: base_url + "student/sendpassword",
            data: {
                student_id: student_id,
                username: username,
                password: password,
                contact_no: contact_no,
                email: email,
                admission_no: admission_no,
                student_session_id: student_session_id
            },
            success: function(response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent'); ?>');
            }
        });
    }

    function send_parent_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var student_session_id = '<?php echo $student['student_session_id']; ?>';
        var username = '<?php echo $guardian_credential['username']; ?>';
        var password = '<?php echo $guardian_credential['password']; ?>';
        var contact_no = '<?php echo $student['guardian_phone']; ?>';
        var email = '<?php echo $student['guardian_email']; ?>';
        var admission_no = '<?php echo $student['admission_no']; ?>';

        $.ajax({
            type: "post",
            url: base_url + "student/send_parent_password",
            data: {
                student_id: student_id,
                username: username,
                password: password,
                contact_no: contact_no,
                email: email,
                admission_no: admission_no,
                student_session_id: student_session_id
            },
            success: function(response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent'); ?>');
            }
        });
    }

    $(document).on('click', '.schedule_modal', function() {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_name = '<?php echo $this->customlib->getFullName($student["firstname"], $student["middlename"], $student["lastname"], $sch_setting->middlename, $sch_setting->lastname); ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {
                'student_id': student_id
            },
            dataType: "json",
            success: function(response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive pb10">';
                data += '<p class="lead text text-center ptt10">' + student_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function(i, obj) {
                    data += '<tr>';
                    data += '<td><b>' + (obj.role) + '</b></td>';
                    data += '<input type=hidden name=userid id=userid value=' + obj.id + '>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;padding-left: 5px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

    $(document).ready(function() {
        getExamResult();
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });

    $(document).ready(function() {
        $('#disable_modal,#scheduleModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false

        });
    });

    function getExamResult(student_session_id) {
        if (student_session_id != "") {
            $('.examgroup_result').html("");

            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getStudentCurrentResult",
                data: {
                    'student_session_id': 17
                },
                dataType: "JSON",
                beforeSend: function() {

                },
                success: function(data) {
                    $('.examgroup_result').html(data.result);
                },
                complete: function() {

                }
            });
        }
    }
</script>

<script type="text/javascript">
    $(document).on('change', '#exam_group_id', function() {
        var exam_group_id = $(this).val();
        if (exam_group_id != "") {
            $('#exam_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: baseurl + "admin/examgroup/getExamsByExamGroup",
                data: {
                    'exam_group_id': exam_group_id
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function(data) {
                    console.log(data);
                    $.each(data.result, function(i, obj) {
                        div_data += "<option value=" + obj.id + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
                complete: function() {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    });

    // this is the id of the form
    $("form#form_examgroup").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        var submit_button = $("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function() {
                submit_button.button('loading');
            },
            success: function(data) {
                $('.examgroup_result').html(data.result);
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again') ?>");
                submit_button.button('reset');
            },
            complete: function() {
                submit_button.button('reset');
            }
        });
    });

    $("#form1").on('submit', (function(e) {
        e.preventDefault();

        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/create_doc") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);

                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));
</script>

<script>
    $('.edit_timeline').click(function() {
        $('#edittimelineModal').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo site_url("admin/timeline/getstudentsingletimeline") ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#edittimelinedata').html(response.page);
            }
        });
    })

    $("#edittimelineform").on('submit', (function(e) {
        e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");
        $.ajax({
            url: "<?php echo site_url("admin/timeline/editstudenttimeline") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));

    function ajax_attendance(id, year) {
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'student/ajax_attendance/',
            type: 'POST',
            data: {
                id: id,
                year: year
            },
            success: function(result) {
                $("#ajaxattendance").html(result);
            }
        });
    }
</script>

<script type="text/javascript">
    function printDiv() {
        $("#visible").removeClass("hide");
        $("#exam_student_name").removeClass("hide");

        document.getElementById("print").style.display = "none";
        var divElements = document.getElementById('visible').innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;
        location.reload(true);
    }

    function printDivCbse() {


        document.getElementById("cbseexam").style.display = "none";
        var divElements = document.getElementById('cbseexam').innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;
        location.reload(true);
    }
</script>


<script>
            $(document).on('click', '.detailed_discount', function () {
                $bcd = parseInt($(this).attr('data-id'));
                var $this = $(this);
                $.ajax({
                type: 'POST',
                url: base_url + "studentfee/getStudent_bulkdiscounts/"+$bcd,
                // data: {'data': $bcd},
                // dataType: "JSON",
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {
                    
                    
                    $("#student_detailed_diss").html(data);
                    $("#student_detailed_dis").modal('show');
                    $this.button('reset');
                },
                error: function (xhr) { // if error occured
                    alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

                },
                complete: function () {
                    $this.button('reset');
                }
            });

});
</script>

<?php
function findGradePoints($exam_grade, $exam_type, $percentage)
{
    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type) {

            if (!empty($exam_grade_value['exam_grade_values'])) {
                foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                    if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                        return $grade_value->point;
                    }
                }
            }
        }
    }
    return 0;
}

function findExamGrade($exam_grade, $exam_type, $percentage)
{
    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type) {

            if (!empty($exam_grade_value['exam_grade_values'])) {
                foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                    if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                        return $grade_value->name;
                    }
                }
            }
        }
    }
    return "";
}

function findExamDivision($marks_division, $percentage)
{
    if (!empty($marks_division)) {
        foreach ($marks_division as $division_key => $division_value) {
            if ($division_value->percentage_from >= $percentage && $division_value->percentage_to <= $percentage) {
                return $division_value->name;
            }
        }
    }

    return "";
}

function getConsolidateRatio($exam_connection_list, $examid, $get_marks, $exam_get_percentage)
{
    if (!empty($exam_connection_list)) {
        foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {

            if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                return [
                    'exam_weightage'      => $exam_connection_value->exam_weightage,
                    'exam_consolidate_marks'      => ($get_marks * $exam_connection_value->exam_weightage) / 100,
                    'exam_consolidate_percentage' => ($exam_get_percentage * $exam_connection_value->exam_weightage) / 100
                ];
            }
        }
    }
    return 0;
}

function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type)
{
    $object               = new stdClass();
    $return_total_points  = 0;
    $return_total_exams   = 0;
    $return_max_marks     = 0;
    $return_quality_point = 0;
    $return_get_marks     = 0;
    $return_credit_hours  = 0;
    if (!empty($array)) {

        if (!empty($array['exam_result_' . $exam_id])) {

            foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
                $return_total_exams++;
                $percentage_grade    = ($exam_value->get_marks * 100) / $exam_value->max_marks;
                $point               = findGradePoints($exam_grade, $exam_type, $percentage_grade);
                $return_total_points = $return_total_points + $point;
                $return_quality_point += ($point * $exam_value->credit_hours);
                $return_credit_hours += $exam_value->credit_hours;
                $return_max_marks += $exam_value->max_marks;
                $return_get_marks += $exam_value->get_marks;
            }
        }
    }

    $object->total_max_marks      = $return_max_marks;
    $object->total_get_marks      = $return_get_marks;
    $object->total_points         = $return_total_points;
    $object->total_exams          = $return_total_exams;
    $object->return_quality_point = $return_quality_point;
    $object->return_credit_hours  = $return_credit_hours;

    return $object;
}

function getCalculatedExam($array, $exam_id)
{
    $object              = new stdClass();
    $return_max_marks    = 0;
    $return_get_marks    = 0;
    $return_credit_hours = 0;
    $return_exam_status  = false;
    if (!empty($array)) {
        $return_exam_status = 'pass';
        if (!empty($array['exam_result_' . $exam_id])) {
            foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {

                if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                    $return_exam_status = "fail";
                }

                $return_max_marks    = $return_max_marks + ($exam_value->max_marks);
                $return_get_marks    = $return_get_marks + ($exam_value->get_marks);
                $return_credit_hours = $return_credit_hours + ($exam_value->credit_hours);
            }
        }
    }
    $object->credit_hours = $return_credit_hours;
    $object->get_marks    = $return_get_marks;
    $object->max_marks    = $return_max_marks;
    $object->exam_status  = $return_exam_status;
    return $object;
}

//-----------CBSE Exam start----------------------

function find_subject_assessment_exists($subject_assessments, $cbse_exam_timetable_id, $cbse_exam_assessment_type_id)
{

    if (!empty($subject_assessments)) {
        foreach ($subject_assessments as $key => $value) {
            if ($value->id == $cbse_exam_timetable_id) {
                if (!empty($value->subject_assessments)) {
                    foreach ($value->subject_assessments as $askey => $asvalue) {
                        if ($asvalue->cbse_exam_timetable_id == $cbse_exam_timetable_id  && $asvalue->cbse_exam_assessment_type_id == $cbse_exam_assessment_type_id) {
                            return true;
                            break;
                        }
                    }
                }
            }
        }
    }
    return false;
}

function getGrade($grade_array, $Percentage)
{

    if (!empty($grade_array)) {
        foreach ($grade_array as $grade_key => $grade_value) {

            if ($grade_value->minimum_percentage <= $Percentage) {
                return $grade_value->name;
                break;
            } elseif (($grade_value->minimum_percentage >= $Percentage && $grade_value->maximum_percentage <= $Percentage)) {

                return $grade_value->name;
                break;
            }
        }
    }
    return "-";
}

function findAssessmentValue($find_subject_id, $find_cbse_exam_assessment_type_id, $student_value)
{
    $return_array = [
        'maximum_marks' => "",
        'marks' => "",
        'note' => "",
        'is_absent' => "",
    ];

    if (property_exists($student_value, 'subjects')) {

        if (array_key_exists($find_subject_id, $student_value->exam_data['subjects'])) {

            $result_array = ($student_value->exam_data['subjects'][$find_subject_id]['exam_assessments'][$find_cbse_exam_assessment_type_id]);

            $return_array = [
                'maximum_marks' => $result_array['maximum_marks'],
                'marks' => is_null($result_array['marks']) ? "N/A" : $result_array['marks'],
                'note' => $result_array['note'],
                'is_absent' => $result_array['is_absent'],
            ];
        }
    }

    return $return_array;
}




//-----------CBSE Exam End----------------------
