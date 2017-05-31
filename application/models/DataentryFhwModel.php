<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataentryFhwModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->library('couchdb');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getCountPerForm($desa="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $startdate = (float)(strtotime($start)."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$desa=>$namadusun];
        }else{
            $username = $this->loc->getLocUserbyDesa('bidan',$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$nama] = $data;
        }
        
        $reg = $this->couchdb->startkey(["kartu_ibu_registration",$username])->endkey(["kartu_ibu_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $ibu = [];
        foreach ($reg as $r){
            $ibu[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kartu_anc_registration",$username])->endkey(["kartu_anc_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anc = [];
        foreach ($reg as $r){
            $anc[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kohort_bayi_registration",$username])->endkey(["kohort_bayi_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anak = [];
        foreach ($reg as $r){
            $anak[$r->value->childId] = $r->value->id;
        }
        
        $reg = $this->couchdb->startkey(["kartu_pnc_dokumentasi_persalinan",$username])->endkey(["kartu_pnc_dokumentasi_persalinan",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $persalinan = [];
        foreach ($reg as $r){
            $persalinan[$r->value->childId] = $r->value->id;
        }
        
        $data = $this->couchdb->startkey([$username,$startdate])->endkey([$username,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
        foreach ($data->rows as $d){
            $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
            if(array_key_exists($d->value->formName, $table_default)){
                if($d->value->formName=="kartu_ibu_registration"||$d->value->formName=="kohort_kb_registration"||$d->value->formName=="kartu_anc_registration_oa"||$d->value->formName=="kartu_pnc_regitration_oa"||$d->value->formName=="kohort_bayi_registration_oa"||$d->value->formName=="kartu_ibu_edit"){
                    if(array_key_exists($d->value->dusun, $namadusun)){
                        $result_data[$namadusun[$d->value->dusun]][$table_default[$d->value->formName]]++;
                    }
                }elseif($d->value->formName=="kartu_anc_registration"||$d->value->formName=="kartu_anc_visit"||$d->value->formName=="kohort_bayi_registration"||$d->value->formName=="kartu_anc_close"||$d->value->formName=="kartu_anc_edit"||$d->value->formName=="kartu_anc_visit_edit"||$d->value->formName=="kartu_anc_visit_integrasi"||$d->value->formName=="kartu_anc_visit_labTest"||$d->value->formName=="kartu_ibu_close"||$d->value->formName=="kartu_pnc_close"||$d->value->formName=="kohort_kb_close"||$d->value->formName=="kohort_kb_edit"||$d->value->formName=="kohort_kb_pelayanan"){
                    if(array_key_exists($d->value->id, $ibu)){
                        $result_data[$namadusun[$ibu[$d->value->id]]][$table_default[$d->value->formName]]++;
                    }elseif(isset($d->value->kiId)){
                        if(array_key_exists($d->value->kiId, $ibu)){
                            $result_data[$namadusun[$ibu[$d->value->kiId]]][$table_default[$d->value->formName]]++;
                        }
                    }
                }elseif($d->value->formName=="kartu_anc_rencana_persalinan"||$d->value->formName=="kartu_pnc_dokumentasi_persalinan"||$d->value->formName=="kartu_pnc_edit"||$d->value->formName=="kohort_bayi_edit"||$d->value->formName=="kartu_pnc_visit"){
                    if(array_key_exists($d->value->id, $anc)){
                        $result_data[$namadusun[$anc[$d->value->id]]][$table_default[$d->value->formName]]++;
                    }
                }elseif($d->value->formName=="kohort_bayi_kunjungan"||$d->value->formName=="kohort_bayi_neonatal_period"||$d->value->formName=="kohort_anak_tutup"||$d->value->formName=="kohort_bayi_immunization"){
                    if(array_key_exists($d->value->id, $anak)){
                        if(array_key_exists($anak[$d->value->id], $ibu)){
                            $result_data[$namadusun[$ibu[$anak[$d->value->id]]]][$table_default[$d->value->formName]]++;
                        }
                    }elseif(array_key_exists($d->value->id, $persalinan)){
                        if(array_key_exists($persalinan[$d->value->id], $anc)){
                            $result_data[$namadusun[$anc[$persalinan[$d->value->id]]]][$table_default[$d->value->formName]]++;
                        }
                    }
                }
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDayDrill($desa="",$mode="",$range=""){
        $end = date("Y-m-d",  strtotime($range[1]." +1 day"));
        
        $startdate = (float)(strtotime($range[0])."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        if($desa==""){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$desa=>$namadusun];
        }else{
            $username = $this->loc->getLocUserbyDesa('bidan',$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $begin = new DateTime($range[0]);
            $end = new DateTime($range[1]);
            $data = array();
            for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                $date    = $i->format("Y-m-d");
                $data[$date] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        $reg = $this->couchdb->startkey(["kartu_ibu_registration",$username])->endkey(["kartu_ibu_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $ibu = [];
        foreach ($reg as $r){
            $ibu[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kartu_anc_registration",$username])->endkey(["kartu_anc_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anc = [];
        foreach ($reg as $r){
            $anc[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kohort_bayi_registration",$username])->endkey(["kohort_bayi_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anak = [];
        foreach ($reg as $r){
            $anak[$r->value->childId] = $r->value->id;
        }
        
        $reg = $this->couchdb->startkey(["kartu_pnc_dokumentasi_persalinan",$username])->endkey(["kartu_pnc_dokumentasi_persalinan",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $persalinan = [];
        foreach ($reg as $r){
            $persalinan[$r->value->childId] = $r->value->id;
        }
        
        
        $data = $this->couchdb->startkey([$username,$startdate])->endkey([$username,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
        foreach ($data->rows as $d){
            $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
            if(array_key_exists($d->value->formName, $table_default)){
                if($d->value->formName=="kartu_ibu_registration"||$d->value->formName=="kohort_kb_registration"||$d->value->formName=="kartu_anc_registration_oa"||$d->value->formName=="kartu_pnc_regitration_oa"||$d->value->formName=="kohort_bayi_registration_oa"||$d->value->formName=="kartu_ibu_edit"){
                    if(array_key_exists($d->value->dusun, $namadusun)){
                        $result_data[$namadusun[$d->value->dusun]][$d->key[1]]++;
                    }
                }elseif($d->value->formName=="kartu_anc_registration"||$d->value->formName=="kartu_anc_visit"||$d->value->formName=="kohort_bayi_registration"||$d->value->formName=="kartu_anc_close"||$d->value->formName=="kartu_anc_edit"||$d->value->formName=="kartu_anc_visit_edit"||$d->value->formName=="kartu_anc_visit_integrasi"||$d->value->formName=="kartu_anc_visit_labTest"||$d->value->formName=="kartu_ibu_close"||$d->value->formName=="kartu_pnc_close"||$d->value->formName=="kohort_kb_close"||$d->value->formName=="kohort_kb_edit"||$d->value->formName=="kohort_kb_pelayanan"){
                    if(array_key_exists($d->value->id, $ibu)){
                        $result_data[$namadusun[$ibu[$d->value->id]]][$d->key[1]]++;
                    }elseif(isset($d->value->kiId)){
                        if(array_key_exists($d->value->kiId, $ibu)){
                            $result_data[$namadusun[$ibu[$d->value->kiId]]][$d->key[1]]++;
                        }
                    }
                }elseif($d->value->formName=="kartu_anc_rencana_persalinan"||$d->value->formName=="kartu_pnc_dokumentasi_persalinan"||$d->value->formName=="kartu_pnc_edit"||$d->value->formName=="kohort_bayi_edit"||$d->value->formName=="kartu_pnc_visit"){
                    if(array_key_exists($d->value->id, $anc)){
                        $result_data[$namadusun[$anc[$d->value->id]]][$d->key[1]]++;
                    }
                }elseif($d->value->formName=="kohort_bayi_kunjungan"||$d->value->formName=="kohort_bayi_neonatal_period"||$d->value->formName=="kohort_anak_tutup"||$d->value->formName=="kohort_bayi_immunization"){
                    if(array_key_exists($d->value->id, $anak)){
                        if(array_key_exists($anak[$d->value->id], $ibu)){
                            $result_data[$namadusun[$ibu[$anak[$d->value->id]]]][$d->key[1]]++;
                        }
                    }elseif(array_key_exists($d->value->id, $persalinan)){
                        if(array_key_exists($persalinan[$d->value->id], $anc)){
                            $result_data[$namadusun[$anc[$persalinan[$d->value->id]]]][$d->key[1]]++;
                        }
                    }
                }
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
        $end = date("Y-m-d",  strtotime($date." +1 day"));
        $startdate = (float)(strtotime($date)."000");
        $enddate = (float)(strtotime(date($end))."000");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
        if($this->session->userdata('level')=="fhw"){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $listdusun = $this->loc->getDusunTypo($desa);
        }else{
            $username = $this->loc->getDesaFromDusun($dusun);
            $listdusun = $this->loc->getDusunTypo($username);
            $username = $this->loc->getUserFromDusun('bidan',$dusun);
        }
        $namadusun = array();
        foreach ($listdusun as $x=>$n){
            if($n==$dusun){
                $namadusun[$x]=$dusun;
            }
        }
        
        $result_data = array();
        $data = array();
        $data[$date] = array();
        foreach ($table_default as $table=>$table_name){
            $data[$date]["name"] = $date;
            $data[$date]["id"] = $date;
            $data[$date]["data"] = array();
            foreach ($table_default as $td=>$td_name){
                array_push($data[$date]["data"], array($td_name,0));
            }
        }
        $result_data = $data;
        
        $reg = $this->couchdb->startkey(["kartu_ibu_registration",$username])->endkey(["kartu_ibu_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $ibu = [];
        foreach ($reg as $r){
            $ibu[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kartu_anc_registration",$username])->endkey(["kartu_anc_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anc = [];
        foreach ($reg as $r){
            $anc[$r->value->id] = $r->value->dusun;
        }
        
        $reg = $this->couchdb->startkey(["kohort_bayi_registration",$username])->endkey(["kohort_bayi_registration",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $anak = [];
        foreach ($reg as $r){
            $anak[$r->value->childId] = $r->value->id;
        }
        
        $reg = $this->couchdb->startkey(["kartu_pnc_dokumentasi_persalinan",$username])->endkey(["kartu_pnc_dokumentasi_persalinan",$username])->getView('FormSubmission','formSubmission_by_form_name_and_user')->rows;
        $persalinan = [];
        foreach ($reg as $r){
            $persalinan[$r->value->childId] = $r->value->id;
        }
        
        $data = $this->couchdb->startkey([$username,$startdate])->endkey([$username,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
        foreach ($data->rows as $d){
            $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
            if(array_key_exists($d->value->formName, $table_default)){
                if($d->value->formName=="kartu_ibu_registration"||$d->value->formName=="kohort_kb_registration"||$d->value->formName=="kartu_anc_registration_oa"||$d->value->formName=="kartu_pnc_regitration_oa"||$d->value->formName=="kohort_bayi_registration_oa"||$d->value->formName=="kartu_ibu_edit"){
                    if(array_key_exists($d->value->dusun, $namadusun)){
                        $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                    }
                }elseif($d->value->formName=="kartu_anc_registration"||$d->value->formName=="kartu_anc_visit"||$d->value->formName=="kohort_bayi_registration"||$d->value->formName=="kartu_anc_close"||$d->value->formName=="kartu_anc_edit"||$d->value->formName=="kartu_anc_visit_edit"||$d->value->formName=="kartu_anc_visit_integrasi"||$d->value->formName=="kartu_anc_visit_labTest"||$d->value->formName=="kartu_ibu_close"||$d->value->formName=="kartu_pnc_close"||$d->value->formName=="kohort_kb_close"||$d->value->formName=="kohort_kb_edit"||$d->value->formName=="kohort_kb_pelayanan"){
                    if(array_key_exists($d->value->id, $ibu)){
                        if(array_key_exists($ibu[$d->value->id], $namadusun)){
                            $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                        }
                    }elseif(isset($d->value->kiId)){
                        if(array_key_exists($d->value->kiId, $ibu)){
                            if(array_key_exists($ibu[$d->value->kiId], $namadusun)){
                                $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                            }
                        }
                    }
                }elseif($d->value->formName=="kartu_anc_rencana_persalinan"||$d->value->formName=="kartu_pnc_dokumentasi_persalinan"||$d->value->formName=="kartu_pnc_edit"||$d->value->formName=="kohort_bayi_edit"||$d->value->formName=="kartu_pnc_visit"){
                    if(array_key_exists($d->value->id, $anc)){
                        if(array_key_exists($anc[$d->value->id], $namadusun)){
                            $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                        }
                    }
                }elseif($d->value->formName=="kohort_bayi_kunjungan"||$d->value->formName=="kohort_bayi_neonatal_period"||$d->value->formName=="kohort_anak_tutup"||$d->value->formName=="kohort_bayi_immunization"){
                    if(array_key_exists($d->value->id, $anak)){
                        if(array_key_exists($anak[$d->value->id], $ibu)){
                            if(array_key_exists($ibu[$anak[$d->value->id]], $namadusun)){
                                $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                            }
                        }
                    }elseif(array_key_exists($d->value->id, $persalinan)){
                        if(array_key_exists($persalinan[$d->value->id], $anc)){
                            if(array_key_exists($anc[$d->value->id], $namadusun)){
                                $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                            }
                        }
                    }
                }
            }
        }
        
        
        return $result_data;
    }
}