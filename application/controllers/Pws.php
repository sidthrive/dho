<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pws extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('analytics', TRUE);
        date_default_timezone_set("Asia/Makassar"); 
        $this->load->model('LocationModel','loc');
        $this->load->model('EcCakupanModel','ec');
    }
    
    public function index(){
        
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
    
    private function isHRP($bumil,$resiko,$bumildata){
        $no = 0;
        if(array_key_exists($bumil->motherId, $resiko)){
            foreach ($resiko[$bumil->motherId] as $visit){
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
            if(array_key_exists($bumil->motherId, $bumildata)){
                foreach ($bumildata[$bumil->motherId] as $bum){
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
    
    public function calculate($pws){
        set_time_limit(3600);
        $time_start = microtime(true);
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        $year = date("Y",  strtotime("-1 day"));
        $month = date("n",  strtotime("-1 day"));
        $do_kec = "do_".$pws;
        $do_desa = $do_kec."_dusun";
        foreach ($kec as $kecamatan){
            $this->$do_kec($kecamatan, $year, $bulan_map[$month]);
            ob_get_contents();
            ob_flush();
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->$do_desa($desa, $year, $bulan_map[$month]);
                ob_get_contents();
                ob_flush();
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function calculate_my($pws,$month,$year){
        set_time_limit(3600);
        $time_start = microtime(true);
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        
        $do_kec = "do_".$pws;
        $do_desa = $do_kec."_dusun";
        foreach ($kec as $kecamatan){
            $this->$do_kec($kecamatan, $year, $bulan_map[$month]);
            ob_get_contents();
            ob_flush();
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->$do_desa($desa, $year, $bulan_map[$month]);
                ob_get_contents();
                ob_flush();
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function calculate_all_month($pws){
        set_time_limit(3600);
        $time_start = microtime(true);
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        $year = date("Y",  strtotime("-1 day"));
        $month = date("n",  strtotime("-1 day"));
        
        $do_kec = "do_".$pws;
        $do_desa = $do_kec."_dusun";
        foreach ($bulan_map as $bln){
            var_dump('bulan '.$bln.' start');
            foreach ($kec as $kecamatan){
                $this->$do_kec($kecamatan, $year, $bln);
                ob_get_contents();
                ob_flush();
                $desas   = $this->loc->getLocId($kecamatan);
                foreach ($desas as $desa){
                    $this->$do_desa($desa, $year, $bln);
                    ob_get_contents();
                    ob_flush();
                }
                var_dump($kecamatan.' bulan '.$bln.' done');
            }
            var_dump('bulan '.$bln.' done');
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
        
    }
    
    public function calculate_all(){
        set_time_limit(3600);
        $time_start = microtime(true);
        $pwses = ['kia','anak','kb','bayi','balita','neonatal','maternal'];
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        $year = date("Y",  strtotime("-1 day"));
        
        foreach ($pwses as $pws){
            $do_kec = "do_".$pws;
            $do_desa = $do_kec."_dusun";
            foreach ($bulan_map as $bln){
                var_dump('bulan '.$bln.' start');
                foreach ($kec as $kecamatan){
                    $this->$do_kec($kecamatan, $year, $bln);
                    ob_get_contents();
                    ob_flush();
                    $desas   = $this->loc->getLocId($kecamatan);
                    foreach ($desas as $desa){
                        $this->$do_desa($desa, $year, $bln);
                        ob_get_contents();
                        ob_flush();
                    }
                    var_dump($kecamatan.' bulan '.$bln.' done');
                }
                var_dump('bulan '.$bln.' done');
            }
        }
        
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
        
    }
    
    
    private function do_kia($kec,$year,$month){
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['cakupan_k1_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_k4_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_resiko_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_tertangani_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['linakes_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['nolinakes_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['fasilitas_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['k_nifas_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['anemia_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kek_bulan_ini'] = array_fill(0,count($user),0);
        
        
        $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 7);
        $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 38);
        $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 69);
        $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 98);
        $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 127);
        $result_index['linakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 157);
        $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 188);
        $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 219);
        $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 252);
        $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 283);
        $result_index['kek_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 314);
        
        $query = $this->db->query("SELECT userId,motherId,ancDate FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by motherId")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->userId, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->userId],$result['data']['DATA A']['desa']);
                    $result['data']['DATA']['cakupan_k1_bulan_ini'][$key] += 1;
                }
            }
        }

        $query = $this->db->query("SELECT userId,motherId,ancDate FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($query as $k4){
            if(array_key_exists($k4->userId, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->userId],$result['data']['DATA A']['desa']);
                    $result['data']['DATA']['cakupan_k4_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $query = $this->db->query("SELECT userId,motherId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$startdate')")->result();
        $query2 = $this->db->query("SELECT userId,motherId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM kartu_anc_visit ORDER BY ancDate")->result();
        $resikos = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $resikos)){
                $resikos[$q->motherId] = [];
                array_push($resikos[$q->motherId], $q);
            }else{
                array_push($resikos[$q->motherId], $q);
            }
        }
        
        $query2 = $this->db->query("SELECT motherId,"
                . "highRiskPregnancyProteinEnergyMalnutrition,"
                . "malariaRisk,"
                . "highRiskLabourTBRisk,"
                . "HighRiskPregnancyTooManyChildren,"
                . "HighRiskPregnancyAbortus,"
                . "HighRiskLabourSectionCesareaRecord,"
                . "highRiskSTIBBVs,"
                . "highRiskEctopicPregnancy,"
                . "otherRiskMolaHidatidosa,"
                . "otherRiskCongenitalAbnormality,"
                . "otherRiskEarlyWaterbreak,"
                . "highRiskCardiovascularDiseaseRecord,"
                . "highRiskDidneyDisorder,"
                . "highRiskHeartDisorder,"
                . "highRiskAsthma,"
                . "highRiskTuberculosis,"
                . "highRiskMalaria,"
                . "highRiskHIVAIDS FROM kartu_anc_registration")->result();
        $bumildata = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $bumildata)){
                $bumildata[$q->motherId] = [];
                array_push($bumildata[$q->motherId], $q);
            }
        }
        $bumil = [];
        $query = $this->db->query("SELECT userId,motherId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $resiko){
            if(array_key_exists($resiko->userId, $user_index)){
                if(!array_key_exists($resiko->motherId, $bumil)){
                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$resiko->highRiskPregnancyPIH=="yes"
                        ||$resiko->highRisklabourFetusNumber=="yes"
                        ||$resiko->highRiskLabourFetusSize=="yes"
                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                            $key=array_search($user_index[$resiko->userId],$result['data']['DATA A']['desa']);
                            $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                            $bumil[$resiko->motherId] = 'yes';
                        }else{
                            if(array_key_exists($resiko->motherId, $bumildata)){
                                foreach ($bumildata[$resiko->motherId] as $bum){
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
                                        $key=array_search($user_index[$resiko->userId],$result['data']['DATA A']['desa']);
                                        $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                                        $bumil[$resiko->motherId] = 'yes';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        $query2 = $this->db->query("SELECT motherId,ancDate,komplikasidalamKehamilan FROM kartu_anc_visit ORDER BY ancDate")->result();
        $komplikasi = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $komplikasi)){
                $komplikasi[$q->motherId] = [];
                array_push($komplikasi[$q->motherId], $q);
            }else{
                array_push($komplikasi[$q->motherId], $q);
            }
        }
        
        $query = $this->db->query("SELECT userId,motherId,ancDate,komplikasidalamKehamilan FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->userId, $user_index)){
                if(!$this->isHaveKomplikasiBefore($k1,$komplikasi)){
                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        $key=array_search($user_index[$k1->userId],$result['data']['DATA A']['desa']);
                        $result['data']['DATA']['komplikasi_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userId, $user_index)){
                $key=array_search($user_index[$dsalin->userId],$result['data']['DATA A']['desa']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userId, $user_index)){
                $key=array_search($user_index[$dsalin->userId],$result['data']['DATA A']['desa']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['data']['DATA']['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (PNCDate > '$startdate' AND PNCDate < '$enddate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_index)){
                $key=array_search($user_index[$dvisit->userId],$result['data']['DATA A']['desa']);
                $result['data']['DATA']['k_nifas_bulan_ini'][$key] += 1;
            }
        }
        
        $query2 = $this->db->query("SELECT motherId,laboratoriumPeriksaHbAnemia,highRiskPregnancyAnemia FROM kartu_anc_visit_labTest")->result();
        $datalabs = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $datalabs)){
                $datalabs[$q->motherId] = [];
                array_push($datalabs[$q->motherId], $q);
            }else{
                array_push($datalabs[$q->motherId], $q);
            }
        }
        
        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate')")->result();
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->userId, $user_index)){
                $key=array_search($user_index[$ibu->userId],$result['data']['DATA A']['desa']);
                if($this->isAnemia($ibu,$datalabs)){
                    $result['data']['DATA']['anemia_bulan_ini'][$key] += 1;
                }
                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
                    $result['data']['DATA']['kek_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        $query = $this->db->query("SELECT motherId FROM kartu_anc_visit_labTest WHERE laboratoriumPeriksaHbAnemia='positif'")->result();
        $laboratoriumPeriksaHbAnemia = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $laboratoriumPeriksaHbAnemia)){
                $laboratoriumPeriksaHbAnemia[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskTuberculosis='yes' AND kartu_anc_visit_integrasi.integrasiProgramtbObat='yes'")->result();
        $highRiskTuberculosis = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskTuberculosis)){
                $highRiskTuberculosis[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskMalaria='yes' AND kartu_anc_visit_integrasi.integrasiProgramMalariaObat='yes'")->result();
        $highRiskMalaria = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskMalaria)){
                $highRiskMalaria[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskHIVAIDS='yes' AND kartu_anc_visit_integrasi.integrasiProgrampmtctSerologi='yes'")->result();
        $highRiskHIVAIDS = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskHIVAIDS)){
                $highRiskHIVAIDS[$q->motherId] = TRUE;
            }
        }
        $tertangani = array();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->motherId, $tertangani)){
                continue;
            }
            if(array_key_exists($dvisit->userId, $user_index)){
                $key=array_search($user_index[$dvisit->userId],$result['data']['DATA A']['desa']);
                if($dvisit->komplikasidalamKehamilan!="None"&&$dvisit->komplikasidalamKehamilan!=''&&$dvisit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                    if(isset($dvisit->rujukan)){
                        if($dvisit->rujukan=="Ya"){
                            $tertangani[$dvisit->motherId] = 'yes';
                            $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                            continue;
                        }
                    }
                }
                if($dvisit->pelayananFe0=="Ya"&&array_key_exists($dvisit->motherId, $laboratoriumPeriksaHbAnemia)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskTuberculosis)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskMalaria)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskHIVAIDS)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
            }
        }
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM kia")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
//                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE kia SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO kia VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
        
    }
    
    private function isHaveKomplikasiBefore($bumil,$komplikasi){
        if(array_key_exists($bumil->motherId, $komplikasi)){
            foreach ($komplikasi[$bumil->motherId] as $visit){
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
        if(array_key_exists($bumil->motherId, $datalabs)){
            foreach ($datalabs[$bumil->motherId] as $data){
                if($data->laboratoriumPeriksaHbAnemia=='positif'||$data->highRiskPregnancyAnemia=='yes'){
                    return true;
                }
            }
        }
        return false;
    }
    
    private function do_kia_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col = ['januari'=>'D','februari'=>'E','maret'=>'F','april'=>'G','mei'=>'H','juni'=>'I','juli'=>'J','agustus'=>'K','september'=>'L','oktober'=>'M','november'=>'N','desember'=>'O'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        $result['data']['DATA']['cakupan_k1_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_k4_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['cakupan_resiko_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_tertangani_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['linakes_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['nolinakes_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['fasilitas_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['k_nifas_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['anemia_bulan_ini'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kek_bulan_ini'] = array_fill(0,count($user),0);
        
        
        $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 7);
        $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 38);
        $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 69);
        $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 98);
        $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 127);
        $result_index['linakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 157);
        $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 188);
        $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 219);
        $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 252);
        $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 283);
        $result_index['kek_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$month], 314);
        
        $query = $this->db->query("SELECT kartu_anc_visit.userId,kartu_anc_visit.motherId,kartu_anc_visit.ancDate,kartu_ibu_registration.dusun FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by motherId")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->dusun, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->dusun],$result['data']['DATA A']['dusun']);
                    $result['data']['DATA']['cakupan_k1_bulan_ini'][$key] += 1;
                }
            }
        }

        $query = $this->db->query("SELECT kartu_anc_visit.userId,kartu_anc_visit.motherId,kartu_anc_visit.ancDate,kartu_ibu_registration.dusun FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($query as $k4){
            if(array_key_exists($k4->dusun, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->dusun],$result['data']['DATA A']['dusun']);
                    $result['data']['DATA']['cakupan_k4_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $query2 = $this->db->query("SELECT userId,motherId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM kartu_anc_visit ORDER BY ancDate")->result();
        $resikos = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $resikos)){
                $resikos[$q->motherId] = [];
                array_push($resikos[$q->motherId], $q);
            }else{
                array_push($resikos[$q->motherId], $q);
            }
        }
        
        $query2 = $this->db->query("SELECT motherId,"
                . "highRiskPregnancyProteinEnergyMalnutrition,"
                . "malariaRisk,"
                . "highRiskLabourTBRisk,"
                . "HighRiskPregnancyTooManyChildren,"
                . "HighRiskPregnancyAbortus,"
                . "HighRiskLabourSectionCesareaRecord,"
                . "highRiskSTIBBVs,"
                . "highRiskEctopicPregnancy,"
                . "otherRiskMolaHidatidosa,"
                . "otherRiskCongenitalAbnormality,"
                . "otherRiskEarlyWaterbreak,"
                . "highRiskCardiovascularDiseaseRecord,"
                . "highRiskDidneyDisorder,"
                . "highRiskHeartDisorder,"
                . "highRiskAsthma,"
                . "highRiskTuberculosis,"
                . "highRiskMalaria,"
                . "highRiskHIVAIDS FROM kartu_anc_registration")->result();
        $bumildata = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $bumildata)){
                $bumildata[$q->motherId] = [];
                array_push($bumildata[$q->motherId], $q);
            }
        }
        $bumil = [];
        $query = $this->db->query("SELECT kartu_anc_visit.userId,kartu_anc_visit.motherId,kartu_anc_visit.ancDate,kartu_ibu_registration.dusun,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $resiko){
            if(array_key_exists($resiko->dusun, $user_index)){
                if(!array_key_exists($resiko->userId, $bumil)){
                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$resiko->highRiskPregnancyPIH=="yes"
                        ||$resiko->highRisklabourFetusNumber=="yes"
                        ||$resiko->highRiskLabourFetusSize=="yes"
                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                            $key=array_search($user_index[$resiko->dusun],$result['data']['DATA A']['dusun']);
                            $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                            $bumil[$resiko->userId] = 'yes';
                        }else{
                            if(array_key_exists($resiko->userId, $bumildata)){
                                foreach ($bumildata[$resiko->userId] as $bum){
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
                                        $key=array_search($user_index[$resiko->dusun],$result['data']['DATA A']['dusun']);
                                        $result['data']['DATA']['cakupan_resiko_bulan_ini'][$key] += 1;
                                        $bumil[$resiko->userId] = 'yes';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        $query2 = $this->db->query("SELECT motherId,ancDate,komplikasidalamKehamilan FROM kartu_anc_visit ORDER BY ancDate")->result();
        $komplikasi = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $komplikasi)){
                $komplikasi[$q->motherId] = [];
                array_push($komplikasi[$q->motherId], $q);
            }else{
                array_push($komplikasi[$q->motherId], $q);
            }
        }
        
        $query = $this->db->query("SELECT kartu_anc_visit.userId,kartu_anc_visit.motherId,kartu_anc_visit.ancDate,kartu_ibu_registration.dusun,komplikasidalamKehamilan FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->dusun, $user_index)){
                if(!$this->isHaveKomplikasiBefore($k1,$komplikasi)){
                    if($k1->komplikasidalamKehamilan!=''&&$k1->komplikasidalamKehamilan!='None'&&$k1->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        $key=array_search($user_index[$k1->dusun],$result['data']['DATA A']['dusun']);
                        $result['data']['DATA']['komplikasi_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        $datapersalinan= $this->db->query("SELECT kartu_pnc_dokumentasi_persalinan.*,kartu_ibu_registration.dusun FROM `kartu_pnc_dokumentasi_persalinan` LEFT JOIN kartu_anc_registration LEFT JOIN kartu_ibu_registration ON kartu_anc_registration.kiId=kartu_ibu_registration.kiId ON kartu_pnc_dokumentasi_persalinan.motherId=kartu_anc_registration.motherId WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->dusun, $user_index)){
                $key=array_search($user_index[$dsalin->dusun],$result['data']['DATA A']['dusun']);
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    if($dsalin->jenisKelamin=='laki'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['data']['DATA']['linakes_bulan_ini'][$key] += 1;
                    }
                }else{
                    if($dsalin->jenisKelamin=='laki'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }elseif($dsalin->jenisKelamin=='perempuan'){
                        $result['data']['DATA']['nolinakes_bulan_ini'][$key] += 1;
                    }
                }
            }
        }
        
        
        
        $datapersalinan= $this->db->query("SELECT kartu_pnc_dokumentasi_persalinan.*,kartu_ibu_registration.dusun FROM `kartu_pnc_dokumentasi_persalinan` LEFT JOIN kartu_anc_registration LEFT JOIN kartu_ibu_registration ON kartu_anc_registration.kiId=kartu_ibu_registration.kiId ON kartu_pnc_dokumentasi_persalinan.motherId=kartu_anc_registration.motherId WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->dusun, $user_index)){
                $key=array_search($user_index[$dsalin->dusun],$result['data']['DATA A']['dusun']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['data']['DATA']['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT kartu_pnc_visit.*,kartu_ibu_registration.dusun FROM kartu_pnc_visit LEFT JOIN kartu_ibu_registration ON kartu_pnc_visit.kiId=kartu_ibu_registration.kiId WHERE (PNCDate > '$startdate' AND PNCDate < '$enddate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->dusun, $user_index)){
                $key=array_search($user_index[$dvisit->dusun],$result['data']['DATA A']['dusun']);
                $result['data']['DATA']['k_nifas_bulan_ini'][$key] += 1;
            }
        }
        
        $query2 = $this->db->query("SELECT motherId,laboratoriumPeriksaHbAnemia,highRiskPregnancyAnemia FROM kartu_anc_visit_labTest")->result();
        $datalabs = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $datalabs)){
                $datalabs[$q->motherId] = [];
                array_push($datalabs[$q->motherId], $q);
            }else{
                array_push($datalabs[$q->motherId], $q);
            }
        }
        
        $dataibu = $this->db->query("SELECT kartu_anc_registration.*,kartu_ibu_registration.dusun FROM kartu_anc_registration LEFT JOIN kartu_ibu_registration ON kartu_anc_registration.kiId=kartu_ibu_registration.kiId WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate')")->result();
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->dusun, $user_index)){
                $key=array_search($user_index[$ibu->dusun],$result['data']['DATA A']['dusun']);
                if($this->isAnemia($ibu,$datalabs)){
                    $result['data']['DATA']['anemia_bulan_ini'][$key] += 1;
                }
                if($ibu->highRiskPregnancyProteinEnergyMalnutrition=="yes"){
                    $result['data']['DATA']['kek_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT kartu_anc_visit.*,kartu_ibu_registration.dusun FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE (ancDate > '$startdate' AND ancDate < '$enddate')")->result();
        $query = $this->db->query("SELECT motherId FROM kartu_anc_visit_labTest WHERE laboratoriumPeriksaHbAnemia='positif'")->result();
        $laboratoriumPeriksaHbAnemia = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $laboratoriumPeriksaHbAnemia)){
                $laboratoriumPeriksaHbAnemia[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskTuberculosis='yes' AND kartu_anc_visit_integrasi.integrasiProgramtbObat='yes'")->result();
        $highRiskTuberculosis = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskTuberculosis)){
                $highRiskTuberculosis[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskMalaria='yes' AND kartu_anc_visit_integrasi.integrasiProgramMalariaObat='yes'")->result();
        $highRiskMalaria = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskMalaria)){
                $highRiskMalaria[$q->motherId] = TRUE;
            }
        }
        $query = $this->db->query("SELECT kartu_anc_registration.motherId as motherId FROM kartu_anc_registration,kartu_anc_visit_integrasi WHERE kartu_anc_registration.motherId=kartu_anc_visit_integrasi.motherId AND kartu_anc_registration.highRiskHIVAIDS='yes' AND kartu_anc_visit_integrasi.integrasiProgrampmtctSerologi='yes'")->result();
        $highRiskHIVAIDS = [];
        foreach ($query as $q){
            if(!array_key_exists($q->motherId, $highRiskHIVAIDS)){
                $highRiskHIVAIDS[$q->motherId] = TRUE;
            }
        }
        $tertangani = array();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->motherId, $tertangani)){
                continue;
            }
            if(array_key_exists($dvisit->dusun, $user_index)){
                $key=array_search($user_index[$dvisit->dusun],$result['data']['DATA A']['dusun']);
                if($dvisit->komplikasidalamKehamilan!="None"&&$dvisit->komplikasidalamKehamilan!=''&&$dvisit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                    if(isset($dvisit->rujukan)){
                        if($dvisit->rujukan=="Ya"){
                            $tertangani[$dvisit->motherId] = 'yes';
                            $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                            continue;
                        }
                    }
                }
                if($dvisit->pelayananFe0=="Ya"&&array_key_exists($dvisit->motherId, $laboratoriumPeriksaHbAnemia)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskTuberculosis)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskMalaria)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->motherId, $highRiskHIVAIDS)){
                    $tertangani[$dvisit->motherId] = 'yes';
                    $result['data']['DATA']['komplikasi_tertangani_bulan_ini'][$key] += 1;
                    continue;
                }
            }
        }
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM kia")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE kia SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO kia VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_anak($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_L = ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_P = ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['kunjungan_neonatal_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_III_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_III_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_ditemukan_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_ditemukan_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_tertangani_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_tertangani_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_IV_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_IV_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_II_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_II_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_MTBS_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_MTBS_P'] = array_fill(0,count($user),0);
        
        
        $result_index['kunjungan_neonatal_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 8);
        $result_index['kunjungan_neonatal_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 8);
        $result_index['kunjungan_neonatal_III_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 41);
        $result_index['kunjungan_neonatal_III_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 41);
        $result_index['komplikasi_noenatal_ditemukan_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 74);
        $result_index['komplikasi_noenatal_ditemukan_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 74);
        $result_index['komplikasi_noenatal_tertangani_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 107);
        $result_index['komplikasi_noenatal_tertangani_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 107);
        $result_index['kunjugan_bayi_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 140);
        $result_index['kunjugan_bayi_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 140);
        $result_index['kunjugan_bayi_IV_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 173);
        $result_index['kunjugan_bayi_IV_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 173);
        $result_index['kunjugan_balita_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 206);
        $result_index['kunjugan_balita_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 206);
        $result_index['kunjugan_balita_II_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 239);
        $result_index['kunjugan_balita_II_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 239);
        $result_index['pelayanan_balita_sakit_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 272);
        $result_index['pelayanan_balita_sakit_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 272);
        $result_index['pelayanan_balita_sakit_MTBS_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 305);
        $result_index['pelayanan_balita_sakit_MTBS_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 305);
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM anak")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE anak SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO anak VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_anak_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_L = ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_P = ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        
        $result['data']['DATA']['kunjungan_neonatal_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_III_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjungan_neonatal_III_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_ditemukan_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_ditemukan_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_tertangani_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['komplikasi_noenatal_tertangani_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_IV_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_bayi_IV_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_I_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_I_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_II_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kunjugan_balita_II_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_MTBS_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_balita_sakit_MTBS_P'] = array_fill(0,count($user),0);
        
        
        $result_index['kunjungan_neonatal_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 8);
        $result_index['kunjungan_neonatal_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 8);
        $result_index['kunjungan_neonatal_III_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 41);
        $result_index['kunjungan_neonatal_III_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 41);
        $result_index['komplikasi_noenatal_ditemukan_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 74);
        $result_index['komplikasi_noenatal_ditemukan_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 74);
        $result_index['komplikasi_noenatal_tertangani_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 107);
        $result_index['komplikasi_noenatal_tertangani_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 107);
        $result_index['kunjugan_bayi_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 140);
        $result_index['kunjugan_bayi_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 140);
        $result_index['kunjugan_bayi_IV_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 173);
        $result_index['kunjugan_bayi_IV_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 173);
        $result_index['kunjugan_balita_I_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 206);
        $result_index['kunjugan_balita_I_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 206);
        $result_index['kunjugan_balita_II_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 239);
        $result_index['kunjugan_balita_II_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 239);
        $result_index['pelayanan_balita_sakit_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 272);
        $result_index['pelayanan_balita_sakit_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 272);
        $result_index['pelayanan_balita_sakit_MTBS_L']=$this->setArrayIndex($user, $bulan_col_L[$month], 305);
        $result_index['pelayanan_balita_sakit_MTBS_P']=$this->setArrayIndex($user, $bulan_col_P[$month], 305);
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM anak")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE anak SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO anak VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_kb($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_PKB['4t'] =      ['januari'=>'D','februari'=>'I','maret'=>'N','april'=>'S','mei'=>'X', 'juni'=>'AC','juli'=>'AH','agustus'=>'AM','september'=>'AR','oktober'=>'AW','november'=>'BB','desember'=>'BG'];
        $bulan_col_PKB['komp'] =    ['januari'=>'E','februari'=>'J','maret'=>'O','april'=>'T','mei'=>'Y', 'juni'=>'AD','juli'=>'AI','agustus'=>'AN','september'=>'AS','oktober'=>'AX','november'=>'BC','desember'=>'BH'];
        $bulan_col_PKB['gagal'] =   ['januari'=>'F','februari'=>'K','maret'=>'P','april'=>'U','mei'=>'Z', 'juni'=>'AE','juli'=>'AJ','agustus'=>'AO','september'=>'AT','oktober'=>'AY','november'=>'BD','desember'=>'BI'];
        $bulan_col_PKB['do'] =      ['januari'=>'G','februari'=>'L','maret'=>'Q','april'=>'V','mei'=>'AA','juni'=>'AF','juli'=>'AK','agustus'=>'AP','september'=>'AU','oktober'=>'AZ','november'=>'BE','desember'=>'BJ'];
        
        $bulan_col_KBA['kond'] =    ['januari'=>'C','februari'=>'J','maret'=>'Q','april'=>'X', 'mei'=>'AE','juni'=>'AL','juli'=>'AS','agustus'=>'AZ','september'=>'BG','oktober'=>'BN','november'=>'BU','desember'=>'CB'];
        $bulan_col_KBA['pil'] =     ['januari'=>'D','februari'=>'K','maret'=>'R','april'=>'Y', 'mei'=>'AF','juni'=>'AM','juli'=>'AT','agustus'=>'BA','september'=>'BH','oktober'=>'BO','november'=>'BV','desember'=>'CC'];
        $bulan_col_KBA['sunt'] =    ['januari'=>'E','februari'=>'L','maret'=>'S','april'=>'Z', 'mei'=>'AG','juni'=>'AN','juli'=>'AU','agustus'=>'BB','september'=>'BI','oktober'=>'BP','november'=>'BW','desember'=>'CD'];
        $bulan_col_KBA['akdr'] =    ['januari'=>'F','februari'=>'M','maret'=>'T','april'=>'AA','mei'=>'AH','juni'=>'AO','juli'=>'AV','agustus'=>'BC','september'=>'BJ','oktober'=>'BQ','november'=>'BX','desember'=>'CE'];
        $bulan_col_KBA['impl'] =    ['januari'=>'G','februari'=>'N','maret'=>'U','april'=>'AB','mei'=>'AI','juni'=>'AP','juli'=>'AW','agustus'=>'BD','september'=>'BK','oktober'=>'BR','november'=>'BY','desember'=>'CF'];
        $bulan_col_KBA['mow'] =     ['januari'=>'H','februari'=>'O','maret'=>'V','april'=>'AC','mei'=>'AJ','juni'=>'AQ','juli'=>'AX','agustus'=>'BE','september'=>'BL','oktober'=>'BS','november'=>'BZ','desember'=>'CG'];
        $bulan_col_KBA['mop'] =     ['januari'=>'I','februari'=>'P','maret'=>'W','april'=>'AD','mei'=>'AK','juni'=>'AR','juli'=>'AY','agustus'=>'BF','september'=>'BM','oktober'=>'BT','november'=>'CA','desember'=>'CH'];
        
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['pelayanan_kb_4t'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_komp'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_gagal'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_do'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_kond'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_pil'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_sunt'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_akdr'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_impl'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_mow'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_mop'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_kond'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_pil'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_sunt'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_akdr'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_impl'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_mow'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_mop'] = array_fill(0,count($user),0);
        
        
        $result_index['pelayanan_kb_4t']=$this->setArrayIndex($user, $bulan_col_PKB['4t'][$month], 8);
        $result_index['pelayanan_kb_komp']=$this->setArrayIndex($user, $bulan_col_PKB['komp'][$month], 8);
        $result_index['pelayanan_kb_gagal']=$this->setArrayIndex($user, $bulan_col_PKB['gagal'][$month], 8);
        $result_index['pelayanan_kb_do']=$this->setArrayIndex($user, $bulan_col_PKB['do'][$month], 8);
        $result_index['kb_aktif_kond']=$this->setArrayIndex($user, $bulan_col_KBA['kond'][$month], 39);
        $result_index['kb_aktif_pil']=$this->setArrayIndex($user, $bulan_col_KBA['pil'][$month], 39);
        $result_index['kb_aktif_sunt']=$this->setArrayIndex($user, $bulan_col_KBA['sunt'][$month], 39);
        $result_index['kb_aktif_akdr']=$this->setArrayIndex($user, $bulan_col_KBA['akdr'][$month], 39);
        $result_index['kb_aktif_impl']=$this->setArrayIndex($user, $bulan_col_KBA['impl'][$month], 39);
        $result_index['kb_aktif_mow']=$this->setArrayIndex($user, $bulan_col_KBA['mow'][$month], 39);
        $result_index['kb_aktif_mop']=$this->setArrayIndex($user, $bulan_col_KBA['mop'][$month], 39);
        $result_index['kb_pasca_salin_kond']=$this->setArrayIndex($user, $bulan_col_KBA['kond'][$month], 70);
        $result_index['kb_pasca_salin_pil']=$this->setArrayIndex($user, $bulan_col_KBA['pil'][$month], 70);
        $result_index['kb_pasca_salin_sunt']=$this->setArrayIndex($user, $bulan_col_KBA['sunt'][$month], 70);
        $result_index['kb_pasca_salin_akdr']=$this->setArrayIndex($user, $bulan_col_KBA['akdr'][$month], 70);
        $result_index['kb_pasca_salin_impl']=$this->setArrayIndex($user, $bulan_col_KBA['impl'][$month], 70);
        $result_index['kb_pasca_salin_mow']=$this->setArrayIndex($user, $bulan_col_KBA['mow'][$month], 70);
        $result_index['kb_pasca_salin_mop']=$this->setArrayIndex($user, $bulan_col_KBA['mop'][$month], 70);
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM kb")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE kb SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO kb VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_kb_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_PKB['4t'] =      ['januari'=>'D','februari'=>'I','maret'=>'N','april'=>'S','mei'=>'X', 'juni'=>'AC','juli'=>'AH','agustus'=>'AM','september'=>'AR','oktober'=>'AW','november'=>'BB','desember'=>'BG'];
        $bulan_col_PKB['komp'] =    ['januari'=>'E','februari'=>'J','maret'=>'O','april'=>'T','mei'=>'Y', 'juni'=>'AD','juli'=>'AI','agustus'=>'AN','september'=>'AS','oktober'=>'AX','november'=>'BC','desember'=>'BH'];
        $bulan_col_PKB['gagal'] =   ['januari'=>'F','februari'=>'K','maret'=>'P','april'=>'U','mei'=>'Z', 'juni'=>'AE','juli'=>'AJ','agustus'=>'AO','september'=>'AT','oktober'=>'AY','november'=>'BD','desember'=>'BI'];
        $bulan_col_PKB['do'] =      ['januari'=>'G','februari'=>'L','maret'=>'Q','april'=>'V','mei'=>'AA','juni'=>'AF','juli'=>'AK','agustus'=>'AP','september'=>'AU','oktober'=>'AZ','november'=>'BE','desember'=>'BJ'];
        
        $bulan_col_KBA['kond'] =    ['januari'=>'C','februari'=>'J','maret'=>'Q','april'=>'X', 'mei'=>'AE','juni'=>'AL','juli'=>'AS','agustus'=>'AZ','september'=>'BG','oktober'=>'BN','november'=>'BU','desember'=>'CB'];
        $bulan_col_KBA['pil'] =     ['januari'=>'D','februari'=>'K','maret'=>'R','april'=>'Y', 'mei'=>'AF','juni'=>'AM','juli'=>'AT','agustus'=>'BA','september'=>'BH','oktober'=>'BO','november'=>'BV','desember'=>'CC'];
        $bulan_col_KBA['sunt'] =    ['januari'=>'E','februari'=>'L','maret'=>'S','april'=>'Z', 'mei'=>'AG','juni'=>'AN','juli'=>'AU','agustus'=>'BB','september'=>'BI','oktober'=>'BP','november'=>'BW','desember'=>'CD'];
        $bulan_col_KBA['akdr'] =    ['januari'=>'F','februari'=>'M','maret'=>'T','april'=>'AA','mei'=>'AH','juni'=>'AO','juli'=>'AV','agustus'=>'BC','september'=>'BJ','oktober'=>'BQ','november'=>'BX','desember'=>'CE'];
        $bulan_col_KBA['impl'] =    ['januari'=>'G','februari'=>'N','maret'=>'U','april'=>'AB','mei'=>'AI','juni'=>'AP','juli'=>'AW','agustus'=>'BD','september'=>'BK','oktober'=>'BR','november'=>'BY','desember'=>'CF'];
        $bulan_col_KBA['mow'] =     ['januari'=>'H','februari'=>'O','maret'=>'V','april'=>'AC','mei'=>'AJ','juni'=>'AQ','juli'=>'AX','agustus'=>'BE','september'=>'BL','oktober'=>'BS','november'=>'BZ','desember'=>'CG'];
        $bulan_col_KBA['mop'] =     ['januari'=>'I','februari'=>'P','maret'=>'W','april'=>'AD','mei'=>'AK','juni'=>'AR','juli'=>'AY','agustus'=>'BF','september'=>'BM','oktober'=>'BT','november'=>'CA','desember'=>'CH'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        
        $result['data']['DATA']['pelayanan_kb_4t'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_komp'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_gagal'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pelayanan_kb_do'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_kond'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_pil'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_sunt'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_akdr'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_impl'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_mow'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_aktif_mop'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_kond'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_pil'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_sunt'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_akdr'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_impl'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_mow'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kb_pasca_salin_mop'] = array_fill(0,count($user),0);
        
        
        $result_index['pelayanan_kb_4t']=$this->setArrayIndex($user, $bulan_col_PKB['4t'][$month], 8);
        $result_index['pelayanan_kb_komp']=$this->setArrayIndex($user, $bulan_col_PKB['komp'][$month], 8);
        $result_index['pelayanan_kb_gagal']=$this->setArrayIndex($user, $bulan_col_PKB['gagal'][$month], 8);
        $result_index['pelayanan_kb_do']=$this->setArrayIndex($user, $bulan_col_PKB['do'][$month], 8);
        $result_index['kb_aktif_kond']=$this->setArrayIndex($user, $bulan_col_KBA['kond'][$month], 39);
        $result_index['kb_aktif_pil']=$this->setArrayIndex($user, $bulan_col_KBA['pil'][$month], 39);
        $result_index['kb_aktif_sunt']=$this->setArrayIndex($user, $bulan_col_KBA['sunt'][$month], 39);
        $result_index['kb_aktif_akdr']=$this->setArrayIndex($user, $bulan_col_KBA['akdr'][$month], 39);
        $result_index['kb_aktif_impl']=$this->setArrayIndex($user, $bulan_col_KBA['impl'][$month], 39);
        $result_index['kb_aktif_mow']=$this->setArrayIndex($user, $bulan_col_KBA['mow'][$month], 39);
        $result_index['kb_aktif_mop']=$this->setArrayIndex($user, $bulan_col_KBA['mop'][$month], 39);
        $result_index['kb_pasca_salin_kond']=$this->setArrayIndex($user, $bulan_col_KBA['kond'][$month], 70);
        $result_index['kb_pasca_salin_pil']=$this->setArrayIndex($user, $bulan_col_KBA['pil'][$month], 70);
        $result_index['kb_pasca_salin_sunt']=$this->setArrayIndex($user, $bulan_col_KBA['sunt'][$month], 70);
        $result_index['kb_pasca_salin_akdr']=$this->setArrayIndex($user, $bulan_col_KBA['akdr'][$month], 70);
        $result_index['kb_pasca_salin_impl']=$this->setArrayIndex($user, $bulan_col_KBA['impl'][$month], 70);
        $result_index['kb_pasca_salin_mow']=$this->setArrayIndex($user, $bulan_col_KBA['mow'][$month], 70);
        $result_index['kb_pasca_salin_mop']=$this->setArrayIndex($user, $bulan_col_KBA['mop'][$month], 70);
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM kb")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE kb SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO kb VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_bayi($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['pneumonia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_P'] = array_fill(0,count($user),0);
        
        
        $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['pneumonia_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 10);
        $result_index['pneumonia_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 10);
        $result_index['diare_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 52);
        $result_index['diare_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 52);
        $result_index['diare_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 52);
        $result_index['diare_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 52);
        $result_index['tetanus_n_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 94);
        $result_index['tetanus_n_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 94);
        $result_index['tetanus_n_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 94);
        $result_index['tetanus_n_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 94);
        $result_index['saraf_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 136);
        $result_index['saraf_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 136);
        $result_index['saraf_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 136);
        $result_index['saraf_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 136);
        $result_index['malaria_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 178);
        $result_index['malaria_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 178);
        $result_index['malaria_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 178);
        $result_index['malaria_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 178);
        $result_index['tb_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['tb_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['tb_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 220);
        $result_index['tb_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 220);
        $result_index['demam_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 262);
        $result_index['demam_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 262);
        $result_index['demam_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 262);
        $result_index['demam_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 262);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 304);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 304);
        $result_index['lainlain_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 304);
        $result_index['lainlain_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 304);
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM bayi")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE bayi SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO bayi VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_bayi_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        
        $result['data']['DATA']['pneumonia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_P'] = array_fill(0,count($user),0);
        
        
        $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['pneumonia_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 10);
        $result_index['pneumonia_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 10);
        $result_index['diare_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 52);
        $result_index['diare_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 52);
        $result_index['diare_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 52);
        $result_index['diare_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 52);
        $result_index['tetanus_n_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 94);
        $result_index['tetanus_n_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 94);
        $result_index['tetanus_n_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 94);
        $result_index['tetanus_n_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 94);
        $result_index['saraf_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 136);
        $result_index['saraf_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 136);
        $result_index['saraf_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 136);
        $result_index['saraf_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 136);
        $result_index['malaria_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 178);
        $result_index['malaria_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 178);
        $result_index['malaria_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 178);
        $result_index['malaria_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 178);
        $result_index['tb_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['tb_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['tb_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 220);
        $result_index['tb_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 220);
        $result_index['demam_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 262);
        $result_index['demam_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 262);
        $result_index['demam_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 262);
        $result_index['demam_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 262);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 304);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 304);
        $result_index['lainlain_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 304);
        $result_index['lainlain_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 304);
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM bayi")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE bayi SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO bayi VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_balita($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['pneumonia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_P'] = array_fill(0,count($user),0);
        
        
        $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['pneumonia_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 10);
        $result_index['pneumonia_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 10);
        $result_index['diare_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 52);
        $result_index['diare_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 52);
        $result_index['diare_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 52);
        $result_index['diare_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 52);
        $result_index['malaria_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 94);
        $result_index['malaria_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 94);
        $result_index['malaria_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 94);
        $result_index['malaria_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 94);
        $result_index['campak_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 136);
        $result_index['campak_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 136);
        $result_index['campak_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 136);
        $result_index['campak_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 136);
        $result_index['demam_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 178);
        $result_index['demam_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 178);
        $result_index['demam_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 178);
        $result_index['demam_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 178);
        $result_index['difteri_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['difteri_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['difteri_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 220);
        $result_index['difteri_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 220);
        $result_index['giziburuk_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 262);
        $result_index['giziburuk_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 262);
        $result_index['giziburuk_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 262);
        $result_index['giziburuk_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 262);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 304);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 304);
        $result_index['lainlain_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 304);
        $result_index['lainlain_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 304);
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM balita")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE balita SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO balita VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_balita_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        
        $result['data']['DATA']['pneumonia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['pneumonia_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['diare_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_n_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['saraf_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['malaria_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tb_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['demam_mati_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati_P'] = array_fill(0,count($user),0);
        
        
        $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['pneumonia_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 10);
        $result_index['pneumonia_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 10);
        $result_index['diare_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 52);
        $result_index['diare_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 52);
        $result_index['diare_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 52);
        $result_index['diare_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 52);
        $result_index['malaria_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 94);
        $result_index['malaria_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 94);
        $result_index['malaria_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 94);
        $result_index['malaria_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 94);
        $result_index['campak_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 136);
        $result_index['campak_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 136);
        $result_index['campak_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 136);
        $result_index['campak_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 136);
        $result_index['demam_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 178);
        $result_index['demam_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 178);
        $result_index['demam_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 178);
        $result_index['demam_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 178);
        $result_index['difteri_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['difteri_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['difteri_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 220);
        $result_index['difteri_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 220);
        $result_index['giziburuk_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 262);
        $result_index['giziburuk_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 262);
        $result_index['giziburuk_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 262);
        $result_index['giziburuk_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 262);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 304);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 304);
        $result_index['lainlain_mati_L'] = $this->setArrayIndex($user, $bulan_col_M_L[$month], 304);
        $result_index['lainlain_mati_P'] = $this->setArrayIndex($user, $bulan_col_M_P[$month], 304);
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM balita")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE balita SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO balita VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_neonatal($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L =  ['januari'=>'C','februari'=>'I','maret'=>'O','april'=>'U','mei'=>'AA','juni'=>'AG','juli'=>'AM','agustus'=>'AS','september'=>'AY','oktober'=>'BE','november'=>'BK','desember'=>'BQ'];
        $bulan_col_K_P =  ['januari'=>'D','februari'=>'J','maret'=>'P','april'=>'V','mei'=>'AB','juni'=>'AH','juli'=>'AN','agustus'=>'AT','september'=>'AZ','oktober'=>'BF','november'=>'BL','desember'=>'BR'];
        $bulan_col_M1_L = ['januari'=>'E','februari'=>'K','maret'=>'Q','april'=>'W','mei'=>'AC','juni'=>'AI','juli'=>'AO','agustus'=>'AU','september'=>'BA','oktober'=>'BG','november'=>'BM','desember'=>'BS'];
        $bulan_col_M1_P = ['januari'=>'F','februari'=>'L','maret'=>'R','april'=>'X','mei'=>'AD','juni'=>'AJ','juli'=>'AP','agustus'=>'AV','september'=>'BB','oktober'=>'BH','november'=>'BN','desember'=>'BT'];
        $bulan_col_M2_L = ['januari'=>'G','februari'=>'M','maret'=>'S','april'=>'Y','mei'=>'AE','juni'=>'AK','juli'=>'AQ','agustus'=>'AW','september'=>'BC','oktober'=>'BI','november'=>'BO','desember'=>'BU'];
        $bulan_col_M2_P = ['januari'=>'H','februari'=>'N','maret'=>'T','april'=>'Z','mei'=>'AF','juni'=>'AL','juli'=>'AR','agustus'=>'AX','september'=>'BD','oktober'=>'BJ','november'=>'BP','desember'=>'BV'];
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
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA']['bblr_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati2_P'] = array_fill(0,count($user),0);
        
        $result_index['bblr_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['bblr_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['bblr_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 10);
        $result_index['bblr_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 10);
        $result_index['bblr_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 10);
        $result_index['bblr_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 10);
        $result_index['asfiksia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 45);
        $result_index['asfiksia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 45);
        $result_index['asfiksia_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 45);
        $result_index['asfiksia_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 45);
        $result_index['asfiksia_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 45);
        $result_index['asfiksia_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 45);
        $result_index['ikterus_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 80);
        $result_index['ikterus_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 80);
        $result_index['ikterus_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 80);
        $result_index['ikterus_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 80);
        $result_index['ikterus_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 80);
        $result_index['ikterus_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 80);
        $result_index['tetanus_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 115);
        $result_index['tetanus_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 115);
        $result_index['tetanus_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 115);
        $result_index['tetanus_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 115);
        $result_index['tetanus_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 115);
        $result_index['tetanus_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 115);
        $result_index['sepsis_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 150);
        $result_index['sepsis_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 150);
        $result_index['sepsis_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 150);
        $result_index['sepsis_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 150);
        $result_index['sepsis_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 150);
        $result_index['sepsis_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 150);
        $result_index['kelainan_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 185);
        $result_index['kelainan_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 185);
        $result_index['kelainan_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 185);
        $result_index['kelainan_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 185);
        $result_index['kelainan_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 185);
        $result_index['kelainan_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 185);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['lainlain_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 220);
        $result_index['lainlain_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 220);
        $result_index['lainlain_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 220);
        $result_index['lainlain_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 220);
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM neonatal")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE neonatal SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO neonatal VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_neonatal_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L =  ['januari'=>'C','februari'=>'I','maret'=>'O','april'=>'U','mei'=>'AA','juni'=>'AG','juli'=>'AM','agustus'=>'AS','september'=>'AY','oktober'=>'BE','november'=>'BK','desember'=>'BQ'];
        $bulan_col_K_P =  ['januari'=>'D','februari'=>'J','maret'=>'P','april'=>'V','mei'=>'AB','juni'=>'AH','juli'=>'AN','agustus'=>'AT','september'=>'AZ','oktober'=>'BF','november'=>'BL','desember'=>'BR'];
        $bulan_col_M1_L = ['januari'=>'E','februari'=>'K','maret'=>'Q','april'=>'W','mei'=>'AC','juni'=>'AI','juli'=>'AO','agustus'=>'AU','september'=>'BA','oktober'=>'BG','november'=>'BM','desember'=>'BS'];
        $bulan_col_M1_P = ['januari'=>'F','februari'=>'L','maret'=>'R','april'=>'X','mei'=>'AD','juni'=>'AJ','juli'=>'AP','agustus'=>'AV','september'=>'BB','oktober'=>'BH','november'=>'BN','desember'=>'BT'];
        $bulan_col_M2_L = ['januari'=>'G','februari'=>'M','maret'=>'S','april'=>'Y','mei'=>'AE','juni'=>'AK','juli'=>'AQ','agustus'=>'AW','september'=>'BC','oktober'=>'BI','november'=>'BO','desember'=>'BU'];
        $bulan_col_M2_P = ['januari'=>'H','februari'=>'N','maret'=>'T','april'=>'Z','mei'=>'AF','juni'=>'AL','juli'=>'AR','agustus'=>'AX','september'=>'BD','oktober'=>'BJ','november'=>'BP','desember'=>'BV'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        $result['data']['DATA A']['dusun'] = $user;
        
        $result['data']['DATA']['bblr_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['bblr_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['asfiksia_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['ikterus_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['tetanus_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['sepsis_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['kelainan_mati2_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_kasus_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati1_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati1_P'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati2_L'] = array_fill(0,count($user),0);
        $result['data']['DATA']['lainlain_mati2_P'] = array_fill(0,count($user),0);
        
        $result_index['bblr_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 10);
        $result_index['bblr_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 10);
        $result_index['bblr_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 10);
        $result_index['bblr_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 10);
        $result_index['bblr_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 10);
        $result_index['bblr_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 10);
        $result_index['asfiksia_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 45);
        $result_index['asfiksia_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 45);
        $result_index['asfiksia_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 45);
        $result_index['asfiksia_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 45);
        $result_index['asfiksia_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 45);
        $result_index['asfiksia_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 45);
        $result_index['ikterus_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 80);
        $result_index['ikterus_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 80);
        $result_index['ikterus_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 80);
        $result_index['ikterus_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 80);
        $result_index['ikterus_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 80);
        $result_index['ikterus_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 80);
        $result_index['tetanus_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 115);
        $result_index['tetanus_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 115);
        $result_index['tetanus_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 115);
        $result_index['tetanus_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 115);
        $result_index['tetanus_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 115);
        $result_index['tetanus_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 115);
        $result_index['sepsis_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 150);
        $result_index['sepsis_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 150);
        $result_index['sepsis_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 150);
        $result_index['sepsis_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 150);
        $result_index['sepsis_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 150);
        $result_index['sepsis_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 150);
        $result_index['kelainan_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 185);
        $result_index['kelainan_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 185);
        $result_index['kelainan_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 185);
        $result_index['kelainan_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 185);
        $result_index['kelainan_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 185);
        $result_index['kelainan_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 185);
        $result_index['lainlain_kasus_L'] = $this->setArrayIndex($user, $bulan_col_K_L[$month], 220);
        $result_index['lainlain_kasus_P'] = $this->setArrayIndex($user, $bulan_col_K_P[$month], 220);
        $result_index['lainlain_mati1_L'] = $this->setArrayIndex($user, $bulan_col_M1_L[$month], 220);
        $result_index['lainlain_mati1_P'] = $this->setArrayIndex($user, $bulan_col_M1_P[$month], 220);
        $result_index['lainlain_mati2_L'] = $this->setArrayIndex($user, $bulan_col_M2_L[$month], 220);
        $result_index['lainlain_mati2_P'] = $this->setArrayIndex($user, $bulan_col_M2_P[$month], 220);
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM neonatal")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                var_dump($id."=".$d[$i]);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE neonatal SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO neonatal VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
    }
    
    private function do_maternal($kec,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K =  ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_M =  ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
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
        
        $result['data']['Pendarahan']['hamil_muda_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hamil_muda_M'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['apb_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['apb_M'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hpp_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hpp_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['kpd_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['kpd_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_lama_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_lama_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_kasep_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_kasep_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['sepsis_puerpuralis_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['sepsis_puerpuralis_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_kronis_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_kronis_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_protein_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_protein_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['eklamsia_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['eklamsia_M'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['menular_K'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['menular_M'] = array_fill(0,count($user),0);  
        $result['data']['PM-PTM']['tidak_menular_K'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['tidak_menular_M'] = array_fill(0,count($user),0);    
        
        
        $result_index['hamil_muda_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['hamil_muda_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['apb_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 45);
        $result_index['apb_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 45);
        $result_index['hpp_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 83);
        $result_index['hpp_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 83);
        $result_index['kpd_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['kpd_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['partus_lama_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['partus_lama_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);
        $result_index['partus_kasep_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 81);
        $result_index['partus_kasep_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 81);
        $result_index['sepsis_puerpuralis_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 118);
        $result_index['sepsis_puerpuralis_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 118);
        $result_index['hipertensi_kronis_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['hipertensi_kronis_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['hipertensi_protein_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['hipertensi_protein_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);
        $result_index['eklamsia_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 81);
        $result_index['eklamsia_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 81);
        $result_index['menular_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['menular_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);  
        $result_index['tidak_menular_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['tidak_menular_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);  
        
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM maternal")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data'] as $ws=>$data){
                foreach($data as $x=>$d){
                    $id = $desa.$year.$month.$x;
                    var_dump($id."=".$d[$i]);
                    if(array_key_exists($id, $ids)){
                        $pwsdb->query("UPDATE maternal SET value='$d[$i]' WHERE id='$id'");
                    }else{
                        $pwsdb->query("INSERT INTO maternal VALUES('$id','$desa','$year','$month','$x',0)");
                    }
                }
            }
        }
    }
    
    private function do_maternal_dusun($desa,$year,$month){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K =  ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_M =  ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        $user = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);foreach ($user as $x=>$dsn){$user[$x] = $user_index[$dsn];}
        
        $result['data']['Pendarahan']['hamil_muda_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hamil_muda_M'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['apb_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['apb_M'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hpp_K'] = array_fill(0,count($user),0);
        $result['data']['Pendarahan']['hpp_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['kpd_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['kpd_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_lama_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_lama_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_kasep_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['partus_kasep_M'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['sepsis_puerpuralis_K'] = array_fill(0,count($user),0);
        $result['data']['Infeksi']['sepsis_puerpuralis_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_kronis_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_kronis_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_protein_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['hipertensi_protein_M'] = array_fill(0,count($user),0);
        $result['data']['HDK']['eklamsia_K'] = array_fill(0,count($user),0);
        $result['data']['HDK']['eklamsia_M'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['menular_K'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['menular_M'] = array_fill(0,count($user),0);  
        $result['data']['PM-PTM']['tidak_menular_K'] = array_fill(0,count($user),0);
        $result['data']['PM-PTM']['tidak_menular_M'] = array_fill(0,count($user),0);    
        
        
        $result_index['hamil_muda_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['hamil_muda_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['apb_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 45);
        $result_index['apb_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 45);
        $result_index['hpp_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 83);
        $result_index['hpp_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 83);
        $result_index['kpd_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['kpd_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['partus_lama_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['partus_lama_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);
        $result_index['partus_kasep_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 81);
        $result_index['partus_kasep_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 81);
        $result_index['sepsis_puerpuralis_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 118);
        $result_index['sepsis_puerpuralis_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 118);
        $result_index['hipertensi_kronis_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['hipertensi_kronis_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);
        $result_index['hipertensi_protein_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['hipertensi_protein_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);
        $result_index['eklamsia_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 81);
        $result_index['eklamsia_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 81);
        $result_index['menular_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 7);
        $result_index['menular_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 7);  
        $result_index['tidak_menular_K'] = $this->setArrayIndex($user, $bulan_col_K[$month], 44);
        $result_index['tidak_menular_M'] = $this->setArrayIndex($user, $bulan_col_M[$month], 44);  
        
        
        
        $pwsdb = $this->load->database('pws', TRUE);
        $cek_id = $pwsdb->query("SELECT id FROM maternal")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data'] as $ws=>$data){
                foreach($data as $x=>$d){
                    $id = $desa.$year.$month.$x;
                    var_dump($id."=".$d[$i]);
                    if(array_key_exists($id, $ids)){
                        $pwsdb->query("UPDATE maternal SET value='$d[$i]' WHERE id='$id'");
                    }else{
                        $pwsdb->query("INSERT INTO maternal VALUES('$id','$desa','$year','$month','$x',0)");
                    }
                }
            }
        }
    }
}