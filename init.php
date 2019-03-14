<?php
/*
Plugin Name: Globie Gutenberg Plugin
*/

// Reference: https://wordpress.org/gutenberg/handbook

/*
Override block style
*/
function igv_gutenberg_block_style() {
  wp_enqueue_script('igv_style',
    plugins_url('style.js', __FILE__ ),
    array('wp-blocks')
  );
}
add_action( 'enqueue_block_editor_assets', 'igv_gutenberg_block_style' );

/*
Register new block type
*/
function igv_gutenberg_block_type() {
  // Register block type script
  wp_register_script(
    'igv-block-type-editor',
    plugins_url( 'type.js', __FILE__ ),
    array(
      'wp-blocks',
      'wp-element',
      'wp-editor' // Remove this if creating static block
    )
  );

  /* Register editor styles */
  wp_register_style(
    'igv-block-type-editor',
    plugins_url( 'editor-style.css', __FILE__ ),
    array( 'wp-edit-blocks' ),
    filemtime( plugin_dir_path( __FILE__ ) . 'editor-style.css' )
  );

  /* Register front-end styles */
  /*
  / These are considered base styles
  / and are overriden by editor styles
  / for the editor
  */
  wp_register_style(
    'igv-block-type',
    plugins_url( 'front-style.css', __FILE__ ),
    array(),
    filemtime( plugin_dir_path( __FILE__ ) . 'front-style.css' )
  );

  /* Register block type */
  register_block_type( 'igv-blocks/globie-gutenberg-block', array(
    'editor_script' => 'igv-block-type-editor',
    'editor_style'  => 'igv-block-type-editor',
    'style' => 'igv-block-type',
  ) );
}
add_action( 'init', 'igv_gutenberg_block_type' );

// WORK IN PROGRESS
/*
Register Sidebar
*/
/*
function sidebar_plugin_register() {
    wp_register_script(
        'plugin-sidebar-js',
        plugins_url( 'plugin-sidebar.js', __FILE__ ),
        array( 'wp-plugins', 'wp-edit-post', 'wp-element' )
    );
}
add_action( 'init', 'sidebar_plugin_register' );

function sidebar_plugin_script_enqueue() {
    wp_enqueue_script( 'plugin-sidebar-js' );
}
add_action( 'enqueue_block_editor_assets', 'sidebar_plugin_script_enqueue' );
*/
