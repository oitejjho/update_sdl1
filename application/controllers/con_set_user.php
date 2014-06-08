<?php

class Con_set_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_user');
        $this->load->model('mod_set_building');
        $this->load->model('mod_set_floor');
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function generate_image() {
        for ($ID = 1; $ID < 100; $ID ++) {
            $SSQL = "SELECT GROUP_CONCAT( CONCAT( BuildingName,  '-' ) , CONCAT( Floor,  '-' ) , CONCAT( Department,  '-' ) , CONCAT( Line,  '-' ) , CONCAT(  '', ID ),'.jpg' ) as Image from tbl_employee_profile as B where B.ID=" . $ID;
            $tblLink = $this->db->query($SSQL);

            foreach ($tblLink->result() as $recLink) {
                echo $recLink->Image . "<br/>";
            }
            $SSQL = "Update tbl_employee_profile set Image = '" . $recLink->Image . "' where ID = '" . $ID . "'";
            $tblLink = $this->db->query($SSQL);
        }
    }

    public function view() {
        $data['tbl_user'] = $this->mod_set_user->view();
        $data['container'] = 'temp/user/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['tbl_building'] = $this->mod_set_building->view();
        $data['container'] = 'temp/user/create';
        $this->load->view('main_page', $data);
    }

    public function get_floor_name() {
        $BuildingID = $this->input->post('BuildingID');
        $Result = $this->mod_set_floor->view($BuildingID);
        echo json_encode($Result);
    }

    public function insert() {
        $this->mod_set_user->UserName = $this->input->post('UserName');
        $this->mod_set_user->Password = $this->input->post('Password');
        $this->mod_set_user->Email = $this->input->post('Email');
        $this->mod_set_user->Role = $this->input->post('Role');
        $this->mod_set_user->FirstName = $this->input->post('FirstName');
        $this->mod_set_user->MiddleName = $this->input->post('MiddleName');
        $this->mod_set_user->LastName = $this->input->post('LastName');
        $this->mod_set_user->Gender = $this->input->post('Gender');
        $this->mod_set_user->Image = $this->input->post('userfile');
        $this->mod_set_user->BuildingName = $this->input->post('BuildingName');
        $this->mod_set_user->Floor = $this->input->post('Floor');
        $this->mod_set_user->Department = $this->input->post('Department');
        $this->mod_set_user->Line = $this->input->post('Line');
        $this->mod_set_user->IsActive = $this->input->post('IsActive');
        $this->upload_image('insert');
        $this->mod_set_user->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_user/view', 'refresh');
        //}
    }

    public function edit() {
        $this->mod_set_user->ID = $this->uri->segment(3);
        $data['tbl_user'] = $this->mod_set_user->view_by_id();
        $data['tbl_building'] = $this->mod_set_building->view();
        $data['container'] = 'temp/user/edit';
        $this->load->view('main_page', $data);
    }

    public function delete() {
        $this->mod_set_user->ID = $this->uri->segment(3);
        $this->mod_set_user->delete();
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_user/view', 'refresh');
    }

    public function update() {
        $this->mod_set_user->ID = $this->input->post('ID');
        $this->mod_set_user->UserName = $this->input->post('UserName');
        $this->mod_set_user->Password = $this->input->post('Password');
        $this->mod_set_user->Email = $this->input->post('Email');
        $this->mod_set_user->Role = $this->input->post('Role');
        $this->mod_set_user->FirstName = $this->input->post('FirstName');
        $this->mod_set_user->MiddleName = $this->input->post('MiddleName');
        $this->mod_set_user->LastName = $this->input->post('LastName');
        $this->mod_set_user->Gender = $this->input->post('Gender');
        $this->mod_set_user->BuildingName = $this->input->post('BuildingName');
        $this->mod_set_user->Floor = $this->input->post('Floor');
        if ($this->input->post('previous_image_url')) {
            $this->mod_set_user->Image = $this->input->post('previous_image_url');
        } else {
            $this->mod_set_user->Image = $this->input->post('userfile');
        }
        if ($_FILES['userfile']['error'] == 0) {
            $this->upload_image('update');
        }

        $this->mod_set_user->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_user/view', 'refresh');
    }

    public function upload_image($event) {
        $this->load->library('image_lib');
        $config['upload_path'] = './img/';
        if ($event == 'insert') {
            $config['overwrite'] = FALSE;
        } else {
            $config['overwrite'] = TRUE;
        }

        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['encrypt_name'] = true;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data['myerror'] = $this->upload->display_errors();
            $data['tbl_user'] = $this->mod_set_user->view();
            $data['container'] = 'temp/user/view';
        } else {
            $data = $this->upload->data();
            $path = './img/';
            $source_image = $data['file_name'];

// Resize to medium

            $config['source_image'] = $path . $source_image;
            $config['overwrite'] = TRUE;
            $config['create_thumb'] = true;
            $config['thumb_marker'] = "_thurm";
            $config['width'] = 140;
            $config['height'] = 140;

            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
// an error occured
            }

// Keep the same source image
            $config['source_image'] = $path . $source_image;
            $config['overwrite'] = TRUE;
            $config['create_thumb'] = true;
            $config['thumb_marker'] = "_avater";
            $config['width'] = 35;
            $config['height'] = 35;

            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
// an error occured
            }
            $this->mod_set_user->Image_Thumb = $data['raw_name'] . "_thurm" . $data['file_ext'];
            $this->mod_set_user->Image = $data['raw_name'] . "_avater" . $data['file_ext'];
        }
    }

    public function has_email($str) {
        $this->mod_set_user->Email = $str;
        if ($this->mod_set_user->checkEmail()) {
            $this->form_validation->set_message('has_email', 'The email alredy in our system');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
