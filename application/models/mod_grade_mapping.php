<?php

class Mod_grade_mapping extends CI_Model {

    public $ID;
    public $Name;
    public $Descrip;
    public $TreatmentAllowance;
    public $TravelAllowance;
    public $FoodAllowance;
    public $AttendanceBonus;

    //Insert Query for Course================================================================
//    public function insert() {
//        $data = array(
//            'RewaredName' => $this->RewaredName,
//            'RewaredAmount' => $this->RewaredAmount,
//            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
//            'BasicXTime' => $this->BasicXTime,
//            'CompensatoryHolyday' => $this->CompensatoryHolyday
//        );
//
//        $this->db->insert('tbl_additional_reward_staff', $data);
//    }
    public function insert_batch($data) {
        $this->db->insert_batch('tbl_grade_mapping', $data);
    }
    
    public function insert() {
        $data = array(
            'Name' => $this->GradeMappingName,
            'Descrip' => $this->Description,
            'TreatmentAllowance' => $this->TreatmentAllowance,
            'TravelAllowance' => $this->TravelAllowance,
            'FoodAllowance' => $this->FoodAllowance,
            'AttendanceBonus' => $this->AttendanceBonus
        );
        $this->db->insert('tbl_grade_mapping', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_grade_mapping');
    }
    
    public function view_for_list($per_page, $limit) {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');        
        $this->db->order_by('ID', 'ASC');
        $this->db->limit($per_page, $limit);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function number_of_grades_mapping() {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');
        $query = $this->db->get();
        return count($query->result());
    }

    public function update() {
        $data = array(
            'Name' => $this->Name,
            'Descrip' => $this->Descrip,
            'TreatmentAllowance' => $this->TreatmentAllowance,
            'TravelAllowance' => $this->TravelAllowance,
            'FoodAllowance' => $this->FoodAllowance,
            'AttendanceBonus' => $this->AttendanceBonus
        );
        $this->db->where('ID', $this->ID);
        if ($this->db->update('tbl_grade_mapping', $data)) {
            return TRUE;
        }
        return false;
    }

    public function getLongData() {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');        
        $query = $this->db->get();
        return $query->result();
    }

    public function EmptyTable() {
        $this->db->truncate('tbl_grade_mapping');
    }

    public function getLongDataArray() {
        $this->db->select('*');
        $this->db->from('tbl_grade_mapping');        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_job_category_name() {
        $this->db->select('*');
        $this->db->from('tbl_job_category');        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_grade_names($CategoryID) {        
        $query = $this->db->query("SELECT * FROM tbl_grade WHERE JobCategoryID = '".$CategoryID."' ");
        return $query->result_array();
    }
    
    public function get_designation_list($GradeID) {        
        $query = $this->db->query("SELECT * FROM tbl_designation WHERE GradeID = '".$GradeID."' ");
        return $query->result_array();
    }
    
    public function get_grademapping_keyword($DesignationID) {
        $query = $this->db->query("SELECT dsg.Keyword AS Designation, grd.Keyword AS Grade, jobCat.ShortForm FROM tbl_designation AS dsg INNER JOIN tbl_grade AS grd ON grd.ID = dsg.GradeID INNER JOIN tbl_job_category AS jobCat ON jobCat.ID = grd.JobCategoryID WHERE dsg.Designation = '".$DesignationID."' ");
        return $query->row_array();
    }
    
    

}