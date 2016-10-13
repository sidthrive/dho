<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanPwsModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('analytics', TRUE);
        $this->load->library('PHPExcell');
        $this->load->model('PHPExcelModel');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    private function isHaveDoneAnc4($bumil){
        if($this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' AND ancDate < '$bumil->ancDate' AND ancKe=4")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHaveDoneAnc1($bumil){
        if($this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' AND ancDate < '$bumil->ancDate' AND ancKe=1 AND kunjunganKe=1")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHRP($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' AND ancDate < '$bumil->ancDate' ORDER BY ancDate")->result();
        $no = 0;
        foreach ($ancvisit as $visit){
            if($visit->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                    ||$visit->highRiskPregnancyPIH=="yes"
                    ||$visit->highRisklabourFetusNumber=="yes"
                    ||$visit->highRiskLabourFetusSize=="yes"
                    ||$visit->highRiskLabourFetusMalpresentation=="yes"){
                return true;
            }
            $no++;
        }
        if($no>0){
            $bumildata = $this->db->query("SELECT * FROM kartu_anc_registration WHERE motherId='$bumil->motherId'")->result();
            foreach ($bumildata as $bum){
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
        return false;
    }

    public function kia1($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $user_index   =  ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
            $result['bumil']  =  [230,199,163,85,81,199];
            $result['bulin']  =  [220,190,161,81,78,190];
            $result['bufas']  =  [220,190,161,81,78,190];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $user_index   =  ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $result['bumil']  =  [101,259,224,217,221,72];
            $result['bulin']  =  [97,247,214,207,211,69];
            $result['bufas']  =  [97,247,214,207,211,69];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['cakupan_k1_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_k1_bulan_ini'] = [0,0,0,0,0,0];
        $result['cakupan_k4_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_k4_bulan_ini'] = [0,0,0,0,0,0];
        $result['cakupan_resiko_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_resiko_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['cakupan_k1_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['cakupan_k1_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['cakupan_k4_bulan_lalu']=['L11','L12','L13','L14','L15','L16'];
        $result_index['cakupan_k4_bulan_ini']=['M11','M12','M13','M14','M15','M16'];
        $result_index['cakupan_resiko_bulan_lalu']=['Q11','Q12','Q13','Q14','Q15','Q16'];
        $result_index['cakupan_resiko_bulan_ini']=['R11','R12','R13','R14','R15','R16'];
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        $datak1 = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$startdate') AND (ancKe=1 AND kunjunganKe=1) group by motherId")->result();
        foreach ($datak1 as $k1){
            if(array_key_exists($k1->userID, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->userID],$result['desa']);
                    $result['cakupan_k1_bulan_lalu'][$key] += 1;
                }
            }
        }
        
        $datak1 = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by motherId")->result();
        foreach ($datak1 as $k1){
            if(array_key_exists($k1->userID, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->userID],$result['desa']);
                    $result['cakupan_k1_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datak4 = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$startdate') AND ancKe=4 group by motherId")->result();
        foreach ($datak4 as $k4){
            if(array_key_exists($k4->userID, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->userID],$result['desa']);
                    $result['cakupan_k4_bulan_lalu'][$key] += 1;
                }
            }
        }
        $datak4 = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($datak4 as $k4){
            if(array_key_exists($k4->userID, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->userID],$result['desa']);
                    $result['cakupan_k4_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datakresiko = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$startdate')")->result();
        foreach ($datakresiko as $resiko){
            if(array_key_exists($resiko->userID, $user_index)){
                if(!$this->isHRP($resiko)){
                    if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                    ||$resiko->highRiskPregnancyPIH=="yes"
                    ||$resiko->highRisklabourFetusNumber=="yes"
                    ||$resiko->highRiskLabourFetusSize=="yes"
                    ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                        $key=array_search($user_index[$resiko->userID],$result['desa']);
                        $result['cakupan_resiko_bulan_lalu'][$key] += 1;
                    }else{
                        $bumildata = $this->db->query("SELECT * FROM kartu_anc_registration WHERE motherId='$resiko->motherId'")->result();
                        foreach ($bumildata as $bum){
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
                                $key=array_search($user_index[$resiko->userID],$result['desa']);
                                $result['cakupan_resiko_bulan_lalu'][$key] += 1;
                            }
                        }
                    }
                }
            }
        }
        $datakresiko = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($datakresiko as $resiko){
            if(array_key_exists($resiko->userID, $user_index)){
                if(!$this->isHRP($resiko)){
                    if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                    ||$resiko->highRiskPregnancyPIH=="yes"
                    ||$resiko->highRisklabourFetusNumber=="yes"
                    ||$resiko->highRiskLabourFetusSize=="yes"
                    ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                        $key=array_search($user_index[$resiko->userID],$result['desa']);
                        $result['cakupan_resiko_bulan_ini'][$key] += 1;
                    }else{
                        $bumildata = $this->db->query("SELECT * FROM kartu_anc_registration WHERE motherId='$resiko->motherId'")->result();
                        foreach ($bumildata as $bum){
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
                                $key=array_search($user_index[$resiko->userID],$result['desa']);
                                $result['cakupan_resiko_bulan_ini'][$key] += 1;
                            }
                        }
                    }
                }
            }
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    private function isHaveKomplikasiBefore($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' AND ancDate < '$bumil->ancDate' ORDER BY ancDate")->result();
        foreach ($ancvisit as $visit){
            if($visit->komplikasidalamKehamilan!=''&&$visit->komplikasidalamKehamilan!='None'&&$visit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                return true;
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $user_index   =  ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
            $result['bumil']  =  [230,199,163,85,81,199];
            $result['bulin']  =  [220,190,161,81,78,190];
            $result['bufas']  =  [220,190,161,81,78,190];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $user_index   =  ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $result['bumil']  =  [101,259,224,217,221,72];
            $result['bulin']  =  [97,247,214,207,211,69];
            $result['bufas']  =  [97,247,214,207,211,69];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['komplikasi_bulan_lalu'] = [0,0,0,0,0,0];
        $result['komplikasi_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['komplikasi_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['komplikasi_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        $datakomplikasi = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$startdate')")->result();
        foreach ($datakomplikasi as $k1){
            if(array_key_exists($k1->userID, $user_index)){
                if(!$this->isHaveKomplikasiBefore($k1)){
                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        $key=array_search($user_index[$k1->userID],$result['desa']);
                        $result['komplikasi_bulan_lalu'][$key] += 1;
                    }
                }
            }
        }
        
        $datakomplikasi = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($datakomplikasi as $k1){
            if(array_key_exists($k1->userID, $user_index)){
                if(!$this->isHaveKomplikasiBefore($k1)){
                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        $key=array_search($user_index[$k1->userID],$result['desa']);
                        $result['komplikasi_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $user_index   =  ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
            $result['bumil']  =  [230,199,163,85,81,199];
            $result['bulin']  =  [220,190,161,81,78,190];
            $result['bufas']  =  [220,190,161,81,78,190];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $user_index   =  ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $result['bumil']  =  [101,259,224,217,221,72];
            $result['bulin']  =  [97,247,214,207,211,69];
            $result['bufas']  =  [97,247,214,207,211,69];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['linakes_L_bulan_lalu'] = [0,0,0,0,0,0];
        $result['linakes_P_bulan_lalu'] = [0,0,0,0,0,0];
        $result['linakes_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['linakes_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['nolinakes_L_bulan_lalu'] = [0,0,0,0,0,0];
        $result['nolinakes_P_bulan_lalu'] = [0,0,0,0,0,0];
        $result['nolinakes_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['nolinakes_P_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['linakes_L_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['linakes_P_bulan_lalu']=['H11','H12','H13','H14','H15','H16'];
        $result_index['linakes_L_bulan_ini']=['J11','J12','J13','J14','J15','J16'];
        $result_index['linakes_P_bulan_ini']=['K11','K12','K13','K14','K15','K16'];
        $result_index['nolinakes_L_bulan_lalu']=['P11','P12','P13','P14','P15','P16'];
        $result_index['nolinakes_P_bulan_lalu']=['Q11','Q12','Q13','Q14','Q15','Q16'];
        $result_index['nolinakes_L_bulan_ini']=['S11','S12','S13','S14','S15','S16'];
        $result_index['nolinakes_P_bulan_ini']=['T11','T12','T13','T14','T15','T16'];
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startyear' AND tanggalLahirAnak < '$startdate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['linakes_L_bulan_lalu'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['linakes_P_bulan_lalu'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['nolinakes_L_bulan_lalu'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['nolinakes_P_bulan_lalu'][$key] += 1;
                    }
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startyear' AND tanggalLahir < '$startdate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['linakes_L_bulan_lalu'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['linakes_P_bulan_lalu'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['nolinakes_L_bulan_lalu'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['nolinakes_P_bulan_lalu'][$key] += 1;
                    }
                }
            }
        }
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['linakes_L_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['linakes_P_bulan_ini'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['nolinakes_L_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['nolinakes_P_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startdate' AND tanggalLahir < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['linakes_L_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['linakes_P_bulan_ini'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['nolinakes_L_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['nolinakes_P_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
       
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $user_index   =  ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
            $result['bumil']  =  [230,199,163,85,81,199];
            $result['bulin']  =  [220,190,161,81,78,190];
            $result['bufas']  =  [220,190,161,81,78,190];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $user_index   =  ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $result['bumil']  =  [101,259,224,217,221,72];
            $result['bulin']  =  [97,247,214,207,211,69];
            $result['bufas']  =  [97,247,214,207,211,69];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['fasilitas_bulan_lalu'] = [0,0,0,0,0,0];
        $result['fasilitas_bulan_ini'] = [0,0,0,0,0,0];
        $result['k_nifas_bulan_lalu'] = [0,0,0,0,0,0];
        $result['k_nifas_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['fasilitas_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['fasilitas_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['k_nifas_bulan_lalu']=['L11','L12','L13','L14','L15','L16'];
        $result_index['k_nifas_bulan_ini']=['M11','M12','M13','M14','M15','M16'];
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startyear' AND tanggalLahirAnak < '$startdate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['fasilitas_bulan_lalu'][$key] += 1;
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startyear' AND tanggalLahir < '$startdate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['fasilitas_bulan_lalu'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startyear' AND referenceDate < '$startdate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_index)){
                $key=array_search($user_index[$dvisit->userID],$result['desa']);
                $result['k_nifas_bulan_ini'][$key] += 1;
            }
        }
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startdate' AND tanggalLahir < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_index)){
                $key=array_search($user_index[$dsalin->userID],$result['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_index)){
                $key=array_search($user_index[$dvisit->userID],$result['desa']);
                $result['k_nifas_bulan_ini'][$key] += 1;
            }
        }
        
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    private function isAnemia($bumil){
        $datalab = $this->db->query("SELECT * FROM kartu_anc_visit_labTest WHERE motherId='$bumil->motherId'")->result();
        foreach ($datalab as $data){
            if($data->laboratoriumPeriksaHbAnemia=='positif'||$data->highRiskPregnancyAnemia=='yes'){
                return true;
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $user_index   =  ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
            $result['bumil']  =  [230,199,163,85,81,199];
            $result['bulin']  =  [220,190,161,81,78,190];
            $result['bufas']  =  [220,190,161,81,78,190];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $user_index   =  ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
            $result['bumil']  =  [101,259,224,217,221,72];
            $result['bulin']  =  [97,247,214,207,211,69];
            $result['bufas']  =  [97,247,214,207,211,69];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['anemia_bulan_lalu'] = [0,0,0,0,0,0];
        $result['anemia_bulan_ini'] = [0,0,0,0,0,0];
        $result['kek_bulan_lalu'] = [0,0,0,0,0,0];
        $result['kek_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['anemia_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['anemia_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['kek_bulan_lalu']=['K11','K12','K13','K14','K15','K16'];
        $result_index['kek_bulan_ini']=['L11','L12','L13','L14','L15','L16'];
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration WHERE (referenceDate > '$startyear' AND referenceDate < '$startdate')")->result();
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->userID, $user_index)){
                $key=array_search($user_index[$ibu->userID],$result['desa']);
                if($this->isAnemia($ibu)){
                    $result['anemia_bulan_lalu'][$key] += 1;
                }
                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
                    $result['kek_bulan_lalu'][$key] += 1;
                }
            }
        }
        
        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate')")->result();
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->userID, $user_index)){
                $key=array_search($user_index[$ibu->userID],$result['desa']);
                if($this->isAnemia($ibu)){
                    $result['anemia_bulan_ini'][$key] += 1;
                }
                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
                    $result['kek_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu5.xlsx",$result,$result_index);
    }
    
    public function bayi($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus1_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_P_komulatif'] = [0,0,0,0,0,0];
        
        $result['kasus2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus2_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_P_komulatif'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B12','B13','B14','B15','B16','B17'];
        $result_index['kasus1_L_bulan_ini']=['C12','C13','C14','C15','C16','C17'];
        $result_index['kasus1_P_bulan_ini']=['D12','D13','D14','D15','D16','D17'];
        $result_index['kasus1_L_komulatif']=['F12','F13','F14','F15','F16','F17'];
        $result_index['kasus1_P_komulatif']=['G12','G13','G14','G15','G16','G17'];
        $result_index['mati1_L_bulan_ini']=['I12','I13','I14','I15','I16','I17'];
        $result_index['mati1_P_bulan_ini']=['J12','J13','J14','J15','J16','J17'];
        $result_index['mati1_L_komulatif']=['L12','L13','L14','L15','L16','L17'];
        $result_index['mati1_P_komulatif']=['M12','M13','M14','M15','M16','M17'];
        
        $result_index['kasus2_L_bulan_ini']=['O12','O13','O14','O15','O16','O17'];
        $result_index['kasus2_P_bulan_ini']=['P12','P13','P14','P15','P16','P17'];
        $result_index['kasus2_L_komulatif']=['R12','R13','R14','R15','R16','R17'];
        $result_index['kasus2_P_komulatif']=['S12','S13','S14','S15','S16','S17'];
        $result_index['mati2_L_bulan_ini']=['U12','U13','U14','U15','U16','U17'];
        $result_index['mati2_P_bulan_ini']=['V12','V13','V14','V15','V16','V17'];
        $result_index['mati2_L_komulatif']=['X12','X13','X14','X15','X16','X17'];
        $result_index['mati2_P_komulatif']=['Y12','Y13','Y14','Y15','Y16','Y17'];
        
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus1_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_P_komulatif'] = [0,0,0,0,0,0];
        
        $result['kasus2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus2_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_P_komulatif'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B12','B13','B14','B15','B16','B17'];
        $result_index['kasus1_L_bulan_ini']=['C12','C13','C14','C15','C16','C17'];
        $result_index['kasus1_P_bulan_ini']=['D12','D13','D14','D15','D16','D17'];
        $result_index['kasus1_L_komulatif']=['F12','F13','F14','F15','F16','F17'];
        $result_index['kasus1_P_komulatif']=['G12','G13','G14','G15','G16','G17'];
        $result_index['mati1_L_bulan_ini']=['I12','I13','I14','I15','I16','I17'];
        $result_index['mati1_P_bulan_ini']=['J12','J13','J14','J15','J16','J17'];
        $result_index['mati1_L_komulatif']=['L12','L13','L14','L15','L16','L17'];
        $result_index['mati1_P_komulatif']=['M12','M13','M14','M15','M16','M17'];
        
        $result_index['kasus2_L_bulan_ini']=['O12','O13','O14','O15','O16','O17'];
        $result_index['kasus2_P_bulan_ini']=['P12','P13','P14','P15','P16','P17'];
        $result_index['kasus2_L_komulatif']=['R12','R13','R14','R15','R16','R17'];
        $result_index['kasus2_P_komulatif']=['S12','S13','S14','S15','S16','S17'];
        $result_index['mati2_L_bulan_ini']=['U12','U13','U14','U15','U16','U17'];
        $result_index['mati2_P_bulan_ini']=['V12','V13','V14','V15','V16','V17'];
        $result_index['mati2_L_komulatif']=['X12','X13','X14','X15','X16','X17'];
        $result_index['mati2_P_komulatif']=['Y12','Y13','Y14','Y15','Y16','Y17'];
        
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
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
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_p4k.xlsx",$result,$result_index);
    }
    
    
}