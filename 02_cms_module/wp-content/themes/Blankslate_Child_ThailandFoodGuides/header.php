<!doctype html>
<html lang="en" class="html">
<head>
    <meta name="url" content="<?=get_home_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= get_bloginfo('name') ?></title>

    <link rel="stylesheet" href="<?= get_stylesheet_uri() ?>">
    <link rel="stylesheet" href="<?=DIR?>/wf-ionicons.css">

    <script src="<?=DIR?>/js/jquery.js"></script>
    <script src="<?=DIR?>/js/script.js"></script>

    <style>
        @font-face {
            font-family: Ionicons;
            src: url('<?=DIR?>/fonts/ionicons.woff');
        }

        @font-face {
            font-family: Montserrat;
            src: url('<?=DIR?>/fonts/Montserrat-Medium.ttf');
        }

        @font-face {
            font-family: Montserrat;
            src: url('<?=DIR?>/fonts/Montserrat-Light.ttf');
            font-weight: 100;
        }

        @font-face {
            font-family: Montserrat;
            src: url('<?=DIR?>/fonts/Montserrat-Bold.ttf');
            font-weight: bold;
        }
        @font-face {
            font-family: AmaticSC;
            src: url('<?=DIR?>/fonts/AmaticSC-Bold.ttf');
            font-weight: bold;
        }

        @font-face {
            font-family: AmaticSC;
            src: url('<?=DIR?>/fonts/AmaticSC-Regular.ttf');
        }
    </style>

    <?php wp_head() ?>
</head>
<body <?php body_class() ?>>
    <header>
        <div class="container">
            <a href="<?=get_home_url() ?>">
                <div class="logo">
                    <img src="<?= DIR ?>/images/logo.png" alt="logo">
                </div>
            </a>
            <div class="toggle" onclick="$('.menu').toggleClass('active')">&#9776;</div>
            <ul class="menu">
                <li><a href="<?= get_home_url() ?>">HOME</a></li>
                <li><a href="<?= get_home_url() ?>/recipe-lists">RECIPE LISTS</a></li>
                <li><a href="<?= get_home_url() ?>/blog-posts">BLOG POSTS</a></li>
                <li><a href="<?= get_home_url() ?>/ingredients">INGREDIENTS</a></li>
                <li>
                    <select name="lang" id="lang" onchange="location.href='<?=get_home_url() ?>?lang=' + this.value">
                        <?php foreach($GLOBALS['q_config']['language_name'] as $key=>$value): ?>
                        <option value="<?=$key?>" <?php if($GLOBALS['q_config']['language'] == $key): ?> selected <?php endif ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <form action="<?= get_home_url() ?>">
                        <input type="text" name="s" placeholder="Search...">
                        <button class="fa-ios-search"></button>
                    </form>
                </li>
            </ul>
        </div>
    </header>
