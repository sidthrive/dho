<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataEntry extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            $this->session->set_flashdata('url', $this->uri->uri_string);
            redirect('login');
        }
        $this->load->model('AnalyticsFhwEcModel','AnalyticsFhwModel');
        $this->load->model('LocationModel','loc');
        $this->load->model('AnalyticsEcModel','AnalyticsModel');
        $this->load->model('SdidtkModel','SdidtkModel');
        $this->load->model('SdidtkFhwModel','SdidtkFhwModel');
        $this->load->model('DataentryModel');
    }
    
    public function index(){
        if($this->session->userdata('level')=="fhw"){
            $this->load->view('header');
            $this->load->view('dataentry/fhw/dataentrysidebar');
            $this->load->view('dataentry/dataentrymainpage');
            $this->load->view('footer');
        }else{
            $this->load->view('header');
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view('dataentry/dataentrysidebar',$data);
            $this->load->view('dataentry/dataentrymainpage');
            $this->load->view('footer');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function bidanByForm(){
        if($this->session->userdata('level')=="fhw"){
            
            $data['desa']		= $this->session->userdata('location');
            $data['data']                   = $this->AnalyticsFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentryform",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= str_replace('%20',' ',$this->uri->segment(3));
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            if($this->input->get('start')==null&&$data['desa']==""){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                redirect("dataentry/bidanbyform/".$data['kecamatan']."?start=2016-01-01&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
                $old_data = $this->input->get('old');
            }$data['datemode'] = $by;
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $data['data'] = $this->DataentryModel->getCountPerForm($data['kecamatan'],$data['start'],$data['end']);
                $this->load->view("dataentry/bidanentryform",$data);
                
            }else{
                $data['data']           = $this->AnalyticsFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/bidanentryform",$data);
            }
            $this->load->view("footer");
            
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadbidanByForm(){
        if($this->session->userdata('level')=="fhw"){
            
            $data['desa']		= $this->session->userdata('location');
            $data['data']                   = $this->AnalyticsFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentryform",$data);
            $this->load->view("footer");
        }else{
            $data['start'] = $this->input->post('start');
            $data['end'] = $this->input->post('end');
            $old_data = $this->input->post('old');
            $by = $this->input->post('by');
            $data['kecamatan']		= $this->uri->segment(3);
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            if($by=="subdate") $data['data'] = $this->AnalyticsModel->downloadCountPerForm($data['kecamatan'],$data['start'],$data['end'],$old_data);
            else $data['data'] = $this->AnalyticsModel->downloadCountPerFormByVisitDate($data['kecamatan'],$data['start'],$data['end'],$old_data);
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function bidanByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            
            $data['desa']		= $this->session->userdata('location');
            $data['mode']                   = $this->uri->segment(4);
            if($this->input->get('start')==null&&$data['mode']==''){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/bidanbytanggal/?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->AnalyticsFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= str_replace('%20',' ',$this->uri->segment(3));
            $data['mode']                   = $this->uri->segment(4);
            if($data['mode']!="Bulanan"&&$data['mode']!="Mingguan"){
                $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
                $data['mode']                   = $this->uri->segment(5);
            }else{
                $data['desa']		= "";
            }
            if($this->input->get('start')==null&&$data['desa']==""&&$data['mode']==''){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/bidanbytanggal/".$data['kecamatan']."?start=$start&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['datemode'] = $by;
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $data['data'] = $this->DataentryModel->getCountPerDayDrill($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/bidanentrytanggal",$data);
                
            }else{
                if($this->input->get('start')==null&&$data['mode']==''){
                    $now = date("Y-m-d");
                    $start = date("Y-m-d",  strtotime($now."-29 days"));
                    redirect("dataentry/bidanbytanggal/".$data['kecamatan']."/".$data['desa']."?start=$start&end=$now");
                }else{
                    $data['start'] = $this->input->get('start');
                    $data['end'] = $this->input->get('end');
                }
                $data['data']           = $this->AnalyticsFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/fhw/bidanentrytanggal",$data);
            }
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function getbidanByFormByVisitDate($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->AnalyticsFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->DataentryModel->getCountPerFormByVisitDateForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    
    public function getbidanByForm($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->AnalyticsFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->DataentryModel->getCountPerFormForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    public function getfhwbidanByForm($desa,$date){
        
        $data = $this->AnalyticsFhwModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function sdidtk(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/sdidtk",$data);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function sdidtkByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['sdidtk1'=>'Lekor','sdidtk2'=>'Saba','sdidtk3'=>'Pendem','sdidtk4'=>'Setuta','sdidtk5'=>'Jango','sdidtk6'=>'Janapria','sdidtk8'=>'Ketara','sdidtk9'=>'Sengkol','sdidtk10'=>'Sengkol','sdidtk11'=>'Kawo','sdidtk12'=>'Tanak Awu','sdidtk13'=>'Pengembur','sdidtk14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['data']                   = $this->SdidtkFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/sdidtkentryform",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= str_replace('%20',' ',$this->uri->segment(3));
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            if($this->input->get('start')==null&&$data['desa']==""){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                redirect("dataentry/sdidtkbyform/".$data['kecamatan']."?start=2016-06-01&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['datemode'] = $by;
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $data['data'] = $this->SdidtkModel->getCountPerForm($data['kecamatan'],$data['start'],$data['end']);
                $this->load->view("dataentry/sdidtkentryform",$data);
                
            }else{
                $data['data']           = $this->SdidtkFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/sdidtkentryform",$data);
            }
            $this->load->view("footer");
            
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function sdidtkByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['sdidtk1'=>'Lekor','sdidtk2'=>'Saba','sdidtk3'=>'Pendem','sdidtk4'=>'Setuta','sdidtk5'=>'Jango','sdidtk6'=>'Janapria','sdidtk8'=>'Ketara','sdidtk9'=>'Sengkol','sdidtk10'=>'Sengkol','sdidtk11'=>'Kawo','sdidtk12'=>'Tanak Awu','sdidtk13'=>'Pengembur','sdidtk14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['mode']                   = $this->uri->segment(4);
            if($this->input->get('start')==null&&$data['mode']==''){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/sdidtkbytanggal/?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->SdidtkFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/sdidtkentrytanggal",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= str_replace('%20',' ',$this->uri->segment(3));
            $data['mode']                   = $this->uri->segment(4);
            if($data['mode']!="Bulanan"&&$data['mode']!="Mingguan"){
                $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
                $data['mode']                   = $this->uri->segment(5);
            }else{
                $data['desa']		= "";
            }
            if($this->input->get('start')==null&&$data['desa']==""&&$data['mode']==''){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/sdidtkbytanggal/".$data['kecamatan']."?start=$start&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['datemode'] = $by;
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $data['data'] = $this->SdidtkModel->getCountPerDayDrill($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/sdidtkentrytanggal",$data);
                
            }else{
                if($this->input->get('start')==null&&$data['mode']==''){
                    $now = date("Y-m-d");
                    $start = date("Y-m-d",  strtotime($now."-29 days"));
                    redirect("dataentry/sdidtkbytanggal/".$data['kecamatan']."/".$data['desa']."?start=$start&end=$now");
                }else{
                    $data['start'] = $this->input->get('start');
                    $data['end'] = $this->input->get('end');
                }
                $data['data']           = $this->SdidtkFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/fhw/sdidtkentrytanggal",$data);
            }
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function getSdidtkByForm($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->SdidtkFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->SdidtkModel->getCountPerFormForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    public function getfhwSdidtkByForm($desa,$date){
        
        $data = $this->SdidtkFhwModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function getSdidtkByFormByVisitDate($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->SdidtkFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->SdidtkModel->getCountPerFormByVisitDateForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
}