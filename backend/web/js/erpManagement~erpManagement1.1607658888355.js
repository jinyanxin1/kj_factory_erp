(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["erpManagement~erpManagement1"],{"0658":function(t,e,a){"use strict";a.d(e,"i",(function(){return o})),a.d(e,"a",(function(){return i})),a.d(e,"v",(function(){return s})),a.d(e,"f",(function(){return l})),a.d(e,"d",(function(){return c})),a.d(e,"l",(function(){return d})),a.d(e,"c",(function(){return u})),a.d(e,"h",(function(){return m})),a.d(e,"g",(function(){return f})),a.d(e,"b",(function(){return p})),a.d(e,"e",(function(){return h})),a.d(e,"k",(function(){return g})),a.d(e,"j",(function(){return b})),a.d(e,"q",(function(){return y})),a.d(e,"p",(function(){return v})),a.d(e,"w",(function(){return I})),a.d(e,"o",(function(){return D})),a.d(e,"n",(function(){return _})),a.d(e,"s",(function(){return O})),a.d(e,"u",(function(){return w})),a.d(e,"r",(function(){return x})),a.d(e,"t",(function(){return k})),a.d(e,"m",(function(){return j}));var n=a("b6bd"),r=a("4328");function o(t){return Object(n["a"])({url:"/client/client/client_list",method:"post",data:r.stringify(t)})}function i(t){return Object(n["a"])({url:"/client/client/client_add",method:"post",data:r.stringify(t)})}function s(t){return Object(n["a"])({url:"/client/client/client_save",method:"post",data:r.stringify(t)})}function l(t){return Object(n["a"])({url:"/client/client/client_info",method:"post",data:r.stringify(t)})}function c(t){return Object(n["a"])({url:"/client/client/client_person_add",method:"post",data:r.stringify(t)})}function d(t){return Object(n["a"])({url:"/client/client/client_person_list",method:"post",data:r.stringify(t)})}function u(t){return Object(n["a"])({url:"/client/client/client_interview_add",method:"post",data:r.stringify(t)})}function m(t){return Object(n["a"])({url:"/client/client/client_interview_list",method:"post",data:r.stringify(t)})}function f(t){return Object(n["a"])({url:"/client/client/client_interview_info",method:"post",data:r.stringify(t)})}function p(t){return Object(n["a"])({url:"/client/client/client_contract_add",method:"post",data:r.stringify(t)})}function h(t){return Object(n["a"])({url:"/client/client/client_contract_list",method:"post",data:r.stringify(t)})}function g(t){return Object(n["a"])({url:"/client/client/client_shift",method:"post",data:r.stringify(t)})}function b(t){return Object(n["a"])({url:"/client/client/select",method:"post",data:r.stringify(t)})}function y(t){return Object(n["a"])({url:"/client/client/person_select",method:"post",data:r.stringify(t)})}function v(t){return Object(n["a"])({url:"/client/client/client_person_info",method:"post",data:r.stringify(t)})}function I(t){return Object(n["a"])({url:"/client/client/client_person_save",method:"post",data:r.stringify(t)})}function D(t){return Object(n["a"])({url:"/client/client/client_person_del",method:"post",data:r.stringify(t)})}function _(t){return Object(n["a"])({url:"/client/client/client_del",method:"post",data:r.stringify(t)})}var O=function(t){return Object(n["a"])({url:"/project/manage/list",method:"post",data:t})},w=function(t){return Object(n["a"])({url:"/project/manage/save",method:"post",data:t})},x=function(t){return Object(n["a"])({url:"/project/manage/info",method:"post",data:t})},k=function(t){return Object(n["a"])({url:"/project/manage/get-report-user",method:"post",data:t})},j=function(t){return Object(n["a"])({url:"/client/client/list",method:"post",data:t})}},"13f3":function(t,e,a){},1797:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{title:"新增记账-"+t.typeName,width:"800","mask-closable":!1},on:{"on-ok":t.modalSbumit,"on-cancel":t.cancel},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Form",{ref:"formData",attrs:{model:t.formData,"label-width":100,rules:t.checkFormData}},[a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("记账信息")]),a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"金额",prop:"amount"}},[a("Input",{attrs:{maxlength:"10",placeholder:"请输入金额"},model:{value:t.formData.amount,callback:function(e){t.$set(t.formData,"amount",e)},expression:"formData.amount"}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:t.typeName+"日期",prop:"date"}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"date",placeholder:"请选择"+t.typeName+"日期",value:t.formData.date,format:"yyyy-MM-dd"},on:{"on-change":t.changeData}})],1)],1),"4"==t.type||"5"==t.type||"6"==t.type||"7"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"业务日期",prop:"date"}},[a("DatePicker",{attrs:{type:"date"},model:{value:t.formData.date,callback:function(e){t.$set(t.formData,"date",e)},expression:"formData.date"}})],1)],1):t._e(),"4"==t.type||"5"==t.type||"6"==t.type||"7"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"24"}},[a("FormItem",{attrs:{label:""}},[a("RadioGroup",{model:{value:t.type,callback:function(e){t.type=e},expression:"type"}},[a("Radio",{attrs:{label:"4"}},[t._v("减应收")]),a("Radio",{attrs:{label:"5"}},[t._v("增应收")]),a("Radio",{attrs:{label:"6"}},[t._v("减应付")]),a("Radio",{attrs:{label:"7"}},[t._v("增应付")])],1)],1)],1):t._e(),"1"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"收入类别",prop:"paymentsTypeId"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.paymentsTypeId,callback:function(e){t.$set(t.formData,"paymentsTypeId",e)},expression:"formData.paymentsTypeId"}},t._l(t.paymentsTypeId,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),"2"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"支出类别",prop:"paymentsTypeId"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.paymentsTypeId,callback:function(e){t.$set(t.formData,"paymentsTypeId",e)},expression:"formData.paymentsTypeId"}},t._l(t.expenditureAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),"3"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"转出账户",prop:"expenditureAccount"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.expenditureAccount,callback:function(e){t.$set(t.formData,"expenditureAccount",e)},expression:"formData.expenditureAccount"}},t._l(t.incomeAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),"4"==t.type||"5"==t.type||"6"==t.type||"7"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"往来账户",prop:"incomeAccount"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.incomeAccount,callback:function(e){t.$set(t.formData,"incomeAccount",e)},expression:"formData.incomeAccount"}},t._l(t.incomeAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),2==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:t.typeName+"账户",prop:"expenditureAccount"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.expenditureAccount,callback:function(e){t.$set(t.formData,"expenditureAccount",e)},expression:"formData.expenditureAccount"}},t._l(t.incomeAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),2!=t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:t.typeName+"账户",prop:"incomeAccount"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.incomeAccount,callback:function(e){t.$set(t.formData,"incomeAccount",e)},expression:"formData.incomeAccount"}},t._l(t.incomeAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),"4"==t.type||"5"==t.type||"6"==t.type||"7"==t.type?a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"资金账户",prop:"incomeAccount"}},[a("Select",{attrs:{"label-in-value":!0},model:{value:t.formData.incomeAccount,callback:function(e){t.$set(t.formData,"incomeAccount",e)},expression:"formData.incomeAccount"}},t._l(t.incomeAccount,(function(e,n){return a("Option",{key:n,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1):t._e(),a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"部门",prop:"departmentId"}},[a("chooseDepartMent",{attrs:{ids:t.formData.departmentId},on:{change:t.changeDepartmentId}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12,span:"18"}},[a("FormItem",{attrs:{label:"备注",prop:"describe"}},[a("Input",{attrs:{maxlength:"20",placeholder:"请输入备注"},model:{value:t.formData.describe,callback:function(e){t.$set(t.formData,"describe",e)},expression:"formData.describe"}})],1)],1)],1),a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("订单信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{attrs:{label:"核算客户",prop:"clientId"}},[a("Select",{attrs:{filterable:"",clearable:"",placeholder:"请选择客户"},on:{"on-change":t.getClientOrder},model:{value:t.formData.clientId,callback:function(e){t.$set(t.formData,"clientId",e)},expression:"formData.clientId"}},t._l(t.clientList,(function(e,n){return a("Option",{key:n,attrs:{value:String(n)}},[t._v(t._s(e))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{attrs:{label:"核算订单"}},[a("Select",{attrs:{filterable:"",clearable:"",placeholder:"请选择订单",loading:t.loadingOrder,"remote-method":function(){}},on:{"on-change":t.changeOrder},model:{value:t.formData.orderId,callback:function(e){t.$set(t.formData,"orderId",e)},expression:"formData.orderId"}},t._l(t.orderList,(function(e,n){return a("Option",{key:n,attrs:{value:e.orderId,dataItem:e},nativeOn:{click:function(a){return t.getOrderInfo(e)}}},[t._v(t._s(e.number+"("+e.contractCode+")"))])})),1)],1)],1)],1),t.orderInfo.totalPrice?a("Row",[1!=t.orderInfo.isDrewBill&&1==t.type?a("Col",{attrs:{xs:24,md:24,lg:24}},[a("FormItem",{style:"width: 100%;",attrs:{label:"是否开具发票",prop:"clientId"}},[a("RadioGroup",{model:{value:t.formData.needBill,callback:function(e){t.$set(t.formData,"needBill",e)},expression:"formData.needBill"}},[a("Radio",{attrs:{label:"1"}},[t._v("是")]),a("Radio",{attrs:{label:"2"}},[t._v("否")])],1),a("span",{staticClass:"tip"},[t._v("每个订单仅能开具一次发票，请谨慎选择")])],1)],1):t._e(),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{style:"width: 100%;color:"+(parseFloat(t.orderInfo.noReceiptPrice)>0?"#ed4014":"#19be6b"),attrs:{label:"付款状态",prop:"clientId"}},[t._v("\n            "+t._s(parseFloat(t.orderInfo.noReceiptPrice)>0?"未完成":"已完成")+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{style:"width: 100%;color:"+(parseFloat(t.orderInfo.noReceiptPrice)>0?"#ed4014":"#19be6b"),attrs:{label:"未付金额",prop:"clientId"}},[t._v("\n            "+t._s(t.orderInfo.noReceiptPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单金额",prop:"clientId"}},[t._v("\n            "+t._s(t.orderInfo.totalPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"已付金额",prop:"clientId"}},[t._v("\n            "+t._s(t.orderInfo.receiptPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"",prop:"clientId"}},[a("div",{on:{click:function(e){return t.$refs.Drawer.getInfo(t.orderInfo.orderId)}}},[a("a",[t._v("查看更多···")])])])],1)],1):t._e()],1),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{on:{click:t.cancel}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.budGetAdd()}}},[t._v("确定")])],1)],1),a("send",{ref:"Drawer"}),a("addModal",{ref:"AddDrawer",on:{dataList:t.dataList}})],1)},r=[],o=(a("8e6e"),a("456d"),a("ac6a"),a("bd86")),i=a("b627"),s=a("4759"),l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{title:"新增",width:"420px","mask-closable":!1},on:{"on-ok":t.modalSbumit,"on-cancel":t.cancel},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{model:t.formData,"label-width":80,rules:t.checkFormData}},[a("Row",[a("Col",{attrs:{span:"18"}},[a("FormItem",{attrs:{label:"名称",prop:"name"}},[a("Input",{attrs:{maxlength:"20"},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1)],1),a("Col",{attrs:{span:"18"}},[a("FormItem",{attrs:{label:"备注",prop:"remark"}},[a("Input",{attrs:{maxlength:"20"},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],1)],1),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.budGetAdd()}}},[t._v("确定")]),a("Button",{on:{click:t.cancel}},[t._v("取消")])],1)],1)],1)},c=[],d=(a("7f7f"),a("a3a8")),u=a("2f08"),m=a("2f62");function f(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function p(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?f(a,!0).forEach((function(e){Object(o["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):f(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var h={name:"addDepartment",components:{iCopyright:u["a"]},props:{},data:function(){return{typeName:"1",formData:{},showModal:!1,checkFormData:{name:[{required:!0,message:"请输入名称",trigger:"blur"}]}}},computed:p({},Object(m["e"])("admin/global",["classTerm","classType","shiftGrade","subject","shiftCat","sectionList","yearList","chargeinTypeList","courseTypeList"])),watch:{},methods:{budGetAdd:function(){var t=this;this.$refs["formData"].validate((function(e){e&&Object(d["a"])({type:t.typeName,name:t.formData.name,remark:t.formData.remark}).then((function(e){t.$Message.success(e.msg),t.cancel(),t.showModal=!1,t.$emit("dataList")}))}))},DrawerToShow:function(t){this.showModal=!0,this.typeName=t},modalSbumit:function(){console.log("确定")},cancel:function(){this.showModal=!1,this.$refs["formData"].resetFields(),this.formData={},this.$emit("dataList")}},mounted:function(){},beforeDestroy:function(){},created:function(){}},g=h,b=a("2877"),y=Object(b["a"])(g,l,c,!1,null,null,null),v=y.exports,I=a("f8b7"),D=a("0658");function _(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function O(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?_(a,!0).forEach((function(e){Object(o["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):_(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var w={name:"addDepartment",components:{iCopyright:u["a"],addModal:v,chooseDepartMent:s["a"],send:i["a"]},props:{type:{type:String,default:function(){return"1"}}},data:function(){return{paymentsTypeId:[],incomeAccount:[],expenditureAccount:[],formData:{},showModal:!1,checkFormData:{date:[{required:!0,message:"请选择日期",trigger:"change"}],amount:[{required:!0,message:"请输入金额",trigger:"blur"}]},clientList:[],orderList:[],orderInfo:{},loadingOrder:!1,loading:!0,isSubmit:!1,orderId:""}},computed:O({},Object(m["e"])("admin/global",[]),{typeName:function(){switch(this.type){case"1":return"收入";case"2":return"支出";case"3":return"转账";default:return""}}}),watch:{type:function(t){console.log(t)}},methods:{changeData:function(t){this.formData.date=t},changeOrder:function(t){console.log(t),t||(this.orderInfo={})},getOrderInfo:function(t){this.orderInfo=t},getClientOrder:function(){var t=this;this.loadingOrder=!0,this.orderList=[],this.formData.orderId=this.orderId,console.log(111111),Object(I["a"])({clientId:this.formData.clientId}).then((function(e){t.orderList=e.data.list,t.orderId&&t.orderList.forEach((function(e){e.orderId==t.orderId&&t.getOrderInfo(e)})),t.loadingOrder=!1,t.loading=!1})).catch((function(e){t.loadingOrder=!1,t.loading=!1}))},getClientList:function(){var t=this;Object(D["j"])().then((function(e){t.clientList=e.data.select}))},changeDepartmentId:function(t){this.formData.departmentId=t},getClientName:function(t){this.formData.clientId=t.belongCustomer},numberChange:function(t){var e=null;if(t>=0){var a=/.*\..*/;e=a.test(t)?parseFloat(t.toFixed(2)):t}this.formData.amount=e},format:function(t){var e=new Date(t),a=e.getFullYear(),n=e.getMonth()+1,r=e.getDate();return n<10&&(n="0"+n),r<10&&(r="0"+r),a+"-"+n+"-"+r},budGetAdd:function(){var t=this;this.isSubmit||(this.isSubmit=!0,this.$refs["formData"].validate((function(e){e?Object(d["c"])(O({type:t.type},t.formData,{departmentId:t.formData.departmentId[t.formData.departmentId.length-1]||""})).then((function(e){t.$Message.success(e.msg),t.cancel(),t.$emit("dataList"),t.isSubmit=!1})).catch((function(e){t.isSubmit=!1})):t.isSubmit=!1})))},dataList:function(){var t=this;Object(d["d"])({}).then((function(e){t.paymentsTypeId=e.data.configData.paymentsTypeIncome,t.incomeAccount=e.data.configData.account,t.expenditureAccount=e.data.configData.paymentsTypeExpenditure}))},addType:function(t){this.$refs.AddDrawer.DrawerToShow(t)},DrawerToShow:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.showModal=!0,this.loadingOrder=!1,this.isSubmit=!1,this.orderId=e,this.formData={clientId:t+"",orderId:e,amount:"",date:"",paymentsTypeId:"",incomeAccount:"",expenditureAccount:"",describe:"",departmentId:[],id:"",needBill:"2"},this.orderList=[],e?(this.loading=!0,this.getClientOrder()):this.loading=!1},modalSbumit:function(){console.log("确定")},cancel:function(){this.showModal=!1,this.$refs["formData"].resetFields(),this.$emit("showAudition")}},mounted:function(){this.getClientList(),this.dataList()},beforeDestroy:function(){},created:function(){}},x=w,k=(a("54df"),Object(b["a"])(x,n,r,!1,null,"25f7b187",null));e["a"]=k.exports},"3aa4":function(t,e,a){},4759:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Cascader",{attrs:{data:t.list,value:t.newArr,"change-on-select":""},on:{"update:value":function(e){t.newArr=e},"on-change":t.change}})],1)},r=[],o=a("9411"),i={components:{},props:{ids:Array},data:function(){return{showModal:!1,list:[],newArr:[]}},computed:{},watch:{ids:function(t){this.newArr=t}},methods:{change:function(t){this.$emit("change",t),console.log(t,"department")},getList:function(){var t=this;Object(o["E"])().then((function(e){var a=e.data.list;t.list=a.map((function(t,e){return{value:t.sectionId,label:t.title,children:t.children.map((function(t){return{value:t.sectionId,label:t.title,children:t.children.map((function(t){return{value:t.sectionId,label:t.title}}))}}))}})),sessionStorage.setItem("departMentList",JSON.stringify(t.list))}))}},mounted:function(){},beforeDestroy:function(){},created:function(){JSON.parse(sessionStorage.getItem("departMentList"))?this.list=JSON.parse(sessionStorage.getItem("departMentList")):this.getList()}},s=i,l=a("2877"),c=Object(l["a"])(s,n,r,!1,null,"689f859a",null);e["a"]=c.exports},"4dc3":function(t,e,a){"use strict";var n=a("3aa4"),r=a.n(n);r.a},"54df":function(t,e,a){"use strict";var n=a("b774"),r=a.n(n);r.a},"75ae":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticStyle:{"margin-top":"10px"}},[a("Tabs",{on:{"on-click":t.dataList},model:{value:t.type,callback:function(e){t.type=e},expression:"type"}},[a("TabPane",{attrs:{label:"收入",name:"1"}}),a("TabPane",{attrs:{label:"支出",name:"2"}}),a("TabPane",{attrs:{label:"转账",name:"3"}})],1),a("Form",{attrs:{model:t.searchKey,"label-width":100,inline:""}},[a("Row",[a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"创建时间：","label-position":"top"}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"daterange",placeholder:"请选择创建时间"},on:{"on-change":t.handleChangeTime}})],1)],1),a("Col",{attrs:{xs:24,sm:12,md:12,lg:8}},[a("FormItem",{staticStyle:{"text-align":"right"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.search()}}},[t._v("搜索")])],1)],1)],1)],1),a("Row",{staticStyle:{"padding-top":"20px"}},[a("Button",{staticStyle:{"margin-right":"10px"},attrs:{type:"primary"},on:{click:function(e){return t.addBugget()}}},[t._v("新增")])],1),a("Table",{staticStyle:{"margin-top":"10px"},attrs:{loading:t.loading,columns:t.columns,data:t.tableData}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageInfo.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageInfo.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageInfo.count),"page-size":Number(t.pageInfo.pageSize),current:Number(t.pageInfo.page)},on:{"on-change":t.changePage}})],1)])],1),a("addModal",{ref:"AddDrawer",attrs:{type:t.type},on:{dataList:t.dataList}})],1)},r=[],o=(a("ac6a"),a("1797")),i=a("a3a8"),s=a("2f08"),l={name:"financeManagement",components:{iCopyright:s["a"],addModal:o["a"]},data:function(){return{isShow:!1,type:"1",loading:!0,searchKey:{},pageInfo:{count:10,pageSize:10,page:1},tableData:[]}},computed:{columns:function(){var t=[{title:"公司名称",key:"clientName",minWidth:120},{title:"部门",key:"department",minWidth:120},{title:"账单日期",key:"date",minWidth:120},{title:"项目名称",key:"projectName",minWidth:120,render:function(t,e){return t("div",e.row.number?e.row.number+"("+e.row.contactCode+")":"")}},{title:"金额",key:"amount",minWidth:100},{title:"创建时间",key:"createTime",minWidth:120}];switch(this.type+""){case"1":t.splice(4,0,{title:"收入类别",key:"paymentsType",minWidth:100}),t.splice(4,0,{title:"收入账户",key:"incomeAccountName",minWidth:100});break;case"2":t.splice(4,0,{title:"支出类别",key:"paymentsType",minWidth:100}),t.splice(4,0,{title:"支出账户",key:"expenditureAccount",minWidth:100});break;case"3":t.splice(4,0,{title:"支出账户",key:"expenditureAccount",minWidth:100}),t.splice(5,0,{title:"收入账户",key:"incomeAccountName",minWidth:100});break;default:break}return t}},watch:{},methods:{addBugget:function(){this.$refs.AddDrawer.DrawerToShow()},changePage:function(t){this.pageInfo.page=t,this.dataList()},search:function(){this.pageInfo.page=1,this.pageInfo.pageSize=20,this.dataList()},changeSelect:function(t){var e=this;this.chooseData=[],t.forEach((function(t){e.chooseData.push(t.noticeId)}))},dataList:function(){var t=this;this.loading=!0,Object(i["b"])({startTime:this.searchKey.startTime,endTime:this.searchKey.endTime,type:this.type,page:this.pageInfo.page}).then((function(e){t.tableData=e.data.list,t.pageInfo=e.data.pageInfo,t.loading=!1}))},handleChangeTime:function(t){this.searchKey.startTime=t[0]||"",this.searchKey.endTime=t[1]||""}},mounted:function(){},beforeDestroy:function(){},created:function(){this.dataList()}},c=l,d=(a("4dc3"),a("2877")),u=Object(d["a"])(c,n,r,!1,null,"2a5d588a",null);e["default"]=u.exports},"8e5b":function(t,e,a){"use strict";var n=a("13f3"),r=a.n(n);r.a},a3a8:function(t,e,a){"use strict";a.d(e,"f",(function(){return r})),a.d(e,"a",(function(){return o})),a.d(e,"d",(function(){return i})),a.d(e,"c",(function(){return s})),a.d(e,"b",(function(){return l})),a.d(e,"e",(function(){return c}));var n=a("b6bd");function r(t){return Object(n["a"])({url:"/finance/budget/statistics",method:"post",data:t})}function o(t){return Object(n["a"])({url:"/finance/budget/add-auxiliary",method:"post",data:t})}function i(t){return Object(n["a"])({url:"/finance/manage/get-config",method:"post",data:t})}function s(t){return Object(n["a"])({url:"/finance/manage/save",method:"post",data:t})}function l(t){return Object(n["a"])({url:"/finance/manage/list",method:"post",data:t})}function c(t){return Object(n["a"])({url:"/finance/order/list",method:"post",data:t})}},b627:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:t.isSend?"发货":"订单详情",width:800},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),a("Form",{ref:"formValidate",attrs:{model:t.formValidate,rules:t.ruleValidate,"label-width":90}},[t.isSend?a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("发货信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货时间",prop:"sendDate"}},[a("DatePicker",{staticStyle:{width:"100%"},attrs:{type:"date",placeholder:"请选择发货时间",value:t.formValidate.sendDate,format:"yyyy-MM-dd"},on:{"on-change":t.changeData}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货方式",prop:"sendWay"}},[a("Input",{attrs:{placeholder:"请输入发货方式"},model:{value:t.formValidate.sendWay,callback:function(e){t.$set(t.formValidate,"sendWay",e)},expression:"formValidate.sendWay"}})],1)],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{attrs:{label:"联系人"}},[a("Select",{attrs:{filterable:"",clearable:"",placeholder:"请选择联系人"},model:{value:t.formValidate.clientPersonId,callback:function(e){t.$set(t.formValidate,"clientPersonId",e)},expression:"formValidate.clientPersonId"}},t._l(t.contactList,(function(e,n){return a("Option",{key:n,attrs:{value:e.personId}},[t._v(t._s(e.name+"("+e.phone+")"))])})),1)],1)],1)],1):t._e(),t.formValidate.id?a("Row",{attrs:{type:"flex",justify:"start"}},[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("订单信息")]),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单编号：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.number)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"状态：",prop:"clientId"}},[t._v("\n            "+t._s(t.statusName)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单客户：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.clientName)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"合同编号：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.contractCode)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"订单金额：",prop:"totalPrice"}},[t._v("\n            "+t._s(t.formValidate.totalPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"已付金额：",prop:"receiptPrice"}},[t._v("\n            "+t._s(t.formValidate.receiptPrice)+"\n          ")])],1),a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"交货日期：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.deliveryDate)+"\n          ")])],1),3==t.formValidate.status?a("Col",{attrs:{xs:24,md:24,lg:12}},[a("FormItem",{staticStyle:{width:"100%"},attrs:{label:"发货日期：",prop:"clientId"}},[t._v("\n            "+t._s(t.formValidate.sendDate)+"\n          ")])],1):t._e()],1):t._e(),a("Row",[a("Col",{staticClass:"block-title",attrs:{span:"24"}},[t._v("产品信息\n        ")]),a("Col",{attrs:{xs:24,md:24,lg:24}},[a("Table",{staticStyle:{margin:"10px 0"},attrs:{columns:t.columns,data:t.formValidate.detailList,border:"","show-summary":"","min-height":"200"}})],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),t.isSend?a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")]):t._e()],1)],1),a("chooseMateriel",{ref:"chooseMateriel",attrs:{houseId:t.formValidate.houseId},on:{handleChoose:t.handleChoose}})],1)},r=[],o=(a("8e6e"),a("456d"),a("a481"),a("c5f6"),a("ac6a"),a("bd86")),i=(a("7f7f"),a("c276"),a("f8b7")),s=a("2f08"),l=a("d9e1"),c=(a("2f62"),a("0658"));function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(a,!0).forEach((function(e){Object(o["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var m={name:"addIandeBank",props:{modal:{type:Boolean}},components:{iCopyright:s["a"],chooseMateriel:l["a"]},data:function(){return{formValidate:{status:1},ruleValidate:{sendDate:[{required:!0,message:"请选择发货时间",trigger:"blur"}],sendWay:[{required:!0,message:"请填写发货方式",trigger:"blur"}]},showModal:!1,columns:[{title:"名称",key:"goodsName",minWidth:100},{title:"单价",minWidth:100,align:"center",key:"price"},{title:"是否含税",minWidth:100,align:"center",render:function(t,e){return t("RadioGroup",{props:{value:0==e.row.isTax?"1":e.row.isTax+""}},[t("Radio",{props:{label:"1",disabled:!0}},"否"),t("Radio",{props:{label:"2",disabled:!0}},"是")])}},{title:"售价",key:"taxPrice",minWidth:50},{title:"数量",minWidth:100,align:"center",key:"num"},{title:"总价",key:"total",minWidth:50}],loading:!0,isSubmit:!1,goodsType:"",contactList:[],isSend:!1}},computed:{statusName:function(){switch(this.formValidate.status+""){case"1":return"生产中";case"2":return"生产完成";case"3":return"已发货";case"4":return"已完成";default:return""}}},methods:{handleReset:function(t){this.$refs[t].resetFields(),this.showModal=!1,this.loading=!1,this.isSubmit=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;this.isSubmit||(this.isSubmit=!0,this.$refs[t].validate((function(a){if(a){if(e.formValidate.detailList.length<1)return e.isSubmit=!1,void e.$Message.error("请选择产品");Object(i["g"])(u({},e.formValidate)).then((function(a){e.$Message.success("保存成功"),e.handleReset(t),e.$emit("getData")})).catch((function(){e.isSubmit=!1}))}else e.isSubmit=!1})))},handleChoose:function(t){var e=this,a=this.formValidate.detailList,n=[];a.forEach((function(t){n.push(t.goodsId+"")})),t.forEach((function(t){var r={};-1===n.indexOf(t.id+"")&&(r.num=1,r.id=0,r.goodsId=t.id,r.goodsName=t.name,r.orderId=e.formValidate.id,a.push(r))})),this.formValidate.detailList=a},delGoods:function(t){this.formValidate.detailList.splice(t,1)},getInfo:function(t){var e=this,a=arguments.length>1&&void 0!==arguments[1]&&arguments[1];this.isSend=a,console.log(t),this.showModal=!0,this.loading=!0,Object(i["d"])({id:t}).then((function(t){0===t.ret&&(t.data.info.detailList=t.data.info.detailList.map((function(t){return t.total=e.onlyNumber(Number(t.num)*parseFloat(t.taxPrice)),t})),e.formValidate=t.data.info,e.formValidate.clientId=e.formValidate.clientId+"",e.formValidate.sendDate="",e.formValidate.sendWay="",e.formValidate.clientPersonId="",e.getList())}))},changeData:function(t){this.formValidate.sendDate=t},getList:function(){var t=this;Object(c["l"])({clientId:this.formValidate.clientId}).then((function(e){t.loading=!1,0===e.ret?t.contactList=e.data.list:t.$Message.error(e.msg||"接口错误")}))},onlyNumber:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2;return console.log(t),t+="",t=t.replace(/[^\d\.]/g,""),t=t.replace(/^\./g,"0."),t=t.replace(/\.{2,}/g,"."),t=t.replace(".","$#$").replace(/\./g,"").replace("$#$","."),t=2==e?t.replace(/^(\-)*(\d+)\.(\d\d).*$/,"$1$2.$3"):t.replace(/^(\-)*(\d+)\.(\d{1,3}).*$/,"$1$2.$3"),parseFloat(t)}},mounted:function(){console.log(this.user),this.getList()},beforeDestroy:function(){},created:function(){}},f=m,p=(a("8e5b"),a("2877")),h=Object(p["a"])(f,n,r,!1,null,"69ea4600",null);e["a"]=h.exports},b774:function(t,e,a){},f8b7:function(t,e,a){"use strict";a.d(e,"e",(function(){return s})),a.d(e,"d",(function(){return l})),a.d(e,"f",(function(){return c})),a.d(e,"c",(function(){return d})),a.d(e,"g",(function(){return u})),a.d(e,"b",(function(){return m})),a.d(e,"a",(function(){return f})),a.d(e,"h",(function(){return p}));var n=a("c276"),r=a("b6bd"),o=n["a"].cookies.get("token"),i=a("4328");function s(t){return Object(r["a"])({url:"/sales/manage/list?token="+o,method:"post",data:i.stringify(t)})}function l(t){return Object(r["a"])({url:"/sales/manage/info?token="+o,method:"post",data:t})}function c(t){return Object(r["a"])({url:"/sales/manage/save?token="+o,method:"post",data:t})}function d(t){return Object(r["a"])({url:"/sales/manage/pro-complete?token="+o,method:"post",data:t})}function u(t){return Object(r["a"])({url:"/sales/manage/send?token="+o,method:"post",data:t})}function m(t){return Object(r["a"])({url:"/sales/manage/goods-list",method:"post",data:t})}function f(t){return Object(r["a"])({url:"/sales/manage/client-order",method:"post",data:t})}function p(t){return Object(r["a"])({url:"/sales/manage/print-data",method:"post",data:t})}}}]);