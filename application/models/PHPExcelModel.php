<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PHPExcelModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function readXLS($filePath){
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

            if ($row == 1) {
                continue;
            } else {
                $arr_data[$row-1][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['values'] = $arr_data;
        
        return $data;
    }
    
   
    
}