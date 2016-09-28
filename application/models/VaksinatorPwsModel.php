<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorPwsModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('vaksinator', TRUE);
        $this->load->library('PHPExcell');
        $this->load->model('PHPExcelModel');
        date_default_timezone_set("Asia/Makassar"); 
    }
    
    public function getDataVisit($clause=1){
        return $this->db->query("SELECT * FROM jurim_visit WHERE ".$clause)->result();
    }
    
    public function getDataRegistrasi($clause=1){
        return $this->db->query("SELECT * FROM registrasi_jurim WHERE ".$clause)->result();
    }
    
    private function getDataTemplate($kecamatan){
        $template = [];
        if($kecamatan=='sengkol'){
            $template['hb0'] = $template['bcg'] = $template['polio1'] = $template['dpthb1'] = $template['polio2'] = $template['dpthb2'] = $template['polio3'] = $template['dpthb3'] = $template['polio4'] = $template['campak'] = $template['lengkap'] = $template['booster_dpthb'] = $template['booster_campak'] = 
                ['Ketara'=>array('l'=>0,'p'=>0),'Sengkol'=>array('l'=>0,'p'=>0),'Kawo'=>array('l'=>0,'p'=>0),'Tanak Awu'=>array('l'=>0,'p'=>0),'Pengembur'=>array('l'=>0,'p'=>0),'Segala Anyar'=>array('l'=>0,'p'=>0)];
        }elseif($kecamatan=='janapria'){
            $template['hb0'] = $template['bcg'] = $template['polio1'] = $template['dpthb1'] = $template['polio2'] = $template['dpthb2'] = $template['polio3'] = $template['dpthb3'] = $template['polio4'] = $template['campak'] = $template['lengkap'] = $template['booster_dpthb'] = $template['booster_campak'] = 
                ['Lekor'=>array('l'=>0,'p'=>0),'Saba'=>array('l'=>0,'p'=>0),'Pendem'=>array('l'=>0,'p'=>0),'Setuta'=>array('l'=>0,'p'=>0),'Jango'=>array('l'=>0,'p'=>0),'Janapria'=>array('l'=>0,'p'=>0)];
        }
        return $template;
    }
    
    private function getPemakaianVaksinTemplate($kecamatan){
        $template = [];
        if($kecamatan=='sengkol'){
            $template =
                ['Ketara'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Sengkol'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Kawo'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Tanak Awu'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Pengembur'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Segala Anyar'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0)];
        }elseif($kecamatan=='janapria'){
            $template = 
                ['Lekor'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Saba'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Pendem'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Setuta'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Jango'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0),'Janapria'=>array('unjk'=>0,'bcg'=>0,'pol'=>0,'hib'=>0,'cpk'=>0,'tt'=>0)];
        }
        return $template;
    }
    
    private function getVaksinTTTemplate($kecamatan){
        $template = [];
        if($kecamatan=='sengkol'){
            $template['bumil'] = $template['wus_th'] =
                ['Ketara'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Sengkol'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Kawo'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Tanak Awu'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Pengembur'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Segala Anyar'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0)];
        }elseif($kecamatan=='janapria'){
            $template['bumil'] = $template['wus_th'] =
                ['Lekor'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Saba'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Pendem'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Setuta'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Jango'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0),'Janapria'=>array('tt1'=>0,'tt2'=>0,'tt3'=>0,'tt4'=>0,'tt5'=>0)];
        }
        return $template;
    }


    public function getDataDasar($tahun,$kecamatan){
        $file = APPPATH."download/vaksinator/pws/data_dasar/data_dasar_".strtolower($kecamatan)."_tes.xlsx";
        $objReader = new PHPExcel_Reader_Excel2007();
        $fileObject = $objReader->load($file)->getActiveSheet();
        $data = [
            'puskesmas'=>$fileObject->getCell('C3')->getCalculatedValue(),
            'kabupaten'=>$fileObject->getCell('C4')->getCalculatedValue(),
            'jml_desa'=>$fileObject->getCell('C2')->getCalculatedValue(),
            'tahun'=>$fileObject->getCell('C5')->getCalculatedValue(),
            'target_tahunan'=>array(
                'hb0'=>$fileObject->getCell('Q11')->getCalculatedValue(),
                'bcg'=>$fileObject->getCell('Q12')->getCalculatedValue(),
                'polio1'=>$fileObject->getCell('Q13')->getCalculatedValue(),
                'dpthb1'=>$fileObject->getCell('Q14')->getCalculatedValue(),
                'polio2'=>$fileObject->getCell('Q15')->getCalculatedValue(),
                'dpthb2'=>$fileObject->getCell('Q16')->getCalculatedValue(),
                'polio3'=>$fileObject->getCell('Q17')->getCalculatedValue(),
                'dpthb3'=>$fileObject->getCell('Q18')->getCalculatedValue(),
                'polio4'=>$fileObject->getCell('Q19')->getCalculatedValue(),
                'campak'=>$fileObject->getCell('Q20')->getCalculatedValue(),
                'dodpthb13'=>$fileObject->getCell('Q21')->getCalculatedValue(),
                'dodpthb1campak'=>$fileObject->getCell('Q22')->getCalculatedValue(),
                'tt2bumil'=>$fileObject->getCell('Q23')->getCalculatedValue(),
                'dpthbbatita'=>$fileObject->getCell('Q24')->getCalculatedValue(),
                'campakbatita'=>$fileObject->getCell('Q25')->getCalculatedValue(),
            ),
            'data_demografi'=>  [
                'desa'=> [
                    $fileObject->getCell('B11')->getCalculatedValue(),
                    $fileObject->getCell('B12')->getCalculatedValue(),
                    $fileObject->getCell('B13')->getCalculatedValue(),
                    $fileObject->getCell('B14')->getCalculatedValue(),
                    $fileObject->getCell('B15')->getCalculatedValue(),
                    $fileObject->getCell('B16')->getCalculatedValue()
                ],
                'bbl'=>  [
                    'L'=>[
                        $fileObject->getCell('C11')->getCalculatedValue(),
                        $fileObject->getCell('C12')->getCalculatedValue(),
                        $fileObject->getCell('C13')->getCalculatedValue(),
                        $fileObject->getCell('C14')->getCalculatedValue(),
                        $fileObject->getCell('C15')->getCalculatedValue(),
                        $fileObject->getCell('C16')->getCalculatedValue()
                    ],
                    'P'=>[
                        $fileObject->getCell('D11')->getCalculatedValue(),
                        $fileObject->getCell('D12')->getCalculatedValue(),
                        $fileObject->getCell('D13')->getCalculatedValue(),
                        $fileObject->getCell('D14')->getCalculatedValue(),
                        $fileObject->getCell('D15')->getCalculatedValue(),
                        $fileObject->getCell('D16')->getCalculatedValue()
                    ]
                ],
                'si'=>  [
                    'L'=>[
                        $fileObject->getCell('F11')->getCalculatedValue(),
                        $fileObject->getCell('F12')->getCalculatedValue(),
                        $fileObject->getCell('F13')->getCalculatedValue(),
                        $fileObject->getCell('F14')->getCalculatedValue(),
                        $fileObject->getCell('F15')->getCalculatedValue(),
                        $fileObject->getCell('F16')->getCalculatedValue()
                    ],
                    'P'=>[
                        $fileObject->getCell('G11')->getCalculatedValue(),
                        $fileObject->getCell('G12')->getCalculatedValue(),
                        $fileObject->getCell('G13')->getCalculatedValue(),
                        $fileObject->getCell('G14')->getCalculatedValue(),
                        $fileObject->getCell('G15')->getCalculatedValue(),
                        $fileObject->getCell('G16')->getCalculatedValue()
                    ]
                ],
                'batita'=>  [
                    'L'=>[
                        $fileObject->getCell('I11')->getCalculatedValue(),
                        $fileObject->getCell('I12')->getCalculatedValue(),
                        $fileObject->getCell('I13')->getCalculatedValue(),
                        $fileObject->getCell('I14')->getCalculatedValue(),
                        $fileObject->getCell('I15')->getCalculatedValue(),
                        $fileObject->getCell('I16')->getCalculatedValue()
                    ],
                    'P'=>[
                        $fileObject->getCell('J11')->getCalculatedValue(),
                        $fileObject->getCell('J12')->getCalculatedValue(),
                        $fileObject->getCell('J13')->getCalculatedValue(),
                        $fileObject->getCell('J14')->getCalculatedValue(),
                        $fileObject->getCell('J15')->getCalculatedValue(),
                        $fileObject->getCell('J16')->getCalculatedValue()
                    ]   
                ],
                'total_wus'=>  [
                    $fileObject->getCell('L11')->getCalculatedValue(),
                    $fileObject->getCell('L12')->getCalculatedValue(),
                    $fileObject->getCell('L13')->getCalculatedValue(),
                    $fileObject->getCell('L14')->getCalculatedValue(),
                    $fileObject->getCell('L15')->getCalculatedValue(),
                    $fileObject->getCell('L16')->getCalculatedValue()
                ],
                'wus_hamil'=>  [
                    $fileObject->getCell('M11')->getCalculatedValue(),
                    $fileObject->getCell('M12')->getCalculatedValue(),
                    $fileObject->getCell('M13')->getCalculatedValue(),
                    $fileObject->getCell('M14')->getCalculatedValue(),
                    $fileObject->getCell('M15')->getCalculatedValue(),
                    $fileObject->getCell('M16')->getCalculatedValue()
                ],
                ]
        ];
        return $data;
    }
    
    private function cekImunisasiLengkap($childID){
        $im_table = ['bcg_visit','polio1_visit','hb1_visit','polio2_visit','dpt_hb2_visit','polio3_visit','hb3_visit','polio4_visit','campak_visit'];
        $lengkap = true;
        foreach ($im_table as $table){
            if(!($this->db->query("SELECT childId from $table WHERE childId = '$childID'")->num_rows()>0)){
                $lengkap = false;
                break;
            }
        }
        return $lengkap;
    }
    
    public function downloadLaporanBulanan($bulan,$tahun,$kecamatan){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        if($kecamatan=='sengkol'){
            $user_village = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='janapria'){
            $user_village = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
        }
        
        $data_dasar = $this->getDataDasar($tahun,$kecamatan);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = APPPATH."download/vaksinator/pws/template_laporan_bulanan.xlsx";
        $file_laporan = $objReader->load($path);
        
        $data_bulan_ini = $this->getDataTemplate($kecamatan);
        $data_kumulatif = $this->getDataTemplate($kecamatan);
        
        $data_pemakaian_bulan_ini = $this->getPemakaianVaksinTemplate($kecamatan);
        $data_pemakaian_kumulatif = $this->getPemakaianVaksinTemplate($kecamatan);
        
        $startyear = $tahun.'-01';
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        //get HB0 data
        $databulanini = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startdate' AND hb0 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM hb0_visit WHERE hb0 > '$startyear' AND hb0 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['hb0'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['hb0'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['hb0'][$user_village[$d->userID]]['l'] +=1;  
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['hb0'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get BCG data
        $databulanini = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startdate' AND bcg < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM bcg_visit WHERE bcg > '$startyear' AND bcg < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['bcg'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['bcg'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['bcg'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['bcg'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get POLIO1 data
        $databulanini = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startdate' AND polio1 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM polio1_visit WHERE polio1 > '$startyear' AND polio1 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['polio1'][$user_village[$d->userID]]['l'] +=1;  
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['polio1'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['polio1'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['polio1'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get DPTHB1 data
        $databulanini = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startdate' AND dpt_hb1 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM hb1_visit WHERE dpt_hb1 > '$startyear' AND dpt_hb1 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['dpthb1'][$user_village[$d->userID]]['l'] +=1; 
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['dpthb1'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['dpthb1'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['dpthb1'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get POLIO2 data
        $databulanini = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startdate' AND polio2 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM polio2_visit WHERE polio2 > '$startyear' AND polio2 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['polio2'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['polio2'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['polio2'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['polio2'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get DPTHB2 data
        $databulanini = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startdate' AND dpt_hb2 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM dpt_hb2_visit WHERE dpt_hb2 > '$startyear' AND dpt_hb2 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['dpthb2'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['dpthb2'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['dpthb2'][$user_village[$d->userID]]['l'] +=1;  
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['dpthb2'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get POLIO3 data
        $databulanini = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startdate' AND polio3 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM polio3_visit WHERE polio3 > '$startyear' AND polio3 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['polio3'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['polio3'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['polio3'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['polio3'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        //get DPTHB3 data
        $databulanini = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startdate' AND dpt_hb3 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startyear' AND dpt_hb3 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['dpthb3'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['dpthb3'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['dpthb3'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['dpthb3'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get POLIO4 data
        $databulanini = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startdate' AND polio4 < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startyear' AND polio4 < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['polio4'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['polio4'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['polio4'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['polio4'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get CAMPAK data
        $databulanini = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startdate' AND imunisasi_campak < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startyear' AND imunisasi_campak < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['campak'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['campak'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['campak'][$user_village[$d->userID]]['l'] +=1;  
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['campak'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
//        //get BOOSTER DPTHB data
//        $databulanini = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate' AND campak_lanjutan < '$enddate'")->result();
//        $datakumulatif = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startyear' AND campak_lanjutan < '$enddate'")->result();
//        
//        foreach ($databulanini as $d){
//            if(array_key_exists($d->userID, $user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $data_bulan_ini['booster_dpthb'][$user_village[$d->userID]]['l'] +=1; 
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $data_bulan_ini['booster_dpthb'][$user_village[$d->userID]]['p'] +=1;
//                }
//            }
//        }
//        
//        foreach ($datakumulatif as $d){
//            if(array_key_exists($d->userID, $user_village)){
//                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
//                if($jk=="laki-laki"||$jk=="male"){
//                    $data_kumulatif['booster_dpthb'][$user_village[$d->userID]]['l'] +=1; 
//                }elseif($jk=="perempuan"||$jk=="female"){
//                    $data_kumulatif['booster_dpthb'][$user_village[$d->userID]]['p'] +=1;
//                }
//            }
//        }
        
         //get BOOSTER CAMPAK data
        $databulanini = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startdate' AND campak_lanjutan < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM campak_lanjutan_visit WHERE campak_lanjutan > '$startyear' AND campak_lanjutan < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_bulan_ini['booster_campak'][$user_village[$d->userID]]['l'] +=1; 
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_bulan_ini['booster_campak'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['booster_campak'][$user_village[$d->userID]]['l'] +=1; 
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['booster_campak'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //calculate Imunisasi lengkap data
        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
        $lastyearfromthisjanuari = date("Y-m", strtotime($startyear." -1 year"));
        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthisjanuari' AND tanggal_lahir < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $d->jenis_kelamin;
                if($this->cekImunisasiLengkap($d->childId)){
                    if($jk=="laki-laki"||$jk=="male"){
                        $data_bulan_ini['lengkap'][$user_village[$d->userID]]['l'] +=1;   
                    }elseif($jk=="perempuan"||$jk=="female"){
                        $data_bulan_ini['lengkap'][$user_village[$d->userID]]['p'] +=1;
                    }
               }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $d->jenis_kelamin;
                if($this->cekImunisasiLengkap($d->childId)){
                    if($jk=="laki-laki"||$jk=="male"){
                        $data_kumulatif['lengkap'][$user_village[$d->userID]]['l'] +=1;   
                    }elseif($jk=="perempuan"||$jk=="female"){
                        $data_kumulatif['lengkap'][$user_village[$d->userID]]['p'] +=1;
                    }
               }
            }
        }
        
        
        $file_laporan->getActiveSheet()->setCellValue('C2', $data_dasar['jml_desa']);
        $file_laporan->getActiveSheet()->setCellValue('C3', $data_dasar['puskesmas']);
        $file_laporan->getActiveSheet()->setCellValue('C4', $data_dasar['kabupaten']);
        $file_laporan->getActiveSheet()->setCellValue('G4', strtoupper($bulan));
        $file_laporan->getActiveSheet()->setCellValue('H4', $data_dasar['tahun']);
        for($i=0;$i<6;$i++){
            $file_laporan->getActiveSheet()->setCellValue('B'.(10+$i), $data_dasar['data_demografi']['desa'][$i]);
            $file_laporan->getActiveSheet()->setCellValue('C'.(10+$i), $data_dasar['data_demografi']['bbl']['L'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('D'.(10+$i), $data_dasar['data_demografi']['bbl']['P'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('F'.(10+$i), $data_dasar['data_demografi']['si']['L'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('G'.(10+$i), $data_dasar['data_demografi']['si']['P'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('I'.(10+$i), $data_bulan_ini['hb0'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('K'.(10+$i), $data_bulan_ini['hb0'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('O'.(10+$i), $data_kumulatif['hb0'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('Q'.(10+$i), $data_kumulatif['hb0'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('U'.(10+$i), $data_bulan_ini['bcg'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('W'.(10+$i), $data_bulan_ini['bcg'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('AA'.(10+$i), $data_kumulatif['bcg'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('AC'.(10+$i), $data_kumulatif['bcg'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('AG'.(10+$i), $data_bulan_ini['polio1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('AI'.(10+$i), $data_bulan_ini['polio1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('AM'.(10+$i), $data_kumulatif['polio1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('AO'.(10+$i), $data_kumulatif['polio1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('AS'.(10+$i), $data_bulan_ini['dpthb1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('AU'.(10+$i), $data_bulan_ini['dpthb1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('AY'.(10+$i), $data_kumulatif['dpthb1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('BA'.(10+$i), $data_kumulatif['dpthb1'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('BE'.(10+$i), $data_bulan_ini['polio2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('BG'.(10+$i), $data_bulan_ini['polio2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('BK'.(10+$i), $data_kumulatif['polio2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('BM'.(10+$i), $data_kumulatif['polio2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('BQ'.(10+$i), $data_bulan_ini['dpthb2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('BS'.(10+$i), $data_bulan_ini['dpthb2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('BW'.(10+$i), $data_kumulatif['dpthb2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('BY'.(10+$i), $data_kumulatif['dpthb2'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('CC'.(10+$i), $data_bulan_ini['polio3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('CE'.(10+$i), $data_bulan_ini['polio3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('CI'.(10+$i), $data_kumulatif['polio3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('CK'.(10+$i), $data_kumulatif['polio3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('CO'.(10+$i), $data_bulan_ini['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('CQ'.(10+$i), $data_bulan_ini['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('CU'.(10+$i), $data_kumulatif['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('CW'.(10+$i), $data_kumulatif['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('DA'.(10+$i), $data_bulan_ini['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('DC'.(10+$i), $data_bulan_ini['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('DG'.(10+$i), $data_kumulatif['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('DI'.(10+$i), $data_kumulatif['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('DM'.(10+$i), $data_bulan_ini['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('DO'.(10+$i), $data_bulan_ini['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('DS'.(10+$i), $data_kumulatif['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('DU'.(10+$i), $data_kumulatif['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('DY'.(10+$i), $data_bulan_ini['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('EA'.(10+$i), $data_bulan_ini['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('EE'.(10+$i), $data_kumulatif['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('EG'.(10+$i), $data_kumulatif['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('EK'.(10+$i), $data_bulan_ini['booster_dpthb'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('EM'.(10+$i), $data_bulan_ini['booster_dpthb'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('EQ'.(10+$i), $data_kumulatif['booster_dpthb'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('ES'.(10+$i), $data_kumulatif['booster_dpthb'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            
            $file_laporan->getActiveSheet()->setCellValue('EW'.(10+$i), $data_bulan_ini['booster_campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('EY'.(10+$i), $data_bulan_ini['booster_campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
            $file_laporan->getActiveSheet()->setCellValue('FC'.(10+$i), $data_kumulatif['booster_campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']);
            $file_laporan->getActiveSheet()->setCellValue('FE'.(10+$i), $data_kumulatif['booster_campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
        }
        $bln_ini = ['I','U','AG','AS','BE','BQ','CC','CO','DA','DM','DY','EK','EW','FI','FU','FY','GC','GG','GS'];
        $sd_bln_ini = ['O','AA','AM','AY','BK','BW','CI','CU','DG','DS','EE','EQ','FC','FO','FW','GA','GE','GM','GY'];
        foreach ($bln_ini as $x=>$v){
            $file_laporan->getActiveSheet()->setCellValue($v.'7', "BLN ".strtoupper($bulan));
            $file_laporan->getActiveSheet()->setCellValue($sd_bln_ini[$x].'7', "S/D BLN ".strtoupper($bulan));
        }
        
        $savedFileName = 'PWS-VAKSINATOR-LAPORAN_BULANAN-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($file_laporan,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function downloadLaporanAnalisa($bulan, $tahun, $kecamatan){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        if($kecamatan=='sengkol'){
            $user_village = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='janapria'){
            $user_village = ['field_test2'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
        }
        
        $data_dasar = $this->getDataDasar($tahun,$kecamatan);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = APPPATH."download/vaksinator/pws/template_analisa.xlsx";
        $file_laporan = $objReader->load($path);
        
        $data_bulan_ini = $this->getDataTemplate($kecamatan);
        $data_kumulatif = $this->getDataTemplate($kecamatan);
                
        $startyear = $tahun.'-01';
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        //get DPTHB3 data
        $datakumulatif = $this->db->query("SELECT * FROM hb3_visit WHERE dpt_hb3 > '$startyear' AND dpt_hb3 < '$enddate'")->result();
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['dpthb3'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['dpthb3'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get POLIO4 data
        $datakumulatif = $this->db->query("SELECT * FROM polio4_visit WHERE polio4 > '$startyear' AND polio4 < '$enddate'")->result();
                
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['polio4'][$user_village[$d->userID]]['l'] +=1;   
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['polio4'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
         //get CAMPAK data
        $datakumulatif = $this->db->query("SELECT * FROM campak_visit WHERE imunisasi_campak > '$startyear' AND imunisasi_campak < '$enddate'")->result();
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $this->db->query("SELECT jenis_kelamin as jk FROM registrasi_jurim WHERE childID = '".$d->childId."'")->row()->jk;
                if($jk=="laki-laki"||$jk=="male"){
                    $data_kumulatif['campak'][$user_village[$d->userID]]['l'] +=1;  
                }elseif($jk=="perempuan"||$jk=="female"){
                    $data_kumulatif['campak'][$user_village[$d->userID]]['p'] +=1;
                }
            }
        }
        
        $file_laporan->getActiveSheet()->setCellValue('C2', $data_dasar['jml_desa']);
        $file_laporan->getActiveSheet()->setCellValue('C3', $data_dasar['puskesmas']);
        $file_laporan->getActiveSheet()->setCellValue('C4', $data_dasar['kabupaten']);
        $file_laporan->getActiveSheet()->setCellValue('C5', strtoupper($bulan));
        $file_laporan->getActiveSheet()->setCellValue('E5', $data_dasar['tahun']);
        $file_laporan->getActiveSheet()->setCellValue('S2', $data_dasar['target_tahunan']['dpthb3']);
        $file_laporan->getActiveSheet()->setCellValue('S3', $data_dasar['target_tahunan']['polio4']);
        $file_laporan->getActiveSheet()->setCellValue('S4', $data_dasar['target_tahunan']['campak']);
        $file_laporan->getActiveSheet()->setCellValue('T2', ($data_dasar['target_tahunan']['dpthb3']/12)*$bulan_map[$bulan]);
        $file_laporan->getActiveSheet()->setCellValue('T3', ($data_dasar['target_tahunan']['polio4']/12)*$bulan_map[$bulan]);
        $file_laporan->getActiveSheet()->setCellValue('T4', ($data_dasar['target_tahunan']['campak']/12)*$bulan_map[$bulan]);
        for($i=0;$i<6;$i++){
            $file_laporan->getActiveSheet()->setCellValue('B'.(11+$i), $data_dasar['data_demografi']['desa'][$i]);
            $file_laporan->getActiveSheet()->setCellValue('C'.(11+$i), $data_dasar['data_demografi']['si']['L'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('D'.(11+$i), $data_dasar['data_demografi']['si']['P'][$i]); 
            
            $file_laporan->getActiveSheet()->setCellValue('F'.(11+$i), ($data_kumulatif['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']/$data_dasar['data_demografi']['si']['L'][$i])*100);
            $file_laporan->getActiveSheet()->setCellValue('G'.(11+$i), ($data_kumulatif['dpthb3'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']/$data_dasar['data_demografi']['si']['P'][$i])*100);
            
            $file_laporan->getActiveSheet()->setCellValue('P'.(11+$i), ($data_kumulatif['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']/$data_dasar['data_demografi']['si']['L'][$i])*100);
            $file_laporan->getActiveSheet()->setCellValue('Q'.(11+$i), ($data_kumulatif['polio4'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']/$data_dasar['data_demografi']['si']['P'][$i])*100);
            
            $file_laporan->getActiveSheet()->setCellValue('Z'.(11+$i), ($data_kumulatif['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']/$data_dasar['data_demografi']['si']['L'][$i])*100);
            $file_laporan->getActiveSheet()->setCellValue('AA'.(11+$i), ($data_kumulatif['campak'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']/$data_dasar['data_demografi']['si']['P'][$i])*100);
        }
        
        $savedFileName = 'PWS-VAKSINATOR-TABEL_ANALISA-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($file_laporan,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function downloadLaporanUci($bulan, $tahun, $kecamatan){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        if($kecamatan=='sengkol'){
            $user_village = ['gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
        }elseif($kecamatan=='janapria'){
            $user_village = ['field_test2'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria'];
        }
        
        $data_dasar = $this->getDataDasar($tahun,$kecamatan);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = APPPATH."download/vaksinator/pws/template_uci.xlsx";
        $file_laporan = $objReader->load($path);
        
        $data_bulan_ini = $this->getDataTemplate($kecamatan);
        $data_kumulatif = $this->getDataTemplate($kecamatan);
                
        $startyear = $tahun.'-01';
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        //calculate Imunisasi lengkap data
        $lastyearfromthismonth = date("Y-m", strtotime($startdate." -1 year"));
        $lastyearfromthisjanuari = date("Y-m", strtotime($startyear." -1 year"));
        $databulanini = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthismonth' AND tanggal_lahir < '$enddate'")->result();
        $datakumulatif = $this->db->query("SELECT * FROM registrasi_jurim WHERE tanggal_lahir > '$lastyearfromthisjanuari' AND tanggal_lahir < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $d->jenis_kelamin;
                if($this->cekImunisasiLengkap($d->childId)){
                    if($jk=="laki-laki"||$jk=="male"){
                        $data_bulan_ini['lengkap'][$user_village[$d->userID]]['l'] +=1;   
                    }elseif($jk=="perempuan"||$jk=="female"){
                        $data_bulan_ini['lengkap'][$user_village[$d->userID]]['p'] +=1;
                    }
               }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                $jk = $d->jenis_kelamin;
                if($this->cekImunisasiLengkap($d->childId)){
                    if($jk=="laki-laki"||$jk=="male"){
                        $data_kumulatif['lengkap'][$user_village[$d->userID]]['l'] +=1;   
                    }elseif($jk=="perempuan"||$jk=="female"){
                        $data_kumulatif['lengkap'][$user_village[$d->userID]]['p'] +=1;
                    }
               }
            }
        }
        
        $file_laporan->getActiveSheet()->setCellValue('C2', $data_dasar['jml_desa']);
        $file_laporan->getActiveSheet()->setCellValue('C3', $data_dasar['puskesmas']);
        $file_laporan->getActiveSheet()->setCellValue('C4', $data_dasar['kabupaten']);
        $file_laporan->getActiveSheet()->setCellValue('C5', $data_dasar['tahun']);
        $file_laporan->getActiveSheet()->setCellValue('D7', "s/d ".strtoupper($bulan).", Per-tanggal:");
        for($i=0;$i<6;$i++){
            $file_laporan->getActiveSheet()->setCellValue('B'.(9+$i), $data_dasar['data_demografi']['desa'][$i]);
            $file_laporan->getActiveSheet()->setCellValue('C'.(9+$i), $data_dasar['data_demografi']['si']['L'][$i]+$data_dasar['data_demografi']['si']['P'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('D'.(9+$i), $data_bulan_ini['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['l']+$data_bulan_ini['lengkap'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['p']);
        }
        
        $savedFileName = 'PWS-VAKSINATOR-TABEL_DESA_UCI-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($file_laporan,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function downloadLaporanTT($bulan, $tahun, $kecamatan){
        $bidanDB = $this->load->database('analytics', TRUE);
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        if($kecamatan=='sengkol'){
            $user_village = ['user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        }elseif($kecamatan=='janapria'){
            $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria'];
        }
        
        $data_dasar = $this->getDataDasar($tahun,$kecamatan);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = APPPATH."download/vaksinator/pws/template_bulanan_tt.xlsx";
        $file_laporan = $objReader->load($path);
        
        $data_bulan_ini = $this->getVaksinTTTemplate($kecamatan);
        $data_kumulatif = $this->getVaksinTTTemplate($kecamatan);
                
        $startyear = $tahun.'-01';
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        
        //get TT data
        $databulanini = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startdate' AND ancDate < '$enddate'")->result();
        $datakumulatif = $bidanDB->query("SELECT * FROM kartu_anc_visit WHERE ancDate > '$startyear' AND ancDate < '$enddate'")->result();
        
        foreach ($databulanini as $d){
            if(array_key_exists($d->userID, $user_village)){
                if($d->statusImunisasitt=="tt_ke_0"){
                    $data_bulan_ini['bumil'][$user_village[$d->userID]]['tt1'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_1"){
                    $data_bulan_ini['bumil'][$user_village[$d->userID]]['tt2'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_2"){
                    $data_bulan_ini['bumil'][$user_village[$d->userID]]['tt3'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_3"){
                    $data_bulan_ini['bumil'][$user_village[$d->userID]]['tt4'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_4"){
                    $data_bulan_ini['bumil'][$user_village[$d->userID]]['tt5'] +=1; 
                }
            }
        }
        
        foreach ($datakumulatif as $d){
            if(array_key_exists($d->userID, $user_village)){
                if($d->statusImunisasitt=="tt_ke_0"){
                    $data_kumulatif['bumil'][$user_village[$d->userID]]['tt1'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_1"){
                    $data_kumulatif['bumil'][$user_village[$d->userID]]['tt2'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_2"){
                    $data_kumulatif['bumil'][$user_village[$d->userID]]['tt3'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_3"){
                    $data_kumulatif['bumil'][$user_village[$d->userID]]['tt4'] +=1; 
                }elseif($d->statusImunisasitt=="tt_ke_4"){
                    $data_kumulatif['bumil'][$user_village[$d->userID]]['tt5'] +=1; 
                }
            }
        }
        
        $file_laporan->getActiveSheet()->setCellValue('C2', $data_dasar['jml_desa']);
        $file_laporan->getActiveSheet()->setCellValue('C3', $data_dasar['puskesmas']);
        $file_laporan->getActiveSheet()->setCellValue('C4', $data_dasar['kabupaten']);
        $file_laporan->getActiveSheet()->setCellValue('G4', strtoupper($bulan));
        $file_laporan->getActiveSheet()->setCellValue('J4', $data_dasar['tahun']);
        for($i=0;$i<6;$i++){
            $file_laporan->getActiveSheet()->setCellValue('B'.(10+$i), $data_dasar['data_demografi']['desa'][$i]); 
            $file_laporan->getActiveSheet()->setCellValue('C'.(10+$i), $data_dasar['data_demografi']['wus_hamil'][$i]);
            
            $file_laporan->getActiveSheet()->setCellValue('D'.(10+$i), $data_bulan_ini['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt1']);
            $file_laporan->getActiveSheet()->setCellValue('H'.(10+$i), $data_bulan_ini['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt2']);
            $file_laporan->getActiveSheet()->setCellValue('L'.(10+$i), $data_bulan_ini['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt3']);
            $file_laporan->getActiveSheet()->setCellValue('P'.(10+$i), $data_bulan_ini['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt4']);
            $file_laporan->getActiveSheet()->setCellValue('T'.(10+$i), $data_bulan_ini['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt5']);
            
            $file_laporan->getActiveSheet()->setCellValue('F'.(10+$i), $data_kumulatif['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt1']);
            $file_laporan->getActiveSheet()->setCellValue('J'.(10+$i), $data_kumulatif['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt2']);
            $file_laporan->getActiveSheet()->setCellValue('N'.(10+$i), $data_kumulatif['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt3']);
            $file_laporan->getActiveSheet()->setCellValue('R'.(10+$i), $data_kumulatif['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt4']);
            $file_laporan->getActiveSheet()->setCellValue('V'.(10+$i), $data_kumulatif['bumil'][ucwords(strtolower($data_dasar['data_demografi']['desa'][$i]))]['tt5']);
        }
        
        $bln_ini = ['D','H','L','P','T','Y','AC','AG','AK','AO','AS','AW','BA','BE','BI','BM'];
        $sd_bln_ini = ['F','J','N','R','V','AA','AE','AI','AM','AQ','AU','AY','BC','BG','BK','BO'];
        foreach ($bln_ini as $x=>$v){
            $file_laporan->getActiveSheet()->setCellValue($v.'7', "BLN ".substr(strtoupper($bulan),0,3));
            $file_laporan->getActiveSheet()->setCellValue($sd_bln_ini[$x].'7', "S/D BLN ".substr(strtoupper($bulan),0,3));
        }
        
        $savedFileName = 'PWS-VAKSINATOR-TABEL_IMUNISASI_TT-'.strtoupper($kecamatan).'-'.strtoupper($bulan).'-'.strtoupper($tahun).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($file_laporan,'Excel2007');
        $saveContainer->save('php://output');
    }

    public function pwsBulanIni($bulan,$tahun,$kecamatan,$form){
        if($form=="bulanan"){
            $this->downloadLaporanBulanan($bulan, $tahun, $kecamatan);
        }elseif($form=="analisa"){
            $this->downloadLaporanAnalisa($bulan, $tahun, $kecamatan);
        }elseif($form=="uci"){
            $this->downloadLaporanUci($bulan, $tahun, $kecamatan);
        }elseif($form=="tt"){
            $this->downloadLaporanTT($bulan, $tahun, $kecamatan);
        }
    }
    
    
}