(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-577c"],{"3c68":function(t,e,o){"use strict";o.r(e);var a,s=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"home"},["store"==t.bType?[o("ec-search",{attrs:{preview:!1,data:t.searchStoreData}}),o("ec-shop-signs",{attrs:{preview:!1}}),o("ec-line",{attrs:{preview:!1,data:t.lineData}})]:"home"==t.bType?[o("app-down")]:t._e(),t._l(t.modules,function(e,a){return o("ec-"+e.module,{key:a,tag:"component",attrs:{data:e.data,preview:!1,"modules-index":a}},[t._v("\n    "+t._s(e)+"\n  ")])}),"store"==t.bType?[o("ec-shop-menu",{attrs:{preview:!1}}),o("CommonNav")]:["store"!=t.bType?o("ec-tab-down"):t._e(),t.bonusData?o("van-popup",{staticClass:"bonus-show",staticStyle:{width:"80%"},model:{value:t.bonusShow,callback:function(e){t.bonusShow=e},expression:"bonusShow"}},[o("a",{attrs:{href:t.bonusData.ad_link}},[t.bonusData.popup_ads?o("img",{staticClass:"img",attrs:{src:t.bonusData.popup_ads}}):t._e()])]):t._e()],"store"!=t.bType?o("ec-filter-top",{attrs:{preview:!1}}):t._e()],2)},i=[],n=o("9395"),r=(o("e7e5"),o("d399")),c=o("88d8"),u=(o("7f7f"),o("8a58"),o("e41f")),p=(o("1951"),o("450d"),o("eedf")),h=o.n(p),d=(o("cadf"),o("551c"),o("097d"),o("0b16"),o("4328")),l=o.n(d),f=o("2f62"),m=o("12f1"),b=o("dab5"),w=o("0f98"),g=o("0808"),y=o("6772"),S=o("133f"),v=o("7779"),_=o("29e5"),T=o("c150"),D=o("f639"),O=o("3324"),E=o("9508"),$=o("9220"),I=o("eb8e"),j=o("5839"),M=o("6b6e"),k=o("bd6c"),x=o("487f"),C=o("d567"),J=(o("bdc9"),{name:"home",components:(a={EcButton:h.a,EcSlide:m["a"],EcTitle:b["a"],EcAnnouncement:w["a"],EcNav:g["a"],EcLine:y["a"],EcBlank:S["a"],EcJigsaw:v["a"],EcProduct:_["a"],EcCoupon:T["a"],EcCountDown:D["a"]},Object(c["a"])(a,"EcButton",O["a"]),Object(c["a"])(a,"EcSearch",E["a"]),Object(c["a"])(a,"EcStore",$["a"]),Object(c["a"])(a,"EcShopSigns",I["a"]),Object(c["a"])(a,"EcShopMenu",j["a"]),Object(c["a"])(a,"EcTabDown",M["a"]),Object(c["a"])(a,"EcFilterTop",k["a"]),Object(c["a"])(a,"AppDown",x["a"]),Object(c["a"])(a,"CommonNav",C["a"]),Object(c["a"])(a,u["a"].name,u["a"]),a),data:function(){return{fromId:"",share:"",shop_title:"",initial:"",bonusShow:!1,bonusData:""}},created:function(){var t="";t="index"==this.bType?localStorage.getItem("modules")?0:"":this.$route.params.id;var e=JSON.parse(localStorage.getItem("modulesType"));null==e&&this.setModulesType(),this.init(t)},mounted:function(){"index"==this.bType&&this.shopConfig()},methods:{init:function(t){var e=JSON.parse(localStorage.getItem("modulesType")),o=this.$route.query.codeurl;if("home"==this.bType){if(e.type!=window.shopInfo.type||e.name!=this.bType||this.bStore!=t||null==this.modules||"true"===o)return this.getModule({ru_id:this.bStore,type:this.bType}),this.setModulesType(),void(this.initial=!0);this.initial=!1}else this.initial=!0,"topic"==this.bType?this.$store.dispatch("setModuleInfo",{id:this.$route.params.id,type:this.bType}):this.getModule({ru_id:this.bStore,type:this.bType})},setModulesType:function(){var t={type:window.shopInfo.type,name:this.bType};localStorage.setItem("modulesType",JSON.stringify(t))},getModule:function(t){var e=this;this.modules=[],this.$http.post("".concat(window.ROOT_URL,"api/v4/visual/default"),l.a.stringify(t)).then(function(o){var a=o.data;a.data?e.$store.dispatch("setModuleInfo",{id:a.data,type:t.type}):(Object(r["a"])({message:a.errors.message,duration:1e3}),e.$router.push({name:"home"}))})},shopConfig:function(){var t=this,e=JSON.parse(sessionStorage.getItem("configData"));e?(this.$wxShare.share({title:e.shop_title,desc:e.shop_desc,link:window.location.href,imgUrl:e.wap_logo}),document.title=e.shop_title):this.$http.get("".concat(window.ROOT_URL,"api/v4/shop/config")).then(function(e){var o=e.data.data;t.bonusData=o.bonus_ad,t.$wxShare.share({title:o.shop_title,desc:o.shop_desc,link:window.location.href,imgUrl:o.wap_logo}),document.title=o.shop_title,sessionStorage.setItem("configData",JSON.stringify(o))})}},computed:Object(n["a"])({},Object(f["c"])({searchStoreData:function(t){return t.shopInfo.searchStoreData},lineData:function(t){return t.shopInfo.lineData},titleData:function(t){return t.shopInfo.titleData},productData:function(t){return t.shopInfo.productData}}),{bStore:function(){return this.$route.params.id?this.$route.params.id:0},bType:function(){var t="index";return"home"==this.$route.name?t="index":"shopHome"==this.$route.name?t="store":"topicHome"==this.$route.name&&(t="topic"),t},bMoudles:function(){return 0<this.modules.length},modules:{get:function(){return this.$store.state.modules},set:function(t){this.$store.state.modules=t}}}),watch:{$route:function(t,e){this.fromId=e.params.id?parseInt(e.params.id):0,this.init(this.fromId)},bonusData:function(){this.bonusData&&1==this.bonusData.open&&(this.bonusShow=!0)}}}),N=J,R=(o("ef05"),o("2877")),U=Object(R["a"])(N,s,i,!1,null,"9227bd9c",null);U.options.__file="Home.vue";e["default"]=U.exports},"9ed4":function(t,e,o){},ef05:function(t,e,o){"use strict";var a=o("9ed4"),s=o.n(a);s.a}}]);