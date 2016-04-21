<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Standarisasi extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view('header');
        $this->load->view('standarisasi/standarisasisidebar');
        $this->load->view('standarisasi/standarisasimainpage');
        $this->load->view('footer');
    }
    
    public function index(){
        
    }
}