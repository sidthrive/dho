<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataentryModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->library('couchdb');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $startdate = (float)(strtotime($start)."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        $users = $this->loc->getLocUser('bidan',$kecamatan);
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value->formName, $table_default)){
                    $result_data[$users[$user]][$table_default[$d->value->formName]]++;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerDayDrill($kecamatan="",$mode="",$range=""){
        $end = date("Y-m-d",  strtotime($range[1]." +1 day"));
        
        $startdate = (float)(strtotime($range[0])."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $table_default = $this->Table->getTable('bidan');
        $users = $this->loc->getLocUser('bidan',$kecamatan);
        $result_data = array();
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
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value->formName, $table_default)){
                    $result_data[$users[$user]][$d->key[1]]++;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $end = date("Y-m-d",  strtotime($date." +1 day"));
        $startdate = (float)(strtotime($date)."000");
        $enddate = (float)(strtotime(date($end))."000");
        $table_default = $this->Table->getTable('bidan');
        $tabindex = $this->Table->getTableIndex('bidan');
        $users = $this->loc->getLocUserAndDesabyDesa('bidan',str_replace('_',' ',$desa));
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
        
        foreach ($users as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value->formName, $table_default)){
                    $result_data[$date]["data"][$tabindex[$d->value->formName]][1]++;
                }
            }
        }
        
        return $result_data;
    }
    
    public function downloadCountPerForm($kecamatan="",$start,$end){
        $start1 = new DateTime($start);
        $end1 = new DateTime($end);
        $end1 = $end1->modify('+1 day'); 
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start1, $interval ,$end1);
        
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        
        $startdate = (float)(strtotime($start)."000");
        $enddate = (float)(strtotime(date($end))."000");
        
        $this->load->library('PHPExcell');
        
        $table_default = $this->Table->getTable('bidan');
        $table_name = $this->Table->getTableName('bidan');
        
        $locId = $this->loc->getLocUser('bidan',$kecamatan);$location = $this->loc->getLocUserQuery($locId);
        
        $result_data = array();
        foreach ($locId as $user=>$desa){
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
        
        foreach ($locId as $user=>$desa){
            $data = $this->couchdb->startkey([$user,$startdate])->endkey([$user,$enddate])->getView('FormSubmission','formSubmission_by_anm_and_client_version');
            foreach ($data->rows as $d){
                $d->key[1] = date("Y-m-d",  substr($d->key[1], 0, 10));
                if(array_key_exists($d->value->formName, $table_default)){
                    $result_data[$locId[$user]][$d->key[1]][$table_default[$d->value->formName]]++;
                }
            }
        }
        
        
        $fileObject = new PHPExcel();
        $sheetIndex = $fileObject->getIndex(
            $fileObject->getSheetByName('Worksheet')
        );
        $fileObject->removeSheetByIndex($sheetIndex);
        $index = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];
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
}