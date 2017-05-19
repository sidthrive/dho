<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsEcTableModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $table =[
        'bidan'=> [
            'kartu_ibu_registration'=>'Registrasi Ibu',
            'kohort_kb_registration'=>'Registrasi KB',
            'kartu_anc_registration'=>'Registrasi ANC',
            'kartu_anc_rencana_persalinan'=>'Rencana Persalinan',
            'kartu_anc_visit'=>'Kunjungan ANC',
            'kartu_pnc_regitration_oa'=>'Registrasi PNC',
            'kartu_pnc_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'kartu_pnc_visit'=>'Kunjungan PNC',
            'kohort_bayi_registration'=>'Registrasi Anak',
            'kohort_bayi_neonatal_period'=>'Kunjungan Neonatal',
            'kohort_bayi_kunjungan'=>'Kunjungan Bayi',
            'kartu_anc_close'=>'Penutupan ANC',
            'kartu_anc_edit'=>'Edit ANC',
            'kartu_anc_visit_edit'=>'Edit Kunjungan ANC',
            'kartu_anc_visit_integrasi'=>'Kunjungan ANC Integrasi',
            'kartu_anc_visit_labTest'=>'Kunjungan ANC Labtest',
            'kartu_ibu_close'=>'Penutupan Ibu',
            'kartu_ibu_edit'=>'Edit Ibu',
            'kartu_pnc_close'=>'Penutupan PNC',
            'kartu_pnc_edit'=>'Edit PNC',
            'kohort_anak_tutup'=>'Penutupan Anak',
            'kohort_bayi_edit'=>'Edit Bayi',
            'kohort_bayi_immunization'=>'Imunisasi Bayi',
            'kohort_kb_close'=>'Penutupan KB',
            'kohort_kb_edit'=>'Edit KB',
            'kohort_kb_pelayanan'=>'Pendaftaran KB',
            'kohort_kb_update'=>'Kunjungan KB',
            '15'=>'Invitasi Parana',
            '16'=>'Parana Sesi 1',
            '17'=>'Parana Sesi 2',
            '18'=>'Parana Sesi 3',
            '19'=>'Parana Sesi 4 '],
        'sdidtk'=>[
            '1'=>'Antropometri',
            '2'=>'KPSP 1 Tahun',
            '3'=>'KPSP 2 Tahun',
            '4'=>'KPSP 3 Tahun',
            '5'=>'KPSP 4 Tahun',
            '6'=>'KPSP 5 Tahun',
            '7'=>'KPSP 6 Tahun',
            '8'=>'Tes Daya Lihat',
            '9'=>'Tes Daya Dengar',
            '10'=>'KMME',
            '11'=>'GPPH',
            '12'=>'CHAT',
            '13'=>'Home 0-2 Tahun',
            '14'=>'Home 3-6 Tahun',
            '15'=>'Invitasi Parana',
            '16'=>'Parana Sesi 1',
            '17'=>'Parana Sesi 2',
            '18'=>'Parana Sesi 3',
            '19'=>'Parana Sesi 4 ']];
    
    public function getTable($fhw){
        return $this->table[$fhw];
    }
    public function getTableName($fhw){
        $ret = [];
        foreach ($this->table[$fhw] as $table=>$tname){
            array_push($ret, $table);
        }
        return $ret;
    }
    public function getTableIndex($fhw){
        $i = 0;
        $ret = [];
        foreach ($this->table[$fhw] as $table=>$tname){
            $ret[$table] = $i;
            $i++;
        }
        return $ret;
    }
}