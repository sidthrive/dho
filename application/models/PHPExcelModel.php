<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PHPExcelModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function createXLS($filename){
        $file = APPPATH.$filename;
        $this->load->library('PHPExcell');
        //print_r($data);
        $fileObject = PHPExcel_IOFactory::load($file);
        
        $fileObject->setActiveSheetIndex(0);
        
        $fileObject->getActiveSheet()->setCellValue("H11", "200");
       
        $savedFileName = 'download PWS.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0'); 

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
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
        
        foreach ($temp as $i){
            foreach($i as $j=>$datax){
                if($j==0){
                    continue;
                }
                echo $j.' ';
                foreach($datax as $dummy){
                    echo ' '.$dummy;
                }
                echo '<br/>';
                
            }
            echo '<br/>';
        }
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