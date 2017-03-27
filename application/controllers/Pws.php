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
    
    public function kia(){
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
        foreach ($kec as $kecamatan){
            $this->do_kia($kecamatan, $year, $bulan_map[$month]);
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->do_kia_dusun($desa, $year, $bulan_map[$month]);
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function kia_my($month,$year){
        set_time_limit(3600);
        $time_start = microtime(true);
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        
        foreach ($kec as $kecamatan){
            $this->do_kia($kecamatan, $year, $bulan_map[$month]);
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->do_kia_dusun($desa, $year, $bulan_map[$month]);
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function kia_all(){
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
        foreach ($bulan_map as $bln){
            var_dump('bulan '.$bln.' start');
            foreach ($kec as $kecamatan){
                $this->do_kia($kecamatan, $year, $bln);
                $desas   = $this->loc->getLocId($kecamatan);
                foreach ($desas as $desa){
                    $this->do_kia_dusun($desa, $year, $bln);
                }
                var_dump($kecamatan.' bulan '.$bln.' done');
            }
            var_dump('bulan '.$bln.' done');
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
        
    }
    
    public function anak(){
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
        foreach ($kec as $kecamatan){
            $this->do_anak($kecamatan, $year, $bulan_map[$month]);
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->do_anak_dusun($desa, $year, $bulan_map[$month]);
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function anak_my($month,$year){
        set_time_limit(3600);
        $time_start = microtime(true);
        $bulan_map = [1=>'januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $loc = $this->loc->getAllLoc('bidan');
        $kec = [];
        foreach ($loc as $k=>$d){
            array_push($kec, $k);
        }
        
        foreach ($kec as $kecamatan){
            $this->do_anak($kecamatan, $year, $bulan_map[$month]);
            $desas   = $this->loc->getLocId($kecamatan);
            foreach ($desas as $desa){
                $this->do_anak_dusun($desa, $year, $bulan_map[$month]);
            }
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        var_dump('Execution time : ' . $time . ' seconds');
    }
    
    public function anak_all(){
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
        foreach ($bulan_map as $bln){
            var_dump('bulan '.$bln.' start');
            foreach ($kec as $kecamatan){
                $this->do_anak($kecamatan, $year, $bulan_map[$month]);
                $desas   = $this->loc->getLocId($kecamatan);
                foreach ($desas as $desa){
                    $this->do_anak_dusun($desa, $year, $bulan_map[$month]);
                }
                var_dump($kecamatan.' bulan '.$bln.' done');
            }
            var_dump('bulan '.$bln.' done');
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
        $cek_id = $pwsdb->query("SELECT id FROM kia")->result();
        $ids = [];
        foreach ($cek_id as $cek){
            $ids[$cek->id] = TRUE;
        }
        foreach ($user as $i=>$u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            foreach ($result['data']['DATA'] as $x=>$d){
                $id = $desa.$year.$month.$x;
                //var_dump($id);
                if(array_key_exists($id, $ids)){
                    $pwsdb->query("UPDATE kia SET value='$d[$i]' WHERE id='$id'");
                }else{
                    $pwsdb->query("INSERT INTO kia VALUES('$id','$desa','$year','$month','$x',0)");
                }
            }
        }
        
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
        $user_index = $this->loc->getDusunTypo($desa);
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
        
        $query = $this->db->query("SELECT locationId,event_bidan_kunjungan_anc.baseEntityId,ancDate,client_ibu.dusun FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND kunjunganKe=1) group by baseEntityId")->result();
        foreach ($query as $k1){
            if(array_key_exists($k1->dusun, $user_index)){
                if(!$this->isHaveDoneAnc1($k1)){
                    $key=array_search($user_index[$k1->dusun],$result['data']['DATA A']['dusun']);
                    $result['data']['DATA']['cakupan_k1_bulan_ini'][$key] += 1;
                }
            }
        }

        $query = $this->db->query("SELECT locationId,event_bidan_kunjungan_anc.baseEntityId,ancDate,client_ibu.dusun FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by baseEntityId")->result();
        foreach ($query as $k4){
            if(array_key_exists($k4->dusun, $user_index)){
                if(!$this->isHaveDoneAnc4($k4)){
                    $key=array_search($user_index[$k4->dusun],$result['data']['DATA A']['dusun']);
                    $result['data']['DATA']['cakupan_k4_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $query2 = $this->db->query("SELECT locationId,client_ibu.dusun,event_bidan_kunjungan_anc.baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId GROUP BY event_bidan_kunjungan_anc.docId ORDER BY ancDate")->result();
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
        $query = $this->db->query("SELECT locationId,client_ibu.dusun,event_bidan_kunjungan_anc.baseEntityId,ancDate,highRiskPregnancyProteinEnergyMalnutrition,highRiskPregnancyPIH,highRisklabourFetusNumber,highRiskLabourFetusSize,highRiskLabourFetusMalpresentation FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') GROUP BY event_bidan_kunjungan_anc.docId")->result();
        foreach ($query as $resiko){
            if(array_key_exists($resiko->dusun, $user_index)){
                if(!array_key_exists($resiko->baseEntityId, $bumil)){
                    if(!$this->isHRP($resiko,$resikos,$bumildata)){
                        if($resiko->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$resiko->highRiskPregnancyPIH=="yes"
                        ||$resiko->highRisklabourFetusNumber=="yes"
                        ||$resiko->highRiskLabourFetusSize=="yes"
                        ||$resiko->highRiskLabourFetusMalpresentation=="yes"){
                            $key=array_search($user_index[$resiko->dusun],$result['data']['DATA A']['dusun']);
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
                                        $key=array_search($user_index[$resiko->dusun],$result['data']['DATA A']['dusun']);
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
        
        
        $query2 = $this->db->query("SELECT event_bidan_kunjungan_anc.baseEntityId,client_ibu.dusun,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId GROUP BY event_bidan_kunjungan_anc.docId ORDER BY ancDate")->result();
        $komplikasi = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $komplikasi)){
                $komplikasi[$q->baseEntityId] = [];
                array_push($komplikasi[$q->baseEntityId], $q);
            }else{
                array_push($komplikasi[$q->baseEntityId], $q);
            }
        }
        
        $query = $this->db->query("SELECT locationId,client_ibu.dusun,event_bidan_kunjungan_anc.baseEntityId,ancDate,komplikasidalamKehamilan FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE (ancDate > '$startdate' AND ancDate < '$enddate') GROUP BY event_bidan_kunjungan_anc.docId")->result();
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
        
        
        $datapersalinan= $this->db->query("SELECT event_bidan_dokumentasi_persalinan.* , client_anak.birthDate, client_anak.gender,client_ibu.dusun FROM client_anak,event_bidan_dokumentasi_persalinan LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_dokumentasi_persalinan.baseEntityId WHERE event_bidan_dokumentasi_persalinan.baseEntityId = client_anak.ibuCaseId AND client_anak.birthDate > '$startdate' AND client_anak.birthDate < '$enddate' GROUP BY event_bidan_dokumentasi_persalinan.docId")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->dusun, $user_index)){
                $key=array_search($user_index[$dsalin->dusun],$result['data']['DATA A']['dusun']);
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
        
        
        
        $datapersalinan= $this->db->query("SELECT event_bidan_dokumentasi_persalinan.* , client_anak.birthDate, client_anak.gender,client_ibu.dusun FROM client_anak,event_bidan_dokumentasi_persalinan LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_dokumentasi_persalinan.baseEntityId WHERE event_bidan_dokumentasi_persalinan.baseEntityId = client_anak.ibuCaseId AND client_anak.birthDate > '$startdate' AND client_anak.birthDate < '$enddate' GROUP BY event_bidan_dokumentasi_persalinan.docId")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->dusun, $user_index)){
                $key=array_search($user_index[$dsalin->dusun],$result['data']['DATA A']['dusun']);
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $result['data']['DATA']['fasilitas_bulan_ini'][$key] += 1;
                }
            }
        }
        
        $datavisit = $this->db->query("SELECT event_bidan_kunjungan_pnc.*,client_ibu.dusun  FROM event_bidan_kunjungan_pnc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_pnc.baseEntityId WHERE (PNCDate > '$startdate' AND PNCDate < '$enddate') AND hariKeKF='kf4' group by event_bidan_kunjungan_pnc.baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->dusun, $user_index)){
                $key=array_search($user_index[$dvisit->dusun],$result['data']['DATA A']['dusun']);
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
        
        $dataibu = $this->db->query("SELECT event_bidan_tambah_anc.*,client_ibu.dusun FROM event_bidan_tambah_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_tambah_anc.baseEntityId WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') GROUP BY event_bidan_tambah_anc.docId")->result();
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
        
        $datavisit = $this->db->query("SELECT event_bidan_kunjungan_anc.*,client_ibu.dusun FROM event_bidan_kunjungan_anc LEFT JOIN client_ibu ON client_ibu.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE (ancDate > '$startyear' AND ancDate < '$enddate') GROUP BY event_bidan_kunjungan_anc.docId")->result();
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
            if(array_key_exists($dvisit->dusun, $user_index)){
                $key=array_search($user_index[$dvisit->dusun],$result['data']['DATA A']['dusun']);
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
        $user_index = $this->loc->getDusunTypo($desa);
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
}