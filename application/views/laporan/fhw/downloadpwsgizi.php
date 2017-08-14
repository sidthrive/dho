<div id="content">    
    <div id="text" style="text-align: center;">
        <h3>Download PWS Gizi</h3>
    </div><br><br><br>
    <div id="container" style="text-align: center;">
        <form action="<?php echo site_url()."laporan/downloadpwsgizi"?>" method="post">
            <div id="option" class="form">
                <select name="year" style="width:120px;" class="form-control-static">
                    <?php 
                    $thn = date("Y");
                    while($thn >= 2015){ ?>
                    <option><?=$thn?></option>
                    <?php $thn--;} ?>
                </select>
                <select name="month" style="width:120px;" class="form-control-static">
                    <option value="januari">Januari</option>
                    <option value="februari">Februari</option>
                    <option value="maret">Maret</option>
                    <option value="april">April</option>
                    <option value="mei">Mei</option>
                    <option value="juni">Juni</option>
                    <option value="juli">Juli</option>
                    <option value="agustus">Agustus</option>
                    <option value="september">September</option>
                    <option value="oktober">Oktober</option>
                    <option value="november">November</option>
                    <option value="desember">Desember</option>
                </select>
            </div>
            <br/>
            <br/>
            <?php echo $this->session->flashdata("file");?>
            <br/>
            <div id="sadasd">
                <button class="btn btn-success" type="submit">DOWNLOAD</button>
            </div>
        </form>

    </div>
</div>