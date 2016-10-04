<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authme
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->model('person_model');
        $this->CI->config->load('authme');
    }

    public function logged_in()
    {
        return $this->CI->session->userdata('logged_in');
    }

    public function signin($access_code)
    {
        $user = $this->CI->person_model->_get_person_by_access_code(hash('sha256', $access_code));
        if ($user) {
            unset($user->access_code);
            $this->CI->session->set_userdata(array(
                'logged_in' => true,
                'user' => $user
            ));
            //$this->CI->person_model->update_person($user->id, array('last_login' => date('Y-m-d H:i:s')));
            return true;
        }
        return false;
    }

    public function signout($redirect = false)
    {
        $this->CI->session->sess_destroy();
        if ($redirect) {
            $this->CI->load->helper('url');
            redirect($redirect, 'refresh');
        }
    }
}

/* End of file: authme.php */
/* Location: application/libraries/authme.php */
