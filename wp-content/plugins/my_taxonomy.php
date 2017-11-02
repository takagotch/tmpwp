<?php
/**
* Plugin Name: My Taxonomy
*/

class My_Taxonomy {

  function __construct() {
    // initアクションのフック
    add_action( 'init', array( $this, 'my_init' ),10 );
  }

  function my_init() {
    // カスタムタクソノミーsample_taxonomyの登録
    register_taxonomy(
      'sample_taxonomy', 'sample_post_type', array(
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'labels' => array(
          'name'         => 'サンプルタクソノミー',
          'add_new_item' => 'サンプルタクソノミーの新規追加',
          'edit_item'    => 'サンプルタクソノミーの編集',
        ),
      )
    );

  }

} // class end

new My_Taxonomy();

