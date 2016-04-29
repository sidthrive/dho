<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckFile extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->model('PHPExcelModel');
        //$this->load->view('header');
        $this->PHPExcelModel->showEntireData('download/tekanan_darah_tri1.xls');
        //$this->load->view('footer');
    
    }
}

