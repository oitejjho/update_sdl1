<?php
class Mod_pro_attn_mismatch_report extends CI_Model {
     
    public function insert() {
        $data = array(
            'CardNo' => $this->CardNo,
            'DateTime' => $this->DateTime            
        );
        $this->db->insert('tbl_access_log', $data);
    }
    
    public function specific_employee_information($buildingName, $floor, $department) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $department);
        $query = $this->db->get();
        return $query->result();
    }  
    public function specific_employee_information1($buildingName) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $query = $this->db->get();
        return $query->result();
    }  
    public function specific_employee_information2($buildingName, $floor) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }  
    
    public function specific_employee_information_report($buildingName, $floor, $department, $line) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->like('BuildingName', $buildingName);
        $this->db->like('Floor', $floor);
        $this->db->like('Department', $department);
        $this->db->like('Line', $line);
        $query = $this->db->get();
        return $query->result();
    } 
    public function UpdateIncurrenctAccessLog($cardNo, $dateTime){        
        $dateTime = date('Y-m-d',strtotime($dateTime));               
        $firstTime = date('Y-m-d H:i:s',  strtotime($dateTime.' 00:00:01'));
        $lastTime = date('Y-m-d H:i:s',  strtotime($dateTime.' 23:59:59'));        
        $query = $this->db->query("UPDATE `tbl_incurrect_access_log` SET `DelStatus`='DEL' WHERE `CardNo` = '".$cardNo. "' and `DateTime` between '".$firstTime."' and '".$lastTime."' and `DelStatus` = 'ACT'");       
    }
    public function UpdateIncurrenctAccessLogBatch($all_mismacthes){        
        $limit= count($all_mismacthes)-1;
        for($index = 0 ; $index <= $limit ; $index++){
            $this->UpdateIncurrenctAccessLog($all_mismacthes[$index]['CardNo'], $all_mismacthes[$index]['DateTime']);
        }        
    }
    
    public function incorrect_access_log($startdate, $enddate) {
       $query = $this->db->query("SELECT CardNo, DateTime FROM tbl_incurrect_access_log WHERE DateTime BETWEEN '". $startdate. "' and '" .$enddate. "'and DelStatus = 'ACT' GROUP BY CardNo");        
       return $query->result();
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
        if(!empty($building)){
        $this->db->where('BuildingName', $building);}
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function view_by_CardNo($acard,$time) {
        $firstTime = date('Y-m-d',  strtotime($time)).' 00:00:01';
        $lastTime = date('Y-m-d',  strtotime($time)).' 23:59:59';
        //echo $firstTime.'<br/>'.$lastTime;
        //exit();
        //"select inc.CardNo, inc.DateTime, emp.Name, emp.Line, emp.Department from tbl_incurrect_access_log as inc inner join tbl_employee_profile as emp on inc.CardNo = emp.CardNo where inc.CardNo = '10115' and inc.datetime between '2014-03-31 00:00:01' and '2014-03-31 23:59:59' group by (inc.CardNo)"
       $quary = $this->db->query("select inc.CardNo, inc.DateTime, emp.Name, emp.Line, emp.Department from tbl_incurrect_access_log as inc inner join tbl_employee_profile as emp on inc.CardNo = emp.CardNo where inc.CardNo = '".$acard."' and inc.datetime between '".$firstTime."' and '".$lastTime."' group by (inc.CardNo)");        
       return $quary->result();
    }
     public function view_by_CardNo1($acard) {
        
        //echo $firstTime.'<br/>'.$lastTime;
        //exit();
        //"select inc.CardNo, inc.DateTime, emp.Name, emp.Line, emp.Department from tbl_incurrect_access_log as inc inner join tbl_employee_profile as emp on inc.CardNo = emp.CardNo where inc.CardNo = '10115' and inc.datetime between '2014-03-31 00:00:01' and '2014-03-31 23:59:59' group by (inc.CardNo)"
       $quary = $this->db->query("select * from tbl_employee_profile where CardNo = '".$acard."'");        
       return $quary->result();
    }
}