<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BidanTanggalSengkol extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/bidanentrytanggalsengkol");
        $this->load->view("footer");
    }
    
    public function index(){
        
    }
}