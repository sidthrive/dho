<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function addPost($data){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $judul  = $data['judul'];
        $isi    = $data['isi'];
        $guid   = "berita/show?p=".(self::getLastId()+1);
        if($BeritaDB->query('INSERT INTO dho_post VALUES("","'.$this->session->userdata('id_user').'",NOW(),"'.$isi.'","'.$judul.'","'.$guid.'")')){
            return $guid;
        }
        else {
            return "";
        }
    }
    
    public function editPost($data){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $id     = $data['id'];
        $judul  = $data['judul'];
        $isi    = $data['isi'];
        $guid   = "p=".$id;
        if($BeritaDB->query("UPDATE dho_post SET post_content='".$isi."', post_title='".$judul."' WHERE id=".$id)){
            return $guid;
        }
        else {
            return "";
        }
    }
    
    public function deletePost($data){
        
    }
    
    public function getPost($id,$max=-1,$min=-1){
        $BeritaDB = $this->load->database('dho_news', TRUE);
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
            return $BeritaDB->query("SELECT * FROM dho_post WHERE ".$clause)->row();
        }elseif($id=="all"){
            if($max>0&&$min>0) return $BeritaDB->query("SELECT * FROM dho_post order by post_date desc LIMIT ".$max.", ".$min)->result();
            elseif($max>0) return $BeritaDB->query("SELECT * FROM dho_post order by post_date desc LIMIT ".$max)->result();
            else return $BeritaDB->query("SELECT * FROM dho_post order by post_date")->result();
        }else{
            return $BeritaDB->query("SELECT * FROM dho_post WHERE id=".$id)->row();
        }
    }
    
    public function getLastId(){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $max_id = $BeritaDB->query("SELECT MAX(id) AS max_id FROM dho_post")->row()->max_id;
        return $max_id==null?0:$max_id;
    }
    
    public function getTotalPost(){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        return $BeritaDB->query("SELECT id FROM dho_post")->num_rows();
    }
}