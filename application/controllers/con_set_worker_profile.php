<?php

class Con_set_worker_profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_worker_profile');
        $this->load->model('mod_set_building');
        $this->load->model('mod_set_floor');
        $this->load->model('mod_set_employee_info_detail');
        $this->load->helper('alert');
        $this->load->helper('date');
    }

    function index() {
        //$data['building_name'] = $this->mod_set_worker_profile->get_building_by_name();
        $data['container'] = 'upload_view';
        $this->load->view('main_page', $data);
    }

//    public function view() {
//        $data['tbl_worker_profile'] = $this->mod_set_worker_profile->view();
//        $data['container'] = 'temp/worker_profile/view';
//        $this->load->view('main_page', $data);
//    }

    public function edit1($cardno) {
        $buildingName = $this->session->userdata('BuildingName');
        if ($this->session->userdata("Role") == "Admin") {
            $buildingId = $this->mod_set_building->GetBuldingId($buildingName);
            $data['floor_info'] = $this->mod_set_floor->view($buildingId);
           
            
        }else{
             $data['floor_info'] = $this->session->userdata('Floor');
        }
       

        $data['tbl_district'] = $this->mod_set_worker_profile->get_district_name();
        $data['tbl_section'] = $this->mod_set_employee_info_detail->getAllsection();
       
       $data['tbl_job_category'] = $this->mod_set_employee_info_detail->get_job_category_name();
        $this->mod_set_worker_profile->CardNo = $cardno;
        $data['tbl_worker_profile1'] = $this->mod_set_worker_profile->get_employee_profile12();
        $data['tbl_worker_profile'] = $this->mod_set_worker_profile->get_employee_profile();


        $mydata = explode('-', $data['tbl_worker_profile1']->Parameter5);
        $workerList = array(1 => "S", 2 => "W");

        $data['workerlistOfselect'] = array_search($mydata[0], $workerList);
//        echo '<pre>';
//        print_r($data['tbl_worker_profile1']);
//        echo '</pre>';
//        exit();


        $data['jobcatinfo'] = $this->mod_set_worker_profile->getTblGrade($data['workerlistOfselect']);
        //$aa = array($mydata[1], $data['workerlistOfselect']);

       
//        echo '<pre>';
//        print_r($data['designationList']);
//        echo '</pre>';
//        exit();

        $data['container'] = 'temp/worker_profile/edit';
        $this->load->view('main_page', $data);
    }

    public function update_employee() {
        $this->mod_set_worker_profile->ID = $this->input->post('id');
        $engNumber = array(1,2,3,4,5,6,7,8,9,0);
        $bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $this->mod_set_worker_profile->Name = $this->input->post('Name');
        $this->mod_set_worker_profile->Designation = $this->input->post('Designation');
        $this->mod_set_worker_profile->Grade = $this->input->post('Grade');
        $this->mod_set_worker_profile->CardNo = str_replace($bangNumber, $engNumber, $this->input->post('CardNo'));
        $this->mod_set_worker_profile->JoiningDate = date('Y-m-d', strtotime(str_replace($bangNumber, $engNumber, $this->input->post('JoiningDate'))));
        $this->mod_set_worker_profile->GrossSalary = str_replace($bangNumber, $engNumber,$this->input->post('GrossSalary'));
        $this->mod_set_worker_profile->LastIncrementDate = date('Y-m-d', strtotime(str_replace($bangNumber, $engNumber, $this->input->post('LastIncrementDate'))));
        $this->mod_set_worker_profile->LastIncrementMoney = str_replace($bangNumber, $engNumber,$this->input->post('LastIncrementMoney'));
        $this->mod_set_worker_profile->ContactNo = $this->input->post('ContactNo');
        $this->mod_set_worker_profile->NID = $this->input->post('NID');
        $this->mod_set_worker_profile->PromotionDate = date('Y-m-d', strtotime(str_replace($bangNumber, $engNumber, $this->input->post('PromotionDate'))));
        $this->mod_set_worker_profile->GuardianName = $this->input->post('GuardianName');
        $this->mod_set_worker_profile->PermanentVillage = $this->input->post('PermanentVillage');
        $this->mod_set_worker_profile->PermanenttPost = $this->input->post('PermanenttPost');
        $this->mod_set_worker_profile->PermanentThana = $this->input->post('PermanentThana');
        $this->mod_set_worker_profile->PermanentDistrict = $this->input->post('PermanentDistrict');
        $this->mod_set_worker_profile->PresentVillage = $this->input->post('PresentVillage');
        $this->mod_set_worker_profile->PresentPost = $this->input->post('PresentPost');
        $this->mod_set_worker_profile->PresentThana = $this->input->post('PresentThana');
        $this->mod_set_worker_profile->PresentDistrict = $this->input->post('PresentDistrict');
        $this->mod_set_worker_profile->Reference = $this->input->post('Reference');
        $this->mod_set_worker_profile->EducationalQual = $this->input->post('EducationalQual');
        $this->mod_set_worker_profile->Image = $this->input->post('userfile');
        $this->mod_set_worker_profile->ImageThumb = $this->input->post('ImageThumb');
        $this->mod_set_worker_profile->Comment = $this->input->post('Comment');
        $this->mod_set_worker_profile->Status = 'ACT';
        $this->mod_set_worker_profile->BuildingName = $this->input->post('BuildingName');
        $this->mod_set_worker_profile->Floor = $this->input->post('Floor');
        $this->mod_set_worker_profile->Department = $this->input->post('Department');
        $this->mod_set_worker_profile->Line = $this->input->post('Line');
        $this->mod_set_worker_profile->Parameter5 = $this->input->post('Parameter5');
        $this->mod_set_worker_profile->OT = $this->input->post('OT');
        $this->mod_set_worker_profile->AttendanceBonus = str_replace($bangNumber, $engNumber,$this->input->post('AttendanceBonus'));
        $this->mod_set_worker_profile->OtherAllowance = str_replace($bangNumber, $engNumber,$this->input->post('OtherAllowance'));
        $this->mod_set_worker_profile->OthAllowCal = $this->input->post('OthAllowCal');
        $this->mod_set_worker_profile->update();
        //$cardno = $this->input->post('CardNo');
        //$this->edit1($cardno);
        //$this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_worker_profile/edit1/'.$this->input->post('id'), 'refresh');
    }

    public function create() {
        $buildingName = $this->session->userdata('BuildingName');
        $floor = $this->session->userdata('Floor');
        $data['tbl_section'] = $this->mod_set_employee_info_detail->get_department_name($buildingName, $floor);
        $data['tbl_job_category'] = $this->mod_set_employee_info_detail->get_job_category_name();
        $data['tbl_district'] = $this->mod_set_worker_profile->get_district_name();
        $data['container'] = 'temp/worker_profile/create';
        $this->load->view('main_page', $data);
    }

    public function get_thana_name() {
        $District = $this->input->post('District');
        $Result = $this->mod_set_worker_profile->get_thana_name($District);
        echo json_encode($Result);
    }

    public function get_po_name() {
        $Thana = $this->input->post('Thana');
        $Result = $this->mod_set_worker_profile->get_po_name($Thana);
        echo json_encode($Result);
    }

    public function save_file() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $error = array('error' => $this->upload->display_errors());
            // print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        //echo '<pre>';
        //echo $data['upload_data']['file_name'];
        //echo '</pre>';

        $this->load->library('excel');
        $this->excel = PHPExcel_IOFactory::load(FCPATH . "uploads/" . $data['upload_data']['file_name']);
        $a_file = $this->excel->setActiveSheetIndex()->toArray(null, TRUE, TRUE, TRUE);

        $this->mod_set_worker_profile->insert_file($a_file);
        //$this->session->set_flashdata('msg', get_alert_by_id('101'));
        //redirect('con_set_employee_info_detail/view', 'refresh');
    }

    public function test() {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=spreadsheet.xls");
        // print your data here. note the following:
        // - cells/columns are separated by tabs ("\t")
        // - rows are separated by newlines ("\n")
        // for example:
        //echo 'First Name' . "\t" . 'Last Name' . "\t" . 'Phone' . "\n";
        //echo 'John' . "\t" . 'Doe' . "\t" . '555-5555' . "\n";
//        $result = mysql_query("SHOW COLUMNS FROM tbl_employee_profile");
//        if (!$result) {
//            echo 'Could not run query: ' . mysql_error();
//            exit();
//        }
//        if (mysql_num_rows($result) > 0) {
//            while ($row = mysql_fetch_assoc($result)) {
//                //print_r($row['Field']);
//                echo $row['Field'] . "\t";
//            }
//        }
        echo "\n";
        $user_profile = $this->mod_set_worker_profile->view();
//        echo '<pre>';
//        print_r($user_profile) ;
//        echo '</pre>';
        foreach ($user_profile as $a_user) {
            //echo ($a_user->ID) . "\t";
            echo ($a_user->Name) . "\t";
            echo ($a_user->Designation) . "\t";
            echo ($a_user->Grade) . "\t";
            echo ($a_user->CardNo) . "\t";
            echo ($a_user->JoiningDate) . "\t";
            echo ($a_user->GrossSalary) . "\t";
            echo ($a_user->LastIncrementDate) . "\t";
            echo ($a_user->LastIncrementMoney) . "\t";
            echo ($a_user->ContactNo) . "\t";
            echo ($a_user->PromotionDate) . "\t";
            echo ($a_user->GuardianName) . "\t";
            echo ($a_user->PermanentVillage) . "\t";
            echo ($a_user->PermanenttPost) . "\t";
            echo ($a_user->PermanentThana) . "\t";
            echo ($a_user->PermanentDistrict) . "\t";
            echo ($a_user->PresentVillage) . "\t";
            echo ($a_user->PresentPost) . "\t";
            echo ($a_user->PresentThana) . "\t";
            echo ($a_user->PresentDistrict) . "\t";
            echo ($a_user->Reference) . "\t";
            echo ($a_user->EducationalQual) . "\t";
            echo ($a_user->Image) . "\t";
            echo ($a_user->ImageThumb) . "\t";
            echo ($a_user->Comment) . "\t";
            echo ($a_user->Status) . "\t";
            echo ($a_user->BuildingName) . "\t";
            echo ($a_user->Floor) . "\t";
            echo ($a_user->Department) . "\t";
            echo ($a_user->Line) . "\t";
            echo ($a_user->Parameter5);
            echo "\n";
        }
    }

    public function insert() {
        $engNumber = array(1,2,3,4,5,6,7,8,9,0);
        $bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $this->mod_set_worker_profile->Name = $this->input->post('Name');
        $this->mod_set_worker_profile->Designation = $this->input->post('Designation');
        $this->mod_set_worker_profile->Grade = $this->input->post('Grade');
        $this->mod_set_worker_profile->CardNo = str_replace($bangNumber, $engNumber, $this->input->post('CardNo'));
        $this->mod_set_worker_profile->JoiningDate = date('Y-m-d', strtotime($this->input->post('JoiningDate')));
        $this->mod_set_worker_profile->GrossSalary = str_replace($bangNumber, $engNumber,$this->input->post('GrossSalary'));
        $this->mod_set_worker_profile->LastIncrementDate = date('Y-m-d', strtotime($this->input->post('LastIncrementDate')));
        $this->mod_set_worker_profile->LastIncrementMoney = str_replace($bangNumber, $engNumber,$this->input->post('LastIncrementMoney'));
        $this->mod_set_worker_profile->ContactNo = $this->input->post('ContactNo');
        $this->mod_set_worker_profile->NID = $this->input->post('NID');
        $this->mod_set_worker_profile->PromotionDate = date('Y-m-d', strtotime($this->input->post('PromotionDate')));
        $this->mod_set_worker_profile->GuardianName = $this->input->post('GuardianName');
        $this->mod_set_worker_profile->PermanentVillage = $this->input->post('PermanentVillage');
        $this->mod_set_worker_profile->PermanenttPost = $this->input->post('PermanenttPost');
        $this->mod_set_worker_profile->PermanentThana = $this->input->post('PermanentThana');
        $this->mod_set_worker_profile->PermanentDistrict = $this->input->post('PermanentDistrict');
        $this->mod_set_worker_profile->PresentVillage = $this->input->post('PresentVillage');
        $this->mod_set_worker_profile->PresentPost = $this->input->post('PresentPost');
        $this->mod_set_worker_profile->PresentThana = $this->input->post('PresentThana');
        $this->mod_set_worker_profile->PresentDistrict = $this->input->post('PresentDistrict');
        $this->mod_set_worker_profile->Reference = $this->input->post('Reference');
        $this->mod_set_worker_profile->EducationalQual = $this->input->post('EducationalQual');
        $this->mod_set_worker_profile->Image = $this->input->post('userfile');
        $this->mod_set_worker_profile->ImageThumb = $this->input->post('ImageThumb');
        $this->mod_set_worker_profile->Comment = $this->input->post('Comment');
        $this->mod_set_worker_profile->Status = 'ACT';
        $this->mod_set_worker_profile->BuildingName = $this->input->post('BuildingName');
        $this->mod_set_worker_profile->Floor = $this->input->post('Floor');
        $this->mod_set_worker_profile->Department = $this->input->post('Department');
        $this->mod_set_worker_profile->Line = $this->input->post('Line');
        $this->mod_set_worker_profile->Parameter5 = $this->input->post('Parameter5');
        $this->mod_set_worker_profile->OT = $this->input->post('OT');
        $this->mod_set_worker_profile->AttendanceBonus = str_replace($bangNumber, $engNumber,$this->input->post('AttendanceBonus'));
        $this->mod_set_worker_profile->OtherAllowance = str_replace($bangNumber, $engNumber,$this->input->post('OtherAllowance'));
        $this->mod_set_worker_profile->OthAllowCal = $this->input->post('OthAllowCal');
        $this->upload_image('insert');
        $this->mod_set_worker_profile->insert();

        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('Con_set_employee_info_detail/example', 'refresh');
    }

    public function upload_image($event) {
        $this->load->library('image_lib');
        $config['upload_path'] = './img/';
        if ($event == 'insert') {
            $config['overwrite'] = FALSE;
        } else {
            $config['overwrite'] = TRUE;
        }

        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $ext = end(explode(".", $_FILES['userfile']['name']));
        $config['file_name'] = $this->mod_set_worker_profile->CardNo . '.' . $ext;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data['myerror'] = $this->upload->display_errors();
            $data['tbl_worker_profile'] = $this->mod_set_worker_profile->view();
            $data['container'] = 'temp/user/view';
        } else {
            $data = $this->upload->data();
            $path = './img/';
            $source_image = $data['file_name'];

// Resize to medium

            $config['source_image'] = $path . $source_image;
            $config['overwrite'] = TRUE;
            $config['create_thumb'] = true;
            $config['thumb_marker'] = "_thurm";
            $config['width'] = 140;
            $config['height'] = 140;

            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
// an error occured
            }

