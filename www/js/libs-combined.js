/*
 * jQuery jCarousellite Plugin v1.7.2
 *
 * Date: Sun May 27 23:19:43 2012 EDT
 * Requires: jQuery v1.4+
 *
 * Copyright 2012 Karl Swedberg
 * Copyright 2007 Ganeshji Marwaha (gmarwaha.com)
 * Dual licensed under the MIT and GPL licenses (just like jQuery):
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * jQuery plugin to navigate images/any content in a carousel-style widget.
 *
 */
(function(f){function B(x){if(this.id)this.id+=x}f.jCarouselLite={version:"1.7.2",curr:0};f.fn.jCarouselLite=function(x){var a=f.extend({},f.fn.jCarouselLite.defaults,x);this.each(function(){function y(){return i.slice(d).slice(0,m)}function n(b){if(z)return false;var c=b>d;a.beforeStart&&a.beforeStart.call(this,y(),c);if(a.circular){if(b>d&&b>o-m){d%=j;b-=j;k.css(t,-d*p)}else if(b<d&&b<0){d+=j;b+=j;k.css(t,-d*p)}d=b+b%1}else{if(b<0)b=0;else if(b>o-q)b=o-q;d=b;a.btnPrev&&a.$btnPrev.toggleClass(a.btnDisabledClass,
	d===0);a.btnNext&&a.$btnNext.toggleClass(a.btnDisabledClass,d===o-q)}a.btnGo&&C(d);f.jCarouselLite.curr=d;z=true;D[t]=-(d*p);k.animate(D,a.speed,a.easing,function(){a.afterEnd&&a.afterEnd.call(this,y(),c);z=false});return d}var r={ul:{}},z=false,t=a.vertical?"top":"left",D={},E=a.vertical?"height":"width",h=this,e=f(this),k=e.find("ul").eq(0),l=k.children("li"),j=l.length,u=a.visible,m=Math.ceil(u),q=Math.floor(u),s=Math.min(a.start,j-1),A=1,F=0,v;if(a.init.call(this,a,l)!==false){e.data("dirjc",
	A);if(a.circular){v=l.slice(j-m).clone(true).each(B);l=l.slice(0,m).clone(true).each(B);k.prepend(v).append(l);s+=m;F=m}var C=function(b){b=Math.ceil(b);b=(b-F)%j;var c=f(a.btnGo),g=b+q;c.removeClass(a.activeClass).removeClass(a.visibleClass);c.eq(b).addClass(a.activeClass);c.slice(b,b+q).addClass(a.visibleClass);g>c.length&&c.slice(0,g-c.length).addClass(a.visibleClass);return b},i=k.children("li"),o=i.length,d=s,p=a.vertical?i.outerHeight(true):i.outerWidth(true);v=p*o;l=p*u;f.jCarouselLite.curr=
	d;if(a.autoCSS){e.css({visibility:"visible",overflow:"hidden",position:"relative",zIndex:2,left:"0px"});k.css({margin:"0",padding:"0",position:"relative",listStyleType:"none",zIndex:1});i.css({overflow:a.vertical?"hidden":"visible","float":a.vertical?"none":"left"});r.div={};r.div[E]=l+"px";e.css(r.div);i.css({width:i.width(),height:i.height()});r.ul[E]=v+"px";r.ul[t]=-(d*p)+"px";k.css(r.ul)}var G=0,H=a.autoStop&&(a.circular?a.autoStop:Math.min(j,a.autoStop)),I=typeof a.auto=="number"?a.auto:a.scroll,
	w=function(){h.setAutoAdvance=setTimeout(function(){if(!H||H>G){A=e.data("dirjc");n(d+A*I);G++;w()}},a.timeout)};f.each(["btnPrev","btnNext"],function(b,c){if(a[c]){a["$"+c]=f.isFunction(a[c])?a[c].call(e[0]):f(a[c]);a["$"+c].bind("click.jc",function(g){g.preventDefault();g=b===0?d-a.scroll:d+a.scroll;if(a.directional)e.data("dirjc",b?1:-1);return n(g)})}});if(!a.circular){a.btnPrev&&s===0&&a.$btnPrev.addClass(a.btnDisabledClass);a.btnNext&&s+q>=o&&a.$btnNext.addClass(a.btnDisabledClass)}if(a.btnGo){f.each(a.btnGo,
	function(b,c){f(c).bind("click.jc",function(g){g.preventDefault();return n(a.circular?u+b:b)})});C(s)}a.mouseWheel&&e.mousewheel&&e.bind("mousewheel.jc",function(b,c){return c>0?n(d-a.scroll):n(d+a.scroll)});a.pause&&a.auto&&e.bind("mouseenter.jc",function(){e.trigger("pauseCarousel.jc")}).bind("mouseleave.jc",function(){e.trigger("resumeCarousel.jc")});a.auto&&w();f.jCarouselLite.vis=y;e.bind("go.jc",function(b,c){if(typeof c=="undefined")c="+=1";var g=typeof c=="string"&&/(\+=|-=)(\d+)/.exec(c);
	if(g)c=g[1]=="-="?d-g[2]*1:d+g[2]*1;else c+=s;n(c)}).bind("startCarousel.jc",function(){clearTimeout(h.setAutoAdvance);h.setAutoAdvance=undefined;e.trigger("go","+="+a.scroll);w();e.removeData("pausedjc").removeData("stoppedjc")}).bind("resumeCarousel.jc",function(b,c){if(!h.setAutoAdvance){clearTimeout(h.setAutoAdvance);h.setAutoAdvance=undefined;var g=e.data("stoppedjc");if(c||!g){w();e.removeData("pausedjc");g&&e.removeData("stoppedjc")}}}).bind("pauseCarousel.jc",function(){clearTimeout(h.setAutoAdvance);
		h.setAutoAdvance=undefined;e.data("pausedjc",true)}).bind("stopCarousel.jc",function(){clearTimeout(h.setAutoAdvance);h.setAutoAdvance=undefined;e.data("stoppedjc",true)}).bind("endCarousel.jc",function(){if(h.setAutoAdvance){clearTimeout(h.setAutoAdvance);h.setAutoAdvance=undefined}a.btnPrev&&a.$btnPrev.addClass(a.btnDisabledClass).unbind(".jc");a.btnNext&&a.$btnNext.addClass(a.btnDisabledClass).unbind(".jc");a.btnGo&&f.each(a.btnGo,function(b,c){f(c).unbind(".jc")});f.each(["pausedjc","stoppedjc",
		"dirjc"],function(b,c){e.removeData(c)});e.unbind(".jc")})}});return this};f.fn.jCarouselLite.defaults={autoCSS:true,btnPrev:null,btnNext:null,btnDisabledClass:"disabled",btnGo:null,activeClass:"active",visibleClass:"vis",mouseWheel:false,speed:200,easing:null,timeout:4E3,auto:false,directional:false,autoStop:false,pause:true,vertical:false,circular:true,visible:3,start:0,scroll:1,init:function(){},beforeStart:null,afterEnd:null}})(jQuery);
/* jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/ */
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
/* Mousewheel 3.0.6*/
(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);
