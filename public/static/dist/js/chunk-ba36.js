(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-ba36"],{"0653":function(t,e,s){"use strict";s("68ef")},1146:function(t,e,s){},3846:function(t,e,s){s("9e1e")&&"g"!=/./g.flags&&s("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:s("0bfb")})},"565f":function(t,e,s){"use strict";var i=s("c31d"),a=s("fe7e"),n=s("a142");e["a"]=Object(a["a"])({render:function(){var t,e=this,s=e.$createElement,i=e._self._c||s;return i("cell",{class:e.b((t={error:e.error,disabled:e.$attrs.disabled,"min-height":"textarea"===e.type&&!e.autosize},t["label-"+e.labelAlign]=e.labelAlign,t)),attrs:{icon:e.leftIcon,title:e.label,center:e.center,border:e.border,"is-link":e.isLink,required:e.required}},[e._t("left-icon",null,{slot:"icon"}),e._t("label",null,{slot:"title"}),i("div",{class:e.b("body")},["textarea"===e.type?i("textarea",e._g(e._b({ref:"input",class:e.b("control",e.inputAlign),attrs:{readonly:e.readonly},domProps:{value:e.value}},"textarea",e.$attrs,!1),e.listeners)):i("input",e._g(e._b({ref:"input",class:e.b("control",e.inputAlign),attrs:{type:e.type,readonly:e.readonly},domProps:{value:e.value}},"input",e.$attrs,!1),e.listeners)),e.showClear?i("icon",{class:e.b("clear"),attrs:{name:"clear"},on:{touchstart:function(t){return t.preventDefault(),e.onClear(t)}}}):e._e(),e.$slots.icon||e.icon?i("div",{class:e.b("icon"),on:{click:e.onClickIcon}},[e._t("icon",[i("icon",{attrs:{name:e.icon}})])],2):e._e(),e.$slots.button?i("div",{class:e.b("button")},[e._t("button")],2):e._e()],1),e.errorMessage?i("div",{class:e.b("error-message"),domProps:{textContent:e._s(e.errorMessage)}}):e._e()],2)},name:"field",inheritAttrs:!1,props:{value:[String,Number],icon:String,label:String,error:Boolean,center:Boolean,isLink:Boolean,leftIcon:String,readonly:Boolean,required:Boolean,clearable:Boolean,labelAlign:String,inputAlign:String,onIconClick:Function,autosize:[Boolean,Object],errorMessage:String,type:{type:String,default:"text"},border:{type:Boolean,default:!0}},data:function(){return{focused:!1}},watch:{value:function(){this.$nextTick(this.adjustSize)}},mounted:function(){this.format(),this.$nextTick(this.adjustSize)},computed:{showClear:function(){return this.clearable&&this.focused&&""!==this.value&&this.isDef(this.value)&&!this.readonly},listeners:function(){return Object(i["a"])({},this.$listeners,{input:this.onInput,keypress:this.onKeypress,focus:this.onFocus,blur:this.onBlur})}},methods:{focus:function(){this.$refs.input&&this.$refs.input.focus()},blur:function(){this.$refs.input&&this.$refs.input.blur()},format:function(t){void 0===t&&(t=this.$refs.input);var e=t,s=e.value,i=this.$attrs.maxlength;return this.isDef(i)&&s.length>i&&(s=s.slice(0,i),t.value=s),s},onInput:function(t){this.$emit("input",this.format(t.target))},onFocus:function(t){this.focused=!0,this.$emit("focus",t),this.readonly&&this.blur()},onBlur:function(t){this.focused=!1,this.$emit("blur",t)},onClickIcon:function(){this.$emit("click-icon"),this.onIconClick&&this.onIconClick()},onClear:function(){this.$emit("input",""),this.$emit("clear")},onKeypress:function(t){if("number"===this.type){var e=t.keyCode,s=-1===String(this.value).indexOf("."),i=e>=48&&e<=57||46===e&&s||45===e;i||t.preventDefault()}"search"===this.type&&13===t.keyCode&&this.blur(),this.$emit("keypress",t)},adjustSize:function(){var t=this.$refs.input;if("textarea"===this.type&&this.autosize&&t){t.style.height="auto";var e=t.scrollHeight;if(Object(n["d"])(this.autosize)){var s=this.autosize,i=s.maxHeight,a=s.minHeight;i&&(e=Math.min(e,i)),a&&(e=Math.max(e,a))}e&&(t.style.height=e+"px")}}}})},"63af":function(t,e,s){"use strict";s.r(e);var i,a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"con_main"},[s("section",{staticClass:"section-list"},[s("div",{staticClass:"detail-title"},[t._v(t._s(t.$t("lang.return_apply_title")))]),s("div",{staticClass:"bg-color-write"},[t.refoundDetail?s("div",{staticClass:"product-list product-list-small"},[s("ul",[s("li",[s("div",{staticClass:"product-div"},[s("div",{staticClass:"product-list-img"},[s("img",{staticClass:"img",attrs:{src:t.refoundDetail.goods_thumb}})]),s("div",{staticClass:"product-info"},[s("h4",[t._v(t._s(t.refoundDetail.goods_name))]),s("div",{staticClass:"price"},[s("em",[t._v(t._s(t.refoundDetail.goods_price))]),s("span",[t._v("x"+t._s(t.refoundDetail.return_number))])]),t.refoundDetail.get_order_return?s("div",{staticClass:"p-t-remark"},[t._v(t._s(t.refoundDetail.get_order_return.attr_val))]):t._e()])])])])]):t._e()])]),s("section",{staticClass:"section-list"},[s("div",{staticClass:"detail-title"},[t._v(t._s(t.$t("lang.detail_info")))]),s("ul",{staticClass:"user-refound-box"},[s("li",[s("div",[t._v(t._s(t.$t("lang.return_sn_user"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.return_sn))])]),s("li",[s("label",[t._v(t._s(t.$t("lang.apply_time"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.apply_time))])]),s("li",[s("label",[t._v(t._s(t.$t("lang.service_type"))+":")]),s("div",{staticClass:"value color-red"},[0==t.refoundDetail.return_type?[t._v("\n                    "+t._s(t.$t("lang.order_return_type_0"))+"\n                    ")]:1==t.refoundDetail.return_type?[t._v("\n                    "+t._s(t.$t("lang.order_return_type_1"))+"\n                    ")]:2==t.refoundDetail.return_type?[t._v("\n                    "+t._s(t.$t("lang.order_return_type_2"))+"\n                    ")]:[t._v("\n                    "+t._s(t.$t("lang.order_return_type_3"))+"\n                    ")]],2)])]),s("div",{staticClass:"detail-title m-top10"},[t._v(t._s(t.$t("lang.order_status")))]),s("ul",{staticClass:"user-refound-box"},[s("li",[s("label",[t._v(t._s(t.$t("lang.order_status"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.return_status1)+" - "+t._s(t.refoundDetail.refound_status1))])]),s("li",[s("label",[t._v(t._s(t.$t("lang.problem_desc"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.return_brief))])]),6==t.refoundDetail.return_status?[s("li",[s("label",[t._v(t._s(t.$t("lang.refusal_cause"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.action_note))])])]:[s("li",[s("label",[t._v(t._s(t.$t("lang.return_reason"))+":")]),s("div",{staticClass:"value color-red"},[t._v(t._s(t.refoundDetail.return_cause))])])],1==t.refoundDetail.return_type||3==t.refoundDetail.return_type?[s("li",[s("label",[t._v(t._s(t.$t("lang.amount_return"))+":")]),s("div",{staticClass:"value"},[s("div",{staticClass:"price"},[s("em",[t._v(t._s(t.refoundDetail.formated_should_return))])])])])]:t._e(),t.refoundDetail.return_shipping_fee>0?[s("li",[s("label",[t._v(t._s(t.$t("lang.return_shipping"))+":")]),s("div",{staticClass:"value"},[s("div",{staticClass:"price"},[s("em",[t._v("+ "+t._s(t.refoundDetail.formated_return_shipping_fee))])])])])]:t._e(),t.refoundDetail.goods_coupons>0?[s("li",[s("label",[t._v(t._s(t.$t("lang.coupons"))+":")]),s("div",{staticClass:"value"},[s("div",{staticClass:"price"},[s("em",[t._v("- "+t._s(t.refoundDetail.formated_goods_coupons))])])])])]:t._e(),t.refoundDetail.goods_bonus>0?[s("li",[s("label",[t._v(t._s(t.$t("lang.bonus"))+":")]),s("div",{staticClass:"value"},[s("div",{staticClass:"price"},[s("em",[t._v("- "+t._s(t.refoundDetail.formated_goods_bonus))])])])])]:t._e(),t.refoundDetail.actual_return>0?[s("li",[s("label",[t._v(t._s(t.$t("lang.actual_return"))+":")]),s("div",{staticClass:"value"},[s("div",{staticClass:"price"},[s("em",[t._v(t._s(t.refoundDetail.formated_actual_return))])])])])]:t._e()],2),t.refoundDetail.img_list&&t.refoundDetail.img_list.length>0?[s("ul",{staticClass:"user-refound-box b-color-f m-top10"},[s("li",{staticClass:"dis-box"},[s("div",[t._v(t._s(t.$t("lang.voucher_pic"))+":")]),t._m(0)]),s("div",{staticClass:"goods-evaluation-page b-color-f tab-con refound-list-box"},[s("div",{staticClass:"my-gallery",attrs:{"data-pswp-uid":"5"}},t._l(t.refoundDetail.img_list,function(t,e){return s("figure",{key:e},[s("div",[s("a",{attrs:{href:t.img_file,"data-size":"640x640"}},[s("img",{staticClass:"img",attrs:{src:t.img_file}})])])])})),t._m(1)])])]:t._e(),s("ul",{staticClass:"user-refound-box m-top10"},[s("li",[s("label",[t._v(t._s(t.$t("lang.consignee"))+":")]),s("div",{staticClass:"value"},[t._v(t._s(t.refoundDetail.addressee))])]),s("li",[s("label",[t._v(t._s(t.$t("lang.phone_number"))+":")]),s("div",{staticClass:"value"},[t._v(t._s(t.refoundDetail.phone))])]),s("li",[s("label",[t._v(t._s(t.$t("lang.address_alt"))+":")]),s("div",{staticClass:"value"},[t._v(t._s(t.refoundDetail.address_detail))])])]),1==t.refoundDetail.agree_apply&&3!=t.refoundDetail.return_type?[t.refoundDetail.back_shipp_shipping?[s("div",{staticClass:"detail-title m-top10"},[t._v(t._s(t.$t("lang.express_info"))+" "),s("span",{staticClass:"help color-red"},[t._v("("+t._s(t.$t("lang.user_sent"))+")")])]),s("ul",{staticClass:"user-refound-box b-color-f m-top04"},[s("li",{staticClass:"dis-box"},[s("div",[t._v(t._s(t.$t("lang.express_company"))+":")]),s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right"},[t._v(t._s(t.refoundDetail.back_shipp_shipping))])])]),s("li",{staticClass:"dis-box"},[s("div",[t._v(t._s(t.$t("lang.courier_sz"))+":")]),s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right"},[t._v(t._s(t.refoundDetail.back_invoice_no))])])]),t.refoundDetail.back_invoice_no_btn?s("li",{staticClass:"dis-box"},[s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right n-refound-btn"},[s("a",{staticClass:"btn-default-new current",attrs:{href:t.refoundDetail.back_invoice_no_btn}},[t._v(t._s(t.$t("lang.order_tracking")))])])])]):t._e()])]:[s("div",{staticClass:"detail-title m-top10"},[t._v(t._s(t.$t("lang.express_info"))+" "),s("span",{staticClass:"help color-red"},[t._v("("+t._s(t.$t("lang.fill_in_express_info"))+")")])]),s("van-cell-group",{staticClass:"van-cell-noright m-top08"},[s("van-cell",{attrs:{title:t.$t("lang.label_express_company")}},[s("div",{staticClass:"select-one-1"},[s("select",{directives:[{name:"model",rawName:"v-model",value:t.shippingSelect,expression:"shippingSelect"}],staticClass:"select form-control parent_cause_select",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){var e="_value"in t?t._value:t.value;return e});t.shippingSelect=e.target.multiple?s:s[0]}}},[t._l(t.shipping_list,function(e){return s("option",{domProps:{value:e.shipping_id}},[t._v(t._s(e.shipping_name))])}),s("option",{attrs:{value:"999"}},[t._v(t._s(t.$t("lang.outer_express")))])],2)])]),999==t.shippingSelect?s("van-cell",{attrs:{title:t.$t("lang.label_outer_express")}},[s("van-field",{staticClass:"van-cell-ptb0",attrs:{placeholder:t.$t("lang.fill_in_express_company")},model:{value:t.other_express,callback:function(e){t.other_express=e},expression:"other_express"}})],1):t._e(),s("van-cell",{attrs:{title:t.$t("lang.label_courier_sz")}},[s("van-field",{staticClass:"van-cell-ptb0",attrs:{placeholder:t.$t("lang.fill_in_courier_sz")},model:{value:t.express_sn,callback:function(e){t.express_sn=e},expression:"express_sn"}})],1),s("div",{staticClass:"filter-btn"},[s("div",{staticClass:"btn btn-submit",on:{click:t.submitBtn}},[t._v(t._s(t.$t("lang.subimt")))])])],1)],t.refoundDetail.out_shipp_shipping?[s("div",{staticClass:"detail-title m-top10"},[t._v(t._s(t.$t("lang.express_info"))+" "),s("span",{staticClass:"help color-red"},[t._v("("+t._s(t.$t("lang.seller_shipping"))+")")])]),s("ul",{staticClass:"user-refound-box b-color-f m-top04"},[s("li",{staticClass:"dis-box"},[s("div",[t._v(t._s(t.$t("lang.express_company"))+":")]),s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right"},[t._v(t._s(t.refoundDetail.out_shipp_shipping))])])]),s("li",{staticClass:"dis-box"},[s("div",[t._v(t._s(t.$t("lang.courier_sz"))+":")]),s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right"},[t._v(t._s(t.refoundDetail.out_invoice_no))])])]),t.refoundDetail.out_invoice_no_btn?s("li",{staticClass:"dis-box"},[s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right n-refound-btn"},[s("a",{staticClass:"btn-default-new current",attrs:{href:t.refoundDetail.out_invoice_no_btn}},[t._v(t._s(t.$t("lang.order_tracking")))])])])]):t._e()])]:t._e()]:t._e()],2),3==t.refoundDetail.status?[s("div",{staticClass:"filter-btn"},[s("div",{staticClass:"btn btn-submit",on:{click:t.receivedOrder}},[t._v(t._s(t.$t("lang.received")))])])]:4==t.refoundDetail.status||1==t.refoundDetail.status?[s("div",{staticClass:"filter-btn"},[s("div",{staticClass:"btn btn-submit"},[t._v(t._s(t.$t("lang.ss_received")))])])]:6==t.refoundDetail.status?[s("div",{staticClass:"filter-btn"},[s("div",{staticClass:"btn btn-submit"},[t._v(t._s(t.$t("lang.denied")))])])]:0==t.refoundDetail.agree_apply?[s("div",{staticClass:"filter-btn"},[s("div",{staticClass:"btn btn-submit"},[t._v(t._s(t.$t("lang.to_be_agreed")))])])]:t._e(),s("CommonNav")],2)},n=[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"box-flex"},[s("p",{staticClass:"col-3 text-right"})])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"refound-list-box-bg"},[s("div",{staticClass:"goods-list-close position-abo"},[s("i",{staticClass:"iconfont icon-guanbi2 text-r"})])])}],l=(s("ac6a"),s("9395")),o=s("88d8"),r=(s("e7e5"),s("d399")),c=(s("e17f"),s("2241")),u=(s("66b9"),s("b650")),_=(s("be7f"),s("565f")),d=(s("0653"),s("34e9")),p=(s("7f7f"),s("c194"),s("7744")),f=(s("cadf"),s("551c"),s("097d"),s("4328")),v=s.n(f),h=s("2f62"),g=s("6567"),m=s("d567"),b={data:function(){return{shippingSelect:999,other_express:"",express_sn:""}},components:(i={},Object(o["a"])(i,p["a"].name,p["a"]),Object(o["a"])(i,d["a"].name,d["a"]),Object(o["a"])(i,_["a"].name,_["a"]),Object(o["a"])(i,u["a"].name,u["a"]),Object(o["a"])(i,c["a"].name,c["a"]),Object(o["a"])(i,r["a"].name,r["a"]),Object(o["a"])(i,"ProductList",g["a"]),Object(o["a"])(i,"CommonNav",m["a"]),i),created:function(){this.refoundLoad()},computed:Object(l["a"])({},Object(h["c"])({refoundDetail:function(t){return t.user.refoundDetail}}),{shipping_list:function(){return this.refoundDetail.shipping_list?this.refoundDetail.shipping_list:[]}}),methods:{refoundLoad:function(){this.$store.dispatch("setReturnDatail",{ret_id:this.$route.query.ret_id})},receivedOrder:function(){var t=this;c["a"].confirm({message:this.$t("lang.confirm_received"),className:"text-center"}).then(function(){t.$http.post("".concat(window.ROOT_URL,"api/v4/refound/affirm_receive"),v.a.stringify({ret_id:t.$route.query.ret_id})).then(function(e){var s=e.data.data;Object(r["a"])(s.msg),0==s.code&&t.refoundLoad()})}).catch(function(){})},submitBtn:function(){var t=this;if(""==this.other_express)return Object(r["a"])(this.$t("lang.fill_in_express_company")),!1;if(""==this.express_sn)return Object(r["a"])(this.$t("lang.fill_in_courier_sz")),!1;var e={shipping_id:this.shippingSelect,express_name:this.other_express,express_sn:this.express_sn,order_id:this.refoundDetail.order_id,ret_id:this.refoundDetail.ret_id};this.$http.post("".concat(window.ROOT_URL,"api/v4/refound/edit_express"),v.a.stringify(e)).then(function(e){var s=e.data.data;Object(r["a"])(s.msg),0==s.code&&t.refoundLoad()})}},watch:{shippingSelect:function(){var t=this;this.shipping_list.length>0&&this.shipping_list.forEach(function(e){e.shipping_id==t.shippingSelect&&(t.other_express=e.shipping_name)})}}},C=b,x=s("2877"),$=Object(x["a"])(C,a,n,!1,null,null,null);$.options.__file="Detail.vue";e["default"]=$.exports},6567:function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return t.goodsInfo?s("div",{staticClass:"product-list product-list-small"},[s("ul",[s("li",[s("div",{staticClass:"product-div"},[s("div",{staticClass:"product-list-img"},[s("img",{staticClass:"img",attrs:{src:t.goodsInfo.goods_img}})]),s("div",{staticClass:"product-info"},[s("h4",[t._v(t._s(t.goodsInfo.goods_name))]),s("div",{staticClass:"price"},[s("em",[t._v(t._s(t.goodsInfo.shop_price_formated))]),s("span",[t._v("x1")])]),s("div",{staticClass:"p-t-remark"},[t._v(t._s(t.goodsInfo.attr_name))])])])])])]):t._e()},a=[],n={props:["goodsInfo"],data:function(){return{}}},l=n,o=s("2877"),r=Object(o["a"])(l,i,a,!1,null,null,null);r.options.__file="ProductList.vue";e["a"]=r.exports},"66b9":function(t,e,s){"use strict";s("68ef")},9718:function(t,e,s){},be7f:function(t,e,s){"use strict";s("68ef"),s("1146")},c194:function(t,e,s){"use strict";s("68ef")},c1ee:function(t,e,s){"use strict";var i=s("9718"),a=s.n(i);a.a},d567:function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"sus-nav"},[s("div",{staticClass:"common-nav",class:{active:!0===t.navType},attrs:{id:"moveDiv"},on:{touchstart:t.down,touchmove:t.move,touchend:t.end}},[s("div",{staticClass:"right-cont",attrs:{id:"rightDiv"}},[s("ul",[s("li",{on:{click:function(e){t.routerLink("home")}}},[s("i",{staticClass:"iconfont icon-zhuye"}),s("p",[t._v(t._s(t.$t("lang.home")))])]),"drp"!=t.routerName&&"crowd_funding"!=t.routerName&&"team"!=t.routerName&&"supplier"!=t.routerName&&"presale"!=t.routerName?s("li",{on:{click:function(e){t.routerLink("search")}}},[s("i",{staticClass:"iconfont icon-search"}),s("p",[t._v(t._s(t.$t("lang.search")))])]):t._e(),s("li",{on:{click:function(e){t.routerLink("catalog")}}},[s("i",{staticClass:"iconfont icon-menu"}),s("p",[t._v(t._s(t.$t("lang.category")))])]),s("li",{on:{click:function(e){t.routerLink("cart")}}},[s("i",{staticClass:"iconfont icon-cart"}),s("p",[t._v(t._s(t.$t("lang.cart")))])]),s("li",{on:{click:function(e){t.routerLink("user")}}},[s("i",{staticClass:"iconfont icon-gerenzhongxin"}),s("p",[t._v(t._s(t.$t("lang.personal_center")))])]),"team"==t.routerName?s("li",{on:{click:function(e){t.routerLink("team")}}},[s("i",{staticClass:"iconfont icon-wodetuandui"}),s("p",[t._v(t._s(t.$t("lang.my_team")))])]):t._e(),"supplier"==t.routerName?s("li",{on:{click:function(e){t.routerLink("supplier")}}},[s("i",{staticClass:"iconfont icon-wodetuandui"}),s("p",[t._v(t._s(t.$t("lang.suppliers")))])]):t._e(),t._t("aloneNav")],2)]),s("div",{staticClass:"nav-icon",on:{click:t.handelNav}},[t._v(t._s(t.$t("lang.quick_navigation")))])]),s("div",{staticClass:"common-show",class:{active:!0===t.navType},on:{click:function(e){return e.stopPropagation(),t.handelShow(e)}}})])},a=[],n=(s("3846"),s("cadf"),s("551c"),s("097d"),{props:["routerName"],data:function(){return{navType:!1,flags:!1,position:{x:0,y:0},nx:"",ny:"",dx:"",dy:"",xPum:"",yPum:""}},mounted:function(){this.flags=!1},methods:{handelNav:function(){this.navType=1!=this.navType},handelShow:function(){this.navType=!1},down:function(){var t;this.flags=!0,t=event.touches?event.touches[0]:event,this.position.x=t.clientX,this.position.y=t.clientY,this.dx=moveDiv.offsetLeft,this.dy=moveDiv.offsetTop},move:function(){var t,e,s,i;(event.preventDefault(),this.flags)&&(t=event.touches?event.touches[0]:event,e=document.documentElement.clientHeight,s=moveDiv.clientHeight,this.nx=t.clientX-this.position.x,this.ny=t.clientY-this.position.y,this.xPum=this.dx+this.nx,this.yPum=this.dy+this.ny,this.navType?this.yPum>0&&(i=e-s-this.yPum>0?e-s-this.yPum:0):(s+=rightDiv.clientHeight,this.yPum-s>0&&(i=e-this.yPum>0?e-this.yPum:0)),moveDiv.style.bottom=i+"px")},end:function(){this.flags=!1},routerLink:function(t){var e=this;"home"==t||"catalog"==t||"search"==t||"user"==t?setTimeout(function(){uni.getEnv(function(s){s.plus||s.miniprogram?"home"==t?uni.reLaunch({url:"../../pages/index/index"}):"catalog"==t?uni.reLaunch({url:"../../pages/category/category"}):"search"==t?uni.reLaunch({url:"../../pages/search/search"}):"user"==t&&uni.reLaunch({url:"../../pages/user/user"}):e.$router.push({name:t})}),uni.postMessage({data:{action:"postMessage"}})},100):e.$router.push({name:t})}}}),l=n,o=(s("c1ee"),s("2877")),r=Object(o["a"])(l,i,a,!1,null,null,null);r.options.__file="CommonNav.vue";e["a"]=r.exports}}]);