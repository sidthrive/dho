<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anc_submission extends CI_Controller {

	public function __construct()
	{
			parent:: __construct();
			if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        	}
			$this->load->helper('url');
			$this->load->model('bidan_anc_submission_model');
	}

	public function index()
	{	
		//$this->load->view('head');
		$this->load->view('header');
		$this->load->view('anc_submission');
		$this->load->view('user_sidebar');
		$this->load->view('anc_submission_content');
		$this->load->view('footer');
	}

		public function user1()
		{
				
				$data = $this->bidan_anc_submission_model->get_user1();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user2()
		{
				
				$data = $this->bidan_anc_submission_model->get_user2();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user3()
		{
				
				$data = $this->bidan_anc_submission_model->get_user3();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user4()
		{
				
				$data = $this->bidan_anc_submission_model->get_user4();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user5()
		{
				
				$data = $this->bidan_anc_submission_model->get_user5();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user6()
		{
				
				$data = $this->bidan_anc_submission_model->get_user6();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user8()
		{
				
				$data = $this->bidan_anc_submission_model->get_user8();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user9()
		{
				
				$data = $this->bidan_anc_submission_model->get_user9();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user10()
		{
				
				$data = $this->bidan_anc_submission_model->get_user10();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
			*/	
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->count;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}
	/*	public function user2()
		{
				
				$data = $this->bidan_anc_submission_model->get_user2();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
				
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->Jumlah;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}

		public function user3()
		{
				
				$data = $this->bidan_anc_submission_model->get_user3();
				
				$category = array();
				$category['name'] = 'submissiondate';
				
				$series1 = array();
				$series1['name'] = 'Jumlah';
				
			/*	$series2 = array();
				$series2['name'] = 'Melahirkan';
				
				//$series3 = array();
				$series3['name'] = 'Highcharts';
				
				foreach ($data as $row)
				{
				    $category['data'][] = $row->submissiondate;
					$series1['data'][] = $row->Jumlah;
				//	$series2['data'][] = $row->ibu_melahirkan;
				//	$series3['data'][] = $row->highcharts;
				}
				
				$result = array();
				array_push($result,$category);
				array_push($result,$series1);
				//array_push($result,$series2);
				//array_push($result,$series3);
				
				print json_encode($result, JSON_NUMERIC_CHECK);
		}
		*/

}