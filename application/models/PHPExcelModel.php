<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PHPExcelModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function createXLS($filename,$data){
        $file = APPPATH.$filename;
        $this->load->library('PHPExcell');
        //print_r($data);
        $fileObject = PHPExcel_IOFactory::load($file);
        
        $fileObject->setActiveSheetIndex(0);
        
        $fileObject->getActiveSheet()->setCellValue("H11", "200");
        
        
        $savedFileName = 'download.xlsx';
        
//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
//        header('Cache-Control: max-age=0'); 

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject);
        $saveContainer->save(APPPATH.'/download/'.$savedFileName);
        
    }
    private function readXLS($filePath){
        $file = APPPATH.$filePath;
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        $arr_data = array();
        
        //get only the Cell Collection
        $cell_collection = $fileObject->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $fileObject->getActiveSheet()->getCell($cell)->getColumn();
            $row = $fileObject->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $fileObject->getActiveSheet()->getCell($cell)->getValue();

            if ($row == 0) {
                continue;
            } else {
                $arr_data[$row-1][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['values'] = $arr_data;
        
        return $data;
    }
    
    
    
    public function showEntireData($filePath){
        $temp = $this->readXLS($filePath);
        
        echo '<pre>';
            print_r($temp);
        echo '</pre>';
    }
    
    public function getXLSData($filePath,$columnData){
        $temp = $this->readXLS($filePath);
        $xlabel = array();
        $yvalue = array();

        foreach($temp['values'] as $i => $data){
            if($i==0){
                continue;
            }
            $xlabel[$i] = $data['A'];
            $yvalue[$i] = isset($data[$columnData]) ? $data[$columnData]*100: 0;
        }
        
        $dataXLS['xlabel']=$xlabel;
        $dataXLS['yvalue']=$yvalue;
        
        return $dataXLS;
    }
    
}