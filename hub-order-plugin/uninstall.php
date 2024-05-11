<?php
// If uninstall is not called from WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

$plugin_options = array(
    'rest_secret_key',
    'rest_base_url',
);
foreach ( $plugin_options as $option_name ) {
    delete_option( $option_name );
}

// Delete all posts of custom post type "orders"
$args = array(
    'post_type'      => 'orders',
    'posts_per_page' => -1,
    'post_status'    => 'any'
);

$orders_query = new WP_Query( $args );

if ( $orders_query->have_posts() ) {
    while ( $orders_query->have_posts() ) {
        $orders_query->the_post();
        
        // Delete post meta associated with the current order post
        $post_id = get_the_ID();
        $post_meta_keys = get_post_custom_keys( $post_id );

        if ( is_array( $post_meta_keys ) ) {
            foreach ( $post_meta_keys as $meta_key ) {
                delete_post_meta( $post_id, $meta_key );
            }
        }

        // Delete the post itself
        wp_delete_post( $post_id, true );
    }
    wp_reset_postdata();
}