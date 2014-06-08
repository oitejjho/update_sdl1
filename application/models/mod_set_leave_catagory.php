<?php

class Mod_set_leave_catagory extends CI_Model {

    public $ID;
    public $CatagoryName;
    public $Days;
    public $PaidUnpaid;
    public $ShorfForm;

    //Insert Query for Course================================================================
    public function save() {
        $data = array(
            'CatagoryName' => $this->CatagoryName,
            'Days' => $this->Days,
            'PaidUnpaid' => $this->PaidUnpaid,
            'ShorfForm' => $this->ShorfForm
        );  
        $this->db->insert('tbl_leave_catagory', $data);
    }
    
    
    public function LeaveCategoryArray() {
        $this->db->select('*');
        $this->db->from('tbl_leave_catagory');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_leave_catagory');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_leave_catagory');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }

    public function update() {
        $data = array(
            'CatagoryName' => $this->CatagoryName,
            'Days' => $this->Days,
            'PaidUnpaid' => $this->PaidUnpaid,
            'ShorfForm' => $this->ShorfForm
        );
        $this->db->where('ID', $this->ID);
        if ($this->db->update('tbl_leave_catagory', $data)) {
            return TRUE;
        }
        return false;
    }

    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_leave_catagory');
    }

}
