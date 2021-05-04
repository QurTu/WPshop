<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    do_action( 'journo_edge_action_header_meta' );
    wp_head();
    ?>
</head>

<body <?php body_class(); ?> >
<header class="content-container">
    <div class="header-contact-info">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 17.667 17.667">
                <path id="Path_4398" data-name="Path 4398" d="M16.272,11.632a10.1,10.1,0,0,1-3.169-.5,1.358,1.358,0,0,0-1.379.292L9.719,12.935A11.2,11.2,0,0,1,4.733,7.95L6.207,5.992a1.407,1.407,0,0,0,.345-1.423,10.1,10.1,0,0,1-.508-3.174A1.4,1.4,0,0,0,4.649,0H1.395A1.4,1.4,0,0,0,0,1.395,16.291,16.291,0,0,0,16.272,17.667a1.4,1.4,0,0,0,1.395-1.395V13.027A1.4,1.4,0,0,0,16.272,11.632Z" fill="#000"/>
            </svg>
            +37069541879
        </div>
        <div>
                <svg id="Group_32" data-name="Group 32" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18.546 14.572">
                    <path id="Path_4399" data-name="Path 4399" d="M33.265,329.19a1.585,1.585,0,0,0,1.085-.409L29.1,323.526l-.364.262q-.59.435-.957.678a5.9,5.9,0,0,1-.978.5,2.981,2.981,0,0,1-1.139.253h-.021a2.98,2.98,0,0,1-1.139-.253,5.884,5.884,0,0,1-.978-.5q-.368-.243-.957-.678l-.363-.263-5.255,5.256a1.585,1.585,0,0,0,1.085.409Z" transform="translate(-16.375 -314.619)" fill="#000"/>
                    <path id="Path_4400" data-name="Path 4400" d="M1.045,199.456a5.486,5.486,0,0,1-1.045-.9v7.994l4.631-4.631Q3.241,200.948,1.045,199.456Z" transform="translate(0 -193.856)" fill="#000"/>
                    <path id="Path_4401" data-name="Path 4401" d="M416.9,199.456q-2.115,1.431-3.594,2.465l4.629,4.63v-7.995A5.71,5.71,0,0,1,416.9,199.456Z" transform="translate(-399.392 -193.856)" fill="#000"/>
                    <path id="Path_4402" data-name="Path 4402" d="M16.9,59.013H1.662a1.478,1.478,0,0,0-1.226.538A2.088,2.088,0,0,0,.006,60.9a2.418,2.418,0,0,0,.569,1.413,5.134,5.134,0,0,0,1.211,1.2q.352.249,2.122,1.475c.637.441,1.191.826,1.667,1.158.406.283.756.528,1.045.731l.155.11.285.206q.336.243.559.393t.538.336a3.138,3.138,0,0,0,.6.279,1.647,1.647,0,0,0,.517.093h.021a1.647,1.647,0,0,0,.517-.093,3.132,3.132,0,0,0,.6-.279q.316-.186.538-.336t.559-.393l.285-.205.155-.11,1.047-.728,3.8-2.636a4.923,4.923,0,0,0,1.263-1.273,2.738,2.738,0,0,0,.507-1.563A1.669,1.669,0,0,0,16.9,59.013Z" transform="translate(-0.006 -59.013)" fill="#000"/>
                </svg>
                labas@nebegeda.lt
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16.535 20.724">
                <path id="Path_4403" data-name="Path 4403" d="M57.271.005a8.27,8.27,0,0,0-7.823,9.833h0s.013.089.055.259a8.287,8.287,0,0,0,.557,1.64,23.945,23.945,0,0,0,7.045,8.821.718.718,0,0,0,.918,0,23.92,23.92,0,0,0,7.049-8.826,7.936,7.936,0,0,0,.557-1.64c.038-.166.055-.259.055-.259h0A8.272,8.272,0,0,0,57.271.005Zm.293,12.374A4.015,4.015,0,1,1,61.58,8.363,4.015,4.015,0,0,1,57.565,12.379Z" transform="translate(-49.299 0)" fill="#000"/>
            </svg>
            Pylimo g. 5-4, LT-01117 Vilnius
        </div>
    </div>
    <div class="header-nav-menu-container">
        <div class="header-logo">
            <a href="/">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"/>
            </a>
        </div>
        <div class="header-nav-menu">
            <?php
            $navMenu = wp_get_menu_array('header-main-menu');
            foreach ($navMenu as $item) {
                ?>
                <div class="header-nav-menu-item-cat">
                       <a href="<?php echo $item['url']?>" class="header-nav-menu-top-lvl-item"> <?php echo $item['title']?> </a>
                        <?php
                            if($item['children']) {
                                ?>
                                <div class="header-menu-dropdown">
                                    <?php
                                     foreach ($item['children'] as $subElement) {
                                         ?>
                                         <a href="<?php echo $subElement['url']?>" class="header-nav-menu-top-lvl-item"> <?php echo $subElement['title']?> </a>
                                        <?php
                                     }
                                    ?>
                                </div>
                                <?php
                            }
                        ?>
                </div>
                <?php
            }

            ?>

        </div>
        <div class="header-actions-icons">
            <div class="header-search">
                <div id="wrap">
                    <form role="search" action="/" method="get" autocomplete="on">
                        <input id="search" name="search" type="text" placeholder="What're we looking for ?"><input id="search_submit" value="Rechercher" type="submit">
                    </form>
                </div>
            </div>
            <div class="header-cart">
                <a href="/cart">
                <object style="pointer-events: none;" data="<?php echo get_template_directory_uri(); ?>/assets/images/SVG/cart.svg" type="image/svg+xml"></object>
                </a>
                <div class="header-drop-down">
                    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
                </div>
            </div>
            <div class="header-hambureger-menu">
                <object style="pointer-events: none;" data="<?php echo get_template_directory_uri(); ?>/assets/images/SVG/hamburger.svg" type="image/svg+xml"></object>
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-wrap">
    <div class="mobile-header-container">
        <button class="mobile-header-close"  >
            <object style="pointer-events: none;" data="<?php echo get_template_directory_uri(); ?>/assets/images/SVG/cancel.svg" type="image/svg+xml"> </object>
        </button>
        <div class="mobile-header-main-content">
            <h1> <?php  _e('meniu', 'parduotuve')?></h1>
            <div class="mobile-header-nav-bar">
                <?php
                foreach ($navMenu as $item) {
                    ?>
                    <div class="header-nav-menu-item-cat">
                        <a href="<?php echo $item['url']?>" class="header-nav-menu-top-lvl-item"> <?php echo $item['title']?> </a>
                        <?php
                        if($item['children']) {
                            ?>
                            <div class="header-menu-dropdown">
                                <?php
                                foreach ($item['children'] as $subElement) {
                                    ?>
                                    <a href="<?php echo $subElement['url']?>" class="header-nav-menu-top-lvl-item"> <?php echo $subElement['title']?> </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>

</div>
