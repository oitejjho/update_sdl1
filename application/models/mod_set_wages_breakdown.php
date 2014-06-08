<?php

class Mod_set_wages_breakdown extends CI_Model {

    public $ID;
    public $Head;
    public $Percentage;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'Head' => $this->Head,
            'Percentage' => $this->Percentage            
        );
        $this->db->insert('tbl_wages_breakdown', $data);
    }

    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_wages_breakdown');
        $query = $this->db->get();
        return $query->result();
    }
    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_wages_breakdown');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_wages_breakdown');
    }
    
    public function update() {
        $data = array(
            'Head' => $this->Head,
            'Percentage' => $this->Percentage
        );
        $this->db->where('ID', $this->ID);        
        if($this->db->update('tbl_wages_breakdown', $data))
        {
            return TRUE;
        }
        return false;
    }
}
