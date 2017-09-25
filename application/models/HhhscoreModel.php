<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HhhscoreModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    private function calc_anc($anc){
        
    }


    public function handScoreBulanIni($startdate,$enddate){
        set_time_limit(360);
        ini_set('memory_limit', '256M');
//        $date1 = date_create('2015-07-13');
//        $date2 = date_create('2015-11-18');
//        
//        $diff = date_diff($date1,$date2);
//        var_dump(ceil($diff->days/7));exit;
        
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getIntLocId('bidan');
        foreach ($desas as $dt=>$dn){
            $desas[$dt] = $dt;
        }
        foreach ($desas as $dt=>$dn){
            $form[$dn] = 0;
        }
        
        $v1 = $v2 = $v3 = $v4 = $v5 = $v6 = $v7 = $v8 = $v9 = $vt = $form;
        
        $anc_temp = ['ANC1'=>['n'=>0,'d'=>0],
            'ANC2'=>['n'=>0,'d'=>0],
            'ANC3'=>['n'=>0,'d'=>0],
            'ANC4'=>['n'=>0,'d'=>0],
            'BIRTH'=>['n'=>0,'d'=>0],
            'PNC1'=>['n'=>0,'d'=>0],
            'PNC2'=>['n'=>0,'d'=>0],
            'PNC3'=>['n'=>0,'d'=>0],
            'PNC4'=>['n'=>0,'d'=>0],
            'NEO1'=>['n'=>0,'d'=>0],
            'NEO2'=>['n'=>0,'d'=>0],
            'NEO3'=>['n'=>0,'d'=>0],
            'TB'=>['n'=>0,'d'=>0],
            'BB'=>['n'=>0,'d'=>0],
            'FE'=>['n'=>0,'d'=>0],
            'SIS'=>['n'=>0,'d'=>0],
            'DIAS'=>['n'=>0,'d'=>0],
            'DJJ'=>['n'=>0,'d'=>0],
            'LILA'=>['n'=>0,'d'=>0],
            'TFU'=>['n'=>0,'d'=>0],
            'PAP'=>['n'=>0,'d'=>0],
            'TT'=>['n'=>0,'d'=>0],
            'HB'=>['n'=>0,'d'=>0],
            'PU'=>['n'=>0,'d'=>0],
            'DIGIT'=>['n'=>0,'d'=>0],
            'NORMALITY'=>['n'=>0,'d'=>0]];
        
        $anc = [];
        foreach ($desas as $dt=>$dn){
            $anc[$dn] = $anc_temp;
        }
        
        $denum = [];
        foreach ($desas as $dt=>$dn){
            $denum[$dn] = [];
        }
        $denums = [];
        
        $mother = [];
        $d_anc = $this->db->query("SELECT event_bidan_kunjungan_anc.locationId,event_bidan_kunjungan_anc.baseEntityId,ancDate,event_bidan_tambah_anc.tanggalHPHT,event_bidan_kunjungan_anc.usiaKlinis,event_bidan_kunjungan_anc.trimesterKe,event_bidan_kunjungan_anc.kunjunganKe,event_bidan_kunjungan_anc.ancKe FROM event_bidan_kunjungan_anc LEFT JOIN event_bidan_tambah_anc on event_bidan_tambah_anc.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE ancDate <= '$enddate' ORDER BY event_bidan_kunjungan_anc.baseEntityId")->result();
        foreach ($d_anc as $x=>$d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_anc[$x]);
                continue;
            }
            $d->cleanvisit = 1;
        }
        
        $d_doc = [];
        $d_doc_neo = [];
        $d_ = $this->db->query("SELECT event_bidan_dokumentasi_persalinan.locationId,event_bidan_dokumentasi_persalinan.baseEntityId,client_anak.baseEntityId as childId,client_anak.birthDate as tanggalLahirAnak FROM event_bidan_dokumentasi_persalinan LEFT JOIN client_anak ON client_anak.ibuCaseId=event_bidan_dokumentasi_persalinan.baseEntityId ORDER BY event_bidan_dokumentasi_persalinan.baseEntityId")->result();
        foreach ($d_ as $x=>$d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_[$x]);
                continue;
            }
            $d->cleandoc = 1;
            $d_doc[$d->baseEntityId] = $d;
            $d_doc_neo[$d->childId] = $d;
        }
        
        $d_pnc = [];
        $d_ = $this->db->query("SELECT event_bidan_kunjungan_pnc.locationId,event_bidan_kunjungan_pnc.baseEntityId,client_anak.baseEntityId as childId,pncDate FROM event_bidan_kunjungan_pnc LEFT JOIN client_anak ON client_anak.ibuCaseId=event_bidan_kunjungan_pnc.baseEntityId ORDER BY event_bidan_kunjungan_pnc.baseEntityId")->result();
        foreach ($d_ as $d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_[$x]);
                continue;
            }
            $d->cleanpnc = 1;
            $d_pnc[$d->baseEntityId] = $d;
        }
        
        $child = [];
        $d_neo = [];
        $d_ = $this->db->query("SELECT event_bidan_kunjungan_neonatal.locationId,event_bidan_kunjungan_neonatal.baseEntityId as childId,kunjunganNeonatal,tanggalKunjunganBayiPerbulan FROM event_bidan_kunjungan_neonatal ORDER BY childId,tanggalKunjunganBayiPerbulan")->result();
        foreach ($d_ as $d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_[$x]);
                continue;
            }
            $d->cleanneo = 1;
            $d_neo[$d->childId] = $d;
        }
        
        $temp = [];
        
        foreach ($d_anc as $d){
            foreach ($d as $x=>$a){
                $temp[$x] = "";
            }
            break;
        }
        foreach ($d_doc as $d){
            foreach ($d as $x=>$a){
                $temp[$x] = "";
            }
            break;
        }
        foreach ($d_pnc as $d){
            foreach ($d as $x=>$a){
                $temp[$x] = "";
            }
            break;
        }
        
        $key = 0;
        $danc = [];
        foreach ($d_anc as $d){
            $danc[$key] = $temp;
            foreach ($d as $x=>$a){
                $danc[$key][$x] = $a;
            }
            if(array_key_exists($d->baseEntityId, $d_doc)){
                foreach ($d_doc[$d->baseEntityId] as $x=>$a){
                    $danc[$key][$x] = $a;
                }
            }
            if(array_key_exists($d->baseEntityId, $d_pnc)){
                foreach ($d_pnc[$d->baseEntityId] as $x=>$a){
                    $danc[$key][$x] = $a;
                }
            }
            $key++;
        }
        
        $temp = [];
        foreach ($d_doc_neo as $d){
            foreach ($d as $x=>$a){
                $temp[$x] = "";
            }
            break;
        }
        foreach ($d_neo as $d){
            foreach ($d as $x=>$a){
                $temp[$x] = "";
            }
            $temp['neodate'] = "";
            break;
        }
        
        $key = 0;
        $dneo = [];
        foreach ($d_neo as $d){
            $dneo[$key] = $temp;
            if(array_key_exists($d->childId, $d_doc_neo)){
                foreach ($d_doc_neo[$d->childId] as $x=>$a){
                    $dneo[$key][$x] = $a=='None'?'':$a;
                }
            }else{
                continue;
            }
            foreach ($d as $x=>$a){
                if($x=='tanggalKunjunganBayiPerbulan'){
                    if($a!=''){
                        $dneo[$key]['neodate'] = $a=='NULL'?'':$a;
                    }
                    unset($dneo[$key][$x]);
                }else $dneo[$key][$x] = $a=='None'?'':$a;
            }
            if($dneo[$key]['neodate']=='') unset($dneo[$key]);
            else $key++;
        }
        
