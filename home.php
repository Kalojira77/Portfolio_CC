<?php
/**
 * Blueprint – Page Blog (liste des articles)
 * Rôle : template utilisé pour la "Page des articles" (Réglages > Lecture)
 *
 * Important : home.php = page Blog / posts index
 * (Ce n'est PAS la page d'accueil vitrine : ça c'est front-page.php)
 */

get_header();
?>

<main id="content" class="bp-main bp-blog" role="main">
  <section class="bp-section">
    <div class="bp-container">

      <header class="bp-page-header">
        <h1 class="bp-page-title">
          <?php
          // Si une page "Blog" est assignée, on peut afficher son titre
          $posts_page_id = (int) get_option('page_for_posts');
          echo $posts_page_id ? esc_html(get_the_title($posts_page_id)) : 'Blog';
          ?>
        </h1>
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
        <p>Aucun article pour le moment.</p>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();
