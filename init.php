<?php
/*
Plugin Name: Globie Gutenberg Block
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

/*
Register Sidebar
*/
function igv_sidebar_register() {
  wp_register_script(
    'igv-sidebar-script',
    plugins_url( 'sidebar.js', __FILE__ ),
    array(
      'wp-plugins',
      'wp-edit-post',
      'wp-element',
      'wp-components',
      'wp-data'
    )
  );
  wp_register_style(
    'igv-sidebar-style',
    plugins_url( 'sidebar-style.css', __FILE__ )
  );
  register_meta( 'post', 'igv_sidebar_meta_block_field', array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  ) );
}
add_action( 'init', 'igv_sidebar_register' );

function igv_sidebar_script_enqueue() {
  wp_enqueue_script( 'igv-sidebar-script' );
}
add_action( 'enqueue_block_editor_assets', 'igv_sidebar_script_enqueue' );

function igv_sidebar_style_enqueue() {
    wp_enqueue_style( 'igv-sidebar-style' );
}
add_action( 'enqueue_block_assets', 'igv_sidebar_style_enqueue' );
