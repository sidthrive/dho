<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidan_anc_submission_model extends CI_Model {

	function __construct()
	{
			parent::__construct();
	}
        
        function getUserById ($userId){
            $this->db->select('submissiondate, count');
            $this->db->from('count_per_form.kartu_anc_visit');
            $this->db->where('userid',$userId);
            $query = $this->db->get();
            return $query->result();
        }
}