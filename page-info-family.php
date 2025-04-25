<?php get_header(); ?>

<style>
  body {
    color: #000!important;
    font-family: "Noto Serif JP", serif!important;
  }

  header,
  header.l-header
   {
    display: none;
  }

  a {
    color: inherit!important;
  }

  main {
    padding-top: 0!important;
  }

  @media screen and (max-width: 768px) {
    .privacy {
      padding-top: 5vw!important;
    }
  }

  .header_logo {
    width: 10vw;
    margin-bottom: 100px;
  }

  @media screen and (max-width: 768px) {
    .header_logo {
      width: 30vw;
    }
  }

  .info dl dd a {
    color: #da0029!important;
  }

  .p-footer {
    padding: 0;
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
  $page_id = get_page_by_path('info-family');
  $page = get_post( $page_id );
    echo $page -> post_content;
?>

<?php endwhile; endif;?>

<?php get_footer('family'); ?>
