<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StatusGizi extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusGizi");
        $this->load->view("footer");
    }
    
    public function index(){
        
    }
}