//        var_dump($dneo);exit;
        
        $today = date_create(date('Y-m-d'));
        $ancnum = [];
        $pncnum = [];
        foreach ($danc as $a){
            if(!array_key_exists($a['baseEntityId'], $mother)){
                $ancnum[$a['baseEntityId']] = 1;
                $mother[$a['baseEntityId']] = [];
                $mother[$a['baseEntityId']]['locationId'] = $a['locationId'];
                $mother[$a['baseEntityId']]['baseEntityId'] = $a['baseEntityId'];
                if($a['tanggalHPHT']=='None'){
                    if($a['tanggalLahirAnak']!=''){
                        if($a['cleanpnc']==1){
                            $mother[$a['baseEntityId']]['tanggalHPHT'] = date('Y-m-d',  strtotime($a['tanggalLahirAnak']." -42 weeks"));
                        }else{
                            $mother[$a['baseEntityId']]['tanggalHPHT'] = date('Y-m-d',  strtotime($a['tanggalLahirAnak']." -40 weeks"));
                        }
                    }else{
                        if($a['trimesterKe']==1){
                            $mother[$a['baseEntityId']]['tanggalHPHT'] = date('Y-m-d',  strtotime($a['ancDate']." -11 weeks"));
                        }elseif($a['trimesterKe']==2){
                            $mother[$a['baseEntityId']]['tanggalHPHT'] = date('Y-m-d',  strtotime($a['ancDate']." -16 weeks"));
                        }else{
                            $mother[$a['baseEntityId']]['tanggalHPHT'] = date('Y-m-d',  strtotime($a['ancDate']." -28 weeks"));
                        }
                    }
                }else{
                    $mother[$a['baseEntityId']]['tanggalHPHT'] = $a['tanggalHPHT'];
                }
                $hpht = date_create($mother[$a['baseEntityId']]['tanggalHPHT']);
                $diff = date_diff($hpht,$today);
                $mother[$a['baseEntityId']]['tanggalLahirAnak'] = $a['tanggalLahirAnak'];
                $mother[$a['baseEntityId']]['cleanvisit'] = $a['cleanvisit'];
                $mother[$a['baseEntityId']]['cleandoc'] = $a['cleandoc'];
                $mother[$a['baseEntityId']]['cleanpnc'] = $a['cleanpnc'];
                $mother[$a['baseEntityId']]['GAnow'] = ceil($diff->days/7);
                if($mother[$a['baseEntityId']]['GAnow']>=0&&$mother[$a['baseEntityId']]['GAnow']<=12){
                    $mother[$a['baseEntityId']]['trimester'] = 1;
                }elseif($mother[$a['baseEntityId']]['GAnow']>=13&&$mother[$a['baseEntityId']]['GAnow']<=24){
                    $mother[$a['baseEntityId']]['trimester'] = 2;
                }elseif($mother[$a['baseEntityId']]['GAnow']>=25){
                    $mother[$a['baseEntityId']]['trimester'] = 3;
                }
                for($i=1;$i<=10;$i++){
                    $mother[$a['baseEntityId']]['anccontact_'.$i] = "";
                    $mother[$a['baseEntityId']]['GA_'.$i] = "";
                }
                $mother[$a['baseEntityId']]['anccontact_1'] = $a['ancDate'];
                $ancdate = date_create($mother[$a['baseEntityId']]['anccontact_1']);
                $diff = date_diff($hpht,$ancdate);
                $mother[$a['baseEntityId']]['GA_1'] = ceil($diff->days/7);
                $ancnum[$a['baseEntityId']]++;
                
                for($i=1;$i<=5;$i++){
                    $mother[$a['baseEntityId']]['pnccontact_'.$i] = "";
                    $mother[$a['baseEntityId']]['day_'.$i] = "";
                }
                if($a['pncDate']!=''){
                    $pncnum[$a['baseEntityId']] = 1;
                    $mother[$a['baseEntityId']]['pnccontact_1'] = $a['pncDate'];
                    $pncdate = date_create($mother[$a['baseEntityId']]['pnccontact_1']);
                    $birthdate = date_create($mother[$a['baseEntityId']]['tanggalLahirAnak']);
                    $diff = date_diff($birthdate,$pncdate);
                    $mother[$a['baseEntityId']]['day_1'] = $diff->days;
                    $pncnum[$a['baseEntityId']]++;
                }
            }else{
                $mother[$a['baseEntityId']]['anccontact_'.$ancnum[$a['baseEntityId']]] = $a['ancDate'];
                $ancdate = date_create($mother[$a['baseEntityId']]['anccontact_'.$ancnum[$a['baseEntityId']]]);
                $diff = date_diff($hpht,$ancdate);
                $mother[$a['baseEntityId']]['GA_'.$ancnum[$a['baseEntityId']]] = ceil($diff->days/7);
                
                if($a['pncDate']!=''){
                    if(array_key_exists($a['baseEntityId'], $pncnum)){
                        $pncnum[$a['baseEntityId']] = 1;
                        $mother[$a['baseEntityId']]['pnccontact_1'] = $a['pncDate'];
                        $pncdate = date_create($mother[$a['baseEntityId']]['pnccontact_1']);
                        $birthdate = date_create($mother[$a['baseEntityId']]['tanggalLahirAnak']);
                        $diff = date_diff($birthdate,$pncdate);
                        $mother[$a['baseEntityId']]['day_1'] = $diff->days;
                        $pncnum[$a['baseEntityId']]++;
                    }else{
                        $mother[$a['baseEntityId']]['pnccontact_'.$pncnum[$a['baseEntityId']]] = $a['pncDate'];
                        $pncdate = date_create($mother[$a['baseEntityId']]['pnccontact_'.$pncnum[$a['baseEntityId']]]);
                        $birthdate = date_create($mother[$a['baseEntityId']]['tanggalLahirAnak']);
                        $diff = date_diff($birthdate,$pncdate);
                        $mother[$a['baseEntityId']]['day_'.$pncnum[$a['baseEntityId']]] = $diff->days;
                        $pncnum[$a['baseEntityId']]++;
                    }
                }
            }
        }
        
        $neonum = [];
        foreach ($dneo as $a){
            if(!array_key_exists($a['childId'], $child)){
                $neonum[$a['childId']] = 1;
                $child[$a['childId']] = [];
                $child[$a['childId']]['locationId'] = $a['locationId'];
                $child[$a['childId']]['childId'] = $a['childId'];
                $child[$a['childId']]['tanggalLahirAnak'] = $a['tanggalLahirAnak'];
                for($i=1;$i<=5;$i++){
                    $child[$a['childId']]['neocontact_'.$i] = "";
                    $child[$a['childId']]['day_'.$i] = "";
                }
                $child[$a['childId']]['neocontact_1'] = $a['neodate'];
                $neodate = date_create($a['neodate']);
                $birthdate = date_create($child[$a['childId']]['tanggalLahirAnak']);
                $diff = date_diff($birthdate,$neodate);
                $child[$a['childId']]['day_1'] = $diff->days;
                $neonum[$a['childId']]++;
            }else{
                $child[$a['childId']]['neocontact_'.$neonum[$a['childId']]] = $a['neodate'];
                $neodate = date_create($a['neodate']);
                $birthdate = date_create($child[$a['baseEntityId']]['tanggalLahirAnak']);
                $diff = date_diff($birthdate,$neodate);
                $child[$a['childId']]['day_'.$neonum[$a['childId']]] = $diff->days;
                $neonum[$a['childId']]++;
            }
        }
        
