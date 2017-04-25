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
        $data['location'] = $this->loc->getAllLoc('bidan');
        $this->load->view('laporan/laporansidebar',$data);
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
        
        $data['location'] = $this->loc->getAllLoc('bidan');
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar",$data);
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $data['location'] = $this->loc->getAllLoc('bidan');
        $this->load->view("laporan/laporansidebar",$data);
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
    
    public function gen(){
        $bulan_map = [1=>'januari',2=>'februari',3=>'maret',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'agustus',9=>'september',10=>'oktober',11=>'november',12=>'desember'];
        $bulan_map_flip = array_flip($bulan_map);
        $tm = date("n");
        if($this->input->get('mode')==null){
            $data['mode'] = "bulan_ini";
            redirect("laporan/gen/".$this->uri->segment(3)."?mode=".$data['mode']."&bulan=".$bulan_map[$tm]);
        }else{
            if($this->input->get('mode')=="semua_bulan"&&$this->input->get('desa')==null){
                $data['kab'] = str_replace("%20"," ",$this->uri->segment(3));
                $data['desas'] = $this->loc->getLocId($data['kab']);
                $data['mode'] = $this->input->get('mode');
                $data['desa'] = reset($data['desas']);
                redirect("laporan/gen/".$this->uri->segment(3)."?mode=".$data['mode']."&desa=".reset($data['desas']));
            }else{
                if($this->input->get('mode')!="semua_bulan"&&$this->input->get('bulan')==null){
                    $data['mode'] = $this->input->get('mode');
                    redirect("laporan/gen/".$this->uri->segment(3)."?mode=".$data['mode']."&bulan=".$bulan_map[$tm]);
                }else{
                    $data['mode'] = $this->input->get('mode');
                    $data['bulan'] = $this->input->get('bulan');
                    $data['desa'] = $this->input->get('desa');
                }
            }
        }
        
        $data['kab'] = str_replace("%20"," ",$this->uri->segment(3));
        $data['desas'] = $this->loc->getLocId($data['kab']);
        
        if($this->session->userdata('level')=="fhw"){
            $this->load->model('BidanEcFhwCakupanModel');
            $data['xlsForm']=$this->MmnModel->cakupanBulanIni();
        }else{
            $this->load->model('MmnModel');
            if($data['mode']=='bulan_ini'){
                $data['xlsForm']=$this->MmnModel->cakupanBulanIni($data['kab']);
            }elseif($data['mode']=='akumulatif'){
                $data['xlsForm']=$this->MmnModel->cakupanAkumulatif($data['kab']);
            }elseif($data['mode']=='semua_bulan'){
                $data['xlsForm']=$this->MmnModel->semuabulan($data['kab']);
            }
        }
        
        $data['location'] = $this->loc->getAllLoc('bidan');
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar",$data);
        $this->load->view("laporan/mmn",$data);
        $this->load->view("footer");
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function karana(){
        $bulan_map = [1=>'januari',2=>'februari',3=>'maret',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'agustus',9=>'september',10=>'oktober',11=>'november',12=>'desember'];
        $bulan_map_flip = array_flip($bulan_map);
        $tm = date("n");
        if($this->input->get('mode')==null){
            $data['mode'] = "bulan_ini";
            redirect("laporan/karana/".$this->uri->segment(3)."?mode=".$data['mode']."&bulan=".$bulan_map[$tm]);
        }else{
            if($this->input->get('mode')=="semua_bulan"&&$this->input->get('desa')==null){
                $data['kab'] = str_replace("%20"," ",$this->uri->segment(3));
                $data['desas'] = $this->loc->getLocId($data['kab']);
                $data['mode'] = $this->input->get('mode');
                $data['desa'] = reset($data['desas']);
                redirect("laporan/karana/".$this->uri->segment(3)."?mode=".$data['mode']."&desa=".reset($data['desas']));
            }else{
                if($this->input->get('mode')!="semua_bulan"&&$this->input->get('bulan')==null){
                    $data['mode'] = $this->input->get('mode');
                    redirect("laporan/karana/".$this->uri->segment(3)."?mode=".$data['mode']."&bulan=".$bulan_map[$tm]);
                }else{
                    $data['mode'] = $this->input->get('mode');
                    $data['bulan'] = $this->input->get('bulan');
                    $data['desa'] = $this->input->get('desa');
                }
            }
        }
        
        $data['kab'] = str_replace("%20"," ",$this->uri->segment(3));
        $data['desas'] = $this->loc->getLocId($data['kab']);
        
        if($this->session->userdata('level')=="fhw"){
            $this->load->model('ParanaModel');
            $data['xlsForm']=$this->ParanaModel->cakupanBulanIni();
        }else{
            $this->load->model('ParanaModel');
            if($data['mode']=='bulan_ini'){
                $data['xlsForm']=$this->ParanaModel->cakupanBulanIni($data['kab']);
            }elseif($data['mode']=='akumulatif'){
                $data['xlsForm']=$this->ParanaModel->cakupanAkumulatif($data['kab']);
            }elseif($data['mode']=='semua_bulan'){
                $data['xlsForm']=$this->ParanaModel->semuabulan($data['kab']);
            }
        }
        
        $data['location'] = $this->loc->getAllLoc('bidan');
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar",$data);
        $this->load->view("laporan/parana",$data);
        $this->load->view("footer");
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
            }elseif(strpos($form,'anak')!==false){
                $this->BidanEcPwsModel->anak($kec, $year, $month, $form);
            }elseif($form=="neonatal"){
                $this->BidanEcPwsModel->neonatal($kec,$year,$month,$form);
            }elseif($form=="kb"){
                $this->BidanEcPwsModel->kb($kec,$year,$month,$form);
            }elseif($form=="maternal"){
                $this->BidanEcPwsModel->maternal($kec,$year,$month,$form);
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
        }elseif($form=="neonatal"){
            $this->PWSEcFhwModel->neonatal($user,$year,$month,$form);
        }elseif($form=="kb"){
            $this->PWSEcFhwModel->kb($user,$year,$month,$form);
        }elseif($form=="maternal"){
            $this->PWSEcFhwModel->maternal($user,$year,$month,$form);
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
}