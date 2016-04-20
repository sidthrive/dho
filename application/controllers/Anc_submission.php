<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anc_submission extends CI_Controller {

	public function __construct(){
            parent:: __construct();
            if(empty($this->session->userdata('id_user'))){
                $this->session->set_flashdata('flash_data', 'You don\'t have access!');
                redirect('login');
            }
            $this->load->helper('url');
            $this->load->model('bidan_anc_submission_model');
	}

	public function index(){	
		$this->load->view('header');
		$this->load->view('anc_submission');
		$this->load->view('user_sidebar');
		$this->load->view('anc_submission_content');
		$this->load->view('footer');
	}
            
        private function users($userId){
            $data = $this->bidan_anc_submission_model->getUserById($userId);

            $category = array();
            $category['name'] = 'submissiondate';

            $series1 = array();
            $series1['name'] = 'Jumlah';

            foreach ($data as $row){
                $category['data'][] = $row->submissiondate;
                $series1['data'][] = $row->count;
            }

            $result = array();
            array_push($result,$category);
            array_push($result,$series1);
            
            print json_encode($result, JSON_NUMERIC_CHECK);
        }

        public function user1(){$this->users('user1');}
        public function user2(){$this->users('user2');}
        public function user3(){$this->users('user3');}
        public function user4(){$this->users('user4');}
        public function user5(){$this->users('user5');}
        public function user6(){$this->users('user6');}
        public function user7(){$this->users('user7');}
        public function user8(){$this->users('user8');}
        public function user9(){$this->users('user9');}
        public function user10(){$this->users('user10');}
        
        
        


}