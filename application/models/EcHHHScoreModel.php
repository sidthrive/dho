<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EcHHHScoreModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('LocationModel','loc');
    }
    
}