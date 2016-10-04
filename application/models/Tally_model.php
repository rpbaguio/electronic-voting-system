<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tally_Model extends CI_Model
{

    private $tbl;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('custom_dbconfig');
        $this->tbl = $this->config->item('db_tbl_tally');
    }

    public function _create_tally()
    {
        foreach ($this->input->post('candidate_id') as $candidate_id) {
            $data = array(
                'person_id' => user('id'),
                'candidate_id' => $candidate_id
            );
            $query = $this->db->insert($this->tbl, $data);
        }
        return $query;
    }
    
    public function _count_votes_by_candidate($id)
    {
        $this->db->where('tbl_tally.candidate_id', $id);
        $this->db->from($this->tbl);
        $query = $this->db->count_all_results();
        return $query;
    }
}

/* 
 * end of file 
 * location: models/Tally_model.php
 */
    