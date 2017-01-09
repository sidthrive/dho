<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikasi extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('UjianModel');
        date_default_timezone_set("Asia/Makassar");
    }
    
    public function index(){
        if($this->session->userdata('user_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('sertifikasi/login');
        }else{
            $this->load->view('header');
            $this->load->view('footer');
        } 
    }
    
    public function do_ujian(){
        if($this->session->userdata('admin_valid') == FALSE) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            if($this->uri->segment(2)=="do_ujian"&&$this->uri->segment(2)!=""){
                $token = $this->uri->segment(3);
                if(!empty($this->UjianModel->validateToken($token))){
                    redirect('sertifikasi/login/'.$token);
                }else{
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"><strong>Token yang anda miliki salah</strong></div>');
                    redirect('sertifikasi/login');
                }
            }else {
                redirect('sertifikasi/login');
            }
        }else{
            $token = $this->uri->segment(3);
            $data['ujian'] = $this->UjianModel->validateToken($token);
            $data['jenis_tes'] = $this->UjianModel->getJenisTes($data['ujian']->id_jenis);
            $mode = $this->uri->segment(4);
            $tes_ke = $this->UjianModel->getOnGoingMax($data['ujian']->id);
            if($tes_ke==$data['jenis_tes']->jumlah_tes){
                $this->UjianModel->endUjian($data['ujian']->id);
                redirect("hhhscore/headscore");
            }
            if($mode=='pre-test'){
                $data['soal'] = $this->UjianModel->getSoal("all",0);
                $this->load->view('ujian/header');
                $this->load->view('ujian/pretest',$data);
                $this->load->view('ujian/footer');
            }elseif($mode=='do'){
                $data['on_going'] = $this->UjianModel->getOnGoing($data['ujian']->id);
                if(empty($data['on_going'])){
                    $this->UjianModel->addOnGoing($data['ujian']->id,1);
                    $data['on_going'] = $this->UjianModel->getOnGoing($data['ujian']->id,true);
                    $data['soal'] = $this->UjianModel->getSoalUjian($data['ujian']->id_jenis,$data['on_going']->id_tes);
                    $this->UjianModel->addJawaban($data['ujian']->id,1,$data['soal']);
                    redirect("sertifikasi/do_ujian/".$token."/do");
                }else{
                    $data['on_going'] = $this->UjianModel->getOnGoing($data['ujian']->id,true);
                    $tes_ke = $this->UjianModel->getOnGoingMax($data['ujian']->id);
                    if($tes_ke==$data['jenis_tes']->jumlah_tes){
                        redirect("hhhscore/headscore");
                    }else{
                        if(empty($data['on_going'])){
                            $this->UjianModel->addOnGoing($data['ujian']->id,$tes_ke+1);
                            $data['on_going'] = $this->UjianModel->getOnGoing($data['ujian']->id,true);
                            $data['soal'] = $this->UjianModel->getSoalUjian($data['ujian']->id_jenis,$data['on_going']->id_tes);
                            $this->UjianModel->addJawaban($data['ujian']->id,$tes_ke+1,$data['soal']);
                            redirect("sertifikasi/do_ujian/".$token."/do");
                        }else{
                            $id_soal = $this->UjianModel->getOnGoingIdSoal($data['on_going']);
                            $data['jawaban'] = $this->UjianModel->getOnGoingJawaban($data['on_going']);
                            $data['soal'] = $this->UjianModel->getSoal($id_soal,$data['ujian']->id_jenis);
                            $this->load->view('ujian/header');
                            $this->load->view('ujian/ujian',$data);
                            $this->load->view('ujian/footer');
                        }
                    }
                }
                
            }else{
                redirect("hhhscore/headscore/do/".$token);
            }
        }
        $this->SiteAnalyticsModel->trackPage($this->uri->rsegment(1),$this->uri->rsegment(2),base_url().$this->uri->uri_string);
    }
    
    public function saveWaktu(){
        $id_tes = $this->input->post('id_tes');
        $tes_ke = $this->input->post('tes_ke');
        $waktu = $this->input->post('waktu_start');
        $this->UjianModel->updateWaktuOnGoing($id_tes,$tes_ke,$waktu);
    }

    public function saveJawaban(){
        $data['id_tes'] = $this->input->post('id_tes');
        $data['tes_ke'] = $this->input->post('tes_ke');
        $data['id_soal'] = $this->input->post('id_soal');
        $data['jawaban'] = $this->input->post('jawaban');
        $this->UjianModel->saveJawaban($data);
    }
    
    public function saveUjian(){
        $data['id_tes'] = $this->input->post('id_tes');
        $data['tes_ke'] = $this->input->post('tes_ke');
        $token = $this->input->post('token');
        $this->UjianModel->saveUjian($data);
        redirect('sertifikasi/do_ujian/'.$token);
    }
}