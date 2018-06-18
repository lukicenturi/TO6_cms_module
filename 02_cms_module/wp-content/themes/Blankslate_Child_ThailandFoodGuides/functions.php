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

function sbox(){
    add_meta_box('sdiv',__('Similarity'), 'scheck', 'post','side','high');
}

add_action('add_meta_boxes','sbox');

function scheck($attr){
    $s1 = $attr->post_content;
    $posts = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'nopaging' => true,
        'exclude' => [$attr->ID]
    ]);

    if(count($posts) == 0){
        echo "There are no other posts";
    }else{
        $array = [];
        foreach($posts as $post){
            $s2 = $post->post_content;
            similar_text($s1, $s2, $perc);

            array_push($array, [
                'perc' => ceil($perc * 100) / 100,
                'title' => $post->post_title,
                'color' => $perc < 50 ? 'green' : ($perc > 80 ? 'red' : 'orange')
            ]);
        }

        usort($array, function($a, $b){
            return $b['perc'] - $a['perc'];
        });

        $i = 0;
        foreach($array as $post){
            if($i > 4) continue;
            ?>
                <div class="perpost <?= $post['color'] ?>">(<?=$post['perc']?>%) <?=$post['title']?></div>
            <?php
            $i++;
        }

        echo "
           <style>
                .perpost{padding: 10px 0} 
                .green{color: green !important}
                .red{color: red !important}
                .orange{color: orange !important}
           </style>
        ";
    }
}

function like($data){
    $id = $data['id'];
    $like = $data['like'];

    $now = get_field('like', $id);
    $now += $like;
    update_field('like', $now, $id);

    return $now;
}

function calculate($data){
    $ingredient = get_posts([
        'post_type'=>'ingredient',
        'post_status' => 'publish',
        'nopaging' => true
    ]);

    $nutrition = array_map(function($s){
        return [
            get_field('calorie', $s->ID),
            get_field('fat', $s->ID),
            get_field('carbohydrate', $s->ID),
        ];
    }, $ingredient);

    $need = [$data[1], $data[2], $data[3]];
    $count = count($need);
    $row = count($nutrition);
    $column = $count + $row + 2;
    $array = [];

    for($i = 0 ; $i < $row + 1; $i++){
        $array[$i] = [];
        for($j = 0 ;$j < $column; $j++){
            if($j < $count){
                $array[$i][$j] = $i < $row ? $nutrition[$i][$j] : $need[$j] * -1;
            }else if($j >= $count && $j < $count + $row){
                $array[$i][$j] = $j - $count == $i ? 1 : 0;
            }else{
                $array[$i][$j] = $j - $count == $row ? 1 : 0;
            }
        }
    }

    while(($minCol = check($array[$row])) !== -1){
        $minRow = 0;
        $temp = 0;

        for($i = 0 ;$i < $row; $i++){
            $coef = $array[$i][$minCol];
            if($coef <= 0){
                $ratio = INF;
            }else{
                $ratio = $array[$i][$column - 2] / $coef;
                $array[$i][$column - 1] = $ratio;
            }

            if(!$i || $ratio < $temp){
                $temp = $ratio;
                $minRow = $i;
            }
        }

        for($i = 0 ; $i < $row + 1 ; $i++){
            $temp = $array[$i][$minCol];
            for($j = 0 ;$j < $column; $j++){
                if($i === $minRow){
                    $array[$i][$j] /= $temp;
                }else{
                    $array[$i][$j] -= ($temp * $array[$minRow][$j] / $array[$minRow][$minCol]);
                }
            }
        }
    }

    return createResult($array, $nutrition, $ingredient, $row, $count);
}

function check($array){
    $count = count($array) - 1;
    $min = 0;
    $index = -1;

    for($i=0 ; $i < $count; $i++){
        if($array[$i] < $min){
            $min = $array[$i];
            $index = $i;
        }
    }

    return $index;
}

function createResult($array, $nutrition, $ingredient, $row, $count){
    $counter = -1;
    $total = [
        'total_qty' => 0,
        'total_cal' => 0,
        'total_fat' => 0,
        'total_car' => 0,
    ];
    $result = [];

    for($i = 0; $i < $row; $i++){
        $qty = $array[$row][$i + $count];
        $qty = ceil($qty * 100) / 100;
        if($qty > 0){
            $result[++$counter] = [
                'qty' => $qty,
                'name' => $ingredient[$i]->post_title,
                'cal' => $nutrition[$i][0],
                'fat' => $nutrition[$i][1],
                'car' => $nutrition[$i][2],
                'total_cal' => ceil($qty * $nutrition[$i][0] * 100) / 100,
                'total_fat' => ceil($qty * $nutrition[$i][1] * 100) / 100,
                'total_car' => ceil($qty * $nutrition[$i][2] * 100) / 100,
            ];

            $total['total_qty'] += $qty;
            $total['total_cal'] += ceil($qty * $nutrition[$i][0] * 100) / 100;
            $total['total_fat'] += ceil($qty * $nutrition[$i][1] * 100) / 100;
            $total['total_car'] += ceil($qty * $nutrition[$i][2] * 100) / 100;
        }
    }

    $result[++$counter] = $total;
    return $result;
}

