<?php
class Con_set_user_login_info extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mod_set_user_login_info');
         $this->load->model('mod_daily_dashoard_report');
        $this->load->helper('alert');
    }

    public function index() {
        if ($this->session->userdata('Email')) {
        $data['tbl_dashboard_report'] = $this->mod_daily_dashoard_report->view();
        $data['current_attendance'] = $this->mod_daily_dashoard_report->get_daily_log();
        $data['on_leave'] = $this->mod_daily_dashoard_report->get_on_leave();       
        $data['container'] = 'temp/deshboard/view';
        $this->load->view('main_page', $data);
        }
        else {
            $this->load->view('user_login');
        }
    }

    public function login() {
        if ($this->session->userdata('Email')) {
            redirect('con_set_user_login_info', 'refresh');
        } else {
            $this->load->view('user_login');
        }
    }

    public function login_validation() {
        $this->form_validation->set_rules('Email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('Password', 'Password', 'required|trim');
        if ($this->form_validation->run()) {
            redirect('con_proc_daily_dashoard_report/view_dashboard_report', 'refresh');
        } else {
            $this->load->view('user_login');
        }
    }

    public function validate_credentials() {
        $this->mod_set_user_login_info->Email = $this->input->post('Email');
        $this->mod_set_user_login_info->Password = $this->input->post('Password');
        if ($info = $this->mod_set_user_login_info->can_log_in()) {
            $data = array(
                'FirstName' => $info->FirstName,
                'MiddleName' => $info->MiddleName,
                'Email' => $info->Email,                
                'Role' => $info->Role,
                'Image' => $info->Image,
                'BuildingName' => $info->BuildingName,
                'Floor' => $info->Floor,
                'Department' => $info->Department,                
                'Line' => $info->Line,
                'is_logged_in' => 1,
            );
            $this->session->set_userdata($data);
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password');
            return FALSE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('con_set_user_login_info/login', 'refresh');
    }

}
