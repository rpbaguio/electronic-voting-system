<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(FALSE);
	}
	public function index() {
		$this->signin();
	}
	public function signin() {
		if(logged_in()) {
			$this->_user_role();
		}
		
		$view_data = [
				'error' => '',
				'page_title' => 'Login',
				'page_header' => 'EVS'
		];
		
		$this->form_validation->set_rules('access_code', 'Access Code', 'trim|required|xss_clean|callback_validate_person', array (
				'required' => 'System generated %s is required.' 
		))->set_error_delimiters('<li>', '</li>');
		
		if($this->form_validation->run()) {
			if($this->authme->signin(set_value('access_code'))) {
				$this->index();
			}
			else {
				$view_data['error'] = 'Access code is invalid.';
			}
		}
		
		$this->load->view('_shared/header', $view_data);
		$this->load->view('_shared/signin');
	}
	public function signout() {
		$this->authme->signout('auth');
	}
	
	// callback
	public function validate_person() {
		$is_validated = 1;
		$is_voted = 0;
		$access_code = set_value('access_code');
		
		if($this->person_model->_validate_person($is_validated, $is_voted, $access_code)) {
			return true;
		}
		else {
			$this->form_validation->set_message('validate_person', 'Access code is invalid.');
			return false;
		}
	}
	// end callback
	
	// helpers
	private function _user_role() {
		switch(user('role_id')) {
			case 1:
				redirect('admin/dashboard', 'refresh');
				break;
			case 2:
				redirect('ballot_form', 'refresh');
				break;
		}
	}
	// end helpers
}

/* End of file: Auth.php */
/* Location: application/controller/Auth.php */
