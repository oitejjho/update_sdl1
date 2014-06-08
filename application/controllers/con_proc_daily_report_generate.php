<?php

ini_set('max_execution_time', 6000);
ini_set('memory_limit', '512M');

class Con_proc_daily_report_generate extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_access_log');
        $this->load->model('mod_access_log_raw');
        $this->load->model('mod_access_log_raw_backup');
        $this->load->model('mod_access_log_backup');
        $this->load->model('mod_incurrect_access_log');
        $this->load->model('mod_incurrect_access_log_backup');
        $this->load->model('mod_daily_attendance_log');
        $this->load->model('mod_set_work_hour_breakdown');
//        $this->load->model('mod_monthly_wages_detail');
        $this->load->helper('alert');
        $this->load->helper('date');
    }

    public function search() {
        $data['container'] = 'temp/daily_report_generate/search';
        $this->load->view('main_page', $data);
    }

    public function AttendaceSheet() {
        $con = mysqli_connect("localhost", "root", "", "wages_manegement");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $result = mysqli_query($con, "SELECT COUNT(distinct cardno ) as 'total' FROM tbl_access_log_raw ");

        if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit();
        } else {

            echo 'Total employee present : ' . $result->fetch_object()->total . '<br/>';
        }
        mysqli_close($con);
    }

    public function SeperateValidData($Month) {
        $this->mod_access_log_raw->TruncateInvalidData();
        $days = $this->mod_access_log_raw->GetDistinctDates($Month);
        echo '<pre>';
        print_r($days);
        echo '</pre>';
//        exit();
        $limit = count($days) - 1;
        $tbl_access_log = array();
        $tbl_incurrect_access_log = array();
        for ($index = 0; $index <= $limit; $index++) {
            $rows = $this->mod_access_log_raw->getDateSpecificLongDataArray($days[$index]['DATE(  `InTime` )']);
            $limit1 = count($rows) - 1;
            //echo $limit1 . '<br/>';
            for ($index1 = 0; $index1 <= $limit1; $index1++) {
                $inTime = $outTime = $rows[$index1]['InTime'];
                while (($index1 != $limit1) && ($rows[$index1]['CardNo'] == $rows[$index1 + 1]['CardNo'])) {
                    if (date('Y-m-d H:i:s', strtotime($inTime)) > date('Y-m-d H:i:s', strtotime($rows[$index1 + 1]['InTime']))) {
                        $inTime = $rows[$index1 + 1]['InTime'];
                    }
                    if (date('Y-m-d H:i:s', strtotime($outTime)) < date('Y-m-d H:i:s', strtotime($rows[$index1 + 1]['InTime']))) {
                        $to_time = strtotime($inTime);
                        $from_time = strtotime($rows[$index1 + 1]['InTime']);
                        if ((round(abs($to_time - $from_time) / 60, 2)) > 5) {
                            $outTime = $rows[$index1 + 1]['InTime'];
                        }
                    }
                    $index1++;
                }
                if ($inTime == $outTime) {
                    $an_incurrect_access_log['CardNo'] = $rows[$index1]['CardNo'];

                    $an_incurrect_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($inTime));
                    $an_incurrect_access_log['Status'] = 'IN';
                    $an_incurrect_access_log['CreatedBy'] = 'SYSTEM';
                    $an_incurrect_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_incurrect_access_log, $an_incurrect_access_log);
                    //echo 'Invalid-->' . $rows[$index1]['CardNo'] . '<br/>';
                } else {
                    $an_access_log['CardNo'] = $rows[$index1]['CardNo'];
                    $an_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($inTime));
                    $an_access_log['Status'] = 'IN';
                    $an_access_log['CreatedBy'] = 'SYSTEM';
                    $an_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_access_log, $an_access_log);
                    //echo 'Valid-->' . $rows[$index1]['CardNo'] . '<br/>';
                    $an_access_log['CardNo'] = $rows[$index1]['CardNo'];
                    $an_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($outTime));
                    $an_access_log['Status'] = 'OUT';
                    $an_access_log['CreatedBy'] = 'SYSTEM';
                    $an_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_access_log, $an_access_log);
                }
            }
        }
        if (!empty($tbl_access_log))
            $this->mod_access_log->insert_batch_random_data($tbl_access_log);
        if (!empty($tbl_incurrect_access_log))
            $this->mod_incurrect_access_log->insert_batch_random_data($tbl_incurrect_access_log);
        echo 'Inserted';
