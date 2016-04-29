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
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='TDT1';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri1.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='BBT1';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/lila_tri1.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='LIKAT1';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/pemeriksaan_hb_tri1.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='HBT1';
        $series['form']=$form;
        $series['y_label']='persentase';
        $series['series_name']='persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/golongan_darah_tri1.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='GOLDART1';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester1",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester2(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='TDT2';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='BBT2';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='TFUT2';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='PJT2';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='DJJT2';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester2",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester3(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri3.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='TDT3';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri3.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='BBT3';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester3",$dataXLS,false);
        $this->load->view("footer");
    }
    public function standar(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='ANC1SC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='ANC1NC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='ANC4SC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='ANC4NC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='BC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls','D');
        foreach($temp['xlabel'] as $i => $data){
            $form[$data]=$temp['yvalue'][$i];
        }
        $series['page']='PNCC';
        $series['form']=$form;
        $series['y_label'] = 'persentase';
        $series['series_name'] = 'persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/standar',$dataXLS);
        $this->load->view('footer');
    }
    public function heartscore(){
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/heartscore');
        $this->load->view('footer');
    }
    
}