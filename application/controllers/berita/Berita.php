<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view('header');
        $this->load->view('sidebar_lounge');
        $this->load->view('berita/newsview');
        $this->load->view('footer');
    }
    
    public function index(){
        
    }
}