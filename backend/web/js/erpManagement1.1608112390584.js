(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement1"],{"37c9":function(t,e,i){"use strict";var a=i("d9bf"),n=i.n(a);n.a},"386d":function(t,e,i){"use strict";var a=i("cb7c"),n=i("83a1"),o=i("5f1b");i("214f")("search",1,(function(t,e,i,s){return[function(i){var a=t(this),n=void 0==i?void 0:i[e];return void 0!==n?n.call(i,a):new RegExp(i)[e](String(a))},function(t){var e=s(i,t,this);if(e.done)return e.value;var r=a(t),c=String(this),l=r.lastIndex;n(l,0)||(r.lastIndex=0);var u=o(r,c);return n(r.lastIndex,l)||(r.lastIndex=l),null===u?-1:u.index}]}))},"5dbc":function(t,e,i){var a=i("d3f4"),n=i("8b97").set;t.exports=function(t,e,i){var o,s=e.constructor;return s!==i&&"function"==typeof s&&(o=s.prototype)!==i.prototype&&a(o)&&n&&n(t,o),t}},"83a1":function(t,e){t.exports=Object.is||function(t,e){return t===e?0!==t||1/t===1/e:t!=t&&e!=e}},"8b97":function(t,e,i){var a=i("d3f4"),n=i("cb7c"),o=function(t,e){if(n(t),!a(e)&&null!==e)throw TypeError(e+": can't set as prototype!")};t.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(t,e,a){try{a=i("9b43")(Function.call,i("11e9").f(Object.prototype,"__proto__").set,2),a(t,[]),e=!(t instanceof Array)}catch(n){e=!0}return function(t,i){return o(t,i),e?t.__proto__=i:a(t,i),t}}({},!1):void 0),check:o}},aa77:function(t,e,i){var a=i("5ca1"),n=i("be13"),o=i("79e5"),s=i("fdef"),r="["+s+"]",c="​",l=RegExp("^"+r+r+"*"),u=RegExp(r+r+"*$"),d=function(t,e,i){var n={},r=o((function(){return!!s[t]()||c[t]()!=c})),l=n[t]=r?e(h):s[t];i&&(n[i]=l),a(a.P+a.F*r,"String",n)},h=d.trim=function(t,e){return t=String(n(t)),1&e&&(t=t.replace(l,"")),2&e&&(t=t.replace(u,"")),t};t.exports=d},c4c8:function(t,e,i){"use strict";i.d(e,"c",(function(){return r})),i.d(e,"b",(function(){return c})),i.d(e,"d",(function(){return l})),i.d(e,"a",(function(){return u}));var a=i("c276"),n=i("b6bd"),o=a["a"].cookies.get("token"),s=i("4328");function r(t){return Object(n["a"])({url:"/goods/manage/list?token="+o,method:"post",data:s.stringify(t)})}function c(t){return Object(n["a"])({url:"/goods/manage/info?token="+o,method:"post",data:t})}function l(t){return Object(n["a"])({url:"/goods/manage/save?token="+o,method:"post",data:t})}function u(t){return Object(n["a"])({url:"/goods/manage/del?token="+o,method:"post",data:t})}},c5f6:function(t,e,i){"use strict";var a=i("7726"),n=i("69a8"),o=i("2d95"),s=i("5dbc"),r=i("6a99"),c=i("79e5"),l=i("9093").f,u=i("11e9").f,d=i("86cc").f,h=i("aa77").trim,f="Number",p=a[f],g=p,m=p.prototype,b=o(i("2aeb")(m))==f,v="trim"in String.prototype,y=function(t){var e=r(t,!1);if("string"==typeof e&&e.length>2){e=v?e.trim():h(e,3);var i,a,n,o=e.charCodeAt(0);if(43===o||45===o){if(i=e.charCodeAt(2),88===i||120===i)return NaN}else if(48===o){switch(e.charCodeAt(1)){case 66:case 98:a=2,n=49;break;case 79:case 111:a=8,n=55;break;default:return+e}for(var s,c=e.slice(2),l=0,u=c.length;l<u;l++)if(s=c.charCodeAt(l),s<48||s>n)return NaN;return parseInt(c,a)}}return+e};if(!p(" 0o1")||!p("0b1")||p("+0x1")){p=function(t){var e=arguments.length<1?0:t,i=this;return i instanceof p&&(b?c((function(){m.valueOf.call(i)})):o(i)!=f)?s(new g(y(e)),i,p):y(e)};for(var I,w=i("9e1e")?l(g):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),S=0;w.length>S;S++)n(g,I=w[S])&&!n(p,I)&&d(p,I,u(g,I));p.prototype=m,m.constructor=p,i("2aba")(a,f,p)}},d9bf:function(t,e,i){},d9e1:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:"选择"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[i("div",{staticClass:"choose-class",class:t.isMobile?"":"wrapper"},[i("Card",{class:t.isMobile?"":"right-content"},[i("Form",{ref:"formCustom",attrs:{"label-width":100}},[i("Row",{staticStyle:{"margin-bottom":"16px"},attrs:{type:"flex",justify:"space-between"}},[i("Col",{attrs:{xs:24,md:12,lg:12}},[i("Input",{staticStyle:{width:"95%"},attrs:{type:"text",placeholder:"请输入"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品")+"名称",clearabl:""},model:{value:t.searchValidate.name,callback:function(e){t.$set(t.searchValidate,"name",e)},expression:"searchValidate.name"}})],1),i("Col",{attrs:{xs:24,md:12,lg:12}},[i("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),i("Button",{staticClass:"ivu-ml-8",on:{click:t.resetSearch}},[t._v("重置")]),t.showMore||1!=t.type||t.isFinished?t._e():i("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              展开\n              "),i("Icon",{attrs:{type:"ios-arrow-down"}})],1),t.showMore?i("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              收起\n              "),i("Icon",{attrs:{type:"ios-arrow-up"}})],1):t._e()],1)],1),t.showMore?i("Row",{attrs:{type:"flex",justify:"space-between"}},[i("Col",{attrs:{xs:24,md:12,lg:12}},[i("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[i("RadioGroup",{model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[i("Radio",{attrs:{label:0}},[t._v("全部")]),i("Radio",{attrs:{label:2}},[t._v("半成品")]),i("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1)],1):t._e()],1),i("div",[i("div",[i("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect}})],1),i("div",{staticClass:"ivu-mt ivu-text-center"},[i("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)])],1),t.isMobile?t._e():i("Card",{staticClass:"left-content"},[i("div",{staticClass:"ivu-mt",attrs:{slot:"title"},slot:"title"},[i("Alert",[i("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),i("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),i("List",{attrs:{border:""}},[i("Scroll",{staticStyle:{flex:"1"},attrs:{height:415}},t._l(t.selectedArr,(function(e,a){return i("ListItem",{key:a},[i("ListItemMeta",{attrs:{avatar:"",title:e.name,description:""}}),i("template",{slot:"action"},[i("li",{on:{click:function(e){return t.delClass(a)}}},[i("Icon",{attrs:{type:"md-close-circle",size:"19"}})],1)])],2)})),1)],1)],1)],1),i("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[i("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),i("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)])},n=[],o=(i("8e6e"),i("456d"),i("386d"),i("ac6a"),i("bd86")),s=i("c4c8"),r=i("2f08"),c=i("2f62"),l=i("9411");function u(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,a)}return i}function d(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?u(i,!0).forEach((function(e){Object(o["a"])(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):u(i).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}var h={name:"chooseMateriel",components:{iCopyright:r["a"]},props:{modal:{type:Boolean,default:!1},selected:{type:Array,default:function(){return[]}}},data:function(){return{columns:[{type:"selection",minWidth:50},{title:"名称",minWidth:100,key:"name"},{title:"单位",key:"unit",minWidth:100},{title:"库存",key:"stock",minWidth:100}],data:[],searchValidate:{name:"",isFinished:0,type:""},showModal:!1,selectedArr:[],showMore:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0},type:"",isFinished:"",loading:!0,groupId:"",isSubmit:!1}},computed:d({},Object(c["e"])("admin/layout",["isMobile"])),watch:{},methods:{changeSelect:function(t){var e=this;this.selectedArr=[],t.forEach((function(t){e.selectedArr.push(t)}))},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleReset:function(t){this.showModal=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;if(this.groupId){if(this.isSubmit)return;this.isSubmit=!0;var i=this.selectedArr.map((function(t){return t.id}));Object(l["t"])({groupId:this.groupId,goodsId:i.join(",")}).then((function(t){console.log(222222),e.$Message.success("保存成功"),e.showModal=!1,e.isSubmit=!1})).catch((function(t){e.isSubmit=!1}))}else this.showModal=!1,this.$emit("handleChoose",this.selectedArr)},delClass:function(t){var e=this,i="";this.data.some((function(a,n){a.id===e.selectedArr[t].id&&(i=n)})),this.$refs.tableData.toggleSelect(i)},resetSearch:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.searchValidate={name:"",isFinished:this.isFinished,type:this.type},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},changePage:function(t){this.pageInfo.page=t,this.getData()},getData:function(){var t=this;this.data=[],this.loading=!0,Object(s["c"])(d({},this.pageInfo,{},this.searchValidate)).then((function(e){var i=[];t.data=e.data.list.map((function(e){return i=t.selectedArr.filter((function(t){return t.id==e.id})),e._checked=i.length>0,e})),console.log(t.data),t.pageInfo=e.data.pageInfo,t.loading=!1})).catch((function(e){t.loading=!1}))},loadData:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2,i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";console.log(111111111111),2==e?(this.isFinished="",this.type=2):(this.isFinished=t||0,this.type=1,1==this.isFinished&&(this.columns.splice(2,0,{title:"单价",key:"price",minWidth:100}),this.columns.splice(4,1))),this.searchValidate.isFinished=this.isFinished,this.searchValidate.type=this.type,this.searchValidate.name="",this.showModal=!0,this.loading=!0,this.selectedArr=[],this.groupId=i,i?this.getGroupGoods():this.search()},getGroupGoods:function(){var t=this;Object(l["s"])({groupId:this.groupId}).then((function(e){console.log(222222),console.log(e.data.list),t.selectedArr=e.data.list,t.search()})).catch((function(e){t.loading=!1}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},f=h,p=(i("37c9"),i("2877")),g=Object(p["a"])(f,a,n,!1,null,"889160f8",null);e["a"]=g.exports},fdef:function(t,e){t.exports="\t\n\v\f\r   ᠎             　\u2028\u2029\ufeff"}}]);