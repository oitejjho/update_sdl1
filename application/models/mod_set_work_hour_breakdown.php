<?php
class mod_set_work_hour_breakdown extends CI_Model {
    public $ID;
    public $WorkHourName;
    public $StartTime;
    public $EndTime;
    public $Conditional;
    public $Priority;
    public $TotalWorkingHour;
    public $BasicStructure;
    
    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'WorkHourName' => $this->WorkHourName,
            'StartTime' => $this->StartTime,
            'EndTime' => $this->EndTime,
            'Conditional' => $this->Conditional,
            'Priority' => $this->Priority,
            'TotalWorkingHour' => $this->TotalWorkingHour,
            'BasicStructure' => $this->BasicStructure            
        );
        $this->db->insert('tbl_work_hour_breakdown', $data);
    }

    //Update Query in Course table ===========================================================
    public function update() {
        $data = array(
            'WorkHourName' => $this->WorkHourName,
            'StartTime' => $this->StartTime,
            'EndTime' => $this->EndTime,
            'Conditional' => $this->Conditional,
            'Priority' => $this->Priority,
            'TotalWorkingHour' => $this->TotalWorkingHour,
            'BasicStructure' => $this->BasicStructure
        );
        $this->db->where('ID', $this->ID);        
        if($this->db->update('tbl_work_hour_breakdown', $data))
        {
            return TRUE;
        }
        return false;
    }
    
    //View Course Information ===================================================
    public function view1() {
        $this->db->select('*');
        $this->db->from('tbl_work_hour_breakdown');        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_work_hour_breakdown');
        $this->db->where('ID', $this->ID);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function delete_by_id($id) {
        $this->db->where('ID', $id);
        $this->db->delete('tbl_work_hour_breakdown');
    }

}