//        echo 'Valid-->' . count($tbl_access_log) . '<br/>';
//        echo 'Invalid-->' . count($tbl_incurrect_access_log) . '<br/>';
    }

    public function view_daily_report() {
        $data['tbl_daily_attendance_log'] = $this->mod_daily_attendance_log->view();
        $data['container'] = 'temp/daily_report_generate/daily_attendence_view';
        $this->load->view('main_page', $data);
    }

    public function generate_daily_report($Month) {
        $days = $this->mod_access_log->GetDistinctDates($Month);
//        echo '<pre>';
//        print_r($days);
//        echo '</pre>';
        //exit();
        $limt = count($days) - 1;
        for ($index = 0; $index <= $limt; $index++) {
            $data_tbl_daily_whole = array();
            $data['tbl_work_hour_breakdown'] = $this->mod_set_work_hour_breakdown->view1();
            $data['tbl_access_log'] = $this->mod_access_log->getDateSpecificLongData($days[$index]['DATE(`DateTime`)']);
            echo $days[$index]['DATE(`DateTime`)'] . '<br/>';
//            echo '<pre>';
//            print_r($data['tbl_access_log']);
//            echo '</pre>';
            //exit();
            $flag = TRUE;
            $one_flag = TRUE;
            $data_tbl_daily['TotalWorkedHour'] = date("H:i:s", 0);
            $data_tbl_daily['GenarelWorkHour'] = date("H:i:s", 0);
            $data_tbl_daily['OverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['AdditionalOverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['NihgtShiftOverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['InTime'] = 0;
            foreach ($data['tbl_access_log'] as $rec_access_log) {
                if ($one_flag) {
                    $total_hour_worked = date("H:i:s", 0);
                    $previous = $rec_access_log;
                    $current = $rec_access_log;
                    $date = explode(' ', $previous->DateTime);
                    $in_time = $date[0] . ' ' . '02:20:00';
                    $night_start_time = $date[0] . ' ' . '17:59:59';
                    if (strtotime($previous->DateTime) < strtotime($in_time))
                        $data_tbl_daily['InTime'] = 1;
                    $one_flag = FALSE;
                } else {
                    if ($flag) {//even numbered row
                        $current = $rec_access_log;
                        $in = strtotime($previous->DateTime);
                        $out = strtotime($current->DateTime);
                        date_default_timezone_set('GMT');
                        $diff = abs($out - $in);
                        echo '<br/>' . date('H:i:s', $diff) . '<br/>' . $current->CardNo;
                        $hour_diff = date("H:i:s", $diff);
                        $total_hour_worked+=$hour_diff;
                        $flag = FALSE;
                    } else {//odd no row
                        $previous = $rec_access_log;
                        if (($total_hour_worked != 0) && ($previous->CardNo != $current->CardNo)) {
                            $data_tbl_daily['Date'] = date("Y-m-d ", strtotime($current->DateTime));
                            $data_tbl_daily['CardNo'] = $current->CardNo;
                            $data_tbl_daily['TotalWorkedHour'] = $total_hour_worked;

                            if ($total_hour_worked > date("H:i:s", 32400)) {
                                $data_tbl_daily['GenarelWorkHour'] = date("H:i:s", 32400);
                                $total_hour_worked = $total_hour_worked - date("H:i:s", 32400);
                            } else {
                                $data_tbl_daily['GenarelWorkHour'] = $total_hour_worked;
                                $total_hour_worked = date("H:i:s", 0);
                            }

                            if ($total_hour_worked > date("H:i:s", 10800)) {
                                $data_tbl_daily['OverTimeHour'] = date("H:i:s", 10800);
                                $data_tbl_daily['OT'] = TRUE;
                                $total_hour_worked = $total_hour_worked - date("H:i:s", 10800);
                            } else {
                                $data_tbl_daily['OverTimeHour'] = $total_hour_worked;
                                $total_hour_worked = date("H:i:s", 0);
                                if ($data_tbl_daily['OverTimeHour'] > 0)
                                    $data_tbl_daily['OT'] = TRUE;
                                else
                                    $data_tbl_daily['OT'] = FALSE;
                            }

                            if ($total_hour_worked > date("H:i:s", 10800)) {
                                $data_tbl_daily['AdditionalOverTimeHour'] = date("H:i:s", 10800);
                                $total_hour_worked = $total_hour_worked - date("H:i:s", 10800);
                                $data_tbl_daily['AOT'] = TRUE;
                            } else {
                                $data_tbl_daily['AdditionalOverTimeHour'] = $total_hour_worked;
                                $total_hour_worked = date("H:i:s", 0);
                                if ($data_tbl_daily['AdditionalOverTimeHour'] > 0)
                                    $data_tbl_daily['AOT'] = TRUE;
                                else
                                    $data_tbl_daily['AOT'] = FALSE;
                            }

                            if ($total_hour_worked > date("H:i:s", 7200)) {
                                $data_tbl_daily['NihgtShiftOverTimeHour'] = $total_hour_worked;
                                $total_hour_worked = $total_hour_worked - date("H:i:s", 7200);
                                $data_tbl_daily['Night'] = TRUE;
                            } else {
                                $data_tbl_daily['NihgtShiftOverTimeHour'] = $total_hour_worked;
                                $total_hour_worked = date("H:i:s", 0);
                                if ($data_tbl_daily['NihgtShiftOverTimeHour'] > 0)
                                    $data_tbl_daily['Night'] = TRUE;
                                else
                                    $data_tbl_daily['Night'] = FALSE;
                            }

                            if ($data_tbl_daily['NihgtShiftOverTimeHour'] == date("H:i:s", 0) && $out > strtotime($night_start_time)) {
                                $data_tbl_daily['NihgtShiftOverTimeHour'] = -1;
                                $data_tbl_daily['Night'] = TRUE;
                            }
                            array_push($data_tbl_daily_whole, $data_tbl_daily);

                            if (strtotime($previous->DateTime) < strtotime($in_time))
                                $data_tbl_daily['InTime'] = 1; //new card in time or not
                            else {
                                $data_tbl_daily['InTime'] = 0;
                            }
                            $data_tbl_daily['TotalWorkedHour'] = date("H:i:s", 0);
                            $data_tbl_daily['GenarelWorkHour'] = date("H:i:s", 0);
                            $data_tbl_daily['OverTimeHour'] = date("H:i:s", 0);
                            $data_tbl_daily['AdditionalOverTimeHour'] = date("H:i:s", 0);
                            $data_tbl_daily['NihgtShiftOverTimeHour'] = date("H:i:s", 0);

                            $total_hour_worked = date("H:i:s", 0);
                        }
                        $flag = TRUE;
                    }
                }
            }
            $data_tbl_daily['Date'] = date("Y-m-d ", strtotime($current->DateTime));
            $data_tbl_daily['CardNo'] = $current->CardNo;
            $data_tbl_daily['TotalWorkedHour'] = $total_hour_worked;

            if ($total_hour_worked > date("H:i:s", 32400)) {
                $data_tbl_daily['GenarelWorkHour'] = date("H:i:s", 32400);
                $total_hour_worked = $total_hour_worked - date("H:i:s", 32400);
            } else {
                $data_tbl_daily['GenarelWorkHour'] = $total_hour_worked;
                $total_hour_worked = date("H:i:s", 0);
            }

            if ($total_hour_worked > date("H:i:s", 10800)) {
                $data_tbl_daily['OverTimeHour'] = date("H:i:s", 10800);
                $total_hour_worked = $total_hour_worked - date("H:i:s", 10800);
                $data_tbl_daily['OT'] = TRUE;
            } else {
                $data_tbl_daily['OverTimeHour'] = $total_hour_worked;
                $total_hour_worked = date("H:i:s", 0);
                if ($data_tbl_daily['OverTimeHour'] > 0)
                    $data_tbl_daily['OT'] = TRUE;
                else
                    $data_tbl_daily['OT'] = FALSE;
            }

            if ($total_hour_worked > date("H:i:s", 10800)) {
                $data_tbl_daily['AdditionalOverTimeHour'] = date("H:i:s", 10800);
                $total_hour_worked = $total_hour_worked - date("H:i:s", 10800);
                $data_tbl_daily['AOT'] = TRUE;
            } else {
                $data_tbl_daily['AdditionalOverTimeHour'] = $total_hour_worked;
                $total_hour_worked = date("H:i:s", 0);
                if ($data_tbl_daily['AdditionalOverTimeHour'] > 0)
                    $data_tbl_daily['AOT'] = TRUE;
                else
                    $data_tbl_daily['AOT'] = FALSE;
            }

            if ($total_hour_worked > date("H:i:s", 7200)) {
                $data_tbl_daily['NihgtShiftOverTimeHour'] = $total_hour_worked;
                $total_hour_worked = $total_hour_worked - date("H:i:s", 7200);
                $data_tbl_daily['Night'] = TRUE;
            } else {
                $data_tbl_daily['NihgtShiftOverTimeHour'] = $total_hour_worked;
                $total_hour_worked = date("H:i:s", 0);
                if ($data_tbl_daily['NihgtShiftOverTimeHour'] > 0)
                    $data_tbl_daily['Night'] = TRUE;
                else
                    $data_tbl_daily['Night'] = FALSE;
            }

            if ($data_tbl_daily['NihgtShiftOverTimeHour'] == date("H:i:s", 0) && $out > strtotime($night_start_time)) {
                $data_tbl_daily['NihgtShiftOverTimeHour'] = -1;
                $data_tbl_daily['Night'] = TRUE;
            }
            array_push($data_tbl_daily_whole, $data_tbl_daily);
            $data_tbl_daily['TotalWorkedHour'] = date("H:i:s", 0);
            $data_tbl_daily['GenarelWorkHour'] = date("H:i:s", 0);
            $data_tbl_daily['OverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['AdditionalOverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['NihgtShiftOverTimeHour'] = date("H:i:s", 0);
            $data_tbl_daily['InTime'] = 0;
            $total_hour_worked = date("H:i:s", 0);
            //exit();
            $this->mod_daily_attendance_log->insert_batch_daily_report($data_tbl_daily_whole);
        }
    }

    public function view_by_id() {
        if ($this->input->post('submit') == 'Search') {
            $this->mod_access_log->CardNo = $this->input->post('CardNo');
            $this->mod_access_log->DateTime = date("Y-m-d ", strtotime($this->input->post('DateTime')));
            $data['tbl_access_log'] = $this->mod_access_log->view_by_id();
            $m = count($data['tbl_access_log']);
            if (!($m % 2) == 0)
                $data['msg'] = 'This User has some problems with access';
            $data['container'] = 'temp/daily_report_generate/view';
            $this->load->view('main_page', $data);
        }
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_access_log->ID = $this->input->post('ID');
            $data['tbl_log'] = $this->mod_access_log->view_by_id();
            $data['container'] = 'temp/log/edit';
            $this->load->view('temp/main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function SubTractTime($tbl_access_log_raw) {
        $limit = count($tbl_access_log_raw) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            $date = new DateTime($tbl_access_log_raw[$index]['DateTime']);
            $date->modify("-6 hours");
            $tbl_access_log_raw[$index]['InTime'] = $date->format("Y-m-d H:i:s");
            $tbl_access_log_raw[$index]['Ip'] = $tbl_access_log_raw[$index]['IP'];
            unset($tbl_access_log_raw[$index]['DateTime']);
            unset($tbl_access_log_raw[$index]['IP']);
        }
        return $tbl_access_log_raw;
    }

    public function pull_data_from_access_log($today) {
        date_default_timezone_set('Asia/Dacca');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($today)));
        //echo $today . '<br/>' . $yesterday;
        $tbl_access_log_raw = $this->mod_access_log->get_floor_specific_access_record($today);
        echo count($tbl_access_log_raw);
        if (count($tbl_access_log_raw) > 0) {
            $tbl_access_log_raw = $this->SubTractTime($tbl_access_log_raw);
            $this->mod_access_log_raw->insert_batch_random_data($tbl_access_log_raw);
        }
        //populate tbl_access_log & tbl_incurrect_access_log
        $this->seperate_valid_data($yesterday);
    }

    public function seperate_valid_data($yesterday) {
        $tbl_access_log_raw = $this->mod_access_log_raw->getDateSpecificLongDataArray($yesterday);
        if (count($tbl_access_log_raw) > 0) {
            $tbl_incurrect_access_log = array();
            $tbl_access_log = array();
            $limit1 = count($tbl_access_log_raw) - 1;
            for ($index1 = 0; $index1 <= $limit1; $index1++) {
                $inTime = $outTime = $tbl_access_log_raw[$index1]['InTime'];
                while (($index1 != $limit1) && ($tbl_access_log_raw[$index1]['CardNo'] == $tbl_access_log_raw[$index1 + 1]['CardNo'])) {
                    if (date('Y-m-d H:i:s', strtotime($inTime)) > date('Y-m-d H:i:s', strtotime($tbl_access_log_raw[$index1 + 1]['InTime']))) {
                        $inTime = $tbl_access_log_raw[$index1 + 1]['InTime'];
                    }
                    if (date('Y-m-d H:i:s', strtotime($outTime)) < date('Y-m-d H:i:s', strtotime($tbl_access_log_raw[$index1 + 1]['InTime']))) {
                        $to_time = strtotime($inTime);
                        $from_time = strtotime($tbl_access_log_raw[$index1 + 1]['InTime']);
                        if ((round(abs($to_time - $from_time) / 60, 2)) > 5) {
                            $outTime = $tbl_access_log_raw[$index1 + 1]['InTime'];
                        }
                    }
                    $index1++;
                }
                if ($inTime == $outTime) {
                    $an_incurrect_access_log['CardNo'] = $tbl_access_log_raw[$index1]['CardNo'];

                    $an_incurrect_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($inTime));
                    $an_incurrect_access_log['Status'] = 'IN';
                    $an_incurrect_access_log['CreatedBy'] = 'SYSTEM';
                    $an_incurrect_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_incurrect_access_log, $an_incurrect_access_log);
                    //echo 'Invalid-->' . $tbl_access_log_raw[$index1]['CardNo'] . '<br/>';
                } else {
                    $an_access_log['CardNo'] = $tbl_access_log_raw[$index1]['CardNo'];
                    $an_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($inTime));
                    $an_access_log['Status'] = 'IN';
                    $an_access_log['CreatedBy'] = 'SYSTEM';
                    $an_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_access_log, $an_access_log);
                    //echo 'Valid-->' . $tbl_access_log_raw[$index1]['CardNo'] . '<br/>';
                    $an_access_log['CardNo'] = $tbl_access_log_raw[$index1]['CardNo'];
                    $an_access_log['DateTime'] = date('Y-m-d H:i:s', strtotime($outTime));
                    $an_access_log['Status'] = 'OUT';
                    $an_access_log['CreatedBy'] = 'SYSTEM';
                    $an_access_log['DelStatus'] = 'ACT';
                    array_push($tbl_access_log, $an_access_log);
                }
            }
            if (!empty($tbl_access_log))
                $this->mod_access_log->insert_batch_random_data($tbl_access_log);
            if (!empty($tbl_incurrect_access_log))
                $this->mod_incurrect_access_log->insert_batch_random_data($tbl_incurrect_access_log);
            echo 'Inserted';
        }
    }

    function test_absent() {

        $result_raw = $this->db->query('SELECT distinct(CardNo) from tbl_access_log_raw where intime like "2014-06-03%"');

        $result_profile = $this->db->query('SELECT Name, CardNo from tbl_employee_profile');

//       echo '<pre>';
//       print_r($result_profile->result());
//       echo '</pre>';
        $count = 0;
        foreach ($result_raw->result() as $info) {
            foreach ($result_profile->result() as $pro_info) {
                if ($info->CardNo == $pro_info->CardNo) {
                    $pro_info->Name = 'Present';
                }
            }
        }
//        echo '<pre>';
//        print_r($result_profile->result());
//        echo '</pre>';
       echo '<html> <head>
<meta charset="UTF-8">
<meta name="description" content="Free Web tutorials">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="Hege Refsnes">
</head> <body>';
        foreach ($result_profile->result() as $pro_info) {
            if ($pro_info->Name != 'Present') {
                echo $pro_info->CardNo.'<br/>';
                echo $pro_info->Name.'<br/>';
            }
        }
        echo '</body></html>';
    }

    public function SubTracTime() {
        $tbl_access_log = $this->mod_access_log->GetTbl_access_data();

        $limit = count($tbl_access_log) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            $date = new DateTime($tbl_access_log[$index]['DateTime']);
            $date->modify("-6 hours");
            $tbl_access_log[$index]['DateTime'] = $date->format("Y-m-d H:i:s");
        }
//        echo '<pre>';
//        print_r($tbl_access_log);
//        echo '</pre>';
        
        $this->mod_access_log->EmptyTable1();
        $this->mod_access_log->insert_batch_random_data($tbl_access_log);
        echo 'Updated';
    }

}

?>
