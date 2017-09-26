<div id="content">    
    <div id="text" style="text-align: center;">
        <h3>Download PWS</h3>
    </div>
    <div id="container" style="text-align: center;">
        <form action="<?php echo site_url()."laporan/download"?>" method="post">
            <div id="option" class="form">
                <select name="kecamatan" style="width:120px;" class="form-control-static">
                    <?php foreach($location as $kec=>$loc){ ?>
                    <option value="<?=$kec?>"><?=$kec?></option>
                    <?php } ?>
                </select>
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
                    <option value="maret" selected>Maret</option>
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
                <select name="formtype" style="width:120px;" class="form-control-static">
                    <option value="KIA" selected>KIA Ibu</option>
                    <option value="anak">KIA ANAK</option>
                    <option value="kb">KB</option>
                    <option value="bayi">Laporan Kasus Kesakitan dan Kematian Bayi</option>
                    <option value="balita">Laporan Kasus Kesakitan dan Kematian Balita</option>
                    <option value="neonatal">Laporan Kasus Kesakitan dan Kematian Neonatal</option>
                    <option value="maternal">Laporan Kasus Kesakitan dan Kematian Ibu</option>
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