<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataEntry extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->view('header');
        $this->load->view('dataEntry/dataentrysidebar');
        $this->load->view('dataEntry/dataentrymainpage');
        $this->load->view('footer');
    }
    
    public function index(){
        
    }
}