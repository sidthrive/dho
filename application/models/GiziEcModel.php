<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GiziEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerDay($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_gizi_registrasi_gizi'=>'Registrasi Gizi',
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi',
            'event_gizi_penutupan_anak'=>'Penutupan Anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getDesa('gizi',$kecamatan);
        
        //make result array from the tables name
        if($range!=""){
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
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }
        
        
        foreach ($tables as $table=>$legend){
            
            //query tha data
            if($range!=""){
                if($kecamatan=='Darek'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }
            }else{
                if($kecamatan=='Darek'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $tgl = explode('T', $datas->eventDate);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
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
        $table_default = [
            'event_gizi_registrasi_gizi'=>'Registrasi Gizi',
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi',
            'event_gizi_penutupan_anak'=>'Penutupan Anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getDesa('gizi',$kecamatan);
        
        //make result array from the tables name
        if($range!=""){
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
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }
        
        
        foreach ($tables as $table=>$legend){
            //query tha data
            if($range!=""){
                if($kecamatan=='Darek'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }
            }else{
                if($kecamatan=='Darek'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $tgl = explode('T', $datas->eventDate);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else array_push($tables, $table->Tables_in_ec_analytics);
        }
        
        $users = $this->loc->getDesa('gizi',$kecamatan);
        
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
        
        
        foreach ($tables as $table){
            
            //query tha data
            if($kecamatan=='Darek'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Pengadang'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Kopang'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Mantang'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Mujur'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Puyung'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Ubung'){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    if($mode=='Mingguan'){
                        $week   =   $result_data[$users[$datas->userid]];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        $tgl = explode('T', $datas->eventDate);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $thisweek)){
                            $thisweek[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastweek)){
                            $lastweek[$tgl] +=$datas->counts;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data[$users[$datas->userid]] = $week;
                    }elseif($mode=='Bulanan'){
                        $month = $result_data[$users[$datas->userid]];
                        $thisyear = $month['thisyear'];
                        $lastyear = $month['lastyear'];
                        $tgl = explode('T', $datas->eventDate);
                        $tgl = $tgl[0];
                        $m = explode('-', $tgl);
                        array_pop($m);
                        $tgl = implode('-',$m);
                        if(array_key_exists($tgl, $thisyear)){
                            $thisyear[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastyear)){
                            $lastyear[$tgl] +=$datas->counts;
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
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_gizi_registrasi_gizi'=>'Registrasi Gizi',
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi',
            'event_gizi_penutupan_anak'=>'Penutupan Anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getDesa('gizi',$kecamatan);
        
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
        
        foreach ($table_default as $table=>$legend){
            
            //query tha data
            if($kecamatan=='Darek'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Pengadang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Kopang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mantang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mujur'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Puyung'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Ubung'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $data_count[$legend]         += $datas->counts;
                    $result_data[$users[$datas->userid]] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormByVisitDate($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getDesa('gizi',$kecamatan);
        
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
        foreach ($table_default as $table=>$legend){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($kecamatan=='Darek'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi26%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Pengadang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi30%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Kopang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi21%' OR providerId LIKE '%gizi25%' OR providerId LIKE '%gizi29%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mantang'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi23%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mujur'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Puyung'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Ubung'){
                $query = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%gizi20%') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
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
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_gizi_registrasi_gizi'=>'Registrasi Gizi',
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi',
            'event_gizi_penutupan_anak'=>'Penutupan Anak'];
        $tabindex = [
            'event_gizi_registrasi_gizi'=>0,
            'event_gizi_kunjungan_gizi'=>1,
            'event_gizi_penutupan_anak'=>2];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($desa=="Batu_Tulis"){
            $users = ['gizi20'=>'Batu Tulis'];
        }elseif($desa=="Aik_Bual"){
            $users = ['gizi21'=>'Aik Bual'];
        }elseif($desa=="Teduh"){
            $users = ['gizi22'=>'Teduh'];
        }elseif($desa=="Presak"){
            $users = ['gizi23'=>'Presak'];
        }elseif($desa=="Mantang"){
            $users = ['gizi24'=>'Mantang'];
        }elseif($desa=="Kopang Rembiga"){
            $users = ['gizi25'=>'Kopang Rembiga'];
        }elseif($desa=="Serage"){
            $users = ['gizi26'=>'Serage'];
        }elseif($desa=="Gemel"){
            $users = ['gizi27'=>'Gemel'];
        }elseif($desa=="Labulia"){
            $users = ['gizi28'=>'Labulia'];
        }elseif($desa=="Montong Gamang"){
            $users = ['gizi29'=>'Montong Gamang'];
        }elseif($desa=="Gerantung"){
            $users = ['gizi30'=>'Gerantung'];
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
        
        
        foreach ($tables as $table=>$legend){
            
            //query tha data
            reset($users);
            $query3 = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%".$user."%') and eventDate LIKE '".$date."%' group by providerId, eventDate");
            foreach ($query3->result() as $datas){
                $datas->userid = trim($datas->userid);
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
    
    public function getCountPerFormByVisitDateForDrill($desa="",$date=""){
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi'];
        $tabindex = [
            'event_gizi_kunjungan_gizi'=>0];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($desa=="Batu_Tulis"){
            $users = ['gizi20'=>'Batu Tulis'];
        }elseif($desa=="Aik_Bual"){
            $users = ['gizi21'=>'Aik Bual'];
        }elseif($desa=="Pendem"){
            $users = ['gizi22'=>'Pendem'];
        }elseif($desa=="Setuta"){
            $users = ['gizi23'=>'Setuta'];
        }elseif($desa=="Jango"){
            $users = ['gizi24'=>'Jango'];
        }elseif($desa=="Janapria"){
            $users = ['gizi25'=>'Janapria'];
        }elseif($desa=="Ketara"){
            $users = ['gizi26'=>'Ketara'];
        }elseif($desa=="Sengkol"){
            $users = ['gizi27'=>'Sengkol'];
        }elseif($desa=="Kawo"){
            $users = ['gizi28'=>'Kawo'];
        }elseif($desa=="Tanak_Awu"){
            $users = ['gizi29'=>'Tanak Awu'];
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
        
        foreach ($tables as $table=>$legend){
            //query tha data
            reset($users);
            $query3 = $giziDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId LIKE '%".$user."%') and eventDate LIKE '".$date."%' group by providerId, eventDate");
            foreach ($query3->result() as $datas){
                $datas->userid = trim($datas->userid);
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