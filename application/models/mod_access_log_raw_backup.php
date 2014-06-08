<?php

class Mod_access_log_raw_backup extends CI_Model {
    //tbl_access_log_raw_backup
    public $CardNo;
    public $InTime;
    public $Ip;
  

    //Insert Query for Course================================================================
//    public function insert() {
//        $data = array(
//            'RewaredName' => $this->RewaredName,
//            'RewaredAmount' => $this->RewaredAmount,
//            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
//            'BasicXTime' => $this->BasicXTime,
//            'CompensatoryHolyday' => $this->CompensatoryHolyday
//        );
//
//        $this->db->insert('tbl_additional_reward_staff', $data);
//    }
    public function insert_batch_random_data($data){
        $this->db->insert_batch('tbl_access_log_raw_backup', $data); 
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_access_log_raw_backup');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_access_log_raw_backup');
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('InTime BETWEEN '.'"'.date("Y-m-d H:i:s", strtotime($this->DateTime . ' 00:00:01')).'"'.' AND '.'"'.date("Y-m-d H:i:s", strtotime($this->DateTime . ' 23:59:59')).'"',NULL,FALSE);
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
        $this->db->from('tbl_access_log_raw_backup');
        $this->db->order_by('CardNo asc, InTime asc'); 
        $query = $this->db->get();
        return $query->result();
       
    }
    
    public function EmptyTable(){
        $this->db->truncate('tbl_access_log_raw_backup'); 
    }
    public function getLongDataArray() {
        
        $this->db->select('*');
        $this->db->from('tbl_access_log_raw_backup');
        $this->db->order_by('CardNo asc, InTime asc'); 
        $query = $this->db->get();
        return $query->result_array();
       
    }

}
