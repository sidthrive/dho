<div id="content">
    <div id="text">
        <h3>Daftar Jadwal Tes</h3>
    </div>
    <br><br>
    <div>
        <a href="<?=base_URL()?>ujian/jadwal/new" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah Jadwal Tes</a>
        <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left" method="get" action="<?=base_URL()?>ujian/jadwal/cari">
                <input type="text" class="form-control" name="q" style="width: 200px" placeholder="Masukkan Kata Kunci..." required>
                <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"> </i> Cari</button>
            </form>
        </ul>
    </div>
    <br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container" style="font-size: 10pt">
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Nama Lengkap</th>
                    <th>Link Tes</th>
                    <th width="15%">Jenis Tes</th>
                    <th width="12%">Tanggal Tes</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($jadwal)) {
                        echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Belum ada jadwal--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($jadwal as $p) {
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$this->UjianModel->getUser($p->id_user)->nama_lengkap?></td>
                    <td><a><?=base_url()."sertifikasi/do_ujian/".$p->token?></a></td>
                    <td><?=$this->UjianModel->getJenisTes($p->id_jenis)->nama_tes?></td>
                    <td><?=date("d-m-Y", strtotime($p->tanggal_tes))?></td>
                    <td>
                        <?php if($p->aktif=='yes'){ ?>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>ujian/jadwal/edit/<?=$p->id?>" style="width: 100%" class="btn btn-warning btn-sm" title="Edit User"><i class="icon-edit icon-white"> </i> Edit</a>
                        </div>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>ujian/jadwal/delete/<?=$p->id?>" style="width: 100%" class="delete btn btn-danger btn-sm" title="Hapus User" ><i class="icon-trash icon-remove">  </i> Del</a>
                        </div>
                        <?php } ?>
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