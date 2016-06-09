<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataEntry extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
        $this->load->model('AnalyticsFhwModel');
        $this->load->model('AnalyticsModel');
    }
    
    public function index(){
        if($this->session->userdata('level')=="fhw"){
            $this->load->view('header');
            $this->load->view('dataentry/fhw/dataentrysidebar');
            $this->load->view('dataentry/fhw/dataentrymainpage');
            $this->load->view('footer');
        }else{
            $this->load->view('header');
            $this->load->view('dataentry/dataentrysidebar');
            $this->load->view('dataentry/dataentrymainpage');
            $this->load->view('footer');
        }
    }
    
    public function bidanByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['data']                   = $this->AnalyticsFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentryform",$data);
            $this->load->view("footer");
        }else{
            $data['desa']		= $this->uri->segment(4);
            $data['kecamatan']		= $this->uri->segment(3);
            $data['data']               = $this->AnalyticsModel->getCountPerForm($data['kecamatan']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/bidanentryform",$data);
                
            }else{
                $data['data']           = $this->AnalyticsFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/bidanentryform",$data);
            }
            $this->load->view("footer");
            
        }
        
    }
    
    public function location(){
        $json = file_get_contents(base_url()."assets/location.json");
        $obj = json_decode($json);
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
    
    public function bidanByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['mode']                   = $this->uri->segment(4);
            $data['data']                   = $this->AnalyticsModel->getCountPerDay($data['desa'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['mode']                   = $this->uri->segment(4);
            $data['data']                   = $this->AnalyticsModel->getCountPerDay($data['kecamatan'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar");
            $this->load->view("dataentry/bidanentrytanggal",$data);
            $this->load->view("footer");
        }
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