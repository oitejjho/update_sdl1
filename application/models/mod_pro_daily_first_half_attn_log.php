<?php

class Mod_pro_daily_first_half_attn_log extends CI_Model {

    public function specific_employee_information($buildingName, $floor, $department) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $department);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function SuperAdminEmployeeInfo() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function specific_employee_information_report($buildingName, $floor, $department, $line) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $this->db->where('Deaccess_logpartment', $department);        
        $this->db->where('Line', $line);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function access_log($startdate, $enddate) {
        $query = $this->db->query("SELECT raw.CardNo, raw.InTime,raw.InTime as OutTime, prof.Name FROM tbl_access_log_raw as raw Inner Join tbl_employee_profile as prof ON raw.CardNo = prof.CardNo where raw.InTime between '".$startdate."' and '".$enddate."' Group By raw.CardNo order by raw.CardNo");
        return $query->result_array();
    }
    public function access_log_previous_date($startdate, $enddate){
        $query = $this->db->query("SELECT raw.CardNo, Min(raw.DateTime) as InTime,Max(raw.DateTime) as OutTime, prof.Name FROM tbl_access_log as raw Inner Join tbl_employee_profile as prof ON raw.CardNo = prof.CardNo where raw.DateTime between '".$startdate."' and '".$enddate."' Group By raw.CardNo  order by raw.CardNo");
        return $query->result_array();        
    }

    public function get_line_by_name($building, $floor, $Department) {
        $this->db->distinct();
        $this->db->select('Line');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $building);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $Department);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_department_by_name($building, $floor) {
        $this->db->distinct();
        $this->db->select('Department');
        $this->db->from('tbl_employee_profile');
        if (!empty($building)) {
            $this->db->where('BuildingName', $building);
        }
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }

}
