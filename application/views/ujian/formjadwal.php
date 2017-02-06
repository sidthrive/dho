<?php
    $page_header = "TAMBAH JADWAL TES BARU";
    $id_         = "";
    $user_       = "";
    $tes_   = "";
    $tanggal_     = "";
    
    if($jadwal!=null){
        $page_header = "EDIT JADWAL TES";
        $id_         = $jadwal->id;
        $user_    = $this->db->query("SELECT * FROM user WHERE id=".$jadwal->id_user)->row()->nama_lengkap;
        $tes_     = $this->db->query("SELECT * FROM jenis_tes WHERE id=".$jadwal->id_jenis)->row()->nama_tes;
        $tanggal_    = date("d-m-Y", strtotime($jadwal->tanggal_tes));
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
        <form action="<?=base_URL()?>ujian/setjadwaltes" method="post">
            <input type="hidden" name="mode" value="<?=$mode?>"/>
            <input type="hidden" name="id" value="<?=$id_?>"/>
            <?php echo $this->session->flashdata("pass");?>
            <table style="width: 100%">
                <tr>
                    <td>User</td><td>
                        <?php $data_user = array(); if(empty($user)){?>
                        Belum ada user <a href="<?=base_url()."ujian/user/new"?>" class="btn btn-primary">Tambah User</a>    
                        <?php }else{?>
                        <input id="data_user" type="text" name="user" required class="form-control" placeholder="Ketik Nama User ..." value="<?=$user_?>">
                        <?php foreach($user as $u){
                            array_push($data_user, $u->nama_lengkap);
                        } ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Tes</td><td>
                        <?php $data_tes = array(); if(empty($tes)){?>
                        Belum ada tes <a href="<?=base_url()."ujian/tes/new"?>" class="btn btn-primary">Tambah Tes</a>    
                        <?php }else{ ?>
                        <input id="data_tes" type="text" name="tes" required class="form-control" placeholder="Ketik Nama Tes ..." value="<?=$tes_?>">
                        <?php foreach($tes as $t){
                            array_push($data_tes, $t->nama_tes);
                        } ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Tes</td><td><input type="text" name="tanggal_tes" id="date_picker" required class="form-control" placeholder="dd-mm-yyyy" value="<?=$tanggal_?>"></td>
                </tr>
            </table>
            <div><button type="submit" class="btn btn-success">SIMPAN</button></div>
        </form>
    </div>
</div>
</div>
<script>
    $(function() {
        var data_user = <?=json_encode($data_user)?>;
        var data_tes = <?=json_encode($data_tes)?>;
        $( "#data_user" ).autocomplete({
            minLength:0,   
            delay:500,   
            source: data_user
        });
        $( "#data_tes" ).autocomplete({
            minLength:0,   
            delay:500,   
            source: data_tes
        });
    });
</script>