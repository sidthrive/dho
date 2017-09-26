<div id="content">
    <div id="text">
        <h3>Daftar User</h3>
    </div>
    <br><br>
    <div>
        <a href="<?=base_URL()?>ujian/user/new" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah User</a>
        <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left" method="get" action="<?=base_URL()?>ujian/user/cari">
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
                    <th width="15%">Username</th>
                    <th width="12%">Password</th>
                    <th width="12%">Email</th>
                    <th width="10%">Kontak</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($user)) {
                        echo "<tr><td colspan='7'  style='text-align: center; font-weight: bold'>--Belum ada user--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($user as $p) {
                ?>
                <tr class="data">
                    <td><?=$no?></td>
                    <td><?=$p->nama_lengkap?></td>
                    <td><?=$p->username?></td>
                    <td><?=$p->password?></td>
                    <td><?=$p->email?></td>
                    <td><?=$p->kontak?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?=base_URL()?>ujian/user/edit/<?=$p->id?>" style="width: 50%" class="btn btn-warning btn-sm" title="Edit User"><i class="icon-edit icon-white"> </i> Edit</a>
                            <a href="<?=base_URL()?>ujian/user/delete/<?=$p->id?>" style="width: 50%" class="delete btn btn-danger btn-sm" title="Hapus User" ><i class="icon-trash icon-remove">  </i> Del</a>
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