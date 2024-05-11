<?php
/**
 * Enqueue all necessary scripts here
 */
add_action('wp_enqueue_scripts', 'wppool_enq_react');
function wppool_enq_react(){
    wp_register_script('display-react',
    plugin_dir_url( __FILE__ ) . '../build/index.js',
    ['wp-element'],
    rand(), // Change this to null for production
    true);
    $current_user = wp_get_current_user();
    $data = array( 
     'roles' => $current_user->roles
     );
    wp_localize_script( 'display-react', 'object', $data );
    wp_enqueue_script( 'display-react' );    
}
function wppool_enqueue_styles() {
    wp_enqueue_style('hub-order-plugin-css', plugin_dir_url(__FILE__) . '../css/style.css');
}
add_action('admin_enqueue_scripts', 'wppool_enqueue_styles');