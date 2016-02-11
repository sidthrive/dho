<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kia2 extends CI_Controller {

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
		$this->load->view('kia2');
		$this->load->view('footer');
	}

	public function January() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia2/pws2_1.xlsx /var/www/dho/assets/reports/kia2/pws2.xlsx";
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia2/jan.json -j /var/www/dho/assets/reports/kia2/KIA2def.json -x /var/www/dho/assets/reports/kia2/pws2.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia2/pws2.xlsx");
    	   $name = "pws2_Januari.xlsx";
    	   force_download($name, $data);
    }

    public function February() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia2/pws2_1.xlsx /var/www/dho/assets/reports/kia2/pws2.xlsx";
        
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia2/feb.json -j /var/www/dho/assets/reports/kia2/KIA2def.json -x /var/www/dho/assets/reports/kia2/pws2.xlsx";
    	//exec($pyth);
    	echo shell_exec($copy);
        echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia2/pws2.xlsx");
    	  $name = "pws2_Februari.xlsx";
    	  force_download($name, $data);
    }
   

}