(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement~erpManagement0~erpManagement2"],{"12ae":function(t,e){t.exports="data:image/gif;base64,R0lGODlhJQAlAJECAL3L2AYrTv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgACACwAAAAAJQAlAAACi5SPqcvtDyGYIFpF690i8xUw3qJBwUlSadmcLqYmGQu6KDIeM13beGzYWWy3DlB4IYaMk+Dso2RWkFCfLPcRvFbZxFLUDTt21BW56TyjRep1e20+i+eYMR145W2eefj+6VFmgTQi+ECVY8iGxcg35phGo/iDFwlTyXWphwlm1imGRdcnuqhHeop6UAAAIfkEBQoAAgAsEAACAAQACwAAAgWMj6nLXAAh+QQFCgACACwVAAUACgALAAACFZQvgRi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwXABEADAADAAACBYyPqcsFACH5BAUKAAIALBUAFQAKAAsAAAITlGKZwWoMHYxqtmplxlNT7ixGAQAh+QQFCgACACwQABgABAALAAACBYyPqctcACH5BAUKAAIALAUAFQAKAAsAAAIVlC+BGL3Z3IlxUmUuhtR2LzHhsiEFACH5BAUKAAIALAEAEQAMAAMAAAIFjI+pywUAIfkEBQoAAgAsBQAFAAoACwAAAhOUYJnAagwdjGq2amXGU1PuLEYBACH5BAUKAAIALBAAAgAEAAsAAAIFhI+py1wAIfkEBQoAAgAsFQAFAAoACwAAAhWUL4AIvdnciXFSZS6G1HYvMeGyIQUAIfkEBQoAAgAsFwARAAwAAwAAAgWEj6nLBQAh+QQFCgACACwVABUACgALAAACE5RgmcBqDB2MarZqZcZTU+4sRgEAIfkEBQoAAgAsEAAYAAQACwAAAgWEj6nLXAAh+QQFCgACACwFABUACgALAAACFZQvgAi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwBABEADAADAAACBYSPqcsFADs="},"287e":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("Modal",{attrs:{"mask-closable":!1,title:"物料详情",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?i("Spin",{attrs:{size:"large",fix:""}}):t._e(),i("Row",[i("Col",[i("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formData,border:"","show-summary":"","min-height":"200"},scopedSlots:t._u([{key:"name",fn:function(e){var i=e.row;return[t._v(t._s(i.name)+" "+t._s(i.workingName?"("+i.workingName+")":""))]}}])})],1)],1),i("template",{slot:"footer"},[i("Button",{on:{click:function(e){return t.handleReset("formData")}}},[t._v("关闭")])],1)],2)},s=[],n=i("f8b7"),o={components:{},props:{},data:function(){return{loading:!1,showModal:!1,formData:[],columns:[{title:"编号",key:"number",minWidth:100},{title:"名称",key:"name",minWidth:100,slot:"name"},{title:"规格",key:"attr",minWidth:100},{title:"所需数量",minWidth:100,key:"count"},{title:"单位",key:"unit",minWidth:50},{title:"体积",key:"volume",minWidth:50},{title:"重量",key:"weight",minWidth:50}]}},computed:{},watch:{},methods:{handleReset:function(t){this.showModal=!1,this.formData=[]},getInfo:function(t){var e=this;console.log(t),this.showModal=!0,this.loading=!0,Object(n["b"])({id:t}).then((function(t){0===t.ret&&(e.formData=t.data.list,e.loading=!1)}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},l=o,r=(i("5c69"),i("2877")),c=Object(r["a"])(l,a,s,!1,null,"dcfa165a",null);e["a"]=c.exports},"310f":function(t,e,i){},"40cb":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[""!=t.picArr.picName?a("div",{staticClass:"demo-upload-list"},[[a("img",{attrs:{src:t.demainUrl+t.picArr.pic}}),a("div",{staticClass:"demo-upload-list-cover"},[a("Icon",{attrs:{type:"ios-eye-outline"},nativeOn:{click:function(e){return t.handleView(t.picArr.pic)}}}),a("Icon",{attrs:{type:"ios-trash-outline"},nativeOn:{click:function(e){return t.handleRemove(e)}}})],1)]],2):t._e(),a("Upload",{directives:[{name:"show",rawName:"v-show",value:"view"!=t.status&&""==t.picArr.picName,expression:"status!='view' && picArr.picName == ''"}],ref:"upload",staticStyle:{display:"inline-block",width:"100px",height:"100px"},attrs:{name:"img","show-upload-list":!1,"on-success":t.handleSuccess,format:["jpg","jpeg","png","gif"],"max-size":2048,"on-format-error":t.handleFormatError,"on-exceeded-size":t.handleMaxSize,"before-upload":t.handleBeforeUpload,type:"drag",action:t.uploadImg}},[a("Modal",{attrs:{title:"图片预览"},model:{value:t.visible,callback:function(e){t.visible=e},expression:"visible"}},[t.visible?a("img",{staticStyle:{width:"100%"},attrs:{src:t.imgName}}):t._e()]),a("div",{staticStyle:{width:"100px",height:"100px","line-height":"100px"}},[t.loadingImg?t._e():a("Icon",{attrs:{type:"ios-camera",size:"30"}}),t.loadingImg?a("img",{staticStyle:{display:"inline-block",width:"50px",height:"50px","margin-top":"25px"},attrs:{src:i("12ae")}}):t._e()],1)],1)],1)},s=[],n=(i("7f7f"),i("7e1e")),o=i("c276"),l={data:function(){return{loadingImg:!1,picName:"",uploadImg:n["d"],demainUrl:o["a"].cookies.get("domainUrl"),headers:{"Access-Control-Allow-Origin":"*"},visible:!1,imgName:""}},props:{status:{type:String},picArr:{type:Object}},computed:{},methods:{handleSuccess:function(t,e){this.loadingImg=!1,0==t.ret?(this.picArr.picName=t.data.imgUrl,this.picArr.pic=t.data.url,this.$emit("uploadSuccess",this.picArr)):this.$Notice.warning({title:"上传失败",desc:t.msg})},handleBeforeUpload:function(t){this.loadingImg=!0},handleFormatError:function(t){this.loadingImg=!1,this.loadingSmall=!1,this.$Notice.warning({title:"图片格式上传错误",desc:"文件 "+t.name+" 格式错误, 请选择图片格式例jpg,png,gif"})},handleMaxSize:function(t){this.loadingImg=!1,this.loadingSmall=!1,this.$Notice.warning({title:"超出文件大小限制",desc:"文件  "+t.name+"太大, 不能大于2M"})},handleRemove:function(){this.loadingImg=!0,this.$set(this.picArr,"picName",""),this.$set(this.picArr,"pic",""),this.loadingImg=!1,this.$emit("uploadSuccess",this.picArr)},handleView:function(t){this.imgName=this.demainUrl+t,this.visible=!0}},created:function(){},mounted:function(){}},r=l,c=(i("add2"),i("2877")),d=Object(c["a"])(r,a,s,!1,null,"718b7e3e",null);e["a"]=d.exports},5395:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:"选择"+(t.type?2==t.type?"物料":2==t.isFinished?"半成品":"产品":"半成品/物料"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[i("div",{staticClass:"choose-class",class:t.isMobile?"":"wrapper"},[i("Card",{class:t.isMobile?"":"right-content"},[i("Form",{ref:"formCustom",attrs:{"label-width":100}},[i("Row",{staticStyle:{"margin-bottom":"16px"},attrs:{type:"flex",justify:"space-between"}},[i("Col",{attrs:{xs:24,md:12,lg:12}},[i("Input",{staticStyle:{width:"95%"},attrs:{type:"text",placeholder:"请输入"+(t.type?2==t.type?"物料":2==t.isFinished?"半成品":"产品":"半成品/物料")+"名称",clearabl:""},model:{value:t.searchValidate.name,callback:function(e){t.$set(t.searchValidate,"name",e)},expression:"searchValidate.name"}})],1),i("Col",{attrs:{xs:24,md:12,lg:12}},[t.isFinished||2==t.type?t._e():i("RadioGroup",{on:{"on-change":t.search},model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[i("Radio",{attrs:{label:0}},[t._v("全部")]),i("Radio",{attrs:{label:2}},[t._v("半成品")]),i("Radio",{attrs:{label:1}},[t._v("成品")])],1),t.type?t._e():i("RadioGroup",{on:{"on-change":t.search},model:{value:t.searchValidate.type,callback:function(e){t.$set(t.searchValidate,"type",e)},expression:"searchValidate.type"}},[i("Radio",{attrs:{label:2}},[t._v("物料")]),i("Radio",{attrs:{label:1}},[t._v("半成品")])],1),i("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),i("Button",{staticClass:"ivu-ml-8",on:{click:t.resetSearch}},[t._v("重置")])],1)],1),t.showMore&&!t.isFinished&&2!=t.type?i("Row",{attrs:{type:"flex",justify:"space-between"}},[i("Col",{attrs:{xs:24,md:12,lg:12}},[i("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[t._v(t._s(t.type)+"\n              "),i("RadioGroup",{on:{"on-change":t.search},model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[i("Radio",{attrs:{label:0}},[t._v("全部")]),i("Radio",{attrs:{label:2}},[t._v("半成品")]),i("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1)],1):t._e(),t.showMore&&!t.type?i("Row",{attrs:{type:"flex",justify:"space-between"}},[i("Col",{attrs:{xs:24,md:12,lg:12}},[i("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[i("RadioGroup",{on:{"on-change":t.search},model:{value:t.searchValidate.type,callback:function(e){t.$set(t.searchValidate,"type",e)},expression:"searchValidate.type"}},[i("Radio",{attrs:{label:2}},[t._v("物料")]),i("Radio",{attrs:{label:1}},[t._v("半成品")])],1)],1)],1)],1):t._e()],1),i("div",[i("div",[i("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect},scopedSlots:t._u([{key:"name",fn:function(e){var i=e.row;return[t._v(t._s(i.name)+" "+t._s(i.workingName?"("+i.workingName+")":""))]}}])})],1),i("div",{staticClass:"ivu-mt ivu-text-center"},[i("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)])],1),t.isMobile?t._e():i("Card",{staticClass:"left-content"},[i("div",{staticClass:"ivu-mt",attrs:{slot:"title"},slot:"title"},[i("Alert",[i("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),i("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),i("List",{attrs:{border:""}},[i("Scroll",{staticStyle:{flex:"1"},attrs:{height:415}},t._l(t.selectedArr,(function(e,a){return i("ListItem",{key:a},[i("ListItemMeta",{attrs:{avatar:"",title:e.name+(e.workingName?"("+e.workingName+")":""),description:""}}),i("template",{slot:"action"},[i("li",{on:{click:function(e){return t.delClass(a)}}},[i("Icon",{attrs:{type:"md-close-circle",size:"19"}})],1)])],2)})),1)],1)],1)],1),i("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[i("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),i("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)])},s=[],n=(i("8e6e"),i("456d"),i("386d"),i("ac6a"),i("bd86")),o=i("c4c8"),l=i("2f08"),r=i("2f62"),c=i("9411");function d(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,a)}return i}function h(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?d(i,!0).forEach((function(e){Object(n["a"])(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):d(i).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}var u={name:"chooseMateriel",components:{iCopyright:l["a"]},props:{modal:{type:Boolean,default:!1},selected:{type:Array,default:function(){return[]}}},data:function(){return{columns:[{type:"selection",minWidth:50},{title:"名称",minWidth:100,key:"name",slot:"name"},{title:"单位",key:"unit",minWidth:100},{title:"库存",key:"stock",minWidth:100}],data:[],searchValidate:{name:"",isFinished:0,type:""},showModal:!1,selectedArr:[],oldSelectedArr:[],showMore:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0},type:"",isFinished:"",loading:!0,groupId:"",isSubmit:!1}},computed:h({},Object(r["e"])("admin/layout",["isMobile"])),watch:{},methods:{changeSelect:function(t){var e=this;this.selectedArr=JSON.parse(JSON.stringify(this.oldSelectedArr)),t.forEach((function(t){e.selectedArr.push(t)}))},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleReset:function(t){this.showModal=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;if(this.groupId){if(this.isSubmit)return;this.isSubmit=!0;var i=this.selectedArr.map((function(t){return t.id}));Object(c["t"])({groupId:this.groupId,goodsId:i.join(",")}).then((function(t){console.log(222222),e.$Message.success("保存成功"),e.showModal=!1,e.isSubmit=!1})).catch((function(t){e.isSubmit=!1}))}else this.showModal=!1,this.$emit("handleChoose",this.selectedArr)},delClass:function(t){var e=this,i="";this.data.some((function(a,s){a.id===e.selectedArr[t].id&&(i=s)})),this.$refs.tableData.toggleSelect(i)},resetSearch:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.searchValidate={name:"",isFinished:this.isFinished,type:this.type||1},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},changePage:function(t){this.oldSelectedArr=JSON.parse(JSON.stringify(this.selectedArr)),this.pageInfo.page=t,this.getData()},getData:function(){var t=this;this.data=[],this.loading=!0,Object(o["j"])(h({},this.pageInfo,{},this.searchValidate,{isFinished:2==this.searchValidate.type?"":this.searchValidate.isFinished})).then((function(e){var i=[];t.data=e.data.list.map((function(e){return i=t.selectedArr.filter((function(t){return t.id==e.id})),e._checked=i.length>0,e})),console.log(t.data,"====================="),t.pageInfo=e.data.pageInfo,t.loading=!1})).catch((function(e){t.loading=!1}))},loadData:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2,i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";switch(console.log(111111111111),e){case 2:this.isFinished="",this.type=2,this.searchValidate.type=this.type;break;case 3:this.isFinished=t,this.type=0,this.searchValidate.type=1;break;default:this.isFinished=t||0,this.type=1,this.columns.splice(2,0,{title:"规格",key:"attr",minWidth:100}),this.columns.splice(4,1),this.searchValidate.type=this.type;break}this.searchValidate.isFinished=this.isFinished,this.searchValidate.name="",this.showModal=!0,this.loading=!0,this.selectedArr=[],this.groupId=i,i?this.getGroupGoods():this.search()},getGroupGoods:function(){var t=this;Object(c["s"])({groupId:this.groupId}).then((function(e){console.log(222222),console.log(e.data.list),t.selectedArr=e.data.list,t.search()})).catch((function(e){t.loading=!1}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},A=u,p=(i("c0b8"),i("2877")),m=Object(p["a"])(A,a,s,!1,null,"3362f5b2",null);e["a"]=m.exports},"5c69":function(t,e,i){"use strict";var a=i("310f"),s=i.n(a);s.a},"7e1e":function(t,e,i){"use strict";i.d(e,"d",(function(){return n})),i.d(e,"c",(function(){return o})),i.d(e,"b",(function(){return l})),i.d(e,"a",(function(){return r}));var a=i("c276"),s=a["a"].cookies.get("token"),n="/upload/images?token="+s,o="/upload/upload-file?token="+s,l="/staff/staff/staff_export?token="+s,r="/sales/manage/order-export?token="+s},add2:function(t,e,i){"use strict";var a=i("d723"),s=i.n(a);s.a},c0b8:function(t,e,i){"use strict";var a=i("e123"),s=i.n(a);s.a},d723:function(t,e,i){},e123:function(t,e,i){}}]);