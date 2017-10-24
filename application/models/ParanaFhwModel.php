<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ParanaFhwModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni($kab,$bln){
        $db = $this->load->database('analytics', TRUE);
        $y = date("Y");
        $m = $bln;
        $startDate = $y."-".($m<10?"0".$m:$m)."-01";
        $nm = date("m",  strtotime($startDate." +1 month"));
        $endDate = date("Y-m-d",  strtotime($y."-".$nm."-01 -1 day"));
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        $location = $this->loc->getLocUserQuery($desas);
        
        $form['Sesi 1'] = $db->query("SELECT kiId FROM parana1 WHERE ($location) AND submissionDate >= '$startDate' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 2'] = $db->query("SELECT kiId FROM parana2 WHERE ($location) AND submissionDate >= '$startDate' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 3'] = $db->query("SELECT kiId FROM parana3 WHERE ($location) AND submissionDate >= '$startDate' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 4'] = $db->query("SELECT kiId FROM parana4 WHERE ($location) AND submissionDate >= '$startDate' AND submissionDate <= '$endDate'")->num_rows();
        
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
    
    public function cakupanAkumulatif($kab,$bln){
        $db = $this->load->database('analytics', TRUE);
        $y = date("Y");
        $m = $bln;
        $startyear = $y."-01-01";
        $startDate = $y."-".($m<10?"0".$m:$m)."-01";
        $nm = date("m",  strtotime($startDate." +1 month"));
        $endDate = date("Y-m-d",  strtotime($y."-".$nm."-01 -1 day"));
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        $location = $this->loc->getLocUserQuery($desas);
        
        $form['Sesi 1'] = $db->query("SELECT kiId FROM parana1 WHERE ($location) AND submissionDate >= '$startyear' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 2'] = $db->query("SELECT kiId FROM parana2 WHERE ($location) AND submissionDate >= '$startyear' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 3'] = $db->query("SELECT kiId FROM parana3 WHERE ($location) AND submissionDate >= '$startyear' AND submissionDate <= '$endDate'")->num_rows();
        $form['Sesi 4'] = $db->query("SELECT kiId FROM parana4 WHERE ($location) AND submissionDate >= '$startyear' AND submissionDate <= '$endDate'")->num_rows();
        
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
    
    public function semuabulan($kab,$user){
        $db = $this->load->database('analytics', TRUE);
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_map_flip = array_flip($bulan_map);
        $y = date("Y");
        $startyear = $y."-01-01";
        $endDate = $y."-12-31";
        $data = [];
        
        $data['s1'] = $db->query("SELECT userId,MONTH(submissionDate) as month,count(*) as jml FROM parana1 WHERE userId='$user' AND submissionDate >= '$startyear' AND submissionDate <= '$endDate' group by MONTH(submissionDate)")->result();
        $data['s2'] = $db->query("SELECT userId,MONTH(submissionDate) as month,count(*) as jml FROM parana2 WHERE userId='$user' AND submissionDate >= '$startyear' AND submissionDate <= '$endDate' group by MONTH(submissionDate)")->result();
        $data['s3'] = $db->query("SELECT userId,MONTH(submissionDate) as month,count(*) as jml FROM parana3 WHERE userId='$user' AND submissionDate >= '$startyear' AND submissionDate <= '$endDate' group by MONTH(submissionDate)")->result();
        $data['s4'] = $db->query("SELECT userId,MONTH(submissionDate) as month,count(*) as jml FROM parana4 WHERE userId='$user' AND submissionDate >= '$startyear' AND submissionDate <= '$endDate' group by MONTH(submissionDate)")->result();
        
        $form = [];
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = ['s1'=>0,'s2'=>0,'s3'=>0,'s4'=>0];
        }
        
        foreach ($data as $s=>$ds){
            foreach ($ds as $d){
                $form[ucfirst($bulan_map_flip[$d->month])][$s] += $d->jml;
            }
        }
        
        $xlsForm = [];
        $series1['page']='Ibu';
        $series1['title']='Jumlah Ibu yang mengikuti sesi karana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']=['Sesi 1','Sesi 2','Sesi 3','Sesi 4'];
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
}