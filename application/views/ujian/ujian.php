<div id="contentujian">
    <div id="titleujian" style="text-align: center;">
        <h3><?=$jenis_tes->nama_tes?></h3>
    </div>
    <div id="isiujian" style="text-align:justified;">
        <form method="post" action="<?=base_url()?>sertifikasi/saveujian">
            <input type="hidden" name="id_tes" value="<?=$on_going->id_tes?>" />
            <input type="hidden" name="tes_ke" value="<?=$on_going->tes_ke?>" />
            <input type="hidden" name="token" value="<?=$ujian->token?>" />
            <table style="width: 100%" class="soal table">
                <?php 
                $no_soal = 1;
                foreach ($soal as $index=>$s){ ?>
                <tr>
                    <td style="width: 30px"><?=$no_soal?>.</td>
                    <td colspan="2"><?=$s->pertanyaan?></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 80px"><input value="a" type="radio" name="<?=$s->id?>" <?=($jawaban[$index]->jawaban=='a')?"checked":""?>/> &nbsp;A. </td>
                    <td><?=$s->pilihan_a?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input value="b" type="radio" name="<?=$s->id?>" <?=($jawaban[$index]->jawaban=='b')?"checked":""?>/>&nbsp; B. </td>
                    <td><?=$s->pilihan_b?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input value="c" type="radio" name="<?=$s->id?>" <?=($jawaban[$index]->jawaban=='c')?"checked":""?>/>&nbsp; C. </td>
                    <td><?=$s->pilihan_c?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input value="d" type="radio" name="<?=$s->id?>" <?=($jawaban[$index]->jawaban=='d')?"checked":""?>/>&nbsp; D. </td>
                    <td><?=$s->pilihan_d?></td>
                </tr>
                <?php if($s->pilihan_e!=""){ ?>
                <tr>
                    <td></td>
                    <td><input value="e" type="radio" name="<?=$s->id?>" <?=($jawaban[$index]->jawaban=='e')?"checked":""?>/>&nbsp; E. </td>
                    <td><?=$s->pilihan_e?></td>
                </tr>
                <?php } ?>
                <tr><td colspan="3" style="padding-bottom: 30px"></td></tr>
                <?php $no_soal++; }  ?>
                <tr><td colspan="3" style="text-align: center"><button type="submit" class="btn btn-lg btn-danger" style="height: 40px">KIRIM JAWABAN</button></td></tr>
            </table>
        </form>
    </div>
</div>
<div id='timercontainer'>
    <div id='timer'></div>
</div>

<script>
var waktu_start = "<?=$on_going->waktu_start?>";
if(waktu_start==="0000-00-00 00:00:00"){
    $.post("<?=base_url()?>sertifikasi/savewaktu",
    {
        id_tes: <?=$on_going->id_tes?>,
        tes_ke: <?=$on_going->tes_ke?>,
        waktu_start: moment().format("YYYY/MM/DD HH:mm:ss")
    }).fail(function(response) {
        console.log('Error: ' + response.responseText);
    });
    $('#timer').countdown(moment().add(<?=$jenis_tes->waktu?>, 'minutes').format("YYYY/MM/DD HH:mm:ss"))
      .on('update.countdown', function(event) {
        var format = '%H:%M:%S';
       $(this).html(event.strftime(format));
     })
     .on('finish.countdown', function(event) {
         $("form").submit();
     });
}else{
    $('#timer').countdown(moment("<?=$on_going->waktu_start?>").add(<?=$jenis_tes->waktu?>, 'minutes').format("YYYY/MM/DD HH:mm:ss"))
      .on('update.countdown', function(event) {
        var format = '%H:%M:%S';
       $(this).html(event.strftime(format));
     })
     .on('finish.countdown', function(event) {
         $("form").submit();
     });
 }
$('input[type="radio"]').on('change', function(e) {
    var data = $(this).attr('name')+"-"+$(this).attr('value');
    $.post("<?=base_url()?>sertifikasi/savejawaban",
    {
        id_tes: <?=$on_going->id_tes?>,
        tes_ke: <?=$on_going->tes_ke?>,
        id_soal: $(this).attr('name'),
        jawaban: $(this).attr('value')
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
    });
    console.log(data);
});
</script>