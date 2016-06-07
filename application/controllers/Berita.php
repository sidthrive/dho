<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
        $this->load->model('BeritaModel');
    }
    
    public function index(){
        if($this->session->userdata('level')!="master"&&$this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            redirect("berita/post");
        } 
    }
    
    public function post($mode="",$id="",$jenis=""){
        if($this->session->userdata('level')!="master"&&$this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $data['mode'] = $mode;
            $data['jenis'] = $jenis;
            $this->load->view('header');
            $this->load->view('sidebar_lounge');
            if($data['mode']=='edit'){
                $id = $this->uri->segment(4);
                $data['post'] = $this->BeritaModel->getPost($id);
                $this->load->view('berita/formpost',$data);
            }elseif($data['mode']=='delete'){
                $id = $this->uri->segment(4);
                $this->BeritaModel->deletePost($id);
                redirect('berita/post');
            }elseif($data['mode']=='new'){
                $data['post'] = null;
                $this->load->view('berita/formpost',$data);
            }else{
                $data['berita'] = $this->BeritaModel->getPost("berita");
                $data['artikel'] = $this->BeritaModel->getPost("artikel");
                $this->load->view('berita/listpost',$data);
            }
            $this->load->view('footer');
        } 
    }
    
    public function setPost(){
        if($this->session->userdata('level')!="master"&&$this->session->userdata('level')!="super") {
            $this->load->view('header');
            $this->load->view('errors/error_privilege');
            $this->load->view('footer');
        }else{
            $mode = $this->input->post('mode');
            $data['id'] = $this->input->post('id');
            $data['judul'] = $this->input->post('judul');
            $data['isi']   = $this->input->post('isi');
            $data['jenis']   = $this->input->post('jenis');
            $guid = "";
            if($mode=="edit"){
                $guid = $this->BeritaModel->editPost($data);
            }else{
                $guid = $this->BeritaModel->addPost($data);
            } 
            if($guid!=""){
                $guid = explode('=', $guid);
                redirect('berita/post/edit/'.$guid[1]);
            }else{
                $this->session->set_flashdata('post', 'Something is wrong!');
                redirect('berita/post');
            }
        }
    }
    
    public function show(){
        $id = $this->input->get('p');
        $data['post'] = $this->BeritaModel->getPost($id);
        $this->load->view('header');
        $this->load->view('sidebar_lounge');
        $this->load->view('berita/newsview',$data);
        $this->load->view('footer');
     }
}