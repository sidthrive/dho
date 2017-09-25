<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu HHH SCORE<span class="pull-right" id="slide-submenu">
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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='headscore'||(strpos($this->uri->segment(2),'trimester')!==false)||$this->uri->segment(2)=='heartscore'||$this->uri->segment(2)=='handscore')?' in':''?>">
                    <div class="panel panel-default">
                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/headscore"?>">
                        <div <?=($this->uri->segment(2)=='headscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                Head Score
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/handscore"?>">
                        <div <?=($this->uri->segment(2)=='handscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                Hand Score
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/heartscore"?>">
                        <div <?=($this->uri->segment(2)=='heartscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                Heart Score
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>