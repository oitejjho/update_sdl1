<?php
class Mod_leave_type_allocation extends CI_Model {
    
    public $CardNo;
    public $LeaveType;
    public $ShortForm;
    public $Days;
    public $Year;
    
     //Insert Query for Leave Type Allocation Table ================================================================
    public function insert() {
        $data = array(
            'CardNo' => $this->CardNo,
            'LeaveType' => $this->LeaveType,
            'ShortForm' => $this->ShortForm,
            'Days' => $this->Days,
            'Year' => $this->Year
        );
        $this->db->insert('tbl_leave_type_allocation', $data);
    }

    //Update Query in Leave Type Allocation Table ===========================================================
    public function update() {
        $data = array(                        
            'Days' => $this->Days            
        );
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('LeaveType', $this->LeaveType);
        $this->db->where('Year', $this->Year);
        $this->db->update('tbl_leave_type_allocation', $data);
    }
    
    public function update_for_leave_allocation() {
        $data = array(                        
            'Days' => $this->Days            
        );
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('ShortForm', $this->ShortForm);
        $this->db->where('Year', $this->Year);
        $this->db->update('tbl_leave_type_allocation', $data);
    }

    //Delete Query for Leave Type Allocation Table ===========================================================
    public function delete() {
        $this->db->where('CardNo', $this->CardNo);
        $this->db->update('tbl_leave_type_allocation', $data);
    }

    //View Leave Type Allocation Table Information   ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_leave_type_allocation');
        $query = $this->db->get();
        return $query->result();
    }
    public function GetDataArray() {
        $this->db->select('*');
        $this->db->from('tbl_leave_type_allocation');
        $this->db->order_by('CardNo asc, LeaveType asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function GetYearDataArray($date) {
        $this->db->select('*');
        $this->db->from('tbl_leave_type_allocation');
        $this->db->where('Year', $date);
        $this->db->order_by('CardNo asc, LeaveType asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function CardSpecificLeaveAllocation($cardNo) {
        date_default_timezone_get('Asia/Dacca');
        $year = date('Y', now());
        $this->db->select('*');
        $this->db->from('tbl_leave_type_allocation');
        $this->db->where('CardNo', $cardNo);
        $this->db->where('Year', $year);
        $this->db->order_by('CardNo asc, LeaveType asc');
        $query = $this->db->get();
//        echo '<pre>';
//        print_r( $query->result_array());
//        echo '</pre>';
        return $query->result_array();
    }
    //View By CardNo Leave Type Allocation Table Information =================================================================
    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_leave_type_allocation');
        $this->db->where('CardNo', $this->CardNo);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_batch($data){
        $this->db->insert_batch('tbl_leave_type_allocation', $data); 
    }
    public function EmptyTable(){
        $this->db->truncate('tbl_leave_type_allocation'); 
    }
    
}
