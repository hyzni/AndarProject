var _debug_mode = false;
var _cro_more_dynamic_flag = 0;
var _cro_ticker_dynamic_flag = 0;

// 리포트 관련
var MCro = function() {
    this.version_code = "w_1.0.0";
    this.ymd_cookie_key = "cro_uv_ymd";
    this.loaded_script = false;
    this.loaded_t_script = false;
    this.order_cookie_key = "cro_order_";
    this.random_number = new Date().getTime().toString();

    // 생성자
    this.reportURL = {
        pv:"//mcro.myshp.us/data/collect/pv",
        uv:"//mcro.myshp.us/data/collect/uv",
        buy:"//mcro.myshp.us/data/collect/tag_buy,//trk.adnext.co/rat/tag/custom?tag=RAT_BUY",
        view:"//trk.adnext.co/rat/tag/custom?tag=RAT_VIEW,//mcro.myshp.us/data/collect/view_count",
        //buy:"//trk.adnext.co/rat/tag/custom?tag=RAT_BUY",
        search:"//trk.adnext.co/rat/tag/custom?tag=RAT_SEARCH"
    };
}

MCro.prototype.jsInit = function(cro_id, isTest)
{
	this._cro_id = cro_id.trim();
	//this._awudid = this.getCookie('awudid');
	var gmocoxudid = new _mocoxudid();
	this._awudid = gmocoxudid.id();

    if(_debug_mode){
        console.log("cro_id : " + this._cro_id);
        console.log("awudid : " + this._awudid);
    }

    var search = location.search.toLowerCase();
	if(cro_id == "5bbeadcfe4b08d2acb2a9758" && (search.indexOf('dtype=a') > -1 || search.indexOf('dtype=i') > -1)){
		return;
	}

    if(typeof isTest !== 'undefined'){
        this._isTest = isTest;
    }else{
        this._isTest = false;
    }

    try{
        if(this._isTest == false){
            this.checkPV();
        }
    }catch(e){
        console.log(e);
    }

    if (typeof gCro !== 'undefined') {
        // check gCro
        if(gCro != null && gCro != undefined && Array.isArray(gCro))
        {
            for(var i=gCro.length-1;i>=0;i--)
            {
                var obj = gCro[i];
                this.sendEvent(obj);
                gCro.pop();
            }
        }
    }

    if (typeof gCroRCData !== 'undefined') {
        // check gCroRCData
        if(gCroRCData != null && gCroRCData != undefined && Array.isArray(gCroRCData))
        {
            for(var i=gCroRCData.length-1;i>=0;i--)
            {
                var obj = gCroRCData[i];
                new this.MoreRecommendData(obj.config, obj.callback);
                gCroRCData.pop();
            }
        }
    }

    if (typeof gCroRCV !== 'undefined') {
        // check gCroRCV
        if(gCroRCV != null && gCroRCV != undefined && Array.isArray(gCroRCV))
        {
            for(var i=gCroRCV.length-1;i>=0;i--)
            {
                var obj = gCroRCV[i];
                new this.MoreRecommendView(obj.config);
                gCroRCV.pop();
            }
        }
    }

	if (typeof gCroRVV !== 'undefined') {
		// check gCroRVV
		if(gCroRVV != null && gCroRVV != undefined && Array.isArray(gCroRVV))
		{
			for(var i=gCroRVV.length-1;i>=0;i--)
			{
				var obj = gCroRVV[i];
				new this.MoreReviewView(obj.config);
				gCroRVV.pop();
			}
		}
	}

    // 패널 또는 티커 노출 제어를 위한 쿠키 저장
	var disable_panel = mCroQs["disable_panel"];
    if(typeof disable_panel !== "undefined") {
		this.setCookie('disable_more_panel', disable_panel, 180);
	}
    var disable_ticker = mCroQs["disable_ticker"];
	if(typeof disable_ticker !== "undefined") {
		this.setCookie('disable_more_ticker', disable_ticker, 180);
	}

    // 유입키워드 체크
    var inflow_keyword = mCroQs["n_query"];
    if(typeof inflow_keyword == "undefined"){
        inflow_keyword = mCroQs["DMSKW"];
    }

    if(typeof inflow_keyword != "undefined"){
        inflow_keyword = decodeURIComponent(inflow_keyword).replace(/\s+/g, '');

        var evt_data = {};
        evt_data.evt = "search";
        evt_data.keyword = inflow_keyword;
        evt_data.platform = "inflow";
        this.sendEvent(evt_data);
    }

    var _mcroObj = this;
    if (document.readyState === "complete" ||
        	(document.readyState !== "loading" && !document.documentElement.doScroll)) {
    	_mcroObj.chkPType();
	} else {
		if(document.addEventListener){
  			document.addEventListener("DOMContentLoaded", _mcroObj.chkPType(), false);
  		}else if(document.attachEvent){
  			document.attachEvent("onreadystatechange", function(){
  				// check if the DOM is fully loaded
  				if(document.readyState === "complete"){
  					document.detachEvent("onreadystatechange", arguments.callee);
  					_mcroObj.chkPType();
  				}
			});
  		}
	}

    window.addEventListener('message', function(e) {

		try {
			var data = e.data
			if(typeof data.more_el_id !== 'undefined'){
				//console.log(data);
				if(data.height == 0){
					var d = document.getElementById(data.more_el_id+'iframe');
					d.style.height = '0';
				}else{
					var o = document.getElementById(data.more_el_id+'iframe');
					o.style.height = (data.height+10) + 'px';
				}
			} else if(typeof data.review_click_url !== 'undefined'){
				_mcroObj.createReviewPanel(data);
			}

		}catch(e) {}
	});
}

MCro.prototype.chkPType = function()
{
	var _mcroObj = this;
	_mcroObj.before();
	var mcontent;
    try{
    	var melement = document.querySelector('meta[name="more_page_type"]');
    	mcontent = melement && melement.getAttribute("content");
    }catch(e){
    }

    var index = 1;
    if(typeof mcontent == 'undefined' || mcontent == null){
    	var chkPageInterval = setInterval(function() {
    		try{
    			index ++;
    			if(index > 5){
    				clearInterval(chkPageInterval);
    	    		_mcroObj.next(mcontent);
    	    		return;
    			}
    	    	var melement = document.querySelector('meta[name="more_page_type"]');
    	    	mcontent = melement && melement.getAttribute("content");

    	    	if(typeof mcontent !== 'undefined' && mcontent != null){
    	    		clearInterval(chkPageInterval);
    	    		_mcroObj.next(mcontent);
    	    	}
    	    }catch(e){
    	    }
    	},300);
    }
    else{
    	_mcroObj.next(mcontent);
    }
}

MCro.prototype.getFormatDate = function(strDate)
{
	var date = new Date(strDate);
	var year = date.getFullYear();              //yyyy
    var month = (1 + date.getMonth());          //M
    month = month >= 10 ? month : '0' + month;  //month 두자리로 저장
    var day = date.getDate();                   //d
    day = day >= 10 ? day : '0' + day;          //day 두자리로 저장
    var hours = date.getHours();
    hours = hours >= 10 ? hours : '0' + hours;
    var minutes = date.getMinutes();
    minutes = minutes >= 10 ? minutes : '0' + minutes;
    return  year + '' + month + '' + day + '' + hours + '' + minutes;
}

