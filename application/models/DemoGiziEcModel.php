<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DemoGiziEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }
    
    public function getCountPerDay($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
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
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        if($range!=""){
            foreach ($users as $user=>$desa){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDayByVisitDate($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
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
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        if($range!=""){
            foreach ($users as $user=>$desa){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
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
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($users as $user=>$desa){
            $data = array();
            
            if($mode=='Mingguan'){
                $data['thisweek'] = array();
                $data['lastweek'] = array();                       
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"-")."-".$days." days"));
                    $day_temp[$date] = rand(10,30);
                }
                $data['thisweek'] = $day_temp;
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = rand(10,30);
                }
                $data['lastweek'] = $day_temp;
                
            }elseif($mode=='Bulanan'){
                $data['thisyear'] = array();
                $data['lastyear'] = array();
                $this_month = date("n");
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i)." months"));
                    $month[$date]   =   rand(10,30);
                }
                $data['thisyear'] = $month;
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i-12)." months"));
                    $month[$date]   =   rand(10,30);
                }
                $data['lastyear'] = $month;
            }
            $result_data[$desa] = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
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
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($tables as $table=>$legend){
                $table_name = rand(10,30);
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        return $result_data;
    }
    
    public function getCountPerFormByVisitDate($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
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
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($tables as $table=>$legend){
                $table_name = rand(10,30);
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        $tabindex = $this->Table->getTableIndex('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getLocIdAndDesabyDesa(str_replace('_',' ',$desa));
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            $data[$date] = array();
            foreach ($table_default as $table=>$table_name){
                $data[$date]["name"] = $date;
                $data[$date]["id"] = $date;
                $data[$date]["data"] = array();
                foreach ($table_default as $td=>$td_name){
                    array_push($data[$date]["data"], array($td_name,rand(0,5)));
                }
            }
            $result_data = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerFormByVisitDateForDrill($desa="",$date=""){
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        $tabindex = $this->Table->getTableIndex('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getLocIdAndDesabyDesa(str_replace('_',' ',$desa));
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            $data[$date] = array();
            foreach ($table_default as $table=>$table_name){
                $data[$date]["name"] = $date;
                $data[$date]["id"] = $date;
                $data[$date]["data"] = array();
                foreach ($table_default as $td=>$td_name){
                    array_push($data[$date]["data"], array($td_name,rand(10,30)));
                }
            }
            $result_data = $data;
        }
        
        return $result_data;
    }
}