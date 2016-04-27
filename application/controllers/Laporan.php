<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('laporan/laporansidebar');
        $this->load->view('laporan/laporanmainpage');
        $this->load->view('footer');
    }
    
    public function cakupanIndikatorPWS(){
        $this->load->model('PHPExcelModel');
        
        $temp = $this->PHPExcelModel->getXLSData('download/k1_akses.xls','E');
        $dataXLS['K1xlabel']=$temp['xlabel'];
        $dataXLS['K1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/k4.xls','E');
        $dataXLS['k4xlabel']=$temp['xlabel'];
        $dataXLS['k4value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls','E');
        $dataXLS['MTxlabel']=$temp['xlabel'];
        $dataXLS['MTvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls','E');
        $dataXLS['PDFKxlabel']=$temp['xlabel'];
        $dataXLS['PDFKvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls','E');
        $dataXLS['PDTKxlabel']=$temp['xlabel'];
        $dataXLS['PDTKvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls','E');
        $dataXLS['KNxlabel']=$temp['xlabel'];
        $dataXLS['KNvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls','E');
        $dataXLS['KN1xlabel']=$temp['xlabel'];
        $dataXLS['KN1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls','E');
        $dataXLS['KN3xlabel']=$temp['xlabel'];
        $dataXLS['KN3value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls','E');
        $dataXLS['KMxlabel']=$temp['xlabel'];
        $dataXLS['KMvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls','E');
        $dataXLS['KNNxlabel']=$temp['xlabel'];
        $dataXLS['KNNvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls','E');
        $dataXLS['KBxlabel']=$temp['xlabel'];
        $dataXLS['KBvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls','E');
        $dataXLS['KBLTxlabel']=$temp['xlabel'];
        $dataXLS['KBLTvalue']=$temp['yvalue'];
        
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
        
}