MCro.prototype.before = function()
{
	var _mcroObj = this;
    try{
    	var el_cno = document.querySelector('meta[property="more:c_no"]');
    	var mcno = el_cno && el_cno.getAttribute("content");
    	if(mcno && mcno != ''){
    		var el_ctitle = document.querySelector('meta[property="og:title"]');
        	var mctitle = el_ctitle && el_ctitle.getAttribute("content");
        	var el_thumb = document.querySelector('meta[property="og:image"]');
        	var mthumb = el_thumb && el_thumb.getAttribute("content");
        	var el_purl = document.querySelector('meta[property="og:url"]');
        	var mpurl = el_purl && el_purl.getAttribute("content");
        	var el_cate1 = document.querySelector('meta[property="article:section"]');
        	var mcate1 = el_cate1 && el_cate1.getAttribute("content");
        	var el_cate2 = document.querySelector('meta[property="article:section2"]');
        	var mcate2 = el_cate2 && el_cate2.getAttribute("content");
        	if(!mcate2){
        		mcate2 = '';
        	}
        	var el_cate3 = document.querySelector('meta[property="article:section3"]');
        	var mcate3 = el_cate3 && el_cate3.getAttribute("content");
        	if(!mcate3){
        		mcate3 = '';
        	}
        	var el_cdate = document.querySelector('meta[property="article:published_time"]');
        	var mcdate = el_cdate && el_cdate.getAttribute("content");
        	if(mcdate && mcdate != ''){
	        	mcdate = _mcroObj.getFormatDate(mcdate);
        	}
        	var el_cwriter = document.querySelector('meta[property="more:c_writer"]');
        	var mcwriter = el_cwriter && el_cwriter.getAttribute("content");

        	var el_pcurl = document.querySelector('meta[property="more:p_url"]');
        	var mpcurl = el_pcurl && el_pcurl.getAttribute("content");
        	if(!!mpcurl){
        		mpurl = mpcurl;
        	}

        	var el_mourl = document.querySelector('meta[property="more:p_url_m"]');
        	var mmurl = el_mourl && el_mourl.getAttribute("content");

        	var evt_data = {};
        	evt_data.evt = 'view';
        	evt_data.c_no = mcno;
			evt_data.c_title = mctitle;
			evt_data.thumb = mthumb;
			evt_data.p_url = encodeURI(mpurl);
			if(!!mmurl){
				evt_data.p_url_m = encodeURI(mmurl);
			}
			evt_data.cate1 = mcate1;
			evt_data.cate2 = mcate2;
			evt_data.cate3 = mcate3;
			evt_data.c_date = mcdate;
			evt_data.c_writer = mcwriter;
			_mcroObj.sendEvent(evt_data);
    	}
    }catch(e){
    }
}

MCro.prototype.next = function(mcontent)
{
	var _mcroObj = this;
	var current_page_type;
    var current_page_url;

    if(typeof mcontent !== 'undefined' && mcontent != null){
    	current_page_type = mcontent;
    }

    {
	    // 페이지정보 체크하여 패널을 노출해야하는 페이지면 노출 스크립트 load
	    // pc 인지 모바일인지 체크하여 각각의 노출 스크립트 로드
	    // page id
	    var upath = location.pathname;
	    var lastC = upath.charAt(upath.length - 1);
	    if(lastC == '/'){
	    	upath = upath.substring(0, upath.length - 1);
	    }
	    var current_page_url = location.host + upath;
	    current_page_url = current_page_url.replace('www.','');
    }

    var platform = (this.isMobile())?"mobile_web":"pc";

    if(current_page_type != null){
	    // MORE 패널 관련
	    var url = "//cro.myshp.us/api/checksch?company_code=" + this._cro_id + "&page_type=" + current_page_type + "&platform=" + platform + "&awudid=" + this._awudid;
	    var tm = new Date().getTime();
	    var cbname = "cbpgid"+tm;
	    $mCroJsonp.send(url + '&callback='+cbname, {
	        callbackName: cbname,
	        onSuccess: function(json){
	            if(_debug_mode){
	                console.log('success!', json);
	            }
	            if(json.result == "success"){
	            	//console.log(json.page_id);
	                //console.log(json.platform);
	            	_mcroObj._page_type = json.page_type;
	            	_mcroObj._page_id = json.page_id;
	            	_mcroObj._platform = json.platform;
	            	_mcroObj._m_sensitivity = json.m_sensitivity;
	            	_mcroObj._exit_alert = json.exit_alert;
	            	_mcroObj._keyword_yn = json.keyword_yn;
	            	if(_mcroObj._isTest == false){
	            		_mcroObj.checkPV(json.page_id);
	                }
	            	var disable_panel = _mcroObj.getCookie('disable_more_panel');
	            	if(disable_panel !== 'true') {
						_mcroObj.needPanelScript(json.panel_type);
					}
	            }

	        },
	        onTimeout: function(){
	            if(_debug_mode){
	                console.log('timeout!');
	            }
	        },
	        timeout: 3
	    });
    }

    if(current_page_type != null){
    	current_page_url = current_page_type;
    }

    var mtcontent = "";
    try{
    	var mtelement = document.querySelector('meta[name="more_detail_pid"]');
    	mtcontent = mtelement && mtelement.getAttribute("content");
    }catch(e){
    }

    // 티커 관련
    var url = "//cro.myshp.us/api/checkTpage?company_code=" + this._cro_id + "&page_url=" + current_page_url + "&platform=" + platform + "&awudid=" + this._awudid;
    var tm = new Date().getTime();
    var cbname = "cbnpgid"+tm;
    $mCroJsonp.send(url + '&callback='+cbname, {
        callbackName: cbname,
        onSuccess: function(json){
            if(_debug_mode){
                console.log('success!', json);
            }
            if(json.result == "success"){
            	//console.log(json.page_id);
                //console.log(json.platform);
            	_mcroObj._ticker_page_id = json.page_id;
            	_mcroObj._ticker_page_type = current_page_url;
            	_mcroObj._ticker_pid = mtcontent;
            	_mcroObj._platform = json.platform;
            	_mcroObj._showTime = json.show_time;
            	_mcroObj._hideTime = json.hide_time;
            	_mcroObj._position = json.position;
            	_mcroObj._horizontal = json.horizontal;
            	_mcroObj._vertical = json.vertical;
            	_mcroObj._layout = json.layout;
            	_mcroObj._position_prod = json.position_prod;
            	_mcroObj._vertical_prod = json.vertical_prod;
            	_mcroObj._layout_prod = json.layout_prod;
            	_mcroObj._noshow = json.noshow;
            	_mcroObj._scrollDeep = json.scroll_deep;
            	_mcroObj._delay = json.delay;
            	_mcroObj._b_showTime = json.banner_show_time;
            	_mcroObj._b_hideTime = json.banner_hide_time;
            	_mcroObj._b_noshow = json.banner_noshow;
				_mcroObj._animation = json.animation;
				_mcroObj._move = json.move;
            	if(typeof json.prod_only !== 'undefined'){
            		_mcroObj._prod_only = json.prod_only;
            	}
            	if(_mcroObj._isTest == false){
            		_mcroObj.checkPV(json.page_id);
                }
				var disable_ticker = _mcroObj.getCookie('disable_more_ticker');
				if(disable_ticker !== 'true') {
					_mcroObj.needTickerScript();
				}
            }

        },
        onTimeout: function(){
            if(_debug_mode){
                console.log('timeout!');
            }
        },
        timeout: 3
    });
}

MCro.prototype.checkPV = function(pgid)
{
    var _mcroObj = this;
    // pv 호출 파라미터 수정 필요!!!!
    var url = this.reportURL["pv"];
    url += "?id=" + this._cro_id;
    if(typeof pgid !== 'undefined'){
        url += "&page_id=" + pgid;
    }
    var platform = (this.isMobile())?"mobile_web":"pc";
    url += "&platform=" + platform;
    if(_debug_mode){
        console.log(url);
    }

    var tm = new Date().getTime();
    var cbname = "cbpv"+tm;
    $mCroJsonp.send(url + '&callback='+cbname, {
        callbackName: cbname,
        onSuccess: function(json){
            // 서버에서 보내주는 오늘날짜 가져오기
            if(typeof json.data.ymdh !== 'undefined'){
            	if(_debug_mode){
                    console.log('success!', json);
                    console.log(json.data.ymdh);
                }

            	_mcroObj.checkUV(json.data.ymdh, pgid);
            }
        },
        onTimeout: function(){
            if(_debug_mode){
                console.log('timeout!');
            }
        },
        timeout: 3
    });
}

