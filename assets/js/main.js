// Swiper
document.addEventListener('DOMContentLoaded', () => { // HTMLの読み込みを待つ

  const hero = document.querySelector('.js-hero-swiper');
  const pauseButton = document.querySelector('.js-hero-pause');

  if (!hero || !pauseButton) return;

  if (hero.querySelectorAll('.swiper-slide').length < 2) {
    pauseButton.hidden = true;
    return;
  }

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let isPaused = reducedMotion;

  const swiper = new Swiper(hero, {
    loop: true,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: reducedMotion ? false : {
      delay: 5000,
      disableOnInteraction: false,
    },
    speed: 2500,
    observer: true,
    observerParents: true,
    watchSlidesProgress: true,
  });

  const updateButton = () => {
    pauseButton.textContent = isPaused ? '再生' : '停止';
    pauseButton.setAttribute(
      'aria-label',
      isPaused ? 'スライドショーを再生' : 'スライドショーを一時停止'
    );
  };

  updateButton();

  pauseButton.addEventListener('click', () => {
    if (isPaused) {
      swiper.autoplay.start();
    } else {
      swiper.autoplay.stop();
    }

    isPaused = !isPaused;
    updateButton();
  });
});

// ヘッダー
// DOMの読み込みを待ってから実行
document.addEventListener('DOMContentLoaded', () => {
  let lastScroll = 0;
  const header = document.querySelector('.site-header');

  // ヘッダーが存在しない場合のガード
  if (!header) return;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 100) {
      // トップ付近（100px以内）にいるときは初期状態
      header.classList.remove('is-fixed', 'is-hidden');
      return;
    }

    if (currentScroll > lastScroll) {
      // 下にスクロールしているときは隠す
      header.classList.add('is-hidden');
      header.classList.remove('is-fixed');
    } else {
      // 上にスクロールしているときは出す
      header.classList.add('is-fixed');
      header.classList.remove('is-hidden');
    }

    lastScroll = currentScroll;
  }, {
    passive: true
  }); // パフォーマンス向上のためのオプション
});

// ハンバーガーメニュー
document.addEventListener('DOMContentLoaded', () => {
  const trigger = document.querySelector('.js-nav-trigger');
  const body = document.body;
  const navLinks = document.querySelectorAll('.nav__item-link');

  if (!trigger) return;

  // メニューの開閉
  trigger.addEventListener('click', () => {
    const isOpen = body.classList.toggle('nav-open'); // ナビの表示用

    document.documentElement.classList.toggle('nav-open', isOpen);
    trigger.classList.toggle('is-active', isOpen); // ボタンのアニメ用
    trigger.setAttribute('aria-expanded', String(isOpen));
  });

  // リンクをクリックしたらメニューを閉じる
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      body.classList.remove('nav-open');
      document.documentElement.classList.remove('nav-open');
      trigger.classList.remove('is-active');
      trigger.setAttribute('aria-expanded', 'false');
    });
  });
});