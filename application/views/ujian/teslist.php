<div id="content">
    <div id="text">
        <h3>Daftar Tes</h3>
    </div>
    <br><br>
    <div>
        <a href="<?=base_URL()?>ujian/tes/new" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah Tes</a>
        <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left" method="get" action="<?=base_URL()?>ujian/tes/cari">
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
                    <th>Nama Tes</th>
                    <th width="15%">Jumlah Soal</th>
                    <th width="12%">Jumlah Tes</th>
                    <th>Waktu</th>
                    <th width="12%">Metode Tes</th>
                    <th>Keterangan</th>
                    <th width="12%">Soal</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($tes)) {
                        echo "<tr><td colspan='6'  style='text-align: center; font-weight: bold'>--Belum ada user--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($tes as $p) {
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$p->nama_tes?></td>
                    <td><?=$p->jumlah_soal?></td>
                    <td><?=$p->jumlah_tes?></td>
                    <td><?=$p->waktu?></td>
                    <td><?=$p->metode_tes?></td>
                    <td><?=$p->keterangan?></td>
                    <td><a href="<?=base_URL()?>ujian/tes/soal/<?=$p->id?>" style="width: 100%" class="btn btn-primary btn-sm" title="Lihat Soal"><i class="icon-paper-clip icon-white"> </i> Lihat Soal</a></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>ujian/tes/edit/<?=$p->id?>" style="width: 50%" class="btn btn-warning btn-sm" title="Edit User"><i class="icon-edit icon-white"> </i> Edit</a>
                            <a href="<?=base_URL()?>ujian/tes/delete/<?=$p->id?>" style="width: 50%" class="delete btn btn-danger btn-sm" title="Hapus User" ><i class="icon-trash icon-remove">  </i> Del</a>
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