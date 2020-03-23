<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function index(){
        $this->load->view("vw_main");
    }

    public function signup(){
        $this->load->view("vw_signup");
    }

    public function login(){
        $this->load->view("vw_login");
    }
}
?>