<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanCakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=1 group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bumil[$desa];
        }
        
        $series1['page']='K1A';
        $series1['form']=$form;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bumil[$desa];
        }
        
        $series2['page']='K4';
        $series2['form']=$form;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series3['page']='MT';
        $series3['form']=$form;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $likes = $user;
        $nakes = $user;
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_village)){
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $likes[$user_village[$dsalin->userID]] += 1;
                }
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    $nakes[$user_village[$dsalin->userID]] += 1;
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_village)){
                if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                    $likes[$user_village[$dsalin->userID]] += 1;
                }
                if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                    $nakes[$user_village[$dsalin->userID]] += 1;
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            $likes[$desa] = $likes[$desa]*100/$target_bulin[$desa];
            $nakes[$desa] = $nakes[$desa]*100/$target_bulin[$desa];
        }
        
        
        $series4['page']='PDFK';
        $series4['form']=$likes;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
        
        $series5['page']='PDTK';
        $series5['form']=$nakes;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bufas[$desa];
        }
        
        $series6['page']='KN';
        $series6['form']=$form;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $form = $user;
        $form2 = $user;
        $datavisit = $this->db->query("SELECT * FROM kohort_bayi_neonatal_period WHERE submissionDate > '$startdate' AND submissionDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->kunjunganNeonatal=="Pertama"){
                    $form[$user_village[$dvisit->userID]] += 1;
                }elseif($dvisit->kunjunganNeonatal=="Ketiga"){
                    $form2[$user_village[$dvisit->userID]] += 1;
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $form[$desa]*100/$target_bufas[$desa];
            $form2[$desa] = $form2[$desa]*100/$target_bufas[$desa];
        }
        
        $series7['page']='KNN1';
        $series7['form']=$form;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
        
        $series8['page']='KNN3';
        $series8['form']=$form2;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_close WHERE submissionDate > '$startdate' AND submissionDate < '$enddate'")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->closeReason=="maternal_death"){
                    $form[$user_village[$dvisit->userID]] += 1;
                }
            }
        }
        
        $series9['page']='KM';
        $series9['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series9);
       
        $form = $user;
        $form2 = $user;
        $form3 = $user;
        $data = $this->db->query("SELECT * FROM kohort_anak_tutup WHERE tanggalKematianAnak > '$startdate' AND tanggalKematianAnak < '$enddate'")->result();
        foreach ($data as $d){
            if(array_key_exists($d->userID, $user_village)){
                $query = $this->db->query("SELECT tanggalLahirAnak FROM kohort_bayi_registration WHERE childId='$d->childId'");
                if($query->num_rows<1){
                    continue;
                }
                $tgl_mati = date_create($d->tanggalKematianAnak);
                $tgl_lahir = date_create($query->row()->tanggalLahirAnak);
                $diff = date_diff($tgl_lahir,$tgl_mati);
                if($tgl_mati->days>0&&$tgl_mati->days<29){
                    $form[$user_village[$dvisit->userID]] += 1;
                }elseif($tgl_mati->days>=29&&$tgl_mati->days<331){
                    $form2[$user_village[$dvisit->userID]] += 1;
                }elseif($tgl_mati->days>=331&&$tgl_mati->days<=1800){
                    $form3[$user_village[$dvisit->userID]] += 1;
                }
            }
        }
        
        $series10['page']='KNN';
        $series10['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series10);
        
        $series11['page']='KB';
        $series11['form']=$form2;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series11);
        
        $series12['page']='KBLT';
        $series12['form']=$form3;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series12);
        
        return $xlsForm;
    }
}