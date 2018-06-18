<?php

define("DIR", get_stylesheet_directory_uri());

function pl_init(){
    register_post_type('ingredient', [
        'label' => 'Ingredient',
        'public' => true,
        'supports' => ['title','editor']
    ]);
    register_post_type('recipe', [
        'label' => 'Recipe',
        'public' => true,
        'supports' => ['title','editor']
    ]);
}

add_action('init', 'pl_init');

function length($length){
    return 10;
}

add_filter('excerpt_length', 'length');

function sbox(){
    add_meta_box('sdiv',__('Similarity'), 'scheck', 'post','side','high');
}

add_action('add_meta_boxes','sbox');

function scheck($attr){
    $s1 = $attr->post_content;
}