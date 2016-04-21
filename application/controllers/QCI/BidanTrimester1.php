<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BidanTrimester1 extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/qcipage");
        $this->load->view("footer");
    }
    
    public function index(){
        
    }
}