(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-04fb"],{"0653":function(t,e,i){"use strict";i("68ef")},1146:function(t,e,i){},3846:function(t,e,i){i("9e1e")&&"g"!=/./g.flags&&i("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:i("0bfb")})},"565f":function(t,e,i){"use strict";var n=i("c31d"),s=i("fe7e"),a=i("a142");e["a"]=Object(s["a"])({render:function(){var t,e=this,i=e.$createElement,n=e._self._c||i;return n("cell",{class:e.b((t={error:e.error,disabled:e.$attrs.disabled,"min-height":"textarea"===e.type&&!e.autosize},t["label-"+e.labelAlign]=e.labelAlign,t)),attrs:{icon:e.leftIcon,title:e.label,center:e.center,border:e.border,"is-link":e.isLink,required:e.required}},[e._t("left-icon",null,{slot:"icon"}),e._t("label",null,{slot:"title"}),n("div",{class:e.b("body")},["textarea"===e.type?n("textarea",e._g(e._b({ref:"input",class:e.b("control",e.inputAlign),attrs:{readonly:e.readonly},domProps:{value:e.value}},"textarea",e.$attrs,!1),e.listeners)):n("input",e._g(e._b({ref:"input",class:e.b("control",e.inputAlign),attrs:{type:e.type,readonly:e.readonly},domProps:{value:e.value}},"input",e.$attrs,!1),e.listeners)),e.showClear?n("icon",{class:e.b("clear"),attrs:{name:"clear"},on:{touchstart:function(t){return t.preventDefault(),e.onClear(t)}}}):e._e(),e.$slots.icon||e.icon?n("div",{class:e.b("icon"),on:{click:e.onClickIcon}},[e._t("icon",[n("icon",{attrs:{name:e.icon}})])],2):e._e(),e.$slots.button?n("div",{class:e.b("button")},[e._t("button")],2):e._e()],1),e.errorMessage?n("div",{class:e.b("error-message"),domProps:{textContent:e._s(e.errorMessage)}}):e._e()],2)},name:"field",inheritAttrs:!1,props:{value:[String,Number],icon:String,label:String,error:Boolean,center:Boolean,isLink:Boolean,leftIcon:String,readonly:Boolean,required:Boolean,clearable:Boolean,labelAlign:String,inputAlign:String,onIconClick:Function,autosize:[Boolean,Object],errorMessage:String,type:{type:String,default:"text"},border:{type:Boolean,default:!0}},data:function(){return{focused:!1}},watch:{value:function(){this.$nextTick(this.adjustSize)}},mounted:function(){this.format(),this.$nextTick(this.adjustSize)},computed:{showClear:function(){return this.clearable&&this.focused&&""!==this.value&&this.isDef(this.value)&&!this.readonly},listeners:function(){return Object(n["a"])({},this.$listeners,{input:this.onInput,keypress:this.onKeypress,focus:this.onFocus,blur:this.onBlur})}},methods:{focus:function(){this.$refs.input&&this.$refs.input.focus()},blur:function(){this.$refs.input&&this.$refs.input.blur()},format:function(t){void 0===t&&(t=this.$refs.input);var e=t,i=e.value,n=this.$attrs.maxlength;return this.isDef(n)&&i.length>n&&(i=i.slice(0,n),t.value=i),i},onInput:function(t){this.$emit("input",this.format(t.target))},onFocus:function(t){this.focused=!0,this.$emit("focus",t),this.readonly&&this.blur()},onBlur:function(t){this.focused=!1,this.$emit("blur",t)},onClickIcon:function(){this.$emit("click-icon"),this.onIconClick&&this.onIconClick()},onClear:function(){this.$emit("input",""),this.$emit("clear")},onKeypress:function(t){if("number"===this.type){var e=t.keyCode,i=-1===String(this.value).indexOf("."),n=e>=48&&e<=57||46===e&&i||45===e;n||t.preventDefault()}"search"===this.type&&13===t.keyCode&&this.blur(),this.$emit("keypress",t)},adjustSize:function(){var t=this.$refs.input;if("textarea"===this.type&&this.autosize&&t){t.style.height="auto";var e=t.scrollHeight;if(Object(a["d"])(this.autosize)){var i=this.autosize,n=i.maxHeight,s=i.minHeight;n&&(e=Math.min(e,n)),s&&(e=Math.max(e,s))}e&&(t.style.height=e+"px")}}}})},"8a58":function(t,e,i){"use strict";i("68ef"),i("4d75")},9718:function(t,e,i){},be7f:function(t,e,i){"use strict";i("68ef"),i("1146")},c194:function(t,e,i){"use strict";i("68ef")},c1ee:function(t,e,i){"use strict";var n=i("9718"),s=i.n(n);s.a},d567:function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"sus-nav"},[i("div",{staticClass:"common-nav",class:{active:!0===t.navType},attrs:{id:"moveDiv"},on:{touchstart:t.down,touchmove:t.move,touchend:t.end}},[i("div",{staticClass:"right-cont",attrs:{id:"rightDiv"}},[i("ul",[i("li",{on:{click:function(e){t.routerLink("home")}}},[i("i",{staticClass:"iconfont icon-zhuye"}),i("p",[t._v(t._s(t.$t("lang.home")))])]),"drp"!=t.routerName&&"crowd_funding"!=t.routerName&&"team"!=t.routerName&&"supplier"!=t.routerName&&"presale"!=t.routerName?i("li",{on:{click:function(e){t.routerLink("search")}}},[i("i",{staticClass:"iconfont icon-search"}),i("p",[t._v(t._s(t.$t("lang.search")))])]):t._e(),i("li",{on:{click:function(e){t.routerLink("catalog")}}},[i("i",{staticClass:"iconfont icon-menu"}),i("p",[t._v(t._s(t.$t("lang.category")))])]),i("li",{on:{click:function(e){t.routerLink("cart")}}},[i("i",{staticClass:"iconfont icon-cart"}),i("p",[t._v(t._s(t.$t("lang.cart")))])]),i("li",{on:{click:function(e){t.routerLink("user")}}},[i("i",{staticClass:"iconfont icon-gerenzhongxin"}),i("p",[t._v(t._s(t.$t("lang.personal_center")))])]),"team"==t.routerName?i("li",{on:{click:function(e){t.routerLink("team")}}},[i("i",{staticClass:"iconfont icon-wodetuandui"}),i("p",[t._v(t._s(t.$t("lang.my_team")))])]):t._e(),"supplier"==t.routerName?i("li",{on:{click:function(e){t.routerLink("supplier")}}},[i("i",{staticClass:"iconfont icon-wodetuandui"}),i("p",[t._v(t._s(t.$t("lang.suppliers")))])]):t._e(),t._t("aloneNav")],2)]),i("div",{staticClass:"nav-icon",on:{click:t.handelNav}},[t._v(t._s(t.$t("lang.quick_navigation")))])]),i("div",{staticClass:"common-show",class:{active:!0===t.navType},on:{click:function(e){return e.stopPropagation(),t.handelShow(e)}}})])},s=[],a=(i("3846"),i("cadf"),i("551c"),i("097d"),{props:["routerName"],data:function(){return{navType:!1,flags:!1,position:{x:0,y:0},nx:"",ny:"",dx:"",dy:"",xPum:"",yPum:""}},mounted:function(){this.flags=!1},methods:{handelNav:function(){this.navType=1!=this.navType},handelShow:function(){this.navType=!1},down:function(){var t;this.flags=!0,t=event.touches?event.touches[0]:event,this.position.x=t.clientX,this.position.y=t.clientY,this.dx=moveDiv.offsetLeft,this.dy=moveDiv.offsetTop},move:function(){var t,e,i,n;(event.preventDefault(),this.flags)&&(t=event.touches?event.touches[0]:event,e=document.documentElement.clientHeight,i=moveDiv.clientHeight,this.nx=t.clientX-this.position.x,this.ny=t.clientY-this.position.y,this.xPum=this.dx+this.nx,this.yPum=this.dy+this.ny,this.navType?this.yPum>0&&(n=e-i-this.yPum>0?e-i-this.yPum:0):(i+=rightDiv.clientHeight,this.yPum-i>0&&(n=e-this.yPum>0?e-this.yPum:0)),moveDiv.style.bottom=n+"px")},end:function(){this.flags=!1},routerLink:function(t){var e=this;"home"==t||"catalog"==t||"search"==t||"user"==t?setTimeout(function(){uni.getEnv(function(i){i.plus||i.miniprogram?"home"==t?uni.reLaunch({url:"../../pages/index/index"}):"catalog"==t?uni.reLaunch({url:"../../pages/category/category"}):"search"==t?uni.reLaunch({url:"../../pages/search/search"}):"user"==t&&uni.reLaunch({url:"../../pages/user/user"}):e.$router.push({name:t})}),uni.postMessage({data:{action:"postMessage"}})},100):e.$router.push({name:t})}}}),o=a,r=(i("c1ee"),i("2877")),c=Object(r["a"])(o,n,s,!1,null,null,null);c.options.__file="CommonNav.vue";e["a"]=c.exports},dc26:function(t,e,i){"use strict";i.r(e);var n,s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"user-recharge"},[i("van-field",{attrs:{label:t.$t("lang.gift_card"),placeholder:t.$t("lang.enter_gift_card")},model:{value:t.gift_card,callback:function(e){t.gift_card=e},expression:"gift_card"}}),i("van-field",{staticClass:"m-top10",attrs:{label:t.$t("lang.gift_pwd"),placeholder:t.$t("lang.enter_gift_pwd")},model:{value:t.gift_pwd,callback:function(e){t.gift_pwd=e},expression:"gift_pwd"}}),i("div",{staticClass:"padding-all"},[t.submit_btn?[i("div",{domProps:{innerHTML:t._s(t.submit_btn)}})]:[i("button",{staticClass:"btn btn-submit border-radius-top05",on:{click:t.submitBtn}},[t._v(t._s(t.$t("lang.subimt")))])]],2),i("CommonNav")],1)},a=[],o=i("88d8"),r=(i("e7e5"),i("d399")),c=(i("8a58"),i("e41f")),u=(i("0653"),i("34e9")),l=(i("c194"),i("7744")),f=(i("7f7f"),i("be7f"),i("565f")),h=(i("4328"),i("d567")),d={data:function(){return{show:!1,gift_card:"",gift_pwd:"",submit_btn:""}},components:(n={},Object(o["a"])(n,f["a"].name,f["a"]),Object(o["a"])(n,l["a"].name,l["a"]),Object(o["a"])(n,u["a"].name,u["a"]),Object(o["a"])(n,c["a"].name,c["a"]),Object(o["a"])(n,r["a"].name,r["a"]),Object(o["a"])(n,"CommonNav",h["a"]),n),created:function(){this.checkLoginGift()},methods:{checkLoginGift:function(){var t=this;this.$http.get("".concat(window.ROOT_URL,"api/v4/gift_gard")).then(function(e){var i=e.data;i.data.error&&0!=i.data.error?t.$router.push({name:"giftCard"}):t.goList()})},submitBtn:function(){if(0==this.gift_card.length)return Object(r["a"])(this.$t("lang.enter_gift_card")),!1;if(0==this.gift_pwd.length)return Object(r["a"])(this.$t("lang.enter_gift_pwd")),!1;var t=this,e={gift_card:this.gift_card,gift_pwd:this.gift_pwd};this.$http.get("".concat(window.ROOT_URL,"api/v4/gift_gard/check_gift"),{params:e}).then(function(e){var i=e.data;1==i.data.error?Object(r["a"])(i.data.msg):t.goList()})},goList:function(){this.$router.push({name:"giftCardResult"})}}},p=d,g=i("2877"),m=Object(g["a"])(p,s,a,!1,null,null,null);m.options.__file="Index.vue";e["default"]=m.exports},e41f:function(t,e,i){"use strict";var n=i("fe7e"),s=i("6605");e["a"]=Object(n["a"])({render:function(){var t,e=this,i=e.$createElement,n=e._self._c||i;return n("transition",{attrs:{name:e.currentTransition}},[e.shouldRender?n("div",{directives:[{name:"show",rawName:"v-show",value:e.value,expression:"value"}],class:e.b((t={},t[e.position]=e.position,t))},[e._t("default")],2):e._e()])},name:"popup",mixins:[s["a"]],props:{transition:String,overlay:{type:Boolean,default:!0},closeOnClickOverlay:{type:Boolean,default:!0},position:{type:String,default:""}},computed:{currentTransition:function(){return this.transition||(""===this.position?"van-fade":"popup-slide-"+this.position)}}})}}]);