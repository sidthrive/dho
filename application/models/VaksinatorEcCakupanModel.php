<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorEcCakupanModel extends CI_Model{

    private $db;
    private $xlsForm = [];
    private $user   =  ['Saba'=>array('l'=>0,'p'=>0),'Tanak Awu'=>array('l'=>0,'p'=>0)];
    private $user_village = ['vaksinator2'=>'Saba','vaksinator12'=>'Tanak Awu'];
    private $bidan_village = ['user2'=>'Saba','user12'=>'Tanak Awu'];
            
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getDataVisit($clause=1){
        return $this->db->query("SELECT * FROM jurim_visit WHERE ".$clause)->result();
    }
    
    public function getDataRegistrasi($clause=1){
        return $this->db->query("SELECT * FROM registrasi_jurim WHERE ".$clause)->result();
    }
    
    private function cekImunisasiLengkap($childID){
        $im_table = ['bcg_visit','polio1_visit','hb1_visit','polio2_visit','dpt_hb2_visit','polio3_visit','hb3_visit','polio4_visit','campak_visit'];
        $lengkap = true;
        foreach ($im_table as $table){
            if(!($this->db->query("SELECT childId from $table WHERE childId = '$childID'")->num_rows()>0)){
                $lengkap = false;
                break;
            }
        }
        return $lengkap;
    }

    public function cakupanBulanIni(){
        $this->user = $this->ec->getCakupanContainer('vaksinator');
        $this->user_village = $this->loc->getIntLocId('vaksinator');
        $this->bidan_village = $this->loc->getIntLocId('vaksinator');
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        
        $hb0 = $bcg = $polio1 = $dpthb1 = $polio2 = $dpthb2 = $polio3 = $dpthb3 = $polio4 = $campak = $imunisasi = $campak_lanjutan = $tt1 = $tt2 = $tt3 = $tt4 = $tt5 = $uci = $this->user;
        
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startdate' AND hb0 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startdate' AND bcg < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");
//                if($jk->num_rows()>0){
//                    $jk = $jk->row()->jk;
//                }else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startdate' AND polio1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startdate' AND dpt_hb1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startdate' AND polio2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startdate' AND dpt_hb2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startdate' AND polio3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startdate' AND dpt_hb3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startdate' AND polio4 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startdate' AND imunisasi_campak < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        //calculate Imunisasi lengkap data
        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['l'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                    }
//               }
//            }
//        }
        
        
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate' AND campak_lanjutan < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='booster_campak';
        $series1['form']=$campak_lanjutan;
        array_push($this->xlsForm, $series1);
        
//        $bidanDB = $this->load->database('analytics', TRUE);
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startdate' AND ancDate < '$enddate'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['p'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['p'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['l'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['p'] +=1; 
//                    }
//               }
//            }
//        }
        
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function akumulasiBulanIni(){
        $this->user = $this->ec->getCakupanContainer('vaksinator');
        $this->user_village = $this->loc->getIntLocId('vaksinator');
        $this->bidan_village = $this->loc->getIntLocId('vaksinator');
        $startdate = date("Y-m");
        $startyear = date("Y").'-01';
        $enddate = date("Y-m", strtotime("+1 months"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        
        $hb0 = $bcg = $polio1 = $dpthb1 = $polio2 = $dpthb2 = $polio3 = $dpthb3 = $polio4 = $campak = $imunisasi = $campak_lanjutan = $tt1 = $tt2 = $tt3 = $tt4 = $tt5 = $uci = $this->user;
        
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startyear' AND hb0 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startyear' AND bcg < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startyear' AND polio1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startyear' AND dpt_hb1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startyear' AND polio2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startyear' AND dpt_hb2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startyear' AND polio3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startyear' AND dpt_hb3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startyear' AND polio4 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startyear' AND imunisasi_campak < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        //calculate Imunisasi lengkap data
        $lastyearfromthisjanuari = date("Y-m", strtotime($startyear." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthisjanuari' AND tanggal_lahir < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['l'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                    }
//               }
//            }
//        }
        
        
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startyear' AND campak_lanjutan < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['l'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='booster_campak';
        $series1['form']=$campak_lanjutan;
        array_push($this->xlsForm, $series1);
        
//        $bidanDB = $this->load->database('analytics', TRUE);
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startyear' AND ancDate < '$enddate'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['p'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['p'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['p'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthisjanuari' AND tanggal_lahir < '$enddate'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['l'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['p'] +=1; 
//                    }
//               }
//            }
//        }
        
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function bulanIniVsBulanLalu(){
        $this->user = $this->ec->getCakupanContainer('vaksinator');
        $this->user_village = $this->loc->getIntLocId('vaksinator');
        $this->bidan_village = $this->loc->getIntLocId('vaksinator');
        $startdate = date("Y-m");
        $enddate = date("Y-m", strtotime("+1 months"));
        $lastmonth = date("Y-m", strtotime("-1 months"));
        
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        $user   =  ['Saba'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Tanak Awu'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0)];
        $user = $this->ec->getCakupanContainer('vaksinator',TRUE);
        $hb0 = $bcg = $polio1 = $dpthb1 = $polio2 = $dpthb2 = $polio3 = $dpthb3 = $polio4 = $campak = $imunisasi = $campak_lanjutan = $tt1 = $tt2 = $tt3 = $tt4 = $tt5 = $uci = $user; 
        
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$lastmonth' AND hb0 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startdate' AND hb0 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        $series1['y_label']='Persentase';
        $series1['series_stack_name']=array("Bulan Lalu","Bulan Ini");
        $series1['series_name']=array("Laki-laki","Perempuan");
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$lastmonth' AND bcg < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startdate' AND bcg < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$lastmonth' AND polio1 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startdate' AND polio1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$lastmonth' AND dpt_hb1 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startdate' AND dpt_hb1 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$lastmonth' AND polio2 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startdate' AND polio2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$lastmonth' AND dpt_hb2 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startdate' AND dpt_hb2 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$lastmonth' AND polio3 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startdate' AND polio3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$lastmonth' AND dpt_hb3 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startdate' AND dpt_hb3 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$lastmonth' AND polio4 < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startdate' AND polio4 < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$lastmonth' AND imunisasi_campak < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startdate' AND imunisasi_campak < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
        $lastyearfromthismonth = date("Y-m", strtotime($lastmonth." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['lbl'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                    }
//               }
//            }
//        }
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['lbi'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                    }
//               }
//            }
//        }
        
        
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$lastmonth' AND campak_lanjutan < '$startdate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate' AND campak_lanjutan < '$enddate'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='booster_campak';
        $series1['form']=$campak_lanjutan;
        array_push($this->xlsForm, $series1);
        
//        $bidanDB = $this->load->database('analytics', TRUE);
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$lastmonth' AND ancDate < '$startdate'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['pbl'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['pbl'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startdate' AND ancDate < '$enddate'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['pbi'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['pbi'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
        $lastyearfromthismonth = date("Y-m", strtotime($lastmonth." -1 year"));
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$startdate'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['lbl'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['pbl'] +=1; 
//                    }
//               }
//            }
//        }
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['lbi'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['pbi'] +=1; 
//                    }
//               }
//            }
//        }
        
        $series1['page']='uci';
        $series1['form']=$uci;
        array_push($this->xlsForm, $series1);
        
        return $this->xlsForm;
    }
    
    public function tahunIniVsTahunLalu($bulan){
        $this->user_village = $this->loc->getIntLocId('vaksinator');
        $this->bidan_village = $this->loc->getIntLocId('vaksinator');
        $thismonth = $this->getBulanNum($bulan);
        $thisyear = date("Y");
        $lastyear = date("Y", strtotime("-1 year"));
        $startdate1 = date("Y-m",  strtotime($lastyear."-".$thismonth));
        $enddate1 = date("Y-m",  strtotime($startdate1." +1 month"));
        $startdate2 = date("Y-m",  strtotime($thisyear."-".$thismonth));
        $enddate2 = date("Y-m",  strtotime($startdate2." +1 month"));
//        $datavisit = $this->getDataVisit("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
//        $datareg = $this->getDataRegistrasi("clientVersionSubmissionDate > '".$startdate."' AND clientVersionSubmissionDate < '".$enddate."'");
        $user   =  ['Saba'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0),'Tanak Awu'=>array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0)];
        $user = $this->ec->getCakupanContainer('vaksinator',TRUE);
        $hb0 = $bcg = $polio1 = $dpthb1 = $polio2 = $dpthb2 = $polio3 = $dpthb3 = $polio4 = $campak = $imunisasi = $campak_lanjutan = $tt1 = $tt2 = $tt3 = $tt4 = $tt5 = $uci = $user; 
        
        $series1['y_label']='Persentase';
        $series1['series_stack_name']=array("Tahun Lalu","Tahun Ini");
        $series1['series_name']=array("Laki-laki","Perempuan");
        
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startdate1' AND hb0 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startdate2' AND hb0 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $hb0[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $hb0[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='hb0';
        $series1['form']=$hb0;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startdate1' AND bcg < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startdate2' AND bcg < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $bcg[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $bcg[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='bcg';
        $series1['form']=$bcg;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startdate1' AND polio1 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startdate2' AND polio1 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio1[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio1[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio1';
        $series1['form']=$polio1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startdate1' AND dpt_hb1 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startdate2' AND dpt_hb1 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb1[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb1';
        $series1['form']=$dpthb1;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startdate1' AND polio2 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startdate2' AND polio2 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio2[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio2[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio2';
        $series1['form']=$polio2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startdate1' AND dpt_hb2 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startdate2' AND dpt_hb2 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb2[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb2';
        $series1['form']=$dpthb2;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startdate1' AND polio3 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startdate2' AND polio3 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio3[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio3[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio3';
        $series1['form']=$polio3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startdate1' AND dpt_hb3 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startdate2' AND dpt_hb3 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $dpthb3[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='dpthb3';
        $series1['form']=$dpthb3;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startdate1' AND polio4 < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startdate2' AND polio4 < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $polio4[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $polio4[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='polio4';
        $series1['form']=$polio4;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startdate1' AND imunisasi_campak < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startdate2' AND imunisasi_campak < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        
        $series1['page']='campak';
        $series1['form']=$campak;
        array_push($this->xlsForm, $series1);
        
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate1." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['lbl'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                    }
//               }
//            }
//        }
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate2." -1 year"));
//        $datavisit = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $dvisit->jenis_kelamin;
//                if($this->cekImunisasiLengkap($dvisit->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['lbi'] +=1;    
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $imunisasi[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                    }
//               }
//            }
//        }
//        
        
        $series1['page']='imunisasi';
        $series1['form']=$imunisasi;
        array_push($this->xlsForm, $series1);
        
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate1' AND campak_lanjutan < '$enddate1'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['lbl'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $datavisit = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate2' AND campak_lanjutan < '$enddate2'")->result();
//        foreach ($datavisit as $dvisit){
//            if(array_key_exists($dvisit->userID, $this->user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$dvisit->childId."'");if($jk->num_rows()>0){$jk = $jk->row()->jk;}else continue;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['lbi'] +=1;     
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $campak_lanjutan[$this->user_village[$dvisit->userID]]['pbi'] +=1; 
//                }
//            }
//        }
//        
        
        $series1['page']='booster_campak';
        $series1['form']=$campak_lanjutan;
        array_push($this->xlsForm, $series1);
        
//        $bidanDB = $this->load->database('analytics', TRUE);
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startdate1' AND ancDate < '$enddate1'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['pbl'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['pbl'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['pbl'] +=1; 
//                }
//            }
//        }
//        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startdate2' AND ancDate < '$enddate2'")->result();
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->bidan_village)){
//                if($d->statusImunisasitt=="tt_ke_0"){
//                    $tt1[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_1"){
//                    $tt2[$this->bidan_village[$d->userID]]['pbi'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_2"){
//                    $tt3[$this->bidan_village[$d->userID]]['pbi'] +=1;  
//                }elseif($d->statusImunisasitt=="tt_ke_3"){
//                    $tt4[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }elseif($d->statusImunisasitt=="tt_ke_4"){
//                    $tt5[$this->bidan_village[$d->userID]]['pbi'] +=1; 
//                }
//            }
//        }
        
        $series1['page']='tt1';
        $series1['form']=$tt1;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt2';
        $series1['form']=$tt2;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt3';
        $series1['form']=$tt3;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt4';
        $series1['form']=$tt4;
        array_push($this->xlsForm, $series1);
        
        
        $series1['page']='tt5';
        $series1['form']=$tt5;
        array_push($this->xlsForm, $series1);
        
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate1." -1 year"));
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate1'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['lbl'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['pbl'] +=1; 
//                    }
//               }
//            }
//        }
//        $lastyearfromthismonth = date("Y-m", strtotime($startdate2." -1 year"));
//        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate2'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $this->user_village)){
//                $jk = $d->jenis_kelamin;
//                if($this->cekImunisasiLengkap($d->childId)){
//                    if($jk=="laki-laki"||$jk=="male"){
//                        $uci[$this->user_village[$d->userID]]['lbi'] +=1;   
//                    }elseif($jk=="perempuan"||$jk=="female"){
//                        $uci[$this->user_village[$d->userID]]['pbi'] +=1; 
//                    }
//               }
//            }
//        }
        
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