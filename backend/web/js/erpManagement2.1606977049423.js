(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement2","erpManagement3"],{"0658":function(t,e,a){"use strict";a.d(e,"i",(function(){return r})),a.d(e,"a",(function(){return o})),a.d(e,"v",(function(){return l})),a.d(e,"f",(function(){return s})),a.d(e,"d",(function(){return c})),a.d(e,"l",(function(){return d})),a.d(e,"c",(function(){return u})),a.d(e,"h",(function(){return f})),a.d(e,"g",(function(){return m})),a.d(e,"b",(function(){return h})),a.d(e,"e",(function(){return p})),a.d(e,"k",(function(){return g})),a.d(e,"j",(function(){return b})),a.d(e,"q",(function(){return y})),a.d(e,"p",(function(){return v})),a.d(e,"w",(function(){return w})),a.d(e,"o",(function(){return O})),a.d(e,"n",(function(){return D})),a.d(e,"s",(function(){return k})),a.d(e,"u",(function(){return _})),a.d(e,"r",(function(){return j})),a.d(e,"t",(function(){return x})),a.d(e,"m",(function(){return V}));var i=a("b6bd"),n=a("4328");function r(t){return Object(i["a"])({url:"/client/client/client_list",method:"post",data:n.stringify(t)})}function o(t){return Object(i["a"])({url:"/client/client/client_add",method:"post",data:n.stringify(t)})}function l(t){return Object(i["a"])({url:"/client/client/client_save",method:"post",data:n.stringify(t)})}function s(t){return Object(i["a"])({url:"/client/client/client_info",method:"post",data:n.stringify(t)})}function c(t){return Object(i["a"])({url:"/client/client/client_person_add",method:"post",data:n.stringify(t)})}function d(t){return Object(i["a"])({url:"/client/client/client_person_list",method:"post",data:n.stringify(t)})}function u(t){return Object(i["a"])({url:"/client/client/client_interview_add",method:"post",data:n.stringify(t)})}function f(t){return Object(i["a"])({url:"/client/client/client_interview_list",method:"post",data:n.stringify(t)})}function m(t){return Object(i["a"])({url:"/client/client/client_interview_info",method:"post",data:n.stringify(t)})}function h(t){return Object(i["a"])({url:"/client/client/client_contract_add",method:"post",data:n.stringify(t)})}function p(t){return Object(i["a"])({url:"/client/client/client_contract_list",method:"post",data:n.stringify(t)})}function g(t){return Object(i["a"])({url:"/client/client/client_shift",method:"post",data:n.stringify(t)})}function b(t){return Object(i["a"])({url:"/client/client/select",method:"post",data:n.stringify(t)})}function y(t){return Object(i["a"])({url:"/client/client/person_select",method:"post",data:n.stringify(t)})}function v(t){return Object(i["a"])({url:"/client/client/client_person_info",method:"post",data:n.stringify(t)})}function w(t){return Object(i["a"])({url:"/client/client/client_person_save",method:"post",data:n.stringify(t)})}function O(t){return Object(i["a"])({url:"/client/client/client_person_del",method:"post",data:n.stringify(t)})}function D(t){return Object(i["a"])({url:"/client/client/client_del",method:"post",data:n.stringify(t)})}var k=function(t){return Object(i["a"])({url:"/project/manage/list",method:"post",data:t})},_=function(t){return Object(i["a"])({url:"/project/manage/save",method:"post",data:t})},j=function(t){return Object(i["a"])({url:"/project/manage/info",method:"post",data:t})},x=function(t){return Object(i["a"])({url:"/project/manage/get-report-user",method:"post",data:t})},V=function(t){return Object(i["a"])({url:"/client/client/list",method:"post",data:t})}},"138e":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{ref:"formData",attrs:{model:t.formData,inline:""}},[a("Row",[a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"产品名称","label-position":"top","label-width":80}},[a("Input",{attrs:{placeholder:"请输入产品名称"},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"类型：","label-position":"top","label-width":80}},[a("RadioGroup",{model:{value:t.formData.isFinished,callback:function(e){t.$set(t.formData,"isFinished",e)},expression:"formData.isFinished"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:2}},[t._v("半成品")]),a("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{attrs:{label:"","label-position":"top","label-width":80}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("formData")}}},[t._v("重置")])],1)],1)],1)],1)],1),a("Card",[a("div",{staticStyle:{display:"flex","margin-bottom":"10px"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"add")}}},[t._v("新增")]),a("Button",{staticStyle:{"margin-left":"5px"},on:{click:t.delBetch}},[t._v("批量删除")])],1),a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.selectItem}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page)},on:{"on-change":t.changePage}})],1)])],1),a("addProduct",{ref:"Drawer",on:{getData:t.getData}}),a("productMateriel",{ref:"productMateriel"})],1)},n=[],r=(a("8e6e"),a("456d"),a("bd86")),o=(a("ac6a"),a("7f7f"),a("e1e1")),l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"关联"+(1==t.formData.isFinished?"半成品":"物料"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Row",[a("Col",[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formData.materialList,border:"","show-summary":"","min-height":"200"}})],1)],1),a("template",{slot:"footer"},[a("Button",{on:{click:function(e){return t.handleReset("formData")}}},[t._v("关闭")])],1)],2)},s=[],c=a("c4c8"),d={components:{},props:{},data:function(){return{loading:!1,showModal:!1,formData:{materialList:[]},columns:[{title:"名称",key:"name",minWidth:100},{title:"单位",key:"unit",minWidth:50},{title:"所需数量",minWidth:100,key:"num"}]}},computed:{},watch:{},methods:{handleReset:function(t){this.showModal=!1,this.formData.materialList=[]},getInfo:function(t){var e=this;console.log(t),this.showModal=!0,this.loading=!0,Object(c["b"])({id:t}).then((function(t){0===t.ret&&(e.formData=t.data.info,e.loading=!1)}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},u=d,f=(a("cc90"),a("2877")),m=Object(f["a"])(u,l,s,!1,null,"0b297a72",null),h=m.exports;function p(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function g(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?p(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):p(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var b={components:{addProduct:o["a"],productMateriel:h},data:function(){var t=this;return{loading:!0,tableColumns:[{type:"selection",width:60,align:"center"},{title:"产品名称",key:"name",minWidth:100,render:function(e,a){return e("div",[e("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px",width:"100px",height:"20px",display:"block"},on:{click:function(){t.show(a.row,"edit")}}},a.row.name)])}},{title:"产品编号",minWidth:100,key:"number"},{title:"产品类型",key:"isFinished",minWidth:100,render:function(t,e){return t("div",1==e.row.isFinished?"成品":"半成品")}},{title:"单位",minWidth:60,key:"unit"},{title:"数量（库存）",minWidth:100,key:"stock"},{title:"操作",key:"action",minWidth:140,render:function(e,a){return e("div",[e("Button",{props:{size:"small",type:"primary"},style:{marginRight:"5px"},on:{click:function(){t.$refs.productMateriel.getInfo(a.row.id)}}},"物料详情"),e("Button",{props:{type:"error",size:"small"},style:{marginRight:"5px"},on:{click:function(){t.del(a.row.id)}}},"删除")])}}],tableData:[],pageination:{page:1,pageSize:2,count:1},page:1,staffData:[],formData:{name:"",isFinished:0},selectIds:[]}},created:function(){this.getData()},methods:{selectItem:function(t){var e=this;this.selectIds=[],t.forEach((function(t){e.selectIds.push(t.id)}))},delBetch:function(){this.selectIds.length<1?this.$Message.error("请选择要操作的数据"):this.del(this.selectIds)},del:function(t){var e=this;console.log(1111),this.$Modal.confirm({title:"删除",content:"<p>确定删除该产品？</p>",onOk:function(){Object(c["a"])({id:t}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getData()):e.$Message.error(t.msg)}))},onCancel:function(){}})},search:function(){this.page=1,this.getData()},clear:function(t){this.page=1,this.formData.name="",this.formData.isFinished=0,this.getData()},getData:function(){var t=this;this.loading=!0,this.selectIds=[],Object(c["c"])(g({page:this.page},this.formData,{type:1})).then((function(e){t.loading=!1,0===e.ret?(console.log("成功"),t.tableData=e.data.list,t.pageination=e.data.pageInfo):t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getData()},show:function(t,e){"add"===e?this.$refs.Drawer.getInfo(""):"edit"===e&&this.$refs.Drawer.getInfo(t.id)}}},y=b,v=(a("5ff2"),Object(f["a"])(y,i,n,!1,null,"165aefe6",null));e["default"]=v.exports},1589:function(t,e,a){},1758:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{attrs:{inline:""}},[a("Row",[a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单编号","label-position":"top","label-width":80}},[a("Input",{attrs:{placeholder:"请输入订单编号"},model:{value:t.searchValidate.number,callback:function(e){t.$set(t.searchValidate,"number",e)},expression:"searchValidate.number"}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"客户","label-position":"top","label-width":80}},[a("Input",{attrs:{placeholder:"请输入客户名称"},model:{value:t.searchValidate.clientName,callback:function(e){t.$set(t.searchValidate,"clientName",e)},expression:"searchValidate.clientName"}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100px","text-align":"right"},attrs:{"label-width":0}},[t.showMore?t._e():a("div",{on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              更多筛选"),a("Icon",{attrs:{type:"ios-arrow-down"}})],1),t.showMore?a("div",{on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              收起"),a("Icon",{attrs:{type:"ios-arrow-up"}})],1):t._e()]),a("FormItem",{attrs:{label:"","label-position":"top","label-width":0}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("searchValidate")}}},[t._v("重置")])],1)],1)],1),t.showMore?a("Row",[a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"下单时间","label-position":"top","label-width":80}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"daterange","split-panels":"",placement:"bottom-end",placeholder:"请选择时间"},on:{"on-change":t.handleChangeTime},model:{value:t.searchValidate.time,callback:function(e){t.$set(t.searchValidate,"time",e)},expression:"searchValidate.time"}})],1)],1),a("Col",{attrs:{xs:24,sm:24,md:24,lg:16}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单状态","label-position":"top","label-width":80}},[a("RadioGroup",{model:{value:t.searchValidate.status,callback:function(e){t.$set(t.searchValidate,"status",e)},expression:"searchValidate.status"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:1}},[t._v("生产中")]),a("Radio",{attrs:{label:2}},[t._v("生产完成")]),a("Radio",{attrs:{label:3}},[t._v("已发货")]),a("Radio",{attrs:{label:4}},[t._v("已完成")])],1)],1)],1)],1):t._e()],1)],1),a("Card",[a("div",{staticStyle:{display:"flex","margin-bottom":"10px"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"add")}}},[t._v("新增")])],1),a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.selectItem}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page)},on:{"on-change":t.changePage}})],1)])],1),a("addOrder",{ref:"Drawer",on:{handleSubmit:t.getData}}),a("materielDetail",{ref:"materielDetail"})],1)},n=[],r=(a("8e6e"),a("456d"),a("bd86")),o=(a("ac6a"),a("287e")),l=a("f8b7"),s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:t.formValidate.id?"编辑订单":"新增订单",width:800},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Form",{ref:"formValidate",attrs:{model:t.formValidate,rules:t.ruleValidate,"label-width":90}},[t.formValidate.id?a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("订单编号")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"","label-width":0}},[t._v("\n          "+t._s(t.formValidate.number)+"\n          ")])],1)],1):t._e(),a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("订单信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"客户",prop:"clientId"}},[a("Select",{attrs:{clearable:"",filterable:"",placeholder:"请选择客户",disabled:1!=t.formValidate.status},model:{value:t.formValidate.clientId,callback:function(e){t.$set(t.formValidate,"clientId",e)},expression:"formValidate.clientId"}},t._l(t.clientList,(function(e,i){return a("Option",{key:i,attrs:{value:String(i)}},[t._v(t._s(e))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"合同编号",prop:"contractCode"}},[a("Input",{attrs:{placeholder:"请输入合同编号",disabled:1!=t.formValidate.status},model:{value:t.formValidate.contractCode,callback:function(e){t.$set(t.formValidate,"contractCode",e)},expression:"formValidate.contractCode"}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单金额",prop:"totalPrice"}},[a("Input",{attrs:{placeholder:"请输入订单金额",disabled:1!=t.formValidate.status},model:{value:t.formValidate.totalPrice,callback:function(e){t.$set(t.formValidate,"totalPrice",e)},expression:"formValidate.totalPrice"}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"已付金额",prop:"receiptPrice"}},[a("Input",{attrs:{placeholder:"请输入已付金额",disabled:1!=t.formValidate.status},model:{value:t.formValidate.receiptPrice,callback:function(e){t.$set(t.formValidate,"receiptPrice",e)},expression:"formValidate.receiptPrice"}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"交货日期",prop:"deliveryDate"}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"date",placeholder:"请选择交货日期",value:t.formValidate.deliveryDate,format:"yyyy-MM-dd",disabled:1!=t.formValidate.status},on:{"on-change":t.changeData}})],1)],1)],1),a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("产品信息\n          "),1==t.formValidate.status?a("div",{staticClass:"choose",on:{click:function(e){return t.$refs.chooseMateriel.loadData(1,1)}}},[a("a",[t._v("选择产品···")])]):t._e()]),a("Col",{attrs:{xs:24,md:24,lg:24}},[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formValidate.detailList,border:"","show-summary":"","min-height":"200"}})],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),1==t.formValidate.status?a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")]):t._e()],1)],1),a("chooseMateriel",{ref:"chooseMateriel",attrs:{houseId:t.formValidate.houseId},on:{handleChoose:t.handleChoose}})],1)},c=[],d=(a("7f7f"),a("c5f6"),a("c276"),a("2f08")),u=a("d9e1"),f=(a("2f62"),a("0658"));function m(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function h(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?m(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):m(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var p={name:"addIandeBank",props:{modal:{type:Boolean}},components:{iCopyright:d["a"],chooseMateriel:u["a"]},data:function(){var t=this;this.$createElement;return{formValidate:{status:1},ruleValidate:{deliveryDate:[{required:!0,message:"请选择交货日期",trigger:"blur"}],contractCode:[{required:!0,message:"请填写合同编号",trigger:"blur"}],totalPrice:[{required:!0,message:"请填写订单金额",trigger:"blur"}],receiptPrice:[{required:!0,message:"请填写已付金额",trigger:"blur"}],clientId:[{required:!0,message:"请选择客户",trigger:"blur"}]},showModal:!1,columns:[{title:"名称",key:"goodsName",minWidth:100},{title:"单位",key:"unit",minWidth:50},{title:"数量",minWidth:100,align:"center",key:"num",render:function(e,a){return e("Input",{props:{size:"small",value:a.row.num,type:"number",min:0,disabled:1!=t.formValidate.status},on:{"on-blur":function(e){var i=Number(e.target.value);i<1&&(i=1),e.target.value=i,a.row.num=i,t.formValidate.detailList[a.index]=a.row}}})}},{title:"操作",key:"action",minWidth:80,align:"center",render:function(e,a){return e("Icon",{attrs:{type:"md-close-circle",size:"19",title:"删除"},on:{click:function(){1==t.formValidate.status&&t.delGoods(a.index)}}})}}],loading:!0,isSubmit:!1,goodsType:"",clientList:[]}},computed:{},methods:{handleReset:function(t){this.$refs[t].resetFields(),this.showModal=!1,this.loading=!1,this.isSubmit=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;this.isSubmit||(this.isSubmit=!0,this.$refs[t].validate((function(a){if(a){if(e.formValidate.detailList.length<1)return e.isSubmit=!1,void e.$Message.error("请选择产品");Object(l["f"])(h({},e.formValidate)).then((function(a){e.$Message.success("保存成功"),e.handleReset(t),e.$emit("handleSubmit")})).catch((function(){e.isSubmit=!1}))}else e.isSubmit=!1})))},handleChoose:function(t){var e=this,a=this.formValidate.detailList,i=[];a.forEach((function(t){i.push(t.goodsId+"")})),t.forEach((function(t){var n={};-1===i.indexOf(t.id+"")&&(n.num=1,n.id=0,n.goodsId=t.id,n.goodsName=t.name,n.orderId=e.formValidate.id,n.unit=t.unit,a.push(n))})),this.formValidate.detailList=a},delGoods:function(t){this.formValidate.detailList.splice(t,1)},getInfo:function(t){var e=this;if(console.log(t),this.showModal=!0,!t)return this.formValidate={id:"",number:"",contractCode:"",totalPrice:"",receiptPrice:"",deliveryDate:"",sendDate:"",detailList:[],clientId:"",status:1},void(this.loading=!1);this.loading=!0,Object(l["d"])({id:t}).then((function(t){0===t.ret&&(e.formValidate=t.data.info,e.formValidate.clientId=e.formValidate.clientId+"",e.loading=!1)}))},changeData:function(t){this.formValidate.deliveryDate=t},getClientList:function(){var t=this;Object(f["j"])().then((function(e){t.clientList=e.data.select}))}},mounted:function(){console.log(this.user),this.getClientList()},beforeDestroy:function(){},created:function(){}},g=p,b=(a("4375"),a("2877")),y=Object(b["a"])(g,s,c,!1,null,"e4a6b496",null),v=y.exports;function w(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function O(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?w(a,!0).forEach((function(e){Object(r["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):w(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var D={components:{addOrder:v,materielDetail:o["a"]},data:function(){var t=this;return{loading:!0,tableColumns:[{title:"订单编号",key:"number",minWidth:100,render:function(e,a){return e("a",{props:{type:"primary",size:"small"},style:{minWidth:"90px",display:"block",wordBreak:"break-all",paddingRight:"5px"},on:{click:function(){t.show(a.row,"edit")}}},a.row.number)}},{title:"客户名称",minWidth:100,key:"clientName"},{title:"总金额",minWidth:100,key:"totalPrice"},{title:"已付金额",minWidth:100,key:"receiptPrice"},{title:"状态",key:"statusName",minWidth:60},{title:"下单日期",minWidth:100,key:"orderDate"},{title:"发货日期",minWidth:100,key:"sendDate"},{title:"交货日期",minWidth:100,key:"deliveryDate"},{title:"操作",key:"action",minWidth:140,render:function(e,a){return e("div",[e("Button",{props:{size:"small",type:"primary"},style:{marginRight:"5px"},on:{click:function(){t.$refs.materielDetail.getInfo(a.row.id)}}},"物料详情")])}}],tableData:[],pageination:{page:1,pageSize:2,count:1},page:1,searchValidate:{number:"",status:0,startOrderDate:"",endOrderDate:"",clientName:"",time:[]},selectIds:[],showMore:!1}},created:function(){this.getData()},methods:{selectItem:function(t){var e=this;this.selectIds=[],t.forEach((function(t){e.selectIds.push(t.id)}))},delBetch:function(){this.selectIds.length<1?this.$Message.error("请选择要操作的数据"):this.del(this.selectIds)},del:function(t){var e=this;console.log(1111),this.$Modal.confirm({title:"删除",content:"<p>确定删除该产品？</p>",onOk:function(){productDel({id:t}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getData()):e.$Message.error(t.msg)}))},onCancel:function(){}})},search:function(){this.page=1,this.getData()},clear:function(t){this.page=1,this.searchValidate.number="",this.searchValidate.clientName="",this.searchValidate.status=0,this.searchValidate.startOrderDate="",this.searchValidate.endOrderDate="",this.searchValidate.time=[],this.getData()},getData:function(){var t=this;this.loading=!0,this.selectIds=[],Object(l["e"])(O({page:this.page},this.searchValidate,{type:1})).then((function(e){t.loading=!1,0===e.ret?(console.log("成功"),t.tableData=e.data.list,t.pageination=e.data.pageInfo):t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getData()},show:function(t,e){console.log(t),"add"===e?this.$refs.Drawer.getInfo(""):"edit"===e&&this.$refs.Drawer.getInfo(t.id)},handleChangeTime:function(t){this.searchValidate.startOrderDate=t[0]||"",this.searchValidate.endOrderDate=t[1]||""}}},k=D,_=(a("51fc"),Object(b["a"])(k,i,n,!1,null,"645cf795",null));e["default"]=_.exports},"1dfb":function(t,e,a){},"287e":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"物料详情",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Row",[a("Col",[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formData,border:"","show-summary":"","min-height":"200"}})],1)],1),a("template",{slot:"footer"},[a("Button",{on:{click:function(e){return t.handleReset("formData")}}},[t._v("关闭")])],1)],2)},n=[],r=a("f8b7"),o={components:{},props:{},data:function(){return{loading:!1,showModal:!1,formData:[],columns:[{title:"编号",key:"number",minWidth:100},{title:"名称",key:"name",minWidth:100},{title:"所需数量",minWidth:100,key:"count"},{title:"单位",key:"unit",minWidth:50},{title:"体积",key:"volume",minWidth:50},{title:"重量",key:"weight",minWidth:50}]}},computed:{},watch:{},methods:{handleReset:function(t){this.showModal=!1,this.formData=[]},getInfo:function(t){var e=this;console.log(t),this.showModal=!0,this.loading=!0,Object(r["b"])({id:t}).then((function(t){0===t.ret&&(e.formData=t.data.list,e.loading=!1)}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},l=o,s=(a("6839"),a("2877")),c=Object(s["a"])(l,i,n,!1,null,"3699aebb",null);e["a"]=c.exports},4375:function(t,e,a){"use strict";var i=a("6a75"),n=a.n(i);n.a},"51fc":function(t,e,a){"use strict";var i=a("8253"),n=a.n(i);n.a},"5ff2":function(t,e,a){"use strict";var i=a("1dfb"),n=a.n(i);n.a},"66f9":function(t,e,a){},6839:function(t,e,a){"use strict";var i=a("66f9"),n=a.n(i);n.a},"6a75":function(t,e,a){},8253:function(t,e,a){},cc90:function(t,e,a){"use strict";var i=a("1589"),n=a.n(i);n.a},f8b7:function(t,e,a){"use strict";a.d(e,"e",(function(){return l})),a.d(e,"d",(function(){return s})),a.d(e,"f",(function(){return c})),a.d(e,"c",(function(){return d})),a.d(e,"g",(function(){return u})),a.d(e,"b",(function(){return f})),a.d(e,"a",(function(){return m})),a.d(e,"h",(function(){return h}));var i=a("c276"),n=a("b6bd"),r=i["a"].cookies.get("token"),o=a("4328");function l(t){return Object(n["a"])({url:"/sales/manage/list?token="+r,method:"post",data:o.stringify(t)})}function s(t){return Object(n["a"])({url:"/sales/manage/info?token="+r,method:"post",data:t})}function c(t){return Object(n["a"])({url:"/sales/manage/save?token="+r,method:"post",data:t})}function d(t){return Object(n["a"])({url:"/sales/manage/pro-complete?token="+r,method:"post",data:t})}function u(t){return Object(n["a"])({url:"/sales/manage/send?token="+r,method:"post",data:t})}function f(t){return Object(n["a"])({url:"/sales/manage/goods-list",method:"post",data:t})}function m(t){return Object(n["a"])({url:"/sales/manage/client-order",method:"post",data:t})}function h(t){return Object(n["a"])({url:"/sales/manage/print-data",method:"post",data:t})}}}]);