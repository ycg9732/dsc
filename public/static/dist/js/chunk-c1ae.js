(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-c1ae"],{3846:function(t,e,n){n("9e1e")&&"g"!=/./g.flags&&n("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:n("0bfb")})},9718:function(t,e,n){},c1ee:function(t,e,n){"use strict";var i=n("9718"),s=n.n(i);s.a},d567:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"sus-nav"},[n("div",{staticClass:"common-nav",class:{active:!0===t.navType},attrs:{id:"moveDiv"},on:{touchstart:t.down,touchmove:t.move,touchend:t.end}},[n("div",{staticClass:"right-cont",attrs:{id:"rightDiv"}},[n("ul",[n("li",{on:{click:function(e){t.routerLink("home")}}},[n("i",{staticClass:"iconfont icon-zhuye"}),n("p",[t._v(t._s(t.$t("lang.home")))])]),"drp"!=t.routerName&&"crowd_funding"!=t.routerName&&"team"!=t.routerName&&"supplier"!=t.routerName&&"presale"!=t.routerName?n("li",{on:{click:function(e){t.routerLink("search")}}},[n("i",{staticClass:"iconfont icon-search"}),n("p",[t._v(t._s(t.$t("lang.search")))])]):t._e(),n("li",{on:{click:function(e){t.routerLink("catalog")}}},[n("i",{staticClass:"iconfont icon-menu"}),n("p",[t._v(t._s(t.$t("lang.category")))])]),n("li",{on:{click:function(e){t.routerLink("cart")}}},[n("i",{staticClass:"iconfont icon-cart"}),n("p",[t._v(t._s(t.$t("lang.cart")))])]),n("li",{on:{click:function(e){t.routerLink("user")}}},[n("i",{staticClass:"iconfont icon-gerenzhongxin"}),n("p",[t._v(t._s(t.$t("lang.personal_center")))])]),"team"==t.routerName?n("li",{on:{click:function(e){t.routerLink("team")}}},[n("i",{staticClass:"iconfont icon-wodetuandui"}),n("p",[t._v(t._s(t.$t("lang.my_team")))])]):t._e(),"supplier"==t.routerName?n("li",{on:{click:function(e){t.routerLink("supplier")}}},[n("i",{staticClass:"iconfont icon-wodetuandui"}),n("p",[t._v(t._s(t.$t("lang.suppliers")))])]):t._e(),t._t("aloneNav")],2)]),n("div",{staticClass:"nav-icon",on:{click:t.handelNav}},[t._v(t._s(t.$t("lang.quick_navigation")))])]),n("div",{staticClass:"common-show",class:{active:!0===t.navType},on:{click:function(e){return e.stopPropagation(),t.handelShow(e)}}})])},s=[],a=(n("3846"),n("cadf"),n("551c"),n("097d"),{props:["routerName"],data:function(){return{navType:!1,flags:!1,position:{x:0,y:0},nx:"",ny:"",dx:"",dy:"",xPum:"",yPum:""}},mounted:function(){this.flags=!1},methods:{handelNav:function(){this.navType=1!=this.navType},handelShow:function(){this.navType=!1},down:function(){var t;this.flags=!0,t=event.touches?event.touches[0]:event,this.position.x=t.clientX,this.position.y=t.clientY,this.dx=moveDiv.offsetLeft,this.dy=moveDiv.offsetTop},move:function(){var t,e,n,i;(event.preventDefault(),this.flags)&&(t=event.touches?event.touches[0]:event,e=document.documentElement.clientHeight,n=moveDiv.clientHeight,this.nx=t.clientX-this.position.x,this.ny=t.clientY-this.position.y,this.xPum=this.dx+this.nx,this.yPum=this.dy+this.ny,this.navType?this.yPum>0&&(i=e-n-this.yPum>0?e-n-this.yPum:0):(n+=rightDiv.clientHeight,this.yPum-n>0&&(i=e-this.yPum>0?e-this.yPum:0)),moveDiv.style.bottom=i+"px")},end:function(){this.flags=!1},routerLink:function(t){var e=this;"home"==t||"catalog"==t||"search"==t||"user"==t?setTimeout(function(){uni.getEnv(function(n){n.plus||n.miniprogram?"home"==t?uni.reLaunch({url:"../../pages/index/index"}):"catalog"==t?uni.reLaunch({url:"../../pages/category/category"}):"search"==t?uni.reLaunch({url:"../../pages/search/search"}):"user"==t&&uni.reLaunch({url:"../../pages/user/user"}):e.$router.push({name:t})}),uni.postMessage({data:{action:"postMessage"}})},100):e.$router.push({name:t})}}}),o=a,c=(n("c1ee"),n("2877")),r=Object(c["a"])(o,i,s,!1,null,null,null);r.options.__file="CommonNav.vue";e["a"]=r.exports},e31e:function(t,e,n){t.exports=n.p+"img/user_default.png"},f106:function(t,e,n){"use strict";n.r(e);var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:" bargain-detail team-user"},[n("div",{staticClass:"qinyou-cont"},t._l(t.teamUserData,function(e,i){return n("div",{key:i,staticClass:"li dis-box bg-color-write p-r"},[n("div",{staticClass:"left"},[0==e.team_user_id?n("div",{staticClass:"tag-box"},[t._v(t._s(t.$t("lang.regimental_commander")))]):t._e(),t._m(0,!0)]),n("div",{staticClass:"box-flex"},[t._m(1,!0),n("p",{staticClass:"color-9 f-02 m-top04"},[t._v(t._s(t.$t("lang.open_team_time"))+t._s(e.add_time))])])])})),n("CommonNav",{attrs:{routerName:t.routerName}})],1)},s=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"img-box"},[i("img",{staticClass:"img",attrs:{src:n("e31e")}})])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"dis-box m-top02"},[n("h4",{staticClass:"f-05 color-3 box-flex"},[t._v("Angelo")])])}],a=n("9395"),o=n("2f62"),c=n("d567"),r={name:"team-user",components:{CommonNav:c["a"]},data:function(){return{routerName:"team"}},created:function(){this.$store.dispatch({type:"setTeamUser",team_id:this.$route.params.team_id})},computed:Object(a["a"])({},Object(o["c"])({teamUserData:function(t){return t.team.teamUserData}}))},u=r,l=n("2877"),m=Object(l["a"])(u,i,s,!1,null,null,null);m.options.__file="User.vue";e["default"]=m.exports}}]);