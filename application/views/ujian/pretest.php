<div id="contentujian">
    <div id="titleujian" style="text-align: center;">
        <h3><?=$jenis_tes->nama_tes?></h3>
    </div>
    <div id="isiujian" style="text-align:justified;">
        <form method="post" action="<?=base_url().'sertifikasi/do_ujian/'.$ujian->token?>">
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
                    <td style="width: 80px"><input value="a" type="radio" name="<?=$s->id?>" <?=($s->jawaban=='a')?'class="jawaban"':""?>/> <span>&nbsp;A.</span></td>
                    <td><?=$s->pilihan_a?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input value="b" type="radio" name="<?=$s->id?>" <?=($s->jawaban=='b')?'class="jawaban"':""?>/>&nbsp; B. </td>
                    <td><?=$s->pilihan_b?></td>
                </tr>
                <?php if($s->pilihan_c!=""){ ?>
                <tr>
                    <td></td>
                    <td><input value="c" type="radio" name="<?=$s->id?>" <?=($s->jawaban=='c')?'class="jawaban"':""?>/>&nbsp; C. </td>
                    <td><?=$s->pilihan_c?></td>
                </tr>
                <?php } if($s->pilihan_d!=""){ ?>
                <tr>
                    <td></td>
                    <td><input value="d" type="radio" name="<?=$s->id?>" <?=($s->jawaban=='d')?'class="jawaban"':""?>/>&nbsp; D. </td>
                    <td><?=$s->pilihan_d?></td>
                </tr>
                <?php } if($s->pilihan_e!=""){ ?>
                <tr>
                    <td></td>
                    <td><input value="e" type="radio" name="<?=$s->id?>" <?=($s->jawaban=='e')?'class="jawaban"':""?>/>&nbsp; E. </td>
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
var no = <?=$no_soal-1?>;
$('#timer').countdown(moment().add(3, 'minutes').format("YYYY/MM/DD HH:mm:ss"))
  .on('update.countdown', function(event) {
    var format = '%H:%M:%S';
   $(this).html(event.strftime(format));
 })
 .on('finish.countdown', function(event) {
     alert("Waktu anda habis!");
     var salah = no-$(".jawaban:checked").length;
     if(salah!=0) alert(salah+" jawaban masih salah");
     else $("form")[0].submit();
 });
 $("form").submit(function(event){
     event.preventDefault();
     var salah = no-$(".jawaban:checked").length;
     if(salah!=0) alert(salah+" jawaban masih salah");
     else $("form")[0].submit();
 });
</script>