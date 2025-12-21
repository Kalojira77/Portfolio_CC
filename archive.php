<?php
/**
 * Blueprint – Archives
 * Rôle : listes de contenus (catégories, tags, date, auteur, etc.)
 */

get_header();
?>

<main id="content" class="bp-main bp-archive" role="main">
  <section class="bp-section">
    <div class="bp-container">

      <header class="bp-page-header">
        <h1 class="bp-page-title"><?php the_archive_title(); ?></h1>
        <?php
        $desc = get_the_archive_description();
        if ($desc) : ?>
          <div class="bp-page-description">
            <?php echo wp_kses_post($desc); ?>
          </div>
        <?php endif; ?>
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
                <?php the_excerpt(); ?>
              </div>

            </article>
          <?php endwhile; ?>
        </div>

        <nav class="bp-pagination" aria-label="Pagination">
          <?php
          the_posts_pagination([
            'mid_size'  => 1,
            'prev_text' => 'Précédent',
            'next_text' => 'Suivant',
          ]);
          ?>
        </nav>

      <?php else : ?>
        <p>Aucun contenu trouvé.</p>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();
