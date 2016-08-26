<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorCakupanModel extends CI_Model{

    private $db;
    private $xlsForm = [];
    private $user   =  ['Lekor'=>array('l'=>0,'p'=>0),'Saba'=>array('l'=>0,'p'=>0),'Pendem'=>array('l'=>0,'p'=>0),'Setuta'=>array('l'=>0,'p'=>0),'Jango'=>array('l'=>0,'p'=>0),'Janapria'=>array('l'=>0,'p'=>0),'Ketara'=>array('l'=>0,'p'=>0),'Sengkol'=>array('l'=>0,'p'=>0),'Kawo'=>array('l'=>0,'p'=>0),'Tanak Awu'=>array('l'=>0,'p'=>0),'Pengembur'=>array('l'=>0,'p'=>0),'Segala Anyar'=>array('l'=>0,'p'=>0)];
    private $user_village = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
            
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('vaksinator', TRUE);
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getDataVisit($clause=1){
        return $this->db->query("SELECT * FROM jurim_visit WHERE ".$clause)->result();
    }
    
    public function getDataRegistrasi($clause=1){
        return $this->db->query("SELECT * FROM registrasi_jurim WHERE ".$clause)->result();
    }

    public function cakupanBulanIni(){
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        
        $hb0 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $bcg = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $polio1 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $dpthb1 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $polio2 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $dpthb2 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $polio3 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $dpthb3 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $polio4 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $campak = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $imunisasi = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $tt1 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $tt2 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $tt3 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $tt4 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $tt5 = ['Lekor'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Saba'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pendem'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Setuta'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Jango'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Janapria'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Ketara'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Sengkol'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Kawo'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Tanak Awu'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Pengembur'=>array('l'=>rand(0,15),'p'=>rand(0,15)),'Segala Anyar'=>array('l'=>rand(0,15),'p'=>rand(0,15))];
        $uci = $this->user;
        
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '2016-03' AND hb1_kurang_7_hari < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("bcg_pol_1 > '2016-03' AND bcg_pol_1 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '2016-03' AND dpt_1_pol_2 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '2016-03' AND dpt_2_pol_3 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '2016-03' AND dpt_3_pol_4_ipv < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_campak > '2016-01' AND imunisasi_campak < '2016-08'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '2016-01' AND imunisasi_lengkap < '2016-08'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function akumulasiBulanIni(){
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        
        $hb0 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $bcg = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $polio1 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $dpthb1 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $polio2 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $dpthb2 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $polio3 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $dpthb3 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $polio4 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $campak = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $imunisasi = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $tt1 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $tt2 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $tt3 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $tt4 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $tt5 = ['Lekor'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Saba'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pendem'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Setuta'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Jango'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Janapria'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Ketara'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Sengkol'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Kawo'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Tanak Awu'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Pengembur'=>array('l'=>rand(0,50),'p'=>rand(0,50)),'Segala Anyar'=>array('l'=>rand(0,50),'p'=>rand(0,50))];
        $uci = $this->user;
        
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '2016-01' AND hb1_kurang_7_hari < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("bcg_pol_1 > '2016-01' AND bcg_pol_1 < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '2016-01' AND dpt_1_pol_2 < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '2016-01' AND dpt_2_pol_3 < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '2016-01' AND dpt_3_pol_4_ipv < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['l'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['p'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_campak > '2016-01' AND imunisasi_campak < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '2016-01' AND imunisasi_lengkap < '2016-09'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['l'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['p'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function bulanIniVsBulanLalu(){
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        $user   =  ['Lekor'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Saba'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Pendem'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Setuta'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Jango'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Janapria'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Ketara'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Sengkol'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Kawo'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Tanak Awu'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Pengembur'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Segala Anyar'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0)];
        $hb0 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))]; 
        $bcg = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio4 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $campak = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $imunisasi = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))]; 
        $tt3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt4 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))]; 
        $tt5 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $uci = $user; 
        
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '2016-02' AND hb1_kurang_7_hari < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '2016-03' AND hb1_kurang_7_hari < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_stack_name']=array("Bulan Lalu","Bulan Ini");
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("bcg_pol_1 > '2016-02' AND bcg_pol_1 < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("bcg_pol_1 > '2016-03' AND bcg_pol_1 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '2016-02' AND dpt_1_pol_2 < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '2016-03' AND dpt_1_pol_2 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '2016-02' AND dpt_2_pol_3 < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '2016-03' AND dpt_2_pol_3 < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '2016-02' AND dpt_3_pol_4_ipv < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '2016-03' AND dpt_3_pol_4_ipv < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_campak > '2016-02' AND imunisasi_campak < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("imunisasi_campak > '2016-03' AND imunisasi_campak < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '2016-02' AND imunisasi_lengkap < '2016-03'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '2016-03' AND imunisasi_lengkap < '2016-04'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function tahunIniVsTahunLalu($bulan){
        $thismonth = $this->getBulanNum($bulan);
        $thisyear = date("Y");
        $lastyear = date("Y", strtotime("-1 year"));
        $startdate1 = date("Y-m",  strtotime($lastyear."-".$thismonth));
        $enddate1 = date("Y-m",  strtotime($startdate1." +1 month"));
        $startdate2 = date("Y-m",  strtotime($thisyear."-".$thismonth));
        $enddate2 = date("Y-m",  strtotime($startdate2." +1 month"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        $user   =  ['Lekor'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Saba'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Pendem'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Setuta'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Jango'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Janapria'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Ketara'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Sengkol'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Kawo'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Tanak Awu'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Pengembur'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Segala Anyar'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0)];
        $hb0 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $bcg = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $dpthb3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $polio4 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $campak = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $imunisasi = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt1 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt2 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))]; 
        $tt3 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $tt4 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))]; 
        $tt5 = ['Lekor'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Saba'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pendem'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Setuta'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Jango'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Janapria'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Ketara'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Sengkol'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Kawo'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Tanak Awu'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Pengembur'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15)),'Segala Anyar'=>array('lbl'=>rand(0,15),'pbl'=>rand(0,15),'lbi'=>rand(0,15),'pbi'=>rand(0,15))];
        $uci = $user; 
        
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '".$startdate1."' AND hb1_kurang_7_hari < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("hb1_kurang_7_hari > '".$startdate2."' AND hb1_kurang_7_hari < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $hb0[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $hb0[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_stack_name']=array("Tahun Lalu","Tahun Ini");
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("bcg_pol_1 > '".$startdate1."' AND bcg_pol_1 < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("bcg_pol_1 > '".$startdate2."' AND bcg_pol_1 < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->bcg_pol_1!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $bcg[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio1[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $bcg[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio1[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '".$startdate1."' AND dpt_1_pol_2 < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_1_pol_2 > '".$startdate2."' AND dpt_1_pol_2 < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_1_pol_2!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb1[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio2[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb1[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio2[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '".$startdate1."' AND dpt_2_pol_3 < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_2_pol_3 > '".$startdate2."' AND dpt_2_pol_3 < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_2_pol_3!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb2[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio3[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb2[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio3[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '".$startdate1."' AND dpt_3_pol_4_ipv < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['lbl'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['pbl'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("dpt_3_pol_4_ipv > '".$startdate2."' AND dpt_3_pol_4_ipv < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->dpt_3_pol_4_ipv!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $dpthb3[$this->user_village['vaksinator12']]['lbi'] +=1;  
                    $polio4[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $dpthb3[$this->user_village['vaksinator12']]['pbi'] +=1;
                    $polio4[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_campak > '".$startdate1."' AND imunisasi_campak < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("imunisasi_campak > '".$startdate2."' AND imunisasi_campak < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_campak!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '".$startdate1."' AND imunisasi_lengkap < '".$enddate1."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbl'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbl'] +=1;
                }
            }
        }
        $datavisit = $this->getDataVisit("imunisasi_lengkap > '".$startdate2."' AND imunisasi_lengkap < '".$enddate2."'");
        foreach ($datavisit as $dvisit){
            if($dvisit->imunisasi_lengkap!=""){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'")->row()->jk;
                if($jk=="laki-laki"){
                    $campak[$this->user_village['vaksinator12']]['lbi'] +=1;   
                }elseif($jk=="perempuan"){
                    $campak[$this->user_village['vaksinator12']]['pbi'] +=1;
                }
            }
        }
        $form = $this->user;
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $form = $this->user;
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    private function getBulanNum($bulan){
        if($bulan=="januari"){
            return 1;
        }elseif($bulan=="februari"){
            return 2;
        }elseif($bulan=="maret"){
            return 3;
        }elseif($bulan=="april"){
            return 4;
        }elseif($bulan=="mei"){
            return 5;
        }elseif($bulan=="juni"){
            return 6;
        }elseif($bulan=="juli"){
            return 7;
        }elseif($bulan=="agustus"){
            return 8;
        }elseif($bulan=="september"){
            return 9;
        }elseif($bulan=="oktober"){
            return 10;
        }elseif($bulan=="november"){
            return 11;
        }elseif($bulan=="desember"){
            return 12;
        }
    }
    
    private function numToText($num){
        if($num<10){
            return "0".$num;
        }else{
            return $num;
        }
    }
    
}