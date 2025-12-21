<?php
/**
 * Blueprint – Template pages standards
 * Rôle : Contact, Mentions légales, Politique de confidentialité, etc.
 *
 * Notes :
 * - Astra gère le header/footer + beaucoup de wrappers
 * - Ici on ajoute juste un <main> + conteneur + structure stable
 */

get_header();
?>

<main id="content" class="bp-main bp-page" role="main">
  <section class="bp-section">
    <div class="bp-container">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <header class="bp-page-header">
          <h1 class="bp-page-title"><?php the_title(); ?></h1>
        </header>

        <div class="bp-page-content">
          <?php the_content(); ?>
        </div>

      <?php endwhile; endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();
