<?php

class Mod_set_notification extends CI_Model {

    public $ID;
    public $UserID;
    public $Notification;
    public $DateTime;
    public $Status;

    //Insert Query for Notification ================================================================
    public function insert() {
        $data = array(
            'UserID' => $this->UserID,
            'Notification' => $this->Notification,
            'DateTime' => $this->DateTime,
            'Status' => 'uread',
            'CreatedBy' => $this->CreatedBy
        );

        $this->db->insert('tbl_notification', $data);
    }

    //Update Query in Notification table===========================================================
    public function update() {
        $data = array(
            'Notification' => $this->Notification,
            'DateTime' => $this->DateTime,
            'Status' => 'read',
            'ModifiedOn' => $this->ModifiedOn,
            'ModifiedBy' => $this->ModifiedBy,
        );
        $this->db->where('ID', $this->ID);        
        $this->db->update('tbl_notification', $data);
    }

    //Delete Query for Notification =============================================================
    public function delete() {
        $data = array(
            'Status' => 'del'
        );
        $this->db->where('ID', $this->ID);
        $this->db->update('tbl_notification', $data);
    }

    //View Notification Information  ====================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_notification');
        $this->db->where('Status', 'uread');
        $query = $this->db->get();
        return $query->result();
    }

    //View By ID Notification =================================================================
    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_notification');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }
    
     //View By UserID Notification =================================================================
    public function view_by_user_id() {
        $this->db->select('*');
        $this->db->from('tbl_notification');
        $this->db->where('UserID', $this->UserID);
        $this->db->where('Status', 'uread');
        $query = $this->db->get();
        return $query->result();
    }
}
