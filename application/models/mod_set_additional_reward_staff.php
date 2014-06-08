<?php

class Mod_set_additional_reward_staff extends CI_Model {

    public $ID;
    public $RewaredName;
    public $RewaredAmount;
    public $IsCalculatedOnBasic;
    public $BasicXTime;
    public $CompensatoryHolyday;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'RewaredName' => $this->RewaredName,
            'RewaredAmount' => $this->RewaredAmount,
            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
            'BasicXTime' => $this->BasicXTime,
            'CompensatoryHolyday' => $this->CompensatoryHolyday
        );       
        $this->db->insert('tbl_additional_reward_staff', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_additional_reward_staff');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_additional_reward_staff');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_additional_reward_staff');       
    }

    public function update() {
        $data = array(
            'RewaredName' => $this->RewaredName,
            'RewaredAmount' => $this->RewaredAmount,
            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
            'BasicXTime' => $this->BasicXTime,
            'CompensatoryHolyday' => $this->CompensatoryHolyday
        );
        $this->db->where('ID', $this->ID);
        if ($this->db->update('tbl_additional_reward_staff', $data)) {
            return TRUE;
        }
        return false;
    }

}
