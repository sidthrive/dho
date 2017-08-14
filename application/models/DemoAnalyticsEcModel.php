<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DemoAnalyticsEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }
    
    public function getCountPerDayDrill($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
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
        
        $locId = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        if($range!=""){
            foreach ($locId as $user=>$desa){
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
            foreach ($locId as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }
        //exit;
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
        $table_default = $this->Table->getTable('bidan');
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
        
        $locId = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        if($range!=""){
            foreach ($locId as $user=>$desa){
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
            foreach ($locId as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = rand(10,30);
                }
                $result_data[$desa] = $data;
            }
        }
        
        
//        var_dump($result_data);
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('bidan');
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
        
        $locId = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($locId as $user=>$desa){
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
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"-")."-".$days." days"));
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
    
    public function downloadCountPerForm($kecamatan="",$start,$end,$old="no"){
        $start = new DateTime($start);
        $end = $end1 = new DateTime($end);
        $end = $end->modify('+1 day'); 
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval ,$end);
        
        $this->load->library('PHPExcell');
        
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        $table_name = $this->Table->getTableName('bidan');
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $locId = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($locId);
        
        $result_data = array();
        foreach ($locId as $user=>$desa){
            $data = array();
            foreach($daterange as $date){
                $data[$date->format("Y-m-d")] = array();
                foreach ($table_default as $table=>$legend){
                    $table_data = rand(10,30);
                    $data[$date->format("Y-m-d")][$legend] = $table_data;
                }
            }
            $result_data[$desa] = $data;
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
        
        $table_default = $this->Table->getTable('bidan');
        $table_name = $this->Table->getTableName('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                $tables[$table->Tables_in_analytics]=$table_default[$table->Tables_in_analytics];
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach($daterange as $date){
                $data[$date->format("Y-m-d")] = array();
                foreach ($table_default as $table=>$legend){
                    $table_data = rand(10,30);
                    $data[$date->format("Y-m-d")][$legend] = $table_data;
                }
            }
            $result_data[$desa] = $data;
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
            
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = rand(10,30);
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerFormByVisitDate($kecamatan="",$start,$end,$old="no"){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable('bidan');
        //retrieve the tables name
        $tables = array();
        
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = rand(10,30);
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
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
    
    public function getCountPerFormByVisitDateForDrill($desa="",$date=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                $tables[$table->Tables_in_analytics]=$table_default[$table->Tables_in_analytics];
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