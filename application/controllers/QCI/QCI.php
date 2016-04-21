<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class QCI extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view('header');
        $this->load->view('QCI/qcisidebar');
        //$this->load->view('QCI/qcipage');
        $this->load->view('QCI/qcipage');
        $this->load->view('footer');
        
    }
    
    public function index(){
        
        
        
    }
}