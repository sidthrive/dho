<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BidanFhwCakupanModel extends CI_Model{
    private $dusun =    ['user1' =>array('Gulung'=>'Gulung','Lekor+Timur'=>'Lekor Timur','Lekor Timur'=>'Lekor Timur','Lekor+Barat'=>'Lekor Barat','Lekor Barat'=>'Lekor Barat','Lendang+Jawe'=>'Pepao Barat','Lengkok Bunut'=>'Lengkok Bunut','Lengkok+Bunut'=>'Lengkok Bunut','Montong+Bile'=>'Pepao Tengah','Pelapak'=>'Pelapak','Pepao+Barat+I'=>'Pepao Barat','Pepao Barat I'=>'Pepao Barat','Pepao+Barat+II'=>'Pepao Barat','Pepao Barat II'=>'Pepao Barat','Pepao+Timur'=>'Pepao Timur','Pepao Timur'=>'Pepao Timur','Presak'=>'Presak','Renge'=>'Renge','Sondo'=>'Sondo','Taken-Aken'=>"Taken Aken",'Walun'=>'Walun','Lendang Jawe'=>'Pepao Barat','Menteger'=>'Pelapak','Berenge'=>'Pelapak','Embung Wile'=>'Gulung','Sandat'=>'Lekor Timur','Ambat'=>'Pelapak','Montong Bile'=>'Pepao Tengah','Wiyung'=>'Gulung','Lekor Tengah'=>'Lekor Timur','Belo'=>'Walun','Selaping'=>'Gulung','Bare Putih','Dongger','Lempenge',"Lainnya"=>"Lainnya")
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
    
    private $listdusun = ['user1'=>array("Lekor Barat"=>0,"Lekor Timur"=>0,"Lengkok Bunut"=>0,"Sondo"=>0,"Renge"=>0,"Presak"=>0,"Gulung"=>0,"Taken Aken"=>0,"Pepao Timur"=>0,"Pepao Barat"=>0,"Pepao Tengah"=>0,"Pelapak"=>0,"Walun"=>0)
                        ,'user2'=>array("Jembe Barat"=>0,"Jembe Timur"=>0,"Jembe Utara"=>0,"Pengempok"=>0,"Suangke"=>0,"Janggawana Selatan 1"=>0,"Sengkerek"=>0,"Lingkok Buak Barat"=>0,"Lingkok Buak Tengah"=>0,"Lingkok Buak Timur"=>0,"Melati"=>0,"Selek"=>0,"Gundu"=>0,"Masjaya"=>0,"Presak Sanggeng"=>0,"Tentram"=>0,"Terentem"=>0,"Keruak"=>0,"Keruak Utara"=>0,"Janggawana Selatan"=>0,"Janggawana Utara"=>0,"Janggawana Barat"=>0,"Selek Direk"=>0,"Sengkerek Timur"=>0,"Tenges Enges"=>0)
                        ,'user3'=>array('Pendem'=>0,'Karang Majelo'=>0,'Gelondong'=>0,'Maliklo'=>0,'Montong Bile'=>0,'Jelitong'=>0,'Lekong Bangkon'=>0,'Penuntut'=>0,'Kuang'=>0,'Piling'=>0,'Jangka'=>0,'Petorok'=>0,'Gelung'=>0,'Nyangget'=>0)
                        ,'user4'=>array('Siwi'=>0,'Setuta Barat'=>0,'Setuta Timur'=>0,'Batu Belek'=>0,'Liwung Satu'=>0,'Liwung Dua'=>0,'Juna'=>0,'Biletawah'=>0,'Nunang'=>0)
                        ,'user5'=>array('Rungkang Timur'=>0,'Rungkang Barat'=>0,'Puntik Baru'=>0,'Jango Selatan'=>0,'Jango Utara'=>0,'Kenyalu II'=>0,'Kenyalu I'=>0,'Grepek'=>0)
                        ,'user6'=>array('Perok Timur'=>0,'Menyer'=>0,'Perok Barat'=>0,'Kedapang'=>0,'Tempek Empek'=>0,'Geong Manis'=>0,'Nunang Utara'=>0,'Pengebat'=>0,'Sadah'=>0,'Lokon'=>0,'Janapria'=>0,'Batu Bungus Utara'=>0,'Montong Kesene'=>0,'Batu Kembar Barat'=>0,'Peresak Jenggang'=>0,'Gempang'=>0,'Batu Kembar Timur'=>0,'Bukit Awas'=>0,'Penambong'=>0,'Bolor'=>0,'Lemokek'=>0,'Lambah Olot'=>0,'Tonjong'=>0)
                        ,'user8'=>array('Sempalan'=>0,'Sarah'=>0,'Bagek Dewe'=>0,'Dese'=>0,'Dayen Rurung'=>0,'Lebak'=>0,'Sampet'=>0,'Abe'=>0,'Embung Rungkas'=>0)
                        ,'user9'=>array('Kale'=>0,'Piyang'=>0,'Soweng'=>0,'Semundal'=>0,'Jomang'=>0,'Penambong'=>0,'Peresak'=>0,'Pesarih'=>0,'Sedo'=>0,'Lotir'=>0,'Belong'=>0,'Sereneng'=>0,'Sengkol I'=>0,'Sengkol II'=>0,'Junge'=>0,'Gentang'=>0,'Tajuk'=>0)
                        ,'user10'=>array('Kale','Piyang','Soweng','Semundal','Jomang','Penambong','Peresak','Pesarih','Sedo','Lotir','Belong','Sereneng','Sengkol I','Sengkol II','Junge','Gentang','Tajuk')
                        ,'user11'=>array('Karang Jangkong'=>0,'Batu Bangke'=>0,'Gonjong'=>0,'Bale Montong I'=>0,'Bumi Gora'=>0,'Dayen Kubur'=>0,'Gilik'=>0,'Pance'=>0,'Pengadang'=>0,'Wareng'=>0,'Bale Montong II'=>0,'Gampung'=>0,'Balen Along'=>0,'Sarang Angin'=>0,'Karang Daye'=>0,'Gubuk Direk'=>0,'Buntereng'=>0)
                        ,'user12'=>array('Tanak Awu I'=>0,'Tanak Awu II'=>0,'Tanak Awu Bat'=>0,'Singa'=>0,'Perendek'=>0,'Tatak'=>0,'Reak I'=>0,'Reak II'=>0,'Selawang Timuq'=>0,'Selawang Bat'=>0,'Gantang Lauk'=>0,'Gantang Bat'=>0,'Gantang Daye'=>0,'Jambek I'=>0,'Jambek II'=>0,'Rebile'=>0)
                        ,'user13'=>array('Pengembur I'=>0,'Pengembur II'=>0,'Pengembur III'=>0,'Penyampi'=>0,'Batu Belek'=>0,'Tawah'=>0,'Perigi'=>0,'Sinah'=>0,'Siwang'=>0,'Tamping'=>0,'Sepit'=>0,'Keramat'=>0)
                        ,'user14'=>array('Anak Anjan'=>0,'Kadik'=>0,'Penupi'=>0,'Karang Baru'=>0,'Lamben'=>0,'Tenang'=>0,'Bolok'=>0)];
    private $target = ['user1'=>array("Lekor Barat"=>100,"Lekor Timur"=>100,"Lengkok Bunut"=>100,"Sondo"=>100,"Renge"=>100,"Presak"=>100,"Gulung"=>100,"Taken Aken"=>100,"Pepao Timur"=>100,"Pepao Barat"=>100,"Pepao Tengah"=>100,"Pelapak"=>100,"Walun"=>100)
                        ,'user2'=>array("Jembe Barat"=>100,"Jembe Timur"=>100,"Jembe Utara"=>100,"Pengempok"=>100,"Suangke"=>100,"Janggawana Selatan 1"=>100,"Sengkerek"=>100,"Lingkok Buak Barat"=>100,"Lingkok Buak Tengah"=>100,"Lingkok Buak Timur"=>100,"Melati"=>100,"Selek"=>100,"Gundu"=>100,"Masjaya"=>100,"Presak Sanggeng"=>100,"Tentram"=>100,"Terentem"=>100,"Keruak"=>100,"Keruak Utara"=>100,"Janggawana Selatan"=>100,"Janggawana Utara"=>100,"Janggawana Barat"=>100,"Selek Direk"=>100,"Sengkerek Timur"=>100,"Tenges Enges"=>100)
                        ,'user3'=>array('Pendem'=>100,'Karang Majelo'=>100,'Gelondong'=>100,'Maliklo'=>100,'Montong Bile'=>100,'Jelitong'=>100,'Lekong Bangkon'=>100,'Penuntut'=>100,'Kuang'=>100,'Piling'=>100,'Jangka'=>100,'Petorok'=>100,'Gelung'=>100,'Nyangget'=>100)
                        ,'user4'=>array('Siwi'=>100,'Setuta Barat'=>100,'Setuta Timur'=>100,'Batu Belek'=>100,'Liwung Satu'=>100,'Liwung Dua'=>100,'Juna'=>100,'Biletawah'=>100,'Nunang'=>100)
                        ,'user5'=>array('Rungkang Timur'=>100,'Rungkang Barat'=>100,'Puntik Baru'=>100,'Jango Selatan'=>100,'Jango Utara'=>100,'Kenyalu II'=>100,'Kenyalu I'=>100,'Grepek'=>100)
                        ,'user6'=>array('Perok Timur'=>100,'Menyer'=>100,'Perok Barat'=>100,'Kedapang'=>100,'Tempek Empek'=>100,'Geong Manis'=>100,'Nunang Utara'=>100,'Pengebat'=>100,'Sadah'=>100,'Lokon'=>100,'Janapria'=>100,'Batu Bungus Utara'=>100,'Montong Kesene'=>100,'Batu Kembar Barat'=>100,'Peresak Jenggang'=>100,'Gempang'=>100,'Batu Kembar Timur'=>100,'Bukit Awas'=>100,'Penambong'=>100,'Bolor'=>100,'Lemokek'=>100,'Lambah Olot'=>100,'Tonjong'=>100)
                        ,'user8'=>array('Sempalan'=>100,'Sarah'=>100,'Bagek Dewe'=>100,'Dese'=>100,'Dayen Rurung'=>100,'Lebak'=>100,'Sampet'=>100,'Abe'=>100,'Embung Rungkas'=>100)
                        ,'user9'=>array('Kale'=>100,'Piyang'=>100,'Soweng'=>100,'Semundal'=>100,'Jomang'=>100,'Penambong'=>100,'Peresak'=>100,'Pesarih'=>100,'Sedo'=>100,'Lotir'=>100,'Belong'=>100,'Sereneng'=>100,'Sengkol I'=>100,'Sengkol II'=>100,'Junge'=>100,'Gentang'=>100,'Tajuk'=>100)
                        ,'user10'=>array('Kale','Piyang','Soweng','Semundal','Jomang','Penambong','Peresak','Pesarih','Sedo','Lotir','Belong','Sereneng','Sengkol I','Sengkol II','Junge','Gentang','Tajuk')
                        ,'user11'=>array('Karang Jangkong'=>100,'Batu Bangke'=>100,'Gonjong'=>100,'Bale Montong I'=>100,'Bumi Gora'=>100,'Dayen Kubur'=>100,'Gilik'=>100,'Pance'=>100,'Pengadang'=>100,'Wareng'=>100,'Bale Montong II'=>100,'Gampung'=>100,'Balen Along'=>100,'Sarang Angin'=>100,'Karang Daye'=>100,'Gubuk Direk'=>100,'Buntereng'=>100)
                        ,'user12'=>array('Tanak Awu I'=>100,'Tanak Awu II'=>100,'Tanak Awu Bat'=>100,'Singa'=>100,'Perendek'=>100,'Tatak'=>100,'Reak I'=>100,'Reak II'=>100,'Selawang Timuq'=>100,'Selawang Bat'=>100,'Gantang Lauk'=>100,'Gantang Bat'=>100,'Gantang Daye'=>100,'Jambek I'=>100,'Jambek II'=>100,'Rebile'=>100)
                        ,'user13'=>array('Pengembur I'=>100,'Pengembur II'=>100,'Pengembur III'=>100,'Penyampi'=>100,'Batu Belek'=>100,'Tawah'=>100,'Perigi'=>100,'Sinah'=>100,'Siwang'=>100,'Tamping'=>100,'Sepit'=>100,'Keramat'=>100)
                        ,'user14'=>array('Anak Anjan'=>100,'Kadik'=>100,'Penupi'=>100,'Karang Baru'=>100,'Lamben'=>100,'Tenang'=>100,'Bolok'=>100)];
    private $listdesa = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->db = $this->load->database('analytics', TRUE);
    }
    
    public function cakupanBulanIni($bulan,$tahun){
        $bidan = $this->session->userdata('username');
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user = $this->listdusun[$bidan];
        
        $target_bumil   =  $this->target[$bidan];
        $target_bulin   =  $this->target[$bidan];
        $target_bufas   =  $this->target[$bidan];
        $target_mt      =  $this->target[$bidan];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=1 AND userID='$bidan' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                }
            } 
        }
        foreach ($form as $dusun=>$nilai){
            $form[$dusun] = $nilai*100/$target_bumil[$dusun];
        }
        
        $series1['page']='K1A';
        $series1['form']=$form;
        $series1['y_label']='Jumlah';
        $series1['series_name']='Jumlah';
        array_push($xlsForm, $series1);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 AND userID='$bidan' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                }
            } 
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bumil[$desa];
        }
        
        $series2['page']='K4';
        $series2['form']=$form;
        $series2['y_label']='Jumlah';
        $series2['series_name']='Jumlah';
        array_push($xlsForm, $series2);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND userID='$bidan'")->result();
        foreach ($datavisit as $dvisit){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    if($dvisit->komplikasidalamKehamilan!="None"){
                        if($dvisit->rujukan=="Ya"){
                            $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                        }
                    }
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_mt[$desa];
        }
        $series3['page']='MT';
        $series3['form']=$form;
        $series3['y_label']='Jumlah';
        $series3['series_name']='Jumlah';
        array_push($xlsForm, $series3);
       
        $likes = $user;
        $nakes = $user;
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'  AND userID='$bidan'")->result();
        foreach ($datapersalinan as $dsalin){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                        $likes[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                    if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                        $nakes[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                }
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'  AND userID='$bidan'")->result();
        foreach ($datapersalinan as $dsalin){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    if($dsalin->tempatBersalin=="podok_bersalin_desa"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat_pembantu"||$dsalin->tempatBersalin=="pusat_kesehatan_masyarakat"||$dsalin->tempatBersalin=="rumah_bersalin"||$dsalin->tempatBersalin=="rumah_sakit_ibu_dan_anak"||$dsalin->tempatBersalin=="rumah_sakit"||$dsalin->tempatBersalin=="rumah_sakit_orang_dengan_hiv_aids"){
                         $likes[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                    if($dsalin->penolong=="bidan"||$dsalin->penolong=="dr.spesialis"||$dsalin->penolong=="dr.umum"||$dsalin->penolong=="lain-lain"){
                        $nakes[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                }
            }
            
        }
        foreach ($form as $desa=>$nilai){
            $likes[$desa] = $likes[$desa]*100/$target_bulin[$desa];
            $nakes[$desa] = $nakes[$desa]*100/$target_bulin[$desa];
        }
        
        
        $series4['page']='PDFK';
        $series4['form']=$likes;
        $series4['y_label']='Jumlah';
        $series4['series_name']='Jumlah';
        array_push($xlsForm, $series4);
        
        $series5['page']='PDTK';
        $series5['form']=$nakes;
        $series5['y_label']='Jumlah';
        $series5['series_name']='Jumlah';
        array_push($xlsForm, $series5);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') AND hariKeKF='kf4' AND userID='$bidan' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                }
            } 
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bufas[$desa];
        }
        
        $series6['page']='KN';
        $series6['form']=$form;
        $series6['y_label']='Jumlah';
        $series6['series_name']='Jumlah';
        array_push($xlsForm, $series6);
       
        $form = $user;
        $form2 = $user;
        $datavisit = $this->db->query("SELECT kohort_bayi_neonatal_period.*,kartu_ibu_registration.dusun FROM kohort_bayi_neonatal_period, kartu_pnc_dokumentasi_persalinan, kartu_anc_registration, kartu_ibu_registration WHERE (kohort_bayi_neonatal_period.submissionDate > '$startdate' AND kohort_bayi_neonatal_period.submissionDate < '$enddate' AND kohort_bayi_neonatal_period.userID='$bidan') AND (kohort_bayi_neonatal_period.childId = kartu_pnc_dokumentasi_persalinan.childId AND kartu_pnc_dokumentasi_persalinan.motherId = kartu_anc_registration.motherId AND kartu_anc_registration.kiId = kartu_ibu_registration.kiId)")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->dusun, $this->dusun[$bidan])){
                if($dvisit->kunjunganNeonatal=="Pertama"){
                    $form[$this->dusun[$bidan][$dvisit->dusun]] += 1;
                }elseif($dvisit->kunjunganNeonatal=="Ketiga"){
                    $form2[$this->dusun[$bidan][$dvisit->dusun]] += 1;
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $form[$desa]*100/$target_bufas[$desa];
            $form2[$desa] = $form2[$desa]*100/$target_bufas[$desa];
        }
        
        $series7['page']='KNN1';
        $series7['form']=$form;
        $series7['y_label']='Jumlah';
        $series7['series_name']='Jumlah';
        array_push($xlsForm, $series7);
        
        $series8['page']='KNN3';
        $series8['form']=$form2;
        $series8['y_label']='Jumlah';
        $series8['series_name']='Jumlah';
        array_push($xlsForm, $series8);
       
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_close WHERE submissionDate > '$startdate' AND submissionDate < '$enddate' AND userID='$bidan'")->result();
        foreach ($datavisit as $dvisit){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    if($dvisit->closeReason=="maternal_death"){
                        $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                }
            }
        }
        
        $series9['page']='KM';
        $series9['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series9);
       
        $form = $user;
        $form2 = $user;
        $form3 = $user;
        $data = $this->db->query("SELECT * FROM kohort_anak_tutup WHERE tanggalKematianAnak > '$startdate' AND tanggalKematianAnak < '$enddate' AND userID='$bidan'")->result();
        foreach ($data as $d){
            $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE kiId='$dvisit->kiId'")->result();
            foreach ($dataibu as $ibu){
                if(array_key_exists($ibu->dusun, $this->dusun[$bidan])){
                    $query = $this->db->query("SELECT tanggalLahirAnak FROM kohort_bayi_registration WHERE childId='$d->childId'");
                    if($query->num_rows<1){
                        continue;
                    }
                    $tgl_mati = date_create($d->tanggalKematianAnak);
                    $tgl_lahir = date_create($query->row()->tanggalLahirAnak);
                    $diff = date_diff($tgl_lahir,$tgl_mati);
                    if($tgl_mati->days>0&&$tgl_mati->days<29){
                        $form[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }elseif($tgl_mati->days>=29&&$tgl_mati->days<331){
                        $form2[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }elseif($tgl_mati->days>=331&&$tgl_mati->days<=1800){
                        $form3[$this->dusun[$bidan][$ibu->dusun]] += 1;
                    }
                }
            }
        }
        
        $series10['page']='KNN';
        $series10['form']=$form;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series10);
        
        $series11['page']='KB';
        $series11['form']=$form2;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series11);
        
        $series12['page']='KBLT';
        $series12['form']=$form3;
        $series9['y_label']='Jumlah';
        $series9['series_name']='Jumlah';
        array_push($xlsForm, $series12);
        
        return $xlsForm;
    }
    
    public function cakupanHHHBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND (ancKe=1 AND hiddenAncKe=1) group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_registration WHERE tanggalHPHT > '$gadate12' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC1SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=1 group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC1NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($this->isAnc4($dvisit)){
                    $form[$user_village[$dvisit->userID]] += 1;
                }
            }
        }
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_registration WHERE tanggalHPHT > '$gadate42' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC4SC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND ancKe=4 group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC4NC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_village)){
                $form[$user_village[$dsalin->userID]] += 1;
            }
        }
        $datapersalinan= $this->db->query("SELECT * FROM kartu_pnc_regitration_oa WHERE tanggalLahirAnak > '$startdate' AND tanggalLahirAnak < '$enddate'")->result();
        foreach ($datapersalinan as $dsalin){
            if(array_key_exists($dsalin->userID, $user_village)){
                $form[$user_village[$dsalin->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $form[$desa]*100/$target_bulin[$desa];
        }
        
        
        $series['page']='BC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') AND hariKeKF='kf4' group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                $form[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            $form[$desa] = $nilai*100/$target_bufas[$desa];
        }
        $series['page']='PNCC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    private function isAnc4($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' ORDER BY ancDate")->result();
        $anc = [false,false,false,false,false];
        $i = 0;
        foreach ($ancvisit as $visit){
            if($visit->tanggalHPHT=="None") continue;
            $ga = intval(date_diff(date_create($visit->ancDate),date_create($visit->tanggalHPHT))->days/7);
            if($ga<=12){
                $anc[1] = true;
            }elseif($ga>12&&$ga<=27){
                $anc[2] = true;
            }elseif($ga>27){
                $anc[3+$i] = true;
                $i++;
            }
        }
        return $anc[1]&&$anc[2]&&$anc[3]&&$anc[4];
    }
    
    private function isPnc4($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE motherId='$bumil->motherId' ORDER BY referenceDate")->result();
        $pnc = [false,false,false,false,false];
        foreach ($ancvisit as $visit){
            if($visit->tanggalLahirAnak=="None"||$visit->tanggalLahirAnak=="0NaN-NaN-NaN") continue;
            $ga = intval(date_diff(date_create($visit->referenceDate),date_create($visit->tanggalLahirAnak))->days/7);
            if($ga<=2){
                $pnc[1] = true;
            }elseif($ga>2&&$ga<=7){
                $pnc[2] = true;
            }elseif($ga>7&&$ga<=28){
                $pnc[3] = true;
            }elseif($ga>28&&$ga<=42){
                $pnc[4] = true;
            }
        }
        return $pnc[1]&&$pnc[2]&&$pnc[3]&&$pnc[4];
    }
    
    private function isHRP($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE motherId='$bumil->motherId' ORDER BY ancDate")->result();
        foreach ($ancvisit as $visit){
            if($visit->highRiskPregnancyProteinEnergyMalnutrition=="yes"||$visit->highRiskPregnancyPIH=="yes"){
                return true;
            }
        }
        return false;
    }
    
    private function isHRPP($bumil){
        $ancvisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE motherId='$bumil->motherId' ORDER BY referenceDate")->result();
        foreach ($ancvisit as $visit){
            if($visit->highRiskPostPartumDistosia=="yes"||$visit->highRiskPostPartumPIH=="yes"||$visit->highRiskPostPartumHemorrhage=="yes"||$visit->highRiskPostPartumInfection=="yes"||$visit->highRiskPostPartumMaternalSepsis=="yes"||$visit->highRiskPostPartumMastitis=="yes"){
                return true;
            }
        }
        return false;
    }
    
    private function isHbGiven($bayi){
        $bayivisit = $this->db->query("SELECT * FROM kohort_bayi_neonatal_period WHERE childId='$bayi->childId' ORDER BY submissionDate")->result();
        foreach ($bayivisit as $visit){
            if($visit->saatLahirsd5JamPemberianImunisasihbJikaDilakukan=="ya"||$visit->kunjunganNeonatalpertama6sd48jamPemberianimunisasiHB0=="ya"||$visit->kunjunganNeonatalKeduaHarike3sd7BayiDiberikanImunisasi=="ya"||$visit->KunjunganNeonatalKetigaharike8sd28bayidiberikanimunisasi=="ya"){
                return true;
            }
        }
        return false;
    }
    
    public function heartScoreBulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($this->isAnc4($dvisit)){
                    $den[$user_village[$dvisit->userID]] += 1;
                    if($this->isHRP($dvisit)){
                        $form[$user_village[$dvisit->userID]] += 1;
                    }
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='ANC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($this->isPnc4($dvisit)){
                    $den[$user_village[$dvisit->userID]] += 1;
                    if($this->isHRPP($dvisit)){
                        $form[$user_village[$dvisit->userID]] += 1;
                    }
                }
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='PNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kohort_bayi_neonatal_period WHERE (submissionDate > '$startdate' AND submissionDate < '$enddate') group by childId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($this->isHbGiven($dvisit)){
                    $form[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='Hb';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_pnc_visit WHERE (referenceDate > '$startdate' AND referenceDate < '$enddate') group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($this->isPnc4($dvisit)){
                    $form[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
        
        $series['page']='KPNC';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $form = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_rencana_persalinan WHERE (clientVersionSubmissionDate > '$startdate' AND clientVersionSubmissionDate < '$enddate') group by motherId")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->tanggalRencanaPersalinan!=""){
                    $form[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($form as $desa=>$nilai){
            if($den[$desa]==0) $form[$desa]=0;
            else $form[$desa] = $nilai*100/$den[$desa];
        }
            
        $series['page']='PRP';
        $series['form']=$form;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    private function isHbChecked($bumil){
        $dataibu = $this->db->query("SELECT * FROM kartu_anc_registration_oa WHERE motherId='$bumil->motherId'");
        if($dataibu->num_rows()<1)$dataibu = $this->db->query("SELECT * FROM kartu_anc_visit_labTest WHERE motherId='$bumil->motherId'");
        if($dataibu->num_rows()<1) return false;
        else{
            $dataibu=$dataibu->row();
            if($dataibu->laboratoriumPeriksaHbHasil!=""&&$dataibu->laboratoriumPeriksaHbHasil!="None") {
                return true;
            }
            else return false;
        }
    }
    
    private function isHamil($ibu){
        $datahamil = $this->db->query("SELECT * FROM kartu_anc_registration WHERE kiId='$ibu->kiId'")->result();
        foreach ($datahamil as $dhamil){
            $datapnc = $this->db->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE motherId='$dhamil->motherId'");
            if($datapnc->num_rows()<1){
                return true;
            }
        }
        return false;
    }
    
    public function trimester1BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $tdt = $bbt = $lilat = $hbt = $gdt = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=1")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->userID]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->userID]] += 1;
                }
                if($dvisit->hasilPemeriksaanLILA!=""&&$dvisit->hasilPemeriksaanLILA!="None"){
                    $lilat[$user_village[$dvisit->userID]] += 1;
                }
                if($this->isHbChecked($dvisit)){
                    $hbt[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        $dataibu = $this->db->query("SELECT * FROM kartu_ibu_registration WHERE (submissionDate > '$startdate' AND submissionDate < '$enddate')")->result();
        $den_gd = $user;
        foreach ($dataibu as $ibu){
            if(array_key_exists($ibu->userID, $user_village)){
                if($this->isHamil($ibu)){
                    if($ibu->golonganDarah!="NA"){
                        $gdt[$user_village[$ibu->userID]] += 1;
                    }
                }
                $den_gd[$user_village[$ibu->userID]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            else{
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
            $lilat[$desa] = $lilat[$desa]*100/$den[$desa];
            $hbt[$desa] = $hbt[$desa]*100/$den[$desa];
            }
            if($den_gd[$desa]==0) continue;
            else $gdt[$desa] = $gdt[$desa]*100/$den_gd[$desa];
        }
        
        $series['page']='TDT1';
        $series['form']=$tdt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT1';
        $series['form']=$bbt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='LILAT1';
        $series['form']=$lilat;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='HBT1';
        $series['form']=$hbt;
        $series['y_label']='Persentase';
        $series['series_name']='Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='GOLDART1';
        $series['form']=$gdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    public function trimester2BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $tdt = $bbt = $tfu = $pj = $djj = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=2")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->userID]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->userID]] += 1;
                }
                if($dvisit->tfu!=""&&$dvisit->tfu!="None"){
                    $tfu[$user_village[$dvisit->userID]] += 1;
                }
                if($dvisit->persentasiJanin!=""&&$dvisit->persentasiJanin!="None"){
                    $pj[$user_village[$dvisit->userID]] += 1;
                }
                if($dvisit->djj!=""&&$dvisit->djj!="None"){
                    $djj[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
            $tfu[$desa] = $tfu[$desa]*100/$den[$desa];
            $pj[$desa] = $pj[$desa]*100/$den[$desa];
            $djj[$desa] = $djj[$desa]*100/$den[$desa];
        }
        
        $series['page']='TDT2';
        $series['form']=$tdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT2';
        $series['form']=$bbt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='TFUT2';
        $series['form']=$tfu;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='PJT2';
        $series['form']=$pj;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='DJJT2';
        $series['form']=$djj;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
    
    public function trimester3BulanIni($bulan,$tahun){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $startdate = date("Y-m",  strtotime($tahun.'-'.$bulan_map[$bulan]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $gadate12 = date("Y-m", strtotime($startdate." -12 weeks"));
        $gadate42 = date("Y-m", strtotime($startdate." -42 weeks"));
        $this->load->model('PHPExcelModel');
        $xlsForm = [];
        $user   =  ['Lekor'=>0,'Saba'=>0,'Pendem'=>0,'Setuta'=>0,'Jango'=>0,'Janapria'=>0,'Ketara'=>0,'Sengkol'=>0,'Kawo'=>0,'Tanak Awu'=>0,'Pengembur'=>0,'Segala Anyar'=>0];
        $target_bumil   =  ['Lekor'=>230,'Saba'=>199,'Pendem'=>163,'Setuta'=>85,'Jango'=>81,'Janapria'=>199,'Ketara'=>101,'Sengkol'=>259,'Kawo'=>224,'Tanak Awu'=>217,'Pengembur'=>221,'Segala Anyar'=>72];
        $target_bulin   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_bufas   =  ['Lekor'=>220,'Saba'=>190,'Pendem'=>161,'Setuta'=>81,'Jango'=>78,'Janapria'=>190,'Ketara'=>97,'Sengkol'=>247,'Kawo'=>214,'Tanak Awu'=>207,'Pengembur'=>211,'Segala Anyar'=>69];
        $target_mt      =  ['Lekor'=>46,'Saba'=>40,'Pendem'=>34,'Setuta'=>17,'Jango'=>16,'Janapria'=>40,'Ketara'=>20,'Sengkol'=>52,'Kawo'=>45,'Tanak Awu'=>43,'Pengembur'=>44,'Segala Anyar'=>14];
        $user_village = ['user1'=>'Lekor','user2'=>'Saba','user3'=>'Pendem','user4'=>'Setuta','user5'=>'Jango','user6'=>'Janapria','user8'=>'Ketara','user9'=>'Sengkol','user10'=>'Sengkol','user11'=>'Kawo','user12'=>'Tanak Awu','user13'=>'Pengembur','user14'=>'Segala Anyar'];
        
        $tdt = $bbt = $user;
        $den = $user;
        $datavisit = $this->db->query("SELECT * FROM kartu_anc_visit WHERE (ancDate > '$startdate' AND ancDate < '$enddate') AND trimesterKe=3")->result();
        foreach ($datavisit as $dvisit){
            if(array_key_exists($dvisit->userID, $user_village)){
                if($dvisit->tandaVitalTDSistolik!=""&&$dvisit->tandaVitalTDSistolik!="None"){
                    if($dvisit->tandaVitalTDDiastolik!=""&&$dvisit->tandaVitalTDDiastolik!="None"){
                        $tdt[$user_village[$dvisit->userID]] += 1;
                    }
                }
                if($dvisit->bbKg!=""&&$dvisit->bbKg!="None"){
                    $bbt[$user_village[$dvisit->userID]] += 1;
                }
                $den[$user_village[$dvisit->userID]] += 1;
            }
        }
        foreach ($den as $desa=>$nilai){
            if($den[$desa]==0) continue;
            $tdt[$desa] = $tdt[$desa]*100/$den[$desa];
            $bbt[$desa] = $bbt[$desa]*100/$den[$desa];
        }
        
        $series['page']='TDT3';
        $series['form']=$tdt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        $series['page']='BBT3';
        $series['form']=$bbt;
        $series['y_label'] = 'Persentase';
        $series['series_name'] = 'Persentase';
        array_push($xlsForm, $series);
        
        return $xlsForm;
    }
}