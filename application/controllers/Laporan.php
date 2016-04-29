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
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/k1_akses.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='K1A';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/k4.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='K4';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='MT';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='PDFK';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='PDTK';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KN';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KNN1';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls','E');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KNN3';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls','C');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KM';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls','C');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KNN';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls','C');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KB';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls','C');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='KBLT';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
       
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSBidan");
        $this->load->view("footer");
    }
    
    public function statusGizi(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusGizi");
        $this->load->view("footer");
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSGizi");
        $this->load->view("footer");
    }
    
    public function downloadJurimPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSJurim");
        $this->load->view("footer");
    }
    
    public function download(){
        $this->load->helper('download');
        $this->load->model('PHPExcelModel');
        
        $data['cell']=['H11','H12'];
        $data['value']=['1000','2000'];
        
        $this->PHPExcelModel->createXLS("download/pws1.xlsx",$data);
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadPWSGizi");
        $this->load->view("footer");
    }
}