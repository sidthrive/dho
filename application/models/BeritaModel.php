<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function addPost($data){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $judul  = $this->db->escape($data['judul']);
        $isi    = $this->db->escape($data['isi']);
        $jenis   = $data['jenis'];
        $guid   = "berita/show?p=".(self::getLastId());
        if($BeritaDB->query('INSERT INTO dho_post VALUES("","'.$this->session->userdata('id_user').'",NOW(),'.$isi.','.$judul.',"'.$jenis.'","'.$guid.'")')){
            return $guid;
        }
        else {
            return "";
        }
    }
    
    public function editPost($data){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $id     = $data['id'];
        $judul  = $this->db->escape($data['judul']);
        $isi    = $this->db->escape($data['isi']);
        $guid   = "p=".$id;
        if($BeritaDB->query("UPDATE dho_post SET post_content=".$isi.", post_title=".$judul." WHERE id=".$id)){
            return $guid;
        }
        else {
            return "";
        }
    }
    
    public function deletePost($id){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        $BeritaDB->query("DELETE FROM dho_post WHERE id=".$id);
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
        }elseif($id=="berita"){
            if($max>0&&$min>0) return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='berita' order by post_date desc LIMIT ".$max.", ".$min)->result();
            elseif($max>0) return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='berita' order by post_date desc LIMIT ".$max)->result();
            else return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='berita' order by post_date")->result();
        }elseif($id=="artikel"){
            if($max>0&&$min>0) return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='artikel' order by post_date desc LIMIT ".$max.", ".$min)->result();
            elseif($max>0) return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='artikel' order by post_date desc LIMIT ".$max)->result();
            else return $BeritaDB->query("SELECT * FROM dho_post WHERE post_type='artikel' order by post_date")->result();
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
        $max_id = $BeritaDB->query("SELECT AUTO_INCREMENT as max_id FROM information_schema.tables WHERE table_name = 'dho_post' AND table_schema = DATABASE()")->row()->max_id;
        return $max_id==null?0:$max_id;
    }
    
    public function getTotalPost(){
        $BeritaDB = $this->load->database('dho_news', TRUE);
        return $BeritaDB->query("SELECT id FROM dho_post")->num_rows();
    }
}