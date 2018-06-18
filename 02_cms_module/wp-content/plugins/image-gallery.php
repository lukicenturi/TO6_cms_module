<?php

/*
Plugin Name: Image Gallery
*/

function image_shortcode($attr){
    ?>
        <em>
            Put this code directly to your home page
        </em>
    <input type="text" value="[imgl id='<?=$attr->ID?>]">
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