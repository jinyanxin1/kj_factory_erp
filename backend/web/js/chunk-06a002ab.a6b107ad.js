(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-06a002ab"],{"04fc":function(t,e,a){},"0639":function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"人才离职",width:600},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"姓名","label-position":"top"}},[t._v("\n        "+t._s(t.jobName)+"\n      ")])],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"离职时间","label-position":"top",prop:"time"}},[a("DatePicker",{attrs:{value:t.formData.time,format:"yyyy-MM-dd",type:"date",placeholder:"选择时间"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"离职类型","label-position":"top",prop:"leaveType"}},[a("Select",{model:{value:t.formData.leaveType,callback:function(e){t.$set(t.formData,"leaveType",e)},expression:"formData.leaveType"}},[a("Option",{attrs:{value:1}},[t._v("自离")]),a("Option",{attrs:{value:2}},[t._v("辞职")]),a("Option",{attrs:{value:3}},[t._v("辞退")]),a("Option",{attrs:{value:4}},[t._v("转正")])],1)],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"原因","label-position":"top",prop:"leaveReason"}},[a("Input",{attrs:{type:"textarea",rows:6,placeholder:"最多输入200个字符"},model:{value:t.formData.leaveReason,callback:function(e){t.$set(t.formData,"leaveReason",e)},expression:"formData.leaveReason"}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"附件","label-position":"top"}},[a("div",[t._v("（可以上传离职协议与离职证明等）")]),a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸: 800*1100px，图片大小不超过3M。")]),a("uploadImgList",{attrs:{id:"leavePic",picArr:[]},on:{uploadSuccess:t.handleSuccess}})],1)],1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},i=[],s=(a("7f7f"),a("a46c")),r=a("1808"),n={components:{uploadImgList:s["a"]},props:{},data:function(){return{loading:!0,showModal:!1,jobName:"",formData:{time:""},ruleInline:{time:[{required:!0,type:"string",message:"请选择离职时间",trigger:"change"}],leaveReason:[{required:!0,message:"请输入离职原因",trigger:"blur"}],leaveType:[{required:!0,type:"number",message:"请选择离职类型",trigger:"change"}]}}},computed:{},watch:{},methods:{DrawerToShow:function(t,e){this.formData.jobId=t,this.jobName=e,this.showModal=!0,this.loading=!0},handleReset:function(t){this.showModal=!1,this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;this.$refs[t].validate((function(a){a?Object(r["r"])(e.formData).then((function(a){e.$Message.success("已离职！"),e.showModal=!1,e.$refs[t].resetFields(),e.$emit("getData")})):e.$Message.error("表单验证失败!")}))},handleSuccess:function(t){this.formData.leavePic=t}},mounted:function(){console.log(this.empPosition)},beforeDestroy:function(){},created:function(){}},l=n,c=(a("998f"),a("2877")),d=Object(c["a"])(l,o,i,!1,null,"3ecc3ccb",null);e["a"]=d.exports},"0ab4":function(t,e,a){},"17b2":function(t,e,a){"use strict";var o=a("83d2"),i=a.n(o);i.a},"1dcd":function(t,e,a){"use strict";var o=a("d90b"),i=a.n(o);i.a},"1f8e":function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"人才入职",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"姓名","label-position":"top"}},[t._v("\n        "+t._s(t.formData.name)+"\n      ")])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"工号","label-position":"top",prop:"jobNumber"}},[a("Input",{model:{value:t.formData.jobNumber,callback:function(e){t.$set(t.formData,"jobNumber",e)},expression:"formData.jobNumber"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"政治面貌","label-position":"top",prop:"politicalStatus"}},[a("Select",{model:{value:t.formData.politicalStatus,callback:function(e){t.$set(t.formData,"politicalStatus",e)},expression:"formData.politicalStatus"}},t._l(t.politicalStatusList,(function(e,o){return a("Option",{key:o,attrs:{value:e.id}},[t._v(t._s(e.value))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"性别","label-position":"top",prop:"sex"}},[a("Select",{model:{value:t.formData.sex,callback:function(e){t.$set(t.formData,"sex",e)},expression:"formData.sex"}},t._l(t.sexList,(function(e,o){return a("Option",{key:o,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"开户银行","label-position":"top",prop:"bank"}},[a("Input",{model:{value:t.formData.bank,callback:function(e){t.$set(t.formData,"bank",e)},expression:"formData.bank"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"银行卡号","label-position":"top",prop:"bankCard"}},[a("Input",{model:{value:t.formData.bankCard,callback:function(e){t.$set(t.formData,"bankCard",e)},expression:"formData.bankCard"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"银行卡","label-position":"top"}},[a("div",{staticStyle:{display:"flex"}},[a("div",{staticClass:"center"},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.bankPositivePic,picName:t.formData.bankPositivePic}},on:{uploadSuccess:t.handleSuccess03}}),a("div",[t._v("正面")])],1),a("div",{staticClass:"center",staticStyle:{"margin-left":"20px"}},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.bankReversePic,picName:t.formData.bankReversePic}},on:{uploadSuccess:t.handleSuccess04}}),a("div",[t._v("反面")])],1)])])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"手机号","label-position":"top"}},[t._v("\n        "+t._s(t.formData.phone)+"\n      ")])],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"学历","label-position":"top",prop:"education"}},[a("editSelect",{attrs:{id:"education",iptId:String(t.formData.education),list:t.educationList},on:{handleSubmit:t.callback}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职公司","label-position":"top",prop:"clientId"}},[a("chooseCustomer",{attrs:{id:"clientId",clientId:String(t.formData.clientId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职部门","label-position":"top",prop:"department"}},[a("Input",{model:{value:t.formData.department,callback:function(e){t.$set(t.formData,"department",e)},expression:"formData.department"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"住址","label-position":"top",prop:"address"}},[a("Input",{model:{value:t.formData.address,callback:function(e){t.$set(t.formData,"address",e)},expression:"formData.address"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"合同时间","label-position":"top"}},[a("Date-picker",{staticStyle:{width:"100%"},attrs:{type:"daterange"},on:{"on-change":t.handleChangeTime}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"身份证号","label-position":"top",prop:"idCard"}},[a("Input",{model:{value:t.formData.idCard,callback:function(e){t.$set(t.formData,"idCard",e)},expression:"formData.idCard"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"身份证","label-position":"top"}},[a("div",{staticStyle:{display:"flex"}},[a("div",{staticClass:"center"},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.idCardPositivePic,picName:t.formData.idCardPositivePic}},on:{uploadSuccess:t.handleSuccess01}}),a("div",[t._v("人像面")])],1),a("div",{staticClass:"center",staticStyle:{"margin-left":"20px"}},[a("uploadImgCom",{attrs:{picArr:{pic:t.formData.idCardReversePic,picName:t.formData.idCardReversePic}},on:{uploadSuccess:t.handleSuccess02}}),a("div",[t._v("国徽面")])],1)])])],1),t._l(t.formData.emergency,(function(e,o){return e.status?a("Col",{key:o,attrs:{xs:24}},[a("Col",{attrs:{xs:24,md:10}},[a("FormItem",{attrs:{label:"紧急联系人"+e.index,"label-position":"top",prop:"emergency."+o+".name",rules:{required:!0,message:"联系人姓名 "+e.index+" 不能为空",trigger:"blur"}}},[a("Input",{model:{value:e.name,callback:function(a){t.$set(e,"name",a)},expression:"item.name"}})],1)],1),a("Col",{attrs:{xs:24,md:10}},[a("FormItem",{attrs:{label:"紧急联系人电话"+e.index,"label-position":"top",prop:"emergency."+o+".phone",rules:{required:!0,message:"联系人电话 "+e.index+" 不能为空",trigger:"blur"}}},[a("Input",{model:{value:e.phone,callback:function(a){t.$set(e,"phone",a)},expression:"item.phone"}})],1)],1),a("Col",{attrs:{xs:24,md:4}},[a("Button",{staticStyle:{"margin-left":"10px"},on:{click:function(e){return t.handleRemove(o)}}},[t._v("删除")])],1)],1):t._e()})),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"","label-position":"top",prop:""}},[a("Button",{attrs:{type:"dashed",icon:"md-add"},on:{click:t.handleAdd}},[t._v("添加紧急联系人")])],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职岗位","label-position":"top",prop:"position"}},[a("Input",{model:{value:t.formData.position,callback:function(e){t.$set(t.formData,"position",e)},expression:"formData.position"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"第一次买社保","label-position":"top",prop:"first"}},[a("RadioGroup",{model:{value:t.formData.first,callback:function(e){t.$set(t.formData,"first",e)},expression:"formData.first"}},[a("Radio",{attrs:{label:"0"}},[t._v("是")]),a("Radio",{attrs:{label:"1"}},[t._v("否")])],1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"入职时间","label-position":"top",prop:"time"}},[a("DatePicker",{attrs:{value:t.formData.time,type:"date"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试时间","label-position":"top",prop:"interviewTime"}},[a("DatePicker",{attrs:{value:t.formData.interviewTime,type:"date"},on:{"on-change":function(e){t.formData.interviewTime=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"社保","label-position":"top",prop:"socialSecurity"}},[a("Select",{attrs:{multiple:""},model:{value:t.formData.socialSecurity,callback:function(e){t.$set(t.formData,"socialSecurity",e)},expression:"formData.socialSecurity"}},t._l(t.baseList,(function(e,o){return a("Option",{key:o,attrs:{value:e.basisId}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"培训时间","label-position":"top",prop:"trainTime"}},[a("DatePicker",{attrs:{value:t.formData.trainTime,type:"date"},on:{"on-change":function(e){t.formData.trainTime=e}}})],1)],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"劳动合同(最多20张)","label-width":150}},[a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸: 800*1100px，图片大小不超过3M。")]),a("uploadImgList",{attrs:{id:"laborContractPic",picArr:[]},on:{uploadSuccess:t.handleSuccess}})],1)],1),a("Col",{attrs:{xs:24}},[a("FormItem",{attrs:{label:"体检报告(最多20张)","label-width":150}},[a("div",{staticStyle:{color:"#bbb"}},[t._v("建议尺寸: 800*1100px，图片大小不超过3M。")]),a("uploadImgList",{attrs:{id:"cedicalReportPic",picArr:[]},on:{uploadSuccess:t.handleSuccess2}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"备注","label-position":"top",prop:"remark"}},[a("Input",{attrs:{type:"textarea",rows:6,placeholder:"最多输入200个字符"},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],2)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},i=[],s=(a("7f7f"),a("6bcd")),r=a("a3df"),n=a("a46c"),l=a("40cb"),c=a("1808"),d=a("9411"),m={components:{editSelect:s["a"],chooseCustomer:r["a"],uploadImgList:n["a"],uploadImgCom:l["a"]},props:{},data:function(){return{showModal:!1,politicalStatusList:[{id:1,value:"团员"},{id:2,value:"党员"},{id:3,value:"群众"},{id:4,value:"其他"}],educationList:[{id:"1",name:"初中及以下"},{id:"2",name:"中专/中技"},{id:"3",name:"高中"},{id:"4",name:"大专"},{id:"5",name:"本科"},{id:"6",name:"硕士"},{id:"6",name:"博士"}],sexList:[{id:"0",name:"女"},{id:"1",name:"男"}],index:1,formData:{name:"",sex:"",interviewTime:"",trainTime:"",clientId:"",time:"",emergencyContact:"",idCard:"",emergencyTell:"",emergency:[{name:"",phone:"",index:1,status:1}],idCardPositivePic:"",idCardReversePic:"",bankReversePic:"",bankPositivePic:"",jobNumber:""},baseList:[],ruleInline:{sex:[{required:!0,type:"string",message:"请选择性别",trigger:"change"}],time:[{required:!0,type:"string",message:"请选择入职时间",trigger:"change"}],interviewTime:[{required:!0,type:"string",message:"请选择面试时间",trigger:"change"}],trainTime:[{required:!0,type:"string",message:"请选择培训时间",trigger:"change"}],clientId:[{required:!0,message:"请选择入职公司",trigger:"blur"}],department:[{required:!0,message:"请输入入职部门",trigger:"blur"}],idCard:[{required:!0,message:"请输入身份证号码",trigger:"blur"}]},times:[]}},computed:{},watch:{},methods:{getBase:function(){var t=this;Object(d["h"])({type:"SOCIAL_SECURITY"}).then((function(e){t.baseList=e.data}))},getInfo:function(t){var e=this;Object(c["q"])({jobId:t}).then((function(t){e.formData.name=t.data.info.name,e.formData.phone=t.data.info.phone,e.formData.sex=t.data.info.sex+"",e.formData.education=t.data.info.education,e.formData.remark=t.data.info.remark}))},DrawerToShow:function(t){this.formData.jobId=t.jobId,this.formData.clientId=t.clientId,this.showModal=!0,this.getInfo(t.jobId),this.getBase()},handleReset:function(t){this.showModal=!1,this.times=[],this.formData={idCardPositivePic:"",idCardReversePic:"",bankReversePic:"",bankPositivePic:""},this.$refs[t].resetFields()},callback:function(t,e){this.formData[t]=e},handleSubmit:function(t){var e=this;Object(c["o"])(this.formData).then((function(a){e.$Message.success("保存成功！"),e.$emit("getData"),e.showModal=!1,e.times=[],e.$refs[t].resetFields()}))},handleChangeTime:function(t){this.times=t,this.formData.startTime=t[0]||"",this.formData.endTime=t[1]||""},handleSuccess:function(t){this.formData.laborContractPic=t},handleSuccess2:function(t){this.formData.cedicalReportPic=t},getId:function(t,e){this.formData[e]=t},handleAdd:function(){this.index++,this.formData.emergency.push({name:"",phone:"",index:this.index,status:1})},handleRemove:function(t){this.formData.emergency[t].status=0},handleSuccess01:function(t){this.formData.idCardPositivePic=t.pic},handleSuccess02:function(t){this.formData.idCardReversePic=t.pic},handleSuccess03:function(t){this.formData.bankPositivePic=t.pic},handleSuccess04:function(t){this.formData.bankReversePic=t.pic}},mounted:function(){},beforeDestroy:function(){},created:function(){}},u=m,p=(a("1dcd"),a("2877")),f=Object(p["a"])(u,o,i,!1,null,"6e460386",null);e["a"]=f.exports},"3efd":function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"邀约面试",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"姓名","label-position":"top"}},t._l(t.jobNames,(function(e,o){return a("span",{key:o,staticStyle:{"margin-right":"10px"}},[t._v(t._s(e)+" ")])})),0)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试时间","label-position":"top",prop:"time"}},[a("DatePicker",{attrs:{value:t.formData.time,type:"datetime",placeholder:"选择时间"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"公司","label-position":"top"}},[a("chooseCustomer",{attrs:{invite:!0,id:"clientId",clientId:String(t.formData.clientId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试岗位","label-position":"top",prop:"position"}},[a("Input",{model:{value:t.formData.position,callback:function(e){t.$set(t.formData,"position",e)},expression:"formData.position"}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"内容","label-position":"top",prop:"remark"}},[a("Input",{attrs:{type:"textarea",rows:6,placeholder:"最多输入200个字符"},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},i=[],s=(a("7f7f"),a("6b54"),a("a3df")),r=a("1808"),n={components:{chooseCustomer:s["a"]},props:{},data:function(){return{showModal:!1,formData:{time:"",position:"",clientId:"",jobId:"",remark:""},ruleInline:{time:[{required:!0,type:"string",message:"请选择面试时间",trigger:"change"}],position:[{required:!0,message:"请输入面试岗位",trigger:"blur"}],remark:[{required:!0,message:"请输入面试内容",trigger:"blur"}]},jobNames:[],fromPage:""}},computed:{},watch:{},methods:{DrawerToShow:function(t,e,a,o){this.fromPage=a,this.jobNames=e,this.showModal=!0,"enroll"===a?(this.formData.clientId=o.clientId.toString(),this.formData.jobId=o.jobId,this.formData.position=o.recruitmentPost,this.formData.time=o.createTime):this.formData.jobId=t},handleReset:function(t){this.showModal=!1,this.$refs[t].resetFields()},getId:function(t,e){this.formData[e]=t,console.log(t,"++++++")},handleSubmit:function(t){var e=this;console.log(this.formData.clientId),this.formData.clientId?this.$refs[t].validate((function(a){a?"enroll"===e.fromPage?Object(r["b"])(e.formData).then((function(a){e.$Message.success("邀约成功！"),e.showModal=!1,e.$refs[t].resetFields(),e.$emit("getData")})):Object(r["a"])(e.formData).then((function(a){e.$Message.success("邀约成功！"),e.showModal=!1,e.$refs[t].resetFields(),e.$emit("getData")})):e.$Message.error("表单验证失败!")})):this.$Message.warning("请选择面试公司！")}},mounted:function(){},beforeDestroy:function(){},created:function(){}},l=n,c=(a("abd4"),a("2877")),d=Object(c["a"])(l,o,i,!1,null,"f857c2ba",null);e["a"]=d.exports},"53c5":function(t,e,a){"use strict";var o=a("0ab4"),i=a.n(o);i.a},"5b56":function(t,e,a){},"62df":function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"导入人才",width:620},on:{"on-cancel":function(e){return t.handleReset()}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{attrs:{model:t.formData,"label-width":130}},[a("FormItem",{attrs:{label:"供应商：","label-position":"top"}},[a("chooseSupplier",{attrs:{id:"supplierId",propId:String(t.formData.supplierId)},on:{handleSubmit:t.getId}})],1),a("FormItem",{attrs:{label:"招聘专员：","label-position":"top"}},[a("chooseStaff",{attrs:{id:"staffId",staffId:String(t.formData.staffId)},on:{handleSubmit:t.getId}})],1),a("FormItem",[a("Upload",{ref:"upload",attrs:{name:"file","show-upload-list":!1,format:["xls","xlsx"],"on-error":t.uploadFalse,"on-success":t.uploadSuccess,"on-format-error":t.handleFormatError,data:t.formData,"auto-upload":!1,"before-upload":t.beforeAvatarUpload,action:t.jobImport}},[a("Button",{attrs:{type:"default",icon:"ios-cloud-upload-outline",disabled:t.loading}},[t._v("\n                导入人才\n              ")])],1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset()}}},[t._v("关闭")])],1)],2)},i=[],s=(a("7f7f"),a("e6a1")),r=a("062f"),n=a("c276"),l=a("1808"),c={components:{chooseStaff:s["a"],chooseSupplier:r["a"]},props:{},data:function(){return{loading:!1,jobImport:l["i"],showModal:!1,recordId:"",demainUrl:n["a"].cookies.get("domainUrl"),formData:{supplierId:"",staffId:""}}},computed:{},watch:{showModal:function(t){this.formData.staffId=n["a"].cookies.get("staffId")}},methods:{getId:function(t,e){this.formData[e]=t},DrawerToShow:function(t){this.formData={supplierId:"",staffId:""},this.showModal=!0},handleReset:function(){this.showModal=!1},uploadSuccess:function(t,e){this.loading=!1,0==t.ret?(this.$Message.success("上传成功！"),this.$emit("getData"),this.showModal=!1):this.$Message.warning(t.msg)},uploadFalse:function(t,e){alert("文件上传失败！")},handleFormatError:function(t){return this.$Message.warning({content:"文件 "+t.name+" 格式不正确，请上传.xls,.xlsx文件。",duration:4,closable:!0}),this.loading=!1,!1},beforeAvatarUpload:function(t){if(!this.formData.supplierId)return this.$Message.error("请选择供应商"),!1}},mounted:function(){},beforeDestroy:function(){},created:function(){}},d=c,m=a("2877"),u=Object(m["a"])(d,o,i,!1,null,"6ba664c8",null);e["a"]=u.exports},"83d2":function(t,e,a){},8690:function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:"新增人才",width:1e3},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"姓名","label-position":"top",prop:"name"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"年龄","label-position":"top",prop:"age"}},[a("Input",{model:{value:t.formData.age,callback:function(e){t.$set(t.formData,"age",e)},expression:"formData.age"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"性别","label-position":"top",prop:"sex"}},[a("Select",{model:{value:t.formData.sex,callback:function(e){t.$set(t.formData,"sex",e)},expression:"formData.sex"}},[a("Option",{attrs:{value:"1"}},[t._v("男")]),a("Option",{attrs:{value:"0"}},[t._v("女")])],1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"手机号","label-position":"top",prop:"phone"}},[a("Input",{model:{value:t.formData.phone,callback:function(e){t.$set(t.formData,"phone",e)},expression:"formData.phone"}})],1)],1)],1),a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"出生日期","label-position":"top",prop:"birthday"}},[a("Date-picker",{attrs:{value:t.formData.birthday,type:"date",placeholder:"选择出生日期"},on:{"on-change":function(e){t.formData.birthday=e}}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"学历","label-position":"top",prop:"education"}},[a("Select",{model:{value:t.formData.education,callback:function(e){t.$set(t.formData,"education",e)},expression:"formData.education"}},t._l(t.educationList,(function(e,o){return a("Option",{key:o,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"技能","label-position":"top",prop:"skillId"}},[a("Select",{attrs:{multiple:""},model:{value:t.formData.skillId,callback:function(e){t.$set(t.formData,"skillId",e)},expression:"formData.skillId"}},t._l(t.skillList,(function(e,o){return a("Option",{key:o,attrs:{value:e.basisId}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"地址","label-position":"top",prop:"address"}},[a("Input",{model:{value:t.formData.address,callback:function(e){t.$set(t.formData,"address",e)},expression:"formData.address"}})],1)],1)],1),a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"是否邀约","label-position":"top"}},[a("RadioGroup",{model:{value:t.isInvite,callback:function(e){t.isInvite=e},expression:"isInvite"}},[a("Radio",{attrs:{label:"0"}},[t._v("是")]),a("Radio",{attrs:{label:"1"}},[t._v("否")])],1),t._v("\n        选择是，面试相关信息必填\n      ")],1)],1)],1),a("Row",["0"===t.isInvite?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试时间","label-position":"top"}},[a("Date-picker",{attrs:{value:t.formData.time,type:"datetime",placeholder:"选择日期"},on:{"on-change":function(e){t.formData.time=e}}})],1)],1):t._e(),"0"===t.isInvite?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试公司","label-position":"top",prop:"clientId"}},[a("chooseCustomer",{attrs:{id:"clientId",clientId:String(t.formData.clientId)},on:{handleSubmit:t.getId}})],1)],1):t._e(),"0"===t.isInvite?a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"面试岗位","label-position":"top",prop:"position"}},[a("Input",{model:{value:t.formData.position,callback:function(e){t.$set(t.formData,"position",e)},expression:"formData.position"}})],1)],1):t._e()],1),a("Row",[a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"身份证号","label-position":"top",prop:"idCard"}},[a("Input",{model:{value:t.formData.idCard,callback:function(e){t.$set(t.formData,"idCard",e)},expression:"formData.idCard"}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"政治面貌","label-position":"top",prop:"politicalStatus"}},[a("Select",{model:{value:t.formData.politicalStatus,callback:function(e){t.$set(t.formData,"politicalStatus",e)},expression:"formData.politicalStatus"}},t._l(t.politicalStatusList,(function(e,o){return a("Option",{key:o,attrs:{value:e.id}},[t._v(t._s(e.name))])})),1)],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"招聘专员","label-position":"top",prop:"staffId"}},[a("chooseStaff",{attrs:{id:"staffId",staffId:String(t.formData.staffId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"渠道","label-position":"top",prop:"channelId"}},[a("chooseBaseData",{attrs:{id:"channelId",channel:"CHANNEL_MODE",basisId:String(t.formData.channelId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{xs:24,md:12}},[a("FormItem",{attrs:{label:"供应商","label-position":"top",prop:"supplierId"}},[a("chooseSupplier",{attrs:{id:"supplierId",propId:String(t.formData.supplierId)},on:{handleSubmit:t.getId}})],1)],1),a("Col",{attrs:{span:"24"}},[a("FormItem",{attrs:{label:"备注","label-position":"top",prop:"remark"}},[a("Input",{attrs:{type:"textarea",rows:4},model:{value:t.formData.remark,callback:function(e){t.$set(t.formData,"remark",e)},expression:"formData.remark"}})],1)],1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},i=[],s=(a("7f7f"),a("c276")),r=a("b42f"),n=a("e6a1"),l=a("54d9"),c=a("9411"),d=a("a3df"),m=a("062f"),u=a("40cb"),p=a("1808"),f={components:{choosePosition:r["a"],chooseStaff:n["a"],chooseBaseData:l["a"],chooseCustomer:d["a"],chooseSupplier:m["a"],uploadImgCom:u["a"]},props:{},data:function(){return{loading:!0,sectionList:[],showModal:!1,formData:{name:"",sex:"",age:"",isLunarCalendar:1,phone:"",birthday:"",education:"",skillId:[],address:"",time:"",clientId:"",position:"",idCard:"",politicalStatus:"",staffId:"",channelId:"",supplierId:"",remark:""},ids:[],educationList:[{id:"1",name:"初中及以下"},{id:"2",name:"中专/中技"},{id:"3",name:"高中"},{id:"4",name:"大专"},{id:"5",name:"本科"},{id:"6",name:"硕士"},{id:"6",name:"博士"}],politicalStatusList:[{id:1,name:"团员"},{id:2,name:"党员"},{id:3,name:"群众"},{id:4,name:"其他"}],ruleInline:{name:[{required:!0,message:"姓名不能为空",trigger:"blur"}],age:[{required:!0,message:"请输入年龄",trigger:"blur"}],phone:[{required:!0,message:"手机号不能为空",trigger:"blur"}]},skillList:[],isInvite:"1"}},computed:{},watch:{showModal:function(t){this.formData.staffId=s["a"].cookies.get("staffId")}},methods:{getSkill:function(){var t=this;this.loading=!0,Object(c["h"])({type:"SKILL"}).then((function(e){t.loading=!1,0===e.ret?t.skillList=e.data:t.$Message.error(e.msg||"接口错误")}))},DrawerToShow:function(){this.showModal=!0,this.loading=!0,this.getSkill()},handleReset:function(t){this.showModal=!1,this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;this.$refs[t].validate((function(a){a?Object(p["c"])(e.formData).then((function(a){e.$Message.success("保存成功！"),e.$emit("getData"),e.formData.jobId=[a.data.id],e.showModal=!1,e.$refs[t].resetFields(),"0"===e.isInvite&&e.handleInvite()})):e.$Message.error("表单验证失败!")}))},handleInvite:function(){var t=this;Object(p["a"])(this.formData).then((function(e){t.$Message.success("邀约成功！")}))},getId:function(t,e){this.formData[e]=t,console.log(t,"++++++")},handleSuccess:function(t){this.formData.idCardPositivePic=t.pic},handleSuccess0:function(t){this.formData.idCardReversePic=t.pic}},mounted:function(){console.log(this.empPosition)},beforeDestroy:function(){},created:function(){}},h=f,b=(a("17b2"),a("2877")),g=Object(b["a"])(h,o,i,!1,null,"61d699f1",null);e["a"]=g.exports},"998f":function(t,e,a){"use strict";var o=a("5b56"),i=a.n(o);i.a},a46c:function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{attrs:{id:t.id}},[t._l(t.uploadList,(function(e,i){return o("div",{key:i,staticClass:"demo-upload-list"},[t.uploadList.length>0?o("div",[o("img",{attrs:{src:t.demainUrl+e}}),o("div",{staticClass:"demo-upload-list-cover"},[o("Icon",{attrs:{type:"ios-eye-outline"},on:{click:function(e){return t.handleView(i,t.id)}}}),o("Icon",{attrs:{type:"ios-trash-outline"},on:{click:function(e){return t.handleRemove(i)}}})],1)]):[e.showProgress?o("Progress",{attrs:{percent:e.percentage,"hide-info":""}}):t._e(),t.loadingImg?o("img",{staticStyle:{display:"inline-block",width:"30px",height:"30px","margin-top":"25px"},attrs:{src:a("bcdd")}}):t._e()]],2)})),o("Upload",{ref:"upload",staticStyle:{display:"inline-block",width:"98px"},attrs:{name:"img","show-upload-list":!1,"on-success":t.handleSuccess,format:["jpg","jpeg","png"],"max-size":3072,"on-format-error":t.handleFormatError,"on-exceeded-size":t.handleMaxSize,"before-upload":t.handleBeforeUpload,type:"drag",action:t.uploadImg}},[o("div",{staticStyle:{width:"98px",height:"98px","line-height":"98px"}},[t.loadingImg?t._e():o("Icon",{attrs:{type:"ios-camera",size:"30"}}),t.loadingImg?o("img",{staticStyle:{display:"inline-block",width:"50px",height:"50px","margin-top":"25px"},attrs:{src:a("12ae")}}):t._e()],1)])],2)},i=[],s=(a("7f7f"),a("c82c")),r=a.n(s),n=(a("0808"),a("c276")),l=a("7e1e"),c={data:function(){return{uploadImg:l["a"],imgName:"",visible:!1,loadingImg:!1,uploadList:[],demainUrl:n["a"].cookies.get("domainUrl")}},props:{picArr:{type:Array,default:[]},id:{type:String,default:""}},watch:{picArr:function(t){this.computeArr=t},id:function(t){console.log(t)}},computed:{computeArr:{get:function(){return this.uploadList},set:function(t){this.uploadList=t}}},mounted:function(){},methods:{handleView:function(t,e){console.log(t,e,"==========");var a=new r.a(document.getElementById(e),{initialViewIndex:t,title:!1,navbar:!1,hidden:function(){a.destroy()}});a.show()},handleRemove:function(t){this.loadingImg=!1,this.uploadList.splice(t,1),this.$emit("uploadSuccess",this.uploadList)},handleSuccess:function(t,e){this.loadingImg=!1,e.url=t.data.imgUrl,e.name=t.data.url,this.uploadList.push(e.name),this.$emit("uploadSuccess",this.uploadList)},handleFormatError:function(t){this.loadingImg=!1,this.$Notice.warning({title:"文件格式不正确",desc:"文件 "+t.name+" 格式不正确，请上传 jpg 或 png 格式的图片。"})},handleMaxSize:function(t){this.loadingImg=!1,this.$Notice.warning({title:"超出文件大小限制",desc:"文件 "+t.name+" 太大，不能超过 3M。"})},handleBeforeUpload:function(){console.log(this.uploadList),this.loadingImg=!0;var t=this.uploadList.length<20;return t||this.$Notice.warning({title:"最多只能上传 20 张图片。"}),t}}},d=c,m=(a("53c5"),a("2877")),u=Object(m["a"])(d,o,i,!1,null,null,null);e["a"]=u.exports},abd4:function(t,e,a){"use strict";var o=a("04fc"),i=a.n(o);i.a},b42f:function(t,e,a){"use strict";var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Cascader",{attrs:{data:t.list,value:t.ids,"change-on-select":""},on:{"update:value":function(e){t.ids=e},"on-change":t.change}})],1)},i=[],s=a("9411"),r={components:{},props:{ids:Array},data:function(){return{showModal:!1,list:[]}},computed:{},watch:{},methods:{change:function(t){this.$emit("change",t),console.log(t,"position")},getList:function(){var t=this;Object(s["p"])().then((function(e){var a=e.data.list;t.list=a.map((function(t,e){return{value:t.value,label:t.title,children:t.children.map((function(t){return{value:t.value,label:t.title}}))}}))}))}},mounted:function(){},beforeDestroy:function(){},created:function(){this.getList()}},n=r,l=a("2877"),c=Object(l["a"])(n,o,i,!1,null,"4e5377ed",null);e["a"]=c.exports},bcdd:function(t,e){t.exports="data:image/gif;base64,R0lGODlhJQAlAJECAL3L2AYrTv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgACACwAAAAAJQAlAAACi5SPqcvtDyGYIFpF690i8xUw3qJBwUlSadmcLqYmGQu6KDIeM13beGzYWWy3DlB4IYaMk+Dso2RWkFCfLPcRvFbZxFLUDTt21BW56TyjRep1e20+i+eYMR145W2eefj+6VFmgTQi+ECVY8iGxcg35phGo/iDFwlTyXWphwlm1imGRdcnuqhHeop6UAAAIfkEBQoAAgAsEAACAAQACwAAAgWMj6nLXAAh+QQFCgACACwVAAUACgALAAACFZQvgRi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwXABEADAADAAACBYyPqcsFACH5BAUKAAIALBUAFQAKAAsAAAITlGKZwWoMHYxqtmplxlNT7ixGAQAh+QQFCgACACwQABgABAALAAACBYyPqctcACH5BAUKAAIALAUAFQAKAAsAAAIVlC+BGL3Z3IlxUmUuhtR2LzHhsiEFACH5BAUKAAIALAEAEQAMAAMAAAIFjI+pywUAIfkEBQoAAgAsBQAFAAoACwAAAhOUYJnAagwdjGq2amXGU1PuLEYBACH5BAUKAAIALBAAAgAEAAsAAAIFhI+py1wAIfkEBQoAAgAsFQAFAAoACwAAAhWUL4AIvdnciXFSZS6G1HYvMeGyIQUAIfkEBQoAAgAsFwARAAwAAwAAAgWEj6nLBQAh+QQFCgACACwVABUACgALAAACE5RgmcBqDB2MarZqZcZTU+4sRgEAIfkEBQoAAgAsEAAYAAQACwAAAgWEj6nLXAAh+QQFCgACACwFABUACgALAAACFZQvgAi92dyJcVJlLobUdi8x4bIhBQAh+QQFCgACACwBABEADAADAAACBYSPqcsFADs="},d90b:function(t,e,a){}}]);