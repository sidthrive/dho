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
        $temp1 = $this->PHPExcelModel->getXLSData('download/k1_akses.xls','E');
        $form1 = $user;
        foreach($temp1['xlabel'] as $i => $data){
            $form1[$user_village[$data]]+=$temp1['yvalue'][$i];
        }
        $series1['page']='K1A';
        $series1['form']=$form1;
        $series1['y_label']='persentase';
        $series1['series_name']='persentase';
        array_push($xlsForm, $series1);
       
        $temp2 = $this->PHPExcelModel->getXLSData('download/k4.xls','E');
        $form2 = $user;
        foreach($temp2['xlabel'] as $i => $data){
            $form2[$user_village[$data]]+=$temp2['yvalue'][$i];
        }
        $series2['page']='K4';
        $series2['form']=$form2;
        $series2['y_label']='persentase';
        $series2['series_name']='persentase';
        array_push($xlsForm, $series2);
       
        $temp3 = $this->PHPExcelModel->getXLSData('download/maternal_tertangani.xls','E');
        $form3 = $user;
        foreach($temp3['xlabel'] as $i => $data){
            $form3[$user_village[$data]]+=$temp3['yvalue'][$i];
        }
        $series3['page']='MT';
        $series3['form']=$form3;
        $series3['y_label']='persentase';
        $series3['series_name']='persentase';
        array_push($xlsForm, $series3);
       
        $temp4 = $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls','E');
        $form4 = $user;
        foreach($temp4['xlabel'] as $i => $data){
            $form4[$user_village[$data]]+=$temp4['yvalue'][$i];
        }
        $series4['page']='PDFK';
        $series4['form']=$form4;
        $series4['y_label']='persentase';
        $series4['series_name']='persentase';
        array_push($xlsForm, $series4);
       
        $temp5 = $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls','E');
        $form5 = $user;
        foreach($temp5['xlabel'] as $i => $data){
            $form5[$user_village[$data]]+=$temp5['yvalue'][$i];
        }
        $series5['page']='PDTK';
        $series5['form']=$form5;
        $series5['y_label']='persentase';
        $series5['series_name']='persentase';
        array_push($xlsForm, $series5);
       
        $temp6 = $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls','E');
        $form6 = $user;
        foreach($temp6['xlabel'] as $i => $data){
            $form6[$user_village[$data]]+=$temp6['yvalue'][$i];
        }
        $series6['page']='KN';
        $series6['form']=$form6;
        $series6['y_label']='persentase';
        $series6['series_name']='persentase';
        array_push($xlsForm, $series6);
       
        $temp7 = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls','E');
        $form7 = $user;
        foreach($temp7['xlabel'] as $i => $data){
            $form7[$user_village[$data]]+=$temp7['yvalue'][$i];
        }
        $series7['page']='KNN1';
        $series7['form']=$form7;
        $series7['y_label']='persentase';
        $series7['series_name']='persentase';
        array_push($xlsForm, $series7);
       
        $temp8 = $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls','E');
        $form8 = $user;
        foreach($temp8['xlabel'] as $i => $data){
            $form8[$user_village[$data]]+=$temp8['yvalue'][$i];
        }
        $series8['page']='KNN3';
        $series8['form']=$form8;
        $series8['y_label']='persentase';
        $series8['series_name']='persentase';
        array_push($xlsForm, $series8);
       
        $temp9 = $this->PHPExcelModel->getXLSData('download/kematian_maternal.xls','C');
        $form9 = array();
        foreach($temp9['xlabel'] as $i => $data){
            $form9[$data]=$temp9['yvalue'][$i];
        }
        $series9['page']='KM';
        $series9['form']=$form9;
        $series9['y_label']='persentase';
        $series9['series_name']='persentase';
        array_push($xlsForm, $series9);
       
        $temp10 = $this->PHPExcelModel->getXLSData('download/kematian_neonatal.xls','C');
        $form10 = array();
        foreach($temp10['xlabel'] as $i => $data){
            $form10[$data]=$temp10['yvalue'][$i];
        }
        $series10['page']='KNN';
        $series10['form']=$form10;
        $series10['y_label']='persentase';
        $series10['series_name']='persentase';
        array_push($xlsForm, $series10);
       
        $temp11 = $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls','C');
        $form11 = array();
        foreach($temp11['xlabel'] as $i => $data){
            $form11[$data]=$temp11['yvalue'][$i];
        }
        $series11['page']='KB';
        $series11['form']=$form11;
        $series11['y_label']='persentase';
        $series11['series_name']='persentase';
        array_push($xlsForm, $series11);
       
        $temp12 = $this->PHPExcelModel->getXLSData('download/kematian_balita.xls','C');
        $form12 = array();
        foreach($temp12['xlabel'] as $i => $data){
            $form12[$data]=$temp12['yvalue'][$i];
        }
        $series12['page']='KBLT';
        $series12['form']=$form12;
        $series12['y_label']='persentase';
        $series12['series_name']='persentase';
        array_push($xlsForm, $series12);
       
        $dataXLS['xlsForm']=$xlsForm;
        
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/pws",$dataXLS,false);
        $this->load->view("footer");
    }
    
    public function downloadBidanPWS(){
        $this->load->view("header");
        $this->load->view("laporan/laporansidebar");
        $this->load->view("laporan/downloadpwsbidan");
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
        $this->load->model('PHPExcelModel');
        
        $kec    = $this->input->post('kecamatan');
        $year   = $this->input->post('year');
        $month  = $this->input->post('month');
        $form   = $this->input->post('formtype');
        
        if($form=="KIA1"){
            $this->kia1($kec,$year,$month,$form);
        }elseif($form=="KIA2"){
            $this->kia2($kec,$year,$month,$form);
        }elseif($form=="KIA3"){
            $this->kia3($kec,$year,$month,$form);
        }elseif($form=="KIA4"){
            $this->kia4($kec,$year,$month,$form);
        }elseif($form=="KIA5"){
            $this->kia5($kec,$year,$month,$form);
        }
    }
    
    private function kia1($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['cakupan_k1_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_k1_bulan_ini'] = [0,0,0,0,0,0];
        $result['cakupan_k4_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_k4_bulan_ini'] = [0,0,0,0,0,0];
        $result['cakupan_resiko_bulan_lalu'] = [0,0,0,0,0,0];
        $result['cakupan_resiko_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['cakupan_k1_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['cakupan_k1_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['cakupan_k4_bulan_lalu']=['L11','L12','L13','L14','L15','L16'];
        $result_index['cakupan_k4_bulan_ini']=['M11','M12','M13','M14','M15','M16'];
        $result_index['cakupan_resiko_bulan_lalu']=['Q11','Q12','Q13','Q14','Q15','Q16'];
        $result_index['cakupan_resiko_bulan_ini']=['R11','R12','R13','R14','R15','R16'];
        
        $datak1 = $this->PHPExcelModel->getCellRange('download/kia1/cakupan_k1'.$namefile,'A2:E8');
        $datak4 = $this->PHPExcelModel->getCellRange('download/kia1/cakupan_k4'.$namefile,'A2:E8');
        $dataresiko = $this->PHPExcelModel->getCellRange('download/kia1/cakupan_resiko'.$namefile,'A2:E8');
        
        foreach ($datak1 as $k1){
            if(array_search($k1['C'],$result['desa'])>=0){
                $key=array_search($k1['C'],$result['desa']);
                $result['cakupan_k1_bulan_lalu'][$key] += (int)$k1['B'];
                $result['cakupan_k1_bulan_ini'][$key] += (int)$k1['E'];
            }
        }
        foreach ($datak4 as $k4){
            if(array_search($k4['C'],$result['desa'])>=0){
                $key=array_search($k4['C'],$result['desa']);
                $result['cakupan_k4_bulan_lalu'][$key] += (int)$k4['B'];
                $result['cakupan_k4_bulan_ini'][$key] += (int)$k4['E'];
            }
        }
        foreach ($dataresiko as $resiko){
            if(array_search($resiko['C'],$result['desa'])>=0){
                $key=array_search($resiko['C'],$result['desa']);
                $result['cakupan_resiko_bulan_lalu'][$key] += (int)$resiko['B'];
                $result['cakupan_resiko_bulan_ini'][$key] += (int)$resiko['E'];
            }
        }
        $this->PHPExcelModel->createPwsXLS("download/kia1/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    private function kia2($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['komplikasi_bulan_lalu'] = [0,0,0,0,0,0];
        $result['komplikasi_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['komplikasi_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['komplikasi_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        
        $datakomplikasi = $this->PHPExcelModel->getCellRange('download/kia2/cakupan_komplikasi'.$namefile,'A2:E8');
        
        foreach ($datakomplikasi as $komplikasi){
            if(array_search($komplikasi['C'],$result['desa'])>=0){
                $key=array_search($komplikasi['C'],$result['desa']);
                $result['komplikasi_bulan_lalu'][$key] += (int)$komplikasi['B'];
                $result['komplikasi_bulan_ini'][$key] += (int)$komplikasi['E'];
            }
        }
        $this->PHPExcelModel->createPwsXLS("download/kia2/template_pws_ibu2.xlsx",$result,$result_index);
    }
    
    private function kia3($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['linakes_L_bulan_lalu'] = [0,0,0,0,0,0];
        $result['linakes_P_bulan_lalu'] = [0,0,0,0,0,0];
        $result['linakes_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['linakes_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['nolinakes_L_bulan_lalu'] = [0,0,0,0,0,0];
        $result['nolinakes_P_bulan_lalu'] = [0,0,0,0,0,0];
        $result['nolinakes_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['nolinakes_P_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['linakes_L_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['linakes_P_bulan_lalu']=['H11','H12','H13','H14','H15','H16'];
        $result_index['linakes_L_bulan_ini']=['J11','J12','J13','J14','J15','J16'];
        $result_index['linakes_P_bulan_ini']=['K11','K12','K13','K14','K15','K16'];
        $result_index['nolinakes_L_bulan_lalu']=['P11','P12','P13','P14','P15','P16'];
        $result_index['nolinakes_P_bulan_lalu']=['Q11','Q12','Q13','Q14','Q15','Q16'];
        $result_index['nolinakes_L_bulan_ini']=['S11','S12','S13','S14','S15','S16'];
        $result_index['nolinakes_P_bulan_ini']=['T11','T12','T13','T14','T15','T16'];
        
        $datalinakes = $this->PHPExcelModel->getCellRange('download/kia3/cakupan_linakes'.$namefile,'A2:G8');
        $datanolinakes = $this->PHPExcelModel->getCellRange('download/kia3/cakupan_nolinakes'.$namefile,'A2:G8');
        
        foreach ($datalinakes as $linakes){
            if(array_search($linakes['C'],$result['desa'])>=0){
                $key=array_search($linakes['C'],$result['desa']);
                $result['linakes_L_bulan_lalu'][$key] += (int)$linakes['B'];
                $result['linakes_P_bulan_lalu'][$key] += (int)$linakes['F'];
                $result['linakes_L_bulan_ini'][$key] += (int)$linakes['E'];
                $result['linakes_L_bulan_ini'][$key] += (int)$linakes['G'];
            }
        }
        foreach ($datanolinakes as $nolinakes){
            if(array_search($nolinakes['C'],$result['desa'])>=0){
                $key=array_search($nolinakes['C'],$result['desa']);
                $result['nolinakes_L_bulan_lalu'][$key] += (int)$nolinakes['B'];
                $result['nolinakes_P_bulan_lalu'][$key] += (int)$nolinakes['F'];
                $result['nolinakes_L_bulan_ini'][$key] += (int)$nolinakes['E'];
                $result['nolinakes_L_bulan_ini'][$key] += (int)$nolinakes['G'];
            }
        }
        $this->PHPExcelModel->createPwsXLS("download/kia3/template_pws_ibu3.xlsx",$result,$result_index);
    }
    
    private function kia4($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['fasilitas_bulan_lalu'] = [0,0,0,0,0,0];
        $result['fasilitas_bulan_ini'] = [0,0,0,0,0,0];
        $result['k_nifas_bulan_lalu'] = [0,0,0,0,0,0];
        $result['k_nifas_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['fasilitas_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['fasilitas_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['k_nifas_bulan_lalu']=['L11','L12','L13','L14','L15','L16'];
        $result_index['k_nifas_bulan_ini']=['M11','M12','M13','M14','M15','M16'];
        
        $datafasilitas = $this->PHPExcelModel->getCellRange('download/kia4/cakupan_fasilkes'.$namefile,'A2:E8');
        $datanifas = $this->PHPExcelModel->getCellRange('download/kia4/cakupan_k_nifas'.$namefile,'A2:E8');
        
        foreach ($datafasilitas as $fasilitas){
            if(array_search($fasilitas['C'],$result['desa'])>=0){
                $key=array_search($fasilitas['C'],$result['desa']);
                $result['fasilitas_bulan_lalu'][$key] += (int)$fasilitas['B'];
                $result['fasilitas_bulan_ini'][$key] += (int)$fasilitas['E'];
            }
        }
        foreach ($datanifas as $nifas){
            if(array_search($nifas['C'],$result['desa'])>=0){
                $key=array_search($nifas['C'],$result['desa']);
                $result['k_nifas_bulan_lalu'][$key] += (int)$nifas['B'];
                $result['k_nifas_bulan_ini'][$key] += (int)$nifas['E'];
            }
        }
        $this->PHPExcelModel->createPwsXLS("download/kia4/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    private function kia5($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
        }
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['anemia_bulan_lalu'] = [0,0,0,0,0,0];
        $result['anemia_bulan_ini'] = [0,0,0,0,0,0];
        $result['kek_bulan_lalu'] = [0,0,0,0,0,0];
        $result['kek_bulan_ini'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B11','B12','B13','B14','B15','B16'];
        $result_index['anemia_bulan_lalu']=['G11','G12','G13','G14','G15','G16'];
        $result_index['anemia_bulan_ini']=['H11','H12','H13','H14','H15','H16'];
        $result_index['kek_bulan_lalu']=['K11','K12','K13','K14','K15','K16'];
        $result_index['kek_bulan_ini']=['L11','L12','L13','L14','L15','L16'];
        
        $dataanemia = $this->PHPExcelModel->getCellRange('download/kia5/cakupan_bumil_anemia'.$namefile,'A2:E8');
        $datakek = $this->PHPExcelModel->getCellRange('download/kia5/cakupan_bumil_kek'.$namefile,'A2:E8');
        
        foreach ($dataanemia as $anemia){
            if(array_search($anemia['C'],$result['desa'])>=0){
                $key=array_search($anemia['C'],$result['desa']);
                $result['anemia_bulan_lalu'][$key] += (int)$anemia['B'];
                $result['anemia_bulan_ini'][$key] += (int)$anemia['E'];
            }
        }
        foreach ($datakek as $kek){
            if(array_search($kek['C'],$result['desa'])>=0){
                $key=array_search($kek['C'],$result['desa']);
                $result['kek_bulan_lalu'][$key] += (int)$kek['B'];
                $result['kek_bulan_ini'][$key] += (int)$kek['E'];
            }
        }
        $this->PHPExcelModel->createPwsXLS("download/kia5/template_pws_ibu5.xlsx",$result,$result_index);
    }
}