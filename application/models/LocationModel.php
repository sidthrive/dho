<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $loc = [
        "bidan"=>array(
            "Darek"=>array('user1'=>'Pandan Indah','user2'=>'Serage','user3'=>'Teduh'),
            "Pengadang"=>array('user1'=>'Gerantung','user2'=>'Jurang Jaler','user3'=>'Pengadang'),
            "Kopang"=>array('user21'=>'Aik Bual','user2'=>'Kopang Rembiga','user3'=>'Montong Gamang'),
            "Mantang"=>array('user1'=>'Barabali','user2'=>'Mantang','user3'=>'Presak','user4'=>'Tampak Siring'),
            "Mujur  "=>array('user1'=>'Mujur','user2'=>'Sukaraja'),
            "Puyung"=>array('user1'=>'Dasan Ketujur','user2'=>'Gemel'),
            "Ubung"=>array('user20'=>'Batu Tulis','user2'=>'Labulia','user3'=>'Ubung')),
        "vaksinator"=>array(
            "Darek"=>array('vaksin1'=>'Pandan Indah','vaksin2'=>'Serage','vaksin3'=>'Teduh'),
            "Pengadang"=>array('vaksin1'=>'Gerantung','vaksin2'=>'Jurang Jaler','vaksin3'=>'Pengadang'),
            "Kopang"=>array('vaksin21'=>'Aik Bual','vaksin2'=>'Kopang Rembiga','vaksin3'=>'Montong Gamang'),
            "Mantang"=>array('vaksin1'=>'Barabali','vaksin2'=>'Mantang','vaksin3'=>'Presak','vaksin4'=>'Tampak Siring'),
            "Mujur  "=>array('vaksin1'=>'Mujur','vaksin2'=>'Sukaraja'),
            "Puyung"=>array('vaksin1'=>'Dasan Ketujur','vaksin2'=>'Gemel'),
            "Ubung"=>array('vaksin20'=>'Batu Tulis','vaksin2'=>'Labulia','vaksin3'=>'Ubung')),
        "gizi"=>array(
            "Darek"=>array('gizi1'=>'Pandan Indah','gizi2'=>'Serage','gizi3'=>'Teduh'),
            "Pengadang"=>array('gizi1'=>'Gerantung','gizi2'=>'Jurang Jaler','gizi3'=>'Pengadang'),
            "Kopang"=>array('gizi21'=>'Aik Bual','gizi2'=>'Kopang Rembiga','gizi3'=>'Montong Gamang'),
            "Mantang"=>array('gizi1'=>'Barabali','gizi2'=>'Mantang','gizi3'=>'Presak','gizi4'=>'Tampak Siring'),
            "Mujur  "=>array('gizi1'=>'Mujur','gizi2'=>'Sukaraja'),
            "Puyung"=>array('gizi1'=>'Dasan Ketujur','gizi2'=>'Gemel'),
            "Ubung"=>array('gizi20'=>'Batu Tulis','gizi2'=>'Labulia','gizi3'=>'Ubung'))
        ];
    
    private $dusun = [
        'Pandan Indah'=>array(1=>'Aik kerit','Bolor gejek','kelambi 1','kelambi 2','Kreak','Mangkoneng','Nangker','Panggongan','Rege','Sukalalem'),
        'Serage'=>array(1=>'Beberik','Belenje','Bt. salang','Lekong jae','Mapasan','Rurut','Semaye','Sulung'),
        'Teduh'=>array(1=>'Jati','Montong putik','Pengengat','Pengolah','Teduh.'),
        'Gerantung'=>array(1=>'Bual 2','Bual2.','Gerantung.','Guntur','Juring','Lingkok Kudung'),
        'Jurang Jaler'=>array(1=>'Berembeng','Jurang Jaler.','Lingkok Eyat','Mapong','Mertak Men','Pinggal Bedok','Prai Gunung'),
        'Pengadang'=>array(1=>'Banar','Banar2','Bikan Pait','Bun Datu','Bunut Bireng','Embur Teres','LD. Kunyit 1','LD. Kunyit 2','MT. Tanggak','MT. Tanggak Selatan','Pengadang Selatan','Pengadang Utara','Prentek','Rangah','Regak','Sorong','Sundawe','Tambun'),
        'Aik Bual'=>array(1=>'Bare Eleh','Bual','Nyeredet','Pertanian','Rabuli','Ramus','Talon Ambon'),
        'Kopang Rembiga'=>array(1=>'Bajur','Barat Masjid','Bebak','Bhineka','Bore','BTN Jelojok','Gubuk','Gubuk Alang','Gunung Malang','Jontak','Kayun','Kopang 1','Lendang Lok','Lingkung','Mentinggo','Ngorok','Pendagi',' engkores','Puyung.','Renggung'),
        'Montong Gamang'=>array(1=>'Binkok','Dasan tinggi','Embung Karung 1','Embung Karung 2','Embung Karung 3','Gonjong.','Karang Tengak','Montong Bulok','Montong Gamang 1','Montong Gamang 2','Montong Gamang 3','Montong Tanger','Mumbang','Nyanggi','Penimpah'),
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
        'Pandan Indah'=>array('Aik kerit','Bolor gejek','kelambi 1','kelambi 2','Kreak','Mangkoneng','Nangker','Panggongan','Rege','Sukalalem'),
        'Serage'=>array('Beberik','Belenje','Bt. salang','Lekong jae','Mapasan','Rurut','Semaye','Sulung'),
        'Teduh'=>array('Jati','Montong putik','Pengengat','Pengolah','Teduh.'),
        'Gerantung'=>array('Bual 2','Bual2.','Gerantung.','Guntur','Juring','Lingkok Kudung'),
        'Jurang Jaler'=>array('Berembeng','Jurang Jaler.','Lingkok Eyat','Mapong','Mertak Men','Pinggal Bedok','Prai Gunung'),
        'Pengadang'=>array('Banar','Banar2','Bikan Pait','Bun Datu','Bunut Bireng','Embur Teres','LD. Kunyit 1','LD. Kunyit 2','MT. Tanggak','MT. Tanggak Selatan','Pengadang Selatan','Pengadang Utara','Prentek','Rangah','Regak','Sorong','Sundawe','Tambun'),
        'Aik Bual'=>array('Bare Eleh'=>'Bare Eleh','Bual'=>'Bual','Nyeredep'=>'Nyeredet','Nyeredet'=>'Nyeredet','Pertanian'=>'Pertanian','Rabuli'=>'Rabuli','Ramus'=>'Ramus','Ramuw'=>'Ramus','Talun Ambon'=>'Talon Ambon','Lainnya'=>'Lainnya'),
        'Kopang Rembiga'=>array('Bajur','Barat Masjid','Bebak','Bhineka','Bore','BTN Jelojok','Gubuk','Gubuk Alang','Gunung Malang','Jontak','Kayun','Kopang 1','Lendang Lok','Lingkung','Mentinggo','Ngorok','Pendagi',' engkores','Puyung.','Renggung'),
        'Montong Gamang'=>array('Binkok','Dasan tinggi','Embung Karung 1','Embung Karung 2','Embung Karung 3','Gonjong.','Karang Tengak','Montong Bulok','Montong Gamang 1','Montong Gamang 2','Montong Gamang 3','Montong Tanger','Mumbang','Nyanggi','Penimpah'),
        'Barabali'=>array('Barabali 1','Barabali 2','Celegeh','Dasan Baru','Gwh. Lendang Terong','Kebon Nyiur','Kelanjuh Lk','Ld. Dode','Ld. Re','Ld. Terong Daye','Lk. Kudung','Muhajirin h','Pondok Pande','Prako','Presak..','Sade','Surebaye Bat','Surebaye Daye','Surebaye Lauq','Tojak'),
        'Mantang'=>array('Alun-alun','Banjar Metu','Ceret','Gb. Gunung','Jantuk','Kabar','Kelanjuh Daye','Keren','Mantang I','Otak Desa','Pengadok','Raju Mas','Riris','Seganteng','Tampeng','Tenten','Tj. Bereng B','Tj. Bereng T','Tundung'),
        'Presak'=>array('Aik Gering','Batu Lajan','Boak','Bujak Daye','Ds. Aman','Dumpu','Pajangan','Penyengak','Presak Daye','Presak Lauk','Presak Tengak','Sandik','Selojan','Subahnale I','Subahnale II'),
        'Tampak Siring'=>array('Antak-Antak','Batu Meta','Beneng','Dsn. Baru','Gbk. Blimbing','Jadot','Jeranjang','Ld. Kekah','Lk. Petelahan','Pedadan','Sanggok'),
        'Mujur'=>array('Berenyok','Budiwathon','Bunut Baok','Gawah Malang','Kebun Alit','Kolak','Kudung Are','Lokon','Montong Inggu','Mungkik','Orok-orok','Pendem.','Pengendong','Perluasan','Santong.','Sebolet','Senayan','Serasap','Tanak Beak','Tembuku'),
        'Sukaraja'=>array('Bengkang','Karang katon','Kebun pelangeh','Kudung paok','Lengkah','Mircod','Montong bile.','Rajak','Selandung','Songkok'),
        'Dasan Ketujur'=>array(' Bangket tengak',' Dasan ketujur',' Gubuk Punik',' Krembeng',' Lingkung daye',' Lingkung Lauk',' Merek',' Mosok',' Otak dese',' Pedalaman',' Sengkolit',' Singosari',' Sumpak bat',' Sumpak timuk',' Taman daye',' Waker'),
        'Gemel'=>array('Bilemantik','Bunceman','Bunprie','Bunsibah','Gemel.','Kebun tengak','Merobok','Mtg. Kecial'),
        'Batu Tulis'=>array('Bangket Gawah'=>'Bangket Gawah','Batutulis'=>'Batu Tulis','Batu Tulis.'=>'Batu Tulis','Batu Tulis'=>'Batu Tulis','Bunrungkang'=>'Bon Rungkang','Bon Rungkang'=>'Bon Rungkang','Bonje'=>'Bonje','Bunje'=>'Bonje','Gontoran'=>'Gontoran','Jereneng'=>'Jereneng','Lainnya'=>'Lainnya'),
        'Labulia'=>array('Batu Tinggang','Bonduduk','Dasan Sebeleq','Enjak','Labulia.','Olor Agung','Sulin','Tandek','Tober'),
        'Ubung'=>array('Aik Are','Bagek Nunggal','Batrate','Batu Karang','Bejelo','Bile Kere','Dasan Baru.','Keraning','Pelowok','Pemangket','Punimbe','Punjambong','Tohpati','Ubung 1')
    ];
    
    public function getAllLoc($fhw){
        return $this->loc[$fhw];
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
    
    public function getKecFromUser($userid){
        foreach ($this->loc['bidan'] as $kec=>$loc){
            if(array_key_exists($userid, $loc)){
                return $kec;
            }
        }
    }

    public function getDesaFromDusun($dusun){
        foreach ($this->dusun as $desa=>$dusun_list){
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