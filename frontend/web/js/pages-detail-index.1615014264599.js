(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-detail-index"],{"0105":function(t,e,i){"use strict";var n=i("30248"),a=i.n(n);a.a},"0734":function(t,e,i){var n=i("b9c7");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("00c462d3",n,!0,{sourceMap:!1,shadowMode:!1})},"2a70":function(t,e,i){"use strict";var n=i("0734"),a=i.n(n);a.a},30248:function(t,e,i){var n=i("ae58");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("4acac296",n,!0,{sourceMap:!1,shadowMode:!1})},"40ac":function(t,e,i){"use strict";i.r(e);var n=i("e5c0"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},4507:function(t,e,i){"use strict";i.r(e);var n=i("4bca"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},"4bca":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"LoadMore",props:{loading:{type:Boolean,default:!0},hasMore:{type:Boolean,default:!1}},data:function(){return{}},mounted:function(){},methods:{}};e.default=n},"54d2":function(t,e,i){"use strict";var n=i("7258"),a=i.n(n);a.a},6053:function(t,e,i){"use strict";var n;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"empty",style:"padding-top:"+t.paddingTop+"px"},[i("v-uni-image",{staticClass:"img",attrs:{src:t.img}}),i("v-uni-view",{staticClass:"tip"},[t._v(t._s(t.tip))])],1)},o=[]},7258:function(t,e,i){var n=i("ece6");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("6cdc640e",n,!0,{sourceMap:!1,shadowMode:!1})},7457:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("c5f6");var n={name:"Empty",props:{type:{type:Number,default:1},paddingTop:{type:Number,default:115}},onLoad:function(){console.log(this.globalApp.data,"------------------empty")},data:function(){return{}},mounted:function(){},computed:{tip:function(){switch(console.log(this.globalApp.data,"------------------empty"),this.type){case 1:return"暂无数据";case 2:return"暂无搜索结果";case 403:return"您暂无操作权限，详情请联系管理员！";default:break}},img:function(){switch(this.type){case 1:return"../../static/empty/zwsj.png";case 2:return"../../static/empty/zwsj.png";case 403:return"../../static/empty/zwqx.png";default:break}}},methods:{}};e.default=n},7460:function(t,e,i){"use strict";i.r(e);var n=i("fcfa"),a=i("40ac");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("2a70");var s,r=i("f0c5"),c=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"5bfb32f5",null,!1,n["a"],s);e["default"]=c.exports},"9adc":function(t,e,i){"use strict";i.r(e);var n=i("7457"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},a428:function(t,e,i){"use strict";var n;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"load-more"},[t.loading&&t.hasMore?i("v-uni-view",{staticClass:"tip"},[t._v("加载中...")]):t._e(),!t.loading&&t.hasMore?i("v-uni-view",{staticClass:"tip"},[t._v("上滑加载更多")]):t._e(),t.loading||t.hasMore?t._e():i("v-uni-view",{staticClass:"tip no-more"},[t._v("我也是有底线的")])],1)},o=[]},ae58:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'.load-more[data-v-a39bb358]{position:absolute;bottom:0;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;left:0;right:0;padding:20px}.load-more .load-img[data-v-a39bb358]{width:250px;height:60px}.load-more .tip[data-v-a39bb358]{color:#a0a0a0;font-size:14px;position:relative;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;padding:0 38px}.load-more .no-more[data-v-a39bb358]::before{content:"";position:absolute;width:30px;height:1px;background:#979797;left:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.load-more .no-more[data-v-a39bb358]::after{content:"";position:absolute;width:30px;height:1px;background:#979797;right:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}',""]),t.exports=e},b800:function(t,e,i){"use strict";i.r(e);var n=i("6053"),a=i("9adc");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("54d2");var s,r=i("f0c5"),c=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"158048ba",null,!1,n["a"],s);e["default"]=c.exports},b9c7:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,".page[data-v-5bfb32f5]{min-height:100vh;width:100%;position:relative}.page .title[data-v-5bfb32f5]{text-align:center;width:100%;font-size:20px;padding-top:20px}.content[data-v-5bfb32f5]{padding:20px 0 59px;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;padding-bottom:78px}.content .item[data-v-5bfb32f5]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;padding:0 20px;box-sizing:border-box;border-bottom:1.5px solid #f2f2f2;color:#404040}.content .item.title[data-v-5bfb32f5]{background:#f2f2f2;color:#262626;font-weight:700}.content .item .name[data-v-5bfb32f5]{min-height:64px;font-size:16px;line-height:25px;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;text-align:center;-webkit-box-flex:1;-webkit-flex:1;flex:1;border-right:1.5px solid #f2f2f2;padding-right:20px}.content .item .text[data-v-5bfb32f5]{font-size:16px;text-align:center;padding-left:20px;-webkit-box-flex:1;-webkit-flex:1;flex:1}.empty[data-v-5bfb32f5]{padding-top:0!important}.button-box[data-v-5bfb32f5]{width:100%;height:78px;box-shadow:0 -2px 10px rgba(0,0,0,.08);background:#fff;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;position:fixed;bottom:0;left:0;right:0;z-index:6;padding:0 16px;box-sizing:border-box}.nextButton[data-v-5bfb32f5]{background:#fff;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.nextButton.disabled[data-v-5bfb32f5]{background:rgba(0,0,0,.6)}.nextButton .nextPress[data-v-5bfb32f5]{height:42px;line-height:42px;background:#148df5;border-radius:2px;text-align:center;color:#fff;font-size:14px;font-weight:500}.nextButton .nextPress.small[data-v-5bfb32f5]{-webkit-box-flex:1;-webkit-flex:1;flex:1;height:40px;border:1px solid #148df5}.nextButton .nextPress.small[data-v-5bfb32f5]:first-child{margin-right:30px}.nextButton .nextPress.normal[data-v-5bfb32f5]{background:#fff;color:#148df5;border:1px solid #148df5}.nextButton .nextPress uni-button[data-v-5bfb32f5]::after{border:none}",""]),t.exports=e},e5c0:function(t,e,i){"use strict";var n=i("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("c5f6");var a=n(i("fbce")),o=n(i("b800")),s=n(i("f8c8")),r={components:{LoadMore:a.default,Empty:o.default},computed:{},data:function(){return{width:"",isLoading:!0,pageInfo:{page:1,pageSum:1,pageSize:10,count:"--"},searchData:{},searchList:[],staffId:"",name:"",positionId:"",isSubmit:!1,submitList:[]}},onLoad:function(t){var e=this;this.positionId=Number(t.id)||"",this.staffId=t.staffId||"",this.name=t.name||"",uni.onWindowResize((function(t){e.computedWidth()})),this.computedWidth(),this.searchList=[],this.getData()},onReachBottom:function(){this.getMoreData()},methods:{computedWidth:function(){var t=uni.getSystemInfoSync().windowWidth;t<900?(console.log(2222),this.width=t):(console.log(333),this.width=900)},getData:function(){var t=this;uni.showLoading({title:"加载中...",mask:!0}),this.isLoading=!0,s.default.dataApi.productList({staffId:this.staffId}).then((function(e){t.searchList=e.list.map((function(t){return t.num="",t.goodsId=t.id,t})),t.isLoading=!1,uni.hideLoading()})).catch((function(e){console.log(e),t.isLoading=!1,uni.hideLoading()}))},getMoreData:function(){},onSubmit:function(){var t=this;if(this.isSubmit)s.default.dataApi.inStorage({staffId:this.staffId,goodsData:this.submitList}).then((function(t){uni.showToast({title:"入库成功",icon:"success"}),setTimeout((function(){}),2e3)})).catch((function(e){console.log(e),t.isSubmiting=!1,uni.showToast({title:e.errorMessage||"网络错误",icon:"none"})}));else{var e=this.searchList.filter((function(t){return t.num>0}));e.length>0?(this.isSubmit=!0,this.submitList=e):uni.showToast({title:"请至少入库一个产品",icon:"none"})}},goBack:function(){var t=getCurrentPages();console.log(t);var e=t[t.length-2];e?uni.navigateBack():uni.reLaunch({url:"/pages/index/index"})},cancel:function(){this.isSubmit=!1}}};e.default=r},ece6:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,".empty[data-v-158048ba]{margin:auto;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.empty .img[data-v-158048ba]{width:160px;height:160px}.empty .tip[data-v-158048ba]{font-size:14px;color:#666;margin-top:12px}",""]),t.exports=e},fbce:function(t,e,i){"use strict";i.r(e);var n=i("a428"),a=i("4507");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("0105");var s,r=i("f0c5"),c=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"a39bb358",null,!1,n["a"],s);e["default"]=c.exports},fcfa:function(t,e,i){"use strict";var n;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"page"},[i("v-uni-view",{staticClass:"title"},[t._v(t._s(t.isSubmit?"确定入库以下产品吗？":"请输入"+t.name+"生产数量"))]),i("v-uni-view",{staticClass:"content"},[i("v-uni-view",{staticClass:"item title",style:"width: "+t.width+"px"},[i("v-uni-view",{staticClass:"name"},[t._v("产品名称")]),i("v-uni-view",{staticClass:"name"},[t._v("产品规格")]),i("v-uni-view",{staticClass:"text"},[t._v("生产数量")])],1),t._l(t.searchList,(function(e){return!t.isSubmit||e.num>0?i("v-uni-view",{key:e.staffId,staticClass:"item",style:"width: "+t.width+"px"},[i("v-uni-view",{staticClass:"name"},[t._v(t._s(e.name))]),i("v-uni-view",{staticClass:"name"},[t._v(t._s(e.attr))]),i("v-uni-input",{staticClass:"text",attrs:{maxlength:"24",disabled:t.isSubmit,placeholder:"请输入生产数量","placeholder-class":"p-class",number:!0},model:{value:e.num,callback:function(i){t.$set(e,"num",i)},expression:"item.num"}})],1):t._e()}))],2),i("v-uni-view",{staticClass:"button-box"},[t.isSubmit?i("v-uni-view",{staticClass:"nextButton",style:"width: "+t.width+"px"},[i("v-uni-view",{staticClass:"nextPress small normal",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.cancel.apply(void 0,arguments)}}},[t._v("取消")]),i("v-uni-view",{staticClass:"nextPress small",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.onSubmit.apply(void 0,arguments)}}},[t._v("确定")])],1):i("v-uni-view",{staticClass:"nextButton",style:"width: "+t.width+"px"},[i("v-uni-view",{staticClass:"nextPress small normal",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.goBack.apply(void 0,arguments)}}},[t._v("返回")]),i("v-uni-view",{staticClass:"nextPress small",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.onSubmit.apply(void 0,arguments)}}},[t._v("入库")])],1)],1),0!==t.searchList.length||t.isLoading?t._e():i("Empty")],1)},o=[]}}]);