!function(){var s=void 0;!function o(u,s,a){function c(n,t){if(!s[n]){if(!u[n]){var e=!1;if(!t&&e)return e(n,!0);if(f)return f(n,!0);var r=new Error("Cannot find module '"+n+"'");throw r.code="MODULE_NOT_FOUND",r}var i=s[n]={exports:{}};u[n][0].call(i.exports,function(t){var e=u[n][1][t];return c(e||t)},i,i.exports,o,u,s,a)}return s[n].exports}for(var f=!1,t=0;t<a.length;t++)c(a[t]);return c}({1:[function(t,e,n){"use strict";var r,i=t("./forms/conditional-elements.js"),o=(r=i)&&r.__esModule?r:{default:r};var u,s,a,c,f,l,h=window.mc4wp||{},d=t("gator"),p=t("./forms/forms.js"),m=window.mc4wp_forms_config||{},v=t("scroll-to-element");function g(t){var e="animated"===m.auto_scroll;v(t.element,{duration:e?800:1,alignment:"middle"})}if(d(document.body).on("submit",".mc4wp-form",function(t){var e=p.getByElement(t.target||t.srcElement);p.trigger("submit",[e,t]),p.trigger(e.id+".submit",[e,t])}),d(document.body).on("focus",".mc4wp-form",function(t){var e=p.getByElement(t.target||t.srcElement);e.started||(p.trigger("started",[e,t]),p.trigger(e.id+".started",[e,t]),e.started=!0)}),d(document.body).on("change",".mc4wp-form",function(t){var e=p.getByElement(t.target||t.srcElement);p.trigger("change",[e,t]),p.trigger(e.id+".change",[e,t])}),o.default.init(),h.listeners){for(var y=h.listeners,w=0;w<y.length;w++)p.on(y[w].event,y[w].callback);delete h.listeners}if(h.forms=p,m.submitted_form){var b=m.submitted_form,_=document.getElementById(b.element_id),E=p.getByElement(_);u=E,s=b.action,a=b.errors,c=b.data,f=Date.now(),l=document.body.clientHeight,a&&u.setData(c),window.scrollY<=10&&m.auto_scroll&&g(u),window.addEventListener("load",function(){p.trigger("submitted",[u]),p.trigger(u.id+".submitted",[u]),a?(p.trigger("error",[u,a]),p.trigger(u.id+".error",[u,a])):(p.trigger("success",[u,c]),p.trigger(u.id+".success",[u,c]),p.trigger(s+"d",[u,c]),p.trigger(u.id+"."+s+"d",[u,c]));var t=Date.now()-f;m.auto_scroll&&1e3<t&&t<2e3&&document.body.clientHeight!=l&&g(u)})}window.mc4wp=h},{"./forms/conditional-elements.js":2,"./forms/forms.js":4,gator:12,"scroll-to-element":14}],2:[function(t,e,n){"use strict";function r(t){for(var e=!!t.getAttribute("data-show-if"),n=e?t.getAttribute("data-show-if").split(":"):t.getAttribute("data-hide-if").split(":"),r=n[0],i=(1<n.length?n[1]:"*").split("|"),o=function(t,e){for(var n=[],r=t.querySelectorAll('input[name="'+e+'"], select[name="'+e+'"], textarea[name="'+e+'"]'),i=0;i<r.length;i++){var o=r[i],u=o.getAttribute("type");("radio"!==u&&"checkbox"!==u||o.checked)&&n.push(o.value)}return n}(function(t){for(var e=t;e.parentElement;)if("FORM"===(e=e.parentElement).tagName)return e;return null}(t),r),u=!1,s=0;s<o.length;s++){var a=o[s];if(u=-1<i.indexOf(a)||-1<i.indexOf("*")&&0<a.length)break}t.style.display=e?u?"":"none":u?"none":"";var c=t.querySelectorAll("input, select, textarea");[].forEach.call(c,function(t){(u||e)&&t.getAttribute("data-was-required")&&(t.required=!0,t.removeAttribute("data-was-required")),u&&e||!t.required||(t.setAttribute("data-was-required","true"),t.required=!1)})}function i(){var t=document.querySelectorAll(".mc4wp-form [data-show-if], .mc4wp-form [data-hide-if]");[].forEach.call(t,r)}function o(t){if(t.target&&t.target.form&&!(t.target.form.className.indexOf("mc4wp-form")<0)){var e=t.target.form.querySelectorAll("[data-show-if], [data-hide-if]");[].forEach.call(e,r)}}Object.defineProperty(n,"__esModule",{value:!0}),n.default={init:function(){document.addEventListener("keyup",o,!0),document.addEventListener("change",o,!0),document.addEventListener("mc4wp-refresh",i,!0),window.addEventListener("load",i),i()}}},{}],3:[function(t,e,n){"use strict";var r=t("form-serialize"),i=t("populate.js"),o=function(t,e){this.id=t,this.element=e||document.createElement("form"),this.name=this.element.getAttribute("data-name")||"Form #"+this.id,this.errors=[],this.started=!1};o.prototype.setData=function(t){try{i(this.element,t)}catch(t){console.error(t)}},o.prototype.getData=function(){return r(this.element,{hash:!0,empty:!0})},o.prototype.getSerializedData=function(){return r(this.element,{hash:!1,empty:!0})},o.prototype.setResponse=function(t){this.element.querySelector(".mc4wp-response").innerHTML=t},o.prototype.reset=function(){this.setResponse(""),this.element.querySelector(".mc4wp-form-fields").style.display="",this.element.reset()},e.exports=o},{"form-serialize":11,"populate.js":13}],4:[function(t,e,n){"use strict";var r=t("wolfy87-eventemitter"),i=t("./form.js"),o=new r,u=[];function s(t,e){e=e||parseInt(t.getAttribute("data-id"))||0;var n=new i(e,t);return u.push(n),n}e.exports={all:function(){return u},get:function(t){for(var e=0;e<u.length;e++)if(u[e].id==t)return u[e];return s(document.querySelector(".mc4wp-form-"+t),t)},getByElement:function(t){for(var e=t.form||t,n=0;n<u.length;n++)if(u[n].element==e)return u[n];return s(e)},on:o.on.bind(o),trigger:function(t,e){"submit"===t?o.trigger(t,e):window.setTimeout(function(){o.trigger(t,e)},1)},off:o.off.bind(o)}},{"./form.js":3,"wolfy87-eventemitter":16}],5:[function(e,t,n){var s;try{s=e("component-type")}catch(t){s=e("type")}t.exports=function t(e){switch(s(e)){case"object":var n={};for(var r in e)e.hasOwnProperty(r)&&(n[r]=t(e[r]));return n;case"array":for(var n=new Array(e.length),i=0,o=e.length;i<o;i++)n[i]=t(e[i]);return n;case"regexp":var u="";return u+=e.multiline?"m":"",u+=e.global?"g":"",u+=e.ignoreCase?"i":"",new RegExp(e.source,u);case"date":return new Date(e.getTime());default:return e}}},{"component-type":9,type:9}],6:[function(t,e,n){function r(t){if(t)return function(t){for(var e in r.prototype)t[e]=r.prototype[e];return t}(t)}(e.exports=r).prototype.on=r.prototype.addEventListener=function(t,e){return this._callbacks=this._callbacks||{},(this._callbacks["$"+t]=this._callbacks["$"+t]||[]).push(e),this},r.prototype.once=function(t,e){function n(){this.off(t,n),e.apply(this,arguments)}return n.fn=e,this.on(t,n),this},r.prototype.off=r.prototype.removeListener=r.prototype.removeAllListeners=r.prototype.removeEventListener=function(t,e){if(this._callbacks=this._callbacks||{},0==arguments.length)return this._callbacks={},this;var n,r=this._callbacks["$"+t];if(!r)return this;if(1==arguments.length)return delete this._callbacks["$"+t],this;for(var i=0;i<r.length;i++)if((n=r[i])===e||n.fn===e){r.splice(i,1);break}return this},r.prototype.emit=function(t){this._callbacks=this._callbacks||{};var e=[].slice.call(arguments,1),n=this._callbacks["$"+t];if(n)for(var r=0,i=(n=n.slice(0)).length;r<i;++r)n[r].apply(this,e);return this},r.prototype.listeners=function(t){return this._callbacks=this._callbacks||{},this._callbacks["$"+t]||[]},r.prototype.hasListeners=function(t){return!!this.listeners(t).length}},{}],7:[function(t,e,n){n=e.exports=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(t){var e=(new Date).getTime(),n=Math.max(0,16-(e-i)),r=setTimeout(t,n);return i=e,r};var i=(new Date).getTime();var r=window.cancelAnimationFrame||window.webkitCancelAnimationFrame||window.mozCancelAnimationFrame||window.clearTimeout;n.cancel=function(t){r.call(window,t)}},{}],8:[function(t,e,n){var r=t("emitter"),i=t("clone"),o=t("type"),u=t("ease");function s(t){if(!(this instanceof s))return new s(t);this._from=t,this.ease("linear"),this.duration(500)}r((e.exports=s).prototype),s.prototype.reset=function(){return this.isArray="array"===o(this._from),this._curr=i(this._from),this._done=!1,this._start=Date.now(),this},s.prototype.to=function(t){return this.reset(),this._to=t,this},s.prototype.duration=function(t){return this._duration=t,this},s.prototype.ease=function(t){if(!(t="function"==typeof t?t:u[t]))throw new TypeError("invalid easing function");return this._ease=t,this},s.prototype.stop=function(){return this.stopped=!0,this._done=!0,this.emit("stop"),this.emit("end"),this},s.prototype.step=function(){if(!this._done){var t=this._duration,e=Date.now();if(t<=e-this._start)return this._from=this._to,this._update(this._to),this._done=!0,this.emit("end"),this;var n=this._from,r=this._to,i=this._curr,o=(0,this._ease)((e-this._start)/t);if(this.isArray){for(var u=0;u<n.length;++u)i[u]=n[u]+(r[u]-n[u])*o;return this._update(i),this}for(var s in n)i[s]=n[s]+(r[s]-n[s])*o;return this._update(i),this}},s.prototype.update=function(t){return 0==arguments.length?this.step():(this._update=t,this)}},{clone:5,ease:10,emitter:6,type:9}],9:[function(t,e,n){var r=Object.prototype.toString;e.exports=function(t){switch(r.call(t)){case"[object Date]":return"date";case"[object RegExp]":return"regexp";case"[object Arguments]":return"arguments";case"[object Array]":return"array";case"[object Error]":return"error"}return null===t?"null":void 0===t?"undefined":t!=t?"nan":t&&1===t.nodeType?"element":typeof(t=t.valueOf?t.valueOf():Object.prototype.valueOf.apply(t))}},{}],10:[function(t,e,n){n.linear=function(t){return t},n.inQuad=function(t){return t*t},n.outQuad=function(t){return t*(2-t)},n.inOutQuad=function(t){return(t*=2)<1?.5*t*t:-.5*(--t*(t-2)-1)},n.inCube=function(t){return t*t*t},n.outCube=function(t){return--t*t*t+1},n.inOutCube=function(t){return(t*=2)<1?.5*t*t*t:.5*((t-=2)*t*t+2)},n.inQuart=function(t){return t*t*t*t},n.outQuart=function(t){return 1- --t*t*t*t},n.inOutQuart=function(t){return(t*=2)<1?.5*t*t*t*t:-.5*((t-=2)*t*t*t-2)},n.inQuint=function(t){return t*t*t*t*t},n.outQuint=function(t){return--t*t*t*t*t+1},n.inOutQuint=function(t){return(t*=2)<1?.5*t*t*t*t*t:.5*((t-=2)*t*t*t*t+2)},n.inSine=function(t){return 1-Math.cos(t*Math.PI/2)},n.outSine=function(t){return Math.sin(t*Math.PI/2)},n.inOutSine=function(t){return.5*(1-Math.cos(Math.PI*t))},n.inExpo=function(t){return 0==t?0:Math.pow(1024,t-1)},n.outExpo=function(t){return 1==t?t:1-Math.pow(2,-10*t)},n.inOutExpo=function(t){return 0==t?0:1==t?1:(t*=2)<1?.5*Math.pow(1024,t-1):.5*(2-Math.pow(2,-10*(t-1)))},n.inCirc=function(t){return 1-Math.sqrt(1-t*t)},n.outCirc=function(t){return Math.sqrt(1- --t*t)},n.inOutCirc=function(t){return(t*=2)<1?-.5*(Math.sqrt(1-t*t)-1):.5*(Math.sqrt(1-(t-=2)*t)+1)},n.inBack=function(t){return t*t*(2.70158*t-1.70158)},n.outBack=function(t){return--t*t*(2.70158*t+1.70158)+1},n.inOutBack=function(t){var e=2.5949095;return(t*=2)<1?t*t*((e+1)*t-e)*.5:.5*((t-=2)*t*((e+1)*t+e)+2)},n.inBounce=function(t){return 1-n.outBounce(1-t)},n.outBounce=function(t){return t<1/2.75?7.5625*t*t:t<2/2.75?7.5625*(t-=1.5/2.75)*t+.75:t<2.5/2.75?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375},n.inOutBounce=function(t){return t<.5?.5*n.inBounce(2*t):.5*n.outBounce(2*t-1)+.5},n["in-quad"]=n.inQuad,n["out-quad"]=n.outQuad,n["in-out-quad"]=n.inOutQuad,n["in-cube"]=n.inCube,n["out-cube"]=n.outCube,n["in-out-cube"]=n.inOutCube,n["in-quart"]=n.inQuart,n["out-quart"]=n.outQuart,n["in-out-quart"]=n.inOutQuart,n["in-quint"]=n.inQuint,n["out-quint"]=n.outQuint,n["in-out-quint"]=n.inOutQuint,n["in-sine"]=n.inSine,n["out-sine"]=n.outSine,n["in-out-sine"]=n.inOutSine,n["in-expo"]=n.inExpo,n["out-expo"]=n.outExpo,n["in-out-expo"]=n.inOutExpo,n["in-circ"]=n.inCirc,n["out-circ"]=n.outCirc,n["in-out-circ"]=n.inOutCirc,n["in-back"]=n.inBack,n["out-back"]=n.outBack,n["in-out-back"]=n.inOutBack,n["in-bounce"]=n.inBounce,n["out-bounce"]=n.outBounce,n["in-out-bounce"]=n.inOutBounce},{}],11:[function(t,e,n){var v=/^(?:submit|button|image|reset|file)$/i,g=/^(?:input|select|textarea|keygen)/i,i=/(\[[^\[\]]*\])/g;function y(t,e,n){if(e.match(i)){!function t(e,n,r){if(0===n.length)return e=r;var i=n.shift(),o=i.match(/^\[(.+?)\]$/);if("[]"===i)return e=e||[],Array.isArray(e)?e.push(t(null,n,r)):(e._values=e._values||[],e._values.push(t(null,n,r))),e;if(o){var u=o[1],s=+u;isNaN(s)?(e=e||{})[u]=t(e[u],n,r):(e=e||[])[s]=t(e[s],n,r)}else e[i]=t(e[i],n,r);return e}(t,function(t){var e=[],n=new RegExp(i),r=/^([^\[\]]*)/.exec(t);for(r[1]&&e.push(r[1]);null!==(r=n.exec(t));)e.push(r[1]);return e}(e),n)}else{var r=t[e];r?(Array.isArray(r)||(t[e]=[r]),t[e].push(n)):t[e]=n}return t}function w(t,e,n){return n=n.replace(/(\r)?\n/g,"\r\n"),n=(n=encodeURIComponent(n)).replace(/%20/g,"+"),t+(t?"&":"")+encodeURIComponent(e)+"="+n}e.exports=function(t,e){"object"!=typeof e?e={hash:!!e}:void 0===e.hash&&(e.hash=!0);for(var n=e.hash?{}:"",r=e.serializer||(e.hash?y:w),i=t&&t.elements?t.elements:[],o=Object.create(null),u=0;u<i.length;++u){var s=i[u];if((e.disabled||!s.disabled)&&s.name&&g.test(s.nodeName)&&!v.test(s.type)){var a=s.name,c=s.value;if("checkbox"!==s.type&&"radio"!==s.type||s.checked||(c=void 0),e.empty){if("checkbox"!==s.type||s.checked||(c=""),"radio"===s.type&&(o[s.name]||s.checked?s.checked&&(o[s.name]=!0):o[s.name]=!1),null==c&&"radio"==s.type)continue}else if(!c)continue;if("select-multiple"!==s.type)n=r(n,a,c);else{c=[];for(var f=s.options,l=!1,h=0;h<f.length;++h){var d=f[h],p=e.empty&&!d.value,m=d.value||p;d.selected&&m&&(l=!0,n=e.hash&&"[]"!==a.slice(a.length-2)?r(n,a+"[]",d.value):r(n,a,d.value))}!l&&e.empty&&(n=r(n,a,""))}}}if(e.empty)for(var a in o)o[a]||(n=r(n,a,""));return n}},{}],12:[function(t,e,n){!function(){var i,l=0,r=0,h={},d={};function p(t,e,n){return"_root"==e?n:t!==n?(r=t,i||(i=r.matches?r.matches:r.webkitMatchesSelector?r.webkitMatchesSelector:r.mozMatchesSelector?r.mozMatchesSelector:r.msMatchesSelector?r.msMatchesSelector:r.oMatchesSelector?r.oMatchesSelector:v.matchesSelector)).call(t,e)?t:t.parentNode?(l++,p(t.parentNode,e,n)):void 0:void 0;var r}function m(t,e,n,r){if(h[t.id])if(e)if(r||n)if(r){if(h[t.id][e][n])for(var i=0;i<h[t.id][e][n].length;i++)if(h[t.id][e][n][i]===r){h[t.id][e][n].splice(i,1);break}}else delete h[t.id][e][n];else h[t.id][e]={};else for(var o in h[t.id])h[t.id].hasOwnProperty(o)&&(h[t.id][o]={})}function o(t,e,n,r){if(this.element){t instanceof Array||(t=[t]),n||"function"!=typeof e||(n=e,e="_root");var i,o,u,s,a,c=this.id;for(i=0;i<t.length;i++)r?m(this,t[i],e,n):(h[c]&&h[c][t[i]]||v.addEvent(this,t[i],f(t[i])),o=this,u=t[i],s=e,a=n,h[o.id]||(h[o.id]={}),h[o.id][u]||(h[o.id][u]={}),h[o.id][u][s]||(h[o.id][u][s]=[]),h[o.id][u][s].push(a));return this}function f(e){return function(t){!function(t,e,n){if(h[t][n]){var r,i,o=e.target||e.srcElement,u={},s=0,a=0;for(r in l=0,h[t][n])h[t][n].hasOwnProperty(r)&&(i=p(o,r,d[t].element))&&v.matchesEvent(n,d[t].element,i,"_root"==r,e)&&(l++,h[t][n][r].match=i,u[l]=h[t][n][r]);for(e.stopPropagation=function(){e.cancelBubble=!0},s=0;s<=l;s++)if(u[s])for(a=0;a<u[s].length;a++){if(!1===u[s][a].call(u[s].match,e))return v.cancel(e);if(e.cancelBubble)return}}}(c,t,e)}}}function v(t,e){if(!(this instanceof v)){for(var n in d)if(d[n].element===t)return d[n];return d[++r]=new v(t,r),d[r]}this.element=t,this.id=e}v.prototype.on=function(t,e,n){return o.call(this,t,e,n)},v.prototype.off=function(t,e,n){return o.call(this,t,e,n,!0)},v.matchesSelector=function(){},v.cancel=function(t){t.preventDefault(),t.stopPropagation()},v.addEvent=function(t,e,n){var r="blur"==e||"focus"==e;t.element.addEventListener(e,n,r)},v.matchesEvent=function(){return!0},void 0!==e&&e.exports&&(e.exports=v),window.Gator=v}()},{}],13:[function(t,e,n){var r,f;r=this,f=function(t,e,n){for(var r in e)if(e.hasOwnProperty(r)){var i=r,o=e[r];if(void 0===o&&(o=""),null===o&&(o=""),void 0!==n&&(i=n+"["+r+"]"),o.constructor===Array)i+="[]";else if("object"==typeof o){f(t,o,i);continue}var u=t.elements.namedItem(i);if(u)switch(u.type||u[0].type){default:u.value=o;break;case"radio":case"checkbox":for(var s=0;s<u.length;s++)u[s].checked=-1<o.indexOf(u[s].value);break;case"select-multiple":for(var a=o.constructor==Array?o:[o],c=0;c<u.options.length;c++)u.options[c].selected|=-1<a.indexOf(u.options[c].value);break;case"select":case"select-one":u.value=o.toString()||o;break;case"date":u.value=new Date(o).toISOString().split("T")[0]}}},"function"==typeof s&&"object"==typeof s.amd&&s.amd?s(function(){return f}):void 0!==e&&e.exports?e.exports=f:r.populate=f},{}],14:[function(t,e,n){var r=t("scroll-to");e.exports=function(t,e){if(e=e||{},"string"==typeof t&&(t=document.querySelector(t)),t)return r(0,function(t,e,n){var r,i=document.body,o=document.documentElement,u=t.getBoundingClientRect(),s=o.clientHeight,a=Math.max(i.scrollHeight,i.offsetHeight,o.clientHeight,o.scrollHeight,o.offsetHeight);e=e||0,r="bottom"===n?u.bottom-s:"middle"===n?u.bottom-s/2-u.height/2:u.top;var c=a-s;return Math.min(r+e+window.pageYOffset,c)}(t,e.offset,e.align),e)}},{"scroll-to":15}],15:[function(t,e,n){var a=t("tween"),c=t("raf");e.exports=function(t,e,n){n=n||{};var r=(o=window.pageYOffset||document.documentElement.scrollTop,u=window.pageXOffset||document.documentElement.scrollLeft,{top:o,left:u}),i=a(r).ease(n.ease||"out-circ").to({top:e,left:t}).duration(n.duration||1e3);var o,u;function s(){c(s),i.update()}return i.update(function(t){window.scrollTo(0|t.left,0|t.top)}),i.on("end",function(){s=function(){}}),s(),i}},{raf:7,tween:8}],16:[function(t,u,e){!function(t){"use strict";function e(){}var n=e.prototype,r=t.EventEmitter;function o(t,e){for(var n=t.length;n--;)if(t[n].listener===e)return n;return-1}function i(t){return function(){return this[t].apply(this,arguments)}}n.getListeners=function(t){var e,n,r=this._getEvents();if(t instanceof RegExp)for(n in e={},r)r.hasOwnProperty(n)&&t.test(n)&&(e[n]=r[n]);else e=r[t]||(r[t]=[]);return e},n.flattenListeners=function(t){var e,n=[];for(e=0;e<t.length;e+=1)n.push(t[e].listener);return n},n.getListenersAsObject=function(t){var e,n=this.getListeners(t);return n instanceof Array&&((e={})[t]=n),e||n},n.addListener=function(t,e){if(!function t(e){return"function"==typeof e||e instanceof RegExp||!(!e||"object"!=typeof e)&&t(e.listener)}(e))throw new TypeError("listener must be a function");var n,r=this.getListenersAsObject(t),i="object"==typeof e;for(n in r)r.hasOwnProperty(n)&&-1===o(r[n],e)&&r[n].push(i?e:{listener:e,once:!1});return this},n.on=i("addListener"),n.addOnceListener=function(t,e){return this.addListener(t,{listener:e,once:!0})},n.once=i("addOnceListener"),n.defineEvent=function(t){return this.getListeners(t),this},n.defineEvents=function(t){for(var e=0;e<t.length;e+=1)this.defineEvent(t[e]);return this},n.removeListener=function(t,e){var n,r,i=this.getListenersAsObject(t);for(r in i)i.hasOwnProperty(r)&&-1!==(n=o(i[r],e))&&i[r].splice(n,1);return this},n.off=i("removeListener"),n.addListeners=function(t,e){return this.manipulateListeners(!1,t,e)},n.removeListeners=function(t,e){return this.manipulateListeners(!0,t,e)},n.manipulateListeners=function(t,e,n){var r,i,o=t?this.removeListener:this.addListener,u=t?this.removeListeners:this.addListeners;if("object"!=typeof e||e instanceof RegExp)for(r=n.length;r--;)o.call(this,e,n[r]);else for(r in e)e.hasOwnProperty(r)&&(i=e[r])&&("function"==typeof i?o.call(this,r,i):u.call(this,r,i));return this},n.removeEvent=function(t){var e,n=typeof t,r=this._getEvents();if("string"===n)delete r[t];else if(t instanceof RegExp)for(e in r)r.hasOwnProperty(e)&&t.test(e)&&delete r[e];else delete this._events;return this},n.removeAllListeners=i("removeEvent"),n.emitEvent=function(t,e){var n,r,i,o,u=this.getListenersAsObject(t);for(o in u)if(u.hasOwnProperty(o))for(n=u[o].slice(0),i=0;i<n.length;i++)!0===(r=n[i]).once&&this.removeListener(t,r.listener),r.listener.apply(this,e||[])===this._getOnceReturnValue()&&this.removeListener(t,r.listener);return this},n.trigger=i("emitEvent"),n.emit=function(t){var e=Array.prototype.slice.call(arguments,1);return this.emitEvent(t,e)},n.setOnceReturnValue=function(t){return this._onceReturnValue=t,this},n._getOnceReturnValue=function(){return!this.hasOwnProperty("_onceReturnValue")||this._onceReturnValue},n._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return t.EventEmitter=r,e},"function"==typeof s&&s.amd?s(function(){return e}):"object"==typeof u&&u.exports?u.exports=e:t.EventEmitter=e}(this||{})},{}]},{},[1])}();