<?php

if (!defined('BASEPATH')) {
    exit('No direct script  allowed');
}

class Position_Model extends CI_Model
{
    private $tbl;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('custom_dbconfig');
        $this->tbl = $this->config->item('db_tbl_position');
    }

    public function _get_position()
    {
        $this->db
            ->select('*')
            ->from($this->tbl);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function _get_position_by_id($id)
    {
        $this->db
            ->select('*')
            ->from($this->tbl)
            ->where($this->tbl.'.id', $id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }
}

/*
 * end of file
 * location: models/Person_model.php
 */
