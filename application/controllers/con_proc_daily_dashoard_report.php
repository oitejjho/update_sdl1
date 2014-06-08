<?php

class Con_proc_daily_dashoard_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_daily_dashoard_report');
        $this->load->model('mod_set_worker_profile');
        $this->load->model('mod_access_log_raw');
        $this->load->model('mod_access_log');
        $this->load->model('mod_leave_detail');
        $this->load->helper('alert');
    }

    public function view_dashboard_report() {
        $this->mod_daily_dashoard_report->EmptyTable();
        $this->sendDataToDailyDashBoard();
        $data['tbl_dashboard_report'] = $this->mod_daily_dashoard_report->view();
        $data['current_attendance'] = $this->mod_daily_dashoard_report->get_daily_log();
        $data['on_leave'] = $this->mod_daily_dashoard_report->get_on_leave();
        $data['container'] = 'temp/deshboard/view';
        $this->load->view('main_page', $data);
    }

    public function sendDataToDailyDashBoard() {
        date_default_timezone_set('Asia/Dacca');
        //$dash_board = array();
        $dash_board_report = array();
        $date = date('Y-m-d', now());
        for ($index = 0; $index < 7; $index++) {
            $dash_board['Date'] = $date;
            $dash_board['Total_employee'] = count($this->mod_set_worker_profile->view());
            $dash_board['On_leave'] = count($this->mod_leave_detail->DateSpecificAllLeaves($date));
            if ($index == 0) {
                //echo $date.'<br/>';
                $dash_board['Total_present'] = count($this->mod_access_log_raw->getDateSpecificLongData($date));
            } else {
                //echo $date.'<br/>';
                $dash_board['Total_present'] = count($this->mod_access_log->getDateSpecificLongData1($date));
            }
            $dash_board['Total_absent'] = $dash_board['Total_employee']-$dash_board['Total_present']-$dash_board['On_leave'];
            array_push($dash_board_report,$dash_board);
            $date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
        }
        //echo $dash_board_report['Total_employee'];
        $this->mod_daily_dashoard_report->insert_batch_random_data($dash_board_report);
        //$this->view_dashboard_report();
    }

    public function generateData() {
        $data_tbl_dashboard_report = array();
        $Date = "2014-03-31";
        for ($index = 1; $index <= 31; $index++) {
            $data_tbl_dashboard_log['Date'] = date('Y-m-d', strtotime($Date . ' + ' . $index . ' days'));
            $data_tbl_dashboard_log['Total_employee'] = 14000;
            $data_tbl_dashboard_log['Total_present'] = mt_rand(5000, 14000);
            $data_tbl_dashboard_log['On_leave'] = mt_rand(1, 15);
            $data_tbl_dashboard_log['Total_absent'] = $data_tbl_dashboard_log['Total_employee'] - $data_tbl_dashboard_log['Total_present'] - $data_tbl_dashboard_log['On_leave'];
            array_push($data_tbl_dashboard_report, $data_tbl_dashboard_log);
        }
        $this->mod_daily_dashoard_report->insert_batch_random_data($data_tbl_dashboard_report);
        echo 'Random Data Inserted Successfully';
    }

    function test() {
        $this->db->query('select');
        echo date('Y-m-d', strtotime($Date . ' + 1 days'));
        echo date('Y-m-d', strtotime($Date . ' + 2 days'));
    }

}

?>
