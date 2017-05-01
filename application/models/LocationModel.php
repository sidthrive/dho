<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $loc = [
        "bidan"=>array(
            "Kota Mataram"=>array('user1'=>'Karang Pule','user2'=>'Jempong Baru','user3'=>'Tanjung Karang','user4'=>'Ampenan Selatan','user5'=>'Banjar','user6'=>'Kekalek Jaya','user7'=>'Tanjung Karang Permai','user8'=>'Pejeruk','user9'=>'Kebun Sari','user10'=>'Pejarakan Karya'),
            "Kabupaten Lombok Barat"=>array('user1'=>'Bengkel','user2'=>'Merembu','user3'=>'Bagik Polak Barat','user4'=>'Bagik Polak Timur','user5'=>'Telagawaru','user6'=>'Labuapi','user7'=>'Rumak','user8'=>'Banyumulek','user9'=>'Lelede','user10'=>'Dasan Baru'),
            "Kabupaten Lombok Tengah"=>array('user1'=>'Presak','user2'=>'Teduh','user3'=>'Kopang Rembige','user4'=>'Montong Gamang','user5'=>'Serage','user6'=>'Gerantung','user7'=>'Batu Tulis','user8'=>'Pengenjek','user9'=>'Tanah Beak','user10'=>'Sengkerang'),
            "Kabupaten Lombok Timur"=>array('user1'=>'Lendang Belo','user2'=>'Lendang Nangka Utara','user3'=>'Pringgabaya','user4'=>'Sembalun','user5'=>'Sembalun Bumbung','user6'=>'Wanasaba','user7'=>'Mamben Daya','user8'=>'Masbagik Utara Baru','user9'=>'Jero Gunung','user10'=>'Sukarara'),
            "Kabupaten Lombok Utara"=>array('user1'=>'Santong','user2'=>'Sesait','user3'=>'Pendua','user4'=>'Bentek','user5'=>'Gondang','user6'=>'Genggelang','user7'=>'Rempek','user8'=>'Sambik Bangkol','user9'=>'Pemenang Barat','user10'=>'Pemenang Timur'),
            "Kabupaten Sumbawa"=>array('user1'=>'Pekat','user2'=>'Jorok','user3'=>'Motong','user4'=>'Brang Kolong','user5'=>'Labu Ala','user6'=>'Suka Damai','user7'=>'Karang Dima','user8'=>'Usar Mapin','user9'=>'Juranalas','user10'=>'Labuhan Kuris'),
            "Kabupaten Sumbawa Barat"=>array('user1'=>'Seteluk Atas','user2'=>'Seteluk Tengah','user3'=>'Tapir','user4'=>'Loka','user5'=>'Rempe','user6'=>'Seran','user7'=>'Air Suning','user8'=>'Lamusung','user9'=>'Meraran','user10'=>'Kelanir'),
            "Kabupaten Bima"=>array('user1'=>'Timu','user2'=>'Sondo','user3'=>'Kananga','user4'=>'Rato','user5'=>'Tambe','user6'=>'Rasabou','user7'=>'Tente','user8'=>'Donggobolo','user9'=>'Keli','user10'=>'Dadibou'),
            "Kota Bima"=>array('user1'=>'Penatoi','user2'=>'Lewirato','user3'=>'Panggi','user4'=>'Sambinae','user5'=>'Manggemaci','user6'=>'Monggonao','user7'=>'Santi','user8'=>'Matakando','user9'=>'Mande','user10'=>'Sadia'),
            "Kabupaten Dompu"=>array('user1'=>'Bara','user2'=>'Mumbu','user3'=>'Wawonduru','user4'=>'Simpasai','user5'=>'Baka Jaya','user6'=>'Katua','user7'=>'Mangge Nae','user8'=>'Mbawi','user9'=>'Kareke','user10'=>'Dorebara')),
        "sdidtk"=>array(
            "Kabupaten Lombok Tengah"=>array('user1'=>'Presak','user2'=>'Teduh','user3'=>'Kopang Rembige','user4'=>'Montong Gamang','user5'=>'Serage','user6'=>'Gerantung','user7'=>'Batu Tulis'))
        ];
    
    private $loc_id = [
            "Kota Mataram"=>array('Karang Pule.'=>'Karang Pule','Jempong Baru'=>'Jempong Baru','Tanjung Karang.'=>'Tanjung Karang','Ampenan Selatan'=>'Ampenan Selatan','Banjar'=>'Banjar','Kekalek Jaya'=>'Kekalek Jaya','Tanjung Karang Permai'=>'Tanjung Karang Permai','Pejeruk.'=>'Pejeruk','Kebun Sari'=>'Kebun Sari','Pejarakan Karya'=>'Pejarakan Karya'),
            "Kabupaten Lombok Barat"=>array('Bengkel'=>'Bengkel','Merembu'=>'Merembu','Bagik Polak Barat'=>'Bagik Polak Barat','Bagik Polak Timur'=>'Bagik Polak Timur','Telagawaru'=>'Telagawaru','Labuapi.'=>'Labuapi','Rumak'=>'Rumak','Banyumulek.'=>'Banyumulek','Lelede'=>'Lelede','Dasan Baru'=>'Dasan Baru'),
            "Kabupaten Lombok Tengah"=>array('Presak'=>'Presak','Teduh'=>'Teduh','Kopang Rembige'=>'Kopang Rembige','Montong Gamang'=>'Montong Gamang','Serage'=>'Serage','Gerantung'=>'Gerantung','Batu Tulis'=>'Batu Tulis','Pengenjek'=>'Pengenjek','Tanah Beak'=>'Tanah Beak','Sengkerang'=>'Sengkerang'),
            "Kabupaten Lombok Tengah 2"=>array('Presak'=>'Presak','Teduh'=>'Teduh','Kopang Rembige'=>'Kopang Rembige','Montong Gamang'=>'Montong Gamang','Serage'=>'Serage','Gerantung'=>'Gerantung','Batu Tulis'=>'Batu Tulis'),
            "Kabupaten Lombok Timur"=>array('Lendang Belo'=>'Lendang Belo','Lendang Nangka Utara'=>'Lendang Nangka Utara','Pringgabaya'=>'Pringgabaya','Sembalun..'=>'Sembalun','Sembalun Bumbung'=>'Sembalun Bumbung','Wanasaba.'=>'Wanasaba','Mamben Daya'=>'Mamben Daya','Masbagik Utara Baru'=>'Masbagik Utara Baru','Jero Gunung'=>'Jero Gunung','Sukarara'=>'Sukarara'),
            "Kabupaten Lombok Utara"=>array('Santong.'=>'Santong','Sesait'=>'Sesait','Pendua'=>'Pendua','Bentek'=>'Bentek','Gondang'=>'Gondang','Genggelang'=>'Genggelang','Rempek'=>'Rempek','Sambik Bangkol'=>'Sambik Bangkol','Pemenang Barat'=>'Pemenang Barat','Pemenang Timur'=>'Pemenang Timur'),
            "Kabupaten Sumbawa"=>array('Pekat'=>'Pekat','Jorok'=>'Jorok','Motong'=>'Motong','Brang Kolong'=>'Brang Kolong','Labu Ala'=>'Labu Ala','Suka Damai.'=>'Suka Damai','Karang Dima'=>'Karang Dima','Usar Mapin'=>'Usar Mapin','Juranalas'=>'Juranalas','Labuhan Kuris'=>'Labuhan Kuris'),
            "Kabupaten Sumbawa Barat"=>array('Seteluk Atas'=>'Seteluk Atas','Seteluk Tengah'=>'Seteluk Tengah','Tapir'=>'Tapir','Loka'=>'Loka','Rempe'=>'Rempe','Seran'=>'Seran','Air Suning'=>'Air Suning','Lamusung'=>'Lamusung','Meraran'=>'Meraran','Kelanir'=>'Kelanir'),
            "Kabupaten Bima"=>array('Timu'=>'Timu','Sondo'=>'Sondo','Kananga'=>'Kananga','Rato'=>'Rato','Tambe'=>'Tambe','Rasabou'=>'Rasabou','Tente'=>'Tente','Donggobolo'=>'Donggobolo','Keli'=>'Keli','Dadibou'=>'Dadibou'),
            "Kota Bima"=>array('Penatoi'=>'Penatoi','Lewirato'=>'Lewirato','Panggi'=>'Panggi','Sambinae'=>'Sambinae','Manggemaci'=>'Manggemaci','Monggonao'=>'Monggonao','Santi'=>'Santi','Matakando'=>'Matakando','Mande'=>'Mande','Sadia'=>'Sadia'),
            "Kabupaten Dompu"=>array('Bara'=>'Bara','Mumbu'=>'Mumbu','Wawonduru'=>'Wawonduru','Simpasai'=>'Simpasai','Baka Jaya'=>'Baka Jaya','Katua'=>'Katua','Mangge Nae'=>'Mangge Nae','Mbawi'=>'Mbawi','Kareke'=>'Kareke','Dorebara'=>'Dorebara')
        ];
    
    private $int_loc_id = [
            "bidan"=>array('Serage'=>'Serage','Teduh'=>'Teduh','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Mantang.'=>'Mantang','Presak.'=>'Presak','Gemel'=>'Gemel','Batu Tulis'=>'Batu Tulis','Labulia'=>'Labulia'),
            "sdidtk"=>array('Serage'=>'Serage','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Presak.'=>'Presak','Batu Tulis'=>'Batu Tulis')
        ];
    
    private $dusun = [
        'Bengkel'=>array(1=>'Bengkel Timur Mekar','Bengkel Timur Induk','Bengkel Barat','Bengkel Selatan Induk','Bengkel Selatan Mekar','Bengkel Utara Timur','Bengkel Utara Tengah','Bengkel Utara Barat','Datar'),
        'Merembu'=>array(1=>'Tangkeban','Begende','Karang Sembung','Rungkang','Merembu Barat','Merembu Timur','Merembu Barat II','Merembu Tengak'),
        'Bagik Polak Barat'=>array(1=>'Jogot Barat','Jogot Tengah','Jogot Timur','Jogot Selatan','Lendang','Jereneng'),
        'Bagik Polak Timur'=>array(1=>'Karang Bucu Lauk','Karang Bucu Daye','Rerot','Karang Kebon Barat','Karang Kebon Timur','Enjak'),
        'Telagawaru'=>array(1=>'Paok Kambut I','Paok Kambut II','Gubuk Aida','Telagawaru.','Telagawaru III','Btn Bhp'),
        'Labuapi'=>array(1=>'Labuapi Utara I','Labuapi  Utara II','Labuapi Selatan','Labuapi Timur','Labuapi Repok'),
        'Rumak'=>array(1=>'Rubar Selatan','Rubar Utara','Rutim Selatan','Rutim Utara'),
        'Banyumulek'=>array(1=>'Mekar Sari','Karang Pande','Pengodongan','Kerangkeng Timur','Kerangkeng Barat','Banyumulek Timur','Gubuk Barat','Banyumulek Barat','Muhajirin'),
        'Lelede'=>array(1=>'Dasan Bawak','Lelede Kdi','Lelede Dasan','Lelede Desa','Lelede Selaparang','Lelede Sukadana'),
        'Dasan Baru'=>array(1=>'Bebae Dalam','Bebae Luar','Bangle','Dasan Baru.','Kebon Lelede','Kebon Orong','Memunggu'),
        'Pengenjek'=>array(1=>'Bun Waru','Bun Gini','Beber Daye','Beber Lauk','Bun Owah','Montong Sari','Pengenjek Daye','Kantor Indah','Montong Praje Barat','Montong Praje Timur','Berembeng Bat Daye','Berembeng Daye','Berembeng Lauk','Otak Desa','Taman Baru','Montong Bangle','Pengenjek Lauk'),
        'Tanah Beak'=>array(1=>'Ceking','Tanak Beak Barat II','Tanak Beak Barat I','Prampuan','Mandok','Tanak Beak Timur','Jurang Tanggluk','Tanak Bengan','Dasan Agung','Kebun Indah','Montong Tanggak'),
        'Sengkerang'=>array(1=>'Sengkerang 1','Sengkerang II','Sengkerang III','Sengkerang IV','Sengkerang V','Kesambik Mate','Penangsak','Montong Tanggak.','Telok Timuk','Telok Bat','Pinggir','Pesaut','Balen Gagak','Pemondah','Dasan Lendang','Bagek Rebak','Penambong'),
        'Karang Pule'=>array(1=>'Karang Pule I','Pande Mas Timur','Pande Mas Barat','Pande Besi I','Pande Besi II','Btn Kekalek','Karang Seme','Karang Seme II','Mas Mutiara'),
        'Jempong Baru'=>array(1=>'Jempong Timur','Jempong Barat','Kodya Asri','Geguntur','Mataram Asri','Batu Mediri','Dasan Kolo','Pekandelan','Mapak Dasan','Mapak Belatung','Mapak Indah'),
        'Ampenan Selatan'=>array(1=>'Tangsi','Karang Panas','Gatep','Karang Buyuk'),
        'Banjar'=>array(1=>'Banjar.','Sintung','Selaparang','Selaparang.'),
        'Kekalek Jaya'=>array(1=>'Kekalek Kijang','Kekalek Timur','Komp. Angkatan Laut','Sembada Asri','Kekalek Barat','Gerisak','Kekalek Indah','Gerisak Aman'),
        'Tanjung Karang'=>array(1=>'Batu Dawa','Batu Ringgit Utara','Batu Ringgit Selatan','Bendega','Bangsal','Sembalun'),
        'Tanjung Karang Permai'=>array(1=>'Barito','Batanghari','Sejahtera','Asahan','Bagek Kembar'),
        'Pejeruk'=>array(1=>'Pejeruk Desa','Pejeruk Abian','Pejeruk Perluasan','Pejeruk Sejahtera','Kebon Jeruk','Kebon Jeruk Baru','Pejeruk Bangket','Kebon Bawak Barat'),
        'Kebun Sari'=>array(1=>'Kebun Bawak Timur','Karang Baru','Kebun Bawak Tengah','Dasan Sari','Kebun Bawak Nurul Yaqin'),
        'Pejarakan Karya'=>array(1=>'Pejarakan','Penan','Moncok Karya I','Moncok Karya II','Moncok Telaga Emas'),
        'Santong'=>array(1=>'Temposodo','Sempakok','Mekar Jati','Cempaka','Santong Timur','Mentari Timur','Santong Barat','Subak Sepulu','Suka Damai','Waker','Santong Asli','Gubuk Baru','Santong Tengah','Mekar Sari.'),
        'Sesait'=>array(1=>'Sumur Pande Tengah','Sumur Pande Lauk','Sumur Pande Daya','Bat Pawang','Kebalon','Lokok Are','Batu Jompang','Pansor Tengah','Pansor Daya','Sumur Jiri','Lokok Sutrang','Tukak Bendu','Santong Mulia','Mulagati','Lokok','Oman Rot','Pedaleman','Sesait.','Pansor Lauk'),
        'Pendua'=>array(1=>'Lokok Senggol','Pendua Lauk','Pendua Daya','Sentul','Lokok Bata'),
        'Bentek'=>array(1=>'Goa','Dasan Baro','Dasan Bangket','Todo Lauk','Todo Daya','Buani','Orong Luk','Karang Lendang','Lenek','Pasiran','Baru','Kakong','Serungga','Batu Ringgit','Selelos','Sengaran'),
        'Gondang'=>array(1=>'Karang Kates','Lekok Utara','Lekok Timur','Lekok Selatan','Lekok Tenggara','Karang Bedil','Karang Amor','Karang Pendagi','Lokok Gitak','Karang Anyar','Gondang Timur','Jeliti','Besari'),
        'Genggelang'=>array(1=>'Papak II','Papak II.','Karang Krakas','Karang Jurang','Sembaro','Lendagn Bagian','Karang Kendal','Kerurak','Sankukun','Bulan Semu','Penjor','Ketaharja','Gitak Demung','Gangga.','Senara','Dasan Sambik','Lias','Monggal Atas','Monggal Bawah','Paok Rempek','Tempos Kujur'),
        'Rempek'=>array(1=>'Lempenge','Montong Pall','Jelitong','Kuripan','Telaga Maluku','Bat Koloh','Atas Telabah','Sejuik','Gelumpung','Duria','Rempek Barat','Rempek Timur','Palang','Soloh Bawah','Soloh Atas','Pancor Getah','Pawang Busur','Busur','Tuan Ani'),
        'Sambik Bangkol'=>array(1=>'Papanda Bawah','Sambik Bangkol.','Oman Telaga','Luk Barat','Luk Timur','Klongkong','Jugil','Senjajak','Kopong Sebangun','Beririjarak','Papanda Atas'),
        'Pemenang Barat'=>array(1=>'Karang Desa','Karang Subagan','Karang Gelebek','Karang Pangsor','Telaga Wareng','Menggala','Kerujuk','Bentek.','Telok Ombal','Sumur Mual'),
        'Pemenang Timur'=>array(1=>'Karang Petak','Karang Montong Lauk','Karang Montong Daye','Karang Baro','Karang Bedil.','Tebango','Trengan Tanak Ampar','Trengan Lauk','Trengan Tengah','Trengan Daye','Trengan Timur','Koloh Tanjung','Muara Putat','Karang Bangket','Tebango Bolot'),
        'Lendang Belo'=>array(1=>'Peresak Barat','Balik Batang Utara','Balik Batang Selatan','Lendang Belo.','Peresak Timur'),
        'Lendang Nangka Utara'=>array(1=>'Jimse','Montong Sube','Gonjong Utara','Benteng Selatan 1','Benteng Selatan 2','Otak Pancor Utara','Loang Sawak','Gawah Malang','Benteng Utara','Otak Pancor Selatan','Kapitan','Borok Lelet','Masjid Bakek'),
        'Pringgabaya'=>array(1=>'Otak Desa.','Padamara','Tanak Renteng','Pekosong','Belawong','Dasan Lendang.','Jejangka Daya','Bararuntak','Karang Kapitan','Seimbang','Ketapang','Jejangka Lauk','Goge','Embur','Puncang Sari'),
        'Sembalun'=>array(1=>'Mentagi','Lendang Luar'),
        'Sembalun Bumbung'=>array(1=>'Jorong Lama','Jorong Baru','Daya Rurung Baret','Bebante','Daya Rurung Timuk','Lauk Rurung Baret','Lauk Rurung Timuk','Batu Jalik'),
        'Wanasaba'=>array(1=>'Beak Daya','Beak Lauk','Baret Orong','Terutuk','Jorong Daya','Jorong Lauk'),
        'Mamben Daya'=>array(1=>'Gelumpang','Renga','Gubuk Timuk 2','Bagek Longgek Baret','Gubuk Baret 2','Gubuk Baret 1','Gubuk Timuk 1','Kalibening','Dasan Rambak','Omba','Bagek Longgek Timuk'),
        'Masbagik Utara Baru'=>array(1=>'Tanak Maik','Nibas','Nibas II','Paok Kambut','Montong Dao','Karang Geres','Pancor Kopong'),
        'Jero Gunung'=>array(1=>'Repok Dese','Lingkok Mudung','Embung Sayut'),
        'Sukarara'=>array(1=>'Jeropoto','Dasan Repok','Sukarara Utara','Sukarara Selatan','Sukawangi','Asem','Tangar'),
        'Timu'=>array(1=>'Dusun I','Dusun II','Dusun III','Dusun IV','Dusun V'),
        'Sondo'=>array(1=>'Sejahtera.','Beringin','Ntanda Ndeu','Palisondo','Sebua Ade'),
        'Kananga'=>array(1=>'Dusun 1','Dusun 2','Dusun 3','Dusun 4'),
        'Rato'=>array(1=>'Dorowila','Tegal Sari','Kotabaru','Rato.','Saleko','Sigi 1','Sigi 2'),
        'Tambe'=>array(1=>'Dusun 1.','Dusun 2.','Dusun 3.','Dusun 4.','Dusun 5'),
        'Rasabou'=>array(1=>'Dusun 1..','Dusun 2..','Dusun 3..','Dusun 4..','Dusun 5.'),
        'Tente'=>array(1=>'Anggrek','Sukamaju','Bante','Kananga.'),
        'Donggobolo'=>array(1=>'Pali','Sigi','Kenanga','Cempaka.'),
        'Keli'=>array(1=>'Rato..','Sigi.','Mekar','Hodo'),
        'Dadibou'=>array(1=>'Minte','Godo','Dadibou.'),
        'Pekat'=>array(1=>'Rw 08','Rw 02','Rw 03, Rw 04, Rw 05','Rw 01, Rw 06, Rw 07'),
        'Jorok'=>array(1=>'Jorok Dalam','Jorok Tengah','Jorok Luar','Jorok Tengah.','Koda Luar','Koda Dalam','Sekokok'),
        'Motong'=>array(1=>'Motong Barat','Motong Tengah','Motong Timur','Raja Borang','Perung','Rapang'),
        'Brang Kolong'=>array(1=>'Kolong','Unter Lestari'),
        'Labu Ala'=>array(1=>'Labu Ala.','Labuhan Ujung'),
        'Suka Damai'=>array(1=>'Karang Anyar.','Karang Agung','Karang Geluni','Kembang Kuning','Karang Banjar','Karang Tengah'),
        'Karang Dima'=>array(1=>'Buin Pandan','Bangkong','Sumer Payung','Pamulung','Batu Nisung','Tanjung Pengamas','Kayangan'),
        'Usar Mapin'=>array(1=>'Hijrah','Gelampar','Hijrah Baru','Tamsi'),
        'Juranalas'=>array(1=>'Juranalas.','Tal','Brang Bage','Penua'),
        'Labuhan Kuris'=>array(1=>'Kuris',"Ai' Mual",'Ketanga','Labuhan Kuris.','Ngali','Lab. Terata I','Lab. Terata II','Lab. Terata III','Tanjung Bila','Batu Reneng'),
        'Seteluk Atas'=>array(1=>'Seteluk Atas.','Mata Ai','Mata Ai.','Benteng'),
        'Seteluk Tengah'=>array(1=>'Seteluk Tengah.','Jaro','Mandar','Mandar.','Selayar','Lala Jinis','Pamongo','Beda Rea','Beda Rea'),
        'Tapir'=>array(1=>'Mongal','Tapir Dalam','Tapir Luar'),
        'Loka'=>array(1=>'Segunter','Umatuan'),
        'Rempe'=>array(1=>'Rempe Beru & Kenangan','Sampir'),
        'Seran'=>array(1=>'Lenang Datu','Beru'),
        'Air Suning'=>array(1=>'Air Suning.','Batu Bintang','Batu Bulan'),
        'Lamusung'=>array(1=>'Lamusung.','Lengkok','Bugis'),
        'Meraran'=>array(1=>'Meraran.','Aina','Batu Cermai'),
        'Kelanir'=>array(1=>'Kelanir.','Rigalu','Sedong'),
        'Penatoi'=>array(1=>'Kalate 1','Btn Penatoi','Lewilanco I','Lewilanco II','Kalate II','Apel'),
        'Lewirato'=>array(1=>'Lewirato I','Lewirato II'),
        'Panggi'=>array(1=>'Panggi.'),
        'Sambinae'=>array(1=>'Sambinae I','Sambinae II'),
        'Manggemaci'=>array(1=>'Manggemaci.','Waki','Bedi','Kamp. Samporo'),
        'Monggonao'=>array(1=>'Monggonao.','Lewirowa','Aspol Gunung Dua','Karara','Btn Nusantara'),
        'Santi'=>array(1=>'Santi I','Btn Santi','Santi II Barat','Santi II Melati'),
        'Matakando'=>array(1=>'Tolotando','Rabantala','Soncolela'),
        'Mande'=>array(1=>'Mande I','Mande II','Mande III','Al Muhajirin'),
        'Sadia'=>array(1=>'Sadia I','Sadia II','Btn Sadia'),
        'Bara'=>array(1=>'Bara.','Sipon','Lapas','Kebuntu','Dorolapa'),
        'Mumbu'=>array(1=>'Madamina','Mada Fanda','Tonda','Embung','Mumbu.'),
        'Wawonduru'=>array(1=>'Bolonduru','Wawonduru Timur','Wawonduru Barat & Rabatumpu','Rato Baka'),
        'Simpasai'=>array(1=>'Simpasai Atas',' Simpasai Bawah','Ncera','Larema','Renda','Lingkungan Bali Dua','Manggemaci..'),
        'Baka Jaya'=>array(1=>'Rasanae','Bolo Baka','Campa','Woro Baka','Ama Maka'),
        'Katua'=>array(1=>'Katua.','Lagara','Doro Kore'),
        'Mangge Nae'=>array(1=>'Mangge Nae.','Sori Kuta','Karaku'),
        'Mbawi'=>array(1=>'Ragi','Owo','Mpungga','Pelita','Mbawi.','Palikarawe'),
        'Kareke'=>array(1=>'Sarae','Kareke Dan Rade Dao','Pandai Dan Doro Ngguni','Hijrah Dan Raba'),
        'Dorebara'=>array(1=>'Desa Potu Dua','Dorebara Utara','Dorebara Selatan','Wera','Mada Oi Umbu'),
        'Santong'=>array(1=>'Temposodo','Sempakok','Cempaka','Santong Timur','Santong Barat','Subak Pepulu','Suka Damai','Waker','Santong Asli','Gubuk Baru','Santong Tengah','Mekar Sari'),
        'Sesait'=>array(1=>'Sumur Pande Tengah','Sumur Pande Lauk','Sumur Pande Daya','Bat Pawang','Kebalon','Lokok Are','Batu Jompang','Pansor Tengah','Pansor Daya','Sumur Jiri','Lk Strang','Tk Benak','Santong Mulia','Oman Rot','Sesait','Pansor Lauk'),
        'Pendua'=>array(1=>'Lokok Senggol','Lokok Bata','Pendua Lauk','Pendua Daya','Sentul'),
        'Bentek'=>array(1=>'Goa','Dasan Baro','Dasan Bangket','Todo Lauk','Todo Daya','Buani','Orong Luk','Karang Lendang','Lenek','Pasiran','Baru','Kakong','Serungga','Batu Ringgit','Selelos','Sengaran'),
        'Gondang'=>array(1=>'Karang Kates','Lekok Utara','Lekok Timur','Lekok Selatan','Lekok Tenggara','Karang Bedil','Karang Amor','Karang Pendagi','Lokok Gitak','Karang Anyar','Gondang Timur','Jeliti','Besari'),
        'Genggelang'=>array(1=>'Papak I','Papak II','Karang Krakas','Karang Jurang','Sembaro','Lendang Bagian','Karang Kendal','Kerurak','Sankukun','Bulan Semu','Penjor','Kertaraharja','Gitak Demung','Gangga','Senara','Dasan Sambik','Lias','Monggal Atas','Monggal Bawah','Paok Rempek','Tempos Kujur'),
        'Rempek'=>array(1=>'Lempenge','Montong Pall','Jelitong','Kuripan','Telaga Maluku','Bat Koloh','Atas Telabah','Sejuik','Gelumpang','Duria','Rempek Barat','Rempek Timur','Soloh Bawah','Soloh Atas','Pancor Getah','Pawang Busur','Busur','Tuan Ani'),
        'Sambik Bangkol'=>array(1=>'Papanda Bawah','Sambik Bangkol','Oman Telaga','Luk Barat','Luk Timur','Klongkong,','Jugil','Senjajak,','Kopong Sebangun,','Beririjarak','Papanda Atas'),
        'Pemenang Barat'=>array(1=>'Karang Desa','Karang Subagan','Karang Gelebek','Karang Pangsor','Telaga Wareng','Menggala','Krujuk','Bentek','Telok Kombal','Sumur Mual'),
        'Pemenang Timur'=>array(1=>'Karang Petak','Karang Montong Lauk','Karang Montong Daye','Karang Baro','Karang Bedil','Tebango','Tr Tanak Ampar','Tr Lauk','Tr Tengah','Tr Daye','Tr Timur','Koloh Tanjung','Muara Putat','Karang Bangket','Tebango Bolot'),
        'Pandan Indah'=>array(1=>'Aik kerit','Bolor gejek','kelambi 1','kelambi 2','Kreak','Mangkoneng','Nangker','Panggongan','Rege','Sukalalem'),
        'Serage'=>array(1=>'Beberik','Belenje','Bt. salang','Lekong jae','Mapasan','Rurut','Semaye','Sulung'),
        'Teduh'=>array(1=>'Jati','Montong putik','Pengengat','Pengolah','Teduh.'),
        'Gerantung'=>array(1=>'Bual 2','Bual.','Gerantung.','Guntur','Juring','Lingkok Kudung'),
        'Jurang Jaler'=>array(1=>'Berembeng','Jurang Jaler.','Lingkok Eyat','Mapong','Mertak Men','Pinggal Bedok','Prai Gunung'),
        'Pengadang'=>array(1=>'Banar','Banar2','Bikan Pait','Bun Datu','Bunut Bireng','Embur Teres','LD. Kunyit 1','LD. Kunyit 2','MT. Tanggak','MT. Tanggak Selatan','Pengadang Selatan','Pengadang Utara','Prentek','Rangah','Regak','Sorong','Sundawe','Tambun'),
        'Aik Bual'=>array(1=>'Bare Eleh','Bual','Nyeredet','Pertanian','Rabuli','Ramus','Talon Ambon'),
        'Kopang Rembiga'=>array(1=>'Bajur','Barat Masjid','Bebak','Bhineka','Bore','BTN Jelojok','Gubuk','Gubuk Alang','Gunung Malang','Jontak','Kayun','Kopang 1','Lendang Lok','Lingkung','Mentinggo','Ngorok','Pendagi','Pengkores','Puyung.','Renggung'),
        'Montong Gamang'=>array(1=>'Binkok','Dasan tinggi','Embung Karung 1','Embung Karung 2','Embung Karung 3','Gonjong.','Karang Tengak','Montong Bulok','Montong Gamang 1','Montong Gamang 2','Montong Gamang 3','Montong Tanger','Mumbang 1','Mumbang 2','Mumbang 3','Nyanggi','Penimpah'),
        'Barabali'=>array(1=>'Barabali 1','Barabali 2','Celegeh','Dasan Baru','Gwh. Lendang Terong','Kebon Nyiur','Kelanjuh Lk','Ld. Dode','Ld. Re','Ld. Terong Daye','Lk. Kudung','Muhajirin h','Pondok Pande','Prako','Presak..','Sade','Surebaye Bat','Surebaye Daye','Surebaye Lauq','Tojak'),
        'Mantang'=>array(1=>'Alun-alun','Banjar Metu','Ceret','Gb. Gunung','Jantuk','Kabar','Kelanjuh Daye','Keren','Mantang I','Otak Desa','Pengadok','Raju Mas','Riris','Seganteng','Tampeng','Tenten','Tj. Bereng B','Tj. Bereng T','Tundung'),
        'Presak'=>array(1=>'Aik Gering','Batu Lajan','Boak','Bujak Daye','Ds. Aman','Dumpu','Pajangan','Penyengak','Presak Daye','Presak Lauk','Presak Tengak','Sandik','Selojan','Subahnale I','Subahnale II'),
        'Tampak Siring'=>array(1=>'Antak-Antak','Batu Meta','Beneng','Dsn. Baru','Gbk. Blimbing','Jadot','Jeranjang','Ld. Kekah','Lk. Petelahan','Pedadan','Sanggok'),
        'Mujur'=>array(1=>'Berenyok','Budiwathon','Bunut Baok','Gawah Malang','Kebun Alit','Kolak','Kudung Are','Lokon','Montong Inggu','Mungkik','Orok-orok','Pendem.','Pengendong','Perluasan','Santong.','Sebolet','Senayan','Serasap','Tanak Beak','Tembuku'),
        'Sukaraja'=>array(1=>'Bengkang','Karang katon','Kebun pelangeh','Kudung paok','Lengkah','Mircod','Montong bile.','Rajak','Selandung','Songkok'),
        'Dasan Ketujur'=>array(1=>'Bangket tengak','Dasan ketujur','Gubuk Punik','Krembeng','Lingkung daye','Lingkung Lauk','Merek','Mosok','Otak dese','Pedalaman','Sengkolit','Singosari','Sumpak bat','Sumpak timuk','Taman daye','Waker'),
        'Gemel'=>array(1=>'Bilemantik','Bunceman','Bunprie','Bunsibah','Gemel.','Kebun tengak','Merobok','Mtg. Kecial'),
        'Batu Tulis'=>array(1=>'Bangket Gawah','Batu Tulis.','Bon Rungkang','Bonje','Gontoran','Jereneng'),
        'Labulia'=>array(1=>'Batu Tinggang','Bonduduk','Dasan Sebeleq','Enjak','Labulia.','Olor Agung','Sulin','Tandek','Tober'),
        'Ubung'=>array(1=>'Aik Are','Bagek Nunggal','Batrate','Batu Karang','Bejelo','Bile Kere','Dasan Baru.','Keraning','Pelowok','Pemangket','Punimbe','Punjambong','Tohpati','Ubung 1')
    ];
    
    private $dusun_typo = [
        'Bengkel'=>array('Bengkel Timur Mekar'=>'Bengkel Timur Mekar','Bengkel Timur Induk'=>'Bengkel Timur Induk','Bengkel Barat'=>'Bengkel Barat','Bengkel Selatan Induk'=>'Bengkel Selatan Induk','Bengkel Selatan Mekar'=>'Bengkel Selatan Mekar','Bengkel Utara Timur'=>'Bengkel Utara Timur','Bengkel Utara Tengah'=>'Bengkel Utara Tengah','Bengkel Utara Barat'=>'Bengkel Utara Barat','Datar'=>'Datar'),
        'Merembu'=>array('Tangkeban'=>'Tangkeban','Begende'=>'Begende','Karang Sembung'=>'Karang Sembung','Rungkang'=>'Rungkang','Merembu Barat'=>'Merembu Barat','Merembu Timur'=>'Merembu Timur','Merembu Barat II'=>'Merembu Barat II','Merembu Tengak'=>'Merembu Tengak'),
        'Bagik Polak Barat'=>array('Jogot Barat'=>'Jogot Barat','Jogot Tengah'=>'Jogot Tengah','Jogot Timur'=>'Jogot Timur','Jogot Selatan'=>'Jogot Selatan','Lendang'=>'Lendang','Jereneng'=>'Jereneng'),
        'Bagik Polak Timur'=>array('Karang Bucu Lauk'=>'Karang Bucu Lauk','Karang Bucu Daye'=>'Karang Bucu Daye','Rerot'=>'Rerot','Karang Kebon Barat'=>'Karang Kebon Barat','Karang Kebon Timur'=>'Karang Kebon Timur','Enjak'=>'Enjak'),
        'Telagawaru'=>array('Paok Kambut I'=>'Paok Kambut I','Paok Kambut II'=>'Paok Kambut II','Gubuk Aida'=>'Gubuk Aida','Telagawaru.'=>'Telagawaru','Telagawaru III'=>'Telagawaru III','Btn Bhp'=>'Btn Bhp'),
        'Labuapi'=>array('Labuapi Utara I'=>'Labuapi Utara I','Labuapi Utara II'=>'Labuapi Utara II','Labuapi Selatan'=>'Labuapi Selatan','Labuapi Timur'=>'Labuapi Timur','Labuapi Repok'=>'Labuapi Repok'),
        'Rumak'=>array('Rubar Selatan'=>'Rubar Selatan','Rubar Utara'=>'Rubar Utara','Rutim Selatan'=>'Rutim Selatan','Rutim Utara'=>'Rutim Utara'),
        'Banyumulek'=>array('Mekar Sari'=>'Mekar Sari','Karang Pande'=>'Karang Pande','Pengodongan'=>'Pengodongan','Kerangkeng Timur'=>'Kerangkeng Timur','Kerangkeng Barat'=>'Kerangkeng Barat','Banyumulek Timur'=>'Banyumulek Timur','Gubuk Barat'=>'Gubuk Barat','Banyumulek Barat'=>'Banyumulek Barat','Muhajirin'=>'Muhajirin'),
        'Lelede'=>array('Dasan Bawak'=>'Dasan Bawak','Lelede Kdi'=>'Lelede Kdi','Lelede Dasan'=>'Lelede Dasan','Lelede Desa'=>'Lelede Desa','Lelede Selaparang'=>'Lelede Selaparang','Lelede Sukadana'=>'Lelede Sukadana'),
        'Dasan Baru'=>array('Bebae Dalam'=>'Bebae Dalam','Bebae Luar'=>'Bebae Luar','Bangle'=>'Bangle','Dasan Baru.'=>'Dasan Baru','Kebon Lelede'=>'Kebon Lelede','Kebon Orong'=>'Kebon Orong','Memunggu'=>'Memunggu'),
        'Pengenjek'=>array('Bun Waru'=>'Bun Waru','Bun Gini'=>'Bun Gini','Beber Daye'=>'Beber Daye','Beber Lauk'=>'Beber Lauk','Bun Owah'=>'Bun Owah','Montong Sari'=>'Montong Sari','Pengenjek Daye'=>'Pengenjek Daye','Kantor Indah'=>'Kantor Indah','Montong Praje Barat'=>'Montong Praje Barat','Montong Praje Timur'=>'Montong Praje Timur','Berembeng Bat Daye'=>'Berembeng Bat Daye','Berembeng Daye'=>'Berembeng Daye','Berembeng Lauk'=>'Berembeng Lauk','Otak Desa'=>'Otak Desa','Taman Baru'=>'Taman Baru','Montong Bangle'=>'Montong Bangle','Pengenjek Lauk'=>'Pengenjek Lauk'),
        'Tanah Beak'=>array('Ceking'=>'Ceking','Tanak Beak Barat II'=>'Tanak Beak Barat II','Tanak Beak Barat I'=>'Tanak Beak Barat I','Prampuan'=>'Prampuan','Mandok'=>'Mandok','Tanak Beak Timur'=>'Tanak Beak Timur','Jurang Tanggluk'=>'Jurang Tanggluk','Tanak Bengan'=>'Tanak Bengan','Dasan Agung'=>'Dasan Agung','Kebun Indah'=>'Kebun Indah','Montong Tanggak'=>'Montong Tanggak'),
        'Sengkerang'=>array('Sengkerang 1'=>'Sengkerang 1','Sengkerang II'=>'Sengkerang II','Sengkerang III'=>'Sengkerang III','Sengkerang IV'=>'Sengkerang IV','Sengkerang V'=>'Sengkerang V','Kesambik Mate'=>'Kesambik Mate','Penangsak'=>'Penangsak','Montong Tanggak.'=>'Montong Tanggak','Telok Timuk'=>'Telok Timuk','Telok Bat'=>'Telok Bat','Pinggir'=>'Pinggir','Pesaut'=>'Pesaut','Balen Gagak'=>'Balen Gagak','Pemondah'=>'Pemondah','Dasan Lendang'=>'Dasan Lendang','Bagek Rebak'=>'Bagek Rebak','Penambong'=>'Penambong'),
        'Karang Pule'=>array('Karang Pule I'=>'Karang Pule I','Pande Mas Timur'=>'Pande Mas Timur','Pande Mas Barat'=>'Pande Mas Barat','Pande Besi I'=>'Pande Besi I','Pande Besi II'=>'Pande Besi II','Btn Kekalek'=>'Btn Kekalek','Karang Seme'=>'Karang Seme','Karang Seme II'=>'Karang Seme II','Mas Mutiara'=>'Mas Mutiara'),
        'Jempong Baru'=>array('Jempong Timur'=>'Jempong Timur','Jempong Barat'=>'Jempong Barat','Kodya Asri'=>'Kodya Asri','Geguntur'=>'Geguntur','Mataram Asri'=>'Mataram Asri','Batu Mediri'=>'Batu Mediri','Dasan Kolo'=>'Dasan Kolo','Pekandelan'=>'Pekandelan','Mapak Dasan'=>'Mapak Dasan','Mapak Belatung'=>'Mapak Belatung','Mapak Indah'=>'Mapak Indah'),
        'Ampenan Selatan'=>array('Tangsi'=>'Tangsi','Karang Panas'=>'Karang Panas','Gatep'=>'Gatep','Karang Buyuk'=>'Karang Buyuk'),
        'Banjar'=>array('Banjar.'=>'Banjar','Sintung'=>'Sintung','Selaparang'=>'Selaparang','Selaparang.'=>'Selaparang'),
        'Kekalek Jaya'=>array('Kekalek Kijang'=>'Kekalek Kijang','Kekalek Timur'=>'Kekalek Timur','Komp. Angkatan Laut'=>'Komp Angkatan Laut','Sembada Asri'=>'Sembada Asri','Kekalek Barat'=>'Kekalek Barat','Gerisak'=>'Gerisak','Kekalek Indah'=>'Kekalek Indah','Gerisak Aman'=>'Gerisak Aman'),
        'Tanjung Karang'=>array('Batu Dawa'=>'Batu Dawa','Batu Ringgit Utara'=>'Batu Ringgit Utara','Batu Ringgit Selatan'=>'Batu Ringgit Selatan','Bendega'=>'Bendega','Bangsal'=>'Bangsal','Sembalun'=>'Sembalun'),
        'Tanjung Karang Permai'=>array('Barito'=>'Barito','Batanghari'=>'Batanghari','Sejahtera'=>'Sejahtera','Asahan'=>'Asahan','Bagek Kembar'=>'Bagek Kembar'),
        'Pejeruk'=>array('Pejeruk Desa'=>'Pejeruk Desa','Pejeruk Abian'=>'Pejeruk Abian','Pejeruk Perluasan'=>'Pejeruk Perluasan','Pejeruk Sejahtera'=>'Pejeruk Sejahtera','Kebon Jeruk'=>'Kebon Jeruk','Kebon Jeruk Baru'=>'Kebon Jeruk Baru','Pejeruk Bangket'=>'Pejeruk Bangket','Kebon Bawak Barat'=>'Kebon Bawak Barat'),
        'Kebun Sari'=>array('Kebun Bawak Timur'=>'Kebun Bawak Timur','Karang Baru'=>'Karang Baru','Kebun Bawak Tengah'=>'Kebun Bawak Tengah','Dasan Sari'=>'Dasan Sari','Kebun Bawak Nurul Yaqin'=>'Kebun Bawak Nurul Yaqin'),
        'Pejarakan Karya'=>array('Pejarakan'=>'Pejarakan','Penan'=>'Penan','Moncok Karya I'=>'Moncok Karya I','Moncok Karya II'=>'Moncok Karya II','Moncok Telaga Emas'=>'Moncok Telaga Emas'),
        'Santong'=>array('Temposodo'=>'Temposodo','Sempakok'=>'Sempakok','Mekar Jati'=>'Mekar Jati','Cempaka'=>'Cempaka','Santong Timur'=>'Santong Timur','Mentari Timur'=>'Mentari Timur','Santong Barat'=>'Santong Barat','Subak Sepulu'=>'Subak Sepulu','Suka Damai'=>'Suka Damai','Waker'=>'Waker','Santong Asli'=>'Santong Asli','Gubuk Baru'=>'Gubuk Baru','Santong Tengah'=>'Santong Tengah','Mekar Sari.'=>'Mekar Sari'),
        'Sesait'=>array('Sumur Pande Tengah'=>'Sumur Pande Tengah','Sumur Pande Lauk'=>'Sumur Pande Lauk','Sumur Pande Daya'=>'Sumur Pande Daya','Bat Pawang'=>'Bat Pawang','Kebalon'=>'Kebalon','Lokok Are'=>'Lokok Are','Batu Jompang'=>'Batu Jompang','Pansor Tengah'=>'Pansor Tengah','Pansor Daya'=>'Pansor Daya','Sumur Jiri'=>'Sumur Jiri','Lokok Sutrang'=>'Lokok Sutrang','Tukak Bendu'=>'Tukak Bendu','Santong Mulia'=>'Santong Mulia','Mulagati'=>'Mulagati','Lokok'=>'Lokok','Oman Rot'=>'Oman Rot','Pedaleman'=>'Pedaleman','Sesait.'=>'Sesait','Pansor Lauk'=>'Pansor Lauk'),
        'Pendua'=>array('Lokok Senggol'=>'Lokok Senggol','Pendua Lauk'=>'Pendua Lauk','Pendua Daya'=>'Pendua Daya','Sentul'=>'Sentul','Lokok Bata'=>'Lokok Bata'),
        'Bentek'=>array('Goa'=>'Goa','Dasan Baro'=>'Dasan Baro','Dasan Bangket'=>'Dasan Bangket','Todo Lauk'=>'Todo Lauk','Todo Daya'=>'Todo Daya','Buani'=>'Buani','Orong Luk'=>'Orong Luk','Karang Lendang'=>'Karang Lendang','Lenek'=>'Lenek','Pasiran'=>'Pasiran','Baru'=>'Baru','Kakong'=>'Kakong','Serungga'=>'Serungga','Batu Ringgit'=>'Batu Ringgit','Selelos'=>'Selelos','Sengaran'=>'Sengaran'),
        'Gondang'=>array('Karang Kates'=>'Karang Kates','Lekok Utara'=>'Lekok Utara','Lekok Timur'=>'Lekok Timur','Lekok Selatan'=>'Lekok Selatan','Lekok Tenggara'=>'Lekok Tenggara','Karang Bedil'=>'Karang Bedil','Karang Amor'=>'Karang Amor','Karang Pendagi'=>'Karang Pendagi','Lokok Gitak'=>'Lokok Gitak','Karang Anyar'=>'Karang Anyar','Gondang Timur'=>'Gondang Timur','Jeliti'=>'Jeliti','Besari'=>'Besari'),
        'Genggelang'=>array('Papak II'=>'Papak II','Papak II.'=>'Papak II','Karang Krakas'=>'Karang Krakas','Karang Jurang'=>'Karang Jurang','Sembaro'=>'Sembaro','Lendagn Bagian'=>'Lendagn Bagian','Karang Kendal'=>'Karang Kendal','Kerurak'=>'Kerurak','Sankukun'=>'Sankukun','Bulan Semu'=>'Bulan Semu','Penjor'=>'Penjor','Ketaharja'=>'Ketaharja','Gitak Demung'=>'Gitak Demung','Gangga.'=>'Gangga','Senara'=>'Senara','Dasan Sambik'=>'Dasan Sambik','Lias'=>'Lias','Monggal Atas'=>'Monggal Atas','Monggal Bawah'=>'Monggal Bawah','Paok Rempek'=>'Paok Rempek','Tempos Kujur'=>'Tempos Kujur'),
        'Rempek'=>array('Lempenge'=>'Lempenge','Montong Pall'=>'Montong Pall','Jelitong'=>'Jelitong','Kuripan'=>'Kuripan','Telaga Maluku'=>'Telaga Maluku','Bat Koloh'=>'Bat Koloh','Atas Telabah'=>'Atas Telabah','Sejuik'=>'Sejuik','Gelumpung'=>'Gelumpung','Duria'=>'Duria','Rempek Barat'=>'Rempek Barat','Rempek Timur'=>'Rempek Timur','Palang'=>'Palang','Soloh Bawah'=>'Soloh Bawah','Soloh Atas'=>'Soloh Atas','Pancor Getah'=>'Pancor Getah','Pawang Busur'=>'Pawang Busur','Busur'=>'Busur','Tuan Ani'=>'Tuan Ani'),
        'Sambik Bangkol'=>array('Papanda Bawah'=>'Papanda Bawah','Sambik Bangkol.'=>'Sambik Bangkol','Oman Telaga'=>'Oman Telaga','Luk Barat'=>'Luk Barat','Luk Timur'=>'Luk Timur','Klongkong'=>'Klongkong','Jugil'=>'Jugil','Senjajak'=>'Senjajak','Kopong Sebangun'=>'Kopong Sebangun','Beririjarak'=>'Beririjarak','Papanda Atas'=>'Papanda Atas'),
        'Pemenang Barat'=>array('Karang Desa'=>'Karang Desa','Karang Subagan'=>'Karang Subagan','Karang Gelebek'=>'Karang Gelebek','Karang Pangsor'=>'Karang Pangsor','Telaga Wareng'=>'Telaga Wareng','Menggala'=>'Menggala','Kerujuk'=>'Kerujuk','Bentek.'=>'Bentek','Telok Ombal'=>'Telok Ombal','Sumur Mual'=>'Sumur Mual'),
        'Pemenang Timur'=>array('Karang Petak'=>'Karang Petak','Karang Montong Lauk'=>'Karang Montong Lauk','Karang Montong Daye'=>'Karang Montong Daye','Karang Baro'=>'Karang Baro','Karang Bedil.'=>'Karang Bedil','Tebango'=>'Tebango','Trengan Tanak Ampar'=>'Trengan Tanak Ampar','Trengan Lauk'=>'Trengan Lauk','Trengan Tengah'=>'Trengan Tengah','Trengan Daye'=>'Trengan Daye','Trengan Timur'=>'Trengan Timur','Koloh Tanjung'=>'Koloh Tanjung','Muara Putat'=>'Muara Putat','Karang Bangket'=>'Karang Bangket','Tebango Bolot'=>'Tebango Bolot'),
        'Lendang Belo'=>array('Peresak Barat'=>'Peresak Barat','Balik Batang Utara'=>'Balik Batang Utara','Balik Batang Selatan'=>'Balik Batang Selatan','Lendang Belo.'=>'Lendang Belo','Peresak Timur'=>'Peresak Timur'),
        'Lendang Nangka Utara'=>array('Jimse'=>'Jimse','Montong Sube'=>'Montong Sube','Gonjong Utara'=>'Gonjong Utara','Benteng Selatan 1'=>'Benteng Selatan 1','Benteng Selatan 2'=>'Benteng Selatan 2','Otak Pancor Utara'=>'Otak Pancor Utara','Loang Sawak'=>'Loang Sawak','Gawah Malang'=>'Gawah Malang','Benteng Utara'=>'Benteng Utara','Otak Pancor Selatan'=>'Otak Pancor Selatan','Kapitan'=>'Kapitan','Borok Lelet'=>'Borok Lelet','Masjid Bakek'=>'Masjid Bakek'),
        'Pringgabaya'=>array('Otak Desa.'=>'Otak Desa','Padamara'=>'Padamara','Tanak Renteng'=>'Tanak Renteng','Pekosong'=>'Pekosong','Belawong'=>'Belawong','Dasan Lendang.'=>'Dasan Lendang','Jejangka Daya'=>'Jejangka Daya','Bararuntak'=>'Bararuntak','Karang Kapitan'=>'Karang Kapitan','Seimbang'=>'Seimbang','Ketapang'=>'Ketapang','Jejangka Lauk'=>'Jejangka Lauk','Goge'=>'Goge','Embur'=>'Embur','Puncang Sari'=>'Puncang Sari'),
        'Sembalun'=>array('Mentagi'=>'Mentagi','Lendang Luar'=>'Lendang Luar'),
        'Sembalun Bumbung'=>array('Jorong Lama'=>'Jorong Lama','Jorong Baru'=>'Jorong Baru','Daya Rurung Baret'=>'Daya Rurung Baret','Bebante'=>'Bebante','Daya Rurung Timuk'=>'Daya Rurung Timuk','Lauk Rurung Baret'=>'Lauk Rurung Baret','Lauk Rurung Timuk'=>'Lauk Rurung Timuk','Batu Jalik'=>'Batu Jalik'),
        'Wanasaba'=>array('Beak Daya'=>'Beak Daya','Beak Lauk'=>'Beak Lauk','Baret Orong'=>'Baret Orong','Terutuk'=>'Terutuk','Jorong Daya'=>'Jorong Daya','Jorong Lauk'=>'Jorong Lauk'),
        'Mamben Daya'=>array('Gelumpang'=>'Gelumpang','Renga'=>'Renga','Gubuk Timuk 2'=>'Gubuk Timuk 2','Bagek Longgek Baret'=>'Bagek Longgek Baret','Gubuk Baret 2'=>'Gubuk Baret 2','Gubuk Baret 1'=>'Gubuk Baret 1','Gubuk Timuk 1'=>'Gubuk Timuk 1','Kalibening'=>'Kalibening','Dasan Rambak'=>'Dasan Rambak','Omba'=>'Omba','Bagek Longgek Timuk'=>'Bagek Longgek Timuk'),
        'Masbagik Utara Baru'=>array('Tanak Maik'=>'Tanak Maik','Nibas'=>'Nibas','Nibas II'=>'Nibas II','Paok Kambut'=>'Paok Kambut','Montong Dao'=>'Montong Dao','Karang Geres'=>'Karang Geres','Pancor Kopong'=>'Pancor Kopong'),
        'Jero Gunung'=>array('Repok Dese'=>'Repok Dese','Lingkok Mudung'=>'Lingkok Mudung','Embung Sayut'=>'Embung Sayut'),
        'Sukarara'=>array('Jeropoto'=>'Jeropoto','Dasan Repok'=>'Dasan Repok','Sukarara Utara'=>'Sukarara Utara','Sukarara Selatan'=>'Sukarara Selatan','Sukawangi'=>'Sukawangi','Asem'=>'Asem','Tangar'=>'Tangar'),
        'Timu'=>array('Dusun I'=>'Dusun I','Dusun II'=>'Dusun II','Dusun III'=>'Dusun III','Dusun IV'=>'Dusun IV','Dusun V'=>'Dusun V'),
        'Sondo'=>array('Sejahtera.'=>'Sejahtera','Beringin'=>'Beringin','Ntanda Ndeu'=>'Ntanda Ndeu','Palisondo'=>'Palisondo','Sebua Ade'=>'Sebua Ade'),
        'Kananga'=>array('Dusun 1'=>'Dusun 1','Dusun 2'=>'Dusun 2','Dusun 3'=>'Dusun 3','Dusun 4'=>'Dusun 4'),
        'Rato'=>array('Dorowila'=>'Dorowila','Tegal Sari'=>'Tegal Sari','Kotabaru'=>'Kotabaru','Rato.'=>'Rato','Saleko'=>'Saleko','Sigi 1'=>'Sigi 1','Sigi 2'=>'Sigi 2'),
        'Tambe'=>array('Dusun 1.'=>'Dusun 1','Dusun 2.'=>'Dusun 2','Dusun 3.'=>'Dusun 3','Dusun 4.'=>'Dusun 4','Dusun 5'=>'Dusun 5'),
        'Rasabou'=>array('Dusun 1..'=>'Dusun 1','Dusun 2..'=>'Dusun 2','Dusun 3..'=>'Dusun 3','Dusun 4..'=>'Dusun 4','Dusun 5.'=>'Dusun 5'),
        'Tente'=>array('Anggrek'=>'Anggrek','Sukamaju'=>'Sukamaju','Bante'=>'Bante','Kananga.'=>'Kananga'),
        'Donggobolo'=>array('Pali'=>'Pali','Sigi'=>'Sigi','Kenanga'=>'Kenanga','Cempaka.'=>'Cempaka'),
        'Keli'=>array('Rato..'=>'Rato','Sigi.'=>'Sigi','Mekar'=>'Mekar','Hodo'=>'Hodo'),
        'Dadibou'=>array('Minte'=>'Minte','Godo'=>'Godo','Dadibou.'=>'Dadibou'),
        'Pekat'=>array('Rw 08'=>'Rw 08','Rw 02'=>'Rw 02','Rw 03, Rw 04, Rw 05'=>'Rw 03, Rw 04, Rw 05','Rw 01, Rw 06, Rw 07'=>'Rw 01, Rw 06, Rw 07'),
        'Jorok'=>array('Jorok Dalam'=>'Jorok Dalam','Jorok Tengah'=>'Jorok Tengah','Jorok Luar'=>'Jorok Luar','Jorok Tengah.'=>'Jorok Tengah','Koda Luar'=>'Koda Luar','Koda Dalam'=>'Koda Dalam','Sekokok'=>'Sekokok'),
        'Motong'=>array('Motong Barat'=>'Motong Barat','Motong Tengah'=>'Motong Tengah','Motong Timur'=>'Motong Timur','Raja Borang'=>'Raja Borang','Perung'=>'Perung','Rapang'=>'Rapang'),
        'Brang Kolong'=>array('Kolong'=>'Kolong','Unter Lestari'=>'Unter Lestari'),
        'Labu Ala'=>array('Labu Ala.'=>'Labu Ala','Labuhan Ujung'=>'Labuhan Ujung'),
        'Suka Damai'=>array('Karang Anyar.'=>'Karang Anyar','Karang Agung'=>'Karang Agung','Karang Geluni'=>'Karang Geluni','Kembang Kuning'=>'Kembang Kuning','Karang Banjar'=>'Karang Banjar','Karang Tengah'=>'Karang Tengah'),
        'Karang Dima'=>array('Buin Pandan'=>'Buin Pandan','Bangkong'=>'Bangkong','Sumer Payung'=>'Sumer Payung','Pamulung'=>'Pamulung','Batu Nisung'=>'Batu Nisung','Tanjung Pengamas'=>'Tanjung Pengamas','Kayangan'=>'Kayangan'),
        'Usar Mapin'=>array('Hijrah'=>'Hijrah','Gelampar'=>'Gelampar','Hijrah Baru'=>'Hijrah Baru','Tamsi'=>'Tamsi'),
        'Juranalas'=>array('Juranalas.'=>'Juranalas','Tal'=>'Tal','Brang Bage'=>'Brang Bage','Penua'=>'Penua'),
        'Labuhan Kuris'=>array('Kuris'=>'Kuris',"Ai' Mual"=>'Ai Mual','Ketanga'=>'Ketanga','Labuhan Kuris.'=>'Labuhan Kuris','Ngali'=>'Ngali','Lab. Terata I'=>'Lab Terata I','Lab. Terata II'=>'Lab Terata II','Lab. Terata III'=>'Lab Terata III','Tanjung Bila'=>'Tanjung Bila','Batu Reneng'=>'Batu Reneng'),
        'Seteluk Atas'=>array('Seteluk Atas.'=>'Seteluk Atas','Mata Ai'=>'Mata Ai','Mata Ai.'=>'Mata Ai','Benteng'=>'Benteng'),
        'Seteluk Tengah'=>array('Seteluk Tengah.'=>'Seteluk Tengah','Jaro'=>'Jaro','Mandar'=>'Mandar','Mandar.'=>'Mandar','Selayar'=>'Selayar','Lala Jinis'=>'Lala Jinis','Pamongo'=>'Pamongo','Beda Rea'=>'Beda Rea','Beda Rea'=>'Beda Rea'),
        'Tapir'=>array('Mongal'=>'Mongal','Tapir Dalam'=>'Tapir Dalam','Tapir Luar'=>'Tapir Luar'),
        'Loka'=>array('Segunter'=>'Segunter','Umatuan'=>'Umatuan'),
        'Rempe'=>array('Rempe Beru & Kenangan'=>'Rempe Beru & Kenangan','Sampir'=>'Sampir'),
        'Seran'=>array('Lenang Datu'=>'Lenang Datu','Beru'=>'Beru'),
        'Air Suning'=>array('Air Suning.'=>'Air Suning','Batu Bintang'=>'Batu Bintang','Batu Bulan'=>'Batu Bulan'),
        'Lamusung'=>array('Lamusung.'=>'Lamusung','Lengkok'=>'Lengkok','Bugis'=>'Bugis'),
        'Meraran'=>array('Meraran.'=>'Meraran','Aina'=>'Aina','Batu Cermai'=>'Batu Cermai'),
        'Kelanir'=>array('Kelanir.'=>'Kelanir','Rigalu'=>'Rigalu','Sedong'=>'Sedong'),
        'Penatoi'=>array('Kalate 1'=>'Kalate 1','Btn Penatoi'=>'Btn Penatoi','Lewilanco I'=>'Lewilanco I','Lewilanco II'=>'Lewilanco II','Kalate II'=>'Kalate II','Apel'=>'Apel'),
        'Lewirato'=>array('Lewirato I'=>'Lewirato I','Lewirato II'=>'Lewirato II'),
        'Panggi'=>array('Panggi.'=>'Panggi'),
        'Sambinae'=>array('Sambinae I'=>'Sambinae I','Sambinae II'=>'Sambinae II'),
        'Manggemaci'=>array('Manggemaci.'=>'Manggemaci','Waki'=>'Waki','Bedi'=>'Bedi','Kamp. Samporo'=>'Kamp Samporo'),
        'Monggonao'=>array('Monggonao.'=>'Monggonao','Lewirowa'=>'Lewirowa','Aspol Gunung Dua'=>'Aspol Gunung Dua','Karara'=>'Karara','Btn Nusantara'=>'Btn Nusantara'),
        'Santi'=>array('Santi I'=>'Santi I','Btn Santi'=>'Btn Santi','Santi II Barat'=>'Santi II Barat','Santi II Melati'=>'Santi II Melati'),
        'Matakando'=>array('Tolotando'=>'Tolotando','Rabantala'=>'Rabantala','Soncolela'=>'Soncolela'),
        'Mande'=>array('Mande I'=>'Mande I','Mande II'=>'Mande II','Mande III'=>'Mande III','Al Muhajirin'=>'Al Muhajirin'),
        'Sadia'=>array('Sadia I'=>'Sadia I','Sadia II'=>'Sadia II','Btn Sadia'=>'Btn Sadia'),
        'Bara'=>array('Bara.'=>'Bara','Sipon'=>'Sipon','Lapas'=>'Lapas','Kebuntu'=>'Kebuntu','Dorolapa'=>'Dorolapa'),
        'Mumbu'=>array('Madamina'=>'Madamina','Mada Fanda'=>'Mada Fanda','Tonda'=>'Tonda','Embung'=>'Embung','Mumbu.'=>'Mumbu'),
        'Wawonduru'=>array('Bolonduru'=>'Bolonduru','Wawonduru Timur'=>'Wawonduru Timur','Wawonduru Barat & Rabatumpu'=>'Wawonduru Barat & Rabatumpu','Rato Baka'=>'Rato Baka'),
        'Simpasai'=>array('Simpasai Atas'=>'Simpasai Atas',' Simpasai Bawah'=>' Simpasai Bawah','Ncera'=>'Ncera','Larema'=>'Larema','Renda'=>'Renda','Lingkungan Bali Dua'=>'Lingkungan Bali Dua','Manggemaci..'=>'Manggemaci'),
        'Baka Jaya'=>array('Rasanae'=>'Rasanae','Bolo Baka'=>'Bolo Baka','Campa'=>'Campa','Woro Baka'=>'Woro Baka','Ama Maka'=>'Ama Maka'),
        'Katua'=>array('Katua.'=>'Katua','Lagara'=>'Lagara','Doro Kore'=>'Doro Kore'),
        'Mangge Nae'=>array('Mangge Nae.'=>'Mangge Nae','Sori Kuta'=>'Sori Kuta','Karaku'=>'Karaku'),
        'Mbawi'=>array('Ragi'=>'Ragi','Owo'=>'Owo','Mpungga'=>'Mpungga','Pelita'=>'Pelita','Mbawi.'=>'Mbawi','Palikarawe'=>'Palikarawe'),
        'Kareke'=>array('Sarae'=>'Sarae','Kareke Dan Rade Dao'=>'Kareke Dan Rade Dao','Pandai Dan Doro Ngguni'=>'Pandai Dan Doro Ngguni','Hijrah Dan Raba'=>'Hijrah Dan Raba'),
        'Dorebara'=>array('Desa Potu Dua'=>'Desa Potu Dua','Dorebara Utara'=>'Dorebara Utara','Dorebara Selatan'=>'Dorebara Selatan','Wera'=>'Wera','Mada Oi Umbu'=>'Mada Oi Umbu'),
        'Santong'=>array('Temposodo'=>'Temposodo','Sempakok'=>'Sempakok','Cempaka'=>'Cempaka','Santong Timur'=>'Santong Timur','Santong Barat'=>'Santong Barat','Subak Pepulu'=>'Subak Pepulu','Suka Damai'=>'Suka Damai','Waker'=>'Waker','Santong Asli'=>'Santong Asli','Gubuk Baru'=>'Gubuk Baru','Santong Tengah'=>'Santong Tengah','Mekar Sari'=>'Mekar Sari'),
        'Sesait'=>array('Sumur Pande Tengah'=>'Sumur Pande Tengah','Sumur Pande Lauk'=>'Sumur Pande Lauk','Sumur Pande Daya'=>'Sumur Pande Daya','Bat Pawang'=>'Bat Pawang','Kebalon'=>'Kebalon','Lokok Are'=>'Lokok Are','Batu Jompang'=>'Batu Jompang','Pansor Tengah'=>'Pansor Tengah','Pansor Daya'=>'Pansor Daya','Sumur Jiri'=>'Sumur Jiri','Lk Strang'=>'Lk Strang','Tk Benak'=>'Tk Benak','Santong Mulia'=>'Santong Mulia','Oman Rot'=>'Oman Rot','Sesait'=>'Sesait','Pansor Lauk'=>'Pansor Lauk'),
        'Pendua'=>array('Lokok Senggol'=>'Lokok Senggol','Lokok Bata'=>'Lokok Bata','Pendua Lauk'=>'Pendua Lauk','Pendua Daya'=>'Pendua Daya','Sentul'=>'Sentul'),
        'Bentek'=>array('Goa'=>'Goa','Dasan Baro'=>'Dasan Baro','Dasan Bangket'=>'Dasan Bangket','Todo Lauk'=>'Todo Lauk','Todo Daya'=>'Todo Daya','Buani'=>'Buani','Orong Luk'=>'Orong Luk','Karang Lendang'=>'Karang Lendang','Lenek'=>'Lenek','Pasiran'=>'Pasiran','Baru'=>'Baru','Kakong'=>'Kakong','Serungga'=>'Serungga','Batu Ringgit'=>'Batu Ringgit','Selelos'=>'Selelos','Sengaran'=>'Sengaran'),
        'Gondang'=>array('Karang Kates'=>'Karang Kates','Lekok Utara'=>'Lekok Utara','Lekok Timur'=>'Lekok Timur','Lekok Selatan'=>'Lekok Selatan','Lekok Tenggara'=>'Lekok Tenggara','Karang Bedil'=>'Karang Bedil','Karang Amor'=>'Karang Amor','Karang Pendag'=>'Karang Pendagi','Lokok Gitak'=>'Lokok Gitak','Karang Anyar'=>'Karang Anyar','Gondang Timur'=>'Gondang Timur','Jeliti'=>'Jeliti','Besari'=>'Besari'),
        'Genggelang'=>array('Papak I'=>'Papak I','Papak II'=>'Papak II','Karang Krakas'=>'Karang Krakas','Karang Jurang'=>'Karang Jurang','Sembaro'=>'Sembaro','Lendang Bagian'=>'Lendang Bagian','Karang Kendal'=>'Karang Kendal','Kerurak'=>'Kerurak','Sankukun'=>'Sankukun','Bulan Semu'=>'Bulan Semu','Penjor'=>'Penjor','Kertaraharja'=>'Kertaraharja','Gitak Demung'=>'Gitak Demung','Gangga'=>'Gangga','Senara'=>'Senara','Dasan Sambik'=>'Dasan Sambik','Lias'=>'Lias','Monggal Atas'=>'Monggal Atas','Monggal Bawah'=>'Monggal Bawah','Paok Rempek'=>'Paok Rempek','Tempos Kujur'=>'Tempos Kujur'),
        'Rempek'=>array('Lempenge'=>'Lempenge','Montong Pall'=>'Montong Pall','Jelitong'=>'Jelitong','Kuripan'=>'Kuripan','Telaga Maluku'=>'Telaga Maluku','Bat Koloh'=>'Bat Koloh','Atas Telabah'=>'Atas Telabah','Sejuik'=>'Sejuik','Gelumpang'=>'Gelumpang','Duria'=>'Duria','Rempek Barat'=>'Rempek Barat','Rempek Timur'=>'Rempek Timur','Soloh Bawah'=>'Soloh Bawah','Soloh Atas'=>'Soloh Atas','Pancor Getah'=>'Pancor Getah','Pawang Busur'=>'Pawang Busur','Busur'=>'Busur','Tuan Ani'=>'Tuan Ani'),
        'Sambik Bangkol'=>array('Papanda Bawah'=>'Papanda Bawah','Sambik Bangkol'=>'Sambik Bangkol','Oman Telaga'=>'Oman Telaga','Luk Barat'=>'Luk Barat','Luk Timur'=>'Luk Timur','Klongkong'=>'Klongkong','Jugil'=>'Jugil','Senjajak'=>'Senjajak','Kopong Sebangun'=>'Kopong Sebangun','Beririjarak'=>'Beririjarak','Papanda Atas'=>'Papanda Atas'),
        'Pemenang Barat'=>array('Karang Desa'=>'Karang Desa','Karang Subagan'=>'Karang Subagan','Karang Gelebek'=>'Karang Gelebek','Karang Pangsor'=>'Karang Pangsor','Telaga Wareng'=>'Telaga Wareng','Menggala'=>'Menggala','Krujuk'=>'Krujuk','Bentek'=>'Bentek','Telok Kombal'=>'Telok Kombal','Sumur Mual'=>'Sumur Mual'),
        'Pemenang Timur'=>array('Karang Petak'=>'Karang Petak','Karang Montong Lauk'=>'Karang Montong Lauk','Karang Montong Daye'=>'Karang Montong Daye','Karang Baro'=>'Karang Baro','Karang Bedil'=>'Karang Bedil','Tebango'=>'Tebango','Tr Tanak Ampar'=>'Tr Tanak Ampar','Tr Lauk'=>'Tr Lauk','Tr Tengah'=>'Tr Tengah','Tr Daye'=>'Tr Daye','Tr Timur'=>'Tr Timur','Koloh Tanjung'=>'Koloh Tanjung','Muara Putat'=>'Muara Putat','Karang Bangket'=>'Karang Bangket','Tebango Bolot'=>'Tebango Bolot'),
        'Pandan Indah'=>array('Aik kerit'=>'Aik kerit','Bolor gejek'=>'Bolor gejek','kelambi 1'=>'kelambi 1','kelambi 2'=>'kelambi 2','Kreak'=>'Kreak','Mangkoneng'=>'Mangkoneng','Nangker'=>'Nangker','Panggongan'=>'Panggongan','Rege'=>'Rege','Sukalalem'=>'Sukalalem'),
        'Serage'=>array('Beberik'=>'Beberik','Belenje'=>'Belenje','Bt. salang'=>'Bt salang','Lekong jae'=>'Lekong jae','Mapasan'=>'Mapasan','Rurut'=>'Rurut','Semaye'=>'Semaye','Sulung'=>'Sulung'),
        'Teduh'=>array('Jati'=>'Jati','Montong putik'=>'Montong putik','Pengengat'=>'Pengengat','Pengolah'=>'Pengolah','Teduh.'=>'Teduh','Teduh'=>'Teduh'),
        'Gerantung'=>array('Bual 2'=>'Bual 2','Bual.'=>'Bual','Bual'=>'Bual','Gerantung.'=>'Gerantung','Gerantung'=>'Gerantung','Guntur'=>'Guntur','Juring'=>'Juring','Lingkok Kudung'=>'Lingkok Kudung'),
        'Jurang Jaler'=>array('Berembeng'=>'Berembeng','Jurang Jaler.'=>'Jurang Jaler','Jurang Jaler'=>'Jurang Jaler','Lingkok Eyat'=>'Lingkok Eyat','Mapong'=>'Mapong','Mertak Men'=>'Mertak Men','Pinggal Bedok'=>'Pinggal Bedok','Prai Gunung'=>'Prai Gunung'),
        'Pengadang'=>array('Banar'=>'Banar','Banar2'=>'Banar2','Bikan Pait'=>'Bikan Pait','Bun Datu'=>'Bun Datu','Bunut Bireng'=>'Bunut Bireng','Embur Teres'=>'Embur Teres','LD. Kunyit 1'=>'LD Kunyit 1','LD. Kunyit 2'=>'LD Kunyit 2','MT. Tanggak'=>'MT Tanggak','MT. Tanggak Selatan'=>'MT Tanggak Selatan','Pengadang Selatan'=>'Pengadang Selatan','Pengadang Utara'=>'Pengadang Utara','Prentek'=>'Prentek','Rangah'=>'Rangah','Regak'=>'Regak','Sorong'=>'Sorong','Sundawe'=>'Sundawe','Tambun'=>'Tambun'),
        'Aik Bual'=>array('Bare Eleh'=>'Bare Eleh','Bual'=>'Bual','Nyeredep'=>'Nyeredet','Nyeredet'=>'Nyeredet','Pertanian'=>'Pertanian','Rabuli'=>'Rabuli','Ramus'=>'Ramus','Ramuw'=>'Ramus','Talun Ambon'=>'Talon Ambon'),
        'Kopang Rembiga'=>array('Bajur'=>'Bajur','Barat Masjid'=>'Barat Masjid','Bebak'=>'Bebak','Bhineka'=>'Bhineka','Bore'=>'Bore','BTN Jelojok'=>'BTN Jelojok','Gubuk'=>'Gubuk','Gubuk Alang'=>'Gubuk Alang','Gunung Malang'=>'Gunung Malang','Jontak'=>'Jontak','Kayun'=>'Kayun','Kopang 1'=>'Kopang 1','Lendang Lok'=>'Lendang Lok','Lingkung'=>'Lingkung','Mentinggo'=>'Mentinggo','Ngorok'=>'Ngorok','Pendagi'=>'Pendagi','Pengkores'=>'Pengkores','Puyung.'=>'Puyung','Puyung'=>'Puyung','Renggung'=>'Renggung'),
        'Montong Gamang'=>array('Binkok'=>'Binkok','Dasan tinggi'=>'Dasan tinggi','Embung Karung 1'=>'Embung Karung 1','Embung Karung 2'=>'Embung Karung 2','Embung Karung 3'=>'Embung Karung 3','Gonjong.'=>'Gonjong','Gonjong'=>'Gonjong','Karang Tengak'=>'Karang Tengak','Montong Bulok'=>'Montong Bulok','Montong Gamang 1'=>'Montong Gamang 1','Montong Gamang 2'=>'Montong Gamang 2','Montong Gamang 3'=>'Montong Gamang 3','Montong Tanger'=>'Montong Tanger','Mumbang 1'=>'Mumbang 1','Mumbang 2'=>'Mumbang 2','Mumbang 3'=>'Mumbang 3','Nyanggi'=>'Nyanggi','Penimpah'=>'Penimpah'),
        'Barabali'=>array('Barabali 1'=>'Barabali 1','Barabali 2'=>'Barabali 2','Celegeh'=>'Celegeh','Dasan Baru'=>'Dasan Baru','Gwh. Lendang Terong'=>'Gwh Lendang Terong','Kebon Nyiur'=>'Kebon Nyiur','Kelanjuh Lk'=>'Kelanjuh Lk','Ld. Dode'=>'Ld Dode','Ld. Re'=>'Ld Re','Ld. Terong Daye'=>'Ld Terong Daye','Lk. Kudung'=>'Lk Kudung','Muhajirin h'=>'Muhajirin h','Pondok Pande'=>'Pondok Pande','Prako'=>'Prako','Presak..'=>'Presak','Presak'=>'Presak','Sade'=>'Sade','Surebaye Bat'=>'Surebaye Bat','Surebaye Daye'=>'Surebaye Daye','Surebaye Lauq'=>'Surebaye Lauq','Tojak'=>'Tojak'),
        'Mantang'=>array('Alun-alun'=>'Alun-alun','Banjar Metu'=>'Banjar Metu','Ceret'=>'Ceret','Gb. Gunung'=>'Gb Gunung','Jantuk'=>'Jantuk','Kabar'=>'Kabar','Kelanjuh Daye'=>'Kelanjuh Daye','Keren'=>'Keren','Mantang I'=>'Mantang I','Otak Desa'=>'Otak Desa','Pedaleman'=>'Pedaleman','Pengadok'=>'Pengadok','Raju Mas'=>'Raju Mas','Riris'=>'Riris','Seganteng'=>'Seganteng','Tampeng'=>'Tampeng','Tenten'=>'Tenten','Tj. Bereng B'=>'Tj Bereng B','Tj. Bereng T'=>'Tj Bereng T','Tundung'=>'Tundung'),
        'Presak'=>array('Aik Gering'=>'Aik Gering','Batu Lajan'=>'Batu Lajan','Boak'=>'Boak','Bujak Daye'=>'Bujak Daye','Ds. Aman'=>'Ds Aman','Dumpu'=>'Dumpu','Pajangan'=>'Pajangan','Penyengak'=>'Penyengak','Presak Daye'=>'Presak Daye','Presak Lauk'=>'Presak Lauk','Presak Tengak'=>'Presak Tengak','Sandik'=>'Sandik','Selojan'=>'Selojan','Subahnale I'=>'Subahnale I','Subahnale II'=>'Subahnale II'),
        'Tampak Siring'=>array('Antak-Antak'=>'Antak-Antak','Batu Meta'=>'Batu Meta','Beneng'=>'Beneng','Dsn. Baru'=>'Dsn Baru','Gbk. Blimbing'=>'Gbk Blimbing','Jadot'=>'Jadot','Jeranjang'=>'Jeranjang','Ld. Kekah'=>'Ld Kekah','Lk. Petelahan'=>'Lk Petelahan','Pedadan'=>'Pedadan','Sanggok'=>'Sanggok'),
        'Mujur'=>array('Berenyok'=>'Berenyok','Budiwathon'=>'Budiwathon','Bunut Baok'=>'Bunut Baok','Gawah Malang'=>'Gawah Malang','Kebun Alit'=>'Kebun Alit','Kolak'=>'Kolak','Kudung Are'=>'Kudung Are','Lokon'=>'Lokon','Montong Inggu'=>'Montong Inggu','Mungkik'=>'Mungkik','Orok-orok'=>'Orok-orok','Pendem.'=>'Pendem','Pendem'=>'Pendem','Pengendong'=>'Pengendong','Perluasan'=>'Perluasan','Santong.'=>'Santong','Santong'=>'Santong','Sebolet'=>'Sebolet','Senayan'=>'Senayan','Serasap'=>'Serasap','Tanak Beak'=>'Tanak Beak','Tembuku'=>'Tembuku'),
        'Sukaraja'=>array('Bengkang'=>'Bengkang','Karang katon'=>'Karang katon','Kebun pelangeh'=>'Kebun pelangeh','Kudung paok'=>'Kudung paok','Lengkah'=>'Lengkah','Mircod'=>'Mircod','Montong bile.'=>'Montong bile','Montong bile'=>'Montong bile','Rajak'=>'Rajak','Selandung'=>'Selandung','Songkok'=>'Songkok'),
        'Dasan Ketujur'=>array('Bangket tengak'=>'Bangket tengak','Dasan ketujur'=>'Dasan ketujur','Gubuk Punik'=>'Gubuk Punik','Krembeng'=>'Krembeng','Lingkung daye'=>'Lingkung daye','Lingkung Lauk'=>'Lingkung Lauk','Merek'=>'Merek','Mosok'=>'Mosok','Otak dese'=>'Otak dese','Pedalaman'=>'Pedalaman','Sengkolit'=>'Sengkolit','Singosari'=>'Singosari','Sumpak bat'=>'Sumpak bat','Sumpak timuk'=>'Sumpak timuk','Taman daye'=>'Taman daye','Waker'=>'Waker'),
        'Gemel'=>array('Bilemantik'=>'Bilemantik','Bunceman'=>'Bunceman','Bunprie'=>'Bunprie','Bunsibah'=>'Bunsibah','Gemel.'=>'Gemel','Gemel'=>'Gemel','Kebun tengak'=>'Kebun tengak','Merobok'=>'Merobok','Mtg. Kecial'=>'Mtg Kecial'),
        'Batu Tulis'=>array('Bangket Gawah'=>'Bangket Gawah','Batutulis'=>'Batu Tulis','Batu tulis.'=>'Batu Tulis','Batu Tulis.'=>'Batu Tulis','Batu Tulis'=>'Batu Tulis','Bunrungkang'=>'Bon Rungkang','Bon Rungkang / Bonje'=>'Bon Rungkang','Bon Rungkang'=>'Bon Rungkang','Bonje'=>'Bonje','Bunje'=>'Bonje','Gontoran'=>'Gontoran','Jereneng'=>'Jereneng'),
        'Labulia'=>array('Batu Tinggang'=>'Batu Tinggang','Bonduduk'=>'Bonduduk','Dasan Sebeleq'=>'Dasan Sebeleq','Enjak'=>'Enjak','Labulia Desa'=>'Labulia Desa','Dasan Tuan'=>'Dasan Tuan','Labulia Lauk'=>'Labulia Lauk','Labulia Daye'=>'Labulia Daye','Olor Agung'=>'Olor Agung','Sulin'=>'Sulin','Wareng Kandel'=>'Wareng Kandel','Tandek Daye'=>'Tandek Daye','Tandek Lauk'=>'Tandek Lauk','Pengempokan'=>'Pengempokan','Tober'=>'Tober'),
        'Ubung'=>array('Aik Are'=>'Aik Are','Bagek Nunggal'=>'Bagek Nunggal','Batrate'=>'Batrate','Batu Karang'=>'Batu Karang','Bejelo'=>'Bejelo','Bile Kere'=>'Bile Kere','Dasan Baru.'=>'Dasan Baru','Dasan Baru'=>'Dasan Baru','Keraning'=>'Keraning','Pelowok'=>'Pelowok','Pemangket'=>'Pemangket','Punimbe'=>'Punimbe','Punjambong'=>'Punjambong','Tohpati'=>'Tohpati','Ubung 1'=>'Ubung 1')
    ];
    
    public function getAllLoc($fhw){
        return $this->loc[$fhw];
    }
    
    public function getAllLocSpv($fhw,$kec){
        return [$kec=>$this->loc[$fhw][$kec]];
    }
    
    public function getLocId($kec){
        //$kec = str_replace('%20',' ',$kec);
        return $this->loc_id[$kec];
    }
    
    public function getIntLocId($fhw){
        return $this->int_loc_id[$fhw];
    }
    
    public function getLocIdQuery($locId){
        $location = '';
        foreach ($locId as $loc=>$id){
            $location .= "locationId LIKE '%$loc%'";
            if($loc!=  end($locId)) $location .= " OR ";
        }
        return $location;
    }
    
    public function getLocIdAndDesabyDesa($desa){
        foreach ($this->loc_id as $kec=>$desas){
            if($ret = array_search($desa, $desas)) return [$ret=>$desa];
        }
    }
    
    public function getLocIdbyDesa($desa){
        foreach ($this->loc_id as $kec=>$desas){
            if($ret = array_search($desa, $desas)) return $ret;
        }
    }
    
    public function getDesa($fhw,$kec){
        return $this->loc[$fhw][$kec];
    }
    
    public function getKecUsers($fhw,$kec){
        $users = [];
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            array_push($users, $user);
        }
        return $users;
    }
    
    public function getKecFromDesa($namadesa){
        $namadesa = str_replace('%20',' ',$namadesa);
        foreach ($this->loc['bidan'] as $kec=>$loc){
            if(array_search($namadesa,$loc)){
                return $kec;
            }
        }
    }
    
    public function getKecFromUser($fhw,$userid){
        foreach ($this->loc[$fhw] as $kec=>$loc){
            if(array_key_exists($userid, $loc)){
                return $kec;
            }
        }
    }

    public function getDesaFromDusun($dusun){
        foreach ($this->dusun_typo as $desa=>$dusun_list){
            if(array_search($dusun,$dusun_list)){
                return $desa;
            }
        }
    }
    
    public function getUserFromDusun($fhw,$dusun){
        $desa = $this->getDesaFromDusun($dusun);
        foreach ($this->loc[$fhw] as $kec=>$desa_list){
            if($user = array_search($desa,$desa_list)){
                return $user;
            }
        }
    }
    
    public function getKecFromDusun($fhw,$dusun){
        return $this->getKecFromDesa($this->getDesaFromDusun($dusun));
    }

    public function getDesaUser($fhw,$kec,$desa){
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            if($loc==$desa) return $user;
        }
    }
    
    
    
    public function getDesaFromUser($fhw,$kec,$userid){
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            if($user==$userid) return $loc;
        }
    }
    
    public function getDusun($desa){
        return $this->dusun[$desa];
    }
    
    public function getDusunTypo($desa){
        return $this->dusun_typo[$desa];
    }
}