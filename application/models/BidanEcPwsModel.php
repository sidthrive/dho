<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanEcPwsModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('analytics', TRUE);
        $this->load->library('PHPExcell');
        $this->load->model('PHPExcelModel');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    private function isHaveDoneAnc4($bumil){
        if($this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE baseEntityId='$bumil->baseEntityId' AND ancDate < '$bumil->ancDate' AND ancKe=4")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHaveDoneAnc1($bumil){
        if($this->db->query("SELECT * FROM event_bidan_kunjungan_anc WHERE baseEntityId='$bumil->baseEntityId' AND ancDate < '$bumil->ancDate' AND ancKe=1 AND kunjunganKe=1")->num_rows()>0){
            return true;
        }else return false;
    }
    
    private function isHRP($bumil,$resiko,$bumildata){
        $no = 0;
        if(array_key_exists($bumil->baseEntityId, $resiko)){
            foreach ($resiko[$bumil->baseEntityId] as $visit){
                $thisanc = date("Y-m-d", strtotime($visit->ancDate));
                $bumilanc = date("Y-m-d", strtotime($bumil->ancDate));
                if($thisanc<$bumilanc){
                    if($visit->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                            ||$visit->highRiskPregnancyPIH=="yes"
                            ||$visit->highRisklabourFetusNumber=="yes"
                            ||$visit->highRiskLabourFetusSize=="yes"
                            ||$visit->highRiskLabourFetusMalpresentation=="yes"){
                        return true;
                    }
                    $no++;
                }
            }
        }
        
        if($no>0){
            if(array_key_exists($bumil->baseEntityId, $bumildata)){
                foreach ($bumildata[$bumil->baseEntityId] as $bum){
                    if($bum->highRiskPregnancyProteinEnergyMalnutrition=="yes"
                        ||$bum->highRiskLabourTBRisk=="yes"
                        ||$bum->HighRiskPregnancyTooManyChildren=="yes"
                        ||$bum->HighRiskPregnancyAbortus=="yes"
                        ||$bum->HighRiskLabourSectionCesareaRecord=="yes"
                        ||$bum->highRiskEctopicPregnancy=="yes"
                        ||$bum->highRiskCardiovascularDiseaseRecord=="yes"
                        ||$bum->highRiskDidneyDisorder=="yes"
                        ||$bum->highRiskHeartDisorder=="yes"
                        ||$bum->highRiskAsthma=="yes"
                        ||$bum->highRiskTuberculosis=="yes"
                        ||$bum->highRiskMalaria=="yes"
                        ||$bum->highRiskHIVAIDS=="yes"){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    private function setArrayIndex($src,$col,$row_start){
        $ret = [];
        foreach ($src as $s){
            array_push($ret, $col.($row_start++));
        }
        return $ret;
    }
    
    public function kia($kec,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col = ['januari'=>'D','februari'=>'E','maret'=>'F','april'=>'G','mei'=>'H','juni'=>'I','juli'=>'J','agustus'=>'K','september'=>'L','oktober'=>'M','november'=>'N','desember'=>'O'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['data']['DATA A']['desa'] = $user;
        $result['data']['DATA A']['bumil'] = array_fill(0,count($user),0);
        $result['data']['DATA A']['bulin'] = array_fill(0,count($user),0);
        
        $result_index['desa']= $this->setArrayIndex($user, 'B', 6);
        $result_index['bumil'] = $this->setArrayIndex($user, 'C', 6);
        $result_index['bulin'] = $this->setArrayIndex($user, 'E', 6);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = 'kec_'.strtolower($kec);
        $target = $pwsdb->query("SELECT * FROM target WHERE loc_parent='$loc' AND tahun='$year'")->result();
        foreach ($target as $t){
            $lo = explode('desa_', $t->location);
            $l = ucwords(str_replace('_', ' ', $lo[1]));
            $key = array_search($l, $user);
            $result['data']['DATA A']['bumil'][$key] = $t->bumil;
            $result['data']['DATA A']['bulin'][$key] = $t->bulin;
        }
        $loc = "";
        foreach ($user as $u){
            $desa = 'desa_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($user)){
                $loc = $loc."location='$desa'";
            }else{
                $loc = $loc."location='$desa' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM kia WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('desa_', $d->location);
            $l = ucwords(str_replace('_', ' ', $lo[1]));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 7);
            $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 38);
            $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 69);
            $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 98);
            $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 127);
            $result_index['linakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 157);
            $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 188);
            $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 219);
            $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 252);
            $result_index['anemia_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 283);
            $result_index['kek_bulan_ini']=$this->setArrayIndex($user, $bulan_col[$bln], 314);
            foreach ($d as $desa=>$d2){
                $key = array_search($desa, $user);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $kec = explode(" ",$result['kecamatan'][0]);
        $kecamatan = end($kec);
        $prev = prev($kec);
        while(!(count($prev)==0||$prev==':')){
            $kecamatan = $prev.'_'.$kecamatan;
            $prev = prev($kec);
        }
        $bt = explode(" ",$result['bulan'][0]);
        $tahun = end($bt);
        $bulan = prev($bt);
        $savedFileName = 'PWS-'.strtoupper($result['form'][0]).'-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
    
    private function isHaveKomplikasiBefore($bumil,$komplikasi){
        if(array_key_exists($bumil->baseEntityId, $komplikasi)){
            foreach ($komplikasi[$bumil->baseEntityId] as $visit){
                $thisanc = date("Y-m-d", strtotime($visit->ancDate));
                $bumilanc = date("Y-m-d", strtotime($bumil->ancDate));
                if($thisanc<$bumilanc){
                    if($visit->komplikasidalamKehamilan!=''&&$visit->komplikasidalamKehamilan!='None'&&$visit->komplikasidalamKehamilan!='tidak_ada_komplikasi'){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    private function isAnemia($bumil,$datalabs){
        if(array_key_exists($bumil->baseEntityId, $datalabs)){
            foreach ($datalabs[$bumil->baseEntityId] as $data){
                if($data->laboratoriumPeriksaHbAnemia=='positif'||$data->highRiskPregnancyAnemia=='yes'){
                    return true;
                }
            }
        }
        return false;
    }
    
    public function bayi($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($user),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 12);
        $result_index['kasus1_L_bulan_ini']=$this->setArrayIndex($user, 'C', 12);
        $result_index['kasus1_P_bulan_ini']=$this->setArrayIndex($user, 'D', 12);
        $result_index['kasus1_L_komulatif']=$this->setArrayIndex($user, 'F', 12);
        $result_index['kasus1_P_komulatif']=$this->setArrayIndex($user, 'G', 12);
        $result_index['mati1_L_bulan_ini']=$this->setArrayIndex($user, 'I', 12);
        $result_index['mati1_P_bulan_ini']=$this->setArrayIndex($user, 'J', 12);
        $result_index['mati1_L_komulatif']=$this->setArrayIndex($user, 'L', 12);
        $result_index['mati1_P_komulatif']=$this->setArrayIndex($user, 'M', 12);
        
        $result_index['kasus2_L_bulan_ini']=$this->setArrayIndex($user, 'O', 12);
        $result_index['kasus2_P_bulan_ini']=$this->setArrayIndex($user, 'P', 12);
        $result_index['kasus2_L_komulatif']=$this->setArrayIndex($user, 'R', 12);
        $result_index['kasus2_P_komulatif']=$this->setArrayIndex($user, 'S', 12);
        $result_index['mati2_L_bulan_ini']=$this->setArrayIndex($user, 'U', 12);
        $result_index['mati2_P_bulan_ini']=$this->setArrayIndex($user, 'V', 12);
        $result_index['mati2_L_komulatif']=$this->setArrayIndex($user, 'X', 12);
        $result_index['mati2_P_komulatif']=$this->setArrayIndex($user, 'Y', 12);
        
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
        //var_dump($result);exit;
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function balita($kec,$year,$month,$form){
        $user   = array();
        $result = array();
        $namefile = "";
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($user),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($user),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($user),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($user),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($user),0);
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['desa']=$this->setArrayIndex($user, 'B', 12);
        $result_index['kasus1_L_bulan_ini']=$this->setArrayIndex($user, 'C', 12);
        $result_index['kasus1_P_bulan_ini']=$this->setArrayIndex($user, 'D', 12);
        $result_index['kasus1_L_komulatif']=$this->setArrayIndex($user, 'F', 12);
        $result_index['kasus1_P_komulatif']=$this->setArrayIndex($user, 'G', 12);
        $result_index['mati1_L_bulan_ini']=$this->setArrayIndex($user, 'I', 12);
        $result_index['mati1_P_bulan_ini']=$this->setArrayIndex($user, 'J', 12);
        $result_index['mati1_L_komulatif']=$this->setArrayIndex($user, 'L', 12);
        $result_index['mati1_P_komulatif']=$this->setArrayIndex($user, 'M', 12);
        
        $result_index['kasus2_L_bulan_ini']=$this->setArrayIndex($user, 'O', 12);
        $result_index['kasus2_P_bulan_ini']=$this->setArrayIndex($user, 'P', 12);
        $result_index['kasus2_L_komulatif']=$this->setArrayIndex($user, 'R', 12);
        $result_index['kasus2_P_komulatif']=$this->setArrayIndex($user, 'S', 12);
        $result_index['mati2_L_bulan_ini']=$this->setArrayIndex($user, 'U', 12);
        $result_index['mati2_P_bulan_ini']=$this->setArrayIndex($user, 'V', 12);
        $result_index['mati2_L_komulatif']=$this->setArrayIndex($user, 'X', 12);
        $result_index['mati2_P_komulatif']=$this->setArrayIndex($user, 'Y', 12);
        
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
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
        if($this->session->userdata('level')=="supervisor"&&$this->session->userdata('tipe')!="all"){
            $user = $this->ec->getDesaPwsSpv('bidan',$this->session->userdata('location'));
            $user_index   = $this->loc->getLocId($this->session->userdata('location'));
        }else{
            $user = $this->ec->getDesaPwsSpv('bidan',$kec);
            $user_index   = $this->loc->getLocId($kec);
        }
        $namefile .= "_".$month."_".$kec.".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("PUSKESMAS    :  ".strtoupper($kec));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['desa'] = $user;
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_p4k.xlsx",$result,$result_index);
    }
    
    
}