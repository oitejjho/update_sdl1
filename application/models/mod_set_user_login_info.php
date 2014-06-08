<?php
class Mod_set_user_login_info extends CI_Model{
    public $ID;
    public $UserName;
    public $Password;
    public $Email;
    public $Role;
    
    public function can_log_in(){
        $this->db->where('Email', $this->Email);
        $this->db->where('Password', $this->Password);
        $query = $this->db->get('tbl_user');        
        if($query->num_rows() == 1){
            return $query->row();
        }  else {
            return FALSE;
        }
    }
}
