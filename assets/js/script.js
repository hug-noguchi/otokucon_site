jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)
  $(document).on("click", 'a[href*="#"]', function () {
    let click_item = $(this).attr("id");
    let radio = $("input[type=radio]");
    radio.each((index, element) => {
      let contact_item = element.value;
      if (contact_item == click_item) {
        element.checked = true;
      }
    });
    console.log(radio);
    let time = 1000;
    let header = $("header").innerHeight();
    let target = $(this.hash);
    if (!target.length) return;
    let targetY = target.offset().top - header;
    $("html,body").delay(300).animate({ scrollTop: targetY }, time, "linear");
    return false;
  });

  // お知らせタブ
  $(".js-tab-trigger").on("click", function () {
    $(this).toggleClass("is-active");
    //data属性を取得する
    let id = $(this).data("id");
    $("#" + id).slideToggle(500);
  });

  $(function () {
    if ($(".error")[0]) {
      $(".mw_wp_form").addClass("mw_wp_form_error");
      var errorEl = $(".mw_wp_form").eq(0);
      var position = errorEl.parent().offset().top + 0;
      $("body,html").delay(200).animate({ scrollTop: position }, 600, "swing");
    }
  });

  var pagelink = $(".js-pagelink");
  pagelink.click(function () {
    $(".js_modalWrap").addClass("active2");
    setTimeout(function () {
      $(".js_modalWrap").removeClass("active");
      $(".js_modalWrap").removeClass("active2");
      $("body").removeClass("noscroll");
    }, 500);
  });

  //追加
  /*$(".js-contact").click(()=>{
  console.log('test');
  let time = 400;
  let header = $('header').innerHeight();
  let target = $(this.hash);
  if (!target.length) return;
    let targetY = target.offset().top - header;
    $('html,body').animate({ scrollTop: targetY }, time, 'swing');
    return false;
});*/
}); //jQuery

// モーダル（ポップアップ）
const modalBtn = document.querySelectorAll(".js_modalBtnCont");
const modalWindow = document.querySelectorAll(".js_modalWrap");
const modalClose = document.querySelectorAll(".js_modalContInner");
const modalBG = document.querySelectorAll(".js_modalBG");

window.addEventListener("DOMContentLoaded", function () {
  for (let i = 0; i < modalBtn.length; i++) {
    modalBtn[i].addEventListener("click", function (e) {
      e.preventDefault();
      let dataModalBtn = modalBtn[i].getAttribute("data-modal-btn");
      for (let j = 0; j < modalWindow.length; j++) {
        if (modalWindow[j].getAttribute("data-modal-cont") === dataModalBtn) {
          modalWindow[j].classList.add("active");
          document.body.classList.add("noscroll");
        }
      }
    });
    modalBG[i].addEventListener("click", function () {
      modalWindow[i].classList.add("active2");
      setTimeout(function () {
        modalWindow[i].classList.remove("active");
        modalWindow[i].classList.remove("active2");
        document.body.classList.remove("noscroll");
      }, 300);
    });
    modalClose[i].addEventListener("click", function () {
      modalWindow[i].classList.add("active2");
      setTimeout(function () {
        modalWindow[i].classList.remove("active");
        modalWindow[i].classList.remove("active2");
        document.body.classList.remove("noscroll");
      }, 300);
    });
  }
});

const mySwiper = new Swiper(".swiper", {
  // Optional parameters
  loop: true,
  slidesPerView: 1, // コンテナ内に表示させるスライド数（CSSでサイズ指定する場合は 'auto'）
  breakpoints: {
    768: {
      slidesPerView: 1,
    },
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    type: "bullets",
  },
});

// カウントダウンタイマー 〜月末
let countdown = setInterval(function () {
  const now = new Date(); //今の日時
  const target = new Date(now.getFullYear(), now.getMonth() + 1, 0, "23", "59", "59"); //ターゲット日時を取得
  const remainTime = target - now; //差分を取る（ミリ秒で返ってくる

  //指定の日時を過ぎていたら処理をしない
  if (remainTime < 0) return false;

  //差分の日・時・分・秒を取得
  const difDay = Math.floor(remainTime / 1000 / 60 / 60 / 24);
  const difHour = Math.floor(remainTime / 1000 / 60 / 60) % 24;
  const difMin = Math.floor(remainTime / 1000 / 60) % 60;
  const difSec = Math.floor(remainTime / 1000) % 60;

  //残りの日時を上書き
  document.getElementById("countdown-day").textContent = difDay;
  document.getElementById("countdown-hour").textContent = difHour;
  document.getElementById("countdown-min").textContent = difMin;
  document.getElementById("countdown-sec").textContent = difSec;

  //指定の日時になればカウントを止める
  if (remainTime < 0) clearInterval(countdown);
}, 1000); //1秒間に1度処理

//スマホ用　キャンペーンボタンの動き
jQuery(function ($) {
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 100) {
      $(".countdown-box").fadeIn(400);
    } else {
      $(".countdown-box").fadeOut(400);
    }
  });
});

jQuery(function ($) {
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 100) {
      $(".countdown-box").fadeIn(400);
    } else {
      $(".countdown-box").fadeOut(400);
    }
  });
});
