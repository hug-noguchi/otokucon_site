<?php get_header(); ?>

<style>
  .tokai .p-mainview_box {
    position: relative;
  }
  .tokai .campaign_date_tokai p {
    font-family: "游明朝体";
    font-size: 26px;
    color: #4d4d4d;
    position: absolute;
    top: 65.5%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
  }
  .tokai .campaign_date_tokai .date {
    font-size: 50px;
    padding-left: 20px;
  }
  .tokai .campaign_date_tokai .date_slash {
    font-family: inherit;
  }
  .tokai .campaign_date_tokai .day_circle {
    font-size: 16px;
    border: 1px solid;
    border-radius: 50%;
    padding: 3px;
    display: inline-block;
    width: 28px;
    height: 28px;
    line-height: 21px;
    text-align: center;
    box-sizing: border-box;
  }
  .tokai .campaign_date_tokai .until {
    font-family: "游明朝体+36ポかな";
    font-size: 20px;
  }
  @media (max-width: 480px) {
    .tokai .campaign_date_tokai p {
      font-size: 12px;
      top: 63.5%;
      width: 100%;
      justify-content: center;
    }
    .tokai .campaign_date_tokai .date {
      font-size: 27px;
      padding-left: 10px;
    }
    .tokai .campaign_date_tokai .day_circle {
      font-size: 9px;
      padding: 2px;
      width: 18px;
      height: 18px;
      line-height: 14px;
    }
    .tokai .campaign_date_tokai .until {
      font-size: 10px;
    }
  }
  @media screen and (max-width: 767px) {
    .tokai .p-mainview__btn__box {
      bottom: 18%;
      width: 96%;
    }
    .tokai .p-mainview__btn__box img {
      padding-right: 18px;
      padding-left: 18px;
    }
  }

  @media screen and (max-width: 480px) {
    .tokai .p-mainview__btn__box {
      bottom: 16%;
    }
  }
  @media screen and (max-width: 375px) {
   .tokai .p-mainview__btn__box {
      bottom: 18%;
    }
  }
  .tokai .btn_1minute {
    bottom: 14.5%;
  }
  @media screen and (max-width: 480px) {
    .tokai .btn_1minute {
      bottom: 18%;
    }
  }
  .tokai .btn_1minute_02 {
    max-width: 640px;
    width: 100%;
    margin: 40px auto 0;
  }
  /* FV CTAボタン */
  .tokai .p-mainview {
    position: relative;
  }
  .tokai .p-mainview__btn__box {
    position: absolute;
    bottom: 16%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    max-width: 640px;
    width: 100%;
  }
  @keyframes bounce {
    0% {
      transform: scale(1);
      -webkit-transform: scale(1);
    }
    50% {
      transform: scale(1.1);
      -webkit-transform: scale(1.1);
    }
  }
  @keyframes shiny {
    0% {
      -webkit-transform: scale(0) rotate(45deg);
      opacity: 0;
    }
    80% {
      -webkit-transform: scale(0) rotate(45deg);
      opacity: 0.5;
    }
    81% {
      -webkit-transform: scale(4) rotate(45deg);
      opacity: 1;
    }
    100% {
      -webkit-transform: scale(50) rotate(45deg);
      opacity: 0;
    }
  }
  .shiny-btn {
    overflow: hidden;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    animation: bounce 2s ease-in-out forwards;
    animation-iteration-count: infinite;
  }
  .shiny-btn::after {
    content: "";
    position: absolute;
    top: -10%;
    left: -20%;
    width: 40px;
    height: 100%;
    transform: scale(2) rotate(20deg);
    background-image: linear-gradient(100deg, rgba(255, 255, 255, 0) 10%, rgba(255, 255, 255, 0.5) 100%, rgba(255, 255, 255, 0) 0%);
    background: #fff !important;
    animation-name: shiny;
    animation-duration: 2s;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
    transition: unset;
    transform-origin: unset;
  }
  .p-target_fukidashi_sp {
    width: 140px;
    position: absolute;
    top: 5%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    z-index: 999;
  }
</style>

