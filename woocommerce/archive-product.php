<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

?>
    <div id="page_wrapper" class="content-container shop-page-container">
<?php
do_action( 'woocommerce_before_main_content' );

?>

<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?> </h1>
	<?php endif; ?>

	<?php

	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>

<div class="shop-main-content">
<?php
if ( woocommerce_product_loop() ) {
    /**
     * Hook: woocommerce_sidebar.
     *
     * @hooked woocommerce_get_sidebar - 10
     */
 //   do_action( 'woocommerce_sidebar' );
    $sideBar = wp_get_menu_array('header-main-menu');
    ?><div class="shop-side-bar">
    <?php
        foreach ($sideBar as $item) {
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
     echo do_shortcode('[wpf-filters id=1]')

    ?>

    </div>
    <?php

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */

	?>
    <div class="shop-main-content-shop-items">

    <?php
	do_action( 'woocommerce_before_shop_loop' );


	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
echo "</div>";
echo "</div>";
echo "</div>";
get_footer( 'shop' );
