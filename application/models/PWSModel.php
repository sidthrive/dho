<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PWSModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function kia1($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $result['bumil']  =  [101,221,230,259,199,217];
            $result['bulin']  =  [97,211,220,247,190,207];
            $result['bufas']  =  [97,211,220,247,190,207];
            $namefile .= "_".$month."_".$kec.".xls";
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $result['bumil']  =  [224,72,81,85,169,199];
            $result['bulin']  =  [214,69,78,81,161,190];
            $result['bufas']  =  [214,69,78,81,161,190];
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
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        try{
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
        } catch (Exception $ex) {
            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
            //redirect("laporan/downloadbidanpws");
        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    public function kia2($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [101,221,230,259,199,217];
            $result['bulin']  =  [97,211,220,247,190,207];
            $result['bufas']  =  [97,211,220,247,190,207];
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [224,72,81,85,169,199];
            $result['bulin']  =  [214,69,78,81,161,190];
            $result['bufas']  =  [214,69,78,81,161,190];
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
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        try {
            $datakomplikasi = $this->PHPExcelModel->getCellRange('download/kia2/cakupan_komplikasi'.$namefile,'A2:E8');
        
            foreach ($datakomplikasi as $komplikasi){
                if(array_search($komplikasi['C'],$result['desa'])>=0){
                    $key=array_search($komplikasi['C'],$result['desa']);
                    $result['komplikasi_bulan_lalu'][$key] += (int)$komplikasi['B'];
                    $result['komplikasi_bulan_ini'][$key] += (int)$komplikasi['E'];
                }
            }
        } catch (Exception $ex) {
            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
            //redirect("laporan/downloadbidanpws");
        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu2.xlsx",$result,$result_index);
    }
    
    public function kia3($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [101,221,230,259,199,217];
            $result['bulin']  =  [97,211,220,247,190,207];
            $result['bufas']  =  [97,211,220,247,190,207];
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [224,72,81,85,169,199];
            $result['bulin']  =  [214,69,78,81,161,190];
            $result['bufas']  =  [214,69,78,81,161,190];
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
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        try {
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
        } catch (Exception $ex) {
            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
            //redirect("laporan/downloadbidanpws");
        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu3.xlsx",$result,$result_index);
    }
    
    public function kia4($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [101,221,230,259,199,217];
            $result['bulin']  =  [97,211,220,247,190,207];
            $result['bufas']  =  [97,211,220,247,190,207];
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [224,72,81,85,169,199];
            $result['bulin']  =  [214,69,78,81,161,190];
            $result['bufas']  =  [214,69,78,81,161,190];
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
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        try{
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
        } catch (Exception $ex) {
            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
            //redirect("laporan/downloadbidanpws");
        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    public function kia5($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($kec=='janapria'){
            $user   =  ['Lekor','Saba','Pendem','Setuta','Jango','Janapria'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [101,221,230,259,199,217];
            $result['bulin']  =  [97,211,220,247,190,207];
            $result['bufas']  =  [97,211,220,247,190,207];
        }else{
            $user   =  ['Ketara','Sengkol','Kawo','Tanak Awu','Pengembur','Segala Anyar'];
            $namefile .= "_".$month."_".$kec.".xls";
            $result['bumil']  =  [224,72,81,85,169,199];
            $result['bulin']  =  [214,69,78,81,161,190];
            $result['bufas']  =  [214,69,78,81,161,190];
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
        $result_index['bumil'] = ['C11','C12','C13','C14','C15','C16'];
        $result_index['bulin'] = ['D11','D12','D13','D14','D15','D16'];
        $result_index['bufas'] = ['E11','E12','E13','E14','E15','E16'];
        
        try{
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
        } catch (Exception $ex) {
            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
            //redirect("laporan/downloadbidanpws");
        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu5.xlsx",$result,$result_index);
    }
    
    public function bayi($kec,$year,$month,$form){
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
        $result['kasus1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus1_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_P_komulatif'] = [0,0,0,0,0,0];
        
        $result['kasus2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus2_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_P_komulatif'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B12','B13','B14','B15','B16','B17'];
        $result_index['kasus1_L_bulan_ini']=['C12','C13','C14','C15','C16','C17'];
        $result_index['kasus1_P_bulan_ini']=['D12','D13','D14','D15','D16','D17'];
        $result_index['kasus1_L_komulatif']=['F12','F13','F14','F15','F16','F17'];
        $result_index['kasus1_P_komulatif']=['G12','G13','G14','G15','G16','G17'];
        $result_index['mati1_L_bulan_ini']=['I12','I13','I14','I15','I16','I17'];
        $result_index['mati1_P_bulan_ini']=['J12','J13','J14','J15','J16','J17'];
        $result_index['mati1_L_komulatif']=['L12','L13','L14','L15','L16','L17'];
        $result_index['mati1_P_komulatif']=['M12','M13','M14','M15','M16','M17'];
        
        $result_index['kasus2_L_bulan_ini']=['O12','O13','O14','O15','O16','O17'];
        $result_index['kasus2_P_bulan_ini']=['P12','P13','P14','P15','P16','P17'];
        $result_index['kasus2_L_komulatif']=['R12','R13','R14','R15','R16','R17'];
        $result_index['kasus2_P_komulatif']=['S12','S13','S14','S15','S16','S17'];
        $result_index['mati2_L_bulan_ini']=['U12','U13','U14','U15','U16','U17'];
        $result_index['mati2_P_bulan_ini']=['V12','V13','V14','V15','V16','V17'];
        $result_index['mati2_L_komulatif']=['X12','X13','X14','X15','X16','X17'];
        $result_index['mati2_P_komulatif']=['Y12','Y13','Y14','Y15','Y16','Y17'];
        
//        try{
//            $dataanemia = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_anemia'.$namefile,'A2:E8');
//            $datakek = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_kek'.$namefile,'A2:E8');
//
//            foreach ($dataanemia as $anemia){
//                if(array_search($anemia['C'],$result['desa'])>=0){
//                    $key=array_search($anemia['C'],$result['desa']);
//                    $result['anemia_bulan_lalu'][$key] += (int)$anemia['B'];
//                    $result['anemia_bulan_ini'][$key] += (int)$anemia['E'];
//                }
//            }
//            foreach ($datakek as $kek){
//                if(array_search($kek['C'],$result['desa'])>=0){
//                    $key=array_search($kek['C'],$result['desa']);
//                    $result['kek_bulan_lalu'][$key] += (int)$kek['B'];
//                    $result['kek_bulan_ini'][$key] += (int)$kek['E'];
//                }
//            }
//        } catch (Exception $ex) {
//            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
//            //redirect("laporan/downloadbidanpws");
//        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function balita($kec,$year,$month,$form){
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
        $result['kasus1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus1_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus1_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati1_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati1_P_komulatif'] = [0,0,0,0,0,0];
        
        $result['kasus2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['kasus2_L_komulatif'] = [0,0,0,0,0,0];
        $result['kasus2_P_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_L_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_P_bulan_ini'] = [0,0,0,0,0,0];
        $result['mati2_L_komulatif'] = [0,0,0,0,0,0];
        $result['mati2_P_komulatif'] = [0,0,0,0,0,0];
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=['B12','B13','B14','B15','B16','B17'];
        $result_index['kasus1_L_bulan_ini']=['C12','C13','C14','C15','C16','C17'];
        $result_index['kasus1_P_bulan_ini']=['D12','D13','D14','D15','D16','D17'];
        $result_index['kasus1_L_komulatif']=['F12','F13','F14','F15','F16','F17'];
        $result_index['kasus1_P_komulatif']=['G12','G13','G14','G15','G16','G17'];
        $result_index['mati1_L_bulan_ini']=['I12','I13','I14','I15','I16','I17'];
        $result_index['mati1_P_bulan_ini']=['J12','J13','J14','J15','J16','J17'];
        $result_index['mati1_L_komulatif']=['L12','L13','L14','L15','L16','L17'];
        $result_index['mati1_P_komulatif']=['M12','M13','M14','M15','M16','M17'];
        
        $result_index['kasus2_L_bulan_ini']=['O12','O13','O14','O15','O16','O17'];
        $result_index['kasus2_P_bulan_ini']=['P12','P13','P14','P15','P16','P17'];
        $result_index['kasus2_L_komulatif']=['R12','R13','R14','R15','R16','R17'];
        $result_index['kasus2_P_komulatif']=['S12','S13','S14','S15','S16','S17'];
        $result_index['mati2_L_bulan_ini']=['U12','U13','U14','U15','U16','U17'];
        $result_index['mati2_P_bulan_ini']=['V12','V13','V14','V15','V16','V17'];
        $result_index['mati2_L_komulatif']=['X12','X13','X14','X15','X16','X17'];
        $result_index['mati2_P_komulatif']=['Y12','Y13','Y14','Y15','Y16','Y17'];
        
//        try{
//            $dataanemia = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_anemia'.$namefile,'A2:E8');
//            $datakek = $this->PHPExcelModel->getCellRange('download/pws/cakupan_bumil_kek'.$namefile,'A2:E8');
//
//            foreach ($dataanemia as $anemia){
//                if(array_search($anemia['C'],$result['desa'])>=0){
//                    $key=array_search($anemia['C'],$result['desa']);
//                    $result['anemia_bulan_lalu'][$key] += (int)$anemia['B'];
//                    $result['anemia_bulan_ini'][$key] += (int)$anemia['E'];
//                }
//            }
//            foreach ($datakek as $kek){
//                if(array_search($kek['C'],$result['desa'])>=0){
//                    $key=array_search($kek['C'],$result['desa']);
//                    $result['kek_bulan_lalu'][$key] += (int)$kek['B'];
//                    $result['kek_bulan_ini'][$key] += (int)$kek['E'];
//                }
//            }
//        } catch (Exception $ex) {
//            //$this->session->set_flashdata('file', '<div class="alert alert-danger">Tidak ada data '.$form.' untuk bulan '.$month.'</div>');
//            //redirect("laporan/downloadbidanpws");
//        }
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function maternal($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_amp.xlsx",$result,$result_index);
    }
    
    public function neonatal1($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_1.xlsx",$result,$result_index);
    }
    
    public function neonatal2($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_2.xlsx",$result,$result_index);
    }
    
    public function neonatal3($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_3.xlsx",$result,$result_index);
    }
    
    public function neonatal4($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_4.xlsx",$result,$result_index);
    }
    
    public function neonatal5($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_5.xlsx",$result,$result_index);
    }
    
    public function kb1($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_1.xlsx",$result,$result_index);
    }
    
    public function kb2($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_2.xlsx",$result,$result_index);
    }
    
    public function kb3($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_3.xlsx",$result,$result_index);
    }
    
    public function kb4($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_4.xlsx",$result,$result_index);
    }
    
    public function kb5($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_5.xlsx",$result,$result_index);
    }
    
    public function akb($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_akb.xlsx",$result,$result_index);
    }
    
    public function kih($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kih.xlsx",$result,$result_index);
    }
    
    public function p4k($kec,$year,$month,$form){
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
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_p4k.xlsx",$result,$result_index);
    }
}