<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Birth_coverage extends CI_Controller {

	public function __construct()
	{
			parent:: __construct();
			if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        	}
			$this->load->helper('url');
			$this->load->model('coverage');
	}

	public function index()
	{	
		//$this->load->view('head');
		$this->load->view('header');
		$this->load->view('birth');
		$this->load->view('sidebar');
		$this->load->view('birth_content');
		$this->load->view('footer');
	}

	

		public function data()
		{
				
				$data = $this->coverage->get_birth_coverage();
				
				$category = array();
				$category['name'] = 'desa';
				
				$series1 = array();
				$series1['name'] = 'Birth Coverage';
				
			//	$series2 = array();
			//	$series2['name'] = 'K4 (ANC 4)';
				
				//$series3 = array();
			//	$series3['name'] = 'Highcharts';
				
				foreach ($data as $row)
				{
				    $category['data'][] = $row->desa;
					$series1['data'][] = $row->birthCoverage;
				//	$series2['data'][] = $row->k4_coverage;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}


}