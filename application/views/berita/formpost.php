<?php
    $page_header = "TAMBAH BERITA BARU";
    $id     = "";
    $judul  = "";
    $isi    = "";
    if($post!=null){
        $page_header = "EDIT BERITA";
        $id     = $post->id;
        $judul  = $post->post_title;
        $isi    = $post->post_content;
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
        <form action="<?=base_URL()?>berita/setpost" method="post">
            <input type="hidden" name="mode" value="<?=$mode?>"/>
            <input type="hidden" name="id" value="<?=$id?>"/>
            <div style="margin-bottom: 30px"><input type="text" name="judul" required style="width: 100%;font-size:25px;height: 50px" autofocus class="form-control" placeholder="Judul Berita" value="<?=$judul?>"></div>
            <div style="margin-bottom: 30px"><textarea id="textarea" name="isi"><?=$isi?></textarea></div>
            <div><button type="submit" class="btn btn-success">SIMPAN</button></div>
        </form>
    </div>
</div>
</div>
<script src="<?php echo base_url() ?>assets/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#textarea',height : 250 });</script>