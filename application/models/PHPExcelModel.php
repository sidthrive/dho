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
    
    public function createPwsXLS($filename,$data,$index){
        $file = APPPATH.$filename;
        $this->load->library('PHPExcell');
        //print_r($data);
        $fileObject = PHPExcel_IOFactory::load($file);
        $fileObject->setActiveSheetIndex(0);
        
        foreach ($data as $key1=>$cell){
            foreach ($cell as $key2=>$value){
                if(isset($index[$key1][$key2]))
                    if($value!=0||is_string($value)) $fileObject->getActiveSheet()->setCellValue($index[$key1][$key2], $value);
            }
        }
        $kec = explode(" ",$data['kecamatan'][0]);
        $kecamatan = end($kec);
        $prev = prev($kec);
        while(!(count($prev)==0||$prev==':')){
            $kecamatan = $prev.'_'.$kecamatan;
            $prev = prev($kec);
        }
        $bt = explode(" ",$data['bulan'][0]);
        $tahun = end($bt);
        $bulan = prev($bt);
        $savedFileName = 'PWS-'.strtoupper($data['form'][0]).'-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
    
    public function createNewPwsXLS($filename,$data,$index){
        $file = APPPATH.$filename;
        $this->load->library('PHPExcell');
        //print_r($data);
        $fileObject = PHPExcel_IOFactory::load($file);
        foreach ($data['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);
        
            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($index[$key1][$key2], $value);
                }
            }
        }
        
        $kec = explode(" ",$data['kecamatan'][0]);
        $kecamatan = end($kec);
        $prev = prev($kec);
        while(!(count($prev)==0||$prev==':')){
            $kecamatan = $prev.'_'.$kecamatan;
            $prev = prev($kec);
        }
        $bt = explode(" ",$data['bulan'][0]);
        $tahun = end($bt);
        $bulan = prev($bt);
        $savedFileName = 'PWS-'.strtoupper($data['form'][0]).'-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
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
    
    public function getXLSData($filePath,$columnData){
        $temp = $this->readXLS($filePath);
        $datas = array();
        $datas['xlabel'] = array();
        foreach ($columnData as $col){
            $datas[$col] = array();
        }

        foreach($temp['values'] as $i => $data){
            if($i==0){
                continue;
            }
            $datas['xlabel'][$i] = $data['A'];
            foreach ($columnData as $col){
                $datas[$col][$i] = isset($data[$col])?$data[$col]:0;
                
            }
        }
        $dataXLS['xlabel']=$datas['xlabel'];
        foreach ($columnData as $col){
            $dataXLS[$col] = $datas[$col];
        }
        
        return $dataXLS;
    }
    
    public function showEntireData($filePath){
        return $this->readXLS($filePath);
        
//        foreach ($temp as $i){
//            foreach($i as $j=>$datax){
//                if($j==0){
//                    continue;
//                }
//                echo $j.' ';
//                foreach($datax as $dummy){
//                    echo ' '.$dummy;
//                }
//                echo '<br/>';
//                
//            }
//            echo '<br/>';
//        }
    }
    
    public function showEntireData2($filePath){
        $temp = $this->readXLS($filePath);
        
        foreach ($temp as $i){
            foreach($i as $j=>$datax){
//                if($j==0){
//                    continue;
//                }
                echo $j.' ';
                foreach($datax as $dummy){
                    echo ' '.$dummy;
                }
                echo '<br/>';
                
            }
            echo '<br/>';
        }
    }
    
    public function getSheetName($filename){
        $file = APPPATH.$filename;
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        $fileObject->setActiveSheetIndex(0);
        return $fileObject->getSheetNames();
    }
    
    public function getCellRange($filepath,$range){
        $file = APPPATH.$filepath;
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        return $fileObject->getActiveSheet()->rangeToArray(
                    $range,
                NULL,
                TRUE,
                TRUE,
                TRUE
                );
    }
}