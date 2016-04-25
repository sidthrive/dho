<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('laporan/laporansidebar');
        $this->load->view('laporan/laporanmainpage');
        $this->load->view('footer');
    }
    
    public function cakupanStandar(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/standar");
        $this->load->view("footer");
    }
    
    public function cakupanIndikatorPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws");
        $this->load->view("footer");
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSBidan");
        $this->load->view("footer");
    }
    
    public function statusGizi(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusGizi");
        $this->load->view("footer");
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSGizi");
        $this->load->view("footer");
    }
    
    public function downloadJurimPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSJurim");
        $this->load->view("footer");
    }
        
}