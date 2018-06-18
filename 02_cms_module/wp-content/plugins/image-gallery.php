<?php

/*
Plugin Name: Image Gallery
*/

function image_shortcode($attr){
    ?>
        <em>
            Put this code directly to your home page
        </em>
    <input type="text" value="[imgl id='<?=$attr->ID?>']">
    <?php
}

function shortcode_image(){
    add_meta_box('igdiv', __('Shortcode'), 'image_shortcode', 'image-gallery');
}

add_action('add_meta_boxes', 'shortcode_image');

function ig_init(){
    register_post_type('image', [
        'label' => 'Manage Image',
        'public' => true,
        'supports' => ['title'],
        'show_in_menu' => 'edit.php?post_type=image-gallery'
    ]);

    register_post_type('image-gallery', [
        'label' => 'Image Gallery',
        'public' => true,
        'supports' => ['title'],
    ]);
}

add_action('init', 'ig_init');

function ig_shortcode($attr){
    $id = $attr['id'];

    if(!($images = get_field('image', $id))) return;

    $array = array_map(function($image){
        return [
            'url' => get_field('image', $image),
            'title' => get_the_title($image),
            'desc' => get_field('description', $image),
        ];
    }, $images);

    $count = count($array) - 1;
    $fill = '';
    foreach($array as $image){
        $fill .=
<<<EOD
    <div class="wrapper col-2 col-lg-4 col-md-6 col-sm-12">
        <div class="item" onclick="
            $('.gallery[data-id={$id}] .now').find('img').attr('src','${image['url']}');
            $('.gallery[data-id={$id}] .now').find('.title').html('${image['title']}');
            $('.gallery[data-id={$id}] .now').find('.desc').html('${image['desc']}');
        ">
            <img src="{$image['url']}" alt="banner">
        </div>
    </div>
EOD;
    }

    $html =
<<<EOD
   <div class="gallery section" data-id="{$id}">
        <div class="container">
            <div class="header">
                <div class="icon fa-camera"></div>
                <div class="main-title">OUR GALLERY</div>
                <div class="desc">
                    <hr>
                    <span>Beautiful Food Photo</span>
                    <hr>
                </div>
            </div>

            <div class="outer">
                <div class="now">
                    <div class="image">
                        <img src="{$array[0]['url']}" alt="gallery">
                    </div>
                    <div class="word">
                        <div class="title">
                            {$array[0]['title']}
                        </div>
                        <div class="desc">
                            {$array[0]['desc']}
                        </div>
                    </div>
                </div>
                <div class="more" onclick="$('.gallery[data-id={$id}] .more').toggleClass('active')">
                    <div class="counter">+{$count}</div>
                    <div class="row">
                        {$fill}
                    </div>
                </div>
            </div>
        </div>
    </div>
EOD;


    return $html;

}

add_shortcode('imgl', 'ig_shortcode');