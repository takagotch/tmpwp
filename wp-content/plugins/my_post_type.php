<?php
/**
* Plugin Name: My Post Type
*/

class My_Post_Type {

  function __construct() {
    // initアクションのフック
    add_action( 'init', array( $this, 'post_type' ),10 );
  }

  function post_type() {
    // 投稿タイプsample_post_typeの登録
    register_post_type(
      'sample_post_type', array(
        'public'       => true,
        'hierarchical' => false,
        'has_archive'  => true,
        'labels' => array(
          'name'         => 'サンプル',
          'add_new_item' => 'サンプルの新規追加',
          'edit_item'    => 'サンプルの編集',
        ),
        'supports' => array(
        'title',
        'editor',
        'custom-fields',
        ),
      )
    );

  }

} // class end

new My_Post_Type();

