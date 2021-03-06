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
    
    private function isGainedWeight($jk,$umur,$berat){
        $mwi = [0,0.8,0.9,0.8,0.6,0.5,0.4,0.4,0.3,0.3,0.3,0.3,0.2];
        $fwi = [0,0.8,0.9,0.8,0.6,0.5,0.4,0.3,0.3,0.3,0.3,0.2,0.2];
        $hist_umur = preg_split('/-/', $umur, -1, PREG_SPLIT_NO_EMPTY);
        $hist_berat = preg_split('/-/', $berat, -1, PREG_SPLIT_NO_EMPTY);
        $jml = count($hist_umur)-1;
        $selisih_umur = $hist_umur[$jml]-$hist_umur[$jml-1];
        $selisih_berat = $hist_berat[$jml]
                -$hist_berat[$jml-1];
        if($hist_umur[$jml]>12){
            if($selisih_umur==1&&$selisih_berat>=0.2){
                return true;
            }else{
                return false;
            }
        }else{
            if($jk=="laki-laki"||$jk=="male"){
                if($selisih_umur==1&&$selisih_berat>=$mwi[$hist_umur[$jml]]){
                    return true;
                }else{
                    return false;
                }
            }elseif($jk=="perempuan"||$jk=="female"){
                if($selisih_umur==1&&$selisih_berat>=$fwi[$hist_umur[$jml]]){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
    
    private function isBgm($jk,$umur,$berat){
        $maleBgm = [2.1,2.9,3.8,4.4,4.9,5.3,5.7,5.9,6.2,6.4,6.6,6.8,6.9,
            7.1,7.2,7.4,7.5,7.7,7.8,8,8.1,8.2,8.4,8.5,8.6,8.8,
            8.9,9,9.1,9.2,9.3,9.5,9.6,9.7,9.8,9.9,10,10.1,10.2,
            10.3,10.4,10.5,10.6,10.7,10.8,10.9,11,11.1,11.2,11.3,
            11.4,11.5,11.6,11.7,11.8,11.9,12,12.1,12.2,12.3,12.4];
        $femaleBgm = [2.0,2.7,3.4,4,4.4,4.8,5.1,5.3,5.6,5.8,5.9,6.1,6.3,
            6.4,6.6,6.7,6.9,7,7.2,7.3,7.5,7.6,7.8,7.9,8.1,
            8.2,8.4,8.5,8.6,8.8,8.9,9,9.1,9.2,9.4,9.5,9.6,
            9.7,9.8,9.9,10,10.2,10.3,10.4,10.5,10.6,10.7,
            10.8,10.9,11,11.1,11.2,11.3,11.4,11.5,11.6,11.7,
            11.8,11.9,12,12.1];
        $indikator = ($jk=="male"||$jk=="laki-laki")?$maleBgm[$umur]:$femaleBgm[$umur];
        return $berat<=$indikator;
    }

    public function cakupanBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $xlsForm = [];
        $startyear = date("Y-m",  strtotime($tahun.'-1'));
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        $target_bulin   =  ['Saba'=>190,'Tanak Awu'=>207];
        $target_bumil   =  ['Saba'=>199,'Tanak Awu'=>217];
        $sasaran = ['Saba'=>916,'Tanak Awu'=>1002];
        $user   =  ['Saba'=>0,'Tanak Awu'=>0];
        $user_village = ['gizi2'=>'Saba','gizi12'=>'Tanak Awu'];
        $bidan_village = ['user2'=>'Saba','user12'=>'Tanak Awu'];
        
        $datads = $this->getDataKunjungan("(umur <= 59) AND (tanggalPenimbangan > '$startdate' AND tanggalPenimbangan < '$enddate')");
        $balita = $user;
        $nd     = $user;
        $bgm    = $user;
        $asi    = $user;
        foreach ($datads as $dds){
            if(array_key_exists($dds->userID, $user_village)){
                $balita[$user_village[$dds->userID]] += 1;
                $jk = $this->db->query("SELECT jenisKelamin as jk FROM registrasi_gizi WHERE childID = '".$dds->childId."'")->row()->jk;
                if(strtolower($dds->nutrition_status)=="n"){
                    $nd[$user_village[$dds->userID]] += 1;
                }elseif($dds->nutrition_status==""||$dds->nutrition_status=="-"){
                    if($this->isGainedWeight($jk,$dds->history_umur, $dds->history_berat)){
                        $nd[$user_village[$dds->userID]] += 1;
                    }
                }
                if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                    $bgm[$user_village[$dds->userID]] += 1;
                }elseif($dds->bgm==""||$dds->bgm=="-"){
                    if($this->isBgm($jk,abs($dds->umur),abs($dds->beratBadan))){
                        $bgm[$user_village[$dds->userID]] += 1;
                    }
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
        
        foreach ($nd as $x=>$n){
            if($balita[$x]==0)
                continue;
            $n = $n*100/$balita[$x];
            $nd[$x] = $n;
        }
        
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
        array_push($xlsForm, $series1);
        
        $series1['page']='bgmd';
        $series1['form']=$bgm;
        array_push($xlsForm, $series1);
        
        $bidanDB = $this->load->database('analytics', TRUE);
        $vitfe = $vitA = $user;
        $vitfe_ = $vitA_ = [];
        $datavisit= $bidanDB->query("SELECT * FROM kartu_pnc_visit WHERE referenceDate > '$startyear' AND referenceDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $bidan_village)){
                if($dvisit->vitaminA2jamPP!="None"&&$dvisit->vitaminA2jamPP!=""){
                    if($dvisit->vitaminA24jamPP!="None"&&$dvisit->vitaminA24jamPP!=""){
                        if(!array_key_exists($dvisit->motherId, $vitA_)){
                            $vitA[$bidan_village[$dvisit->userID]] += 1;
                            $vitA_[$dvisit->motherId] = TRUE;
                        }
                    }
                }
                if($dvisit->pelayananfe!="None"&&$dvisit->pelayananfe!=""&&$dvisit->pelayananfe!="Tidak"){
                    if(!array_key_exists($dvisit->motherId, $vitfe_)){
                        $vitfe[$bidan_village[$dvisit->userID]] += 1;
                        $vitfe_[$dvisit->motherId] = TRUE;
                    }
                }
            }
        }
        $series1['page']='vitA';
        $series1['form']=$vitA;
        array_push($xlsForm, $series1);
        
        $series1['page']='vitfe';
        $series1['form']=$vitfe;
        array_push($xlsForm, $series1);
        
        $anemia = $user;
        $anemia_ = [];
        $datavisit= $bidanDB->query("SELECT * FROM kartu_anc_visit_labTest WHERE referenceDate > '$startyear' AND referenceDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $bidan_village)){
                if($dvisit->laboratoriumPeriksaHbAnemia='positif'){
                    if(!array_key_exists($dvisit->motherId, $anemia_)){
                        $anemia[$bidan_village[$dvisit->userID]] += 1;
                        $anemia_[$dvisit->motherId] = TRUE;
                    }
                }
            }
        }
        foreach ($anemia as $x=>$n){
            if($target_bumil[$x]==0)
                continue;
            $n = $n*100/$target_bumil[$x];
            $anemia[$x] = $n;
        }
        $series1['page']='anemia';
        $series1['form']=$anemia;
        array_push($xlsForm, $series1);
        
        $fe1 = $fe3 = $kek = $user;
        $fe1_ = $fe3_ = $kek_ = [];
        $datavisit= $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startyear' AND ancDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $bidan_village)){
                if($dvisit->pelayananfe0=="Ya"&&$dvisit->ancKe==1){
                    if(!array_key_exists($dvisit->motherId, $fe1_)){
                        $fe1[$bidan_village[$dvisit->userID]] += 1;
                        $fe1_[$dvisit->motherId] = TRUE;
                    }
                }
                if($dvisit->pelayananfe0=="Ya"&&$dvisit->ancKe==4){
                    if(!array_key_exists($dvisit->motherId, $fe3_)){
                        $fe3[$bidan_village[$dvisit->userID]] += 1;
                        $fe3_[$dvisit->motherId] = TRUE;
                    }
                }
                if($dvisit->highRiskPregnancyProteinEnergyMalnutrition='yes'){
                    if(!array_key_exists($dvisit->motherId, $kek_)){
                        $kek[$bidan_village[$dvisit->userID]] += 1;
                        $kek_[$dvisit->motherId] = TRUE;
                    }
                }
            }
        }
        foreach ($kek as $x=>$n){
            if($target_bumil[$x]==0)
                continue;
            $n = $n*100/$target_bumil[$x];
            $kek[$x] = $n;
        }
        foreach ($fe1 as $x=>$n){
            if($target_bulin[$x]==0)
                continue;
            $n = $n*100/$target_bulin[$x];
            $fe1[$x] = $n;
        }
        foreach ($fe3 as $x=>$n){
            if($target_bulin[$x]==0)
                continue;
            $n = $n*100/$target_bulin[$x];
            $fe3[$x] = $n;
        }
        
        $series1['page']='kek';
        $series1['form']=$kek;
        array_push($xlsForm, $series1);
        
        $series1['page']='gibur';
        $series1['form']=$bgm;
        array_push($xlsForm, $series1);
        
        $series1['page']='fe1';
        $series1['form']=$fe1;
        array_push($xlsForm, $series1);
        
        $series1['page']='fe3';
        $series1['form']=$fe3;
        array_push($xlsForm, $series1);
        
        $series1['page']='asi';
        $series1['form']=$asi;
        array_push($xlsForm, $series1);
        
        $bblr = $user;
        $datapersalinan= $bidanDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $bidan_village)){
                if($dsalin->beratLahir<2500){
                    $bblr[$bidan_village[$dsalin->userID]] += 1;
                }
            }
        }
        $datapersalinan= $bidanDB->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $bidan_village)){
                if($dsalin->beratLahir<2500){
                    $bblr[$bidan_village[$dsalin->userID]] += 1;
                }
            }
        }
        
        $series1['page']='bblr';
        $series1['form']=$bblr;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
}