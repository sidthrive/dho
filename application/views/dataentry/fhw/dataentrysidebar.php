<div id="page" class="container">
    <div id="sidebar1">
        <h2>Menu Laporan</h2>
        <div class="panel-group" id="accordion">
            <?php if($this->session->userdata('tipe')=="bidan"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">Bidan</a>
                    </h4>
                </div>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbyform')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbyform"?>">Total Entry Tiap From</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbytanggal')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbytanggal"?>">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="gizis">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#gizi_menu">Gizi</a>
                    </h4>
                </div>
                <div id="gizi_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='gizibyform'||$this->uri->segment(2)=='gizibytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='gizibyform')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#gizis" href="<?php echo site_url() ."dataentry/gizibyform"?>">Total Entry Tiap From</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='gizibytanggal')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#gizis" href="<?php echo site_url() ."dataentry/gizibytanggal"?>">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="vaksinators">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#vak_menu">Vaksinator</a>
                    </h4>
                </div>
                <div id="vak_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='vaksinatorbyform'||$this->uri->segment(2)=='vaksinatorbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='vaksinatorbyform')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#vaksinators" href="<?php echo site_url() ."dataentry/vaksinatorbyform"?>">Total Entry Tiap From</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='vaksinatorbytanggal')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#vaksinators" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal"?>">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>