-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2020 年 12 月 16 日 14:50
-- 服务器版本: 5.7.29
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `kj_factory_production_erp`
--

-- --------------------------------------------------------

--
-- 表的结构 `dgtx_places`
--

DROP TABLE IF EXISTS `dgtx_places`;
CREATE TABLE IF NOT EXISTS `dgtx_places` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cname` varchar(120) NOT NULL DEFAULT '',
  `ctype` tinyint(1) NOT NULL DEFAULT '2',
  `creator` varchar(32) DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `ctype` (`ctype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3486 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_bargain_goods`
--

DROP TABLE IF EXISTS `kj_bargain_goods`;
CREATE TABLE IF NOT EXISTS `kj_bargain_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `createTime` datetime DEFAULT NULL COMMENT '添加时间',
  `updateTime` datetime DEFAULT NULL COMMENT '修改时间',
  `isValid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0，未删除， 1，已删除',
  `stationId` int(11) DEFAULT NULL COMMENT '站点id',
  `createUser` varchar(32) DEFAULT NULL COMMENT '创建人',
  `updateUser` varchar(32) DEFAULT NULL COMMENT '修改人',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品id',
  `endPrice` int(11) DEFAULT NULL COMMENT '设置底价',
  `startTime` datetime DEFAULT NULL COMMENT '活动开始时间',
  `endTime` datetime DEFAULT NULL COMMENT '活动结束时间',
  `hour` int(11) DEFAULT '0' COMMENT '砍价限时-小时',
  `endPriceHide` tinyint(1) DEFAULT '0' COMMENT '显示底价  0-显示 1-不显示',
  `endPriceIsOrder` tinyint(1) DEFAULT '1' COMMENT '没到底价   0-可以下单 1-不可下单',
  `myCat` tinyint(1) DEFAULT '0' COMMENT '自己砍价   0-允许  1-禁止',
  `launches` int(11) DEFAULT '0' COMMENT '发起次数  0- 每个商品只允许发起一次砍价  1- 允许多次发起同一个商品的砍价',
  `totalCat` int(11) DEFAULT '0' COMMENT '可砍价总次数',
  `eachCat` int(11) DEFAULT '0' COMMENT '每人可砍次数',
  `maximum` int(11) DEFAULT '0' COMMENT '活动可发起次数',
  `probability` text COMMENT '每次砍价概率[{"minCatPrice":1,"maxCatPrice":5,"rand":20%}]',
  `rule` text COMMENT '砍价规则',
  `storeId` int(11) DEFAULT '0' COMMENT '入驻商户的id',
  `goodsAttrId` int(11) NOT NULL DEFAULT '0' COMMENT '商品属性id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='砍价商品表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_basis`
--

