<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StandarisasiBidan extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view('header');
        $this->load->view('standarisasi/standarisasisidebar');
        $this->load->view('standarisasi/standarisasibidan');
        $this->load->view('footer');
    }
    
    public function index(){
        
    }
}