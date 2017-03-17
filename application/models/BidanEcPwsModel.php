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
                        ||$bum->highRiskLabourTBRisk=="yes"
                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
                        ||$bum->HighRiskPregnancyAbortus=="yes"
                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
                        ||$bum->highRiskEctopicPregnancy=="yes"
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
    
    public function kia($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col = ['januari'=>'D','februari'=>'E','maret'=>'F','april'=>'G','mei'=>'H','juni'=>'I','juli'=>'J','agustus'=>'K','september'=>'L','oktober'=>'M','november'=>'N','desember'=>'O'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA A']['bumil'] = array_fill(0,count($user),0);
        $result['data']['DATA A']['bulin'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']= $this->setArrayIndex($user, 'B', 6);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 6);
        $result_index['bulin'] = $this->setArrayIndex($user, 'E', 6);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = 'kec_'.strtoupper($kec);
        $target = $pwsdb->query("SELECT * FROM target WHERE loc_parent='$loc' AND tahun='$year'")->result();
        foreach ($target as $t){
            $lo = explode('desa_', $t->location);
            $l = ucwords(str_replace('_', ' ', $lo[1]));
            $key = array_search($l, $user);
            $result['data']['DATA A']['bumil'][$key] = $t->bumil;
            $result['data']['DATA A']['bulin'][$key] = $t->bulin;
        }
        $loc = "";
        foreach ($user as $u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($user)){
                $loc = $loc."location='$desa'";
            }else{
                $loc = $loc."location='$desa' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM kia WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('desa_', $d->location);
            $l = ucwords(str_replace('_', ' ', $lo[1]));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 7);
            $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 38);
            $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 69);
            $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 98);
            $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 127);
            $result_index['linakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 157);
            $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 188);
            $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 219);
            $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 252);
            $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 283);
            $result_index['kek_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 314);
            foreach ($d as $desa=>$d2){
                $key = array_search($desa, $user);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $kec = explode(" ",$result['kecamatan'][0]);
        $kecamatan = end($kec);
        $prev = prev($kec);
        while(!(count($prev)==0||$prev==':')){
            $kecamatan = $prev.'_'.$kecamatan;
            $prev = prev($kec);
        }
        $bt = explode(" ",$result['bulan'][0]);
        $tahun = end($bt);
        $bulan = prev($bt);
        $savedFileName = 'PWS-'.strtoupper($result['form'][0]).'-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }

    public function kia1($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col = ['januari'=>'D','februari'=>'E','maret'=>'F','april'=>'G','mei'=>'H','juni'=>'I','juli'=>'J','agustus'=>'K','september'=>'L','oktober'=>'M','november'=>'N','desember'=>'O'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['cakupan_k1_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_k4_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_resiko_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']= $this->setArrayIndex($user, 'B', 6);
        $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 7);
        $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 38);
        $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 69);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 11);
        $result_index['bulin'] = $this->setArrayIndex($user, 'E', 11);
        
        
        $result['data']['DATA']['komplikasi_bulan_ini'] = array_fill(0,count($user),0);
        $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 98);
        
        $result['data']['DATA']['komplikasi_tertangani_bulan_ini'] = array_fill(0,count($user),0);
        $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 127);
        
        $result['data']['DATA']['linakes_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['nolinakes_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['linakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 157);
        $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 188);
        
        $result['data']['DATA']['fasilitas_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['k_nifas_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 219);
        $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 252);
        
        $result['data']['DATA']['anemia_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kek_bulan_ini'] = array_fill(0,count($user),0);
        
        $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 283);
        $result_index['kek_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 314);
        
        $query = $this->db->query("SELECT locationId,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by baseEntityId")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->locationId, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->locationId],$result['data']['DATA A']['desa']);
                    $result['data']['DATA']['cakupan_k1_bulan_ini'][$key] += 1;
                }
            }
        }

        $query = $this->db->query("SELECT locationId,baseEntityId,ancDate FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by baseEntityId")->result();
        foreach ($query as $k4){
            if(array_key_exists($k4->locationId, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->locationId],$result['data']['DATA A']['desa']);
                    $result['data']['DATA']['cakupan_k4_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $query2 = $this->db->query("SELECT locationId,baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc ORDER BY ancDate")->result();
        $resikos = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $resikos)){
                $resikos[$q->baseEntityId] = [];
                array_push($resikos[$q->baseEntityId], $q);
            }else{
                array_push($resikos[$q->baseEntityId], $q);
            }
        }
        
        $query2 = $this->db->query("SELECT baseEntityId,"
                . "highRiskPregnancyProteinEnergyMalnutrition,"
                . "highRiskLabourTBRisk,"
                . "HighRiskPregnancyTooManyChildren,"
                . "HighRiskPregnancyAbortus,"
                . "HighRiskLabourSectionCesareaRecord,"
                . "highRiskEctopicPregnancy,"
                . "highRiskCardiovascularDiseaseRecord,"
                . "highRiskDidneyDisorder,"
                . "highRiskHeartDisorder,"
                . "highRiskAsthma,"
                . "highRiskTuberculosis,"
                . "highRiskMalaria,"
                . "highRiskHIVAIDS FROM event_bidan_tambah_anc")->result();
        $bumildata = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $bumildata)){
                $bumildata[$q->baseEntityId] = [];
                array_push($bumildata[$q->baseEntityId], $q);
            }
        }
        $bumil = [];
        $query = $this->db->query("SELECT locationId,baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $resiko){
            if(array_key_exists($resiko->locationId, $user_index)){
                if(!array_key_exists($resiko->baseEntityId, $bumil)){
                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$resiko->highRiskPregnancyPIH=="yes"
                        ||$resiko->highRisklabourFetusNumber=="yes"
                        ||$resiko->highRiskLabourFetusSize=="yes"
                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                            $key=array_search($user_index[$resiko->locationId],$result['data']['DATA A']['desa']);
                            $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                            $bumil[$resiko->baseEntityId] = 'yes';
                        }else{
                            if(array_key_exists($resiko->baseEntityId, $bumildata)){
                                foreach ($bumildata[$resiko->baseEntityId] as $bum){
                                    if($bum->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                                        ||$bum->highRiskLabourTBRisk=="yes"
                                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
                                        ||$bum->HighRiskPregnancyAbortus=="yes"
                                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
                                        ||$bum->highRiskEctopicPregnancy=="yes"
                                        ||$bum->highRiskCardiovascularDiseaseRecord=="yes"
                                        ||$bum->highRiskDidneyDisorder=="yes"
                                        ||$bum->highRiskHeartDisorder=="yes"
                                        ||$bum->highRiskAsthma=="yes"
                                        ||$bum->highRiskTuberculosis=="yes"
                                        ||$bum->highRiskMalaria=="yes"
                                        ||$bum->highRiskHIVAIDS=="yes"){
                                        $key=array_search($user_index[$resiko->locationId],$result['data']['DATA A']['desa']);
                                        $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                                        $bumil[$resiko->baseEntityId] = 'yes';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        $query2 = $this->db->query("SELECT baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc ORDER BY ancDate")->result();
        $komplikasi = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $komplikasi)){
                $komplikasi[$q->baseEntityId] = [];
                array_push($komplikasi[$q->baseEntityId], $q);
            }else{
                array_push($komplikasi[$q->baseEntityId], $q);
            }
        }
        
        $query = $this->db->query("SELECT locationId,baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->locationId, $user_index)){
                if(!$this->isHaveKomplikasiBefore($k1,$komplikasi)){
                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        $key=array_search($user_index[$k1->locationId],$result['data']['DATA A']['desa']);
                        $result['data']['DATA']['komplikasi_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        $datapersalinan= $this->db->query("SELECT event_bidan_dokumentasi_persalinan.* , client_anak.birthDate, client_anak.gender FROM event_bidan_dokumentasi_persalinan,client_anak WHERE event_bidan_dokumentasi_persalinan.baseEntityId = client_anak.ibuCaseId AND birthDate > '$startdate' AND birthDate < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->locationId, $user_index)){
                $key=array_search($user_index[$dsalin->locationId],$result['data']['DATA A']['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->gender=='male'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->gender=='female'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }
                }else{
                    if($dsalin->gender=='male'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->gender=='female'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        
        $datapersalinan= $this->db->query("SELECT event_bidan_dokumentasi_persalinan.* , client_anak.birthDate, client_anak.gender FROM event_bidan_dokumentasi_persalinan,client_anak WHERE event_bidan_dokumentasi_persalinan.baseEntityId = client_anak.ibuCaseId AND birthDate > '$startdate' AND birthDate < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->locationId, $user_index)){
                $key=array_search($user_index[$dsalin->locationId],$result['data']['DATA A']['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['data']['DATA']['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM event_bidan_kunjungan_pnc WHERE (PNCDate > '$startdate' AND PNCDate < '$enddate') AND hariKeKF='kf4' group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_index)){
                $key=array_search($user_index[$dvisit->locationId],$result['data']['DATA A']['desa']);
                $result['data']['DATA']['k_nifas_bulan_ini'][$key] += 1;
            }
        }
        
        $query2 = $this->db->query("SELECT baseEntityId,laboratoriumPeriksaHbAnemia,highRiskPregnancyAnemia FROM event_bidan_kunjungan_anc_lab_test")->result();
        $datalabs = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datalabs)){
                $datalabs[$q->baseEntityId] = [];
                array_push($datalabs[$q->baseEntityId], $q);
            }else{
                array_push($datalabs[$q->baseEntityId], $q);
            }
        }
        
        $dataibu = $this->db->query("SELECT * FROM event_bidan_tambah_anc WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate')")->result();
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->locationId, $user_index)){
                $key=array_search($user_index[$ibu->locationId],$result['data']['DATA A']['desa']);
                if($this->isAnemia($ibu,$datalabs)){
                    $result['data']['DATA']['anemia_bulan_ini'][$key] += 1;
                }
                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
                    $result['data']['DATA']['kek_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startyear' AND ancDate < '$enddate')")->result();
        $query = $this->db->query("SELECT baseEntityId FROM event_bidan_kunjungan_anc_lab_test WHERE laboratoriumPeriksaHbAnemia='positif'")->result();
        $laboratoriumPeriksaHbAnemia = [];
        foreach ($query as $q){
            if(!array_key_exists($q->baseEntityId, $laboratoriumPeriksaHbAnemia)){
                $laboratoriumPeriksaHbAnemia[$q->baseEntityId] = TRUE;
            }
        }
//        $query = $this->db->query("SELECT event_bidan_tambah_anc.baseEntityId as baseEntityId FROM event_bidan_tambah_anc,event_bidan_kunjungan_anc_integrasi WHERE event_bidan_tambah_anc.baseEntityId=event_bidan_kunjungan_anc_integrasi.baseEntityId AND event_bidan_tambah_anc.highRiskTuberculosis='yes' AND event_bidan_kunjungan_anc_integrasi.integrasiProgramtbObat='yes'")->result();
        $highRiskTuberculosis = [];
        foreach ($query as $q){
            if(!array_key_exists($q->baseEntityId, $highRiskTuberculosis)){
                $highRiskTuberculosis[$q->baseEntityId] = TRUE;
            }
        }
//        $query = $this->db->query("SELECT event_bidan_tambah_anc.baseEntityId as baseEntityId FROM event_bidan_tambah_anc,event_bidan_kunjungan_anc_integrasi WHERE event_bidan_tambah_anc.baseEntityId=event_bidan_kunjungan_anc_integrasi.baseEntityId AND event_bidan_tambah_anc.highRiskMalaria='yes' AND event_bidan_kunjungan_anc_integrasi.integrasiProgramMalariaObat='yes'")->result();
        $highRiskMalaria = [];
        foreach ($query as $q){
            if(!array_key_exists($q->baseEntityId, $highRiskMalaria)){
                $highRiskMalaria[$q->baseEntityId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT event_bidan_tambah_anc.baseEntityId as baseEntityId FROM event_bidan_tambah_anc,event_bidan_kunjungan_anc_integrasi WHERE event_bidan_tambah_anc.baseEntityId=event_bidan_kunjungan_anc_integrasi.baseEntityId AND event_bidan_tambah_anc.highRiskHIVAIDS='yes' AND event_bidan_kunjungan_anc_integrasi.integrasiProgrampmtctSerologi='yes'")->result();
        $highRiskHIVAIDS = [];
        foreach ($query as $q){
            if(!array_key_exists($q->baseEntityId, $highRiskHIVAIDS)){
                $highRiskHIVAIDS[$q->baseEntityId] = TRUE;
            }
        }
        $tertangani = array();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->baseEntityId, $tertangani)){
                continue;
            }
            if(array_key_exists($dvisit->locationId, $user_index)){
                $key=array_search($user_index[$dvisit->locationId],$result['data']['DATA A']['desa']);
                if($dvisit->komplikasidalamKehamilan!="None"&&$dvisit->komplikasidalamKehamilan!=''&&$dvisit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                    if(isset($dvisit->rujukan)){
                        if($dvisit->rujukan=="Ya"){
                            $tertangani[$dvisit->baseEntityId] = 'yes';
                            $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                            continue;
                        }
                    }
                }
                if($dvisit->pelayananfe0=="Ya"&&array_key_exists($dvisit->baseEntityId, $laboratoriumPeriksaHbAnemia)){
                    $tertangani[$dvisit->baseEntityId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->baseEntityId, $highRiskTuberculosis)){
                    $tertangani[$dvisit->baseEntityId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->baseEntityId, $highRiskMalaria)){
                    $tertangani[$dvisit->baseEntityId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->baseEntityId, $highRiskHIVAIDS)){
                    $tertangani[$dvisit->baseEntityId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
            }
        }
        
        $pwsdb = $this->load->database('pws', TRUE);
        var_dump($user);
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.'2017'.$month.$x;
                var_dump($id);
                var_dump($d[$i]);
                $pwsdb->query("UPDATE kia SET value='$d[$i]' WHERE id='$id'");
            }
        }
        
        exit;
        
        $this->PHPExcelModel->createNewPwsXLS("download/new_pws/pws.xlsx",$result,$result_index);
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
        //var_dump($result);exit;
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