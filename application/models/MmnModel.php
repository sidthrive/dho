<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MmnModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni(){
        $xlsForm = [];
        $user = $this->ec->getCakupanContainer('bidan');
        $form = $user;
        foreach ($form as $x=>$f){
            $form[$x] = rand(15, 30);
        }
//        var_dump($form);exit;
        $series1['page']='mmn';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
        
    }
    
    public function cakupanAkumulatif(){
        $xlsForm = [];
        $user = $this->ec->getCakupanContainer('bidan');
        $form = $user;
        foreach ($form as $x=>$f){
            $form[$x] = rand(15, 30);
        }
//        var_dump($form);exit;
        $series1['page']='mmn';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    public function semuabulan(){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $form = [];
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        
        $xlsForm = [];
        $series1['page']='mmn';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
}