<?php
/*
Plugin Name: My Special
*/

class My_Special {

  public $options = array();

  function __construct() {
    register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		add_action( 'init', array( $this, 'register_post_type_and_taxonomy' ) );
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		add_action( 'admin_menu', array( $this, 'add_special_menu') );
		$options = get_option( 'my_special' );
		$defaults = array( 'display' => '1' );
		$this->options = wp_parse_args( $options, $defaults );
  }

  function activate() {
    add_role( 'special', 'Special' );
    $role = get_role( 'special');
    $role->add_cap( 'read' );
    $role = get_role( 'administrator' );
    $role->add_cap( 'special' );
		$this->register_post_type_and_taxonomy();
		flush_rewrite_rules();
		update_option( 'my_special', $this->options );
  }

  function register_post_type_and_taxonomy() {

    register_post_type(
      'special', array(
        'public'       => true,
        'hierarchical' => false,
        'has_archive'  => true,
        'labels' => array(
          'name'         => '特集',
          'add_new_item' => '特集の新規追加',
          'edit_item'    => '特集の編集',
        ),
        'supports' => array(
          'title',
          'editor',
          'custom-fields',
          'author',
        ),
        'capability_type' => 'special',
        'map_meta_cap'    => true,
        'capabilities' => array(
          'edit_posts'             => 'special',
          'edit_others_posts'      => 'administrator',
          'publish_posts'          => 'special',
          'read_private_posts'     => 'special',
          'delete_posts'           => 'special',
          'delete_private_posts'   => 'special',
          'delete_published_posts' => 'special',
          'delete_others_posts'    => 'administrator',
          'edit_private_posts'     => 'special',
          'edit_published_posts'   => 'special',
        ),
      )
    );

    register_taxonomy(
      'special_tag', 'special', array(
        'public'            => true,
        'hierarchical'      => false,
        'show_admin_column' => true,
        'labels' => array(
          'name'         => '特集タグ',
          'add_new_item' => '特集タグの新規追加',
          'edit_item'    => '特集タグの編集',
        ),
        'capabilities' => array(
          'manage_terms' => 'administrator',
          'edit_terms'   => 'administrator',
          'delete_terms' => 'administrator',
          'assign_terms' => 'special',
        ),
      )
    );

  }

  function register_widget() {
    require_once( dirname( __FILE__ ) . '/my_widget.php' );
    register_widget( 'My_Widget' );
  }

  function add_special_menu() {
    add_options_page( 'Special 設定', 'Special 設定', 'manage_options', 'my_special.php', array( $this, 'option_page' ) );
  }

  function option_page() {
?>
<div class="wrap">
  <?php screen_icon(); ?>
  <h2>Special 設定</h2>
<?php
  $display = $this->options['display'];
  if ( isset( $_POST['special_nonce'] ) ) {
    check_admin_referer( 'special_action', 'special_nonce' );

    $display = 0;
    if ( isset( $_POST['display'] ) && 1 == $_POST['display'] ) {
      $display = 1;
    }
    update_option( 'my_special', array( 'display' => $display ) );
?>
  <p>保存しました。</p>
<?php
  }

?>
  <form action="" method="post">
    <?php wp_nonce_field('special_action', 'special_nonce'); ?>
    <p>
      <input type="checkbox" id="display" name="display" value="1"<?php if ( $display ) : ?> checked="checked"<?php endif; ?>>
      <label for="display">
      ログインユーザーに特集の追加情報を表示する
      </label>
    </p>
    <?php submit_button(); ?>
  </form>
</div>
<?php
  }

  function deactivate() {
		delete_option( 'my_special' );
	}

} // class end

new My_Special();

