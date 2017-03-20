<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            $this->session->set_flashdata('url', $this->uri->uri_string);
            redirect('login');
        }
        $this->load->model('LocationModel','loc');
        $this->load->model('EcCakupanModel','ec');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('laporan/laporansidebar');
        $this->load->view('laporan/laporanmainpage');
        $this->load->view('footer');
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function cakupanIndikatorPWS(){
        if($this->input->get('b')==null){
            $bulan_map = [1=>'januari',2=>'februari',3=>'maret',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'agustus',9=>'september',10=>'oktober',11=>'november',12=>'desember'];
            $b = date("n");
            $t = date("Y");
            redirect("laporan/cakupanindikatorpws?b=$bulan_map[$b]&t=$t");
        }else{
            $dataXLS['bulan'] = $this->input->get('b');
            $dataXLS['tahun'] = $this->input->get('t');
        }
        
        if($this->session->userdata('level')=="fhw"){
            $this->load->model('BidanEcFhwCakupanModel');
            $dataXLS['xlsForm']=$this->BidanEcFhwCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        }else{
            $this->load->model('BidanEcCakupanModel');
            $dataXLS['xlsForm']=$this->BidanEcCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        }
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        if($this->session->userdata('level')=="fhw"){
            $this->load->view("laporan/fhw/downloadpwsbidan");
        }else{
            if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
                $data['location'] = $this->loc->getAllLocSpv('bidan',$this->session->userdata('location'));
            }else{
                $data['location'] = $this->loc->getAllLoc('bidan');
            }
            $this->load->view("laporan/downloadpwsbidan",$data);
        }
        
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function cakupanGizi(){
        $this->load->model('GiziEcCakupanModel');
        if($this->input->get('b')==null){
            $bulan_map = [1=>'januari',2=>'februari',3=>'maret',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'agustus',9=>'september',10=>'oktober',11=>'november',12=>'desember'];
            $b = date("n");
            $t = date("Y");
            redirect("laporan/cakupangizi?b=$bulan_map[$b]&t=$t");
        }else{
            $dataXLS['bulan'] = $this->input->get('b');
            $dataXLS['tahun'] = $this->input->get('t');
        }
        $dataXLS['xlsForm']=$this->GiziEcCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusgizi",$dataXLS, false);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsgizi");
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadpwsgizi(){
        $kecamatan   = $this->input->post('kecamatan');
        $year   = $this->input->post('year');
        $month  = $this->input->post('month');
        $this->load->model('GiziPwsModel');
        $this->GiziPwsModel->pwsBulanIni($month,$year,$kecamatan);
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function cakupanpwsvaksinator(){
        $this->load->model('VaksinatorEcCakupanModel');
        $xlsForm = [];
        $mode = $this->uri->segment(3);
        $header = "";
        if($mode=="bulanini"){
            $header = "Bulan Ini";
            $xlsForm = $this->VaksinatorEcCakupanModel->cakupanBulanIni();
        }elseif($mode=="akumulatifbulanini"){
            $header = "Akumulasi Sampai Bulan Ini";
            $xlsForm = $this->VaksinatorEcCakupanModel->akumulasiBulanIni();
        }elseif($mode=="bulaninivsbulanlalu"){
            $header = "Bulan Ini vs Bulan Lalu";
            $xlsForm = $this->VaksinatorEcCakupanModel->bulanIniVsBulanLalu();
        }elseif($mode=="tahuninivstahunlalu"){
            $header = "Tahun Ini vs Tahun Lalu";
            $bulan = $this->uri->segment(4);
            $xlsForm = $this->VaksinatorEcCakupanModel->tahunIniVsTahunLalu($bulan);
        }
        $dataXLS['xlsForm']=$xlsForm;
        $dataXLS['header']=$header;
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/cakupanpwsvaksinator",$dataXLS, false);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadvaksinatorPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsjurim");
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadpwsvaksinator(){
        $kecamatan   = $this->input->post('kecamatan');
        $year   = $this->input->post('year');
        $month  = $this->input->post('month');
        $form  = $this->input->post('form');
        $this->load->model('VaksinatorPwsModel');
        $this->VaksinatorPwsModel->pwsBulanIni($month,$year,$kecamatan,$form);
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function download(){
        if($this->session->userdata('level')=="fhw"){
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');
            $this->download_fhw($year,$month,$form);
        }else{
            $this->load->model('PHPExcelModel');
            $this->load->model('BidanEcPwsModel');

            $kec    = $this->input->post('kecamatan');
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');

            if($form=="KIA"){
                $this->BidanEcPwsModel->kia($kec,$year,$month,$form);
            }elseif(strpos($form,'bayi')!==false){
                $this->BidanEcPwsModel->bayi($kec, $year, $month, $form);
            }elseif(strpos($form,'balita')!==false){
                $this->BidanEcPwsModel->balita($kec, $year, $month, $form);
            }elseif($form=="neonatal1"){
                $this->BidanEcPwsModel->neonatal1($kec,$year,$month,$form);
            }elseif($form=="neonatal2"){
                $this->BidanEcPwsModel->neonatal2($kec,$year,$month,$form);
            }elseif($form=="neonatal3"){
                $this->BidanEcPwsModel->neonatal3($kec,$year,$month,$form);
            }elseif($form=="neonatal4"){
                $this->BidanEcPwsModel->neonatal4($kec,$year,$month,$form);
            }elseif($form=="neonatal5"){
                $this->BidanEcPwsModel->neonatal5($kec,$year,$month,$form);
            }elseif($form=="kb1"){
                $this->BidanEcPwsModel->kb1($kec,$year,$month,$form);
            }elseif($form=="kb2"){
                $this->BidanEcPwsModel->kb2($kec,$year,$month,$form);
            }elseif($form=="kb3"){
                $this->BidanEcPwsModel->kb3($kec,$year,$month,$form);
            }elseif($form=="kb4"){
                $this->BidanEcPwsModel->kb4($kec,$year,$month,$form);
            }elseif($form=="kb5"){
                $this->BidanEcPwsModel->kb5($kec,$year,$month,$form);
            }elseif($form=="amp"){
                $this->BidanEcPwsModel->maternal($kec,$year,$month,$form);
            }elseif($form=="akb"){
                $this->BidanEcPwsModel->akb($kec,$year,$month,$form);
            }elseif($form=="kih"){
                $this->BidanEcPwsModel->kih($kec,$year,$month,$form);
            }elseif($form=="p4k"){
                $this->BidanEcPwsModel->p4k($kec,$year,$month,$form);
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    private function download_fhw($year,$month,$form){
        $user = $this->session->userdata('username');
        $this->load->model('PHPExcelModel');
        $this->load->model('PWSEcFhwModel');
        if($form=="KIA"){
            $this->PWSEcFhwModel->kia($user,$year,$month,$form);
        }elseif(strpos($form,'bayi')!==false){
            $this->PWSEcFhwModel->bayi($user, $year, $month, $form);
        }elseif(strpos($form,'balita')!==false){
            $this->PWSEcFhwModel->balita($user, $year, $month, $form);
        }elseif(strpos($form,'anak')!==false){
            $this->PWSEcFhwModel->anak($user, $year, $month, $form);
        }elseif($form=="neonatal1"){
            $this->PWSEcFhwModel->neonatal1($user,$year,$month,$form);
        }elseif($form=="neonatal2"){
            $this->PWSEcFhwModel->neonatal2($user,$year,$month,$form);
        }elseif($form=="neonatal3"){
            $this->PWSEcFhwModel->neonatal3($user,$year,$month,$form);
        }elseif($form=="neonatal4"){
            $this->PWSEcFhwModel->neonatal4($user,$year,$month,$form);
        }elseif($form=="neonatal5"){
            $this->PWSEcFhwModel->neonatal5($user,$year,$month,$form);
        }elseif($form=="kb1"){
            $this->PWSEcFhwModel->kb1($user,$year,$month,$form);
        }elseif($form=="kb2"){
            $this->PWSEcFhwModel->kb2($user,$year,$month,$form);
        }elseif($form=="kb3"){
            $this->PWSEcFhwModel->kb3($user,$year,$month,$form);
        }elseif($form=="kb4"){
            $this->PWSEcFhwModel->kb4($user,$year,$month,$form);
        }elseif($form=="kb5"){
            $this->PWSEcFhwModel->kb5($user,$year,$month,$form);
        }elseif($form=="amp"){
            $this->PWSEcFhwModel->maternal($user,$year,$month,$form);
        }elseif($form=="akb"){
            $this->PWSEcFhwModel->akb($user,$year,$month,$form);
        }elseif($form=="kih"){
            $this->PWSEcFhwModel->kih($user,$year,$month,$form);
        }elseif($form=="p4k"){
            $this->PWSEcFhwModel->p4k($user,$year,$month,$form);
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
}