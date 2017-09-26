<div id="content">
    <div id="text">
        <h3>Daftar Soal</h3>
        <table>
            <tr>
                <td>Nama Tes</td><td>: <?=$tes->nama_tes?></td>
            </tr>
            <tr>
                <td>Jumlah Soal</td><td>: <?=$tes->jumlah_soal?></td>
            </tr>
            <tr>
                <td>Metode Tes</td><td>: <?=$tes->metode_tes?></td>
            </tr>
            <tr>
                <td>Keterangan</td><td>: <?=$tes->keterangan?></td>
            </tr>
        </table>
    </div>
    <br><br>
    <div>
        <form action="<?=base_URL()?>ujian/tes/soal/<?=$tes->id?>/upload" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_jenis" value="<?=$tes->id?>"/>
        <table>
            <tr>
                <td><a href="<?=base_URL()?>ujian/tes/soal/<?=$tes->id?>/new" class="add btn btn-primary btn-md" title="Tambah"><i class="icon-plus icon-white"> </i> Tambah Soal</a></td>
                <td style="width: 50%"><a href="<?=base_URL()?>assets/temp/soal_template.xlsx" class="add btn btn-success btn-md" title="Tambah" download><i class="icon-download icon-white"> </i> Download Template</a></td>
                <td><input type="file" name="xls" class="form-control-static"/></td>
                <td><button type="submit" class="add btn btn-primary btn-md"><i class="icon-plus icon-white" style="float: right"> </i> Upload Xls</button></td>
            </tr>
        </table>
        </form>
    </div>
    <br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th colspan="2">Soal</th>
                    <th width="5%">Kunci</th>
                    <th width="12%"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($soal)) {
                        echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Belum ada soal--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($soal as $p) {
                ?>
                <tr class="data" style="img{width: 50px}">
                    <td rowspan="6"><?=$no?></td>
                    <td colspan="2"><?=$p->pertanyaan?></td>
                    <td rowspan="6"><?=$p->jawaban?></td>
                    <td rowspan="6">
                        <div class="btn-group">
                            <a href="<?=base_URL()?>ujian/tes/soal/<?=$tes->id?>/edit/<?=$p->id?>" style="width: 50%" class="btn btn-warning btn-sm" title="Edit User"><i class="icon-edit icon-white"> </i> Edit</a>
                            <a href="<?=base_URL()?>ujian/tes/soal/<?=$tes->id?>/delete/<?=$p->id?>" style="width: 50%" class="delete btn btn-danger btn-sm" title="Hapus User" ><i class="icon-trash icon-remove">  </i> Del</a>
                        </div>
                    </td>
                </tr><tr<?=$p->jawaban=="a"?' style="background-color: lightgoldenrodyellow"':''?>>
                    <td width="30px"><strong>A</strong></td>
                    <td><?=$p->pilihan_a?></td>
                </tr><tr<?=$p->jawaban=="b"?' style="background-color: lightgoldenrodyellow"':''?>>
                    <td><strong>B</strong></td>
                    <td><?=$p->pilihan_b?></td>
                </tr><tr<?=$p->jawaban=="c"?' style="background-color: lightgoldenrodyellow"':''?>>
                    <td><strong>C</strong></td>
                    <td><?=$p->pilihan_c?></td>
                </tr><tr<?=$p->jawaban=="d"?' style="background-color: lightgoldenrodyellow"':''?>>
                    <td><strong>D</strong></td>
                    <td><?=$p->pilihan_d?></td>
                </tr><tr<?=$p->jawaban=="e"?' style="background-color: lightgoldenrodyellow"':''?>>
                    <td><strong>E</strong></td>
                    <td><?=$p->pilihan_e?></td>
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