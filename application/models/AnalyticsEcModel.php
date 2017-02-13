<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerDayDrill($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else array_push($tables, $table->Tables_in_ec_analytics);
        }
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        //make result array from the tables name
        $result_data = array();
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
        
        
        foreach ($tables as $table){
            //query tha data
            if($range!=""){
                if($kecamatan=='Darek'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '".$range[0]."' AND eventDate <= '".$range[1]."' group by providerId, eventDate");
                }
            }else{
                if($kecamatan=='Darek'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' AND eventDate <= '".date("Y-m-d")."' group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
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
//        var_dump($result_data);
        return $result_data;
    }
    
    public function getCountPerDayByVisitDate($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    array_push($tables, $table->Tables_in_ec_analytics);
                }
                
            }
        }
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        //make result array from the tables name
        $result_data = array();
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
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            //query tha data
            if($range!=""){
                if($table=="kartu_anc_visit"){
                    $query = $analyticsDB->query("SELECT userid, ancDate as visitdate,count(*) as counts from ".$table." where (ancDate >= '".$range[0]."' and ancDate <= '".$range[1]."') group by userid, ancDate");
                }elseif($table=="kartu_pnc_regitration_oa"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahir as visitdate,count(*) as counts from ".$table." where (tanggalLahir >= '".$range[0]."' and tanggalLahir <= '".$range[1]."') group by userid, tanggalLahir");
                }elseif($table=="kartu_pnc_dokumentasi_persalinan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahirAnak as visitdate,count(*) as counts from ".$table." where (tanggalLahirAnak >= '".$range[0]."' and tanggalLahirAnak <= '".$range[1]."') group by userid, tanggalLahirAnak");
                }elseif($table=="kartu_pnc_visit"){
                    $query = $analyticsDB->query("SELECT userid, referenceDate as visitdate,count(*) as counts from ".$table." where (referenceDate >= '".$range[0]."' and referenceDate <= '".$range[1]."') group by userid, referenceDate");
                }elseif($table=="kohort_bayi_kunjungan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalKunjunganBayiPerbulan as visitdate,count(*) as counts from ".$table." where (tanggalKunjunganBayiPerbulan >= '".$range[0]."' and tanggalKunjunganBayiPerbulan <= '".$range[1]."') group by userid, tanggalKunjunganBayiPerbulan");
                }elseif($table=="kohort_kb_pelayanan"&&$table=="kohort_kb_update"){
                    $query = $analyticsDB->query("SELECT userid, tanggalkunjungan as visitdate,count(*) as counts from ".$table." where (tanggalkunjungan >= '".$range[0]."' and tanggalkunjungan <= '".$range[1]."') group by userid, tanggalkunjungan");
                }else{
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate as visitdate,count(*) as counts from ".$table." where (eventDate >= '".$range[0]."' and eventDate <= '".$range[1]."') group by providerId, eventDate");
                }
            }else{
                if($table=="kartu_anc_visit"){
                    $query = $analyticsDB->query("SELECT userid, ancDate as visitdate,count(*) as counts from ".$table." where (ancDate >= '".date("Y-m-d",strtotime("-30 days"))."' and ancDate <= '".date("Y-m-d")."') group by userid, ancDate");
                }elseif($table=="kartu_pnc_regitration_oa"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahir as visitdate,count(*) as counts from ".$table." where (tanggalLahir >= '".date("Y-m-d",strtotime("-30 days"))."' and tanggalLahir <= '".date("Y-m-d")."') group by userid, tanggalLahir");
                }elseif($table=="kartu_pnc_dokumentasi_persalinan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahirAnak as visitdate,count(*) as counts from ".$table." where (tanggalLahirAnak >= '".date("Y-m-d",strtotime("-30 days"))."' and tanggalLahirAnak <= '".date("Y-m-d")."') group by userid, tanggalLahirAnak");
                }elseif($table=="kartu_pnc_visit"){
                    $query = $analyticsDB->query("SELECT userid, referenceDate as visitdate,count(*) as counts from ".$table." where (referenceDate >= '".date("Y-m-d",strtotime("-30 days"))."' and referenceDate <= '".date("Y-m-d")."') group by userid, referenceDate");
                }elseif($table=="kohort_bayi_kunjungan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalKunjunganBayiPerbulan as visitdate,count(*) as counts from ".$table." where (tanggalKunjunganBayiPerbulan >= '".date("Y-m-d",strtotime("-30 days"))."' and tanggalKunjunganBayiPerbulan <= '".date("Y-m-d")."') group by userid, tanggalKunjunganBayiPerbulan");
                }elseif($table=="kohort_kb_pelayanan"&&$table=="kohort_kb_update"){
                    $query = $analyticsDB->query("SELECT userid, tanggalkunjungan as visitdate,count(*) as counts from ".$table." where (tanggalkunjungan >= '".date("Y-m-d",strtotime("-30 days"))."' and tanggalkunjungan <= '".date("Y-m-d")."') group by userid, tanggalkunjungan");
                }else{
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate as visitdate,count(*) as counts from ".$table." where (eventDate >= '".date("Y-m-d",strtotime("-30 days"))."' and eventDate <= '".date("Y-m-d")."') group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $tgl = explode('T', $datas->visitdate);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
            }
        }
