<?php get_header(); ?>

<main class="container page__container">

  <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="page__thumbnail">
        <?php the_post_thumbnail('medium'); ?>
      </div>

      <h1 class="page__ttl">
        <?php the_title(); ?>
      </h1>

      <div class="page__content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>

</main>

<?php get_footer(); ?>