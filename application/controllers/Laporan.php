<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('laporan/laporansidebar');
        $this->load->view('laporan/laporanmainpage');
        $this->load->view('footer');
    }
    
    public function cakupanIndikatorPWS(){
        if($this->input->get('b')==null){
            redirect("laporan/cakupanindikatorpws?b=januari&t=2016");
        }else{
            $dataXLS['bulan'] = $this->input->get('b');
            $dataXLS['tahun'] = $this->input->get('t');
        }
        $this->load->model('BidanCakupanModel');
       
        $dataXLS['xlsForm']=$this->BidanCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
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
    }
    
    public function cakupanGizi(){
        $this->load->model('GiziCakupanModel');
        if($this->input->get('b')==null){
            redirect("laporan/cakupangizi?b=januari&t=2016");
        }else{
            $dataXLS['bulan'] = $this->input->get('b');
            $dataXLS['tahun'] = $this->input->get('t');
        }
        $dataXLS['xlsForm']=$this->GiziCakupanModel->cakupanBulanIni($dataXLS['bulan'],$dataXLS['tahun']);
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusgizi",$dataXLS, false);
        $this->load->view("footer");
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsgizi");
        $this->load->view("footer");
    }
    
    public function downloadpwsgizi(){
        $kecamatan   = $this->input->post('kecamatan');
        $year   = $this->input->post('year');
        $month  = $this->input->post('month');
        $this->load->model('GiziPwsModel');
        $this->GiziPwsModel->pwsBulanIni($month,$year,$kecamatan);
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
    }
    
    public function downloadvaksinatorPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsjurim");
        $this->load->view("footer");
    }
    
    public function downloadpwsvaksinator(){
        $kecamatan   = $this->input->post('kecamatan');
        $year   = $this->input->post('year');
        $month  = $this->input->post('month');
        $form  = $this->input->post('form');
        $this->load->model('VaksinatorPwsModel');
        $this->VaksinatorPwsModel->pwsBulanIni($month,$year,$kecamatan,$form);
    }
    
    public function download(){
        if($this->session->userdata('level')=="fhw"){
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');
            $this->download_fhw($year,$month,$form);
        }else{
            $this->load->model('PHPExcelModel');
            $this->load->model('PWSModel');

            $kec    = $this->input->post('kecamatan');
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');

            if($form=="KIA1"){
                $this->PWSModel->kia1($kec,$year,$month,$form);
            }elseif($form=="KIA2"){
                $this->PWSModel->kia2($kec,$year,$month,$form);
            }elseif($form=="KIA3"){
                $this->PWSModel->kia3($kec,$year,$month,$form);
            }elseif($form=="KIA4"){
                $this->PWSModel->kia4($kec,$year,$month,$form);
            }elseif($form=="KIA5"){
                $this->PWSModel->kia5($kec,$year,$month,$form);
            }elseif(strpos($form,'bayi')!==false){
                $this->PWSModel->bayi($kec, $year, $month, $form);
            }elseif(strpos($form,'balita')!==false){
                $this->PWSModel->balita($kec, $year, $month, $form);
            }elseif($form=="neonatal1"){
                $this->PWSModel->neonatal1($kec,$year,$month,$form);
            }elseif($form=="neonatal2"){
                $this->PWSModel->neonatal2($kec,$year,$month,$form);
            }elseif($form=="neonatal3"){
                $this->PWSModel->neonatal3($kec,$year,$month,$form);
            }elseif($form=="neonatal4"){
                $this->PWSModel->neonatal4($kec,$year,$month,$form);
            }elseif($form=="neonatal5"){
                $this->PWSModel->neonatal5($kec,$year,$month,$form);
            }elseif($form=="kb1"){
                $this->PWSModel->kb1($kec,$year,$month,$form);
            }elseif($form=="kb2"){
                $this->PWSModel->kb2($kec,$year,$month,$form);
            }elseif($form=="kb3"){
                $this->PWSModel->kb3($kec,$year,$month,$form);
            }elseif($form=="kb4"){
                $this->PWSModel->kb4($kec,$year,$month,$form);
            }elseif($form=="kb5"){
                $this->PWSModel->kb5($kec,$year,$month,$form);
            }elseif($form=="amp"){
                $this->PWSModel->maternal($kec,$year,$month,$form);
            }elseif($form=="akb"){
                $this->PWSModel->akb($kec,$year,$month,$form);
            }elseif($form=="kih"){
                $this->PWSModel->kih($kec,$year,$month,$form);
            }elseif($form=="p4k"){
                $this->PWSModel->p4k($kec,$year,$month,$form);
            }
        }
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
    }
}