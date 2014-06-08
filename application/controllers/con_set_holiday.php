<?php

class Con_set_holiday extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_holiday_catagory');
        $this->load->helper('alert');
        $this->load->helper('date');
    }

    public function view() {
        $data['tbl_holiday'] = $this->mod_set_holiday_catagory->get_holidays();
        $data['container'] = 'temp/holiday/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/holiday/create';
        $this->load->view('temp/main_page', $data);
    }

    public function insert() {
        $chq_date = date('Y-m-d', strtotime($this->input->post('HolidayDate')));
        $this->mod_set_holiday_catagory->HolidayDate = $chq_date;
        $this->mod_set_holiday_catagory->Category = $this->input->post('Category');
        $this->mod_set_holiday_catagory->save();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_holiday/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_holiday_catagory->HolidayDate = $this->input->post('HolidayDate');
            $data['tbl_holiday'] = $this->mod_set_holiday_catagory->view_by_id();
            $data['container'] = 'temp/holiday/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_set_holiday_catagory->HolidayDate = $this->input->post('HolidayDate');
        $this->mod_set_holiday_catagory->Category = $this->input->post('Category');
        $previousDate = $this->input->post('previousdate');        
        $this->mod_set_holiday_catagory->update($previousDate);
                
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_holiday/view', 'refresh');
    }

    public function delete() {
        $date = $this->input->post('HolidayDate');
        $this->mod_set_holiday_catagory->delete($date);
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_holiday/view', 'refresh');
    }

}
