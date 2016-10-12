<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $id = '';

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(false);
        $this->id = user('id');
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        if (logged_in() && user('role_id') == 1) {
            $view_data = [
                'page_title' => 'Dashboard',
                'page_header' => 'EVS',
            ];

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/dashboard');
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function persons()
    {
        if (logged_in() && user('role_id') == 1) {
            $view_data = [
                'page_title' => 'Persons',
                'page_header' => 'EVS',
            ];

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/persons');
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function person_info()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        foreach ($this->person_model->_get_person_by_id($this->uri->segment(3)) as $row) {
            $qrcode = $this->_alpha_numeric_randomizer();
            $data = [
                'id' => $row->person_id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'birth_date' => $row->birth_date,
                'access_code' => $qrcode,
                'dt_registered' => $row->dt_registered,
                'qrcode' => $this->_qrcode_generator($qrcode)
            ];
        }

        echo json_encode($data);
    }

    public function update_person_info()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $this->form_validation
            ->set_rules('first_name', 'First Name', 'trim|required|xss_clean')
            ->set_rules('last_name', 'Last Name', 'trim|required|xss_clean')
            ->set_rules('access_code', 'Access Code', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {
            $this->person_model->_update_person_access($this->uri->segment(3));
            $this->person_model->_update_person_info($this->uri->segment(3));

            $data = [
                'status' => true,
                'msg' => '<div class="alert alert-success">Successfully updated.</div>',
            ];
            echo json_encode($data);
        } else {
            $data = [
                'status' => false,
                'msg' => '<div class="alert alert-danger"><ul class="validation-errors">'.validation_errors().'</ul></div>',
                'fist_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'birth_date' => form_error('birth_date'),
                'access_code' => form_error('access_code'),
            ];
            echo json_encode($data);
        }
    }

    public function add_person()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $this->form_validation
            ->set_rules('first_name', 'First Name', 'trim|required|xss_clean')
            ->set_rules('last_name', 'Last Name', 'trim|required|xss_clean')
            ->set_rules('gender', 'Gender', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {
            $this->person_model->_add_person();

            $data = [
                'status' => true,
                'msg' => '<div class="alert alert-success">New person added.</div>',
            ];
            echo json_encode($data);
        } else {
            $data = [
                'status' => false,
                'msg' => '<div class="alert alert-danger"><ul class="validation-errors">'.validation_errors().'</ul></div>',
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'gender' => form_error('gender')
            ];
            echo json_encode($data);
        }
    }

    public function delete_person()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        if ($this->input->post('id')) {
            $this->person_model->_delete_person($this->uri->segment(3));

            $data = [
                'status' => true,
                'msg' => '<div class="alert alert-success">Successfully deleted.</div>'
            ];
            echo json_encode($data);
        } else {
            $data = [
                'status' => false,
                'msg' => '<div class="alert alert-danger">Unable to delete record.</div>'
            ];
            echo json_encode($data);
        }
    }

    public function voting_results()
    {
        if (logged_in() && user('role_id') == 1) {
            $view_data = [
                'page_title' => 'Voting Results',
                'page_header' => 'EVS',
            ];

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/voting-results-container');
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function voting_results_content()
    {
        if (logged_in() && user('role_id') == 1) {
            $view_data = [
                'page_title' => 'Voting Results',
                'page_header' => 'EVS',
            ];

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/voting-results-content');
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function gender()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $m = 'male';
        $f = 'female';

        $data = array(
            'labels' => array(
                'Male', 'Female',
            ),
            'gender' => array(
                $this->person_model->_count_persons_by_gender($m),
                $this->person_model->_count_persons_by_gender($f)
            )
        );

        echo json_encode($data);
    }

    public function status()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('admin', 'refresh');
        }

        $validated = 1;
        $unvalidated = 0;
        $voted = 1;
        $unvoted = 0;

        $data = array(
            'labels' => array(
                'Validated', 'Not Validated', 'Voted', 'Not Voted',
            ),
            'status' => array(
                $this->person_model->_count_validated_persons($validated),
                $this->person_model->_count_validated_persons($unvalidated),
                $this->person_model->_count_voted_persons($voted),
                $this->person_model->_count_voted_persons($unvoted)
            )
        );

        echo json_encode($data);
    }

    # Data source in JSON format (for datatables)
    public function person_data()
    {
        if (logged_in() && user('role_id') == 1) {
            $this->datatables
                ->select('tbl_person.id AS person_id, tbl_person.is_validated, tbl_person.is_voted, tbl_person.is_candidate, tbl_person_info.first_name, tbl_person_info.last_name, tbl_person_info.gender', false)
                ->from('tbl_person')
                ->join('tbl_person_info', 'tbl_person_info.id = tbl_person.id', 'left')
                ->where('tbl_person.role_id = 2')
                ->where('tbl_person.is_deleted = 0');
            echo $this->datatables->generate();
        } else {
            redirect('auth', 'refresh');
        }
    }

    # helper
    public function _alpha_numeric_randomizer()
    {
        $arr = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'); // get all the characters into an array
        shuffle($arr); // randomize the array
        $arr = array_slice($arr, 0, 4); // get the four (random) characters out
        $str = implode('', $arr);

        return strtolower($str);
    }

    public function _qrcode_generator($access_code)
    {
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = ''; //string, the default is application/cache/
        $config['errorlog']     = ''; //string, the default is application/logs/
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '10'; //interger, the default is 1024
        $config['black']        = array(255, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(0, 0, 0); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $params['data'] = $access_code;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = FCPATH . 'assets/img/misc/' . $access_code . '-qrcode.png';
        $this->ciqrcode->generate($params);

        return base_url('assets/img/misc') .'/'. $access_code . '-qrcode.png';
    }
    # end helper
}

/* End of file: Admin.php */
/* Location: application/controller/Admin.php */
