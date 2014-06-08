<?php

class Mod_set_worker_profile extends CI_Model {

    public $ID;
    public $Name;
    public $Designation;
    public $Grade;
    public $CardNo;
    public $JoiningDate;
    public $GrossSalary;
    public $LastIncrementDate;
    public $LastIncrementMoney;
    public $ContactNo;
    public $NID;
    public $PromotionDate;
    public $GuardianName;
    public $PermanentVillage;
    public $PermanenttPost;
    public $PermanentThana;
    public $PermanentDistrict;
    public $PresentVillage;
    public $PresentPost;
    public $PresentThana;
    public $PresentDistrict;
    public $Reference;
    public $EducationalQual;
    public $Image;
    public $ImageThumb;
    public $Comment;
    public $Status;
    public $BuildingName;
    public $Floor;
    public $Department;
    public $Line;
    public $Parameter5;
    public $OT;
    public $AttendanceBonus;
    public $OtherAllowance;
    public $OthAllowCal;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'Name' => $this->Name,
            'Designation' => $this->Designation,
            'Grade' => $this->Grade,
            'CardNo' => $this->CardNo,
            'JoiningDate' => $this->JoiningDate,
            'GrossSalary' => $this->GrossSalary,
            'LastIncrementDate' => $this->LastIncrementDate,
            'LastIncrementMoney' => $this->LastIncrementMoney,
            'ContactNo' => $this->ContactNo,
            'NID' => $this->NID,
            'PromotionDate' => $this->PromotionDate,
            'GuardianName' => $this->GuardianName,
            'PermanentVillage' => $this->PermanentVillage,
            'PermanenttPost' => $this->PermanenttPost,
            'PermanentThana' => $this->PermanentThana,
            'PermanentDistrict' => $this->PermanentDistrict,
            'PresentVillage' => $this->PresentVillage,
            'PresentPost' => $this->PresentPost,
            'PresentThana' => $this->PresentThana,
            'PresentDistrict' => $this->PresentDistrict,
            'Reference' => $this->Reference,
            'EducationalQual' => $this->EducationalQual,
            'Image' => $this->Image,
            'ImageThumb' => $this->ImageThumb,
            'Comment' => $this->Comment,
            'Status' => $this->Status,
            'BuildingName' => $this->BuildingName,
            'Floor' => $this->Floor,
            'Department' => $this->Department,
            'Line' => $this->Line,
            'Parameter5' => $this->Parameter5,
            'OT' => $this->OT,
            'AttendanceBonus' => $this->AttendanceBonus,
            'OtherAllowance' => $this->OtherAllowance,
            'OthAllowCal' => $this->OthAllowCal
        );
        $this->db->insert('tbl_employee_profile', $data);
    }

    public function insert_file($a_file) {
        require_once APPPATH . 'models/bijoy2unicode.php';
        $data_whole = array();
        foreach ($a_file as $rec) {
            $data = array(
                'Name' => convertBijoyToUnicode($rec['A']),
                'Designation' => convertBijoyToUnicode($rec['B']),
                'JoiningDate' => $rec['C'],
                'CardNo' => $rec['D'],
                'Grade' => $rec['E'],
                'GrossSalary' => $rec['F'],
                'LastIncrementDate' => $rec['G'],
                'LastIncrementMoney' => $rec['H'],
                'ContactNo' => $rec['I'],
                'PromotionDate' => $rec['J'],
                'GuardianName' => convertBijoyToUnicode($rec['K']),
                'PermanentVillage' => convertBijoyToUnicode($rec['L']),
                'PermanenttPost' => convertBijoyToUnicode($rec['M']),
                'PermanentThana' => convertBijoyToUnicode($rec['N']),
                'PermanentDistrict' => convertBijoyToUnicode($rec['O']),
                'PresentVillage' => convertBijoyToUnicode($rec['P']),
                'PresentPost' => convertBijoyToUnicode($rec['Q']),
                'PresentThana' => convertBijoyToUnicode($rec['R']),
                'PresentDistrict' => convertBijoyToUnicode($rec['S']),
                'Reference' => convertBijoyToUnicode($rec['T']),
                'EducationalQual' => convertBijoyToUnicode($rec['U']),
                'Image' => $rec['V'],
                'ImageThumb' => $rec['W'],
                'Comment' => convertBijoyToUnicode($rec['X']),
                'Status' => $rec['Y'],
                'BuildingName' => $rec['Z'],
                'Floor' => $rec['AA'],
                'Department' => $rec['AB'],
                'Line' => $rec['AC'],
                'Parameter5' => $rec['AD']
            );
            array_push($data_whole, $data);
        }

//        echo '<pre>';
//        print_r($data_whole);
//        echo '</pre>';
//        exit();
        $this->db->insert_batch('tbl_employee_profile', $data_whole);
    }

    //Update Query in Course table ===========================================================
    public function update() {
        $data = array(
            'Name' => $this->Name,
            'Designation' => $this->Designation,
            'JoiningDate' => $this->JoiningDate,
            'CardNo' => $this->CardNo,
            'Grade' => $this->Grade,
            'GrossSalary' => $this->GrossSalary,
            'LastIncrementDate' => $this->LastIncrementDate,
            'LastIncrementMoney' => $this->LastIncrementMoney,
            'ContactNo' => $this->ContactNo,
            'NID' => $this->NID,
            'PromotionDate' => $this->PromotionDate,
            'GuardianName' => $this->GuardianName,
            'PermanentVillage' => $this->PermanentVillage,
            'PermanenttPost' => $this->PermanenttPost,
            'PermanentThana' => $this->PermanentThana,
            'PermanentDistrict' => $this->PermanentDistrict,
            'PresentVillage' => $this->PresentVillage,
            'PresentPost' => $this->PresentThana,
            'PresentThana' => $this->PresentThana,
            'PresentDistrict' => $this->PresentDistrict,
            'Reference' => $this->Reference,
            'EducationalQual' => $this->EducationalQual,
            'Comment' => $this->Comment,
            'Status' => $this->Status,
            'BuildingName' => $this->BuildingName,
            'Floor' => $this->Floor,
            'Department' => $this->Department,
            'Line' => $this->Line,
            'Parameter5' => $this->Parameter5,
            'OT' => $this->OT,
            'AttendanceBonus' => $this->AttendanceBonus,
            'OtherAllowance' => $this->OtherAllowance,
            'OthAllowCal' => $this->OthAllowCal
        );
        $this->db->where('CardNo', $this->CardNo);
        $this->db->update('tbl_employee_profile', $data);
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
        $this->db->from('tbl_employee_profile');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('CardNo', $this->CardNo);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_user');
    }

    public function get_district_name() {
        $this->db->distinct();
        $this->db->select('District, DistrinctEng');
        $this->db->from('tbl_county_details');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_thana_name($district) {
        $this->db->distinct();
        $this->db->select('Thana, ThanaEng');
        $this->db->from('tbl_county_details');
        $this->db->where('DistrinctEng', $district);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_po_name($thana) {
        $this->db->distinct();
        $this->db->select('PO, POEng');
        $this->db->from('tbl_county_details');
        $this->db->where('ThanaEng', $thana);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_employee_profile12() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('CardNo', $this->CardNo);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_employee_profile() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('CardNo', $this->CardNo);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTblGrade($jobCatid) {
        $this->db->select('*');
        $this->db->from('tbl_grade');
        $this->db->where('JobCategoryID', $jobCatid);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTblDesignation($designation) {
        $this->db->select('*');
        $this->db->from('tbl_designation');
        $this->db->where('GradeID', $designation);
        $query = $this->db->get();
        return $query->result();
    }

}
