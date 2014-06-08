<?php

class Mod_buil_sec_other extends CI_Model{
    
    public function getFloor($buildingId) {
        $buildingId = $this->getBuildingId($buildingId);
        $this->db->where('BuildingID', $buildingId); 
        $query = $this->db->get('tbl_floor');
        return $query->result();
    }
    public function getBuildingId($B_name) {
        $this->db->where('Name', $B_name); 
        $query = $this->db->get('tbl_building');
        $m = $query->row();
        return $m->ID;
    }
}
