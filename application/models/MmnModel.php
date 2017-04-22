<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MmnModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni($kab){
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Jumlah anak yang BB/U <-2SD';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Jumlah anak yang dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Persentase anak yang memiliki skor Home rendah';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen12';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen13';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen14';
        $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen15';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen16';
        $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen17';
        $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen18';
        $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen19';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen20';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen21';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen22';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
        
    }
    
    public function cakupanAkumulatif($kab){
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Jumlah anak yang BB/U <-2SD';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Jumlah anak yang dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Persentase anak yang memiliki skor Home rendah';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen12';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen13';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen14';
        $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen15';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen16';
        $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen17';
        $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen18';
        $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen19';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen20';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen21';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen22';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    public function semuabulan($kab){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $xlsForm = [];
        $form = [];
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Jumlah anak yang BB/U <-2SD';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Jumlah anak yang dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Persentase anak yang memiliki skor Home rendah';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen12';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen13';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen14';
        $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen15';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen16';
        $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen17';
        $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen18';
        $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen19';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen20';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen21';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen22';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
}