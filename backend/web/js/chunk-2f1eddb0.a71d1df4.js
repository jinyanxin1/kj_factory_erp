(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2f1eddb0"],{"08ed":function(t,e,a){},"0ab4":function(t,e,a){},"0adf":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("div",{staticClass:"sx-box",class:t.isShow?" active":"",on:{click:t.screen}},[t._v("\n      筛选 "),a("Icon",{attrs:{type:"ios-arrow-down"}})],1),a("Form",{ref:"formData",staticClass:"form-box",class:t.isShow?"":"none",attrs:{model:t.formData,"label-width":100,inline:""}},[a("Row",[a("FormItem",{attrs:{label:"面试时间：","label-position":"top"}},[a("DatePicker",{attrs:{value:t.time,type:"daterange"},on:{"on-change":t.handleChangeTime}})],1)],1),a("Row",[a("FormItem",{attrs:{label:"状态：","label-position":"top"}},[a("RadioGroup",{model:{value:t.formData.status,callback:function(e){t.$set(t.formData,"status",e)},expression:"formData.status"}},[a("Radio",{attrs:{label:"1"}},[t._v("邀约面试中")]),a("Radio",{attrs:{label:"2"}},[t._v("面试通过")]),a("Radio",{attrs:{label:"3"}},[t._v("面试未通过")]),a("Radio",{attrs:{label:"4"}},[t._v("未参加面试")])],1)],1)],1),a("Row",[a("FormItem",{attrs:{label:"面试公司：","label-position":"top"}},[a("chooseCustomer",{attrs:{id:"clientId",clientId:t.formData.clientId},on:{handleSubmit:t.getId}})],1)],1),a("Row",[a("FormItem",{attrs:{label:"","label-position":"top","label-width":80}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("搜索")]),a("Button",{staticStyle:{"margin-left":"20px"},attrs:{type:"default"},on:{click:function(e){return t.clear("formData")}}},[t._v("重置")])],1)],1)],1)],1),a("Card",[a("div",{staticStyle:{display:"flex","margin-bottom":"10px"}},[a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(e){return t.showResult("2")}}},[t._v("面试通过")]),a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(e){return t.showResult("3")}}},[t._v("面试不过")]),a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(e){return t.showResult("4")}}},[t._v("未参加面试")]),a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:t.showExport}},[t._v("导出")])],1),a("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData},on:{"on-selection-change":t.changeSelect}}),a("div",{staticStyle:{margin:"10px 0",overflow:"hidden","line-height":"32px"}},[a("div",{staticStyle:{float:"left"}},[a("span",[t._v("共 "+t._s(t.pageination.count)+" 条记录")]),a("span",{staticStyle:{"margin-left":"5px"}},[t._v("第"+t._s(t.pageination.page)+"页")])]),a("div",{staticStyle:{float:"right"}},[a("Page",{attrs:{total:Number(t.pageination.count),"page-size":Number(t.pageination.pageSize),current:Number(t.pageination.page)},on:{"on-change":t.changePage}})],1)])],1),a("talentEntry",{ref:"Drawer",on:{getList:t.getList}}),a("interviewResult",{ref:"result",on:{getList:t.getList}}),a("exportInterview",{ref:"down"}),a("talentDetail",{ref:"detail",attrs:{erTitle:t.erTitle},on:{getData:t.getList}})],1)},o=[],s=(a("8e6e"),a("456d"),a("ac6a"),a("7f7f"),a("bd86")),n=a("0b89"),r=a("1f8e"),l=a("eb9c"),c=a("a3df"),m=a("9c3b"),d=a("1808");function u(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function p(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?u(a,!0).forEach((function(e){Object(s["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):u(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var f={components:{talentEntry:r["a"],interviewResult:l["a"],chooseCustomer:c["a"],exportInterview:n["a"],talentDetail:m["a"]},data:function(){var t,e=this;return t={isShow:!1,loading:!0,erTitle:"",status:"",curRow:{},formItem:"",userTypeList:[],tableColumns:[{type:"selection",width:60,align:"center"},{title:"姓名",minWidth:80,key:"jobName",render:function(t,a){return t("div",[t("a",{props:{},style:{marginRight:"5px",width:"80px",height:"20px",display:"inline-block"},on:{click:function(){e.getDetail(a.row,"edit")}}},a.row.jobName)])}},{title:"年龄",minWidth:60,key:"age"},{title:"性别",minWidth:60,key:"sexName"},{title:"手机号",minWidth:100,key:"phone"},{title:"公司/工厂",minWidth:100,key:"client"},{title:"入职岗位",minWidth:80,key:"position"},{title:"面试时间",minWidth:100,key:"time"},{title:"状态",minWidth:100,key:"statusName"},{title:"是否在职",minWidth:100,key:"isEntry",render:function(t,e){if(1===e.row.isEntry)return t("div",[t("div",{props:{type:"primary"},style:{marginRight:"10px"},on:{click:function(){}}},"已入职")])}},{title:"操作",minWidth:300,render:function(t,a){return 2===a.row.status&&0===a.row.isEntry?t("div",[t("Button",{props:{type:"primary"},style:{marginRight:"10px"},on:{click:function(){e.show(a.row)}}},"入职")]):1===a.row.status?t("div",[t("Button",{props:{type:"primary",size:"small"},style:{marginRight:"10px"},on:{click:function(){e.toAction(a.row,"2")}}},"面试通过"),t("Button",{props:{type:"primary",size:"small"},style:{marginRight:"10px"},on:{click:function(){e.toAction(a.row,"3")}}},"面试不过"),t("Button",{props:{type:"primary",size:"small"},style:{marginRight:"10px"},on:{click:function(){e.toAction(a.row,"4")}}},"未参加面试")]):void 0}}],tableData:[],pageination:{page:1,pageSize:2,count:1}},Object(s["a"])(t,"status",""),Object(s["a"])(t,"page",1),Object(s["a"])(t,"formData",{}),Object(s["a"])(t,"selectedArr",[]),Object(s["a"])(t,"jobs",[]),Object(s["a"])(t,"time",[]),t},created:function(){this.getList()},methods:{search:function(){"1"===this.formData.status&&(this.status="1"),this.page=1,this.getList()},clear:function(t){this.page=1,this.time=[],this.selectedArr=[],this.jobs=[],this.formData.status="",this.formData.clientId="",this.formData.startTime="",this.formData.endTime="",this.$refs[t].resetFields(),this.getList()},getList:function(){var t=this;this.loading=!0,Object(d["l"])(p({page:this.page},this.formData)).then((function(e){t.loading=!1,0===e.ret?(t.tableData=e.data.list,t.pageination=e.data.pageInfo):t.$Message.error(e.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getList()},show:function(t){this.$refs.Drawer.DrawerToShow(t)},showExport:function(){this.$refs.down.DrawerToShow()},toAction:function(t,e){console.log(t),this.$refs.result.DrawerToShow([t.interviewId],[t.jobName],e)},showResult:function(t){var e=this;"1"===this.formData.status?this.selectedArr.length>0?this.$refs.result.DrawerToShow(this.selectedArr,this.jobs,t):this.$Message.error("请选择人才"):this.$Modal.confirm({title:"提示",content:"<p>邀约面试中的人才才可以进行此操作，是否进行筛选？</p>",onOk:function(){e.formData.status="1",e.getList()},onCancel:function(){}})},getId:function(t,e){this.formData[e]=t},screen:function(){this.isShow=!this.isShow},changeSelect:function(t){var e=this;this.selectedArr=[],this.jobs=[],t.forEach((function(t){e.selectedArr.push(t.interviewId),e.jobs.push(t.jobName)})),console.log(this.selectedArr)},handleChangeTime:function(t){this.formData.startTime=t[0]||"",this.formData.endTime=t[1]||""},getDetail:function(t){this.erTitle=t.name,this.$refs.detail.DrawerToShow(t.jobId,t.name)}}},h=f,g=(a("2539"),a("2877")),b=Object(g["a"])(h,i,o,!1,null,"b0698f3e",null);e["default"]=b.exports},"0b89":function(t,e,a){"use strict";var i,o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"导出邀约记录",width:620},on:{"on-cancel":function(e){return t.handleReset()}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{model:t.formData,"label-width":130,rules:t.ruleInlie}},[a("FormItem",{attrs:{label:"面试公司：","label-position":"top",prop:"clientId"}},[t.isDisable?a("div",[t._v(t._s(t.clientName))]):t._e(),t.isDisable?t._e():a("chooseCustomer",{attrs:{id:"clientId",clientId:t.formData.clientId},on:{handleSubmit:t.getId}})],1),a("FormItem",{attrs:{label:"状态：","label-position":"top"}},[a("RadioGroup",{model:{value:t.formData.status,callback:function(e){t.$set(t.formData,"status",e)},expression:"formData.status"}},[a("Radio",{attrs:{label:"1"}},[t._v("邀约面试中")]),a("Radio",{attrs:{label:"2"}},[t._v("面试通过")]),a("Radio",{attrs:{label:"3"}},[t._v("面试未通过")]),a("Radio",{attrs:{label:"4"}},[t._v("未参加面试")])],1)],1),a("FormItem",{attrs:{label:"面试时间：","label-position":"top"}},[a("DatePicker",{attrs:{value:t.time,type:"daterange"},on:{"on-change":t.handleChangeTime}})],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset()}}},[t._v("关闭")]),a("Button",{staticStyle:{"margin-left":"8px"},attrs:{type:"primary"},on:{click:function(e){return t.exportData("formData")}}},[t._v("导出")])],1)],2)},s=[],n=a("bd86"),r=(a("7f7f"),a("6b54"),a("a3df")),l=a("1808"),c={components:{chooseCustomer:r["a"]},props:{},data:function(){return{loading:!1,interviEwexport:l["e"],showModal:!1,formData:{clientId:"",startTime:"",endTime:"",status:""},time:[],ruleInlie:{clientId:[{required:!0,message:"请选择面试公司",trigger:"blur"}]},isDisable:!1,clientName:""}},computed:{},watch:{},methods:(i={getId:function(t,e){this.formData[e]=t},DrawerToShow:function(t,e){t&&(this.formData.clientId=t.toString(),this.clientName=e,console.log(e),this.isDisable=!0),this.showModal=!0},handleReset:function(){this.showModal=!1}},Object(n["a"])(i,"getId",(function(t,e){this.formData[e]=t})),Object(n["a"])(i,"handleChangeTime",(function(t){this.time=t,this.formData.startTime=t[0]||"",this.formData.endTime=t[1]||""})),Object(n["a"])(i,"exportData",(function(t){var e=this;console.log("&clientId="+this.formData.clientId+"&status="+this.formData.status+"&startTime="+this.formData.startTime+"&endTime="+this.formData.endTime),this.$refs[t].validate((function(t){t?window.open(e.interviEwexport+"&clientId="+e.formData.clientId+"&status="+e.formData.status+"&startTime="+e.formData.startTime+"&endTime="+e.formData.endTime):e.$Message.error("请选择面试公司!")}))})),i),mounted:function(){},beforeDestroy:function(){},created:function(){}},m=c,d=a("2877"),u=Object(d["a"])(m,o,s,!1,null,"6839e6e2",null);e["a"]=u.exports},"1dcd":function(t,e,a){"use strict";var i=a("d90b"),o=a.n(i);o.a},"1f8e":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"人才入职",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"姓名","label-position":"top"}},[t._v("\n        "+t._s(t.formData.name)+"\n      ")])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"工号","label-position":"top",prop:"jobNumber"}},[a("Input",{model:{value:t.formData.jobNumber,callback:function(e){t.$set(t.formData,"jobNumber",e)},expression:"formData.jobNumber"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"政治面貌","label-position":"top",prop:"politicalStatus"}},[a("Select",{model:{value:t.formData.politicalStatus,callback:function(e){t.$set(t.formData,"politicalStatus",e)},expression:"formData.politicalStatus"}},t._l(t.politicalStatusList,(function(e,i){return a("Option",{key:i,attrs:{value:e.id}},[t._v(t._s(e.value))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"性别","label-position":"top",prop:"sex"}},[a("Select",{model:{value:t.formData.sex,callback:function(e){t.$set(t.formData,"sex",e)},expression:"formData.sex"}},t._l(t.sexList,(function(e,i){return a("Option",{key:i,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"开户银行","label-position":"top",prop:"bank"}},[a("Input",{model:{value:t.formData.bank,callback:function(e){t.$set(t.formData,"bank",e)},expression:"formData.bank"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"银行卡号","label-position":"top",prop:"bankCard"}},[a("Input",{model:{value:t.formData.bankCard,callback:function(e){t.$set(t.formData,"bankCard",e)},expression:"formData.bankCard"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"银行卡","label-position":"top"}},[a("div",{staticStyle:{display:"flex"}},[a("div",{staticClass:"center"},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.bankPositivePic,picName:t.formData.bankPositivePic}},on:{uploadSuccess:t.handleSuccess03}}),a("div",[t._v("正面")])],1),a("div",{staticClass:"center",staticStyle:{"margin-left":"20px"}},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.bankReversePic,picName:t.formData.bankReversePic}},on:{uploadSuccess:t.handleSuccess04}}),a("div",[t._v("反面")])],1)])])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"手机号","label-position":"top"}},[t._v("\n        "+t._s(t.formData.phone)+"\n      ")])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"学历","label-position":"top",prop:"education"}},[a("editSelect",{attrs:{id:"education",iptId:String(t.formData.education),list:t.educationList},on:{handleSubmit:t.callback}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职公司","label-position":"top",prop:"clientId"}},[a("chooseCustomer",{attrs:{id:"clientId",clientId:String(t.formData.clientId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职部门","label-position":"top",prop:"department"}},[a("Input",{model:{value:t.formData.department,callback:function(e){t.$set(t.formData,"department",e)},expression:"formData.department"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"住址","label-position":"top",prop:"address"}},[a("Input",{model:{value:t.formData.address,callback:function(e){t.$set(t.formData,"address",e)},expression:"formData.address"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"合同时间","label-position":"top"}},[a("Date-picker",{staticStyle:{width:"100%"},attrs:{type:"daterange"},on:{"on-change":t.handleChangeTime}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"身份证号","label-position":"top",prop:"idCard"}},[a("Input",{model:{value:t.formData.idCard,callback:function(e){t.$set(t.formData,"idCard",e)},expression:"formData.idCard"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"身份证","label-position":"top"}},[a("div",{staticStyle:{display:"flex"}},[a("div",{staticClass:"center"},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.idCardPositivePic,picName:t.formData.idCardPositivePic}},on:{uploadSuccess:t.handleSuccess01}}),a("div",[t._v("人像面")])],1),a("div",{staticClass:"center",staticStyle:{"margin-left":"20px"}},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.idCardReversePic,picName:t.formData.idCardReversePic}},on:{uploadSuccess:t.handleSuccess02}}),a("div",[t._v("国徽面")])],1)])])],1),t._l(t.formData.emergency,(function(e,i){return e.status?a("Col",{key:i,attrs:{xs:24}},[a("Col",{attrs:{xs:24,md:10}},[a("FormItem",{attrs:{label:"紧急联系人"+e.index,"label-position":"top",prop:"emergency."+i+".name",rules:{required:!0,message:"联系人姓名 "+e.index+" 不能为空",trigger:"blur"}}},[a("Input",{model:{value:e.name,callback:function(a){t.$set(e,"name",a)},expression:"item.name"}})],1)],1),a("Col",{attrs:{xs:24,md:10}},[a("FormItem",{attrs:{label:"紧急联系人电话"+e.index,"label-position":"top",prop:"emergency."+i+".phone",rules:{required:!0,message:"联系人电话 "+e.index+" 不能为空",trigger:"blur"}}},[a("Input",{model:{value:e.phone,callback:function(a){t.$set(e,"phone",a)},expression:"item.phone"}})],1)],1),a("Col",{attrs:{xs:24,md:4}},[a("Button",{staticStyle:{"margin-left":"10px"},on:{click:function(e){return t.handleRemove(i)}}},[t._v("删除")])],1)],1):t._e()})),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"","label-position":"top",prop:""}},[a("Button",{attrs:{type:"dashed",icon:"md-add"},on:{click:t.handleAdd}},[t._v("添加紧急联系人")])],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职岗位","label-position":"top",prop:"position"}},[a("Input",{model:{value:t.formData.position,callback:function(e){t.$set(t.formData,"position",e)},expression:"formData.position"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"第一次买社保","label-position":"top",prop:"first"}},[a("RadioGroup",{model:{value:t.formData.first,callback:function(e){t.$set(t.formData,"first",e)},expression:"formData.first"}},[a("Radio",{attrs:{label:"0"}},[t._v("是")]),a("Radio",{attrs:{label:"1"}},[t._v("否")])],1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职时间","label-position":"top",prop:"time"}},[a("DatePicker",{attrs:{value:t.formData.time,type:"date"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试时间","label-position":"top",prop:"interviewTime"}},[a("DatePicker",{attrs:{value:t.formData.interviewTime,type:"date"},on:{"on-change":function(e){t.formData.interviewTime=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"社保","label-position":"top",prop:"socialSecurity"}},[a("Select",{attrs:{multiple:""},model:{value:t.formData.socialSecurity,callback:function(e){t.$set(t.formData,"socialSecurity",e)},expression:"formData.socialSecurity"}},t._l(t.baseList,(function(e,i){return a("Option",{key:i,attrs:{value:e.basisId}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"培训时间","label-position":"top",prop:"trainTime"}},[a("DatePicker",{attrs:{value:t.formData.trainTime,type:"date"},on:{"on-change":function(e){t.formData.trainTime=e}}})],1)],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"劳动合同(最多20张)","label-width":150}},[a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸: 800*1100px，图片大小不超过3M。")]),a("uploadImgList",{attrs:{id:"laborContractPic",picArr:[]},on:{uploadSuccess:t.handleSuccess}})],1)],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"体检报告(最多20张)","label-width":150}},[a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸: 800*1100px，图片大小不超过3M。")]),a("uploadImgList",{attrs:{id:"cedicalReportPic",picArr:[]},on:{uploadSuccess:t.handleSuccess2}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"备注","label-position":"top",prop:"remark"}},[a("Input",{attrs:{type:"textarea",rows:6,placeholder:"最多输入200个字符"},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],2)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},o=[],s=(a("7f7f"),a("6bcd")),n=a("a3df"),r=a("a46c"),l=a("40cb"),c=a("1808"),m=a("9411"),d={components:{editSelect:s["a"],chooseCustomer:n["a"],uploadImgList:r["a"],uploadImgCom:l["a"]},props:{},data:function(){return{showModal:!1,politicalStatusList:[{id:1,value:"团员"},{id:2,value:"党员"},{id:3,value:"群众"},{id:4,value:"其他"}],educationList:[{id:"1",name:"初中及以下"},{id:"2",name:"中专/中技"},{id:"3",name:"高中"},{id:"4",name:"大专"},{id:"5",name:"本科"},{id:"6",name:"硕士"},{id:"6",name:"博士"}],sexList:[{id:"0",name:"女"},{id:"1",name:"男"}],index:1,formData:{name:"",sex:"",interviewTime:"",trainTime:"",clientId:"",time:"",emergencyContact:"",idCard:"",emergencyTell:"",emergency:[{name:"",phone:"",index:1,status:1}],idCardPositivePic:"",idCardReversePic:"",bankReversePic:"",bankPositivePic:"",jobNumber:""},baseList:[],ruleInline:{sex:[{required:!0,type:"string",message:"请选择性别",trigger:"change"}],time:[{required:!0,type:"string",message:"请选择入职时间",trigger:"change"}],interviewTime:[{required:!0,type:"string",message:"请选择面试时间",trigger:"change"}],trainTime:[{required:!0,type:"string",message:"请选择培训时间",trigger:"change"}],clientId:[{required:!0,message:"请选择入职公司",trigger:"blur"}],department:[{required:!0,message:"请输入入职部门",trigger:"blur"}],idCard:[{required:!0,message:"请输入身份证号码",trigger:"blur"}]},times:[]}},computed:{},watch:{},methods:{getBase:function(){var t=this;Object(m["h"])({type:"SOCIAL_SECURITY"}).then((function(e){t.baseList=e.data}))},getInfo:function(t){var e=this;Object(c["q"])({jobId:t}).then((function(t){e.formData.name=t.data.info.name,e.formData.phone=t.data.info.phone,e.formData.sex=t.data.info.sex+"",e.formData.education=t.data.info.education,e.formData.remark=t.data.info.remark}))},DrawerToShow:function(t){this.formData.jobId=t.jobId,this.formData.clientId=t.clientId,this.showModal=!0,this.getInfo(t.jobId),this.getBase()},handleReset:function(t){this.showModal=!1,this.times=[],this.formData={idCardPositivePic:"",idCardReversePic:"",bankReversePic:"",bankPositivePic:""},this.$refs[t].resetFields()},callback:function(t,e){this.formData[t]=e},handleSubmit:function(t){var e=this;Object(c["o"])(this.formData).then((function(a){e.$Message.success("保存成功！"),e.$emit("getData"),e.showModal=!1,e.times=[],e.$refs[t].resetFields()}))},handleChangeTime:function(t){this.times=t,this.formData.startTime=t[0]||"",this.formData.endTime=t[1]||""},handleSuccess:function(t){this.formData.laborContractPic=t},handleSuccess2:function(t){this.formData.cedicalReportPic=t},getId:function(t,e){this.formData[e]=t},handleAdd:function(){this.index++,this.formData.emergency.push({name:"",phone:"",index:this.index,status:1})},handleRemove:function(t){this.formData.emergency[t].status=0},handleSuccess01:function(t){this.formData.idCardPositivePic=t.pic},handleSuccess02:function(t){this.formData.idCardReversePic=t.pic},handleSuccess03:function(t){this.formData.bankPositivePic=t.pic},handleSuccess04:function(t){this.formData.bankReversePic=t.pic}},mounted:function(){},beforeDestroy:function(){},created:function(){}},u=d,p=(a("1dcd"),a("2877")),f=Object(p["a"])(u,i,o,!1,null,"6e460386",null);e["a"]=f.exports},2539:function(t,e,a){"use strict";var i=a("08ed"),o=a.n(i);o.a},"53c5":function(t,e,a){"use strict";var i=a("0ab4"),o=a.n(i);o.a},a46c:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:t.id}},[t._l(t.uploadList,(function(e,o){return i("div",{key:o,staticClass:"demo-upload-list"},[t.uploadList.length>0?i("div",[i("img",{attrs:{src:t.demainUrl+e}}),i("div",{staticClass:"demo-upload-list-cover"},[i("Icon",{attrs:{type:"ios-eye-outline"},on:{click:function(e){return t.handleView(o,t.id)}}}),i("Icon",{attrs:{type:"ios-trash-outline"},on:{click:function(e){return t.handleRemove(o)}}})],1)]):[e.showProgress?i("Progress",{attrs:{percent:e.percentage,"hide-info":""}}):t._e(),t.loadingImg?i("img",{staticStyle:{display:"inline-block",width:"30px",height:"30px","margin-top":"25px"},attrs:{src:a("bcdd")}}):t._e()]],2)})),i("Upload",{ref:"upload",staticStyle:{display:"inline-block",width:"98px"},attrs:{name:"img","show-upload-list":!1,"on-success":t.handleSuccess,format:["jpg","jpeg","png"],"max-size":3072,"on-format-error":t.handleFormatError,"on-exceeded-size":t.handleMaxSize,"before-upload":t.handleBeforeUpload,type:"drag",action:t.uploadImg}},[i("div",{staticStyle:{width:"98px",height:"98px","line-height":"98px"}},[t.loadingImg?t._e():i("Icon",{attrs:{type:"ios-camera",size:"30"}}),t.loadingImg?i("img",{staticStyle:{display:"inline-block",width:"50px",height:"50px","margin-top":"25px"},attrs:{src:a("12ae")}}):t._e()],1)])],2)},o=[],s=(a("7f7f"),a("c82c")),n=a.n(s),r=(a("0808"),a("c276")),l=a("7e1e"),c={data:function(){return{uploadImg:l["a"],imgName:"",visible:!1,loadingImg:!1,uploadList:[],demainUrl:r["a"].cookies.get("domainUrl")}},props:{picArr:{type:Array,default:[]},id:{type:String,default:""}},watch:{picArr:function(t){this.computeArr=t},id:function(t){console.log(t)}},computed:{computeArr:{get:function(){return this.uploadList},set:function(t){this.uploadList=t}}},mounted:function(){},methods:{handleView:function(t,e){console.log(t,e,"==========");var a=new n.a(document.getElementById(e),{initialViewIndex:t,title:!1,navbar:!1,hidden:function(){a.destroy()}});a.show()},handleRemove:function(t){this.loadingImg=!1,this.uploadList.splice(t,1),this.$emit("uploadSuccess",this.uploadList)},handleSuccess:function(t,e){this.loadingImg=!1,e.url=t.data.imgUrl,e.name=t.data.url,this.uploadList.push(e.name),this.$emit("uploadSuccess",this.uploadList)},handleFormatError:function(t){this.loadingImg=!1,this.$Notice.warning({title:"文件格式不正确",desc:"文件 "+t.name+" 格式不正确，请上传 jpg 或 png 格式的图片。"})},handleMaxSize:function(t){this.loadingImg=!1,this.$Notice.warning({title:"超出文件大小限制",desc:"文件 "+t.name+" 太大，不能超过 3M。"})},handleBeforeUpload:function(){console.log(this.uploadList),this.loadingImg=!0;var t=this.uploadList.length<20;return t||this.$Notice.warning({title:"最多只能上传 20 张图片。"}),t}}},m=c,d=(a("53c5"),a("2877")),u=Object(d["a"])(m,i,o,!1,null,null,null);e["a"]=u.exports},bcdd:function(t,e){t.exports="data:image/gif;base64,R0lGODlhJQAlAJECAL3L2AYrTv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgACACwAAAAAJQAlAAACi5SPqcvtDyGYIFpF690i8xUw3qJBwUlSadmcLqYmGQu6KDIeM13beGzYWWy3DlB4IYaMk+Dso2RWkFCfLPcRvFbZxFLUDTt21BW56TyjRep1e20+i+eYMR145W2eefj+6VFmgTQi+ECVY8iGxcg35phGo/iDFwlTyXWphwlm1imGRdcnuqhHeop6UAAAIfkEBQoAAgAsEAACAAQACwAAAgWMj6nLXAAh+QQFCgACACwVAAUACgALAAACFZQvgRi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwXABEADAADAAACBYyPqcsFACH5BAUKAAIALBUAFQAKAAsAAAITlGKZwWoMHYxqtmplxlNT7ixGAQAh+QQFCgACACwQABgABAALAAACBYyPqctcACH5BAUKAAIALAUAFQAKAAsAAAIVlC+BGL3Z3IlxUmUuhtR2LzHhsiEFACH5BAUKAAIALAEAEQAMAAMAAAIFjI+pywUAIfkEBQoAAgAsBQAFAAoACwAAAhOUYJnAagwdjGq2amXGU1PuLEYBACH5BAUKAAIALBAAAgAEAAsAAAIFhI+py1wAIfkEBQoAAgAsFQAFAAoACwAAAhWUL4AIvdnciXFSZS6G1HYvMeGyIQUAIfkEBQoAAgAsFwARAAwAAwAAAgWEj6nLBQAh+QQFCgACACwVABUACgALAAACE5RgmcBqDB2MarZqZcZTU+4sRgEAIfkEBQoAAgAsEAAYAAQACwAAAgWEj6nLXAAh+QQFCgACACwFABUACgALAAACFZQvgAi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwBABEADAADAAACBYSPqcsFADs="},d90b:function(t,e,a){},eb9c:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{title:t.erTitle,"mask-closable":!1,width:620},on:{"on-cancel":function(e){return t.handleReset()}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("div",{staticStyle:{"font-size":"16px","text-align":"center"}},["2"===this.status?a("div",[t._l(t.names,(function(e,i){return a("span",{key:i,staticStyle:{color:"red","font-weight":"bold"}},[t._v('"'+t._s(e)+'" ')])})),t._v("面试通过！确定此操作？\n    ")],2):t._e(),"3"===this.status?a("div",[t._l(t.names,(function(e,i){return a("span",{key:i,staticStyle:{color:"red"}},[t._v('"'+t._s(e)+'" ')])})),t._v("面试未通过！确定此操作？\n    ")],2):t._e(),"4"===this.status?a("div",[t._l(t.names,(function(e,i){return a("span",{key:i,staticStyle:{color:"red"}},[t._v('"'+t._s(e)+'" ')])})),t._v("未参加面试！确定此操作？\n    ")],2):t._e()]),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset()}}},[t._v("取消")]),a("Button",{staticStyle:{"margin-left":"8px"},attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit()}}},[t._v("确定")])],1)],2)},o=[],s=a("1808"),n={components:{},props:{},data:function(){return{showModal:!1,ids:[],names:[],status:"",erTitle:""}},computed:{},watch:{},methods:{DrawerToShow:function(t,e,a){console.log(t,e,a,"======"),this.ids=t,this.names=e,this.status=a,this.showModal=!0,"2"===this.status?this.erTitle="面试通过":"3"===this.status?this.erTitle="面试未通过":"4"===this.status&&(this.erTitle="未参加面试")},handleReset:function(){this.showModal=!1},handleSubmit:function(){var t=this;Object(s["g"])({status:this.status,interviewId:this.ids}).then((function(e){0===e.ret?(t.$Message.success("操作成功！"),t.$emit("getList"),t.showModal=!1):t.$Message.error(e.msg||"网络错误")}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},r=n,l=a("2877"),c=Object(l["a"])(r,i,o,!1,null,"3b9abe50",null);e["a"]=c.exports}}]);