
    <div><h1></h1></div>
    <div>
        <?php 
        if (empty($post)) {
                echo "--Belum ada berita--";
        } else {
            foreach ($post as $p) {
        ?>
        <h1><?=$p->post_title?></h1>
        <br><br>
        <div>
            <?=$p->post_content?>
        </div>
        <br><br>
        <?php }
        }?>
    </div>
    <center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
</div>
