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
    
    public function cakupanStandar(){
        
        $temp = $this->PHPExcelModel->getXLSData('download/anc1_std_cov');
        $dataXLS['ANC1SCxlabel']=$temp['xlabel'];
        $dataXLS['ANC1SCvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/anc1_nonstd_cov');
        $dataXLS['ANC1NCxlabel']=$temp['xlabel'];
        $dataXLS['ANC1NCvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/anc4_std_cov');
        $dataXLS['ANC4SCxlabel']=$temp['xlabel'];
        $dataXLS['ANC4SCvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/anc4_nonstd_cov');
        $dataXLS['ANC4NCxlabel']=$temp['xlabel'];
        $dataXLS['ANC4NCvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/birth_cov');
        $dataXLS['BCxlabel']=$temp['xlabel'];
        $dataXLS['BCvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/pnc_cov');
        $dataXLS['PNCCxlabel']=$temp['xlabel'];
        $dataXLS['PNCCvalue']=$temp['yvalue'];
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/standar",$dataXLS,false);
        $this->load->view("footer");
    }
    
    public function cakupanIndikatorPWS(){
        
        $temp = $this->PHPExcelModel->getXLSData('download/k1_akses');
        $dataXLS['K1xlabel']=$temp['xlabel'];
        $dataXLS['K1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/k4');
        $dataXLS['k4xlabel']=$temp['xlabel'];
        $dataXLS['k4value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani');
        $dataXLS['MTxlabel']=$temp['xlabel'];
        $dataXLS['MTvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan');
        $dataXLS['PDFKxlabel']=$temp['xlabel'];
        $dataXLS['PDFKvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan');
        $dataXLS['PDTKxlabel']=$temp['xlabel'];
        $dataXLS['PDTKvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas');
        $dataXLS['KNxlabel']=$temp['xlabel'];
        $dataXLS['KNvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1');
        $dataXLS['KN1xlabel']=$temp['xlabel'];
        $dataXLS['KN1value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3');
        $dataXLS['KN3xlabel']=$temp['xlabel'];
        $dataXLS['KN3value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_maternal');
        $dataXLS['KMxlabel']=$temp['xlabel'];
        $dataXLS['KMvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_neonatal');
        $dataXLS['KNNxlabel']=$temp['xlabel'];
        $dataXLS['KNNvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_bayi');
        $dataXLS['KBxlabel']=$temp['xlabel'];
        $dataXLS['KBvalue']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/kematian_balita');
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