<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Systemfield extends Admin_Controller
{

    public $custom_fields_list = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->load->model("student_edit_field_model");
        $this->custom_fields_list = $this->config->item('custom_fields');
        $this->custom_field_table = $this->config->item('custom_field_table');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('system_fields', 'can_view')) {
            access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'System Settings/systemfield');
        $data['result'] = $this->setting_model->getSetting();
        $this->load->view('layout/header');
        $this->load->view('admin/systemfield/index', $data);
        $this->load->view('layout/footer');
    }

    public function changeStatus()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');
        $role   = $this->input->post('role');

        $data = array('id' => $id);

        if ($role == 'is_student_house') {
            if ($status == "yes") {
                $data['is_student_house'] = 1;
            } else {
                $data['is_student_house'] = 0;
            }
        } 
        else if ($role == 'roll_number_req') {
            if ($status == "yes") {
                $data['roll_number_req'] = 1;
            } else {
                $data['roll_number_req'] = 0;
            }
        } 

        else if ($role == 'roll_no') {
            if ($status == "yes") {
                $data['roll_no'] = 1;
            } else {
                $data['roll_no'] = 0;
            }
        } 
        else if ($role == 'application_no') {
            if ($status == "yes") {
                $data['application_no'] = 1;
            } else {
                $data['application_no'] = 0;
            }
        } 
        else if ($role == 'application_no_req') {
            if ($status == "yes") {
                $data['application_no_req'] = 1;
            } else {
                $data['application_no_req'] = 0;
            }
        } 
        else if ($role == 'previous_medium') {
            if ($status == "yes") {
                $data['previous_medium'] = 1;
            } else {
                $data['previous_medium'] = 0;
            }
        } 
        else if ($role == 'previous_medium_req') {
            if ($status == "yes") {
                $data['previous_medium_req'] = 1;
            } else {
                $data['previous_medium_req'] = 0;
            }
        } 
        else if ($role == 'school_medium_req') {
            if ($status == "yes") {
                $data['school_medium_req'] = 1;
            } else {
                $data['school_medium_req'] = 0;
            }
        } 
        else if ($role == 'last_class_req') {
            if ($status == "yes") {
                $data['last_class_req'] = 1;
            } else {
                $data['last_class_req'] = 0;
            }
        } 

        else if ($role == 'enrollment_no_req') {
            if ($status == "yes") {
                $data['enrollment_no_req'] = 1;
            } else {
                $data['enrollment_no_req'] = 0;
            }
        } 
        else if($role == 'enrollment_no'){  // new field no 1
             if ($status == "yes") {
                $data['enrollment_no'] = 1;
            } else {
                $data['enrollment_no'] = 0;
            }
         } 
        // else if($role == 'class'){  // new field no 2
        //      if ($status == "yes") {
        //         $data['class'] = 1;
        //     } else {
        //         $data['class'] = 0;
        //     }
        // } 
        // else if($role == 'section'){  // new field no 3
        //      if ($status == "yes") {
        //         $data['section'] = 1;
        //     } else {
        //         $data['section'] = 0;
        //     }
        // } 
        else if($role == 'SSSMID'){  // new field no 4
             if ($status == "yes") {
                $data['SSSMID'] = 1;
            } else {
                $data['SSSMID'] = 0;
            }
        } 
        else if($role == 'sssmid_req'){  
             if ($status == "yes") {
                $data['sssmid_req'] = 1;
            } else {
                $data['sssmid_req'] = 0;
            }
        } 
        else if($role == 'pen_number_req'){  
             if ($status == "yes") {
                $data['pen_number_req'] = 1;
            } else {
                $data['pen_number_req'] = 0;
            }
        } 
        else if($role == 'family_mid_number_req'){  
             if ($status == "yes") {
                $data['family_mid_number_req'] = 1;
            } else {
                $data['family_mid_number_req'] = 0;
            }
        } 
        else if($role == 'abc_id_req'){  
             if ($status == "yes") {
                $data['abc_id_req'] = 1;
            } else {
                $data['abc_id_req'] = 0;
            }
        } 
        else if($role == 'apar_id_req'){  
             if ($status == "yes") {
                $data['apar_id_req'] = 1;
            } else {
                $data['apar_id_req'] = 0;
            }
        } 
        else if($role == 'pen_no'){  // new field no 5
             if ($status == "yes") {
                $data['pen_no'] = 1;
            } else {
                $data['pen_no'] = 0;
            }
        } 
        else if($role == 'scholar_ship_form_req'){  // new field no 5
             if ($status == "yes") {
                $data['scholar_ship_form_req'] = 1;
            } else {
                $data['scholar_ship_form_req'] = 0;
            }
        } 
        else if($role == 'middle_name_req'){  
             if ($status == "yes") {
                $data['middle_name_req'] = 1;
            } else {
                $data['middle_name_req'] = 0;
            }
        } 
        else if($role == 'last_name_req'){  
             if ($status == "yes") {
                $data['last_name_req'] = 1;
            } else {
                $data['last_name_req'] = 0;
            }
        } 
        else if($role == 'category_req'){  
             if ($status == "yes") {
                $data['category_req'] = 1;
            } else {
                $data['category_req'] = 0;
            }
        } 
        else if($role == 'religion_req'){  
             if ($status == "yes") {
                $data['religion_req'] = 1;
            } else {
                $data['religion_req'] = 0;
            }
        } 
        else if($role == 'caste_req'){  
             if ($status == "yes") {
                $data['caste_req'] = 1;
            } else {
                $data['caste_req'] = 0;
            }
        } 
        else if($role == 'city_req'){  
             if ($status == "yes") {
                $data['city_req'] = 1;
            } else {
                $data['city_req'] = 0;
            }
        } 
        else if($role == 'city'){  
             if ($status == "yes") {
                $data['city'] = 1;
            } else {
                $data['city'] = 0;
            }
        } 
        else if($role == 'state'){  
             if ($status == "yes") {
                $data['state'] = 1;
            } else {
                $data['state'] = 0;
            }
        } 
        else if($role == 'state_req'){  
             if ($status == "yes") {
                $data['state_req'] = 1;
            } else {
                $data['state_req'] = 0;
            }
        } 
        else if($role == 'subject_option'){  
             if ($status == "yes") {
                $data['subject_option'] = 1;
            } else {
                $data['subject_option'] = 0;
            }
        } 
        else if($role == 'subject_option_req'){  
             if ($status == "yes") {
                $data['subject_option_req'] = 1;
            } else {
                $data['subject_option_req'] = 0;
            }
        } 
        else if($role == 'mobile_number_req'){  
             if ($status == "yes") {
                $data['mobile_number_req'] = 1;
            } else {
                $data['mobile_number_req'] = 0;
            }
        } 
        else if($role == 'email_req'){  
             if ($status == "yes") {
                $data['email_req'] = 1;
            } else {
                $data['email_req'] = 0;
            }
        } 
        else if($role == 'admission_date_req'){  
             if ($status == "yes") {
                $data['admission_date_req'] = 1;
            } else {
                $data['admission_date_req'] = 0;
            }
        } 
        else if($role == 'student_photo_req'){  
             if ($status == "yes") {
                $data['student_photo_req'] = 1;
            } else {
                $data['student_photo_req'] = 0;
            }
        } 
        else if($role == 'is_student_house_req'){  
             if ($status == "yes") {
                $data['is_student_house_req'] = 1;
            } else {
                $data['is_student_house_req'] = 0;
            }
        } 
        else if($role == 'blood_group_req'){  
             if ($status == "yes") {
                $data['blood_group_req'] = 1;
            } else {
                $data['blood_group_req'] = 0;
            }
        } 
        else if($role == 'stuent_height_req'){  
             if ($status == "yes") {
                $data['stuent_height_req'] = 1;
            } else {
                $data['stuent_height_req'] = 0;
            }
        } 
        else if($role == 'student_weight_req'){  
             if ($status == "yes") {
                $data['student_weight_req'] = 1;
            } else {
                $data['student_weight_req'] = 0;
            }
        } 
        else if($role == 'father_name_req'){  
             if ($status == "yes") {
                $data['father_name_req'] = 1;
            } else {
                $data['father_name_req'] = 0;
            }
        } 
        else if($role == 'father_phone_req'){  
             if ($status == "yes") {
                $data['father_phone_req'] = 1;
            } else {
                $data['father_phone_req'] = 0;
            }
        } 
        else if($role == 'father_occupation_req'){  
             if ($status == "yes") {
                $data['father_occupation_req'] = 1;
            } else {
                $data['father_occupation_req'] = 0;
            }
        } 
        else if($role == 'father_photo_req'){  
             if ($status == "yes") {
                $data['father_photo_req'] = 1;
            } else {
                $data['father_photo_req'] = 0;
            }
        } 
        else if($role == 'mather_name_req'){  
             if ($status == "yes") {
                $data['mather_name_req'] = 1;
            } else {
                $data['mather_name_req'] = 0;
            }
        } 
        else if($role == 'mather_phone_req'){  
             if ($status == "yes") {
                $data['mather_phone_req'] = 1;
            } else {
                $data['mather_phone_req'] = 0;
            }
        } 
        else if($role == 'mather_occupation_req'){  
             if ($status == "yes") {
                $data['mather_occupation_req'] = 1;
            } else {
                $data['mather_occupation_req'] = 0;
            }
        } 
        else if($role == 'mather_photo_req'){  
             if ($status == "yes") {
                $data['mather_photo_req'] = 1;
            } else {
                $data['mather_photo_req'] = 0;
            }
        } 
        else if($role == 'gurdian_phone_req'){  
             if ($status == "yes") {
                $data['gurdian_phone_req'] = 1;
            } else {
                $data['gurdian_phone_req'] = 0;
            }
        } 
        // gurdian_religion_req is relation
        else if($role == 'gurdian_religion_req'){  
             if ($status == "yes") {
                $data['gurdian_religion_req'] = 1;
            } else {
                $data['gurdian_religion_req'] = 0;
            }
        } 
        else if($role == 'gurdian_email_req'){  
             if ($status == "yes") {
                $data['gurdian_email_req'] = 1;
            } else {
                $data['gurdian_email_req'] = 0;
            }
        } 
        else if($role == 'gurdian_occupation_req'){  
             if ($status == "yes") {
                $data['gurdian_occupation_req'] = 1;
            } else {
                $data['gurdian_occupation_req'] = 0;
            }
        } 
        else if($role == 'gurdian_photo_req'){  
             if ($status == "yes") {
                $data['gurdian_photo_req'] = 1;
            } else {
                $data['gurdian_photo_req'] = 0;
            }
        } 
        else if($role == 'gurdian_address_req'){  
             if ($status == "yes") {
                $data['gurdian_address_req'] = 1;
            } else {
                $data['gurdian_address_req'] = 0;
            }
        } 
        else if($role == 'guardian_currentaddress_req'){  
             if ($status == "yes") {
                $data['guardian_currentaddress_req'] = 1;
            } else {
                $data['guardian_currentaddress_req'] = 0;
            }
        } 
        else if($role == 'bank_account_req'){  
             if ($status == "yes") {
                $data['bank_account_req'] = 1;
            } else {
                $data['bank_account_req'] = 0;
            }
        } 
        else if($role == 'bank_name_req'){  
             if ($status == "yes") {
                $data['bank_name_req'] = 1;
            } else {
                $data['bank_name_req'] = 0;
            }
        } 
        else if($role == 'ifsc_code_req'){  
             if ($status == "yes") {
                $data['ifsc_code_req'] = 1;
            } else {
                $data['ifsc_code_req'] = 0;
            }
        } 
        else if($role == 'aadhaar_identification_req'){  
             if ($status == "yes") {
                $data['aadhaar_identification_req'] = 1;
            } else {
                $data['aadhaar_identification_req'] = 0;
            }
        } 
        else if($role == 'measurement_date_req'){  
             if ($status == "yes") {
                $data['measurement_date_req'] = 1;
            } else {
                $data['measurement_date_req'] = 0;
            }
        } 
        else if($role == 'rte_req'){  
             if ($status == "yes") {
                $data['rte_req'] = 1;
            } else {
                $data['rte_req'] = 0;
            }
        } 
        else if($role == 'upload_documents_req'){  
             if ($status == "yes") {
                $data['upload_documents_req'] = 1;
            } else {
                $data['upload_documents_req'] = 0;
            }
        } 
        else if($role == 'local_identification_req'){  
             if ($status == "yes") {
                $data['local_identification_req'] = 1;
            } else {
                $data['local_identification_req'] = 0;
            }
        } 
        //school is detail
        else if($role == 'previous_school_req'){  
             if ($status == "yes") {
                $data['previous_school_req'] = 1;
            } else {
                $data['previous_school_req'] = 0;
            }
        } 
        else if($role == 'note_req'){  
             if ($status == "yes") {
                $data['note_req'] = 1;
            } else {
                $data['note_req'] = 0;
            }
        } 
        else if($role == 'guardian_permentaddress_req'){  
             if ($status == "yes") {
                $data['guardian_permentaddress_req'] = 1;
            } else {
                $data['guardian_permentaddress_req'] = 0;
            }
        } 
        else if($role == 'gurdian_name_req'){  
             if ($status == "yes") {
                $data['gurdian_name_req'] = 1;
            } else {
                $data['gurdian_name_req'] = 0;
            }
        } 
        else if($role == 'family_mid_no'){  // new field no 6
             if ($status == "yes") {
                $data['family_mid_no'] = 1;
            } else {
                $data['family_mid_no'] = 0;
            }
        } 
        else if($role == 'apar_id'){  // new field no 7
             if ($status == "yes") {
                $data['apar_id'] = 1;
            } else {
                $data['apar_id'] = 0;
            }
        } 
        else if($role == 'school_medium'){  // new field no 8
             if ($status == "yes") {
                $data['school_medium'] = 1;
            } else {
                $data['school_medium'] = 0;
            }
        } 
        else if($role == 'last_class'){  // new field no 9
             if ($status == "yes") {
                $data['last_class'] = 1;
            } else {
                $data['last_class'] = 0;
            }
        } 
        else if($role == 'abc_id'){  // new field no 10
             if ($status == "yes") {
                $data['abc_id'] = 1;
            } else {
                $data['abc_id'] = 0;
            }
        } 
        else if($role == 'scholarship_form_no'){  // new field no 11
             if ($status == "yes") {
                $data['scholarship_form_no'] = 1;
            } else {
                $data['scholarship_form_no'] = 0;
            }
        } 

        else if ($role == 'lastname') {
            if ($status == "yes") {
                $data['lastname'] = 1;
            } else {
                $data['lastname'] = 0;
            }
        } else if ($role == 'middlename') {
            if ($status == "yes") {
                $data['middlename'] = 1;
            } else {
                $data['middlename'] = 0;
            }
        } else if ($role == 'category') {
            if ($status == "yes") {
                $data['category'] = 1;
            } else {
                $data['category'] = 0;
            }
        } else if ($role == 'religion') {
            if ($status == "yes") {
                $data['religion'] = 1;
            } else {
                $data['religion'] = 0;
            }
        } else if ($role == 'cast') {
            if ($status == "yes") {
                $data['cast'] = 1;
            } else {
                $data['cast'] = 0;
            }
        } else if ($role == 'mobile_no') {
            if ($status == "yes") {
                $data['mobile_no'] = 1;
            } else {
                $data['mobile_no'] = 0;
            }
        } else if ($role == 'student_email') {
            if ($status == "yes") {
                $data['student_email'] = 1;
            } else {
                $data['student_email'] = 0;
            }
        } else if ($role == 'admission_date') {
            if ($status == "yes") {
                $data['admission_date'] = 1;
            } else {
                $data['admission_date'] = 0;
            }
        } else if ($role == 'student_photo') {
            if ($status == "yes") {
                $data['student_photo'] = 1;
            } else {
                $data['student_photo'] = 0;
            }
        } else if ($role == 'is_blood_group') {
            if ($status == "yes") {
                $data['is_blood_group'] = 1;
            } else {
                $data['is_blood_group'] = 0;
            }
        } else if ($role == 'student_height') {
            if ($status == "yes") {
                $data['student_height'] = 1;
            } else {
                $data['student_height'] = 0;
            }
        } else if ($role == 'student_weight') {
            if ($status == "yes") {
                $data['student_weight'] = 1;
            } else {
                $data['student_weight'] = 0;
            }
        } else if ($role == 'measurement_date') {
            if ($status == "yes") {
                $data['measurement_date'] = 1;
            } else {
                $data['measurement_date'] = 0;
            }
        } else if ($role == 'father_name') {
            if ($status == "yes") {
                $data['father_name'] = 1;
            } else {
                $data['father_name'] = 0;
            }
        } else if ($role == 'father_phone') {
            if ($status == "yes") {
                $data['father_phone'] = 1;
            } else {
                $data['father_phone'] = 0;
            }
        } else if ($role == 'father_occupation') {
            if ($status == "yes") {
                $data['father_occupation'] = 1;
            } else {
                $data['father_occupation'] = 0;
            }
        } else if ($role == 'father_pic') {
            if ($status == "yes") {
                $data['father_pic'] = 1;
            } else {
                $data['father_pic'] = 0;
            }
        } else if ($role == 'mother_name') {
            if ($status == "yes") {
                $data['mother_name'] = 1;
            } else {
                $data['mother_name'] = 0;
            }
        } else if ($role == 'mother_phone') {
            if ($status == "yes") {
                $data['mother_phone'] = 1;
            } else {
                $data['mother_phone'] = 0;
            }
        } else if ($role == 'mother_occupation') {
            if ($status == "yes") {
                $data['mother_occupation'] = 1;
            } else {
                $data['mother_occupation'] = 0;
            }
        } else if ($role == 'mother_pic') {
            if ($status == "yes") {
                $data['mother_pic'] = 1;
            } else {
                $data['mother_pic'] = 0;
            }
        } else if ($role == 'guardian_name') {
            if ($status == "yes") {
                $data['guardian_name'] = 1;
            } else {
                $data['guardian_name'] = 0;
            }
        } else if ($role == 'guardian_phone') {
            if ($status == "yes") {
                $data['guardian_phone'] = 1;
            } else {
                $data['guardian_phone'] = 0;
            }
        } else if ($role == 'guardian_occupation') {
            if ($status == "yes") {
                $data['guardian_occupation'] = 1;
            } else {
                $data['guardian_occupation'] = 0;
            }
        } else if ($role == 'guardian_relation') {
            if ($status == "yes") {
                $data['guardian_relation'] = 1;
            } else {
                $data['guardian_relation'] = 0;
            }
        } else if ($role == 'guardian_email') {
            if ($status == "yes") {
                $data['guardian_email'] = 1;
            } else {
                $data['guardian_email'] = 0;
            }
        } else if ($role == 'guardian_pic') {
            if ($status == "yes") {
                $data['guardian_pic'] = 1;
            } else {
                $data['guardian_pic'] = 0;
            }
        } else if ($role == 'guardian_address') {
            if ($status == "yes") {
                $data['guardian_address'] = 1;
            } else {
                $data['guardian_address'] = 0;
            }
        } else if ($role == 'current_address') {
            if ($status == "yes") {
                $data['current_address'] = 1;
            } else {
                $data['current_address'] = 0;
            }
        } else if ($role == 'permanent_address') {
            if ($status == "yes") {
                $data['permanent_address'] = 1;
            } else {
                $data['permanent_address'] = 0;
            }
        } else if ($role == 'route_list') {
            if ($status == "yes") {
                $data['route_list'] = 1;
            } else {
                $data['route_list'] = 0;
            }
        } else if ($role == 'hostel_id') {
            if ($status == "yes") {
                $data['hostel_id'] = 1;
            } else {
                $data['hostel_id'] = 0;
            }
        } else if ($role == 'bank_account_no') {
            if ($status == "yes") {
                $data['bank_account_no'] = 1;
            } else {
                $data['bank_account_no'] = 0;
            }
        } else if ($role == 'bank_name') {
            if ($status == "yes") {
                $data['bank_name'] = 1;
            } else {
                $data['bank_name'] = 0;
            }
        } else if ($role == 'ifsc_code') {
            if ($status == "yes") {
                $data['ifsc_code'] = 1;
            } else {
                $data['ifsc_code'] = 0;
            }
        } else if ($role == 'national_identification_no') {
            if ($status == "yes") {
                $data['national_identification_no'] = 1;
            } else {
                $data['national_identification_no'] = 0;
            }
        } else if ($role == 'local_identification_no') {
            if ($status == "yes") {
                $data['local_identification_no'] = 1;
            } else {
                $data['local_identification_no'] = 0;
            }
        } else if ($role == 'rte') {
            if ($status == "yes") {
                $data['rte'] = 1;
            } else {
                $data['rte'] = 0;
            }
        } else if ($role == 'previous_school_details') {
            if ($status == "yes") {
                $data['previous_school_details'] = 1;
            } else {
                $data['previous_school_details'] = 0;
            }
        } else if ($role == 'student_note') {
            if ($status == "yes") {
                $data['student_note'] = 1;
            } else {
                $data['student_note'] = 0;
            }
        } else if ($role == 'upload_documents') {
            if ($status == "yes") {
                $data['upload_documents'] = 1;
            } else {
                $data['upload_documents'] = 0;
            }
        } else if ($role == 'student_barcode') {
            if ($status == "yes") {
                $data['student_barcode'] = 1;
            } else {
                $data['student_barcode'] = 0;
            }
        } else if ($role == 'staff_designation') {
            if ($status == "yes") {
                $data['staff_designation'] = 1;
            } else {
                $data['staff_designation'] = 0;
            }
        } else if ($role == 'staff_department') {
            if ($status == "yes") {
                $data['staff_department'] = 1;
            } else {
                $data['staff_department'] = 0;
            }
        } else if ($role == 'staff_last_name') {
            if ($status == "yes") {
                $data['staff_last_name'] = 1;
            } else {
                $data['staff_last_name'] = 0;
            }
        } else if ($role == 'staff_father_name') {
            if ($status == "yes") {
                $data['staff_father_name'] = 1;
            } else {
                $data['staff_father_name'] = 0;
            }
        } else if ($role == 'staff_mother_name') {
            if ($status == "yes") {
                $data['staff_mother_name'] = 1;
            } else {
                $data['staff_mother_name'] = 0;
            }
        } else if ($role == 'staff_date_of_joining') {
            if ($status == "yes") {
                $data['staff_date_of_joining'] = 1;
            } else {
                $data['staff_date_of_joining'] = 0;
            }
        } else if ($role == 'staff_phone') {
            if ($status == "yes") {
                $data['staff_phone'] = 1;
            } else {
                $data['staff_phone'] = 0;
            }
        } else if ($role == 'staff_emergency_contact') {
            if ($status == "yes") {
                $data['staff_emergency_contact'] = 1;
            } else {
                $data['staff_emergency_contact'] = 0;
            }
        } else if ($role == 'staff_marital_status') {
            if ($status == "yes") {
                $data['staff_marital_status'] = 1;
            } else {
                $data['staff_marital_status'] = 0;
            }
        } else if ($role == 'staff_photo') {
            if ($status == "yes") {
                $data['staff_photo'] = 1;
            } else {
                $data['staff_photo'] = 0;
            }
        } else if ($role == 'staff_current_address') {
            if ($status == "yes") {
                $data['staff_current_address'] = 1;
            } else {
                $data['staff_current_address'] = 0;
            }
        } else if ($role == 'staff_permanent_address') {
            if ($status == "yes") {
                $data['staff_permanent_address'] = 1;
            } else {
                $data['staff_permanent_address'] = 0;
            }
        } else if ($role == 'staff_qualification') {
            if ($status == "yes") {
                $data['staff_qualification'] = 1;
            } else {
                $data['staff_qualification'] = 0;
            }
        } else if ($role == 'staff_work_experience') {
            if ($status == "yes") {
                $data['staff_work_experience'] = 1;
            } else {
                $data['staff_work_experience'] = 0;
            }
        } else if ($role == 'staff_note') {
            if ($status == "yes") {
                $data['staff_note'] = 1;
            } else {
                $data['staff_note'] = 0;
            }
        } else if ($role == 'staff_epf_no') {
            if ($status == "yes") {
                $data['staff_epf_no'] = 1;
            } else {
                $data['staff_epf_no'] = 0;
            }
        } else if ($role == 'staff_basic_salary') {
            if ($status == "yes") {
                $data['staff_basic_salary'] = 1;
            } else {
                $data['staff_basic_salary'] = 0;
            }
        } else if ($role == 'staff_contract_type') {
            if ($status == "yes") {
                $data['staff_contract_type'] = 1;
            } else {
                $data['staff_contract_type'] = 0;
            }
        } else if ($role == 'staff_work_shift') {
            if ($status == "yes") {
                $data['staff_work_shift'] = 1;
            } else {
                $data['staff_work_shift'] = 0;
            }
        } else if ($role == 'staff_work_location') {
            if ($status == "yes") {
                $data['staff_work_location'] = 1;
            } else {
                $data['staff_work_location'] = 0;
            }
        } else if ($role == 'staff_leaves') {
            if ($status == "yes") {
                $data['staff_leaves'] = 1;
            } else {
                $data['staff_leaves'] = 0;
            }
        } else if ($role == 'staff_account_details') {
            if ($status == "yes") {
                $data['staff_account_details'] = 1;
            } else {
                $data['staff_account_details'] = 0;
            }
        } else if ($role == 'staff_social_media') {
            if ($status == "yes") {
                $data['staff_social_media'] = 1;
            } else {
                $data['staff_social_media'] = 0;
            }
        } else if ($role == 'staff_upload_documents') {
            if ($status == "yes") {
                $data['staff_upload_documents'] = 1;
            } else {
                $data['staff_upload_documents'] = 0;
            }
        } else if ($role == 'staff_barcode') {
            if ($status == "yes") {
                $data['staff_barcode'] = 1;
            } else {
                $data['staff_barcode'] = 0;
            }
        }

        if ($this->findSelected($this->student_edit_field_model->get(), $role)) {

            if ($status == 'no') {
                $insert = array(
                    'name'   => $role,
                    'status' => 0,
                );
                $this->student_edit_field_model->add($insert);
            }

            if ($role == 'guardian_name') {
                $insert = array(
                    'name'   => 'if_guardian_is',
                    'status' => 0,
                );

                $this->student_edit_field_model->add($insert);
            }

        }

        // is used to edit data in online admission form fields
        if ($this->findSelected($this->onlinestudent_model->getformfields(), $role)) {

            if ($status == 'no') {
                $insert = array(
                    'name'   => $role,
                    'status' => 0,
                );

                $this->onlinestudent_model->addformfields($insert);
            }

            if ($role == 'guardian_name') {
                $insert = array(
                    'name'   => 'if_guardian_is',
                    'status' => 0,
                );

                $this->onlinestudent_model->addformfields($insert);
            }

        }

        $this->setting_model->add($data);
    }

    public function findSelected($inserted_fields, $find)
    {

        foreach ($inserted_fields as $inserted_key => $inserted_value) {
            if ($find == $inserted_value->name && $inserted_value->status) {
                return true;
            }

        }
        return false;
    }

}
