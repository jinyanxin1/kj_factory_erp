(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement0","erpManagement1"],{"0658":function(t,e,a){"use strict";a.d(e,"i",(function(){return r})),a.d(e,"a",(function(){return o})),a.d(e,"v",(function(){return s})),a.d(e,"f",(function(){return l})),a.d(e,"d",(function(){return c})),a.d(e,"l",(function(){return d})),a.d(e,"c",(function(){return u})),a.d(e,"h",(function(){return h})),a.d(e,"g",(function(){return f})),a.d(e,"b",(function(){return m})),a.d(e,"e",(function(){return p})),a.d(e,"k",(function(){return g})),a.d(e,"j",(function(){return b})),a.d(e,"q",(function(){return y})),a.d(e,"p",(function(){return v})),a.d(e,"w",(function(){return w})),a.d(e,"o",(function(){return O})),a.d(e,"n",(function(){return k})),a.d(e,"s",(function(){return I})),a.d(e,"u",(function(){return j})),a.d(e,"r",(function(){return S})),a.d(e,"t",(function(){return _})),a.d(e,"m",(function(){return V}));var n=a("b6bd"),i=a("4328");function r(t){return Object(n["a"])({url:"/client/client/client_list",method:"post",data:i.stringify(t)})}function o(t){return Object(n["a"])({url:"/client/client/client_add",method:"post",data:i.stringify(t)})}function s(t){return Object(n["a"])({url:"/client/client/client_save",method:"post",data:i.stringify(t)})}function l(t){return Object(n["a"])({url:"/client/client/client_info",method:"post",data:i.stringify(t)})}function c(t){return Object(n["a"])({url:"/client/client/client_person_add",method:"post",data:i.stringify(t)})}function d(t){return Object(n["a"])({url:"/client/client/client_person_list",method:"post",data:i.stringify(t)})}function u(t){return Object(n["a"])({url:"/client/client/client_interview_add",method:"post",data:i.stringify(t)})}function h(t){return Object(n["a"])({url:"/client/client/client_interview_list",method:"post",data:i.stringify(t)})}function f(t){return Object(n["a"])({url:"/client/client/client_interview_info",method:"post",data:i.stringify(t)})}function m(t){return Object(n["a"])({url:"/client/client/client_contract_add",method:"post",data:i.stringify(t)})}function p(t){return Object(n["a"])({url:"/client/client/client_contract_list",method:"post",data:i.stringify(t)})}function g(t){return Object(n["a"])({url:"/client/client/client_shift",method:"post",data:i.stringify(t)})}function b(t){return Object(n["a"])({url:"/client/client/select",method:"post",data:i.stringify(t)})}function y(t){return Object(n["a"])({url:"/client/client/person_select",method:"post",data:i.stringify(t)})}function v(t){return Object(n["a"])({url:"/client/client/client_person_info",method:"post",data:i.stringify(t)})}function w(t){return Object(n["a"])({url:"/client/client/client_person_save",method:"post",data:i.stringify(t)})}function O(t){return Object(n["a"])({url:"/client/client/client_person_del",method:"post",data:i.stringify(t)})}function k(t){return Object(n["a"])({url:"/client/client/client_del",method:"post",data:i.stringify(t)})}var I=function(t){return Object(n["a"])({url:"/project/manage/list",method:"post",data:t})},j=function(t){return Object(n["a"])({url:"/project/manage/save",method:"post",data:t})},S=function(t){return Object(n["a"])({url:"/project/manage/info",method:"post",data:t})},_=function(t){return Object(n["a"])({url:"/project/manage/get-report-user",method:"post",data:t})},V=function(t){return Object(n["a"])({url:"/client/client/list",method:"post",data:t})}},"23f1":function(t,e,a){},"287e":function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"物料详情",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Row",[a("Col",[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formData,border:"","show-summary":"","min-height":"200"}})],1)],1),a("template",{slot:"footer"},[a("Button",{on:{click:function(e){return t.handleReset("formData")}}},[t._v("关闭")])],1)],2)},i=[],r=a("f8b7"),o={components:{},props:{},data:function(){return{loading:!1,showModal:!1,formData:[],columns:[{title:"编号",key:"number",minWidth:100},{title:"名称",key:"name",minWidth:100},{title:"所需数量",minWidth:100,key:"count"},{title:"单位",key:"unit",minWidth:50},{title:"体积",key:"volume",minWidth:50},{title:"重量",key:"weight",minWidth:50}]}},computed:{},watch:{},methods:{handleReset:function(t){this.showModal=!1,this.formData=[]},getInfo:function(t){var e=this;console.log(t),this.showModal=!0,this.loading=!0,Object(r["b"])({id:t}).then((function(t){0===t.ret&&(e.formData=t.data.list,e.loading=!1)}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},s=o,l=(a("6839"),a("2877")),c=Object(l["a"])(s,n,i,!1,null,"3699aebb",null);e["a"]=c.exports},2887:function(t,e,a){"use strict";var n=a("4150"),i=a.n(n);i.a},"2b30":function(t,e,a){"use strict";a.r(e);var n,i,r=a("2877"),o={},s=Object(r["a"])(o,n,i,!1,null,null,null);e["default"]=s.exports},"386d":function(t,e,a){"use strict";var n=a("cb7c"),i=a("83a1"),r=a("5f1b");a("214f")("search",1,(function(t,e,a,o){return[function(a){var n=t(this),i=void 0==a?void 0:a[e];return void 0!==i?i.call(a,n):new RegExp(a)[e](String(n))},function(t){var e=o(a,t,this);if(e.done)return e.value;var s=n(t),l=String(this),c=s.lastIndex;i(c,0)||(s.lastIndex=0);var d=r(s,l);return i(s.lastIndex,c)||(s.lastIndex=c),null===d?-1:d.index}]}))},4150:function(t,e,a){},"57c7":function(t,e,a){},"5ad4":function(t,e,a){"use strict";var n=a("7c49"),i=a.n(n);i.a},"66f9":function(t,e,a){},6839:function(t,e,a){"use strict";var n=a("66f9"),i=a.n(n);i.a},"692d":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{attrs:{inline:""}},[a("Row",[a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单编号","label-position":"top","label-width":80}},[a("Input",{attrs:{placeholder:"请输入订单编号"},model:{value:t.searchValidate.number,callback:function(e){t.$set(t.searchValidate,"number",e)},expression:"searchValidate.number"}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"客户","label-position":"top","label-width":80}},[a("Input",{attrs:{placeholder:"请输入客户名称"},model:{value:t.searchValidate.clientName,callback:function(e){t.$set(t.searchValidate,"clientName",e)},expression:"searchValidate.clientName"}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"下单时间","label-position":"top","label-width":80}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"daterange","split-panels":"",placement:"bottom-end",placeholder:"请选择时间"},on:{"on-change":t.handleChangeTime},model:{value:t.searchValidate.time,callback:function(e){t.$set(t.searchValidate,"time",e)},expression:"searchValidate.time"}})],1)],1),a("Col",{attrs:{xs:24,sm:24,md:24,lg:24}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单状态","label-position":"top","label-width":80}},[a("RadioGroup",{model:{value:t.searchValidate.status,callback:function(e){t.$set(t.searchValidate,"status",e)},expression:"searchValidate.status"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:1}},[t._v("生产中")]),a("Radio",{attrs:{label:2}},[t._v("生产完成")]),a("Radio",{attrs:{label:3}},[t._v("已发货")]),a("Radio",{attrs:{label:4}},[t._v("已完成")])],1)],1)],1)],1),a("Row",[a("FormItem",{attrs:{label:"","label-position":"top","label-width":80}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("searchValidate")}}},[t._v("重置")])],1)],1)],1)],1),a("Card",[a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.selectItem}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page)},on:{"on-change":t.changePage}})],1)])],1),a("send",{ref:"Drawer",on:{getData:t.getData}}),a("materielDetail",{ref:"materielDetail"})],1)},i=[],r=(a("8e6e"),a("456d"),a("bd86")),o=(a("ac6a"),a("287e")),s=a("f8b7"),l=a("b627");function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function d(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var u={components:{send:l["a"],materielDetail:o["a"]},data:function(){var t=this;return{loading:!0,tableColumns:[{title:"订单编号",key:"number",minWidth:100,render:function(e,a){return e("div",[e("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px",width:"100px",height:"20px",display:"block"},on:{click:function(){t.show(a.row,"edit")}}},a.row.number)])}},{title:"客户名称",minWidth:100,key:"clientName"},{title:"总金额",minWidth:100,key:"totalPrice"},{title:"已付金额",minWidth:100,key:"receiptPrice"},{title:"状态",key:"statusName",minWidth:60},{title:"下单日期",minWidth:100,key:"orderDate"},{title:"发货日期",minWidth:100,key:"sendDate"},{title:"交货日期",minWidth:100,key:"deliveryDate"},{title:"操作",key:"action",minWidth:148,render:function(e,a){return e("div",[e("Button",{props:{size:"small",type:"primary"},style:{marginRight:"5px"},on:{click:function(){t.onSubmit(a.row)}}},1==a.row.status?"生产完成":2==a.row.status?"发货":""),e("Button",{props:{type:"primary",size:"small"},style:{marginRight:"5px",display:2==a.row.status?"":"none"},on:{click:function(){t.show(a.row,"edit")}}},"发货单")])}}],tableData:[],pageination:{page:1,pageSize:2,count:1},page:1,searchValidate:{number:"",status:0,startOrderDate:"",endOrderDate:"",clientName:"",time:[]},selectIds:[],showSend:!1}},created:function(){this.getData()},methods:{onSubmit:function(t){switch(t.status){case 1:this.complete(t);break;case 2:console.log(1111),this.$refs.Drawer.getInfo(t.id,!0);break;default:this.$refs.Drawer.getInfo(t.id);break}},complete:function(t){var e=this;this.$Modal.confirm({title:"提示",content:"<p>确定该订单已生产完成吗？</p>",onOk:function(){Object(s["c"])({id:t.id}).then((function(t){0===t.ret?(e.$Message.success("提交成功"),e.getData()):e.$Message.error(t.msg)}))},onCancel:function(){}})},deliver:function(t){},selectItem:function(t){var e=this;this.selectIds=[],t.forEach((function(t){e.selectIds.push(t.id)}))},delBetch:function(){this.selectIds.length<1?this.$Message.error("请选择要操作的数据"):this.del(this.selectIds)},del:function(t){var e=this;console.log(1111),this.$Modal.confirm({title:"删除",content:"<p>确定删除该产品？</p>",onOk:function(){productDel({id:t}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getData()):e.$Message.error(t.msg)}))},onCancel:function(){}})},search:function(){this.page=1,this.getData()},clear:function(t){this.page=1,this.searchValidate.number="",this.searchValidate.clientName="",this.searchValidate.status=0,this.searchValidate.startOrderDate="",this.searchValidate.endOrderDate="",this.searchValidate.time=[],this.getData()},getData:function(){var t=this;this.loading=!0,this.selectIds=[],Object(s["e"])(d({page:this.page},this.searchValidate,{type:1})).then((function(e){t.loading=!1,0===e.ret?(console.log("成功"),t.tableData=e.data.list,t.pageination=e.data.pageInfo):t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getData()},show:function(t,e){"add"===e?this.$refs.Drawer.getInfo(""):"edit"===e&&this.$refs.Drawer.getInfo(t.id)},handleChangeTime:function(t){this.searchValidate.startOrderDate=t[0]||"",this.searchValidate.endOrderDate=t[1]||""}}},h=u,f=(a("6e86"),a("2877")),m=Object(f["a"])(h,n,i,!1,null,"33915184",null);e["default"]=m.exports},"6d61":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",[a("div",[t._l(t.children,(function(e,n){return[e.btnIsTable?t._e():a("Button",{key:n,class:e.btnClass,attrs:{icon:"md-add",type:e.btnType?e.btnType:"default"},on:{click:function(a){return t.handleEvent(e.btnHandle,e.btnHandleParmas)}}},[t._v(t._s(e.btnTitle))])]})),a("div",{staticClass:"ivu-mt"},[a("Alert",[a("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),a("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),a("div",[a("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect}})],1),a("div",{staticClass:"ivu-mt ivu-text-center"},[a("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)],2)]),a("addWarehouse",{ref:"addWarehouse",on:{hideModal:function(e){e&&t.getData()}}})],1)},i=[],r=(a("ac6a"),a("915b")),o=a("2f08"),s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:0==t.formValidate.houseId?"新增仓库":"编辑仓库"},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formValidate",attrs:{model:t.formValidate,rules:t.ruleValidate,"label-width":100}},[a("FormItem",{attrs:{label:"仓库名称",prop:"name"}},[a("Input",{attrs:{placeholder:"请输入仓库名称"},model:{value:t.formValidate.name,callback:function(e){t.$set(t.formValidate,"name",e)},expression:"formValidate.name"}})],1),a("FormItem",{attrs:{label:"仓库编号",prop:"number"}},[a("Input",{attrs:{placeholder:"请输入仓库编号"},model:{value:t.formValidate.number,callback:function(e){t.$set(t.formValidate,"number",e)},expression:"formValidate.number"}})],1),a("FormItem",{attrs:{label:"仓库保管员",prop:"keeper"}},[a("Input",{attrs:{placeholder:"请输入仓库保管员"},model:{value:t.formValidate.keeper,callback:function(e){t.$set(t.formValidate,"keeper",e)},expression:"formValidate.keeper"}})],1),a("FormItem",{attrs:{label:"仓库地址",prop:"address"}},[a("Input",{attrs:{placeholder:"请输入仓库地址"},model:{value:t.formValidate.address,callback:function(e){t.$set(t.formValidate,"address",e)},expression:"formValidate.address"}})],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.loading},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)],1)],1)},l=[],c=(a("7f7f"),a("9411")),d={name:"addWarehouse",props:{modal:{type:Boolean,default:!1}},components:{iCopyright:o["a"]},data:function(){return{formValidate:{id:0,name:"",address:"",keeper:"",number:""},ruleValidate:{name:[{required:!0,message:"请输入仓库名称",trigger:"blur"}]},indeterminate:!1,checkAll:!1,campusList:[],showModal:!1,loading:!1}},computed:{},watch:{},methods:{loadData:function(t,e){this.showModal=!0,"add"===e?(this.formValidate={id:0,name:"",address:"",keeper:"",number:""},this.checkAll=!1):this.formValidate=t},handleCheckAll:function(){var t=this;this.indeterminate?this.checkAll=!1:this.checkAll=!this.checkAll,this.indeterminate=!1,this.checkAll?(this.formValidate.cacampusIdsmpus=[],this.campusList.forEach((function(e){t.formValidate.campusIds.push(e.sectionId+"")}))):this.formValidate.campusIds=[]},checkAllGroupChange:function(t){t.length===this.campusList.length?(this.indeterminate=!1,this.checkAll=!0):t.length>0?(this.indeterminate=!0,this.checkAll=!1):(this.indeterminate=!1,this.checkAll=!1)},handleReset:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1];this.$refs[t].resetFields(),this.showModal=!1,this.loading=!1,this.$emit("hideModal",e)},handleSubmit:function(t){var e=this;this.loading=!0,this.$refs[t].validate((function(a){a?Object(r["c"])(e.formValidate).then((function(a){e.$Message.success("保存成功"),e.handleReset(t,!0)})).catch((function(){e.loading=!1})):(e.loading=!1,e.$Message.error("请将信息填写完整"))}))},getCampusList:function(){var t=this;Object(c["C"])({}).then((function(e){t.campusList=e.data.list}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},u=d,h=(a("2887"),a("2877")),f=Object(h["a"])(u,s,l,!1,null,"6097f811",null),m=f.exports,p=m,g={name:"erpIndexPage",components:{iCopyright:o["a"],addWarehouse:p},data:function(){var t=this;return{children:[{btnTitle:"新建",btnClass:"",btnType:"primary",btnHandle:"addShow",btnHandleParams:"",btnIsTable:!1},{btnTitle:"批量删除",btnClass:"ivu-ml-8",btnType:"",btnHandle:"handleDel",btnHandleParams:"",btnIsTable:!1},{btnTitle:"编辑",btnClass:"",btnType:"primary",btnHandle:"editInfo",btnHandleParams:"",btnIsTable:!0},{btnTitle:"删除",btnClass:"",btnType:"error",btnHandle:"handleDelOne",btnHandleParams:"",btnIsTable:!0}],modal:!1,columns:[{type:"selection",minWidth:50},{title:"名称",key:"name",minWidth:100},{title:"编号",key:"number",minWidth:100},{title:"保管员",key:"keeper",minWidth:100},{title:"地址",key:"address",minWidth:100},{title:"操作",key:"action",minWidth:120,render:function(e,a){var n=[];return t.children.forEach((function(i){i.btnIsTable&&n.push(e("Button",{props:{size:"small",type:i.btnType},style:{marginRight:"10px"},on:{click:function(){t.handleEvent(i.btnHandle,a.row)}}},i.btnTitle))})),e("div",n)}}],data:[],searchValidate:{name:"",type:0},selectedArr:[],loading:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0}}},computed:{},watch:{},methods:{editInfo:function(t){console.log(t);var e=JSON.parse(JSON.stringify(t));this.$refs.addWarehouse.loadData(e,"edit")},addShow:function(){this.modal=!0,this.$refs.addWarehouse.loadData({},"add")},resetSearch:function(){this.searchValidate={name:"",type:0},this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},getData:function(){var t=this;this.loading=!0,this.data=[],this.selectedArr=[],Object(r["b"])({page:this.pageInfo.page,pageSize:this.pageInfo.pageSize}).then((function(e){t.loading=!1,t.data=e.data.list,t.pageInfo=e.data.pageInfo,t.selectedArr=[]}))},changeSelect:function(t){var e=this;this.selectedArr=[],console.log(t),t.forEach((function(t){e.selectedArr.push(t.id)}))},changePage:function(t){this.pageInfo.page=t,this.getData()},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleDel:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.selectedArr;0!==e.length?this.$Modal.confirm({title:"提示",content:"<p>确认删除</p>",onOk:function(){Object(r["a"])({houseIds:e}).then((function(e){t.$Message.success("删除成功");var a=t.pageInfo.page;if(a===t.pageInfo.pageSum){var n=t.pageInfo.pageSize,i=t.pageInfo.count,r=i-n*(a-1);r===t.selectedArr.length&&(a=1===a?1:a-1)}t.changePage(a)}))},onCancel:function(){}}):this.$Message.error("请选择仓库")},handleDelOne:function(t){var e=[];e.push(t.id),this.handleDel(e)},handleEvent:function(t,e){this.$emit(t,e)}},mounted:function(){this.resetSearch()},beforeDestroy:function(){},created:function(){var t=this;this.children.forEach((function(e){t.$on(e.btnHandle,t[e.btnHandle])}))}},b=g,y=(a("5ad4"),Object(h["a"])(b,n,i,!1,null,"2783eaf7",null));e["default"]=y.exports},"6e86":function(t,e,a){"use strict";var n=a("57c7"),i=a.n(n);i.a},"7c49":function(t,e,a){},"83a1":function(t,e){t.exports=Object.is||function(t,e){return t===e?0!==t||1/t===1/e:t!=t&&e!=e}},"914d":function(t,e,a){"use strict";var n=a("23f1"),i=a.n(n);i.a},"915b":function(t,e,a){"use strict";a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return o})),a.d(e,"r",(function(){return s})),a.d(e,"s",(function(){return l})),a.d(e,"i",(function(){return c})),a.d(e,"f",(function(){return d})),a.d(e,"h",(function(){return u})),a.d(e,"g",(function(){return h})),a.d(e,"l",(function(){return f})),a.d(e,"j",(function(){return m})),a.d(e,"k",(function(){return p})),a.d(e,"o",(function(){return g})),a.d(e,"m",(function(){return b})),a.d(e,"n",(function(){return y})),a.d(e,"t",(function(){return v})),a.d(e,"u",(function(){return w})),a.d(e,"q",(function(){return O})),a.d(e,"d",(function(){return k})),a.d(e,"p",(function(){return I})),a.d(e,"e",(function(){return j}));var n=a("b6bd");function i(t){return Object(n["a"])({url:"/purchase/ware-house/list",method:"post",data:t})}function r(t){return Object(n["a"])({url:"/purchase/ware-house/save",method:"post",data:t})}function o(t){return Object(n["a"])({url:"/purchase/ware-house/del",method:"post",data:t})}function s(t){return Object(n["a"])({url:"/purchase/stock/goods-list",method:"post",data:t})}function l(t){return Object(n["a"])({url:"/purchase/stock/stock-goods-detail",method:"post",data:t})}function c(t){return Object(n["a"])({url:"/purchase/goods/list-category",method:"post",data:t})}function d(t){return Object(n["a"])({url:"/purchase/goods/add-category",method:"post",data:t})}function u(t){return Object(n["a"])({url:"/purchase/goods/edit-category",method:"post",data:t})}function h(t){return Object(n["a"])({url:"/purchase/goods/del-category",method:"post",data:t})}function f(t){return Object(n["a"])({url:"/purchase/goods/list-goods",method:"post",data:t})}function m(t){return Object(n["a"])({url:"/purchase/goods/add-goods",method:"post",data:t})}function p(t){return Object(n["a"])({url:"/purchase/goods/del-goods",method:"post",data:t})}function g(t){return Object(n["a"])({url:"/purchase/stock-manage/list",method:"post",data:t})}function b(t){return Object(n["a"])({url:"/purchase/stock-manage/add",method:"post",data:t})}function y(t){return Object(n["a"])({url:"/purchase/stock-manage/detail",method:"post",data:t})}function v(t){return Object(n["a"])({url:"/purchase/stock-manage/list-query",method:"post",data:t})}function w(t){return Object(n["a"])({url:"/purchase/stock-manage/stock-statistics",method:"post",data:t})}function O(t){return Object(n["a"])({url:"/purchase/stock-manage/del",method:"post",data:t})}var k="/purchase/goods/export-goods",I="/purchase/goods/import-goods",j="/upload/template/goods.xls"},a14d:function(t,e,a){"use strict";var n=a("dd2b"),i=a.n(n);i.a},b627:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:t.isSend?"发货":"订单详情",width:800},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Form",{ref:"formValidate",attrs:{model:t.formValidate,rules:t.ruleValidate,"label-width":90}},[t.isSend?a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("发货信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货时间",prop:"sendDate"}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"date",placeholder:"请选择发货时间",value:t.formValidate.sendDate,format:"yyyy-MM-dd"},on:{"on-change":t.changeData}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货方式",prop:"sendWay"}},[a("Input",{attrs:{placeholder:"请输入发货方式"},model:{value:t.formValidate.sendWay,callback:function(e){t.$set(t.formValidate,"sendWay",e)},expression:"formValidate.sendWay"}})],1)],1)],1):t._e(),t.formValidate.id?a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("订单信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单编号：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.number)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"状态：",prop:"clientId"}},[t._v("\n            "+t._s(t.statusName)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单客户：",prop:"clientId"}},[t._v("\n            "+t._s(t.clientName)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"合同编号：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.contractCode)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单金额：",prop:"totalPrice"}},[t._v("\n            "+t._s(t.formValidate.totalPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"已付金额：",prop:"receiptPrice"}},[t._v("\n            "+t._s(t.formValidate.receiptPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"交货日期：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.deliveryDate)+"\n          ")])],1),3==t.formValidate.status?a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货日期：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.sendDate)+"\n          ")])],1):t._e()],1):t._e(),a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("产品信息\n        ")]),a("Col",{attrs:{xs:24,md:24,lg:24}},[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formValidate.detailList,border:"","show-summary":"","min-height":"200"}})],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),t.isSend?a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")]):t._e()],1)],1),a("chooseMateriel",{ref:"chooseMateriel",attrs:{houseId:t.formValidate.houseId},on:{handleChoose:t.handleChoose}})],1)},i=[],r=(a("8e6e"),a("456d"),a("ac6a"),a("bd86")),o=(a("7f7f"),a("c276"),a("f8b7")),s=a("2f08"),l=a("d9e1"),c=(a("2f62"),a("0658"));function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var h={name:"addIandeBank",props:{modal:{type:Boolean}},components:{iCopyright:s["a"],chooseMateriel:l["a"]},data:function(){return{formValidate:{status:1},ruleValidate:{sendDate:[{required:!0,message:"请选择发货时间",trigger:"blur"}],sendWay:[{required:!0,message:"请填写发货方式",trigger:"blur"}]},showModal:!1,columns:[{title:"名称",key:"goodsName",minWidth:100},{title:"单位",key:"unit",minWidth:50},{title:"数量",minWidth:100,align:"center",key:"num"}],loading:!0,isSubmit:!1,goodsType:"",clientList:[],isSend:!1}},computed:{clientName:function(){return this.clientList[this.formValidate.clientId]||""},statusName:function(){switch(this.formValidate.status+""){case"1":return"生产中";case"2":return"生产完成";case"3":return"已发货";case"4":return"已完成";default:return""}}},methods:{handleReset:function(t){this.$refs[t].resetFields(),this.showModal=!1,this.loading=!1,this.isSubmit=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;this.isSubmit||(this.isSubmit=!0,this.$refs[t].validate((function(a){if(a){if(e.formValidate.detailList.length<1)return e.isSubmit=!1,void e.$Message.error("请选择产品");Object(o["g"])(u({},e.formValidate)).then((function(a){e.$Message.success("保存成功"),e.handleReset(t),e.$emit("handleSubmit")})).catch((function(){e.isSubmit=!1}))}else e.isSubmit=!1})))},handleChoose:function(t){var e=this,a=this.formValidate.detailList,n=[];a.forEach((function(t){n.push(t.goodsId+"")})),t.forEach((function(t){var i={};-1===n.indexOf(t.id+"")&&(i.num=1,i.id=0,i.goodsId=t.id,i.goodsName=t.name,i.orderId=e.formValidate.id,a.push(i))})),this.formValidate.detailList=a},delGoods:function(t){this.formValidate.detailList.splice(t,1)},getInfo:function(t){var e=this,a=arguments.length>1&&void 0!==arguments[1]&&arguments[1];this.isSend=a,console.log(t),this.showModal=!0,this.loading=!0,Object(o["d"])({id:t}).then((function(t){0===t.ret&&(e.formValidate=t.data.info,e.formValidate.clientId=e.formValidate.clientId+"",e.formValidate.sendDate="",e.formValidate.sendWay="",e.loading=!1)}))},changeData:function(t){this.formValidate.sendDate=t},getClientList:function(){var t=this;Object(c["j"])().then((function(e){t.clientList=e.data.select}))}},mounted:function(){console.log(this.user),this.getClientList()},beforeDestroy:function(){},created:function(){}},f=h,m=(a("914d"),a("2877")),p=Object(m["a"])(f,n,i,!1,null,"8a993d8a",null);e["a"]=p.exports},c4c8:function(t,e,a){"use strict";a.d(e,"c",(function(){return s})),a.d(e,"b",(function(){return l})),a.d(e,"d",(function(){return c})),a.d(e,"a",(function(){return d}));var n=a("c276"),i=a("b6bd"),r=n["a"].cookies.get("token"),o=a("4328");function s(t){return Object(i["a"])({url:"/goods/manage/list?token="+r,method:"post",data:o.stringify(t)})}function l(t){return Object(i["a"])({url:"/goods/manage/info?token="+r,method:"post",data:t})}function c(t){return Object(i["a"])({url:"/goods/manage/save?token="+r,method:"post",data:t})}function d(t){return Object(i["a"])({url:"/goods/manage/del?token="+r,method:"post",data:t})}},d9e1:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:"选择"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("div",{staticClass:"choose-class",class:t.isMobile?"":"wrapper"},[a("Card",{class:t.isMobile?"":"right-content"},[a("Form",{ref:"formCustom",attrs:{"label-width":100}},[a("Row",{staticStyle:{"margin-bottom":"16px"},attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Input",{staticStyle:{width:"95%"},attrs:{type:"text",placeholder:"请输入"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品")+"名称",clearabl:""},model:{value:t.searchValidate.name,callback:function(e){t.$set(t.searchValidate,"name",e)},expression:"searchValidate.name"}})],1),a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("查询")]),a("Button",{staticClass:"ivu-ml-8",on:{click:t.resetSearch}},[t._v("重置")]),t.showMore||1!=t.type||t.isFinished?t._e():a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              展开\n              "),a("Icon",{attrs:{type:"ios-arrow-down"}})],1),t.showMore?a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              收起\n              "),a("Icon",{attrs:{type:"ios-arrow-up"}})],1):t._e()],1)],1),t.showMore?a("Row",{attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[a("RadioGroup",{model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:2}},[t._v("半成品")]),a("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1)],1):t._e()],1),a("div",[a("div",[a("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect}})],1),a("div",{staticClass:"ivu-mt ivu-text-center"},[a("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)])],1),t.isMobile?t._e():a("Card",{staticClass:"left-content"},[a("div",{staticClass:"ivu-mt",attrs:{slot:"title"},slot:"title"},[a("Alert",[a("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),a("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),a("List",{attrs:{border:""}},[a("Scroll",{staticStyle:{flex:"1"},attrs:{height:415}},t._l(t.selectedArr,(function(e,n){return a("ListItem",{key:n},[a("ListItemMeta",{attrs:{avatar:"",title:e.name,description:""}}),a("template",{slot:"action"},[a("li",{on:{click:function(e){return t.delClass(n)}}},[a("Icon",{attrs:{type:"md-close-circle",size:"19"}})],1)])],2)})),1)],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)])},i=[],r=(a("8e6e"),a("456d"),a("386d"),a("ac6a"),a("bd86")),o=a("c4c8"),s=a("2f08"),l=a("2f62"),c=a("9411");function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var h={name:"chooseMateriel",components:{iCopyright:s["a"]},props:{modal:{type:Boolean,default:!1},selected:{type:Array,default:function(){return[]}}},data:function(){return{columns:[{type:"selection",minWidth:50},{title:"名称",minWidth:100,key:"name"},{title:"单位",key:"unit",minWidth:100},{title:"库存",key:"stock",minWidth:100}],data:[],searchValidate:{name:"",isFinished:0,type:""},showModal:!1,selectedArr:[],showMore:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0},type:"",isFinished:"",loading:!0,groupId:"",isSubmit:!1}},computed:u({},Object(l["e"])("admin/layout",["isMobile"])),watch:{},methods:{changeSelect:function(t){var e=this;this.selectedArr=[],t.forEach((function(t){e.selectedArr.push(t)}))},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleReset:function(t){this.showModal=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;if(this.groupId){if(this.isSubmit)return;this.isSubmit=!0;var a=this.selectedArr.map((function(t){return t.id}));Object(c["t"])({groupId:this.groupId,goodsId:a.join(",")}).then((function(t){console.log(222222),e.$Message.success("保存成功"),e.showModal=!1,e.isSubmit=!1})).catch((function(t){e.isSubmit=!1}))}else this.showModal=!1,this.$emit("handleChoose",this.selectedArr)},delClass:function(t){var e=this,a="";this.data.some((function(n,i){n.id===e.selectedArr[t].id&&(a=i)})),this.$refs.tableData.toggleSelect(a)},resetSearch:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.searchValidate={name:"",isFinished:this.isFinished,type:this.type},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},changePage:function(t){this.pageInfo.page=t,this.getData()},getData:function(){var t=this;this.data=[],this.loading=!0,Object(o["c"])(u({},this.pageInfo,{},this.searchValidate)).then((function(e){var a=[];t.data=e.data.list.map((function(e){return a=t.selectedArr.filter((function(t){return t.id==e.id})),e._checked=a.length>0,e})),console.log(t.data),t.pageInfo=e.data.pageInfo,t.loading=!1})).catch((function(e){t.loading=!1}))},loadData:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2,a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";console.log(111111111111),2==e?(this.isFinished="",this.type=2):(this.isFinished=t||0,this.type=1),this.searchValidate.isFinished=this.isFinished,this.searchValidate.type=this.type,this.searchValidate.name="",this.showModal=!0,this.loading=!0,this.selectedArr=[],this.groupId=a,a?this.getGroupGoods():this.search()},getGroupGoods:function(){var t=this;Object(c["s"])({groupId:this.groupId}).then((function(e){console.log(222222),console.log(e.data.list),t.selectedArr=e.data.list,t.search()})).catch((function(e){t.loading=!1}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},f=h,m=(a("a14d"),a("2877")),p=Object(m["a"])(f,n,i,!1,null,"f9c16154",null);e["a"]=p.exports},dd2b:function(t,e,a){},f8b7:function(t,e,a){"use strict";a.d(e,"e",(function(){return s})),a.d(e,"d",(function(){return l})),a.d(e,"f",(function(){return c})),a.d(e,"c",(function(){return d})),a.d(e,"g",(function(){return u})),a.d(e,"b",(function(){return h})),a.d(e,"a",(function(){return f}));var n=a("c276"),i=a("b6bd"),r=n["a"].cookies.get("token"),o=a("4328");function s(t){return Object(i["a"])({url:"/sales/manage/list?token="+r,method:"post",data:o.stringify(t)})}function l(t){return Object(i["a"])({url:"/sales/manage/info?token="+r,method:"post",data:t})}function c(t){return Object(i["a"])({url:"/sales/manage/save?token="+r,method:"post",data:t})}function d(t){return Object(i["a"])({url:"/sales/manage/pro-complete?token="+r,method:"post",data:t})}function u(t){return Object(i["a"])({url:"/sales/manage/send?token="+r,method:"post",data:t})}function h(t){return Object(i["a"])({url:"/sales/manage/goods-list",method:"post",data:t})}function f(t){return Object(i["a"])({url:"/sales/manage/client-order",method:"post",data:t})}}}]);