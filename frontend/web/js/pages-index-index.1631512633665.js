(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-index-index"],{"0105":function(t,e,a){"use strict";var o=a("30248"),i=a.n(o);i.a},"0d9b":function(t,e,a){"use strict";var o=a("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("8e6e"),a("ac6a"),a("456d");var i=o(a("bd86")),n=o(a("fbce")),r=o(a("b800")),c=o(a("f8c8"));function s(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,o)}return a}function d(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?s(Object(a),!0).forEach((function(e){(0,i.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):s(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var l={components:{LoadMore:n.default,Empty:r.default},computed:{},data:function(){return{width:"",isLoading:!0,pageInfo:{page:1,pageSum:1,pageSize:24,count:"--"},searchData:{},searchList:[]}},onLoad:function(){var t=this;uni.onWindowResize((function(e){t.computedWidth()})),this.computedWidth(),console.log(uni.getSystemInfoSync()),this.searchList=[],this.getData()},onReachBottom:function(){console.log(111),this.getMoreData()},methods:{computedWidth:function(){var t=uni.getSystemInfoSync().windowWidth;console.log(t),t<500?this.width=t-60:t<800?this.width=(t-60)/2:t<1300?(console.log(2222),this.width=(t-80)/3):(console.log(333),this.width=(t-100)/4)},getData:function(){var t=this;1==this.pageInfo.page&&uni.showLoading({title:"加载中...",mask:!0}),this.isLoading=!0,c.default.dataApi.staffList(d({},this.pageInfo,{},this.searchData)).then((function(e){console.log(e),e.pageInfo.page=t.pageInfo.page,t.pageInfo=e.pageInfo,t.searchList=t.searchList.concat(e.list),t.isLoading=!1,uni.hideLoading()})).catch((function(e){console.log(e),t.isLoading=!1,uni.hideLoading()}))},getMoreData:function(){this.pageInfo.pageSum>this.pageInfo.page&&(this.pageInfo.page=this.pageInfo.page+1,this.getData()),console.log("下拉加载")},toDetail:function(t){uni.navigateTo({url:"/pages/detail/product?name=".concat(t.name,"&staffId=").concat(t.staffId)})},toHour:function(t){uni.navigateTo({url:"/pages/detail/hour?name=".concat(t.name,"&staffId=").concat(t.staffId)})},toRest:function(t){uni.navigateTo({url:"/pages/detail/rest?name=".concat(t.name,"&staffId=").concat(t.staffId)})}}};e.default=l},30248:function(t,e,a){var o=a("ae58");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var i=a("4f06").default;i("4acac296",o,!0,{sourceMap:!1,shadowMode:!1})},"3c1e":function(t,e,a){"use strict";var o=a("6c49"),i=a.n(o);i.a},4507:function(t,e,a){"use strict";a.r(e);var o=a("4bca"),i=a.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);e["default"]=i.a},"4bca":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o={name:"LoadMore",props:{loading:{type:Boolean,default:!0},hasMore:{type:Boolean,default:!1}},data:function(){return{}},mounted:function(){},methods:{}};e.default=o},"54d2":function(t,e,a){"use strict";var o=a("7258"),i=a.n(o);i.a},"583e":function(t,e,a){var o=a("24fb");e=o(!1),e.push([t.i,".page[data-v-5eca454a]{min-height:100vh;width:100%;position:relative}.content[data-v-5eca454a]{padding:20px 10px 59px;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;justify-content:flex-start}.content .item[data-v-5eca454a]{height:190px;box-shadow:0 -2px 10px rgba(0,0,0,.08);display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;margin:10px 10px;padding:10px;box-sizing:border-box;border-radius:15px;position:relative}.content .item.color0[data-v-5eca454a]{border:3px solid #35b9ff}.content .item.color0 .opret[data-v-5eca454a]{border-top:2px solid #35b9ff}.content .item.color0 .opret .left[data-v-5eca454a]{border-right:1px solid #35b9ff}.content .item.color0 .opret .right[data-v-5eca454a]{border-left:1px solid #35b9ff}.content .item.color1[data-v-5eca454a]{border:3px solid #3abb6d}.content .item.color1 .opret[data-v-5eca454a]{border-top:2px solid #3abb6d}.content .item.color1 .opret .left[data-v-5eca454a]{border-right:1px solid #3abb6d}.content .item.color1 .opret .right[data-v-5eca454a]{border-left:1px solid #3abb6d}.content .item.color2[data-v-5eca454a]{border:3px solid #fdae2e}.content .item.color2 .opret[data-v-5eca454a]{border-top:2px solid #fdae2e}.content .item.color2 .opret .left[data-v-5eca454a]{border-right:1px solid #fdae2e}.content .item.color2 .opret .right[data-v-5eca454a]{border-left:1px solid #fdae2e}.content .item.color3[data-v-5eca454a]{border:3px solid #13c8d1}.content .item.color3 .opret[data-v-5eca454a]{border-top:2px solid #13c8d1}.content .item.color3 .opret .left[data-v-5eca454a]{border-right:1px solid #13c8d1}.content .item.color3 .opret .right[data-v-5eca454a]{border-left:1px solid #13c8d1}.content .item.color4[data-v-5eca454a]{border:3px solid #bb6dfe}.content .item.color4 .opret[data-v-5eca454a]{border-top:2px solid #bb6dfe}.content .item.color4 .opret .left[data-v-5eca454a]{border-right:1px solid #bb6dfe}.content .item.color4 .opret .right[data-v-5eca454a]{border-left:1px solid #bb6dfe}.content .item.color5[data-v-5eca454a]{border:3px solid #5e8bfc}.content .item.color5 .opret[data-v-5eca454a]{border-top:2px solid #5e8bfc}.content .item.color5 .opret .left[data-v-5eca454a]{border-right:1px solid #5e8bfc}.content .item.color5 .opret .right[data-v-5eca454a]{border-left:1px solid #5e8bfc}.content .item.color6[data-v-5eca454a]{border:3px solid #fdc217}.content .item.color6 .opret[data-v-5eca454a]{border-top:2px solid #fdc217}.content .item.color6 .opret .left[data-v-5eca454a]{border-right:1px solid #fdc217}.content .item.color6 .opret .right[data-v-5eca454a]{border-left:1px solid #fdc217}.content .item.color7[data-v-5eca454a]{border:3px solid #ff743d}.content .item.color7 .opret[data-v-5eca454a]{border-top:2px solid #ff743d}.content .item.color7 .opret .left[data-v-5eca454a]{border-right:1px solid #ff743d}.content .item.color7 .opret .right[data-v-5eca454a]{border-left:1px solid #ff743d}.content .item .name[data-v-5eca454a]{font-size:20px;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.content .item .name .phone[data-v-5eca454a]{font-size:16px;margin-top:6px}.content .item .position[data-v-5eca454a]{font-size:16px;margin-top:6px;padding-bottom:16px}.content .item .opret[data-v-5eca454a]{cursor:pointer;position:absolute;bottom:0;height:40px;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;font-size:17px;width:100%}.content .item .opret .left[data-v-5eca454a]{-webkit-box-flex:1;-webkit-flex:1;flex:1;text-align:center;height:100%;line-height:40px}.content .item .opret .right[data-v-5eca454a]{-webkit-box-flex:1;-webkit-flex:1;flex:1;text-align:center;height:100%;line-height:40px}",""]),t.exports=e},6053:function(t,e,a){"use strict";var o;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return o}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"empty",style:"padding-top:"+t.paddingTop+"px"},[a("v-uni-image",{staticClass:"img",attrs:{src:t.img}}),a("v-uni-view",{staticClass:"tip"},[t._v(t._s(t.tip))])],1)},n=[]},"6c49":function(t,e,a){var o=a("583e");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var i=a("4f06").default;i("09e7e3ea",o,!0,{sourceMap:!1,shadowMode:!1})},7258:function(t,e,a){var o=a("ece6");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var i=a("4f06").default;i("6cdc640e",o,!0,{sourceMap:!1,shadowMode:!1})},7457:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("c5f6");var o={name:"Empty",props:{type:{type:Number,default:1},paddingTop:{type:Number,default:115}},onLoad:function(){console.log(this.globalApp.data,"------------------empty")},data:function(){return{}},mounted:function(){},computed:{tip:function(){switch(console.log(this.globalApp.data,"------------------empty"),this.type){case 1:return"暂无数据";case 2:return"暂无搜索结果";case 403:return"您暂无操作权限，详情请联系管理员！";default:break}},img:function(){switch(this.type){case 1:return"../../static/empty/zwsj.png";case 2:return"../../static/empty/zwsj.png";case 403:return"../../static/empty/zwqx.png";default:break}}},methods:{}};e.default=o},8069:function(t,e,a){"use strict";a.r(e);var o=a("0d9b"),i=a.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);e["default"]=i.a},"9adc":function(t,e,a){"use strict";a.r(e);var o=a("7457"),i=a.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);e["default"]=i.a},a428:function(t,e,a){"use strict";var o;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return o}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"load-more"},[t.loading&&t.hasMore?a("v-uni-view",{staticClass:"tip"},[t._v("加载中...")]):t._e(),!t.loading&&t.hasMore?a("v-uni-view",{staticClass:"tip"},[t._v("上滑加载更多")]):t._e(),t.loading||t.hasMore?t._e():a("v-uni-view",{staticClass:"tip no-more"},[t._v("我也是有底线的")])],1)},n=[]},ae58:function(t,e,a){var o=a("24fb");e=o(!1),e.push([t.i,'.load-more[data-v-a39bb358]{position:absolute;bottom:0;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;left:0;right:0;padding:20px}.load-more .load-img[data-v-a39bb358]{width:250px;height:60px}.load-more .tip[data-v-a39bb358]{color:#a0a0a0;font-size:14px;position:relative;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;padding:0 38px}.load-more .no-more[data-v-a39bb358]::before{content:"";position:absolute;width:30px;height:1px;background:#979797;left:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.load-more .no-more[data-v-a39bb358]::after{content:"";position:absolute;width:30px;height:1px;background:#979797;right:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}',""]),t.exports=e},b800:function(t,e,a){"use strict";a.r(e);var o=a("6053"),i=a("9adc");for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);a("54d2");var r,c=a("f0c5"),s=Object(c["a"])(i["default"],o["b"],o["c"],!1,null,"158048ba",null,!1,o["a"],r);e["default"]=s.exports},ce5d:function(t,e,a){"use strict";var o;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return o}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"page"},[a("v-uni-view",{staticClass:"content"},t._l(t.searchList,(function(e,o){return a("v-uni-view",{key:o,staticClass:"item",class:"color"+o%8,style:"width: "+t.width+"px"},[a("v-uni-view",{staticClass:"name"},[a("v-uni-view",[t._v(t._s(e.name))]),e.jobNumber?a("v-uni-view",{staticClass:"phone"},[t._v("【"+t._s(e.jobNumber)+"】")]):t._e()],1),a("v-uni-view",{staticClass:"position"},[t._v(t._s(e.groupName))]),a("v-uni-view",{staticClass:"opret"},[a("v-uni-view",{staticClass:"left",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toHour(e)}}},[t._v("计时")]),a("v-uni-view",{staticClass:"right",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toDetail(e)}}},[t._v("计件")]),a("v-uni-view",{staticClass:"right",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toRest(e)}}},[t._v("休息")])],1)],1)})),1),t.searchList.length>0?a("LoadMore",{attrs:{loading:t.isLoading,hasMore:t.pageInfo.pageSum>t.pageInfo.page}}):t._e(),0!==t.searchList.length||t.isLoading?t._e():a("Empty")],1)},n=[]},ece6:function(t,e,a){var o=a("24fb");e=o(!1),e.push([t.i,".empty[data-v-158048ba]{margin:auto;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.empty .img[data-v-158048ba]{width:160px;height:160px}.empty .tip[data-v-158048ba]{font-size:14px;color:#666;margin-top:12px}",""]),t.exports=e},f75a:function(t,e,a){"use strict";a.r(e);var o=a("ce5d"),i=a("8069");for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);a("3c1e");var r,c=a("f0c5"),s=Object(c["a"])(i["default"],o["b"],o["c"],!1,null,"5eca454a",null,!1,o["a"],r);e["default"]=s.exports},fbce:function(t,e,a){"use strict";a.r(e);var o=a("a428"),i=a("4507");for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);a("0105");var r,c=a("f0c5"),s=Object(c["a"])(i["default"],o["b"],o["c"],!1,null,"a39bb358",null,!1,o["a"],r);e["default"]=s.exports}}]);