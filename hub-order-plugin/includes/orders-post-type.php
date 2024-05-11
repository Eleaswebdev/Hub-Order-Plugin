<?php

// Register custom post type for Orders
add_action('init', 'wppool_register_order_post_type');

function wppool_register_order_post_type() {
    register_post_type('orders', array(
        'labels' => array(
            'name'          => __('Orders', 'hub-order-plugin'),
            'singular_name' => __('Order', 'hub-order-plugin'),
            "menu_name"     => __( "All Orders", "hub-order-plugin" ),
            "all_items"     => __( "All Orders", "hub-order-plugin" ),
            "add_new"       => __( "Add New Order", "hub-order-plugin" ),
            "add_new_item"  => __( "Add New Order", "hub-order-plugin" ),
            "edit_item"     => __( "Edit Order", "hub-order-plugin" ),
            "new_item"      => __( "New Order", "hub-order-plugin" ),
            "view_item"     => __( "View Order", "hub-order-plugin" ),
            "view_items"    => __( "View Orders", "hub-order-plugin" ),
            "search_items"  => __( "Search Orders", "hub-order-plugin" ),
            "not_found"     => __( "No Orders Found", "hub-order-plugin" ),
            "not_found_in_trash" => __( "No Orders Found in Trash", "hub-order-plugin" ),
            "parent"        => __( "Parent Order", "hub-order-plugin" ),
            "items_list"    => __( "Orders list", "hub-order-plugin" ),
            "name_admin_bar" => __( "Order", "hub-order-plugin" ),
            "parent_item_colon" => __( "Parent Order", "hub-order-plugin" ),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => true,
        'capability_type' => 'post', // Set the capability type to 'post'
        'map_meta_cap' => true,
        'supports' => array('title'),
    ));
}
add_filter('post_updated_messages', 'wppool_updated_messages');

function wppool_updated_messages($messages) {
    global $post;

    $post_type = get_post_type($post);

    if ($post_type == 'orders') {
        $order_permalink = get_permalink($post->ID);

        $messages['post'][1] = sprintf(__('Order updated. <a href="%s">View Order</a>', 'hub-order-plugin'), esc_url($order_permalink));
        $messages['post'][6] = sprintf(__('Order published. <a href="%s">View Order</a>', 'hub-order-plugin'), esc_url($order_permalink));
        $messages['post'][8] = sprintf(__('Order submitted. <a href="%s">View Order</a>', 'hub-order-plugin'), esc_url($order_permalink));
        $messages['post'][10] = sprintf(__('Order draft updated. <a href="%s">View Order</a>', 'hub-order-plugin'), esc_url($order_permalink));
    }

    return $messages;
}