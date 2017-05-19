<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsFhwEcModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM gen_analytics");
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_gen_analytics, $table_default)){
                $tables[$table->Tables_in_gen_analytics]=$table_default[$table->Tables_in_gen_analytics];
            }
        }
        if($desa==""){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$desa=>$namadusun];
        }else{
            $username = $this->loc->getLocUserbyDesa('bidan',$desa);
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
        
        
        foreach ($tables as $table=>$legend){
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"||$table=="kartu_ibu_edit"){
                $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun");
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$datas->dusun]];
                        $data_count[$legend]         += $datas->counts;
                        $result_data[$namadusun[$datas->dusun]] = $data_count;                   
                    }
                }
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kartu_anc_close"||$table=="kartu_anc_edit"||$table=="kartu_anc_visit_edit"||$table=="kartu_anc_visit_integrasi"||$table=="kartu_anc_visit_labTest"||$table=="kartu_ibu_close"||$table=="kartu_pnc_close"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_pnc_edit"||$table=="kohort_bayi_edit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if(array_key_exists($p_data->dusun, $namadusun)){
                                $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                $data_count[$legend]         += 1;
                                $result_data[$namadusun[$p_data->dusun]] = $data_count;
                            }
                        }
                    }
                }
            }elseif($table=="kartu_pnc_visit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kohort_bayi_kunjungan"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration LEFT JOIN kartu_ibu_registration ON kohort_bayi_registration.kiId=kartu_ibu_registration.kiId where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_anak_tutup"||$table=="kohort_bayi_immunization"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                    $data_count[$legend]         += 1;
                                    $result_data[$namadusun[$p_data->dusun]] = $data_count;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM gen_analytics");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_gen_analytics, $table_default)){
                $tables[$table->Tables_in_gen_analytics]=$table_default[$table->Tables_in_gen_analytics];
            }
        }
        
        if($this->session->userdata('level')=="fhw"){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $listdusun = $this->loc->getDusunTypo($desa);
        }else{
            $username = $this->loc->getDesaFromDusun($dusun);
            $listdusun = $this->loc->getDusunTypo($username);
            $username = $this->loc->getUserFromDusun('bidan',$dusun);
        }
        
        
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
                array_push($data[$date]["data"], array($td_name, 0));
            }
        }
        $result_data = $data;
        
        foreach ($tables as $table=>$legend){
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"||$table=="kartu_ibu_edit"){
                $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and submissiondate='".$date."' group by dusun");
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $data_count                  = $result_data[$date];
                        if(array_key_exists($table, $table_default)){
                            $data_count["data"][$tabindex[$table]][1]         += $datas->counts;
                        }
                        $result_data[$date] = $data_count;
                    }
                }
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kartu_anc_close"||$table=="kartu_anc_edit"||$table=="kartu_anc_visit_edit"||$table=="kartu_anc_visit_integrasi"||$table=="kartu_anc_visit_labTest"||$table=="kartu_ibu_close"||$table=="kartu_pnc_close"||$table=="kohort_kb_close"||$table=="kohort_kb_edit"||$table=="kohort_kb_pelayanan"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
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
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_pnc_edit"||$table=="kohort_bayi_edit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if(array_key_exists($p_data->dusun, $namadusun)){
                                $data_count                  = $result_data[$date];
                                if(array_key_exists($table, $table_default)){
                                    $data_count["data"][$tabindex[$table]][1]         += 1;
                                }
                                $result_data[$date] = $data_count;
                            }
                        }
                    }
                }
            }elseif($table=="kartu_pnc_visit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration where motherId='$c_data->motherId'");
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
            }elseif($table=="kohort_bayi_kunjungan"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration LEFT JOIN kartu_ibu_registration ON kohort_bayi_registration.kiId=kartu_ibu_registration.kiId where childId='$c_data->childId'");
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
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_anak_tutup"||$table=="kohort_bayi_immunization"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $data_count                  = $result_data[$date];
                                    if(array_key_exists($table, $table_default)){
                                        $data_count["data"][$tabindex[$table]][1]         += 1;
                                    }
                                    $result_data[$date] = $data_count;
                                }
                            }
                        }
                    }
                }
            }elseif($table=="kohort_kb_update"||$table=="kohort_kb_close"||$table=="kohort_kb_edit"||$table=="kohort_kb_pelayanan"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and submissiondate='".$date."'");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_kb_registration where kiId='$c_data->kiId'");
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
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDay($desa="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($desa,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM gen_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_gen_analytics, $table_default)){
                $tables[$table->Tables_in_gen_analytics]=$table_default[$table->Tables_in_gen_analytics];
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $desa = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }else{
            $username = $this->loc->getLocUserbyDesa('bidan',$desa);
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
        
        foreach ($tables as $table=>$legend){
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"||$table=="kartu_ibu_edit"){
                $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,submissiondate");
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$datas->dusun]];
                        if(array_key_exists($datas->submissiondate, $data_count)){
                            $data_count[$datas->submissiondate] +=$datas->counts;
                        }
                        $result_data[$namadusun[$datas->dusun]] = $data_count;
                    }
                }
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kartu_anc_close"||$table=="kartu_anc_edit"||$table=="kartu_anc_visit_edit"||$table=="kartu_anc_visit_integrasi"||$table=="kartu_anc_visit_labTest"||$table=="kartu_ibu_close"||$table=="kartu_pnc_close"||$table=="kohort_kb_close"||$table=="kohort_kb_edit"||$table=="kohort_kb_pelayanan"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_pnc_edit"||$table=="kohort_bayi_edit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if(array_key_exists($p_data->dusun, $namadusun)){
                                $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                if(array_key_exists($c_data->submissiondate, $data_count)){
                                    $data_count[$c_data->submissiondate] += 1;;
                                }
                                $result_data[$namadusun[$p_data->dusun]] = $data_count;
                            }
                        }
                    }
                }
            }elseif($table=="kartu_pnc_visit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kohort_bayi_kunjungan"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration LEFT JOIN kartu_ibu_registration ON kohort_bayi_registration.kiId=kartu_ibu_registration.kiId where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_anak_tutup"||$table=="kohort_bayi_immunization"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                    if(array_key_exists($c_data->submissiondate, $data_count)){
                                        $data_count[$c_data->submissiondate] += 1;;
                                    }
                                    $result_data[$namadusun[$p_data->dusun]] = $data_count;
                                }
                            }
                        }
                    }
                }
            }elseif($table=="kohort_kb_update"||$table=="kohort_kb_close"||$table=="kohort_kb_edit"||$table=="kohort_kb_pelayanan"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_kb_registration where kiId='$c_data->kiId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($desa="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM gen_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_gen_analytics, $table_default)){
                $tables[$table->Tables_in_gen_analytics]=$table_default[$table->Tables_in_gen_analytics];
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('location');
            $desa = $this->session->userdata('location');
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$desa=>$namadusun];
        }else{
            $username = $this->loc->getLocUserbyDesa('bidan',$desa);
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
                for($i=1;$i<=7;$i++){
                    $days     = 7-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 7)?"next Sunday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['thisweek'] = $day_temp;
                $day_temp = array();
                for($i=1;$i<=7;$i++){
                    $days     = 7-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 7)?"last Sunday ":"")."-".$days." days"));
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
            //query tha data
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by dusun, submissiondate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by dusun, submissiondate");
                }
                foreach ($query->result() as $datas){
                    if($mode=='Mingguan'){
                        if(array_key_exists($datas->dusun, $namadusun)){
                            $week   =   $result_data[$namadusun[$datas->dusun]];
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
                            $result_data[$namadusun[$datas->dusun]] = $week;
                        }
                    }elseif($mode=='Bulanan'){
                        if(array_key_exists($datas->dusun, $namadusun)){
                            $month = $result_data[$namadusun[$datas->dusun]];
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
                            $result_data[$namadusun[$datas->dusun]] = $month;
                        }
                    }
                }
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kohort_kb_pelayanan"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
                    foreach ($query2->result() as $c2_data){
                        if($mode=='Mingguan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $week   =   $result_data[$namadusun[$c2_data->dusun]];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data[$namadusun[$c2_data->dusun]] = $week;
                            }
                        }elseif($mode=='Bulanan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $month = $result_data[$namadusun[$c2_data->dusun]];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data[$namadusun[$c2_data->dusun]] = $month;
                            }
                        }
                    }
                }
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_anc_visit_labTest"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if($mode=='Mingguan'){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $week   =   $result_data[$namadusun[$p_data->dusun]];
                                    $thisweek   = $week['thisweek'];
                                    $lastweek   = $week['lastweek'];
                                    if(array_key_exists($c_data->submissiondate, $thisweek)){
                                        $thisweek[$c_data->submissiondate] +=1;
                                    }
                                    if(array_key_exists($c_data->submissiondate, $lastweek)){
                                        $lastweek[$c_data->submissiondate] +=1;
                                    }
                                    $week['thisweek'] = $thisweek;
                                    $week['lastweek'] = $lastweek;
                                    $result_data[$namadusun[$p_data->dusun]] = $week;
                                }
                            }elseif($mode=='Bulanan'){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $month = $result_data[$namadusun[$p_data->dusun]];
                                    $thisyear = $month['thisyear'];
                                    $lastyear = $month['lastyear'];
                                    $m = explode('-', $c_data->submissiondate);
                                    array_pop($m);
                                    $c_data->submissiondate = implode('-',$m);
                                    if(array_key_exists($c_data->submissiondate, $thisyear)){
                                        $thisyear[$c_data->submissiondate] +=1;
                                    }
                                    if(array_key_exists($c_data->submissiondate, $lastyear)){
                                        $lastyear[$c_data->submissiondate] +=1;
                                    }
                                    $month['thisyear'] = $thisyear;
                                    $month['lastyear'] = $lastyear;
                                    $result_data[$namadusun[$p_data->dusun]] = $month;
                                }
                            }
                        }
                    }
                }
            }elseif($table=="kartu_pnc_visit"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        if($mode=='Mingguan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $week   =   $result_data[$namadusun[$c2_data->dusun]];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data[$namadusun[$c2_data->dusun]] = $week;
                            }
                        }elseif($mode=='Bulanan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $month = $result_data[$namadusun[$c2_data->dusun]];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data[$namadusun[$c2_data->dusun]] = $month;
                            }
                        }
                    }
                }
            }elseif($table=="kohort_bayi_kunjungan"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration LEFT JOIN kartu_ibu_registration ON kohort_bayi_registration.kiId=kartu_ibu_registration.kiId where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($mode=='Mingguan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $week   =   $result_data[$namadusun[$c2_data->dusun]];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data[$namadusun[$c2_data->dusun]] = $week;
                            }
                        }elseif($mode=='Bulanan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $month = $result_data[$namadusun[$c2_data->dusun]];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data[$namadusun[$c2_data->dusun]] = $month;
                            }
                        }
                    }
                }
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_bayi_immunization"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if($mode=='Mingguan'){
                                    if(array_key_exists($p_data->dusun, $namadusun)){
                                        $week   =   $result_data[$namadusun[$p_data->dusun]];
                                        $thisweek   = $week['thisweek'];
                                        $lastweek   = $week['lastweek'];
                                        if(array_key_exists($c_data->submissiondate, $thisweek)){
                                            $thisweek[$c_data->submissiondate] +=1;
                                        }
                                        if(array_key_exists($c_data->submissiondate, $lastweek)){
                                            $lastweek[$c_data->submissiondate] +=1;
                                        }
                                        $week['thisweek'] = $thisweek;
                                        $week['lastweek'] = $lastweek;
                                        $result_data[$namadusun[$p_data->dusun]] = $week;
                                    }
                                }elseif($mode=='Bulanan'){
                                    if(array_key_exists($p_data->dusun, $namadusun)){
                                        $month = $result_data[$namadusun[$p_data->dusun]];
                                        $thisyear = $month['thisyear'];
                                        $lastyear = $month['lastyear'];
                                        $m = explode('-', $c_data->submissiondate);
                                        array_pop($m);
                                        $c_data->submissiondate = implode('-',$m);
                                        if(array_key_exists($c_data->submissiondate, $thisyear)){
                                            $thisyear[$c_data->submissiondate] +=1;
                                        }
                                        if(array_key_exists($c_data->submissiondate, $lastyear)){
                                            $lastyear[$c_data->submissiondate] +=1;
                                        }
                                        $month['thisyear'] = $thisyear;
                                        $month['lastyear'] = $lastyear;
                                        $result_data[$namadusun[$p_data->dusun]] = $month;
                                    }
                                }
                            }
                        }
                    }
                }
            }elseif($table=="kohort_kb_update"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_kb_registration where kiId='$c_data->kiId'");
                    foreach ($query2->result() as $c2_data){
                        if($mode=='Mingguan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $week   =   $result_data[$namadusun[$c2_data->dusun]];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data[$namadusun[$c2_data->dusun]] = $week;
                            }
                        }elseif($mode=='Bulanan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $month = $result_data[$namadusun[$c2_data->dusun]];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data[$namadusun[$c2_data->dusun]] = $month;
                            }
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
}