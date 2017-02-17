<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsFhwEcModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
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
        if($desa==""){
            $username = $this->session->userdata('username');
            $kec = $this->loc->getKecFromUser('bidan',$username);
            $namadusun = $this->loc->getDesaFromUser('bidan',$kec,$username);
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        
        //make result array from the tables name
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $data[$legend] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        foreach ($table_default as $table=>$legend){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId LIKE '%$username%')");
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT dusun FROM client_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                foreach ($query2->result() as $c2_data){
                    if(array_key_exists($c2_data->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                        $data_count[$legend]         += 1;
                        $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        $data_count[$legend]         += 1;
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
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
        
        if($this->session->userdata('level')=="fhw"){
            $username = $this->session->userdata('username');
        }else{
            $username = $this->loc->getUserFromDusun('bidan',$dusun);
        }
        
        $listdusun = $this->loc->getDusunTypo($this->loc->getDesaFromUser('bidan',$this->loc->getKecFromUser('bidan',$username),$username));
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
                array_push($data[$date]["data"], array($td_name,0));
            }
        }
        $result_data = $data;
        
        foreach ($tables as $table=>$legend){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId LIKE '%$username%') and eventDate LIKE '".$date."%'");
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT dusun FROM client_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                foreach ($query2->result() as $c2_data){
                    if(array_key_exists($c2_data->dusun, $namadusun)){
                        $data_count                  = $result_data[$date];
                        if(array_key_exists($table, $table_default)){
                            $data_count["data"][$tabindex[$table]][1]         += 1;
                        }
                        $result_data[$date] = $data_count;
                    }
                }
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDay($desa="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($desa,$mode);
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
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                array_push($tables, $table->Tables_in_ec_analytics);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        //make result array from the tables name
        $result_data = array();
        if($range!=""){
            foreach ($namadusun as $nama){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }else{
            foreach ($namadusun as $nama){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }
        
        foreach ($tables as $table){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId LIKE '%$username%')");
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT dusun FROM client_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                foreach ($query2->result() as $c2_data){
                    if(array_key_exists($c2_data->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                        $tgl = explode('T', $c_data->eventDate);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $data_count)){
                            $data_count[$tgl] += 1;;
                        }
                        $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        if(array_key_exists($tgl, $data_count)){
                            $data_count[$tgl] += 1;;
                        }
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($desa="",$mode="Mingguan"){
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
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                array_push($tables, $table->Tables_in_ec_analytics);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $kec = $this->loc->getKecFromUser('bidan',$username);
            $namadusun = $this->loc->getDesaFromUser('bidan',$kec,$username);
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
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
            $result_data[$nama] = $data;
        }
        
        foreach ($tables as $table){
            if($mode=='Mingguan'){
                $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId LIKE '%$username%') and (eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
            }elseif($mode=='Bulanan'){
                $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId LIKE '%$username%') and (eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
            }
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT dusun FROM client_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                $tgl = explode('T', $c_data->eventDate);
                $tgl = $tgl[0];
                foreach ($query2->result() as $c2_data){
                    if($mode=='Mingguan'){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $week   =   $result_data[$namadusun[$c2_data->dusun]];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($tgl, $thisweek)){
                                $thisweek[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastweek)){
                                $lastweek[$tgl] +=1;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data[$namadusun[$c2_data->dusun]] = $week;
                        }else{
                            $week   =   $result_data["Lainnya"];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($tgl, $thisweek)){
                                $thisweek[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastweek)){
                                $lastweek[$tgl] +=1;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data["Lainnya"] = $week;
                        }
                    }elseif($mode=='Bulanan'){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $month = $result_data[$namadusun[$c2_data->dusun]];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $tgl);
                            array_pop($m);
                            $tgl = implode('-',$m);
                            if(array_key_exists($tgl, $thisyear)){
                                $thisyear[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastyear)){
                                $lastyear[$tgl] +=1;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data[$namadusun[$c2_data->dusun]] = $month;
                        }else{
                            $month = $result_data["Lainnya"];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $tgl);
                            array_pop($m);
                            $tgl = implode('-',$m);
                            if(array_key_exists($tgl, $thisyear)){
                                $thisyear[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastyear)){
                                $lastyear[$tgl] +=1;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data["Lainnya"] = $month;
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
}