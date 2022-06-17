<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php foreach ($infos as $info) { ?>
            <div class="post-preview">
                    <?php 
                        echo '<a href="?controller=info&action=detail&id=' . $info['idInfo'] . '">';
                        echo '<h2 class="post-title">' . $info['infName']. '</h2>';
                        echo '<h3 class="post-subtitle">' . $info['infDescription']. '</h3>';
                    ?>  
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="https://github.com/mirkosale">Mirko Sale</a>
                    on June 17th, 2022
                </p>
            </div>
            
            <!-- Divider-->
            <hr class="my-4" />
            <?php } ?>
        </div>
    </div>
</div>

</body>

</html>