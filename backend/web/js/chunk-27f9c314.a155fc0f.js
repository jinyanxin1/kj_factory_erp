(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-27f9c314"],{"2f9b":function(t,e,a){},"3efd":function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"邀约面试1",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"姓名","label-position":"top"}},t._l(t.jobNames,(function(e,o){return a("span",{key:o,staticStyle:{"margin-right":"10px"}},[t._v(t._s(e)+" ")])})),0)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试时间","label-position":"top",prop:"time"}},[a("DatePicker",{attrs:{value:t.formData.time,type:"datetime",placeholder:"选择时间"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"公司","label-position":"top",prop:"clientId"}},[a("div",{staticStyle:{display:"flex"}},[a("Select",{attrs:{filterable:""},model:{value:t.formData.clientId,callback:function(e){t.$set(t.formData,"clientId",e)},expression:"formData.clientId"}},t._l(t.selectClient,(function(e,o){return a("Option",{key:o,attrs:{value:Number(o)}},[t._v(t._s(e))])})),1)],1),a("chooseCustomer",{ref:"customer",on:{handleChoose:t.handleChoose}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试岗位","label-position":"top",prop:"position"}},[a("Input",{model:{value:t.formData.position,callback:function(e){t.$set(t.formData,"position",e)},expression:"formData.position"}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"内容","label-position":"top",prop:"remark"}},[a("Input",{attrs:{type:"textarea",rows:6,placeholder:"最多输入200个字符"},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.loading},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},i=[],n=(a("8e6e"),a("ac6a"),a("456d"),a("7f7f"),a("6b54"),a("bd86")),r=a("2f62"),s=a("1808");function l(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,o)}return a}function c(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?l(a,!0).forEach((function(e){Object(n["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):l(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var m={components:{},props:{},data:function(){return{showModal:!1,formData:{time:"",position:"",clientId:"",jobId:"",remark:"",clientName:""},ruleInline:{time:[{required:!0,type:"string",message:"请选择面试时间",trigger:"change"}],position:[{required:!0,message:"请输入面试岗位",trigger:"blur"}],clientId:[{required:!0,type:"number",message:"请选择面试公司",trigger:"change"}]},jobNames:[],fromPage:"",clientList:{},loading:!1}},computed:c({},Object(r["e"])("admin/global",["selectClient"])),watch:{},methods:{DrawerToShow:function(t,e,a,o){this.fromPage=a,this.jobNames=e,this.showModal=!0,"enroll"===a?(this.formData.clientId=o.clientId.toString(),this.formData.jobId=o.jobId,this.formData.position=o.recruitmentPost,this.formData.time=o.createTime,this.formData.registraId=o.registraId):this.formData.jobId=t},handleReset:function(t){this.showModal=!1,this.$refs[t].resetFields()},getId:function(t,e){this.formData[e]=t,console.log(t,"++++++")},handleSubmit:function(t){var e=this;this.$refs[t].validate((function(a){a?"enroll"===e.fromPage?(e.loading=!0,Object(s["c"])(e.formData).then((function(a){e.$Message.success("邀约成功！"),e.showModal=!1,e.$refs[t].resetFields(),e.$emit("getData"),e.loading=!1})).catch((function(t){e.loading=!1}))):(e.loading=!0,Object(s["a"])(e.formData).then((function(a){e.$Message.success("邀约成功！"),e.showModal=!1,e.$refs[t].resetFields(),e.$emit("getData"),e.loading=!1})).catch((function(t){e.loading=!1}))):(e.$Message.error("表单验证失败!"),e.loading=!1)}))},handleChoose:function(t,e){this.formData.clientId=t,this.formData.clientName=e,console.log(t,"aaaaa")},showCustomer:function(){this.$refs.customer.DrawerToShow()}},mounted:function(){},beforeDestroy:function(){},created:function(){}},f=m,d=(a("e0be"),a("2877")),u=Object(d["a"])(f,o,i,!1,null,"419e1612",null);e["a"]=u.exports},"457a":function(t,e,a){"use strict";a.r(e);var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{ref:"formData",staticClass:"form-box",attrs:{model:t.formData,inline:"","label-width":100}},[a("FormItem",{attrs:{label:"姓名：","label-position":"top"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),a("FormItem",{attrs:{label:"手机号：","label-position":"top"}},[a("Input",{model:{value:t.formData.phone,callback:function(e){t.$set(t.formData,"phone",e)},expression:"formData.phone"}})],1),a("FormItem",{attrs:{"label-position":"top","label-width":20}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("formData")}}},[t._v("重置")])],1),a("div",{class:t.isShow?"":"none"},[a("FormItem",{attrs:{label:"身份证：","label-position":"top"}},[a("Input",{model:{value:t.formData.idCard,callback:function(e){t.$set(t.formData,"idCard",e)},expression:"formData.idCard"}})],1),a("FormItem",{attrs:{label:"技能：","label-position":"top"}},[a("Select",{staticStyle:{width:"auto"},attrs:{multiple:""},model:{value:t.formData.skillId,callback:function(e){t.$set(t.formData,"skillId",e)},expression:"formData.skillId"}},t._l(t.skillList,(function(e,o){return a("Option",{key:o,attrs:{value:e.basisId}},[t._v(t._s(e.name))])})),1)],1),a("FormItem",{attrs:{label:"性别：","label-position":"top"}},[a("RadioGroup",{model:{value:t.formData.sex,callback:function(e){t.$set(t.formData,"sex",e)},expression:"formData.sex"}},[a("Radio",{attrs:{label:-1}},[t._v("所有")]),a("Radio",{attrs:{label:1}},[t._v("男")]),a("Radio",{attrs:{label:0}},[t._v("女")])],1)],1),a("FormItem",{attrs:{label:"渠道：","label-position":"top"}},[a("chooseBaseData",{attrs:{id:"channelId",channel:"CHANNEL_MODE",basisId:String(t.formData.channelId)},on:{handleSubmit:t.getId}})],1)],1),a("div",{staticClass:"sx-box",on:{click:t.screen}},[t._v("\n        "+t._s(t.isShow?"收起":"更多筛选")+" "),a("Icon",{class:t.isShow?"turn":"",attrs:{type:"ios-arrow-down"}})],1)],1)],1),a("Card",[a("div",{staticStyle:{display:"flex","justify-content":"flex-start","margin-bottom":"10px"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show()}}},[t._v("邀约")]),a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"error"},on:{click:function(e){return t.onDelete()}}},[t._v("删除")])],1),a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.chooseSelect}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page),"show-sizer":""},on:{"on-change":t.changePage,"on-page-size-change":t.changePageSize}})],1)])],1),a("invite",{ref:"Drawer",on:{getData:t.getList}}),a("talentDetail",{ref:"detail",attrs:{erTitle:t.erTitle},on:{getData:t.getList}}),a("talentDetailView",{ref:"view"})],1)},i=[],n=(a("8e6e"),a("456d"),a("ac6a"),a("bd86")),r=(a("7f7f"),a("c276")),s=a("3efd"),l=a("9c3b"),c=a("c36a"),m=a("1808"),f=a("9411");function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,o)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(a,!0).forEach((function(e){Object(n["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var p={components:{invite:s["a"],talentDetail:l["a"],talentDetailView:c["a"]},data:function(){var t=this;return{isShow:!1,loading:!0,erTitle:"",status:"",curRow:{},formItem:"",userTypeList:[],tableColumns:[{type:"selection",width:60,align:"center"},{title:"姓名",key:"name",minWidth:100,render:function(e,a){return e("div",[e("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px"},on:{click:function(){if(r["a"].cookies.get("roleType")>1)t.getDetail(a.row,"edit");else{var e="";r["a"].cookies.get("roleType")<=1&&(e="只有部门主管与超级管理员才有编辑权限"),t.getView(a.row,e)}}}},a.row.name)])}},{title:"年龄",key:"age",minWidth:60},{title:"性别",key:"sex",minWidth:60},{title:"面试岗位",key:"position",minWidth:100},{title:"手机号",key:"phone",minWidth:100}],tableData:[],pageination:{page:1,pageSize:10,count:1},page:1,jobIds:[],jobNames:[],skillList:[],formData:{name:"",phone:"",skillId:[],sex:-1,idCard:""}}},created:function(){this.getList(),this.getSkill()},methods:{search:function(){this.page=1,this.getList()},clear:function(t){this.page=1,this.formData.name="",this.formData.phone="",this.formData.skillId=[],this.formData.sex=-1,this.formData.channelId="",this.formData.idCard="",this.$refs[t].resetFields(),this.getList()},getList:function(){var t=this;this.loading=!0,Object(m["z"])(u({page:this.page,pageSize:this.pageination.pageSize},this.formData)).then((function(e){t.loading=!1,0===e.ret?(t.tableData=e.data.list,t.pageination=e.data.pageInfo):t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getList()},getDetail:function(t){this.erTitle=t.name,this.$refs.detail.DrawerToShow(t.jobId,t.name)},getView:function(t,e){this.erTitle=t.name,this.$refs.view.DrawerToShow(t.jobId,t.name,e)},show:function(){this.jobIds.length>0?this.$refs.Drawer.DrawerToShow(this.jobIds,this.jobNames):this.$Message.error("请选择邀约人才")},chooseSelect:function(t){var e=this;this.jobIds=[],this.jobNames=[],t.forEach((function(t){e.jobIds.push(t.jobId),e.jobNames.push(t.name)}))},getId:function(t,e){this.formData[e]=t},getSkill:function(){var t=this;this.loading=!0,Object(f["h"])({type:"SKILL"}).then((function(e){t.loading=!1,0===e.ret?t.skillList=e.data:t.$Message.error(e.msg||"接口错误")}))},screen:function(){this.isShow=!this.isShow},changePageSize:function(t){this.pageination.pageSize=t,this.getList()},remove:function(t){this.jobIds=[t.jobId],this.onDelete()},onDelete:function(){var t=this;this.jobIds?this.$Modal.confirm({title:"提示",content:"<p>确认删除该人才?</p>",onOk:function(){Object(m["u"])({jobId:t.jobIds}).then((function(e){0===e.ret?(t.$Message.success("删除成功"),t.getList()):t.$Message.error(e.msg)}))},onCancel:function(){}}):this.$Message.error("请选择要删除的人才！")}}},h=p,g=(a("cd2e"),a("2877")),b=Object(g["a"])(h,o,i,!1,null,"bda240a6",null);e["default"]=b.exports},cd2e:function(t,e,a){"use strict";var o=a("dd76"),i=a.n(o);i.a},dd76:function(t,e,a){},e0be:function(t,e,a){"use strict";var o=a("2f9b"),i=a.n(o);i.a}}]);