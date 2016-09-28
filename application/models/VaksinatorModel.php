<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerDay($kecamatan="",$mode=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_opensrp_jurim);
        }
        
       if($kecamatan=='Sengkol'){
            $users = ['vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria'];
        }else{
            return;
        }
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            for($i=1;$i<=30;$i++){
                $day     = 30-$i;
                $date    = date("Y-m-d",  strtotime("-".$day." days"));
                $data[$date] = 0;
            }
            $result_data[$desa] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator8' or userid='vaksinator9' or userid='vaksinator10' or userid='vaksinator11' or userid='vaksinator12' or userid='vaksinator13' or userid='vaksinator14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",strtotime("-30 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d")."') group by userid, DATE(clientversionsubmissiondate)");
            }
            elseif($kecamatan=='Janapria'){
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator1' or userid='vaksinator2' or userid='vaksinator3' or userid='vaksinator4' or userid='vaksinator5' or userid='vaksinator6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",strtotime("-30 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d")."') group by userid, DATE(clientversionsubmissiondate)");
            }
            else{
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (DATE(clientversionsubmissiondate) >= '2015-06-24' and DATE(clientversionsubmissiondate) <= '2015-07-24') group by userid, DATE(clientversionsubmissiondate)");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    if(array_key_exists($datas->submissiondate, $data_count)){
                        $data_count[$datas->submissiondate] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_opensrp_jurim);
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria'];
        }else{
            return;
        }
        
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
                $data['thisyear'] = array();
                $data['lastyear'] = array();
                $this_month = date("n");
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i)." months"));
                    $month[$date]   =   0;
                }
                $data['thisyear'] = $month;
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i-12)." months"));
                    $month[$date]   =   0;
                }
                $data['lastyear'] = $month;
            }
            $result_data[$desa] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                if($mode=='Mingguan'){
                    $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator8' or userid='vaksinator9' or userid='vaksinator10' or userid='vaksinator11' or userid='vaksinator12' or userid='vaksinator13' or userid='vaksinator14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by userid, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator8' or userid='vaksinator9' or userid='vaksinator10' or userid='vaksinator11' or userid='vaksinator12' or userid='vaksinator13' or userid='vaksinator14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by userid, DATE(clientversionsubmissiondate)");
                }
            }
            elseif($kecamatan=='Janapria'){
                if($mode=='Mingguan'){
                    $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator1' or userid='vaksinator2' or userid='vaksinator3' or userid='vaksinator4' or userid='vaksinator5' or userid='vaksinator6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by userid, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator1' or userid='vaksinator2' or userid='vaksinator3' or userid='vaksinator4' or userid='vaksinator5' or userid='vaksinator6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by userid, DATE(clientversionsubmissiondate)");
                }
            }
            else{
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (DATE(clientversionsubmissiondate) >= '2015-06-24' and DATE(clientversionsubmissiondate) <= '2015-07-24') group by userid, DATE(clientversionsubmissiondate)");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $users)){
                    if($mode=='Mingguan'){
                        $week   =   $result_data[$users[$datas->userid]];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        if(array_key_exists($datas->submissiondate, $thisweek)){
                            $thisweek[$datas->submissiondate] +=$datas->counts;
                        }
                        if(array_key_exists($datas->submissiondate, $lastweek)){
                            $lastweek[$datas->submissiondate] +=$datas->counts;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data[$users[$datas->userid]] = $week;
                    }elseif($mode=='Bulanan'){
                        $month = $result_data[$users[$datas->userid]];
                        $thisyear = $month['thisyear'];
                        $lastyear = $month['lastyear'];
                        $m = explode('-', $datas->submissiondate);
                        array_pop($m);
                        $datas->submissiondate = implode('-',$m);
                        if(array_key_exists($datas->submissiondate, $thisyear)){
                            $thisyear[$datas->submissiondate] +=$datas->counts;
                        }
                        if(array_key_exists($datas->submissiondate, $lastyear)){
                            $lastyear[$datas->submissiondate] +=$datas->counts;
                        }
                        $month['thisyear'] = $thisyear;
                        $month['lastyear'] = $lastyear;
                        $result_data[$users[$datas->userid]] = $month;
                    }
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerForm($kecamatan=""){
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        $table_default = [
            'jurim_visit'=>'Kunjungan Vaksinator',
            'registrasi_jurim'=>'Registrasi Vaksinator'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_jurim, $table_default)){
                $tables[$table->Tables_in_opensrp_jurim]=$table_default[$table->Tables_in_opensrp_jurim];
            }
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria'];
        }else{
            return;
        }
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($tables as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table=>$legend){
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator8' or userid='vaksinator9' or userid='vaksinator10' or userid='vaksinator11' or userid='vaksinator12' or userid='vaksinator13' or userid='vaksinator14') group by userid, DATE(clientversionsubmissiondate)");
            }
            elseif($kecamatan=='Janapria'){
                $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='vaksinator1' or userid='vaksinator2' or userid='vaksinator3' or userid='vaksinator4' or userid='vaksinator5' or userid='vaksinator6') group by userid, DATE(clientversionsubmissiondate)");
            }
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $data_count[$legend]         += $datas->counts;
                    $result_data[$users[$datas->userid]] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
}