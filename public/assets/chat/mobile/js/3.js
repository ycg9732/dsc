webpackJsonp([3],{"/uRM":function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,".message{padding:1rem;height:inherit;bottom:0;margin-bottom:4rem}.message .bubble-text{margin-bottom:1.4rem}.message .show-more{margin-top:0;padding:.4rem 0;line-height:1.5;z-index:11;font-size:1.3rem;width:100%;top:0;display:block;text-align:center;margin-bottom:1rem;background:#f7f7f9}.message__cell-group{border-radius:6px;overflow:hidden;width:100%;border:1px solid #dedfe0;margin-bottom:1.4rem}.message__cell-group .cell dt{display:flex;display:-webkit-flex;align-items:baseline;justify-content:space-between}.message__cell-group .cell img{width:5rem;height:5rem;border-radius:4px}.message__cell-group label span{color:#ff495e}",""])},"33uL":function(e,t,i){"use strict";var o=function(){var e=this,t=e.$createElement;return(e._self._c||t)("ul",{staticClass:"cell-group",class:{"border-top":e.borderTop,"border-bottom":e.borderBottom}},[e._t("default")],2)},l=[],r={render:o,staticRenderFns:l};t.a=r},"4Adt":function(e,t,i){var o=i("h0Xi");"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);i("rjj0")("5293be3e",o,!0,{})},"7+GK":function(e,t,i){"use strict";function o(e){i("lYPv")}var l=i("HnGF"),r=i("33uL"),a=i("VU/8"),s=o,A=a(l.a,r.a,!1,s,null,null);t.a=A.exports},"8Wsr":function(e,t,i){"use strict";var o=i("Dd8w"),l=i.n(o),r=i("NYxO"),a=i("6CWX");t.a={name:"cell",props:{id:{},title:{type:String,required:!0},label:{type:String},date:{type:String},buttonName:{type:String},buttonRoute:{type:Object},image:{type:String},link:{type:Boolean},number:{type:Number}},components:{Badge:a.a},computed:{imgHttp:function(){return window.imgHttp}},methods:l()({},i.i(r.b)("chat",["insertInfo"]),{thisInsertInfo:function(){this.$router.push({path:this.buttonRoute.path,query:this.buttonRoute.query}),this.insertInfo({goods_id:this.buttonRoute.query.goods_id,store_id:this.buttonRoute.query.sid,uid:this.buttonRoute.query.id})}})}},B1Az:function(e,t,i){"use strict";function o(e){i("kp+u")}var l=i("8Wsr"),r=i("t+L2"),a=i("VU/8"),s=o,A=a(l.a,r.a,!1,s,null,null);t.a=A.exports},HnGF:function(e,t,i){"use strict";t.a={name:"cell-group",props:{borderTop:{type:Boolean,default:!0},borderBottom:{type:Boolean,default:!0}}}},Orz0:function(e,t,i){"use strict";var o=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"message",on:{click:function(t){e.showFaceDialog({bShow:!1})}}},[i("a",{staticClass:"show-more",on:{click:function(t){e.setMessageList({id:e.$route.query.id,sid:e.$route.query.sid,defaults:1,page:e.page})}}},[e._v("查看更多")]),e._v(" "),e._l(e.message,function(t){return[0!=t.user_type?i("bubble-text",{key:t.id,attrs:{text:t.message,direction:"1"===t.user_type?"right":"left",date:t.name+" "+t.add_time,image:t.avatar}}):[t.goods_name?i("cell-group",{key:t.id,staticClass:"message__cell-group"},[i("a",{attrs:{href:t.goods_url}},[i("cell",{attrs:{image:t.goods_thumb||"",title:t.goods_name,label:t.goods_price||t.shop_price}})],1)]):e._e()]]})],2)},l=[],r={render:o,staticRenderFns:l};t.a=r},P92t:function(e,t){e.exports="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABQAAD/4QMxaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzA2NyA3OS4xNTc3NDcsIDIwMTUvMDMvMzAtMjM6NDA6NDIgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE1IChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkNEMEY1NjdEOTIyMTExRTc4MzBCQkIwQTJFN0VERjNFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkNEMEY1NjdFOTIyMTExRTc4MzBCQkIwQTJFN0VERjNFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6Q0QwRjU2N0I5MjIxMTFFNzgzMEJCQjBBMkU3RURGM0UiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6Q0QwRjU2N0M5MjIxMTFFNzgzMEJCQjBBMkU3RURGM0UiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAACAgICAgICAgICAwICAgMEAwICAwQFBAQEBAQFBgUFBQUFBQYGBwcIBwcGCQkKCgkJDAwMDAwMDAwMDAwMDAwMAQMDAwUEBQkGBgkNCwkLDQ8ODg4ODw8MDAwMDA8PDAwMDAwMDwwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAB4AHgDAREAAhEBAxEB/8QAfgABAAEFAQEAAAAAAAAAAAAAAAYCAwQFBwEJAQEBAQEAAAAAAAAAAAAAAAAAAQMCEAACAQMCAwUGBAcBAAAAAAAAAQIRAwQxBSFhEkFRcRMGgZGhwTJDsUJi0iKisiMUNFQVEQEBAAMBAQEBAAAAAAAAAAAAARECEjFRQSH/2gAMAwEAAhEDEQA/APtSbqAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADIxsa9l3Y2bEeqb4t9iXe2S3AleN6exYRTyZSvz7Un0xXu4nF3Mst7JtlP9anPrn+4nVRrsv07bcXLDuOM19qbqnyT7Czf6uUVuW52pyt3IuE4OkovVM0FAAAAAAAAAAAAnmzYaxcOE2v7uQlOb5P6V7jLa5qNucgAAjXqHDjK3HNgqTg1C7zi9H7Gd6X8WIiaAAAAAAAAAAvY9tXb9i09LlyMX4N0FHTEkkklRLgkYI9AAAMXNtK9iZNtqvVblTxSqviWejmxsoAAAAAAAAA2e0WFfz7Cborb8x0/TxXxOdr/B0AyQAAAPJRUoyi9JJp05gczyLXkX71mtfKnKFe+jobxVkAAAAAAAABlYWVLDybWRFVUH/HHvi+DRLMjoePft5VmF+024XFVV14cGmZWYReIAADCz863gWPNmnKUn024LtlSvuLJkc8nOVyc7k3Wc5OUnzfFmyqAAAAAAAAAACS7HuULK/wAO++mE5Vs3Hom+xnG2v6JcZoAUylGEZTm1GMVWUnokgILu+4LOvRVqvkWaqDf5m9Wa6zCtQdAAAAAAAAAAAAOl4jlLFxnP63ag5V1rRGN9RkEGo3xyW3XumvFxUqd3UjrX0QM1UAAAAAAAAAAMuxg5mTTyceck/wA9KR97oiWyCR4GwK3KN3NanKPGNiPGNf1Pt8Di7/DKSnCAFM4QuQlbnFShNUlF6NMCJ5np+7GTnhyVyD4+VJ0kuSejNJv9XLQ3sXIx3S/Znb5yXD36HUuRYKAAAAAAAJjsu22Vjwyr1tXLt2rh1cVGOiouepntsJEcIAAAAAB44qScZJSi9U+KAiO+bbax4xyseHRFy6bttaJvRruNNdlRs7AAAAAAOkbfR4OHTTyYf0qpjfUZZAAAAAAABrt3UXt2V1aKKa8aqnxLr6OemygAAAAAbjD3rKxLcbKjC7ah9KknVLXVHN1yNpb9SQ+7itPvjKv4pHPBhkx9Q4T+qF2HsT/BjimF5b7tz1uyj4wl8kyc1Ff/ALe2f9P8k/2jmih77ty0uylyUJfNIc0WJeosJfTbuz9iXzLxVwxbnqVfaxG+cpfJIcGGqzd3ys227U1C3abTcIrWmlW6nU1wNUdAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//Z"},RdYp:function(e,t,i){"use strict";function o(e){i("Zc4b")}Object.defineProperty(t,"__esModule",{value:!0});var l=i("aF3M"),r=i("Orz0"),a=i("VU/8"),s=o,A=a(l.a,r.a,!1,s,null,null);t.default=A.exports},Zc4b:function(e,t,i){var o=i("/uRM");"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);i("rjj0")("94c4fff2",o,!0,{})},aF3M:function(e,t,i){"use strict";var o=i("Dd8w"),l=i.n(o),r=i("NYxO"),a=i("7+GK"),s=i("B1Az"),A=i("nSE1");t.a={name:"message",props:{},components:{BubbleText:A.a,CellGroup:a.a,Cell:s.a},beforeRouteEnter:function(e,t,i){i(function(t){t.setMessageId({messageId:e.query.id}),t.$el.scrollTop=t.$el.scrollHeight-t.$el.offsetHeight})},beforeRouteLeave:function(e,t,i){this.changeToRead({userId:this.$route.query.id}),i()},created:function(){this.setMessageList({id:this.$route.query.id,sid:this.$route.query.sid,type:"default"}),this.showBottomNav(!1),this.showMessageInput(!0)},computed:l()({},i.i(r.a)("chat/bottomNavigator",["show"]),i.i(r.a)("chat/message",["bScroll"]),i.i(r.d)("chat/message",["message","page"])),methods:l()({},i.i(r.b)("chat/bottomNavigator",["showBottomNav"]),i.i(r.b)("chat/messageBottomInput",["showMessageInput"]),i.i(r.b)("chat/message",["setMessageList","changeToRead","setMessageId"]),i.i(r.b)(["showFaceDialog"])),watch:{message:{deep:!0,handler:function(e,t){var i=this;this.bScroll&&this.$nextTick(function(){i.$el.scrollTop=i.$el.scrollHeight-i.$el.offsetHeight})}}}}},h0Xi:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,'.bubble-text{clear:both;width:100%;display:box;display:-webkit-box}.bubble-text dl{display:block;box-flex:1;-moz-box-flex:1;flex:1;-webkit-box-flex:1}.bubble-text dl dd.text{font-size:1.4rem;padding:.4rem .8rem;border-radius:.6rem;margin-top:.3rem;position:relative;max-width:80%;word-wrap:break-word}.bubble-text dl dd.text:after{content:" ";width:0;height:0;position:absolute;border-bottom:1.4rem solid transparent;top:0}.bubble-text dl dd.text img{width:auto;height:auto;margin-right:0;margin-left:0;border-radius:4px;max-width:100%;display:inline-block;vertical-align:middle}.bubble-text dl dd.date{font-size:1.2rem;color:#9ea7b4}.bubble-text.left{float:left}.bubble-text.left img{margin-right:.8rem}.bubble-text.left dl{margin-left:.4rem}.bubble-text.left dd.text{background:#fff;float:left}.bubble-text.left dd.text:after{left:-.6rem;border-right:1.4rem solid #fff}.bubble-text.right{float:right}.bubble-text.right img{margin-left:.8rem}.bubble-text.right dl{margin-right:.4rem}.bubble-text.right dd.text{color:#fff;background:#ff495e;float:right}.bubble-text.right dd.text:after{right:-.6rem;border-left:1.2rem solid #ff495e}.bubble-text.right dd.date{text-align:right}.bubble-text img{width:3.6rem;height:3.6rem;border-radius:9999px;display:block}',""])},kMFx:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,".cell{position:relative;background:#fff;padding:1.2rem 1rem;display:-moz-box;display:-moz-flex;display:-ms-flex;display:flex;display:-webkit-flex;align-items:center;justify-content:initial;display:box;display:-webkit-box}.cell em.badge{position:absolute;top:1rem;left:4rem}.cell dl{box-flex:1;-moz-box-flex:1;flex:1;-webkit-box-flex:1}.cell dt{color:#333;font-size:1.4rem;max-height:4.2rem;overflow:hidden;display:-moz-box;display:-webkit-box;display:box;display:-moz-flex;display:-ms-flex;display:flex;display:-webkit-flex;align-items:center;justify-content:space-between}.cell dt em{font-size:1.2rem;color:#9ea7b4;float:right}.cell dd{font-size:1.34rem;color:#9ea7b4;width:100%;line-height:1.4;display:box;display:-webkit-box}.cell dd label{display:block;margin-right:.4rem;box-flex:1;-moz-box-flex:1;flex:1;-webkit-box-flex:1}.cell dd label span{display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;-webkit-box-orient:vertical}.cell .btn{font-size:1.1rem;text-align:center;border-radius:.2rem;padding:.1rem .4rem;border:1px solid #ff495e;color:#ff495e;z-index:1}.cell img{width:4rem;height:4rem;margin-right:.8rem;border-radius:9999px;display:block}.cell .icon-arrow{position:absolute;font-size:1.3rem;color:#9ea7b4;top:50%;transform:translateY(-50%)}",""])},"kp+u":function(e,t,i){var o=i("kMFx");"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);i("rjj0")("e6578d30",o,!0,{})},lP8f:function(e,t,i){"use strict";var o=function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("div",{staticClass:"bubble-text",class:e.direction},[void 0!=e.image&&"left"==e.direction?[e.image?o("img",{attrs:{src:e.imgHttp+e.image,alt:""}}):o("img",{attrs:{src:i("P92t"),alt:""}})]:e._e(),e._v(" "),o("dl",[o("dd",{staticClass:"date"},[e._v(e._s(e.date))]),e._v(" "),o("dd",{staticClass:"text",domProps:{innerHTML:e._s(e.text)}})]),e._v(" "),void 0!=e.image&&"right"==e.direction?[e.image?o("img",{attrs:{src:e.imgHttp+e.image,alt:""}}):o("img",{attrs:{src:i("P92t"),alt:""}})]:e._e()],2)},l=[],r={render:o,staticRenderFns:l};t.a=r},lYPv:function(e,t,i){var o=i("vh1G");"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);i("rjj0")("49ec38ec",o,!0,{})},nSE1:function(e,t,i){"use strict";function o(e){i("4Adt")}var l=i("xPB8"),r=i("lP8f"),a=i("VU/8"),s=o,A=a(l.a,r.a,!1,s,null,null);t.a=A.exports},"t+L2":function(e,t,i){"use strict";var o=function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("li",{staticClass:"cell",class:{image:void 0!=e.image,"right-arrow":e.link}},[o("badge",{directives:[{name:"show",rawName:"v-show",value:e.number,expression:"number"}],attrs:{number:e.number}}),e._v(" "),void 0!=e.image?[e.image?o("img",{attrs:{src:e.imgHttp+e.image,alt:""}}):o("img",{attrs:{src:i("P92t"),alt:""}})]:e._e(),e._v(" "),o("dl",[o("dt",[o("label",{attrs:{for:""}},[e._v(e._s(e.title))]),e._v(" "),o("em",{directives:[{name:"show",rawName:"v-show",value:e.date,expression:"date"}]},[e._v(e._s(e.date))])]),e._v(" "),o("dd",[o("label",{attrs:{for:""}},[o("span",{domProps:{innerHTML:e._s(e.label)}})]),e._v(" "),e.buttonName?o("a",{staticClass:"btn btn-default",on:{click:e.thisInsertInfo}},[e._v("\n            "+e._s(e.buttonName)+"\n        ")]):e._e()])]),e._v(" "),e.link?o("i",{staticClass:"iconfont icon-arrow"}):e._e()],2)},l=[],r={render:o,staticRenderFns:l};t.a=r},vh1G:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,'.cell-group .cell{border-bottom:.06rem solid #dedfe0}.cell-group .cell:before{content:" ";position:absolute;display:block;width:1.4rem;height:.06rem;background:#fff;left:0;bottom:-.06rem}.cell-group .cell.image:before{width:6rem}.cell-group .cell:last-of-type{border-bottom:none}.cell-group .cell:last-of-type:before{background:none}',""])},xPB8:function(e,t,i){"use strict";t.a={name:"bubble-text",props:{text:{type:String},date:{type:String},direction:{type:String,default:"left"},image:{type:String}},computed:{imgHttp:function(){return window.imgHttp}}}}});