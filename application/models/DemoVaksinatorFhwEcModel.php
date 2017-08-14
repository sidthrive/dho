<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class DemoVaksinatorFhwEcModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $vaksinatorDB = $this->load->database('analytics', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('vaksinator');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        if($desa==""){
            $username = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($username);
            $users = [$username=>$namadusun];
        }else{
            $username = $desa;
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        
        //make result array from the tables name
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            foreach ($tables as $table=>$legend){
                $data[$legend] = rand(10,30);
            }
            $result_data[$nama] = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
        $vaksinatorDB = $this->load->database('analytics', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('vaksinator');
        $tabindex = $this->Table->getTableIndex('vaksinator');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($this->session->userdata('level')=="fhw"){
            $username = $this->session->userdata('location');
        }else{
            $username = $this->loc->getDesaFromDusun($dusun);
        }

        $listdusun = $this->loc->getDusunTypo($username);
        $namadusun = array();
        foreach ($listdusun as $x=>$n){
            if($n==$dusun){
                $namadusun[$x]=$dusun;
            }
        }
        
        
        //make result array from the tables name
        $result_data = array();
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
        
        
        return $result_data;
    }
    
    public function getCountPerDay($desa="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($desa,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $vaksinatorDB = $this->load->database('analytics', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('vaksinator');
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($username);
            $users = [$username=>$namadusun];
        }else{
            $username = $desa;
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        //make result array from the tables name
        $result_data = array();
        if($range!=""){
            foreach ($namadusun as $dusun=>$nama){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = rand(10,30);
                }
                $result_data[$nama] = $data;
            }
        }else{
            foreach ($namadusun as $dusun=>$nama){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = rand(10,30);
                }
                $result_data[$nama] = $data;
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($desa="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $vaksinatorDB = $this->load->database('analytics', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('vaksinator');
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($username);
            $users = [$username=>$namadusun];
        }else{
            $username = $desa;
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            
            if($mode=='Mingguan'){
                $data['thisweek'] = array();
                $data['lastweek'] = array();                       
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")."-".$days." days"));
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
            $result_data[$nama] = $data;
        }
        return $result_data;
    }
}