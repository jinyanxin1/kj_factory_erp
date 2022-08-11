/*
 Navicat Premium Data Transfer

 Source Server         : 快捷正式
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 47.112.110.172:3306
 Source Schema         : kj_factory_production_erp

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 11/08/2022 11:04:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dgtx_places
-- ----------------------------
DROP TABLE IF EXISTS `dgtx_places`;
CREATE TABLE `dgtx_places`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `cname` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ctype` tinyint(1) NOT NULL DEFAULT 2,
  `creator` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `ctype`(`ctype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3488 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dgtx_places
-- ----------------------------
INSERT INTO `dgtx_places` VALUES (1, 0, '中国', 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2, 1, '北京', 1, '18613962842', '18613962842', NULL, '2020-08-06 14:31:48', 0);
INSERT INTO `dgtx_places` VALUES (3, 1, '安徽', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (4, 1, '福建', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (5, 1, '甘肃', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (6, 1, '广东', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (7, 1, '广西', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (8, 1, '贵州', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (9, 1, '海南', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (10, 1, '河北', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (11, 1, '河南', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (12, 1, '黑龙江', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (13, 1, '湖北', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (14, 1, '湖南', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (15, 1, '吉林', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (16, 1, '江苏', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (17, 1, '江西', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (18, 1, '辽宁', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (19, 1, '内蒙古', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (20, 1, '宁夏', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (21, 1, '青海', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (22, 1, '山东', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (23, 1, '山西', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (24, 1, '陕西', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (25, 1, '上海', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (26, 1, '四川', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (27, 1, '天津', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (28, 1, '西藏', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (29, 1, '新疆', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (30, 1, '云南', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (31, 1, '浙江', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (32, 1, '重庆', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (33, 1, '香港', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (34, 1, '澳门', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (35, 1, '台湾', 1, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (36, 3, '安庆', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (37, 3, '蚌埠', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (38, 3, '巢湖', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (39, 3, '池州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (40, 3, '滁州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (41, 3, '阜阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (42, 3, '淮北', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (43, 3, '淮南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (44, 3, '黄山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (45, 3, '六安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (46, 3, '马鞍山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (47, 3, '宿州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (48, 3, '铜陵', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (49, 3, '芜湖', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (50, 3, '宣城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (51, 3, '亳州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (52, 2, '北京', 1, '15307416886', '15307416886', NULL, '2020-08-04 11:25:01', 0);
INSERT INTO `dgtx_places` VALUES (53, 4, '福州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (54, 4, '龙岩', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (55, 4, '南平', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (56, 4, '宁德', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (57, 4, '莆田', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (58, 4, '泉州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (59, 4, '三明', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (60, 4, '厦门', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (61, 4, '漳州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (62, 5, '兰州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (63, 5, '白银', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (64, 5, '定西', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (65, 5, '甘南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (66, 5, '嘉峪关', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (67, 5, '金昌', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (68, 5, '酒泉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (69, 5, '临夏', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (70, 5, '陇南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (71, 5, '平凉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (72, 5, '庆阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (73, 5, '天水', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (74, 5, '武威', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (75, 5, '张掖', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (76, 6, '广州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (77, 6, '深圳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (78, 6, '潮州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (79, 6, '东莞', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (80, 6, '佛山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (81, 6, '河源', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (82, 6, '惠州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (83, 6, '江门', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (84, 6, '揭阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (85, 6, '茂名', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (86, 6, '梅州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (87, 6, '清远', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (88, 6, '汕头', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (89, 6, '汕尾', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (90, 6, '韶关', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (91, 6, '阳江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (92, 6, '云浮', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (93, 6, '湛江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (94, 6, '肇庆', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (95, 6, '中山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (96, 6, '珠海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (97, 7, '南宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (98, 7, '桂林', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (99, 7, '百色', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (100, 7, '北海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (101, 7, '崇左', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (102, 7, '防城港', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (103, 7, '贵港', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (104, 7, '河池', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (105, 7, '贺州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (106, 7, '来宾', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (107, 7, '柳州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (108, 7, '钦州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (109, 7, '梧州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (110, 7, '玉林', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (111, 8, '贵阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (112, 8, '安顺', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (113, 8, '毕节', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (114, 8, '六盘水', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (115, 8, '黔东南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (116, 8, '黔南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (117, 8, '黔西南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (118, 8, '铜仁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (119, 8, '遵义', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (120, 9, '海口', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (121, 9, '三亚', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (122, 9, '白沙', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (123, 9, '保亭', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (124, 9, '昌江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (125, 9, '澄迈县', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (126, 9, '定安县', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (127, 9, '东方', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (128, 9, '乐东', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (129, 9, '临高县', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (130, 9, '陵水', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (131, 9, '琼海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (132, 9, '琼中', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (133, 9, '屯昌县', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (134, 9, '万宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (135, 9, '文昌', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (136, 9, '五指山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (137, 9, '儋州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (138, 10, '石家庄', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (139, 10, '保定', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (140, 10, '沧州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (141, 10, '承德', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (142, 10, '邯郸', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (143, 10, '衡水', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (144, 10, '廊坊', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (145, 10, '秦皇岛', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (146, 10, '唐山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (147, 10, '邢台', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (148, 10, '张家口', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (149, 11, '郑州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (150, 11, '洛阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (151, 11, '开封', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (152, 11, '安阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (153, 11, '鹤壁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (154, 11, '济源', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (155, 11, '焦作', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (156, 11, '南阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (157, 11, '平顶山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (158, 11, '三门峡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (159, 11, '商丘', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (160, 11, '新乡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (161, 11, '信阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (162, 11, '许昌', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (163, 11, '周口', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (164, 11, '驻马店', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (165, 11, '漯河', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (166, 11, '濮阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (167, 12, '哈尔滨', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (168, 12, '大庆', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (169, 12, '大兴安岭', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (170, 12, '鹤岗', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (171, 12, '黑河', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (172, 12, '鸡西', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (173, 12, '佳木斯', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (174, 12, '牡丹江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (175, 12, '七台河', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (176, 12, '齐齐哈尔', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (177, 12, '双鸭山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (178, 12, '绥化', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (179, 12, '伊春', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (180, 13, '武汉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (181, 13, '仙桃', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (182, 13, '鄂州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (183, 13, '黄冈', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (184, 13, '黄石', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (185, 13, '荆门', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (186, 13, '荆州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (187, 13, '潜江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (188, 13, '神农架林区', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (189, 13, '十堰', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (190, 13, '随州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (191, 13, '天门', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (192, 13, '咸宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (193, 13, '襄樊', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (194, 13, '孝感', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (195, 13, '宜昌', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (196, 13, '恩施', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (197, 14, '长沙', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (198, 14, '张家界', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (199, 14, '常德', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (200, 14, '郴州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (201, 14, '衡阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (202, 14, '怀化', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (203, 14, '娄底', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (204, 14, '邵阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (205, 14, '湘潭', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (206, 14, '湘西', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (207, 14, '益阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (208, 14, '永州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (209, 14, '岳阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (210, 14, '株洲', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (211, 15, '长春', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (212, 15, '吉林', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (213, 15, '白城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (214, 15, '白山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (215, 15, '辽源', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (216, 15, '四平', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (217, 15, '松原', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (218, 15, '通化', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (219, 15, '延边', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (220, 16, '南京', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (221, 16, '苏州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (222, 16, '无锡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (223, 16, '常州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (224, 16, '淮安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (225, 16, '连云港', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (226, 16, '南通', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (227, 16, '宿迁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (228, 16, '泰州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (229, 16, '徐州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (230, 16, '盐城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (231, 16, '扬州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (232, 16, '镇江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (233, 17, '南昌', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (234, 17, '抚州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (235, 17, '赣州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (236, 17, '吉安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (237, 17, '景德镇', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (238, 17, '九江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (239, 17, '萍乡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (240, 17, '上饶', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (241, 17, '新余', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (242, 17, '宜春', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (243, 17, '鹰潭', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (244, 18, '沈阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (245, 18, '大连', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (246, 18, '鞍山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (247, 18, '本溪', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (248, 18, '朝阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (249, 18, '丹东', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (250, 18, '抚顺', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (251, 18, '阜新', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (252, 18, '葫芦岛', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (253, 18, '锦州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (254, 18, '辽阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (255, 18, '盘锦', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (256, 18, '铁岭', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (257, 18, '营口', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (258, 19, '呼和浩特', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (259, 19, '阿拉善盟', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (260, 19, '巴彦淖尔盟', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (261, 19, '包头', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (262, 19, '赤峰', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (263, 19, '鄂尔多斯', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (264, 19, '呼伦贝尔', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (265, 19, '通辽', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (266, 19, '乌海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (267, 19, '乌兰察布市', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (268, 19, '锡林郭勒盟', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (269, 19, '兴安盟', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (270, 20, '银川', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (271, 20, '固原', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (272, 20, '石嘴山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (273, 20, '吴忠', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (274, 20, '中卫', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (275, 21, '西宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (276, 21, '果洛', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (277, 21, '海北', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (278, 21, '海东', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (279, 21, '海南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (280, 21, '海西', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (281, 21, '黄南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (282, 21, '玉树', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (283, 22, '济南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (284, 22, '青岛', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (285, 22, '滨州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (286, 22, '德州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (287, 22, '东营', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (288, 22, '菏泽', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (289, 22, '济宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (290, 22, '莱芜', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (291, 22, '聊城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (292, 22, '临沂', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (293, 22, '日照', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (294, 22, '泰安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (295, 22, '威海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (296, 22, '潍坊', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (297, 22, '烟台', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (298, 22, '枣庄', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (299, 22, '淄博', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (300, 23, '太原', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (301, 23, '长治', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (302, 23, '大同', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (303, 23, '晋城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (304, 23, '晋中', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (305, 23, '临汾', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (306, 23, '吕梁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (307, 23, '朔州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (308, 23, '忻州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (309, 23, '阳泉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (310, 23, '运城', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (311, 24, '西安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (312, 24, '安康', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (313, 24, '宝鸡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (314, 24, '汉中', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (315, 24, '商洛', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (316, 24, '铜川', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (317, 24, '渭南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (318, 24, '咸阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (319, 24, '延安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (320, 24, '榆林', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (321, 25, '上海', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (322, 26, '成都', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (323, 26, '绵阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (324, 26, '阿坝', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (325, 26, '巴中', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (326, 26, '达州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (327, 26, '德阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (328, 26, '甘孜', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (329, 26, '广安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (330, 26, '广元', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (331, 26, '乐山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (332, 26, '凉山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (333, 26, '眉山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (334, 26, '南充', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (335, 26, '内江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (336, 26, '攀枝花', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (337, 26, '遂宁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (338, 26, '雅安', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (339, 26, '宜宾', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (340, 26, '资阳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (341, 26, '自贡', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (342, 26, '泸州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (343, 27, '天津', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (344, 28, '拉萨', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (345, 28, '阿里', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (346, 28, '昌都', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (347, 28, '林芝', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (348, 28, '那曲', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (349, 28, '日喀则', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (350, 28, '山南', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (351, 29, '乌鲁木齐', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (352, 29, '阿克苏', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (353, 29, '阿拉尔', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (354, 29, '巴音郭楞', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (355, 29, '博尔塔拉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (356, 29, '昌吉', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (357, 29, '哈密', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (358, 29, '和田', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (359, 29, '喀什', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (360, 29, '克拉玛依', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (361, 29, '克孜勒苏', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (362, 29, '石河子', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (363, 29, '图木舒克', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (364, 29, '吐鲁番', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (365, 29, '五家渠', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (366, 29, '伊犁', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (367, 30, '昆明', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (368, 30, '怒江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (369, 30, '普洱', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (370, 30, '丽江', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (371, 30, '保山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (372, 30, '楚雄', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (373, 30, '大理', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (374, 30, '德宏', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (375, 30, '迪庆', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (376, 30, '红河', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (377, 30, '临沧', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (378, 30, '曲靖', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (379, 30, '文山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (380, 30, '西双版纳', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (381, 30, '玉溪', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (382, 30, '昭通', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (383, 31, '杭州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (384, 31, '湖州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (385, 31, '嘉兴', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (386, 31, '金华', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (387, 31, '丽水', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (388, 31, '宁波', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (389, 31, '绍兴', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (390, 31, '台州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (391, 31, '温州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (392, 31, '舟山', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (393, 31, '衢州', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (394, 32, '重庆', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (395, 33, '香港', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (396, 34, '澳门', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (397, 35, '台湾', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (398, 36, '迎江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (399, 36, '大观区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (400, 36, '宜秀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (401, 36, '桐城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (402, 36, '怀宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (403, 36, '枞阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (404, 36, '潜山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (405, 36, '太湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (406, 36, '宿松县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (407, 36, '望江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (408, 36, '岳西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (409, 37, '中市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (410, 37, '东市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (411, 37, '西市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (412, 37, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (413, 37, '怀远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (414, 37, '五河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (415, 37, '固镇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (416, 38, '居巢区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (417, 38, '庐江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (418, 38, '无为县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (419, 38, '含山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (420, 38, '和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (421, 39, '贵池区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (422, 39, '东至县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (423, 39, '石台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (424, 39, '青阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (425, 40, '琅琊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (426, 40, '南谯区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (427, 40, '天长市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (428, 40, '明光市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (429, 40, '来安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (430, 40, '全椒县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (431, 40, '定远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (432, 40, '凤阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (433, 41, '蚌山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (434, 41, '龙子湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (435, 41, '禹会区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (436, 41, '淮上区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (437, 41, '颍州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (438, 41, '颍东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (439, 41, '颍泉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (440, 41, '界首市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (441, 41, '临泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (442, 41, '太和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (443, 41, '阜南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (444, 41, '颖上县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (445, 42, '相山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (446, 42, '杜集区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (447, 42, '烈山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (448, 42, '濉溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (449, 43, '田家庵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (450, 43, '大通区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (451, 43, '谢家集区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (452, 43, '八公山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (453, 43, '潘集区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (454, 43, '凤台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (455, 44, '屯溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (456, 44, '黄山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (457, 44, '徽州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (458, 44, '歙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (459, 44, '休宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (460, 44, '黟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (461, 44, '祁门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (462, 45, '金安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (463, 45, '裕安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (464, 45, '寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (465, 45, '霍邱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (466, 45, '舒城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (467, 45, '金寨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (468, 45, '霍山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (469, 46, '雨山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (470, 46, '花山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (471, 46, '金家庄区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (472, 46, '当涂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (473, 47, '埇桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (474, 47, '砀山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (475, 47, '萧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (476, 47, '灵璧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (477, 47, '泗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (478, 48, '铜官山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (479, 48, '狮子山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (480, 48, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (481, 48, '铜陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (482, 49, '镜湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (483, 49, '弋江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (484, 49, '鸠江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (485, 49, '三山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (486, 49, '芜湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (487, 49, '繁昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (488, 49, '南陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (489, 50, '宣州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (490, 50, '宁国市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (491, 50, '郎溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (492, 50, '广德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (493, 50, '泾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (494, 50, '绩溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (495, 50, '旌德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (496, 51, '涡阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (497, 51, '蒙城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (498, 51, '利辛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (499, 51, '谯城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (500, 52, '东城区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:56', 0);
INSERT INTO `dgtx_places` VALUES (501, 52, '西城区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:53', 0);
INSERT INTO `dgtx_places` VALUES (502, 52, '海淀区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:48', 0);
INSERT INTO `dgtx_places` VALUES (503, 52, '朝阳区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:46', 0);
INSERT INTO `dgtx_places` VALUES (504, 52, '崇文区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:43', 0);
INSERT INTO `dgtx_places` VALUES (505, 52, '宣武区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:41', 0);
INSERT INTO `dgtx_places` VALUES (506, 52, '丰台区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:38', 0);
INSERT INTO `dgtx_places` VALUES (507, 52, '石景山区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:34', 0);
INSERT INTO `dgtx_places` VALUES (508, 52, '房山区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:31', 0);
INSERT INTO `dgtx_places` VALUES (509, 52, '门头沟区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:28', 0);
INSERT INTO `dgtx_places` VALUES (510, 52, '通州区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:22', 0);
INSERT INTO `dgtx_places` VALUES (511, 52, '顺义区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:25', 0);
INSERT INTO `dgtx_places` VALUES (512, 52, '昌平区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:20', 0);
INSERT INTO `dgtx_places` VALUES (513, 52, '怀柔区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:18', 0);
INSERT INTO `dgtx_places` VALUES (514, 52, '平谷区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:13', 0);
INSERT INTO `dgtx_places` VALUES (515, 52, '大兴区', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:10', 0);
INSERT INTO `dgtx_places` VALUES (516, 52, '密云县', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:16', 0);
INSERT INTO `dgtx_places` VALUES (517, 52, '延庆县', 3, '15307416886', '15307416886', NULL, '2020-08-04 11:24:08', 0);
INSERT INTO `dgtx_places` VALUES (518, 53, '鼓楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (519, 53, '台江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (520, 53, '仓山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (521, 53, '马尾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (522, 53, '晋安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (523, 53, '福清市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (524, 53, '长乐市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (525, 53, '闽侯县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (526, 53, '连江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (527, 53, '罗源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (528, 53, '闽清县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (529, 53, '永泰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (530, 53, '平潭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (531, 54, '新罗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (532, 54, '漳平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (533, 54, '长汀县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (534, 54, '永定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (535, 54, '上杭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (536, 54, '武平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (537, 54, '连城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (538, 55, '延平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (539, 55, '邵武市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (540, 55, '武夷山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (541, 55, '建瓯市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (542, 55, '建阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (543, 55, '顺昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (544, 55, '浦城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (545, 55, '光泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (546, 55, '松溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (547, 55, '政和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (548, 56, '蕉城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (549, 56, '福安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (550, 56, '福鼎市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (551, 56, '霞浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (552, 56, '古田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (553, 56, '屏南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (554, 56, '寿宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (555, 56, '周宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (556, 56, '柘荣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (557, 57, '城厢区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (558, 57, '涵江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (559, 57, '荔城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (560, 57, '秀屿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (561, 57, '仙游县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (562, 58, '鲤城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (563, 58, '丰泽区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (564, 58, '洛江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (565, 58, '清濛开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (566, 58, '泉港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (567, 58, '石狮市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (568, 58, '晋江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (569, 58, '南安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (570, 58, '惠安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (571, 58, '安溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (572, 58, '永春县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (573, 58, '德化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (574, 58, '金门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (575, 59, '梅列区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (576, 59, '三元区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (577, 59, '永安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (578, 59, '明溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (579, 59, '清流县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (580, 59, '宁化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (581, 59, '大田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (582, 59, '尤溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (583, 59, '沙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (584, 59, '将乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (585, 59, '泰宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (586, 59, '建宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (587, 60, '思明区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (588, 60, '海沧区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (589, 60, '湖里区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (590, 60, '集美区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (591, 60, '同安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (592, 60, '翔安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (593, 61, '芗城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (594, 61, '龙文区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (595, 61, '龙海市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (596, 61, '云霄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (597, 61, '漳浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (598, 61, '诏安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (599, 61, '长泰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (600, 61, '东山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (601, 61, '南靖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (602, 61, '平和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (603, 61, '华安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (604, 62, '皋兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (605, 62, '城关区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (606, 62, '七里河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (607, 62, '西固区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (608, 62, '安宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (609, 62, '红古区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (610, 62, '永登县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (611, 62, '榆中县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (612, 63, '白银区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (613, 63, '平川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (614, 63, '会宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (615, 63, '景泰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (616, 63, '靖远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (617, 64, '临洮县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (618, 64, '陇西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (619, 64, '通渭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (620, 64, '渭源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (621, 64, '漳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (622, 64, '岷县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (623, 64, '安定区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (624, 64, '安定区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (625, 65, '合作市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (626, 65, '临潭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (627, 65, '卓尼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (628, 65, '舟曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (629, 65, '迭部县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (630, 65, '玛曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (631, 65, '碌曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (632, 65, '夏河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (633, 66, '嘉峪关市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (634, 67, '金川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (635, 67, '永昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (636, 68, '肃州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (637, 68, '玉门市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (638, 68, '敦煌市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (639, 68, '金塔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (640, 68, '瓜州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (641, 68, '肃北', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (642, 68, '阿克塞', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (643, 69, '临夏市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (644, 69, '临夏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (645, 69, '康乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (646, 69, '永靖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (647, 69, '广河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (648, 69, '和政县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (649, 69, '东乡族自治县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (650, 69, '积石山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (651, 70, '成县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (652, 70, '徽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (653, 70, '康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (654, 70, '礼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (655, 70, '两当县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (656, 70, '文县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (657, 70, '西和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (658, 70, '宕昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (659, 70, '武都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (660, 71, '崇信县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (661, 71, '华亭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (662, 71, '静宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (663, 71, '灵台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (664, 71, '崆峒区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (665, 71, '庄浪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (666, 71, '泾川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (667, 72, '合水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (668, 72, '华池县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (669, 72, '环县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (670, 72, '宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (671, 72, '庆城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (672, 72, '西峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (673, 72, '镇原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (674, 72, '正宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (675, 73, '甘谷县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (676, 73, '秦安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (677, 73, '清水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (678, 73, '秦州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (679, 73, '麦积区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (680, 73, '武山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (681, 73, '张家川', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (682, 74, '古浪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (683, 74, '民勤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (684, 74, '天祝', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (685, 74, '凉州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (686, 75, '高台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (687, 75, '临泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (688, 75, '民乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (689, 75, '山丹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (690, 75, '肃南', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (691, 75, '甘州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (692, 76, '从化市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (693, 76, '天河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (694, 76, '东山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (695, 76, '白云区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (696, 76, '海珠区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (697, 76, '荔湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (698, 76, '越秀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (699, 76, '黄埔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (700, 76, '番禺区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (701, 76, '花都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (702, 76, '增城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (703, 76, '从化区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (704, 76, '市郊', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (705, 77, '福田区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (706, 77, '罗湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (707, 77, '南山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (708, 77, '宝安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (709, 77, '龙岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (710, 77, '盐田区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (711, 78, '湘桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (712, 78, '潮安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (713, 78, '饶平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (714, 79, '南城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (715, 79, '东城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (716, 79, '万江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (717, 79, '莞城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (718, 79, '石龙镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (719, 79, '虎门镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (720, 79, '麻涌镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (721, 79, '道滘镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (722, 79, '石碣镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (723, 79, '沙田镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (724, 79, '望牛墩镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (725, 79, '洪梅镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (726, 79, '茶山镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (727, 79, '寮步镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (728, 79, '大岭山镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (729, 79, '大朗镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (730, 79, '黄江镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (731, 79, '樟木头', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (732, 79, '凤岗镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (733, 79, '塘厦镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (734, 79, '谢岗镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (735, 79, '厚街镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (736, 79, '清溪镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (737, 79, '常平镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (738, 79, '桥头镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (739, 79, '横沥镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (740, 79, '东坑镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (741, 79, '企石镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (742, 79, '石排镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (743, 79, '长安镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (744, 79, '中堂镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (745, 79, '高埗镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (746, 80, '禅城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (747, 80, '南海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (748, 80, '顺德区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (749, 80, '三水区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (750, 80, '高明区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (751, 81, '东源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (752, 81, '和平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (753, 81, '源城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (754, 81, '连平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (755, 81, '龙川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (756, 81, '紫金县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (757, 82, '惠阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (758, 82, '惠城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (759, 82, '大亚湾', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (760, 82, '博罗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (761, 82, '惠东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (762, 82, '龙门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (763, 83, '江海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (764, 83, '蓬江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (765, 83, '新会区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (766, 83, '台山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (767, 83, '开平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (768, 83, '鹤山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (769, 83, '恩平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (770, 84, '榕城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (771, 84, '普宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (772, 84, '揭东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (773, 84, '揭西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (774, 84, '惠来县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (775, 85, '茂南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (776, 85, '茂港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (777, 85, '高州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (778, 85, '化州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (779, 85, '信宜市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (780, 85, '电白县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (781, 86, '梅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (782, 86, '梅江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (783, 86, '兴宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (784, 86, '大埔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (785, 86, '丰顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (786, 86, '五华县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (787, 86, '平远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (788, 86, '蕉岭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (789, 87, '清城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (790, 87, '英德市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (791, 87, '连州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (792, 87, '佛冈县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (793, 87, '阳山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (794, 87, '清新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (795, 87, '连山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (796, 87, '连南', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (797, 88, '南澳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (798, 88, '潮阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (799, 88, '澄海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (800, 88, '龙湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (801, 88, '金平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (802, 88, '濠江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (803, 88, '潮南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (804, 89, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (805, 89, '陆丰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (806, 89, '海丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (807, 89, '陆河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (808, 90, '曲江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (809, 90, '浈江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (810, 90, '武江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (811, 90, '曲江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (812, 90, '乐昌市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (813, 90, '南雄市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (814, 90, '始兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (815, 90, '仁化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (816, 90, '翁源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (817, 90, '新丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (818, 90, '乳源', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (819, 91, '江城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (820, 91, '阳春市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (821, 91, '阳西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (822, 91, '阳东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (823, 92, '云城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (824, 92, '罗定市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (825, 92, '新兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (826, 92, '郁南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (827, 92, '云安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (828, 93, '赤坎区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (829, 93, '霞山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (830, 93, '坡头区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (831, 93, '麻章区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (832, 93, '廉江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (833, 93, '雷州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (834, 93, '吴川市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (835, 93, '遂溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (836, 93, '徐闻县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (837, 94, '肇庆市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (838, 94, '高要市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (839, 94, '四会市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (840, 94, '广宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (841, 94, '怀集县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (842, 94, '封开县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (843, 94, '德庆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (844, 95, '石岐街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (845, 95, '东区街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (846, 95, '西区街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (847, 95, '环城街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (848, 95, '中山港街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (849, 95, '五桂山街道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (850, 96, '香洲区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (851, 96, '斗门区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (852, 96, '金湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (853, 97, '邕宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (854, 97, '青秀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (855, 97, '兴宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (856, 97, '良庆区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (857, 97, '西乡塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (858, 97, '江南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (859, 97, '武鸣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (860, 97, '隆安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (861, 97, '马山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (862, 97, '上林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (863, 97, '宾阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (864, 97, '横县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (865, 98, '秀峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (866, 98, '叠彩区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (867, 98, '象山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (868, 98, '七星区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (869, 98, '雁山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (870, 98, '阳朔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (871, 98, '临桂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (872, 98, '灵川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (873, 98, '全州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (874, 98, '平乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (875, 98, '兴安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (876, 98, '灌阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (877, 98, '荔浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (878, 98, '资源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (879, 98, '永福县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (880, 98, '龙胜', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (881, 98, '恭城', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (882, 99, '右江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (883, 99, '凌云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (884, 99, '平果县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (885, 99, '西林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (886, 99, '乐业县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (887, 99, '德保县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (888, 99, '田林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (889, 99, '田阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (890, 99, '靖西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (891, 99, '田东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (892, 99, '那坡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (893, 99, '隆林', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (894, 100, '海城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (895, 100, '银海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (896, 100, '铁山港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (897, 100, '合浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (898, 101, '江州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (899, 101, '凭祥市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (900, 101, '宁明县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (901, 101, '扶绥县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (902, 101, '龙州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (903, 101, '大新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (904, 101, '天等县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (905, 102, '港口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (906, 102, '防城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (907, 102, '东兴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (908, 102, '上思县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (909, 103, '港北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (910, 103, '港南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (911, 103, '覃塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (912, 103, '桂平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (913, 103, '平南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (914, 104, '金城江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (915, 104, '宜州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (916, 104, '天峨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (917, 104, '凤山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (918, 104, '南丹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (919, 104, '东兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (920, 104, '都安', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (921, 104, '罗城', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (922, 104, '巴马', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (923, 104, '环江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (924, 104, '大化', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (925, 105, '八步区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (926, 105, '钟山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (927, 105, '昭平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (928, 105, '富川', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (929, 106, '兴宾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (930, 106, '合山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (931, 106, '象州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (932, 106, '武宣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (933, 106, '忻城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (934, 106, '金秀', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (935, 107, '城中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (936, 107, '鱼峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (937, 107, '柳北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (938, 107, '柳南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (939, 107, '柳江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (940, 107, '柳城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (941, 107, '鹿寨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (942, 107, '融安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (943, 107, '融水', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (944, 107, '三江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (945, 108, '钦南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (946, 108, '钦北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (947, 108, '灵山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (948, 108, '浦北县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (949, 109, '万秀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (950, 109, '蝶山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (951, 109, '长洲区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (952, 109, '岑溪市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (953, 109, '苍梧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (954, 109, '藤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (955, 109, '蒙山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (956, 110, '玉州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (957, 110, '北流市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (958, 110, '容县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (959, 110, '陆川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (960, 110, '博白县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (961, 110, '兴业县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (962, 111, '南明区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (963, 111, '云岩区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (964, 111, '花溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (965, 111, '乌当区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (966, 111, '白云区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (967, 111, '小河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (968, 111, '金阳新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (969, 111, '新天园区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (970, 111, '清镇市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (971, 111, '开阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (972, 111, '修文县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (973, 111, '息烽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (974, 112, '西秀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (975, 112, '关岭', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (976, 112, '镇宁', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (977, 112, '紫云', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (978, 112, '平坝县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (979, 112, '普定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (980, 113, '毕节市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (981, 113, '大方县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (982, 113, '黔西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (983, 113, '金沙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (984, 113, '织金县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (985, 113, '纳雍县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (986, 113, '赫章县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (987, 113, '威宁', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (988, 114, '钟山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (989, 114, '六枝特区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (990, 114, '水城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (991, 114, '盘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (992, 115, '凯里市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (993, 115, '黄平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (994, 115, '施秉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (995, 115, '三穗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (996, 115, '镇远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (997, 115, '岑巩县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (998, 115, '天柱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (999, 115, '锦屏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1000, 115, '剑河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1001, 115, '台江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1002, 115, '黎平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1003, 115, '榕江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1004, 115, '从江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1005, 115, '雷山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1006, 115, '麻江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1007, 115, '丹寨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1008, 116, '都匀市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1009, 116, '福泉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1010, 116, '荔波县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1011, 116, '贵定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1012, 116, '瓮安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1013, 116, '独山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1014, 116, '平塘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1015, 116, '罗甸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1016, 116, '长顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1017, 116, '龙里县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1018, 116, '惠水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1019, 116, '三都', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1020, 117, '兴义市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1021, 117, '兴仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1022, 117, '普安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1023, 117, '晴隆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1024, 117, '贞丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1025, 117, '望谟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1026, 117, '册亨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1027, 117, '安龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1028, 118, '铜仁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1029, 118, '江口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1030, 118, '石阡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1031, 118, '思南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1032, 118, '德江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1033, 118, '玉屏', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1034, 118, '印江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1035, 118, '沿河', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1036, 118, '松桃', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1037, 118, '万山特区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1038, 119, '红花岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1039, 119, '务川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1040, 119, '道真县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1041, 119, '汇川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1042, 119, '赤水市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1043, 119, '仁怀市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1044, 119, '遵义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1045, 119, '桐梓县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1046, 119, '绥阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1047, 119, '正安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1048, 119, '凤冈县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1049, 119, '湄潭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1050, 119, '余庆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1051, 119, '习水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1052, 119, '道真', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1053, 119, '务川', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1054, 120, '秀英区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1055, 120, '龙华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1056, 120, '琼山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1057, 120, '美兰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1058, 137, '市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1059, 137, '洋浦开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1060, 137, '那大镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1061, 137, '王五镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1062, 137, '雅星镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1063, 137, '大成镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1064, 137, '中和镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1065, 137, '峨蔓镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1066, 137, '南丰镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1067, 137, '白马井镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1068, 137, '兰洋镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1069, 137, '和庆镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1070, 137, '海头镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1071, 137, '排浦镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1072, 137, '东成镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1073, 137, '光村镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1074, 137, '木棠镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1075, 137, '新州镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1076, 137, '三都镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1077, 137, '其他', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1078, 138, '长安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1079, 138, '桥东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1080, 138, '桥西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1081, 138, '新华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1082, 138, '裕华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1083, 138, '井陉矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1084, 138, '高新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1085, 138, '辛集市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1086, 138, '藁城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1087, 138, '晋州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1088, 138, '新乐市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1089, 138, '鹿泉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1090, 138, '井陉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1091, 138, '正定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1092, 138, '栾城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1093, 138, '行唐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1094, 138, '灵寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1095, 138, '高邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1096, 138, '深泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1097, 138, '赞皇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1098, 138, '无极县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1099, 138, '平山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1100, 138, '元氏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1101, 138, '赵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1102, 139, '新市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1103, 139, '南市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1104, 139, '北市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1105, 139, '涿州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1106, 139, '定州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1107, 139, '安国市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1108, 139, '高碑店市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1109, 139, '满城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1110, 139, '清苑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1111, 139, '涞水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1112, 139, '阜平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1113, 139, '徐水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1114, 139, '定兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1115, 139, '唐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1116, 139, '高阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1117, 139, '容城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1118, 139, '涞源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1119, 139, '望都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1120, 139, '安新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1121, 139, '易县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1122, 139, '曲阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1123, 139, '蠡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1124, 139, '顺平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1125, 139, '博野县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1126, 139, '雄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1127, 140, '运河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1128, 140, '新华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1129, 140, '泊头市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1130, 140, '任丘市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1131, 140, '黄骅市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1132, 140, '河间市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1133, 140, '沧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1134, 140, '青县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1135, 140, '东光县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1136, 140, '海兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1137, 140, '盐山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1138, 140, '肃宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1139, 140, '南皮县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1140, 140, '吴桥县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1141, 140, '献县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1142, 140, '孟村', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1143, 141, '双桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1144, 141, '双滦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1145, 141, '鹰手营子矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1146, 141, '承德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1147, 141, '兴隆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1148, 141, '平泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1149, 141, '滦平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1150, 141, '隆化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1151, 141, '丰宁', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1152, 141, '宽城', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1153, 141, '围场', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1154, 142, '从台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1155, 142, '复兴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1156, 142, '邯山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1157, 142, '峰峰矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1158, 142, '武安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1159, 142, '邯郸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1160, 142, '临漳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1161, 142, '成安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1162, 142, '大名县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1163, 142, '涉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1164, 142, '磁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1165, 142, '肥乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1166, 142, '永年县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1167, 142, '邱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1168, 142, '鸡泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1169, 142, '广平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1170, 142, '馆陶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1171, 142, '魏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1172, 142, '曲周县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1173, 143, '桃城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1174, 143, '冀州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1175, 143, '深州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1176, 143, '枣强县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1177, 143, '武邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1178, 143, '武强县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1179, 143, '饶阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1180, 143, '安平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1181, 143, '故城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1182, 143, '景县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1183, 143, '阜城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1184, 144, '安次区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1185, 144, '广阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1186, 144, '霸州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1187, 144, '三河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1188, 144, '固安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1189, 144, '永清县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1190, 144, '香河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1191, 144, '大城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1192, 144, '文安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1193, 144, '大厂', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1194, 145, '海港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1195, 145, '山海关区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1196, 145, '北戴河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1197, 145, '昌黎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1198, 145, '抚宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1199, 145, '卢龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1200, 145, '青龙', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1201, 146, '路北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1202, 146, '路南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1203, 146, '古冶区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1204, 146, '开平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1205, 146, '丰南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1206, 146, '丰润区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1207, 146, '遵化市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1208, 146, '迁安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1209, 146, '滦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1210, 146, '滦南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1211, 146, '乐亭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1212, 146, '迁西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1213, 146, '玉田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1214, 146, '唐海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1215, 147, '桥东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1216, 147, '桥西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1217, 147, '南宫市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1218, 147, '沙河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1219, 147, '邢台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1220, 147, '临城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1221, 147, '内丘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1222, 147, '柏乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1223, 147, '隆尧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1224, 147, '任县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1225, 147, '南和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1226, 147, '宁晋县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1227, 147, '巨鹿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1228, 147, '新河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1229, 147, '广宗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1230, 147, '平乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1231, 147, '威县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1232, 147, '清河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1233, 147, '临西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1234, 148, '桥西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1235, 148, '桥东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1236, 148, '宣化区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1237, 148, '下花园区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1238, 148, '宣化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1239, 148, '张北县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1240, 148, '康保县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1241, 148, '沽源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1242, 148, '尚义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1243, 148, '蔚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1244, 148, '阳原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1245, 148, '怀安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1246, 148, '万全县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1247, 148, '怀来县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1248, 148, '涿鹿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1249, 148, '赤城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1250, 148, '崇礼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1251, 149, '金水区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1252, 149, '邙山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1253, 149, '二七区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1254, 149, '管城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1255, 149, '中原区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1256, 149, '上街区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1257, 149, '惠济区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1258, 149, '郑东新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1259, 149, '经济技术开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1260, 149, '高新开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1261, 149, '出口加工区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1262, 149, '巩义市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1263, 149, '荥阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1264, 149, '新密市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1265, 149, '新郑市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1266, 149, '登封市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1267, 149, '中牟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1268, 150, '西工区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1269, 150, '老城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1270, 150, '涧西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1271, 150, '瀍河回族区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1272, 150, '洛龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1273, 150, '吉利区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1274, 150, '偃师市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1275, 150, '孟津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1276, 150, '新安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1277, 150, '栾川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1278, 150, '嵩县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1279, 150, '汝阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1280, 150, '宜阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1281, 150, '洛宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1282, 150, '伊川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1283, 151, '鼓楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1284, 151, '龙亭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1285, 151, '顺河回族区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1286, 151, '金明区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1287, 151, '禹王台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1288, 151, '杞县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1289, 151, '通许县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1290, 151, '尉氏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1291, 151, '开封县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1292, 151, '兰考县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1293, 152, '北关区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1294, 152, '文峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1295, 152, '殷都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1296, 152, '龙安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1297, 152, '林州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1298, 152, '安阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1299, 152, '汤阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1300, 152, '滑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1301, 152, '内黄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1302, 153, '淇滨区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1303, 153, '山城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1304, 153, '鹤山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1305, 153, '浚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1306, 153, '淇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1307, 154, '济源市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1308, 155, '解放区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1309, 155, '中站区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1310, 155, '马村区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1311, 155, '山阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1312, 155, '沁阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1313, 155, '孟州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1314, 155, '修武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1315, 155, '博爱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1316, 155, '武陟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1317, 155, '温县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1318, 156, '卧龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1319, 156, '宛城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1320, 156, '邓州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1321, 156, '南召县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1322, 156, '方城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1323, 156, '西峡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1324, 156, '镇平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1325, 156, '内乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1326, 156, '淅川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1327, 156, '社旗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1328, 156, '唐河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1329, 156, '新野县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1330, 156, '桐柏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1331, 157, '新华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1332, 157, '卫东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1333, 157, '湛河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1334, 157, '石龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1335, 157, '舞钢市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1336, 157, '汝州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1337, 157, '宝丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1338, 157, '叶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1339, 157, '鲁山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1340, 157, '郏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1341, 158, '湖滨区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1342, 158, '义马市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1343, 158, '灵宝市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1344, 158, '渑池县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1345, 158, '陕县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1346, 158, '卢氏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1347, 159, '梁园区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1348, 159, '睢阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1349, 159, '永城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1350, 159, '民权县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1351, 159, '睢县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1352, 159, '宁陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1353, 159, '虞城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1354, 159, '柘城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1355, 159, '夏邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1356, 160, '卫滨区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1357, 160, '红旗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1358, 160, '凤泉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1359, 160, '牧野区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1360, 160, '卫辉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1361, 160, '辉县市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1362, 160, '新乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1363, 160, '获嘉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1364, 160, '原阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1365, 160, '延津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1366, 160, '封丘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1367, 160, '长垣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1368, 161, '浉河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1369, 161, '平桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1370, 161, '罗山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1371, 161, '光山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1372, 161, '新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1373, 161, '商城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1374, 161, '固始县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1375, 161, '潢川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1376, 161, '淮滨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1377, 161, '息县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1378, 162, '魏都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1379, 162, '禹州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1380, 162, '长葛市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1381, 162, '许昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1382, 162, '鄢陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1383, 162, '襄城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1384, 163, '川汇区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1385, 163, '项城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1386, 163, '扶沟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1387, 163, '西华县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1388, 163, '商水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1389, 163, '沈丘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1390, 163, '郸城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1391, 163, '淮阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1392, 163, '太康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1393, 163, '鹿邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1394, 164, '驿城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1395, 164, '西平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1396, 164, '上蔡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1397, 164, '平舆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1398, 164, '正阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1399, 164, '确山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1400, 164, '泌阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1401, 164, '汝南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1402, 164, '遂平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1403, 164, '新蔡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1404, 165, '郾城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1405, 165, '源汇区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1406, 165, '召陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1407, 165, '舞阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1408, 165, '临颍县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1409, 166, '华龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1410, 166, '清丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1411, 166, '南乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1412, 166, '范县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1413, 166, '台前县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1414, 166, '濮阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1415, 167, '道里区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1416, 167, '南岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1417, 167, '动力区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1418, 167, '平房区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1419, 167, '香坊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1420, 167, '太平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1421, 167, '道外区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1422, 167, '阿城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1423, 167, '呼兰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1424, 167, '松北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1425, 167, '尚志市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1426, 167, '双城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1427, 167, '五常市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1428, 167, '方正县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1429, 167, '宾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1430, 167, '依兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1431, 167, '巴彦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1432, 167, '通河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1433, 167, '木兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1434, 167, '延寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1435, 168, '萨尔图区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1436, 168, '红岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1437, 168, '龙凤区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1438, 168, '让胡路区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1439, 168, '大同区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1440, 168, '肇州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1441, 168, '肇源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1442, 168, '林甸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1443, 168, '杜尔伯特', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1444, 169, '呼玛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1445, 169, '漠河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1446, 169, '塔河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1447, 170, '兴山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1448, 170, '工农区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1449, 170, '南山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1450, 170, '兴安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1451, 170, '向阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1452, 170, '东山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1453, 170, '萝北县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1454, 170, '绥滨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1455, 171, '爱辉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1456, 171, '五大连池市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1457, 171, '北安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1458, 171, '嫩江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1459, 171, '逊克县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1460, 171, '孙吴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1461, 172, '鸡冠区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1462, 172, '恒山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1463, 172, '城子河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1464, 172, '滴道区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1465, 172, '梨树区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1466, 172, '虎林市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1467, 172, '密山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1468, 172, '鸡东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1469, 173, '前进区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1470, 173, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1471, 173, '向阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1472, 173, '东风区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1473, 173, '同江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1474, 173, '富锦市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1475, 173, '桦南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1476, 173, '桦川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1477, 173, '汤原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1478, 173, '抚远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1479, 174, '爱民区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1480, 174, '东安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1481, 174, '阳明区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1482, 174, '西安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1483, 174, '绥芬河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1484, 174, '海林市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1485, 174, '宁安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1486, 174, '穆棱市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1487, 174, '东宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1488, 174, '林口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1489, 175, '桃山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1490, 175, '新兴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1491, 175, '茄子河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1492, 175, '勃利县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1493, 176, '龙沙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1494, 176, '昂昂溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1495, 176, '铁峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1496, 176, '建华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1497, 176, '富拉尔基区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1498, 176, '碾子山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1499, 176, '梅里斯达斡尔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1500, 176, '讷河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1501, 176, '龙江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1502, 176, '依安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1503, 176, '泰来县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1504, 176, '甘南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1505, 176, '富裕县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1506, 176, '克山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1507, 176, '克东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1508, 176, '拜泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1509, 177, '尖山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1510, 177, '岭东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1511, 177, '四方台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1512, 177, '宝山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1513, 177, '集贤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1514, 177, '友谊县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1515, 177, '宝清县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1516, 177, '饶河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1517, 178, '北林区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1518, 178, '安达市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1519, 178, '肇东市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1520, 178, '海伦市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1521, 178, '望奎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1522, 178, '兰西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1523, 178, '青冈县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1524, 178, '庆安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1525, 178, '明水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1526, 178, '绥棱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1527, 179, '伊春区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1528, 179, '带岭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1529, 179, '南岔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1530, 179, '金山屯区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1531, 179, '西林区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1532, 179, '美溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1533, 179, '乌马河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1534, 179, '翠峦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1535, 179, '友好区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1536, 179, '上甘岭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1537, 179, '五营区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1538, 179, '红星区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1539, 179, '新青区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1540, 179, '汤旺河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1541, 179, '乌伊岭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1542, 179, '铁力市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1543, 179, '嘉荫县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1544, 180, '江岸区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1545, 180, '武昌区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1546, 180, '江汉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1547, 180, '硚口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1548, 180, '汉阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1549, 180, '青山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1550, 180, '洪山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1551, 180, '东西湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1552, 180, '汉南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1553, 180, '蔡甸区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1554, 180, '江夏区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1555, 180, '黄陂区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1556, 180, '新洲区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1557, 180, '经济开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1558, 181, '仙桃市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1559, 182, '鄂城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1560, 182, '华容区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1561, 182, '梁子湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1562, 183, '黄州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1563, 183, '麻城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1564, 183, '武穴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1565, 183, '团风县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1566, 183, '红安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1567, 183, '罗田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1568, 183, '英山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1569, 183, '浠水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1570, 183, '蕲春县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1571, 183, '黄梅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1572, 184, '黄石港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1573, 184, '西塞山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1574, 184, '下陆区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1575, 184, '铁山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1576, 184, '大冶市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1577, 184, '阳新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1578, 185, '东宝区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1579, 185, '掇刀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1580, 185, '钟祥市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1581, 185, '京山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1582, 185, '沙洋县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1583, 186, '沙市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1584, 186, '荆州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1585, 186, '石首市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1586, 186, '洪湖市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1587, 186, '松滋市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1588, 186, '公安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1589, 186, '监利县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1590, 186, '江陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1591, 187, '潜江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1592, 188, '神农架林区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1593, 189, '张湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1594, 189, '茅箭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1595, 189, '丹江口市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1596, 189, '郧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1597, 189, '郧西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1598, 189, '竹山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1599, 189, '竹溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1600, 189, '房县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1601, 190, '曾都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1602, 190, '广水市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1603, 191, '天门市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1604, 192, '咸安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1605, 192, '赤壁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1606, 192, '嘉鱼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1607, 192, '通城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1608, 192, '崇阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1609, 192, '通山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1610, 193, '襄城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1611, 193, '樊城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1612, 193, '襄阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1613, 193, '老河口市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1614, 193, '枣阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1615, 193, '宜城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1616, 193, '南漳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1617, 193, '谷城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1618, 193, '保康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1619, 194, '孝南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1620, 194, '应城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1621, 194, '安陆市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1622, 194, '汉川市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1623, 194, '孝昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1624, 194, '大悟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1625, 194, '云梦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1626, 195, '长阳', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1627, 195, '五峰', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1628, 195, '西陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1629, 195, '伍家岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1630, 195, '点军区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1631, 195, '猇亭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1632, 195, '夷陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1633, 195, '宜都市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1634, 195, '当阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1635, 195, '枝江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1636, 195, '远安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1637, 195, '兴山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1638, 195, '秭归县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1639, 196, '恩施市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1640, 196, '利川市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1641, 196, '建始县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1642, 196, '巴东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1643, 196, '宣恩县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1644, 196, '咸丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1645, 196, '来凤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1646, 196, '鹤峰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1647, 197, '岳麓区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1648, 197, '芙蓉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1649, 197, '天心区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1650, 197, '开福区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1651, 197, '雨花区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1652, 197, '开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1653, 197, '浏阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1654, 197, '长沙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1655, 197, '望城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1656, 197, '宁乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1657, 198, '永定区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1658, 198, '武陵源区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1659, 198, '慈利县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1660, 198, '桑植县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1661, 199, '武陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1662, 199, '鼎城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1663, 199, '津市市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1664, 199, '安乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1665, 199, '汉寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1666, 199, '澧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1667, 199, '临澧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1668, 199, '桃源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1669, 199, '石门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1670, 200, '北湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1671, 200, '苏仙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1672, 200, '资兴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1673, 200, '桂阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1674, 200, '宜章县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1675, 200, '永兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1676, 200, '嘉禾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1677, 200, '临武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1678, 200, '汝城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1679, 200, '桂东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1680, 200, '安仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1681, 201, '雁峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1682, 201, '珠晖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1683, 201, '石鼓区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1684, 201, '蒸湘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1685, 201, '南岳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1686, 201, '耒阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1687, 201, '常宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1688, 201, '衡阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1689, 201, '衡南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1690, 201, '衡山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1691, 201, '衡东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1692, 201, '祁东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1693, 202, '鹤城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1694, 202, '靖州', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1695, 202, '麻阳', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1696, 202, '通道', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1697, 202, '新晃', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1698, 202, '芷江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1699, 202, '沅陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1700, 202, '辰溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1701, 202, '溆浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1702, 202, '中方县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1703, 202, '会同县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1704, 202, '洪江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1705, 203, '娄星区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1706, 203, '冷水江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1707, 203, '涟源市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1708, 203, '双峰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1709, 203, '新化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1710, 204, '城步', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1711, 204, '双清区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1712, 204, '大祥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1713, 204, '北塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1714, 204, '武冈市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1715, 204, '邵东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1716, 204, '新邵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1717, 204, '邵阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1718, 204, '隆回县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1719, 204, '洞口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1720, 204, '绥宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1721, 204, '新宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1722, 205, '岳塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1723, 205, '雨湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1724, 205, '湘乡市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1725, 205, '韶山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1726, 205, '湘潭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1727, 206, '吉首市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1728, 206, '泸溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1729, 206, '凤凰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1730, 206, '花垣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1731, 206, '保靖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1732, 206, '古丈县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1733, 206, '永顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1734, 206, '龙山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1735, 207, '赫山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1736, 207, '资阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1737, 207, '沅江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1738, 207, '南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1739, 207, '桃江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1740, 207, '安化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1741, 208, '江华', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1742, 208, '冷水滩区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1743, 208, '零陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1744, 208, '祁阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1745, 208, '东安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1746, 208, '双牌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1747, 208, '道县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1748, 208, '江永县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1749, 208, '宁远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1750, 208, '蓝山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1751, 208, '新田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1752, 209, '岳阳楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1753, 209, '君山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1754, 209, '云溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1755, 209, '汨罗市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1756, 209, '临湘市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1757, 209, '岳阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1758, 209, '华容县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1759, 209, '湘阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1760, 209, '平江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1761, 210, '天元区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1762, 210, '荷塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1763, 210, '芦淞区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1764, 210, '石峰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1765, 210, '醴陵市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1766, 210, '株洲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1767, 210, '攸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1768, 210, '茶陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1769, 210, '炎陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1770, 211, '朝阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1771, 211, '宽城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1772, 211, '二道区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1773, 211, '南关区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1774, 211, '绿园区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1775, 211, '双阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1776, 211, '净月潭开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1777, 211, '高新技术开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1778, 211, '经济技术开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1779, 211, '汽车产业开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1780, 211, '德惠市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1781, 211, '九台市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1782, 211, '榆树市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1783, 211, '农安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1784, 212, '船营区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1785, 212, '昌邑区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1786, 212, '龙潭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1787, 212, '丰满区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1788, 212, '蛟河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1789, 212, '桦甸市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1790, 212, '舒兰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1791, 212, '磐石市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1792, 212, '永吉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1793, 213, '洮北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1794, 213, '洮南市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1795, 213, '大安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1796, 213, '镇赉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1797, 213, '通榆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1798, 214, '江源区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1799, 214, '八道江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1800, 214, '长白', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1801, 214, '临江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1802, 214, '抚松县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1803, 214, '靖宇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1804, 215, '龙山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1805, 215, '西安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1806, 215, '东丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1807, 215, '东辽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1808, 216, '铁西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1809, 216, '铁东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1810, 216, '伊通', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1811, 216, '公主岭市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1812, 216, '双辽市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1813, 216, '梨树县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1814, 217, '前郭尔罗斯', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1815, 217, '宁江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1816, 217, '长岭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1817, 217, '乾安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1818, 217, '扶余县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1819, 218, '东昌区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1820, 218, '二道江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1821, 218, '梅河口市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1822, 218, '集安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1823, 218, '通化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1824, 218, '辉南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1825, 218, '柳河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1826, 219, '延吉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1827, 219, '图们市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1828, 219, '敦化市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1829, 219, '珲春市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1830, 219, '龙井市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1831, 219, '和龙市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1832, 219, '安图县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1833, 219, '汪清县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1834, 220, '玄武区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1835, 220, '鼓楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1836, 220, '白下区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1837, 220, '建邺区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1838, 220, '秦淮区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1839, 220, '雨花台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1840, 220, '下关区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1841, 220, '栖霞区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1842, 220, '浦口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1843, 220, '江宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1844, 220, '六合区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1845, 220, '溧水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1846, 220, '高淳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1847, 221, '沧浪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1848, 221, '金阊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1849, 221, '平江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1850, 221, '虎丘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1851, 221, '吴中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1852, 221, '相城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1853, 221, '园区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1854, 221, '新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1855, 221, '常熟市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1856, 221, '张家港市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1857, 221, '玉山镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1858, 221, '巴城镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1859, 221, '周市镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1860, 221, '陆家镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1861, 221, '花桥镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1862, 221, '淀山湖镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1863, 221, '张浦镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1864, 221, '周庄镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1865, 221, '千灯镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1866, 221, '锦溪镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1867, 221, '开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1868, 221, '吴江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1869, 221, '太仓市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1870, 222, '崇安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1871, 222, '北塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1872, 222, '南长区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1873, 222, '锡山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1874, 222, '惠山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1875, 222, '滨湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1876, 222, '新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1877, 222, '江阴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1878, 222, '宜兴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1879, 223, '天宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1880, 223, '钟楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1881, 223, '戚墅堰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1882, 223, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1883, 223, '新北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1884, 223, '武进区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1885, 223, '溧阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1886, 223, '金坛市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1887, 224, '清河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1888, 224, '清浦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1889, 224, '楚州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1890, 224, '淮阴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1891, 224, '涟水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1892, 224, '洪泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1893, 224, '盱眙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1894, 224, '金湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1895, 225, '新浦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1896, 225, '连云区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1897, 225, '海州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1898, 225, '赣榆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1899, 225, '东海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1900, 225, '灌云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1901, 225, '灌南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1902, 226, '崇川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1903, 226, '港闸区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1904, 226, '经济开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1905, 226, '启东市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1906, 226, '如皋市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1907, 226, '通州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1908, 226, '海门市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1909, 226, '海安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1910, 226, '如东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1911, 227, '宿城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1912, 227, '宿豫区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1913, 227, '宿豫县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1914, 227, '沭阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1915, 227, '泗阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1916, 227, '泗洪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1917, 228, '海陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1918, 228, '高港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1919, 228, '兴化市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1920, 228, '靖江市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1921, 228, '泰兴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1922, 228, '姜堰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1923, 229, '云龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1924, 229, '鼓楼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1925, 229, '九里区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1926, 229, '贾汪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1927, 229, '泉山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1928, 229, '新沂市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1929, 229, '邳州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1930, 229, '丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1931, 229, '沛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1932, 229, '铜山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1933, 229, '睢宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1934, 230, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1935, 230, '亭湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1936, 230, '盐都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1937, 230, '盐都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1938, 230, '东台市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1939, 230, '大丰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1940, 230, '响水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1941, 230, '滨海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1942, 230, '阜宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1943, 230, '射阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1944, 230, '建湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1945, 231, '广陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1946, 231, '维扬区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1947, 231, '邗江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1948, 231, '仪征市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1949, 231, '高邮市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1950, 231, '江都市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1951, 231, '宝应县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1952, 232, '京口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1953, 232, '润州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1954, 232, '丹徒区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1955, 232, '丹阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1956, 232, '扬中市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1957, 232, '句容市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1958, 233, '东湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1959, 233, '西湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1960, 233, '青云谱区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1961, 233, '湾里区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1962, 233, '青山湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1963, 233, '红谷滩新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1964, 233, '昌北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1965, 233, '高新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1966, 233, '南昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1967, 233, '新建县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1968, 233, '安义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1969, 233, '进贤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1970, 234, '临川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1971, 234, '南城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1972, 234, '黎川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1973, 234, '南丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1974, 234, '崇仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1975, 234, '乐安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1976, 234, '宜黄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1977, 234, '金溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1978, 234, '资溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1979, 234, '东乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1980, 234, '广昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1981, 235, '章贡区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1982, 235, '于都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1983, 235, '瑞金市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1984, 235, '南康市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1985, 235, '赣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1986, 235, '信丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1987, 235, '大余县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1988, 235, '上犹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1989, 235, '崇义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1990, 235, '安远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1991, 235, '龙南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1992, 235, '定南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1993, 235, '全南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1994, 235, '宁都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1995, 235, '兴国县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1996, 235, '会昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1997, 235, '寻乌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1998, 235, '石城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (1999, 236, '安福县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2000, 236, '吉州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2001, 236, '青原区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2002, 236, '井冈山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2003, 236, '吉安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2004, 236, '吉水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2005, 236, '峡江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2006, 236, '新干县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2007, 236, '永丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2008, 236, '泰和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2009, 236, '遂川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2010, 236, '万安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2011, 236, '永新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2012, 237, '珠山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2013, 237, '昌江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2014, 237, '乐平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2015, 237, '浮梁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2016, 238, '浔阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2017, 238, '庐山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2018, 238, '瑞昌市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2019, 238, '九江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2020, 238, '武宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2021, 238, '修水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2022, 238, '永修县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2023, 238, '德安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2024, 238, '星子县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2025, 238, '都昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2026, 238, '湖口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2027, 238, '彭泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2028, 239, '安源区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2029, 239, '湘东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2030, 239, '莲花县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2031, 239, '芦溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2032, 239, '上栗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2033, 240, '信州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2034, 240, '德兴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2035, 240, '上饶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2036, 240, '广丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2037, 240, '玉山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2038, 240, '铅山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2039, 240, '横峰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2040, 240, '弋阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2041, 240, '余干县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2042, 240, '波阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2043, 240, '万年县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2044, 240, '婺源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2045, 241, '渝水区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2046, 241, '分宜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2047, 242, '袁州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2048, 242, '丰城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2049, 242, '樟树市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2050, 242, '高安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2051, 242, '奉新县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2052, 242, '万载县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2053, 242, '上高县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2054, 242, '宜丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2055, 242, '靖安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2056, 242, '铜鼓县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2057, 243, '月湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2058, 243, '贵溪市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2059, 243, '余江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2060, 244, '沈河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2061, 244, '皇姑区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2062, 244, '和平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2063, 244, '大东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2064, 244, '铁西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2065, 244, '苏家屯区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2066, 244, '东陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2067, 244, '沈北新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2068, 244, '于洪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2069, 244, '浑南新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2070, 244, '新民市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2071, 244, '辽中县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2072, 244, '康平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2073, 244, '法库县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2074, 245, '西岗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2075, 245, '中山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2076, 245, '沙河口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2077, 245, '甘井子区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2078, 245, '旅顺口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2079, 245, '金州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2080, 245, '开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2081, 245, '瓦房店市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2082, 245, '普兰店市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2083, 245, '庄河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2084, 245, '长海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2085, 246, '铁东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2086, 246, '铁西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2087, 246, '立山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2088, 246, '千山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2089, 246, '岫岩', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2090, 246, '海城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2091, 246, '台安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2092, 247, '本溪', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2093, 247, '平山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2094, 247, '明山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2095, 247, '溪湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2096, 247, '南芬区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2097, 247, '桓仁', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2098, 248, '双塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2099, 248, '龙城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2100, 248, '喀喇沁左翼蒙古族自治县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2101, 248, '北票市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2102, 248, '凌源市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2103, 248, '朝阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2104, 248, '建平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2105, 249, '振兴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2106, 249, '元宝区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2107, 249, '振安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2108, 249, '宽甸', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2109, 249, '东港市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2110, 249, '凤城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2111, 250, '顺城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2112, 250, '新抚区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2113, 250, '东洲区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2114, 250, '望花区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2115, 250, '清原', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2116, 250, '新宾', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2117, 250, '抚顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2118, 251, '阜新', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2119, 251, '海州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2120, 251, '新邱区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2121, 251, '太平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2122, 251, '清河门区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2123, 251, '细河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2124, 251, '彰武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2125, 252, '龙港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2126, 252, '南票区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2127, 252, '连山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2128, 252, '兴城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2129, 252, '绥中县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2130, 252, '建昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2131, 253, '太和区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2132, 253, '古塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2133, 253, '凌河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2134, 253, '凌海市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2135, 253, '北镇市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2136, 253, '黑山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2137, 253, '义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2138, 254, '白塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2139, 254, '文圣区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2140, 254, '宏伟区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2141, 254, '太子河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2142, 254, '弓长岭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2143, 254, '灯塔市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2144, 254, '辽阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2145, 255, '双台子区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2146, 255, '兴隆台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2147, 255, '大洼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2148, 255, '盘山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2149, 256, '银州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2150, 256, '清河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2151, 256, '调兵山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2152, 256, '开原市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2153, 256, '铁岭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2154, 256, '西丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2155, 256, '昌图县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2156, 257, '站前区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2157, 257, '西市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2158, 257, '鲅鱼圈区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2159, 257, '老边区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2160, 257, '盖州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2161, 257, '大石桥市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2162, 258, '回民区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2163, 258, '玉泉区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2164, 258, '新城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2165, 258, '赛罕区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2166, 258, '清水河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2167, 258, '土默特左旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2168, 258, '托克托县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2169, 258, '和林格尔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2170, 258, '武川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2171, 259, '阿拉善左旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2172, 259, '阿拉善右旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2173, 259, '额济纳旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2174, 260, '临河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2175, 260, '五原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2176, 260, '磴口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2177, 260, '乌拉特前旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2178, 260, '乌拉特中旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2179, 260, '乌拉特后旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2180, 260, '杭锦后旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2181, 261, '昆都仑区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2182, 261, '青山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2183, 261, '东河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2184, 261, '九原区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2185, 261, '石拐区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2186, 261, '白云矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2187, 261, '土默特右旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2188, 261, '固阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2189, 261, '达尔罕茂明安联合旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2190, 262, '红山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2191, 262, '元宝山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2192, 262, '松山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2193, 262, '阿鲁科尔沁旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2194, 262, '巴林左旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2195, 262, '巴林右旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2196, 262, '林西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2197, 262, '克什克腾旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2198, 262, '翁牛特旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2199, 262, '喀喇沁旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2200, 262, '宁城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2201, 262, '敖汉旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2202, 263, '东胜区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2203, 263, '达拉特旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2204, 263, '准格尔旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2205, 263, '鄂托克前旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2206, 263, '鄂托克旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2207, 263, '杭锦旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2208, 263, '乌审旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2209, 263, '伊金霍洛旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2210, 264, '海拉尔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2211, 264, '莫力达瓦', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2212, 264, '满洲里市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2213, 264, '牙克石市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2214, 264, '扎兰屯市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2215, 264, '额尔古纳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2216, 264, '根河市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2217, 264, '阿荣旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2218, 264, '鄂伦春自治旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2219, 264, '鄂温克族自治旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2220, 264, '陈巴尔虎旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2221, 264, '新巴尔虎左旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2222, 264, '新巴尔虎右旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2223, 265, '科尔沁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2224, 265, '霍林郭勒市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2225, 265, '科尔沁左翼中旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2226, 265, '科尔沁左翼后旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2227, 265, '开鲁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2228, 265, '库伦旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2229, 265, '奈曼旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2230, 265, '扎鲁特旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2231, 266, '海勃湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2232, 266, '乌达区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2233, 266, '海南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2234, 267, '化德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2235, 267, '集宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2236, 267, '丰镇市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2237, 267, '卓资县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2238, 267, '商都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2239, 267, '兴和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2240, 267, '凉城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2241, 267, '察哈尔右翼前旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2242, 267, '察哈尔右翼中旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2243, 267, '察哈尔右翼后旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2244, 267, '四子王旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2245, 268, '二连浩特市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2246, 268, '锡林浩特市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2247, 268, '阿巴嘎旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2248, 268, '苏尼特左旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2249, 268, '苏尼特右旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2250, 268, '东乌珠穆沁旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2251, 268, '西乌珠穆沁旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2252, 268, '太仆寺旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2253, 268, '镶黄旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2254, 268, '正镶白旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2255, 268, '正蓝旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2256, 268, '多伦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2257, 269, '乌兰浩特市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2258, 269, '阿尔山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2259, 269, '科尔沁右翼前旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2260, 269, '科尔沁右翼中旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2261, 269, '扎赉特旗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2262, 269, '突泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2263, 270, '西夏区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2264, 270, '金凤区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2265, 270, '兴庆区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2266, 270, '灵武市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2267, 270, '永宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2268, 270, '贺兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2269, 271, '原州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2270, 271, '海原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2271, 271, '西吉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2272, 271, '隆德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2273, 271, '泾源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2274, 271, '彭阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2275, 272, '惠农县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2276, 272, '大武口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2277, 272, '惠农区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2278, 272, '陶乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2279, 272, '平罗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2280, 273, '利通区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2281, 273, '中卫县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2282, 273, '青铜峡市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2283, 273, '中宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2284, 273, '盐池县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2285, 273, '同心县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2286, 274, '沙坡头区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2287, 274, '海原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2288, 274, '中宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2289, 275, '城中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2290, 275, '城东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2291, 275, '城西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2292, 275, '城北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2293, 275, '湟中县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2294, 275, '湟源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2295, 275, '大通', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2296, 276, '玛沁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2297, 276, '班玛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2298, 276, '甘德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2299, 276, '达日县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2300, 276, '久治县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2301, 276, '玛多县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2302, 277, '海晏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2303, 277, '祁连县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2304, 277, '刚察县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2305, 277, '门源', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2306, 278, '平安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2307, 278, '乐都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2308, 278, '民和', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2309, 278, '互助', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2310, 278, '化隆', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2311, 278, '循化', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2312, 279, '共和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2313, 279, '同德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2314, 279, '贵德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2315, 279, '兴海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2316, 279, '贵南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2317, 280, '德令哈市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2318, 280, '格尔木市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2319, 280, '乌兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2320, 280, '都兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2321, 280, '天峻县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2322, 281, '同仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2323, 281, '尖扎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2324, 281, '泽库县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2325, 281, '河南蒙古族自治县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2326, 282, '玉树县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2327, 282, '杂多县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2328, 282, '称多县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2329, 282, '治多县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2330, 282, '囊谦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2331, 282, '曲麻莱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2332, 283, '市中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2333, 283, '历下区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2334, 283, '天桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2335, 283, '槐荫区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2336, 283, '历城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2337, 283, '长清区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2338, 283, '章丘市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2339, 283, '平阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2340, 283, '济阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2341, 283, '商河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2342, 284, '市南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2343, 284, '市北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2344, 284, '城阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2345, 284, '四方区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2346, 284, '李沧区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2347, 284, '黄岛区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2348, 284, '崂山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2349, 284, '胶州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2350, 284, '即墨市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2351, 284, '平度市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2352, 284, '胶南市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2353, 284, '莱西市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2354, 285, '滨城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2355, 285, '惠民县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2356, 285, '阳信县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2357, 285, '无棣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2358, 285, '沾化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2359, 285, '博兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2360, 285, '邹平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2361, 286, '德城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2362, 286, '陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2363, 286, '乐陵市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2364, 286, '禹城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2365, 286, '宁津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2366, 286, '庆云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2367, 286, '临邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2368, 286, '齐河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2369, 286, '平原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2370, 286, '夏津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2371, 286, '武城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2372, 287, '东营区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2373, 287, '河口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2374, 287, '垦利县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2375, 287, '利津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2376, 287, '广饶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2377, 288, '牡丹区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2378, 288, '曹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2379, 288, '单县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2380, 288, '成武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2381, 288, '巨野县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2382, 288, '郓城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2383, 288, '鄄城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2384, 288, '定陶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2385, 288, '东明县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2386, 289, '市中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2387, 289, '任城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2388, 289, '曲阜市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2389, 289, '兖州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2390, 289, '邹城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2391, 289, '微山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2392, 289, '鱼台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2393, 289, '金乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2394, 289, '嘉祥县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2395, 289, '汶上县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2396, 289, '泗水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2397, 289, '梁山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2398, 290, '莱城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2399, 290, '钢城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2400, 291, '东昌府区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2401, 291, '临清市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2402, 291, '阳谷县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2403, 291, '莘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2404, 291, '茌平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2405, 291, '东阿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2406, 291, '冠县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2407, 291, '高唐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2408, 292, '兰山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2409, 292, '罗庄区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2410, 292, '河东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2411, 292, '沂南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2412, 292, '郯城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2413, 292, '沂水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2414, 292, '苍山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2415, 292, '费县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2416, 292, '平邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2417, 292, '莒南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2418, 292, '蒙阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2419, 292, '临沭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2420, 293, '东港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2421, 293, '岚山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2422, 293, '五莲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2423, 293, '莒县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2424, 294, '泰山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2425, 294, '岱岳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2426, 294, '新泰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2427, 294, '肥城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2428, 294, '宁阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2429, 294, '东平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2430, 295, '荣成市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2431, 295, '乳山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2432, 295, '环翠区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2433, 295, '文登市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2434, 296, '潍城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2435, 296, '寒亭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2436, 296, '坊子区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2437, 296, '奎文区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2438, 296, '青州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2439, 296, '诸城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2440, 296, '寿光市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2441, 296, '安丘市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2442, 296, '高密市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2443, 296, '昌邑市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2444, 296, '临朐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2445, 296, '昌乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2446, 297, '芝罘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2447, 297, '福山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2448, 297, '牟平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2449, 297, '莱山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2450, 297, '开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2451, 297, '龙口市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2452, 297, '莱阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2453, 297, '莱州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2454, 297, '蓬莱市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2455, 297, '招远市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2456, 297, '栖霞市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2457, 297, '海阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2458, 297, '长岛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2459, 298, '市中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2460, 298, '山亭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2461, 298, '峄城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2462, 298, '台儿庄区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2463, 298, '薛城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2464, 298, '滕州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2465, 299, '张店区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2466, 299, '临淄区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2467, 299, '淄川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2468, 299, '博山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2469, 299, '周村区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2470, 299, '桓台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2471, 299, '高青县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2472, 299, '沂源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2473, 300, '杏花岭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2474, 300, '小店区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2475, 300, '迎泽区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2476, 300, '尖草坪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2477, 300, '万柏林区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2478, 300, '晋源区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2479, 300, '高新开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2480, 300, '民营经济开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2481, 300, '经济技术开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2482, 300, '清徐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2483, 300, '阳曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2484, 300, '娄烦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2485, 300, '古交市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2486, 301, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2487, 301, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2488, 301, '沁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2489, 301, '潞城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2490, 301, '长治县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2491, 301, '襄垣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2492, 301, '屯留县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2493, 301, '平顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2494, 301, '黎城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2495, 301, '壶关县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2496, 301, '长子县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2497, 301, '武乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2498, 301, '沁源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2499, 302, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2500, 302, '矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2501, 302, '南郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2502, 302, '新荣区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2503, 302, '阳高县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2504, 302, '天镇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2505, 302, '广灵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2506, 302, '灵丘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2507, 302, '浑源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2508, 302, '左云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2509, 302, '大同县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2510, 303, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2511, 303, '高平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2512, 303, '沁水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2513, 303, '阳城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2514, 303, '陵川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2515, 303, '泽州县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2516, 304, '榆次区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2517, 304, '介休市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2518, 304, '榆社县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2519, 304, '左权县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2520, 304, '和顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2521, 304, '昔阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2522, 304, '寿阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2523, 304, '太谷县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2524, 304, '祁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2525, 304, '平遥县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2526, 304, '灵石县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2527, 305, '尧都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2528, 305, '侯马市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2529, 305, '霍州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2530, 305, '曲沃县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2531, 305, '翼城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2532, 305, '襄汾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2533, 305, '洪洞县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2534, 305, '吉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2535, 305, '安泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2536, 305, '浮山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2537, 305, '古县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2538, 305, '乡宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2539, 305, '大宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2540, 305, '隰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2541, 305, '永和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2542, 305, '蒲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2543, 305, '汾西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2544, 306, '离石市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2545, 306, '离石区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2546, 306, '孝义市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2547, 306, '汾阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2548, 306, '文水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2549, 306, '交城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2550, 306, '兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2551, 306, '临县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2552, 306, '柳林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2553, 306, '石楼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2554, 306, '岚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2555, 306, '方山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2556, 306, '中阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2557, 306, '交口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2558, 307, '朔城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2559, 307, '平鲁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2560, 307, '山阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2561, 307, '应县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2562, 307, '右玉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2563, 307, '怀仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2564, 308, '忻府区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2565, 308, '原平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2566, 308, '定襄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2567, 308, '五台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2568, 308, '代县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2569, 308, '繁峙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2570, 308, '宁武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2571, 308, '静乐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2572, 308, '神池县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2573, 308, '五寨县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2574, 308, '岢岚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2575, 308, '河曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2576, 308, '保德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2577, 308, '偏关县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2578, 309, '城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2579, 309, '矿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2580, 309, '郊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2581, 309, '平定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2582, 309, '盂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2583, 310, '盐湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2584, 310, '永济市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2585, 310, '河津市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2586, 310, '临猗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2587, 310, '万荣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2588, 310, '闻喜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2589, 310, '稷山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2590, 310, '新绛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2591, 310, '绛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2592, 310, '垣曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2593, 310, '夏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2594, 310, '平陆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2595, 310, '芮城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2596, 311, '莲湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2597, 311, '新城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2598, 311, '碑林区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2599, 311, '雁塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2600, 311, '灞桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2601, 311, '未央区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2602, 311, '阎良区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2603, 311, '临潼区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2604, 311, '长安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2605, 311, '蓝田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2606, 311, '周至县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2607, 311, '户县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2608, 311, '高陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2609, 312, '汉滨区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2610, 312, '汉阴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2611, 312, '石泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2612, 312, '宁陕县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2613, 312, '紫阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2614, 312, '岚皋县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2615, 312, '平利县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2616, 312, '镇坪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2617, 312, '旬阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2618, 312, '白河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2619, 313, '陈仓区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2620, 313, '渭滨区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2621, 313, '金台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2622, 313, '凤翔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2623, 313, '岐山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2624, 313, '扶风县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2625, 313, '眉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2626, 313, '陇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2627, 313, '千阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2628, 313, '麟游县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2629, 313, '凤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2630, 313, '太白县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2631, 314, '汉台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2632, 314, '南郑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2633, 314, '城固县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2634, 314, '洋县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2635, 314, '西乡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2636, 314, '勉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2637, 314, '宁强县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2638, 314, '略阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2639, 314, '镇巴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2640, 314, '留坝县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2641, 314, '佛坪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2642, 315, '商州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2643, 315, '洛南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2644, 315, '丹凤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2645, 315, '商南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2646, 315, '山阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2647, 315, '镇安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2648, 315, '柞水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2649, 316, '耀州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2650, 316, '王益区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2651, 316, '印台区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2652, 316, '宜君县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2653, 317, '临渭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2654, 317, '韩城市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2655, 317, '华阴市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2656, 317, '华县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2657, 317, '潼关县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2658, 317, '大荔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2659, 317, '合阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2660, 317, '澄城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2661, 317, '蒲城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2662, 317, '白水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2663, 317, '富平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2664, 318, '秦都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2665, 318, '渭城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2666, 318, '杨陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2667, 318, '兴平市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2668, 318, '三原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2669, 318, '泾阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2670, 318, '乾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2671, 318, '礼泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2672, 318, '永寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2673, 318, '彬县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2674, 318, '长武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2675, 318, '旬邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2676, 318, '淳化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2677, 318, '武功县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2678, 319, '吴起县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2679, 319, '宝塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2680, 319, '延长县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2681, 319, '延川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2682, 319, '子长县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2683, 319, '安塞县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2684, 319, '志丹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2685, 319, '甘泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2686, 319, '富县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2687, 319, '洛川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2688, 319, '宜川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2689, 319, '黄龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2690, 319, '黄陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2691, 320, '榆阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2692, 320, '神木县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2693, 320, '府谷县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2694, 320, '横山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2695, 320, '靖边县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2696, 320, '定边县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2697, 320, '绥德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2698, 320, '米脂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2699, 320, '佳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2700, 320, '吴堡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2701, 320, '清涧县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2702, 320, '子洲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2703, 321, '长宁区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2704, 321, '闸北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2705, 321, '闵行区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2706, 321, '徐汇区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2707, 321, '浦东新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2708, 321, '杨浦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2709, 321, '普陀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2710, 321, '静安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2711, 321, '卢湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2712, 321, '虹口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2713, 321, '黄浦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2714, 321, '南汇区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2715, 321, '松江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2716, 321, '嘉定区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2717, 321, '宝山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2718, 321, '青浦区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2719, 321, '金山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2720, 321, '奉贤区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2721, 321, '崇明县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2722, 322, '青羊区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2723, 322, '锦江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2724, 322, '金牛区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2725, 322, '武侯区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2726, 322, '成华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2727, 322, '龙泉驿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2728, 322, '青白江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2729, 322, '新都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2730, 322, '温江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2731, 322, '高新区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2732, 322, '高新西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2733, 322, '都江堰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2734, 322, '彭州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2735, 322, '邛崃市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2736, 322, '崇州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2737, 322, '金堂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2738, 322, '双流县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2739, 322, '郫县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2740, 322, '大邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2741, 322, '蒲江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2742, 322, '新津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2743, 322, '都江堰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2744, 322, '彭州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2745, 322, '邛崃市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2746, 322, '崇州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2747, 322, '金堂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2748, 322, '双流县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2749, 322, '郫县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2750, 322, '大邑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2751, 322, '蒲江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2752, 322, '新津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2753, 323, '涪城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2754, 323, '游仙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2755, 323, '江油市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2756, 323, '盐亭县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2757, 323, '三台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2758, 323, '平武县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2759, 323, '安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2760, 323, '梓潼县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2761, 323, '北川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2762, 324, '马尔康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2763, 324, '汶川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2764, 324, '理县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2765, 324, '茂县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2766, 324, '松潘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2767, 324, '九寨沟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2768, 324, '金川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2769, 324, '小金县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2770, 324, '黑水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2771, 324, '壤塘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2772, 324, '阿坝县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2773, 324, '若尔盖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2774, 324, '红原县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2775, 325, '巴州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2776, 325, '通江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2777, 325, '南江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2778, 325, '平昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2779, 326, '通川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2780, 326, '万源市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2781, 326, '达县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2782, 326, '宣汉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2783, 326, '开江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2784, 326, '大竹县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2785, 326, '渠县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2786, 327, '旌阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2787, 327, '广汉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2788, 327, '什邡市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2789, 327, '绵竹市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2790, 327, '罗江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2791, 327, '中江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2792, 328, '康定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2793, 328, '丹巴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2794, 328, '泸定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2795, 328, '炉霍县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2796, 328, '九龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2797, 328, '甘孜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2798, 328, '雅江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2799, 328, '新龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2800, 328, '道孚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2801, 328, '白玉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2802, 328, '理塘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2803, 328, '德格县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2804, 328, '乡城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2805, 328, '石渠县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2806, 328, '稻城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2807, 328, '色达县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2808, 328, '巴塘县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2809, 328, '得荣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2810, 329, '广安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2811, 329, '华蓥市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2812, 329, '岳池县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2813, 329, '武胜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2814, 329, '邻水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2815, 330, '利州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2816, 330, '元坝区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2817, 330, '朝天区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2818, 330, '旺苍县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2819, 330, '青川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2820, 330, '剑阁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2821, 330, '苍溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2822, 331, '峨眉山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2823, 331, '乐山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2824, 331, '犍为县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2825, 331, '井研县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2826, 331, '夹江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2827, 331, '沐川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2828, 331, '峨边', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2829, 331, '马边', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2830, 332, '西昌市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2831, 332, '盐源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2832, 332, '德昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2833, 332, '会理县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2834, 332, '会东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2835, 332, '宁南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2836, 332, '普格县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2837, 332, '布拖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2838, 332, '金阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2839, 332, '昭觉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2840, 332, '喜德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2841, 332, '冕宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2842, 332, '越西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2843, 332, '甘洛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2844, 332, '美姑县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2845, 332, '雷波县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2846, 332, '木里', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2847, 333, '东坡区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2848, 333, '仁寿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2849, 333, '彭山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2850, 333, '洪雅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2851, 333, '丹棱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2852, 333, '青神县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2853, 334, '阆中市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2854, 334, '南部县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2855, 334, '营山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2856, 334, '蓬安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2857, 334, '仪陇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2858, 334, '顺庆区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2859, 334, '高坪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2860, 334, '嘉陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2861, 334, '西充县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2862, 335, '市中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2863, 335, '东兴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2864, 335, '威远县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2865, 335, '资中县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2866, 335, '隆昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2867, 336, '东  区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2868, 336, '西  区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2869, 336, '仁和区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2870, 336, '米易县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2871, 336, '盐边县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2872, 337, '船山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2873, 337, '安居区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2874, 337, '蓬溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2875, 337, '射洪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2876, 337, '大英县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2877, 338, '雨城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2878, 338, '名山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2879, 338, '荥经县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2880, 338, '汉源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2881, 338, '石棉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2882, 338, '天全县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2883, 338, '芦山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2884, 338, '宝兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2885, 339, '翠屏区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2886, 339, '宜宾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2887, 339, '南溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2888, 339, '江安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2889, 339, '长宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2890, 339, '高县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2891, 339, '珙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2892, 339, '筠连县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2893, 339, '兴文县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2894, 339, '屏山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2895, 340, '雁江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2896, 340, '简阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2897, 340, '安岳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2898, 340, '乐至县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2899, 341, '大安区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2900, 341, '自流井区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2901, 341, '贡井区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2902, 341, '沿滩区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2903, 341, '荣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2904, 341, '富顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2905, 342, '江阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2906, 342, '纳溪区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2907, 342, '龙马潭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2908, 342, '泸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2909, 342, '合江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2910, 342, '叙永县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2911, 342, '古蔺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2912, 343, '和平区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2913, 343, '河西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2914, 343, '南开区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2915, 343, '河北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2916, 343, '河东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2917, 343, '红桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2918, 343, '东丽区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2919, 343, '津南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2920, 343, '西青区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2921, 343, '北辰区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2922, 343, '塘沽区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2923, 343, '汉沽区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2924, 343, '大港区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2925, 343, '武清区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2926, 343, '宝坻区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2927, 343, '经济开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2928, 343, '宁河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2929, 343, '静海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2930, 343, '蓟县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2931, 344, '城关区', 3, NULL, '15650716663', NULL, '2020-12-08 22:33:05', 1);
INSERT INTO `dgtx_places` VALUES (2932, 344, '林周县', 3, NULL, '15650716663', NULL, '2020-12-08 22:33:07', 1);
INSERT INTO `dgtx_places` VALUES (2933, 344, '当雄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2934, 344, '尼木县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2935, 344, '曲水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2936, 344, '堆龙德庆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2937, 344, '达孜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2938, 344, '墨竹工卡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2939, 345, '噶尔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2940, 345, '普兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2941, 345, '札达县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2942, 345, '日土县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2943, 345, '革吉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2944, 345, '改则县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2945, 345, '措勤县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2946, 346, '昌都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2947, 346, '江达县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2948, 346, '贡觉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2949, 346, '类乌齐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2950, 346, '丁青县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2951, 346, '察雅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2952, 346, '八宿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2953, 346, '左贡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2954, 346, '芒康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2955, 346, '洛隆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2956, 346, '边坝县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2957, 347, '林芝县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2958, 347, '工布江达县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2959, 347, '米林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2960, 347, '墨脱县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2961, 347, '波密县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2962, 347, '察隅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2963, 347, '朗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2964, 348, '那曲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2965, 348, '嘉黎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2966, 348, '比如县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2967, 348, '聂荣县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2968, 348, '安多县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2969, 348, '申扎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2970, 348, '索县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2971, 348, '班戈县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2972, 348, '巴青县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2973, 348, '尼玛县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2974, 349, '日喀则市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2975, 349, '南木林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2976, 349, '江孜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2977, 349, '定日县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2978, 349, '萨迦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2979, 349, '拉孜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2980, 349, '昂仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2981, 349, '谢通门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2982, 349, '白朗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2983, 349, '仁布县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2984, 349, '康马县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2985, 349, '定结县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2986, 349, '仲巴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2987, 349, '亚东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2988, 349, '吉隆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2989, 349, '聂拉木县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2990, 349, '萨嘎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2991, 349, '岗巴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2992, 350, '乃东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2993, 350, '扎囊县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2994, 350, '贡嘎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2995, 350, '桑日县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2996, 350, '琼结县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2997, 350, '曲松县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2998, 350, '措美县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (2999, 350, '洛扎县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3000, 350, '加查县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3001, 350, '隆子县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3002, 350, '错那县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3003, 350, '浪卡子县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3004, 351, '天山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3005, 351, '沙依巴克区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3006, 351, '新市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3007, 351, '水磨沟区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3008, 351, '头屯河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3009, 351, '达坂城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3010, 351, '米东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3011, 351, '乌鲁木齐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3012, 352, '阿克苏市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3013, 352, '温宿县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3014, 352, '库车县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3015, 352, '沙雅县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3016, 352, '新和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3017, 352, '拜城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3018, 352, '乌什县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3019, 352, '阿瓦提县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3020, 352, '柯坪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3021, 353, '阿拉尔市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3022, 354, '库尔勒市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3023, 354, '轮台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3024, 354, '尉犁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3025, 354, '若羌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3026, 354, '且末县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3027, 354, '焉耆', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3028, 354, '和静县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3029, 354, '和硕县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3030, 354, '博湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3031, 355, '博乐市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3032, 355, '精河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3033, 355, '温泉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3034, 356, '呼图壁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3035, 356, '米泉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3036, 356, '昌吉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3037, 356, '阜康市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3038, 356, '玛纳斯县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3039, 356, '奇台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3040, 356, '吉木萨尔县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3041, 356, '木垒', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3042, 357, '哈密市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3043, 357, '伊吾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3044, 357, '巴里坤', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3045, 358, '和田市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3046, 358, '和田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3047, 358, '墨玉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3048, 358, '皮山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3049, 358, '洛浦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3050, 358, '策勒县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3051, 358, '于田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3052, 358, '民丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3053, 359, '喀什市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3054, 359, '疏附县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3055, 359, '疏勒县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3056, 359, '英吉沙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3057, 359, '泽普县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3058, 359, '莎车县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3059, 359, '叶城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3060, 359, '麦盖提县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3061, 359, '岳普湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3062, 359, '伽师县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3063, 359, '巴楚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3064, 359, '塔什库尔干', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3065, 360, '克拉玛依市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3066, 361, '阿图什市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3067, 361, '阿克陶县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3068, 361, '阿合奇县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3069, 361, '乌恰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3070, 362, '石河子市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3071, 363, '图木舒克市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3072, 364, '吐鲁番市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3073, 364, '鄯善县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3074, 364, '托克逊县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3075, 365, '五家渠市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3076, 366, '阿勒泰市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3077, 366, '布克赛尔', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3078, 366, '伊宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3079, 366, '布尔津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3080, 366, '奎屯市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3081, 366, '乌苏市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3082, 366, '额敏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3083, 366, '富蕴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3084, 366, '伊宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3085, 366, '福海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3086, 366, '霍城县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3087, 366, '沙湾县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3088, 366, '巩留县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3089, 366, '哈巴河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3090, 366, '托里县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3091, 366, '青河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3092, 366, '新源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3093, 366, '裕民县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3094, 366, '和布克赛尔', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3095, 366, '吉木乃县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3096, 366, '昭苏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3097, 366, '特克斯县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3098, 366, '尼勒克县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3099, 366, '察布查尔', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3100, 367, '盘龙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3101, 367, '五华区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3102, 367, '官渡区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3103, 367, '西山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3104, 367, '东川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3105, 367, '安宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3106, 367, '呈贡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3107, 367, '晋宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3108, 367, '富民县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3109, 367, '宜良县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3110, 367, '嵩明县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3111, 367, '石林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3112, 367, '禄劝', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3113, 367, '寻甸', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3114, 368, '兰坪', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3115, 368, '泸水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3116, 368, '福贡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3117, 368, '贡山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3118, 369, '宁洱', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3119, 369, '思茅区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3120, 369, '墨江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3121, 369, '景东', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3122, 369, '景谷', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3123, 369, '镇沅', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3124, 369, '江城', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3125, 369, '孟连', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3126, 369, '澜沧', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3127, 369, '西盟', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3128, 370, '古城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3129, 370, '宁蒗', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3130, 370, '玉龙', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3131, 370, '永胜县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3132, 370, '华坪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3133, 371, '隆阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3134, 371, '施甸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3135, 371, '腾冲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3136, 371, '龙陵县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3137, 371, '昌宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3138, 372, '楚雄市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3139, 372, '双柏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3140, 372, '牟定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3141, 372, '南华县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3142, 372, '姚安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3143, 372, '大姚县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3144, 372, '永仁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3145, 372, '元谋县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3146, 372, '武定县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3147, 372, '禄丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3148, 373, '大理市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3149, 373, '祥云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3150, 373, '宾川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3151, 373, '弥渡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3152, 373, '永平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3153, 373, '云龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3154, 373, '洱源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3155, 373, '剑川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3156, 373, '鹤庆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3157, 373, '漾濞', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3158, 373, '南涧', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3159, 373, '巍山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3160, 374, '潞西市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3161, 374, '瑞丽市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3162, 374, '梁河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3163, 374, '盈江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3164, 374, '陇川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3165, 375, '香格里拉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3166, 375, '德钦县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3167, 375, '维西', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3168, 376, '泸西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3169, 376, '蒙自县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3170, 376, '个旧市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3171, 376, '开远市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3172, 376, '绿春县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3173, 376, '建水县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3174, 376, '石屏县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3175, 376, '弥勒县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3176, 376, '元阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3177, 376, '红河县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3178, 376, '金平', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3179, 376, '河口', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3180, 376, '屏边', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3181, 377, '临翔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3182, 377, '凤庆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3183, 377, '云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3184, 377, '永德县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3185, 377, '镇康县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3186, 377, '双江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3187, 377, '耿马', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3188, 377, '沧源', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3189, 378, '麒麟区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3190, 378, '宣威市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3191, 378, '马龙县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3192, 378, '陆良县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3193, 378, '师宗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3194, 378, '罗平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3195, 378, '富源县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3196, 378, '会泽县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3197, 378, '沾益县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3198, 379, '文山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3199, 379, '砚山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3200, 379, '西畴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3201, 379, '麻栗坡县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3202, 379, '马关县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3203, 379, '丘北县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3204, 379, '广南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3205, 379, '富宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3206, 380, '景洪市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3207, 380, '勐海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3208, 380, '勐腊县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3209, 381, '红塔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3210, 381, '江川县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3211, 381, '澄江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3212, 381, '通海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3213, 381, '华宁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3214, 381, '易门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3215, 381, '峨山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3216, 381, '新平', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3217, 381, '元江', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3218, 382, '昭阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3219, 382, '鲁甸县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3220, 382, '巧家县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3221, 382, '盐津县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3222, 382, '大关县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3223, 382, '永善县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3224, 382, '绥江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3225, 382, '镇雄县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3226, 382, '彝良县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3227, 382, '威信县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3228, 382, '水富县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3229, 383, '西湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3230, 383, '上城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3231, 383, '下城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3232, 383, '拱墅区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3233, 383, '滨江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3234, 383, '江干区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3235, 383, '萧山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3236, 383, '余杭区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3237, 383, '市郊', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3238, 383, '建德市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3239, 383, '富阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3240, 383, '临安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3241, 383, '桐庐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3242, 383, '淳安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3243, 384, '吴兴区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3244, 384, '南浔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3245, 384, '德清县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3246, 384, '长兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3247, 384, '安吉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3248, 385, '南湖区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3249, 385, '秀洲区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3250, 385, '海宁市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3251, 385, '嘉善县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3252, 385, '平湖市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3253, 385, '桐乡市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3254, 385, '海盐县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3255, 386, '婺城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3256, 386, '金东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3257, 386, '兰溪市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3258, 386, '市区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3259, 386, '佛堂镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3260, 386, '上溪镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3261, 386, '义亭镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3262, 386, '大陈镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3263, 386, '苏溪镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3264, 386, '赤岸镇', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3265, 386, '东阳市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3266, 386, '永康市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3267, 386, '武义县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3268, 386, '浦江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3269, 386, '磐安县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3270, 387, '莲都区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3271, 387, '龙泉市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3272, 387, '青田县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3273, 387, '缙云县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3274, 387, '遂昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3275, 387, '松阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3276, 387, '云和县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3277, 387, '庆元县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3278, 387, '景宁', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3279, 388, '海曙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3280, 388, '江东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3281, 388, '江北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3282, 388, '镇海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3283, 388, '北仑区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3284, 388, '鄞州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3285, 388, '余姚市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3286, 388, '慈溪市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3287, 388, '奉化市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3288, 388, '象山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3289, 388, '宁海县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3290, 389, '越城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3291, 389, '上虞市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3292, 389, '嵊州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3293, 389, '绍兴县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3294, 389, '新昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3295, 389, '诸暨市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3296, 390, '椒江区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3297, 390, '黄岩区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3298, 390, '路桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3299, 390, '温岭市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3300, 390, '临海市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3301, 390, '玉环县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3302, 390, '三门县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3303, 390, '天台县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3304, 390, '仙居县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3305, 391, '鹿城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3306, 391, '龙湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3307, 391, '瓯海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3308, 391, '瑞安市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3309, 391, '乐清市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3310, 391, '洞头县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3311, 391, '永嘉县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3312, 391, '平阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3313, 391, '苍南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3314, 391, '文成县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3315, 391, '泰顺县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3316, 392, '定海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3317, 392, '普陀区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3318, 392, '岱山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3319, 392, '嵊泗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3320, 393, '衢州市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3321, 393, '江山市', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3322, 393, '常山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3323, 393, '开化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3324, 393, '龙游县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3325, 394, '合川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3326, 394, '江津区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3327, 394, '南川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3328, 394, '永川区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3329, 394, '南岸区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3330, 394, '渝北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3331, 394, '万盛区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3332, 394, '大渡口区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3333, 394, '万州区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3334, 394, '北碚区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3335, 394, '沙坪坝区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3336, 394, '巴南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3337, 394, '涪陵区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3338, 394, '江北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3339, 394, '九龙坡区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3340, 394, '渝中区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3341, 394, '黔江开发区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3342, 394, '长寿区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3343, 394, '双桥区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3344, 394, '綦江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3345, 394, '潼南县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3346, 394, '铜梁县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3347, 394, '大足县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3348, 394, '荣昌县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3349, 394, '璧山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3350, 394, '垫江县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3351, 394, '武隆县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3352, 394, '丰都县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3353, 394, '城口县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3354, 394, '梁平县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3355, 394, '开县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3356, 394, '巫溪县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3357, 394, '巫山县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3358, 394, '奉节县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3359, 394, '云阳县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3360, 394, '忠县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3361, 394, '石柱', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3362, 394, '彭水', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3363, 394, '酉阳', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3364, 394, '秀山', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3365, 395, '沙田区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3366, 395, '东区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3367, 395, '观塘区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3368, 395, '黄大仙区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3369, 395, '九龙城区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3370, 395, '屯门区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3371, 395, '葵青区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3372, 395, '元朗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3373, 395, '深水埗区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3374, 395, '西贡区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3375, 395, '大埔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3376, 395, '湾仔区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3377, 395, '油尖旺区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3378, 395, '北区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3379, 395, '南区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3380, 395, '荃湾区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3381, 395, '中西区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3382, 395, '离岛区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3383, 396, '澳门', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3384, 397, '台北', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3385, 397, '高雄', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3386, 397, '基隆', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3387, 397, '台中', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3388, 397, '台南', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3389, 397, '新竹', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3390, 397, '嘉义', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3391, 397, '宜兰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3392, 397, '桃园县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3393, 397, '苗栗县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3394, 397, '彰化县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3395, 397, '南投县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3396, 397, '云林县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3397, 397, '屏东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3398, 397, '台东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3399, 397, '花莲县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3400, 397, '澎湖县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3401, 3, '合肥', 2, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3402, 3401, '庐阳区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3403, 3401, '瑶海区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3404, 3401, '蜀山区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3405, 3401, '包河区', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3406, 3401, '长丰县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3407, 3401, '肥东县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3408, 3401, '肥西县', 3, NULL, NULL, NULL, NULL, 0);
INSERT INTO `dgtx_places` VALUES (3486, 2, '北京市', 2, '17670627203', '17670627203', '2020-09-09 15:18:51', '2020-09-09 15:18:51', 1);
INSERT INTO `dgtx_places` VALUES (3487, 3486, '西城区', 3, '17670627203', '17670627203', '2020-09-09 15:19:03', '2020-09-17 12:12:38', 0);

-- ----------------------------
-- Table structure for kj_bargain_goods
-- ----------------------------
DROP TABLE IF EXISTS `kj_bargain_goods`;
CREATE TABLE `kj_bargain_goods`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '添加时间',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '修改时间',
  `isValid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0，未删除， 1，已删除',
  `stationId` int(11) NULL DEFAULT NULL COMMENT '站点id',
  `createUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建人',
  `updateUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '修改人',
  `goodsId` int(11) NULL DEFAULT NULL COMMENT '商品id',
  `endPrice` int(11) NULL DEFAULT NULL COMMENT '设置底价',
  `startTime` datetime(0) NULL DEFAULT NULL COMMENT '活动开始时间',
  `endTime` datetime(0) NULL DEFAULT NULL COMMENT '活动结束时间',
  `hour` int(11) NULL DEFAULT 0 COMMENT '砍价限时-小时',
  `endPriceHide` tinyint(1) NULL DEFAULT 0 COMMENT '显示底价  0-显示 1-不显示',
  `endPriceIsOrder` tinyint(1) NULL DEFAULT 1 COMMENT '没到底价   0-可以下单 1-不可下单',
  `myCat` tinyint(1) NULL DEFAULT 0 COMMENT '自己砍价   0-允许  1-禁止',
  `launches` int(11) NULL DEFAULT 0 COMMENT '发起次数  0- 每个商品只允许发起一次砍价  1- 允许多次发起同一个商品的砍价',
  `totalCat` int(11) NULL DEFAULT 0 COMMENT '可砍价总次数',
  `eachCat` int(11) NULL DEFAULT 0 COMMENT '每人可砍次数',
  `maximum` int(11) NULL DEFAULT 0 COMMENT '活动可发起次数',
  `probability` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '每次砍价概率[{\"minCatPrice\":1,\"maxCatPrice\":5,\"rand\":20%}]',
  `rule` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '砍价规则',
  `storeId` int(11) NULL DEFAULT 0 COMMENT '入驻商户的id',
  `goodsAttrId` int(11) NOT NULL DEFAULT 0 COMMENT '商品属性id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '砍价商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_bargain_goods
-- ----------------------------

-- ----------------------------
-- Table structure for kj_basis
-- ----------------------------
DROP TABLE IF EXISTS `kj_basis`;
CREATE TABLE `kj_basis`  (
  `basisId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`basisId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '基础数据表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_basis
-- ----------------------------
INSERT INTO `kj_basis` VALUES (37, '17670627203', '2020-12-16 15:15:05', '17670627203', '2020-12-16 15:15:05', 0, '1-50人', 'CLIENT_RANGE');
INSERT INTO `kj_basis` VALUES (38, '17670627203', '2020-12-16 15:15:17', '17670627203', '2020-12-16 15:15:17', 0, '51-100', 'CLIENT_RANGE');
INSERT INTO `kj_basis` VALUES (39, '17670627203', '2020-12-16 15:15:36', '17670627203', '2020-12-16 15:15:36', 0, '101-500', 'CLIENT_RANGE');
INSERT INTO `kj_basis` VALUES (40, '17670627203', '2020-12-16 15:15:41', '17670627203', '2020-12-16 15:15:41', 0, '其他', 'CLIENT_RANGE');
INSERT INTO `kj_basis` VALUES (41, '17670627203', '2020-12-24 16:06:18', '17670627203', '2020-12-24 16:06:18', 0, '新增订单合同', 'CLIENT');

-- ----------------------------
-- Table structure for kj_client_contract
-- ----------------------------
DROP TABLE IF EXISTS `kj_client_contract`;
CREATE TABLE `kj_client_contract`  (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标题',
  `startTime` date NOT NULL COMMENT '合同开始时间',
  `endTime` date NOT NULL COMMENT '合同结束时间',
  `pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '图片',
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `staffId` int(11) NOT NULL COMMENT '职工编号',
  `basisId` int(11) NOT NULL COMMENT '合同类型',
  `use` int(11) NULL DEFAULT 0,
  `time` date NULL DEFAULT NULL,
  PRIMARY KEY (`contractId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '客户合同表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_client_contract
-- ----------------------------

-- ----------------------------
-- Table structure for kj_client_info
-- ----------------------------
DROP TABLE IF EXISTS `kj_client_info`;
CREATE TABLE `kj_client_info`  (
  `clientId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 潜在客户 2普通客户 3重要客户 4无机会客户',
  `staffId` int(11) NOT NULL,
  `industryId` int(11) NULL DEFAULT 0 COMMENT '行业编号',
  `provinceId` int(11) NULL DEFAULT 0 COMMENT '省',
  `cityId` int(11) NULL DEFAULT 0 COMMENT '市',
  `areaId` int(11) NULL DEFAULT 0 COMMENT '区',
  `tell` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机',
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '客户介绍',
  `website` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '官网',
  `staffRangeMin` int(255) NULL DEFAULT NULL COMMENT '最小员工范围',
  `staffRangeMax` int(255) NULL DEFAULT NULL COMMENT '最大员工范围',
  `isWork` tinyint(1) NULL DEFAULT 0 COMMENT '0 待开发 1已合作',
  `price` int(11) NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `range` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`clientId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '客户信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_client_info
-- ----------------------------

-- ----------------------------
-- Table structure for kj_client_person
-- ----------------------------
DROP TABLE IF EXISTS `kj_client_person`;
CREATE TABLE `kj_client_person`  (
  `personId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `tell` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '座机号码',
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系人姓名',
  `department` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '部门',
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '职位',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `weixin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '微信',
  `qq` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'qq',
  PRIMARY KEY (`personId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '客户联系人表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_client_person
-- ----------------------------

-- ----------------------------
-- Table structure for kj_config
-- ----------------------------
DROP TABLE IF EXISTS `kj_config`;
CREATE TABLE `kj_config`  (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `publicDay` int(11) NULL DEFAULT NULL COMMENT '共享日期',
  `contractDay` int(11) NULL DEFAULT NULL COMMENT '合同到期提示日期',
  `leaveTime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`configId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_config
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods`;
CREATE TABLE `kj_goods`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `categoryId` int(11) NULL DEFAULT 0 COMMENT '类别id',
  `price` int(11) NULL DEFAULT 0 COMMENT '价格',
  `number` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '编号',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '物品名称',
  `unit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `pic` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片',
  `describe` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '描述',
  `remark` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `isFinished` tinyint(1) NULL DEFAULT 0 COMMENT '1成品；2半成品',
  `weight` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '重量',
  `volume` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '体积',
  `parameter` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '参数',
  `attr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '规格',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 107 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_adjustment
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_adjustment`;
CREATE TABLE `kj_goods_adjustment`  (
  `adjustmentId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`adjustmentId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '库存调整主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_adjustment
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_adjustment_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_adjustment_detail`;
CREATE TABLE `kj_goods_adjustment_detail`  (
  `adjustmentDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `adjustmentId` int(11) NOT NULL DEFAULT 0 COMMENT '调整主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '商品数量，可以是小数',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`adjustmentDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '库存调整详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_adjustment_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_allocation
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_allocation`;
CREATE TABLE `kj_goods_allocation`  (
  `allocationId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `outWarehouseId` int(11) NOT NULL DEFAULT 0 COMMENT '调出仓库',
  `enterWarehouseId` int(11) NOT NULL DEFAULT 0 COMMENT '调入仓库',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`allocationId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '调拨表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_allocation
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_allocation_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_allocation_detail`;
CREATE TABLE `kj_goods_allocation_detail`  (
  `allocationDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `allocationId` int(11) NOT NULL DEFAULT 0 COMMENT '调拨主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`allocationDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '调拨详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_allocation_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_attr`;
CREATE TABLE `kj_goods_attr`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `attr` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'attr例[{\"attr_group_id\": \"3\",\"attr_group_name\": \"颜色\",\"attr_id\": \"4\", \"attr_name\": \"白色\"}, {\"attr_group_id\": \"4\",\"attr_group_name\": \"内存\",\"attr_id\": \"6\",\"attr_name\": \"4G\"}]',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '库存',
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片',
  `isDefault` tinyint(1) NULL DEFAULT 0 COMMENT '0不是默认属性，1是默认属性',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '添加时间',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '修改时间',
  `isValid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0，未删除， 1，已删除',
  `stationId` int(11) NOT NULL COMMENT '站点id',
  `createUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建人',
  `updateUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '修改人',
  `price` int(11) NOT NULL COMMENT '价格',
  `originalPrice` int(11) NULL DEFAULT 0 COMMENT '原价',
  `costPrice` int(11) NULL DEFAULT 0 COMMENT '成本价',
  `goodsSales` int(11) NULL DEFAULT 0 COMMENT '实际销量',
  `weight` int(11) NULL DEFAULT 0 COMMENT '重量',
  `goodsNO` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_borrow
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_borrow`;
CREATE TABLE `kj_goods_borrow`  (
  `borrowId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `borrowUser` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '领用人',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '备注',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '类型（1领用，2退领）',
  `date` date NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`borrowId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '物品领用表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_borrow
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_borrow_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_borrow_detail`;
CREATE TABLE `kj_goods_borrow_detail`  (
  `borrowDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `borrowId` int(11) NOT NULL DEFAULT 0 COMMENT '领用主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`borrowDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '物品领用详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_borrow_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_category`;
CREATE TABLE `kj_goods_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '编号',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '名称',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_category
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_in_storage
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_in_storage`;
CREATE TABLE `kj_goods_in_storage`  (
  `storageId` int(11) NOT NULL AUTO_INCREMENT,
  `workId` int(10) NULL DEFAULT 0 COMMENT '职工工单id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `storageDate` date NULL DEFAULT NULL COMMENT '入库日期',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '供应商',
  `staffId` int(11) NULL DEFAULT 0 COMMENT '职工id',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`storageId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3634 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '生产入库表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_in_storage
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_in_storage_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_in_storage_detail`;
CREATE TABLE `kj_goods_in_storage_detail`  (
  `storageDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `workId` int(10) NULL DEFAULT 0 COMMENT '工单id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `storageId` int(11) NOT NULL DEFAULT 0 COMMENT '生产入库主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '进货价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`storageDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3634 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '生产入库详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_in_storage_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_material
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_material`;
CREATE TABLE `kj_goods_material`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NULL DEFAULT 0 COMMENT '产品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `materialId` int(11) NULL DEFAULT 0 COMMENT '物料id',
  `number` int(11) NULL DEFAULT 0 COMMENT '数量',
  `describe` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '描述',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '产品，物料关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_material
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_production_consumption
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_production_consumption`;
CREATE TABLE `kj_goods_production_consumption`  (
  `consumptionId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `consumptionDate` date NULL DEFAULT NULL COMMENT '生产消耗日期',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '供应商',
  `staffId` int(11) NULL DEFAULT 0 COMMENT '职工id',
  `storageId` int(11) NULL DEFAULT 0 COMMENT '生产入库id',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`consumptionId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2361 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '生产物料消耗表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_production_consumption
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_production_consumption_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_production_consumption_detail`;
CREATE TABLE `kj_goods_production_consumption_detail`  (
  `consumptionDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `consumptionId` int(11) NOT NULL DEFAULT 0 COMMENT '主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '进货价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`consumptionDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2528 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '生产物料消耗详情' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_production_consumption_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_purchase
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_purchase`;
CREATE TABLE `kj_goods_purchase`  (
  `purchaseId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `purchaseDate` date NULL DEFAULT NULL COMMENT '进货日期',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '供应商',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`purchaseId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '进货主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_purchase
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_purchase_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_purchase_detail`;
CREATE TABLE `kj_goods_purchase_detail`  (
  `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `purchaseId` int(11) NOT NULL DEFAULT 0 COMMENT '进货主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '进货价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`purchaseDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '进货详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_purchase_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_return_goods
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_return_goods`;
CREATE TABLE `kj_goods_return_goods`  (
  `returnId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '供应商',
  `clientId` int(11) NULL DEFAULT 0 COMMENT '客户id',
  `returnDate` date NULL DEFAULT NULL COMMENT '退货日期',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`returnId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '退货表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_return_goods
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_return_goods_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_return_goods_detail`;
CREATE TABLE `kj_goods_return_goods_detail`  (
  `returnDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `returnId` int(11) NOT NULL DEFAULT 0 COMMENT '退货主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '进货价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`returnDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '退货详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_return_goods_detail

-- ----------------------------
-- Table structure for kj_goods_send
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_send`;
CREATE TABLE `kj_goods_send`  (
  `sendId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `orderId` int(11) NULL DEFAULT 0 COMMENT '订单id',
  `houseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `sendDate` date NULL DEFAULT NULL COMMENT '发货日期',
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `totalAmount` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '经手人',
  `supplier` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '供应商',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`sendId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '发货主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_send
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_send_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_send_detail`;
CREATE TABLE `kj_goods_send_detail`  (
  `sendDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `sendId` int(11) NOT NULL DEFAULT 0 COMMENT '进货主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '进货价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`sendDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '发货详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_send_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_station
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_station`;
CREATE TABLE `kj_goods_station`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品id',
  `groupId` int(11) NULL DEFAULT 0 COMMENT '权限组id',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '岗位关联产品' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_station
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_stock
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_stock`;
CREATE TABLE `kj_goods_stock`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NULL DEFAULT 0 COMMENT '物品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `wareHouseId` int(11) NULL DEFAULT 0 COMMENT '仓库id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 506 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '库存表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_stock
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_stock_loss
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_stock_loss`;
CREATE TABLE `kj_goods_stock_loss`  (
  `stockLossId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `type` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `houseId` int(11) NULL DEFAULT 0,
  `sn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '编号',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`stockLossId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '报损主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_stock_loss
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_stock_loss_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_stock_loss_detail`;
CREATE TABLE `kj_goods_stock_loss_detail`  (
  `stockLossDetailId` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `type` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `stockLossId` int(11) NOT NULL DEFAULT 0 COMMENT '报损主表id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '商品数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '价格',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`stockLossDetailId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '报损详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_stock_loss_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_stock_record
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_stock_record`;
CREATE TABLE `kj_goods_stock_record`  (
  `stockRecordId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsType` tinyint(1) NULL DEFAULT 0 COMMENT '1产品；2物料',
  `wareHouseId` int(11) NOT NULL DEFAULT 0 COMMENT '仓库id',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '金额',
  `type` tinyint(4) NOT NULL DEFAULT 11 COMMENT '11进货，12拨入，13退领，14销售退回，21退货，22拨出，23领用，24销售、25报损，31库存调整',
  `unionId` int(11) NULL DEFAULT 0 COMMENT '关联id （进货，调拨，销售，领用，报损，库存调整表关联id）',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '备注',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' ' COMMENT '经手人',
  `date` date NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '创建者',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '修改时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT ' ' COMMENT '修改者',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0正常，1删除',
  PRIMARY KEY (`stockRecordId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6455 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '库存记录流水表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_stock_record
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_ware_house
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_ware_house`;
CREATE TABLE `kj_goods_ware_house`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '编号',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '仓库名称',
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `keeper` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '保管员',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0 COMMENT '0未删除；1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '仓库信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_ware_house
-- ----------------------------
INSERT INTO `kj_goods_ware_house` VALUES (1, '001', '总仓库', NULL, NULL, 'system', '2020-12-02 00:00:00', 'system', '2020-12-02 00:00:00', 0);

-- ----------------------------
-- Table structure for kj_goods_working_procedure
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_working_procedure`;
CREATE TABLE `kj_goods_working_procedure`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goodsId` int(10) NULL DEFAULT 0 COMMENT '商品id',
  `sort` int(10) NULL DEFAULT 0 COMMENT '排序，第几道工序',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '工序名称',
  `price` int(11) NULL DEFAULT 0 COMMENT '工价',
  `consume` int(10) NULL DEFAULT 0 COMMENT '消耗上一步工序数量',
  `remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 531 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_working_procedure
-- ----------------------------

-- ----------------------------
-- Table structure for kj_goods_working_procedure_consume
-- ----------------------------
DROP TABLE IF EXISTS `kj_goods_working_procedure_consume`;
CREATE TABLE `kj_goods_working_procedure_consume`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `goodsId` int(10) NULL DEFAULT 0 COMMENT '产品或物料id',
  `goodsWorkingId` int(10) NULL DEFAULT 0 COMMENT '关联产品的工序id',
  `type` tinyint(1) NULL DEFAULT 0 COMMENT '0消耗产品；1消耗物料',
  `consume` int(10) NULL DEFAULT 0 COMMENT '消耗数量',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_goods_working_procedure_consume
-- ----------------------------

-- ----------------------------
-- Table structure for kj_industry
-- ----------------------------
DROP TABLE IF EXISTS `kj_industry`;
CREATE TABLE `kj_industry`  (
  `industryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pId` int(11) NULL DEFAULT 0 COMMENT '父级编号',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  PRIMARY KEY (`industryId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_industry
-- ----------------------------
INSERT INTO `kj_industry` VALUES (29, '制造行业', 0, '18673361517', '2020-08-04 14:56:02', '18673361517', '2020-09-16 12:02:33', 0, NULL);
INSERT INTO `kj_industry` VALUES (30, '专业设备制造业', 29, '18673361517', '2020-08-04 14:56:11', '18673361517', '2020-09-16 12:05:16', 0, NULL);
INSERT INTO `kj_industry` VALUES (31, '运输/物流/仓储', 0, '18673361517', '2020-08-04 14:57:19', '18673361517', '2020-09-16 12:03:16', 0, NULL);
INSERT INTO `kj_industry` VALUES (32, '仓储业', 31, '18673361517', '2020-08-04 14:57:26', '18673361517', '2020-09-16 12:09:37', 0, NULL);
INSERT INTO `kj_industry` VALUES (33, '技术支持', 0, '17670627203', '2020-08-04 14:57:32', '17670627203', '2020-08-04 14:57:41', 1, NULL);
INSERT INTO `kj_industry` VALUES (34, '软件测试', 32, '18673361517', '2020-08-04 14:57:48', '18673361517', '2020-09-16 12:09:31', 1, NULL);
INSERT INTO `kj_industry` VALUES (35, '软件开发', 0, '17670627203', '2020-08-04 14:58:02', '17670627203', '2020-08-04 14:58:12', 1, NULL);
INSERT INTO `kj_industry` VALUES (36, 'IT互联网行业', 0, '18673361517', '2020-08-05 17:45:56', '18673361517', '2020-09-16 12:03:49', 0, NULL);
INSERT INTO `kj_industry` VALUES (37, '互联网和相关服务', 36, '18673361517', '2020-08-05 17:46:07', '18673361517', '2020-09-16 14:12:38', 0, NULL);
INSERT INTO `kj_industry` VALUES (38, '临时工', 37, '18673361517', '2020-08-05 17:46:24', '18673361517', '2020-09-16 14:13:11', 1, NULL);
INSERT INTO `kj_industry` VALUES (39, '房地产', 0, '18673361517', '2020-09-16 12:04:10', '18673361517', '2020-09-16 12:04:10', 0, NULL);
INSERT INTO `kj_industry` VALUES (40, '金融', 0, '18673361517', '2020-09-16 12:04:34', '18673361517', '2020-09-16 12:04:34', 0, NULL);
INSERT INTO `kj_industry` VALUES (41, '汽车制造业', 29, '18673361517', '2020-09-16 12:06:53', '18673361517', '2020-09-16 12:06:53', 0, NULL);
INSERT INTO `kj_industry` VALUES (42, '金属制造业', 29, '18673361517', '2020-09-16 12:07:19', '18673361517', '2020-09-21 13:42:46', 0, NULL);
INSERT INTO `kj_industry` VALUES (43, '计算机、通信和其他电子设备制造业', 29, '18673361517', '2020-09-16 12:07:37', '18673361517', '2020-09-21 13:42:54', 0, NULL);
INSERT INTO `kj_industry` VALUES (44, '铁路、船舶、航空航天和其他运输设备制造业', 29, '18673361517', '2020-09-16 12:07:52', '18673361517', '2020-09-21 13:43:01', 0, NULL);
INSERT INTO `kj_industry` VALUES (45, '软件和信息技术服务业', 36, '18673361517', '2020-09-16 14:12:57', '18673361517', '2020-09-16 14:12:57', 0, NULL);
INSERT INTO `kj_industry` VALUES (46, '住宿/餐饮业', 0, '18673361517', '2020-09-16 14:13:48', '18673361517', '2020-09-16 14:13:48', 0, NULL);
INSERT INTO `kj_industry` VALUES (47, '政府/事业单位', 0, '18673361517', '2020-09-16 14:14:07', '18673361517', '2020-09-16 14:14:07', 0, NULL);
INSERT INTO `kj_industry` VALUES (48, '教育培训行业', 0, '18673361517', '2020-09-16 14:14:19', '18673361517', '2020-09-16 14:14:19', 0, NULL);
INSERT INTO `kj_industry` VALUES (49, '文化/体育/娱乐业', 0, '18673361517', '2020-09-16 14:14:33', '18673361517', '2020-09-16 14:14:33', 0, NULL);
INSERT INTO `kj_industry` VALUES (50, '批发/零售业', 0, '18673361517', '2020-09-16 14:14:43', '18673361517', '2020-09-16 14:14:43', 0, NULL);
INSERT INTO `kj_industry` VALUES (51, '电/热/煤/水业', 0, '18673361517', '2020-09-16 14:15:09', '18673361517', '2020-09-16 14:15:09', 0, NULL);
INSERT INTO `kj_industry` VALUES (52, '建筑业', 0, '18673361517', '2020-09-16 14:15:22', '18673361517', '2020-09-16 14:15:22', 0, NULL);
INSERT INTO `kj_industry` VALUES (53, '采矿业', 0, '18673361517', '2020-09-16 14:15:37', '18673361517', '2020-09-16 14:15:37', 0, NULL);
INSERT INTO `kj_industry` VALUES (54, '卫生/社会工作', 0, '18673361517', '2020-09-16 14:15:52', '18673361517', '2020-09-16 14:15:52', 0, NULL);
INSERT INTO `kj_industry` VALUES (55, '居民服务/修理', 0, '18673361517', '2020-09-16 14:16:00', '18673361517', '2020-09-16 14:16:00', 0, NULL);
INSERT INTO `kj_industry` VALUES (56, '水利/环境/公共设施', 0, '18673361517', '2020-09-16 14:16:07', '18673361517', '2020-09-16 14:16:07', 0, NULL);
INSERT INTO `kj_industry` VALUES (57, '科学研究/技术服务', 0, '18673361517', '2020-09-16 14:16:14', '18673361517', '2020-09-16 14:16:14', 0, NULL);
INSERT INTO `kj_industry` VALUES (58, '租赁/商务服务', 0, '18673361517', '2020-09-16 14:16:21', '18673361517', '2020-09-16 14:16:21', 0, NULL);
INSERT INTO `kj_industry` VALUES (59, '农/林/牧/渔业', 0, '18673361517', '2020-09-16 14:16:29', '18673361517', '2020-09-16 14:16:29', 0, NULL);
INSERT INTO `kj_industry` VALUES (60, '其他行业', 0, '18673361517', '2020-09-16 14:16:36', '18673361517', '2020-09-16 14:16:36', 0, NULL);
INSERT INTO `kj_industry` VALUES (61, '房地产业', 39, '18673361517', '2020-09-16 14:17:40', '18673361517', '2020-09-16 14:17:40', 0, NULL);
INSERT INTO `kj_industry` VALUES (62, '资本市场服务', 40, '18673361517', '2020-09-16 14:18:01', '18673361517', '2020-09-16 14:18:01', 0, NULL);
INSERT INTO `kj_industry` VALUES (63, '餐饮业', 46, '18673361517', '2020-09-16 14:18:35', '18673361517', '2020-09-16 14:18:35', 0, NULL);
INSERT INTO `kj_industry` VALUES (64, '住宿业', 46, '18673361517', '2020-09-16 14:18:54', '18673361517', '2020-09-16 14:18:54', 0, NULL);
INSERT INTO `kj_industry` VALUES (65, '基层群众自治组织', 47, '18673361517', '2020-09-16 14:19:13', '18673361517', '2020-09-16 14:19:13', 0, NULL);
INSERT INTO `kj_industry` VALUES (66, '群众团体、社会团体和其他成员组织', 47, '18673361517', '2020-09-16 14:19:31', '18673361517', '2020-09-16 14:19:31', 0, NULL);
INSERT INTO `kj_industry` VALUES (67, '人民政协、民主党派', 47, '18673361517', '2020-09-16 14:19:46', '18673361517', '2020-09-16 14:19:46', 0, NULL);
INSERT INTO `kj_industry` VALUES (68, '国家机构', 47, '18673361517', '2020-09-16 14:19:58', '18673361517', '2020-09-16 14:19:58', 0, NULL);
INSERT INTO `kj_industry` VALUES (69, '中国共产党机关', 47, '18673361517', '2020-09-16 14:20:12', '18673361517', '2020-09-16 14:20:12', 0, NULL);
INSERT INTO `kj_industry` VALUES (70, '体育', 49, '18673361517', '2020-09-16 14:20:54', '18673361517', '2020-09-16 14:20:54', 0, NULL);
INSERT INTO `kj_industry` VALUES (71, '娱乐业', 49, '18673361517', '2020-09-16 14:21:07', '18673361517', '2020-09-16 14:21:07', 0, NULL);
INSERT INTO `kj_industry` VALUES (72, '广播、电视、电影和影视录音制作业', 49, '18673361517', '2020-09-16 14:21:20', '18673361517', '2020-09-16 14:21:20', 0, NULL);
INSERT INTO `kj_industry` VALUES (73, '文化艺术业', 49, '18673361517', '2020-09-16 14:21:34', '18673361517', '2020-09-16 14:21:34', 0, NULL);
INSERT INTO `kj_industry` VALUES (74, '新闻和出版社', 49, '18673361517', '2020-09-16 14:21:54', '18673361517', '2020-09-16 14:21:54', 0, NULL);
INSERT INTO `kj_industry` VALUES (75, '燃气生产和供应业', 51, '18673361517', '2020-09-16 14:22:19', '18673361517', '2020-09-16 14:22:19', 0, NULL);
INSERT INTO `kj_industry` VALUES (76, '电力、热力生产和供应业', 51, '18673361517', '2020-09-16 14:22:31', '18673361517', '2020-09-16 14:22:31', 0, NULL);
INSERT INTO `kj_industry` VALUES (77, '水的生产和供应业', 51, '18673361517', '2020-09-16 14:22:44', '18673361517', '2020-09-16 14:22:44', 0, NULL);
INSERT INTO `kj_industry` VALUES (78, '建筑安装业', 52, '18673361517', '2020-09-16 14:23:05', '18673361517', '2020-09-16 14:23:05', 0, NULL);
INSERT INTO `kj_industry` VALUES (79, '土木工程建筑业', 52, '18673361517', '2020-09-16 14:23:19', '18673361517', '2020-09-16 14:23:19', 0, NULL);
INSERT INTO `kj_industry` VALUES (80, '房屋建筑业', 52, '18673361517', '2020-09-16 14:23:32', '18673361517', '2020-09-16 14:23:32', 0, NULL);
INSERT INTO `kj_industry` VALUES (81, '建筑装饰及建材', 52, '18673361517', '2020-09-16 14:23:43', '18673361517', '2020-09-16 14:23:43', 0, NULL);
INSERT INTO `kj_industry` VALUES (82, '开采辅助活动', 53, '18673361517', '2020-09-16 14:24:10', '18673361517', '2020-09-16 14:24:10', 0, NULL);
INSERT INTO `kj_industry` VALUES (83, '有色金属矿采选业', 53, '18673361517', '2020-09-16 14:24:22', '18673361517', '2020-09-16 14:24:22', 0, NULL);
INSERT INTO `kj_industry` VALUES (84, '黑色金属矿采选业', 53, '18673361517', '2020-09-16 14:24:33', '18673361517', '2020-09-16 14:24:33', 0, NULL);
INSERT INTO `kj_industry` VALUES (85, '煤炭开采和洗选业', 53, '18673361517', '2020-09-16 14:24:43', '18673361517', '2020-09-16 14:24:43', 0, NULL);
INSERT INTO `kj_industry` VALUES (86, '石油和天然气开采业', 53, '18673361517', '2020-09-16 14:24:54', '18673361517', '2020-09-16 14:24:54', 0, NULL);
INSERT INTO `kj_industry` VALUES (87, '非金属矿采选业', 53, '18673361517', '2020-09-16 14:25:04', '18673361517', '2020-09-16 14:25:04', 0, NULL);
INSERT INTO `kj_industry` VALUES (88, '其他采矿业', 53, '18673361517', '2020-09-16 14:25:15', '18673361517', '2020-09-16 14:25:15', 0, NULL);

-- ----------------------------
-- Table structure for kj_job_career_record
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_career_record`;
CREATE TABLE `kj_job_career_record`  (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 入职 1离职',
  `jobId` int(11) NOT NULL DEFAULT 0 COMMENT '求职者编号',
  `staffId` int(11) NULL DEFAULT 0 COMMENT '推荐人编号',
  `clientId` int(11) NOT NULL DEFAULT 0 COMMENT '客户编号',
  `supplierId` int(11) NULL DEFAULT 0 COMMENT '供应商编号',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `department` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '部门',
  `startTime` date NULL DEFAULT NULL COMMENT '开始时间',
  `endTime` date NULL DEFAULT NULL COMMENT '结束时间',
  `idCard` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证',
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '入职岗位',
  `interviewTime` date NULL DEFAULT NULL COMMENT '面试时间',
  `trainTime` date NULL DEFAULT NULL COMMENT '培训时间',
  `politicalStatus` tinyint(1) NULL DEFAULT NULL COMMENT '政治面貌 1 团员 2 党员 3群众 4 其他',
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '开户银行',
  `bankCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '银行账号',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `emergencyContact` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '紧急联系人',
  `emergencyTell` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '紧急电话',
  `first` tinyint(1) NULL DEFAULT 0 COMMENT '是否第一次买社保 0 是 1否',
  `laborContractPic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '劳动合同图',
  `cedicalReportPic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '体检报告图',
  `time` date NULL DEFAULT NULL COMMENT '入职/离职时间',
  `leaveReason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '离职原因',
  `leavePic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '离职图',
  `socialSecurity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '社保',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `emergency` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `idCardPositivePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idCardReversePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `leaveType` tinyint(1) NULL DEFAULT NULL,
  `jobNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '工号',
  `bankReversePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bankPositivePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`recordId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '求职者职业生涯记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_job_career_record
-- ----------------------------

-- ----------------------------
-- Table structure for kj_job_info
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_info`;
CREATE TABLE `kj_job_info`  (
  `jobId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL COMMENT '状态 1 共享资源  2 跟进 3 入职 4离职',
  `clientId` int(11) NULL DEFAULT 0 COMMENT '外配上班的客户编号',
  `staffId` int(11) NULL DEFAULT 0 COMMENT '推荐人 职工编号',
  `supplierId` int(11) NULL DEFAULT 0 COMMENT '供应商编号',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(1) NULL DEFAULT NULL COMMENT '0 女 1男',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机号',
  `birthday` date NULL DEFAULT NULL COMMENT '生日',
  `education` tinyint(1) NULL DEFAULT NULL COMMENT '1 大专 2本科',
  `channelId` int(11) NULL DEFAULT NULL COMMENT '渠道',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `userId` int(11) NULL DEFAULT NULL,
  `workTime` date NULL DEFAULT NULL COMMENT '入职时间',
  `age` int(11) NULL DEFAULT NULL COMMENT '年龄',
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isLunarCalendar` tinyint(1) NULL DEFAULT 0 COMMENT '0 农历 1 阳历',
  `idCard` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证',
  `startTime` date NULL DEFAULT NULL COMMENT '合同开始时间',
  `endTime` date NULL DEFAULT NULL COMMENT '合同结束时间',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `entryId` int(11) NULL DEFAULT NULL COMMENT '入职合同编号',
  `leaveId` int(11) NULL DEFAULT NULL COMMENT '离职合同编号',
  `jobNumber` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idCardPositivePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idCardReversePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `leaveTime` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`jobId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '求职者信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_job_info
-- ----------------------------

-- ----------------------------
-- Table structure for kj_job_interview_record
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_interview_record`;
CREATE TABLE `kj_job_interview_record`  (
  `interviewId` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 邀约面试中 2面试通过 3面试未通过 4未参加面试',
  `jobId` int(11) NULL DEFAULT 0 COMMENT '求职者编号',
  `clientId` int(11) NULL DEFAULT NULL COMMENT '客户编号',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '职工编号',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '职位',
  `time` datetime(0) NULL DEFAULT NULL COMMENT '面试时间',
  `skill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '技能',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `education` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '学历',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机号',
  `sex` tinyint(1) NULL DEFAULT NULL COMMENT '0 女 1男',
  PRIMARY KEY (`interviewId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '求职者面试记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_job_interview_record
-- ----------------------------

-- ----------------------------
-- Table structure for kj_job_registra
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_registra`;
CREATE TABLE `kj_job_registra`  (
  `registraId` int(11) NOT NULL AUTO_INCREMENT COMMENT '报名编号',
  `jobId` int(11) NOT NULL COMMENT '人才编号',
  `recruitmentId` int(11) NOT NULL COMMENT '招聘编号',
  `clientId` int(11) NOT NULL COMMENT '客户编号',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '是否删除 0否 1是',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '报名时间',
  `creator` int(11) NULL DEFAULT NULL COMMENT '新增人',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '修改时间',
  `updater` int(11) NULL DEFAULT NULL COMMENT '修改人',
  `invite` tinyint(1) NULL DEFAULT 2 COMMENT '是否邀约 1是 2否',
  PRIMARY KEY (`registraId`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of kj_job_registra
-- ----------------------------

-- ----------------------------
-- Table structure for kj_job_skill
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_skill`;
CREATE TABLE `kj_job_skill`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `basisId` int(11) NOT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '求职者技能关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_job_skill
-- ----------------------------

-- ----------------------------
-- Table structure for kj_job_social_security
-- ----------------------------
DROP TABLE IF EXISTS `kj_job_social_security`;
CREATE TABLE `kj_job_social_security`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `basisId` int(11) NOT NULL,
  `recordId` int(11) NOT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '求职者社保关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_job_social_security
-- ----------------------------

-- ----------------------------
-- Table structure for kj_notice
-- ----------------------------
DROP TABLE IF EXISTS `kj_notice`;
CREATE TABLE `kj_notice`  (
  `noticeId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标题',
  `time` datetime(0) NULL DEFAULT NULL COMMENT '面试时间',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '职工编号',
  PRIMARY KEY (`noticeId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '通知表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_notice
-- ----------------------------

-- ----------------------------
-- Table structure for kj_payments_account
-- ----------------------------
DROP TABLE IF EXISTS `kj_payments_account`;
CREATE TABLE `kj_payments_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '账户名称',
  `accountNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '账号',
  `incomeAmount` int(11) NULL DEFAULT 0 COMMENT '收入金额',
  `expenditureAmount` int(11) NULL DEFAULT 0 COMMENT '支出金额',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_payments_account
-- ----------------------------

-- ----------------------------
-- Table structure for kj_payments_log
-- ----------------------------
DROP TABLE IF EXISTS `kj_payments_log`;
CREATE TABLE `kj_payments_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(4) NOT NULL COMMENT '类型：1收入；2支出；3转账',
  `needBill` tinyint(1) NULL DEFAULT 0 COMMENT '1开发票；2不开发票',
  `departmentId` int(11) NULL DEFAULT 0 COMMENT '部门',
  `date` date NULL DEFAULT NULL COMMENT '发生日期',
  `paymentsTypeId` int(11) NULL DEFAULT 0 COMMENT '收支类别',
  `incomeAccount` int(11) NULL DEFAULT 0 COMMENT '收入账户',
  `expenditureAccount` int(11) NULL DEFAULT 0 COMMENT '支出账户',
  `amount` int(11) NULL DEFAULT 0 COMMENT '金额',
  `describe` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `orderId` int(11) NULL DEFAULT 0 COMMENT '订单id',
  `clientId` int(11) NULL DEFAULT 0 COMMENT '客户id',
  `objectId` int(11) NULL DEFAULT 0 COMMENT '对象id',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_payments_log
-- ----------------------------

-- ----------------------------
-- Table structure for kj_payments_statics_day
-- ----------------------------
DROP TABLE IF EXISTS `kj_payments_statics_day`;
CREATE TABLE `kj_payments_statics_day`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NULL DEFAULT 0 COMMENT '1收入；2支出',
  `day` date NULL DEFAULT NULL COMMENT '统计日期',
  `amount` int(11) NULL DEFAULT 0 COMMENT '金额',
  `accountId` int(11) NOT NULL DEFAULT 0 COMMENT '账户id',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_payments_statics_day
-- ----------------------------

-- ----------------------------
-- Table structure for kj_payments_type
-- ----------------------------
DROP TABLE IF EXISTS `kj_payments_type`;
CREATE TABLE `kj_payments_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NULL DEFAULT 0 COMMENT '1收入类型；2支出类型',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_payments_type
-- ----------------------------

-- ----------------------------
-- Table structure for kj_print_templates
-- ----------------------------
DROP TABLE IF EXISTS `kj_print_templates`;
CREATE TABLE `kj_print_templates`  (
  `printTemplatesId` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '类型',
  `format` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '版式',
  `h5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT 'h5内容',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建用户',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '更新用户',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime(0) NULL DEFAULT '1700-07-18 00:00:00' COMMENT '更新时间',
  `isValid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 未删除 1 已删除',
  PRIMARY KEY (`printTemplatesId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 194 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '打印模板表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_print_templates
-- ----------------------------
INSERT INTO `kj_print_templates` VALUES (193, 1, '1', '<p style=\"margin: 0px; text-align: center;\"><strong>产品装运清单</strong><br/></p><p style=\"margin: 0px;\"><br/></p><p style=\"margin: 0px;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收货单位：</strong><a data-v-462478d2=\"\" draggable=\"true\" value=\"clientName\" style=\"color: inherit;\"><strong>{clientName}</strong></a><strong><br/></strong></p><p style=\"margin: 0px;\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sendCompany\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></a></p><p style=\"margin: 0px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;<strong style=\"white-space: normal;\">订单编号：</strong><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"number\" style=\"color: inherit; white-space: normal;\"><strong>{number}</strong></a></strong></p><p style=\"margin: 0px;\"><strong><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"number\" style=\"color: inherit; white-space: normal;\"><strong><br/></strong></a></strong></p><p style=\"margin: 0px;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发货方式：</strong><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sendWay\" style=\"color: inherit;\"><strong>{sendWay}</strong></a><br/></p><p style=\"margin: 0px;\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sendWay\"><strong><br/></strong></a></p><table style=\"border:1px solid #000000;border-collapse:collapse;width:100%; padding-top:6px;font-size:13px;\" width=\"-70\" data-sort=\"sortDisabled\"><tbody><tr class=\"firstRow\"><td valign=\"top\" colspan=\"2\" style=\"vertical-align:middle;border:1px solid #000000;word-break: break-all;\" width=\"179\" height=\"49\"><strong>&nbsp; 联系人</strong></td><td rowspan=\"1\" valign=\"top\" align=\"null\" colspan=\"5\" style=\"vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"49\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"clientName\" style=\"color: inherit;\"><strong>&nbsp; {contacts} {tell}</strong></a><strong><br/></strong></td></tr><tr><td width=\"56\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>序号</strong></td><td valign=\"top\" colspan=\"2\" width=\"222\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>产品名称</strong></td><td width=\"255\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>规格型号</strong></td><td width=\"54\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>单位</strong></td><td width=\"58\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>数量</strong></td><td width=\"230\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><strong>备注</strong></td></tr><tr class=\"start-loop\"><td width=\"56\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sort\"></a><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sort\" style=\"color: inherit;\">{sort}</a><br/></td><td valign=\"top\" colspan=\"2\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\" width=\"223\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"goodsName\" style=\"color: inherit;\">{goodsName}</a><br/></td><td width=\"255\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"attr\" style=\"color: inherit;\">{attr}</a><br/></td><td width=\"54\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"unit\" style=\"color: inherit;\">{unit}</a><br/></td><td width=\"58\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"num\" style=\"color: inherit;\">{num}</a><br/></td><td width=\"230\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"53\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"remark\" style=\"color: inherit;\">{remark}</a><br/></td></tr><tr class=\"end-tr\"><td width=\"56\" valign=\"top\" style=\"border:1px solid #000000;word-break: break-all;\" height=\"44\"><br/></td><td valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" colspan=\"2\" width=\"64\" height=\"44\">合计</td><td width=\"255\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><br/></td><td width=\"54\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\">件</td><td width=\"58\" valign=\"top\" style=\"text-align:center;vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"44\"><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"sum\" style=\"color: inherit;\">{sum}</a><br/></td><td width=\"230\" valign=\"top\" style=\"border:1px solid #000000;word-break: break-all;\" height=\"44\"><br/></td></tr><tr><td valign=\"top\" colspan=\"2\" style=\"vertical-align:middle;border:1px solid #000000;word-break: break-all;\" height=\"82\" width=\"211\"><strong>&nbsp; 收货人签字<br/></strong></td><td valign=\"top\" height=\"82\" colspan=\"2\" width=\"360\" style=\"vertical-align:middle;border:1px solid #000000;word-break: break-all;\"><br/></td><td valign=\"top\" height=\"82\" colspan=\"2\" style=\"vertical-align:middle;border:1px solid #000000;word-break: break-all;\"><strong>&nbsp; 收货单位盖章<br/></strong></td><td width=\"230\" valign=\"top\" height=\"82\" style=\"border:1px solid #000000;word-break: break-all;\"><br/></td></tr></tbody></table><p style=\"margin: 0;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p class=\"address\" style=\"margin: 0;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id=\"cdTitle\">收货地址：</strong><a data-v-fa7f99c2=\"\" draggable=\"true\" value=\"clientAddress\" style=\"color: inherit;\"><strong id=\"cdText\">{clientAddress}</strong></a><br/></p><p style=\"margin: 0;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></p><p style=\"margin: 0;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发料人：</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>运输人：</strong><br/></p><p style=\"margin: 0;\"><strong><br/></strong></p><p style=\"margin: 0;\"><strong><br/></strong></p><p style=\"margin: 0;\"><br/></p><p style=\"margin: 0;\"><br/></p><p style=\"margin: 0;\"><br/></p><p style=\"margin: 0px; text-align: right;\"><strong>{date}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><br/></p>', '17670627203', '17670627203', '2020-12-17 14:33:22', '2020-12-29 15:18:09', 0);

-- ----------------------------
-- Table structure for kj_project_info
-- ----------------------------
DROP TABLE IF EXISTS `kj_project_info`;
CREATE TABLE `kj_project_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '项目名称',
  `startTime` date NULL DEFAULT NULL COMMENT '开始时间',
  `cycle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '项目周期',
  `endTime` date NULL DEFAULT NULL COMMENT '结束时间',
  `projectLeader` int(11) NULL DEFAULT 0 COMMENT '项目责任人',
  `projectExplain` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '项目描述，说明',
  `projectScore` int(11) NULL DEFAULT 0 COMMENT '项目评分',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '项目金额',
  `receiptPrice` int(11) NULL DEFAULT 0 COMMENT '收款金额',
  `expenditurePrice` int(11) NULL DEFAULT 0 COMMENT '支出金额',
  `reportUserId` int(11) NOT NULL DEFAULT 0 COMMENT '报备人id',
  `reportTime` date NOT NULL COMMENT '项目报备时间',
  `status` tinyint(4) NULL DEFAULT 1 COMMENT '项目状态：0未设置；1待审；2已报备；3一开始；4已结束',
  `contractStatus` tinyint(4) NULL DEFAULT 1 COMMENT '合同收发状态：0未设置；1未发送；2已发送；3已签收',
  `receiptStatus` tinyint(4) NULL DEFAULT 1 COMMENT '收款状态：0未设置；1未收款；2收款一部分；3收款完成',
  `joinPersonal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '参与人员：张三，李四',
  `belongCustomer` int(11) NULL DEFAULT 0 COMMENT '所属客户',
  `clientPersonId` int(11) NULL DEFAULT 0 COMMENT '所属客户联系人id',
  `projectAddress` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '项目地点',
  `projectDescribe` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '项目描述',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0 COMMENT '0未删除；1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_project_info
-- ----------------------------

-- ----------------------------
-- Table structure for kj_quality_testing_log
-- ----------------------------
DROP TABLE IF EXISTS `kj_quality_testing_log`;
CREATE TABLE `kj_quality_testing_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salesOrderId` int(11) NOT NULL,
  `status` tinyint(4) NULL DEFAULT 0 COMMENT '1质检成功；2质检失败',
  `describe` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_quality_testing_log
-- ----------------------------

-- ----------------------------
-- Table structure for kj_receive_log
-- ----------------------------
DROP TABLE IF EXISTS `kj_receive_log`;
CREATE TABLE `kj_receive_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NULL DEFAULT 0 COMMENT '类型：1采购单收货记录；2订单发货记录',
  `orderId` int(11) NULL DEFAULT 0 COMMENT '采购单或销售订单id',
  `orderDetailId` int(11) NULL DEFAULT 0 COMMENT '订单详情id',
  `goodsId` int(11) NULL DEFAULT 0 COMMENT '物品id',
  `num` int(11) NULL DEFAULT 0 COMMENT '数量',
  `price` int(11) NULL DEFAULT 0 COMMENT '物品单价',
  `unit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `time` datetime(0) NULL DEFAULT '1970-01-01 00:00:00' COMMENT '产生时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_receive_log
-- ----------------------------

-- ----------------------------
-- Table structure for kj_recruitment
-- ----------------------------
DROP TABLE IF EXISTS `kj_recruitment`;
CREATE TABLE `kj_recruitment`  (
  `recruitmentId` int(11) NOT NULL AUTO_INCREMENT COMMENT '招聘ID',
  `clientId` int(11) NOT NULL COMMENT '客户ID',
  `sex` tinyint(1) NOT NULL COMMENT '性别 1男，0女，2无要求',
  `minSalary` int(11) NOT NULL COMMENT '最小薪资',
  `maxSalary` int(11) NOT NULL COMMENT '最大薪资',
  `minAge` int(3) NULL DEFAULT NULL COMMENT '最小年龄',
  `maxAge` int(3) NULL DEFAULT NULL COMMENT '最大年龄',
  `education` int(3) NULL DEFAULT NULL COMMENT '学历',
  `provinceId` int(11) NULL DEFAULT NULL COMMENT '省',
  `cityId` int(11) NULL DEFAULT NULL COMMENT '市',
  `areaId` int(11) NULL DEFAULT NULL COMMENT '区',
  `advantage` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '招聘优势',
  `post` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '岗位',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '活动状态：1.发布，2.撤销发布',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '0，未删除， 1，已删除',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '发布人id',
  `creator` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建人',
  `updater` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '修改人',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`recruitmentId`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_recruitment
-- ----------------------------

-- ----------------------------
-- Table structure for kj_report
-- ----------------------------
DROP TABLE IF EXISTS `kj_report`;
CREATE TABLE `kj_report`  (
  `reportId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `jobAdd` tinyint(1) NULL DEFAULT NULL,
  `interviewAdd` tinyint(1) NULL DEFAULT NULL,
  `entryAdd` tinyint(1) NULL DEFAULT NULL,
  `interviewGoAdd` tinyint(1) NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `time` date NULL DEFAULT NULL,
  PRIMARY KEY (`reportId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_report
-- ----------------------------

-- ----------------------------
-- Table structure for kj_sales_order
-- ----------------------------
DROP TABLE IF EXISTS `kj_sales_order`;
CREATE TABLE `kj_sales_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '订单编号',
  `contractCode` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '合同编号',
  `orderDate` date NOT NULL COMMENT '订单日期',
  `clientId` int(11) NULL DEFAULT 0 COMMENT '客户名称',
  `clientPersonId` int(11) NULL DEFAULT 0 COMMENT '客户联系人id',
  `totalPrice` int(11) NULL DEFAULT 0 COMMENT '订单总金额',
  `receiptPrice` int(11) NULL DEFAULT 0 COMMENT '收款金额',
  `expenditureAmount` int(11) NULL DEFAULT 0 COMMENT '支出金额',
  `deliveryDate` date NULL DEFAULT NULL COMMENT '要求交货日期',
  `sendDate` date NULL DEFAULT NULL COMMENT '发货时间',
  `sendWay` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '发货方式',
  `clientAddress` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '客户地址',
  `status` tinyint(4) NULL DEFAULT 0 COMMENT '状态：1生产中；2生产完成；3已发货；4已完成',
  `collectionStatus` tinyint(1) NULL DEFAULT 0 COMMENT '1未完成；2已完成',
  `fileUrl` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '合同url',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '销售订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sales_order
-- ----------------------------

-- ----------------------------
-- Table structure for kj_sales_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `kj_sales_order_detail`;
CREATE TABLE `kj_sales_order_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NULL DEFAULT 0 COMMENT '订单id',
  `goodsId` int(11) NULL DEFAULT 0 COMMENT '物品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `price` int(11) NULL DEFAULT 0 COMMENT '单价',
  `isTax` tinyint(1) NULL DEFAULT 0 COMMENT '1不含税；2含税',
  `taxPrice` int(11) NULL DEFAULT 0 COMMENT '含税价格',
  `num` int(11) NULL DEFAULT 0 COMMENT '订购数量',
  `deliveryNum` int(11) NULL DEFAULT 0 COMMENT '交货数量',
  `unit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '销售订单详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sales_order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for kj_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `kj_sms_log`;
CREATE TABLE `kj_sms_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isCheck` tinyint(4) NULL DEFAULT 0 COMMENT '是否验证：0未验证；1已验证',
  `checkTime` datetime(0) NULL DEFAULT NULL COMMENT '验证时间',
  `createTime` datetime(0) NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  `type` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sms_log
-- ----------------------------

-- ----------------------------
-- Table structure for kj_staff_contract
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_contract`;
CREATE TABLE `kj_staff_contract`  (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标题',
  `startTime` date NULL DEFAULT NULL COMMENT '开始时间',
  `endTime` date NULL DEFAULT NULL COMMENT '结束时间',
  `laborContractPic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '劳动合同',
  `competitionAgreementPic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '竞业协议',
  `confidentialityContract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '保密合同',
  `use` tinyint(1) NULL DEFAULT 0 COMMENT '0 否 1是',
  PRIMARY KEY (`contractId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '职工合同表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_contract
-- ----------------------------

-- ----------------------------
-- Table structure for kj_staff_info
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_info`;
CREATE TABLE `kj_staff_info`  (
  `staffId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `jobNumber` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '工号',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '电话',
  `sectionId` int(11) NULL DEFAULT NULL COMMENT '部门编号',
  `positionId` int(11) NULL DEFAULT NULL COMMENT '职位编号',
  `entryTime` date NULL DEFAULT NULL COMMENT '入职时间',
  `seniority` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '工龄',
  `probation` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '试用期',
  `startTime` date NULL DEFAULT NULL COMMENT '开始时间',
  `endTime` date NULL DEFAULT NULL COMMENT '结束时间',
  `trainTime` date NULL DEFAULT NULL COMMENT '培训时间',
  `idName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份名称',
  `idCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证',
  `birthday` date NULL DEFAULT NULL COMMENT '生日',
  `isLunarCalendar` tinyint(1) NULL DEFAULT NULL COMMENT '0 农历 1 阳历',
  `nation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '民族',
  `maritalStatus` tinyint(1) NULL DEFAULT NULL COMMENT '1 未婚 2已婚 3离异 4丧偶 5分居',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '住址',
  `politicalStatus` tinyint(1) NULL DEFAULT NULL COMMENT '1 团员 2 党员 3群众 4 其他',
  `socialSecurityAccount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '社保账号',
  `providentFundAccount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '公积金账号',
  `first` tinyint(1) NULL DEFAULT NULL COMMENT '0 是 1否',
  `commercialInsurance` varbinary(255) NULL DEFAULT NULL COMMENT '商业险',
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '开户银行',
  `bankCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '银行账号',
  `education` int(11) NULL DEFAULT NULL COMMENT '学历',
  `profession` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '所学专业',
  `finishSchool` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '毕业学校',
  `finishTime` date NULL DEFAULT NULL COMMENT '毕业时间',
  `personName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系人姓名',
  `personType` tinyint(1) NULL DEFAULT NULL COMMENT '1 父母 2配偶 3子女 4其他',
  `personTell` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系人电话',
  `idCardPositivePic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证正面',
  `idCardReversePic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证国徽',
  `educationPic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '学历证书',
  `academicDegreePic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '学位证书',
  `Referrer` int(11) NULL DEFAULT NULL COMMENT '推荐人',
  `channelId` int(11) NULL DEFAULT NULL COMMENT '渠道编号',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `userId` int(11) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '0 在职 1 离职',
  `sex` tinyint(1) NULL DEFAULT NULL COMMENT '0 女 1男',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '姓名',
  `socialSecurity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '社保',
  `wages` int(10) NULL DEFAULT 0 COMMENT '工价',
  PRIMARY KEY (`staffId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '职工信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_info
-- ----------------------------

-- ----------------------------
-- Table structure for kj_staff_leave
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_leave`;
CREATE TABLE `kj_staff_leave`  (
  `leaveId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `time` date NULL DEFAULT NULL COMMENT '离职时间',
  `leaveReason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '离职原因',
  `leavePic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '解除劳动合同协议',
  `leaveType` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`leaveId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '职工离职表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_leave
-- ----------------------------

-- ----------------------------
-- Table structure for kj_staff_position
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_position`;
CREATE TABLE `kj_staff_position`  (
  `positionId` int(11) NOT NULL AUTO_INCREMENT,
  `sectionId` int(11) NULL DEFAULT NULL COMMENT '岗位编号',
  `parentId` int(11) NULL DEFAULT NULL COMMENT '父级编号',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`positionId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '职工岗位表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_position
-- ----------------------------

-- ----------------------------
-- Table structure for kj_staff_section
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_section`;
CREATE TABLE `kj_staff_section`  (
  `sectionId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `staffId` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系人',
  `isCompany` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1' COMMENT '是否公司 1公司 0部门',
  `abbreviation` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '简称',
  `startTime` date NULL DEFAULT NULL COMMENT '开启时间',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '组织代码',
  PRIMARY KEY (`sectionId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '职工部门表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_section
-- ----------------------------
INSERT INTO `kj_staff_section` VALUES (1, NULL, '15096369446', '2020-12-26 13:57:23', '15096369446', '2020-12-26 13:57:23', 0, '生产部', '1', NULL, NULL, '2020-12-26', NULL);

-- ----------------------------
-- Table structure for kj_staff_work_record
-- ----------------------------
DROP TABLE IF EXISTS `kj_staff_work_record`;
CREATE TABLE `kj_staff_work_record`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `staffId` int(10) NULL DEFAULT 0 COMMENT '职工id',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '类型：1计时；2计件',
  `date` date NULL DEFAULT NULL COMMENT '工单日期',
  `endDate` date NULL DEFAULT NULL COMMENT '休息结束日期',
  `goodsId` int(10) NULL DEFAULT 0 COMMENT '产品id',
  `workingId` int(10) NULL DEFAULT 0 COMMENT '工序id',
  `amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '工时(或计件数量)',
  `price` int(10) NULL DEFAULT 0 COMMENT '单位工价',
  `remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7012 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_staff_work_record
-- ----------------------------

-- ----------------------------
-- Table structure for kj_statistical
-- ----------------------------
DROP TABLE IF EXISTS `kj_statistical`;
CREATE TABLE `kj_statistical`  (
  `statisticalId` int(11) NOT NULL AUTO_INCREMENT,
  `time` date NOT NULL,
  `jobAdd` tinyint(1) NULL DEFAULT NULL,
  `interviewAdd` tinyint(1) NULL DEFAULT NULL,
  `entryAdd` tinyint(1) NULL DEFAULT NULL,
  `interviewGoAdd` tinyint(1) NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `staffId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`statisticalId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_statistical
-- ----------------------------

-- ----------------------------
-- Table structure for kj_supplier_contract
-- ----------------------------
DROP TABLE IF EXISTS `kj_supplier_contract`;
CREATE TABLE `kj_supplier_contract`  (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标题',
  `startTime` date NOT NULL COMMENT '合同开始时间',
  `endTime` date NOT NULL COMMENT '合同结束时间',
  `pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '图片',
  `supplierId` int(11) NOT NULL COMMENT '供应商编号',
  `staffId` int(11) NOT NULL COMMENT '职工编号',
  `basisId` int(11) NOT NULL COMMENT '合同类型',
  `use` tinyint(1) NULL DEFAULT 0 COMMENT '0 否 1是',
  `time` date NULL DEFAULT NULL,
  PRIMARY KEY (`contractId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '供应商合同表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_supplier_contract
-- ----------------------------

-- ----------------------------
-- Table structure for kj_supplier_info
-- ----------------------------
DROP TABLE IF EXISTS `kj_supplier_info`;
CREATE TABLE `kj_supplier_info`  (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `provinceId` int(11) NULL DEFAULT NULL COMMENT '省',
  `cityId` int(11) NULL DEFAULT NULL COMMENT '市',
  `areaId` int(11) NULL DEFAULT NULL COMMENT '区',
  `industryId` int(11) NULL DEFAULT NULL COMMENT '行业类型',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '供应商负责人',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '1 潜在客户 2普通客户 3重要客户 4无机会客户',
  `tell` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '电话',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址',
  `settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '结算方式',
  `cycle` tinyint(1) NULL DEFAULT NULL COMMENT '1 一个月 2 三个月 3 六个月 4九个月 5 十二个月 6按照合同周期',
  `startTime` date NULL DEFAULT NULL COMMENT '合同周期-开始时间',
  `endTime` date NULL DEFAULT NULL COMMENT '合同周期-结束时间',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '账号',
  `accountBank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '开户行',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '备注',
  `supplierType` tinyint(1) NULL DEFAULT NULL COMMENT '1 公司 2 个人',
  `userName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户名',
  PRIMARY KEY (`supplierId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '供应商信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_supplier_info
-- ----------------------------

-- ----------------------------
-- Table structure for kj_supplier_record
-- ----------------------------
DROP TABLE IF EXISTS `kj_supplier_record`;
CREATE TABLE `kj_supplier_record`  (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `supplierId` int(11) NULL DEFAULT NULL COMMENT '供应商',
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '职工编号',
  `clientId` int(11) NULL DEFAULT NULL COMMENT '客户编号',
  `count` int(11) NULL DEFAULT NULL COMMENT '数量',
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '职位',
  PRIMARY KEY (`recordId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '供应商发单记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_supplier_record
-- ----------------------------

-- ----------------------------
-- Table structure for kj_sys_admin_group
-- ----------------------------
DROP TABLE IF EXISTS `kj_sys_admin_group`;
CREATE TABLE `kj_sys_admin_group`  (
  `groupId` int(10) NOT NULL AUTO_INCREMENT COMMENT '分组id',
  `parentId` int(10) NULL DEFAULT 0 COMMENT '父分类id',
  `groupName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '分组名称',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建用户',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '更新用户',
  `isValid` tinyint(1) NULL DEFAULT 0,
  `describe` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '描述',
  `secionId` int(11) NULL DEFAULT NULL COMMENT '部门编号',
  `type` tinyint(1) NULL DEFAULT 0,
  `roleType` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`groupId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sys_admin_group
-- ----------------------------
INSERT INTO `kj_sys_admin_group` VALUES (1, 0, '超级管理员', '2020-11-10 10:41:49', '17670627203', '2020-11-10 10:41:49', '17670627203', 0, NULL, NULL, 0, 3);
INSERT INTO `kj_sys_admin_group` VALUES (2, 0, '发货员', '2020-12-17 10:20:29', '17670627203', '2020-12-17 10:20:29', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (3, 0, '123123ww', '2020-08-13 10:50:07', '17670627203', '2020-08-28 14:09:17', '17670627203', 1, '123123', NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (4, 0, 'xwa', '2020-08-12 11:48:13', '18613962842', '2020-08-12 11:48:39', '18613962842', 1, '123456', NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (5, 0, 'sdd', '2020-08-12 11:48:27', '18613962842', '2020-08-12 11:48:34', '18613962842', 1, 'e', NULL, 1, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (6, 0, 'rewr', '2020-08-12 11:52:01', '17670627203', '2020-08-28 14:09:14', '17670627203', 1, 'sdfs', NULL, 1, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (7, 0, 'cs', '2020-08-13 11:04:27', '17670627203', '2020-08-28 14:09:09', '17670627203', 1, 'ffff', NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (8, 0, 'cf', '2020-08-15 11:21:51', '17670627203', '2020-08-15 11:21:57', '17670627203', 1, '', NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (9, 0, 'cf', '2020-08-15 11:22:03', '17670627203', '2020-08-28 14:09:05', '17670627203', 1, '123', NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (10, 0, '仓库管理员', '2020-12-17 10:20:41', '17670627203', '2020-12-17 10:20:41', '17670627203', 0, NULL, NULL, 0, 2);
INSERT INTO `kj_sys_admin_group` VALUES (11, 0, '财务人员', '2020-12-17 10:20:51', '17670627203', '2020-12-17 10:20:51', '17670627203', 0, NULL, NULL, 0, 2);
INSERT INTO `kj_sys_admin_group` VALUES (12, 0, 'eee', '2020-09-17 09:19:23', '17670627203', '2020-09-17 09:19:26', '17670627203', 1, '1', NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (13, 11, '客服', '2020-09-18 14:53:59', '17670627203', '2020-09-18 15:06:05', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (14, 11, '客服部员工', '2020-09-18 16:21:12', '17670627203', '2020-09-18 16:27:13', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (15, 0, '试部门组织', '2020-10-16 10:47:40', '17670627203', '2020-10-16 10:47:40', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (16, 1, '下级部门组织', '2020-09-21 14:33:55', '17670627203', '2020-09-21 14:34:19', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (17, NULL, '新增部门', '2020-09-21 14:35:21', '17670627203', '2020-09-21 14:39:30', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (18, 15, 'nonn', '2020-09-21 14:38:26', '17670627203', '2020-09-21 14:39:42', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (19, 15, '123123', '2020-09-21 14:42:35', '17670627203', '2020-09-21 14:42:40', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (20, 15, 'ces1', '2020-09-21 15:15:28', '17670627203', '2020-09-21 15:15:28', '17670627203', 0, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (21, 0, '岗位更新', '2020-10-16 11:35:16', '17670627203', '2020-11-30 09:56:18', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (22, 15, '一二三', '2020-10-16 11:23:48', '17670627203', '2020-10-16 11:27:56', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (23, 15, 'dfdf', '2020-10-16 11:27:03', '17670627203', '2020-10-16 11:27:51', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (24, 23, 'aaaa', '2020-10-16 11:27:24', '17670627203', '2020-10-16 11:27:46', '17670627203', 1, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (25, 24, 'dddd', '2020-10-16 11:27:31', '17670627203', '2020-10-16 11:27:40', '17670627203', 1, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (26, 21, 'dddf', '2020-10-16 11:36:13', '17670627203', '2020-10-16 11:36:18', '17670627203', 1, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (27, NULL, 'dfgg', '2020-10-16 11:36:03', '17670627203', '2020-10-16 11:36:06', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (28, NULL, 'ces', '2020-10-22 11:48:42', '17670627203', '2020-10-22 11:48:45', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (29, 0, '测试岗位', '2020-11-19 10:59:45', '17670627203', '2020-12-24 14:37:18', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (30, 20, 'sds', '2020-11-03 16:44:28', '17670627203', '2020-12-17 10:20:56', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (31, 31, 'ERP权限', '2020-11-30 10:47:14', '17670627203', '2020-11-30 10:47:14', '17670627203', 0, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (32, 0, 'ERP权限组', '2020-11-30 10:48:17', '17670627203', '2020-11-30 10:48:17', '17670627203', 0, NULL, NULL, 0, 3);
INSERT INTO `kj_sys_admin_group` VALUES (33, 0, 'AAA', '2020-12-04 14:19:16', '17670627203', '2020-12-24 14:37:10', '17670627203', 1, NULL, NULL, 0, 3);
INSERT INTO `kj_sys_admin_group` VALUES (34, 0, '生产', '2021-08-09 14:09:57', '17670627203', '2021-08-09 14:09:57', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (35, 0, 'BBB', '2020-12-15 09:25:19', '17670627203', '2020-12-16 15:03:31', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (36, 34, '装配', '2020-12-23 10:33:07', '17670627203', '2020-12-23 10:33:07', '17670627203', 0, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (37, 34, '数控中心', '2020-12-23 10:33:30', '17670627203', '2020-12-23 10:33:30', '17670627203', 0, NULL, NULL, 0, 0);
INSERT INTO `kj_sys_admin_group` VALUES (38, 34, '数控车', '2020-12-23 10:34:03', '17670627203', '2020-12-23 10:34:03', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (39, 34, '普车', '2020-12-23 10:35:51', '17670627203', '2020-12-23 10:35:51', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (40, 34, '普铣', '2020-12-23 10:36:00', '17670627203', '2020-12-23 10:36:00', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (41, 34, '钳工', '2020-12-23 10:36:07', '17670627203', '2020-12-23 10:36:07', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (42, 34, '锻工', '2020-12-23 10:36:16', '17670627203', '2020-12-23 10:36:16', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (43, 34, '焊工', '2020-12-23 10:36:26', '17670627203', '2020-12-23 10:36:26', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (44, 34, '激光切割', '2020-12-23 10:36:34', '17670627203', '2021-08-14 10:38:43', '15096369446', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (45, 34, '火焰切割', '2020-12-23 10:36:48', '17670627203', '2021-08-14 10:38:40', '15096369446', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (46, 34, '线切割', '2020-12-23 10:36:54', '17670627203', '2021-08-14 10:38:35', '15096369446', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (47, 34, '镀锌', '2021-06-12 14:19:10', '17670627203', '2021-06-12 14:19:10', '15096369446', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (48, 34, '杂工', '2020-12-23 10:37:05', '17670627203', '2020-12-23 10:37:05', '17670627203', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (49, 34, '下料', '2021-08-10 17:09:18', '17670627203', '2021-08-10 17:09:18', '15096369446', 0, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (50, 0, '测试112312', '2020-12-23 11:00:21', '17670627203', '2020-12-24 14:37:06', '17670627203', 1, NULL, NULL, 0, NULL);
INSERT INTO `kj_sys_admin_group` VALUES (51, 34, 'ces11111', '2020-12-25 17:16:10', '17670627203', '2020-12-25 17:16:13', '17670627203', 1, NULL, NULL, 0, 1);
INSERT INTO `kj_sys_admin_group` VALUES (52, NULL, '测试', '2021-09-10 11:54:25', '17670627203', '2021-09-10 11:55:16', '17670627203', 1, NULL, NULL, 0, 1);

-- ----------------------------
-- Table structure for kj_sys_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `kj_sys_admin_menu`;
CREATE TABLE `kj_sys_admin_menu`  (
  `menuId` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `parentId` int(10) NULL DEFAULT NULL COMMENT '父级id',
  `menuLevel` tinyint(2) NOT NULL DEFAULT 1 COMMENT '菜单等级',
  `menuName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '菜单名称',
  `menuUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '菜单Url',
  `menuType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '菜单类型',
  `sort` int(10) NULL DEFAULT NULL COMMENT '排序',
  `btnTitle` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '按钮名称',
  `btnClass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '按钮样式',
  `btnType` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '按钮类型',
  `btnHandle` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '按钮事件',
  `btnHandleParams` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '事件参数',
  `btnIsTable` tinyint(1) NULL DEFAULT NULL COMMENT '是否表格按钮',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建用户',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '更新用户',
  `isValid` tinyint(1) NULL DEFAULT 0,
  `menuIcon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图标',
  `interface` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '接口地址',
  `type` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`menuId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 111 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sys_admin_menu
-- ----------------------------
INSERT INTO `kj_sys_admin_menu` VALUES (1, 0, 1, '人事管理', '/personnelManagement', '1', 0, '', '', '', '', '', 0, '2020-08-06 10:24:55', '18613962842', '2020-08-12 09:45:22', '18613962842', 0, '/oa/cz/20200812/kj_cz_oa08124518.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (2, 5, 1, '行政管理', '/administrativeManagement', '1', 0, '', '', '', '', '', 0, '2020-08-06 17:56:39', '17670627203', '2020-09-01 11:33:11', '17670627203', 1, '/oa/cz/20200814/kj_cz_oa08142848.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (3, 0, 1, '客户管理', '/customerManagement', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:35:00', '18613962842', '2020-08-12 09:42:43', '18613962842', 0, '/oa/cz/20200812/kj_cz_oa08123455.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (4, 5, 1, '人才管理', '/talentManagement', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:35:28', '18613962842', '2020-09-10 10:42:11', '17670627203', 1, '/oa/cz/20200812/kj_cz_oa08123535.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (5, 0, 1, '供应商管理', '/supplierManagement', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:40:33', '18613962842', '2020-11-12 09:27:41', '17670627203', 0, '/oa/cz/20200812/kj_cz_oa08124029.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (6, 0, 1, '物料管理', '/erpManagement', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:41:19', '18613962842', '2020-11-17 16:23:54', '17670627203', 0, '/oa/cz/20200812/kj_cz_oa08124113.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (7, 5, 1, '数据统计', '/statisticsManagement', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:46:12', '18613962842', '2020-09-10 10:42:31', '17670627203', 1, '/oa/cz/20200812/kj_cz_oa08124605.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (8, 0, 1, '系统设置', '/systemSetup', '1', 0, '', '', '', '', '', 0, '2020-08-12 08:48:29', '18613962842', '2020-08-12 10:27:11', '18613962842', 0, '/oa/cz/20200812/kj_cz_oa08124825.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (9, 1, 2, '职工档案', '/personnelManagement/staff', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:28:22', '17670627203', '2020-09-07 09:37:54', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08131109.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (10, 1, 2, '组织管理', '/personnelManagement/organization', '1', 1, '', '', '', '', '', 0, '2020-08-12 09:29:19', '17670627203', '2020-08-13 16:15:26', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08131523.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (11, 5, 2, '权限组管理', '/personnelManagement/permission', '1', 2, '', '', '', '', '', 0, '2020-08-12 09:29:53', '17670627203', '2020-09-01 17:58:48', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08131535.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (12, 5, 2, '后台菜单管理', '/personnelManagement/menu-manager', '1', 3, '', '', '', '', '', 0, '2020-08-12 09:31:59', '17670627203', '2020-09-01 17:59:06', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134619.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (13, 5, 2, '待办事项', '/administrativeManagement/todoList', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:33:40', '17670627203', '2020-09-01 11:31:58', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134712.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (14, 5, 2, '通知管理', '/administrativeManagement/notice', '1', 1, '', '', '', '', '', 0, '2020-08-12 09:34:05', '17670627203', '2020-09-01 11:31:49', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08132026.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (15, 5, 2, '招聘管理', '/administrativeManagement/recruiting', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:42:25', '17670627203', '2020-08-31 15:12:59', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08131956.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (16, 3, 2, '客户管理', '/customerManagement/customer', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:43:21', '17670627203', '2020-08-13 16:30:23', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133021.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (17, 3, 2, '联系人管理', '/customerManagement/contacts', '1', 1, '', '', '', '', '', 0, '2020-08-12 09:43:54', '17670627203', '2020-08-13 16:30:39', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133036.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (18, 3, 2, '拜访记录', '/customerManagement/visitRecord', '1', 2, '', '', '', '', '', 0, '2020-08-12 09:45:51', '17670627203', '2020-11-18 17:36:23', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08133045.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (19, 4, 2, '共享资源', '/talentManagement/shareTalent', '1', 1, '', '', '', '', '', 0, '2020-08-12 09:51:53', '17670627203', '2020-08-13 16:34:12', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133410.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (20, 4, 2, '我的人才', '/talentManagement/talent', '1', 4, '', '', '', '', '', 0, '2020-08-12 09:53:11', '17670627203', '2020-08-31 15:14:11', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133359.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (21, 4, 2, '我的邀约', '/talentManagement/myInvite', '1', 2, '', '', '', '', '', 0, '2020-08-12 09:53:32', '17670627203', '2020-08-13 16:48:22', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134820.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (22, 5, 2, '供应商管理', '/supplierManagement/supplier', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:54:57', '17670627203', '2020-08-13 16:35:14', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133512.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (23, 6, 2, '库存查询', '/erpManagement/stock', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:58:04', '17670627203', '2020-08-13 16:39:05', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133902.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (24, 5, 3, '进出库存', '/erpManagement/iandeBank', '1', 0, '', '', '', '', '', 0, '2020-08-12 09:58:31', '18613962842', '2020-08-12 09:58:51', '18613962842', 1, '', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (25, 6, 2, '进出库存管理', '/erpManagement/iandeBank', '1', 2, '', '', '', '', '', 0, '2020-08-12 10:05:12', '17670627203', '2020-08-13 16:39:20', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133917.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (26, 6, 2, '进出库存查询', '/erpManagement/iandeBankSearch', '1', 3, '', '', '', '', '', 0, '2020-08-12 10:16:56', '17670627203', '2020-08-13 16:39:34', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08133931.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (27, 6, 2, '库存变动表', '/erpManagement/stockChange', '1', 4, '', '', '', '', '', 0, '2020-08-12 10:18:16', '17670627203', '2020-08-13 16:40:26', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134024.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (28, 6, 2, '物品管理', '/erpManagement/goods', '1', 5, '', '', '', '', '', 0, '2020-08-12 10:18:42', '17670627203', '2020-11-19 16:32:06', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134044.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (29, 6, 2, '物料管理', '/product/materiel', '1', 6, '', '', '', '', '', 0, '2020-08-12 10:24:00', '17670627203', '2020-11-17 16:24:45', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134102.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (30, 7, 2, '数据统计', '/statisticsManagement/statistics', '1', 0, '', '', '', '', '', 0, '2020-08-12 10:26:47', '17670627203', '2020-08-13 16:41:41', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134139.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (31, 8, 2, '基础数据', '/systemSetup/baseData', '1', 0, '', '', '', '', '', 0, '2020-08-12 10:27:27', '17670627203', '2020-08-13 16:44:44', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134442.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (32, 8, 2, '岗位管理', '/systemSetup/postManage', '1', 1, '', '', '', '', '', 0, '2020-08-12 10:27:55', '17670627203', '2020-08-13 16:44:58', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134456.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (33, 8, 2, '行业管理', '/systemSetup/industryManage', '1', 0, '', '', '', '', '', 0, '2020-08-12 10:28:25', '17670627203', '2020-08-13 16:50:05', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08135003.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (34, 8, 2, '地区管理', '/systemSetup/areaManage', '1', 0, '', '', '', '', '', 0, '2020-08-12 10:28:45', '17670627203', '2020-08-13 16:44:14', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134412.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (35, 5, 2, '系统设置', '/systemSetup/system', '1', 0, '', '', '', '', '', 0, '2020-08-12 10:29:10', '17670627203', '2020-09-10 11:39:23', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134345.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (36, 5, 2, '小程序权限组管理', '/personnelManagement/permissionMini', '1', 4, '', '', '', '', '', 0, '2020-08-12 11:15:53', '17670627203', '2020-08-13 11:03:50', '17670627203', 1, '', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (37, 5, 2, '小程序菜单管理', '/personnelManagement/menu-manager-mini', '1', 5, '', '', '', '', '', 0, '2020-08-12 11:16:17', '17670627203', '2020-09-01 17:58:57', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08131557.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (38, 2, 2, '报名管理', '/administrativeManagement/enroll', '1', 4, '', '', '', '', '', 0, '2020-08-12 16:50:44', '17670627203', '2020-08-13 16:20:37', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132035.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (39, 5, 1, '首页', '1', '1', 0, '', '', '', '', '', 0, '2020-08-13 10:28:58', '17670627203', '2020-08-13 10:32:37', '17670627203', 1, '', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (40, 5, 1, '反对反对', '78', '1', 0, '', '', '', '', '', 0, '2020-08-13 10:30:00', '17670627203', '2020-08-13 10:32:44', '17670627203', 1, '', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (46, 0, 1, '首页', 'pages/index/index', '1', 0, '', '', '', '', '', 0, '2020-08-13 14:48:13', '17670627203', '2020-08-13 15:28:19', '17670627203', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (47, 46, 2, '业务管理', '/pages/index/index', '1', 0, '', '', '', '', '', 0, '2020-08-13 14:48:32', '17670627203', '2020-08-13 14:48:32', '17670627203', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (48, 47, 3, '共享资源', '/pages/sharePersonnel/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 14:48:49', '17670627203', '2020-08-13 16:07:01', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134847.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (49, 47, 3, '客户管理', '/pages/customer/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 14:49:10', '17670627203', '2020-08-13 16:06:13', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134904.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (50, 47, 3, '供应商管理', '/pages/supplier/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 14:49:50', '17670627203', '2020-08-13 16:06:27', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08134948.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (51, 47, 3, '通知', '/pages/notice/noticeList', '1', 0, '', '', '', '', '', 0, '2020-08-13 15:55:52', '17670627203', '2020-08-13 16:06:41', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08135550.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (52, 46, 2, '人事管理', '/pages/index/index', '1', 0, '', '', '', '', '', 0, '2020-08-13 15:56:12', '17670627203', '2020-08-13 15:56:12', '17670627203', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (53, 52, 3, '职工档案', '/pages/workers/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:04:26', '17670627203', '2020-08-13 16:07:28', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08130423.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (54, 52, 3, '通讯录', '/pages/contacts/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:04:51', '17670627203', '2020-08-13 16:07:44', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08130449.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (55, 52, 3, '待办事项', '/pages/backlog/backlog', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:05:24', '17670627203', '2020-08-13 16:07:59', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08130521.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (56, 0, 1, '新建', 'pages/newlyBuild/index', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:14:09', '17670627203', '2020-08-13 16:18:41', '17670627203', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (57, 56, 2, '新建人才', '/pages/personnel/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:15:00', '17670627203', '2020-08-13 16:15:00', '17670627203', 0, '', '才', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (58, 56, 2, '新建客户', '/pages/customer/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:15:23', '17670627203', '2020-08-13 16:15:23', '17670627203', 0, '', '客', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (59, 56, 2, '联系人', '/pages/contacts/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:15:45', '17670627203', '2020-08-13 16:15:45', '17670627203', 0, '', '联', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (60, 56, 2, '供应商', '/pages/supplier/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:16:12', '17670627203', '2020-08-13 16:16:12', '17670627203', 0, '', '供', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (61, 56, 2, '新建职工', '/pages/workers/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:16:36', '17670627203', '2020-08-13 16:16:36', '17670627203', 0, '', '职', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (62, 56, 2, '跟进记录', '/pages/follow/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:17:00', '17670627203', '2020-08-13 16:17:00', '17670627203', 0, '', '跟', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (63, 56, 2, '新建通知', '/pages/notice/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:17:30', '17670627203', '2020-08-13 16:17:30', '17670627203', 0, '', '公', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (64, 56, 2, '新建招聘', '/pages/recruit/add', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:17:50', '17670627203', '2020-08-13 16:17:50', '17670627203', 0, '', '招', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (65, 0, 1, '我的', 'pages/mine/mine', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:18:58', '17670627203', '2020-08-13 16:18:58', '17670627203', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (66, 65, 2, '我的人才', '/pages/personnel/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:19:29', '17670627203', '2020-08-13 16:19:29', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08131927.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (67, 65, 2, '我的项目', '/pages/customer/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:19:54', '17670627203', '2020-08-13 16:19:54', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08131953.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (68, 65, 2, '我的邀约', '/pages/invitation/invitationList', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:20:20', '17670627203', '2020-08-13 16:20:20', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132017.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (69, 65, 2, '我的通知', '/pages/notice/noticeList', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:20:49', '17670627203', '2020-08-13 16:20:49', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132047.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (70, 65, 2, '我的供应商', '/pages/supplier/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:21:14', '17670627203', '2020-08-13 16:21:14', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132113.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (71, 65, 2, '我的招聘', '/pages/recruit/list', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:21:36', '17670627203', '2020-08-13 16:21:36', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132133.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (72, 65, 2, '我的邀请码', '/pages/mine/qrcode', '1', 0, '', '', '', '', '', 0, '2020-08-13 16:22:12', '17670627203', '2020-08-13 16:22:12', '17670627203', 0, '/oa/cz/20200813/kj_cz_oa08132209.png', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (73, 0, 1, '特殊权限', 'power', '1', 0, '', '', '', '', '', 0, '2020-08-29 15:23:27', '', '2020-08-29 15:23:27', '', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (74, 73, 2, '面试结果操作', 'interview', '1', 0, '', '', '', '', '', 0, '2020-08-29 15:24:23', '', '2020-08-29 15:24:23', '', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (75, 73, 2, '入职', 'entry', '1', 0, '', '', '', '', '', 0, '2020-08-29 15:24:40', '', '2020-08-29 15:24:40', '', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (76, 73, 2, '离职', 'quit', '1', 0, '', '', '', '', '', 0, '2020-08-29 15:24:57', '', '2020-08-29 15:24:57', '', 0, '', '', 1);
INSERT INTO `kj_sys_admin_menu` VALUES (77, 4, 2, '招聘管理', '/administrativeManagement/recruiting', '1', 0, '', '', '', '', '', 0, '2020-08-31 15:11:56', '17670627203', '2020-08-31 15:11:56', '17670627203', 0, '/oa/cz/20200831/kj_cz_oa08311146.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (78, 3, 2, '项目管理', '/customerManagement/project', '1', -2, '', '', '', '', '', 0, '2020-08-31 15:33:33', '17670627203', '2020-11-18 17:36:29', '17670627203', 1, '/oa/cz/20200902/kj_cz_oa09023411.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (79, 5, 2, '客户人才', '/talentManagement/talentCustomer', '1', 0, '', '', '', '', '', 0, '2020-08-31 17:31:36', '17670627203', '2020-08-31 17:41:53', '17670627203', 1, '', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (80, 5, 2, '客户人才', '/talentCustomer/talentCustomer', '1', 0, '', '', '', '', '', 0, '2020-08-31 17:43:15', '17670627203', '2020-08-31 17:45:17', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08133021.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (81, 5, 2, '客户人才', '/talentManagement/talentCustomer', '1', 0, '', '', '', '', '', 0, '2020-08-31 18:08:08', '17670627203', '2020-08-31 18:12:47', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08133021.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (82, 5, 1, '公告管理', '/noticeManagement', '1', 0, '', '', '', '', '', 0, '2020-09-01 11:29:53', '17670627203', '2020-09-10 10:42:37', '17670627203', 1, '/oa/cz/20200901/kj_cz_oa09013546.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (83, 82, 2, '公告管理', '/noticeManagement/notice', '1', 0, '', '', '', '', '', 0, '2020-09-01 11:30:42', '17670627203', '2020-09-01 11:59:42', '17670627203', 0, '/oa/cz/20200901/kj_cz_oa09013036.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (84, 5, 1, '待办事项', '/todoManagement', '1', 0, '', '', '', '', '', 0, '2020-09-01 11:31:16', '17670627203', '2020-09-10 10:15:12', '17670627203', 1, '/oa/cz/20200901/kj_cz_oa09013635.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (85, 84, 2, '待办事项', '/todoManagement/todoList', '1', 0, '', '', '', '', '', 0, '2020-09-01 11:31:35', '17670627203', '2020-09-01 14:57:06', '17670627203', 0, '/oa/cz/20200901/kj_cz_oa09013130.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (86, 4, 2, '报名管理', '/administrativeManagement/enroll', '1', 0, '', '', '', '', '', 0, '2020-09-01 11:32:57', '17670627203', '2020-09-01 11:32:57', '17670627203', 0, '/oa/cz/20200901/kj_cz_oa09013248.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (87, 8, 2, '权限组管理', '/personnelManagement/permission', '1', 0, '', '', '', '', '', 0, '2020-09-01 17:46:34', '17670627203', '2020-11-19 11:02:55', '17670627203', 1, '/oa/cz/20200901/kj_cz_oa09014627.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (88, 8, 2, '后台菜单管理', '/personnelManagement/menu-manager', '1', 0, '', '', '', '', '', 0, '2020-09-01 17:57:17', '17670627203', '2020-09-01 17:57:17', '17670627203', 0, '/oa/cz/20200901/kj_cz_oa09015713.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (89, 5, 2, '小程序菜单管理', '/personnelManagement/menu-manager-mini', '1', 0, '', '', '', '', '', 0, '2020-09-01 17:57:53', '17670627203', '2020-09-10 11:38:56', '17670627203', 1, '/oa/cz/20200901/kj_cz_oa09015749.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (90, 5, 2, '查看人才', '/customerManagement/talentCustomer', '1', 0, '', '', '', '', '', 0, '2020-09-02 10:04:06', '17670627203', '2020-09-02 10:34:38', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08133045.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (91, 5, 2, '收支类别', '/systemSetup/income', '1', 0, '', '', '', '', '', 0, '2020-09-15 16:33:30', '17670627203', '2020-09-16 15:50:16', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134456.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (92, 5, 2, '收支账户', '/systemSetup/account', '1', 0, '', '', '', '', '', 0, '2020-09-15 16:34:01', '17670627203', '2020-09-16 15:50:22', '17670627203', 1, '/oa/cz/20200813/kj_cz_oa08134456.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (93, 0, 1, '财务管理', '/financeManagement', '1', 0, '', '', '', '', '', 0, '2020-09-16 10:20:05', '17670627203', '2020-11-30 17:49:52', '17670627203', 0, '/kj/erp20201130/kj_erp11304950.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (94, 5, 1, '统计报表', '/financeManagement/statistics', '1', 0, '', '', '', '', '', 0, '2020-09-16 10:20:37', '17670627203', '2020-09-16 10:30:08', '17670627203', 1, '/oa/cz/20200812/kj_cz_oa08124825.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (95, 93, 2, '财务报表', '/financeManagement/index', '1', 2, '', '', '', '', '', 0, '2020-09-16 10:21:47', '17670627203', '2020-11-30 17:58:20', '17670627203', 0, '/kj/erp20201130/kj_erp11305817.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (96, 93, 2, '收支类别', '/financeManagement/income', '1', 2, '', '', '', '', '', 0, '2020-09-16 15:45:32', '17670627203', '2020-11-30 17:58:32', '17670627203', 0, '/kj/erp20201130/kj_erp11305830.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (97, 93, 2, '收支账户', '/financeManagement/account', '1', 2, '', '', '', '', '', 0, '2020-09-16 15:45:49', '17670627203', '2020-11-30 17:58:40', '17670627203', 0, '/kj/erp20201130/kj_erp11305838.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (98, 0, 1, '产品管理', '/product/index', '1', 0, '', '', '', '', '', 0, '2020-11-12 11:29:52', '17670627203', '2020-11-30 17:56:46', '17670627203', 0, '/kj/erp20201130/kj_erp11305643.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (99, 98, 2, '产品管理', '/product/index', '1', 0, '', '', '', '', '', 0, '2020-11-12 11:30:14', '17670627203', '2020-11-30 17:55:17', '17670627203', 0, '/kj/erp20201130/kj_erp11305514.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (100, 98, 2, '进出库存管理', '/erpManagement/iandeBank?goodsType=1', '1', 0, '', '', '', '', '', 0, '2020-11-12 11:30:22', '17670627203', '2020-11-30 17:55:32', '17670627203', 0, '/kj/erp20201130/kj_erp11305529.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (101, 98, 2, '进出库查询', '/erpManagement/iandeBankSearch?goodsType=1', '1', 0, '', '', '', '', '', 0, '2020-11-12 11:30:32', '17670627203', '2020-11-30 17:55:42', '17670627203', 0, '/kj/erp20201130/kj_erp11305540.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (102, 98, 2, '库存变动表', '/erpManagement/stockChange?goodsType=1', '1', 0, '', '', '', '', '', 0, '2020-11-18 10:17:27', '17670627203', '2020-11-30 17:55:52', '17670627203', 0, '/kj/erp20201130/kj_erp11305550.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (103, 98, 2, '库存查询', '/erpManagement/stock?goodsType=1', '1', 0, '', '', '', '', '', 0, '2020-11-18 10:20:02', '17670627203', '2020-11-30 17:56:01', '17670627203', 0, '/kj/erp20201130/kj_erp11305559.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (104, 0, 1, '订单管理', '/order', '1', 0, '', '', '', '', '', 0, '2020-11-19 09:29:43', '17670627203', '2020-12-26 14:23:40', '17670627203', 0, '/kj/erp20201130/kj_erp11304820.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (105, 104, 2, '订单查询', '/order/index', '1', 0, '', '', '', '', '', 0, '2020-11-19 09:30:02', '17670627203', '2020-11-30 17:52:28', '17670627203', 0, '/kj/erp20201130/kj_erp11305223.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (106, 104, 2, '发货管理', '/order/manage', '1', 0, '', '', '', '', '', 0, '2020-11-19 09:30:24', '17670627203', '2020-11-30 17:52:43', '17670627203', 0, '/kj/erp20201130/kj_erp11305241.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (107, 8, 2, '打印模板', '/systemSetup/printTemplate', '1', 0, '', '', '', '', '', 0, '2020-11-27 14:26:24', '17670627204', '2020-11-30 17:59:16', '17670627203', 0, '/kj/erp20201130/kj_erp11305915.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (108, 93, 2, '订单收支', '/financeManagement/order', '1', 0, '', '', '', '', '', 0, '2020-12-10 14:09:34', '17670627203', '2020-12-11 11:34:17', '17670627203', 0, '/kj/erp20201211/kj_erp12113413.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (109, 0, 1, '工单统计', '/workOrder', '1', 0, '', '', '', '', '', 0, '2021-08-09 11:04:21', '17670627203', '2021-08-09 11:05:50', '17670627203', 0, '/kj/erp20210809/kj_erp08090547.png', '', 0);
INSERT INTO `kj_sys_admin_menu` VALUES (110, 109, 2, '工单统计', '/workOrder/index', '1', 0, '', '', '', '', '', 0, '2021-08-09 11:06:07', '17670627203', '2021-08-09 11:06:07', '17670627203', 0, '/kj/erp20210809/kj_erp08090547.png', '', 0);

-- ----------------------------
-- Table structure for kj_sys_admin_power
-- ----------------------------
DROP TABLE IF EXISTS `kj_sys_admin_power`;
CREATE TABLE `kj_sys_admin_power`  (
  `powerId` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `groupId` int(10) NOT NULL COMMENT '用户组id',
  `menuId` int(10) NOT NULL COMMENT '菜单id',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '创建用户',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '更新用户',
  `isValid` tinyint(1) NULL DEFAULT 0,
  `type` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`powerId`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1447 CHARACTER SET = utf8 CHECKSUM = 1 COLLATE = utf8_general_ci DELAY_KEY_WRITE = 1 ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of kj_sys_admin_power
-- ----------------------------
INSERT INTO `kj_sys_admin_power` VALUES (1041, 1, 1, '2020-08-06 10:24:55', '18613962842', '2020-08-06 10:24:55', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1042, 1, 2, '2020-08-06 17:56:39', '18613962842', '2020-08-06 17:56:39', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1043, 1, 3, '2020-08-12 08:35:00', '18613962842', '2020-08-12 08:35:00', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1044, 1, 4, '2020-08-12 08:35:28', '18613962842', '2020-08-12 08:35:28', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1045, 1, 5, '2020-08-12 08:40:33', '18613962842', '2020-12-10 10:23:08', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1046, 1, 6, '2020-08-12 08:41:19', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1047, 1, 7, '2020-08-12 08:46:12', '18613962842', '2020-08-12 08:46:12', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1048, 1, 8, '2020-08-12 08:48:29', '18613962842', '2020-09-01 09:17:57', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1049, 1, 9, '2020-08-12 09:28:22', '18613962842', '2020-08-12 09:28:22', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1050, 1, 10, '2020-08-12 09:29:19', '18613962842', '2020-12-08 15:31:14', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1051, 1, 11, '2020-08-12 09:29:53', '18613962842', '2020-08-12 09:29:53', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1052, 1, 12, '2020-08-12 09:31:59', '18613962842', '2020-08-12 09:31:59', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1053, 1, 13, '2020-08-12 09:33:40', '18613962842', '2020-08-12 09:33:40', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1054, 1, 14, '2020-08-12 09:34:05', '18613962842', '2020-08-12 09:34:05', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1055, 1, 15, '2020-08-12 09:42:25', '18613962842', '2020-08-12 09:42:25', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1056, 1, 16, '2020-08-12 09:43:21', '18613962842', '2020-08-12 09:43:21', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1057, 1, 17, '2020-08-12 09:43:54', '18613962842', '2020-08-12 09:43:54', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1058, 1, 18, '2020-08-12 09:45:51', '18613962842', '2020-08-12 09:45:51', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1059, 1, 19, '2020-08-12 09:51:53', '18613962842', '2020-08-12 09:51:53', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1060, 1, 20, '2020-08-12 09:53:11', '18613962842', '2020-08-12 09:53:11', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1061, 1, 21, '2020-08-12 09:53:32', '18613962842', '2020-08-12 09:53:32', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1062, 1, 22, '2020-08-12 09:54:57', '18613962842', '2020-12-10 10:23:08', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1063, 1, 23, '2020-08-12 09:58:04', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1064, 1, 24, '2020-08-12 09:58:31', '18613962842', '2020-08-12 09:58:31', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1065, 1, 25, '2020-08-12 10:05:12', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1066, 1, 26, '2020-08-12 10:16:56', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1067, 1, 27, '2020-08-12 10:18:16', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1068, 1, 28, '2020-08-12 10:18:42', '18613962842', '2020-11-13 17:24:18', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1069, 1, 29, '2020-08-12 10:24:00', '18613962842', '2020-11-13 17:24:18', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1070, 1, 30, '2020-08-12 10:26:47', '18613962842', '2020-08-12 10:26:47', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1071, 1, 31, '2020-08-12 10:27:27', '18613962842', '2020-09-01 09:17:57', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1072, 1, 32, '2020-08-12 10:27:55', '18613962842', '2020-09-01 09:17:57', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1073, 1, 33, '2020-08-12 10:28:25', '18613962842', '2020-09-01 09:17:57', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1074, 1, 34, '2020-08-12 10:28:45', '18613962842', '2020-09-01 09:17:57', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1075, 1, 35, '2020-08-12 10:29:10', '18613962842', '2020-09-01 09:17:57', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1076, 1, 36, '2020-08-12 11:15:53', '18613962842', '2020-08-12 11:15:53', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1077, 1, 37, '2020-08-12 11:16:17', '18613962842', '2020-08-12 11:16:17', '18613962842', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1078, 3, 1, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1079, 3, 37, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1080, 3, 36, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1081, 3, 12, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1082, 3, 11, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1083, 3, 10, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1084, 3, 9, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1085, 3, 2, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1086, 3, 14, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1087, 3, 15, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1088, 3, 13, '2020-08-12 11:49:06', '18613962842', '2020-08-12 11:49:06', '18613962842', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1089, 1, 38, '2020-08-12 16:50:44', '17670627203', '2020-08-12 16:50:44', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1090, 1, 39, '2020-08-13 10:28:58', '17670627203', '2020-08-13 10:28:58', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1091, 1, 40, '2020-08-13 10:30:00', '17670627203', '2020-08-13 10:30:00', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1092, 1, 41, '2020-08-13 10:32:56', '17670627203', '2020-08-13 10:32:56', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1093, 1, 42, '2020-08-13 10:43:01', '17670627203', '2020-08-13 10:43:01', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1094, 6, 41, '2020-08-13 10:43:11', '17670627203', '2020-08-13 10:53:51', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1095, 6, 42, '2020-08-13 10:43:11', '17670627203', '2020-08-13 10:53:20', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1096, 6, 1, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1097, 6, 37, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1098, 6, 36, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1099, 6, 12, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1100, 6, 11, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1101, 6, 10, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1102, 6, 9, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1103, 6, 2, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1104, 6, 38, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1105, 6, 14, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1106, 6, 15, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1107, 6, 13, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1108, 6, 4, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1109, 6, 21, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1110, 6, 19, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1111, 6, 20, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1112, 6, 6, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1113, 6, 29, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1114, 6, 28, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1115, 6, 27, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1116, 6, 26, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1117, 6, 25, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1118, 6, 23, '2020-08-13 10:50:26', '17670627203', '2020-08-13 10:50:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1119, 6, 8, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1120, 6, 32, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1121, 6, 35, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1122, 6, 34, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1123, 6, 33, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1124, 6, 31, '2020-08-13 10:54:14', '17670627203', '2020-08-13 11:03:13', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1125, 6, 41, '2020-08-13 11:03:20', '17670627203', '2020-08-13 11:03:20', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1126, 6, 42, '2020-08-13 11:03:20', '17670627203', '2020-08-13 11:03:20', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1127, 7, 2, '2020-08-13 11:04:40', '17670627203', '2020-08-13 11:04:40', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1128, 7, 38, '2020-08-13 11:04:40', '17670627203', '2020-08-13 11:04:40', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1129, 7, 14, '2020-08-13 11:04:40', '17670627203', '2020-08-13 11:04:40', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1130, 7, 15, '2020-08-13 11:04:40', '17670627203', '2020-08-13 11:04:40', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1131, 7, 13, '2020-08-13 11:04:40', '17670627203', '2020-08-13 11:04:40', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1132, 7, 41, '2020-08-13 11:04:56', '17670627203', '2020-08-13 11:04:56', '17670627203', 1, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1133, 1, 43, '2020-08-13 14:29:32', '17670627203', '2020-08-13 14:29:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1134, 1, 44, '2020-08-13 14:43:20', '17670627203', '2020-08-13 14:43:20', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1135, 1, 45, '2020-08-13 14:43:44', '17670627203', '2020-08-13 14:43:44', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1136, 1, 46, '2020-08-13 14:48:13', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1137, 1, 47, '2020-08-13 14:48:32', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1138, 1, 48, '2020-08-13 14:48:49', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1139, 1, 49, '2020-08-13 14:49:10', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1140, 1, 50, '2020-08-13 14:49:50', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1141, 1, 46, '2020-08-13 14:50:04', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1142, 1, 47, '2020-08-13 14:50:04', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1143, 1, 48, '2020-08-13 14:50:04', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1144, 1, 49, '2020-08-13 14:50:04', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1145, 1, 50, '2020-08-13 14:50:04', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1146, 1, 51, '2020-08-13 15:55:52', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1147, 1, 52, '2020-08-13 15:56:12', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1148, 1, 53, '2020-08-13 16:04:26', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1149, 1, 54, '2020-08-13 16:04:51', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1150, 1, 55, '2020-08-13 16:05:24', '17670627203', '2020-08-13 17:59:04', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1151, 1, 56, '2020-08-13 16:14:09', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1152, 1, 57, '2020-08-13 16:15:00', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1153, 1, 58, '2020-08-13 16:15:23', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1154, 1, 59, '2020-08-13 16:15:45', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1155, 1, 60, '2020-08-13 16:16:12', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1156, 1, 61, '2020-08-13 16:16:36', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1157, 1, 62, '2020-08-13 16:17:00', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1158, 1, 63, '2020-08-13 16:17:30', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1159, 1, 64, '2020-08-13 16:17:50', '17670627203', '2020-09-07 17:43:39', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1160, 1, 65, '2020-08-13 16:18:58', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1161, 1, 66, '2020-08-13 16:19:29', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1162, 1, 67, '2020-08-13 16:19:54', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1163, 1, 68, '2020-08-13 16:20:20', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1164, 1, 69, '2020-08-13 16:20:49', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1165, 1, 70, '2020-08-13 16:21:14', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1166, 1, 71, '2020-08-13 16:21:36', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1167, 1, 72, '2020-08-13 16:22:12', '17670627203', '2020-09-07 17:44:00', '管理员', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1168, 1, 56, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1169, 1, 57, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1170, 1, 58, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1171, 1, 59, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1172, 1, 60, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1173, 1, 61, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1174, 1, 62, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1175, 1, 63, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1176, 1, 64, '2020-08-13 17:19:38', '17670627203', '2020-09-07 17:43:39', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1177, 1, 51, '2020-08-13 17:40:50', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1178, 1, 52, '2020-08-13 17:40:50', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1179, 1, 53, '2020-08-13 17:40:50', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1180, 1, 54, '2020-08-13 17:40:50', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1181, 1, 55, '2020-08-13 17:40:50', '17670627203', '2020-08-13 17:59:04', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1182, 1, 65, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1183, 1, 66, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1184, 1, 67, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1185, 1, 68, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1186, 1, 69, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1187, 1, 70, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1188, 1, 71, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1189, 1, 72, '2020-08-13 17:42:19', '17670627203', '2020-09-07 17:44:00', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1190, 7, 46, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1191, 7, 47, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1192, 7, 48, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1193, 7, 49, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1194, 7, 50, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1195, 7, 51, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1196, 7, 52, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1197, 7, 53, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1198, 7, 54, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1199, 7, 55, '2020-08-13 17:58:54', '18613962842', '2020-08-13 17:58:54', '18613962842', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1200, 2, 46, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1201, 2, 47, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1202, 2, 48, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1203, 2, 49, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1204, 2, 50, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1205, 2, 51, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1206, 2, 52, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1207, 2, 53, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1208, 2, 54, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1209, 2, 55, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1210, 2, 56, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1211, 2, 57, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1212, 2, 58, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1213, 2, 59, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1214, 2, 60, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1215, 2, 61, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1216, 2, 62, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1217, 2, 63, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1218, 2, 64, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1219, 2, 65, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1220, 2, 66, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1221, 2, 67, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1222, 2, 68, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1223, 2, 69, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1224, 2, 70, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1225, 2, 71, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1226, 2, 72, '2020-08-14 09:41:57', '17670627203', '2020-08-14 09:41:57', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1227, 2, 1, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1228, 2, 9, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1229, 2, 10, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1230, 2, 11, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1231, 2, 12, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1232, 2, 37, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1233, 2, 2, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1234, 2, 13, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1235, 2, 15, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1236, 2, 14, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1237, 2, 38, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1238, 2, 3, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1239, 2, 16, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1240, 2, 17, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1241, 2, 18, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1242, 2, 4, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1243, 2, 20, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1244, 2, 19, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1245, 2, 21, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1246, 2, 5, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1247, 2, 22, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1248, 2, 6, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1249, 2, 23, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1250, 2, 25, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1251, 2, 26, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1252, 2, 27, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1253, 2, 28, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1254, 2, 29, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1255, 2, 7, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1256, 2, 30, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1257, 2, 8, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1258, 2, 31, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1259, 2, 33, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1260, 2, 34, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1261, 2, 35, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1262, 2, 32, '2020-08-15 11:16:04', '17670627203', '2020-08-15 11:16:04', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1263, 10, 1, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1264, 10, 9, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1265, 10, 10, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1266, 10, 11, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1267, 10, 12, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1268, 10, 37, '2020-08-21 09:15:32', '17670627203', '2020-08-21 09:15:32', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1269, 10, 46, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1270, 10, 47, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1271, 10, 48, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1272, 10, 49, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1273, 10, 50, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1274, 10, 51, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1275, 10, 52, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1276, 10, 53, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1277, 10, 54, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1278, 10, 55, '2020-08-21 09:15:41', '17670627203', '2020-08-21 09:15:41', '17670627203', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1279, 11, 1, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1280, 11, 9, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1281, 11, 10, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1282, 11, 11, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1283, 11, 12, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1284, 11, 37, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1285, 11, 2, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1286, 11, 13, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1287, 11, 15, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1288, 11, 14, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1289, 11, 38, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1290, 11, 3, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1291, 11, 16, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1292, 11, 17, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1293, 11, 18, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1294, 11, 4, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1295, 11, 20, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1296, 11, 19, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1297, 11, 21, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1298, 11, 5, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1299, 11, 22, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1300, 11, 6, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1301, 11, 23, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1302, 11, 25, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1303, 11, 26, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1304, 11, 27, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1305, 11, 28, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1306, 11, 29, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1307, 11, 7, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1308, 11, 30, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1309, 11, 8, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1310, 11, 31, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1311, 11, 33, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1312, 11, 34, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1313, 11, 35, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1314, 11, 32, '2020-08-28 14:27:14', '17670627203', '2020-08-28 14:27:14', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1315, 1, 73, '2020-08-29 15:23:27', '', '2020-08-29 15:23:27', '', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1316, 1, 74, '2020-08-29 15:24:23', '', '2020-08-29 15:24:23', '', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1317, 1, 75, '2020-08-29 15:24:40', '', '2020-08-29 15:24:40', '', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1318, 1, 76, '2020-08-29 15:24:57', '', '2020-08-29 15:24:57', '', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1319, 1, 73, '2020-08-29 15:29:11', '13786300877', '2020-08-29 15:29:11', '13786300877', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1320, 1, 74, '2020-08-29 15:29:11', '13786300877', '2020-08-29 15:29:11', '13786300877', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1321, 1, 75, '2020-08-29 15:29:11', '13786300877', '2020-08-29 15:29:11', '13786300877', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1322, 1, 76, '2020-08-29 15:29:11', '13786300877', '2020-08-29 15:29:11', '13786300877', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1323, 2, 73, '2020-08-29 15:29:26', '13786300877', '2020-08-29 16:19:53', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1324, 2, 74, '2020-08-29 15:29:26', '13786300877', '2020-08-29 16:19:53', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1325, 2, 75, '2020-08-29 15:29:26', '13786300877', '2020-08-29 16:21:13', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1326, 2, 76, '2020-08-29 15:29:26', '13786300877', '2020-08-31 09:43:37', '管理员', 0, 1);
INSERT INTO `kj_sys_admin_power` VALUES (1327, 1, 77, '2020-08-31 15:11:56', '17670627203', '2020-08-31 15:11:56', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1328, 1, 78, '2020-08-31 15:33:33', '17670627203', '2020-08-31 15:33:33', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1329, 1, 79, '2020-08-31 17:31:36', '17670627203', '2020-08-31 17:31:36', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1330, 1, 80, '2020-08-31 17:43:15', '17670627203', '2020-08-31 17:43:15', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1331, 1, 81, '2020-08-31 18:08:08', '17670627203', '2020-08-31 18:08:08', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1332, 1, 82, '2020-09-01 11:29:53', '17670627203', '2020-09-01 11:29:53', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1333, 1, 83, '2020-09-01 11:30:42', '17670627203', '2020-09-01 11:30:42', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1334, 1, 84, '2020-09-01 11:31:16', '17670627203', '2020-09-01 11:31:16', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1335, 1, 85, '2020-09-01 11:31:35', '17670627203', '2020-09-01 11:31:35', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1336, 1, 86, '2020-09-01 11:32:57', '17670627203', '2020-09-01 11:32:57', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1337, 1, 87, '2020-09-01 17:46:34', '17670627203', '2020-09-01 17:46:34', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1338, 1, 88, '2020-09-01 17:57:17', '17670627203', '2020-09-01 17:57:17', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1339, 1, 89, '2020-09-01 17:57:53', '17670627203', '2020-09-01 17:57:53', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1340, 1, 90, '2020-09-02 10:04:06', '17670627203', '2020-09-02 10:04:06', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1341, 11, 90, '2020-09-02 10:05:26', '17670627203', '2020-09-02 10:05:26', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1342, 2, 90, '2020-09-02 10:05:34', '17670627203', '2020-09-02 10:05:34', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1343, 11, 78, '2020-09-02 16:14:12', '17670627203', '2020-09-02 16:14:12', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1344, 1, 91, '2020-09-15 16:33:30', '17670627203', '2020-09-15 16:33:30', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1345, 1, 92, '2020-09-15 16:34:01', '17670627203', '2020-09-15 16:34:01', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1346, 1, 93, '2020-09-16 10:20:05', '17670627203', '2020-09-16 10:20:05', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1347, 1, 94, '2020-09-16 10:20:37', '17670627203', '2020-09-16 10:20:37', '17670627203', 1, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1348, 1, 95, '2020-09-16 10:21:47', '17670627203', '2020-09-16 10:21:47', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1349, 1, 96, '2020-09-16 15:45:32', '17670627203', '2020-09-16 15:45:32', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1350, 1, 97, '2020-09-16 15:45:49', '17670627203', '2020-09-16 15:45:49', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1351, 1, 98, '2020-11-12 11:29:52', '17670627203', '2020-11-12 11:29:52', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1352, 1, 99, '2020-11-12 11:30:14', '17670627203', '2020-11-12 11:30:14', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1353, 1, 100, '2020-11-12 11:30:22', '17670627203', '2020-11-12 11:30:22', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1354, 1, 101, '2020-11-12 11:30:32', '17670627203', '2020-11-12 11:30:32', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1355, 1, 102, '2020-11-18 10:17:27', '17670627203', '2020-11-18 10:17:27', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1356, 1, 103, '2020-11-18 10:20:02', '17670627203', '2020-11-18 10:20:02', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1357, 1, 104, '2020-11-19 09:29:43', '17670627203', '2020-11-19 09:29:43', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1358, 1, 105, '2020-11-19 09:30:02', '17670627203', '2020-11-19 09:30:02', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1359, 1, 106, '2020-11-19 09:30:24', '17670627203', '2020-11-19 09:30:24', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1360, 29, 1, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1361, 29, 9, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1362, 29, 10, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1363, 29, 3, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1364, 29, 16, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1365, 29, 17, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1366, 29, 6, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1367, 29, 23, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1368, 29, 25, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1369, 29, 26, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1370, 29, 27, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1371, 29, 29, '2020-11-20 09:38:18', '17670627203', '2020-11-20 15:13:59', '管理员', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1372, 29, 8, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1373, 29, 31, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1374, 29, 33, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1375, 29, 34, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1376, 29, 88, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1377, 29, 32, '2020-11-20 09:38:18', '17670627203', '2020-11-20 09:38:18', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1378, 21, 1, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1379, 21, 9, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1380, 21, 10, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1381, 21, 3, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1382, 21, 16, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1383, 21, 17, '2020-11-20 15:03:51', '13786300877', '2020-11-20 15:03:51', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1384, 29, 93, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1385, 29, 95, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1386, 29, 96, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1387, 29, 97, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1388, 29, 98, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1389, 29, 99, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1390, 29, 100, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1391, 29, 101, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1392, 29, 102, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1393, 29, 103, '2020-11-20 15:13:59', '13786300877', '2020-11-20 15:13:59', '13786300877', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1394, 1, 107, '2020-11-27 14:26:24', '17670627204', '2020-11-27 14:26:24', '17670627204', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1395, 32, 1, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1396, 32, 9, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1397, 32, 10, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1398, 32, 3, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1399, 32, 16, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1400, 32, 17, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1401, 32, 6, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1402, 32, 23, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1403, 32, 25, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1404, 32, 26, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1405, 32, 27, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1406, 32, 29, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1407, 32, 8, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1408, 32, 31, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1409, 32, 33, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1410, 32, 34, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1411, 32, 88, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1412, 32, 107, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1413, 32, 32, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1414, 32, 93, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1415, 32, 95, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1416, 32, 96, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1417, 32, 97, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1418, 32, 98, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1419, 32, 99, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1420, 32, 100, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1421, 32, 101, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1422, 32, 102, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1423, 32, 103, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1424, 32, 104, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1425, 32, 105, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1426, 32, 106, '2020-11-30 14:28:54', '17670627203', '2020-11-30 14:28:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1427, 1, 108, '2020-12-10 14:09:34', '17670627203', '2020-12-10 14:09:34', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1428, 10, 6, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1429, 10, 23, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1430, 10, 25, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1431, 10, 26, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1432, 10, 27, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1433, 10, 29, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1434, 10, 98, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1435, 10, 99, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1436, 10, 100, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1437, 10, 101, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1438, 10, 102, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1439, 10, 103, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1440, 10, 104, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1441, 10, 106, '2020-12-26 14:18:54', '17670627203', '2020-12-26 14:18:54', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1442, 2, 104, '2020-12-26 14:19:17', '17670627203', '2020-12-26 14:19:17', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1443, 2, 106, '2020-12-26 14:19:17', '17670627203', '2020-12-26 14:19:17', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1444, 10, 105, '2020-12-26 14:25:19', '17670627203', '2020-12-26 14:25:19', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1445, 1, 109, '2021-08-09 11:04:21', '17670627203', '2021-08-09 11:04:21', '17670627203', 0, 0);
INSERT INTO `kj_sys_admin_power` VALUES (1446, 1, 110, '2021-08-09 11:06:07', '17670627203', '2021-08-09 11:06:07', '17670627203', 0, 0);

-- ----------------------------
-- Table structure for kj_sys_user_group
-- ----------------------------
DROP TABLE IF EXISTS `kj_sys_user_group`;
CREATE TABLE `kj_sys_user_group`  (
  `groupId` int(10) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分组名称',
  `groupPid` int(10) NOT NULL COMMENT '父级id',
  `groupLogo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分组图标',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `createUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建用户',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `updateUser` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '更新用户',
  `isValid` tinyint(1) NULL DEFAULT 0 COMMENT '是否删除：0，未删除，1，已删除',
  PRIMARY KEY (`groupId`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_sys_user_group
-- ----------------------------

-- ----------------------------
-- Table structure for kj_user
-- ----------------------------
DROP TABLE IF EXISTS `kj_user`;
CREATE TABLE `kj_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userAccount` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userPwd` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `userType` int(10) NULL DEFAULT NULL COMMENT '4:C端 ,2:B端后勤 ,1:B端管理 ,3:B端工作人员',
  `userName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `company` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '公司名称',
  `authKey` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `creator` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updater` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `isValid` tinyint(1) NULL DEFAULT 0,
  `groupId` int(11) NULL DEFAULT 0 COMMENT '权限组编号',
  `checkStatus` tinyint(1) NULL DEFAULT 0 COMMENT '审核状态 0 待审核 1审核通过 2审核不通过',
  `staffId` int(11) NULL DEFAULT NULL COMMENT '职工编号',
  `jobId` int(11) NULL DEFAULT NULL COMMENT '求职者编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 350 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_user
-- ----------------------------
INSERT INTO `kj_user` VALUES (74, '17670627203', '$2y$13$MfI87U9F2A0wrHgyYis6juFuiUP7epQl7M7TYJYzIYFOPsRlZWW..', 1, 'admin', '17670627203', '', NULL, 'Vr1LtrC5N0xBzTcVSb8wz3t99PG8Lnov', '17670627203', '2020-08-03 06:38:42', '17670627203', '2020-12-08 15:33:14', 0, 1, 0, 66, 99);

SET FOREIGN_KEY_CHECKS = 1;
