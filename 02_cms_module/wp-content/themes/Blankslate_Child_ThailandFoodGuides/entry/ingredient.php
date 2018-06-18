<div class="wrapper col-3 col-lg-6 col-sm-12">
    <div class="item">
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

        <ul class="info">
            <li>
                <div><?=get_field('calorie')?></div>
                <div>Calorie</div>
            </li>
            <li>
                <div><?=get_field('fat')?></div>
                <div>Fat</div>
            </li>
            <li>
                <div><?=get_field('carbohydrate')?></div>
                <div>Carbohydrate</div>
            </li>
        </ul>
    </div>
</div>