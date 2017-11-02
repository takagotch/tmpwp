<html>
  <head>
    <meta charset="UTF-8" />
    <title><?php my_title(); ?></title>
    <?php wp_head(); ?>
  </head>
  <body>
    <h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
<?php
if ( have_posts() ) :
  while( have_posts() ) :
    the_post();
?>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
<?php
  endwhile;
  $my_query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'no_found_rows' => true,
  ) );
  if ( $my_query->have_posts() ) :
?>
    <h2>News</h2>
    <ul>
<?php
    while ( $my_query->have_posts() ) :
      $my_query->the_post();
?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
    endwhile;
?>
    </ul>
<?php
    wp_reset_postdata();
  endif;
?>
    <h2>Meta</h2>
<?php
    the_meta();
endif;
?>
    <?php wp_footer(); ?>
  </body>
</html>