MCro.prototype.checkUV = function(ymdh, pgid)
{
    // 쿠키에 저장된 날짜 가져오기
    // ymdh와 쿠키에 저장된 날짜 비교
    // 쿠키가 없거나 비교한 날짜가 다르면 uv 호출, 같으면 return;
    var _mcroObj = this;
    var cookieKey = this.ymd_cookie_key;
    if(typeof pgid !== 'undefined'){
        cookieKey += "_" + pgid;
    }
    var saved_ymd = this.getCookie(cookieKey);
    if(_debug_mode){
        console.log("saved_ymd = " + saved_ymd);
    }
    var new_ymd = ymdh.substring(0,8);
    if(_debug_mode){
        console.log("new_ymd = " + new_ymd);
    }

    if(saved_ymd == new_ymd){
        return;
    }

    // uv 호출 파라미터 수정 필요!!!!!
    var url = this.reportURL["uv"];
    url += "?id=" + this._cro_id;
    if(typeof pgid !== 'undefined'){
        url += "&page_id=" + pgid;
    }
    var platform = (this.isMobile())?"mobile_web":"pc";
    url += "&platform=" + platform;
    if(_debug_mode){
        console.log(url);
    }

    var tm = new Date().getTime();
    var cbname = "cbuv"+tm;
    $mCroJsonp.send(url + '&callback='+cbname, {
        callbackName: cbname,
        onSuccess: function(json){
            if(_debug_mode){
                console.log('success!', json);
            }

            // 쿠키 저장
            _mcroObj.setCookie(cookieKey, new_ymd, 2);
        },
        onTimeout: function(){
            if(_debug_mode){
                console.log('timeout!');
            }
        },
        timeout: 3
    });
}

MCro.prototype.needPanelScript = function(panelType)
{
	// jQuery 로드여부 체크
	var _mcroObj = this;
	var _mcroChkJquery = setInterval(function(){
		if(typeof jQuery !== 'undefined'){
			clearInterval(_mcroChkJquery);
			_mcroChkJquery = null;
			_mcroObj.loadPanelScript(_mcroObj, panelType);
		}
	}, 50);
	setTimeout(function(){
		if(_mcroChkJquery != null){
			clearInterval(_mcroChkJquery);
			_mcroChkJquery = null;
		}
	}, 5000);

}

MCro.prototype.loadPanelScript = function(_mcroObj, panelType)
{
	if(_mcroObj.loaded_script){
		return;
	}
	_mcroObj.loaded_script = true;
	var source;
    if(_mcroObj._platform == 'pc'){
    	source = '//cro.myshp.us/resources/common/js/cro-pc-panel.js';
    }else if(_mcroObj._platform == 'mobile_web'){
    	source = '//cro.myshp.us/resources/common/js/cro-mo-panel.js';
    }

    var now = new Date();
    var script = document.createElement('script');
	script.type = 'text/javascript';
	script.async = true;
	script.src = source + '?v=3&req='+ now.getFullYear() + now.getMonth() + now.getDate();
	script.onreadystatechange = function () {
        if (this.readyState == 'complete' || this.readyState == 'loaded') {
            try
            {
                if(_cro_more_dynamic_flag++==0) _mcroObj._startMore(panelType);
            }
            catch(e){}
        }
    };
    script.onload = function () {
        try{
            if(_cro_more_dynamic_flag++==0) _mcroObj._startMore(panelType);
        }catch(e){}
    };
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(script, s);
}

MCro.prototype._startMore = function(panelType)
{
	var tDiv = document.createElement('div');
	tDiv.setAttribute('id','cro_more_panel'); // id 지정
	document.body.appendChild(tDiv);
	try{
		jQuery("#cro_more_panel").CROPanel({
			panel_type : panelType
		});
	}catch(e){

	}
}

MCro.prototype.needTickerScript = function()
{
	// jQuery 로드여부 체크
	var _mcroObj = this;
	var _mcroChkJquery = setInterval(function(){
		if(typeof jQuery !== 'undefined'){
			clearInterval(_mcroChkJquery);
			_mcroChkJquery = null;
			_mcroObj.loadTickerScript(_mcroObj);
		}
	}, 50);
	setTimeout(function(){
		if(_mcroChkJquery != null){
			clearInterval(_mcroChkJquery);
			_mcroChkJquery = null;
		}
	}, 5000);

}

MCro.prototype.loadTickerScript = function(_mcroObj)
{
	if(_mcroObj.loaded_t_script){
		return;
	}
	_mcroObj.loaded_t_script = true;
	var source;
    if(_mcroObj._platform == 'pc'){
    	source = '//cro.myshp.us/resources/common/js/cro-pc-ticker_v3.js';
    }else if(_mcroObj._platform == 'mobile_web'){
    	source = '//cro.myshp.us/resources/common/js/cro-mobile-ticker.js';
    }

    var now = new Date();
    var script = document.createElement('script');
	script.type = 'text/javascript';
	script.async = true;
	script.src = source + '?v=1&req='+ now.getFullYear() + now.getMonth() + now.getDate();
	script.onreadystatechange = function () {
        if (this.readyState == 'complete' || this.readyState == 'loaded') {
            try
            {
                if(_cro_ticker_dynamic_flag++==0) _mcroObj._startTicker(_mcroObj);
            }
            catch(e){}
        }
    };
    script.onload = function () {
        try{
            if(_cro_ticker_dynamic_flag++==0) _mcroObj._startTicker(_mcroObj);
        }catch(e){}
    };
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(script, s);
}

MCro.prototype._startTicker = function(_mcroObj)
{
    var tDiv = document.createElement('div');
    tDiv.setAttribute('id','cro_ticker'); // id 지정
    document.body.appendChild(tDiv);

    try{
		jQuery("#cro_ticker").CROTicker({
			showTime : _mcroObj._showTime,
			hideTime : _mcroObj._hideTime,
			position : _mcroObj._position,
			horizontal : _mcroObj._horizontal,
			vertical : _mcroObj._vertical,
			layout : _mcroObj._layout,
			layout_prod : _mcroObj._layout_prod,
			noshow : _mcroObj._noshow,
			scrollDeep : _mcroObj._scrollDeep,
			delay : _mcroObj._delay,
			bShowTime : _mcroObj._b_showTime,
        	bHideTime : _mcroObj._b_hideTime,
        	bNoshow : _mcroObj._b_noshow,
			animation : _mcroObj._animation,
			move : _mcroObj._move,
			test : false,
	        debug : false
		});
    }catch(e){

    }
}

MCro.prototype.getParameter = function(key)
{
    var b = "";
    var a = "";
    try{
    	a = decodeURIComponent(location.search);
    }catch(e){
    	a = decodeURIComponent(unescape(location.search));
    }

    var e = (a.slice(a.indexOf("?") + 1, a.length)).split("&");
    for (var d = 0; d < e.length; d++) {
        var f = e[d].split("=")[0];
        if (f.toUpperCase() == key.toUpperCase()) {
            b = e[d].split("=")[1];
            break;
        }
    }
    return b;
}

MCro.prototype.stringify = function(e)
{
    var d = typeof(e);
    if (d != "object" || e === null) {
        if (d == "string") {
            e = '"' + e + '"'
        }
        return String(e);
    } else {
        var f, b, c = [],
            a = (e && e.constructor == Array);
        for (f in e) {
            b = e[f];
            d = typeof(b);
            if (d == "string") {
                b = '"' + b.replace(/\"/gi, "\\\"") + '"';
            } else {
                if (d == "object" && b !== null) {
                    b = JSON.stringify(b);
                }
            }
            c.push((a ? "" : '"' + f + '":') + String(b));
        }
        return (a ? "[" : "{") + String(c) + (a ? "]" : "}");
    }
}

