<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Highrisk extends CI_Controller {

	public function __construct()
	{
			parent:: __construct();
			if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        	}
			$this->load->helper('url');
			$this->load->model('highrisk_model');
	}

	public function index()
	{	
		//$this->load->view('head');
		$this->load->view('header');
		$this->load->view('highrisk');
		$this->load->view('sidebar');
		$this->load->view('highrisk_content');
		$this->load->view('footer');
	}

	

		public function data()
		{
				
				$data = $this->highrisk_model->get_pregnancy_risk();
	
				$category = array();
				$category['name'] = 'desa';
				
				$series1 = array();
				$series1['name'] = 'KEK';
				
				$series2 = array();
				$series2['name'] = 'Anak Terlalu Banyak';
				
				$series3 = array();
				$series3['name'] = 'Abortus';

				$series4 = array();
				$series4['name'] = 'PIH';

				$series5 = array();
				$series5['name'] = 'Anemia';

				$series6 = array();
				$series6['name'] = 'Diabetes';

				
				foreach ($data as $row)
				{
				    $category['data'][] = $row->desa;
					$series1['data'][] = $row->highRiskPregnancyProteinEnergyMalnutrition;
					$series2['data'][] = $row->HighRiskPregnancyTooManyChildren;
					$series3['data'][] = $row->HighRiskPregnancyAbortus;
					$series4['data'][] = $row->highRiskPregnancyPIH;
					$series5['data'][] = $row->highRiskPregnancyAnemia;
					$series6['data'][] = $row->highRiskPregnancyDiabetes;
				
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				array_push($result,$series2);
				array_push($result,$series3);
				array_push($result,$series4);
				array_push($result,$series5);
				array_push($result,$series6);
			
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function data1()
		{
				
				$data = $this->highrisk_model->get_labour_risk();
	
				$category = array();
				$category['name'] = 'desa';
				
				$series1 = array();
				$series1['name'] = 'highRisklabourFetusNumber';
				
				$series2 = array();
				$series2['name'] = 'highRiskLabourFetusSize';
				
				$series3 = array();
				$series3['name'] = 'highRiskLabourFetusMalpresentation';

				$series4 = array();
				$series4['name'] = 'High_Risk_TBC';

				$series5 = array();
				$series5['name'] = 'High_Risk_malaria';

				
				foreach ($data as $row)
				{
				    $category['data'][] = $row->desa;
					$series1['data'][] = $row->highRisklabourFetusNumber;
					$series2['data'][] = $row->highRiskLabourFetusSize;
					$series3['data'][] = $row->highRiskLabourFetusMalpresentation;
					$series4['data'][] = $row->High_Risk_TBC;
					$series5['data'][] = $row->High_Risk_malaria;
					
				
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				array_push($result,$series2);
				array_push($result,$series3);
				array_push($result,$series4);
				array_push($result,$series5);
			
			
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}



}