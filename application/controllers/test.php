<?php
class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_user');
        $this->load->helper('alert');
        $this->load->helper('date');
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    function index() {
        $this->load->view('upload_view');
    }

    function read_file() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $error = array('error' => $this->upload->display_errors());
            // print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

//          echo '<pre>';
//          echo $data['upload_data']['file_name'];
//          echo '</pre>';

          //exit();
        $this->load->library('excel');
        $this->excel = PHPExcel_IOFactory::load(FCPATH . "uploads/" . $data['upload_data']['file_name']);
        $a = $this->excel->setActiveSheetIndex()->toArray(null, TRUE, TRUE, TRUE);
        
        echo '<pre>';
          print_r($a);
          echo '</pre>';
          exit();
        
        foreach ($a as $data) {
            echo $data['B'] . '<br/>';
        }
    }
}
