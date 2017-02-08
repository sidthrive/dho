<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu Laporan
            <span class="pull-right" id="slide-submenu">
                <i class="glyphicon glyphicon-remove-sign"></i>
            </span></h2>
        <div class="panel-group" id="accordion">
            <?php if($this->session->userdata('tipe')=="bidan"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">Bidan</a>
                    </h4>
                </div>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#bidans" href="#by_form">Total Entry Tiap From</a>
                            </h4>
                        </div>
                        <div id="by_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanbyform'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/".$kec?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/".$kec."/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#bidans" href="#by_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="by_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanbytanggal'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/".$kec?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/".$kec."/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="gizis">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#gizi_menu">Gizi</a>
                    </h4>
                </div>
                <div id="gizi_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='gizibyform'||$this->uri->segment(2)=='gizibytanggal')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#gizis" href="#giziby_form">Total Entry Tiap From</a>
                            </h4>
                        </div>
                        <div id="giziby_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizibyform'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/".$kec?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/".$kec."/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#gizis" href="#giziby_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="giziby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizibytanggal'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/".$kec?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/".$kec."/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="vaksinators">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#vaksinator_menu">Vaksinator</a>
                    </h4>
                </div>
                <div id="vaksinator_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='vaksinatorbyform'||$this->uri->segment(2)=='vaksinatorbytanggal')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#vaksinators" href="#vaksinatorby_form">Total Entry Tiap From</a>
                            </h4>
                        </div>
                        <div id="vaksinatorby_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinatorbyform'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/$kec"?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/$kec/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#vaksinators" href="#vaksinatorby_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="vaksinatorby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinatorbytanggal'?' in':''?>">
                            <?php
                            foreach($location as $kec=>$desas){
                            ?>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/$kec"?>">Puskesmas <?=$kec?></a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($desas as $user => $desa){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/$kec/".ucwords($desa)?>">Desa <?=ucwords($desa)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>