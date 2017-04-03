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
        $this->load->model('CakupanModel','ec');
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
            $this->load->model('BidanFhwCakupanModel');
            $dataXLS['xlsForm']=$this->BidanFhwCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        }else{
            $this->load->model('BidanCakupanModel');
            $dataXLS['xlsForm']=$this->BidanCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
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
            $this->load->view("laporan/downloadpwsbidan");
        }
        
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function cakupanGizi(){
        $this->load->model('GiziCakupanModel');
        if($this->input->get('b')==null){
            $bulan_map = [1=>'januari',2=>'februari',3=>'maret',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'agustus',9=>'september',10=>'oktober',11=>'november',12=>'desember'];
            $b = date("n");
            $t = date("Y");
            redirect("laporan/cakupangizi?b=$bulan_map[$b]&t=$t");
        }else{
            $dataXLS['bulan'] = $this->input->get('b');
            $dataXLS['tahun'] = $this->input->get('t');
        }
        $dataXLS['xlsForm']=$this->GiziCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
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
        $this->load->model('VaksinatorCakupanModel');
        $xlsForm = [];
        $mode = $this->uri->segment(3);
        $header = "";
        if($mode=="bulanini"){
            $header = "Bulan Ini";
            $xlsForm = $this->VaksinatorCakupanModel->cakupanBulanIni();
        }elseif($mode=="akumulatifbulanini"){
            $header = "Akumulasi Sampai Bulan Ini";
            $xlsForm = $this->VaksinatorCakupanModel->akumulasiBulanIni();
        }elseif($mode=="bulaninivsbulanlalu"){
            $header = "Bulan Ini vs Bulan Lalu";
            $xlsForm = $this->VaksinatorCakupanModel->bulanIniVsBulanLalu();
        }elseif($mode=="tahuninivstahunlalu"){
            $header = "Tahun Ini vs Tahun Lalu";
            $bulan = $this->uri->segment(4);
            $xlsForm = $this->VaksinatorCakupanModel->tahunIniVsTahunLalu($bulan);
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
            $this->load->model('BidanNewPwsModel');

            $kec    = $this->input->post('kecamatan');
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');

            if($form=="KIA"){
                $this->BidanNewPwsModel->kia($kec,$year,$month,$form);
            }elseif(strpos($form,'bayi')!==false){
                $this->BidanNewPwsModel->bayi($kec, $year, $month, $form);
            }elseif(strpos($form,'balita')!==false){
                $this->BidanNewPwsModel->balita($kec, $year, $month, $form);
            }elseif(strpos($form,'anak')!==false){
                $this->BidanNewPwsModel->anak($kec, $year, $month, $form);
            }elseif($form=="neonatal"){
                $this->BidanNewPwsModel->neonatal($kec,$year,$month,$form);
            }elseif($form=="kb"){
                $this->BidanNewPwsModel->kb($kec,$year,$month,$form);
            }elseif($form=="maternal"){
                $this->BidanNewPwsModel->maternal($kec,$year,$month,$form);
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    private function download_fhw($year,$month,$form){
        $user = $this->session->userdata('username');
        $this->load->model('PHPExcelModel');
        $this->load->model('PWSNewFhwModel');
        if($form=="KIA"){
            $this->PWSNewFhwModel->kia($user,$year,$month,$form);
        }elseif(strpos($form,'bayi')!==false){
            $this->PWSNewFhwModel->bayi($user, $year, $month, $form);
        }elseif(strpos($form,'balita')!==false){
            $this->PWSNewFhwModel->balita($user, $year, $month, $form);
        }elseif(strpos($form,'anak')!==false){
            $this->PWSNewFhwModel->anak($user, $year, $month, $form);
        }elseif($form=="neonatal"){
            $this->PWSNewFhwModel->neonatal($user,$year,$month,$form);
        }elseif($form=="kb"){
            $this->PWSNewFhwModel->kb($user,$year,$month,$form);
        }elseif($form=="maternal"){
            $this->PWSNewFhwModel->maternal($user,$year,$month,$form);
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
}