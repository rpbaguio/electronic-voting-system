<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ballot_Form extends CI_Controller
{

    private $id = '';

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->id = user('id');
    }

    public function index()
    {
        $this->ballot_form();
    }

    public function ballot_form()
    {
        if (logged_in() && user('role_id') == 2) {
            $this->form_validation
                ->set_rules('candidate_id[]', 'Candidate', 'required',
                    array('required' => 'Please select a %s.'))
                ->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run()) {
                $this->tally_model->_create_tally();
                $this->person_model->_update_person_status(user('id'));
                redirect('auth/signout', 'refresh');
            } else {
                $view_data = [
                    'page_title' => 'Ballot Form',
                    'page_header' => 'EVS',
                ];

                $this->load->view('_shared/header', $view_data);
                $this->load->view('ballot-form');
            }
        } else {
            redirect('auth/signin', 'refresh');
        }
    }

}

/* End of file: Ballot_Form.php */
/* Location: application/controller/Ballot_Form.php */
