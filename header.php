<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
  <link rel="canonical" href="<?php echo esc_url(is_home() ? home_url('/') : get_permalink()); ?>">

  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
  <meta property="og:url" content="<?php echo esc_url(home_url(add_query_arg([], $wp->request))); ?>">
  <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
  <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">

  <?php
  // サムネイルがあれば取得、なければデフォルト画像（?? で代打指定）
  $thumb_id = get_post_thumbnail_id();
  $thumb_src = wp_get_attachment_image_src($thumb_id, 'full');
  $ogp_url = $thumb_src[0] ?? (get_template_directory_uri() . '/assets/images/ogp-default.png');
  ?>
  <meta property="og:image" content="<?php echo esc_url($ogp_url); ?>">

  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/favicon.ico')); ?>">
  <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri('/assets/images/apple-touch-icon.png')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="site-header">
    <div class="site-header__inner">
      <h1 class="site-header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__ttl">
          <?php
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
          if (has_custom_logo()) :
          ?>
            <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="site-header__icon">
          <?php else : ?>
            <?php bloginfo('name'); ?>
          <?php endif; ?>
        </a>
      </h1>
      <nav class="nav" id="primary-nav">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="<?php echo esc_url(home_url('/')); ?>#about" class="nav__item-link">About</a>
          </li>
          <li class="nav__item">
            <a href="<?php echo esc_url(home_url('/')); ?>#access" class="nav__item-link">Access</a>
          </li>
          <li class="nav__item">
            <a href="<?php echo esc_url(home_url('/')); ?>#menu" class="nav__item-link">Menu</a>
          </li>
          <li class="nav__item">
            <a href="<?php echo esc_url(home_url('/')); ?>#news" class="nav__item-link">News</a>
          </li>
        </ul>
      </nav>

      <button type="button" class="sp-nav__trigger js-nav-trigger" aria-controls="primary-nav" aria-expanded="false">
        <span class="sp-nav__txt">MENU</span>
        <div class="sp-nav__icon">
          <span class="sp-nav-border"></span>
          <span class="sp-nav-border"></span>
        </div>
      </button>
    </div>
  </header>