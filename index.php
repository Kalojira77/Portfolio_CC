<?php
/**
 * Blueprint – Template fallback
 * Rôle : dernier recours si aucun autre template ne correspond.
 *
 * Il doit fonctionner pour :
 * - une liste (blog/archives)
 * - un contenu individuel (rare, mais possible selon config)
 */

get_header();
?>

<main id="content" class="bp-main bp-index" role="main">
  <section class="bp-section">
    <div class="bp-container">

      <header class="bp-page-header">
        <h1 class="bp-page-title"><?php bloginfo('name'); ?></h1>
      </header>

      <?php if (have_posts()) : ?>
        <div class="bp-posts">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('bp-post'); ?>>

              <h2 class="bp-post-title">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h2>

              <p class="bp-post-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                  <?php echo esc_html(get_the_date()); ?>
                </time>
              </p>

              <div class="bp-post-excerpt">
                <?php
                // Si c'est un "single", on affiche le contenu, sinon un extrait
                if (is_singular()) {
                  the_content();
                } else {
                  the_excerpt();
                }
                ?>
              </div>

            </article>
          <?php endwhile; ?>
        </div>

        <?php if (!is_singular()) : ?>
          <nav class="bp-pagination" aria-label="Pagination">
            <?php
            the_posts_pagination([
              'mid_size'  => 1,
              'prev_text' => 'Précédent',
              'next_text' => 'Suivant',
            ]);
            ?>
          </nav>
        <?php endif; ?>

      <?php else : ?>
        <p>Aucun contenu trouvé.</p>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();
