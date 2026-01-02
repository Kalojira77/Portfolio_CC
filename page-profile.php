<?php
/*
Template Name: Profile Page
*/
get_header();
?>

<main id="primary" class="site-main bp-page" role="main">
  <div class="bp-container">
    <?php
    if ( have_posts() ) {
      while ( have_posts() ) {
        the_post();
        the_content();
      }
    }
    ?>
  </div>
</main>

<?php
get_footer();
?>
