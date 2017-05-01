<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MmnModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    private function trim($str){
        return str_replace(".", '', trim($str));
    }
    
    public function cakupanBulanIni($kab){
        $db = $this->load->database('analytics', TRUE);
        $y = date("Y");
        $m = date("m");
        $nm = date("m",  strtotime(date("Y-m-d")." +1 month"));
        $startDate = $y."-".$m."-01";
        $endDate = date("Y-m-d",  strtotime($y."-".$nm."-01 -1 day"));
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        
        if($kab=='Kabupaten Lombok Tengah'){
            $desas2 = $this->loc->getLocId($kab." 2");
            $form2 = [];
            foreach ($desas2 as $dt=>$dn){
                $form2[$dn] = rand(15, 30);
            }
        }
        
        if($kab=='Kabupaten Lombok Tengah'){
            $v1 = $v2 = $v3 = $v9 = $v10 = $v11 = $form;
            $v4 = $v5 = $v6 = $v7 = $v8 = $v12 = $v13 = $v14 = $v15 = $v16 = $v17 = $v17a = $v18 = $v19 = $v19a = $v20 = $v21 =  $v21a = $v22 = $form2;
        }else{
            $v1 = $v2 = $v3 = $v9 = $v10 = $v11 = $form;
        }
        
        
        
//        $data = $db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE ancDate >= '$startDate' AND ancDate <= '$endDate' GROUP BY docId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','pemberianmmn'=>'yes']);array_push($data, (object)['locationId'=>'Jempong Baru','pemberianmmn'=>'yes']);
        foreach ($data as $d){
            $loc = $this->trim($d->locationId);
            if(array_key_exists($loc, $form)){
                if($d->pemberianmmn=='yes'){
                    $v1[$loc]++;
                }
            }
        }
        
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$v1;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        

//        $data = $db->query("SELECT locationId, COUNT( * ) AS jml 
//                            FROM event_bidan_tambah_anc
//                            WHERE event_bidan_tambah_anc.baseEntityId NOT 
//                            IN (
//
//                            SELECT baseEntityId
//                            FROM event_bidan_dokumentasi_persalinan
//                            GROUP BY baseEntityId
//                            )
//                            AND event_bidan_tambah_anc.baseEntityId NOT 
//                            IN (
//
//                            SELECT baseEntityId
//                            FROM event_bidan_penutupan_anc
//                            GROUP BY baseEntityId
//                            )
//                            GROUP BY locationId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','jml'=>17]);
        foreach ($data as $d){
            $loc = $this->trim($d->locationId);
            if(array_key_exists($loc, $form)){
                $v2[$loc]+=$d->jml;
            }
        }
        foreach ($v2 as $dt=>$val){
            if($val==0)continue;
            $v2[$dt] = $v1[$dt]*100/$val;
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$v2;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
//        $data = $db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE ancDate >= '$startDate' AND ancDate <= '$endDate' GROUP BY docId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','pemberianmmn'=>'yes','jumlah_mmn'=>2]);array_push($data, (object)['locationId'=>'Jempong Baru','pemberianmmn'=>'yes','jumlah_mmn'=>3]);
        foreach ($data as $d){
            $loc = $this->trim($d->locationId);
            if(array_key_exists($loc, $form)){
                if($d->pemberianmmn=='yes'){
                    $v3[$loc]+=$d->jumlah_mmn;
                }
            }
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$v3;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
       
        if($kab=='Kabupaten Lombok Tengah'){
    //        $data = $db->query("SELECT * FROM kunjungan gizi WHERE tanggalPenimbangan >= '$startDate' AND tanggalPenimbangan <= '$endDate' GROUP BY docId")->result();
            $anak = [];
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','underweight'=>'Underweight','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','underweight'=>'Severely Underweight','baseEntityId'=>'aaa']);
            foreach ($data as $d){
                $loc = $this->trim($d->locationId);
                if(array_key_exists($loc, $form)){
                    if($d->underweight=='Underweight'||$d->underweight=='Severely Underweight'){
                        $anak[$d->baseEntityId] = TRUE;
                        $v4[$loc]++;
                    }
                }
            }
            $series1['page']='gen4';
            $series1['title']='Jumlah anak yang BB/U <-2SD';
            $series1['symbol']='';
            $series1['form']=$v4;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);
        
    //        $data = $db->query("SELECT * FROM home_inventory_0_2_tahun WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY baseEntityId")->result();
    //        $data = $db->query("SELECT * FROM home_inventory_3_6_tahun WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY baseEntityId")->result();
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru']);array_push($data, (object)['locationId'=>'Jempong Baru']);
            foreach ($data as $d){
                $loc = $this->trim($d->locationId);
                if(array_key_exists($loc, $form)){
                        $v5[$loc]++;
                }
            }
            $series1['page']='gen5';
            $series1['title']='Jumlah anak yang dites Home';
            $series1['symbol']='';
            $series1['form']=$v5;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            if($kab=='Kabupaten Lombok Tengah')
            array_push($xlsForm, $series1);


    //        $data = $db->query("SELECT home_inventory_0_2_tahun.*,client_anak.ibuCaseId FROM home_inventory_0_2_tahun LEFT JOIN client_anak ON client_anak.ibuCaseId=home_inventory_0_2_tahun.baseEntityId WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY home_inventory_0_2_tahun.baseEntityId")->result();
    //        $data = $db->query("SELECT home_inventory_3_6_tahun.*,client_anak.ibuCaseId FROM home_inventory_3_6_tahun LEFT JOIN client_anak ON client_anak.ibuCaseId=home_inventory_3_6_tahun.baseEntityId WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY home_inventory_3_6_tahun.baseEntityId")->result();
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb']);
            foreach ($data as $d){
                $loc = $this->trim($d->locationId);
                if(array_key_exists($loc, $form)){
                    if(array_key_exists($d->baseEntityId, $anak)){
                        $v6[$loc]++;
                    }
                }
            }
            $series1['page']='gen6';
            $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
            $series1['symbol']='';
            $series1['form']=$v6;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            if($kab=='Kabupaten Lombok Tengah')
            array_push($xlsForm, $series1);


    //        $data = $db->query("SELECT home_inventory_0_2_tahun.*,client_anak.ibuCaseId FROM home_inventory_0_2_tahun LEFT JOIN client_anak ON client_anak.ibuCaseId=home_inventory_0_2_tahun.baseEntityId WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY home_inventory_0_2_tahun.baseEntityId")->result();
    //        $home = [];
    //        foreach($data as $d){
    //            $home[$d->baseEntityId] = ['loc'=>$d->locationId,'umur'=>'02','skor'=>0,'idIbu'=>$d->ibuCaseId];
    //            foreach($d as $key=>$val){
    //                if($val=='yes'){
    //                    $home[$d->baseEntityId]['skor]++;
    //                }
    //            }
    //        }
    //        $data = $db->query("SELECT home_inventory_3_6_tahun.*,client_anak.ibuCaseId FROM home_inventory_3_6_tahun LEFT JOIN client_anak ON client_anak.ibuCaseId=home_inventory_3_6_tahun.baseEntityId WHERE tanggal_kunjungan_home >= '$startDate' AND tanggal_kunjungan_home <= '$endDate' GROUP BY home_inventory_3_6_tahun.baseEntityId")->result();
    //        foreach($data as $d){
    //            $home[$d->baseEntityId] = ['loc'=>$d->locationId,'umur'=>'36','skor'=>0,'idIbu'=>$d->ibuCaseId];
    //            foreach($d as $key=>$val){
    //                if($val=='yes'){
    //                    $home[$d->baseEntityId]['skor]++;
    //                }
    //            }
    //        }
            $home['abc'] = ['loc'=>'Jempong Baru','umur'=>'02','skor'=>21,'idIbu'=>'abc'];
            $home['def'] = ['loc'=>'Jempong Baru','umur'=>'36','skor'=>31,'idIbu'=>'cdb'];
            $home['xyz'] = ['loc'=>'Jempong Baru','umur'=>'02','skor'=>28,'idIbu'=>'xyz'];
            foreach ($home as $d){
                $loc = $this->trim($d['loc']);
                if(array_key_exists($loc, $form)){
                    if(($d['umur']=='02'&&$d['skor']<=21)||($d['umur']=='36'&&$d['skor']<=33)){
                        $v7[$loc]++;
                    }
                }
            }
            $series1['page']='gen7';
            $series1['title']='Jumlah anak yang memiliki skor Home rendah';
            $series1['symbol']='';
            $series1['form']=$v7;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            if($kab=='Kabupaten Lombok Tengah')
            array_push($xlsForm, $series1);


            foreach ($v5 as $dt=>$val){
                if($val==0)continue;
                $v8[$dt] = $v7[$dt]*100/$val;
            }
            $series1['page']='gen8';
            $series1['title']='Persentase anak yang memiliki skor Home rendah';
            $series1['symbol']='%';
            $series1['form']=$v8;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            if($kab=='Kabupaten Lombok Tengah')
            array_push($xlsForm, $series1);
        }
        
        $parana = [];
//        $data = $db->query("SELECT * FROM parana WHERE tanggal_sesi1 <= '$endDate' GROUP BY baseEntityId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb']);
        foreach($data as $d){
            $parana[$d->baseEntityId] = ['loc'=>$d->locationId,'sesi'=>1];
        }
//        $data = $db->query("SELECT * FROM parana2 WHERE tanggal_sesi2 <= '$endDate' GROUP BY baseEntityId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'xyz']);
        foreach($data as $d){
            if(array_key_exists($d->baseEntityId,$parana)){
                $parana[$d->baseEntityId]['sesi']++;
            }else{
                $parana[$d->baseEntityId] = ['loc'=>$d->locationId,'sesi'=>1];
            }
        }
//        $data = $db->query("SELECT * FROM parana3 WHERE tanggal_sesi3 <= '$endDate' GROUP BY baseEntityId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb']);
        foreach($data as $d){
            if(array_key_exists($d->baseEntityId,$parana)){
                $parana[$d->baseEntityId]['sesi']++;
            }else{
                $parana[$d->baseEntityId] = ['loc'=>$d->locationId,'sesi'=>1];
            }
        }
//        $data = $db->query("SELECT * FROM parana4 WHERE tanggal_sesi4 <= '$endDate' GROUP BY baseEntityId")->result();
        $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cde']);
        foreach($data as $d){
            if(array_key_exists($d->baseEntityId,$parana)){
                $parana[$d->baseEntityId]['sesi']++;
            }else{
                $parana[$d->baseEntityId] = ['loc'=>$d->locationId,'sesi'=>1];
            }
        }
        
        
        foreach ($parana as $p){
            if(array_key_exists($p['loc'],$form)){
                $v9[$p['loc']]++;
            }
        }
        
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$v9;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($parana as $p){
            if(array_key_exists($p['loc'],$form)){
                if($p['sesi']==4){
                    $v10[$p['loc']]++;
                }
            }
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$v10;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($v9 as $dt=>$val){
            if($val==0)continue;
            $v11[$dt] = $v10[$dt]*100/$val;
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$v11;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        if($kab=='Kabupaten Lombok Tengah'){
            foreach ($home as $d){
                $loc = $this->trim($d['loc']);
                if(array_key_exists($loc, $form)){
                    if(($d['umur']=='02'&&$d['skor']<=21)||($d['umur']=='36'&&$d['skor']<=33)){
                        if(array_key_exists($d['idIbu'],$parana)){
                            $v12[$loc]++;
                        }
                    }
                }
            }
            $series1['page']='gen12';
            $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
            $series1['symbol']='';
            $series1['form']=$v12;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            foreach ($home as $d){
                $loc = $this->trim($d['loc']);
                if(array_key_exists($loc, $form)){
                    if(($d['umur']=='02'&&$d['skor']<=21)||($d['umur']=='36'&&$d['skor']<=33)){
                        if(array_key_exists($d['idIbu'],$parana)){
                            if($parana[$d['idIbu']]['sesi']==4){
                                $v13[$loc]++;
                            }
                        }
                    }
                }
            }
            $series1['page']='gen13';
            $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
            $series1['symbol']='';
            $series1['form']=$v13;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            foreach ($v12 as $dt=>$val){
                if($val==0)continue;
                $v14[$dt] = $v13[$dt]*100/$val;
            }
            $series1['page']='gen14';
            $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
            $series1['symbol']='%';
            $series1['form']=$v14;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            array_push($xlsForm, $series1);


            $series1['page']='gen15';
            $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
            $series1['symbol']='';
            $series1['form']=$v15;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            $series1['page']='gen16';
            $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
            $series1['symbol']='%';
            $series1['form']=$v16;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            array_push($xlsForm, $series1);

            //kpsp data retrieve
            $kpsp1 = [];
    //        $data = $db->query("SELECT * FROM kpsp_1_tahun WHERE tanggalTes <= '$endDate'")->result();
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','jenisKunjungan'=>'1']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb','jenisKunjungan'=>'1']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','jenisKunjungan'=>'2']);
            foreach ($data as $d){
                if(!array_key_exists($d->baseEntityId, $kpsp1)){
                    $kpsp1[$d->baseEntityId] = ['kunj_1'=>FALSE,'kunj_2'=>FALSE];
                }
                if($d->jenisKunjungan=='1'){
                    $kpsp1[$d->baseEntityId]['kunj_1'] = TRUE;
                }elseif($d->jenisKunjungan=='2'){
                    $kpsp1[$d->baseEntityId]['kunj_2'] = TRUE;
                }
            }
            $kpsp2 = [];
    //        $data = $db->query("SELECT * FROM kpsp_2_tahun WHERE tanggalTes <= '$endDate'")->result();
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','jenisKunjungan'=>'1']);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','jenisKunjungan'=>'2']);
            foreach ($data as $d){
                if(!array_key_exists($d->baseEntityId, $kpsp2)){
                    $kpsp2[$d->baseEntityId] = ['kunj_1'=>FALSE,'kunj_2'=>FALSE];
                }
                if($d->jenisKunjungan=='1'){
                    $kpsp2[$d->baseEntityId]['kunj_1'] = TRUE;
                }elseif($d->jenisKunjungan=='2'){
                    $kpsp2[$d->baseEntityId]['kunj_2'] = TRUE;
                }
            }
            $kpsp3 = [];
    //        $data = $db->query("SELECT * FROM kpsp_3_tahun WHERE tanggalTes <= '$endDate'")->result();
            $data = [];
            foreach ($data as $d){
                if(!array_key_exists($d->baseEntityId, $kpsp3)){
                    $kpsp3[$d->baseEntityId] = ['kunj_1'=>FALSE,'kunj_2'=>FALSE];
                }
                if($d->jenisKunjungan=='1'){
                    $kpsp3[$d->baseEntityId]['kunj_1'] = TRUE;
                }elseif($d->jenisKunjungan=='2'){
                    $kpsp3[$d->baseEntityId]['kunj_2'] = TRUE;
                }
            }
            $kpsp4 = [];
    //        $data = $db->query("SELECT * FROM kpsp_4_tahun WHERE tanggalTes <= '$endDate'")->result();
            foreach ($data as $d){
                if(!array_key_exists($d->baseEntityId, $kpsp4)){
                    $kpsp4[$d->baseEntityId] = ['kunj_1'=>FALSE,'kunj_2'=>FALSE];
                }
                if($d->jenisKunjungan=='1'){
                    $kpsp4[$d->baseEntityId]['kunj_1'] = TRUE;
                }elseif($d->jenisKunjungan=='2'){
                    $kpsp4[$d->baseEntityId]['kunj_2'] = TRUE;
                }
            }
            $kpsp5 = [];
    //        $data = $db->query("SELECT * FROM kpsp_5_tahun WHERE tanggalTes <= '$endDate'")->result();
            foreach ($data as $d){
                if(!array_key_exists($d->baseEntityId, $kpsp5)){
                    $kpsp5[$d->baseEntityId] = ['kunj_1'=>FALSE,'kunj_2'=>FALSE];
                }
                if($d->jenisKunjungan=='1'){
                    $kpsp5[$d->baseEntityId]['kunj_1'] = TRUE;
                }elseif($d->jenisKunjungan=='2'){
                    $kpsp5[$d->baseEntityId]['kunj_2'] = TRUE;
                }
            }

            /* NEED TO DIFFERENTIATE TO AGE INTERVAL!!!!!!!!!!!!!!  */

            $bayi = [];
    //        $data = $db->query("SELECT * FROM kunjungan gizi WHERE tanggalPenimbangan <= '$endDate'")->result();
            $data = [];array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb','umur'=>324]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'abc','umur'=>132]);
            array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'cdb','umur'=>324]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'xyz','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'scd','umur'=>132]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'xyz','umur'=>132]);
            array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>368]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>399]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>414]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>446]);
            array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>558]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>590]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>632]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>700]);
            array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>754]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>790]);array_push($data, (object)['locationId'=>'Jempong Baru','baseEntityId'=>'zzz','umur'=>872]);
            foreach($data as $d){
                $loc = $this->trim($d->locationId);
                if(array_key_exists($loc, $form)){
                    if(!array_key_exists($d->baseEntityId, $bayi)){
                        $bayi[$d->baseEntityId] = ['loc'=>$loc,'kunjungan_bayi'=>0,'kunjungan_balita1'=>0,'kunjungan_balita2'=>0,'kpsp'=>0];
                    }
                    if($d->umur<366){
                        $bayi[$d->baseEntityId]['kunjungan_bayi']++;
                    }elseif(($d->umur>=366&&$d->umur<548)||($d->umur>=731&&$d->umur<913)||($d->umur>=1096&&$d->umur<1278)||($d->umur>=1461&&$d->umur<1643)){
                        $bayi[$d->baseEntityId]['kunjungan_balita1']++;
                    }elseif(($d->umur>=548&&$d->umur<731)||($d->umur>=913&&$d->umur<1096)||($d->umur>=1278&&$d->umur<1461)||($d->umur>=1643&&$d->umur<1826)){
                        $bayi[$d->baseEntityId]['kunjungan_balita2']++;
                    }
                }
            }

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if($b['kunjungan_bayi']>=1){
                        $v17a[$b['loc']]++;
                    }
                }
            }

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if(($b['kunjungan_bayi']>=4)&&($kpsp1[$bei]['kunj_1']&&$kpsp1[$bei]['kunj_2'])){
                        $v17[$b['loc']]++;
                    }
                }
            }

            $series1['page']='gen17';
            $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
            $series1['symbol']='';
            $series1['form']=$v17;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            foreach ($v17a as $dt=>$val){
                if($val==0)continue;
                $v18[$dt] = $v17[$dt]*100/$val;
            }
            $series1['page']='gen18';
            $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
            $series1['symbol']='%';
            $series1['form']=$v18;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            array_push($xlsForm, $series1);

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if($b['kunjungan_balita1']>=1){
                        $v19a[$b['loc']]++;
                    }
                }
            }

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if(($b['kunjungan_balita1']>=4)&&($kpsp2[$bei]['kunj_1']||$kpsp3[$bei]['kunj_1']||$kpsp4[$bei]['kunj_1']||$kpsp5[$bei]['kunj_1'])){
                        $v19[$b['loc']]++;
                    }
                }
            }

            $series1['page']='gen19';
            $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
            $series1['symbol']='';
            $series1['form']=$v19;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            foreach ($v19a as $dt=>$val){
                if($val==0)continue;
                $v20[$dt] = $v19[$dt]*100/$val;
            }
            $series1['page']='gen20';
            $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
            $series1['symbol']='%';
            $series1['form']=$v20;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            array_push($xlsForm, $series1);

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if($b['kunjungan_balita2']>=1){
                        $v21a[$b['loc']]++;
                    }
                }
            }

            foreach ($bayi as $bei=>$b){
                if(array_key_exists($b['loc'], $form)){
                    if(($b['kunjungan_balita1']>=4&&$b['kunjungan_balita2']>=4)&&(($kpsp2[$bei]['kunj_1']&&$kpsp2[$bei]['kunj_2'])||($kpsp3[$bei]['kunj_1']&&$kpsp3[$bei]['kunj_2'])||($kpsp4[$bei]['kunj_1']&&$kpsp4[$bei]['kunj_2'])||($kpsp5[$bei]['kunj_1']&&$kpsp5[$bei]['kunj_2']))){
                        $v21[$b['loc']]++;
                    }
                }
            }
            $series1['page']='gen21';
            $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
            $series1['symbol']='';
            $series1['form']=$v21;
            $series1['y_label']='Jumlah';
            $series1['series_name']='Jumlah';
            array_push($xlsForm, $series1);

            foreach ($v21a as $dt=>$val){
                if($val==0)continue;
                $v22[$dt] = $v21[$dt]*100/$val;
            }
            $series1['page']='gen22';
            $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
            $series1['symbol']='%';
            $series1['form']=$v22;
            $series1['y_label']='Persentase';
            $series1['series_name']='Persentase';
            array_push($xlsForm, $series1);
        }
        
        return $xlsForm;
        
    }
    
    public function cakupanAkumulatif($kab){
        $xlsForm = [];
        $form = [];
        $desas = $this->loc->getLocId($kab);
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Jumlah anak yang BB/U <-2SD';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Jumlah anak yang dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Persentase anak yang memiliki skor Home rendah';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen12';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen13';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen14';
        $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen15';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen16';
        $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen17';
        $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen18';
        $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen19';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen20';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen21';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($desas as $dt=>$dn){
            $form[$dn] = rand(15, 30);
        }
        $series1['page']='gen22';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
    public function semuabulan($kab){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $xlsForm = [];
        $form = [];
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen1';
        $series1['title']='Jumlah Ibu yang menerima MMN';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen2';
        $series1['title']='Persentase ibu hamil yang mendapat MMN';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen3';
        $series1['title']='Jumlah total MMN yang diberikan ke ibu hamil';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen4';
        $series1['title']='Jumlah anak yang BB/U <-2SD';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen5';
        $series1['title']='Jumlah anak yang dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen6';
        $series1['title']='Jumlah anak yang BB/U <-SD dan dites Home';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen7';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen8';
        $series1['title']='Persentase anak yang memiliki skor Home rendah';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen9';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen10';
        $series1['title']='Jumlah ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen11';
        $series1['title']='Persentase ibu yang mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen12';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen13';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen14';
        $series1['title']='Persentase anak yang memiliki skor Home rendah dan ibunya mengikuti sesi Parana lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen15';
        $series1['title']='Jumlah anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen16';
        $series1['title']='Persentase anak yang memiliki skor Home rendah, ibunya ibunya telah mengikuti sesi Parana lengkap dan skor Homenya naik';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen17';
        $series1['title']='Jumlah bayi yang mendapat Kunjungan Bayi Lengkap';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen18';
        $series1['title']='Persentase bayi yang mendapat Kunjungan Bayi Bayi Lengkap';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen19';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen20';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 1';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen21';
        $series1['title']='Jumlah anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
        
        
        foreach ($bulan_map as $bln=>$num){
            $form[ucfirst($bln)] = rand(15, 30);
        }
        $series1['page']='gen22';
        $series1['title']='Persentase anak yang mendapat Kunjungan Balita 2';
        $series1['symbol']='%';
        $series1['form']=$form;
        $series1['y_label']='Persentase';
        $series1['series_name']='Persentase';
        array_push($xlsForm, $series1);
        
        return $xlsForm;
    }
    
}