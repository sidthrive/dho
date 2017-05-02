<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HhhscoreModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function handScoreBulanIni($kab){
        $xlsForm = [];
        $form = [];
        if($this->session->userdata('level')=="fhw"){
            $desas = $this->loc->getDusun($kab);
        }else{
            $desas = $this->loc->getLocId($kab);
        }
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='TOTAL HAND SCORE';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Cakupan ANC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Cakupan PNC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Cakupan Kelahiran';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Cakupan Neonatal';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Trimester Pertama';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Trimester Kedua';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Trimester Ketiga';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Digit Check';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Normality Check';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    public function heartScoreBulanIni($kab){
        $xlsForm = [];
        $form = [];
        if($this->session->userdata('level')=="fhw"){
            $desas = $this->loc->getDusun($kab);
        }else{
            $desas = $this->loc->getLocId($kab);
        }
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='TOTAL HEART SCORE';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Cakupan ANC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Cakupan PNC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Cakupan Kelahiran';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Cakupan Neonatal';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
}