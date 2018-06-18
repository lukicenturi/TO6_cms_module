<div class="wrapper col-3 col-lg-6 col-sm-12" data-id="<?php the_ID() ?>">
    <div class="item">
        <div class="image">
            <?php if(get_field('image')): ?>
                <img src="<?= get_field('image') ?>" alt="blogs">
            <?php endif; ?>

            <div class="status">
                <div class="date"><?= Date('d M Y', strtotime(get_the_date('d M Y'))) ?></div>
                <div class="view">
                    <span class="fa-eye"></span>
                    <div><?=get_field('view') ?></div>
                </div>
            </div>
        </div>
        <div class="word">
            <a href="<?= get_the_permalink() ?>">
                <div class="title">
                    <?= get_the_title() ?>
                </div>
            </a>

            <div class="desc">
                <?= get_the_excerpt() ?>
            </div>
        </div>
    </div>
</div>