<?php get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ?>
    <div id="banner">
        <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
        <h1>OUR RECIPES</h1>
        <span>Everyday special recipes</span>
        <div class="button">
            <button id="scroll" class="btn">READ MORE</button>
        </div>
    </div>

    <div class="recipes section">
        <div class="container">
            <div class="row">
                <?php $query = new WP_Query([
                    'post_type' => 'recipe',
                    'post_status' => 'publish',
                    'posts_per_page' => 7,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => $paged
                ]); ?>

                <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ?>
                    <?php get_template_part('entry/recipe'); ?>
                <?php endwhile; endif; wp_reset_postdata();?>
            </div>

            <div class="paginate">
                <?= paginate_links(['total' => $query->max_num_pages]) ?>
            </div>
        </div>
    </div>
<?php get_footer() ?>
