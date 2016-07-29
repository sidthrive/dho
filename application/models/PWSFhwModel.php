<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PWSFhwModel extends CI_Model{
    private $dusun =    ['user1' =>array("Lekor+Timur"=>"Lekor Timur","Lekor+Barat"=>"Lekor Barat","Sondo"=>"Sondo","Gulung"=>"Gulung","Pepao+Timur"=>"Pepao Timur","Lengkok+Bunut"=>"Lengkok Bunut","Lendang+Jawe"=>"Lendang Jawe","Pepao+Barat+I"=>"Pepao Barat I","Presak"=>"Presak","Taken-Aken"=>"Taken Aken","Pepao+Barat+II"=>"Pepao Barat II","Renge"=>"Renge","Pelapak"=>"Pelapak","Walun"=>"Walun","Montong+Bile"=>"Montong Bile","Lainnya"=>"Lainnya")
                        ,'user2' =>array("Jembe+Barat"=>"Jembe Barat","Jembe+Timur"=>"Jembe Timur","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Janggawana"=>"Janggawana","Sengkerek"=>"Sengkerek","Lingkok+Buak+Barat"=>"Lingkok Buak Barat","Lingkok+Buak+Tengah"=>"Lingkok Buak Tengah","Lingkok+Buak+Timur"=>"Lingkok Buak Timur","Melati"=>"Melati","Selek"=>"Selek","Gundu"=>"Gundu","Masjawa"=>"Masjawa","Presak+Sanggeng"=>"Presak Sanggeng","Tentram"=>"Tentram","Terentem"=>"Terentem","Keruak"=>"Keruak","Keruak Utara"=>"Keruak Utara","Masjaya"=>"Masjaya","Presak Sanggeng"=>"Presak Sanggeng","Janggawana+Selatan"=>"Janggawana Selatan","Janggawana+Utara"=>"Janggawana Utara","Janggawana+Tengah"=>"Janggawana Tengah","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Utara"=>"Jembe Utara","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur","Lingkok Buak Tengah"=>"Lingkok Buak Tengah","Lingkok Buak Timur"=>"Lingkok Buak Timur","Lainnya"=>"Lainnya")
                        ,'user3' =>array("Montor"=>"Montor","Pendem"=>"Pendem","Piling"=>"Piling","Maliklo"=>"Maliklo","Jelitong"=>"Jelitong","Karang+Majelo"=>"Karang Majelo","Penuntut"=>"Penuntut","Kuang"=>"Kuang","Jangka"=>"Jangka","Petorok"=>"Petorok","Gelung"=>"Gelung","Gelondong"=>"Gelondong","Nyangget"=>"Nyangget","Montong+Bile"=>"Montong Bile","Lekong+Bangkon"=>"Lekong Bangkon","Lainnya"=>"Lainnya")
                        ,'user4' =>array("Juna"=>"Juna","Nunang"=>"Nunang","Batu+Belek"=>"Batu Belek","Siwi"=>"Siwi","Setuta+Barat"=>"Setuta Barat","Setuta+Timur"=>"Setuta Timur","Liwung"=>"Liwung","Liwung_Selatan"=>"Liwung Selatan","Biletawah"=>"Biletawah","Liwung+Satu"=>"Liwung Satu","Liwung+Dua"=>"Liwung Dua","Nunang+Selatan"=>"Nunang Selatan","Lainnya"=>"Lainnya")
                        ,'user5' =>array("Rungkang+Timur"=>"Rungkang Timur","Rungkang+Barat"=>"Rungkang Barat","Puntik+Baru"=>"Puntik Baru","Jango+Selatan"=>"Jango Selatan","Janggo+Utara"=>"Jango Utara","Kenyalu+Utara"=>"Kenyalu Utara","Kenyalu+Barat"=>"Kenyalu Barat","Kenyalu+Selatan"=>"Kenyalu Selatan","Kenyalu+Timur"=>"Kenyalu Timur","Kampung+Baru"=>"Kampung Baru","Arba"=>"Arba","Gerepek"=>"Gerepek","Jango+Utara"=>"Jango Utara","Lainnya"=>"Lainnya")
                        ,'user6' =>array("Janapria"=>"Janapria","Lemokek"=>"Lemokek","Tempek-Empek"=>"Tempek Empek","Batu+Bangus"=>"Batu Bangus","Nunang+I"=>"Nunang I","Perok+Timur"=>"Perok Timur","Batu+Kembar+II"=>"Batu Kembar II","Batu+Kembar+I"=>"Batu Kembar I","Pengebat"=>"Pengebat","Sadah"=>"Sadah","Penambong"=>"Penambong","Tonjong"=>"Tonjong","Pendem"=>"Pendem","Perok+Barat"=>"Perok Barat","Lambah+Olot"=>"Lambah Olot","Lainnya"=>"Lainnya")
                        ,'user8' =>array("Dese"=>"Dese","Abe"=>"Abe","Sampet"=>"Sampet","Ketara"=>"Ketara","Sempalan"=>"Sempalan","Selak"=>"Selak","Dayen+Rurung"=>"Dayen Rurung","Embung+Rungkas"=>"Embung Rungkas","Reban"=>"Reban","Plangsang"=>"Plangsang","Lebak"=>"Lebak","Bagek+Payung"=>"Bagek Payung","bagek payung"=>"Bagek Payung","Sarah"=>"Sarah","Bagek+Dewe"=>"Bagek Dewe","Perigi"=>"Perigi","Bagek Dewe"=>"Bagek Dewe","Lainnya"=>"Lainnya")
                        ,'user9' =>array("Piyang"=>"Piyang","Belong"=>"Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'user10'=>array("Piyang"=>"Piyang","Belong"=>"Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'user11'=>array("Karang+Jangkong"=>"Karang Jangkong","Gilik"=>"Gilik","Karang+Daye"=>"Karang Daye","Balen+Along"=>"Balen Along","Bale+Montong+I"=>"Bale Montong I","Gubuk+Direk"=>"Gubuk Direk","Pengadang"=>"Pengadang","Sarang+Angin"=>"Sarang Angin","Dayen+Kubur"=>"Dayen Kubur","Bale+Montong+II"=>"Bale Montong II","Gonjong"=>"Gonjong","Gampung"=>"Gampung","Taman+Bumi+Gora"=>"Taman Bumi Gora","Buntereng"=>"Buntereng","Wareng"=>"Wareng","Pance"=>"Pance","Bumi+Gora"=>"Bumi Gora","Batu+Bangke"=>"Batu Bangke","Bumi Gora"=>"Bumi Gora","Bale Montong I"=>"Bale Montong I","Balen Along"=>"Balen Along","Bale Montong II"=>"Bale Montong II","Lainnya"=>"Lainnya")
                        ,'user12'=>array("Lenser"=>"Lenser","Tanak+Awu+Bat"=>"Tanak Awu Bat","Selawang"=>"Selawang","Toro"=>"Toro","Tanak+Awu+I"=>"Tanak Awu I","Singe"=>"Singe","Tongkek"=>"Tongkek","Perendik"=>"Perendik","Bale+Bowo"=>"Bale Bowo","Gantang+Daye"=>"Gantang Daye","Tanak+Awu+II"=>"Tanak Awu II","Rebile"=>"Rebile","Tatak"=>"Tatak","Reak+II"=>"Reak II","Reak+I"=>"Reak I","Piyang"=>"Piyang","Gantang+Lauk"=>"Gantang Lauk","Batu+Butir"=>"Batu Butir","Penujak"=>"Penujak","Jambek"=>"Jambek","Gantang+Bat"=>"Gantang Bat","Gantang+Timuk"=>"Gantang Timuk","Lebak"=>"Lebak","Bongkem"=>"Bongkem","Kekale"=>"Kekale","Pelangsang"=>"Pelangsang","Gunung+Kosong"=>"Gunung Kosong","Mangkung"=>"Mangkung","Tamping"=>"Tamping","semayan"=>"Semayan","Tolot+Tolot"=>"Tolot Tolot","Gubuk+Baru"=>"Gubuk Baru","Gemel"=>"Gemel","Sengkol+II"=>"Sengkol II","Kapak"=>"Kapak","Tanpok"=>"Tanpok","Selawang+Timuq"=>"Selawang Timuq","Selawang+Bat"=>"Selawang Bat","Jambek+II"=>"Jambek II","Jambek+I"=>"Jambek I","Gantang Daye"=>"Gantang Daye","Tanak Awu Bat"=>"Tanak Awu Bat","Reak I"=>"Reak I","Reak II"=>"Reak II","Selawang Timuq"=>"Selawang Timuq","Gantang Bat"=>"Gantang Bat","Jambek II"=>"Jambek II","Jambek I"=>"Jambek I","Tanak Awu II"=>"Tanak Awu II","Gantang Lauk"=>"Gantang Lauk","Tanak Awu I"=>"Tanak Awu I","Lainnya"=>"Lainnya")
                        ,'user13'=>array("Pengembur+III"=>"Pengembur III","Pelangi"=>"Pelangi","Rajan"=>"Rajan","Melati"=>"Melati","Tamping"=>"Tamping","Mawar"=>"Mawar","Bunga+Seroja"=>"Bunga Seroja","Sepit"=>"Sepit","Penyampi"=>"Penyampi","Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat","Tawah"=>"Tawah","Pengembur+II"=>"Pengembur II","Sinah"=>"Sinah","Pengembur+I"=>"Pengembur I","Batu+Belek"=>"Batu Belek","Pengembur I"=>"Pengembur I","Batu Belek"=>"Batu Belek","Pengembur II"=>"Pengembur II","Pengembur III"=>"Pengembur III","Lainnya"=>"Lainnya")
                        ,'user14'=>array("Anak+Anjan"=>"Anak Anjan","Penupi"=>"Penupi","Kadik+I"=>"Kadik I","Karang+baru"=>"Karang Baru","Tenang"=>"Tenang","Lamben"=>"Lamben","Tuban"=>"Tuban","Segale"=>"Segale","Tenang+Baru"=>"Tenang Baru","Kadik+II"=>"Kadik II","Anak Anjan"=>"Anak Anjan","Kadik II"=>"Kadik II","Dasan Duah"=>"Dasan Duah","Lainnya"=>"Lainnya")];
    
    private $listdusun = ['user1'=>array("Lekor Timur","Lekor Barat","Sondo","Gulung","Pepao Timur","Lengkok Bunut","Lendang Jawe","Pepao Barat I","Presak","Taken Aken","Pepao Barat II","Renge","Pelapak","Walun","Montong Bile")
                        ,'user2'=>array("Jembe Barat","Jembe Timur","Jembe Utara","Pengempok","Suangke","Janggawana","Sengkerek","Lingkok Buak Barat","Lingkok Buak Tengah","Lingkok Buak Timur","Melati","Selek","Gundu","Masjawa","Presak Sanggeng","Tentram","Terentem","Keruak","Keruak Utara","Masjaya","Janggawana Selatan","Janggawana Utara","Janggawana Tengah")
                        ,'user3'=>array("Montor","Pendem","Piling","Maliklo","Jelitong","Karang Majelo","Penuntut","Kuang","Jangka","Petorok","Gelung","Gelondong","Nyangget","Montong Bile","Lekong Bangkon")
                        ,'user4'=>array("Juna","Nunang","Batu Belek","Siwi","Setuta Barat","Setuta Timur","Liwung","Liwung Selatan","Biletawah","Liwung Satu","Liwung Dua","Nunang Selatan")
                        ,'user5'=>array("Rungkang Timur","Rungkang Barat","Puntik Baru","Jango Selatan","Jango Utara","Kenyalu Utara","Kenyalu Barat","Kenyalu Selatan","Kenyalu Timur","Kampung Baru","Arba","Gerepek")
                        ,'user6'=>array("Janapria","Lemokek","Tempek Empek","Batu Bangus","Nunang I","Perok Timur","Batu Kembar II","Batu Kembar I","Pengebat","Sadah","Penambong","Tonjong","Pendem","Perok Barat","Lambah Olot")
                        ,'user8'=>array("Dese","Abe","Sampet","Ketara","Sempalan","Selak","Dayen Rurung","Embung Rungkas","Reban","Plangsang","Lebak","Bagek Payung","Sarah","Bagek Dewe","Perigi")
                        ,'user9'=>array("Piyang","Belong","Sengkol I","Gentang","Sekong","Sedo","Kekale","Tajuk","Puji Rahayu","Junge","Sereneng","Kale","Sengkol II","Pesarih","Penambong","Peresak","Senundal","Soweng")
                        ,'user10'=>array("Piyang","Belong","Sengkol I","Gentang","Sekong","Sedo","Kekale","Tajuk","Puji Rahayu","Junge","Sereneng","Kale","Sengkol II","Pesarih","Penambong","Peresak","Senundal","Soweng")
                        ,'user11'=>array("Karang Jangkong","Gilik","Karang Daye","Bale Montong I","Gubuk Direk","Pengadang","Sarang Angin","Dayen Kubur","Bale Montong II","Gonjong","Gampung","Taman Bumi Gora","Buntereng","Wareng","Pance","Batu Bangke","Bumi Gora","Balen Along")
                        ,'user12'=>array("Lenser","Selawang","Toro","Singe","Tongkek","Perendik","Bale Bowo","Rebile","Tatak","Reak I","Reak II","Piyang","Batu Butir","Penujak","Jambek","Gantang Bat","Gantang Timuk","Lebak","Bongkem","Kekale","Pelangsang","Gunung Kosong","Mangkung","Tamping","Semayan","Tolot Tolot","Gubuk Baru","Gemel","Sengkol II","Kapak","Tanpok","Selawang Timuq","Selawang Bat","Jambek II","Jambek I","Gantang Daye","Tanak Awu Bat","Tanak Awu II","Gantang Lauk","Tanak Awu I")
                        ,'user13'=>array("Pengembur III","Pelangi","Rajan","Melati","Tamping","Mawar","Bunga Seroja","Sepit","Penyampi","Siwang","Perigi","Keramat","Tawah","Pengembur II","Sinah","Pengembur I","Batu Belek")
                        ,'user14'=>array("Anak Anjan","Penupi","Kadik I","Karang Baru","Tenang","Lamben","Tuban","Segale","Tenang Baru","Kadik II","Dasan Duah")];
    private $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    public function listdusun(){
        return $this->listdusun;
    }
    public function kia1($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['cakupan_k1_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['cakupan_k1_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['cakupan_k4_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['cakupan_k4_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['cakupan_resiko_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['cakupan_resiko_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']= array();
        $result_index['cakupan_k1_bulan_lalu']=array();
        $result_index['cakupan_k1_bulan_ini']=array();
        $result_index['cakupan_k4_bulan_lalu']=array();
        $result_index['cakupan_k4_bulan_ini']=array();
        $result_index['cakupan_resiko_bulan_lalu']=array();
        $result_index['cakupan_resiko_bulan_ini']=array();
        $col = ['B','G','H','L','M','Q','R'];
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            array_push($result_index['cakupan_k1_bulan_lalu'],$col[1].$num);
            array_push($result_index['cakupan_k1_bulan_ini'],$col[2].$num);
            array_push($result_index['cakupan_k4_bulan_lalu'],$col[3].$num);
            array_push($result_index['cakupan_k4_bulan_ini'],$col[4].$num);
            array_push($result_index['cakupan_resiko_bulan_lalu'],$col[5].$num);
            array_push($result_index['cakupan_resiko_bulan_ini'],$col[6].$num);
            $num++;
        }
        
        try {
            $datak1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu1_k1.xlsx','A2:E112');
            $datak4 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu1_k4.xlsx','A2:E112');
            $dataresiko = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu1_resiko.xlsx','A2:E112');
            //$datak1 = $this->PHPExcelModel->showEntireData('download/pws_source_dusun/pws_ibu1_k1.xlsx');
            //var_dump($dataresiko);
            foreach ($datak1 as $k1){
                if($k1['A']==null) continue;
                if(array_key_exists($k1['A'],$listdusun)){
                    $key=array_search($listdusun[$k1['A']],$result['dusun']);
                    $result['cakupan_k1_bulan_lalu'][$key] += (int)$k1['B'];
                    $result['cakupan_k1_bulan_ini'][$key] += (int)$k1['C'];
                }
            }
            foreach ($datak4 as $k4){
                if($k4['A']==null) continue;
                if(array_key_exists($k4['A'],$listdusun)){
                    $key=array_search($listdusun[$k4['A']],$result['dusun']);
                    $result['cakupan_k4_bulan_lalu'][$key] += (int)$k4['B'];
                    $result['cakupan_k4_bulan_ini'][$key] += (int)$k4['C'];
                }
            }
            foreach ($dataresiko as $resiko){
                if($resiko['A']==null) continue;
                if(array_key_exists($resiko['A'],$listdusun)){
                    $key=array_search($listdusun[$resiko['A']],$result['dusun']);
                    $result['cakupan_resiko_bulan_lalu'][$key] += (int)$resiko['B'];
                    $result['cakupan_resiko_bulan_ini'][$key] += (int)$resiko['C'];
                }
            }
            
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    public function kia2($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['komplikasi_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['komplikasi_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7"); 
       
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['komplikasi_bulan_lalu']=array();
        $result_index['komplikasi_bulan_ini']=array();
        $col = ['B','G','H'];
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            array_push($result_index['komplikasi_bulan_lalu'],$col[1].$num);
            array_push($result_index['komplikasi_bulan_ini'],$col[2].$num);
            $num++;
        }
        
        try {
            $datakomp = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu2_komplikasi.xlsx','A2:E112');
            
            foreach ($datakomp as $komp){
                if($komp['A']==null) continue;
                if(array_key_exists($komp['A'],$listdusun)){
                    $key=array_search($listdusun[$komp['A']],$result['dusun']);
                    $result['komplikasi_bulan_lalu'][$key] += (int)$komp['B'];
                    $result['komplikasi_bulan_lalu'][$key] += (int)$komp['C'];
                }
            }
            
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu2.xlsx",$result,$result_index);
    }
    
    public function kia3($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['linakes_L_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['linakes_P_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['linakes_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['linakes_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['nolinakes_L_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['nolinakes_P_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['nolinakes_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['nolinakes_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['linakes_L_bulan_lalu']=array();
        $result_index['linakes_P_bulan_lalu']=array();
        $result_index['linakes_L_bulan_ini']=array();
        $result_index['linakes_P_bulan_ini']=array();
        $result_index['nolinakes_L_bulan_lalu']=array();
        $result_index['nolinakes_P_bulan_lalu']=array();
        $result_index['nolinakes_L_bulan_ini']=array();
        $result_index['nolinakes_P_bulan_ini']=array();
        $col = ['B','G','H','J','K','P','Q','S','T'];
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            array_push($result_index['linakes_L_bulan_lalu'],$col[1].$num);
            array_push($result_index['linakes_P_bulan_lalu'],$col[2].$num);
            array_push($result_index['linakes_L_bulan_ini'],$col[3].$num);
            array_push($result_index['linakes_P_bulan_ini'],$col[4].$num);
            array_push($result_index['nolinakes_L_bulan_lalu'],$col[5].$num);
            array_push($result_index['nolinakes_P_bulan_lalu'],$col[6].$num);
            array_push($result_index['nolinakes_L_bulan_ini'],$col[7].$num);
            array_push($result_index['nolinakes_P_bulan_ini'],$col[8].$num);
            $num++;
        }
        
        try {
            $datalinakes = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu2_linakes.xlsx','A2:E112');
            $datanolinakes = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu3_lin_non_nakes.xlsx','A2:E112');
            
            foreach ($datalinakes as $lin){
                if($lin['A']==null) continue;
                if(array_key_exists($lin['A'],$listdusun)){
                    $key=array_search($listdusun[$lin['A']],$result['dusun']);
                    $result['linakes_L_bulan_lalu'][$key] += (int)$lin['B'];
                    $result['linakes_P_bulan_lalu'][$key] += (int)$lin['D'];
                    $result['linakes_L_bulan_ini'][$key] += (int)$lin['C'];
                    $result['linakes_P_bulan_ini'][$key] += (int)$lin['E'];
                }
            }
            foreach ($datanolinakes as $nonlin){
                if($nonlin['A']==null) continue;
                if(array_key_exists($nonlin['A'],$listdusun)){
                    $key=array_search($listdusun[$nonlin['A']],$result['dusun']);
                    $result['nolinakes_L_bulan_lalu'][$key] += (int)$nonlin['B'];
                    $result['nolinakes_P_bulan_lalu'][$key] += (int)$nonlin['D'];
                    $result['nolinakes_L_bulan_ini'][$key] += (int)$nonlin['C'];
                    $result['nolinakes_P_bulan_ini'][$key] += (int)$nonlin['E'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu3.xlsx",$result,$result_index);
    }
    
    public function kia4($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['fasilitas_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['fasilitas_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['k_nifas_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['k_nifas_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['fasilitas_bulan_lalu']=array();
        $result_index['fasilitas_bulan_ini']=array();
        $result_index['k_nifas_bulan_lalu']=array();
        $result_index['k_nifas_bulan_ini']=array();
        $col = ['B','G','H','L','M'];
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            array_push($result_index['fasilitas_bulan_lalu'],$col[1].$num);
            array_push($result_index['fasilitas_bulan_ini'],$col[2].$num);
            array_push($result_index['k_nifas_bulan_lalu'],$col[3].$num);
            array_push($result_index['k_nifas_bulan_ini'],$col[4].$num);
            $num++;
        }
        
        try {
            $datafasilitas = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu3_lin_faskes.xlsx','A2:E112');
            $datanifas = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu4_kunjungan_nifas.xlsx','A2:E112');
            
            foreach ($datafasilitas as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['fasilitas_bulan_lalu'][$key] += (int)$temp['B'];
                    $result['fasilitas_bulan_ini'][$key] += (int)$temp['C'];
                }
            }
            foreach ($datanifas as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['k_nifas_bulan_lalu'][$key] += (int)$temp['B'];
                    $result['k_nifas_bulan_ini'][$key] += (int)$temp['C'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    public function kia5($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['anemia_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['anemia_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kek_bulan_lalu'] = array_fill(0,count($result['dusun']),0);
        $result['kek_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['anemia_bulan_lalu']=array();
        $result_index['anemia_bulan_ini']=array();
        $result_index['kek_bulan_lalu']=array();
        $result_index['kek_bulan_ini']=array();
        $col = ['B','G','H','K','L'];
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            array_push($result_index['anemia_bulan_lalu'],$col[1].$num);
            array_push($result_index['anemia_bulan_ini'],$col[2].$num);
            array_push($result_index['kek_bulan_lalu'],$col[3].$num);
            array_push($result_index['kek_bulan_ini'],$col[4].$num);
            $num++;
        }
        
        try {
            $dataanemia = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu5_bumil_anemia.xlsx','A2:E112');
            $datakek = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_ibu5_bumil_kek.xlsx','A2:E112');
            
            foreach ($dataanemia as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['anemia_bulan_lalu'][$key] += (int)$temp['B'];
                    $result['anemia_bulan_ini'][$key] += (int)$temp['C'];
                }
            }
            foreach ($datakek as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['kek_bulan_lalu'][$key] += (int)$temp['B'];
                    $result['kek_bulan_ini'][$key] += (int)$temp['C'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu5.xlsx",$result,$result_index);
    }
    
    public function bayi($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['kasus1_L_bulan_ini']=array();
        $result_index['kasus1_P_bulan_ini']=array();
        $result_index['kasus1_L_komulatif']=array();
        $result_index['kasus1_P_komulatif']=array();
        $result_index['mati1_L_bulan_ini']=array();
        $result_index['mati1_P_bulan_ini']=array();
        $result_index['mati1_L_komulatif']=array();
        $result_index['mati1_P_komulatif']=array();
        
        $result_index['kasus2_L_bulan_ini']=array();
        $result_index['kasus2_P_bulan_ini']=array();
        $result_index['kasus2_L_komulatif']=array();
        $result_index['kasus2_P_komulatif']=array();
        $result_index['mati2_L_bulan_ini']=array();
        $result_index['mati2_P_bulan_ini']=array();
        $result_index['mati2_L_komulatif']=array();
        $result_index['mati2_P_komulatif']=array();
        $col = ['B','C','D','F','G','I','J','L','M','O','P','R','S','U','V','X','Y'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['kasus1_L_bulan_ini'],$col[1].$num);
            array_push($result_index['kasus1_P_bulan_ini'],$col[2].$num);
            array_push($result_index['kasus1_L_komulatif'],$col[3].$num);
            array_push($result_index['kasus1_P_komulatif'],$col[4].$num);
            array_push($result_index['mati1_L_bulan_ini'],$col[5].$num);
            array_push($result_index['mati1_P_bulan_ini'],$col[6].$num);
            array_push($result_index['mati1_L_komulatif'],$col[7].$num);
            array_push($result_index['mati1_P_komulatif'],$col[8].$num);
            
            array_push($result_index['kasus2_L_bulan_ini'],$col[9].$num);
            array_push($result_index['kasus2_P_bulan_ini'],$col[10].$num);
            array_push($result_index['kasus2_L_komulatif'],$col[11].$num);
            array_push($result_index['kasus2_P_komulatif'],$col[12].$num);
            array_push($result_index['mati2_L_bulan_ini'],$col[13].$num);
            array_push($result_index['mati2_P_bulan_ini'],$col[14].$num);
            array_push($result_index['mati2_L_komulatif'],$col[15].$num);
            array_push($result_index['mati2_P_komulatif'],$col[16].$num);
            
            $num++;
        }
        
        try {
            if($form=='bayi_1'){
                $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/bayi1_ispa.xlsx','A2:E112');
                $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/bayi1_diare.xlsx','A2:E112');    
            }elseif($form=='bayi_2'){
                $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/bayi2_campak.xlsx','A2:E112');
                $data2 = array();
            }elseif($form=='bayi_3'){
                $data1 = array();
                $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/bayi3_gizi_buruk.xlsx','A2:E112'); 
            }elseif($form=='bayi_4'){
                $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/bayi4_lain_lain.xlsx','A2:E112');
                $data2 = array(); 
            }
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
//                    $result['kasus1_L_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus1_P_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus1_L_komulatif'][$key] += (int)$temp[''];
//                    $result['kasus1_P_komulatif'][$key] += (int)$temp[''];
                    $result['mati1_L_bulan_ini'][$key] += (int)$temp['B'];
                    $result['mati1_P_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati1_L_komulatif'][$key] += (int)$temp['E'];
                    $result['mati1_P_komulatif'][$key] += (int)$temp['F'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
//                    $result['kasus2_L_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus2_P_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus2_L_komulatif'][$key] += (int)$temp[''];
//                    $result['kasus2_P_komulatif'][$key] += (int)$temp[''];
                    $result['mati2_L_bulan_ini'][$key] += (int)$temp['B'];
                    $result['mati2_P_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati2_L_komulatif'][$key] += (int)$temp['E'];
                    $result['mati2_P_komulatif'][$key] += (int)$temp['F'];
                }
            }
            
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function balita($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['kasus1_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['kasus1_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati1_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        
        $result['kasus2_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['kasus2_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_L_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_P_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_L_komulatif'] = array_fill(0,count($result['dusun']),0);
        $result['mati2_P_komulatif'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['kasus1_L_bulan_ini']=array();
        $result_index['kasus1_P_bulan_ini']=array();
        $result_index['kasus1_L_komulatif']=array();
        $result_index['kasus1_P_komulatif']=array();
        $result_index['mati1_L_bulan_ini']=array();
        $result_index['mati1_P_bulan_ini']=array();
        $result_index['mati1_L_komulatif']=array();
        $result_index['mati1_P_komulatif']=array();
        
        $result_index['kasus2_L_bulan_ini']=array();
        $result_index['kasus2_P_bulan_ini']=array();
        $result_index['kasus2_L_komulatif']=array();
        $result_index['kasus2_P_komulatif']=array();
        $result_index['mati2_L_bulan_ini']=array();
        $result_index['mati2_P_bulan_ini']=array();
        $result_index['mati2_L_komulatif']=array();
        $result_index['mati2_P_komulatif']=array();
        $col = ['B','C','D','F','G','I','J','L','M','O','P','R','S','U','V','X','Y'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['kasus1_L_bulan_ini'],$col[1].$num);
            array_push($result_index['kasus1_P_bulan_ini'],$col[2].$num);
            array_push($result_index['kasus1_L_komulatif'],$col[3].$num);
            array_push($result_index['kasus1_P_komulatif'],$col[4].$num);
            array_push($result_index['mati1_L_bulan_ini'],$col[5].$num);
            array_push($result_index['mati1_P_bulan_ini'],$col[6].$num);
            array_push($result_index['mati1_L_komulatif'],$col[7].$num);
            array_push($result_index['mati1_P_komulatif'],$col[8].$num);
            
            array_push($result_index['kasus2_L_bulan_ini'],$col[9].$num);
            array_push($result_index['kasus2_P_bulan_ini'],$col[10].$num);
            array_push($result_index['kasus2_L_komulatif'],$col[11].$num);
            array_push($result_index['kasus2_P_komulatif'],$col[12].$num);
            array_push($result_index['mati2_L_bulan_ini'],$col[13].$num);
            array_push($result_index['mati2_P_bulan_ini'],$col[14].$num);
            array_push($result_index['mati2_L_komulatif'],$col[15].$num);
            array_push($result_index['mati2_P_komulatif'],$col[16].$num);
            $num++;
        }
        
        try {
            if($form=='balita_1'){
                $data1 = array();
                $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/balita1_diare.xlsx','A2:E112');    
            }elseif($form=='balita_2'){
                $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/balita2_campak.xlsx','A2:E112');
                $data2 = array();
            }elseif($form=='balita_3'){
                $data1 = array();
                $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/balita3_gizi_buruk.xlsx','A2:E112'); 
            }elseif($form=='balita_4'){
                $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/balita4_lain_lain.xlsx','A2:E112');
                $data2 = array(); 
            }
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
//                    $result['kasus1_L_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus1_P_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus1_L_komulatif'][$key] += (int)$temp[''];
//                    $result['kasus1_P_komulatif'][$key] += (int)$temp[''];
                    $result['mati1_L_bulan_ini'][$key] += (int)$temp['B'];
                    $result['mati1_P_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati1_L_komulatif'][$key] += (int)$temp['E'];
                    $result['mati1_P_komulatif'][$key] += (int)$temp['F'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
//                    $result['kasus2_L_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus2_P_bulan_ini'][$key] += (int)$temp[''];
//                    $result['kasus2_L_komulatif'][$key] += (int)$temp[''];
//                    $result['kasus2_P_komulatif'][$key] += (int)$temp[''];
                    $result['mati2_L_bulan_ini'][$key] += (int)$temp['B'];
                    $result['mati2_P_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati2_L_komulatif'][$key] += (int)$temp['E'];
                    $result['mati2_P_komulatif'][$key] += (int)$temp['F'];
                }
            }
            
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function maternal($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['kasus_PHM_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus_PHM_kumu'] = array_fill(0,count($result['dusun']),0);
        $result['mati_PHM_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati_PHM_kumu'] = array_fill(0,count($result['dusun']),0);
        
        $result['kasus_pendarahan_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus_pendarahan_kumu'] = array_fill(0,count($result['dusun']),0);
        $result['mati_pendarahan_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati_pendarahan_kumu'] = array_fill(0,count($result['dusun']),0);
        
        $result['kasus_infeksi_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus_infeksi_kumu'] = array_fill(0,count($result['dusun']),0);
        $result['mati_infeksi_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati_infeksi_kumu'] = array_fill(0,count($result['dusun']),0);
        
        $result['kasus_hdk_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['kasus_hdk_kumu'] = array_fill(0,count($result['dusun']),0);
        $result['mati_hdk_bulan_ini'] = array_fill(0,count($result['dusun']),0);
        $result['mati_hdk_kumu'] = array_fill(0,count($result['dusun']),0);
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $result_index['kasus_PHM_bulan_ini']=array();
        $result_index['kasus_PHM_kumu']=array();
        $result_index['mati_PHM_bulan_ini']=array();
        $result_index['mati_PHM_kumu']=array();
        $result_index['kasus_pendarahan_bulan_ini']=array();
        $result_index['kasus_pendarahan_kumu']=array();
        $result_index['mati_pendarahan_bulan_ini']=array();
        $result_index['mati_pendarahan_kumu']=array();
        
        $result_index['kasus_infeksi_bulan_ini']=array();
        $result_index['kasus_infeksi_kumu']=array();
        $result_index['mati_infeksi_bulan_ini']=array();
        $result_index['mati_infeksi_kumu']=array();
        $result_index['kasus_hdk_bulan_ini']=array();
        $result_index['kasus_hdk_kumu']=array();
        $result_index['mati_hdk_bulan_ini']=array();
        $result_index['mati_hdk_kumu']=array();
        $col = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['kasus_PHM_bulan_ini'],$col[1].$num);
            array_push($result_index['kasus_PHM_kumu'],$col[2].$num);
            array_push($result_index['mati_PHM_bulan_ini'],$col[3].$num);
            array_push($result_index['mati_PHM_kumu'],$col[4].$num);
            array_push($result_index['kasus_pendarahan_bulan_ini'],$col[5].$num);
            array_push($result_index['kasus_pendarahan_kumu'],$col[6].$num);
            array_push($result_index['mati_pendarahan_bulan_ini'],$col[7].$num);
            array_push($result_index['mati_pendarahan_kumu'],$col[8].$num);
            
            array_push($result_index['kasus_infeksi_bulan_ini'],$col[9].$num);
            array_push($result_index['kasus_infeksi_kumu'],$col[10].$num);
            array_push($result_index['mati_infeksi_bulan_ini'],$col[11].$num);
            array_push($result_index['mati_infeksi_kumu'],$col[12].$num);
            array_push($result_index['kasus_hdk_bulan_ini'],$col[13].$num);
            array_push($result_index['kasus_hdk_kumu'],$col[14].$num);
            array_push($result_index['mati_hdk_bulan_ini'],$col[15].$num);
            array_push($result_index['mati_hdk_kumu'],$col[16].$num);
            $num++;
        }
        
        try {
            $dataphm = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/amp_perdarahan_hamil_muda.xlsx','A2:E112'); 
            $datapendarahan = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/amp_perdarahan.xlsx','A2:E112'); 
            $datainfeksi = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/amp_infeksi.xlsx','A2:E112'); 
            $datahdk = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/amp_hdk.xlsx','A2:E112'); 
            
            foreach ($dataphm as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['kasus_PHM_bulan_ini'][$key] += (int)$temp['B'];
                    $result['kasus_PHM_kumu'][$key] += (int)$temp['D'];
                    $result['mati_PHM_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati_PHM_kumu'][$key] += (int)$temp['E'];
                }
            }
            foreach ($datapendarahan as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['kasus_pendarahan_bulan_ini'][$key] += (int)$temp['B'];
                    $result['kasus_pendarahan_kumu'][$key] += (int)$temp['D'];
                    $result['mati_pendarahan_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati_pendarahan_kumu'][$key] += (int)$temp['E'];
                }
            }
            foreach ($datainfeksi as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['kasus_infeksi_bulan_ini'][$key] += (int)$temp['B'];
                    $result['kasus_infeksi_kumu'][$key] += (int)$temp['D'];
                    $result['mati_infeksi_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati_infeksi_kumu'][$key] += (int)$temp['E'];
                }
            }
            foreach ($datahdk as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['kasus_hdk_bulan_ini'][$key] += (int)$temp['B'];
                    $result['kasus_hdk_kumu'][$key] += (int)$temp['D'];
                    $result['mati_hdk_bulan_ini'][$key] += (int)$temp['C'];
                    $result['mati_hdk_kumu'][$key] += (int)$temp['E'];
                }
            }
            
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_amp.xlsx",$result,$result_index);
    }
    
    public function neonatal1($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['bblr_1'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_1'] = array();
        $result['bblr_2'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_2'] = array();
        $result['bblr_3'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_3'] = array();
        $result['bblr_4'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_4'] = array();
        $result['bblr_5'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_5'] = array();
        $result['bblr_6'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_6'] = array();
        $result['bblr_7'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_7'] = array();
        $result['bblr_8'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_8'] = array();
        $result['bblr_9'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_9'] = array();
        $result['bblr_10'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_10'] = array();
        $result['bblr_11'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_11'] = array();
        $result['bblr_12'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_12'] = array();
        $result['bblr_13'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_13'] = array();
        $result['bblr_14'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_14'] = array();
        $result['bblr_15'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_15'] = array();
        $result['bblr_16'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_16'] = array();
        $result['bblr_17'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_17'] = array();
        $result['bblr_18'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_18'] = array();
        $result['bblr_19'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_19'] = array();
        
        $result['asfiksia_1'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_1'] = array();
        $result['asfiksia_2'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_2'] = array();
        $result['asfiksia_3'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_3'] = array();
        $result['asfiksia_4'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_4'] = array();
        $result['asfiksia_5'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_5'] = array();
        $result['asfiksia_6'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_6'] = array();
        $result['asfiksia_7'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_7'] = array();
        $result['asfiksia_8'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_8'] = array();
        $result['asfiksia_9'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_9'] = array();
        $result['asfiksia_10'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_10'] = array();
        $result['asfiksia_11'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_11'] = array();
        $result['asfiksia_12'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_12'] = array();
        $result['asfiksia_13'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_13'] = array();
        $result['asfiksia_14'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_14'] = array();
        $result['asfiksia_15'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_15'] = array();
        $result['asfiksia_16'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_16'] = array();
        $result['asfiksia_17'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_17'] = array();
        $result['asfiksia_18'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_18'] = array();
        $result['asfiksia_19'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_19'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN'];
        $num = 13;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['bblr_1'],$col[1].$num);
            array_push($result_index['bblr_2'],$col[2].$num);
            array_push($result_index['bblr_3'],$col[3].$num);
            array_push($result_index['bblr_4'],$col[4].$num);
            array_push($result_index['bblr_5'],$col[5].$num);
            array_push($result_index['bblr_6'],$col[6].$num);
            array_push($result_index['bblr_7'],$col[7].$num);
            array_push($result_index['bblr_8'],$col[8].$num);
            array_push($result_index['bblr_9'],$col[9].$num);
            array_push($result_index['bblr_10'],$col[10].$num);
            array_push($result_index['bblr_11'],$col[11].$num);
            array_push($result_index['bblr_12'],$col[12].$num);
            array_push($result_index['bblr_13'],$col[13].$num);
            array_push($result_index['bblr_14'],$col[14].$num);
            array_push($result_index['bblr_15'],$col[15].$num);
            array_push($result_index['bblr_16'],$col[16].$num);
            array_push($result_index['bblr_17'],$col[17].$num);
            array_push($result_index['bblr_18'],$col[18].$num);
            array_push($result_index['bblr_19'],$col[19].$num);
            
            array_push($result_index['asfiksia_1'],$col[20].$num);
            array_push($result_index['asfiksia_2'],$col[21].$num);
            array_push($result_index['asfiksia_3'],$col[22].$num);
            array_push($result_index['asfiksia_4'],$col[23].$num);
            array_push($result_index['asfiksia_5'],$col[24].$num);
            array_push($result_index['asfiksia_6'],$col[25].$num);
            array_push($result_index['asfiksia_7'],$col[26].$num);
            array_push($result_index['asfiksia_8'],$col[27].$num);
            array_push($result_index['asfiksia_9'],$col[28].$num);
            array_push($result_index['asfiksia_10'],$col[29].$num);
            array_push($result_index['asfiksia_11'],$col[30].$num);
            array_push($result_index['asfiksia_12'],$col[31].$num);
            array_push($result_index['asfiksia_13'],$col[32].$num);
            array_push($result_index['asfiksia_14'],$col[33].$num);
            array_push($result_index['asfiksia_15'],$col[34].$num);
            array_push($result_index['asfiksia_16'],$col[35].$num);
            array_push($result_index['asfiksia_17'],$col[36].$num);
            array_push($result_index['asfiksia_18'],$col[37].$num);
            array_push($result_index['asfiksia_19'],$col[38].$num);
            $num++;
        }
        
        try {
            $databblr = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/neonatal1_bblr.xlsx','A2:E112'); 
            $dataasfiksia = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/neonatal1_asfiksia.xlsx','A2:E112'); 
            
            foreach ($databblr as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['bblr_1'][$key] += (int)$temp['B'];
                    $result['bblr_2'][$key] += (int)$temp['C'];
                    $result['bblr_3'][$key] += (int)$temp['D'];
                    $result['bblr_4'][$key] += (int)$temp['E'];
                    $result['bblr_5'][$key] += (int)$temp['F'];
                    $result['bblr_6'][$key] += (int)$temp['G'];
                    $result['bblr_7'][$key] += (int)$temp['H'];
                    $result['bblr_8'][$key] += (int)$temp['I'];
                    $result['bblr_9'][$key] += (int)$temp['J'];
                    $result['bblr_10'][$key] += (int)$temp['K'];
                    $result['bblr_11'][$key] += (int)$temp['L'];
                    $result['bblr_12'][$key] += (int)$temp['M'];
                    $result['bblr_13'][$key] += (int)$temp['N'];
                    $result['bblr_14'][$key] += (int)$temp['O'];
                    $result['bblr_15'][$key] += (int)$temp['P'];
                    $result['bblr_16'][$key] += (int)$temp['Q'];
                    $result['bblr_17'][$key] += (int)$temp['R'];
                    $result['bblr_18'][$key] += (int)$temp['S'];
                    $result['bblr_19'][$key] += (int)$temp['T'];
                }
            }
            foreach ($dataasfiksia as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['asfiksia_1'][$key] += (int)$temp['B'];
                    $result['asfiksia_2'][$key] += (int)$temp['C'];
                    $result['asfiksia_3'][$key] += (int)$temp['D'];
                    $result['asfiksia_4'][$key] += (int)$temp['E'];
                    $result['asfiksia_5'][$key] += (int)$temp['F'];
                    $result['asfiksia_6'][$key] += (int)$temp['G'];
                    $result['asfiksia_7'][$key] += (int)$temp['H'];
                    $result['asfiksia_8'][$key] += (int)$temp['I'];
                    $result['asfiksia_9'][$key] += (int)$temp['J'];
                    $result['asfiksia_10'][$key] += (int)$temp['K'];
                    $result['asfiksia_11'][$key] += (int)$temp['L'];
                    $result['asfiksia_12'][$key] += (int)$temp['M'];
                    $result['asfiksia_13'][$key] += (int)$temp['N'];
                    $result['asfiksia_14'][$key] += (int)$temp['O'];
                    $result['asfiksia_15'][$key] += (int)$temp['P'];
                    $result['asfiksia_16'][$key] += (int)$temp['Q'];
                    $result['asfiksia_17'][$key] += (int)$temp['R'];
                    $result['asfiksia_18'][$key] += (int)$temp['S'];
                    $result['asfiksia_19'][$key] += (int)$temp['T'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_1.xlsx",$result,$result_index);
    }
    
    public function neonatal2($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['bblr_1'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_1'] = array();
        $result['bblr_2'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_2'] = array();
        $result['bblr_3'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_3'] = array();
        $result['bblr_4'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_4'] = array();
        $result['bblr_5'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_5'] = array();
        $result['bblr_6'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_6'] = array();
        $result['bblr_7'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_7'] = array();
        $result['bblr_8'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_8'] = array();
        $result['bblr_9'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_9'] = array();
        $result['bblr_10'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_10'] = array();
        $result['bblr_11'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_11'] = array();
        $result['bblr_12'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_12'] = array();
        $result['bblr_13'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_13'] = array();
        $result['bblr_14'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_14'] = array();
        $result['bblr_15'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_15'] = array();
        $result['bblr_16'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_16'] = array();
        $result['bblr_17'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_17'] = array();
        $result['bblr_18'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_18'] = array();
        $result['bblr_19'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_19'] = array();
        
        $result['asfiksia_1'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_1'] = array();
        $result['asfiksia_2'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_2'] = array();
        $result['asfiksia_3'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_3'] = array();
        $result['asfiksia_4'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_4'] = array();
        $result['asfiksia_5'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_5'] = array();
        $result['asfiksia_6'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_6'] = array();
        $result['asfiksia_7'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_7'] = array();
        $result['asfiksia_8'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_8'] = array();
        $result['asfiksia_9'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_9'] = array();
        $result['asfiksia_10'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_10'] = array();
        $result['asfiksia_11'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_11'] = array();
        $result['asfiksia_12'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_12'] = array();
        $result['asfiksia_13'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_13'] = array();
        $result['asfiksia_14'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_14'] = array();
        $result['asfiksia_15'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_15'] = array();
        $result['asfiksia_16'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_16'] = array();
        $result['asfiksia_17'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_17'] = array();
        $result['asfiksia_18'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_18'] = array();
        $result['asfiksia_19'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_19'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN'];
        $num = 13;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['bblr_1'],$col[1].$num);
            array_push($result_index['bblr_2'],$col[2].$num);
            array_push($result_index['bblr_3'],$col[3].$num);
            array_push($result_index['bblr_4'],$col[4].$num);
            array_push($result_index['bblr_5'],$col[5].$num);
            array_push($result_index['bblr_6'],$col[6].$num);
            array_push($result_index['bblr_7'],$col[7].$num);
            array_push($result_index['bblr_8'],$col[8].$num);
            array_push($result_index['bblr_9'],$col[9].$num);
            array_push($result_index['bblr_10'],$col[10].$num);
            array_push($result_index['bblr_11'],$col[11].$num);
            array_push($result_index['bblr_12'],$col[12].$num);
            array_push($result_index['bblr_13'],$col[13].$num);
            array_push($result_index['bblr_14'],$col[14].$num);
            array_push($result_index['bblr_15'],$col[15].$num);
            array_push($result_index['bblr_16'],$col[16].$num);
            array_push($result_index['bblr_17'],$col[17].$num);
            array_push($result_index['bblr_18'],$col[18].$num);
            array_push($result_index['bblr_19'],$col[19].$num);
            
            array_push($result_index['asfiksia_1'],$col[20].$num);
            array_push($result_index['asfiksia_2'],$col[21].$num);
            array_push($result_index['asfiksia_3'],$col[22].$num);
            array_push($result_index['asfiksia_4'],$col[23].$num);
            array_push($result_index['asfiksia_5'],$col[24].$num);
            array_push($result_index['asfiksia_6'],$col[25].$num);
            array_push($result_index['asfiksia_7'],$col[26].$num);
            array_push($result_index['asfiksia_8'],$col[27].$num);
            array_push($result_index['asfiksia_9'],$col[28].$num);
            array_push($result_index['asfiksia_10'],$col[29].$num);
            array_push($result_index['asfiksia_11'],$col[30].$num);
            array_push($result_index['asfiksia_12'],$col[31].$num);
            array_push($result_index['asfiksia_13'],$col[32].$num);
            array_push($result_index['asfiksia_14'],$col[33].$num);
            array_push($result_index['asfiksia_15'],$col[34].$num);
            array_push($result_index['asfiksia_16'],$col[35].$num);
            array_push($result_index['asfiksia_17'],$col[36].$num);
            array_push($result_index['asfiksia_18'],$col[37].$num);
            array_push($result_index['asfiksia_19'],$col[38].$num);
            $num++;
        }
        
        try {
            $datatetanus = array();
            $datasepsis = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/neonatal2_sepsis.xlsx','A2:E112'); 
            
            foreach ($datatetanus as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['bblr_1'][$key] += (int)$temp['B'];
                    $result['bblr_2'][$key] += (int)$temp['C'];
                    $result['bblr_3'][$key] += (int)$temp['D'];
                    $result['bblr_4'][$key] += (int)$temp['E'];
                    $result['bblr_5'][$key] += (int)$temp['F'];
                    $result['bblr_6'][$key] += (int)$temp['G'];
                    $result['bblr_7'][$key] += (int)$temp['H'];
                    $result['bblr_8'][$key] += (int)$temp['I'];
                    $result['bblr_9'][$key] += (int)$temp['J'];
                    $result['bblr_10'][$key] += (int)$temp['K'];
                    $result['bblr_11'][$key] += (int)$temp['L'];
                    $result['bblr_12'][$key] += (int)$temp['M'];
                    $result['bblr_13'][$key] += (int)$temp['N'];
                    $result['bblr_14'][$key] += (int)$temp['O'];
                    $result['bblr_15'][$key] += (int)$temp['P'];
                    $result['bblr_16'][$key] += (int)$temp['Q'];
                    $result['bblr_17'][$key] += (int)$temp['R'];
                    $result['bblr_18'][$key] += (int)$temp['S'];
                    $result['bblr_19'][$key] += (int)$temp['T'];
                }
            }
            foreach ($datasepsis as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['asfiksia_1'][$key] += (int)$temp['B'];
                    $result['asfiksia_2'][$key] += (int)$temp['C'];
                    $result['asfiksia_3'][$key] += (int)$temp['D'];
                    $result['asfiksia_4'][$key] += (int)$temp['E'];
                    $result['asfiksia_5'][$key] += (int)$temp['F'];
                    $result['asfiksia_6'][$key] += (int)$temp['G'];
                    $result['asfiksia_7'][$key] += (int)$temp['H'];
                    $result['asfiksia_8'][$key] += (int)$temp['I'];
                    $result['asfiksia_9'][$key] += (int)$temp['J'];
                    $result['asfiksia_10'][$key] += (int)$temp['K'];
                    $result['asfiksia_11'][$key] += (int)$temp['L'];
                    $result['asfiksia_12'][$key] += (int)$temp['M'];
                    $result['asfiksia_13'][$key] += (int)$temp['N'];
                    $result['asfiksia_14'][$key] += (int)$temp['O'];
                    $result['asfiksia_15'][$key] += (int)$temp['P'];
                    $result['asfiksia_16'][$key] += (int)$temp['Q'];
                    $result['asfiksia_17'][$key] += (int)$temp['R'];
                    $result['asfiksia_18'][$key] += (int)$temp['S'];
                    $result['asfiksia_19'][$key] += (int)$temp['T'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_2.xlsx",$result,$result_index);
    }
    
    public function neonatal3($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['bblr_1'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_1'] = array();
        $result['bblr_2'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_2'] = array();
        $result['bblr_3'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_3'] = array();
        $result['bblr_4'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_4'] = array();
        $result['bblr_5'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_5'] = array();
        $result['bblr_6'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_6'] = array();
        $result['bblr_7'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_7'] = array();
        $result['bblr_8'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_8'] = array();
        $result['bblr_9'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_9'] = array();
        $result['bblr_10'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_10'] = array();
        $result['bblr_11'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_11'] = array();
        $result['bblr_12'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_12'] = array();
        $result['bblr_13'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_13'] = array();
        $result['bblr_14'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_14'] = array();
        $result['bblr_15'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_15'] = array();
        $result['bblr_16'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_16'] = array();
        $result['bblr_17'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_17'] = array();
        $result['bblr_18'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_18'] = array();
        $result['bblr_19'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_19'] = array();
        
        $result['asfiksia_1'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_1'] = array();
        $result['asfiksia_2'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_2'] = array();
        $result['asfiksia_3'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_3'] = array();
        $result['asfiksia_4'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_4'] = array();
        $result['asfiksia_5'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_5'] = array();
        $result['asfiksia_6'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_6'] = array();
        $result['asfiksia_7'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_7'] = array();
        $result['asfiksia_8'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_8'] = array();
        $result['asfiksia_9'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_9'] = array();
        $result['asfiksia_10'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_10'] = array();
        $result['asfiksia_11'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_11'] = array();
        $result['asfiksia_12'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_12'] = array();
        $result['asfiksia_13'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_13'] = array();
        $result['asfiksia_14'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_14'] = array();
        $result['asfiksia_15'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_15'] = array();
        $result['asfiksia_16'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_16'] = array();
        $result['asfiksia_17'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_17'] = array();
        $result['asfiksia_18'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_18'] = array();
        $result['asfiksia_19'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_19'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN'];
        $num = 13;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['bblr_1'],$col[1].$num);
            array_push($result_index['bblr_2'],$col[2].$num);
            array_push($result_index['bblr_3'],$col[3].$num);
            array_push($result_index['bblr_4'],$col[4].$num);
            array_push($result_index['bblr_5'],$col[5].$num);
            array_push($result_index['bblr_6'],$col[6].$num);
            array_push($result_index['bblr_7'],$col[7].$num);
            array_push($result_index['bblr_8'],$col[8].$num);
            array_push($result_index['bblr_9'],$col[9].$num);
            array_push($result_index['bblr_10'],$col[10].$num);
            array_push($result_index['bblr_11'],$col[11].$num);
            array_push($result_index['bblr_12'],$col[12].$num);
            array_push($result_index['bblr_13'],$col[13].$num);
            array_push($result_index['bblr_14'],$col[14].$num);
            array_push($result_index['bblr_15'],$col[15].$num);
            array_push($result_index['bblr_16'],$col[16].$num);
            array_push($result_index['bblr_17'],$col[17].$num);
            array_push($result_index['bblr_18'],$col[18].$num);
            array_push($result_index['bblr_19'],$col[19].$num);
            
            array_push($result_index['asfiksia_1'],$col[20].$num);
            array_push($result_index['asfiksia_2'],$col[21].$num);
            array_push($result_index['asfiksia_3'],$col[22].$num);
            array_push($result_index['asfiksia_4'],$col[23].$num);
            array_push($result_index['asfiksia_5'],$col[24].$num);
            array_push($result_index['asfiksia_6'],$col[25].$num);
            array_push($result_index['asfiksia_7'],$col[26].$num);
            array_push($result_index['asfiksia_8'],$col[27].$num);
            array_push($result_index['asfiksia_9'],$col[28].$num);
            array_push($result_index['asfiksia_10'],$col[29].$num);
            array_push($result_index['asfiksia_11'],$col[30].$num);
            array_push($result_index['asfiksia_12'],$col[31].$num);
            array_push($result_index['asfiksia_13'],$col[32].$num);
            array_push($result_index['asfiksia_14'],$col[33].$num);
            array_push($result_index['asfiksia_15'],$col[34].$num);
            array_push($result_index['asfiksia_16'],$col[35].$num);
            array_push($result_index['asfiksia_17'],$col[36].$num);
            array_push($result_index['asfiksia_18'],$col[37].$num);
            array_push($result_index['asfiksia_19'],$col[38].$num);
            $num++;
        }
        
        try {
            $datakongenital = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/neonatal3_kelainan_kongenital.xlsx','A2:E112'); 
            $dataikterus = array();
            
            foreach ($datakongenital as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['bblr_1'][$key] += (int)$temp['B'];
                    $result['bblr_2'][$key] += (int)$temp['C'];
                    $result['bblr_3'][$key] += (int)$temp['D'];
                    $result['bblr_4'][$key] += (int)$temp['E'];
                    $result['bblr_5'][$key] += (int)$temp['F'];
                    $result['bblr_6'][$key] += (int)$temp['G'];
                    $result['bblr_7'][$key] += (int)$temp['H'];
                    $result['bblr_8'][$key] += (int)$temp['I'];
                    $result['bblr_9'][$key] += (int)$temp['J'];
                    $result['bblr_10'][$key] += (int)$temp['K'];
                    $result['bblr_11'][$key] += (int)$temp['L'];
                    $result['bblr_12'][$key] += (int)$temp['M'];
                    $result['bblr_13'][$key] += (int)$temp['N'];
                    $result['bblr_14'][$key] += (int)$temp['O'];
                    $result['bblr_15'][$key] += (int)$temp['P'];
                    $result['bblr_16'][$key] += (int)$temp['Q'];
                    $result['bblr_17'][$key] += (int)$temp['R'];
                    $result['bblr_18'][$key] += (int)$temp['S'];
                    $result['bblr_19'][$key] += (int)$temp['T'];
                }
            }
            foreach ($dataikterus as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['asfiksia_1'][$key] += (int)$temp['B'];
                    $result['asfiksia_2'][$key] += (int)$temp['C'];
                    $result['asfiksia_3'][$key] += (int)$temp['D'];
                    $result['asfiksia_4'][$key] += (int)$temp['E'];
                    $result['asfiksia_5'][$key] += (int)$temp['F'];
                    $result['asfiksia_6'][$key] += (int)$temp['G'];
                    $result['asfiksia_7'][$key] += (int)$temp['H'];
                    $result['asfiksia_8'][$key] += (int)$temp['I'];
                    $result['asfiksia_9'][$key] += (int)$temp['J'];
                    $result['asfiksia_10'][$key] += (int)$temp['K'];
                    $result['asfiksia_11'][$key] += (int)$temp['L'];
                    $result['asfiksia_12'][$key] += (int)$temp['M'];
                    $result['asfiksia_13'][$key] += (int)$temp['N'];
                    $result['asfiksia_14'][$key] += (int)$temp['O'];
                    $result['asfiksia_15'][$key] += (int)$temp['P'];
                    $result['asfiksia_16'][$key] += (int)$temp['Q'];
                    $result['asfiksia_17'][$key] += (int)$temp['R'];
                    $result['asfiksia_18'][$key] += (int)$temp['S'];
                    $result['asfiksia_19'][$key] += (int)$temp['T'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_3.xlsx",$result,$result_index);
    }
    
    public function neonatal4($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['bblr_1'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_1'] = array();
        $result['bblr_2'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_2'] = array();
        $result['bblr_3'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_3'] = array();
        $result['bblr_4'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_4'] = array();
        $result['bblr_5'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_5'] = array();
        $result['bblr_6'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_6'] = array();
        $result['bblr_7'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_7'] = array();
        $result['bblr_8'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_8'] = array();
        $result['bblr_9'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_9'] = array();
        $result['bblr_10'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_10'] = array();
        $result['bblr_11'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_11'] = array();
        $result['bblr_12'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_12'] = array();
        $result['bblr_13'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_13'] = array();
        $result['bblr_14'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_14'] = array();
        $result['bblr_15'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_15'] = array();
        $result['bblr_16'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_16'] = array();
        $result['bblr_17'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_17'] = array();
        $result['bblr_18'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_18'] = array();
        $result['bblr_19'] = array_fill(0,count($result['dusun']),0); $result_index['bblr_19'] = array();
        
        $result['asfiksia_1'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_1'] = array();
        $result['asfiksia_2'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_2'] = array();
        $result['asfiksia_3'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_3'] = array();
        $result['asfiksia_4'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_4'] = array();
        $result['asfiksia_5'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_5'] = array();
        $result['asfiksia_6'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_6'] = array();
        $result['asfiksia_7'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_7'] = array();
        $result['asfiksia_8'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_8'] = array();
        $result['asfiksia_9'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_9'] = array();
        $result['asfiksia_10'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_10'] = array();
        $result['asfiksia_11'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_11'] = array();
        $result['asfiksia_12'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_12'] = array();
        $result['asfiksia_13'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_13'] = array();
        $result['asfiksia_14'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_14'] = array();
        $result['asfiksia_15'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_15'] = array();
        $result['asfiksia_16'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_16'] = array();
        $result['asfiksia_17'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_17'] = array();
        $result['asfiksia_18'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_18'] = array();
        $result['asfiksia_19'] = array_fill(0,count($result['dusun']),0); $result_index['asfiksia_19'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN'];
        $num = 13;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['bblr_1'],$col[1].$num);
            array_push($result_index['bblr_2'],$col[2].$num);
            array_push($result_index['bblr_3'],$col[3].$num);
            array_push($result_index['bblr_4'],$col[4].$num);
            array_push($result_index['bblr_5'],$col[5].$num);
            array_push($result_index['bblr_6'],$col[6].$num);
            array_push($result_index['bblr_7'],$col[7].$num);
            array_push($result_index['bblr_8'],$col[8].$num);
            array_push($result_index['bblr_9'],$col[9].$num);
            array_push($result_index['bblr_10'],$col[10].$num);
            array_push($result_index['bblr_11'],$col[11].$num);
            array_push($result_index['bblr_12'],$col[12].$num);
            array_push($result_index['bblr_13'],$col[13].$num);
            array_push($result_index['bblr_14'],$col[14].$num);
            array_push($result_index['bblr_15'],$col[15].$num);
            array_push($result_index['bblr_16'],$col[16].$num);
            array_push($result_index['bblr_17'],$col[17].$num);
            array_push($result_index['bblr_18'],$col[18].$num);
            array_push($result_index['bblr_19'],$col[19].$num);
            
            array_push($result_index['asfiksia_1'],$col[20].$num);
            array_push($result_index['asfiksia_2'],$col[21].$num);
            array_push($result_index['asfiksia_3'],$col[22].$num);
            array_push($result_index['asfiksia_4'],$col[23].$num);
            array_push($result_index['asfiksia_5'],$col[24].$num);
            array_push($result_index['asfiksia_6'],$col[25].$num);
            array_push($result_index['asfiksia_7'],$col[26].$num);
            array_push($result_index['asfiksia_8'],$col[27].$num);
            array_push($result_index['asfiksia_9'],$col[28].$num);
            array_push($result_index['asfiksia_10'],$col[29].$num);
            array_push($result_index['asfiksia_11'],$col[30].$num);
            array_push($result_index['asfiksia_12'],$col[31].$num);
            array_push($result_index['asfiksia_13'],$col[32].$num);
            array_push($result_index['asfiksia_14'],$col[33].$num);
            array_push($result_index['asfiksia_15'],$col[34].$num);
            array_push($result_index['asfiksia_16'],$col[35].$num);
            array_push($result_index['asfiksia_17'],$col[36].$num);
            array_push($result_index['asfiksia_18'],$col[37].$num);
            array_push($result_index['asfiksia_19'],$col[38].$num);
            $num++;
        }
        
        try {
            $datalain = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/neonatal4_kasus_lain.xlsx','A2:E112'); 
            $datatotal = array();
            
            foreach ($datalain as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['bblr_1'][$key] += (int)$temp['B'];
                    $result['bblr_2'][$key] += (int)$temp['C'];
                    $result['bblr_3'][$key] += (int)$temp['D'];
                    $result['bblr_4'][$key] += (int)$temp['E'];
                    $result['bblr_5'][$key] += (int)$temp['F'];
                    $result['bblr_6'][$key] += (int)$temp['G'];
                    $result['bblr_7'][$key] += (int)$temp['H'];
                    $result['bblr_8'][$key] += (int)$temp['I'];
                    $result['bblr_9'][$key] += (int)$temp['J'];
                    $result['bblr_10'][$key] += (int)$temp['K'];
                    $result['bblr_11'][$key] += (int)$temp['L'];
                    $result['bblr_12'][$key] += (int)$temp['M'];
                    $result['bblr_13'][$key] += (int)$temp['N'];
                    $result['bblr_14'][$key] += (int)$temp['O'];
                    $result['bblr_15'][$key] += (int)$temp['P'];
                    $result['bblr_16'][$key] += (int)$temp['Q'];
                    $result['bblr_17'][$key] += (int)$temp['R'];
                    $result['bblr_18'][$key] += (int)$temp['S'];
                    $result['bblr_19'][$key] += (int)$temp['T'];
                }
            }
            foreach ($datatotal as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['asfiksia_1'][$key] += (int)$temp['B'];
                    $result['asfiksia_2'][$key] += (int)$temp['C'];
                    $result['asfiksia_3'][$key] += (int)$temp['D'];
                    $result['asfiksia_4'][$key] += (int)$temp['E'];
                    $result['asfiksia_5'][$key] += (int)$temp['F'];
                    $result['asfiksia_6'][$key] += (int)$temp['G'];
                    $result['asfiksia_7'][$key] += (int)$temp['H'];
                    $result['asfiksia_8'][$key] += (int)$temp['I'];
                    $result['asfiksia_9'][$key] += (int)$temp['J'];
                    $result['asfiksia_10'][$key] += (int)$temp['K'];
                    $result['asfiksia_11'][$key] += (int)$temp['L'];
                    $result['asfiksia_12'][$key] += (int)$temp['M'];
                    $result['asfiksia_13'][$key] += (int)$temp['N'];
                    $result['asfiksia_14'][$key] += (int)$temp['O'];
                    $result['asfiksia_15'][$key] += (int)$temp['P'];
                    $result['asfiksia_16'][$key] += (int)$temp['Q'];
                    $result['asfiksia_17'][$key] += (int)$temp['R'];
                    $result['asfiksia_18'][$key] += (int)$temp['S'];
                    $result['asfiksia_19'][$key] += (int)$temp['T'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_4.xlsx",$result,$result_index);
    }
    
    public function neonatal5($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = 'B';
        $num = 13;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col.$num);
            $num++;
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_5.xlsx",$result,$result_index);
    }
    
    public function kb1($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['file1_1'] = array_fill(0,count($result['dusun']),0); $result_index['file1_1'] = array();
        $result['file1_2'] = array_fill(0,count($result['dusun']),0); $result_index['file1_2'] = array();
        
        $result['file2_1'] = array_fill(0,count($result['dusun']),0); $result_index['file2_1'] = array();
        $result['file2_2'] = array_fill(0,count($result['dusun']),0); $result_index['file2_2'] = array();
        $result['file2_3'] = array_fill(0,count($result['dusun']),0); $result_index['file2_3'] = array();
        
        $result['file3_1'] = array_fill(0,count($result['dusun']),0); $result_index['file3_1'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','D','E','F','H','I','J'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['file1_1'],$col[1].$num);
            array_push($result_index['file1_2'],$col[2].$num);
            array_push($result_index['file2_1'],$col[3].$num);
            array_push($result_index['file2_2'],$col[4].$num);
            array_push($result_index['file2_3'],$col[5].$num);
            array_push($result_index['file3_1'],$col[6].$num);
            $num++;
        }
        
        try {
            $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb1_peserta_kb_lama_baru.xlsx','A2:E112'); 
            $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb1_dropout.xlsx','A2:E112'); 
            $data3 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb1_kb_aktif.xlsx','A2:E112'); 
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file1_1'][$key] += (int)$temp['B'];
                    $result['file1_2'][$key] += (int)$temp['C'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file2_1'][$key] += (int)$temp['B'];
                    $result['file2_2'][$key] += (int)$temp['C'];
                    $result['file2_3'][$key] += (int)$temp['D'];
                }
            }
            foreach ($data3 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file3_1'][$key] += (int)$temp['B'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_1.xlsx",$result,$result_index);
    }
    
    public function kb2($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['file1_1'] = array_fill(0,count($result['dusun']),0); $result_index['file1_1'] = array();
        $result['file1_2'] = array_fill(0,count($result['dusun']),0); $result_index['file1_2'] = array();
        
        $result['file2_1'] = array_fill(0,count($result['dusun']),0); $result_index['file2_1'] = array();
        $result['file2_2'] = array_fill(0,count($result['dusun']),0); $result_index['file2_2'] = array();
        $result['file2_3'] = array_fill(0,count($result['dusun']),0); $result_index['file2_3'] = array();
        
        $result['file3_1'] = array_fill(0,count($result['dusun']),0); $result_index['file3_1'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','D','E','F','H','I','J'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['file1_1'],$col[1].$num);
            array_push($result_index['file1_2'],$col[2].$num);
            array_push($result_index['file2_1'],$col[3].$num);
            array_push($result_index['file2_2'],$col[4].$num);
            array_push($result_index['file2_3'],$col[5].$num);
            array_push($result_index['file3_1'],$col[6].$num);
            $num++;
        }
        
        try {
            $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb2_peserta_kb_gakin_lama_baru.xlsx','A2:E112'); 
            $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb2_dropout.xlsx','A2:E112'); 
            $data3 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb2_kb_aktif_gakin.xlsx','A2:E112'); 
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file1_1'][$key] += (int)$temp['B'];
                    $result['file1_2'][$key] += (int)$temp['C'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file2_1'][$key] += (int)$temp['B'];
                    $result['file2_2'][$key] += (int)$temp['C'];
                    $result['file2_3'][$key] += (int)$temp['D'];
                }
            }
            foreach ($data3 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file3_1'][$key] += (int)$temp['B'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_2.xlsx",$result,$result_index);
    }
    
    public function kb3($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['file1_1'] = array_fill(0,count($result['dusun']),0); $result_index['file1_1'] = array();
        $result['file1_2'] = array_fill(0,count($result['dusun']),0); $result_index['file1_2'] = array();
        
        $result['file2_1'] = array_fill(0,count($result['dusun']),0); $result_index['file2_1'] = array();
        $result['file2_2'] = array_fill(0,count($result['dusun']),0); $result_index['file2_2'] = array();
        $result['file2_3'] = array_fill(0,count($result['dusun']),0); $result_index['file2_3'] = array();
        
        $result['file3_1'] = array_fill(0,count($result['dusun']),0); $result_index['file3_1'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','D','E','F','H','I','J'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['file1_1'],$col[1].$num);
            array_push($result_index['file1_2'],$col[2].$num);
            array_push($result_index['file2_1'],$col[3].$num);
            array_push($result_index['file2_2'],$col[4].$num);
            array_push($result_index['file2_3'],$col[5].$num);
            array_push($result_index['file3_1'],$col[6].$num);
            $num++;
        }
        
        try {
            $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb3_peserta_kb_4T_lama_baru.xlsx','A2:E112'); 
            $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb3_dropout.xlsx','A2:E112'); 
            $data3 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb3_kb_aktif_4T.xlsx','A2:E112'); 
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file1_1'][$key] += (int)$temp['B'];
                    $result['file1_2'][$key] += (int)$temp['C'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file2_1'][$key] += (int)$temp['B'];
                    $result['file2_2'][$key] += (int)$temp['C'];
                    $result['file2_3'][$key] += (int)$temp['D'];
                }
            }
            foreach ($data3 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file3_1'][$key] += (int)$temp['B'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_3.xlsx",$result,$result_index);
    }
    
    public function kb4($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['file1_1'] = array_fill(0,count($result['dusun']),0); $result_index['file1_1'] = array();
        $result['file1_2'] = array_fill(0,count($result['dusun']),0); $result_index['file1_2'] = array();
        
        $result['file2_1'] = array_fill(0,count($result['dusun']),0); $result_index['file2_1'] = array();
        $result['file2_2'] = array_fill(0,count($result['dusun']),0); $result_index['file2_2'] = array();
        $result['file2_3'] = array_fill(0,count($result['dusun']),0); $result_index['file2_3'] = array();
        
        $result['file3_1'] = array_fill(0,count($result['dusun']),0); $result_index['file3_1'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','D','E','F','H','I','J'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['file1_1'],$col[1].$num);
            array_push($result_index['file1_2'],$col[2].$num);
            array_push($result_index['file2_1'],$col[3].$num);
            array_push($result_index['file2_2'],$col[4].$num);
            array_push($result_index['file2_3'],$col[5].$num);
            array_push($result_index['file3_1'],$col[6].$num);
            $num++;
        }
        
        try {
            $data1 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb4_peserta_kb_kronis_lama_baru.xlsx','A2:E112'); 
            $data2 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb4_dropout.xlsx','A2:E112'); 
            $data3 = $this->PHPExcelModel->getCellRange('download/pws_source_dusun/pws_kb4_kb_aktif_kronis.xlsx','A2:E112'); 
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file1_1'][$key] += (int)$temp['B'];
                    $result['file1_2'][$key] += (int)$temp['C'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file2_1'][$key] += (int)$temp['B'];
                    $result['file2_2'][$key] += (int)$temp['C'];
                    $result['file2_3'][$key] += (int)$temp['D'];
                }
            }
            foreach ($data3 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file3_1'][$key] += (int)$temp['B'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_4.xlsx",$result,$result_index);
    }
    
    public function kb5($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        $listdusun = $this->dusun[$user];
        $result['file1_1'] = array_fill(0,count($result['dusun']),0); $result_index['file1_1'] = array();
        $result['file1_2'] = array_fill(0,count($result['dusun']),0); $result_index['file1_2'] = array();
        
        $result['file2_1'] = array_fill(0,count($result['dusun']),0); $result_index['file2_1'] = array();
        $result['file2_2'] = array_fill(0,count($result['dusun']),0); $result_index['file2_2'] = array();
        $result['file2_3'] = array_fill(0,count($result['dusun']),0); $result_index['file2_3'] = array();
        
        $result['file3_1'] = array_fill(0,count($result['dusun']),0); $result_index['file3_1'] = array();
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = ['B','D','E','F','H','I','J'];
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col[0].$num);
            
            array_push($result_index['file1_1'],$col[1].$num);
            array_push($result_index['file1_2'],$col[2].$num);
            array_push($result_index['file2_1'],$col[3].$num);
            array_push($result_index['file2_2'],$col[4].$num);
            array_push($result_index['file2_3'],$col[5].$num);
            array_push($result_index['file3_1'],$col[6].$num);
            $num++;
        }
        
        try {
            $data1 = array();
            $data2 = array();
            $data3 = array();
            
            foreach ($data1 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file1_1'][$key] += (int)$temp['B'];
                    $result['file1_2'][$key] += (int)$temp['C'];
                }
            }
            foreach ($data2 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file2_1'][$key] += (int)$temp['B'];
                    $result['file2_2'][$key] += (int)$temp['C'];
                    $result['file2_3'][$key] += (int)$temp['D'];
                }
            }
            foreach ($data3 as $temp){
                if($temp['A']==null) continue;
                if(array_key_exists($temp['A'],$listdusun)){
                    $key=array_search($listdusun[$temp['A']],$result['dusun']);
                    $result['file3_1'][$key] += (int)$temp['B'];
                }
            }
        } catch (Exception $ex) {

        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_5.xlsx",$result,$result_index);
    }
    
    public function akb($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_akb.xlsx",$result,$result_index);
    }
    
    public function kih($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = 'B';
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col.$num);
            $num++;
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kih.xlsx",$result,$result_index);
    }
    
    public function p4k($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = 'B';
        $num = 12;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col.$num);
            $num++;
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_p4k.xlsx",$result,$result_index);
    }
    
    public function anak($user,$year,$month,$form){
        $namefile = "_".$month."_".$this->listdesa[$user].".xls";
        $result['form'] = array($form);
        $result['kecamatan'] = array("DESA    :  ".strtoupper($this->listdesa[$user]));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['dusun'] = $this->listdusun[$user];
        
        $result['judul'] = array("DUSUN");
        $result_index['judul'] = array("B7");
        
        $result_index['kecamatan'] = array("A2");
        $result_index['bulan'] = array("A5");
        $result_index['dusun']=array();
        $col = 'B';
        $num = 11;
        foreach ($result['dusun'] as $dusun){
            array_push($result_index['dusun'],$col.$num);
            $num++;
        }
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
}