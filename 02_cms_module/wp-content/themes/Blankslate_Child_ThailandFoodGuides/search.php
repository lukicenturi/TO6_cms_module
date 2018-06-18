<?php get_header() ?>
<div id="banner">
    <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
    <h1>SEARCH QUERY : "<?= get_query_var('s') ?>"</h1>
    <span>Search Result</span>
    <div class="button">
        <button id="scroll" class="btn">READ MORE</button>
    </div>
</div>

<div class="recipes section">
    <div class="container">
        <div class="row">
            <?php if(have_posts()) : while(have_posts()) : the_post() ?>
                <?php if(get_post_type() == 'recipe'): get_template_part('entry/recipe'); endif;?>
            <?php endwhile; endif; wp_reset_postdata();?>
        </div>
    </div>
</div>
<?php get_footer() ?>
