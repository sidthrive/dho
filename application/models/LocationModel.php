<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $loc = [
        "bidan"=>array(
            "Kota Mataram"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Barat"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Tengah"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Timur"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Utara"=>array('user1'=>'Santong','user2'=>'Sesait','user3'=>'Pendua','user4'=>'Bentek','user5'=>'Gondang','user6'=>'Genggelang','user7'=>'Rempek','user8'=>'Sambik Bangkol','user9'=>'Pemenang Barat','user10'=>'Pemenang Timur'),
            "Kabupaten Sumbawa"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Sumbawa Barat"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Bima"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kota Bima"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Dompu"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'')),
        "sdidtk"=>array(
            "Kota Mataram"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Barat"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Tengah"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Timur"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Lombok Utara"=>array('user1'=>'Santong','user2'=>'Sesait','user3'=>'Pendua','user4'=>'Bentek','user5'=>'Gondang','user6'=>'Genggelang','user7'=>'Rempek','user8'=>'Sambik Bangkol','user9'=>'Pemenang Barat','user10'=>'Pemenang Timur'),
            "Kabupaten Sumbawa"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Sumbawa Barat"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Bima"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kota Bima"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''),
            "Kabupaten Dompu"=>array('user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>'','user'=>''))
        ];
    
    private $loc_id = [
            "Kota Mataram"=>array(),
            "Kabupaten Lombok Barat"=>array(),
            "Kabupaten Lombok Tengah"=>array(),
            "Kabupaten Lombok Timur"=>array(),
            "Kabupaten Lombok Utara"=>array('Santong'=>'Santong','Sesait'=>'Sesait','Pendua'=>'Pendua','Bentek'=>'Bentek','Gondang'=>'Gondang','Genggelang'=>'Genggelang','Rempek'=>'Rempek','Sambik Bangkol'=>'Sambik Bangkol','Pemenang Barat'=>'Pemenang Barat','Pemenang Timur'=>'Pemenang Timur'),
            "Kabupaten Sumbawa"=>array(),
            "Kabupaten Sumbawa Barat"=>array(),
            "Kabupaten Bima"=>array(),
            "Kota Bima"=>array(),
            "Kabupaten Dompu"=>array()
        ];
    
    private $int_loc_id = [
            "bidan"=>array('Serage'=>'Serage','Teduh'=>'Teduh','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Mantang.'=>'Mantang','Presak.'=>'Presak','Gemel'=>'Gemel','Batu Tulis'=>'Batu Tulis','Labulia'=>'Labulia'),
            "sdidtk"=>array('Serage'=>'Serage','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Presak.'=>'Presak','Batu Tulis'=>'Batu Tulis')
        ];
    
    private $dusun = [
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