<?php //otokukon.site 東海婚 ?>
<?php get_template_part('template/target_tokai'); ?>
<main class="tokai">
    <div class="p-mainview l-mainview">
        <div class="p-mainview_box">
          <picture class="p-mainview__img">
            <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/mainview_tokai_pc.png" media="(min-width: 768px)" />
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mainview_tokai_sp.png" alt="抽選で5組様に！">
          </picture>
          <div class="campaign_date_tokai">
            <p>
              キャンペーン期間
              <?php
              // 日本時間で現在日時
              $tz  = new DateTimeZone('Asia/Tokyo');
              $now = new DateTime('now', $tz);

              // 今月の15日 23:59:59
              $mid = new DateTime('first day of this month', $tz);
              $mid->setDate((int)$now->format('Y'), (int)$now->format('n'), 15)->setTime(23,59,59);

              // 今月の月末 23:59:59
              $end = new DateTime('last day of this month', $tz);
              $end->setTime(23,59,59);

              // 表示する締切（前半＝15日／後半＝月末）
              $deadline = ($now <= $mid) ? $mid : $end;

              // 月日と曜日
              $month = $deadline->format('n');
              $day   = $deadline->format('j');
              $week  = ['日','月','火','水','木','金','土'];
              $w     = $week[(int)$deadline->format('w')];
              ?>
              <span class="date">
                <?php echo $month; ?><span class="date_slash">/</span><?php echo $day; ?>
              </span>
              <span class="day_circle"><?php echo $w; ?></span>
              <span class="until">まで</span>
            </p>
          </div>
        </div>
        <div class="p-mainview__btn__box btn_1minute">
          <div class="shiny-btn">
            <a href="#contact">
              <picture class="p-mainview__btn btn_campaign">
                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/btn_campaign_tokai_pc.png" media="(min-width: 768px)" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn_campaign_tokai_sp.png" alt="たった1分で完了！キャンペーンに応募する">
              </picture>
            </a>
          </div>
        </div>
        <div class="p-mainview__copy"><span class="p-mainview__color">挙式をする夢</span><span class="p-mainview__small">を</span><span class="p-mainview__color">叶えたい</span>、<br>すべてのカップルに贈る</div>
        <div class="p-mainview__text">※30名以上の披露宴またはパーティーをされる方に限ります。<br class="u-mobile"><span>※披露宴、または、パーティー費用は含まれておりません。</span></div>
    </div>
    <section class="p-special l-special">
        <div class="p-special__inner l-inner">
            <h2 class="p-special__title c-section-title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-favor-title.png" alt="Specialfavor">
            </h2>
            <p class="p-special__copy">結婚式無料キャンペーンに含まれる</p>
            <p class="p-special__benefit">10大特典</p>
            <div class="p-special__ribon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon.png" alt="<?php bloginfo('title'); ?>">
            </div>
            <div class="p-special__text">最大70万円相当<span>が</span>無料<span>になります。</span></div>

            <div class="p-special__items">
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="1.チャペルでの挙式料">
                    </div>
                    <h3 class="p-special-card__title">1.チャペルでの挙式料</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img01.jpg" alt="<?php bloginfo('title'); ?>">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">2.ウェディングドレス</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img02.jpg" alt="2.ウェディングドレス">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">3.タキシード</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img03.jpg" alt="3.タキシード">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">4.新婦様美容着付け</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img04.jpg" alt="4.新婦様美容着付け">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">５.新郎様着付け</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img05.jpg" alt="５.新郎様着付け">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">6.新婦様介添え料</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img06.jpg" alt="6.新婦様介添え料">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">7.ブーケ</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img07.jpg" alt="7.ブーケ">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">8.記念写真</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img08.jpg" alt="8.記念写真">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">9.アテンダー</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img09.jpg" alt="9.アテンダー">
                    </div>
                </div>
                <div class="p-special__item p-special-card">
                    <div class="p-special-card__ribon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-ribon2.png" alt="<?php bloginfo('title'); ?>">
                    </div>
                    <h3 class="p-special-card__title">10.誓約書</h3>
                    <div class="p-special-card__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/special-card-img10.jpg" alt="10.誓約書">
                    </div>
                </div>
            </div>
            <p class="p-special__foot">
                ※30名以上の披露宴またはパーティーをされる方に限ります。<br class="u-mobile">
                ※披露宴、または、パーティー費用は含まれておりません。
            </p>
        </div>
    </section>
    <section class="p-wedding l-wedding">
        <div class="p-wedding__inner l-inner">
            <h2 class="p-wedding__title">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wedding-hall-title.png" alt="Wedding Hall">
            </h2>
            <p class="p-wedding__copy">ご希望の式場をお選びいただけます</p>
            <div class="p-wedding__items">
              <div class="p-wedding__item p-wedding-card">
                  <div class="js_modalBtnCont" data-modal-btn="modal01">
                      <a class="p-wedding-card__ribon">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wedding-img01.jpg" alt="ガーデンテラス東山">
                      </a>
                      <div class="p-wedding-card__body">
                          <h3 class="p-wedding-card__title">ガーデンテラス東山</h3>
                          <div class="p-wedding-card__btn">詳しくはこちら</div>
                      </div>
                  </div>
                  <!-- モーダル（ポップアップ）の内容 -->
                  <div class="p-wedding-card__popUp js_modalWrap" data-modal-cont="modal01">
                      <div class="p-wedding-card__bg js_modalBG"></div>
                      <div class="p-wedding-card__cotainer">
                          <span class="p-wedding-card__closebtn js_modalContInner"></span>
                          <div class="p-wedding-card__content">
                              <div class="swiper">
                                  <div class="swiper-wrapper">
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/higashiyama01.jpg" alt="ガーデンテラス東山">
                                      </div>
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/higashiyama02.jpg" alt="ガーデンテラス東山">
                                      </div>
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/higashiyama03.jpg" alt="ガーデンテラス東山">
                                      </div>
                                  </div>
                                  <div class="swiper-pagination"></div>
                                  <div class="swiper-button-next swiper-slide"><span></span></div>
                                  <div class="swiper-button-prev swiper-slide"><span></span></div>
                              </div>
                              <div class="p-wedding-card__block">
                                  <div class="p-wedding-card__modalbody">
                                      <h3 class="p-wedding-card__modaltitle">ガーデンテラス東山</h3>
                                      <p class="p-wedding-card__modaltext">
                                          緑を見渡しながら挙式を執り行うことができる真っ白なチャペル。披露宴会場は、壁三面を使ったプロジェクションマッピングなど、多彩な演出が可能です。
                                      </p>
                                  </div>
                                  <div class="p-wedding-card__other">
                                      <a  id="js-pare01" class="p-wedding-card__modalForm js-pagelink js-net01" href="#contact">この式場に応募する</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="p-wedding__item p-wedding-card">
                  <div class="js_modalBtnCont" data-modal-btn="modal02">
                      <a class="p-wedding-card__ribon">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wedding-img02.jpg" alt="アールベルアンジェ四日市">
                      </a>
                      <div class="p-wedding-card__body">
                          <h3 class="p-wedding-card__title">アールベルアンジェ四日市</h3>
                          <div class="p-wedding-card__btn">詳しくはこちら</div>
                      </div>
                  </div>
                  <!-- モーダル（ポップアップ）の内容 -->
                  <div class="p-wedding-card__popUp js_modalWrap" data-modal-cont="modal02">
                      <div class="p-wedding-card__bg js_modalBG"></div>
                      <div class="p-wedding-card__cotainer">
                          <span class="p-wedding-card__closebtn js_modalContInner"></span>
                          <div class="p-wedding-card__content">
                              <div class="swiper">
                                  <div class="swiper-wrapper">
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yokkaichi01.jpg" alt="アールベルアンジェ四日市">
                                      </div>
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yokkaichi02.jpg" alt="アールベルアンジェ四日市">
                                      </div>
                                      <div class="swiper-slide">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yokkaichi03.jpg" alt="アールベルアンジェ四日市">
                                      </div>
                                  </div>
                                  <div class="swiper-pagination"></div>
                                  <div class="swiper-button-next swiper-slide"><span></span></div>
                                  <div class="swiper-button-prev swiper-slide"><span></span></div>
                              </div>
                              <div class="p-wedding-card__block">
                                  <div class="p-wedding-card__modalbody">
                                      <h3 class="p-wedding-card__modaltitle">アールベルアンジェ四日市</h3>
                                      <p class="p-wedding-card__modaltext">
                                          2020年にリニューアルした大人気の貸切邸宅。自然光が降り注ぐ大聖堂に、25mものバージンロードが魅力的。フォトジェニックなプライベートガーデン付きの会場です。
                                      </p>
                                  </div>
                                  <div class="p-wedding-card__other">
                                      <a id="js-pare02" class="p-wedding-card__modalForm js-pagelink js-net02" href="#contact">この式場に応募する</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="p-wedding__item p-wedding-card">
                <div class="js_modalBtnCont" data-modal-btn="modal03">
                  <a class="p-wedding-card__ribon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mie01.jpg" alt="アールベルアンジェ三重<">
                  </a>
                  <div class="p-wedding-card__body">
                    <h3 class="p-wedding-card__title">アールベルアンジェ三重</h3>
                    <div class="p-wedding-card__btn">詳しくはこちら</div>
                  </div>
                </div>
                <!-- モーダル（ポップアップ）の内容 -->
                <div class="p-wedding-card__popUp js_modalWrap" data-modal-cont="modal03">
                  <div class="p-wedding-card__bg js_modalBG"></div>
                  <div class="p-wedding-card__cotainer">
                    <span class="p-wedding-card__closebtn js_modalContInner"></span>
                    <div class="p-wedding-card__content">
                      <div class="swiper">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mie01.jpg" alt="アールベルアンジェ三重">
                          </div>
                          <div class="swiper-slide">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mie02.jpg" alt="アールベルアンジェ三重">
                          </div>
                          <div class="swiper-slide">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mie03.jpg" alt="アールベルアンジェ三重">
                          </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next swiper-slide"><span></span></div>
                        <div class="swiper-button-prev swiper-slide"><span></span></div>
                      </div>
                      <div class="p-wedding-card__block">
                        <div class="p-wedding-card__modalbody">
                          <h3 class="p-wedding-card__modaltitle">アールベルアンジェ三重</h3>
                          <p class="p-wedding-card__modaltext">
                              たくさんの緑に囲まれた真っ白な大邸宅は、<br>
                              自由な発想でこだわりのウェディングを叶えたいおふたりのためのステージ。<br>
                              世界に一つだけのウェディングが誕生します。
                          </p>
                        </div>
                        <div class="p-wedding-card__other">
                          <a id="js-pare03" class="p-wedding-card__modalForm js-pagelink js-net03" href="#contact">この式場に応募する</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>
    <section class="p-case l-case">
        <div class="p-case__inner l-inner">
            <h2 class="p-case__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-stady-title.png" alt="Case stady">
            </h2>
            <p class="p-case__copy">こんなカップルにおすすめ</p>
            <div class="p-case__items">
                <div class="p-case__item p-case-media">
                    <div class="p-case-media__bagge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-bagge01.png" alt="Case1">
                    </div>
                    <div class="p-case-media__text">
                        時期が読めず、<span>結婚式をあきらめよう</span>かと悩んでいる
                    </div>
                </div>
                <div class="p-case__item p-case-media">
                    <div class="p-case-media__bagge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-bagge02.png" alt="Case2">
                    </div>
                    <div class="p-case-media__text">
                        <span>育児が落ちついてきた</span>ので、結婚式を挙げたい
                    </div>
                </div>
                <div class="p-case__item p-case-media">
                    <div class="p-case-media__bagge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-bagge03.png" alt="Case3">
                    </div>
                    <div class="p-case-media__text">
                        <span>金銭的な理由</span>であきらめている
                    </div>
                </div>
                <div class="p-case__item p-case-media">
                    <div class="p-case-media__bagge">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-bagge04.png" alt="Case4">
                    </div>
                    <div class="p-case-media__text">
                        <span>再婚のため</span>、結婚式をしていなかった
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-flow l-flow">
        <div class="p-flow__inner l-inner">
            <h2 class="p-flow__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flow-title.png" alt="Flow">
            </h2>
            <p class="p-flow__copy">ご応募後の流れ</p>
            <div class="p-flow__items">
                <div class="p-flow__item p-flow-card">
                    <div class="p-flow-card__inner">
                        <div class="p-flow-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step1.jpg" alt="Step1">
                        </div>
                        <div class="p-flow-card__body">
                            <div class="p-flow-card__copy"><span class="p-flow-card__img--pc"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/step1.jpg" alt="Step1"></span>ご応募</div>
                            <p class="p-flow-card__text">スタッフよりお電話またはメールにてご連絡をさせていただきます。</p>
                        </div>
                    </div>
                </div>
                <div class="p-flow__item p-flow-card">
                    <div class="p-flow-card__inner">
                        <div class="p-flow-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step2.jpg" alt="Step2">
                        </div>
                        <div class="p-flow-card__body">
                            <div class="p-flow-card__copy"><span class="p-flow-card__img--pc"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/step2.jpg" alt="Step2"></span>抽選結果のご連絡</div>
                            <p class="p-flow-card__text">当選者の方へは今後のスケジュールをご案内させていただきます。</p>
                        </div>
                    </div>
                </div>
                <div class="p-flow__item p-flow-card">
                    <div class="p-flow-card__inner">
                        <div class="p-flow-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step3.jpg" alt="Step3">
                        </div>
                        <div class="p-flow-card__body">
                            <div class="p-flow-card__copy"><span class="p-flow-card__img--pc"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/step3.jpg" alt="Step3"></span>ご見学・お打ち合わせ</div>
                            <p class="p-flow-card__text">最幸の1日になるよう、何度かお打ち合わせをさせていただきます。</p>
                        </div>
                    </div>
                </div>
                <div class="p-flow__item p-flow-card">
                    <div class="p-flow-card__inner">
                        <div class="p-flow-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step4.jpg" alt="Step4">
                        </div>
                        <div class="p-flow-card__body">
                            <div class="p-flow-card__copy"><span class="p-flow-card__img--pc"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/step4.jpg" alt="Step4"></span>挙式当日</div>
                            <p class="p-flow-card__text">いよいよ結婚式当日！<br class="u-mobile">特別な思いでをたくさん作ってください！</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-qa l-qa">
        <div class="p-qa__inner l-inner">
            <h2 class="p-qa__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/qa-title.png" alt="Q&A">
            </h2>
            <div class="p-qa__copy">よくある質問</div>
            <div class="p-qa__items">
                <div class="p-qa__item p-qa-media">
                    <div class="p-qa-media__inner js-tab-trigger" data-id="tab01">
                        <div class="p-qa-media__head">
                            <div class="p-qa-media__q">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-q.jpg" alt="Q">
                            </div>
                            <div class="p-qa-media__copy">
                                追加で費用はかかりますか?
                            </div>
                            <span class="p-qa-media__btn"></span>
                        </div>
                        <div class="p-qa-media__foot js-tab-target" id="tab01">
                            <div class="p-qa-media__block">
                                <div class="p-qa-media__a">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-a.jpg" alt="A">
                                </div>
                                <div class="p-qa-media__content">
                                    <div class="p-qa-media__answer">費用がかかる場合もございます。</div>
                                </div>
                            </div>
                            <p class="p-qa-media__dtail">
                                本キャンペーンのご当選者様において、衣裳1点ずつ・挙式・お食事会中心で40名様のご披露宴の場合、概算見積りは130万円前後でご提案しております。<br class="u-desktop">
                                ご祝儀平均がおひとり様3.25万円と考えると新郎新婦様の手出しは僅かに発生するか、もしくは、まったく発生いたしません。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-qa__item p-qa-media">
                    <div class="p-qa-media__inner  js-tab-trigger" data-id="tab02">
                        <div class="p-qa-media__head">
                            <div class="p-qa-media__q">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-q.jpg" alt="Q">
                            </div>
                            <div class="p-qa-media__copy">
                                会場見学後に当選の権利を辞退することは可能ですか？
                            </div>
                            <span class="p-qa-media__btn js-btn"></span>
                        </div>
                        <div class="p-qa-media__foot js-tab-target" id="tab02">
                            <div class="p-qa-media__block">
                                <div class="p-qa-media__a">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-a.jpg" alt="A">
                                </div>
                                <div class="p-qa-media__answer">辞退は可能です。</div>
                            </div>
                            <p class="p-qa-media__dtail">
                                会場をお下見いただいた後、お見積りを含むご提案を充分にご検討していただいてからのご返答をお願いしております。まずはお気軽にご来館ください。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-qa__item p-qa-media">
                    <div class="p-qa-media__inner js-tab-trigger" data-id="tab03">
                        <div class="p-qa-media__head">
                            <div class="p-qa-media__q">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-q.jpg" alt="Q">
                            </div>
                            <div class="p-qa-media__copy">
                                妊娠中でも、結婚式を挙げることは出来るのでしょうか？
                            </div>
                            <span class="p-qa-media__btn js-btn"></span>
                        </div>
                        <div class="p-qa-media__foot js-tab-target" id="tab03">
                            <div class="p-qa-media__block">
                                <div class="p-qa-media__a">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-a.jpg" alt="A">
                                </div>
                                <div class="p-qa-media__answer">はい、可能です。</div>
                            </div>
                            <p class="p-qa-media__dtail">
                                当式場はマタニティウェディングを知り尽くしたスタッフが親身になって担当いたします。
                                ドレスは様々な種類を取りそろえており、ご希望にあわせてご提案いたします。サイズの変化にも柔軟に対応いたします。
                                また、テーブルレイアウトも妊婦様に合わせて高砂を中心にゆとりを第一に考え配置をいたします。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-qa__item p-qa-media">
                    <div class="p-qa-media__inner js-tab-trigger" data-id="tab04">
                        <div class="p-qa-media__head">
                            <div class="p-qa-media__q">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-q.jpg" alt="Q">
                            </div>
                            <div class="p-qa-media__copy">
                                結婚式までに何回くらい打ち合わせが必要ですか？
                            </div>
                            <span class="p-qa-media__btn js-btn"></span>
                        </div>
                        <div class="p-qa-media__foot js-tab-target" id="tab04">
                            <div class="p-qa-media__block">
                                <div class="p-qa-media__a">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/q-media-a.jpg" alt="A">
                                </div>
                                <div class="p-qa-media__answer">3～5回程度となります。</div>
                            </div>
                            <p class="p-qa-media__dtail">
                                お客様のご事情に応じて、お打ち合わせ回数をご提案いたします。
                                小さいお子様がいらっしゃる方や、仕事でお忙しい方は、お気軽にご相談ください。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-contents l-contents">
        <div class="p-contents__inner">
            <div class="p-contents__items">
                <div class="p-contents__item p-contents-card">
                    <picture class="p-contents-card__img">
                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/contents-img01-pc.jpg" media="(min-width: 768px)" />
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contents-img01.png" alt="WEDDING DRESS">
                    </picture>
                    <div class="p-contents-card__body">
                        <h2 class="p-contents-card__title p-contents-card__title--first"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/contents-title01.png" alt="Otokukon Oroduce"></h2>
                        <p class="p-contents-card__text">
                            デザイン・素材・シルエット…<br>
                            すべてにこだわった<br class="u-mobile">
                            ウェディングドレスたち。<br>
                            必ずお気に入りの一着が見つかるはず。
                        </p>
                    </div>
                </div>
                <div class="p-contents__item p-contents-card">
                    <picture class="p-contents-card__img">
                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/contents-img02-pc.jpg" media="(min-width: 768px)" />
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contents-img02.png" alt="CEREMONY">
                    </picture>
                    <div class="p-contents-card__body p-contents-card__body--reverse">
                        <h2 class="p-contents-card__title p-contents-card__title--second"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/contents-title02.png" alt="Benguet Corde"></h2>
                        <p class="p-contents-card__text">
                            多彩な会場演出で、<br class="u-mobile">
                            おふたりだけの<br class="u-desk-top">世界を再現する<br class="u-mobile">
                            空間づくり。<br>
                            ウェディングフェアへの<br class="u-mobile">
                            ご参加もおすすめ。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-voice l-voice">
        <div class="p-voice__inner l-inner">
            <h2 class="p-voice__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/voice-title.png" alt="Voice">
            </h2>
            <div class="p-voice__copy">挙式されたお客様からの喜びの声</div>
            <div class="p-voice__items">
                <div class="p-voice__item p-voice-card">
                    <div class="p-voice-card__body">
                        <h3 class="p-voice-card__title">妊娠しても結婚式を挙げられた！<span>新婦O様</span></h3>
                        <div class="p-voice-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/voice-img01.jpg" alt="妊娠しても結婚式を挙げられた！新婦O様">
                        </div>
                        <p class="p-voice-card__text">
                            妊娠したとこで 「挙式は無理かな？」とも思いましたが、偶然こちらのキャンペーンを見つけました。<br>
                            <span>「当たったらラッキー」程度の気持ちで応募</span>したら、なんと本当に当選してしまいました!<br class="u-desktop">
                            <span>打ち合わせはシンプル</span>で余計な時間もかからず、費用もご祝儀内で抑えられて本当によかったです。<br>
                            式当日までの間、<span>担当プランナーさんに体調をいつも気遣っていただいた</span>ので、安心して準備をすすめることが出来ました。
                            本当に感謝しています。
                        </p>
                    </div>
                </div>
                <div class="p-voice__item p-voice-card">
                    <div class="p-voice-card__body">
                        <h3 class="p-voice-card__title">姉の夢を叶えるプレゼント！<span>新婦K様 ご姉妹</span></h3>
                        <div class="p-voice-card__img">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/voice-img02.jpg" alt="姉の夢を叶えるプレゼント！新婦K様 ご姉妹">
                        </div>
                        <p class="p-voice-card__text">
                            <span> 「ドレスを着てみたかった。」</span>と愚痴をこぼすことも多 かった姉に、何かしてあげられないか、ずっと考えていました。<br>
                            そんな時偶然見つけたこのキャンペーン。<br>
                            <span>「結婚式を姉にプレゼントできたら…」</span>という思いで応募したら本当に当選！<br>
                            姉の誕生日にサプライズ報告したところ、本当に喜んでくれました。<br>
                            担当プランナーさんにとても優しく対応していただいたそうで、<span>式の打ち合わせを毎回とても楽しみにしていた</span>のが印象的でした。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-application l-application">
        <div class="p-application__inner l-inner">
            <h2 class="p-application__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/application-details-title.png" alt="Application Details">
            </h2>
            <div class="p-application__copy">応募資格</div>
            <div class="p-application__items">
                <div class="p-application__item p-application-card">
                    <div class="p-application-card__body">
                        <h3 class="p-application-card__title">プレゼント内容</h3>
                        <p class="p-application-card__toptext">
                            抽選で各式場にて20組様に結婚式をプレゼント！
                        </p>
                    </div>
                </div>
                <div class="p-application__item p-application-card">
                    <div class="p-application-card__body">
                        <h3 class="p-application-card__title">応募資格</h3>
                        <ol class="p-application-card__box">
                            <li class="p-application-card__text">1.30名様以上の披露宴･パーティーをされる方</li>
                            <li class="p-application-card__text">2.プレゼントさせて頂く「結婚式」に関してお打合せ時から当日のシーンの撮影等にご協力いただける方</li>
                            <li class="p-application-card__text">3.2にて撮影したお写真等をHPやFacebook等の販促物で使用させていただくことをご了承いただける方</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-contact l-contact" id="contact">
        <div class="p-contact__inner l-inner">
            <h2 class="p-contact__title">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/application-title.png" alt=" Application">
            </h2>
            <div class="p-contact__copy">応募フォーム</div>
            <div class="p-contact__block">
                <?php echo do_shortcode('[mwform_formkey key="243"]'); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer('tokai'); ?>
