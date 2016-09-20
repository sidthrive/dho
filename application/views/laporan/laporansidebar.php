<div id="page" class="container">
    <div id="sidebar1">
        <h2>Menu Laporan</h2>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">Bidan</a>
                    </h4>
                </div>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanindikatorpws'||$this->uri->segment(2)=='downloadbidanpws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#bidan_menu" href="#bidan_month">Cakupan Indikator PWS</a>
                                </h4>
                            </div>
                            <div id="bidan_month" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanindikatorpws')?' in':''?>">
                                <div class="panel panel-default">
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='januari')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/januari"?>">Januari</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='februari')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/februari"?>">Februari</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='maret')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/maret"?>">Maret</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='april')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/april"?>">April</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='mei')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/mei"?>">Mei</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='juni')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/juni"?>">Juni</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='juli')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/juli"?>">Juli</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='agustus')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/agustus"?>">Agustus</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='september')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/september"?>">September</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='oktober')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/oktober"?>">Oktober</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='november')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/november"?>">November</a>
                                        </h4>
                                    </div>
                                    <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws'&&$this->uri->segment(3)=='desember')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws/desember"?>">Desember</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadbidanpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadbidanpws"?>">Download PWS</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Gizi</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupangizi'||$this->uri->segment(2)=='downloadgizipws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#collapse2" href="#gizi_cov">Cakupan Gizi</a>
                            </h4>
                        </div>
                        <div id="gizi_cov" class="panel-collapse collapse<?=$this->uri->segment(2)=='cakupangizi'?' in':''?>">
                            <div class="panel panel-default">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupangizi')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a href="<?php echo site_url() ."laporan/cakupangizi"?>">Bulan ini</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadgizipws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadgizipws"?>">Download PWS</a>
                            </h4>
                        </div>
                    </div>
                </div>
                    
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Vaksinator</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanpwsvaksinator'||$this->uri->segment(2)=='downloadvaksinatorpws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#collapse3" href="#vac_cov">Cakupan Imunisasi</a>
                            </h4>
                        </div>
                        <div id="vac_cov" class="panel-collapse collapse<?=$this->uri->segment(2)=='cakupanpwsvaksinator'?' in':''?>">
                            <div class="panel panel-default">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='bulanini')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/bulanini"?>">Bulan ini</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='akumulatifbulanini')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/akumulatifbulanini"?>">Akumulatif Bulan ini</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='bulaninivsbulanlalu')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/bulaninivsbulanlalu"?>">Bulan ini vs Bulan lalu</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#vac_cov" href="#vac_month">Tahun ini vs Tahun lalu</a>
                                    </h4>
                                </div>
                                <div id="vac_month" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='tahuninivstahunlalu')?' in':''?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='januari')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/januari"?>">Januari</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='februari')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/februari"?>">Februari</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='maret')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/maret"?>">Maret</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='april')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/april"?>">April</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='mei')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/mei"?>">Mei</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='juni')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/juni"?>">Juni</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='juli')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/juli"?>">Juli</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='agustus')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/agustus"?>">Agustus</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='september')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/september"?>">September</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='oktober')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/oktober"?>">Oktober</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='november')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/november"?>">November</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(4)=='desember')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/desember"?>">Desember</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadvaksinatorpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadvaksinatorpws"?>">Download PWS</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>