//        var_dump($result_data);
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else array_push($tables, $table->Tables_in_ec_analytics);
        }
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
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
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Pengadang'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Kopang'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Mantang'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Mujur'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Puyung'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }elseif($kecamatan=='Ubung'){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."' group by providerId, eventDate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by providerId, eventDate");
                }
            }
            
            foreach ($query->result() as $datas){
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
    
    public function downloadCountPerForm($kecamatan="",$start,$end,$old="no"){
        $start = new DateTime($start);
        $end = $end1 = new DateTime($end);
        $end = $end->modify('+1 day'); 
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval ,$end);
        
        $this->load->library('PHPExcell');
        
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        $table_name = [
            'event_bidan_identitas_ibu',
            'event_bidan_tambah_anc',
            'event_bidan_kunjungan_anc',
            'event_bidan_kunjungan_anc_lab_test',
            'event_bidan_rencana_persalinan',
            'event_bidan_dokumentasi_persalinan',
            'event_bidan_kunjungan_pnc',
            'event_bidan_child_registration',
            'event_bidan_penutupan_anak'];
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach($daterange as $date){
                $data[$date->format("Y-m-d")] = array();
                foreach ($table_default as $table=>$legend){
                    $table_data = 0;
                    $data[$date->format("Y-m-d")][$legend] = $table_data;
                }
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($tables as $table=>$legend){
            //query tha data
            foreach($daterange as $date){
                if($kecamatan=='Darek'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Pengadang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Kopang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Mantang'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Mujur'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Puyung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }elseif($kecamatan=='Ubung'){
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate LIKE '".$date->format("Y-m-d")."%' group by providerId, eventDate");
                }
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->userid, $users)){
                        $data_count                  = $result_data[$users[$datas->userid]][$date->format("Y-m-d")];
                        $data_count[$legend]         += $datas->counts;
                        $result_data[$users[$datas->userid]][$date->format("Y-m-d")] = $data_count;
                    }
                }
            }
            
        }
        
        $fileObject = new PHPExcel();
        $sheetIndex = $fileObject->getIndex(
            $fileObject->getSheetByName('Worksheet')
        );
        $fileObject->removeSheetByIndex($sheetIndex);
        $index = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];
        foreach ($result_data as $nama_desa=>$table_data){
            $myWorkSheet = new PHPExcel_Worksheet($fileObject, $nama_desa);
            $fileObject->addSheet($myWorkSheet);
            $fileObject->setActiveSheetIndexByName($nama_desa);
            $fileObject->getActiveSheet()->setCellValue('A1', 'Tanggal');
            $col = 0;
            foreach ($table_name as $name){
                $fileObject->getActiveSheet()->setCellValue($index[++$col].'1', $name);
            }
            $row = 2;
            foreach ($table_data as $date=>$tdata){
                $col = 0;
                $fileObject->getActiveSheet()->setCellValue($index[$col++].$row, $date);
                foreach ($tdata as $tname=>$value){
                    $fileObject->getActiveSheet()->setCellValue($index[$col++].$row, $value);
                }
                $row++;
            }
            $fileObject->getActiveSheet()->setCellValue('A'.$row, "TOTAL");
            $col = 1;
            foreach ($table_name as $name){
                $fileObject->getActiveSheet()->setCellValue($index[$col].$row, '=SUM('.$index[$col].'2:'.$index[$col].($row-1).')');
                $col++;
            }
        }
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Dataentryform-'.$kecamatan.'-'.$start->format("Ymd").'-'.$end1->format("Ymd").'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
    
    public function downloadCountPerFormByVisitDate($kecamatan="",$start,$end){
        $start = new DateTime($start);
        $end = $end1 = new DateTime($end);
        $end = $end->modify('+1 day'); 
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval ,$end);
        
        $this->load->library('PHPExcell');
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        $table_name = [
            'event_bidan_identitas_ibu',
            'event_bidan_tambah_anc',
            'event_bidan_kunjungan_anc',
            'event_bidan_kunjungan_anc_lab_test',
            'event_bidan_rencana_persalinan',
            'event_bidan_dokumentasi_persalinan',
            'event_bidan_kunjungan_pnc',
            'event_bidan_child_registration',
            'event_bidan_penutupan_anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                $tables[$table->Tables_in_analytics]=$table_default[$table->Tables_in_analytics];
            }
        }
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach($daterange as $date){
                $data[$date->format("Y-m-d")] = array();
                foreach ($table_default as $table=>$legend){
                    $table_data = 0;
                    $data[$date->format("Y-m-d")][$legend] = $table_data;
                }
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($tables as $table=>$legend){
            //query tha data
            foreach($daterange as $date){
                if($table=="kartu_anc_visit"){
                    $query = $analyticsDB->query("SELECT userid, ancDate,count(*) as counts from ".$table." where ancDate = '".$date->format("Y-m-d")."' group by userid, ancDate");
                }elseif($table=="kartu_pnc_regitration_oa"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahir,count(*) as counts from ".$table." where tanggalLahir = '".$date->format("Y-m-d")."' group by userid, tanggalLahir");
                }elseif($table=="kartu_pnc_dokumentasi_persalinan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalLahirAnak,count(*) as counts from ".$table." where tanggalLahirAnak = '".$date->format("Y-m-d")."' group by userid, tanggalLahirAnak");
                }elseif($table=="kartu_pnc_visit"){
                    $query = $analyticsDB->query("SELECT userid, referenceDate,count(*) as counts from ".$table." where referenceDate = '".$date->format("Y-m-d")."' group by userid, referenceDate");
                }elseif($table=="kohort_bayi_kunjungan"){
                    $query = $analyticsDB->query("SELECT userid, tanggalKunjunganBayiPerbulan,count(*) as counts from ".$table." where tanggalKunjunganBayiPerbulan = '".$date->format("Y-m-d")."' group by userid, tanggalKunjunganBayiPerbulan");
                }elseif($table=="kohort_kb_pelayanan"&&$table=="kohort_kb_update"){
                    $query = $analyticsDB->query("SELECT userid, tanggalkunjungan,count(*) as counts from ".$table." where tanggalkunjungan = '".$date->format("Y-m-d")."' group by userid, tanggalkunjungan");
                }else{
                    $query = $analyticsDB->query("SELECT providerId as userid, eventDate as submissiondate,count(*) as counts from ".$table." where eventDate = '".$date->format("Y-m-d")."' group by providerId, eventDate");
                }
                    
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->userid, $users)){
                        $data_count                  = $result_data[$users[$datas->userid]][$date->format("Y-m-d")];
                        $data_count[$legend]         += $datas->counts;
                        $result_data[$users[$datas->userid]][$date->format("Y-m-d")] = $data_count;
                    }
                }
            }
            
        }
        
        $fileObject = new PHPExcel();
        $sheetIndex = $fileObject->getIndex(
            $fileObject->getSheetByName('Worksheet')
        );
        $fileObject->removeSheetByIndex($sheetIndex);
        $index = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];
        foreach ($result_data as $nama_desa=>$table_data){
            $myWorkSheet = new PHPExcel_Worksheet($fileObject, $nama_desa);
            $fileObject->addSheet($myWorkSheet);
            $fileObject->setActiveSheetIndexByName($nama_desa);
            $fileObject->getActiveSheet()->setCellValue('A1', 'Tanggal');
            $col = 0;
            foreach ($table_name as $name){
                $fileObject->getActiveSheet()->setCellValue($index[++$col].'1', $name);
            }
            $row = 2;
            foreach ($table_data as $date=>$tdata){
                $col = 0;
                $fileObject->getActiveSheet()->setCellValue($index[$col++].$row, $date);
                foreach ($tdata as $tname=>$value){
                    $fileObject->getActiveSheet()->setCellValue($index[$col++].$row, $value);
                }
                $row++;
            }
            $fileObject->getActiveSheet()->setCellValue('A'.$row, "TOTAL");
            $col = 1;
            foreach ($table_name as $name){
                $fileObject->getActiveSheet()->setCellValue($index[$col].$row, '=SUM('.$index[$col].'2:'.$index[$col].($row-1).')');
                $col++;
            }
        }
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Dataentryformbyvisitdate-'.$kecamatan.'-'.$start->format("Ymd").'-'.$end1->format("Ymd").'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
            
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }

        foreach ($tables as $table=>$legend){
            //query tha data
            if($kecamatan=='Darek'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Pengadang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Kopang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mantang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mujur'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Puyung'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Ubung'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
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
    
    public function getCountPerFormByVisitDate($kecamatan="",$start,$end,$old="no"){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        
        $users = $this->loc->getDesa('bidan',$kecamatan);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }

        foreach ($tables as $table=>$legend){
            //query tha data
            if($kecamatan=='Darek'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Pengadang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Kopang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user21') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mantang'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Mujur'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Puyung'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
            }elseif($kecamatan=='Ubung'){
                $query = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='user20') AND eventDate >= '$start' AND eventDate <= '$end' group by providerId, eventDate");
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
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        $tabindex = [
            'event_bidan_identitas_ibu'=>0,
            'event_bidan_tambah_anc'=>1,
            'event_bidan_kunjungan_anc'=>2,
            'event_bidan_kunjungan_anc_lab_test'=>3,
            'event_bidan_rencana_persalinan'=>4,
            'event_bidan_dokumentasi_persalinan'=>5,
            'event_bidan_kunjungan_pnc'=>6,
            'event_bidan_child_registration'=>7,
            'event_bidan_penutupan_anak'=>8];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        if($desa=="Batu_Tulis"){
            $users = ['user20'=>'Batu Tulis'];
        }elseif($desa=="Aik_Bual"){
            $users = ['user21'=>'Aik Bual'];
        }elseif($desa=="Pendem"){
            $users = ['user22'=>'Pendem'];
        }elseif($desa=="Setuta"){
            $users = ['user23'=>'Setuta'];
        }elseif($desa=="Jango"){
            $users = ['user24'=>'Jango'];
        }elseif($desa=="Janapria"){
            $users = ['user25'=>'Janapria'];
        }elseif($desa=="Ketara"){
            $users = ['user26'=>'Ketara'];
        }elseif($desa=="Sengkol"){
            $users = ['user27'=>'Sengkol'];
        }elseif($desa=="Kawo"){
            $users = ['user28'=>'Kawo'];
        }elseif($desa=="Tanak_Awu"){
            $users = ['user29'=>'Tanak Awu'];
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
        //var_dump($result_data);
        foreach ($users as $user=>$desa){
            foreach ($tables as $table=>$legend){
                //query tha data
                $query3 = $analyticsDB->query("SELECT providerId as userid, eventDate,count(*) as counts from ".$table." where (providerId='".$user."') and eventDate LIKE '".$date."%' group by providerId, eventDate");
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
        }
        return $result_data;
    }
    
    public function getCountPerFormByVisitDateForDrill($desa="",$date=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        $tabindex = [
            'event_bidan_identitas_ibu'=>0,
            'event_bidan_tambah_anc'=>1,
            'event_bidan_kunjungan_anc'=>2,
            'event_bidan_kunjungan_anc_lab_test'=>3,
            'event_bidan_rencana_persalinan'=>4,
            'event_bidan_dokumentasi_persalinan'=>5,
            'event_bidan_kunjungan_pnc'=>6,
            'event_bidan_child_registration'=>7,
            'event_bidan_penutupan_anak'=>8];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                $tables[$table->Tables_in_analytics]=$table_default[$table->Tables_in_analytics];
            }
        }
        if($desa=="Lekor"){
            $users = ['user1'=>'Lekor'];
        }elseif($desa=="Saba"){
            $users = ['user2'=>'Saba'];
        }elseif($desa=="Pendem"){
            $users = ['user3'=>'Pendem'];
        }elseif($desa=="Setuta"){
            $users = ['user4'=>'Setuta'];
        }elseif($desa=="Jango"){
            $users = ['user5'=>'Jango'];
        }elseif($desa=="Janapria"){
            $users = ['user6'=>'Janapria'];
        }elseif($desa=="Ketara"){
            $users = ['user8'=>'Ketara'];
        }elseif($desa=="Sengkol"){
            $users = ['user9'=>'Sengkol','user10'=>'Sengkol'];
        }elseif($desa=="Kawo"){
            $users = ['user11'=>'Kawo'];
        }elseif($desa=="Tanak_Awu"){
            $users = ['user12'=>'Tanak Awu'];
        }elseif($desa=="Pengembur"){
            $users = ['user13'=>'Pengembur'];
        }elseif($desa=="Segala_Anyar"){
            $users = ['user14'=>'Segala Anyar'];
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
        //var_dump($result_data);
        //retrieve all the columns in the table
        $columns = array();
        foreach ($users as $user=>$desa){
            foreach ($tables as $table=>$legend){
                //query tha data
                if($table=="kartu_anc_visit"){
                    $query3 = $analyticsDB->query("SELECT userid, ancDate,count(*) as counts from ".$table." where (userid='".$user."') and ancDate='".$date."' group by userid, ancDate");
                }elseif($table=="kartu_pnc_regitration_oa"){
                    $query3 = $analyticsDB->query("SELECT userid, tanggalLahir,count(*) as counts from ".$table." where (userid='".$user."') and tanggalLahir='".$date."' group by userid, tanggalLahir");
                }elseif($table=="kartu_pnc_dokumentasi_persalinan"){
                    $query3 = $analyticsDB->query("SELECT userid, tanggalLahirAnak,count(*) as counts from ".$table." where (userid='".$user."') and tanggalLahirAnak='".$date."' group by userid, tanggalLahirAnak");
                }elseif($table=="kartu_pnc_visit"){
                    $query3 = $analyticsDB->query("SELECT userid, referenceDate,count(*) as counts from ".$table." where (userid='".$user."') and referenceDate='".$date."' group by userid, referenceDate");
                }elseif($table=="kohort_bayi_kunjungan"){
                    $query3 = $analyticsDB->query("SELECT userid, tanggalKunjunganBayiPerbulan,count(*) as counts from ".$table." where (userid='".$user."') and tanggalKunjunganBayiPerbulan='".$date."' group by userid, tanggalKunjunganBayiPerbulan");
                }elseif($table=="kohort_kb_pelayanan"&&$table=="kohort_kb_update"){
                    $query3 = $analyticsDB->query("SELECT userid, tanggalkunjungan,count(*) as counts from ".$table." where (userid='".$user."') and tanggalkunjungan='".$date."' group by userid, tanggalkunjungan");
                }else{
                    $query3 = $analyticsDB->query("SELECT userid, submissiondate,count(*) as counts from ".$table." where (userid='".$user."') and submissiondate='".$date."' group by userid, submissiondate");
                }
                
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
        }
        return $result_data;
    }
}