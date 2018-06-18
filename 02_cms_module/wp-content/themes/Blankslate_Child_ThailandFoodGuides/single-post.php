<?php get_header();
update_field('view', get_field('view') + 1);
?>
<div id="banner">
    <?php if(get_field('image')) : ?>
        <div class="background" style="background-image: url('<?=get_field('image') ?>')"></div>
    <?php else: ?>
        <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
    <?php endif ?>
    <h1><?= get_the_title() ?></h1>
    <span>Blog Post</span>
    <div class="button">
        <button id="scroll" class="btn">READ MORE</button>
    </div>
</div>

<div class="blogs section single">
    <div class="container">
        <div class="row">
            <div class="wrapper col-12" data-id="<?php the_ID() ?>">
                <div class="item">
                    <div class="image">
                        <div class="status" style=" left: 0;">
                            <div class="date"><?= Date('d M Y', strtotime(get_the_date('d M Y'))) ?></div>
                            <div class="view">
                                <span class="fa-eye"></span>
                                <div><?=get_field('view') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="word">
                        <div class="title">
                            <?= get_the_title() ?>
                        </div>
                        <div class="desc">
                            <?php the_content()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>
