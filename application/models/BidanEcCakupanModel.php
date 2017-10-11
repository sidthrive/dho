<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanEcCakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
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
    
    public function cakupanBulanIni($kec,$bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startyear = date("Y-m",  strtotime($tahun.'-01'));
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user_village = $this->loc->getLocId($this->session->userdata('location'));
            $user = $this->ec->getSpvCakupanContainer('bidan',$this->session->userdata('location'));
        }else{
            $user_village = $this->loc->getLocId($kec);
            $user = $this->ec->getCakupanContainerKec($kec);
        }
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$enddate') AND ancKe=1 group by id")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_village)){
                if(!$this->isHaveDoneAnc1($dvisit)){
                    $form[$user_village[$dvisit->userId]] += 1;
                }
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $nilai*100/$target_bumil[$desa];
//        }
        
        $series1['page']='K1A';
        $series1['target']=(int)$bulan_map[$bulan]*96/12;
        $series1['form']=$form;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$enddate') AND ancKe=4 group by id")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_village)){
                if(!$this->isHaveDoneAnc4($dvisit)){
                    $form[$user_village[$dvisit->userId]] += 1;
                }
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $nilai*100/$target_bumil[$desa];
//        }
        
        $series2['page']='K4';
        $series2['target']=(int)$bulan_map[$bulan]*96/12;
        $series2['form']=$form;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startyear' AND ancDate < '$enddate')")->result();
        $query = $this->db->query("SELECT id FROM kartu_anc_visit_labTest WHERE laboratoriumPeriksaHbAnemia='positif'")->result();
        $laboratoriumPeriksaHbAnemia = [];
        foreach ($query as $q){
            if(!array_key_exists($q->id, $laboratoriumPeriksaHbAnemia)){
                $laboratoriumPeriksaHbAnemia[$q->id] = TRUE;
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
            if(array_key_exists($dvisit->id, $tertangani)){
                continue;
            }
            if(array_key_exists($dvisit->userId, $user_village)){
                if($dvisit->komplikasidalamKehamilan!="None"&&$dvisit->komplikasidalamKehamilan!=''&&$dvisit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                    if($dvisit->rujukan=="Ya"){
                        $tertangani[$dvisit->id] = 'yes';
                        $form[$user_village[$dvisit->userId]] += 1;
                        continue;
                    }
                }
                if($dvisit->pelayananFe0=="Ya"&&array_key_exists($dvisit->id, $laboratoriumPeriksaHbAnemia)){
                    $tertangani[$dvisit->id] = 'yes';
                    $form[$user_village[$dvisit->userId]] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->id, $highRiskTuberculosis)){
                    $tertangani[$dvisit->id] = 'yes';
                    $form[$user_village[$dvisit->userId]] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->id, $highRiskMalaria)){
                    $tertangani[$dvisit->id] = 'yes';
                    $form[$user_village[$dvisit->userId]] += 1;
                    continue;
                }
                if(array_key_exists($dvisit->id, $highRiskHIVAIDS)){
                    $tertangani[$dvisit->id] = 'yes';
                    $form[$user_village[$dvisit->userId]] += 1;
                    continue;
                }
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $nilai*100/$target_mt[$desa];
//        }
        $series3['page']='MT';
        $series3['target']=(int)$bulan_map[$bulan]*96/12;
        $series3['form']=$form;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $likes = $user;
        $nakes = $user;
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startyear' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userId, $user_village)){
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $likes[$user_village[$dsalin->userId]] += 1;
                }
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    $nakes[$user_village[$dsalin->userId]] += 1;
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahir > '$startyear' AND tanggalLahir < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userId, $user_village)){
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $likes[$user_village[$dsalin->userId]] += 1;
                }
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    $nakes[$user_village[$dsalin->userId]] += 1;
                }
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $likes[$desa] = $likes[$desa]*100/$target_bulin[$desa];
//            $nakes[$desa] = $nakes[$desa]*100/$target_bulin[$desa];
//        }
        
        
        $series4['page']='PDFK';
        $series4['target']=(int)$bulan_map[$bulan]*96/12;
        $series4['form']=$likes;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
        
        $series5['page']='PDTK';
        $series5['target']=(int)$bulan_map[$bulan]*96/12;
        $series5['form']=$nakes;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (PNCDate > '$startyear' AND PNCDate < '$enddate') AND (hariKeKF='kf3' OR hariKeKF='kf4') group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_village)){
                $form[$user_village[$dvisit->userId]] += 1;
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $nilai*100/$target_bufas[$desa];
//        }
        
        $series6['page']='KN';
        $series6['target']=(int)$bulan_map[$bulan]*96/12;
        $series6['form']=$form;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $form = $user;
        $form2 = $user;
        $datavisit = $this->db->query("SELECT * FROM kohort_bayi_neonatal_period WHERE submissionDate > '$startyear' AND submissionDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_village)){
                if($dvisit->kunjunganNeonatal=="Pertama"){
                    $form[$user_village[$dvisit->userId]] += 1;
                }elseif($dvisit->kunjunganNeonatal=="Ketiga"){
                    $form2[$user_village[$dvisit->userId]] += 1;
                }
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $form[$desa]*100/$target_bufas[$desa];
//            $form2[$desa] = $form2[$desa]*100/$target_bufas[$desa];
//        }
        
        $series7['page']='KNN1';
        $series7['target']=(int)$bulan_map[$bulan]*96/12;
        $series7['form']=$form;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
        
        $series8['page']='KNN3';
        $series8['target']=(int)$bulan_map[$bulan]*96/12;
        $series8['form']=$form2;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_ibu_close WHERE submissionDate > '$startyear' AND submissionDate < '$enddate' GROUP BY id")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userId, $user_village)){
                if($dvisit->closeReason=="Penyebab langsung"){
                    $form[$user_village[$dvisit->userId]] += 1;
                }
            }
        }
        
        $series9['page']='KM';
        $series9['target']=0;
        $series9['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series9);
       
        $form = $user;
        $form2 = $user;
        $form3 = $user;
        
        $form = $user;
        $form2 = $user;
        $form3 = $user;
        $data = $this->db->query("SELECT * FROM kohort_anak_tutup WHERE tanggalKematianAnak > '$startyear' AND tanggalKematianAnak < '$enddate'")->result();
        $query = $this->db->query("SELECT childId,tanggalLahirAnak FROM kohort_bayi_registration")->result();
        $tanggalLahirAnak = [];
        foreach ($query as $q){
            if(!array_key_exists($q->childId, $tanggalLahirAnak)){
                $tanggalLahirAnak[$q->childId] = $q->tanggalLahirAnak;
            }
        }
        $query = $this->db->query("SELECT childId,tanggalLahirAnak FROM kartu_pnc_dokumentasi_persalinan")->result();
        $tanggalLahirAnak2 = [];
        foreach ($query as $q){
            if(!array_key_exists($q->childId, $tanggalLahirAnak2)){
                $tanggalLahirAnak2[$q->childId] = $q->tanggalLahirAnak;
            }
        }
        foreach ($data as $d){
            if(array_key_exists($d->userId, $user_village)){
                if(!array_key_exists($d->childId, $tanggalLahirAnak)){
                    if(!array_key_exists($d->childId, $tanggalLahirAnak2)){
                        continue;
                    }else {
                        if($tanggalLahirAnak2[$d->childId]==""||$tanggalLahirAnak2[$d->childId]=="None") continue;
                        $tgl_lahir = date_create($tanggalLahirAnak2[$d->childId]);
                    }
                }else{
                    if($tanggalLahirAnak[$d->childId]==""||$tanggalLahirAnak[$d->childId]=="None") continue;
                    $tgl_lahir = date_create($tanggalLahirAnak[$d->childId]);
                }
                $tgl_mati = date_create($d->tanggalKematianAnak);
                $diff = date_diff($tgl_lahir,$tgl_mati);
                if($diff->days>0&&$diff->days<29){
                    $form[$user_village[$d->userId]] += 1;
                }elseif($diff->days>=29&&$diff->days<331){
                    $form2[$user_village[$d->userId]] += 1;
                }elseif($diff->days>=331&&$diff->days<=1800){
                    $form3[$user_village[$d->userId]] += 1;
                }
            }
        }
        
        $series10['page']='KNN';
        $series10['target']=0;
        $series10['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series10);
        
        $series11['page']='KB';
        $series11['target']=0;
        $series11['form']=$form2;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series11);
        
        $series12['page']='KBLT';
        $series12['target']=0;
        $series12['form']=$form3;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series12);
        
        return $xlsForm;
    }
    
    public function cakupanHHHBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $user_village = $this->loc->getIntLocId('bidan');
        $user = $this->ec->getCakupanContainer('bidan');
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1) group by baseEntityId")->result(); // AND hiddenAncKe=1
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $form[$user_village[$dvisit->locationId]] += 1;
            }
        }
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_tambah_anc WHERE tanggalHPHT > '$gadate12' group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa] = 0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC1SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=1 group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $form[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa] = 0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC1NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($this->isAnc4($dvisit)){
                    $form[$user_village[$dvisit->locationId]] += 1;
                }
            }
        }
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_tambah_anc WHERE tanggalHPHT > '$gadate42' group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa] = 0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC4SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $form[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa] = 0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC4NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datapersalinan= [];//$this->db->query("SELECT * FROM event_bidan_dokumentasi_persalinan WHERE tanggalPlasentaLahir > '$startdate' AND tanggalPlasentaLahir < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->locationId, $user_village)){
                $form[$user_village[$dsalin->locationId]] += 1;
            }
        }
