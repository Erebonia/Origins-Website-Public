

function _defineProperties(e, t) {
    for (var i = 0; i < t.length; i++) {
        var o = t[i];
        o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
}

function _createClass(e, t, i) {
    return t && _defineProperties(e.prototype, t), i && _defineProperties(e, i), e
}

function _extends() {
    return (_extends = Object.assign || function(e) {
        for (var t = 1; t < arguments.length; t++) {
            var i = arguments[t];
            for (var o in i) Object.prototype.hasOwnProperty.call(i, o) && (e[o] = i[o])
        }
        return e
    }).apply(this, arguments)
}

function _defineProperties(e, t) {
    for (var i = 0; i < t.length; i++) {
        var o = t[i];
        o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
}

function _createClass(e, t, i) {
    return t && _defineProperties(e.prototype, t), i && _defineProperties(e, i), e
}

function _extends() {
    return (_extends = Object.assign || function(e) {
        for (var t = 1; t < arguments.length; t++) {
            var i = arguments[t];
            for (var o in i) Object.prototype.hasOwnProperty.call(i, o) && (e[o] = i[o])
        }
        return e
    }).apply(this, arguments)
}

function _defineProperties(e, t) {
    for (var i = 0; i < t.length; i++) {
        var o = t[i];
        o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
}
function _createClass(e, t, i) {
    return t && _defineProperties(e.prototype, t), i && _defineProperties(e, i), e
}
$(document).ready(function() {
	function e() {
        i > 60 ? ($(".navbar").addClass("scrolled"), $(".toTop").addClass("show")) : ($(".navbar").removeClass("scrolled"), $(".toTop").removeClass("show"))
    }
    var t = $("body"),
        i = $(window).scrollTop(),
        o = $(".floating-navigation");
    $(window).scroll(function() {
        i = $(window).scrollTop(), e()
    }), e();
	$(document).on("submit", ".loginform", function(e) {
        e.preventDefault(), $this = $(this), $button = $this.find('button[type="submit"]'), $button.prop("disabled", !0).text("Please wait...");
        var t = $this.attr("action");
        setTimeout(function() {
            $.post(t, $this.serialize(), function(e) {
                try {
                    if (1 == (e = jQuery.parseJSON(e)).status) return $.growl.notice({
                        message: "You have been logged in successfully."
                    }), setTimeout(function() {
                        window.location.reload()
                    }, 500), void $button.prop("disabled", !1);
                    $.growl.error({
                        message: e.message
                    })
                } catch (e) {
                    console.log(e)
                }
                $button.prop("disabled", !1).text("Login")
            })
        }, 200)
    }),$(".floatingnav-collapse").on("click", function(e) {
        e.preventDefault(), o.hasClass("in") ? o.removeClass("in") && t.removeClass("mobile-nav-active") : o.addClass("in") && t.addClass("mobile-nav-active")
    }), $(".login-form-right .dropdown-toggle>a").on("click", function(e) {
        e.preventDefault(), $this = $(this), $this.parent().hasClass("show") ? $this.parent().removeClass("show") : $this.parent().addClass("show")
    }), $(".float-nav-toggle").on("click", function(e) {
        e.preventDefault(), $this = $(this), o.hasClass("show") ? o.removeClass("show") : o.addClass("show")
    }), $(".character-tab a").on("click", function(e) {
        e.preventDefault();
        var t = $(this).attr("href");
        $(this).closest(".character-tab").find("a").removeClass("active"), $(this).addClass("active"), $char_equips = $(this).closest(".character_equip_view").find(".character-equips"), $char_equips.removeClass("general costume"), $char_equips.addClass(t)
    }), $(".toTop").on("click", function(e) {
        e.preventDefault(), $("html, body").animate({
            scrollTop: 0
        }, "slow")
    }),	$(document).on('submit', '.loginform', function(event) {
		event.preventDefault();
		$this = $(this);
		$button = $this.find('button[type="submit"]');
		$button.prop('disabled', true).text('Please wait...');
		var url = $this.attr('action');
		setTimeout(function(){
			$.post(url, $this.serialize(), function(data) {
				try {
					data = jQuery.parseJSON(data);
					if(data.status == 1) {
						$.growl.notice({ message: "You have been logged in successfully." });
						setTimeout(function(){ window.location.reload(); }, 500);
						$button.prop('disabled', false);
						return;
					} else {
						$.growl.error({ message: data.message });
					}
				} catch(e){
					console.log(e);
				}
				$button.prop('disabled', false).text('Login');
			});
		}, 200);
	});
});

function processDateFields(){
	var dateFields = new Array();
	var dateName;
	var dateCheckBox;
	var dateSelects;
	var dateSelects2;
	
	$(':checkbox').filter(function(){
		return /^use_/.test($(this).attr('id'));
	}).each(function(){
		dateFields[dateFields.length] = this.id.substr('use_'.length);
	});
	
	for (var i = 0; i < dateFields.length; ++i) {
		dateName     = dateFields[i];
		dateCheckBox = $('#use_'+dateName);
		dateSelects  = $('select[name='+dateName+'_year],select[name='+dateName+'_month],select[name='+dateName+'_day]');
		dateSelects2 = $('select[name='+dateName+'_hour],select[name='+dateName+'_minute],select[name='+dateName+'_second]');

		processDateInit(dateCheckBox, dateSelects, dateSelects2);
		processDateBoxes(dateCheckBox, dateSelects, dateSelects2);
	}	
}

function processDateInit(dateCheckBox, dateSelects, dateSelects2){
	if ($(dateCheckBox).attr('checked')) {
		dateEnable(dateSelects);
		dateEnable(dateSelects2);
	}
	else {
		dateDisable(dateSelects);
		dateDisable(dateSelects2);
	}
}

function processDateBoxes(dateCheckBox, dateSelects, dateSelects2){
	$(dateCheckBox).click(function(){
		processDateInit(dateCheckBox, dateSelects, dateSelects2);
	});
}

function dateEnable(sel){
	sel.attr('disabled', false);
}

function dateDisable(sel){
	sel.attr('disabled', 'disabled');
}

// uniTip - written by Nathan Ford for Unit Interactive
//
// uniTip is based on qTip:
// qTip - CSS Tool Tips - by Craig Erskine
// http://qrayg.com

var uniTipTag = "*"; //Which tag do you want to uniTip-ize? Keep it lowercase. No spaces around commas.//
var uniTipClass = ""; //Which classes do you want to uniTip-ize? If you leave this blank, then all the tags designated above will get uniTip-ized. Match case. No spaces around commas.

var uniTipX = 0; // X offset from cursor//
var uniTipY = 15; // Y offset from cursor//

//______________________________________________There's no need to edit anything below this line//

var offsetX = uniTipX, offsetY = uniTipY, elewidth = null, eleheight = null, tipid = null, tiptop = null, tipbot = null, tipcapin=null, tippointin=null, altText=false;

var x=0, y=0, WinWidth=0, WinHeight=0, TipWidth=0, TipHeight=0, CapHeight=0, PointHeight=0;

// first, find all the correct elements
init = function () {
	var elementList = uniTipTag.split(",");
	for(var j = 0; j < elementList.length; j++) {	
		var elements = document.getElementsByTagName(elementList[j]);
		
		if(elements) {
			for (var i = 0; i < elements.length; i ++) {
				if (uniTipClass != '') {
				
					var elClass = elements[i].className;
					var elClassList = uniTipClass.split(",");
					
					for (var h=0; h < elClassList.length; h++) { if (elClass.match(elClassList[h])) unitipize(elements[i]); }
					
				} else unitipize(elements[i]);
			}
		}
	}
}

// next, add the tooltip function to those elements
unitipize = function (element) {
	var a = element;
	var id = a.getAttribute('id');
	
	if (id != null && id.indexOf('recaptcha_') == 0) {
		return;
	}
	
	//altText = (a.alt && a.getAttribute("alt") != '' ) ? true : false;
	//var sTitle = (altText == true) ? a.getAttribute("alt") : a.getAttribute("title");				
	var sTitle = a.getAttribute('title');
	if(sTitle) {
		a.onmouseover = function() {build(a, sTitle);};
		a.onmouseout = function() {hide(a, sTitle);};
	}
}

// now, we build the tooltip
build = function (a, sTitle) {
	
	if (a.title) a.title = "";
	if (altText==true) a.alt = "";
	
	var tipContainer = document.createElement("div");
	tipContainer.setAttribute("id", "unitip");
	document.body.appendChild(tipContainer);
	
	var tipContainerTop = document.createElement("div");
	tipContainerTop.setAttribute("id", "unitippoint");
	tipContainer.appendChild(tipContainerTop);
	
	var tipContainerMid = document.createElement("div");
	tipContainerMid.setAttribute("id", "unitipmid");
	tipContainer.appendChild(tipContainerMid);
	
	var tipContainerBot = document.createElement("div");
	tipContainerBot.setAttribute("id", "unitipcap");
	tipContainer.appendChild(tipContainerBot);

	tipid = document.getElementById("unitip");
	tippoint = document.getElementById("unitippoint");
	tipmid = document.getElementById("unitipmid");
	tipcap = document.getElementById("unitipcap");
	
	document.getElementById("unitipmid").innerHTML = sTitle;
	tipid.style.display = "block";
	
	elewidth = document.getElementById("unitipmid").offsetWidth;
	eleheight = document.getElementById("unitip").offsetHeight;
	
	WinWidth = document.body.offsetWidth;
	WinHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight : document.documentElement.clientHeight;
	
	CapHeight = document.getElementById('unitipcap').offsetHeight;
	PointHeight = document.getElementById('unitippoint').offsetHeight;
	
	if (typeof pngfix=="function") { // if IE, rebuilds wraps unitippoint and unitipcap in outer div
		if (tippoint.currentStyle.backgroundImage.match(/\.png/gi)) {
			var tipP = tippoint.innerHTML;
			
			tippoint.id = 'unitipP'; // switch unitippoint to outer div
			
			tippoint.style.overflow = "hidden";
			tippoint.style.height = PointHeight + "px";
			tippoint.style.width = elewidth + "px";
			tippoint.style.position = "relative";
			tippoint.style.display = "block";
			
			tippoint.innerHTML = '<div id="unitippoint">' + tipP + '</div>'; // inject unitippoint
			
			tippointin = document.getElementById("unitippoint");  // redefine styles for unitippoint to fit filter image
			tippointin.style.width = (elewidth * 2) + "px";
			tippointin.style.height = (PointHeight * 2) + "px";
			tippointin.style.backgroundImage = tippoint.style.backgroundImage;
			tippointin.style.position = "absolute";
			
			tippoint.style.backgroundImage = "none";
		}
		if (tipcap.currentStyle.backgroundImage.match(/\.png/gi)) {
			var tipC = tipcap.innerHTML;
			
			tipcap.id = 'unitipC';
			
			tipcap.style.overflow = "hidden";
			tipcap.style.height = CapHeight + "px";
			tipcap.style.width = elewidth + "px";
			tipcap.style.position = "relative";
			tipcap.style.display = "block";
			
			tipcap.innerHTML = '<div id="unitipcap">' + tipP + '</div>';
			
			tipcapin = document.getElementById("unitipcap");
			tipcapin.style.height = (CapHeight * 2) + "px";
			tipcapin.style.backgroundImage = tipcap.style.backgroundImage;
			tipcapin.style.position = "absolute";
			
			tipcap.style.backgroundImage = "none";
		}
		
		pngfix(); // png fix
		
	}
	
	document.onmousemove = function (evt) {move (evt)};
}

// now, we track the mouse and make the tooltip follow
move = function (evt) {
	
	if (window.event) {
		x = window.event.clientX;
		y = window.event.clientY;
		
		if (document.documentElement.scrollLeft) tipid.style.left = (TipWidth >= WinWidth ) ? ((x - offsetX - elewidth) + document.documentElement.scrollLeft) + "px" :  (x + offsetX + document.documentElement.scrollLeft) + "px";
		else tipid.style.left = (TipWidth >= WinWidth ) ? ((x - offsetX - elewidth) + document.body.scrollLeft) + "px" :  (x + offsetX + document.body.scrollLeft) + "px";
		
		if (document.documentElement.scrollTop) tipid.style.top = (TipHeight >= WinHeight) ? ((y - offsetY - eleheight) + document.documentElement.scrollTop) + "px" : (y + offsetY + document.documentElement.scrollTop) + "px";
		else tipid.style.top = (TipHeight >= WinHeight) ? ((y - offsetY - eleheight) + document.body.scrollTop) + "px" : (y + offsetY + document.body.scrollTop) + "px";
		
	} else {
		x = evt.clientX;
		y = evt.clientY;	
		
		tipid.style.left = (TipWidth >= WinWidth ) ? ((x - offsetX - elewidth) + window.scrollX) + "px" :  (x + offsetX + window.scrollX) + "px";
		tipid.style.top = (TipHeight >= WinHeight) ? ((y - offsetY - eleheight) + window.scrollY) + "px" : (y + offsetY + window.scrollY) + "px";
	}
	
	TipWidth = x + elewidth + 20;
	TipHeight = y + eleheight + 20;
	
	if (TipHeight >= WinHeight ) { // rearrange the inner divs [123 to 321]
		tipid.removeChild(tippoint);
		tipid.removeChild(tipmid);
		tipid.removeChild(tipcap);
		tipid.appendChild(tipcap);
		tipid.appendChild(tipmid);
		tipid.appendChild(tippoint);
	} else {  // rearrange the inner divs [321 to 123]
		tipid.removeChild(tippoint);
		tipid.removeChild(tipmid);
		tipid.removeChild(tipcap);
		tipid.appendChild(tippoint);
		tipid.appendChild(tipmid);
		tipid.appendChild(tipcap);
	}
	
	if (TipHeight >= WinHeight) {
		
		if (document.getElementById('uniTipP')) {
			tippointin.style.left = (TipWidth >= WinWidth ) ? "-" + elewidth + "px" : "0px";
			tippointin.style.top = "-" + PointHeight + "px";
		} else tippoint.style.backgroundPosition = (TipWidth >= WinWidth ) ? "right bottom" : "left bottom";
		
		if (document.getElementById('uniTipC')) tipcapin.style.top = "-" + CapHeight + "px";
		else tipcap.style.backgroundPosition = "0 -" + CapHeight + "px";
		
	} else {
		
		if (document.getElementById('uniTipP')) {
			tippointin.style.left = (TipWidth >= WinWidth ) ? "-" + elewidth + "px" : "0px";
			tippointin.style.top = "0px";
		} else tippoint.style.backgroundPosition = (TipWidth >= WinWidth ) ? "right top" : "left top";
		
		if (document.getElementById('uniTipC')) tipcapin.style.top = "0px";
		else tipcap.style.backgroundPosition = "0 0";
		
	}
}

// lastly, hide the tooltip
hide = function (a, sTitle) {
	document.getElementById("unitipmid").innerHTML = "";
	document.onmousemove = '';
	document.body.removeChild(tipid);
	tipid.style.display = "none";
	if (altText==false) a.setAttribute("title", sTitle);
	else a.setAttribute("alt", sTitle);
	altText=false;
}

// add the event to the page
if (window.addEventListener) window.addEventListener("load", init, false);
if (window.attachEvent) window.attachEvent("onload", init);