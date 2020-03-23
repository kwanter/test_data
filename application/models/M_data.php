<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model{
    public function saveData()
    {
	   $data['username'] = $this->input->post('username');
	   $data['email'] = $this->input->post('email');
	   $data['password'] = md5($this->input->post('password'));
	   $this->db->insert('tb_users', $data);
    }

    public function check_login(){
        
    }
}
?>