//        $datapersalinan= [];//$this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
//        foreach ($datapersalinan as $dsalin){
//            if(array_key_exists($dsalin->locationId, $user_village)){
//                $form[$user_village[$dsalin->locationId]] += 1;
//            }
//        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $form[$desa]*100/$target_bulin[$desa];
//        }
        
        
        $series['page']='BC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_pnc WHERE (pncDate > '$startdate' AND pncDate < '$enddate') AND hariKeKF='kf4' group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                $form[$user_village[$dvisit->locationId]] += 1;
            }
        }
//        foreach ($form as $desa=>$nilai){
//            $form[$desa] = $nilai*100/$target_bufas[$desa];
//        }
        $series['page']='PNCC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    private function isAnc4($bumil){
        $ancvisit = [];//$this->db->query("SELECT event_bidan_tambah_anc.tanggalHPHT,ancDate FROM event_bidan_kunjungan_anc LEFT JOIN event_bidan_tambah_anc on event_bidan_tambah_anc.baseEntityId=event_bidan_kunjungan_anc.baseEntityId WHERE event_bidan_kunjungan_anc.baseEntityId='$bumil->baseEntityId' ORDER BY ancDate")->result();
        $anc = [false,false,false,false,false];
        $i = 0;
        foreach ($ancvisit as $visit){
            if($visit->tanggalHPHT=="None") continue;
            $ga = intval(date_diff(date_create($visit->ancDate),date_create($visit->tanggalHPHT))->days/7);
            if($ga<=12){
                $anc[1] = true;
            }elseif($ga>12&&$ga<=27){
                $anc[2] = true;
            }elseif($ga>27){
                $anc[3+$i] = true;
                $i++;
            }
        }
        return $anc[1]&&$anc[2]&&$anc[3]&&$anc[4];
    }
    
    private function isPnc4($bumil){
        $ancvisit = [];//$this->db->query("SELECT event_bidan_dokumentasi_persalinan.tanggalPlasentaLahir,pncDate FROM event_bidan_kunjungan_pnc LEFT JOIN event_bidan_dokumentasi_persalinan ON event_bidan_dokumentasi_persalinan.baseEntityId=event_bidan_kunjungan_pnc.baseEntityId WHERE event_bidan_kunjungan_pnc.baseEntityId='$bumil->baseEntityId' ORDER BY pncDate")->result();
        $pnc = [false,false,false,false,false];
        foreach ($ancvisit as $visit){
            if($visit->tanggalPlasentaLahir=="None"||$visit->tanggalPlasentaLahir=="NULL") continue;
            $ga = intval(date_diff(date_create($visit->pncDate),date_create($visit->tanggalPlasentaLahir))->days/7);
            if($ga<=2){
                $pnc[1] = true;
            }elseif($ga>2&&$ga<=7){
                $pnc[2] = true;
            }elseif($ga>7&&$ga<=28){
                $pnc[3] = true;
            }elseif($ga>28&&$ga<=42){
                $pnc[4] = true;
            }
        }
        return $pnc[1]&&$pnc[2]&&$pnc[3]&&$pnc[4];
    }
    
    private function isHRP($bumil){
        $ancvisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE baseEntityId='$bumil->baseEntityId' ORDER BY ancDate")->result();
        foreach ($ancvisit as $visit){
            if($visit->highRiskPregnancyProteinEnergyMalnutrition=="yes"||$visit->highRiskPregnancyPIH=="yes"){
                return true;
            }
        }
        return false;
    }
    
    private function isHRPP($bumil){
        $ancvisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_pnc WHERE baseEntityId='$bumil->baseEntityId' ORDER BY pncDate")->result();
        foreach ($ancvisit as $visit){
            if($visit->highRiskPostPartumDistosia=="yes"||$visit->highRiskPostPartumPIH=="yes"||$visit->highRiskPostPartumHemorrhage=="yes"||$visit->highRiskPostPartumInfection=="yes"||$visit->highRiskPostPartumMaternalSepsis=="yes"||$visit->highRiskPostPartumMastitis=="yes"){
                return true;
            }
        }
        return false;
    }
    
    private function isHbGiven($bayi){
        $bayivisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_neonatal WHERE baseEntityId='$bayi->baseEntityId' ORDER BY eventDate")->result();
        foreach ($bayivisit as $visit){
            if($visit->hb0!="NULL"){ //$visit->saatLahirsd5JamPemberianImunisasihbJikaDilakukan=="ya"||$visit->kunjunganNeonatalpertama6sd48jamPemberianimunisasiHB0=="ya"||$visit->kunjunganNeonatalKeduaHarike3sd7BayiDiberikanImunisasi=="ya"||$visit->KunjunganNeonatalKetigaharike8sd28bayidiberikanimunisasi=="ya"
                return true;
            }
        }
        return false;
    }
    
    public function heartScoreBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $user_village = $this->loc->getIntLocId('bidan');
        $user = $this->ec->getCakupanContainer('bidan');
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($this->isAnc4($dvisit)){
                    $den[$user_village[$dvisit->locationId]] += 1;
                    if($this->isHRP($dvisit)){
                        $form[$user_village[$dvisit->locationId]] += 1;
                    }
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_pnc WHERE (pncDate > '$startdate' AND pncDate < '$enddate') group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($this->isPnc4($dvisit)){
                    $den[$user_village[$dvisit->locationId]] += 1;
                    if($this->isHRPP($dvisit)){
                        $form[$user_village[$dvisit->locationId]] += 1;
                    }
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='PNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_neonatal WHERE (eventDate > '$startdate' AND eventDate < '$enddate') group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($this->isHbGiven($dvisit)){
                    $form[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='Hb';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_pnc WHERE (pncDate > '$startdate' AND pncDate < '$enddate') group by baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($this->isPnc4($dvisit)){
                    $form[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='KPNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT event_bidan_rencana_persalinan.*,event_bidan_identitas_ibu.locationId as locationId FROM event_bidan_rencana_persalinan LEFT JOIN event_bidan_identitas_ibu ON event_bidan_rencana_persalinan.baseEntityId=event_bidan_identitas_ibu.baseEntityId WHERE (event_bidan_rencana_persalinan.eventDate > '$startdate' AND event_bidan_rencana_persalinan.eventDate < '$enddate') group by event_bidan_rencana_persalinan.baseEntityId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($dvisit->tanggalRencanaPersalinan!=""){
                    $form[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
            
        $series['page']='PRP';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    private function isHbChecked($bumil){
        $dataibu = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc_lab_test WHERE baseEntityId='$bumil->baseEntityId'");
        if($dataibu->num_rows()<1) return false;
        else{
            $dataibu=$dataibu->row();
            if($dataibu->laboratoriumPeriksaHbHasil!=""&&$dataibu->laboratoriumPeriksaHbHasil!="None") {
                return true;
            }
            else return false;
        }
    }
    
    private function isHamil($ibu){
        $datahamil = [];//$this->db->query("SELECT * FROM event_bidan_tambah_anc WHERE baseEntityId='$ibu->baseEntityId'")->result();
        foreach ($datahamil as $dhamil){
            $datapnc = [];//$this->db->query("SELECT * FROM event_bidan_dokumentasi_persalinan WHERE baseEntityId='$dhamil->baseEntityId'");
            if($datapnc->num_rows()<1){
                return true;
            }
        }
        return false;
    }
    
    public function trimester1BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $user_village = $this->loc->getIntLocId('bidan');
        $user = $this->ec->getCakupanContainer('bidan');
        
        $tdt = $bbt = $lilat = $hbt = $gdt = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=1")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->locationId]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->locationId]] += 1;
                }
                if($dvisit->hasilPemeriksaanLILA!=""&&$dvisit->hasilPemeriksaanLILA!="None"){
                    $lilat[$user_village[$dvisit->locationId]] += 1;
                }
                if($this->isHbChecked($dvisit)){
                    $hbt[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        $dataibu = [];//$this->db->query("SELECT * FROM event_bidan_identitas_ibu WHERE (eventDate > '$startdate' AND eventDate < '$enddate')")->result();
        $den_gd = $user;
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->locationId, $user_village)){
                if($this->isHamil($ibu)){
                    if($ibu->golonganDarah!="NA"){
                        $gdt[$user_village[$ibu->locationId]] += 1;
                    }
                }
                $den_gd[$user_village[$ibu->locationId]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            else{
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
            $lilat[$desa] = $lilat[$desa]*100/$den[$desa];
            $hbt[$desa] = $hbt[$desa]*100/$den[$desa];
            }
            if($den_gd[$desa]==0) continue;
            else $gdt[$desa] = $gdt[$desa]*100/$den_gd[$desa];
        }
        
        $series['page']='TDT1';
        $series['form']=$tdt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT1';
        $series['form']=$bbt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='LILAT1';
        $series['form']=$lilat;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='HBT1';
        $series['form']=$hbt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='GOLDART1';
        $series['form']=$gdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    public function trimester2BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $user_village = $this->loc->getIntLocId('bidan');
        $user = $this->ec->getCakupanContainer('bidan');
        
        $tdt = $bbt = $tfu = $pj = $djj = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=2")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->locationId]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->locationId]] += 1;
                }
                if($dvisit->tfu!=""&&$dvisit->tfu!="None"){
                    $tfu[$user_village[$dvisit->locationId]] += 1;
                }
                if($dvisit->persentasiJanin!=""&&$dvisit->persentasiJanin!="None"){
                    $pj[$user_village[$dvisit->locationId]] += 1;
                }
                if($dvisit->djj!=""&&$dvisit->djj!="None"){
                    $djj[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
            $tfu[$desa] = $tfu[$desa]*100/$den[$desa];
            $pj[$desa] = $pj[$desa]*100/$den[$desa];
            $djj[$desa] = $djj[$desa]*100/$den[$desa];
        }
        
        $series['page']='TDT2';
        $series['form']=$tdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT2';
        $series['form']=$bbt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='TFUT2';
        $series['form']=$tfu;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='PJT2';
        $series['form']=$pj;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='DJJT2';
        $series['form']=$djj;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    public function trimester3BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $user_village = $this->loc->getIntLocId('bidan');
        $user = $this->ec->getCakupanContainer('bidan');
        
        $tdt = $bbt = $user;
        $den = $user;
        $datavisit = [];//$this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=3")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->locationId, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->locationId]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->locationId]] += 1;
                }
                $den[$user_village[$dvisit->locationId]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
        }
        
        $series['page']='TDT3';
        $series['form']=$tdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT3';
        $series['form']=$bbt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
}