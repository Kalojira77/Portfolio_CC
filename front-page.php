<?php
/**
 * Blueprint – Page d’accueil
 * Rôle : structure vitrine standard
 */
get_header();
?>

<main class="bp-main">

  <!-- HERO -->
  <section class="bp-hero">
    <div class="bp-container">
      <h1><?php bloginfo('name'); ?></h1>
      <p><?php bloginfo('description'); ?></p>
    </div>
  </section>

  <!-- PRESENTATION -->
  <section class="bp-section bp-about">
    <div class="bp-container">
      <h2>À propos</h2>
      <p>Texte de présentation (blueprint).</p>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="bp-section bp-services">
    <div class="bp-container">
      <h2>Services</h2>
      <ul class="bp-grid">
        <li class="bp-card">Service 1</li>
        <li class="bp-card">Service 2</li>
        <li class="bp-card">Service 3</li>
      </ul>
    </div>
  </section>

  <!-- CALL TO ACTION -->
  <section class="bp-section bp-cta">
    <div class="bp-container">
      <h2>Contact</h2>
      <a class="bp-btn" href="<?php echo esc_url( home_url('/contact/') ); ?>">
        Me contacter
      </a>
    </div>
  </section>

</main>

<?php get_footer(); ?>
