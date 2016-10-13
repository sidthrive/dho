<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorFhwModel extends CI_Model{
    
    private $listdusun = ['vaksinator1' =>array('Gulung'=>'Gulung','Lekor+Timur'=>'Lekor Timur','Lekor Timur'=>'Lekor Timur','Lekor+Barat'=>'Lekor Barat','Lekor Barat'=>'Lekor Barat','Lendang+Jawe'=>'Pepao Barat','Lengkok Bunut'=>'Lengkok Bunut','Lengkok+Bunut'=>'Lengkok Bunut','Montong+Bile'=>'Pepao Tengah','Pelapak'=>'Pelapak','Pepao+Barat+I'=>'Pepao Barat','Pepao Barat I'=>'Pepao Barat','Pepao+Barat+II'=>'Pepao Barat','Pepao Barat II'=>'Pepao Barat','Pepao+Timur'=>'Pepao Timur','Pepao Timur'=>'Pepao Timur','Presak'=>'Presak','Renge'=>'Renge','Sondo'=>'Sondo','Taken-Aken'=>"Taken Aken",'Walun'=>'Walun','Lendang Jawe'=>'Pepao Barat','Menteger'=>'Pelapak','Berenge'=>'Pelapak','Embung Wile'=>'Gulung','Sandat'=>'Lekor Timur','Ambat'=>'Pelapak','Montong Bile'=>'Pepao Tengah','Wiyung'=>'Gulung','Lekor Tengah'=>'Lekor Timur','Belo'=>'Walun','Selaping'=>'Gulung','Bare Putih','Dongger','Lempenge',"Lainnya"=>"Lainnya")
                        ,'vaksinator2' =>array("Tenges Enges"=>"Tenges Enges","Sengkerek Timur"=>"Sengkerek Timur","Selek Direk"=>"Selek Direk","Jembe+Barat"=>"Jembe Barat","Jembe+Timur"=>"Jembe Timur","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Janggawana"=>"Janggawana Selatan","Sengkerek"=>"Sengkerek","Lingkok+Buak+Barat"=>"Lingkok Buak Barat","Lingkok+Buak+Tengah"=>"Lingkok Buak Tengah","Lingkok+Buak+Timur"=>"Lingkok Buak Timur","Melati"=>"Melati","Selek"=>"Selek","Gundu"=>"Gundu","Masjawa"=>"Masjaya","Presak+Sanggeng"=>"Presak Sanggeng","Tentram"=>"Tentram","Terentem"=>"Terentem","Keruak"=>"Keruak","Keruak Utara"=>"Keruak Utara","Masjaya"=>"Masjaya","Presak Sanggeng"=>"Presak Sanggeng","Janggawana+Selatan"=>"Janggawana Selatan","Janggawana+Utara"=>"Janggawana Utara","Janggawana+Tengah"=>"Janggawana Tengah","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Utara"=>"Jembe Utara","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur","Lingkok Buak Tengah"=>"Lingkok Buak Tengah","Lingkok Buak Timur"=>"Lingkok Buak Timur","Lainnya"=>"Lainnya")
                        ,'vaksinator3' =>array("Pendem"=>"Pendem","Piling"=>"Piling","Maliklo"=>"Maliklo","Jelitong"=>"Jelitong","Karang+Majelo"=>"Karang Majelo","Karang Majelo"=>"Karang Majelo","Penuntut"=>"Penuntut","Kuang"=>"Kuang","Jangka"=>"Jangka","Petorok"=>"Petorok","Gelung"=>"Gelung","Gelondong"=>"Gelondong","Nyangget"=>"Nyangget","Montong+Bile"=>"Montong Bile","Montong Bile"=>"Montong Bile","Lekong+Bangkon"=>"Lekong Bangkon","Lekong Bangkon"=>"Lekong Bangkon","Lainnya"=>"Lainnya")
                        ,'vaksinator4' =>array("Juna"=>"Juna","Nunang"=>"Nunang","Batu+Belek"=>"Batu Belek","Batu Belek"=>"Batu Belek","Siwi"=>"Siwi","Setuta+Barat"=>"Setuta Barat","Setuta Barat"=>"Setuta Barat","Setuta+Timur"=>"Setuta Timur","Setuta Timur"=>"Setuta Timur","Liwung"=>"Liwung","Liwung_Selatan"=>"Liwung Selatan","Biletawah"=>"Biletawah","Liwung+Satu"=>"Liwung Satu","Liwung Satu"=>"Liwung Satu","Liwung+Dua"=>"Liwung Dua","Liwung Dua"=>"Liwung Dua","Nunang+Selatan"=>"Nunang Selatan","Lainnya"=>"Lainnya")
                        ,'vaksinator5' =>array("Rungkang+Timur"=>"Rungkang Timur","Rungkang Timur"=>"Rungkang Timur","Rungkang+Barat"=>"Rungkang Barat","Rungkang Barat"=>"Rungkang Barat","Puntik+Baru"=>"Puntik Baru","Puntik Baru"=>"Puntik Baru","Jango+Selatan"=>"Jango Selatan","Jango Selatan"=>"Jango Selatan","Jango Utara"=>"Jango Utara","Kenyalu+Utara"=>"Kenyalu II","Kenyalu Utara"=>"Kenyalu II","Kenyalu+Barat"=>"Kenyalu I","Kenyalu Barat"=>"Kenyalu I","Kenyalu+Selatan"=>"Kenyalu I","Kenyalu Selatan"=>"Kenyalu I","Kenyalu+Timur"=>"Kenyalu II","Kenyalu Timur"=>"Kenyalu II","Kampung+Baru"=>"Grepek","Kampung Baru"=>"Grepek","Arba"=>"Jango Selatan","Batu Ngereng"=>"Jango Selatan","Gerepek"=>"Grepek","Jango+Utara"=>"Jango Utara","Lainnya"=>"Lainnya")
                        ,'vaksinator6' =>array("Bolor"=>"Bolor","Bukit Awas"=>"Bukit Awas","Gempang"=>"Gempang","Peresak Jenggang"=>"Peresak Jenggang","Montong Kesene"=>"Montong Kesene","Batu Bungus Utara"=>"Batu Bungus Utara","Lokon"=>"Lokon","Geong Manis"=>"Geong Manis","Kedapang"=>"Kedapang","Menyer"=>"Menyer","Janapria"=>"Janapria","Lemokek"=>"Lemokek","Tempek-Empek"=>"Tempek Empek","Tempek Empek"=>"Tempek Empek","Batu+Bangus"=>"Batu Bangus","Nunang+I"=>"Nunang Utara","Nunang I"=>"Nunang Utara","Nunang+Utara"=>"Nunang Utara","Nunang Utara"=>"Nunang Utara","Perok+Timur"=>"Perok Timur","Perok Timur"=>"Perok Timur","Batu+Kembar+II"=>"Batu Kembar Timur","Batu Kembar II"=>"Batu Kembar Timur","Batu+Kembar+I"=>"Batu Kembar Barat","Batu Kembar I"=>"Batu Kembar Barat","Pengebat"=>"Pengebat","Sadah"=>"Sadah","Penambong"=>"Penambong","Tonjong"=>"Tonjong","Pendem"=>"Pendem","Perok+Barat"=>"Perok Barat","Perok Barat"=>"Perok Barat","Lambah+Olot"=>"Lambah Olot","Lambah Olot"=>"Lambah Olot","Lainnya"=>"Lainnya")
                        ,'vaksinator8' =>array("Dese"=>"Dese","Abe"=>"Abe","Sampet"=>"Sampet","Sempalan"=>"Sempalan","Selak"=>"Lebak","Dayen+Rurung"=>"Dayen Rurung","Dayen Rurung"=>"Dayen Rurung","Embung+Rungkas"=>"Embung Rungkas","Embung Rungkas"=>"Embung Rungkas","Reban"=>"Sarah","Plangsang"=>"Bagek Dewe","Lebak"=>"Lebak","Bagek+Payung"=>"Lebak","bagek payung"=>"Lebak","Sarah"=>"Sarah","Bagek+Dewe"=>"Bagek Dewe","Perigi"=>"Abe","Bagek Dewe"=>"Bagek Dewe","Enggaek"=>"Sempalan","Sarah Botok"=>"Sarah","Karang Bayan"=>"Bagek Dewe","Ular Naga"=>"Sampet","Napur"=>"Sampet","Gendang"=>"Sampet","Penyeleng"=>"Abe","Godok"=>"Abe","Mange"=>"Abe","Bikan"=>"Abe","Pait"=>"Abe","Lainnya"=>"Lainnya")
                        ,'vaksinator9' =>array("Piyang"=>"Piyang","Kale"=>"Kale","Belong"=>"Belong","Semundal"=>"Semundal","Jomang"=>"Jomang","Lotir"=>"Lotir","Sengkol+I"=>"Sengkol I","Sengkol I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Puji Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Sengkol II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'vaksinator10'=>array("Piyang"=>"Piyang","Kale"=>"Kale","Belong"=>"Belong","Semundal"=>"Semundal","Jomang"=>"Jomang","Lotir"=>"Lotir","Sengkol+I"=>"Sengkol I","Sengkol I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Puji Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Sengkol II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'vaksinator11'=>array("Karang+Jangkong"=>"Karang Jangkong","Karang Jangkong"=>"Karang Jangkong","Gilik"=>"Gilik","Karang+Daye"=>"Karang Daye","Karang Daye"=>"Karang Daye","Balen+Along"=>"Balen Along","Bale+Montong+I"=>"Bale Montong I","Gubuk+Direk"=>"Gubuk Direk","Gubuk Direk"=>"Gubuk Direk","Pengadang"=>"Pengadang","Sarang+Angin"=>"Sarang Angin","Sarang Angin"=>"Sarang Angin","Dayen+Kubur"=>"Dayen Kubur","Dayen Kubur"=>"Dayen Kubur","Bale+Montong+II"=>"Bale Montong II","Gonjong"=>"Gonjong","Gampung"=>"Gampung","Taman+Bumi+Gora"=>"Bumi Gora","Buntereng"=>"Buntereng","Wareng"=>"Wareng","Pance"=>"Pance","Bumi+Gora"=>"Bumi Gora","Batu+Bangke"=>"Batu Bangke","Batu Bangke"=>"Batu Bangke","Bumi Gora"=>"Bumi Gora","Bale Montong I"=>"Bale Montong I","Balen Along"=>"Balen Along","Bale Montong II"=>"Bale Montong II","Lainnya"=>"Lainnya")
                        ,'vaksinator12'=>array("Singa"=>"Singa","Perendek"=>"Perendek","Tanak+Awu+Bat"=>"Tanak Awu Bat","Selawang"=>"Selawang","Tanak+Awu+I"=>"Tanak Awu I","Perendik"=>"Perendek","Gantang+Daye"=>"Gantang Daye","Tanak+Awu+II"=>"Tanak Awu II","Rebile"=>"Rebile","Tatak"=>"Tatak","Reak+II"=>"Reak II","Reak+I"=>"Reak I","Gantang+Lauk"=>"Gantang Lauk","Gantang+Bat"=>"Gantang Bat","Gantang+Timuk"=>"Gantang Timuk","Sengkol+II"=>"Sengkol II","Selawang+Timuq"=>"Selawang Timuq","Selawang+Bat"=>"Selawang Bat","Selawang Bat"=>"Selawang Bat","Jambek+II"=>"Jambek II","Jambek+I"=>"Jambek I","Gantang Daye"=>"Gantang Daye","Tanak Awu Bat"=>"Tanak Awu Bat","Reak I"=>"Reak I","Reak II"=>"Reak II","Selawang Timuq"=>"Selawang Timuq","Gantang Bat"=>"Gantang Bat","Jambek II"=>"Jambek II","Jambek I"=>"Jambek I","Tanak Awu II"=>"Tanak Awu II","Gantang Lauk"=>"Gantang Lauk","Tanak Awu I"=>"Tanak Awu I","Lainnya"=>"Lainnya")
                        ,'vaksinator13'=>array("Pengembur+III"=>"Pengembur III","Rajan"=>"Pengembur I","Tamping"=>"Tamping","Sepit"=>"Sepit","Penyampi"=>"Penyampi","Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat","Tawah"=>"Tawah","Pengembur+II"=>"Pengembur II","Sinah"=>"Sinah","Pengembur+I"=>"Pengembur I","Batu+Belek"=>"Batu Belek","Pengembur I"=>"Pengembur I","Batu Belek"=>"Batu Belek","Pengembur II"=>"Pengembur II","Pengembur III"=>"Pengembur III","Lainnya"=>"Lainnya")
                        ,'vaksinator14'=>array("Bolok"=>"Bolok","Anak+Anjan"=>"Anak Anjan","Penupi"=>"Penupi","Kadik+I"=>"Penupi","Kadik I"=>"Penupi","Karang+baru"=>"Karang Baru","Karang baru"=>"Karang Baru","Tenang"=>"Tenang","Lamben"=>"Lamben","Tuban"=>"Anak Anjan","Segale"=>"Anak Anjan","Tenang+Baru"=>"Tenang","Tenang Baru"=>"Tenang","Kadik+II"=>"Kadik","Anak Anjan"=>"Anak Anjan","Kadik II"=>"Kadik","Dasan Duah"=>"Kadik","Lainnya"=>"Lainnya")];
    private $listdesa = ['vaksinator1'=>'Lekor','vaksinator2'=>'Saba','vaksinator3'=>'Pendem','vaksinator4'=>'Setuta','vaksinator5'=>'Jango','vaksinator6'=>'Janapria','vaksinator8'=>'Ketara','vaksinator9'=>'Sengkol','vaksinator10'=>'Sengkol','vaksinator11'=>'Kawo','vaksinator12'=>'Tanak Awu','vaksinator13'=>'Pengembur','vaksinator14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        $table_default = [
            'registrasi_jurim'=>'Registrasi Vaksinator',
            'bcg_visit'=>'Vaksinasi BCG',
            'hb0_visit'=>'Vaksinasi HB0',
            'hb1_visit'=>'Vaksinasi HB1',
            'dpt_hb2_visit'=>'Vaksinasi HB2',
            'hb3_visit'=>'Vaksinasi HB3',
            'polio1_visit'=>'Vaksinasi POLIO 1',
            'polio2_visit'=>'Vaksinasi POLIO 2',
            'polio3_visit'=>'Vaksinasi POLIO 3',
            'polio4_visit'=>'Vaksinasi POLIO 4',
            'campak_visit'=>'Vaksinasi CAMPAK',
            'campak_lanjutan_visit'=>'Vaksinasi CAMPAK BOOSTER',
            'ipv_visit'=>'Vaksinasi IPV',
            'vaksinator_edit'=>'Edit Form'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_jurim, $table_default)){
                $tables[$table->Tables_in_opensrp_jurim]=$table_default[$table->Tables_in_opensrp_jurim];
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
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="registrasi_jurim"||$table=="vaksinator_edit"){
                if($table=="registrasi_jurim") $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,village,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,village");
                else $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun");
                foreach ($query->result() as $datas){
                    if($datas->dusun=='-'||$datas->dusun=='') $dusun_name = $datas->village;
                    else $dusun_name = $datas->dusun;
                    if(array_key_exists($dusun_name, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$dusun_name]];
                        $data_count[$legend]         += $datas->counts;
                        $result_data[$namadusun[$dusun_name]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        $data_count[$legend]         += $datas->counts;
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }elseif($table!="registrasi_jurim"&&$table!="vaksinator_edit"){
                $query = $vaksinatorDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $vaksinatorDB->query("SELECT village,dusun FROM registrasi_jurim where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($c2_data->dusun=='-'||$c2_data->dusun=='') $dusun_name = $c2_data->village;
                        else $dusun_name = $c2_data->dusun;
                        if(array_key_exists($dusun_name, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$dusun_name]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$dusun_name]] = $data_count;
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
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        $table_default = [
            'registrasi_jurim'=>'Registrasi Vaksinator',
            'bcg_visit'=>'Vaksinasi BCG',
            'hb0_visit'=>'Vaksinasi HB0',
            'hb1_visit'=>'Vaksinasi HB1',
            'dpt_hb2_visit'=>'Vaksinasi HB2',
            'hb3_visit'=>'Vaksinasi HB3',
            'polio1_visit'=>'Vaksinasi POLIO 1',
            'polio2_visit'=>'Vaksinasi POLIO 2',
            'polio3_visit'=>'Vaksinasi POLIO 3',
            'polio4_visit'=>'Vaksinasi POLIO 4',
            'campak_visit'=>'Vaksinasi CAMPAK',
            'campak_lanjutan_visit'=>'Vaksinasi CAMPAK BOOSTER',
            'ipv_visit'=>'Vaksinasi IPV',
            'vaksinator_edit'=>'Edit Form'];
        $tabindex = [
            'registrasi_jurim'=>0,
            'bcg_visit'=>1,
            'hb0_visit'=>2,
            'hb1_visit'=>3,
            'dpt_hb2_visit'=>4,
            'hb3_visit'=>5,
            'polio1_visit'=>6,
            'polio2_visit'=>7,
            'polio3_visit'=>8,
            'polio4_visit'=>9,
            'campak_visit'=>10,
            'campak_lanjutan_visit'=>11,
            'ipv_visit'=>12,
            'vaksinator_edit'=>13];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_jurim, $table_default)){
                $tables[$table->Tables_in_opensrp_jurim]=$table_default[$table->Tables_in_opensrp_jurim];
            }
        }
        $username = $this->session->userdata('username');
        $listdusun = $this->listdusun[$username];
        $namadusun = array();
        foreach ($listdusun as $x=>$n){
            if($n==$dusun){
                $namadusun[$x]=$dusun;
            }
        }
        
        
        //make result array from the tables name
        $result_data = array();
        $data = array();
        $data[$date] = array();
        foreach ($table_default as $table=>$table_name){
            $data[$date]["name"] = $date;
            $data[$date]["id"] = $date;
            $data[$date]["data"] = array();
            foreach ($table_default as $td=>$td_name){
                array_push($data[$date]["data"], array($td_name,0));
            }
        }
        $result_data = $data;
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($tables as $table=>$legend){
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="registrasi_jurim"||$table=="vaksinator_edit"){
                if($table=="registrasi_jurim") $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,village,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,village");
                else $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun");
                foreach ($query->result() as $datas){
                    if($datas->dusun=='-'||$datas->dusun=='') $dusun_name = $datas->village;
                    else $dusun_name = $datas->dusun;
                    if(array_key_exists($dusun_name, $namadusun)){
                        $data_count                  = $result_data[$date];
                        if(array_key_exists($table, $table_default)){
                            $data_count["data"][$tabindex[$table]][1]         += $datas->counts;
                        }
                        $result_data[$date] = $data_count;
                    }
                }
            }elseif($table!="registrasi_jurim"&&$table!="vaksinator_edit"){
                $query = $vaksinatorDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $vaksinatorDB->query("SELECT village,dusun FROM registrasi_jurim where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($c2_data->dusun=='-'||$c2_data->dusun=='') $dusun_name = $c2_data->village;
                        else $dusun_name = $c2_data->dusun;
                        if(array_key_exists($dusun_name, $namadusun)){
                            $data_count                  = $result_data[$date];
                            if(array_key_exists($table, $table_default)){
                                $data_count["data"][$tabindex[$table]][1]         += 1;
                            }
                            $result_data[$date] = $data_count;
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
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        
        $table_default = [
            'registrasi_jurim'=>'Registrasi Vaksinator',
            'bcg_visit'=>'Vaksinasi BCG',
            'hb0_visit'=>'Vaksinasi HB0',
            'hb1_visit'=>'Vaksinasi HB1',
            'dpt_hb2_visit'=>'Vaksinasi HB2',
            'hb3_visit'=>'Vaksinasi HB3',
            'polio1_visit'=>'Vaksinasi POLIO 1',
            'polio2_visit'=>'Vaksinasi POLIO 2',
            'polio3_visit'=>'Vaksinasi POLIO 3',
            'polio4_visit'=>'Vaksinasi POLIO 4',
            'campak_visit'=>'Vaksinasi CAMPAK',
            'campak_lanjutan_visit'=>'Vaksinasi CAMPAK BOOSTER',
            'ipv_visit'=>'Vaksinasi IPV',
            'vaksinator_edit'=>'Edit Form'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_jurim, $table_default)){
                array_push($tables, $table->Tables_in_opensrp_jurim);
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
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="registrasi_jurim"||$table=="vaksinator_edit"){
                if($table=="registrasi_jurim") $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,village,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,village,DATE(clientversionsubmissiondate)");
                else $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,DATE(clientversionsubmissiondate)");
                foreach ($query->result() as $datas){
                    if($datas->dusun=='-'||$datas->dusun=='') $dusun_name = $datas->village;
                    else $dusun_name = $datas->dusun;
                    if(array_key_exists($dusun_name, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$dusun_name]];
                        if(array_key_exists($datas->submissiondate, $data_count)){
                            $data_count[$datas->submissiondate] +=$datas->counts;
                        }
                        $result_data[$namadusun[$dusun_name]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        if(array_key_exists($datas->submissiondate, $data_count)){
                            $data_count[$datas->submissiondate] +=$datas->counts;
                        }
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }elseif($table!="registrasi_jurim"&&$table!="vaksinator_edit"){
                $query = $vaksinatorDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $vaksinatorDB->query("SELECT village,dusun FROM registrasi_jurim where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($c2_data->dusun=='-'||$c2_data->dusun=='') $dusun_name = $c2_data->village;
                        else $dusun_name = $c2_data->dusun;
                        if(array_key_exists($dusun_name, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$dusun_name]];
                            if(array_key_exists($c_data->submissiondate, $data_count)){
                                $data_count[$c_data->submissiondate] += 1;;
                            }
                            $result_data[$namadusun[$dusun_name]] = $data_count;
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
        $vaksinatorDB = $this->load->database('vaksinator', TRUE);
        $query  = $vaksinatorDB->query("SHOW TABLES FROM opensrp_jurim");
        
        $table_default = [
            'registrasi_jurim'=>'Registrasi Vaksinator',
            'bcg_visit'=>'Vaksinasi BCG',
            'hb0_visit'=>'Vaksinasi HB0',
            'hb1_visit'=>'Vaksinasi HB1',
            'dpt_hb2_visit'=>'Vaksinasi HB2',
            'hb3_visit'=>'Vaksinasi HB3',
            'polio1_visit'=>'Vaksinasi POLIO 1',
            'polio2_visit'=>'Vaksinasi POLIO 2',
            'polio3_visit'=>'Vaksinasi POLIO 3',
            'polio4_visit'=>'Vaksinasi POLIO 4',
            'campak_visit'=>'Vaksinasi CAMPAK',
            'campak_lanjutan_visit'=>'Vaksinasi CAMPAK BOOSTER',
            'ipv_visit'=>'Vaksinasi IPV',
            'vaksinator_edit'=>'Edit Form'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_jurim, $table_default)){
                array_push($tables, $table->Tables_in_opensrp_jurim);
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
            $query = $vaksinatorDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($table=="registrasi_jurim"||$table=="vaksinator_edit"){
                if($mode=='Mingguan'){
                    if($table=="registrasi_jurim") $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,village,dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by dusun,village, DATE(clientversionsubmissiondate)");
                    else $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by dusun, DATE(clientversionsubmissiondate)");
                }elseif($mode=='Bulanan'){
                    if($table=="registrasi_jurim") $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate,village,dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by dusun, village, DATE(clientversionsubmissiondate)");
                    else $query = $vaksinatorDB->query("SELECT userid, DATE(clientversionsubmissiondate) as submissiondate, dusun,count(*) as counts from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by dusun,DATE(clientversionsubmissiondate)");
                }
                foreach ($query->result() as $datas){
                    if($datas->dusun=='-'||$datas->dusun=='') $dusun_name = $datas->village;
                    else $dusun_name = $datas->dusun;
                    if($mode=='Mingguan'){
                        if(array_key_exists($dusun_name, $namadusun)){
                            $week   =   $result_data[$namadusun[$dusun_name]];
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
                            $result_data[$namadusun[$dusun_name]] = $week;
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
                        if(array_key_exists($dusun_name, $namadusun)){
                            $month = $result_data[$namadusun[$dusun_name]];
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
                            $result_data[$namadusun[$dusun_name]] = $month;
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
            }elseif($table!="registrasi_jurim"&&$table!="vaksinator_edit"){
                if($mode=='Mingguan'){
                    $query = $vaksinatorDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $vaksinatorDB->query("SELECT userid, childId, DATE(clientversionsubmissiondate) as submissiondate from ".$table." where (userid='$username') and (DATE(clientversionsubmissiondate) >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and DATE(clientversionsubmissiondate) <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $vaksinatorDB->query("SELECT village,dusun FROM registrasi_jurim where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        if($c2_data->dusun=='-'||$c2_data->dusun=='') $dusun_name = $c2_data->village;
                        else $dusun_name = $c2_data->dusun;
                        if($mode=='Mingguan'){
                            if(array_key_exists($dusun_name, $namadusun)){
                                $week   =   $result_data[$namadusun[$dusun_name]];
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
                                $result_data[$namadusun[$dusun_name]] = $week;
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
                            if(array_key_exists($dusun_name, $namadusun)){
                                $month = $result_data[$namadusun[$dusun_name]];
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
                                $result_data[$namadusun[$dusun_name]] = $month;
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