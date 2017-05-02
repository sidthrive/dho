<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ParanaFhwModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni($kab){
        $db = $this->load->database('analytics', TRUE);
        $y = date("Y");
        $m = date("m");
        $nm = date("m",  strtotime(date("Y-m-d")." +1 month"));
        $startDate = $y."-".$m."-01";
        $endDate = date("Y-m-d",  strtotime($y."-".$nm."-01 -1 day"));
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getDusun($kab);
        
        $form['Sesi 1'] = rand(15, 30);
        $form['Sesi 2'] = rand(15, 30);
        $form['Sesi 3'] = rand(15, 30);
        $form['Sesi 4'] = rand(15, 30);
        
        $v1 = $form;
        
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang mengikuti sesi karana';
        $series1['symbol']='';
        $series1['form']=$v1;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
        
    }
    
    public function cakupanAkumulatif($kab){
        $y = date("Y");
        $m = date("m");
        $nm = date("m",  strtotime(date("Y-m-d")." +1 month"));
        $startDate = $y."-".$m."-01";
        $endDate = date("Y-m-d",  strtotime($y."-".$nm."-01 -1 day"));
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getDusun($kab);
        
        $form['Sesi 1'] = rand(15, 30);
        $form['Sesi 2'] = rand(15, 30);
        $form['Sesi 3'] = rand(15, 30);
        $form['Sesi 4'] = rand(15, 30);
        
        $v1 = $form;
        
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang mengikuti sesi karana';
        $series1['symbol']='';
        $series1['form']=$v1;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    public function semuabulan($kab){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $form = [];
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = ['s1'=>rand(15, 30),'s2'=>rand(15, 30),'s3'=>rand(15, 30),'s4'=>rand(15, 30)];
        }
        $xlsForm = [];
        $series1['page']='mmn';
        $series1['title']='Jumlah Ibu yang mengikuti sesi karana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']=['Sesi 1','Sesi 2','Sesi 3','Sesi 4'];
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
}