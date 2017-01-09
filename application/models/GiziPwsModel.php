<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GiziPwsModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('gizi', TRUE);
        $this->load->model('PHPExcelModel');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getDataKunjungan($clause=1){
        return $this->db->query("SELECT * FROM kunjungan_gizi WHERE ".$clause)->result();
    }
    
    public function getDataRegistrasi($clause=1){
        return $this->db->query("SELECT * FROM registrasi_gizi WHERE ".$clause)->result();
    }
    
    public function pwsBulanIni($bulan,$tahun,$kecamatan){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        if($kecamatan=='sengkol'){
            $result   =  ['Ketara'=>array(),'Sengkol'=>array(),'Kawo'=>array(),'Tanak Awu'=>array(),'Pengembur'=>array(),'Segala Anyar'=>array()];
            $result_row = ['Ketara'=>19,'Sengkol'=>20,'Kawo'=>21,'Tanak Awu'=>22,'Pengembur'=>23,'Segala Anyar'=>24];
            $result_index   =  ['Ketara'=>array(),'Sengkol'=>array(),'Kawo'=>array(),'Tanak Awu'=>array(),'Pengembur'=>array(),'Segala Anyar'=>array()];
            $user_village = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='janapria'){
            $result   =  ['Lekor'=>array(),'Saba'=>array(),'Pendem'=>array(),'Setuta'=>array(),'Jango'=>array(),'Janapria'=>array()];
            $result_row   =  ['Lekor'=>19,'Saba'=>20,'Pendem'=>21,'Setuta'=>22,'Jango'=>23,'Janapria'=>24];
            $result_index   =  ['Lekor'=>array(),'Saba'=>array(),'Pendem'=>array(),'Setuta'=>array(),'Jango'=>array(),'Janapria'=>array()];
            $user_village = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
        }
        
        foreach ($user_village as $x=>$uv){
            $result[$uv] = array(
                'month'=>array(
                    0=>array('m'=>': '.strtoupper($bulan).' '.$tahun)
                ),
                'S'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'N'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'T'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'O'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'B'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                '2T'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'V'=>array(
                    0=>array('L'=>0,'P'=>0),
                    1=>array('L'=>0,'P'=>0),
                    2=>array('L'=>0,'P'=>0),
                    3=>array('L'=>0,'P'=>0)
                ),
                'MP1'=>array(
                    0=>array('L'=>0,'P'=>0)
                ),
                'MP2'=>array(
                    0=>array('L'=>0,'P'=>0)
                ),
                'BBLR'=>array(
                    0=>array('L'=>0,'P'=>0)
                ),
                'GK'=>array(
                    0=>array('L'=>0,'P'=>0)
                )
            );
        }
        
        foreach ($user_village as $x=>$uv){
            $result_index[$uv] = array(
                'month'=>array(
                    0=>array('m'=>'O3')
                ),
                'S'=>array(
                    0=>array('L'=>'O'.$result_row[$uv],'P'=>'P'.$result_row[$uv]),
                    1=>array('L'=>'Q'.$result_row[$uv],'P'=>'R'.$result_row[$uv]),
                    2=>array('L'=>'S'.$result_row[$uv],'P'=>'T'.$result_row[$uv]),
                    3=>array('L'=>'U'.$result_row[$uv],'P'=>'V'.$result_row[$uv])
                ),
                'N'=>array(
                    0=>array('L'=>'AI'.$result_row[$uv],'P'=>'AJ'.$result_row[$uv]),
                    1=>array('L'=>'AK'.$result_row[$uv],'P'=>'AL'.$result_row[$uv]),
                    2=>array('L'=>'AM'.$result_row[$uv],'P'=>'AN'.$result_row[$uv]),
                    3=>array('L'=>'AO'.$result_row[$uv],'P'=>'AP'.$result_row[$uv])
                ),
                'T'=>array(
                    0=>array('L'=>'AS'.$result_row[$uv],'P'=>'AT'.$result_row[$uv]),
                    1=>array('L'=>'AU'.$result_row[$uv],'P'=>'AV'.$result_row[$uv]),
                    2=>array('L'=>'AW'.$result_row[$uv],'P'=>'AX'.$result_row[$uv]),
                    3=>array('L'=>'AY'.$result_row[$uv],'P'=>'AZ'.$result_row[$uv])
                ),
                'O'=>array(
                    0=>array('L'=>'BC'.$result_row[$uv],'P'=>'BD'.$result_row[$uv]),
                    1=>array('L'=>'BE'.$result_row[$uv],'P'=>'BF'.$result_row[$uv]),
                    2=>array('L'=>'BG'.$result_row[$uv],'P'=>'BH'.$result_row[$uv]),
                    3=>array('L'=>'BI'.$result_row[$uv],'P'=>'BJ'.$result_row[$uv])
                ),
                'B'=>array(
                    0=>array('L'=>'BM'.$result_row[$uv],'P'=>'BN'.$result_row[$uv]),
                    1=>array('L'=>'BO'.$result_row[$uv],'P'=>'BP'.$result_row[$uv]),
                    2=>array('L'=>'BQ'.$result_row[$uv],'P'=>'BR'.$result_row[$uv]),
                    3=>array('L'=>'BS'.$result_row[$uv],'P'=>'BT'.$result_row[$uv])
                ),
                '2T'=>array(
                    0=>array('L'=>'CQ'.$result_row[$uv],'P'=>'CR'.$result_row[$uv]),
                    1=>array('L'=>'CS'.$result_row[$uv],'P'=>'CT'.$result_row[$uv]),
                    2=>array('L'=>'CU'.$result_row[$uv],'P'=>'CV'.$result_row[$uv]),
                    3=>array('L'=>'CW'.$result_row[$uv],'P'=>'CX'.$result_row[$uv])
                ),
                'V'=>array(
                    0=>array('L'=>'DA'.$result_row[$uv],'P'=>'DB'.$result_row[$uv]),
                    1=>array('L'=>'DC'.$result_row[$uv],'P'=>'DD'.$result_row[$uv]),
                    2=>array('L'=>'DE'.$result_row[$uv],'P'=>'DF'.$result_row[$uv]),
                    3=>array('L'=>'DG'.$result_row[$uv],'P'=>'DH'.$result_row[$uv])
                ),
                'MP1'=>array(
                    0=>array('L'=>'DK'.$result_row[$uv],'P'=>'DL'.$result_row[$uv])
                ),
                'MP2'=>array(
                    0=>array('L'=>'DM'.$result_row[$uv],'P'=>'DN'.$result_row[$uv])
                ),
                'BBLR'=>array(
                    0=>array('L'=>'DO'.$result_row[$uv],'P'=>'DP'.$result_row[$uv])
                ),
                'GK'=>array(
                    0=>array('L'=>'DQ'.$result_row[$uv],'P'=>'DR'.$result_row[$uv])
                )
            );
        }
                
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        $dataS = $this->getDataKunjungan("(umur <= 59) AND (tanggalPenimbangan > '$startdate' AND tanggalPenimbangan < '$enddate')");
        
        foreach ($dataS as $dds){
            if(array_key_exists($dds->userID, $user_village)){
                if($dds->umur<=5){
                    $child = $this->db->query("SELECT jenisKelamin as jk FROM registrasi_gizi WHERE childId = '".$dds->childId."'");
                    if($child->num_rows()<1){
                        continue;
                    }
                    $jk = $child->row()->jk;
                    if($jk=='male'||$jk=='Laki-laki'){
                        $result[$user_village[$dds->userID]]['S'][0]['L'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][0]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][0]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][0]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][0]['L'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][0]['L'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][0]['L'] += 1;
                        }
                    }elseif($jk=='female'||$jk=='Perempuan'){
                        $result[$user_village[$dds->userID]]['S'][0]['P'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][0]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][0]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][0]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][0]['P'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][0]['P'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][0]['P'] += 1;
                        }
                    }
                }elseif($dds->umur>5&&$dds->umur<=11){
                    $child = $this->db->query("SELECT jenisKelamin as jk FROM registrasi_gizi WHERE childId = '".$dds->childId."'");
                    if($child->num_rows()<1){
                        continue;
                    }
                    $jk = $child->row()->jk;
                    if($jk=='male'||$jk=='Laki-laki'){
                        $result[$user_village[$dds->userID]]['S'][1]['L'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][1]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="t"){
                            $result[$user_village[$dds->userID]]['T'][1]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][1]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][1]['L'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][1]['L'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][1]['L'] += 1;
                        }
                        if(strtolower($dds->mp_asi)=="ya"||strtolower($dds->mp_asi)=="yes"){
                            $result[$user_village[$dds->userID]]['MP1'][0]['L'] += 1;
                        }
                    }elseif($jk=='female'||$jk=='Perempuan'){
                        $result[$user_village[$dds->userID]]['S'][1]['P'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][1]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][1]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][1]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][1]['P'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][1]['P'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][1]['P'] += 1;
                        }
                        if(strtolower($dds->mp_asi)=="ya"||strtolower($dds->mp_asi)=="yes"){
                            $result[$user_village[$dds->userID]]['MP1'][0]['P'] += 1;
                        }
                    }
                }elseif($dds->umur>11&&$dds->umur<=23){
                    $child = $this->db->query("SELECT jenisKelamin as jk FROM registrasi_gizi WHERE childId = '".$dds->childId."'");
                    if($child->num_rows()<1){
                        continue;
                    }
                    $jk = $child->row()->jk;
                    if($jk=='male'||$jk=='Laki-laki'){
                        $result[$user_village[$dds->userID]]['S'][2]['L'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][2]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][2]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][2]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][2]['L'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][2]['L'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][2]['L'] += 1;
                        }
                        if(strtolower($dds->mp_asi)=="ya"||strtolower($dds->mp_asi)=="yes"){
                            $result[$user_village[$dds->userID]]['MP2'][0]['L'] += 1;
                        }
                    }elseif($jk=='female'||$jk=='Perempuan'){
                        $result[$user_village[$dds->userID]]['S'][2]['P'] += 1;
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][2]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][2]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][2]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][2]['P'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][2]['P'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][2]['P'] += 1;
                        }
                        if(strtolower($dds->mp_asi)=="ya"||strtolower($dds->mp_asi)=="yes"){
                            $result[$user_village[$dds->userID]]['MP2'][0]['P'] += 1;
                        }
                    }
                }elseif($dds->umur>23&&$dds->umur<=59){
                    $child = $this->db->query("SELECT jenisKelamin as jk FROM registrasi_gizi WHERE childId = '".$dds->childId."'");
                    if($child->num_rows()<1){
                        continue;
                    }
                    $jk = $child->row()->jk;
                    if($jk=='male'||$jk=='Laki-laki'){
                        $result[$user_village[$dds->userID]]['S'][3]['L'] += 1; 
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][3]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][3]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][3]['L'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][3]['L'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][3]['L'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][3]['L'] += 1;
                        }
                    }elseif($jk=='female'||$jk=='Perempuan'){
                        $result[$user_village[$dds->userID]]['S'][3]['P'] += 1; 
                        if(strtolower($dds->nutrition_status)=="Weight Increase"){
                            $result[$user_village[$dds->userID]]['N'][3]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="Not gaining weight"){
                            $result[$user_village[$dds->userID]]['T'][3]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="not attending previous visit"){
                            $result[$user_village[$dds->userID]]['O'][3]['P'] += 1;
                        }elseif(strtolower($dds->nutrition_status)=="b"){
                            $result[$user_village[$dds->userID]]['B'][3]['P'] += 1;
                        }
                        if(strtolower($dds->dua_t)=="ya"||strtolower($dds->dua_t)=="yes"){
                            $result[$user_village[$dds->userID]]['2T'][3]['P'] += 1;
                        }
                        if(strtolower($dds->bgm)=="ya"||strtolower($dds->bgm)=="yes"){
                            $result[$user_village[$dds->userID]]['V'][3]['P'] += 1;
                        }
                    }
                }
            }
        }
        
        $dataBBLR = $this->getDataRegistrasi("tanggalLahir > '$startdate' AND tanggalLahir < '$enddate'");
        
        foreach ($dataBBLR as $dds){
            if(array_key_exists($dds->userID, $user_village)){
                if($dds->beratLahir<2500&&$dds->beratLahir!='-'){
                    $jk = $dds->jenisKelamin;
                    if($jk=='male'||$jk=='Laki-laki'){
                        $result[$user_village[$dds->userID]]['BBLR'][0]['L'] += 1;
                    }elseif($jk=='female'||$jk=='Perempuan'){
                        $result[$user_village[$dds->userID]]['BBLR'][0]['P'] += 1;
                    }
                }
            }
        }
        
        $file = APPPATH."download/gizi/pws/template_$kecamatan.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        $fileObject->setActiveSheetIndex(0);
        
        foreach ($result as $key1=>$ite1){
            foreach ($ite1 as $key2=>$ite2){
                foreach ($ite2 as $key3=>$ite3){
                    foreach ($ite3 as $key4=>$value){
                        //if($value!=0||is_string($value)) 
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2][$key3][$key4], $value);
                    }
                }
            }
        }
        
        $savedFileName = 'PWS-GIZI-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
}