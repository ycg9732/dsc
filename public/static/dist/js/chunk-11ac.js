(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-11ac"],{3846:function(t,e,s){s("9e1e")&&"g"!=/./g.flags&&s("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:s("0bfb")})},"40ad":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{directives:[{name:"waterfall-lower",rawName:"v-waterfall-lower",value:t.loadMore,expression:"loadMore"}],staticClass:"store_info",attrs:{"waterfall-disabled":"disabled","waterfall-offset":"300"}},[""!=t.shopCollectList?t._l(t.shopCollectList,function(e,o){return i("section",{key:o,staticClass:"goods-shop",class:{"m-top04":o>0}},[i("div",{staticClass:"padding-all"},[i("section",{staticClass:"dis-box"},[i("div",{staticClass:"g-s-i-img"},[i("router-link",{attrs:{to:{name:"shopHome",params:{id:e.ru_id}}}},[e.shop_logo?i("img",{staticClass:"img",attrs:{src:e.shop_logo}}):i("img",{staticClass:"img",attrs:{src:s("d9e6"),alt:""}})])],1),i("div",{staticClass:"g-s-i-title"},[i("h3",[i("router-link",{attrs:{to:{name:"shopHome",params:{id:e.ru_id}}}},[t._v(t._s(e.shoprz_brandName)+t._s(e.shopNameSuffix))])],1),i("p",[t._v(t._s(t.$t("lang.collection_one"))+" "+t._s(e.count_store)+" "+t._s(t.$t("lang.collection_two")))])]),i("div",{staticClass:"g-s-info-add"},[i("a",{staticClass:"active",attrs:{href:"javascript:void(0)"},on:{click:function(s){t.collectHandle(e.ru_id)}}},[t._v(t._s(t.$t("lang.cancel_collection")))])])])])])}):[i("NotCont")],i("CommonNav")],2)},o=[],n=(s("c5f6"),s("d49c"),s("5487")),a=(s("cadf"),s("551c"),s("097d"),s("2f62"),s("6f38")),u=s("d567"),c=s("a454"),r={data:function(){return{disabled:!1,loading:!0,page:1,size:10}},directives:{WaterfallLower:Object(n["a"])("lower")},components:{NotCont:a["a"],CommonNav:u["a"]},created:function(){this.setShopList(1)},computed:{shopCollectList:{get:function(){return this.$store.state.user.shopCollectList},set:function(t){this.$store.state.user.shopCollectList=t}}},methods:{setShopList:function(t){t&&(this.page=t,this.size=10*Number(t)),this.$store.dispatch("setCollectShopList",{page:this.page,size:this.size})},collectHandle:function(t){this.$store.dispatch("setCollectShop",{ru_id:t,status:1})},loadMore:function(){var t=this;setTimeout(function(){t.disabled=!0,t.page*t.size==t.shopCollectList.length&&(t.page++,t.setShopList())},200)}},watch:{shopCollectList:function(){this.page*this.size==this.shopCollectList.length?(this.disabled=!1,this.loading=!0):this.loading=!1,this.shopCollectList=c["a"].trimSpace(this.shopCollectList)}}},l=r,h=s("2877"),d=Object(h["a"])(l,i,o,!1,null,null,null);d.options.__file="Shop.vue";e["default"]=d.exports},5487:function(t,e,s){"use strict";var i=s("023d"),o=s("db78"),n="@@Waterfall",a=300;function u(){var t=this;if(!this.el[n].binded){this.el[n].binded=!0,this.scrollEventListener=c.bind(this),this.scrollEventTarget=i["a"].getScrollEventTarget(this.el);var e=this.el.getAttribute("waterfall-disabled"),s=!1;e&&(this.vm.$watch(e,function(e){t.disabled=e,t.scrollEventListener()}),s=Boolean(this.vm[e])),this.disabled=s;var u=this.el.getAttribute("waterfall-offset");this.offset=Number(u)||a,Object(o["b"])(this.scrollEventTarget,"scroll",this.scrollEventListener,!0),this.scrollEventListener()}}function c(){var t=this.el,e=this.scrollEventTarget;if(!this.disabled){var s=i["a"].getScrollTop(e),o=i["a"].getVisibleHeight(e),n=s+o;if(o){var a=!1;if(t===e)a=e.scrollHeight-n<this.offset;else{var u=i["a"].getElementTop(t)-i["a"].getElementTop(e)+i["a"].getVisibleHeight(t);a=u-o<this.offset}a&&this.cb.lower&&this.cb.lower({target:e,top:s});var c=!1;if(t===e)c=s<this.offset;else{var r=i["a"].getElementTop(t)-i["a"].getElementTop(e);c=r+this.offset>0}c&&this.cb.upper&&this.cb.upper({target:e,top:s})}}}function r(t){var e=t[n];e.vm.$nextTick(function(){u.call(t[n])})}function l(t){var e=t[n];e.vm._isMounted?r(t):e.vm.$on("hook:mounted",function(){r(t)})}var h=function(t){return{bind:function(e,s,i){e[n]||(e[n]={el:e,vm:i.context,cb:{}}),e[n].cb[t]=s.value,l(e)},update:function(t){var e=t[n];e.scrollEventListener&&e.scrollEventListener()},unbind:function(t){var e=t[n];e.scrollEventTarget&&Object(o["a"])(e.scrollEventTarget,"scroll",e.scrollEventListener)}}};h.install=function(t){t.directive("WaterfallLower",h("lower")),t.directive("WaterfallUpper",h("upper"))};e["a"]=h},"6f38":function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"ectouch-notcont"},[t._m(0),t.isSpan?[s("span",{staticClass:"cont"},[t._v(t._s(t.$t("lang.not_cont_prompt")))])]:[t._t("spanCon")]],2)},o=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"img"},[i("img",{staticClass:"img",attrs:{src:s("b8c9")}})])}],n=(s("cadf"),s("551c"),s("097d"),{props:{isSpan:{type:Boolean,default:!0}},name:"NotCont",data:function(){return{}}}),a=n,u=s("2877"),c=Object(u["a"])(a,i,o,!1,null,null,null);c.options.__file="NotCont.vue";e["a"]=c.exports},9718:function(t,e,s){},b8c9:function(t,e){t.exports="data:image/png;base64,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"},c1ee:function(t,e,s){"use strict";var i=s("9718"),o=s.n(i);o.a},d49c:function(t,e,s){"use strict";s("68ef")},d567:function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"sus-nav"},[s("div",{staticClass:"common-nav",class:{active:!0===t.navType},attrs:{id:"moveDiv"},on:{touchstart:t.down,touchmove:t.move,touchend:t.end}},[s("div",{staticClass:"right-cont",attrs:{id:"rightDiv"}},[s("ul",[s("li",{on:{click:function(e){t.routerLink("home")}}},[s("i",{staticClass:"iconfont icon-zhuye"}),s("p",[t._v(t._s(t.$t("lang.home")))])]),"drp"!=t.routerName&&"crowd_funding"!=t.routerName&&"team"!=t.routerName&&"supplier"!=t.routerName&&"presale"!=t.routerName?s("li",{on:{click:function(e){t.routerLink("search")}}},[s("i",{staticClass:"iconfont icon-search"}),s("p",[t._v(t._s(t.$t("lang.search")))])]):t._e(),s("li",{on:{click:function(e){t.routerLink("catalog")}}},[s("i",{staticClass:"iconfont icon-menu"}),s("p",[t._v(t._s(t.$t("lang.category")))])]),s("li",{on:{click:function(e){t.routerLink("cart")}}},[s("i",{staticClass:"iconfont icon-cart"}),s("p",[t._v(t._s(t.$t("lang.cart")))])]),s("li",{on:{click:function(e){t.routerLink("user")}}},[s("i",{staticClass:"iconfont icon-gerenzhongxin"}),s("p",[t._v(t._s(t.$t("lang.personal_center")))])]),"team"==t.routerName?s("li",{on:{click:function(e){t.routerLink("team")}}},[s("i",{staticClass:"iconfont icon-wodetuandui"}),s("p",[t._v(t._s(t.$t("lang.my_team")))])]):t._e(),"supplier"==t.routerName?s("li",{on:{click:function(e){t.routerLink("supplier")}}},[s("i",{staticClass:"iconfont icon-wodetuandui"}),s("p",[t._v(t._s(t.$t("lang.suppliers")))])]):t._e(),t._t("aloneNav")],2)]),s("div",{staticClass:"nav-icon",on:{click:t.handelNav}},[t._v(t._s(t.$t("lang.quick_navigation")))])]),s("div",{staticClass:"common-show",class:{active:!0===t.navType},on:{click:function(e){return e.stopPropagation(),t.handelShow(e)}}})])},o=[],n=(s("3846"),s("cadf"),s("551c"),s("097d"),{props:["routerName"],data:function(){return{navType:!1,flags:!1,position:{x:0,y:0},nx:"",ny:"",dx:"",dy:"",xPum:"",yPum:""}},mounted:function(){this.flags=!1},methods:{handelNav:function(){this.navType=1!=this.navType},handelShow:function(){this.navType=!1},down:function(){var t;this.flags=!0,t=event.touches?event.touches[0]:event,this.position.x=t.clientX,this.position.y=t.clientY,this.dx=moveDiv.offsetLeft,this.dy=moveDiv.offsetTop},move:function(){var t,e,s,i;(event.preventDefault(),this.flags)&&(t=event.touches?event.touches[0]:event,e=document.documentElement.clientHeight,s=moveDiv.clientHeight,this.nx=t.clientX-this.position.x,this.ny=t.clientY-this.position.y,this.xPum=this.dx+this.nx,this.yPum=this.dy+this.ny,this.navType?this.yPum>0&&(i=e-s-this.yPum>0?e-s-this.yPum:0):(s+=rightDiv.clientHeight,this.yPum-s>0&&(i=e-this.yPum>0?e-this.yPum:0)),moveDiv.style.bottom=i+"px")},end:function(){this.flags=!1},routerLink:function(t){var e=this;"home"==t||"catalog"==t||"search"==t||"user"==t?setTimeout(function(){uni.getEnv(function(s){s.plus||s.miniprogram?"home"==t?uni.reLaunch({url:"../../pages/index/index"}):"catalog"==t?uni.reLaunch({url:"../../pages/category/category"}):"search"==t?uni.reLaunch({url:"../../pages/search/search"}):"user"==t&&uni.reLaunch({url:"../../pages/user/user"}):e.$router.push({name:t})}),uni.postMessage({data:{action:"postMessage"}})},100):e.$router.push({name:t})}}}),a=n,u=(s("c1ee"),s("2877")),c=Object(u["a"])(a,i,o,!1,null,null,null);c.options.__file="CommonNav.vue";e["a"]=c.exports},d9e6:function(t,e,s){t.exports=s.p+"img/no_image.jpg"}}]);