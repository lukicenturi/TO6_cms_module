<?php get_header(); ?>
<div id="banner">
    <?php if(get_field('image')) : ?>
    <div class="background" style="background-image: url('<?=get_field('image') ?>')"></div>
    <?php else: ?>
    <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
    <?php endif ?>
    <h1><?= get_the_title() ?></h1>
    <span>Our Recipe</span>
    <div class="button">
        <button id="scroll" class="btn">READ MORE</button>
    </div>
</div>

<div class="recipes section single">
    <div class="container">
        <div class="row">
            <div class="wrapper col-12" data-id="<?php the_ID() ?>">
                <div class="item">
                    <div class="image">
                        <div class="like" style="left: 0; bottom: 0">
                            <span>Like: </span>
                            <div class="button fa-ios-heart-outline" data-id="<?php the_ID() ?>" data-like="-1"></div>
                            <div class="counter"><?= get_field('like') ?></div>
                        </div>
                    </div>
                    <div class="word">
                        <div class="date" style="margin-bottom: 20px;">
                            <?= Date('d M Y', strtotime(get_the_date('d M Y'))) ?>
                        </div>
                        <div class="title">
                            <?= get_the_title() ?>
                        </div>
                        <div class="desc">
                            <?php the_content() ?>
                        </div>
                    </div>
                    <h3>Ingredient: </h3>
                    <ol>
                        <?php foreach(get_field('ingredient') as $i): ?>
                            <li><a href="<?= get_permalink($i) ?>"><?= get_the_title($i) ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>


