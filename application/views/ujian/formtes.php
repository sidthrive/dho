<?php
    $page_header = "TAMBAH TES BARU";
    $id_         = "";
    $nama_       = "";
    $jml_soal_   = "";
    $jml_tes_   = "";
    $waktu_   = "";
    $metode_     = "";
    $ket_        = "";
    
    if($tes!=null){
        $page_header = "EDIT TES";
        $id_         = $tes->id;
        $nama_       = $tes->nama_tes;
        $jml_soal_   = $tes->jumlah_soal;
        $jml_tes_   = $tes->jumlah_tes;
        $waktu_   = $tes->waktu;
        $metode_   = $tes->metode_tes;
        $ket_      = $tes->keterangan;
    }

?>

<div id="content">
    <div id="text">
        <h3><?=$page_header?></h3>
    </div>
    <br><br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <form action="<?=base_URL()?>ujian/settes" method="post">
            <input type="hidden" name="mode" value="<?=$mode?>"/>
            <input type="hidden" name="id" value="<?=$id_?>"/>
            <?php echo $this->session->flashdata("pass");?>
            <table style="width: 100%">
                <tr>
                    <td>Nama Tes</td><td><input type="text" name="nama" required autofocus class="form-control" placeholder="Masukkan Nama Tes" value="<?=$nama_?>"></td>
                </tr>
                <tr>
                    <td>Jumlah Soal</td><td><input type="number" name="jml_soal" required class="form-control" placeholder="Masukkan Jumlah Soal" value="<?=$jml_soal_?>"></td>
                </tr>
                <tr>
                    <td>Jumlah Tes</td><td><input type="number" name="jml_tes" required class="form-control" placeholder="Masukkan Jumlah Tes" value="<?=$jml_tes_?>"></td>
                </tr>
                <tr>
                    <td>Waktu</td><td><input type="number" name="waktu" required class="form-control" placeholder="Masukkan Lama Tes" value="<?=$waktu_?>"></td>
                </tr>
                <tr>
                    <td>Metode Tes</td><td><input type="text" name="metode" required class="form-control" placeholder="Masukkan Metode Tes" value="<?=$metode_?>"></td>
                </tr>
                <tr>
                    <td>Keterangan</td><td><input type="text" name="ket" class="form-control" placeholder="Masukkan Keterangan Tambahan" value="<?=$ket_?>"></td>
                </tr>
            </table>
            <div><button type="submit" class="btn btn-success">SIMPAN</button></div>
        </form>
    </div>
</div>
</div>