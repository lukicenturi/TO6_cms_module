<div class="wrapper col-3 col-lg-6 col-sm-12" data-id="<?php the_ID() ?>">
    <div class="item">
        <div class="image">
            <?php if(get_field('image')): ?>
            <img src="<?= get_field('image') ?>" alt="recipe">
            <?php endif; ?>

            <div class="like">
                <div class="button fa-ios-heart-outline" data-id="<?php the_ID() ?>" data-like="-1"></div>
                <div class="counter"><?= get_field('like') ?></div>
            </div>
        </div>
        <div class="word">
            <div class="date">
                <?= Date('d M Y', strtotime(get_the_date('d M Y'))) ?>
            </div>
            <a href="<?= get_the_permalink() ?>">
                <div class="title">
                    <?= get_the_title() ?>
                </div>
            </a>
        </div>
    </div>
</div>