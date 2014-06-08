<?php

class Mod_set_additonal_allowance_structure_worker extends CI_Model {

    public $ID;
    public $Head;
    public $WorkerAmount;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'Head' => $this->Head,
            'WorkerAmount' => $this->WorkerAmount,
            
        );
        $this->db->insert('tbl_additonal_allowance_structure_worker', $data);
    }

    //Update Query in Course table ===========================================================
    

    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_additonal_allowance_structure_worker');
        $query = $this->db->get();
        return $query->result();
    }
    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_additonal_allowance_structure_worker');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }
    public function update() {
        $data = array(
            'Head' => $this->Head,
            'WorkerAmount' => $this->WorkerAmount,
        );
        $this->db->where('ID', $this->ID);        
        if($this->db->update('tbl_additonal_allowance_structure_worker', $data))
        {
            return TRUE;
        }
        return false;
    }
    
    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_additonal_allowance_structure_worker');
    }
}
