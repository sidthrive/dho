<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsFhwModel extends CI_Model{
    
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
    private $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCountPerForm($desa=""){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        $table_default = [
            'kartu_ibu_registration'=>'Registrasi Ibu', //have own ``
            'kohort_kb_registration'=>'Registrasi KB', //have own ``
            'kartu_anc_registration'=>'Registrasi ANC', //from kir(kiId) ``
            'kartu_anc_registration_oa'=>'Registrasi ANC', //have own ``
            'kartu_anc_rencana_persalinan'=>'Rencana Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_anc_visit'=>'Kunjungan ANC', //form kir(kiId) ``
            'kartu_pnc_regitration_oa'=>'Registrasi PNC', //have own  ``
            'kartu_pnc_dokumentasi_persalinan'=>'Dokumentasi Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_pnc_visit'=>'Kunjungan PNC', //from kar_oa(motherId)
            'kohort_bayi_registration'=>'Registrasi Anak', //form kir(kiId) ``
            'kohort_bayi_registration_oa'=>'Registrasi Anak', //have won ``
            'kohort_bayi_neonatal_period'=>'Kunjungan Neonatal', // from pnc_doc(childId), pnc_doc(motherId)->kar(motherId),kar(kiId) -> kir(kiId)
            'kohort_bayi_kunjungan'=>'Kunjungan Bayi']; // from kbr_oa(childId)
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                $tables[$table->Tables_in_analytics]=$table_default[$table->Tables_in_analytics];
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
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"){
                $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun");
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
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
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
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if(array_key_exists($p_data->dusun, $namadusun)){
                                $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                $data_count[$legend]         += 1;
                                $result_data[$namadusun[$p_data->dusun]] = $data_count;
                            }else{
                                $data_count                  = $result_data["Lainnya"];
                                $data_count[$legend]         += 1;
                                $result_data["Lainnya"] = $data_count;
                            }
                        }
                    }
                }
            }elseif($table=="kartu_pnc_visit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration_oa where motherId='$c_data->motherId'");
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
            }elseif($table=="kohort_bayi_kunjungan"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration_oa where childId='$c_data->childId'");
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
            }elseif($table=="kohort_bayi_neonatal_period"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                    $data_count[$legend]         += 1;
                                    $result_data[$namadusun[$p_data->dusun]] = $data_count;
                                }else{
                                    $data_count                  = $result_data["Lainnya"];
                                    $data_count[$legend]         += 1;
                                    $result_data["Lainnya"] = $data_count;
                                }
                            }
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
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        $table_default = [
            'kartu_ibu_registration'=>'Registrasi Ibu', //have own ``
            'kohort_kb_registration'=>'Registrasi KB', //have own ``
            'kartu_anc_registration'=>'Registrasi ANC', //from kir(kiId) ``
            'kartu_anc_registration_oa'=>'Registrasi ANC', //have own ``
            'kartu_anc_rencana_persalinan'=>'Rencana Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_anc_visit'=>'Kunjungan ANC', //form kir(kiId) ``
            'kartu_pnc_regitration_oa'=>'Registrasi PNC', //have own  ``
            'kartu_pnc_dokumentasi_persalinan'=>'Dokumentasi Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_pnc_visit'=>'Kunjungan PNC', //from kar_oa(motherId)
            'kohort_bayi_registration'=>'Registrasi Anak', //form kir(kiId) ``
            'kohort_bayi_registration_oa'=>'Registrasi Anak', //have won ``
            'kohort_bayi_neonatal_period'=>'Kunjungan Neonatal', // from pnc_doc(childId), pnc_doc(motherId)->kar(motherId),kar(kiId) -> kir(kiId)
            'kohort_bayi_kunjungan'=>'Kunjungan Bayi', // from kbr_oa(childId)
            //'kartu_anc_visit_integrasi'=>'', 
            'kartu_anc_visit_labtest'=>'', //from kar(motherId), kar(kiId)->kir(kiId)
            'kohort_bayi_immunization'=>'', // from pnc_doc(childId), pnc_doc(motherId)->kar(motherId),kar(kiId) -> kir(kiId)
            'kohort_kb_pelayanan'=>'', //from kir(kiId)
            'kohort_kb_update'=>'']; //from kkr(kiId)
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                array_push($tables, $table->Tables_in_analytics);
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
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"){
                $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') group by dusun,submissiondate");
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
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kohort_kb_pelayanan"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
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
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_anc_visit_labtest"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if(array_key_exists($p_data->dusun, $namadusun)){
                                $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                if(array_key_exists($c_data->submissiondate, $data_count)){
                                    $data_count[$c_data->submissiondate] += 1;;
                                }
                                $result_data[$namadusun[$p_data->dusun]] = $data_count;
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
            }elseif($table=="kartu_pnc_visit"){
                $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration_oa where motherId='$c_data->motherId'");
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
            }elseif($table=="kohort_bayi_kunjungan"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration_oa where childId='$c_data->childId'");
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
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_bayi_immunization"){
                $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $data_count                  = $result_data[$namadusun[$p_data->dusun]];
                                    if(array_key_exists($c_data->submissiondate, $data_count)){
                                        $data_count[$c_data->submissiondate] += 1;;
                                    }
                                    $result_data[$namadusun[$p_data->dusun]] = $data_count;
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
            }elseif($table=="kohort_kb_update"){
                $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username')");
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_kb_registration where kiId='$c_data->kiId'");
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
        $analyticsDB = $this->load->database('analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM analytics");
        
        $table_default = [
            'kartu_ibu_registration'=>'Registrasi Ibu', //have own ``
            'kohort_kb_registration'=>'Registrasi KB', //have own ``
            'kartu_anc_registration'=>'Registrasi ANC', //from kir(kiId) ``
            'kartu_anc_registration_oa'=>'Registrasi ANC', //have own ``
            'kartu_anc_rencana_persalinan'=>'Rencana Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_anc_visit'=>'Kunjungan ANC', //form kir(kiId) ``
            'kartu_pnc_regitration_oa'=>'Registrasi PNC', //have own  ``
            'kartu_pnc_dokumentasi_persalinan'=>'Dokumentasi Persalinan', //from kar(motherId), kar(kiId) -> kir(kiId) ``
            'kartu_pnc_visit'=>'Kunjungan PNC', //from kar_oa(motherId)
            'kohort_bayi_registration'=>'Registrasi Anak', //form kir(kiId) ``
            'kohort_bayi_registration_oa'=>'Registrasi Anak', //have won ``
            'kohort_bayi_neonatal_period'=>'Kunjungan Neonatal', // from pnc_doc(childId), pnc_doc(motherId)->kar(motherId),kar(kiId) -> kir(kiId)
            'kohort_bayi_kunjungan'=>'Kunjungan Bayi', // from kbr_oa(childId)
            //'kartu_anc_visit_integrasi'=>'', 
            'kartu_anc_visit_labtest'=>'', //from kar(motherId), kar(kiId)->kir(kiId)
            'kohort_bayi_immunization'=>'', // from pnc_doc(childId), pnc_doc(motherId)->kar(motherId),kar(kiId) -> kir(kiId)
            'kohort_kb_pelayanan'=>'', //from kir(kiId)
            'kohort_kb_update'=>'']; //from kkr(kiId)
        //retrieve the tables name
        
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_analytics, $table_default)){
                array_push($tables, $table->Tables_in_analytics);
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
            $query = $analyticsDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            if($table=="kartu_ibu_registration"||$table=="kohort_kb_registration"||$table=="kartu_anc_registration_oa"||$table=="kartu_pnc_regitration_oa"||$table=="kohort_bayi_registration_oa"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."') group by dusun, submissiondate");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, submissiondate,dusun,count(*) as counts from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."') group by dusun, submissiondate");
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
            }elseif($table=="kartu_anc_registration"||$table=="kartu_anc_visit"||$table=="kohort_bayi_registration"||$table=="kohort_kb_pelayanan"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c_data->kiId'");
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
            }elseif($table=="kartu_anc_rencana_persalinan"||$table=="kartu_pnc_dokumentasi_persalinan"||$table=="kartu_anc_visit_labtest"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c_data->motherId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c2_data->kiId'");
                        foreach ($query3->result() as $p_data){
                            if($mode=='Mingguan'){
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $week   =   $result_data[$namadusun[$p_data->dusun]];
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
                                    $result_data[$namadusun[$p_data->dusun]] = $week;
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
                                if(array_key_exists($p_data->dusun, $namadusun)){
                                    $month = $result_data[$namadusun[$p_data->dusun]];
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
                                    $result_data[$namadusun[$p_data->dusun]] = $month;
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
            }elseif($table=="kartu_pnc_visit"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, motherId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kartu_anc_registration_oa where motherId='$c_data->motherId'");
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
            }elseif($table=="kohort_bayi_kunjungan"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_bayi_registration_oa where childId='$c_data->childId'");
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
            }elseif($table=="kohort_bayi_neonatal_period"||$table=="kohort_bayi_immunization"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, childId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan where childId='$c_data->childId'");
                    foreach ($query2->result() as $c2_data){
                        $query3 = $analyticsDB->query("SELECT kiId FROM kartu_anc_registration where motherId='$c2_data->motherId'");
                        foreach ($query3->result() as $c3_data){
                            $query4 = $analyticsDB->query("SELECT dusun FROM kartu_ibu_registration where kiId='$c3_data->kiId'");
                            foreach ($query4->result() as $p_data){
                                if($mode=='Mingguan'){
                                    if(array_key_exists($p_data->dusun, $namadusun)){
                                        $week   =   $result_data[$namadusun[$p_data->dusun]];
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
                                        $result_data[$namadusun[$p_data->dusun]] = $week;
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
                                    if(array_key_exists($p_data->dusun, $namadusun)){
                                        $month = $result_data[$namadusun[$p_data->dusun]];
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
                                        $result_data[$namadusun[$p_data->dusun]] = $month;
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
            }elseif($table=="kohort_kb_update"){
                if($mode=='Mingguan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-5 days"))."' and submissiondate <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"")))."')");
                }elseif($mode=='Bulanan'){
                    $query = $analyticsDB->query("SELECT userid, kiId, submissiondate from ".$table." where (userid='$username') and (submissiondate >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' and submissiondate <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."')");
                }
                foreach ($query->result() as $c_data){
                    $query2 = $analyticsDB->query("SELECT dusun FROM kohort_kb_registration where kiId='$c_data->kiId'");
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