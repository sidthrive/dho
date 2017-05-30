<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataentryModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->library('Couchdb');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $startdate = (float)(strtotime($start)."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        $users = $this->loc->getLocUser('bidan',$kecamatan);
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value, $table_default)){
                    $result_data[$users[$user]][$table_default[$d->value]]++;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerDayDrill($kecamatan="",$mode="",$range=""){
        $end = date("Y-m-d",  strtotime($range[1]." +1 day"));
        
        $startdate = (float)(strtotime($range[0])."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        $users = $this->loc->getLocUser('bidan',$kecamatan);
        $result_data = array();
        foreach ($users as $user=>$desa){
            $begin = new DateTime($range[0]);
            $end = new DateTime($range[1]);
            $data = array();
            for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                $date    = $i->format("Y-m-d");
                $data[$date] = 0;
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value, $table_default)){
                    $result_data[$users[$user]][$d->key[1]]++;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $end = date("Y-m-d",  strtotime($date." +1 day"));
        $startdate = (float)(strtotime($date)."000");
        $enddate = (float)(strtotime(date($end))."000");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
        $users = $this->loc->getLocUserAndDesabyDesa('bidan',str_replace('_',' ',$desa));
        $result_data = array();
        foreach ($users as $user=>$desa){
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
        }
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value, $table_default)){
                    $result_data[$date]["data"][$tabindex[$d->value]][1]++;
                }
            }
        }
        
        return $result_data;
    }
}