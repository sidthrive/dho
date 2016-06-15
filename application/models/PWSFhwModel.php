<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PWSFhwModel extends CI_Model{
    
    private $listdusun = ['user1'=>array("Lekor Timur","Lekor Barat","Sondo","Gulung","Pepao Timur","Lengkok Bunut","Lendang Jawe","Pepao Barat I","Presak","Taken Aken","Pepao Barat II","Renge","Pelapak","Walun","Montong Bile")
                        ,'user2'=>array("Jembe Barat","Jembe Timur","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Janggawana"=>"Janggawana","Sengkerek"=>"Sengkerek","Lingkok+Buak+Barat"=>"Lingkok Buak Barat","Lingkok+Buak+Tengah"=>"Lingkok Buak Tengah","Lingkok+Buak+Timur"=>"Lingkok Buak Timur","Melati"=>"Melati","Selek"=>"Selek","Gundu"=>"Gundu","Masjawa"=>"Masjawa","Presak+Sanggeng"=>"Presak Sanggeng","Tentram"=>"Tentram","Terentem"=>"Terentem","Keruak"=>"Keruak","Keruak Utara"=>"Keruak Utara","Masjaya"=>"Masjaya","Presak Sanggeng"=>"Presak Sanggeng","Janggawana+Selatan"=>"Janggawana Selatan","Janggawana+Utara"=>"Janggawana Utara","Janggawana+Tengah"=>"Janggawana Tengah","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Utara"=>"Jembe Utara","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur","Lingkok Buak Tengah"=>"Lingkok Buak Tengah","Lingkok Buak Timur"=>"Lingkok Buak Timur")
                        ,'user3'=>array("Montor","Pendem","Piling","Maliklo"=>"Maliklo","Jelitong"=>"Jelitong","Karang+Majelo"=>"Karang Majelo","Penuntut"=>"Penuntut","Kuang"=>"Kuang","Jangka"=>"Jangka","Petorok"=>"Petorok","Gelung"=>"Gelung","Gelondong"=>"Gelondong","Nyangget"=>"Nyangget","Montong+Bile"=>"Montong Bile","Lekong+Bangkon"=>"Lekong Bangkon")
                        ,'user4'=>array("Juna","Nunang","Batu+Belek"=>"Batu Belek","Siwi"=>"Siwi","Setuta+Barat"=>"Setuta Barat","Setuta+Timur"=>"Setuta Timur","Liwung"=>"Liwung","Liwung_Selatan"=>"Liwung Selatan","Biletawah"=>"Biletawah","Liwung+Satu"=>"Liwung Satu","Liwung+Dua"=>"Liwung Dua","Nunang+Selatan"=>"Nunang Selatan")
                        ,'user5'=>array("Rungkang Timur","Rungkang+Barat"=>"Rungkang Barat","Puntik+Baru"=>"Puntik Baru","Jango+Selatan"=>"Jango Selatan","Janggo+Utara"=>"Jango Utara","Kenyalu+Utara"=>"Kenyalu Utara","Kenyalu+Barat"=>"Kenyalu Barat","Kenyalu+Selatan"=>"Kenyalu Selatan","Kenyalu+Timur"=>"Kenyalu Timur","Kampung+Baru"=>"Kampung Baru","Arba"=>"Arba","Gerepek"=>"Gerepek","Jango+Utara"=>"Jango Utara")
                        ,'user6'=>array("Janapria","Lemokek","Tempek-Empek"=>"Tempek Empek","Batu+Bangus"=>"Batu Bangus","Nunang+I"=>"Nunang I","Perok+Timur"=>"Perok Timur","Batu+Kembar+II"=>"Batu Kembar II","Batu+Kembar+I"=>"Batu Kembar I","Pengebat"=>"Pengebat","Sadah"=>"Sadah","Penambong"=>"Penambong","Tonjong"=>"Tonjong","Pendem"=>"Pendem","Perok+Barat"=>"Perok Barat","Lambah+Olot"=>"Lambah Olot")
                        ,'user8'=>array("Dese","Abe","Sampet"=>"Sampet","Ketara"=>"Ketara","Sempalan"=>"Sempalan","Selak"=>"Selak","Dayen+Rurung"=>"Dayen Rurung","Embung+Rungkas"=>"Embung Rungkas","Reban"=>"Reban","Plangsang"=>"Plangsang","Lebak"=>"Lebak","Bagek+Payung"=>"Bagek Payung","bagek payung"=>"Bagek Payung","Sarah"=>"Sarah","Bagek+Dewe"=>"Bagek Dewe","Perigi"=>"Perigi","Bagek Dewe"=>"Bagek Dewe")
                        ,'user9'=>array("Piyang","Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng")
                        ,'user10'=>array("Piyang","Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng")
                        ,'user11'=>array("Karang Jangkong","Gilik"=>"Gilik","Karang+Daye"=>"Karang Daye","Balen+Along"=>"Balen Along","Bale+Montong+I"=>"Bale Montong I","Gubuk+Direk"=>"Gubuk Direk","Pengadang"=>"Pengadang","Sarang+Angin"=>"Sarang Angin","Dayen+Kubur"=>"Dayen Kubur","Bale+Montong+II"=>"Bale Montong II","Gonjong"=>"Gonjong","Gampung"=>"Gampung","Taman+Bumi+Gora"=>"Taman Bumi Gora","Buntereng"=>"Buntereng","Wareng"=>"Wareng","Pance"=>"Pance","Bumi+Gora"=>"Bumi Gora","Batu+Bangke"=>"Batu Bangke","Bumi Gora"=>"Bumi Gora","Bale Montong I"=>"Bale Montong I","Balen Along"=>"Balen Along","Bale Montong II"=>"Bale Montong II")
                        ,'user12'=>array("Lenser","Tanak Awu Bat","Selawang"=>"Selawang","Toro"=>"Toro","Tanak+Awu+I"=>"Tanak Awu I","Singe"=>"Singe","Tongkek"=>"Tongkek","Perendik"=>"Perendik","Bale+Bowo"=>"Bale Bowo","Gantang+Daye"=>"Gantang Daye","Tanak+Awu+II"=>"Tanak Awu II","Rebile"=>"Rebile","Tatak"=>"Tatak","Reak+II"=>"Reak II","Reak+I"=>"Reak I","Piyang"=>"Piyang","Gantang+Lauk"=>"Gantang Lauk","Batu+Butir"=>"Batu Butir","Penujak"=>"Penujak","Jambek"=>"Jambek","Gantang+Bat"=>"Gantang Bat","Gantang+Timuk"=>"Gantang Timuk","Lebak"=>"Lebak","Bongkem"=>"Bongkem","Kekale"=>"Kekale","Pelangsang"=>"Pelangsang","Gunung+Kosong"=>"Gunung Kosong","Mangkung"=>"Mangkung","Tamping"=>"Tamping","semayan"=>"Semayan","Tolot+Tolot"=>"Tolot Tolot","Gubuk+Baru"=>"Gubuk Baru","Gemel"=>"Gemel","Sengkol+II"=>"Sengkol II","Kapak"=>"Kapak","Tanpok"=>"Tanpok","Selawang+Timuq"=>"Selawang Timuq","Selawang+Bat"=>"Selawang Bat","Jambek+II"=>"Jambek II","Jambek+I"=>"Jambek I","Gantang Daye"=>"Gantang Daye","Tanak Awu Bat"=>"Tanak Awu Bat","Reak I"=>"Reak I","Reak II"=>"Reak II","Selawang Timuq"=>"Selawang Timuq","Gantang Bat"=>"Gantang Bat","Jambek II"=>"Jambek II","Jambek I"=>"Jambek I","Tanak Awu II"=>"Tanak Awu II","Gantang Lauk"=>"Gantang Lauk","Tanak Awu I"=>"Tanak Awu I")
                        ,'user13'=>array("Pengembur III","Pelangi","Rajan"=>"Rajan","Melati"=>"Melati","Tamping"=>"Tamping","Mawar"=>"Mawar","Bunga+Seroja"=>"Bunga Seroja","Sepit"=>"Sepit","Penyampi"=>"Penyampi","Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat","Tawah"=>"Tawah","Pengembur+II"=>"Pengembur II","Sinah"=>"Sinah","Pengembur+I"=>"Pengembur I","Batu+Belek"=>"Batu Belek","Pengembur I"=>"Pengembur I","Batu Belek"=>"Batu Belek","Pengembur II"=>"Pengembur II","Pengembur III"=>"Pengembur III")
                        ,'user14'=>array("Anak Anjan","Penupi","Kadik+I"=>"Kadik I","Karang+baru"=>"Karang Baru","Tenang"=>"Tenang","Lamben"=>"Lamben","Tuban"=>"Tuban","Segale"=>"Segale","Tenang+Baru"=>"Tenang Baru","Kadik+II"=>"Kadik II","Anak Anjan"=>"Anak Anjan","Kadik II"=>"Kadik II","Dasan Duah"=>"Dasan Duah")];
    private $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    
    public function kia1($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu1.xlsx",$result,$result_index);
    }
    
    public function kia2($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu2.xlsx",$result,$result_index);
    }
    
    public function kia3($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu3.xlsx",$result,$result_index);
    }
    
    public function kia4($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu4.xlsx",$result,$result_index);
    }
    
    public function kia5($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_ibu5.xlsx",$result,$result_index);
    }
    
    public function bayi($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function balita($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_".$form.".xlsx",$result,$result_index);
    }
    
    public function maternal($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_amp.xlsx",$result,$result_index);
    }
    
    public function neonatal1($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_1.xlsx",$result,$result_index);
    }
    
    public function neonatal2($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_2.xlsx",$result,$result_index);
    }
    
    public function neonatal3($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_neonatal_3.xlsx",$result,$result_index);
    }
    
    public function neonatal4($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_1.xlsx",$result,$result_index);
    }
    
    public function kb2($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_2.xlsx",$result,$result_index);
    }
    
    public function kb3($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_3.xlsx",$result,$result_index);
    }
    
    public function kb4($user,$year,$month,$form){
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
        
        $this->PHPExcelModel->createPwsXLS("download/pws_template/template_pws_kb_4.xlsx",$result,$result_index);
    }
    
    public function kb5($user,$year,$month,$form){
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
}