<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class QCI extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('QCI/qcisidebar');
        $this->load->view('QCI/qcipage');
        $this->load->view('footer');
    }
    public function bidanTrimester1(){
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri1');
        $dataXLS['TDT1xlabel']=$temp['xlabel'];
        $dataXLS['TDT1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri1');
        $dataXLS['BBT1xlabel']=$temp['xlabel'];
        $dataXLS['BBT1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/lila_tri1');
        $dataXLS['LIKAT1xlabel']=$temp['xlabel'];
        $dataXLS['LIKAT1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/pemeriksaan_hb_tri1');
        $dataXLS['HBT1xlabel']=$temp['xlabel'];
        $dataXLS['HBT1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/golongan_darah_tri1');
        $dataXLS['GOLDART1xlabel']=$temp['xlabel'];
        $dataXLS['GOLDART1value']=$temp['yvalue'];
        
        
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/trimester1",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester2(){
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2');
        $dataXLS['TDT2xlabel']=$temp['xlabel'];
        $dataXLS['TDT2value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2');
        $dataXLS['BBT2xlabel']=$temp['xlabel'];
        $dataXLS['BBT2value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2');
        $dataXLS['TFUT2xlabel']=$temp['xlabel'];
        $dataXLS['TFUT2value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2');
        $dataXLS['PJT2xlabel']=$temp['xlabel'];
        $dataXLS['PJT2value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2');
        $dataXLS['DJJT2xlabel']=$temp['xlabel'];
        $dataXLS['DJJT2value']=$temp['yvalue'];
        
        
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/trimester2",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester3(){
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri3');
        $dataXLS['TDT3xlabel']=$temp['xlabel'];
        $dataXLS['TDT3value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri3');
        $dataXLS['BBT2xlabel']=$temp['xlabel'];
        $dataXLS['BBT2value']=$temp['yvalue'];
        $this->load->view("header");
        $this->load->view("qci/qcisidebar");
        $this->load->view("qci/trimester3",$dataXLS,false);
        $this->load->view("footer");
    }
    
    
}