<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PWSNewFhwModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('analytics', TRUE);
        date_default_timezone_set("Asia/Makassar"); 
    }
    public function listdusun(){
        return $this->listdusun;
    }
    
    private function setArrayIndex($src,$col,$row_start){
        $ret = [];
        foreach ($src as $s){
            array_push($ret, $col.($row_start++));
        }
        return $ret;
    }
    
    public function kia($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col = ['januari'=>'D','februari'=>'E','maret'=>'F','april'=>'G','mei'=>'H','juni'=>'I','juli'=>'J','agustus'=>'K','september'=>'L','oktober'=>'M','november'=>'N','desember'=>'O'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['data']['DATA A']['judul'] = ["REKAPITULASI PWS IBU - KIA DESA ".strtoupper($desa)];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        $result['data']['DATA A']['bumil'] = array_fill(0,count($dusun),0);
        $result['data']['DATA A']['bulin'] = array_fill(0,count($dusun),0);
        
        $result_index['judul']= ["A1"];
        $result_index['header']= ["B5"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 6);
        $result_index['bumil'] = $this->setArrayIndex($dusun, 'C', 6);
        $result_index['bulin'] = $this->setArrayIndex($dusun, 'E', 6);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = 'desa_'.strtolower(str_replace(' ','_',$desa));
        $target = $pwsdb->query("SELECT * FROM target WHERE loc_parent='$loc' AND tahun='$year'")->result();
        foreach ($target as $t){
            $lo = explode('desa_', $t->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $key = array_search($l, $dusun);
            $result['data']['DATA A']['bumil'][$key] = $t->bumil;
            $result['data']['DATA A']['bulin'][$key] = $t->bulin;
        }
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM kia WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['cakupan_k1_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 7);
            $result_index['cakupan_k4_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 38);
            $result_index['cakupan_resiko_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 69);
            $result_index['komplikasi_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 98);
            $result_index['komplikasi_tertangani_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 127);
            $result_index['linakes_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 157);
            $result_index['nolinakes_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 188);
            $result_index['fasilitas_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 219);
            $result_index['k_nifas_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 252);
            $result_index['anemia_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 283);
            $result_index['kek_bulan_ini']=$this->setArrayIndex($dusun, $bulan_col[$bln], 314);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
        
    }
    
    public function anak($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_L = ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_P = ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['data']['DATA A']['judul'] = ["REKAPITULASI PWS IBU - KIA DESA ".strtoupper($desa)];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        $result['data']['DATA A']['bayi'] = array_fill(0,count($dusun),0);
        $result['data']['DATA A']['balita'] = array_fill(0,count($dusun),0);
        
        $result_index['judul']= ["A1"];
        $result_index['header']= ["B5"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 6);
        $result_index['bayi'] = $this->setArrayIndex($dusun, 'C', 6);
        $result_index['balita'] = $this->setArrayIndex($dusun, 'E', 6);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = 'desa_'.strtolower(str_replace(' ','_',$desa));
        $target = $pwsdb->query("SELECT * FROM target WHERE loc_parent='$loc' AND tahun='$year'")->result();
        foreach ($target as $t){
            $lo = explode('desa_', $t->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $key = array_search($l, $dusun);
            $result['data']['DATA A']['bayi'][$key] = $t->bayi;
            $result['data']['DATA A']['balita'][$key] = $t->balita;
        }
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM anak WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_anak.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['kunjungan_neonatal_I_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 8);
            $result_index['kunjungan_neonatal_I_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 8);
            $result_index['kunjungan_neonatal_III_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 41);
            $result_index['kunjungan_neonatal_III_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 41);
            $result_index['komplikasi_noenatal_ditemukan_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 74);
            $result_index['komplikasi_noenatal_ditemukan_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 74);
            $result_index['komplikasi_noenatal_tertangani_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 107);
            $result_index['komplikasi_noenatal_tertangani_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 107);
            $result_index['kunjugan_bayi_I_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 140);
            $result_index['kunjugan_bayi_I_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 140);
            $result_index['kunjugan_bayi_IV_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 173);
            $result_index['kunjugan_bayi_IV_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 173);
            $result_index['kunjugan_balita_I_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 206);
            $result_index['kunjugan_balita_I_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 206);
            $result_index['kunjugan_balita_II_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 239);
            $result_index['kunjugan_balita_II_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 239);
            $result_index['pelayanan_balita_sakit_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 272);
            $result_index['pelayanan_balita_sakit_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 272);
            $result_index['pelayanan_balita_sakit_MTBS_L']=$this->setArrayIndex($dusun, $bulan_col_L[$bln], 305);
            $result_index['pelayanan_balita_sakit_MTBS_P']=$this->setArrayIndex($dusun, $bulan_col_P[$bln], 305);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function kb($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_PKB['4t'] =      ['januari'=>'D','februari'=>'I','maret'=>'N','april'=>'S','mei'=>'X', 'juni'=>'AC','juli'=>'AH','agustus'=>'AM','september'=>'AR','oktober'=>'AW','november'=>'BB','desember'=>'BG'];
        $bulan_col_PKB['komp'] =    ['januari'=>'E','februari'=>'J','maret'=>'O','april'=>'T','mei'=>'Y', 'juni'=>'AD','juli'=>'AI','agustus'=>'AN','september'=>'AS','oktober'=>'AX','november'=>'BC','desember'=>'BH'];
        $bulan_col_PKB['gagal'] =   ['januari'=>'F','februari'=>'K','maret'=>'P','april'=>'U','mei'=>'Z', 'juni'=>'AE','juli'=>'AJ','agustus'=>'AO','september'=>'AT','oktober'=>'AY','november'=>'BD','desember'=>'BI'];
        $bulan_col_PKB['do'] =      ['januari'=>'G','februari'=>'L','maret'=>'Q','april'=>'V','mei'=>'AA','juni'=>'AF','juli'=>'AK','agustus'=>'AP','september'=>'AU','oktober'=>'AZ','november'=>'BE','desember'=>'BJ'];
        
        $bulan_col_KBA['kond'] =    ['januari'=>'C','februari'=>'J','maret'=>'Q','april'=>'X', 'mei'=>'AE','juni'=>'AL','juli'=>'AS','agustus'=>'AZ','september'=>'BG','oktober'=>'BN','november'=>'BU','desember'=>'CB'];
        $bulan_col_KBA['pil'] =     ['januari'=>'D','februari'=>'K','maret'=>'R','april'=>'Y', 'mei'=>'AF','juni'=>'AM','juli'=>'AT','agustus'=>'BA','september'=>'BH','oktober'=>'BO','november'=>'BV','desember'=>'CC'];
        $bulan_col_KBA['sunt'] =    ['januari'=>'E','februari'=>'L','maret'=>'S','april'=>'Z', 'mei'=>'AG','juni'=>'AN','juli'=>'AU','agustus'=>'BB','september'=>'BI','oktober'=>'BP','november'=>'BW','desember'=>'CD'];
        $bulan_col_KBA['akdr'] =    ['januari'=>'F','februari'=>'M','maret'=>'T','april'=>'AA','mei'=>'AH','juni'=>'AO','juli'=>'AV','agustus'=>'BC','september'=>'BJ','oktober'=>'BQ','november'=>'BX','desember'=>'CE'];
        $bulan_col_KBA['impl'] =    ['januari'=>'G','februari'=>'N','maret'=>'U','april'=>'AB','mei'=>'AI','juni'=>'AP','juli'=>'AW','agustus'=>'BD','september'=>'BK','oktober'=>'BR','november'=>'BY','desember'=>'CF'];
        $bulan_col_KBA['mow'] =     ['januari'=>'H','februari'=>'O','maret'=>'V','april'=>'AC','mei'=>'AJ','juni'=>'AQ','juli'=>'AX','agustus'=>'BE','september'=>'BL','oktober'=>'BS','november'=>'BZ','desember'=>'CG'];
        $bulan_col_KBA['mop'] =     ['januari'=>'I','februari'=>'P','maret'=>'W','april'=>'AD','mei'=>'AK','juni'=>'AR','juli'=>'AY','agustus'=>'BF','september'=>'BM','oktober'=>'BT','november'=>'CA','desember'=>'CH'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['data']['DATA A']['judul'] = ["PEMANTAUAN WILAYAH SETEMPAT (PWS) DESA ".strtoupper($desa)." TAHUN ".$year];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        $result['data']['DATA A']['pus'] = array_fill(0,count($dusun),0);
        $result['data']['DATA A']['pus4t'] = array_fill(0,count($dusun),0);
        
        $result_index['judul']= ["A2"];
        $result_index['header']= ["B5"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 7);
        $result_index['pus'] = $this->setArrayIndex($dusun, 'C', 7);
        $result_index['pus4t'] = $this->setArrayIndex($dusun, 'D', 7);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = 'desa_'.strtolower(str_replace(' ','_',$desa));
        $target = $pwsdb->query("SELECT * FROM target WHERE loc_parent='$loc' AND tahun='$year'")->result();
        foreach ($target as $t){
            $lo = explode('desa_', $t->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $key = array_search($l, $dusun);
            $result['data']['DATA A']['bayi'][$key] = $t->bayi;
            $result['data']['DATA A']['balita'][$key] = $t->balita;
        }
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM kb WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_kb.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['pelayanan_kb_4t']=$this->setArrayIndex($dusun, $bulan_col_PKB['4t'][$bln], 8);
            $result_index['pelayanan_kb_komp']=$this->setArrayIndex($dusun, $bulan_col_PKB['komp'][$bln], 8);
            $result_index['pelayanan_kb_gagal']=$this->setArrayIndex($dusun, $bulan_col_PKB['gagal'][$bln], 8);
            $result_index['pelayanan_kb_do']=$this->setArrayIndex($dusun, $bulan_col_PKB['do'][$bln], 8);
            $result_index['kb_aktif_kond']=$this->setArrayIndex($dusun, $bulan_col_KBA['kond'][$bln], 39);
            $result_index['kb_aktif_pil']=$this->setArrayIndex($dusun, $bulan_col_KBA['pil'][$bln], 39);
            $result_index['kb_aktif_sunt']=$this->setArrayIndex($dusun, $bulan_col_KBA['sunt'][$bln], 39);
            $result_index['kb_aktif_akdr']=$this->setArrayIndex($dusun, $bulan_col_KBA['akdr'][$bln], 39);
            $result_index['kb_aktif_impl']=$this->setArrayIndex($dusun, $bulan_col_KBA['impl'][$bln], 39);
            $result_index['kb_aktif_mow']=$this->setArrayIndex($dusun, $bulan_col_KBA['mow'][$bln], 39);
            $result_index['kb_aktif_mop']=$this->setArrayIndex($dusun, $bulan_col_KBA['mop'][$bln], 39);
            $result_index['kb_pasca_salin_kond']=$this->setArrayIndex($dusun, $bulan_col_KBA['kond'][$bln], 70);
            $result_index['kb_pasca_salin_pil']=$this->setArrayIndex($dusun, $bulan_col_KBA['pil'][$bln], 70);
            $result_index['kb_pasca_salin_sunt']=$this->setArrayIndex($dusun, $bulan_col_KBA['sunt'][$bln], 70);
            $result_index['kb_pasca_salin_akdr']=$this->setArrayIndex($dusun, $bulan_col_KBA['akdr'][$bln], 70);
            $result_index['kb_pasca_salin_impl']=$this->setArrayIndex($dusun, $bulan_col_KBA['impl'][$bln], 70);
            $result_index['kb_pasca_salin_mow']=$this->setArrayIndex($dusun, $bulan_col_KBA['mow'][$bln], 70);
            $result_index['kb_pasca_salin_mop']=$this->setArrayIndex($dusun, $bulan_col_KBA['mop'][$bln], 70);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function bayi($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['data']['DATA A']['judul'] = ["DESA ".strtoupper($desa)];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        
        $result_index['judul']= ["A2"];
        $result_index['header']= ["B17"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 18);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM bayi WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_bayi.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 10);
            $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 10);
            $result_index['pneumonia_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 10);
            $result_index['pneumonia_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 10);
            $result_index['diare_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 52);
            $result_index['diare_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 52);
            $result_index['diare_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 52);
            $result_index['diare_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 52);
            $result_index['tetanus_n_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 94);
            $result_index['tetanus_n_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 94);
            $result_index['tetanus_n_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 94);
            $result_index['tetanus_n_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 94);
            $result_index['saraf_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 136);
            $result_index['saraf_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 136);
            $result_index['saraf_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 136);
            $result_index['saraf_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 136);
            $result_index['malaria_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 178);
            $result_index['malaria_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 178);
            $result_index['malaria_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 178);
            $result_index['malaria_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 178);
            $result_index['tb_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 220);
            $result_index['tb_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 220);
            $result_index['tb_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 220);
            $result_index['tb_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 220);
            $result_index['demam_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 262);
            $result_index['demam_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 262);
            $result_index['demam_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 262);
            $result_index['demam_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 262);
            $result_index['lainlain_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 304);
            $result_index['lainlain_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 304);
            $result_index['lainlain_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 304);
            $result_index['lainlain_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 304);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function balita($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L = ['januari'=>'C','februari'=>'G','maret'=>'K','april'=>'O','mei'=>'S','juni'=>'W','juli'=>'AA','agustus'=>'AE','september'=>'AI','oktober'=>'AM','november'=>'AQ','desember'=>'AU'];
        $bulan_col_K_P = ['januari'=>'D','februari'=>'H','maret'=>'L','april'=>'P','mei'=>'T','juni'=>'X','juli'=>'AB','agustus'=>'AF','september'=>'AJ','oktober'=>'AN','november'=>'AR','desember'=>'AV'];
        $bulan_col_M_L = ['januari'=>'E','februari'=>'I','maret'=>'M','april'=>'Q','mei'=>'U','juni'=>'Y','juli'=>'AC','agustus'=>'AG','september'=>'AK','oktober'=>'AO','november'=>'AS','desember'=>'AW'];
        $bulan_col_M_P = ['januari'=>'F','februari'=>'J','maret'=>'N','april'=>'R','mei'=>'V','juni'=>'Z','juli'=>'AD','agustus'=>'AH','september'=>'AL','oktober'=>'AP','november'=>'AT','desember'=>'AX'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['data']['DATA A']['judul'] = ["DESA ".strtoupper($desa)];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        
        $result_index['judul']= ["A2"];
        $result_index['header']= ["B17"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 18);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM balita WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_balita.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['pneumonia_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 10);
            $result_index['pneumonia_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 10);
            $result_index['pneumonia_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 10);
            $result_index['pneumonia_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 10);
            $result_index['diare_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 52);
            $result_index['diare_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 52);
            $result_index['diare_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 52);
            $result_index['diare_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 52);
            $result_index['malaria_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 94);
            $result_index['malaria_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 94);
            $result_index['malaria_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 94);
            $result_index['malaria_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 94);
            $result_index['campak_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 136);
            $result_index['campak_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 136);
            $result_index['campak_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 136);
            $result_index['campak_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 136);
            $result_index['demam_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 178);
            $result_index['demam_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 178);
            $result_index['demam_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 178);
            $result_index['demam_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 178);
            $result_index['difteri_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 220);
            $result_index['difteri_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 220);
            $result_index['difteri_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 220);
            $result_index['difteri_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 220);
            $result_index['giziburuk_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 262);
            $result_index['giziburuk_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 262);
            $result_index['giziburuk_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 262);
            $result_index['giziburuk_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 262);
            $result_index['lainlain_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 304);
            $result_index['lainlain_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 304);
            $result_index['lainlain_mati_L'] = $this->setArrayIndex($dusun, $bulan_col_M_L[$bln], 304);
            $result_index['lainlain_mati_P'] = $this->setArrayIndex($dusun, $bulan_col_M_P[$bln], 304);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function neonatal($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K_L =  ['januari'=>'C','februari'=>'I','maret'=>'O','april'=>'U','mei'=>'AA','juni'=>'AG','juli'=>'AM','agustus'=>'AS','september'=>'AY','oktober'=>'BE','november'=>'BK','desember'=>'BQ'];
        $bulan_col_K_P =  ['januari'=>'D','februari'=>'J','maret'=>'P','april'=>'V','mei'=>'AB','juni'=>'AH','juli'=>'AN','agustus'=>'AT','september'=>'AZ','oktober'=>'BF','november'=>'BL','desember'=>'BR'];
        $bulan_col_M1_L = ['januari'=>'E','februari'=>'K','maret'=>'Q','april'=>'W','mei'=>'AC','juni'=>'AI','juli'=>'AO','agustus'=>'AU','september'=>'BA','oktober'=>'BG','november'=>'BM','desember'=>'BS'];
        $bulan_col_M1_P = ['januari'=>'F','februari'=>'L','maret'=>'R','april'=>'X','mei'=>'AD','juni'=>'AJ','juli'=>'AP','agustus'=>'AV','september'=>'BB','oktober'=>'BH','november'=>'BN','desember'=>'BT'];
        $bulan_col_M2_L = ['januari'=>'G','februari'=>'M','maret'=>'S','april'=>'Y','mei'=>'AE','juni'=>'AK','juli'=>'AQ','agustus'=>'AW','september'=>'BC','oktober'=>'BI','november'=>'BO','desember'=>'BU'];
        $bulan_col_M2_P = ['januari'=>'H','februari'=>'N','maret'=>'T','april'=>'Z','mei'=>'AF','juni'=>'AL','juli'=>'AR','agustus'=>'AX','september'=>'BD','oktober'=>'BJ','november'=>'BP','desember'=>'BV'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        $result['form'] = array($form);
        $result['desa'] = array("DESA    :  ".strtoupper($desa));
        $result['bulan']    = array("BULAN              :   ".strtoupper($month)." ".$year);
        $result['data']['DATA A']['judul'] = ["DESA ".strtoupper($desa)];
        $result['data']['DATA A']['header'] = ["DUSUN"];
        $result['data']['DATA A']['dusun'] = $dusun;
        
        $result_index['judul']= ["A2"];
        $result_index['header']= ["B17"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 18);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM neonatal WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_neonatal.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        foreach ($data as $bln=>$d){
            $result_index['bblr_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 10);
            $result_index['bblr_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 10);
            $result_index['bblr_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 10);
            $result_index['bblr_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 10);
            $result_index['bblr_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 10);
            $result_index['bblr_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 10);
            $result_index['asfiksia_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 45);
            $result_index['asfiksia_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 45);
            $result_index['asfiksia_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 45);
            $result_index['asfiksia_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 45);
            $result_index['asfiksia_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 45);
            $result_index['asfiksia_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 45);
            $result_index['ikterus_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 80);
            $result_index['ikterus_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 80);
            $result_index['ikterus_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 80);
            $result_index['ikterus_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 80);
            $result_index['ikterus_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 80);
            $result_index['ikterus_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 80);
            $result_index['tetanus_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 115);
            $result_index['tetanus_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 115);
            $result_index['tetanus_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 115);
            $result_index['tetanus_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 115);
            $result_index['tetanus_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 115);
            $result_index['tetanus_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 115);
            $result_index['sepsis_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 150);
            $result_index['sepsis_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 150);
            $result_index['sepsis_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 150);
            $result_index['sepsis_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 150);
            $result_index['sepsis_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 150);
            $result_index['sepsis_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 150);
            $result_index['kelainan_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 185);
            $result_index['kelainan_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 185);
            $result_index['kelainan_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 185);
            $result_index['kelainan_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 185);
            $result_index['kelainan_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 185);
            $result_index['kelainan_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 185);
            $result_index['lainlain_kasus_L'] = $this->setArrayIndex($dusun, $bulan_col_K_L[$bln], 220);
            $result_index['lainlain_kasus_P'] = $this->setArrayIndex($dusun, $bulan_col_K_P[$bln], 220);
            $result_index['lainlain_mati1_L'] = $this->setArrayIndex($dusun, $bulan_col_M1_L[$bln], 220);
            $result_index['lainlain_mati1_P'] = $this->setArrayIndex($dusun, $bulan_col_M1_P[$bln], 220);
            $result_index['lainlain_mati2_L'] = $this->setArrayIndex($dusun, $bulan_col_M2_L[$bln], 220);
            $result_index['lainlain_mati2_P'] = $this->setArrayIndex($dusun, $bulan_col_M2_P[$bln], 220);
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach ($d2 as $k=>$v){
                    $result['data']['DATA'][$k][$key] = $v;
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    public function maternal($user,$year,$month,$form){
        $bulan_map = ['januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12];
        $bulan_col_K =  ['januari'=>'C','februari'=>'E','maret'=>'G','april'=>'I','mei'=>'K','juni'=>'M','juli'=>'O','agustus'=>'Q','september'=>'S','oktober'=>'U','november'=>'W','desember'=>'Y'];
        $bulan_col_M =  ['januari'=>'D','februari'=>'F','maret'=>'H','april'=>'J','mei'=>'L','juni'=>'N','juli'=>'P','agustus'=>'R','september'=>'T','oktober'=>'V','november'=>'X','desember'=>'Z'];
        $startyear = date("Y-m",  strtotime($year.'-1'));
        $startdate = date("Y-m",  strtotime($year.'-'.$bulan_map[$month]));
        $enddate = date("Y-m", strtotime($startdate." +1 months"));
        $desa = $this->session->userdata('location');
        $this->readDate($year, $month);
        $namefile = "_".$month."_".str_replace(' ','-',$desa).".xls";
        $result = array();
        
        $dusun = array_values($this->loc->getDusun($desa));
        $user_index = $this->loc->getDusunTypo($desa);
        
        $result['data']['Sheet1']['judul'] = ["DESA ".strtoupper($desa)];
        $result['data']['Perdarahan']['header'] = ["DUSUN"];
        $result['data']['Perdarahan']['dusun'] = $dusun;
        
        $result_index['judul']= ["F5"];
        $result_index['header']= ["B5"];
        $result_index['dusun']= $this->setArrayIndex($dusun, 'B', 7);
        
        $pwsdb = $this->load->database('pws', TRUE);
        $loc = "";
        foreach ($dusun as $u){
            $dsn = 'dusun_'.strtolower(str_replace(' ', '_', $u));
            if($u==end($dusun)){
                $loc = $loc."location='$dsn'";
            }else{
                $loc = $loc."location='$dsn' OR ";
            }
        }
        $bln = "";
        foreach ($bulan_map as $b=>$n){
            if($b==$month){
                $bln = $bln."bulan='$b'";
                break;
            }else{
                $bln = $bln."bulan='$b' OR ";
            }
        }
        $all_data = $pwsdb->query("SELECT * FROM maternal WHERE tahun='$year' AND ($loc) AND ($bln)")->result();
        $data = [];
        foreach ($all_data as $d){
            $lo = explode('dusun_', $d->location);
            $l = str_replace('Ii', 'II', str_replace('Iii', 'III', ucwords(str_replace('_', ' ', $lo[1]))));
            $data[$d->bulan][$l][$d->field_name] = $d->value;
        }
        
        $file = APPPATH."download/new_pws/pws_ibu.xlsx";
        $this->load->library('PHPExcell');
        $fileObject = PHPExcel_IOFactory::load($file);
        
        foreach ($result['data'] as $ws=>$d){
            $fileObject->setActiveSheetIndexByName($ws);

            foreach ($d as $key1=>$cell){
                foreach ($cell as $key2=>$value){
                    if(isset($result_index[$key1][$key2]))
                        $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                }
            }
        }
        
        $temp['Perdarahan']['hamil_muda_K'] = array_fill(0,count($user),1);
        $temp['Perdarahan']['hamil_muda_M'] = array_fill(0,count($user),1);
        $temp['Perdarahan']['apb_K'] = array_fill(0,count($user),1);
        $temp['Perdarahan']['apb_M'] = array_fill(0,count($user),1);
        $temp['Perdarahan']['hpp_K'] = array_fill(0,count($user),1);
        $temp['Perdarahan']['hpp_M'] = array_fill(0,count($user),1);
        $temp['Infeksi']['kpd_K'] = array_fill(0,count($user),1);
        $temp['Infeksi']['kpd_M'] = array_fill(0,count($user),1);
        $temp['Infeksi']['partus_lama_K'] = array_fill(0,count($user),1);
        $temp['Infeksi']['partus_lama_M'] = array_fill(0,count($user),1);
        $temp['Infeksi']['partus_kasep_K'] = array_fill(0,count($user),1);
        $temp['Infeksi']['partus_kasep_M'] = array_fill(0,count($user),1);
        $temp['Infeksi']['sepsis_puerpuralis_K'] = array_fill(0,count($user),1);
        $temp['Infeksi']['sepsis_puerpuralis_M'] = array_fill(0,count($user),1);
        $temp['HDK']['hipertensi_kronis_K'] = array_fill(0,count($user),1);
        $temp['HDK']['hipertensi_kronis_M'] = array_fill(0,count($user),1);
        $temp['HDK']['hipertensi_protein_K'] = array_fill(0,count($user),1);
        $temp['HDK']['hipertensi_protein_M'] = array_fill(0,count($user),1);
        $temp['HDK']['eklamsia_K'] = array_fill(0,count($user),1);
        $temp['HDK']['eklamsia_M'] = array_fill(0,count($user),1);
        $temp['PM-PTM']['menular_K'] = array_fill(0,count($user),1);
        $temp['PM-PTM']['menular_M'] = array_fill(0,count($user),1);  
        $temp['PM-PTM']['tidak_menular_K'] = array_fill(0,count($user),1);
        $temp['PM-PTM']['tidak_menular_M'] = array_fill(0,count($user),1);
        
        foreach ($data as $bln=>$d){
            $result_index['hamil_muda_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 7);
            $result_index['hamil_muda_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 7);
            $result_index['apb_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 45);
            $result_index['apb_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 45);
            $result_index['hpp_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 83);
            $result_index['hpp_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 83);
            $result_index['kpd_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 7);
            $result_index['kpd_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 7);
            $result_index['partus_lama_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 44);
            $result_index['partus_lama_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 44);
            $result_index['partus_kasep_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 81);
            $result_index['partus_kasep_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 81);
            $result_index['sepsis_puerpuralis_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 118);
            $result_index['sepsis_puerpuralis_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 118);
            $result_index['hipertensi_kronis_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 7);
            $result_index['hipertensi_kronis_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 7);
            $result_index['hipertensi_protein_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 44);
            $result_index['hipertensi_protein_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 44);
            $result_index['eklamsia_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 81);
            $result_index['eklamsia_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 81);
            $result_index['menular_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 7);
            $result_index['menular_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 7);  
            $result_index['tidak_menular_K'] = $this->setArrayIndex($dusun, $bulan_col_K[$bln], 44);
            $result_index['tidak_menular_M'] = $this->setArrayIndex($dusun, $bulan_col_M[$bln], 44); 
            foreach ($d as $ds=>$d2){
                $key = array_search($ds, $dusun);
                foreach($temp as $nm=>$val){
                    foreach ($val as $a=>$b){
                        $result['data'][$nm][$a][$key] = $data[$bln][$ds][$a];
                    }
                }
            }
            foreach ($result['data'] as $ws=>$d){
                $fileObject->setActiveSheetIndexByName($ws);

                foreach ($d as $key1=>$cell){
                    foreach ($cell as $key2=>$value){
                        if(isset($result_index[$key1][$key2]))
                            $fileObject->getActiveSheet()->setCellValue($result_index[$key1][$key2], $value);
                    }
                }
            }
        }
        
        $desa = strtoupper(str_replace(' ', '_', $desa));
        $savedFileName = 'PWS-'.strtoupper($form).'-'.strtoupper($desa).'-'.strtoupper($month).'-'.strtoupper($year).'.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0');

        $saveContainer = PHPExcel_IOFactory::createWriter($fileObject,'Excel2007');
        $saveContainer->save('php://output');
    }
    
    private function readDate($year,$month){
        $this->tahun = $year;
        if(strtoupper($month)=="JANUARI"){
            $this->bulan = 1;
        }elseif(strtoupper($month)=="FEBRUARI"){
            $this->bulan = 2;
        }elseif(strtoupper($month)=="MARET"){
            $this->bulan = 3;
        }elseif(strtoupper($month)=="APRIL"){
            $this->bulan = 4;
        }elseif(strtoupper($month)=="MEI"){
            $this->bulan = 5;
        }elseif(strtoupper($month)=="JUNI"){
            $this->bulan = 6;
        }elseif(strtoupper($month)=="JULI"){
            $this->bulan = 7;
        }elseif(strtoupper($month)=="AGUSTUS"){
            $this->bulan = 8;
        }elseif(strtoupper($month)=="SEPTEMBER"){
            $this->bulan = 9;
        }elseif(strtoupper($month)=="OKTOBER"){
            $this->bulan = 10;
        }elseif(strtoupper($month)=="NOVEMBER"){
            $this->bulan = 11;
        }elseif(strtoupper($month)=="DESEMBER"){
            $this->bulan = 12;
        }
    }
}