<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Login_model extends CI_Model
{
 
    function __construct() {
        parent::__construct();
       // $this->load->database();
    }
 
    public function validate_user($data) {
        $this->db->where('username', $data['username']);
        $this->db->where('password', md5($data['password']));
        $this->db->from('users');
        return $this->db->get()->row();
    }
    
    public function validate_user_opensrp($data) {
        $this->db->where('opensrp_username', $data['username']);
        $this->db->where('opensrp_password', md5($data['password']));
        $this->db->from('users');
        return $this->db->get()->row();
    }
 
    function __destruct() {
        $this->db->close();
    }
}