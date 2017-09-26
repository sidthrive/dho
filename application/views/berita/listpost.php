<div id="content">
    <div id="text">
        <h3>Daftar Berita</h3>
    </div>
    <br><br>
    <div>
        <a href="<?=base_URL()?>berita/post/new/0/berita" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah Berita</a>
    </div>
    <br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Judul Berita</th>
                    <th width="15%">Author</th>
                    <th width="20%">Tanggal Publish</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($berita)) {
                        echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Belum ada berita--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($berita as $p) {
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$p->post_title?></td>
                    <td><?=$p->post_author?></td>
                    <td><?=$p->post_date?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>berita/post/edit/<?=$p->id?>" style="width: 50%" class="btn btn-warning btn-sm" title="Edit Berita"><i class="icon-edit icon-white"> </i> Edit</a>
                            <a href="<?=base_URL()?>berita/post/delete/<?=$p->id?>" style="width: 50%" class="delete btn btn-danger btn-sm" title="Hapus Berita" ><i class="icon-trash icon-remove">  </i> Del</a>
                        </div>
                    </td>
                </tr>
                <?php
                    $no++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <div>
        <h3>Daftar Artikel</h3>
    </div>
    <br><br>
    <div>
        <a href="<?=base_URL()?>berita/post/new/0/artikel" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah Artikel</a>
    </div>
    <br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Judul Artikel</th>
                    <th width="15%">Author</th>
                    <th width="20%">Tanggal Publish</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($artikel)) {
                        echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Belum ada artikel--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($artikel as $p) {
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$p->post_title?></td>
                    <td><?=$p->post_author?></td>
                    <td><?=$p->post_date?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>berita/post/edit/<?=$p->id?>" style="width: 50%" class="btn btn-warning btn-sm" title="Edit Berita"><i class="icon-edit icon-white"> </i> Edit</a>
                            <a href="<?=base_URL()?>berita/post/delete/<?=$p->id?>" style="width: 50%" class="delete btn btn-danger btn-sm" title="Hapus Berita" ><i class="icon-trash icon-remove">  </i> Del</a>
                        </div>
                    </td>
                </tr>
                <?php
                    $no++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="navbar" id="del" title="Konfirmasi Hapus">Apakah Anda Yakin?</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#del").hide();
    });
    $(".delete").click(function(e){
        var link = this;
        e.preventDefault();
        $("#del").dialog({
            draggable: false,
            resizeable : false,
            modal : true,
            buttons : {
                "Ya" : function (){
                    window.open($(link).attr("href"),"_self");
                    $(this).dialog("close");
                },
                "Tidak" : function (){
                    $(this).dialog("close");
                }
            }
        });
    });
</script>