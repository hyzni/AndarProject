
$(window).scroll(function(){
  if ($(this).scrollTop() > 0) {
    $('#header .header').addClass('fixed')
  } else {
    $('#header .header').removeClass('fixed')
  }
})

$(window).trigger('scroll')



$('#header .header .btn-more').click(function(e){
  e.preventDefault();
  $('#header .header .group-bottom').toggleClass('active');
  $('#header .header .gnb-open').stop().slideToggle();
});

$(window).on('scroll', function () {
  if ($('#header').hasClass('fixed')) {
    $('#header .header .group-bottom').removeClass('active');
    $('#header .header .gnb-open').stop().slideUp();
  }
});


$('#header .util-area .menu').click(function(e){
  e.preventDefault();
  $('body').addClass('scroll-hidden');
  $('#header .side-nav').addClass('show');
  $('#header .dimmed').addClass('show');
});

$('#header .dimmed').click(function(e){
  e.preventDefault();
  $('body').removeClass('scroll-hidden');
  $('#header .dimmed').removeClass('show');
  $('#header .side-nav').removeClass('show');
});

$('#header .side-nav .btn-close').click(function(e){
  e.preventDefault();
  $('body').removeClass('scroll-hidden');
  $('#header .dimmed').removeClass('show');
  $('#header .side-nav').removeClass('show');
});





$('#header .util-area .menu').click(function (e) {
  e.preventDefault();
  $('body').addClass('scroll-hidden');
  $('#header .dimmed, #header .side-nav').addClass('show');
});

$('#header .dimmed, #header .side-nav .btn-close').click(function (e) {
  e.preventDefault();
  $('body').removeClass('scroll-hidden');
  $('#header .dimmed, #header .side-nav').removeClass('show');
});



$('#header .header .side-nav .menu-list .menu-item').click(function(e){
  e.preventDefault();

  let $this = $(this);
  let $subList = $this.find('.sub-list');
  let $title = $this.find('.title');

  // ✅ 다른 메뉴의 sub-list 닫기
  $('.menu-item').not($this).find('.sub-list').slideUp();
  $('.menu-item').not($this).find('.title').removeClass('active');

  // ✅ 클릭한 메뉴의 sub-list 토글
  $subList.slideToggle();
  $title.toggleClass('active');
});




headerSlide = new Swiper('#header .swiper',{
    loop:true,
})



visualSlide = new Swiper('#container .sc-visualSlide .swiper', {
  loop: true,  
  effect: "fade",
  pagination: {
    el: '.swiper-pagination', 
  },
  autoplay: {
    delay: 2000, 
    disableOnInteraction: false,  
  },
  speed: 600,  
});

eventSlide = new Swiper('#container .coupon-banner .swiper', {
    loop:true,
    autoplay: {
      delay: 3500,
    },
    pagination: {
        el: ".swiper-pagination",
        type: "fraction",
      },
})

recommendSlide = new Swiper('#container .sc-recommend .swiper', {
    loop:true,
    slidesPerView: 1.6,
    centeredSlides: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
})





document.querySelector('.btn-top').addEventListener('click', function() {
  window.scrollTo({
      top: 0,              
      behavior: 'smooth'   
  });
});


  let lastScrollTop = 0;
$(window).scroll(function(){
  curr = $(this).scrollTop();

  if (curr > 0) {
    if (curr > lastScrollTop) { 
      $('.fix-btn').removeClass('show');
    }else{
      $('.fix-btn').addClass('show');
    }
  }else{
    $('.fix-btn').removeClass('show');
  }
  
  lastScrollTop = curr;

})



$(document).ready(function () {
  $('.sc-best .menu-list .category').click(function () {
      $('.sc-best .menu-list .category').attr('aria-selected', false).removeClass('active');
      $(this).attr('aria-selected', true).addClass('active');
      $("[data-tab-content]").hide();
      let index = $(this).parent().index() + 1;
      // 해당하는 탭 콘텐츠만 보이게 설정
      $(`[data-tab-content="${index}"]`).show();
  });

  // 페이지 로드 시 첫 번째 탭을 기본 선택 상태로 설정
  $(".sc-best .menu-list .category").first().attr("aria-selected", true).addClass("active");
  $("[data-tab-content]").hide().first().show();
});





$('#header .side-nav .menu-item').each(function(){
  if ($(this).find('.sub-list').length === 0){
      $(this).addClass('no-arrow'); 
  }
});



