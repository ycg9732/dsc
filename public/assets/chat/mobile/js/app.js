webpackJsonp([7],{"13DI":function(e,t,n){"use strict";function a(e){v=e;var t=v,i=t.vue,s=t.listen_route,o=t.port,c=t.avatar,d=t.name,g=t.uid,_=t.store_id,w=t.is_ssl;h=new WebSocket(u(w)+":"+s+":"+o),h.onopen=function(){h.send(l()({name:d,avatar:c,origin:r()?"pc":"phone",store_id:_,uid:g,type:"login",user_type:"service"}))},h.onmessage=function(e){var t=JSON.parse(e.data);switch(t.message_type){case"come":if(t.uid===v.user.user_id)break;break;case"leave":if(t.uid===v.user_id||""!==t.uid)break;break;case"init":break;case"come_msg":i.comeMessage(t);break;case"come_wait":i.comeWait(t);break;case"robbed":case"user_robbed":case"uoffline":case"close_link":break;case"others_login":m()({title:"提示",message:"您已被强迫下线！",cancelButtonText:"退出登录",confirmButtonText:"强制登录",showConfirmButton:!0,showCancelButton:!0,closeOnClickModal:!1}).then(function(e){"cancel"===e?n.i(f.b)({router:v.vue.$router,ws:!0}):window.location.reload()})}},h.onclose=function(){a(e)},clearInterval(p),p=setInterval(function(){h.send('{"type":"ping"}')},15e3)}function i(e){var t=e.msg,n=e.uid,a=e.goods_id;return!(!t||""===t||v==={}||""===v.uid||void 0===v.uid)&&(h.send(l()({avatar:v.avatar,goods_id:a,msg:t,origin:r()?"pc":"phone",store_id:v.store_id,to_id:n,type:"sendmsg"})),{avatar:v.avatar,name:v.name})}function s(){h.close()}function o(e){var t=e.goods_id,n=e.uid,a=e.store_id;h.send(l()({from_id:v.uid,goods_id:t,msg:n,store_id:a,to_id:null,type:"info"}))}function r(){for(var e=navigator.userAgent,t=["Android","iPhone","SymbianOS","Windows Phone","iPad","iPod"],n=!0,a=0;a<t.length;a++)if(e.indexOf(t[a])>0){n=!1;break}return n}function u(e){return e?"wss":"ws"}n.d(t,"b",function(){return a}),n.d(t,"a",function(){return s}),n.d(t,"c",function(){return i}),n.d(t,"d",function(){return o});var c=n("OgVB"),d=(n.n(c),n("/Lyv")),m=n.n(d),g=n("mvHQ"),l=n.n(g),f=n("Pi6f"),h=null,v=null,p=null},"34+y":function(e,t){},"48ln":function(e,t,n){"use strict";t.a={name:"ec-button",props:{text:{required:!0,type:String}}}},"6CWX":function(e,t,n){"use strict";function a(e){n("lyCt")}var i=n("RkRv"),s=n("ihTz"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,null,null);t.a=u.exports},"7tm0":function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("footer",{directives:[{name:"show",rawName:"v-show",value:e.show&&e.navs.length,expression:"show && navs.length"}],staticClass:"chat-footer"},[n("ul",e._l(e.navs,function(t){return n("router-link",{key:t.name,class:{active:t.active},attrs:{to:t.route.path,tag:"li"}},[n("badge",{directives:[{name:"show",rawName:"v-show",value:t.number,expression:"item.number"}],attrs:{number:t.number}}),e._v(" "),n("i",{staticClass:"iconfont",class:"icon-"+t.icon}),e._v(" "),n("label",{attrs:{for:""}},[e._v(e._s(t.text))])],1)}))])},i=[],s={render:a,staticRenderFns:i};t.a=s},Ac9d:function(e,t){},BwjS:function(e,t,n){"use strict";function a(e){n("N1hX")}var i=n("Vym9"),s=n("llGh"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,"data-v-fb50e844",null);t.a=u.exports},IcnI:function(e,t,n){"use strict";var a,i=n("bOdI"),s=n.n(i),o=n("Xu2r"),r=n("7+uW"),u=n("NYxO"),c=n("VAhz");r.default.use(u.c);var d={needPageTransition:!1,pageTransitionName:"",historyPageScrollTop:{},aFace:[],bFace:!1},m={saveScrollTop:function(e,t){var n=e.commit,a=t.path,i=t.scrollTop;n(o.a,{path:a,scrollTop:i})},getImageFiles:function(e){(0,e.commit)(o.b)},showFaceDialog:function(e,t){var n=e.commit,a=t.bShow;n(o.c,{bShow:a})}},g=(a={},s()(a,o.d,function(e,t){var n=t.pageTransitionName;e.pageTransitionName=n}),s()(a,o.a,function(e,t){var n=t.path,a=t.scrollTop;e.historyPageScrollTop[n]=a}),s()(a,o.b,function(e){for(var t=0;t<71;t++)e.aFace.push(t)}),s()(a,o.c,function(e,t){var n=t.bShow;e.bFace=void 0===n?!e.bFace:n}),a);t.a=new u.c.Store({state:d,actions:m,mutations:g,modules:{namespaced:!0,chat:c.a},strict:!1})},Kkag:function(e,t,n){"use strict";var a=n("34+y"),i=(n.n(a),n("X+yh")),s=n.n(i),o=n("//Fk"),r=n.n(o),u=n("7+uW"),c=n("mtWM"),d=n.n(c),m=n("Pi6f"),g=localStorage.getItem("chat_token");d.a.defaults.headers.common.token=g||"",d.a.interceptors.request.use(function(e){return e},function(e){return r.a.reject(e)}),d.a.interceptors.response.use(function(e){return 1===e.data.code&&("用户登录已失效"===e.data.message&&(localStorage.removeItem("chat_token"),localStorage.getItem("chat_token")&&(m.b({router:null}),window.router.push("/chat/login")),window.router.push("/chat/login")),"该账号没有客服权限"===e.data.msg&&(s()({message:"该账号没有客服权限",position:"bottom",duration:2e3}),window.router.push("/chat/login"))),e},function(e){return r.a.reject(e)}),u.default.prototype.$http=d.a},M93x:function(e,t,n){"use strict";function a(e){n("OOkn")}var i=n("xJD8"),s=n("p20o"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,null,null);t.a=u.exports},MrDs:function(e,t,n){"use strict";var a=n("Zrlr"),i=n.n(a),s=n("wxAW"),o=n.n(s),r=n("Zw+j"),u=new r.a,c=function(){function e(){i()(this,e)}return o()(e,[{key:"messageNew",value:function(e){var t=u.updateImageTag(e);return u.delHtmlTag(t)}}]),e}();t.a=c},N1hX:function(e,t){},NHnr:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=n("7+uW"),i=n("M93x"),s=n("YaEn"),o=n("IcnI");n("kBzv");a.default.config.productionTip=!1,new a.default({el:"#app",router:s.a,store:o.a,template:"<App/>",components:{App:i.a}})},NyLM:function(e,t){},OOkn:function(e,t){},OgVB:function(e,t){},Pi6f:function(e,t,n){"use strict";function a(){return b.a.post(window.requestUrl("adminp/index"))}function i(){return b.a.get(window.requestUrl("adminp/visit"))}function s(e){var t=e.id,n=e.sid,a=e.type,i=e.page,s=e.defaults;return b.a.post(window.requestUrl("adminp/chat_list"),L.a.stringify({type:a||void 0,page:i||void 0,default:s||void 0,user_id:t,store_id:n}))}function o(e){var t=e.username,n=e.password,a=e.vue;_.a.open(),b.a.post(window.requestUrl("login/index"),L.a.stringify({username:t,password:n})).then(function(e){var t=e.data,n=t.code,i=t.msg,s=t.token;t.user_id;_.a.close(),h()({message:i,position:"middle",iconClass:1===n?"iconfont icon-error":"iconfont icon-success",duration:1600}),0===n&&(localStorage.setItem("chat_token",s),b.a.defaults.headers.common.token=s||"",a.$router.push({path:a.$route.query.redirect||"/chat"}),g(a))})}function r(e){var t=e.user_id,n=e.is_admin,a=e.connect_code;e.router;return b.a.post(window.requestUrl("login/index"),L.a.stringify({login_type:"app_admin_login",user_id:t,is_admin:n,connect_code:a}))}function u(){return b.a.post(window.requestUrl("adminp/service_info"))}function c(e){var t=e.router,n=e.ws;_.a.open(),n||I.a(),b.a.get(window.requestUrl("adminp/logout")).then(function(e){var n=e.data,a=n.message,i=n.code;if(_.a.close(),h()({message:a,position:"middle",duration:2e3}),0===i){localStorage.getItem("chat_token")&&localStorage.removeItem("chat_token"),t&&t.push({path:"/chat/login"}),window.location.reload()}})}function d(e){var t=e.userId;return b.a.get(window.requestUrl("adminp/change_message_status?id="+t))}function m(e){var t=e.goodsId;return b.a.post(window.requestUrl("adminp/goods_info"),L.a.stringify({gid:t}))}function g(e){b.a.post(window.requestUrl("adminp/init_info")).then(function(t){var n=t.data,a=n.code,i=(n.message,n.data);0===a&&(e.setAvigatorNumber({chatNum:i.chat_num,waitNum:i.wait_num}),I.b({vue:e,listen_route:i.listen_route,port:i.port,avatar:i.avatar,name:i.user_name,uid:i.user_id,store_id:i.store_id,is_ssl:i.is_ssl}))})}n.d(t,"d",function(){return a}),n.d(t,"e",function(){return i}),n.d(t,"f",function(){return s}),n.d(t,"c",function(){return m}),n.d(t,"i",function(){return r}),n.d(t,"j",function(){return o}),n.d(t,"a",function(){return g}),n.d(t,"h",function(){return u}),n.d(t,"g",function(){return d}),n.d(t,"b",function(){return c});var l=n("34+y"),f=(n.n(l),n("X+yh")),h=n.n(f),v=n("qONS"),p=(n.n(v),n("UQTY")),_=n.n(p),w=n("mtWM"),b=n.n(w),y=n("mw3O"),L=n.n(y),I=n("13DI")},RkRv:function(e,t,n){"use strict";t.a={name:"badge",props:{number:{type:Number}}}},Tgor:function(e,t,n){"use strict";function a(e){n("n3mR")}var i=n("Z9Md"),s=n("v8Z+"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,"data-v-7f2209ce",null);t.a=u.exports},ULTG:function(e,t){},VAhz:function(e,t,n){"use strict";var a,i,s,o=n("Gu7T"),r=n.n(o),u=n("Xxa5"),c=n.n(u),d=n("34+y"),m=(n.n(d),n("X+yh")),g=n.n(m),l=n("qONS"),f=(n.n(l),n("UQTY")),h=n.n(f),v=n("exGp"),p=n.n(v),_=n("bOdI"),w=n.n(_),b=n("woOf"),y=n.n(b),L=n("Dd8w"),I=n.n(L),k=n("Xu2r"),N=n("TXMN"),S=n("Pi6f"),x=n("lM2f"),T=n("13DI"),M={},O={setAvigatorNumber:function(e,t){(0,e.commit)(k.e,t)},comeMessage:function(e,t){var n=e.commit,a=e.rootState,i=e.state,s=i.message.messageList[t.from_id];t.goods_id&&s&&Number(s.goodsId)!==Number(t.goods_id)?S.c({goodsId:t.goods_id}).then(function(e){var i=e.data,s=i.code,o=i.goods_info;0===s&&n(k.f,{info:t,rootState:a,goodsInfo:o})}):n(k.f,{info:t,rootState:a}),n(k.g,{info:t,time:t.time})},comeWait:function(e,t){(0,e.commit)(k.h,{info:t})},sendMessage:function(e,t){var a=e.commit,i=e.rootState,s=(e.dispatch,n.i(x.a)(new Date,"hh:mm:ss"));if(t.msg||""!==t.msg){var o=n.i(T.c)({msg:t.msg,uid:t.uid,goods_id:t.goods_id}),r=o.avatar,u=o.name;a(k.i,{info:t,avatar:r,name:u,time:s,rootState:i}),a(k.g,{info:t,time:s,send:!0})}},insertInfo:function(e,t){var a=e.commit;n.i(T.d)(t),a(k.j,{customerId:t.uid})}},q=(a={},w()(a,k.e,function(e,t){var n=t.chatNum,a=t.waitNum;e.bottomNavigator.navs[0].number=n,e.bottomNavigator.navs[1].number=a}),w()(a,k.f,function(e,t){var n=t.info,a=t.rootState,i=t.goodsInfo;a.chat.message.bScroll=!0;var s=e.message.messageList[n.from_id];s&&(s.list.push({add_time:n.time,avatar:n.avatar,name:n.name,status:n.status,service_id:n.to_id,message:n.message,user_type:"2"}),i&&(s.goodsId=i.goods_id,s.list.push(I()({user_type:0},i))),e.message.messageList=y()({},e.message.messageList))}),w()(a,k.h,function(e,t){for(var n=t.info,a=e.visitor.visitorList.length,i=!1,s=0;s<a;s++)if(Number(e.visitor.visitorList[s].fid)===Number(n.from_id)){i=!0,e.visitor.visitorList[s].add_time=n.time,e.visitor.visitorList[s].message=n.message,e.visitor.visitorList[s].message_list.unshift(n.message),e.visitor.visitorList[s].num++,e.bottomNavigator.navs[1].number++;break}i||(e.visitor.visitorList.unshift({user_name:n.name,add_time:n.time,avatar:n.avatar,customer_id:n.from_id,goods_id:n.goods_id,message:n.message,message_list:[n.message],num:1,origin:n.origin,store_id:n.store_id}),e.bottomNavigator.navs[1].number++)}),w()(a,k.i,function(e,t){var n=t.info,a=t.avatar,i=t.time,s=t.name;t.rootState.chat.message.bScroll=!0,e.message.messageList.hasOwnProperty(n.uid)&&(e.message.messageList[n.uid].list.push({avatar:a||"",message:n.msg,add_time:i,user_type:"1",name:s}),e.message.messageList=y()({},e.message.messageList))}),w()(a,k.g,function(e,t){for(var n=t.info,a=t.time,i=t.send,s=e.dialogue.dialogueList.length,o=n.uid||n.from_id,r=n.msg||n.message,u=0;u<s;u++)if(Number(e.dialogue.dialogueList[u].customer_id)===Number(o)){if(e.dialogue.dialogueList[u].message instanceof Array)e.dialogue.dialogueList[u].message.unshift(r);else{var c=[e.dialogue.dialogueList[u].message];c.unshift(r),e.dialogue.dialogueList[u].message=c}e.dialogue.dialogueList[u].add_time=a,i||(e.dialogue.dialogueList[u].message_sum?e.dialogue.dialogueList[u].message_sum++:N.a.set(e.dialogue.dialogueList[u],"message_sum",1),e.bottomNavigator.navs[0].number++);break}}),w()(a,k.j,function(e,t){for(var n=t.customerId,a=e.visitor.visitorList.length,i=0,s=0;s<a;s++){Number(e.visitor.visitorList[s].customer_id)===Number(n)&&(i=e.visitor.visitorList[s].num,e.visitor.visitorList.splice(s,1));break}e.bottomNavigator.navs[1].number-=i}),a),F={};t.a={namespaced:!0,state:M,mutations:q,actions:O,getters:F,modules:{bottomNavigator:{namespaced:!0,state:{show:!1,navs:[{name:"dialogue",icon:"message",text:"对话",number:0,active:!0,route:{name:"chat/dialogue",path:"/chat/dialogue"}},{name:"visitor",icon:"visitors",text:"访客",number:0,active:!1,route:{name:"chat/visitor",path:"/chat/visitor"}},{name:"setting",icon:"setting",text:"设置",active:!1,route:{name:"chat/setting",path:"/chat/setting"}}]},actions:{activateChatFooterName:function(e,t){(0,e.commit)(k.k,t)},showBottomNav:function(e,t){(0,e.commit)(k.l,t)}},mutations:(i={},w()(i,k.k,function(e,t){e.navs=e.navs.map(function(e){return e.active=e.name===t,e})}),w()(i,k.l,function(e,t){e.show=t}),i)},dialogue:{namespaced:!0,state:{dialogueList:[]},actions:{getDialogueList:function(e,t){var n=e.commit;S.d().then(function(e){var t=e.data,a=(t.code,t.message_list),i=[];if(a instanceof Array)i=a;else for(var s in a)i.push(a[s]);n(k.m,i)})}},mutations:w()({},k.m,function(e,t){e.dialogueList=t})},visitor:{namespaced:!0,state:{visitorList:[]},actions:{getVisitorList:function(e,t){var n=e.commit;e.rootState;S.e().then(function(e){var t=e.data;0===t.code&&n(k.n,{visitorList:t.visit_list})})}},mutations:w()({},k.n,function(e,t){var n=t.visitorList;e.visitorList=n})},message:{namespaced:!0,state:{bScroll:!1,messageId:-1,messageList:{}},getters:{message:function(e){if(e.messageList[e.messageId])return e.messageList[e.messageId].list},page:function(e){if(e.messageList[e.messageId])return e.messageList[e.messageId].page}},actions:{setMessageId:function(e,t){var n=e.commit,a=t.messageId;n(k.o,{messageId:a})},setMessageList:function(e,t){var n=this,a=e.dispatch,i=e.commit,s=e.state;return p()(c.a.mark(function e(){return c.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:if(!s.messageList.hasOwnProperty(t.id)||"default"!==t.type){e.next=2;break}return e.abrupt("return",!1);case 2:if("default"!==t.type){e.next=6;break}a("setMessageId",{messageId:t.id}),e.next=8;break;case 6:return e.next=8,a("changePage");case 8:h.a.open({text:"加载中..."}),S.f({id:t.id,sid:t.sid,type:t.type,defaults:t.defaults,page:t.page}).then(function(e){var n=e.data,a=n.code,s=n.message_list,o=n.goods;if(h.a.close(),0===a){var r=s.length,u=[];if(r>0)for(var c=r-1;c>=0;c--)u.push(s[c]);i(k.p,{messageId:t.id,messageList:u,type:t.type,goods:o})}else g()("没有更多了……")});case 10:case"end":return e.stop()}},e,n)}))()},changeToRead:function(e,t){var n=e.commit,a=e.rootState,i=t.userId;S.g({userId:i}).then(function(){n(k.q,{rootState:a,userId:i})})},changePage:function(e){var t=this,n=e.commit;return p()(c.a.mark(function e(){return c.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:n(k.r);case 1:case"end":return e.stop()}},e,t)}))()}},mutations:(s={},w()(s,k.o,function(e,t){var n=t.messageId;e.messageId=n}),w()(s,k.p,function(e,t){var n=t.messageId,a=t.messageList,i=t.type,s=t.goods;if(e.bScroll=!1,"default"===i)N.a.set(e.messageList,n,{page:1,list:a,goodsId:s?s.goods_id:0}),e.messageList[n].list.push(I()({user_type:0},s));else{var o;(o=e.messageList[n].list).unshift.apply(o,r()(a)),e.messageList=y()({},e.messageList)}}),w()(s,k.q,function(e,t){for(var n=t.rootState,a=t.userId,i=n.chat.dialogue.dialogueList.length,s=0,o=0;o<i;o++)if(0!==n.chat.dialogue.dialogueList[o].message_sum&&Number(n.chat.dialogue.dialogueList[o].customer_id)===Number(a)){s=n.chat.dialogue.dialogueList[o].message_sum||0,n.chat.dialogue.dialogueList[o].message_sum=0,n.chat.dialogue=y()({},n.chat.dialogue),n.chat.bottomNavigator.navs[0].number-=s;break}}),w()(s,k.r,function(e){e.messageList[e.messageId].page++}),s)},messageBottomInput:{namespaced:!0,state:{show:!1},actions:{showMessageInput:function(e,t){(0,e.commit)(k.s,t)}},mutations:w()({},k.s,function(e,t){e.show=t})},settingInfo:{namespaced:!0,state:{userInfo:{image:"",name:"",fit:""},account:""},actions:{getSettingInfo:function(e){var t=e.commit;h.a.open({text:"加载中..."}),S.h().then(function(e){var n=e.data,a=n.data;0===n.code&&(t(k.t,a),h.a.close())})}},mutations:w()({},k.t,function(e,t){e.userInfo.name=t.nick_name,e.userInfo.image=t.service_avatar,e.account=t.user_name})}}}},Vym9:function(e,t,n){"use strict";var a=n("Dd8w"),i=n.n(a),s=n("NYxO"),o=n("qkow"),r=n("Tgor");t.a={name:"chat-footer",data:function(){return{message:"",num:0}},components:{EcButton:o.a,Face:r.a},computed:i()({},n.i(s.a)("chat/messageBottomInput",["show"]),n.i(s.a)(["bFace"])),methods:i()({},n.i(s.b)("chat",["sendMessage"]),n.i(s.b)(["showFaceDialog"]),{addFace:function(e){this.message+=e,this.$el.querySelector(".input").innerHTML+=e},scrollShow:function(){var e=document.querySelector(".message");e.scrollTop=e.scrollHeight-e.offsetHeight;var t=window.navigator.userAgent;if(t.indexOf("Safari")<=-1||t.indexOf("ECJiaBrowse")<=-1)return!1;var n=this.$el.querySelector(".input");setTimeout(function(){n.scrollIntoViewIfNeeded()},500)},changMessage:function(e){this.message=e.srcElement.innerHTML},thisSendMessage:function(e){this.sendMessage(e),this.message="",this.$el.querySelector(".input").innerHTML="",this.$el.querySelector(".input").focus()}})}},Xu2r:function(e,t,n){"use strict";n.d(t,"d",function(){return a}),n.d(t,"a",function(){return i}),n.d(t,"e",function(){return s}),n.d(t,"b",function(){return o}),n.d(t,"c",function(){return r}),n.d(t,"j",function(){return u}),n.d(t,"f",function(){return c}),n.d(t,"h",function(){return d}),n.d(t,"i",function(){return m}),n.d(t,"g",function(){return g}),n.d(t,"k",function(){return l}),n.d(t,"l",function(){return f}),n.d(t,"s",function(){return h}),n.d(t,"m",function(){return v}),n.d(t,"n",function(){return p}),n.d(t,"t",function(){return _}),n.d(t,"o",function(){return w}),n.d(t,"p",function(){return b}),n.d(t,"q",function(){return y}),n.d(t,"r",function(){return L});var a="setPageTransitionName",i="saveScrollTop",s="setNavigatorNumber",o="getImageFiles",r="showFaceDialog",u="chat/insertInfo",c="chat/comeMessage",d="chat/comeWait",m="chat/sendMessage",g="chat/newDialogue",l="chat/activateChatFooterNav",f="chat/showBottomNav",h="chat/showMessageInput",v="chat/getDialogueList",p="chat/getVisitorList",_="setting/getSettingInfo",w="message/setMessageId",b="message/setMessageList",y="message/changeToRead",L="message/changePage"},YaEn:function(e,t,n){"use strict";function a(e,t){if(e.name&&-1!==S.indexOf(e.name))return T.length=0,!1;if(t.name&&-1!==S.indexOf(t.name))return T.push(e.fullPath),!0;if(e.name&&-1!==x.indexOf(e.name))return T.push(e.fullPath),!0;var n=T.indexOf(e.fullPath);return-1!==n?(T.length=n+1,!1):(T.push(e.fullPath),!0)}var i=n("34+y"),s=(n.n(i),n("X+yh")),o=n.n(s),r=n("mvHQ"),u=n.n(r),c=n("Xu2r"),d=n("7+uW"),m=n("/ocq"),g=n("mtWM"),l=n.n(g),f=n("UZ5h"),h=n.n(f),v=n("mw3O"),p=n.n(v),_=n("Pi6f"),w=function(){return n.e(2).then(n.bind(null,"nt9Z"))},b=function(){return n.e(1).then(n.bind(null,"WHOy"))},y=function(){return n.e(0).then(n.bind(null,"osDW"))},L=function(){return n.e(3).then(n.bind(null,"RdYp"))},I=function(){return n.e(5).then(n.bind(null,"QGR8"))},k=function(){return n.e(4).then(n.bind(null,"cTYd"))};d.default.use(m.a);var N=new m.a({mode:"hash",routes:[{path:"/",name:"",component:w,meta:{requiresAuth:!0}},{path:"/chat",name:"chat",component:w,meta:{requiresAuth:!0}},{path:"/chat/dialogue",name:"chat/dialogue",component:w,meta:{requiresAuth:!0}},{path:"/chat/visitor",name:"chat/visitor",component:b,meta:{requiresAuth:!0}},{path:"/chat/setting",name:"chat/setting",component:y,meta:{requiresAuth:!0}},{path:"/chat/message",name:"chat/message",component:L,meta:{notKeepAlive:!0,requiresAuth:!0}},{path:"/chat/login",name:"chat/login",component:I},{path:"/chat/update/password",name:"chat/update/password",component:k,meta:{requiresAuth:!0}}]});N.beforeEach(function(e,t,i){if("chat/message"===t.name&&"chat/login"===e.name&&N.push("/chat"),N.app.$store){if(N.app.$store.state.needPageTransition){var s=a(e,t)?"slide-left":"slide-right";N.app.$store.commit(c.d,{pageTransitionName:s})}}else a(e,t);if(e.matched.some(function(e){return e.meta.requiresAuth})){var r=localStorage.getItem("chat_token"),d=h.a.parse(window.location.href),m=p.a.parse(d.query);if(r)i();else if("1"!==m.is_admin||"chat"!==e.name&&"chat/dialogue"!==e.name)o()({message:"请登录后进行操作",position:"middle",duration:1600}),i({path:"/chat/login",query:{redirect:e.fullPath}});else{var g=JSON.parse(u()(m)),f="";["connect_code","user_id","is_admin"].forEach(function(e){delete g[e]});for(var v in g)f+=v+"="+g[v]+"&";f=f.substring(0,f.length-1),f=d.protocol+"//"+d.host+d.pathname+"?"+f+"#/chat",n.i(_.i)({user_id:m.user_id,is_admin:m.is_admin,connect_code:m.connect_code}).then(function(e){var t=e.data,n=t.code,a=(t.msg,t.token);t.user_id;0===n&&(localStorage.setItem("chat_token",a),l.a.defaults.headers.common.token=a||"",window.location=f)})}}else i()});var S=["chat/dialogue"],x=[],T=[];window.router=N,t.a=N},Z9Md:function(e,t,n){"use strict";var a=n("Dd8w"),i=n.n(a),s=n("NYxO");t.a={name:"face",data:function(){return{}},created:function(){this.getImageFiles()},computed:i()({},n.i(s.a)(["aFace"]),{imgHttp:function(){return window.ROOT_URL?window.ROOT_URL:window.imgHttp+"/"}}),methods:i()({},n.i(s.b)(["getImageFiles","showFaceDialog"]),{getImage:function(e){this.$emit("add-face",e.srcElement.outerHTML),this.showFaceDialog({bShow:!1})}})}},"Zw+j":function(e,t,n){"use strict";var a=n("Zrlr"),i=n.n(a),s=n("wxAW"),o=n.n(s),r=function(){function e(){i()(this,e)}return o()(e,[{key:"delHtmlTag",value:function(e){return e.replace(/<[^>]+>/g,"")}},{key:"updateImageTag",value:function(e){return e.replace(/<img [^>]*src=['"][^'"]+[^>]*>/g,"[图片]")}}]),e}();t.a=r},clLD:function(e,t,n){"use strict";function a(e){n("NyLM")}var i=n("xsN0"),s=n("7tm0"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,"data-v-e32400b6",null);t.a=u.exports},ihTz:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement;return(e._self._c||t)("em",{staticClass:"badge"},[e._v("\n  "+e._s(e.number)+"\n")])},i=[],s={render:a,staticRenderFns:i};t.a=s},iubX:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement;return(e._self._c||t)("button",{staticClass:"ec-button"},[e._v("\n  "+e._s(e.text)+"\n")])},i=[],s={render:a,staticRenderFns:i};t.a=s},kBzv:function(e,t,n){"use strict";var a=n("7+uW"),i=(n("Kkag"),n("MrDs")),s=new i.a;window.requestUrl=function(e){return window.ROOT_URL?window.ROOT_URL+"kefu/"+e:"https://x.dscmall.cn/kefu/"+e};var o=["chat/message"];a.default.mixin({beforeRouteEnter:function(e,t,n){n(function(t){-1===o.indexOf(e.name)&&(t.$el.scrollTop=t.$store.state.historyPageScrollTop[e.fullPath]||0)})},beforeRouteLeave:function(e,t,n){-1===o.indexOf(t.name)&&this.$store.dispatch("saveScrollTop",{path:t.fullPath,scrollTop:this.$el.scrollTop}),n()}}),a.default.prototype.release=!0,window.imgHttp=(a.default.prototype.release,""),a.default.filter("messageNew",s.messageNew)},lM2f:function(e,t,n){"use strict";function a(e,t){var n=function(e){return e+="",e.replace(/^(\d)$/,"0$1")},a={yyyy:e.getFullYear(),yy:e.getFullYear().toString().substring(2),M:e.getMonth()+1,MM:n(e.getMonth()+1),d:e.getDate(),dd:n(e.getDate()),hh:e.getHours(),mm:e.getMinutes(),ss:e.getSeconds()};return t||(t="yyyy-MM-dd hh:mm:ss"),t.replace(/([a-z])(\1)*/gi,function(e){return a[e]})}n.d(t,"a",function(){return a})},llGh:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("footer",{directives:[{name:"show",rawName:"v-show",value:e.show,expression:"show"}],staticClass:"message-footer",on:{click:function(t){e.showFaceDialog({bShow:!1})}}},[n("transition",{attrs:{name:"fade"}},[n("keep-alive",[e.bFace?n("face",{on:{"add-face":e.addFace}}):e._e()],1)],1),e._v(" "),n("div",{staticClass:"left"},[n("i",{staticClass:"iconfont icon-expression",on:{click:function(t){return t.stopPropagation(),e.showFaceDialog(t)}}})]),e._v(" "),n("div",{staticClass:"input",attrs:{contenteditable:"true"},on:{input:e.changMessage,click:e.scrollShow}}),e._v(" "),n("ec-button",{attrs:{text:"发送"},nativeOn:{click:function(t){e.thisSendMessage({msg:e.message,uid:e.$route.query.id,goods_id:e.$route.query.goods_id})}}})],1)},i=[],s={render:a,staticRenderFns:i};t.a=s},lyCt:function(e,t){},n3mR:function(e,t){},p20o:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("keep-alive",[e.$route.meta.notKeepAlive?e._e():n("router-view",{key:e.$route.fullPath,staticClass:"app-view"})],1),e._v(" "),e.$route.meta.notKeepAlive?n("router-view",{key:e.$route.fullPath,staticClass:"app-view"}):e._e(),e._v(" "),n("chat-footer"),e._v(" "),n("chat-message-footer"),e._v("\n  "+e._s(e.pageTransitionName)+"\n")],1)},i=[],s={render:a,staticRenderFns:i};t.a=s},qONS:function(e,t){},qkow:function(e,t,n){"use strict";function a(e){n("Ac9d")}var i=n("48ln"),s=n("iubX"),o=n("VU/8"),r=a,u=o(i.a,s.a,!1,r,null,null);t.a=u.exports},"v8Z+":function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"face"},[n("ul",e._l(e.aFace,function(t){return n("li",{key:t},[n("img",{attrs:{src:e.imgHttp+"vendor/layui/images/face/"+t+".gif",alt:""},on:{click:function(t){return t.stopPropagation(),e.getImage(t)}}})])}))])},i=[],s={render:a,staticRenderFns:i};t.a=s},xJD8:function(e,t,n){"use strict";var a=n("Dd8w"),i=n.n(a),s=n("NYxO"),o=n("clLD"),r=n("BwjS"),u=n("Pi6f");t.a={name:"app",components:{ChatFooter:o.a,ChatMessageFooter:r.a},created:function(){localStorage.getItem("chat_token")&&u.a(this)},computed:i()({},n.i(s.a)(["pageTransitionName"])),methods:i()({},n.i(s.b)("chat",["comeMessage","comeWait","setAvigatorNumber"]))}},xsN0:function(e,t,n){"use strict";var a=n("Dd8w"),i=n.n(a),s=n("NYxO"),o=n("6CWX");t.a={name:"chat-footer",components:{Badge:o.a},computed:i()({},n.i(s.a)("chat/bottomNavigator",["show","navs"]))}}},["NHnr"]);