function data(){
    $array = [
        ['Rice','100','129','0.28','27.9'],
        ['Chicken Meat','100','167','6.63','0'],
        ['Beef','100','288','19.54','0'],
        ['Sugar','100','387','0','100'],
        ['Cheese','100','403','33.14','1.28'],
        ['Tomato','100','18','0.2','3.92'],
        ['Peanut','100','567','49.24','16.13'],
        ['Tofu','100','55','1.9','2'],
        ['Milk','100','52','2.06','4.86'],
        ['Kale','100','20','0.34','3.18'],
        ['Shrimp','100','144','2.35','1.24'],
        ['Crab','100','99','1.23','0'],
        ['Potato','100','103','2.24','19.52'],
        ['Coconut','100','354','33.49','15.23'],
        ['Shells','100','217','10.96','10.49'],
        ['Fish','100','84','0.92','0'],
        ['Corn','100','86','1.18','19.02'],
        ['Chocolate','100','535','29.66','59.4'],
        ['Mango','100','65','0.27','17'],
        ['Ginger','100','80','0.75','17.77'],
        ['Onions','100','42','0.08','10.11'],
        ['Garlic','100','149','0.5','33.06'],
        ['Mushroom','100','22','0.34','3.28'],
        ['Lettuce','100','14','0.14','2.97'],
        ['Carrot','100','41','0.24','9.58'],
        ['Spinach','100','7','0.2','0.4'],
        ['Cucumber','100','15','0.11','3.63'],
        ['Butter','100','717','81.11','0.06'],
        ['Bread','100','266','3.29','50.61'],
        ['Noodle','100','137','2.06','25.01'],
    ];

    foreach($array as $a){
        wp_insert_post([
            'post_title' => $a[0],
            'post_name' => $a[0],
            'post_status' => 'publish',
            'post_type' => 'ingredient',
            'post_content' => utf8_encode(file_get_contents(DIR . '/ing/' . str_replace(' ', '_', strtolower($a[0])) . '.txt')),
            'meta_input' => [
                'calorie' => $a[2],
                'fat' => $a[3],
                'carbohydrate' => $a[4],
            ]
        ]);
    }
}

function rest_init(){
    register_rest_route('like', '(?P<id>.*)/(?P<like>.*)', array(
        'methods' => 'GET',
        'callback' => 'like'
    ));

    register_rest_route('calculate', '(?P<id>.*)/(?P<idd>.*)/(?P<iddd>.*)', array(
        'methods' => 'GET',
        'callback' => 'calculate'
    ));
//    register_rest_route('tf', 'test', array(
//        'methods' => 'GET',
//        'callback' => 'data'
//    ));
}

add_action('rest_api_init', 'rest_init');

function hide(){
    echo "
        <style>
            #acf-like, #acf-view{
                display: none;
            }  
        </style>
    ";
}

add_action('admin_head','hide');

function length($length){
    return 10;
}

add_filter('excerpt_length', 'length');

function manage_post($column){
    $column['view'] = __('View');
    return $column;
}

function manage_post_value($column, $id){
    if($column == 'view'){
        echo get_field('view', $id);
    }
}

function manage_recipe($column){
    $column['like'] = __('Like');
    return $column;
}

function manage_recipe_value($column, $id){
    if($column == 'like'){
        echo get_field('like', $id);
    }
}

add_action('manage_post_posts_columns', 'manage_post', 10, 2);
add_action('manage_post_posts_custom_column', 'manage_post_value', 10, 2);
add_action('manage_recipe_posts_columns', 'manage_recipe', 10, 2);
add_action('manage_recipe_posts_custom_column', 'manage_recipe_value', 10, 2);


function change_text($t, $text, $d){
    if($text == 'Publish'){
        $text = 'Accept';
    }else if($text == 'Move to Trash'){
        $text = 'Decline';
    }

    return $text;
}

function change_button(){
    $screen = get_current_screen();
    $user = new WP_User(get_current_user_id());
    $a = $user->roles[0];

    $id = $_GET['id'];
    $post = get_post($id);
    $user = new WP_User($post->post_author);
    $b = $user->roles[0];
    $status = $post->post_status;

    echo $b;

    if(is_object($screen) && $screen->post_type == 'post' && $status == 'pending' && ($a == 'administrator' || $a == 'editor') && $b == 'contributor'){
        add_filter('gettext','change_text', 10, 3);
    }
}

add_action('admin_head', 'change_button');