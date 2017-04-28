<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Indikator PWS</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."laporan/cakupanindikatorpws/".$kec?>" method="get">
            <label class="col-sm-2 control-label">Periode: </label>
            <select name="b" class="form-control-static">
                <option value="januari" <?=$bulan=="januari"?"selected":""?>>Januari</option>
                <option value="februari" <?=$bulan=="februari"?"selected":""?>>Februari</option>
                <option value="maret" <?=$bulan=="maret"?"selected":""?>>Maret</option>
                <option value="april" <?=$bulan=="april"?"selected":""?>>April</option>
                <option value="mei" <?=$bulan=="mei"?"selected":""?>>Mei</option>
                <option value="juni" <?=$bulan=="juni"?"selected":""?>>Juni</option>
                <option value="juli" <?=$bulan=="juli"?"selected":""?>>Juli</option>
                <option value="agustus" <?=$bulan=="agustus"?"selected":""?>>Agustus</option>
                <option value="september" <?=$bulan=="september"?"selected":""?>>September</option>
                <option value="oktober" <?=$bulan=="oktober"?"selected":""?>>Oktober</option>
                <option value="november" <?=$bulan=="november"?"selected":""?>>November</option>
                <option value="desember" <?=$bulan=="desember"?"selected":""?>>Desember</option>
            </select>
            <select name="t" class="form-control-static">
                <?php 
                $thn = date("Y");
                while($thn >= 2015){ ?>
                <option <?=$tahun==$thn?"selected":""?>><?=$thn?></option>
                <?php $thn--;} ?>
            </select>
            <button class="form-control-static">GO</button>
        </form>
    </div>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="K1 Akses">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Akses Ibu Hamil Kumulatif(K1)</h3>
                <div id="K1A" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="K4">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Ibu Hamil Kumulatif(K4)</h3>
                <div id="K4" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Maternal Tertangani">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Maternal Tertangani Kumulatif</h3>
                <div id="MT" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Fasilitas Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Persalinan dengan Fasilitas Kesehatan Kumulatif</h3>
                <div id="PDFK" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Tenaga Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Persalinan dengan Tenaga Kesehatan Kumulatif</h3>
                <div id="PDTK" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Nifas">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Nifas Kumulatif</h3>
                <div id="KN" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Neonatal 1 Kumulatif</h3>
                <div id="KNN1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Neonatal 3 Kumulatif</h3>
                <div id="KNN3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Maternal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Maternal Kumulatif</h3>
                <div id="KM" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Neonatal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Neonatal Kumulatif</h3>
                <div id="KNN" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Bayi">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Bayi Kumulatif</h3>
                <div id="KB" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Balita">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Balita Kumulatif</h3>
                <div id="KBLT" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>

    </div>
</div>
<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChartWithPlot(json);
</script>