<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coverage extends CI_Model {

	function __construct()
	{
			parent::__construct();
	}

	function get_anc_akses()
	{

		$this->db->select('desa, k1Standar, k1Akses');
        $this->db->from('chart.anc_visit_akses');
        $query = $this->db->get();
        return $query->result();
	}

	function get_anc_data()
	{

		$this->db->select('desa, k1_coverage, k4_coverage');
        $this->db->from('chart.anc_visit');
        $query = $this->db->get();
        return $query->result();
	}

	function get_birth_coverage()
	{

		$this->db->select('desa, birthCoverage');
        $this->db->from('chart.Birth_Coverage');
        $query = $this->db->get();
        return $query->result();
	}

}