<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kia3 extends CI_Controller {

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
		$this->load->view('kia3');
		$this->load->view('footer');
	}

	public function January() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia3/pws3_1.xlsx /var/www/dho/assets/reports/kia3/pws3.xlsx";
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia3/jan.json -j /var/www/dho/assets/reports/kia3/KIA3def.json -x /var/www/dho/assets/reports/kia3/pws3.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia3/pws3.xlsx");
    	   $name = "pws3_Januari.xlsx";
    	   force_download($name, $data);
    }

    public function February() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia3/pws3_1.xlsx /var/www/dho/assets/reports/kia3/pws3.xlsx";
        
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia3/feb.json -j /var/www/dho/assets/reports/kia3/KIA3def.json -x /var/www/dho/assets/reports/kia3/pws3.xlsx";
    	//exec($pyth);
    	echo shell_exec($copy);
        echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia3/pws3.xlsx");
    	   $name = "pws3_Februari.xlsx";
    	   force_download($name, $data);
    }
   

}