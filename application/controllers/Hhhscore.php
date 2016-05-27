<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HHHScore extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    
    public function index(){
        
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/standarisasimainpage');
        $this->load->view('footer');
    }
    public function headscore(){
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/headscore');
        $this->load->view('footer');
    }
    public function bidanTrimester1(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri1.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='TDT1';
        $series['form']=$form;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri1.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='BBT1';
        $series['form']=$form;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/lila_tri1.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='LIKAT1';
        $series['form']=$form;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/pemeriksaan_hb_tri1.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='HBT1';
        $series['form']=$form;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/golongan_darah_tri1.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='GOLDART1';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester1",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester2(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri2.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='TDT2';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri2.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='BBT2';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/tfu_tri2.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='TFUT2';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/pres_janin_tri2.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='PJT2';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/djj_tri2.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='DJJT2';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester2",$dataXLS,false);
        $this->load->view("footer");
    }
    public function bidanTrimester3(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/tekanan_darah_tri3.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='TDT3';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/berat_badan_tri3.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='BBT3';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("hhhscore/hhhsidebar");
        $this->load->view("hhhscore/trimester3",$dataXLS,false);
        $this->load->view("footer");
    }
    public function standar(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/anc1_std_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='ANC1SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/anc1_nonstd_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='ANC1NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/anc4_std_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='ANC4SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/anc4_nonstd_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='ANC4NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/birth_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='BC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/pnc_cov.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='PNCC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/standar',$dataXLS);
        $this->load->view('footer');
    }
    public function heartscore(){
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/completeAnc_hrp.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='ANC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/completePnc_hrp.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='PNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/hb0_given.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='Hb';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/Homevisit.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='KPNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $temp = $this->PHPExcelModel->getXLSData('download/isi_rencana_persalinan.xls',array('B','C','D'));
        $real = $user;
        $expect = $user;
        foreach($temp['xlabel'] as $i => $data){
            $real[$user_village[$data]] += $temp['B'][$i];
            $expect[$user_village[$data]] += $temp['C'][$i];
            $form[$user_village[$data]]=$real[$user_village[$data]]*100/$expect[$user_village[$data]];
        }
        $series['page']='PRP';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view('header');
        $this->load->view('hhhscore/hhhsidebar');
        $this->load->view('hhhscore/heartscore',$dataXLS);
        $this->load->view('footer');
    }
    
}