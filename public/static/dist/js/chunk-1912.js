(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1912"],{"0653":function(t,e,a){"use strict";a("68ef")},"09d6":function(t,e,a){"use strict";a("4917");var n=navigator.userAgent.toLowerCase();n.indexOf("Android")>-1||n.indexOf("Adr"),n.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);function i(){return!!/micromessenger/.test(n)}e["a"]={isWeixinBrowser:i}},"2cbf":function(t,e,a){"use strict";var n=a("6336"),i=a.n(n);i.a},"381a":function(t,e,a){},4917:function(t,e,a){a("214f")("match",1,function(t,e,a){return[function(a){"use strict";var n=t(this),i=void 0==a?void 0:a[e];return void 0!==i?i.call(a,n):new RegExp(a)[e](String(n))},a]})},"4d48":function(t,e,a){"use strict";a("68ef"),a("bf60")},6336:function(t,e,a){},"66b9":function(t,e,a){"use strict";a("68ef")},"7b0a":function(t,e,a){},"81e6":function(t,e,a){"use strict";a("68ef"),a("7b0a")},"84b4":function(t,e,a){var n=a("5ca1");n(n.S,"Math",{trunc:function(t){return(t>0?Math.floor:Math.ceil)(t)}})},"9ffb":function(t,e,a){"use strict";var n=a("fe7e");e["a"]=Object(n["a"])({render:function(){var t,e=this,a=e.$createElement,n=e._self._c||a;return n(e.tag,{tag:"component",class:e.b((t={},t[e.span]=e.span,t["offset-"+e.offset]=e.offset,t)),style:e.style},[e._t("default")],2)},name:"col",props:{span:[Number,String],offset:[Number,String],tag:{type:String,default:"div"}},computed:{gutter:function(){return this.$parent&&Number(this.$parent.gutter)||0},style:function(){var t=this.gutter/2+"px";return this.gutter?{paddingLeft:t,paddingRight:t}:{}}}})},bf60:function(t,e,a){},c194:function(t,e,a){"use strict";a("68ef")},c481:function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return t.qrcode?a("div",{staticClass:"paycode"},[a("van-row",{staticClass:"text-center m-top20"},[a("div",{staticClass:"m-top10"},[a("div",{staticClass:"icon"},[a("i",{staticClass:"iconfont icon-xinshoulibao color-red"})]),"0"==t.qrcode.type?a("span",{staticClass:"f-04"},[t._v(t._s(t.seller))]):a("span",{staticClass:"m-top20 price-title"},[t._v("￥"+t._s(t.qrcode.amount))])])]),"1"==t.qrcode.type?a("van-row",{staticClass:"m-top20 f-05"},[a("van-cell-group",[a("van-cell",{attrs:{title:t.$t("lang.label_collection_reason")}},[t._v(t._s(t.qrcode.qrpay_name))])],1)],1):a("van-row",{staticClass:"m-top20"},[a("van-cell-group",[a("van-cell",{attrs:{title:t.$t("lang.payment_amount"),icon:"edit"}}),a("currency-input",{attrs:{type:"tel"},model:{value:t.qrcode.amount,callback:function(e){t.$set(t.qrcode,"amount",e)},expression:"qrcode.amount"}})],1)],1),a("van-row",{staticClass:"m-top20"},[a("van-col",{attrs:{offset:"2",span:"20"}},[a("van-button",{attrs:{type:"primary",block:""},on:{click:t.doPay}},[t._v(t._s(t.$t("lang.immediate_pay")))])],1)],1)],1):t._e()},i=[],r=(a("e7e5"),a("d399")),o=a("88d8"),s=(a("66b9"),a("b650")),c=(a("81e6"),a("9ffb")),u=(a("4d48"),a("d1e1")),l=(a("0653"),a("34e9")),d=(a("7f7f"),a("c194"),a("7744")),f=(a("cadf"),a("551c"),a("097d"),a("2f62"),function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"currency"},[t.label?a("label",[t._v(t._s(t.label))]):t._e(),a("input",{ref:"input",class:{gray:t.isGray},attrs:{maxlength:"7",autocomplete:"off"},domProps:{value:t.value},on:{input:function(e){t.updateValue(e.target.value)},focus:t.selectAll,blur:t.formatValue}})])}),p=[],m=(a("c5f6"),a("84b4"),{format:function(t){return(Math.trunc(1e12*t)/1e12).toFixed(2)},parse:function(t,e){var a=function(t){return{value:t}},n=function(e,a){return{warning:e,value:a,attempt:t}},i=function(e){return new n(t+" is not a valid dollar amount",e)},r=function(e){return new n(t+" was automatically converted to "+e,e)},o=Number(t),s=t.indexOf("."),c=t.indexOf("e");if(isNaN(o))return-1===s&&c>0&&c===t.length-1&&0!==Number(t.slice(0,c))?new a(e):new i(e);var u=m.format(o),l=Number(u);return l===o?-1!==c&&c===t.length-2?new r(o):new a(o):new i(o>l?l:e)}}),y=m,v={name:"currency",props:{value:{type:Number,default:0},label:{type:String,default:"￥"},isGray:{type:Boolean,default:!0},isReadonly:{type:Boolean,default:!1}},mounted:function(){this.formatValue()},methods:{updateValue:function(t){var e=y.parse(t,this.value);this.$emit("update:updateGray",0===e.value),e.warning&&(this.$refs.input.value=e.value),e.value=e.value>=1e4?9999.99:e.value,this.$emit("input",e.value)},formatValue:function(){this.$refs.input.value=y.format(this.value)},selectAll:function(t){setTimeout(function(){t.target.select()},0)}}},g=v,h=(a("daf7"),a("2877")),b=Object(h["a"])(g,f,p,!1,null,"23f6e93a",null);b.options.__file="Currency.vue";var _,w=b.exports,q=a("4328"),x=a.n(q),O=a("bc3a"),j=a.n(O),C=a("09d6"),S={name:"qrpay",minxins:[C["a"]],components:(_={"currency-input":w},Object(o["a"])(_,d["a"].name,d["a"]),Object(o["a"])(_,l["a"].name,l["a"]),Object(o["a"])(_,u["a"].name,u["a"]),Object(o["a"])(_,c["a"].name,c["a"]),Object(o["a"])(_,s["a"].name,s["a"]),_),data:function(){return{seller:"",locked:!1,qrpay_id:0,isGray:!0,isReadonly:!1,qrcode:""}},created:function(){this.qrpay_id=this.$route.query.id||0,C["a"].isWeixinBrowser()?this.isLogin?this.getQrcodeDetail(this.qrpay_id):this.$router.push({path:"/login",query:{redirect:{name:"qrpay",params:{id:this.qrpay_id}}}}):this.getQrcodeDetail(this.qrpay_id)},computed:{isLogin:function(){return null!=localStorage.getItem("token")}},methods:{doPay:function(){var t=this,e=parseFloat(t.qrcode.amount);isNaN(e)||0==e?Object(r["a"])({message:this.$t("lang.enter_pay_in_balance"),forbidClick:!0}):0==t.locked&&(t.locked=!0,j.a.post("".concat(window.ROOT_URL,"api/v4/qrpay/pay"),x.a.stringify({id:t.qrpay_id,amount:t.qrcode.amount,_ajax:1})).then(function(e){t.locked=!1;var a=e.data;a.error>0&&alert(a.message),"alipay"==a.data.paycode?window.location.href=a.data.payment:"wxpay"==a.data.paycode&&t.callpay(JSON.parse(a.data.payment))}).catch(function(t){console.log(t)}))},getQrcodeDetail:function(t){var e=this;j.a.get("".concat(window.ROOT_URL,"api/v4/qrpay?id=")+parseInt(t),{params:{_ajax:1}}).then(function(t){var a=t.data;a.error>0&&alert(a.message),e.seller=a.data.seller,e.qrcode=a.data.qrcode,document.title=e.qrcode.qrpay_name}).catch(function(t){console.log(t)})},jsApiCall:function(t){var e=this;WeixinJSBridge.invoke("getBrandWCPayRequest",t,function(t){"get_brand_wcpay_request:ok"==t.err_msg?window.location.href=window.ROOT_URL+"/mobile/#/respond?type=qrpay&status=1&id="+e.qrpay_id:window.location.href=window.ROOT_URL+"/mobile/#/respond?type=qrpay&status=0&id="+e.qrpay_id})},callpay:function(t){"undefined"==typeof WeixinJSBridge?document.addEventListener?document.addEventListener("WeixinJSBridgeReady",this.jsApiCall(t),!1):document.attachEvent&&(document.attachEvent("WeixinJSBridgeReady",this.jsApiCall(t)),document.attachEvent("onWeixinJSBridgeReady",this.jsApiCall(t))):this.jsApiCall(t)}}},R=S,$=(a("2cbf"),Object(h["a"])(R,n,i,!1,null,"aa2b807c",null));$.options.__file="Qrpay.vue";e["default"]=$.exports},d1e1:function(t,e,a){"use strict";var n=a("fe7e");e["a"]=Object(n["a"])({render:function(){var t,e=this,a=e.$createElement,n=e._self._c||a;return n(e.tag,{tag:"component",class:e.b((t={flex:e.flex},t["align-"+e.align]=e.flex&&e.align,t["justify-"+e.justify]=e.flex&&e.justify,t)),style:e.style},[e._t("default")],2)},name:"row",props:{type:String,align:String,justify:String,tag:{type:String,default:"div"},gutter:{type:[Number,String],default:0}},computed:{flex:function(){return"flex"===this.type},style:function(){var t="-"+Number(this.gutter)/2+"px";return this.gutter?{marginLeft:t,marginRight:t}:{}}}})},daf7:function(t,e,a){"use strict";var n=a("381a"),i=a.n(n);i.a}}]);