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
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        $temp1 = $this->PHPExcelModel->getXLSData('download/k1_akses.xls','E');
        $form1 = $user;
        foreach($temp1['xlabel'] as $i => $data){
            $form1[$user_village[$data]]+=$temp1['yvalue'][$i];
        }
        $series1['page']='K1A';
        $series1['form']=$form1;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $temp2 = $this->PHPExcelModel->getXLSData('download/k4.xls','E');
        $form2 = $user;
        foreach($temp2['xlabel'] as $i => $data){
            $form2[$user_village[$data]]+=$temp2['yvalue'][$i];
        }
        $series2['page']='K4';
        $series2['form']=$form2;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $temp3 = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls','E');
        $form3 = $user;
        foreach($temp3['xlabel'] as $i => $data){
            $form3[$user_village[$data]]+=$temp3['yvalue'][$i];
        }
        $series3['page']='MT';
        $series3['form']=$form3;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $temp4 = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls','E');
        $form4 = $user;
        foreach($temp4['xlabel'] as $i => $data){
            $form4[$user_village[$data]]+=$temp4['yvalue'][$i];
        }
        $series4['page']='PDFK';
        $series4['form']=$form4;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
       
        $temp5 = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls','E');
        $form5 = $user;
        foreach($temp5['xlabel'] as $i => $data){
            $form5[$user_village[$data]]+=$temp5['yvalue'][$i];
        }
        $series5['page']='PDTK';
        $series5['form']=$form5;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $temp6 = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls','E');
        $form6 = $user;
        foreach($temp6['xlabel'] as $i => $data){
            $form6[$user_village[$data]]+=$temp6['yvalue'][$i];
        }
        $series6['page']='KN';
        $series6['form']=$form6;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $temp7 = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls','E');
        $form7 = $user;
        foreach($temp7['xlabel'] as $i => $data){
            $form7[$user_village[$data]]+=$temp7['yvalue'][$i];
        }
        $series7['page']='KNN1';
        $series7['form']=$form7;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
       
        $temp8 = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls','E');
        $form8 = $user;
        foreach($temp8['xlabel'] as $i => $data){
            $form8[$user_village[$data]]+=$temp8['yvalue'][$i];
        }
        $series8['page']='KNN3';
        $series8['form']=$form8;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
        $temp9 = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls','C');
        $form9 = array();
        foreach($temp9['xlabel'] as $i => $data){
            $form9[$data]=$temp9['yvalue'][$i];
        }
        $series9['page']='KM';
        $series9['form']=$form9;
        $series9['y_label']='persentase';
        $series9['series_name']='persentase';
        array_push($xlsForm, $series9);
       
        $temp10 = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls','C');
        $form10 = array();
        foreach($temp10['xlabel'] as $i => $data){
            $form10[$data]=$temp10['yvalue'][$i];
        }
        $series10['page']='KNN';
        $series10['form']=$form10;
        $series10['y_label']='persentase';
        $series10['series_name']='persentase';
        array_push($xlsForm, $series10);
       
        $temp11 = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls','C');
        $form11 = array();
        foreach($temp11['xlabel'] as $i => $data){
            $form11[$data]=$temp11['yvalue'][$i];
        }
        $series11['page']='KB';
        $series11['form']=$form11;
        $series11['y_label']='persentase';
        $series11['series_name']='persentase';
        array_push($xlsForm, $series11);
       
        $temp12 = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls','C');
        $form12 = array();
        foreach($temp12['xlabel'] as $i => $data){
            $form12[$data]=$temp12['yvalue'][$i];
        }
        $series12['page']='KBLT';
        $series12['form']=$form12;
        $series12['y_label']='persentase';
        $series12['series_name']='persentase';
        array_push($xlsForm, $series12);
       
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsbidan");
        $this->load->view("footer");
    }
    
    public function statusGizi(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusgizi");
        $this->load->view("footer");
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsgizi");
        $this->load->view("footer");
    }
    
    public function downloadJurimPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsjurim");
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
        $this->load->view("laporan/downloadpwsgizi");
        $this->load->view("footer");
    }
}