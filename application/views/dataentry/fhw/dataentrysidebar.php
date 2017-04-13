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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal'||$this->uri->segment(2)=='bidanontimesubmission')?' in':''?>">
                    <div class="panel panel-default">
                        <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbyform"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='bidanbyform')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Total Entry Tiap From
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbytanggal"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='bidanbytanggal')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                Total Entry Tiap Tanggal
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanontimesubmission"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='bidanontimesubmission')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                On Time Submission
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="gizis">
                <a data-toggle="collapse" data-parent="#accordion" href="#gizi_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Gizi
                    </h4>
                </div>
                </a>
                <div id="gizi_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='gizibyform'||$this->uri->segment(2)=='gizibytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='gizibyform')?' style="background-color:#909090"':''?>>
                        <a data-parent="#gizis" href="<?php echo site_url() ."dataentry/gizibyform"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap From
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='gizibytanggal')?' style="background-color:#909090"':''?>>
                        <a data-parent="#gizis" href="<?php echo site_url() ."dataentry/gizibytanggal"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap Tanggal
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#gizis" href="<?php echo site_url() ."dataentry/giziontimesubmission"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='giziontimesubmission')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                On Time Submission
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="vaksinators">
                <a data-toggle="collapse" data-parent="#accordion" href="#vak_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Vaksinator
                    </h4>
                </div>
                </a>
                <div id="vak_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='vaksinatorbyform'||$this->uri->segment(2)=='vaksinatorbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='vaksinatorbyform')?' style="background-color:#909090"':''?>>
                        <a data-parent="#vaksinators" href="<?php echo site_url() ."dataentry/vaksinatorbyform"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap From
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='vaksinatorbytanggal')?' style="background-color:#909090"':''?>>
                        <a data-parent="#vaksinators" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap Tanggal
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#vaksinators" href="<?php echo site_url() ."dataentry/vaksinatorontimesubmission"?>">
                        <div class="panel-heading" <?=($this->uri->segment(2)=='vaksinatorontimesubmission')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                On Time Submission
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>