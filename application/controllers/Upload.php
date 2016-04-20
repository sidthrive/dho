<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Upload extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index(){
        $this->load->view('header');
        $this->load->view('kia_sidebar');
        $this->load->view('upload_form', array('error' => ' ' ));
    }

    function do_upload(){
        $config['upload_path'] = 'D:/images/silhouette/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
             $this->load->view('header');
            $this->load->view('kia_sidebar');
            $this->load->view('upload_form', $error);
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('header');
            $this->load->view('kia_sidebar');
            $this->load->view('upload_success', $data);
                    
        }
    }
}
?>