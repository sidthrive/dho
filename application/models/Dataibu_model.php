<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dataibu_model extends CI_Model {

	function __construct()
	{
			parent::__construct();
	}

	function get_ibu_data()
	{

		$this->db->select('desa, ibu_hamil, ibu_melahirkan');
        $this->db->from('chart.jumlah_ibu');
        $query = $this->db->get();
        return $query->result();
	}

}