// Keep the same source image
            $config['source_image'] = $path . $source_image;
            $config['overwrite'] = TRUE;
            $config['create_thumb'] = true;
            $config['thumb_marker'] = "_avater";
            $config['width'] = 35;
            $config['height'] = 35;

            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
// an error occured
            }

//            $this->mod_set_worker_profile->ImageThumb = $data['raw_name'] . "_thurm" . $data['file_ext'];
//            $this->mod_set_worker_profile->Image = $data['raw_name'] . "_avater" . $data['file_ext'];
            $this->mod_set_worker_profile->ImageThumb = $data['file_name'];
            $this->mod_set_worker_profile->Image = $data['file_name'];
        }
    }

    public function edit() {
        $buildingName = $this->session->userdata('BuildingName');
        $floor = $this->session->userdata('Floor');
        $data['tbl_section'] = $this->mod_set_employee_info_detail->get_department_name($buildingName, $floor);
        $data['tbl_job_category'] = $this->mod_set_employee_info_detail->get_job_category_name();
        $data['tbl_district'] = $this->mod_set_worker_profile->get_district_name();
        $this->mod_set_worker_profile->CardNo = $this->uri->segment(3);
        $data['tbl_worker_profile'] = $this->mod_set_worker_profile->view_by_id();
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';
//            exit();
        $data['container'] = 'temp/worker_profile/edit';
        $this->load->view('main_page', $data);
    }

    public function update() {
        $this->mod_set_worker_profile->CardNo = $this->uri->segment(3);
        $this->mod_set_worker_profile->Name = $this->input->post('Name');
        $this->mod_set_worker_profile->Designation = $this->input->post('Designation');
        $this->mod_set_worker_profile->JoiningDate = $this->input->post('JoiningDate');
        $this->mod_set_worker_profile->CardNo = $this->input->post('CardNo');
        $this->mod_set_worker_profile->Grade = $this->input->post('Grade');
        $this->mod_set_worker_profile->GrossSalary = $this->input->post('GrossSalary');
        $this->mod_set_worker_profile->LastIncrementDate = $this->input->post('LastIncrementDate');
        $this->mod_set_worker_profile->LastIncrementMoney = $this->input->post('LastIncrementMoney');
        $this->mod_set_worker_profile->ContactNo = $this->input->post('ContactNo');
        $this->mod_set_worker_profile->NID = $this->input->post('NID');
        $this->mod_set_worker_profile->PromotionDate = date('Y-m-d', strtotime($this->input->post('PromotionDate')));
        $this->mod_set_worker_profile->GuardianName = $this->input->post('GuardianName');
        $this->mod_set_worker_profile->PermanentVillage = $this->input->post('PermanentVillage');
        $this->mod_set_worker_profile->PermanenttPost = $this->input->post('PermanenttPost');
        $this->mod_set_worker_profile->PermanentThana = $this->input->post('PermanentThana');
        $this->mod_set_worker_profile->PermanentDistrict = $this->input->post('PermanentDistrict');
        $this->mod_set_worker_profile->PresentVillage = $this->input->post('PresentVillage');
        $this->mod_set_worker_profile->PresentPost = $this->input->post('PresentPost');
        $this->mod_set_worker_profile->PresentThana = $this->input->post('PresentThana');
        $this->mod_set_worker_profile->PresentDistrict = $this->input->post('PresentDistrict');
        $this->mod_set_worker_profile->Reference = $this->input->post('Reference');
        $this->mod_set_worker_profile->EducationalQual = $this->input->post('EducationalQual');
        $this->mod_set_worker_profile->Image = $this->input->post('Image');
        $this->mod_set_worker_profile->ImageThumb = $this->input->post('ImageThumb');
        $this->mod_set_worker_profile->Comment = $this->input->post('Comment');
        $this->mod_set_worker_profile->Status = $this->input->post('Status');
        $this->mod_set_worker_profile->BuildingName = $this->input->post('BuildingName');
        $this->mod_set_worker_profile->Floor = $this->input->post('Floor');
        $this->mod_set_worker_profile->Department = $this->input->post('Department');
        $this->mod_set_worker_profile->Line = $this->input->post('Line');
        $this->mod_set_worker_profile->Parameter5 = $this->input->post('Parameter5');
        $this->mod_set_worker_profile->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_employee_info_detail/example', 'refresh');
    }

    public function delete() {
        $this->mod_set_worker_profile->ID = $this->input->post('ID');
        $this->mod_set_worker_profile->delete();
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_worker_profile/view', 'refresh');
    }

}
