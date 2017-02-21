<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EcCakupanModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('LocationModel','loc');
    }
    
    public function getCakupanContainer($fhw,$p=FALSE){
        $loc = $this->loc->getIntLocId($fhw);
        foreach ($loc as $loc1=>$loc2){
            if($fhw=='vaksinator'){
                if($p){
                    $loc[$loc1] = array('lbl'=>0,'pbl'=>0,'lbi'=>0,'pbi'=>0);
                }else $loc[$loc1] = array('l'=>0,'p'=>0);
            }else $loc[$loc1] = 0;
        }
        return $loc;
    }
}