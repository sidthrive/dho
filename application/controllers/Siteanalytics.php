<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteanalytics extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            $this->session->set_flashdata('url', $this->uri->uri_string);
            redirect('login');
        }
    }
    
    public function index(){
        if($this->session->userdata('level') != 'super'&&$this->session->userdata('username') != 'admindemo'){
            redirect('siteanalytics/error');
        }
        $data = array();
//        $data["date"] = date("Y-m-d");
//        $data["tipe"] = 'bidan';
//        $data["user"] = 'fhw';
//        $data["level"] = 'fhw';
        $data['data'] = $this->SiteAnalyticsModel->getPageViewsForGraph($data);
        $this->load->view('header');
        $this->load->view('siteanalytics/sidebar');
        $this->load->view('siteanalytics/viewbydate',$data);
        $this->load->view('footer');
    }
    
    public function getdatabyview($user,$date){
        $data = $this->SiteAnalyticsModel->getPageViewsForDrill($user,$date);
        echo json_encode($data);
    }
    
    public function error(){
        $this->load->view('header');
        $this->load->view('errors/sidebar_error');
        $this->load->view('errors/error_privilege');
        $this->load->view('footer');
    }
}