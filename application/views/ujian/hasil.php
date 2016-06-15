<div id="content">
    <div id="text">
        <h3>Detail Hasil Tes</h3>
        <br>
        <table>
            <tr>
                <td>Nama Peserta</td><td>: <?=$hasil['user']->nama_lengkap?></td>
            </tr>
            <tr>
                <td>Jenis Tes</td><td>: <?=$hasil['jenis']->nama_tes?></td>
            </tr>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <hr class="divider">
    <div id="container">
        <?php foreach($hasil['soal'] as $x=>$soal){ 
            $jawaban = $hasil['jawaban'][$x];
            ?>
        <div>
            <h3>Tes ke-<?=$x+1?></h3>
        </div>
        <br>
        <table class="table table-bordered table-hover table-data">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th colspan="2">Soal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($soal)) {
                        echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Belum ada soal--</td></tr>";
                } else {
                    $no = 1;
                    foreach ($soal as $y=>$p) {
                ?>
                <tr class="data" style="img{width: 50px}">
                    <td rowspan="6"><?=$no?></td>
                    <td colspan="2"><?=$p->pertanyaan?></td>
                </tr><tr<?php
                            if($p->jawaban=="a"&&$jawaban[$y]->jawaban=='a'){
                                echo ' style="background-color: lightgreen"';
                            }else{
                                if($p->jawaban=="a"){
                                    echo ' style="background-color: lightgoldenrodyellow"';
                                }elseif($jawaban[$y]->jawaban=='a'){
                                    echo ' style="background-color: lightcoral"';
                                }
                            }
                        ?>>
                    <td width="30px"><strong>A</strong></td>
                    <td><?=$p->pilihan_a?></td>
                </tr><tr<?php
                            if($p->jawaban=="b"&&$jawaban[$y]->jawaban=='b'){
                                echo ' style="background-color: lightgreen"';
                            }else{
                                if($p->jawaban=="b"){
                                    echo ' style="background-color: lightgoldenrodyellow"';
                                }elseif($jawaban[$y]->jawaban=='b'){
                                    echo ' style="background-color: lightcoral"';
                                }
                            }
                        ?>>
                    <td><strong>B</strong></td>
                    <td><?=$p->pilihan_b?></td>
                </tr><tr<?php
                            if($p->jawaban=="c"&&$jawaban[$y]->jawaban=='c'){
                                echo ' style="background-color: lightgreen"';
                            }else{
                                if($p->jawaban=="c"){
                                    echo ' style="background-color: lightgoldenrodyellow"';
                                }elseif($jawaban[$y]->jawaban=='c'){
                                    echo ' style="background-color: lightcoral"';
                                }
                            }
                        ?>>
                    <td><strong>C</strong></td>
                    <td><?=$p->pilihan_c?></td>
                </tr><tr<?php
                            if($p->jawaban=="d"&&$jawaban[$y]->jawaban=='d'){
                                echo ' style="background-color: lightgreen"';
                            }else{
                                if($p->jawaban=="d"){
                                    echo ' style="background-color: lightgoldenrodyellow"';
                                }elseif($jawaban[$y]->jawaban=='d'){
                                    echo ' style="background-color: lightcoral"';
                                }
                            }
                        ?>>
                    <td><strong>D</strong></td>
                    <td><?=$p->pilihan_d?></td>
                </tr><tr<?php
                            if($p->jawaban=="e"&&$jawaban[$y]->jawaban=='e'){
                                echo ' style="background-color: lightgreen"';
                            }else{
                                if($p->jawaban=="e"){
                                    echo ' style="background-color: lightgoldenrodyellow"';
                                }elseif($jawaban[$y]->jawaban=='e'){
                                    echo ' style="background-color: lightcoral"';
                                }
                            }
                        ?>>
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
        <br><br>
        <?php } ?>
    </div>
</div>