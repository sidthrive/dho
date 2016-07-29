<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('laporan/laporansidebar');
        $this->load->view('laporan/laporanmainpage');
        $this->load->view('footer');
    }
    
    public function cakupanIndikatorPWS(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        $temp = $this->PHPExcelModel->getXLSData('download/k1_akses.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series1['page']='K1A';
        $series1['form']=$form;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $temp = $this->PHPExcelModel->getXLSData('download/k4.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series2['page']='K4';
        $series2['form']=$form;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $temp = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series3['page']='MT';
        $series3['form']=$form;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series4['page']='PDFK';
        $series4['form']=$form;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
       
        $temp = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series5['page']='PDTK';
        $series5['form']=$form;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series6['page']='KN';
        $series6['form']=$form;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series7['page']='KNN1';
        $series7['form']=$form;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
       
        $temp = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls',array('B','D','E'));
        $form = $user;
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['D'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series8['page']='KNN3';
        $series8['form']=$form;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series9['page']='KM';
//        $series9['form']=$form;
//        $series9['y_label']='persentase';
//        $series9['series_name']='persentase';
//        array_push($xlsForm, $series9);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series10['page']='KNN';
//        $series10['form']=$form;
//        $series10['y_label']='persentase';
//        $series10['series_name']='persentase';
//        array_push($xlsForm, $series10);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series11['page']='KB';
//        $series11['form']=$form;
//        $series11['y_label']='persentase';
//        $series11['series_name']='persentase';
//        array_push($xlsForm, $series11);
//       
//        $temp = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls',array('B','D','E'));
//        $form = $user;
//        $real = $user;
//        $expect = $user;
//        foreach($temp['xlabel'] as $i => $data){
//            $real[$user_village[$data]] += $temp['B'][$i];
//            $expect[$user_village[$data]] += $temp['D'][$i];
//            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
//        }
//        $series12['page']='KBLT';
//        $series12['form']=$form;
//        $series12['y_label']='persentase';
//        $series12['series_name']='persentase';
//        array_push($xlsForm, $series12);
       
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        if($this->session->userdata('level')=="fhw"){
            $this->load->view("laporan/fhw/downloadpwsbidan");
        }else{
            $this->load->view("laporan/downloadpwsbidan");
        }
        
        $this->load->view("footer");
    }
    
    public function statusGizi(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/statusgizi");
        $this->load->view("footer");
    }
    
    public function downloadGiziPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsgizi");
        $this->load->view("footer");
    }
    
    public function downloadJurimPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsjurim");
        $this->load->view("footer");
    }
    
    public function download(){
        if($this->session->userdata('level')=="fhw"){
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');
            $this->download_fhw($year,$month,$form);
        }else{
            $this->load->model('PHPExcelModel');
            $this->load->model('PWSModel');

            $kec    = $this->input->post('kecamatan');
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $form   = $this->input->post('formtype');

            if($form=="KIA1"){
                $this->PWSModel->kia1($kec,$year,$month,$form);
            }elseif($form=="KIA2"){
                $this->PWSModel->kia2($kec,$year,$month,$form);
            }elseif($form=="KIA3"){
                $this->PWSModel->kia3($kec,$year,$month,$form);
            }elseif($form=="KIA4"){
                $this->PWSModel->kia4($kec,$year,$month,$form);
            }elseif($form=="KIA5"){
                $this->PWSModel->kia5($kec,$year,$month,$form);
            }elseif(strpos($form,'bayi')!==false){
                $this->PWSModel->bayi($kec, $year, $month, $form);
            }elseif(strpos($form,'balita')!==false){
                $this->PWSModel->balita($kec, $year, $month, $form);
            }elseif($form=="neonatal1"){
                $this->PWSModel->neonatal1($kec,$year,$month,$form);
            }elseif($form=="neonatal2"){
                $this->PWSModel->neonatal2($kec,$year,$month,$form);
            }elseif($form=="neonatal3"){
                $this->PWSModel->neonatal3($kec,$year,$month,$form);
            }elseif($form=="neonatal4"){
                $this->PWSModel->neonatal4($kec,$year,$month,$form);
            }elseif($form=="neonatal5"){
                $this->PWSModel->neonatal5($kec,$year,$month,$form);
            }elseif($form=="kb1"){
                $this->PWSModel->kb1($kec,$year,$month,$form);
            }elseif($form=="kb2"){
                $this->PWSModel->kb2($kec,$year,$month,$form);
            }elseif($form=="kb3"){
                $this->PWSModel->kb3($kec,$year,$month,$form);
            }elseif($form=="kb4"){
                $this->PWSModel->kb4($kec,$year,$month,$form);
            }elseif($form=="kb5"){
                $this->PWSModel->kb5($kec,$year,$month,$form);
            }elseif($form=="amp"){
                $this->PWSModel->maternal($kec,$year,$month,$form);
            }elseif($form=="akb"){
                $this->PWSModel->akb($kec,$year,$month,$form);
            }elseif($form=="kih"){
                $this->PWSModel->kih($kec,$year,$month,$form);
            }elseif($form=="p4k"){
                $this->PWSModel->p4k($kec,$year,$month,$form);
            }
        }
    }
    
    private function download_fhw($year,$month,$form){
        $user = $this->session->userdata('username');
        $this->load->model('PHPExcelModel');
        $this->load->model('PWSFhwModel');
        if($form=="KIA1"){
            $this->PWSFhwModel->kia1($user,$year,$month,$form);
        }elseif($form=="KIA2"){
            $this->PWSFhwModel->kia2($user,$year,$month,$form);
        }elseif($form=="KIA3"){
            $this->PWSFhwModel->kia3($user,$year,$month,$form);
        }elseif($form=="KIA4"){
            $this->PWSFhwModel->kia4($user,$year,$month,$form);
        }elseif($form=="KIA5"){
            $this->PWSFhwModel->kia5($user,$year,$month,$form);
        }elseif(strpos($form,'bayi')!==false){
            $this->PWSFhwModel->bayi($user, $year, $month, $form);
        }elseif(strpos($form,'balita')!==false){
            $this->PWSFhwModel->balita($user, $year, $month, $form);
        }elseif(strpos($form,'anak')!==false){
            $this->PWSFhwModel->anak($user, $year, $month, $form);
        }elseif($form=="neonatal1"){
            $this->PWSFhwModel->neonatal1($user,$year,$month,$form);
        }elseif($form=="neonatal2"){
            $this->PWSFhwModel->neonatal2($user,$year,$month,$form);
        }elseif($form=="neonatal3"){
            $this->PWSFhwModel->neonatal3($user,$year,$month,$form);
        }elseif($form=="neonatal4"){
            $this->PWSFhwModel->neonatal4($user,$year,$month,$form);
        }elseif($form=="neonatal5"){
            $this->PWSFhwModel->neonatal5($user,$year,$month,$form);
        }elseif($form=="kb1"){
            $this->PWSFhwModel->kb1($user,$year,$month,$form);
        }elseif($form=="kb2"){
            $this->PWSFhwModel->kb2($user,$year,$month,$form);
        }elseif($form=="kb3"){
            $this->PWSFhwModel->kb3($user,$year,$month,$form);
        }elseif($form=="kb4"){
            $this->PWSFhwModel->kb4($user,$year,$month,$form);
        }elseif($form=="kb5"){
            $this->PWSFhwModel->kb5($user,$year,$month,$form);
        }elseif($form=="amp"){
            $this->PWSFhwModel->maternal($user,$year,$month,$form);
        }elseif($form=="akb"){
            $this->PWSFhwModel->akb($user,$year,$month,$form);
        }elseif($form=="kih"){
            $this->PWSFhwModel->kih($user,$year,$month,$form);
        }elseif($form=="p4k"){
            $this->PWSFhwModel->p4k($user,$year,$month,$form);
        }
    }
}