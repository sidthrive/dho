<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
            parent::__construct();
 
            if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
                $this->session->set_flashdata('flash_data', 'You don\'t have access!');
                redirect('login');
            }

            $this->load->model('PHPExcelModel');
            $this->load->model('BeritaModel');
        }

        public function index()
	{
            redirect("welcome/page");
	}
        
        public function logout() {

            $data = ['id_user', 'username'];
            $this->session->unset_userdata($data);

            redirect('login');
        }
        
        public function page(){
            /* pagination */	
            $total_row		= $this->BeritaModel->getTotalPost();
            $per_page		= 2;

            $awal	= $this->uri->segment(3); 
            $awal	= (empty($awal) || $awal == 1) ? 0 : $awal;

            //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
            $akhir	= $per_page;
            
            $CI 	=& get_instance();
            $CI->load->library('pagination');
            $config['base_url'] 	= base_url()."welcome/page";
            $config['total_rows'] 	= $total_row;
            $config['uri_segment'] 	= 3;
            $config['per_page'] 	= $per_page; 
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close']= '</li>';
            $config['prev_link'] 	= '&lt;';
            $config['prev_tag_open']='<li>';
            $config['prev_tag_close']='</li>';
            $config['next_link'] 	= '&gt;';
            $config['next_tag_open']='<li>';
            $config['next_tag_close']='</li>';
            $config['cur_tag_open']='<li class="active disabled"><a href="#"  style="background: #e3e3e3">';
            $config['cur_tag_close']='</a></li>';
            $config['first_tag_open']='<li>';
            $config['first_tag_close']='</li>';
            $config['last_tag_open']='<li>';
            $config['last_tag_close']='</li>';

            $CI->pagination->initialize($config); 
            
            $data['pagi']	= $CI->pagination->create_links();
            /* */
            
            $data['post'] = $this->BeritaModel->getPost("all",$akhir,$awal);
            
            $this->load->view('header');  
            $this->load->view('sidebar_lounge');
            $this->load->view('welcome_message');
            $this->load->view('berita/newslist',$data);
            $this->load->view('footer');
        }
}
