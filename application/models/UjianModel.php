<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UjianModel extends CI_Model{
    public $UjianDB;
    function __construct() {
        parent::__construct();
        $this->UjianDB = $this->load->database('ujian', TRUE);
        date_default_timezone_set("Asia/Makassar");
    }
    
    //User CRUD
    public function addUser($data){      
        $nama  = $data['nama'];
        $user    = $data['user'];
        $pass    = $data['pass'];
        $email    = $data['email'];
        $kontak    = $data['kontak'];
        $alamat    = $data['alamat'];
        $this->UjianDB->query("INSERT INTO user VALUES('','$nama','$user','$pass','$email','$kontak','$alamat')");
    }
    
    public function editUser($data){   
        $id  = $data['id'];
        $nama  = $data['nama'];
        $user    = $data['user'];
        $pass    = $data['pass'];
        $email    = $data['email'];
        $kontak    = $data['kontak'];
        $alamat    = $data['alamat'];
        $this->UjianDB->query("UPDATE user SET nama_lengkap='$nama',username='$user',password='$pass',email='$email',kontak='$kontak',alamat='$alamat' WHERE id=".$id);
    }
    
    public function getUser($id){    
        if(is_array($id)){
            $last = end($id);
            $clause = "";
            foreach ($id as $i){
                if($i===$last){
                    $clause .= "id=".$i;
                }else{
                    $clause .= "id=".$i." or ";
                }
            }
            return $this->UjianDB->query("SELECT * FROM user WHERE ".$clause)->result();
        }elseif($id=="all"){
            return $this->UjianDB->query("SELECT * FROM user order by id")->result();
        }else{
            return $this->UjianDB->query("SELECT * FROM user WHERE id=".$id)->row();
        }
    }
    
    public function validateUser($data){    
        $user = $data['user'];
        $pass = $data['pass'];
        return $this->UjianDB->query("SELECT * FROM user WHERE username='$user' AND password='$pass'")->row();
    }

    public function deleteUser($id){
        $this->UjianDB->query("DELETE FROM user WHERE id=".$id);
    }
    
    //Jenis Tes CRUD
    public function addJenisTes($data){   
        $nama        = $data['nama'];
        $jml_soal    = $data['jml_soal'];
        $jml_tes     = $data['jml_tes'];
        $waktu       = $data['waktu'];
        $metode      = $data['metode'];
        $ket         = $data['ket'];
        $this->UjianDB->query("INSERT INTO jenis_tes VALUES('','$nama',$jml_soal,$jml_tes,$waktu,'$metode','$ket')");
    }
    
    public function editJenisTes($data){    
        $id         = $data['id'];
        $nama       = $data['nama'];
        $jml_soal   = $data['jml_soal'];
        $jml_tes    = $data['jml_tes'];
        $waktu      = $data['waktu'];
        $metode     = $data['metode'];
        $ket        = $data['ket'];
        $this->UjianDB->query("UPDATE jenis_tes SET nama_tes='$nama',jumlah_soal=$jml_soal,jumlah_tes=$jml_tes,waktu=$waktu,metode_tes='$metode',keterangan='$ket' WHERE id=".$id);
    }
    
    public function getJenisTes($id){   
        if(is_array($id)){
            $last = end($id);
            $clause = "";
            foreach ($id as $i){
                if($i===$last){
                    $clause .= "id=".$i;
                }else{
                    $clause .= "id=".$i." or ";
                }
            }
            return $this->UjianDB->query("SELECT * FROM jenis_tes WHERE ".$clause)->result();
        }elseif($id=="all"){
            return $this->UjianDB->query("SELECT * FROM jenis_tes order by id")->result();
        }else{
            return $this->UjianDB->query("SELECT * FROM jenis_tes WHERE id=".$id)->row();
        }
    }
    
    public function deleteJenisTes($id){   
        $this->UjianDB->query("DELETE FROM jenis_tes WHERE id=".$id);
        $this->UjianDB->query("DELETE FROM soal WHERE id_jenis_tes=".$id);
    }
    
    //Soal CRUD
    public function addSoal($data){     
        $id_tes = $data['id_tes'];
        $pertanyaan = $data['pertanyaan'];
        $a = $data['a'];
        $b = $data['b'];
        $c = $data['c'];
        $d = $data['d'];
        $e = $data['e'];
        $jawaban = $data['jawaban'];
        $this->UjianDB->query("INSERT INTO soal VALUES('',$id_tes,'$pertanyaan','$a','$b','$c','$d','$e','$jawaban','yes')");
    }
    
    public function addSoalExcel($data){
        $id = $data['id_jenis'];
        foreach ($data['values'] as $soal){
            $pertanyaan = $soal['B'];
            $a = $soal['C'];
            $b = $soal['D'];
            $c = $soal['E'];
            $d = $soal['F'];
            $e = $soal['G'];
            $jawaban = $soal['H'];
            $this->UjianDB->query("INSERT INTO soal VALUES('',$id,'$pertanyaan','$a','$b','$c','$d','$e','$jawaban','yes')");
        }
    }


    public function editSoal($data){   
        $id         = $data['id'];
        $id_tes = $data['id_tes'];
        $pertanyaan = $data['pertanyaan'];
        $a = $data['a'];
        $b = $data['b'];
        $c = $data['c'];
        $d = $data['d'];
        $e = $data['e'];
        $jawaban = $data['jawaban'];
        $this->UjianDB->query("UPDATE soal SET pertanyaan='$pertanyaan',pilihan_a='$a',pilihan_b='$b',pilihan_c='$c',pilihan_d='$d',pilihan_e='$e',jawaban='$jawaban' WHERE id=".$id);
    }
    
    public function getSoal($id,$id_tes){      
        if(is_array($id)){
            $last = end($id);
            $clause = "";
            foreach ($id as $i){
                if($i===$last){
                    $clause .= "id=".$i;
                }else{
                    $clause .= "id=".$i." or ";
                }
            }
            return $this->UjianDB->query("SELECT * FROM soal WHERE ($clause) and id_jenis_tes=$id_tes")->result();
        }elseif($id=="all"){
            return $this->UjianDB->query("SELECT * FROM soal WHERE id_jenis_tes=$id_tes order by id")->result();
        }else{
            return $this->UjianDB->query("SELECT * FROM soal WHERE id=$id and id_jenis_tes=$id_tes")->row();
        }
    }
    
    public function getSoalUjian($id_tes){      
        $tes = $this->getJenisTes($id_tes);
        return $this->UjianDB->query("SELECT * FROM soal WHERE id_jenis_tes=$id_tes order by RAND() LIMIT $tes->jumlah_soal")->result();
    }
    
    public function deleteSoal($id){       
        $this->UjianDB->query("DELETE FROM soal WHERE id=".$id);
    }
    
    //Jadwal Tes CRUD
    public function addJadwal($data){      
        $id_user = $this->UjianDB->query("SELECT id FROM user WHERE nama_lengkap='".$data['id_user']."'")->row()->id;
        $id_tes = $this->UjianDB->query("SELECT id FROM jenis_tes WHERE nama_tes='".$data['id_tes']."'")->row()->id;
        $tanggal_tes = date("Y-m-d", strtotime($data['tanggal_tes']));
        $token = $data['token'];
        $this->UjianDB->query("INSERT INTO tes VALUES('',$id_user,$id_tes,'$tanggal_tes','$token','yes',NULL)");
    }
    
     public function addJadwalBidan($data){      
        $id_user = $data['id_user'];
        $id_tes = $data['id_tes'];
        $tanggal_tes = date("Y-m-d", strtotime($data['tanggal_tes']));
        $token = $data['token'];
        $this->UjianDB->query("INSERT INTO tes VALUES('',$id_user,$id_tes,'$tanggal_tes','$token','yes',NULL)");
    }
    
    public function editJadwal($data){       
        $id         = $data['id'];
        $id_user =  $this->UjianDB->query("SELECT id FROM user WHERE nama_lengkap='".$data['id_user']."'")->row()->id;
        $id_tes = $this->UjianDB->query("SELECT id FROM jenis_tes WHERE nama_tes='".$data['id_tes']."'")->row()->id;
        $tanggal_tes = date("Y-m-d", strtotime($data['tanggal_tes']));
        $token = $data['token'];
        $this->UjianDB->query("UPDATE tes SET id_user=$id_user,id_jenis=$id_tes,tanggal_tes='$tanggal_tes',token='$token' WHERE id=".$id);
    }
    
    public function getJadwal($id,$id_user="",$id_tes=""){       
        if($id=="all"){
            if($id_user!=""){
                if($id_tes!=""){
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_user='$id_user' and id_jenis='$id_tes' order by id DESC")->result();
                }else{
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_user='$id_user' order by id DESC")->result();
                }
            }else{
                if($id_tes!=""){
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_jenis='$id_tes' order by id DESC")->result();
                }else{
                    return $this->UjianDB->query("SELECT * FROM tes order by id DESC")->result();
                }
            }
        }else{
            if(is_array($id)){
                $last = end($id);
                $clause = "";
                foreach ($id as $i){
                    if($i===$last){
                        $clause .= "id=".$i;
                    }else{
                        $clause .= "id=".$i." or ";
                    }
                }
                return $this->UjianDB->query("SELECT * FROM tes WHERE ".$clause." order by id DESC")->result();
            }else{
                return $this->UjianDB->query("SELECT * FROM tes WHERE id=".$id)->row();
            }
        }
    }
    
    public function validateJadwal($id,$token){  
        return $this->UjianDB->query("SELECT * FROM tes WHERE id_user='$id' AND token='".$token."'")->row();
    }
    
    public function validateToken($token){
        return $this->UjianDB->query("SELECT * FROM tes WHERE token='".$token."'")->row();
    }

    public function deleteJadwal($id){   
        $this->UjianDB->query("DELETE FROM tes WHERE id=".$id);
    }
    
    public function addOnGoing($id_tes,$num){
        $this->UjianDB->query("INSERT INTO on_going VALUES('',$id_tes,$num,'','yes')");
    }
    
    public function updateWaktuOnGoing($id_tes,$num,$time){
        $this->UjianDB->query("UPDATE on_going SET waktu_start='$time' WHERE id_tes=$id_tes AND tes_ke=$num");
    }
    
    public function endOnGoing($id_tes,$num){
        $this->UjianDB->query("UPDATE on_going SET aktif='no' WHERE id_tes=$id_tes AND tes_ke=$num");
    }

    public function getOnGoing($id_tes,$aktif=false){
        $more = "";
        if($aktif) $more = " AND aktif='yes'";
        return $this->UjianDB->query("SELECT * FROM on_going WHERE id_tes=$id_tes".$more)->row();
    }
    
     public function getOnGoingMax($id_tes){
         return $this->UjianDB->query("SELECT MAX(tes_ke) as tes_ke FROM on_going WHERE id_tes=$id_tes AND aktif='no'")->row()->tes_ke;
     }
    
    public function getOnGoingIdSoal($on_going){
        $soal = $this->UjianDB->query("SELECT * FROM jawaban WHERE id_tes=$on_going->id_tes AND tes_ke=$on_going->tes_ke")->result();
        $id_soal = array();
        foreach($soal as $s){
            array_push($id_soal, $s->id_soal);
        }
        return $id_soal;
    }

    public function getOnGoingJawaban($on_going){
        return $this->UjianDB->query("SELECT * FROM jawaban WHERE id_tes=$on_going->id_tes AND tes_ke=$on_going->tes_ke order by id_soal")->result();
    }

    public function addJawaban($id_tes,$num,$data){
        $values = "";
        $last = end($data);
        foreach ($data as $soal){
            $values .= "('',";
            $values .= $id_tes.",";
            $values .= $num.",";
            $values .= $soal->id.",";
            $values .= "'')";
            if(!($soal===$last)) {$values .= ",";}
        }
        $this->UjianDB->query("INSERT INTO jawaban VALUES $values");
    }
    
    public function getJawaban($id_tes,$tes_ke){
        return $this->UjianDB->query("SELECT * FROM jawaban WHERE id_tes=$id_tes AND tes_ke=$tes_ke order by id_soal")->result();
    }

    public function saveJawaban($jawaban){
        $id_tes = $jawaban['id_tes'];
        $tes_ke = $jawaban['tes_ke'];
        $id_soal = $jawaban['id_soal'];
        $jawab = $jawaban['jawaban'];
        $this->UjianDB->query("UPDATE jawaban SET jawaban='$jawab' WHERE id_tes=$id_tes AND tes_ke=$tes_ke AND id_soal=$id_soal");
    }
    
    public function saveUjian($ujian){
        $id_tes = $ujian['id_tes'];
        $tes_ke = $ujian['tes_ke'];
        $this->UjianDB->query("UPDATE on_going SET aktif='no' WHERE id_tes=$id_tes AND tes_ke=$tes_ke");
    }
    
    public function endUjian($id){
        $this->UjianDB->query("UPDATE tes SET aktif='no',waktu_selesai=NOW() WHERE id=$id");
    }
    
    public function getHasil($id,$id_user="",$id_tes=""){
        if($id=="all"){
            if($id_user!=""){
                if($id_tes!=""){
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_user='$id_user' AND id_jenis='$id_tes' order by waktu_selesai DESC")->result();
                }else{
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_user='$id_user' order by waktu_selesai DESC")->result();
                }
            }else{
                if($id_tes!=""){
                    return $this->UjianDB->query("SELECT * FROM tes WHERE id_jenis='$id_tes' order by waktu_selesai DESC")->result();
                }else{
                    return $this->UjianDB->query("SELECT * FROM tes order by waktu_selesai DESC")->result();
                }
            }
        }else{
            if(is_array($id)){
                $last = end($id);
                $clause = "";
                foreach ($id as $i){
                    if($i===$last){
                        $clause .= "id=".$i;
                    }else{
                        $clause .= "id=".$i." or ";
                    }
                }
                return $this->UjianDB->query("SELECT * FROM tes WHERE ".$clause." order by waktu_selesai DESC")->result();
            }else{
                return $this->UjianDB->query("SELECT * FROM tes WHERE id=".$id)->row();
            }
        }
    }
    
    public function getHasilPersen($id_tes){
        $hasil = "";
        $tes = $this->getJadwal($id_tes);
        $jenis = $this->getJenisTes($tes->id_jenis);
        for($i=1;$i<=$this->getOnGoingMax($id_tes);$i++){
            $jawaban = $this->getJawaban($id_tes, $i);
            $id_soal = array();
            foreach($jawaban as $s){
                array_push($id_soal, $s->id_soal);
            }
            $soal = $this->getSoal($id_soal, $jenis->id);
            $benar = 0;
            foreach($jawaban as $x=>$jawab){
                if($jawab->jawaban==$soal[$x]->jawaban){
                    $benar++;
                }
            }
            $nilai = number_format(($benar/$jenis->jumlah_soal)*100,2);
            if($i!=$jenis->jumlah_tes){
                $hasil .= $nilai."%<br>";
            }else{
                $hasil .= $nilai."%";
            }
        }
        return $hasil;
    }
    
    public function getReport($id_tes){
        $hasil['tes'] = $this->getJadwal($id_tes);
        $hasil['user'] = $this->getUser($hasil['tes']->id_user);
        $hasil['jenis'] = $this->getJenisTes($hasil['tes']->id_jenis);
        $hasil['jawaban'] = array();
        $hasil['soal'] = array();
        for($i=1;$i<=$hasil['jenis']->jumlah_tes;$i++){
            $jawaban = $this->getJawaban($id_tes, $i);
            array_push($hasil['jawaban'],$jawaban);
            $id_soal = array();
            foreach($jawaban as $s){
                array_push($id_soal, $s->id_soal);
            }
            array_push($hasil['soal'],$this->getSoal($id_soal, $hasil['jenis']->id));
        }
        return $hasil;
    }

    public function validateAdmin($data){    
        $user = $data['user'];
        $pass = $data['pass'];
        return $this->UjianDB->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'")->row();
    }
    
    public function setJadwalTesBidan(){
        $this->load->model('RandomStringGenerator');
        $data['id_user'] = $this->UjianDB->query("SELECT id FROM user WHERE username='".$this->session->userdata('username')."'")->row()->id;
        $data['id_tes'] = 3;
        $data['tanggal_tes'] = date("Y-m-d");
        $data['token'] = $this->RandomStringGenerator->generate(32);
        $this->addJadwalBidan($data);
        return $data['token'];
    }
}