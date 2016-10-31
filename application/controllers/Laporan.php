<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            $this->session->set_flashdata('url', $this->uri->uri_string);
            redirect('login');
        }
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
            $b = date("m");
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
            $b = date("m");
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
            $this->load->model('BidanPwsModel');

            $kec    = $this->input->post('kecamatan');
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');

            if($form=="KIA1"){
                $this->BidanPwsModel->kia1($kec,$year,$month,$form);
            }elseif($form=="KIA2"){
                $this->BidanPwsModel->kia2($kec,$year,$month,$form);
            }elseif($form=="KIA3"){
                $this->BidanPwsModel->kia3($kec,$year,$month,$form);
            }elseif($form=="KIA4"){
                $this->BidanPwsModel->kia4($kec,$year,$month,$form);
            }elseif($form=="KIA5"){
                $this->BidanPwsModel->kia5($kec,$year,$month,$form);
            }elseif(strpos($form,'bayi')!==false){
                $this->BidanPwsModel->bayi($kec, $year, $month, $form);
            }elseif(strpos($form,'balita')!==false){
                $this->BidanPwsModel->balita($kec, $year, $month, $form);
            }elseif($form=="neonatal1"){
                $this->BidanPwsModel->neonatal1($kec,$year,$month,$form);
            }elseif($form=="neonatal2"){
                $this->BidanPwsModel->neonatal2($kec,$year,$month,$form);
            }elseif($form=="neonatal3"){
                $this->BidanPwsModel->neonatal3($kec,$year,$month,$form);
            }elseif($form=="neonatal4"){
                $this->BidanPwsModel->neonatal4($kec,$year,$month,$form);
            }elseif($form=="neonatal5"){
                $this->BidanPwsModel->neonatal5($kec,$year,$month,$form);
            }elseif($form=="kb1"){
                $this->BidanPwsModel->kb1($kec,$year,$month,$form);
            }elseif($form=="kb2"){
                $this->BidanPwsModel->kb2($kec,$year,$month,$form);
            }elseif($form=="kb3"){
                $this->BidanPwsModel->kb3($kec,$year,$month,$form);
            }elseif($form=="kb4"){
                $this->BidanPwsModel->kb4($kec,$year,$month,$form);
            }elseif($form=="kb5"){
                $this->BidanPwsModel->kb5($kec,$year,$month,$form);
            }elseif($form=="amp"){
                $this->BidanPwsModel->maternal($kec,$year,$month,$form);
            }elseif($form=="akb"){
                $this->BidanPwsModel->akb($kec,$year,$month,$form);
            }elseif($form=="kih"){
                $this->BidanPwsModel->kih($kec,$year,$month,$form);
            }elseif($form=="p4k"){
                $this->BidanPwsModel->p4k($kec,$year,$month,$form);
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    private function download_fhw($year,$month,$form){
        $user = $this->session->userdata('username');
        $this->load->model('PHPExcelModel');
        $this->load->model('PWSFhwModel');
        if($form=="KIA1"){
            $this->PWSFhwModel->kia1($user,$year,$month,$form);
        }elseif($form=="KIA2"){
            $this->PWSFhwModel->kia2($user,$year,$month,$form);
        }elseif($form=="KIA3"){
            $this->PWSFhwModel->kia3($user,$year,$month,$form);
        }elseif($form=="KIA4"){
            $this->PWSFhwModel->kia4($user,$year,$month,$form);
        }elseif($form=="KIA5"){
            $this->PWSFhwModel->kia5($user,$year,$month,$form);
        }elseif(strpos($form,'bayi')!==false){
            $this->PWSFhwModel->bayi($user, $year, $month, $form);
        }elseif(strpos($form,'balita')!==false){
            $this->PWSFhwModel->balita($user, $year, $month, $form);
        }elseif(strpos($form,'anak')!==false){
            $this->PWSFhwModel->anak($user, $year, $month, $form);
        }elseif($form=="neonatal1"){
            $this->PWSFhwModel->neonatal1($user,$year,$month,$form);
        }elseif($form=="neonatal2"){
            $this->PWSFhwModel->neonatal2($user,$year,$month,$form);
        }elseif($form=="neonatal3"){
            $this->PWSFhwModel->neonatal3($user,$year,$month,$form);
        }elseif($form=="neonatal4"){
            $this->PWSFhwModel->neonatal4($user,$year,$month,$form);
        }elseif($form=="neonatal5"){
            $this->PWSFhwModel->neonatal5($user,$year,$month,$form);
        }elseif($form=="kb1"){
            $this->PWSFhwModel->kb1($user,$year,$month,$form);
        }elseif($form=="kb2"){
            $this->PWSFhwModel->kb2($user,$year,$month,$form);
        }elseif($form=="kb3"){
            $this->PWSFhwModel->kb3($user,$year,$month,$form);
        }elseif($form=="kb4"){
            $this->PWSFhwModel->kb4($user,$year,$month,$form);
        }elseif($form=="kb5"){
            $this->PWSFhwModel->kb5($user,$year,$month,$form);
        }elseif($form=="amp"){
            $this->PWSFhwModel->maternal($user,$year,$month,$form);
        }elseif($form=="akb"){
            $this->PWSFhwModel->akb($user,$year,$month,$form);
        }elseif($form=="kih"){
            $this->PWSFhwModel->kih($user,$year,$month,$form);
        }elseif($form=="p4k"){
            $this->PWSFhwModel->p4k($user,$year,$month,$form);
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
}