<?php
    $page_header = "TAMBAH SOAL BARU";
    $id_         = "";
    $id_tes      = $tes->id;
    $pertanyaan_       = "";
    $a_   = "";
    $b_   = "";
    $c_   = "";
    $d_   = "";
    $e_   = "";
    $jawaban = "";
    
    if($soal!=null){
        $page_header = "EDIT SOAL";
        $id_         = $soal->id;
        $id_tes      = $tes->id;
        $pertanyaan_       = $soal->pertanyaan;
        $a_   = $soal->pilihan_a;
        $b_   = $soal->pilihan_b;
        $c_   = $soal->pilihan_c;
        $d_   = $soal->pilihan_d;
        $e_   = $soal->pilihan_e;
        $jawaban = $soal->jawaban;
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
        <form action="<?=base_URL()?>ujian/setsoal" method="post">
            <input type="hidden" name="mode" value="<?=$mode2?>"/>
            <input type="hidden" name="id" value="<?=$id_?>"/>
            <input type="hidden" name="id_tes" value="<?=$id_tes?>"/>
            <?php echo $this->session->flashdata("pass");?>
            <table style="width: 100%">
                <tr>
                    <td>Pertanyaan</td><td><textarea class="soal" name="pertanyaan"><?=$pertanyaan_?></textarea></td>
                </tr>
                <tr>
                    <td>Pilihan A</td><td><textarea class="soal" name="a"><?=$a_?></textarea></td>
                </tr>
                <tr>
                    <td>Pilihan B</td><td><textarea class="soal" name="b"><?=$b_?></textarea></td>
                </tr>
                <tr>
                    <td>Pilihan C</td><td><textarea class="soal" name="c"><?=$c_?></textarea></td>
                </tr>
                <tr>
                    <td>Pilihan D</td><td><textarea class="soal" name="d"><?=$d_?></textarea></td>
                </tr>
                <tr>
                    <td>Pilihan E</td><td><textarea class="soal" name="e"><?=$e_?></textarea></td>
                </tr>
                <tr>
                    <td>Jawaban</td><td>
                        <select name="jawaban" class="form-control">
                            <option value="a"<?=$jawaban=='a'?' selected':''?>>A</option>
                            <option value="b"<?=$jawaban=='b'?' selected':''?>>B</option>
                            <option value="c"<?=$jawaban=='c'?' selected':''?>>C</option>
                            <option value="d"<?=$jawaban=='d'?' selected':''?>>D</option>
                            <option value="e"<?=$jawaban=='e'?' selected':''?>>E</option>
                            
                        </select>
                    </td>
                </tr>
                <tr style="margin-top: 30px;">
                    <td></td><td><div><button type="submit" class="btn btn-success">SIMPAN</button></div></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<script src="<?php echo base_url() ?>assets/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({ 
        selector:'.soal',
        height : 100,
        relative_urls: false,
        plugins:["advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"],
        external_filemanager_path:"<?php echo base_url() ?>assets/filemanager/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "<?php echo base_url() ?>assets/filemanager/plugin.min.js"}
            });
 </script>