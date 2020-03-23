<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('M_data','data');
    }

    public function getUserIP(){
        /* getip.php */
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        echo json_encode(array('ip' => $ip));
    }

    public function getUserDevice(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        //$useragent = 'Mozilla/5.0 (iPad; CPU OS 9_3_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13F69 Safari/601.1';
        $url = "https://api.useragentinfo.co/device";

        $data = array('ua' => $useragent);

        $headers = array();
        $headers[] = "Content-Type: application/json";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 200 ) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        $result = json_decode($json_response, true);
        /*
        if ($result['device_type'] === 'iPad') {
        echo "It's an iPad\n";
        }
        */
        echo $json_response;
        curl_close($curl);
    }

    public function signUp(){
         /* Load form validation library */ 
         $this->load->library('form_validation');
			
        /* Validation rule */
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                
        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('vw_signup'); 
        } 
        else { 
            $this->data->saveData();
            $success = "Your account has been successfully created! Click <a href='".base_url('main/login')."'>Here</a> To Login";
            $this->load->view('vw_signup', compact('success')); 
        } 
    }

    public function login(){
        
    }

    public function check_email($email)
    {
        $query = $this->db->where('email', $email)->get("tb_users");
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('check_email','The '.$email.' belongs to an existing account');
            return FALSE;
        }
        else 
            return TRUE;
    }	

    public function check_username($username)
    {
        $query = $this->db->where('username', $username)->get("tb_users");
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('check_username','The '.$username.' belongs to an existing account');
            return FALSE;
        }
        else 
            return TRUE;
    }	
}
?>