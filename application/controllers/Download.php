<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
	public function index()
	{

	}

	public function headscore($id){
		$this->load->library('PHPExcell');
		$this->load->model('UjianModel');
		$hasil = $this->UjianModel->getReport($id);
		// var_dump($hasil);
		// var_dump($hasil['soal']);
		// var_dump($hasil['jawaban']);exit;

		$fileObject = new PHPExcel();
		$sheetIndex = $fileObject->getIndex(
            $fileObject->getSheetByName('Worksheet')
        );
        $fileObject->removeSheetByIndex($sheetIndex);

        foreach($hasil['soal'] as $x=>$soal){
        	$jawaban = $hasil['jawaban'][$x];
        	$sesi = "Sesi ".($x+1);

        	$myWorkSheet = new PHPExcel_Worksheet($fileObject, $sesi);
	        $fileObject->addSheet($myWorkSheet);
	        $fileObject->setActiveSheetIndexByName($sesi);

	        $fileObject->getActiveSheet()->setCellValue('A1', 'ID SOAL');
	        $fileObject->getActiveSheet()->getColumnDimension('A')->setWidth(7);
	        $fileObject->getActiveSheet()->setCellValue('B1', 'KATEGORI');
	        $fileObject->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	        $fileObject->getActiveSheet()->setCellValue('C1', 'PERTANYAAN');
	        $fileObject->getActiveSheet()->getColumnDimension('C')->setWidth(71);
	        $fileObject->getActiveSheet()->setCellValue('D1', 'PILIHAN A');
	        $fileObject->getActiveSheet()->getColumnDimension('D')->setWidth(17);
	        $fileObject->getActiveSheet()->setCellValue('E1', 'PILIHAN B');
	        $fileObject->getActiveSheet()->getColumnDimension('E')->setWidth(17);
	        $fileObject->getActiveSheet()->setCellValue('F1', 'PILIHAN C');
	        $fileObject->getActiveSheet()->getColumnDimension('F')->setWidth(17);
	        $fileObject->getActiveSheet()->setCellValue('G1', 'PILIHAN D');
	        $fileObject->getActiveSheet()->getColumnDimension('G')->setWidth(17);
	        $fileObject->getActiveSheet()->setCellValue('H1', 'PILIHAN E');
	        $fileObject->getActiveSheet()->getColumnDimension('H')->setWidth(17);
	        $fileObject->getActiveSheet()->setCellValue('I1', 'KUNCI');
	        $fileObject->getActiveSheet()->getColumnDimension('I')->setWidth(6);
	        $fileObject->getActiveSheet()->setCellValue('J1', 'LEVEL OF IMPORTANCE');
	        $fileObject->getActiveSheet()->getColumnDimension('J')->setWidth(6);
	        $fileObject->getActiveSheet()->setCellValue('K1', 'LEVEL');
	        $fileObject->getActiveSheet()->getColumnDimension('K')->setWidth(7);
	        $fileObject->getActiveSheet()->setCellValue('L1', 'JAWABAN');
	        $fileObject->getActiveSheet()->getColumnDimension('L')->setWidth(9);

	        $row = 2;
	        $index = ['A','B','C','D','E','F','G','H','I','J','K','L'];
	        foreach ($soal as $y=>$p) {
	        	$fileObject->getActiveSheet()->setCellValue('A'.$row, $p->id);
		        $fileObject->getActiveSheet()->setCellValue('B'.$row, $p->kategori);
		        $fileObject->getActiveSheet()->setCellValue('C'.$row, $p->pertanyaan);
		        $fileObject->getActiveSheet()->setCellValue('D'.$row, $p->pilihan_a);
		        $fileObject->getActiveSheet()->setCellValue('E'.$row, $p->pilihan_b);
		        $fileObject->getActiveSheet()->setCellValue('F'.$row, $p->pilihan_c);
		        $fileObject->getActiveSheet()->setCellValue('G'.$row, $p->pilihan_d);
		        $fileObject->getActiveSheet()->setCellValue('H'.$row, $p->pilihan_e);
		        $fileObject->getActiveSheet()->setCellValue('I'.$row, $p->jawaban);
		        $fileObject->getActiveSheet()->setCellValue('J'.$row, $p->level_of_importance);
		        $fileObject->getActiveSheet()->setCellValue('K'.$row, $p->level);
		        $fileObject->getActiveSheet()->setCellValue('L'.$row, $jawaban[$y]->jawaban);
		        $row++;
	        }

	        $fileObject->getActiveSheet()->getStyle('C1:C'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	        $fileObject->getActiveSheet()->getStyle('D1:D'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	        $fileObject->getActiveSheet()->getStyle('E1:E'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	        $fileObject->getActiveSheet()->getStyle('F1:F'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	        $fileObject->getActiveSheet()->getStyle('G1:G'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	        $fileObject->getActiveSheet()->getStyle('H1:H'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	        $fileObject->getActiveSheet()->getStyle('A1:L'.$fileObject->getActiveSheet()->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        }

        


        $savedFileName = 'Bidan Standarisasi_'.strtoupper($hasil['user']->nama_lengkap).'_'.strtoupper($hasil['tes']->tanggal_tes).'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
	}

}
