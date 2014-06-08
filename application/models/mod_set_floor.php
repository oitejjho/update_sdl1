<?php

class Mod_set_floor extends CI_Model {

    public $ID;
    public $Name;
    public $BuildingID;

    public function view($buildingID) {
        $this->db->select("*");
        $this->db->from('tbl_floor');
        $this->db->where('BuildingID', $buildingID);
        $query = $this->db->get();
        return $query->result_array();
    }

}
