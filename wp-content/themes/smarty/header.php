<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <!--<meta http-equiv="refresh" content="5" >-->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <title><?php bloginfo('name'); ?></title>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>

        <script type="text/javascript">
            var timeout = setTimeout("location.reload(true);", 600000);
            function resetTimeout() {
                clearTimeout(timeout);
                timeout = setTimeout("location.reload(true);", 600000);
            }
        </script>

<!--        <script>
            var time = new Date().getTime();
            $(document.body).bind("mousemove keypress", function (e) {
                time = new Date().getTime();
            });

            function refresh() {
                if (new Date().getTime() - time >= 60000)
                    window.location.reload(true);
                else
                    setTimeout(refresh, 10000);
            }

            setTimeout(refresh, 10000);
        </script>-->
    </head>
    <body <?php body_class(); ?>>
        <div id="wrapper">

            <?php
            get_template_part('parts/' . smarty_get_layout_mode() . '/header');
            ?>