<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class Person_Model extends CI_Model
{
    private $tbl;
    private $role = '';

    public function __construct()
    {
        parent::__construct();

        $this->config->load('custom_dbconfig');
        $this->tbl = $this->config->item('db_tbl_person');
        $this->role = 2;
    }

    public function _get_person_by_access_code($access_code)
    {
        $this->db
            ->select('*')
            ->from($this->tbl)
            ->where($this->tbl.'.access_code', $access_code);
        $query = $this->db->get();

        return ($query->num_rows()) ? $query->row() : false;
    }

    public function _get_person_by_id($id)
    {
        $this->db
            ->select('tbl_person.id AS person_id, tbl_person.dt_registered, t2.first_name, t2.last_name, t2.birth_date')
            ->from($this->tbl)
            ->join('tbl_person_info AS t2', 't2.id ='.$this->tbl.'.id', 'left')
            ->where($this->tbl.'.id', $id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function _get_person_by_position_id($id)
    {
        $this->db
            ->select('tbl_person.id AS person_id,'.
                'tbl_person_info.first_name,'.
                'tbl_person_info.middle_name,'.
                'tbl_person_info.last_name,'.
                'tbl_person_info.avatar,'.
                'tbl_group.name AS group_name')
            ->from($this->tbl)
            ->join('tbl_position', 'tbl_position.id ='.$this->tbl.'.position_id', 'left')
            ->join('tbl_group', 'tbl_group.id ='.$this->tbl.'.group_id', 'left')
            ->join('tbl_person_info', 'tbl_person_info.id ='.$this->tbl.'.id', 'left')
            ->where($this->tbl.'.position_id', $id)
            ->order_by($this->tbl.'.group_id', 'ASC');
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function _get_person_by_role_id($id)
    {
        $this->db
            ->select('tbl_person.id AS person_id, tbl_role.name AS role_name')
            ->from($this->tbl)
            ->join('tbl_role', 'tbl_role.id ='.$this->tbl.'.role_id', 'left')
            ->where($this->tbl.'.role_id', $id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function _update_person_status($id)
    {
        $data = array(
            'is_voted' => 1,
        );

        $this->db
            ->where('tbl_person.id', $id)
            ->update($this->tbl, $data);

        if ($this->db->affected_rows() == true) {
            return $this->session->set_flashdata('success', 'Record #'.$id.nbs().'has been updated.');
        }
    }

    public function _update_person_access($id)
    {
        $hash = hash('sha256', $this->input->post('access_code'));

        $data = array(
            'access_code' => $hash,
            'is_validated' => 1,
            'dt_updated' => date('Y-m-d H:i:s')
        );

        $this->db
            ->where('tbl_person.id', $id)
            ->update($this->tbl, $data);

        if ($this->db->affected_rows() == true) {
            return $this->session->set_flashdata('success', 'Record #'.$id.nbs().'has been updated.');
        }
    }

    public function _update_person_info($id)
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date')
        );

        $this->db
            ->where('tbl_person_info.id', $id)
            ->update('tbl_person_info', $data);

        if ($this->db->affected_rows() == true) {
            return $this->session->set_flashdata('success', 'Record #'.$id.nbs().'has been updated.');
        }
    }

    public function _add_person()
    {
        $this->db->trans_begin();

        $person_data1 = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date'),
            'gender' => $this->input->post('gender')
        );

        $this->db->insert('tbl_person_info', $person_data1);

        $person_data2 = array(
            'id' => $this->db->insert_id(),
            'role_id' => $this->role,
            'is_validated' => 0,
            'is_voted' => 0,
            'is_candidate' => 0,
            'group_id' => 0,
            'position_id' => 0,
            'is_deleted' => 0,
            'dt_registered' => date('Y-m-d H:i:s')
        );

        $this->db->insert($this->tbl, $person_data2);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function _delete_person($id)
    {
        $data = array(
            'is_deleted' => 1
        );

        $this->db
            ->where('tbl_person.id', $id)
            ->update($this->tbl, $data);

        if ($this->db->affected_rows() == true) {
            return $this->session->set_flashdata('success', 'Record #'. $id . nbs() . 'has been deleted.');
        }
    }

    public function _count_voters()
    {
        $this->db
            ->from($this->tbl)
            ->where($this->tbl.'.role_id', $this->role);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function _count_persons_by_gender($param)
    {
        $this->db
            ->from($this->tbl)
            ->join('tbl_person_info AS t2', 't2.id ='.$this->tbl.'.id', 'left')
            ->where('t2.gender', $param)
            ->where($this->tbl.'.is_deleted', 0);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function _count_validated_persons($param)
    {
        $this->db
            ->from($this->tbl)
            ->where($this->tbl.'.role_id', $this->role)
            ->where($this->tbl.'.is_validated', $param)
            ->where($this->tbl.'.is_deleted', 0);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function _count_voted_persons($param)
    {
        $this->db
            ->from($this->tbl)
            ->where($this->tbl.'.role_id', $this->role)
            ->where($this->tbl.'.is_voted', $param)
            ->where($this->tbl.'.is_deleted', 0);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function _validate_person($is_validated, $is_voted, $access_code)
    {
        $hash = hash('sha256', $access_code);
        $this->db
            ->select('*')
            ->from($this->tbl)
            ->where($this->tbl.'.is_validated', $is_validated)
            ->where($this->tbl.'.is_voted', $is_voted)
            ->where($this->tbl.'.access_code', $hash);
        $query = $this->db->get();

        return ($query->num_rows()) ? $query->row() : false;
    }
}

/*
 * end of file
 * location: models/Person_model.php
 */
