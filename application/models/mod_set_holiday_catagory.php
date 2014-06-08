<?php

class Mod_set_holiday_catagory extends CI_Model {

    public $HolidayDate;
    public $Category;

    //Insert Query for Course================================================================
    public function save() {
        $data = array(
            'HolidayDate' => date('Y-m-d', strtotime($this->input->post('HolidayDate'))),
            'Category' => $this->Category
        );
        $this->db->insert('tbl_holidays', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function get_holidays() {
        $this->db->select('*');
        $this->db->from('tbl_holidays');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_holidays');
        $this->db->where('HolidayDate', $this->HolidayDate);
        $query = $this->db->get();
        return $query->result();
    }

    public function update($previousDate) {
        $data = array(
            'HolidayDate' => $this->HolidayDate,
            'Category' => $this->Category
        );
        $this->db->where('HolidayDate', $previousDate);        
        if ($this->db->update('tbl_holidays', $data)) {
            return TRUE;
        }
        return false;
    }

    public function delete($date) {
        $this->db->where('HolidayDate', $date);
        $this->db->delete('tbl_holidays');
    }

    public function GetAllHolidays($date) {

        $first_date = date('Y-m', strtotime($date)) . '-01';
//exit();
        $this->db->select('*');
        $this->db->where('HolidayDate >=', date('Y-m-d', strtotime($first_date)));
        $this->db->where('HolidayDate <=', date('Y-m-t', strtotime($date)));
        $this->db->order_by('HolidayDate', 'asc');
        $query = $this->db->get('tbl_holidays');
        return $query->result_array();
    }

    public function insert_batch_random_data($data) {
        $this->db->insert_batch('tbl_holidays', $data);
    }

}