//        var_dump($mother);exit;
//        var_dump($child);exit;
        
        $anc1 = $mother;
        foreach ($anc1 as $x=>$a){
            $visit = 0;
            $anc_done = [1=>FALSE,2=>FALSE,3=>FALSE,4=>FALSE];
            $pnc_done = [1=>FALSE,2=>FALSE,3=>FALSE,4=>FALSE];
            for($i=1;$i<=10;$i++){
                if($a['GA_'.$i]>=29&&$a['GA_'.$i]<=41&&$a['GA_'.$i]!=''){
                    $visit++;
                }    
            }
            for($i=1;$i<=10;$i++){
                if($a['GA_'.$i]>=0&&$a['GA_'.$i]<=13&&$a['GA_'.$i]!=''){
                    $anc_done[1] = TRUE;
                    break;
                }
                if($a['GA_'.$i]>=13&&$a['GA_'.$i]<=29&&$a['GA_'.$i]!=''){
                    $anc_done[2] = TRUE;
                    break;
                }
                if($a['GA_'.$i]>=29&&$a['GA_'.$i]<=41&&$a['GA_'.$i]!=''){
                    if($visit>=2){
                        $anc_done[4] = TRUE;
                    }
                    $anc_done[3] = TRUE;
                    break;
                }    
            }
            $hpht = date_create($a['tanggalHPHT']);
            for($i=1;$i<=13;$i++){
                $week = date_create(date('Y-m-d',strtotime($startdate." +".$i." weeks")));
                $diff = date_diff($hpht,$week);
                $week = ceil($diff->days/7);
                if($week==12){
                    if($anc_done[1]){
                        $anc[$desas[$a['locationId']]]['ANC1']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['ANC1']['d']++;
                    break;
                }
                if($week==28){
                    if($anc_done[2]){
                        $anc[$desas[$a['locationId']]]['ANC2']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['ANC2']['d']++;
                    break;
                }
                if($week==40){
                    $anc[$desas[$a['locationId']]]['BIRTH']['n']++;
                    if($anc_done[3]){
                        $anc[$desas[$a['locationId']]]['ANC3']['n']++;
                        $anc[$desas[$a['locationId']]]['ANC4']['d']++;
                    }
                    if($anc_done[4]){
                        $anc[$desas[$a['locationId']]]['ANC4']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['ANC3']['d']++;
                    break;
                }
            }
            for($i=1;$i<=13;$i++){
                if($week<40&&$a['tanggalLahirAnak']!=''){
                    $anc[$desas[$a['locationId']]]['BIRTH']['n']++;
                    break;
                }
            }
            if($a['tanggalLahirAnak']!=''){
                $anc[$desas[$a['locationId']]]['BIRTH']['d']++;
                $birthdate = date_create($a['tanggalLahirAnak']);
                
                for($i=1;$i<=5;$i++){
                    if($a['day_'.$i]>=0&&$a['day_'.$i]<=6&&$a['day_'.$i]!=''){
                        $pnc_done[1] = TRUE;
                        break;
                    }
                    if($a['day_'.$i]>=3&&$a['day_'.$i]<=11&&$a['day_'.$i]!=''){
                        $pnc_done[2] = TRUE;
                        break;
                    }
                    if($a['day_'.$i]>=8&&$a['day_'.$i]<=32&&$a['day_'.$i]!=''){
                        $pnc_done[3] = TRUE;
                        break;
                    }
                    if($a['day_'.$i]>=29&&$a['day_'.$i]<=45&&$a['day_'.$i]!=''){
                        $pnc_done[4] = TRUE;
                        break;
                    }   
                }

                for($i=1;$i<=91;$i++){

                    $day = date_create(date('Y-m-d',strtotime($startdate." +".$i." day")));
                    $diff = date_diff($birthdate,$day);
                    $day = $diff->days;
                    if($day==3){
                        if($pnc_done[1]){
                            $anc[$desas[$a['locationId']]]['PNC1']['n']++;
                        }
                        $anc[$desas[$a['locationId']]]['PNC1']['d']++;
                    }
                    if($day==8){
                        if($pnc_done[2]){
                            $anc[$desas[$a['locationId']]]['PNC2']['n']++;
                        }
                        $anc[$desas[$a['locationId']]]['PNC2']['d']++;
                    }
                    if($day==29){
                        if($pnc_done[3]){
                            $anc[$desas[$a['locationId']]]['PNC3']['n']++;
                        }
                        $anc[$desas[$a['locationId']]]['PNC3']['d']++;
                    }
                    if($day==42){
                        if($pnc_done[4]){
                            $anc[$desas[$a['locationId']]]['PNC4']['n']++;
                        }
                        $anc[$desas[$a['locationId']]]['PNC4']['d']++;
                    }
                }
            }
            
            
        }
        
        $neo1 = $child;
        foreach ($neo1 as $x=>$a){
            $visit = 0;
            $neo_done = [1=>FALSE,2=>FALSE,3=>FALSE];
            $birthdate = date_create($a['tanggalLahirAnak']);
            for($i=1;$i<=5;$i++){
                if($a['day_'.$i]>=0&&$a['day_'.$i]<=6&&$a['day_'.$i]!=''){
                    $neo_done[1] = TRUE;
                    break;
                }
                if($a['day_'.$i]>=3&&$a['day_'.$i]<=11&&$a['day_'.$i]!=''){
                    $neo_done[2] = TRUE;
                    break;
                }
                if($a['day_'.$i]>=8&&$a['day_'.$i]<=32&&$a['day_'.$i]!=''){
                    $neo_done[3] = TRUE;
                    break;
                }
                if($a['day_'.$i]>=29&&$a['day_'.$i]<=45&&$a['day_'.$i]!=''){
                    $neo_done[4] = TRUE;
                    break;
                }   
            }
            for($i=1;$i<=91;$i++){
                $day = date_create(date('Y-m-d',strtotime($startdate." +".$i." day")));
                $diff = date_diff($birthdate,$day);
                $day = $diff->days;
                if($day==3){
                    if($neo_done[1]){
                        $anc[$desas[$a['locationId']]]['NEO1']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['NEO1']['d']++;
                }
                if($day==8){
                    if($neo_done[2]){
                        $anc[$desas[$a['locationId']]]['NEO2']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['NEO2']['d']++;
                }
                if($day==29){
                    if($neo_done[3]){
                        $anc[$desas[$a['locationId']]]['NEO3']['n']++;
                    }
                    $anc[$desas[$a['locationId']]]['NEO3']['d']++;
                }
            }
        }
        
        $d_anc_reg = $this->db->query("SELECT locationId,baseEntityId,trimesterKe,tbCM FROM event_bidan_tambah_anc WHERE referenceDate >= '$startdate' AND referenceDate <= '$enddate' ORDER BY baseEntityId")->result();
        $d_anc = $this->db->query("SELECT locationId,baseEntityId,trimesterKe,bbKg,tandaVitalTDSistolik,tandaVitalTDDiastolik,hasilPemeriksaanLILA,tfu,djj,statusImunisasitt,pelayananInjeksitt,pelayananfe0,kepalaJaninTerhadapPAP FROM event_bidan_kunjungan_anc WHERE ancDate >= '$startdate' AND ancDate <= '$enddate' ORDER BY baseEntityId")->result();
        $d_anc_lab = $this->db->query("SELECT locationId,baseEntityId,referenceDate,laboratoriumPeriksaHbHasil,laboratoriumProteinUria FROM event_bidan_kunjungan_anc_lab_test WHERE referenceDate >= '$startdate' AND referenceDate <= '$enddate' ORDER BY baseEntityId")->result();
        foreach ($d_anc_reg as $x=>$d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_anc_reg[$x]);
                continue;
            }
        }
        foreach ($d_anc as $x=>$d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_anc[$x]);
                continue;
            }
        }
        foreach ($d_anc_lab as $x=>$d){
            if (!array_key_exists($d->locationId, $desas)) {
                unset($d_anc_lab[$x]);
                continue;
            }
        }
        
        $digit = [];
        $digit_cov = [];
        foreach ($desas as $dt=>$dn){
            $digit['bb'][$dn] = [];
            $digit['lila'][$dn] = [];
            $digit['tb'][$dn] = [];
            $digit_cov['bb'][$dn] = [0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0];
            $digit_cov['lila'][$dn] = [0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0];
            $digit_cov['tb'][$dn] = [0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0];
        }
        $digit_num = $digit_cov;
        foreach ($d_anc_reg as $d){
            if ($d->tbCM!='NULL'&&$d->tbCM!='') {
                $anc[$d->locationId]['TB']['n']++;
                $anc[$d->locationId]['TB']['d']++;
                array_push($digit['tb'][$d->locationId], intval($d->tbCM));
                $digit_num['tb'][$d->locationId][intval($d->tbCM)%10]++;
            }else{
                $anc[$d->locationId]['TB']['d']++;
            }
        }
        
        foreach ($d_anc as $d){
            if ($d->bbKg!='NULL'&&$d->bbKg!='') {
                $anc[$d->locationId]['BB']['n']++;
                $anc[$d->locationId]['BB']['d']++;
                array_push($digit['bb'][$d->locationId], intval($d->bbKg));
                $digit_num['bb'][$d->locationId][intval($d->bbKg)%10]++;
            }else{
                $anc[$d->locationId]['BB']['d']++;
            }
            if ($d->pelayananfe0=='Ya'&&($d->trimesterKe==1||$d->trimesterKe==2)) {
                $anc[$d->locationId]['FE']['n']++;
                $anc[$d->locationId]['FE']['d']++;
            }elseif ($d->trimesterKe==1||$d->trimesterKe==2) {
                $anc[$d->locationId]['FE']['d']++;
            }
            if ($d->tandaVitalTDSistolik!='NULL'&&$d->tandaVitalTDSistolik!='') {
                $anc[$d->locationId]['SIS']['n']++;
                $anc[$d->locationId]['SIS']['d']++;
            }else{
                $anc[$d->locationId]['SIS']['d']++;
            }
            if ($d->tandaVitalTDDiastolik!='NULL'&&$d->tandaVitalTDDiastolik!='') {
                $anc[$d->locationId]['DIAS']['n']++;
                $anc[$d->locationId]['DIAS']['d']++;
            }else{
                $anc[$d->locationId]['DIAS']['d']++;
            }
            if ($d->hasilPemeriksaanLILA!='NULL'&&$d->hasilPemeriksaanLILA!='') {
                $anc[$d->locationId]['LILA']['n']++;
                $anc[$d->locationId]['LILA']['d']++;
                array_push($digit['lila'][$d->locationId], intval($d->hasilPemeriksaanLILA));
                $digit_num['lila'][$d->locationId][intval($d->hasilPemeriksaanLILA)%10]++;
            }else{
                $anc[$d->locationId]['LILA']['d']++;
            }
            if ($d->tfu!='NULL'&&$d->tfu!=''&&($d->trimesterKe==2||$d->trimesterKe==3)) {
                $anc[$d->locationId]['TFU']['n']++;
                $anc[$d->locationId]['TFU']['d']++;
            }elseif ($d->trimesterKe==2||$d->trimesterKe==3) {
                $anc[$d->locationId]['TFU']['d']++;
            }
            if ($d->djj!='NULL'&&$d->djj!=''&&($d->trimesterKe==2||$d->trimesterKe==3)) {
                $anc[$d->locationId]['DJJ']['n']++;
                $anc[$d->locationId]['DJJ']['d']++;
            }elseif ($d->trimesterKe==3||$d->trimesterKe==3) {
                $anc[$d->locationId]['DJJ']['d']++;
            }
            if ($d->pelayananInjeksitt!='jika_dilakukan'&&($d->trimesterKe==1||$d->trimesterKe==2)) {
                $anc[$d->locationId]['TT']['n']++;
                $anc[$d->locationId]['TT']['d']++;
            }elseif ($d->trimesterKe==1||$d->trimesterKe==2) {
                $anc[$d->locationId]['TT']['d']++;
            }
            if ($d->kepalaJaninTerhadapPAP!='NULL'&&$d->kepalaJaninTerhadapPAP!=''&&$d->trimesterKe==3) {
                $anc[$d->locationId]['PAP']['n']++;
                $anc[$d->locationId]['PAP']['d']++;
            }elseif ($d->trimesterKe==3) {
                $anc[$d->locationId]['PAP']['d']++;
            }
            if ($d->trimesterKe==1||$d->trimesterKe==3) {
                $anc[$d->locationId]['HB']['d']++;
                $anc[$d->locationId]['PU']['d']++;
            }
        }
        foreach ($d_anc_lab as $d){
            if ($d->laboratoriumPeriksaHbHasil!='NULL'&&$d->laboratoriumPeriksaHbHasil!='') {
                $anc[$d->locationId]['HB']['n']++;
            }
            if ($d->laboratoriumProteinUria!='NULL'&&$d->laboratoriumProteinUria!='') {
                $anc[$d->locationId]['PU']['n']++;
            }
        }
        
        foreach ($digit_num as $var=>$users){
            foreach ($users as $user=>$data){
                $jml = $this->sum($data);
                foreach ($data as $x=>$val){
                    $digit_cov[$var][$user][$x] = $jml==0?0:$val*100/$jml;
                    if ($digit_cov[$var][$user][$x]>=5&&$digit_cov[$var][$user][$x]<=15) {
                        $anc[$user]['DIGIT']['n']++;
                        $anc[$user]['DIGIT']['d']++;
                    }else{
                        $anc[$user]['DIGIT']['d']++;
                    }
                }
            }
        }
        
        $normality = [];
        
        foreach ($digit as $var=>$users){
            foreach ($users as $user=>$data){
                sort($data);
                $normality[$var][$user]['data'] = $data;
                $normality[$var][$user]['quantile'] = [];
                $normality[$var][$user]['z'] = [];
                $normality[$var][$user]['z_norms'] = [];
                $normality[$var][$user]['jml'] = [];
                $normality[$var][$user]['zs'] = [];
                $n = count($data);
                $mean = array_sum($data) / $n;
                $mean = (float)number_format((float)$mean, 2, '.', '');
                $std = $this->standard_deviation($data,true);
                $std = (float)number_format((float)$std, 2, '.', '');
                foreach ($data as $x=>$val){
                    $normality[$var][$user]['quantile'][$x] = (($x+1)-0.5)/$n;
                    $normality[$var][$user]['z'][$x] = ($val-$mean)/$std;
                    $normality[$var][$user]['z_norms'][$x] = $this->cdf($normality[$var][$user]['quantile'][$x]);
                    if ($normality[$var][$user]['z'][$x]<-2) {
                        $normality[$var][$user]['jml'][$x] = 1;
                    }elseif ($normality[$var][$user]['z'][$x]>=-2&&$normality[$var][$user]['z'][$x]<-1) {
                        $normality[$var][$user]['jml'][$x] = 2;
                    }elseif ($normality[$var][$user]['z'][$x]>=-1&&$normality[$var][$user]['z'][$x]<0) {
                        $normality[$var][$user]['jml'][$x] = 3;
                    }elseif ($normality[$var][$user]['z'][$x]>=0&&$normality[$var][$user]['z'][$x]<1) {
                        $normality[$var][$user]['jml'][$x] = 4;
                    }elseif ($normality[$var][$user]['z'][$x]>=1&&$normality[$var][$user]['z'][$x]<2) {
                        $normality[$var][$user]['jml'][$x] = 5;
                    }elseif ($normality[$var][$user]['z'][$x]>2) {
                        $normality[$var][$user]['jml'][$x] = 6;
                    }
                    if ($normality[$var][$user]['z_norms'][$x]<-2) {
                        $normality[$var][$user]['zs'][$x] = 1;
                    }elseif ($normality[$var][$user]['z_norms'][$x]>=-2&&$normality[$var][$user]['z_norms'][$x]<-1) {
                        $normality[$var][$user]['zs'][$x] = 2;
                    }elseif ($normality[$var][$user]['z_norms'][$x]>=-1&&$normality[$var][$user]['z_norms'][$x]<0) {
                        $normality[$var][$user]['zs'][$x] = 3;
                    }elseif ($normality[$var][$user]['z_norms'][$x]>=0&&$normality[$var][$user]['z_norms'][$x]<1) {
                        $normality[$var][$user]['zs'][$x] = 4;
                    }elseif ($normality[$var][$user]['z_norms'][$x]>=1&&$normality[$var][$user]['z_norms'][$x]<2) {
                        $normality[$var][$user]['zs'][$x] = 5;
                    }elseif ($normality[$var][$user]['z_norms'][$x]>2) {
                        $normality[$var][$user]['zs'][$x] = 6;
                    }
                }
            }
        }
        
        $tb = $bb = $fe = $sistol = $diastol = $lila = $tfu = $djj = $tt = $pap = $hb = $pu = $dc = $norm = $form;
        
        $handscore = $handscore2 = $form;
        
        foreach ($anc as $desa=>$a){
            $x = $a['ANC1']['n']+$a['ANC2']['n']+$a['ANC3']['n']+$a['ANC4']['n']+$a['PNC1']['n']+$a['PNC2']['n']+$a['PNC3']['n']+$a['PNC4']['n']+$a['BIRTH']['n'];
            $y = $a['ANC1']['d']+$a['ANC2']['d']+$a['ANC3']['d']+$a['ANC4']['d']+$a['PNC1']['d']+$a['PNC2']['d']+$a['PNC3']['d']+$a['PNC4']['d']+$a['BIRTH']['d'];
            $hs1 = $y==0?0:100*$x/$y;
            $x = $a['TB']['n']+$a['BB']['n']+$a['FE']['n']+$a['SIS']['n']+$a['DIAS']['n']+$a['LILA']['n']+$a['TFU']['n']+$a['DJJ']['n']+$a['TT']['n']+$a['PAP']['n']+$a['HB']['n']+$a['PU']['n'];
            $y = $a['TB']['d']+$a['BB']['d']+$a['FE']['d']+$a['SIS']['d']+$a['DIAS']['d']+$a['LILA']['d']+$a['TFU']['d']+$a['DJJ']['d']+$a['TT']['d']+$a['PAP']['d']+$a['HB']['d']+$a['PU']['d'];
            $hs2 = $y==0?0:100*$x/$y;
            $x = $a['DIGIT']['d']==0?0:100*$a['DIGIT']['n']/$a['DIGIT']['d'];
            $y = $a['NORMALITY']['d']==0?0:100*$a['NORMALITY']['n']/$a['NORMALITY']['d'];
            $hs3 = ($x+$y)/2;
            $handscore[$desa] = ($hs1*$hs2*$x)/10000;
            $handscore2[$desa] = ($hs1+$hs2+$x)/3;
                    
            $x = $a['ANC1']['n']+$a['ANC2']['n']+$a['ANC3']['n']+$a['ANC4']['n'];
            $y = $a['ANC1']['d']+$a['ANC2']['d']+$a['ANC3']['d']+$a['ANC4']['d'];
            $v1[$desa] = $y==0?0:100*$x/$y;
            $x = $a['PNC1']['n']+$a['PNC2']['n']+$a['PNC3']['n']+$a['PNC4']['n'];
            $y = $a['PNC1']['d']+$a['PNC2']['d']+$a['PNC3']['d']+$a['PNC4']['d'];
            $v2[$desa] = $y==0?0:100*$x/$y;
            $x = $a['BIRTH']['n'];
            $y = $a['BIRTH']['d'];
            $v3[$desa] = $y==0?0:100*$x/$y;
            $x = $a['NEO1']['n']+$a['NEO2']['n']+$a['NEO3']['n'];
            $y = $a['NEO1']['d']+$a['NEO2']['d']+$a['NEO3']['d'];
            $v4[$desa] = $y==0?0:100*$x/$y;
            
            $x = $a['TB']['n'];
            $y = $a['TB']['d'];
            $tb[$desa] = $y==0?0:100*$x/$y;
            $x = $a['BB']['n'];
            $y = $a['BB']['d'];
            $bb[$desa] = $y==0?0:100*$x/$y;
            $x = $a['FE']['n'];
            $y = $a['FE']['d'];
            $fe[$desa] = $y==0?0:100*$x/$y;
            $x = $a['SIS']['n'];
            $y = $a['SIS']['d'];
            $sistol[$desa] = $y==0?0:100*$x/$y;
            $x = $a['DIAS']['n'];
            $y = $a['DIAS']['d'];
            $diastol[$desa] = $y==0?0:100*$x/$y;
            $x = $a['LILA']['n'];
            $y = $a['LILA']['d'];
            $lila[$desa] = $y==0?0:100*$x/$y;
            $x = $a['TFU']['n'];
            $y = $a['TFU']['d'];
            $tfu[$desa] = $y==0?0:100*$x/$y;
            $x = $a['DJJ']['n'];
            $y = $a['DJJ']['d'];
            $djj[$desa] = $y==0?0:100*$x/$y;
            $x = $a['TT']['n'];
            $y = $a['TT']['d'];
            $tt[$desa] = $y==0?0:100*$x/$y;
            $x = $a['PAP']['n'];
            $y = $a['PAP']['d'];
            $pap[$desa] = $y==0?0:100*$x/$y;
            $x = $a['HB']['n'];
            $y = $a['HB']['d'];
            $hb[$desa] = $y==0?0:100*$x/$y;
            $x = $a['PU']['n'];
            $y = $a['PU']['d'];
            $pu[$desa] = $y==0?0:100*$x/$y;
            $x = $a['DIGIT']['n'];
            $y = $a['DIGIT']['d'];
            $dc[$desa] = $y==0?0:100*$x/$y;
            $x = $a['NORMALITY']['n'];
            $y = $a['NORMALITY']['d'];
            $norm[$desa] = $y==0?0:100*$x/$y;
        }
        
        $series1['page']='gen1';
        $series1['title']='TOTAL HAND SCORE by PRODUCT';
        $series1['symbol']='%';
        $series1['form']=$handscore;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen1_2';
        $series1['title']='TOTAL HAND SCORE by AVERAGE';
        $series1['symbol']='%';
        $series1['form']=$handscore2;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen2';
        $series1['title']='Cakupan ANC';
        $series1['symbol']='%';
        $series1['form']=$v1;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen3';
        $series1['title']='Cakupan PNC';
        $series1['symbol']='%';
        $series1['form']=$v2;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen4';
        $series1['title']='Cakupan Kelahiran';
        $series1['symbol']='%';
        $series1['form']=$v3;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen5';
        $series1['title']='Cakupan Neonatal';
        $series1['symbol']='%';
        $series1['form']=$v4;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        //---------------------------------
        $series1['page']='tb';
        $series1['title']='Pengukuran Tinggi Badan';
        $series1['symbol']='%';
        $series1['form']=$tb;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='bb';
        $series1['title']='Penimbangan Berat Badan';
        $series1['symbol']='%';
        $series1['form']=$bb;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='fe';
        $series1['title']='Pemberian FE';
        $series1['symbol']='%';
        $series1['form']=$fe;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='sistol';
        $series1['title']='Pengukuran Sistolik';
        $series1['symbol']='%';
        $series1['form']=$sistol;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='diastol';
        $series1['title']='Pengukuran Diastolik';
        $series1['symbol']='%';
        $series1['form']=$diastol;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='lila';
        $series1['title']='Pengukuran LILA';
        $series1['symbol']='%';
        $series1['form']=$lila;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='tfu';
        $series1['title']='Pengukuran TFU';
        $series1['symbol']='%';
        $series1['form']=$tfu;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='djj';
        $series1['title']='Perhitungan DJJ';
        $series1['symbol']='%';
        $series1['form']=$djj;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='tt';
        $series1['title']='Pemberian TT';
        $series1['symbol']='%';
        $series1['form']=$tt;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='pap';
        $series1['title']='Perhitungan PAP';
        $series1['symbol']='%';
        $series1['form']=$pap;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='hb';
        $series1['title']='Pemeriksaan HB';
        $series1['symbol']='%';
        $series1['form']=$hb;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='pu';
        $series1['title']='Pemeriksaan Protein Urin';
        $series1['symbol']='%';
        $series1['form']=$pu;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen9';
        $series1['title']='Digit Check';
        $series1['symbol']='%';
        $series1['form']=$dc;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        $series1['page']='gen10';
        $series1['title']='Normality Check';
        $series1['symbol']='%';
        $series1['form']=$norm;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    private function getUnit($val){
        return $val%10;
    } 
    
    private function sum($arr){
        $ret = 0;
        foreach ($arr as $r){
            $ret+=$r;
        }
        return $ret;
    }
    
    private function standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
           --$n;
        }
        return sqrt($carry / $n);
    }
    
    private function erf($x) 
    { 
        $pi = 3.1415927; 
        $a = (8*($pi - 3))/(3*$pi*(4 - $pi)); 
        $x2 = $x * $x; 

        $ax2 = $a * $x2; 
        $num = (4/$pi) + $ax2; 
        $denom = 1 + $ax2; 

        $inner = (-$x2)*$num/$denom; 
        $erf2 = 1 - exp($inner); 

        return sqrt($erf2); 
    } 

    private function cdf($n) 
    { 
        if($n < 0) 
        { 
                return (1 - $this->erf($n / sqrt(2)))/2; 
        } 
        else 
        { 
                return (1 + $this->erf($n / sqrt(2)))/2; 
        } 
    } 
    
    public function heartScoreBulanIni(){
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getIntLocId('bidan');
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='TOTAL HEART SCORE';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Cakupan ANC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Cakupan PNC';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Cakupan Kelahiran';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Cakupan Neonatal';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
}