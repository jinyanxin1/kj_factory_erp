(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-618d28b6"],{"2b2c":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[t.showCustomer||t.showTalent?t._e():i("Card",[i("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableColumns,data:t.tableData}})],1),t.showCustomer&&!t.showTalent?i("Card",[i("div",{staticStyle:{display:"flex","justify-content":"flex-end","margin-bottom":"10px"}},[i("Button",{attrs:{type:"primary"},on:{click:t.back}},[t._v("返回待办")])],1),i("Table",{attrs:{loading:t.loading,stripe:"",columns:t.tableCustomer,data:t.customerData}})],1):t._e(),t.showTalent?i("Card",[i("div",{staticStyle:{display:"flex","justify-content":"flex-end","margin-bottom":"10px"}},[i("Button",{attrs:{type:"primary"},on:{click:t.backToCu}},[t._v("返回客户")])],1),i("Table",{attrs:{loading:t.loading,stripe:"",columns:t.talentColumns,data:t.talentData}})],1):t._e(),i("talentDetail",{ref:"detail",on:{getData:t.getList}})],1)},n=[],s=(i("ac6a"),i("456d"),i("7f7f"),i("9c3b")),o=i("b7fb"),r=i("0658"),l=i("1808"),c={components:{talentDetail:s["a"]},data:function(){var t=this;return{isShow:!1,loading:!0,erTitle:"",status:"",curRow:{},formItem:"",userTypeList:[],tableColumns:[{type:"selection",width:60,align:"center"},{title:"事件",key:"title",render:function(e,i){return e("div",[e("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px"},on:{click:function(){t.toList(i.row)}}},i.row.title)])}},{title:"时间",key:"time"}],tableData:[],tableCustomer:[{type:"selection",width:60,align:"center"},{title:"客户名称",minWidth:100,key:"name"},{title:"电话",minWidth:100,key:"tell"},{title:"在职人数",minWidth:100,key:"count"},{title:"操作",minWidth:200,align:"center",render:function(e,i){return e("div",[e("a",{props:{type:"primary"},style:{marginRight:"10px"},on:{click:function(){t.talentIds=t.customerIds[i.row.clientId],t.showTalent=!0,t.getTalentList(i.row.clientId)}}},"人才合同续约")])}}],talentIds:[],talentColumns:[{type:"selection",width:60,align:"center"},{title:"姓名",key:"name",minWidth:100,render:function(e,i){return e("div",[e("a",{props:{type:"primary",size:"small"},style:{marginRight:"5px"},on:{click:function(){t.getDetail(i.row,"edit")}}},i.row.name)])}},{title:"年龄",key:"age",minWidth:80},{title:"性别",key:"sex",minWidth:80},{title:"面试岗位",key:"position",minWidth:100},{title:"手机号",key:"phone",minWidth:130},{title:"状态",key:"statusName",minWidth:80},{title:"入职日期",key:"entryTime",minWidth:110},{title:"离职日期",key:"leaveTime",minWidth:110},{title:"工作厂",key:"client",minWidth:100}],customerData:[],showCustomer:!1,showTalent:!1,customerIds:[],talentData:[]}},created:function(){this.getList()},methods:{toList:function(t){switch(t.type){case"job":this.showCustomer=!0,this.customerIds=t.client,this.getCustomer(Object.keys(t.client));break;case"staff":this.$router.push({path:"/personnelManagement/staff",query:{staffId:t.staffId}});break;case"supplier":this.$router.push({path:"/supplierManagement/supplier",query:{supplierId:t.supplierId}});break;case"client":this.$router.push({path:"/customerManagement/customer",query:{clientId:t.clientId,isWork:-1}});break}},getList:function(){var t=this;this.loading=!0,Object(o["m"])().then((function(e){t.loading=!1,0===e.ret?(t.tableData=e.data.list,sessionStorage.setItem("todosum",e.data.sum)):t.$Message.error(e.msg||"接口错误")}))},getCustomer:function(t){var e=this;this.loading=!0,Object(r["i"])({isWork:-1,clientId:t}).then((function(t){e.loading=!1,0===t.ret?(e.customerData=t.data.list,e.pageination=t.data.pageInfo):e.$Message.error(t.msg||"接口错误")}))},getTalentList:function(t){var e=this;this.loading=!0,Object(l["u"])({page:this.page,pageSize:10,clientId:t,jobId:this.talentIds}).then((function(t){e.loading=!1,0===t.ret?(e.talentData=t.data.list,e.pageination=t.data.pageInfo):e.$Message.error(t.msg||"接口错误")}))},changePage:function(t){this.page=t,this.getList()},show:function(t,e){this.erTitle="新增",this.$refs.Drawer.DrawerToShow()},back:function(){this.showCustomer=!1,this.showTalent=!1},backToCu:function(){this.showCustomer=!0,this.showTalent=!1},getDetail:function(t){this.erTitle=t.name,this.$refs.detail.DrawerToShow(t.jobId,t.name)}}},u=c,d=(i("6091"),i("2877")),h=Object(d["a"])(u,a,n,!1,null,"1e06412e",null);e["default"]=h.exports},"5da2":function(t,e,i){},6091:function(t,e,i){"use strict";var a=i("5da2"),n=i.n(a);n.a}}]);