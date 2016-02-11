<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kia4 extends CI_Controller {

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
		$this->load->view('kia4');
		$this->load->view('footer');
	}

	public function January() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia4/pws4_1.xlsx /var/www/dho/assets/reports/kia4/pws4.xlsx";
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia4/jan.json -j /var/www/dho/assets/reports/kia4/KIA4def.json -x /var/www/dho/assets/reports/kia4/pws4.xlsx";
    	//exec($pyth);
    	echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia4/pws4.xlsx");
    	   $name = "pws4_Januari.xlsx";
    	   force_download($name, $data);
    }

    public function February() {
   		$this->load->helper('download');
    	$copy = "cp /var/www/dho/assets/reports/kia4/pws4_1.xlsx /var/www/dho/assets/reports/kia4/pws4.xlsx";
        
    	$pyth = "/usr/bin/python /var/www/dho/assets/reports/reporting1.py -c /var/www/dho/assets/reports/kia4/feb.json -j /var/www/dho/assets/reports/kia4/KIA4def.json -x /var/www/dho/assets/reports/kia4/pws4.xlsx";
    	//exec($pyth);
    	echo shell_exec($copy);
        echo shell_exec($pyth);

			$data = file_get_contents("/var/www/dho/assets/reports/kia4/pws4.xlsx");
    	   $name = "pws4_Februari.xlsx";
    	   force_download($name, $data);
    }
   

}