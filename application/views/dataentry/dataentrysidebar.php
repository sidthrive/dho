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
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?> class="panel-heading<?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Janapria')?' active':''?>">
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#bidans" href="#by_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="by_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanbytanggal'?' in':''?>">
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
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
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?> class="panel-heading<?=($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)=='Janapria')?' active':''?>">
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#gizis" href="#giziby_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="giziby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizibytanggal'?' in':''?>">
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
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
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?> class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div <?=($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?> class="panel-heading<?=($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)=='Janapria')?' active':''?>">
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#vaksinators" href="#vaksinatorby_date">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                        <div id="vaksinatorby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinatorbytanggal'?' in':''?>">
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/Sengkol"?>">Puskesmas Sengkol</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)=='Sengkol'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/Sengkol/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default panel-collapse">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/Janapria"?>">Puskesmas Janapria</a>
                                    </h4>
                                </div>
                                <?php if($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)=='Janapria'){ ?>
                                <div class="panel panel-default">
                                    <?php foreach($data as $user => $form){
                                    ?>
                                    <div class="panel-heading" <?=($this->uri->segment(4)==ucwords($user))?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/Janapria/".ucwords($user)?>">Desa <?=ucwords($user)?></a>
                                        </h4>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>