
/* 메인 탭 순위 */
jQuery('.xans-product-listmain-9 .thumbnail .num').each(function(index) {
	jQuery(this).append("<i>BEST</i>"+(index+1));
});
jQuery('.xans-product-listmain-10 .thumbnail .num').each(function(index) {
	jQuery(this).append("<i>BEST</i>"+(index+1));
});
jQuery('.xans-product-listmain-11 .thumbnail .num').each(function(index) {
	jQuery(this).append("<i>BEST</i>"+(index+1));
});
jQuery('.xans-product-listmain-12 .thumbnail .num').each(function(index) {
	jQuery(this).append("<i>BEST</i>"+(index+1));
});
jQuery('.xans-product-listmain-13 .thumbnail .num').each(function(index) {
	jQuery(this).append("<i>BEST</i>"+(index+1));
});


$(document).ready(function(){
	// 소비자가 판매가 확인
	$('.prd_basic .price').each(function(){
		var sale_prc = $(this).find('.sale_prc'); // 할인판매가
		var sell_prc = $(this).find('.sell_prc'); // 판매가
		var custom_prc = $(this).find('.custom_prc'); // 소비자가
		if(sale_prc.hasClass('displaynone') != true){ // 할인판매가가 있으면
			if(custom_prc.hasClass('displaynone') != true){ // 소비자가가 있으면
				sell_prc.hide(); // 판매가 숨김
			} else { // 소비자가가 없으면
				sell_prc.show().addClass('strike'); // 판매가 class 추가
			}
		} else { // 할인판매가가 없으면
			sell_prc.removeClass('strike'); // 판매가 class 해제
		}
	});
});
$('.prd_basic .price').each(function(){
	var sale_prc = $(this).find('.sale_prc'); // 할인판매가
	var sell_prc = $(this).find('.sell_prc'); // 판매가
	var custom_prc = $(this).find('.custom_prc'); // 소비자가
	if(sale_prc.hasClass('displaynone') != true){ // 할인판매가가 있으면
		if(custom_prc.hasClass('displaynone') != true){ // 소비자가가 있으면
			sell_prc.hide(); // 판매가 숨김
		} else { // 소비자가가 없으면
			sell_prc.show().addClass('strike'); // 판매가 class 추가
		}
	} else { // 할인판매가가 없으면
		sell_prc.removeClass('strike'); // 판매가 class 해제
	}
});
$('.paginate.typeMoreview').click(function(){
	var prd_list = $(this).prev(); // prd_list
	prd_list.find('.prd_basic .price').each(function(){
		var sale_prc = $(this).find('.sale_prc'); // 할인판매가
		var sell_prc = $(this).find('.sell_prc'); // 판매가
		var custom_prc = $(this).find('.custom_prc'); // 소비자가
		if(sale_prc.hasClass('displaynone') != true){ // 할인판매가가 있으면
			if(custom_prc.hasClass('displaynone') != true){ // 소비자가가 있으면
				sell_prc.hide(); // 판매가 숨김
			} else { // 소비자가가 없으면
				sell_prc.show().addClass('strike'); // 판매가 class 추가
			}
		} else { // 할인판매가가 없으면
			sell_prc.removeClass('strike'); // 판매가 class 해제
		}
	});
});

// 메인 페이지 스크립트 분리 (/layout/basic/js/common.js 에서 가져옴) - 1127


var LISTSWITCH = {
    aDocument :{},
    init : function()
    {
        LISTSWITCH.getDefaultDocument();
        LISTSWITCH.attatchEvent();

    },
    attatchEvent:function()
    {
        $('ul.list-switch li.list-element').click(function() {
            var oParent = $(this).parent();
            oParent.find('a').removeClass('active');
            var oTargetDiv = $('div#'+oParent.attr('target'));
            var bUseCache = $(this).attr('nocache') === undefined;
            LISTSWITCH.getDocument(oParent.attr('target'), $(this).attr('module-name'), bUseCache);
        });
    },
    getDocument :function(oTargetDiv, sModuleName, bUseCache)
    {
        $('[module-name="'+sModuleName+'"]').find('a').addClass('active');
        var sCacheKey = oTargetDiv+'_'+sModuleName;
        /* #218 [공통] 메인페이지 영역 추가 요청 240205 */
        //if (bUseCache === true && LISTSWITCH.aDocument.hasOwnProperty(sCacheKey) === true) {
        //    $('div#'+oTargetDiv).html('').html(LISTSWITCH.aDocument[sCacheKey]);
        //    return true;
        //}
        var oDocument = $.get('/product/iv/'+sModuleName+'.html',function(oResponse) {
            var x = $('<div>').html(oResponse);
            //var a = x.find('div.xans-element-.xans-product');
            var a = x.find('div.xans-element-.xans-product:not(.xans-product-colorchip)');
            $('div#'+oTargetDiv).html('').html(a);
            productInfoFunc();
            //addTextbox();
            //LISTSWITCH.aDocument[sCacheKey] = a;
        });
    },
    getDefaultDocument : function()
    {
        $('ul.list-switch').each(function() {
            if ($(this).attr('default') !== undefined) {
                LISTSWITCH.getDocument($(this).attr('target'), $(this).attr('default'));
            }
        });
    }
};

/************************** #166 모바일 메인 배너 높이 동일하게 - 1127 *******************************/



$(document).ready(function(){
    /* #266 - 메인 상단영역 추가 TVC 영역 (240516) */
    var tvcSection = $('.tvc_section');
    if(tvcSection.find('.slide-ivBanner').length > 0) {
        tvcSection.removeClass('displaynone');
        // 아이프레임
        var iframe = $('.tvc_section .iframe_wrap iframe');
        if(iframe.length > 0) {
            var aspectRatio = iframe.attr('aspect-ratio');
            var aWidth = aspectRatio.split('/')[0];
            var aHeight = aspectRatio.split('/')[1];
            aspectRatio = aWidth / aHeight;
            var bannerWidth = $('.tvc_section .iframe_wrap').outerWidth();
            var iframeHeight = iframe.outerHeight();
            var heightRatio = bannerWidth / iframeHeight / aspectRatio + 0.1;
            
            $('.tvc_section .iframe_wrap iframe').css({'transform':`scale(${heightRatio})`});
        }
    	
    }
    
    /* #218 [공통] 메인페이지 영역 추가 요청 240205 */
    var brandingSection = $('.branding_section');
    if(brandingSection.length > 0) {
        
        var brandingBanner = brandingSection.find('.slide-ivBanner');
        // 배너 있는 경우에만 영역 노출됨
        if(brandingBanner.length > 0) {
            // 텍스트 영역 배경색 코드 추출해서 적용
            $('.slide-ivBanner .banner_text_wrap').each(function(index, element){
                if(!!$(this).children('p').text()) {
                    var textBackground = $(this).find('.bg_color').text();
                    $(this).css('backgroundColor',textBackground);
                }
            });
            
			// 아이프레임 있는 경우
            if($('.branding_section .iframe_wrap iframe').length > 0) {
                
                $('.branding_section .banner_img_wrap').addClass('iframe');
                var iframe = $('.branding_section .iframe_wrap iframe');
                // 아이프레임 코드에 영상 비율 입력
                var aspectRatio = iframe.attr('aspect-ratio');
                
                if(!!aspectRatio) {
                    // 너비
                	wAspect = aspectRatio.split('/')[0];
                    // 높이
					hAspect =  aspectRatio.split('/')[1];
                    aspectRatio = wAspect / hAspect;
                    
                   	if( aspectRatio >= 1 ) {
                        // landscape
                        setTimeout(function(){
                            // 아이프레임 크기 조절
                            adjustIframeWidth(aspectRatio);
                        },0);
                    } else if(aspectRatio > 0) {
                    	// portrait
                    } 
                }
                
                // 아이프레임 크기 조절
                function adjustIframeWidth(aspectRatio) {
                    var bannerWidth = $('.branding_section .branding_top').outerWidth();
                	var vidAspect = $('.branding_section .iframe .iframe_wrap iframe');
                    var $vidAspect = vidAspect.outerHeight();
                    var wAspect = $vidAspect * aspectRatio;
                    // 영상 하단에 여백 보인다고 하여 0.1 더함
                    var a = bannerWidth / wAspect + 0.1;
                    
                    $('.branding_section .iframe .iframe_wrap').css({'transform':`scale(${a})`});
                    $('.branding_section .iframe .iframe_container').css('padding-top', 1 / aspectRatio * 100 + '%');
                }
            }
            
            // 이미지 여러장인 경우 스와이퍼
            if( $('.branding_section .swiper-slide').length > 1) {
                var brandingSwiper = new Swiper('.branding_section .swiper-container', {
                    slidesPerView : 1,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    loop: true,
                    loopedSlides: 1,
                    observer: true,
                    observeParents: true,
                });
            }
            
            brandingSection.removeClass('displaynone');
        }
        
    }
    
	LISTSWITCH.init();
    
    /************************** #179 메인 배너 내 아이프레임 비율 조정 - 1030 *******************************/
    
    IV$(window).resize(function(){
        iv_util.debounce(mainVidAdjust, 10);
    });  
    
    /* 영상배너 비율 조정 */
    function mainVidAdjust(){
        var vidTimeOut;
        var vidAspect = $('.iframe .banner_item_wrap');
        var vidArea = $('.banner_item_area.iframe');
        var $vidAspect = vidAspect.outerHeight();
        var _wAspect = $('.main_visual_section .swiper-slide').outerHeight();
        var a = _wAspect / $vidAspect;
        if (!!vidAspect) {
            if (_wAspect > $vidAspect) { // 윈도우 크기 보다 영상 크기가 작을때
                vidArea.css({'transform':`scale(${a})`}); // 영상크기값 비율상 넣어주기
            } else {
                vidArea.css({'transform':`scale(1)`});
            }
        }
    }  
    
    /* 메인 배너에서 iframe 대상 배너 찾기 */
    function findIframeInMainBanner() {
        if( $('.main_visual_section .swiper-slide').length >= 1 ) {
            $('.banner_item_area').each(function(id,el){
                var bannerType = $(this).data('type');
                
                if ( bannerType.indexOf('iframe') > -1 ) {
                    $(this).addClass('iframe');
                }
            });
        }
        mainVidAdjust();  
    }
    
    var ivIframeObserveTest = 0;
    
    if (IV$('.main_visual_section').length > 0) {
        

        IV$('.main_visual_section').iv_observerFunc(function() {

            if (ivIframeObserveTest !== $('.main_visual_section .swiper-slide').length) {
                ivIframeObserveTest = $('.main_visual_section .swiper-slide').length;
                findIframeInMainBanner();
            } 

        }, {
            attributes: false,
            childList: true,
            subtree: true
        });
        
       
        // 텍스트 박스 로딩속도 개선 => 텍스트 박스 각각 opacity 바뀌도록 수정 1127
        $('.main_visual_section.swiper-container .swiper-slide').each(function(){
            $(this).find('a > p').wrapAll('<div class="text_box"></div>');
            $(this).find('.text_box').css('opacity','1');
        });
        
        
    }

    /************************** //#179 메인 배너 내 아이프레임 비율 조정 - 1030 *******************************/

    
    /* #155 - 메인/상세 배너 페이지네이션 기능 문의 - 0926 */
    var mainFlowBn = $('.main_FlowBn_wrap .swiper-slide').length;
    if(mainFlowBn > 1) {
    	var mainFlowSwiper = new Swiper('.main_FlowBn_wrap', {
        	autoplay: {
               delay: 4000,
               stopOnLastSlide: false,
               disableOnInteraction: false,
            },
            loop:true,
            slidesPerView: "auto",
            observer:true, 
            observeParents:true,
            pagination: {
                el: '.swiper-pagination',
                type: 'fraction',
            },
        });
    }
});

// 메인 배너 높이 비율 브라우저별 모두 통일 (iv_main.js 파일에 넣으면 높이 바뀌는게 보여서 유지)
function setScreenSize() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh3', `${vh}px`);
}
setScreenSize();

// 썸네일 이미지 엑박일경우 기본값 설정
$(window).load(function() {
    $(".thumbnail img, img.thumbImage, img.bigImage").each(function($i,$item){
        var $img = new Image();
        $img.onerror = function () {
            $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
        }
        $img.src = this.src;
    });


    //* window loae 때문에 이 파일로 위치 이동 *//
    //이너뷰 0720 이미지 텍스트 겹침 현상 
    if($('.main_visual_section').length > 0){
        var main_visual_leng = $('.main_visual_section .swiper-slide').length;

        if(main_visual_leng > 1){

            //메인 비주얼 배너
            var MainVisualSwiper = new Swiper('.main_visual_section.swiper-container', {
                spaceBetween: 30,
                effect: 'fade',
                lazyLoading: true,
                lazyLoadingInPrevNext: true,
                watchSlidesProgress: true,
                watchSlidesVisibility: true,
                loop:true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                speed:500,
                pagination: {
                    el: '.main_visual_section .swiper-pagination',
                },
            });


        }else{
            $('.main_visual_section .swiper-pagination').hide();
        }

        //이미지 지연 로딩
        //let images = document.querySelectorAll(".lazyload");
        //new LazyLoad(images);
        jQuery1_11_2("swiper-slide.lazyload").lazyload({
            effect : "fadeIn"       //효과
        });

        // 텍스트박스 로딩속도 느려 iv_main.js 로 옮겨서 수정함 1127
        //$('.main_visual_section .text_box').css('opacity','1');

    }

});

$(document).ready(function(){
    // 메인 페이지 스크립트 일부 분리 (iv_main.js)

    // 토글
    $('div.eToggle .title').click(function(){
        var toggle = $(this).parent('.eToggle');
        if(toggle.hasClass('disable') == false){
            $(this).parent('.eToggle').toggleClass('selected')
        }
    });

    $('dl.eToggle dt').click(function(){
        $(this).toggleClass('selected');
        $(this).next('dd').toggleClass('selected');
    });

    //장바구니 페이지 수량폼 Type 변경
    $('[id^="quantity"]').each(function() {
        $(this).get(0).type = 'tel';
    });

    // 모바일에서 공급사 테이블 th 강제조절
    $('.xans-mall-supplyinfo, .supplyInfo').find('table > colgroup').find('col').eq(0).width(98);
    $('.xans-mall-supplyinfo, .supplyInfo').find('th, td').css({padding:'13px 10px 12px'});

    /**
     *  메인카테고리 toggle
     */
    $('.xans-product-listmain h2').toggle(function(){
        $(this).css('background-image', 'url("//img.echosting.cafe24.com/skin/mobile_ko_KR/layout/bg_title_open.gif")');
        $(this).siblings().hide();
        $(this).parent().find('div.paginate').hide();
        $(this).parent().next('div.xans-product-listmore').hide();
    }, function() {
        $(this).css('background-image', 'url("//img.echosting.cafe24.com/skin/mobile_ko_KR/layout/bg_title_close.gif")');
        $(this).siblings().show();
        $(this).parent().find('div.paginate').show();
        $(this).parent().next('div.xans-product-listmore').show();
    });

    /**
     *  상단탑버튼
     */
    var globalTopBtnScrollFunc = function() {
        // 탑버튼 관련변수
        var $btnTop = $('#btnTop');

        $(window).scroll(function() {
            try {
                var iCurScrollPos = $(this).scrollTop();

                if (iCurScrollPos > ($(this).height() / 2)) {
                    $btnTop.fadeIn('fast');
                } else {
                    $btnTop.fadeOut('fast');
                }
            } catch(e) { }
        });
    };

    /**
     *  구매버튼
     */
    var globalBuyBtnScrollFunc = function() {
        // 구매버튼 관련변수
        var sFixId = $('#orderFixItem').size() > 0  ? 'orderFixItem' : 'fixedActionButton',
            $area = $('#orderFixArea'),
            $item = $('#' + sFixId + '').not($area);

        $(window).scroll(function(){
            try {
                 // 구매버튼 관련변수
                var iCurrentHeightPos = $(this).scrollTop() + $(this).height(),
                    iButtonHeightPos = $item.offset().top;

                if (iCurrentHeightPos > iButtonHeightPos || iButtonHeightPos < $(this).scrollTop() + $item.height()) {
                    if (iButtonHeightPos < $(this).scrollTop() - $item.height()) {
                        $area.fadeIn('fast');
                    } else {
                        $area.hide();
                    }
                } else {
                    $area.fadeIn('fast');
                }
            } catch(e) { }
        });
    };

    globalTopBtnScrollFunc();
    globalBuyBtnScrollFunc();
});

// 공통레이어팝업 오픈
var globalLayerOpenFunc = function(_this) {
    this.id = $(_this).data('id');
    this.param = $(_this).data('param');
    this.basketType = $('#basket_type').val();
    this.url = $(_this).data('url');
    this.layerId = 'ec_temp_mobile_layer';
    this.layerIframeId = 'ec_temp_mobile_iframe_layer';

    var _this = this;

    function paramSetUrl() {
        if (this.param) {
            // if isset param
        } else {
            this.url = this.basketType ?  this.url + '?basket_type=' + this.basketType : this.url;
        }
    };

    if (this.url) {
        window.ecScrollTop = $(window).scrollTop();
        $.ajax({
            url : this.url,
            success : function (data) {
                if (data.indexOf('404 페이지 없음') == -1) {
                    // 있다면 삭제
                    try { $(_this).remove(); } catch ( e ) { }

                    var $layer = $('<div>', {
                        html: $("<iframe>", { src: _this.url, id: _this.layerIframeId, scrolling: 'auto', css: { width: '100%', height: '100%', overflowY: 'auto', border: 0 } } ),
                        id: _this.layerId,
                        css : { position: 'absolute', top: 0, left:0, width: '100%', height: $(window).height(), 'z-index': 9999 }
                    });

                    $('body').append($layer);
                    $('html, body').css({'overflowY': 'hidden', height: '100%', width: '100%'});
                    $('#' + this.layerId).show();
                }
            }
        });
    }
};

// 공통레이어팝업 닫기
var globalLayerCloseFunc = function() {
    this.layerId = 'ec_temp_mobile_layer';

    if (window.parent === window)
        self.clse();
    else {
        parent.$('html, body').css({'overflowY': 'auto', height: 'auto', width: '100%'});
        parent.$('html, body').scrollTop(parent.window.ecScrollTop);
        parent.$('#' + this.layerId).remove();
    }
};

/**
 * document.location.href split
 * return array Param
 */
var getQueryString = function(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};

// PC버전 바로 가기
var isPCver = function() {
    var sUrl = window.location.hostname;
    var aTemp = sUrl.split(".");

    var pattern = /^(mobile[\-]{2}shop[0-9]+)$/;

    if (aTemp[0] == 'm' || aTemp[0] == 'skin-mobile' || aTemp[0] == 'mobile') {
        sUrl = sUrl.replace(aTemp[0]+'.', '');
    } else if (pattern.test(aTemp[0]) === true) {
        var aExplode = aTemp[0].split('--');
        aTemp[0] = aExplode[1];
        sUrl = aTemp.join('.');
    }
    window.location.href = '//'+sUrl+'/?is_pcver=T';
};

/* 도움말 */
$('body').delegate('.ec-base-tooltip-area .eTip', 'click', function(e){
    var findArea = $($(this).parents('.ec-base-tooltip-area'));
    var findTarget = $($(this).siblings('.ec-base-tooltip'));
    var findTooltip = $('.ec-base-tooltip');
    $('.ec-base-tooltip-area').removeClass('show');
    $(this).parents('.ec-base-tooltip-area:first').addClass('show');
    findTooltip.hide();
    findTarget.show();
    e.preventDefault();
});

$('body').delegate('.ec-base-tooltip-area .eClose', 'click', function(e){
    var findTarget = $(this).parents('.ec-base-tooltip:first');
    $('.ec-base-tooltip-area').removeClass('show');
    findTarget.hide();
    e.preventDefault();
});

$('.ec-base-tooltip-area').find('input').focusout(function() {
    var findTarget = $(this).parents('.ec-base-tooltip-area').find('.ec-base-tooltip');
    $('.ec-base-tooltip-area').removeClass('show');
    findTarget.hide();
});

// cre.ma / '더보기' 눌렀을 때 리뷰 수 갱신 / 스크립트를 수정할 경우 연락주세요 (support@cre.ma)
function UpdateCountAndScore() {
    if (typeof crema == "object" && typeof crema.run == "function") {
        var crema_count_run = setInterval(function(){
            crema.run();
            console.log("%c[CREMA]%c 리뷰 수 로딩 중....", "font-weight: bold; color: black;", "color: green")
        }, 500);
        setTimeout(function() {
	        clearInterval(crema_count_run);
            console.log("%c[CREMA]%c 리뷰 수 로딩 완료!", "font-weight: bold; color: black;", "color: green")
		}, 10000);
    }
}

$(".paginate.typeMoreview").click(function() { UpdateCountAndScore(); });

/**
 * Swiper 4.2.0
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * http://www.idangero.us/swiper/
 *
 * Copyright 2014-2018 Vladimir Kharlampidi
 *
 * Released under the MIT License
 *
 * Released on: March 16, 2018
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.Swiper=t()}(this,function(){"use strict";var e="undefined"==typeof document?{body:{},addEventListener:function(){},removeEventListener:function(){},activeElement:{blur:function(){},nodeName:""},querySelector:function(){return null},querySelectorAll:function(){return[]},getElementById:function(){return null},createEvent:function(){return{initEvent:function(){}}},createElement:function(){return{children:[],childNodes:[],style:{},setAttribute:function(){},getElementsByTagName:function(){return[]}}},location:{hash:""}}:document,t="undefined"==typeof window?{document:e,navigator:{userAgent:""},location:{},history:{},CustomEvent:function(){return this},addEventListener:function(){},removeEventListener:function(){},getComputedStyle:function(){return{getPropertyValue:function(){return""}}},Image:function(){},Date:function(){},screen:{},setTimeout:function(){},clearTimeout:function(){}}:window,i=function(e){for(var t=0;t<e.length;t+=1)this[t]=e[t];return this.length=e.length,this};function s(s,a){var r=[],n=0;if(s&&!a&&s instanceof i)return s;if(s)if("string"==typeof s){var o,l,d=s.trim();if(d.indexOf("<")>=0&&d.indexOf(">")>=0){var h="div";for(0===d.indexOf("<li")&&(h="ul"),0===d.indexOf("<tr")&&(h="tbody"),0!==d.indexOf("<td")&&0!==d.indexOf("<th")||(h="tr"),0===d.indexOf("<tbody")&&(h="table"),0===d.indexOf("<option")&&(h="select"),(l=e.createElement(h)).innerHTML=d,n=0;n<l.childNodes.length;n+=1)r.push(l.childNodes[n])}else for(o=a||"#"!==s[0]||s.match(/[ .<>:~]/)?(a||e).querySelectorAll(s.trim()):[e.getElementById(s.trim().split("#")[1])],n=0;n<o.length;n+=1)o[n]&&r.push(o[n])}else if(s.nodeType||s===t||s===e)r.push(s);else if(s.length>0&&s[0].nodeType)for(n=0;n<s.length;n+=1)r.push(s[n]);return new i(r)}function a(e){for(var t=[],i=0;i<e.length;i+=1)-1===t.indexOf(e[i])&&t.push(e[i]);return t}s.fn=i.prototype,s.Class=i,s.Dom7=i;var r={addClass:function(e){if(void 0===e)return this;for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.add(t[i]);return this},removeClass:function(e){for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.remove(t[i]);return this},hasClass:function(e){return!!this[0]&&this[0].classList.contains(e)},toggleClass:function(e){for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.toggle(t[i]);return this},attr:function(e,t){var i=arguments;if(1===arguments.length&&"string"==typeof e)return this[0]?this[0].getAttribute(e):void 0;for(var s=0;s<this.length;s+=1)if(2===i.length)this[s].setAttribute(e,t);else for(var a in e)this[s][a]=e[a],this[s].setAttribute(a,e[a]);return this},removeAttr:function(e){for(var t=0;t<this.length;t+=1)this[t].removeAttribute(e);return this},data:function(e,t){var i;if(void 0!==t){for(var s=0;s<this.length;s+=1)(i=this[s]).dom7ElementDataStorage||(i.dom7ElementDataStorage={}),i.dom7ElementDataStorage[e]=t;return this}if(i=this[0]){if(i.dom7ElementDataStorage&&e in i.dom7ElementDataStorage)return i.dom7ElementDataStorage[e];var a=i.getAttribute("data-"+e);return a||void 0}},transform:function(e){for(var t=0;t<this.length;t+=1){var i=this[t].style;i.webkitTransform=e,i.transform=e}return this},transition:function(e){"string"!=typeof e&&(e+="ms");for(var t=0;t<this.length;t+=1){var i=this[t].style;i.webkitTransitionDuration=e,i.transitionDuration=e}return this},on:function(){for(var e,t=[],i=arguments.length;i--;)t[i]=arguments[i];var a=t[0],r=t[1],n=t[2],o=t[3];function l(e){var t=e.target;if(t){var i=e.target.dom7EventData||[];if(i.unshift(e),s(t).is(r))n.apply(t,i);else for(var a=s(t).parents(),o=0;o<a.length;o+=1)s(a[o]).is(r)&&n.apply(a[o],i)}}function d(e){var t=e&&e.target?e.target.dom7EventData||[]:[];t.unshift(e),n.apply(this,t)}"function"==typeof t[1]&&(a=(e=t)[0],n=e[1],o=e[2],r=void 0),o||(o=!1);for(var h,p=a.split(" "),c=0;c<this.length;c+=1){var u=this[c];if(r)for(h=0;h<p.length;h+=1)u.dom7LiveListeners||(u.dom7LiveListeners=[]),u.dom7LiveListeners.push({type:a,listener:n,proxyListener:l}),u.addEventListener(p[h],l,o);else for(h=0;h<p.length;h+=1)u.dom7Listeners||(u.dom7Listeners=[]),u.dom7Listeners.push({type:a,listener:n,proxyListener:d}),u.addEventListener(p[h],d,o)}return this},off:function(){for(var e,t=[],i=arguments.length;i--;)t[i]=arguments[i];var s=t[0],a=t[1],r=t[2],n=t[3];"function"==typeof t[1]&&(s=(e=t)[0],r=e[1],n=e[2],a=void 0),n||(n=!1);for(var o=s.split(" "),l=0;l<o.length;l+=1)for(var d=0;d<this.length;d+=1){var h=this[d];if(a){if(h.dom7LiveListeners)for(var p=0;p<h.dom7LiveListeners.length;p+=1)r?h.dom7LiveListeners[p].listener===r&&h.removeEventListener(o[l],h.dom7LiveListeners[p].proxyListener,n):h.dom7LiveListeners[p].type===o[l]&&h.removeEventListener(o[l],h.dom7LiveListeners[p].proxyListener,n)}else if(h.dom7Listeners)for(var c=0;c<h.dom7Listeners.length;c+=1)r?h.dom7Listeners[c].listener===r&&h.removeEventListener(o[l],h.dom7Listeners[c].proxyListener,n):h.dom7Listeners[c].type===o[l]&&h.removeEventListener(o[l],h.dom7Listeners[c].proxyListener,n)}return this},trigger:function(){for(var i=[],s=arguments.length;s--;)i[s]=arguments[s];for(var a=i[0].split(" "),r=i[1],n=0;n<a.length;n+=1)for(var o=0;o<this.length;o+=1){var l=void 0;try{l=new t.CustomEvent(a[n],{detail:r,bubbles:!0,cancelable:!0})}catch(t){(l=e.createEvent("Event")).initEvent(a[n],!0,!0),l.detail=r}this[o].dom7EventData=i.filter(function(e,t){return t>0}),this[o].dispatchEvent(l),this[o].dom7EventData=[],delete this[o].dom7EventData}return this},transitionEnd:function(e){var t,i=["webkitTransitionEnd","transitionend"],s=this;function a(r){if(r.target===this)for(e.call(this,r),t=0;t<i.length;t+=1)s.off(i[t],a)}if(e)for(t=0;t<i.length;t+=1)s.on(i[t],a);return this},outerWidth:function(e){if(this.length>0){if(e){var t=this.styles();return this[0].offsetWidth+parseFloat(t.getPropertyValue("margin-right"))+parseFloat(t.getPropertyValue("margin-left"))}return this[0].offsetWidth}return null},outerHeight:function(e){if(this.length>0){if(e){var t=this.styles();return this[0].offsetHeight+parseFloat(t.getPropertyValue("margin-top"))+parseFloat(t.getPropertyValue("margin-bottom"))}return this[0].offsetHeight}return null},offset:function(){if(this.length>0){var i=this[0],s=i.getBoundingClientRect(),a=e.body,r=i.clientTop||a.clientTop||0,n=i.clientLeft||a.clientLeft||0,o=i===t?t.scrollY:i.scrollTop,l=i===t?t.scrollX:i.scrollLeft;return{top:s.top+o-r,left:s.left+l-n}}return null},css:function(e,i){var s;if(1===arguments.length){if("string"!=typeof e){for(s=0;s<this.length;s+=1)for(var a in e)this[s].style[a]=e[a];return this}if(this[0])return t.getComputedStyle(this[0],null).getPropertyValue(e)}if(2===arguments.length&&"string"==typeof e){for(s=0;s<this.length;s+=1)this[s].style[e]=i;return this}return this},each:function(e){if(!e)return this;for(var t=0;t<this.length;t+=1)if(!1===e.call(this[t],t,this[t]))return this;return this},html:function(e){if(void 0===e)return this[0]?this[0].innerHTML:void 0;for(var t=0;t<this.length;t+=1)this[t].innerHTML=e;return this},text:function(e){if(void 0===e)return this[0]?this[0].textContent.trim():null;for(var t=0;t<this.length;t+=1)this[t].textContent=e;return this},is:function(a){var r,n,o=this[0];if(!o||void 0===a)return!1;if("string"==typeof a){if(o.matches)return o.matches(a);if(o.webkitMatchesSelector)return o.webkitMatchesSelector(a);if(o.msMatchesSelector)return o.msMatchesSelector(a);for(r=s(a),n=0;n<r.length;n+=1)if(r[n]===o)return!0;return!1}if(a===e)return o===e;if(a===t)return o===t;if(a.nodeType||a instanceof i){for(r=a.nodeType?[a]:a,n=0;n<r.length;n+=1)if(r[n]===o)return!0;return!1}return!1},index:function(){var e,t=this[0];if(t){for(e=0;null!==(t=t.previousSibling);)1===t.nodeType&&(e+=1);return e}},eq:function(e){if(void 0===e)return this;var t,s=this.length;return new i(e>s-1?[]:e<0?(t=s+e)<0?[]:[this[t]]:[this[e]])},append:function(){for(var t,s=[],a=arguments.length;a--;)s[a]=arguments[a];for(var r=0;r<s.length;r+=1){t=s[r];for(var n=0;n<this.length;n+=1)if("string"==typeof t){var o=e.createElement("div");for(o.innerHTML=t;o.firstChild;)this[n].appendChild(o.firstChild)}else if(t instanceof i)for(var l=0;l<t.length;l+=1)this[n].appendChild(t[l]);else this[n].appendChild(t)}return this},prepend:function(t){var s,a;for(s=0;s<this.length;s+=1)if("string"==typeof t){var r=e.createElement("div");for(r.innerHTML=t,a=r.childNodes.length-1;a>=0;a-=1)this[s].insertBefore(r.childNodes[a],this[s].childNodes[0])}else if(t instanceof i)for(a=0;a<t.length;a+=1)this[s].insertBefore(t[a],this[s].childNodes[0]);else this[s].insertBefore(t,this[s].childNodes[0]);return this},next:function(e){return this.length>0?e?this[0].nextElementSibling&&s(this[0].nextElementSibling).is(e)?new i([this[0].nextElementSibling]):new i([]):this[0].nextElementSibling?new i([this[0].nextElementSibling]):new i([]):new i([])},nextAll:function(e){var t=[],a=this[0];if(!a)return new i([]);for(;a.nextElementSibling;){var r=a.nextElementSibling;e?s(r).is(e)&&t.push(r):t.push(r),a=r}return new i(t)},prev:function(e){if(this.length>0){var t=this[0];return e?t.previousElementSibling&&s(t.previousElementSibling).is(e)?new i([t.previousElementSibling]):new i([]):t.previousElementSibling?new i([t.previousElementSibling]):new i([])}return new i([])},prevAll:function(e){var t=[],a=this[0];if(!a)return new i([]);for(;a.previousElementSibling;){var r=a.previousElementSibling;e?s(r).is(e)&&t.push(r):t.push(r),a=r}return new i(t)},parent:function(e){for(var t=[],i=0;i<this.length;i+=1)null!==this[i].parentNode&&(e?s(this[i].parentNode).is(e)&&t.push(this[i].parentNode):t.push(this[i].parentNode));return s(a(t))},parents:function(e){for(var t=[],i=0;i<this.length;i+=1)for(var r=this[i].parentNode;r;)e?s(r).is(e)&&t.push(r):t.push(r),r=r.parentNode;return s(a(t))},closest:function(e){var t=this;return void 0===e?new i([]):(t.is(e)||(t=t.parents(e).eq(0)),t)},find:function(e){for(var t=[],s=0;s<this.length;s+=1)for(var a=this[s].querySelectorAll(e),r=0;r<a.length;r+=1)t.push(a[r]);return new i(t)},children:function(e){for(var t=[],r=0;r<this.length;r+=1)for(var n=this[r].childNodes,o=0;o<n.length;o+=1)e?1===n[o].nodeType&&s(n[o]).is(e)&&t.push(n[o]):1===n[o].nodeType&&t.push(n[o]);return new i(a(t))},remove:function(){for(var e=0;e<this.length;e+=1)this[e].parentNode&&this[e].parentNode.removeChild(this[e]);return this},add:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var i,a;for(i=0;i<e.length;i+=1){var r=s(e[i]);for(a=0;a<r.length;a+=1)this[this.length]=r[a],this.length+=1}return this},styles:function(){return this[0]?t.getComputedStyle(this[0],null):{}}};Object.keys(r).forEach(function(e){s.fn[e]=r[e]});var n,o,l,d={deleteProps:function(e){var t=e;Object.keys(t).forEach(function(e){try{t[e]=null}catch(e){}try{delete t[e]}catch(e){}})},nextTick:function(e,t){return void 0===t&&(t=0),setTimeout(e,t)},now:function(){return Date.now()},getTranslate:function(e,i){var s,a,r;void 0===i&&(i="x");var n=t.getComputedStyle(e,null);return t.WebKitCSSMatrix?((a=n.transform||n.webkitTransform).split(",").length>6&&(a=a.split(", ").map(function(e){return e.replace(",",".")}).join(", ")),r=new t.WebKitCSSMatrix("none"===a?"":a)):s=(r=n.MozTransform||n.OTransform||n.MsTransform||n.msTransform||n.transform||n.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,")).toString().split(","),"x"===i&&(a=t.WebKitCSSMatrix?r.m41:16===s.length?parseFloat(s[12]):parseFloat(s[4])),"y"===i&&(a=t.WebKitCSSMatrix?r.m42:16===s.length?parseFloat(s[13]):parseFloat(s[5])),a||0},parseUrlQuery:function(e){var i,s,a,r,n={},o=e||t.location.href;if("string"==typeof o&&o.length)for(r=(s=(o=o.indexOf("?")>-1?o.replace(/\S*\?/,""):"").split("&").filter(function(e){return""!==e})).length,i=0;i<r;i+=1)a=s[i].replace(/#\S+/g,"").split("="),n[decodeURIComponent(a[0])]=void 0===a[1]?void 0:decodeURIComponent(a[1])||"";return n},isObject:function(e){return"object"==typeof e&&null!==e&&e.constructor&&e.constructor===Object},extend:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];for(var i=Object(e[0]),s=1;s<e.length;s+=1){var a=e[s];if(void 0!==a&&null!==a)for(var r=Object.keys(Object(a)),n=0,o=r.length;n<o;n+=1){var l=r[n],h=Object.getOwnPropertyDescriptor(a,l);void 0!==h&&h.enumerable&&(d.isObject(i[l])&&d.isObject(a[l])?d.extend(i[l],a[l]):!d.isObject(i[l])&&d.isObject(a[l])?(i[l]={},d.extend(i[l],a[l])):i[l]=a[l])}}return i}},h=(l=e.createElement("div"),{touch:t.Modernizr&&!0===t.Modernizr.touch||!!("ontouchstart"in t||t.DocumentTouch&&e instanceof t.DocumentTouch),pointerEvents:!(!t.navigator.pointerEnabled&&!t.PointerEvent),prefixedPointerEvents:!!t.navigator.msPointerEnabled,transition:(o=l.style,"transition"in o||"webkitTransition"in o||"MozTransition"in o),transforms3d:t.Modernizr&&!0===t.Modernizr.csstransforms3d||(n=l.style,"webkitPerspective"in n||"MozPerspective"in n||"OPerspective"in n||"MsPerspective"in n||"perspective"in n),flexbox:function(){for(var e=l.style,t="alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "),i=0;i<t.length;i+=1)if(t[i]in e)return!0;return!1}(),observer:"MutationObserver"in t||"WebkitMutationObserver"in t,passiveListener:function(){var e=!1;try{var i=Object.defineProperty({},"passive",{get:function(){e=!0}});t.addEventListener("testPassiveListener",null,i)}catch(e){}return e}(),gestures:"ongesturestart"in t}),p=function(e){void 0===e&&(e={});var t=this;t.params=e,t.eventsListeners={},t.params&&t.params.on&&Object.keys(t.params.on).forEach(function(e){t.on(e,t.params.on[e])})},c={components:{configurable:!0}};p.prototype.on=function(e,t,i){var s=this;if("function"!=typeof t)return s;var a=i?"unshift":"push";return e.split(" ").forEach(function(e){s.eventsListeners[e]||(s.eventsListeners[e]=[]),s.eventsListeners[e][a](t)}),s},p.prototype.once=function(e,t,i){var s=this;if("function"!=typeof t)return s;return s.on(e,function i(){for(var a=[],r=arguments.length;r--;)a[r]=arguments[r];t.apply(s,a),s.off(e,i)},i)},p.prototype.off=function(e,t){var i=this;return e.split(" ").forEach(function(e){void 0===t?i.eventsListeners[e]=[]:i.eventsListeners[e].forEach(function(s,a){s===t&&i.eventsListeners[e].splice(a,1)})}),i},p.prototype.emit=function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var i,s,a,r=this;return r.eventsListeners?("string"==typeof e[0]||Array.isArray(e[0])?(i=e[0],s=e.slice(1,e.length),a=r):(i=e[0].events,s=e[0].data,a=e[0].context||r),(Array.isArray(i)?i:i.split(" ")).forEach(function(e){if(r.eventsListeners[e]){var t=[];r.eventsListeners[e].forEach(function(e){t.push(e)}),t.forEach(function(e){e.apply(a,s)})}}),r):r},p.prototype.useModulesParams=function(e){var t=this;t.modules&&Object.keys(t.modules).forEach(function(i){var s=t.modules[i];s.params&&d.extend(e,s.params)})},p.prototype.useModules=function(e){void 0===e&&(e={});var t=this;t.modules&&Object.keys(t.modules).forEach(function(i){var s=t.modules[i],a=e[i]||{};s.instance&&Object.keys(s.instance).forEach(function(e){var i=s.instance[e];t[e]="function"==typeof i?i.bind(t):i}),s.on&&t.on&&Object.keys(s.on).forEach(function(e){t.on(e,s.on[e])}),s.create&&s.create.bind(t)(a)})},c.components.set=function(e){this.use&&this.use(e)},p.installModule=function(e){for(var t=[],i=arguments.length-1;i-- >0;)t[i]=arguments[i+1];var s=this;s.prototype.modules||(s.prototype.modules={});var a=e.name||Object.keys(s.prototype.modules).length+"_"+d.now();return s.prototype.modules[a]=e,e.proto&&Object.keys(e.proto).forEach(function(t){s.prototype[t]=e.proto[t]}),e.static&&Object.keys(e.static).forEach(function(t){s[t]=e.static[t]}),e.install&&e.install.apply(s,t),s},p.use=function(e){for(var t=[],i=arguments.length-1;i-- >0;)t[i]=arguments[i+1];var s=this;return Array.isArray(e)?(e.forEach(function(e){return s.installModule(e)}),s):s.installModule.apply(s,[e].concat(t))},Object.defineProperties(p,c);var u={updateSize:function(){var e,t,i=this.$el;e=void 0!==this.params.width?this.params.width:i[0].clientWidth,t=void 0!==this.params.height?this.params.height:i[0].clientHeight,0===e&&this.isHorizontal()||0===t&&this.isVertical()||(e=e-parseInt(i.css("padding-left"),10)-parseInt(i.css("padding-right"),10),t=t-parseInt(i.css("padding-top"),10)-parseInt(i.css("padding-bottom"),10),d.extend(this,{width:e,height:t,size:this.isHorizontal()?e:t}))},updateSlides:function(){var e=this.params,i=this.$wrapperEl,s=this.size,a=this.rtlTranslate,r=this.wrongRTL,n=i.children("."+this.params.slideClass),o=this.virtual&&e.virtual.enabled?this.virtual.slides.length:n.length,l=[],p=[],c=[],u=e.slidesOffsetBefore;"function"==typeof u&&(u=e.slidesOffsetBefore.call(this));var v=e.slidesOffsetAfter;"function"==typeof v&&(v=e.slidesOffsetAfter.call(this));var f=o,m=this.snapGrid.length,g=this.snapGrid.length,b=e.spaceBetween,w=-u,y=0,x=0;if(void 0!==s){var E,T;"string"==typeof b&&b.indexOf("%")>=0&&(b=parseFloat(b.replace("%",""))/100*s),this.virtualSize=-b,a?n.css({marginLeft:"",marginTop:""}):n.css({marginRight:"",marginBottom:""}),e.slidesPerColumn>1&&(E=Math.floor(o/e.slidesPerColumn)===o/this.params.slidesPerColumn?o:Math.ceil(o/e.slidesPerColumn)*e.slidesPerColumn,"auto"!==e.slidesPerView&&"row"===e.slidesPerColumnFill&&(E=Math.max(E,e.slidesPerView*e.slidesPerColumn)));for(var S,C=e.slidesPerColumn,M=E/C,z=M-(e.slidesPerColumn*M-o),P=0;P<o;P+=1){T=0;var k=n.eq(P);if(e.slidesPerColumn>1){var $=void 0,L=void 0,I=void 0;"column"===e.slidesPerColumnFill?(I=P-(L=Math.floor(P/C))*C,(L>z||L===z&&I===C-1)&&(I+=1)>=C&&(I=0,L+=1),$=L+I*E/C,k.css({"-webkit-box-ordinal-group":$,"-moz-box-ordinal-group":$,"-ms-flex-order":$,"-webkit-order":$,order:$})):L=P-(I=Math.floor(P/M))*M,k.css("margin-"+(this.isHorizontal()?"top":"left"),0!==I&&e.spaceBetween&&e.spaceBetween+"px").attr("data-swiper-column",L).attr("data-swiper-row",I)}if("none"!==k.css("display")){if("auto"===e.slidesPerView){var D=t.getComputedStyle(k[0],null);T=this.isHorizontal()?k[0].getBoundingClientRect().width+parseFloat(D.getPropertyValue("margin-left"))+parseFloat(D.getPropertyValue("margin-right")):k[0].getBoundingClientRect().height+parseFloat(D.getPropertyValue("margin-top"))+parseFloat(D.getPropertyValue("margin-bottom")),e.roundLengths&&(T=Math.floor(T))}else T=(s-(e.slidesPerView-1)*b)/e.slidesPerView,e.roundLengths&&(T=Math.floor(T)),n[P]&&(this.isHorizontal()?n[P].style.width=T+"px":n[P].style.height=T+"px");n[P]&&(n[P].swiperSlideSize=T),c.push(T),e.centeredSlides?(w=w+T/2+y/2+b,0===y&&0!==P&&(w=w-s/2-b),0===P&&(w=w-s/2-b),Math.abs(w)<.001&&(w=0),x%e.slidesPerGroup==0&&l.push(w),p.push(w)):(x%e.slidesPerGroup==0&&l.push(w),p.push(w),w=w+T+b),this.virtualSize+=T+b,y=T,x+=1}}if(this.virtualSize=Math.max(this.virtualSize,s)+v,a&&r&&("slide"===e.effect||"coverflow"===e.effect)&&i.css({width:this.virtualSize+e.spaceBetween+"px"}),h.flexbox&&!e.setWrapperSize||(this.isHorizontal()?i.css({width:this.virtualSize+e.spaceBetween+"px"}):i.css({height:this.virtualSize+e.spaceBetween+"px"})),e.slidesPerColumn>1&&(this.virtualSize=(T+e.spaceBetween)*E,this.virtualSize=Math.ceil(this.virtualSize/e.slidesPerColumn)-e.spaceBetween,this.isHorizontal()?i.css({width:this.virtualSize+e.spaceBetween+"px"}):i.css({height:this.virtualSize+e.spaceBetween+"px"}),e.centeredSlides)){S=[];for(var O=0;O<l.length;O+=1)l[O]<this.virtualSize+l[0]&&S.push(l[O]);l=S}if(!e.centeredSlides){S=[];for(var A=0;A<l.length;A+=1)l[A]<=this.virtualSize-s&&S.push(l[A]);l=S,Math.floor(this.virtualSize-s)-Math.floor(l[l.length-1])>1&&l.push(this.virtualSize-s)}0===l.length&&(l=[0]),0!==e.spaceBetween&&(this.isHorizontal()?a?n.css({marginLeft:b+"px"}):n.css({marginRight:b+"px"}):n.css({marginBottom:b+"px"})),d.extend(this,{slides:n,snapGrid:l,slidesGrid:p,slidesSizesGrid:c}),o!==f&&this.emit("slidesLengthChange"),l.length!==m&&(this.params.watchOverflow&&this.checkOverflow(),this.emit("snapGridLengthChange")),p.length!==g&&this.emit("slidesGridLengthChange"),(e.watchSlidesProgress||e.watchSlidesVisibility)&&this.updateSlidesOffset()}},updateAutoHeight:function(e){var t,i=[],s=0;if("number"==typeof e?this.setTransition(e):!0===e&&this.setTransition(this.params.speed),"auto"!==this.params.slidesPerView&&this.params.slidesPerView>1)for(t=0;t<Math.ceil(this.params.slidesPerView);t+=1){var a=this.activeIndex+t;if(a>this.slides.length)break;i.push(this.slides.eq(a)[0])}else i.push(this.slides.eq(this.activeIndex)[0]);for(t=0;t<i.length;t+=1)if(void 0!==i[t]){var r=i[t].offsetHeight;s=r>s?r:s}s&&this.$wrapperEl.css("height",s+"px")},updateSlidesOffset:function(){for(var e=this.slides,t=0;t<e.length;t+=1)e[t].swiperSlideOffset=this.isHorizontal()?e[t].offsetLeft:e[t].offsetTop},updateSlidesProgress:function(e){void 0===e&&(e=this.translate||0);var t=this.params,i=this.slides,s=this.rtlTranslate;if(0!==i.length){void 0===i[0].swiperSlideOffset&&this.updateSlidesOffset();var a=-e;s&&(a=e),i.removeClass(t.slideVisibleClass);for(var r=0;r<i.length;r+=1){var n=i[r],o=(a+(t.centeredSlides?this.minTranslate():0)-n.swiperSlideOffset)/(n.swiperSlideSize+t.spaceBetween);if(t.watchSlidesVisibility){var l=-(a-n.swiperSlideOffset),d=l+this.slidesSizesGrid[r];(l>=0&&l<this.size||d>0&&d<=this.size||l<=0&&d>=this.size)&&i.eq(r).addClass(t.slideVisibleClass)}n.progress=s?-o:o}}},updateProgress:function(e){void 0===e&&(e=this.translate||0);var t=this.params,i=this.maxTranslate()-this.minTranslate(),s=this.progress,a=this.isBeginning,r=this.isEnd,n=a,o=r;0===i?(s=0,a=!0,r=!0):(a=(s=(e-this.minTranslate())/i)<=0,r=s>=1),d.extend(this,{progress:s,isBeginning:a,isEnd:r}),(t.watchSlidesProgress||t.watchSlidesVisibility)&&this.updateSlidesProgress(e),a&&!n&&this.emit("reachBeginning toEdge"),r&&!o&&this.emit("reachEnd toEdge"),(n&&!a||o&&!r)&&this.emit("fromEdge"),this.emit("progress",s)},updateSlidesClasses:function(){var e,t=this.slides,i=this.params,s=this.$wrapperEl,a=this.activeIndex,r=this.realIndex,n=this.virtual&&i.virtual.enabled;t.removeClass(i.slideActiveClass+" "+i.slideNextClass+" "+i.slidePrevClass+" "+i.slideDuplicateActiveClass+" "+i.slideDuplicateNextClass+" "+i.slideDuplicatePrevClass),(e=n?this.$wrapperEl.find("."+i.slideClass+'[data-swiper-slide-index="'+a+'"]'):t.eq(a)).addClass(i.slideActiveClass),i.loop&&(e.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+r+'"]').addClass(i.slideDuplicateActiveClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+r+'"]').addClass(i.slideDuplicateActiveClass));var o=e.nextAll("."+i.slideClass).eq(0).addClass(i.slideNextClass);i.loop&&0===o.length&&(o=t.eq(0)).addClass(i.slideNextClass);var l=e.prevAll("."+i.slideClass).eq(0).addClass(i.slidePrevClass);i.loop&&0===l.length&&(l=t.eq(-1)).addClass(i.slidePrevClass),i.loop&&(o.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+o.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+o.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass),l.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass))},updateActiveIndex:function(e){var t,i=this.rtlTranslate?this.translate:-this.translate,s=this.slidesGrid,a=this.snapGrid,r=this.params,n=this.activeIndex,o=this.realIndex,l=this.snapIndex,h=e;if(void 0===h){for(var p=0;p<s.length;p+=1)void 0!==s[p+1]?i>=s[p]&&i<s[p+1]-(s[p+1]-s[p])/2?h=p:i>=s[p]&&i<s[p+1]&&(h=p+1):i>=s[p]&&(h=p);r.normalizeSlideIndex&&(h<0||void 0===h)&&(h=0)}if((t=a.indexOf(i)>=0?a.indexOf(i):Math.floor(h/r.slidesPerGroup))>=a.length&&(t=a.length-1),h!==n){var c=parseInt(this.slides.eq(h).attr("data-swiper-slide-index")||h,10);d.extend(this,{snapIndex:t,realIndex:c,previousIndex:n,activeIndex:h}),this.emit("activeIndexChange"),this.emit("snapIndexChange"),o!==c&&this.emit("realIndexChange"),this.emit("slideChange")}else t!==l&&(this.snapIndex=t,this.emit("snapIndexChange"))},updateClickedSlide:function(e){var t=this.params,i=s(e.target).closest("."+t.slideClass)[0],a=!1;if(i)for(var r=0;r<this.slides.length;r+=1)this.slides[r]===i&&(a=!0);if(!i||!a)return this.clickedSlide=void 0,void(this.clickedIndex=void 0);this.clickedSlide=i,this.virtual&&this.params.virtual.enabled?this.clickedIndex=parseInt(s(i).attr("data-swiper-slide-index"),10):this.clickedIndex=s(i).index(),t.slideToClickedSlide&&void 0!==this.clickedIndex&&this.clickedIndex!==this.activeIndex&&this.slideToClickedSlide()}};var v={getTranslate:function(e){void 0===e&&(e=this.isHorizontal()?"x":"y");var t=this.params,i=this.rtlTranslate,s=this.translate,a=this.$wrapperEl;if(t.virtualTranslate)return i?-s:s;var r=d.getTranslate(a[0],e);return i&&(r=-r),r||0},setTranslate:function(e,t){var i=this.rtlTranslate,s=this.params,a=this.$wrapperEl,r=this.progress,n=0,o=0;this.isHorizontal()?n=i?-e:e:o=e,s.roundLengths&&(n=Math.floor(n),o=Math.floor(o)),s.virtualTranslate||(h.transforms3d?a.transform("translate3d("+n+"px, "+o+"px, 0px)"):a.transform("translate("+n+"px, "+o+"px)")),this.translate=this.isHorizontal()?n:o;var l=this.maxTranslate()-this.minTranslate();(0===l?0:(e-this.minTranslate())/l)!==r&&this.updateProgress(e),this.emit("setTranslate",this.translate,t)},minTranslate:function(){return-this.snapGrid[0]},maxTranslate:function(){return-this.snapGrid[this.snapGrid.length-1]}};var f={setTransition:function(e,t){this.$wrapperEl.transition(e),this.emit("setTransition",e,t)},transitionStart:function(e,t){void 0===e&&(e=!0);var i=this.activeIndex,s=this.params,a=this.previousIndex;s.autoHeight&&this.updateAutoHeight();var r=t;if(r||(r=i>a?"next":i<a?"prev":"reset"),this.emit("transitionStart"),e&&i!==a){if("reset"===r)return void this.emit("slideResetTransitionStart");this.emit("slideChangeTransitionStart"),"next"===r?this.emit("slideNextTransitionStart"):this.emit("slidePrevTransitionStart")}},transitionEnd:function(e,t){void 0===e&&(e=!0);var i=this.activeIndex,s=this.previousIndex;this.animating=!1,this.setTransition(0);var a=t;if(a||(a=i>s?"next":i<s?"prev":"reset"),this.emit("transitionEnd"),e&&i!==s){if("reset"===a)return void this.emit("slideResetTransitionEnd");this.emit("slideChangeTransitionEnd"),"next"===a?this.emit("slideNextTransitionEnd"):this.emit("slidePrevTransitionEnd")}}};var m={slideTo:function(e,t,i,s){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===i&&(i=!0);var a=this,r=e;r<0&&(r=0);var n=a.params,o=a.snapGrid,l=a.slidesGrid,d=a.previousIndex,p=a.activeIndex,c=a.rtlTranslate,u=a.$wrapperEl;if(a.animating&&n.preventIntercationOnTransition)return!1;var v=Math.floor(r/n.slidesPerGroup);v>=o.length&&(v=o.length-1),(p||n.initialSlide||0)===(d||0)&&i&&a.emit("beforeSlideChangeStart");var f,m=-o[v];if(a.updateProgress(m),n.normalizeSlideIndex)for(var g=0;g<l.length;g+=1)-Math.floor(100*m)>=Math.floor(100*l[g])&&(r=g);if(a.initialized&&r!==p){if(!a.allowSlideNext&&m<a.translate&&m<a.minTranslate())return!1;if(!a.allowSlidePrev&&m>a.translate&&m>a.maxTranslate()&&(p||0)!==r)return!1}return f=r>p?"next":r<p?"prev":"reset",c&&-m===a.translate||!c&&m===a.translate?(a.updateActiveIndex(r),n.autoHeight&&a.updateAutoHeight(),a.updateSlidesClasses(),"slide"!==n.effect&&a.setTranslate(m),"reset"!==f&&(a.transitionStart(i,f),a.transitionEnd(i,f)),!1):(0!==t&&h.transition?(a.setTransition(t),a.setTranslate(m),a.updateActiveIndex(r),a.updateSlidesClasses(),a.emit("beforeTransitionStart",t,s),a.transitionStart(i,f),a.animating||(a.animating=!0,u.transitionEnd(function(){a&&!a.destroyed&&a.transitionEnd(i,f)}))):(a.setTransition(0),a.setTranslate(m),a.updateActiveIndex(r),a.updateSlidesClasses(),a.emit("beforeTransitionStart",t,s),a.transitionStart(i,f),a.transitionEnd(i,f)),!0)},slideToLoop:function(e,t,i,s){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===i&&(i=!0);var a=e;return this.params.loop&&(a+=this.loopedSlides),this.slideTo(a,t,i,s)},slideNext:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.params,a=this.animating;return s.loop?!a&&(this.loopFix(),this._clientLeft=this.$wrapperEl[0].clientLeft,this.slideTo(this.activeIndex+s.slidesPerGroup,e,t,i)):this.slideTo(this.activeIndex+s.slidesPerGroup,e,t,i)},slidePrev:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.params,a=this.animating;return s.loop?!a&&(this.loopFix(),this._clientLeft=this.$wrapperEl[0].clientLeft,this.slideTo(this.activeIndex-1,e,t,i)):this.slideTo(this.activeIndex-1,e,t,i)},slideReset:function(e,t,i){return void 0===e&&(e=this.params.speed),void 0===t&&(t=!0),this.slideTo(this.activeIndex,e,t,i)},slideToClosest:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.activeIndex,a=Math.floor(s/this.params.slidesPerGroup);if(a<this.snapGrid.length-1){var r=this.rtlTranslate?this.translate:-this.translate,n=this.snapGrid[a];r-n>(this.snapGrid[a+1]-n)/2&&(s=this.params.slidesPerGroup)}return this.slideTo(s,e,t,i)},slideToClickedSlide:function(){var e,t=this,i=t.params,a=t.$wrapperEl,r="auto"===i.slidesPerView?t.slidesPerViewDynamic():i.slidesPerView,n=t.clickedIndex;if(i.loop){if(t.animating)return;e=parseInt(s(t.clickedSlide).attr("data-swiper-slide-index"),10),i.centeredSlides?n<t.loopedSlides-r/2||n>t.slides.length-t.loopedSlides+r/2?(t.loopFix(),n=a.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+i.slideDuplicateClass+")").eq(0).index(),d.nextTick(function(){t.slideTo(n)})):t.slideTo(n):n>t.slides.length-r?(t.loopFix(),n=a.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+i.slideDuplicateClass+")").eq(0).index(),d.nextTick(function(){t.slideTo(n)})):t.slideTo(n)}else t.slideTo(n)}};var g={loopCreate:function(){var t=this,i=t.params,a=t.$wrapperEl;a.children("."+i.slideClass+"."+i.slideDuplicateClass).remove();var r=a.children("."+i.slideClass);if(i.loopFillGroupWithBlank){var n=i.slidesPerGroup-r.length%i.slidesPerGroup;if(n!==i.slidesPerGroup){for(var o=0;o<n;o+=1){var l=s(e.createElement("div")).addClass(i.slideClass+" "+i.slideBlankClass);a.append(l)}r=a.children("."+i.slideClass)}}"auto"!==i.slidesPerView||i.loopedSlides||(i.loopedSlides=r.length),t.loopedSlides=parseInt(i.loopedSlides||i.slidesPerView,10),t.loopedSlides+=i.loopAdditionalSlides,t.loopedSlides>r.length&&(t.loopedSlides=r.length);var d=[],h=[];r.each(function(e,i){var a=s(i);e<t.loopedSlides&&h.push(i),e<r.length&&e>=r.length-t.loopedSlides&&d.push(i),a.attr("data-swiper-slide-index",e)});for(var p=0;p<h.length;p+=1)a.append(s(h[p].cloneNode(!0)).addClass(i.slideDuplicateClass));for(var c=d.length-1;c>=0;c-=1)a.prepend(s(d[c].cloneNode(!0)).addClass(i.slideDuplicateClass))},loopFix:function(){var e,t=this.params,i=this.activeIndex,s=this.slides,a=this.loopedSlides,r=this.allowSlidePrev,n=this.allowSlideNext,o=this.snapGrid,l=this.rtlTranslate;this.allowSlidePrev=!0,this.allowSlideNext=!0;var d=-o[i]-this.getTranslate();i<a?(e=s.length-3*a+i,e+=a,this.slideTo(e,0,!1,!0)&&0!==d&&this.setTranslate((l?-this.translate:this.translate)-d)):("auto"===t.slidesPerView&&i>=2*a||i>s.length-2*t.slidesPerView)&&(e=-s.length+i+a,e+=a,this.slideTo(e,0,!1,!0)&&0!==d&&this.setTranslate((l?-this.translate:this.translate)-d));this.allowSlidePrev=r,this.allowSlideNext=n},loopDestroy:function(){var e=this.$wrapperEl,t=this.params,i=this.slides;e.children("."+t.slideClass+"."+t.slideDuplicateClass).remove(),i.removeAttr("data-swiper-slide-index")}};var b={setGrabCursor:function(e){if(!h.touch&&this.params.simulateTouch){var t=this.el;t.style.cursor="move",t.style.cursor=e?"-webkit-grabbing":"-webkit-grab",t.style.cursor=e?"-moz-grabbin":"-moz-grab",t.style.cursor=e?"grabbing":"grab"}},unsetGrabCursor:function(){h.touch||(this.el.style.cursor="")}};var w={appendSlide:function(e){var t=this.$wrapperEl,i=this.params;if(i.loop&&this.loopDestroy(),"object"==typeof e&&"length"in e)for(var s=0;s<e.length;s+=1)e[s]&&t.append(e[s]);else t.append(e);i.loop&&this.loopCreate(),i.observer&&h.observer||this.update()},prependSlide:function(e){var t=this.params,i=this.$wrapperEl,s=this.activeIndex;t.loop&&this.loopDestroy();var a=s+1;if("object"==typeof e&&"length"in e){for(var r=0;r<e.length;r+=1)e[r]&&i.prepend(e[r]);a=s+e.length}else i.prepend(e);t.loop&&this.loopCreate(),t.observer&&h.observer||this.update(),this.slideTo(a,0,!1)},removeSlide:function(e){var t=this.params,i=this.$wrapperEl,s=this.activeIndex;t.loop&&(this.loopDestroy(),this.slides=i.children("."+t.slideClass));var a,r=s;if("object"==typeof e&&"length"in e){for(var n=0;n<e.length;n+=1)a=e[n],this.slides[a]&&this.slides.eq(a).remove(),a<r&&(r-=1);r=Math.max(r,0)}else a=e,this.slides[a]&&this.slides.eq(a).remove(),a<r&&(r-=1),r=Math.max(r,0);t.loop&&this.loopCreate(),t.observer&&h.observer||this.update(),t.loop?this.slideTo(r+this.loopedSlides,0,!1):this.slideTo(r,0,!1)},removeAllSlides:function(){for(var e=[],t=0;t<this.slides.length;t+=1)e.push(t);this.removeSlide(e)}},y=function(){var i=t.navigator.userAgent,s={ios:!1,android:!1,androidChrome:!1,desktop:!1,windows:!1,iphone:!1,ipod:!1,ipad:!1,cordova:t.cordova||t.phonegap,phonegap:t.cordova||t.phonegap},a=i.match(/(Windows Phone);?[\s\/]+([\d.]+)?/),r=i.match(/(Android);?[\s\/]+([\d.]+)?/),n=i.match(/(iPad).*OS\s([\d_]+)/),o=i.match(/(iPod)(.*OS\s([\d_]+))?/),l=!n&&i.match(/(iPhone\sOS|iOS)\s([\d_]+)/);if(a&&(s.os="windows",s.osVersion=a[2],s.windows=!0),r&&!a&&(s.os="android",s.osVersion=r[2],s.android=!0,s.androidChrome=i.toLowerCase().indexOf("chrome")>=0),(n||l||o)&&(s.os="ios",s.ios=!0),l&&!o&&(s.osVersion=l[2].replace(/_/g,"."),s.iphone=!0),n&&(s.osVersion=n[2].replace(/_/g,"."),s.ipad=!0),o&&(s.osVersion=o[3]?o[3].replace(/_/g,"."):null,s.iphone=!0),s.ios&&s.osVersion&&i.indexOf("Version/")>=0&&"10"===s.osVersion.split(".")[0]&&(s.osVersion=i.toLowerCase().split("version/")[1].split(" ")[0]),s.desktop=!(s.os||s.android||s.webView),s.webView=(l||n||o)&&i.match(/.*AppleWebKit(?!.*Safari)/i),s.os&&"ios"===s.os){var d=s.osVersion.split("."),h=e.querySelector('meta[name="viewport"]');s.minimalUi=!s.webView&&(o||l)&&(1*d[0]==7?1*d[1]>=1:1*d[0]>7)&&h&&h.getAttribute("content").indexOf("minimal-ui")>=0}return s.pixelRatio=t.devicePixelRatio||1,s}();function x(){var e=this.params,t=this.el;if(!t||0!==t.offsetWidth){e.breakpoints&&this.setBreakpoint();var i=this.allowSlideNext,s=this.allowSlidePrev;if(this.allowSlideNext=!0,this.allowSlidePrev=!0,this.updateSize(),this.updateSlides(),e.freeMode){var a=Math.min(Math.max(this.translate,this.maxTranslate()),this.minTranslate());this.setTranslate(a),this.updateActiveIndex(),this.updateSlidesClasses(),e.autoHeight&&this.updateAutoHeight()}else this.updateSlidesClasses(),("auto"===e.slidesPerView||e.slidesPerView>1)&&this.isEnd&&!this.params.centeredSlides?this.slideTo(this.slides.length-1,0,!1,!0):this.slideTo(this.activeIndex,0,!1,!0);this.allowSlidePrev=s,this.allowSlideNext=i}}var E={attachEvents:function(){var i=this.params,a=this.touchEvents,r=this.el,n=this.wrapperEl;this.onTouchStart=function(i){var a=this.touchEventsData,r=this.params,n=this.touches;if(!this.animating||!r.preventIntercationOnTransition){var o=i;if(o.originalEvent&&(o=o.originalEvent),a.isTouchEvent="touchstart"===o.type,(a.isTouchEvent||!("which"in o)||3!==o.which)&&(!a.isTouched||!a.isMoved))if(r.noSwiping&&s(o.target).closest(r.noSwipingSelector?r.noSwipingSelector:"."+r.noSwipingClass)[0])this.allowClick=!0;else if(!r.swipeHandler||s(o).closest(r.swipeHandler)[0]){n.currentX="touchstart"===o.type?o.targetTouches[0].pageX:o.pageX,n.currentY="touchstart"===o.type?o.targetTouches[0].pageY:o.pageY;var l=n.currentX,h=n.currentY;if(!(y.ios&&!y.cordova&&r.iOSEdgeSwipeDetection&&l<=r.iOSEdgeSwipeThreshold&&l>=t.screen.width-r.iOSEdgeSwipeThreshold)){if(d.extend(a,{isTouched:!0,isMoved:!1,allowTouchCallbacks:!0,isScrolling:void 0,startMoving:void 0}),n.startX=l,n.startY=h,a.touchStartTime=d.now(),this.allowClick=!0,this.updateSize(),this.swipeDirection=void 0,r.threshold>0&&(a.allowThresholdMove=!1),"touchstart"!==o.type){var p=!0;s(o.target).is(a.formElements)&&(p=!1),e.activeElement&&s(e.activeElement).is(a.formElements)&&e.activeElement!==o.target&&e.activeElement.blur(),p&&this.allowTouchMove&&o.preventDefault()}this.emit("touchStart",o)}}}}.bind(this),this.onTouchMove=function(t){var i=this.touchEventsData,a=this.params,r=this.touches,n=this.rtlTranslate,o=t;if(o.originalEvent&&(o=o.originalEvent),i.isTouched){if(!i.isTouchEvent||"mousemove"!==o.type){var l="touchmove"===o.type?o.targetTouches[0].pageX:o.pageX,h="touchmove"===o.type?o.targetTouches[0].pageY:o.pageY;if(o.preventedByNestedSwiper)return r.startX=l,void(r.startY=h);if(!this.allowTouchMove)return this.allowClick=!1,void(i.isTouched&&(d.extend(r,{startX:l,startY:h,currentX:l,currentY:h}),i.touchStartTime=d.now()));if(i.isTouchEvent&&a.touchReleaseOnEdges&&!a.loop)if(this.isVertical()){if(h<r.startY&&this.translate<=this.maxTranslate()||h>r.startY&&this.translate>=this.minTranslate())return i.isTouched=!1,void(i.isMoved=!1)}else if(l<r.startX&&this.translate<=this.maxTranslate()||l>r.startX&&this.translate>=this.minTranslate())return;if(i.isTouchEvent&&e.activeElement&&o.target===e.activeElement&&s(o.target).is(i.formElements))return i.isMoved=!0,void(this.allowClick=!1);if(i.allowTouchCallbacks&&this.emit("touchMove",o),!(o.targetTouches&&o.targetTouches.length>1)){r.currentX=l,r.currentY=h;var p,c=r.currentX-r.startX,u=r.currentY-r.startY;if(void 0===i.isScrolling&&(this.isHorizontal()&&r.currentY===r.startY||this.isVertical()&&r.currentX===r.startX?i.isScrolling=!1:c*c+u*u>=25&&(p=180*Math.atan2(Math.abs(u),Math.abs(c))/Math.PI,i.isScrolling=this.isHorizontal()?p>a.touchAngle:90-p>a.touchAngle)),i.isScrolling&&this.emit("touchMoveOpposite",o),"undefined"==typeof startMoving&&(r.currentX===r.startX&&r.currentY===r.startY||(i.startMoving=!0)),i.isScrolling)i.isTouched=!1;else if(i.startMoving){this.allowClick=!1,o.preventDefault(),a.touchMoveStopPropagation&&!a.nested&&o.stopPropagation(),i.isMoved||(a.loop&&this.loopFix(),i.startTranslate=this.getTranslate(),this.setTransition(0),this.animating&&this.$wrapperEl.trigger("webkitTransitionEnd transitionend"),i.allowMomentumBounce=!1,!a.grabCursor||!0!==this.allowSlideNext&&!0!==this.allowSlidePrev||this.setGrabCursor(!0),this.emit("sliderFirstMove",o)),this.emit("sliderMove",o),i.isMoved=!0;var v=this.isHorizontal()?c:u;r.diff=v,v*=a.touchRatio,n&&(v=-v),this.swipeDirection=v>0?"prev":"next",i.currentTranslate=v+i.startTranslate;var f=!0,m=a.resistanceRatio;if(a.touchReleaseOnEdges&&(m=0),v>0&&i.currentTranslate>this.minTranslate()?(f=!1,a.resistance&&(i.currentTranslate=this.minTranslate()-1+Math.pow(-this.minTranslate()+i.startTranslate+v,m))):v<0&&i.currentTranslate<this.maxTranslate()&&(f=!1,a.resistance&&(i.currentTranslate=this.maxTranslate()+1-Math.pow(this.maxTranslate()-i.startTranslate-v,m))),f&&(o.preventedByNestedSwiper=!0),!this.allowSlideNext&&"next"===this.swipeDirection&&i.currentTranslate<i.startTranslate&&(i.currentTranslate=i.startTranslate),!this.allowSlidePrev&&"prev"===this.swipeDirection&&i.currentTranslate>i.startTranslate&&(i.currentTranslate=i.startTranslate),a.threshold>0){if(!(Math.abs(v)>a.threshold||i.allowThresholdMove))return void(i.currentTranslate=i.startTranslate);if(!i.allowThresholdMove)return i.allowThresholdMove=!0,r.startX=r.currentX,r.startY=r.currentY,i.currentTranslate=i.startTranslate,void(r.diff=this.isHorizontal()?r.currentX-r.startX:r.currentY-r.startY)}a.followFinger&&((a.freeMode||a.watchSlidesProgress||a.watchSlidesVisibility)&&(this.updateActiveIndex(),this.updateSlidesClasses()),a.freeMode&&(0===i.velocities.length&&i.velocities.push({position:r[this.isHorizontal()?"startX":"startY"],time:i.touchStartTime}),i.velocities.push({position:r[this.isHorizontal()?"currentX":"currentY"],time:d.now()})),this.updateProgress(i.currentTranslate),this.setTranslate(i.currentTranslate))}}}}else i.startMoving&&i.isScrolling&&this.emit("touchMoveOpposite",o)}.bind(this),this.onTouchEnd=function(e){var t=this,i=t.touchEventsData,s=t.params,a=t.touches,r=t.rtlTranslate,n=t.$wrapperEl,o=t.slidesGrid,l=t.snapGrid,h=e;if(h.originalEvent&&(h=h.originalEvent),i.allowTouchCallbacks&&t.emit("touchEnd",h),i.allowTouchCallbacks=!1,!i.isTouched)return i.isMoved&&s.grabCursor&&t.setGrabCursor(!1),i.isMoved=!1,void(i.startMoving=!1);s.grabCursor&&i.isMoved&&i.isTouched&&(!0===t.allowSlideNext||!0===t.allowSlidePrev)&&t.setGrabCursor(!1);var p,c=d.now(),u=c-i.touchStartTime;if(t.allowClick&&(t.updateClickedSlide(h),t.emit("tap",h),u<300&&c-i.lastClickTime>300&&(i.clickTimeout&&clearTimeout(i.clickTimeout),i.clickTimeout=d.nextTick(function(){t&&!t.destroyed&&t.emit("click",h)},300)),u<300&&c-i.lastClickTime<300&&(i.clickTimeout&&clearTimeout(i.clickTimeout),t.emit("doubleTap",h))),i.lastClickTime=d.now(),d.nextTick(function(){t.destroyed||(t.allowClick=!0)}),!i.isTouched||!i.isMoved||!t.swipeDirection||0===a.diff||i.currentTranslate===i.startTranslate)return i.isTouched=!1,i.isMoved=!1,void(i.startMoving=!1);if(i.isTouched=!1,i.isMoved=!1,i.startMoving=!1,p=s.followFinger?r?t.translate:-t.translate:-i.currentTranslate,s.freeMode){if(p<-t.minTranslate())return void t.slideTo(t.activeIndex);if(p>-t.maxTranslate())return void(t.slides.length<l.length?t.slideTo(l.length-1):t.slideTo(t.slides.length-1));if(s.freeModeMomentum){if(i.velocities.length>1){var v=i.velocities.pop(),f=i.velocities.pop(),m=v.position-f.position,g=v.time-f.time;t.velocity=m/g,t.velocity/=2,Math.abs(t.velocity)<s.freeModeMinimumVelocity&&(t.velocity=0),(g>150||d.now()-v.time>300)&&(t.velocity=0)}else t.velocity=0;t.velocity*=s.freeModeMomentumVelocityRatio,i.velocities.length=0;var b=1e3*s.freeModeMomentumRatio,w=t.velocity*b,y=t.translate+w;r&&(y=-y);var x,E=!1,T=20*Math.abs(t.velocity)*s.freeModeMomentumBounceRatio;if(y<t.maxTranslate())s.freeModeMomentumBounce?(y+t.maxTranslate()<-T&&(y=t.maxTranslate()-T),x=t.maxTranslate(),E=!0,i.allowMomentumBounce=!0):y=t.maxTranslate();else if(y>t.minTranslate())s.freeModeMomentumBounce?(y-t.minTranslate()>T&&(y=t.minTranslate()+T),x=t.minTranslate(),E=!0,i.allowMomentumBounce=!0):y=t.minTranslate();else if(s.freeModeSticky){for(var S,C=0;C<l.length;C+=1)if(l[C]>-y){S=C;break}y=-(y=Math.abs(l[S]-y)<Math.abs(l[S-1]-y)||"next"===t.swipeDirection?l[S]:l[S-1])}if(0!==t.velocity)b=r?Math.abs((-y-t.translate)/t.velocity):Math.abs((y-t.translate)/t.velocity);else if(s.freeModeSticky)return void t.slideToClosest();s.freeModeMomentumBounce&&E?(t.updateProgress(x),t.setTransition(b),t.setTranslate(y),t.transitionStart(!0,t.swipeDirection),t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&i.allowMomentumBounce&&(t.emit("momentumBounce"),t.setTransition(s.speed),t.setTranslate(x),n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))})):t.velocity?(t.updateProgress(y),t.setTransition(b),t.setTranslate(y),t.transitionStart(!0,t.swipeDirection),t.animating||(t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))):t.updateProgress(y),t.updateActiveIndex(),t.updateSlidesClasses()}else if(s.freeModeSticky)return void t.slideToClosest();(!s.freeModeMomentum||u>=s.longSwipesMs)&&(t.updateProgress(),t.updateActiveIndex(),t.updateSlidesClasses())}else{for(var M=0,z=t.slidesSizesGrid[0],P=0;P<o.length;P+=s.slidesPerGroup)void 0!==o[P+s.slidesPerGroup]?p>=o[P]&&p<o[P+s.slidesPerGroup]&&(M=P,z=o[P+s.slidesPerGroup]-o[P]):p>=o[P]&&(M=P,z=o[o.length-1]-o[o.length-2]);var k=(p-o[M])/z;if(u>s.longSwipesMs){if(!s.longSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&(k>=s.longSwipesRatio?t.slideTo(M+s.slidesPerGroup):t.slideTo(M)),"prev"===t.swipeDirection&&(k>1-s.longSwipesRatio?t.slideTo(M+s.slidesPerGroup):t.slideTo(M))}else{if(!s.shortSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&t.slideTo(M+s.slidesPerGroup),"prev"===t.swipeDirection&&t.slideTo(M)}}}.bind(this),this.onClick=function(e){this.allowClick||(this.params.preventClicks&&e.preventDefault(),this.params.preventClicksPropagation&&this.animating&&(e.stopPropagation(),e.stopImmediatePropagation()))}.bind(this);var o="container"===i.touchEventsTarget?r:n,l=!!i.nested;if(h.touch||!h.pointerEvents&&!h.prefixedPointerEvents){if(h.touch){var p=!("touchstart"!==a.start||!h.passiveListener||!i.passiveListeners)&&{passive:!0,capture:!1};o.addEventListener(a.start,this.onTouchStart,p),o.addEventListener(a.move,this.onTouchMove,h.passiveListener?{passive:!1,capture:l}:l),o.addEventListener(a.end,this.onTouchEnd,p)}(i.simulateTouch&&!y.ios&&!y.android||i.simulateTouch&&!h.touch&&y.ios)&&(o.addEventListener("mousedown",this.onTouchStart,!1),e.addEventListener("mousemove",this.onTouchMove,l),e.addEventListener("mouseup",this.onTouchEnd,!1))}else o.addEventListener(a.start,this.onTouchStart,!1),e.addEventListener(a.move,this.onTouchMove,l),e.addEventListener(a.end,this.onTouchEnd,!1);(i.preventClicks||i.preventClicksPropagation)&&o.addEventListener("click",this.onClick,!0),this.on("resize observerUpdate",x,!0)},detachEvents:function(){var t=this.params,i=this.touchEvents,s=this.el,a=this.wrapperEl,r="container"===t.touchEventsTarget?s:a,n=!!t.nested;if(h.touch||!h.pointerEvents&&!h.prefixedPointerEvents){if(h.touch){var o=!("onTouchStart"!==i.start||!h.passiveListener||!t.passiveListeners)&&{passive:!0,capture:!1};r.removeEventListener(i.start,this.onTouchStart,o),r.removeEventListener(i.move,this.onTouchMove,n),r.removeEventListener(i.end,this.onTouchEnd,o)}(t.simulateTouch&&!y.ios&&!y.android||t.simulateTouch&&!h.touch&&y.ios)&&(r.removeEventListener("mousedown",this.onTouchStart,!1),e.removeEventListener("mousemove",this.onTouchMove,n),e.removeEventListener("mouseup",this.onTouchEnd,!1))}else r.removeEventListener(i.start,this.onTouchStart,!1),e.removeEventListener(i.move,this.onTouchMove,n),e.removeEventListener(i.end,this.onTouchEnd,!1);(t.preventClicks||t.preventClicksPropagation)&&r.removeEventListener("click",this.onClick,!0),this.off("resize observerUpdate",x)}};var T={setBreakpoint:function(){var e=this.activeIndex,t=this.loopedSlides;void 0===t&&(t=0);var i=this.params,s=i.breakpoints;if(s&&(!s||0!==Object.keys(s).length)){var a=this.getBreakpoint(s);if(a&&this.currentBreakpoint!==a){var r=a in s?s[a]:this.originalParams,n=i.loop&&r.slidesPerView!==i.slidesPerView;d.extend(this.params,r),d.extend(this,{allowTouchMove:this.params.allowTouchMove,allowSlideNext:this.params.allowSlideNext,allowSlidePrev:this.params.allowSlidePrev}),this.currentBreakpoint=a,n&&(this.loopDestroy(),this.loopCreate(),this.updateSlides(),this.slideTo(e-t+this.loopedSlides,0,!1)),this.emit("breakpoint",r)}}},getBreakpoint:function(e){if(e){var i=!1,s=[];Object.keys(e).forEach(function(e){s.push(e)}),s.sort(function(e,t){return parseInt(e,10)-parseInt(t,10)});for(var a=0;a<s.length;a+=1){var r=s[a];r>=t.innerWidth&&!i&&(i=r)}return i||"max"}}},S=function(){return{isIE:!!t.navigator.userAgent.match(/Trident/g)||!!t.navigator.userAgent.match(/MSIE/g),isSafari:(e=t.navigator.userAgent.toLowerCase(),e.indexOf("safari")>=0&&e.indexOf("chrome")<0&&e.indexOf("android")<0),isUiWebView:/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(t.navigator.userAgent)};var e}();var C={init:!0,direction:"horizontal",touchEventsTarget:"container",initialSlide:0,speed:300,preventIntercationOnTransition:!1,iOSEdgeSwipeDetection:!1,iOSEdgeSwipeThreshold:20,freeMode:!1,freeModeMomentum:!0,freeModeMomentumRatio:1,freeModeMomentumBounce:!0,freeModeMomentumBounceRatio:1,freeModeMomentumVelocityRatio:1,freeModeSticky:!1,freeModeMinimumVelocity:.02,autoHeight:!1,setWrapperSize:!1,virtualTranslate:!1,effect:"slide",breakpoints:void 0,spaceBetween:0,slidesPerView:1,slidesPerColumn:1,slidesPerColumnFill:"column",slidesPerGroup:1,centeredSlides:!1,slidesOffsetBefore:0,slidesOffsetAfter:0,normalizeSlideIndex:!0,watchOverflow:!1,roundLengths:!1,touchRatio:1,touchAngle:45,simulateTouch:!0,shortSwipes:!0,longSwipes:!0,longSwipesRatio:.5,longSwipesMs:300,followFinger:!0,allowTouchMove:!0,threshold:0,touchMoveStopPropagation:!0,touchReleaseOnEdges:!1,uniqueNavElements:!0,resistance:!0,resistanceRatio:.85,watchSlidesProgress:!1,watchSlidesVisibility:!1,grabCursor:!1,preventClicks:!0,preventClicksPropagation:!0,slideToClickedSlide:!1,preloadImages:!0,updateOnImagesReady:!0,loop:!1,loopAdditionalSlides:0,loopedSlides:null,loopFillGroupWithBlank:!1,allowSlidePrev:!0,allowSlideNext:!0,swipeHandler:null,noSwiping:!0,noSwipingClass:"swiper-no-swiping",noSwipingSelector:null,passiveListeners:!0,containerModifierClass:"swiper-container-",slideClass:"swiper-slide",slideBlankClass:"swiper-slide-invisible-blank",slideActiveClass:"swiper-slide-active",slideDuplicateActiveClass:"swiper-slide-duplicate-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",slideNextClass:"swiper-slide-next",slideDuplicateNextClass:"swiper-slide-duplicate-next",slidePrevClass:"swiper-slide-prev",slideDuplicatePrevClass:"swiper-slide-duplicate-prev",wrapperClass:"swiper-wrapper",runCallbacksOnInit:!0},M={update:u,translate:v,transition:f,slide:m,loop:g,grabCursor:b,manipulation:w,events:E,breakpoints:T,checkOverflow:{checkOverflow:function(){var e=this.isLocked;this.isLocked=1===this.snapGrid.length,this.allowTouchMove=!this.isLocked,e&&e!==this.isLocked&&(this.isEnd=!1,this.navigation.update())}},classes:{addClasses:function(){var e=this.classNames,t=this.params,i=this.rtl,s=this.$el,a=[];a.push(t.direction),t.freeMode&&a.push("free-mode"),h.flexbox||a.push("no-flexbox"),t.autoHeight&&a.push("autoheight"),i&&a.push("rtl"),t.slidesPerColumn>1&&a.push("multirow"),y.android&&a.push("android"),y.ios&&a.push("ios"),S.isIE&&(h.pointerEvents||h.prefixedPointerEvents)&&a.push("wp8-"+t.direction),a.forEach(function(i){e.push(t.containerModifierClass+i)}),s.addClass(e.join(" "))},removeClasses:function(){var e=this.$el,t=this.classNames;e.removeClass(t.join(" "))}},images:{loadImage:function(e,i,s,a,r,n){var o;function l(){n&&n()}e.complete&&r?l():i?((o=new t.Image).onload=l,o.onerror=l,a&&(o.sizes=a),s&&(o.srcset=s),i&&(o.src=i)):l()},preloadImages:function(){var e=this;function t(){void 0!==e&&null!==e&&e&&!e.destroyed&&(void 0!==e.imagesLoaded&&(e.imagesLoaded+=1),e.imagesLoaded===e.imagesToLoad.length&&(e.params.updateOnImagesReady&&e.update(),e.emit("imagesReady")))}e.imagesToLoad=e.$el.find("img");for(var i=0;i<e.imagesToLoad.length;i+=1){var s=e.imagesToLoad[i];e.loadImage(s,s.currentSrc||s.getAttribute("src"),s.srcset||s.getAttribute("srcset"),s.sizes||s.getAttribute("sizes"),!0,t)}}}},z={},P=function(e){function t(){for(var i,a,r,n=[],o=arguments.length;o--;)n[o]=arguments[o];1===n.length&&n[0].constructor&&n[0].constructor===Object?r=n[0]:(a=(i=n)[0],r=i[1]),r||(r={}),r=d.extend({},r),a&&!r.el&&(r.el=a),e.call(this,r),Object.keys(M).forEach(function(e){Object.keys(M[e]).forEach(function(i){t.prototype[i]||(t.prototype[i]=M[e][i])})});var l=this;void 0===l.modules&&(l.modules={}),Object.keys(l.modules).forEach(function(e){var t=l.modules[e];if(t.params){var i=Object.keys(t.params)[0],s=t.params[i];if("object"!=typeof s)return;if(!(i in r&&"enabled"in s))return;!0===r[i]&&(r[i]={enabled:!0}),"object"!=typeof r[i]||"enabled"in r[i]||(r[i].enabled=!0),r[i]||(r[i]={enabled:!1})}});var p=d.extend({},C);l.useModulesParams(p),l.params=d.extend({},p,z,r),l.originalParams=d.extend({},l.params),l.passedParams=d.extend({},r),l.$=s;var c=s(l.params.el);if(a=c[0]){if(c.length>1){var u=[];return c.each(function(e,i){var s=d.extend({},r,{el:i});u.push(new t(s))}),u}a.swiper=l,c.data("swiper",l);var v,f,m=c.children("."+l.params.wrapperClass);return d.extend(l,{$el:c,el:a,$wrapperEl:m,wrapperEl:m[0],classNames:[],slides:s(),slidesGrid:[],snapGrid:[],slidesSizesGrid:[],isHorizontal:function(){return"horizontal"===l.params.direction},isVertical:function(){return"vertical"===l.params.direction},rtl:"rtl"===a.dir.toLowerCase()||"rtl"===c.css("direction"),rtlTranslate:"horizontal"===l.params.direction&&("rtl"===a.dir.toLowerCase()||"rtl"===c.css("direction")),wrongRTL:"-webkit-box"===m.css("display"),activeIndex:0,realIndex:0,isBeginning:!0,isEnd:!1,translate:0,progress:0,velocity:0,animating:!1,allowSlideNext:l.params.allowSlideNext,allowSlidePrev:l.params.allowSlidePrev,touchEvents:(v=["touchstart","touchmove","touchend"],f=["mousedown","mousemove","mouseup"],h.pointerEvents?f=["pointerdown","pointermove","pointerup"]:h.prefixedPointerEvents&&(f=["MSPointerDown","MSPointerMove","MSPointerUp"]),l.touchEventsTouch={start:v[0],move:v[1],end:v[2]},l.touchEventsDesktop={start:f[0],move:f[1],end:f[2]},h.touch||!l.params.simulateTouch?l.touchEventsTouch:l.touchEventsDesktop),touchEventsData:{isTouched:void 0,isMoved:void 0,allowTouchCallbacks:void 0,touchStartTime:void 0,isScrolling:void 0,currentTranslate:void 0,startTranslate:void 0,allowThresholdMove:void 0,formElements:"input, select, option, textarea, button, video",lastClickTime:d.now(),clickTimeout:void 0,velocities:[],allowMomentumBounce:void 0,isTouchEvent:void 0,startMoving:void 0},allowClick:!0,allowTouchMove:l.params.allowTouchMove,touches:{startX:0,startY:0,currentX:0,currentY:0,diff:0},imagesToLoad:[],imagesLoaded:0}),l.useModules(),l.params.init&&l.init(),l}}e&&(t.__proto__=e),t.prototype=Object.create(e&&e.prototype),t.prototype.constructor=t;var i={extendedDefaults:{configurable:!0},defaults:{configurable:!0},Class:{configurable:!0},$:{configurable:!0}};return t.prototype.slidesPerViewDynamic=function(){var e=this.params,t=this.slides,i=this.slidesGrid,s=this.size,a=this.activeIndex,r=1;if(e.centeredSlides){for(var n,o=t[a].swiperSlideSize,l=a+1;l<t.length;l+=1)t[l]&&!n&&(r+=1,(o+=t[l].swiperSlideSize)>s&&(n=!0));for(var d=a-1;d>=0;d-=1)t[d]&&!n&&(r+=1,(o+=t[d].swiperSlideSize)>s&&(n=!0))}else for(var h=a+1;h<t.length;h+=1)i[h]-i[a]<s&&(r+=1);return r},t.prototype.update=function(){var e=this;e&&!e.destroyed&&(e.updateSize(),e.updateSlides(),e.updateProgress(),e.updateSlidesClasses(),e.params.freeMode?(t(),e.params.autoHeight&&e.updateAutoHeight()):(("auto"===e.params.slidesPerView||e.params.slidesPerView>1)&&e.isEnd&&!e.params.centeredSlides?e.slideTo(e.slides.length-1,0,!1,!0):e.slideTo(e.activeIndex,0,!1,!0))||t(),e.emit("update"));function t(){var t=e.rtlTranslate?-1*e.translate:e.translate,i=Math.min(Math.max(t,e.maxTranslate()),e.minTranslate());e.setTranslate(i),e.updateActiveIndex(),e.updateSlidesClasses()}},t.prototype.init=function(){this.initialized||(this.emit("beforeInit"),this.params.breakpoints&&this.setBreakpoint(),this.addClasses(),this.params.loop&&this.loopCreate(),this.updateSize(),this.updateSlides(),this.params.watchOverflow&&this.checkOverflow(),this.params.grabCursor&&this.setGrabCursor(),this.params.preloadImages&&this.preloadImages(),this.params.loop?this.slideTo(this.params.initialSlide+this.loopedSlides,0,this.params.runCallbacksOnInit):this.slideTo(this.params.initialSlide,0,this.params.runCallbacksOnInit),this.attachEvents(),this.initialized=!0,this.emit("init"))},t.prototype.destroy=function(e,t){void 0===e&&(e=!0),void 0===t&&(t=!0);var i=this,s=i.params,a=i.$el,r=i.$wrapperEl,n=i.slides;i.emit("beforeDestroy"),i.initialized=!1,i.detachEvents(),s.loop&&i.loopDestroy(),t&&(i.removeClasses(),a.removeAttr("style"),r.removeAttr("style"),n&&n.length&&n.removeClass([s.slideVisibleClass,s.slideActiveClass,s.slideNextClass,s.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index").removeAttr("data-swiper-column").removeAttr("data-swiper-row")),i.emit("destroy"),Object.keys(i.eventsListeners).forEach(function(e){i.off(e)}),!1!==e&&(i.$el[0].swiper=null,i.$el.data("swiper",null),d.deleteProps(i)),i.destroyed=!0},t.extendDefaults=function(e){d.extend(z,e)},i.extendedDefaults.get=function(){return z},i.defaults.get=function(){return C},i.Class.get=function(){return e},i.$.get=function(){return s},Object.defineProperties(t,i),t}(p),k={name:"device",proto:{device:y},static:{device:y}},$={name:"support",proto:{support:h},static:{support:h}},L={name:"browser",proto:{browser:S},static:{browser:S}},I={name:"resize",create:function(){var e=this;d.extend(e,{resize:{resizeHandler:function(){e&&!e.destroyed&&e.initialized&&(e.emit("beforeResize"),e.emit("resize"))},orientationChangeHandler:function(){e&&!e.destroyed&&e.initialized&&e.emit("orientationchange")}}})},on:{init:function(){t.addEventListener("resize",this.resize.resizeHandler),t.addEventListener("orientationchange",this.resize.orientationChangeHandler)},destroy:function(){t.removeEventListener("resize",this.resize.resizeHandler),t.removeEventListener("orientationchange",this.resize.orientationChangeHandler)}}},D={func:t.MutationObserver||t.WebkitMutationObserver,attach:function(e,t){void 0===t&&(t={});var i=this,s=new(0,D.func)(function(e){e.forEach(function(e){i.emit("observerUpdate",e)})});s.observe(e,{attributes:void 0===t.attributes||t.attributes,childList:void 0===t.childList||t.childList,characterData:void 0===t.characterData||t.characterData}),i.observer.observers.push(s)},init:function(){if(h.observer&&this.params.observer){if(this.params.observeParents)for(var e=this.$el.parents(),t=0;t<e.length;t+=1)this.observer.attach(e[t]);this.observer.attach(this.$el[0],{childList:!1}),this.observer.attach(this.$wrapperEl[0],{attributes:!1})}},destroy:function(){this.observer.observers.forEach(function(e){e.disconnect()}),this.observer.observers=[]}},O={name:"observer",params:{observer:!1,observeParents:!1},create:function(){d.extend(this,{observer:{init:D.init.bind(this),attach:D.attach.bind(this),destroy:D.destroy.bind(this),observers:[]}})},on:{init:function(){this.observer.init()},destroy:function(){this.observer.destroy()}}},A={update:function(e){var t=this,i=t.params,s=i.slidesPerView,a=i.slidesPerGroup,r=i.centeredSlides,n=t.virtual,o=n.from,l=n.to,h=n.slides,p=n.slidesGrid,c=n.renderSlide,u=n.offset;t.updateActiveIndex();var v,f,m,g=t.activeIndex||0;v=t.rtlTranslate?"right":t.isHorizontal()?"left":"top",r?(f=Math.floor(s/2)+a,m=Math.floor(s/2)+a):(f=s+(a-1),m=a);var b=Math.max((g||0)-m,0),w=Math.min((g||0)+f,h.length-1),y=(t.slidesGrid[b]||0)-(t.slidesGrid[0]||0);function x(){t.updateSlides(),t.updateProgress(),t.updateSlidesClasses(),t.lazy&&t.params.lazy.enabled&&t.lazy.load()}if(d.extend(t.virtual,{from:b,to:w,offset:y,slidesGrid:t.slidesGrid}),o===b&&l===w&&!e)return t.slidesGrid!==p&&y!==u&&t.slides.css(v,y+"px"),void t.updateProgress();if(t.params.virtual.renderExternal)return t.params.virtual.renderExternal.call(t,{offset:y,from:b,to:w,slides:function(){for(var e=[],t=b;t<=w;t+=1)e.push(h[t]);return e}()}),void x();var E=[],T=[];if(e)t.$wrapperEl.find("."+t.params.slideClass).remove();else for(var S=o;S<=l;S+=1)(S<b||S>w)&&t.$wrapperEl.find("."+t.params.slideClass+'[data-swiper-slide-index="'+S+'"]').remove();for(var C=0;C<h.length;C+=1)C>=b&&C<=w&&(void 0===l||e?T.push(C):(C>l&&T.push(C),C<o&&E.push(C)));T.forEach(function(e){t.$wrapperEl.append(c(h[e],e))}),E.sort(function(e,t){return e<t}).forEach(function(e){t.$wrapperEl.prepend(c(h[e],e))}),t.$wrapperEl.children(".swiper-slide").css(v,y+"px"),x()},renderSlide:function(e,t){var i=this.params.virtual;if(i.cache&&this.virtual.cache[t])return this.virtual.cache[t];var a=i.renderSlide?s(i.renderSlide.call(this,e,t)):s('<div class="'+this.params.slideClass+'" data-swiper-slide-index="'+t+'">'+e+"</div>");return a.attr("data-swiper-slide-index")||a.attr("data-swiper-slide-index",t),i.cache&&(this.virtual.cache[t]=a),a},appendSlide:function(e){this.virtual.slides.push(e),this.virtual.update(!0)},prependSlide:function(e){if(this.virtual.slides.unshift(e),this.params.virtual.cache){var t=this.virtual.cache,i={};Object.keys(t).forEach(function(e){i[e+1]=t[e]}),this.virtual.cache=i}this.virtual.update(!0),this.slideNext(0)}},H={name:"virtual",params:{virtual:{enabled:!1,slides:[],cache:!0,renderSlide:null,renderExternal:null}},create:function(){d.extend(this,{virtual:{update:A.update.bind(this),appendSlide:A.appendSlide.bind(this),prependSlide:A.prependSlide.bind(this),renderSlide:A.renderSlide.bind(this),slides:this.params.virtual.slides,cache:{}}})},on:{beforeInit:function(){if(this.params.virtual.enabled){this.classNames.push(this.params.containerModifierClass+"virtual");var e={watchSlidesProgress:!0};d.extend(this.params,e),d.extend(this.originalParams,e),this.virtual.update()}},setTranslate:function(){this.params.virtual.enabled&&this.virtual.update()}}},N={handle:function(i){var s=this.rtlTranslate,a=i;a.originalEvent&&(a=a.originalEvent);var r=a.keyCode||a.charCode;if(!this.allowSlideNext&&(this.isHorizontal()&&39===r||this.isVertical()&&40===r))return!1;if(!this.allowSlidePrev&&(this.isHorizontal()&&37===r||this.isVertical()&&38===r))return!1;if(!(a.shiftKey||a.altKey||a.ctrlKey||a.metaKey||e.activeElement&&e.activeElement.nodeName&&("input"===e.activeElement.nodeName.toLowerCase()||"textarea"===e.activeElement.nodeName.toLowerCase()))){if(this.params.keyboard.onlyInViewport&&(37===r||39===r||38===r||40===r)){var n=!1;if(this.$el.parents("."+this.params.slideClass).length>0&&0===this.$el.parents("."+this.params.slideActiveClass).length)return;var o=t.innerWidth,l=t.innerHeight,d=this.$el.offset();s&&(d.left-=this.$el[0].scrollLeft);for(var h=[[d.left,d.top],[d.left+this.width,d.top],[d.left,d.top+this.height],[d.left+this.width,d.top+this.height]],p=0;p<h.length;p+=1){var c=h[p];c[0]>=0&&c[0]<=o&&c[1]>=0&&c[1]<=l&&(n=!0)}if(!n)return}this.isHorizontal()?(37!==r&&39!==r||(a.preventDefault?a.preventDefault():a.returnValue=!1),(39===r&&!s||37===r&&s)&&this.slideNext(),(37===r&&!s||39===r&&s)&&this.slidePrev()):(38!==r&&40!==r||(a.preventDefault?a.preventDefault():a.returnValue=!1),40===r&&this.slideNext(),38===r&&this.slidePrev()),this.emit("keyPress",r)}},enable:function(){this.keyboard.enabled||(s(e).on("keydown",this.keyboard.handle),this.keyboard.enabled=!0)},disable:function(){this.keyboard.enabled&&(s(e).off("keydown",this.keyboard.handle),this.keyboard.enabled=!1)}},B={name:"keyboard",params:{keyboard:{enabled:!1,onlyInViewport:!0}},create:function(){d.extend(this,{keyboard:{enabled:!1,enable:N.enable.bind(this),disable:N.disable.bind(this),handle:N.handle.bind(this)}})},on:{init:function(){this.params.keyboard.enabled&&this.keyboard.enable()},destroy:function(){this.keyboard.enabled&&this.keyboard.disable()}}};var G={lastScrollTime:d.now(),event:t.navigator.userAgent.indexOf("firefox")>-1?"DOMMouseScroll":function(){var t="onwheel"in e;if(!t){var i=e.createElement("div");i.setAttribute("onwheel","return;"),t="function"==typeof i.onwheel}return!t&&e.implementation&&e.implementation.hasFeature&&!0!==e.implementation.hasFeature("","")&&(t=e.implementation.hasFeature("Events.wheel","3.0")),t}()?"wheel":"mousewheel",normalize:function(e){var t=0,i=0,s=0,a=0;return"detail"in e&&(i=e.detail),"wheelDelta"in e&&(i=-e.wheelDelta/120),"wheelDeltaY"in e&&(i=-e.wheelDeltaY/120),"wheelDeltaX"in e&&(t=-e.wheelDeltaX/120),"axis"in e&&e.axis===e.HORIZONTAL_AXIS&&(t=i,i=0),s=10*t,a=10*i,"deltaY"in e&&(a=e.deltaY),"deltaX"in e&&(s=e.deltaX),(s||a)&&e.deltaMode&&(1===e.deltaMode?(s*=40,a*=40):(s*=800,a*=800)),s&&!t&&(t=s<1?-1:1),a&&!i&&(i=a<1?-1:1),{spinX:t,spinY:i,pixelX:s,pixelY:a}},handleMouseEnter:function(){this.mouseEntered=!0},handleMouseLeave:function(){this.mouseEntered=!1},handle:function(e){var i=e,s=this,a=s.params.mousewheel;if(!s.mouseEntered&&!a.releaseOnEdges)return!0;i.originalEvent&&(i=i.originalEvent);var r=0,n=s.rtlTranslate?-1:1,o=G.normalize(i);if(a.forceToAxis)if(s.isHorizontal()){if(!(Math.abs(o.pixelX)>Math.abs(o.pixelY)))return!0;r=o.pixelX*n}else{if(!(Math.abs(o.pixelY)>Math.abs(o.pixelX)))return!0;r=o.pixelY}else r=Math.abs(o.pixelX)>Math.abs(o.pixelY)?-o.pixelX*n:-o.pixelY;if(0===r)return!0;if(a.invert&&(r=-r),s.params.freeMode){var l=s.getTranslate()+r*a.sensitivity,h=s.isBeginning,p=s.isEnd;if(l>=s.minTranslate()&&(l=s.minTranslate()),l<=s.maxTranslate()&&(l=s.maxTranslate()),s.setTransition(0),s.setTranslate(l),s.updateProgress(),s.updateActiveIndex(),s.updateSlidesClasses(),(!h&&s.isBeginning||!p&&s.isEnd)&&s.updateSlidesClasses(),s.params.freeModeSticky&&(clearTimeout(s.mousewheel.timeout),s.mousewheel.timeout=d.nextTick(function(){s.slideToClosest()},300)),s.emit("scroll",i),s.params.autoplay&&s.params.autoplayDisableOnInteraction&&s.stopAutoplay(),l===s.minTranslate()||l===s.maxTranslate())return!0}else{if(d.now()-s.mousewheel.lastScrollTime>60)if(r<0)if(s.isEnd&&!s.params.loop||s.animating){if(a.releaseOnEdges)return!0}else s.slideNext(),s.emit("scroll",i);else if(s.isBeginning&&!s.params.loop||s.animating){if(a.releaseOnEdges)return!0}else s.slidePrev(),s.emit("scroll",i);s.mousewheel.lastScrollTime=(new t.Date).getTime()}return i.preventDefault?i.preventDefault():i.returnValue=!1,!1},enable:function(){if(!G.event)return!1;if(this.mousewheel.enabled)return!1;var e=this.$el;return"container"!==this.params.mousewheel.eventsTarged&&(e=s(this.params.mousewheel.eventsTarged)),e.on("mouseenter",this.mousewheel.handleMouseEnter),e.on("mouseleave",this.mousewheel.handleMouseLeave),e.on(G.event,this.mousewheel.handle),this.mousewheel.enabled=!0,!0},disable:function(){if(!G.event)return!1;if(!this.mousewheel.enabled)return!1;var e=this.$el;return"container"!==this.params.mousewheel.eventsTarged&&(e=s(this.params.mousewheel.eventsTarged)),e.off(G.event,this.mousewheel.handle),this.mousewheel.enabled=!1,!0}},X={update:function(){var e=this.params.navigation;if(!this.params.loop){var t=this.navigation,i=t.$nextEl,s=t.$prevEl;s&&s.length>0&&(this.isBeginning?s.addClass(e.disabledClass):s.removeClass(e.disabledClass),s[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](e.lockClass)),i&&i.length>0&&(this.isEnd?i.addClass(e.disabledClass):i.removeClass(e.disabledClass),i[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](e.lockClass))}},init:function(){var e,t,i=this,a=i.params.navigation;(a.nextEl||a.prevEl)&&(a.nextEl&&(e=s(a.nextEl),i.params.uniqueNavElements&&"string"==typeof a.nextEl&&e.length>1&&1===i.$el.find(a.nextEl).length&&(e=i.$el.find(a.nextEl))),a.prevEl&&(t=s(a.prevEl),i.params.uniqueNavElements&&"string"==typeof a.prevEl&&t.length>1&&1===i.$el.find(a.prevEl).length&&(t=i.$el.find(a.prevEl))),e&&e.length>0&&e.on("click",function(e){e.preventDefault(),i.isEnd&&!i.params.loop||i.slideNext()}),t&&t.length>0&&t.on("click",function(e){e.preventDefault(),i.isBeginning&&!i.params.loop||i.slidePrev()}),d.extend(i.navigation,{$nextEl:e,nextEl:e&&e[0],$prevEl:t,prevEl:t&&t[0]}))},destroy:function(){var e=this.navigation,t=e.$nextEl,i=e.$prevEl;t&&t.length&&(t.off("click"),t.removeClass(this.params.navigation.disabledClass)),i&&i.length&&(i.off("click"),i.removeClass(this.params.navigation.disabledClass))}},Y={update:function(){var e=this.rtl,t=this.params.pagination;if(t.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var i,a=this.virtual&&this.params.virtual.enabled?this.virtual.slides.length:this.slides.length,r=this.pagination.$el,n=this.params.loop?Math.ceil((a-2*this.loopedSlides)/this.params.slidesPerGroup):this.snapGrid.length;if(this.params.loop?((i=Math.ceil((this.activeIndex-this.loopedSlides)/this.params.slidesPerGroup))>a-1-2*this.loopedSlides&&(i-=a-2*this.loopedSlides),i>n-1&&(i-=n),i<0&&"bullets"!==this.params.paginationType&&(i=n+i)):i=void 0!==this.snapIndex?this.snapIndex:this.activeIndex||0,"bullets"===t.type&&this.pagination.bullets&&this.pagination.bullets.length>0){var o,l,d,h=this.pagination.bullets;if(t.dynamicBullets&&(this.pagination.bulletSize=h.eq(0)[this.isHorizontal()?"outerWidth":"outerHeight"](!0),r.css(this.isHorizontal()?"width":"height",this.pagination.bulletSize*(t.dynamicMainBullets+4)+"px"),t.dynamicMainBullets>1&&void 0!==this.previousIndex&&(this.pagination.dynamicBulletIndex+=i-this.previousIndex,this.pagination.dynamicBulletIndex>t.dynamicMainBullets-1?this.pagination.dynamicBulletIndex=t.dynamicMainBullets-1:this.pagination.dynamicBulletIndex<0&&(this.pagination.dynamicBulletIndex=0)),o=i-this.pagination.dynamicBulletIndex,d=((l=o+(Math.min(h.length,t.dynamicMainBullets)-1))+o)/2),h.removeClass(t.bulletActiveClass+" "+t.bulletActiveClass+"-next "+t.bulletActiveClass+"-next-next "+t.bulletActiveClass+"-prev "+t.bulletActiveClass+"-prev-prev "+t.bulletActiveClass+"-main"),r.length>1)h.each(function(e,a){var r=s(a),n=r.index();n===i&&r.addClass(t.bulletActiveClass),t.dynamicBullets&&(n>=o&&n<=l&&r.addClass(t.bulletActiveClass+"-main"),n===o&&r.prev().addClass(t.bulletActiveClass+"-prev").prev().addClass(t.bulletActiveClass+"-prev-prev"),n===l&&r.next().addClass(t.bulletActiveClass+"-next").next().addClass(t.bulletActiveClass+"-next-next"))});else if(h.eq(i).addClass(t.bulletActiveClass),t.dynamicBullets){for(var p=h.eq(o),c=h.eq(l),u=o;u<=l;u+=1)h.eq(u).addClass(t.bulletActiveClass+"-main");p.prev().addClass(t.bulletActiveClass+"-prev").prev().addClass(t.bulletActiveClass+"-prev-prev"),c.next().addClass(t.bulletActiveClass+"-next").next().addClass(t.bulletActiveClass+"-next-next")}if(t.dynamicBullets){var v=Math.min(h.length,t.dynamicMainBullets+4),f=(this.pagination.bulletSize*v-this.pagination.bulletSize)/2-d*this.pagination.bulletSize,m=e?"right":"left";h.css(this.isHorizontal()?m:"top",f+"px")}}if("fraction"===t.type&&(r.find("."+t.currentClass).text(i+1),r.find("."+t.totalClass).text(n)),"progressbar"===t.type){var g=(i+1)/n,b=g,w=1;this.isHorizontal()||(w=g,b=1),r.find("."+t.progressbarFillClass).transform("translate3d(0,0,0) scaleX("+b+") scaleY("+w+")").transition(this.params.speed)}"custom"===t.type&&t.renderCustom?(r.html(t.renderCustom(this,i+1,n)),this.emit("paginationRender",this,r[0])):this.emit("paginationUpdate",this,r[0]),r[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](t.lockClass)}},render:function(){var e=this.params.pagination;if(e.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var t=this.virtual&&this.params.virtual.enabled?this.virtual.slides.length:this.slides.length,i=this.pagination.$el,s="";if("bullets"===e.type){for(var a=this.params.loop?Math.ceil((t-2*this.loopedSlides)/this.params.slidesPerGroup):this.snapGrid.length,r=0;r<a;r+=1)e.renderBullet?s+=e.renderBullet.call(this,r,e.bulletClass):s+="<"+e.bulletElement+' class="'+e.bulletClass+'"></'+e.bulletElement+">";i.html(s),this.pagination.bullets=i.find("."+e.bulletClass)}"fraction"===e.type&&(s=e.renderFraction?e.renderFraction.call(this,e.currentClass,e.totalClass):'<span class="'+e.currentClass+'"></span> / <span class="'+e.totalClass+'"></span>',i.html(s)),"progressbar"===e.type&&(s=e.renderProgressbar?e.renderProgressbar.call(this,e.progressbarFillClass):'<span class="'+e.progressbarFillClass+'"></span>',i.html(s)),"custom"!==e.type&&this.emit("paginationRender",this.pagination.$el[0])}},init:function(){var e=this,t=e.params.pagination;if(t.el){var i=s(t.el);0!==i.length&&(e.params.uniqueNavElements&&"string"==typeof t.el&&i.length>1&&1===e.$el.find(t.el).length&&(i=e.$el.find(t.el)),"bullets"===t.type&&t.clickable&&i.addClass(t.clickableClass),i.addClass(t.modifierClass+t.type),"bullets"===t.type&&t.dynamicBullets&&(i.addClass(""+t.modifierClass+t.type+"-dynamic"),e.pagination.dynamicBulletIndex=0,t.dynamicMainBullets<1&&(t.dynamicMainBullets=1)),t.clickable&&i.on("click","."+t.bulletClass,function(t){t.preventDefault();var i=s(this).index()*e.params.slidesPerGroup;e.params.loop&&(i+=e.loopedSlides),e.slideTo(i)}),d.extend(e.pagination,{$el:i,el:i[0]}))}},destroy:function(){var e=this.params.pagination;if(e.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var t=this.pagination.$el;t.removeClass(e.hiddenClass),t.removeClass(e.modifierClass+e.type),this.pagination.bullets&&this.pagination.bullets.removeClass(e.bulletActiveClass),e.clickable&&t.off("click","."+e.bulletClass)}}},V={setTranslate:function(){if(this.params.scrollbar.el&&this.scrollbar.el){var e=this.scrollbar,t=this.rtlTranslate,i=this.progress,s=e.dragSize,a=e.trackSize,r=e.$dragEl,n=e.$el,o=this.params.scrollbar,l=s,d=(a-s)*i;t?(d=-d)>0?(l=s-d,d=0):-d+s>a&&(l=a+d):d<0?(l=s+d,d=0):d+s>a&&(l=a-d),this.isHorizontal()?(h.transforms3d?r.transform("translate3d("+d+"px, 0, 0)"):r.transform("translateX("+d+"px)"),r[0].style.width=l+"px"):(h.transforms3d?r.transform("translate3d(0px, "+d+"px, 0)"):r.transform("translateY("+d+"px)"),r[0].style.height=l+"px"),o.hide&&(clearTimeout(this.scrollbar.timeout),n[0].style.opacity=1,this.scrollbar.timeout=setTimeout(function(){n[0].style.opacity=0,n.transition(400)},1e3))}},setTransition:function(e){this.params.scrollbar.el&&this.scrollbar.el&&this.scrollbar.$dragEl.transition(e)},updateSize:function(){if(this.params.scrollbar.el&&this.scrollbar.el){var e=this.scrollbar,t=e.$dragEl,i=e.$el;t[0].style.width="",t[0].style.height="";var s,a=this.isHorizontal()?i[0].offsetWidth:i[0].offsetHeight,r=this.size/this.virtualSize,n=r*(a/this.size);s="auto"===this.params.scrollbar.dragSize?a*r:parseInt(this.params.scrollbar.dragSize,10),this.isHorizontal()?t[0].style.width=s+"px":t[0].style.height=s+"px",i[0].style.display=r>=1?"none":"",this.params.scrollbarHide&&(i[0].style.opacity=0),d.extend(e,{trackSize:a,divider:r,moveDivider:n,dragSize:s}),e.$el[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](this.params.scrollbar.lockClass)}},setDragPosition:function(e){var t,i=this.scrollbar,s=this.rtlTranslate,a=i.$el,r=i.dragSize,n=i.trackSize;t=((this.isHorizontal()?"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageX:e.pageX||e.clientX:"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageY:e.pageY||e.clientY)-a.offset()[this.isHorizontal()?"left":"top"]-r/2)/(n-r),t=Math.max(Math.min(t,1),0),s&&(t=1-t);var o=this.minTranslate()+(this.maxTranslate()-this.minTranslate())*t;this.updateProgress(o),this.setTranslate(o),this.updateActiveIndex(),this.updateSlidesClasses()},onDragStart:function(e){var t=this.params.scrollbar,i=this.scrollbar,s=this.$wrapperEl,a=i.$el,r=i.$dragEl;this.scrollbar.isTouched=!0,e.preventDefault(),e.stopPropagation(),s.transition(100),r.transition(100),i.setDragPosition(e),clearTimeout(this.scrollbar.dragTimeout),a.transition(0),t.hide&&a.css("opacity",1),this.emit("scrollbarDragStart",e)},onDragMove:function(e){var t=this.scrollbar,i=this.$wrapperEl,s=t.$el,a=t.$dragEl;this.scrollbar.isTouched&&(e.preventDefault?e.preventDefault():e.returnValue=!1,t.setDragPosition(e),i.transition(0),s.transition(0),a.transition(0),this.emit("scrollbarDragMove",e))},onDragEnd:function(e){var t=this.params.scrollbar,i=this.scrollbar.$el;this.scrollbar.isTouched&&(this.scrollbar.isTouched=!1,t.hide&&(clearTimeout(this.scrollbar.dragTimeout),this.scrollbar.dragTimeout=d.nextTick(function(){i.css("opacity",0),i.transition(400)},1e3)),this.emit("scrollbarDragEnd",e),t.snapOnRelease&&this.slideToClosest())},enableDraggable:function(){if(this.params.scrollbar.el){var t=this.scrollbar,i=this.touchEvents,s=this.touchEventsDesktop,a=this.params,r=t.$el[0],n=!(!h.passiveListener||!a.passiveListener)&&{passive:!1,capture:!1},o=!(!h.passiveListener||!a.passiveListener)&&{passive:!0,capture:!1};h.touch||!h.pointerEvents&&!h.prefixedPointerEvents?(h.touch&&(r.addEventListener(i.start,this.scrollbar.onDragStart,n),r.addEventListener(i.move,this.scrollbar.onDragMove,n),r.addEventListener(i.end,this.scrollbar.onDragEnd,o)),(a.simulateTouch&&!y.ios&&!y.android||a.simulateTouch&&!h.touch&&y.ios)&&(r.addEventListener("mousedown",this.scrollbar.onDragStart,n),e.addEventListener("mousemove",this.scrollbar.onDragMove,n),e.addEventListener("mouseup",this.scrollbar.onDragEnd,o))):(r.addEventListener(s.start,this.scrollbar.onDragStart,n),e.addEventListener(s.move,this.scrollbar.onDragMove,n),e.addEventListener(s.end,this.scrollbar.onDragEnd,o))}},disableDraggable:function(){if(this.params.scrollbar.el){var t=this.scrollbar,i=this.touchEvents,s=this.touchEventsDesktop,a=this.params,r=t.$el[0],n=!(!h.passiveListener||!a.passiveListener)&&{passive:!1,capture:!1},o=!(!h.passiveListener||!a.passiveListener)&&{passive:!0,capture:!1};h.touch||!h.pointerEvents&&!h.prefixedPointerEvents?(h.touch&&(r.removeEventListener(i.start,this.scrollbar.onDragStart,n),r.removeEventListener(i.move,this.scrollbar.onDragMove,n),r.removeEventListener(i.end,this.scrollbar.onDragEnd,o)),(a.simulateTouch&&!y.ios&&!y.android||a.simulateTouch&&!h.touch&&y.ios)&&(r.removeEventListener("mousedown",this.scrollbar.onDragStart,n),e.removeEventListener("mousemove",this.scrollbar.onDragMove,n),e.removeEventListener("mouseup",this.scrollbar.onDragEnd,o))):(r.removeEventListener(s.start,this.scrollbar.onDragStart,n),e.removeEventListener(s.move,this.scrollbar.onDragMove,n),e.removeEventListener(s.end,this.scrollbar.onDragEnd,o))}},init:function(){if(this.params.scrollbar.el){var e=this.scrollbar,t=this.$el,i=this.params.scrollbar,a=s(i.el);this.params.uniqueNavElements&&"string"==typeof i.el&&a.length>1&&1===t.find(i.el).length&&(a=t.find(i.el));var r=a.find("."+this.params.scrollbar.dragClass);0===r.length&&(r=s('<div class="'+this.params.scrollbar.dragClass+'"></div>'),a.append(r)),d.extend(e,{$el:a,el:a[0],$dragEl:r,dragEl:r[0]}),i.draggable&&e.enableDraggable()}},destroy:function(){this.scrollbar.disableDraggable()}},R={setTransform:function(e,t){var i=this.rtl,a=s(e),r=i?-1:1,n=a.attr("data-swiper-parallax")||"0",o=a.attr("data-swiper-parallax-x"),l=a.attr("data-swiper-parallax-y"),d=a.attr("data-swiper-parallax-scale"),h=a.attr("data-swiper-parallax-opacity");if(o||l?(o=o||"0",l=l||"0"):this.isHorizontal()?(o=n,l="0"):(l=n,o="0"),o=o.indexOf("%")>=0?parseInt(o,10)*t*r+"%":o*t*r+"px",l=l.indexOf("%")>=0?parseInt(l,10)*t+"%":l*t+"px",void 0!==h&&null!==h){var p=h-(h-1)*(1-Math.abs(t));a[0].style.opacity=p}if(void 0===d||null===d)a.transform("translate3d("+o+", "+l+", 0px)");else{var c=d-(d-1)*(1-Math.abs(t));a.transform("translate3d("+o+", "+l+", 0px) scale("+c+")")}},setTranslate:function(){var e=this,t=e.$el,i=e.slides,a=e.progress,r=e.snapGrid;t.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){e.parallax.setTransform(i,a)}),i.each(function(t,i){var n=i.progress;e.params.slidesPerGroup>1&&"auto"!==e.params.slidesPerView&&(n+=Math.ceil(t/2)-a*(r.length-1)),n=Math.min(Math.max(n,-1),1),s(i).find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){e.parallax.setTransform(i,n)})})},setTransition:function(e){void 0===e&&(e=this.params.speed);this.$el.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){var a=s(i),r=parseInt(a.attr("data-swiper-parallax-duration"),10)||e;0===e&&(r=0),a.transition(r)})}},F={getDistanceBetweenTouches:function(e){if(e.targetTouches.length<2)return 1;var t=e.targetTouches[0].pageX,i=e.targetTouches[0].pageY,s=e.targetTouches[1].pageX,a=e.targetTouches[1].pageY;return Math.sqrt(Math.pow(s-t,2)+Math.pow(a-i,2))},onGestureStart:function(e){var t=this.params.zoom,i=this.zoom,a=i.gesture;if(i.fakeGestureTouched=!1,i.fakeGestureMoved=!1,!h.gestures){if("touchstart"!==e.type||"touchstart"===e.type&&e.targetTouches.length<2)return;i.fakeGestureTouched=!0,a.scaleStart=F.getDistanceBetweenTouches(e)}a.$slideEl&&a.$slideEl.length||(a.$slideEl=s(e.target).closest(".swiper-slide"),0===a.$slideEl.length&&(a.$slideEl=this.slides.eq(this.activeIndex)),a.$imageEl=a.$slideEl.find("img, svg, canvas"),a.$imageWrapEl=a.$imageEl.parent("."+t.containerClass),a.maxRatio=a.$imageWrapEl.attr("data-swiper-zoom")||t.maxRatio,0!==a.$imageWrapEl.length)?(a.$imageEl.transition(0),this.zoom.isScaling=!0):a.$imageEl=void 0},onGestureChange:function(e){var t=this.params.zoom,i=this.zoom,s=i.gesture;if(!h.gestures){if("touchmove"!==e.type||"touchmove"===e.type&&e.targetTouches.length<2)return;i.fakeGestureMoved=!0,s.scaleMove=F.getDistanceBetweenTouches(e)}s.$imageEl&&0!==s.$imageEl.length&&(h.gestures?this.zoom.scale=e.scale*i.currentScale:i.scale=s.scaleMove/s.scaleStart*i.currentScale,i.scale>s.maxRatio&&(i.scale=s.maxRatio-1+Math.pow(i.scale-s.maxRatio+1,.5)),i.scale<t.minRatio&&(i.scale=t.minRatio+1-Math.pow(t.minRatio-i.scale+1,.5)),s.$imageEl.transform("translate3d(0,0,0) scale("+i.scale+")"))},onGestureEnd:function(e){var t=this.params.zoom,i=this.zoom,s=i.gesture;if(!h.gestures){if(!i.fakeGestureTouched||!i.fakeGestureMoved)return;if("touchend"!==e.type||"touchend"===e.type&&e.changedTouches.length<2&&!y.android)return;i.fakeGestureTouched=!1,i.fakeGestureMoved=!1}s.$imageEl&&0!==s.$imageEl.length&&(i.scale=Math.max(Math.min(i.scale,s.maxRatio),t.minRatio),s.$imageEl.transition(this.params.speed).transform("translate3d(0,0,0) scale("+i.scale+")"),i.currentScale=i.scale,i.isScaling=!1,1===i.scale&&(s.$slideEl=void 0))},onTouchStart:function(e){var t=this.zoom,i=t.gesture,s=t.image;i.$imageEl&&0!==i.$imageEl.length&&(s.isTouched||(y.android&&e.preventDefault(),s.isTouched=!0,s.touchesStart.x="touchstart"===e.type?e.targetTouches[0].pageX:e.pageX,s.touchesStart.y="touchstart"===e.type?e.targetTouches[0].pageY:e.pageY))},onTouchMove:function(e){var t=this.zoom,i=t.gesture,s=t.image,a=t.velocity;if(i.$imageEl&&0!==i.$imageEl.length&&(this.allowClick=!1,s.isTouched&&i.$slideEl)){s.isMoved||(s.width=i.$imageEl[0].offsetWidth,s.height=i.$imageEl[0].offsetHeight,s.startX=d.getTranslate(i.$imageWrapEl[0],"x")||0,s.startY=d.getTranslate(i.$imageWrapEl[0],"y")||0,i.slideWidth=i.$slideEl[0].offsetWidth,i.slideHeight=i.$slideEl[0].offsetHeight,i.$imageWrapEl.transition(0),this.rtl&&(s.startX=-s.startX,s.startY=-s.startY));var r=s.width*t.scale,n=s.height*t.scale;if(!(r<i.slideWidth&&n<i.slideHeight)){if(s.minX=Math.min(i.slideWidth/2-r/2,0),s.maxX=-s.minX,s.minY=Math.min(i.slideHeight/2-n/2,0),s.maxY=-s.minY,s.touchesCurrent.x="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,s.touchesCurrent.y="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,!s.isMoved&&!t.isScaling){if(this.isHorizontal()&&(Math.floor(s.minX)===Math.floor(s.startX)&&s.touchesCurrent.x<s.touchesStart.x||Math.floor(s.maxX)===Math.floor(s.startX)&&s.touchesCurrent.x>s.touchesStart.x))return void(s.isTouched=!1);if(!this.isHorizontal()&&(Math.floor(s.minY)===Math.floor(s.startY)&&s.touchesCurrent.y<s.touchesStart.y||Math.floor(s.maxY)===Math.floor(s.startY)&&s.touchesCurrent.y>s.touchesStart.y))return void(s.isTouched=!1)}e.preventDefault(),e.stopPropagation(),s.isMoved=!0,s.currentX=s.touchesCurrent.x-s.touchesStart.x+s.startX,s.currentY=s.touchesCurrent.y-s.touchesStart.y+s.startY,s.currentX<s.minX&&(s.currentX=s.minX+1-Math.pow(s.minX-s.currentX+1,.8)),s.currentX>s.maxX&&(s.currentX=s.maxX-1+Math.pow(s.currentX-s.maxX+1,.8)),s.currentY<s.minY&&(s.currentY=s.minY+1-Math.pow(s.minY-s.currentY+1,.8)),s.currentY>s.maxY&&(s.currentY=s.maxY-1+Math.pow(s.currentY-s.maxY+1,.8)),a.prevPositionX||(a.prevPositionX=s.touchesCurrent.x),a.prevPositionY||(a.prevPositionY=s.touchesCurrent.y),a.prevTime||(a.prevTime=Date.now()),a.x=(s.touchesCurrent.x-a.prevPositionX)/(Date.now()-a.prevTime)/2,a.y=(s.touchesCurrent.y-a.prevPositionY)/(Date.now()-a.prevTime)/2,Math.abs(s.touchesCurrent.x-a.prevPositionX)<2&&(a.x=0),Math.abs(s.touchesCurrent.y-a.prevPositionY)<2&&(a.y=0),a.prevPositionX=s.touchesCurrent.x,a.prevPositionY=s.touchesCurrent.y,a.prevTime=Date.now(),i.$imageWrapEl.transform("translate3d("+s.currentX+"px, "+s.currentY+"px,0)")}}},onTouchEnd:function(){var e=this.zoom,t=e.gesture,i=e.image,s=e.velocity;if(t.$imageEl&&0!==t.$imageEl.length){if(!i.isTouched||!i.isMoved)return i.isTouched=!1,void(i.isMoved=!1);i.isTouched=!1,i.isMoved=!1;var a=300,r=300,n=s.x*a,o=i.currentX+n,l=s.y*r,d=i.currentY+l;0!==s.x&&(a=Math.abs((o-i.currentX)/s.x)),0!==s.y&&(r=Math.abs((d-i.currentY)/s.y));var h=Math.max(a,r);i.currentX=o,i.currentY=d;var p=i.width*e.scale,c=i.height*e.scale;i.minX=Math.min(t.slideWidth/2-p/2,0),i.maxX=-i.minX,i.minY=Math.min(t.slideHeight/2-c/2,0),i.maxY=-i.minY,i.currentX=Math.max(Math.min(i.currentX,i.maxX),i.minX),i.currentY=Math.max(Math.min(i.currentY,i.maxY),i.minY),t.$imageWrapEl.transition(h).transform("translate3d("+i.currentX+"px, "+i.currentY+"px,0)")}},onTransitionEnd:function(){var e=this.zoom,t=e.gesture;t.$slideEl&&this.previousIndex!==this.activeIndex&&(t.$imageEl.transform("translate3d(0,0,0) scale(1)"),t.$imageWrapEl.transform("translate3d(0,0,0)"),t.$slideEl=void 0,t.$imageEl=void 0,t.$imageWrapEl=void 0,e.scale=1,e.currentScale=1)},toggle:function(e){var t=this.zoom;t.scale&&1!==t.scale?t.out():t.in(e)},in:function(e){var t,i,a,r,n,o,l,d,h,p,c,u,v,f,m,g,b=this.zoom,w=this.params.zoom,y=b.gesture,x=b.image;(y.$slideEl||(y.$slideEl=this.clickedSlide?s(this.clickedSlide):this.slides.eq(this.activeIndex),y.$imageEl=y.$slideEl.find("img, svg, canvas"),y.$imageWrapEl=y.$imageEl.parent("."+w.containerClass)),y.$imageEl&&0!==y.$imageEl.length)&&(y.$slideEl.addClass(""+w.zoomedSlideClass),void 0===x.touchesStart.x&&e?(t="touchend"===e.type?e.changedTouches[0].pageX:e.pageX,i="touchend"===e.type?e.changedTouches[0].pageY:e.pageY):(t=x.touchesStart.x,i=x.touchesStart.y),b.scale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,b.currentScale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,e?(m=y.$slideEl[0].offsetWidth,g=y.$slideEl[0].offsetHeight,a=y.$slideEl.offset().left+m/2-t,r=y.$slideEl.offset().top+g/2-i,l=y.$imageEl[0].offsetWidth,d=y.$imageEl[0].offsetHeight,h=l*b.scale,p=d*b.scale,v=-(c=Math.min(m/2-h/2,0)),f=-(u=Math.min(g/2-p/2,0)),n=a*b.scale,o=r*b.scale,n<c&&(n=c),n>v&&(n=v),o<u&&(o=u),o>f&&(o=f)):(n=0,o=0),y.$imageWrapEl.transition(300).transform("translate3d("+n+"px, "+o+"px,0)"),y.$imageEl.transition(300).transform("translate3d(0,0,0) scale("+b.scale+")"))},out:function(){var e=this.zoom,t=this.params.zoom,i=e.gesture;i.$slideEl||(i.$slideEl=this.clickedSlide?s(this.clickedSlide):this.slides.eq(this.activeIndex),i.$imageEl=i.$slideEl.find("img, svg, canvas"),i.$imageWrapEl=i.$imageEl.parent("."+t.containerClass)),i.$imageEl&&0!==i.$imageEl.length&&(e.scale=1,e.currentScale=1,i.$imageWrapEl.transition(300).transform("translate3d(0,0,0)"),i.$imageEl.transition(300).transform("translate3d(0,0,0) scale(1)"),i.$slideEl.removeClass(""+t.zoomedSlideClass),i.$slideEl=void 0)},enable:function(){var e=this.zoom;if(!e.enabled){e.enabled=!0;var t=!("touchstart"!==this.touchEvents.start||!h.passiveListener||!this.params.passiveListeners)&&{passive:!0,capture:!1};h.gestures?(this.$wrapperEl.on("gesturestart",".swiper-slide",e.onGestureStart,t),this.$wrapperEl.on("gesturechange",".swiper-slide",e.onGestureChange,t),this.$wrapperEl.on("gestureend",".swiper-slide",e.onGestureEnd,t)):"touchstart"===this.touchEvents.start&&(this.$wrapperEl.on(this.touchEvents.start,".swiper-slide",e.onGestureStart,t),this.$wrapperEl.on(this.touchEvents.move,".swiper-slide",e.onGestureChange,t),this.$wrapperEl.on(this.touchEvents.end,".swiper-slide",e.onGestureEnd,t)),this.$wrapperEl.on(this.touchEvents.move,"."+this.params.zoom.containerClass,e.onTouchMove)}},disable:function(){var e=this.zoom;if(e.enabled){this.zoom.enabled=!1;var t=!("touchstart"!==this.touchEvents.start||!h.passiveListener||!this.params.passiveListeners)&&{passive:!0,capture:!1};h.gestures?(this.$wrapperEl.off("gesturestart",".swiper-slide",e.onGestureStart,t),this.$wrapperEl.off("gesturechange",".swiper-slide",e.onGestureChange,t),this.$wrapperEl.off("gestureend",".swiper-slide",e.onGestureEnd,t)):"touchstart"===this.touchEvents.start&&(this.$wrapperEl.off(this.touchEvents.start,".swiper-slide",e.onGestureStart,t),this.$wrapperEl.off(this.touchEvents.move,".swiper-slide",e.onGestureChange,t),this.$wrapperEl.off(this.touchEvents.end,".swiper-slide",e.onGestureEnd,t)),this.$wrapperEl.off(this.touchEvents.move,"."+this.params.zoom.containerClass,e.onTouchMove)}}},W={loadInSlide:function(e,t){void 0===t&&(t=!0);var i=this,a=i.params.lazy;if(void 0!==e&&0!==i.slides.length){var r=i.virtual&&i.params.virtual.enabled?i.$wrapperEl.children("."+i.params.slideClass+'[data-swiper-slide-index="'+e+'"]'):i.slides.eq(e),n=r.find("."+a.elementClass+":not(."+a.loadedClass+"):not(."+a.loadingClass+")");!r.hasClass(a.elementClass)||r.hasClass(a.loadedClass)||r.hasClass(a.loadingClass)||(n=n.add(r[0])),0!==n.length&&n.each(function(e,n){var o=s(n);o.addClass(a.loadingClass);var l=o.attr("data-background"),d=o.attr("data-src"),h=o.attr("data-srcset"),p=o.attr("data-sizes");i.loadImage(o[0],d||l,h,p,!1,function(){if(void 0!==i&&null!==i&&i&&(!i||i.params)&&!i.destroyed){if(l?(o.css("background-image",'url("'+l+'")'),o.removeAttr("data-background")):(h&&(o.attr("srcset",h),o.removeAttr("data-srcset")),p&&(o.attr("sizes",p),o.removeAttr("data-sizes")),d&&(o.attr("src",d),o.removeAttr("data-src"))),o.addClass(a.loadedClass).removeClass(a.loadingClass),r.find("."+a.preloaderClass).remove(),i.params.loop&&t){var e=r.attr("data-swiper-slide-index");if(r.hasClass(i.params.slideDuplicateClass)){var s=i.$wrapperEl.children('[data-swiper-slide-index="'+e+'"]:not(.'+i.params.slideDuplicateClass+")");i.lazy.loadInSlide(s.index(),!1)}else{var n=i.$wrapperEl.children("."+i.params.slideDuplicateClass+'[data-swiper-slide-index="'+e+'"]');i.lazy.loadInSlide(n.index(),!1)}}i.emit("lazyImageReady",r[0],o[0])}}),i.emit("lazyImageLoad",r[0],o[0])})}},load:function(){var e=this,t=e.$wrapperEl,i=e.params,a=e.slides,r=e.activeIndex,n=e.virtual&&i.virtual.enabled,o=i.lazy,l=i.slidesPerView;function d(e){if(n){if(t.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]').length)return!0}else if(a[e])return!0;return!1}function h(e){return n?s(e).attr("data-swiper-slide-index"):s(e).index()}if("auto"===l&&(l=0),e.lazy.initialImageLoaded||(e.lazy.initialImageLoaded=!0),e.params.watchSlidesVisibility)t.children("."+i.slideVisibleClass).each(function(t,i){var a=n?s(i).attr("data-swiper-slide-index"):s(i).index();e.lazy.loadInSlide(a)});else if(l>1)for(var p=r;p<r+l;p+=1)d(p)&&e.lazy.loadInSlide(p);else e.lazy.loadInSlide(r);if(o.loadPrevNext)if(l>1||o.loadPrevNextAmount&&o.loadPrevNextAmount>1){for(var c=o.loadPrevNextAmount,u=l,v=Math.min(r+u+Math.max(c,u),a.length),f=Math.max(r-Math.max(u,c),0),m=r+l;m<v;m+=1)d(m)&&e.lazy.loadInSlide(m);for(var g=f;g<r;g+=1)d(g)&&e.lazy.loadInSlide(g)}else{var b=t.children("."+i.slideNextClass);b.length>0&&e.lazy.loadInSlide(h(b));var w=t.children("."+i.slidePrevClass);w.length>0&&e.lazy.loadInSlide(h(w))}}},q={LinearSpline:function(e,t){var i,s,a,r,n,o=function(e,t){for(s=-1,i=e.length;i-s>1;)e[a=i+s>>1]<=t?s=a:i=a;return i};return this.x=e,this.y=t,this.lastIndex=e.length-1,this.interpolate=function(e){return e?(n=o(this.x,e),r=n-1,(e-this.x[r])*(this.y[n]-this.y[r])/(this.x[n]-this.x[r])+this.y[r]):0},this},getInterpolateFunction:function(e){this.controller.spline||(this.controller.spline=this.params.loop?new q.LinearSpline(this.slidesGrid,e.slidesGrid):new q.LinearSpline(this.snapGrid,e.snapGrid))},setTranslate:function(e,t){var i,s,a=this,r=a.controller.control;function n(e){var t=a.rtlTranslate?-a.translate:a.translate;"slide"===a.params.controller.by&&(a.controller.getInterpolateFunction(e),s=-a.controller.spline.interpolate(-t)),s&&"container"!==a.params.controller.by||(i=(e.maxTranslate()-e.minTranslate())/(a.maxTranslate()-a.minTranslate()),s=(t-a.minTranslate())*i+e.minTranslate()),a.params.controller.inverse&&(s=e.maxTranslate()-s),e.updateProgress(s),e.setTranslate(s,a),e.updateActiveIndex(),e.updateSlidesClasses()}if(Array.isArray(r))for(var o=0;o<r.length;o+=1)r[o]!==t&&r[o]instanceof P&&n(r[o]);else r instanceof P&&t!==r&&n(r)},setTransition:function(e,t){var i,s=this,a=s.controller.control;function r(t){t.setTransition(e,s),0!==e&&(t.transitionStart(),t.$wrapperEl.transitionEnd(function(){a&&(t.params.loop&&"slide"===s.params.controller.by&&t.loopFix(),t.transitionEnd())}))}if(Array.isArray(a))for(i=0;i<a.length;i+=1)a[i]!==t&&a[i]instanceof P&&r(a[i]);else a instanceof P&&t!==a&&r(a)}},j={makeElFocusable:function(e){return e.attr("tabIndex","0"),e},addElRole:function(e,t){return e.attr("role",t),e},addElLabel:function(e,t){return e.attr("aria-label",t),e},disableEl:function(e){return e.attr("aria-disabled",!0),e},enableEl:function(e){return e.attr("aria-disabled",!1),e},onEnterKey:function(e){var t=this.params.a11y;if(13===e.keyCode){var i=s(e.target);this.navigation&&this.navigation.$nextEl&&i.is(this.navigation.$nextEl)&&(this.isEnd&&!this.params.loop||this.slideNext(),this.isEnd?this.a11y.notify(t.lastSlideMessage):this.a11y.notify(t.nextSlideMessage)),this.navigation&&this.navigation.$prevEl&&i.is(this.navigation.$prevEl)&&(this.isBeginning&&!this.params.loop||this.slidePrev(),this.isBeginning?this.a11y.notify(t.firstSlideMessage):this.a11y.notify(t.prevSlideMessage)),this.pagination&&i.is("."+this.params.pagination.bulletClass)&&i[0].click()}},notify:function(e){var t=this.a11y.liveRegion;0!==t.length&&(t.html(""),t.html(e))},updateNavigation:function(){if(!this.params.loop){var e=this.navigation,t=e.$nextEl,i=e.$prevEl;i&&i.length>0&&(this.isBeginning?this.a11y.disableEl(i):this.a11y.enableEl(i)),t&&t.length>0&&(this.isEnd?this.a11y.disableEl(t):this.a11y.enableEl(t))}},updatePagination:function(){var e=this,t=e.params.a11y;e.pagination&&e.params.pagination.clickable&&e.pagination.bullets&&e.pagination.bullets.length&&e.pagination.bullets.each(function(i,a){var r=s(a);e.a11y.makeElFocusable(r),e.a11y.addElRole(r,"button"),e.a11y.addElLabel(r,t.paginationBulletMessage.replace(/{{index}}/,r.index()+1))})},init:function(){this.$el.append(this.a11y.liveRegion);var e,t,i=this.params.a11y;this.navigation&&this.navigation.$nextEl&&(e=this.navigation.$nextEl),this.navigation&&this.navigation.$prevEl&&(t=this.navigation.$prevEl),e&&(this.a11y.makeElFocusable(e),this.a11y.addElRole(e,"button"),this.a11y.addElLabel(e,i.nextSlideMessage),e.on("keydown",this.a11y.onEnterKey)),t&&(this.a11y.makeElFocusable(t),this.a11y.addElRole(t,"button"),this.a11y.addElLabel(t,i.prevSlideMessage),t.on("keydown",this.a11y.onEnterKey)),this.pagination&&this.params.pagination.clickable&&this.pagination.bullets&&this.pagination.bullets.length&&this.pagination.$el.on("keydown","."+this.params.pagination.bulletClass,this.a11y.onEnterKey)},destroy:function(){var e,t;this.a11y.liveRegion&&this.a11y.liveRegion.length>0&&this.a11y.liveRegion.remove(),this.navigation&&this.navigation.$nextEl&&(e=this.navigation.$nextEl),this.navigation&&this.navigation.$prevEl&&(t=this.navigation.$prevEl),e&&e.off("keydown",this.a11y.onEnterKey),t&&t.off("keydown",this.a11y.onEnterKey),this.pagination&&this.params.pagination.clickable&&this.pagination.bullets&&this.pagination.bullets.length&&this.pagination.$el.off("keydown","."+this.params.pagination.bulletClass,this.a11y.onEnterKey)}},K={init:function(){if(this.params.history){if(!t.history||!t.history.pushState)return this.params.history.enabled=!1,void(this.params.hashNavigation.enabled=!0);var e=this.history;e.initialized=!0,e.paths=K.getPathValues(),(e.paths.key||e.paths.value)&&(e.scrollToSlide(0,e.paths.value,this.params.runCallbacksOnInit),this.params.history.replaceState||t.addEventListener("popstate",this.history.setHistoryPopState))}},destroy:function(){this.params.history.replaceState||t.removeEventListener("popstate",this.history.setHistoryPopState)},setHistoryPopState:function(){this.history.paths=K.getPathValues(),this.history.scrollToSlide(this.params.speed,this.history.paths.value,!1)},getPathValues:function(){var e=t.location.pathname.slice(1).split("/").filter(function(e){return""!==e}),i=e.length;return{key:e[i-2],value:e[i-1]}},setHistory:function(e,i){if(this.history.initialized&&this.params.history.enabled){var s=this.slides.eq(i),a=K.slugify(s.attr("data-history"));t.location.pathname.includes(e)||(a=e+"/"+a);var r=t.history.state;r&&r.value===a||(this.params.history.replaceState?t.history.replaceState({value:a},null,a):t.history.pushState({value:a},null,a))}},slugify:function(e){return e.toString().toLowerCase().replace(/\s+/g,"-").replace(/[^\w-]+/g,"").replace(/--+/g,"-").replace(/^-+/,"").replace(/-+$/,"")},scrollToSlide:function(e,t,i){if(t)for(var s=0,a=this.slides.length;s<a;s+=1){var r=this.slides.eq(s);if(K.slugify(r.attr("data-history"))===t&&!r.hasClass(this.params.slideDuplicateClass)){var n=r.index();this.slideTo(n,e,i)}}else this.slideTo(0,e,i)}},U={onHashCange:function(){var t=e.location.hash.replace("#","");t!==this.slides.eq(this.activeIndex).attr("data-hash")&&this.slideTo(this.$wrapperEl.children("."+this.params.slideClass+'[data-hash="'+t+'"]').index())},setHash:function(){if(this.hashNavigation.initialized&&this.params.hashNavigation.enabled)if(this.params.hashNavigation.replaceState&&t.history&&t.history.replaceState)t.history.replaceState(null,null,"#"+this.slides.eq(this.activeIndex).attr("data-hash")||"");else{var i=this.slides.eq(this.activeIndex),s=i.attr("data-hash")||i.attr("data-history");e.location.hash=s||""}},init:function(){if(!(!this.params.hashNavigation.enabled||this.params.history&&this.params.history.enabled)){this.hashNavigation.initialized=!0;var i=e.location.hash.replace("#","");if(i)for(var a=0,r=this.slides.length;a<r;a+=1){var n=this.slides.eq(a);if((n.attr("data-hash")||n.attr("data-history"))===i&&!n.hasClass(this.params.slideDuplicateClass)){var o=n.index();this.slideTo(o,0,this.params.runCallbacksOnInit,!0)}}this.params.hashNavigation.watchState&&s(t).on("hashchange",this.hashNavigation.onHashCange)}},destroy:function(){this.params.hashNavigation.watchState&&s(t).off("hashchange",this.hashNavigation.onHashCange)}},_={run:function(){var e=this,t=e.slides.eq(e.activeIndex),i=e.params.autoplay.delay;t.attr("data-swiper-autoplay")&&(i=t.attr("data-swiper-autoplay")||e.params.autoplay.delay),e.autoplay.timeout=d.nextTick(function(){e.params.autoplay.reverseDirection?e.params.loop?(e.loopFix(),e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.isBeginning?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(e.slides.length-1,e.params.speed,!0,!0),e.emit("autoplay")):(e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.params.loop?(e.loopFix(),e.slideNext(e.params.speed,!0,!0),e.emit("autoplay")):e.isEnd?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(0,e.params.speed,!0,!0),e.emit("autoplay")):(e.slideNext(e.params.speed,!0,!0),e.emit("autoplay"))},i)},start:function(){return void 0===this.autoplay.timeout&&(!this.autoplay.running&&(this.autoplay.running=!0,this.emit("autoplayStart"),this.autoplay.run(),!0))},stop:function(){return!!this.autoplay.running&&(void 0!==this.autoplay.timeout&&(this.autoplay.timeout&&(clearTimeout(this.autoplay.timeout),this.autoplay.timeout=void 0),this.autoplay.running=!1,this.emit("autoplayStop"),!0))},pause:function(e){var t=this;t.autoplay.running&&(t.autoplay.paused||(t.autoplay.timeout&&clearTimeout(t.autoplay.timeout),t.autoplay.paused=!0,0!==e&&t.params.autoplay.waitForTransition?t.$wrapperEl.transitionEnd(function(){t&&!t.destroyed&&(t.autoplay.paused=!1,t.autoplay.running?t.autoplay.run():t.autoplay.stop())}):(t.autoplay.paused=!1,t.autoplay.run())))}},Z={setTranslate:function(){for(var e=this.slides,t=0;t<e.length;t+=1){var i=this.slides.eq(t),s=-i[0].swiperSlideOffset;this.params.virtualTranslate||(s-=this.translate);var a=0;this.isHorizontal()||(a=s,s=0);var r=this.params.fadeEffect.crossFade?Math.max(1-Math.abs(i[0].progress),0):1+Math.min(Math.max(i[0].progress,-1),0);i.css({opacity:r}).transform("translate3d("+s+"px, "+a+"px, 0px)")}},setTransition:function(e){var t=this,i=t.slides,s=t.$wrapperEl;if(i.transition(e),t.params.virtualTranslate&&0!==e){var a=!1;i.transitionEnd(function(){if(!a&&t&&!t.destroyed){a=!0,t.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],i=0;i<e.length;i+=1)s.trigger(e[i])}})}}},Q={setTranslate:function(){var e,t=this.$el,i=this.$wrapperEl,a=this.slides,r=this.width,n=this.height,o=this.rtlTranslate,l=this.size,d=this.params.cubeEffect,h=this.isHorizontal(),p=this.virtual&&this.params.virtual.enabled,c=0;d.shadow&&(h?(0===(e=i.find(".swiper-cube-shadow")).length&&(e=s('<div class="swiper-cube-shadow"></div>'),i.append(e)),e.css({height:r+"px"})):0===(e=t.find(".swiper-cube-shadow")).length&&(e=s('<div class="swiper-cube-shadow"></div>'),t.append(e)));for(var u=0;u<a.length;u+=1){var v=a.eq(u),f=u;p&&(f=parseInt(v.attr("data-swiper-slide-index"),10));var m=90*f,g=Math.floor(m/360);o&&(m=-m,g=Math.floor(-m/360));var b=Math.max(Math.min(v[0].progress,1),-1),w=0,y=0,x=0;f%4==0?(w=4*-g*l,x=0):(f-1)%4==0?(w=0,x=4*-g*l):(f-2)%4==0?(w=l+4*g*l,x=l):(f-3)%4==0&&(w=-l,x=3*l+4*l*g),o&&(w=-w),h||(y=w,w=0);var E="rotateX("+(h?0:-m)+"deg) rotateY("+(h?m:0)+"deg) translate3d("+w+"px, "+y+"px, "+x+"px)";if(b<=1&&b>-1&&(c=90*f+90*b,o&&(c=90*-f-90*b)),v.transform(E),d.slideShadows){var T=h?v.find(".swiper-slide-shadow-left"):v.find(".swiper-slide-shadow-top"),C=h?v.find(".swiper-slide-shadow-right"):v.find(".swiper-slide-shadow-bottom");0===T.length&&(T=s('<div class="swiper-slide-shadow-'+(h?"left":"top")+'"></div>'),v.append(T)),0===C.length&&(C=s('<div class="swiper-slide-shadow-'+(h?"right":"bottom")+'"></div>'),v.append(C)),T.length&&(T[0].style.opacity=Math.max(-b,0)),C.length&&(C[0].style.opacity=Math.max(b,0))}}if(i.css({"-webkit-transform-origin":"50% 50% -"+l/2+"px","-moz-transform-origin":"50% 50% -"+l/2+"px","-ms-transform-origin":"50% 50% -"+l/2+"px","transform-origin":"50% 50% -"+l/2+"px"}),d.shadow)if(h)e.transform("translate3d(0px, "+(r/2+d.shadowOffset)+"px, "+-r/2+"px) rotateX(90deg) rotateZ(0deg) scale("+d.shadowScale+")");else{var M=Math.abs(c)-90*Math.floor(Math.abs(c)/90),z=1.5-(Math.sin(2*M*Math.PI/360)/2+Math.cos(2*M*Math.PI/360)/2),P=d.shadowScale,k=d.shadowScale/z,$=d.shadowOffset;e.transform("scale3d("+P+", 1, "+k+") translate3d(0px, "+(n/2+$)+"px, "+-n/2/k+"px) rotateX(-90deg)")}var L=S.isSafari||S.isUiWebView?-l/2:0;i.transform("translate3d(0px,0,"+L+"px) rotateX("+(this.isHorizontal()?0:c)+"deg) rotateY("+(this.isHorizontal()?-c:0)+"deg)")},setTransition:function(e){var t=this.$el;this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),this.params.cubeEffect.shadow&&!this.isHorizontal()&&t.find(".swiper-cube-shadow").transition(e)}},J={setTranslate:function(){for(var e=this.slides,t=this.rtlTranslate,i=0;i<e.length;i+=1){var a=e.eq(i),r=a[0].progress;this.params.flipEffect.limitRotation&&(r=Math.max(Math.min(a[0].progress,1),-1));var n=-180*r,o=0,l=-a[0].swiperSlideOffset,d=0;if(this.isHorizontal()?t&&(n=-n):(d=l,l=0,o=-n,n=0),a[0].style.zIndex=-Math.abs(Math.round(r))+e.length,this.params.flipEffect.slideShadows){var h=this.isHorizontal()?a.find(".swiper-slide-shadow-left"):a.find(".swiper-slide-shadow-top"),p=this.isHorizontal()?a.find(".swiper-slide-shadow-right"):a.find(".swiper-slide-shadow-bottom");0===h.length&&(h=s('<div class="swiper-slide-shadow-'+(this.isHorizontal()?"left":"top")+'"></div>'),a.append(h)),0===p.length&&(p=s('<div class="swiper-slide-shadow-'+(this.isHorizontal()?"right":"bottom")+'"></div>'),a.append(p)),h.length&&(h[0].style.opacity=Math.max(-r,0)),p.length&&(p[0].style.opacity=Math.max(r,0))}a.transform("translate3d("+l+"px, "+d+"px, 0px) rotateX("+o+"deg) rotateY("+n+"deg)")}},setTransition:function(e){var t=this,i=t.slides,s=t.activeIndex,a=t.$wrapperEl;if(i.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),t.params.virtualTranslate&&0!==e){var r=!1;i.eq(s).transitionEnd(function(){if(!r&&t&&!t.destroyed){r=!0,t.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],i=0;i<e.length;i+=1)a.trigger(e[i])}})}}},ee={setTranslate:function(){for(var e=this.width,t=this.height,i=this.slides,a=this.$wrapperEl,r=this.slidesSizesGrid,n=this.params.coverflowEffect,o=this.isHorizontal(),l=this.translate,d=o?e/2-l:t/2-l,p=o?n.rotate:-n.rotate,c=n.depth,u=0,v=i.length;u<v;u+=1){var f=i.eq(u),m=r[u],g=(d-f[0].swiperSlideOffset-m/2)/m*n.modifier,b=o?p*g:0,w=o?0:p*g,y=-c*Math.abs(g),x=o?0:n.stretch*g,E=o?n.stretch*g:0;Math.abs(E)<.001&&(E=0),Math.abs(x)<.001&&(x=0),Math.abs(y)<.001&&(y=0),Math.abs(b)<.001&&(b=0),Math.abs(w)<.001&&(w=0);var T="translate3d("+E+"px,"+x+"px,"+y+"px)  rotateX("+w+"deg) rotateY("+b+"deg)";if(f.transform(T),f[0].style.zIndex=1-Math.abs(Math.round(g)),n.slideShadows){var S=o?f.find(".swiper-slide-shadow-left"):f.find(".swiper-slide-shadow-top"),C=o?f.find(".swiper-slide-shadow-right"):f.find(".swiper-slide-shadow-bottom");0===S.length&&(S=s('<div class="swiper-slide-shadow-'+(o?"left":"top")+'"></div>'),f.append(S)),0===C.length&&(C=s('<div class="swiper-slide-shadow-'+(o?"right":"bottom")+'"></div>'),f.append(C)),S.length&&(S[0].style.opacity=g>0?g:0),C.length&&(C[0].style.opacity=-g>0?-g:0)}}(h.pointerEvents||h.prefixedPointerEvents)&&(a[0].style.perspectiveOrigin=d+"px 50%")},setTransition:function(e){this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)}},te=[k,$,L,I,O,H,B,{name:"mousewheel",params:{mousewheel:{enabled:!1,releaseOnEdges:!1,invert:!1,forceToAxis:!1,sensitivity:1,eventsTarged:"container"}},create:function(){d.extend(this,{mousewheel:{enabled:!1,enable:G.enable.bind(this),disable:G.disable.bind(this),handle:G.handle.bind(this),handleMouseEnter:G.handleMouseEnter.bind(this),handleMouseLeave:G.handleMouseLeave.bind(this),lastScrollTime:d.now()}})},on:{init:function(){this.params.mousewheel.enabled&&this.mousewheel.enable()},destroy:function(){this.mousewheel.enabled&&this.mousewheel.disable()}}},{name:"navigation",params:{navigation:{nextEl:null,prevEl:null,hideOnClick:!1,disabledClass:"swiper-button-disabled",hiddenClass:"swiper-button-hidden",lockClass:"swiper-button-lock"}},create:function(){d.extend(this,{navigation:{init:X.init.bind(this),update:X.update.bind(this),destroy:X.destroy.bind(this)}})},on:{init:function(){this.navigation.init(),this.navigation.update()},toEdge:function(){this.navigation.update()},fromEdge:function(){this.navigation.update()},destroy:function(){this.navigation.destroy()},click:function(e){var t=this.navigation,i=t.$nextEl,a=t.$prevEl;!this.params.navigation.hideOnClick||s(e.target).is(a)||s(e.target).is(i)||(i&&i.toggleClass(this.params.navigation.hiddenClass),a&&a.toggleClass(this.params.navigation.hiddenClass))}}},{name:"pagination",params:{pagination:{el:null,bulletElement:"span",clickable:!1,hideOnClick:!1,renderBullet:null,renderProgressbar:null,renderFraction:null,renderCustom:null,type:"bullets",dynamicBullets:!1,dynamicMainBullets:1,bulletClass:"swiper-pagination-bullet",bulletActiveClass:"swiper-pagination-bullet-active",modifierClass:"swiper-pagination-",currentClass:"swiper-pagination-current",totalClass:"swiper-pagination-total",hiddenClass:"swiper-pagination-hidden",progressbarFillClass:"swiper-pagination-progressbar-fill",clickableClass:"swiper-pagination-clickable",lockClass:"swiper-pagination-lock"}},create:function(){d.extend(this,{pagination:{init:Y.init.bind(this),render:Y.render.bind(this),update:Y.update.bind(this),destroy:Y.destroy.bind(this),dynamicBulletIndex:0}})},on:{init:function(){this.pagination.init(),this.pagination.render(),this.pagination.update()},activeIndexChange:function(){this.params.loop?this.pagination.update():void 0===this.snapIndex&&this.pagination.update()},snapIndexChange:function(){this.params.loop||this.pagination.update()},slidesLengthChange:function(){this.params.loop&&(this.pagination.render(),this.pagination.update())},snapGridLengthChange:function(){this.params.loop||(this.pagination.render(),this.pagination.update())},destroy:function(){this.pagination.destroy()},click:function(e){this.params.pagination.el&&this.params.pagination.hideOnClick&&this.pagination.$el.length>0&&!s(e.target).hasClass(this.params.pagination.bulletClass)&&this.pagination.$el.toggleClass(this.params.pagination.hiddenClass)}}},{name:"scrollbar",params:{scrollbar:{el:null,dragSize:"auto",hide:!1,draggable:!1,snapOnRelease:!0,lockClass:"swiper-scrollbar-lock",dragClass:"swiper-scrollbar-drag"}},create:function(){d.extend(this,{scrollbar:{init:V.init.bind(this),destroy:V.destroy.bind(this),updateSize:V.updateSize.bind(this),setTranslate:V.setTranslate.bind(this),setTransition:V.setTransition.bind(this),enableDraggable:V.enableDraggable.bind(this),disableDraggable:V.disableDraggable.bind(this),setDragPosition:V.setDragPosition.bind(this),onDragStart:V.onDragStart.bind(this),onDragMove:V.onDragMove.bind(this),onDragEnd:V.onDragEnd.bind(this),isTouched:!1,timeout:null,dragTimeout:null}})},on:{init:function(){this.scrollbar.init(),this.scrollbar.updateSize(),this.scrollbar.setTranslate()},update:function(){this.scrollbar.updateSize()},resize:function(){this.scrollbar.updateSize()},observerUpdate:function(){this.scrollbar.updateSize()},setTranslate:function(){this.scrollbar.setTranslate()},setTransition:function(e){this.scrollbar.setTransition(e)},destroy:function(){this.scrollbar.destroy()}}},{name:"parallax",params:{parallax:{enabled:!1}},create:function(){d.extend(this,{parallax:{setTransform:R.setTransform.bind(this),setTranslate:R.setTranslate.bind(this),setTransition:R.setTransition.bind(this)}})},on:{beforeInit:function(){this.params.parallax.enabled&&(this.params.watchSlidesProgress=!0)},init:function(){this.params.parallax&&this.parallax.setTranslate()},setTranslate:function(){this.params.parallax&&this.parallax.setTranslate()},setTransition:function(e){this.params.parallax&&this.parallax.setTransition(e)}}},{name:"zoom",params:{zoom:{enabled:!1,maxRatio:3,minRatio:1,toggle:!0,containerClass:"swiper-zoom-container",zoomedSlideClass:"swiper-slide-zoomed"}},create:function(){var e=this,t={enabled:!1,scale:1,currentScale:1,isScaling:!1,gesture:{$slideEl:void 0,slideWidth:void 0,slideHeight:void 0,$imageEl:void 0,$imageWrapEl:void 0,maxRatio:3},image:{isTouched:void 0,isMoved:void 0,currentX:void 0,currentY:void 0,minX:void 0,minY:void 0,maxX:void 0,maxY:void 0,width:void 0,height:void 0,startX:void 0,startY:void 0,touchesStart:{},touchesCurrent:{}},velocity:{x:void 0,y:void 0,prevPositionX:void 0,prevPositionY:void 0,prevTime:void 0}};"onGestureStart onGestureChange onGestureEnd onTouchStart onTouchMove onTouchEnd onTransitionEnd toggle enable disable in out".split(" ").forEach(function(i){t[i]=F[i].bind(e)}),d.extend(e,{zoom:t})},on:{init:function(){this.params.zoom.enabled&&this.zoom.enable()},destroy:function(){this.zoom.disable()},touchStart:function(e){this.zoom.enabled&&this.zoom.onTouchStart(e)},touchEnd:function(e){this.zoom.enabled&&this.zoom.onTouchEnd(e)},doubleTap:function(e){this.params.zoom.enabled&&this.zoom.enabled&&this.params.zoom.toggle&&this.zoom.toggle(e)},transitionEnd:function(){this.zoom.enabled&&this.params.zoom.enabled&&this.zoom.onTransitionEnd()}}},{name:"lazy",params:{lazy:{enabled:!1,loadPrevNext:!1,loadPrevNextAmount:1,loadOnTransitionStart:!1,elementClass:"swiper-lazy",loadingClass:"swiper-lazy-loading",loadedClass:"swiper-lazy-loaded",preloaderClass:"swiper-lazy-preloader"}},create:function(){d.extend(this,{lazy:{initialImageLoaded:!1,load:W.load.bind(this),loadInSlide:W.loadInSlide.bind(this)}})},on:{beforeInit:function(){this.params.lazy.enabled&&this.params.preloadImages&&(this.params.preloadImages=!1)},init:function(){this.params.lazy.enabled&&!this.params.loop&&0===this.params.initialSlide&&this.lazy.load()},scroll:function(){this.params.freeMode&&!this.params.freeModeSticky&&this.lazy.load()},resize:function(){this.params.lazy.enabled&&this.lazy.load()},scrollbarDragMove:function(){this.params.lazy.enabled&&this.lazy.load()},transitionStart:function(){this.params.lazy.enabled&&(this.params.lazy.loadOnTransitionStart||!this.params.lazy.loadOnTransitionStart&&!this.lazy.initialImageLoaded)&&this.lazy.load()},transitionEnd:function(){this.params.lazy.enabled&&!this.params.lazy.loadOnTransitionStart&&this.lazy.load()}}},{name:"controller",params:{controller:{control:void 0,inverse:!1,by:"slide"}},create:function(){d.extend(this,{controller:{control:this.params.controller.control,getInterpolateFunction:q.getInterpolateFunction.bind(this),setTranslate:q.setTranslate.bind(this),setTransition:q.setTransition.bind(this)}})},on:{update:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},resize:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},observerUpdate:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},setTranslate:function(e,t){this.controller.control&&this.controller.setTranslate(e,t)},setTransition:function(e,t){this.controller.control&&this.controller.setTransition(e,t)}}},{name:"a11y",params:{a11y:{enabled:!0,notificationClass:"swiper-notification",prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",paginationBulletMessage:"Go to slide {{index}}"}},create:function(){var e=this;d.extend(e,{a11y:{liveRegion:s('<span class="'+e.params.a11y.notificationClass+'" aria-live="assertive" aria-atomic="true"></span>')}}),Object.keys(j).forEach(function(t){e.a11y[t]=j[t].bind(e)})},on:{init:function(){this.params.a11y.enabled&&(this.a11y.init(),this.a11y.updateNavigation())},toEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},fromEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},paginationUpdate:function(){this.params.a11y.enabled&&this.a11y.updatePagination()},destroy:function(){this.params.a11y.enabled&&this.a11y.destroy()}}},{name:"history",params:{history:{enabled:!1,replaceState:!1,key:"slides"}},create:function(){d.extend(this,{history:{init:K.init.bind(this),setHistory:K.setHistory.bind(this),setHistoryPopState:K.setHistoryPopState.bind(this),scrollToSlide:K.scrollToSlide.bind(this),destroy:K.destroy.bind(this)}})},on:{init:function(){this.params.history.enabled&&this.history.init()},destroy:function(){this.params.history.enabled&&this.history.destroy()},transitionEnd:function(){this.history.initialized&&this.history.setHistory(this.params.history.key,this.activeIndex)}}},{name:"hash-navigation",params:{hashNavigation:{enabled:!1,replaceState:!1,watchState:!1}},create:function(){d.extend(this,{hashNavigation:{initialized:!1,init:U.init.bind(this),destroy:U.destroy.bind(this),setHash:U.setHash.bind(this),onHashCange:U.onHashCange.bind(this)}})},on:{init:function(){this.params.hashNavigation.enabled&&this.hashNavigation.init()},destroy:function(){this.params.hashNavigation.enabled&&this.hashNavigation.destroy()},transitionEnd:function(){this.hashNavigation.initialized&&this.hashNavigation.setHash()}}},{name:"autoplay",params:{autoplay:{enabled:!1,delay:3e3,waitForTransition:!0,disableOnInteraction:!0,stopOnLastSlide:!1,reverseDirection:!1}},create:function(){d.extend(this,{autoplay:{running:!1,paused:!1,run:_.run.bind(this),start:_.start.bind(this),stop:_.stop.bind(this),pause:_.pause.bind(this)}})},on:{init:function(){this.params.autoplay.enabled&&this.autoplay.start()},beforeTransitionStart:function(e,t){this.autoplay.running&&(t||!this.params.autoplay.disableOnInteraction?this.autoplay.pause(e):this.autoplay.stop())},sliderFirstMove:function(){this.autoplay.running&&(this.params.autoplay.disableOnInteraction?this.autoplay.stop():this.autoplay.pause())},destroy:function(){this.autoplay.running&&this.autoplay.stop()}}},{name:"effect-fade",params:{fadeEffect:{crossFade:!1}},create:function(){d.extend(this,{fadeEffect:{setTranslate:Z.setTranslate.bind(this),setTransition:Z.setTransition.bind(this)}})},on:{beforeInit:function(){if("fade"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"fade");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"fade"===this.params.effect&&this.fadeEffect.setTranslate()},setTransition:function(e){"fade"===this.params.effect&&this.fadeEffect.setTransition(e)}}},{name:"effect-cube",params:{cubeEffect:{slideShadows:!0,shadow:!0,shadowOffset:20,shadowScale:.94}},create:function(){d.extend(this,{cubeEffect:{setTranslate:Q.setTranslate.bind(this),setTransition:Q.setTransition.bind(this)}})},on:{beforeInit:function(){if("cube"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"cube"),this.classNames.push(this.params.containerModifierClass+"3d");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,resistanceRatio:0,spaceBetween:0,centeredSlides:!1,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"cube"===this.params.effect&&this.cubeEffect.setTranslate()},setTransition:function(e){"cube"===this.params.effect&&this.cubeEffect.setTransition(e)}}},{name:"effect-flip",params:{flipEffect:{slideShadows:!0,limitRotation:!0}},create:function(){d.extend(this,{flipEffect:{setTranslate:J.setTranslate.bind(this),setTransition:J.setTransition.bind(this)}})},on:{beforeInit:function(){if("flip"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"flip"),this.classNames.push(this.params.containerModifierClass+"3d");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"flip"===this.params.effect&&this.flipEffect.setTranslate()},setTransition:function(e){"flip"===this.params.effect&&this.flipEffect.setTransition(e)}}},{name:"effect-coverflow",params:{coverflowEffect:{rotate:50,stretch:0,depth:100,modifier:1,slideShadows:!0}},create:function(){d.extend(this,{coverflowEffect:{setTranslate:ee.setTranslate.bind(this),setTransition:ee.setTransition.bind(this)}})},on:{beforeInit:function(){"coverflow"===this.params.effect&&(this.classNames.push(this.params.containerModifierClass+"coverflow"),this.classNames.push(this.params.containerModifierClass+"3d"),this.params.watchSlidesProgress=!0,this.originalParams.watchSlidesProgress=!0)},setTranslate:function(){"coverflow"===this.params.effect&&this.coverflowEffect.setTranslate()},setTransition:function(e){"coverflow"===this.params.effect&&this.coverflowEffect.setTransition(e)}}}];return void 0===P.use&&(P.use=P.Class.use,P.installModule=P.Class.installModule),P.use(te),P});
//# sourceMappingURL=swiper.min.js.map

jQuery(document).ready(function() {
    /* morenvy.com 상단메뉴 스크롤 고정, 화살표 올라가기 내려가기 */
	/*
    var msie6 = $.browser == 'msie' && $.browser.version < 7;
    if (!msie6) {
        var top = jQuery('#comment_top').offset().top - parseFloat(jQuery('#comment_top').css('margin-top').replace(/auto/, 0));
        jQuery(window).scroll(function(event) {
            // what the y position of the scroll is
            var y = jQuery(this).scrollTop();

            // whether that's below the form
            if (y >= top) {
                // if so, ad the fixed class
                jQuery('#comment_top').addClass('fixed');
                jQuery('.bt_arrow').fadeIn(500);
            } else {
                // otherwise remove it
                jQuery('#comment_top').removeClass('fixed');
                jQuery('.bt_arrow').fadeOut(500);
            }
        });
    }
	*/

    /* morenvy.com 상단아이콘 */
    function loop() {
        jQuery('.join_text').animate({
                top: '+=4'
            }, 500)
            .animate({
                top: '-=4'
            }, 500)
            .animate({
                top: '+=4'
            }, 500)
            .animate({
                top: '-=4'
            }, 500, function() {
                loop();
            });
    }
    loop();

    function loopa() {
        jQuery('.join_text1').animate({
                top: '+=4'
            }, 500)
            .animate({
                top: '-=4'
            }, 500)
            .animate({
                top: '+=4'
            }, 500)
            .animate({
                top: '-=4'
            }, 500, function() {
                loopa();
            });
    }
    loopa();

	/* morenvy.com 최상단배너 */
	/*
	var main_text_banner = new Swiper('.top_banner', {
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
	});
	*/

});


/* 토글 */
function toggle_view(selector, obj){
	var search = $('#'+selector+'');
	var dim = $('#dimmed');
	var obj = $(obj);
	if (search.css('display') == 'none') {
		search.addClass('active');
		obj.addClass('active');

		if (search.hasClass('dim')) {
			$('html, body').addClass('noneScroll');
			$('html, body').addClass('scrollDisable').bind('scroll touchmove mousewheel', function(e){
	        e.preventDefault();
	    });
			dim.show();
		}
	} else {
		search.removeClass('active');
		obj.removeClass('active');

		if (search.hasClass('dim')) {
			$('html, body').removeClass('noneScroll');
			$('html, body').removeClass('scrollDisable').unbind('scroll touchmove mousewheel');
			dim.hide();
		}
	}

}

/* 탭뷰 */
function tabover(name, no) {
	var tabs = $('.tab_'+name+'').find('li');
	tabs.each(function(idx) {
		var detail = $('.tabcnt_'+name+idx);
		var link = $(this).find('a');
		if(no == idx) {
			detail.addClass('active');
			link.addClass('active');
		} else {
			detail.removeClass('active');
			link.removeClass('active');
		}
	})
}

function scrollup(){
	$('html, body').animate({scrollTop:0}, 'slow', function(){
    	$('#quick').fadeOut();
    });
}
function scrolldown(){
	$('html, body').animate({scrollTop:$(document).height()}, 'slow');
}


/* 스크롤 UP, DOWN시 퀵메뉴 노출 */
$(function(){
	var scroll_ing;
	var last = 0;
	var space = 5;
	$(window).scroll(function(event){
		scroll_ing = true;
	});
	setInterval(function() {
		if (scroll_ing) {
			scroll_ed();
			scroll_ing = false;
		}
	}, 250);
	function scroll_ed() {
		var st = $(this).scrollTop();
		if(Math.abs(last - st) <= space)
			return;
		if (st > last){	// 스크롤 down
			$('#quick').fadeOut();
		} else {
			if(st + $(window).height() < $(document).height()){	// 스크롤 up
				if( st == 0 ){
                	$('#quick').fadeOut();
                }
                else {
                	$('#quick').fadeIn();
                }
                
			}
		}
		last = st;
	}
});

var inputBox = $('.searchForm .fld > input');
$(document).ready(function(){
	//input 선택&해제시
	inputBox.focus(function(){
		$(this).prev('label').hide();
	});

	inputBox.blur(function(){
		if($(this).val() == '') {
			$(this).prev('label').show();
		} else {
			$(this).prev('label').hide();
		}
	});

	//input 체크
	inputBox.each(function(){
		if($(this).val() != '') {
			$(this).prev('label').hide();
		}
	});

	// morenvy.com 상단아이콘
	function hdjoin() {
		$('.join_balloon').animate({
				top: '+=4'
			}, 500)
			.animate({
				top: '-=4'
			}, 500)
			.animate({
				top: '+=4'
			}, 500)
			.animate({
				top: '-=4'
			}, 500, function() {
				hdjoin();
			});
	}
	hdjoin();

	// 좌측메뉴 최근본상품
	if ($('#aside .recent ul li').length > 3) {
		$('#aside .recent ul li:nth-child(4)').removeClass('displaynone');
	}
});
/*!
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2015 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.9.7
 *
 */

(function($, window, document, undefined) {
    var $window = $(window);

    $.fn.lazyload = function(options) {
        var elements = this;
        var $container;
        var settings = {
            threshold       : 0,
            failure_limit   : 0,
            event           : "scroll.lazyload",
            effect          : "show",
            container       : window,
            data_attribute  : "original",
            data_srcset     : "srcset",
            skip_invisible  : false,
            appear          : null,
            load            : null,
            placeholder     : "data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
        };

        function update() {
            var counter = 0;

            elements.each(function() {
                var $this = $(this);
                if (settings.skip_invisible && !$this.is(":visible")) {
                    return;
                }
                if ($.abovethetop(this, settings) ||
                    $.leftofbegin(this, settings)) {
                        /* Nothing. */
                } else if (!$.belowthefold(this, settings) &&
                    !$.rightoffold(this, settings)) {
                        $this.trigger("appear");
                        /* if we found an image we'll load, reset the counter */
                        counter = 0;
                } else {
                    if (++counter > settings.failure_limit) {
                        return false;
                    }
                }
            });

        }

        if(options) {
            /* Maintain BC for a couple of versions. */
            if (undefined !== options.failurelimit) {
                options.failure_limit = options.failurelimit;
                delete options.failurelimit;
            }
            if (undefined !== options.effectspeed) {
                options.effect_speed = options.effectspeed;
                delete options.effectspeed;
            }

            $.extend(settings, options);
        }

        /* Cache container as jQuery as object. */
        $container = (settings.container === undefined ||
                      settings.container === window) ? $window : $(settings.container);

        /* Fire one scroll event per scroll. Not one scroll event per image. */
        if (0 === settings.event.indexOf("scroll")) {
            $container.off(settings.event).on(settings.event, function() {
                return update();
            });
        }

        this.each(function() {
            var self = this;
            var $self = $(self);

            self.loaded = false;

            /* If no src attribute given use data:uri. */
            if ($self.attr("src") === undefined || $self.attr("src") === false) {
                if ($self.is("img")) {
                    $self.attr("src", settings.placeholder);
                }
            }

            /* When appear is triggered load original image. */
            $self.one("appear", function() {
                if (!this.loaded) {
                    if (settings.appear) {
                        var elements_left = elements.length;
                        settings.appear.call(self, elements_left, settings);
                    }
                    $("<img />")
                        .one("load", function() {
                            var original = $self.attr("data-" + settings.data_attribute);
                            var srcset = $self.attr("data-" + settings.data_srcset);

                            if (original != $self.attr("src")) {
                                $self.hide();
                                if ($self.is("img")) {
                                    $self.attr("src", original);
                                    if (srcset != null) {
                                        $self.attr("srcset", srcset);
                                    }
                                } if ($self.is("video")) {
                                    $self.attr("poster", original);
                                } else {
                                    $self.css("background-image", "url('" + original + "')");
                                }
                                $self[settings.effect](settings.effect_speed);
                            }

                            self.loaded = true;

                            /* Remove image from array so it is not looped next time. */
                            var temp = $.grep(elements, function(element) {
                                return !element.loaded;
                            });
                            elements = $(temp);

                            if (settings.load) {
                                var elements_left = elements.length;
                                settings.load.call(self, elements_left, settings);
                            }
                        })
                        .attr({
                            "src": $self.attr("data-" + settings.data_attribute),
                            "srcset": $self.attr("data-" + settings.data_srcset) || ""
                        });
                }
            });

            /* When wanted event is triggered load original image */
            /* by triggering appear.                              */
            if (0 !== settings.event.indexOf("scroll")) {
                $self.off(settings.event).on(settings.event, function() {
                    if (!self.loaded) {
                        $self.trigger("appear");
                    }
                });
            }
        });

        /* Check if something appears when window is resized. */
        $window.off("resize.lazyload").bind("resize.lazyload", function() {
            update();
        });

        /* With IOS5 force loading images when navigating with back button. */
        /* Non optimal workaround. */
        if ((/(?:iphone|ipod|ipad).*os 5/gi).test(navigator.appVersion)) {
            $window.on("pageshow", function(event) {
                if (event.originalEvent && event.originalEvent.persisted) {
                    elements.each(function() {
                        $(this).trigger("appear");
                    });
                }
            });
        }

        /* Force initial check if images should appear. */
        $(function() {
            update();
        });

        return this;
    };

    /* Convenience methods in jQuery namespace.           */
    /* Use as  $.belowthefold(element, {threshold : 100, container : window}) */

    $.belowthefold = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = (window.innerHeight ? window.innerHeight : $window.height()) + $window.scrollTop();
        } else {
            fold = $(settings.container).offset().top + $(settings.container).height();
        }

        return fold <= $(element).offset().top - settings.threshold;
    };

    $.rightoffold = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.width() + $window.scrollLeft();
        } else {
            fold = $(settings.container).offset().left + $(settings.container).width();
        }

        return fold <= $(element).offset().left - settings.threshold;
    };

    $.abovethetop = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.scrollTop();
        } else {
            fold = $(settings.container).offset().top;
        }

        return fold >= $(element).offset().top + settings.threshold  + $(element).height();
    };

    $.leftofbegin = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.scrollLeft();
        } else {
            fold = $(settings.container).offset().left;
        }

        return fold >= $(element).offset().left + settings.threshold + $(element).width();
    };

    $.inviewport = function(element, settings) {
         return !$.rightoffold(element, settings) && !$.leftofbegin(element, settings) &&
                !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
     };

    /* Custom selectors for your convenience.   */
    /* Use as $("img:below-the-fold").something() or */
    /* $("img").filter(":below-the-fold").something() which is faster */

    $.extend($.expr[":"], {
        "below-the-fold" : function(a) { return $.belowthefold(a, {threshold : 0}); },
        "above-the-top"  : function(a) { return !$.belowthefold(a, {threshold : 0}); },
        "right-of-screen": function(a) { return $.rightoffold(a, {threshold : 0}); },
        "left-of-screen" : function(a) { return !$.rightoffold(a, {threshold : 0}); },
        "in-viewport"    : function(a) { return $.inviewport(a, {threshold : 0}); },
        /* Maintain BC for couple of versions. */
        "above-the-fold" : function(a) { return !$.belowthefold(a, {threshold : 0}); },
        "right-of-fold"  : function(a) { return $.rightoffold(a, {threshold : 0}); },
        "left-of-fold"   : function(a) { return !$.rightoffold(a, {threshold : 0}); }
    });

})(jQuery1_11_2, window, document);
//      강조 표시 할 카테고리 넘버를 배열에 넣어주세요.

//      강조할 카테고리 : 카테고리넘버   ex// var cateChkArray = [1118, 1619, 1600, 1622];

//      강조할 카테고리의 '전체'카테고리를 강조할 경우 : '상위카테고리넘버all'   ex// var cateChkArray = ['331all', '342all'];

var cateChkArray = [2027, 3625, 2537];

var main_page = $("#main").length; //메인페이지
var login_page = $("#login").length; //로그인 페이지
var login_before = $("#login_before").length; //로그인 이전 페이지
var nowLink = window.location.href; //현재 주소
var nowLinkHostName = window.location.hostname; //현재 주소 hostname
var nowLinkPathName = window.location.pathname; //현재 주소 pathname

$(document).ready(function () {
  //로그인 상태일때 버튼에 들어간 로그인페이지 이동 링크 없애기(test)
  $("#cnt a").each(function () {
    var contentALink = $(this).attr("href");

    if (contentALink !== undefined) {
      if (contentALink.indexOf("login.html") > -1 && $("#loginChk_member").length > 0) {
        $(this).attr("href", "");
        $(this).css("cursor", "default");
      }
    }
  });

  //매핑 카카오 페이지

  var mapping_kakao = sessionStorage.getItem("mappingKaKao");

  // /member/ , /myshop/ 페이지 제외하고 페이지 링크 저장
  if (nowLinkPathName.indexOf("/member/") == -1 && nowLinkPathName.indexOf("/myshop/") == -1) {
    var linkSave = nowLink.split(nowLinkPathName)[1];
    sessionStorage.setItem("forReturnUrl", nowLinkPathName + linkSave);
  }

  //로그인 페이지

  if (login_page > 0 || login_before > 0) {
    $("#header, #footer").hide();
    var refer_url = document.referrer;
    //이전페이지에서 login페이지가 아니라면
    if (refer_url.indexOf("login.html") == -1) {
      //세션 저장
      sessionStorage.setItem("chk_url_prev", refer_url);
    }

    //비회원 구매 버튼 클릭시 팝업 등장
    $(".guest_order").click(function () {
      $(".nonmember_pop_container").show();
    });

    //비회원 팝업 x 버튼 클릭시 팝업 닫힘
    $(".nonmember_pop .pop_close, .nonmember_pop_container").click(function () {
      $("html").removeClass("nonscroll");
      $(".nonmember_pop_container").hide();
    });

    //이전 페이지 이동
    $(".prev_btn").click(function () {
      window.history.back();
    });

    //return Url 값 있으면 회원가입 페이지에 연결해주기..
    if (nowLink.indexOf("returnUrl=") > -1) {
      var oriJoinLink = $(".box_member .guest_join a").attr("href");
      var returnUrlChk = nowLink.split("returnUrl=")[1];
      $(".box_member .guest_join a").attr("href", oriJoinLink + "?returnUrl=" + returnUrlChk);
    }

    /**************** * 최적화 리다이렉트 * 회원가입 브릿지 페이지 => 로그인 페이지일때 로그인 후 메인페이지로 리다이렉트 ******************/

    var returnUrlInput = $("#returnUrl");

    // undefined를 indexOf하면 오류 발생해서 조건문에 !!returnUrlInput.val() && 추가
    if (!!returnUrlInput.val() && returnUrlInput.val().indexOf("/member/bridge.html") > -1) {
      returnUrlInput.val("/");
    }

    /**************** 회원가입 브릿지 페이지 => 로그인 페이지일때 로그인 후 메인페이지로 리다이렉트 ******************/
  }

  /* ================================================================================================================================================================================



        														2022-06-02 재입고알림 관련 내용



    ================================================================================================================================================================================== */

  // 현재 분기를 더해줘야 함 생각해보니 비로그인 > confim 확인 > 회원가입 > 후 > return
  // 그럴려면 sessionStorage를 이용해야할거 같은데..
  // 현재는 페이지만 return 전페이지로 간다

  // 현재 페이지가 회원가입 완료후
  var preDprevPage = sessionStorage.getItem("forReturnUrl");
  if (nowLink.indexOf("/join_result") > -1) {
    var forname = sessionStorage.getItem("proReturnUrl");
    if (forname == 1) {
      window.location.href = preDprevPage;
    }
  }

  //현재 페이지가 로그인페이지가 아니라면 재입고 버튼 누르고 로그인창갔다가 다시 다른 창에 들어갔다가 로그인 해서 다시 본상품으로 돌아 갔을때 팦업 방지
  var login_chk = $(".state_logon").length;
  var join_page = $("#join_input").length; // 회원가입 페이지
  var bridge_page = $(".bridge_container").length; // 브릿지 페이지
  var join_result_page = $(".subtitle.member.finish").length; // 회원가입 완료 페이지
  var sns_login_page = $(".mappging_login_container").length; // SNS 연동 페이지
  var event_page = $(".eventDetail").length; // 이벤트 페이지

  // 로그인, 회원가입, 회원가입완료, 브릿지, SNS계정연동 페이지
  if (login_page != 1 && join_page != 1 && join_result_page != 1 && bridge_page != 1 && sns_login_page != 1 && event_page != 1) {
    var $currentLinkFIX = window.location.pathname + window.location.search;
    sessionStorage.setItem("noLoginReturnFIX", $currentLinkFIX);
  }

  // 로그인, 회원가입, 회원가입완료, 브릿지, SNS계정연동 페이지, 메인페이지
  if (login_page != 1 && join_page != 1 && join_result_page != 1 && bridge_page != 1 && sns_login_page != 1 && main_page != 1) {
    sessionStorage.removeItem("proReturnUrl");
  } else if (main_page > 0 && login_chk == 0) {
    sessionStorage.removeItem("proReturnUrl");
  }

  // 매핑 로그인 이후 메인페이지 도달 시 + proReturnUrl 있을시
  var document_prev = document.referrer; // 이전 페이지 값 구하기
  var forname = sessionStorage.getItem("proReturnUrl");

  // 메인 페이지이고, 이전 페이지가 SNS로그인 페이지 였다면
  if (main_page > 0 && mapping_kakao != null) {
    // 재입고알림 버튼 클릭시 생성
    if (forname == 1) {
      window.location.href = mapping_kakao; // 해당 상품으로 리턴
    }
  }

  // 매핑 로그인 이후 메인페이지 도달 시 + proReturnUrl 있을시
  var document_prev = document.referrer; // 이전 페이지 값 구하기

  // 메인 페이지이고, 이전 페이지가 SNS로그인 페이지 였다면
  if (main_page > 0 && document_prev.indexOf("/member/mapping_login.html") > -1) {
    var forname = sessionStorage.getItem("proReturnUrl"); // 재입고알림 버튼 클릭시 생성
    var return_url = sessionStorage.getItem("forReturnUrl"); // 리턴값 저장
    if (forname == 1) {
      window.location.href = return_url; // 해당 상품으로 리턴
    }
  }

  var memberLogOn = $("#memberLogOn").length; // 로그인 여부, 카카오인지도 확인 필요
  var mySession; // 세션스토리지 member_1 전체값 구하기
  var my_User_Id;

  if (main_page > 0 && mapping_kakao != null && memberLogOn > 0) {
    function mappingKakaoRedirect() {
      var $return = mapping_kakao;
      sessionStorage.removeItem("mappingKaKao");
      if ($return == "/") {
      } else {
        window.location.href = $return;
      }
    }
    mappingKakaoRedirect();
  }

  /* ================================================================================================================================================================================



        														2022-06-02 재입고알림 관련 내용



    ================================================================================================================================================================================== */

  //로그인페이지에서 저장한 세션값(로그인 페이지의 이전 페이지) 가져오기

  var prevPage = sessionStorage.getItem("chk_url_prev");
  var location_href = window.location.href;

  //현재 페이지가 로그인페이지라면

  if (location_href.indexOf("login.html") > -1) {
    //로그인 페이지에서 저장한 이전 페이지 session과 로그인 한 회원 id session값이 존재한다면
    if (sessionStorage.getItem("chk_url_prev") !== null && CAPP_ASYNC_METHODS.member.__sMemberId !== null) {
      // 이전 페이지가 현재페이지와 같으면 무한루프 방지
      if (prevPage == location_href || prevPage == "") {
      } else {
        //로그인 페이지에서 저장한 이전페이지로 이동
        var couponLink = localStorage.getItem("coupon");

        if (couponLink) {
        } else {
          window.location.href = prevPage;
        }
      }
    }
  }

  //브릿지 페이지일때......
  if ($(".bridge_container").length > 0) {
    //return Url 값 있으면 회원가입 페이지에 연결해주기..
    if (nowLink.indexOf("returnUrl=") > -1) {
      var returnUrlChk = nowLink.split("returnUrl=")[1];
      $('.bridge_container #login_before .login_box .btn_wrap a[href^="/member/join.html"]').attr("href", "/member/join.html?returnUrl=" + returnUrlChk);
      $('.bridge_container #login_before .login_box .btn_small_group a[href^="/member/login.html"]').attr("href", "/member/login.html?returnUrl=" + returnUrlChk);
    }
  }

  //회원가입 페이지일때 ..........
  if ($("#join_input").length > 0) {
    if (nowLink.indexOf("returnUrl=") > -1) {
      var returnUrlChk = nowLink.split("returnUrl=")[1];
      $("#returnUrl").val("/member/join_result.html?returnUrl=" + returnUrlChk);
    }
  }

  //회원가입 완료 페이지일때 ...

  if ($(".subtitle.member.finish").length > 0) {
    //return Url 값 있으면 보내줘..
    if (nowLink.indexOf("returnUrl=") > -1) {
      var returnUrlChk = nowLink.split("returnUrl=")[1];
      setTimeout(function () {
        window.location.href = returnUrlChk;
      }, 1000);
    }
  }

  //아울렛 필터페이지 이동
  var chnage_url = localStorage.getItem("obj_middle_cate");
  if (chnage_url) {
    $(document)
      .find(".menu_2ul > li")
      .each(function () {
        var outlet_cate = $(this).find("a").text().trim();
        if (outlet_cate == "아울렛") {
          $(this)
            .find("a")
            .attr("href", "/product/list.html?cate_no=" + chnage_url);
        }
      });
  }

  //처음 side 메뉴 화살표 down_btn active remove
  $("#aside .category .menu_1li.submenu .down_btn").removeClass("active");

  /* #237 [공통] 마이페이지, 드로우메뉴 한글중복표시 문의 240305 */
  // 적립금 노출 함수 window load로 옮김

  //누적 주문 노출

  order_side();

  function order_side() {
    var order_length = $("#xans_myshop_bankbook_order_count").text().length;
    var sideBar_order = $("#xans_myshop_bankbook_order_count").text().trim();
    if (order_length > 0) {
      sideBar_order = comma(onlyNumbFunc(sideBar_order));
      $("#xans_myshop_bankbook_order_count").text(sideBar_order);
    } else {
      //관리자 아이디가 아닐 경우
      if ($("#aside .member .state_logon > div").length > 0) {
        setTimeout(order_side, 200);
      }
    }
  }

  //-----------------------------------------------------------------------------------------------------------

  //각 상품 컬러칩

  $(".prd_basic  > .common_prd_list").each(function () {
    //할인율 추가 항목에 'y' 라는 글자 있으면 할인율 노출---------------------------------------------------------
    var discount_show2 = $(this).find(".display_할인율노출여부").text().trim();
    if (discount_show2.indexOf("y") > -1 || discount_show2.indexOf("Y") > -1) {
      $(this).find(".price .sale_percent").show();
    }

    var el = $(this);
    selectedColorChipFunc(el); //특정 선택 컬러칩으로 노출

    //세트 상품
    if ($(this).find(".color_review .colorchip").hasClass("displaynone")) {
      if ($(this).find(".set_colornum").length > 0) {
        var color_count = onlyNumbFunc($(this).find(".set_colornum > span").text());
        $(this)
          .find(".color_review .colorchip_count")
          .append(color_count + '<span class="mgL5">컬러</span>');
        $(this).find(".color_review .colorchip_count").show();
      }
      //일반 상품
    } else {
      //컬러칩 추가 항목 입력에 따라 컬러수 or 컬러칩 노출
      //컬러수로 노출
      var color_count = $(this).find(".color_review .xans-product-colorchip > span").length;
      var color_count2 = $(this).find(".color_review .xans-search-colorchip > span").length;

      if (color_count != 0 || color_count2 != 0) {
        //컬러박스로 노출 원할 경우, 컬러 count 숨김
        if ($(this).find(".colorchip_box > span").length > 0) {
          $(this).find(".color_review .colorchip_count").hide();
        } else {
          //검색페이지
          if ($(".color_review .xans-search-colorchip").length > 0) {
            $(this)
              .find(".color_review .colorchip_count")
              .append(color_count2 + '<span class="mgL5">컬러</span>');
            $(this).find(".color_review .colorchip_count").show();
          } else {
            //상품 분류페이지
            $(this)
              .find(".color_review .colorchip_count")
              .append(color_count + '<span class="mgL5">컬러</span>');
            $(this).find(".color_review .colorchip_count").show();
          }
        }
      }
    }

    //특정 선택 컬러칩으로 노출

    function selectedColorChipFunc(el) {
      el.find(".box .xans-product-listitem > li,  .box .xans-search-listitem > li").each(function () {
        var colorchip = $(this).find(".title > span").text().trim();

        if (colorchip.indexOf("컬러칩출력유무") > -1) {
          $(this).addClass("colorchip_wrap");
          if ($(this).children("span").text().indexOf("세트") == -1) {
            var colortxt = $(this).children("span").text().split(",");
            var colorWrap = $(this).parents(".info").find(".color_review .colorchip_box");
            colortxt.forEach(function (color, idx) {
              $(colorWrap).append('<span class="color" style="background-color:' + color + '"></span>');
            });

            //컬러수는 숨김처리
            $(this).parents(".info").find(".color_review .colorchip_count").hide();
          } else {
            $(this).addClass("set_colornum");
          }
        }
      }); //추가 항목 반복문
    }
  }); //컬러칩 추가 항목 입력에 따라 컬러수 or 컬러칩 노출

  // ------------------------------------------------------------------------------- 카테고리 출력 ------------------------------------------------------------------------------------- //

  // 헤더, 푸터, 상품 분류 카테고리 출력 공통

  $(".base_menu_wrapper").each(function () {
    var $baseMenuWrapper = $(this);
    var $dataCateType = $(this).data("cate-type");

    if ($dataCateType != "prd_list") {
      $.ajax({
        url: "/exec/front/Product/SubCategory",
        dataType: "json",
        success: function (aData) {
          if (aData == null || aData == "undefined") {
            return;
          }

          //2차 depth까지만 실행
          for (var i = 1; i < 2; i++) {
            var $menu_li = $baseMenuWrapper.find(".menu_" + i + "li");
            var $next1Number = i + 1;
            var $before1Number = i - 1;
            if ($menu_li.find(".menu_" + $next1Number + "ul").length == 0) {
              makeMenuFunc();
            }
          }

          function makeMenuFunc() {
            $menu_li.each(function () {
              var $data_cate = $(this).data("cate"); //data-cate 값 : json 데이터와 비교 위함
              $.each(aData, function (index, key) {
                if ($data_cate == key.parent_cate_no) {
                  if ($baseMenuWrapper.find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]').find(".menu_" + $next1Number + "ul").length == 0) {
                    var $menu_ulappend = '<ul class="menu_' + $next1Number + 'ul"></ul>';
                    $baseMenuWrapper
                      .find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]')
                      .append($menu_ulappend)
                      .addClass("submenu"); /* 하위 메뉴 있을때 표시용 .has_submenu 추가 */
                  }
                  var $menu_liappend = '<li class="menu_' + $next1Number + 'li" data-cate="' + key.cate_no + '"><a href="/product/list.html' + key.param + '"><span>' + key.name + "</span></a></li>";
                  $baseMenuWrapper
                    .find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]')
                    .find(".menu_" + $next1Number + "ul")
                    .append($menu_liappend);
                }
              });
            });
          }
        },

        complete: function () {
          $baseMenuWrapper.addClass("done");
          $baseMenuWrapper.find('li[class^="menu_"]').each(function () {
            for (var b = 0; b < cateChkArray.length; b++) {
              var cateNum = String(cateChkArray[b]);

              //배열 값에 'all' 텍스트 있을 경우
              if (cateNum.indexOf("all") > -1) {
                //텍스트 all 분기처리하고 숫자만 남기기.
                var cateNum_split = cateNum.split("all")[0];
                //카테고리 번호랑 숫자랑같은 메뉴는 addClass ".all_menu_chk";
                if ($(this).data("cate") == cateNum_split) {
                  $(this).addClass("all_menu_chk");
                  //텍스트 all 분기처리하고 남은 숫자와 같은 카테고리에 강조표시
                  $(this).children("a").addClass("chk");
                }
              }
            }

            //배열 값 가져와서 숫자와 카테고리 번호랑 같으면 강조표시
            if (checkAvailability(cateChkArray, $(this).data("cate"))) {
              $(this).children("a").addClass("chk");
            }
          });

          //전체 메뉴 생성

          $('ul[data-cate-type="header"] .menu_1ul > li').each(function () {
            var menu2_all = $(this).data("cate");
            if ($(this).hasClass("submenu")) {
              if ($(this).hasClass("all_menu_chk")) {
                $(this)
                  .find(".menu_2ul")
                  .prepend('<li class="menu_2li menu_all" data-cate="' + menu2_all + '"><a class="chk" href="/product/list.html?cate_no=' + menu2_all + '"><span>전체</span></a></li>');
              } else {
                $(this)
                  .find(".menu_2ul")
                  .prepend('<li class="menu_2li menu_all" data-cate="' + menu2_all + '"><a href="/product/list.html?cate_no=' + menu2_all + '"><span>전체</span></a></li>');
              }

              if (menu2_all == 1260) {
                $(this).find(".menu_2ul").prepend('<li class="menu_2li menu_all test" data-cate="1488"><a href="/product/list.html?cate_no=1488"><span>전체</span></a></li>');
              }

              if ($(".menu_2li.menu_all").length > 1) {
                $(".menu_2li.menu_all:not(.menu_2li.menu_all:first-child)").remove();
              }
            }

            //소재별 컬렉션 페이지

            var fb_collection_cate = $(this).children("a").text().trim();

            if (fb_collection_cate.indexOf("신상") > -1) {
              $(this)
                .find(".menu_2ul > li")
                .each(function () {
                  var fb_collection_2dp = $(this).data("cate");
                  $(this)
                    .children("a")
                    .attr("href", "/product/list.html?cate_no=" + fb_collection_2dp);

                  if (fb_collection_2dp == 1768) {
                    //에어스트 기모 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1593825&board_no=1");
                  } else if (fb_collection_2dp == 1760) {
                    //벨벳 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1594722&board_no=1");
                  } else if (fb_collection_2dp == 1759) {
                    //쉐르파 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1596110&board_no=1");
                  } else if (fb_collection_2dp == 1773) {
                    //프리마로프트 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1596325&board_no=1");
                  } else if (fb_collection_2dp == 1774) {
                    //기모레깅스 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1596326&board_no=1");
                  } else if (fb_collection_2dp == 1772) {
                    //소프트히트 컬렉션
                    $(this).children("a").attr("href", "/board/gallery/read.html?no=1596327&board_no=1");
                  }
                });
            }
          });
        },

        error: function (request, status, error) {
          console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
        },
      }); //ajax
    } else {
      $.ajax({
        url: "/exec/front/Product/SubCategory",
        dataType: "json",
        success: function (aData) {
          if (aData == null || aData == "undefined") {
            return;
          }

          $.each(aData, function (index, key) {
            if (key.parent_cate_no == 1) {
              $('.product_list_container .menu_1li[data-cate="' + key.cate_no + '"]').addClass("pick");
            }
          });

          $(".product_list_container .menu_1li:not(.pick)").remove();

          //3차 depth까지만 실행
          for (var i = 1; i < 3; i++) {
            var $menu_li = $baseMenuWrapper.find(".menu_" + i + "li");
            var $next1Number = i + 1;
            var $before1Number = i - 1;
            if ($menu_li.find(".menu_" + $next1Number + "ul").length == 0) {
              makeMenuFunc();
            }
          }
          function makeMenuFunc() {
            $menu_li.each(function () {
              var $data_cate = $(this).data("cate"); //data-cate 값 : json 데이터와 비교 위함
              $.each(aData, function (index, key) {
                if ($data_cate == key.parent_cate_no) {
                  if ($baseMenuWrapper.find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]').find(".menu_" + $next1Number + "ul").length == 0) {
                    var $menu_ulappend = '<ul class="menu_' + $next1Number + 'ul"></ul>';
                    $baseMenuWrapper
                      .find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]')
                      .append($menu_ulappend)
                      .addClass("submenu"); /* 하위 메뉴 있을때 표시용 .has_submenu 추가 */
                  }
                  var $menu_liappend = '<li class="menu_' + $next1Number + 'li" data-cate="' + key.cate_no + '"><a href="/product/list.html' + key.param + '"><span>' + key.name + "</span></a></li>";
                  $baseMenuWrapper
                    .find(".menu_" + i + 'li[data-cate="' + $data_cate + '"]')
                    .find(".menu_" + $next1Number + "ul")
                    .append($menu_liappend);
                }
              });
            });
          }
        },

        complete: function () {
          $baseMenuWrapper.addClass("done");
        },
      });
    }
  });

  function cate_link(num) {
    var array_list = [];
    var menu_2li = $('li[data-cate="' + num + '"]').hasClass("submenu");
    var menu_2liLen = $('li.menu_2li [data-cate="' + num + '"]').length;
    if (menu_2li) {
      $(this).children("a").attr("href", "");
    }
  }

  let topMenu = $(".top_menu");
  let topMenuAll = $(".top_menu_all");

  cateMarker(topMenu);
  cateMarker(topMenuAll);

  function cateMarker(menu) {
    menu.find(".menu_a").each(function () {
      let cateLink = $(this).find("a");
      let cateNum = cateLink.data("cate");
      if (cateChkArray.includes(cateNum)) {
        cateLink.addClass("chk");
      }
    });
  }

  // ------------------------------------------------------------------------------- 카테고리 출력 ------------------------------------------------------------------------------------- //

  $("#header .common_topmenu .top_menu_all").hide();

  //top_menu 하단 버튼 누를 때

  $("#header .common_topmenu .top_menu .open").click(function () {
    var list_cate = $("#big_section .list_cate .swiper-wrapper .swiper-slide").length;
    var show_all = $(this).hasClass("show");

    if (list_cate > 0) {
      if (show_all) {
        $("#header .common_topmenu .top_menu .menu").show();
        $("#header .common_topmenu .top_menu .all_").hide();
        $(this).removeClass("show");
        $(".top_menu_all").slideUp(200);
      } else {
        $("#header .common_topmenu .top_menu .menu").hide();
        $("#header .common_topmenu .top_menu .all_").show();
        $(this).addClass("show");
        $(".top_menu_all").slideDown(200).css("display", "flex");
      }
    } else {
      //상품 중분류 없을 경우
      if (show_all) {
        $("#header .common_topmenu .top_menu .menu").show();
        $("#header .common_topmenu .top_menu .all_").hide();
        $(this).removeClass("show");
        $(".top_menu_all").slideUp(200);
      } else {
        $("#header .common_topmenu .top_menu .menu").hide();
        $("#header .common_topmenu .top_menu .all_").show();
        $(this).addClass("show");
        $(".top_menu_all").slideDown(200).css("display", "flex");
      }
    }
  });

  /* ================================================================================================================================================================================



        																	GNB 공통 카테고리 영역



        ================================================================================================================================================================================== */

  // 전체메뉴 배너매니저 상단 영역

  $(".collection_wrap .coll_img li").each(function () {
    var $this = $(this);
    var mytext = $this.attr("data-text");
    var text_title = mytext.split(",")[0]; // title
    var text_desc = mytext.split(",")[1]; // desc

    $this.find(".coll_img_title").html(text_title).append('<span class="all">전체 →</span>');
    $this.find(".coll_img_desc").html(text_desc);
  });

  /* ================================================================================================================================================================================



        																	헤더 탑 메뉴 scroll 제어



        ================================================================================================================================================================================== */

  var delta = 100;

  /*
    var hasScroll;

    var lastScroll = 0;

    
    $(window).scroll(function(e){
        hasScroll = true;
    });
    setInterval(function(){
        if(hasScroll){
            topMenuScroll();
            hasScroll = false;
        }
    }, 200);
	*/
  // if (!window.location.href.includes("coupon_select.html")) {
  EC$(window).on(
    "scroll",
    iv_util.debounce(function () {
      topMenuScroll();
    }, 50)
  );
  // }

  function topMenuScroll() {
    var y = $(window).scrollTop();
    if ($("#header").height() != 90) {
      // detail 제외
      // 상단 카테고리 고정 제어
      if (y > 0) {
        $("#header").addClass("fixed");
      } else {
        $("#header").removeClass("fixed");
      }
    }
  }

  /* ================================================================================================================================================================================



        																	//헤더 탑 메뉴 scroll 제어



        ================================================================================================================================================================================== */

  //장바구니 상품 0 일때

  var bsk_txt = $("#header .gnb span.cart span").text();

  if (main_page > 0) {
    // * --------------------------------------------------------- 배너 영역 -------------------------------------------------------------- * //

    //아울렛
    var OutletSwiper = new Swiper(".outlet_wrapper.swiper-container", {
      slidesPerView: 2.2,
      spaceBetween: 10,
      freeMode: true,
      pagination: {
        el: ".outlet_wrapper .swiper-pagination",
        clickable: true,
      },
    });

    //레깅스
    var LeggingsSwiper = new Swiper(".leggings_wrapper.swiper-container", {
      slidesPerView: 2.2,
      spaceBetween: 10,
      freeMode: true,
      pagination: {
        el: ".leggings_wrapper .swiper-pagination",
        clickable: true,
      },
    });

    //브라탑
    var BraTopSwiper = new Swiper(".bratop_wrapper.swiper-container", {
      slidesPerView: 2.2,
      spaceBetween: 10,
      freeMode: true,
      pagination: {
        el: ".bratop_wrapper .swiper-pagination",
        clickable: true,
      },
    });

    //lookbook 게시글 가져오기
    $(".lookbook  .list_board > li").each(function () {
      var cate_no = $(this).find(".info .con .cate").text().split("/")[0];
      var prd_no = $(this).find(".info .con .cate").text().split("/")[1];

      //cate_no= 0 일 경우, 상세페이지로
      if (cate_no == "0") {
        $(this)
          .find(".info .go_cate")
          .attr("href", "/product/detail.html?product_no=" + prd_no);
        $(this)
          .find(".info .con")
          .attr("href", "/product/detail.html?product_no=" + prd_no);
        $(this)
          .find(".board_box .img")
          .attr("href", "/product/detail.html?product_no=" + prd_no);
      } else if (prd_no == "0") {
        //prd_no = 0 일 경우, 카테고리 넘버로
        $(this)
          .find(".info .go_cate")
          .attr("href", "/product/list.html?cate_no=" + cate_no);
        $(this)
          .find(".info .con")
          .attr("href", "/product/list.html?cate_no=" + cate_no);
        $(this)
          .find(".board_box .img")
          .attr("href", "/product/list.html?cate_no=" + cate_no);
      } else if (prd_no !== "0" && cate_no !== "0") {
        $(this)
          .find(".info .go_cate")
          .attr("href", "/product/detail.html?product_no=" + prd_no + "&cate_no=" + cate_no);
        $(this)
          .find(".info .con")
          .attr("href", "/product/detail.html?product_no=" + prd_no + "&cate_no=" + cate_no);
        $(this)
          .find(".board_box .img")
          .attr("href", "/product/detail.html?product_no=" + prd_no + "&cate_no=" + cate_no);
      }
    });

    //main 끝
  } else {
    if (nowLinkPathName.indexOf("/member/") == -1) {
      sessionStorage.removeItem("mappingKaKao");
    }
  }

  // 탭 형태 구현 ---------------------------------------------------------------------------- //

  $(".base_tab_container").each(function () {
    var tabAble = $(this).data("tab"); //탭 활성화 여부 true/false
    var tabModule = $(this).data("tab-module"); //탭 모듈 번호

    //값이 true일때만 실행
    if (tabAble) {
      var tabContainer = $(this);
      var tabBar = $(this).find('[data-tab-type="header"]');
      var tabContent = $(this).find('[data-tab-type="content"]');

      //탭 모듈 1 -- 탭 클릭 시 on off 전환
      if (tabModule == "1") {
        //첫번째 항목에 on 추가 (.displaynone 아닌 것 중 첫번째)
        tabBar.find("[data-tab-connect]:not(.displaynone)").first().addClass("on");
        //첫번째 항목에 on 추가 (.displaynone 아닌 것 중 첫번째)
        tabContent.find("[data-tab-connect]:not(.displaynone)").first().addClass("on");

        //클릭 시 제어
        tabBar.find("[data-tab-connect]").click(function () {
          var tabBarConnect = $(this).data("tab-connect");
          // tabBar
          tabBar.find("[data-tab-connect]").removeClass("on");
          tabBar.find('[data-tab-connect="' + tabBarConnect + '"]').addClass("on");
          //tabContent
          tabContent.find("[data-tab-connect]").removeClass("on");
          tabContent.find('[data-tab-connect="' + tabBarConnect + '"]').addClass("on");
          var tabOffset = tabBar.offset().top - 60;
          $("html,body").animate({scrollTop: tabOffset}, 0);
        });

        //탭 모듈2 -- 탭 클릭시 해당 위치로 이동
      } else if (tabModule == "2") {
        var topBannerHeight = $("#base_top_banner").outerHeight();
        var headerHeight = $("#header_container .hd_bottom_wrapper").outerHeight();
        var totalHeaderHeight = topBannerHeight + headerHeight;
        var tabHeight = tabBar.outerHeight();
        var tabOffsetArray = new Array();

        $(window).ready(function () {
          if (tabContainer.hasClass("done") == false) {
            topWithTabHeightCalcFunc();
          }

          $(".prd_detail_content img").each(function () {
            var thisImg = $(this);
            imageLoad_resetArray(thisImg);
          });

          function imageLoad_resetArray(thisImg) {
            var thisImgHeight = thisImg.outerHeight();
            if (thisImg.outerHeight() == "1") {
              setTimeout(imageLoad_resetArray, 300, thisImg);
              thisImgHeight = thisImg.outerHeight();
            } else {
              setTimeout(function () {
                tabOffsetArray = [];
                tabContent.find("[data-tab-connect]:not(.displaynone)").each(function () {
                  var tabBarConnect = $(this).data("tab-connect");
                  var tabContentOffset = $(this).offset().top;
                  var tabContentHeight = $(this).outerHeight();
                  var tabOffsetItem = {no: tabBarConnect, offsetTop: tabContentOffset, offsetHeight: tabContentHeight};
                  tabOffsetArray.push(tabOffsetItem);
                });
              }, 300);
            }
          }
        });

        //모두 로딩 될때 헤더 높이 계산 완료

        function topWithTabHeightCalcFunc() {
          if (topBannerHeight == 0 || headerHeight == 0 || tabHeight == 0) {
            topBannerHeight = $("#base_top_banner").outerHeight();
            headerHeight = $("#header_container .hd_bottom_wrapper").outerHeight();
            totalHeaderHeight = topBannerHeight + headerHeight;
            tabHeight = tabBar.outerHeight();
            setTimeout(topWithTabHeightCalcFunc, 100);
          } else {
            tabContainer.addClass("done");

            //클릭 시 제어
            tabBar.find("[data-tab-connect]").click(function () {
              var tabBarConnect = $(this).data("tab-connect");
              var tabContentOffset = tabContent.find('[data-tab-connect="' + tabBarConnect + '"]').offset().top;
              var scrollTop = tabContentOffset - 200;

              $("html, body").animate(
                {
                  scrollTop: scrollTop,
                },
                500
              );
            });

            //탭 영역 로딩 setTimeout

            setTimeout(function () {
              tabOffsetArray = [];

              tabContent.find("[data-tab-connect]:not(.displaynone)").each(function () {
                var tabBarConnect = $(this).data("tab-connect");
                var tabContentOffset = $(this).offset().top;
                var tabContentHeight = $(this).outerHeight();
                var tabOffsetItem = {no: tabBarConnect, offsetTop: tabContentOffset, offsetHeight: tabContentHeight};
                tabOffsetArray.push(tabOffsetItem);
              });

              //스크롤 시 해당하는 탭 영역에 .on
              var elChk;

              $(window).scroll(function () {
                var scrollTop = $(window).scrollTop();
                tabOffsetArray.forEach(function (el, idx) {
                  if (scrollTop >= el.offsetTop - 250) {
                    elChk = el.no;
                  }
                });

                setTimeout(function () {
                  if (scrollTop < tabOffsetArray[0].offsetTop - 250) {
                    tabBar.find("[data-tab-connect]").removeClass("on");
                  }

                  if (tabBar.find('[data-tab-connect="' + elChk + '"]').hasClass("on") == false) {
                    tabBar.find("[data-tab-connect]").removeClass("on");
                    tabBar.find('[data-tab-connect="' + elChk + '"]').addClass("on");
                  }
                }, 150);
              });
            }, 800);
          }
        }
      }
    }
  });

  /* ================================================================================================================================================================================*/

  /* 23.02 베스트 딱지 */

  /*================================================================================================================================================================================== */

  /* 메인페이지 베스트 - 순서 딱지 붙여주기 */

  var mainPage = $("#main").length;

  if (mainPage > 0) {
    $(".tabcnt_best").each(function () {
      $(this)
        .find(".common_prd_list")
        .each(function (index) {
          index = index + 1;
          if (index <= 20) {
            $(this)
              .find(".box .img")
              .append('<span class="rankBadge">' + index + "</span>");
            $(this).find(".xans-product-imagestyle").addClass("left");
          }
        });
    });

    // 메인페이지 - 탭 불러온 후에도 딱지 붙여주기 (231207 추가)
    $("#mainBest .list-element").click(function (index) {
      setTimeout(function () {
        $("#mainBest .common_prd_list").each(function (index) {
          index = index + 1;
          if (index <= 10) {
            $(this)
              .find(".box .img")
              .append('<span class="rankBadge">' + index + "</span>");
            $(this).find(".xans-product-imagestyle").addClass("left");
          }
        });
      }, 500);
    });
  } // mainPage > 0

  //NEW 뱃지만 위치 수정

  var prdlistPage = $(".common_prd_list").length;

  if (prdlistPage > 0) {
    $(".common_prd_list").each(function () {
      $(this)
        .find(".xans-product-imagestyle")
        .each(function () {
          var badge = $(this).find("img").attr("src");
          if (badge !== undefined) {
            badge = badge.split("image_custom_")[1];
            if (badge == "3716764386566056.png") {
              $(this).addClass("badge_new");
            }
          }
        });
    });
  }

  // 상품 정보 함수 실행
  productInfoFunc();
  //addTextbox();
}); //document ready

EC$(window).on("load", function () {
  var MEMBER_INFO = CAPP_ASYNC_METHODS.member.getData();
  var getMemberInfo = CAPP_ASYNC_METHODS.member;

  //MYMEMBERDATA();

  if (MEMBER_INFO.group_name === null) {
    MEMBER_INFO = CAPP_ASYNC_METHODS.member.getData();
    var groupName = MEMBER_INFO.group_name; //그룹명
    var memberName = MEMBER_INFO.name; //아이디

    $(".myinfo_box .member, #mypage_menu .grade > span").text(groupName);
    $(".myinfo_box .name,  #mypage_menu .name > span").text(memberName);

    $("#mypage_menu .name > span").text(memberName);
    $("#mypage_menu .grade > span").text(groupName);
  }

  // 쇼핑라이브 카테고리
  $(".board_area").prepend($(".gnb_list_wrapper").find(".gnb_1li[data-cate='2496']"));
  $(".board_area").find(".gnb_1li[data-cate='2496']").addClass("viewsub");

  mileage_side();

  function mileage_side() {
    var mileage_length = $("#xans_myshop_bankbook_avail_mileage").text().length;
    var sideBar_mileage = $("#xans_myshop_bankbook_avail_mileage").text().trim();
    if (mileage_length > 0) {
      setTimeout(function () {
        sideBar_mileage = comma(onlyNumbFunc(sideBar_mileage));
        $("#xans_myshop_bankbook_avail_mileage").text(sideBar_mileage);
        $("#aside .member .state_logon .info_box .mileage p").css("visibility", "visible");
      }, 200);
    } else {
      //관리자 아이디가 아닐 경우
      if ($("#aside .member .state_logon > div").length > 0) {
        setTimeout(mileage_side, 200);
      }
    }
  }

  var mypage = $("#mypage").length;
  var mypage2 = $("#mypage_menu").length;

  if (mypage > 0) {
    setTimeout(
      sessionChk,
      100 // 회원,멤버십
    );

    //mileageChk(); // 마일리지

    // 회원,멤버십----------------------------------------------------------------------------------------------------------------------

    function sessionChk() {
      var member_session = CAPP_ASYNC_METHODS.member;
      if (member_session) {
        //회원 아이디, 멤버십 등급 넣어주기
        var groupName = member_session.__sGroupName; //그룹명
        var memberName = member_session.__sName; //아이디
        $(".myinfo_box .member, #mypage_menu .grade > span").text(groupName);
        $(".myinfo_box .name,  #mypage_menu .name > span").text(memberName);
      } else {
        setTimeout(sessionChk, 100);
      }
    }

    // 회원,멤버십----------------------------------------------------------------------------------------------------------------------

    // 마일리지 ---------------------------------------------------------------------------------------------------------------------

    function mileageChk() {
      var mileageTxt = $(".myinfo_box #xans_myshop_bankbook_avail_mileage").text();
      if (mileageTxt.indexOf("원") > -1) {
        //마일리지 값들어옴
        //쿠폰, 마일리지 수 넣어주기
        var mileageResult = mileageTxt.replace("원", "");
        $(".myinfo_box #xans_myshop_bankbook_avail_mileage").text(mileageResult);
        setTimeout(function () {
          $(".myinfo_box #xans_myshop_bankbook_avail_mileage").text(mileageResult);
          $(".myinfo_box .right a > span").addClass("opacity1");
        }, 100);
      }
    }

    mileageChk();

    IV$(".myinfo_box #xans_myshop_bankbook_avail_mileage").iv_observerFunc(
      function () {
        mileageChk();
      },
      {
        attributes: false,
        childList: true,
        subtree: false,
      }
    );

    // 마일리지 ---------------------------------------------------------------------------------------------------------------------

    couponChk();

    // 쿠폰 ---------------------------------------------------------------------------------------------------------------------

    function couponChk() {
      var couponTxt = $("#aside .info_box #xans_myshop_bankbook_coupon_cnt").text().length;
      if (couponTxt > 0) {
        //마일리지 값들어옴
        //쿠폰, 마일리지 수 넣어주기
        var coupon_tt = $("#aside .info_box #xans_myshop_bankbook_coupon_cnt").text();
        coupon_tt = onlyNumbFunc(uncomma(coupon_tt));
        $(".myinfo_box #xans_myshop_bankbook_coupon_cnt").text(comma(coupon_tt));
      } else {
        setTimeout(couponChk, 100);
      }
    }

    // 쿠폰 ---------------------------------------------------------------------------------------------------------------------

    // 예치금 ---------------------------------------------------------------------------------------------------------------------

    function depositChk() {
      var depositTxt = $(".myinfo_box #xans_myshop_bankbook_deposit").text();
      if (depositTxt.indexOf("원") > -1 && depositTxt != "0원") {
        var depositResult = depositTxt.replace("원", "");
        $(".myinfo_box #xans_myshop_bankbook_deposit").text(depositResult);
        setTimeout(function () {
          $(".myinfo_box #xans_myshop_bankbook_deposit").text(depositResult);
        }, 100);

        // 0원이 아닐 때만 영역 보여주기
        $(".myinfo_box .right .deposits").removeClass("displaynone");
      }
    }

    depositChk();

    IV$(".myinfo_box #xans_myshop_bankbook_deposit").iv_observerFunc(
      function () {
        depositChk();
      },
      {
        attributes: false,
        childList: true,
        subtree: false,
      }
    );

    // 예치금 ---------------------------------------------------------------------------------------------------------------------
  } //if(mypage > 0)
});

// ===================================================================== 공통 함수 ============================================================================== //

function productInfoFunc() {
  var productListItem = $('.prd_basic .common_prd_list:not([iv-product-info = "true"])');
  productListItem.each(function () {
    var $this = $(this);

    //textBoxFunc($this);
    discountPercent($this);
    productPlusInfo($this);

    $this.attr("iv-product-info", true);
  });
}

function productPlusInfo(item) {
  let couponPrice = item.find(".coupon_price");
  if (!couponPrice.hasClass("displaynone")) {
    couponPrice.addClass("has_coupon");
  }
  // var productUsp = item.find(".display_상품정보USP");

  // if (productUsp.length > 0) {
  //   var productUspText = productUsp.children("span").html();
  //   // item.find(".name").after('<p class="usp_text">' + productUspText + "</p>");
  //   var uspText = $("<p class='usp_text'></p>").html(productUspText);
  //   item.find(".name").after(uspText);
  // }

  // var productCouponPrice = item.find(".display_쿠폰적용가");

  // if (productCouponPrice.length > 0) {
  //   var productCouponPriceText = productCouponPrice.children("span").html();
  //   item
  //     .find(".price")
  //     .after('<p class="coupon_price">' + productCouponPriceText + "</p>")
  //     .addClass("has_coupon");
  // }
}

function discountPercent(item) {
  if (item.find(".sale_percent strong").length == 0) {
    var originPrice = item.find(".info .price .sell_prc ").text().trim();
    var originPriceLen = item.find(".info .price .sell_prc").hasClass("displaynone");

    //할인가격
    var discountPrice = item.find(".info .price .sale_prc").text().trim();
    var discountPriceLen = item.find(".info .price .sale_prc").hasClass("displaynone");

    //할인혜택 가격
    var eventPrice = item.find(".info .price .custom_prc").text().trim();
    var eventPriceLen = item.find(".info .price .custom_prc").hasClass("displaynone");

    //할인 혜택가가 있으면
    if (discountPriceLen == true && eventPriceLen == false) {
      if (originPrice != undefined && originPrice != null) {
        //상품가와 할인가에 , 없애주기
        originPrice = uncomma(originPrice);
        eventPrice = uncomma(eventPrice);
        var salePoint = Math.floor(100 - (originPrice / eventPrice) * 100);

        item.find(".info .price .sale_percent").append("<strong>" + salePoint + "%</strong>");
      }

      //할인가격이 있으면
    } else if (discountPriceLen == false && eventPriceLen == true) {
      if (originPrice != undefined && originPrice != null) {
        //상품가와 할인가에 , 없애주기
        originPrice = uncomma(originPrice);
        discountPrice = uncomma(discountPrice);
        var salePoint = Math.floor(100 - (discountPrice / originPrice) * 100);
        item.find(".info .price .sale_percent").append("<strong>" + salePoint + "%</strong>");
      }

      //정상가만 있을 경우
    } else if (eventPriceLen == false && discountPriceLen == false) {
      if (originPrice != undefined && originPrice != null) {
        //상품가와 할인가에 , 없애주기
        discountPrice = uncomma(onlyNumbFunc(discountPrice));
        eventPrice = uncomma(onlyNumbFunc(eventPrice));
        var salePoint = Math.floor(100 - (discountPrice / eventPrice) * 100);
        item.find(".info .price .sale_percent").append("<strong>" + salePoint + "%</strong>");
      }

      //정상가만 있을 경우
    } else if (discountPriceLen == true && eventPriceLen == true) {
      item.find(".info .price .sale_percent").hide();
    }

    var per_Text = item.find(".sale_percent").text().trim();
    if (per_Text == "") {
      item.find(".sale_percent").css("display", "none");
    } else {
      item.find(".sale_percent").css("display", "inline");
    }
  }
}
/* #218 - [공통] 메인페이지 영역 추가 요청 */
function addTextbox() {
  $('.prd_basic .common_prd_list:not([iv-textbox = "done"]) .box .xans-product-listitem > li, .prd_basic .common_prd_list:not([iv-textbox = "done"]) .box .xans-search-listitem > li').each(function () {
    var $this = $(this);
    var textbox = $(this).find(".title > span").text().trim();
    if (textbox == "텍스트박스") {
      //텍스트박스 추가 항목일 경우
      $(this).addClass("textBox").removeClass("displaynone");
    }
    $this.closest("[id^='anchorBoxId_']").attr("iv-textbox", true);
  });
  writeTextbox();
}

/* 상품 커스텀 텍스트 박스 */
function writeTextbox() {
  setTimeout(function () {
    $(".common_prd_list[iv-textbox = 'true']")
      .find(".textBox")
      .each(function () {
        var $this = $(this);
        var my_text = $this.find("strong + span").text().trim();

        $this.find("span").text("");
        if (String(my_text).indexOf(";") > -1) {
          var array_text = my_text.replace(/(^ s*)|( s*$)/gi, "").split(";");
          var modify_arr = array_text.filter((x) => x === "라이브 소개").concat(array_text.filter((x) => x !== "라이브 소개"));
          modify_arr.splice(5); // 5이상의 배열 전체 삭제

          for (var i = 0; i < modify_arr.length; i++) {
            $this.find("span").append("<div class='add_text'>" + modify_arr[i] + "</div>");
          }
        } else {
          $this.find("span").append("<div class='add_text'>" + my_text + "</div>");
        }

        $this.find(".add_text").each(function () {
          var text = $(this).text();
          if (text == "라이브 소개") {
            $(this).addClass("live");
          }
        });
        $this.closest("[id^='anchorBoxId_']").attr("iv-textbox", "done");
      });
  }, 300);
}

// setInterval 로 늘어난 length 비교
function moreDiscount() {
  var cur_leng = $(".prd_basic .common_prd_list").length;
  var disInterval = setInterval(function (itv) {
    itv = disInterval;
    check_leng(cur_leng, itv);
  }, 1000);
}

// length 비교 후 다르다면 끝내기
function check_leng(cur_leng, itv) {
  var cur_leng = cur_leng;
  var next_length = $(".prd_basic .common_prd_list").length;
  if (cur_leng != next_length) {
    discountPercent(); // 할인율 출력 함수

    // 함수 추가 or 변경시 이부분에 추가 하시면 됩니다..!
    clearInterval(itv);
  }
}

//숫자만 남기기
function onlyNumbFunc(text) {
  var reg = /[^0-9]/g;
  if (text !== undefined) {
    if (reg.test(text)) {
      return text.replace(reg, "").trim();
    } else {
      return text;
    }
  }
}

//콤마찍기
function comma(str) {
  str = String(str);
  return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

//콤마제거
function uncomma(string) {
  var no = string.replace(/[^0-9]/g, "");
  return no;
}

function formatPrice(num) {
  var p = parseInt(num) + "";
  return p
    .split("")
    .reverse()
    .reduce(function (acc, num, i, orig) {
      return num == "-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
    }, "");
}

//콤마찍기
function comma1(str) {
  str = String(str);
  return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

// 숫자 입력 제어 --- 전화번호 입력받을 경우 숫자만 입력 가능
function number_control(ele) {
  ele.keyup(function () {
    var value = $(this).val();
    var value2 = "";
    var phoneNumberCheck = /(01[0|1|6|9|7])[-](\d{3}|\d{4})[-](\d{4}$)/g;
    var phoneNumberCheck2 = /^(01[0|1|6|9|7])$/gi;

    if (!phoneNumberCheck.test($(this).val())) {
      $(this).val(
        $(this)
          .val()
          .replace(/[^0-9]/gi, "")
      );
      if (value.length > 2) {
        value2 = value.substr(0, 3);
        if (!phoneNumberCheck2.test(value2)) {
          $(this).val($(this).val().replace(/[^01]/gi, ""));
        }
      }
    }
  });
}

function number_control2(ele) {
  ele.keyup(function () {
    var value = $(this).val();
    var value2 = "";
    var phoneNumberCheck = /[0-9]/g;

    if (!phoneNumberCheck.test($(this).val())) {
      $(this).val(
        $(this)
          .val()
          .replace(/[^0-9]/gi, "")
      );
    }
  });
}

//blur 시 하이픈 추가 - 핸드폰 번호
function add_hyphen_phone(ele) {
  ele.blur(function () {
    var value = ele.val();
    value = value.replace(/[^0-9]/g, "");
    var value2 = "";

    if (value.length == 10) {
      value2 += value.substr(0, 3);
      value2 += "-";
      value2 += value.substr(3, 3);
      value2 += "-";
      value2 += value.substr(6);
      $(this).val(value2);
    }

    if (value.length == 11) {
      value2 += value.substr(0, 3);
      value2 += "-";
      value2 += value.substr(3, 4);
      value2 += "-";
      value2 += value.substr(7);
      $(this).val(value2);
    }
  });
}

//blur 시 하이픈 추가 - 사업자 번호
function add_hyphen_regno(ele) {
  ele.blur(function () {
    var value = ele.val();
    value = value.replace(/[^0-9]/g, "");
    var value2 = "";

    if (value.length == 10) {
      value2 += value.substr(0, 3);
      value2 += "-";
      value2 += value.substr(3, 2);
      value2 += "-";
      value2 += value.substr(5);
      $(this).val(value2);
    }
  });
}

//이메일 뒷자리 입력시 한글 입력 및 특수기호 입력 불가
function email_control2(ele) {
  ele.keyup(function () {
    var value = $(this).val();

    $(this).val(
      $(this)
        .val()
        .replace(/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/gi, "")
    );
    $(this).val(
      $(this)
        .val()
        .replace(/[~!#$@%^&*()+|/<>,?:{}]/gi, "")
    );
  });

  ele.blur(function () {
    var value = $(this).val();

    if (value != "") {
      if (value.indexOf("@") > -1) {
        $(this).val($(this).val().replace(/@/gi, ""));
      } else {
        $(this).val(value);
      }
    }
  });
}

//이메일 앞자리 입력시 영문,숫자, 하이픈만 가능
function email_control1(ele) {
  ele.keyup(function () {
    var value = $(this).val();
    $(this).val(
      $(this)
        .val()
        .replace(/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/gi, "")
    );
    $(this).val(
      $(this)
        .val()
        .replace(/[~!@#$%^&*()+|/<>,.?:{}]/gi, "")
    );
  });
}

//배열값 내 특정 텍스트 존재하는지 확인
function checkAvailability(arr, val) {
  return arr.some(function (arrVal) {
    return val === arrVal;
  });
}

// 카테고리의 cate_no 가져오기 * 변수: 가져올 값, 링크

function getCateParam(name, url) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(url);
  return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getCookie(name) {
  // 쿠키확인
  cookie = document.cookie;
  name = name + "=";

  idx = cookie.indexOf(name);

  if (cookie && idx >= 0) {
    tmp = cookie.substring(idx, cookie.length);
    deli = tmp.indexOf(";");

    if (deli > 0) {
      return tmp.substring(name.length, deli);
    } else {
      return tmp.substring(name.length);
    }
  }
}

var clickFlag = true;

// ajax 공통 출력 함수
function commonAjax(url, type, moreData, event) {
  switch (type) {
    case "POST":
      var ajaxData = moreData == null ? null : JSON.stringify(moreData);
      break;

    case "GET":
      var ajaxData = moreData == null ? null : moreData;
      break;
  }

  return new Promise(function (res, rej) {
    $.ajax({
      url: url,
      type: type,
      data: ajaxData,
      contentType: "application/json",
      dataType: "json",
      error: function (err) {
        var message = err.responseJSON.message; // 에러메세지
        var status = err.responseJSON.status; // 에러코드
        console.log("err===>", err);

        if (event == null) {
          var actionType = "기본 호출";
        } else {
          var targetName = event.target.localName;
          var targetID = event.target.id != "" ? "#" + event.target.id : "";
          var targetClass = event.target.className.length != 0 ? "." + event.target.className.split(" ").join(".") : "";
          var target = targetName + targetID + targetClass;
          var actionType = `type : ${event.type}, target : ${target}`;
        }

        var errMSG = JSON.parse(err.responseText).message;
        var errData = {
          content: `status:${err.status}, massage:${errMSG}`,
          url: `windowURL : ${EC$(location).attr("href")}, APIURL : ${url}`,
          actionType: actionType,
        };

        $.ajax({
          url: URL_ERROR_LOG_ADD,
          type: "POST",
          contentType: "application/json",
          dataType: "json",
          data: JSON.stringify(errData),
          success: function () {
            console.log("[" + actionType + "] 에러 전송 완료!", errMSG);
            clickFlag = true;
          },
          error: function (err) {
            console.log("[" + actionType + "] 에러 전송 실패!", err);
          },
        });

        alert(`${status} error.\n${message}`); // 에러메세지 호출
        clickFlag = true;
      }, // error

      success: function (data) {
        if (res) {
          res(data);
        }
        rej(new Error("error!"));
      },
    });
  });
}

// ===================================================================== 공통 함수 ============================================================================== //

/** ===============================================================================================================================================
 * 
 * 랜덤 번호 생성
 * - 배너매니저 등 사용할 경우 ord 변수가 이미 존재하여, 없는 경우에만 변수 생성하도록 정의
 */
if(typeof ord === 'undefind'){
    var ord=Math.random();
};
/* ================================================================================================================================================== */
/** ===============================================================================================================================================
 * 
 * IV$ 
 * - 이미 호출 중인 jQuery(1.4.4이상)가 있는 경우 추가 호출하지않고 사용 / 충족하지 않을f때만 jQuery 1.11.2버전을 로드합니다.
 * - ! jQuery v1.11.2 | (c) 2005, 2014 jQuery Foundation, Inc. | jquery.org/license
 * @IV$ {function} jQuery 충돌방지 별칭 
 */
var IV$;
try {
    ( IVCallJQuery = function(){
        if(typeof jQuery === 'undefined'){
            !function(e,t){"object"==typeof module&&"object"==typeof module.exports?module.exports=e.document?t(e,!0):function(e){if(!e.document)throw new Error("jQuery requires a window with a document");return t(e)}:t(e)}("undefined"!=typeof window?window:this,function(e,t){var n=[],r=n.slice,i=n.concat,o=n.push,a=n.indexOf,s={},l=s.toString,u=s.hasOwnProperty,c={},d="1.11.2",f=function(e,t){return new f.fn.init(e,t)},p=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,h=/^-ms-/,m=/-([\da-z])/gi,g=function(e,t){return t.toUpperCase()};function v(e){var t=e.length,n=f.type(e);return"function"!==n&&!f.isWindow(e)&&(!(1!==e.nodeType||!t)||("array"===n||0===t||"number"==typeof t&&t>0&&t-1 in e))}f.fn=f.prototype={jquery:d,constructor:f,selector:"",length:0,toArray:function(){return r.call(this)},get:function(e){return null!=e?0>e?this[e+this.length]:this[e]:r.call(this)},pushStack:function(e){var t=f.merge(this.constructor(),e);return t.prevObject=this,t.context=this.context,t},each:function(e,t){return f.each(this,e,t)},map:function(e){return this.pushStack(f.map(this,function(t,n){return e.call(t,n,t)}))},slice:function(){return this.pushStack(r.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(e){var t=this.length,n=+e+(0>e?t:0);return this.pushStack(n>=0&&t>n?[this[n]]:[])},end:function(){return this.prevObject||this.constructor(null)},push:o,sort:n.sort,splice:n.splice},f.extend=f.fn.extend=function(){var e,t,n,r,i,o,a=arguments[0]||{},s=1,l=arguments.length,u=!1;for("boolean"==typeof a&&(u=a,a=arguments[s]||{},s++),"object"==typeof a||f.isFunction(a)||(a={}),s===l&&(a=this,s--);l>s;s++)if(null!=(i=arguments[s]))for(r in i)e=a[r],a!==(n=i[r])&&(u&&n&&(f.isPlainObject(n)||(t=f.isArray(n)))?(t?(t=!1,o=e&&f.isArray(e)?e:[]):o=e&&f.isPlainObject(e)?e:{},a[r]=f.extend(u,o,n)):void 0!==n&&(a[r]=n));return a},f.extend({expando:"jQuery"+(d+Math.random()).replace(/\D/g,""),isReady:!0,error:function(e){throw new Error(e)},noop:function(){},isFunction:function(e){return"function"===f.type(e)},isArray:Array.isArray||function(e){return"array"===f.type(e)},isWindow:function(e){return null!=e&&e==e.window},isNumeric:function(e){return!f.isArray(e)&&e-parseFloat(e)+1>=0},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},isPlainObject:function(e){var t;if(!e||"object"!==f.type(e)||e.nodeType||f.isWindow(e))return!1;try{if(e.constructor&&!u.call(e,"constructor")&&!u.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(e){return!1}if(c.ownLast)for(t in e)return u.call(e,t);for(t in e);return void 0===t||u.call(e,t)},type:function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?s[l.call(e)]||"object":typeof e},globalEval:function(t){t&&f.trim(t)&&(e.execScript||function(t){e.eval.call(e,t)})(t)},camelCase:function(e){return e.replace(h,"ms-").replace(m,g)},nodeName:function(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()},each:function(e,t,n){var r=0,i=e.length,o=v(e);if(n){if(o)for(;i>r&&!1!==t.apply(e[r],n);r++);else for(r in e)if(!1===t.apply(e[r],n))break}else if(o)for(;i>r&&!1!==t.call(e[r],r,e[r]);r++);else for(r in e)if(!1===t.call(e[r],r,e[r]))break;return e},trim:function(e){return null==e?"":(e+"").replace(p,"")},makeArray:function(e,t){var n=t||[];return null!=e&&(v(Object(e))?f.merge(n,"string"==typeof e?[e]:e):o.call(n,e)),n},inArray:function(e,t,n){var r;if(t){if(a)return a.call(t,e,n);for(r=t.length,n=n?0>n?Math.max(0,r+n):n:0;r>n;n++)if(n in t&&t[n]===e)return n}return-1},merge:function(e,t){for(var n=+t.length,r=0,i=e.length;n>r;)e[i++]=t[r++];if(n!=n)for(;void 0!==t[r];)e[i++]=t[r++];return e.length=i,e},grep:function(e,t,n){for(var r=[],i=0,o=e.length,a=!n;o>i;i++)!t(e[i],i)!==a&&r.push(e[i]);return r},map:function(e,t,n){var r,o=0,a=e.length,s=[];if(v(e))for(;a>o;o++)null!=(r=t(e[o],o,n))&&s.push(r);else for(o in e)null!=(r=t(e[o],o,n))&&s.push(r);return i.apply([],s)},guid:1,proxy:function(e,t){var n,i,o;return"string"==typeof t&&(o=e[t],t=e,e=o),f.isFunction(e)?(n=r.call(arguments,2),(i=function(){return e.apply(t||this,n.concat(r.call(arguments)))}).guid=e.guid=e.guid||f.guid++,i):void 0},now:function(){return+new Date},support:c}),f.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(e,t){s["[object "+t+"]"]=t.toLowerCase()});var y=function(e){var t,n,r,i,o,a,s,l,u,c,d,f,p,h,m,g,v,y,b,x="sizzle"+1*new Date,w=e.document,T=0,C=0,N=ae(),E=ae(),k=ae(),S=function(e,t){return e===t&&(d=!0),0},A=1<<31,D={}.hasOwnProperty,j=[],L=j.pop,H=j.push,q=j.push,_=j.slice,M=function(e,t){for(var n=0,r=e.length;r>n;n++)if(e[n]===t)return n;return-1},F="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",O="[\\x20\\t\\r\\n\\f]",B="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",P=B.replace("w","w#"),R="\\["+O+"*("+B+")(?:"+O+"*([*^$|!~]?=)"+O+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+P+"))|)"+O+"*\\]",W=":("+B+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+R+")*)|.*)\\)|)",$=new RegExp(O+"+","g"),z=new RegExp("^"+O+"+|((?:^|[^\\\\])(?:\\\\.)*)"+O+"+$","g"),I=new RegExp("^"+O+"*,"+O+"*"),X=new RegExp("^"+O+"*([>+~]|"+O+")"+O+"*"),U=new RegExp("="+O+"*([^\\]'\"]*?)"+O+"*\\]","g"),V=new RegExp(W),J=new RegExp("^"+P+"$"),Y={ID:new RegExp("^#("+B+")"),CLASS:new RegExp("^\\.("+B+")"),TAG:new RegExp("^("+B.replace("w","w*")+")"),ATTR:new RegExp("^"+R),PSEUDO:new RegExp("^"+W),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+O+"*(even|odd|(([+-]|)(\\d*)n|)"+O+"*(?:([+-]|)"+O+"*(\\d+)|))"+O+"*\\)|)","i"),bool:new RegExp("^(?:"+F+")$","i"),needsContext:new RegExp("^"+O+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+O+"*((?:-\\d)?\\d*)"+O+"*\\)|)(?=[^-]|$)","i")},G=/^(?:input|select|textarea|button)$/i,Q=/^h\d$/i,K=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ee=/[+~]/,te=/'|\\/g,ne=new RegExp("\\\\([\\da-f]{1,6}"+O+"?|("+O+")|.)","ig"),re=function(e,t,n){var r="0x"+t-65536;return r!=r||n?t:0>r?String.fromCharCode(r+65536):String.fromCharCode(r>>10|55296,1023&r|56320)},ie=function(){f()};try{q.apply(j=_.call(w.childNodes),w.childNodes),j[w.childNodes.length].nodeType}catch(e){q={apply:j.length?function(e,t){H.apply(e,_.call(t))}:function(e,t){for(var n=e.length,r=0;e[n++]=t[r++];);e.length=n-1}}}function oe(e,t,r,i){var o,s,u,c,d,h,v,y,T,C;if((t?t.ownerDocument||t:w)!==p&&f(t),r=r||[],c=(t=t||p).nodeType,"string"!=typeof e||!e||1!==c&&9!==c&&11!==c)return r;if(!i&&m){if(11!==c&&(o=Z.exec(e)))if(u=o[1]){if(9===c){if(!(s=t.getElementById(u))||!s.parentNode)return r;if(s.id===u)return r.push(s),r}else if(t.ownerDocument&&(s=t.ownerDocument.getElementById(u))&&b(t,s)&&s.id===u)return r.push(s),r}else{if(o[2])return q.apply(r,t.getElementsByTagName(e)),r;if((u=o[3])&&n.getElementsByClassName)return q.apply(r,t.getElementsByClassName(u)),r}if(n.qsa&&(!g||!g.test(e))){if(y=v=x,T=t,C=1!==c&&e,1===c&&"object"!==t.nodeName.toLowerCase()){for(h=a(e),(v=t.getAttribute("id"))?y=v.replace(te,"\\$&"):t.setAttribute("id",y),y="[id='"+y+"'] ",d=h.length;d--;)h[d]=y+ge(h[d]);T=ee.test(e)&&he(t.parentNode)||t,C=h.join(",")}if(C)try{return q.apply(r,T.querySelectorAll(C)),r}catch(e){}finally{v||t.removeAttribute("id")}}}return l(e.replace(z,"$1"),t,r,i)}function ae(){var e=[];return function t(n,i){return e.push(n+" ")>r.cacheLength&&delete t[e.shift()],t[n+" "]=i}}function se(e){return e[x]=!0,e}function le(e){var t=p.createElement("div");try{return!!e(t)}catch(e){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function ue(e,t){for(var n=e.split("|"),i=e.length;i--;)r.attrHandle[n[i]]=t}function ce(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||A)-(~e.sourceIndex||A);if(r)return r;if(n)for(;n=n.nextSibling;)if(n===t)return-1;return e?1:-1}function de(e){return function(t){return"input"===t.nodeName.toLowerCase()&&t.type===e}}function fe(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function pe(e){return se(function(t){return t=+t,se(function(n,r){for(var i,o=e([],n.length,t),a=o.length;a--;)n[i=o[a]]&&(n[i]=!(r[i]=n[i]))})})}function he(e){return e&&void 0!==e.getElementsByTagName&&e}for(t in n=oe.support={},o=oe.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return!!t&&"HTML"!==t.nodeName},f=oe.setDocument=function(e){var t,i,a=e?e.ownerDocument||e:w;return a!==p&&9===a.nodeType&&a.documentElement?(p=a,h=a.documentElement,(i=a.defaultView)&&i!==i.top&&(i.addEventListener?i.addEventListener("unload",ie,!1):i.attachEvent&&i.attachEvent("onunload",ie)),m=!o(a),n.attributes=le(function(e){return e.className="i",!e.getAttribute("className")}),n.getElementsByTagName=le(function(e){return e.appendChild(a.createComment("")),!e.getElementsByTagName("*").length}),n.getElementsByClassName=K.test(a.getElementsByClassName),n.getById=le(function(e){return h.appendChild(e).id=x,!a.getElementsByName||!a.getElementsByName(x).length}),n.getById?(r.find.ID=function(e,t){if(void 0!==t.getElementById&&m){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){return e.getAttribute("id")===t}}):(delete r.find.ID,r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){var n=void 0!==e.getAttributeNode&&e.getAttributeNode("id");return n&&n.value===t}}),r.find.TAG=n.getElementsByTagName?function(e,t){return void 0!==t.getElementsByTagName?t.getElementsByTagName(e):n.qsa?t.querySelectorAll(e):void 0}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){for(;n=o[i++];)1===n.nodeType&&r.push(n);return r}return o},r.find.CLASS=n.getElementsByClassName&&function(e,t){return m?t.getElementsByClassName(e):void 0},v=[],g=[],(n.qsa=K.test(a.querySelectorAll))&&(le(function(e){h.appendChild(e).innerHTML="<a id='"+x+"'></a><select id='"+x+"-\f]' msallowcapture=''><option selected=''></option></select>",e.querySelectorAll("[msallowcapture^='']").length&&g.push("[*^$]="+O+"*(?:''|\"\")"),e.querySelectorAll("[selected]").length||g.push("\\["+O+"*(?:value|"+F+")"),e.querySelectorAll("[id~="+x+"-]").length||g.push("~="),e.querySelectorAll(":checked").length||g.push(":checked"),e.querySelectorAll("a#"+x+"+*").length||g.push(".#.+[+~]")}),le(function(e){var t=a.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("name","D"),e.querySelectorAll("[name=d]").length&&g.push("name"+O+"*[*^$|!~]?="),e.querySelectorAll(":enabled").length||g.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),g.push(",.*:")})),(n.matchesSelector=K.test(y=h.matches||h.webkitMatchesSelector||h.mozMatchesSelector||h.oMatchesSelector||h.msMatchesSelector))&&le(function(e){n.disconnectedMatch=y.call(e,"div"),y.call(e,"[s!='']:x"),v.push("!=",W)}),g=g.length&&new RegExp(g.join("|")),v=v.length&&new RegExp(v.join("|")),t=K.test(h.compareDocumentPosition),b=t||K.test(h.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)for(;t=t.parentNode;)if(t===e)return!0;return!1},S=t?function(e,t){if(e===t)return d=!0,0;var r=!e.compareDocumentPosition-!t.compareDocumentPosition;return r||(1&(r=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):1)||!n.sortDetached&&t.compareDocumentPosition(e)===r?e===a||e.ownerDocument===w&&b(w,e)?-1:t===a||t.ownerDocument===w&&b(w,t)?1:c?M(c,e)-M(c,t):0:4&r?-1:1)}:function(e,t){if(e===t)return d=!0,0;var n,r=0,i=e.parentNode,o=t.parentNode,s=[e],l=[t];if(!i||!o)return e===a?-1:t===a?1:i?-1:o?1:c?M(c,e)-M(c,t):0;if(i===o)return ce(e,t);for(n=e;n=n.parentNode;)s.unshift(n);for(n=t;n=n.parentNode;)l.unshift(n);for(;s[r]===l[r];)r++;return r?ce(s[r],l[r]):s[r]===w?-1:l[r]===w?1:0},a):p},oe.matches=function(e,t){return oe(e,null,null,t)},oe.matchesSelector=function(e,t){if((e.ownerDocument||e)!==p&&f(e),t=t.replace(U,"='$1']"),!(!n.matchesSelector||!m||v&&v.test(t)||g&&g.test(t)))try{var r=y.call(e,t);if(r||n.disconnectedMatch||e.document&&11!==e.document.nodeType)return r}catch(e){}return oe(t,p,null,[e]).length>0},oe.contains=function(e,t){return(e.ownerDocument||e)!==p&&f(e),b(e,t)},oe.attr=function(e,t){(e.ownerDocument||e)!==p&&f(e);var i=r.attrHandle[t.toLowerCase()],o=i&&D.call(r.attrHandle,t.toLowerCase())?i(e,t,!m):void 0;return void 0!==o?o:n.attributes||!m?e.getAttribute(t):(o=e.getAttributeNode(t))&&o.specified?o.value:null},oe.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},oe.uniqueSort=function(e){var t,r=[],i=0,o=0;if(d=!n.detectDuplicates,c=!n.sortStable&&e.slice(0),e.sort(S),d){for(;t=e[o++];)t===e[o]&&(i=r.push(o));for(;i--;)e.splice(r[i],1)}return c=null,e},i=oe.getText=function(e){var t,n="",r=0,o=e.nodeType;if(o){if(1===o||9===o||11===o){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=i(e)}else if(3===o||4===o)return e.nodeValue}else for(;t=e[r++];)n+=i(t);return n},(r=oe.selectors={cacheLength:50,createPseudo:se,match:Y,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(ne,re),e[3]=(e[3]||e[4]||e[5]||"").replace(ne,re),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||oe.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&oe.error(e[0]),e},PSEUDO:function(e){var t,n=!e[6]&&e[2];return Y.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&V.test(n)&&(t=a(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(ne,re).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=N[e+" "];return t||(t=new RegExp("(^|"+O+")"+e+"("+O+"|$)"))&&N(e,function(e){return t.test("string"==typeof e.className&&e.className||void 0!==e.getAttribute&&e.getAttribute("class")||"")})},ATTR:function(e,t,n){return function(r){var i=oe.attr(r,e);return null==i?"!="===t:!t||(i+="","="===t?i===n:"!="===t?i!==n:"^="===t?n&&0===i.indexOf(n):"*="===t?n&&i.indexOf(n)>-1:"$="===t?n&&i.slice(-n.length)===n:"~="===t?(" "+i.replace($," ")+" ").indexOf(n)>-1:"|="===t&&(i===n||i.slice(0,n.length+1)===n+"-"))}},CHILD:function(e,t,n,r,i){var o="nth"!==e.slice(0,3),a="last"!==e.slice(-4),s="of-type"===t;return 1===r&&0===i?function(e){return!!e.parentNode}:function(t,n,l){var u,c,d,f,p,h,m=o!==a?"nextSibling":"previousSibling",g=t.parentNode,v=s&&t.nodeName.toLowerCase(),y=!l&&!s;if(g){if(o){for(;m;){for(d=t;d=d[m];)if(s?d.nodeName.toLowerCase()===v:1===d.nodeType)return!1;h=m="only"===e&&!h&&"nextSibling"}return!0}if(h=[a?g.firstChild:g.lastChild],a&&y){for(p=(u=(c=g[x]||(g[x]={}))[e]||[])[0]===T&&u[1],f=u[0]===T&&u[2],d=p&&g.childNodes[p];d=++p&&d&&d[m]||(f=p=0)||h.pop();)if(1===d.nodeType&&++f&&d===t){c[e]=[T,p,f];break}}else if(y&&(u=(t[x]||(t[x]={}))[e])&&u[0]===T)f=u[1];else for(;(d=++p&&d&&d[m]||(f=p=0)||h.pop())&&((s?d.nodeName.toLowerCase()!==v:1!==d.nodeType)||!++f||(y&&((d[x]||(d[x]={}))[e]=[T,f]),d!==t)););return(f-=i)===r||f%r==0&&f/r>=0}}},PSEUDO:function(e,t){var n,i=r.pseudos[e]||r.setFilters[e.toLowerCase()]||oe.error("unsupported pseudo: "+e);return i[x]?i(t):i.length>1?(n=[e,e,"",t],r.setFilters.hasOwnProperty(e.toLowerCase())?se(function(e,n){for(var r,o=i(e,t),a=o.length;a--;)e[r=M(e,o[a])]=!(n[r]=o[a])}):function(e){return i(e,0,n)}):i}},pseudos:{not:se(function(e){var t=[],n=[],r=s(e.replace(z,"$1"));return r[x]?se(function(e,t,n,i){for(var o,a=r(e,null,i,[]),s=e.length;s--;)(o=a[s])&&(e[s]=!(t[s]=o))}):function(e,i,o){return t[0]=e,r(t,null,o,n),t[0]=null,!n.pop()}}),has:se(function(e){return function(t){return oe(e,t).length>0}}),contains:se(function(e){return e=e.replace(ne,re),function(t){return(t.textContent||t.innerText||i(t)).indexOf(e)>-1}}),lang:se(function(e){return J.test(e||"")||oe.error("unsupported lang: "+e),e=e.replace(ne,re).toLowerCase(),function(t){var n;do{if(n=m?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang"))return(n=n.toLowerCase())===e||0===n.indexOf(e+"-")}while((t=t.parentNode)&&1===t.nodeType);return!1}}),target:function(t){var n=e.location&&e.location.hash;return n&&n.slice(1)===t.id},root:function(e){return e===h},focus:function(e){return e===p.activeElement&&(!p.hasFocus||p.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return!1===e.disabled},disabled:function(e){return!0===e.disabled},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,!0===e.selected},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!r.pseudos.empty(e)},header:function(e){return Q.test(e.nodeName)},input:function(e){return G.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:pe(function(){return[0]}),last:pe(function(e,t){return[t-1]}),eq:pe(function(e,t,n){return[0>n?n+t:n]}),even:pe(function(e,t){for(var n=0;t>n;n+=2)e.push(n);return e}),odd:pe(function(e,t){for(var n=1;t>n;n+=2)e.push(n);return e}),lt:pe(function(e,t,n){for(var r=0>n?n+t:n;--r>=0;)e.push(r);return e}),gt:pe(function(e,t,n){for(var r=0>n?n+t:n;++r<t;)e.push(r);return e})}}).pseudos.nth=r.pseudos.eq,{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})r.pseudos[t]=de(t);for(t in{submit:!0,reset:!0})r.pseudos[t]=fe(t);function me(){}function ge(e){for(var t=0,n=e.length,r="";n>t;t++)r+=e[t].value;return r}function ve(e,t,n){var r=t.dir,i=n&&"parentNode"===r,o=C++;return t.first?function(t,n,o){for(;t=t[r];)if(1===t.nodeType||i)return e(t,n,o)}:function(t,n,a){var s,l,u=[T,o];if(a){for(;t=t[r];)if((1===t.nodeType||i)&&e(t,n,a))return!0}else for(;t=t[r];)if(1===t.nodeType||i){if((s=(l=t[x]||(t[x]={}))[r])&&s[0]===T&&s[1]===o)return u[2]=s[2];if(l[r]=u,u[2]=e(t,n,a))return!0}}}function ye(e){return e.length>1?function(t,n,r){for(var i=e.length;i--;)if(!e[i](t,n,r))return!1;return!0}:e[0]}function be(e,t,n,r,i){for(var o,a=[],s=0,l=e.length,u=null!=t;l>s;s++)(o=e[s])&&(!n||n(o,r,i))&&(a.push(o),u&&t.push(s));return a}function xe(e,t,n,r,i,o){return r&&!r[x]&&(r=xe(r)),i&&!i[x]&&(i=xe(i,o)),se(function(o,a,s,l){var u,c,d,f=[],p=[],h=a.length,m=o||function(e,t,n){for(var r=0,i=t.length;i>r;r++)oe(e,t[r],n);return n}(t||"*",s.nodeType?[s]:s,[]),g=!e||!o&&t?m:be(m,f,e,s,l),v=n?i||(o?e:h||r)?[]:a:g;if(n&&n(g,v,s,l),r)for(u=be(v,p),r(u,[],s,l),c=u.length;c--;)(d=u[c])&&(v[p[c]]=!(g[p[c]]=d));if(o){if(i||e){if(i){for(u=[],c=v.length;c--;)(d=v[c])&&u.push(g[c]=d);i(null,v=[],u,l)}for(c=v.length;c--;)(d=v[c])&&(u=i?M(o,d):f[c])>-1&&(o[u]=!(a[u]=d))}}else v=be(v===a?v.splice(h,v.length):v),i?i(null,a,v,l):q.apply(a,v)})}function we(e){for(var t,n,i,o=e.length,a=r.relative[e[0].type],s=a||r.relative[" "],l=a?1:0,c=ve(function(e){return e===t},s,!0),d=ve(function(e){return M(t,e)>-1},s,!0),f=[function(e,n,r){var i=!a&&(r||n!==u)||((t=n).nodeType?c(e,n,r):d(e,n,r));return t=null,i}];o>l;l++)if(n=r.relative[e[l].type])f=[ve(ye(f),n)];else{if((n=r.filter[e[l].type].apply(null,e[l].matches))[x]){for(i=++l;o>i&&!r.relative[e[i].type];i++);return xe(l>1&&ye(f),l>1&&ge(e.slice(0,l-1).concat({value:" "===e[l-2].type?"*":""})).replace(z,"$1"),n,i>l&&we(e.slice(l,i)),o>i&&we(e=e.slice(i)),o>i&&ge(e))}f.push(n)}return ye(f)}function Te(e,t){var n=t.length>0,i=e.length>0,o=function(o,a,s,l,c){var d,f,h,m=0,g="0",v=o&&[],y=[],b=u,x=o||i&&r.find.TAG("*",c),w=T+=null==b?1:Math.random()||.1,C=x.length;for(c&&(u=a!==p&&a);g!==C&&null!=(d=x[g]);g++){if(i&&d){for(f=0;h=e[f++];)if(h(d,a,s)){l.push(d);break}c&&(T=w)}n&&((d=!h&&d)&&m--,o&&v.push(d))}if(m+=g,n&&g!==m){for(f=0;h=t[f++];)h(v,y,a,s);if(o){if(m>0)for(;g--;)v[g]||y[g]||(y[g]=L.call(l));y=be(y)}q.apply(l,y),c&&!o&&y.length>0&&m+t.length>1&&oe.uniqueSort(l)}return c&&(T=w,u=b),v};return n?se(o):o}return me.prototype=r.filters=r.pseudos,r.setFilters=new me,a=oe.tokenize=function(e,t){var n,i,o,a,s,l,u,c=E[e+" "];if(c)return t?0:c.slice(0);for(s=e,l=[],u=r.preFilter;s;){for(a in(!n||(i=I.exec(s)))&&(i&&(s=s.slice(i[0].length)||s),l.push(o=[])),n=!1,(i=X.exec(s))&&(n=i.shift(),o.push({value:n,type:i[0].replace(z," ")}),s=s.slice(n.length)),r.filter)!(i=Y[a].exec(s))||u[a]&&!(i=u[a](i))||(n=i.shift(),o.push({value:n,type:a,matches:i}),s=s.slice(n.length));if(!n)break}return t?s.length:s?oe.error(e):E(e,l).slice(0)},s=oe.compile=function(e,t){var n,r=[],i=[],o=k[e+" "];if(!o){for(t||(t=a(e)),n=t.length;n--;)(o=we(t[n]))[x]?r.push(o):i.push(o);(o=k(e,Te(i,r))).selector=e}return o},l=oe.select=function(e,t,i,o){var l,u,c,d,f,p="function"==typeof e&&e,h=!o&&a(e=p.selector||e);if(i=i||[],1===h.length){if((u=h[0]=h[0].slice(0)).length>2&&"ID"===(c=u[0]).type&&n.getById&&9===t.nodeType&&m&&r.relative[u[1].type]){if(!(t=(r.find.ID(c.matches[0].replace(ne,re),t)||[])[0]))return i;p&&(t=t.parentNode),e=e.slice(u.shift().value.length)}for(l=Y.needsContext.test(e)?0:u.length;l--&&(c=u[l],!r.relative[d=c.type]);)if((f=r.find[d])&&(o=f(c.matches[0].replace(ne,re),ee.test(u[0].type)&&he(t.parentNode)||t))){if(u.splice(l,1),!(e=o.length&&ge(u)))return q.apply(i,o),i;break}}return(p||s(e,h))(o,t,!m,i,ee.test(e)&&he(t.parentNode)||t),i},n.sortStable=x.split("").sort(S).join("")===x,n.detectDuplicates=!!d,f(),n.sortDetached=le(function(e){return 1&e.compareDocumentPosition(p.createElement("div"))}),le(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||ue("type|href|height|width",function(e,t,n){return n?void 0:e.getAttribute(t,"type"===t.toLowerCase()?1:2)}),n.attributes&&le(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||ue("value",function(e,t,n){return n||"input"!==e.nodeName.toLowerCase()?void 0:e.defaultValue}),le(function(e){return null==e.getAttribute("disabled")})||ue(F,function(e,t,n){var r;return n?void 0:!0===e[t]?t.toLowerCase():(r=e.getAttributeNode(t))&&r.specified?r.value:null}),oe}(e);f.find=y,f.expr=y.selectors,f.expr[":"]=f.expr.pseudos,f.unique=y.uniqueSort,f.text=y.getText,f.isXMLDoc=y.isXML,f.contains=y.contains;var b=f.expr.match.needsContext,x=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,w=/^.[^:#\[\.,]*$/;function T(e,t,n){if(f.isFunction(t))return f.grep(e,function(e,r){return!!t.call(e,r,e)!==n});if(t.nodeType)return f.grep(e,function(e){return e===t!==n});if("string"==typeof t){if(w.test(t))return f.filter(t,e,n);t=f.filter(t,e)}return f.grep(e,function(e){return f.inArray(e,t)>=0!==n})}f.filter=function(e,t,n){var r=t[0];return n&&(e=":not("+e+")"),1===t.length&&1===r.nodeType?f.find.matchesSelector(r,e)?[r]:[]:f.find.matches(e,f.grep(t,function(e){return 1===e.nodeType}))},f.fn.extend({find:function(e){var t,n=[],r=this,i=r.length;if("string"!=typeof e)return this.pushStack(f(e).filter(function(){for(t=0;i>t;t++)if(f.contains(r[t],this))return!0}));for(t=0;i>t;t++)f.find(e,r[t],n);return(n=this.pushStack(i>1?f.unique(n):n)).selector=this.selector?this.selector+" "+e:e,n},filter:function(e){return this.pushStack(T(this,e||[],!1))},not:function(e){return this.pushStack(T(this,e||[],!0))},is:function(e){return!!T(this,"string"==typeof e&&b.test(e)?f(e):e||[],!1).length}});var C,N=e.document,E=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;(f.fn.init=function(e,t){var n,r;if(!e)return this;if("string"==typeof e){if(!(n="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:E.exec(e))||!n[1]&&t)return!t||t.jquery?(t||C).find(e):this.constructor(t).find(e);if(n[1]){if(t=t instanceof f?t[0]:t,f.merge(this,f.parseHTML(n[1],t&&t.nodeType?t.ownerDocument||t:N,!0)),x.test(n[1])&&f.isPlainObject(t))for(n in t)f.isFunction(this[n])?this[n](t[n]):this.attr(n,t[n]);return this}if((r=N.getElementById(n[2]))&&r.parentNode){if(r.id!==n[2])return C.find(e);this.length=1,this[0]=r}return this.context=N,this.selector=e,this}return e.nodeType?(this.context=this[0]=e,this.length=1,this):f.isFunction(e)?void 0!==C.ready?C.ready(e):e(f):(void 0!==e.selector&&(this.selector=e.selector,this.context=e.context),f.makeArray(e,this))}).prototype=f.fn,C=f(N);var k=/^(?:parents|prev(?:Until|All))/,S={children:!0,contents:!0,next:!0,prev:!0};function A(e,t){do{e=e[t]}while(e&&1!==e.nodeType);return e}f.extend({dir:function(e,t,n){for(var r=[],i=e[t];i&&9!==i.nodeType&&(void 0===n||1!==i.nodeType||!f(i).is(n));)1===i.nodeType&&r.push(i),i=i[t];return r},sibling:function(e,t){for(var n=[];e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n}}),f.fn.extend({has:function(e){var t,n=f(e,this),r=n.length;return this.filter(function(){for(t=0;r>t;t++)if(f.contains(this,n[t]))return!0})},closest:function(e,t){for(var n,r=0,i=this.length,o=[],a=b.test(e)||"string"!=typeof e?f(e,t||this.context):0;i>r;r++)for(n=this[r];n&&n!==t;n=n.parentNode)if(n.nodeType<11&&(a?a.index(n)>-1:1===n.nodeType&&f.find.matchesSelector(n,e))){o.push(n);break}return this.pushStack(o.length>1?f.unique(o):o)},index:function(e){return e?"string"==typeof e?f.inArray(this[0],f(e)):f.inArray(e.jquery?e[0]:e,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(e,t){return this.pushStack(f.unique(f.merge(this.get(),f(e,t))))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}}),f.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return f.dir(e,"parentNode")},parentsUntil:function(e,t,n){return f.dir(e,"parentNode",n)},next:function(e){return A(e,"nextSibling")},prev:function(e){return A(e,"previousSibling")},nextAll:function(e){return f.dir(e,"nextSibling")},prevAll:function(e){return f.dir(e,"previousSibling")},nextUntil:function(e,t,n){return f.dir(e,"nextSibling",n)},prevUntil:function(e,t,n){return f.dir(e,"previousSibling",n)},siblings:function(e){return f.sibling((e.parentNode||{}).firstChild,e)},children:function(e){return f.sibling(e.firstChild)},contents:function(e){return f.nodeName(e,"iframe")?e.contentDocument||e.contentWindow.document:f.merge([],e.childNodes)}},function(e,t){f.fn[e]=function(n,r){var i=f.map(this,t,n);return"Until"!==e.slice(-5)&&(r=n),r&&"string"==typeof r&&(i=f.filter(r,i)),this.length>1&&(S[e]||(i=f.unique(i)),k.test(e)&&(i=i.reverse())),this.pushStack(i)}});var D,j=/\S+/g,L={};function H(){N.addEventListener?(N.removeEventListener("DOMContentLoaded",q,!1),e.removeEventListener("load",q,!1)):(N.detachEvent("onreadystatechange",q),e.detachEvent("onload",q))}function q(){(N.addEventListener||"load"===event.type||"complete"===N.readyState)&&(H(),f.ready())}f.Callbacks=function(e){e="string"==typeof e?L[e]||function(e){var t=L[e]={};return f.each(e.match(j)||[],function(e,n){t[n]=!0}),t}(e):f.extend({},e);var t,n,r,i,o,a,s=[],l=!e.once&&[],u=function(d){for(n=e.memory&&d,r=!0,o=a||0,a=0,i=s.length,t=!0;s&&i>o;o++)if(!1===s[o].apply(d[0],d[1])&&e.stopOnFalse){n=!1;break}t=!1,s&&(l?l.length&&u(l.shift()):n?s=[]:c.disable())},c={add:function(){if(s){var r=s.length;!function t(n){f.each(n,function(n,r){var i=f.type(r);"function"===i?e.unique&&c.has(r)||s.push(r):r&&r.length&&"string"!==i&&t(r)})}(arguments),t?i=s.length:n&&(a=r,u(n))}return this},remove:function(){return s&&f.each(arguments,function(e,n){for(var r;(r=f.inArray(n,s,r))>-1;)s.splice(r,1),t&&(i>=r&&i--,o>=r&&o--)}),this},has:function(e){return e?f.inArray(e,s)>-1:!(!s||!s.length)},empty:function(){return s=[],i=0,this},disable:function(){return s=l=n=void 0,this},disabled:function(){return!s},lock:function(){return l=void 0,n||c.disable(),this},locked:function(){return!l},fireWith:function(e,n){return!s||r&&!l||(n=[e,(n=n||[]).slice?n.slice():n],t?l.push(n):u(n)),this},fire:function(){return c.fireWith(this,arguments),this},fired:function(){return!!r}};return c},f.extend({Deferred:function(e){var t=[["resolve","done",f.Callbacks("once memory"),"resolved"],["reject","fail",f.Callbacks("once memory"),"rejected"],["notify","progress",f.Callbacks("memory")]],n="pending",r={state:function(){return n},always:function(){return i.done(arguments).fail(arguments),this},then:function(){var e=arguments;return f.Deferred(function(n){f.each(t,function(t,o){var a=f.isFunction(e[t])&&e[t];i[o[1]](function(){var e=a&&a.apply(this,arguments);e&&f.isFunction(e.promise)?e.promise().done(n.resolve).fail(n.reject).progress(n.notify):n[o[0]+"With"](this===r?n.promise():this,a?[e]:arguments)})}),e=null}).promise()},promise:function(e){return null!=e?f.extend(e,r):r}},i={};return r.pipe=r.then,f.each(t,function(e,o){var a=o[2],s=o[3];r[o[1]]=a.add,s&&a.add(function(){n=s},t[1^e][2].disable,t[2][2].lock),i[o[0]]=function(){return i[o[0]+"With"](this===i?r:this,arguments),this},i[o[0]+"With"]=a.fireWith}),r.promise(i),e&&e.call(i,i),i},when:function(e){var t,n,i,o=0,a=r.call(arguments),s=a.length,l=1!==s||e&&f.isFunction(e.promise)?s:0,u=1===l?e:f.Deferred(),c=function(e,n,i){return function(o){n[e]=this,i[e]=arguments.length>1?r.call(arguments):o,i===t?u.notifyWith(n,i):--l||u.resolveWith(n,i)}};if(s>1)for(t=new Array(s),n=new Array(s),i=new Array(s);s>o;o++)a[o]&&f.isFunction(a[o].promise)?a[o].promise().done(c(o,i,a)).fail(u.reject).progress(c(o,n,t)):--l;return l||u.resolveWith(i,a),u.promise()}}),f.fn.ready=function(e){return f.ready.promise().done(e),this},f.extend({isReady:!1,readyWait:1,holdReady:function(e){e?f.readyWait++:f.ready(!0)},ready:function(e){if(!0===e?!--f.readyWait:!f.isReady){if(!N.body)return setTimeout(f.ready);f.isReady=!0,!0!==e&&--f.readyWait>0||(D.resolveWith(N,[f]),f.fn.triggerHandler&&(f(N).triggerHandler("ready"),f(N).off("ready")))}}}),f.ready.promise=function(t){if(!D)if(D=f.Deferred(),"complete"===N.readyState)setTimeout(f.ready);else if(N.addEventListener)N.addEventListener("DOMContentLoaded",q,!1),e.addEventListener("load",q,!1);else{N.attachEvent("onreadystatechange",q),e.attachEvent("onload",q);var n=!1;try{n=null==e.frameElement&&N.documentElement}catch(e){}n&&n.doScroll&&function e(){if(!f.isReady){try{n.doScroll("left")}catch(t){return setTimeout(e,50)}H(),f.ready()}}()}return D.promise(t)};var _,M="undefined";for(_ in f(c))break;c.ownLast="0"!==_,c.inlineBlockNeedsLayout=!1,f(function(){var e,t,n,r;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",c.inlineBlockNeedsLayout=e=3===t.offsetWidth,e&&(n.style.zoom=1)),n.removeChild(r))}),function(){var e=N.createElement("div");if(null==c.deleteExpando){c.deleteExpando=!0;try{delete e.test}catch(e){c.deleteExpando=!1}}e=null}(),f.acceptData=function(e){var t=f.noData[(e.nodeName+" ").toLowerCase()],n=+e.nodeType||1;return(1===n||9===n)&&(!t||!0!==t&&e.getAttribute("classid")===t)};var F=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,O=/([A-Z])/g;function B(e,t,n){if(void 0===n&&1===e.nodeType){var r="data-"+t.replace(O,"-$1").toLowerCase();if("string"==typeof(n=e.getAttribute(r))){try{n="true"===n||"false"!==n&&("null"===n?null:+n+""===n?+n:F.test(n)?f.parseJSON(n):n)}catch(e){}f.data(e,t,n)}else n=void 0}return n}function P(e){var t;for(t in e)if(("data"!==t||!f.isEmptyObject(e[t]))&&"toJSON"!==t)return!1;return!0}function R(e,t,r,i){if(f.acceptData(e)){var o,a,s=f.expando,l=e.nodeType,u=l?f.cache:e,c=l?e[s]:e[s]&&s;if(c&&u[c]&&(i||u[c].data)||void 0!==r||"string"!=typeof t)return c||(c=l?e[s]=n.pop()||f.guid++:s),u[c]||(u[c]=l?{}:{toJSON:f.noop}),("object"==typeof t||"function"==typeof t)&&(i?u[c]=f.extend(u[c],t):u[c].data=f.extend(u[c].data,t)),a=u[c],i||(a.data||(a.data={}),a=a.data),void 0!==r&&(a[f.camelCase(t)]=r),"string"==typeof t?null==(o=a[t])&&(o=a[f.camelCase(t)]):o=a,o}}function W(e,t,n){if(f.acceptData(e)){var r,i,o=e.nodeType,a=o?f.cache:e,s=o?e[f.expando]:f.expando;if(a[s]){if(t&&(r=n?a[s]:a[s].data)){f.isArray(t)?t=t.concat(f.map(t,f.camelCase)):t in r?t=[t]:t=(t=f.camelCase(t))in r?[t]:t.split(" "),i=t.length;for(;i--;)delete r[t[i]];if(n?!P(r):!f.isEmptyObject(r))return}(n||(delete a[s].data,P(a[s])))&&(o?f.cleanData([e],!0):c.deleteExpando||a!=a.window?delete a[s]:a[s]=null)}}}f.extend({cache:{},noData:{"applet ":!0,"embed ":!0,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(e){return!!(e=e.nodeType?f.cache[e[f.expando]]:e[f.expando])&&!P(e)},data:function(e,t,n){return R(e,t,n)},removeData:function(e,t){return W(e,t)},_data:function(e,t,n){return R(e,t,n,!0)},_removeData:function(e,t){return W(e,t,!0)}}),f.fn.extend({data:function(e,t){var n,r,i,o=this[0],a=o&&o.attributes;if(void 0===e){if(this.length&&(i=f.data(o),1===o.nodeType&&!f._data(o,"parsedAttrs"))){for(n=a.length;n--;)a[n]&&(0===(r=a[n].name).indexOf("data-")&&B(o,r=f.camelCase(r.slice(5)),i[r]));f._data(o,"parsedAttrs",!0)}return i}return"object"==typeof e?this.each(function(){f.data(this,e)}):arguments.length>1?this.each(function(){f.data(this,e,t)}):o?B(o,e,f.data(o,e)):void 0},removeData:function(e){return this.each(function(){f.removeData(this,e)})}}),f.extend({queue:function(e,t,n){var r;return e?(t=(t||"fx")+"queue",r=f._data(e,t),n&&(!r||f.isArray(n)?r=f._data(e,t,f.makeArray(n)):r.push(n)),r||[]):void 0},dequeue:function(e,t){t=t||"fx";var n=f.queue(e,t),r=n.length,i=n.shift(),o=f._queueHooks(e,t);"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,function(){f.dequeue(e,t)},o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return f._data(e,n)||f._data(e,n,{empty:f.Callbacks("once memory").add(function(){f._removeData(e,t+"queue"),f._removeData(e,n)})})}}),f.fn.extend({queue:function(e,t){var n=2;return"string"!=typeof e&&(t=e,e="fx",n--),arguments.length<n?f.queue(this[0],e):void 0===t?this:this.each(function(){var n=f.queue(this,e,t);f._queueHooks(this,e),"fx"===e&&"inprogress"!==n[0]&&f.dequeue(this,e)})},dequeue:function(e){return this.each(function(){f.dequeue(this,e)})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,t){var n,r=1,i=f.Deferred(),o=this,a=this.length,s=function(){--r||i.resolveWith(o,[o])};for("string"!=typeof e&&(t=e,e=void 0),e=e||"fx";a--;)(n=f._data(o[a],e+"queueHooks"))&&n.empty&&(r++,n.empty.add(s));return s(),i.promise(t)}});var $=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,z=["Top","Right","Bottom","Left"],I=function(e,t){return e=t||e,"none"===f.css(e,"display")||!f.contains(e.ownerDocument,e)},X=f.access=function(e,t,n,r,i,o,a){var s=0,l=e.length,u=null==n;if("object"===f.type(n))for(s in i=!0,n)f.access(e,t,s,n[s],!0,o,a);else if(void 0!==r&&(i=!0,f.isFunction(r)||(a=!0),u&&(a?(t.call(e,r),t=null):(u=t,t=function(e,t,n){return u.call(f(e),n)})),t))for(;l>s;s++)t(e[s],n,a?r:r.call(e[s],s,t(e[s],n)));return i?e:u?t.call(e):l?t(e[0],n):o},U=/^(?:checkbox|radio)$/i;!function(){var e=N.createElement("input"),t=N.createElement("div"),n=N.createDocumentFragment();if(t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",c.leadingWhitespace=3===t.firstChild.nodeType,c.tbody=!t.getElementsByTagName("tbody").length,c.htmlSerialize=!!t.getElementsByTagName("link").length,c.html5Clone="<:nav></:nav>"!==N.createElement("nav").cloneNode(!0).outerHTML,e.type="checkbox",e.checked=!0,n.appendChild(e),c.appendChecked=e.checked,t.innerHTML="<textarea>x</textarea>",c.noCloneChecked=!!t.cloneNode(!0).lastChild.defaultValue,n.appendChild(t),t.innerHTML="<input type='radio' checked='checked' name='t'/>",c.checkClone=t.cloneNode(!0).cloneNode(!0).lastChild.checked,c.noCloneEvent=!0,t.attachEvent&&(t.attachEvent("onclick",function(){c.noCloneEvent=!1}),t.cloneNode(!0).click()),null==c.deleteExpando){c.deleteExpando=!0;try{delete t.test}catch(e){c.deleteExpando=!1}}}(),function(){var t,n,r=N.createElement("div");for(t in{submit:!0,change:!0,focusin:!0})n="on"+t,(c[t+"Bubbles"]=n in e)||(r.setAttribute(n,"t"),c[t+"Bubbles"]=!1===r.attributes[n].expando);r=null}();var V=/^(?:input|select|textarea)$/i,J=/^key/,Y=/^(?:mouse|pointer|contextmenu)|click/,G=/^(?:focusinfocus|focusoutblur)$/,Q=/^([^.]*)(?:\.(.+)|)$/;function K(){return!0}function Z(){return!1}function ee(){try{return N.activeElement}catch(e){}}function te(e){var t=ne.split("|"),n=e.createDocumentFragment();if(n.createElement)for(;t.length;)n.createElement(t.pop());return n}f.event={global:{},add:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f._data(e);if(v){for(n.handler&&(n=(l=n).handler,i=l.selector),n.guid||(n.guid=f.guid++),(a=v.events)||(a=v.events={}),(c=v.handle)||((c=v.handle=function(e){return typeof f===M||e&&f.event.triggered===e.type?void 0:f.event.dispatch.apply(c.elem,arguments)}).elem=e),s=(t=(t||"").match(j)||[""]).length;s--;)h=g=(o=Q.exec(t[s])||[])[1],m=(o[2]||"").split(".").sort(),h&&(u=f.event.special[h]||{},h=(i?u.delegateType:u.bindType)||h,u=f.event.special[h]||{},d=f.extend({type:h,origType:g,data:r,handler:n,guid:n.guid,selector:i,needsContext:i&&f.expr.match.needsContext.test(i),namespace:m.join(".")},l),(p=a[h])||((p=a[h]=[]).delegateCount=0,u.setup&&!1!==u.setup.call(e,r,m,c)||(e.addEventListener?e.addEventListener(h,c,!1):e.attachEvent&&e.attachEvent("on"+h,c))),u.add&&(u.add.call(e,d),d.handler.guid||(d.handler.guid=n.guid)),i?p.splice(p.delegateCount++,0,d):p.push(d),f.event.global[h]=!0);e=null}},remove:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f.hasData(e)&&f._data(e);if(v&&(c=v.events)){for(u=(t=(t||"").match(j)||[""]).length;u--;)if(h=g=(s=Q.exec(t[u])||[])[1],m=(s[2]||"").split(".").sort(),h){for(d=f.event.special[h]||{},p=c[h=(r?d.delegateType:d.bindType)||h]||[],s=s[2]&&new RegExp("(^|\\.)"+m.join("\\.(?:.*\\.|)")+"(\\.|$)"),l=o=p.length;o--;)a=p[o],!i&&g!==a.origType||n&&n.guid!==a.guid||s&&!s.test(a.namespace)||r&&r!==a.selector&&("**"!==r||!a.selector)||(p.splice(o,1),a.selector&&p.delegateCount--,d.remove&&d.remove.call(e,a));l&&!p.length&&(d.teardown&&!1!==d.teardown.call(e,m,v.handle)||f.removeEvent(e,h,v.handle),delete c[h])}else for(h in c)f.event.remove(e,h+t[u],n,r,!0);f.isEmptyObject(c)&&(delete v.handle,f._removeData(e,"events"))}},trigger:function(t,n,r,i){var o,a,s,l,c,d,p,h=[r||N],m=u.call(t,"type")?t.type:t,g=u.call(t,"namespace")?t.namespace.split("."):[];if(s=d=r=r||N,3!==r.nodeType&&8!==r.nodeType&&!G.test(m+f.event.triggered)&&(m.indexOf(".")>=0&&(g=m.split("."),m=g.shift(),g.sort()),a=m.indexOf(":")<0&&"on"+m,(t=t[f.expando]?t:new f.Event(m,"object"==typeof t&&t)).isTrigger=i?2:3,t.namespace=g.join("."),t.namespace_re=t.namespace?new RegExp("(^|\\.)"+g.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,t.result=void 0,t.target||(t.target=r),n=null==n?[t]:f.makeArray(n,[t]),c=f.event.special[m]||{},i||!c.trigger||!1!==c.trigger.apply(r,n))){if(!i&&!c.noBubble&&!f.isWindow(r)){for(l=c.delegateType||m,G.test(l+m)||(s=s.parentNode);s;s=s.parentNode)h.push(s),d=s;d===(r.ownerDocument||N)&&h.push(d.defaultView||d.parentWindow||e)}for(p=0;(s=h[p++])&&!t.isPropagationStopped();)t.type=p>1?l:c.bindType||m,(o=(f._data(s,"events")||{})[t.type]&&f._data(s,"handle"))&&o.apply(s,n),(o=a&&s[a])&&o.apply&&f.acceptData(s)&&(t.result=o.apply(s,n),!1===t.result&&t.preventDefault());if(t.type=m,!i&&!t.isDefaultPrevented()&&(!c._default||!1===c._default.apply(h.pop(),n))&&f.acceptData(r)&&a&&r[m]&&!f.isWindow(r)){(d=r[a])&&(r[a]=null),f.event.triggered=m;try{r[m]()}catch(e){}f.event.triggered=void 0,d&&(r[a]=d)}return t.result}},dispatch:function(e){e=f.event.fix(e);var t,n,i,o,a,s=[],l=r.call(arguments),u=(f._data(this,"events")||{})[e.type]||[],c=f.event.special[e.type]||{};if(l[0]=e,e.delegateTarget=this,!c.preDispatch||!1!==c.preDispatch.call(this,e)){for(s=f.event.handlers.call(this,e,u),t=0;(o=s[t++])&&!e.isPropagationStopped();)for(e.currentTarget=o.elem,a=0;(i=o.handlers[a++])&&!e.isImmediatePropagationStopped();)(!e.namespace_re||e.namespace_re.test(i.namespace))&&(e.handleObj=i,e.data=i.data,void 0!==(n=((f.event.special[i.origType]||{}).handle||i.handler).apply(o.elem,l))&&!1===(e.result=n)&&(e.preventDefault(),e.stopPropagation()));return c.postDispatch&&c.postDispatch.call(this,e),e.result}},handlers:function(e,t){var n,r,i,o,a=[],s=t.delegateCount,l=e.target;if(s&&l.nodeType&&(!e.button||"click"!==e.type))for(;l!=this;l=l.parentNode||this)if(1===l.nodeType&&(!0!==l.disabled||"click"!==e.type)){for(i=[],o=0;s>o;o++)void 0===i[n=(r=t[o]).selector+" "]&&(i[n]=r.needsContext?f(n,this).index(l)>=0:f.find(n,this,null,[l]).length),i[n]&&i.push(r);i.length&&a.push({elem:l,handlers:i})}return s<t.length&&a.push({elem:this,handlers:t.slice(s)}),a},fix:function(e){if(e[f.expando])return e;var t,n,r,i=e.type,o=e,a=this.fixHooks[i];for(a||(this.fixHooks[i]=a=Y.test(i)?this.mouseHooks:J.test(i)?this.keyHooks:{}),r=a.props?this.props.concat(a.props):this.props,e=new f.Event(o),t=r.length;t--;)e[n=r[t]]=o[n];return e.target||(e.target=o.srcElement||N),3===e.target.nodeType&&(e.target=e.target.parentNode),e.metaKey=!!e.metaKey,a.filter?a.filter(e,o):e},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(e,t){return null==e.which&&(e.which=null!=t.charCode?t.charCode:t.keyCode),e}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(e,t){var n,r,i,o=t.button,a=t.fromElement;return null==e.pageX&&null!=t.clientX&&(i=(r=e.target.ownerDocument||N).documentElement,n=r.body,e.pageX=t.clientX+(i&&i.scrollLeft||n&&n.scrollLeft||0)-(i&&i.clientLeft||n&&n.clientLeft||0),e.pageY=t.clientY+(i&&i.scrollTop||n&&n.scrollTop||0)-(i&&i.clientTop||n&&n.clientTop||0)),!e.relatedTarget&&a&&(e.relatedTarget=a===e.target?t.toElement:a),e.which||void 0===o||(e.which=1&o?1:2&o?3:4&o?2:0),e}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==ee()&&this.focus)try{return this.focus(),!1}catch(e){}},delegateType:"focusin"},blur:{trigger:function(){return this===ee()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return f.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):void 0},_default:function(e){return f.nodeName(e.target,"a")}},beforeunload:{postDispatch:function(e){void 0!==e.result&&e.originalEvent&&(e.originalEvent.returnValue=e.result)}}},simulate:function(e,t,n,r){var i=f.extend(new f.Event,n,{type:e,isSimulated:!0,originalEvent:{}});r?f.event.trigger(i,null,t):f.event.dispatch.call(t,i),i.isDefaultPrevented()&&n.preventDefault()}},f.removeEvent=N.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var r="on"+t;e.detachEvent&&(typeof e[r]===M&&(e[r]=null),e.detachEvent(r,n))},f.Event=function(e,t){return this instanceof f.Event?(e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||void 0===e.defaultPrevented&&!1===e.returnValue?K:Z):this.type=e,t&&f.extend(this,t),this.timeStamp=e&&e.timeStamp||f.now(),void(this[f.expando]=!0)):new f.Event(e,t)},f.Event.prototype={isDefaultPrevented:Z,isPropagationStopped:Z,isImmediatePropagationStopped:Z,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=K,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=K,e&&(e.stopPropagation&&e.stopPropagation(),e.cancelBubble=!0)},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=K,e&&e.stopImmediatePropagation&&e.stopImmediatePropagation(),this.stopPropagation()}},f.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(e,t){f.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,r=e.relatedTarget,i=e.handleObj;return(!r||r!==this&&!f.contains(this,r))&&(e.type=i.origType,n=i.handler.apply(this,arguments),e.type=t),n}}}),c.submitBubbles||(f.event.special.submit={setup:function(){return!f.nodeName(this,"form")&&void f.event.add(this,"click._submit keypress._submit",function(e){var t=e.target,n=f.nodeName(t,"input")||f.nodeName(t,"button")?t.form:void 0;n&&!f._data(n,"submitBubbles")&&(f.event.add(n,"submit._submit",function(e){e._submit_bubble=!0}),f._data(n,"submitBubbles",!0))})},postDispatch:function(e){e._submit_bubble&&(delete e._submit_bubble,this.parentNode&&!e.isTrigger&&f.event.simulate("submit",this.parentNode,e,!0))},teardown:function(){return!f.nodeName(this,"form")&&void f.event.remove(this,"._submit")}}),c.changeBubbles||(f.event.special.change={setup:function(){return V.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(f.event.add(this,"propertychange._change",function(e){"checked"===e.originalEvent.propertyName&&(this._just_changed=!0)}),f.event.add(this,"click._change",function(e){this._just_changed&&!e.isTrigger&&(this._just_changed=!1),f.event.simulate("change",this,e,!0)})),!1):void f.event.add(this,"beforeactivate._change",function(e){var t=e.target;V.test(t.nodeName)&&!f._data(t,"changeBubbles")&&(f.event.add(t,"change._change",function(e){!this.parentNode||e.isSimulated||e.isTrigger||f.event.simulate("change",this.parentNode,e,!0)}),f._data(t,"changeBubbles",!0))})},handle:function(e){var t=e.target;return this!==t||e.isSimulated||e.isTrigger||"radio"!==t.type&&"checkbox"!==t.type?e.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return f.event.remove(this,"._change"),!V.test(this.nodeName)}}),c.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(e,t){var n=function(e){f.event.simulate(t,e.target,f.event.fix(e),!0)};f.event.special[t]={setup:function(){var r=this.ownerDocument||this,i=f._data(r,t);i||r.addEventListener(e,n,!0),f._data(r,t,(i||0)+1)},teardown:function(){var r=this.ownerDocument||this,i=f._data(r,t)-1;i?f._data(r,t,i):(r.removeEventListener(e,n,!0),f._removeData(r,t))}}}),f.fn.extend({on:function(e,t,n,r,i){var o,a;if("object"==typeof e){for(o in"string"!=typeof t&&(n=n||t,t=void 0),e)this.on(o,t,n,e[o],i);return this}if(null==n&&null==r?(r=t,n=t=void 0):null==r&&("string"==typeof t?(r=n,n=void 0):(r=n,n=t,t=void 0)),!1===r)r=Z;else if(!r)return this;return 1===i&&(a=r,(r=function(e){return f().off(e),a.apply(this,arguments)}).guid=a.guid||(a.guid=f.guid++)),this.each(function(){f.event.add(this,e,r,n,t)})},one:function(e,t,n,r){return this.on(e,t,n,r,1)},off:function(e,t,n){var r,i;if(e&&e.preventDefault&&e.handleObj)return r=e.handleObj,f(e.delegateTarget).off(r.namespace?r.origType+"."+r.namespace:r.origType,r.selector,r.handler),this;if("object"==typeof e){for(i in e)this.off(i,t,e[i]);return this}return(!1===t||"function"==typeof t)&&(n=t,t=void 0),!1===n&&(n=Z),this.each(function(){f.event.remove(this,e,n,t)})},trigger:function(e,t){return this.each(function(){f.event.trigger(e,t,this)})},triggerHandler:function(e,t){var n=this[0];return n?f.event.trigger(e,t,n,!0):void 0}});var ne="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",re=/ jQuery\d+="(?:null|\d+)"/g,ie=new RegExp("<(?:"+ne+")[\\s/>]","i"),oe=/^\s+/,ae=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,se=/<([\w:]+)/,le=/<tbody/i,ue=/<|&#?\w+;/,ce=/<(?:script|style|link)/i,de=/checked\s*(?:[^=]|=\s*.checked.)/i,fe=/^$|\/(?:java|ecma)script/i,pe=/^true\/(.*)/,he=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,me={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:c.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},ge=te(N).appendChild(N.createElement("div"));function ve(e,t){var n,r,i=0,o=typeof e.getElementsByTagName!==M?e.getElementsByTagName(t||"*"):typeof e.querySelectorAll!==M?e.querySelectorAll(t||"*"):void 0;if(!o)for(o=[],n=e.childNodes||e;null!=(r=n[i]);i++)!t||f.nodeName(r,t)?o.push(r):f.merge(o,ve(r,t));return void 0===t||t&&f.nodeName(e,t)?f.merge([e],o):o}function ye(e){U.test(e.type)&&(e.defaultChecked=e.checked)}function be(e,t){return f.nodeName(e,"table")&&f.nodeName(11!==t.nodeType?t:t.firstChild,"tr")?e.getElementsByTagName("tbody")[0]||e.appendChild(e.ownerDocument.createElement("tbody")):e}function xe(e){return e.type=(null!==f.find.attr(e,"type"))+"/"+e.type,e}function we(e){var t=pe.exec(e.type);return t?e.type=t[1]:e.removeAttribute("type"),e}function Te(e,t){for(var n,r=0;null!=(n=e[r]);r++)f._data(n,"globalEval",!t||f._data(t[r],"globalEval"))}function Ce(e,t){if(1===t.nodeType&&f.hasData(e)){var n,r,i,o=f._data(e),a=f._data(t,o),s=o.events;if(s)for(n in delete a.handle,a.events={},s)for(r=0,i=s[n].length;i>r;r++)f.event.add(t,n,s[n][r]);a.data&&(a.data=f.extend({},a.data))}}function Ne(e,t){var n,r,i;if(1===t.nodeType){if(n=t.nodeName.toLowerCase(),!c.noCloneEvent&&t[f.expando]){for(r in(i=f._data(t)).events)f.removeEvent(t,r,i.handle);t.removeAttribute(f.expando)}"script"===n&&t.text!==e.text?(xe(t).text=e.text,we(t)):"object"===n?(t.parentNode&&(t.outerHTML=e.outerHTML),c.html5Clone&&e.innerHTML&&!f.trim(t.innerHTML)&&(t.innerHTML=e.innerHTML)):"input"===n&&U.test(e.type)?(t.defaultChecked=t.checked=e.checked,t.value!==e.value&&(t.value=e.value)):"option"===n?t.defaultSelected=t.selected=e.defaultSelected:("input"===n||"textarea"===n)&&(t.defaultValue=e.defaultValue)}}me.optgroup=me.option,me.tbody=me.tfoot=me.colgroup=me.caption=me.thead,me.th=me.td,f.extend({clone:function(e,t,n){var r,i,o,a,s,l=f.contains(e.ownerDocument,e);if(c.html5Clone||f.isXMLDoc(e)||!ie.test("<"+e.nodeName+">")?o=e.cloneNode(!0):(ge.innerHTML=e.outerHTML,ge.removeChild(o=ge.firstChild)),!(c.noCloneEvent&&c.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||f.isXMLDoc(e)))for(r=ve(o),s=ve(e),a=0;null!=(i=s[a]);++a)r[a]&&Ne(i,r[a]);if(t)if(n)for(s=s||ve(e),r=r||ve(o),a=0;null!=(i=s[a]);a++)Ce(i,r[a]);else Ce(e,o);return(r=ve(o,"script")).length>0&&Te(r,!l&&ve(e,"script")),r=s=i=null,o},buildFragment:function(e,t,n,r){for(var i,o,a,s,l,u,d,p=e.length,h=te(t),m=[],g=0;p>g;g++)if((o=e[g])||0===o)if("object"===f.type(o))f.merge(m,o.nodeType?[o]:o);else if(ue.test(o)){for(s=s||h.appendChild(t.createElement("div")),l=(se.exec(o)||["",""])[1].toLowerCase(),d=me[l]||me._default,s.innerHTML=d[1]+o.replace(ae,"<$1></$2>")+d[2],i=d[0];i--;)s=s.lastChild;if(!c.leadingWhitespace&&oe.test(o)&&m.push(t.createTextNode(oe.exec(o)[0])),!c.tbody)for(i=(o="table"!==l||le.test(o)?"<table>"!==d[1]||le.test(o)?0:s:s.firstChild)&&o.childNodes.length;i--;)f.nodeName(u=o.childNodes[i],"tbody")&&!u.childNodes.length&&o.removeChild(u);for(f.merge(m,s.childNodes),s.textContent="";s.firstChild;)s.removeChild(s.firstChild);s=h.lastChild}else m.push(t.createTextNode(o));for(s&&h.removeChild(s),c.appendChecked||f.grep(ve(m,"input"),ye),g=0;o=m[g++];)if((!r||-1===f.inArray(o,r))&&(a=f.contains(o.ownerDocument,o),s=ve(h.appendChild(o),"script"),a&&Te(s),n))for(i=0;o=s[i++];)fe.test(o.type||"")&&n.push(o);return s=null,h},cleanData:function(e,t){for(var r,i,o,a,s=0,l=f.expando,u=f.cache,d=c.deleteExpando,p=f.event.special;null!=(r=e[s]);s++)if((t||f.acceptData(r))&&(a=(o=r[l])&&u[o])){if(a.events)for(i in a.events)p[i]?f.event.remove(r,i):f.removeEvent(r,i,a.handle);u[o]&&(delete u[o],d?delete r[l]:typeof r.removeAttribute!==M?r.removeAttribute(l):r[l]=null,n.push(o))}}}),f.fn.extend({text:function(e){return X(this,function(e){return void 0===e?f.text(this):this.empty().append((this[0]&&this[0].ownerDocument||N).createTextNode(e))},null,e,arguments.length)},append:function(){return this.domManip(arguments,function(e){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||be(this,e).appendChild(e)})},prepend:function(){return this.domManip(arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=be(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this)})},after:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this.nextSibling)})},remove:function(e,t){for(var n,r=e?f.filter(e,this):this,i=0;null!=(n=r[i]);i++)t||1!==n.nodeType||f.cleanData(ve(n)),n.parentNode&&(t&&f.contains(n.ownerDocument,n)&&Te(ve(n,"script")),n.parentNode.removeChild(n));return this},empty:function(){for(var e,t=0;null!=(e=this[t]);t++){for(1===e.nodeType&&f.cleanData(ve(e,!1));e.firstChild;)e.removeChild(e.firstChild);e.options&&f.nodeName(e,"select")&&(e.options.length=0)}return this},clone:function(e,t){return e=null!=e&&e,t=null==t?e:t,this.map(function(){return f.clone(this,e,t)})},html:function(e){return X(this,function(e){var t=this[0]||{},n=0,r=this.length;if(void 0===e)return 1===t.nodeType?t.innerHTML.replace(re,""):void 0;if(!("string"!=typeof e||ce.test(e)||!c.htmlSerialize&&ie.test(e)||!c.leadingWhitespace&&oe.test(e)||me[(se.exec(e)||["",""])[1].toLowerCase()])){e=e.replace(ae,"<$1></$2>");try{for(;r>n;n++)1===(t=this[n]||{}).nodeType&&(f.cleanData(ve(t,!1)),t.innerHTML=e);t=0}catch(e){}}t&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(){var e=arguments[0];return this.domManip(arguments,function(t){e=this.parentNode,f.cleanData(ve(this)),e&&e.replaceChild(t,this)}),e&&(e.length||e.nodeType)?this:this.remove()},detach:function(e){return this.remove(e,!0)},domManip:function(e,t){e=i.apply([],e);var n,r,o,a,s,l,u=0,d=this.length,p=this,h=d-1,m=e[0],g=f.isFunction(m);if(g||d>1&&"string"==typeof m&&!c.checkClone&&de.test(m))return this.each(function(n){var r=p.eq(n);g&&(e[0]=m.call(this,n,r.html())),r.domManip(e,t)});if(d&&(n=(l=f.buildFragment(e,this[0].ownerDocument,!1,this)).firstChild,1===l.childNodes.length&&(l=n),n)){for(o=(a=f.map(ve(l,"script"),xe)).length;d>u;u++)r=l,u!==h&&(r=f.clone(r,!0,!0),o&&f.merge(a,ve(r,"script"))),t.call(this[u],r,u);if(o)for(s=a[a.length-1].ownerDocument,f.map(a,we),u=0;o>u;u++)r=a[u],fe.test(r.type||"")&&!f._data(r,"globalEval")&&f.contains(s,r)&&(r.src?f._evalUrl&&f._evalUrl(r.src):f.globalEval((r.text||r.textContent||r.innerHTML||"").replace(he,"")));l=n=null}return this}}),f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){f.fn[e]=function(e){for(var n,r=0,i=[],a=f(e),s=a.length-1;s>=r;r++)n=r===s?this:this.clone(!0),f(a[r])[t](n),o.apply(i,n.get());return this.pushStack(i)}});var Ee,ke={};function Se(t,n){var r,i=f(n.createElement(t)).appendTo(n.body),o=e.getDefaultComputedStyle&&(r=e.getDefaultComputedStyle(i[0]))?r.display:f.css(i[0],"display");return i.detach(),o}function Ae(e){var t=N,n=ke[e];return n||("none"!==(n=Se(e,t))&&n||((t=((Ee=(Ee||f("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement))[0].contentWindow||Ee[0].contentDocument).document).write(),t.close(),n=Se(e,t),Ee.detach()),ke[e]=n),n}!function(){var e;c.shrinkWrapBlocks=function(){return null!=e?e:(e=!1,(n=N.getElementsByTagName("body")[0])&&n.style?(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",t.appendChild(N.createElement("div")).style.width="5px",e=3!==t.offsetWidth),n.removeChild(r),e):void 0);var t,n,r}}();var De,je,Le=/^margin/,He=new RegExp("^("+$+")(?!px)[a-z%]+$","i"),qe=/^(top|right|bottom|left)$/;function _e(e,t){return{get:function(){var n=e();if(null!=n)return n?void delete this.get:(this.get=t).apply(this,arguments)}}}e.getComputedStyle?(De=function(t){return t.ownerDocument.defaultView.opener?t.ownerDocument.defaultView.getComputedStyle(t,null):e.getComputedStyle(t,null)},je=function(e,t,n){var r,i,o,a,s=e.style;return a=(n=n||De(e))?n.getPropertyValue(t)||n[t]:void 0,n&&(""!==a||f.contains(e.ownerDocument,e)||(a=f.style(e,t)),He.test(a)&&Le.test(t)&&(r=s.width,i=s.minWidth,o=s.maxWidth,s.minWidth=s.maxWidth=s.width=a,a=n.width,s.width=r,s.minWidth=i,s.maxWidth=o)),void 0===a?a:a+""}):N.documentElement.currentStyle&&(De=function(e){return e.currentStyle},je=function(e,t,n){var r,i,o,a,s=e.style;return null==(a=(n=n||De(e))?n[t]:void 0)&&s&&s[t]&&(a=s[t]),He.test(a)&&!qe.test(t)&&(r=s.left,(o=(i=e.runtimeStyle)&&i.left)&&(i.left=e.currentStyle.left),s.left="fontSize"===t?"1em":a,a=s.pixelLeft+"px",s.left=r,o&&(i.left=o)),void 0===a?a:a+""||"auto"}),function(){var t,n,r,i,o,a,s;if((t=N.createElement("div")).innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",n=(r=t.getElementsByTagName("a")[0])&&r.style){function l(){var t,n,r,l;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),t.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",i=o=!1,s=!0,e.getComputedStyle&&(i="1%"!==(e.getComputedStyle(t,null)||{}).top,o="4px"===(e.getComputedStyle(t,null)||{width:"4px"}).width,(l=t.appendChild(N.createElement("div"))).style.cssText=t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",l.style.marginRight=l.style.width="0",t.style.width="1px",s=!parseFloat((e.getComputedStyle(l,null)||{}).marginRight),t.removeChild(l)),t.innerHTML="<table><tr><td></td><td>t</td></tr></table>",(l=t.getElementsByTagName("td"))[0].style.cssText="margin:0;border:0;padding:0;display:none",(a=0===l[0].offsetHeight)&&(l[0].style.display="",l[1].style.display="none",a=0===l[0].offsetHeight),n.removeChild(r))}n.cssText="float:left;opacity:.5",c.opacity="0.5"===n.opacity,c.cssFloat=!!n.cssFloat,t.style.backgroundClip="content-box",t.cloneNode(!0).style.backgroundClip="",c.clearCloneStyle="content-box"===t.style.backgroundClip,c.boxSizing=""===n.boxSizing||""===n.MozBoxSizing||""===n.WebkitBoxSizing,f.extend(c,{reliableHiddenOffsets:function(){return null==a&&l(),a},boxSizingReliable:function(){return null==o&&l(),o},pixelPosition:function(){return null==i&&l(),i},reliableMarginRight:function(){return null==s&&l(),s}})}}(),f.swap=function(e,t,n,r){var i,o,a={};for(o in t)a[o]=e.style[o],e.style[o]=t[o];for(o in i=n.apply(e,r||[]),t)e.style[o]=a[o];return i};var Me=/alpha\([^)]*\)/i,Fe=/opacity\s*=\s*([^)]*)/,Oe=/^(none|table(?!-c[ea]).+)/,Be=new RegExp("^("+$+")(.*)$","i"),Pe=new RegExp("^([+-])=("+$+")","i"),Re={position:"absolute",visibility:"hidden",display:"block"},We={letterSpacing:"0",fontWeight:"400"},$e=["Webkit","O","Moz","ms"];function ze(e,t){if(t in e)return t;for(var n=t.charAt(0).toUpperCase()+t.slice(1),r=t,i=$e.length;i--;)if((t=$e[i]+n)in e)return t;return r}function Ie(e,t){for(var n,r,i,o=[],a=0,s=e.length;s>a;a++)(r=e[a]).style&&(o[a]=f._data(r,"olddisplay"),n=r.style.display,t?(o[a]||"none"!==n||(r.style.display=""),""===r.style.display&&I(r)&&(o[a]=f._data(r,"olddisplay",Ae(r.nodeName)))):(i=I(r),(n&&"none"!==n||!i)&&f._data(r,"olddisplay",i?n:f.css(r,"display"))));for(a=0;s>a;a++)(r=e[a]).style&&(t&&"none"!==r.style.display&&""!==r.style.display||(r.style.display=t?o[a]||"":"none"));return e}function Xe(e,t,n){var r=Be.exec(t);return r?Math.max(0,r[1]-(n||0))+(r[2]||"px"):t}function Ue(e,t,n,r,i){for(var o=n===(r?"border":"content")?4:"width"===t?1:0,a=0;4>o;o+=2)"margin"===n&&(a+=f.css(e,n+z[o],!0,i)),r?("content"===n&&(a-=f.css(e,"padding"+z[o],!0,i)),"margin"!==n&&(a-=f.css(e,"border"+z[o]+"Width",!0,i))):(a+=f.css(e,"padding"+z[o],!0,i),"padding"!==n&&(a+=f.css(e,"border"+z[o]+"Width",!0,i)));return a}function Ve(e,t,n){var r=!0,i="width"===t?e.offsetWidth:e.offsetHeight,o=De(e),a=c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,o);if(0>=i||null==i){if((0>(i=je(e,t,o))||null==i)&&(i=e.style[t]),He.test(i))return i;r=a&&(c.boxSizingReliable()||i===e.style[t]),i=parseFloat(i)||0}return i+Ue(e,t,n||(a?"border":"content"),r,o)+"px"}function Je(e,t,n,r,i){return new Je.prototype.init(e,t,n,r,i)}f.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=je(e,"opacity");return""===n?"1":n}}}},cssNumber:{columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{float:c.cssFloat?"cssFloat":"styleFloat"},style:function(e,t,n,r){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var i,o,a,s=f.camelCase(t),l=e.style;if(t=f.cssProps[s]||(f.cssProps[s]=ze(l,s)),a=f.cssHooks[t]||f.cssHooks[s],void 0===n)return a&&"get"in a&&void 0!==(i=a.get(e,!1,r))?i:l[t];if("string"===(o=typeof n)&&(i=Pe.exec(n))&&(n=(i[1]+1)*i[2]+parseFloat(f.css(e,t)),o="number"),null!=n&&n==n&&("number"!==o||f.cssNumber[s]||(n+="px"),c.clearCloneStyle||""!==n||0!==t.indexOf("background")||(l[t]="inherit"),!(a&&"set"in a&&void 0===(n=a.set(e,n,r)))))try{l[t]=n}catch(e){}}},css:function(e,t,n,r){var i,o,a,s=f.camelCase(t);return t=f.cssProps[s]||(f.cssProps[s]=ze(e.style,s)),(a=f.cssHooks[t]||f.cssHooks[s])&&"get"in a&&(o=a.get(e,!0,n)),void 0===o&&(o=je(e,t,r)),"normal"===o&&t in We&&(o=We[t]),""===n||n?(i=parseFloat(o),!0===n||f.isNumeric(i)?i||0:o):o}}),f.each(["height","width"],function(e,t){f.cssHooks[t]={get:function(e,n,r){return n?Oe.test(f.css(e,"display"))&&0===e.offsetWidth?f.swap(e,Re,function(){return Ve(e,t,r)}):Ve(e,t,r):void 0},set:function(e,n,r){var i=r&&De(e);return Xe(0,n,r?Ue(e,t,r,c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,i),i):0)}}}),c.opacity||(f.cssHooks.opacity={get:function(e,t){return Fe.test((t&&e.currentStyle?e.currentStyle.filter:e.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""},set:function(e,t){var n=e.style,r=e.currentStyle,i=f.isNumeric(t)?"alpha(opacity="+100*t+")":"",o=r&&r.filter||n.filter||"";n.zoom=1,(t>=1||""===t)&&""===f.trim(o.replace(Me,""))&&n.removeAttribute&&(n.removeAttribute("filter"),""===t||r&&!r.filter)||(n.filter=Me.test(o)?o.replace(Me,i):o+" "+i)}}),f.cssHooks.marginRight=_e(c.reliableMarginRight,function(e,t){return t?f.swap(e,{display:"inline-block"},je,[e,"marginRight"]):void 0}),f.each({margin:"",padding:"",border:"Width"},function(e,t){f.cssHooks[e+t]={expand:function(n){for(var r=0,i={},o="string"==typeof n?n.split(" "):[n];4>r;r++)i[e+z[r]+t]=o[r]||o[r-2]||o[0];return i}},Le.test(e)||(f.cssHooks[e+t].set=Xe)}),f.fn.extend({css:function(e,t){return X(this,function(e,t,n){var r,i,o={},a=0;if(f.isArray(t)){for(r=De(e),i=t.length;i>a;a++)o[t[a]]=f.css(e,t[a],!1,r);return o}return void 0!==n?f.style(e,t,n):f.css(e,t)},e,t,arguments.length>1)},show:function(){return Ie(this,!0)},hide:function(){return Ie(this)},toggle:function(e){return"boolean"==typeof e?e?this.show():this.hide():this.each(function(){I(this)?f(this).show():f(this).hide()})}}),f.Tween=Je,Je.prototype={constructor:Je,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||"swing",this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(f.cssNumber[n]?"":"px")},cur:function(){var e=Je.propHooks[this.prop];return e&&e.get?e.get(this):Je.propHooks._default.get(this)},run:function(e){var t,n=Je.propHooks[this.prop];return this.pos=t=this.options.duration?f.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):Je.propHooks._default.set(this),this}},Je.prototype.init.prototype=Je.prototype,Je.propHooks={_default:{get:function(e){var t;return null==e.elem[e.prop]||e.elem.style&&null!=e.elem.style[e.prop]?(t=f.css(e.elem,e.prop,""))&&"auto"!==t?t:0:e.elem[e.prop]},set:function(e){f.fx.step[e.prop]?f.fx.step[e.prop](e):e.elem.style&&(null!=e.elem.style[f.cssProps[e.prop]]||f.cssHooks[e.prop])?f.style(e.elem,e.prop,e.now+e.unit):e.elem[e.prop]=e.now}}},Je.propHooks.scrollTop=Je.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},f.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2}},f.fx=Je.prototype.init,f.fx.step={};var Ye,Ge,Qe=/^(?:toggle|show|hide)$/,Ke=new RegExp("^(?:([+-])=|)("+$+")([a-z%]*)$","i"),Ze=/queueHooks$/,et=[function(e,t,n){var r,i,o,a,s,l,u,d=this,p={},h=e.style,m=e.nodeType&&I(e),g=f._data(e,"fxshow");for(r in n.queue||(null==(s=f._queueHooks(e,"fx")).unqueued&&(s.unqueued=0,l=s.empty.fire,s.empty.fire=function(){s.unqueued||l()}),s.unqueued++,d.always(function(){d.always(function(){s.unqueued--,f.queue(e,"fx").length||s.empty.fire()})})),1===e.nodeType&&("height"in t||"width"in t)&&(n.overflow=[h.overflow,h.overflowX,h.overflowY],u=f.css(e,"display"),"inline"===("none"===u?f._data(e,"olddisplay")||Ae(e.nodeName):u)&&"none"===f.css(e,"float")&&(c.inlineBlockNeedsLayout&&"inline"!==Ae(e.nodeName)?h.zoom=1:h.display="inline-block")),n.overflow&&(h.overflow="hidden",c.shrinkWrapBlocks()||d.always(function(){h.overflow=n.overflow[0],h.overflowX=n.overflow[1],h.overflowY=n.overflow[2]})),t)if(i=t[r],Qe.exec(i)){if(delete t[r],o=o||"toggle"===i,i===(m?"hide":"show")){if("show"!==i||!g||void 0===g[r])continue;m=!0}p[r]=g&&g[r]||f.style(e,r)}else u=void 0;if(f.isEmptyObject(p))"inline"===("none"===u?Ae(e.nodeName):u)&&(h.display=u);else for(r in g?"hidden"in g&&(m=g.hidden):g=f._data(e,"fxshow",{}),o&&(g.hidden=!m),m?f(e).show():d.done(function(){f(e).hide()}),d.done(function(){var t;for(t in f._removeData(e,"fxshow"),p)f.style(e,t,p[t])}),p)a=it(m?g[r]:0,r,d),r in g||(g[r]=a.start,m&&(a.end=a.start,a.start="width"===r||"height"===r?1:0))}],tt={"*":[function(e,t){var n=this.createTween(e,t),r=n.cur(),i=Ke.exec(t),o=i&&i[3]||(f.cssNumber[e]?"":"px"),a=(f.cssNumber[e]||"px"!==o&&+r)&&Ke.exec(f.css(n.elem,e)),s=1,l=20;if(a&&a[3]!==o){o=o||a[3],i=i||[],a=+r||1;do{a/=s=s||".5",f.style(n.elem,e,a+o)}while(s!==(s=n.cur()/r)&&1!==s&&--l)}return i&&(a=n.start=+a||+r||0,n.unit=o,n.end=i[1]?a+(i[1]+1)*i[2]:+i[2]),n}]};function nt(){return setTimeout(function(){Ye=void 0}),Ye=f.now()}function rt(e,t){var n,r={height:e},i=0;for(t=t?1:0;4>i;i+=2-t)r["margin"+(n=z[i])]=r["padding"+n]=e;return t&&(r.opacity=r.width=e),r}function it(e,t,n){for(var r,i=(tt[t]||[]).concat(tt["*"]),o=0,a=i.length;a>o;o++)if(r=i[o].call(n,t,e))return r}function ot(e,t,n){var r,i,o=0,a=et.length,s=f.Deferred().always(function(){delete l.elem}),l=function(){if(i)return!1;for(var t=Ye||nt(),n=Math.max(0,u.startTime+u.duration-t),r=1-(n/u.duration||0),o=0,a=u.tweens.length;a>o;o++)u.tweens[o].run(r);return s.notifyWith(e,[u,r,n]),1>r&&a?n:(s.resolveWith(e,[u]),!1)},u=s.promise({elem:e,props:f.extend({},t),opts:f.extend(!0,{specialEasing:{}},n),originalProperties:t,originalOptions:n,startTime:Ye||nt(),duration:n.duration,tweens:[],createTween:function(t,n){var r=f.Tween(e,u.opts,t,n,u.opts.specialEasing[t]||u.opts.easing);return u.tweens.push(r),r},stop:function(t){var n=0,r=t?u.tweens.length:0;if(i)return this;for(i=!0;r>n;n++)u.tweens[n].run(1);return t?s.resolveWith(e,[u,t]):s.rejectWith(e,[u,t]),this}}),c=u.props;for(function(e,t){var n,r,i,o,a;for(n in e)if(i=t[r=f.camelCase(n)],o=e[n],f.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),(a=f.cssHooks[r])&&"expand"in a)for(n in o=a.expand(o),delete e[r],o)n in e||(e[n]=o[n],t[n]=i);else t[r]=i}(c,u.opts.specialEasing);a>o;o++)if(r=et[o].call(u,e,c,u.opts))return r;return f.map(c,it,u),f.isFunction(u.opts.start)&&u.opts.start.call(e,u),f.fx.timer(f.extend(l,{elem:e,anim:u,queue:u.opts.queue})),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)}f.Animation=f.extend(ot,{tweener:function(e,t){f.isFunction(e)?(t=e,e=["*"]):e=e.split(" ");for(var n,r=0,i=e.length;i>r;r++)n=e[r],tt[n]=tt[n]||[],tt[n].unshift(t)},prefilter:function(e,t){t?et.unshift(e):et.push(e)}}),f.speed=function(e,t,n){var r=e&&"object"==typeof e?f.extend({},e):{complete:n||!n&&t||f.isFunction(e)&&e,duration:e,easing:n&&t||t&&!f.isFunction(t)&&t};return r.duration=f.fx.off?0:"number"==typeof r.duration?r.duration:r.duration in f.fx.speeds?f.fx.speeds[r.duration]:f.fx.speeds._default,(null==r.queue||!0===r.queue)&&(r.queue="fx"),r.old=r.complete,r.complete=function(){f.isFunction(r.old)&&r.old.call(this),r.queue&&f.dequeue(this,r.queue)},r},f.fn.extend({fadeTo:function(e,t,n,r){return this.filter(I).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(e,t,n,r){var i=f.isEmptyObject(e),o=f.speed(t,n,r),a=function(){var t=ot(this,f.extend({},e),o);(i||f._data(this,"finish"))&&t.stop(!0)};return a.finish=a,i||!1===o.queue?this.each(a):this.queue(o.queue,a)},stop:function(e,t,n){var r=function(e){var t=e.stop;delete e.stop,t(n)};return"string"!=typeof e&&(n=t,t=e,e=void 0),t&&!1!==e&&this.queue(e||"fx",[]),this.each(function(){var t=!0,i=null!=e&&e+"queueHooks",o=f.timers,a=f._data(this);if(i)a[i]&&a[i].stop&&r(a[i]);else for(i in a)a[i]&&a[i].stop&&Ze.test(i)&&r(a[i]);for(i=o.length;i--;)o[i].elem!==this||null!=e&&o[i].queue!==e||(o[i].anim.stop(n),t=!1,o.splice(i,1));(t||!n)&&f.dequeue(this,e)})},finish:function(e){return!1!==e&&(e=e||"fx"),this.each(function(){var t,n=f._data(this),r=n[e+"queue"],i=n[e+"queueHooks"],o=f.timers,a=r?r.length:0;for(n.finish=!0,f.queue(this,e,[]),i&&i.stop&&i.stop.call(this,!0),t=o.length;t--;)o[t].elem===this&&o[t].queue===e&&(o[t].anim.stop(!0),o.splice(t,1));for(t=0;a>t;t++)r[t]&&r[t].finish&&r[t].finish.call(this);delete n.finish})}}),f.each(["toggle","show","hide"],function(e,t){var n=f.fn[t];f.fn[t]=function(e,r,i){return null==e||"boolean"==typeof e?n.apply(this,arguments):this.animate(rt(t,!0),e,r,i)}}),f.each({slideDown:rt("show"),slideUp:rt("hide"),slideToggle:rt("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){f.fn[e]=function(e,n,r){return this.animate(t,e,n,r)}}),f.timers=[],f.fx.tick=function(){var e,t=f.timers,n=0;for(Ye=f.now();n<t.length;n++)(e=t[n])()||t[n]!==e||t.splice(n--,1);t.length||f.fx.stop(),Ye=void 0},f.fx.timer=function(e){f.timers.push(e),e()?f.fx.start():f.timers.pop()},f.fx.interval=13,f.fx.start=function(){Ge||(Ge=setInterval(f.fx.tick,f.fx.interval))},f.fx.stop=function(){clearInterval(Ge),Ge=null},f.fx.speeds={slow:600,fast:200,_default:400},f.fn.delay=function(e,t){return e=f.fx&&f.fx.speeds[e]||e,t=t||"fx",this.queue(t,function(t,n){var r=setTimeout(t,e);n.stop=function(){clearTimeout(r)}})},function(){var e,t,n,r,i;(t=N.createElement("div")).setAttribute("className","t"),t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",r=t.getElementsByTagName("a")[0],i=(n=N.createElement("select")).appendChild(N.createElement("option")),e=t.getElementsByTagName("input")[0],r.style.cssText="top:1px",c.getSetAttribute="t"!==t.className,c.style=/top/.test(r.getAttribute("style")),c.hrefNormalized="/a"===r.getAttribute("href"),c.checkOn=!!e.value,c.optSelected=i.selected,c.enctype=!!N.createElement("form").enctype,n.disabled=!0,c.optDisabled=!i.disabled,(e=N.createElement("input")).setAttribute("value",""),c.input=""===e.getAttribute("value"),e.value="t",e.setAttribute("type","radio"),c.radioValue="t"===e.value}();var at=/\r/g;f.fn.extend({val:function(e){var t,n,r,i=this[0];return arguments.length?(r=f.isFunction(e),this.each(function(n){var i;1===this.nodeType&&(null==(i=r?e.call(this,n,f(this).val()):e)?i="":"number"==typeof i?i+="":f.isArray(i)&&(i=f.map(i,function(e){return null==e?"":e+""})),(t=f.valHooks[this.type]||f.valHooks[this.nodeName.toLowerCase()])&&"set"in t&&void 0!==t.set(this,i,"value")||(this.value=i))})):i?(t=f.valHooks[i.type]||f.valHooks[i.nodeName.toLowerCase()])&&"get"in t&&void 0!==(n=t.get(i,"value"))?n:"string"==typeof(n=i.value)?n.replace(at,""):null==n?"":n:void 0}}),f.extend({valHooks:{option:{get:function(e){var t=f.find.attr(e,"value");return null!=t?t:f.trim(f.text(e))}},select:{get:function(e){for(var t,n,r=e.options,i=e.selectedIndex,o="select-one"===e.type||0>i,a=o?null:[],s=o?i+1:r.length,l=0>i?s:o?i:0;s>l;l++)if(!(!(n=r[l]).selected&&l!==i||(c.optDisabled?n.disabled:null!==n.getAttribute("disabled"))||n.parentNode.disabled&&f.nodeName(n.parentNode,"optgroup"))){if(t=f(n).val(),o)return t;a.push(t)}return a},set:function(e,t){for(var n,r,i=e.options,o=f.makeArray(t),a=i.length;a--;)if(r=i[a],f.inArray(f.valHooks.option.get(r),o)>=0)try{r.selected=n=!0}catch(e){r.scrollHeight}else r.selected=!1;return n||(e.selectedIndex=-1),i}}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]={set:function(e,t){return f.isArray(t)?e.checked=f.inArray(f(e).val(),t)>=0:void 0}},c.checkOn||(f.valHooks[this].get=function(e){return null===e.getAttribute("value")?"on":e.value})});var st,lt,ut=f.expr.attrHandle,ct=/^(?:checked|selected)$/i,dt=c.getSetAttribute,ft=c.input;f.fn.extend({attr:function(e,t){return X(this,f.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){f.removeAttr(this,e)})}}),f.extend({attr:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return typeof e.getAttribute===M?f.prop(e,t,n):(1===o&&f.isXMLDoc(e)||(t=t.toLowerCase(),r=f.attrHooks[t]||(f.expr.match.bool.test(t)?lt:st)),void 0===n?r&&"get"in r&&null!==(i=r.get(e,t))?i:null==(i=f.find.attr(e,t))?void 0:i:null!==n?r&&"set"in r&&void 0!==(i=r.set(e,n,t))?i:(e.setAttribute(t,n+""),n):void f.removeAttr(e,t))},removeAttr:function(e,t){var n,r,i=0,o=t&&t.match(j);if(o&&1===e.nodeType)for(;n=o[i++];)r=f.propFix[n]||n,f.expr.match.bool.test(n)?ft&&dt||!ct.test(n)?e[r]=!1:e[f.camelCase("default-"+n)]=e[r]=!1:f.attr(e,n,""),e.removeAttribute(dt?n:r)},attrHooks:{type:{set:function(e,t){if(!c.radioValue&&"radio"===t&&f.nodeName(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}}}}),lt={set:function(e,t,n){return!1===t?f.removeAttr(e,n):ft&&dt||!ct.test(n)?e.setAttribute(!dt&&f.propFix[n]||n,n):e[f.camelCase("default-"+n)]=e[n]=!0,n}},f.each(f.expr.match.bool.source.match(/\w+/g),function(e,t){var n=ut[t]||f.find.attr;ut[t]=ft&&dt||!ct.test(t)?function(e,t,r){var i,o;return r||(o=ut[t],ut[t]=i,i=null!=n(e,t,r)?t.toLowerCase():null,ut[t]=o),i}:function(e,t,n){return n?void 0:e[f.camelCase("default-"+t)]?t.toLowerCase():null}}),ft&&dt||(f.attrHooks.value={set:function(e,t,n){return f.nodeName(e,"input")?void(e.defaultValue=t):st&&st.set(e,t,n)}}),dt||(st={set:function(e,t,n){var r=e.getAttributeNode(n);return r||e.setAttributeNode(r=e.ownerDocument.createAttribute(n)),r.value=t+="","value"===n||t===e.getAttribute(n)?t:void 0}},ut.id=ut.name=ut.coords=function(e,t,n){var r;return n?void 0:(r=e.getAttributeNode(t))&&""!==r.value?r.value:null},f.valHooks.button={get:function(e,t){var n=e.getAttributeNode(t);return n&&n.specified?n.value:void 0},set:st.set},f.attrHooks.contenteditable={set:function(e,t,n){st.set(e,""!==t&&t,n)}},f.each(["width","height"],function(e,t){f.attrHooks[t]={set:function(e,n){return""===n?(e.setAttribute(t,"auto"),n):void 0}}})),c.style||(f.attrHooks.style={get:function(e){return e.style.cssText||void 0},set:function(e,t){return e.style.cssText=t+""}});var pt=/^(?:input|select|textarea|button|object)$/i,ht=/^(?:a|area)$/i;f.fn.extend({prop:function(e,t){return X(this,f.prop,e,t,arguments.length>1)},removeProp:function(e){return e=f.propFix[e]||e,this.each(function(){try{this[e]=void 0,delete this[e]}catch(e){}})}}),f.extend({propFix:{for:"htmlFor",class:"className"},prop:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return(1!==o||!f.isXMLDoc(e))&&(t=f.propFix[t]||t,i=f.propHooks[t]),void 0!==n?i&&"set"in i&&void 0!==(r=i.set(e,n,t))?r:e[t]=n:i&&"get"in i&&null!==(r=i.get(e,t))?r:e[t]},propHooks:{tabIndex:{get:function(e){var t=f.find.attr(e,"tabindex");return t?parseInt(t,10):pt.test(e.nodeName)||ht.test(e.nodeName)&&e.href?0:-1}}}}),c.hrefNormalized||f.each(["href","src"],function(e,t){f.propHooks[t]={get:function(e){return e.getAttribute(t,4)}}}),c.optSelected||(f.propHooks.selected={get:function(e){var t=e.parentNode;return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null}}),f.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){f.propFix[this.toLowerCase()]=this}),c.enctype||(f.propFix.enctype="encoding");var mt=/[\t\r\n\f]/g;f.fn.extend({addClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u="string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).addClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):" ")){for(o=0;i=t[o++];)r.indexOf(" "+i+" ")<0&&(r+=i+" ");a=f.trim(r),n.className!==a&&(n.className=a)}return this},removeClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u=0===arguments.length||"string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).removeClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):"")){for(o=0;i=t[o++];)for(;r.indexOf(" "+i+" ")>=0;)r=r.replace(" "+i+" "," ");a=e?f.trim(r):"",n.className!==a&&(n.className=a)}return this},toggleClass:function(e,t){var n=typeof e;return"boolean"==typeof t&&"string"===n?t?this.addClass(e):this.removeClass(e):this.each(f.isFunction(e)?function(n){f(this).toggleClass(e.call(this,n,this.className,t),t)}:function(){if("string"===n)for(var t,r=0,i=f(this),o=e.match(j)||[];t=o[r++];)i.hasClass(t)?i.removeClass(t):i.addClass(t);else(n===M||"boolean"===n)&&(this.className&&f._data(this,"__className__",this.className),this.className=this.className||!1===e?"":f._data(this,"__className__")||"")})},hasClass:function(e){for(var t=" "+e+" ",n=0,r=this.length;r>n;n++)if(1===this[n].nodeType&&(" "+this[n].className+" ").replace(mt," ").indexOf(t)>=0)return!0;return!1}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(e,t){f.fn[t]=function(e,n){return arguments.length>0?this.on(t,null,e,n):this.trigger(t)}}),f.fn.extend({hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)},bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1===arguments.length?this.off(e,"**"):this.off(t,e||"**",n)}});var gt=f.now(),vt=/\?/,yt=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;f.parseJSON=function(t){if(e.JSON&&e.JSON.parse)return e.JSON.parse(t+"");var n,r=null,i=f.trim(t+"");return i&&!f.trim(i.replace(yt,function(e,t,i,o){return n&&t&&(r=0),0===r?e:(n=i||t,r+=!o-!i,"")}))?Function("return "+i)():f.error("Invalid JSON: "+t)},f.parseXML=function(t){var n;if(!t||"string"!=typeof t)return null;try{e.DOMParser?n=(new DOMParser).parseFromString(t,"text/xml"):((n=new ActiveXObject("Microsoft.XMLDOM")).async="false",n.loadXML(t))}catch(e){n=void 0}return n&&n.documentElement&&!n.getElementsByTagName("parsererror").length||f.error("Invalid XML: "+t),n};var bt,xt,wt=/#.*$/,Tt=/([?&])_=[^&]*/,Ct=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Nt=/^(?:GET|HEAD)$/,Et=/^\/\//,kt=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,St={},At={},Dt="*/".concat("*");try{xt=location.href}catch(e){(xt=N.createElement("a")).href="",xt=xt.href}function jt(e){return function(t,n){"string"!=typeof t&&(n=t,t="*");var r,i=0,o=t.toLowerCase().match(j)||[];if(f.isFunction(n))for(;r=o[i++];)"+"===r.charAt(0)?(r=r.slice(1)||"*",(e[r]=e[r]||[]).unshift(n)):(e[r]=e[r]||[]).push(n)}}function Lt(e,t,n,r){var i={},o=e===At;function a(s){var l;return i[s]=!0,f.each(e[s]||[],function(e,s){var u=s(t,n,r);return"string"!=typeof u||o||i[u]?o?!(l=u):void 0:(t.dataTypes.unshift(u),a(u),!1)}),l}return a(t.dataTypes[0])||!i["*"]&&a("*")}function Ht(e,t){var n,r,i=f.ajaxSettings.flatOptions||{};for(r in t)void 0!==t[r]&&((i[r]?e:n||(n={}))[r]=t[r]);return n&&f.extend(!0,e,n),e}bt=kt.exec(xt.toLowerCase())||[],f.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:xt,type:"GET",isLocal:/^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(bt[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Dt,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(e,t){return t?Ht(Ht(e,f.ajaxSettings),t):Ht(f.ajaxSettings,e)},ajaxPrefilter:jt(St),ajaxTransport:jt(At),ajax:function(e,t){"object"==typeof e&&(t=e,e=void 0),t=t||{};var n,r,i,o,a,s,l,u,c=f.ajaxSetup({},t),d=c.context||c,p=c.context&&(d.nodeType||d.jquery)?f(d):f.event,h=f.Deferred(),m=f.Callbacks("once memory"),g=c.statusCode||{},v={},y={},b=0,x="canceled",w={readyState:0,getResponseHeader:function(e){var t;if(2===b){if(!u)for(u={};t=Ct.exec(o);)u[t[1].toLowerCase()]=t[2];t=u[e.toLowerCase()]}return null==t?null:t},getAllResponseHeaders:function(){return 2===b?o:null},setRequestHeader:function(e,t){var n=e.toLowerCase();return b||(e=y[n]=y[n]||e,v[e]=t),this},overrideMimeType:function(e){return b||(c.mimeType=e),this},statusCode:function(e){var t;if(e)if(2>b)for(t in e)g[t]=[g[t],e[t]];else w.always(e[w.status]);return this},abort:function(e){var t=e||x;return l&&l.abort(t),T(0,t),this}};if(h.promise(w).complete=m.add,w.success=w.done,w.error=w.fail,c.url=((e||c.url||xt)+"").replace(wt,"").replace(Et,bt[1]+"//"),c.type=t.method||t.type||c.method||c.type,c.dataTypes=f.trim(c.dataType||"*").toLowerCase().match(j)||[""],null==c.crossDomain&&(n=kt.exec(c.url.toLowerCase()),c.crossDomain=!(!n||n[1]===bt[1]&&n[2]===bt[2]&&(n[3]||("http:"===n[1]?"80":"443"))===(bt[3]||("http:"===bt[1]?"80":"443")))),c.data&&c.processData&&"string"!=typeof c.data&&(c.data=f.param(c.data,c.traditional)),Lt(St,c,t,w),2===b)return w;for(r in(s=f.event&&c.global)&&0==f.active++&&f.event.trigger("ajaxStart"),c.type=c.type.toUpperCase(),c.hasContent=!Nt.test(c.type),i=c.url,c.hasContent||(c.data&&(i=c.url+=(vt.test(i)?"&":"?")+c.data,delete c.data),!1===c.cache&&(c.url=Tt.test(i)?i.replace(Tt,"$1_="+gt++):i+(vt.test(i)?"&":"?")+"_="+gt++)),c.ifModified&&(f.lastModified[i]&&w.setRequestHeader("If-Modified-Since",f.lastModified[i]),f.etag[i]&&w.setRequestHeader("If-None-Match",f.etag[i])),(c.data&&c.hasContent&&!1!==c.contentType||t.contentType)&&w.setRequestHeader("Content-Type",c.contentType),w.setRequestHeader("Accept",c.dataTypes[0]&&c.accepts[c.dataTypes[0]]?c.accepts[c.dataTypes[0]]+("*"!==c.dataTypes[0]?", "+Dt+"; q=0.01":""):c.accepts["*"]),c.headers)w.setRequestHeader(r,c.headers[r]);if(c.beforeSend&&(!1===c.beforeSend.call(d,w,c)||2===b))return w.abort();for(r in x="abort",{success:1,error:1,complete:1})w[r](c[r]);if(l=Lt(At,c,t,w)){w.readyState=1,s&&p.trigger("ajaxSend",[w,c]),c.async&&c.timeout>0&&(a=setTimeout(function(){w.abort("timeout")},c.timeout));try{b=1,l.send(v,T)}catch(e){if(!(2>b))throw e;T(-1,e)}}else T(-1,"No Transport");function T(e,t,n,r){var u,v,y,x,T,C=t;2!==b&&(b=2,a&&clearTimeout(a),l=void 0,o=r||"",w.readyState=e>0?4:0,u=e>=200&&300>e||304===e,n&&(x=function(e,t,n){for(var r,i,o,a,s=e.contents,l=e.dataTypes;"*"===l[0];)l.shift(),void 0===i&&(i=e.mimeType||t.getResponseHeader("Content-Type"));if(i)for(a in s)if(s[a]&&s[a].test(i)){l.unshift(a);break}if(l[0]in n)o=l[0];else{for(a in n){if(!l[0]||e.converters[a+" "+l[0]]){o=a;break}r||(r=a)}o=o||r}return o?(o!==l[0]&&l.unshift(o),n[o]):void 0}(c,w,n)),x=function(e,t,n,r){var i,o,a,s,l,u={},c=e.dataTypes.slice();if(c[1])for(a in e.converters)u[a.toLowerCase()]=e.converters[a];for(o=c.shift();o;)if(e.responseFields[o]&&(n[e.responseFields[o]]=t),!l&&r&&e.dataFilter&&(t=e.dataFilter(t,e.dataType)),l=o,o=c.shift())if("*"===o)o=l;else if("*"!==l&&l!==o){if(!(a=u[l+" "+o]||u["* "+o]))for(i in u)if((s=i.split(" "))[1]===o&&(a=u[l+" "+s[0]]||u["* "+s[0]])){!0===a?a=u[i]:!0!==u[i]&&(o=s[0],c.unshift(s[1]));break}if(!0!==a)if(a&&e.throws)t=a(t);else try{t=a(t)}catch(e){return{state:"parsererror",error:a?e:"No conversion from "+l+" to "+o}}}return{state:"success",data:t}}(c,x,w,u),u?(c.ifModified&&((T=w.getResponseHeader("Last-Modified"))&&(f.lastModified[i]=T),(T=w.getResponseHeader("etag"))&&(f.etag[i]=T)),204===e||"HEAD"===c.type?C="nocontent":304===e?C="notmodified":(C=x.state,v=x.data,u=!(y=x.error))):(y=C,(e||!C)&&(C="error",0>e&&(e=0))),w.status=e,w.statusText=(t||C)+"",u?h.resolveWith(d,[v,C,w]):h.rejectWith(d,[w,C,y]),w.statusCode(g),g=void 0,s&&p.trigger(u?"ajaxSuccess":"ajaxError",[w,c,u?v:y]),m.fireWith(d,[w,C]),s&&(p.trigger("ajaxComplete",[w,c]),--f.active||f.event.trigger("ajaxStop")))}return w},getJSON:function(e,t,n){return f.get(e,t,n,"json")},getScript:function(e,t){return f.get(e,void 0,t,"script")}}),f.each(["get","post"],function(e,t){f[t]=function(e,n,r,i){return f.isFunction(n)&&(i=i||r,r=n,n=void 0),f.ajax({url:e,type:t,dataType:i,data:n,success:r})}}),f._evalUrl=function(e){return f.ajax({url:e,type:"GET",dataType:"script",async:!1,global:!1,throws:!0})},f.fn.extend({wrapAll:function(e){if(f.isFunction(e))return this.each(function(t){f(this).wrapAll(e.call(this,t))});if(this[0]){var t=f(e,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){for(var e=this;e.firstChild&&1===e.firstChild.nodeType;)e=e.firstChild;return e}).append(this)}return this},wrapInner:function(e){return this.each(f.isFunction(e)?function(t){f(this).wrapInner(e.call(this,t))}:function(){var t=f(this),n=t.contents();n.length?n.wrapAll(e):t.append(e)})},wrap:function(e){var t=f.isFunction(e);return this.each(function(n){f(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()}}),f.expr.filters.hidden=function(e){return e.offsetWidth<=0&&e.offsetHeight<=0||!c.reliableHiddenOffsets()&&"none"===(e.style&&e.style.display||f.css(e,"display"))},f.expr.filters.visible=function(e){return!f.expr.filters.hidden(e)};var qt=/%20/g,_t=/\[\]$/,Mt=/\r?\n/g,Ft=/^(?:submit|button|image|reset|file)$/i,Ot=/^(?:input|select|textarea|keygen)/i;function Bt(e,t,n,r){var i;if(f.isArray(t))f.each(t,function(t,i){n||_t.test(e)?r(e,i):Bt(e+"["+("object"==typeof i?t:"")+"]",i,n,r)});else if(n||"object"!==f.type(t))r(e,t);else for(i in t)Bt(e+"["+i+"]",t[i],n,r)}f.param=function(e,t){var n,r=[],i=function(e,t){t=f.isFunction(t)?t():null==t?"":t,r[r.length]=encodeURIComponent(e)+"="+encodeURIComponent(t)};if(void 0===t&&(t=f.ajaxSettings&&f.ajaxSettings.traditional),f.isArray(e)||e.jquery&&!f.isPlainObject(e))f.each(e,function(){i(this.name,this.value)});else for(n in e)Bt(n,e[n],t,i);return r.join("&").replace(qt,"+")},f.fn.extend({serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var e=f.prop(this,"elements");return e?f.makeArray(e):this}).filter(function(){var e=this.type;return this.name&&!f(this).is(":disabled")&&Ot.test(this.nodeName)&&!Ft.test(e)&&(this.checked||!U.test(e))}).map(function(e,t){var n=f(this).val();return null==n?null:f.isArray(n)?f.map(n,function(e){return{name:t.name,value:e.replace(Mt,"\r\n")}}):{name:t.name,value:n.replace(Mt,"\r\n")}}).get()}}),f.ajaxSettings.xhr=void 0!==e.ActiveXObject?function(){return!this.isLocal&&/^(get|post|head|put|delete|options)$/i.test(this.type)&&$t()||function(){try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(e){}}()}:$t;var Pt=0,Rt={},Wt=f.ajaxSettings.xhr();function $t(){try{return new e.XMLHttpRequest}catch(e){}}e.attachEvent&&e.attachEvent("onunload",function(){for(var e in Rt)Rt[e](void 0,!0)}),c.cors=!!Wt&&"withCredentials"in Wt,(Wt=c.ajax=!!Wt)&&f.ajaxTransport(function(e){var t;if(!e.crossDomain||c.cors)return{send:function(n,r){var i,o=e.xhr(),a=++Pt;if(o.open(e.type,e.url,e.async,e.username,e.password),e.xhrFields)for(i in e.xhrFields)o[i]=e.xhrFields[i];for(i in e.mimeType&&o.overrideMimeType&&o.overrideMimeType(e.mimeType),e.crossDomain||n["X-Requested-With"]||(n["X-Requested-With"]="XMLHttpRequest"),n)void 0!==n[i]&&o.setRequestHeader(i,n[i]+"");o.send(e.hasContent&&e.data||null),t=function(n,i){var s,l,u;if(t&&(i||4===o.readyState))if(delete Rt[a],t=void 0,o.onreadystatechange=f.noop,i)4!==o.readyState&&o.abort();else{u={},s=o.status,"string"==typeof o.responseText&&(u.text=o.responseText);try{l=o.statusText}catch(e){l=""}s||!e.isLocal||e.crossDomain?1223===s&&(s=204):s=u.text?200:404}u&&r(s,l,u,o.getAllResponseHeaders())},e.async?4===o.readyState?setTimeout(t):o.onreadystatechange=Rt[a]=t:t()},abort:function(){t&&t(void 0,!0)}}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(e){return f.globalEval(e),e}}}),f.ajaxPrefilter("script",function(e){void 0===e.cache&&(e.cache=!1),e.crossDomain&&(e.type="GET",e.global=!1)}),f.ajaxTransport("script",function(e){if(e.crossDomain){var t,n=N.head||f("head")[0]||N.documentElement;return{send:function(r,i){(t=N.createElement("script")).async=!0,e.scriptCharset&&(t.charset=e.scriptCharset),t.src=e.url,t.onload=t.onreadystatechange=function(e,n){(n||!t.readyState||/loaded|complete/.test(t.readyState))&&(t.onload=t.onreadystatechange=null,t.parentNode&&t.parentNode.removeChild(t),t=null,n||i(200,"success"))},n.insertBefore(t,n.firstChild)},abort:function(){t&&t.onload(void 0,!0)}}}});var zt=[],It=/(=)\?(?=&|$)|\?\?/;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=zt.pop()||f.expando+"_"+gt++;return this[e]=!0,e}}),f.ajaxPrefilter("json jsonp",function(t,n,r){var i,o,a,s=!1!==t.jsonp&&(It.test(t.url)?"url":"string"==typeof t.data&&!(t.contentType||"").indexOf("application/x-www-form-urlencoded")&&It.test(t.data)&&"data");return s||"jsonp"===t.dataTypes[0]?(i=t.jsonpCallback=f.isFunction(t.jsonpCallback)?t.jsonpCallback():t.jsonpCallback,s?t[s]=t[s].replace(It,"$1"+i):!1!==t.jsonp&&(t.url+=(vt.test(t.url)?"&":"?")+t.jsonp+"="+i),t.converters["script json"]=function(){return a||f.error(i+" was not called"),a[0]},t.dataTypes[0]="json",o=e[i],e[i]=function(){a=arguments},r.always(function(){e[i]=o,t[i]&&(t.jsonpCallback=n.jsonpCallback,zt.push(i)),a&&f.isFunction(o)&&o(a[0]),a=o=void 0}),"script"):void 0}),f.parseHTML=function(e,t,n){if(!e||"string"!=typeof e)return null;"boolean"==typeof t&&(n=t,t=!1),t=t||N;var r=x.exec(e),i=!n&&[];return r?[t.createElement(r[1])]:(r=f.buildFragment([e],t,i),i&&i.length&&f(i).remove(),f.merge([],r.childNodes))};var Xt=f.fn.load;f.fn.load=function(e,t,n){if("string"!=typeof e&&Xt)return Xt.apply(this,arguments);var r,i,o,a=this,s=e.indexOf(" ");return s>=0&&(r=f.trim(e.slice(s,e.length)),e=e.slice(0,s)),f.isFunction(t)?(n=t,t=void 0):t&&"object"==typeof t&&(o="POST"),a.length>0&&f.ajax({url:e,type:o,dataType:"html",data:t}).done(function(e){i=arguments,a.html(r?f("<div>").append(f.parseHTML(e)).find(r):e)}).complete(n&&function(e,t){a.each(n,i||[e.responseText,t,e])}),this},f.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){f.fn[t]=function(e){return this.on(t,e)}}),f.expr.filters.animated=function(e){return f.grep(f.timers,function(t){return e===t.elem}).length};var Ut=e.document.documentElement;function Vt(e){return f.isWindow(e)?e:9===e.nodeType&&(e.defaultView||e.parentWindow)}f.offset={setOffset:function(e,t,n){var r,i,o,a,s,l,u=f.css(e,"position"),c=f(e),d={};"static"===u&&(e.style.position="relative"),s=c.offset(),o=f.css(e,"top"),l=f.css(e,"left"),("absolute"===u||"fixed"===u)&&f.inArray("auto",[o,l])>-1?(a=(r=c.position()).top,i=r.left):(a=parseFloat(o)||0,i=parseFloat(l)||0),f.isFunction(t)&&(t=t.call(e,n,s)),null!=t.top&&(d.top=t.top-s.top+a),null!=t.left&&(d.left=t.left-s.left+i),"using"in t?t.using.call(e,d):c.css(d)}},f.fn.extend({offset:function(e){if(arguments.length)return void 0===e?this:this.each(function(t){f.offset.setOffset(this,e,t)});var t,n,r={top:0,left:0},i=this[0],o=i&&i.ownerDocument;return o?(t=o.documentElement,f.contains(t,i)?(typeof i.getBoundingClientRect!==M&&(r=i.getBoundingClientRect()),n=Vt(o),{top:r.top+(n.pageYOffset||t.scrollTop)-(t.clientTop||0),left:r.left+(n.pageXOffset||t.scrollLeft)-(t.clientLeft||0)}):r):void 0},position:function(){if(this[0]){var e,t,n={top:0,left:0},r=this[0];return"fixed"===f.css(r,"position")?t=r.getBoundingClientRect():(e=this.offsetParent(),t=this.offset(),f.nodeName(e[0],"html")||(n=e.offset()),n.top+=f.css(e[0],"borderTopWidth",!0),n.left+=f.css(e[0],"borderLeftWidth",!0)),{top:t.top-n.top-f.css(r,"marginTop",!0),left:t.left-n.left-f.css(r,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){for(var e=this.offsetParent||Ut;e&&!f.nodeName(e,"html")&&"static"===f.css(e,"position");)e=e.offsetParent;return e||Ut})}}),f.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,t){var n=/Y/.test(t);f.fn[e]=function(r){return X(this,function(e,r,i){var o=Vt(e);return void 0===i?o?t in o?o[t]:o.document.documentElement[r]:e[r]:void(o?o.scrollTo(n?f(o).scrollLeft():i,n?i:f(o).scrollTop()):e[r]=i)},e,r,arguments.length,null)}}),f.each(["top","left"],function(e,t){f.cssHooks[t]=_e(c.pixelPosition,function(e,n){return n?(n=je(e,t),He.test(n)?f(e).position()[t]+"px":n):void 0})}),f.each({Height:"height",Width:"width"},function(e,t){f.each({padding:"inner"+e,content:t,"":"outer"+e},function(n,r){f.fn[r]=function(r,i){var o=arguments.length&&(n||"boolean"!=typeof r),a=n||(!0===r||!0===i?"margin":"border");return X(this,function(t,n,r){var i;return f.isWindow(t)?t.document.documentElement["client"+e]:9===t.nodeType?(i=t.documentElement,Math.max(t.body["scroll"+e],i["scroll"+e],t.body["offset"+e],i["offset"+e],i["client"+e])):void 0===r?f.css(t,n,a):f.style(t,n,r,a)},t,o?r:void 0,o,null)}})}),f.fn.size=function(){return this.length},f.fn.andSelf=f.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return f});var Jt=e.jQuery,Yt=e.$;return f.noConflict=function(t){return e.$===f&&(e.$=Yt),t&&e.jQuery===f&&(e.jQuery=Jt),f},typeof t===M&&(e.jQuery=e.$=f),f});
        	IV$ = window.IV$ = jQuery.noConflict(true); 
        }else{
            if($().jquery !== '1.4.4'){
                IV$ = $;
            }else{
                !function(e,t){"object"==typeof module&&"object"==typeof module.exports?module.exports=e.document?t(e,!0):function(e){if(!e.document)throw new Error("jQuery requires a window with a document");return t(e)}:t(e)}("undefined"!=typeof window?window:this,function(e,t){var n=[],r=n.slice,i=n.concat,o=n.push,a=n.indexOf,s={},l=s.toString,u=s.hasOwnProperty,c={},d="1.11.2",f=function(e,t){return new f.fn.init(e,t)},p=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,h=/^-ms-/,m=/-([\da-z])/gi,g=function(e,t){return t.toUpperCase()};function v(e){var t=e.length,n=f.type(e);return"function"!==n&&!f.isWindow(e)&&(!(1!==e.nodeType||!t)||("array"===n||0===t||"number"==typeof t&&t>0&&t-1 in e))}f.fn=f.prototype={jquery:d,constructor:f,selector:"",length:0,toArray:function(){return r.call(this)},get:function(e){return null!=e?0>e?this[e+this.length]:this[e]:r.call(this)},pushStack:function(e){var t=f.merge(this.constructor(),e);return t.prevObject=this,t.context=this.context,t},each:function(e,t){return f.each(this,e,t)},map:function(e){return this.pushStack(f.map(this,function(t,n){return e.call(t,n,t)}))},slice:function(){return this.pushStack(r.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(e){var t=this.length,n=+e+(0>e?t:0);return this.pushStack(n>=0&&t>n?[this[n]]:[])},end:function(){return this.prevObject||this.constructor(null)},push:o,sort:n.sort,splice:n.splice},f.extend=f.fn.extend=function(){var e,t,n,r,i,o,a=arguments[0]||{},s=1,l=arguments.length,u=!1;for("boolean"==typeof a&&(u=a,a=arguments[s]||{},s++),"object"==typeof a||f.isFunction(a)||(a={}),s===l&&(a=this,s--);l>s;s++)if(null!=(i=arguments[s]))for(r in i)e=a[r],a!==(n=i[r])&&(u&&n&&(f.isPlainObject(n)||(t=f.isArray(n)))?(t?(t=!1,o=e&&f.isArray(e)?e:[]):o=e&&f.isPlainObject(e)?e:{},a[r]=f.extend(u,o,n)):void 0!==n&&(a[r]=n));return a},f.extend({expando:"jQuery"+(d+Math.random()).replace(/\D/g,""),isReady:!0,error:function(e){throw new Error(e)},noop:function(){},isFunction:function(e){return"function"===f.type(e)},isArray:Array.isArray||function(e){return"array"===f.type(e)},isWindow:function(e){return null!=e&&e==e.window},isNumeric:function(e){return!f.isArray(e)&&e-parseFloat(e)+1>=0},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},isPlainObject:function(e){var t;if(!e||"object"!==f.type(e)||e.nodeType||f.isWindow(e))return!1;try{if(e.constructor&&!u.call(e,"constructor")&&!u.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(e){return!1}if(c.ownLast)for(t in e)return u.call(e,t);for(t in e);return void 0===t||u.call(e,t)},type:function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?s[l.call(e)]||"object":typeof e},globalEval:function(t){t&&f.trim(t)&&(e.execScript||function(t){e.eval.call(e,t)})(t)},camelCase:function(e){return e.replace(h,"ms-").replace(m,g)},nodeName:function(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()},each:function(e,t,n){var r=0,i=e.length,o=v(e);if(n){if(o)for(;i>r&&!1!==t.apply(e[r],n);r++);else for(r in e)if(!1===t.apply(e[r],n))break}else if(o)for(;i>r&&!1!==t.call(e[r],r,e[r]);r++);else for(r in e)if(!1===t.call(e[r],r,e[r]))break;return e},trim:function(e){return null==e?"":(e+"").replace(p,"")},makeArray:function(e,t){var n=t||[];return null!=e&&(v(Object(e))?f.merge(n,"string"==typeof e?[e]:e):o.call(n,e)),n},inArray:function(e,t,n){var r;if(t){if(a)return a.call(t,e,n);for(r=t.length,n=n?0>n?Math.max(0,r+n):n:0;r>n;n++)if(n in t&&t[n]===e)return n}return-1},merge:function(e,t){for(var n=+t.length,r=0,i=e.length;n>r;)e[i++]=t[r++];if(n!=n)for(;void 0!==t[r];)e[i++]=t[r++];return e.length=i,e},grep:function(e,t,n){for(var r=[],i=0,o=e.length,a=!n;o>i;i++)!t(e[i],i)!==a&&r.push(e[i]);return r},map:function(e,t,n){var r,o=0,a=e.length,s=[];if(v(e))for(;a>o;o++)null!=(r=t(e[o],o,n))&&s.push(r);else for(o in e)null!=(r=t(e[o],o,n))&&s.push(r);return i.apply([],s)},guid:1,proxy:function(e,t){var n,i,o;return"string"==typeof t&&(o=e[t],t=e,e=o),f.isFunction(e)?(n=r.call(arguments,2),(i=function(){return e.apply(t||this,n.concat(r.call(arguments)))}).guid=e.guid=e.guid||f.guid++,i):void 0},now:function(){return+new Date},support:c}),f.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(e,t){s["[object "+t+"]"]=t.toLowerCase()});var y=function(e){var t,n,r,i,o,a,s,l,u,c,d,f,p,h,m,g,v,y,b,x="sizzle"+1*new Date,w=e.document,T=0,C=0,N=ae(),E=ae(),k=ae(),S=function(e,t){return e===t&&(d=!0),0},A=1<<31,D={}.hasOwnProperty,j=[],L=j.pop,H=j.push,q=j.push,_=j.slice,M=function(e,t){for(var n=0,r=e.length;r>n;n++)if(e[n]===t)return n;return-1},F="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",O="[\\x20\\t\\r\\n\\f]",B="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",P=B.replace("w","w#"),R="\\["+O+"*("+B+")(?:"+O+"*([*^$|!~]?=)"+O+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+P+"))|)"+O+"*\\]",W=":("+B+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+R+")*)|.*)\\)|)",$=new RegExp(O+"+","g"),z=new RegExp("^"+O+"+|((?:^|[^\\\\])(?:\\\\.)*)"+O+"+$","g"),I=new RegExp("^"+O+"*,"+O+"*"),X=new RegExp("^"+O+"*([>+~]|"+O+")"+O+"*"),U=new RegExp("="+O+"*([^\\]'\"]*?)"+O+"*\\]","g"),V=new RegExp(W),J=new RegExp("^"+P+"$"),Y={ID:new RegExp("^#("+B+")"),CLASS:new RegExp("^\\.("+B+")"),TAG:new RegExp("^("+B.replace("w","w*")+")"),ATTR:new RegExp("^"+R),PSEUDO:new RegExp("^"+W),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+O+"*(even|odd|(([+-]|)(\\d*)n|)"+O+"*(?:([+-]|)"+O+"*(\\d+)|))"+O+"*\\)|)","i"),bool:new RegExp("^(?:"+F+")$","i"),needsContext:new RegExp("^"+O+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+O+"*((?:-\\d)?\\d*)"+O+"*\\)|)(?=[^-]|$)","i")},G=/^(?:input|select|textarea|button)$/i,Q=/^h\d$/i,K=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ee=/[+~]/,te=/'|\\/g,ne=new RegExp("\\\\([\\da-f]{1,6}"+O+"?|("+O+")|.)","ig"),re=function(e,t,n){var r="0x"+t-65536;return r!=r||n?t:0>r?String.fromCharCode(r+65536):String.fromCharCode(r>>10|55296,1023&r|56320)},ie=function(){f()};try{q.apply(j=_.call(w.childNodes),w.childNodes),j[w.childNodes.length].nodeType}catch(e){q={apply:j.length?function(e,t){H.apply(e,_.call(t))}:function(e,t){for(var n=e.length,r=0;e[n++]=t[r++];);e.length=n-1}}}function oe(e,t,r,i){var o,s,u,c,d,h,v,y,T,C;if((t?t.ownerDocument||t:w)!==p&&f(t),r=r||[],c=(t=t||p).nodeType,"string"!=typeof e||!e||1!==c&&9!==c&&11!==c)return r;if(!i&&m){if(11!==c&&(o=Z.exec(e)))if(u=o[1]){if(9===c){if(!(s=t.getElementById(u))||!s.parentNode)return r;if(s.id===u)return r.push(s),r}else if(t.ownerDocument&&(s=t.ownerDocument.getElementById(u))&&b(t,s)&&s.id===u)return r.push(s),r}else{if(o[2])return q.apply(r,t.getElementsByTagName(e)),r;if((u=o[3])&&n.getElementsByClassName)return q.apply(r,t.getElementsByClassName(u)),r}if(n.qsa&&(!g||!g.test(e))){if(y=v=x,T=t,C=1!==c&&e,1===c&&"object"!==t.nodeName.toLowerCase()){for(h=a(e),(v=t.getAttribute("id"))?y=v.replace(te,"\\$&"):t.setAttribute("id",y),y="[id='"+y+"'] ",d=h.length;d--;)h[d]=y+ge(h[d]);T=ee.test(e)&&he(t.parentNode)||t,C=h.join(",")}if(C)try{return q.apply(r,T.querySelectorAll(C)),r}catch(e){}finally{v||t.removeAttribute("id")}}}return l(e.replace(z,"$1"),t,r,i)}function ae(){var e=[];return function t(n,i){return e.push(n+" ")>r.cacheLength&&delete t[e.shift()],t[n+" "]=i}}function se(e){return e[x]=!0,e}function le(e){var t=p.createElement("div");try{return!!e(t)}catch(e){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function ue(e,t){for(var n=e.split("|"),i=e.length;i--;)r.attrHandle[n[i]]=t}function ce(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||A)-(~e.sourceIndex||A);if(r)return r;if(n)for(;n=n.nextSibling;)if(n===t)return-1;return e?1:-1}function de(e){return function(t){return"input"===t.nodeName.toLowerCase()&&t.type===e}}function fe(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function pe(e){return se(function(t){return t=+t,se(function(n,r){for(var i,o=e([],n.length,t),a=o.length;a--;)n[i=o[a]]&&(n[i]=!(r[i]=n[i]))})})}function he(e){return e&&void 0!==e.getElementsByTagName&&e}for(t in n=oe.support={},o=oe.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return!!t&&"HTML"!==t.nodeName},f=oe.setDocument=function(e){var t,i,a=e?e.ownerDocument||e:w;return a!==p&&9===a.nodeType&&a.documentElement?(p=a,h=a.documentElement,(i=a.defaultView)&&i!==i.top&&(i.addEventListener?i.addEventListener("unload",ie,!1):i.attachEvent&&i.attachEvent("onunload",ie)),m=!o(a),n.attributes=le(function(e){return e.className="i",!e.getAttribute("className")}),n.getElementsByTagName=le(function(e){return e.appendChild(a.createComment("")),!e.getElementsByTagName("*").length}),n.getElementsByClassName=K.test(a.getElementsByClassName),n.getById=le(function(e){return h.appendChild(e).id=x,!a.getElementsByName||!a.getElementsByName(x).length}),n.getById?(r.find.ID=function(e,t){if(void 0!==t.getElementById&&m){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){return e.getAttribute("id")===t}}):(delete r.find.ID,r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){var n=void 0!==e.getAttributeNode&&e.getAttributeNode("id");return n&&n.value===t}}),r.find.TAG=n.getElementsByTagName?function(e,t){return void 0!==t.getElementsByTagName?t.getElementsByTagName(e):n.qsa?t.querySelectorAll(e):void 0}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){for(;n=o[i++];)1===n.nodeType&&r.push(n);return r}return o},r.find.CLASS=n.getElementsByClassName&&function(e,t){return m?t.getElementsByClassName(e):void 0},v=[],g=[],(n.qsa=K.test(a.querySelectorAll))&&(le(function(e){h.appendChild(e).innerHTML="<a id='"+x+"'></a><select id='"+x+"-\f]' msallowcapture=''><option selected=''></option></select>",e.querySelectorAll("[msallowcapture^='']").length&&g.push("[*^$]="+O+"*(?:''|\"\")"),e.querySelectorAll("[selected]").length||g.push("\\["+O+"*(?:value|"+F+")"),e.querySelectorAll("[id~="+x+"-]").length||g.push("~="),e.querySelectorAll(":checked").length||g.push(":checked"),e.querySelectorAll("a#"+x+"+*").length||g.push(".#.+[+~]")}),le(function(e){var t=a.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("name","D"),e.querySelectorAll("[name=d]").length&&g.push("name"+O+"*[*^$|!~]?="),e.querySelectorAll(":enabled").length||g.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),g.push(",.*:")})),(n.matchesSelector=K.test(y=h.matches||h.webkitMatchesSelector||h.mozMatchesSelector||h.oMatchesSelector||h.msMatchesSelector))&&le(function(e){n.disconnectedMatch=y.call(e,"div"),y.call(e,"[s!='']:x"),v.push("!=",W)}),g=g.length&&new RegExp(g.join("|")),v=v.length&&new RegExp(v.join("|")),t=K.test(h.compareDocumentPosition),b=t||K.test(h.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)for(;t=t.parentNode;)if(t===e)return!0;return!1},S=t?function(e,t){if(e===t)return d=!0,0;var r=!e.compareDocumentPosition-!t.compareDocumentPosition;return r||(1&(r=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):1)||!n.sortDetached&&t.compareDocumentPosition(e)===r?e===a||e.ownerDocument===w&&b(w,e)?-1:t===a||t.ownerDocument===w&&b(w,t)?1:c?M(c,e)-M(c,t):0:4&r?-1:1)}:function(e,t){if(e===t)return d=!0,0;var n,r=0,i=e.parentNode,o=t.parentNode,s=[e],l=[t];if(!i||!o)return e===a?-1:t===a?1:i?-1:o?1:c?M(c,e)-M(c,t):0;if(i===o)return ce(e,t);for(n=e;n=n.parentNode;)s.unshift(n);for(n=t;n=n.parentNode;)l.unshift(n);for(;s[r]===l[r];)r++;return r?ce(s[r],l[r]):s[r]===w?-1:l[r]===w?1:0},a):p},oe.matches=function(e,t){return oe(e,null,null,t)},oe.matchesSelector=function(e,t){if((e.ownerDocument||e)!==p&&f(e),t=t.replace(U,"='$1']"),!(!n.matchesSelector||!m||v&&v.test(t)||g&&g.test(t)))try{var r=y.call(e,t);if(r||n.disconnectedMatch||e.document&&11!==e.document.nodeType)return r}catch(e){}return oe(t,p,null,[e]).length>0},oe.contains=function(e,t){return(e.ownerDocument||e)!==p&&f(e),b(e,t)},oe.attr=function(e,t){(e.ownerDocument||e)!==p&&f(e);var i=r.attrHandle[t.toLowerCase()],o=i&&D.call(r.attrHandle,t.toLowerCase())?i(e,t,!m):void 0;return void 0!==o?o:n.attributes||!m?e.getAttribute(t):(o=e.getAttributeNode(t))&&o.specified?o.value:null},oe.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},oe.uniqueSort=function(e){var t,r=[],i=0,o=0;if(d=!n.detectDuplicates,c=!n.sortStable&&e.slice(0),e.sort(S),d){for(;t=e[o++];)t===e[o]&&(i=r.push(o));for(;i--;)e.splice(r[i],1)}return c=null,e},i=oe.getText=function(e){var t,n="",r=0,o=e.nodeType;if(o){if(1===o||9===o||11===o){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=i(e)}else if(3===o||4===o)return e.nodeValue}else for(;t=e[r++];)n+=i(t);return n},(r=oe.selectors={cacheLength:50,createPseudo:se,match:Y,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(ne,re),e[3]=(e[3]||e[4]||e[5]||"").replace(ne,re),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||oe.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&oe.error(e[0]),e},PSEUDO:function(e){var t,n=!e[6]&&e[2];return Y.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&V.test(n)&&(t=a(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(ne,re).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=N[e+" "];return t||(t=new RegExp("(^|"+O+")"+e+"("+O+"|$)"))&&N(e,function(e){return t.test("string"==typeof e.className&&e.className||void 0!==e.getAttribute&&e.getAttribute("class")||"")})},ATTR:function(e,t,n){return function(r){var i=oe.attr(r,e);return null==i?"!="===t:!t||(i+="","="===t?i===n:"!="===t?i!==n:"^="===t?n&&0===i.indexOf(n):"*="===t?n&&i.indexOf(n)>-1:"$="===t?n&&i.slice(-n.length)===n:"~="===t?(" "+i.replace($," ")+" ").indexOf(n)>-1:"|="===t&&(i===n||i.slice(0,n.length+1)===n+"-"))}},CHILD:function(e,t,n,r,i){var o="nth"!==e.slice(0,3),a="last"!==e.slice(-4),s="of-type"===t;return 1===r&&0===i?function(e){return!!e.parentNode}:function(t,n,l){var u,c,d,f,p,h,m=o!==a?"nextSibling":"previousSibling",g=t.parentNode,v=s&&t.nodeName.toLowerCase(),y=!l&&!s;if(g){if(o){for(;m;){for(d=t;d=d[m];)if(s?d.nodeName.toLowerCase()===v:1===d.nodeType)return!1;h=m="only"===e&&!h&&"nextSibling"}return!0}if(h=[a?g.firstChild:g.lastChild],a&&y){for(p=(u=(c=g[x]||(g[x]={}))[e]||[])[0]===T&&u[1],f=u[0]===T&&u[2],d=p&&g.childNodes[p];d=++p&&d&&d[m]||(f=p=0)||h.pop();)if(1===d.nodeType&&++f&&d===t){c[e]=[T,p,f];break}}else if(y&&(u=(t[x]||(t[x]={}))[e])&&u[0]===T)f=u[1];else for(;(d=++p&&d&&d[m]||(f=p=0)||h.pop())&&((s?d.nodeName.toLowerCase()!==v:1!==d.nodeType)||!++f||(y&&((d[x]||(d[x]={}))[e]=[T,f]),d!==t)););return(f-=i)===r||f%r==0&&f/r>=0}}},PSEUDO:function(e,t){var n,i=r.pseudos[e]||r.setFilters[e.toLowerCase()]||oe.error("unsupported pseudo: "+e);return i[x]?i(t):i.length>1?(n=[e,e,"",t],r.setFilters.hasOwnProperty(e.toLowerCase())?se(function(e,n){for(var r,o=i(e,t),a=o.length;a--;)e[r=M(e,o[a])]=!(n[r]=o[a])}):function(e){return i(e,0,n)}):i}},pseudos:{not:se(function(e){var t=[],n=[],r=s(e.replace(z,"$1"));return r[x]?se(function(e,t,n,i){for(var o,a=r(e,null,i,[]),s=e.length;s--;)(o=a[s])&&(e[s]=!(t[s]=o))}):function(e,i,o){return t[0]=e,r(t,null,o,n),t[0]=null,!n.pop()}}),has:se(function(e){return function(t){return oe(e,t).length>0}}),contains:se(function(e){return e=e.replace(ne,re),function(t){return(t.textContent||t.innerText||i(t)).indexOf(e)>-1}}),lang:se(function(e){return J.test(e||"")||oe.error("unsupported lang: "+e),e=e.replace(ne,re).toLowerCase(),function(t){var n;do{if(n=m?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang"))return(n=n.toLowerCase())===e||0===n.indexOf(e+"-")}while((t=t.parentNode)&&1===t.nodeType);return!1}}),target:function(t){var n=e.location&&e.location.hash;return n&&n.slice(1)===t.id},root:function(e){return e===h},focus:function(e){return e===p.activeElement&&(!p.hasFocus||p.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return!1===e.disabled},disabled:function(e){return!0===e.disabled},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,!0===e.selected},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!r.pseudos.empty(e)},header:function(e){return Q.test(e.nodeName)},input:function(e){return G.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:pe(function(){return[0]}),last:pe(function(e,t){return[t-1]}),eq:pe(function(e,t,n){return[0>n?n+t:n]}),even:pe(function(e,t){for(var n=0;t>n;n+=2)e.push(n);return e}),odd:pe(function(e,t){for(var n=1;t>n;n+=2)e.push(n);return e}),lt:pe(function(e,t,n){for(var r=0>n?n+t:n;--r>=0;)e.push(r);return e}),gt:pe(function(e,t,n){for(var r=0>n?n+t:n;++r<t;)e.push(r);return e})}}).pseudos.nth=r.pseudos.eq,{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})r.pseudos[t]=de(t);for(t in{submit:!0,reset:!0})r.pseudos[t]=fe(t);function me(){}function ge(e){for(var t=0,n=e.length,r="";n>t;t++)r+=e[t].value;return r}function ve(e,t,n){var r=t.dir,i=n&&"parentNode"===r,o=C++;return t.first?function(t,n,o){for(;t=t[r];)if(1===t.nodeType||i)return e(t,n,o)}:function(t,n,a){var s,l,u=[T,o];if(a){for(;t=t[r];)if((1===t.nodeType||i)&&e(t,n,a))return!0}else for(;t=t[r];)if(1===t.nodeType||i){if((s=(l=t[x]||(t[x]={}))[r])&&s[0]===T&&s[1]===o)return u[2]=s[2];if(l[r]=u,u[2]=e(t,n,a))return!0}}}function ye(e){return e.length>1?function(t,n,r){for(var i=e.length;i--;)if(!e[i](t,n,r))return!1;return!0}:e[0]}function be(e,t,n,r,i){for(var o,a=[],s=0,l=e.length,u=null!=t;l>s;s++)(o=e[s])&&(!n||n(o,r,i))&&(a.push(o),u&&t.push(s));return a}function xe(e,t,n,r,i,o){return r&&!r[x]&&(r=xe(r)),i&&!i[x]&&(i=xe(i,o)),se(function(o,a,s,l){var u,c,d,f=[],p=[],h=a.length,m=o||function(e,t,n){for(var r=0,i=t.length;i>r;r++)oe(e,t[r],n);return n}(t||"*",s.nodeType?[s]:s,[]),g=!e||!o&&t?m:be(m,f,e,s,l),v=n?i||(o?e:h||r)?[]:a:g;if(n&&n(g,v,s,l),r)for(u=be(v,p),r(u,[],s,l),c=u.length;c--;)(d=u[c])&&(v[p[c]]=!(g[p[c]]=d));if(o){if(i||e){if(i){for(u=[],c=v.length;c--;)(d=v[c])&&u.push(g[c]=d);i(null,v=[],u,l)}for(c=v.length;c--;)(d=v[c])&&(u=i?M(o,d):f[c])>-1&&(o[u]=!(a[u]=d))}}else v=be(v===a?v.splice(h,v.length):v),i?i(null,a,v,l):q.apply(a,v)})}function we(e){for(var t,n,i,o=e.length,a=r.relative[e[0].type],s=a||r.relative[" "],l=a?1:0,c=ve(function(e){return e===t},s,!0),d=ve(function(e){return M(t,e)>-1},s,!0),f=[function(e,n,r){var i=!a&&(r||n!==u)||((t=n).nodeType?c(e,n,r):d(e,n,r));return t=null,i}];o>l;l++)if(n=r.relative[e[l].type])f=[ve(ye(f),n)];else{if((n=r.filter[e[l].type].apply(null,e[l].matches))[x]){for(i=++l;o>i&&!r.relative[e[i].type];i++);return xe(l>1&&ye(f),l>1&&ge(e.slice(0,l-1).concat({value:" "===e[l-2].type?"*":""})).replace(z,"$1"),n,i>l&&we(e.slice(l,i)),o>i&&we(e=e.slice(i)),o>i&&ge(e))}f.push(n)}return ye(f)}function Te(e,t){var n=t.length>0,i=e.length>0,o=function(o,a,s,l,c){var d,f,h,m=0,g="0",v=o&&[],y=[],b=u,x=o||i&&r.find.TAG("*",c),w=T+=null==b?1:Math.random()||.1,C=x.length;for(c&&(u=a!==p&&a);g!==C&&null!=(d=x[g]);g++){if(i&&d){for(f=0;h=e[f++];)if(h(d,a,s)){l.push(d);break}c&&(T=w)}n&&((d=!h&&d)&&m--,o&&v.push(d))}if(m+=g,n&&g!==m){for(f=0;h=t[f++];)h(v,y,a,s);if(o){if(m>0)for(;g--;)v[g]||y[g]||(y[g]=L.call(l));y=be(y)}q.apply(l,y),c&&!o&&y.length>0&&m+t.length>1&&oe.uniqueSort(l)}return c&&(T=w,u=b),v};return n?se(o):o}return me.prototype=r.filters=r.pseudos,r.setFilters=new me,a=oe.tokenize=function(e,t){var n,i,o,a,s,l,u,c=E[e+" "];if(c)return t?0:c.slice(0);for(s=e,l=[],u=r.preFilter;s;){for(a in(!n||(i=I.exec(s)))&&(i&&(s=s.slice(i[0].length)||s),l.push(o=[])),n=!1,(i=X.exec(s))&&(n=i.shift(),o.push({value:n,type:i[0].replace(z," ")}),s=s.slice(n.length)),r.filter)!(i=Y[a].exec(s))||u[a]&&!(i=u[a](i))||(n=i.shift(),o.push({value:n,type:a,matches:i}),s=s.slice(n.length));if(!n)break}return t?s.length:s?oe.error(e):E(e,l).slice(0)},s=oe.compile=function(e,t){var n,r=[],i=[],o=k[e+" "];if(!o){for(t||(t=a(e)),n=t.length;n--;)(o=we(t[n]))[x]?r.push(o):i.push(o);(o=k(e,Te(i,r))).selector=e}return o},l=oe.select=function(e,t,i,o){var l,u,c,d,f,p="function"==typeof e&&e,h=!o&&a(e=p.selector||e);if(i=i||[],1===h.length){if((u=h[0]=h[0].slice(0)).length>2&&"ID"===(c=u[0]).type&&n.getById&&9===t.nodeType&&m&&r.relative[u[1].type]){if(!(t=(r.find.ID(c.matches[0].replace(ne,re),t)||[])[0]))return i;p&&(t=t.parentNode),e=e.slice(u.shift().value.length)}for(l=Y.needsContext.test(e)?0:u.length;l--&&(c=u[l],!r.relative[d=c.type]);)if((f=r.find[d])&&(o=f(c.matches[0].replace(ne,re),ee.test(u[0].type)&&he(t.parentNode)||t))){if(u.splice(l,1),!(e=o.length&&ge(u)))return q.apply(i,o),i;break}}return(p||s(e,h))(o,t,!m,i,ee.test(e)&&he(t.parentNode)||t),i},n.sortStable=x.split("").sort(S).join("")===x,n.detectDuplicates=!!d,f(),n.sortDetached=le(function(e){return 1&e.compareDocumentPosition(p.createElement("div"))}),le(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||ue("type|href|height|width",function(e,t,n){return n?void 0:e.getAttribute(t,"type"===t.toLowerCase()?1:2)}),n.attributes&&le(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||ue("value",function(e,t,n){return n||"input"!==e.nodeName.toLowerCase()?void 0:e.defaultValue}),le(function(e){return null==e.getAttribute("disabled")})||ue(F,function(e,t,n){var r;return n?void 0:!0===e[t]?t.toLowerCase():(r=e.getAttributeNode(t))&&r.specified?r.value:null}),oe}(e);f.find=y,f.expr=y.selectors,f.expr[":"]=f.expr.pseudos,f.unique=y.uniqueSort,f.text=y.getText,f.isXMLDoc=y.isXML,f.contains=y.contains;var b=f.expr.match.needsContext,x=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,w=/^.[^:#\[\.,]*$/;function T(e,t,n){if(f.isFunction(t))return f.grep(e,function(e,r){return!!t.call(e,r,e)!==n});if(t.nodeType)return f.grep(e,function(e){return e===t!==n});if("string"==typeof t){if(w.test(t))return f.filter(t,e,n);t=f.filter(t,e)}return f.grep(e,function(e){return f.inArray(e,t)>=0!==n})}f.filter=function(e,t,n){var r=t[0];return n&&(e=":not("+e+")"),1===t.length&&1===r.nodeType?f.find.matchesSelector(r,e)?[r]:[]:f.find.matches(e,f.grep(t,function(e){return 1===e.nodeType}))},f.fn.extend({find:function(e){var t,n=[],r=this,i=r.length;if("string"!=typeof e)return this.pushStack(f(e).filter(function(){for(t=0;i>t;t++)if(f.contains(r[t],this))return!0}));for(t=0;i>t;t++)f.find(e,r[t],n);return(n=this.pushStack(i>1?f.unique(n):n)).selector=this.selector?this.selector+" "+e:e,n},filter:function(e){return this.pushStack(T(this,e||[],!1))},not:function(e){return this.pushStack(T(this,e||[],!0))},is:function(e){return!!T(this,"string"==typeof e&&b.test(e)?f(e):e||[],!1).length}});var C,N=e.document,E=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;(f.fn.init=function(e,t){var n,r;if(!e)return this;if("string"==typeof e){if(!(n="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:E.exec(e))||!n[1]&&t)return!t||t.jquery?(t||C).find(e):this.constructor(t).find(e);if(n[1]){if(t=t instanceof f?t[0]:t,f.merge(this,f.parseHTML(n[1],t&&t.nodeType?t.ownerDocument||t:N,!0)),x.test(n[1])&&f.isPlainObject(t))for(n in t)f.isFunction(this[n])?this[n](t[n]):this.attr(n,t[n]);return this}if((r=N.getElementById(n[2]))&&r.parentNode){if(r.id!==n[2])return C.find(e);this.length=1,this[0]=r}return this.context=N,this.selector=e,this}return e.nodeType?(this.context=this[0]=e,this.length=1,this):f.isFunction(e)?void 0!==C.ready?C.ready(e):e(f):(void 0!==e.selector&&(this.selector=e.selector,this.context=e.context),f.makeArray(e,this))}).prototype=f.fn,C=f(N);var k=/^(?:parents|prev(?:Until|All))/,S={children:!0,contents:!0,next:!0,prev:!0};function A(e,t){do{e=e[t]}while(e&&1!==e.nodeType);return e}f.extend({dir:function(e,t,n){for(var r=[],i=e[t];i&&9!==i.nodeType&&(void 0===n||1!==i.nodeType||!f(i).is(n));)1===i.nodeType&&r.push(i),i=i[t];return r},sibling:function(e,t){for(var n=[];e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n}}),f.fn.extend({has:function(e){var t,n=f(e,this),r=n.length;return this.filter(function(){for(t=0;r>t;t++)if(f.contains(this,n[t]))return!0})},closest:function(e,t){for(var n,r=0,i=this.length,o=[],a=b.test(e)||"string"!=typeof e?f(e,t||this.context):0;i>r;r++)for(n=this[r];n&&n!==t;n=n.parentNode)if(n.nodeType<11&&(a?a.index(n)>-1:1===n.nodeType&&f.find.matchesSelector(n,e))){o.push(n);break}return this.pushStack(o.length>1?f.unique(o):o)},index:function(e){return e?"string"==typeof e?f.inArray(this[0],f(e)):f.inArray(e.jquery?e[0]:e,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(e,t){return this.pushStack(f.unique(f.merge(this.get(),f(e,t))))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}}),f.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return f.dir(e,"parentNode")},parentsUntil:function(e,t,n){return f.dir(e,"parentNode",n)},next:function(e){return A(e,"nextSibling")},prev:function(e){return A(e,"previousSibling")},nextAll:function(e){return f.dir(e,"nextSibling")},prevAll:function(e){return f.dir(e,"previousSibling")},nextUntil:function(e,t,n){return f.dir(e,"nextSibling",n)},prevUntil:function(e,t,n){return f.dir(e,"previousSibling",n)},siblings:function(e){return f.sibling((e.parentNode||{}).firstChild,e)},children:function(e){return f.sibling(e.firstChild)},contents:function(e){return f.nodeName(e,"iframe")?e.contentDocument||e.contentWindow.document:f.merge([],e.childNodes)}},function(e,t){f.fn[e]=function(n,r){var i=f.map(this,t,n);return"Until"!==e.slice(-5)&&(r=n),r&&"string"==typeof r&&(i=f.filter(r,i)),this.length>1&&(S[e]||(i=f.unique(i)),k.test(e)&&(i=i.reverse())),this.pushStack(i)}});var D,j=/\S+/g,L={};function H(){N.addEventListener?(N.removeEventListener("DOMContentLoaded",q,!1),e.removeEventListener("load",q,!1)):(N.detachEvent("onreadystatechange",q),e.detachEvent("onload",q))}function q(){(N.addEventListener||"load"===event.type||"complete"===N.readyState)&&(H(),f.ready())}f.Callbacks=function(e){e="string"==typeof e?L[e]||function(e){var t=L[e]={};return f.each(e.match(j)||[],function(e,n){t[n]=!0}),t}(e):f.extend({},e);var t,n,r,i,o,a,s=[],l=!e.once&&[],u=function(d){for(n=e.memory&&d,r=!0,o=a||0,a=0,i=s.length,t=!0;s&&i>o;o++)if(!1===s[o].apply(d[0],d[1])&&e.stopOnFalse){n=!1;break}t=!1,s&&(l?l.length&&u(l.shift()):n?s=[]:c.disable())},c={add:function(){if(s){var r=s.length;!function t(n){f.each(n,function(n,r){var i=f.type(r);"function"===i?e.unique&&c.has(r)||s.push(r):r&&r.length&&"string"!==i&&t(r)})}(arguments),t?i=s.length:n&&(a=r,u(n))}return this},remove:function(){return s&&f.each(arguments,function(e,n){for(var r;(r=f.inArray(n,s,r))>-1;)s.splice(r,1),t&&(i>=r&&i--,o>=r&&o--)}),this},has:function(e){return e?f.inArray(e,s)>-1:!(!s||!s.length)},empty:function(){return s=[],i=0,this},disable:function(){return s=l=n=void 0,this},disabled:function(){return!s},lock:function(){return l=void 0,n||c.disable(),this},locked:function(){return!l},fireWith:function(e,n){return!s||r&&!l||(n=[e,(n=n||[]).slice?n.slice():n],t?l.push(n):u(n)),this},fire:function(){return c.fireWith(this,arguments),this},fired:function(){return!!r}};return c},f.extend({Deferred:function(e){var t=[["resolve","done",f.Callbacks("once memory"),"resolved"],["reject","fail",f.Callbacks("once memory"),"rejected"],["notify","progress",f.Callbacks("memory")]],n="pending",r={state:function(){return n},always:function(){return i.done(arguments).fail(arguments),this},then:function(){var e=arguments;return f.Deferred(function(n){f.each(t,function(t,o){var a=f.isFunction(e[t])&&e[t];i[o[1]](function(){var e=a&&a.apply(this,arguments);e&&f.isFunction(e.promise)?e.promise().done(n.resolve).fail(n.reject).progress(n.notify):n[o[0]+"With"](this===r?n.promise():this,a?[e]:arguments)})}),e=null}).promise()},promise:function(e){return null!=e?f.extend(e,r):r}},i={};return r.pipe=r.then,f.each(t,function(e,o){var a=o[2],s=o[3];r[o[1]]=a.add,s&&a.add(function(){n=s},t[1^e][2].disable,t[2][2].lock),i[o[0]]=function(){return i[o[0]+"With"](this===i?r:this,arguments),this},i[o[0]+"With"]=a.fireWith}),r.promise(i),e&&e.call(i,i),i},when:function(e){var t,n,i,o=0,a=r.call(arguments),s=a.length,l=1!==s||e&&f.isFunction(e.promise)?s:0,u=1===l?e:f.Deferred(),c=function(e,n,i){return function(o){n[e]=this,i[e]=arguments.length>1?r.call(arguments):o,i===t?u.notifyWith(n,i):--l||u.resolveWith(n,i)}};if(s>1)for(t=new Array(s),n=new Array(s),i=new Array(s);s>o;o++)a[o]&&f.isFunction(a[o].promise)?a[o].promise().done(c(o,i,a)).fail(u.reject).progress(c(o,n,t)):--l;return l||u.resolveWith(i,a),u.promise()}}),f.fn.ready=function(e){return f.ready.promise().done(e),this},f.extend({isReady:!1,readyWait:1,holdReady:function(e){e?f.readyWait++:f.ready(!0)},ready:function(e){if(!0===e?!--f.readyWait:!f.isReady){if(!N.body)return setTimeout(f.ready);f.isReady=!0,!0!==e&&--f.readyWait>0||(D.resolveWith(N,[f]),f.fn.triggerHandler&&(f(N).triggerHandler("ready"),f(N).off("ready")))}}}),f.ready.promise=function(t){if(!D)if(D=f.Deferred(),"complete"===N.readyState)setTimeout(f.ready);else if(N.addEventListener)N.addEventListener("DOMContentLoaded",q,!1),e.addEventListener("load",q,!1);else{N.attachEvent("onreadystatechange",q),e.attachEvent("onload",q);var n=!1;try{n=null==e.frameElement&&N.documentElement}catch(e){}n&&n.doScroll&&function e(){if(!f.isReady){try{n.doScroll("left")}catch(t){return setTimeout(e,50)}H(),f.ready()}}()}return D.promise(t)};var _,M="undefined";for(_ in f(c))break;c.ownLast="0"!==_,c.inlineBlockNeedsLayout=!1,f(function(){var e,t,n,r;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",c.inlineBlockNeedsLayout=e=3===t.offsetWidth,e&&(n.style.zoom=1)),n.removeChild(r))}),function(){var e=N.createElement("div");if(null==c.deleteExpando){c.deleteExpando=!0;try{delete e.test}catch(e){c.deleteExpando=!1}}e=null}(),f.acceptData=function(e){var t=f.noData[(e.nodeName+" ").toLowerCase()],n=+e.nodeType||1;return(1===n||9===n)&&(!t||!0!==t&&e.getAttribute("classid")===t)};var F=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,O=/([A-Z])/g;function B(e,t,n){if(void 0===n&&1===e.nodeType){var r="data-"+t.replace(O,"-$1").toLowerCase();if("string"==typeof(n=e.getAttribute(r))){try{n="true"===n||"false"!==n&&("null"===n?null:+n+""===n?+n:F.test(n)?f.parseJSON(n):n)}catch(e){}f.data(e,t,n)}else n=void 0}return n}function P(e){var t;for(t in e)if(("data"!==t||!f.isEmptyObject(e[t]))&&"toJSON"!==t)return!1;return!0}function R(e,t,r,i){if(f.acceptData(e)){var o,a,s=f.expando,l=e.nodeType,u=l?f.cache:e,c=l?e[s]:e[s]&&s;if(c&&u[c]&&(i||u[c].data)||void 0!==r||"string"!=typeof t)return c||(c=l?e[s]=n.pop()||f.guid++:s),u[c]||(u[c]=l?{}:{toJSON:f.noop}),("object"==typeof t||"function"==typeof t)&&(i?u[c]=f.extend(u[c],t):u[c].data=f.extend(u[c].data,t)),a=u[c],i||(a.data||(a.data={}),a=a.data),void 0!==r&&(a[f.camelCase(t)]=r),"string"==typeof t?null==(o=a[t])&&(o=a[f.camelCase(t)]):o=a,o}}function W(e,t,n){if(f.acceptData(e)){var r,i,o=e.nodeType,a=o?f.cache:e,s=o?e[f.expando]:f.expando;if(a[s]){if(t&&(r=n?a[s]:a[s].data)){f.isArray(t)?t=t.concat(f.map(t,f.camelCase)):t in r?t=[t]:t=(t=f.camelCase(t))in r?[t]:t.split(" "),i=t.length;for(;i--;)delete r[t[i]];if(n?!P(r):!f.isEmptyObject(r))return}(n||(delete a[s].data,P(a[s])))&&(o?f.cleanData([e],!0):c.deleteExpando||a!=a.window?delete a[s]:a[s]=null)}}}f.extend({cache:{},noData:{"applet ":!0,"embed ":!0,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(e){return!!(e=e.nodeType?f.cache[e[f.expando]]:e[f.expando])&&!P(e)},data:function(e,t,n){return R(e,t,n)},removeData:function(e,t){return W(e,t)},_data:function(e,t,n){return R(e,t,n,!0)},_removeData:function(e,t){return W(e,t,!0)}}),f.fn.extend({data:function(e,t){var n,r,i,o=this[0],a=o&&o.attributes;if(void 0===e){if(this.length&&(i=f.data(o),1===o.nodeType&&!f._data(o,"parsedAttrs"))){for(n=a.length;n--;)a[n]&&(0===(r=a[n].name).indexOf("data-")&&B(o,r=f.camelCase(r.slice(5)),i[r]));f._data(o,"parsedAttrs",!0)}return i}return"object"==typeof e?this.each(function(){f.data(this,e)}):arguments.length>1?this.each(function(){f.data(this,e,t)}):o?B(o,e,f.data(o,e)):void 0},removeData:function(e){return this.each(function(){f.removeData(this,e)})}}),f.extend({queue:function(e,t,n){var r;return e?(t=(t||"fx")+"queue",r=f._data(e,t),n&&(!r||f.isArray(n)?r=f._data(e,t,f.makeArray(n)):r.push(n)),r||[]):void 0},dequeue:function(e,t){t=t||"fx";var n=f.queue(e,t),r=n.length,i=n.shift(),o=f._queueHooks(e,t);"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,function(){f.dequeue(e,t)},o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return f._data(e,n)||f._data(e,n,{empty:f.Callbacks("once memory").add(function(){f._removeData(e,t+"queue"),f._removeData(e,n)})})}}),f.fn.extend({queue:function(e,t){var n=2;return"string"!=typeof e&&(t=e,e="fx",n--),arguments.length<n?f.queue(this[0],e):void 0===t?this:this.each(function(){var n=f.queue(this,e,t);f._queueHooks(this,e),"fx"===e&&"inprogress"!==n[0]&&f.dequeue(this,e)})},dequeue:function(e){return this.each(function(){f.dequeue(this,e)})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,t){var n,r=1,i=f.Deferred(),o=this,a=this.length,s=function(){--r||i.resolveWith(o,[o])};for("string"!=typeof e&&(t=e,e=void 0),e=e||"fx";a--;)(n=f._data(o[a],e+"queueHooks"))&&n.empty&&(r++,n.empty.add(s));return s(),i.promise(t)}});var $=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,z=["Top","Right","Bottom","Left"],I=function(e,t){return e=t||e,"none"===f.css(e,"display")||!f.contains(e.ownerDocument,e)},X=f.access=function(e,t,n,r,i,o,a){var s=0,l=e.length,u=null==n;if("object"===f.type(n))for(s in i=!0,n)f.access(e,t,s,n[s],!0,o,a);else if(void 0!==r&&(i=!0,f.isFunction(r)||(a=!0),u&&(a?(t.call(e,r),t=null):(u=t,t=function(e,t,n){return u.call(f(e),n)})),t))for(;l>s;s++)t(e[s],n,a?r:r.call(e[s],s,t(e[s],n)));return i?e:u?t.call(e):l?t(e[0],n):o},U=/^(?:checkbox|radio)$/i;!function(){var e=N.createElement("input"),t=N.createElement("div"),n=N.createDocumentFragment();if(t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",c.leadingWhitespace=3===t.firstChild.nodeType,c.tbody=!t.getElementsByTagName("tbody").length,c.htmlSerialize=!!t.getElementsByTagName("link").length,c.html5Clone="<:nav></:nav>"!==N.createElement("nav").cloneNode(!0).outerHTML,e.type="checkbox",e.checked=!0,n.appendChild(e),c.appendChecked=e.checked,t.innerHTML="<textarea>x</textarea>",c.noCloneChecked=!!t.cloneNode(!0).lastChild.defaultValue,n.appendChild(t),t.innerHTML="<input type='radio' checked='checked' name='t'/>",c.checkClone=t.cloneNode(!0).cloneNode(!0).lastChild.checked,c.noCloneEvent=!0,t.attachEvent&&(t.attachEvent("onclick",function(){c.noCloneEvent=!1}),t.cloneNode(!0).click()),null==c.deleteExpando){c.deleteExpando=!0;try{delete t.test}catch(e){c.deleteExpando=!1}}}(),function(){var t,n,r=N.createElement("div");for(t in{submit:!0,change:!0,focusin:!0})n="on"+t,(c[t+"Bubbles"]=n in e)||(r.setAttribute(n,"t"),c[t+"Bubbles"]=!1===r.attributes[n].expando);r=null}();var V=/^(?:input|select|textarea)$/i,J=/^key/,Y=/^(?:mouse|pointer|contextmenu)|click/,G=/^(?:focusinfocus|focusoutblur)$/,Q=/^([^.]*)(?:\.(.+)|)$/;function K(){return!0}function Z(){return!1}function ee(){try{return N.activeElement}catch(e){}}function te(e){var t=ne.split("|"),n=e.createDocumentFragment();if(n.createElement)for(;t.length;)n.createElement(t.pop());return n}f.event={global:{},add:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f._data(e);if(v){for(n.handler&&(n=(l=n).handler,i=l.selector),n.guid||(n.guid=f.guid++),(a=v.events)||(a=v.events={}),(c=v.handle)||((c=v.handle=function(e){return typeof f===M||e&&f.event.triggered===e.type?void 0:f.event.dispatch.apply(c.elem,arguments)}).elem=e),s=(t=(t||"").match(j)||[""]).length;s--;)h=g=(o=Q.exec(t[s])||[])[1],m=(o[2]||"").split(".").sort(),h&&(u=f.event.special[h]||{},h=(i?u.delegateType:u.bindType)||h,u=f.event.special[h]||{},d=f.extend({type:h,origType:g,data:r,handler:n,guid:n.guid,selector:i,needsContext:i&&f.expr.match.needsContext.test(i),namespace:m.join(".")},l),(p=a[h])||((p=a[h]=[]).delegateCount=0,u.setup&&!1!==u.setup.call(e,r,m,c)||(e.addEventListener?e.addEventListener(h,c,!1):e.attachEvent&&e.attachEvent("on"+h,c))),u.add&&(u.add.call(e,d),d.handler.guid||(d.handler.guid=n.guid)),i?p.splice(p.delegateCount++,0,d):p.push(d),f.event.global[h]=!0);e=null}},remove:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f.hasData(e)&&f._data(e);if(v&&(c=v.events)){for(u=(t=(t||"").match(j)||[""]).length;u--;)if(h=g=(s=Q.exec(t[u])||[])[1],m=(s[2]||"").split(".").sort(),h){for(d=f.event.special[h]||{},p=c[h=(r?d.delegateType:d.bindType)||h]||[],s=s[2]&&new RegExp("(^|\\.)"+m.join("\\.(?:.*\\.|)")+"(\\.|$)"),l=o=p.length;o--;)a=p[o],!i&&g!==a.origType||n&&n.guid!==a.guid||s&&!s.test(a.namespace)||r&&r!==a.selector&&("**"!==r||!a.selector)||(p.splice(o,1),a.selector&&p.delegateCount--,d.remove&&d.remove.call(e,a));l&&!p.length&&(d.teardown&&!1!==d.teardown.call(e,m,v.handle)||f.removeEvent(e,h,v.handle),delete c[h])}else for(h in c)f.event.remove(e,h+t[u],n,r,!0);f.isEmptyObject(c)&&(delete v.handle,f._removeData(e,"events"))}},trigger:function(t,n,r,i){var o,a,s,l,c,d,p,h=[r||N],m=u.call(t,"type")?t.type:t,g=u.call(t,"namespace")?t.namespace.split("."):[];if(s=d=r=r||N,3!==r.nodeType&&8!==r.nodeType&&!G.test(m+f.event.triggered)&&(m.indexOf(".")>=0&&(g=m.split("."),m=g.shift(),g.sort()),a=m.indexOf(":")<0&&"on"+m,(t=t[f.expando]?t:new f.Event(m,"object"==typeof t&&t)).isTrigger=i?2:3,t.namespace=g.join("."),t.namespace_re=t.namespace?new RegExp("(^|\\.)"+g.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,t.result=void 0,t.target||(t.target=r),n=null==n?[t]:f.makeArray(n,[t]),c=f.event.special[m]||{},i||!c.trigger||!1!==c.trigger.apply(r,n))){if(!i&&!c.noBubble&&!f.isWindow(r)){for(l=c.delegateType||m,G.test(l+m)||(s=s.parentNode);s;s=s.parentNode)h.push(s),d=s;d===(r.ownerDocument||N)&&h.push(d.defaultView||d.parentWindow||e)}for(p=0;(s=h[p++])&&!t.isPropagationStopped();)t.type=p>1?l:c.bindType||m,(o=(f._data(s,"events")||{})[t.type]&&f._data(s,"handle"))&&o.apply(s,n),(o=a&&s[a])&&o.apply&&f.acceptData(s)&&(t.result=o.apply(s,n),!1===t.result&&t.preventDefault());if(t.type=m,!i&&!t.isDefaultPrevented()&&(!c._default||!1===c._default.apply(h.pop(),n))&&f.acceptData(r)&&a&&r[m]&&!f.isWindow(r)){(d=r[a])&&(r[a]=null),f.event.triggered=m;try{r[m]()}catch(e){}f.event.triggered=void 0,d&&(r[a]=d)}return t.result}},dispatch:function(e){e=f.event.fix(e);var t,n,i,o,a,s=[],l=r.call(arguments),u=(f._data(this,"events")||{})[e.type]||[],c=f.event.special[e.type]||{};if(l[0]=e,e.delegateTarget=this,!c.preDispatch||!1!==c.preDispatch.call(this,e)){for(s=f.event.handlers.call(this,e,u),t=0;(o=s[t++])&&!e.isPropagationStopped();)for(e.currentTarget=o.elem,a=0;(i=o.handlers[a++])&&!e.isImmediatePropagationStopped();)(!e.namespace_re||e.namespace_re.test(i.namespace))&&(e.handleObj=i,e.data=i.data,void 0!==(n=((f.event.special[i.origType]||{}).handle||i.handler).apply(o.elem,l))&&!1===(e.result=n)&&(e.preventDefault(),e.stopPropagation()));return c.postDispatch&&c.postDispatch.call(this,e),e.result}},handlers:function(e,t){var n,r,i,o,a=[],s=t.delegateCount,l=e.target;if(s&&l.nodeType&&(!e.button||"click"!==e.type))for(;l!=this;l=l.parentNode||this)if(1===l.nodeType&&(!0!==l.disabled||"click"!==e.type)){for(i=[],o=0;s>o;o++)void 0===i[n=(r=t[o]).selector+" "]&&(i[n]=r.needsContext?f(n,this).index(l)>=0:f.find(n,this,null,[l]).length),i[n]&&i.push(r);i.length&&a.push({elem:l,handlers:i})}return s<t.length&&a.push({elem:this,handlers:t.slice(s)}),a},fix:function(e){if(e[f.expando])return e;var t,n,r,i=e.type,o=e,a=this.fixHooks[i];for(a||(this.fixHooks[i]=a=Y.test(i)?this.mouseHooks:J.test(i)?this.keyHooks:{}),r=a.props?this.props.concat(a.props):this.props,e=new f.Event(o),t=r.length;t--;)e[n=r[t]]=o[n];return e.target||(e.target=o.srcElement||N),3===e.target.nodeType&&(e.target=e.target.parentNode),e.metaKey=!!e.metaKey,a.filter?a.filter(e,o):e},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(e,t){return null==e.which&&(e.which=null!=t.charCode?t.charCode:t.keyCode),e}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(e,t){var n,r,i,o=t.button,a=t.fromElement;return null==e.pageX&&null!=t.clientX&&(i=(r=e.target.ownerDocument||N).documentElement,n=r.body,e.pageX=t.clientX+(i&&i.scrollLeft||n&&n.scrollLeft||0)-(i&&i.clientLeft||n&&n.clientLeft||0),e.pageY=t.clientY+(i&&i.scrollTop||n&&n.scrollTop||0)-(i&&i.clientTop||n&&n.clientTop||0)),!e.relatedTarget&&a&&(e.relatedTarget=a===e.target?t.toElement:a),e.which||void 0===o||(e.which=1&o?1:2&o?3:4&o?2:0),e}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==ee()&&this.focus)try{return this.focus(),!1}catch(e){}},delegateType:"focusin"},blur:{trigger:function(){return this===ee()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return f.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):void 0},_default:function(e){return f.nodeName(e.target,"a")}},beforeunload:{postDispatch:function(e){void 0!==e.result&&e.originalEvent&&(e.originalEvent.returnValue=e.result)}}},simulate:function(e,t,n,r){var i=f.extend(new f.Event,n,{type:e,isSimulated:!0,originalEvent:{}});r?f.event.trigger(i,null,t):f.event.dispatch.call(t,i),i.isDefaultPrevented()&&n.preventDefault()}},f.removeEvent=N.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var r="on"+t;e.detachEvent&&(typeof e[r]===M&&(e[r]=null),e.detachEvent(r,n))},f.Event=function(e,t){return this instanceof f.Event?(e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||void 0===e.defaultPrevented&&!1===e.returnValue?K:Z):this.type=e,t&&f.extend(this,t),this.timeStamp=e&&e.timeStamp||f.now(),void(this[f.expando]=!0)):new f.Event(e,t)},f.Event.prototype={isDefaultPrevented:Z,isPropagationStopped:Z,isImmediatePropagationStopped:Z,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=K,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=K,e&&(e.stopPropagation&&e.stopPropagation(),e.cancelBubble=!0)},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=K,e&&e.stopImmediatePropagation&&e.stopImmediatePropagation(),this.stopPropagation()}},f.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(e,t){f.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,r=e.relatedTarget,i=e.handleObj;return(!r||r!==this&&!f.contains(this,r))&&(e.type=i.origType,n=i.handler.apply(this,arguments),e.type=t),n}}}),c.submitBubbles||(f.event.special.submit={setup:function(){return!f.nodeName(this,"form")&&void f.event.add(this,"click._submit keypress._submit",function(e){var t=e.target,n=f.nodeName(t,"input")||f.nodeName(t,"button")?t.form:void 0;n&&!f._data(n,"submitBubbles")&&(f.event.add(n,"submit._submit",function(e){e._submit_bubble=!0}),f._data(n,"submitBubbles",!0))})},postDispatch:function(e){e._submit_bubble&&(delete e._submit_bubble,this.parentNode&&!e.isTrigger&&f.event.simulate("submit",this.parentNode,e,!0))},teardown:function(){return!f.nodeName(this,"form")&&void f.event.remove(this,"._submit")}}),c.changeBubbles||(f.event.special.change={setup:function(){return V.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(f.event.add(this,"propertychange._change",function(e){"checked"===e.originalEvent.propertyName&&(this._just_changed=!0)}),f.event.add(this,"click._change",function(e){this._just_changed&&!e.isTrigger&&(this._just_changed=!1),f.event.simulate("change",this,e,!0)})),!1):void f.event.add(this,"beforeactivate._change",function(e){var t=e.target;V.test(t.nodeName)&&!f._data(t,"changeBubbles")&&(f.event.add(t,"change._change",function(e){!this.parentNode||e.isSimulated||e.isTrigger||f.event.simulate("change",this.parentNode,e,!0)}),f._data(t,"changeBubbles",!0))})},handle:function(e){var t=e.target;return this!==t||e.isSimulated||e.isTrigger||"radio"!==t.type&&"checkbox"!==t.type?e.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return f.event.remove(this,"._change"),!V.test(this.nodeName)}}),c.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(e,t){var n=function(e){f.event.simulate(t,e.target,f.event.fix(e),!0)};f.event.special[t]={setup:function(){var r=this.ownerDocument||this,i=f._data(r,t);i||r.addEventListener(e,n,!0),f._data(r,t,(i||0)+1)},teardown:function(){var r=this.ownerDocument||this,i=f._data(r,t)-1;i?f._data(r,t,i):(r.removeEventListener(e,n,!0),f._removeData(r,t))}}}),f.fn.extend({on:function(e,t,n,r,i){var o,a;if("object"==typeof e){for(o in"string"!=typeof t&&(n=n||t,t=void 0),e)this.on(o,t,n,e[o],i);return this}if(null==n&&null==r?(r=t,n=t=void 0):null==r&&("string"==typeof t?(r=n,n=void 0):(r=n,n=t,t=void 0)),!1===r)r=Z;else if(!r)return this;return 1===i&&(a=r,(r=function(e){return f().off(e),a.apply(this,arguments)}).guid=a.guid||(a.guid=f.guid++)),this.each(function(){f.event.add(this,e,r,n,t)})},one:function(e,t,n,r){return this.on(e,t,n,r,1)},off:function(e,t,n){var r,i;if(e&&e.preventDefault&&e.handleObj)return r=e.handleObj,f(e.delegateTarget).off(r.namespace?r.origType+"."+r.namespace:r.origType,r.selector,r.handler),this;if("object"==typeof e){for(i in e)this.off(i,t,e[i]);return this}return(!1===t||"function"==typeof t)&&(n=t,t=void 0),!1===n&&(n=Z),this.each(function(){f.event.remove(this,e,n,t)})},trigger:function(e,t){return this.each(function(){f.event.trigger(e,t,this)})},triggerHandler:function(e,t){var n=this[0];return n?f.event.trigger(e,t,n,!0):void 0}});var ne="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",re=/ jQuery\d+="(?:null|\d+)"/g,ie=new RegExp("<(?:"+ne+")[\\s/>]","i"),oe=/^\s+/,ae=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,se=/<([\w:]+)/,le=/<tbody/i,ue=/<|&#?\w+;/,ce=/<(?:script|style|link)/i,de=/checked\s*(?:[^=]|=\s*.checked.)/i,fe=/^$|\/(?:java|ecma)script/i,pe=/^true\/(.*)/,he=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,me={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:c.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},ge=te(N).appendChild(N.createElement("div"));function ve(e,t){var n,r,i=0,o=typeof e.getElementsByTagName!==M?e.getElementsByTagName(t||"*"):typeof e.querySelectorAll!==M?e.querySelectorAll(t||"*"):void 0;if(!o)for(o=[],n=e.childNodes||e;null!=(r=n[i]);i++)!t||f.nodeName(r,t)?o.push(r):f.merge(o,ve(r,t));return void 0===t||t&&f.nodeName(e,t)?f.merge([e],o):o}function ye(e){U.test(e.type)&&(e.defaultChecked=e.checked)}function be(e,t){return f.nodeName(e,"table")&&f.nodeName(11!==t.nodeType?t:t.firstChild,"tr")?e.getElementsByTagName("tbody")[0]||e.appendChild(e.ownerDocument.createElement("tbody")):e}function xe(e){return e.type=(null!==f.find.attr(e,"type"))+"/"+e.type,e}function we(e){var t=pe.exec(e.type);return t?e.type=t[1]:e.removeAttribute("type"),e}function Te(e,t){for(var n,r=0;null!=(n=e[r]);r++)f._data(n,"globalEval",!t||f._data(t[r],"globalEval"))}function Ce(e,t){if(1===t.nodeType&&f.hasData(e)){var n,r,i,o=f._data(e),a=f._data(t,o),s=o.events;if(s)for(n in delete a.handle,a.events={},s)for(r=0,i=s[n].length;i>r;r++)f.event.add(t,n,s[n][r]);a.data&&(a.data=f.extend({},a.data))}}function Ne(e,t){var n,r,i;if(1===t.nodeType){if(n=t.nodeName.toLowerCase(),!c.noCloneEvent&&t[f.expando]){for(r in(i=f._data(t)).events)f.removeEvent(t,r,i.handle);t.removeAttribute(f.expando)}"script"===n&&t.text!==e.text?(xe(t).text=e.text,we(t)):"object"===n?(t.parentNode&&(t.outerHTML=e.outerHTML),c.html5Clone&&e.innerHTML&&!f.trim(t.innerHTML)&&(t.innerHTML=e.innerHTML)):"input"===n&&U.test(e.type)?(t.defaultChecked=t.checked=e.checked,t.value!==e.value&&(t.value=e.value)):"option"===n?t.defaultSelected=t.selected=e.defaultSelected:("input"===n||"textarea"===n)&&(t.defaultValue=e.defaultValue)}}me.optgroup=me.option,me.tbody=me.tfoot=me.colgroup=me.caption=me.thead,me.th=me.td,f.extend({clone:function(e,t,n){var r,i,o,a,s,l=f.contains(e.ownerDocument,e);if(c.html5Clone||f.isXMLDoc(e)||!ie.test("<"+e.nodeName+">")?o=e.cloneNode(!0):(ge.innerHTML=e.outerHTML,ge.removeChild(o=ge.firstChild)),!(c.noCloneEvent&&c.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||f.isXMLDoc(e)))for(r=ve(o),s=ve(e),a=0;null!=(i=s[a]);++a)r[a]&&Ne(i,r[a]);if(t)if(n)for(s=s||ve(e),r=r||ve(o),a=0;null!=(i=s[a]);a++)Ce(i,r[a]);else Ce(e,o);return(r=ve(o,"script")).length>0&&Te(r,!l&&ve(e,"script")),r=s=i=null,o},buildFragment:function(e,t,n,r){for(var i,o,a,s,l,u,d,p=e.length,h=te(t),m=[],g=0;p>g;g++)if((o=e[g])||0===o)if("object"===f.type(o))f.merge(m,o.nodeType?[o]:o);else if(ue.test(o)){for(s=s||h.appendChild(t.createElement("div")),l=(se.exec(o)||["",""])[1].toLowerCase(),d=me[l]||me._default,s.innerHTML=d[1]+o.replace(ae,"<$1></$2>")+d[2],i=d[0];i--;)s=s.lastChild;if(!c.leadingWhitespace&&oe.test(o)&&m.push(t.createTextNode(oe.exec(o)[0])),!c.tbody)for(i=(o="table"!==l||le.test(o)?"<table>"!==d[1]||le.test(o)?0:s:s.firstChild)&&o.childNodes.length;i--;)f.nodeName(u=o.childNodes[i],"tbody")&&!u.childNodes.length&&o.removeChild(u);for(f.merge(m,s.childNodes),s.textContent="";s.firstChild;)s.removeChild(s.firstChild);s=h.lastChild}else m.push(t.createTextNode(o));for(s&&h.removeChild(s),c.appendChecked||f.grep(ve(m,"input"),ye),g=0;o=m[g++];)if((!r||-1===f.inArray(o,r))&&(a=f.contains(o.ownerDocument,o),s=ve(h.appendChild(o),"script"),a&&Te(s),n))for(i=0;o=s[i++];)fe.test(o.type||"")&&n.push(o);return s=null,h},cleanData:function(e,t){for(var r,i,o,a,s=0,l=f.expando,u=f.cache,d=c.deleteExpando,p=f.event.special;null!=(r=e[s]);s++)if((t||f.acceptData(r))&&(a=(o=r[l])&&u[o])){if(a.events)for(i in a.events)p[i]?f.event.remove(r,i):f.removeEvent(r,i,a.handle);u[o]&&(delete u[o],d?delete r[l]:typeof r.removeAttribute!==M?r.removeAttribute(l):r[l]=null,n.push(o))}}}),f.fn.extend({text:function(e){return X(this,function(e){return void 0===e?f.text(this):this.empty().append((this[0]&&this[0].ownerDocument||N).createTextNode(e))},null,e,arguments.length)},append:function(){return this.domManip(arguments,function(e){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||be(this,e).appendChild(e)})},prepend:function(){return this.domManip(arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=be(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this)})},after:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this.nextSibling)})},remove:function(e,t){for(var n,r=e?f.filter(e,this):this,i=0;null!=(n=r[i]);i++)t||1!==n.nodeType||f.cleanData(ve(n)),n.parentNode&&(t&&f.contains(n.ownerDocument,n)&&Te(ve(n,"script")),n.parentNode.removeChild(n));return this},empty:function(){for(var e,t=0;null!=(e=this[t]);t++){for(1===e.nodeType&&f.cleanData(ve(e,!1));e.firstChild;)e.removeChild(e.firstChild);e.options&&f.nodeName(e,"select")&&(e.options.length=0)}return this},clone:function(e,t){return e=null!=e&&e,t=null==t?e:t,this.map(function(){return f.clone(this,e,t)})},html:function(e){return X(this,function(e){var t=this[0]||{},n=0,r=this.length;if(void 0===e)return 1===t.nodeType?t.innerHTML.replace(re,""):void 0;if(!("string"!=typeof e||ce.test(e)||!c.htmlSerialize&&ie.test(e)||!c.leadingWhitespace&&oe.test(e)||me[(se.exec(e)||["",""])[1].toLowerCase()])){e=e.replace(ae,"<$1></$2>");try{for(;r>n;n++)1===(t=this[n]||{}).nodeType&&(f.cleanData(ve(t,!1)),t.innerHTML=e);t=0}catch(e){}}t&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(){var e=arguments[0];return this.domManip(arguments,function(t){e=this.parentNode,f.cleanData(ve(this)),e&&e.replaceChild(t,this)}),e&&(e.length||e.nodeType)?this:this.remove()},detach:function(e){return this.remove(e,!0)},domManip:function(e,t){e=i.apply([],e);var n,r,o,a,s,l,u=0,d=this.length,p=this,h=d-1,m=e[0],g=f.isFunction(m);if(g||d>1&&"string"==typeof m&&!c.checkClone&&de.test(m))return this.each(function(n){var r=p.eq(n);g&&(e[0]=m.call(this,n,r.html())),r.domManip(e,t)});if(d&&(n=(l=f.buildFragment(e,this[0].ownerDocument,!1,this)).firstChild,1===l.childNodes.length&&(l=n),n)){for(o=(a=f.map(ve(l,"script"),xe)).length;d>u;u++)r=l,u!==h&&(r=f.clone(r,!0,!0),o&&f.merge(a,ve(r,"script"))),t.call(this[u],r,u);if(o)for(s=a[a.length-1].ownerDocument,f.map(a,we),u=0;o>u;u++)r=a[u],fe.test(r.type||"")&&!f._data(r,"globalEval")&&f.contains(s,r)&&(r.src?f._evalUrl&&f._evalUrl(r.src):f.globalEval((r.text||r.textContent||r.innerHTML||"").replace(he,"")));l=n=null}return this}}),f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){f.fn[e]=function(e){for(var n,r=0,i=[],a=f(e),s=a.length-1;s>=r;r++)n=r===s?this:this.clone(!0),f(a[r])[t](n),o.apply(i,n.get());return this.pushStack(i)}});var Ee,ke={};function Se(t,n){var r,i=f(n.createElement(t)).appendTo(n.body),o=e.getDefaultComputedStyle&&(r=e.getDefaultComputedStyle(i[0]))?r.display:f.css(i[0],"display");return i.detach(),o}function Ae(e){var t=N,n=ke[e];return n||("none"!==(n=Se(e,t))&&n||((t=((Ee=(Ee||f("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement))[0].contentWindow||Ee[0].contentDocument).document).write(),t.close(),n=Se(e,t),Ee.detach()),ke[e]=n),n}!function(){var e;c.shrinkWrapBlocks=function(){return null!=e?e:(e=!1,(n=N.getElementsByTagName("body")[0])&&n.style?(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",t.appendChild(N.createElement("div")).style.width="5px",e=3!==t.offsetWidth),n.removeChild(r),e):void 0);var t,n,r}}();var De,je,Le=/^margin/,He=new RegExp("^("+$+")(?!px)[a-z%]+$","i"),qe=/^(top|right|bottom|left)$/;function _e(e,t){return{get:function(){var n=e();if(null!=n)return n?void delete this.get:(this.get=t).apply(this,arguments)}}}e.getComputedStyle?(De=function(t){return t.ownerDocument.defaultView.opener?t.ownerDocument.defaultView.getComputedStyle(t,null):e.getComputedStyle(t,null)},je=function(e,t,n){var r,i,o,a,s=e.style;return a=(n=n||De(e))?n.getPropertyValue(t)||n[t]:void 0,n&&(""!==a||f.contains(e.ownerDocument,e)||(a=f.style(e,t)),He.test(a)&&Le.test(t)&&(r=s.width,i=s.minWidth,o=s.maxWidth,s.minWidth=s.maxWidth=s.width=a,a=n.width,s.width=r,s.minWidth=i,s.maxWidth=o)),void 0===a?a:a+""}):N.documentElement.currentStyle&&(De=function(e){return e.currentStyle},je=function(e,t,n){var r,i,o,a,s=e.style;return null==(a=(n=n||De(e))?n[t]:void 0)&&s&&s[t]&&(a=s[t]),He.test(a)&&!qe.test(t)&&(r=s.left,(o=(i=e.runtimeStyle)&&i.left)&&(i.left=e.currentStyle.left),s.left="fontSize"===t?"1em":a,a=s.pixelLeft+"px",s.left=r,o&&(i.left=o)),void 0===a?a:a+""||"auto"}),function(){var t,n,r,i,o,a,s;if((t=N.createElement("div")).innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",n=(r=t.getElementsByTagName("a")[0])&&r.style){function l(){var t,n,r,l;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),t.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",i=o=!1,s=!0,e.getComputedStyle&&(i="1%"!==(e.getComputedStyle(t,null)||{}).top,o="4px"===(e.getComputedStyle(t,null)||{width:"4px"}).width,(l=t.appendChild(N.createElement("div"))).style.cssText=t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",l.style.marginRight=l.style.width="0",t.style.width="1px",s=!parseFloat((e.getComputedStyle(l,null)||{}).marginRight),t.removeChild(l)),t.innerHTML="<table><tr><td></td><td>t</td></tr></table>",(l=t.getElementsByTagName("td"))[0].style.cssText="margin:0;border:0;padding:0;display:none",(a=0===l[0].offsetHeight)&&(l[0].style.display="",l[1].style.display="none",a=0===l[0].offsetHeight),n.removeChild(r))}n.cssText="float:left;opacity:.5",c.opacity="0.5"===n.opacity,c.cssFloat=!!n.cssFloat,t.style.backgroundClip="content-box",t.cloneNode(!0).style.backgroundClip="",c.clearCloneStyle="content-box"===t.style.backgroundClip,c.boxSizing=""===n.boxSizing||""===n.MozBoxSizing||""===n.WebkitBoxSizing,f.extend(c,{reliableHiddenOffsets:function(){return null==a&&l(),a},boxSizingReliable:function(){return null==o&&l(),o},pixelPosition:function(){return null==i&&l(),i},reliableMarginRight:function(){return null==s&&l(),s}})}}(),f.swap=function(e,t,n,r){var i,o,a={};for(o in t)a[o]=e.style[o],e.style[o]=t[o];for(o in i=n.apply(e,r||[]),t)e.style[o]=a[o];return i};var Me=/alpha\([^)]*\)/i,Fe=/opacity\s*=\s*([^)]*)/,Oe=/^(none|table(?!-c[ea]).+)/,Be=new RegExp("^("+$+")(.*)$","i"),Pe=new RegExp("^([+-])=("+$+")","i"),Re={position:"absolute",visibility:"hidden",display:"block"},We={letterSpacing:"0",fontWeight:"400"},$e=["Webkit","O","Moz","ms"];function ze(e,t){if(t in e)return t;for(var n=t.charAt(0).toUpperCase()+t.slice(1),r=t,i=$e.length;i--;)if((t=$e[i]+n)in e)return t;return r}function Ie(e,t){for(var n,r,i,o=[],a=0,s=e.length;s>a;a++)(r=e[a]).style&&(o[a]=f._data(r,"olddisplay"),n=r.style.display,t?(o[a]||"none"!==n||(r.style.display=""),""===r.style.display&&I(r)&&(o[a]=f._data(r,"olddisplay",Ae(r.nodeName)))):(i=I(r),(n&&"none"!==n||!i)&&f._data(r,"olddisplay",i?n:f.css(r,"display"))));for(a=0;s>a;a++)(r=e[a]).style&&(t&&"none"!==r.style.display&&""!==r.style.display||(r.style.display=t?o[a]||"":"none"));return e}function Xe(e,t,n){var r=Be.exec(t);return r?Math.max(0,r[1]-(n||0))+(r[2]||"px"):t}function Ue(e,t,n,r,i){for(var o=n===(r?"border":"content")?4:"width"===t?1:0,a=0;4>o;o+=2)"margin"===n&&(a+=f.css(e,n+z[o],!0,i)),r?("content"===n&&(a-=f.css(e,"padding"+z[o],!0,i)),"margin"!==n&&(a-=f.css(e,"border"+z[o]+"Width",!0,i))):(a+=f.css(e,"padding"+z[o],!0,i),"padding"!==n&&(a+=f.css(e,"border"+z[o]+"Width",!0,i)));return a}function Ve(e,t,n){var r=!0,i="width"===t?e.offsetWidth:e.offsetHeight,o=De(e),a=c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,o);if(0>=i||null==i){if((0>(i=je(e,t,o))||null==i)&&(i=e.style[t]),He.test(i))return i;r=a&&(c.boxSizingReliable()||i===e.style[t]),i=parseFloat(i)||0}return i+Ue(e,t,n||(a?"border":"content"),r,o)+"px"}function Je(e,t,n,r,i){return new Je.prototype.init(e,t,n,r,i)}f.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=je(e,"opacity");return""===n?"1":n}}}},cssNumber:{columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{float:c.cssFloat?"cssFloat":"styleFloat"},style:function(e,t,n,r){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var i,o,a,s=f.camelCase(t),l=e.style;if(t=f.cssProps[s]||(f.cssProps[s]=ze(l,s)),a=f.cssHooks[t]||f.cssHooks[s],void 0===n)return a&&"get"in a&&void 0!==(i=a.get(e,!1,r))?i:l[t];if("string"===(o=typeof n)&&(i=Pe.exec(n))&&(n=(i[1]+1)*i[2]+parseFloat(f.css(e,t)),o="number"),null!=n&&n==n&&("number"!==o||f.cssNumber[s]||(n+="px"),c.clearCloneStyle||""!==n||0!==t.indexOf("background")||(l[t]="inherit"),!(a&&"set"in a&&void 0===(n=a.set(e,n,r)))))try{l[t]=n}catch(e){}}},css:function(e,t,n,r){var i,o,a,s=f.camelCase(t);return t=f.cssProps[s]||(f.cssProps[s]=ze(e.style,s)),(a=f.cssHooks[t]||f.cssHooks[s])&&"get"in a&&(o=a.get(e,!0,n)),void 0===o&&(o=je(e,t,r)),"normal"===o&&t in We&&(o=We[t]),""===n||n?(i=parseFloat(o),!0===n||f.isNumeric(i)?i||0:o):o}}),f.each(["height","width"],function(e,t){f.cssHooks[t]={get:function(e,n,r){return n?Oe.test(f.css(e,"display"))&&0===e.offsetWidth?f.swap(e,Re,function(){return Ve(e,t,r)}):Ve(e,t,r):void 0},set:function(e,n,r){var i=r&&De(e);return Xe(0,n,r?Ue(e,t,r,c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,i),i):0)}}}),c.opacity||(f.cssHooks.opacity={get:function(e,t){return Fe.test((t&&e.currentStyle?e.currentStyle.filter:e.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""},set:function(e,t){var n=e.style,r=e.currentStyle,i=f.isNumeric(t)?"alpha(opacity="+100*t+")":"",o=r&&r.filter||n.filter||"";n.zoom=1,(t>=1||""===t)&&""===f.trim(o.replace(Me,""))&&n.removeAttribute&&(n.removeAttribute("filter"),""===t||r&&!r.filter)||(n.filter=Me.test(o)?o.replace(Me,i):o+" "+i)}}),f.cssHooks.marginRight=_e(c.reliableMarginRight,function(e,t){return t?f.swap(e,{display:"inline-block"},je,[e,"marginRight"]):void 0}),f.each({margin:"",padding:"",border:"Width"},function(e,t){f.cssHooks[e+t]={expand:function(n){for(var r=0,i={},o="string"==typeof n?n.split(" "):[n];4>r;r++)i[e+z[r]+t]=o[r]||o[r-2]||o[0];return i}},Le.test(e)||(f.cssHooks[e+t].set=Xe)}),f.fn.extend({css:function(e,t){return X(this,function(e,t,n){var r,i,o={},a=0;if(f.isArray(t)){for(r=De(e),i=t.length;i>a;a++)o[t[a]]=f.css(e,t[a],!1,r);return o}return void 0!==n?f.style(e,t,n):f.css(e,t)},e,t,arguments.length>1)},show:function(){return Ie(this,!0)},hide:function(){return Ie(this)},toggle:function(e){return"boolean"==typeof e?e?this.show():this.hide():this.each(function(){I(this)?f(this).show():f(this).hide()})}}),f.Tween=Je,Je.prototype={constructor:Je,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||"swing",this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(f.cssNumber[n]?"":"px")},cur:function(){var e=Je.propHooks[this.prop];return e&&e.get?e.get(this):Je.propHooks._default.get(this)},run:function(e){var t,n=Je.propHooks[this.prop];return this.pos=t=this.options.duration?f.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):Je.propHooks._default.set(this),this}},Je.prototype.init.prototype=Je.prototype,Je.propHooks={_default:{get:function(e){var t;return null==e.elem[e.prop]||e.elem.style&&null!=e.elem.style[e.prop]?(t=f.css(e.elem,e.prop,""))&&"auto"!==t?t:0:e.elem[e.prop]},set:function(e){f.fx.step[e.prop]?f.fx.step[e.prop](e):e.elem.style&&(null!=e.elem.style[f.cssProps[e.prop]]||f.cssHooks[e.prop])?f.style(e.elem,e.prop,e.now+e.unit):e.elem[e.prop]=e.now}}},Je.propHooks.scrollTop=Je.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},f.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2}},f.fx=Je.prototype.init,f.fx.step={};var Ye,Ge,Qe=/^(?:toggle|show|hide)$/,Ke=new RegExp("^(?:([+-])=|)("+$+")([a-z%]*)$","i"),Ze=/queueHooks$/,et=[function(e,t,n){var r,i,o,a,s,l,u,d=this,p={},h=e.style,m=e.nodeType&&I(e),g=f._data(e,"fxshow");for(r in n.queue||(null==(s=f._queueHooks(e,"fx")).unqueued&&(s.unqueued=0,l=s.empty.fire,s.empty.fire=function(){s.unqueued||l()}),s.unqueued++,d.always(function(){d.always(function(){s.unqueued--,f.queue(e,"fx").length||s.empty.fire()})})),1===e.nodeType&&("height"in t||"width"in t)&&(n.overflow=[h.overflow,h.overflowX,h.overflowY],u=f.css(e,"display"),"inline"===("none"===u?f._data(e,"olddisplay")||Ae(e.nodeName):u)&&"none"===f.css(e,"float")&&(c.inlineBlockNeedsLayout&&"inline"!==Ae(e.nodeName)?h.zoom=1:h.display="inline-block")),n.overflow&&(h.overflow="hidden",c.shrinkWrapBlocks()||d.always(function(){h.overflow=n.overflow[0],h.overflowX=n.overflow[1],h.overflowY=n.overflow[2]})),t)if(i=t[r],Qe.exec(i)){if(delete t[r],o=o||"toggle"===i,i===(m?"hide":"show")){if("show"!==i||!g||void 0===g[r])continue;m=!0}p[r]=g&&g[r]||f.style(e,r)}else u=void 0;if(f.isEmptyObject(p))"inline"===("none"===u?Ae(e.nodeName):u)&&(h.display=u);else for(r in g?"hidden"in g&&(m=g.hidden):g=f._data(e,"fxshow",{}),o&&(g.hidden=!m),m?f(e).show():d.done(function(){f(e).hide()}),d.done(function(){var t;for(t in f._removeData(e,"fxshow"),p)f.style(e,t,p[t])}),p)a=it(m?g[r]:0,r,d),r in g||(g[r]=a.start,m&&(a.end=a.start,a.start="width"===r||"height"===r?1:0))}],tt={"*":[function(e,t){var n=this.createTween(e,t),r=n.cur(),i=Ke.exec(t),o=i&&i[3]||(f.cssNumber[e]?"":"px"),a=(f.cssNumber[e]||"px"!==o&&+r)&&Ke.exec(f.css(n.elem,e)),s=1,l=20;if(a&&a[3]!==o){o=o||a[3],i=i||[],a=+r||1;do{a/=s=s||".5",f.style(n.elem,e,a+o)}while(s!==(s=n.cur()/r)&&1!==s&&--l)}return i&&(a=n.start=+a||+r||0,n.unit=o,n.end=i[1]?a+(i[1]+1)*i[2]:+i[2]),n}]};function nt(){return setTimeout(function(){Ye=void 0}),Ye=f.now()}function rt(e,t){var n,r={height:e},i=0;for(t=t?1:0;4>i;i+=2-t)r["margin"+(n=z[i])]=r["padding"+n]=e;return t&&(r.opacity=r.width=e),r}function it(e,t,n){for(var r,i=(tt[t]||[]).concat(tt["*"]),o=0,a=i.length;a>o;o++)if(r=i[o].call(n,t,e))return r}function ot(e,t,n){var r,i,o=0,a=et.length,s=f.Deferred().always(function(){delete l.elem}),l=function(){if(i)return!1;for(var t=Ye||nt(),n=Math.max(0,u.startTime+u.duration-t),r=1-(n/u.duration||0),o=0,a=u.tweens.length;a>o;o++)u.tweens[o].run(r);return s.notifyWith(e,[u,r,n]),1>r&&a?n:(s.resolveWith(e,[u]),!1)},u=s.promise({elem:e,props:f.extend({},t),opts:f.extend(!0,{specialEasing:{}},n),originalProperties:t,originalOptions:n,startTime:Ye||nt(),duration:n.duration,tweens:[],createTween:function(t,n){var r=f.Tween(e,u.opts,t,n,u.opts.specialEasing[t]||u.opts.easing);return u.tweens.push(r),r},stop:function(t){var n=0,r=t?u.tweens.length:0;if(i)return this;for(i=!0;r>n;n++)u.tweens[n].run(1);return t?s.resolveWith(e,[u,t]):s.rejectWith(e,[u,t]),this}}),c=u.props;for(function(e,t){var n,r,i,o,a;for(n in e)if(i=t[r=f.camelCase(n)],o=e[n],f.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),(a=f.cssHooks[r])&&"expand"in a)for(n in o=a.expand(o),delete e[r],o)n in e||(e[n]=o[n],t[n]=i);else t[r]=i}(c,u.opts.specialEasing);a>o;o++)if(r=et[o].call(u,e,c,u.opts))return r;return f.map(c,it,u),f.isFunction(u.opts.start)&&u.opts.start.call(e,u),f.fx.timer(f.extend(l,{elem:e,anim:u,queue:u.opts.queue})),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)}f.Animation=f.extend(ot,{tweener:function(e,t){f.isFunction(e)?(t=e,e=["*"]):e=e.split(" ");for(var n,r=0,i=e.length;i>r;r++)n=e[r],tt[n]=tt[n]||[],tt[n].unshift(t)},prefilter:function(e,t){t?et.unshift(e):et.push(e)}}),f.speed=function(e,t,n){var r=e&&"object"==typeof e?f.extend({},e):{complete:n||!n&&t||f.isFunction(e)&&e,duration:e,easing:n&&t||t&&!f.isFunction(t)&&t};return r.duration=f.fx.off?0:"number"==typeof r.duration?r.duration:r.duration in f.fx.speeds?f.fx.speeds[r.duration]:f.fx.speeds._default,(null==r.queue||!0===r.queue)&&(r.queue="fx"),r.old=r.complete,r.complete=function(){f.isFunction(r.old)&&r.old.call(this),r.queue&&f.dequeue(this,r.queue)},r},f.fn.extend({fadeTo:function(e,t,n,r){return this.filter(I).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(e,t,n,r){var i=f.isEmptyObject(e),o=f.speed(t,n,r),a=function(){var t=ot(this,f.extend({},e),o);(i||f._data(this,"finish"))&&t.stop(!0)};return a.finish=a,i||!1===o.queue?this.each(a):this.queue(o.queue,a)},stop:function(e,t,n){var r=function(e){var t=e.stop;delete e.stop,t(n)};return"string"!=typeof e&&(n=t,t=e,e=void 0),t&&!1!==e&&this.queue(e||"fx",[]),this.each(function(){var t=!0,i=null!=e&&e+"queueHooks",o=f.timers,a=f._data(this);if(i)a[i]&&a[i].stop&&r(a[i]);else for(i in a)a[i]&&a[i].stop&&Ze.test(i)&&r(a[i]);for(i=o.length;i--;)o[i].elem!==this||null!=e&&o[i].queue!==e||(o[i].anim.stop(n),t=!1,o.splice(i,1));(t||!n)&&f.dequeue(this,e)})},finish:function(e){return!1!==e&&(e=e||"fx"),this.each(function(){var t,n=f._data(this),r=n[e+"queue"],i=n[e+"queueHooks"],o=f.timers,a=r?r.length:0;for(n.finish=!0,f.queue(this,e,[]),i&&i.stop&&i.stop.call(this,!0),t=o.length;t--;)o[t].elem===this&&o[t].queue===e&&(o[t].anim.stop(!0),o.splice(t,1));for(t=0;a>t;t++)r[t]&&r[t].finish&&r[t].finish.call(this);delete n.finish})}}),f.each(["toggle","show","hide"],function(e,t){var n=f.fn[t];f.fn[t]=function(e,r,i){return null==e||"boolean"==typeof e?n.apply(this,arguments):this.animate(rt(t,!0),e,r,i)}}),f.each({slideDown:rt("show"),slideUp:rt("hide"),slideToggle:rt("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){f.fn[e]=function(e,n,r){return this.animate(t,e,n,r)}}),f.timers=[],f.fx.tick=function(){var e,t=f.timers,n=0;for(Ye=f.now();n<t.length;n++)(e=t[n])()||t[n]!==e||t.splice(n--,1);t.length||f.fx.stop(),Ye=void 0},f.fx.timer=function(e){f.timers.push(e),e()?f.fx.start():f.timers.pop()},f.fx.interval=13,f.fx.start=function(){Ge||(Ge=setInterval(f.fx.tick,f.fx.interval))},f.fx.stop=function(){clearInterval(Ge),Ge=null},f.fx.speeds={slow:600,fast:200,_default:400},f.fn.delay=function(e,t){return e=f.fx&&f.fx.speeds[e]||e,t=t||"fx",this.queue(t,function(t,n){var r=setTimeout(t,e);n.stop=function(){clearTimeout(r)}})},function(){var e,t,n,r,i;(t=N.createElement("div")).setAttribute("className","t"),t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",r=t.getElementsByTagName("a")[0],i=(n=N.createElement("select")).appendChild(N.createElement("option")),e=t.getElementsByTagName("input")[0],r.style.cssText="top:1px",c.getSetAttribute="t"!==t.className,c.style=/top/.test(r.getAttribute("style")),c.hrefNormalized="/a"===r.getAttribute("href"),c.checkOn=!!e.value,c.optSelected=i.selected,c.enctype=!!N.createElement("form").enctype,n.disabled=!0,c.optDisabled=!i.disabled,(e=N.createElement("input")).setAttribute("value",""),c.input=""===e.getAttribute("value"),e.value="t",e.setAttribute("type","radio"),c.radioValue="t"===e.value}();var at=/\r/g;f.fn.extend({val:function(e){var t,n,r,i=this[0];return arguments.length?(r=f.isFunction(e),this.each(function(n){var i;1===this.nodeType&&(null==(i=r?e.call(this,n,f(this).val()):e)?i="":"number"==typeof i?i+="":f.isArray(i)&&(i=f.map(i,function(e){return null==e?"":e+""})),(t=f.valHooks[this.type]||f.valHooks[this.nodeName.toLowerCase()])&&"set"in t&&void 0!==t.set(this,i,"value")||(this.value=i))})):i?(t=f.valHooks[i.type]||f.valHooks[i.nodeName.toLowerCase()])&&"get"in t&&void 0!==(n=t.get(i,"value"))?n:"string"==typeof(n=i.value)?n.replace(at,""):null==n?"":n:void 0}}),f.extend({valHooks:{option:{get:function(e){var t=f.find.attr(e,"value");return null!=t?t:f.trim(f.text(e))}},select:{get:function(e){for(var t,n,r=e.options,i=e.selectedIndex,o="select-one"===e.type||0>i,a=o?null:[],s=o?i+1:r.length,l=0>i?s:o?i:0;s>l;l++)if(!(!(n=r[l]).selected&&l!==i||(c.optDisabled?n.disabled:null!==n.getAttribute("disabled"))||n.parentNode.disabled&&f.nodeName(n.parentNode,"optgroup"))){if(t=f(n).val(),o)return t;a.push(t)}return a},set:function(e,t){for(var n,r,i=e.options,o=f.makeArray(t),a=i.length;a--;)if(r=i[a],f.inArray(f.valHooks.option.get(r),o)>=0)try{r.selected=n=!0}catch(e){r.scrollHeight}else r.selected=!1;return n||(e.selectedIndex=-1),i}}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]={set:function(e,t){return f.isArray(t)?e.checked=f.inArray(f(e).val(),t)>=0:void 0}},c.checkOn||(f.valHooks[this].get=function(e){return null===e.getAttribute("value")?"on":e.value})});var st,lt,ut=f.expr.attrHandle,ct=/^(?:checked|selected)$/i,dt=c.getSetAttribute,ft=c.input;f.fn.extend({attr:function(e,t){return X(this,f.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){f.removeAttr(this,e)})}}),f.extend({attr:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return typeof e.getAttribute===M?f.prop(e,t,n):(1===o&&f.isXMLDoc(e)||(t=t.toLowerCase(),r=f.attrHooks[t]||(f.expr.match.bool.test(t)?lt:st)),void 0===n?r&&"get"in r&&null!==(i=r.get(e,t))?i:null==(i=f.find.attr(e,t))?void 0:i:null!==n?r&&"set"in r&&void 0!==(i=r.set(e,n,t))?i:(e.setAttribute(t,n+""),n):void f.removeAttr(e,t))},removeAttr:function(e,t){var n,r,i=0,o=t&&t.match(j);if(o&&1===e.nodeType)for(;n=o[i++];)r=f.propFix[n]||n,f.expr.match.bool.test(n)?ft&&dt||!ct.test(n)?e[r]=!1:e[f.camelCase("default-"+n)]=e[r]=!1:f.attr(e,n,""),e.removeAttribute(dt?n:r)},attrHooks:{type:{set:function(e,t){if(!c.radioValue&&"radio"===t&&f.nodeName(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}}}}),lt={set:function(e,t,n){return!1===t?f.removeAttr(e,n):ft&&dt||!ct.test(n)?e.setAttribute(!dt&&f.propFix[n]||n,n):e[f.camelCase("default-"+n)]=e[n]=!0,n}},f.each(f.expr.match.bool.source.match(/\w+/g),function(e,t){var n=ut[t]||f.find.attr;ut[t]=ft&&dt||!ct.test(t)?function(e,t,r){var i,o;return r||(o=ut[t],ut[t]=i,i=null!=n(e,t,r)?t.toLowerCase():null,ut[t]=o),i}:function(e,t,n){return n?void 0:e[f.camelCase("default-"+t)]?t.toLowerCase():null}}),ft&&dt||(f.attrHooks.value={set:function(e,t,n){return f.nodeName(e,"input")?void(e.defaultValue=t):st&&st.set(e,t,n)}}),dt||(st={set:function(e,t,n){var r=e.getAttributeNode(n);return r||e.setAttributeNode(r=e.ownerDocument.createAttribute(n)),r.value=t+="","value"===n||t===e.getAttribute(n)?t:void 0}},ut.id=ut.name=ut.coords=function(e,t,n){var r;return n?void 0:(r=e.getAttributeNode(t))&&""!==r.value?r.value:null},f.valHooks.button={get:function(e,t){var n=e.getAttributeNode(t);return n&&n.specified?n.value:void 0},set:st.set},f.attrHooks.contenteditable={set:function(e,t,n){st.set(e,""!==t&&t,n)}},f.each(["width","height"],function(e,t){f.attrHooks[t]={set:function(e,n){return""===n?(e.setAttribute(t,"auto"),n):void 0}}})),c.style||(f.attrHooks.style={get:function(e){return e.style.cssText||void 0},set:function(e,t){return e.style.cssText=t+""}});var pt=/^(?:input|select|textarea|button|object)$/i,ht=/^(?:a|area)$/i;f.fn.extend({prop:function(e,t){return X(this,f.prop,e,t,arguments.length>1)},removeProp:function(e){return e=f.propFix[e]||e,this.each(function(){try{this[e]=void 0,delete this[e]}catch(e){}})}}),f.extend({propFix:{for:"htmlFor",class:"className"},prop:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return(1!==o||!f.isXMLDoc(e))&&(t=f.propFix[t]||t,i=f.propHooks[t]),void 0!==n?i&&"set"in i&&void 0!==(r=i.set(e,n,t))?r:e[t]=n:i&&"get"in i&&null!==(r=i.get(e,t))?r:e[t]},propHooks:{tabIndex:{get:function(e){var t=f.find.attr(e,"tabindex");return t?parseInt(t,10):pt.test(e.nodeName)||ht.test(e.nodeName)&&e.href?0:-1}}}}),c.hrefNormalized||f.each(["href","src"],function(e,t){f.propHooks[t]={get:function(e){return e.getAttribute(t,4)}}}),c.optSelected||(f.propHooks.selected={get:function(e){var t=e.parentNode;return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null}}),f.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){f.propFix[this.toLowerCase()]=this}),c.enctype||(f.propFix.enctype="encoding");var mt=/[\t\r\n\f]/g;f.fn.extend({addClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u="string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).addClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):" ")){for(o=0;i=t[o++];)r.indexOf(" "+i+" ")<0&&(r+=i+" ");a=f.trim(r),n.className!==a&&(n.className=a)}return this},removeClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u=0===arguments.length||"string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).removeClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):"")){for(o=0;i=t[o++];)for(;r.indexOf(" "+i+" ")>=0;)r=r.replace(" "+i+" "," ");a=e?f.trim(r):"",n.className!==a&&(n.className=a)}return this},toggleClass:function(e,t){var n=typeof e;return"boolean"==typeof t&&"string"===n?t?this.addClass(e):this.removeClass(e):this.each(f.isFunction(e)?function(n){f(this).toggleClass(e.call(this,n,this.className,t),t)}:function(){if("string"===n)for(var t,r=0,i=f(this),o=e.match(j)||[];t=o[r++];)i.hasClass(t)?i.removeClass(t):i.addClass(t);else(n===M||"boolean"===n)&&(this.className&&f._data(this,"__className__",this.className),this.className=this.className||!1===e?"":f._data(this,"__className__")||"")})},hasClass:function(e){for(var t=" "+e+" ",n=0,r=this.length;r>n;n++)if(1===this[n].nodeType&&(" "+this[n].className+" ").replace(mt," ").indexOf(t)>=0)return!0;return!1}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(e,t){f.fn[t]=function(e,n){return arguments.length>0?this.on(t,null,e,n):this.trigger(t)}}),f.fn.extend({hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)},bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1===arguments.length?this.off(e,"**"):this.off(t,e||"**",n)}});var gt=f.now(),vt=/\?/,yt=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;f.parseJSON=function(t){if(e.JSON&&e.JSON.parse)return e.JSON.parse(t+"");var n,r=null,i=f.trim(t+"");return i&&!f.trim(i.replace(yt,function(e,t,i,o){return n&&t&&(r=0),0===r?e:(n=i||t,r+=!o-!i,"")}))?Function("return "+i)():f.error("Invalid JSON: "+t)},f.parseXML=function(t){var n;if(!t||"string"!=typeof t)return null;try{e.DOMParser?n=(new DOMParser).parseFromString(t,"text/xml"):((n=new ActiveXObject("Microsoft.XMLDOM")).async="false",n.loadXML(t))}catch(e){n=void 0}return n&&n.documentElement&&!n.getElementsByTagName("parsererror").length||f.error("Invalid XML: "+t),n};var bt,xt,wt=/#.*$/,Tt=/([?&])_=[^&]*/,Ct=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Nt=/^(?:GET|HEAD)$/,Et=/^\/\//,kt=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,St={},At={},Dt="*/".concat("*");try{xt=location.href}catch(e){(xt=N.createElement("a")).href="",xt=xt.href}function jt(e){return function(t,n){"string"!=typeof t&&(n=t,t="*");var r,i=0,o=t.toLowerCase().match(j)||[];if(f.isFunction(n))for(;r=o[i++];)"+"===r.charAt(0)?(r=r.slice(1)||"*",(e[r]=e[r]||[]).unshift(n)):(e[r]=e[r]||[]).push(n)}}function Lt(e,t,n,r){var i={},o=e===At;function a(s){var l;return i[s]=!0,f.each(e[s]||[],function(e,s){var u=s(t,n,r);return"string"!=typeof u||o||i[u]?o?!(l=u):void 0:(t.dataTypes.unshift(u),a(u),!1)}),l}return a(t.dataTypes[0])||!i["*"]&&a("*")}function Ht(e,t){var n,r,i=f.ajaxSettings.flatOptions||{};for(r in t)void 0!==t[r]&&((i[r]?e:n||(n={}))[r]=t[r]);return n&&f.extend(!0,e,n),e}bt=kt.exec(xt.toLowerCase())||[],f.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:xt,type:"GET",isLocal:/^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(bt[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Dt,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(e,t){return t?Ht(Ht(e,f.ajaxSettings),t):Ht(f.ajaxSettings,e)},ajaxPrefilter:jt(St),ajaxTransport:jt(At),ajax:function(e,t){"object"==typeof e&&(t=e,e=void 0),t=t||{};var n,r,i,o,a,s,l,u,c=f.ajaxSetup({},t),d=c.context||c,p=c.context&&(d.nodeType||d.jquery)?f(d):f.event,h=f.Deferred(),m=f.Callbacks("once memory"),g=c.statusCode||{},v={},y={},b=0,x="canceled",w={readyState:0,getResponseHeader:function(e){var t;if(2===b){if(!u)for(u={};t=Ct.exec(o);)u[t[1].toLowerCase()]=t[2];t=u[e.toLowerCase()]}return null==t?null:t},getAllResponseHeaders:function(){return 2===b?o:null},setRequestHeader:function(e,t){var n=e.toLowerCase();return b||(e=y[n]=y[n]||e,v[e]=t),this},overrideMimeType:function(e){return b||(c.mimeType=e),this},statusCode:function(e){var t;if(e)if(2>b)for(t in e)g[t]=[g[t],e[t]];else w.always(e[w.status]);return this},abort:function(e){var t=e||x;return l&&l.abort(t),T(0,t),this}};if(h.promise(w).complete=m.add,w.success=w.done,w.error=w.fail,c.url=((e||c.url||xt)+"").replace(wt,"").replace(Et,bt[1]+"//"),c.type=t.method||t.type||c.method||c.type,c.dataTypes=f.trim(c.dataType||"*").toLowerCase().match(j)||[""],null==c.crossDomain&&(n=kt.exec(c.url.toLowerCase()),c.crossDomain=!(!n||n[1]===bt[1]&&n[2]===bt[2]&&(n[3]||("http:"===n[1]?"80":"443"))===(bt[3]||("http:"===bt[1]?"80":"443")))),c.data&&c.processData&&"string"!=typeof c.data&&(c.data=f.param(c.data,c.traditional)),Lt(St,c,t,w),2===b)return w;for(r in(s=f.event&&c.global)&&0==f.active++&&f.event.trigger("ajaxStart"),c.type=c.type.toUpperCase(),c.hasContent=!Nt.test(c.type),i=c.url,c.hasContent||(c.data&&(i=c.url+=(vt.test(i)?"&":"?")+c.data,delete c.data),!1===c.cache&&(c.url=Tt.test(i)?i.replace(Tt,"$1_="+gt++):i+(vt.test(i)?"&":"?")+"_="+gt++)),c.ifModified&&(f.lastModified[i]&&w.setRequestHeader("If-Modified-Since",f.lastModified[i]),f.etag[i]&&w.setRequestHeader("If-None-Match",f.etag[i])),(c.data&&c.hasContent&&!1!==c.contentType||t.contentType)&&w.setRequestHeader("Content-Type",c.contentType),w.setRequestHeader("Accept",c.dataTypes[0]&&c.accepts[c.dataTypes[0]]?c.accepts[c.dataTypes[0]]+("*"!==c.dataTypes[0]?", "+Dt+"; q=0.01":""):c.accepts["*"]),c.headers)w.setRequestHeader(r,c.headers[r]);if(c.beforeSend&&(!1===c.beforeSend.call(d,w,c)||2===b))return w.abort();for(r in x="abort",{success:1,error:1,complete:1})w[r](c[r]);if(l=Lt(At,c,t,w)){w.readyState=1,s&&p.trigger("ajaxSend",[w,c]),c.async&&c.timeout>0&&(a=setTimeout(function(){w.abort("timeout")},c.timeout));try{b=1,l.send(v,T)}catch(e){if(!(2>b))throw e;T(-1,e)}}else T(-1,"No Transport");function T(e,t,n,r){var u,v,y,x,T,C=t;2!==b&&(b=2,a&&clearTimeout(a),l=void 0,o=r||"",w.readyState=e>0?4:0,u=e>=200&&300>e||304===e,n&&(x=function(e,t,n){for(var r,i,o,a,s=e.contents,l=e.dataTypes;"*"===l[0];)l.shift(),void 0===i&&(i=e.mimeType||t.getResponseHeader("Content-Type"));if(i)for(a in s)if(s[a]&&s[a].test(i)){l.unshift(a);break}if(l[0]in n)o=l[0];else{for(a in n){if(!l[0]||e.converters[a+" "+l[0]]){o=a;break}r||(r=a)}o=o||r}return o?(o!==l[0]&&l.unshift(o),n[o]):void 0}(c,w,n)),x=function(e,t,n,r){var i,o,a,s,l,u={},c=e.dataTypes.slice();if(c[1])for(a in e.converters)u[a.toLowerCase()]=e.converters[a];for(o=c.shift();o;)if(e.responseFields[o]&&(n[e.responseFields[o]]=t),!l&&r&&e.dataFilter&&(t=e.dataFilter(t,e.dataType)),l=o,o=c.shift())if("*"===o)o=l;else if("*"!==l&&l!==o){if(!(a=u[l+" "+o]||u["* "+o]))for(i in u)if((s=i.split(" "))[1]===o&&(a=u[l+" "+s[0]]||u["* "+s[0]])){!0===a?a=u[i]:!0!==u[i]&&(o=s[0],c.unshift(s[1]));break}if(!0!==a)if(a&&e.throws)t=a(t);else try{t=a(t)}catch(e){return{state:"parsererror",error:a?e:"No conversion from "+l+" to "+o}}}return{state:"success",data:t}}(c,x,w,u),u?(c.ifModified&&((T=w.getResponseHeader("Last-Modified"))&&(f.lastModified[i]=T),(T=w.getResponseHeader("etag"))&&(f.etag[i]=T)),204===e||"HEAD"===c.type?C="nocontent":304===e?C="notmodified":(C=x.state,v=x.data,u=!(y=x.error))):(y=C,(e||!C)&&(C="error",0>e&&(e=0))),w.status=e,w.statusText=(t||C)+"",u?h.resolveWith(d,[v,C,w]):h.rejectWith(d,[w,C,y]),w.statusCode(g),g=void 0,s&&p.trigger(u?"ajaxSuccess":"ajaxError",[w,c,u?v:y]),m.fireWith(d,[w,C]),s&&(p.trigger("ajaxComplete",[w,c]),--f.active||f.event.trigger("ajaxStop")))}return w},getJSON:function(e,t,n){return f.get(e,t,n,"json")},getScript:function(e,t){return f.get(e,void 0,t,"script")}}),f.each(["get","post"],function(e,t){f[t]=function(e,n,r,i){return f.isFunction(n)&&(i=i||r,r=n,n=void 0),f.ajax({url:e,type:t,dataType:i,data:n,success:r})}}),f._evalUrl=function(e){return f.ajax({url:e,type:"GET",dataType:"script",async:!1,global:!1,throws:!0})},f.fn.extend({wrapAll:function(e){if(f.isFunction(e))return this.each(function(t){f(this).wrapAll(e.call(this,t))});if(this[0]){var t=f(e,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){for(var e=this;e.firstChild&&1===e.firstChild.nodeType;)e=e.firstChild;return e}).append(this)}return this},wrapInner:function(e){return this.each(f.isFunction(e)?function(t){f(this).wrapInner(e.call(this,t))}:function(){var t=f(this),n=t.contents();n.length?n.wrapAll(e):t.append(e)})},wrap:function(e){var t=f.isFunction(e);return this.each(function(n){f(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()}}),f.expr.filters.hidden=function(e){return e.offsetWidth<=0&&e.offsetHeight<=0||!c.reliableHiddenOffsets()&&"none"===(e.style&&e.style.display||f.css(e,"display"))},f.expr.filters.visible=function(e){return!f.expr.filters.hidden(e)};var qt=/%20/g,_t=/\[\]$/,Mt=/\r?\n/g,Ft=/^(?:submit|button|image|reset|file)$/i,Ot=/^(?:input|select|textarea|keygen)/i;function Bt(e,t,n,r){var i;if(f.isArray(t))f.each(t,function(t,i){n||_t.test(e)?r(e,i):Bt(e+"["+("object"==typeof i?t:"")+"]",i,n,r)});else if(n||"object"!==f.type(t))r(e,t);else for(i in t)Bt(e+"["+i+"]",t[i],n,r)}f.param=function(e,t){var n,r=[],i=function(e,t){t=f.isFunction(t)?t():null==t?"":t,r[r.length]=encodeURIComponent(e)+"="+encodeURIComponent(t)};if(void 0===t&&(t=f.ajaxSettings&&f.ajaxSettings.traditional),f.isArray(e)||e.jquery&&!f.isPlainObject(e))f.each(e,function(){i(this.name,this.value)});else for(n in e)Bt(n,e[n],t,i);return r.join("&").replace(qt,"+")},f.fn.extend({serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var e=f.prop(this,"elements");return e?f.makeArray(e):this}).filter(function(){var e=this.type;return this.name&&!f(this).is(":disabled")&&Ot.test(this.nodeName)&&!Ft.test(e)&&(this.checked||!U.test(e))}).map(function(e,t){var n=f(this).val();return null==n?null:f.isArray(n)?f.map(n,function(e){return{name:t.name,value:e.replace(Mt,"\r\n")}}):{name:t.name,value:n.replace(Mt,"\r\n")}}).get()}}),f.ajaxSettings.xhr=void 0!==e.ActiveXObject?function(){return!this.isLocal&&/^(get|post|head|put|delete|options)$/i.test(this.type)&&$t()||function(){try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(e){}}()}:$t;var Pt=0,Rt={},Wt=f.ajaxSettings.xhr();function $t(){try{return new e.XMLHttpRequest}catch(e){}}e.attachEvent&&e.attachEvent("onunload",function(){for(var e in Rt)Rt[e](void 0,!0)}),c.cors=!!Wt&&"withCredentials"in Wt,(Wt=c.ajax=!!Wt)&&f.ajaxTransport(function(e){var t;if(!e.crossDomain||c.cors)return{send:function(n,r){var i,o=e.xhr(),a=++Pt;if(o.open(e.type,e.url,e.async,e.username,e.password),e.xhrFields)for(i in e.xhrFields)o[i]=e.xhrFields[i];for(i in e.mimeType&&o.overrideMimeType&&o.overrideMimeType(e.mimeType),e.crossDomain||n["X-Requested-With"]||(n["X-Requested-With"]="XMLHttpRequest"),n)void 0!==n[i]&&o.setRequestHeader(i,n[i]+"");o.send(e.hasContent&&e.data||null),t=function(n,i){var s,l,u;if(t&&(i||4===o.readyState))if(delete Rt[a],t=void 0,o.onreadystatechange=f.noop,i)4!==o.readyState&&o.abort();else{u={},s=o.status,"string"==typeof o.responseText&&(u.text=o.responseText);try{l=o.statusText}catch(e){l=""}s||!e.isLocal||e.crossDomain?1223===s&&(s=204):s=u.text?200:404}u&&r(s,l,u,o.getAllResponseHeaders())},e.async?4===o.readyState?setTimeout(t):o.onreadystatechange=Rt[a]=t:t()},abort:function(){t&&t(void 0,!0)}}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(e){return f.globalEval(e),e}}}),f.ajaxPrefilter("script",function(e){void 0===e.cache&&(e.cache=!1),e.crossDomain&&(e.type="GET",e.global=!1)}),f.ajaxTransport("script",function(e){if(e.crossDomain){var t,n=N.head||f("head")[0]||N.documentElement;return{send:function(r,i){(t=N.createElement("script")).async=!0,e.scriptCharset&&(t.charset=e.scriptCharset),t.src=e.url,t.onload=t.onreadystatechange=function(e,n){(n||!t.readyState||/loaded|complete/.test(t.readyState))&&(t.onload=t.onreadystatechange=null,t.parentNode&&t.parentNode.removeChild(t),t=null,n||i(200,"success"))},n.insertBefore(t,n.firstChild)},abort:function(){t&&t.onload(void 0,!0)}}}});var zt=[],It=/(=)\?(?=&|$)|\?\?/;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=zt.pop()||f.expando+"_"+gt++;return this[e]=!0,e}}),f.ajaxPrefilter("json jsonp",function(t,n,r){var i,o,a,s=!1!==t.jsonp&&(It.test(t.url)?"url":"string"==typeof t.data&&!(t.contentType||"").indexOf("application/x-www-form-urlencoded")&&It.test(t.data)&&"data");return s||"jsonp"===t.dataTypes[0]?(i=t.jsonpCallback=f.isFunction(t.jsonpCallback)?t.jsonpCallback():t.jsonpCallback,s?t[s]=t[s].replace(It,"$1"+i):!1!==t.jsonp&&(t.url+=(vt.test(t.url)?"&":"?")+t.jsonp+"="+i),t.converters["script json"]=function(){return a||f.error(i+" was not called"),a[0]},t.dataTypes[0]="json",o=e[i],e[i]=function(){a=arguments},r.always(function(){e[i]=o,t[i]&&(t.jsonpCallback=n.jsonpCallback,zt.push(i)),a&&f.isFunction(o)&&o(a[0]),a=o=void 0}),"script"):void 0}),f.parseHTML=function(e,t,n){if(!e||"string"!=typeof e)return null;"boolean"==typeof t&&(n=t,t=!1),t=t||N;var r=x.exec(e),i=!n&&[];return r?[t.createElement(r[1])]:(r=f.buildFragment([e],t,i),i&&i.length&&f(i).remove(),f.merge([],r.childNodes))};var Xt=f.fn.load;f.fn.load=function(e,t,n){if("string"!=typeof e&&Xt)return Xt.apply(this,arguments);var r,i,o,a=this,s=e.indexOf(" ");return s>=0&&(r=f.trim(e.slice(s,e.length)),e=e.slice(0,s)),f.isFunction(t)?(n=t,t=void 0):t&&"object"==typeof t&&(o="POST"),a.length>0&&f.ajax({url:e,type:o,dataType:"html",data:t}).done(function(e){i=arguments,a.html(r?f("<div>").append(f.parseHTML(e)).find(r):e)}).complete(n&&function(e,t){a.each(n,i||[e.responseText,t,e])}),this},f.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){f.fn[t]=function(e){return this.on(t,e)}}),f.expr.filters.animated=function(e){return f.grep(f.timers,function(t){return e===t.elem}).length};var Ut=e.document.documentElement;function Vt(e){return f.isWindow(e)?e:9===e.nodeType&&(e.defaultView||e.parentWindow)}f.offset={setOffset:function(e,t,n){var r,i,o,a,s,l,u=f.css(e,"position"),c=f(e),d={};"static"===u&&(e.style.position="relative"),s=c.offset(),o=f.css(e,"top"),l=f.css(e,"left"),("absolute"===u||"fixed"===u)&&f.inArray("auto",[o,l])>-1?(a=(r=c.position()).top,i=r.left):(a=parseFloat(o)||0,i=parseFloat(l)||0),f.isFunction(t)&&(t=t.call(e,n,s)),null!=t.top&&(d.top=t.top-s.top+a),null!=t.left&&(d.left=t.left-s.left+i),"using"in t?t.using.call(e,d):c.css(d)}},f.fn.extend({offset:function(e){if(arguments.length)return void 0===e?this:this.each(function(t){f.offset.setOffset(this,e,t)});var t,n,r={top:0,left:0},i=this[0],o=i&&i.ownerDocument;return o?(t=o.documentElement,f.contains(t,i)?(typeof i.getBoundingClientRect!==M&&(r=i.getBoundingClientRect()),n=Vt(o),{top:r.top+(n.pageYOffset||t.scrollTop)-(t.clientTop||0),left:r.left+(n.pageXOffset||t.scrollLeft)-(t.clientLeft||0)}):r):void 0},position:function(){if(this[0]){var e,t,n={top:0,left:0},r=this[0];return"fixed"===f.css(r,"position")?t=r.getBoundingClientRect():(e=this.offsetParent(),t=this.offset(),f.nodeName(e[0],"html")||(n=e.offset()),n.top+=f.css(e[0],"borderTopWidth",!0),n.left+=f.css(e[0],"borderLeftWidth",!0)),{top:t.top-n.top-f.css(r,"marginTop",!0),left:t.left-n.left-f.css(r,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){for(var e=this.offsetParent||Ut;e&&!f.nodeName(e,"html")&&"static"===f.css(e,"position");)e=e.offsetParent;return e||Ut})}}),f.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,t){var n=/Y/.test(t);f.fn[e]=function(r){return X(this,function(e,r,i){var o=Vt(e);return void 0===i?o?t in o?o[t]:o.document.documentElement[r]:e[r]:void(o?o.scrollTo(n?f(o).scrollLeft():i,n?i:f(o).scrollTop()):e[r]=i)},e,r,arguments.length,null)}}),f.each(["top","left"],function(e,t){f.cssHooks[t]=_e(c.pixelPosition,function(e,n){return n?(n=je(e,t),He.test(n)?f(e).position()[t]+"px":n):void 0})}),f.each({Height:"height",Width:"width"},function(e,t){f.each({padding:"inner"+e,content:t,"":"outer"+e},function(n,r){f.fn[r]=function(r,i){var o=arguments.length&&(n||"boolean"!=typeof r),a=n||(!0===r||!0===i?"margin":"border");return X(this,function(t,n,r){var i;return f.isWindow(t)?t.document.documentElement["client"+e]:9===t.nodeType?(i=t.documentElement,Math.max(t.body["scroll"+e],i["scroll"+e],t.body["offset"+e],i["offset"+e],i["client"+e])):void 0===r?f.css(t,n,a):f.style(t,n,r,a)},t,o?r:void 0,o,null)}})}),f.fn.size=function(){return this.length},f.fn.andSelf=f.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return f});var Jt=e.jQuery,Yt=e.$;return f.noConflict=function(t){return e.$===f&&(e.$=Yt),t&&e.jQuery===f&&(e.jQuery=Jt),f},typeof t===M&&(e.jQuery=e.$=f),f});
                IV$ = window.IV$ = jQuery.noConflict(true); 
            };
        };
    })();
} catch (err) {
    //!function(e,t){"object"==typeof module&&"object"==typeof module.exports?module.exports=e.document?t(e,!0):function(e){if(!e.document)throw new Error("jQuery requires a window with a document");return t(e)}:t(e)}("undefined"!=typeof window?window:this,function(e,t){var n=[],r=n.slice,i=n.concat,o=n.push,a=n.indexOf,s={},l=s.toString,u=s.hasOwnProperty,c={},d="1.11.2",f=function(e,t){return new f.fn.init(e,t)},p=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,h=/^-ms-/,m=/-([\da-z])/gi,g=function(e,t){return t.toUpperCase()};function v(e){var t=e.length,n=f.type(e);return"function"!==n&&!f.isWindow(e)&&(!(1!==e.nodeType||!t)||("array"===n||0===t||"number"==typeof t&&t>0&&t-1 in e))}f.fn=f.prototype={jquery:d,constructor:f,selector:"",length:0,toArray:function(){return r.call(this)},get:function(e){return null!=e?0>e?this[e+this.length]:this[e]:r.call(this)},pushStack:function(e){var t=f.merge(this.constructor(),e);return t.prevObject=this,t.context=this.context,t},each:function(e,t){return f.each(this,e,t)},map:function(e){return this.pushStack(f.map(this,function(t,n){return e.call(t,n,t)}))},slice:function(){return this.pushStack(r.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(e){var t=this.length,n=+e+(0>e?t:0);return this.pushStack(n>=0&&t>n?[this[n]]:[])},end:function(){return this.prevObject||this.constructor(null)},push:o,sort:n.sort,splice:n.splice},f.extend=f.fn.extend=function(){var e,t,n,r,i,o,a=arguments[0]||{},s=1,l=arguments.length,u=!1;for("boolean"==typeof a&&(u=a,a=arguments[s]||{},s++),"object"==typeof a||f.isFunction(a)||(a={}),s===l&&(a=this,s--);l>s;s++)if(null!=(i=arguments[s]))for(r in i)e=a[r],a!==(n=i[r])&&(u&&n&&(f.isPlainObject(n)||(t=f.isArray(n)))?(t?(t=!1,o=e&&f.isArray(e)?e:[]):o=e&&f.isPlainObject(e)?e:{},a[r]=f.extend(u,o,n)):void 0!==n&&(a[r]=n));return a},f.extend({expando:"jQuery"+(d+Math.random()).replace(/\D/g,""),isReady:!0,error:function(e){throw new Error(e)},noop:function(){},isFunction:function(e){return"function"===f.type(e)},isArray:Array.isArray||function(e){return"array"===f.type(e)},isWindow:function(e){return null!=e&&e==e.window},isNumeric:function(e){return!f.isArray(e)&&e-parseFloat(e)+1>=0},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},isPlainObject:function(e){var t;if(!e||"object"!==f.type(e)||e.nodeType||f.isWindow(e))return!1;try{if(e.constructor&&!u.call(e,"constructor")&&!u.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(e){return!1}if(c.ownLast)for(t in e)return u.call(e,t);for(t in e);return void 0===t||u.call(e,t)},type:function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?s[l.call(e)]||"object":typeof e},globalEval:function(t){t&&f.trim(t)&&(e.execScript||function(t){e.eval.call(e,t)})(t)},camelCase:function(e){return e.replace(h,"ms-").replace(m,g)},nodeName:function(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()},each:function(e,t,n){var r=0,i=e.length,o=v(e);if(n){if(o)for(;i>r&&!1!==t.apply(e[r],n);r++);else for(r in e)if(!1===t.apply(e[r],n))break}else if(o)for(;i>r&&!1!==t.call(e[r],r,e[r]);r++);else for(r in e)if(!1===t.call(e[r],r,e[r]))break;return e},trim:function(e){return null==e?"":(e+"").replace(p,"")},makeArray:function(e,t){var n=t||[];return null!=e&&(v(Object(e))?f.merge(n,"string"==typeof e?[e]:e):o.call(n,e)),n},inArray:function(e,t,n){var r;if(t){if(a)return a.call(t,e,n);for(r=t.length,n=n?0>n?Math.max(0,r+n):n:0;r>n;n++)if(n in t&&t[n]===e)return n}return-1},merge:function(e,t){for(var n=+t.length,r=0,i=e.length;n>r;)e[i++]=t[r++];if(n!=n)for(;void 0!==t[r];)e[i++]=t[r++];return e.length=i,e},grep:function(e,t,n){for(var r=[],i=0,o=e.length,a=!n;o>i;i++)!t(e[i],i)!==a&&r.push(e[i]);return r},map:function(e,t,n){var r,o=0,a=e.length,s=[];if(v(e))for(;a>o;o++)null!=(r=t(e[o],o,n))&&s.push(r);else for(o in e)null!=(r=t(e[o],o,n))&&s.push(r);return i.apply([],s)},guid:1,proxy:function(e,t){var n,i,o;return"string"==typeof t&&(o=e[t],t=e,e=o),f.isFunction(e)?(n=r.call(arguments,2),(i=function(){return e.apply(t||this,n.concat(r.call(arguments)))}).guid=e.guid=e.guid||f.guid++,i):void 0},now:function(){return+new Date},support:c}),f.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(e,t){s["[object "+t+"]"]=t.toLowerCase()});var y=function(e){var t,n,r,i,o,a,s,l,u,c,d,f,p,h,m,g,v,y,b,x="sizzle"+1*new Date,w=e.document,T=0,C=0,N=ae(),E=ae(),k=ae(),S=function(e,t){return e===t&&(d=!0),0},A=1<<31,D={}.hasOwnProperty,j=[],L=j.pop,H=j.push,q=j.push,_=j.slice,M=function(e,t){for(var n=0,r=e.length;r>n;n++)if(e[n]===t)return n;return-1},F="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",O="[\\x20\\t\\r\\n\\f]",B="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",P=B.replace("w","w#"),R="\\["+O+"*("+B+")(?:"+O+"*([*^$|!~]?=)"+O+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+P+"))|)"+O+"*\\]",W=":("+B+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+R+")*)|.*)\\)|)",$=new RegExp(O+"+","g"),z=new RegExp("^"+O+"+|((?:^|[^\\\\])(?:\\\\.)*)"+O+"+$","g"),I=new RegExp("^"+O+"*,"+O+"*"),X=new RegExp("^"+O+"*([>+~]|"+O+")"+O+"*"),U=new RegExp("="+O+"*([^\\]'\"]*?)"+O+"*\\]","g"),V=new RegExp(W),J=new RegExp("^"+P+"$"),Y={ID:new RegExp("^#("+B+")"),CLASS:new RegExp("^\\.("+B+")"),TAG:new RegExp("^("+B.replace("w","w*")+")"),ATTR:new RegExp("^"+R),PSEUDO:new RegExp("^"+W),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+O+"*(even|odd|(([+-]|)(\\d*)n|)"+O+"*(?:([+-]|)"+O+"*(\\d+)|))"+O+"*\\)|)","i"),bool:new RegExp("^(?:"+F+")$","i"),needsContext:new RegExp("^"+O+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+O+"*((?:-\\d)?\\d*)"+O+"*\\)|)(?=[^-]|$)","i")},G=/^(?:input|select|textarea|button)$/i,Q=/^h\d$/i,K=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ee=/[+~]/,te=/'|\\/g,ne=new RegExp("\\\\([\\da-f]{1,6}"+O+"?|("+O+")|.)","ig"),re=function(e,t,n){var r="0x"+t-65536;return r!=r||n?t:0>r?String.fromCharCode(r+65536):String.fromCharCode(r>>10|55296,1023&r|56320)},ie=function(){f()};try{q.apply(j=_.call(w.childNodes),w.childNodes),j[w.childNodes.length].nodeType}catch(e){q={apply:j.length?function(e,t){H.apply(e,_.call(t))}:function(e,t){for(var n=e.length,r=0;e[n++]=t[r++];);e.length=n-1}}}function oe(e,t,r,i){var o,s,u,c,d,h,v,y,T,C;if((t?t.ownerDocument||t:w)!==p&&f(t),r=r||[],c=(t=t||p).nodeType,"string"!=typeof e||!e||1!==c&&9!==c&&11!==c)return r;if(!i&&m){if(11!==c&&(o=Z.exec(e)))if(u=o[1]){if(9===c){if(!(s=t.getElementById(u))||!s.parentNode)return r;if(s.id===u)return r.push(s),r}else if(t.ownerDocument&&(s=t.ownerDocument.getElementById(u))&&b(t,s)&&s.id===u)return r.push(s),r}else{if(o[2])return q.apply(r,t.getElementsByTagName(e)),r;if((u=o[3])&&n.getElementsByClassName)return q.apply(r,t.getElementsByClassName(u)),r}if(n.qsa&&(!g||!g.test(e))){if(y=v=x,T=t,C=1!==c&&e,1===c&&"object"!==t.nodeName.toLowerCase()){for(h=a(e),(v=t.getAttribute("id"))?y=v.replace(te,"\\$&"):t.setAttribute("id",y),y="[id='"+y+"'] ",d=h.length;d--;)h[d]=y+ge(h[d]);T=ee.test(e)&&he(t.parentNode)||t,C=h.join(",")}if(C)try{return q.apply(r,T.querySelectorAll(C)),r}catch(e){}finally{v||t.removeAttribute("id")}}}return l(e.replace(z,"$1"),t,r,i)}function ae(){var e=[];return function t(n,i){return e.push(n+" ")>r.cacheLength&&delete t[e.shift()],t[n+" "]=i}}function se(e){return e[x]=!0,e}function le(e){var t=p.createElement("div");try{return!!e(t)}catch(e){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function ue(e,t){for(var n=e.split("|"),i=e.length;i--;)r.attrHandle[n[i]]=t}function ce(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||A)-(~e.sourceIndex||A);if(r)return r;if(n)for(;n=n.nextSibling;)if(n===t)return-1;return e?1:-1}function de(e){return function(t){return"input"===t.nodeName.toLowerCase()&&t.type===e}}function fe(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function pe(e){return se(function(t){return t=+t,se(function(n,r){for(var i,o=e([],n.length,t),a=o.length;a--;)n[i=o[a]]&&(n[i]=!(r[i]=n[i]))})})}function he(e){return e&&void 0!==e.getElementsByTagName&&e}for(t in n=oe.support={},o=oe.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return!!t&&"HTML"!==t.nodeName},f=oe.setDocument=function(e){var t,i,a=e?e.ownerDocument||e:w;return a!==p&&9===a.nodeType&&a.documentElement?(p=a,h=a.documentElement,(i=a.defaultView)&&i!==i.top&&(i.addEventListener?i.addEventListener("unload",ie,!1):i.attachEvent&&i.attachEvent("onunload",ie)),m=!o(a),n.attributes=le(function(e){return e.className="i",!e.getAttribute("className")}),n.getElementsByTagName=le(function(e){return e.appendChild(a.createComment("")),!e.getElementsByTagName("*").length}),n.getElementsByClassName=K.test(a.getElementsByClassName),n.getById=le(function(e){return h.appendChild(e).id=x,!a.getElementsByName||!a.getElementsByName(x).length}),n.getById?(r.find.ID=function(e,t){if(void 0!==t.getElementById&&m){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){return e.getAttribute("id")===t}}):(delete r.find.ID,r.filter.ID=function(e){var t=e.replace(ne,re);return function(e){var n=void 0!==e.getAttributeNode&&e.getAttributeNode("id");return n&&n.value===t}}),r.find.TAG=n.getElementsByTagName?function(e,t){return void 0!==t.getElementsByTagName?t.getElementsByTagName(e):n.qsa?t.querySelectorAll(e):void 0}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){for(;n=o[i++];)1===n.nodeType&&r.push(n);return r}return o},r.find.CLASS=n.getElementsByClassName&&function(e,t){return m?t.getElementsByClassName(e):void 0},v=[],g=[],(n.qsa=K.test(a.querySelectorAll))&&(le(function(e){h.appendChild(e).innerHTML="<a id='"+x+"'></a><select id='"+x+"-\f]' msallowcapture=''><option selected=''></option></select>",e.querySelectorAll("[msallowcapture^='']").length&&g.push("[*^$]="+O+"*(?:''|\"\")"),e.querySelectorAll("[selected]").length||g.push("\\["+O+"*(?:value|"+F+")"),e.querySelectorAll("[id~="+x+"-]").length||g.push("~="),e.querySelectorAll(":checked").length||g.push(":checked"),e.querySelectorAll("a#"+x+"+*").length||g.push(".#.+[+~]")}),le(function(e){var t=a.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("name","D"),e.querySelectorAll("[name=d]").length&&g.push("name"+O+"*[*^$|!~]?="),e.querySelectorAll(":enabled").length||g.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),g.push(",.*:")})),(n.matchesSelector=K.test(y=h.matches||h.webkitMatchesSelector||h.mozMatchesSelector||h.oMatchesSelector||h.msMatchesSelector))&&le(function(e){n.disconnectedMatch=y.call(e,"div"),y.call(e,"[s!='']:x"),v.push("!=",W)}),g=g.length&&new RegExp(g.join("|")),v=v.length&&new RegExp(v.join("|")),t=K.test(h.compareDocumentPosition),b=t||K.test(h.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)for(;t=t.parentNode;)if(t===e)return!0;return!1},S=t?function(e,t){if(e===t)return d=!0,0;var r=!e.compareDocumentPosition-!t.compareDocumentPosition;return r||(1&(r=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):1)||!n.sortDetached&&t.compareDocumentPosition(e)===r?e===a||e.ownerDocument===w&&b(w,e)?-1:t===a||t.ownerDocument===w&&b(w,t)?1:c?M(c,e)-M(c,t):0:4&r?-1:1)}:function(e,t){if(e===t)return d=!0,0;var n,r=0,i=e.parentNode,o=t.parentNode,s=[e],l=[t];if(!i||!o)return e===a?-1:t===a?1:i?-1:o?1:c?M(c,e)-M(c,t):0;if(i===o)return ce(e,t);for(n=e;n=n.parentNode;)s.unshift(n);for(n=t;n=n.parentNode;)l.unshift(n);for(;s[r]===l[r];)r++;return r?ce(s[r],l[r]):s[r]===w?-1:l[r]===w?1:0},a):p},oe.matches=function(e,t){return oe(e,null,null,t)},oe.matchesSelector=function(e,t){if((e.ownerDocument||e)!==p&&f(e),t=t.replace(U,"='$1']"),!(!n.matchesSelector||!m||v&&v.test(t)||g&&g.test(t)))try{var r=y.call(e,t);if(r||n.disconnectedMatch||e.document&&11!==e.document.nodeType)return r}catch(e){}return oe(t,p,null,[e]).length>0},oe.contains=function(e,t){return(e.ownerDocument||e)!==p&&f(e),b(e,t)},oe.attr=function(e,t){(e.ownerDocument||e)!==p&&f(e);var i=r.attrHandle[t.toLowerCase()],o=i&&D.call(r.attrHandle,t.toLowerCase())?i(e,t,!m):void 0;return void 0!==o?o:n.attributes||!m?e.getAttribute(t):(o=e.getAttributeNode(t))&&o.specified?o.value:null},oe.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},oe.uniqueSort=function(e){var t,r=[],i=0,o=0;if(d=!n.detectDuplicates,c=!n.sortStable&&e.slice(0),e.sort(S),d){for(;t=e[o++];)t===e[o]&&(i=r.push(o));for(;i--;)e.splice(r[i],1)}return c=null,e},i=oe.getText=function(e){var t,n="",r=0,o=e.nodeType;if(o){if(1===o||9===o||11===o){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=i(e)}else if(3===o||4===o)return e.nodeValue}else for(;t=e[r++];)n+=i(t);return n},(r=oe.selectors={cacheLength:50,createPseudo:se,match:Y,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(ne,re),e[3]=(e[3]||e[4]||e[5]||"").replace(ne,re),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||oe.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&oe.error(e[0]),e},PSEUDO:function(e){var t,n=!e[6]&&e[2];return Y.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&V.test(n)&&(t=a(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(ne,re).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=N[e+" "];return t||(t=new RegExp("(^|"+O+")"+e+"("+O+"|$)"))&&N(e,function(e){return t.test("string"==typeof e.className&&e.className||void 0!==e.getAttribute&&e.getAttribute("class")||"")})},ATTR:function(e,t,n){return function(r){var i=oe.attr(r,e);return null==i?"!="===t:!t||(i+="","="===t?i===n:"!="===t?i!==n:"^="===t?n&&0===i.indexOf(n):"*="===t?n&&i.indexOf(n)>-1:"$="===t?n&&i.slice(-n.length)===n:"~="===t?(" "+i.replace($," ")+" ").indexOf(n)>-1:"|="===t&&(i===n||i.slice(0,n.length+1)===n+"-"))}},CHILD:function(e,t,n,r,i){var o="nth"!==e.slice(0,3),a="last"!==e.slice(-4),s="of-type"===t;return 1===r&&0===i?function(e){return!!e.parentNode}:function(t,n,l){var u,c,d,f,p,h,m=o!==a?"nextSibling":"previousSibling",g=t.parentNode,v=s&&t.nodeName.toLowerCase(),y=!l&&!s;if(g){if(o){for(;m;){for(d=t;d=d[m];)if(s?d.nodeName.toLowerCase()===v:1===d.nodeType)return!1;h=m="only"===e&&!h&&"nextSibling"}return!0}if(h=[a?g.firstChild:g.lastChild],a&&y){for(p=(u=(c=g[x]||(g[x]={}))[e]||[])[0]===T&&u[1],f=u[0]===T&&u[2],d=p&&g.childNodes[p];d=++p&&d&&d[m]||(f=p=0)||h.pop();)if(1===d.nodeType&&++f&&d===t){c[e]=[T,p,f];break}}else if(y&&(u=(t[x]||(t[x]={}))[e])&&u[0]===T)f=u[1];else for(;(d=++p&&d&&d[m]||(f=p=0)||h.pop())&&((s?d.nodeName.toLowerCase()!==v:1!==d.nodeType)||!++f||(y&&((d[x]||(d[x]={}))[e]=[T,f]),d!==t)););return(f-=i)===r||f%r==0&&f/r>=0}}},PSEUDO:function(e,t){var n,i=r.pseudos[e]||r.setFilters[e.toLowerCase()]||oe.error("unsupported pseudo: "+e);return i[x]?i(t):i.length>1?(n=[e,e,"",t],r.setFilters.hasOwnProperty(e.toLowerCase())?se(function(e,n){for(var r,o=i(e,t),a=o.length;a--;)e[r=M(e,o[a])]=!(n[r]=o[a])}):function(e){return i(e,0,n)}):i}},pseudos:{not:se(function(e){var t=[],n=[],r=s(e.replace(z,"$1"));return r[x]?se(function(e,t,n,i){for(var o,a=r(e,null,i,[]),s=e.length;s--;)(o=a[s])&&(e[s]=!(t[s]=o))}):function(e,i,o){return t[0]=e,r(t,null,o,n),t[0]=null,!n.pop()}}),has:se(function(e){return function(t){return oe(e,t).length>0}}),contains:se(function(e){return e=e.replace(ne,re),function(t){return(t.textContent||t.innerText||i(t)).indexOf(e)>-1}}),lang:se(function(e){return J.test(e||"")||oe.error("unsupported lang: "+e),e=e.replace(ne,re).toLowerCase(),function(t){var n;do{if(n=m?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang"))return(n=n.toLowerCase())===e||0===n.indexOf(e+"-")}while((t=t.parentNode)&&1===t.nodeType);return!1}}),target:function(t){var n=e.location&&e.location.hash;return n&&n.slice(1)===t.id},root:function(e){return e===h},focus:function(e){return e===p.activeElement&&(!p.hasFocus||p.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return!1===e.disabled},disabled:function(e){return!0===e.disabled},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,!0===e.selected},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!r.pseudos.empty(e)},header:function(e){return Q.test(e.nodeName)},input:function(e){return G.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:pe(function(){return[0]}),last:pe(function(e,t){return[t-1]}),eq:pe(function(e,t,n){return[0>n?n+t:n]}),even:pe(function(e,t){for(var n=0;t>n;n+=2)e.push(n);return e}),odd:pe(function(e,t){for(var n=1;t>n;n+=2)e.push(n);return e}),lt:pe(function(e,t,n){for(var r=0>n?n+t:n;--r>=0;)e.push(r);return e}),gt:pe(function(e,t,n){for(var r=0>n?n+t:n;++r<t;)e.push(r);return e})}}).pseudos.nth=r.pseudos.eq,{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})r.pseudos[t]=de(t);for(t in{submit:!0,reset:!0})r.pseudos[t]=fe(t);function me(){}function ge(e){for(var t=0,n=e.length,r="";n>t;t++)r+=e[t].value;return r}function ve(e,t,n){var r=t.dir,i=n&&"parentNode"===r,o=C++;return t.first?function(t,n,o){for(;t=t[r];)if(1===t.nodeType||i)return e(t,n,o)}:function(t,n,a){var s,l,u=[T,o];if(a){for(;t=t[r];)if((1===t.nodeType||i)&&e(t,n,a))return!0}else for(;t=t[r];)if(1===t.nodeType||i){if((s=(l=t[x]||(t[x]={}))[r])&&s[0]===T&&s[1]===o)return u[2]=s[2];if(l[r]=u,u[2]=e(t,n,a))return!0}}}function ye(e){return e.length>1?function(t,n,r){for(var i=e.length;i--;)if(!e[i](t,n,r))return!1;return!0}:e[0]}function be(e,t,n,r,i){for(var o,a=[],s=0,l=e.length,u=null!=t;l>s;s++)(o=e[s])&&(!n||n(o,r,i))&&(a.push(o),u&&t.push(s));return a}function xe(e,t,n,r,i,o){return r&&!r[x]&&(r=xe(r)),i&&!i[x]&&(i=xe(i,o)),se(function(o,a,s,l){var u,c,d,f=[],p=[],h=a.length,m=o||function(e,t,n){for(var r=0,i=t.length;i>r;r++)oe(e,t[r],n);return n}(t||"*",s.nodeType?[s]:s,[]),g=!e||!o&&t?m:be(m,f,e,s,l),v=n?i||(o?e:h||r)?[]:a:g;if(n&&n(g,v,s,l),r)for(u=be(v,p),r(u,[],s,l),c=u.length;c--;)(d=u[c])&&(v[p[c]]=!(g[p[c]]=d));if(o){if(i||e){if(i){for(u=[],c=v.length;c--;)(d=v[c])&&u.push(g[c]=d);i(null,v=[],u,l)}for(c=v.length;c--;)(d=v[c])&&(u=i?M(o,d):f[c])>-1&&(o[u]=!(a[u]=d))}}else v=be(v===a?v.splice(h,v.length):v),i?i(null,a,v,l):q.apply(a,v)})}function we(e){for(var t,n,i,o=e.length,a=r.relative[e[0].type],s=a||r.relative[" "],l=a?1:0,c=ve(function(e){return e===t},s,!0),d=ve(function(e){return M(t,e)>-1},s,!0),f=[function(e,n,r){var i=!a&&(r||n!==u)||((t=n).nodeType?c(e,n,r):d(e,n,r));return t=null,i}];o>l;l++)if(n=r.relative[e[l].type])f=[ve(ye(f),n)];else{if((n=r.filter[e[l].type].apply(null,e[l].matches))[x]){for(i=++l;o>i&&!r.relative[e[i].type];i++);return xe(l>1&&ye(f),l>1&&ge(e.slice(0,l-1).concat({value:" "===e[l-2].type?"*":""})).replace(z,"$1"),n,i>l&&we(e.slice(l,i)),o>i&&we(e=e.slice(i)),o>i&&ge(e))}f.push(n)}return ye(f)}function Te(e,t){var n=t.length>0,i=e.length>0,o=function(o,a,s,l,c){var d,f,h,m=0,g="0",v=o&&[],y=[],b=u,x=o||i&&r.find.TAG("*",c),w=T+=null==b?1:Math.random()||.1,C=x.length;for(c&&(u=a!==p&&a);g!==C&&null!=(d=x[g]);g++){if(i&&d){for(f=0;h=e[f++];)if(h(d,a,s)){l.push(d);break}c&&(T=w)}n&&((d=!h&&d)&&m--,o&&v.push(d))}if(m+=g,n&&g!==m){for(f=0;h=t[f++];)h(v,y,a,s);if(o){if(m>0)for(;g--;)v[g]||y[g]||(y[g]=L.call(l));y=be(y)}q.apply(l,y),c&&!o&&y.length>0&&m+t.length>1&&oe.uniqueSort(l)}return c&&(T=w,u=b),v};return n?se(o):o}return me.prototype=r.filters=r.pseudos,r.setFilters=new me,a=oe.tokenize=function(e,t){var n,i,o,a,s,l,u,c=E[e+" "];if(c)return t?0:c.slice(0);for(s=e,l=[],u=r.preFilter;s;){for(a in(!n||(i=I.exec(s)))&&(i&&(s=s.slice(i[0].length)||s),l.push(o=[])),n=!1,(i=X.exec(s))&&(n=i.shift(),o.push({value:n,type:i[0].replace(z," ")}),s=s.slice(n.length)),r.filter)!(i=Y[a].exec(s))||u[a]&&!(i=u[a](i))||(n=i.shift(),o.push({value:n,type:a,matches:i}),s=s.slice(n.length));if(!n)break}return t?s.length:s?oe.error(e):E(e,l).slice(0)},s=oe.compile=function(e,t){var n,r=[],i=[],o=k[e+" "];if(!o){for(t||(t=a(e)),n=t.length;n--;)(o=we(t[n]))[x]?r.push(o):i.push(o);(o=k(e,Te(i,r))).selector=e}return o},l=oe.select=function(e,t,i,o){var l,u,c,d,f,p="function"==typeof e&&e,h=!o&&a(e=p.selector||e);if(i=i||[],1===h.length){if((u=h[0]=h[0].slice(0)).length>2&&"ID"===(c=u[0]).type&&n.getById&&9===t.nodeType&&m&&r.relative[u[1].type]){if(!(t=(r.find.ID(c.matches[0].replace(ne,re),t)||[])[0]))return i;p&&(t=t.parentNode),e=e.slice(u.shift().value.length)}for(l=Y.needsContext.test(e)?0:u.length;l--&&(c=u[l],!r.relative[d=c.type]);)if((f=r.find[d])&&(o=f(c.matches[0].replace(ne,re),ee.test(u[0].type)&&he(t.parentNode)||t))){if(u.splice(l,1),!(e=o.length&&ge(u)))return q.apply(i,o),i;break}}return(p||s(e,h))(o,t,!m,i,ee.test(e)&&he(t.parentNode)||t),i},n.sortStable=x.split("").sort(S).join("")===x,n.detectDuplicates=!!d,f(),n.sortDetached=le(function(e){return 1&e.compareDocumentPosition(p.createElement("div"))}),le(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||ue("type|href|height|width",function(e,t,n){return n?void 0:e.getAttribute(t,"type"===t.toLowerCase()?1:2)}),n.attributes&&le(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||ue("value",function(e,t,n){return n||"input"!==e.nodeName.toLowerCase()?void 0:e.defaultValue}),le(function(e){return null==e.getAttribute("disabled")})||ue(F,function(e,t,n){var r;return n?void 0:!0===e[t]?t.toLowerCase():(r=e.getAttributeNode(t))&&r.specified?r.value:null}),oe}(e);f.find=y,f.expr=y.selectors,f.expr[":"]=f.expr.pseudos,f.unique=y.uniqueSort,f.text=y.getText,f.isXMLDoc=y.isXML,f.contains=y.contains;var b=f.expr.match.needsContext,x=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,w=/^.[^:#\[\.,]*$/;function T(e,t,n){if(f.isFunction(t))return f.grep(e,function(e,r){return!!t.call(e,r,e)!==n});if(t.nodeType)return f.grep(e,function(e){return e===t!==n});if("string"==typeof t){if(w.test(t))return f.filter(t,e,n);t=f.filter(t,e)}return f.grep(e,function(e){return f.inArray(e,t)>=0!==n})}f.filter=function(e,t,n){var r=t[0];return n&&(e=":not("+e+")"),1===t.length&&1===r.nodeType?f.find.matchesSelector(r,e)?[r]:[]:f.find.matches(e,f.grep(t,function(e){return 1===e.nodeType}))},f.fn.extend({find:function(e){var t,n=[],r=this,i=r.length;if("string"!=typeof e)return this.pushStack(f(e).filter(function(){for(t=0;i>t;t++)if(f.contains(r[t],this))return!0}));for(t=0;i>t;t++)f.find(e,r[t],n);return(n=this.pushStack(i>1?f.unique(n):n)).selector=this.selector?this.selector+" "+e:e,n},filter:function(e){return this.pushStack(T(this,e||[],!1))},not:function(e){return this.pushStack(T(this,e||[],!0))},is:function(e){return!!T(this,"string"==typeof e&&b.test(e)?f(e):e||[],!1).length}});var C,N=e.document,E=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;(f.fn.init=function(e,t){var n,r;if(!e)return this;if("string"==typeof e){if(!(n="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:E.exec(e))||!n[1]&&t)return!t||t.jquery?(t||C).find(e):this.constructor(t).find(e);if(n[1]){if(t=t instanceof f?t[0]:t,f.merge(this,f.parseHTML(n[1],t&&t.nodeType?t.ownerDocument||t:N,!0)),x.test(n[1])&&f.isPlainObject(t))for(n in t)f.isFunction(this[n])?this[n](t[n]):this.attr(n,t[n]);return this}if((r=N.getElementById(n[2]))&&r.parentNode){if(r.id!==n[2])return C.find(e);this.length=1,this[0]=r}return this.context=N,this.selector=e,this}return e.nodeType?(this.context=this[0]=e,this.length=1,this):f.isFunction(e)?void 0!==C.ready?C.ready(e):e(f):(void 0!==e.selector&&(this.selector=e.selector,this.context=e.context),f.makeArray(e,this))}).prototype=f.fn,C=f(N);var k=/^(?:parents|prev(?:Until|All))/,S={children:!0,contents:!0,next:!0,prev:!0};function A(e,t){do{e=e[t]}while(e&&1!==e.nodeType);return e}f.extend({dir:function(e,t,n){for(var r=[],i=e[t];i&&9!==i.nodeType&&(void 0===n||1!==i.nodeType||!f(i).is(n));)1===i.nodeType&&r.push(i),i=i[t];return r},sibling:function(e,t){for(var n=[];e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n}}),f.fn.extend({has:function(e){var t,n=f(e,this),r=n.length;return this.filter(function(){for(t=0;r>t;t++)if(f.contains(this,n[t]))return!0})},closest:function(e,t){for(var n,r=0,i=this.length,o=[],a=b.test(e)||"string"!=typeof e?f(e,t||this.context):0;i>r;r++)for(n=this[r];n&&n!==t;n=n.parentNode)if(n.nodeType<11&&(a?a.index(n)>-1:1===n.nodeType&&f.find.matchesSelector(n,e))){o.push(n);break}return this.pushStack(o.length>1?f.unique(o):o)},index:function(e){return e?"string"==typeof e?f.inArray(this[0],f(e)):f.inArray(e.jquery?e[0]:e,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(e,t){return this.pushStack(f.unique(f.merge(this.get(),f(e,t))))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}}),f.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return f.dir(e,"parentNode")},parentsUntil:function(e,t,n){return f.dir(e,"parentNode",n)},next:function(e){return A(e,"nextSibling")},prev:function(e){return A(e,"previousSibling")},nextAll:function(e){return f.dir(e,"nextSibling")},prevAll:function(e){return f.dir(e,"previousSibling")},nextUntil:function(e,t,n){return f.dir(e,"nextSibling",n)},prevUntil:function(e,t,n){return f.dir(e,"previousSibling",n)},siblings:function(e){return f.sibling((e.parentNode||{}).firstChild,e)},children:function(e){return f.sibling(e.firstChild)},contents:function(e){return f.nodeName(e,"iframe")?e.contentDocument||e.contentWindow.document:f.merge([],e.childNodes)}},function(e,t){f.fn[e]=function(n,r){var i=f.map(this,t,n);return"Until"!==e.slice(-5)&&(r=n),r&&"string"==typeof r&&(i=f.filter(r,i)),this.length>1&&(S[e]||(i=f.unique(i)),k.test(e)&&(i=i.reverse())),this.pushStack(i)}});var D,j=/\S+/g,L={};function H(){N.addEventListener?(N.removeEventListener("DOMContentLoaded",q,!1),e.removeEventListener("load",q,!1)):(N.detachEvent("onreadystatechange",q),e.detachEvent("onload",q))}function q(){(N.addEventListener||"load"===event.type||"complete"===N.readyState)&&(H(),f.ready())}f.Callbacks=function(e){e="string"==typeof e?L[e]||function(e){var t=L[e]={};return f.each(e.match(j)||[],function(e,n){t[n]=!0}),t}(e):f.extend({},e);var t,n,r,i,o,a,s=[],l=!e.once&&[],u=function(d){for(n=e.memory&&d,r=!0,o=a||0,a=0,i=s.length,t=!0;s&&i>o;o++)if(!1===s[o].apply(d[0],d[1])&&e.stopOnFalse){n=!1;break}t=!1,s&&(l?l.length&&u(l.shift()):n?s=[]:c.disable())},c={add:function(){if(s){var r=s.length;!function t(n){f.each(n,function(n,r){var i=f.type(r);"function"===i?e.unique&&c.has(r)||s.push(r):r&&r.length&&"string"!==i&&t(r)})}(arguments),t?i=s.length:n&&(a=r,u(n))}return this},remove:function(){return s&&f.each(arguments,function(e,n){for(var r;(r=f.inArray(n,s,r))>-1;)s.splice(r,1),t&&(i>=r&&i--,o>=r&&o--)}),this},has:function(e){return e?f.inArray(e,s)>-1:!(!s||!s.length)},empty:function(){return s=[],i=0,this},disable:function(){return s=l=n=void 0,this},disabled:function(){return!s},lock:function(){return l=void 0,n||c.disable(),this},locked:function(){return!l},fireWith:function(e,n){return!s||r&&!l||(n=[e,(n=n||[]).slice?n.slice():n],t?l.push(n):u(n)),this},fire:function(){return c.fireWith(this,arguments),this},fired:function(){return!!r}};return c},f.extend({Deferred:function(e){var t=[["resolve","done",f.Callbacks("once memory"),"resolved"],["reject","fail",f.Callbacks("once memory"),"rejected"],["notify","progress",f.Callbacks("memory")]],n="pending",r={state:function(){return n},always:function(){return i.done(arguments).fail(arguments),this},then:function(){var e=arguments;return f.Deferred(function(n){f.each(t,function(t,o){var a=f.isFunction(e[t])&&e[t];i[o[1]](function(){var e=a&&a.apply(this,arguments);e&&f.isFunction(e.promise)?e.promise().done(n.resolve).fail(n.reject).progress(n.notify):n[o[0]+"With"](this===r?n.promise():this,a?[e]:arguments)})}),e=null}).promise()},promise:function(e){return null!=e?f.extend(e,r):r}},i={};return r.pipe=r.then,f.each(t,function(e,o){var a=o[2],s=o[3];r[o[1]]=a.add,s&&a.add(function(){n=s},t[1^e][2].disable,t[2][2].lock),i[o[0]]=function(){return i[o[0]+"With"](this===i?r:this,arguments),this},i[o[0]+"With"]=a.fireWith}),r.promise(i),e&&e.call(i,i),i},when:function(e){var t,n,i,o=0,a=r.call(arguments),s=a.length,l=1!==s||e&&f.isFunction(e.promise)?s:0,u=1===l?e:f.Deferred(),c=function(e,n,i){return function(o){n[e]=this,i[e]=arguments.length>1?r.call(arguments):o,i===t?u.notifyWith(n,i):--l||u.resolveWith(n,i)}};if(s>1)for(t=new Array(s),n=new Array(s),i=new Array(s);s>o;o++)a[o]&&f.isFunction(a[o].promise)?a[o].promise().done(c(o,i,a)).fail(u.reject).progress(c(o,n,t)):--l;return l||u.resolveWith(i,a),u.promise()}}),f.fn.ready=function(e){return f.ready.promise().done(e),this},f.extend({isReady:!1,readyWait:1,holdReady:function(e){e?f.readyWait++:f.ready(!0)},ready:function(e){if(!0===e?!--f.readyWait:!f.isReady){if(!N.body)return setTimeout(f.ready);f.isReady=!0,!0!==e&&--f.readyWait>0||(D.resolveWith(N,[f]),f.fn.triggerHandler&&(f(N).triggerHandler("ready"),f(N).off("ready")))}}}),f.ready.promise=function(t){if(!D)if(D=f.Deferred(),"complete"===N.readyState)setTimeout(f.ready);else if(N.addEventListener)N.addEventListener("DOMContentLoaded",q,!1),e.addEventListener("load",q,!1);else{N.attachEvent("onreadystatechange",q),e.attachEvent("onload",q);var n=!1;try{n=null==e.frameElement&&N.documentElement}catch(e){}n&&n.doScroll&&function e(){if(!f.isReady){try{n.doScroll("left")}catch(t){return setTimeout(e,50)}H(),f.ready()}}()}return D.promise(t)};var _,M="undefined";for(_ in f(c))break;c.ownLast="0"!==_,c.inlineBlockNeedsLayout=!1,f(function(){var e,t,n,r;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",c.inlineBlockNeedsLayout=e=3===t.offsetWidth,e&&(n.style.zoom=1)),n.removeChild(r))}),function(){var e=N.createElement("div");if(null==c.deleteExpando){c.deleteExpando=!0;try{delete e.test}catch(e){c.deleteExpando=!1}}e=null}(),f.acceptData=function(e){var t=f.noData[(e.nodeName+" ").toLowerCase()],n=+e.nodeType||1;return(1===n||9===n)&&(!t||!0!==t&&e.getAttribute("classid")===t)};var F=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,O=/([A-Z])/g;function B(e,t,n){if(void 0===n&&1===e.nodeType){var r="data-"+t.replace(O,"-$1").toLowerCase();if("string"==typeof(n=e.getAttribute(r))){try{n="true"===n||"false"!==n&&("null"===n?null:+n+""===n?+n:F.test(n)?f.parseJSON(n):n)}catch(e){}f.data(e,t,n)}else n=void 0}return n}function P(e){var t;for(t in e)if(("data"!==t||!f.isEmptyObject(e[t]))&&"toJSON"!==t)return!1;return!0}function R(e,t,r,i){if(f.acceptData(e)){var o,a,s=f.expando,l=e.nodeType,u=l?f.cache:e,c=l?e[s]:e[s]&&s;if(c&&u[c]&&(i||u[c].data)||void 0!==r||"string"!=typeof t)return c||(c=l?e[s]=n.pop()||f.guid++:s),u[c]||(u[c]=l?{}:{toJSON:f.noop}),("object"==typeof t||"function"==typeof t)&&(i?u[c]=f.extend(u[c],t):u[c].data=f.extend(u[c].data,t)),a=u[c],i||(a.data||(a.data={}),a=a.data),void 0!==r&&(a[f.camelCase(t)]=r),"string"==typeof t?null==(o=a[t])&&(o=a[f.camelCase(t)]):o=a,o}}function W(e,t,n){if(f.acceptData(e)){var r,i,o=e.nodeType,a=o?f.cache:e,s=o?e[f.expando]:f.expando;if(a[s]){if(t&&(r=n?a[s]:a[s].data)){f.isArray(t)?t=t.concat(f.map(t,f.camelCase)):t in r?t=[t]:t=(t=f.camelCase(t))in r?[t]:t.split(" "),i=t.length;for(;i--;)delete r[t[i]];if(n?!P(r):!f.isEmptyObject(r))return}(n||(delete a[s].data,P(a[s])))&&(o?f.cleanData([e],!0):c.deleteExpando||a!=a.window?delete a[s]:a[s]=null)}}}f.extend({cache:{},noData:{"applet ":!0,"embed ":!0,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(e){return!!(e=e.nodeType?f.cache[e[f.expando]]:e[f.expando])&&!P(e)},data:function(e,t,n){return R(e,t,n)},removeData:function(e,t){return W(e,t)},_data:function(e,t,n){return R(e,t,n,!0)},_removeData:function(e,t){return W(e,t,!0)}}),f.fn.extend({data:function(e,t){var n,r,i,o=this[0],a=o&&o.attributes;if(void 0===e){if(this.length&&(i=f.data(o),1===o.nodeType&&!f._data(o,"parsedAttrs"))){for(n=a.length;n--;)a[n]&&(0===(r=a[n].name).indexOf("data-")&&B(o,r=f.camelCase(r.slice(5)),i[r]));f._data(o,"parsedAttrs",!0)}return i}return"object"==typeof e?this.each(function(){f.data(this,e)}):arguments.length>1?this.each(function(){f.data(this,e,t)}):o?B(o,e,f.data(o,e)):void 0},removeData:function(e){return this.each(function(){f.removeData(this,e)})}}),f.extend({queue:function(e,t,n){var r;return e?(t=(t||"fx")+"queue",r=f._data(e,t),n&&(!r||f.isArray(n)?r=f._data(e,t,f.makeArray(n)):r.push(n)),r||[]):void 0},dequeue:function(e,t){t=t||"fx";var n=f.queue(e,t),r=n.length,i=n.shift(),o=f._queueHooks(e,t);"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,function(){f.dequeue(e,t)},o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return f._data(e,n)||f._data(e,n,{empty:f.Callbacks("once memory").add(function(){f._removeData(e,t+"queue"),f._removeData(e,n)})})}}),f.fn.extend({queue:function(e,t){var n=2;return"string"!=typeof e&&(t=e,e="fx",n--),arguments.length<n?f.queue(this[0],e):void 0===t?this:this.each(function(){var n=f.queue(this,e,t);f._queueHooks(this,e),"fx"===e&&"inprogress"!==n[0]&&f.dequeue(this,e)})},dequeue:function(e){return this.each(function(){f.dequeue(this,e)})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,t){var n,r=1,i=f.Deferred(),o=this,a=this.length,s=function(){--r||i.resolveWith(o,[o])};for("string"!=typeof e&&(t=e,e=void 0),e=e||"fx";a--;)(n=f._data(o[a],e+"queueHooks"))&&n.empty&&(r++,n.empty.add(s));return s(),i.promise(t)}});var $=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,z=["Top","Right","Bottom","Left"],I=function(e,t){return e=t||e,"none"===f.css(e,"display")||!f.contains(e.ownerDocument,e)},X=f.access=function(e,t,n,r,i,o,a){var s=0,l=e.length,u=null==n;if("object"===f.type(n))for(s in i=!0,n)f.access(e,t,s,n[s],!0,o,a);else if(void 0!==r&&(i=!0,f.isFunction(r)||(a=!0),u&&(a?(t.call(e,r),t=null):(u=t,t=function(e,t,n){return u.call(f(e),n)})),t))for(;l>s;s++)t(e[s],n,a?r:r.call(e[s],s,t(e[s],n)));return i?e:u?t.call(e):l?t(e[0],n):o},U=/^(?:checkbox|radio)$/i;!function(){var e=N.createElement("input"),t=N.createElement("div"),n=N.createDocumentFragment();if(t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",c.leadingWhitespace=3===t.firstChild.nodeType,c.tbody=!t.getElementsByTagName("tbody").length,c.htmlSerialize=!!t.getElementsByTagName("link").length,c.html5Clone="<:nav></:nav>"!==N.createElement("nav").cloneNode(!0).outerHTML,e.type="checkbox",e.checked=!0,n.appendChild(e),c.appendChecked=e.checked,t.innerHTML="<textarea>x</textarea>",c.noCloneChecked=!!t.cloneNode(!0).lastChild.defaultValue,n.appendChild(t),t.innerHTML="<input type='radio' checked='checked' name='t'/>",c.checkClone=t.cloneNode(!0).cloneNode(!0).lastChild.checked,c.noCloneEvent=!0,t.attachEvent&&(t.attachEvent("onclick",function(){c.noCloneEvent=!1}),t.cloneNode(!0).click()),null==c.deleteExpando){c.deleteExpando=!0;try{delete t.test}catch(e){c.deleteExpando=!1}}}(),function(){var t,n,r=N.createElement("div");for(t in{submit:!0,change:!0,focusin:!0})n="on"+t,(c[t+"Bubbles"]=n in e)||(r.setAttribute(n,"t"),c[t+"Bubbles"]=!1===r.attributes[n].expando);r=null}();var V=/^(?:input|select|textarea)$/i,J=/^key/,Y=/^(?:mouse|pointer|contextmenu)|click/,G=/^(?:focusinfocus|focusoutblur)$/,Q=/^([^.]*)(?:\.(.+)|)$/;function K(){return!0}function Z(){return!1}function ee(){try{return N.activeElement}catch(e){}}function te(e){var t=ne.split("|"),n=e.createDocumentFragment();if(n.createElement)for(;t.length;)n.createElement(t.pop());return n}f.event={global:{},add:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f._data(e);if(v){for(n.handler&&(n=(l=n).handler,i=l.selector),n.guid||(n.guid=f.guid++),(a=v.events)||(a=v.events={}),(c=v.handle)||((c=v.handle=function(e){return typeof f===M||e&&f.event.triggered===e.type?void 0:f.event.dispatch.apply(c.elem,arguments)}).elem=e),s=(t=(t||"").match(j)||[""]).length;s--;)h=g=(o=Q.exec(t[s])||[])[1],m=(o[2]||"").split(".").sort(),h&&(u=f.event.special[h]||{},h=(i?u.delegateType:u.bindType)||h,u=f.event.special[h]||{},d=f.extend({type:h,origType:g,data:r,handler:n,guid:n.guid,selector:i,needsContext:i&&f.expr.match.needsContext.test(i),namespace:m.join(".")},l),(p=a[h])||((p=a[h]=[]).delegateCount=0,u.setup&&!1!==u.setup.call(e,r,m,c)||(e.addEventListener?e.addEventListener(h,c,!1):e.attachEvent&&e.attachEvent("on"+h,c))),u.add&&(u.add.call(e,d),d.handler.guid||(d.handler.guid=n.guid)),i?p.splice(p.delegateCount++,0,d):p.push(d),f.event.global[h]=!0);e=null}},remove:function(e,t,n,r,i){var o,a,s,l,u,c,d,p,h,m,g,v=f.hasData(e)&&f._data(e);if(v&&(c=v.events)){for(u=(t=(t||"").match(j)||[""]).length;u--;)if(h=g=(s=Q.exec(t[u])||[])[1],m=(s[2]||"").split(".").sort(),h){for(d=f.event.special[h]||{},p=c[h=(r?d.delegateType:d.bindType)||h]||[],s=s[2]&&new RegExp("(^|\\.)"+m.join("\\.(?:.*\\.|)")+"(\\.|$)"),l=o=p.length;o--;)a=p[o],!i&&g!==a.origType||n&&n.guid!==a.guid||s&&!s.test(a.namespace)||r&&r!==a.selector&&("**"!==r||!a.selector)||(p.splice(o,1),a.selector&&p.delegateCount--,d.remove&&d.remove.call(e,a));l&&!p.length&&(d.teardown&&!1!==d.teardown.call(e,m,v.handle)||f.removeEvent(e,h,v.handle),delete c[h])}else for(h in c)f.event.remove(e,h+t[u],n,r,!0);f.isEmptyObject(c)&&(delete v.handle,f._removeData(e,"events"))}},trigger:function(t,n,r,i){var o,a,s,l,c,d,p,h=[r||N],m=u.call(t,"type")?t.type:t,g=u.call(t,"namespace")?t.namespace.split("."):[];if(s=d=r=r||N,3!==r.nodeType&&8!==r.nodeType&&!G.test(m+f.event.triggered)&&(m.indexOf(".")>=0&&(g=m.split("."),m=g.shift(),g.sort()),a=m.indexOf(":")<0&&"on"+m,(t=t[f.expando]?t:new f.Event(m,"object"==typeof t&&t)).isTrigger=i?2:3,t.namespace=g.join("."),t.namespace_re=t.namespace?new RegExp("(^|\\.)"+g.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,t.result=void 0,t.target||(t.target=r),n=null==n?[t]:f.makeArray(n,[t]),c=f.event.special[m]||{},i||!c.trigger||!1!==c.trigger.apply(r,n))){if(!i&&!c.noBubble&&!f.isWindow(r)){for(l=c.delegateType||m,G.test(l+m)||(s=s.parentNode);s;s=s.parentNode)h.push(s),d=s;d===(r.ownerDocument||N)&&h.push(d.defaultView||d.parentWindow||e)}for(p=0;(s=h[p++])&&!t.isPropagationStopped();)t.type=p>1?l:c.bindType||m,(o=(f._data(s,"events")||{})[t.type]&&f._data(s,"handle"))&&o.apply(s,n),(o=a&&s[a])&&o.apply&&f.acceptData(s)&&(t.result=o.apply(s,n),!1===t.result&&t.preventDefault());if(t.type=m,!i&&!t.isDefaultPrevented()&&(!c._default||!1===c._default.apply(h.pop(),n))&&f.acceptData(r)&&a&&r[m]&&!f.isWindow(r)){(d=r[a])&&(r[a]=null),f.event.triggered=m;try{r[m]()}catch(e){}f.event.triggered=void 0,d&&(r[a]=d)}return t.result}},dispatch:function(e){e=f.event.fix(e);var t,n,i,o,a,s=[],l=r.call(arguments),u=(f._data(this,"events")||{})[e.type]||[],c=f.event.special[e.type]||{};if(l[0]=e,e.delegateTarget=this,!c.preDispatch||!1!==c.preDispatch.call(this,e)){for(s=f.event.handlers.call(this,e,u),t=0;(o=s[t++])&&!e.isPropagationStopped();)for(e.currentTarget=o.elem,a=0;(i=o.handlers[a++])&&!e.isImmediatePropagationStopped();)(!e.namespace_re||e.namespace_re.test(i.namespace))&&(e.handleObj=i,e.data=i.data,void 0!==(n=((f.event.special[i.origType]||{}).handle||i.handler).apply(o.elem,l))&&!1===(e.result=n)&&(e.preventDefault(),e.stopPropagation()));return c.postDispatch&&c.postDispatch.call(this,e),e.result}},handlers:function(e,t){var n,r,i,o,a=[],s=t.delegateCount,l=e.target;if(s&&l.nodeType&&(!e.button||"click"!==e.type))for(;l!=this;l=l.parentNode||this)if(1===l.nodeType&&(!0!==l.disabled||"click"!==e.type)){for(i=[],o=0;s>o;o++)void 0===i[n=(r=t[o]).selector+" "]&&(i[n]=r.needsContext?f(n,this).index(l)>=0:f.find(n,this,null,[l]).length),i[n]&&i.push(r);i.length&&a.push({elem:l,handlers:i})}return s<t.length&&a.push({elem:this,handlers:t.slice(s)}),a},fix:function(e){if(e[f.expando])return e;var t,n,r,i=e.type,o=e,a=this.fixHooks[i];for(a||(this.fixHooks[i]=a=Y.test(i)?this.mouseHooks:J.test(i)?this.keyHooks:{}),r=a.props?this.props.concat(a.props):this.props,e=new f.Event(o),t=r.length;t--;)e[n=r[t]]=o[n];return e.target||(e.target=o.srcElement||N),3===e.target.nodeType&&(e.target=e.target.parentNode),e.metaKey=!!e.metaKey,a.filter?a.filter(e,o):e},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(e,t){return null==e.which&&(e.which=null!=t.charCode?t.charCode:t.keyCode),e}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(e,t){var n,r,i,o=t.button,a=t.fromElement;return null==e.pageX&&null!=t.clientX&&(i=(r=e.target.ownerDocument||N).documentElement,n=r.body,e.pageX=t.clientX+(i&&i.scrollLeft||n&&n.scrollLeft||0)-(i&&i.clientLeft||n&&n.clientLeft||0),e.pageY=t.clientY+(i&&i.scrollTop||n&&n.scrollTop||0)-(i&&i.clientTop||n&&n.clientTop||0)),!e.relatedTarget&&a&&(e.relatedTarget=a===e.target?t.toElement:a),e.which||void 0===o||(e.which=1&o?1:2&o?3:4&o?2:0),e}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==ee()&&this.focus)try{return this.focus(),!1}catch(e){}},delegateType:"focusin"},blur:{trigger:function(){return this===ee()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return f.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):void 0},_default:function(e){return f.nodeName(e.target,"a")}},beforeunload:{postDispatch:function(e){void 0!==e.result&&e.originalEvent&&(e.originalEvent.returnValue=e.result)}}},simulate:function(e,t,n,r){var i=f.extend(new f.Event,n,{type:e,isSimulated:!0,originalEvent:{}});r?f.event.trigger(i,null,t):f.event.dispatch.call(t,i),i.isDefaultPrevented()&&n.preventDefault()}},f.removeEvent=N.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var r="on"+t;e.detachEvent&&(typeof e[r]===M&&(e[r]=null),e.detachEvent(r,n))},f.Event=function(e,t){return this instanceof f.Event?(e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||void 0===e.defaultPrevented&&!1===e.returnValue?K:Z):this.type=e,t&&f.extend(this,t),this.timeStamp=e&&e.timeStamp||f.now(),void(this[f.expando]=!0)):new f.Event(e,t)},f.Event.prototype={isDefaultPrevented:Z,isPropagationStopped:Z,isImmediatePropagationStopped:Z,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=K,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=K,e&&(e.stopPropagation&&e.stopPropagation(),e.cancelBubble=!0)},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=K,e&&e.stopImmediatePropagation&&e.stopImmediatePropagation(),this.stopPropagation()}},f.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(e,t){f.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,r=e.relatedTarget,i=e.handleObj;return(!r||r!==this&&!f.contains(this,r))&&(e.type=i.origType,n=i.handler.apply(this,arguments),e.type=t),n}}}),c.submitBubbles||(f.event.special.submit={setup:function(){return!f.nodeName(this,"form")&&void f.event.add(this,"click._submit keypress._submit",function(e){var t=e.target,n=f.nodeName(t,"input")||f.nodeName(t,"button")?t.form:void 0;n&&!f._data(n,"submitBubbles")&&(f.event.add(n,"submit._submit",function(e){e._submit_bubble=!0}),f._data(n,"submitBubbles",!0))})},postDispatch:function(e){e._submit_bubble&&(delete e._submit_bubble,this.parentNode&&!e.isTrigger&&f.event.simulate("submit",this.parentNode,e,!0))},teardown:function(){return!f.nodeName(this,"form")&&void f.event.remove(this,"._submit")}}),c.changeBubbles||(f.event.special.change={setup:function(){return V.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(f.event.add(this,"propertychange._change",function(e){"checked"===e.originalEvent.propertyName&&(this._just_changed=!0)}),f.event.add(this,"click._change",function(e){this._just_changed&&!e.isTrigger&&(this._just_changed=!1),f.event.simulate("change",this,e,!0)})),!1):void f.event.add(this,"beforeactivate._change",function(e){var t=e.target;V.test(t.nodeName)&&!f._data(t,"changeBubbles")&&(f.event.add(t,"change._change",function(e){!this.parentNode||e.isSimulated||e.isTrigger||f.event.simulate("change",this.parentNode,e,!0)}),f._data(t,"changeBubbles",!0))})},handle:function(e){var t=e.target;return this!==t||e.isSimulated||e.isTrigger||"radio"!==t.type&&"checkbox"!==t.type?e.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return f.event.remove(this,"._change"),!V.test(this.nodeName)}}),c.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(e,t){var n=function(e){f.event.simulate(t,e.target,f.event.fix(e),!0)};f.event.special[t]={setup:function(){var r=this.ownerDocument||this,i=f._data(r,t);i||r.addEventListener(e,n,!0),f._data(r,t,(i||0)+1)},teardown:function(){var r=this.ownerDocument||this,i=f._data(r,t)-1;i?f._data(r,t,i):(r.removeEventListener(e,n,!0),f._removeData(r,t))}}}),f.fn.extend({on:function(e,t,n,r,i){var o,a;if("object"==typeof e){for(o in"string"!=typeof t&&(n=n||t,t=void 0),e)this.on(o,t,n,e[o],i);return this}if(null==n&&null==r?(r=t,n=t=void 0):null==r&&("string"==typeof t?(r=n,n=void 0):(r=n,n=t,t=void 0)),!1===r)r=Z;else if(!r)return this;return 1===i&&(a=r,(r=function(e){return f().off(e),a.apply(this,arguments)}).guid=a.guid||(a.guid=f.guid++)),this.each(function(){f.event.add(this,e,r,n,t)})},one:function(e,t,n,r){return this.on(e,t,n,r,1)},off:function(e,t,n){var r,i;if(e&&e.preventDefault&&e.handleObj)return r=e.handleObj,f(e.delegateTarget).off(r.namespace?r.origType+"."+r.namespace:r.origType,r.selector,r.handler),this;if("object"==typeof e){for(i in e)this.off(i,t,e[i]);return this}return(!1===t||"function"==typeof t)&&(n=t,t=void 0),!1===n&&(n=Z),this.each(function(){f.event.remove(this,e,n,t)})},trigger:function(e,t){return this.each(function(){f.event.trigger(e,t,this)})},triggerHandler:function(e,t){var n=this[0];return n?f.event.trigger(e,t,n,!0):void 0}});var ne="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",re=/ jQuery\d+="(?:null|\d+)"/g,ie=new RegExp("<(?:"+ne+")[\\s/>]","i"),oe=/^\s+/,ae=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,se=/<([\w:]+)/,le=/<tbody/i,ue=/<|&#?\w+;/,ce=/<(?:script|style|link)/i,de=/checked\s*(?:[^=]|=\s*.checked.)/i,fe=/^$|\/(?:java|ecma)script/i,pe=/^true\/(.*)/,he=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,me={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:c.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},ge=te(N).appendChild(N.createElement("div"));function ve(e,t){var n,r,i=0,o=typeof e.getElementsByTagName!==M?e.getElementsByTagName(t||"*"):typeof e.querySelectorAll!==M?e.querySelectorAll(t||"*"):void 0;if(!o)for(o=[],n=e.childNodes||e;null!=(r=n[i]);i++)!t||f.nodeName(r,t)?o.push(r):f.merge(o,ve(r,t));return void 0===t||t&&f.nodeName(e,t)?f.merge([e],o):o}function ye(e){U.test(e.type)&&(e.defaultChecked=e.checked)}function be(e,t){return f.nodeName(e,"table")&&f.nodeName(11!==t.nodeType?t:t.firstChild,"tr")?e.getElementsByTagName("tbody")[0]||e.appendChild(e.ownerDocument.createElement("tbody")):e}function xe(e){return e.type=(null!==f.find.attr(e,"type"))+"/"+e.type,e}function we(e){var t=pe.exec(e.type);return t?e.type=t[1]:e.removeAttribute("type"),e}function Te(e,t){for(var n,r=0;null!=(n=e[r]);r++)f._data(n,"globalEval",!t||f._data(t[r],"globalEval"))}function Ce(e,t){if(1===t.nodeType&&f.hasData(e)){var n,r,i,o=f._data(e),a=f._data(t,o),s=o.events;if(s)for(n in delete a.handle,a.events={},s)for(r=0,i=s[n].length;i>r;r++)f.event.add(t,n,s[n][r]);a.data&&(a.data=f.extend({},a.data))}}function Ne(e,t){var n,r,i;if(1===t.nodeType){if(n=t.nodeName.toLowerCase(),!c.noCloneEvent&&t[f.expando]){for(r in(i=f._data(t)).events)f.removeEvent(t,r,i.handle);t.removeAttribute(f.expando)}"script"===n&&t.text!==e.text?(xe(t).text=e.text,we(t)):"object"===n?(t.parentNode&&(t.outerHTML=e.outerHTML),c.html5Clone&&e.innerHTML&&!f.trim(t.innerHTML)&&(t.innerHTML=e.innerHTML)):"input"===n&&U.test(e.type)?(t.defaultChecked=t.checked=e.checked,t.value!==e.value&&(t.value=e.value)):"option"===n?t.defaultSelected=t.selected=e.defaultSelected:("input"===n||"textarea"===n)&&(t.defaultValue=e.defaultValue)}}me.optgroup=me.option,me.tbody=me.tfoot=me.colgroup=me.caption=me.thead,me.th=me.td,f.extend({clone:function(e,t,n){var r,i,o,a,s,l=f.contains(e.ownerDocument,e);if(c.html5Clone||f.isXMLDoc(e)||!ie.test("<"+e.nodeName+">")?o=e.cloneNode(!0):(ge.innerHTML=e.outerHTML,ge.removeChild(o=ge.firstChild)),!(c.noCloneEvent&&c.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||f.isXMLDoc(e)))for(r=ve(o),s=ve(e),a=0;null!=(i=s[a]);++a)r[a]&&Ne(i,r[a]);if(t)if(n)for(s=s||ve(e),r=r||ve(o),a=0;null!=(i=s[a]);a++)Ce(i,r[a]);else Ce(e,o);return(r=ve(o,"script")).length>0&&Te(r,!l&&ve(e,"script")),r=s=i=null,o},buildFragment:function(e,t,n,r){for(var i,o,a,s,l,u,d,p=e.length,h=te(t),m=[],g=0;p>g;g++)if((o=e[g])||0===o)if("object"===f.type(o))f.merge(m,o.nodeType?[o]:o);else if(ue.test(o)){for(s=s||h.appendChild(t.createElement("div")),l=(se.exec(o)||["",""])[1].toLowerCase(),d=me[l]||me._default,s.innerHTML=d[1]+o.replace(ae,"<$1></$2>")+d[2],i=d[0];i--;)s=s.lastChild;if(!c.leadingWhitespace&&oe.test(o)&&m.push(t.createTextNode(oe.exec(o)[0])),!c.tbody)for(i=(o="table"!==l||le.test(o)?"<table>"!==d[1]||le.test(o)?0:s:s.firstChild)&&o.childNodes.length;i--;)f.nodeName(u=o.childNodes[i],"tbody")&&!u.childNodes.length&&o.removeChild(u);for(f.merge(m,s.childNodes),s.textContent="";s.firstChild;)s.removeChild(s.firstChild);s=h.lastChild}else m.push(t.createTextNode(o));for(s&&h.removeChild(s),c.appendChecked||f.grep(ve(m,"input"),ye),g=0;o=m[g++];)if((!r||-1===f.inArray(o,r))&&(a=f.contains(o.ownerDocument,o),s=ve(h.appendChild(o),"script"),a&&Te(s),n))for(i=0;o=s[i++];)fe.test(o.type||"")&&n.push(o);return s=null,h},cleanData:function(e,t){for(var r,i,o,a,s=0,l=f.expando,u=f.cache,d=c.deleteExpando,p=f.event.special;null!=(r=e[s]);s++)if((t||f.acceptData(r))&&(a=(o=r[l])&&u[o])){if(a.events)for(i in a.events)p[i]?f.event.remove(r,i):f.removeEvent(r,i,a.handle);u[o]&&(delete u[o],d?delete r[l]:typeof r.removeAttribute!==M?r.removeAttribute(l):r[l]=null,n.push(o))}}}),f.fn.extend({text:function(e){return X(this,function(e){return void 0===e?f.text(this):this.empty().append((this[0]&&this[0].ownerDocument||N).createTextNode(e))},null,e,arguments.length)},append:function(){return this.domManip(arguments,function(e){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||be(this,e).appendChild(e)})},prepend:function(){return this.domManip(arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=be(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this)})},after:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this.nextSibling)})},remove:function(e,t){for(var n,r=e?f.filter(e,this):this,i=0;null!=(n=r[i]);i++)t||1!==n.nodeType||f.cleanData(ve(n)),n.parentNode&&(t&&f.contains(n.ownerDocument,n)&&Te(ve(n,"script")),n.parentNode.removeChild(n));return this},empty:function(){for(var e,t=0;null!=(e=this[t]);t++){for(1===e.nodeType&&f.cleanData(ve(e,!1));e.firstChild;)e.removeChild(e.firstChild);e.options&&f.nodeName(e,"select")&&(e.options.length=0)}return this},clone:function(e,t){return e=null!=e&&e,t=null==t?e:t,this.map(function(){return f.clone(this,e,t)})},html:function(e){return X(this,function(e){var t=this[0]||{},n=0,r=this.length;if(void 0===e)return 1===t.nodeType?t.innerHTML.replace(re,""):void 0;if(!("string"!=typeof e||ce.test(e)||!c.htmlSerialize&&ie.test(e)||!c.leadingWhitespace&&oe.test(e)||me[(se.exec(e)||["",""])[1].toLowerCase()])){e=e.replace(ae,"<$1></$2>");try{for(;r>n;n++)1===(t=this[n]||{}).nodeType&&(f.cleanData(ve(t,!1)),t.innerHTML=e);t=0}catch(e){}}t&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(){var e=arguments[0];return this.domManip(arguments,function(t){e=this.parentNode,f.cleanData(ve(this)),e&&e.replaceChild(t,this)}),e&&(e.length||e.nodeType)?this:this.remove()},detach:function(e){return this.remove(e,!0)},domManip:function(e,t){e=i.apply([],e);var n,r,o,a,s,l,u=0,d=this.length,p=this,h=d-1,m=e[0],g=f.isFunction(m);if(g||d>1&&"string"==typeof m&&!c.checkClone&&de.test(m))return this.each(function(n){var r=p.eq(n);g&&(e[0]=m.call(this,n,r.html())),r.domManip(e,t)});if(d&&(n=(l=f.buildFragment(e,this[0].ownerDocument,!1,this)).firstChild,1===l.childNodes.length&&(l=n),n)){for(o=(a=f.map(ve(l,"script"),xe)).length;d>u;u++)r=l,u!==h&&(r=f.clone(r,!0,!0),o&&f.merge(a,ve(r,"script"))),t.call(this[u],r,u);if(o)for(s=a[a.length-1].ownerDocument,f.map(a,we),u=0;o>u;u++)r=a[u],fe.test(r.type||"")&&!f._data(r,"globalEval")&&f.contains(s,r)&&(r.src?f._evalUrl&&f._evalUrl(r.src):f.globalEval((r.text||r.textContent||r.innerHTML||"").replace(he,"")));l=n=null}return this}}),f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){f.fn[e]=function(e){for(var n,r=0,i=[],a=f(e),s=a.length-1;s>=r;r++)n=r===s?this:this.clone(!0),f(a[r])[t](n),o.apply(i,n.get());return this.pushStack(i)}});var Ee,ke={};function Se(t,n){var r,i=f(n.createElement(t)).appendTo(n.body),o=e.getDefaultComputedStyle&&(r=e.getDefaultComputedStyle(i[0]))?r.display:f.css(i[0],"display");return i.detach(),o}function Ae(e){var t=N,n=ke[e];return n||("none"!==(n=Se(e,t))&&n||((t=((Ee=(Ee||f("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement))[0].contentWindow||Ee[0].contentDocument).document).write(),t.close(),n=Se(e,t),Ee.detach()),ke[e]=n),n}!function(){var e;c.shrinkWrapBlocks=function(){return null!=e?e:(e=!1,(n=N.getElementsByTagName("body")[0])&&n.style?(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),typeof t.style.zoom!==M&&(t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",t.appendChild(N.createElement("div")).style.width="5px",e=3!==t.offsetWidth),n.removeChild(r),e):void 0);var t,n,r}}();var De,je,Le=/^margin/,He=new RegExp("^("+$+")(?!px)[a-z%]+$","i"),qe=/^(top|right|bottom|left)$/;function _e(e,t){return{get:function(){var n=e();if(null!=n)return n?void delete this.get:(this.get=t).apply(this,arguments)}}}e.getComputedStyle?(De=function(t){return t.ownerDocument.defaultView.opener?t.ownerDocument.defaultView.getComputedStyle(t,null):e.getComputedStyle(t,null)},je=function(e,t,n){var r,i,o,a,s=e.style;return a=(n=n||De(e))?n.getPropertyValue(t)||n[t]:void 0,n&&(""!==a||f.contains(e.ownerDocument,e)||(a=f.style(e,t)),He.test(a)&&Le.test(t)&&(r=s.width,i=s.minWidth,o=s.maxWidth,s.minWidth=s.maxWidth=s.width=a,a=n.width,s.width=r,s.minWidth=i,s.maxWidth=o)),void 0===a?a:a+""}):N.documentElement.currentStyle&&(De=function(e){return e.currentStyle},je=function(e,t,n){var r,i,o,a,s=e.style;return null==(a=(n=n||De(e))?n[t]:void 0)&&s&&s[t]&&(a=s[t]),He.test(a)&&!qe.test(t)&&(r=s.left,(o=(i=e.runtimeStyle)&&i.left)&&(i.left=e.currentStyle.left),s.left="fontSize"===t?"1em":a,a=s.pixelLeft+"px",s.left=r,o&&(i.left=o)),void 0===a?a:a+""||"auto"}),function(){var t,n,r,i,o,a,s;if((t=N.createElement("div")).innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",n=(r=t.getElementsByTagName("a")[0])&&r.style){function l(){var t,n,r,l;(n=N.getElementsByTagName("body")[0])&&n.style&&(t=N.createElement("div"),(r=N.createElement("div")).style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",n.appendChild(r).appendChild(t),t.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",i=o=!1,s=!0,e.getComputedStyle&&(i="1%"!==(e.getComputedStyle(t,null)||{}).top,o="4px"===(e.getComputedStyle(t,null)||{width:"4px"}).width,(l=t.appendChild(N.createElement("div"))).style.cssText=t.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",l.style.marginRight=l.style.width="0",t.style.width="1px",s=!parseFloat((e.getComputedStyle(l,null)||{}).marginRight),t.removeChild(l)),t.innerHTML="<table><tr><td></td><td>t</td></tr></table>",(l=t.getElementsByTagName("td"))[0].style.cssText="margin:0;border:0;padding:0;display:none",(a=0===l[0].offsetHeight)&&(l[0].style.display="",l[1].style.display="none",a=0===l[0].offsetHeight),n.removeChild(r))}n.cssText="float:left;opacity:.5",c.opacity="0.5"===n.opacity,c.cssFloat=!!n.cssFloat,t.style.backgroundClip="content-box",t.cloneNode(!0).style.backgroundClip="",c.clearCloneStyle="content-box"===t.style.backgroundClip,c.boxSizing=""===n.boxSizing||""===n.MozBoxSizing||""===n.WebkitBoxSizing,f.extend(c,{reliableHiddenOffsets:function(){return null==a&&l(),a},boxSizingReliable:function(){return null==o&&l(),o},pixelPosition:function(){return null==i&&l(),i},reliableMarginRight:function(){return null==s&&l(),s}})}}(),f.swap=function(e,t,n,r){var i,o,a={};for(o in t)a[o]=e.style[o],e.style[o]=t[o];for(o in i=n.apply(e,r||[]),t)e.style[o]=a[o];return i};var Me=/alpha\([^)]*\)/i,Fe=/opacity\s*=\s*([^)]*)/,Oe=/^(none|table(?!-c[ea]).+)/,Be=new RegExp("^("+$+")(.*)$","i"),Pe=new RegExp("^([+-])=("+$+")","i"),Re={position:"absolute",visibility:"hidden",display:"block"},We={letterSpacing:"0",fontWeight:"400"},$e=["Webkit","O","Moz","ms"];function ze(e,t){if(t in e)return t;for(var n=t.charAt(0).toUpperCase()+t.slice(1),r=t,i=$e.length;i--;)if((t=$e[i]+n)in e)return t;return r}function Ie(e,t){for(var n,r,i,o=[],a=0,s=e.length;s>a;a++)(r=e[a]).style&&(o[a]=f._data(r,"olddisplay"),n=r.style.display,t?(o[a]||"none"!==n||(r.style.display=""),""===r.style.display&&I(r)&&(o[a]=f._data(r,"olddisplay",Ae(r.nodeName)))):(i=I(r),(n&&"none"!==n||!i)&&f._data(r,"olddisplay",i?n:f.css(r,"display"))));for(a=0;s>a;a++)(r=e[a]).style&&(t&&"none"!==r.style.display&&""!==r.style.display||(r.style.display=t?o[a]||"":"none"));return e}function Xe(e,t,n){var r=Be.exec(t);return r?Math.max(0,r[1]-(n||0))+(r[2]||"px"):t}function Ue(e,t,n,r,i){for(var o=n===(r?"border":"content")?4:"width"===t?1:0,a=0;4>o;o+=2)"margin"===n&&(a+=f.css(e,n+z[o],!0,i)),r?("content"===n&&(a-=f.css(e,"padding"+z[o],!0,i)),"margin"!==n&&(a-=f.css(e,"border"+z[o]+"Width",!0,i))):(a+=f.css(e,"padding"+z[o],!0,i),"padding"!==n&&(a+=f.css(e,"border"+z[o]+"Width",!0,i)));return a}function Ve(e,t,n){var r=!0,i="width"===t?e.offsetWidth:e.offsetHeight,o=De(e),a=c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,o);if(0>=i||null==i){if((0>(i=je(e,t,o))||null==i)&&(i=e.style[t]),He.test(i))return i;r=a&&(c.boxSizingReliable()||i===e.style[t]),i=parseFloat(i)||0}return i+Ue(e,t,n||(a?"border":"content"),r,o)+"px"}function Je(e,t,n,r,i){return new Je.prototype.init(e,t,n,r,i)}f.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=je(e,"opacity");return""===n?"1":n}}}},cssNumber:{columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{float:c.cssFloat?"cssFloat":"styleFloat"},style:function(e,t,n,r){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var i,o,a,s=f.camelCase(t),l=e.style;if(t=f.cssProps[s]||(f.cssProps[s]=ze(l,s)),a=f.cssHooks[t]||f.cssHooks[s],void 0===n)return a&&"get"in a&&void 0!==(i=a.get(e,!1,r))?i:l[t];if("string"===(o=typeof n)&&(i=Pe.exec(n))&&(n=(i[1]+1)*i[2]+parseFloat(f.css(e,t)),o="number"),null!=n&&n==n&&("number"!==o||f.cssNumber[s]||(n+="px"),c.clearCloneStyle||""!==n||0!==t.indexOf("background")||(l[t]="inherit"),!(a&&"set"in a&&void 0===(n=a.set(e,n,r)))))try{l[t]=n}catch(e){}}},css:function(e,t,n,r){var i,o,a,s=f.camelCase(t);return t=f.cssProps[s]||(f.cssProps[s]=ze(e.style,s)),(a=f.cssHooks[t]||f.cssHooks[s])&&"get"in a&&(o=a.get(e,!0,n)),void 0===o&&(o=je(e,t,r)),"normal"===o&&t in We&&(o=We[t]),""===n||n?(i=parseFloat(o),!0===n||f.isNumeric(i)?i||0:o):o}}),f.each(["height","width"],function(e,t){f.cssHooks[t]={get:function(e,n,r){return n?Oe.test(f.css(e,"display"))&&0===e.offsetWidth?f.swap(e,Re,function(){return Ve(e,t,r)}):Ve(e,t,r):void 0},set:function(e,n,r){var i=r&&De(e);return Xe(0,n,r?Ue(e,t,r,c.boxSizing&&"border-box"===f.css(e,"boxSizing",!1,i),i):0)}}}),c.opacity||(f.cssHooks.opacity={get:function(e,t){return Fe.test((t&&e.currentStyle?e.currentStyle.filter:e.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""},set:function(e,t){var n=e.style,r=e.currentStyle,i=f.isNumeric(t)?"alpha(opacity="+100*t+")":"",o=r&&r.filter||n.filter||"";n.zoom=1,(t>=1||""===t)&&""===f.trim(o.replace(Me,""))&&n.removeAttribute&&(n.removeAttribute("filter"),""===t||r&&!r.filter)||(n.filter=Me.test(o)?o.replace(Me,i):o+" "+i)}}),f.cssHooks.marginRight=_e(c.reliableMarginRight,function(e,t){return t?f.swap(e,{display:"inline-block"},je,[e,"marginRight"]):void 0}),f.each({margin:"",padding:"",border:"Width"},function(e,t){f.cssHooks[e+t]={expand:function(n){for(var r=0,i={},o="string"==typeof n?n.split(" "):[n];4>r;r++)i[e+z[r]+t]=o[r]||o[r-2]||o[0];return i}},Le.test(e)||(f.cssHooks[e+t].set=Xe)}),f.fn.extend({css:function(e,t){return X(this,function(e,t,n){var r,i,o={},a=0;if(f.isArray(t)){for(r=De(e),i=t.length;i>a;a++)o[t[a]]=f.css(e,t[a],!1,r);return o}return void 0!==n?f.style(e,t,n):f.css(e,t)},e,t,arguments.length>1)},show:function(){return Ie(this,!0)},hide:function(){return Ie(this)},toggle:function(e){return"boolean"==typeof e?e?this.show():this.hide():this.each(function(){I(this)?f(this).show():f(this).hide()})}}),f.Tween=Je,Je.prototype={constructor:Je,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||"swing",this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(f.cssNumber[n]?"":"px")},cur:function(){var e=Je.propHooks[this.prop];return e&&e.get?e.get(this):Je.propHooks._default.get(this)},run:function(e){var t,n=Je.propHooks[this.prop];return this.pos=t=this.options.duration?f.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):Je.propHooks._default.set(this),this}},Je.prototype.init.prototype=Je.prototype,Je.propHooks={_default:{get:function(e){var t;return null==e.elem[e.prop]||e.elem.style&&null!=e.elem.style[e.prop]?(t=f.css(e.elem,e.prop,""))&&"auto"!==t?t:0:e.elem[e.prop]},set:function(e){f.fx.step[e.prop]?f.fx.step[e.prop](e):e.elem.style&&(null!=e.elem.style[f.cssProps[e.prop]]||f.cssHooks[e.prop])?f.style(e.elem,e.prop,e.now+e.unit):e.elem[e.prop]=e.now}}},Je.propHooks.scrollTop=Je.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},f.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2}},f.fx=Je.prototype.init,f.fx.step={};var Ye,Ge,Qe=/^(?:toggle|show|hide)$/,Ke=new RegExp("^(?:([+-])=|)("+$+")([a-z%]*)$","i"),Ze=/queueHooks$/,et=[function(e,t,n){var r,i,o,a,s,l,u,d=this,p={},h=e.style,m=e.nodeType&&I(e),g=f._data(e,"fxshow");for(r in n.queue||(null==(s=f._queueHooks(e,"fx")).unqueued&&(s.unqueued=0,l=s.empty.fire,s.empty.fire=function(){s.unqueued||l()}),s.unqueued++,d.always(function(){d.always(function(){s.unqueued--,f.queue(e,"fx").length||s.empty.fire()})})),1===e.nodeType&&("height"in t||"width"in t)&&(n.overflow=[h.overflow,h.overflowX,h.overflowY],u=f.css(e,"display"),"inline"===("none"===u?f._data(e,"olddisplay")||Ae(e.nodeName):u)&&"none"===f.css(e,"float")&&(c.inlineBlockNeedsLayout&&"inline"!==Ae(e.nodeName)?h.zoom=1:h.display="inline-block")),n.overflow&&(h.overflow="hidden",c.shrinkWrapBlocks()||d.always(function(){h.overflow=n.overflow[0],h.overflowX=n.overflow[1],h.overflowY=n.overflow[2]})),t)if(i=t[r],Qe.exec(i)){if(delete t[r],o=o||"toggle"===i,i===(m?"hide":"show")){if("show"!==i||!g||void 0===g[r])continue;m=!0}p[r]=g&&g[r]||f.style(e,r)}else u=void 0;if(f.isEmptyObject(p))"inline"===("none"===u?Ae(e.nodeName):u)&&(h.display=u);else for(r in g?"hidden"in g&&(m=g.hidden):g=f._data(e,"fxshow",{}),o&&(g.hidden=!m),m?f(e).show():d.done(function(){f(e).hide()}),d.done(function(){var t;for(t in f._removeData(e,"fxshow"),p)f.style(e,t,p[t])}),p)a=it(m?g[r]:0,r,d),r in g||(g[r]=a.start,m&&(a.end=a.start,a.start="width"===r||"height"===r?1:0))}],tt={"*":[function(e,t){var n=this.createTween(e,t),r=n.cur(),i=Ke.exec(t),o=i&&i[3]||(f.cssNumber[e]?"":"px"),a=(f.cssNumber[e]||"px"!==o&&+r)&&Ke.exec(f.css(n.elem,e)),s=1,l=20;if(a&&a[3]!==o){o=o||a[3],i=i||[],a=+r||1;do{a/=s=s||".5",f.style(n.elem,e,a+o)}while(s!==(s=n.cur()/r)&&1!==s&&--l)}return i&&(a=n.start=+a||+r||0,n.unit=o,n.end=i[1]?a+(i[1]+1)*i[2]:+i[2]),n}]};function nt(){return setTimeout(function(){Ye=void 0}),Ye=f.now()}function rt(e,t){var n,r={height:e},i=0;for(t=t?1:0;4>i;i+=2-t)r["margin"+(n=z[i])]=r["padding"+n]=e;return t&&(r.opacity=r.width=e),r}function it(e,t,n){for(var r,i=(tt[t]||[]).concat(tt["*"]),o=0,a=i.length;a>o;o++)if(r=i[o].call(n,t,e))return r}function ot(e,t,n){var r,i,o=0,a=et.length,s=f.Deferred().always(function(){delete l.elem}),l=function(){if(i)return!1;for(var t=Ye||nt(),n=Math.max(0,u.startTime+u.duration-t),r=1-(n/u.duration||0),o=0,a=u.tweens.length;a>o;o++)u.tweens[o].run(r);return s.notifyWith(e,[u,r,n]),1>r&&a?n:(s.resolveWith(e,[u]),!1)},u=s.promise({elem:e,props:f.extend({},t),opts:f.extend(!0,{specialEasing:{}},n),originalProperties:t,originalOptions:n,startTime:Ye||nt(),duration:n.duration,tweens:[],createTween:function(t,n){var r=f.Tween(e,u.opts,t,n,u.opts.specialEasing[t]||u.opts.easing);return u.tweens.push(r),r},stop:function(t){var n=0,r=t?u.tweens.length:0;if(i)return this;for(i=!0;r>n;n++)u.tweens[n].run(1);return t?s.resolveWith(e,[u,t]):s.rejectWith(e,[u,t]),this}}),c=u.props;for(function(e,t){var n,r,i,o,a;for(n in e)if(i=t[r=f.camelCase(n)],o=e[n],f.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),(a=f.cssHooks[r])&&"expand"in a)for(n in o=a.expand(o),delete e[r],o)n in e||(e[n]=o[n],t[n]=i);else t[r]=i}(c,u.opts.specialEasing);a>o;o++)if(r=et[o].call(u,e,c,u.opts))return r;return f.map(c,it,u),f.isFunction(u.opts.start)&&u.opts.start.call(e,u),f.fx.timer(f.extend(l,{elem:e,anim:u,queue:u.opts.queue})),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)}f.Animation=f.extend(ot,{tweener:function(e,t){f.isFunction(e)?(t=e,e=["*"]):e=e.split(" ");for(var n,r=0,i=e.length;i>r;r++)n=e[r],tt[n]=tt[n]||[],tt[n].unshift(t)},prefilter:function(e,t){t?et.unshift(e):et.push(e)}}),f.speed=function(e,t,n){var r=e&&"object"==typeof e?f.extend({},e):{complete:n||!n&&t||f.isFunction(e)&&e,duration:e,easing:n&&t||t&&!f.isFunction(t)&&t};return r.duration=f.fx.off?0:"number"==typeof r.duration?r.duration:r.duration in f.fx.speeds?f.fx.speeds[r.duration]:f.fx.speeds._default,(null==r.queue||!0===r.queue)&&(r.queue="fx"),r.old=r.complete,r.complete=function(){f.isFunction(r.old)&&r.old.call(this),r.queue&&f.dequeue(this,r.queue)},r},f.fn.extend({fadeTo:function(e,t,n,r){return this.filter(I).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(e,t,n,r){var i=f.isEmptyObject(e),o=f.speed(t,n,r),a=function(){var t=ot(this,f.extend({},e),o);(i||f._data(this,"finish"))&&t.stop(!0)};return a.finish=a,i||!1===o.queue?this.each(a):this.queue(o.queue,a)},stop:function(e,t,n){var r=function(e){var t=e.stop;delete e.stop,t(n)};return"string"!=typeof e&&(n=t,t=e,e=void 0),t&&!1!==e&&this.queue(e||"fx",[]),this.each(function(){var t=!0,i=null!=e&&e+"queueHooks",o=f.timers,a=f._data(this);if(i)a[i]&&a[i].stop&&r(a[i]);else for(i in a)a[i]&&a[i].stop&&Ze.test(i)&&r(a[i]);for(i=o.length;i--;)o[i].elem!==this||null!=e&&o[i].queue!==e||(o[i].anim.stop(n),t=!1,o.splice(i,1));(t||!n)&&f.dequeue(this,e)})},finish:function(e){return!1!==e&&(e=e||"fx"),this.each(function(){var t,n=f._data(this),r=n[e+"queue"],i=n[e+"queueHooks"],o=f.timers,a=r?r.length:0;for(n.finish=!0,f.queue(this,e,[]),i&&i.stop&&i.stop.call(this,!0),t=o.length;t--;)o[t].elem===this&&o[t].queue===e&&(o[t].anim.stop(!0),o.splice(t,1));for(t=0;a>t;t++)r[t]&&r[t].finish&&r[t].finish.call(this);delete n.finish})}}),f.each(["toggle","show","hide"],function(e,t){var n=f.fn[t];f.fn[t]=function(e,r,i){return null==e||"boolean"==typeof e?n.apply(this,arguments):this.animate(rt(t,!0),e,r,i)}}),f.each({slideDown:rt("show"),slideUp:rt("hide"),slideToggle:rt("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){f.fn[e]=function(e,n,r){return this.animate(t,e,n,r)}}),f.timers=[],f.fx.tick=function(){var e,t=f.timers,n=0;for(Ye=f.now();n<t.length;n++)(e=t[n])()||t[n]!==e||t.splice(n--,1);t.length||f.fx.stop(),Ye=void 0},f.fx.timer=function(e){f.timers.push(e),e()?f.fx.start():f.timers.pop()},f.fx.interval=13,f.fx.start=function(){Ge||(Ge=setInterval(f.fx.tick,f.fx.interval))},f.fx.stop=function(){clearInterval(Ge),Ge=null},f.fx.speeds={slow:600,fast:200,_default:400},f.fn.delay=function(e,t){return e=f.fx&&f.fx.speeds[e]||e,t=t||"fx",this.queue(t,function(t,n){var r=setTimeout(t,e);n.stop=function(){clearTimeout(r)}})},function(){var e,t,n,r,i;(t=N.createElement("div")).setAttribute("className","t"),t.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",r=t.getElementsByTagName("a")[0],i=(n=N.createElement("select")).appendChild(N.createElement("option")),e=t.getElementsByTagName("input")[0],r.style.cssText="top:1px",c.getSetAttribute="t"!==t.className,c.style=/top/.test(r.getAttribute("style")),c.hrefNormalized="/a"===r.getAttribute("href"),c.checkOn=!!e.value,c.optSelected=i.selected,c.enctype=!!N.createElement("form").enctype,n.disabled=!0,c.optDisabled=!i.disabled,(e=N.createElement("input")).setAttribute("value",""),c.input=""===e.getAttribute("value"),e.value="t",e.setAttribute("type","radio"),c.radioValue="t"===e.value}();var at=/\r/g;f.fn.extend({val:function(e){var t,n,r,i=this[0];return arguments.length?(r=f.isFunction(e),this.each(function(n){var i;1===this.nodeType&&(null==(i=r?e.call(this,n,f(this).val()):e)?i="":"number"==typeof i?i+="":f.isArray(i)&&(i=f.map(i,function(e){return null==e?"":e+""})),(t=f.valHooks[this.type]||f.valHooks[this.nodeName.toLowerCase()])&&"set"in t&&void 0!==t.set(this,i,"value")||(this.value=i))})):i?(t=f.valHooks[i.type]||f.valHooks[i.nodeName.toLowerCase()])&&"get"in t&&void 0!==(n=t.get(i,"value"))?n:"string"==typeof(n=i.value)?n.replace(at,""):null==n?"":n:void 0}}),f.extend({valHooks:{option:{get:function(e){var t=f.find.attr(e,"value");return null!=t?t:f.trim(f.text(e))}},select:{get:function(e){for(var t,n,r=e.options,i=e.selectedIndex,o="select-one"===e.type||0>i,a=o?null:[],s=o?i+1:r.length,l=0>i?s:o?i:0;s>l;l++)if(!(!(n=r[l]).selected&&l!==i||(c.optDisabled?n.disabled:null!==n.getAttribute("disabled"))||n.parentNode.disabled&&f.nodeName(n.parentNode,"optgroup"))){if(t=f(n).val(),o)return t;a.push(t)}return a},set:function(e,t){for(var n,r,i=e.options,o=f.makeArray(t),a=i.length;a--;)if(r=i[a],f.inArray(f.valHooks.option.get(r),o)>=0)try{r.selected=n=!0}catch(e){r.scrollHeight}else r.selected=!1;return n||(e.selectedIndex=-1),i}}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]={set:function(e,t){return f.isArray(t)?e.checked=f.inArray(f(e).val(),t)>=0:void 0}},c.checkOn||(f.valHooks[this].get=function(e){return null===e.getAttribute("value")?"on":e.value})});var st,lt,ut=f.expr.attrHandle,ct=/^(?:checked|selected)$/i,dt=c.getSetAttribute,ft=c.input;f.fn.extend({attr:function(e,t){return X(this,f.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){f.removeAttr(this,e)})}}),f.extend({attr:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return typeof e.getAttribute===M?f.prop(e,t,n):(1===o&&f.isXMLDoc(e)||(t=t.toLowerCase(),r=f.attrHooks[t]||(f.expr.match.bool.test(t)?lt:st)),void 0===n?r&&"get"in r&&null!==(i=r.get(e,t))?i:null==(i=f.find.attr(e,t))?void 0:i:null!==n?r&&"set"in r&&void 0!==(i=r.set(e,n,t))?i:(e.setAttribute(t,n+""),n):void f.removeAttr(e,t))},removeAttr:function(e,t){var n,r,i=0,o=t&&t.match(j);if(o&&1===e.nodeType)for(;n=o[i++];)r=f.propFix[n]||n,f.expr.match.bool.test(n)?ft&&dt||!ct.test(n)?e[r]=!1:e[f.camelCase("default-"+n)]=e[r]=!1:f.attr(e,n,""),e.removeAttribute(dt?n:r)},attrHooks:{type:{set:function(e,t){if(!c.radioValue&&"radio"===t&&f.nodeName(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}}}}),lt={set:function(e,t,n){return!1===t?f.removeAttr(e,n):ft&&dt||!ct.test(n)?e.setAttribute(!dt&&f.propFix[n]||n,n):e[f.camelCase("default-"+n)]=e[n]=!0,n}},f.each(f.expr.match.bool.source.match(/\w+/g),function(e,t){var n=ut[t]||f.find.attr;ut[t]=ft&&dt||!ct.test(t)?function(e,t,r){var i,o;return r||(o=ut[t],ut[t]=i,i=null!=n(e,t,r)?t.toLowerCase():null,ut[t]=o),i}:function(e,t,n){return n?void 0:e[f.camelCase("default-"+t)]?t.toLowerCase():null}}),ft&&dt||(f.attrHooks.value={set:function(e,t,n){return f.nodeName(e,"input")?void(e.defaultValue=t):st&&st.set(e,t,n)}}),dt||(st={set:function(e,t,n){var r=e.getAttributeNode(n);return r||e.setAttributeNode(r=e.ownerDocument.createAttribute(n)),r.value=t+="","value"===n||t===e.getAttribute(n)?t:void 0}},ut.id=ut.name=ut.coords=function(e,t,n){var r;return n?void 0:(r=e.getAttributeNode(t))&&""!==r.value?r.value:null},f.valHooks.button={get:function(e,t){var n=e.getAttributeNode(t);return n&&n.specified?n.value:void 0},set:st.set},f.attrHooks.contenteditable={set:function(e,t,n){st.set(e,""!==t&&t,n)}},f.each(["width","height"],function(e,t){f.attrHooks[t]={set:function(e,n){return""===n?(e.setAttribute(t,"auto"),n):void 0}}})),c.style||(f.attrHooks.style={get:function(e){return e.style.cssText||void 0},set:function(e,t){return e.style.cssText=t+""}});var pt=/^(?:input|select|textarea|button|object)$/i,ht=/^(?:a|area)$/i;f.fn.extend({prop:function(e,t){return X(this,f.prop,e,t,arguments.length>1)},removeProp:function(e){return e=f.propFix[e]||e,this.each(function(){try{this[e]=void 0,delete this[e]}catch(e){}})}}),f.extend({propFix:{for:"htmlFor",class:"className"},prop:function(e,t,n){var r,i,o=e.nodeType;if(e&&3!==o&&8!==o&&2!==o)return(1!==o||!f.isXMLDoc(e))&&(t=f.propFix[t]||t,i=f.propHooks[t]),void 0!==n?i&&"set"in i&&void 0!==(r=i.set(e,n,t))?r:e[t]=n:i&&"get"in i&&null!==(r=i.get(e,t))?r:e[t]},propHooks:{tabIndex:{get:function(e){var t=f.find.attr(e,"tabindex");return t?parseInt(t,10):pt.test(e.nodeName)||ht.test(e.nodeName)&&e.href?0:-1}}}}),c.hrefNormalized||f.each(["href","src"],function(e,t){f.propHooks[t]={get:function(e){return e.getAttribute(t,4)}}}),c.optSelected||(f.propHooks.selected={get:function(e){var t=e.parentNode;return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null}}),f.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){f.propFix[this.toLowerCase()]=this}),c.enctype||(f.propFix.enctype="encoding");var mt=/[\t\r\n\f]/g;f.fn.extend({addClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u="string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).addClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):" ")){for(o=0;i=t[o++];)r.indexOf(" "+i+" ")<0&&(r+=i+" ");a=f.trim(r),n.className!==a&&(n.className=a)}return this},removeClass:function(e){var t,n,r,i,o,a,s=0,l=this.length,u=0===arguments.length||"string"==typeof e&&e;if(f.isFunction(e))return this.each(function(t){f(this).removeClass(e.call(this,t,this.className))});if(u)for(t=(e||"").match(j)||[];l>s;s++)if(r=1===(n=this[s]).nodeType&&(n.className?(" "+n.className+" ").replace(mt," "):"")){for(o=0;i=t[o++];)for(;r.indexOf(" "+i+" ")>=0;)r=r.replace(" "+i+" "," ");a=e?f.trim(r):"",n.className!==a&&(n.className=a)}return this},toggleClass:function(e,t){var n=typeof e;return"boolean"==typeof t&&"string"===n?t?this.addClass(e):this.removeClass(e):this.each(f.isFunction(e)?function(n){f(this).toggleClass(e.call(this,n,this.className,t),t)}:function(){if("string"===n)for(var t,r=0,i=f(this),o=e.match(j)||[];t=o[r++];)i.hasClass(t)?i.removeClass(t):i.addClass(t);else(n===M||"boolean"===n)&&(this.className&&f._data(this,"__className__",this.className),this.className=this.className||!1===e?"":f._data(this,"__className__")||"")})},hasClass:function(e){for(var t=" "+e+" ",n=0,r=this.length;r>n;n++)if(1===this[n].nodeType&&(" "+this[n].className+" ").replace(mt," ").indexOf(t)>=0)return!0;return!1}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(e,t){f.fn[t]=function(e,n){return arguments.length>0?this.on(t,null,e,n):this.trigger(t)}}),f.fn.extend({hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)},bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1===arguments.length?this.off(e,"**"):this.off(t,e||"**",n)}});var gt=f.now(),vt=/\?/,yt=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;f.parseJSON=function(t){if(e.JSON&&e.JSON.parse)return e.JSON.parse(t+"");var n,r=null,i=f.trim(t+"");return i&&!f.trim(i.replace(yt,function(e,t,i,o){return n&&t&&(r=0),0===r?e:(n=i||t,r+=!o-!i,"")}))?Function("return "+i)():f.error("Invalid JSON: "+t)},f.parseXML=function(t){var n;if(!t||"string"!=typeof t)return null;try{e.DOMParser?n=(new DOMParser).parseFromString(t,"text/xml"):((n=new ActiveXObject("Microsoft.XMLDOM")).async="false",n.loadXML(t))}catch(e){n=void 0}return n&&n.documentElement&&!n.getElementsByTagName("parsererror").length||f.error("Invalid XML: "+t),n};var bt,xt,wt=/#.*$/,Tt=/([?&])_=[^&]*/,Ct=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Nt=/^(?:GET|HEAD)$/,Et=/^\/\//,kt=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,St={},At={},Dt="*/".concat("*");try{xt=location.href}catch(e){(xt=N.createElement("a")).href="",xt=xt.href}function jt(e){return function(t,n){"string"!=typeof t&&(n=t,t="*");var r,i=0,o=t.toLowerCase().match(j)||[];if(f.isFunction(n))for(;r=o[i++];)"+"===r.charAt(0)?(r=r.slice(1)||"*",(e[r]=e[r]||[]).unshift(n)):(e[r]=e[r]||[]).push(n)}}function Lt(e,t,n,r){var i={},o=e===At;function a(s){var l;return i[s]=!0,f.each(e[s]||[],function(e,s){var u=s(t,n,r);return"string"!=typeof u||o||i[u]?o?!(l=u):void 0:(t.dataTypes.unshift(u),a(u),!1)}),l}return a(t.dataTypes[0])||!i["*"]&&a("*")}function Ht(e,t){var n,r,i=f.ajaxSettings.flatOptions||{};for(r in t)void 0!==t[r]&&((i[r]?e:n||(n={}))[r]=t[r]);return n&&f.extend(!0,e,n),e}bt=kt.exec(xt.toLowerCase())||[],f.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:xt,type:"GET",isLocal:/^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(bt[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Dt,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(e,t){return t?Ht(Ht(e,f.ajaxSettings),t):Ht(f.ajaxSettings,e)},ajaxPrefilter:jt(St),ajaxTransport:jt(At),ajax:function(e,t){"object"==typeof e&&(t=e,e=void 0),t=t||{};var n,r,i,o,a,s,l,u,c=f.ajaxSetup({},t),d=c.context||c,p=c.context&&(d.nodeType||d.jquery)?f(d):f.event,h=f.Deferred(),m=f.Callbacks("once memory"),g=c.statusCode||{},v={},y={},b=0,x="canceled",w={readyState:0,getResponseHeader:function(e){var t;if(2===b){if(!u)for(u={};t=Ct.exec(o);)u[t[1].toLowerCase()]=t[2];t=u[e.toLowerCase()]}return null==t?null:t},getAllResponseHeaders:function(){return 2===b?o:null},setRequestHeader:function(e,t){var n=e.toLowerCase();return b||(e=y[n]=y[n]||e,v[e]=t),this},overrideMimeType:function(e){return b||(c.mimeType=e),this},statusCode:function(e){var t;if(e)if(2>b)for(t in e)g[t]=[g[t],e[t]];else w.always(e[w.status]);return this},abort:function(e){var t=e||x;return l&&l.abort(t),T(0,t),this}};if(h.promise(w).complete=m.add,w.success=w.done,w.error=w.fail,c.url=((e||c.url||xt)+"").replace(wt,"").replace(Et,bt[1]+"//"),c.type=t.method||t.type||c.method||c.type,c.dataTypes=f.trim(c.dataType||"*").toLowerCase().match(j)||[""],null==c.crossDomain&&(n=kt.exec(c.url.toLowerCase()),c.crossDomain=!(!n||n[1]===bt[1]&&n[2]===bt[2]&&(n[3]||("http:"===n[1]?"80":"443"))===(bt[3]||("http:"===bt[1]?"80":"443")))),c.data&&c.processData&&"string"!=typeof c.data&&(c.data=f.param(c.data,c.traditional)),Lt(St,c,t,w),2===b)return w;for(r in(s=f.event&&c.global)&&0==f.active++&&f.event.trigger("ajaxStart"),c.type=c.type.toUpperCase(),c.hasContent=!Nt.test(c.type),i=c.url,c.hasContent||(c.data&&(i=c.url+=(vt.test(i)?"&":"?")+c.data,delete c.data),!1===c.cache&&(c.url=Tt.test(i)?i.replace(Tt,"$1_="+gt++):i+(vt.test(i)?"&":"?")+"_="+gt++)),c.ifModified&&(f.lastModified[i]&&w.setRequestHeader("If-Modified-Since",f.lastModified[i]),f.etag[i]&&w.setRequestHeader("If-None-Match",f.etag[i])),(c.data&&c.hasContent&&!1!==c.contentType||t.contentType)&&w.setRequestHeader("Content-Type",c.contentType),w.setRequestHeader("Accept",c.dataTypes[0]&&c.accepts[c.dataTypes[0]]?c.accepts[c.dataTypes[0]]+("*"!==c.dataTypes[0]?", "+Dt+"; q=0.01":""):c.accepts["*"]),c.headers)w.setRequestHeader(r,c.headers[r]);if(c.beforeSend&&(!1===c.beforeSend.call(d,w,c)||2===b))return w.abort();for(r in x="abort",{success:1,error:1,complete:1})w[r](c[r]);if(l=Lt(At,c,t,w)){w.readyState=1,s&&p.trigger("ajaxSend",[w,c]),c.async&&c.timeout>0&&(a=setTimeout(function(){w.abort("timeout")},c.timeout));try{b=1,l.send(v,T)}catch(e){if(!(2>b))throw e;T(-1,e)}}else T(-1,"No Transport");function T(e,t,n,r){var u,v,y,x,T,C=t;2!==b&&(b=2,a&&clearTimeout(a),l=void 0,o=r||"",w.readyState=e>0?4:0,u=e>=200&&300>e||304===e,n&&(x=function(e,t,n){for(var r,i,o,a,s=e.contents,l=e.dataTypes;"*"===l[0];)l.shift(),void 0===i&&(i=e.mimeType||t.getResponseHeader("Content-Type"));if(i)for(a in s)if(s[a]&&s[a].test(i)){l.unshift(a);break}if(l[0]in n)o=l[0];else{for(a in n){if(!l[0]||e.converters[a+" "+l[0]]){o=a;break}r||(r=a)}o=o||r}return o?(o!==l[0]&&l.unshift(o),n[o]):void 0}(c,w,n)),x=function(e,t,n,r){var i,o,a,s,l,u={},c=e.dataTypes.slice();if(c[1])for(a in e.converters)u[a.toLowerCase()]=e.converters[a];for(o=c.shift();o;)if(e.responseFields[o]&&(n[e.responseFields[o]]=t),!l&&r&&e.dataFilter&&(t=e.dataFilter(t,e.dataType)),l=o,o=c.shift())if("*"===o)o=l;else if("*"!==l&&l!==o){if(!(a=u[l+" "+o]||u["* "+o]))for(i in u)if((s=i.split(" "))[1]===o&&(a=u[l+" "+s[0]]||u["* "+s[0]])){!0===a?a=u[i]:!0!==u[i]&&(o=s[0],c.unshift(s[1]));break}if(!0!==a)if(a&&e.throws)t=a(t);else try{t=a(t)}catch(e){return{state:"parsererror",error:a?e:"No conversion from "+l+" to "+o}}}return{state:"success",data:t}}(c,x,w,u),u?(c.ifModified&&((T=w.getResponseHeader("Last-Modified"))&&(f.lastModified[i]=T),(T=w.getResponseHeader("etag"))&&(f.etag[i]=T)),204===e||"HEAD"===c.type?C="nocontent":304===e?C="notmodified":(C=x.state,v=x.data,u=!(y=x.error))):(y=C,(e||!C)&&(C="error",0>e&&(e=0))),w.status=e,w.statusText=(t||C)+"",u?h.resolveWith(d,[v,C,w]):h.rejectWith(d,[w,C,y]),w.statusCode(g),g=void 0,s&&p.trigger(u?"ajaxSuccess":"ajaxError",[w,c,u?v:y]),m.fireWith(d,[w,C]),s&&(p.trigger("ajaxComplete",[w,c]),--f.active||f.event.trigger("ajaxStop")))}return w},getJSON:function(e,t,n){return f.get(e,t,n,"json")},getScript:function(e,t){return f.get(e,void 0,t,"script")}}),f.each(["get","post"],function(e,t){f[t]=function(e,n,r,i){return f.isFunction(n)&&(i=i||r,r=n,n=void 0),f.ajax({url:e,type:t,dataType:i,data:n,success:r})}}),f._evalUrl=function(e){return f.ajax({url:e,type:"GET",dataType:"script",async:!1,global:!1,throws:!0})},f.fn.extend({wrapAll:function(e){if(f.isFunction(e))return this.each(function(t){f(this).wrapAll(e.call(this,t))});if(this[0]){var t=f(e,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){for(var e=this;e.firstChild&&1===e.firstChild.nodeType;)e=e.firstChild;return e}).append(this)}return this},wrapInner:function(e){return this.each(f.isFunction(e)?function(t){f(this).wrapInner(e.call(this,t))}:function(){var t=f(this),n=t.contents();n.length?n.wrapAll(e):t.append(e)})},wrap:function(e){var t=f.isFunction(e);return this.each(function(n){f(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()}}),f.expr.filters.hidden=function(e){return e.offsetWidth<=0&&e.offsetHeight<=0||!c.reliableHiddenOffsets()&&"none"===(e.style&&e.style.display||f.css(e,"display"))},f.expr.filters.visible=function(e){return!f.expr.filters.hidden(e)};var qt=/%20/g,_t=/\[\]$/,Mt=/\r?\n/g,Ft=/^(?:submit|button|image|reset|file)$/i,Ot=/^(?:input|select|textarea|keygen)/i;function Bt(e,t,n,r){var i;if(f.isArray(t))f.each(t,function(t,i){n||_t.test(e)?r(e,i):Bt(e+"["+("object"==typeof i?t:"")+"]",i,n,r)});else if(n||"object"!==f.type(t))r(e,t);else for(i in t)Bt(e+"["+i+"]",t[i],n,r)}f.param=function(e,t){var n,r=[],i=function(e,t){t=f.isFunction(t)?t():null==t?"":t,r[r.length]=encodeURIComponent(e)+"="+encodeURIComponent(t)};if(void 0===t&&(t=f.ajaxSettings&&f.ajaxSettings.traditional),f.isArray(e)||e.jquery&&!f.isPlainObject(e))f.each(e,function(){i(this.name,this.value)});else for(n in e)Bt(n,e[n],t,i);return r.join("&").replace(qt,"+")},f.fn.extend({serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var e=f.prop(this,"elements");return e?f.makeArray(e):this}).filter(function(){var e=this.type;return this.name&&!f(this).is(":disabled")&&Ot.test(this.nodeName)&&!Ft.test(e)&&(this.checked||!U.test(e))}).map(function(e,t){var n=f(this).val();return null==n?null:f.isArray(n)?f.map(n,function(e){return{name:t.name,value:e.replace(Mt,"\r\n")}}):{name:t.name,value:n.replace(Mt,"\r\n")}}).get()}}),f.ajaxSettings.xhr=void 0!==e.ActiveXObject?function(){return!this.isLocal&&/^(get|post|head|put|delete|options)$/i.test(this.type)&&$t()||function(){try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(e){}}()}:$t;var Pt=0,Rt={},Wt=f.ajaxSettings.xhr();function $t(){try{return new e.XMLHttpRequest}catch(e){}}e.attachEvent&&e.attachEvent("onunload",function(){for(var e in Rt)Rt[e](void 0,!0)}),c.cors=!!Wt&&"withCredentials"in Wt,(Wt=c.ajax=!!Wt)&&f.ajaxTransport(function(e){var t;if(!e.crossDomain||c.cors)return{send:function(n,r){var i,o=e.xhr(),a=++Pt;if(o.open(e.type,e.url,e.async,e.username,e.password),e.xhrFields)for(i in e.xhrFields)o[i]=e.xhrFields[i];for(i in e.mimeType&&o.overrideMimeType&&o.overrideMimeType(e.mimeType),e.crossDomain||n["X-Requested-With"]||(n["X-Requested-With"]="XMLHttpRequest"),n)void 0!==n[i]&&o.setRequestHeader(i,n[i]+"");o.send(e.hasContent&&e.data||null),t=function(n,i){var s,l,u;if(t&&(i||4===o.readyState))if(delete Rt[a],t=void 0,o.onreadystatechange=f.noop,i)4!==o.readyState&&o.abort();else{u={},s=o.status,"string"==typeof o.responseText&&(u.text=o.responseText);try{l=o.statusText}catch(e){l=""}s||!e.isLocal||e.crossDomain?1223===s&&(s=204):s=u.text?200:404}u&&r(s,l,u,o.getAllResponseHeaders())},e.async?4===o.readyState?setTimeout(t):o.onreadystatechange=Rt[a]=t:t()},abort:function(){t&&t(void 0,!0)}}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(e){return f.globalEval(e),e}}}),f.ajaxPrefilter("script",function(e){void 0===e.cache&&(e.cache=!1),e.crossDomain&&(e.type="GET",e.global=!1)}),f.ajaxTransport("script",function(e){if(e.crossDomain){var t,n=N.head||f("head")[0]||N.documentElement;return{send:function(r,i){(t=N.createElement("script")).async=!0,e.scriptCharset&&(t.charset=e.scriptCharset),t.src=e.url,t.onload=t.onreadystatechange=function(e,n){(n||!t.readyState||/loaded|complete/.test(t.readyState))&&(t.onload=t.onreadystatechange=null,t.parentNode&&t.parentNode.removeChild(t),t=null,n||i(200,"success"))},n.insertBefore(t,n.firstChild)},abort:function(){t&&t.onload(void 0,!0)}}}});var zt=[],It=/(=)\?(?=&|$)|\?\?/;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=zt.pop()||f.expando+"_"+gt++;return this[e]=!0,e}}),f.ajaxPrefilter("json jsonp",function(t,n,r){var i,o,a,s=!1!==t.jsonp&&(It.test(t.url)?"url":"string"==typeof t.data&&!(t.contentType||"").indexOf("application/x-www-form-urlencoded")&&It.test(t.data)&&"data");return s||"jsonp"===t.dataTypes[0]?(i=t.jsonpCallback=f.isFunction(t.jsonpCallback)?t.jsonpCallback():t.jsonpCallback,s?t[s]=t[s].replace(It,"$1"+i):!1!==t.jsonp&&(t.url+=(vt.test(t.url)?"&":"?")+t.jsonp+"="+i),t.converters["script json"]=function(){return a||f.error(i+" was not called"),a[0]},t.dataTypes[0]="json",o=e[i],e[i]=function(){a=arguments},r.always(function(){e[i]=o,t[i]&&(t.jsonpCallback=n.jsonpCallback,zt.push(i)),a&&f.isFunction(o)&&o(a[0]),a=o=void 0}),"script"):void 0}),f.parseHTML=function(e,t,n){if(!e||"string"!=typeof e)return null;"boolean"==typeof t&&(n=t,t=!1),t=t||N;var r=x.exec(e),i=!n&&[];return r?[t.createElement(r[1])]:(r=f.buildFragment([e],t,i),i&&i.length&&f(i).remove(),f.merge([],r.childNodes))};var Xt=f.fn.load;f.fn.load=function(e,t,n){if("string"!=typeof e&&Xt)return Xt.apply(this,arguments);var r,i,o,a=this,s=e.indexOf(" ");return s>=0&&(r=f.trim(e.slice(s,e.length)),e=e.slice(0,s)),f.isFunction(t)?(n=t,t=void 0):t&&"object"==typeof t&&(o="POST"),a.length>0&&f.ajax({url:e,type:o,dataType:"html",data:t}).done(function(e){i=arguments,a.html(r?f("<div>").append(f.parseHTML(e)).find(r):e)}).complete(n&&function(e,t){a.each(n,i||[e.responseText,t,e])}),this},f.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){f.fn[t]=function(e){return this.on(t,e)}}),f.expr.filters.animated=function(e){return f.grep(f.timers,function(t){return e===t.elem}).length};var Ut=e.document.documentElement;function Vt(e){return f.isWindow(e)?e:9===e.nodeType&&(e.defaultView||e.parentWindow)}f.offset={setOffset:function(e,t,n){var r,i,o,a,s,l,u=f.css(e,"position"),c=f(e),d={};"static"===u&&(e.style.position="relative"),s=c.offset(),o=f.css(e,"top"),l=f.css(e,"left"),("absolute"===u||"fixed"===u)&&f.inArray("auto",[o,l])>-1?(a=(r=c.position()).top,i=r.left):(a=parseFloat(o)||0,i=parseFloat(l)||0),f.isFunction(t)&&(t=t.call(e,n,s)),null!=t.top&&(d.top=t.top-s.top+a),null!=t.left&&(d.left=t.left-s.left+i),"using"in t?t.using.call(e,d):c.css(d)}},f.fn.extend({offset:function(e){if(arguments.length)return void 0===e?this:this.each(function(t){f.offset.setOffset(this,e,t)});var t,n,r={top:0,left:0},i=this[0],o=i&&i.ownerDocument;return o?(t=o.documentElement,f.contains(t,i)?(typeof i.getBoundingClientRect!==M&&(r=i.getBoundingClientRect()),n=Vt(o),{top:r.top+(n.pageYOffset||t.scrollTop)-(t.clientTop||0),left:r.left+(n.pageXOffset||t.scrollLeft)-(t.clientLeft||0)}):r):void 0},position:function(){if(this[0]){var e,t,n={top:0,left:0},r=this[0];return"fixed"===f.css(r,"position")?t=r.getBoundingClientRect():(e=this.offsetParent(),t=this.offset(),f.nodeName(e[0],"html")||(n=e.offset()),n.top+=f.css(e[0],"borderTopWidth",!0),n.left+=f.css(e[0],"borderLeftWidth",!0)),{top:t.top-n.top-f.css(r,"marginTop",!0),left:t.left-n.left-f.css(r,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){for(var e=this.offsetParent||Ut;e&&!f.nodeName(e,"html")&&"static"===f.css(e,"position");)e=e.offsetParent;return e||Ut})}}),f.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,t){var n=/Y/.test(t);f.fn[e]=function(r){return X(this,function(e,r,i){var o=Vt(e);return void 0===i?o?t in o?o[t]:o.document.documentElement[r]:e[r]:void(o?o.scrollTo(n?f(o).scrollLeft():i,n?i:f(o).scrollTop()):e[r]=i)},e,r,arguments.length,null)}}),f.each(["top","left"],function(e,t){f.cssHooks[t]=_e(c.pixelPosition,function(e,n){return n?(n=je(e,t),He.test(n)?f(e).position()[t]+"px":n):void 0})}),f.each({Height:"height",Width:"width"},function(e,t){f.each({padding:"inner"+e,content:t,"":"outer"+e},function(n,r){f.fn[r]=function(r,i){var o=arguments.length&&(n||"boolean"!=typeof r),a=n||(!0===r||!0===i?"margin":"border");return X(this,function(t,n,r){var i;return f.isWindow(t)?t.document.documentElement["client"+e]:9===t.nodeType?(i=t.documentElement,Math.max(t.body["scroll"+e],i["scroll"+e],t.body["offset"+e],i["offset"+e],i["client"+e])):void 0===r?f.css(t,n,a):f.style(t,n,r,a)},t,o?r:void 0,o,null)}})}),f.fn.size=function(){return this.length},f.fn.andSelf=f.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return f});var Jt=e.jQuery,Yt=e.$;return f.noConflict=function(t){return e.$===f&&(e.$=Yt),t&&e.jQuery===f&&(e.jQuery=Jt),f},typeof t===M&&(e.jQuery=e.$=f),f});
    IV$ = window.IV$ = jQuery.noConflict(true); 
};
/* ================================================================================================================================================== */

/** ===============================================================================================================================================
 * 
 * 회원데이터 생성 
 * - winodow load 이후에 호출 시 정상 노출 / 값 없을 경우 null 
 * @IV_MEMBER_ID 회원 아이디 {string} / @IV_MEMBER_NAME 회원 이름 {string} / @IV_MEMBER_NICKNAME 회원 별명 
 * @IV_MEMBER_GROUPNAME 등급명 {string} / @IV_MEMBER_GROUPNO 등급번호 {string}
 * @IV_MEMBER_EMAIL 회원 이메일 {string} / @IV_MEMBER_PHONE 회원 일반전화번호 {string} / @IV_MEMBER_CELLPHONE 회원 핸드폰번호 {string} / @IV_MEMBER_BIRTHDAY 회원 생일
 * @IV_MEMBER_BOARDWRITENAME 회원 게시판 작성 시 이름 {string} / @IV_MEMBER_ADDITIONALINFOMATION 회원 추가정보 {array} (객체 배열) / @IV_MEMBER_CREATEDATE 회원 계정생성일 {string} 
 * @IV_MEMBER_AVAIL_MILEAGE 회원 사용가능 적립금(소수점 포함) {string} / @IV_MEMBER_UNAVAIL_MILEAGE 회원 미가용 적립금(소수점 포함) {string} / @IV_MEMBER_RETURN_MILEAGE 회원 환불예정 적립금(소수점 포함) {string} 
 * @IV_MEMBER_TOTAL_MILEAGE 회원 총적립금(미가용+가용) (소수점 포함) {string} / @IV_MEMBER_USED_MILEAGE 회원이 사용한 적립금(소수점 포함) {string} 
 * @IV_MEMBER_ACC_DEPOSIT 회원 누적 예치금{string} / @IV_MEMBER_USED_DEPOSIT 회원 사용 예치금 {string} / @IV_MEMBER_AVAIL_DEPOSIT 사용 가능 예치금 / @IV_MEMBER_RETURN_DEPOSIT 현금 환불요청 예치금 /@IV_MEMBER_TOTAL_DEPOSIT 회원 총예치금(미가용+가용) 
 * @IV_MEMBER_COUPON_COUNT 보유 쿠폰 수 {number}
 * @IV_MEMBER_ORDER_COUNT 총주문수 {string} / @IV_MEMBER_ORDER_TOTAL 총주문금액 {string} / @IV_MEMBER_ORDER_INCREASEVALUE 승급까지 남은 정보 ? 
 */
var IV_MEMBER_CHECK = IV_MEMBER_CHECK || null;
var IV_MEMBER_ID = IV_MEMBER_ID || null; 
var IV_MEMBER_NAME = IV_MEMBER_NAME || null; 
var IV_MEMBER_NICKNAME = IV_MEMBER_NICKNAME || null; 
var IV_MEMBER_GROUPNAME = IV_MEMBER_GROUPNAME || null; 
var IV_MEMBER_GROUPNO = IV_MEMBER_GROUPNO || null; 
var IV_MEMBER_EMAIL = IV_MEMBER_EMAIL || null; 
var IV_MEMBER_PHONE = IV_MEMBER_PHONE || null; 
var IV_MEMBER_CELLPHONE = IV_MEMBER_CELLPHONE || null; 
var IV_MEMBER_BIRTHDAY = IV_MEMBER_BIRTHDAY || null; 
var IV_MEMBER_BOARDWRITENAME = IV_MEMBER_BOARDWRITENAME || null; 
var IV_MEMBER_ADDITIONALINFOMATION = IV_MEMBER_ADDITIONALINFOMATION || null; 
var IV_MEMBER_CREATEDATE = IV_MEMBER_CREATEDATE || null; 
var IV_MEMBER_NAME_MILEAGE = IV_MEMBER_NAME_MILEAGE || null;
var IV_MEMBER_UNIT_MILEAGE = IV_MEMBER_UNIT_MILEAGE || null;
var IV_MEMBER_AVAIL_MILEAGE = IV_MEMBER_AVAIL_MILEAGE || null; 
var IV_MEMBER_UNAVAIL_MILEAGE = IV_MEMBER_UNAVAIL_MILEAGE || null; 
var IV_MEMBER_RETURN_MILEAGE = IV_MEMBER_RETURN_MILEAGE || null; 
var IV_MEMBER_TOTAL_MILEAGE = IV_MEMBER_TOTAL_MILEAGE || null; 
var IV_MEMBER_USED_MILEAGE = IV_MEMBER_USED_MILEAGE || null; 
var IV_MEMBER_NAME_DEPOSIT = IV_MEMBER_NAME_DEPOSIT || null;
var IV_MEMBER_UNIT_DEPOSIT = IV_MEMBER_UNIT_DEPOSIT || null;
var IV_MEMBER_ACC_DEPOSIT = IV_MEMBER_ACC_DEPOSIT || null; 
var IV_MEMBER_USED_DEPOSIT = IV_MEMBER_USED_DEPOSIT || null; 
var IV_MEMBER_RETURN_DEPOSIT = IV_MEMBER_RETURN_DEPOSIT || null; 
var IV_MEMBER_AVAIL_DEPOSIT = IV_MEMBER_AVAIL_DEPOSIT || null; 
var IV_MEMBER_TOTAL_DEPOSIT = IV_MEMBER_TOTAL_DEPOSIT || null; 
var IV_MEMBER_COUPON_COUNT = IV_MEMBER_COUPON_COUNT || null; 
var IV_MEMBER_ORDER_COUNT = IV_MEMBER_ORDER_COUNT || null; 
var IV_MEMBER_ORDER_TOTAL = IV_MEMBER_ORDER_TOTAL || null; 
var IV_MEMBER_ORDER_INCREASEVALUE = IV_MEMBER_ORDER_INCREASEVALUE || null; 
var IV_MEMBER_OBJ = IV_MEMBER_OBJ || {};
/* ================================================================================================================================================== */

/** ================================================================================================================================================== 
 * 페이지 접속 정보 
 * @ IV_LOCATION ~ : 주소줄 기준 정보
 * @ isPopupPage 팝업페이지 여부 0 아님 1 iframe 2 새 창
 * @ topDocument 최상위 문서
 * @ IV_TOP_SUBCONTAINER_DATA_PAGE / IV_SUBCONTAINER_DATA_PAGE 최상위/현재 페이지 고유값
 * @ IV_MEMBER_CHECK 회원/비회원 여부
 */
var IV_LOCATION_HREF = IV_LOCATION_HREF || window.location.href; /* 현재 주소줄 전체 */
var IV_LOCATION_HOSTNAME = IV_LOCATION_HOSTNAME || window.location.hostname; /* 현재 주소 기준 hostname */
var IV_LOCATION_PATHNAME = IV_LOCATION_PATHNAME || window.location.pathname; /* 현재 주소 기준 pathname */
var IV_LOCATION_PROTOCOL = IV_LOCATION_PROTOCOL || window.location.protocol; /* 현재 주소 기준 protocol */
var IV_LOCATION_PARAMETERS = IV_LOCATION_PARAMETERS || ((window.location.search == '') ? '' : window.location.search.split('?')[1]); /* 현재 주소 기준 parameters */
var isPopupPage = isPopupPage || null; 
var topDocument = topDocument || null; 
var IV_TOP_SUBCONTAINER_DATA_PAGE = IV_TOP_SUBCONTAINER_DATA_PAGE || null;
var IV_SUBCONTAINER_DATA_PAGE = IV_SUBCONTAINER_DATA_PAGE || null;
try {
    if(window.frameElement || opener){
        if(window.frameElement){
            isPopupPage = 1;
            topDocument = top.document.documentElement;
            document.documentElement.classList.add('ivIframeHtml');
        }else{
            if(IV$('html').attr('class').indexOf('popup') == -1){
                isPopupPage = 0;
                topDocument = document.documentElement;
            }else{
                isPopupPage = 2;
                topDocument = opener.document.documentElement;
                document.documentElement.classList.add('ivPopupHtml');
            };
        };
    }else{
        isPopupPage = 0;
        topDocument = document.documentElement;
    };
} catch (err) {
    isPopupPage = 0;
    topDocument = document.documentElement;
};
IV_MEMBER_CHECK = topDocument.querySelectorAll('#loginChk_nomember').length > 0 ? false : true; //true : 회원 , false: 비회원
/* ================================================================================================================================================== */
/** ================================================================================================================================================= 
 * 커스텀 이벤트 생성
 */
(function () {
    if ( typeof window.CustomEvent === "function" ) return false;
    /* ie 대응 */
    function CustomEvent ( event, params ) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent('CustomEvent');
        evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
        return evt;
    };
    CustomEvent.prototype = window.Event.prototype;
    window.CustomEvent = CustomEvent;
})();
/**
 * Object.assign() polyfill for IE11
 * @see <https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/assign>
 */
if (typeof Object.assign != "function") {
    Object.defineProperty(Object, "assign", {
        value: function assign(target, varArgs) {
            "use strict";
            if (target == null) {
                throw new TypeError("Cannot convert undefined or null to object");
            };
            var to = Object(target);
            for (var index = 1; index < arguments.length; index++) {
                var nextSource = arguments[index];
                if (nextSource != null) {
                    for (var nextKey in nextSource) {
                        if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
                            to[nextKey] = nextSource[nextKey];
                        };
                    };
                };
            };
            return to;
        },
        writable: true,
        configurable: true
    });
};
var includeJs = includeJs || function(jsFilePath, randomUse) {
    var ord=Math.random();
    var js = document.createElement("script");
    js.type = "text/javascript";
    if(randomUse){
        js.src = jsFilePath + '?v=' + ord;
    }else{
        js.src = jsFilePath;
    };
    document.body.appendChild(js);
};
var includeCss = includeCss || function(cssFilePath, randomUse){
    var ord=Math.random();
    // element 추가
    var link = document.createElement("link");
    // href 어트리뷰트에 경로 추가
    if(randomUse){
        link.href = cssFilePath + '?v=' + ord;
    }else{
        link.href = cssFilePath;
    };
    // 비동기식이 아닌 동기식으로 한다.
    link.async = false;
    // style일의 기본 어트리뷰트 추가
    link.rel = "stylesheet";
    link.type = "text/css";
    // 헤더에 추가
    document.head.appendChild(link);
};
var loadScript = loadScript || function(url, callback)
{
    // adding the script tag to the head as suggested before
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    // then bind the event to the callback function 
    // there are several events for cross browser compatibility
    script.onreadystatechange = callback;
    script.onload = callback;
    // fire the loading
    head.appendChild(script);
};
/* edge로 이동 함수(기존창 닫힘) */
var moveEdge = function(){
    window.location = 'microsoft-edge:http:' + IV_LOCATION_HOSTNAME + IV_LOCATION_HREF.split(IV_LOCATION_HOSTNAME)[1].trim();
    setTimeout(function(){
        top.window.opener = top; 
        top.window.open('','_parent', ''); 
        top.window.close();
    },3000);
};

/* ================================================================================================================================================== */
/** ================================================================================================================================================= 
 * 접속한 기기/브라우저 정보 (iv_userAgentChk통해 확인)
 * @ IV_DEVICE_CHK : PC/MO
 * @ IV_BROWSER_CHK : iphone/not-iphone, ie, chrome ... etc
 */
var IV_DEVICE_CHK;
var IV_BROWSER_CHK;
/**
 * userAgetn Check 
 * iv_userAgentChk.__userAgent : 현재 접속 기기 관련 정보 ex 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
 * deviceChk : PC or mobile 
 * browserChk : 브라우저 체크 (ie, edge, whale ...)
 */
var iv_userAgentChk = {
    __userAgent: navigator.userAgent,
    deviceChk: function () {
        var e;
        return e = "m." == IV_LOCATION_HOSTNAME.substr(0, 2) || "mobile--shop" == IV_LOCATION_HOSTNAME.substr(0, 12) || "skin-mobile" == IV_LOCATION_HOSTNAME.substr(0, 11) ? "mobile" : "pc", IV_DEVICE_CHK = e, e
    },
    browserChk: function () {
        var e, t = iv_userAgentChk.__userAgent;
        return "pc" == iv_userAgentChk.deviceChk() ? t.indexOf("Trident") > -1 ? e = "ie" : t.indexOf("Edg") > -1 ? e = "edge" : t.indexOf("Whale") > -1 ? e = "whale" : t.indexOf("Opera") > -1 || t.indexOf("OPR") > -1 ? e = "opera" : t.indexOf("Firefox") > -1 ? e = "firefox" : t.indexOf("Safari") > -1 && -1 == t.indexOf("Chrome") ? e = "safari" : t.indexOf("Chrome") > -1 && (e = "chrome") : e = t.match(/iPad/i) || t.match(/iPhone/i) ? "iphone" : "not-iphone", IV_BROWSER_CHK = e, iv_userAgentChk.appChk(), e
    },
    appChk: function () {
        var e = null;
        return e = iv_userAgentChk.__userAgent.indexOf("Cafe24Plus") > -1 ? "app" : "pc" == IV_DEVICE_CHK ? "pc-web" : "mobile-web", IV_TYPE_CHK = e, e
    }
};
iv_userAgentChk.browserChk();
/* ================================================================================================================================================== */
/** ================================================================================================================================================= 
 * 창 정보
 */
var IV_vh = IV_vh || 0;
var IV_vh2 = IV_vh2 || 0;
var IV_vw = IV_vw || (window.innerWidth * 0.01);
var IV_topHeight = IV_topHeight || 0;
/**
 * swiper custom Array -> 커스텀 swiper array 
 */
var IV_SwiperCustomArray = IV_SwiperCustomArray || [];
/**
 * property setting -> css변수 생성 지정 설정 
 */
var IVSetPropertyArray = IVSetPropertyArray || [
    {name : 'topBanner', element : '#base_topBanner_container'},
    {name : 'header', element : '#base_header_container'},
    {name : 'gnb', element : '#base_header_container .gnb'},
    {name : 'footer', element : '#base_footer_container'},
];
/* ================================================================================================================================================== */
/**
 * util function -> util 영역
 */
var iv_util = iv_util || {
    getParameterByName: function (href, name) {
        /**
         * 파라미터 name에 할당된 값 출력
         * @href 기준 주소 
         * @name 파라미터 name
         * result type string
         */
        try {
            name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
            var regexS = "[\\?&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(href);
            if (results == null) {
                return '';
            } else {
                return decodeURIComponent(results[1].replace(/\+/g, " "));
            };
        } catch (err) {
            console.log(err);
            return '';
        };
    },
    getURLParameters: function (href, name) {
        /**
         * 파라미터 name에 할당된 값 출력
         * @href 기준 주소 
         * @name 파라미터 name
         * name 없을 경우 전체 파라미터를 object 형태로 출력, name있을 경우 해당 name에 할당된 값만 string으로 출력 (name 지정의 경우 getParameterByName와 유사함)
         * result type object/string
         */
        try {
            var result = {};
            href.replace(/[?&]{1}([^=&#]+)=([^&#]*)/g, function(s, k, v) { result[k] = decodeURIComponent(v); });
            if(typeof name !== 'undefined'){
                if(result[name]){
                    return result[name];
                }else{
                    result = '';
                    return result;
                };
            }else{
                return result;
            };
        } catch (err) {
            console.log(err);
            return '';
        };
    },
    getUrl : function(href){
        if(typeof href === 'undefined'){
            IV_LOCATION_HREF = window.location.href; /* 현재 주소줄 전체 */
            IV_LOCATION_HOSTNAME = window.location.hostname; /* 현재 주소 기준 hostname */
            IV_LOCATION_PATHNAME = window.location.pathname; /* 현재 주소 기준 pathname */
            IV_LOCATION_PROTOCOL = window.location.protocol; /* 현재 주소 기준 protocol */
            IV_LOCATION_PARAMETERS = ((window.location.search == '') ? '' : window.location.search.split('?')[1]); /* 현재 주소 기준 parameters */
        }else{
            if(href.indexOf('?') > -1){
            	return [href.split('?')[0], href.split('?')[1]];
            }else{
            	return href;
            }
        }
    },
    comma: function (str) {
        /**
         * 숫자 comma 찍어주는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
        } catch (err) {
            console.log(err); 
            return str;
        };
    },
    uncomma: function (str) {
        /**
         * 숫자 comma 제거하는 함수
         * @str string
         * result type number
         */
        try {
            str = String(str);
            return Number(str.replace(/[^\d]+/g, ''));
        }
        catch (err) {
            console.log(err); 
            return str;
        }
    },
    checkAvailability : function(arr, val){
        /**
         * 배열 중에 특정 값이 존재하는지 여부 
         * @arr array 
         * @val value
         * result type boolean
         * error result : null
         */
        try {
            return arr.some(function(arrVal) {
                return val === arrVal;
            });
        } catch (err) {
            console.log(err); 
            return null;
        };
    },
    onlyNumbFunc : function(str){
        /**
         * 숫자만 남기는 함수
         * @str string
         * result type number
         */
        try {
            str = String(str);
            var reg = /[^0-9]/g;
            if(reg.test(str)){
                return Number(str.replace(reg,'').trim());
            }else{
                return Number(str);
            };
        } catch (err) {
            console.log(err); 
            return str;
        };
    }, 
    removeNumbFunc : function(str){
        /**
         * 숫자만 제거하는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            var reg = /[0-9]/g;
            if(reg.test(str)){
                return str.replace(reg,'').trim();
            }else{
                return str;
            };
        } catch (err) {
            console.log(err); 
            return str;
        };
    }, 
    removeDashFunc : function(str){
        /**
         * 대시 제거하는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            var reg = /\-/g;
            if(reg.test(str)){
                return str.replace(reg,'').trim();
            }else{
                return str;
            };
        } catch (err) {
            console.log(err); 
            return str;
        };
    },
    removeBlankFunc : function(str){
        /**
         * 공백 전체 제거하는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            var reg = / /g;
            if(reg.test(str)){
                return str.replace(reg,'').trim();
            }else{
                return str;
            };
        } catch (err) {
            console.log(err); 
            return str;
        };
    },
    removeEnterFunc : function(str){
        /**
         * 엔터문자 전체 제거하는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            var reg = /(\r\n|\n|\r)/gm;
            if(reg.test(str)){
                return str.replace(reg,'').trim();
            }else{
                return str;
            }
        } catch (err) {
            console.log(err); 
            return str;
        };
    },
    roundDown : function(number, decimals){
        /**
         * 특정 자리 수에서 버림 처리  
         * @number number
         * @decimals 자리수 (0,-1,-2...)
         * result type number
         */
        try {
            decimals = decimals || 0;
            return ( Math.floor( number * Math.pow(10, decimals) ) / Math.pow(10, decimals) );
        } catch (err) {
            console.log(err); 
            return number;
        };
    },
    roundUp : function(number, decimals){
        /**
         * 특정 자리 수에서 올림 처리  
         * @number number
         * @decimals 자리수 (0,-1,-2...)
         * result type number
         */
        try {
            decimals = decimals || 0;
            return ( Math.ceil( number * Math.pow(10, decimals) ) / Math.pow(10, decimals) );
        } catch (err) {
            console.log(err); 
            return number;
        };
    },
    round : function(number, decimals){
        /**
         * 특정 자리 수에서 반올림 처리  
         * @number number
         * @decimals 자리수 (0,-1,-2...)
         * result type number
         */
        try {
            decimals = decimals || 0;
            return ( Math.round( number * Math.pow(10, decimals) ) / Math.pow(10, decimals) );
        } catch (err) {
            console.log(err); 
            return number;
        };
    },
    removeSpecialChars : function(str){
        /**
         * 특수문자 제거하는 함수
         * @str string
         * result type string
         */
        try {
            str = String(str);
            var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
            if(reg.test(str)){
                return str.replace(reg,'').trim();
            }else{
                return str;
            };
        } catch (err) {
            console.log(err); 
            return str;
        };
    },
    makeDimmed : function(e,t,n){
        /**
         * dimmed 영역 생성 함수
         * @e dimmed 영역 붙는 타이밍 true append -> addClass / false addClass -> append
         * @t dimmed number 
         * @n 노출되는 elemenet
         */
        if (arguments.length > 0) {
            let i = typeof arguments[0];
            "number" === i ? (e = !0, t = arguments[0], void 0 !== arguments[1] && (n = arguments[1])) : "object" === i ? (e = !0, t = 0, n = arguments[0]) : (t = t || 0, n = n || null)
        } else e = !0, t = 0, n = null;
        if (0 == IV$(".iv_dimmed_" + t).length) {
            let i = IV$('<div class="iv_dimmed_' + t + '"></div>');
            !1 === e ? (i.addClass("on"), IV$("body").append(i)) : (IV$("body").append(i), setTimeout(function () {
                i.addClass("on")
            }, 0)), i.on("click", function () {
                IV$('.ec-base-layer, [class*="iv_"][class*="_layer"], .ec-base-tooltip, .iv_base_tooptip').filter(".on").removeClass("on"), null !== n && EC$(n).children('[class*="close"], [class*="Close"], [class*="delete"]').trigger("click"), iv_util.removeDimmed(e)
            });
        };
    },
    removeDimmed : function(e){
        /**
         * dimmed 영역 제거 함수
         * @e dimmed 영역 붙는 타이밍 true remove -> removeClass / false removeClass -> remove
         */
        let t = IV$('[class*="iv_dimmed"]');
        if(t.length > 0){
            function n() {
                t.remove()
            }!1 === (e = e || !0) ? t.remove() : "all 0s ease 0s" == t.css("transition") ? (t.removeClass("on"), n()) : (t[0].addEventListener("transitionend", n), t.removeClass("on"));
        }else{
            return false;
        }
    },
    scrollDisabled : function(e,t){
        /**
         * 스크롤 막기 
         * @e 노출되는 element
         * @t dimmed 노출 여부
         */
        if (arguments.length > 0) {
            "object" !== typeof arguments[0] ? (t = arguments[0], e = null) : (e = e || null, t = t || !0)
        } else t = !0, e = null;
        iv_util.scrollDisabled.object = iv_util.scrollDisabled.object || [];
        let n = iv_util.scrollDisabled.object;
        null !== e && (n.push(e), e[0].iv_openCustomFunction && -1 == String(e[0].iv_openCustomFunction).indexOf("scrollDisabled") && e[0].iv_openCustomFunction());
        const i = topDocument;
        topDocument.querySelector("body");
        if (0 == i.classList.contains("noscroll")) {
            var r = window.pageYOffset;
            i.classList.add("noscroll"), i.style.top = -1 * r + "px", !1 !== t && (iv_util.makeDimmed(), IV$('[class*="iv_dimmed_"]').on("click", function () {
                iv_util.scrollEnabled()
            }));
        };
    },
    scrollEnabled : function(e){
        /**
         * 스크롤 풀기
         * @e  노출되는 element
         */
        if (null !== (e = e || null)) e[0].iv_closeCustomFunction ? -1 == String(e[0].iv_closeCustomFunction).indexOf("scrollEnabled") && e[0].iv_closeCustomFunction() : IV$(e).removeClass("on active");
        else {
            iv_util.scrollDisabled.object = iv_util.scrollDisabled.object || [];
            let e = iv_util.scrollDisabled.object;
            0 != e.lenegth && e.forEach(function (t, n) {
                t[0].iv_closeCustomFunction ? -1 == String(t[0].iv_closeCustomFunction).indexOf("scrollEnabled") && t[0].iv_closeCustomFunction() : IV$(t).removeClass("on active"), e.splice(n, 1)
            });
        };
        const t = topDocument;
        if (t.classList.contains("noscroll")) {
            topDocument.querySelector("body");
            var n = Math.abs(t.style.getPropertyValue("top").replace("px", ""));
            t.classList.remove("noscroll"), t.style.removeProperty("top"), window.scrollTo(0, n), IV$('[class*="iv_dimmed_"]').length > 0 && iv_util.removeDimmed()
        };
    },
    layerOpenFunc : function(e, t, n){
        /**
         * iv_layer 여는 함수
         * 클릭 ele에 data-layer값 필수(팝업 id, class등 구분값) : 열려야 하는 팝업 구분값
         * addClass on 형태 -> css 작업 필요함
         * 레이어 영역 외 클릭 시 닫힘 처리
         * @e button 
         * @t dimmed 생성 여부
         * @n scroll 고정 여부 
         */
        try {
            var i = e.getAttribute("data-layer"),
                r = IV$(i),
                o = r.attr("class");
            o = (o = o.indexOf("on") ? o.replace("on", "") : o).indexOf("active") ? o.replace("active", "") : o, IV$(o = "." + o).not(r).removeClass("on active"), r.addClass("on"), t = t || !1, !1 === (n = n || !1) ? !0 === t ? iv_util.scrollDisabled(IV$(i), !0) : iv_util.scrollDisabled(IV$(i), !1) : !0 === t ? iv_util.makeDimmed(IV$(i)) : iv_util.targetOutCloseFunc(IV$(i))
        } catch (e) {
            console.log(e)
        };
    },
    layerCloseFunc: function(e){
        /**
         * iv_layer 닫는 함수
         * 클릭 ele에 data-layer값 필수(팝업 id, class등 구분값) : 닫혀야 하는 팝업 구분값
         * removeClass on 형태 -> css 작업 필요함
         * @e button 
         */
        try {
            var layer = e.getAttribute('data-layer');
            IV$(layer).removeClass('on');
        } catch (err) {
            console.log(err); 
        };
    },
    targetOutCloseFunc : function(e, t){
        /**
         * classname으로 지정한 영역 외 클릭 시, classname 요소 닫힘 처리 함수
         * @e element
         * @t callback function 
         */
        setTimeout(function () {
            if (e) try {
                var n = IV$(e),
                    i = n.attr("class"),
                    r = null;
                if (void 0 !== i)(i = (i = i.indexOf("on") ? i.replace("on", "") : i).indexOf("active") ? i.replace("active", "") : i).indexOf(/ /gi) > -1 && (i = i.replace(/ /gi, ".")), i = "." + i, r = $(i);
                else {
                    var o = n.attr("id");
                    void 0 !== o ? r = $('[id^="' + o + '"]').not(n) : n.siblings().length > 0 && (r = n.siblings())
                };
                IV$("body").one("click", function (i) {
                    if (n.hasClass("on") || n.hasClass("active")) {
                        var o = IV$(i.target);
                        (i.target == e || o.parents().filter(n).length > 0) && !o.attr("data-layer") ? (null !== r && r.not(n).removeClass("on active"), iv_util.targetOutCloseFunc(n)) : void 0 !== t ? "all 0s ease 0s" == n.css("transition") ? (n.removeClass("on active"), t()) : (n[0].addEventListener("transitionend", t), n.removeClass("on active")) : n.removeClass("on active")
                    };
                })
            } catch (e) {
                console.log(e)
            };
        }, 0)
    },
    arrayUnique : function(arr){
        /**
         * 배열 항목 unique만 남기는 함수
         * @arr array
         */
        try {
            arr = 
                arr.reduce(function(acc,curr,index){
                acc.indexOf(curr) > -1 ? acc : acc.push(curr);
                return acc;
            },[]);
            return arr;
        } catch (err) {
            console.log(err); 
        };
    },
    checkBatchimEnding : function(str){
        /**
         * 한글 끝자리에 받침 있는지 확인 
         * true 받침있음 false 받침없음
         * @str string
         */
        try {
            if (typeof str !== 'string') return null;
            var lastLetter = str[str.length - 1];
            var uni = lastLetter.charCodeAt(0);
            if (uni < 44032 || uni > 55203) return null;
            return (uni - 44032) % 28 != 0;
        } catch (err) {
            console.log(err); 
        };
    },
    floatingBox : function (el1, el2){
        /**
         * 스크롤 
         * el1 기준점이 될 전체 영역
         * el2 //스크롤 시 따라다닐 영역
         */
        IV$(window).scroll(function(){srollFunc();});
        if(IV$(window).scrollTop() > 0){srollFunc();}
        function srollFunc(){
            var setScollStandard = el1.outerHeight();
            var infoBoxHeight = el2.outerHeight();
            var headerHeight = IV$('header').outerHeight() + 40;
            el2.find('[data-fixed="true"]').css('top',headerHeight);
            el1.css('min-height',infoBoxHeight);
            if(setScollStandard > infoBoxHeight){
                var scrollStartOffsetTop = el1.offset().top -headerHeight;
                var offSetMax = setScollStandard + scrollStartOffsetTop - infoBoxHeight;
                var winTop = IV$(window).scrollTop();
                if(winTop < offSetMax){
                    if(winTop < scrollStartOffsetTop){
                        el2.find('[data-fixed="true"]').removeClass('fixed');
                    }else{
                        el2.find('[data-fixed="true"]').addClass('fixed').removeClass('max');
                    };
                }else{
                    el2.find('[data-fixed="true"]').addClass('fixed max');
                };
            };
        };
    },
    execDaumPostcode : function(e, t){
        /**
         * 다음 우편번호 팝업 함수 
         * @e : data-layer / .content / data-addr=true 3가지 항목 필요
         * [data-addr-type="zipcode"] zipcode
         * [data-addr-type="raddr1"] addr1
         * [data-addr-type="raddr2"] addr2
         * @t page 구분
         */
        if(typeof IV_ZIPCODE_LAYER_THEME_FOR_DAUMKAKAO === 'undefined'){
            var IV_ZIPCODE_LAYER_THEME_FOR_DAUMKAKAO = {
                bgColor: "#FAFAFA", //바탕 배경색
                //searchBgColor: "", //검색창 배경색
                //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
                //pageBgColor: "", //페이지 배경색
                textColor: "#000000", //기본 글자색
                //queryTextColor: "", //검색창 글자색
                postcodeTextColor: "#EB3300" //우편번호 글자색
                //emphTextColor: "", //강조 글자색
                //outlineColor: "", //테두리
            };
        }
        var theme = IV_ZIPCODE_LAYER_THEME_FOR_DAUMKAKAO;
        // 우편번호 찾기 찾기 화면을 넣을 element
        var n = e.getAttribute("data-layer"),
            i = document.querySelector(n).querySelector(".content"),
            r = IV$(e).closest('[data-addr="true"]');
        Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function (e) {
                var n = "",
                    i = "";
                n = "R" === e.userSelectedType ? e.roadAddress : e.jibunAddress, "R" === e.userSelectedType && ("" !== e.bname && /[동|로|가]$/g.test(e.bname) && (i += e.bname), "" !== e.buildingName && "Y" === e.apartment && (i += "" !== i ? ", " + e.buildingName : e.buildingName), "" !== i && (i = " (" + i + ")")), void 0 !== iv_util.execDaumPostcode.selectBefore ? iv_util.execDaumPostcode.selectBefore.execute(r, e, n, i) : (r.find('[data-addr-type="zipcode"]').val(e.zonecode), r.find('[data-addr-type="addr1"]').val(n + " " + i), r.find('[data-addr-type="addr2"]').val("").focus(), "orderform" === t && EC_SHOP_FRONT_ORDERFORM_SHIPPING.exec(), void 0 !== iv_util.execDaumPostcode.selectAfter && iv_util.execDaumPostcode.selectAfter.execute()), iv_util.scrollEnabled()
            },
            onsearch: function (e) {},
            theme: theme,
            onresize: function (e) {
                i.style.height = e.height + 30 + "px", document.querySelector(n).classList.add("on"), iv_util.scrollDisabled(IV$(n))
            },
            width: "100%",
            height: "100%"
        }).embed(i)
    },
    optionTxt : function(e){
       /**
        * 옵션명에서 추가금/대괄호 제거
        * @e element
        */
        e.find(".option_str_txt").each(function () {
            var e = IV$(this);
            e.text(e.text().slice(1, e.text().length - 1)), e.text().indexOf("(+") > -1 ? e.text(e.text().split("(+")[0].trim()) : e.text().indexOf("(-") > -1 && e.text(e.text().split("(-")[0].trim())
        })
    },
    tablePrc : function(e){
        /**
         * 상품테이블에서 가격 출력
         * @e element
         */
        var t = e.find(".td_prc"),
            n = t.find('[title="판매가"]'),
            i = t.find('[title="최종가"]'),
            r = e.find('input[id^="quantity_id_"]').val();
        void 0 === r && (r = 0 == e.find(".qty_text").length ? iv_util.uncomma(e.find(".qty-text").text()) : e.find(".qty_text").text());
        var o = r * Number(iv_util.uncomma(n.children("strong").text())),
            a = r * Number(iv_util.uncomma(i.children("strong").text()));
        e.find(".fin_prc > strong").text(iv_util.comma(a)), e.find(".default_prc").text(iv_util.comma(o)), a < o && (e.find(".default_prc").removeClass("displaynone"), e.find(".default_prc").hasClass("discount") || e.find(".default_prc").addClass("discount"))
    },
    IntersectionObserver : function(e, t, n){
        /**
         * viewport 감지
         * @e element
         * @t option
         * @n callback function
         */
        let i, r;
        (i = "string" == typeof e ? document.querySelectorAll(e) : e).forEach(function (e, i) {
            let o = IV$(e).css("top");
            "auto" == o && (o = IV_topHeight);
            let a = -1 * iv_util.onlyNumbFunc(o) - 1,
                s = -1 * Math.round(100 * IV_vh + a - 2);
            a = a + 'px';
            s = s + 'px';
            if(typeof t !== 'undefined'){
                r = t;
            }else{
                r = {
                    root: null,
                    rootMargin: a + " 0px " + s + " 0px",
                    threshold: [0]
                };
            };
            const l = new IntersectionObserver(function (e, t) {
                e.forEach(function (i) {
                    !0 === i.isIntersecting ? IV$(i.target).addClass("iv-isIntersecting") : IV$(i.target).removeClass("iv-isIntersecting"), n(i, t, e, l)
                });
            }, r);
            l.observe(e);
        });
    },
    debounce : function(callback, limit) {
        /**
         * debounce
         * @callback 실행할 함수
         * @limit 실행 기준 시간
         */
        let timeout;
        return function(arguments) { clearTimeout(timeout); timeout = setTimeout(function() { callback.apply(this, arguments); }, limit); }
    },
    throttle : function(callback, limit) {
        /**
         * debounce
         * @callback 실행할 함수
         * @limit 실행 기준 시간
         */
        let waiting = false;
        return function() {
            if(!waiting) {
                callback.apply(this, arguments);
                waiting = true;
                setTimeout(function() {
                    waiting = false;
                }, limit);
            };
        };
    },
    hexToRgb : function(e) {
        /**
         * hex -> rgb 전환 (축약/#포함미포함/확장형 모두 전환)
         * Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
         * @e = hex code
         */
        e = e.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, function (e, t, n, i) {
            return t + t + n + n + i + i
        });
        var t = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);
        return t ? {
            r: parseInt(t[1], 16),
            g: parseInt(t[2], 16),
            b: parseInt(t[3], 16)
        } : null
    },
    rgbToHex : function(e, t, n) {
        /**
         * rgb -> hex 전환 
         * @e red color value(number or string) ex 250
         * @t green color value(number or string) ex 250
         * @n blue color value(number or string) ex 250
         */
        return "#" + (16777216 + (e << 16 | t << 8 | n << 0)).toString(16).slice(1);
    },
    getComments : function(e){
        /**
         * 주석 내용 가져오기
         * @e element
         */
        let t = [];
        return e.contents().filter(function () {
            if (8 == this.nodeType) {
                let e = iv_util.removeBlankFunc(this.nodeValue);
                t.push(e)
            }
        }), t;
    },
    getCommentParam : function(e, t){
        /**
         * 주석 변수 name에 따라 출력
         * @e 주석
         * @t name
         */
        try {
            t = t.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var n = new RegExp("[\\$@]" + t + "=([^$@]*)").exec(e);
            return null == n ? "" : decodeURIComponent(n[1].replace(/\+/g, " "))
        } catch (e) {
            return console.log(e), ""
        };
    },
    getTime : function(date, type, type2){
        /**
         * 시간 가져오기 
         * @date 기준 날짜 (없을 경우 오늘 날짜) / type array 
         * @type 출력 타입 time or array
         * @type2 출력할 단계 1 날짜 + 시간 / 2 날짜 + 시간 + 분 / 3 날짜 + 시간 + 분 + 초 / else 날짜 
         */
        var today = new Date();
        type2 = String(type2);
        var basic = ['','','','','',''];
        date = IV$.extend(basic,date);
        if(date !== false){
            if(type2 === '1'){
                //날짜 + 시간
                if(type === 'time'){
                    date = new Date(date[0], date[1] -1, date[2], date[3], 00,00);
                    return date;
                }else{
                    return [date[0],date[1],date[2],'',''];
                };
            }else if(type2=='2'){
                //날짜 + 시간 + 분
                if(type === 'time'){
                    date = new Date(date[0], date[1] -1, date[2], date[3], date[4], 00);
                    return date;
                }else{
                    return [date[0],date[1],date[2],date[3],''];
                };
            }else if(type2 == '3'){
                //날짜 + 시간 + 분 + 초
                if(type === 'time'){
                    date = new Date(date[0], date[1] -1, date[2], date[3], date[4], date[5]);
                    return date;
                }else{
                    return [date[0],date[1],date[2],date[3],date[4],date[5]];
                };
            }else{
                //그 외 값이면 날짜까지만
                if(type === 'time'){
                    date = new Date(date[0], date[1] -1, date[2],00,00,00);
                    return date;
                }else{
                    return [date[0],date[1],date[2],'','',''];
                };
            };
        }else{
            date = today;
            var year = String(date.getFullYear());
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            var hours = ('0' + date.getHours()).slice(-2); 
            var minutes = ('0' + date.getMinutes()).slice(-2);
            var seconds = ('0' + date.getSeconds()).slice(-2); 
            if(type2 === '1'){
                //날짜 + 시간
                if(type === 'time'){
                    date = new Date(year, date.getMonth(), day, hours, 00,00);
                    return date;
                }else{
                    return [year, month, day, hours, '', ''];
                };
            }else if(type2=='2'){
                //날짜 + 시간 + 분
                if(type === 'time'){
                    date = new Date(year, date.getMonth(), day, hours, minutes,00);
                    return date;
                }else{
                    return [year, month, day, hours, minutes, ''];
                };
            }else if(type2 == '3'){
                //날짜 + 시간 + 분 + 초
                if(type === 'time'){
                    date = new Date(year, date.getMonth(), day, hours, minutes,seconds);
                    return date;
                }else{
                    return [year, month, day, hours, minutes, seconds];
                };
            }else{
                //그 외 값이면 날짜까지만
                if(type === 'time'){
                    date = new Date(year, date.getMonth(), day, 00, 00,00);
                    return date;
                }else{
                    return [year, month, day, '', '', ''];
                };
            };
        };
    },
    getServerTime : function(){
        /**
         * 서버 시간 가져오기 
         */
        return new Promise(function (e, t) {
            $.get("https://ododoc.kr/api_return_cur_time", function (n) {
                if (n) {
                    var i = n.serverTime.split(" "),
                        r = i[0].split("-"),
                        o = i[1].split("-"),
                        a = r[0],
                        s = ("0" + r[1]).slice(-2),
                        l = ("0" + r[2]).slice(-2),
                        c = ("0" + o[0]).slice(-2),
                        u = ("0" + o[1]).slice(-2),
                        d = ("0" + o[2]).slice(-2),
                        f = [new Date(a, Number(s) - 1, l, c, u, d), a, s, l, c, u, d];
                    e(f);
                };
                t(new Error("Request is failed"))
            });
        });
    },
    replaceAt : function(e, t, n){
        /**
         * 특정 자리 수 기준으로 replace
         * @e string
         * @t 자리수
         * @n 변경할 텍스트 
         */
        return e.substr(0, t) + n + e.substr(t + n.length);
    },
    betweenDateGapCalc : function(stDate, endDate){
        /**
         * 날짜 사이 gap 구하는 함수 
         * 특수문자 포함 시 특수문자 기준으로 split / 없을 경우 자리수 기준으로 뜯기
         * yyyy-mm-dd-hh-mm-ss 양식
         * @stDate 시작일
         * @endDate 종료일
         */
        var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
        let sTime;
        let eTime; 
        if(typeof stDate === 'string'){
            if(reg.test(stDate)){
                stDate = stDate.split(reg);
            }else{
                stDate = [stDate.substr(0,4), stDate.substr(4,2), stDate.substr(6,2), stDate.substr(8,2), stDate.substr(10,2), stDate.substr(12,2)];   
            };
            sTime = new Date(stDate[0], stDate[1] -1, stDate[2], stDate[3], stDate[4], stDate[5]);
        }else{
            if(Array.isArray(stDate)){
                sTime = new Date(stDate[0], stDate[1] -1, stDate[2], stDate[3], stDate[4], stDate[5]);
            }else{
                sTime = stDate;
            };
        };
        if(typeof endDate === 'string'){
            if(reg.test(endDate)){
                endDate = endDate.split(reg);
            }else{
                endDate = [endDate.substr(0,4), endDate.substr(4,2), endDate.substr(6,2), endDate.substr(8,2), endDate.substr(10,2), endDate.substr(12,2)];   
            };
            eTime = new Date(endDate[0], endDate[1] -1, endDate[2], endDate[3], endDate[4], endDate[5]); 
        }else{
            if(Array.isArray(endDate)){
                eTime = new Date(endDate[0], endDate[1] -1, endDate[2], endDate[3], endDate[4], endDate[5]); 
            }else{
                eTime = endDate;
            };
        };
        var dateGap = eTime.getTime() - sTime.getTime();
        var timeGap = new Date(0, 0, 0, 0, 0, 0, eTime - sTime); 
        var diffDay  = Math.floor(dateGap / (1000 * 60 * 60 * 24)); // 일수       
        var diffHour = timeGap.getHours();       // 시간
        var diffMin  = timeGap.getMinutes();      // 분
        var diffSec  = timeGap.getSeconds();      // 초
        var result = [dateGap, diffDay, diffHour, diffMin, diffSec];
        return result;
    },
    viewtestCondition : function(condition, callback){
        /**
         * 테스트 컨디션으로 보기 위한 함수
         * @condition 추가조건 / true/false
         * @callback function
         */
        if(typeof IV_TEST_CONDITION_ARRAY !== 'undefined'){
            if(condition){
                IV_TEST_CONDITION_ARRAY.some(function(e,i){
                    if(IV_MEMBER_ID == e){
                        if(typeof callback !== 'undefined'){
                            callback();
                        }
                    }
                });
            }
        }
    },
    getDeepestChild : function(param) {
        /**
         * 가장 깊은 단계 자식 요소 return 
         * @param element
         */
        var element_list = IV$(param);
        var depth = 0;
        var deepest_element;
        ( findChildren = function(){
            if(element_list.children().length == 0){
                deepest_element = element_list;
            }else{
                if(element_list.children().children().length > 0){
                    element_list = element_list.children();
                    findChildren();
                }else{
                    deepest_element = element_list.children();
                };
            };
        })();
        return deepest_element;
    },
    setCookie : function(name, value, exp){
        var date = new Date();
        date.setTime(date.getTime() + exp*24*60*60*1000);
        document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
    },
    getCookie : function(name){
        var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return value? value[2] : null;
    },
    deleteCookie : function(name){
        document.cookie = name + '=; expires=Thu, 01 Jan 1999 00:00:10 GMT;path=/';
    },
};


/**
 * extend 
 */
var IV_SWIPE_NUM = IV_SWIPE_NUM || 0;
IV$.fn.extend({
    /**
     * 기본 swiper 생성 -> data-custom = false인 경우 생성
     */
    iv_swiperFunc : function(options){
        this.each(function(i, x){
            let classList = x.classList, 
                $x = IV$(x),
                config = {};
            if(typeof options === 'undefined'){
                if(typeof IV_SwiperBasicOption !== 'object'){
                    config = {
                        slidesPerView : 'auto',
                        spaceBetween : 0,
                        speed : 300,
                    };
                }else{
                    config = Object.assign({}, IV_SwiperBasicOption);
                };
            }
            if(classList.contains('ivswipe-done') === false){
                let dataSet = x.dataset,
                    dataSetKeyArray = Object.keys(dataSet),
                    name = (typeof dataSet['ivswipeName'] !== 'undefined') ? dataSet['ivswipeName'] : 'tempName' + String(IV_SWIPE_NUM),
                    custom = dataSet['ivswipeCustom'],
                    module = dataSet['ivswipeModule'],
                    connect = dataSet['ivswipeConnect'];
                name = (name.indexOf('ivswipe_') > -1) ? name.split('ivswipe_')[1].trim() : name;
                if(typeof window['ivswipe_'+name] !== 'undefined'){
                	name = 'tempName' + String(IV_SWIPE_NUM);
                }
                IV_SWIPE_NUM++;
                let ivswiper = null,
                    $baseSwiperContainer,
                    $swiperContainer,
                    $swiperSlide;
                if(classList.contains('ivswipe-init')){
                    $baseSwiperContainer = $x.closest('.base_swiper_container');
                    $swiperContainer = $x.parent('.swiper-container');
                    $swiperSlide = $x.children();
                    ivswiper = window['ivswipe_' + name];
                    if(typeof ivswiper !== 'undefined'){
                        ivswiper.init();
                    }else{
                        makeIvSwiper();
                    }
                }else{
                    $baseSwiperContainer = $x.parent().addClass('base_swiper_container');
                    $swiperSlide = $x.children().addClass('swiper-slide');
                    $x.wrap('<div class="swiper-container"></div>');
                    $swiperContainer = $x.closest('.swiper-container');
                    $x.addClass('ivswipe-init swiper-wrapper');
                    if(typeof module !== 'undefined' && module !== ''){
                        module = (module.indexOf(',') > -1) ? module.split(',') : [module];
                        module.forEach(function(e,i){
                            switch(e.trim()){
                                case 'scrollbar' :
                                    let $scrollbar;
                                    if($baseSwiperContainer.find('.base_swiper_scrollbar').length == 0){
                                        $scrollbar = IV$('<div class="base_module_container base_swiper_scrollbar"><div class="swiper-scrollbar"></div></div>');
                                        $baseSwiperContainer.append($scrollbar);
                                    }
                                    config['scrollbar'] = {el: $baseSwiperContainer.find('.swiper-scrollbar')[0],hide: false};
                                    break;
                                case 'pagination' :
                                    let $pagination;
                                    if($baseSwiperContainer.find('.base_swiper_pagination').length ==0){
                                        $pagination = IV$('<div class="base_module_container base_swiper_pagination"><div class="swiper-pagination"></div></div>');
                                        $baseSwiperContainer.append($pagination);
                                    }
                                    config['pagination'] = {el: $baseSwiperContainer.find('.swiper-pagination')[0],clickable: true}; 
                                    break;
                                case 'navigation' :
                                    let $navigation;
                                    if($baseSwiperContainer.find('.base_swiper_navigation').length == 0){
                                        $navigation = IV$('<div class="base_module_container base_swiper_navigation"><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>');
                                        $baseSwiperContainer.append($navigation);
                                    }
                                    config['navigation'] = {
                                        nextEl: $baseSwiperContainer.find('.base_swiper_navigation .swiper-button-next')[0],
                                        prevEl: $baseSwiperContainer.find('.base_swiper_navigation .swiper-button-prev')[0]};
                                    break;
                                case 'progressbar' :
                                    let $progressbar;
                                    if($baseSwiperContainer.find('.base_swiper_pagination').length == 0){
                                        $progressbar = IV$('<div class="base_module_container base_swiper_pagination"><div class="swiper-pagination"></div></div>');
                                        $baseSwiperContainer.append($progressbar);
                                    }
                                    config['pagination'] = {el: $baseSwiperContainer.find('.swiper-pagination')[0],type: 'progressbar'};
                                    break;
                                case 'fraction' :
                                    let $fraction;
                                    if($baseSwiperContainer.find('.base_swiper_pagination').length == 0){
                                        $fraction = IV$('<div class="base_module_container base_swiper_pagination"><div class="swiper-pagination"></div></div>');
                                        $baseSwiperContainer.append($fraction);
                                    }
                                    config['pagination'] = {el: $baseSwiperContainer.find('.swiper-pagination')[0],type: 'fraction'};
                                    break;
                                default : 
                                    break;
                            }
                        });
                    }
                    makeIvSwiper();
                }
                /**
                 * swiper 생성 방법
                 * 1) IV_SwiperCustomArray -> {swiperName : 스와이퍼구분명, swiperOption : 스와이퍼 실행 옵션} 형태로 push
                 * 2) html 마크업에 data 속성으로 요소 넣는다
                 * 3) 직접 swiper option을 넣는다 ex $mainContent.addClass('iv_swiper').iv_swiperFunc(config);
                 */
                function makeIvSwiper(){
                    if(custom === 'true'){
                        if(typeof options !== 'undefined'){
                            config = IV$.extend(config,options);
                        }else{
                            IV_SwiperCustomArray.forEach(function(e,i){
                                if(e.swiperName == name){
                                    var options = e.swiperOption;
                                    config = IV$.extend(config,options);
                                }
                            });
                        }
                    }else{
                        let ivSwiperDataArray=dataSetKeyArray.reduce(function(acc,e,i,arr){
                            if(e.indexOf('ivswipe')>-1&&e.indexOf('ivswipeName')==-1&&e.indexOf('ivswipeCustom')==-1&&e.indexOf('ivswipeConnect')==-1&&e.indexOf('ivswipeModule')==-1){
                                let option=e.split('ivswipe')[1];option=option.replace(option[0],option[0].toLowerCase());
                                let value=dataSet[e];let numberValue=Number(value);if(isNaN(numberValue)===!1){value=numberValue}
                                switch(value){case 'true':value=!0;break;case 'false':value=!1;break;default:break}
                                switch(option){case 'autoplay':value={delay:value,disableOnInteraction:!1};break;case 'allowslidenext':option='allowSlideNext';break;case 'allowslideprev':option='allowSlidePrev';break;case 'allowtouchmove':option='allowTouchMove';break;case 'autoheight':option='autoHeight';break;case 'centerinsufficientslides':option='centerInsufficientSlides';break;case 'centeredslides':option='centeredSlides';break;case 'centeredslidesbounds':option='centeredSlidesBounds';break;case 'containermodifierclass':option='containerModifierClass';break;case 'cssmode':option='cssMode';break;case 'edgeswipedetection':option='edgeSwipeDetection';break;case 'edgeswipethreshold':option='edgeSwipeThreshold';break;case 'focusableelements':option='focusableElements';break;case 'followfinger':option='followFinger';break;case 'grabcursor':option='grabCursor';break;case 'initialslide':option='initialSlide';break;case 'longswipes':option='longSwipes';break;case 'longswipesms':option='longSwipesMs';break;case 'longswipesratio':option='longSwipesRatio';break;case 'loopadditionalslides':option='loopAdditionalSlides';break;case 'loopfillgroupwithblank':option='loopFillGroupWithBlank';break;case 'looppreventsslide':option='loopPreventsSlide';break;case 'loopedslides':option='loopedSlides';break;case 'maxbackfacehiddenslides':option='maxBackfaceHiddenSlides';break;case 'noswiping':option='noSwiping';break;case 'noswipingclass':option='noSwipingClass';break;case 'noswipingselector':option='noSwipingSelector';break;case 'normalizeslideindex':option='normalizeSlideIndex';break;case 'observeparents':option='observeParents';break;case 'observeslidechildren':option='observeSlideChildren';break;case 'passivelisteners':option='passiveListeners';break;case 'preloadimages':option='preloadImages';break;case 'preventclicks':option='preventClicks';break;case 'preventclickspropagation':option='preventClicksPropagation';break;case 'preventinteractionontransition':option='preventInteractionOnTransition';break;case 'preventclickspropagation':option='preventClicksPropagation';break;case 'resistanceratio':option='resistanceRatio';break;case 'resizeobserver':option='resizeObserver';break;case 'roundlengths':option='roundLengths';break;case 'runcallbacksoninit':option='runCallbacksOnInit';break;case 'setwrappersize':option='setWrapperSize';break;case 'shortswipes':option='shortSwipes';break;case 'simulatetouch':option='simulateTouch';break;case 'slideactiveclass':option='slideActiveClass';break;case 'slideblankclass':option='slideBlankClass';break;case 'slideclass':option='slideClass';break;case 'slideduplicateactiveclass':option='slideDuplicateActiveClass';break;case 'slideduplicateclass':option='slideDuplicateClass';break;case 'slideduplicatenextclass':option='slideDuplicateNextClass';break;case 'slideduplicateprevclass':option='slideDuplicatePrevClass';break;case 'slideNextClass':option='slidenextclass';break;case 'slideprevclass':option='slidePrevClass';break;case 'slidetoclickedslide':option='slideToClickedSlide';break;case 'slidevisibleclass':option='slideVisibleClass';break;case 'slidesoffsetafter':option='slidesOffsetAfter';break;case 'slidesoffsetbefore':option='slidesOffsetBefore';break;case 'slidespergroup':option='slidesPerGroup';break;case 'slidespergroupauto':option='slidesPerGroupAuto';break;case 'slidespergroupskip':option='slidesPerGroupSkip';break;case 'slidesperview':option='slidesPerView';break;case 'spacebetween':option='spaceBetween';break;case 'swipehandler':option='swipeHandler';break;case 'touchangle':option='touchAngle';break;case 'toucheventstarget':option='touchEventsTarget';break;case 'touchmovestoppropagation':option='touchMoveStopPropagation';break;case 'touchratio':option='touchRatio';break;case 'touchreleaseonedges':option='touchReleaseOnEdges';break;case 'touchstartforcepreventdefault':option='touchStartForcePreventDefault';break;case 'touchangle':option='touchAngle';break;case 'touchstartpreventdefault':option='touchStartPreventDefault';break;case 'uniquenavelements':option='uniqueNavElements';break;case 'updateonimagesready':option='updateOnImagesReady';break;case 'updateonwindowresize':option='updateOnWindowResize';break;case 'useragent':option='userAgent';break;case 'virtualtranslate':option='virtualTranslate';break;case 'watchoverflow':option='watchOverflow';break;case 'watchslidesprogress':option='watchSlidesProgress';break;case 'wrapperclass':option='wrapperClass';break;case 'freemode':option='freeMode';break;case 'keyboard':value={enabled:!0};break;default:break}
                                acc[option]=value;return acc}else{return acc}},{});
                        config=IV$.extend(config,ivSwiperDataArray);
                    }
                };
                function updateSwipe(){
                    if(ivswiper.virtualSize - ivswiper.size < 5){
                        IV$(ivswiper.$wrapperEl).addClass('no-swiping');
                        IV$(ivswiper.$el).closest('.base_swiper_container').find('.base_module_container').addClass('displaynone');
                    }else{
                        IV$(ivswiper.$wrapperEl).removeClass('no-swiping');
                        IV$(ivswiper.$el).closest('.base_swiper_container').find('.base_module_container').removeClass('displaynone');
                    }
                    ivswiper.update();
                }
                if(typeof config['observeParents'] === 'undefined'){
                    const targetNode = $x.get(0);
                    const observer = new ResizeObserver(detectChange);
                    function detectChange(mutationsList, observer) {
                        if(mutationsList){
                            setTimeout(updateSwipe, 300);
                            setTimeout(updateSwipe, 1200);
                        }
                    };
                    observer.observe(targetNode, {box: "border-box"});
                }
                let slideUpdateFunc = function(a, b){
                    a.some(function(arr, val){
                        if(arr.type === 'childList'){
                            IV$(ivswiper.$wrapperEl).children().addClass('swiper-slide');
                            updateSwipe();
                            return true;
                        }
                    });
                }
                $x.iv_observerFunc(slideUpdateFunc, {
                    attributes: false,
                    childList: true,
                    subtree: false,
                });
                x['ivswipe'] = config; //iv_swiper에 넣어줌
                window['ivswipe_' +name] = new Swiper($swiperContainer[0], config);
                $x.attr('data-ivswipe-name', 'ivswipe_' + name);
                ivswiper = window['ivswipe_' +name];
                $x.addClass('ivswipe-done');
                let IV_SWIPER_SINGLE_CALL_END = new CustomEvent('IVSwiperCall', {'detail': window['ivswipe_' +name] });
                x.dispatchEvent(IV_SWIPER_SINGLE_CALL_END);
            }else{
                let name = IV$(this).attr('data-ivswipe-name');
                let ivswiper = window[name];
                if(typeof ivswiper !== 'undefined'){
                    ( chk = function(){
                        setTimeout(function(){
                            if(ivswiper.virtualSize - ivswiper.size < 5){
                                IV$(ivswiper.$wrapperEl).addClass('no-swiping');
                                IV$(ivswiper.$el).closest('.base_swiper_container').find('.base_module_container').addClass('displaynone');
                            }else{
                                IV$(ivswiper.$wrapperEl).removeClass('no-swiping');
                                IV$(ivswiper.$el).closest('.base_swiper_container').find('.base_module_container').removeClass('displaynone');
                            }
                            ivswiper.slideTo(0,0,true);
                        },300);
                    })();
                }
            }
        });
    },
    iv_swiperConnectFunc : function($ivSwiper, speed){
        this.each(function(i, x){
            let classList = x.classList; 
            if(classList.contains('ivswipe-done') === true){
                let $x = IV$(x),
                    name = $x.attr('data-ivswipe-name'),
                    ivswiper = window[name],
                    connect, 
                    ivswiperConnect = [];
                if(typeof $ivSwiper !== 'undefined'){
                    $ivSwiper.each(function(j, y){
                        let $y = IV$(y),
                            connectName = $y.attr('data-ivswipe-name'),
                            speed = y['ivswipe'].speed,
                            obj = {};
                        obj['name'] = connectName;
                        obj['speed'] = speed;
                        ivswiperConnect.push(obj);
                    });
                }else{
                    connect = $x.attr('data-ivswipe-connect');
                    if(typeof connect !== 'undefined' && connect !== ''){
                        connect = (connect.indexOf(',')>-1) ? connect.split(',') : [connect];
                        connect.forEach(function(e,i){
                            let connectName = (e.indexOf('ivswipe_')>-1) ? e : 'ivswipe_' + e,
                                $e = IV$('[data-ivswipe-name="'+ connectName +'"]');
                            if($e.length > 0){
                                let speed = $e[0]['ivswipe'].speed,
                                    obj = {};
                                obj['name'] = connectName;
                                obj['speed'] = speed;
                                ivswiperConnect.push(obj);
                            }
                        });
                    }
                }
                ivswiper.on('slideChange', function () {
                    let x = this;
                    ivswiperConnect.forEach(function(e,i){
                        window[e.name].slideTo(x.realIndex,e.speed,true);
                    });
                });
            }
        });
    },
    /**
     * change observer (dom 변화 감지 후 함수 실행)
     */
    iv_observerFunc : function(callback, config){
        const targetNode = this.get(0);
        const observer = new MutationObserver(detectChange);
        function detectChange(mutationsList, observer) {
            if(mutationsList){
                observer.disconnect(); 
                let result = callback(mutationsList,observer);
                if(result !== false){
                    setTimeout(function(){
                        observer.observe(targetNode, config);
                    },0);
                }
            }
        };
        observer.observe(targetNode, config);
    },
    iv_replaceTag : function(newTag) {
        var originalElement = this[0];
        if(typeof originalElement !== 'undefined'){
            var originalTag = originalElement.tagName.toLowerCase()
            , startRX = new RegExp('^<'+originalTag, 'i')
            , endRX = new RegExp(originalTag+'>$', 'i')
            , startSubst = '<'+newTag
            , endSubst = newTag+'>'
            , newHTML = originalElement.outerHTML
            .replace(startRX, startSubst)
            .replace(endRX, endSubst);
            this.replaceWith(newHTML);
        }
    },
});

/**
 * menu list call
 */
var IVBaseMenuCall = IVBaseMenuCall || {
    __IV_DEFAULT_VALUE_FUNCTION_USE : true,
    __IV_DEFAULT_VALUE_AJAX_URL : '/exec/front/Product/SubCategory', 
    __IV_DEFAULT_VALUE_PRINT_ELEMENT : ['[data-ivcate-type]'], 
    __IV_DEFAULT_VALUE_SUBCATEGORY_DATA_ORIGINAL : [] || {},
    __IV_DEFAULT_VALUE_SUBCATEGORY_DATA : [] || {},
    __IV_DEFAULT_VALUE_LOCATION_HAS_CATE_PARAM : (IV_LOCATION_PARAMETERS.indexOf('cate_no=') > -1 ) ? true : false,
    __IV_DEFAULT_VALUE_LOCATION_NOW_CATE : null, 
    __IV_DEFAULT_VALUE_SUBCATEGORY_MAX_DEPTH : null,
    __IV_DEFAULT_VALUE_SUBCATEGORY_TYPE_LIST : [ 
        {type : 'allView_hover', allCateSet : 2,viewNextSet: 1}, 
        {type : 'allView_slide', allCateSet : 1,viewNextSet: 1},
        {type : 'currentView_list_full', allCateSet : 1,viewNextSet: 1},
        {type : 'currentView_list_under', allCateSet : 1,viewNextSet: 1}, 
        {type : 'currentView_list_select', allCateSet : 0,viewNextSet: 1}
    ],
    __IV_DEFAULT_VALUE_SUBCATEGORY_ALL_TXT : 'All',
    init : function(){
        return new Promise(function (res, rej) {
            /* 변경 세팅값 있으면 변경해줌 */
            if(typeof IV_CATE_LINK_SETTING !== 'undefined'){
                IV$.each(IV_CATE_LINK_SETTING, function(k, v){
                    if(typeof IVBaseMenuCall[k] === 'object'){
                        IVBaseMenuCall[k] = IV$.extend(true, IVBaseMenuCall[k], v);
                    }else{
                    	IVBaseMenuCall[k] = v;
                    };
                });
            };
            if(IVBaseMenuCall.__IV_DEFAULT_VALUE_FUNCTION_USE){
                if(IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA.length == 0){
                    IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE =  (IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_HAS_CATE_PARAM) ? Number(iv_util.getParameterByName(IV_LOCATION_HREF, 'cate_no')) : null;
                    /**
                     * ajax 호출 진행 (data)
                     */
                    IV$.ajax({
                        url : IVBaseMenuCall.__IV_DEFAULT_VALUE_AJAX_URL,
                        dataType: 'json',
                        success: function(aData) {
                            if (aData == null || aData == 'undefined') return;
                            let aDataClone = aData.slice(),
                                allCateLength = aDataClone.length,
                                prefix = '__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_',
                                prefix2 = '__IV_DEFAULT_VALUE_CATE_LIST_',
                                verify_number = 1,
                                verifyNumber = 1;
                            (findDepthCategory = function(num, cateDepth){
                                if(typeof num === 'undefined'){
                                	num = verifyNumber;
                                    cateDepth = 1;
                                }else{
                                	cateDepth = cateDepth + 1;
                                }
                                verifyNumber = cateDepth;
                                var dataFilterResult = aDataClone.filter(function(el,idx) { 
                                    if(el.parent_cate_no == num){
                                        return true;
                                    }
                                });
                                if(dataFilterResult.length > 0){
                                    dataFilterResult.forEach(function(data,i){
                                        var dataCateNo = data.cate_no,
                                            parentCateNo = data.parent_cate_no;
                                        var testdata= Object.assign({}, data);
                                        IVBaseMenuCall['__IV_DEFAULT_VALUE_SUBCATEGORY_DATA_ORIGINAL'][dataCateNo] = testdata;
                                        IV$.extend(data, {cate_depth : cateDepth});
                                        if(typeof IV_CATE_LINK_CUSTOM !== 'undefined') {
                                            IV_CATE_LINK_CUSTOM.some(function(v, idx, arr) { 
                                                if(v.cate_no == data.cate_no) {
                                                    IV$.extend(data, arr[idx]); 
                                                    arr.splice(idx,1); 
                                                    return true; 
                                                };
                                            });
                                        }
                                        let name = prefix + cateDepth;
                                        if(! IVBaseMenuCall[name]) IVBaseMenuCall[name] = [];
                                        IVBaseMenuCall[name][dataCateNo] = data;
                                        IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA.push(data);
                                        findDepthCategory(dataCateNo, cateDepth);
                                    });
                                }
                            })();
                            IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_MAX_DEPTH = verifyNumber;
                            var remainData = aDataClone.filter(function(el,idx) { 
                                if(typeof el.cate_depth === 'undefined'){
                                    return true;
                                }
                            });
                            if(remainData.length > 0){
                                IVBaseMenuCall[prefix + '_undefined'] = [];
                                for(let i=0; i<remainData.length; i++){
                                    IV$.extend(remainData[i], {cate_depth : 'undefined'});
                                    IVBaseMenuCall[prefix + '_undefined'][remainData[i].cate_no] = remainData[i];
                                    IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA.push(remainData[i]);
                                };
                            }
                            res(IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA);
                        },
                    });
                }else{
                    res(IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA);
                };
            }else{
                let obj = {};
                res(obj);
            };
        });
    },
    printList : function(){
        IVBaseMenuCall.init().then(function(res){
            let data = res;
            IVBaseMenuCall.__IV_DEFAULT_VALUE_PRINT_ELEMENT.forEach(function(e, i){
                IV$(e).each(function(idx, item){
                    let $baseMenuWrapper = IV$(item);
                    if(i == 0 && idx == 0){
                        $baseMenuWrapper.find('.menu_1li').each(function(){
                            let $menu1li = IV$(this);
                            let cate_no_chk = $menu1li.attr('data-cate');
                            if($baseMenuWrapper.find('.menu_1li[data-cate="'+ cate_no_chk +'"]').length > 0){
                                IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_DATA.filter(function(e,i){
                                    if(e.cate_no === Number(cate_no_chk)){
                                        IV$.extend(e,{is_main: true});
                                    };
                                });
                            };
                        });
                    };
                    if(! $baseMenuWrapper.hasClass('done')){
                        let dataCateType = $baseMenuWrapper.data('ivcate-type');
                        IVBaseMenuCall.custom(data, $baseMenuWrapper, dataCateType);
                    };
                });
            });
            let IV_MENU_CALL_END = new CustomEvent('IVMenuCall', {'detail': data });
            document.body.dispatchEvent(IV_MENU_CALL_END);
        });
    },
    custom : function(data, $el, type){
        switch(true){
            case (type.indexOf('allView') != -1) : 
                IVBaseMenuCall.allView(data, $el, type);
                break;
            case (type.indexOf('currentView') != -1) : 
                IVBaseMenuCall.currentView(data, $el, type);
                break;
            default : 
                break;
        };
    },
    allView : function(data, $el, type){
        let allCateSet = false;
        IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_TYPE_LIST.filter(function(el) {
            if(el.type == type){
                allCateSet = el.allCateSet;
            };
        });
        let dataLength = data.length;
        let allCateName = IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_ALL_TXT;
        let defaultEventExec = ($el.attr('data-ivcate-event')) ? ($el.attr('data-ivcate-event') === 'false')? false: true : true;
        /**
         * 카테고리 append
         */
        for(let i=0; i<dataLength; i++){
            let single_data = data[i];
            let dataDepth = single_data.cate_depth,
                cateNo = single_data['cate_no'],
                link = (single_data['custom_link']) ? single_data['custom_link'] : '/' + single_data['design_page_url'] + single_data['param'],
                name = (single_data['change_name']) ? single_data['change_name'] : single_data['name'],
                addText = (typeof single_data['add_sub_text'] != 'undefined') ? single_data['add_sub_text'] : null,
                viewType = (typeof single_data['cate_view_type'] != 'undefined') ? single_data['cate_view_type'] : null,
                allCateType = (typeof single_data['all_cate_type'] != 'undefined') ? single_data['all_cate_type'] : null,
                isMain = (typeof single_data['is_main'] != 'undefined') ? single_data['is_main'] : false,
                $cateEl = null;
            if(dataDepth != 'undefined'){
                $cateEl = (isMain==true) ? $el.find('[data-cate="'+ cateNo +'"]') : IV$('<li class="menu_'+ dataDepth +'li" data-cate="'+ cateNo +'" data-depth="'+ dataDepth +'"><a href="'+ link +'">'+ name +'</a></li>');
                let parentCateNo = single_data.parent_cate_no,
                    $parentCateEl = $el.find('[data-cate="'+ parentCateNo +'"]');
                if(isMain === false){
                    isNotMainCategory();
                }else{
                    if(dataDepth !== 1){
                        if($parentCateEl.length > 0){
                            isNotMainCategory();
                        }else{
                            isMainCategory(); 
                        };
                    }else{
                        isMainCategory();
                    };
                };
                function isMainCategory(){
                    $cateEl.children('a').attr('href', link);
                    $cateEl.children('a').text(name);
                    if(addText != null) $cateEl.addClass('menu_point').children('a').append('<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>');    
                    makeAllCate();
                };
                function isNotMainCategory(){
                    let parentCateDepth = Number($parentCateEl.attr('data-depth'));
                    dataDepth = parentCateDepth + 1;
                    $cateEl = IV$('<li class="menu_'+ dataDepth +'li" data-cate="'+ cateNo +'" data-depth="'+ dataDepth +'"><a href="'+ link +'">'+ name +'</a></li>');
                    if( $parentCateEl.children('.menu_'+ dataDepth + 'ul').length == 0 ){ 
                        $parentCateEl.append('<ul class="menu_'+ dataDepth + 'ul"></ul>'); 
                    }
                    if(! $parentCateEl.hasClass('submenu') && ! $parentCateEl.hasClass('hidden_under')) $parentCateEl.not('.menu_virtual').addClass('submenu');
                    if(addText != null) $cateEl.addClass('menu_point').children('a').append('<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>');
                    $parentCateEl.not('.menu_virtual').children('.menu_'+ dataDepth + 'ul').append($cateEl);
                    makeAllCate();
                };
                if(viewType != null){
                    switch(viewType[0]){
                        case 0 : /* 해당 카테고리 감춤 */ 
                            $cateEl.addClass('displaynone');
                            break;
                        case 1 : /* 해당 카테고리 하위 계층 안보여줌 */ 
                            $cateEl.addClass('hidden_under').removeClass('submenu');
                            break;
                        default :
                            break;
                    };
                };
                /**
                 * 전체 카테고리 생성 
                 */
                function makeAllCate(){
                    let makeAllCateView = 0;
                    /**
                    * 영역별 전체 카테고리 생성 설정 
                    */
                    switch(allCateSet){
                        case 0 : 
                            /* 전체 카테고리 생성 없음 */
                            break;
                        case 1 :
                            /* 실하위 카테고리가 하나 이상일때 하위에 전체 메뉴 생성 */
                            makeAllCateView = 1;
                            break;
                        case 2 : 
                            /* 실하위 카테고리와 무관하게 하위에 전체 메뉴 생성 */
                            makeAllCateView = 2;
                            break;
                        default : 
                            break;
                    };
                    /**
                     * allCateSet 설정과 무관하게 우선적으로 적용되는 전체 카테고리 생성 설정 
                     */
                    if(allCateType != null){
                        switch(allCateType){
                            case 0 : 
                                makeAllCateView = 0;
                                /* 전체 카테고리 생성 없음 */
                                break;
                            case 1 :
                                /* 실하위 카테고리가 하나 이상일때 하위에 전체 메뉴 생성 */
                                makeAllCateView = 1;
                                break;
                            case 2 :
                                /* 실하위 카테고리와 무관하게 하위에 전체 메뉴 생성 */
                                makeAllCateView = 2;
                                break;
                            default : 
                                break;
                        };
                    };
                    if(makeAllCateView > 0){
                        //make all cate ul 
                        if(makeAllCateView == 2){
                            dataDepth = Number($cateEl.attr('data-depth'));
                            if($cateEl.children('.menu_'+ (dataDepth+1) + 'ul').length == 0){
                                $cateEl.append('<ul class="menu_'+ (dataDepth+1) + 'ul"></ul>');
                            };
                        };
                        if (makeAllCateView == 1){
                            if(typeof IVBaseMenuCall['__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_' + (dataDepth+1)] !== 'undefined'){
                                IVBaseMenuCall['__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_' + (dataDepth+1)].some(function(v, idx, arr) { 
                                    if(v.parent_cate_no == cateNo) {
                                        dataDepth = Number($cateEl.attr('data-depth'));
                                        if($cateEl.children('.menu_'+ (dataDepth+1) + 'ul').length == 0){
                                            $cateEl.append('<ul class="menu_'+ (dataDepth+1) + 'ul"></ul>');
                                        };
                                        return true; 
                                    };
                                });
                            };
                        };
                        //append all cate
                        let allCateNameFin;
                        if(! allCateName){
                            allCateNameFin = name;
                            if(addText) allCateNameFin += '<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>';
                        }else{
                            allCateNameFin = allCateName;
                        };
                        if($cateEl.children('.menu_'+ (dataDepth+1) + 'ul').length > 0){
                            var $cateEl2 = $cateEl.clone();
                            $cateEl2.attr('data-depth', dataDepth+1).removeClass().addClass('menu_' + (dataDepth+1) + 'li menu_virtual').children('a').html(allCateNameFin);
                            $cateEl.children('.menu_'+ (dataDepth+1) + 'ul').prepend($cateEl2);
                            $cateEl.addClass('submenu');
                        };
                    };
                };
            };
        };
        $el.find('ul[class*="menu_"]:empty').remove();
        if(defaultEventExec){
            switch(type){
                case 'allView_slide' :
                    $el.find('.submenu > a').attr('href','javascript: void(0);'); 
                    $el.find('li[class^="menu"]').off().on('click',function(event){
                        //상위전파 막기
                        if (event.stopPropagation) event.stopPropagation();
                        else event.cancelBubble = true; // IE 대응
                        var $clickMenu = IV$(this);
                        if($clickMenu.children('ul[class^="menu"]').hasClass('on')){
                            $clickMenu.removeClass('on');
                            $clickMenu.children('ul[class^="menu"]').hide();
                            $clickMenu.children('ul[class^="menu"]').removeClass('on');
                        }else{
                            $clickMenu.addClass('on');
                            $clickMenu.siblings().removeClass('on').find('li[class^="menu"]').removeClass('on');
                            $clickMenu.children('ul[class^="menu"]').fadeIn();
                            $clickMenu.children('ul[class^="menu"]').addClass('on');
                            $clickMenu.siblings().find('ul[class^="menu"]').hide();
                            $clickMenu.siblings().find('ul[class^="menu"]').removeClass('on');
                        };
                    });
                    break;
                case 'allView_depth' :
                    let depth = Number($el.attr('data-ivcate-depth'));
                    let $depthCate = $el.find('[data-depth="'+ depth +'"]');
                    let $menu1ul = $el.find('.menu_1ul');
                    let $depthNameUl = IV$('<ul class="cate_depth_ul" data-depth="'+ depth +'"></ul>');
                    $depthCate.each(function(j,y){
                        let $y = IV$(y);
                        let dataCate = $y.attr('data-cate');
                        let subMenu = ($y.hasClass('submenu')) ? 'submenu' : '';
                        let $depthName = $y.children('a');
                        let newli = IV$('<li class="'+ subMenu +'" data-cate="'+ dataCate +'"></li>');
                        if(subMenu == 'submenu'){
                            $depthName.attr('href','javascript: void(0);'); 
                        };
                        newli.append($depthName);
                        $depthNameUl.append(newli);
                    });
                    $depthNameUl.insertBefore($menu1ul);
                    $depthNameUl.find('li').off().on('click',function(event){
                        //상위전파 막기
                        if (event.stopPropagation) event.stopPropagation();
                        else event.cancelBubble = true; // IE 대응
                        var $clickMenu = IV$(this);
                        let dataCate = $clickMenu.attr('data-cate');
                        if($clickMenu.hasClass('on')){
                            $clickMenu.removeClass('on');
                            $menu1ul.find('li[class^="menu"]').filter('[data-cate="'+ dataCate +'"]').removeClass('on');
                        }else{
                            $clickMenu.addClass('on');
                            $clickMenu.siblings().removeClass('on');
                            $menu1ul.find('li[class^="menu"]').filter('[data-cate="'+ dataCate +'"]').addClass('on');
                            $menu1ul.find('li[class^="menu"]').filter('[data-cate="'+ dataCate +'"]').siblings().removeClass('on');
                        };
                    });
                    break;
                default :
                    break;
            };
        };
        $el.addClass('done');
        let IV_MENU_SINGLE_CALL_END = new CustomEvent('IVMenuCall', {'detail': data });
        $el[0].dispatchEvent(IV_MENU_SINGLE_CALL_END);
    },
    currentView : function(data, $el, type){
        if($el.find('.cate_path').length == 0){$el.prepend('<div class="cate_path"><ul></ul></div>');}
        if($el.find('.cate_list').length == 0){$el.find('.menu_1ul').wrap('<div class="cate_list"></div>');}
        var thisCateNum = $el.attr('data-ivcate-num');
        if(! thisCateNum){
            thisCateNum = IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE;
        };
        let allCateSet = false;
        let viewNextSet = false;
        IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_TYPE_LIST.filter(function(el) {
            if(el.type == type){
                allCateSet = el.allCateSet;
                if(typeof el.viewNextSet !== 'undefined'){
                    viewNextSet = el.viewNextSet;
                };
            };
        });
        let defaultEventExec = ($el.attr('data-ivcate-event')) ? ($el.attr('data-ivcate-event') === 'false')? false: true : true;
        let dataLength = data.length;
        let allCateName = IVBaseMenuCall.__IV_DEFAULT_VALUE_SUBCATEGORY_ALL_TXT;
        let this_data;
        data.filter(function(el) {
            if(el.cate_no == thisCateNum){
                this_data = el;
            };
        });
        if(this_data){
            let this_dataDepth = this_data.cate_depth,
                this_cateNo = this_data['cate_no'],
                this_link = (this_data['custom_link']) ? this_data['custom_link'] : '/' + this_data['design_page_url'] + this_data['param'],
                this_name = (this_data['change_name']) ? this_data['change_name'] : this_data['name'],
                this_addText = (this_data['add_sub_text']) ? this_data['add_sub_text'] : null,
                this_viewType = (typeof this_data['cate_view_type'] != 'undefined') ? this_data['cate_view_type'] : null,
                this_allCateType = (typeof this_data['all_cate_type'] != 'undefined') ? this_data['all_cate_type'] : null,
                this_$cateEl = IV$('<li class="menu_'+ this_dataDepth +'li" data-cate="'+ this_cateNo +'" data-depth="'+ this_dataDepth +'"><a href="'+ this_link +'">'+ this_name +'</a></li>');
            let this_parentCateNo = this_data.parent_cate_no;
            IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo] = [this_data];
            /**
             * 카테고리 트리 찾기 
             */
            var pastChk = this_parentCateNo;
            ( findCateTreeFunc = function(){
                if(pastChk === 1){
                    data.filter(function(el) {
                        if(el.cate_no == pastChk){
                            IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo].unshift(el);
                        };
                    });
                }else{
                    let chk = data.filter(function(el) {
                        if(el.cate_no == pastChk){
                            IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo].unshift(el);
                            pastChk = el.parent_cate_no;
                            return true;
                        };
                    });
                    if(chk.length > 0){
                        findCateTreeFunc();
                    };
                };
            })();
            if(typeof IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo] === 'undefind'){
                return false;
            };
            $el.find('.menu_1ul').html('');
            IVBaseMenuCall.__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_1.forEach(function(e,i){
                let single_data = e,
                    dataDepth = single_data.cate_depth,
                    cateNo = single_data['cate_no'],
                    link = (single_data['custom_link']) ? single_data['custom_link'] : '/' + single_data['design_page_url'] + single_data['param'],
                    name = (single_data['change_name']) ? single_data['change_name'] : single_data['name'],
                    addText = (single_data['add_sub_text']) ? single_data['add_sub_text'] : null,
                    //viewType = (typeof single_data['cate_view_type'] != 'undefined') ? single_data['cate_view_type'] : null,
                    allCateType = (typeof single_data['all_cate_type'] != 'undefined') ? single_data['all_cate_type'] : null,
                    $cateEl = IV$('<li class="menu_'+ dataDepth +'li" data-cate="'+ cateNo +'" data-depth="'+ dataDepth +'"><a href="'+ link +'">'+ name +'</a></li>');
                $el.find('.menu_1ul').append($cateEl);
            });
            /**
             * 카테고리 append
             */
            for(let i=0; i<dataLength; i++){
                let single_data = data[i],
                    dataDepth = single_data.cate_depth,
                    cateNo = single_data['cate_no'],
                    link = (single_data['custom_link']) ? single_data['custom_link'] : '/' + single_data['design_page_url'] + single_data['param'],
                    name = (single_data['change_name']) ? single_data['change_name'] : single_data['name'],
                    addText = (typeof single_data['add_sub_text'] !== 'undefined') ? single_data['add_sub_text'] : null,
                    //viewType = (typeof single_data['cate_view_type'] != 'undefined') ? single_data['cate_view_type'] : null,
                    allCateType = (typeof single_data['all_cate_type'] != 'undefined') ? single_data['all_cate_type'] : null,
                    $cateEl = (dataDepth == 1) ? $el.find('[data-cate="'+ cateNo +'"]') : IV$('<li class="menu_'+ dataDepth +'li" data-cate="'+ cateNo +'" data-depth="'+ dataDepth +'"><a href="'+ link +'">'+ name +'</a></li>');
                let test =  '__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_' +  (dataDepth-1);
                let parentCateNo = single_data.parent_cate_no,
                    $parentCateEl = $el.find('[data-cate="'+ parentCateNo +'"]');
                if(dataDepth != 'undefined'){
                    let pathTreeArray = IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo].slice();
                    if(parentCateNo != this_parentCateNo && dataDepth < this_dataDepth){
                        //상위 카테고리
                        if(pathTreeArray.length > 0) makeCatePathFunc(); 
                        if(parentCateNo == 1) makeCate();
                    }else if(parentCateNo == this_parentCateNo && dataDepth == this_dataDepth){
                        //동일 계층 카테고리
                        if(cateNo == this_cateNo) makeCatePathFunc();
                        else makeCate(); 
                    }else if (parentCateNo != this_parentCateNo && dataDepth > this_dataDepth){
                        //직계 하위 카테고리 
                        if(parentCateNo == this_cateNo) {
                            if(typeof IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_NEXT_DEPTH_CATE_FROM_' + this_cateNo] === 'undefined') IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_NEXT_DEPTH_CATE_FROM_' + this_cateNo] = [];
                            IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_NEXT_DEPTH_CATE_FROM_' + this_cateNo].push(single_data);
                            makeCate();
                        };
                    } ;

                    /**
                     * 경로 생성 + 카테고리 생성 
                     */
                    function makeCatePathFunc(){
                        pathTreeArray.some(function(v, idx, arr) { 
                            if(v.cate_no == cateNo) {
                                pathTreeArray.splice(idx,1);
                                if(parentCateNo != 1 || (parentCateNo == 1 && cateNo == this_cateNo)){
                                    makeCate();
                                }
                                $el.find('[data-cate="'+ cateNo +'"]').addClass('selected');
                                if($el.find('[data-cate="'+ cateNo +'"]').prevAll('.menu_virtual').hasClass('selected')){
                                    $el.find('[data-cate="'+ cateNo +'"]').prevAll('.menu_virtual').removeClass('selected');
                                };
                                makeAllCate();
                                let parent_data = v,
                                    p_link = (parent_data['custom_link']) ? parent_data['custom_link'] : '/' + parent_data['design_page_url'] + parent_data['param'],
                                    p_name = (parent_data['change_name']) ? parent_data['change_name'] : parent_data['name'],
                                    p_addText = (parent_data['add_sub_text']) ? parent_data['add_sub_text'] : null,
                                    p_viewType = (parent_data['cate_view_type']) ? parent_data['cate_view_type'] : null;
                                $el.find('.cate_path ul').append('<li data-path="'+cateNo+'"><a href="'+ p_link +'">'+ p_name +'</a></li>');
                                return true; 
                            };
                        });
                    };
                    /**
                     * 카테고리 생성
                     */
                    function makeCate (){
                        if(dataDepth != 1){
                            if( $el.find('.cate_list').find('.menu_'+ dataDepth + 'ul').length == 0 ){ 
                                $el.find('.cate_list').append('<ul class="menu_'+ dataDepth + 'ul"></ul>'); 
                            };
                            if(! $parentCateEl.hasClass('submenu')) $parentCateEl.addClass('submenu');
                            if(addText != null) $cateEl.addClass('menu_point').children('a').append('<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>');
                            $el.find('.menu_'+ dataDepth + 'ul').append($cateEl);
                        }else{
                            $cateEl.children('a').attr('href', link);
                            $cateEl.children('a').text(name);
                            if(addText != null) $cateEl.addClass('menu_point').children('a').append('<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>');
                        };
                    };
                    /**
                     * 전체 카테고리 생성 
                     */
                    function makeAllCate(){
                        let makeAllCateView = 0;
                        /**
                        * 영역별 전체 카테고리 생성 설정 
                        */
                        switch(allCateSet){
                            case 0 : 
                                /* 전체 카테고리 생성 없음 */
                                break;
                            case 1 :
                                /* 실하위 카테고리가 하나 이상일때 하위에 전체 메뉴 생성 */
                                makeAllCateView = 1;
                                break;
                            case 2 : 
                                /* 실하위 카테고리와 무관하게 하위에 전체 메뉴 생성 */
                                makeAllCateView = 2;
                                break;
                        };
                        /**
                         * allCateSet 설정과 무관하게 우선적으로 적용되는 전체 카테고리 생성 설정 
                         */
                        if(allCateType != null){
                            switch(allCateType){
                                case 0 : 
                                    makeAllCateView = 0;
                                    /* 전체 카테고리 생성 없음 */
                                    break;
                                case 1 :
                                    /* 실하위 카테고리가 하나 이상일때 하위에 전체 메뉴 생성 */
                                    makeAllCateView = 1;
                                    break;
                                case 2 :
                                    /* 실하위 카테고리와 무관하게 하위에 전체 메뉴 생성 */
                                    makeAllCateView = 2;
                                    break;
                            };
                        };
                        if(makeAllCateView > 0){
                            //make all cate ul 
                            if(makeAllCateView == 2){
                                if($el.find('.cate_list .menu_'+ (dataDepth+1) + 'ul').length == 0){
                                    $el.find('.cate_list').append('<ul class="menu_'+ (dataDepth+1) + 'ul"></ul>'); 
                                };
                            };
                            if ( makeAllCateView == 1){
                                if(IVBaseMenuCall['__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_' + (dataDepth+1)]){
                                    IVBaseMenuCall['__IV_DEFAULT_VALUE_CATE_LIST_DEPTH_' + (dataDepth+1)].some(function(v, idx, arr) { 
                                        if(v.parent_cate_no == cateNo) {
                                            if($el.find('.cate_list .menu_'+ (dataDepth+1) + 'ul').length == 0){
                                                $el.find('.cate_list').append('<ul class="menu_'+ (dataDepth+1) + 'ul"></ul>'); 
                                            };
                                            return true; 
                                        };
                                    });
                                };
                            };
                            //append all cate
                            let allCateNameFin;
                            if(! allCateName){
                                allCateNameFin = name;
                                if(addText) allCateNameFin += '<span class="add_txt" data-txt="'+ addText +'">'+ addText +'</span>';
                            }else{
                                allCateNameFin = allCateName;
                            };
                            if($el.find('.cate_list .menu_'+ (dataDepth+1) + 'ul').length > 0){
                                var $cateEl2 = $cateEl.clone();
                                $cateEl2.attr('data-depth', dataDepth+1).removeClass().addClass('menu_' + (dataDepth+1) + 'li menu_virtual selected').children('a').html(allCateNameFin);
                                $el.find('.cate_list .menu_'+ (dataDepth+1) + 'ul').append($cateEl2);
                            };
                        };
                    };
                };
            };
            switch(viewNextSet){
                case 0 :
                    if(typeof IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_NEXT_DEPTH_CATE_FROM_' + this_cateNo] === 'undefined'){
                        $el.addClass('displaynone');
                    }
                    break;
                default :
                    break;
            };
            if(this_viewType != null){
                switch(this_viewType[1]){
                    case 0 : /* 해당 카테고리로 기준 시, 모든 영역 감춤 */ 
                        $el.addClass('displaynone');
                        break;
                    case 1 : /* 해당 카테고리로 기준 시, 동일 계층 보여줌 (하위 카테 있어도 안 보여줌) */ 
                        $el.find('.cate_list').find('ul[class="menu_'+ (this_dataDepth+1)+'ul"]').remove();
                        $el.removeClass('displaynone');
                        break;
                };
            };
            $el.addClass('done');
            if(defaultEventExec){
                switch(type){
                    case 'currentView_list_full' :
                        break;
                    case 'currentView_list_under' :
                        break;
                    case 'currentView_list_select' :
                        $el.find('ul[class^="menu_"]').each(function(){
                            let $menu_ul = IV$(this);
                            if($menu_ul.find('.selected').length > 0){
                                var menuClass = iv_util.onlyNumbFunc($menu_ul.attr('class'));
                                var menuHeight = $menu_ul.outerHeight();
                                IV$(this).wrap('<div class="menu_'+ menuClass +'div"></div>');
                                IV$(this).before('<h4 class="current_cate"></h4>');
                                IV$(this).prev('h4').html(IV$(this).find('.selected').html());
                                IV$(this).attr('style', 'max-height: '+ menuHeight + 'px');
                                if(menuHeight == 0){
                                    IV$(this).prev('h4').addClass('noBg');
                                    IV$(this).prev('h4').find('a').addClass('noEvent');
                                }else{
                                    IV$(this).prev('h4').find('a').attr('href','javascript:void(0);');
                                };
                            }else{
                                $menu_ul.addClass('displaynone');
                            };
                        });
                        $el.find('h4 a:not(.noEvent)').on('click',function(){
                            if(IV$(this).closest('div').hasClass('on')){
                                IV$(this).closest('div').removeClass('on');
                            }else{
                                $el.find('div[class^="menu_"]').not(IV$(this).closest('div')).removeClass('on');
                                IV$(this).closest('div').addClass('on');
                                iv_util.targetOutCloseFunc(IV$(this).closest('div'));
                            };
                        });
                        $el.find('div[class^="menu_"]').each(function(){
                            IV$(this).iv_observerFunc(function () {
                                setTimeout(function(){
                                    if($el.find('div[class^="menu_"].on').length > 0){
                                        $el.addClass('on');
                                    }else{
                                        $el.removeClass('on');
                                    };
                                },0);
                            }, {
                                attributes: true,
                                childList: false,
                                subtree: false
                            });
                        });
                        break;
                    default :
                        break;
                };
            };
            let IV_MENU_SINGLE_CALL_END = new CustomEvent('IVMenuCall', {'detail': IVBaseMenuCall['__IV_DEFAULT_VALUE_CURRENT_CATE_STANDARD_NO_' + this_cateNo] });
            $el[0].dispatchEvent(IV_MENU_SINGLE_CALL_END);
        }
    },
};



/**
 * swiper 
 */
var IVSwiperFunc = IVSwiperFunc || function(){
    let count = 0;
    let $ivSwiper = IV$('.iv_swiper');
    if($ivSwiper.length > 0){
        return new Promise(function (res, rej) {
            $ivSwiper.iv_swiperFunc();
            res(true);
        }).then(function(res) {
            if($ivSwiper.filter('[data-ivswipe-connect]').length > 0){
                $ivSwiper.filter('[data-ivswipe-connect]').iv_swiperConnectFunc();
            };
            if(typeof IVPrdDynamicCall !== 'undefined'){
                IVPrdDynamicCall.init();
            };
        });
    }else{
        if(typeof IVPrdDynamicCall !== 'undefined'){
            IVPrdDynamicCall.init();
        };
    };
};

/**
 * 상품별 실행 : document ready 이후 실행해야 정상 동작합니다.
 * 상품 개별 영역 / 페이지 기준(ex 상품 상세/상품 선택창) 공통으로 사용 중
 */
var IVbasePrdInfoCall = IVbasePrdInfoCall || {
    __IV_DEFAULT_VALUE_FUNCTION_USE : false,
    __IV_DEFAULT_VALUE_PRC_CALC_USE : false, //할인율 계산 함수를 사용할 것인지 여부 : 쓰지 않을 경우 false로 바꾸고 개별적으로 지정하세요.
    __IV_DEFAULT_VALUE_PRC_ITEM_LIST: [
        {name: 'customPrice', element : '[id^="product_prc_custom"]'},
        {name: 'sellPrice', element : '[id^="product_prc_sell"]'},
        {name: 'promoPrice', element : '[id^="product_prc_promo"]'},
    ], // name : (example) + Price, value : [id^="product_prc_(example)"] / (example) 부분은 동일해야 합니다. & data-prc가 필요합니다.
    __IV_DEFAULT_VALUE_PRC_PAGE_LIST: [
        {name: 'customPrice', element : '#IV_ForFIndPrdDetailInfo #product_prc_custom_page'},
        {name: 'sellPrice', element : '#IV_ForFIndPrdDetailInfo #product_prc_sell_page'},
        {name: 'promoPrice', element : '#IV_ForFIndPrdDetailInfo #product_prc_promo_page'},
    ], // name : (example) + Price, value : 기준점이 될 요소 / (example) 부분 item list의 name값과 동일해야 합니다. & data-prc가 필요합니다.
    __IV_DEFAULT_VALUE_PRC_PAGE_PRINT_ELEMENT : [
        '.iv_prc_infoBox',
    ], // page 기준으로 출력하는 경우 출력해야 되는 요소 기준점
    __IV_DEFAULT_VALUE_PRC_CALC_STANDARD : [
        {oriEl: 'sellPrice', finEl: 'promoPrice'},
        {oriEl: 'customPrice', finEl: 'sellPrice'},
    ], //계산 기준 (순차실행이므로 각 쇼핑몰 계산 우선순위 맞춰서 배열에 넣어주세요)
    __IV_DEFAULT_VALUE_PRC_CALC_DECIMAL_SET : function(ori, fin){
        return Math.ceil(((ori - fin) / ori) * 100);
    }, //할인율 계산식 입력하시면 됩니다
    calc : function(el){
        if(IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_CALC_USE){
            if(! el){
                IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_PAGE_PRINT_ELEMENT.forEach(function(el,idx){ 
                    var el = IV$(el); 
                    if(el.length > 0){
                        IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_PAGE_LIST.forEach(function(e,i){
                            //모바일 환경 오류로 인한 수정
                            if(IV$(e.element).attr('content')){
                                if(IV$(e.element).attr('content').indexOf('(') > -1){
                                    IV$(e.element).attr('content', IV$(e.element).attr('content').split('(')[0]);
                                    IV$(e.element).attr('data-prc',IV$(e.element).attr('content').split('(')[0] );
                                };
                            };
                            el[e.name] = (IV$(e.element).length > 0) ? IV$(e.element).attr('data-prc') : 0;
                            if(el[e.name]){
                                el[e.name] = (el[e.name].indexOf('.') > -1) ? Math.floor(el[e.name]) : iv_util.onlyNumbFunc(el[e.name]);
                            };
                            IV$(e.element).attr('data-prc', el[e.name]);
                        });
                        prcCalc(el); 
                    };
                });
            }else{
                IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_ITEM_LIST.forEach(function(e,i){
                    el[e.name] =  (el.find(e.element).length > 0) ? el.find(e.element).attr('data-prc') : 0;
                    if(el[e.name]){ el[e.name] = (el[e.name].indexOf('.') > -1) ? Math.floor(el[e.name]) : iv_util.onlyNumbFunc(el[e.name]); }
                    el.find(e.element).attr('data-prc', el[e.name]);
                });
                prcCalc(el);
            };
            function prcCalc(el){
                var calcChk = false;
                IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_CALC_STANDARD.some(function(v, i, arr){
                    var $ori = '.base_prc_' + v.oriEl.split('Price')[0];
                    var $fin = '.base_prc_' + v.finEl.split('Price')[0];
                    //요소가 모두 있는지, 0은 아닌지, 최종값이 기본값보다 작은지 
                    if( el[v.oriEl] && el[v.finEl] &&  el[v.finEl] < el[v.oriEl] ){
                        var discountRatio = IVbasePrdInfoCall.__IV_DEFAULT_VALUE_PRC_CALC_DECIMAL_SET(el[v.oriEl], el[v.finEl]);
                        el.find('.base_prc_item .desc:not('+ $ori +'):not('+ $fin +')').text('');
                        el.find('.base_prc_item .desc:not('+ $ori +'):not('+ $fin +')').closest('.base_prc_item').addClass('displaynone');
                        el.find($ori).text(iv_util.comma(el[v.oriEl]));
                        el.find($fin).text(iv_util.comma(el[v.finEl]));
                        el.find($ori).closest('.base_prc_item').addClass('discount').removeClass('displaynone');
                        el.find($fin).closest('.base_prc_item').removeClass('displaynone');
                        el.find($fin).before('<span id="discount_ratio"><span class="desc">'+discountRatio+'%</span></span>');
                        calcChk = true;
                        return true; //가격 계산되면 그만돌림
                    };
                });
                if(! calcChk){
                    el.find('.base_prc_item .desc:not(.base_prc_sell)').text('');
                    el.find('.base_prc_item .desc:not(.base_prc_sell)').closest('.base_prc_item').addClass('displaynone');
                    el.find('.base_prc_sell').text(iv_util.comma(el['sellPrice']));
                    el.find('.base_prc_sell').closest('.base_prc_item').removeClass('displaynone');
                };
            };
        }else{
            console.log('이 함수를 사용하려면 변수값을 변경하세요.');
        };
    },
    iconChange : function(el){
        /**
     	 * 상품 아이콘 변경 / iv_promotion_icons 요소 필요
     	 */
        if(! el){
            el = IV$('body');
        }
        el.find('.iv_promotion_icons img').each(function(){
            var $icon = IV$(this);
            if($icon.css('display') != 'none'){
                var src = $icon.attr('src');
                //아이콘 출력 오류 시 제거
                if($icon.hasClass('displaynone') == false){
                    var img = new Image();
                    img.onerror = function() {
                        $icon.remove();
                    };
                    img.src = src;
                };
                var replaceTxt;
                IV_ICONS_CUSTOM.forEach(function(e,i){
                    if(src.indexOf(e.src) > -1){
                        $icon.after('<span class="icon_txt" data-type="'+ e.replaceTxt +'">'+ e.replaceTxt +'</span>');
                        $icon.addClass('displaynone');
                    };
                });
            };
        });
    },
    basketConfirmChk : function(el){
        if(typeof el === 'undefined'){
            el = IV$('[onClick*="/exec/"][onClick*="submit(2"]'); //장바구니 버튼
            let onClickList = el.attr('onClick');
            el.attr('onClick', 'basketConfirmShow(); ' + onClickList);
        }else{
            let basketButtonActionEl = el.find('.ec-admin-icon');
            let basketButtonEvent = basketButtonActionEl.attr('onClick');
            if(basketButtonEvent){
                if(basketButtonEvent.indexOf('CAPP_SHOP_NEW_PRODUCT_OPTIONSELECT') > -1){
                    basketButtonActionEl.closest('[onclick*="basketConfirmShow"]').removeAttr('onClick');
                };
            };
        };
    },
};


/**
 * 상품별 실행 함수 
 */
var IVPrdItemInfoCall = IVPrdItemInfoCall || {
    __IV_DEFAULT_VALUE_FUNCTION_USE : false, //상품 영역 함수 전체 사용 여부
    __IV_DEFAULT_VALUE_PRC_CALC_USE : false, //상품 영역 할인율 계산 사용 여부
    __IV_DEFAULT_VALUE_ICON_CHANGE_USE : false, //상품 영역 아이콘 변경 사용 여부 
    __IV_DEFAULT_VALUE_CUSTOM_FUNCTION_USE : false, //상품 영역 커스텀 함수 사용 여부
    __IV_DEFAULT_VALUE_BASKETCONFIRM_FUNCTION_USE : false, //상품 영역 장바구니 확인창 수정 함수 사용 여부 
    init : function(callback, el){
        if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_FUNCTION_USE){
            if (arguments.length == 0) {
                callback = null;
                el = null;
            }else if(arguments.length == 1 && typeof arguments[0] !== 'function'){
                el = arguments[0];
                callback = null;
            }else{
            	el = null;
            }
            if(el === null){
                el = IV$('.base_prd_list [id^="anchorBoxId_"]');
            };
            el.each(function(){
                var $this = IV$(this);
                if(! $this.hasClass('done')){
                    // * ============================ 상품 가격 ============================ * //
                    if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_PRC_CALC_USE){ IVbasePrdInfoCall.calc($this); }
                    // * ============================ 상품 가격 ============================ * //
                    // * ===================== 프로모션 아이콘 ======================= * //
                    if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_ICON_CHANGE_USE){ IVbasePrdInfoCall.iconChange($this); }
                    // * ===================== 프로모션 아이콘 ======================= * //
                    // * ===================== 추가 커스텀 함수 ======================= * //
                    if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION_USE){ if(callback !== null){ callback($this); } }
                    // * ===================== 추가 커스텀 함수 ======================= * //
                    // * ============================ 상품 담기 옵션창 ============================ * //
                    if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_BASKETCONFIRM_FUNCTION_USE){
                        IVbasePrdInfoCall.basketConfirmChk($this);
                    }
                    // * ============================ 상품 담기 옵션창 ============================ * //
                    $this.addClass('done');
                };
            });
        }else{
            console.log('이 함수를 사용하려면 변수값을 변경하세요.');
        };
    },
};

/**
 * 페이지별 실행 함수 
 */
var IVPrdPageInfoCall = IVPrdPageInfoCall || {
    __IV_DEFAULT_VALUE_FUNCTION_USE : false, //페이지 기준 함수 전체 사용 여부
    __IV_DEFAULT_VALUE_PRC_CALC_USE : false, //페이지 기준 할인율 계산 사용 여부
    __IV_DEFAULT_VALUE_ICON_CHANGE_USE : false, //페이지 기준 아이콘 변경 사용 여부 
    __IV_DEFAULT_VALUE_CUSTOM_FUNCTION_USE : false, //페이지 기준 커스텀 함수 사용 여부
    __IV_DEFAULT_VALUE_BASKETCONFIRM_FUNCTION_USE : false, //페이지 기준 장바구니 확인창 수정 함수 사용 여부 
    init : function(callback){
        if(IVPrdPageInfoCall.__IV_DEFAULT_VALUE_FUNCTION_USE){
            if (arguments.length == 0) {
                callback = null;
            }
            // * ============================ 상품 가격 ============================ * //
            if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_PRC_CALC_USE){ IVbasePrdInfoCall.calc(); }
            // * ============================ 상품 가격 ============================ * //
            // * ===================== 프로모션 아이콘 ======================= * //
            if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_ICON_CHANGE_USE){ IVbasePrdInfoCall.iconChange(); }
            // * ===================== 프로모션 아이콘 ======================= * //
            // * ===================== 추가 커스텀 함수 ======================= * //
            if(IVPrdItemInfoCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION_USE){ if(callback !== null){ callback(); } }
            // * ===================== 추가 커스텀 함수 ======================= * //
            // * ============================ 상품 담기 옵션창 ============================ * //
            if(IVPrdPageInfoCall.__IV_DEFAULT_VALUE_BASKETCONFIRM_FUNCTION_USE){
                IVbasePrdInfoCall.basketConfirmChk();
            }
            // * ============================ 상품 담기 옵션창 ============================ * //
        }else{
            console.log('이 함수를 사용하려면 변수값을 변경하세요.');
        };
    },
};

/** 
 * mcustomScrollbar
 */
var IVmcustomScrollbar = IVmcustomScrollbar || function() {
    $(".iv_mcustomScrollbar").each(function () {
        let e = $(this);
        try {
            0 == e.hasClass("mCustomScrollbar") && e.mCustomScrollbar({
                axis: "y",
                theme: "minimal-dark",
                alwaysShowScrollbar: 0,
                callbacks: {
                    onInit:function(){
                        let $scrollBox = e.find(".mCustomScrollBox");
                        let $scrollContent = e.find(".mCSB_container");
                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                        (gap < 10) ? e.find(".mCSB_scrollTools").addClass("layout-hidden") : e.find(".mCSB_scrollTools").removeClass("layout-hidden");
                    },
                    onBeforeUpdate: function () {
                        let $scrollBox = e.find(".mCustomScrollBox");
                        let $scrollContent = e.find(".mCSB_container");
                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                        (gap < 10) ? e.find(".mCSB_scrollTools").addClass("layout-hidden") : e.find(".mCSB_scrollTools").removeClass("layout-hidden");
                    },
                    onScrollStart: function () {
                        let $scrollBox = e.find(".mCustomScrollBox");
                        let $scrollContent = e.find(".mCSB_container");
                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                        (gap < 10) ? e.find(".mCSB_scrollTools").addClass("layout-hidden") : e.find(".mCSB_scrollTools").removeClass("layout-hidden");
                    }
                }
            });
        } catch (err) {
            console.log(err);
            IV$ = window.IV$ = jQuery.noConflict(true); 
        };
    });
};

/**
 * 옵션 수정 레이어 열림 함수
 */
var IVoptionModifyLayer = IVoptionModifyLayer || function(el){
    let $el = IV$(el);
    let onClickInfo = $el.attr('onClick');
    let findElReg = /\(\'.*\'/g;
    let layerName;
    let result = onClickInfo.match(findElReg)[0];
    layerName = (result.indexOf('#') > -1) ? result.substring(3,result.length-1) : result.substring(2,result.length-1);
    let customChk = false;
    if(IV_SUBCONTAINER_DATA_PAGE == 'orderBasket'){
        if(iv_orderBaseFunc.__IV_DEFAULT_VALUE_OPTION_LAYER_FUNC_DEFAULT){
            let $modifyLayer = IV$('#ec-basketOptionModifyLayer');
            let $modifyLayer2 = null;
            switch (IV_DEVICE_CHK) {
                case 'pc':
                    $modifyLayer.find('.list_body tr').empty();
                    let $prd = $el.closest('.list');
                    let clone = $prd.clone();
                    clone.find('.optionModify').remove();
                    if($prd.find('.option_str_list > li').length > 1){
                        let optionIndex = iv_util.onlyNumbFunc(layerName.split(',')[0].trim().slice(-2)) + 1;
                        clone.find('.option_str_list > li:not(:nth-child('+ optionIndex +'))').remove();
                    };
                    clone.find('.b_chk').remove();
                    $modifyLayer.find('.list_body').html(clone);
                    $modifyLayer.addClass('on');
                    $modifyLayer.find('.iv_close_button, [class^="btnClose"], [class*="close"]').on('click',function(){
                        iv_util.scrollEnabled();
                    });
                    iv_util.scrollDisabled($modifyLayer);
                    break;
                case 'mobile':
                    $modifyLayer.addClass('on');
                    $modifyLayer.find('.iv_close_button, [class^="btnClose"], [class*="close"]').on('click',function(){
                        iv_util.scrollEnabled();
                    });
                    iv_util.scrollDisabled($modifyLayer);
                    break;
                default:
                    console.log('error');
                    break;
            };
        }else{
            let $modifyLayer = IV$('#ec-basketOptionModifyLayer');
            let openFunction = $modifyLayer[0].iv_openCustomFunction;
            let closeFunction = $modifyLayer[0].iv_closeCustomFunction;
            switch (IV_DEVICE_CHK) {
                case 'pc':
                    $modifyLayer.find('.list_body tr').empty();
                    let $prd = $el.closest('.list');
                    let clone = $prd.clone();
                    clone.find('.optionModify').remove();
                    clone.find('.b_chk').remove();
                    if($prd.find('.option_str_list > li').length > 1){
                        let optionIndex = iv_util.onlyNumbFunc(layerName.split(',')[0].trim().slice(-2)) + 1;
                        clone.find('.option_str_list > li:not(:nth-child('+ optionIndex +'))').remove();
                    };
                    $modifyLayer.find('.list_body').html(clone);
                    break;
                case 'mobile':
                    console.log($modifyLayer);
                    break;
                default:
                    console.log('error');
                    break;
            };
            openFunction();
            $modifyLayer.find('.iv_close_button, [class^="btnClose"], [class*="close"]').on('click',function(){
                iv_util.scrollEnabled();
                if(typeof closeFunction !== 'undefined'){
                    closeFunction();
                };
            });
        };
    }else{
        let openFunction = IV$('#' + layerName)[0].iv_openCustomFunction;
        let closeFunction = IV$('#' + layerName)[0].iv_closeCustomFunction;
        if(typeof openFunction === 'undefined'){
            IV$('#' + layerName).addClass('on');
            iv_util.scrollDisabled(IV$('#' + layerName));
            IV$('#' + layerName).find('.iv_close_button, [class^="btnClose"],[class*="close"]').on('click',function(){
                iv_util.scrollEnabled();
            });
        }else{
            openFunction();
            IV$('#' + layerName).find('.iv_close_button, [class^="btnClose"],[class*="close"]').on('click',function(){
                if(typeof closeFunction !== 'undefined'){
                    closeFunction();
                };
            });
        };
    };
};


/**
 * 테이블 레이아웃 수정
 */
var IVTableLayoutFix = IVTableLayoutFix || function(el){
    /**
     * 테이블 레이아웃 수정
     */
    let $baseOrderPrdList;
    if(typeof el === 'undefined'){
        $baseOrderPrdList = IV$('.base_order_prdlist');
    }else{
        $baseOrderPrdList = IV$(el);
    };
    let $orderPrdItem = $baseOrderPrdList.find('.list_body').children();
    $baseOrderPrdList.each(function(){
        let $this = IV$(this);
        if( $this.hasClass('done') === false ){
            if($this.hasClass('ec-base-table')){
                let $tfoot = $this.find('tfoot');
                let isEmpty = $this.closest('.xans-order-empty').length;
                let $tdLength = $this.find('tr').eq(0).children().length;
                if($tfoot.length > 0){
                    $tfoot.find('td').attr('colspan', $tdLength);	
                };
                if(isEmpty > 0){
                    $this.find('.list_body td').attr('colspan', $tdLength);	
                };
            };
            let $orderTable = $this.find('.orderList');
            if($orderTable.length == 0){
                $this.remove();
            }else{
                let dataStr = $orderTable.attr('data-dstr');
                $this.find('.delv_dstr').text(dataStr);
            };
            $this.addClass('done');
        };
    });
};


/**
 * 특정 체크박스 선택하면 연결된 체크박스 다 선택해줌
 */
var ivchkFunc = ivchkFunc || function(d, boolean){
    let $this = IV$(d);
    let dom = d;
    let $children = dom.iv_children;
    let nodeName = dom.nodeName;
    let customFunction = dom.iv_customFunction;
    if(typeof $children !== 'undefined'){
        if(nodeName === 'INPUT'){
            $this.on('change',function(e,eventDirection){
                let checkedChk = $this.is(':checked');
                let $parent = dom['iv_parent'];
                if(boolean !== false){
                    $children = dom.iv_children.filter(':not(:disabled)');
                }else{
                    $children = dom.iv_children;
                };
                if(typeof eventDirection === 'undefined'){
                    //trigger되지 않은 이벤트 실행
                    triggerChildren();
                    if(typeof $parent !== 'undefined'){
                        triggerParent();
                    };
                }else{
                    //trigger된 이벤트 실행
                    if(eventDirection.direction === 'down'){
                        triggerChildren();
                    }else if(eventDirection.direction === 'up'){
                        if(typeof $parent !== 'undefined'){
                            triggerParent();
                        };
                    };
                };
                if(typeof customFunction !== 'undefined'){
                    customFunction(d, checkedChk);
                };
                function triggerChildren(){
                    if(checkedChk){
                        $children.prop('checked',true).trigger('change',[{'direction': 'down'}]);
                    }else{
                        $children.prop('checked',false).trigger('change',[{'direction': 'down'}]);
                    };
                };
                function triggerParent(){
                    if($parent !== 'undefined'){
                        let $siblings = dom['iv_siblings']; 
                        if($siblings.length ==  $siblings.filter(':checked').length){
                            $parent.prop('checked',true).trigger('change',[{'direction': 'up'}]);
                        }else{
                            $parent.prop('checked',false).trigger('change',[{'direction': 'up'}]);
                        };
                    };
                };
            });
        };
        $children.on('change',function(e, eventDirection){
            let $this_children = IV$(this);
            let childrenLength = $children.length;
            let childrenChkLength = $children.filter(':checked').length;
            if(boolean === false && typeof $this_children.iv_children === 'undefined'){
                childrenLength = $children.filter(':not(:disabled)').length;
                childrenChkLength = $children.filter(':not(:disabled)').filter(':checked').length;
            };
            let checkedChk = $this_children.is(':checked');
            let customFunction = $this_children.iv_customFunction;
            if(typeof eventDirection === 'undefined'){
                //trigger되지 않은 이벤트 실행
                triggerParents();
            }else{
                //trigger된 이벤트 실행
                if(eventDirection.direction == 'up'){
                    triggerParents();
                };
            };
            function triggerParents(){
                if(childrenLength === childrenChkLength && childrenChkLength !== 0){
                    $this.prop('checked',true).trigger('change',[{'direction': 'up'}]);
                }else{
                    $this.prop('checked',false).trigger('change',[{'direction': 'up'}]);
                };
            };
            if(typeof customFunction !== 'undefined' && typeof $this_children.iv_children === 'undefined'){
                customFunction(this, checkedChk);
            };
        });
    };
};

/**
 * 장바구니 확인창 관련 이벤트 
 */
if(IV$(topDocument).find('[id*="iv_memberChk_"] > input').length > 0){
    IV$(topDocument).find('[id*="iv_memberChk_"] > input').on('IVbasketConfirm',function(e){
        IV$(topDocument).find('[onClick*="basketConfirmShow"]').addClass('noEvent');
        basketConfirmFunc.run();
    });
    var basketConfirmFunc = basketConfirmFunc || {
        __layer : null,
        __count : 0,
        __maxCount : 10,
        __autoHide : true,
        __autoFadeTime : 500,
        __autoHideTime : 1500,
        init: function(){
            let IV_BASKET_CONFIRM_EVENT = new CustomEvent("IVbasketConfirm");
            IV$(topDocument).find('[id*="iv_memberChk_"] > input')[0].dispatchEvent(IV_BASKET_CONFIRM_EVENT);
        },
        run : function(){
            basketConfirmFunc.__layer = IV$('#confirmLayer');
            var $comfirmLayer = basketConfirmFunc.__layer;
            var confirmLength = $comfirmLayer.length;
            if(bIsRunningAddBasket){
                basketConfirmFunc.__count = basketConfirmFunc.__count + 1;
                setTimeout(basketConfirmFunc.run,150);   
            }else{
                if(confirmLength > 0){
                    clearTimeout(basketConfirmFunc.run);
                    try {
                        basketConfirmFunc.set();
                    } catch (e) {
                        console.log(e);
                        basketConfirmFunc.set();
                    };
                    if(basketConfirmFunc.__autoHide){
                        $comfirmLayer.find('.popup_container').children('.close').addClass('displaynone');
                        basketConfirmFunc.fadeInAuto();
                    }else{
                        iv_util.makeDimmed(true,1,$comfirmLayer.find('.popup_container'));
                        $comfirmLayer.find('.popup_container').addClass('on');
                        basketConfirmFunc.reset();
                    };
                }else{
                    basketConfirmFunc.__count = basketConfirmFunc.__count + 1;
                    if(basketConfirmFunc.__count > basketConfirmFunc.__maxCount){
                        basketConfirmFunc.reset();
                    }else{	
                        setTimeout(basketConfirmFunc.run,100);
                    };
                };
            };
        },
        set : function(){
            var $comfirmLayer = basketConfirmFunc.__layer;
            IVmcustomScrollbar();
            if($comfirmLayer.find('.base_prd_list').length > 0){
                basketConfirmFunc.__autoHide = false;
                setTimeout(function(){
                    IVPrdItemInfoCall.init(basePrdItemInfoCallCustom, $comfirmLayer.find('[id^="anchorBoxId_"]')); //상품별 실행 함수
                    $comfirmLayer.find('[onClick*="layer_basket_paging"]').each(function(){
                        let $page = IV$(this);
                        let onClick = $page.attr('onClick');
                        $page.attr('onClick', 'basketConfirmFunc.reset(); ' + onClick + '  setTimeout(basketConfirmFunc.run,500);');
                    });
                },500);
            };
        },
        fadeInAuto : function(){
            var $comfirmLayer = basketConfirmFunc.__layer;
            $comfirmLayer.hide();
            $comfirmLayer.find('.popup_container').addClass('on');
            $comfirmLayer.stop(true,true).fadeIn(basketConfirmFunc.__autoFadeTime).promise().done(function() {
                if($comfirmLayer.length > 0){
                    setTimeout(basketConfirmFunc.hideAuto,basketConfirmFunc.__autoHideTime);
                }else{
                    basketConfirmFunc.reset();
                };
            });
        },
        hideAuto : function(){
            var $comfirmLayer = basketConfirmFunc.__layer;
            if($comfirmLayer.length > 0){
                $comfirmLayer.stop(true,true).fadeOut(basketConfirmFunc.__autoFadeTime).promise().done(function() {
                    $comfirmLayer.find('.popup_container').removeClass('on').css('transition','all 0s ease 0s');
                    basketConfirmFunc.close();
                });
            }else{
                basketConfirmFunc.reset();
            };
        },
        reset : function(){
            basketConfirmFunc.__count = 0;
            clearTimeout(basketConfirmFunc.run);
            IV$(topDocument).find('[onClick*="basketConfirmShow"]').removeClass('noEvent');
        },
        close : function(){
            var $comfirmLayer = basketConfirmFunc.__layer;
            basketConfirmFunc.reset();
            if($comfirmLayer.find('.popup_container').css('transition') == 'all 0s ease 0s'){
                $comfirmLayer.find('.popup_container').removeClass('on');
                $comfirmLayer.remove();
                iv_util.removeDimmed();
            }else{
                $comfirmLayer.find('.popup_container')[0].addEventListener("transitionend", function(){
                	$comfirmLayer.remove();
                    iv_util.removeDimmed();
                });
                $comfirmLayer.find('.popup_container').removeClass('on');
            }
        },
    };
    var basketConfirmShow = basketConfirmFunc.init;
    IV$(topDocument).find('[id*="iv_memberChk_"] > input').on('IVwishConfirm',function(e){
        IV$(topDocument).find('[onClick*="wishConfirmShow"]').addClass('noEvent');
        wishConfirmFunc.run();
    });
    var wishConfirmFunc = wishConfirmFunc || {
        __layer : null,
        __count : 0,
        __maxCount : 10,
        __autoHide : true,
        __autoFadeTime : 500,
        __autoHideTime : 1500,
        init: function(){
            let IV_WISH_CONFIRM_EVENT = new CustomEvent("IVwishConfirm");
            IV$(topDocument).find('[id*="iv_memberChk_"] > input')[0].dispatchEvent(IV_WISH_CONFIRM_EVENT);
        },
        run : function(){
            wishConfirmFunc.__layer = IV$('#confirmLayer');
            var $comfirmLayer = wishConfirmFunc.__layer;
            var confirmLength = $comfirmLayer.length;
            if(confirmLength > 0){
                clearTimeout(wishConfirmFunc.run);
                if(wishConfirmFunc.__autoHide){
                    $comfirmLayer.find('.popup_container').children('.close').addClass('displaynone');
                    wishConfirmFunc.fadeInAuto();
                }else{
                    iv_util.makeDimmed(true,1,$comfirmLayer.find('.popup_container'));
                    $comfirmLayer.find('.popup_container').addClass('on');
                    wishConfirmFunc.reset();
                };
            }else{
                wishConfirmFunc.__count = wishConfirmFunc.__count + 1;
                if(wishConfirmFunc.__count > wishConfirmFunc.__maxCount){
                    wishConfirmFunc.reset();
                }else{	
                    setTimeout(wishConfirmFunc.run,100);
                };
            };
        },
        set : function(){
            var $comfirmLayer = wishConfirmFunc.__layer;
            IVmcustomScrollbar();
            if($comfirmLayer.find('.base_prd_list').length > 0){
                IVPrdItemInfoCall.init(basePrdItemInfoCallCustom, $comfirmLayer.find('[id^="anchorBoxId_"]')); //상품별 실행 함수
            };
        },
        fadeInAuto : function(){
            var $comfirmLayer = wishConfirmFunc.__layer;
            $comfirmLayer.hide();
            $comfirmLayer.find('.popup_container').addClass('on');
            $comfirmLayer.stop(true,true).fadeIn(wishConfirmFunc.__autoFadeTime).promise().done(function() {
                let chk = IV$('#confirmLayer');
                if(chk.length > 0){
                    setTimeout(wishConfirmFunc.hideAuto,wishConfirmFunc.__autoHideTime);
                }else{
                    wishConfirmFunc.reset();
                };
            });
        },
        hideAuto : function(){
            var $comfirmLayer = wishConfirmFunc.__layer;
            if($comfirmLayer.length > 0){
                $comfirmLayer.stop(true,true).fadeOut(wishConfirmFunc.__autoFadeTime).promise().done(function() {
                    $comfirmLayer.find('.popup_container').removeClass('on').css('transition','all 0s ease 0s');
                    wishConfirmFunc.close();
                });
            }else{
                wishConfirmFunc.reset();
            };
        },
        reset : function(){
            wishConfirmFunc.__count = 0;
            clearTimeout(wishConfirmFunc.run);
            IV$(topDocument).find('[onClick*="wishConfirmShow"]').removeClass('noEvent');
        },
        close : function(){
            var $comfirmLayer = wishConfirmFunc.__layer;
            wishConfirmFunc.reset();
            if($comfirmLayer.find('.popup_container').css('transition') == 'all 0s ease 0s'){
                $comfirmLayer.find('.popup_container').removeClass('on');
                $comfirmLayer.remove();
                iv_util.removeDimmed();
            }else{
                $comfirmLayer.find('.popup_container')[0].addEventListener("transitionend", function(){
                    $comfirmLayer.remove();
                    iv_util.removeDimmed();
                });
                $comfirmLayer.find('.popup_container').removeClass('on');
            }
        },
    };
    var wishConfirmShow = wishConfirmFunc.init;
};

/**
 * 커스텀 셀렉트 생성 
 */
var iv_optionCustomUtil = iv_optionCustomUtil || {
    find: function ($select) {
        /**
         * 상품 셀렉트일때는 초기 옵션값 텍스트 변경 
         */
        if($select[0].tagName == 'SELECT' && $select.attr('data-ivcustom-input') === 'product'){
            var firstOption = $select.find('option:first-child');
            var requiredChk = (firstOption.text().indexOf('필수') > -1) ? true : false;
            var firstOptionTxt = '';
            if(requiredChk){
                firstOptionTxt += iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_REQUIRED_FIXED_TXT;
            }else{
                firstOptionTxt += iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_OPTIONAL_FIXED_TXT;
            };
            firstOptionTxt += ' ' + iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_DEFAULT_FIXED_TXT;
            firstOption.text(firstOptionTxt);
        };
        iv_optionCustomUtil.make($select);
        iv_optionCustomUtil.append($select);
    },
    update : function($select, result){
        var $customSelect = $select.prev('.base_data_connect');
        var dataConnectResult = $customSelect.attr('data-result');
        //본래 select에 변경이 발생했을때
        if($select.val() !== $customSelect.attr('data-selected')){
            var dataVal = $select.val();
            if(dataVal === ''){
                dataVal = '*';
            };
            let $dataOption = $customSelect.find('[data-value="'+ dataVal +'"]');
            var dataText = $dataOption.html();
            $customSelect.find('.base_data_view').html(dataText);
            $customSelect.attr('data-selected', dataVal);
            $dataOption.addClass('selected');
            $customSelect.removeClass('on');
            $customSelect.find('[data-value]').not($dataOption).removeClass('selected');
            if (dataConnectResult == 'button') {
                $customSelect.find('.base_data_select').slideUp();
            };
            let disbledChk = (typeof $select.attr('disabled') === 'undefined') ? false : $select.attr('disabled');
            if(disbledChk === 'disabled'){
                $customSelect.attr('data-disabled','disabled');
            }else{
                $customSelect.removeAttr('data-disabled');
            };
        };
        if(result === true){
            iv_optionCustomUtil.append($select);
        };
    },
    make: function ($select) {
        var $customSelect = $select.prev('.base_data_connect');
        if ($customSelect.length == 0) {
            switch (IV_DEVICE_CHK) {
                case 'pc':
                    var customProductSelect = EC$('<div class="base_data_connect data-done" data-ori="" data-result="select" data-selected=""><h4 class="base_data_view"></h4><ul class="base_data_select"></ul></div>');
                    break;
                case 'mobile':
                    var customProductSelect = EC$('<div class="base_data_connect data-done" data-ori="" data-result="button" data-selected=""><h4 class="base_data_view"></h4><ul class="base_data_select"></ul></div>');
                    break;
                default:
                    console.log('error');
                    break;
            };
            $select.addClass('layout-hidden');
            $select.before(customProductSelect);
            $customSelect = $select.prev('.base_data_connect');
            if ($select.hasClass('displaynone')) {
                $customSelect.addClass('displaynone');
            };
        };
        $customSelect.find('.base_data_view').off().on('click', function () {
            var $this = EC$(this);
            var $dataConnect = $this.closest('.base_data_connect');
            var dataConnectResult = $dataConnect.data('revealtype');
            var classname = '.base_data_connect';
            if($dataConnect.attr('data-disabled') == 'disabled'){
                return false;
            }else{
                if (dataConnectResult == 'select') {
                    if ($dataConnect.hasClass('on')) {
                        $dataConnect.removeClass('on');
                    } else {
                        $dataConnect.addClass('on');
                        iv_util.targetOutCloseFunc($dataConnect);
                    };
                    EC$(classname).not($dataConnect).removeClass('on');
                } else if (dataConnectResult == 'toggle') {
                    if ($dataConnect.hasClass('on')) {
                        $dataConnect.removeClass('on');
                        $dataConnect.find('.base_data_select').slideUp();
                    } else {
                        $dataConnect.addClass('on');
                        $dataConnect.find('.base_data_select').slideDown();
                    };
                    EC$(classname).not($dataConnect).removeClass('on');
                    EC$(classname).not($dataConnect).find('.base_data_select').slideUp();
                };
            };
        });
    },
    append: function ($select) {
        if ($select) {
            var $customSelect = $select.prev('.base_data_connect');
            var isProductSelect = ($select.attr('data-ivcustom-input') === 'product') ? true : false;
            if ($customSelect.length > 0) {
                if (!$select.hasClass('displaynone')) {
                    var required = $select.attr('required');
                    required = (required) ? iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_REQUIRED_FIXED_TXT : iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_OPTIONAL_FIXED_TXT;
                    $customSelect.find('.base_data_select').remove();
                    $customSelect.append('<ul class="base_data_select"></ul>');
                    var selectVal = $select.val();
                    $select.find('option').each(function () {
                        var $option = EC$(this);
                        var value = $option.val();
                        var disabled = ($option.attr('disabled')) ? 'disabled' : '';
                        if (value != '*' && value != '**' && value !== '') {
                            var text = $option.text();
                            var textSplit1,
                                textSplit2;
                            let soldOutChk = false;
                            if(text.indexOf('[품절]') > -1){
                                soldOutChk = true;
                            };
                            if (text.indexOf(iv_commonCustom.__IV_DEFAULT_VALUE_DETAIL_SELECT_CUSTOM_SUB_TXT_SIGN) > -1) {
                                var chk = text.indexOf(iv_commonCustom.__IV_DEFAULT_VALUE_DETAIL_SELECT_CUSTOM_SUB_TXT_SIGN);
                                textSplit1 = text.slice(0, chk).trim();
                                if(soldOutChk){
                                    textSplit2 = text.slice(chk + 1).split('[품절]')[0].trim();
                                    text = '<strong>' + textSplit1 + '</strong><span>' + textSplit2 + '<span class="soldOut">'+ iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_SOLDOUT_FIXED_TXT +'</span></span>';
                                }else{
                                    textSplit2 = text.slice(chk + 1).trim();
                                    text = '<strong>' + textSplit1 + '</strong><span>' + textSplit2 + '</span>';
                                };
                            } else {
                                if(soldOutChk){
                                    text = text.split('[품절]')[0].trim();
                                    text = '<strong>' + text + '<span class="soldOut">'+ iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_SOLDOUT_FIXED_TXT +'</span></strong>';
                                }else{
                                    text = '<strong>' + text + '</strong>';
                                };
                            };
                            var $li = IV$('<li data-value="' + value + '" class="base_data_option">' + text + '</li>');
                            if(disabled !== ''){
                            	$li.attr('data-disabled', 'disabled');
                            }
                            if (value == selectVal) {
                                $customSelect.find('.base_data_view').html(text);
                                $li.addClass('selected');
                                $customSelect.attr('data-selected', value);
                            };
                            $customSelect.find('.base_data_select').append($li);
                        };
                    });
                    if(isProductSelect){
                        var defaultTxt = required + ' ' + iv_commonCustom.__IV_DEFAULT_VALUE_OPTION_DEFAULT_FIXED_TXT;
                        $customSelect.find('.base_data_select').prepend('<li data-value="*" class="base_data_option">' + defaultTxt + '</li>');
                    }else{
                        $customSelect.find('.base_data_select').prepend('<li data-value="*" class="base_data_option">' + $select.find('option').eq(0).text() + '</li>');
                    };
                    let disbledChk = (typeof $select.attr('disabled') === 'undefined') ? false : $select.attr('disabled');
                    if ($customSelect.find('.base_data_option').length == 1 || disbledChk == 'disabled') {
                        $customSelect.attr('data-disabled', 'disabled');
                    } else {
                        $customSelect.removeAttr('data-disabled');
                    };
                    if (selectVal == '*' || selectVal == '') {
                        if(isProductSelect){
                            $customSelect.find('.base_data_view').text(defaultTxt);
                            $customSelect.find('.base_data_select [data-value="*"]').addClass('selected');
                            $customSelect.attr('data-selected', '*');
                        }else{
                            $customSelect.find('.base_data_view').text($select.find('option').eq(0).text());
                            $customSelect.find('.base_data_select [data-value="*"]').addClass('selected');
                            $customSelect.attr('data-selected', '*');
                        };
                    };
                    var dataConnectResult = $customSelect.attr('data-result');
                    if (dataConnectResult == 'select') {
                        $customSelect.attr('data-revealType', 'select');
                        try {
                            $customSelect.find('.base_data_select').mCustomScrollbar({
                                axis: "y",
                                theme: "minimal-dark",
                                alwaysShowScrollbar: 0,
                                callbacks: {
                                    onInit:function(){
                                        let $scrollBox = $customSelect.find(".mCustomScrollBox");
                                        let $scrollContent = $customSelect.find(".mCSB_container");
                                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                                        (gap < 10) ? $customSelect.find(".mCSB_scrollTools").addClass("layout-hidden") : $customSelect.find(".mCSB_scrollTools").removeClass("layout-hidden");
                                    },
                                    onBeforeUpdate: function () {
                                        let $scrollBox = $customSelect.find(".mCustomScrollBox");
                                        let $scrollContent = $customSelect.find(".mCSB_container");
                                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                                        (gap < 10) ? $customSelect.find(".mCSB_scrollTools").addClass("layout-hidden") : $customSelect.find(".mCSB_scrollTools").removeClass("layout-hidden");
                                    },
                                    onScrollStart: function () {
                                        let $scrollBox = $customSelect.find(".mCustomScrollBox");
                                        let $scrollContent = $customSelect.find(".mCSB_container");
                                        let gap = Math.abs($scrollBox.outerHeight() - $scrollContent.outerHeight());
                                        (gap < 10) ? $customSelect.find(".mCSB_scrollTools").addClass("layout-hidden") : $customSelect.find(".mCSB_scrollTools").removeClass("layout-hidden");
                                    }
                                }
                            });
                        }catch(e) {
							console.log(e);
                        }
                    } else if (dataConnectResult == 'button') {
                        $customSelect.attr('data-revealType', 'toggle');
                    };
                    $customSelect.find('.base_data_option').off().on('click', function () {
                        var $dataOption = EC$(this);
                        var dataVal = $dataOption.attr('data-value');
                        if(dataVal === '*' && $select.find('option[value="' + dataVal + '"]').length === 0){
                            dataVal = '';
                        };
                        var dataText = $dataOption.html();
                        if (!$dataOption.hasClass('selected')) {
                            $select.find('option[value="' + dataVal + '"]').prop('checked', true);
                            $select.val(dataVal).trigger('change');
                            $customSelect.find('.base_data_view').html(dataText);
                        };
                        $customSelect.attr('data-selected', dataVal);
                        $dataOption.addClass('selected');
                        $customSelect.removeClass('on');
                        $customSelect.find('[data-value]').not($dataOption).removeClass('selected');
                        if (dataConnectResult == 'button') {
                            $customSelect.find('.base_data_select').slideUp();
                        };
                    });
                    EC$($select).on('change',function(){
                        let value = $select.val();
                        if(value == '*' || value == '**'){
                            let $defaultOption = $customSelect.find('[data-value="*"]');
                            $customSelect.find('.base_data_view').html($defaultOption.html());
                            $customSelect.attr('data-selected', '*');
                            $defaultOption.addClass('selected');
                            $customSelect.removeClass('on');
                            $customSelect.find('[data-value]').not($defaultOption).removeClass('selected');
                            if (dataConnectResult == 'button') {
                                $customSelect.find('.base_data_select').slideUp();
                            };
                        }
                    });
                }
            }
        }
    },
};

//상품 데이터 동적으로 붙이기
var IVPrdDynamicCall= IVPrdDynamicCall || {
    __IV_DEFAULT_VALUE_FUNCTION_USE : true, //이 함수 사용할 것인지
    __IV_DEFAULT_VALUE_AJAX_URL : ['/exec/front/Product/ApiProductNormal', '/exec/front/Product/ApiProductMain'], /* data 호출 url */
    __IV_DEFAULT_VALUE_CONDITION_ARRAY : [],
    __IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY : [],
    __IV_DEFAULT_VALUE_PRDLIST_AJAX_CALL_CUSTOM_DATA : {},
    __IV_DEFAULT_VALUE_AJAX_COUNT : 200, //max 200
    __IV_DEFAULT_VALUE_MOREBUTTON_TEXT : '+ 더보기',
    __IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG : null,
    __IV_DEFAULT_VALUE_CUSTOM_FUNCTION : null, //custom function
    /**
     * @ no : 동적상품영역 고유번호
     * @ $basePrdList : 동적상품영역 기준 최상위 엘리먼트 .base_prd_list 
     * @ $prdList : 상품이 붙는 영역 (직계 자식으로 상품 추가됨)
     * @ basicSettingArray : 카페24 상품 관련 설정 (ajax 호출 페이지 등)
     * @ ivSettingArray : IV 커스텀 세팅 설정 
     * @ _prdList_categoryList 상품분류 페이지의 일반 상품 진열 영역 > .prdItem_normalBox .base_prd_list
     */
    _prdList_categoryList : null,
    init: function(){ 
        IVPrdDynamicCall._prdList_categoryList = IV$('.prdItem_normalBox .base_prd_list')[0];
        /**
         * .base_prd_list 마크업 기준으로 생성 (필수)
         */
        IV$('.base_prd_list').each(function(idx, el){
            let $basePrdList = IV$(el);
            let no = IVPrdDynamicCall.getCondition($basePrdList); //호출 조건 세팅 no : 해당 영역 고유 번호 / false : 사용안함
            if( no !== false ){
                //해당 함수 사용 시
                if(IVPrdDynamicCall.__IV_DEFAULT_VALUE_FUNCTION_USE){
                    //상품 분류 일반 상품 진열 영역의 경우 큐레이션 동작 아닐때만 실행 
                    if(el == IVPrdDynamicCall._prdList_categoryList){
                        if(IV_LOCATION_HREF.indexOf('keyword=&search_form') === -1){
                            let keyword = IV_LOCATION_HREF.indexOf('keyword=&');
                            let cateFilter = IV_LOCATION_HREF.indexOf('%3Fcate_no%3D' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE);
                            if(keyword > -1){
                                let newLink = IV_LOCATION_HREF;
                                if(IV_LOCATION_HREF.indexOf('keyword=&rel_keyword=&') > -1){
                                    newLink.replace('keyword=&rel_keyword=','');
                                }else{
                                    newLink = newLink.replace('keyword=&','');
                                };
                                history.replaceState(null, null, newLink);  
                            };
                            let storage_ivCateInfo = sessionStorage.getItem('iv_cate_info');
                            let storage_ivCateInfo2 = sessionStorage.getItem('iv_cate_info2');
                            let storage_ivCateInfo3 = sessionStorage.getItem('iv_cate_info3');
                            try {
                                if(typeof storage_ivCateInfo3 === 'string' && typeof storage_ivCateInfo2 !== 'undefined' && typeof storage_ivCateInfo !== 'undefined'){
                                    storage_ivCateInfo = JSON.parse(storage_ivCateInfo);
                                    storage_ivCateInfo2 =  JSON.parse(storage_ivCateInfo2);
                                    storage_ivCateInfo3 =  JSON.parse(storage_ivCateInfo3);
                                    var iNowTime = Math.floor(new Date().getTime() / 1000);
                                    var iSessionTime = 60 * 5;
                                    if(typeof storage_ivCateInfo3 === 'string' && iNowTime - Number(storage_ivCateInfo['saveTime']) < iSessionTime && storage_ivCateInfo['oriCatePage']=== window.location.href){
                                        $basePrdList.find('.prdList').html(storage_ivCateInfo3);
                                        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no]; //카페24 기본 설정
                                        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no]; //IV 커스텀 설정
                                        IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no] = storage_ivCateInfo2;
                                        basicSettingArray['page'] = 3;
                                        if(storage_ivCateInfo['viewType']){
                                            IV$('.iv_viewType').find('[data-view="'+ storage_ivCateInfo['viewType'] +'"]').trigger('click');
                                        };
                                        IVPrdDynamicCall.run(no, $basePrdList);
                                    }else{
                                        IVPrdDynamicCall.run(no, $basePrdList);
                                    };
                                }else{
                                    IVPrdDynamicCall.run(no, $basePrdList);
                                };
                            }
                            catch (err) {
                                console.log(err); 
                                sessionStorage.removeItem('iv_cate_info');
                                sessionStorage.removeItem('iv_cate_info2');
                                sessionStorage.removeItem('iv_cate_info3');
                                IVPrdDynamicCall.run(no, $basePrdList);
                            };
                        };
                    }
                    //나머지는 @ivuse -> yes 값이 있으면 실행 
                    else{
                        IVPrdDynamicCall.run(no, $basePrdList);
                    };
                };
            };
            /**
             * 해당 함수 off되더라도 dom 변경 감지하여, 상품별로 호출해야 하는 함수가 있는 경우 실행될 수 있도록 함
             */
            if($basePrdList.find('.prdList').length > 0){
                $basePrdList.find('.prdList').iv_observerFunc( function(a,b,c){
                    //자식 노드 추가될 때 실행
                    //if(a[0].addedNodes){
                    if(typeof IVPrdItemInfoCall !== 'undefined'){
                        if(typeof basePrdItemInfoCallCustom !== 'undefined'){
                            IVPrdItemInfoCall.init(basePrdItemInfoCallCustom, $basePrdList.find('[id^="anchorBoxId_"]')); //상품별 실행 함수
                        }else{
                            IVPrdItemInfoCall.init(); //상품별 실행 함수
                        };
                    };
                    //}
                } , {
                    attributes: false,
                    childList: true, /* 자식요소만 변경 감지 */
                    subtree: false
                });
            };
        });
    },
    getCondition : function($basePrdList){
        /**
         * 주석에 입력된 내용 기반으로 조건 생성
         * @ $basePrdList : 기준으로 정보 호출
         */ 
        //조건 전체
        let targetHtml = String($basePrdList.html()); 
        let index1 = targetHtml.indexOf('<!--');
        let index2 = targetHtml.indexOf('-->');
        let condition = targetHtml.slice((index1+4), index2); 
        condition = iv_util.removeBlankFunc(condition); 
        let useChk = false,  //해당 기능 사용할 것인지 최종확인
            sTargetModuleName, //모듈타입
            count; //실행 체크 카운트
        if(IVPrdDynamicCall.__chkCount){ count = Number(IVPrdDynamicCall.__chkCount); } else { IVPrdDynamicCall.__chkCount = 0; count = 0; } 
        //설정 obj
        let array1 = {}; //카페24 기본 설정 obj
        let array2 = {}; //IV 커스텀 설정 obj
        var sum = condition.split(/\s/gi).reduce(function (acc, v, i) {
            if(v){
                if(v != '' && v!= '\n' && v.indexOf('basket') == -1){
                    if(v.indexOf('$') > -1){
                        /**
                         * 기존 주석옵션 ($)
                         */
                        let con = v.trim(),
                            name = con.split('=')[0].replace('$',''),
                            value = con.split('=')[1];
                        if(name == 'count' || name == 'sort_method' || name == 'ec_soldout_display' || name == 'cate_no'){
                            array1[name] = value;
                        }else if(name == 'cache'){
                            array1['b_' + name] = value;
                        };
                    }else if(v.indexOf('@iv') > -1){
                        /**
                         * 커스텀 옵션 (@)
                         */
                        let con = v.trim(),
                            name = con.split('=')[0].replace('@',''),
                            value = con.split('=')[1];
                        if(name == 'ivuse' && value == 'yes'){
                            useChk = true;
                        };
                        array2[name] = value;
                    };
                };
            };
        },[]);
        if(useChk){ 
            IVPrdDynamicCall.__chkCount = count + 1;
            //필요한 요소이나 주석에 기록하지 않는 항목 추가
            array1['first_page'] = 1;
            array1['page'] = 1; 
            array1['idx'] = count;
            let displaygroup = Number($basePrdList.siblings('.base_paginate_container').attr('data-ivdynamic-displyagroup'));  //더보기 버튼에서 가져옴 
            if(displaygroup === null || displaygroup === 'undefined' || displaygroup === ''){
                array1['display_group'] = 1;
            }else{
                array1['display_group'] = displaygroup;
            };
            //상품분류 페이지 일반 상품 영역
            if($basePrdList[0] === IVPrdDynamicCall._prdList_categoryList){
                array1['cate_no'] = IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE;
                array2['ivmodule'] = 'xans-product-listnormal';
                array1['sort_method'] = (typeof array1['sort_method'] === 'undefined') ? Number(iv_util.getParameterByName(IV_LOCATION_HREF, 'sort_method')) : array1['sort_method'];
            };
            //카테고리
            if(typeof array1['cate_no'] === 'undefined' || array1['cate_no'] === 0){
                array1['cate_no'] = 1;
            };
            //정렬
            if(typeof array1['sort_method'] === 'undefined'){ 
                array1['sort_method'] = 0;
            };
            //모듈 타입
            if(typeof array2['ivlink'] !== 'undefined'){
                if(array2['ivlink'] === '0'){
                    array2['ivmodule'] = 'xans-product-listnormal';
                    array2['ivstorage'] = 'sStorageList_' + array1['cate_no'] + '_' +  array1['display_group'];
                    if(array1['b_cache'] === 'yes'){
                        array1['first_page'] = EC$.cookie('mobile_more_current_page_' + array1['cate_no']);
                    };
                }else if(array2['ivlink'] === '1'){
                    let moduleNumber = $basePrdList[0].classList;
                    let moduleNumberChk = function(item){ if(item.indexOf('xans-product-listmain-') > -1){ return true; } }
                    moduleNumber = iv_util.onlyNumbFunc(moduleNumberChk);
                    array2['ivmodule'] = 'xans-product-listmain-' + moduleNumber;
                    array2['ivstorage'] = 'sStorageList_' + moduleNumber;
                    if(array1['b_cache'] === 'yes'){
                        array1['first_page'] = EC$.cookie('mobile_more_current_page_' + moduleNumber);
                    };
                }else{
                    array2['ivmodule'] = 'iv-dynamic-custom';
                };
            };

            array1['cate_no'] = Number(array1['cate_no']);
            array1['count'] = Number(array1['count']);
            array1['sort_method'] = Number(array1['sort_method']);

            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[count] = array1; //카페24 기본 설정 
            IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[count] = array2; //IV 커스텀 설정

            $basePrdList.attr({'data-ivdynamic-idx' : count, //고유번호
                               'data-ivdynamic-init' : count 
                              }).addClass('iv_dynamic_prdList_' + count); //고유 클래스

            return count; 
        } else { 
            return false; //사용안하는 경우 false return 
        };
    },

    setData : function(no){

        /**
         * 데이터 세팅
         */
        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no]; //카페24 기본 설정 
        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no]; //IV 커스텀 설정
        let moredata = basicSettingArray; //ajax를 요청하기 위한 data obj
        return moredata;
    },

    sModuleHtmlForVDOM : function(sTargetModuleName, sPos){
        /**
         * VDOM에서 모듈 템플릿 호출 
         */
        var sModuleHtmlForVDOM = CAFE24.FRONT_XANS_TEMPLATE.getTemplateForVDOM(sTargetModuleName);
        var $li = EC$.fn[sPos].apply(EC$(sModuleHtmlForVDOM).find('ul').first().children('li'));
        $li.removeClass('on');
        var sLiHtmlForVDOM = EC$('<ul>').append($li).html();
        return CAFE24.FRONT_XANS_TEMPLATE.convertVDomHtmlToHTML(sLiHtmlForVDOM);
    },

    getLiTemplate : function(sTargetModuleName, prdData){
        /**
         * 데이터/템플릿에서 li템플릿 호출
         */
        var sFirstLiTemplate = IVPrdDynamicCall.sModuleHtmlForVDOM(sTargetModuleName, 'first');
        var sLiTemplate = IVPrdDynamicCall.sModuleHtmlForVDOM(sTargetModuleName, 'last');
        var aHtml = [];
        var sTemplate = sLiTemplate;
        EC$(prdData).each(function(iIndex, aVar) {
            if (iIndex === 0) {
                sTemplate = sFirstLiTemplate;
            } else {
                sTemplate = sLiTemplate;
            };
            aHtml.push(CAFE24.FRONT_XANS_INTERPRETER.fetch(sTemplate, aVar));
        });
        var sHtml = aHtml.join('');
        return sHtml;
    },

    dynamicDataEnd : function(no, $basePrdList, moredata, type){
        switch(type){
            case 'page' : 
                IVPrdDynamicCall.makePagination(no, $basePrdList, moredata);
                break;
            case 'button' : case  'scroll' :
                IVPrdDynamicCall.makeMoreButton(no, $basePrdList, moredata);
                break;
            case 'swipe' :
                break;
            default :
                break;
        };

    },

    makePagination: function(no, $basePrdList, moredata){
        /**
         * 페이지네이션 생성
         */
        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no];
        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no];
        let prdListData = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no];
        let $basicButton = $basePrdList.siblings('[class*="xans-product-listmore"]');
        let lastNum;
        let count = Number(basicSettingArray.count);
        if(prdListData){
            lastNum = Math.ceil(prdListData.length/count);
        }else{
            lastNum = $basicButton.find('[id^="more_total_page"]').text();
        };
        if(typeof moredata !== 'undefined'){
            IVPrdDynamicCall.saveCache(moredata, lastNum);
        };
        let $paginate = IV$('.iv_dynamic_paginate[data-ivdynamic-idx="'+no+'"]'); //페이지네이션 element
        //기존 페이지네이션 갱신
        if($paginate.length > 0){
            let chkLast = Number($paginate.attr('data-ivdynamic-last')); //마지막 페이지 
            let chkCount = Number($paginate.attr('data-ivdynamic-count')); //페이지 당 보이는 상품 수
            let chkLimit = Number($paginate.attr('data-ivdynamic-limit')); //페이지네이션 생성 시 리밋 (ex 리밋 5 -> 페이지네이션 번호 1,2,3,4,5 / 6,7,8,9,10, 리밋 3 -> 페이지네이션 번호 1,2,3 / 4,5,6 )
            let chkPage = Number($paginate.attr('data-ivdynamic-page')); //현재 보는 페이지 번호
            let $pagination = $paginate.find('ol'); //페이지네이션 번호 목록 
            let newViewEnd = Math.ceil(chkPage/chkLimit)*chkLimit; //새로 갱신 시 마지막 페이지네이션 목록 번호 
            let newViewStart = newViewEnd - chkLimit; //새로 갱신 시 최초 페이지네이션 목록 번호 
            if(newViewEnd > chkLast){ 
                newViewEnd = chkLast;
            };
            let $pageAll = '';
            for(var i=newViewStart; i<newViewEnd; i++){
                let $page = '<li><a href="javascript:void(0);" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                if(i==0){
                    $page = '<li class="on"><a href="javascript:void(0);" class="this" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                }else{
                    $page = '<li><a href="javascript:void(0);" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                };
                $pageAll += $page;
            };
            $pagination.html($pageAll);
        }
        //페이지네이션 최초 생성 
        else{
            let pageViewLimit = Number(ivSettingArray.ivpage); //페이지네이션 생성 시 리밋 (ex 리밋 5 -> 페이지네이션 번호 1,2,3,4,5 / 6,7,8,9,10, 리밋 3 -> 페이지네이션 번호 1,2,3 / 4,5,6 )
            let $paginationHtml = IV$('<div class="base_paginate_container iv_dynamic_paginate" data-ivdynamic-page="1" data-ivdynamic-count="'+ basicSettingArray.count +'" data-ivdynamic-idx="'+ no +'" data-ivdynamic-last="'+ lastNum +'" data-ivdynamic-limit="'+ pageViewLimit +'"></div>');
            let $goFirst = IV$('<a href="javascript:void(0);" class="first" data-page="1">first</a>');
            let $goPrev = IV$('<a href="javascript:void(0);" class="prev" data-page="1"></a>');
            let $pagination = IV$('<ol></ol>');
            let makePage = pageViewLimit;
            if(lastNum<pageViewLimit){
                makePage = lastNum;
            };
            let $pageAll = '';
            for(var i=0; i<makePage; i++){
                let $page = '<li><a href="javascript:void(0);" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                if(i==0){
                    $page = '<li class="on"><a href="javascript:void(0);" class="this" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                }else{
                    $page = '<li><a href="javascript:void(0);" data-page="'+ (i+1) +'">'+ (i+1) +'</a></li>';
                };
                $pageAll += $page;
            };
            $pagination.html($pageAll);
            let $goNext = IV$('<a href="javascript:void(0);" class="next" data-page="2">next</a>');
            let $goLast = IV$('<a href="javascript:void(0);" class="last" data-page="'+ lastNum +'">last</a>');
            $paginationHtml.append($goFirst, $goPrev, $pagination, $goNext, $goLast);
            $paginationHtml.insertAfter($basePrdList);
            $paginate = $paginationHtml;
            //최초 필터링 
            IVPrdDynamicCall.filter(no, $basePrdList);
        };
        //페이지네이션 a태그 클릭 시 data-page값에 맞춰 이동
        $paginate.find('a').off().on('click',function(){
            let page = Number($(this).attr('data-page'));
            IVPrdDynamicCall.goPage(no, page, $basePrdList);
        });
    },

    goPage : function(no, page, $basePrdList){

        /**
         * 페이지네이션 페이지 이동 
         */

        page = Number(page);

        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no];
        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no];

        let $paginate = $basePrdList.siblings('.iv_dynamic_paginate[data-ivdynamic-idx="'+no+'"]'); //페이지네이션 
        let viewCount = Number(basicSettingArray.count); //한 페이지 당 보이는 상품 수 
        let maxCount = Number($paginate.attr('data-ivdynamic-last')); //마지막 페이지 
        let limitCountMin = Number($paginate.find('ol li:first-child a').attr('data-page')); //페이지 목록 첫번째 
        let limitCountMax = Number($paginate.find('ol li:last-child a').attr('data-page')); //페이지 목록 마지막 

        let lastViewIndex = viewCount*page - 1;
        let startViewIndex = lastViewIndex - viewCount + 1;
        let nextpage;
        let prevpage;

        //현재 보이는 페이지네이션 목록 범위에 이동 페이지 내용이 없다면 다시 목록 생성 
        $paginate.attr('data-ivdynamic-page',page);
        if((page > limitCountMax) || (page < limitCountMin)){
            IVPrdDynamicCall.makePagination(no, $basePrdList);
        };
        //페이지네이션에 이동 후 페이지 내용 갱신 
        $paginate.find('ol a[data-page]').removeClass('this');
        $paginate.find('ol a[data-page]').parent().removeClass('on');
        $paginate.find('ol a[data-page="'+ page +'"]').addClass('this');
        $paginate.find('ol a[data-page="'+ page +'"]').parent().addClass('on');
        nextpage = ((page+1) > maxCount) ? maxCount : page+1;
        prevpage = ((page-1) < 1) ? 1 : page-1;
        $paginate.find('.next').attr('data-page', nextpage);
        $paginate.find('.prev').attr('data-page', prevpage);

        //현재 주소줄 내용 갱신 ---> 상품 분류 페이지 & 일반 상품 영역 일 경우에만
        if($basePrdList[0] == IVPrdDynamicCall._prdList_categoryList){
            let makePage;
            let nowLink = window.location.href;
            let linkPage = iv_util.getParameterByName(nowLink, 'page_num');
            let newLink;
            if(linkPage != ''){
                newLink = nowLink.replace('&page_num='+linkPage, '&page_num='+page);
            }else{
                let prevParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[0];
                let lastParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[1];
                newLink = prevParam + '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE + '&page_num=' + page + lastParam;
            };
            history.replaceState(null, null, newLink);  
        };

        //페이지 갱신 내용에 맞춰 상품 display 변경
        let condition = function(v, i){
            if(i >= startViewIndex && i <= lastViewIndex ){
                return true;
            }else{
                return false;
            };
        };
        IVPrdDynamicCall.filtering(no, condition, $basePrdList);
    },

    saveCache : function(moredata, count){
        //캐시 저장 기능 사용 시 
        if(typeof moredata['b_cache'] !== 'undefined'){
            if(moredata['cate_no']){
                EC$.cookie('mobile_more_current_page_' + moredata['cate_no'], (count), { expires: 1 });
            }else{
                EC$.cookie('mobile_more_current_page_' + moredata['display_group'], (count), { expires: 1 });
            };
        };
    },

    filtering : function(no, condition, $basePrdList){
        /**
         * 상품 목록 필터링
         * @ prdListData : no 기준 상품 데이터
         * @ $prdList : 상품 목록이 붙는 영역
         * @ gridMax : 상품 목록 grid 기준 (class 부여 기준)
         */
        let prdListData = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA'+no],
            $prdList = $basePrdList.find('.prdList'),
            gridMax; 
        if($basePrdList.find('.iv_dynamic_nodata')){$basePrdList.find('.iv_dynamic_nodata').remove();}
        let gridClassChk = function(item){ if(item.indexOf('grid') > -1){ return true; } }
        let gridClassList = $prdList[0].classList.value.split(' ');
        if(gridClassList){
            gridMax = iv_util.onlyNumbFunc(gridClassList.filter(gridClassChk)) - 1;
        };
        if(gridMax == -1){
            gridMax = 1;	
        };
        let num = 0;
        let result = [];
        result = prdListData.reduce(function(acc, v, i, arr){
            let $prdEl = $prdList.children('[id^="anchorBoxId_"]').eq(i);
            if($prdEl.length > 0){
                let nClassChk = function(item){ if(item.indexOf('n') == 0){ return true; } }
                let nClass = $prdEl[0].classList.value.split(' ').filter(nClassChk);
                $prdEl.removeClass('on last-view even filter-chk '+ nClass);
            };
            if(condition(v,i) !== false){
                if(num > gridMax){ 
                    num = 0;
                    num++;
                }else{ 
                    num++; 
                };
                let addClass = '';
                if(num == 2 && gridMax == 1){
                    addClass = 'even';
                };
                $prdEl.addClass('on filter-chk n'+num + ' ' + addClass);
                acc[i] = i;
                return acc;
            }else{
                //$prdEl.removeClass('on');
                return acc;
            };
        },[]);
        if(result.length == 0){
            $basePrdList.append('<div class="iv_base_nodata iv_dynamic_nodata"><p>결과가 없습니다.</p></div>');
        }else{
            let lastIndex = result[result.length-1];
            $prdList.children().eq(lastIndex).addClass('last-view');
        };
        //console.log(result);
        IVPrdItemInfoCall.init(basePrdItemInfoCallCustom, $basePrdList.find('[id^="anchorBoxId_"].on')); 

        return result;
    },


    run : function(no, $basePrdList){

        /**
         * 상품 동적 호출 시작
         * @ no : 영역별 고유 번호
         * @ $basePrdList : .base_prd_list
         */
        let $prdList; //상품이 붙을 영역
        let $basicButton = $basePrdList.siblings('[class*="xans-product-listmore"]'); //기존 더보기 버튼 (base_prd_list 다음 요소여야 정상 동작)

        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no]; //카페24 기본 설정
        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no]; //IV 커스텀 설정
        let moredata = IVPrdDynamicCall.setData(no); //ajax 호출 요청 시 필요한 데이터
        let ajaxLink = IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_URL[Number(ivSettingArray.ivlink)]; //ajax 링크

        let defaultViewCount =  moredata['count']; //기본 노출 수 
        let pageChk = moredata['page'];

        let type = ivSettingArray.ivmoretype; //더보기 출력 방식(페이지네이션/더보기/무한스크롤/swipe)
        let sTargetModuleName = ivSettingArray['ivmodule'];
        let sStorageListName = ivSettingArray['ivstorage'];

        let sStorageListData;

        let chkCount = pageChk; //ajax 호출 완료 체크용

        let typeChk; 
        let lastPageChk = 0;

        let lastPageNum;
        let resultType = true;

        /**
         * 고유번호별 데이터 저장 위치 지정
         */
        if(typeof IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no] === 'undefined'){
            IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no] = [];
        };

        /**
         * 기존 더보기 버튼 유무에 따라 호출 방식 지정
         * @ seq 동기 호출
         * @ async 비동기 호출
         */
        if($basicButton.length > 0){
            $basicButton.hide(); //기존 버튼 감춤
            if(sTargetModuleName.indexOf('xans-product-listmain') > -1 && Number(basicSettingArray['display_group']) != 0){
                typeChk = 'seq';
            }else{
                typeChk = 'async';
            };
        }else{
            typeChk = 'seq';
        };

        //필터 사용 여부 
        let filterUseChk = false;
        if(($basePrdList.attr('data-ivdynamic-connect') !== 'undefined') && (typeof ivSettingArray.ivfilter !== 'undefined') ){
            filterUseChk = true;	
        }
        $basePrdList.attr('data-ivdynamic-type', type);
        let testchkCount = 0;

        /**
         * 캐시 저장 유무에 따른 분류 
         */
        if(Number(basicSettingArray['first_page']) !== 1 && basicSettingArray.b_cache =='yes'){
            ( storageDataChk = function(){
                try {
                    sStorageListData = sessionStorage.getItem(sStorageListName);
                    if(sStorageListData){
                        console.log('캐시 사용하고 있고 세션에 데이터 있음');
                        IVPrdDynamicCall.displayMore(ajaxLink, '', moredata, defaultViewCount, true).then(function(res) {
                            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG = 'wait'; //캐시사용시 상품 append flag 시작
                            callDataNormal();
                        });
                    }else{
                        testchkCount++;
                        if(testchkCount < 5){
                            setTimeout(function(){storageDataChk();},100);
                        }else{
                            console.log('캐시 사용하고 있는데 세션에 데이터 없음');
                            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG = false; //캐시사용시 상품 append flag 필요X
                            callDataNormal();
                        };
                    };
                } catch (e) {
                }
            })();
        }else{
            console.log('첫번째 호출이거나 캐시 저장 기능 사용안함');
            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG = false; //캐시사용시 상품 append flag 필요X
            callDataNormal();
        };

        /**
         * 영역타입별 상품 호출
         */
        function callDataNormal(){
            //상품 분류 페이지 일반 상품 영역
            if($basePrdList[0] == IVPrdDynamicCall._prdList_categoryList){
                callData();
            }
            //상품 분류 페이지의 일반 상품 영역이 아닌 경우 
            else{
                let testData = JSON.parse(JSON.stringify(moredata));
                testData['page'] = 1;
                IVPrdDynamicCall.displayMore(ajaxLink, '', testData, defaultViewCount, true).then(function(res) {
                    let prdData = res;
                    $basePrdList.find('.prdList').html(IVPrdDynamicCall.getLiTemplate(sTargetModuleName, res));
                    callData();
                });
            };
        };

        /**
         * 더보기 방식에 따라 분기처리
         */
        function callData(){
            /**
             * @ page : 페이지네이션
             * @ button : 더보기 버튼
             * @ scroll : 무한스크롤
             * @ swipe : swiper 
             */
            switch(type){
                case 'page' :
                    $prdList = $basePrdList.find('.prdList');
                    ( dataCall = function(){
                        if(typeChk === 'seq'){
                            call_seq(resultType);
                        }else{
                            call_async(resultType);
                        };
                    })();
                    break;
                case 'button' :
                    $basicButton.hide();
                    $prdList = $basePrdList.find('.prdList');
                    if(typeChk === 'seq'){
                        call_seq(resultType);
                    }else{
                        call_async(resultType);
                        //filterUseChk = false;
                    };
                    break;
                case 'scroll' :
                    $basicButton.hide();
                    $prdList = $basePrdList.find('.prdList');
                    if(typeChk === 'seq'){
                        call_seq(resultType);
                    }else{
                        call_async(resultType);
                    };
                    filterUseChk = false;
                    break;
                case 'swipe' :
                    filterUseChk = false;
                    $basicButton.hide();
                    $prdList = $basePrdList.find('.prdList');
                    //sessionStorage.removeItem(sStorageListName);
                    resultType = false;
                    if(! $prdList.hasClass('swiper-wrapper')){
                        $prdList.addClass('iv_swiper');
                        $prdList.attr('data-ivswipe-name', 'ivdynamic'+no);
                        $prdList.attr('data-ivswipe-custom', 'false');
                        $prdList.attr('data-ivswipe-module', 'scrollbar');
                        callDataNormal_Swipe();
                    }else{
                        callDataNormal_Swipe();
                    };
                    function callDataNormal_Swipe(){
                        if(typeChk === 'seq'){
                            call_seq(resultType).then(function(resFin) {
                                $prdList.iv_swiperFunc();
                                let swiperName = $prdList.attr('data-ivswipe-name');
                                window[swiperName].on('reachEnd',function(){
                                    let beforeLength = $prdList.children().filter('[data-prd]').length;
                                    let sliceArray = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no].slice(beforeLength, beforeLength+Number(defaultViewCount));
                                    if(sliceArray.length > 0){
                                        $prdList.append(IVPrdDynamicCall.getLiTemplate(sTargetModuleName, sliceArray));
                                    };
                                });
                            });
                        }else{
                            call_async(resultType).then(function(resFin) {
                                $prdList.iv_swiperFunc();
                                let swiperName = $prdList.attr('data-ivswipe-name');
                                window[swiperName].on('reachEnd',function(){
                                    let beforeLength = $prdList.children().filter('[data-prd]').length;
                                    let sliceArray = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no].slice(beforeLength, beforeLength+Number(defaultViewCount));
                                    if(sliceArray.length > 0){
                                        $prdList.append(IVPrdDynamicCall.getLiTemplate(sTargetModuleName, sliceArray));
                                    };
                                });
                            });
                        };
                    };
                    //if(IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG === false){
                    if(typeof IVPrdDynamicCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION === 'function'){
                        IVPrdDynamicCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION();
                    };
                    IVPrdDynamicCall.initAfter();
                    $basePrdList.addClass('ivdynamic-done');
                    //}
                    break;
                default :
                    break;
            };

            if(filterUseChk === false){
                IV$('.iv_dynamic_filter:not(.done)').addClass('displaynone');
            };

            //순차 연쇄 실행
            function call_seq(resultType){
                console.log('동기 연쇄 실행');
                return new Promise(function (resFin, rejFin) {
                    let count = Number(IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_COUNT);
                    //sessionStorage.removeItem(sStorageListName);
                    ( seqDataCall = function(){
                        IVPrdDynamicCall.displayMore(ajaxLink, '', moredata, count).then(function(res) {
                            if(res != 'end'){
                                moredata['page'] = Number(moredata['page']) + 1;
                                chkCount++;
                                seqDataCall();
                            }else{
                                resFin(true);
                            };
                        });
                    })();
                }).then(function(resFin){
                    IVPrdDynamicCall.dynamicDataEnd(no, $basePrdList, moredata, type);
                });
            };
            //비동기 연쇄 실행
            function call_async(resultType){
                console.log('비동기 연쇄 실행');
                return new Promise(function (resFin, rejFin) {
                    let count = Number(IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_COUNT); //한 번 호출 실행 시 호출할 상품 수 
                    //sessionStorage.removeItem(sStorageListName);
                    let maxPrdCount;
                    let test = Number($basicButton.find('[id^="more_total_page"]').text()); //더보기 버튼에 적힌 마지막 페이지 숫자
                    maxPrdCount = Number($basicButton.find('[id^="more_total_page"]').text()) * defaultViewCount; //페이지 기준 최대 수량 
                    let callCount = Math.ceil(maxPrdCount/Number(IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_COUNT)); //필요한 ajax 호출 횟수
                    if(pageChk > callCount){
                        callCount = pageChk;
                    };
                    if(callCount > 0){ 
                        for(let i=pageChk; i<=callCount; i++){
                            moredata['page'] = i;
                            IVPrdDynamicCall.displayMore(ajaxLink, '', moredata, count).then(function(res) {
                                if(chkCount == callCount){
                                    //IVPrdDynamicCall.dynamicDataEnd(no, $basePrdList, moredata, type);
                                    resFin(true);
                                }else{
                                    //console.log(chkCount);
                                    chkCount++;
                                };
                            });
                        };
                    };
                }).then(function(resFin){
                    IVPrdDynamicCall.dynamicDataEnd(no, $basePrdList, moredata, type);
                });
            };
        };
    },

    displayMore : function(url, $prdList, moredata, customCount, dataChk){
        let ajaxData =  JSON.parse(JSON.stringify(moredata)); // 최종호출 data
        let idx;
        if(typeof moredata['idx'] !== 'undefined'){
            idx = moredata['idx'];
            delete ajaxData['idx'];
        }else{
            idx = 999;
            delete ajaxData['ivmodule'];
        };
        let pageChk =  moredata['page'];
        delete ajaxData['first_page'];
        let count = moredata['count'];
        if(typeof customCount !== 'undefined'){
            ajaxData['count'] = customCount; 
        };

        if(moredata['cate_no'] === 1){
            delete ajaxData['cate_no'];
        };



        let sStorageListName;
        let sStorageListData;
        if(typeof moredata['display_group'] !== 'undefined'){
            sStorageListName = 'sStorageList_' + moredata['display_group'];
        };
        if(typeof moredata['cate_no'] !== 'undefined'){
            sStorageListName = 'sStorageList_' + moredata['cate_no'] + '_' + moredata['display_group'];
        };
        try {
            sStorageListData = sessionStorage.getItem(sStorageListName);
        } catch (e) {
        };

        return new Promise(function (res, rej) {
            IV$.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: ajaxData,
                success: function (data) {
                    var prdData = data["rtn_data"]["data"];
                    if(prdData != null){
                        if (prdData.length) {
                            if(dataChk){
                                if (sStorageListData !== null && idx !== 999) {
                                    IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + idx] = prdData;
                                };
                                if(data['rtn_data'].end){
                                    res('end');
                                }else{
                                    res(prdData);
                                };
                            }else{
                                if(idx !== 999){
                                    prdData.forEach(function(e, i){
                                        let num = ((pageChk-1)*Number(customCount)) + i;
                                        if(IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + idx]){
                                            IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + idx][num] = e;
                                        };
                                    });
                                }else{
                                    if($prdList !== '' && typeof $prdList !== 'undefined'){
                                        let sTargetModuleName;
                                        if(IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[idx]){
                                            sTargetModuleName = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[idx]['ivmodule'];
                                        }else{
                                            sTargetModuleName = moredata['ivmodule'];
                                        };
                                        $prdList.append(IVPrdDynamicCall.getLiTemplate(sTargetModuleName, prdData));
                                    };
                                };
                                if(data['rtn_data'].end){
                                    res('end');
                                }else{
                                    res('continue');
                                };
                            };
                        };
                    }else{
                        res('end');
                    };
                },
                error:function(request,status,error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }

            });
        });
    },

    makeMoreButton: function(no, $basePrdList, moredata){

        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no];
        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no];
        let prdListData = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no];

        let startNum = basicSettingArray.first_page;
        let lastNum;
        let $basicButton = $basePrdList.siblings('[class*="xans-product-listmore"]');
        $basicButton.hide();
        let count = Number(basicSettingArray.count);
        if(prdListData){
            lastNum = Math.ceil(prdListData.length/count);
        }else{
            lastNum = $basicButton.find('[id^="more_total_page"]').text();
        };
        if(startNum >= lastNum){
            startNum = lastNum;
        };

        let $moreButtonHtml = '<div class="base_paginate_container iv_dynamic_moreButton" data-ivdynamic-page="'+ startNum +'" data-ivdynamic-count="'+ count +'" data-ivdynamic-idx="'+ no +'" data-ivdynamic-last="'+ lastNum +'" ><div class="iv_button">';
        $moreButtonHtml += '<a href="javascript:void(0);"><span>'+ IVPrdDynamicCall.__IV_DEFAULT_VALUE_MOREBUTTON_TEXT +'</span>';
        $moreButtonHtml += '<span id="more_current_page_iv_dynamic_'+ no +'">'+ startNum +'</span>/<span id="more_total_page_iv_dynamic_'+ no +'">'+ lastNum +'</span>';
        $moreButtonHtml = IV$($moreButtonHtml);
        if(startNum >= lastNum){ $moreButtonHtml.hide(); };
        $moreButtonHtml.insertAfter($basePrdList);
        IVPrdDynamicCall.clickButton(no, $basePrdList, moredata);

        let typeChk = $basePrdList.attr('data-ivdynamic-type');
        if((typeChk !== 'button') || (typeChk === 'button' && lastNum == 1)){ $moreButtonHtml.hide(); }
        //if(IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG === false){
        IVPrdDynamicCall.filter(no, $basePrdList);
        //}

    },

    clickButton : function(no, $basePrdList, moredata){
        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no];
        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no];
        let prdListData = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA' + no];
        let lastNum;
        let $basicButton = $basePrdList.siblings('[class*="xans-product-listmore"]');
        let count = Number(basicSettingArray.count);
        if(prdListData){
            lastNum = Math.ceil(prdListData.length/count);
        }else{
            lastNum = $basicButton.find('[id^="more_total_page"]').text();
        };
        let ajaxLink = IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_URL[Number(ivSettingArray.ivlink)];
        let $moreButton = $basePrdList.siblings('.iv_dynamic_moreButton[data-ivdynamic-idx="'+no+'"]');
        $moreButton['bLoading'] = true;

        if(typeof prdListData !== 'undefined'){
            $moreButton.off().on('click',function(){
                let nowPage = Number($moreButton.attr('data-ivdynamic-page'));
                let nextPage = nowPage + 1;
                let viewCount = Number($moreButton.attr('data-ivdynamic-count'));
                let maxCount = Number($moreButton.attr('data-ivdynamic-last'));
                let lastViewIndex = nextPage * viewCount - 1;
                let condition = function(v, i){
                    if(i <= lastViewIndex ){
                        return true;
                    }else{
                        return false;
                    };
                };
                //현재 주소줄 내용 갱신 ---> 상품 분류 페이지 & 일반 상품 영역 일 경우에만
                if($basePrdList[0] == IVPrdDynamicCall._prdList_categoryList){
                    let makePage;
                    let nowLink = window.location.href;
                    let linkPage = iv_util.getParameterByName(nowLink, 'page_num');
                    let newLink;
                    if(linkPage != ''){
                        newLink = nowLink.replace('&page_num='+linkPage, '&page_num='+nextPage);
                    }else{
                        let prevParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[0];
                        let lastParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[1];
                        newLink = prevParam + '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE + '&page_num=' + nextPage + lastParam;
                    };
                    history.replaceState(null, null, newLink);  
                };
                IVPrdDynamicCall.filtering(no, condition, $basePrdList);
                if(nextPage >= maxCount){
                    $moreButton.hide();
                    $moreButton.addClass('displaynone');
                }else{
                    IVPrdDynamicCall.infinitScroll(no, $basePrdList, $moreButton);
                };
                if(nextPage <= maxCount){
                    $moreButton.attr('data-ivdynamic-page', nextPage);
                    $moreButton.find('[id^="more_current_page"]').text(nextPage);
                    IVPrdDynamicCall.saveCache(moredata, nextPage);
                };
            });
        }else{
            $moreButton.off().on('click',function(){
                if(! $moreButton['bLoading']){
                    console.log('호출 기능 비활성화');
                }else{
                    console.log('호출 기능 활성화');
                    let nowPage = Number($moreButton.attr('data-ivdynamic-page'));
                    let nextPage = nowPage + 1;
                    let viewCount = Number($moreButton.attr('data-ivdynamic-count'));
                    let maxCount = Number($moreButton.attr('data-ivdynamic-last'));
                    moredata['page'] = nextPage;
                    $moreButton['bLoading'] = false;
                    //현재 주소줄 내용 갱신 ---> 상품 분류 페이지 & 일반 상품 영역 일 경우에만
                    if($basePrdList[0] == IVPrdDynamicCall._prdList_categoryList){
                        let makePage;
                        let nowLink = window.location.href;
                        let linkPage = iv_util.getParameterByName(nowLink, 'page_num');
                        let newLink;
                        if(linkPage != ''){
                            newLink = nowLink.replace('&page_num='+linkPage, '&page_num='+nextPage);
                        }else{
                            let prevParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[0];
                            let lastParam = nowLink.split('?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE)[1];
                            newLink = prevParam + '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE + '&page_num=' + nextPage + lastParam;
                        };
                        history.replaceState(null, null, newLink);  
                    };

                    IVPrdDynamicCall.displayMore(ajaxLink, $basePrdList.find('.prdList'), moredata).then(function(res) {
                        $moreButton['bLoading'] = true;
                        if(res == 'end'){
                            $moreButton.hide();
                            $moreButton.addClass('displaynone');
                            $moreButton['bLoading'] = false;
                        }else{
                            $moreButton.find('[id^="more_current_page"]').text(nextPage);
                            $moreButton.attr('data-ivdynamic-page', nextPage)
                            IVPrdDynamicCall.infinitScroll(no, $basePrdList, $moreButton);
                        };
                        if(nextPage <= maxCount){
                            IVPrdDynamicCall.saveCache(moredata, nextPage);
                        };
                    });
                };
            });
        };
    },

    infinitScroll : function(no, $basePrdList, $moreButton){
        if($basePrdList.attr('data-ivdynamic-type') === 'scroll'){
            let basicTag = $basePrdList.find('.prdList').children('[data-prd]').eq(0)[0].tagName.toLowerCase();
            if(! $moreButton.hasClass('displaynone')){
                var lastObserveFunc = function (a, b, c){
                    if (a.isIntersecting) {
                        IV$(a.target).removeClass('iv-isIntersecting');
                        b.disconnect();
                        $moreButton.trigger('click');
                    };
                };
                let findlastElidx = $basePrdList.find('.prdList').children().filter('.filter-chk').last().index();
                let findlastEl = '.iv_dynamic_prdList_'+ no +' .prdList > ' + basicTag + ':nth-child('+ findlastElidx +')';
                iv_util.IntersectionObserver(document.querySelectorAll(findlastEl), {
                    root: null, 
                    threshold: [0.95],
                }, lastObserveFunc);
            }else{
                return false;
            };
        }else{
            return false;
        };
    },

    filter : function(no, $basePrdList){

        /**
         * @ prdListData : no 기준 상품 데이터
         * 
         */

        let ivSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_IVSETTING_CONDITION_ARRAY[no];
        let basicSettingArray = IVPrdDynamicCall.__IV_DEFAULT_VALUE_CONDITION_ARRAY[no];
        let prdListData = IVPrdDynamicCall['__IV_DEFAULT_VALUE_PRDLIST_ALL_DATA'+no];

        let connect = $basePrdList.attr('data-ivdynamic-connect');
        let $curation = IV$('#iv_dynamic_curation[data-ivdynamic-connect='+ connect +']'); //큐레이션 영역 있으면 
        let $filter = IV$('.iv_dynamic_filter[data-ivdynamic-connect='+ connect +']'); //동적 필터 전체 영역
        $filter.addClass('done');

        let filterType = ivSettingArray.ivfilter; //동적 필터 선택 타입 multiple (복수 선택 가능) / single (단일 선택)
        let moreViewType = ivSettingArray.ivmoretype; //더보기 타입
        let $paginate = $basePrdList.siblings('.iv_dynamic_paginate[data-ivdynamic-idx="'+no+'"]');
        let $moreButton = $basePrdList.siblings('.iv_dynamic_moreButton[data-ivdynamic-idx="'+no+'"]');

        let $section = $filter.find('[data-ivdynamic-var]'); //조건별 섹션
        let sectionLength = $section.length; //섹션 수 
        let $filterButton = $filter.find('.iv_filter'); //필터 버튼
        let $filterAllButton = $section.find('.iv_filter[data-ivdynamic-type="all"]'); //전체선택 버튼(== 해당영역 리셋)

        let $sort = IV$('.iv_dynamic_sort[data-ivdynamic-connect='+ connect +']');
        let $sortButton = $sort.find('.iv_filter'); //정렬 버튼

        let $curationButton = $curation.find('.iv_dynamic_buttons .iv_filter'); //큐레이션 버튼

        let type = Number(ivSettingArray.ivlink);
        let defaultView = Number(basicSettingArray.count);
        let $prdList = $basePrdList.find('.prdList');
        let sTargetModuleName = ivSettingArray.ivmodule;

        let filterResultType = 1;

        //필터 버튼 형태 수정 (input태그 없을 경우 생성)
        ($sortButton, $filterButton).each(function(idx,el){
            let $el = IV$(el),
                parentIdx = $el.closest($section).index();
            if($el.find('input').length == 0){
                let text = $el.text().trim();
                $el.children().append('<input type="checkbox" name="filter_'+parentIdx+'" id="'+ text +'" / ><label></label>\n');
            };
        });
        $filterButton.each(function(){
            let val = IV$(this).closest($section).attr('data-ivdynamic-var'); 
            let idx = IV$(this).closest($section).index();
            let inputId = IV$(this).find('input').attr('id');
            $filterButton.css('cursor','pointer');
            $filterButton.children().css('pointer-events','none');
            IV$(this).attr('data-ivdynamic-val', val + '_'+ idx + '_' + inputId);
            IV$(this).find('input').attr('id',val + '_' + idx + '_' + inputId);
            IV$(this).find('input').next('label').attr('for',val +  '_'  + idx + '_' + inputId);
        });


        let saveTimeChk = false;
        let filterDIsplayChk = false;
        let storage_ivCateInfo = sessionStorage.getItem('iv_cate_info');
        let storage_ivCateInfo2 = sessionStorage.getItem('iv_cate_info2');
        let storage_ivCateInfo3 = sessionStorage.getItem('iv_cate_info3');
        let defaultSort = iv_util.getParameterByName(IV_LOCATION_HREF, 'sort_method');

        if($basePrdList[0] == IVPrdDynamicCall._prdList_categoryList){
            window['IV_CATE_INFO'] = {
                'cateNo' : IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE,
                'viewType' : null,
                'scrollTop' : null,
                'oriCatePage' : null,
                'saveTime' : null,
            };
            window['IV_CATE_INFO2'] = prdListData.slice(0,IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_COUNT*2);
            window['IV_CATE_INFO3'] =  null;

            var iNowTime = Math.floor(new Date().getTime() / 1000);
            var iSessionTime = 60 * 5;
            try {
                if(typeof storage_ivCateInfo3 === 'string' && typeof storage_ivCateInfo2 !== 'undefined' && typeof storage_ivCateInfo !== 'undefined'){
                    storage_ivCateInfo = JSON.parse(storage_ivCateInfo);
                    storage_ivCateInfo2 = JSON.parse(storage_ivCateInfo2);
                    storage_ivCateInfo3 = JSON.parse(storage_ivCateInfo3);
                    if(typeof storage_ivCateInfo3 === 'string' && iNowTime - Number(storage_ivCateInfo['saveTime']) < iSessionTime && storage_ivCateInfo['oriCatePage'] === window.location.href){
                        saveTimeChk = true;
                        $('html,body').animate({scrollTop:storage_ivCateInfo['scrollTop']}, 0);
                    };
                };
            }
            catch (err) {
                console.log(err); 
                sessionStorage.removeItem('iv_cate_info');
                sessionStorage.removeItem('iv_cate_info2');
                sessionStorage.removeItem('iv_cate_info3');
            };
            Object.keys(sessionStorage).forEach(function(el){
                if(el.indexOf('coupon_download_') > -1){
                    sessionStorage.removeItem(el);
                };
            });
            let appendLength = IV$(IVPrdDynamicCall._prdList_categoryList).find('[id^="anchorBoxId_"]').length;
            let arrayFin = prdListData.slice(appendLength);
            let templete = IVPrdDynamicCall.getLiTemplate(sTargetModuleName, arrayFin);
            if(templete.trim() != ''){
                $prdList.append(templete);
            };
            if(! saveTimeChk){
                saveTimeChk = Math.floor(new Date().getTime() / 1000);
            }else{
                saveTimeChk = storage_ivCateInfo['saveTime'];
            };

            /**
             * 상품 클릭할때 데이터 세션에 저장 
             */
            IV$(document).on('click', '.prdItem_normalBox .prdList [id^="anchorBoxId_"]', function(e){
                var target = e.target;
                if(target.classList.contains('ec-admin-icon') || target.classList.contains('Prev_Cart')){
                }else{
                    let viewType = null;
                    if(IV$('.iv_viewType').is(':visible')){
                        viewType = IV$('.iv_viewType').attr('data-view');
                    };
                    window['IV_CATE_INFO']['viewType'] = viewType;
                    window['IV_CATE_INFO']['scrollTop'] = window.pageYOffset;
                    window['IV_CATE_INFO']['oriCatePage'] = window.location.href;
                    window['IV_CATE_INFO']['saveTime'] = saveTimeChk;
                    let html = '';
                    IV$('.prdItem_normalBox .prdList [id^="anchorBoxId_"]').each(function(idx,el){
                        if(idx < IVPrdDynamicCall.__IV_DEFAULT_VALUE_AJAX_COUNT*1.5){
                            html+= el.outerHTML;
                        };
                    });
                    window['IV_CATE_INFO3'] = html;
                    sessionStorage.setItem('iv_cate_info',  JSON.stringify(window['IV_CATE_INFO']));
                    sessionStorage.setItem('iv_cate_info2',  JSON.stringify(window['IV_CATE_INFO2']));
                    sessionStorage.setItem('iv_cate_info3',  JSON.stringify(window['IV_CATE_INFO3']));
                };
            });

            //주소줄 정렬값 적용 
            if(defaultSort){
                $sortButton.filter('[data-ivdynamic-val$="sort_method='+ defaultSort +'"]').addClass('on');
                $sortButton.filter('[data-ivdynamic-val$="sort_method='+ defaultSort +'"]').find('input').prop('checked',true);
            };

        }else{
            //let appendLength = $prdList.find('[id^="anchorBoxId_"]').length;
            //let arrayFin = prdListData.slice(appendLength);
            let templete = IVPrdDynamicCall.getLiTemplate(sTargetModuleName, prdListData);
            if(templete.trim() != ''){
                $prdList.append(templete);
            };
        };

        if(IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG === 'wait'){
            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CACHE_ITEM_APPEND_CHK_FLAG = true;
        };
        if(typeof IVPrdDynamicCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION === 'function'){
            IVPrdDynamicCall.__IV_DEFAULT_VALUE_CUSTOM_FUNCTION();
        };

        IVPrdDynamicCall.initAfter();
        $basePrdList.addClass('ivdynamic-done');


        /**
         * 주소줄 기본값 적용  
         */
        let defaultPage = iv_util.getParameterByName(IV_LOCATION_HREF, 'page_num');
        defaultPage = (defaultPage == '') ? 1 : defaultPage;
        let defaultFilter = '';
        $section.each(function(i,e){
            let chkVar = IV$(e).attr('data-ivdynamic-var');
            let chkVarValue;
            if($section.length == 1){
                chkVarValue = iv_util.getParameterByName(IV_LOCATION_HREF, 'custom_filter');
            }else{
                chkVarValue = iv_util.getParameterByName(IV_LOCATION_HREF, 'custom_filter_' + chkVar);
            };
            let idx = IV$(e).index();
            if(chkVarValue){
                chkVarValue = (chkVarValue.indexOf('_') > -1) ? chkVarValue.split('_') : [chkVarValue];
                if(chkVarValue[0].trim() == 'all'){
                    IV$(e).find('.iv_filter[data-ivdynamic-val="all"]').addClass('on');
                    IV$(e).find('.iv_filter[data-ivdynamic-val="all"] input').prop('checked',true);
                }else{
                    chkVarValue.forEach(function(e2, i2){
                        IV$(e).find('.iv_filter[data-ivdynamic-val="'+ chkVar + '_' + idx + '_' + e2.trim() + '"]').addClass('on');
                        IV$(e).find('.iv_filter[data-ivdynamic-val="'+ chkVar + '_' + idx + '_' + e2.trim() + '"]').find('input').prop('checked',true);
                    });
                };
                defaultFilter += chkVarValue;
            };
        });
        if(defaultFilter.trim() == ''){ //커스텀 필터값 없음 -> 페이지만 적용
            if(moreViewType == 'page'){
                $paginate.attr('data-ivdynamic-page',defaultPage);
                $paginate.find('ol li a[data-page="'+ defaultPage +'"]').addClass('this');
                $paginate.find('ol li a[data-page="'+ defaultPage +'"]').parent().addClass('on');
                if(! filterDIsplayChk){
                    IVPrdDynamicCall.goPage(no, defaultPage, $basePrdList);
                };
            }
            else if(moreViewType == 'button' || moreViewType == 'scroll'){
                $moreButton.attr('data-ivdynamic-page', defaultPage);
                $moreButton.find('[id^="more_current_page"]').text(defaultPage);
                let viewCount = Number($moreButton.attr('data-ivdynamic-count'));
                let maxCount = Number($moreButton.attr('data-ivdynamic-last'));
                let lastViewIndex = defaultPage * viewCount - 1;
                let condition = function(v, i){
                    if(i <= lastViewIndex ){
                        return true;
                    }else{
                        return false;
                    };
                };
                if(! filterDIsplayChk){
                    IVPrdDynamicCall.filtering(no, condition, $basePrdList);
                }
                if(defaultPage < maxCount){
                    if(moreViewType === 'button'){
                        $moreButton.show();
                    };
                    IVPrdDynamicCall.infinitScroll(no, $basePrdList, $moreButton);
                }else{
                    $moreButton.hide();
                };
            };
        }
        else{
            //커스텀 필터값 있음 -> 커스텀값 적용
            if($paginate.length > 0){
                $paginate.attr('data-ivdynamic-page',defaultPage);
                $paginate.find('ol li a[data-page="'+ defaultPage +'"]').addClass('this');
                $paginate.find('ol li a[data-page="'+ defaultPage +'"]').parent().addClass('on');
            }else if($moreButton.length > 0){
                $moreButton.attr('data-ivdynamic-page', defaultPage);
                $moreButton.find('[id^="more_current_page"]').text(defaultPage);
                let viewCount = Number($moreButton.attr('data-ivdynamic-count'));
                let maxCount = Number($moreButton.attr('data-ivdynamic-last'));
                if(defaultPage < maxCount){
                    if(moreViewType === 'button'){
                        $moreButton.show();
                    };
                }else{
                    $moreButton.hide();
                };
            };
            if(! filterDIsplayChk){
                filterCondition();
            };
        };
        if($curation.length > 0){
            filterResultType = 2;
            $sortButton.off().on('click',function(){
                let $this = IV$(this);
                if(! $this.hasClass('on')){
                    $this.addClass('on');
                    $this.find('input').prop('checked',true);
                    $sortButton.not($this).removeClass('on');
                    $sortButton.not($this).find('input').prop('checked',false);
                }else{
                    $this.removeClass('on');
                    $this.find('input').prop('checked',false);
                };
            });
            $curationButton.off().on('click',function(){
                let $this = IV$(this);
                let type = $this.attr('data-ivdynamic-val');
                if(type === 'search'){
                    let result = filterCondition();
                    window.location.href = '/product/list.html' + encodeURI(result);
                }else if(type === 'reset'){
                    $sort.find('.on').removeClass('on');
                    $section.find('.on').removeClass('on');
                    $sort.find('input').prop('checked',false);
                    $section.find('input').prop('checked',false);
                };
            });
        }else{
            filterResultType = 1;
            $sort.hide();
        };
        $filterButton.off().on('click', function(event){
            let $this = IV$(this);
            let type = $this.attr('data-ivdynamic-type');
            // 버튼 on/off 제어
            if(! $this.hasClass('on')){
                if(type === 'all'){
                    $this.addClass('on');
                    $this.find('input').prop('checked',true);
                    $this.siblings($filterButton).removeClass('on');
                    $this.siblings($filterButton).find('input').prop('checked',false);
                }else{
                    $this.addClass('on');
                    $this.find('input').prop('checked',true);
                    if(filterType !== 'multiple'){
                        $this.siblings($filterButton).removeClass('on');
                        $this.siblings($filterButton).find('input').prop('checked',false);
                    }else{
                        $this.siblings($filterButton).filter('[data-ivdynamic-type="all"]').removeClass('on');
                        $this.siblings($filterButton).filter('[data-ivdynamic-type="all"]').find('input').prop('checked',false);
                    };
                };
            }else{
                $this.removeClass('on');
                $this.find('input').prop('checked',false);
            };
            if(filterResultType === 1){
                filterCondition();
            };
        });
        // 필터 컨디션 생성
        function filterCondition(){
            let allButtonOnLength = $filterAllButton.filter('.on').length;
            let sectionSelectLength = $section.has('.on').length;
            let makeParamFilter = '';
            let filterConditionChk;
            if(sectionLength == allButtonOnLength){
                //console.log('전체');
                filterConditionChk = 'all';
                condition = true;
            }else{
                $filter['filter'] = {};
                $section.each(function(i,e){
                    let chkVar = IV$(e).attr('data-ivdynamic-var');

                    let text = IV$(e).find('.iv_filter.on').not('.iv_filter[data-ivdynamic-type="all"]').text().trim();
                    let textArray = [];
                    if(IV$(e).find('.iv_filter[data-ivdynamic-type="all"]').hasClass('on')){
                        textArray.push('all');
                    }else{
                        //iv_util.removeBlankFunc(text).split(/(\r\n|\n|\r)/gm).forEach(function(e2, i2){
                        //    if(e2 && e2 != '\n' && e2 != '\r' && e2 != ''){ textArray.push(e2); }
                        //});
                        IV$(e).find('.iv_filter.on').each(function(){
                            let $filterBtn = IV$(this);
                            let valueId = $filterBtn.find('input').attr('id');
                            if(valueId.indexOf('_') > -1){
                                valueId = valueId.split('_');
                                textArray.push(valueId[valueId.length-1]);
                            };
                        });
                    };
                    if(textArray.length !== 0){
                        if(textArray[0] != 'all'){
                            $filter['filter'][chkVar] = textArray;
                        };
                        if($section.length > 1){
                            makeParamFilter += '&custom_filter_' + chkVar + '=' + textArray.join('_');
                        }else{	
                            makeParamFilter += '&custom_filter=' + textArray.join('_');
                        };
                    };
                });
                let chkArray = JSON.parse(JSON.stringify($filter['filter']));
                if(sectionSelectLength>0){
                    $paginate.addClass('displaynone');
                    $moreButton.addClass('displaynone');
                    condition = function(v, i){
                        let chk = true;
                        let chk2 = true;
                        let length = Object.keys(chkArray).length;
                        for(let x=0; x<length; x++){
                            let key = Object.keys(chkArray)[x];
                            let value = chkArray[key];
                            if(chk === true){
                                let chkVal = v[key];
                                if(value.length > 0){
                                    let test = value.some(function(val) {
                                        return (chkVal.indexOf(val) > -1) ? true : false;
                                    });
                                    if(test === false){
                                        chk = false;
                                        break;
                                    };
                                };
                            };
                        };
                        if(chk === true){
                            return true;
                        }else{
                            return false;
                        };
                    };
                }else{
                    //console.log('선택된 것 없음');
                    filterConditionChk = 'reset';
                    IVPrdDynamicCall.infinitScroll(no, $basePrdList, $moreButton);
                };
            };
            if(filterResultType === 1){
                let makePage;
                if($paginate.length > 0){
                    makePage = Number($paginate.attr('data-ivdynamic-page'));
                }else{
                    makePage = Number($moreButton.attr('data-ivdynamic-page'));
                };
                if(filterConditionChk === 'reset'){
                    if($basePrdList.find('.iv_dynamic_nodata')){$basePrdList.find('.iv_dynamic_nodata').remove();}
                    if($paginate.length > 0){
                        $paginate.removeClass('displaynone');
                        IVPrdDynamicCall.goPage(no, makePage, $basePrdList);
                    }else{
                        $moreButton.removeClass('displaynone');
                        let viewCount = Number($moreButton.attr('data-ivdynamic-count'));
                        let maxCount = Number($moreButton.attr('data-ivdynamic-last'));
                        let lastViewIndex = makePage * viewCount - 1;
                        condition = function(v, i){
                            if(i <= lastViewIndex ){
                                return true;
                            }else{
                                return false;
                            };
                        };
                        IVPrdDynamicCall.filtering(no, condition, $basePrdList);
                    };
                }else{
                    IVPrdDynamicCall.filtering(no, condition, $basePrdList);
                };
                let makeParamSort = defaultSort.trim();
                if(makeParamSort != ''){
                    if(makeParamSort.indexOf('#Product_ListMenu')){
                        makeParamSort = '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE + '&sort_method=' + makeParamSort.split('#Product_ListMenu')[0].trim();
                    }else{
                        makeParamSort = '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE + '&sort_method=' + makeParamSort;
                    };
                }else{
                    makeParamSort = '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE;
                };
                let makeParamPage = '&page_num='+ makePage; 
                let lastParam = makeParamSort + makeParamPage + makeParamFilter;
                let newLink = IV_LOCATION_HREF.split(IV_LOCATION_PATHNAME)[0] + IV_LOCATION_PATHNAME + lastParam;
                history.replaceState(null, null, newLink);

            }else{
                let makeParamSort = ($sortButton.filter('.on').length > 0) ? $sortButton.filter('.on').attr('data-ivdynamic-val') : '?cate_no=' + IVBaseMenuCall.__IV_DEFAULT_VALUE_LOCATION_NOW_CATE;
                let makeParamPage = '&page_num=1'; //우선 무조건 1페이지로 
                let lastParam = makeParamSort + makeParamPage + makeParamFilter;
                return lastParam;
            };
        };
    },
    initAfter : function(){
        sessionStorage.removeItem('iv_cate_info');
        sessionStorage.removeItem('iv_cate_info2');
        sessionStorage.removeItem('iv_cate_info3');
    },
}; 


/**
 * 공통 실행
 */
var iv_commonBaseFunc = iv_commonBaseFunc || {
    __IV_DEFAULT_VALUE_ORDER_LAYER_OPEN_CLOSE_FUNCTION_MODIFY : false,
    initBefore: function () {
        if(isPopupPage == 0){
            IV_MEMBER_CHECK = topDocument.querySelectorAll('#iv_memberChk_nomember').length > 0 ? false : true; //true : 회원 , false: 비회원
            IV_SUBCONTAINER_DATA_PAGE = IV$('.sub_container').attr('data-page'); 
            IV_TOP_SUBCONTAINER_DATA_PAGE = IV$('.sub_container').attr('data-page');  

        }else{
            IV_SUBCONTAINER_DATA_PAGE = IV$('.popup_container').attr('data-page'); 
            IV_TOP_SUBCONTAINER_DATA_PAGE = IV$(topDocument).find('.sub_container').attr('data-page'); 
        };
        iv_commonBaseFunc.connectEvent();
        iv_commonBaseFunc.memberStateLayoutFix();
        IVBaseMenuCall.printList(); //메뉴 호출
    },
    init: function () {
        //페이지별 실행
        if(typeof basePrdPageInfoCallCustom !== 'undefined'){
            IVPrdPageInfoCall.init(basePrdPageInfoCallCustom);
        }else{
            IVPrdPageInfoCall.init();
        };
        //상품별 실행 
        if(typeof basePrdItemInfoCallCustom !== 'undefined'){
            IVPrdItemInfoCall.init(basePrdItemInfoCallCustom);
        }else{
            IVPrdItemInfoCall.init();
        };
        iv_commonBaseFunc.cssVarSet(isPopupPage);
        //custom swiper 
        IVSwiperFunc();
    },
    initLast : function(){
        if(isPopupPage == 0){
            if(IV_MEMBER_CHECK){
                ( memberDataCall = function(){
                    if(iv_commonBaseFunc.memberInfo() == false){
                        setTimeout(memberDataCall,300);
                    }else{
                        //회원 데이터 끝났을때 동작할 함수 
                        let IV_MEMBER_CALL_END = new CustomEvent("IVMemberCall",{'detail': IV_MEMBER_OBJ}); /* 멤버 정보 호출 완료 */
                        document.body.dispatchEvent(IV_MEMBER_CALL_END);
                    };
                })();
            }else{
                //회원 데이터 끝났을때 동작할 함수 
                let IV_MEMBER_CALL_END = new CustomEvent("IVMemberCall",{'detail' : 'guest-member'}); /* 멤버 정보 호출 완료 */
                document.body.dispatchEvent(IV_MEMBER_CALL_END);
            };
            //ie 브라우저 전환 유도 
            if(typeof ieAlert !== 'undefined' && typeof ieRedirect !== 'undefined'){
                if(ieAlert && IV_DEVICE_CHK == 'pc' && IV_BROWSER_CHK == 'ie'){
                    iv_commonBaseFunc.ieLeave();
                };
            }
        };
        IVmcustomScrollbar();
        iv_commonBaseFunc.cssVarSet(isPopupPage);
        IVBaseScroll.stickySet();
        window['oldURL'] = null;
        window['oldResponseText'] = null;

    },
    memberStateLayoutFix : function(){
        //회원/비회원 class (Layout_statelogoff/Layout_statelogon 모듈 사용 불가 시 사용)
        if(IV_MEMBER_CHECK){
            IV$('.iv_statelogoff').remove();
            IV$('.iv_statelogoff2').addClass('displaynone');
            IV$('.iv_statelogoff3').addClass('layout-hidden');
            
            IV$('[class*="nm_return_btn"]').each(function(){
                var $this = IV$(this);
                $this.removeClass('nm_return_btn nm_return_btn2 nm_return_btn3');
            });
        }else{
            IV$('.iv_statelogon').remove();
            IV$('.iv_statelogon2').addClass('displaynone');
            IV$('.iv_statelogon3').addClass('layout-hidden');
            
            //type1 현재 링크를 return url로 넣기
            IV$('.nm_return_btn').each(function(){
                var $this = IV$(this);
                var oriLink = $this.attr('href');
                $this.attr('href',oriLink+'?returnUrl='+IV_LOCATION_HREF.split(IV_LOCATION_HOSTNAME)[1]);
            });

            //type2 현재 링크를 주소줄에 있는 return Url값으로 넣기
            IV$('.nm_return_btn2').each(function(){
                if(IV_LOCATION_HREF.indexOf('returnUrl=') > -1){
                    var $this = IV$(this);
                    var oriLink = $this.attr('href');
                    var returnUrlLink = IV_LOCATION_HREF.split('returnUrl=')[1];
                    $this.attr('href',oriLink+'?returnUrl='+returnUrlLink);
                };
            });

            //type3 현재 링크를 주소줄에 있는 return Url값으로 넣기 + 로그인 페이지로 보내기
            IV$('.nm_return_btn3').each(function(){
                var $this = IV$(this);
                var oriLink = $this.attr('href');
                $this.attr('href','/member/login.html?returnUrl='+oriLink);
            });
        };
    },

    connectEvent : function(){
        
        //토클 클릭
        IV$(document).on('click', '.base_form_toggle > .title', function(e){
            // input/label 등 요소 클릭 시에는 열림/닫힘 기능하지 않게 수정 
            if(e.target.tagName =='INPUT'|| e.target.tagName =='LABEL') return;
            if(IV$(this).closest('.base_form_toggle').hasClass('on') && IV$(this).closest('.base_form_toggle').hasClass('fixed') == false){
                IV$(this).closest('.base_form_toggle').removeClass('on');
            }else{
                if(IV$(this).closest('.base_form_toggle').hasClass('fixed') == false){
                    IV$(this).closest('.base_form_toggle').addClass('on');
                };
            };
        });

        //탭바 클릭
        IV$(document).on('click', '.tabbar_header li ', function(){
            var $this = IV$(this);
            var triggerClick = $this.data('click');
            $this.addClass('selected');
            $this.closest('.tabbar_container').find('.tabbar_header li').not($this).removeClass('selected');
            if(triggerClick){
                if(triggerClick.indexOf(',') > -1){
                    triggerClick = triggerClick.split(',');
                    triggerClick.forEach(function(e,i){
                        EC$(e).trigger('click');
                    });
                }else{
                    EC$(triggerClick).trigger('click');
                };
            };
            $this.closest('.tabbar_header').attr('data-selected',$this.index());
        });
    },

    cssVarSet : function(isPopupPage){
        if(isPopupPage == 0){
            if(IV_vh == 0 || Math.abs(IV_vh - (window.innerHeight * 0.01)) > 3){
                IV_vh = window.innerHeight * 0.01;
                document.querySelector(':root').style.setProperty("--vh", IV_vh +"px"); /* 1vh 값 */
            };
            IV_vh2 = window.innerHeight * 0.01;
            document.querySelector(':root').style.setProperty("--vh2", IV_vh2 +"px"); /* 1vh 값2 */
            IV_vw = window.innerWidth * 0.01;
            if(typeof IVSetPropertyArray !== 'undefined'){
                IVSetPropertyArray.forEach(function(e,i){
                    var name = e.name;
                    var $el = IV$(e.element);
                    window['IV_'+name] = ($el.length > 0) ? $el.outerHeight() : 0;
                    document.querySelector(':root').style.setProperty('--' + name, window['IV_'+name] + 'px');
                });
            };
            document.querySelector(':root').style.setProperty("--vw", IV_vw +"px"); /* 1vw 값 */
        }else{
            IV_vh = top.window.innerHeight * 0.01;
            IV_vw = top.window.innerWidth * 0.01;
            document.querySelector(':root').style.setProperty("--vh", IV_vh +"px"); /* 1vh 값 */
            document.querySelector(':root').style.setProperty("--vw", IV_vw +"px"); /* 1vw 값 */
            if(typeof IVSetPropertyArray !== 'undefined'){
                IVSetPropertyArray.forEach(function(e,i){
                    var name = e.name;
                    var $el = IV$(topDocument).find(e.element);
                    window['IV_'+name] = ($el.length > 0) ? $el.outerHeight() : 0;
                    document.querySelector(':root').style.setProperty('--' + name, window['IV_'+name] + 'px');
                });
            };
        };
    },
    
    memberInfo : function(){
        IV_MEMBER_ID = CAPP_ASYNC_METHODS.member.__sMemberId; 
        if(IV_MEMBER_ID == null){
            return false;
        };
        IV_MEMBER_NAME = CAPP_ASYNC_METHODS.member.__sName;
        IV_MEMBER_NICKNAME = CAPP_ASYNC_METHODS.member.__sNickName; 
        IV_MEMBER_GROUPNAME = CAPP_ASYNC_METHODS.member.__sGroupName;
        IV_MEMBER_GROUPNO = CAPP_ASYNC_METHODS.member.__sGroupNo;
        IV_MEMBER_EMAIL = CAPP_ASYNC_METHODS.member.__sEmail; 
        IV_MEMBER_PHONE = CAPP_ASYNC_METHODS.member.__sPhone;
        IV_MEMBER_CELLPHONE = CAPP_ASYNC_METHODS.member.__sCellphone; 
        IV_MEMBER_BIRTHDAY = CAPP_ASYNC_METHODS.member.__sBirthday; 
        IV_MEMBER_BOARDWRITENAME = CAPP_ASYNC_METHODS.member.__sBoardWriteName; 
        IV_MEMBER_ADDITIONALINFOMATION = CAPP_ASYNC_METHODS.member.__sAdditionalInformation; 
        IV_MEMBER_CREATEDATE = CAPP_ASYNC_METHODS.member.__sCreatedDate;
        IV_MEMBER_NAME_MILEAGE = (typeof sMileageName === 'undefined') ? null : sMileageName;
        if(typeof sMileageUnit !== 'undefined'){
            IV_MEMBER_UNIT_MILEAGE = (sMileageUnit.indexOf(']')>-1) ? sMileageUnit.split(']')[1].trim() : sMileageUnit;
        }
        IV_MEMBER_AVAIL_MILEAGE = CAPP_ASYNC_METHODS.Mileage.__sAvailMileage;
        IV_MEMBER_UNAVAIL_MILEAGE = CAPP_ASYNC_METHODS.Mileage.__sUnavailMileage;
        IV_MEMBER_RETURN_MILEAGE = CAPP_ASYNC_METHODS.Mileage.__sReturnedMileage;
        IV_MEMBER_TOTAL_MILEAGE = CAPP_ASYNC_METHODS.Mileage.__sTotalMileage;
        IV_MEMBER_USED_MILEAGE = CAPP_ASYNC_METHODS.Mileage.__sUsedMileage;
        IV_MEMBER_COUPON_COUNT = CAPP_ASYNC_METHODS.Couponcnt.__iCouponCount;
        IV_MEMBER_ORDER_COUNT = CAPP_ASYNC_METHODS.Order.__iOrderCount;
        if(CAPP_ASYNC_METHODS.Order.__iOrderTotalPrice != null){
            IV_MEMBER_ORDER_TOTAL = (CAPP_ASYNC_METHODS.Order.__iOrderTotalPrice.indexOf('원') > -1) ? CAPP_ASYNC_METHODS.Order.__iOrderTotalPrice.replace('원','') : CAPP_ASYNC_METHODS.Order.__iOrderTotalPrice; 
        }
        IV_MEMBER_ORDER_INCREASEVALUE = CAPP_ASYNC_METHODS.Order.__iGradeIncreaseValue;
        IV_MEMBER_ACC_DEPOSIT = CAPP_ASYNC_METHODS.Deposit.__sAllDeposit; 
        IV_MEMBER_USED_DEPOSIT = CAPP_ASYNC_METHODS.Deposit.__sUsedDeposit; 
        IV_MEMBER_RETURN_DEPOSIT = CAPP_ASYNC_METHODS.Deposit.__sRefundWaitDeposit; 
        IV_MEMBER_AVAIL_DEPOSIT = CAPP_ASYNC_METHODS.Deposit.__sTotalDeposit; 
        IV_MEMBER_TOTAL_DEPOSIT = CAPP_ASYNC_METHODS.Deposit.__sMemberTotalDeposit; 
        IV_MEMBER_NAME_DEPOSIT = sDepositName;
        IV_MEMBER_UNIT_DEPOSIT = sDepositUnit;
        if(typeof sDepositUnit !== 'undefined'){
            IV_MEMBER_UNIT_DEPOSIT = (sDepositUnit.indexOf(']')>-1) ? sDepositUnit.split(']')[1].trim() : sDepositUnit;
        }
        IV_MEMBER_OBJ = {
            'IV_MEMBER_ID' : IV_MEMBER_ID,
            'IV_MEMBER_NAME' : IV_MEMBER_NAME , 
            'IV_MEMBER_NICKNAME' : IV_MEMBER_NICKNAME ,
            'IV_MEMBER_GROUPNAME' : IV_MEMBER_GROUPNAME ,
            'IV_MEMBER_GROUPNO' : IV_MEMBER_GROUPNO ,
            'IV_MEMBER_EMAIL' : IV_MEMBER_EMAIL ,
            'IV_MEMBER_PHONE' : IV_MEMBER_PHONE ,
            'IV_MEMBER_CELLPHONE' : IV_MEMBER_CELLPHONE ,
            'IV_MEMBER_BIRTHDAY' : IV_MEMBER_BIRTHDAY  ,
            'IV_MEMBER_BOARDWRITENAME' : IV_MEMBER_BOARDWRITENAME  ,
            'IV_MEMBER_ADDITIONALINFOMATION' : IV_MEMBER_ADDITIONALINFOMATION  ,
            'IV_MEMBER_CREATEDATE' : IV_MEMBER_CREATEDATE ,
            'IV_MEMBER_NAME_MILEAGE' : IV_MEMBER_NAME_MILEAGE ,
            'IV_MEMBER_UNIT_MILEAGE' : IV_MEMBER_UNIT_MILEAGE,
            'IV_MEMBER_AVAIL_MILEAGE' : IV_MEMBER_AVAIL_MILEAGE ,
            'IV_MEMBER_UNAVAIL_MILEAGE' : IV_MEMBER_UNAVAIL_MILEAGE ,
            'IV_MEMBER_RETURN_MILEAGE' : IV_MEMBER_RETURN_MILEAGE ,
            'IV_MEMBER_TOTAL_MILEAGE' : IV_MEMBER_TOTAL_MILEAGE ,
            'IV_MEMBER_USED_MILEAGE' : IV_MEMBER_USED_MILEAGE ,
            'IV_MEMBER_COUPON_COUNT' : IV_MEMBER_COUPON_COUNT ,
            'IV_MEMBER_ORDER_COUNT' : IV_MEMBER_ORDER_COUNT ,
            'IV_MEMBER_ORDER_TOTAL' : IV_MEMBER_ORDER_TOTAL ,
            'IV_MEMBER_ORDER_INCREASEVALUE' : IV_MEMBER_ORDER_INCREASEVALUE,
            'IV_MEMBER_NAME_DEPOSIT' : IV_MEMBER_NAME_DEPOSIT,
            'IV_MEMBER_UNIT_DEPOSIT' : IV_MEMBER_UNIT_DEPOSIT,
            'IV_MEMBER_ACC_DEPOSIT' : CAPP_ASYNC_METHODS.Deposit.__sAllDeposit,
            'IV_MEMBER_USED_DEPOSIT' : CAPP_ASYNC_METHODS.Deposit.__sUsedDeposit,
            'IV_MEMBER_RETURN_DEPOSIT' : CAPP_ASYNC_METHODS.Deposit.__sRefundWaitDeposit, 
            'IV_MEMBER_AVAIL_DEPOSIT' : CAPP_ASYNC_METHODS.Deposit.__sTotalDeposit,
            'IV_MEMBER_TOTAL_DEPOSIT' : CAPP_ASYNC_METHODS.Deposit.__sMemberTotalDeposit
        };
        Object.keys(IV_MEMBER_OBJ).forEach(function(el){
            let txt = (typeof IV_MEMBER_OBJ[el] === 'object') ? '' : String(IV_MEMBER_OBJ[el]);
            if(txt){
                if(iv_util.removeNumbFunc(txt).trim() == '.'){
                    IV$('.' + el).text(iv_util.comma(Math.floor(txt)));
                }else{
                    IV$('.' + el).text(txt);
                };
            };
        });

        if(IV_MEMBER_GROUPNO == '' && IV_MEMBER_CHECK){
			IV$('.base_board_admin').removeClass('displaynone');
        };

    },

    ieLeave : function(){
        if(typeof ieAlert !== 'undefined' && typeof ieRedirect !== 'undefined'){
            if(ieAlert){
                if(ieRedirect){
                    //ie edge로 전환
                    alert("본 사이트는 Edge, Chrome 브라우저에 최적화 되어 있습니다." + "확인 버튼을 누르시면 Edge브라우저로 이동합니다.") 
                    moveEdge();
                }else{
                    /**
                     * Minified by jsDelivr using Terser v3.14.1.
                     * Original file: /gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.js
                     * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
                     */
                    !function(){"use strict";var e=document.createElement("i");if(e.style.setProperty("--x","y"),"y"!==e.style.getPropertyValue("--x")&&e.msMatchesSelector){Element.prototype.matches||(Element.prototype.matches=Element.prototype.msMatchesSelector);var t,r=[],n=document,o=!1;document.addEventListener("DOMContentLoaded",function(){o=!0}),"classList"in Element.prototype||H("classList",HTMLElement.prototype,Element.prototype),"innerHTML"in Element.prototype||H("innerHTML",HTMLElement.prototype,Element.prototype),"runtimeStyle"in Element.prototype||H("runtimeStyle",HTMLElement.prototype,Element.prototype),"sheet"in SVGStyleElement.prototype||Object.defineProperty(SVGStyleElement.prototype,"sheet",{get:function(){for(var e,t=document.styleSheets,r=0;e=t[r++];)if(e.ownerNode===this)return e}});var i={},s=new Set,c=!1,l=!1,a=/([\s{;])(--([A-Za-z0-9-_]*)\s*:([^;!}{]+)(!important)?)(?=\s*([;}]|$))/g,u=/([{;]\s*)([A-Za-z0-9-_]+\s*:[^;}{]*var\([^!;}{]+)(!important)?(?=\s*([;}$]|$))/g,f=/-ieVar-([^:]+):/g,p=/-ie-([^};]+)/g,d=/:(hover|active|focus|target|visited|link|:before|:after|:first-letter|:first-line)/;M("style",q),M('link[rel="stylesheet"]',q),M("[ie-style]",function(e){var t=B("{"+e.getAttribute("ie-style")).substr(1);e.style.cssText+=";"+t;var r=R(e.style);r.getters&&N(e,r.getters,"%styleAttr"),r.setters&&G(e,r.setters)});var m={hover:{on:"mouseenter",off:"mouseleave"},focus:{on:"focusin",off:"focusout"},active:{on:"CSSActivate",off:"CSSDeactivate"}},y=null;document.addEventListener("mousedown",function(e){setTimeout(function(){if(e.target===document.activeElement){var t=document.createEvent("Event");t.initEvent("CSSActivate",!0,!0),(y=e.target).dispatchEvent(t)}})}),document.addEventListener("mouseup",function(){if(y){var e=document.createEvent("Event");e.initEvent("CSSDeactivate",!0,!0),y.dispatchEvent(e),y=null}});var v=0,h=new MutationObserver(function(e){if(!l)for(var t,r=0;t=e[r++];)"iecp-needed"!==t.attributeName&&J(t.target)});setTimeout(function(){h.observe(document,{attributes:!0,subtree:!0})});var S=location.hash;addEventListener("hashchange",function(e){var t=document.getElementById(location.hash.substr(1));if(t){var r=document.getElementById(S.substr(1));J(t),J(r)}else J(document);S=location.hash});var E=Object.getOwnPropertyDescriptor(HTMLElement.prototype,"style"),P=E.get;E.get=function(){const e=P.call(this);return e.owningElement=this,e},Object.defineProperty(HTMLElement.prototype,"style",E);var C=getComputedStyle;window.getComputedStyle=function(e){var t=C.apply(this,arguments);return t.computedFor=e,t};var g=CSSStyleDeclaration.prototype,b=g.getPropertyValue;g.getPropertyValue=function(e){if(this.lastPropertyServedBy=!1,"-"!==(e=e.trim())[0]||"-"!==e[1])return b.apply(this,arguments);const t=e.substr(2),r="-ie-"+t,n="-ie-❗"+t;let o=D(this[n]||this[r]);if(this.computedFor){if(void 0===o||T[o]){if(T[o]||!_[e]||_[e].inherits){let t=this.computedFor.parentNode;for(;1===t.nodeType;){if(t.ieCP_setters&&t.ieCP_setters[e]){var i=getComputedStyle(t),s=D(i[n]||i[r]);if(void 0!==s){o=Q(this,s),this.lastPropertyServedBy=t;break}}t=t.parentNode}}}else o=Q(this,o),this.lastPropertyServedBy=this.computedFor;if("initial"===o)return""}return void 0===o&&_[e]&&(o=_[e].initialValue),void 0===o?"":o};var T={inherit:1,revert:1,unset:1},L=g.setProperty;g.setProperty=function(e,t,r){if("-"!==e[0]||"-"!==e[1])return L.apply(this,arguments);const n=this.owningElement;n&&(n.ieCP_setters||(n.ieCP_setters={}),n.ieCP_setters[e]=1),e="-ie-"+("important"===r?"❗":"")+e.substr(2),this.cssText+="; "+e+":"+k(t)+";",n&&J(n)},window.CSS||(window.CSS={});var _={};CSS.registerProperty=function(e){_[e.name]=e}}function w(e,t){try{return e.querySelectorAll(t)}catch(e){return[]}}function M(e,o){for(var i,s={selector:e,callback:o,elements:new WeakMap},c=w(n,s.selector),l=0;i=c[l++];)s.elements.set(i,!0),s.callback.call(i,i);r.push(s),t||(t=new MutationObserver(O)).observe(n,{childList:!0,subtree:!0}),A(s)}function A(e,t){var r,i=0,s=[];try{t&&t.matches(e.selector)&&s.push(t)}catch(e){}for(o&&Array.prototype.push.apply(s,w(t||n,e.selector));r=s[i++];)e.elements.has(r)||(e.elements.set(r,!0),e.callback.call(r,r))}function V(e){for(var t,n=0;t=r[n++];)A(t,e)}function O(e){for(var t,r,n,o,i=0;r=e[i++];)for(n=r.addedNodes,t=0;o=n[t++];)1===o.nodeType&&V(o)}function H(e,t,r){var n=Object.getOwnPropertyDescriptor(t,e);Object.defineProperty(r,e,n)}function q(e){if(!e.ieCP_polyfilled&&!e.ieCP_elementSheet&&e.sheet){if(e.href)return t=e.href,r=function(t){var r=B(t);t!==r&&j(e,r)},(n=new XMLHttpRequest).open("GET",t),n.overrideMimeType("text/css"),n.onload=function(){n.status>=200&&n.status<400&&r(n.responseText)},void n.send();var t,r,n,o=e.innerHTML,i=B(o);o!==i&&j(e,i)}}function B(e){return e.replace(a,function(e,t,r,n,o,i){return t+"-ie-"+(i?"❗":"")+n+":"+k(o)}).replace(u,function(e,t,r,n){return t+"-ieVar-"+(n?"❗":"")+r+"; "+r})}function k(e){return e}function D(e){return e}function R(e){e["z-index"]===e&&x();const t=e.cssText;var r,n,o=t.match(f);if(o){var s=[];for(r=0;n=o[r++];){let t=n.slice(7,-1);"❗"===t[0]&&(t=t.substr(1)),s.push(t),i[t]||(i[t]=[]),i[t].push(e)}}var c=t.match(p);if(c){var l={};for(r=0;n=c[r++];){let e=n.substr(4).split(":"),t=e[0],r=e[1];"❗"===t[0]&&(t=t.substr(1)),l[t]=r}}return{getters:s,setters:l}}function j(e,t){e.sheet.cssText=t,e.ieCP_polyfilled=!0;for(var r,n=e.sheet.rules,o=0;r=n[o++];){const e=R(r.style);e.getters&&F(r.selectorText,e.getters),e.setters&&z(r.selectorText,e.setters);const t=r.parentRule&&r.parentRule.media&&r.parentRule.media.mediaText;t&&(e.getters||e.setters)&&matchMedia(t).addListener(function(){J(document.documentElement)})}$()}function F(e,t){I(e),M(Z(e),function(r){N(r,t,e),W(r)})}function N(e,t,r){var n,o,i=0;const s=r.split(",");for(e.setAttribute("iecp-needed",!0),e.ieCPSelectors||(e.ieCPSelectors={});n=t[i++];)for(o=0;r=s[o++];){const t=r.trim().split("::");e.ieCPSelectors[n]||(e.ieCPSelectors[n]=[]),e.ieCPSelectors[n].push({selector:t[0],pseudo:t[1]?"::"+t[1]:""})}}function z(e,t){I(e),M(Z(e),function(e){G(e,t)})}function G(e,t){for(var r in e.ieCP_setters||(e.ieCP_setters={}),t)e.ieCP_setters["--"+r]=1;J(e)}function $(){for(var e in i){let o=i[e];for(var t,r=0;t=o[r++];)if(!t.owningElement){var n=t["-ieVar-"+e];if(n&&""!==(n=Q(getComputedStyle(document.documentElement),n)))try{t[e]=n}catch(e){}}}}function I(e){for(var t in e=e.split(",")[0],m){var r=e.split(":"+t);if(r.length>1){var n=r[1].match(/^[^\s]*/);let e=Z(r[0]+n);const o=m[t];M(e,function(e){e.addEventListener(o.on,K),e.addEventListener(o.off,K)})}}}function Z(e){return e.replace(d,"").replace(":not()","")}function W(e){s.add(e),c||(c=!0,requestAnimationFrame(function(){c=!1,l=!0,s.forEach(X),s.clear(),setTimeout(function(){l=!1})}))}function X(e){e.ieCP_unique||(e.ieCP_unique=++v,e.classList.add("iecp-u"+e.ieCP_unique));var t=getComputedStyle(e);let r="";for(var n in e.runtimeStyle.cssText="",e.ieCPSelectors){var o=t["-ieVar-❗"+n];let a=o||t["-ieVar-"+n];if(a){var i={},s=Q(t,a,i);o&&(s+=" !important");for(var c,l=0;c=e.ieCPSelectors[n][l++];)"%styleAttr"===c.selector&&(e.style[n]=s),(o||!1===i.allByRoot)&&(c.pseudo?r+=c.selector+".iecp-u"+e.ieCP_unique+c.pseudo+"{"+n+":"+s+"}\n":e.runtimeStyle[n]=s)}}!function(e,t){if(!e.ieCP_styleEl&&t){const t=document.createElement("style");t.ieCP_elementSheet=1,document.head.appendChild(t),e.ieCP_styleEl=t}e.ieCP_styleEl&&(e.ieCP_styleEl.innerHTML=t)}(e,r)}function J(e){if(e){e===document.documentElement&&$();var t=e.querySelectorAll("[iecp-needed]");e.hasAttribute&&e.hasAttribute("iecp-needed")&&W(e);for(var r,n=0;r=t[n++];)W(r)}}function K(e){J(e.target)}function Q(e,t,r){return function(e,t){let r,n,o=0,i=null,s=0,c="",l=0;for(;r=e[l++];){if("("===r&&(++o,null===i&&e[l-4]+e[l-3]+e[l-2]==="var"&&(i=o,c+=e.substring(s,l-4),s=l),e[l-5]+e[l-4]+e[l-3]+e[l-2]==="calc"&&(n=o)),")"===r&&i===o){let r,o=e.substring(s,l-1).trim(),a=o.indexOf(",");-1!==a&&(r=o.slice(a+1),o=o.slice(0,a)),c+=t(o,r,n),s=l,i=null}")"===r&&n===--o&&(n=null)}return c+=e.substring(s)}(t,function(t,n,o){var i=e.getPropertyValue(t);return o&&(i=i.replace(/^calc\(/,"(")),r&&e.lastPropertyServedBy!==document.documentElement&&(r.allByRoot=!1),""===i&&n&&(i=Q(e,n,r)),i})}}();
                    //# sourceMappingURL=/sm/0d31c8eaba1cbe6281431a1768c1714c7071e7ded57ebaeec897ba2017ae561d.map
                    (function(){'use strict';if(typeof window!=='object'){return}if('IntersectionObserver'in window&&'IntersectionObserverEntry'in window&&'intersectionRatio'in window.IntersectionObserverEntry.prototype){if(!('isIntersecting'in window.IntersectionObserverEntry.prototype)){Object.defineProperty(window.IntersectionObserverEntry.prototype,'isIntersecting',{get:function(){return this.intersectionRatio>0}})}return}function getFrameElement(doc){try{return doc.defaultView&&doc.defaultView.frameElement||null}catch(e){return null}}var document=(function(startDoc){var doc=startDoc;var frame=getFrameElement(doc);while(frame){doc=frame.ownerDocument;frame=getFrameElement(doc)}return doc})(window.document);var registry=[];var crossOriginUpdater=null;var crossOriginRect=null;function IntersectionObserverEntry(entry){this.time=entry.time;this.target=entry.target;this.rootBounds=ensureDOMRect(entry.rootBounds);this.boundingClientRect=ensureDOMRect(entry.boundingClientRect);this.intersectionRect=ensureDOMRect(entry.intersectionRect||getEmptyRect());this.isIntersecting=!!entry.intersectionRect;var targetRect=this.boundingClientRect;var targetArea=targetRect.width*targetRect.height;var intersectionRect=this.intersectionRect;var intersectionArea=intersectionRect.width*intersectionRect.height;if(targetArea){this.intersectionRatio=Number((intersectionArea/targetArea).toFixed(4))}else{this.intersectionRatio=this.isIntersecting?1:0}}function IntersectionObserver(callback,opt_options){var options=opt_options||{};if(typeof callback!='function'){throw new Error('callback must be a function');}if(options.root&&options.root.nodeType!=1&&options.root.nodeType!=9){throw new Error('root must be a Document or Element');}this._checkForIntersections=throttle(this._checkForIntersections.bind(this),this.THROTTLE_TIMEOUT);this._callback=callback;this._observationTargets=[];this._queuedEntries=[];this._rootMarginValues=this._parseRootMargin(options.rootMargin);this.thresholds=this._initThresholds(options.threshold);this.root=options.root||null;this.rootMargin=this._rootMarginValues.map(function(margin){return margin.value+margin.unit}).join(' ');this._monitoringDocuments=[];this._monitoringUnsubscribes=[]}IntersectionObserver.prototype.THROTTLE_TIMEOUT=100;IntersectionObserver.prototype.POLL_INTERVAL=null;IntersectionObserver.prototype.USE_MUTATION_OBSERVER=true;IntersectionObserver._setupCrossOriginUpdater=function(){if(!crossOriginUpdater){crossOriginUpdater=function(boundingClientRect,intersectionRect){if(!boundingClientRect||!intersectionRect){crossOriginRect=getEmptyRect()}else{crossOriginRect=convertFromParentRect(boundingClientRect,intersectionRect)}registry.forEach(function(observer){observer._checkForIntersections()})}}return crossOriginUpdater};IntersectionObserver._resetCrossOriginUpdater=function(){crossOriginUpdater=null;crossOriginRect=null};IntersectionObserver.prototype.observe=function(target){var isTargetAlreadyObserved=this._observationTargets.some(function(item){return item.element==target});if(isTargetAlreadyObserved){return}if(!(target&&target.nodeType==1)){throw new Error('target must be an Element');}this._registerInstance();this._observationTargets.push({element:target,entry:null});this._monitorIntersections(target.ownerDocument);this._checkForIntersections()};IntersectionObserver.prototype.unobserve=function(target){this._observationTargets=this._observationTargets.filter(function(item){return item.element!=target});this._unmonitorIntersections(target.ownerDocument);if(this._observationTargets.length==0){this._unregisterInstance()}};IntersectionObserver.prototype.disconnect=function(){this._observationTargets=[];this._unmonitorAllIntersections();this._unregisterInstance()};IntersectionObserver.prototype.takeRecords=function(){var records=this._queuedEntries.slice();this._queuedEntries=[];return records};IntersectionObserver.prototype._initThresholds=function(opt_threshold){var threshold=opt_threshold||[0];if(!Array.isArray(threshold))threshold=[threshold];return threshold.sort().filter(function(t,i,a){if(typeof t!='number'||isNaN(t)||t<0||t>1){throw new Error('threshold must be a number between 0 and 1 inclusively');}return t!==a[i-1]})};IntersectionObserver.prototype._parseRootMargin=function(opt_rootMargin){var marginString=opt_rootMargin||'0px';var margins=marginString.split(/\s+/).map(function(margin){var parts=/^(-?\d*\.?\d+)(px|%)$/.exec(margin);if(!parts){throw new Error('rootMargin must be specified in pixels or percent');}return{value:parseFloat(parts[1]),unit:parts[2]}});margins[1]=margins[1]||margins[0];margins[2]=margins[2]||margins[0];margins[3]=margins[3]||margins[1];return margins};IntersectionObserver.prototype._monitorIntersections=function(doc){var win=doc.defaultView;if(!win){return}if(this._monitoringDocuments.indexOf(doc)!=-1){return}var callback=this._checkForIntersections;var monitoringInterval=null;var domObserver=null;if(this.POLL_INTERVAL){monitoringInterval=win.setInterval(callback,this.POLL_INTERVAL)}else{addEvent(win,'resize',callback,true);addEvent(doc,'scroll',callback,true);if(this.USE_MUTATION_OBSERVER&&'MutationObserver'in win){domObserver=new win.MutationObserver(callback);domObserver.observe(doc,{attributes:true,childList:true,characterData:true,subtree:true})}}this._monitoringDocuments.push(doc);this._monitoringUnsubscribes.push(function(){var win=doc.defaultView;if(win){if(monitoringInterval){win.clearInterval(monitoringInterval)}removeEvent(win,'resize',callback,true)}removeEvent(doc,'scroll',callback,true);if(domObserver){domObserver.disconnect()}});var rootDoc=(this.root&&(this.root.ownerDocument||this.root))||document;if(doc!=rootDoc){var frame=getFrameElement(doc);if(frame){this._monitorIntersections(frame.ownerDocument)}}};IntersectionObserver.prototype._unmonitorIntersections=function(doc){var index=this._monitoringDocuments.indexOf(doc);if(index==-1){return}var rootDoc=(this.root&&(this.root.ownerDocument||this.root))||document;var hasDependentTargets=this._observationTargets.some(function(item){var itemDoc=item.element.ownerDocument;if(itemDoc==doc){return true}while(itemDoc&&itemDoc!=rootDoc){var frame=getFrameElement(itemDoc);itemDoc=frame&&frame.ownerDocument;if(itemDoc==doc){return true}}return false});if(hasDependentTargets){return}var unsubscribe=this._monitoringUnsubscribes[index];this._monitoringDocuments.splice(index,1);this._monitoringUnsubscribes.splice(index,1);unsubscribe();if(doc!=rootDoc){var frame=getFrameElement(doc);if(frame){this._unmonitorIntersections(frame.ownerDocument)}}};IntersectionObserver.prototype._unmonitorAllIntersections=function(){var unsubscribes=this._monitoringUnsubscribes.slice(0);this._monitoringDocuments.length=0;this._monitoringUnsubscribes.length=0;for(var i=0;i<unsubscribes.length;i++){unsubscribes[i]()}};IntersectionObserver.prototype._checkForIntersections=function(){if(!this.root&&crossOriginUpdater&&!crossOriginRect){return}var rootIsInDom=this._rootIsInDom();var rootRect=rootIsInDom?this._getRootRect():getEmptyRect();this._observationTargets.forEach(function(item){var target=item.element;var targetRect=getBoundingClientRect(target);var rootContainsTarget=this._rootContainsTarget(target);var oldEntry=item.entry;var intersectionRect=rootIsInDom&&rootContainsTarget&&this._computeTargetAndRootIntersection(target,targetRect,rootRect);var rootBounds=null;if(!this._rootContainsTarget(target)){rootBounds=getEmptyRect()}else if(!crossOriginUpdater||this.root){rootBounds=rootRect}var newEntry=item.entry=new IntersectionObserverEntry({time:now(),target:target,boundingClientRect:targetRect,rootBounds:rootBounds,intersectionRect:intersectionRect});if(!oldEntry){this._queuedEntries.push(newEntry)}else if(rootIsInDom&&rootContainsTarget){if(this._hasCrossedThreshold(oldEntry,newEntry)){this._queuedEntries.push(newEntry)}}else{if(oldEntry&&oldEntry.isIntersecting){this._queuedEntries.push(newEntry)}}},this);if(this._queuedEntries.length){this._callback(this.takeRecords(),this)}};IntersectionObserver.prototype._computeTargetAndRootIntersection=function(target,targetRect,rootRect){if(window.getComputedStyle(target).display=='none')return;var intersectionRect=targetRect;var parent=getParentNode(target);var atRoot=false;while(!atRoot&&parent){var parentRect=null;var parentComputedStyle=parent.nodeType==1?window.getComputedStyle(parent):{};if(parentComputedStyle.display=='none')return null;if(parent==this.root||parent.nodeType==9){atRoot=true;if(parent==this.root||parent==document){if(crossOriginUpdater&&!this.root){if(!crossOriginRect||crossOriginRect.width==0&&crossOriginRect.height==0){parent=null;parentRect=null;intersectionRect=null}else{parentRect=crossOriginRect}}else{parentRect=rootRect}}else{var frame=getParentNode(parent);var frameRect=frame&&getBoundingClientRect(frame);var frameIntersect=frame&&this._computeTargetAndRootIntersection(frame,frameRect,rootRect);if(frameRect&&frameIntersect){parent=frame;parentRect=convertFromParentRect(frameRect,frameIntersect)}else{parent=null;intersectionRect=null}}}else{var doc=parent.ownerDocument;if(parent!=doc.body&&parent!=doc.documentElement&&parentComputedStyle.overflow!='visible'){parentRect=getBoundingClientRect(parent)}}if(parentRect){intersectionRect=computeRectIntersection(parentRect,intersectionRect)}if(!intersectionRect)break;parent=parent&&getParentNode(parent)}return intersectionRect};IntersectionObserver.prototype._getRootRect=function(){var rootRect;if(this.root&&!isDoc(this.root)){rootRect=getBoundingClientRect(this.root)}else{var doc=isDoc(this.root)?this.root:document;var html=doc.documentElement;var body=doc.body;rootRect={top:0,left:0,right:html.clientWidth||body.clientWidth,width:html.clientWidth||body.clientWidth,bottom:html.clientHeight||body.clientHeight,height:html.clientHeight||body.clientHeight}}return this._expandRectByRootMargin(rootRect)};IntersectionObserver.prototype._expandRectByRootMargin=function(rect){var margins=this._rootMarginValues.map(function(margin,i){return margin.unit=='px'?margin.value:margin.value*(i%2?rect.width:rect.height)/100});var newRect={top:rect.top-margins[0],right:rect.right+margins[1],bottom:rect.bottom+margins[2],left:rect.left-margins[3]};newRect.width=newRect.right-newRect.left;newRect.height=newRect.bottom-newRect.top;return newRect};IntersectionObserver.prototype._hasCrossedThreshold=function(oldEntry,newEntry){var oldRatio=oldEntry&&oldEntry.isIntersecting?oldEntry.intersectionRatio||0:-1;var newRatio=newEntry.isIntersecting?newEntry.intersectionRatio||0:-1;if(oldRatio===newRatio)return;for(var i=0;i<this.thresholds.length;i++){var threshold=this.thresholds[i];if(threshold==oldRatio||threshold==newRatio||threshold<oldRatio!==threshold<newRatio){return true}}};IntersectionObserver.prototype._rootIsInDom=function(){return!this.root||containsDeep(document,this.root)};IntersectionObserver.prototype._rootContainsTarget=function(target){var rootDoc=(this.root&&(this.root.ownerDocument||this.root))||document;return(containsDeep(rootDoc,target)&&(!this.root||rootDoc==target.ownerDocument))};IntersectionObserver.prototype._registerInstance=function(){if(registry.indexOf(this)<0){registry.push(this)}};IntersectionObserver.prototype._unregisterInstance=function(){var index=registry.indexOf(this);if(index!=-1)registry.splice(index,1)};function now(){return window.performance&&performance.now&&performance.now()}function throttle(fn,timeout){var timer=null;return function(){if(!timer){timer=setTimeout(function(){fn();timer=null},timeout)}}}function addEvent(node,event,fn,opt_useCapture){if(typeof node.addEventListener=='function'){node.addEventListener(event,fn,opt_useCapture||false)}else if(typeof node.attachEvent=='function'){node.attachEvent('on'+event,fn)}}function removeEvent(node,event,fn,opt_useCapture){if(typeof node.removeEventListener=='function'){node.removeEventListener(event,fn,opt_useCapture||false)}else if(typeof node.detatchEvent=='function'){node.detatchEvent('on'+event,fn)}}function computeRectIntersection(rect1,rect2){var top=Math.max(rect1.top,rect2.top);var bottom=Math.min(rect1.bottom,rect2.bottom);var left=Math.max(rect1.left,rect2.left);var right=Math.min(rect1.right,rect2.right);var width=right-left;var height=bottom-top;return(width>=0&&height>=0)&&{top:top,bottom:bottom,left:left,right:right,width:width,height:height}||null}function getBoundingClientRect(el){var rect;try{rect=el.getBoundingClientRect()}catch(err){}if(!rect)return getEmptyRect();if(!(rect.width&&rect.height)){rect={top:rect.top,right:rect.right,bottom:rect.bottom,left:rect.left,width:rect.right-rect.left,height:rect.bottom-rect.top}}return rect}function getEmptyRect(){return{top:0,bottom:0,left:0,right:0,width:0,height:0}}function ensureDOMRect(rect){if(!rect||'x'in rect){return rect}return{top:rect.top,y:rect.top,bottom:rect.bottom,left:rect.left,x:rect.left,right:rect.right,width:rect.width,height:rect.height}}function convertFromParentRect(parentBoundingRect,parentIntersectionRect){var top=parentIntersectionRect.top-parentBoundingRect.top;var left=parentIntersectionRect.left-parentBoundingRect.left;return{top:top,left:left,height:parentIntersectionRect.height,width:parentIntersectionRect.width,bottom:top+parentIntersectionRect.height,right:left+parentIntersectionRect.width}}function containsDeep(parent,child){var node=child;while(node){if(node==parent)return true;node=getParentNode(node)}return false}function getParentNode(node){var parent=node.parentNode;if(node.nodeType==9&&node!=document){return getFrameElement(node)}if(parent&&parent.assignedSlot){parent=parent.assignedSlot.parentNode}if(parent&&parent.nodeType==11&&parent.host){return parent.host}return parent}function isDoc(node){return node&&node.nodeType===9}window.IntersectionObserver=IntersectionObserver;window.IntersectionObserverEntry=IntersectionObserverEntry}());
                    IV$('#base_header_container').append('<div class="ie_info_banner"><p onClick="moveEdge();">본 사이트는 Edge, Chrome 브라우저에 최적화 되어 있습니다. Edge 브라우저로 이동하기 →</p></div>');
                };
            };
        }
    },

};


var IVBaseScroll = IVBaseScroll || {
    delta : 0,
    didScroll : null,
    direction : null,
    amount : null,
    st :  null,
    lastSt : null,
    stickyActiveHeight : null,
    stickySet : function(){
        let stickyHeight = 0;
        var $ivsticky = document.querySelectorAll('.iv_sticky');
        if($ivsticky.length > 0){
            var $ivsticky = IV$('.iv_sticky');
            let ivStickyPositionArray = [];
            let ivStickyHeightArray = [];
            IVBaseScroll.stickyActiveHeight = 0;
            $ivsticky.each(function(i,e){
                let $e = IV$(e);
                let boundingClientRect = e.getBoundingClientRect();
                let height = boundingClientRect.height;
                let top = boundingClientRect.y;
                let stickyChk = parseInt($e.css('top'), 10);
                let dataStart = $e.attr('data-ivsticky-start'); 
                if(top < 0 && stickyChk == 0){
                    return false;
                }else{
                    var pass = false;
                    if(typeof dataStart !== 'undefined'){
                        if(dataStart.indexOf('auto') > -1){
                            let autoTop = ivStickyPositionArray.reduce(function(acc,el,idx,arr){
                                if(idx < arr.length-1){
                                    if(arr[idx+1] != el){
                                        acc = acc + Math.abs(ivStickyHeightArray[idx]);
                                    };
                                }else{
                                    acc = acc + Math.abs(ivStickyHeightArray[idx]);
                                };
                                return acc;
                            },0);
                            $e.css('top', autoTop);
                        };
                        if(dataStart === 'auto-once'){
                            $e.removeAttr('data-ivsticky-start');
                        }else if(dataStart == '1'){
                        	pass = true;
                        }
                    };
                    ivStickyHeightArray.push(height);
                    if(pass != true){
                        if(top < stickyChk){
                            $e.addClass('scroll-max').removeClass('scroll-fixed');
                            ivStickyHeightArray.splice(i,1,-1*ivStickyHeightArray[i]);
                        }else{
                            if(top == stickyChk){
                                let chk = true;
                                let filter = $ivsticky.filter(function(idx, el) {
                                    if(ivStickyPositionArray[idx] == stickyChk){
                                        let offsetParent1 = el.offsetParent;
                                        let offsetParent2 =   e.offsetParent;
                                        let zIndex1 = 0;
                                        let zIndex2 =  0;
                                        if(offsetParent1 == offsetParent2){
                                            zIndex1 = Number(IV$(el).css('zIndex'));
                                            zIndex2 =  IV$(e).css('zIndex');
                                        }else{
                                            zIndex1 = Number(IV$(offsetParent1).css('zIndex'));
                                            zIndex2 =  IV$(offsetParent2).css('zIndex');
                                        };
                                        zIndex1 = (isNaN(zIndex1)) ? 0 : zIndex1;
                                        zIndex2 = (isNaN(zIndex2)) ? 0 : zIndex2;
                                        if(zIndex1 <= zIndex2){
                                            IV$(el).addClass('scroll-max');
                                            ivStickyHeightArray.splice(idx,1,-1*ivStickyHeightArray[idx]);
                                            return true;
                                        }else{
                                            chk = false;
                                        };
                                    };
                                });
                                if(chk != false){
                                    if(IVBaseScroll.st > 0){
                                        $e.removeClass('scroll-max').addClass('scroll-fixed');
                                    }else{
                                        $e.removeClass('scroll-max scroll-fixed');
                                    };
                                }else{
                                    ivStickyHeightArray.splice(i,1,-1*ivStickyHeightArray[i]);
                                };
                            }else{
                                $e.removeClass('scroll-max scroll-fixed');
                                ivStickyHeightArray.splice(i,1,-1*ivStickyHeightArray[i]);
                            };
                        };
                    }
                    ivStickyPositionArray.push(stickyChk);
                }
            });
            IVBaseScroll.stickyActiveHeight = ivStickyHeightArray.reduce(function(acc,el){
                if(el > 0){
                    acc = acc + el;
                };
                return acc;
            },0);
            IV_topHeight = IVBaseScroll.stickyActiveHeight;
            document.querySelector(':root').style.setProperty("--topHeight", IV_topHeight +"px");
        }
    },
    fix : function(){
        if(IVBaseScroll.st > 0){
            IV$('.iv_sticky[data-ivsticky-start="1"]').addClass('scroll-fixed');
        }else{
            IV$('.iv_sticky[data-ivsticky-start="1"]').removeClass('scroll-fixed');
        };
    },
    scrollUp : function(){
        IV$('html, .iv_sticky').addClass('scroll-up').removeClass('scroll-down');
        IVBaseScroll.direction = 'up';
    },
    scrollDown : function(){
        IV$('html, .iv_sticky').addClass('scroll-down').removeClass('scroll-up');
        IVBaseScroll.direction = 'down';
    },
    infoUpdate : function(){
        IVBaseScroll.amount = IVBaseScroll.lastSt - IVBaseScroll.st;
        IVBaseScroll.lastSt = IVBaseScroll.st;
        IVBaseScroll.stickySet();
    },
    execute : function(){
        if(Math.abs(IVBaseScroll.lastSt - IVBaseScroll.st) <= IVBaseScroll.delta){
            IVBaseScroll.didScroll = false;
            return;
        };
        IVBaseScroll.didScroll = true;
        IVBaseScroll.basic();
    },
    basic : function(){
        IVBaseScroll.fix();
        if(IVBaseScroll.lastSt > IVBaseScroll.st){
            IVBaseScroll.scrollUp();
        }else{
            IVBaseScroll.scrollDown(); 
        };
        IVBaseScroll.infoUpdate();
    }
};

if(IV_BROWSER_CHK == 'iphone'){
    //IVBaseScroll.delta = 50;
}

/**
 * 문서 이벤트 
 * - iv_common.js에서 함수 호출하여 사용 (sub_container의 js보다 먼저 실행이 필요할때 사용)
 * @ IVreadyBefore {event} document.ready(DOMContentLoaded)보다 빠름
 * @ IVready {event} document.ready(DOMContentLoaded)
 * @ IVloadBefore {event} window.load(load)보다 빠름
 * @ IVload {event} window.load
 * @ IVbeforeunload {event} 사용자 페이지 이탈 중
 * @ IVunload {event} 사용자 페이지 이탈 
 */
var IVbeforeUnloadFlag = false;
document.addEventListener("readystatechange", function (e) {
    switch (document.readyState) {
        case "interactive":
            let e = new CustomEvent("IVreadyBefore");
            document.body.dispatchEvent(e);
            break;
        case "complete":
            let t = new CustomEvent("IVloadBefore");
            document.body.dispatchEvent(t);
    }
}), window.addEventListener("DOMContentLoaded", function (e) {
    let t = new CustomEvent("IVready");
    document.body.dispatchEvent(t)
}), window.addEventListener("load", function (e) {
    let t = new CustomEvent("IVload");
    document.body.dispatchEvent(t)
}), window.addEventListener("beforeunload", function (e) {
    let t = new CustomEvent("IVbeforeunload");
    IVbeforeUnloadFlag = true;
    document.body.dispatchEvent(t);
}), document.addEventListener("visibilitychange", function (e) {
    if (document.visibilityState === 'visible') {
        let t = new CustomEvent("IVVisible");
        document.body.dispatchEvent(t);
    } else if(document.visibilityState === 'hidden') {
        if(IVbeforeUnloadFlag){
            let t = new CustomEvent("IVunload");
            document.body.dispatchEvent(t, {cancelable: true, bubbles: true});
        }else{
            let t = new CustomEvent("IVNotvisible");
            document.body.dispatchEvent(t);
        }
    }
}), window.addEventListener("scroll", iv_util.throttle(function (e) {
    var t = window.pageYOffset;
    if (parseInt(IV$("html").css("top"), 10) < 0);
    else {
        IVBaseScroll.st = t;
        let e = new CustomEvent("IVScroll", {
            detail: IVBaseScroll
        });
        document.body.dispatchEvent(e)
    }
}, 100)), window.addEventListener("scroll", iv_util.debounce(function (e) {
    var t = window.pageYOffset;
    if (parseInt(IV$("html").css("top"), 10) < 0);
    else {
        IVBaseScroll.st = t;
        let e = new CustomEvent("IVScroll", {
            detail: IVBaseScroll
        });
        document.body.dispatchEvent(e)
    }
}, 200)), window.addEventListener("resize", function () {
    iv_commonBaseFunc.cssVarSet(isPopupPage)
});
/* ================================================================================================================================================================================

        																 모바일 레이어 팝업

** 제외 페이지: 로그인/ 회원가입 브릿지/ 회원가입/ 회원가입 완료/ 라이브 혜택 페이지

** 안다르 세션기준 첫 진입 시 팝업 노출( 첫 진입한 페이지가 제외 페이지인 경우 미노출 )
** 라이브 혜택 페이지에서 배너 클릭 > pip 닫기 > 페이지 이동할 경우 팝업 노출 ( 제외 페이지인 경우 미노출 )
** 모바일 커스텀 팝업 내 [오늘하루안보기] 버튼 클릭하기 전까지 계속 노출

================================================================================================================================================================================== */ 

var loginPage = $('#login').length; //로그인 페이지
var joinbridgePage = $('.bridge_container').length; //회원가입 브릿지 페이지
var joinPage = $('#join_input').length; //회원가입 페이지
var joinResultPage = $('#join_finish').length; //회원가입 완료 페이지
var liveBenefitPage = $('.live_benefit').length; //라이브 혜택 페이지
var mappingJoinPage = $('.mapping_join_container').length; // 계정 연동 페이지 (sns 연동 on 했을때 계정연동 페이지)

var liveListCheck = $('#liveListCheck').length;
var liveIframeCheck = $('#liveListCheck', window.parent.document).length;

var thisHref = window.location.href;

var swiperLength = $('.mainpopupSwiper li').length;
var OPEN_POPUP = false;

//if(loginPage == 0 && joinbridgePage == 0 && joinPage == 0 && joinResultPage == 0 && mappingJoinPage == 0 && liveIframeCheck == 0) {

    var $layerPopupWrap = document.querySelector('.mainpopup_dimm');
    var $layerPopup = document.querySelector('.mainpopup');
    var $btnLayerPopupClose = document.querySelector('.mainpopup .btnClose');
    var $btnLayerPopupTodayHide = document.querySelector('.mainpopup .btnTodayHide');
    const body = document.getElementsByTagName('body')[0];

    // 라이브 혜택 페이지로 안다르 최초 진입하여 상품 상세 페이지로 이동 할 경우 미노출
    //var liveProdeuctDetail = sessionStorage.getItem('liveProdeuctDetail');

    $(document).ready(function(){
        var swiperLength = $('.mainpopupSwiper li').length;
        if(swiperLength !== 0){
            
            switch(LAYERPOPUP_SHOW.page) {
                case 'all':
                    OPEN_POPUP = true;
                    break;

                case 'main' :
                    if($('#main').length > 0) OPEN_POPUP = true;
                    break;

                case 'list' :
                    var showCate = LAYERPOPUP_SHOW.array;
                    var cateNum = document.getElementById('cate_number');

                    if(!!cateNum) {
                        cateNum = cateNum = cateNum.getAttribute('value');
                        cateNum= iv_util.getParameterByName(cateNum,'cate_no');
                        if(showCate.indexOf(cateNum) > -1) OPEN_POPUP = true;
                    }
                    break;

                case 'detail' :
                    var showProduct = LAYERPOPUP_SHOW.array;
                    var prd_detail = document.getElementById('detail'); 
                    if(!!prd_detail && showProduct.indexOf(String(prdNum)) > -1) OPEN_POPUP = true;
                    break;

                case 'etc' :
                    var showPage = LAYERPOPUP_SHOW.array;
                    showPage.forEach(function(item,index){
                        console.log('thisHref',typeof thisHref);
                        console.log('item',typeof item);
                        if(thisHref.indexOf(item) > -1) OPEN_POPUP = true;
                    });

                    break;
            }

        	//팝업 최초 노출
        	//var layerPopupClose = sessionStorage.getItem('layerPopupClose');
        	if(!$.cookie('popupCookie') ){
        	    layerPopupShow();
        	};

        	//팝업 닫기 버튼 클릭
        	$btnLayerPopupClose.addEventListener('click', function(){
        	    layerPopupHide(0);
        	    //sessionStorage.setItem('layerPopupClose', 'Y');
        	});

        	//딤드 영역 클릭
        	$layerPopupWrap.addEventListener('click', function(e){
        	    if(!$(e.target).hasClass("mainpopup")) {
        	        layerPopupHide(0);
        	        //sessionStorage.setItem('layerPopupClose', 'Y');
        	    }
        	});

        	//팝업 오늘 하루 보지 않기 버튼 클릭
        	$btnLayerPopupTodayHide.addEventListener('click', function(){
        	    layerPopupHide(1);
        	    //sessionStorage.setItem('layerPopupClose', 'Y');
        	});

        	//레이어팝업 노출
        	function layerPopupShow(){
        	    setTimeout(function(){
        	        $layerPopupWrap.style.display = 'block'
        	    },800)
        	    body.classList.add('scrollLock');
        	}

        	//레이어팝업 비노출
        	function layerPopupHide(state){
        	    //닫기버튼
        	    $layerPopup.classList.add('down');
        	    body.classList.remove('scrollLock');
        	    setTimeout(function(){
        	        $layerPopupWrap.style.display = 'none'
        	    },300)
        	    //오늘하루보지않기 버튼을 누른 경우
        	    if(state === 1){
        	        if($.cookie('popupCookie') == undefined){
        	            //쿠키가 없는 경우 popupCookie 쿠키를 추가
        	            $.cookie('popupCookie', 'Y', { expires: 1, path: '/' });
        	            // expires : 주기
        	            //path : 적용 페이지
        	        }        
        	    }
        	}

        	//팝업 슬라이드
        	if( swiperLength > 1 ){
        	    setTimeout(function(){
        	        var mainpopupSwiper = new Swiper(".mainpopupSwiper", {
        	            loop: true,
        	            loopAdditionalSlides: 1,
        	            pagination: {
        	                el: ".mainpopupSwiper .swiper-pagination",
        	                type: "fraction",
        	            },
        	        });
        	    },800);
        	} else {
        	    $('.mainpopupSwiper .swiper-pagination').addClass('displaynone');
        	};
        } //swiperLength

    }); //document.ready
//} 

$(document).ready(function(){
    var prdListPage = $('#aside').length;
    if(prdListPage > 0){

        //상품분류페이지인지아닌지 분기처리
        //현재 단계 출력 
        prdListCateFunc();
        function prdListCateFunc(){
            if($('#aside .base_menu_wrapper[data-cate-type="prd_list"]').hasClass('done') == false){
                setTimeout(prdListCateFunc,50);
            }else{
                //카테고리 현재 페이지 직계 부모 + 형제 단계 띄우기 
                var check_url = window.location.href;
                var cateNumChk;    
                if(check_url.indexOf('cate_no=') > -1){
                    cateNumChk = check_url.split('cate_no=')[1];
                    //현재 보고 있는 페이지 카테고리 확인 
                    //이후 파라미터 값 있을 경우 제거해주고 숫자만 남겨서 방지 
                    if(cateNumChk.indexOf('&') > -1){
                        cateNumChk = cateNumChk.split('&')[0];
                        cateNumChk = cateNumChk.replace(/[^0-9]/g, '').trim();
                        //이후 파라미터 없을 경우 숫자만 남겨서 오류 방지 (ex 23#none)
                    }else{
                        cateNumChk = cateNumChk.replace(/[^0-9]/g, '').trim();
                    }

                    var currentMenu = $('#aside .base_menu_wrapper[data-cate-type="prd_list"] li[data-cate="'+ cateNumChk +'"]');
                    var currentMenuFirstChild = currentMenu.parent().children('li').eq(0);

                    currentMenu.children('a').addClass('on current'); //현재 단계에 on current 
                    currentMenu.parent().children('li').children('a').addClass('on now good'); //현재 단계 형제 단계에 on
                    currentMenu.parents('ul[class^="menu"]').siblings('a').addClass('on'); //직계 조상 영역에 on 

                    var currentMenusiblingsLength = $('#aside .current_parent').children('li').length;

                }
            }
        }


        

        //aside down_btn 눌렀을 때
        $('#aside .down_btn').click(function(){
            // var currentMenusiblingsLength = $('.menu_3ul').children('li').length;
            // var currentMenuHeight = $('.menu_3ul').find('li a').outerHeight();
            var active = $(this).hasClass('active');
			 if(active){
                $(this).removeClass('active');
                //  $('.menu_3ul').removeClass('show');
                //  $('.menu_3ul').css('max-height', currentMenuHeight);
                $(this).closest('li').find('ul').hide(300);
            }else{
                $(this).addClass('active');
                // $('.menu_3ul').css('max-height', currentMenusiblingsLength*currentMenuHeight);
                // $('.menu_3ul').addClass('show');
                $(this).closest('li').find('ul').show(300);
            }
        });


    }//if

});

// 베스트 탭 스와이퍼
var bestTapSwiper = new Swiper(".bestTap", {
    slidesPerView: 'auto',
    spaceBetween: 10,
    freeMode: {
        enabled: true,
        sticky: true,
    },
});
sCouponDownResultUrl = '/coupon/coupon_down_result.html';
var customMessageChk = false;
var customMessageSuccess = '';
var customMessageFail = '';
var goScrollTop = '';
var isLogin = false;
var isLoginOpenerUrl = '';
var currentUrl = window.location.href;
var windowPathName = window.location.pathname;
var downloadCouponHref = '';
var downloadCouponJoin = '';
var returnUrlChk = '';
var isMemberPage = false; //로그인, 회원가입 등 비회원 상태에서 접근하는 페이지인지

$(document).ready(function(){
    if(windowPathName.indexOf('/member/') > -1){
    	isMemberPage = true;
    }
    
    if(windowPathName.indexOf('/test') > -1){
    }else{
        //배너에 쿠폰넘버가 있는지 체크
        $('.df_banner_wrap').each(function(){
            var dfBannerWrap = $(this);
            dfBannerWrap.find('a').each(function(){
                var bannerHerf = $(this).data('href');
                var bannerTitle = $(this).data('title');

                //배너 구분(링크Xor쿠폰링크or일반링크)
                if(bannerHerf == '#none'){ //배너 url #none일 경우 클릭이벤트 X
                    $(this).css('pointer-events', 'none');
                }else if(bannerHerf.indexOf('coupon_no') > -1){ //쿠폰 링크 이동 배너일 경우
                    var coponNo = iv_util.getParameterByName(bannerHerf, 'coupon_no');
                    if(bannerTitle){
                        if(typeof bannerTitle == 'number') {
                            bannerTitle = String(bannerTitle);
                        }
                        if(bannerTitle.indexOf('alertCustom') > -1){
                            if(coponNo.indexOf(',') > -1){
                                $(this).addClass('coupon_download_all');
                            }
                        }else{
                            if(bannerHerf.indexOf('opener_url=') > -1){
                                $(this).attr('href',bannerHerf);
                            }else{
                                if(isMemberPage){
                                    $(this).attr('href',bannerHerf + '&opener_url=/index.html' );
                                }else{
                                    $(this).attr('href',bannerHerf + '&opener_url=' + window.location.pathname + window.location.search );
                                }
                            }
                        }
                    }else{
                        if(bannerHerf.indexOf('opener_url=') > -1){
                            $(this).attr('href',bannerHerf);
                        }else{
                            if(isMemberPage){
                                $(this).attr('href',bannerHerf + '&opener_url=/index.html' );
                            }else{
                                $(this).attr('href',bannerHerf + '&opener_url=' + window.location.pathname + window.location.search );
                            }
                        }
                    }
                }else{ //일반 링크 이동 배너일 경우
                    $(this).attr('href', bannerHerf);
                }
            });
        });

        //분류or상세페이지 -> 로그인 하고 왔을 때 currentUrl값을 세션에 저장된 값으로 바꿔줌
        if($('#loginChk_member').length > 0){
            var couponInfoCallTemp = sessionStorage.getItem('couponzone_moveback');
            if(couponInfoCallTemp){
                couponInfoCallTemp = JSON.parse(couponInfoCallTemp);
                if(couponInfoCallTemp.ivCouponReturnUrl){
                    currentUrl = couponInfoCallTemp.ivCouponReturnUrl;
                }
            }
        }

        if(!isMemberPage){
            if(currentUrl.indexOf('coupon_param=') > -1){
                var couponDownChk = currentUrl.split('coupon_param=')[1];
                couponDownChk = couponDownChk.split('coupon_no=')[1];
                if(couponDownChk.indexOf('&') > -1){
                    couponDownChk = couponDownChk.split('&')[0];
                }
                if(couponDownChk.indexOf('#') > -1){
                    couponDownChk = couponDownChk.split('#')[0];
                }

                var couponInfoCall = sessionStorage.getItem('couponzone_moveback');
                if(couponInfoCall){
                    couponInfoCall = JSON.parse(couponInfoCall);
                    $('html, body').animate({scrollTop: couponInfoCall.scrollTop}, 300);
                    if(couponInfoCall.customChk){
                        customMessageChk = true;
                        customMessageSuccess = couponInfoCall.customSuccess;
                        customMessageFail = couponInfoCall.customFail;
                    }
                    if(couponInfoCall.ivCouponReturnUrl){
                        var couponReturnUrl = couponInfoCall.ivCouponReturnUrl;
                        if(couponReturnUrl.indexOf('?coupon_param') > -1){
                            couponReturnUrl = couponInfoCall.ivCouponReturnUrl.split('?coupon_param')[0];
                        }else if(couponReturnUrl.indexOf('&coupon_param') > -1){
                            couponReturnUrl = couponInfoCall.ivCouponReturnUrl.split('&coupon_param')[0];
                        }else{
                        }
                        history.pushState(null, null, couponReturnUrl);
                    }
                    sessionStorage.removeItem('couponzone_moveback');
                }
                //쿠폰발급실행 레이어
                setTimeout(function(){
                    if (typeof(sCouponDownResultUrl) !== 'undefined') {
                        sDownloadURL = '/exec/front/newcoupon/IssueDownload';
                        aParam = 'coupon_no=' + couponDownChk;
                        aParam += '&return_type=json';
                        //쿠폰발급 실행
                        $.post(sDownloadURL, aParam, function( data ) {
                            COUPON.getDownCouponResultForm(data);
                        }, 'json');
                    } else {
                        location.href='/exec/front/newcoupon/IssueDownload?coupon_no='+ couponDownChk +'&opener_url=' ;
                    }
                },300);
            }else{
                sessionStorage.removeItem('couponzone_moveback');
            }
        }

    }

    $('.coupon_download_all').bind('click', function(e) {
        downloadCouponHref = $(this).data('href');
        downloadCouponJoin = iv_util.getParameterByName(downloadCouponHref, 'coupon_no');
        e.preventDefault();
        customMessageChk = false;
        customMessageSuccess = '';
        customMessageFail = '';
        goScrollTop = $(window).scrollTop();
        if($('#loginChk_member').length > 0){
        	isLogin =  true;
            var thisUrl = $(this).data('href');
            if(thisUrl.indexOf('opener_url') > -1){
            	isLoginOpenerUrl = thisUrl.split('opener_url=')[1];
            }
        }
        
        //쿠폰발급실행 레이어
        if (typeof(sCouponDownResultUrl) !== 'undefined') {
            sDownloadURL = '/exec/front/newcoupon/IssueDownload';
            aParam = 'coupon_no=' + downloadCouponJoin;
            aParam += '&return_type=json';
            //쿠폰발급 실행
            $.post(sDownloadURL, aParam, function(data) {
                COUPON.getDownCouponResultForm(data);
            }, 'json');
        } else {
            //location.href='/exec/front/newcoupon/IssueDownload?coupon_no='+ downloadCouponJoin +'&opener_url=' + windowPathName ;
        };
    });
    
});


var COUPON = {
    is_coupon_code_submit: false,
    is_coupon_use_submit: false,
    viewInfo: function(iCouponNo, oCouponElem)
    {
        var aPos = EC$(oCouponElem).offset();
        var oCoupon = aCouponInfo[iCouponNo];
        EC$('#dCouponDetail').remove();
        var sHtml = '<div id="dCouponDetail" class="layerTheme"></div>';
        EC$('body').append(sHtml);
        if (mobileWeb === true) {
            try {
                EC$('#dCouponDetail').html('<h4><strong>' + __('쿠폰정보') + '</strong></h4>' +
                                           '<ul class="couponInfo">' +
                                           '<li>' + __('쿠폰명') + ' : ' + decodeURIComponent(oCoupon.coupon_name) + '</li>' +
                                           '<li>' + __('적용상품') + ' : ' + decodeURIComponent(oCoupon.coupon_product_info) + '</li>' +
                                           '<li>' + __('사용조건') + ' : ' + decodeURIComponent(oCoupon.coupon_usecon) + ' ' + decodeURIComponent(oCoupon.region_delivery_msg) + ' ' + decodeURIComponent(oCoupon.foreign_delivery_msg) + '</li>' +
                                           '<li>' + __('발행수량') + ' : ' + decodeURIComponent(oCoupon.coupon_issue) + '</li>' +
                                           '<li>' + __('사용기간') + ' : ' + decodeURIComponent(oCoupon.coupon_period_detail) + '</li>' +
                                           '</ul>' +
                                           '<p class="mButton">' +
                                           '<a href="' + oCoupon.coupon_issue_url + '" class="tSubmit1">' + '<span>' + __('다운받기') + '</span></a>' +
                                           '<a href="#none" class="tSubmit2" onclick="EC$(\'#dCouponDetail\').remove();">' + '<span>' + __('닫기') + '</span> </a>' +
                                           '</p>');
            } catch (err) {
                EC$('#dCouponDetail').html('<h4><strong>' + __('쿠폰정보') + '</strong></h4>' +
                                           '<ul class="couponInfo">' +
                                           '<li>' + __('쿠폰명') + ' : ' + oCoupon.coupon_name + '</li>' +
                                           '<li>' + __('적용상품') + ' : ' + oCoupon.coupon_product_info + '</li>' +
                                           '<li>' + __('사용조건') + ' : ' + oCoupon.coupon_usecon + ' ' + oCoupon.region_delivery_msg + ' ' + oCoupon.foreign_delivery_msg + '</li>' +
                                           '<li>' + __('발행수량') + ' : ' + oCoupon.coupon_issue + '</li>' +
                                           '<li>' + __('사용기간') + ' : ' + oCoupon.coupon_period_detail + '</li>' +
                                           '</ul>' +
                                           '<p class="mButton">' +
                                           '<a href="' + oCoupon.coupon_issue_url + '" class="tSubmit1">' + '<span>' + __('다운받기') + '</span></a>' +
                                           '<a href="#none" class="tSubmit2" onclick="EC$(\'#dCouponDetail\').remove();">' + '<span>' + __('닫기') + '</span> </a>' +
                                           '</p>');
            }
            //EC$('#dCouponDetail').offset({top:aPos.top,left:aPos.left-10});
            var iLeft = '-' + EC$('#dCouponDetail').width() / 2 + 'px', iTop = '-' + EC$('#dCouponDetail').height() / 2 + 'px';
            EC$('#dCouponDetail').css({top: '50%', left: '50%', position: 'fixed', marginTop: iTop, marginLeft: iLeft});
        } else {
            try {
                EC$('#dCouponDetail').html('<h3 class="title">' + __('쿠폰정보') + '</h3>' +
                                           '<a href="#none" onclick="EC$(\'#dCouponDetail\').remove();">' +
                                           '<img src="//img.cafe24.com/images/ec_hosting/front/btn_close_003.gif" />' +
                                           '</a>' +
                                           '<div class="content">' +
                                           '<ul>' +
                                           '<li><span>' + __('쿠폰명') + ' :</span> ' + decodeURIComponent(oCoupon.coupon_name) + '</li>' +
                                           '<li><span>' + __('적용상품') + ' :</span> ' + decodeURIComponent(oCoupon.coupon_product_info) + '</li>' +
                                           '<li><span>' + __('사용조건') + ' :</span> ' + decodeURIComponent(oCoupon.coupon_usecon) + ' ' + decodeURIComponent(oCoupon.region_delivery_msg) + ' ' + decodeURIComponent(oCoupon.foreign_delivery_msg) + '</li>' +
                                           '<li><span>' + __('발행수량') + ' :</span> ' + decodeURIComponent(oCoupon.coupon_issue) + '</li>' +
                                           '<li><span>' + __('사용기간') + ' :</span> ' + decodeURIComponent(oCoupon.coupon_period_detail) + '</li>' +
                                           '</ul>' +
                                           '<a href="' + oCoupon.coupon_issue_url + '&is_popup=' + '&opener_url=' + document.URL + '">' +
                                           '<img src="//img.echosting.cafe24.com/skin/admin_' + SHOP.getLanguage() + '/product/btn_coupon_download.gif" />' +
                                           '</a>' +
                                           '</div>');
            } catch (err) {
                EC$('#dCouponDetail').html('<h3 class="title">' + __('쿠폰정보') + '</h3>' +
                                           '<a href="#none" onclick="EC$(\'#dCouponDetail\').remove();">' +
                                           '<img src="//img.cafe24.com/images/ec_hosting/front/btn_close_003.gif" />' +
                                           '</a>' +
                                           '<div class="content">' +
                                           '<ul>' +
                                           '<li><span>' + __('쿠폰명') + ' :</span> ' + oCoupon.coupon_name + '</li>' +
                                           '<li><span>' + __('적용상품') + ' :</span> ' + oCoupon.coupon_product_info + '</li>' +
                                           '<li><span>' + __('사용조건') + ' :</span> ' + oCoupon.coupon_useco + ' ' + oCoupon.region_delivery_msg + ' ' + oCoupon.foreign_delivery_msg + '</li>' +
                                           '<li><span>' + __('발행수량') + ' :</span> ' + oCoupon.coupon_issue + '</li>' +
                                           '<li><span>' + __('사용기간') + ' :</span> ' + oCoupon.coupon_period_detail + '</li>' +
                                           '</ul>' +
                                           '<a href="' + oCoupon.coupon_issue_url + '&is_popup=' + '&opener_url=' + document.URL + '">' +
                                           '<img src="//img.echosting.cafe24.com/skin/admin_' + SHOP.getLanguage() + '/product/btn_coupon_download.gif" />' +
                                           '</a>' +
                                           '</div>');
            }

            EC$('#dCouponDetail').offset({top: aPos.top+20,left: aPos.left+30});
        }
    },
    useCoupon: function()
    {
        if (COUPON.is_coupon_use_submit === true) {
            setTimeout(alert(__('USE.TRY.IN.FEW.MINUTES', 'NEWCOUPON.FRONT.COUPON.JS')), 3000);
            location.reload();
            return;
        }
        var cnt = 0;
        for (var i=0; i<document.frmCouponlist.length; i++) {
            if ((document.frmCouponlist.elements[i].type == "checkbox") && (document.frmCouponlist.elements[i].name == "coupon_code[]")) {
                if (document.frmCouponlist.elements[i].checked == true)
                    cnt = cnt + 1;
            }
        }
        if (cnt < 1) {
            alert(__("선택된 쿠폰이 없습니다."));
            return false;
        }
        COUPON.is_coupon_use_submit = true;
        document.frmCouponlist.action = '/exec/front/Coupon/Mileage/';
        document.frmCouponlist.submit();
    },
    //쿠폰발급결과 출력
    getDownCouponResultForm: function(data)
    {	
        //var total = Object.keys(aCouponInfo).length;
        var total = data['total_list'];
        var fullAlert = '';
        var downChk = false;
        var allowChk = true;
        //var returnUrlChk = '';
        var sContent = "<ul>";
        if (typeof(data.message) === 'object') {
            EC$.each(data.message, function(key, val) {
                var couponName = val.split(']')[0] + '] ';
                if(val.indexOf('초과') > -1){
                    downChk = true;
                    fullAlert = fullAlert + couponName + couponDown_failAlert2 + '\n';
                }else if(val.indexOf('불가능') > -1){
                    allowChk = false;
                    fullAlert = fullAlert + couponName + couponDown_failAlert1 + '\n';
                }else if(val.indexOf('로그인 후 이용하실 수 있습니다') > -1){
                    fullAlert = fullAlert + couponName + couponDown_failAlert3 + '\n';
                    returnUrlChk = data.replace_url;
                }else if(val.indexOf('발급 되었습니다') > -1){
                    //fullAlert = fullAlert + couponName + couponDown_successAlert + '\n';
                }
                sContent += '<li>'+val+'</li>';
            });
        } else {
            var couponName = '';
            if(data.message.indexOf(']') > -1){
                couponName = data.message.split(']')[0] + '] ';
            }
            if(data.message.indexOf('초과') > -1){
                downChk = true;
                fullAlert = fullAlert + couponName + couponDown_failAlert2 + '\n';
            }else if(data.message.indexOf('불가능') > -1){
                allowChk = false;
                fullAlert = fullAlert + couponName + couponDown_failAlert1 + '\n';
            }else if(data.message.indexOf('로그인 후 이용하실 수 있습니다') > -1){
                fullAlert = fullAlert + couponName + couponDown_failAlert3 + '\n';
                returnUrlChk = data.replace_url;
            }else if(data.message.indexOf('발급 되었습니다') > -1){
                //fullAlert = fullAlert + couponName + couponDown_successAlert + '\n';
            }
            sContent = '<li>'+data.message+'</li>';
        }
        sContent += '</ul>';
        var iSuccessCnt = 0;
        
        if (typeof(data['issue_list']) !== 'undefined') {
            iSuccessCnt = data['issue_list'].length;
        }
        var aData = {
            'total': total,
            'success_cnt': iSuccessCnt,
            'content': sContent
        };
		
        EC$.get(sCouponDownResultUrl, aData, function(formData) {
            formData = formData.replace(/\{\$total\}/, parseInt(total))
                .replace(/\{\$success_cnt\}/, parseInt(iSuccessCnt))
                .replace(/\{\$fail_cnt\}/, parseInt(total - iSuccessCnt))
                .replace(/\{\$content\}/, sContent);
            
            
            if(customMessageChk){
                if(aData.success_cnt > 0){
                    alert(customMessageSuccess);
                }else{
                    if(returnUrlChk != ''){
                        //alert(fullAlert);
                        alert(couponDown_failAlert3);
                        returnUrlChk = decodeURIComponent(returnUrlChk);
                        returnUrlChk = '/member/login.html?returnUrl='+windowPathName+'?coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                        var couponzone_moveback = {scrollTop: goScrollTop, customChk: customMessageChk, customSuccess: customMessageSuccess, customFail: customMessageFail};
                        couponzone_moveback = JSON.stringify(couponzone_moveback);
                        sessionStorage.setItem('couponzone_moveback', couponzone_moveback);
                        setTimeout(function(){
                            window.location.href = returnUrlChk;
                        },200);
                    }else{
                        //alert(fullAlert);
                        if(allowChk == false){
                            alert(couponDown_failAlert1);
                            return false;
                        }
                        if(downChk){
                            alert(customMessageFail);
                        }
                    }
                }
                
                // 여기서부터가 coupon_download_all 클릭 했을때
            }else{
                if(aData.success_cnt > 0){
                    //발급 성공
                    var couponDown_successAlert = aData.success_cnt + '개의 쿠폰이 발급되었습니다.';
                    setTimeout(function(){
                    	alert(couponDown_successAlert);
                        if(isLogin){
                        	if(isLoginOpenerUrl){
                                window.location.href = IV_LOCATION_PROTOCOL + "//" + IV_LOCATION_HOSTNAME + isLoginOpenerUrl;;
                            }
                        }
                    }, 300);
                }else{
                    //발급 실패
                    if(returnUrlChk != ''){
                        //alert(fullAlert);
                        alert(couponDown_failAlert3);
                        returnUrlChk = decodeURIComponent(returnUrlChk);
                        var couponReturnUrl = '';
                        if(downloadCouponHref.indexOf('opener_url=') > -1){
                            var openerUrl = downloadCouponHref.split('opener_url=')[1];
                            if(openerUrl.indexOf('?') > -1){
                            	couponReturnUrl = openerUrl + '&coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                            }else{
                            	couponReturnUrl = openerUrl + '?' + 'coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                            }
                        }else{
                            if(isMemberPage){
                            	couponReturnUrl = '/index.html?coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                            }else{
                                if(IV_LOCATION_PARAMETERS){
                                    couponReturnUrl = IV_LOCATION_PATHNAME + '?' + IV_LOCATION_PARAMETERS + '&coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                                }else{
                                    couponReturnUrl = IV_LOCATION_PATHNAME + '?coupon_param=/exec/' + returnUrlChk.split('/exec/')[1];
                                }
                            }
                        }
                        returnUrlChk = '/member/login.html?returnUrl='+couponReturnUrl;
                        
                        var couponzone_moveback = {scrollTop: goScrollTop, customChk: customMessageChk, customSuccess: customMessageSuccess, customFail: customMessageFail, ivCouponReturnUrl: couponReturnUrl};
                        couponzone_moveback = JSON.stringify(couponzone_moveback);
                        sessionStorage.setItem('couponzone_moveback', couponzone_moveback);
                        setTimeout(function(){
                            window.location.href = returnUrlChk;
                        },200);
                        //};
                    }else{
                        //alert(fullAlert);
                        if(allowChk == false){
                            alert(couponDown_failAlert1);
                            return false;
                        }
                        if(downChk){
                            alert(couponDown_failAlert2);
                        }
                    }
                }
            }
        });
    }
};

//쿠폰 세팅 -------------------------------------------------------------------------------------------------------------------------------------------

var couponDown_failAlert1 = '쿠폰 발급이 불가능합니다.'; //다운로드 불가 조건 시 노출될 텍스트 ex 운영자
var couponDown_failAlert2 = '쿠폰이 이미 발급되었습니다. 마이페이지에서 확인해주세요.'; //이미 다운로드 받은 경우 노출될 텍스트 ex 동일인 재발급 수량 초과
var couponDown_failAlert3 = '로그인 후 이용하실 수 있습니다.'; //비회원일 경우 노출될 텍스트


function removeStorage(){
    sessionStorage.removeItem("currentLink");
    sessionStorage.removeItem("couponReturnLink");
}


//쿠폰 세팅 -------------------------------------------------------------------------------------------------------------------------------------------
function UsePlusAppBridge() {
    EC_PlusAppBridge.setBridgeFunction();
}
UsePlusAppBridge();
/* ================================================================================================================================================================================*/

/* 안다르__특정카테고리_쿠폰다운로드_버튼_요청 */

/*================================================================================================================================================================================== */

/* ↓↓↓↓↓ 건드리지 마세요!!! ---------------------------------------------------------------------- */

var this_Url = window.location.href; // 현재 URL 값 구하기
var cate_Url = getCateParam("cate_no", this_Url); // cate_no= 뒷부분만 구하기

/* ↑↑↑↑↑ 건드리지 마세요!! ---------------------------------------------------------------------- */

/* ================================================================================================================================================================================*/

/* 2022-04-14 GNB 카테고리 개편 작업 */

/*================================================================================================================================================================================== */

var find_leggings_link = "/product/list.html?cate_no=2030"; // 내게 맞는 레깅스 찾기 - 연결할 링크 입력
var find_sports_link = "/product/list.html?cate_no=2036"; // 내게 맞는 조거팬츠 찾기 - 연결할 링크 입력

var find_leggings_visible = "off"; // "내게 맞는 레깅스 찾기" 카드 노출 여부 - on, off 로 구분
var find_sports_visible = "off"; // "내게 맞는 조거팬츠 찾기" 카드 노출 여부 - on, off 로 구분

// 레깅스 가이드 - 노출시키고 싶은 카테고리 넘버 양식과 동일하게 입력
var leggings_guide = [""]; // 일상/요가 -> 맨즈-슬랙스로 변경 20221104
var leggings_guide02 = [""]; // 요가/필라테스/피트니스
var leggings_guide03 = [""]; // 피트니스/고강도
var leggings_guide04 = [""]; // 조거팬츠
var leggings_guide05 = [""]; // 우먼즈 > 레깅스 카테고리

// 컬러 변경할 카테고리 표시
var point_color_cate = ["2135"]; // 컬러 변경할 카테고리 넘버 입력

// 브래드크럼 제거
var no_breadcrumb = [""]; // 제거할 카테고리 넘버 입력, 여러개 입력시 쉼표로 구분

// 카테고리 썸네일 영역
var thumbnailCate = [
  {
    // 여성 - 1depth 카테고리 썸네일 영역
    cateNum: ["2030"],
    bannerID: "depth2_img",
  },
  {
    // 운동별추천 - 2depth 카테고리 썸네일 영역
    cateNum: ["2043"],
    bannerID: "depth3_img",
  },
  {
    // 남성 카테고리 썸네일 영역
    cateNum: ["2084"],
    bannerID: "man_img",
  },
  {
    // 신상 카테고리 썸네일 영역
    cateNum: ["2027"],
    bannerID: "new-img",
  },
  {
    // 핫섬머 카테고리 썸네일 영역
    cateNum: ["3119"],
    bannerID: "summer_img",
  },
];

// 사이드바 2뎁스 노출 카테고리 설정
var openCate = 3119;

// #227 [공통] 가이드 영역 추가 문의

// 순서 딱지 적용할 카테고리 넘버를 기입해주세요
var listBadgeArr = ["2017", "2018", "2022", "2026", "2019", "2020", "2021", "2023", "2024", "2025", "2084", "2088", "2093", "2578", "3512", "3514"];

/* #267 - 카테고리 페이지 영역 추가 240507 */
// 카테고리 영상 배너 미노출 카테고리 지정
var IVHideCateBanner = [
  "2031",
  "2042",
  "2912",
  "2462",
  "2036",
  "2066",
  "2200",
  "2484",
  "2582",
  "2581",
  "2583",
  "2067",
  "2481",
  "2482",
  "2911",
  "2069",
  "2071",
  "2072",
  "2533",
  "2512",
  "2604",
  "2090",
  "2089",
  "2553",
  "2091",
  "2094",
  "2541",
  "2556",
  "2584",
  "2585",
  "2557",
  "2542",
  "2630",
  "2629",
  "2628",
  "2627",
  "2777",
  "3020",
  "2073",
  "2074",
  "2075",
  "2850",
  "2534",
  "2535",
  "2536",
  "2077",
  "2830",
  "2831",
  "2832",
  "2833",
  "2638",
  "2675",
  "2834",
  "2677",
  "2107",
  "2403",
  "2108",
  "2109",
  "2393",
  "2110",
  "2777",
  "2782",
  "2656",
  "2293",
  "2111",
  "2112",
  "2113",
  "2114",
  "2115",
  "2116",
  "2944",
  "2945",
  "2946",
  "2950",
  "2953",
  "2956",
  "2959",
  "2947",
  "2948",
  "2949",
  "2951",
  "2952",
  "2954",
  "2955",
  "2957",
  "2958",
  "2960",
  "2983",
  "2941",
  "2818",
  "2888",
  "2973",
  "2889",
  "2977",
  "2974",
  "2887",
  "2896",
  "2531",
  "2610",
  "3026",
  "3027",
  "3028",
  "3029",
  "2594",
  "2595",
  "2596",
  "2597",
  "2598",
  "2599",
  "2600",
  "2986",
  "2993",
  "2984",
  "2999",
  "3000",
  "3001",
  "2272",
  "2273",
  "2274",
  "2275",
  "3006",
  "3007",
  "3012",
  "3015",
  "2867",
  "3018",
  "3019",
  "2784",
  "2785",
  "2786",
  "2788",
  "3021",
  "3013",
  "3014",
  "2650",
  "2068",
  "2070",
  "2076",
  "2078",
  "2480",
  "2180",
  "2182",
  "2829",
  "2468",
  "2469",
  "2470",
  "2511",
  "2524",
  "2661",
  "2037",
  "2038",
  "2039",
  "2040",
  "2119",
  "2120",
  "2121",
  "2081",
  "2082",
  "2083",
  "2085",
  "2086",
  "2087",
  "2835",
  "2836",
  "2837",
  "2982",
  "2527",
  "2543",
  "2575",
  "2544",
  "2572",
  "2574",
  "2573",
  "2100",
  "2101",
  "2103",
  "2105",
  "2104",
  "2102",
  "2043",
  "2530",
  "2838",
  "2839",
  "2840",
  "2044",
  "2852",
  "2841",
  "2054",
  "2842",
  "2049",
  "2843",
  "2844",
  "2845",
  "2846",
  "2847",
];

// 카테고리 타이틀 미노출 카테고리 지정
var IvHideCateTitle = ["2030", "2084", "2944", "2945", "2946", "2950", "2953", "2956", "2959"];

// 주문서 작성 페이지 디폴트 결제수단 설정 변수

var DEFAULT_PAY_METHOD = "card";
// 디폴트 변경 예시
// var DEFAULT_PAY_METHOD = "kakaopay";

/* 디폴트 결제수단 변경시 원하는 결제수단 복사하여 위 예시와 같이 입력해주세요
 * 무통장: icash
 * 카드: card
 * 카카오페이: kakaopay
 * 네이버페이: naverpay
 * 핸드폰: cell
 * 토스: toss
 * 페이코: payco
 */

// 모바일 레이어 팝업 노출 페이지 설정
var LAYERPOPUP_SHOW = {
  page: "main",
  array: [],
};

/* 노출 원하는 페이지 복사하여 입력
 * 모든 페이지: all
 * 메인: main
 * 상품분류: list
 * 상품상세: detail
 * 기타: etc
 */

$(window).load(function(){
    
    var Main_length = $("#main").length; // 메인페이지 구분용
    
    var memberLogOn = $("#memberLogOn").length; // 로그인 여부, 카카오인지도 확인 필요
	var mySession; // 세션스토리지 member_1 전체값 구하기
    var complete_Coupon; // 쿠폰 전체 발급이후 alert 노출을 위한 전역변수 선언.
    
    var my_User_Id; // 아이디값 구하기 ( $("#sf_user_name") 텍스트값 못불러오는 현상 있어 전역변수 설정이후 JSON으로 데이터 추출 )
    var my_Group_Id; // 그룹네임값 구하기 ( $("#sf_Group_name") 텍스트값 못불러오는 현상 있어 전역변수 설정이후 JSON으로 데이터 추출 )
    var my_Member_Id; // 네임값 구하기 ( $("#sf_member_name") 텍스트값 못불러오는 현상 있어 전역변수 설정이후 JSON으로 데이터 추출 )
    
    var result_Date; // 회원가입일 = created_date; // 전역변수 사용위해 따로 빼놓음.
    var current_Date; // 현재 yyyymmdd; //전역변수 사용위해 따로 빼놓음.
    
    
    function add_Coupon(){
        if ( memberLogOn > 0 ){
            if ( mySession == undefined ){
                 mySession = CAPP_ASYNC_METHODS.member;
                setTimeout(add_Coupon, 500);
            }
            else if ( mySession != undefined ){
                
                my_User_Id = mySession.__sMemberId; // user_id 추출 - ex) ivtest30
                my_Group_Id = mySession.__sGroupName; // group_id 추출 - ex) 일반회원
                my_Member_Id = mySession.__sName; // member_id 추출 - ex) 테스트30
                
                var kakao_id = my_User_Id.indexOf("@k"); // 아이디에 ivtest가 들어가는지 확인 (임시) = 카카오계정 (@k)가 들어가는지 확인
                
                // ※※※※※※※※※※※※※※※※※※※※※※※ 계정생성일, 현재날짜 구하기 ※※※※※※※※※※※※※※※※※※※※※※※
                
                var created_data = mySession.__sCreatedDate; // 계정생성일만 추출
                var date_indexOf = created_data.indexOf(" "); // 공백부분 기준잡기 ( 가입시간, 분, 초는 상관없기에. )
                var slice_Date = created_data.slice("0", date_indexOf); // 공백부분 기준으로 앞부분 추출 ( yyyy-mm-dd )
                
                result_Date = Number(slice_Date.replace(/[-]/g, "")); // "-" 제외한 숫자만 남기기, 회원가입일 = created_date;
                

                // 현재 날짜 구하기
                var date = new Date(); // 날짜 추출
                var current_year = date.getFullYear().toString(); // 년도 구하기

                var current_month = date.getMonth() + 1; // 월 구하기, 10보다 낮을경우 앞에 0 붙이기, 아닐경우 그냥 리턴
                current_month = current_month < 10 ? '0' + current_month.toString() : current_month.toString();

                var current_day = date.getDate(); // 일 구하기, 10보다 낮을경우 앞에 0 붙이기, 아닐경우 그냥 리턴
                current_day = current_day < 10 ? '0' + current_day.toString() : current_day.toString();

                current_Date = Number(current_year+current_month+current_day); // 현재 yyyymmdd;
                var current_Date_prev = Number(current_year+current_month+(current_day-1)); // 이전날자 구하기
                
                var date_indexOf2 = created_data.indexOf("."); // 가입일자 초 소수점 단위 기준잡기
                var slice_Date2 = created_data.slice("0", date_indexOf2); // 소수점 까지 제거
                var split_Date = slice_Date2.split(" ")[1]; // 공백 기준 뒷부분만 남기기(시, 분, 초 만 남기기)
                var replace_Date = Number(split_Date.replace(/:/g,"")); // 시, 분, 초의 " : " 내용 제거
                
                // ※※※※※※※※※※※※※※※※※※※※※※※ 계정생성일, 현재날짜 구하기 ※※※※※※※※※※※※※※※※※※※※※※※
                
            }
            else { setTimeout(add_Coupon, 500); }
        }
        
        
        if( kakao_id > -1 && result_Date == current_Date ) {
        	make_Coupon();  // make_Coupon 실행 ↓
        }
        else if ( kakao_id > -1 && replace_Date > 235000 && current_Date_prev == result_Date ) {
        	make_Coupon();  // make_Coupon 실행 ↓
        }
    }
    var isJoinKakao = sessionStorage.getItem('isJoinKakao');
    if(!!isJoinKakao) {        
        add_Coupon(); // 쿠폰발급 함수 실행.
    }
    
    function make_Coupon(){
        var couponNumber = $('.kakao_join_coupon div').attr('data-kakao-coupon');        
        if( couponNumber.indexOf(',') > -1 ){
             //복수쿠폰
            couponNumber = couponNumber.split(',');
        } else {
            //단일쿠폰
            couponNumber = Array(couponNumber);
        };
        
    	var get_Coupon_leng = couponNumber.length; // 쿠폰 개수
        var complete_Num = 0; // 쿠폰 정상적으로 돌았다면 alert 띄우기
        var fail_coupon = false; // 중복일경우 값 변경을 위한 변수
        var title_Array = []; // 쿠폰명 저장을 위한 배열 생성
            
        
        for (var i = 0; i < get_Coupon_leng; i++){
            var coupon_link = "/exec/front/newcoupon/IssueDownload?coupon_no="+couponNumber[i]; // 쿠폰 뿌려주기 위한 넘버값
            $.ajax({
                url: "/exec/front/newcoupon/IssueDownload?coupon_no="+couponNumber[i],
                type: 'GET',
                dataType: 'html',
                async: false,
                success: function (html) {
                    var dup_Coupon_text = $(html).text().trim(); // 쿠폰 발급 페이지 내 텍스트 추출
                    var dup_Coupon = dup_Coupon_text.indexOf("재발급"); // "재발급" 글자가 있는지 확인
                    var none_Coupon = dup_Coupon_text.indexOf("불가능"); // "불가능" 글자가 있는지 확인
                    var gm_Coupon = dup_Coupon_text.indexOf("운영자"); // "운영자" 글자가 있는지 확인
                    var full_Coupon = dup_Coupon_text.indexOf("초과"); // "초과" 글자가 있는지 확인
                    var login_Coupon = dup_Coupon_text.indexOf("로그인");
                    
                    var replace_dup = dup_Coupon_text.split("\\n").join("<br/>"); // 개행문자 <br/>로 치환하기
                    var title_01 = replace_dup.indexOf("<br/>"); // 첫번째 <br/> 체크 = 쿠폰명 이후에 바로 나오는 <br/>
                    var title_02 = replace_dup.indexOf("["); // alert 텍스트 제거 위한 구분값
                    
                    var title_slice = dup_Coupon_text.slice(0, title_01); // 타이틀 부분만 남기기
                    var title_result = title_slice.slice(title_02, -1); // 앞의 alert 부분 제거하기
 					
                    // 재발급이거나, 쿠폰이 없거나(발급기한 지난경우, 발급불가인 경우), 운영자이거나, 쿠폰개수를 초과했을 경우
                    if ( dup_Coupon > -1 || none_Coupon > -1 || gm_Coupon > -1 || full_Coupon > -1 ){
                        fail_coupon = true;
                        //return false;
                    } else {
                        complete_Num = complete_Num + 1;
                        title_Array.push(title_result+" 가 발급되었습니다.\n"); // 단일 쿠폰 발급 성공 알럿 메세지
                    }
                    sessionStorage.removeItem('isJoinKakao');
                }, // success
            }); // ajax
        } // 반복문
        
        if(complete_Num == 0 && fail_coupon) { // 발급된 쿠폰이 없을때
            removeStorage();
        } else if(complete_Num > 0) { // 발급된 쿠폰이 있음
            if(get_Coupon_leng > 1) { // 복수 쿠폰
                removeStorage();
                alert( '카카오 가입 쿠폰 : '+ complete_Num + '개의 쿠폰이 발급되었습니다.');
            } else if(get_Coupon_leng == 1) { // 단일 쿠폰
                removeStorage();
                alert(title_Array.join(""));
            }
        }
        
    } // make_Coupon ↑위에서 실행   

    // kakao싱크 회원가입 분기 처리 위한 변수
	var Kakao_length = $("#resultKakao").length;
    
    if( Kakao_length > 0 ){
        
         function my_mem_Id(){
        	if( my_Member_Id == undefined ){
            	setTimeout(my_mem_Id, 500);
            }
            else {
            	$(".kakao_name").text(my_Member_Id); // 이름값에 "member_1"에서 추출한 name값 넣기
            }
        }
        my_mem_Id();
        
        // 메인페이지에서 쿠폰 발급을 받았다면 alert띄운 후 막기.
        // 메인에서 쿠폰 유,무를 가리기 때문에 더이상 뜰일 없음..?
        var get_Complete_Coupon = sessionStorage.getItem("complete_Coupon");
        
        
        var $thisUrl = window.location.href; // 현재 Url 값 저장 = 의미없음.
            
    } // if(Kakao_length > 0)
}); // $(document).ready();

function removeStorage(){
    sessionStorage.removeItem("currentLink");
    sessionStorage.removeItem("couponReturnLink");
}

$(document).ready(function () {
  // 사이드 메뉴(햄버거 메뉴) 생성
  getCateData();

  // 전체메뉴 1뎁스 클릭시 슬라이드 다운
  EC$(document).on("click", ".gnb_list_wrapper .gnb_1li, .board_area .gnb_1li", function (e) {
    $(this).toggleClass("on");
    $(this).find(".gnb_2ul").addClass("on");

    if ($(this).hasClass("on")) {
      $(this).find(".gnb_2ul").slideDown();
    } else {
      $(this).find(".gnb_2ul").slideUp();
    }
  });

  /* ================================================================================================================================================================================*/

  /* 2022-02 가이드 배너 */

  /*================================================================================================================================================================================== */

  // #227 [공통] 가이드 영역 추가 문의

  $(".step_banner").each(function () {
    var guide_cont_length = $(this).find(".guide_cont_new").length;
    if (guide_cont_length >= 1) {
      $(this).removeClass("displaynone");
      /* 가이드 영역 */
      // 가이드 스와이프 실행
      var guide_cont_new = new Swiper($(this).find(".guide_cont_new"), {
        slidesPerView: 2.3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
        slidesOffsetAfter: 25,
        //observer: true,
        //observeParents: true,
        //touchEventsTarget: 'wrapper',
      });
    }
  });

  /* GNB 카테고리 */
  function accordion() {
    var li_heght = $(".gnb_1li.on").find(".gnb_2ul").find("li").height();
    var li_length = $(".gnb_1li.on").find(".gnb_2ul").find("li").length;

    $(".gnb_1li.on").find(".gnb_2ul").addClass("on");
    $(".gnb_1li.on")
      .find(".gnb_2ul.on")
      .height(li_heght * li_length);
  }

  EC$(document).on("click", ".gnb_1li > a", function (e) {
    var $this = $(this);

    if ($this.next("ul").length > 0) {
      var li_heght = $this.next("ul").find("li").height();
      var li_length = $this.next("ul").find("li").length;

      if ($this.next("ul").hasClass("on") == false) {
        $("ul.gnb_2ul").height(0);
        $("ul.gnb_2ul").removeClass("on");
        $this.next("ul").addClass("on");
        $this.next("ul.on").height(li_heght * li_length);
      } else {
        $("ul.gnb_2ul").height(0);
        $("ul.gnb_2ul").removeClass("on");
      }
    }
  });

  // 모바일 탑메뉴 쉐이드 관련 수정
  // 메뉴 넘어갈시에만 쉐이드 노출
  // 스와이프_탑메뉴가 있을시
  if ($(".swiper_topmenu.common_topmenu").length > 0) {
    var top_menu = document.querySelector(".top_menu .menu"); // 탑메뉴 지정
    var menu_scr = top_menu.scrollWidth; // 탑메뉴의 스크롤 width값 구하기
    var last_scr = menu_scr - $(".top_menu .menu").width() - 15; // 스크롤 width - 전체 넓이 - 15 (패딩값)
    var menu_width = $(".top_menu .menu").width() + 15; // 전체 넓이 + 15 (패딩값)

    // 스크롤넓이와 메뉴전체 넓이가 같다면,
    if (menu_scr == menu_width) {
      $("#header .common_topmenu .top_menu").addClass("last_scr");
    } else {
      $("#header .common_topmenu .top_menu").removeClass("last_scr");
    }

    // 탑메뉴 스크롤시
    $(".top_menu .menu").scroll(function () {
      var my_scr = $(this).scrollLeft(); // 현재 스크롤값 구하기

      // 현재 스크롤값과 마지막 스크롤값이 같다면, 스크롤이 끝이라면.
      if (last_scr == my_scr) {
        $("#header .common_topmenu .top_menu").addClass("last_scr");
      } else {
        $("#header .common_topmenu .top_menu").removeClass("last_scr");
      }
    });
  }

  /* 메인페이지 분기처리 */
  var _main = $("#main").length;

  if (_main > 0) {
    $("#header").addClass("main_header");
  }
}); // $(document).ready

// 카테고리앱 데이터 가져오기
function openCategory(cateNum) {
  console.log("cateNum", cateNum);
  let cateMenu = $(`.gnb_1li[data-cate=${cateNum}]`);
  cateMenu.addClass("underLine");
  cateMenu.addClass("on");
  cateMenu.find(".gnb_2ul").addClass("on").show();
}

function getCateData() {
  $.ajax({
    // 테섭
    // url: "https://andarcate.innerviewit.co.kr/api/list",
    url: "https://andarcate.co.kr/api/list",
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      var data = JSON.parse(data);

      data.forEach(function (cate, index) {
        createMenu(cate);
      });

      openCategory(3432);
    },
    complete: function (data) {
      // 사이드바 열었을때 2뎁스 노출되는 카테고리
      EC$('#aside .gnb_list_wrapper .submenu[data-cate = "' + openCate + '"]')
        .trigger("click")
        .addClass("openCate");
    }, // complete
  });
}

// 카테고리 Li 생성
function writeCateLi(liClass, number, type, title, newHref, useMarker, titleColor) {
  // 강조점 표시
  var markerClass = "";
  // 카테고리 컬러
  var titleColorStyle = "inherit";

  // 강조점 표시할 경우 chk 클래스 추가
  if (useMarker) markerClass = "chk";
  // 타이틀 컬러값 있을 경우 타이틀 컬러 변경
  if (!!titleColor) titleColorStyle = titleColor;

  // 링크 주소
  var href;
  if (!!newHref) {
    // 새 주소값 있으면 그걸로 대체
    href = newHref;
  } else {
    // 없으면 data-type 별로 링크 생성
    switch (type) {
      case "category":
        href = "/product/list.html?cate_no=" + number;
        break;
      case "board":
        href = "/board/product/list2.html?board_no=" + number;
        break;
      case "gallery":
        href = "/board/gallery/list2.html?board_no=" + number;
        break;
    }
  }
  return '<li class="' + liClass + '" data-cate="' + number + '" data-type="' + type + '"><a href="' + href + '" class="' + markerClass + '" style="color:' + titleColorStyle + '"><span>' + title + "</span></a></li>";
}

// 하위 카테고리 메뉴 생성
function creatSubCate(appendLi, cateAttr) {
  var ADDCATECOMPLETE = false; // 반복문 실행 완료 여부
  var SUBCATECOUNT = 0; // 반복문 실행 횟수 카운트

  var cateUseAll = cateAttr.useAll; // 전체 메뉴 사용 여부
  var subCateHTML = cateAttr.SubCateWrapper; // 하위 카테고리 wrapper html

  if (cateUseAll) {
    // 상위 카테고리가 '전체'로 하위 카테고리와 함께 표시됨
    subCateHTML += writeCateLi(cateAttr.liClass, cateAttr.cateNumber, cateAttr.cateType, "전체", cateAttr.cateLink);
  }

  // api => 하위 카테고리 배열이 없거나, 배열 안에 요소가 없는 경우 아래 코드 실행 안함
  if (!cateAttr.subArray || cateAttr.subArray.length == 0) return;

  cateAttr.subArray.forEach(function (category, index) {
    var subCateNumber = category.id;
    var subCateType = category.type;
    var subCateTitle = category.title;
    var subCateLink = category.link;

    // new_title 값 있을 경우 대체
    if (!!category.new_title) subCateTitle = category.new_title;

    subCateHTML += writeCateLi(cateAttr.liClass, subCateNumber, subCateType, subCateTitle, subCateLink);
    SUBCATECOUNT++;
  });

  appendSubCate();

  function appendSubCate() {
    // 반복문 실행 횟수 = 하위 카테고리 개수인 경우
    if (SUBCATECOUNT == cateAttr.subArray.length) {
      subCateHTML += "</ul>";
      appendLi.append(subCateHTML);
    } else {
      setTimeout(appendSubCate, 200);
    }
  }
}

// 햄버거 메뉴(전체 메뉴)
function createMenu(cate) {
  var cateNumber = cate.id;
  var cateTitle = cate.title;
  var cateType = cate.type;
  var cateLink = cate.link;
  var useMarker = cate.use_marker;
  var titleColor = cate.title_color;
  var subCateArray = cate.sub;

  // new_title 값 있으면 title 값 대체
  if (!!cate.new_title) cateTitle = cate.new_title;

  var cateLi = writeCateLi("gnb_1li", cateNumber, cateType, cateTitle, cateLink, useMarker, titleColor);
  $(".gnb_list_wrapper .gnb_1ul").append(cateLi);

  // 하위 카테고리 있으면
  if (!!subCateArray && subCateArray.length > 0) {
    // 하위 카테고리 있는 1뎁스 카테고리에 submenu 클래스 추가
    $('.gnb_list_wrapper .gnb_1ul .gnb_1li[data-cate="' + cateNumber + '"]').addClass("submenu");

    // 하위 카테고리 생성
    creatSubCate($('.gnb_list_wrapper .gnb_1ul .gnb_1li[data-cate="' + cateNumber + '"]'), {
      useAll: cate.use_all,
      SubCateWrapper: '<div class="down_btn"></div><ul class="gnb_2ul">',
      liClass: "gnb_2li",
      cateNumber: cateNumber,
      cateType: cateType,
      cateLink: cateLink,
      subArray: subCateArray,
    }); // creatSubCate
  } // subCateArray.length
}

/* 사이드메뉴 토글 */
function toggle_aside() {
	var obj_name = $('#aside');
	if(obj_name.hasClass('is_show')) {
		$('body').removeClass('notscroll');
		$('#wrap').removeClass('notscroll');
		obj_name.removeClass('is_show');
		obj_name.animate({scrollTop: '0'}, 0);
	}
	else {
		$('body').addClass('notscroll');
		$('#wrap').addClass('notscroll');
		obj_name.addClass('is_show');
		obj_name.animate({scrollTop: '0'}, 0);
	}
}
function topbnr_close(selector) {
    var selector = jQuery1_11_2(selector);
    var speed = 400;
    if (jQuery1_11_2('#topbnr .slide_topbnr').css('display') == 'block') {
        jQuery1_11_2('#topbnr .slide_topbnr').slideUp(speed);
        selector.addClass('active').animate({'top' : '0'}, speed);
    } else {
        jQuery1_11_2('#topbnr .slide_topbnr').slideDown(speed);
        selector.removeClass('active').animate({'top' : '40px'}, speed);
    }
}


$(document).ready(function(){
    // 배너 이름에 #Timer(카운트다운종료날짜 6자리로 입력) 시간은 오전 12시로 고정
    // ex> #Timer(231206) => 2023-12-06 00:00:00
    var timerBannerCheck = /(#Timer\(\d{6}\))/;

    $('#topbnr .topBnr01').each(function(){
        var dataBannerTitle = $(this).attr('data-title');
        // 배너이름에 타이머배너 있는지 확인
        if( timerBannerCheck.test(dataBannerTitle) ) {
            // 날짜 6자리만 추출
            var timerHash = dataBannerTitle.search(timerBannerCheck);
            var timerEndVal = dataBannerTitle.substr(timerHash + 7, 6);

            // 추출한 날짜에서 년/월/일 분리하여 Date 객체 형식으로 변환
            var year = timerEndVal.substr(0,2);
            var month = timerEndVal.substr(2,2);
            var date = timerEndVal.substr(4,2);
            var endTime = '20' + year + '-' + month + '-' + date + ' 00:00:00';

            // dataBannerTitle 에서 #Timer(날짜) 부분 찾아 timerSpan 으로 대체
            var timerSpan = "<span class='top_banner_timer' data-endTime='" + endTime + "'><span class='timerDay'>0일</span><span class='timerHr'>00</span>:<span class='timerMin'>00</span>:<span class='timerSec'>00</span></span>";
            dataBannerTitle = dataBannerTitle.replace(timerBannerCheck, timerSpan);
        }
        // dataBannerTitle => 배너 텍스트 넣어주기
        $(this).prepend(dataBannerTitle);

        // 아이콘 왼오 위치 구분
        if( $(this).find('.icon-right').length > 0 ){
            $(this).find('span').removeClass('displaynone');
            $(this).find('img').addClass('icon-right');
        } else if( $(this).find('.icon-left').length > 0 ){
            $(this).find('img').clone().appendTo('.icon-left');
            $('.icon-left span').removeClass('displaynone');
        }
    });
    var TopBannerSwiper = new Swiper('#topbnr', {
        spaceBetween: 0,
        centeredSlides: true,
        effect: "fade",
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        init: false,
    });
    TopBannerSwiper.on('init',function(){
        var topBnrTimer = $('#topbnr .top_banner_timer');

        if( topBnrTimer.length > 0 ) { 
            topBnrTimer.each(function(index, banner){
                var dataEndTime = $(this).attr('data-endTime');
                setInterval(function(){
                    updateTimerTopBnr($(banner), dataEndTime);	
                }, 1000);
            });
        }
    });
    TopBannerSwiper.init();

});


// 타이머 업데이트
// 
function updateTimerTopBnr(banner,endTime) { 
    var timerDay = banner.children('.timerDay');
    var timerHr = banner.children('.timerHr');
    var timerMin = banner.children('.timerMin');
    var timerSec = banner.children('.timerSec');

    var endTime = +new Date(endTime);
    var diff = endTime - (+new Date);

    if(diff <= 0 || !diff) { return; }

    var diffDate = Math.floor(diff / (1000 * 60 * 60 * 24));
    var diffHours = Math.floor(diff / (1000 * 60 * 60));
    var diffMinutes = Math.floor(diff / (1000 * 60));
    var diffSeconds = Math.floor(diff / 1000);

    var leftDate = diffDate;
    var leftHours = diffHours - diffDate * 24;
    if(String(leftHours).length < 2) { leftHours = '0' + leftHours; }
    var leftMinutes = diffMinutes - diffHours * 60;
    if(String(leftMinutes).length < 2) { leftMinutes = '0' + leftMinutes; }
    var leftSeconds = diffSeconds - diffMinutes * 60;
    if(String(leftSeconds).length < 2) { leftSeconds = '0' + leftSeconds; }

    timerDay.text(leftDate + '일');
    timerHr.text(leftHours);
    timerMin.text(leftMinutes);
    timerSec.text(leftSeconds);
}   
//var swiper_topmenu = new Swiper('.swiper_topmenu', {
//	freeMode: true,
//	slidesPerView: 'auto',
//});

$(document).ready(function(){
    $('.gnb_cate').addClass('view');
    $('.gnb_cate a').each(function(){
        var titlencolor = $(this).data('titlencolor');
        var cateTitle = titlencolor.split('#')[0];
        var cateColor = titlencolor.split('#')[1];
        $(this).prepend(cateTitle);
        $(this).css('color','#'+ cateColor);

        if( $(this).find('div').hasClass('gnb-icon') ){
            $(this).find('span').removeClass('displaynone');
        };
    });
});
$(document).ready(function(){
    if (typeof(EC_SHOP_MULTISHOP_SHIPPING) != "undefined") {
        var sShippingCountryCode4Cookie = 'shippingCountryCode';
        var bShippingCountryProc = false;

        // 배송국가 선택 설정이 사용안함이면 숨김
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === false) {
            $('.xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist').hide();
            $('.xans-layout-multishoplist .countryTitle').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptioncountry').hide();
        } else { // 배송국가 선택 설정이 사용이면 쿠키값이나 query string으로 넘어온 배송국가 값을 사용
            $('.xans-multishop-listitem').hide();
            $('.xans-layout-multishoplist > h1').hide();
            $('.xans-layout-multishoplist .languageTitle').show();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptionlanguage').show();
            $('.xans-layout-multishoplist .countryTitle').show();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptioncountry').show();

            var aShippingCountryCode = document.cookie.match('(^|;) ?'+sShippingCountryCode4Cookie+'=([^;]*)(;|$)');

            if (typeof(aShippingCountryCode) != 'undefined' && aShippingCountryCode != null && aShippingCountryCode.length > 2) {
                var sShippingCountryValue = aShippingCountryCode[2];
            }

            // query string으로 넘어 온 배송국가 값이 있다면, 그 값을 적용함
            var aHrefCountryValue = decodeURIComponent(location.href).split("/?country=");

            if (aHrefCountryValue.length == 2) {
                var sShippingCountryValue = aHrefCountryValue[1];
            }

            // 메인 페이지에서 국가선택을 안한 경우, 그 외의 페이지에서 셋팅된 값이 안 나오는 현상 처리
            if (location.href.split("/").length != 4 && $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val()) {
                $(".xans-layout-multishoplist .xans-layout-multishoplistmultioption a .ship span").text(" : "+$(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text().split("SHIPPING TO : ").join(""));
                if ($("#f_country").length > 0 && location.href.indexOf("orderform.html") > -1) {
                    $("#f_country").val($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val());
                }
            }
            if (typeof(sShippingCountryValue) != "undefined" && sShippingCountryValue != "" && sShippingCountryValue != null) {
                sShippingCountryValue = sShippingCountryValue.split("#")[0];
                var bShippingCountryProc = true;

                $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val(sShippingCountryValue);
                $(".xans-layout-multishoplist .xans-multishop-listitem .countryLink").text($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text());

                var expires = new Date();
                expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30일간 쿠키 유지
                document.cookie = sShippingCountryCode4Cookie+'=' + $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val() +';path=/'+ ';expires=' + expires.toUTCString();

                if ($("#f_country").length > 0 && location.href.indexOf("orderform.html") > -1) {
                    $("#f_country").val(sShippingCountryValue).change();;
                }
            }
        }

        // 언어선택 설정이 사용안함이면 숨김
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingLanguageSelection === false) {
            $('.xans-layout-multishopshipping .xans-layout-multishopshippinglanguagelist').hide();
            $('.xans-layout-multishoplist .languageTitle').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptionlanguage').hide();
        } else {
            $('.xans-multishop-listitem').hide();
            $('.xans-layout-multishoplist > h1').hide();
            $('.xans-layout-multishoplist .languageTitle').show();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptionlanguage').show();
            $('.xans-layout-multishoplist .countryTitle').show();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptioncountry').show();
        }

        // 배송국가 및 언어 설정이 둘 다 사용안함이면 숨김
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShipping === false) {
            $(".xans-layout-multishopshipping").hide();
            $('.xans-layout-multishoplist .countryTitle').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptioncountry').hide();
            $('.xans-layout-multishoplist .languageTitle').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioptionlanguage').hide();
        } else if (bShippingCountryProc === false && location.href.split("/").length == 4) { // 배송국가 값을 처리한 적이 없고, 메인화면일 때만 선택 레이어를 띄움
            var sShippingCountryValue = $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val();
            $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val(sShippingCountryValue);
            $(".xans-layout-multishoplist .xans-multishop-listitem .countryLink").text($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text());
            // 배송국가 선택을 사용해야 레이어를 보이게 함
            if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === true) {
                $(".xans-layout-multishopshipping").show();
            }
        }

        $(".xans-layout-multishopshipping .btnClose").bind("click", function() {
            $(".xans-layout-multishopshipping").hide();
        });

        $(".xans-layout-multishopshipping .ec-base-button a").bind("click", function() {
            var expires = new Date();
            expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30일간 쿠키 유지
            document.cookie = sShippingCountryCode4Cookie+'=' + $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val() +';path=/'+ ';expires=' + expires.toUTCString();

            // 도메인 문제로 쿠키로 배송국가 설정이 안 되는 경우를 위해 query string으로 배송국가 값을 넘김
            var sQuerySting = (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === false) ? "" : "/?country="+encodeURIComponent($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val());

            location.href = '//'+$(".xans-layout-multishopshipping .xans-layout-multishopshippinglanguagelist").val()+sQuerySting;
        });
        $(".xans-layout-multishoplist .xans-multishop-listitem .countryLink").bind("click", function(e) {
            $('#dimmedSlider').toggle();
            $('html').toggleClass('expand');
            $(".xans-layout-multishopshipping").show();
            e.preventDefault();
        });
        $(".xans-layout-multishoplist .xans-multishop-listitem .languageLink").bind("click", function(e) {
            $('#dimmedSlider').toggle();
            $('html').toggleClass('expand');
            $(".xans-layout-multishopshipping").show();
            e.preventDefault();
        });
    }
});
