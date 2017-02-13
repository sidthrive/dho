<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsFhwEcModel extends CI_Model{
    
    private $listdusun = ['user1' =>array('Gulung'=>'Gulung','Lekor+Timur'=>'Lekor Timur','Lekor Timur'=>'Lekor Timur','Lekor+Barat'=>'Lekor Barat','Lekor Barat'=>'Lekor Barat','Lendang+Jawe'=>'Pepao Barat','Lengkok Bunut'=>'Lengkok Bunut','Lengkok+Bunut'=>'Lengkok Bunut','Montong+Bile'=>'Pepao Tengah','Pelapak'=>'Pelapak','Pepao+Barat+I'=>'Pepao Barat','Pepao Barat I'=>'Pepao Barat','Pepao+Barat+II'=>'Pepao Barat','Pepao Barat II'=>'Pepao Barat','Pepao+Timur'=>'Pepao Timur','Pepao Timur'=>'Pepao Timur','Presak'=>'Presak','Renge'=>'Renge','Sondo'=>'Sondo','Taken-Aken'=>"Taken Aken",'Walun'=>'Walun','Lendang Jawe'=>'Pepao Barat','Menteger'=>'Pelapak','Berenge'=>'Pelapak','Embung Wile'=>'Gulung','Sandat'=>'Lekor Timur','Ambat'=>'Pelapak','Montong Bile'=>'Pepao Tengah','Wiyung'=>'Gulung','Lekor Tengah'=>'Lekor Timur','Belo'=>'Walun','Selaping'=>'Gulung','Bare Putih','Dongger','Lempenge',"Lainnya"=>"Lainnya")
                        ,'user2' =>array("Tenges Enges"=>"Tenges Enges","Sengkerek Timur"=>"Sengkerek Timur","Selek Direk"=>"Selek Direk","Jembe+Barat"=>"Jembe Barat","Jembe+Timur"=>"Jembe Timur","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Janggawana"=>"Janggawana Selatan","Sengkerek"=>"Sengkerek","Lingkok+Buak+Barat"=>"Lingkok Buak Barat","Lingkok+Buak+Tengah"=>"Lingkok Buak Tengah","Lingkok+Buak+Timur"=>"Lingkok Buak Timur","Melati"=>"Melati","Selek"=>"Selek","Gundu"=>"Gundu","Masjawa"=>"Masjaya","Presak+Sanggeng"=>"Presak Sanggeng","Tentram"=>"Tentram","Terentem"=>"Terentem","Keruak"=>"Keruak","Keruak Utara"=>"Keruak Utara","Masjaya"=>"Masjaya","Presak Sanggeng"=>"Presak Sanggeng","Janggawana+Selatan"=>"Janggawana Selatan","Janggawana+Utara"=>"Janggawana Utara","Janggawana+Tengah"=>"Janggawana Tengah","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Utara"=>"Jembe Utara","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur","Lingkok Buak Tengah"=>"Lingkok Buak Tengah","Lingkok Buak Timur"=>"Lingkok Buak Timur","Lainnya"=>"Lainnya")
                        ,'user3' =>array("Pendem"=>"Pendem","Piling"=>"Piling","Maliklo"=>"Maliklo","Jelitong"=>"Jelitong","Karang+Majelo"=>"Karang Majelo","Karang Majelo"=>"Karang Majelo","Penuntut"=>"Penuntut","Kuang"=>"Kuang","Jangka"=>"Jangka","Petorok"=>"Petorok","Gelung"=>"Gelung","Gelondong"=>"Gelondong","Nyangget"=>"Nyangget","Montong+Bile"=>"Montong Bile","Montong Bile"=>"Montong Bile","Lekong+Bangkon"=>"Lekong Bangkon","Lekong Bangkon"=>"Lekong Bangkon","Lainnya"=>"Lainnya")
                        ,'user4' =>array("Juna"=>"Juna","Nunang"=>"Nunang","Batu+Belek"=>"Batu Belek","Batu Belek"=>"Batu Belek","Siwi"=>"Siwi","Setuta+Barat"=>"Setuta Barat","Setuta Barat"=>"Setuta Barat","Setuta+Timur"=>"Setuta Timur","Setuta Timur"=>"Setuta Timur","Liwung"=>"Liwung","Liwung_Selatan"=>"Liwung Selatan","Biletawah"=>"Biletawah","Liwung+Satu"=>"Liwung Satu","Liwung Satu"=>"Liwung Satu","Liwung+Dua"=>"Liwung Dua","Liwung Dua"=>"Liwung Dua","Nunang+Selatan"=>"Nunang Selatan","Lainnya"=>"Lainnya")
                        ,'user5' =>array("Rungkang+Timur"=>"Rungkang Timur","Rungkang Timur"=>"Rungkang Timur","Rungkang+Barat"=>"Rungkang Barat","Rungkang Barat"=>"Rungkang Barat","Puntik+Baru"=>"Puntik Baru","Puntik Baru"=>"Puntik Baru","Jango+Selatan"=>"Jango Selatan","Jango Selatan"=>"Jango Selatan","Jango Utara"=>"Jango Utara","Kenyalu+Utara"=>"Kenyalu II","Kenyalu Utara"=>"Kenyalu II","Kenyalu+Barat"=>"Kenyalu I","Kenyalu Barat"=>"Kenyalu I","Kenyalu+Selatan"=>"Kenyalu I","Kenyalu Selatan"=>"Kenyalu I","Kenyalu+Timur"=>"Kenyalu II","Kenyalu Timur"=>"Kenyalu II","Kampung+Baru"=>"Grepek","Kampung Baru"=>"Grepek","Arba"=>"Jango Selatan","Batu Ngereng"=>"Jango Selatan","Gerepek"=>"Grepek","Jango+Utara"=>"Jango Utara","Lainnya"=>"Lainnya")
                        ,'user6' =>array("Bolor"=>"Bolor","Bukit Awas"=>"Bukit Awas","Gempang"=>"Gempang","Peresak Jenggang"=>"Peresak Jenggang","Montong Kesene"=>"Montong Kesene","Batu Bungus Utara"=>"Batu Bungus Utara","Lokon"=>"Lokon","Geong Manis"=>"Geong Manis","Kedapang"=>"Kedapang","Menyer"=>"Menyer","Janapria"=>"Janapria","Lemokek"=>"Lemokek","Tempek-Empek"=>"Tempek Empek","Tempek Empek"=>"Tempek Empek","Batu+Bangus"=>"Batu Bangus","Nunang+I"=>"Nunang Utara","Nunang I"=>"Nunang Utara","Nunang+Utara"=>"Nunang Utara","Nunang Utara"=>"Nunang Utara","Perok+Timur"=>"Perok Timur","Perok Timur"=>"Perok Timur","Batu+Kembar+II"=>"Batu Kembar Timur","Batu Kembar II"=>"Batu Kembar Timur","Batu+Kembar+I"=>"Batu Kembar Barat","Batu Kembar I"=>"Batu Kembar Barat","Pengebat"=>"Pengebat","Sadah"=>"Sadah","Penambong"=>"Penambong","Tonjong"=>"Tonjong","Pendem"=>"Pendem","Perok+Barat"=>"Perok Barat","Perok Barat"=>"Perok Barat","Lambah+Olot"=>"Lambah Olot","Lambah Olot"=>"Lambah Olot","Lainnya"=>"Lainnya")
                        ,'user8' =>array("Dese"=>"Dese","Abe"=>"Abe","Sampet"=>"Sampet","Sempalan"=>"Sempalan","Selak"=>"Lebak","Dayen+Rurung"=>"Dayen Rurung","Dayen Rurung"=>"Dayen Rurung","Embung+Rungkas"=>"Embung Rungkas","Embung Rungkas"=>"Embung Rungkas","Reban"=>"Sarah","Plangsang"=>"Bagek Dewe","Lebak"=>"Lebak","Bagek+Payung"=>"Lebak","bagek payung"=>"Lebak","Sarah"=>"Sarah","Bagek+Dewe"=>"Bagek Dewe","Perigi"=>"Abe","Bagek Dewe"=>"Bagek Dewe","Enggaek"=>"Sempalan","Sarah Botok"=>"Sarah","Karang Bayan"=>"Bagek Dewe","Ular Naga"=>"Sampet","Napur"=>"Sampet","Gendang"=>"Sampet","Penyeleng"=>"Abe","Godok"=>"Abe","Mange"=>"Abe","Bikan"=>"Abe","Pait"=>"Abe","Lainnya"=>"Lainnya")
                        ,'user9' =>array("Piyang"=>"Piyang","Kale"=>"Kale","Belong"=>"Belong","Semundal"=>"Semundal","Jomang"=>"Jomang","Lotir"=>"Lotir","Sengkol+I"=>"Sengkol I","Sengkol I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Puji Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Sengkol II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'user10'=>array("Piyang"=>"Piyang","Kale"=>"Kale","Belong"=>"Belong","Semundal"=>"Semundal","Jomang"=>"Jomang","Lotir"=>"Lotir","Sengkol+I"=>"Sengkol I","Sengkol I"=>"Sengkol I","Gentang"=>"Gentang","Sekong"=>"Sekong","Sedo"=>"Sedo","Kekale"=>"Kekale","Tajuk"=>"Tajuk","Puji+Rahayu"=>"Puji Rahayu","Puji Rahayu"=>"Puji Rahayu","Junge"=>"Junge","Sereneng"=>"Sereneng","Kale"=>"Kale","Sengkol+II"=>"Sengkol II","Sengkol II"=>"Sengkol II","Pesarih"=>"Pesarih","Penambong"=>"Penambong","Peresak"=>"Peresak","Senundal"=>"Senundal","Soweng"=>"Soweng","Lainnya"=>"Lainnya")
                        ,'user11'=>array("Karang+Jangkong"=>"Karang Jangkong","Karang Jangkong"=>"Karang Jangkong","Gilik"=>"Gilik","Karang+Daye"=>"Karang Daye","Karang Daye"=>"Karang Daye","Balen+Along"=>"Balen Along","Bale+Montong+I"=>"Bale Montong I","Gubuk+Direk"=>"Gubuk Direk","Gubuk Direk"=>"Gubuk Direk","Pengadang"=>"Pengadang","Sarang+Angin"=>"Sarang Angin","Sarang Angin"=>"Sarang Angin","Dayen+Kubur"=>"Dayen Kubur","Dayen Kubur"=>"Dayen Kubur","Bale+Montong+II"=>"Bale Montong II","Gonjong"=>"Gonjong","Gampung"=>"Gampung","Taman+Bumi+Gora"=>"Bumi Gora","Buntereng"=>"Buntereng","Wareng"=>"Wareng","Pance"=>"Pance","Bumi+Gora"=>"Bumi Gora","Batu+Bangke"=>"Batu Bangke","Batu Bangke"=>"Batu Bangke","Bumi Gora"=>"Bumi Gora","Bale Montong I"=>"Bale Montong I","Balen Along"=>"Balen Along","Bale Montong II"=>"Bale Montong II","Lainnya"=>"Lainnya")
                        ,'user12'=>array("Singa"=>"Singa","Perendek"=>"Perendek","Tanak+Awu+Bat"=>"Tanak Awu Bat","Selawang"=>"Selawang","Tanak+Awu+I"=>"Tanak Awu I","Perendik"=>"Perendek","Gantang+Daye"=>"Gantang Daye","Tanak+Awu+II"=>"Tanak Awu II","Rebile"=>"Rebile","Tatak"=>"Tatak","Reak+II"=>"Reak II","Reak+I"=>"Reak I","Gantang+Lauk"=>"Gantang Lauk","Gantang+Bat"=>"Gantang Bat","Gantang+Timuk"=>"Gantang Timuk","Sengkol+II"=>"Sengkol II","Selawang+Timuq"=>"Selawang Timuq","Selawang+Bat"=>"Selawang Bat","Selawang Bat"=>"Selawang Bat","Jambek+II"=>"Jambek II","Jambek+I"=>"Jambek I","Gantang Daye"=>"Gantang Daye","Tanak Awu Bat"=>"Tanak Awu Bat","Reak I"=>"Reak I","Reak II"=>"Reak II","Selawang Timuq"=>"Selawang Timuq","Gantang Bat"=>"Gantang Bat","Jambek II"=>"Jambek II","Jambek I"=>"Jambek I","Tanak Awu II"=>"Tanak Awu II","Gantang Lauk"=>"Gantang Lauk","Tanak Awu I"=>"Tanak Awu I","Lainnya"=>"Lainnya")
                        ,'user13'=>array("Pengembur+III"=>"Pengembur III","Rajan"=>"Pengembur I","Tamping"=>"Tamping","Sepit"=>"Sepit","Penyampi"=>"Penyampi","Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat","Tawah"=>"Tawah","Pengembur+II"=>"Pengembur II","Sinah"=>"Sinah","Pengembur+I"=>"Pengembur I","Batu+Belek"=>"Batu Belek","Pengembur I"=>"Pengembur I","Batu Belek"=>"Batu Belek","Pengembur II"=>"Pengembur II","Pengembur III"=>"Pengembur III","Lainnya"=>"Lainnya")
                        ,'user14'=>array("Bolok"=>"Bolok","Anak+Anjan"=>"Anak Anjan","Penupi"=>"Penupi","Kadik+I"=>"Penupi","Kadik I"=>"Penupi","Karang+baru"=>"Karang Baru","Karang baru"=>"Karang Baru","Tenang"=>"Tenang","Lamben"=>"Lamben","Tuban"=>"Anak Anjan","Segale"=>"Anak Anjan","Tenang+Baru"=>"Tenang","Tenang Baru"=>"Tenang","Kadik+II"=>"Kadik","Anak Anjan"=>"Anak Anjan","Kadik II"=>"Kadik","Dasan Duah"=>"Kadik","Lainnya"=>"Lainnya")];
    private $dusun = ['user1'=>array(1=>"Lekor Barat","Lekor Timur","Lengkok Bunut","Sondo","Renge","Presak","Gulung","Taken Aken","Pepao Timur","Pepao Barat","Pepao Tengah","Pelapak","Walun")
                        ,'user2'=>array(1=>"Jembe Barat","Jembe Timur","Jembe Utara","Pengempok","Suangke","Janggawana Selatan 1","Sengkerek","Lingkok Buak Barat","Lingkok Buak Tengah","Longkok Buak Timur","Melati","Selek","Gundu","Masjaya","Presak Sanggeng","Tentram","Terentem","Keruak","Keruak Utara","Janggawana Selatan","Janggawana Utara","Janggawana Barat","Selek Direk","Sengkerek Timur","Tenges Enges")
                        ,'user3'=>array(1=>'Pendem','Karang Majelo','Gelondong','Maliklo','Montong Bile','Jelitong','Lekong Bangkon','Penuntut','Kuang','Piling','Jangka','Petorok','Gelung','Nyangget')
                        ,'user4'=>array(1=>'Siwi','Setuta Barat','Setuta Timur','Batu Belek','Liwung Satu','Liwung Dua','Juna','Biletawah','Nunang')
                        ,'user5'=>array(1=>'Rungkang Timur','Rungkang Barat','Puntik Baru','Jango Selatan','Jango Utara','Kenyalu II','Kenyalu I','Grepek')
                        ,'user6'=>array(1=>'Perok Timur','Menyer','Perok Barat','Kedapang','Tempek Empek','Geong Manis','Nunang Utara','Pengebat','Sadah','Lokon','Janapria','Batu Bungus Utara','Montong Kesene','Batu Kembar Barat','Peresak Jenggang','Gempang','Batu Kembar Timur','Bukit Awas','Penambong','Bolor','Lemokek','Lambah Olot','Tonjong')
                        ,'user8'=>array(1=>'Sempalan','Sarah','Bagek Dewe','Dese','Dayen Rurung','Lebak','Sampet','Abe','Embung Rungkas')
                        ,'user9'=>array(1=>'Kale','Piyang','Soweng','Semundal','Jomang','Penambong','Peresak','Pesarih','Sedo','Lotir','Belong','Sereneng','Sengkol I','Sengkol II','Junge','Gentang','Tajuk')
                        ,'user10'=>array(1=>'Kale','Piyang','Soweng','Semundal','Jomang','Penambong','Peresak','Pesarih','Sedo','Lotir','Belong','Sereneng','Sengkol I','Sengkol II','Junge','Gentang','Tajuk')
                        ,'user11'=>array(1=>'Karang Jangkong','Batu Bangke','Gonjong','Bale Montong I','Bumi Gora','Dayen Kubur','Gilik','Pance','Pengadang','Wareng','Bale Montong II','Gampung','Balen Along','Sarang Angin','Karang Daye','Gubuk Direk','Buntereng')
                        ,'user12'=>array(1=>'Tanak Awu I','Tanak Awu II','Tanak Awu Bat','Singa','Perendek','Tatak','Reak I','Reak II','Selawang Timuq','Selawang Bat','Gantang Lauk','Gantang Bat','Gantang Daye','Jambek I','Jambek II','Rebile')
                        ,'user13'=>array(1=>'Pengembur I','Pengembur II','Pengembur III','Penyampi','Batu Belek','Tawah','Perigi','Sinah','Siwang','Tamping','Sepit','Keramat')
                        ,'user14'=>array(1=>'Anak Anjan','Kadik','Penupi','Karang Baru','Lamben','Tenang','Bolok')];
    private $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        if($desa==""){
            $username = $this->session->userdata('username');
            $kec = $this->loc->getKecFromUser($username);
            $namadusun = $this->loc->getDesaFromUser('bidan',$kec,$username);
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        
        //make result array from the tables name
        $result_data = array();
        foreach ($namadusun as $dusun=>$nama){
            $data = array();
            foreach ($table_default as $table=>$legend){
                $data[$legend] = 0;
            }
            $result_data[$nama] = $data;
        }
        
        foreach ($table_default as $table=>$legend){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT posyandu FROM event_bidan_identitas_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                    foreach ($query2->result() as $c2_data){
                        if(array_key_exists($c2_data->posyandu, $namadusun)){
                            $data_count                  = $result_data[$namadusun[$c2_data->posyandu]];
                            $data_count[$legend]         += 1;
                            $result_data[$namadusun[$c2_data->posyandu]] = $data_count;
                        }else{
                            $data_count                  = $result_data["Lainnya"];
                            $data_count[$legend]         += 1;
                            $result_data["Lainnya"] = $data_count;
                        }
                    }
                }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($dusun="",$date=""){
        $dusun = implode(" ", explode('_', $dusun));
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        $tabindex = [
            'event_bidan_identitas_ibu'=>0,
            'event_bidan_tambah_anc'=>1,
            'event_bidan_kunjungan_anc'=>2,
            'event_bidan_kunjungan_anc_lab_test'=>3,
            'event_bidan_rencana_persalinan'=>4,
            'event_bidan_dokumentasi_persalinan'=>5,
            'event_bidan_kunjungan_pnc'=>6,
            'event_bidan_child_registration'=>7,
            'event_bidan_penutupan_anak'=>8];
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        if($this->session->userdata('level')=="fhw"){
            $username = $this->session->userdata('username');
        }else{
            $username = $this->loc->getUserFromDusun('bidan',$dusun);
        }
        
        $listdusun = $this->loc->getDusunTypo($this->loc->getDesaFromUser('bidan',$this->loc->getKecFromUser($username),$username));
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
        
        foreach ($tables as $table=>$legend){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId='$username') and eventDate LIKE '".$date."%'");
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT posyandu FROM event_bidan_identitas_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                foreach ($query2->result() as $c2_data){
                    if(array_key_exists($c2_data->posyandu, $namadusun)){
                        $data_count                  = $result_data[$date];
                        if(array_key_exists($table, $table_default)){
                            $data_count["data"][$tabindex[$table]][1]         += 1;
                        }
                        $result_data[$date] = $data_count;
                    }
                }
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDay($desa="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($desa,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                array_push($tables, $table->Tables_in_ec_analytics);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $namadusun = $this->listdusun[$username];
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
        }
        
        //make result array from the tables name
        $result_data = array();
        if($range!=""){
            foreach ($namadusun as $nama){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }else{
            foreach ($namadusun as $nama){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$nama] = $data;
            }
        }
        
        foreach ($tables as $table){
            $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId='$username')");
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT posyandu FROM event_bidan_identitas_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                foreach ($query2->result() as $c2_data){
                    if(array_key_exists($c2_data->posyandu, $namadusun)){
                        $data_count                  = $result_data[$namadusun[$c2_data->posyandu]];
                        $tgl = explode('T', $c_data->eventDate);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $data_count)){
                            $data_count[$tgl] += 1;;
                        }
                        $result_data[$namadusun[$c2_data->posyandu]] = $data_count;
                    }else{
                        $data_count                  = $result_data["Lainnya"];
                        if(array_key_exists($tgl, $data_count)){
                            $data_count[$tgl] += 1;;
                        }
                        $result_data["Lainnya"] = $data_count;
                    }
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($desa="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak'];
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                array_push($tables, $table->Tables_in_ec_analytics);
            }
        }
        
        if($desa==""){
            $username = $this->session->userdata('username');
            $kec = $this->loc->getKecFromUser($username);
            $namadusun = $this->loc->getDesaFromUser('bidan',$kec,$username);
            $users = [$username=>$this->listdesa[$username]];
        }else{
            $kec = $this->loc->getKecFromDesa($desa);
            $username = $this->loc->getDesaUser('bidan',$kec,$desa);
            $namadusun = $this->loc->getDusunTypo($desa);
            $users = [$username=>$namadusun];
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
        
        foreach ($tables as $table){
            if($mode=='Mingguan'){
                $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId='$username') and (eventDate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and eventDate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
            }elseif($mode=='Bulanan'){
                $query = $analyticsDB->query("SELECT providerId, baseEntityId, eventDate from ".$table." where (providerId='$username') and (eventDate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and eventDate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
            }
            foreach ($query->result() as $c_data){
                $query2 = $analyticsDB->query("SELECT posyandu FROM event_bidan_identitas_ibu where baseEntityId='$c_data->baseEntityId' LIMIT 1");
                $tgl = explode('T', $c_data->eventDate);
                $tgl = $tgl[0];
                foreach ($query2->result() as $c2_data){
                    if($mode=='Mingguan'){
                        if(array_key_exists($c2_data->posyandu, $namadusun)){
                            $week   =   $result_data[$namadusun[$c2_data->posyandu]];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($tgl, $thisweek)){
                                $thisweek[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastweek)){
                                $lastweek[$tgl] +=1;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data[$namadusun[$c2_data->posyandu]] = $week;
                        }else{
                            $week   =   $result_data["Lainnya"];
                            $thisweek   = $week['thisweek'];
                            $lastweek   = $week['lastweek'];
                            if(array_key_exists($tgl, $thisweek)){
                                $thisweek[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastweek)){
                                $lastweek[$tgl] +=1;
                            }
                            $week['thisweek'] = $thisweek;
                            $week['lastweek'] = $lastweek;
                            $result_data["Lainnya"] = $week;
                        }
                    }elseif($mode=='Bulanan'){
                        if(array_key_exists($c2_data->posyandu, $namadusun)){
                            $month = $result_data[$namadusun[$c2_data->posyandu]];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $tgl);
                            array_pop($m);
                            $tgl = implode('-',$m);
                            if(array_key_exists($tgl, $thisyear)){
                                $thisyear[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastyear)){
                                $lastyear[$tgl] +=1;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data[$namadusun[$c2_data->posyandu]] = $month;
                        }else{
                            $month = $result_data["Lainnya"];
                            $thisyear = $month['thisyear'];
                            $lastyear = $month['lastyear'];
                            $m = explode('-', $tgl);
                            array_pop($m);
                            $tgl = implode('-',$m);
                            if(array_key_exists($tgl, $thisyear)){
                                $thisyear[$tgl] +=1;
                            }
                            if(array_key_exists($tgl, $lastyear)){
                                $lastyear[$tgl] +=1;
                            }
                            $month['thisyear'] = $thisyear;
                            $month['lastyear'] = $lastyear;
                            $result_data["Lainnya"] = $month;
                        }
                    }
                }
            }
        }
        
        return $result_data;
    }
}