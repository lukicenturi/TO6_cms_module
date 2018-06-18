
<div class="sidebar">
    <?php get_sidebar() ?>
    <div class="toggle" onclick="$('.sidebar').toggleClass('active')"></div>
</div>

<footer class="section">
    <div class="background" style="background-image: url('<?=DIR?>/images/footer.jpg')"></div>
    <div class="container">
        <div class="row">
            <div class="wrapper logo col-4 col-md-12 col-sm-12">
                <img src="<?= DIR ?>/images/logo.png" alt="logo">
            </div>
            <div class="wrapper menu col-4 col-md-6 col-sm-12">
                <h3>POPULAR RECIPE</h3>
                <ul>
                    <?php $query = get_posts([
                        'post_type' => 'recipe',
                        'post_status' => 'publish',
                        'posts_per_page' => 5,
                        'meta_key' => 'like',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                    ]); ?>

                    <?php foreach($query as $q): ?>
                        <li><a href="<?= get_permalink($q->ID) ?>"><span class="fa-chevron-right"></span><?=get_the_title($q->ID) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>

            <div class="wrapper social col-4 col-md-6 col-sm-12">
                <h3>FOLLOW US ON:</h3>
                <ul>
                    <li><a href="#"><span class="fa-social-facebook"></span> facebook</a></li>
                    <li><a href="#"><span class="fa-social-twitter"></span> twitter</a></li>
                    <li><a href="#"><span class="fa-social-instagram"></span> instagram</a></li>
                    <li><a href="#"><span class="fa-social-linkedin"></span> linked in</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="copyright">
    Copyright &copy; <?= Date('Y') ?>. <?=get_bloginfo('name') ?>. All Right Reserverd. Created by Indonesia.
</div>
<?php wp_footer() ?>
</body>
</html>