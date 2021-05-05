<?php
	//BASE START
    global $theme_url; 
    $theme_url=get_template_directory_uri();

    remove_filter ('term_description','wpautop');
    remove_filter ('acf_the_content', 'wpautop');
    add_theme_support( 'post-thumbnails' );

    add_action('init', 'ws_remove_support',100);
    function ws_remove_support(){


    }

    add_action( 'admin_menu', 'ws_remove_menus' );
    function ws_remove_menus(){
		remove_menu_page( 'edit.php' );                 //Posts
		remove_menu_page( 'upload.php' );               //Media
		remove_menu_page( 'edit-comments.php' );        //Comments
	//	remove_menu_page( 'plugins.php' );           //Plugins
		// remove_menu_page( 'tools.php' );             //Tools
    }



	add_action('wp_enqueue_scripts', 'ws_load_scripts');
	function ws_load_scripts() {
        wp_enqueue_style( 'splide_css', get_template_directory_uri() . '/assets/libs/splide/css/splide.min.css', array(), '1.0.0', false);
		wp_enqueue_style( 'webstrum_css', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', false);

        wp_enqueue_script( 'splide_js', get_template_directory_uri() . '/assets/libs/splide/js/splide.min.js', array( 'jquery' ), '1.0.0', true);
		wp_enqueue_script( 'webstrum_js', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);
	}
//add code to use ajax
function add_ajax_script() {

    wp_localize_script( 'webstrum_js', 'ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'place' => '' ) );

}
add_action( 'wp_enqueue_scripts', 'add_ajax_script' );

function mytheme_add_woocommerce_support() {
    add_theme_support( 'widgets' );
    add_theme_support( 'menus' );
    add_theme_support( 'woocommerce' );

}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_action( 'widgets_init', 'my_awesome_sidebar' );
function my_awesome_sidebar() {
    $args = array(
        'name'          => 'Awesome Sidebar',
        'id'            => 'awesome-sidebar',
        'description'   => 'The Awesome Sidebar is shown on the left hand side of blog pages in this theme',
        'class'         => '',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    );

    register_sidebar( $args );

}

function update_item_from_cart() {
    $id = $_POST['id'];
    $quantity = $_POST['val'];

    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if( $cart_item_key == $id  )
        {
            WC()->cart->set_quantity( $cart_item_key, $quantity, $refresh_totals = true );
        }
    }
    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    $shippgtotal = preg_replace('/[^0-9\.]/', "", WC()->cart->get_cart_shipping_total());
    if($shippgtotal == '') {
        $shippgtotal = 0;
    }


    echo json_encode(   array(
        'total' => WC()->cart->total,
        'shipping' =>WC()->cart->get_cart_shipping_total(),
        'untilShipping' => 35 - (WC()->cart->total - $shippgtotal),
        'cartCount' => WC()->cart->cart_contents_count
    ) );
    die();
}
add_action('wp_ajax_update_item_from_cart', 'update_item_from_cart');
add_action('wp_ajax_nopriv_update_item_from_cart', 'update_item_from_cart');

add_theme_support( 'menus' );
function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID'] = $m->ID;
            $submenu[$m->ID]['title'] = $m->title;
            $submenu[$m->ID]['url'] = $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}
