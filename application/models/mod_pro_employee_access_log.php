<?php
class Mod_pro_employee_access_log extends CI_Model {    
    public function search_record_count($searchterm) {
        $sql = "SELECT COUNT(*) As cnt FROM tbl_access_log WHERE CardNo LIKE '%" . $searchterm . "%'";
        $q = $this->db->query($sql);
        $row = $q->row();
        return $row->cnt;
    }
    
    
    public function all_record($limit, $searchterm) {
        $start = $limit;
        $end = 20;
        if($searchterm){
        $sql = "SELECT * FROM tbl_access_log  WHERE CardNo = '".$searchterm."' ORDER BY CardNo limit ".$start.", ".$end; 
        return $this->db->query($sql)->result();
        }else {
            $sql = "SELECT * FROM tbl_access_log ORDER BY CardNo limit ".$start.", ".$end; 
            return $this->db->query($sql)->result();
        }
    }
    
    public function all_record_count($searchterm) {
        if($searchterm){
        $sql = "SELECT * FROM tbl_access_log WHERE CardNo='".$searchterm."'" ; 
        }else {
            $sql = "SELECT * FROM tbl_access_log" ; 
        }
        
        $result = $this->db->query($sql);
        if($result->num_rows() > 0)
        {
            return $result->num_rows();
        }else {
            return false;
        }
    }

    public function search($searchterm, $limit) {
        $sql = "SELECT * FROM tbl_access_log WHERE CardNo LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",20";
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
    

}
