(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-309f"],{"10cb":function(t,i,e){},"255a":function(t,i,e){"use strict";var n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("van-popup",{attrs:{position:"bottom","close-on-click-overlay":!1},on:{"click-overlay":t.overlay},model:{value:t.display,callback:function(i){t.display=i},expression:"display"}},[e("div",{staticClass:"mod-address-main"},[e("div",{staticClass:"mod-address-head dis-box"},[e("div",{staticClass:"mod-address-head-tit box-flex"},[t._v(t._s(t.$t("lang.delivery_to_the")))]),e("div",{staticClass:"mod-address-head-right box-flex"},[e("i",{staticClass:"iconfont icon-close",on:{click:t.onRegionClose}})])]),e("div",{staticClass:"mod-address-body"},[e("ul",{staticClass:"ulAddrTab"},[t.regionOption.province.name?e("li",{class:{cur:t.regionLevel-1==1},on:{click:function(i){t.tabClickRegion(1,1)}}},[e("span",[t._v(t._s(t.regionOption.province.name))])]):e("li",[e("span",[t._v(t._s(t.$t("lang.select")))])]),t.regionOption.city.name?e("li",{class:{cur:t.regionLevel-1==2},on:{click:function(i){t.tabClickRegion(t.regionOption.province.id,2)}}},[e("span",[t._v(t._s(t.regionOption.city.name))])]):t._e(),t.regionOption.district.name?e("li",{class:{cur:t.regionLevel-1==3},on:{click:function(i){t.tabClickRegion(t.regionOption.city.id,3)}}},[e("span",[t._v(t._s(t.regionOption.district.name))])]):t._e(),t.regionOption.street.name?e("li",{class:{cur:t.regionLevel-1==4},on:{click:function(i){t.tabClickRegion(t.regionOption.district.id,4)}}},[e("span",[t._v(t._s(t.regionOption.street.name))])]):t._e()]),2==t.regionLevel?e("ul",{staticClass:"ulAddrList"},t._l(t.regionDate.provinceData,function(i,n){return e("li",{key:n,class:{active:t.regionOption.province.id==i.id},on:{click:function(e){t.childRegion(i.id,i.name,i.level)}}},[t._v(t._s(i.name))])})):t._e(),3==t.regionLevel?e("ul",{staticClass:"ulAddrList"},t._l(t.regionDate.cityDate,function(i,n){return e("li",{key:n,class:{active:t.regionOption.city.id==i.id},on:{click:function(e){t.childRegion(i.id,i.name,i.level)}}},[t._v(t._s(i.name))])})):t._e(),4==t.regionLevel?e("ul",{staticClass:"ulAddrList"},t._l(t.regionDate.districtDate,function(i,n){return e("li",{key:n,class:{active:t.regionOption.district.id==i.id},on:{click:function(e){t.childRegion(i.id,i.name,i.level)}}},[t._v(t._s(i.name))])})):t._e(),5==t.regionLevel?e("ul",{staticClass:"ulAddrList"},t._l(t.regionDate.streetDate,function(i,n){return e("li",{key:n,class:{active:t.regionOption.street.id==i.id},on:{click:function(e){t.childRegion(i.id,i.name,i.level)}}},[t._v(t._s(i.name))])})):t._e()])])])},s=[],o=e("88d8"),a=(e("7f7f"),e("8a58"),e("e41f")),r=(e("cadf"),e("551c"),e("097d"),e("2f62"),{props:["display","regionOptionDate","isPrice"],data:function(){return{regionOption:this.regionOptionDate}},components:Object(o["a"])({},a["a"].name,a["a"]),created:function(){this.$store.dispatch("setRegion",{region:1,level:1});var t=localStorage.getItem("regionOption"),i=JSON.parse(localStorage.getItem("userRegion"));null==t&&null!==i&&(this.regionOption.province=i.province?i.province:"",this.regionOption.city=i.city?i.city:"",this.regionOption.district=i.district?i.district:"",this.regionOption.regionSplic=this.regionOption.province.name+" "+this.regionOption.city.name+" "+this.regionOption.district.name,localStorage.setItem("regionOption",JSON.stringify(this.regionOption)))},computed:{regionId:function(){return this.$store.state.region.id},regionLevel:function(){return this.$store.state.region.level},regionDate:function(){return this.$store.state.region.data},status:{get:function(){return this.$store.state.region.status},set:function(t){this.$store.state.region.status=t}},isLogin:function(){return null!=localStorage.getItem("token")},userRegion:function(){return this.$store.state.userRegion}},methods:{onRegionClose:function(){this.$emit("update:display",!1)},childRegion:function(t,i,e){switch(this.status=!1,e){case 2:this.regionOption.province.id=t,this.regionOption.province.name=i;break;case 3:this.regionOption.city.id=t,this.regionOption.city.name=i;break;case 4:this.regionOption.district.id=t,this.regionOption.district.name=i;break;case 5:this.regionOption.street.id=t,this.regionOption.street.name=i;break;default:break}this.$store.dispatch("setRegion",{region:t,level:e})},tabClickRegion:function(t,i){var e=this,n=["province","city","district","street"];n.forEach(function(t,n){n+1>i&&(e.regionOption[t].id="",e.regionOption[t].name="")}),this.$store.dispatch("setRegion",{region:t,level:i})},overlay:function(){this.$emit("update:display",!1)}},watch:{status:function(){1==this.status&&(this.regionOption.regionSplic=this.regionOption.province.name+" "+this.regionOption.city.name+" "+this.regionOption.district.name+" "+this.regionOption.street.name,localStorage.setItem("regionOption",JSON.stringify(this.regionOption)),this.$emit("update:regionOptionDate",this.regionOption),this.$emit("update:display",!1),this.$emit("update:isPrice",1))},userRegion:function(){var t=localStorage.getItem("regionOption");null==t&&this.userRegion&&(this.regionOption.province=this.userRegion.province?this.userRegion.province:"",this.regionOption.city=this.userRegion.city?this.userRegion.city:"",this.regionOption.district=this.userRegion.district?this.userRegion.district:"",this.regionOption.regionSplic=this.regionOption.province.name+" "+this.regionOption.city.name+" "+this.regionOption.district.name,localStorage.setItem("regionOption",JSON.stringify(this.regionOption)))}}}),c=r,l=e("2877"),u=Object(l["a"])(c,n,s,!1,null,null,null);u.options.__file="Region.vue";i["a"]=u.exports},"5f5f":function(t,i,e){"use strict";e("68ef"),e("a526")},"8a58":function(t,i,e){"use strict";e("68ef"),e("4d75")},a526:function(t,i,e){},cd11:function(t,i,e){"use strict";e.r(i);var n,s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"con bg-color-write"},[e("div",{staticClass:"flow-consignee"},[e("div",{staticClass:"text-all dis-box"},[e("label",[t._v(t._s(t.$t("lang.consignee"))),e("em",[t._v("*")])]),e("div",{staticClass:"input-text"},[e("ec-input",{attrs:{type:"text",size:"consignee",placeholder:t.$t("lang.enter_consignee")},model:{value:t.consignee,callback:function(i){t.consignee=i},expression:"consignee"}}),e("i",{staticClass:"iconfont icon-guanbi1 close-common"})],1)]),e("div",{staticClass:"text-all dis-box"},[e("label",[t._v(t._s(t.$t("lang.phone_number"))),e("em",[t._v("*")])]),e("div",{staticClass:"input-text"},[e("ec-input",{attrs:{type:"tel",size:"mobile",placeholder:t.$t("lang.enter_contact_number")},model:{value:t.mobile,callback:function(i){t.mobile=i},expression:"mobile"}}),e("i",{staticClass:"iconfont icon-guanbi1 close-common"})],1)]),e("div",{staticClass:"text-all dis-box"},[e("label",[t._v(t._s(t.$t("lang.region_alt"))),e("em",[t._v("*")])]),e("div",{staticClass:"input-text"},[e("div",{staticClass:"address-box",on:{click:t.handelRegionShow}},[e("span",{staticClass:"text-all-span"},[t._v(t._s(t.regionSplic))]),t._m(0)])])]),e("div",{staticClass:"text-all"},[e("label",[t._v(t._s(t.$t("lang.detail_info"))),e("em",[t._v("*")])]),e("div",{staticClass:"input-text"},[e("ec-input",{attrs:{type:"text",size:"address",placeholder:t.$t("lang.enter_address")},model:{value:t.address,callback:function(i){t.address=i},expression:"address"}}),e("i",{staticClass:"iconfont icon-guanbi1 close-common"})],1)]),e("div",{staticClass:"ect-button-more"},[e("a",{staticClass:"btn btn-submit",attrs:{href:"javascript:;"},on:{click:t.submitBtn}},[t._v(t._s(t.$t("lang.save")))])])]),e("Region",{attrs:{display:t.regionShow,regionOptionDate:t.regionOptionDate},on:{"update:display":function(i){t.regionShow=i},"update:regionOptionDate":function(i){t.regionOptionDate=i}}})],1)},o=[function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("span",{staticClass:"user-more"},[e("i",{staticClass:"iconfont icon-more"})])}],a=e("88d8"),r=(e("e7e5"),e("d399")),c=(e("5f5f"),e("f253")),l=(e("7f7f"),e("8a58"),e("e41f")),u=(e("10cb"),e("450d"),e("f3ad")),d=e.n(u),h=(e("cadf"),e("551c"),e("097d"),e("2f62"),e("255a")),p={data:function(){return{regionShow:!1,regionOptionDate:{province:{id:"",name:""},city:{id:"",name:""},district:{id:"",name:""},street:{id:"",name:""},regionSplic:""},consignee:"",mobile:"",email:"",address:""}},components:(n={Region:h["a"],EcInput:d.a},Object(a["a"])(n,l["a"].name,l["a"]),Object(a["a"])(n,c["a"].name,c["a"]),Object(a["a"])(n,r["a"].name,r["a"]),n),created:function(){this.$route.params.id;var t=JSON.parse(localStorage.getItem("regionOption"));t&&(this.regionOptionDate=t)},computed:{regionSplic:function(){return this.regionOptionDate.regionSplic}},methods:{handelRegionShow:function(){this.regionShow=!this.regionShow,this.$store.dispatch("setRegion",{region:1,level:1})},submitBtn:function(){var t=this,i=this;if(""==this.consignee)return Object(r["a"])(this.$t("lang.consignee_not_null")),!1;if(!this.checkMobile())return Object(r["a"])(this.$t("lang.phone_number_format")),!1;if(""==this.regionOptionDate.regionSplic)return Object(r["a"])(this.$t("lang.fill_in_region")),!1;if(""==this.address)return Object(r["a"])(this.$t("lang.address_not_null")),!1;var e={goods_id:this.$route.params.id,consignee:this.consignee,mobile:this.mobile,country:1,province:this.regionOptionDate.province.id,city:this.regionOptionDate.city.id,district:this.regionOptionDate.district.id,street:this.regionOptionDate.street.id,address:this.address};this.$http.get("".concat(window.ROOT_URL,"api/v4/gift_gard/check_take"),{params:e}).then(function(e){e.data;Object(r["a"])(t.$t("lang.pick_success")),i.$http.get("".concat(window.ROOT_URL,"api/v4/gift_gard/exit_gift")).then(function(t){var e=t.data;0==e.data.error&&i.$router.push({name:"giftCardOrder"})})})},checkMobile:function(){var t=/^((13|14|15|16|17|18|19)[0-9]{1}\d{8})$/;return!!t.test(this.mobile)},shippingFee:function(t){this.$store.dispatch("setShippingFee",{goods_id:0,position:t})}},watch:{regionSplic:function(){var t={province_id:this.regionOptionDate.province.id,city_id:this.regionOptionDate.city.id,district_id:this.regionOptionDate.district.id,street_id:this.regionOptionDate.street.id};this.shippingFee(t)}}},g=p,f=e("2877"),m=Object(f["a"])(g,s,o,!1,null,null,null);m.options.__file="Address.vue";i["default"]=m.exports},e41f:function(t,i,e){"use strict";var n=e("fe7e"),s=e("6605");i["a"]=Object(n["a"])({render:function(){var t,i=this,e=i.$createElement,n=i._self._c||e;return n("transition",{attrs:{name:i.currentTransition}},[i.shouldRender?n("div",{directives:[{name:"show",rawName:"v-show",value:i.value,expression:"value"}],class:i.b((t={},t[i.position]=i.position,t))},[i._t("default")],2):i._e()])},name:"popup",mixins:[s["a"]],props:{transition:String,overlay:{type:Boolean,default:!0},closeOnClickOverlay:{type:Boolean,default:!0},position:{type:String,default:""}},computed:{currentTransition:function(){return this.transition||(""===this.position?"van-fade":"popup-slide-"+this.position)}}})},f253:function(t,i,e){"use strict";var n=e("fe7e"),s=e("1128");function o(t){return Array.isArray(t)?t.map(function(t){return o(t)}):"object"===typeof t?Object(s["a"])({},t):t}var a=e("a142"),r=200,c=Object(n["a"])({render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{class:[t.b(),t.className],style:t.columnStyle,on:{touchstart:t.onTouchStart,touchmove:function(i){return i.preventDefault(),t.onTouchMove(i)},touchend:t.onTouchEnd,touchcancel:t.onTouchEnd}},[e("ul",{style:t.wrapperStyle},t._l(t.options,function(i,n){return e("li",{staticClass:"van-ellipsis",class:t.b("item",{disabled:t.isDisabled(i),selected:n===t.currentIndex}),style:t.optionStyle,domProps:{innerHTML:t._s(t.getOptionText(i))},on:{click:function(i){t.setIndex(n,!0)}}})}))])},name:"picker-column",props:{valueKey:String,className:String,itemHeight:Number,visibleItemCount:Number,initialOptions:{type:Array,default:function(){return[]}},defaultIndex:{type:Number,default:0}},data:function(){return{startY:0,offset:0,duration:0,startOffset:0,options:o(this.initialOptions),currentIndex:this.defaultIndex}},created:function(){this.$parent.children&&this.$parent.children.push(this),this.setIndex(this.currentIndex)},destroyed:function(){var t=this.$parent.children;t&&t.splice(t.indexOf(this),1)},watch:{defaultIndex:function(){this.setIndex(this.defaultIndex)}},computed:{count:function(){return this.options.length},baseOffset:function(){return this.itemHeight*(this.visibleItemCount-1)/2},columnStyle:function(){return{height:this.itemHeight*this.visibleItemCount+"px"}},wrapperStyle:function(){return{transition:this.duration+"ms",transform:"translate3d(0, "+(this.offset+this.baseOffset)+"px, 0)",lineHeight:this.itemHeight+"px"}},optionStyle:function(){return{height:this.itemHeight+"px"}}},methods:{onTouchStart:function(t){this.startY=t.touches[0].clientY,this.startOffset=this.offset,this.duration=0},onTouchMove:function(t){var i=t.touches[0].clientY-this.startY;this.offset=Object(a["f"])(this.startOffset+i,-this.count*this.itemHeight,this.itemHeight)},onTouchEnd:function(){if(this.offset!==this.startOffset){this.duration=r;var t=Object(a["f"])(Math.round(-this.offset/this.itemHeight),0,this.count-1);this.setIndex(t,!0)}},adjustIndex:function(t){t=Object(a["f"])(t,0,this.count);for(var i=t;i<this.count;i++)if(!this.isDisabled(this.options[i]))return i;for(var e=t-1;e>=0;e--)if(!this.isDisabled(this.options[e]))return e},isDisabled:function(t){return Object(a["d"])(t)&&t.disabled},getOptionText:function(t){return Object(a["d"])(t)&&this.valueKey in t?t[this.valueKey]:t},setIndex:function(t,i){t=this.adjustIndex(t)||0,this.offset=-t*this.itemHeight,t!==this.currentIndex&&(this.currentIndex=t,i&&this.$emit("change",t))},setValue:function(t){for(var i=this.options,e=0;e<i.length;e++)if(this.getOptionText(i[e])===t)return this.setIndex(e)},getValue:function(){return this.options[this.currentIndex]}}});i["a"]=Object(n["a"])({render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{class:t.b()},[t.showToolbar?e("div",{staticClass:"van-hairline--top-bottom",class:t.b("toolbar")},[t._t("default",[e("div",{class:t.b("cancel"),on:{click:function(i){t.emit("cancel")}}},[t._v("\n        "+t._s(t.cancelButtonText||t.$t("cancel"))+"\n      ")]),t.title?e("div",{staticClass:"van-ellipsis",class:t.b("title"),domProps:{textContent:t._s(t.title)}}):t._e(),e("div",{class:t.b("confirm"),on:{click:function(i){t.emit("confirm")}}},[t._v("\n        "+t._s(t.confirmButtonText||t.$t("confirm"))+"\n      ")])])],2):t._e(),t.loading?e("div",{class:t.b("loading")},[e("loading")],1):t._e(),e("div",{class:t.b("columns"),style:t.columnsStyle,on:{touchmove:function(t){t.preventDefault()}}},[t._l(t.simple?[t.columns]:t.columns,function(i,n){return e("picker-column",{key:n,attrs:{"value-key":t.valueKey,"initial-options":t.simple?i:i.values,"class-name":i.className,"default-index":i.defaultIndex,"item-height":t.itemHeight,"visible-item-count":t.visibleItemCount},on:{change:function(i){t.onChange(n)}}})}),e("div",{staticClass:"van-hairline--top-bottom",class:t.b("frame"),style:t.frameStyle})],2)])},name:"picker",components:{PickerColumn:c},props:{title:String,loading:Boolean,showToolbar:Boolean,confirmButtonText:String,cancelButtonText:String,visibleItemCount:{type:Number,default:5},valueKey:{type:String,default:"text"},itemHeight:{type:Number,default:44},columns:{type:Array,default:function(){return[]}}},data:function(){return{children:[]}},computed:{frameStyle:function(){return{height:this.itemHeight+"px"}},columnsStyle:function(){return{height:this.itemHeight*this.visibleItemCount+"px"}},simple:function(){return this.columns.length&&!this.columns[0].values}},watch:{columns:function(){this.setColumns()}},methods:{setColumns:function(){var t=this,i=this.simple?[{values:this.columns}]:this.columns;i.forEach(function(i,e){t.setColumnValues(e,o(i.values))})},emit:function(t){this.simple?this.$emit(t,this.getColumnValue(0),this.getColumnIndex(0)):this.$emit(t,this.getValues(),this.getIndexes())},onChange:function(t){this.simple?this.$emit("change",this,this.getColumnValue(0),this.getColumnIndex(0)):this.$emit("change",this,this.getValues(),t)},getColumn:function(t){return this.children[t]},getColumnValue:function(t){var i=this.getColumn(t);return i&&i.getValue()},setColumnValue:function(t,i){var e=this.getColumn(t);e&&e.setValue(i)},getColumnIndex:function(t){return(this.getColumn(t)||{}).currentIndex},setColumnIndex:function(t,i){var e=this.getColumn(t);e&&e.setIndex(i)},getColumnValues:function(t){return(this.children[t]||{}).options},setColumnValues:function(t,i){var e=this.children[t];e&&JSON.stringify(e.options)!==JSON.stringify(i)&&(e.options=i,e.setIndex(0))},getValues:function(){return this.children.map(function(t){return t.getValue()})},setValues:function(t){var i=this;t.forEach(function(t,e){i.setColumnValue(e,t)})},getIndexes:function(){return this.children.map(function(t){return t.currentIndex})},setIndexes:function(t){var i=this;t.forEach(function(t,e){i.setColumnIndex(e,t)})}}})}}]);