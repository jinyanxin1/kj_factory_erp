(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement~erpManagement2~erpManagement3"],{"12ae":function(t,e){t.exports="data:image/gif;base64,R0lGODlhJQAlAJECAL3L2AYrTv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgACACwAAAAAJQAlAAACi5SPqcvtDyGYIFpF690i8xUw3qJBwUlSadmcLqYmGQu6KDIeM13beGzYWWy3DlB4IYaMk+Dso2RWkFCfLPcRvFbZxFLUDTt21BW56TyjRep1e20+i+eYMR145W2eefj+6VFmgTQi+ECVY8iGxcg35phGo/iDFwlTyXWphwlm1imGRdcnuqhHeop6UAAAIfkEBQoAAgAsEAACAAQACwAAAgWMj6nLXAAh+QQFCgACACwVAAUACgALAAACFZQvgRi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwXABEADAADAAACBYyPqcsFACH5BAUKAAIALBUAFQAKAAsAAAITlGKZwWoMHYxqtmplxlNT7ixGAQAh+QQFCgACACwQABgABAALAAACBYyPqctcACH5BAUKAAIALAUAFQAKAAsAAAIVlC+BGL3Z3IlxUmUuhtR2LzHhsiEFACH5BAUKAAIALAEAEQAMAAMAAAIFjI+pywUAIfkEBQoAAgAsBQAFAAoACwAAAhOUYJnAagwdjGq2amXGU1PuLEYBACH5BAUKAAIALBAAAgAEAAsAAAIFhI+py1wAIfkEBQoAAgAsFQAFAAoACwAAAhWUL4AIvdnciXFSZS6G1HYvMeGyIQUAIfkEBQoAAgAsFwARAAwAAwAAAgWEj6nLBQAh+QQFCgACACwVABUACgALAAACE5RgmcBqDB2MarZqZcZTU+4sRgEAIfkEBQoAAgAsEAAYAAQACwAAAgWEj6nLXAAh+QQFCgACACwFABUACgALAAACFZQvgAi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwBABEADAADAAACBYSPqcsFADs="},"386d":function(t,e,a){"use strict";var i=a("cb7c"),o=a("83a1"),n=a("5f1b");a("214f")("search",1,(function(t,e,a,r){return[function(a){var i=t(this),o=void 0==a?void 0:a[e];return void 0!==o?o.call(a,i):new RegExp(a)[e](String(i))},function(t){var e=r(a,t,this);if(e.done)return e.value;var s=i(t),l=String(this),c=s.lastIndex;o(c,0)||(s.lastIndex=0);var u=n(s,l);return o(s.lastIndex,c)||(s.lastIndex=c),null===u?-1:u.index}]}))},"40cb":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[""!=t.picArr.picName?i("div",{staticClass:"demo-upload-list"},[[i("img",{attrs:{src:t.demainUrl+t.picArr.pic}}),i("div",{staticClass:"demo-upload-list-cover"},[i("Icon",{attrs:{type:"ios-eye-outline"},nativeOn:{click:function(e){return t.handleView(t.picArr.pic)}}}),i("Icon",{attrs:{type:"ios-trash-outline"},nativeOn:{click:function(e){return t.handleRemove(e)}}})],1)]],2):t._e(),i("Upload",{directives:[{name:"show",rawName:"v-show",value:"view"!=t.status&&""==t.picArr.picName,expression:"status!='view' && picArr.picName == ''"}],ref:"upload",staticStyle:{display:"inline-block",width:"100px",height:"100px"},attrs:{name:"img","show-upload-list":!1,"on-success":t.handleSuccess,format:["jpg","jpeg","png","gif"],"max-size":2048,"on-format-error":t.handleFormatError,"on-exceeded-size":t.handleMaxSize,"before-upload":t.handleBeforeUpload,type:"drag",action:t.uploadImg}},[i("Modal",{attrs:{title:"图片预览"},model:{value:t.visible,callback:function(e){t.visible=e},expression:"visible"}},[t.visible?i("img",{staticStyle:{width:"100%"},attrs:{src:t.imgName}}):t._e()]),i("div",{staticStyle:{width:"100px",height:"100px","line-height":"100px"}},[t.loadingImg?t._e():i("Icon",{attrs:{type:"ios-camera",size:"30"}}),t.loadingImg?i("img",{staticStyle:{display:"inline-block",width:"50px",height:"50px","margin-top":"25px"},attrs:{src:a("12ae")}}):t._e()],1)],1)],1)},o=[],n=(a("7f7f"),a("7e1e")),r=a("c276"),s={data:function(){return{loadingImg:!1,picName:"",uploadImg:n["a"],demainUrl:r["a"].cookies.get("domainUrl"),headers:{"Access-Control-Allow-Origin":"*"},visible:!1,imgName:""}},props:{status:{type:String},picArr:{type:Object}},computed:{},methods:{handleSuccess:function(t,e){this.loadingImg=!1,0==t.ret?(this.picArr.picName=t.data.imgUrl,this.picArr.pic=t.data.url,this.$emit("uploadSuccess",this.picArr)):this.$Notice.warning({title:"上传失败",desc:t.msg})},handleBeforeUpload:function(t){this.loadingImg=!0},handleFormatError:function(t){this.loadingImg=!1,this.loadingSmall=!1,this.$Notice.warning({title:"图片格式上传错误",desc:"文件 "+t.name+" 格式错误, 请选择图片格式例jpg,png,gif"})},handleMaxSize:function(t){this.loadingImg=!1,this.loadingSmall=!1,this.$Notice.warning({title:"超出文件大小限制",desc:"文件  "+t.name+"太大, 不能大于2M"})},handleRemove:function(){this.loadingImg=!0,this.$set(this.picArr,"picName",""),this.$set(this.picArr,"pic",""),this.loadingImg=!1,this.$emit("uploadSuccess",this.picArr)},handleView:function(t){this.imgName=this.demainUrl+t,this.visible=!0}},created:function(){},mounted:function(){}},l=s,c=(a("add2"),a("2877")),u=Object(c["a"])(l,i,o,!1,null,"718b7e3e",null);e["a"]=u.exports},5671:function(t,e,a){},"5dbc":function(t,e,a){var i=a("d3f4"),o=a("8b97").set;t.exports=function(t,e,a){var n,r=e.constructor;return r!==a&&"function"==typeof r&&(n=r.prototype)!==a.prototype&&i(n)&&o&&o(t,n),t}},"7e1e":function(t,e,a){"use strict";a.d(e,"a",(function(){return n}));var i=a("c276"),o=i["a"].cookies.get("token"),n="/upload/images?token="+o},"83a1":function(t,e){t.exports=Object.is||function(t,e){return t===e?0!==t||1/t===1/e:t!=t&&e!=e}},"8b97":function(t,e,a){var i=a("d3f4"),o=a("cb7c"),n=function(t,e){if(o(t),!i(e)&&null!==e)throw TypeError(e+": can't set as prototype!")};t.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(t,e,i){try{i=a("9b43")(Function.call,a("11e9").f(Object.prototype,"__proto__").set,2),i(t,[]),e=!(t instanceof Array)}catch(o){e=!0}return function(t,a){return n(t,a),e?t.__proto__=a:i(t,a),t}}({},!1):void 0),check:n}},"8f7d":function(t,e,a){"use strict";var i=a("5671"),o=a.n(i);o.a},aa77:function(t,e,a){var i=a("5ca1"),o=a("be13"),n=a("79e5"),r=a("fdef"),s="["+r+"]",l="​",c=RegExp("^"+s+s+"*"),u=RegExp(s+s+"*$"),d=function(t,e,a){var o={},s=n((function(){return!!r[t]()||l[t]()!=l})),c=o[t]=s?e(m):r[t];a&&(o[a]=c),i(i.P+i.F*s,"String",o)},m=d.trim=function(t,e){return t=String(o(t)),1&e&&(t=t.replace(c,"")),2&e&&(t=t.replace(u,"")),t};t.exports=d},add2:function(t,e,a){"use strict";var i=a("d723"),o=a.n(i);o.a},ade6:function(t,e,a){"use strict";var i=a("bc94"),o=a.n(i);o.a},bc94:function(t,e,a){},c4c8:function(t,e,a){"use strict";a.d(e,"c",(function(){return s})),a.d(e,"b",(function(){return l})),a.d(e,"d",(function(){return c})),a.d(e,"a",(function(){return u}));var i=a("c276"),o=a("b6bd"),n=i["a"].cookies.get("token"),r=a("4328");function s(t){return Object(o["a"])({url:"/goods/manage/list?token="+n,method:"post",data:r.stringify(t)})}function l(t){return Object(o["a"])({url:"/goods/manage/info?token="+n,method:"post",data:t})}function c(t){return Object(o["a"])({url:"/goods/manage/save?token="+n,method:"post",data:t})}function u(t){return Object(o["a"])({url:"/goods/manage/del?token="+n,method:"post",data:t})}},c5f6:function(t,e,a){"use strict";var i=a("7726"),o=a("69a8"),n=a("2d95"),r=a("5dbc"),s=a("6a99"),l=a("79e5"),c=a("9093").f,u=a("11e9").f,d=a("86cc").f,m=a("aa77").trim,p="Number",h=i[p],f=h,A=h.prototype,g=n(a("2aeb")(A))==p,b="trim"in String.prototype,v=function(t){var e=s(t,!1);if("string"==typeof e&&e.length>2){e=b?e.trim():m(e,3);var a,i,o,n=e.charCodeAt(0);if(43===n||45===n){if(a=e.charCodeAt(2),88===a||120===a)return NaN}else if(48===n){switch(e.charCodeAt(1)){case 66:case 98:i=2,o=49;break;case 79:case 111:i=8,o=55;break;default:return+e}for(var r,l=e.slice(2),c=0,u=l.length;c<u;c++)if(r=l.charCodeAt(c),r<48||r>o)return NaN;return parseInt(l,i)}}return+e};if(!h(" 0o1")||!h("0b1")||h("+0x1")){h=function(t){var e=arguments.length<1?0:t,a=this;return a instanceof h&&(g?l((function(){A.valueOf.call(a)})):n(a)!=p)?r(new f(v(e)),a,h):v(e)};for(var y,w=a("9e1e")?c(f):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),I=0;w.length>I;I++)o(f,y=w[I])&&!o(h,y)&&d(h,y,u(f,y));h.prototype=A,A.constructor=h,a("2aba")(i,p,h)}},d723:function(t,e,a){},d9e1:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:"选择"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("div",{staticClass:"choose-class",class:t.isMobile?"":"wrapper"},[a("Card",{class:t.isMobile?"":"right-content"},[a("Form",{ref:"formCustom",attrs:{"label-width":100}},[a("Row",{staticStyle:{"margin-bottom":"16px"},attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Input",{staticStyle:{width:"95%"},attrs:{type:"text",placeholder:"请输入"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品")+"名称",clearabl:""},model:{value:t.searchValidate.name,callback:function(e){t.$set(t.searchValidate,"name",e)},expression:"searchValidate.name"}})],1),a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("查询")]),a("Button",{staticClass:"ivu-ml-8",on:{click:t.resetSearch}},[t._v("重置")]),t.showMore||1!=t.type||t.isFinished?t._e():a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              展开\n              "),a("Icon",{attrs:{type:"ios-arrow-down"}})],1),t.showMore?a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              收起\n              "),a("Icon",{attrs:{type:"ios-arrow-up"}})],1):t._e()],1)],1),t.showMore?a("Row",{attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[a("RadioGroup",{model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:2}},[t._v("半成品")]),a("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1)],1):t._e()],1),a("div",[a("div",[a("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect}})],1),a("div",{staticClass:"ivu-mt ivu-text-center"},[a("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)])],1),t.isMobile?t._e():a("Card",{staticClass:"left-content"},[a("div",{staticClass:"ivu-mt",attrs:{slot:"title"},slot:"title"},[a("Alert",[a("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),a("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),a("List",{attrs:{border:""}},[a("Scroll",{staticStyle:{flex:"1"},attrs:{height:415}},t._l(t.selectedArr,(function(e,i){return a("ListItem",{key:i},[a("ListItemMeta",{attrs:{avatar:"",title:e.name,description:""}}),a("template",{slot:"action"},[a("li",{on:{click:function(e){return t.delClass(i)}}},[a("Icon",{attrs:{type:"md-close-circle",size:"19"}})],1)])],2)})),1)],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)])},o=[],n=(a("8e6e"),a("456d"),a("386d"),a("ac6a"),a("bd86")),r=a("c4c8"),s=a("2f08"),l=a("2f62");function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(a,!0).forEach((function(e){Object(n["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var d={name:"chooseMateriel",components:{iCopyright:s["a"]},props:{modal:{type:Boolean,default:!1},selected:{type:Array,default:function(){return[]}}},data:function(){return{columns:[{type:"selection",minWidth:50},{title:"名称",minWidth:100,key:"name"},{title:"单位",key:"unit",minWidth:100},{title:"库存",key:"stock",minWidth:100}],data:[],searchValidate:{name:"",isFinished:0,type:""},showModal:!1,selectedArr:[],showMore:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0},type:"",isFinished:"",loading:!0}},computed:u({},Object(l["e"])("admin/layout",["isMobile"])),watch:{},methods:{changeSelect:function(t){var e=this;this.selectedArr=[],t.forEach((function(t){e.selectedArr.push(t)}))},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleReset:function(t){this.showModal=!1,this.$emit("hideModal")},handleSubmit:function(t){this.showModal=!1,this.$emit("handleChoose",this.selectedArr)},delClass:function(t){var e=this,a="";this.data.some((function(i,o){i.id===e.selectedArr[t].id&&(a=o)})),this.$refs.tableData.toggleSelect(a)},resetSearch:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.searchValidate={name:"",isFinished:this.isFinished,type:this.type},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},changePage:function(t){this.pageInfo.page=t,this.getData()},getData:function(){var t=this;this.loading=!0,this.data=[],Object(r["c"])(u({},this.pageInfo,{},this.searchValidate)).then((function(e){t.loading=!1,t.data=e.data.list,t.pageInfo=e.data.pageInfo}))},loadData:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2;console.log(111111111111),2==e?(this.isFinished="",this.type=2):(this.isFinished=t||0,this.type=1),this.searchValidate.isFinished=this.isFinished,this.searchValidate.type=this.type,this.searchValidate.name="",this.showModal=!0,this.selectedArr=[],this.search()}},mounted:function(){},beforeDestroy:function(){},created:function(){}},m=d,p=(a("8f7d"),a("2877")),h=Object(p["a"])(m,i,o,!1,null,"77a3ce5e",null);e["a"]=h.exports},e1e1:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:(t.formData.id?"编辑":"新增")+(1==t.formData.type?"产品":"物料"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v(t._s(1==t.formData.type?"产品":"物料")+"信息")]),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:(1==t.formData.type?"产品":"物料")+"名称","label-position":"top",prop:"name"}},[a("Input",{attrs:{placeholder:"请输入"+(1==t.formData.type?"产品":"物料")+"名称"},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"编号","label-position":"top",prop:"number"}},[a("Input",{attrs:{placeholder:"请输入编号"},model:{value:t.formData.number,callback:function(e){t.$set(t.formData,"number",e)},expression:"formData.number"}})],1)],1),1==t.formData.type?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"产品类型","label-position":"top",prop:"isFinished"}},[a("RadioGroup",{on:{"on-change":function(){t.formData.materialList=[]}},model:{value:t.formData.isFinished,callback:function(e){t.$set(t.formData,"isFinished",e)},expression:"formData.isFinished"}},[a("Radio",{attrs:{label:1}},[t._v("成品")]),a("Radio",{attrs:{label:2}},[t._v("半成品")])],1)],1)],1):t._e(),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"单位","label-position":"top",prop:"unit"}},[a("Input",{attrs:{placeholder:"请输入单位",maxlength:11},model:{value:t.formData.unit,callback:function(e){t.$set(t.formData,"unit",e)},expression:"formData.unit"}})],1)],1),2==t.formData.type?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"参数","label-position":"top",prop:"unit"}},[a("Input",{attrs:{placeholder:"请输入参数",maxlength:11},model:{value:t.formData.parameter,callback:function(e){t.$set(t.formData,"parameter",e)},expression:"formData.parameter"}})],1)],1):t._e(),2==t.formData.type?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"体积","label-position":"top",prop:"unit"}},[a("Input",{attrs:{placeholder:"请输入体积",maxlength:11},model:{value:t.formData.volume,callback:function(e){t.$set(t.formData,"volume",e)},expression:"formData.volume"}})],1)],1):t._e(),2==t.formData.type?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"重量","label-position":"top",prop:"unit"}},[a("Input",{attrs:{placeholder:"请输入重量",maxlength:11},model:{value:t.formData.weight,callback:function(e){t.$set(t.formData,"weight",e)},expression:"formData.weight"}})],1)],1):t._e(),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"备注","label-position":"top"}},[a("Input",{attrs:{maxlength:"300",type:"textarea",rows:4},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],1),2==t.formData.type?a("Row",[a("Col",[a("FormItem",{attrs:{label:"图片","label-position":"top"}},[a("uploadImg",{attrs:{picArr:{pic:t.formData.pic||"",picName:t.formData.pic||""}},on:{uploadSuccess:t.handleSuccess}}),a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸：200*200px")])],1)],1)],1):t._e(),1==t.formData.type?a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("关联"+t._s(1==t.formData.isFinished?"半成品":"物料")+"\n        "),a("div",{staticClass:"choose",on:{click:function(e){return t.$refs.chooseMateriel.loadData(1==t.formData.isFinished?2:"",1==t.formData.isFinished?1:2)}}},[a("a",[t._v("选择"+t._s(1==t.formData.isFinished?"半成品":"物料")+"···")])])]),a("Col",[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formData.materialList,border:"","show-summary":"","min-height":"200"}})],1)],1):t._e()],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1),a("chooseMateriel",{ref:"chooseMateriel",on:{handleChoose:t.handleChoose}})],2)},o=[],n=(a("8e6e"),a("456d"),a("ac6a"),a("bd86")),r=(a("7f7f"),a("c5f6"),a("d9e1")),s=a("c4c8"),l=a("40cb");function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(a,!0).forEach((function(e){Object(n["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var d={components:{chooseMateriel:r["a"],uploadImg:l["a"]},props:{},data:function(){var t=this;this.$createElement;return{loading:!1,showModal:!1,formData:{id:"",name:"",number:"",unit:"",isFinished:1,describe:"",materialList:[],type:"",weight:"",volume:"",parameter:"",pic:""},ruleInline:{name:[{required:!0,message:"名称不能为空",trigger:"blur"}],number:[{required:!0,message:"编号不能为空",trigger:"blur"}]},isSubmit:!1,columns:[{title:"名称",key:"name",minWidth:100},{title:"单位",key:"unit",minWidth:50},{title:"所需数量",minWidth:100,align:"center",key:"num",render:function(e,a){return e("Input",{props:{size:"small",value:a.row.num,type:"number",min:0},on:{"on-blur":function(e){var i=Number(e.target.value);e.target.value=i,a.row.num=i,t.formData.materialList[a.index]=a.row}}})}},{title:"操作",key:"action",minWidth:80,align:"center",render:function(e,a){return e("Icon",{attrs:{type:"md-close-circle",size:"19",title:"删除"},on:{click:function(){t.delMateriel(a.index)}}})}}]}},computed:{},watch:{},methods:{handleReset:function(t){for(var e in this.showModal=!1,this.isSubmit=!1,this.formData)switch(e){case"isFinished":this.formData[e]=1;break;case"materialList":this.formData[e]=[];break;default:this.formData[e]="";break}this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;this.isSubmit||this.$refs[t].validate((function(a){a?(e.isSubmit=!0,Object(s["d"])(u({},e.formData)).then((function(a){0===a.ret?(e.$Message.success("保存成功！"),e.$emit("getData"),e.handleReset(t)):e.$Message.error(a.msg||"接口错误")})).catch((function(t){e.isSubmit=!1,console.log(t)}))):e.$Message.error("表单验证失败!")}))},getInfo:function(t){var e=this,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;if(console.log(a,"---------"),console.log(t),this.showModal=!0,!t)return this.formData.isFinished=1,void(this.formData.type=a);this.loading=!0,Object(s["b"])({id:t}).then((function(t){0===t.ret&&(e.formData=t.data.info,e.loading=!1)}))},handleChoose:function(t){var e=this,a=this.formData.materialList||[],i=[];console.log(11111),a.forEach((function(t){i.push(t.materialId+"")})),console.log(2222),t.forEach((function(t){var o={};-1===i.indexOf(t.id+"")&&(o.num=1,o.materialId=t.id,o.name=t.name,o.unit=t.unit,o.id="",o.goodsId=e.formData.id,a.push(o))})),console.log(this.formData),this.formData.materialList=a},delMateriel:function(t){this.formData.materialList.splice(t,1)},handleSuccess:function(t){this.formData.pic=t.pic}},mounted:function(){},beforeDestroy:function(){},created:function(){}},m=d,p=(a("ade6"),a("2877")),h=Object(p["a"])(m,i,o,!1,null,"46cc7c24",null);e["a"]=h.exports},fdef:function(t,e){t.exports="\t\n\v\f\r   ᠎             　\u2028\u2029\ufeff"}}]);