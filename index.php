<?php
// このテーマでは記事一覧・検索結果ページを設けない
if (is_archive() || is_home() || is_search()) {
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  nocache_headers();

  require get_404_template();
  return;
}

get_header();
?>

<main>

  <div class="post__container">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article>
          <h1><?php the_title(); ?></h1>
          <div class="post__content">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>

      <div class="pagination">
        <?php the_posts_pagination(); ?>
      </div>

    <?php else : ?>
      <p>記事が見つかりませんでした。</p>
    <?php endif; ?>
  </div>

</main>

<?php get_footer(); ?>