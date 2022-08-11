(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-48f09951"],{6323:function(t,e,a){"use strict";var i=a("a49e"),o=a.n(i);o.a},"9db0":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{ref:"formData",staticClass:"form-box",attrs:{model:t.formData,inline:"","label-width":100}},[a("FormItem",{attrs:{label:"姓名：","label-position":"top",prop:"name"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),a("FormItem",{attrs:{label:"手机号：","label-position":"top",prop:"phone"}},[a("Input",{model:{value:t.formData.phone,callback:function(e){t.$set(t.formData,"phone",e)},expression:"formData.phone"}})],1),a("FormItem",{attrs:{label:"","label-position":"top","label-width":20}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("formData")}}},[t._v("重置")])],1),a("div",{class:t.isShow?"":"none"},[a("FormItem",{attrs:{label:"身份证：","label-position":"top"}},[a("Input",{model:{value:t.formData.idCard,callback:function(e){t.$set(t.formData,"idCard",e)},expression:"formData.idCard"}})],1),a("FormItem",{attrs:{label:"技能：","label-position":"top"}},[a("Select",{staticStyle:{width:"auto"},attrs:{multiple:""},model:{value:t.formData.skillId,callback:function(e){t.$set(t.formData,"skillId",e)},expression:"formData.skillId"}},t._l(t.skillList,(function(e,i){return a("Option",{key:i,attrs:{value:e.basisId}},[t._v(t._s(e.name))])})),1)],1),a("FormItem",{attrs:{label:"性别：","label-position":"top"}},[a("RadioGroup",{model:{value:t.formData.sex,callback:function(e){t.$set(t.formData,"sex",e)},expression:"formData.sex"}},[a("Radio",{attrs:{label:-1}},[t._v("所有")]),a("Radio",{attrs:{label:1}},[t._v("男")]),a("Radio",{attrs:{label:0}},[t._v("女")])],1)],1),a("FormItem",{attrs:{label:"所在公司：","label-position":"top"}},[a("div",{staticStyle:{display:"flex"}},[a("Select",{attrs:{filterable:""},model:{value:t.formData.clientId,callback:function(e){t.$set(t.formData,"clientId",e)},expression:"formData.clientId"}},t._l(t.selectClient,(function(e,i){return a("Option",{key:i,attrs:{value:Number(i)}},[t._v(t._s(e))])})),1)],1),a("chooseCustomer",{ref:"customer",on:{handleChoose:t.handleChoose}})],1),a("FormItem",{attrs:{label:"渠道：","label-position":"top"}},[a("chooseBaseData",{attrs:{id:"channelId",channel:"CHANNEL_MODE",basisId:String(t.formData.channelId)},on:{handleSubmit:t.getId}})],1),a("FormItem",{attrs:{label:"入职日期：","label-position":"top"}},[a("DatePicker",{attrs:{value:t.entryTime,type:"daterange"},on:{"on-change":t.handleChangeTime}})],1),a("FormItem",{attrs:{label:"创建时间：","label-position":"top"}},[a("DatePicker",{attrs:{value:t.createTime,type:"daterange"},on:{"on-change":t.changeTime}})],1)],1)],1),a("div",{staticClass:"sx-box",on:{click:t.screen}},[t._v("\n      "+t._s(t.isShow?"收起":"更多筛选")+" "),a("Icon",{class:t.isShow?"turn":"",attrs:{type:"ios-arrow-down"}})],1)],1),a("Card",[a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.chooseSelect}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page),"show-sizer":""},on:{"on-change":t.changePage,"on-page-size-change":t.changePageSize}})],1)])],1),a("addTalent",{ref:"Drawer",on:{getData:t.getList}}),a("talentLeave",{ref:"leave",on:{getData:t.getList}}),a("talentEntry",{ref:"entry",on:{getData:t.getList}}),a("talentDetail",{ref:"detail",attrs:{erTitle:t.erTitle},on:{getData:t.getList}}),a("upLoadFile",{ref:"upload",on:{getData:t.getList}}),a("invite",{ref:"invite",on:{getData:t.getList}}),a("talentDetailView",{ref:"view"})],1)},o=[],n=(a("8e6e"),a("456d"),a("ac6a"),a("bd86")),s=(a("7f7f"),a("c276")),r=a("2f62"),l=a("8690"),c=a("0639"),h=a("1f8e"),f=a("9c3b"),m=a("3efd"),d=a("62df"),p=a("c36a"),u=a("1808"),g=a("9411");function b(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function D(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?b(a,!0).forEach((function(e){Object(n["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):b(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var I={components:{addTalent:l["a"],talentLeave:c["a"],talentEntry:h["a"],talentDetail:f["a"],invite:m["a"],upLoadFile:d["a"],talentDetailView:p["a"]},data:function(){var t,e=this;return t={staffId:"",jobTemplate:u["w"],loading:!0,erTitle:"",status:"",curRow:{},formItem:"",userTypeList:[],tableColumns:[{title:"姓名",key:"name",minWidth:80,render:function(t,a){return t("div",[t("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px"},on:{click:function(){3==s["a"].cookies.get("roleType")||3==a.row.status&&a.row.clientStaffId==s["a"].cookies.get("staffId")||3!=a.row.status&&a.row.staffId==s["a"].cookies.get("staffId")?e.getDetail(a.row,"edit"):e.getView(a.row,"edit")}}},a.row.name)])}},{title:"年龄",key:"age",minWidth:60},{title:"性别",key:"sex",minWidth:60},{title:"岗位",key:"position",minWidth:120},{title:"手机号",key:"phone",minWidth:130},{title:"状态",key:"statusName",minWidth:80},{title:"创建时间",key:"createTime",minWidth:135},{title:"入职日期",key:"entryTime",minWidth:110},{title:"离职日期",key:"leaveTime",minWidth:110},{title:"工作厂",key:"client",minWidth:200}],tableData:[],pageination:{page:1,pageSize:10,count:1},page:1,jobIds:[],jobNames:[],isShow:!1,formData:{},skillList:[]},Object(n["a"])(t,"jobIds",[]),Object(n["a"])(t,"entryTime",[]),Object(n["a"])(t,"createTime",[]),t},created:function(){this.jobIds=this.$route.query.jobId,this.jobIds?this.staffId="":(console.log("==============="),this.staffId=s["a"].cookies.get("staffId")),this.getList(),this.getSkill()},computed:D({},Object(r["e"])("admin/global",["selectClient"])),methods:{changeSearch:function(t){this.page=1,this.formData.status=t,this.getList()},search:function(){this.page=1,this.getList()},clear:function(t){this.page=1,this.jobIds=[],this.formData.sex="-1",this.formData.clientId="",this.formData.skillId=[],this.formData.startTime="",this.formData.endTime="",this.entryTime=[],this.createTime=[],this.formData.createStartTime="",this.formData.createEndTime="",this.formData.channelId="",this.formData.idCard="",this.$refs[t].resetFields(),this.getList()},getList:function(){var t=this;this.loading=!0,Object(u["t"])(D({staffId:this.staffId,page:this.page,pageSize:this.pageination.pageSize},this.formData)).then((function(e){if(t.loading=!1,0===e.ret){t.tableData=e.data.list,t.pageination=e.data.pageInfo;for(var a=0;a<t.tableData.length;a++)3==t.tableData[a].status&&(t.tableData[a]._disabled=!0)}else t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getList()},changePageSize:function(t){this.pageination.pageSize=t,this.getList()},show:function(t,e){this.status=e,"add"===e?this.erTitle="新增":"edit"===e&&(this.erTitle="编辑"),this.$refs.Drawer.DrawerToShow()},leave:function(t){this.$refs.leave.DrawerToShow(t.jobId,t.name)},entry:function(t){this.$refs.entry.DrawerToShow(t)},getDetail:function(t){this.erTitle=t.name,this.$refs.detail.DrawerToShow(t.jobId,t.name)},getView:function(t){this.erTitle=t.name,this.$refs.view.DrawerToShow(t.jobId,t.name)},getInvite:function(t){this.jobIds=[],this.jobNames=[],this.jobNames=[t.name],this.jobIds=[t.jobId],this.openInvite()},getInviteMore:function(){this.jobIds?this.openInvite():this.$Message.error("请选择邀约人才")},openInvite:function(){this.$refs.invite.DrawerToShow(this.jobIds,this.jobNames)},chooseSelect:function(t){var e=this;e.jobIds=[],e.jobNames=[],t.forEach((function(t){e.jobIds.push(t.jobId),e.jobNames.push(t.name),console.log(e.jobIds)}))},toUpload:function(){this.$refs.upload.DrawerToShow()},exportData:function(){window.open(u["w"])},screen:function(){this.isShow=!this.isShow},getId:function(t,e){this.formData[e]=t},getSkill:function(){var t=this;this.loading=!0,Object(g["h"])({type:"SKILL"}).then((function(e){t.loading=!1,0===e.ret?t.skillList=e.data:t.$Message.error(e.msg||"接口错误")}))},handleChangeTime:function(t){this.entryTime=t,this.formData.startTime=t[0]||"",this.formData.endTime=t[1]||""},changeTime:function(t){this.formData.createTime=t,this.formData.createStartTime=t[0]||"",this.formData.createEndTime=t[1]||""},remove:function(t){this.jobIds=[t.jobId],this.onDelete()},onDelete:function(){var t=this;this.jobIds?this.$Modal.confirm({title:"提示",content:"<p>确认删除该人才?</p>",onOk:function(){Object(u["p"])({jobId:t.jobIds}).then((function(e){0===e.ret?(t.$Message.success("删除成功"),t.getList()):t.$Message.error(e.msg)}))},onCancel:function(){}}):this.$Message.error("请选择要删除的人才！")},handleChoose:function(t,e){this.formData.clientId=t,this.formData.clientName=e,console.log(this.formData.clientId,"pppp")}}},v=I,w=(a("6323"),a("2877")),y=Object(w["a"])(v,i,o,!1,null,"42648887",null);e["default"]=y.exports},a49e:function(t,e,a){}}]);