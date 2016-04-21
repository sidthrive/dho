<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CakupanStandar extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/standar");
        $this->load->view("footer");
    }
    
    public function index(){
        
    }
}