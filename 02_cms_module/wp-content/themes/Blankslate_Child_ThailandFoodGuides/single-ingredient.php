<?php get_header();?>
<div id="banner">
    <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
    <h1><?= get_the_title() ?></h1>
    <span>Ingredient</span>
    <div class="button">
        <button id="scroll" class="btn">READ MORE</button>
    </div>
</div>

<div class="ingredients section single">
    <div class="container">
        <div class="row">
            <div class="wrapper col-12">
                <div class="item">
                    <div class="word">
                        <div class="title">
                            <?= get_the_title() ?>
                        </div>
                        <div class="desc">
                            <?php the_content() ?>
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
        </div>
    </div>
</div>

<?php get_footer() ?>
