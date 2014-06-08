<?php

class Con_set_graph_genarate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_graph_genarate');
        $this->load->helper('alert');        
    }

    public function view() {
        $data['monthly_graph'] = $this->mod_set_graph_genarate->get_data();
        $data['container'] = 'temp/deshboard/view';
        $this->load->view('main_page', $data);
    }
}