MCro.prototype.addRecentProduct = function(prod)
{
    if(prod.indexOf(",")>0)
        return;

    var arr = [];
    var idxkey = "trk_cro_prod";
    var idxkey_idx = "trk_cro_prod_idx";

    var v = this.getCookie(idxkey);

    var mxlen = 10;

    try
    {
        var mx = v.split(",");
        if(mx.length <= 0)
        {
            arr = [];
        }
        else
        {
            for(var i=0;i<mx.length;i++)
            {
                if(mxlen-- <= 0)
                    break;

                if(mx[i] != "" && mx[i] != undefined && mx[i] != null && mx[i] != prod)
                {
                    arr.push(mx[i]);
                }
            }
        }
    }
    catch(e)
    {
        arr = [];
    }

    arr.unshift(prod);

    // make array
    {
        var res = "";
        for(var i=0;i<arr.length;i++)
        {
            if(i!=0)
                res += ",";
            res += arr[i];
        }

        this.setCookie(idxkey,res,14);
        this.setCookie(idxkey_idx,"0",14);
    }
},

MCro.prototype.setCookie = function(t, e, i)
{
    var n = window.location.hostname,
        r = new Date;
    void 0 !== i ? r.setDate(r.getDate() + i) : r.setDate(r.getDate());
    var a = " domain=" + n,
        o = t + "=" + escape(e) + "; path=/;";
    void 0 !== i && (o += " expires=" + r.toGMTString() + ";"), o += a, document.cookie = o
}

MCro.prototype.getCookie = function(t)
{
    t += "=";
    var e = document.cookie,
        i = e.indexOf(t),
        n = "";
    if (-1 != i) {
        i += t.length;
        var r = e.indexOf(";", i); - 1 == r && (r = e.length), n = e.substring(i, r)
    }
    return unescape(n)
}

MCro.prototype.isMobile = function()
{
    var filter = "win16|win32|win64|mac|macintel";
    if(navigator.platform){
        if( filter.indexOf(navigator.platform.toLowerCase())<0 ){
            return true;
        }
    }

    return false;
}

/*
MCro.prototype.loadIframe = function(a)
{
    try {
        var d = document.createElement("iframe");
        d.src = a + "&reqtime=" + (new Date()).getTime();
        d.style.position = "absolute";
        d.style.display = "none";
        document.body.appendChild(d)
    } catch (c) {}
}
*/

