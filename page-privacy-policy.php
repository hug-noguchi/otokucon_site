<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
  $page_id = get_page_by_path('privacy-policy-kyusyu');
  $page = get_post( $page_id );
    echo $page -> post_content;
?>

<?php endwhile; endif;?>

<?php get_footer('kyusyu'); ?>
