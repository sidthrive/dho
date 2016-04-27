<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HHHScore extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/standarisasimainpage');
        $this->load->view('footer');
    }
    public function headscore(){
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/HeadScore');
        $this->load->view('footer');
    }
    public function bidanTrimester1(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri1.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Tekanan Darah';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri1.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Berat Badan ';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/lila_tri1.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan LILA';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/pemeriksaan_hb_tri1.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Hb';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/golongan_darah_tri1.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Golongan Darah';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $dataXLS = json_encode($xlsForm);
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester1",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester2(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Tekanan Darah';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Berat Badan';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Tinggi Fundus Uterus';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Presentase Janin';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Denyut Jantung Janin';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $dataXLS = json_encode($xlsForm);
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester2",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester3(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri3.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Tekanan Darah';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri3.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        $series['page']='Pemeriksaan Berat Badan';
        $series['form']=$form;
        array_push($xlsForm, $series);
        
        $dataXLS = json_encode($xlsForm);
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester3",$dataXLS,false);
        $this->load->view("footer");
    }
    public function standar(){
        $this->load->model('PHPExcelModel');
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        $form['label']=$temp['xlabel'];
        $form['value']=$temp['yvalue'];
                
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/standar');
        $this->load->view('footer');
    }
    public function heartscore(){
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/heartscore');
        $this->load->view('footer');
    }
    
}