<?php
/**
 * Template pour une fiche film (single-film.php).
 */

if ( ! defined( 'ABSPATH' ) ) exit;
get_header(); ?>

<main id="primary" class="site-main">
<?php
if ( have_posts() ) :
while ( have_posts() ) : the_post();

$fields = [
 'annee','titre_original','duree','realisation','scenario','image','son','montage','musique',
 'production','coproduction','diffuseur','festivals','prix','vimeo_url'
];
foreach ($fields as $f) {
  ${$f} = get_post_meta(get_the_ID(), "_cecile_film_$f", true);
}
?>

<article <?php post_class(); ?>>
<header>
  <h1><?php the_title(); ?></h1>

  <p>
    <?php if($annee) echo esc_html($annee).' • '; ?>
    <?php if($duree) echo esc_html($duree).' min'; ?>
    <?php if($titre_original) echo ' — ('.$titre_original.')'; ?>
  </p>

  <?php if ( has_post_thumbnail() ) the_post_thumbnail('large'); ?>
</header>

<div class="entry-content">
  <?php the_content(); ?>
</div>

<section class="film-credits">
<?php if($realisation): ?><p><strong>Réalisation :</strong> <?php echo esc_html($realisation); ?></p><?php endif; ?>
<?php if($scenario): ?><p><strong>Scénario :</strong> <?php echo esc_html($scenario); ?></p><?php endif; ?>
<?php if($image): ?><p><strong>Image :</strong> <?php echo esc_html($image); ?></p><?php endif; ?>
<?php if($son): ?><p><strong>Son :</strong> <?php echo esc_html($son); ?></p><?php endif; ?>
<?php if($montage): ?><p><strong>Montage :</strong> <?php echo esc_html($montage); ?></p><?php endif; ?>
<?php if($musique): ?><p><strong>Musique :</strong> <?php echo esc_html($musique); ?></p><?php endif; ?>
<?php if($production): ?><p><strong>Production :</strong> <?php echo esc_html($production); ?></p><?php endif; ?>
<?php if($coproduction): ?><p><strong>Coproduction :</strong> <?php echo esc_html($coproduction); ?></p><?php endif; ?>
<?php if($diffuseur): ?><p><strong>Diffuseur :</strong> <?php echo esc_html($diffuseur); ?></p><?php endif; ?>
<?php if($festivals): ?><p><strong>Sélections :</strong><br><?php echo nl2br(esc_html($festivals)); ?></p><?php endif; ?>
<?php if($prix): ?><p><strong>Prix :</strong><br><?php echo nl2br(esc_html($prix)); ?></p><?php endif; ?>
</section>

<?php if($vimeo_url): ?>
<section class="film-video">
  <h2>Visionner le film</h2>
  <?php echo wp_oembed_get($vimeo_url); ?>
</section>
<?php endif; ?>

</article>

<?php endwhile; endif; ?>
</main>

<?php get_footer();
