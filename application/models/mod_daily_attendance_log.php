<?php

class Mod_daily_attendance_log extends CI_Model {

    public $Date;
    public $CardNo;
    public $TotalWorkedHour;
    public $GenarelWorkHour;
    public $OverTimeHour;
    public $AdditionalOverTimeHour;
    public $NihgtShiftOverTimeHour;
    public $InTime;
    public $OT;
    public $AOT;
    public $Night;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'Date' => $this->Date,
            'CardNo' => $this->CardNo,
            'TotalWorkedHour' => $this->TotalWorkedHour,
            'GenarelWorkHour' => $this->GenarelWorkHour,
            'OverTimeHour' => $this->OverTimeHour,
            'AdditionalOverTimeHour' => $this->AdditionalOverTimeHour,
            'NihgtShiftOverTimeHour' => $this->NihgtShiftOverTimeHour,
            'OT' => $this->OT,
            'AOT' => $this->AOT,
            'Night' => $this->Night
        );

        $this->db->insert('tbl_daily_attendance_log', $data);
    }

    public function insert_batch_daily_report($data) {
        $this->db->insert_batch('tbl_daily_attendance_log', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_daily_attendance_log');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_daily_attendance_log');
        $this->db->where('CardNo', $this->CardNo);
        //$this->db->like('DateTime', $this->DateTime);
        $query = $this->db->get();
        return $query->result();
    }

    public function update() {
        $data = array(
            'Date' => $this->Date,
            'CardNo' => $this->CardNo,
            'TotalWorkedHour' => $this->TotalWorkedHour,
            'GenarelWorkHour' => $this->GenarelWorkHour,
            'OverTimeHour' => $this->OverTimeHour,
            'AdditionalOverTimeHour' => $this->AdditionalOverTimeHour,
            'NihgtShiftOverTimeHour' => $this->NihgtShiftOverTimeHour,
            'OT' => $this->OT,
            'AOT' => $this->AOT,
            'Night' => $this->Night
        );
        $this->db->where('CardNo', $this->CardNo);
        if ($this->db->update('tbl_daily_attendance_log', $data)) {
            return TRUE;
        }
        return false;
    }

    public function getLongData() {
        $this->db->select('*');
        $this->db->from('tbl_daily_attendance_log');
        $this->db->order_by('cardno asc, date asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getLongDataArray($Month) {
        //SELECT * FROM `tbl_daily_attendance_log` WHERE Date LIKE '%-05-%' ORDER BY CardNo,Date
        $query = $this->db->query("SELECT * FROM `tbl_daily_attendance_log`
                                    WHERE Date LIKE '%-".$Month."-%' 
                                    ORDER BY CardNo,Date");
        return $query->result_array();
//        $this->db->select('*');
//        $this->db->from('tbl_daily_attendance_log');
//        $this->db->where('CardNo', $this->CardNo);
//        $this->db->order_by('cardno asc, date asc');
//        $query = $this->db->get();
//        return $query->result_array();
    }

}
