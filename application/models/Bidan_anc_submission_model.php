<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidan_anc_submission_model extends CI_Model {

	function __construct()
	{
			parent::__construct();
	}

	function get_user1()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user1');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user2()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user2');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user3()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user3');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user4()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user4');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user5()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user5');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user6()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user6');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user8()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user8');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user9()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user9');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user10()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
         $this->db->where('userid','user10');
        $query = $this->db->get();
        return $query->result();
	}
	
	/* function get_user2()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user2');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user3()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user3');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user4()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user4');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user5()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user5');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user6()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user6');
        $query = $this->db->get();
        return $query->result();
	}	
	
	function get_user8()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user8');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user9()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user9');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user10()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user10');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user11()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user11');
        $query = $this->db->get();
        return $query->result();
	}	
	function get_user12()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user12');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user13()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user13');
        $query = $this->db->get();
        return $query->result();
	}
	function get_user14()
	{

		$this->db->select('submissiondate, count');
        $this->db->from('count_per_form.kartu_anc_visit');
        $this->db->where('userid','user14');
        $query = $this->db->get();
        return $query->result();
	} */
	

}