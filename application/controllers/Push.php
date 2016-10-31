<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Login.php
 * @author Imron rosdiana
 */
class Push extends CI_Controller
{
 
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('vaksinator', TRUE);
    }
 
    public function index() {
        $datavisit = $this->db->query("SELECT * FROM jurim_visit")->result();
        echo $this->db->query("SELECT * FROM hb0_visit WHERE childId='sdsd'")->num_rows();
        var_dump($datavisit);
    }
    public function does() {
        $datavisit = $this->db->query("SELECT * FROM jurim_visit")->result();
        foreach ($datavisit as $dvisit){
            if($dvisit->hb1_kurang_7_hari!=""){
                if($this->db->query("SELECT * FROM hb0_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO hb0_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->hb1_kurang_7_hari','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO hb0_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->hb1_kurang_7_hari','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }elseif($dvisit->hb1_lebih_7_hari!=""){
                if($this->db->query("SELECT * FROM hb0_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO hb0_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->hb1_lebih_7_hari','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO hb0_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->hb1_lebih_7_hari','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->bcg_pol_1!=""){
                if($this->db->query("SELECT * FROM bcg_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO bcg_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->bcg_pol_1','None','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO bcg_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->bcg_pol_1','None','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
                if($this->db->query("SELECT * FROM polio1_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO polio1_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->bcg_pol_1','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO polio1_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->bcg_pol_1','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->dpt_1_pol_2!=""){
                if($this->db->query("SELECT * FROM hb1_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO hb1_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_1_pol_2','None','-','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO hb1_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_1_pol_2','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
                if($this->db->query("SELECT * FROM polio2_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO polio2_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_1_pol_2','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO polio2_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_1_pol_2','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->dpt_2_pol_3!=""){
                if($this->db->query("SELECT * FROM dpt_hb2_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO dpt_hb2_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_2_pol_3','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO dpt_hb2_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_2_pol_3','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
                if($this->db->query("SELECT * FROM polio3_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO polio3_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_2_pol_3','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO polio3_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_2_pol_3','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->dpt_3_pol_4_ipv!=""){
                if($this->db->query("SELECT * FROM hb3_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO hb3_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO hb3_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
                if($this->db->query("SELECT * FROM polio4_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO polio4_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO polio4_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
                if($this->db->query("SELECT * FROM ipv_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO ipv_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO ipv_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_3_pol_4_ipv','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->imunisasi_campak!=""){
                if($this->db->query("SELECT * FROM campak_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO campak_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->imunisasi_campak','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO campak_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->imunisasi_campak','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
            if($dvisit->dpt_hb_campak_lanjutan!="None"){
                if($this->db->query("SELECT * FROM campak_lanjutan_visit WHERE childId='$dvisit->childId'")->num_rows()==0){
                    $subm = explode(" ",$dvisit->clientVersionSubmissionDate);
                    $subm = $subm[0];
                    $this->db->query("INSERT INTO campak_lanjutan_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_hb_campak_lanjutan','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')");
                    echo "INSERT INTO campak_lanjutan_visit VALUES('$dvisit->userID','$dvisit->childId','$dvisit->dpt_hb_campak_lanjutan','None','$subm','$dvisit->clientVersionSubmissionDate','$dvisit->serverVersionSubmissionDate')"."<br>";
                }
            }
        }
    }
}