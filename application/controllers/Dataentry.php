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
        $this->load->model('GiziModel');
        $this->load->model('GiziFhwModel');
        $this->load->model('VaksinatorFhwModel');
        $this->load->model('VaksinatorModel');
    }
    
    public function index(){
        if($this->session->userdata('level')=="fhw"){
            $this->load->view('header');
            $this->load->view('dataentry/fhw/dataentrysidebar');
            $this->load->view('dataentry/dataentrymainpage');
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
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
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
    
    public function bidanByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['mode']                   = $this->uri->segment(4);
            $data['data']                   = $this->AnalyticsFhwModel->getCountPerDay($data['desa'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['mode']                   = $this->uri->segment(4);
            if($data['mode']!="Bulanan"&&$data['mode']!="Mingguan"){
                $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
                $data['mode']                   = $this->uri->segment(5);
            }else{
                $data['desa']		= "";
            }
            $data['data']                   = $this->AnalyticsModel->getCountPerDayDrill($data['kecamatan'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/bidanentrytanggal",$data);
                
            }else{
                $data['data']           = $this->AnalyticsFhwModel->getCountPerDay($data['desa'],$data['mode']);
                $this->load->view("dataentry/fhw/bidanentrytanggal",$data);
            }
            $this->load->view("footer");
        }
    }
    
    public function getbidanByForm($desa,$date){
        $data = $this->AnalyticsModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function gizi(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/gizi",$data);
        $this->load->view("footer");
    }
    
    public function giziByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['data']                   = $this->GiziFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/gizientryform",$data);
            $this->load->view("footer");
        }else{
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            $data['kecamatan']		= $this->uri->segment(3);
            $data['data']               = $this->GiziModel->getCountPerForm($data['kecamatan']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/gizientryform",$data);
                
            }else{
                $data['data']           = $this->GiziFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/gizientryform",$data);
            }
            $this->load->view("footer");
            
        }
        
    }
    
    public function giziByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['mode']                   = $this->uri->segment(4);
            $data['data']                   = $this->GiziFhwModel->getCountPerDay($data['desa'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/gizientrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['mode']                   = $this->uri->segment(4);
            if($data['mode']!="Bulanan"&&$data['mode']!="Mingguan"){
                $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
                $data['mode']                   = $this->uri->segment(5);
            }else{
                $data['desa']		= "";
            }
            $data['data']                   = $this->GiziModel->getCountPerDay($data['kecamatan'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/gizientrytanggal",$data);
                
            }else{
                $data['data']           = $this->GiziFhwModel->getCountPerDay($data['desa'],$data['mode']);
                $this->load->view("dataentry/fhw/gizientrytanggal",$data);
            }
            $this->load->view("footer");
        }
    }
    
    public function getGiziByForm($desa,$date){
        $data = $this->GiziModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function vaksinator(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/jurim",$data);
        $this->load->view("footer");
    }
    
    public function vaksinatorByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['data']                   = $this->VaksinatorFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentryform",$data);
            $this->load->view("footer");
        }else{
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            $data['kecamatan']		= $this->uri->segment(3);
            $data['data']               = $this->VaksinatorModel->getCountPerForm($data['kecamatan']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/bidanentryform",$data);
                
            }else{
                $data['data']           = $this->VaksinatorFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/bidanentryform",$data);
            }
            $this->load->view("footer");
            
        }
        
    }
    
    public function vaksinatorByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
            $data['desa']		= $listdesa[$this->session->userdata('username')];
            $data['mode']                   = $this->uri->segment(4);
            $data['data']                   = $this->VaksinatorFhwModel->getCountPerDay($data['desa'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/vaksinatorentrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['mode']                   = $this->uri->segment(4);
            if($data['mode']!="Bulanan"&&$data['mode']!="Mingguan"){
                $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
                $data['mode']                   = $this->uri->segment(5);
            }else{
                $data['desa']		= "";
            }
            $data['data']                   = $this->VaksinatorModel->getCountPerDay($data['kecamatan'],$data['mode']);
            $this->load->view("header");
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/vaksinatorentrytanggal",$data);
                
            }else{
                $data['data']           = $this->VaksinatorFhwModel->getCountPerDay($data['desa'],$data['mode']);
                $this->load->view("dataentry/fhw/vaksinatorentrytanggal",$data);
            }
            $this->load->view("footer");
        }
    }
    
    public function getVaksinatorByForm($desa,$date){
        $data = $this->VaksinatorModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
}