MCro.prototype.sendEvent = function(data)
{
    if(this._isTest == true){
        return;
    }

    if(this._cro_id == "59fa79f30cf2ca61477ddde0"){
    	var c_domain = location.host.replace('www.','');
    	if(c_domain !== "stylenanda.com" && c_domain !== "m.stylenanda.com" && c_domain !== "stylenanda.co.kr" && c_domain !== "m.stylenanda.co.kr"){
    		return;
    	}
    }

    // tag 체크해서 url 가져오기
    var tag = data.evt.toLowerCase();
    if(_debug_mode){
        console.log(tag);
    }
    var url = this.reportURL[data.evt];
    if(_debug_mode){
        console.log("evt url : " + url);
    }
    if (typeof url == 'undefined'){
        return;
    }

    if(tag == "pv"){
        this.checkPV(data.page_id);
    }
    else{
    	if(typeof data.price == 'number'){
    		data.price = data.price + "";
    	}
    	if(typeof data.price !== 'undefined'){
    		data.price = data.price.replace(/[^0-9.]/g,'');
    	}
    	if(typeof data.regular_price == 'number'){
    		data.regular_price = data.regular_price + "";
    	}
    	if(typeof data.regular_price !== 'undefined'){
    		data.regular_price = data.regular_price.replace(/[^0-9.]/g,'');
    	}
    	if(typeof data.qty == 'number'){
    		data.qty = data.qty + "";
    	}
    	if(typeof data.p_no == 'number'){
    		data.p_no = data.p_no + "";
    	}
    	if(typeof data.c_no == 'number'){
    		data.c_no = data.c_no + "";
    	}

        if(tag == "view"){
        	if(typeof data.p_name !== 'undefined'){
	            if(data.p_name.indexOf('<font') > 0){
	                var index = data.p_name.indexOf('<font');
	                data.p_name = data.p_name.substring(0, index);
	            }
	            data.p_name = data.p_name.replace(/<br>/gi,'[br]').replace(/(<([^>]+)>)/ig,"").replace(/\[br\]/gi,'<br>');
	            data.p_name = data.p_name.replace(/([\uE000-\uF8FF]|\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDDFF])/g, ' ');

	            if(this._cro_id == '5d148869e4b0adaa9beaa9d1'){
		            if(data.p_name.startsWith('t_') || data.p_name.startsWith('T_')){
		            	return;
		            }
	            }
	            if(this._cro_id == '5e7da409e4b0bf0312d1f968'){
		            if(data.p_name.startsWith('테스트_')){
		            	return;
		            }
	            }
	            if(data.p_name.indexOf('업뎃예정') > -1){
	            	return;
	            }
	            if(data.p_name.indexOf('개인결제') > -1){
	            	return;
	            }
        	}

        	if(typeof data.p_url !== 'undefined'){
        		data.p_url = encodeURI(data.p_url);
        	}
        	if(typeof data.p_url_m !== 'undefined'){
        		data.p_url_m = encodeURI(data.p_url_m);
        	}

        	if(typeof data.cate1 != 'undefined' && data.cate1 != null && data.cate1.indexOf('개인결제') > -1){
            	return;
            }
            if(typeof data.cate1 != 'undefined' && data.cate1 != null && data.cate1.indexOf('임직원몰') > -1){
            	return;
            }

            if(data.thumb != null){
            	if(data.thumb.indexOf("http") < 0){
            		if(data.thumb.indexOf("//") != 0){
            			data.thumb = location.protocol + '//' + location.host + data.thumb;
            		}
            	}
            }

            // 최근 본 상품 쿠키에 저장
            if(typeof data.p_no !== 'undefined'){
            	this.addRecentProduct(data.p_no);
            }else if(typeof data.c_no !== 'undefined'){
            	this.addRecentProduct(data.c_no);
            }
            data.url = window.location.href;
        }
        if(tag == "buy"){
        	if(typeof data.p_name !== 'undefined'){
	            if(data.p_name.indexOf('<font') > 0){
	                var index = data.p_name.indexOf('<font');
	                data.p_name = data.p_name.substring(0, index);
	            }
	            data.p_name = data.p_name.replace(/(<([^>]+)>)/ig,"");
	            if(this._cro_id == '5d148869e4b0adaa9beaa9d1'){
		            if(data.p_name.startsWith('t_') || data.p_name.startsWith('T_')){
		            	return;
		            }
	            }
	            if(this._cro_id == '5dd5f2c8e4b068537d323a9c'){
		            if(data.p_name.indexOf('임직원') > -1){
		            	return;
		            }
	            }
	            if(this._cro_id == '5e7da409e4b0bf0312d1f968'){
		            if(data.p_name.startsWith('테스트_')){
		            	return;
		            }
	            }
        	}
            data.url = window.location.href;
            if(this._cro_id == '5ebfcc48d717532b6aad5e74'){
            	data.qty = '1';
            	data.price = '0';
            	var oid = '_' + Math.random().toString(36).substr(2, 9);
            	data.order_id = oid;
            }

            // buy 수집인 경우 새로고침해서 중복 수집되는 경우를 막기위해 주문번호와 난수를 cookie에 저장한다.
            var _orderId = '';
            if(typeof data.order_id !== 'undefined'){
				_orderId = data.order_id;
			}

			if(_orderId.length <= 0){
				if(data.url.indexOf('order_id') > 0){
					var params = data.url.split('?')[1];
					var param = params.split('&');
					for(var i = 0; i < param.length; i++)
		    		{
						var code = param[i].split('=');
		        		var key = code[0];
		        		var value = code[1];

		        		if(key == 'order_id'){
		        			_orderId = value;
		        		}
		    		}
				}
			}

			if(_orderId.length > 0){
				// 해당 주문번호가 키값으로 쿠키에 저장되어 있는지 확인하여 내역이 없으면 쿠키에 저장(value는 로드될 때 생성한 난수).
				var rn = this.getCookie(this.order_cookie_key + _orderId);
				if(rn.length <= 0){
					this.setCookie(this.order_cookie_key + _orderId, this.random_number, 1);
				}
				// 저정된 난수가 있으면 현재 생성되어 있는 난수와 비교하여 동일하지 않을때 return
				else{
					//console.log('load : ' + this.random_number + ', saved : ' + rn);
					if(rn !== this.random_number){
						return;
					}
				}

			}
        }
        if(this.getParameter("koost") != "") {
            data.koost = this.getParameter("koost");
        }
        else {
            data.koost = "N";
        }

        if(this.getParameter("koost_search") != "") {
            data.koost_search = this.getParameter("koost_search");
        }

        try{
            data.referrer = document.referrer;
        }catch(e){
        }
        if(typeof data.platform == 'undefined'){
            data.platform = (this.isMobile())?"mobile_web":"pc";
        }

        if(_debug_mode){
            console.log(data);
        }

        try{
            if(tag == "buy"){
                var trkParam = "";
                trkParam += "value=" + encodeURIComponent(window.btoa(unescape(encodeURIComponent(this.stringify(data)))));
                trkParam += "&ver=" + this.version_code;
                trkParam += "&id=" + this._cro_id;
                trkParam += "&ty=W";
                trkParam += "&awudid=" +this._awudid;
                if( data.p_no != undefined && data.p_no != "" && data.p_no != null )
                {
                    trkParam += "&item=" + encodeURI(data.p_no);
                }

                var urls = url.split(',');
                var buyurl1 = urls[0];
                var buyurl2 = urls[1];
                if(buyurl1.indexOf("?") > 0){
                    buyurl1 += "&";
                } else {
                    buyurl1 +=  "?";
                }
                if(buyurl2.indexOf("?") > 0){
                    buyurl2 += "&";
                } else {
                    buyurl2 +=  "?";
                }

                var tm = new Date().getTime();
                var burl1 = buyurl1 + trkParam + '&reqtime=' + tm;
        	    var cbname1 = "buy1"+tm;
        	    $mCroJsonp.send(burl1 + '&callback='+cbname1, {
        	        callbackName: cbname1,
        	        onSuccess: function(json){
        	        },
        	        onTimeout: function(){
        	        },
        	        timeout: 3
        	    });
        	    var burl2 = buyurl2 + trkParam + '&reqtime=' + tm;
        	    var cbname2 = "buy2"+tm;
        	    $mCroJsonp.send(burl2 + '&callback='+cbname2, {
        	        callbackName: cbname2,
        	        onSuccess: function(json){
        	        },
        	        onTimeout: function(){
        	        },
        	        timeout: 3
        	    });

                //this.loadIframe(buyurl1 + trkParam);
                //this.loadIframe(buyurl2 + trkParam);

            } else if(tag == "view"){
                var trkParam = "";
                trkParam += "value=" + encodeURIComponent(window.btoa(unescape(encodeURIComponent(this.stringify(data)))));
                trkParam += "&ver=" + this.version_code;
                trkParam += "&id=" + this._cro_id;
                trkParam += "&ty=W";
                trkParam += "&awudid=" +this._awudid;

                var urls = url.split(',');
                var viewurl1 = urls[0];
                var viewurl2 = urls[1];
                if(viewurl1.indexOf("?") > 0){
                	viewurl1 += "&";
                } else {
                	viewurl1 +=  "?";
                }
                if(viewurl2.indexOf("?") > 0){
                	viewurl2 += "&";
                } else {
                	viewurl2 +=  "?";
                }

                var tm = new Date().getTime();
                var vurl1 = viewurl1 + trkParam + '&reqtime=' + tm;
        	    var cbname1 = "view1"+tm;
        	    $mCroJsonp.send(vurl1 + '&callback='+cbname1, {
        	        callbackName: cbname1,
        	        onSuccess: function(json){
        	        },
        	        onTimeout: function(){
        	        },
        	        timeout: 3
        	    });
        	    var vurl2 = viewurl2 + trkParam + '&reqtime=' + tm;
        	    var cbname2 = "view2"+tm;
        	    $mCroJsonp.send(vurl2 + '&callback='+cbname2, {
        	        callbackName: cbname2,
        	        onSuccess: function(json){
        	        },
        	        onTimeout: function(){
        	        },
        	        timeout: 3
        	    });

                //this.loadIframe(url + trkParam);
            } else {
                var trkParam;
                if(url.indexOf("?") > 0){
                    trkParam = "&";
                } else {
                    trkParam = "?";
                }
                trkParam += "value=" + encodeURIComponent(window.btoa(unescape(encodeURIComponent(this.stringify(data)))));
                trkParam += "&ver=" + this.version_code;
                trkParam += "&id=" + this._cro_id;
                trkParam += "&ty=W";
                trkParam += "&awudid=" +this._awudid;

                if(_debug_mode){
                    console.log(url + trkParam);
                }

                var tm = new Date().getTime();
                var sendurl = url + trkParam + '&reqtime=' + tm;
        	    var cbname = "send"+tm;
        	    $mCroJsonp.send(sendurl + '&callback='+cbname, {
        	        callbackName: cbname,
        	        onSuccess: function(json){
        	        },
        	        onTimeout: function(){
        	        },
        	        timeout: 3
        	    });

                //this.loadIframe(url + trkParam);
            }
        }catch(e){
        }
    }
}

