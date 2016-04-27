<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckFile extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->model('PHPExcelModel');
        //$this->load->view('header');
        $this->PHPExcelModel->showEntireData('/download/kunjungan_nifas.xls');
        //$this->load->view('footer');
    
    }
}