DROP TABLE IF EXISTS `kj_basis`;
CREATE TABLE IF NOT EXISTS `kj_basis` (
  `basisId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`basisId`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='基础数据表' AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_client_contract`
--

DROP TABLE IF EXISTS `kj_client_contract`;
CREATE TABLE IF NOT EXISTS `kj_client_contract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `startTime` date NOT NULL COMMENT '合同开始时间',
  `endTime` date NOT NULL COMMENT '合同结束时间',
  `pic` text NOT NULL COMMENT '图片',
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `staffId` int(11) NOT NULL COMMENT '职工编号',
  `basisId` int(11) NOT NULL COMMENT '合同类型',
  `use` int(11) DEFAULT '0',
  `time` date DEFAULT NULL,
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='客户合同表' AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_client_info`
--

DROP TABLE IF EXISTS `kj_client_info`;
CREATE TABLE IF NOT EXISTS `kj_client_info` (
  `clientId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 潜在客户 2普通客户 3重要客户 4无机会客户',
  `staffId` int(11) NOT NULL,
  `industryId` int(11) DEFAULT '0' COMMENT '行业编号',
  `provinceId` int(11) DEFAULT '0' COMMENT '省',
  `cityId` int(11) DEFAULT '0' COMMENT '市',
  `areaId` int(11) DEFAULT '0' COMMENT '区',
  `tell` varchar(20) DEFAULT NULL COMMENT '手机',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `introduction` text COMMENT '客户介绍',
  `website` varchar(80) DEFAULT NULL COMMENT '官网',
  `staffRangeMin` int(255) DEFAULT NULL COMMENT '最小员工范围',
  `staffRangeMax` int(255) DEFAULT NULL COMMENT '最大员工范围',
  `isWork` tinyint(1) DEFAULT '0' COMMENT '0 待开发 1已合作',
  `price` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `range` int(11) DEFAULT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='客户信息表' AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_client_Interview_record`
--

DROP TABLE IF EXISTS `kj_client_Interview_record`;
CREATE TABLE IF NOT EXISTS `kj_client_Interview_record` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `time` date DEFAULT NULL,
  `staffId` int(11) DEFAULT NULL COMMENT '职员编号',
  `clientId` int(11) DEFAULT NULL COMMENT '客户编号',
  `content` text COMMENT '内容',
  `pic` text COMMENT '图片',
  `start` varchar(30) DEFAULT NULL COMMENT '开始时间',
  `end` varchar(30) DEFAULT NULL COMMENT '结束时间',
  `personId` int(11) DEFAULT NULL COMMENT '联系人',
  `followType` int(11) DEFAULT NULL COMMENT '跟进方式 1 电话 2 邮件 3面谈 4 其他',
  `status` tinyint(1) DEFAULT NULL COMMENT '0 跟进 1成交',
  PRIMARY KEY (`recordId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='客户跟进记录表' AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_client_person`
--

DROP TABLE IF EXISTS `kj_client_person`;
CREATE TABLE IF NOT EXISTS `kj_client_person` (
  `personId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `tell` varchar(30) DEFAULT NULL COMMENT '座机号码',
  `phone` varchar(30) DEFAULT NULL COMMENT '手机号码',
  `name` varchar(30) NOT NULL COMMENT '联系人姓名',
  `department` varchar(30) DEFAULT NULL COMMENT '部门',
  `position` varchar(30) DEFAULT NULL COMMENT '职位',
  `remark` text COMMENT '备注',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `weixin` varchar(255) DEFAULT NULL COMMENT '微信',
  `qq` varchar(30) DEFAULT NULL COMMENT 'qq',
  PRIMARY KEY (`personId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='客户联系人表' AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_config`
--

DROP TABLE IF EXISTS `kj_config`;
CREATE TABLE IF NOT EXISTS `kj_config` (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `publicDay` int(11) DEFAULT NULL COMMENT '共享日期',
  `contractDay` int(11) DEFAULT NULL COMMENT '合同到期提示日期',
  `leaveTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`configId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='配置表' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods`
--

DROP TABLE IF EXISTS `kj_goods`;
CREATE TABLE IF NOT EXISTS `kj_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `categoryId` int(11) DEFAULT '0' COMMENT '类别id',
  `price` int(11) DEFAULT '0' COMMENT '价格',
  `number` varchar(32) DEFAULT NULL COMMENT '编号',
  `name` varchar(32) DEFAULT NULL COMMENT '物品名称',
  `unit` varchar(5) DEFAULT NULL COMMENT '单位',
  `pic` varchar(500) DEFAULT NULL COMMENT '图片',
  `describe` varchar(225) DEFAULT NULL COMMENT '描述',
  `remark` varchar(225) DEFAULT NULL COMMENT '备注',
  `isFinished` tinyint(1) DEFAULT '0' COMMENT '1成品；2半成品',
  `weight` varchar(20) DEFAULT NULL COMMENT '重量',
  `volume` varchar(20) DEFAULT NULL COMMENT '体积',
  `parameter` varchar(20) DEFAULT NULL COMMENT '参数',
  `attr` varchar(50) DEFAULT NULL COMMENT '规格',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_adjustment`
--

DROP TABLE IF EXISTS `kj_goods_adjustment`;
CREATE TABLE IF NOT EXISTS `kj_goods_adjustment` (
  `adjustmentId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `remark` varchar(255) DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`adjustmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='库存调整主表' AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_adjustment_detail`
--

DROP TABLE IF EXISTS `kj_goods_adjustment_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_adjustment_detail` (
  `adjustmentDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `adjustmentId` int(11) NOT NULL DEFAULT '0' COMMENT '调整主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`adjustmentDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='库存调整详情表' AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_allocation`
--

DROP TABLE IF EXISTS `kj_goods_allocation`;
CREATE TABLE IF NOT EXISTS `kj_goods_allocation` (
  `allocationId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `outWarehouseId` int(11) NOT NULL DEFAULT '0' COMMENT '调出仓库',
  `enterWarehouseId` int(11) NOT NULL DEFAULT '0' COMMENT '调入仓库',
  `remark` varchar(255) DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`allocationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='调拨表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_allocation_detail`
--

DROP TABLE IF EXISTS `kj_goods_allocation_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_allocation_detail` (
  `allocationDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `allocationId` int(11) NOT NULL DEFAULT '0' COMMENT '调拨主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`allocationDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='调拨详情表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_attr`
--

DROP TABLE IF EXISTS `kj_goods_attr`;
CREATE TABLE IF NOT EXISTS `kj_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `attr` text NOT NULL COMMENT 'attr例[{"attr_group_id": "3","attr_group_name": "颜色","attr_id": "4", "attr_name": "白色"}, {"attr_group_id": "4","attr_group_name": "内存","attr_id": "6","attr_name": "4G"}]',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `pic` varchar(255) DEFAULT NULL COMMENT '图片',
  `isDefault` tinyint(1) DEFAULT '0' COMMENT '0不是默认属性，1是默认属性',
  `createTime` datetime DEFAULT NULL COMMENT '添加时间',
  `updateTime` datetime DEFAULT NULL COMMENT '修改时间',
  `isValid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0，未删除， 1，已删除',
  `stationId` int(11) NOT NULL COMMENT '站点id',
  `createUser` varchar(32) DEFAULT NULL COMMENT '创建人',
  `updateUser` varchar(32) DEFAULT NULL COMMENT '修改人',
  `price` int(11) NOT NULL COMMENT '价格',
  `originalPrice` int(11) DEFAULT '0' COMMENT '原价',
  `costPrice` int(11) DEFAULT '0' COMMENT '成本价',
  `goodsSales` int(11) DEFAULT '0' COMMENT '实际销量',
  `weight` int(11) DEFAULT '0' COMMENT '重量',
  `goodsNO` varchar(32) DEFAULT NULL COMMENT '商品编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品规格表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_borrow`
--

DROP TABLE IF EXISTS `kj_goods_borrow`;
CREATE TABLE IF NOT EXISTS `kj_goods_borrow` (
  `borrowId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `borrowUser` varchar(32) NOT NULL DEFAULT ' ' COMMENT '领用人',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `remark` varchar(255) DEFAULT ' ' COMMENT '备注',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型（1领用，2退领）',
  `date` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`borrowId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='物品领用表' AUTO_INCREMENT=74 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_borrow_detail`
--

DROP TABLE IF EXISTS `kj_goods_borrow_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_borrow_detail` (
  `borrowDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `borrowId` int(11) NOT NULL DEFAULT '0' COMMENT '领用主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`borrowDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='物品领用详情表' AUTO_INCREMENT=185 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_category`
--

DROP TABLE IF EXISTS `kj_goods_category`;
CREATE TABLE IF NOT EXISTS `kj_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) DEFAULT NULL COMMENT '编号',
  `name` varchar(20) DEFAULT NULL COMMENT '名称',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_in_storage`
--

DROP TABLE IF EXISTS `kj_goods_in_storage`;
CREATE TABLE IF NOT EXISTS `kj_goods_in_storage` (
  `storageId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `storageDate` date DEFAULT NULL COMMENT '入库日期',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) DEFAULT ' ' COMMENT '供应商',
  `staffId` int(11) DEFAULT '0' COMMENT '职工id',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`storageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='生产入库表' AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_in_storage_detail`
--

DROP TABLE IF EXISTS `kj_goods_in_storage_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_in_storage_detail` (
  `storageDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `storageId` int(11) NOT NULL DEFAULT '0' COMMENT '生产入库主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '进货价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`storageDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='生产入库详情表' AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_material`
--

DROP TABLE IF EXISTS `kj_goods_material`;
CREATE TABLE IF NOT EXISTS `kj_goods_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) DEFAULT '0' COMMENT '产品id',
  `materialId` int(11) DEFAULT '0' COMMENT '物料id',
  `number` int(11) DEFAULT '0' COMMENT '数量',
  `describe` varchar(225) DEFAULT NULL COMMENT '描述',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='产品，物料关联表' AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_production_consumption`
--

DROP TABLE IF EXISTS `kj_goods_production_consumption`;
CREATE TABLE IF NOT EXISTS `kj_goods_production_consumption` (
  `consumptionId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `consumptionDate` date DEFAULT NULL COMMENT '生产消耗日期',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) DEFAULT ' ' COMMENT '供应商',
  `staffId` int(11) DEFAULT '0' COMMENT '职工id',
  `storageId` int(11) DEFAULT '0' COMMENT '生产入库id',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`consumptionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='生产物料消耗表' AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_production_consumption_detail`
--

DROP TABLE IF EXISTS `kj_goods_production_consumption_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_production_consumption_detail` (
  `consumptionDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `consumptionId` int(11) NOT NULL DEFAULT '0' COMMENT '主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '进货价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`consumptionDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='生产物料消耗详情' AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_purchase`
--

DROP TABLE IF EXISTS `kj_goods_purchase`;
CREATE TABLE IF NOT EXISTS `kj_goods_purchase` (
  `purchaseId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `purchaseDate` date DEFAULT NULL COMMENT '进货日期',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) DEFAULT ' ' COMMENT '供应商',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`purchaseId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='进货主表' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_purchase_detail`
--

DROP TABLE IF EXISTS `kj_goods_purchase_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_purchase_detail` (
  `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `purchaseId` int(11) NOT NULL DEFAULT '0' COMMENT '进货主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '进货价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`purchaseDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='进货详情表' AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_return_goods`
--

DROP TABLE IF EXISTS `kj_goods_return_goods`;
CREATE TABLE IF NOT EXISTS `kj_goods_return_goods` (
  `returnId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) DEFAULT ' ' COMMENT '供应商',
  `clientId` int(11) DEFAULT '0' COMMENT '客户id',
  `returnDate` date DEFAULT NULL COMMENT '退货日期',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`returnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='退货表' AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_return_goods_detail`
--

DROP TABLE IF EXISTS `kj_goods_return_goods_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_return_goods_detail` (
  `returnDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `returnId` int(11) NOT NULL DEFAULT '0' COMMENT '退货主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '进货价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`returnDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='退货详情表' AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_send`
--

DROP TABLE IF EXISTS `kj_goods_send`;
CREATE TABLE IF NOT EXISTS `kj_goods_send` (
  `sendId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `orderId` int(11) DEFAULT '0' COMMENT '订单id',
  `houseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `sendDate` date DEFAULT NULL COMMENT '发货日期',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) DEFAULT ' ' COMMENT '供应商',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`sendId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='发货主表' AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_send_detail`
--

DROP TABLE IF EXISTS `kj_goods_send_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_send_detail` (
  `sendDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `sendId` int(11) NOT NULL DEFAULT '0' COMMENT '进货主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '进货价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`sendDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='发货详情表' AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_station`
--

DROP TABLE IF EXISTS `kj_goods_station`;
CREATE TABLE IF NOT EXISTS `kj_goods_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` varchar(50) DEFAULT NULL COMMENT '产品id',
  `groupId` int(11) DEFAULT '0' COMMENT '权限组id',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='岗位关联产品' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_stock`
--

DROP TABLE IF EXISTS `kj_goods_stock`;
CREATE TABLE IF NOT EXISTS `kj_goods_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) DEFAULT '0' COMMENT '物品id',
  `wareHouseId` int(11) DEFAULT '0' COMMENT '仓库id',
  `num` int(11) DEFAULT '0' COMMENT '数量',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='库存表' AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_stock_loss`
--

DROP TABLE IF EXISTS `kj_goods_stock_loss`;
CREATE TABLE IF NOT EXISTS `kj_goods_stock_loss` (
  `stockLossId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `type` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `houseId` int(11) DEFAULT '0',
  `sn` varchar(32) NOT NULL DEFAULT ' ' COMMENT '编号',
  `remark` varchar(255) DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`stockLossId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='报损主表' AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_stock_loss_detail`
--

DROP TABLE IF EXISTS `kj_goods_stock_loss_detail`;
CREATE TABLE IF NOT EXISTS `kj_goods_stock_loss_detail` (
  `stockLossDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `type` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `stockLossId` int(11) NOT NULL DEFAULT '0' COMMENT '报损主表id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`stockLossDetailId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='报损详情表' AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_stock_record`
--

DROP TABLE IF EXISTS `kj_goods_stock_record`;
CREATE TABLE IF NOT EXISTS `kj_goods_stock_record` (
  `stockRecordId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) DEFAULT '0' COMMENT '1产品；2物料',
  `wareHouseId` int(11) NOT NULL DEFAULT '0' COMMENT '仓库id',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '金额',
  `type` tinyint(4) NOT NULL DEFAULT '11' COMMENT '11进货，12拨入，13退领，14销售退回，21退货，22拨出，23领用，24销售、25报损，31库存调整',
  `unionId` tinyint(4) DEFAULT '0' COMMENT '关联id （进货，调拨，销售，领用，报损，库存调整表关联id）',
  `remark` varchar(255) DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) DEFAULT ' ' COMMENT '创建者',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) DEFAULT ' ' COMMENT '修改者',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0正常，1删除',
  PRIMARY KEY (`stockRecordId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='库存记录流水表' AUTO_INCREMENT=493 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_goods_ware_house`
--

DROP TABLE IF EXISTS `kj_goods_ware_house`;
CREATE TABLE IF NOT EXISTS `kj_goods_ware_house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) DEFAULT NULL COMMENT '编号',
  `name` varchar(32) DEFAULT NULL COMMENT '仓库名称',
  `address` varchar(225) DEFAULT NULL COMMENT '地址',
  `keeper` varchar(32) DEFAULT NULL COMMENT '保管员',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0' COMMENT '0未删除；1已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='仓库信息表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_industry`
--

DROP TABLE IF EXISTS `kj_industry`;
CREATE TABLE IF NOT EXISTS `kj_industry` (
  `industryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `pId` int(11) DEFAULT '0' COMMENT '父级编号',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`industryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_career_record`
--

DROP TABLE IF EXISTS `kj_job_career_record`;
CREATE TABLE IF NOT EXISTS `kj_job_career_record` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 入职 1离职',
  `jobId` int(11) NOT NULL DEFAULT '0' COMMENT '求职者编号',
  `staffId` int(11) DEFAULT '0' COMMENT '推荐人编号',
  `clientId` int(11) NOT NULL DEFAULT '0' COMMENT '客户编号',
  `supplierId` int(11) DEFAULT '0' COMMENT '供应商编号',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `department` varchar(30) DEFAULT NULL COMMENT '部门',
  `startTime` date DEFAULT NULL COMMENT '开始时间',
  `endTime` date DEFAULT NULL COMMENT '结束时间',
  `idCard` varchar(18) DEFAULT NULL COMMENT '身份证',
  `position` varchar(30) DEFAULT NULL COMMENT '入职岗位',
  `interviewTime` date DEFAULT NULL COMMENT '面试时间',
  `trainTime` date DEFAULT NULL COMMENT '培训时间',
  `politicalStatus` tinyint(1) DEFAULT NULL COMMENT '政治面貌 1 团员 2 党员 3群众 4 其他',
  `bank` varchar(255) DEFAULT NULL COMMENT '开户银行',
  `bankCard` varchar(255) DEFAULT NULL COMMENT '银行账号',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `emergencyContact` varchar(30) DEFAULT NULL COMMENT '紧急联系人',
  `emergencyTell` varchar(255) DEFAULT NULL COMMENT '紧急电话',
  `first` tinyint(1) DEFAULT '0' COMMENT '是否第一次买社保 0 是 1否',
  `laborContractPic` text COMMENT '劳动合同图',
  `cedicalReportPic` text COMMENT '体检报告图',
  `time` date DEFAULT NULL COMMENT '入职/离职时间',
  `leaveReason` text COMMENT '离职原因',
  `leavePic` text COMMENT '离职图',
  `socialSecurity` varchar(50) DEFAULT NULL COMMENT '社保',
  `remark` text COMMENT '备注',
  `emergency` text,
  `idCardPositivePic` varchar(255) DEFAULT NULL,
  `idCardReversePic` varchar(255) DEFAULT NULL,
  `leaveType` tinyint(1) DEFAULT NULL,
  `jobNumber` varchar(50) DEFAULT NULL COMMENT '工号',
  `bankReversePic` varchar(255) DEFAULT NULL,
  `bankPositivePic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recordId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='求职者职业生涯记录表' AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_info`
--

DROP TABLE IF EXISTS `kj_job_info`;
CREATE TABLE IF NOT EXISTS `kj_job_info` (
  `jobId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL COMMENT '状态 1 共享资源  2 跟进 3 入职 4离职',
  `clientId` int(11) DEFAULT '0' COMMENT '外配上班的客户编号',
  `staffId` int(11) DEFAULT '0' COMMENT '推荐人 职工编号',
  `supplierId` int(11) DEFAULT '0' COMMENT '供应商编号',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(1) DEFAULT NULL COMMENT '0 女 1男',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `education` tinyint(1) DEFAULT NULL COMMENT '1 大专 2本科',
  `channelId` int(11) DEFAULT NULL COMMENT '渠道',
  `remark` text COMMENT '备注',
  `userId` int(11) DEFAULT NULL,
  `workTime` date DEFAULT NULL COMMENT '入职时间',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `position` varchar(30) DEFAULT NULL,
  `isLunarCalendar` tinyint(1) DEFAULT '0' COMMENT '0 农历 1 阳历',
  `idCard` varchar(30) DEFAULT NULL COMMENT '身份证',
  `startTime` date DEFAULT NULL COMMENT '合同开始时间',
  `endTime` date DEFAULT NULL COMMENT '合同结束时间',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `entryId` int(11) DEFAULT NULL COMMENT '入职合同编号',
  `leaveId` int(11) DEFAULT NULL COMMENT '离职合同编号',
  `jobNumber` varchar(30) DEFAULT NULL,
  `idCardPositivePic` varchar(255) DEFAULT NULL,
  `idCardReversePic` varchar(255) DEFAULT NULL,
  `leaveTime` datetime DEFAULT NULL,
  PRIMARY KEY (`jobId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='求职者信息表' AUTO_INCREMENT=214 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_interview_record`
--

DROP TABLE IF EXISTS `kj_job_interview_record`;
CREATE TABLE IF NOT EXISTS `kj_job_interview_record` (
  `interviewId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 邀约面试中 2面试通过 3面试未通过 4未参加面试',
  `jobId` int(11) DEFAULT '0' COMMENT '求职者编号',
  `clientId` int(11) DEFAULT NULL COMMENT '客户编号',
  `staffId` int(11) DEFAULT NULL COMMENT '职工编号',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `position` varchar(30) DEFAULT NULL COMMENT '职位',
  `time` datetime DEFAULT NULL COMMENT '面试时间',
  `skill` varchar(255) DEFAULT NULL COMMENT '技能',
  `remark` text COMMENT '备注',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `education` varchar(30) DEFAULT NULL COMMENT '学历',
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(30) DEFAULT NULL COMMENT '手机号',
  `sex` tinyint(1) DEFAULT NULL COMMENT '0 女 1男',
  PRIMARY KEY (`interviewId`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='求职者面试记录表' AUTO_INCREMENT=144 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_registra`
--

DROP TABLE IF EXISTS `kj_job_registra`;
CREATE TABLE IF NOT EXISTS `kj_job_registra` (
  `registraId` int(11) NOT NULL AUTO_INCREMENT COMMENT '报名编号',
  `jobId` int(11) NOT NULL COMMENT '人才编号',
  `recruitmentId` int(11) NOT NULL COMMENT '招聘编号',
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '是否删除 0否 1是',
  `createTime` datetime DEFAULT NULL COMMENT '报名时间',
  `creator` int(11) DEFAULT NULL COMMENT '新增人',
  `updateTime` datetime DEFAULT NULL COMMENT '修改时间',
  `updater` int(11) DEFAULT NULL COMMENT '修改人',
  `invite` tinyint(1) DEFAULT '2' COMMENT '是否邀约 1是 2否',
  PRIMARY KEY (`registraId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_skill`
--

DROP TABLE IF EXISTS `kj_job_skill`;
CREATE TABLE IF NOT EXISTS `kj_job_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `basisId` int(11) NOT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='求职者技能关联表' AUTO_INCREMENT=260 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_job_social_security`
--

DROP TABLE IF EXISTS `kj_job_social_security`;
CREATE TABLE IF NOT EXISTS `kj_job_social_security` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `basisId` int(11) NOT NULL,
  `recordId` int(11) NOT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='求职者社保关联表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_notice`
--

DROP TABLE IF EXISTS `kj_notice`;
CREATE TABLE IF NOT EXISTS `kj_notice` (
  `noticeId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `time` datetime DEFAULT NULL COMMENT '面试时间',
  `content` text COMMENT '内容',
  `staffId` int(11) DEFAULT NULL COMMENT '职工编号',
  PRIMARY KEY (`noticeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='通知表' AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_payments_account`
--

DROP TABLE IF EXISTS `kj_payments_account`;
CREATE TABLE IF NOT EXISTS `kj_payments_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL COMMENT '账户名称',
  `accountNumber` varchar(50) DEFAULT NULL COMMENT '账号',
  `incomeAmount` int(11) DEFAULT '0' COMMENT '收入金额',
  `expenditureAmount` int(11) DEFAULT '0' COMMENT '支出金额',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_payments_log`
--

DROP TABLE IF EXISTS `kj_payments_log`;
CREATE TABLE IF NOT EXISTS `kj_payments_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(4) NOT NULL COMMENT '类型：1收入；2支出；3转账',
  `needBill` tinyint(1) DEFAULT '0' COMMENT '1开发票；2不开发票',
  `departmentId` int(11) DEFAULT '0' COMMENT '部门',
  `date` date DEFAULT NULL COMMENT '发生日期',
  `paymentsTypeId` int(11) DEFAULT '0' COMMENT '收支类别',
  `incomeAccount` int(11) DEFAULT '0' COMMENT '收入账户',
  `expenditureAccount` int(11) DEFAULT '0' COMMENT '支出账户',
  `amount` int(11) DEFAULT '0' COMMENT '金额',
  `describe` varchar(100) DEFAULT NULL COMMENT '备注',
  `orderId` int(11) DEFAULT '0' COMMENT '订单id',
  `clientId` int(11) DEFAULT '0' COMMENT '客户id',
  `objectId` int(11) DEFAULT '0' COMMENT '对象id',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_payments_statics_day`
--

DROP TABLE IF EXISTS `kj_payments_statics_day`;
CREATE TABLE IF NOT EXISTS `kj_payments_statics_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0' COMMENT '1收入；2支出',
  `day` date DEFAULT NULL COMMENT '统计日期',
  `amount` int(11) DEFAULT '0' COMMENT '金额',
  `accountId` int(11) NOT NULL DEFAULT '0' COMMENT '账户id',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_payments_type`
--

DROP TABLE IF EXISTS `kj_payments_type`;
CREATE TABLE IF NOT EXISTS `kj_payments_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0' COMMENT '1收入类型；2支出类型',
  `name` varchar(32) NOT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_print_templates`
--

DROP TABLE IF EXISTS `kj_print_templates`;
CREATE TABLE IF NOT EXISTS `kj_print_templates` (
  `printTemplatesId` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `format` varchar(30) DEFAULT NULL COMMENT '版式',
  `h5` text COMMENT 'h5内容',
  `creator` varchar(32) DEFAULT NULL COMMENT '创建用户',
  `updater` varchar(32) DEFAULT NULL COMMENT '更新用户',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT '1700-07-18 00:00:00' COMMENT '更新时间',
  `isValid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 未删除 1 已删除',
  PRIMARY KEY (`printTemplatesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='打印模板表' AUTO_INCREMENT=193 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_project_info`
--

DROP TABLE IF EXISTS `kj_project_info`;
CREATE TABLE IF NOT EXISTS `kj_project_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '项目名称',
  `startTime` date DEFAULT NULL COMMENT '开始时间',
  `cycle` varchar(50) DEFAULT NULL COMMENT '项目周期',
  `endTime` date DEFAULT NULL COMMENT '结束时间',
  `projectLeader` int(11) DEFAULT '0' COMMENT '项目责任人',
  `projectExplain` varchar(225) DEFAULT NULL COMMENT '项目描述，说明',
  `projectScore` int(11) DEFAULT '0' COMMENT '项目评分',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '项目金额',
  `receiptPrice` int(11) DEFAULT '0' COMMENT '收款金额',
  `expenditurePrice` int(11) DEFAULT '0' COMMENT '支出金额',
  `reportUserId` int(11) NOT NULL DEFAULT '0' COMMENT '报备人id',
  `reportTime` date NOT NULL COMMENT '项目报备时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '项目状态：0未设置；1待审；2已报备；3一开始；4已结束',
  `contractStatus` tinyint(4) DEFAULT '1' COMMENT '合同收发状态：0未设置；1未发送；2已发送；3已签收',
  `receiptStatus` tinyint(4) DEFAULT '1' COMMENT '收款状态：0未设置；1未收款；2收款一部分；3收款完成',
  `joinPersonal` varchar(50) DEFAULT NULL COMMENT '参与人员：张三，李四',
  `belongCustomer` int(11) DEFAULT '0' COMMENT '所属客户',
  `clientPersonId` int(11) DEFAULT '0' COMMENT '所属客户联系人id',
  `projectAddress` varchar(225) DEFAULT NULL COMMENT '项目地点',
  `projectDescribe` varchar(225) DEFAULT NULL COMMENT '项目描述',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0' COMMENT '0未删除；1已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_quality_testing_log`
--

DROP TABLE IF EXISTS `kj_quality_testing_log`;
CREATE TABLE IF NOT EXISTS `kj_quality_testing_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salesOrderId` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '1质检成功；2质检失败',
  `describe` varchar(500) DEFAULT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_receive_log`
--

DROP TABLE IF EXISTS `kj_receive_log`;
CREATE TABLE IF NOT EXISTS `kj_receive_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0' COMMENT '类型：1采购单收货记录；2订单发货记录',
  `orderId` int(11) DEFAULT '0' COMMENT '采购单或销售订单id',
  `orderDetailId` int(11) DEFAULT '0' COMMENT '订单详情id',
  `goodsId` int(11) DEFAULT '0' COMMENT '物品id',
  `num` int(11) DEFAULT '0' COMMENT '数量',
  `price` int(11) DEFAULT '0' COMMENT '物品单价',
  `unit` varchar(5) DEFAULT NULL COMMENT '单位',
  `time` datetime DEFAULT '1970-01-01 00:00:00' COMMENT '产生时间',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_recruitment`
--

DROP TABLE IF EXISTS `kj_recruitment`;
CREATE TABLE IF NOT EXISTS `kj_recruitment` (
  `recruitmentId` int(11) NOT NULL AUTO_INCREMENT COMMENT '招聘ID',
  `clientId` int(11) NOT NULL COMMENT '客户ID',
  `sex` tinyint(1) NOT NULL COMMENT '性别 1男，0女，2无要求',
  `minSalary` int(11) NOT NULL COMMENT '最小薪资',
  `maxSalary` int(11) NOT NULL COMMENT '最大薪资',
  `minAge` int(3) DEFAULT NULL COMMENT '最小年龄',
  `maxAge` int(3) DEFAULT NULL COMMENT '最大年龄',
  `education` int(3) DEFAULT NULL COMMENT '学历',
  `provinceId` int(11) DEFAULT NULL COMMENT '省',
  `cityId` int(11) DEFAULT NULL COMMENT '市',
  `areaId` int(11) DEFAULT NULL COMMENT '区',
  `advantage` varchar(500) DEFAULT NULL COMMENT '招聘优势',
  `post` varchar(20) NOT NULL COMMENT '岗位',
  `status` tinyint(1) DEFAULT NULL COMMENT '活动状态：1.发布，2.撤销发布',
  `isValid` tinyint(1) DEFAULT '0' COMMENT '0，未删除， 1，已删除',
  `staffId` int(11) DEFAULT NULL COMMENT '发布人id',
  `creator` varchar(30) DEFAULT NULL COMMENT '创建人',
  `updater` varchar(30) DEFAULT NULL COMMENT '修改人',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`recruitmentId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_report`
--

DROP TABLE IF EXISTS `kj_report`;
CREATE TABLE IF NOT EXISTS `kj_report` (
  `reportId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `jobAdd` tinyint(1) DEFAULT NULL,
  `interviewAdd` tinyint(1) DEFAULT NULL,
  `entryAdd` tinyint(1) DEFAULT NULL,
  `interviewGoAdd` tinyint(1) DEFAULT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `time` date DEFAULT NULL,
  PRIMARY KEY (`reportId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=247 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_sales_order`
--

DROP TABLE IF EXISTS `kj_sales_order`;
CREATE TABLE IF NOT EXISTS `kj_sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) DEFAULT NULL COMMENT '订单编号',
  `contractCode` varchar(32) DEFAULT NULL COMMENT '合同编号',
  `orderDate` date NOT NULL COMMENT '订单日期',
  `clientId` int(11) DEFAULT '0' COMMENT '客户名称',
  `clientPersonId` int(11) DEFAULT '0' COMMENT '客户联系人id',
  `totalPrice` int(11) DEFAULT '0' COMMENT '订单总金额',
  `receiptPrice` int(11) DEFAULT '0' COMMENT '收款金额',
  `expenditureAmount` int(11) DEFAULT '0' COMMENT '支出金额',
  `deliveryDate` date DEFAULT NULL COMMENT '要求交货日期',
  `sendDate` date DEFAULT NULL COMMENT '发货时间',
  `sendWay` varchar(32) DEFAULT NULL COMMENT '发货方式',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态：1生产中；2生产完成；3已发货；4已完成',
  `collectionStatus` tinyint(1) DEFAULT '0' COMMENT '1未完成；2已完成',
  `fileUrl` varchar(5000) DEFAULT NULL COMMENT '合同url',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='销售订单表' AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_sales_order_detail`
--

DROP TABLE IF EXISTS `kj_sales_order_detail`;
CREATE TABLE IF NOT EXISTS `kj_sales_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT '0' COMMENT '订单id',
  `goodsId` int(11) DEFAULT '0' COMMENT '物品id',
  `price` int(11) DEFAULT '0' COMMENT '单价',
  `isTax` tinyint(1) DEFAULT '0' COMMENT '1不含税；2含税',
  `taxPrice` int(11) DEFAULT '0' COMMENT '含税价格',
  `num` int(11) DEFAULT '0' COMMENT '订购数量',
  `deliveryNum` int(11) DEFAULT '0' COMMENT '交货数量',
  `unit` varchar(5) DEFAULT NULL COMMENT '单位',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='销售订单详情表' AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_sms_log`
--

DROP TABLE IF EXISTS `kj_sms_log`;
CREATE TABLE IF NOT EXISTS `kj_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `isCheck` tinyint(4) DEFAULT '0' COMMENT '是否验证：0未验证；1已验证',
  `checkTime` datetime DEFAULT NULL COMMENT '验证时间',
  `createTime` datetime DEFAULT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `isValid` tinyint(4) DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_staff_contract`
--

DROP TABLE IF EXISTS `kj_staff_contract`;
CREATE TABLE IF NOT EXISTS `kj_staff_contract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `startTime` date DEFAULT NULL COMMENT '开始时间',
  `endTime` date DEFAULT NULL COMMENT '结束时间',
  `laborContractPic` text COMMENT '劳动合同',
  `competitionAgreementPic` text COMMENT '竞业协议',
  `confidentialityContract` text COMMENT '保密合同',
  `use` tinyint(1) DEFAULT '0' COMMENT '0 否 1是',
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='职工合同表' AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_staff_info`
--

DROP TABLE IF EXISTS `kj_staff_info`;
CREATE TABLE IF NOT EXISTS `kj_staff_info` (
  `staffId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `jobNumber` varchar(30) DEFAULT NULL COMMENT '工号',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `sectionId` int(11) DEFAULT NULL COMMENT '部门编号',
  `positionId` int(11) DEFAULT NULL COMMENT '职位编号',
  `entryTime` date DEFAULT NULL COMMENT '入职时间',
  `seniority` varchar(30) DEFAULT NULL COMMENT '工龄',
  `probation` varchar(30) DEFAULT NULL COMMENT '试用期',
  `startTime` date DEFAULT NULL COMMENT '开始时间',
  `endTime` date DEFAULT NULL COMMENT '结束时间',
  `trainTime` date DEFAULT NULL COMMENT '培训时间',
  `idName` varchar(30) DEFAULT NULL COMMENT '身份名称',
  `idCard` varchar(255) DEFAULT NULL COMMENT '身份证',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `isLunarCalendar` tinyint(1) DEFAULT NULL COMMENT '0 农历 1 阳历',
  `nation` varchar(20) DEFAULT NULL COMMENT '民族',
  `maritalStatus` tinyint(1) DEFAULT NULL COMMENT '1 未婚 2已婚 3离异 4丧偶 5分居',
  `address` varchar(255) DEFAULT NULL COMMENT '住址',
  `politicalStatus` tinyint(1) DEFAULT NULL COMMENT '1 团员 2 党员 3群众 4 其他',
  `socialSecurityAccount` varchar(255) DEFAULT NULL COMMENT '社保账号',
  `providentFundAccount` varchar(255) DEFAULT NULL COMMENT '公积金账号',
  `first` tinyint(1) DEFAULT NULL COMMENT '0 是 1否',
  `commercialInsurance` varbinary(255) DEFAULT NULL COMMENT '商业险',
  `bank` varchar(255) DEFAULT NULL COMMENT '开户银行',
  `bankCard` varchar(255) DEFAULT NULL COMMENT '银行账号',
  `education` int(11) DEFAULT NULL COMMENT '学历',
  `profession` varchar(30) DEFAULT NULL COMMENT '所学专业',
  `finishSchool` varchar(50) DEFAULT NULL COMMENT '毕业学校',
  `finishTime` date DEFAULT NULL COMMENT '毕业时间',
  `personName` varchar(30) DEFAULT NULL COMMENT '联系人姓名',
  `personType` tinyint(1) DEFAULT NULL COMMENT '1 父母 2配偶 3子女 4其他',
  `personTell` varchar(30) DEFAULT NULL COMMENT '联系人电话',
  `idCardPositivePic` varchar(100) DEFAULT NULL COMMENT '身份证正面',
  `idCardReversePic` varchar(100) DEFAULT NULL COMMENT '身份证国徽',
  `educationPic` text COMMENT '学历证书',
  `academicDegreePic` text COMMENT '学位证书',
  `Referrer` int(11) DEFAULT NULL COMMENT '推荐人',
  `channelId` int(11) DEFAULT NULL COMMENT '渠道编号',
  `remark` text COMMENT '备注',
  `userId` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0 在职 1 离职',
  `sex` tinyint(1) DEFAULT NULL COMMENT '0 女 1男',
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `socialSecurity` varchar(50) DEFAULT NULL COMMENT '社保',
  PRIMARY KEY (`staffId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='职工信息表' AUTO_INCREMENT=172 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_staff_leave`
--

DROP TABLE IF EXISTS `kj_staff_leave`;
CREATE TABLE IF NOT EXISTS `kj_staff_leave` (
  `leaveId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `time` date DEFAULT NULL COMMENT '离职时间',
  `leaveReason` text COMMENT '离职原因',
  `leavePic` text COMMENT '解除劳动合同协议',
  `leaveType` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`leaveId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='职工离职表' AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_staff_position`
--

DROP TABLE IF EXISTS `kj_staff_position`;
CREATE TABLE IF NOT EXISTS `kj_staff_position` (
  `positionId` int(11) NOT NULL AUTO_INCREMENT,
  `sectionId` int(11) DEFAULT NULL COMMENT '岗位编号',
  `parentId` int(11) DEFAULT NULL COMMENT '父级编号',
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`positionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='职工岗位表' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_staff_section`
--

DROP TABLE IF EXISTS `kj_staff_section`;
CREATE TABLE IF NOT EXISTS `kj_staff_section` (
  `sectionId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `name` varchar(30) DEFAULT NULL,
  `staffId` varchar(30) DEFAULT NULL COMMENT '联系人',
  `isCompany` varchar(30) DEFAULT '1' COMMENT '是否公司 1公司 0部门',
  `abbreviation` varchar(30) DEFAULT NULL COMMENT '简称',
  `startTime` date DEFAULT NULL COMMENT '开启时间',
  `code` varchar(255) DEFAULT NULL COMMENT '组织代码',
  PRIMARY KEY (`sectionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='职工部门表' AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_statistical`
--

DROP TABLE IF EXISTS `kj_statistical`;
CREATE TABLE IF NOT EXISTS `kj_statistical` (
  `statisticalId` int(11) NOT NULL AUTO_INCREMENT,
  `time` date NOT NULL,
  `jobAdd` tinyint(1) DEFAULT NULL,
  `interviewAdd` tinyint(1) DEFAULT NULL,
  `entryAdd` tinyint(1) DEFAULT NULL,
  `interviewGoAdd` tinyint(1) DEFAULT NULL,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `staffId` int(11) DEFAULT NULL,
  PRIMARY KEY (`statisticalId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=343 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_supplier_contract`
--

DROP TABLE IF EXISTS `kj_supplier_contract`;
CREATE TABLE IF NOT EXISTS `kj_supplier_contract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `startTime` date NOT NULL COMMENT '合同开始时间',
  `endTime` date NOT NULL COMMENT '合同结束时间',
  `pic` text NOT NULL COMMENT '图片',
  `supplierId` int(11) NOT NULL COMMENT '供应商编号',
  `staffId` int(11) NOT NULL COMMENT '职工编号',
  `basisId` int(11) NOT NULL COMMENT '合同类型',
  `use` tinyint(1) DEFAULT '0' COMMENT '0 否 1是',
  `time` date DEFAULT NULL,
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='供应商合同表' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_supplier_info`
--

DROP TABLE IF EXISTS `kj_supplier_info`;
CREATE TABLE IF NOT EXISTS `kj_supplier_info` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `provinceId` int(11) DEFAULT NULL COMMENT '省',
  `cityId` int(11) DEFAULT NULL COMMENT '市',
  `areaId` int(11) DEFAULT NULL COMMENT '区',
  `industryId` int(11) DEFAULT NULL COMMENT '行业类型',
  `staffId` int(11) DEFAULT NULL COMMENT '供应商负责人',
  `type` tinyint(1) DEFAULT NULL COMMENT '1 潜在客户 2普通客户 3重要客户 4无机会客户',
  `tell` varchar(30) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `settlement` varchar(255) DEFAULT NULL COMMENT '结算方式',
  `cycle` tinyint(1) DEFAULT NULL COMMENT '1 一个月 2 三个月 3 六个月 4九个月 5 十二个月 6按照合同周期',
  `startTime` date DEFAULT NULL COMMENT '合同周期-开始时间',
  `endTime` date DEFAULT NULL COMMENT '合同周期-结束时间',
  `name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `account` varchar(255) DEFAULT NULL COMMENT '账号',
  `accountBank` varchar(255) DEFAULT NULL COMMENT '开户行',
  `remark` text COMMENT '备注',
  `supplierType` tinyint(1) DEFAULT NULL COMMENT '1 公司 2 个人',
  `userName` varchar(30) DEFAULT NULL COMMENT '用户名',
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='供应商信息表' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `kj_supplier_record`
--

DROP TABLE IF EXISTS `kj_supplier_record`;
CREATE TABLE IF NOT EXISTS `kj_supplier_record` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updater` varchar(32) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT '0',
  `supplierId` int(11) DEFAULT NULL COMMENT '供应商',
  `phone` varchar(30) DEFAULT NULL COMMENT '手机号码',
  `content` text COMMENT '内容',
  `staffId` int(11) DEFAULT NULL COMMENT '职工编号',
  `clientId` int(11) DEFAULT NULL COMMENT '客户编号',
  `count` int(11) DEFAULT NULL COMMENT '数量',
  `position` varchar(30) DEFAULT NULL COMMENT '职位',
  PRIMARY KEY (`recordId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='供应商发单记录表' AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