// 암호화 관련
var mCroBase64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function(c) {
        var a = "";
        var k, h, f, j, g, e, d;
        var b = 0;
        c = mCroBase64._utf8_encode(c);
        while (b < c.length) {
            k = c.charCodeAt(b++);
            h = c.charCodeAt(b++);
            f = c.charCodeAt(b++);
            j = k >> 2;
            g = ((k & 3) << 4) | (h >> 4);
            e = ((h & 15) << 2) | (f >> 6);
            d = f & 63;
            if (isNaN(h)) {
                e = d = 64
            } else {
                if (isNaN(f)) {
                    d = 64
                }
            }
            a = a + this._keyStr.charAt(j) + this._keyStr.charAt(g) + this._keyStr.charAt(e) + this._keyStr.charAt(d)
        }
        //a = a.replace(/\+/g, "-").replace(/\//g, "_").replace(/\=+$/, "");
        return a
    },
    decode: function(c) {
        var a = "";
        var k, h, f;
        var j, g, e, d;
        var b = 0;
        c = c.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (b < c.length) {
            j = this._keyStr.indexOf(c.charAt(b++));
            g = this._keyStr.indexOf(c.charAt(b++));
            e = this._keyStr.indexOf(c.charAt(b++));
            d = this._keyStr.indexOf(c.charAt(b++));
            k = (j << 2) | (g >> 4);
            h = ((g & 15) << 4) | (e >> 2);
            f = ((e & 3) << 6) | d;
            a = a + String.fromCharCode(k);
            if (e != 64) {
                a = a + String.fromCharCode(h)
            }
            if (d != 64) {
                a = a + String.fromCharCode(f)
            }
        }
        a = mCroBase64._utf8_decode(a);
        return a
    },
    _utf8_encode: function(b) {
        b = b.replace(/\r\n/g, "\n");
        var a = "";
        for (var e = 0; e < b.length; e++) {
            var d = b.charCodeAt(e);
            if (d < 128) {
                a += String.fromCharCode(d)
            } else {
                if ((d > 127) && (d < 2048)) {
                    a += String.fromCharCode((d >> 6) | 192);
                    a += String.fromCharCode((d & 63) | 128)
                } else {
                    a += String.fromCharCode((d >> 12) | 224);
                    a += String.fromCharCode(((d >> 6) & 63) | 128);
                    a += String.fromCharCode((d & 63) | 128)
                }
            }
        }
        return a
    },
    _utf8_decode: function(a) {
        var b = "";
        var d = 0;
        var e = c1 = c2 = 0;
        while (d < a.length) {
            e = a.charCodeAt(d);
            if (e < 128) {
                b += String.fromCharCode(e);
                d++
            } else {
                if ((e > 191) && (e < 224)) {
                    c2 = a.charCodeAt(d + 1);
                    b += String.fromCharCode(((e & 31) << 6) | (c2 & 63));
                    d += 2
                } else {
                    c2 = a.charCodeAt(d + 1);
                    c3 = a.charCodeAt(d + 2);
                    b += String.fromCharCode(((e & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    d += 3
                }
            }
        }
        return b
    },
    URLEncode: function(a) {
        return escape(this._utf8_encode(a))
    },
    URLDecode: function(a) {
        return this._utf8_decode(unescape(a))
    }
};

var mCroQs = (function(a) {
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i)
    {
        var p=a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else{
            try{
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
            }catch(e){
                b[p[0]] = p[1].replace(/\+/g, " ");
            }
        }
    }
    return b;
})(window.location.search.substr(1).split('&'));

var $mCroJsonp = (function(){
  var that = {};

  that.send = function(src, options) {
    var callback_name = options.callbackName || 'callback',
      on_success = options.onSuccess || function(){},
      on_timeout = options.onTimeout || function(){},
      timeout = options.timeout || 10; // sec

    var timeout_trigger = window.setTimeout(function(){
      window[callback_name] = function(){};
      on_timeout();
    }, timeout * 1000);

    window[callback_name] = function(data){
      window.clearTimeout(timeout_trigger);
      on_success(data);
    }

    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.async = true;
    script.src = src;

    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(script, s);
  }

  return that;
})();

var isMobileInMore = {
    Android: function () {
    	return navigator.userAgent.match(/Android/i) == null ? false : true;
    },
    BlackBerry: function () {
    	return navigator.userAgent.match(/BlackBerry/i) == null ? false : true;
    },
    IOS: function () {
    	return navigator.userAgent.match(/iPhone|iPad|iPod/i) == null ? false : true;
    },
    Opera: function () {
    	return navigator.userAgent.match(/Opera Mini/i) == null ? false : true;
    },
    Windows: function () {
    	return navigator.userAgent.match(/IEMobile/i) == null ? false : true;
    },
    any: function () {
    	return (isMobileInMore.Android() || isMobileInMore.BlackBerry() || isMobileInMore.IOS() || isMobileInMore.Opera() || isMobileInMore.Windows());
    }
};

MCro.prototype.MoreRecommendData = function(config, callback)
{
	var mcroObj = this;
	//mcroObj._cfg = config;

	var type = config.type;
	var url = '//ndata.adnext.co/data/recommend/';
	if(type == 'pbyc'){
		url += 'plist?'
		url += 'item=' + globalCRO.getCookie('trk_cro_prod');
	}else if(type == 'best'){
		url += 'products?'
		url += 'item=koost';
	}else if(type == 'pbyk'){
		url += 'keyword?'
		url += 'item=' + encodeURIComponent(config.key);
	}else if(type == 'pbyp'){
		url += 'products?'
		url += 'item=' + config.key;
	}else if(type == 'kbyp'){
		url += 'kbyp?'
		url += 'item=' + config.key;
	}else if(type == 'kbyk'){
		url += 'kbyk?'
		url += 'item=' + encodeURIComponent(config.key);
	}else{
		return;
	}

	var tracking_code = "koost=" + config.page_type + "_" + config.type;
	if(config.type == 'pbyk'){
		tracking_code += "&koost_search=";
		tracking_code += encodeURIComponent(config.key)
	}
	var count = 15;
	if(!!config.count) {
		count = config.count
	}
	url += '&id='+globalCRO._cro_id;
	url += '&count=' + count;
	$mCroJsonp.send(url + '&callback=rc_' + type, {
        callbackName: 'rc_' + type,
        onSuccess: function(json){
	        try{
		        if(type == 'pbyc'){
		        	var result = {};
		        	result.data = json.data.products;
		        	result.trk_code = tracking_code;
					callback(result);
				}else if(type == 'pbyp'){
					var result = {};
					result.data = json.data.products;
		        	result.trk_code = tracking_code;
					callback(result);
				}else if(type == 'pbyk'){
					var result = {};
					result.data = json.data.products;
		        	result.trk_code = tracking_code;
					callback(result);
				}else if(type == 'kbyk'){
					var result = {};
					result.data = json.data.keywords;
		        	result.trk_code = tracking_code;
					callback(result);
				}else if(type == 'kbyp'){
					var result = {};
					result.data = json.data.keywords;
		        	result.trk_code = tracking_code;
					callback(result);
				}
			}catch(e){
				var result = {};
				var arr = [];
				result.data = arr;
		        result.trk_code = 'exception';
				callback(result);
			}
        },
        onTimeout: function(){

        },
        timeout: 2
    });
}

MCro.prototype.MoreRecommendView = function(config)
{
	var mcroObj = this;
	//mcroObj._cfg = config;
	var page_type = config.page_type;
	var type = config.type;
	const platform = (isMobileInMore.any()) ? "m" : "p";
	var platform_dt = platform == "m"?"mobile_web":"pc";

	if(type == 'pbyk' || type == 'kbyk') {
		// get search data
		var urlsch = "//cro.myshp.us/api/checksearch?company_code=" + globalCRO._cro_id + "&page_type=" + page_type + "&rs_type=" + type + "&platform=" + platform_dt;
		var tmsch = new Date().getTime();
		var cbnamesch = "cbsch" + type + "id" + tmsch;
		$mCroJsonp.send(urlsch + '&callback=' + cbnamesch, {
			callbackName: cbnamesch,
			onSuccess: function (json) {
				if (_debug_mode) {
					console.log('success!', json);
				}
				if (json.result == "success") {
					//console.log(json.page_id);
					//console.log(json.platform);
					var settings = {}
					settings.title = json.title;
					settings.kbyk_background_color = json.kbyk_background_color;
					settings.kbyk_text_color = json.kbyk_text_color;
					settings.kbyk_title_color = json.kbyk_title_color;
					settings.pbyk_title_color = json.pbyk_title_color;
					settings.pbyk_point_color = json.pbyk_point_color;
					settings.font = json.font;
					mcroObj.MoreSchView(config, settings, mcroObj)
				}

			},
			onTimeout: function () {
				if (_debug_mode) {
					console.log('timeout!');
				}
			},
			timeout: 3
		});
	} else {
		// get recommend data
		var urlrc = "//cro.myshp.us/api/checkrc?company_code=" + globalCRO._cro_id + "&page_type=" + page_type + "&rs_type=" + type + "&platform=" + platform_dt;
		var tmrc = new Date().getTime();
		var cbnamerc = "cbrc" + type + "id" + tmrc;
		$mCroJsonp.send(urlrc + '&callback=' + cbnamerc, {
			callbackName: cbnamerc,
			onSuccess: function (json) {
				if (_debug_mode) {
					console.log('success!', json);
				}
				if (json.result == "success") {
					//console.log(json.page_id);
					//console.log(json.platform);
					var settings = {}
					settings.title = json.title;
					settings.title_text_color = json.title_text_color;
					settings.point_text_color = json.point_text_color;
					settings.font = json.font;
					settings.design_type = json.design_type;
					mcroObj.MoreRcView(config, settings, mcroObj)
				}

			},
			onTimeout: function () {
				if (_debug_mode) {
					console.log('timeout!');
				}
			},
			timeout: 3
		});
	}

	//var title = config.title;
	/*
	var iw = 1;
	var ih = 1;

	if(typeof config.iw !== 'undefined') iw = config.iw;
	if(typeof config.ih !== 'undefined') ih = config.ih;
	var style = 'default';
	if(typeof config.style !== 'undefined') style = config.style;
	var theme = platform + '_' + style;
	var detail_url = '';
	if(typeof config.landing_url !== 'undefined'){
		detail_url = config.landing_url;
	}
	if(detail_url.length > 0){
		this._cfg.url = detail_url;
	}

	var url = '//pi.myshp.us/more?';
	this._cfg.id = this._cfg.layerid;
	var objId = this.moreRID();

	if(type == 'pbyc'){
		this._cfg.key = globalCRO.getCookie('trk_cro_prod');
	}else if(type == 'best'){
		this._cfg.key = 'koost';
	}else if(type == 'pbyk'){
		this._cfg.key = config.key;
	}else if(type == 'pbyp'){
		this._cfg.key = config.key;
	}else if(type == 'kbyp'){
		this._cfg.key = config.key;
	}else if(type == 'kbyk'){
		this._cfg.key = config.key;
	}else{
		return;
	}


	url += '&key='+encodeURIComponent(this._cfg.key);
	url += '&type='+type;

	url += '&url='+encodeURIComponent(this._cfg.url);
	url += '&title='+encodeURIComponent(title);
	url += '&iw='+iw;
	url += '&ih='+ih;

	url += '&ratid='+globalCRO._cro_id;
	url += '&channel='+page_type;
	url += '&myid='+objId;
	url += '&style=' + theme;

	try {
		var obj = document.createElement('iframe');
		obj.setAttribute('id', objId+'iframe');
		obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:0;border:none;')
		//obj.style.width = '1px';
		//obj.style.minWidth = '100%';
		//obj.style.height = '0';
		//obj.style.border = 'none';
		obj.scrolling = 'no';
		obj.src = url;
		document.getElementById(this._cfg.id).appendChild(obj);

	} catch(e) {
		console.log(e)
	}
	*/
}
MCro.prototype.MoreRecommendView.prototype.MoreRcView = function(config, settings, mcroObj) {
	//var title = config.title;
	var page_type = config.page_type;
	var type = config.type;
	const platform = (isMobileInMore.any()) ? "m" : "p";

	var iw = 1;
	var ih = 1;

	if(typeof config.iw !== 'undefined') iw = config.iw;
	if(typeof config.ih !== 'undefined') ih = config.ih;
	var style = 'default';
	var d_type = '';
	if(typeof settings.font !== 'undefined') style = settings.font;
	if(typeof settings.design_type !== 'undefined') {
		if(platform == 'p' && settings.design_type == 'V') d_type = '_v';
	}
	var theme = platform + d_type + '_' + style.toLowerCase();
	var detail_url = '';
	if(typeof config.landing_url !== 'undefined'){
		detail_url = config.landing_url;
	}
	if(detail_url.length > 0){
		config.url = detail_url;
	}

	var url = '//pi.myshp.us/more?';
	config.id = config.layerid;
	var objId = mcroObj.moreRID();

	if(type == 'pbyc'){
		config.key = globalCRO.getCookie('trk_cro_prod');
	}else if(type == 'best'){
		config.key = 'koost';
	}else if(type == 'pbyk'){
		config.key = config.key;
	}else if(type == 'pbyp'){
		config.key = config.key;
	}else if(type == 'kbyp'){
		config.key = config.key;
	}else if(type == 'kbyk'){
		config.key = config.key;
	}else{
		return;
	}


	url += '&key='+encodeURIComponent(config.key);
	url += '&type='+type;

	url += '&url='+encodeURIComponent(config.url);
	if(globalCRO._cro_id == '5ba0a9b1e4b0f279ec6d5ad9') {
		url += '&title='+encodeURIComponent(config.title);
	}else {
		url += '&title='+encodeURIComponent(settings.title);
	}
	url += '&iw='+iw;
	url += '&ih='+ih;

	url += '&ratid='+globalCRO._cro_id;
	url += '&channel='+page_type;
	url += '&myid='+objId;
	url += '&style=' + theme;
	url += '&titclr='+encodeURIComponent('#' + settings.title_text_color);
	url += '&clr='+encodeURIComponent('#' + settings.point_text_color);

	try {
		var obj = document.createElement('iframe');
		obj.setAttribute('id', objId+'iframe');
		if(typeof settings.design_type !== 'undefined') {
			if(platform == 'p' && settings.design_type == 'V') {
				obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:100%;border:none;')
			} else {
				obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:0;border:none;')
			}
		}else{
			obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:0;border:none;')
		}
		//obj.style.width = '1px';
		//obj.style.minWidth = '100%';
		//obj.style.height = '0';
		//obj.style.border = 'none';
		obj.scrolling = 'no';
		obj.src = url;
		document.getElementById(config.id).appendChild(obj);

	} catch(e) {
		console.log(e)
	}
}

MCro.prototype.MoreRecommendView.prototype.MoreSchView = function(config, settings, mcroObj) {
	//var title = config.title;
	var page_type = config.page_type;
	var type = config.type;
	const platform = (isMobileInMore.any()) ? "m" : "p";

	var style = 'default';
	if(typeof settings.font !== 'undefined') style = settings.font;
	var theme = platform + '_' + style.toLowerCase();
	var detail_url = '';
	if(typeof config.landing_url !== 'undefined'){
		detail_url = config.landing_url;
	}
	if(detail_url.length > 0){
		config.url = detail_url;
	}

	var url = '//pi.myshp.us/more?';
	config.id = config.layerid;
	var objId = mcroObj.moreRID();

	if(type == 'pbyc'){
		config.key = globalCRO.getCookie('trk_cro_prod');
	}else if(type == 'best'){
		config.key = 'koost';
	}else if(type == 'pbyk'){
		config.key = config.key;
	}else if(type == 'pbyp'){
		config.key = config.key;
	}else if(type == 'kbyp'){
		config.key = config.key;
	}else if(type == 'kbyk'){
		config.key = config.key;
	}else{
		return;
	}


	url += '&key='+encodeURIComponent(config.key);
	url += '&type='+type;

	url += '&url='+encodeURIComponent(config.url);
	if(globalCRO._cro_id == '5ba0a9b1e4b0f279ec6d5ad9') {
		url += '&title='+encodeURIComponent(config.title);
	}else {
		url += '&title='+encodeURIComponent(settings.title);
	}

	url += '&ratid='+globalCRO._cro_id;
	url += '&channel='+page_type;
	url += '&myid='+objId;
	url += '&style=' + theme;
	url += '&clr='+encodeURIComponent('#' + settings.pbyk_point_color);
	url += '&titclr='+encodeURIComponent('#' + settings.pbyk_title_color);
	url += '&kbgclr='+encodeURIComponent('#' + settings.kbyk_background_color);
	url += '&kclr='+encodeURIComponent('#' + settings.kbyk_text_color);
	url += '&ktitclr='+encodeURIComponent('#' + settings.kbyk_title_color);

	try {
		var obj = document.createElement('iframe');
		obj.setAttribute('id', objId+'iframe');
		obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:0;border:none;')
		//obj.style.width = '1px';
		//obj.style.minWidth = '100%';
		//obj.style.height = '0';
		//obj.style.border = 'none';
		obj.scrolling = 'no';
		obj.src = url;
		document.getElementById(config.id).appendChild(obj);

	} catch(e) {
		console.log(e)
	}
}

MCro.prototype.MoreReviewView = function(config) {
	var mcroObj = this;
	//mcroObj._cfg = config;
	var type = 'review';
	const platform = (isMobileInMore.any()) ? "m" : "p";
	var platform_dt = platform == "m" ? "mobile_web" : "pc";

	// get recommend data
	var urlrv = "//cro.myshp.us/api/checkrv?company_code=" + globalCRO._cro_id + "&item=" + encodeURI(config.key) + "&platform=" + platform_dt;
	var tmrv = new Date().getTime();
	var cbnamerv = "cbrv" + type + "id" + tmrv;
	$mCroJsonp.send(urlrv + '&callback=' + cbnamerv, {
		callbackName: cbnamerv,
		onSuccess: function (json) {
			if (_debug_mode) {
				console.log('success!', json);
			}
			if (json.result == "success") {
				var rDiv = document.createElement('div');
				rDiv.setAttribute('id','cro_more_review'); // id 지정
				document.body.appendChild(rDiv);

				//console.log(json.page_id);
				//console.log(json.platform);
				var settings = {}
				settings.title = json.title;
				settings.keyword = json.keyword;
				settings.panel_id = json.panel_id;
				mcroObj.MoreRvView(config, settings, mcroObj)
			}

		},
		onTimeout: function () {
			if (_debug_mode) {
				console.log('timeout!');
			}
		},
		timeout: 3
	});
}

MCro.prototype.MoreReviewView.prototype.MoreRvView = function(config, settings, mcroObj) {
	var type = 'review';
	const platform = (isMobileInMore.any()) ? "m" : "p";

	var iw = 1;
	var ih = 1;

	if(typeof config.iw !== 'undefined') iw = config.iw;
	if(typeof config.ih !== 'undefined') ih = config.ih;
	var style = 'notosans';
	var theme = platform + '_' + style.toLowerCase();

	var url = '//pi.myshp.us/more?';
	config.id = config.layerid;
	var objId = mcroObj.moreRVID();

	url += '&key='+encodeURIComponent(settings.keyword);
	url += '&type='+type;
	url += '&title='+encodeURIComponent(settings.title);
	url += '&iw='+iw;
	url += '&ih='+ih;

	url += '&ratid='+globalCRO._cro_id;
	url += '&myid='+objId;
	url += '&style=' + theme;
	url += '&channel=' + settings.panel_id
	url += '&uid=' + globalCRO._awudid
	url += '&url=' + encodeURIComponent(location.href)
	url += '&more=1';

	try {
		var obj = document.createElement('iframe');
		obj.setAttribute('id', objId+'iframe');
		obj.setAttribute('style', 'width:1px;min-width:100%;*width:100%;height:0;border:none;')
		//obj.style.width = '1px';
		//obj.style.minWidth = '100%';
		//obj.style.height = '0';
		//obj.style.border = 'none';
		obj.scrolling = 'no';
		obj.src = url;
		document.getElementById(config.id).appendChild(obj);

	} catch(e) {
		console.log(e)
	}
}

MCro.prototype.createReviewPanel = function(click_data)
{
	var _mcroObj = this;
	const platform = (isMobileInMore.any()) ? "m" : "p";
	var surl = click_data.review_click_url
	if(surl.indexOf('instagram') > -1){
		surl = surl.substring(0, surl.indexOf('?'));
		surl += 'embed/captioned';
	}else if(surl.indexOf('blog.naver') > -1){
		surl = surl.replace('blog.naver','m.blog.naver');
	}else if(surl.indexOf('youtube') > -1){
		surl = surl.replace('watch?v=', 'embed/');
		surl += '?autoplay=1'
	}else if(surl.indexOf('tiktok') > -1 || surl.indexOf('story.kakao') > -1){
		surl = click_data.content_url
	}

	this._bodyOverflowCss = $('body').css('overflow');
	var review_element = $('#cro_more_review');
	review_element.css({'z-index':'10000000009'});

	var wrapperDiv = $('<div id="more_review_panel_wrapper" />');
	wrapperDiv.css({
		'position' : 'fixed',
		'top' : '0',
		'left' : '0',
		'right' : '0',
		'bottom' : '0',
		'width' : '100%',
		//'height' : '100%',
		'overflow' : 'hidden',
		'background-color' : 'rgba(0,0,0, .86)',
		'z-index' : '10000000010',
		'outline' : '0',
		'-webkit-transition' : 'opacity .1s linear',
		'-moz-transition' : 'opacity .1s linear',
		'-ms-transition' : 'opacity .1s linear',
		'-o-transition' : 'opacity .1s linear',
		'transition' : 'opacity .1s linear'
	});
	wrapperDiv.appendTo(review_element);

	var closeDiv = $('<button type="button" id="more_review_panel_close" />');
	closeDiv.css({
		'display' : 'block',
		'right' : '30px',
		'top' : '30px',
		'position' : 'absolute',
		'width' : '27px',
		'height' : '27px',
		'border' : '0',
		'background' : 'url(https://cro.myshp.us/resources/common/images/panelClose.png) 0 0 no-repeat'
	});
	closeDiv.click(function (e) {
		_mcroObj.closeReviewPanel();
	});
	closeDiv.appendTo(wrapperDiv);

	var containerDiv = $('<div id="more_review_panel_container" />');
	if(platform == 'p') {
		containerDiv.css({
			'position': 'absolute',
			'top': '50%',
			'left': '50%',
			'transform': 'translate(-50%, -50%)',
			'width': '500px',
			'height': '70%',
			'overflow': 'hidden'
		});
	} else {
		containerDiv.css({
			'position': 'absolute',
			'top': '50%',
			'left': '0',
			'transform': 'translate(0, -50%)',
			'width': '100%',
			'height': '70%',
			'overflow': 'hidden'
		});
	}
	containerDiv.appendTo(wrapperDiv);

	var iframe = $('<iframe />');
	iframe.attr({
		'name': 'ifr_review_panel',
		'id': 'ifr_review_panel',
		'marginwidth' : '0',
		'marginheight' : '0',
		'frameborder' : '0',
		'allowtransparency' : 'true',
		'border' : '0',
		'padding' : '0',
		'margin' : '0',
		'border' : '0',
		'src' : surl,
		'allow' : 'autoplay',
		'allowfullscreen' : 'true'
	});
	iframe.attr('style', 'width:100%;height: 100% !important');
	iframe.appendTo(containerDiv);

	var btnDiv = $('<div id="more_review_panel_buttons" />');
	btnDiv.css({
		'display' : 'block',
		'position' : 'absolute',
		'top': '55px',
		'left': '50%',
		'transform': 'translate(-50%, 0)'
	});
	btnDiv.appendTo(wrapperDiv);

	var goDiv = $('<button type="button" id="more_review_panel_go">원본보기</button>');
	goDiv.css({
		'padding' : '10px',
		'border' : '0',
		'background-color' : '#29CFAB',
		'border-radius' : '4px',
		'font-size' : '15px'
	});
	goDiv.click(function (e) {
		window.open(click_data.review_click_url);
		return false;
	});
	goDiv.appendTo(btnDiv);

	if(typeof click_data.detail_url !== 'undefined') {
		var detailDiv = $('<button type="button" id="more_review_detail_go">상품보기</button>');
		detailDiv.css({
			'padding': '10px',
			'margin-left': '10px',
			'border': '0',
			'background-color': '#29CFAB',
			'border-radius': '4px',
			'font-size': '15px'
		});
		detailDiv.click(function (e) {
			location.href = click_data.detail_url
		});
		detailDiv.appendTo(btnDiv);
	}

	$('html body').css('overflow', 'hidden');
}

MCro.prototype.closeReviewPanel = function()
{
	var review_element = $('#cro_more_review');
	$('html body').css('overflow', this._bodyOverflowCss);
	review_element.empty();
}

MCro.prototype.MoreRecommendView.prototype.moreRID = function () {
	// Math.random should be unique because of its seeding algorithm.
	// Convert it to base 36 (numbers + letters), and grab the first 9 characters
	// after the decimal.
	return '_' + Math.random().toString(36).substr(2, 9);
}

MCro.prototype.MoreReviewView.prototype.moreRVID = function () {
	// Math.random should be unique because of its seeding algorithm.
	// Convert it to base 36 (numbers + letters), and grab the first 9 characters
	// after the decimal.
	return '_' + Math.random().toString(36).substr(2, 9);
}
