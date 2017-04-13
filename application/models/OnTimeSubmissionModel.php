<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OnTimeSubmissionModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }
    
    public function getOnTimeSubmission($mode="",$range=""){
        if($mode=="daily"){
            return $this->getDailyOnTime($range);
        }else{
            return $this->getWeeklyOnTime($range);
        }
    }
    
    public function getDailyOnTime($range=""){
        $location = $this->loc->getIntLocId('bidan');
        $result_data = array();
        $result_data['daily'] = array();
        foreach ($location as $user=>$desa){
            $result_data['daily'][$desa] = $this->getDailyOnTimeDesa([$user=>$desa], $range);
        }
        $detail = $this->getOnTimeForm("daily",$range);
        foreach ($detail as $x=>$d){
            $result_data[$x] = $d;
        }
        return $result_data;
    }
    
    public function getWeeklyOnTime($range=""){
        $location = $this->loc->getIntLocId('bidan');
        $result_data = array();
        $result_data['daily'] = array();
        foreach ($location as $user=>$desa){
            $result_data['daily'][$desa] = $this->getWeeklyOnTimeDesa([$user=>$desa], $range);
        }
        $detail = $this->getOnTimeForm("weekly",$range);
        foreach ($detail as $x=>$d){
            $result_data[$x] = $d;
        }
        return $result_data;
    }
    
    public function getDailyOnTimeDesa($location="",$range=""){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $locations = $this->loc->getLocIdQuery($location);
        
        $ontime = 0;
        $total = 0;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            if($range!=""){
                $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            }else{
                $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".date("Y-m-d",strtotime("-30 days"))."' AND dateCreated <= '".date("Y-m-d")."'");
            }
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $location)){
                    if($this->isOnTime($table,$datas)){
                        $ontime +=1;
                    }
                    $total +=1;
                }
                
            }
        }
        
        if($total==0) return 0;
        else return (float)number_format(100*$ontime/$total,2);
    }
    
    
    private function isOnTime($table,$data){
        $clientdate = explode(" ",$data->clientVersionSubmissionDate);
        if($table=='event_bidan_kohort_kunjungan_bayi_perbulan'||$table=='event_bidan_kunjungan_balita'||$table=='event_bidan_kunjungan_neonatal'){
            if($data->tanggalKunjunganBayiPerbulan==$clientdate[0]) return true;
        }elseif($table=='event_bidan_kohort_pelayanan_kb'){
            if($data->tanggalkunjungan==$clientdate[0]) return true;
        }elseif($table=='event_bidan_kunjungan_anc'){
            if($data->ancDate==$clientdate[0]) return true;
        }elseif($table=='event_bidan_kunjungan_pnc'){
            if($data->PNCDate==$clientdate[0]) return true;
        }elseif($table=='event_bidan_rencana_persalinan'){
            if($data->tanggalRencanaPersalinan==$clientdate[0]) return true;
        }elseif($table=='event_bidan_tambah_bayi'){
            if($data->tanggalPendaftaran==$clientdate[0]) return true;
        }elseif($table=='event_bidan_tambah_kb'){
            if($data->tanggalPeriksa==$clientdate[0]) return true;
        }elseif($table=='event_bidan_kunjungan_anc_integrasi'||$table=='event_bidan_kunjungan_anc_lab_test'||$table=='event_bidan_tambah_anc'){
            if($data->referenceDate==$clientdate[0]) return true;
        }else{
            if($data->dateCreated==$clientdate[0]) return true;
        }
        return false;
    }
    
    public function getWeeklyOnTimeDesa($location="",$range=""){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $locations = $this->loc->getLocIdQuery($location);
        
        $ontime = 0;
        $total = 0;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            if($range!=""){
                $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            }else{
                $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".date("Y-m-d",strtotime("-30 days"))."' AND dateCreated <= '".date("Y-m-d")."'");
            }
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $location)){
                    if($this->isWeeklyOnTime($table,$datas)){
                        $ontime +=1;
                    }
                    $total +=1;
                }
                
            }
        }
        
        if($total==0) return 0;
        else return (float)number_format(100*$ontime/$total,2);
    }
    
    private function isWeeklyOnTime($table,$data){
        $clientdate = explode(" ",$data->clientVersionSubmissionDate);
        $cdate = date_create($clientdate[0]);
        if($table=='event_bidan_kohort_kunjungan_bayi_perbulan'||$table=='event_bidan_kunjungan_balita'||$table=='event_bidan_kunjungan_neonatal'){
            $eventdate = explode(" ",$data->tanggalKunjunganBayiPerbulan);
        }elseif($table=='event_bidan_kohort_pelayanan_kb'){
            $eventdate = explode(" ",$data->tanggalkunjungan);
        }elseif($table=='event_bidan_kunjungan_anc'){
            $eventdate = explode(" ",$data->ancDate);
        }elseif($table=='event_bidan_kunjungan_pnc'){
            $eventdate = explode(" ",$data->PNCDate);
        }elseif($table=='event_bidan_rencana_persalinan'){
            $eventdate = explode(" ",$data->tanggalRencanaPersalinan);
        }elseif($table=='event_bidan_tambah_bayi'){
            $eventdate = explode(" ",$data->tanggalPendaftaran);
        }elseif($table=='event_bidan_tambah_kb'){
            $eventdate = explode(" ",$data->tanggalPeriksa);
        }elseif($table=='event_bidan_kunjungan_anc_integrasi'||$table=='event_bidan_kunjungan_anc_lab_test'||$table=='event_bidan_tambah_anc'){
            $eventdate = explode(" ",$data->referenceDate);
        }else{
            $eventdate = explode(" ",$data->dateCreated);
        }
        if($eventdate[0]=="NULL") return false;
        $evdate = date_create($eventdate[0]);
        $diff = date_diff($cdate,$evdate);
        if($diff->days<7) return true;
        return false;
    }
    
    //buat desa
    public function getOnTimeForm($mode="",$range=""){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $locId = $this->loc->getIntLocId("bidan");$location = $this->loc->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($locId as $user=>$desa){
            $data = array();
            foreach ($table_default as $t=>$tn){
                $data[$tn] = 0;
            }
            $result_data[$desa] = $data;
        }
        
        $deno = $result_data;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            if($range!=""){
                $query = $analyticsDB->query("SELECT * from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            }else{
                $query = $analyticsDB->query("SELECT * from ".$table." where ($location) AND dateCreated >= '".date("Y-m-d",strtotime("-30 days"))."' AND dateCreated <= '".date("Y-m-d")."'");
            }
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $locId)){
                    $data_count                  = $result_data[$locId[$datas->locationId]];
                    $data_count2                 = $deno[$locId[$datas->locationId]];
                    if($mode=='daily'){
                        if($this->isOnTime($table,$datas)){
                            $data_count[$table_default[$table]] +=1;
                        }
                    }else{
                        if($this->isWeeklyOnTime($table,$datas)){
                            $data_count[$table_default[$table]] +=1;
                        }
                    }
                    
                    $data_count2[$table_default[$table]] +=1;
                    $result_data[$locId[$datas->locationId]] = $data_count;
                    $deno[$locId[$datas->locationId]] = $data_count2;
                }
                
            }
        }
        
        foreach ($result_data as $desa=>$res){
            foreach ($res as $date=>$value){
                if($deno[$desa][$date]==0)continue;
                $result_data[$desa][$date] = (float)number_format(100*$result_data[$desa][$date]/$deno[$desa][$date],2);
            }
        }
        
        return $result_data;
    }
    
}