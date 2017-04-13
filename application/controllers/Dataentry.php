<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataEntry extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            $this->session->set_flashdata('url', $this->uri->uri_string);
            redirect('login');
        }
        $this->load->model('LocationModel','loc');
        $this->load->model('AnalyticsFhwEcModel','AnalyticsFhwModel');
        $this->load->model('AnalyticsEcModel','AnalyticsModel');
        $this->load->model('GiziEcModel','GiziModel');
        $this->load->model('GiziFhwEcModel','GiziFhwModel');
        $this->load->model('VaksinatorFhwEcModel','VaksinatorFhwModel');
        $this->load->model('VaksinatorEcModel','VaksinatorModel');
        $this->load->model('OnTimeSubmissionModel','OnTimeSubmissionModel');
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
            $data['kecamatan']		= $this->uri->segment(3);
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
            //if($by=="subdate") 
                $data['data'] = $this->AnalyticsModel->getCountPerForm($data['kecamatan'],$data['start'],$data['end']);
            //else $data['data'] = $this->AnalyticsModel->getCountPerFormByVisitDate($data['kecamatan'],$data['start'],$data['end']);
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
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
            $data['kecamatan']		= $this->uri->segment(3);
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
            //if($by=="subdate") 
                $data['data'] = $this->AnalyticsModel->getCountPerDayDrill($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
            //else $data['data'] = $this->AnalyticsModel->getCountPerDayByVisitDate($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
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
            $data = $this->AnalyticsModel->getCountPerFormByVisitDateForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    
    public function getbidanByForm($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->AnalyticsFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->AnalyticsModel->getCountPerFormForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    public function getfhwbidanByForm($desa,$date){
        
        $data = $this->AnalyticsFhwModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function bidanOnTimeSubmission(){
        if($this->session->userdata('level')=="fhw"){
            $data['desa']		= $this->session->userdata('location');
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/bidanontimesubmission?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->OnTimeSubmissionModel->getOnTimeFormDesa($data['desa'],array($data['start'],$data['end']),'bidan');
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanontimesubmission",$data);
            $this->load->view("footer");
        }else{
            $data['mode']		= $this->uri->segment(3);
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/bidanontimesubmission/".$data['mode']."?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data'] = $this->OnTimeSubmissionModel->getOnTimeSubmission($data['mode'],array($data['start'],$data['end']),'bidan');
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            $this->load->view("dataentry/bidanontimesubmission",$data);
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function gizi(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/gizi",$data);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function giziByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['data']                   = $this->GiziFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/gizientryform",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            if($this->input->get('start')==null&&$data['desa']==""){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                redirect("dataentry/gizibyform/".$data['kecamatan']."?start=2016-06-01&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['datemode'] = $by;
            //if($by=="subdate") 
                $data['data'] = $this->GiziModel->getCountPerForm($data['kecamatan'],$data['start'],$data['end']);
            //else $data['data'] = $this->GiziModel->getCountPerFormByVisitDate($data['kecamatan'],$data['start'],$data['end']);
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('gizi',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('gizi');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/gizientryform",$data);
                
            }else{
                $data['data']           = $this->GiziFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/gizientryform",$data);
            }
            $this->load->view("footer");
            
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function giziByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['mode']                   = $this->uri->segment(4);
            if($this->input->get('start')==null&&$data['mode']==''){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/gizibytanggal/?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->GiziFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
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
            if($this->input->get('start')==null&&$data['desa']==""&&$data['mode']==''){
                if($this->input->get('by')==null)$by = "subdate";else $by = $this->input->get('by');
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/gizibytanggal/".$data['kecamatan']."?start=$start&end=$now&by=$by");
            }else{
                $by = $this->input->get('by');
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['datemode'] = $by;
            //if($by=="subdate") 
                $data['data'] = $this->GiziModel->getCountPerDay($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
            //else $data['data'] = $this->GiziModel->getCountPerDayByVisitDate($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('gizi',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('gizi');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/gizientrytanggal",$data);
                
            }else{
                if($this->input->get('start')==null&&$data['mode']==''){
                    $now = date("Y-m-d");
                    $start = date("Y-m-d",  strtotime($now."-29 days"));
                    redirect("dataentry/gizibytanggal/".$data['kecamatan']."/".$data['desa']."?start=$start&end=$now");
                }else{
                    $data['start'] = $this->input->get('start');
                    $data['end'] = $this->input->get('end');
                }
                $data['data']           = $this->GiziFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/fhw/gizientrytanggal",$data);
            }
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function giziOnTimeSubmission(){
        if($this->session->userdata('level')=="fhw"){
            $data['desa']		= $this->session->userdata('location');
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/giziontimesubmission?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->OnTimeSubmissionModel->getOnTimeFormDesa($data['desa'],array($data['start'],$data['end']),'gizi');
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/giziontimesubmission",$data);
            $this->load->view("footer");
        }else{
            $data['mode']		= $this->uri->segment(3);
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/giziontimesubmission/".$data['mode']."?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data'] = $this->OnTimeSubmissionModel->getOnTimeSubmission($data['mode'],array($data['start'],$data['end']),'gizi');
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('gizi',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('gizi');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            $this->load->view("dataentry/giziontimesubmission",$data);
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function getGiziByForm($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->GiziFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->GiziModel->getCountPerFormForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    
    public function getGiziByFormByVisitDate($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->GiziFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->GiziModel->getCountPerFormByVisitDateForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    
    public function getFhwGiziByForm($desa,$date){
        $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        $data = $this->GiziFhwModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
    
    public function vaksinator(){
        $data['kecamatan']		= $this->uri->segment(3);
        $this->load->view("header");
        $this->load->view("dataentry/dataentrysidebar");
        $this->load->view("dataentry/jurim",$data);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function vaksinatorByForm(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['data']                   = $this->VaksinatorFhwModel->getCountPerForm();
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/bidanentryform",$data);
            $this->load->view("footer");
        }else{
            $data['kecamatan']		= $this->uri->segment(3);
            $data['desa']		= str_replace('%20', ' ', $this->uri->segment(4));
            if($this->input->get('start')==null&&$data['desa']==""){
                $now = date("Y-m-d");
                redirect("dataentry/vaksinatorbyform/".$data['kecamatan']."?start=2016-06-01&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']               = $this->VaksinatorModel->getCountPerForm($data['kecamatan'],$data['start'],$data['end']);
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('vaksinator',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('vaksinator');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/vaksinatorentryform",$data);
                
            }else{
                $data['data']           = $this->VaksinatorFhwModel->getCountPerForm($data['desa']);
                $this->load->view("dataentry/fhw/vaksinatorentryform",$data);
            }
            $this->load->view("footer");
            
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
        
    }
    
    public function vaksinatorByTanggal(){
        if($this->session->userdata('level')=="fhw"){
            $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
            $data['desa']		= $this->session->userdata('location');
            $data['mode']                   = $this->uri->segment(4);
            if($this->input->get('start')==null&&$data['mode']==''){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/vaksinatorbytanggal/?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->VaksinatorFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
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
            if($this->input->get('start')==null&&$data['desa']==""&&$data['mode']==''){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/vaksinatorbytanggal/".$data['kecamatan']."?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->VaksinatorModel->getCountPerDay($data['kecamatan'],$data['mode'],array($data['start'],$data['end']));
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('vaksinator',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('vaksinator');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            if($data['desa']==""){
                $this->load->view("dataentry/vaksinatorentrytanggal",$data);
                
            }else{
                if($this->input->get('start')==null&&$data['mode']==''){
                    $now = date("Y-m-d");
                    $start = date("Y-m-d",  strtotime($now."-29 days"));
                    redirect("dataentry/vaksinatorbytanggal/".$data['kecamatan']."/".$data['desa']."?start=$start&end=$now");
                }else{
                    $data['start'] = $this->input->get('start');
                    $data['end'] = $this->input->get('end');
                }
                $data['data']           = $this->VaksinatorFhwModel->getCountPerDay($data['desa'],$data['mode'],array($data['start'],$data['end']));
                $this->load->view("dataentry/fhw/vaksinatorentrytanggal",$data);
            }
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function vaksinOnTimeSubmission(){
        if($this->session->userdata('level')=="fhw"){
            $data['desa']		= $this->session->userdata('location');
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/vaksinontimesubmission?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data']                   = $this->OnTimeSubmissionModel->getOnTimeFormDesa($data['desa'],array($data['start'],$data['end']),'vaksinator');
            $this->load->view("header");
            $this->load->view("dataentry/fhw/dataentrysidebar");
            $this->load->view("dataentry/fhw/vaksinontimesubmission",$data);
            $this->load->view("footer");
        }else{
            $data['mode']		= $this->uri->segment(3);
            if($this->input->get('start')==null){
                $now = date("Y-m-d");
                $start = date("Y-m-d",  strtotime($now."-29 days"));
                redirect("dataentry/vaksinontimesubmission/".$data['mode']."?start=$start&end=$now");
            }else{
                $data['start'] = $this->input->get('start');
                $data['end'] = $this->input->get('end');
            }
            $data['data'] = $this->OnTimeSubmissionModel->getOnTimeSubmission($data['mode'],array($data['start'],$data['end']),'vaksinator');
            $this->load->view("header");
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('vaksinator',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('vaksinator');
            }
            $this->load->view("dataentry/dataentrysidebar",$data);
            $this->load->view("dataentry/vaksinontimesubmission",$data);
            $this->load->view("footer");
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function getVaksinatorByForm($desa,$date){
        if($this->session->userdata('level')=="fhw"){
            $data = $this->VaksinatorFhwModel->getCountPerFormForDrill($desa,$date);
        }else{
            $data = $this->VaksinatorModel->getCountPerFormForDrill($desa,$date);
        }
        
        echo json_encode($data);
    }
    
    public function getFhwVaksinatorByForm($desa,$date){
        $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
        $data = $this->VaksinatorFhwModel->getCountPerFormForDrill($desa,$date);
        echo json_encode($data);
    }
}