<?php

class Mod_daily_dashoard_report extends CI_Model {
    
    public function insert_batch_random_data($data) {
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        exit();
        $this->db->insert_batch('tbl_dashboard_report', $data);
    }
    public function EmptyTable() {
        $this->db->truncate('tbl_dashboard_report');
    }

    public function view() {
        $this->db->where("Date >= DATE_ADD(CURDATE(), INTERVAL '-7' DAY) limit 7");
        $query = $this->db->get('tbl_dashboard_report');    
        return $query->result();
    }
    
    public function get_daily_log(){
        $this->db->where('date', 'CURDATE()', FALSE);
        $query = $this->db->get('tbl_dashboard_report');
        return $query->result();
    }
    
    public function get_on_leave() {
        $this->db->where("Date >= DATE_ADD(CURDATE(), INTERVAL '-1' DAY) limit 1");
        $query = $this->db->get('tbl_dashboard_report');    
        return $query->result();
    }
//
//    public function get_current_status() {
//        $this->db->where('DATE(Date) = DATE()');
//        $query = $this->db->get('tbl_dashboard_report');    
//        return $query->result();
//    }
}
