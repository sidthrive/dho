<div id="page" class="container">
    <div id="sidebar1">
        <h2>Menu Sidebar</h2>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading" <?=($this->uri->segment(2)=='user')?' style="background-color:#909090"':''?>>
                    <h4 class="panel-title">
                        <a href="<?=base_url()?>ujian/user">User</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" <?=($this->uri->segment(2)=='tes')?' style="background-color:#909090"':''?>>
                    <h4 class="panel-title">
                        <a href="<?=base_url()?>ujian/tes">Tes</a>
                    </h4>
                </div>                    
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" <?=($this->uri->segment(2)=='jadwal')?' style="background-color:#909090"':''?>>
                    <h4 class="panel-title">
                        <a href="<?=base_url()?>ujian/jadwal">Jadwal Tes</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" <?=($this->uri->segment(2)=='hasil')?' style="background-color:#909090"':''?>>
                    <h4 class="panel-title">
                        <a href="<?=base_url()?>ujian/hasil">Hasil</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>