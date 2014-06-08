<?php

class Mod_access_log_raw extends CI_Model {

    public $CardNo;
    public $InTime;
    public $Ip;

    public function insert_batch_random_data($data) {
        $this->db->insert_batch('tbl_access_log_raw', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_access_log_raw');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_access_log_raw');
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('InTime BETWEEN ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 00:00:01')) . '"' . ' AND ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 23:59:59')) . '"', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

//    public function update() {
//        $data = array(
//            'RewaredName' => $this->RewaredName,
//            'RewaredAmount' => $this->RewaredAmount,
//            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
//            'BasicXTime' => $this->BasicXTime,
//            'CompensatoryHolyday' => $this->CompensatoryHolyday
//        );
//        $this->db->where('ID', $this->ID);
//        if ($this->db->update('tbl_additional_reward_staff', $data)) {
//            return TRUE;
//        }
//        return false;
//    }
    public function getLongData() {

        $this->db->select('*');
        $this->db->from('tbl_access_log_raw');
        $this->db->order_by('CardNo asc, InTime asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function EmptyTable() {
        $this->db->truncate('tbl_access_log_raw');
    }

    public function getLongDataArray() {

        $this->db->select('*');
        $this->db->from('tbl_access_log_raw');
        $this->db->order_by('CardNo asc, InTime asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function TruncateInvalidData() {
        $this->db->query("DELETE FROM  `tbl_access_log_raw` WHERE  `InTime` =  '0000-00-00'");
    }

    public function GetDistinctDates($Month) {

        $query = $this->db->query("SELECT DATE(  `InTime` ) 
                                    FROM tbl_access_log_raw WHERE InTime LIKE  '%-" . $Month . "-%'
                                    GROUP BY DATE(  `InTime` ) ");
        return $query->result_array();
    }

    public function MonthSpecificGetDistinctDates($month) {
        $year = date('Y', now());
        $firstDate = $year . '-' . $month . '-' . '1';
        $lastDate = date('Y-m-t', strtotime($firstDate));
        $firstDateTime = $firstDate . ' 00:00:01';
        $lastDateTime = $lastDate . ' 23:59:59';
        //echo $firstDateTime.'<br/>'.$lastDateTime;
        //exit();
        $query = $this->db->query("SELECT DATE(  `InTime` ) FROM tbl_access_log_raw 
                                    where Intime between '" . $firstDateTime . "' and '" . $lastDateTime .
                "' GROUP BY DATE(  `InTime` )");
        return $query->result_array();
    }

    public function getDateSpecificLongData($date) {
        $first_date_time = $date . ' 00:00:01';
        $last_date_time = $date . ' 23:59:59';
        $query = $this->db->query("SELECT * FROM `tbl_access_log_raw` WHERE intime between '" . $first_date_time . "' and '" . $last_date_time . "' group by CardNo order by CardNo asc");
//        echo '<pre>';
//        print_r("SELECT distinct(cardno) FROM `tbl_access_log_raw` WHERE intime between '".$first_date_time."' and '".$last_date_time."' order by CardNo asc");
//        echo '</pre>';
//        exit();
        return $query->result_array();
    }

    public function getDateSpecificLongDataArray($date) {
        $first_date_time = $date . ' 00:00:01';
        $last_date_time = $date . ' 23:59:59';
        $this->db->select('*');
        $this->db->where('InTime >=', date('Y-m-d H:i:s', strtotime($first_date_time)));
        $this->db->where('InTime <=', date('Y-m-d H:i:s', strtotime($last_date_time)));
        $this->db->from('tbl_access_log_raw');
        $this->db->order_by('cardno asc, InTime asc');
        $query = $this->db->get();
//        echo '<pre>';
//        print_r($query->result());
//        echo '</pre>';
//        exit();
        return $query->result_array();
    }

    public function insert($data) {
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        exit();
        $this->db->insert('tbl_access_log_raw', $data);
    }

}