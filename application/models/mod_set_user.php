<?php

class Mod_set_user extends CI_Model {

    public $ID;
    public $UserName;
    public $Password;
    public $Email;
    public $Role;
    public $FirstName;
    public $MiddleName;
    public $LastName;
    public $Gender;
    public $Image;
    public $Image_Thumb;
    public $BuildingName;
    public $Floor;
    public $Department;
    public $Line;
    public $Parameter5;
    public $IsActive;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'UserName' => $this->UserName,
            'Password' => $this->Password,
            'Email' => $this->Email,
            'Role' => $this->Role,
            'FirstName' => $this->FirstName,
            'MiddleName' => $this->MiddleName,
            'LastName' => $this->LastName,
            'Gender' => $this->Gender,
            'Image' => $this->Image,
            'Image_Thumb' => $this->Image_Thumb,
            'BuildingName' => $this->BuildingName,
            'Floor' => $this->Floor,
            'Department' => $this->Department,
            'Line' => $this->Line,
            'Parameter5' => $this->Parameter5,
            'IsActive' => 'Yes'
        );
        $this->db->insert('tbl_user', $data);
    }

    //Update Query in Course table ===========================================================
    public function update() {
        $data = array(
            'UserName' => $this->UserName,
            'Password' => $this->Password,
            'Role' => $this->Role,
            'FirstName' => $this->FirstName,
            'MiddleName' => $this->MiddleName,
            'LastName' => $this->LastName,
            'Gender' => $this->Gender,
            'Image' => $this->Image,
            'Image_Thumb' => $this->Image_Thumb,
            'BuildingName' => $this->BuildingName,
            'Floor' => $this->Floor,
            'IsActive' => 'Yes'
        );
        $this->db->where('ID', $this->ID);
        $this->db->update('tbl_user', $data);
    }

    public function checkEmail() {
        $this->db->where('Email', $this->Email);
        $query = $this->db->get('tbl_user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('IsActive', 'Yes');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete() {
        $data = array(
            'IsActive' => 'No'
        );
        $this->db->where('ID', $this->ID);
        $this->db->update('tbl_user', $data);
    }

    public function get_building_name() {
        $this->db->select('*');
        $this->db->from('tbl_building');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_floor_name() {
        $this->db->select('*');
        $this->db->from('tbl_floor');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_section_name() {
        $this->db->select('*');
        $this->db->from('tbl_section');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_line_name() {
        $this->db->select('*');
        $this->db->from('tbl_line');
        $query = $this->db->get();
        return $query->result();
    }

}
