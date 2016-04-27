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
 
            if(empty($this->session->userdata('id_user'))) {
                $this->session->set_flashdata('flash_data', 'You don\'t have access!');
                redirect('login');
            }
            $this->load->model('PHPExcelModel');
            
            $this->load->view('header');  
            //$this->load->view('chartModule');
            $this->load->view('sidebar_lounge');
            $this->load->view('welcome_message');
            $this->load->view('footer');
            //$this->load->view('chartModule');
            
        }
	public function index()
	{
	    $temp = $this->getK1_akses();
            $dataXLS['K1username']=$temp['xlabel'];
            $dataXLS['K1percentage']=$temp['yvalue'];
            
            $temp = $this->getK4();
            $dataXLS['K4username']=$temp['xlabel'];
            $dataXLS['K4percentage']=$temp['yvalue'];
            
            $temp = $this->getKunjunganNeonatal1();
            $dataXLS['KNeo1username']=$temp['xlabel'];
            $dataXLS['KNeo1percentage']=$temp['yvalue'];
            
            $temp = $this->getKunjunganNeonatal3();
            $dataXLS['KNeo3username']=$temp['xlabel'];
            $dataXLS['KNeo3percentage']=$temp['yvalue'];
            
            $temp = $this->getKunjunganNifas();
            $dataXLS['KNifasusername']=$temp['xlabel'];
            $dataXLS['KNifaspercentage']=$temp['yvalue'];
            
            $temp = $this->getKematianBalita();
            $dataXLS['KBalitausername']=$temp['xlabel'];
            $dataXLS['KBalitapercentage']=$temp['yvalue'];
            
            $this->load->view('welcome_chart_graphic',$dataXLS,false);
            
	}
        
   public function getK1_akses(){
        return $this->PHPExcelModel->getXLSData('download/k1_akses.xls','E');
    }
    
    public function getK4(){
        return $this->PHPExcelModel->getXLSData('download/k4.xls','E');
    }
    
    public function getKematianBalita(){
        return $this->PHPExcelModel->getXLSData('download/kematian_balita.xls','E');
    }
    
    public function getKematianBayi(){
        return $this->PHPExcelModel->getXLSData('download/kematian_bayi.xls','E');
    }
    
    public function getKunjunganNeonatal1(){
        return $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_1.xls','E');
    }
    
    public function getKunjunganNeonatal3(){
        return $this->PHPExcelModel->getXLSData('download/kunjungan_neonatal_3.xls','E');
    }
    
    public function getKunjunganNifas(){
        return $this->PHPExcelModel->getXLSData('download/kunjungan_nifas.xls','E');
    }
    
    public function getPersalinanFasilitasKesehatan(){
        return $this->PHPExcelModel->getXLSData('download/persalinan_fasilitas_kesehatan.xls','E');
    }
    
    public function getPersalinanTenagaKesehatan(){
        return $this->PHPExcelModel->getXLSData('download/persalinan_tenaga_kesehatan.xls','E');
    }


        public function data(){
            $data = $this->coverage->get_anc_data();

            $category = array();
            $category['name'] = 'desa';

            $series1 = array();
            $series1['name'] = 'K1 (ANC 1)';

            $series2 = array();
            $series2['name'] = 'K4 (ANC 4)';

            //$series3 = array();
    //	$series3['name'] = 'Highcharts';

            foreach ($data as $row)
            {
                $category['data'][] = $row->desa;
                $series1['data'][] = $row->k1_coverage;
                $series2['data'][] = $row->k4_coverage;
            //	$series3['data'][] = $row->highcharts;
            }

            $result = array();
            array_push($result,$category);
            array_push($result,$series1);
            array_push($result,$series2);
            //array_push($result,$series3);

            print json_encode($result, JSON_NUMERIC_CHECK);
        }
        
	public function logout() {
        $data = ['id_user', 'username'];
        $this->session->unset_userdata($data);
 
        redirect('login');
    }
}
