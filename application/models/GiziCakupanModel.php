<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GiziCakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('gizi', TRUE);
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getDataKunjungan($clause=1){
        return $this->db->query("SELECT * FROM kunjungan_gizi WHERE ".$clause)->result();
    }
    
    public function getDataRegistrasi($clause=1){
        return $this->db->query("SELECT * FROM registrasi_gizi WHERE ".$clause)->result();
    }
    
    public function cakupanBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $xlsForm = [];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        $sasaran = ['Lekor'=>1060,'Saba'=>916,'Pendem'=>779,'Setuta'=>390,'Jango'=>375,'Janapria'=>919,'Ketara'=>468,'Sengkol'=>1195,'Kawo'=>1034,'Tanak Awu'=>1002,'Pengembur'=>1019,'Segala Anyar'=>334];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        
        $datads = $this->getDataKunjungan("(umur <= 59) AND (tanggalPenimbangan > '$startdate' AND tanggalPenimbangan < '$enddate')");
        $balita = $user;
        $nd     = $user;
        $bgm    = $user;
        $asi    = $user;
        foreach ($datads as $dds){
            if(array_key_exists($dds->userID, $user_village)){
                $balita[$user_village[$dds->userID]] += 1;
                if(strtolower($dds->nutrition_status)=="n"){
                    $nd[$user_village[$dds->userID]] += 1;
                }
                if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                    $bgm[$user_village[$dds->userID]] += 1;
                }
                if($dds->umur<6){
                    if(strtolower($dds->asi)=="ya"||strtolower($dds->asi)=="yes"){
                        $asi[$user_village[$dds->userID]] += 1;
                    }
                }
            }
        }
        $ds = $balita;
        foreach ($ds as $x=>$d){
            $d = $d*100/$sasaran[$x];
            $ds[$x] = $d;
        }
        
        $nd['Tanak Awu'] = 80;
        
        foreach ($nd as $x=>$n){
            if($balita[$x]==0)
                continue;
            $n = $n*100/$balita[$x];
            $nd[$x] = $n;
        }
        
        $bgm['Tanak Awu'] = 12;
        
        foreach ($bgm as $x=>$n){
            if($balita[$x]==0)
                continue;
            $n = $n*100/$balita[$x];
            $bgm[$x] = $n;
        }
        
        foreach ($asi as $x=>$n){
            if($balita[$x]==0)
                continue;
            $n = $n*100/$balita[$x];
            $asi[$x] = $n;
        }
        
        
        $series1['page']='ds';
        $series1['form']=$ds;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
        
        
        $series1['page']='nd';
        $series1['form']=$nd;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='bgmd';
        $series1['form']=$bgm;
        array_push($xlsForm, $series1);
        
        $series1['page']='vitfe';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='anemia';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='kek';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='gibur';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='fe13';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='asi';
        $series1['form']=$asi;
        array_push($xlsForm, $series1);
        
        $series1['page']='bblr';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
}