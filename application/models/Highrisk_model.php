<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Highrisk_model extends CI_Model {

	function __construct()
	{
			parent::__construct();
	}

	function get_pregnancy_risk()
	{

		$this->db->select('desa, highRiskPregnancyProteinEnergyMalnutrition, HighRiskPregnancyTooManyChildren, HighRiskPregnancyAbortus, highRiskPregnancyPIH, highRiskPregnancyAnemia, highRiskPregnancyDiabetes');
        $this->db->from('chart.highrisk');
        $query = $this->db->get();
        return $query->result();
	}

	function get_labour_risk()
	{

		$this->db->select('desa,  highRisklabourFetusNumber, highRiskLabourFetusSize, highRiskLabourFetusMalpresentation, High_Risk_TBC, High_Risk_malaria');
        $this->db->from('chart.highrisk');
        $query = $this->db->get();
        return $query->result();
	}


	

}