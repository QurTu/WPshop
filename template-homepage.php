<?php
/*
Template Name: Homepage Template
*/
get_header();
?>


    <div class="full-width-container">
       <div class="content-container">
           <div class="homepage-hero-img">

               <img src=" <?php echo  get_the_post_thumbnail_url() ?>"/>
           </div>
       </div>
    </div>
        <div class="content-container">

            <?php
            if (get_field('homepage_featured_cat')) {
                $categories = get_field('homepage_featured_cat');
                ?>
                <div class="homepage-selected-categories">
                    <?php  foreach ($categories as $category) {
                        $term_id = $category['category'];
                        $thumb_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
                        $term_img = wp_get_attachment_url(  $thumb_id );
                        ?>
                    <div class="homepage-selected-category">
                        <img src="<?php echo $term_img ?>"/>
                        <div class="home-page-selected-category-text">
                            <div class="homepage-selected-category-title"><?php echo get_term( $term_id )->name; ?></div>
                            <a href="<?php echo get_term_link($term_id ) ?>"> PERZIURETI</a>
                        </div>
                    </div>

                    <?php } ?>
                </div>



                <?php
            }
            ?>




        </div>
    <div class="content-container homepage-popular-products-container">
        <div class="section-title-text">
            <?php _e('Popureliausios prekės') ?>
        </div>
        <div class="homepage-popular-products-grid">

            <?php
                $query = new WP_Query( array(
                    'posts_per_page' => 10,
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                ) );
                if($query->have_posts()) :
                    while($query->have_posts()) : $query->the_post();
                        ?>
                        <div class="homepage-popular-product">
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;

            ?>

        </div>
    </div>
    <div class="content-container homepage-popular-products-container">
        <div class="section-title-text">
            <?php _e('Naujausios prekės') ?>
        </div>
        <div class="homepage-popular-products-grid">

                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 10
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                     ?>
                        <div class="homepage-popular-product">
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
                    <?php
                    endwhile;
                } else {
                    echo __( 'No products found' );
                }
                wp_reset_postdata();
                ?>
            </ul><!--/.products-->
        </div>
    </div>


<?php
get_footer();
