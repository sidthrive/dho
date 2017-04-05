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
        </div>
    </div>