(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-05b9"],{"19de":function(t,i,e){"use strict";e("68ef"),e("5fbe")},"1f5b":function(t,i,e){},"234f":function(t,i,e){"use strict";var s=e("fe7e"),a=e("b650"),n=e("9584");i["a"]=Object(s["a"])({render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("van-button",{class:t.b(),attrs:{square:"",size:"large",loading:t.loading,disabled:t.disabled,type:t.primary?"danger":"warning"},on:{click:t.onClick}},[t._t("default",[t._v(t._s(t.text))])],2)},name:"goods-action-big-btn",mixins:[n["a"]],components:{VanButton:a["a"]},props:{text:String,primary:Boolean,loading:Boolean,disabled:Boolean},methods:{onClick:function(t){this.$emit("click",t),this.routerLink()}}})},2662:function(t,i,e){},3846:function(t,i,e){e("9e1e")&&"g"!=/./g.flags&&e("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:e("0bfb")})},"42d1":function(t,i,e){"use strict";var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return t.dscLoading?e("div",{staticClass:"cloading",style:{height:t.clientHeight+"px"},on:{touchmove:function(t){t.preventDefault()},mousewheel:function(t){t.preventDefault()}}},[e("div",{staticClass:"cloading-mask"}),t._t("text",[t._m(0)])],2):t._e()},a=[function(){var t=this,i=t.$createElement,s=t._self._c||i;return s("div",{staticClass:"cloading-main"},[s("img",{attrs:{src:e("f8b2")}})])}],n=e("88d8"),r=(e("7f7f"),e("ac1e"),e("543e")),o={props:["dscLoading"],data:function(){return{clientHeight:""}},components:Object(n["a"])({},r["a"].name,r["a"]),created:function(){},mounted:function(){this.clientHeight=document.documentElement.clientHeight},methods:{}},c=o,l=(e("a637"),e("2877")),d=Object(l["a"])(c,s,a,!1,null,"9a0469b6",null);d.options.__file="DscLoading.vue";i["a"]=d.exports},4887:function(t,i,e){"use strict";e.r(i);var s,a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"con"},[t.card_id?[e("div",{staticClass:"vip-buy"},[e("div",{staticClass:"purchase-card"},[e("div",{staticClass:"swiper-card"},[e("div",{staticClass:"purchase-card-item"},[e("div",{staticClass:"left"},[e("div",{staticClass:"rank"},[t._v(t._s(t.drpRightsCard.name))]),"forever"==t.drpRightsCard.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(t.$t("lang.permanence")))]):"days"==t.drpRightsCard.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(t.drpRightsCard.expiry_type_format))]):"timespan"==t.drpRightsCard.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(t.drpRightsCard.expiry_date_end))]):t._e()])])])]),t.drpRightsCard.user_membership_card_rights_list&&t.drpRightsCard.user_membership_card_rights_list.length>0?e("div",{staticClass:"protection"},[e("div",{staticClass:"title"},[t._v(t._s(t.$t("lang.vip_protection")))]),e("div",{staticClass:"items"},t._l(t.drpRightsCard.user_membership_card_rights_list,function(i,s){return e("div",{key:s,staticClass:"item",on:{click:function(e){t.protectionHref(i.membership_card_id,s)}}},[e("div",{staticClass:"icon"},[e("div",{staticClass:"img-box"},[e("img",{staticClass:"img",attrs:{src:i.icon}})])]),e("div",{staticClass:"text"},[t._v(t._s(i.name))])])}))]):t._e(),t.drpRightsCard.description?e("div",{staticClass:"head"},[e("div",{staticClass:"title"},[t._v(t._s(t.$t("lang.vip_card")))]),e("div",{staticClass:"notice"},[e("p",[t._v(t._s(t.drpRightsCard.description))])])]):t._e()])]:[e("swiper",{ref:"slideSwiper",staticClass:"apply-swiper",attrs:{options:t.swiperOption}},[t._l(t.drpChangeCard.list,function(i,s){return e("swiper-slide",{key:s},[e("div",{staticClass:"list",class:{"list-active":"goods"!=t.type}},[e("div",{staticClass:"vip-buy"},[e("div",{staticClass:"purchase-card"},[e("div",{staticClass:"swiper-card"},[e("div",{staticClass:"purchase-card-item"},[e("div",{staticClass:"left"},[e("div",{staticClass:"rank"},[t._v(t._s(i.name))]),"forever"==i.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(t.$t("lang.permanence")))]):"days"==i.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(i.expiry_type_format))]):"timespan"==i.expiry_type?e("span",{staticClass:"period"},[t._v(t._s(t.$t("lang.term_of_validity"))+"："+t._s(i.expiry_date_end))]):t._e()]),"goods"!=t.type?e("div",{staticClass:"right"},[t._v(t._s(i.receive_value_arr.value_format))]):t._e()])])]),i.user_membership_card_rights_list&&i.user_membership_card_rights_list.length>0?e("div",{staticClass:"protection"},[e("div",{staticClass:"title"},[t._v(t._s(t.$t("lang.vip_protection")))]),e("div",{staticClass:"items"},t._l(i.user_membership_card_rights_list,function(i,s){return e("div",{key:s,staticClass:"item",on:{click:function(e){t.protectionHref(i.membership_card_id,s)}}},[e("div",{staticClass:"icon"},[e("div",{staticClass:"img-box"},[e("img",{staticClass:"img",attrs:{src:i.icon}})])]),e("div",{staticClass:"text"},[t._v(t._s(i.name))])])}))]):t._e(),i.description?e("div",{staticClass:"head"},[e("div",{staticClass:"title"},[t._v(t._s(t.$t("lang.vip_card")))]),e("div",{staticClass:"notice"},[e("p",[t._v(t._s(i.description))])])]):t._e(),"integral"==t.type?e("div",{staticClass:"bg-color-write"},[e("div",{staticClass:"cell-box"},[e("div",{staticClass:"cell-title"},[t._v(t._s(t.$t("lang.receive_value_integral")))]),e("div",{staticClass:"cell-content"},[t._v(t._s(i.receive_value_arr.value))])])]):t._e(),"order"==t.type?e("div",{staticClass:"bg-color-write"},[e("div",{staticClass:"cell-box"},[e("div",{staticClass:"cell-title"},[t._v(t._s(t.$t("lang.receive_value_order")))]),e("div",{staticClass:"cell-content"},[t._v(t._s(i.receive_value_arr.value_format))])])]):t._e(),"goods"==t.type?e("div",[i.description?e("div",{staticClass:"head"},[e("div",{staticClass:"title"},[t._v(t._s(t.$t("lang.receive_value_goods")))])]):t._e(),e("ul",{staticClass:"apply-goods-list clearfix"},t._l(i.goods_list,function(i,s){return e("li",{key:s,staticClass:"item"},[e("div",{staticClass:"item-wapper"},[e("div",{staticClass:"img"},[e("router-link",{attrs:{to:{name:"goods",params:{id:i.goods_id}}}},[e("img",{attrs:{src:i.goods_thumb,alt:""}})]),e("div",{staticClass:"tag"},[t._v(t._s(t.$t("lang.drp_apply_goods_label")))])],1),e("div",{staticClass:"tit"},[e("router-link",{attrs:{to:{name:"goods",params:{id:i.goods_id}}}},[t._v(t._s(i.goods_name))])],1),e("div",{staticClass:"info"},[e("div",{staticClass:"price"},[t._v(t._s(i.shop_price_formated))]),0==i.is_buy?e("div",{staticClass:"i-btn",on:{click:function(e){t.onAddCartClicked(i.goods_id,10)}}},[t._v(t._s(t.$t("lang.drp_apply_btn_2")))]):e("div",{staticClass:"i-btn"},[t._v(t._s(t.$t("lang.drp_apply_goods_bought")))])])])])}))]):t._e()]),"goods"!=t.type?e("div",{staticClass:"vip-fixed-bottom"},[e("div",{staticClass:"item article-confirm"},[e("div",{staticClass:"radio-wrap",on:{click:t.toggleConfirm}},[e("i",{staticClass:"radio-icon",class:{active:t.confirm}}),t._v(t._s(t.$t("lang.checkout_help_article")))]),e("span",{on:{click:function(i){t.articleHref(t.drpChangeCard.agreement_id)}}},[t._v(t._s(t.drpChangeCard.agreement_article_title))])]),e("div",{staticClass:"item vip-btn",on:{click:t.onSubmit}},["goods"==t.type?[e("span",[t._v(t._s(t.$t("lang.drp_apply_btn_1")))])]:"buy"==t.type?[e("span",[t._v(t._s(t.$t("lang.immediate_pay")))]),e("span",{staticClass:"number"},[t._v(t._s(i.receive_value_arr.value_format))])]:"free"==t.type?[e("span",[t._v(t._s(t.$t("lang.immediately_receive")))])]:[e("span",[t._v(t._s(t.$t("lang.immediately_change")))])]],2)]):t._e()])])}),e("div",{staticClass:"swiper-button swiper-button-next",attrs:{slot:"button-prev"},slot:"button-prev"},[e("i",{staticClass:"iconfont icon-more"})]),e("div",{staticClass:"swiper-button swiper-button-prev",attrs:{slot:"button-next"},slot:"button-next"},[e("i",{staticClass:"iconfont icon-back"})])],2)],e("van-popup",{staticClass:"vip-popup",model:{value:t.applyPopupShow,callback:function(i){t.applyPopupShow=i},expression:"applyPopupShow"}},[e("div",{staticClass:"p-content"},[2==t.popupStep||3==t.popupStep?e("div",{staticClass:"p-icon"},[2==t.popupStep?e("div",{staticClass:"loader04"}):t._e(),3==t.popupStep?e("div",{staticClass:"p-icon-success"}):t._e()]):t._e(),e("p",{domProps:{innerHTML:t._s(t.validMsg)}}),t.validNumber.length>0?e("p",{staticClass:"number",domProps:{innerHTML:t._s(t.validNumber)}}):t._e(),t.validTip.length>0?e("p",{class:{green:t.formValid,red:!t.formValid},domProps:{innerHTML:t._s(t.validTip)}}):t._e()]),e("div",{staticClass:"p-handler"},[1==t.popupStep?[e("div",{staticClass:"v-btn",on:{click:t.closePopup}},[t._v(t._s(t.$t("lang.close_window")))])]:t._e(),2==t.popupStep?[e("div",{staticClass:"v-btn disabled"},[t._v(t._s(t.$t("lang.drp_apply_padding")))])]:t._e(),3==t.popupStep?[e("div",{staticClass:"v-btn",on:{click:t.drpInfoHref}},[t._v(t._s(t.$t("lang.href_drp_center")))])]:t._e()],2)]),e("DscLoading",{attrs:{dscLoading:t.dscLoading}}),e("CommonNav",{attrs:{routerName:t.routerName}},[e("li",{attrs:{slot:"aloneNav"},slot:"aloneNav"},[e("router-link",{attrs:{to:{name:"drp"}}},[e("i",{staticClass:"iconfont icon-fenxiao"}),e("p",[t._v(t._s(t.$t("lang.drp_center")))])])],1)])],2)},n=[],r=e("9395"),o=e("88d8"),c=(e("e17f"),e("2241")),l=(e("8a58"),e("e41f")),d=(e("e7e5"),e("d399")),p=(e("f908"),e("b528")),u=(e("19de"),e("234f")),_=(e("93ac"),e("bb33")),v=(e("7f7f"),e("66b9"),e("b650")),h=(e("cadf"),e("551c"),e("097d"),e("4328")),m=e.n(h),f=e("2f62"),g=e("7212"),C=e("d567"),y=e("42d1"),b=null,$={data:function(){return{routerName:"drp",confirm:!1,formValid:!0,validMsg:"",validNumber:"",validTip:"",popupStep:1,applySuccess:!1,applyPopupShow:!1,dscLoading:!0,index:0,swiperOption:{navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},on:{init:function(){b.index=this.activeIndex},slideChange:function(){b.index=this.activeIndex}},autoHeight:!0},point:this.$route.query.point?this.$route.query.point:"",type:this.$route.query.receive_type,card_id:this.$route.query.card_id?this.$route.query.card_id:""}},components:(s={},Object(o["a"])(s,v["a"].name,v["a"]),Object(o["a"])(s,_["a"].name,_["a"]),Object(o["a"])(s,u["a"].name,u["a"]),Object(o["a"])(s,p["a"].name,p["a"]),Object(o["a"])(s,d["a"].name,d["a"]),Object(o["a"])(s,l["a"].name,l["a"]),Object(o["a"])(s,c["a"].name,c["a"]),Object(o["a"])(s,"swiper",g["swiper"]),Object(o["a"])(s,"swiperSlide",g["swiperSlide"]),Object(o["a"])(s,"CommonNav",C["a"]),Object(o["a"])(s,"DscLoading",y["a"]),s),computed:Object(r["a"])({},Object(f["c"])({drpChangeCard:function(t){return t.drp.drpChangeCard},drpRightsCard:function(t){return t.drp.drpRightsCard}})),created:function(){b=this;var t=this.$route.query.membership_card_id_renew?this.$route.query.membership_card_id_renew:null,i=this.$route.query.membership_card_id_repeat?this.$route.query.membership_card_id_repeat:null;this.card_id?this.onRightsCard():t?this.$store.dispatch("setDrpChangeCard",{receive_type:this.type,membership_card_id_renew:t}):i?this.$store.dispatch("setDrpChangeCard",{receive_type:this.type,membership_card_id_repeat:i}):this.$store.dispatch("setDrpChangeCard",{receive_type:this.type})},methods:{onSubmit:function(){var t=this,i=this,e={receive_type:this.type,membership_card_id:this.drpChangeCard.list[this.index].id};if(!this.confirm)return Object(d["a"])(this.$t("lang.drp_agreement_please")),!1;if("integral"==this.type&&(e={receive_type:this.type,membership_card_id:this.drpChangeCard.list[this.index].id,pay_point:this.drpChangeCard.list[this.index].receive_value_arr.value}),"buy"==this.type)return this.$router.push({name:"drp-done",query:{membership_card_id:this.drpChangeCard.list[this.index].id}}),!1;var s=this.$route.query.membership_card_id_renew?this.$route.query.membership_card_id_renew:null;s?c["a"].confirm({message:"是否确定续费？",className:"text-center"}).then(function(){t.$http.post("".concat(window.ROOT_URL,"api/v4/drp/renew"),m.a.stringify(e)).then(function(e){var s=e.data;"success"==s.status?(t.validTip=s.data.msg,0==s.data.error?(t.formValid=!0,t.popupStep=3,setTimeout(function(){i.$router.push({name:"drp-info"})},2e3)):(t.formValid=!1,t.popupStep=1),t.applyPopupShow=!0):Object(d["a"])(t.$t("lang.interface_error_reporting"))})}):c["a"].confirm({message:"是否申请成为分销商？",className:"text-center"}).then(function(){t.$http.post("".concat(window.ROOT_URL,"api/v4/drp/apply"),m.a.stringify(e)).then(function(e){var s=e.data;"success"==s.status?(t.validTip=s.data.msg,0==s.data.error?(t.formValid=!0,t.popupStep=3,setTimeout(function(){i.$router.push({name:"drp-info"})},2e3)):(t.formValid=!1,t.popupStep=1),t.applyPopupShow=!0):Object(d["a"])(t.$t("lang.interface_error_reporting"))})})},onRightsCard:function(){this.$store.dispatch("setDrpRightsCard",{membership_card_id:this.card_id})},toggleConfirm:function(){this.confirm=!this.confirm},closePopup:function(){this.applyPopupShow=!1},articleHref:function(t){this.$router.push({name:"articleDetail",params:{id:t}})},protectionHref:function(t,i){this.$router.push({name:"drp-protection",query:{card_id:t,index:i}})},drpInfoHref:function(){this.$router.push({name:"drp-info"})},onAddCartClicked:function(t,i){var e=this;this.$store.dispatch("setAddCart",{goods_id:t,num:1,spec:[],rec_type:i}).then(function(t){1==t?e.$router.push({name:"checkout",query:{rec_type:i}}):Object(d["a"])(t.msg)})}},watch:{drpChangeCard:function(){var t=this;setTimeout(function(){t.dscLoading=!1},1e3)},drpRightsCard:function(){var t=this;setTimeout(function(){t.dscLoading=!1},1e3)}}},x=$,w=e("2877"),k=Object(w["a"])(x,a,n,!1,null,null,null);k.options.__file="DrpApply.vue";i["default"]=k.exports},"4cf9":function(t,i,e){},"5fbe":function(t,i,e){},"66b9":function(t,i,e){"use strict";e("68ef")},"8a58":function(t,i,e){"use strict";e("68ef"),e("4d75")},"93ac":function(t,i,e){"use strict";e("68ef"),e("4cf9")},9718:function(t,i,e){},a637:function(t,i,e){"use strict";var s=e("2662"),a=e.n(s);a.a},ac1e:function(t,i,e){"use strict";e("68ef")},b528:function(t,i,e){"use strict";var s=e("fe7e"),a=e("9584");i["a"]=Object(s["a"])({render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"van-hairline",class:t.b(),on:{click:t.onClick}},[e("icon",{class:[t.b("icon"),t.iconClass],attrs:{info:t.info,name:t.icon}}),t._t("default",[t._v(t._s(t.text))])],2)},name:"goods-action-mini-btn",mixins:[a["a"]],props:{text:String,info:[String,Number],icon:String,iconClass:String},methods:{onClick:function(t){this.$emit("click",t),this.routerLink()}}})},bb33:function(t,i,e){"use strict";var s=e("fe7e");i["a"]=Object(s["a"])({render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{class:t.b()},[t._t("default")],2)},name:"goods-action"})},c1ee:function(t,i,e){"use strict";var s=e("9718"),a=e.n(s);a.a},d567:function(t,i,e){"use strict";var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"sus-nav"},[e("div",{staticClass:"common-nav",class:{active:!0===t.navType},attrs:{id:"moveDiv"},on:{touchstart:t.down,touchmove:t.move,touchend:t.end}},[e("div",{staticClass:"right-cont",attrs:{id:"rightDiv"}},[e("ul",[e("li",{on:{click:function(i){t.routerLink("home")}}},[e("i",{staticClass:"iconfont icon-zhuye"}),e("p",[t._v(t._s(t.$t("lang.home")))])]),"drp"!=t.routerName&&"crowd_funding"!=t.routerName&&"team"!=t.routerName&&"supplier"!=t.routerName&&"presale"!=t.routerName?e("li",{on:{click:function(i){t.routerLink("search")}}},[e("i",{staticClass:"iconfont icon-search"}),e("p",[t._v(t._s(t.$t("lang.search")))])]):t._e(),e("li",{on:{click:function(i){t.routerLink("catalog")}}},[e("i",{staticClass:"iconfont icon-menu"}),e("p",[t._v(t._s(t.$t("lang.category")))])]),e("li",{on:{click:function(i){t.routerLink("cart")}}},[e("i",{staticClass:"iconfont icon-cart"}),e("p",[t._v(t._s(t.$t("lang.cart")))])]),e("li",{on:{click:function(i){t.routerLink("user")}}},[e("i",{staticClass:"iconfont icon-gerenzhongxin"}),e("p",[t._v(t._s(t.$t("lang.personal_center")))])]),"team"==t.routerName?e("li",{on:{click:function(i){t.routerLink("team")}}},[e("i",{staticClass:"iconfont icon-wodetuandui"}),e("p",[t._v(t._s(t.$t("lang.my_team")))])]):t._e(),"supplier"==t.routerName?e("li",{on:{click:function(i){t.routerLink("supplier")}}},[e("i",{staticClass:"iconfont icon-wodetuandui"}),e("p",[t._v(t._s(t.$t("lang.suppliers")))])]):t._e(),t._t("aloneNav")],2)]),e("div",{staticClass:"nav-icon",on:{click:t.handelNav}},[t._v(t._s(t.$t("lang.quick_navigation")))])]),e("div",{staticClass:"common-show",class:{active:!0===t.navType},on:{click:function(i){return i.stopPropagation(),t.handelShow(i)}}})])},a=[],n=(e("3846"),e("cadf"),e("551c"),e("097d"),{props:["routerName"],data:function(){return{navType:!1,flags:!1,position:{x:0,y:0},nx:"",ny:"",dx:"",dy:"",xPum:"",yPum:""}},mounted:function(){this.flags=!1},methods:{handelNav:function(){this.navType=1!=this.navType},handelShow:function(){this.navType=!1},down:function(){var t;this.flags=!0,t=event.touches?event.touches[0]:event,this.position.x=t.clientX,this.position.y=t.clientY,this.dx=moveDiv.offsetLeft,this.dy=moveDiv.offsetTop},move:function(){var t,i,e,s;(event.preventDefault(),this.flags)&&(t=event.touches?event.touches[0]:event,i=document.documentElement.clientHeight,e=moveDiv.clientHeight,this.nx=t.clientX-this.position.x,this.ny=t.clientY-this.position.y,this.xPum=this.dx+this.nx,this.yPum=this.dy+this.ny,this.navType?this.yPum>0&&(s=i-e-this.yPum>0?i-e-this.yPum:0):(e+=rightDiv.clientHeight,this.yPum-e>0&&(s=i-this.yPum>0?i-this.yPum:0)),moveDiv.style.bottom=s+"px")},end:function(){this.flags=!1},routerLink:function(t){var i=this;"home"==t||"catalog"==t||"search"==t||"user"==t?setTimeout(function(){uni.getEnv(function(e){e.plus||e.miniprogram?"home"==t?uni.reLaunch({url:"../../pages/index/index"}):"catalog"==t?uni.reLaunch({url:"../../pages/category/category"}):"search"==t?uni.reLaunch({url:"../../pages/search/search"}):"user"==t&&uni.reLaunch({url:"../../pages/user/user"}):i.$router.push({name:t})}),uni.postMessage({data:{action:"postMessage"}})},100):i.$router.push({name:t})}}}),r=n,o=(e("c1ee"),e("2877")),c=Object(o["a"])(r,s,a,!1,null,null,null);c.options.__file="CommonNav.vue";i["a"]=c.exports},e41f:function(t,i,e){"use strict";var s=e("fe7e"),a=e("6605");i["a"]=Object(s["a"])({render:function(){var t,i=this,e=i.$createElement,s=i._self._c||e;return s("transition",{attrs:{name:i.currentTransition}},[i.shouldRender?s("div",{directives:[{name:"show",rawName:"v-show",value:i.value,expression:"value"}],class:i.b((t={},t[i.position]=i.position,t))},[i._t("default")],2):i._e()])},name:"popup",mixins:[a["a"]],props:{transition:String,overlay:{type:Boolean,default:!0},closeOnClickOverlay:{type:Boolean,default:!0},position:{type:String,default:""}},computed:{currentTransition:function(){return this.transition||(""===this.position?"van-fade":"popup-slide-"+this.position)}}})},f8b2:function(t,i,e){t.exports=e.p+"img/loading.gif"},f908:function(t,i,e){"use strict";e("68ef"),e("1f5b")}}]);