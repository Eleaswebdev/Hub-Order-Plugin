<?php
/**
 * Functionality to add Customer Support role and their capabilities
 */

add_role(
    'customer_support',
    __('Customer Support'),
);

function add_custom_caps_to_customer_support_role() {
    $role = get_role('customer_support');
    if (!$role) {
        return;
    }
    $role->add_cap('read');
    $role->add_cap('read_post');
    $role->add_cap('read_private_posts');
    $role->add_cap('edit_posts');
    $role->add_cap('edit_others_posts');
    $role->add_cap('edit_private_posts');
    $role->add_cap('edit_published_posts');
    $role->add_cap('publish_posts');
    $role->add_cap('delete_posts');
    $role->add_cap('delete_private_posts');
    $role->add_cap('delete_published_posts');
    $role->add_cap('delete_others_posts');

    // Add capabilities for managing pages
    $role->add_cap('edit_pages');
    $role->add_cap('edit_others_pages');
    $role->add_cap('edit_published_pages');
    $role->add_cap('publish_pages');
    $role->add_cap('delete_pages');
    $role->add_cap('delete_others_pages');
    $role->add_cap('delete_published_pages');
    $role->add_cap('delete_private_pages');
    $role->add_cap('edit_private_pages');
    $role->add_cap('read_private_pages');
}
add_action('init', 'add_custom_caps_to_customer_support_role');