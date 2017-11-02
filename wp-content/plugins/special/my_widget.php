<?php
class My_Widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'my_widget',
      '投稿タイプリンク',
      array( 'description' => '投稿タイプのリンクを作成します。' )
    );
  }

  function widget( $args, $instance ) {
    if ( isset( $instance['ptype'] ) ) {
      $ptype = get_post_type_object( $instance['ptype'] );
      if ( $ptype && $ptype->public && $ptype->has_archive ) {
        $link = get_post_type_archive_link( $instance['ptype'] );
        $label = $ptype->labels->name;
        echo $args['before_widget'];
?>
  <p>
    <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $label ); ?></a>
  </p>
<?php
        echo $args['after_widget'];
      }
    }
  }

  function form( $instance ) {
    $ptype = '';
    if ( isset( $instance['ptype'] ) ) {
      $ptype = $instance['ptype'];
    }
?>
  <p>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ptype' ); ?>" name="<?php echo $this->get_field_name( 'ptype' ); ?>" type="text" value="<?php echo esc_attr( $ptype ); ?>">
  </p>
<?php
  }

  function update( $new_instance, $old_instance ) {
    $instance = array( 'ptype' => '' );
    if ( isset( $new_instance['ptype'] ) ) {
      $instance['ptype'] = $new_instance['ptype'];
    }
    return $instance;
  }

} // class end

