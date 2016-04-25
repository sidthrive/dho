<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class QCI extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('QCI/qcisidebar');
        $this->load->view('QCI/qcipage');
        $this->load->view('footer');
    }
    public function bidanTrimester1(){
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/qcipage");
        $this->load->view("footer");
    }
    public function bidanTrimester2(){
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/qcipage");
        $this->load->view("footer");
    }
    public function bidanTrimester3(){
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/qcipage");
        $this->load->view("footer");
    }
}