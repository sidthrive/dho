<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('LocationModel','loc');
    }
    
    public function getCakupanContainer($fhw,$p=FALSE){
        $loc = $this->loc->getIntLocId($fhw);
        $ret = [];
        foreach ($loc as $loc1=>$loc2){
            if($fhw=='vaksinator'){
                if($p){
                    $ret[$loc2] = array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0);
                }else $ret[$loc2] = array('l'=>0,'p'=>0);
            }else $ret[$loc2] = 0;
        }
        return $ret;
    }
    
    public function getSpvCakupanContainer($fhw,$kec,$p=FALSE){
        $loc = $this->loc->getLocId($kec);
        $ret = [];
        foreach ($loc as $loc1=>$loc2){
            if($fhw=='vaksinator'){
                if($p){
                    $ret[$loc2] = array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0);
                }else $ret[$loc2] = array('l'=>0,'p'=>0);
            }else $ret[$loc2] = 0;
        }
        return $ret;
    }
    
    public function getFhwCakupanContainer($desa,$p=FALSE){
        $loc = $this->loc->getDusunTypo($desa);
        $ret = [];
        foreach ($loc as $loc1=>$loc2){
            if($loc2!='Lainnya')
            $ret[$loc2] = 0;
        }
        return $ret;
    }
    
    public function getDesaPws($fhw){
        $loc = $this->loc->getIntLocId($fhw);
        $ret = [];
        foreach ($loc as $loc1=>$loc2) array_push ($ret, $loc2);
        return $ret;
    }
    
    public function getDesaPwsSpv($fhw,$kec){
        $loc = $this->loc->getLocId($kec);
        $ret = [];
        foreach ($loc as $loc1=>$loc2){
            $key = array_search($loc2, $ret);
            if(!($key>0)) array_push ($ret, $loc2);
        }
        return $ret;
    }
}