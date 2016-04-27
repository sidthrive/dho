<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerDay($kecamatan="",$mode=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_analytics);
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['user8','user9','user10','user11','user12','user13','user14'];
        }elseif($kecamatan=='Janapria'){
            $users = ['user1','user2','user3','user4','user5','user6'];
        }else{
            $users = ['user1','user2','user3','user4','user5','user6','user8','user9','user10','user11','user12','user13','user14'];
        }
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user){
            $data = array();
            for($i=1;$i<=30;$i++){
                $day     = 30-$i;
                $date    = date("Y-m-d",  strtotime("-".$day." days"));
                $data[$date] = 0;
            }
            $result_data[$user] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user8' or userid='user9' or userid='user10' or userid='user11' or userid='user12' or userid='user13' or userid='user14') and (submissiondate >= '".date("Y-m-d",strtotime("-30 days"))."' and submissiondate <= '".date("Y-m-d")."') group by userid, submissiondate");
            }
            elseif($kecamatan=='Janapria'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user1' or userid='user2' or userid='user3' or userid='user4' or userid='user5' or userid='user6') and (submissiondate >= '".date("Y-m-d",strtotime("-30 days"))."' and submissiondate <= '".date("Y-m-d")."') group by userid, submissiondate");
            }
            else{
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (submissiondate >= '2015-06-24' and submissiondate <= '2015-07-24') group by userid, submissiondate");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $result_data)){
                    $data_count                  = $result_data[$datas->userid];
                    if(array_key_exists($datas->submissiondate, $data_count)){
                        $data_count[$datas->submissiondate] +=1;
                    }
                    $result_data[$datas->userid] = $data_count;
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="week"){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_analytics);
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['user8','user9','user10','user11','user12','user13','user14'];
        }elseif($kecamatan=='Janapria'){
            $users = ['user1','user2','user3','user4','user5','user6'];
        }else{
            $users = ['user1','user2','user3','user4','user5','user6','user8','user9','user10','user11','user12','user13','user14'];
        }
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($users as $user){
            $data = array();
            
            if($mode=='Mingguan'){
                $data['thisweek'] = array();
                $data['lastweek'] = array();                       
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['thisweek'] = $day_temp;
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['lastweek'] = $day_temp;
                
            }elseif($mode=='Bulanan'){
                
            }
            $result_data[$user] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user8' or userid='user9' or userid='user10' or userid='user11' or userid='user12' or userid='user13' or userid='user14') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by userid, submissiondate");
            }
            elseif($kecamatan=='Janapria'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user1' or userid='user2' or userid='user3' or userid='user4' or userid='user5' or userid='user6') and (submissiondate >= '".date("Y-m-d",strtotime("-30 days"))."' and submissiondate <= '".date("Y-m-d")."') group by userid, submissiondate");
            }
            else{
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (submissiondate >= '2015-06-24' and submissiondate <= '2015-07-24') group by userid, submissiondate");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $result_data)){
                    if($mode=='Mingguan'){
                        $week   =   $result_data[$datas->userid];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        if(array_key_exists($datas->submissiondate, $thisweek)){
                            $thisweek[$datas->submissiondate] +=1;
                        }
                        if(array_key_exists($datas->submissiondate, $lastweek)){
                            $lastweek[$datas->submissiondate] +=1;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data[$datas->userid] = $week;
                    }elseif($mode=='Bulanan'){
                        
                    }
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerForm($kecamatan=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_analytics);
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['user8','user9','user10','user11','user12','user13','user14'];
        }elseif($kecamatan=='Janapria'){
            $users = ['user1','user2','user3','user4','user5','user6'];
        }else{
            $users = ['user1','user2','user3','user4','user5','user6','user8','user9','user10','user11','user12','user13','user14'];
        }
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user){
            $data = array();
            foreach ($tables as $table){
                $table_name = 0;
                $data[$table] = $table_name;
            }
            $result_data[$user] = $data;
        }
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user8' or userid='user9' or userid='user10' or userid='user11' or userid='user12' or userid='user13' or userid='user14') group by userid, submissiondate");
            }
            elseif($kecamatan=='Janapria'){
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='user1' or userid='user2' or userid='user3' or userid='user4' or userid='user5' or userid='user6') group by userid, submissiondate");
            }
            else{
                $query = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." group by userid, submissiondate");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $result_data)){
                    $data_count                  = $result_data[$datas->userid];
                    $data_count[$table]         += $datas->counts;
                    $result_data[$datas->userid] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
}