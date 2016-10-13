<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GiziModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerDay($kecamatan="",$mode=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        $table_default = [
            'registrasi_gizi'=>'Registrasi Gizi',
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'close_form'=>'Close Form'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                $tables[$table->Tables_in_opensrp_gizi]=$table_default[$table->Tables_in_opensrp_gizi];
            }
        }
        
       if($kecamatan=='Sengkol'){
            $users = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
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
        foreach ($tables as $table=>$legend){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi8' or userid='gizi9' or userid='gizi10' or userid='gizi11' or userid='gizi12' or userid='gizi13' or userid='gizi14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",strtotime("-30 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d")."') group by userid, DATE(clientversionsubmissiondate)");
            }
            elseif($kecamatan=='Janapria'){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi1' or userid='gizi2' or userid='gizi3' or userid='gizi4' or userid='gizi5' or userid='gizi6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",strtotime("-30 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d")."') group by userid, DATE(clientversionsubmissiondate)");
            }
            else{
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (DATE(clientversionsubmissiondate) >= '2015-06-24' and DATE(clientversionsubmissiondate) <= '2015-07-24') group by userid, DATE(clientversionsubmissiondate)");
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
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            array_push($tables, $table->Tables_in_opensrp_gizi);
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
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
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi8' or userid='gizi9' or userid='gizi10' or userid='gizi11' or userid='gizi12' or userid='gizi13' or userid='gizi14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by userid, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi8' or userid='gizi9' or userid='gizi10' or userid='gizi11' or userid='gizi12' or userid='gizi13' or userid='gizi14') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by userid, DATE(clientversionsubmissiondate)");
                }
            }
            elseif($kecamatan=='Janapria'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi1' or userid='gizi2' or userid='gizi3' or userid='gizi4' or userid='gizi5' or userid='gizi6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by userid, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi1' or userid='gizi2' or userid='gizi3' or userid='gizi4' or userid='gizi5' or userid='gizi6') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by userid, DATE(clientversionsubmissiondate)");
                }
            }
            else{
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (DATE(clientversionsubmissiondate) >= '2015-06-24' and DATE(clientversionsubmissiondate) <= '2015-07-24') group by userid, DATE(clientversionsubmissiondate)");
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
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        $table_default = [
            'registrasi_gizi'=>'Registrasi Gizi',
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'close_form'=>'Close Form'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                $tables[$table->Tables_in_opensrp_gizi]=$table_default[$table->Tables_in_opensrp_gizi];
            }
        }
        
        if($kecamatan=='Sengkol'){
            $users = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='Janapria'){
            $users = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
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
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Sengkol'){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi8' or userid='gizi9' or userid='gizi10' or userid='gizi11' or userid='gizi12' or userid='gizi13' or userid='gizi14') group by userid, DATE(clientversionsubmissiondate)");
            }
            elseif($kecamatan=='Janapria'){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='gizi1' or userid='gizi2' or userid='gizi3' or userid='gizi4' or userid='gizi5' or userid='gizi6') group by userid, DATE(clientversionsubmissiondate)");
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
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        $table_default = [
            'registrasi_gizi'=>'Registrasi Gizi',
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'close_form'=>'Close Form'];
        $tabindex = [
            'registrasi_gizi'=>0,
            'kunjungan_gizi'=>1,
            'close_form'=>2];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                $tables[$table->Tables_in_opensrp_gizi]=$table_default[$table->Tables_in_opensrp_gizi];
            }
        }
        
        if($desa=="Lekor"){
            $users = ['gizi1'=>'Lekor'];
        }elseif($desa=="Saba"){
            $users = ['gizi2'=>'Saba'];
        }elseif($desa=="Pendem"){
            $users = ['gizi3'=>'Pendem'];
        }elseif($desa=="Setuta"){
            $users = ['gizi4'=>'Setuta'];
        }elseif($desa=="Jango"){
            $users = ['gizi5'=>'Jango'];
        }elseif($desa=="Janapria"){
            $users = ['gizi6'=>'Janapria'];
        }elseif($desa=="Ketara"){
            $users = ['gizi8'=>'Ketara'];
        }elseif($desa=="Sengkol"){
            $users = ['gizi9'=>'Sengkol','gizi10'=>'Sengkol'];
        }elseif($desa=="Kawo"){
            $users = ['gizi11'=>'Kawo'];
        }elseif($desa=="Tanak_Awu"){
            $users = ['gizi12'=>'Tanak Awu'];
        }elseif($desa=="Pengembur"){
            $users = ['gizi13'=>'Pengembur'];
        }elseif($desa=="Segala_Anyar"){
            $users = ['gizi14'=>'Segala Anyar'];
        }
        
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
                    array_push($data[$date]["data"], array($td_name,0));
                }
            }
            $result_data = $data;
        }
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table=>$legend){
            $query2 = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query2->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            reset($users);
            $query3 = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,count(*) as counts from ".$table." where (userid='".key($users)."') and DATE(clientversionsubmissiondate)='".$date."' group by userid, DATE(clientversionsubmissiondate)");
            foreach ($query3->result() as $datas){
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$date];
                    if(array_key_exists($table, $table_default)){
                        $data_count["data"][$tabindex[$table]][1]         += $datas->counts;
                    }
                    
                    $result_data[$date] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
}