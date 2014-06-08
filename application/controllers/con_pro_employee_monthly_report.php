<?php
class Con_pro_employee_monthly_report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_pro_employee_monthly_report');
        $this->load->model('mod_access_log');
        $this->load->model('mod_leave_detail');
        $this->load->model('mod_pro_attn_mismatch_report');
        $this->load->model('mod_leave_type_allocation');
        $this->load->helper('date');
    }

    public function index() {
        $data['container'] = 'temp/employee_monthly_report/search';
        $this->load->view('main_page', $data);
    }

    public function search() {
        $CardNo = $this->input->post('CardNo');
        $Month = $this->input->post('Month');
        $data['tbl_employee_monthly_report'] = $this->mod_pro_employee_monthly_report->view_by_CardNo($CardNo, $Month);
        $data['tbl_employee_monthly_missmatch_report'] = $this->mod_pro_employee_monthly_report->view_by_CardNo_missmatch($CardNo, $Month);
        $data['tbl_employee_monthly_leave_report'] = $this->mod_leave_detail->view_by_CardNo($CardNo, $Month);
//$data['tbl_employee_leave'];
        $data['container'] = 'temp/employee_monthly_report/view';
        $this->load->view('main_page', $data);
    }

    public function delete_monthly_attandance_record() {
      $CardNo = $this->input->post('CardNo');
        $Date = $this->input->post('DateTime');

        if ($this->mod_pro_employee_monthly_report->delete_monthly_attandance($CardNo, $Date)) {
            echo json_encode(array("success" => "true"));
        } else{
             echo json_encode(array("success" => "false"));
        }
    }
    
    public function search_get($CardNo, $Month) {
        $data['tbl_employee_monthly_report'] = $this->mod_pro_employee_monthly_report->view_by_CardNo($CardNo, $Month);
        $data['tbl_employee_monthly_missmatch_report'] = $this->mod_pro_employee_monthly_report->view_by_CardNo_missmatch($CardNo, $Month);
        $data['tbl_employee_monthly_leave_report'] = $this->mod_leave_detail->view_by_CardNo($CardNo, $Month);
//$data['tbl_employee_leave'];
        $data['container'] = 'temp/employee_monthly_report/view';
        $this->load->view('main_page', $data);
    }

    public function update() {
        $CardNo = $this->input->post('CardNo');
        $DateTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('DateTime'))));
        $DateTimeOld = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('DateTimeOld'))));


        $this->mod_pro_employee_monthly_report->update_in_out_time($CardNo, $DateTime, $DateTimeOld);
    }

    public function generic_intime() {
        $cardNo = $this->input->post('CardNo');
        $Month = $this->input->post('Month');
        $InTime = $this->input->post('Intime');
        $data['tbl_mismatch_report'] = $this->mod_pro_employee_monthly_report->view_by_CardNo_missmatch($cardNo, $Month);
        foreach ($data['tbl_mismatch_report'] as $tbl_missmatch) {
            //echo date('H:i:s', strtotime($tbl_missmatch['DateTime'])) . "<br />"; //.date('H:i:s',  strtotime('03:00:00'))."<br />";
            if (date('H:i:s', strtotime($tbl_missmatch['DateTime'])) >= date('H:i:s', strtotime('06:00:00'))) {
                $InTimeSend = date('Y-m-d', strtotime($tbl_missmatch['DateTime'])) . " " . $InTime;
                $InTimeSend = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($InTimeSend)));
                $this->insert_generic_intime($cardNo, $InTimeSend, date('Y-m-d H:i:s', strtotime($tbl_missmatch['DateTime'])));
            } else {
                $OutTimeSend = date('Y-m-d', strtotime($tbl_missmatch['DateTime'])) . " " . '11:15:00';
                $OutTimeSend = date('Y-m-d H:i:s', strtotime($OutTimeSend));
                $this->insert_generic_outtime($cardNo, date('Y-m-d H:i:s', strtotime($tbl_missmatch['DateTime'])), $OutTimeSend);
            }
        }
        $this->search_get($cardNo, $Month);

        //$this->load->view('main_page', $data);
    }

    public function insert_generic_intime($cardno, $InTime, $OutTime) {

        $Indata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($InTime)),
            "Status" => "IN",
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        $Outdata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($OutTime)),
            "Status" => "OUT",
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        $this->mod_pro_attn_mismatch_report->UpdateIncurrenctAccessLog($cardno, $OutTime);
        $this->mod_access_log->insert($Indata);
        $this->mod_access_log->insert($Outdata);
    }

    public function insert_generic_outtime($cardno, $InTime, $OutTime) {

        $Indata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($InTime)),
            "Status" => "IN",
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        $Outdata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($OutTime)),
            "Status" => "OUT",
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        $this->mod_pro_attn_mismatch_report->UpdateIncurrenctAccessLog($cardno, $InTime);
        $this->mod_access_log->insert($Indata);
        $this->mod_access_log->insert($Outdata);
    }

    public function Leave_Details_Delete($cardNo, $date) {
        $leaveType = $this->mod_leave_detail->get_leave_type_name($cardNo, $date);
        $leaveType = $leaveType[0]['LeaveCategoryName'];
        $this->mod_leave_type_allocation->CardNo = $cardNo;
        $this->mod_leave_type_allocation->LeaveType = $leaveType;
        $this->mod_leave_type_allocation->Year = date('Y', strtotime($date));
        $card_specific_leave_data = $this->mod_leave_type_allocation->view_by_id();
        foreach ($card_specific_leave_data as $a_data) {
            if ($a_data->LeaveType == $leaveType) {
                $this->mod_leave_type_allocation->Days = $a_data->Days + 1;
                $this->mod_leave_type_allocation->update();
            }
        }
        $this->mod_leave_detail->LeaveEntryDelete($cardNo, $date);
        $this->search_get($cardNo, date('m', strtotime($date)));
    }
     public function insert1() {

        date_default_timezone_set('Asia/Dacca');

        $cardno = $this->input->post("icCard");
        $myintime = array();
        $Indata = array();
        $Outdata = array();
        $count = 0;
        $mm = $this->input->post('outime');
        foreach ($this->input->post('intime') as $value) {
            $InTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($value)));
            $OutTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($mm[$count])));
            if (date('H:i:s', strtotime($InTime)) < date('H:i:s', strtotime('04:59:59'))) {
                $status = 'IN';
            } else {
                $status = 'OUT';
            }
            $Indata[] = array(
                "CardNo" => $cardno,
                "DateTime" => date('Y-m-d H:i:s', strtotime($InTime)),
                "Status" => $status,
                "CreatedBy" => $this->session->userdata('Email'),
                "DelStatus" => 'ACT'
            );
            if (date('H:i:s', strtotime($OutTime)) > date('H:i:s', strtotime('04:59:59'))) {
                $status = 'OUT';
            } else {
                $status = 'IN';
            }
            $Outdata[] = array(
                "CardNo" => $cardno,
                "DateTime" => date('Y-m-d H:i:s', strtotime($OutTime)),
                "CreatedBy" => $this->session->userdata('Email'),
                "Status" => $status,
                "DelStatus" => 'ACT'
            );
            $count++;
            $myintime[] = $InTime;
        }
        $this->mod_pro_employee_monthly_report->UpdateIncurrenctAccessLog11($cardno, $myintime);
        $this->mod_pro_employee_monthly_report->insert11($Indata);
        $this->mod_pro_employee_monthly_report->insert11($Outdata);

         echo json_encode(array("success" => "true"));
    }


}
