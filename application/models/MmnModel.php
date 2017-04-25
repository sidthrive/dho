<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MmnModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    private function trim($str){
        return str_replace(".", '', trim($str));
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
        $desas = $this->loc->getLocId($kab);
        foreach ($desas as $dt=>$dn){
            $form[$dn] = 0;
        }
        
        $v1 = $form;
//        $data = $db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE ancDate >= '$startDate' AND ancDate <= '$endDate' GROUP BY docId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','pemberianmmn'=>'yes']);
        foreach ($data as $d){
            $loc = $this->trim($d->locationId);
            if(array_key_exists($loc, $form)){
                if($d->pemberianmmn=='yes'){
                    $v1[$loc]++;
                }
            }
        }
        
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$v1;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        $v2 = $form;
//        $data = $db->query("SELECT locationId, COUNT( * ) AS jml 
//                            FROM event_bidan_tambah_anc
//                            WHERE event_bidan_tambah_anc.baseEntityId NOT 
//                            IN (
//
//                            SELECT baseEntityId
//                            FROM event_bidan_dokumentasi_persalinan
//                            GROUP BY baseEntityId
//                            )
//                            AND event_bidan_tambah_anc.baseEntityId NOT 
//                            IN (
//
//                            SELECT baseEntityId
//                            FROM event_bidan_penutupan_anc
//                            GROUP BY baseEntityId
//                            )
//                            GROUP BY locationId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','jml'=>12]);
        foreach ($data as $d){
            $loc = $this->trim($d->locationId);
            if(array_key_exists($loc, $form)){
                $v2[$loc]+=$d->jml;
            }
        }
        foreach ($v2 as $dt=>$val){
            if($val==0)continue;
            $v2[$dt] = $v1[$dt]*100/$val;
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$v2;
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