<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsEcTableModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $table =[
        'bidan'=> [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_kunjungan_anc_integrasi'=>'ANC Integrasi',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_penutupan_anc'=>'Penutupan ANC',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_kunjungan_neonatal'=>'Kunjungan Neonatal',
            'event_bidan_imunisasi_bayi'=>'Imunisasi Bayi',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak',
            'event_bidan_tambah_kb'=>'Tambah KB',
            'event_bidan_kohort_pelayanan_kb'=>'Pelayanan KB',
            'event_bidan_penutupan_kb'=>'Penutupan KB',
            'event_bidan_penutupan_ibu'=>'Penutupan Ibu',
            'event_bidan_tambah_bayi'=>'Tambah Bayi',
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