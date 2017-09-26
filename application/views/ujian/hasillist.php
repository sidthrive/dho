<div id="content">
    <div id="text">
        <h3>Daftar Hasil Tes</h3>
    </div>
    <br><br>
    <div>
        <ul class="nav navbar-nav navbar-right">
            <?php if($this->uri->segment(1)=='ujian'){ ?>
            <form class="navbar-form navbar-left" method="get" action="<?=base_URL()?>ujian/hasil/cari">
            <?php }elseif($this->uri->segment(1)=='hhhscore'){ ?>
            <form class="navbar-form navbar-left" method="get" action="<?=base_URL()?>hhhscore/headscore/cari">
            <?php } ?>
                <input type="text" class="form-control" name="q" style="width: 200px" placeholder="Masukkan Kata Kunci..." required>
                <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"> </i> Cari</button>
            </form>
        </ul>
    </div>
    <br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Nama Lengkap</th>
                    <th width="15%">Jenis Tes</th>
                    <th width="12%">Tanggal Tes</th>
                    <th width="15%">Waktu Selesai</th>
                    <th width="15%">Hasil</th>
                    <th width="8%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($hasil)) {
                        echo "<tr><td colspan='7'  style='text-align: center; font-weight: bold'>--Belum ada hasil--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($hasil as $p) {
                        if($p->aktif=='yes')continue;
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$this->UjianModel->getUser($p->id_user)->nama_lengkap?></td>
                    <td><?=$this->UjianModel->getJenisTes($p->id_jenis)->nama_tes?></td>
                    <td><?=date("d-m-Y", strtotime($p->tanggal_tes))?></td>
                    <td><?=$p->waktu_selesai==null?"Belum Selesai":date("d-m-Y H:i:s", strtotime($p->waktu_selesai))?></td>
                    <td><?=$this->UjianModel->getHasilPersen($p->id);?></td>
                    <td>
                        <div class="btn-group">
                            <?php if($this->uri->segment(1)=='ujian'&&$p->aktif=='no'){ ?>
                            <a href="<?=base_URL()?>ujian/hasil/lihat/<?=$p->id?>" style="width: 100%" class="btn btn-primary btn-sm" title="Lihat Hasil"><i class="icon-edit icon-white"> </i> Detail</a>
                            <?php }elseif($this->uri->segment(1)=='hhhscore'&&$p->aktif=='no'){ ?>
                            <a href="<?=base_URL()?>hhhscore/headscore/lihat/<?=$p->id?>" style="width: 100%" class="btn btn-primary btn-sm" title="Lihat Hasil"><i class="icon-edit icon-white"> </i> Detail</a>
                            <?php } ?>
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