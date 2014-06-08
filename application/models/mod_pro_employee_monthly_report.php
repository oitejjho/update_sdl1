<?php
class Mod_pro_employee_monthly_report extends CI_Model {
     
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
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result();
    }  
    public function specific_employee_information2($buildingName, $floor) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $buildingName);
        $this->db->where('Floor', $floor);
        $this->db->order_by('CardNo asc');
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
        //echo $cardNo.'<br/>'.$dateTime.'<br/>';
        
        $firstTime = date('Y-m-d H:i:s',  strtotime($dateTime.' 00:00:01'));
        $lastTime = date('Y-m-d H:i:s',  strtotime($dateTime.' 23:59:59'));
        //echo $firstTime.'<br/>'.$lastTime.'<br/>';
        //echo ";
        //echo "UPDATE `tbl_incurrect_access_log` SET `DelStatus`='DEL' WHERE `CardNo` = '".$cardNo. "' and `DateTime` between '".$firstTime."' and '".$lastTime."' and `DelStatus` = 'ACT'";
        //exit();
        $query = $this->db->query("UPDATE `tbl_incurrect_access_log` SET `DelStatus`='DEL' WHERE `CardNo` = '".$cardNo. "' and `DateTime` between '".$firstTime."' and '".$lastTime."' and `DelStatus` = 'ACT'");        
        
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
    
    public function view_by_CardNo($CardNo,$Month) {
       $LikeDate = '2014-'.$Month."-1 00:00:00";
       $Month = (int)$Month + 1;
       $LikeDateEnd = '2014-'.$Month."-1 00:00:00";
       $Q =  "select inc.CardNo, inc.DateTime,inc.CreatedBy, emp.Name, emp.Line, emp.Department from tbl_access_log as inc left join tbl_employee_profile as emp on inc.CardNo = emp.CardNo where inc.CardNo = '".$CardNo."' and inc.datetime between '".$LikeDate."' and '".$LikeDateEnd."' order by DateTime";
       $quary = $this->db->query($Q);        
       return $quary->result_array();
    }
    
    public function view_by_CardNo_missmatch($CardNo,$Month) {
       $LikeDate = '2014-'.$Month."-1 00:00:00";
       $Month = (int)$Month + 1;
       $LikeDateEnd = '2014-'.$Month."-1 00:00:00";
       $Q =  "select inc.CardNo, inc.DateTime, emp.Name, emp.Line, emp.Department from tbl_incurrect_access_log as inc left join tbl_employee_profile as emp on inc.CardNo = emp.CardNo where DelStatus = 'ACT' AND inc.CardNo = '".$CardNo."' and inc.datetime between '".$LikeDate."' and '".$LikeDateEnd."' order by DateTime";
       $quary = $this->db->query($Q);        
       return $quary->result_array();
    }
    
     public function update_in_out_time($CardNo,$DateTime, $DateTimeOld) {
//       $Q =  "UPDATE tbl_access_log SET DateTime = '".$DateTime."' where CardNo =  '".$CardNo."' and DateTime = '".$DateTimeOld."'";
//       $quary = $this->db->query($Q);        
//       return $quary;
       
       
        $data = array(
            'DateTime' => $DateTime,
            'CreatedBy' => $this->session->userdata('Email')
        );
        $this->db->where('CardNo', $CardNo);
        $this->db->where('DateTime', $DateTimeOld);
        if ($this->db->update('tbl_access_log', $data)) {
            return TRUE;
        }
        return false;
    }
    
    public function delete_monthly_attandance($cardno, $date) {
         $query = $this->db->query("DELETE FROM `tbl_access_log` WHERE CardNo = '".$cardno."' and DateTime like '".$date."%' ");     
        if($query){
            return true;
        }else{
            return false;
        }   
    }
     public function UpdateIncurrenctAccessLog11($cardNo, $dateTime) {
        foreach ($dateTime as $mdateTime) {
            $dateTime = date('Y-m-d', strtotime($mdateTime));
            $firstTime = date('Y-m-d H:i:s', strtotime($mdateTime . ' 00:00:01'));
            $lastTime = date('Y-m-d H:i:s', strtotime($mdateTime . ' 23:59:59'));
            $query = $this->db->query("UPDATE `tbl_incurrect_access_log` SET `DelStatus`='DEL' WHERE `CardNo` = '" . $cardNo . "' and `DateTime` between '" . $firstTime . "' and '" . $lastTime . "' and `DelStatus` = 'ACT'");
        }
    }

    public function insert11($data) {
        $this->db->insert_batch('tbl_access_log', $data);
    }
}
