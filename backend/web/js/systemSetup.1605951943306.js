(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["systemSetup","erpManagement1"],{"02e4":function(t,e,a){"use strict";var i=a("ed7c"),n=a.n(i);n.a},"0b1a":function(t,e,a){},"10b4":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Drawer",{attrs:{title:"修改权限",width:"820","mask-closable":!1,styles:t.styles},on:{"on-close":function(e){return t.cancel("formatData")}},model:{value:t.showAdd,callback:function(e){t.showAdd=e},expression:"showAdd"}},[t.loading?t._e():a("Tree",{ref:"listTree",attrs:{data:t.treeList,"show-checkbox":""},on:{"on-check-change":t.selectValue}}),t.loading?a("div",[a("Spin",{attrs:{size:"large"}})],1):t._e(),a("div",{staticClass:"demo-drawer-footer"},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.cancel("formatData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.btLoding},on:{click:function(e){return t.handleSubmit("formatData")}}},[t._v("确定")])],1)],1)],1)},n=[],s=a("580a"),o={name:"addContractor",data:function(){return{loading:!0,editData:{groupName:""},twoList:[],btLoding:!1,headers:{"Access-Control-Allow-Origin":"*"},showAdd:!1,styles:{height:"calc(100% - 55px)",overflow:"auto",paddingBottom:"53px",position:"static"},checkFormData:{groupName:[{required:!0,message:"角色名称不能为空",trigger:"blur"}]},groupId:"",treeList:[],type:2}},watch:{},props:{erTitle:{type:String}},methods:{selectValue:function(t){var e=[];e=this.$refs.listTree.getCheckedAndIndeterminateNodes();var a=function t(a){for(var i=0;i<a.length;i++){a[i].isChecked=!1;for(var n=0;n<e.length;n++)e[n].menuId==a[i].menuId&&(a[i].isChecked=!0);a[i].children&&a[i].children.length>0&&t(a[i].children)}};a(this.treeList)},DrawerToShow:function(t){this.type=t,this.showAdd=!0},handleSubmit:function(t){var e=this;Object(s["f"])({groupId:this.groupId,list:this.treeList,type:this.type}).then((function(t){e.$Message.success("保存成功"),e.showAdd=!1,e.$emit("callback")}))},cancel:function(t){this.showAdd=!1},loadData:function(t){console.log(t),this.groupId=t.value,this.editData.groupId=t.value||"",this.editData.groupName=t.groupName||"",this.getTreeList()},showHide:function(t){t.expand=!t.expand},changeCheck:function(t){arguments.length>1&&void 0!==arguments[1]&&arguments[1]},getTreeList:function(){var t=this;this.loading=!0,Object(s["e"])({groupId:this.groupId,type:this.type}).then((function(e){t.treeList=e.data.list,t.loading=!1}))}},created:function(){},mounted:function(){}},r=o,l=(a("e323"),a("2877")),c=Object(l["a"])(r,i,n,!1,null,null,null),d=c.exports;e["a"]=d},"22bf":function(t,e,a){},2308:function(t,e,a){"use strict";var i=a("bbf9"),n=a.n(i);n.a},"237a":function(t,e,a){},"28b4":function(t,e,a){"use strict";var i=a("0b1a"),n=a.n(i);n.a},"28e3":function(t,e,a){"use strict";var i=a("237a"),n=a.n(i);n.a},2982:function(t,e,a){"use strict";var i=a("d0e4"),n=a.n(i);n.a},"29e6":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",[a("div",[a("div",{staticStyle:{"margin-bottom":"20px",display:"flex","justify-content":"flex-end"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"add")}}},[t._v("新增")])],1),a("tree-table",{staticStyle:{"font-size":"14px"},attrs:{loading:t.loading,selectable:!1,"expand-key":"title","expand-type":!1,columns:t.columns,data:t.tableData},scopedSlots:t._u([{key:"action",fn:function(e){var i=e.row;return[a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"md-add"},on:{click:function(e){return t.show({},"add")}}}),a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"md-create"},on:{click:function(e){return t.show(i,"edit")}}}),a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"ios-trash"},on:{click:function(e){return t.onDelete(i)}}})]}}])})],1)]),a("addIndustry",{ref:"Drawer",attrs:{erTitle:t.erTitle,status:t.status},on:{getList:t.getList}})],1)},n=[],s=a("9411"),o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:t.erTitle,width:600},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("FormItem",{attrs:{label:"行业名称",prop:"name"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),"edit"!=t.status?a("FormItem",{attrs:{label:"上级"}},[a("Cascader",{attrs:{data:t.list,"change-on-select":""},on:{"on-change":t.change}})],1):t._e()],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},r=[],l=(a("7f7f"),{components:{},props:{erTitle:String,status:String},data:function(){return{info:{},loading:!0,sectionList:[],showModal:!1,formData:{name:"",pId:0},industryId:0,list:[],organizationList:[],ruleInline:{name:[{required:!0,message:"请填写行业名称",trigger:"blur"}]}}},computed:{},watch:{},methods:{change:function(t){var e=t.length-1;this.formData.pId=t[e]},getIndustryList:function(){var t=this;Object(s["u"])().then((function(e){var a=e.data.list;t.list=a.map((function(t,e){return{value:t.value,label:t.title,children:t.children.map((function(t){return{value:t.value,label:t.title}}))}}))}))},DrawerToShow:function(t){this.info=t,this.formData.pId=t.pId,this.formData.name=t.title,this.industryId=t.value,this.getIndustryList(),this.showModal=!0,this.loading=!0},handleReset:function(t){this.showModal=!1,this.industryId=0,this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;"add"===this.status?this.$refs[t].validate((function(a){a?Object(s["c"])({name:e.formData.name,pId:e.formData.pId}).then((function(a){e.$Message.success("保存成功！"),e.showModal=!1,e.$emit("getList"),e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")})):this.$refs[t].validate((function(a){a?Object(s["B"])({name:e.formData.name,pId:e.formData.pId,industryId:e.industryId}).then((function(a){e.$Message.success("修改成功！"),e.showModal=!1,e.$emit("getList"),e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}}),c=l,d=(a("2982"),a("2877")),u=Object(d["a"])(c,o,r,!1,null,"a3b9840c",null),h=u.exports,f={components:{addIndustry:h},data:function(){return{isShow:!1,loading:!0,erTitle:"",status:"",columns:[{title:"行业名称",key:"title",minWidth:"250px"},{title:"操作",minWidth:"200px",type:"template",template:"action"}],tableData:[]}},created:function(){this.getList()},methods:{getList:function(){var t=this;this.loading=!0,Object(s["u"])().then((function(e){t.loading=!1,0===e.ret?t.tableData=e.data.list:t.$Message.error(e.msg||"接口错误")}))},show:function(t,e){this.status=e,"add"===e?this.erTitle="新增行业":"edit"===e&&(this.erTitle="编辑行业"),this.$refs.Drawer.DrawerToShow(t)},onDelete:function(t){var e=this;this.$Modal.confirm({title:"提示",content:"<p>确认删除</p>",onOk:function(){Object(s["n"])({industryId:t.value}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getList()):e.$Message.error(t.msg)}))},onCancel:function(){}})}}},p=f,m=(a("2308"),Object(d["a"])(p,i,n,!1,null,"0950742b",null));e["default"]=m.exports},"2f5f":function(t,e,a){},3210:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",[a("div",[a("div",{staticStyle:{"margin-bottom":"20px",display:"flex"}},[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"addNew")}}},[t._v("新增")])],1),a("tree-table",{staticStyle:{"font-size":"14px"},attrs:{loading:t.loading,"expand-key":"title","expand-type":!1,selectable:!1,columns:t.columns,data:t.tableData},scopedSlots:t._u([{key:"group",fn:function(e){var i=e.row;return[a("Button",{attrs:{type:"primary",size:"small"},on:{click:function(e){return t.showEditDrawer(0,i)}}},[t._v("后台权限")]),a("Button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary",size:"small"},on:{click:function(e){return t.showProduct(i)}}},[t._v("关联产品")])]}},{key:"action",fn:function(e){var i=e.row;return[a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"md-add"},on:{click:function(e){return t.show(i,"add")}}}),a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"md-create"},on:{click:function(e){return t.show(i,"edit")}}}),a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"ios-trash"},on:{click:function(e){return t.onDelete(i)}}}),t._l(t.tableData.children,(function(e,n){return[e.btnIsTable?a("Icon",{key:n,class:e.btnClass,attrs:{type:e.btnType?e.btnType:"default"},on:{click:function(a){return t.handleEvent(e.btnHandle,e.btnHandleParams,i)}}}):t._e()]}))]}}])})],1)]),a("addPosition",{ref:"Drawer",attrs:{erTitle:t.erTitle,status:t.status},on:{getList:t.getList}}),a("editPage",{ref:"quanxian",attrs:{erTitle:t.title},on:{callback:function(e){return t.getList()}}}),a("chooseMateriel",{ref:"chooseMateriel"})],1)},n=[],s=a("10b4"),o=a("9411"),r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:t.erTitle,width:600},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("FormItem",{attrs:{label:"岗位名称",prop:"name"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),a("FormItem",{attrs:{label:"角色",prop:"roleType"}},[a("RadioGroup",{model:{value:t.formData.roleType,callback:function(e){t.$set(t.formData,"roleType",e)},expression:"formData.roleType"}},[a("Radio",{attrs:{label:1}},[t._v("员工")]),a("Radio",{attrs:{label:2}},[t._v("部门主管")]),a("Radio",{attrs:{label:3}},[t._v("超级管理员")])],1)],1),a("FormItem",{attrs:{label:"上级"}},[t.showModal?a("choosePosition",{attrs:{ids:t.ids},on:{change:t.changeId}}):t._e()],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},l=[],c=(a("7f7f"),a("bd86")),d=a("b42f"),u={components:{choosePosition:d["a"]},props:{erTitle:String,status:String},data:function(){return Object(c["a"])({ids:[],info:{},loading:!0,sectionList:[],showModal:!1,formData:{name:"",parentId:0,roleType:0},groupId:0,list:[],ruleInline:{name:[{required:!0,message:"请填写岗位名称",trigger:"blur"}],roleType:[{required:!0,type:"number",message:"请选择角色",trigger:"change"}]}},"ids",[])},computed:{},watch:{},methods:{change:function(t){var e=t.length-1;this.formData.parentId=t[e]},DrawerToShow:function(t,e){"add"===e?(console.log(t.value,"aaaa"),this.ids=t.pidArr,this.ids.push(t.value),console.log(this.ids,"ddddd"),this.formData.parentId=t.value):(this.info=t,this.formData.parentId=t.parentId,this.formData.name=t.title,this.groupId=t.value,this.formData.roleType=t.roleType,this.ids=t.pidArr),this.showModal=!0,this.loading=!0},handleReset:function(t){this.showModal=!1,this.ids=[],this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;console.log(1111),"add"===this.status||"addNew"===this.status?this.$refs[t].validate((function(a){a?Object(o["b"])({groupName:e.formData.name,parentId:e.formData.parentId,roleType:e.formData.roleType}).then((function(a){e.$Message.success("保存成功！"),e.showModal=!1,e.$emit("getList"),e.ids=[],e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")})):this.$refs[t].validate((function(a){a?Object(o["o"])({groupName:e.formData.name,parentId:e.formData.parentId,groupId:e.groupId,roleType:e.formData.roleType}).then((function(a){e.$Message.success("修改成功！"),e.showModal=!1,e.$emit("getList"),e.ids=[],e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")}))},changeId:function(t){this.ids=t;var e=t.length-1;this.formData.parentId=t[e]}},mounted:function(){},beforeDestroy:function(){},created:function(){}},h=u,f=(a("28b4"),a("2877")),p=Object(f["a"])(h,r,l,!1,null,"2a3fc786",null),m=p.exports,g=a("d9e1"),b={components:{addPosition:m,editPage:s["a"],chooseMateriel:g["a"]},data:function(){return{isShow:!1,loading:!0,erTitle:"",status:"",columns:[{title:"岗位名称",key:"title",minWidth:"250px"},{title:"角色",key:"roleTypeName",minWidth:120},{title:"权限操作",minWidth:"200px",type:"template",template:"group"},{title:"操作",minWidth:"200px",type:"template",template:"action"}],tableData:[],title:""}},created:function(){this.getList()},methods:{getList:function(){var t=this;this.loading=!0,Object(o["y"])().then((function(e){if(t.loading=!1,0===e.ret){t.tableData=e.data.list;var a=e.data.list,i=a.map((function(t,e){return{value:t.value,label:t.title,pidArr:t.pidArr,children:t.children.map((function(t){return{value:t.value,label:t.title,pidArr:t.pidArr,children:t.children.map((function(t){return{value:t.value,label:t.title,pidArr:t.pidArr}}))}}))}}));sessionStorage.setItem("positionList",JSON.stringify(i))}else t.$Message.error(e.msg||"接口错误")}))},show:function(t,e){this.status=e,console.log(e,"pppp"),"add"===e||"addNew"===e?this.erTitle="新增岗位":"edit"===e&&(this.erTitle="编辑岗位"),this.$refs.Drawer.DrawerToShow(t,e)},onDelete:function(t){var e=this;this.$Modal.confirm({title:"提示",content:"<p>确认删除</p>",onOk:function(){Object(o["m"])({groupId:t.value}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getList()):e.$Message.error(t.msg)}))},onCancel:function(){}})},showEditDrawer:function(t,e){this.title=0==t?"后台权限":"小程序权限",this.$refs.quanxian.DrawerToShow(t),this.$refs.quanxian.loadData(e)},showProduct:function(t){this.$refs.chooseMateriel.loadData(2,1,t.value)}}},v=b,y=(a("3acf"),Object(f["a"])(v,i,n,!1,null,"1338c462",null));e["default"]=y.exports},"32a2":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",[a("div",[a("div",{staticStyle:{"margin-bottom":"20px",display:"flex","justify-content":"space-between"}},[a("div",[0!=t.oneId?a("Button",{attrs:{type:"primary"},on:{click:t.returnBack}},[t._v("返回")]):t._e()],1),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"add")}}},[t._v("新增")])],1),a("Table",{ref:"table",attrs:{loading:t.loading,columns:t.columns,data:t.tableData,type:"seletion",stripe:""},on:{"on-selection-change":t.changeSelect}})],1)]),a("addArea",{ref:"Drawer",attrs:{erTitle:t.erTitle},on:{getData:t.getSelect}})],1)},n=[],s=(a("ac6a"),a("967e")),o=a.n(s),r=(a("96cf"),a("3b8d")),l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:t.erTitle,width:600},on:{"on-cancel":function(e){return t.handleReset("editData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"editData",attrs:{"label-width":130,model:t.editData,rules:t.ruleInline}},["add"===t.status?a("FormItem",{attrs:{label:"类型","label-position":"top",prop:"ctype"}},[a("Select",{on:{"on-change":t.changeType},model:{value:t.editData.ctype,callback:function(e){t.$set(t.editData,"ctype",e)},expression:"editData.ctype"}},[a("Option",{attrs:{value:"1"}},[t._v("省")]),a("Option",{attrs:{value:"2"}},[t._v("市")]),a("Option",{attrs:{value:"3"}},[t._v("区")])],1)],1):t._e(),"2"!==t.editData.ctype&&"3"!==t.editData.ctype||"add"!==t.status?t._e():a("div",[a("FormItem",{attrs:{label:"上级省级","label-position":"top",prop:"editOneId"}},[a("Select",{staticStyle:{width:"200px"},on:{"on-change":t.changeOne},model:{value:t.editData.editOneId,callback:function(e){t.$set(t.editData,"editOneId",e)},expression:"editData.editOneId"}},t._l(t.oneList,(function(e){return a("Option",{key:e.value,attrs:{value:e.value}},[t._v(t._s(e.title))])})),1)],1),"3"===t.editData.ctype&&t.twoList.length>0?a("div",[a("FormItem",{attrs:{label:"上级市级",prop:"editTwoId"}},[a("Select",{staticStyle:{width:"200px"},on:{"on-change":t.changeTwo},model:{value:t.editData.editTwoId,callback:function(e){t.$set(t.editData,"editTwoId",e)},expression:"editData.editTwoId"}},t._l(t.twoList,(function(e){return a("Option",{key:e.value,attrs:{value:String(e.value)}},[t._v(t._s(e.title))])})),1)],1)],1):t._e()],1),a("FormItem",{attrs:{label:"地区名称","label-position":"top",prop:"cname"}},[a("Input",{attrs:{placeholder:"请输入地区名称"},model:{value:t.editData.cname,callback:function(e){t.$set(t.editData,"cname",e)},expression:"editData.cname"}})],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("editData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("editData")}}},[t._v("确定")])],1)],2)},c=[],d=(a("7f7f"),a("9411")),u={components:{},props:{erTitle:{type:String}},data:function(){return{ids:[],info:{},loading:!0,sectionList:[],showModal:!1,editData:{cname:"",parent_id:1,editOneId:0,editTwoId:""},positionId:0,list:[],ruleInline:{cname:[{required:!0,message:"名称不能为空",trigger:"blur"}],ctype:[{required:!0,message:"请选择地区类型",trigger:"change"}],editOneId:[{required:!0,type:"number",message:"请选择上级地区",trigger:"blur"}],editTwoId:[{required:!0,type:"string",message:"请选择上级地区",trigger:"blur"}]},oneList:[],twoList:[],value:0,status:""}},computed:{},watch:{},methods:{changeType:function(t){this.editData.ctype=t+""},changeTwo:function(t){this.editData.editTwoId=t,this.editData.parent_id=this.editData.editTwoId},changeOne:function(t){var e=this;this.editData.editTwoId=0,this.editData.editOneId=t,"2"===this.editData.ctype?this.editData.parent_id=this.editData.editOneId:"3"===this.editData.ctype?this.editData.parent_id=this.editData.editTwoId:this.editData.parent_id=1,this.oneList.forEach((function(t){t.value==e.editData.editOneId&&(t.children.length>0?e.twoList=t.children:(e.editData.ctype="2",e.twoList=[]))}))},loadData:function(t,e,a,i){var n=this;Object(d["e"])({}).then((function(t){0===t.ret?n.oneList=t.data.list:n.$Message.error(t.msg||"接口错误")})),this.twoList=[],this.editData.editOneId=e+"",this.editData.editTwoId=a+"","edit"===i&&(this.editData.id=t.value,this.editData.cname=t.title,this.editData.ctype=t.ctype,this.editData.parent_id=t.parent_id),this.status=i,0!=this.editData.editOneId&&this.oneList.forEach((function(t){t.value==n.editData.editOneId&&(n.twoList=t.children)}))},DrawerToShow:function(t){this.showModal=!0},handleReset:function(t){this.showModal=!1,this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;this.$refs[t].validate((function(a){if(a){if("2"===e.editData.ctype&&1===e.editData.parent_id)return void e.$Message.error("请选择上级地区！");if("3"===e.editData.ctype&&1===e.editData.parent_id)return void e.$Message.error("请选择上级地区！");"add"==e.status?Object(d["a"])({parent_id:e.editData.parent_id,cname:e.editData.cname,ctype:e.editData.ctype}).then((function(a){0==a.ret?(e.$Message.success("保存成功"),e.showModal=!1,e.$emit("getData"),e.$refs[t].resetFields()):e.$Message.error(a.msg||"接口错误")})):Object(d["z"])(e.editData).then((function(a){0==a.ret?(console.log("bbbbbbbbbb"),e.$Message.success("保存成功"),e.showModal=!1,e.btLoding=!1,e.$emit("getData"),e.$refs[t].resetFields()):(e.btLoding=!1,e.$Message.error(a.msg||"接口错误"))}))}}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},h=u,f=(a("28e3"),a("2877")),p=Object(f["a"])(h,l,c,!1,null,"6fef771c",null),m=p.exports,g={components:{addArea:m},data:function(){var t=this;return{loading:!0,erTitle:"",status:"",columns:[{title:"编号",key:"value",width:100},{title:"地区名称",key:"title",minWidth:120},{title:"操作",minWidth:"200px",key:"action",align:"center",width:300,render:function(e,a){return e("div",[e("Button",{props:{size:"small",type:"info"},style:{marginRight:"5px",display:3==a.row.ctype?"none":""},on:{click:function(){t.next(a.row)}}},"查看下级"),e("Button",{props:{size:"small",type:"primary",disabled:0==a.row.isSys},style:{marginRight:"5px"},on:{click:function(){t.show(a.row,"edit")}}},"编辑"),e("Button",{props:{size:"small",type:"error",disabled:0==a.row.isSys},style:{marginRight:"5px"},on:{click:function(){t.remove(a.row)}}},"删除")])}}],tableData:[],pageination:{page:1,pageSize:2,count:1},oneId:0,twoId:0}},created:function(){this.getData()},methods:{getData:function(){var t=this;this.loading=!0,Object(d["d"])({id:0==this.oneId?0:0==this.twoId?this.oneId:this.twoId}).then((function(e){t.loading=!1,0===e.ret?t.tableData=e.data.list:t.$Message.error(e.msg||"接口错误")}))},getSelect:function(){this.getData(),Object(d["e"])().then(function(){var t=Object(r["a"])(o.a.mark((function t(e){return o.a.wrap((function(t){while(1)switch(t.prev=t.next){case 0:sessionStorage.setItem("areaSelect",JSON.stringify(e.data.list));case 1:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())},next:function(t){0==this.oneId?(this.oneName=t.title,this.oneId=t.value):(this.twoName=t.title,this.twoId=t.value),this.page=1,this.getData()},returnBack:function(){0!=this.twoId?(this.twoId=0,this.twoName="",this.page=1,this.getData()):0!=this.oneId&&(this.oneId=0,this.page=1,this.oneName="",this.getData())},show:function(t,e){this.status=e,"add"===e?this.erTitle="新增地区":"edit"===e&&(this.erTitle="编辑地区"),this.$refs.Drawer.loadData(t,this.oneId,this.twoId,e),this.$refs.Drawer.DrawerToShow()},changeSelect:function(t){var e=this;this.chooseData=[],t.forEach((function(t){e.chooseData.push(t.areaId)}))},remove:function(t){var e=this;this.$Modal.confirm({title:"提示",content:"<p>确认删除</p>",onOk:function(){Object(d["l"])({id:t.value}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getData()):e.$Message.error(t.msg)}))},onCancel:function(){}})}}},b=g,v=(a("42e6"),Object(f["a"])(b,i,n,!1,null,"d2c46916",null));e["default"]=v.exports},"386d":function(t,e,a){"use strict";var i=a("cb7c"),n=a("83a1"),s=a("5f1b");a("214f")("search",1,(function(t,e,a,o){return[function(a){var i=t(this),n=void 0==a?void 0:a[e];return void 0!==n?n.call(a,i):new RegExp(a)[e](String(i))},function(t){var e=o(a,t,this);if(e.done)return e.value;var r=i(t),l=String(this),c=r.lastIndex;n(c,0)||(r.lastIndex=0);var d=s(r,l);return n(r.lastIndex,c)||(r.lastIndex=c),null===d?-1:d.index}]}))},"3acf":function(t,e,a){"use strict";var i=a("4813"),n=a.n(i);n.a},"42e6":function(t,e,a){"use strict";var i=a("cfcc"),n=a.n(i);n.a},4813:function(t,e,a){},"7c19":function(t,e,a){"use strict";var i=a("2f5f"),n=a.n(i);n.a},"83a1":function(t,e){t.exports=Object.is||function(t,e){return t===e?0!==t||1/t===1/e:t!=t&&e!=e}},"9dc7":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",[a("div",[a("div",{staticStyle:{display:"flex","justify-content":"space-between"}},[a("Form",[a("FormItem",{attrs:{label:"选择数据类型：","label-width":120}},[a("Select",{staticStyle:{width:"200px"},on:{"on-change":t.search},model:{value:t.type,callback:function(e){t.type=e},expression:"type"}},t._l(t.list,(function(e){return a("Option",{key:e.type,attrs:{value:e.type}},[t._v(t._s(e.name))])})),1)],1)],1),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.show({},"add")}}},[t._v("新增")])],1),a("tree-table",{staticStyle:{"font-size":"14px"},attrs:{loading:t.loading,"expand-key":"title",selectable:!1,"expand-type":!1,columns:t.columns,data:t.tableData},scopedSlots:t._u([{key:"action",fn:function(e){var i=e.row;return[a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"md-create"},on:{click:function(e){return t.show(i,"edit")}}}),a("Icon",{staticClass:"margin-right-20",attrs:{size:"20",type:"ios-trash"},on:{click:function(e){return t.onDelete(i)}}})]}}])})],1)]),a("addBasics",{ref:"Drawer",attrs:{erTitle:t.erTitle,status:t.status},on:{getList:t.getSelect}})],1)},n=[],s=a("9411"),o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,title:t.erTitle,width:600},on:{"on-cancel":function(e){return t.handleReset("formData")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("Form",{ref:"formData",attrs:{"label-width":130,model:t.formData,rules:t.ruleInline}},[a("FormItem",{attrs:{label:"名称",prop:"name"}},[a("Input",{model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1),a("FormItem",{attrs:{label:"类型",prop:"type"}},[a("Select",{model:{value:t.formData.type,callback:function(e){t.$set(t.formData,"type",e)},expression:"formData.type"}},t._l(t.list,(function(e){return a("Option",{key:e.type,attrs:{value:e.type}},[t._v(t._s(e.name))])})),1)],1)],1),a("template",{slot:"footer"},[a("Button",{staticStyle:{"margin-left":"8px"},on:{click:function(e){return t.handleReset("formData")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.handleSubmit("formData")}}},[t._v("确定")])],1)],2)},r=[],l=(a("7f7f"),{components:{},props:{erTitle:String,status:String},data:function(){return{info:{},loading:!0,showModal:!1,formData:{name:"",type:0,basisId:0},list:[],ruleInline:{name:[{required:!0,message:"请填写名称",trigger:"blur"}],type:[{required:!0,message:"请选择类型",trigger:"change"}]}}},computed:{},watch:{},methods:{change:function(t){var e=t.length-1;this.formData.pId=t[e]},getSelect:function(){var t=this;Object(s["i"])().then((function(e){t.list=e.data}))},DrawerToShow:function(t){this.info=t,this.formData.type=t.type,this.formData.name=t.name,this.getSelect(),this.showModal=!0,this.loading=!0},handleReset:function(t){this.showModal=!1,this.industryId=0,this.$refs[t].resetFields()},handleSubmit:function(t){var e=this;"add"===this.status?this.$refs[t].validate((function(a){a?Object(s["g"])({name:e.formData.name,type:e.formData.type}).then((function(a){e.$Message.success("保存成功！"),e.showModal=!1,e.$emit("getList"),e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")})):this.$refs[t].validate((function(a){a?Object(s["j"])({name:e.formData.name,type:e.formData.type,basisId:e.info.basisId}).then((function(a){e.$Message.success("修改成功！"),e.showModal=!1,e.$emit("getList"),e.$refs[t].resetFields()})):e.$Message.error("表单验证失败!")}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}}),c=l,d=(a("02e4"),a("2877")),u=Object(d["a"])(c,o,r,!1,null,"3a7b1060",null),h=u.exports,f={components:{addBasics:h},data:function(){return{type:"",isShow:!1,loading:!0,erTitle:"",status:"",columns:[{title:"编号",key:"basisId",width:"250px"},{title:"名称",key:"name",minWidth:"250px"},{title:"操作",minWidth:"200px",type:"template",template:"action"}],tableData:[],list:[]}},created:function(){this.getSelect()},methods:{search:function(t){this.type=t,this.getList()},getSelect:function(){var t=this;Object(s["i"])().then((function(e){t.list=e.data,t.type=t.list[0].type,t.getList()}))},getList:function(){var t=this;this.loading=!0,Object(s["h"])({type:this.type}).then((function(e){t.loading=!1,0===e.ret?t.tableData=e.data:t.$Message.error(e.msg||"接口错误")}))},show:function(t,e){this.status=e,"add"===e?this.erTitle="新增":"edit"===e&&(this.erTitle="编辑"),this.$refs.Drawer.DrawerToShow(t)},onDelete:function(t){var e=this;this.$Modal.confirm({title:"提示",content:"<p>确认删除</p>",onOk:function(){Object(s["f"])({basisId:t.basisId}).then((function(t){0===t.ret?(e.$Message.success("删除成功"),e.getList()):e.$Message.error(t.msg)}))},onCancel:function(){}})}}},p=f,m=(a("7c19"),Object(d["a"])(p,i,n,!1,null,"c940f4d6",null));e["default"]=m.exports},a14d:function(t,e,a){"use strict";var i=a("dd2b"),n=a.n(i);n.a},b42f:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Cascader",{attrs:{data:t.list,value:t.ids,"change-on-select":""},on:{"update:value":function(e){t.ids=e},"on-change":t.change}})],1)},n=[],s=a("9411"),o={components:{},props:{ids:Array},data:function(){return{showModal:!1,list:[]}},computed:{},watch:{},methods:{change:function(t){this.$emit("change",t),console.log(t,"position")},getList:function(){var t=this;Object(s["y"])().then((function(e){var a=e.data.list;t.list=a.map((function(t,e){return{value:t.value,label:t.title,children:t.children.map((function(t){return{value:t.value,label:t.title}}))}}))}))}},mounted:function(){},beforeDestroy:function(){},created:function(){this.getList()}},r=o,l=a("2877"),c=Object(l["a"])(r,i,n,!1,null,"4e5377ed",null);e["a"]=c.exports},bbf9:function(t,e,a){},c4c8:function(t,e,a){"use strict";a.d(e,"c",(function(){return r})),a.d(e,"b",(function(){return l})),a.d(e,"d",(function(){return c})),a.d(e,"a",(function(){return d}));var i=a("c276"),n=a("b6bd"),s=i["a"].cookies.get("token"),o=a("4328");function r(t){return Object(n["a"])({url:"/goods/manage/list?token="+s,method:"post",data:o.stringify(t)})}function l(t){return Object(n["a"])({url:"/goods/manage/info?token="+s,method:"post",data:t})}function c(t){return Object(n["a"])({url:"/goods/manage/save?token="+s,method:"post",data:t})}function d(t){return Object(n["a"])({url:"/goods/manage/del?token="+s,method:"post",data:t})}},cfcc:function(t,e,a){},d0e4:function(t,e,a){},d9e1:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{attrs:{"mask-closable":!1,"footer-hide":!0,title:"选择"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品"),width:1e3},on:{"on-cancel":function(e){return t.handleReset("formValidate")}},model:{value:t.showModal,callback:function(e){t.showModal=e},expression:"showModal"}},[a("div",{staticClass:"choose-class",class:t.isMobile?"":"wrapper"},[a("Card",{class:t.isMobile?"":"right-content"},[a("Form",{ref:"formCustom",attrs:{"label-width":100}},[a("Row",{staticStyle:{"margin-bottom":"16px"},attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Input",{staticStyle:{width:"95%"},attrs:{type:"text",placeholder:"请输入"+(2==t.type?"物料":2==t.isFinished?"半成品":"产品")+"名称",clearabl:""},model:{value:t.searchValidate.name,callback:function(e){t.$set(t.searchValidate,"name",e)},expression:"searchValidate.name"}})],1),a("Col",{attrs:{xs:24,md:12,lg:12}},[a("Button",{attrs:{type:"primary"},on:{click:t.search}},[t._v("查询")]),a("Button",{staticClass:"ivu-ml-8",on:{click:t.resetSearch}},[t._v("重置")]),t.showMore||1!=t.type||t.isFinished?t._e():a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              展开\n              "),a("Icon",{attrs:{type:"ios-arrow-down"}})],1),t.showMore?a("a",{staticClass:"ivu-ml-8",attrs:{type:"text"},on:{click:function(e){t.showMore=!t.showMore}}},[t._v("\n              收起\n              "),a("Icon",{attrs:{type:"ios-arrow-up"}})],1):t._e()],1)],1),t.showMore?a("Row",{attrs:{type:"flex",justify:"space-between"}},[a("Col",{attrs:{xs:24,md:12,lg:12}},[a("FormItem",{attrs:{label:"产品类型：","label-position":"top","label-width":90}},[a("RadioGroup",{model:{value:t.searchValidate.isFinished,callback:function(e){t.$set(t.searchValidate,"isFinished",e)},expression:"searchValidate.isFinished"}},[a("Radio",{attrs:{label:0}},[t._v("全部")]),a("Radio",{attrs:{label:2}},[t._v("半成品")]),a("Radio",{attrs:{label:1}},[t._v("成品")])],1)],1)],1)],1):t._e()],1),a("div",[a("div",[a("Table",{ref:"tableData",attrs:{columns:t.columns,data:t.data,loading:t.loading},on:{"on-selection-change":t.changeSelect}})],1),a("div",{staticClass:"ivu-mt ivu-text-center"},[a("Page",{attrs:{"page-size":t.pageInfo.pageSize,total:Number(t.pageInfo.count),current:t.pageInfo.page},on:{"on-change":t.changePage}})],1)])],1),t.isMobile?t._e():a("Card",{staticClass:"left-content"},[a("div",{staticClass:"ivu-mt",attrs:{slot:"title"},slot:"title"},[a("Alert",[a("Icon",{staticClass:"ivu-mr-8",attrs:{color:"#2d8cf0",type:"ios-alert"}}),t._v("\n          已选择 "+t._s(t.selectedArr.length)+" 项\n          "),a("a",{staticClass:"ivu-ml-8",on:{click:t.clearSelectd}},[t._v("清空")])],1)],1),a("List",{attrs:{border:""}},[a("Scroll",{staticStyle:{flex:"1"},attrs:{height:415}},t._l(t.selectedArr,(function(e,i){return a("ListItem",{key:i},[a("ListItemMeta",{attrs:{avatar:"",title:e.name,description:""}}),a("template",{slot:"action"},[a("li",{on:{click:function(e){return t.delClass(i)}}},[a("Icon",{attrs:{type:"md-close-circle",size:"19"}})],1)])],2)})),1)],1)],1)],1),a("div",{staticStyle:{"text-align":"right","margin-top":"10px"}},[a("Button",{staticStyle:{"margin-right":"8px"},on:{click:function(e){return t.handleReset("formValidate")}}},[t._v("取消")]),a("Button",{attrs:{type:"primary",loading:t.isSubmit},on:{click:function(e){return t.handleSubmit("formValidate")}}},[t._v("确定")])],1)])},n=[],s=(a("8e6e"),a("456d"),a("386d"),a("ac6a"),a("bd86")),o=a("c4c8"),r=a("2f08"),l=a("2f62"),c=a("9411");function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(a,!0).forEach((function(e){Object(s["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var h={name:"chooseMateriel",components:{iCopyright:r["a"]},props:{modal:{type:Boolean,default:!1},selected:{type:Array,default:function(){return[]}}},data:function(){return{columns:[{type:"selection",minWidth:50},{title:"名称",minWidth:100,key:"name"},{title:"单位",key:"unit",minWidth:100},{title:"库存",key:"stock",minWidth:100}],data:[],searchValidate:{name:"",isFinished:0,type:""},showModal:!1,selectedArr:[],showMore:!1,pageInfo:{pageSize:10,page:1,pageSum:0,count:0},type:"",isFinished:"",loading:!0,groupId:"",isSubmit:!1}},computed:u({},Object(l["e"])("admin/layout",["isMobile"])),watch:{},methods:{changeSelect:function(t){var e=this;this.selectedArr=[],t.forEach((function(t){e.selectedArr.push(t)}))},clearSelectd:function(){this.$refs.tableData.selectAll(!1),this.selectedArr=[]},handleReset:function(t){this.showModal=!1,this.$emit("hideModal")},handleSubmit:function(t){var e=this;if(this.groupId){if(this.isSubmit)return;this.isSubmit=!0;var a=this.selectedArr.map((function(t){return t.id}));Object(c["t"])({groupId:this.groupId,goodsId:a.join(",")}).then((function(t){console.log(222222),e.$Message.success("保存成功"),e.showModal=!1,e.isSubmit=!1})).catch((function(t){e.isSubmit=!1}))}else this.showModal=!1,this.$emit("handleChoose",this.selectedArr)},delClass:function(t){var e=this,a="";this.data.some((function(i,n){i.id===e.selectedArr[t].id&&(a=n)})),this.$refs.tableData.toggleSelect(a)},resetSearch:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.searchValidate={name:"",isFinished:this.isFinished,type:this.type},this.getData()},search:function(){this.pageInfo={pageSize:10,page:1,pageSum:0,count:0},this.getData()},changePage:function(t){this.pageInfo.page=t,this.getData()},getData:function(){var t=this;this.data=[],this.loading=!0,Object(o["c"])(u({},this.pageInfo,{},this.searchValidate)).then((function(e){var a=[];t.data=e.data.list.map((function(e){return a=t.selectedArr.filter((function(t){return t.id==e.id})),e._checked=a.length>0,e})),console.log(t.data),t.pageInfo=e.data.pageInfo,t.loading=!1})).catch((function(e){t.loading=!1}))},loadData:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2,a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";console.log(111111111111),2==e?(this.isFinished="",this.type=2):(this.isFinished=t||0,this.type=1),this.searchValidate.isFinished=this.isFinished,this.searchValidate.type=this.type,this.searchValidate.name="",this.showModal=!0,this.loading=!0,this.selectedArr=[],this.groupId=a,a?this.getGroupGoods():this.search()},getGroupGoods:function(){var t=this;Object(c["s"])({groupId:this.groupId}).then((function(e){console.log(222222),console.log(e.data.list),t.selectedArr=e.data.list,t.search()})).catch((function(e){t.loading=!1}))}},mounted:function(){},beforeDestroy:function(){},created:function(){}},f=h,p=(a("a14d"),a("2877")),m=Object(p["a"])(f,i,n,!1,null,"f9c16154",null);e["a"]=m.exports},dd2b:function(t,e,a){},e323:function(t,e,a){"use strict";var i=a("22bf"),n=a.n(i);n.a},eaaf:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Card",{staticClass:"sx"},[a("Form",{ref:"detail",attrs:{model:t.detail,inline:"","label-width":150}},[a("Row",[a("FormItem",{attrs:{label:"人才跟进时间：","label-position":"top"}},[a("Input-number",{attrs:{min:0},model:{value:t.detail.publicDay,callback:function(e){t.$set(t.detail,"publicDay",e)},expression:"detail.publicDay"}}),t._v(" 天不跟进，就变成共享资源\n        ")],1)],1),a("Row",[a("FormItem",{attrs:{label:"人才离职时间：","label-position":"top"}},[a("Input-number",{attrs:{min:0},model:{value:t.detail.leaveTime,callback:function(e){t.$set(t.detail,"leaveTime",e)},expression:"detail.leaveTime"}}),t._v(" 分钟后，自动到公共资源\n        ")],1)],1),a("Row",[a("FormItem",{attrs:{label:"合同预警提示时间：","label-position":"top"}},[a("Input-number",{attrs:{min:0},model:{value:t.detail.contractDay,callback:function(e){t.$set(t.detail,"contractDay",e)},expression:"detail.contractDay"}}),t._v(" 天\n        ")],1)],1),a("Row",[a("FormItem",{attrs:{label:"","label-position":"top"}},[a("Button",{attrs:{type:"primary"},on:{click:t.handleSubmit}},[t._v("保存")])],1)],1)],1)],1)],1)},n=[],s=a("9411"),o={components:{},data:function(){return{detail:{}}},created:function(){this.getInfo()},methods:{getInfo:function(){var t=this;Object(s["k"])().then((function(e){0===e.ret&&(t.detail=e.data.info)}))},handleSubmit:function(){var t=this;Object(s["A"])(this.detail).then((function(e){t.$Message.success("已保存！"),t.getInfo()}))}}},r=o,l=a("2877"),c=Object(l["a"])(r,i,n,!1,null,"00fe6349",null);e["default"]=c.exports},ed7c:function(t,e,a){}}]);