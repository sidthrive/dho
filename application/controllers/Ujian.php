<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('UjianModel');
        date_default_timezone_set("Asia/Makassar");
    }
    
    public function index(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            redirect('ujian/user');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function user(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode']                   = $this->uri->segment(3);
            $this->load->view('header');
            $this->load->view('ujian/sidebar');
            if($data['mode']=='delete'){
                $id = $this->uri->segment(4);
                $data['user'] = $this->UjianModel->deleteUser($id);
                redirect('ujian/user');
            }elseif($data['mode']=='edit'){
                $id = $this->uri->segment(4);
                $data['user'] = $this->UjianModel->getUser($id);
                $this->load->view('ujian/formuser',$data);
            }elseif($data['mode']=='new'){
                $data['user'] = null;
                $this->load->view('ujian/formuser',$data);
            }elseif($data['mode']=='cari'){
                $q = $this->input->get('q');
                $data['user'] = $this->db->query("SELECT * FROM user WHERE nama_lengkap LIKE '%$q%' OR username LIKE '%$q%' order by id")->result();
                $this->load->view('ujian/userlist',$data);
            }else{
                $data['user'] = $this->UjianModel->getUser("all");
                $this->load->view('ujian/userlist',$data);
            }
            
            $this->load->view('footer');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function setUser(){
        if($this->session->userdata('admin_valid') == FALSE) {
            redirect('login');
        }else{
            $data['mode'] = $this->input->post('mode');
            $data['id'] = $this->input->post('id');
            $data['nama'] = $this->input->post('nama');
            $data['user']   = $this->input->post('user');
            $data['pass']   = $this->input->post('pass');
            $data['pass2']   = $this->input->post('pass2');
            $data['email']   = $this->input->post('email');
            $data['kontak']   = $this->input->post('kontak');
            $data['alamat']   = $this->input->post('alamat');
            if($data['pass']!==$data['pass2']){
                $data['error'] = TRUE;
                $this->session->set_flashdata('pass', '<div class="alert alert-danger">Password tidak sama!</div>');
                $this->load->view('header');
                $this->load->view('ujian/sidebar');
                $this->load->view('ujian/formuser',$data);
                $this->load->view('footer');
            }else{
                if($data['mode']=="edit"){
                    $this->UjianModel->editUser($data);
                    $this->session->set_flashdata('pass', '<div class="alert alert-success">Data berhasil disimpan!</div>');
                    redirect('ujian/user/edit/'.$data['id']);
                }else{
                    $this->UjianModel->addUser($data);
                    redirect('ujian/user');
                }
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function tes(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode']                   = $this->uri->segment(3);
            $this->load->view('header');
            $this->load->view('ujian/sidebar');
            if($data['mode']=='delete'){
                $id = $this->uri->segment(4);
                $data['tes'] = $this->UjianModel->deleteJenisTes($id);
                redirect('ujian/tes');
            }elseif($data['mode']=='edit'){
                $id = $this->uri->segment(4);
                $data['tes'] = $this->UjianModel->getJenisTes($id);
                $this->load->view('ujian/formtes',$data);
            }elseif($data['mode']=='new'){
                $data['tes'] = null;
                $this->load->view('ujian/formtes',$data);
            }elseif($data['mode']=='soal'){
                $id = $this->uri->segment(4);
                $data['tes'] = $this->UjianModel->getJenisTes($id);
                $data['mode2'] = $this->uri->segment(5);
                if($data['mode2']=='delete'){
                    $id_soal = $this->uri->segment(6);
                    $data['user'] = $this->UjianModel->deleteSoal($id_soal);
                    redirect('ujian/tes/soal/'.$id);
                }elseif($data['mode2']=='edit'){
                    $id_soal = $this->uri->segment(6);
                    $data['soal'] = $this->UjianModel->getSoal($id_soal,$id);
                    $this->load->view('ujian/formsoal',$data);
                }elseif($data['mode2']=='new'){
                    $data['soal'] = null;
                    $this->load->view('ujian/formsoal',$data);
                }elseif($data['mode2']=='upload'){
                    $data_excel['id_jenis'] = $this->input->post('id_jenis');
                    $config['upload_path'] 		= './assets/temp';
                    $config['allowed_types']            = 'xlsx|xls';
                    $config['remove_spaces']            = TRUE;
                    $config['overwrite']                = TRUE;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('xls')) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                    }
                    if ($this->upload->do_upload('xls')) {
                        $up_data	 	= $this->upload->data();
                        $this->load->library('PHPExcell');
                        $objPHPExcel = PHPExcel_IOFactory::load($up_data['full_path']);
                        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                        foreach ($cell_collection as $cell) {
                            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            if ($row == 1) {
                                $header[$row][$column] = $data_value;
                            } else {
                                $arr_data[$row][$column] = $data_value;
                            }
                        }
                        $data_excel['header'] = $header;
                        $data_excel['values'] = $arr_data;
                        $this->UjianModel->addSoalExcel($data_excel);
                        unlink($up_data['full_path']);
                        redirect('ujian/tes/soal/'.$id);
                    }else {
                        $this->session->set_flashdata("fail", "<div class=\"alert alert-danger\" id=\"alert\">File tidak dapat diupload</div>");
                    }
                }else{
                    $data['soal'] = $this->UjianModel->getSoal("all",$id);
                    $this->load->view('ujian/soallist',$data);
                }
            }elseif($data['mode']=='cari'){
                $q = $this->input->get('q');
                $data['tes'] = $this->db->query("SELECT * FROM jenis_tes WHERE nama_tes LIKE '%$q%' OR jumlah_soal LIKE '%$q%' OR waktu LIKE '%$q%' OR metode_tes LIKE '%$q%' order by id")->result();
                $this->load->view('ujian/teslist',$data);
            }else{
                $data['tes'] = $this->UjianModel->getJenisTes("all");
                $this->load->view('ujian/teslist',$data);
            }
            
            $this->load->view('footer');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function setTes(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode'] = $this->input->post('mode');
            $data['id'] = $this->input->post('id');
            $data['nama'] = $this->input->post('nama');
            $data['jml_soal']   = $this->input->post('jml_soal');
            $data['jml_tes']   = $this->input->post('jml_tes');
            $data['waktu']   = $this->input->post('waktu');
            $data['metode']   = $this->input->post('metode');
            $data['ket']   = $this->input->post('ket');
            if($data['mode']=="edit"){
                $this->UjianModel->editJenisTes($data);
                $this->session->set_flashdata('pass', '<div class="alert alert-success">Data berhasil disimpan!</div>');
                redirect('ujian/tes/edit/'.$data['id']);
            }else{
                $this->UjianModel->addJenisTes($data);
                redirect('ujian/tes');
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function setSoal(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode'] = $this->input->post('mode');
            $data['id'] = $this->input->post('id');
            $data['id_tes'] = $this->input->post('id_tes');
            $data['pertanyaan'] = $this->input->post('pertanyaan');
            $data['a'] = $this->input->post('a');
            $data['b'] = $this->input->post('b');
            $data['c'] = $this->input->post('c');
            $data['d'] = $this->input->post('d');
            $data['e'] = $this->input->post('e');
            $data['jawaban'] = $this->input->post('jawaban');
            if($data['mode']=="edit"){
                $this->UjianModel->editSoal($data);
                $this->session->set_flashdata('pass', '<div class="alert alert-success">Data berhasil disimpan!</div>');
                redirect('ujian/tes/soal/'.$data['id_tes'].'/'.$data['id']);
            }else{
                $this->UjianModel->addSoal($data);
                redirect('ujian/tes/soal/'.$data['id_tes']);
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function jadwal(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode']                   = $this->uri->segment(3);
            $this->load->view('header');
            $this->load->view('ujian/sidebar');
            if($data['mode']=='delete'){
                $id = $this->uri->segment(4);
                $data['jadwal'] = $this->UjianModel->deleteJadwal($id);
                redirect('ujian/jadwal');
            }elseif($data['mode']=='edit'){
                $id = $this->uri->segment(4);
                $data['jadwal'] = $this->UjianModel->getJadwal($id);
                $data['user'] = $this->UjianModel->getUser("all");
                $data['tes'] = $this->UjianModel->getJenisTes("all");
                $this->load->view('ujian/formjadwal',$data);
            }elseif($data['mode']=='new'){
                $data['jadwal'] = null;
                $data['user'] = $this->UjianModel->getUser("all");
                $data['tes'] = $this->UjianModel->getJenisTes("all");
                $this->load->view('ujian/formjadwal',$data);
            }elseif($data['mode']=='cari'){
                $q = $this->input->get('q');
                $user = $this->db->query("SELECT * FROM user WHERE nama_lengkap LIKE '%$q%' order by id")->result();
                $id = array();
                foreach($user as $u){
                    $tes_id = $this->db->query("SELECT * FROM tes WHERE id_user=$u->id")->result();
                    foreach($tes_id as $t){
                        array_push($id, $t->id);
                    }
                }
                $data['jadwal'] = $this->UjianModel->getJadwal($id);
                $this->load->view('ujian/jadwallist',$data);
            }else{
                $data['jadwal'] = $this->UjianModel->getJadwal("all");
                $this->load->view('ujian/jadwallist',$data);
            }
            
            $this->load->view('footer');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function setJadwalTes(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $this->load->model('RandomStringGenerator');
            $data['mode'] = $this->input->post('mode');
            $data['id'] = $this->input->post('id');
            $data['id_user'] = $this->input->post('user');
            $data['id_tes'] = $this->input->post('tes');
            $data['tanggal_tes'] = $this->input->post('tanggal_tes');
            $data['token'] = $this->RandomStringGenerator->generate(32);
            if($data['mode']=="edit"){
                $this->UjianModel->editJadwal($data);
                $this->session->set_flashdata('pass', '<div class="alert alert-success">Data berhasil disimpan!</div>');
                redirect('ujian/jadwal/edit/'.$data['id']);
            }else{
                $this->UjianModel->addJadwal($data);
                redirect('ujian/jadwal');
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function hasil(){
        if($this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode']  = $this->uri->segment(3);
            $this->load->view('header');
            $this->load->view('ujian/sidebar');
            if($data['mode']=='lihat'){
                $id = $this->uri->segment(4);
                $data['hasil'] = $this->UjianModel->getReport($id);
                $this->load->view('ujian/hasil',$data);
            }elseif($data['mode']=='cari'){
                $q = $this->input->get('q');
                $user = $this->db->query("SELECT * FROM user WHERE nama_lengkap LIKE '%$q%' order by id")->result();
                $id = array();
                foreach($user as $u){
                    $tes_id = $this->db->query("SELECT * FROM tes WHERE id_user=$u->id")->result();
                    foreach($tes_id as $t){
                        array_push($id, $t->id);
                    }
                }
                if(empty($id)){
                    $id = -1;
                }
                $data['hasil'] = $this->UjianModel->getHasil($id);
                $this->load->view('ujian/hasillist',$data);
            }else{
                $data['hasil'] = $this->UjianModel->getHasil("all");
                $this->load->view('ujian/hasillist',$data);
            }
            $this->load->view('footer');
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }

}