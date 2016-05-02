<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataEntry extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
        $this->load->model('AnalyticsModel');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('dataEntry/dataentrysidebar');
        $this->load->view('dataEntry/dataentrymainpage');
        $this->load->view('footer');
    }
    
    public function bidanByForm(){
        $data['kecamatan']		= $this->uri->segment(3);
        $data['data']                   = $this->AnalyticsModel->getCountPerForm($data['kecamatan']);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/bidanentryform",$data);
        $this->load->view("footer");
    }
    
    public function bidanByTanggal(){
        $data['kecamatan']		= $this->uri->segment(3);
        $data['mode']                   = $this->uri->segment(4);
        $data['data']                   = $this->AnalyticsModel->getCountPerDay($data['kecamatan'],$data['mode']);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/bidanentrytanggal",$data);
        $this->load->view("footer");
        
    }
    
    public function gizi(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/gizi",$data);
        $this->load->view("footer");
    }
    
    public function jurim(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/jurim",$data);
        $this->load->view("footer");
    }
}