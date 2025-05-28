
(function(i,s,o,g,r,a,m){
  if(i[g]){return;}
  i[g] = {};
  i[g].indexOf=function(t,a,b){for(var i=(b||0),j=t.length;i<j;i++){if(t[i]===a){return i;}}return-1;};
  function getCookieNoescape(a){var b=a+"=";var c=s.cookie;if(c.length>0){startIndex=i[g].indexOf(c,a);if(startIndex!=-1){startIndex+=a.length;endIndex=i[g].indexOf(c,";",startIndex);if(endIndex==-1)endIndex=c.length;return c.substring(startIndex+1,endIndex);}}return false;}
  function getCookie(a){var b=getCookieNoescape(a);if(b){return unescape(b);}return false;}
  

  i[g].is_manager = function(username){
    var encrypted_manager_usernames = ["thecrema","thecrema1","thecrema2","thecrema3","thecrema4","supportpublic@cre.ma","supportpubl19280","supportpubl22864","supportpubl14568","sseonaaa@naver.com","supportpubl13222","supportpublic@crema.me","supportpubl80173","qa_test001","qa_test002","qa_test003","qa_test004","qa_test005","crema1","crema2","crema_dev","supportpubl90635","thecrema@s","supportpubl16355","supportpubl10180","cremademo","supportpubl14174","supportpubl10733","test1234","crematestqa3","tester1410","crema","supportpubl32674","supportpubl23055","supportpubl24208","supportpubl21153","crematest","test02","test03@test.com","test01@test.com","MB202108020350711","MB202105030231976","MB202104010204529","MB202107200326585","MB202006020008418","MB202005210000010","supportpubl32657","development_97","supportpubl27169","product_129","crema202206","supportpubl31963","development_35","test123","supportpubl98348","supportpubl23068","supportpubl16053","supportpubl11546","KA2202232037243WC","supportpubl28989","supportpubl34386","supportpubl26953","supportpubl15777","supportpubl24020","supportpubl27603","supportpubl27603","supportpubl60402","supportpubl52503","supportpubl52503","supportpubl26953","supportpubl60402","supportpubl24020","supportpubl39573","supportpubl11546","supportpubl39573","supportpubl34746","supportpubl13974","supportpubl35737","supportpubl21242","supportpublic@cre.ma","testdev5","crema01","supportpubl16608","supportpubl28079","supportpubl17992","supportpubl32468","supportpubl97868","MB202306210013221","supportpubl18330","supportpubl98851","crematw","thecrema28532","supportpubl21077","supportpubl11361","568547","c217@c.com","MB202310270008347","testid12","milky3110","MB202312060008344","1668199@s","7018577282@s","allfit","duobackcs","test0004","MB202004290002254","supportpubl48376","thecrema1234","supportpubl47387","zmflak123","entest01","4373","testtest1234","seokyh","babooyh","rmaomina","cndfi23q","hahaseungkyu1","35548","03654872","jsh7520501","kko_3632541585","3119638072@n","jsh050164382","96b1e8c8-0e33-4b7d","d2familysale","290154641","86000896"];
    var result = i[g].indexOf(encrypted_manager_usernames, username) !== -1
      result ||= /^supportpubl\d{5}$/.test(username);
    return result
  }

  i[g].get_domain_prefix = function(username){
    var hit = i.location.search.match(/crema-test=([a-z])/);
    var testers = {"nuvodi":"s","qatest":"s","report003":"d","report004":"d","qatest1":"s","qatest2":"s","cremaqa002":"s","cremaqa001":"d","littleblack23":"s","crematest":"s","crematest1":"s","qahbs002":"s","17646":"s","cremababy":"s","crema1":"s","makespjjang":"s","cremamof":"s","hicrema":"s","cremachma":"s","rlaaltmf3699":"s","rlaaltmf12345678":"s","mtest":"s","kkktest01":"s","kkktest02":"s","kkktest03":"s","kkktest04":"s","kkktest05":"s","jgminhnc":"s","cremadev":"l","cremahybrid":"t","mtest6":"s","mtest7":"s","mtest8":"s","mtest2":"s","mtest3":"s","mtest4":"s","mtest5":"s","mtest9":"s","dcdc01":"s","dtest01":"d","dtest02":"d","dtest03":"d","dtest04":"d","dtest05":"d","dtest06":"d","dtest07":"d","dtest08":"d","dtest09":"d","dtest10":"d","stest01":"s","stest02":"s","stest03":"s","stest04":"s","stest05":"s","stest06":"s","stest07":"s","stest08":"s","stest09":"s","stest10":"s","stest021":"s","stest022":"s","stest023":"s","stest024":"s","stest025":"s","stest026":"s","stest027":"s","stest028":"s","stest029":"s","stest030":"s","stest031":"s","stest032":"s","stest033":"s","stest034":"s","stest035":"s","stest036":"s","stest037":"s","stest038":"s","stest039":"s","stest040":"s","stest041":"s","stest042":"s","stest043":"s","stest044":"s","stest045":"s","stest046":"s","stest047":"s","stest048":"s","stest049":"s","stest050":"s","cremanew":"s","eunmidtest01":"d","cremaqa1@gmail.com":"s","cremtest":"d","aim555crema":"s","dtest051":"d","supportpublic@crema.me":"s","supportpubl80173":"s","tjdgnsqn3":"d","cremattest":"t","crematttest":"t","dtest081":"d","tjdgnsqn133":"t","tester1":"s","barreltest":"s","asdlls":"s","asdlld":"s","admin":"s","hbs298":"s","hbs302":"s","hbs304":"s","hbs307":"s","hbs309":"s","hbs312":"s","ymlee23@lotte.com":"s","cremareview":"t","supportpublic@the-nuvo.com":"s","support@crema.me":"t","crematestqa3":"d","0line":"s","gi001":"s","X9218297":"s","development_1538":"s","development_1539":"s","development_1540":"s","welcome001":"s"};
    return (hit && hit[1]) || testers[username] || '';
  }

  i[g].get_skin_code = function() {
    let result = null
      result = CAFE24.SKIN_CODE
    return result;
  }

  i[g].get_forced_device = function(){
    var hit = i.location.search.match(/crema-widgets=([a-z]+)/);
    if(hit) return hit && hit[1];

  }

  i[g].is_smart_installation_simulation = function(){
    return i.location.search.includes('crema-sim');
  }

  i[g].widget_id_increment = 0;

  i[g].init = function(username, user_name){
    if(username){
      username = "" + username;
    }else{
      username = null;
    }
    var user_type;
    var domain_prefix = i[g].get_domain_prefix(username);
    var forced_device = i[g].get_forced_device();
    if(forced_device){
      if(forced_device !== "mobile"){
        i[g] = undefined;
        try{delete i[g];}catch(e){}
        a = s.getElementById("crema-jssdk");
        a.parentNode.removeChild(a);
        a = s.createElement(o);
        if(false) {
          a.src = "https://" + domain_prefix + "widgets.cre.ma/andar.co.kr/v2/init.js?forced_device=" + forced_device;
        }
        else if(forced_device === 'pc') {
          a.src = "https://" + domain_prefix + "widgets.cre.ma/andar.co.kr/init.js";
        }else if (forced_device === 'mobile') {
          a.src = "https://" + domain_prefix + "widgets.cre.ma/andar.co.kr/mobile/init.js";
        }
        a.async = 1;
        a.id = "crema-jssdk";
        m = s.getElementsByTagName(o)[0];
        m.parentNode.insertBefore(a,m);
        if(i.cremaAsyncInit){
          i.cremaAsyncInit.hasRun = false;
        }
        return;
      }
    }
    if(domain_prefix || i[g].is_smart_installation_simulation()){
      if(domain_prefix !== ""){
        i[g] = undefined;
        try{delete i[g];}catch(e){}
        a = s.getElementById("crema-jssdk");
        a.parentNode.removeChild(a);
        a = s.createElement(o);
        a.src = "https://" + domain_prefix + "widgets.cre.ma/andar.co.kr/mobile/init.js";
        a.async = 1;
        a.id = "crema-jssdk";
        m = s.getElementsByTagName(o)[0];
        m.parentNode.insertBefore(a,m);
        if(i.cremaAsyncInit){
          i.cremaAsyncInit.hasRun = false;
        }
        return;
      }
      user_type = "tester";
    }else if(i[g].is_manager(username)){
      user_type = "manager";
    }else{
      user_type = "user";
    }

    

    
i[g].info = {
  smart_installations: [],
  sim_smart_installations: [],
  solution: "cafe24",
  mid: "andar.co.kr",
  locale: "ko-KR",
  env: "production",
  is_spa: false,
  use_score_widget_v2: false,
  username: username,
  user_type: user_type,
  base_url: "https://review7.cre.ma",
  event_base_url: "https://events7.cre.ma",
  fit_base_url: "https://fit7.cre.ma",
  target_widget_base_url: "https://target.cre.ma",
  admin_base_url: "https://admin.cre.ma",
  ad_base_url: "https://ad.cre.ma/andar.co.kr",
  widgets_base_url: "https://widgets.cre.ma",
  review_use_inducing_popup_for_pc: false,
  review_show_write_popup: true,
  review_max_popup_count_per_day: 1,
  use_legacy_review_for_powerapps: true,
  file_attach_not_supported_powerapps_android_versions: ["4.4"],
  disable_replace_state_in_mobile_app: false,
  matching_review_with_order_code_in_my_orders: true,
  shop_builder: "cafe24",
  login_redirect_parameter: "",
  show_review_widget: false,
  show_target_widget: false,
  show_fit_widget: false,
  show_display_widget: false,
  secure_privacy: true,
  passphrase: "T1OPbMj5CPXO",
  page_url_patterns: [],
  page_type_regexes: [],
  use_toggle_byapps_bottom_menu: true,
  use_widget_auto_installation: false,
  disable_init_js_urls: [],
  widget_install_js: "\n    /* 20220907 temp handler - start */\n    {\n      const installer = crema[\`\${crema.info.shop_builder}_widget_installer\`]\n      const temp_current_location_matches = installer.current_location_matches\n      this.simplify_path = installer.simplify_path\n      installer.current_location_matches = (path) => path !== \'\' && temp_current_location_matches(path)\n    }\n    /* 20220907 temp handler - end */\n  crema.page_recognizer.add_page_regex(\"product_detail\", \"/surl/P/\");\n// /**\n//  * crema-widgets-rails/app/assets/javascripts/common/widget_installer\n//  *\n//  * 위에 기재한 폴더명 안에 있는 각 파일을 참조하시면 사용할 수 있는 메소드들을 확인하실 수 있습니다.\n//  */\n//\n// switch (page_type()) {\n//   case \'main\':\n//     attach_html(\'body\', \'beforeend\', \'<div class=\"crema-popup\"><\/div>\');\n//     break;\n//   case \'my_reviews\':\n//     attach_html(\'#boardSearchForm\', \'beforeend\', \'<div class=\"crema-reviews\" data-type=\"managing-reviews\"><\/div>\');\n//     break;\n//   case \'product_detail\':\n//     attach_html(\'body\', \'beforeend\', \'<div class=\"crema-popup\"><\/div>\');\n//     const product_no = get_product_no_from_url();\n//     attach_html(\'#prdReview .board\', \'afterend\', \'<div class=\"crema-product-reviews\" data-product-code=\"\' + product_no + \'\"><\/div>\');\n//     hide(\'#prdReview .nodata\', \'#prdReview .board\');\n//     break;\n//   case \'review_board\':\n//     const board_no = get_board_no_from_url();\n//     if (board_no !== \'4\') break;\n//     attach_html(\'#boardSearchForm\', \'afterend\', \'<div class=\"crema-reviews\"><\/div>\');\n//     hide(\'.xans-board-listpackage-4\', \'.xans-board-paging-4\', \'#boardSearchForm\');\n//     break;\n//   case \'my_orders\':\n//     new_review_link(\'a[href*=\"/board/product/write.html\"][href*=\"product_no=\"]\');\n//     break;\n// }",
  zone_id: 7,
  popup_install_position: 0,
  enable_widget_observe_install: false,
  enable_remove_hard_coded_crema_class: false,
  remove_hard_coded_crema_class_skins: [],
  crema_domain_prefix: "",
  enable_bugsnag: true,
  review_mall_board_code: "4",
  enable_vue_widget_install_v2: true,
  enable_page_url_pattern_v2: false,
  deprecate_product_score_widget: true
};
i[g].vue_widget = {"reviews_new":false}
if(user_name){i[g].info.user_name = user_name;}

const already_loaded_asset = document.querySelector("[src='https://assets7.cre.ma/widgets/assets/mobile-440ed1dbc49b5a0fde4342e87d2fc80dd08584fd2670cdaac7f1e015d99d4242.js']");
if(already_loaded_asset) {
  i[g].info.is_spa = true;
  already_loaded_asset.remove();
}

m = s.getElementsByTagName(o)[0];
r = s.createElement(o);
r.async = 1;
r.src = "https://assets7.cre.ma/widgets/assets/mobile-440ed1dbc49b5a0fde4342e87d2fc80dd08584fd2670cdaac7f1e015d99d4242.js";
r.id = "crema-jssdk";
r.charset = "UTF-8";
m.parentNode.insertBefore(r,m);


    
  };
          i[g].async_load_user_data = function(iframe_manager) {
  var async_set_user_data = function(username) {
    var review_testing = 'false' === 'true';
    var review_operating = 'false' === 'true';
    var fit_testing = 'false' === 'true';
    var is_target_installing = 'false' === 'true';
    var is_shop_manager_testing = (review_testing || fit_testing || is_target_installing) && i[g].info.user_type === 'user' && i[g].is_manager(username);
    if (is_shop_manager_testing) {
      i[g].info.user_type = 'manager';
      if (review_testing) {
        i[g].info.show_review_widget = true;
      }
      if (fit_testing) {
        i[g].info.show_fit_widget = true;
      }
      if (is_target_installing) {
        i[g].info.show_target_widget = true;
      }
      crema.set_widgets();
    }


    if (!is_shop_manager_testing || review_operating) {
      if(username){
        iframe_manager.update_user_data();
      }
    }
    i[g].run(true);
    i[g].log_current_page();
  }

  if(i.CAFE24API){
    var getMemberId = function() {
      var username = null;
      if (!i.CAPP_ASYNC_METHODS) return null;
      i.CAFE24API.getMemberID(function(result) {
        username = result;
      });
      return username;
    }

    var n = 0;
    var interval_for_method = setInterval(function(){
      if(i.CAPP_ASYNC_METHODS || ++n >= 100){
        clearInterval(interval_for_method);

        var m = 0;
        var interval_for_customer_info = setInterval(function(){
          if(getMemberId() || ++m >= 100){
            clearInterval(interval_for_customer_info);
            if(i.CAPP_ASYNC_METHODS) {
              i.CAFE24API.getCustomerInfo(function(err, res) {
                if(err){
                  i[g].info.username = getMemberId();
                }else{
                  var user = res.customer;
                  i[g].info.username = user.member_id;
                  i[g].info.user_name = user.name;
                }
                async_set_user_data(i[g].info.username);
              });
            } else {
              async_set_user_data();
            }
          }
        }, 10);
      }
    }, 10);
  } else {
    async_set_user_data();
  }
};
i[g].init();


})(window,document,"script","crema");

