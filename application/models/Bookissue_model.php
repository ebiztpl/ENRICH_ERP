<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bookissue_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null)
    {
        $this->db->select()->from('book_issues');
        if ($id != null) {
            $this->db->where('book_issues.id', $id);
        } else {
            $this->db->order_by('book_issues.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('book_issues');
        $message   = DELETE_RECORD_CONSTANT . " On book issues id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function add($data)
    { 
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->insert('book_issues', $data);
        $insert_id = $this->db->insert_id();
        $message   = INSERT_RECORD_CONSTANT . " On book issues id " . $insert_id;
        $action    = "Insert";
        $record_id = $insert_id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
     
        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
        return $insert_id;
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getMemberBooks($member_id = null)
    {
        $this->db->select('book_issues.id,books_list.bookcode as book_no,book_issues.fine_paid,book_issues.return_date,book_issues.duereturn_date,book_issues.issue_date,book_issues.is_returned,book_issues.late_fine,books.book_title,books.author')->from('book_issues');
        $this->db->join('books_list', 'books_list.id = book_issues.book_id', 'left');
        $this->db->join('books', 'books.id = books_list.book_id', 'left');
        if ($member_id != null) {
            $this->db->where('book_issues.member_id', $member_id);
            $this->db->order_by("book_issues.is_returned", "asc");
        }
        $query = $this->db->get();
        // print_r($query->result_array());die;
        return $query->result_array();

   
    }
    

    public function getissueMemberBooks($member_id = null)
    {
        $sql   = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,staff.name as fname,staff.surname as lname, 'admission'=' ' as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' and libarary_members.member_type='teacher' union all SELECT libarary_members.id as members_id, libarary_members.library_card_no, `book_issues`.`id`,students.firstname as fname,students.lastname as lname,students.middlename, students.admission_no as adminssion,libarary_members.member_type, `book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join students on students.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' and libarary_members.member_type='student'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getissuereturnMemberBooks($member_id = null, $start_date = null, $end_date = null)
    {
        $condition  = "";
        $condition2 = "";
        if ($start_date != "" && $end_date != "") {
            $condition = " and date_format(issue_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        }
        if (isset($_POST['book_category']) && $_POST['book_category'] != '') {
            $condition .= " and books.book_category='" . $_POST['book_category'] . "'";
        }
        if ($this->session->has_userdata('admin')) {
            $getStaffRole = $this->customlib->getStaffRole();
            $staffrole    = json_decode($getStaffRole);
            $superadmin_visible = $this->customlib->superadmin_visible();
            if ($superadmin_visible == 'disabled' && $staffrole->id != 7) {
                $condition2 = " and staff_roles.role_id != 7 ";
            }
        }

        $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,staff.name as fname,staff.name as mname,staff.surname as lname, staff.employee_id as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_category`,books_list.bookcode as book_no, `books`.`author`,staff.id as staff_id FROM `book_issues`
       
         left  join books_list on books_list.id = book_issues.book_id
         left  join books on books.id = books_list.book_id
       
        --  LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` 
         left join libarary_members on libarary_members.id=book_issues.member_id 
         left join staff on staff.id=libarary_members.member_id left join staff_roles on staff_roles.staff_id = staff.id
        WHERE `book_issues`.`is_returned` = '1' and libarary_members.member_type='teacher' " . $condition2 . "
        union all
        SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,students.firstname as fname,students.middlename as mname,students.lastname as lname, students.admission_no as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_category`,books_list.bookcode as book_no, `books`.`author`,students.id as staff_id  FROM `book_issues`
        -- SELECT libarary_members.id as members_id, libarary_members.library_card_no, `book_issues`.`id`,students.firstname as fname,students.middlename as mname,students.lastname as lname, students.admission_no as admission,libarary_members.member_type, `book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`,books_list.bookcode as book_no, `books`.`author` FROM `book_issues`
         left  join books_list on books_list.id = book_issues.book_id
         left  join books on books.id = books_list.book_id
      
          left join libarary_members on libarary_members.id=book_issues.member_id
           left join students on students.id=libarary_members.member_id 
           WHERE `book_issues`.`is_returned` = '1' and libarary_members.member_type='student' " . $condition . "  ";
        $this->datatables->query($sql)
            ->searchable('book_title,book_no,issue_date,return_date,book_no,libarary_members.id,library_card_no,students.admission_no,students.firstname,member_type')
            ->orderable('book_title,book_no,issue_date,return_date,members_id,library_card_no,admission,fname,member_type')
            ->query_where_enable(true);
        return $this->datatables->generate('json');
    }
    public function update($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('book_issues', $data);
        }
    }

    public function book_issuedByMemberID($member_id)
    {
        $this->db->select('book_issues.return_date,books.book_no,book_issues.issue_date,book_issues.is_returned,books.book_title,books.author,`book_issues`.`duereturn_date`')
            ->from('book_issues')
            ->join('libarary_members', 'libarary_members.id = book_issues.member_id', 'left')
            ->join('books', 'books.id = book_issues.book_id', 'left')
            ->where('libarary_members.id', $member_id)
            ->order_by('book_issues.is_returned', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAvailQuantity($id = null)
    {
        $sql = "SELECT books_list.*,IFNULL(total_issue, '0') as `total_issue` FROM books_list LEFT JOIN (SELECT COUNT(*) as `total_issue`, book_id from book_issues  where is_returned= 0 GROUP by book_id) as `book_count` on books_list.id=book_count.book_id WHERE books_list.bookcode='$id' and books_list.lost= 0";
        $query = $this->db->query($sql);
       
        return $query->row();

          
      


    }

    public function valid_check_exists($str)
    {
        $member_id = $this->input->post('member_id');
        $book_id = $this->input->post('book_id');
        if ($book_id == "") {
            return true;
        }

        if ($this->checkAvailQuantity($book_id)) {
       
            $this->form_validation->set_message('check_exists', $this->lang->line('book_not_available'));
            return false;
        } 
        
        if ($this->checkBookIssuedOrNot($book_id,$member_id)) {        
   
            $this->form_validation->set_message('check_exists', $this->lang->line('book_already_issued'));
            return false;
        } else {
            return true;
        }        
    }

    public function checkBookIssuedOrNot($id, $member_id)
    {
        $sql = "SELECT IFNULL(book_issues.id, '0') as total_issue FROM book_issues  where book_issues.book_id=$id and book_issues.member_id=$member_id and book_issues.is_returned=0";       
        $query     = $this->db->query($sql);        
        $result    = $query->row();       
        if (!empty($result) && $result->total_issue > 0) {           
            return true;
        }
        return false;        
    }
    
    public function checkAvailQuantity($id = null)
    {
        $sql = "SELECT books_list.*,IFNULL(total_issue, '0') as `total_issue` FROM books_list LEFT JOIN (SELECT COUNT(*) as `total_issue`, book_id from book_issues  where is_returned= 0 GROUP by book_id) as `book_count` on books_list.id=book_count.book_id WHERE books_list.id=$id";
        $query     = $this->db->query($sql);
        $result    = $query->row();
        $remaining = ($result->total_issue);
        if ($remaining > 0) {
            return true;
        }
        return false;
    }

    public function studentBookIssue_report($start_date, $end_date)
    {
        $condition = "";
        $condition .= " and date_format(book_issues.issue_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        if (isset($_POST['members_type']) && $_POST['members_type'] != '') {
            $condition .= " and libarary_members.member_type='" . $_POST['members_type'] . "'";
        }
        if (isset($_POST['book_category']) && $_POST['book_category'] != '') {
            $condition .= " and books.book_category='" . $_POST['book_category'] . "'";
        }
        $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,CONCAT_WS(' ',staff.name,staff.surname) as staff_name,guest.name as guest_name,guest.id as guest_id,staff.employee_id,staff.id as staff_id,CONCAT_WS(' ',students.firstname,students.lastname) as student_name,students.firstname,students.middlename,students.lastname, students.admission_no as admission ,students.id as sid ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`,  `books`.`book_category`,books_list.bookcode as book_no, `books`.`author`,book_issues.duereturn_date FROM `book_issues`
         left  join books_list on books_list.id = book_issues.book_id
         left  join books on books.id = books_list.book_id
        --  LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id`
         left join libarary_members on libarary_members.id=book_issues.member_id 
         left join staff on staff.id=libarary_members.member_id 
         left join students on (students.id=libarary_members.member_id and libarary_members.member_type='student')
          left join guest on (guest.id=libarary_members.member_id and libarary_members.member_type='guest')
         WHERE `book_issues`.`is_returned` = '0' " . $condition;

        $this->datatables->query($sql)
            ->orderable('book_title,book_no,issue_date,duereturn_date,members_id,library_card_no, students.admission_no,firstname')
            ->searchable('book_title,book_no,issue_date,duereturn_date,libarary_members.id,library_card_no, students.admission_no,firstname')
            ->query_where_enable(true);
        return $this->datatables->generate('json');
    }

 public function studentAccession_report($start_date, $end_date, $book_category)
{
    $condition = [];

    if (!empty($start_date) && !empty($end_date)) {
        $condition[] = "DATE_FORMAT(books.created_at, '%Y-%m-%d') BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
    }

    if (!empty($book_category)) {
        $condition[] = "books.book_category = '" . $book_category . "'";
    }

    $where_clause = '';
    if (!empty($condition)) {
        $where_clause = 'WHERE ' . implode(' AND ', $condition);
    }

    $sql = "SELECT 
                books_list.bookcode AS accession_no,
                books.book_title,
                book_category.book_category AS books_category_name,
                library_dropdown_data.name AS author_name
            FROM books_list
            LEFT JOIN books ON books.id = books_list.book_id
            LEFT JOIN book_category ON book_category.id = books.book_category
            LEFT JOIN library_dropdown_data ON books.author = library_dropdown_data.id
            $where_clause";

    $this->datatables->query($sql)
        ->orderable('books_list.bookcode, books.book_title')
        ->searchable('books.book_title, books_list.bookcode')
        ->query_where_enable(true);

    return $this->datatables->generate('json');
}

    public function bookduereport($start_date, $end_date)
    {
        $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        if (isset($_POST['members_type']) && $_POST['members_type'] != '') {
            $condition .= " and libarary_members.member_type='" . $_POST['members_type'] . "'";
        }
        if (isset($_POST['book_category']) && $_POST['book_category'] != '') {
            $condition .= " and books.book_category='" . $_POST['book_category'] . "'";
        }
        $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,staff.id as staff_id, staff.employee_id,`book_issues`.`id`,CONCAT_WS(' ',staff.name,students.firstname) as fname,guest.name as guest_name,guest.id as guest_id,CONCAT_WS(' ',staff.surname,students.lastname) as lname, students.firstname,students.middlename,students.lastname,students.admission_no as admission ,students.id as sid ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `book_issues`.`late_fine`, `books`.`book_title`,  `books`.`book_category`, `books`.`book_no`, `books`.`author`,books_list.bookcode as book_no,`book_issues`.duereturn_date FROM `book_issues`
                left  join books_list on books_list.id = book_issues.book_id
         left  join books on books.id = books_list.book_id
        --  LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` 
         left join libarary_members on libarary_members.id=book_issues.member_id 
         left join staff on (staff.id=libarary_members.member_id and libarary_members.member_type='teacher')
          left join students on (students.id=libarary_members.member_id and libarary_members.member_type='student') 
                 left join guest on (guest.id=libarary_members.member_id and libarary_members.member_type='guest')

          WHERE `book_issues`.`is_returned` = '0' and Date(duereturn_date) <= '". date('Y-m-d')."'" . $condition;

        $this->datatables->query($sql)
            ->orderable('book_title,book_no,issue_date,duereturn_date,members_id,library_card_no, students.admission_no,firstname')
            ->searchable('book_title,book_no,issue_date,duereturn_date,libarary_members.id,library_card_no, students.admission_no,firstname')
            ->query_where_enable(true);
        return $this->datatables->generate('json');       
    }
    public function dueforreturn($start_date, $end_date)
    {
        $condition = " ";
        // $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        $sql   = "SELECT count(*) as total FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' " . $condition;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function forreturn($start_date, $end_date)
    {
        // $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        $condition = "and date_format(book_issues.duereturn_date,'%Y-%m-%d') < '".date('Y-m-d')."'";
        $sql   = "SELECT count(*) as total FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' " . $condition;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function totalmembers()
    {
        // $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        $query = $this->db->query('SELECT * FROM libarary_members');
        $total = $query->num_rows();
        return $total;
    }
    
    public function totalfine()
    {

      
    $this->db->select('books.perunitcost,book_issues.book_id,libarary_members.member_type,book_issues.late_fine,libarary_members.member_id as member_idd,libarary_members.id as lib_mem_id,book_issues.description,book_issues.is_returned,book_issues.book_master_id')->from('book_issues');
    $this->db->join('books', 'books.id = book_issues.book_master_id');
    $this->db->join('libarary_members', 'libarary_members.id = book_issues.member_id');
    $this->db->where('book_issues.fine_paid',1 );
    $query = $this->db->get();
    $detail = $query->result();
//     echo "<pre>";
// print_r($detail);die;
   $fine  = 0;
// foreach($detail as $details){
    
    
// }



$a = '<table class="table table-striped table-bordered table-hover example book-list dataTable no-footer"><thead><tr>
<th>SR</th>
<th>Accession No.</th>
<th>Fine Paid</th>
<th>Book Price</th>
<th>Paid By</th>
<th>Member Type</th>
<th>Reason</th>
<th style="width:20% !important;text-align:left important"  >Description</th>
</tr></thead><tbody>';

if(count($detail) > 0){
    $i = 0;
    foreach($detail as $details){

        $fine  += $details->late_fine;

    
        $this->db->select('books_list.*')->from('books_list');
      
        $this->db->where('books_list.id',$details->book_id );
        $query = $this->db->get();
        $ger = $query->row();

        $details->book_id = $ger->bookcode;

        $i++;
          $a .= '<tr>
           <td>'.$i.'</td>
            <td><form role="form" action="'.site_url("admin/book/searchbybookcode").'" method="post" id="">
             <input type="hidden" class="form-control" value="'.$details->book_id.'" required="" name="book_code">
            
                         <input type="submit" class="" value="'.$details->book_id.'" required="">

            </form></td>
             <td>'.$details->late_fine.'</td>
            <td>'.$details->perunitcost.'</td>';


            if($details->member_type == 'student'){





                $this->db->select()->from('students');
                $this->db->where("id",$details->member_idd??'');
                $query = $this->db->get();
                $datt = $query->row();
            
            
            
            
              
                $row = '<a href="'.base_url().'/student/view/'.$details->member_idd.'">'.$datt->firstname??"".$datt->lastname??"".'</a>';
            
            }elseif($details->member_type == 'teacher'){
            
                $this->db->select()->from('staff');
                $this->db->where("id",$details->member_idd??'');
                $query = $this->db->get();
                $datt = $query->row();
            
            
            
                $this->db->select()->from('staff_designation');
                $this->db->where("id",$datt->designation??'');
                $query = $this->db->get();
                $dattt = $query->row();
            
            
              $row = '<a href="'.base_url().'/admin/staff/profile/'.$details->member_idd.'">'.$datt->name??"".$datt->surname??"".$dattt->designation??"".'</a>';
            
            
            
            }else{
                $this->db->select()->from('guest');
                $this->db->where("id",$details->member_idd??'');
                $query = $this->db->get();
                $datt = $query->row();
            
            
            
            
            
            if($datt){
                $row = '<a href="'.base_url().'/admin/member/guestedit/'.$datt->id.'">'.$datt->name.'</a>';

            }else{
                $row = '';

            }
            
            
            }


            $a .=   '<td>'.$row.'</td>';

            $a .=   '<td>'.$details->member_type.'</td>';

            if($details->is_returned == 2){
                $a .=   '<td style="color:red">Book Lost</td>';
            }else{
                $a .=   '<td style="color:#0032cba6">Late Return</td>';
            }
           


            $a .=   '<td style="width:20% !important;text-align:left important" >'.$details->description.'</td>';

            $a .=   '</tr>
            
            
            
            ';
        
    }
}else{
    $a .= '<tr>No Fine Has Been Collected Yet</tr>';
}



$a .= '</tbody></table>';


return $a.'~'.$fine;

    }
      
    
    public function getissuecount($date1,$date2)
    { 

        $this->db->select()->from('book_issues');

        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $query = $this->db->get();
        // print_r($query->result_array());die;
        return $query->num_rows();

    }



   
    public function getreturncount($date1,$date2)
    { 

        $this->db->select()->from('book_issues');

        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $this->db->where("is_returned",1);
        $query = $this->db->get();
        // print_r($query->result_array());die;
        return $query->num_rows();

    }

    public function overduemonth($date1,$date2)
    { 
        $date3 = date('Y-m-d');
        $this->db->select()->from('book_issues');

        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $this->db->where("is_returned",0);
        $this->db->where("duereturn_date <=",$date3);
        $query = $this->db->get();

        return $query->num_rows();

    }



    
    public function booktype($type)
    { 

        $this->db->select()->from('library_dropdown_data');
        $this->db->where('type',4);
        $this->db->like('name',$type);
        $query = $this->db->get();
        $type = $query->row();


        $this->db->select('id')->from('books');
        $this->db->where('book_language',$type->id??'0');
        $check2 = $this->db->get();
        $check2 = $check2->result_array();
   
        $arr2 = array_map (function($value){
            return $value['id'];
        } , $check2);
       
        if(!empty($arr2)){
            $this->db->select()->from('books_list');
            $this->db->where("lost",0);
            $this->db->where_In("book_id",$arr2);
            $query = $this->db->get();
            return $query->num_rows();
        }
            else{
            return 0;
            }


    }



    public function newtotalmembers($new)
    {
        // $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        $query = $this->db->query('SELECT * FROM `libarary_members` WHERE `member_type` LIKE  "'.$new.'"');
        $total = $query->num_rows();
        return $total;
    }


    
    public function getissuedata($date1,$date2)
    { 

        $this->db->select()->from('book_issues');
        $this->db->join('books', 'books.id = book_issues.book_master_id');
        $this->db->join('books_list', 'books_list.id = book_issues.book_id');
        $this->db->join('libarary_members', 'libarary_members.id = book_issues.member_id');
        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $query = $this->db->get();

        return $query->result();

    }


    
    public function getreturndata($date1,$date2)
    { 

        $this->db->select()->from('book_issues');
        $this->db->join('books', 'books.id = book_issues.book_master_id');
        $this->db->join('books_list', 'books_list.id = book_issues.book_id');
        $this->db->join('libarary_members', 'libarary_members.id = book_issues.member_id');
        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $this->db->where("is_returned",1);
        $query = $this->db->get();
        // print_r($query->result_array());die;
        return $query->result();

    }
    
    public function overduedata($date1,$date2)
    { 
        $date3 = date('Y-m-d');
        $this->db->select()->from('book_issues');
        $this->db->join('books', 'books.id = book_issues.book_master_id');
        $this->db->join('books_list', 'books_list.id = book_issues.book_id');
        $this->db->join('libarary_members', 'libarary_members.id = book_issues.member_id');
        if($date1){
            $this->db->where("issue_date >=", $date1);
        }
        if($date2){
            $this->db->where("issue_date <=", $date2);
        }
        $this->db->where("is_returned",0);
        $this->db->where("duereturn_date <=",$date3);
        $query = $this->db->get();

        return $query->result();

    }
    

    public function newtotalmembersdata($new = null)
    {
        // $condition = " and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '" . $start_date . "' and '" . $end_date . "'";
        if($new){
            $query = $this->db->query('SELECT * FROM `libarary_members` WHERE `member_type` LIKE  "'.$new.'"');

        }else{
            $query = $this->db->query('SELECT * FROM `libarary_members`');

        }
        
        $total = $query->result();
        return $total;
    }
}
