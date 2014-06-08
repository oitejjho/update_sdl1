<?php

class Mod_set_building extends CI_Model {

    public $ID;
    public $Name;

    public function view() {
        $this->db->select("*");
        $this->db->from('tbl_building');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function GetBuldingId($buildingName) {
        $this->db->select('ID');
        $this->db->from('tbl_building');
        $this->db->where('Name', $buildingName);
        $query = $this->db->get();
        $row =  $query->row();
        return $row->ID;
    }

}
