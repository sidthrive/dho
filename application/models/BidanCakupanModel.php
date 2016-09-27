<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanCakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function cakupanBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        $temp = $this->PHPExcelModel->getXLSData('download/k1_akses.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series1['page']='K1A';
        $series1['form']=$form;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $temp = $this->PHPExcelModel->getXLSData('download/k4.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series2['page']='K4';
        $series2['form']=$form;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series3['page']='MT';
        $series3['form']=$form;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series4['page']='PDFK';
        $series4['form']=$form;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series5['page']='PDTK';
        $series5['form']=$form;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series6['page']='KN';
        $series6['form']=$form;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series7['page']='KNN1';
        $series7['form']=$form;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series8['page']='KNN3';
        $series8['form']=$form;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series9['page']='KM';
//        $series9['form']=$form;
//        $series9['y_label']='persentase';
//        $series9['series_name']='persentase';
//        array_push($xlsForm, $series9);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series10['page']='KNN';
//        $series10['form']=$form;
//        $series10['y_label']='persentase';
//        $series10['series_name']='persentase';
//        array_push($xlsForm, $series10);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series11['page']='KB';
//        $series11['form']=$form;
//        $series11['y_label']='persentase';
//        $series11['series_name']='persentase';
//        array_push($xlsForm, $series11);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series12['page']='KBLT';
//        $series12['form']=$form;
//        $series12['y_label']='persentase';
//        $series12['series_name']='persentase';
//        array_push($xlsForm, $series12);
        
        return $xlsForm;
    }
}