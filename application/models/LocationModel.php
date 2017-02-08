<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $loc = ["Darek"=>array('user1'=>'Pandan Indah','user2'=>'Serage','user3'=>'Teduh'),
                    "Pengadang"=>array('user1'=>'Gerantung','user2'=>'Jurang Jaler','user3'=>'Pengadang'),
                    "Kopang"=>array('user21'=>'Aik Bual','user2'=>'Kopang Rembiga','user3'=>'Montong Gamang'),
                    "Mantang"=>array('user1'=>'Barabali','user2'=>'Mantang','user3'=>'Presak','user4'=>'Tampak Siring'),
                    "Mujur  "=>array('user1'=>'Mujur','user2'=>'Sukaraja'),
                    "Puyung"=>array('user1'=>'Dasan Ketujur','user2'=>'Gemel'),
                    "Ubung"=>array('user20'=>'Batu Tulis','user2'=>'Labulia','user3'=>'Ubung')];
    
    public function getAllLoc(){
        return $this->loc;
    }
    
    public function getDesa($kec){
        return $this->loc[$kec];
    }
}