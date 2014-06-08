<?php

class Mod_set_employee_info_detail extends CI_Model {

    //View Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_cardno_array($cardNo) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('CardNo', $cardNo);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_job_category_name() {
        $this->db->select('*');
        $this->db->from('tbl_job_category');
        $query = $this->db->get();
        return $query->result();
    }

    public function EmployeeInfoArray() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->order_by('CardNo', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_record_count($searchterm) {
        $sql = "SELECT COUNT(*) As cnt FROM tbl_employee_profile WHERE CardNo  OR ContactNo LIKE '%" . $searchterm . "%'";
        $q = $this->db->query($sql);
        $row = $q->row();
        return $row->cnt;
    }

    public function all_record($per_page, $limit) {
        if ($this->session->userdata('Role') == 'Admin') {
            $this->db->select('*');
            $this->db->from('tbl_employee_profile');
            $this->db->where('BuildingName', $this->session->userdata('BuildingName'));
            $this->db->limit($per_page, $limit);
            $query = $this->db->get();
//            echo '<pre>';
//            print_r($query);
//            echo '</pre>';
//            exit();
            return $query->result();
        } else {
            $this->db->select('*');
            $this->db->from('tbl_employee_profile');
            $this->db->where('BuildingName', $this->session->userdata('BuildingName'));
            $this->db->where('Floor', $this->session->userdata('Floor'));
            $this->db->limit($per_page, $limit);
            $query = $this->db->get();
//            echo '<pre>';
//            print_r($query);
//            echo '</pre>';
//            exit();
            return $query->result();
        }
    }

    //Employee Info Details Pagination Count
    public function serach_count_rows_for_pagination() {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $query = $this->db->get();
        return count($query->result());
    }

    //Section List from tbl_section table
    public function get_section_list() {
        $this->db->select('*');
        $this->db->from('tbl_section');
        $query = $this->db->get();
        return $query->result();
    }

    //Search Result of Employee Details Information
    public function search_employee_info_details_all_records($department, $employee_name, $cardno, $contactno, $from_gross_salary, $to_gross_salary, $nid,  $limit,$per_page) {
        if ($this->session->userdata('Role') != 'Admin') {
            
           
            $sql = 'SELECT ID,BuildingName,Floor,Department,Line,Name,Designation,JoiningDate,CardNo,Grade,GrossSalary,LastIncrementDate,LastIncrementMoney,ContactNo,NID,PromotionDate,GuardianName,PermanentVillage,PermanenttPost,PermanentThana,PermanentDistrict,PresentVillage,PresentPost,PresentThana,PresentDistrict,Reference,EducationalQual,Comment FROM tbl_employee_profile ';
            $sql = $sql . "WHERE BuildingName = '" . $this->session->userdata('BuildingName') . "' AND Floor = '" . $this->session->userdata('Floor')."'";
           
            if ($department) {
                    $sql = $sql . "AND `Department` = '" . $department . "' ";
                }
            
            if ($employee_name) {
                    $sql = $sql . "AND `Name` LIKE '%" . $employee_name . "%' ";
                } 
           
            if ($cardno != '') {
                    $sql = $sql . "AND `CardNo` = '" . $cardno . "' ";
                }
           
            if ($contactno) {
                    $sql = $sql . "AND `ContactNo` = '" . $contactno . "' ";
                } 
          
            if ($nid) {
                    $sql = $sql . "AND `NID` = '" . $nid . "' ";
                }
            
            if ($from_gross_salary && $to_gross_salary) {
                    $sql = $sql . "AND `GrossSalary` BETWEEN '" . $from_gross_salary . "' AND '" . $to_gross_salary . "' ";
                } 
            if ($limit) {
               $sql = $sql . " LIMIT " . $per_page . ", " . $limit . " ";
            } 
           
            //$sql = $sql . "AND BuildingName = '" . $this->session->userdata('BuildingName') . "' LIMIT " . $per_page . ", " . $limit . " ";
           $query = $this->db->query($sql);
           
            return $query->result_array();
        } else {
            $sql = 'SELECT * FROM tbl_employee_profile ';
            $sql = $sql . "WHERE BuildingName = '" . $this->session->userdata('BuildingName') . "' AND Floor = '" . $this->session->userdata('Floor')."' ";
            
            if ($department) {
                    $sql = $sql . "AND `Department` = '" . $department . "' ";
                }
           
            if ($employee_name) {
                    $sql = $sql . "AND `Name` LIKE '%" . $employee_name . "%' ";
                } 
           
            if ($cardno != '') {
                    $sql = $sql . "AND `CardNo` = '" . $cardno . "' ";
                } 
            
            if ($contactno != '') {
                    $sql = $sql . "AND `ContactNo` = '" . $contactno . "' ";
                }
            
            if ($nid) {
                    $sql = $sql . "AND `NID` = '" . $nid . "' ";
                } 
            
            if ($from_gross_salary  && $to_gross_salary ) {
                    $sql = $sql . "AND `GrossSalary` BETWEEN '" . $from_gross_salary . "' AND '" . $to_gross_salary . "' ";
                } 
            if ($limit) {
                $sql = $sql . " LIMIT " . $per_page . ", " . $limit . " ";
            }
            
            //$sql = $sql . "AND BuildingName = '" . $this->session->userdata('BuildingName') . "' AND Floor = '" . $this->session->userdata('Floor') . "' LIMIT " . $per_page . ", " . $limit . " ";
           $query = $this->db->query($sql);
           return $query;
        }
    }
    public function search_employee_info_details_all_records_count($department, $employee_name, $cardno, $contactno, $from_gross_salary, $to_gross_salary, $nid,  $limit,$per_page) {
       
            
           
            $sql = 'SELECT * FROM tbl_employee_profile ';
            $sql = $sql . "WHERE BuildingName = '" . $this->session->userdata('BuildingName') . "' AND Floor = '" . $this->session->userdata('Floor')."'";
           
            if ($department) {
                    $sql = $sql . "AND `Department` = '" . $department . "' ";
                }
            
            if ($employee_name) {
                    $sql = $sql . "AND `Name` LIKE '%" . $employee_name . "%' ";
                } 
           
            if ($cardno != '') {
                    $sql = $sql . "AND `CardNo` = '" . $cardno . "' ";
                }
           
            if ($contactno) {
                    $sql = $sql . "AND `ContactNo` = '" . $contactno . "' ";
                } 
          
            if ($nid) {
                    $sql = $sql . "AND `NID` = '" . $nid . "' ";
                }
            
            if ($from_gross_salary && $to_gross_salary) {
                    $sql = $sql . "AND `GrossSalary` BETWEEN '" . $from_gross_salary . "' AND '" . $to_gross_salary . "' ";
                } 
            
           
            //$sql = $sql . "AND BuildingName = '" . $this->session->userdata('BuildingName') . "' LIMIT " . $per_page . ", " . $limit . " ";
           $query = $this->db->query($sql);
            return $query->num_rows();
        
        
    }

    public function all_record_count($searchterm) {
        if ($searchterm) {
            $sql = "SELECT count(*) FROM tbl_employee_profile WHERE CardNo='"
                    . $searchterm . "' OR ContactNo='" . $searchterm . "'";
        } else {
            $sql = "SELECT * FROM tbl_employee_profile";
        }

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {

            return false;
        }
    }

    public function search($searchterm, $limit) {
        $sql = "SELECT * FROM tbl_employee_profile WHERE CardNo  OR ContactNo LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",20";
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    public function specific_employee_information($buildingName, $floor) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }

    public function specific_employee_information_array(
    $buildingName, $floor) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $this->db->order_by('CardNo', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function specific_employee_information_report($buildingName, $floor, $department, $line) {
        $this->db->
                select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->like('BuildingName', $buildingName);
        $this->db->like('Floor', $floor);
        $this->db->like('Department', $department);
        $this->db->like('Line', $line);
        $query = $this->db->get();
        return $query->result();
    }

    public function specific_employee_information_report_array($buildingName, $floor, $department, $line) {
        $this->db->select(
                '*');
        $this->db->from('tbl_employee_profile');
        $this->db->like('BuildingName', $buildingName);
        $this->db->like('Floor', $floor);
        $this->db->like('Department', $department);
        $this->db->like('Line', $line);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_line_by_name($building, $floor, $Department) {
        $this
        ->db->distinct();
        $this->db->select('Line');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $building);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $Department);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_department_by_name($building, $floor) {
        $this
        ->db->distinct();
        $this->db->select('Department');
        $this->db->from('tbl_employee_profile');
        if (!empty($building)) {
            $this->db->where('BuildingName', $building);
        }
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }

    public function regular_employee_cardno_list($CurrentMonth, $PreviousMonth) {
        $query = $this->db->query("SELECT al.CardNo, al.DateTime, pro.Name, pro.Line, pro.Department, pro.Floor FROM tbl_access_log as al INNER JOIN tbl_employee_profile AS pro ON pro.CardNo = al.CardNo WHERE al.DateTime LIKE '%"
                . $CurrentMonth . "%' OR al.DateTime LIKE '%" . $PreviousMonth . "%' GROUP BY al.CardNo ORDER BY pro.Floor ASC, pro.Department, pro.Line");
        return $query->result();
    }

    public function attendance_log($DateTime) {
        $query = $this->db->query("SELECT CardNo FROM tbl_access_log WHERE DateTime like '%" . $DateTime . "%' group by CardNo");

        return $query->result();
    }

    public function incorrect_access_log($startdate, $enddate) {
        $query = $this->db->query("SELECT CardNo, DateTime FROM tbl_incurrect_access_log_backup WHERE DateTime BETWEEN '" . $startdate . "' and '" . $enddate . "' GROUP BY CardNo");
        return $query->result();
    }

    public function get_department_name($buildingName, $floor) {
        $query = $this->db->query("SELECT section.Name 
                                    FROM `tbl_section` as section 
                                    inner join tbl_floor as floor
                                    on section.FloorID = floor.ID
                                    inner join tbl_building as building
                                    on floor.BuildingID = building.ID
                                    WHERE building.Name = '"
                . $buildingName . "' and floor.Name = '" . $floor . "' ");
        return $query->result();
    }

    public function getAllsection() {
        $query = $this->db->get('tbl_section');
        return $query->result();
    }
    

}
