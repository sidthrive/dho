<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class GiziFhwModel extends CI_Model{
    
    private $listdusun = ['gizi1'=>array("Lekor+Timur"=>"Lekor Timur","Lekor+Barat"=>"Lekor Barat","Sondo"=>"Sondo","Gulung"=>"Gulung","Pepao+Timur"=>"Pepao Timur","Lengkok+Bunut"=>"Lengkok Bunut","Lendang+Jawe"=>"Lendang Jawe","Pepao+Barat+I"=>"Pepao Barat I","Presak"=>"Presak","Taken-Aken"=>"Taken Aken","Pepao+Barat+II"=>"Pepao Barat II","Renge"=>"Renge","Pelapak"=>"Pelapak","Walun"=>"Walun","Montong+Bile"=>"Montong Bile","Lainnya"=>"Lainnya")
                        ,'gizi2'=>array("Jembe+Barat"=>"Jembe Barat","Jembe+Timur"=>"Jembe Timur","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Janggawana"=>"Janggawana","Sengkerek"=>"Sengkerek","Lingkok+Buak+Barat"=>"Lingkok Buak Barat","Lingkok+Buak+Tengah"=>"Lingkok Buak Tengah","Lingkok+Buak+Timur"=>"Lingkok Buak Timur","Melati"=>"Melati","Selek"=>"Selek","Gundu"=>"Gundu","Masjawa"=>"Masjawa","Presak+Sanggeng"=>"Presak Sanggeng","Tentram"=>"Tentram","Terentem"=>"Terentem","Keruak"=>"Keruak","Keruak Utara"=>"Keruak Utara","Masjaya"=>"Masjaya","Presak Sanggeng"=>"Presak Sanggeng","Janggawana+Selatan"=>"Janggawana Selatan","Janggawana+Utara"=>"Janggawana Utara","Janggawana+Tengah"=>"Janggawana Tengah","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Utara"=>"Jembe Utara","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur","Lingkok Buak Tengah"=>"Lingkok Buak Tengah","Lingkok Buak Timur"=>"Lingkok Buak Timur","Lainnya"=>"Lainnya")
                        ,'gizi3'=>array("Montor"=>"Montor","Pendem"=>"Pendem","Piling"=>"Piling","Maliklo"=>"Maliklo","Jelitong"=>"Jelitong","Karang+Majelo"=>"Karang Majelo","Penuntut"=>"Penuntut","Kuang"=>"Kuang","Jangka"=>"Jangka","Petorok"=>"Petorok","Gelung"=>"Gelung","Gelondong"=>"Gelondong","Nyangget"=>"Nyangget","Montong+Bile"=>"Montong Bile","Lekong+Bangkon"=>"Lekong Bangkon","Lainnya"=>"Lainnya")
                        ,'gizi4'=>array("Juna"=>"Juna","Nunang"=>"Nunang","Batu+Belek"=>"Batu Belek","Siwi"=>"Siwi","Setuta+Barat"=>"Setuta Barat","Setuta+Timur"=>"Setuta Timur","Liwung"=>"Liwung","Liwung_Selatan"=>"Liwung Selatan","Biletawah"=>"Biletawah","Liwung+Satu"=>"Liwung Satu","Liwung+Dua"=>"Liwung Dua","Nunang+Selatan"=>"Nunang Selatan","Lainnya"=>"Lainnya")
                        ,'gizi5'=>array("Rungkang+Timur"=>"Rungkang Timur","Rungkang+Barat"=>"Rungkang Barat","Puntik+Baru"=>"Puntik Baru","Jango+Selatan"=>"Jango Selatan","Janggo+Utara"=>"Jango Utara","Kenyalu+Utara"=>"Kenyalu Utara","Kenyalu+Barat"=>"Kenyalu Barat","Kenyalu+Selatan"=>"Kenyalu Selatan","Kenyalu+Timur"=>"Kenyalu Timur","Kampung+Baru"=>"Kampung Baru","Arba"=>"Arba","Gerepek"=>"Gerepek","Jango+Utara"=>"Jango Utara","Lainnya"=>"Lainnya")
                        ,'gizi6'=>array("Janapria"=>"Janapria","Lemokek"=>"Lemokek","Tempek-Empek"=>"Tempek Empek","Batu+Bangus"=>"Batu Bangus","Nunang+I"=>"Nunang I","Perok+Timur"=>"Perok Timur","Batu+Kembar+II"=>"Batu Kembar II","Batu+Kembar+I"=>"Batu Kembar I","Pengebat"=>"Pengebat","Sadah"=>"Sadah","Penambong"=>"Penambong","Tonjong"=>"Tonjong","Pendem"=>"Pendem","Perok+Barat"=>"Perok Barat","Lambah+Olot"=>"Lambah Olot","Lainnya"=>"Lainnya")
                        ,'gizi8'=>array("Dese"=>"Dese","Abe"=>"Abe","Sampet"=>"Sampet","Ketara"=>"Ketara","Sempalan"=>"Sempalan","Selak"=>"Selak","Dayen+Rurung"=>"Dayen Rurung","Embung+Rungkas"=>"Embung Rungkas","Reban"=>"Reban","Plangsang"=>"Plangsang","Lebak"=>"Lebak","Bagek+Payung"=>"Bagek Payung","bagek payung"=>"Bagek Payung","Sarah"=>"Sarah","Bagek+Dewe"=>"Bagek Dewe","Perigi"=>"Perigi","Bagek Dewe"=>"Bagek Dewe","Lainnya"=>"Lainnya")
                        ,'gizi9'=>array("Piyang"=>"Piyang","Belong"=>"Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'gizi10'=>array("Piyang"=>"Piyang","Belong"=>"Belong","Sengkol+I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'gizi11'=>array("Karang+Jangkong"=>"Karang Jangkong","Gilik"=>"Gilik","Karang+Daye"=>"Karang Daye","Balen+Along"=>"Balen Along","Bale+Montong+I"=>"Bale Montong I","Gubuk+Direk"=>"Gubuk Direk","Pengadang"=>"Pengadang","Sarang+Angin"=>"Sarang Angin","Dayen+Kubur"=>"Dayen Kubur","Bale+Montong+II"=>"Bale Montong II","Gonjong"=>"Gonjong","Gampung"=>"Gampung","Taman+Bumi+Gora"=>"Taman Bumi Gora","Buntereng"=>"Buntereng","Wareng"=>"Wareng","Pance"=>"Pance","Bumi+Gora"=>"Bumi Gora","Batu+Bangke"=>"Batu Bangke","Bumi Gora"=>"Bumi Gora","Bale Montong I"=>"Bale Montong I","Balen Along"=>"Balen Along","Bale Montong II"=>"Bale Montong II","Lainnya"=>"Lainnya")
                        ,'gizi12'=>array("Lenser"=>"Lenser","Tanak+Awu+Bat"=>"Tanak Awu Bat","Selawang"=>"Selawang","Toro"=>"Toro","Tanak+Awu+I"=>"Tanak Awu I","Singe"=>"Singe","Tongkek"=>"Tongkek","Perendik"=>"Perendik","Bale+Bowo"=>"Bale Bowo","Gantang+Daye"=>"Gantang Daye","Tanak+Awu+II"=>"Tanak Awu II","Rebile"=>"Rebile","Tatak"=>"Tatak","Reak+II"=>"Reak II","Reak+I"=>"Reak I","Piyang"=>"Piyang","Gantang+Lauk"=>"Gantang Lauk","Batu+Butir"=>"Batu Butir","Penujak"=>"Penujak","Jambek"=>"Jambek","Gantang+Bat"=>"Gantang Bat","Gantang+Timuk"=>"Gantang Timuk","Lebak"=>"Lebak","Bongkem"=>"Bongkem","Kekale"=>"Kekale","Pelangsang"=>"Pelangsang","Gunung+Kosong"=>"Gunung Kosong","Mangkung"=>"Mangkung","Tamping"=>"Tamping","semayan"=>"Semayan","Tolot+Tolot"=>"Tolot Tolot","Gubuk+Baru"=>"Gubuk Baru","Gemel"=>"Gemel","Sengkol+II"=>"Sengkol II","Kapak"=>"Kapak","Tanpok"=>"Tanpok","Selawang+Timuq"=>"Selawang Timuq","Selawang+Bat"=>"Selawang Bat","Jambek+II"=>"Jambek II","Jambek+I"=>"Jambek I","Gantang Daye"=>"Gantang Daye","Tanak Awu Bat"=>"Tanak Awu Bat","Reak I"=>"Reak I","Reak II"=>"Reak II","Selawang Timuq"=>"Selawang Timuq","Gantang Bat"=>"Gantang Bat","Jambek II"=>"Jambek II","Jambek I"=>"Jambek I","Tanak Awu II"=>"Tanak Awu II","Gantang Lauk"=>"Gantang Lauk","Tanak Awu I"=>"Tanak Awu I","Lainnya"=>"Lainnya")
                        ,'gizi13'=>array("Pengembur+III"=>"Pengembur III","Pelangi"=>"Pelangi","Rajan"=>"Rajan","Melati"=>"Melati","Tamping"=>"Tamping","Mawar"=>"Mawar","Bunga+Seroja"=>"Bunga Seroja","Sepit"=>"Sepit","Penyampi"=>"Penyampi","Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat","Tawah"=>"Tawah","Pengembur+II"=>"Pengembur II","Sinah"=>"Sinah","Pengembur+I"=>"Pengembur I","Batu+Belek"=>"Batu Belek","Pengembur I"=>"Pengembur I","Batu Belek"=>"Batu Belek","Pengembur II"=>"Pengembur II","Pengembur III"=>"Pengembur III","Lainnya"=>"Lainnya")
                        ,'gizi14'=>array("Anak+Anjan"=>"Anak Anjan","Penupi"=>"Penupi","Kadik+I"=>"Kadik I","Karang+baru"=>"Karang Baru","Tenang"=>"Tenang","Lamben"=>"Lamben","Tuban"=>"Tuban","Segale"=>"Segale","Tenang+Baru"=>"Tenang Baru","Kadik+II"=>"Kadik II","Anak Anjan"=>"Anak Anjan","Kadik II"=>"Kadik II","Dasan Duah"=>"Dasan Duah","Lainnya"=>"Lainnya")];
    private $listdesa = ['gizi1'=>'Lekor','gizi2'=>'Saba','gizi3'=>'Pendem','gizi4'=>'Setuta','gizi5'=>'Jango','gizi6'=>'Janapria','gizi8'=>'Ketara','gizi9'=>'Sengkol','gizi10'=>'Sengkol','gizi11'=>'Kawo','gizi12'=>'Tanak Awu','gizi13'=>'Pengembur','gizi14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        $table_default = [
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'registrasi_gizi'=>'Registrasi Gizi'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                $tables[$table->Tables_in_opensrp_gizi]=$table_default[$table->Tables_in_opensrp_gizi];
            }
        }
        if($desa==""){
            $username = $this->session->userdata('username');
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $username = array_search($desa,$this->listdesa);
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }
        
        
        //make result array from the tables name
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            foreach ($tables as $table=>$legend){
                $data[$legend] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table=>$legend){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="registrasi_gizi"){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun");
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$datas->dusun]];
                        $data_count[$legend]         += $datas->counts;
                        $result_data[$namadusun[$datas->dusun]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        $data_count[$legend]         += $datas->counts;
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }elseif($table=="kunjungan_gizi"){
                $query = $giziDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $giziDB->query("SELECT dusun FROM registrasi_gizi where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }else{
                            $data_count                  = $result_data["Lainnya"];
                            $data_count[$legend]         += 1;
                            $result_data["Lainnya"] = $data_count;
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerDay($desa="",$mode=""){
        if($mode!=""){
            return self::getCountPerMode($desa,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        
        $table_default = [
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'registrasi_gizi'=>'Registrasi Gizi'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                array_push($tables, $table->Tables_in_opensrp_gizi);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $username = array_search($desa,$this->listdesa);
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }
        
        //make result array from the tables name
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            for($i=1;$i<=30;$i++){
                $day     = 30-$i;
                $date    = date("Y-m-d",  strtotime("-".$day." days"));
                $data[$date] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="registrasi_gizi"){
                $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,DATE(clientversionsubmissiondate)");
                foreach ($query->result() as $datas){
                    if(array_key_exists($datas->dusun, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$datas->dusun]];
                        if(array_key_exists($datas->submissiondate, $data_count)){
                            $data_count[$datas->submissiondate] +=$datas->counts;
                        }
                        $result_data[$namadusun[$datas->dusun]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        if(array_key_exists($datas->submissiondate, $data_count)){
                            $data_count[$datas->submissiondate] +=$datas->counts;
                        }
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }elseif($table=="kunjungan_gizi"){
                $query = $giziDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $giziDB->query("SELECT dusun FROM registrasi_gizi where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->dusun, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->dusun]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$c2_data->dusun]] = $data_count;
                        }else{
                            $data_count                  = $result_data["Lainnya"];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data["Lainnya"] = $data_count;
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($desa="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('gizi', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM opensrp_gizi");
        
        $table_default = [
            'kunjungan_gizi'=>'Kunjungan Gizi',
            'registrasi_gizi'=>'Registrasi Gizi'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_gizi, $table_default)){
                array_push($tables, $table->Tables_in_opensrp_gizi);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $username = array_search($desa,$this->listdesa);
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            
            if($mode=='Mingguan'){
                $data['thisweek'] = array();
                $data['lastweek'] = array();                       
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['thisweek'] = $day_temp;
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['lastweek'] = $day_temp;
                
            }elseif($mode=='Bulanan'){
                $data['thisyear'] = array();
                $data['lastyear'] = array();
                $this_month = date("n");
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i)." months"));
                    $month[$date]   =   0;
                }
                $data['thisyear'] = $month;
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i-12)." months"));
                    $month[$date]   =   0;
                }
                $data['lastyear'] = $month;
            }
            $result_data[$nama] = $data;
        }
        
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($table=="registrasi_gizi"){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by dusun, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by dusun, DATE(clientversionsubmissiondate)");
                }
                foreach ($query->result() as $datas){
                    if($mode=='Mingguan'){
                        if(array_key_exists($datas->dusun, $namadusun)){
                            $week   =   $result_data[$namadusun[$datas->dusun]];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($datas->submissiondate, $thisweek)){
                                $thisweek[$datas->submissiondate] +=$datas->counts;
                            }
                            if(array_key_exists($datas->submissiondate, $lastweek)){
                                $lastweek[$datas->submissiondate] +=$datas->counts;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data[$namadusun[$datas->dusun]] = $week;
                        }else{
                            $week   =   $result_data["Lainnya"];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($datas->submissiondate, $thisweek)){
                                $thisweek[$datas->submissiondate] +=$datas->counts;
                            }
                            if(array_key_exists($datas->submissiondate, $lastweek)){
                                $lastweek[$datas->submissiondate] +=$datas->counts;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data["Lainnya"] = $week;
                        }
                    }elseif($mode=='Bulanan'){
                        if(array_key_exists($datas->dusun, $namadusun)){
                            $month = $result_data[$namadusun[$datas->dusun]];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $datas->submissiondate);
                            array_pop($m);
                            $datas->submissiondate = implode('-',$m);
                            if(array_key_exists($datas->submissiondate, $thisyear)){
                                $thisyear[$datas->submissiondate] +=$datas->counts;
                            }
                            if(array_key_exists($datas->submissiondate, $lastyear)){
                                $lastyear[$datas->submissiondate] +=$datas->counts;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data[$namadusun[$datas->dusun]] = $month;
                        }else{
                            $month = $result_data["Lainnya"];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $datas->submissiondate);
                            array_pop($m);
                            $datas->submissiondate = implode('-',$m);
                            if(array_key_exists($datas->submissiondate, $thisyear)){
                                $thisyear[$datas->submissiondate] +=$datas->counts;
                            }
                            if(array_key_exists($datas->submissiondate, $lastyear)){
                                $lastyear[$datas->submissiondate] +=$datas->counts;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data["Lainnya"] = $month;
                        }
                    }
                }
            }elseif($table=="kunjungan_gizi"){
                if($mode=='Mingguan'){
                    $query = $giziDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $giziDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $giziDB->query("SELECT dusun FROM registrasi_gizi where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($mode=='Mingguan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $week   =   $result_data[$namadusun[$c2_data->dusun]];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data[$namadusun[$c2_data->dusun]] = $week;
                            }else{
                                $week   =   $result_data["Lainnya"];
                                $thisweek   = $week['thisweek'];
                                $lastweek   = $week['lastweek'];
                                if(array_key_exists($c_data->submissiondate, $thisweek)){
                                    $thisweek[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastweek)){
                                    $lastweek[$c_data->submissiondate] +=1;
                                }
                                $week['thisweek'] = $thisweek;
                                $week['lastweek'] = $lastweek;
                                $result_data["Lainnya"] = $week;
                            }
                        }elseif($mode=='Bulanan'){
                            if(array_key_exists($c2_data->dusun, $namadusun)){
                                $month = $result_data[$namadusun[$c2_data->dusun]];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data[$namadusun[$c2_data->dusun]] = $month;
                            }else{
                                $month = $result_data["Lainnya"];
                                $thisyear = $month['thisyear'];
                                $lastyear = $month['lastyear'];
                                $m = explode('-', $c_data->submissiondate);
                                array_pop($m);
                                $c_data->submissiondate = implode('-',$m);
                                if(array_key_exists($c_data->submissiondate, $thisyear)){
                                    $thisyear[$c_data->submissiondate] +=1;
                                }
                                if(array_key_exists($c_data->submissiondate, $lastyear)){
                                    $lastyear[$c_data->submissiondate] +=1;
                                }
                                $month['thisyear'] = $thisyear;
                                $month['lastyear'] = $lastyear;
                                $result_data["Lainnya"] = $month;
                            }
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
}