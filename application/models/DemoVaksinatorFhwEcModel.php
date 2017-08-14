<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorFhwEcModel extends CI_Model{
    
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
                $data[$legend] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        $data_dusun = $vaksinatorDB->query("SELECT client_anak.baseEntityId as baseEntityId,client_ibu.dusun as dusun FROM client_anak LEFT JOIN client_ibu ON client_ibu.baseEntityId=client_anak.ibuCaseId");
        $list_dusun = [];
        foreach ($data_dusun->result() as $d){
            $list_dusun[$d->baseEntityId] = $d->dusun;
        }
        
        foreach ($tables as $table=>$legend){
            if($table=='event_vaksin_registrasi_vaksinator'){
                $query = $vaksinatorDB->query("SELECT client_ibu.dusun, $table.baseEntityId from ".$table." LEFT JOIN client_ibu ON client_ibu.baseEntityId=$table.baseEntityId where (locationId LIKE '%$username%')");
                foreach ($query->result() as $c_data){
                    $n_dusun = $c_data->dusun;
                    if(array_key_exists($n_dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$n_dusun]];
                        $data_count[$legend]         += 1;
                        $result_data[$namadusun[$n_dusun]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        $data_count[$legend]         += 1;
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }else{
                $query = $vaksinatorDB->query("SELECT locationId, baseEntityId, dateCreated from ".$table." where (locationId LIKE '%$username%')");
                foreach ($query->result() as $c_data){
                    if(array_key_exists($c_data->baseEntityId, $list_dusun)){
                        $n_dusun = $list_dusun[$c_data->baseEntityId];
                        if(array_key_exists($n_dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$n_dusun]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$n_dusun]] = $data_count;
                        }else{
                            $data_count                  = $result_data["Lainnya"];
                            $data_count[$legend]         += 1;
                            $result_data["Lainnya"] = $data_count;
                        }
                    }
                }
            }
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
                array_push($data[$date]["data"], array($td_name,0));
            }
        }
        $result_data = $data;
        
        foreach ($tables as $table=>$legend){
            if($table=='event_vaksin_registrasi_vaksinator'){
                $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,client_ibu.dusun,count(*) as counts from ".$table." 
                                      left join client_ibu 
                                        on ".$table.".`baseEntityId`=client_ibu.`baseEntityId`
                                    WHERE (".$table.".locationId LIKE '%$username%')  and ".$table.".dateCreated LIKE '".$date."%'
                                    GROUP BY dusun");
            }else
            $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,client_ibu.dusun,count(*) as counts from ".$table." 
                                      left join client_anak 
                                        on ".$table.".`baseEntityId`=client_anak.`baseEntityId` 
                                      LEFT JOIN client_ibu
                                        on client_anak.ibuCaseId=client_ibu.baseEntityId
                                    WHERE (".$table.".locationId LIKE '%$username%') and ".$table.".dateCreated LIKE '".$date."%'
                                    GROUP BY dusun");
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->dusun, $namadusun)){
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
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }else{
            foreach ($namadusun as $dusun=>$nama){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }        
        
        foreach ($tables as $table=>$legend){
            if($table=='event_vaksin_registrasi_vaksinator'){
                $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                      left join client_ibu 
                                        on ".$table.".`baseEntityId`=client_ibu.`baseEntityId`
                                    WHERE (".$table.".locationId LIKE '%$username%')
                                    GROUP BY dusun,dateCreated");
            }else
            $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                      left join client_anak 
                                        on ".$table.".`baseEntityId`=client_anak.`baseEntityId` 
                                      LEFT JOIN client_ibu
                                        on client_anak.ibuCaseId=client_ibu.baseEntityId
                                    WHERE (".$table.".locationId LIKE '%$username%')
                                    GROUP BY dusun,dateCreated");
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->dusun, $namadusun)){
                    $data_count                  = $result_data[$namadusun[$datas->dusun]];
                    $tgl = explode('T', $datas->dateCreated);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$namadusun[$datas->dusun]] = $data_count;
                }else{
                    var_dump($datas->dusun);
                    $data_count                  = $result_data["Lainnya"];
                    $tgl = explode('T', $datas->dateCreated);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data["Lainnya"] = $data_count;
                }
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
        
        
        foreach ($tables as $table=>$legend){
            if($mode=='Mingguan'){
                if($table=='event_vaksin_registrasi_vaksinator'){
                    $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                          left join client_ibu 
                                            on ".$table.".`baseEntityId`=client_ibu.`baseEntityId`
                                        WHERE (".$table.".locationId LIKE '%$username%') AND ".$table.".`dateCreated` >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND ".$table.".`dateCreated` <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."'
                                        GROUP BY dusun,dateCreated");
                }else
                $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                          left join client_anak 
                                            on ".$table.".`baseEntityId`=client_anak.`baseEntityId` 
                                          LEFT JOIN client_ibu
                                            on client_anak.ibuCaseId=client_ibu.baseEntityId
                                        WHERE (".$table.".locationId LIKE '%$username%')  AND ".$table.".`dateCreated` >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' AND ".$table.".`dateCreated` <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."'
                                        GROUP BY dusun,dateCreated");
            }elseif($mode=='Bulanan'){
                if($table=='event_vaksin_registrasi_vaksinator'){
                    $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                          left join client_ibu 
                                            on ".$table.".`baseEntityId`=client_ibu.`baseEntityId`
                                        WHERE (".$table.".locationId LIKE '%$username%') AND ".$table.".`dateCreated` >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND ".$table.".`dateCreated` <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."'
                                        GROUP BY dusun,dateCreated");
                }else
                $query = $vaksinatorDB->query("SELECT ".$table.".`locationId`,".$table.".`dateCreated`,client_ibu.dusun,count(*) as counts from ".$table." 
                                          left join client_anak 
                                            on ".$table.".`baseEntityId`=client_anak.`baseEntityId` 
                                          LEFT JOIN client_ibu
                                            on client_anak.ibuCaseId=client_ibu.baseEntityId
                                        WHERE (".$table.".locationId LIKE '%$username%')  AND ".$table.".`dateCreated` >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND ".$table.".`dateCreated` <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."'
                                        GROUP BY dusun,dateCreated");
            }
            
            
            foreach ($query->result() as $datas){
                if($mode=='Mingguan'){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $week   =   $result_data[$namadusun[$datas->dusun]];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        $tgl = explode('T', $datas->dateCreated);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $thisweek)){
                            $thisweek[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastweek)){
                            $lastweek[$tgl] +=$datas->counts;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data[$namadusun[$datas->dusun]] = $week;
                    }else{
                        $week   =   $result_data["Lainnya"];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        $tgl = explode('T', $datas->dateCreated);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $thisweek)){
                            $thisweek[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastweek)){
                            $lastweek[$tgl] +=$datas->counts;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data["Lainnya"] = $week;
                    }
                }elseif($mode=='Bulanan'){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $month = $result_data[$namadusun[$datas->dusun]];
                        $thisyear = $month['thisyear'];
                        $lastyear = $month['lastyear'];
                        $tgl = explode('T', $datas->dateCreated);
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
                        $result_data[$namadusun[$datas->dusun]] = $month;
                    }else{
                        $month = $result_data["Lainnya"];
                        $thisyear = $month['thisyear'];
                        $lastyear = $month['lastyear'];
                        $tgl = explode('T', $datas->dateCreated);
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
                        $result_data["Lainnya"] = $month;
                    }
                }
            }
        }
        
        return $result_data;
    }
}