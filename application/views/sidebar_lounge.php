<div id="page" class="container">
    <div id="sidebar1">
        <div id="box1">
            <h2>News Flash</h2>

            <ul class="style1">
                <?php 
                    $post = $this->BeritaModel->getPost("all",3);
                    if (empty($post)) {
                            echo "<li class='first'>Tidak ada berita terbaru</li>";
                    } else {
                        foreach ($post as $p) {
                ?>
                    <li><a href="<?=$p->guid?>"><?=$p->post_title?></a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>