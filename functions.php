<?php

/*--------------------------------------------------
  1. Theme Setup
--------------------------------------------------*/
// add_theme_support など

// カスタムヘッダーを有効化
function my_cafe_theme_setup()
{
  add_theme_support('custom-header', [
    'default-image' => '', // デフォルト画像があればここにパスを記述
    'width'         => 1920,
    'height'        => 1080,
    'flex-width'    => true,
    'flex-height'   => true,
    'uploads' => true, //ヒーロー画像スライダー用
  ]);

  // タイトルタグを自動生成
  add_theme_support('title-tag');

  // アイキャッチ画像を有効化
  add_theme_support('post-thumbnails');

  // カスタムロゴ有効化
  add_theme_support('custom-logo', [
    'height' => 100,
    'width' => 300,
    'flex-height' => true,
    'flex-width' => true,
  ]);
}
add_action('after_setup_theme', 'my_cafe_theme_setup');

/*--------------------------------------------------
  2. Custom Post Types
--------------------------------------------------*/
// register_post_type など

// カスタム投稿タイプ：メニュー（menu）の登録
function register_custom_post_menu()
{
  $labels = [
    'name'               => 'メニュー',
    'singular_name'      => 'メニュー',
    'add_new'            => '新しく追加',
    'add_new_item'       => '新しいメニューを追加',
    'edit_item'          => 'メニューを編集',
    'new_item'           => '新しいメニュー',
    'view_item'          => 'メニューを表示',
    'search_items'       => 'メニューを検索',
    'not_found'          => 'メニューが見つかりませんでした',
    'not_found_in_trash' => 'ゴミ箱内にメニューは見つかりませんでした',
  ];

  $args = [
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => false, // メニューもアーカイブページは作らない
    'menu_position'      => 5,     // 投稿の下あたりに表示
    'menu_icon'          => 'dashicons-food', // アイコンをフォークとナイフに
    'supports'           => ['title', 'thumbnail', 'page-attributes'], // タイトル、アイキャッチ、順序を有効化
    'rewrite'            => ['with_front' => false],
    'show_in_rest'       => true,  // ブロックエディタ(Gutenberg)を有効化
  ];

  register_post_type('menu', $args);
}
add_action('init', 'register_custom_post_menu');

/*--------------------------------------------------
  3. Assets Enqueue (CSS, JS, Fonts)
--------------------------------------------------*/

function my_theme_resource_hints($urls, $relation_type)
{
  if (wp_style_is('my-google-fonts', 'queue') && $relation_type === 'preconnect') {
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = 'https://fonts.gstatic.com';
  }
  return $urls;
}
add_filter('wp_resource_hints', 'my_theme_resource_hints', 10, 2);

function my_cafe_theme_enqueue_assets()
{

  // Google Fonts
  $font_url = 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Noto+Serif+JP:wght@300&display=swap';
  wp_enqueue_style('my-google-fonts', $font_url, [], null);

  // SwiperのCSS
  wp_enqueue_style(
    'swiper-css',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
  );

  // メインのCSS
  wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', ['my-google-fonts', 'swiper-css'], filemtime(get_theme_file_path('/assets/css/main.css')));

  // SwiperのJS
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.0.0', true);

  // 自作のJS
  wp_enqueue_script('main-script', get_theme_file_uri('/assets/js/main.js'), ['swiper-js'], filemtime(get_theme_file_path('/assets/js/main.js')), true);
}
add_action('wp_enqueue_scripts', 'my_cafe_theme_enqueue_assets');

/*--------------------------------------------------
  4. SEO & Visibility (noindex, etc.)
--------------------------------------------------*/
// 個別ページやアーカイブをnoindexする

add_action('wp_head', function () {
  // 個別投稿、またはアーカイブ、404ページの場合
  if (is_single() || is_archive() || is_404()) {
    echo '<meta name="robots" content="noindex, follow">';
  }
});

/*--------------------------------------------------
  5. Customizer Settings
--------------------------------------------------*/
// カスタマイザーの設定（サイトの見た目の設定）

// ヒーローエリアの設定とインスタ埋め込みの代わり
function my_theme_customize_register($wp_customize)
{

  $wp_customize->add_section('hero_section_settings', [
    'title'    => 'ヒーローエリア設定',
    'priority' => 30,
  ]);

  // メインコピーの設定
  $wp_customize->add_setting('hero_main_copy', [
    'default'   => 'Breath in, Sip slow.', // デフォルト値
    'sanitize_callback' => 'sanitize_text_field', // セキュリティ対策
  ]);

  // コントロール（入力欄）の追加
  $wp_customize->add_control('hero_main_copy_control', [
    'label'    => 'ヒーロー画像中央のメッセージ',
    'section'  => 'hero_section_settings', // 上で作ったセクションID
    'settings' => 'hero_main_copy',
    'type'     => 'text',
  ]);

  // セクションの追加
  $wp_customize->add_section('insta_gallery_section', [
    'title'    => 'インスタ風ギャラリー画像',
    'priority' => 200,
  ]);

  // 4枚分の画像設定をループで登録
  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("insta_image_$i");
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "insta_image_$i", [
      'label'    => "画像 $i",
      'section'  => 'insta_gallery_section',
      'settings' => "insta_image_$i",
    ]));
  }
}
add_action('customize_register', 'my_theme_customize_register');
