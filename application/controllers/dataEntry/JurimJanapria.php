<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JurimJanapria extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/jurimjanapria");
        $this->load->view("footer");
    }
    
    public function index(){
        
    }
}