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
    
    public function cakupanBulanIni(){
        $xlsForm = [];
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        
        $datads = $this->getDataKunjungan("(umur <= 59) AND (tanggalPenimbangan > '2016-02' AND tanggalPenimbangan < '2016-03')");
        $ds = $user;
        foreach ($datads as $dds){
            if(array_key_exists($dds->userID, $user_village)){
                $ds[$user_village[$dds->userID]] += 1;
            }
        }
        
        $series1['page']='ds';
        $series1['form']=$ds;
        $series1['y_label']='jumlah';
        $series1['series_name']='jumlah';
        array_push($xlsForm, $series1);
        
        
        $series1['page']='nd';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='bgmd';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
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
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        $series1['page']='bblr';
        $series1['form']=['Lekor'=>rand(50,90),'Saba'=>rand(50,90),'Pendem'=>rand(50,90),'Setuta'=>rand(50,90),'Jango'=>rand(50,90),'Janapria'=>rand(50,90),'Ketara'=>rand(50,90),'Sengkol'=>rand(50,90),'Kawo'=>rand(50,90),'Tanak Awu'=>rand(50,90),'Pengembur'=>rand(50,90),'Segala Anyar'=>rand(50,90)];;
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
}