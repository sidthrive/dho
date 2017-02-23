<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanEcPwsModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('analytics', TRUE);
        $this->load->library('PHPExcell');
        $this->load->model('PHPExcelModel');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    private function isHaveDoneAnc4($bumil){
        if($this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE baseEntityId='$bumil->baseEntityId' AND ancDate < '$bumil->ancDate' AND ancKe=4")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHaveDoneAnc1($bumil){
        if($this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE baseEntityId='$bumil->baseEntityId' AND ancDate < '$bumil->ancDate' AND ancKe=1 AND kunjunganKe=1")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHRP($bumil,$resiko,$bumildata){
        $no = 0;
        if(array_key_exists($bumil->baseEntityId, $resiko)){
            foreach ($resiko[$bumil->baseEntityId] as $visit){
                $thisanc = date("Y-m-d", strtotime($visit->ancDate));
                $bumilanc = date("Y-m-d", strtotime($bumil->ancDate));
                if($thisanc<$bumilanc){
                    if($visit->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                            ||$visit->highRiskPregnancyPIH=="yes"
                            ||$visit->highRisklabourFetusNumber=="yes"
                            ||$visit->highRiskLabourFetusSize=="yes"
                            ||$visit->highRiskLabourFetusMalpresentation=="yes"){
                        return true;
                    }
                    $no++;
                }
            }
        }
        
        if($no>0){
            if(array_key_exists($bumil->baseEntityId, $bumildata)){
                foreach ($bumildata[$bumil->baseEntityId] as $bum){
                    if($bum->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$bum->malariaRisk=="yes"
                        ||$bum->highRiskLabourTBRisk=="yes"
                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
                        ||$bum->HighRiskPregnancyAbortus=="yes"
                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
                        ||$bum->highRiskSTIBBVs=="yes"
                        ||$bum->highRiskEctopicPregnancy=="yes"
                        ||$bum->otherRiskMolaHidatidosa=="yes"
                        ||$bum->otherRiskCongenitalAbnormality=="yes"
                        ||$bum->otherRiskEarlyWaterbreak=="yes"
                        ||$bum->highRiskCardiovascularDiseaseRecord=="yes"
                        ||$bum->highRiskDidneyDisorder=="yes"
                        ||$bum->highRiskHeartDisorder=="yes"
                        ||$bum->highRiskAsthma=="yes"
                        ||$bum->highRiskTuberculosis=="yes"
                        ||$bum->highRiskMalaria=="yes"
                        ||$bum->highRiskHIVAIDS=="yes"){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    private function setArrayIndex($src,$col,$row_start){
        $ret = [];
        foreach ($src as $s){
            array_push($ret, $col.($row_start++));
        }
        return $ret;
    }

    public function kia1($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['cakupan_k1_bulan_lalu'] = array_fill(0,count($user),0);
        $result['cakupan_k1_bulan_ini'] = array_fill(0,count($user),0);
        $result['cakupan_k4_bulan_lalu'] = array_fill(0,count($user),0);
        $result['cakupan_k4_bulan_ini'] = array_fill(0,count($user),0);
        $result['cakupan_resiko_bulan_lalu'] = array_fill(0,count($user),0);
        $result['cakupan_resiko_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']= $this->setArrayIndex($user, 'B', 11);
        $result_index['cakupan_k1_bulan_lalu']=$this->setArrayIndex($user, 'G', 11);
        $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, 'H', 11);
        $result_index['cakupan_k4_bulan_lalu']=$this->setArrayIndex($user, 'L', 11);
        $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, 'M', 11);
        $result_index['cakupan_resiko_bulan_lalu']=$this->setArrayIndex($user, 'Q', 11);
        $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, 'R', 11);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'D', 11);
        $result_index['bufas'] = $this->setArrayIndex($user, 'E', 11);
        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startyear' AND ancDate < '$startdate') AND (ancKe=1 AND kunjunganKe=1) group by baseEntityId")->result();
//        foreach ($query as $k1){
//            if(array_key_exists($k1->userID, $user_index)){
//                if(!$this->isHaveDoneAnc1($k1)){
//                    $key=array_search($user_index[$k1->userID],$result['desa']);
//                    $result['cakupan_k1_bulan_lalu'][$key] += 1;
//                }
//            }
//        }
//        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by baseEntityId")->result();
//        foreach ($query as $k1){
//            if(array_key_exists($k1->userID, $user_index)){
//                if(!$this->isHaveDoneAnc1($k1)){
//                    $key=array_search($user_index[$k1->userID],$result['desa']);
//                    $result['cakupan_k1_bulan_ini'][$key] += 1;
//                }
//            }
//        }
//        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startyear' AND ancDate < '$startdate') AND ancKe=4 group by baseEntityId")->result();
//        foreach ($query as $k4){
//            if(array_key_exists($k4->userID, $user_index)){
//                if(!$this->isHaveDoneAnc4($k4)){
//                    $key=array_search($user_index[$k4->userID],$result['desa']);
//                    $result['cakupan_k4_bulan_lalu'][$key] += 1;
//                }
//            }
//        }
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by baseEntityId")->result();
//        foreach ($query as $k4){
//            if(array_key_exists($k4->userID, $user_index)){
//                if(!$this->isHaveDoneAnc4($k4)){
//                    $key=array_search($user_index[$k4->userID],$result['desa']);
//                    $result['cakupan_k4_bulan_ini'][$key] += 1;
//                }
//            }
//        }
//        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startyear' AND ancDate < '$startdate')")->result();
//        $query2 = $this->db->query("SELECT userID,baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc ORDER BY ancDate")->result();
//        $resikos = [];
//        foreach ($query2 as $q){
//            if(!array_key_exists($q->baseEntityId, $resikos)){
//                $resikos[$q->baseEntityId] = [];
//                array_push($resikos[$q->baseEntityId], $q);
//            }else{
//                array_push($resikos[$q->baseEntityId], $q);
//            }
//        }
//        $query2 = $this->db->query("SELECT baseEntityId,"
//                . "highRiskPregnancyProteinEnergyMalnutrition,"
//                . "malariaRisk,"
//                . "highRiskLabourTBRisk,"
//                . "HighRiskPregnancyTooManyChildren,"
//                . "HighRiskPregnancyAbortus,"
//                . "HighRiskLabourSectionCesareaRecord,"
//                . "highRiskSTIBBVs,"
//                . "highRiskEctopicPregnancy,"
//                . "otherRiskMolaHidatidosa,"
//                . "otherRiskCongenitalAbnormality,"
//                . "otherRiskEarlyWaterbreak,"
//                . "highRiskCardiovascularDiseaseRecord,"
//                . "highRiskDidneyDisorder,"
//                . "highRiskHeartDisorder,"
//                . "highRiskAsthma,"
//                . "highRiskTuberculosis,"
//                . "highRiskMalaria,"
//                . "highRiskHIVAIDS FROM kartu_anc_registration")->result();
//        $bumildata = [];
//        foreach ($query2 as $q){
//            if(!array_key_exists($q->baseEntityId, $bumildata)){
//                $bumildata[$q->baseEntityId] = [];
//                array_push($bumildata[$q->baseEntityId], $q);
//            }
//        }
//        $bumil = [];
//        foreach ($query as $resiko){
//            if(array_key_exists($resiko->userID, $user_index)){
//                if(!array_key_exists($resiko->baseEntityId, $bumil)){
//                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
//                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
//                        ||$resiko->highRiskPregnancyPIH=="yes"
//                        ||$resiko->highRisklabourFetusNumber=="yes"
//                        ||$resiko->highRiskLabourFetusSize=="yes"
//                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
//                            $key=array_search($user_index[$resiko->userID],$result['desa']);
//                            $result['cakupan_resiko_bulan_lalu'][$key] += 1;
//                            $bumil[$resiko->baseEntityId] = 'yes';
//                        }else{
//                            if(array_key_exists($resiko->baseEntityId, $bumildata)){
//                                foreach ($bumildata[$resiko->baseEntityId] as $bum){
//                                    if($bum->highRiskPregnancyProteinEnergyMalnutrition=="yes"
//                                        ||$bum->malariaRisk=="yes"
//                                        ||$bum->highRiskLabourTBRisk=="yes"
//                                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
//                                        ||$bum->HighRiskPregnancyAbortus=="yes"
//                                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
//                                        ||$bum->highRiskSTIBBVs=="yes"
//                                        ||$bum->highRiskEctopicPregnancy=="yes"
//                                        ||$bum->otherRiskMolaHidatidosa=="yes"
//                                        ||$bum->otherRiskCongenitalAbnormality=="yes"
//                                        ||$bum->otherRiskEarlyWaterbreak=="yes"
//                                        ||$bum->highRiskCardiovascularDiseaseRecord=="yes"
//                                        ||$bum->highRiskDidneyDisorder=="yes"
//                                        ||$bum->highRiskHeartDisorder=="yes"
//                                        ||$bum->highRiskAsthma=="yes"
//                                        ||$bum->highRiskTuberculosis=="yes"
//                                        ||$bum->highRiskMalaria=="yes"
//                                        ||$bum->highRiskHIVAIDS=="yes"){
//                                        $key=array_search($user_index[$resiko->userID],$result['desa']);
//                                        $result['cakupan_resiko_bulan_lalu'][$key] += 1;
//                                        $bumil[$resiko->baseEntityId] = 'yes';
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
//        foreach ($query as $resiko){
//            if(array_key_exists($resiko->userID, $user_index)){
//                if(!array_key_exists($resiko->baseEntityId, $bumil)){
//                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
//                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
//                        ||$resiko->highRiskPregnancyPIH=="yes"
//                        ||$resiko->highRisklabourFetusNumber=="yes"
//                        ||$resiko->highRiskLabourFetusSize=="yes"
//                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
//                            $key=array_search($user_index[$resiko->userID],$result['desa']);
//                            $result['cakupan_resiko_bulan_ini'][$key] += 1;
//                            $bumil[$resiko->baseEntityId] = 'yes';
//                        }else{
//                            if(array_key_exists($resiko->baseEntityId, $bumildata)){
//                                foreach ($bumildata[$resiko->baseEntityId] as $bum){
//                                    if($bum->highRiskPregnancyProteinEnergyMalnutrition=="yes"
//                                        ||$bum->malariaRisk=="yes"
//                                        ||$bum->highRiskLabourTBRisk=="yes"
//                                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
//                                        ||$bum->HighRiskPregnancyAbortus=="yes"
//                                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
//                                        ||$bum->highRiskSTIBBVs=="yes"
//                                        ||$bum->highRiskEctopicPregnancy=="yes"
//                                        ||$bum->otherRiskMolaHidatidosa=="yes"
//                                        ||$bum->otherRiskCongenitalAbnormality=="yes"
//                                        ||$bum->otherRiskEarlyWaterbreak=="yes"
//                                        ||$bum->highRiskCardiovascularDiseaseRecord=="yes"
//                                        ||$bum->highRiskDidneyDisorder=="yes"
//                                        ||$bum->highRiskHeartDisorder=="yes"
//                                        ||$bum->highRiskAsthma=="yes"
//                                        ||$bum->highRiskTuberculosis=="yes"
//                                        ||$bum->highRiskMalaria=="yes"
//                                        ||$bum->highRiskHIVAIDS=="yes"){
//                                        $key=array_search($user_index[$resiko->userID],$result['desa']);
//                                        $result['cakupan_resiko_bulan_ini'][$key] += 1;
//                                        $bumil[$resiko->baseEntityId] = 'yes';
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    private function isHaveKomplikasiBefore($bumil,$komplikasi){
        if(array_key_exists($bumil->baseEntityId, $komplikasi)){
            foreach ($komplikasi[$bumil->baseEntityId] as $visit){
                $thisanc = date("Y-m-d", strtotime($visit->ancDate));
                $bumilanc = date("Y-m-d", strtotime($bumil->ancDate));
                if($thisanc<$bumilanc){
                    if($visit->komplikasidalamKehamilan!=''&&$visit->komplikasidalamKehamilan!='None'&&$visit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    public function kia2($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['komplikasi_bulan_lalu'] = array_fill(0,count($user),0);
        $result['komplikasi_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 11);
        $result_index['komplikasi_bulan_lalu']=$this->setArrayIndex($user, 'G', 11);
        $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, 'H', 11);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'D', 11);
        $result_index['bufas'] = $this->setArrayIndex($user, 'E', 11);
//        
//        $query2 = $this->db->query("SELECT baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc ORDER BY ancDate")->result();
//        $komplikasi = [];
//        foreach ($query2 as $q){
//            if(!array_key_exists($q->baseEntityId, $komplikasi)){
//                $komplikasi[$q->baseEntityId] = [];
//                array_push($komplikasi[$q->baseEntityId], $q);
//            }else{
//                array_push($komplikasi[$q->baseEntityId], $q);
//            }
//        }
//        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startyear' AND ancDate < '$startdate')")->result();
//        foreach ($query as $k1){
//            if(array_key_exists($k1->userID, $user_index)){
//                if(!$this->isHaveKomplikasiBefore($k1,$komplikasi)){
//                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
//                        $key=array_search($user_index[$k1->userID],$result['desa']);
//                        $result['komplikasi_bulan_lalu'][$key] += 1;
//                    }
//                }
//            }
//        }
//        
//        $query = $this->db->query("SELECT userID,baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
//        foreach ($query as $k1){
//            if(array_key_exists($k1->userID, $user_index)){
//                if(!$this->isHaveKomplikasiBefore($k1,$komplikasi)){
//                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
//                        $key=array_search($user_index[$k1->userID],$result['desa']);
//                        $result['komplikasi_bulan_ini'][$key] += 1;
//                    }
//                }
//            }
//        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu2.xlsx",$result,$result_index);
    }
    
    public function kia3($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['linakes_L_bulan_lalu'] = array_fill(0,count($user),0);
        $result['linakes_P_bulan_lalu'] = array_fill(0,count($user),0);
        $result['linakes_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['linakes_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['nolinakes_L_bulan_lalu'] = array_fill(0,count($user),0);
        $result['nolinakes_P_bulan_lalu'] = array_fill(0,count($user),0);
        $result['nolinakes_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['nolinakes_P_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 11);
        $result_index['linakes_L_bulan_lalu']=$this->setArrayIndex($user, 'G', 11);
        $result_index['linakes_P_bulan_lalu']=$this->setArrayIndex($user, 'H', 11);
        $result_index['linakes_L_bulan_ini']=$this->setArrayIndex($user, 'J', 11);
        $result_index['linakes_P_bulan_ini']=$this->setArrayIndex($user, 'K', 11);
        $result_index['nolinakes_L_bulan_lalu']=$this->setArrayIndex($user, 'P', 11);
        $result_index['nolinakes_P_bulan_lalu']=$this->setArrayIndex($user, 'Q', 11);
        $result_index['nolinakes_L_bulan_ini']=$this->setArrayIndex($user, 'S', 11);
        $result_index['nolinakes_P_bulan_ini']=$this->setArrayIndex($user, 'T', 11);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'D', 11);
        $result_index['bufas'] = $this->setArrayIndex($user, 'E', 11);
//        
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startyear' AND tanggalLahirAnak < '$startdate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['linakes_L_bulan_lalu'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['linakes_P_bulan_lalu'][$key] += 1;
//                    }
//                }else{
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['nolinakes_L_bulan_lalu'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['nolinakes_P_bulan_lalu'][$key] += 1;
//                    }
//                }
//            }
//        }
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startyear' AND tanggalLahir < '$startdate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['linakes_L_bulan_lalu'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['linakes_P_bulan_lalu'][$key] += 1;
//                    }
//                }else{
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['nolinakes_L_bulan_lalu'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['nolinakes_P_bulan_lalu'][$key] += 1;
//                    }
//                }
//            }
//        }
//        
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['linakes_L_bulan_ini'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['linakes_P_bulan_ini'][$key] += 1;
//                    }
//                }else{
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['nolinakes_L_bulan_ini'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['nolinakes_P_bulan_ini'][$key] += 1;
//                    }
//                }
//            }
//        }
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startdate' AND tanggalLahir < '$enddate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['linakes_L_bulan_ini'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['linakes_P_bulan_ini'][$key] += 1;
//                    }
//                }else{
//                    if($dsalin->jenisKelamin=='laki'){
//                        $result['nolinakes_L_bulan_ini'][$key] += 1;
//                    }elseif($dsalin->jenisKelamin=='perempuan'){
//                        $result['nolinakes_P_bulan_ini'][$key] += 1;
//                    }
//                }
//            }
//        }
       
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu3.xlsx",$result,$result_index);
    }
    
    public function kia4($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['fasilitas_bulan_lalu'] = array_fill(0,count($user),0);
        $result['fasilitas_bulan_ini'] = array_fill(0,count($user),0);
        $result['k_nifas_bulan_lalu'] = array_fill(0,count($user),0);
        $result['k_nifas_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 11);
        $result_index['fasilitas_bulan_lalu']=$this->setArrayIndex($user, 'G', 11);
        $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, 'H', 11);
        $result_index['k_nifas_bulan_lalu']=$this->setArrayIndex($user, 'L', 11);
        $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, 'M', 11);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'D', 11);
        $result_index['bufas'] = $this->setArrayIndex($user, 'E', 11);
//        
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startyear' AND tanggalLahirAnak < '$startdate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
//                    $result['fasilitas_bulan_lalu'][$key] += 1;
//                }
//            }
//        }
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startyear' AND tanggalLahir < '$startdate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
//                    $result['fasilitas_bulan_lalu'][$key] += 1;
//                }
//            }
//        }
//        
//        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startyear' AND referenceDate < '$startdate') AND hariKeKF='kf4' group by baseEntityId")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $user_index)){
//                $key=array_search($user_index[$dvisit->userID],$result['desa']);
//                $result['k_nifas_bulan_ini'][$key] += 1;
//            }
//        }
//        
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
//                    $result['fasilitas_bulan_ini'][$key] += 1;
//                }
//            }
//        }
//        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startdate' AND tanggalLahir < '$enddate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->userID, $user_index)){
//                $key=array_search($user_index[$dsalin->userID],$result['desa']);
//                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
//                    $result['fasilitas_bulan_ini'][$key] += 1;
//                }
//            }
//        }
//        
//        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') AND hariKeKF='kf4' group by baseEntityId")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $user_index)){
//                $key=array_search($user_index[$dvisit->userID],$result['desa']);
//                $result['k_nifas_bulan_ini'][$key] += 1;
//            }
//        }
        
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    private function isAnemia($bumil,$datalabs){
        if(array_key_exists($bumil->baseEntityId, $datalabs)){
            foreach ($datalabs[$bumil->baseEntityId] as $data){
                if($data->laboratoriumPeriksaHbAnemia=='positif'||$data->highRiskPregnancyAnemia=='yes'){
                    return true;
                }
            }
        }
        return false;
    }
    
    public function kia5($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['anemia_bulan_lalu'] = array_fill(0,count($user),0);
        $result['anemia_bulan_ini'] = array_fill(0,count($user),0);
        $result['kek_bulan_lalu'] = array_fill(0,count($user),0);
        $result['kek_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 11);
        $result_index['anemia_bulan_lalu']=$this->setArrayIndex($user, 'G', 11);
        $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, 'H', 11);
        $result_index['kek_bulan_lalu']=$this->setArrayIndex($user, 'K', 11);
        $result_index['kek_bulan_ini']=$this->setArrayIndex($user, 'L', 11);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'D', 11);
        $result_index['bufas'] = $this->setArrayIndex($user, 'E', 11);
//        
//        $query2 = $this->db->query("SELECT baseEntityId,laboratoriumPeriksaHbAnemia,highRiskPregnancyAnemia FROM event_bidan_kunjungan_anc_labTest")->result();
//        $datalabs = [];
//        foreach ($query2 as $q){
//            if(!array_key_exists($q->baseEntityId, $datalabs)){
//                $datalabs[$q->baseEntityId] = [];
//                array_push($datalabs[$q->baseEntityId], $q);
//            }else{
//                array_push($datalabs[$q->baseEntityId], $q);
//            }
//        }
//        
//        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration WHERE (referenceDate > '$startyear' AND referenceDate < '$startdate')")->result();
//        foreach ($dataibu as $ibu){
//            if(array_key_exists($ibu->userID, $user_index)){
//                $key=array_search($user_index[$ibu->userID],$result['desa']);
//                if($this->isAnemia($ibu,$datalabs)){
//                    $result['anemia_bulan_lalu'][$key] += 1;
//                }
//                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
//                    $result['kek_bulan_lalu'][$key] += 1;
//                }
//            }
//        }
//        
//        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate')")->result();
//        foreach ($dataibu as $ibu){
//            if(array_key_exists($ibu->userID, $user_index)){
//                $key=array_search($user_index[$ibu->userID],$result['desa']);
//                if($this->isAnemia($ibu,$datalabs)){
//                    $result['anemia_bulan_ini'][$key] += 1;
//                }
//                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
//                    $result['kek_bulan_ini'][$key] += 1;
//                }
//            }
//        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu5.xlsx",$result,$result_index);
    }
    
    public function bayi($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($user),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 12);
        $result_index['kasus1_L_bulan_ini']=$this->setArrayIndex($user, 'C', 12);
        $result_index['kasus1_P_bulan_ini']=$this->setArrayIndex($user, 'D', 12);
        $result_index['kasus1_L_komulatif']=$this->setArrayIndex($user, 'F', 12);
        $result_index['kasus1_P_komulatif']=$this->setArrayIndex($user, 'G', 12);
        $result_index['mati1_L_bulan_ini']=$this->setArrayIndex($user, 'I', 12);
        $result_index['mati1_P_bulan_ini']=$this->setArrayIndex($user, 'J', 12);
        $result_index['mati1_L_komulatif']=$this->setArrayIndex($user, 'L', 12);
        $result_index['mati1_P_komulatif']=$this->setArrayIndex($user, 'M', 12);
        
        $result_index['kasus2_L_bulan_ini']=$this->setArrayIndex($user, 'O', 12);
        $result_index['kasus2_P_bulan_ini']=$this->setArrayIndex($user, 'P', 12);
        $result_index['kasus2_L_komulatif']=$this->setArrayIndex($user, 'R', 12);
        $result_index['kasus2_P_komulatif']=$this->setArrayIndex($user, 'S', 12);
        $result_index['mati2_L_bulan_ini']=$this->setArrayIndex($user, 'U', 12);
        $result_index['mati2_P_bulan_ini']=$this->setArrayIndex($user, 'V', 12);
        $result_index['mati2_L_komulatif']=$this->setArrayIndex($user, 'X', 12);
        $result_index['mati2_P_komulatif']=$this->setArrayIndex($user, 'Y', 12);
        
//        try{
//            $dataanemia = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_anemia'.$namefile,'A2:E8');
//            $datakek = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_kek'.$namefile,'A2:E8');
//
//            foreach ($dataanemia as $anemia){
//                if(array_search($anemia['C'],$result['desa'])>=0){
//                    $key=array_search($anemia['C'],$result['desa']);
//                    $result['anemia_bulan_lalu'][$key] += (int)$anemia['B'];
//                    $result['anemia_bulan_ini'][$key] += (int)$anemia['E'];
//                }
//            }
//            foreach ($datakek as $kek){
//                if(array_search($kek['C'],$result['desa'])>=0){
//                    $key=array_search($kek['C'],$result['desa']);
//                    $result['kek_bulan_lalu'][$key] += (int)$kek['B'];
//                    $result['kek_bulan_ini'][$key] += (int)$kek['E'];
//                }
//            }
//        } catch (Exception $ex) {
//            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
//            //redirect("laporan/downloadbidanpws");
//        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function balita($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($user),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 12);
        $result_index['kasus1_L_bulan_ini']=$this->setArrayIndex($user, 'C', 12);
        $result_index['kasus1_P_bulan_ini']=$this->setArrayIndex($user, 'D', 12);
        $result_index['kasus1_L_komulatif']=$this->setArrayIndex($user, 'F', 12);
        $result_index['kasus1_P_komulatif']=$this->setArrayIndex($user, 'G', 12);
        $result_index['mati1_L_bulan_ini']=$this->setArrayIndex($user, 'I', 12);
        $result_index['mati1_P_bulan_ini']=$this->setArrayIndex($user, 'J', 12);
        $result_index['mati1_L_komulatif']=$this->setArrayIndex($user, 'L', 12);
        $result_index['mati1_P_komulatif']=$this->setArrayIndex($user, 'M', 12);
        
        $result_index['kasus2_L_bulan_ini']=$this->setArrayIndex($user, 'O', 12);
        $result_index['kasus2_P_bulan_ini']=$this->setArrayIndex($user, 'P', 12);
        $result_index['kasus2_L_komulatif']=$this->setArrayIndex($user, 'R', 12);
        $result_index['kasus2_P_komulatif']=$this->setArrayIndex($user, 'S', 12);
        $result_index['mati2_L_bulan_ini']=$this->setArrayIndex($user, 'U', 12);
        $result_index['mati2_P_bulan_ini']=$this->setArrayIndex($user, 'V', 12);
        $result_index['mati2_L_komulatif']=$this->setArrayIndex($user, 'X', 12);
        $result_index['mati2_P_komulatif']=$this->setArrayIndex($user, 'Y', 12);
        
//        try{
//            $dataanemia = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_anemia'.$namefile,'A2:E8');
//            $datakek = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_kek'.$namefile,'A2:E8');
//
//            foreach ($dataanemia as $anemia){
//                if(array_search($anemia['C'],$result['desa'])>=0){
//                    $key=array_search($anemia['C'],$result['desa']);
//                    $result['anemia_bulan_lalu'][$key] += (int)$anemia['B'];
//                    $result['anemia_bulan_ini'][$key] += (int)$anemia['E'];
//                }
//            }
//            foreach ($datakek as $kek){
//                if(array_search($kek['C'],$result['desa'])>=0){
//                    $key=array_search($kek['C'],$result['desa']);
//                    $result['kek_bulan_lalu'][$key] += (int)$kek['B'];
//                    $result['kek_bulan_ini'][$key] += (int)$kek['E'];
//                }
//            }
//        } catch (Exception $ex) {
//            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
//            //redirect("laporan/downloadbidanpws");
//        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function maternal($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_amp.xlsx",$result,$result_index);
    }
    
    public function neonatal1($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_1.xlsx",$result,$result_index);
    }
    
    public function neonatal2($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_2.xlsx",$result,$result_index);
    }
    
    public function neonatal3($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_3.xlsx",$result,$result_index);
    }
    
    public function neonatal4($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_4.xlsx",$result,$result_index);
    }
    
    public function neonatal5($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_5.xlsx",$result,$result_index);
    }
    
    public function kb1($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_1.xlsx",$result,$result_index);
    }
    
    public function kb2($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_2.xlsx",$result,$result_index);
    }
    
    public function kb3($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_3.xlsx",$result,$result_index);
    }
    
    public function kb4($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_4.xlsx",$result,$result_index);
    }
    
    public function kb5($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_5.xlsx",$result,$result_index);
    }
    
    public function akb($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_akb.xlsx",$result,$result_index);
    }
    
    public function kih($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kih.xlsx",$result,$result_index);
    }
    
    public function p4k($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_p4k.xlsx",$result,$result_index);
    }
    
    
}