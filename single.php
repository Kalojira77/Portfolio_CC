<?php
/**
 * Blueprint – Article individuel (single post)
 * Rôle : template pour afficher un article (post)
 */

get_header();
?>

<main id="content" class="bp-main bp-single" role="main">
  <section class="bp-section">
    <div class="bp-container">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class('bp-article'); ?>>

          <header class="bp-article-header">
            <h1 class="bp-article-title"><?php the_title(); ?></h1>

            <p class="bp-article-meta">
              <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date()); ?>
              </time>
              <span aria-hidden="true"> · </span>
              <span class="bp-article-author">
                <?php echo esc_html(get_the_author()); ?>
              </span>
            </p>
          </header>

          <div class="bp-article-content">
            <?php the_content(); ?>
          </div>

          <footer class="bp-article-footer">
            <?php
            $cats = get_the_category_list(', ');
            if ($cats) : ?>
              <p class="bp-article-cats">
                Catégories : <?php echo $cats; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
              </p>
            <?php endif; ?>

            <?php
            $tags = get_the_tag_list('', ', ');
            if ($tags) : ?>
              <p class="bp-article-tags">
                Tags : <?php echo $tags; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
              </p>
            <?php endif; ?>
          </footer>

        </article>

        <nav class="bp-post-nav" aria-label="Navigation des articles">
          <div class="bp-post-nav-prev">
            <?php previous_post_link('%link', '← %title'); ?>
          </div>
          <div class="bp-post-nav-next">
            <?php next_post_link('%link', '%title →'); ?>
          </div>
        </nav>

      <?php endwhile; endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();
