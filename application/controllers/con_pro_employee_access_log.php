<?php
class Con_pro_employee_access_log extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_pro_employee_access_log');
        $this->load->library('pagination');
    }

    public function search() {
        $searchterm = $this->searchterm_handler($this->input->get_post('searchterm', TRUE));
        $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url() . 'con_pro_employee_access_log/search';
        $config['total_rows'] = $this->mod_pro_employee_access_log->search_record_count($searchterm);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);
        $this->pagination->initialize($config);

        $data['results'] = $this->mod_pro_employee_access_log->search($searchterm, $limit);
        $data['links'] = $this->pagination->create_links();
        $data['searchterm'] = $searchterm;
        $data['error_msg'] = '';
        $data['container'] = 'temp/employee_access_log/access_log';
        $this->load->view('main_page', $data);
    }

    public function example() {

        $searchterm = $this->input->post('searchterm', TRUE);
        if(empty($searchterm)){$this->session->unset_userdata('searchterm');}
        $search_key = $this->searchterm_handler($searchterm);

        $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url() . 'con_pro_employee_access_log/example';
        $config['total_rows'] = $this->mod_pro_employee_access_log->all_record_count($search_key);
        $config['per_page'] = 20;
        $config['num_links'] = 20;

        //bootstrap configaration
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '&laquo;';
        $config['prev_link'] = '&lsaquo;';
        $config['last_link'] = '&raquo;';
        $config['next_link'] = '&rsaquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['searchterm'] = $searchterm;
        $data['results'] = $this->mod_pro_employee_access_log->all_record($limit, $search_key);
        $data['links'] = $this->pagination->create_links();
        $data['error_msg'] = '';
        $data['container'] = 'temp/employee_access_log/access_log';
        $this->load->view('main_page', $data);
    }

    public function searchterm_handler($searchterm = null) {
        if ($searchterm) {
            $this->session->set_userdata('searchterm', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('searchterm')) {
            $searchterm = $this->session->userdata('searchterm');
            return $searchterm;
        } else {
            $this->session->unset_userdata('searchterm');
            $searchterm = "";            
            return $searchterm;
        }
    }

}
