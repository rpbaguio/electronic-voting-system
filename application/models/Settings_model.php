<?php

if (!defined('BASEPATH')) {
    exit('No direct script  allowed');
}

class Settings_Model extends CI_Model
{
    private $tbl;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('custom_dbconfig');
        $this->tbl = $this->config->item('db_tbl_settings');
    }

    public function _get_settings()
    {
        $this->db
            ->select('*')
            ->from($this->tbl);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

}

/*
 * end of file
 * location: models/Settings_model.php
 */
