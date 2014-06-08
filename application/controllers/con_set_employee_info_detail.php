<?php

class Con_set_employee_info_detail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_employee_info_detail');
        $this->load->helper('alert');
        $this->load->library('pagination');
    }

    public function get_job_category() {
        $data['tbl_job_category'] = $this->mod_set_employee_info_detail->get_job_category_name();
        $data['container'] = 'temp/worker_profile/create';
        $this->load->view('main_page', $data);
    }

//    public function search() {
//        $data['container'] = 'temp/daily_report_generate/search';
//        $this->load->view('main_page', $data);
//    }
//    public function employee_information() {
//        
//        $data['tbl_employee_info'] = $this->mod_set_employee_info_detail->view();
//        $data['container'] = 'temp/employee_detail/employee_info_detail';
//        $this->load->view('main_page', $data);
//    }

    public function search() {
        $searchterm = $this->searchterm_handler($this->input->get_post('searchterm', TRUE));
        $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url() . 'con_set_employee_info_detail/search';
        $config['total_rows'] = $this->mod_set_employee_info_detail->search_record_count($searchterm);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);
        $this->pagination->initialize($config);

        $data['results'] = $this->mod_set_employee_info_detail->search($searchterm, $limit);
        $data['links'] = $this->pagination->create_links();
        $data['searchterm'] = $searchterm;
        $data['error_msg'] = '';
        $data['container'] = 'temp/employee_detail/employee_info_detail';
        $this->load->view('main_page', $data);
    }

    function ajax_page($offset = 0) {
        if ($this->input->post('mvalue')) {
            $offset = $this->input->post('mvalue');
        }
        $Department = $this->input->post('Department');
        $EmployeeName = $this->input->post('Name');
        $CardNo = $this->input->post('CardNo');
        $ContactNo = $this->input->post('ContactNo');
        $FromGrossSalary = $this->input->post('FromGrossSalary');
        $ToGrossSalary = $this->input->post('ToGrossSalary');
        $NID = $this->input->post('NID');
        $limit = 10;

        $this->load->library('Jquery_pagination');

        $config['base_url'] = site_url('con_set_employee_info_detail/ajax_page/');
        /* Here i am indicating to the url from where the pagination links and the table section will be fetched */

        $config['div'] = '#mmmd';
        /* CSS selector  for the AJAX content */

        $config['total_rows'] = $this->mod_set_employee_info_detail->search_employee_info_details_all_records_count($Department, $EmployeeName, $CardNo, $ContactNo, $FromGrossSalary, $ToGrossSalary, $NID, $limit, $offset);
        $config['per_page'] = 10;
        $config['per_page'] = 10;
        $config['num_links'] = 10;
        $config['prev_link'] = 'পূর্ববর্তী';
        $config['next_link'] = 'পরবর্তী';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_open'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = 'সর্ব প্রথম';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = 'সর্ব শেষ';
        $this->jquery_pagination->initialize($config);

        $this->load->library('table');
        $tmpl = array(
            'table_open' => '<table class="table table-condensed table-responsive table-bordered table-hover">',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($tmpl);
        $this->table->set_heading('ক্রমিক নং', 'ভবনের নাম ', 'ফ্লোর', 'বিভাগ/সেকশন', 'লাইন', 'নাম ', 'পদবি', 'যোগদানের তারিখ', 'কার্ড নং', 'গ্রেড', 'বর্তমান বেতন', 'শেষ বর্ধিত তারিখ', 'শেষ বর্ধিত টাকা', 'মোবাইল নং', 'জাতীয় পরিচয় পত্র নং', 'পদোন্নতির তারিখ', 'পিতা/স্বামীর নাম', 'গ্রাম', 'ডাকঘর', 'থানা', 'জেলা', 'গ্রাম', 'ডাকঘর', 'থানা ', 'জেলা', 'রেফারেন্স', 'শিক্ষাগত যোগ্যতা', 'মন্তব্য');
        $html = $this->table->generate($this->mod_set_employee_info_detail->search_employee_info_details_all_records($Department, $EmployeeName, $CardNo, $ContactNo, $FromGrossSalary, $ToGrossSalary, $NID, $limit, $offset)) . $this->jquery_pagination->create_links();

        echo $html;
    }

    public function example() {
        $config['base_url'] = base_url() . 'con_set_employee_info_detail/example';
        $config['total_rows'] = $this->mod_set_employee_info_detail->serach_count_rows_for_pagination();
        $config['per_page'] = 10;
        $config['num_links'] = 10;
        $config['prev_link'] = 'পূর্ববর্তী';
        $config['next_link'] = 'পরবর্তী';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_open'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = 'সর্ব প্রথম';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = 'সর্ব শেষ';
        $this->pagination->initialize($config);
        if ($this->mod_set_employee_info_detail->serach_count_rows_for_pagination() > 0) {
            $data['results'] = $this->mod_set_employee_info_detail->all_record($config['per_page'], $this->uri->segment(3));
        }
        $data['tbl_section'] = $this->mod_set_employee_info_detail->get_section_list();
        $data['error_msg'] = '';
        $data['container'] = 'temp/employee_detail/employee_info_detail';
        $this->load->view('main_page', $data);
    }

    //Search Result Method For Employee Details
    public function search_employee_info_details() {
        $Department = $this->input->post('Department');
        $EmployeeName = $this->input->post('Name');
        $CardNo = $this->input->post('CardNo');
        $ContactNo = $this->input->post('ContactNo');
        $FromGrossSalary = $this->input->post('FromGrossSalary');
        $ToGrossSalary = $this->input->post('ToGrossSalary');
        $NID = $this->input->post('NID');
        if (!$this->uri->segment(3)) {
            $counts = 0;
        } else {
            $counts = $this->uri->segment(3);
        }

        $config['base_url'] = base_url() . 'con_set_employee_info_detail/search_employee_info_details';
        $config['per_page'] = 10;

        $config['total_rows'] = 200;
        $config['num_links'] = 10;
        $config['prev_link'] = 'পূর্ববর্তী';
        $config['next_link'] = 'পরবর্তী';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_open'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = 'সর্ব প্রথম';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = 'সর্ব শেষ';
        $this->pagination->initialize($config);

        $data['results'] = $this->mod_set_employee_info_detail->search_employee_info_details_all_records($Department, $EmployeeName, $CardNo, $ContactNo, $FromGrossSalary, $ToGrossSalary, $NID, $config['per_page'], $counts);

        $data['tbl_section'] = $this->mod_set_employee_info_detail->get_section_list();
        $data['error_msg'] = '';
        $data['container'] = 'temp/employee_detail/employee_info_detail';
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

    public function test() {
        $query = $this->mod_set_employee_info_detail->search_employee_info_details_all_records('', 'মোঃ শাখাওয়াত ইসলাম', '', '', '', '', '', '', '');
        echo $query->num_rows;
        echo '<br />';
        print_r($query->result());
    }

//    public function generate_daily_report() {
//        for ($id = 1; $id <= 18000; $id++) {
//            for ($day = 1; $day <= 31; $day++) {
//                $date = '2014-03-' . $day;
////                echo $id . '->' . $date;
////                echo '</br>';
//                $this->mod_access_log->CardNo = '' . $id;
//                $this->mod_access_log->DateTime = date("Y-m-d ", strtotime($date));
//                $data['tbl_access_log'] = $this->mod_access_log->view_by_id();
//                $m = count($data['tbl_access_log']);
//            }
//        }
//        exit();
//        $data['tbl_daily_attendance_log'] = $this->mod_daily_attendance_log->view();
//        $data['container'] = 'temp/daily_report_generate/daily_attendence_view';
//        $this->load->view('main_page', $data);
//    }
//
//    public function view_by_id() {
//        if ($this->input->post('submit') == 'Search') {
//            $this->mod_access_log->CardNo = $this->input->post('CardNo');
//            $this->mod_access_log->DateTime = date("Y-m-d ", strtotime($this->input->post('DateTime')));
//            $data['tbl_access_log'] = $this->mod_access_log->view_by_id();
//            $m = count($data['tbl_access_log']);
//            if (!($m % 2) == 0)
//                $data['msg'] = 'This User has some problems with access';
//            $data['container'] = 'temp/daily_report_generate/view';
//            $this->load->view('main_page', $data);
//        }
//    }
//
//    public function edit() {
//        if ($this->input->post('submit') == 'edit') {
//            $this->mod_access_log->ID = $this->input->post('ID');
//            $data['tbl_log'] = $this->mod_access_log->view_by_id();
//            $data['container'] = 'temp/log/edit';
//            $this->load->view('temp/main_page', $data);
//        }
//        if ($this->input->post('submit') == 'delete') {
//            $this->delete();
//        }
//    }
}

?>
