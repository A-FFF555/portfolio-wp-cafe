<?php get_header(); ?>

<main class="not-found__container">
  <div class="not-found__inner">
    <h2 class="not-found__ttl">404 Not Found</h2>
    <p class="not-found__txt">お探しのページは見つかりませんでした。</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="sns_cta_button not-found__button">
      Back to Top
    </a>
  </div>
</main>

<?php get_footer(); ?>