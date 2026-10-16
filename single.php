<?php get_header(); ?>

<main class="container news__container">

  <?php while (have_posts()) : the_post(); ?>
    <article class="news__entry">
      <time class="news__item-date">
        <?php echo get_the_date('Y.m.d'); ?>
      </time>
      <h1 class="news__entry-ttl">
        <?php the_title(); ?>
      </h1>

      <div class="news__entry-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>

</main>

<?php get_footer(); ?>