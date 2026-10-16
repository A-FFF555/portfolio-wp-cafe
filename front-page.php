<?php get_header(); ?>

<main>
  <section class="hero swiper js-hero-swiper">
    <div class="swiper-wrapper">

      <?php
      $headers = get_uploaded_header_images();
      if ($headers) :
        foreach ($headers as $header) : ?>
          <div class="swiper-slide">
            <div class="slide-img" style="background-image: url(<?php echo esc_url($header['url']); ?>);"></div>
          </div>
      <?php
        endforeach;
      endif;
      ?>

    </div>
  </section>

  <div class="hero__overlay">

    <h2 class="hero__main-copy">
      <?php
      // カスタマイザーの値を取得。空ならデフォルトを表示
      echo esc_html(get_theme_mod('hero_main_copy', 'Breath in, Sip slow.'));
      ?>
    </h2>

    <button type="button" class="hero__pause js-hero-pause" aria-label="スライドショーを一時停止">停止</button>

    <?php
    $news_query = new WP_Query(['posts_per_page' => 1]);

    if ($news_query->have_posts()) :
      while ($news_query->have_posts()) : $news_query->the_post(); ?>

        <a href="#news" class="hero__news-bar">
          <span class="hero__news-label">News</span>
          <span class="hero__news-date"><?php echo esc_html(get_the_date('Y.m.d')); ?></span>
          <span class="hero__news-title"><?php the_title(); ?></span>
          <span class="hero__news-arrow">→</span>
        </a>

    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>

  <!-- ここからコンテンツ -->

  <!-- 店舗紹介 -->
  <section id="about" class="content__wrapper">
    <div class="container">
      <h2 class="content__ttl">01/ About</h2>
      <div class="about">
        <?php
        //固定ページABOUTのサムネと本文を取得
        $about_page = get_page_by_path('cafe_about');
        if ($about_page) :
        ?>

          <div class="about__thumbnail">
            <?php echo wp_kses_post(get_the_post_thumbnail($about_page->ID, 'large', ['class' => 'about__img'])); ?>
          </div>

          <div class="about__txt-box">
            <?php echo apply_filters('the_content', $about_page->post_content); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- アクセス -->
  <section id="access" class="content__wrapper">
    <div class="container">
      <h2 class="content__ttl">02/ Access</h2>
      <div class="access">

        <div class="access__info">
          <table class="access__info-table">
            <tr>
              <th>Address</th>
              <td>〒000-0000<br>北海道●●市××区 1-2-3 ▲■●ビル 1F</td>
            </tr>
            <tr>
              <th>Open</th>
              <td>11:00 - 19:00 (L.O. 18:30)</td>
            </tr>
            <tr>
              <th>Closed</th>
              <td>Tuesday, Wednesday</td>
            </tr>
            <tr>
              <th>Tel</th>
              <td>000-123-4567</td>
            </tr>
          </table>

          <div class="access__button">
            <a href="https://maps.app.goo.gl/hbDZg1dNDtPENvih7" target="_blank" class="access__button-link">Google Mapsで開く</a>
          </div>
        </div>

        <div class="access__map">
          <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23322.02179896804!2d141.344768!3d43.05715199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f0b295148c5d329%3A0xe6cb236ed20e09e!2z5aSn6YCa5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1769491753978!5m2!1sja!2sjp" title="店舗へのアクセスマップ" allow="fullscreen" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- メニュー紹介 -->
  <section id="menu" class="content__wrapper">
    <div class="container">
      <h2 class="content__ttl">03/ Menu</h2>
      <div class="menu">

        <?php
        $menu_query = new WP_Query([
          'post_type' => 'menu',
          'posts_per_page' => 5,
          'orderby' => 'menu_order',
          'order' => 'ASC',
        ]);
        if ($menu_query->have_posts()) :
          while ($menu_query->have_posts()) : $menu_query->the_post(); ?>

            <div class="menu__item">
              <?php the_post_thumbnail('medium_large', ['class' => 'menu__img']); ?>
              <span class="menu__name"><?php the_title(); ?></span>
            </div>
        <?php endwhile;
          wp_reset_postdata();
        endif; ?>

      </div>

      <div class="sns-cta">
        <a href="#" class="sns-cta__link" target="_blank">
          <p class="sns-cta__txt">季節のメニューや日々の最新情報はInstagramにて更新しています</p>
          <div class="sns-cta__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free 7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
              <path d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z" />
            </svg>
          </div>
          <span class="sns-cta__button">Follow on Instagram</span>
        </a>
      </div>

    </div>
  </section>

  <!-- ニュース -->
  <section id="news" class="content__wrapper">
    <div class="container">
      <h2 class="content__ttl">04/ News</h2>

      <div class="news__list">
        <?php
        $args = [
          'posts_per_page'      => 3,
          'ignore_sticky_posts' => true,
        ];
        $news_query = new WP_Query($args);

        if ($news_query->have_posts()) :
          while ($news_query->have_posts()) : $news_query->the_post(); ?>

            <article class="news__item">
              <div class="news__item-meta">
                <time class="news__item-date"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                <h3 class="news__entry-ttl"><?php the_title(); ?></h3>
              </div>

              <div class="news__entry-content">
                <?php the_content(); ?>
              </div>
            </article>

          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p>お知らせはありません。</p>
        <?php endif; ?>

        <div class="sns-cta">
          <a href="#" class="sns-cta__link" target="_blank">
            <p class="sns-cta__txt">季節のメニューや日々の最新情報はInstagramにて更新しています</p>
            <div class="sns-cta__icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free 7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                <path d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z" />
              </svg>
            </div>
            <span class="sns-cta__button">Follow on Instagram</span>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- インスタ風エリア -->
  <section class="insta__wrapper">
    <div class="insta__container--grid">

      <?php for ($i = 1; $i <= 4; $i++) :
        $img_url = get_theme_mod("insta_image_$i");
        if ($img_url) : ?>
          <div class="insta__card">
            <img src="<?php echo esc_url($img_url); ?>" class="insta__img" alt="">
          </div>
        <?php else : ?>
          <div class="insta__card" style="background: #f0f0f0;"></div>
      <?php endif;
      endfor; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?>