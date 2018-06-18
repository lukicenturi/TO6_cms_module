<?php get_header() ?>
    <div id="banner">
        <div class="background" style="background-image: url('<?=DIR?>/images/banner.jpg')"></div>
        <h1>THE BEST BLOG FOOD</h1>
        <span>Inspirative & Delicious</span>
        <div class="button">
            <button id="scroll" class="btn">READ MORE</button>
        </div>
    </div>

    <div class="recipes section">
        <div class="container">
            <div class="header">
                <div class="icon fa-coffee"></div>
                <div class="main-title">OUR RECIPE</div>
                <div class="desc">
                    <hr>
                    <span>Everyday special Recipe</span>
                    <hr>
                </div>
            </div>

            <div class="row">
                <?php $query = new WP_Query([
                    'post_type' => 'recipe',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'meta_key' => 'like',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ]); ?>

                <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ?>
                    <?php get_template_part('entry/recipe'); ?>
                <?php endwhile; endif; wp_reset_postdata();?>
            </div>
        </div>
    </div>

    <div class="calculator section invers">
        <div class="background" style="background-image: url('<?=DIR?>/images/calculator.jpg')"></div>
        <div class="container">
            <div class="header">
                <div class="icon fa-ios-lightbulb-outline"></div>
                <div class="main-title">NUTRITION CALCULATOR</div>
                <div class="desc">
                    <hr>
                    <span>We love you</span>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="wrapper col-3 col-sm-6">
                    <input type="text" id="cal" placeholder="Calorie">
                </div>
                <div class="wrapper col-3 col-sm-6">
                    <input type="text" id="fat" placeholder="Fat">
                </div>
                <div class="wrapper col-3 col-sm-6">
                    <input type="text" id="car" placeholder="Carbohydrate">
                </div>
                <div class="wrapper col-3 col-sm-6">
                    <button class="btn btn-white fa-calculator" id="calculate"></button>
                </div>
            </div>
        </div>
    </div>
<div class="modal" onclick="$('.modal').removeClass('active')">
    <div class="modal-wrapper" onclick="event.stopPropagation()">
        <div class="modal-head">
            <h1>NUTRITION CALCULATOR RESULT</h1>
            <span class="fa fa-close"  onclick="$('.modal').removeClass('active')"></span>
        </div>
        <div class="modal-body">
            <table>
                <thead>
                    <tr>
                        <th>Ingredient <br> Name</th>
                        <th>Calorie <br> (per 100 ml/gr)</th>
                        <th>Fat <br> (per 100 ml/gr)</th>
                        <th>Carbohydrate <br> (per 100 ml/gr)</th>
                        <th>Quantity <BR> needed</th>
                        <th>Total <BR> Calorie</th>
                        <th>Total <BR> Fat</th>
                        <th>Total <BR> Carbohydrate</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php the_content() ?>


<div class="blogs section">
    <div class="container">
        <div class="header">
            <div class="icon fa-fork"></div>
            <div class="main-title">FOOD BLOG</div>
            <div class="desc">
                <hr>
                <span>For you food-holic</span>
                <hr>
            </div>
        </div>

        <div class="row">
            <?php $query = new WP_Query([
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'meta_key' => 'view',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
            ]); ?>

                <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ?>
                    <?php get_template_part('entry/blogs'); ?>
                <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
