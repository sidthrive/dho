<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu Laporan<span class="pull-right" id="slide-submenu">
                <i class="glyphicon glyphicon-remove-sign"></i>
            </span></h2>
        <div class="panel-group" id="accordion">
            <?php if($this->session->userdata('tipe')=="bidan"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="bidans">
                <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Bidan
                    </h4>
                </div>
                </a>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanindikatorpws'||$this->uri->segment(2)=='downloadbidanpws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel panel-default">
                            <a href="<?php echo site_url() ."laporan/cakupanindikatorpws"?>">
                            <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanindikatorpws')?' style="background-color:#909090"':''?>>
                                <h4 class="panel-title">
                                    Cakupan Indikator PWS
                                </h4>
                            </div>
                            </a>
                        </div>
                        <a href="<?php echo site_url() ."laporan/downloadbidanpws"?>">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadbidanpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Download PWS
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Gizi
                    </h4>
                </div>
                </a>
                <div id="collapse2" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupangizi'||$this->uri->segment(2)=='downloadgizipws')?' in':''?>">
                    <div class="panel panel-default">
                        <a href="<?php echo site_url() ."laporan/cakupangizi"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='cakupangizi')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Cakupan Gizi
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a href="<?php echo site_url() ."laporan/downloadgizipws"?>">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadgizipws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Download PWS
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
                    
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Vaksinator
                    </h4>
                </div>
                </a>
                <div id="collapse3" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanpwsvaksinator'||$this->uri->segment(2)=='downloadvaksinatorpws')?' in':''?>">
                    <div class="panel panel-default">
                        <a data-toggle="collapse" data-parent="#collapse3" href="#vac_cov">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Cakupan Imunisasi
                            </h4>
                        </div>
                        </a>
                        <div id="vac_cov" class="panel-collapse collapse<?=$this->uri->segment(2)=='cakupanpwsvaksinator'?' in':''?>">
                            <div class="panel panel-default">
                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/bulanini"?>">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='bulanini')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        Bulan ini
                                    </h4>
                                </div>
                                </a>
                            </div>
                            <div class="panel panel-default">
                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/akumulatifbulanini"?>">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='akumulatifbulanini')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        Akumulatif Bulan ini
                                    </h4>
                                </div>
                                </a>
                            </div>
                            <div class="panel panel-default">
                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/bulaninivsbulanlalu"?>">
                                <div class="panel-heading" <?=($this->uri->segment(2)=='cakupanpwsvaksinator'&&$this->uri->segment(3)=='bulaninivsbulanlalu')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        Bulan ini vs Bulan lalu
                                    </h4>
                                </div>
                                </a>
                            </div>
                            <div class="panel panel-default">
                                <a href="<?php echo site_url() ."laporan/cakupanpwsvaksinator/tahuninivstahunlalu/januari"?>">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        Tahun ini vs Tahun lalu
                                    </h4>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <a href="<?php echo site_url() ."laporan/downloadvaksinatorpws"?>">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadvaksinatorpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Download PWS
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>