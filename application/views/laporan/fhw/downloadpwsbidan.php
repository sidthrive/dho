<div id="content">    
    <div id="text" style="text-align: center;">
        <h3>Download PWS</h3>
    </div>
    <div id="container" style="text-align: center;">
        <form action="<?php echo site_url()."laporan/download"?>" method="post">
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
                    <option value="bayi_1">Bayi 1</option>
                    <option value="bayi_2">Bayi 2</option>
                    <option value="bayi_3">Bayi 3</option>
                    <option value="bayi_4">Bayi 4</option>
                    <option value="balita_1">Balita 1</option>
                    <option value="balita_2">Balita 2</option>
                    <option value="balita_3">Balita 3</option>
                    <option value="balita_4">Balita 4</option>
                    <option value="anak_1">Anak 1</option>
                    <option value="anak_2">Anak 2</option>
                    <option value="anak_3">Anak 3</option>
                    <option value="anak_4">Anak 4</option>
                    <option value="neonatal1">Neonatal 1</option>
                    <option value="neonatal2">Neonatal 2</option>
                    <option value="neonatal3">Neonatal 3</option>
                    <option value="neonatal4">Neonatal 4</option>
                    <option value="neonatal5">Neonatal 5</option>
                    <option value="kb1">KB 1</option>
                    <option value="kb2">KB 2</option>
                    <option value="kb3">KB 3</option>
                    <option value="kb4">KB 4</option>
                    <option value="kb5">KB 5</option>
                    <option value="amp">Maternal</option>
                    <option value="akb">Analisa Kematian Bayi</option>
                    <option value="kih">Kelas Ibu Hamil</option>
                    <option value="p4k">P4K</option>
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