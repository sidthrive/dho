<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kia1 extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	public function index()
	{	
		//$this->load->view('head');
		$this->load->view('header');
		
		$this->load->view('kia_sidebar');
		$this->load->view('kia');
		$this->load->view('footer');
	}

	public function January() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia1/pws1_1.xlsx /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/jan.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1_Januari.xlsx";
    	   force_download($name, $data);
    }

    public function February() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia1/pws1_1.xlsx /var/www/dho/assets/reports/kia1/pws1.xlsx";
        
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($copy);
        echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1_Februari.xlsx";
    	   force_download($name, $data);
    }
    /*
    public function March() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function April() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function May() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function June() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function July() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function January() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }

    public function January() {
   		$this->load->helper('download');
    	
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia1/feb.json -j /var/www/dho/assets/reports/kia1/KIA1_def.json -x /var/www/dho/assets/reports/kia1/pws1.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia1/pws1.xlsx");
    	   $name = "pws1.xlsx";
    	   force_download($name, $data);
    }
    */

}