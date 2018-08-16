/*
Navicat MySQL Data Transfer

Source Server         : 39.108.168.48
Source Server Version : 50556
Source Host           : 39.108.168.48:3306
Source Database       : zjty-demo_safeandsound

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-07-13 15:54:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_ad
-- ----------------------------
DROP TABLE IF EXISTS `think_ad`;
CREATE TABLE `think_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `ad_position_id` varchar(10) DEFAULT NULL COMMENT '广告位',
  `link_url` varchar(128) DEFAULT NULL,
  `images` varchar(128) DEFAULT NULL,
  `start_date` date DEFAULT NULL COMMENT '开始时间',
  `end_date` date DEFAULT NULL COMMENT '结束时间',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  `update_time` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ad
-- ----------------------------
INSERT INTO `think_ad` VALUES ('51', '图片1', '1', '#', '/uploads/banner/20180516/09a772b09e8806dd8f848858c402a05d.png', '2018-01-12', '2018-01-31', '1', '0', '100', null, null);
INSERT INTO `think_ad` VALUES ('52', '图片2', '1', '#', '/uploads/banner/20180516/a833f7e2a7f71d1cd5593cc7ac8ab4f0.jpg', '2018-01-12', '2018-01-31', '1', '0', '100', null, null);
INSERT INTO `think_ad` VALUES ('53', '图片3', '1', '#', '/uploads/banner/20180516/5362207a2c35d2c07fb81a658413d3cd.jpg', '2018-01-12', '2018-01-31', '1', '0', '100', null, null);
INSERT INTO `think_ad` VALUES ('54', '图片4', '1', '#', '/uploads/banner/20180516/9f1c3057007d8c7fec0984bb3f6374c7.jpg', '2018-01-12', '2018-01-31', '1', '0', '100', null, null);
INSERT INTO `think_ad` VALUES ('55', '图片5', '1', '#', '/uploads/banner/20180516/bc10d4093d00e6c7b7387d0f8837502b.jpg', '2018-01-12', '2018-02-28', '1', '0', '100', null, null);

-- ----------------------------
-- Table structure for think_ad_position
-- ----------------------------
DROP TABLE IF EXISTS `think_ad_position`;
CREATE TABLE `think_ad_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL COMMENT '分类名称',
  `orderby` varchar(10) DEFAULT '100' COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ad_position
-- ----------------------------
INSERT INTO `think_ad_position` VALUES ('1', '首页banner', '50', '1522181832', '1522181832', '1');

-- ----------------------------
-- Table structure for think_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `think_admin_user`;
CREATE TABLE `think_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(32) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `portrait` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '头像',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(20) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `groupid` int(11) DEFAULT '1' COMMENT '用户角色id',
  `token` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `create_time` int(10) DEFAULT '0',
  `update_time` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of think_admin_user
-- ----------------------------
INSERT INTO `think_admin_user` VALUES ('1', 'admin', '218dbb225911693af03a713581a7227f', '/uploads/face/20180517/e146d177dd1febd48ef8861ed549c0b0.jpg', '436', '61.140.234.144', '1531273995', 'admin', '1', '1', '1ff91839640f483cb1f154518337d0ad', '1528955961', '1531273995');
INSERT INTO `think_admin_user` VALUES ('13', 'test', '218dbb225911693af03a713581a7227f', '/uploads/face/20180517/e146d177dd1febd48ef8861ed549c0b0.jpg', '2', '113.67.73.0', '1528955961', 'test', '1', '4', '4ee2e395e9921f515d00599a5f79ae3f', '1528955961', '1528955961');

-- ----------------------------
-- Table structure for think_app_active
-- ----------------------------
DROP TABLE IF EXISTS `think_app_active`;
CREATE TABLE `think_app_active` (
  `id` int(10) unsigned NOT NULL,
  `version` int(8) unsigned NOT NULL DEFAULT '0',
  `app_type` varchar(20) NOT NULL DEFAULT '',
  `version_code` varchar(10) NOT NULL DEFAULT '',
  `did` varchar(100) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_app_active
-- ----------------------------
INSERT INTO `think_app_active` VALUES ('1', '1', 'android', '', '12345dg', '1503338102', '1503338102');
INSERT INTO `think_app_active` VALUES ('2', '1', 'android', '', '12345dg', '1503338116', '1503338116');
INSERT INTO `think_app_active` VALUES ('3', '1', 'android', '', '12345dg', '1503943731', '1503943731');

-- ----------------------------
-- Table structure for think_article
-- ----------------------------
DROP TABLE IF EXISTS `think_article`;
CREATE TABLE `think_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章逻辑ID',
  `title` varchar(128) NOT NULL COMMENT '文章标题',
  `cate_id` int(11) NOT NULL DEFAULT '1' COMMENT '文章类别',
  `photo` varchar(64) DEFAULT '' COMMENT '文章图片',
  `remark` varchar(256) DEFAULT '' COMMENT '文章描述',
  `keyword` varchar(32) DEFAULT '' COMMENT '文章关键字',
  `content` text NOT NULL COMMENT '文章内容',
  `views` int(11) NOT NULL DEFAULT '1' COMMENT '浏览量',
  `status` tinyint(1) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '文章类型',
  `is_tui` int(1) DEFAULT '0' COMMENT '是否推荐',
  `is_original` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否原创',
  `from` varchar(255) NOT NULL DEFAULT '' COMMENT '来源',
  `writer` varchar(64) NOT NULL DEFAULT '忘尘' COMMENT '作者',
  `ip` varchar(16) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `a_title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=279 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of think_article
-- ----------------------------
INSERT INTO `think_article` VALUES ('222', 'parse_str(string,array)查询字符串解析到变量', '1', '', 'parse_str(string,array) 函数把查询字符串解析到变量中。\n\n注释：如果未设置 array 参数，则由该函数设置的变量将覆盖已存在的同名变量。', 'PHP函数', '<p><span style=\"font-size: 16px;\"><strong><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; background-color: rgb(253, 252, 248);\">把查询字符串解析到变量中:</span></strong></span></p><p>parse_str(&quot;name=Bill&amp;age=60&quot;);</p><p>echo $name&quot;;</p><p>echo $age;</p><p>输出：</p><p>Bill</p><p>60</p><p><br/></p><p><strong><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; background-color: rgb(253, 252, 248); font-size: 16px;\">在数组中存储变量：</span></strong></p><p>parse_str(&quot;name=Bill&amp;age=60&quot;,$myArray);</p><p>print_r($myArray);</p><p><br/></p><p>输出：</p><p>Array ( [name] =&gt; Bill [age] =&gt; 60 )</p>', '1', '1', '1', '0', '1', '', '忘尘', '113.67.75.188', '1515832400', '1516161372');
INSERT INTO `think_article` VALUES ('223', 'http_build_query()生成 URL-encode 之后的请求字符串', '1', '', '使用给出的关联（或下标）数组生成一个经过 URL-encode 的请求字符串。http_build_query(array)用&拼接字符串数据！', 'PHP函数', '<p>$data = array(&#39;foo&#39;=&gt;&#39;bar&#39;,&#39;baz&#39;=&gt;&#39;boom&#39;,&#39;cow&#39;=&gt;&#39;milk&#39;,&#39;php&#39;=&gt;&#39;hypertext processor&#39;);&nbsp;</p><p><br/></p><p>&nbsp;http_build_query($data);&nbsp;</p><p><br/></p><p>&nbsp;输出：\nfoo=bar&amp;baz=boom&amp;cow=milk&amp;php=hypertext+processor</p>', '2', '1', '1', '0', '1', '', '忘尘', '113.67.75.188', '1515833281', '1516160589');
INSERT INTO `think_article` VALUES ('226', 'set_time_limit(0) 设置程序执行时间的函数', '1', '', 'set_time_limit(0) 设置程序执行时间的函数', 'PHP函数', '<p>set_time_limit(0);</p><p></p><p>括号里边的数字是执行时间，如果为零说明永久执行直到程序结束，如果为大于零的数字，则不管程序是否执行完成，到了设定的秒数，程序结束。</p>', '1', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1516007073', '1516007073');
INSERT INTO `think_article` VALUES ('227', 'uniqid() 生成一个唯一的 ID', '1', '', 'PHP的 uniqid()函数可用于生成不重复的唯一标识符，该函数基于微秒级当前时间戳。在高并发或者间隔时长极短（如循环代码）的情况下，会出现大量重复数据。即使使用了第二个参数，也会重复，最好的方案是结合md5函数来生成唯一ID。', 'PHP函数', '<p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp;md5(uniqid(md5(microtime(true)), true));&nbsp;</p><p>&nbsp; &nbsp;&nbsp;</p>', '1', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1516068982', '1516160050');
INSERT INTO `think_article` VALUES ('228', 'array_unique(array)函数去除一维数组重复值', '1', '', '对于一维数组去除重复值的方法，是可以直接使用php系统函数array_unique，但是这个函数不能对多维数组去除重复值!', 'PHP函数', '<p>array_unique(array) 函数移除数组中的重复的值，并返回结果数组。&nbsp;</p><p><br/></p><p>当几个数组元素的值相等时，只保留第一个元素，其他的元素被删除。 \n\n返回的数组中键名不变。</p><p><br/></p><p>&nbsp;注释：被返回的数组将保持第一个数组元素的键类型。</p><p><br/></p><p>例子 :&nbsp; &nbsp;&nbsp;</p><p>$a=array(&quot;a&quot;=&gt;&quot;abc&quot;,&quot;b&quot;=&gt;&quot;cba&quot;,&quot;c&quot;=&gt;&quot;abc&quot;);&nbsp;</p><p>print_r(array_unique($a));&nbsp;<br/></p><p><br/></p><p>输出：&nbsp;<br style=\"font-family: tahoma, arial, \" microsoft=\"\" font-size:=\"\" white-space:=\"\" background-color:=\"\"/><span style=\"font-family: tahoma, arial, \" microsoft=\"\" font-size:=\"\" background-color:=\"\">Array ( [a] =&gt; abc [b] =&gt; cba)</span></p><p><br/></p><p>&nbsp;</p><!--?php-->', '3', '1', '1', '0', '1', '', '忘尘', '113.67.75.188', '1516107505', '1516159585');
INSERT INTO `think_article` VALUES ('229', '传值和传引用、传地址的区别是什么？', '1', '', '', '', '<p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">传值和传引用、传地址的区别是什么？</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">传值，是把实参的值赋值给行参</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">那么对行参的修改，不会影响实参的值</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\"><br/></p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">传地址</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">是传值的一种特殊方式，只是他传递的是地址，不是普通的如int</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">那么传地址以后，实参和行参都指向同一个对象</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\"><br/></p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">传引用</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">真正的以地址的方式传递参数</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">传递以后，行参和实参都是同一个对象，只是他们名字不同而已</p><p class=\"p-txt\" style=\"margin: 20px 40px; padding: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑, \" hiragino=\"\" sans=\"\" white-space:=\"\" background-color:=\"\" font-size:=\"\" line-height:=\"\">对行参的修改将影响实参的值</p><p><br/></p>', '2', '1', '0', '1', '1', '', '忘尘', '113.67.75.188', '1516182004', '1516182066');
INSERT INTO `think_article` VALUES ('230', 'func_get_args()获取一个函数的所有参数', '1', '', 'func_get_args() ------获取一个函数的所有参数', 'PHP函数', '<p><span style=\"color: rgb(51, 51, 51); font-family: -apple-system, \" helvetica=\"\" pingfang=\"\" hiragino=\"\" sans=\"\" wenquanyi=\"\" micro=\"\" microsoft=\"\" font-size:=\"\" background-color:=\"\">func_get_args()—返回的是一个数组，这个数组内的每一项都是函数的一个参数</span></p>', '1', '1', '0', '1', '1', '', '忘尘', '113.67.75.188', '1516329049', '1526040430');
INSERT INTO `think_article` VALUES ('231', 'phpredis数据类型操作', '1', '', '', 'redis', '<p><strong>对String操作的命令</strong></p><p>set(key, value)：给数据库中名称为key的string赋予值value<br/>get(key)：返回数据库中名称为key的string的value<br/>getset(key, value)：给名称为key的string赋予上一次的value<br/>mget(key1, key2,&amp;hellip;, key N)：返回库中多个string的value<br/>setnx(key, value)：添加string，名称为key，值为value<br/>setex(key, time, value)：向库中添加string，设定过期时间time<br/>mset(key N, value N)：批量设置多个string的值<br/>msetnx(key N, value N)：如果所有名称为key i的string都不存在<br/>incr(key)：名称为key的string增1操作<br/>incrby(key, integer)：名称为key的string增加integer<br/>decr(key)：名称为key的string减1操作<br/>decrby(key, integer)：名称为key的string减少integer<br/>append(key, value)：名称为key的string的值附加value<br/>substr(key, start, end)：返回名称为key的string的value的子串</p><p><br/></p><p><strong>对List操作的命令</strong></p><p>rpush(key, value)：在名称为key的list尾添加一个值为value的元素<br/>lpush(key, value)：在名称为key的list头添加一个值为value的 元素<br/>llen(key)：返回名称为key的list的长度<br/>lrange(key, start, end)：返回名称为key的list中start至end之间的元素<br/>ltrim(key, start, end)：截取名称为key的list<br/>lindex(key, index)：返回名称为key的list中index位置的元素<br/>lset(key, index, value)：给名称为key的list中index位置的元素赋值<br/>lrem(key, count, value)：删除count个key的list中值为value的元素<br/>lpop(key)：返回并删除名称为key的list中的首元素<br/>rpop(key)：返回并删除名称为key的list中的尾元素<br/>blpop(key1, key2,&amp;hellip; key N, timeout)：lpop命令的block版本。<br/>brpop(key1, key2,&amp;hellip; key N, timeout)：rpop的block版本。<br/>rpoplpush(srckey, dstkey)：返回并删除名称为srckey的list的尾元素，并将该元素添加到名称为dstkey的list的头部</p><p><br/></p><p><strong>对Set操作的命令</strong></p><p>sadd(key, member)：向名称为key的set中添加元素member<br/>srem(key, member) ：删除名称为key的set中的元素member<br/>spop(key) ：随机返回并删除名称为key的set中一个元素<br/>smove(srckey, dstkey, member) ：移到集合元素<br/>scard(key) ：返回名称为key的set的基数<br/>sismember(key, member) ：member是否是名称为key的set的元素<br/>sinter(key1, key2,&amp;hellip;key N) ：求交集<br/>sinterstore(dstkey, (keys)) ：求交集并将交集保存到dstkey的集合<br/>sunion(key1, (keys)) ：求并集<br/>sunionstore(dstkey, (keys)) ：求并集并将并集保存到dstkey的集合<br/>sdiff(key1, (keys)) ：求差集<br/>sdiffstore(dstkey, (keys)) ：求差集并将差集保存到dstkey的集合<br/>smembers(key) ：返回名称为key的set的所有元素<br/>srandmember(key) ：随机返回名称为key的set的一个元素</p><p><br/></p><p><strong>对Hash操作的命令</strong></p><p>hset(key, field, value)：向名称为key的hash中添加元素field<br/>hget(key, field)：返回名称为key的hash中field对应的value<br/>hmget(key, (fields))：返回名称为key的hash中field i对应的value<br/>hmset(key, (fields))：向名称为key的hash中添加元素field <br/>hincrby(key, field, integer)：将名称为key的hash中field的value增加integer<br/>hexists(key, field)：名称为key的hash中是否存在键为field的域<br/>hdel(key, field)：删除名称为key的hash中键为field的域<br/>hlen(key)：返回名称为key的hash中元素个数<br/>hkeys(key)：返回名称为key的hash中所有键<br/>hvals(key)：返回名称为key的hash中所有键对应的value<br/>hgetall(key)：返回名称为key的hash中所有的键（field）及其对应的value</p><p><br/></p><p><strong>对Sorted-set（有序集中）操作命令</strong></p><p>zAdd- 用于将一个或多个成员元素及其分数值加入到有序集当中。（分数值可以是整数值或双精度浮点数。）</p><p>zCard，zSize - 获取有序集合中成员的数量<br/></p><p>zCount - 计算排序集中的成员，给定值内的分数</p><p>zIncrBy - 增加排序集中成员的分数</p><p>zInter - 交集多个有序集合，并将结果的有序集合存储在一个新的键中<br/></p><p>zRange - 按索引返回排序集合中的成员范围</p><p>zRangeByScore，zRevRangeByScore - 按分数返回排序集合中的一系列成员</p><p>zRangeByLex - 从共享相同分数的成员中返回一个词典范围</p><p>zRank，zRevRank - 确定排序集中成员的索引</p><p>zRem, zDelete - Remove one or more members from a sorted set</p><p>zRemRangeByRank，zDeleteRangeByRank - 删除给定索引中有序集合中的所有成员</p><p>zRemRangeByScore，zDeleteRangeByScore - 删除给定分数中已排序集合中的所有成员</p><p>zRevRange - 按索引返回排序集中的一系列成员，分数从高到低排序</p><p>zScore - 获取与给定成员关联的分数</p><p>zUnion - 添加多个有序集合，并将得到的有序集合存储在一个新的键中</p><p>zScan - 为成员扫描一个有序集合</p><p><br/></p><p><strong>对value操作的命令</strong></p><p>exists(key)：确认一个key是否存在<br/>del(key)：删除一个key<br/>type(key)：返回值的类型<br/>keys(pattern)：返回满足给定pattern的所有key<br/>randomkey：随机返回key空间的一个<br/>keyrename(oldname, newname)：重命名key<br/>dbsize：返回当前数据库中key的数目<br/>expire：设定一个key的活动时间（s）<br/>ttl：获得一个key的活动时间<br/>select(index)：按索引查询<br/>move(key, dbindex)：移动当前数据库中的key到dbindex数据库<br/>flushdb：删除当前选择数据库中的所有key<br/>flushall：删除所有数据库中的所有key</p><p><br/></p><p><br/></p>', '9', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1516677472', '1516713054');
INSERT INTO `think_article` VALUES ('232', 'LNMP状态管理命令', '1', '', 'LNMP 1.2+状态管理: lnmp {start|stop|reload|restart|kill|status}', 'lnmp', '<p>LNMP 1.2+状态管理: lnmp {start|stop|reload|restart|kill|status}</p><p>LNMP 1.2+各个程序状态管理: lnmp {nginx|mysql|mariadb|php-fpm|pureftpd} {start|stop|reload|restart|kill|status}</p><p>LNMP 1.1状态管理： /root/lnmp {start|stop|reload|restart|kill|status}</p><p>Nginx状态管理：/etc/init.d/nginx {start|stop|reload|restart}</p><p>MySQL状态管理：/etc/init.d/mysql {start|stop|restart|reload|force-reload|status}</p><p>Memcached状态管理：/etc/init.d/memcached {start|stop|restart}</p><p>PHP-FPM状态管理：/etc/init.d/php-fpm {start|stop|quit|restart|reload|logrotate}</p><p>PureFTPd状态管理： /etc/init.d/pureftpd {start|stop|restart|kill|status}</p><p>ProFTPd状态管理： /etc/init.d/proftpd {start|stop|restart|reload}</p><p>Redis状态管理： /etc/init.d/redis {start|stop|restart|kill}</p><p><br/></p>', '11', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1516719248', '1516719287');
INSERT INTO `think_article` VALUES ('233', 'ord() 函数返回字符串的首个字符的 ASCII 值', '1', '', 'ord() 函数返回字符串的首个字符的 ASCII 值。', 'PHP函数', '<p><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; font-size: 14px; background-color: rgb(253, 252, 248);\">ord() 函数返回字符串的首个字符的 ASCII 值。</span></p><p><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; font-size: 14px; background-color: rgb(253, 252, 248);\"><br/></span></p><p><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; font-size: 14px; background-color: rgb(253, 252, 248);\"></span></p><pre style=\"font-family: &quot;Courier New&quot;, monospace; font-size: 13px;\">&lt;?php\necho&nbsp;ord(&quot;S&quot;).&quot;&lt;br&gt;&quot;;\necho&nbsp;ord(&quot;Shanghai&quot;).&quot;&lt;br&gt;&quot;;\n?&gt;</pre><p><span style=\"font-family: PingFangSC-Regular, Verdana, Arial, 微软雅黑, 宋体; font-size: 14px; background-color: rgb(253, 252, 248);\"></span><br/></p><p>83</p><p>83</p>', '2', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1521444835', '1521444870');
INSERT INTO `think_article` VALUES ('234', 'ctype_alpha是一个检测函数，用来检测所给参数是不是字母的函数。', '1', '', 'ctype_alpha是一个检测函数，用来检测所给参数是不是字母的函数。', 'PHP函数', '<p>检查字母　</p><p>ctype_alpha</p><p>(PHP 4 &gt;= 4.0.4, PHP 5)</p><p>ctype_alpha -- 检查字母</p><p>夏利提示：简言之这个php内置的函数就是检测给定的参数是不是全部是字母，注意：只需要传进来一个参数，不区分大小写，是字母都提示true</p><p><br/></p>', '1', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1521445010', '1521445010');
INSERT INTO `think_article` VALUES ('235', 'PHP函数 —— ctype_alnum', '1', '', '//判断是否是字母和数字或字母数字的组合if(!ctype_alnum($str)){\n    echo \'只能是字母或数字的组合\';exit;\n}', 'PHP函数', '<pre style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; white-space: pre-wrap; word-wrap: break-word; font-family: &quot;Courier New&quot; !important;\">//判断是否是字母和数字或字母数字的组合if(!ctype_alnum($str)){\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;只能是字母或数字的组合&#39;;exit;\n}</pre><p><br/></p>', '1', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1521445233', '1521445233');
INSERT INTO `think_article` VALUES ('236', 'MySQL时间函数', '3', '', 'FROM_UNIXTIME()将时间戳直接转换成日期时间\n\nUNIX_TIMESTAMP()是与之相对正好相反的时间函数，将日期时间转换为时间戳类型', '时间函数', '<p>MYSQL处理时间的方法：</p><p>1、将时间戳转换成日期</p><p>FROM_UNIXTIME(time时间戳字段, &#39;%Y年%m月%d日&#39;)</p><p>FROM_UNIXTIME(时间戳, &#39;%Y-%m-%d&#39;)</p><p>例：</p><p>mysql&gt;SELECT FROM_UNIXTIME( 1249488000, &#39;%Y%m%d&#39; )&nbsp;&nbsp;</p><p>-&gt;20071120&nbsp;</p><p>mysql&gt;SELECT FROM_UNIXTIME( 1249488000, &#39;%Y年%m月%d&#39; )&nbsp;&nbsp;</p><p>-&gt;2007年11月20&nbsp;</p><p>sysql&gt;select FROM_UNIXTIME(1616161699, &#39;%Y-%m-%d %H:%i:%S&#39;)</p><p>-&gt;2021-03-19 21:48:19</p><p>smysql&gt;select FROM_UNIXTIME(1156219870);&nbsp;&nbsp;</p><p>-&gt;2006-08-22 12:11:10</p><p><br/></p><p><br/></p><p>2、将时期日期转换成时间戳</p><p>UNIX_TIMESTAMP(), UNIX_TIMESTAMP(date)&nbsp;</p><p>例：</p><p>mysql&gt; SELECT UNIX_TIMESTAMP(&#39;2009-08-06&#39;);&nbsp;</p><p>-&gt;1249488000</p><p><br/></p><p><br/></p><p>3、输出当前时间&nbsp; &nbsp;NOW() 来获得当前的日期/时间</p><p>select NOW();</p><p>输出：</p><p>2018-03-23 17:24:58</p><p><br/></p><p><br/></p><p>4、输出当前时间戳</p><p>Select UNIX_TIMESTAMP(NOW());&nbsp;</p><p><br/></p><p><br/></p><p>5、DATE_FORMAT() 函数用于以不同的格式显示日期/时间数据。</p><p>DATE_FORMAT(NOW(),&#39;%b %d %Y %h:%i %p&#39;)</p><p>DATE_FORMAT(NOW(),&#39;%m-%d-%Y&#39;)</p><p>DATE_FORMAT(NOW(),&#39;%d %b %y&#39;)</p><p>DATE_FORMAT(NOW(),&#39;%d %b %Y %T:%f&#39;)</p><p><br/></p><p>结果类似：</p><p><br/></p><p>Dec 29 2008 11:45 PM</p><p>12-29-2008</p><p>29 Dec 08</p><p>29 Dec 2008 16:25:46.635</p><p><br/></p><p><br/></p><p>案例：</p><p>1、mysql查询当天的记录数：</p><p>$sql=”select * from message Where DATE_FORMAT(FROM_UNIXTIME(addtime),’%Y-%m-%d’) = DATE_FORMAT(NOW(),’%Y-%m-%d’) order by id desc”;&nbsp;</p><p><br/></p><p>2、统计每天的记录数</p><p>SELECT FROM_UNIXTIME(time, &#39;%Y年%m月%d日&#39;) as time , count(id) as count FROM message GROUP BY FROM_UNIXTIME(time, &#39;%Y年%m月%d日&#39;) ORDER BY time DESC;</p><p><br/></p><p>3、统计昨天的记录数</p><p>SELECT FROM_UNIXTIME( time,&nbsp; &#39;%Y-%m-%d&#39; ) AS time, COUNT( id ) AS count FROM&nbsp; message WHERE FROM_UNIXTIME( time,&nbsp; &#39;%Y-%m-%d&#39; ) = &#39;2018-03-22&#39;&quot;;</p><p><br/></p><p><br/></p><p>修饰符：</p><p>使用 FROM_UNIXTIME函数，具体如下：</p><p>FROM_UNIXTIME(unix_timestamp,format)&nbsp; &nbsp; 返回表示 Unix 时间标记的一个字符串，根据format字符串格式化。format可以包含与DATE_FORMAT()函数列出的条目同样的修饰符。&nbsp; &nbsp; 根据format字符串格式化date值。下列修饰符可以被用在format字符串中： %M 月名字(January……December)&nbsp; &nbsp; %W 星期名字(Sunday……Saturday)&nbsp; &nbsp; %D 有英语前缀的月份的日期(1st, 2nd, 3rd, 等等。）&nbsp; &nbsp; %Y 年, 数字, 4 位&nbsp; &nbsp; %y 年, 数字, 2 位&nbsp; &nbsp; %a 缩写的星期名字(Sun……Sat)&nbsp; &nbsp; %d 月份中的天数, 数字(00……31)&nbsp; &nbsp; %e 月份中的天数, 数字(0……31)&nbsp; &nbsp; %m 月, 数字(01……12)&nbsp; &nbsp; %c 月, 数字(1……12)&nbsp; &nbsp; %b 缩写的月份名字(Jan……Dec)&nbsp; &nbsp; %j 一年中的天数(001……366)&nbsp; &nbsp; %H 小时(00……23)&nbsp; &nbsp; %k 小时(0……23)&nbsp; &nbsp; %h 小时(01……12)&nbsp; &nbsp; %I 小时(01……12)&nbsp; &nbsp; %l 小时(1……12)&nbsp; &nbsp; %i 分钟, 数字(00……59)&nbsp; &nbsp; %r 时间,12 小时(hh:mm:ss [AP]M)&nbsp; &nbsp; %T 时间,24 小时(hh:mm:ss)&nbsp; &nbsp; %S 秒(00……59)&nbsp; &nbsp; %s 秒(00……59)&nbsp; &nbsp; %p AM或PM&nbsp; &nbsp; %w 一个星期中的天数(0=Sunday ……6=Saturday ）&nbsp; &nbsp; %U 星期(0……52), 这里星期天是星期的第一天&nbsp; &nbsp; %u 星期(0……52), 这里星期一是星期的第一天&nbsp; &nbsp; %% 一个文字“%”。</p><p><br/></p>', '9', '1', '3', '1', '1', '', '忘尘', '113.67.75.188', '1521798576', '1521806816');
INSERT INTO `think_article` VALUES ('237', 'JS中\"&&”和“||”操作符', '7', '', '1、只要“&&”前面是false，无论“&&”后面是true还是false，结果都将返“&&”前面的值;\n2、只要“&&”前面是true，无论“&&”后面是true还是false，结果都将返“&&”后面的值;\n3、只要“||”前面为false,不管“||”后面是true还是false，都返回“||”后面的值。\n4、只要“||”前面为true,不管“||”后面是true还是false，都返回“||”前面的值。', 'js', '<p>1、只要“&amp;&amp;”前面是false，无论“&amp;&amp;”后面是true还是false，结果都将返“&amp;&amp;”前面的值;</p><p>2、只要“&amp;&amp;”前面是true，无论“&amp;&amp;”后面是true还是false，结果都将返“&amp;&amp;”后面的值;</p><p>3、只要“||”前面为false,不管“||”后面是true还是false，都返回“||”后面的值。</p><p>4、只要“||”前面为true,不管“||”后面是true还是false，都返回“||”前面的值。</p><p><br/></p><p>注：<span style=\"\">在js逻辑运算中，0、”“、null、false、undefined、NaN都会判为false，其他都为true</span></p>', '7', '1', '1', '1', '1', '', '忘尘', '113.67.75.188', '1521799404', '1521807196');

-- ----------------------------
-- Table structure for think_article_cate
-- ----------------------------
DROP TABLE IF EXISTS `think_article_cate`;
CREATE TABLE `think_article_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL COMMENT '分类名称',
  `orderby` varchar(10) DEFAULT '100' COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1启用 0禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_article_cate
-- ----------------------------
INSERT INTO `think_article_cate` VALUES ('1', 'PHP', '5', '1526040061', '1526040061', '1');
INSERT INTO `think_article_cate` VALUES ('2', 'Java', '6', '1521883474', '1521883474', '0');
INSERT INTO `think_article_cate` VALUES ('3', 'MYSQL', '4', '1477140627', '1521798385', '1');
INSERT INTO `think_article_cate` VALUES ('7', 'WEB', '50', '1521799146', '1526040061', '1');
INSERT INTO `think_article_cate` VALUES ('8', 'Linux', '50', '1521883474', '1521883474', '1');

-- ----------------------------
-- Table structure for think_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_group`;
CREATE TABLE `think_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_auth_group
-- ----------------------------
INSERT INTO `think_auth_group` VALUES ('1', '超级管理员', '1', '', '1446535750', '1446535750');
INSERT INTO `think_auth_group` VALUES ('4', '系统测试员', '1', '1,2,9,12,3,30,31,33,4,35,38,39,61,62,120,122,123,124,125,126,130,5,6,8,27,28,13,14,93,24,25,40,41,42,43,26,44,45,46,47,48,49,50,51,54,55,58,83,84,119,70,71,72,73,80,75,76,77,79,89,92,98,99,94,95,96,97,112,114,115,118,127,128,129,132', '1446535750', '1531136822');

-- ----------------------------
-- Table structure for think_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_group_access`;
CREATE TABLE `think_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_auth_group_access
-- ----------------------------
INSERT INTO `think_auth_group_access` VALUES ('1', '1');
INSERT INTO `think_auth_group_access` VALUES ('13', '4');

-- ----------------------------
-- Table structure for think_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_rule`;
CREATE TABLE `think_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(20) NOT NULL COMMENT '样式',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_auth_rule
-- ----------------------------
INSERT INTO `think_auth_rule` VALUES ('1', '#', '系统管理', '1', '1', 'fa fa-gear', '', '0', '1', '1446535750', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('2', 'admin/adminuser/index', '管理员管理', '1', '1', '', '', '1', '10', '1446535750', '1528375315');
INSERT INTO `think_auth_rule` VALUES ('3', 'admin/role/index', '角色管理', '1', '1', '', '', '1', '20', '1446535750', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('4', 'admin/menu/index', '菜单管理', '1', '1', '', '', '1', '30', '1446535750', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('5', '#', '数据库管理', '1', '1', 'fa fa-database', '', '0', '2', '1446535750', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('6', 'admin/data/index', '数据库备份', '1', '1', '', '', '5', '50', '1446535750', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('7', 'admin/data/optimize', '优化表', '1', '1', '', '', '6', '50', '1477312169', '1477312169');
INSERT INTO `think_auth_rule` VALUES ('8', 'admin/data/repair', '修复表', '1', '1', '', '', '6', '50', '1477312169', '1477312169');
INSERT INTO `think_auth_rule` VALUES ('9', 'admin/adminuser/add', '添加用户', '1', '1', '', '', '2', '50', '1477312169', '1528375314');
INSERT INTO `think_auth_rule` VALUES ('10', 'admin/adminuser/edit', '编辑用户', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `think_auth_rule` VALUES ('11', 'admin/adminuser/del', '删除用户', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `think_auth_rule` VALUES ('12', 'admin/adminuser/status', '用户状态', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `think_auth_rule` VALUES ('13', '#', '日志管理', '1', '1', 'fa fa-tasks', '', '0', '6', '1477312169', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('14', 'admin/log/adminLog', '后台日志', '1', '1', '', '', '13', '50', '1477312169', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('22', 'admin/log/del_log', '删除日志', '1', '1', '', '', '14', '50', '1477312169', '1477316778');
INSERT INTO `think_auth_rule` VALUES ('24', '#', '文章管理', '1', '1', 'fa fa-paste', '', '0', '4', '1477312169', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('25', 'admin/articlecate/index', '文章分类', '1', '1', '', '', '24', '10', '1477312260', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('26', 'admin/article/index', '文章列表', '1', '1', '', '', '24', '20', '1477312333', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('27', 'admin/data/import', '数据库还原', '1', '1', '', '', '5', '50', '1477639870', '1477639870');
INSERT INTO `think_auth_rule` VALUES ('28', 'admin/data/revert', '还原', '1', '1', '', '', '27', '50', '1477639972', '1477639972');
INSERT INTO `think_auth_rule` VALUES ('29', 'admin/data/del', '删除', '1', '1', '', '', '27', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('30', 'admin/role/add', '添加角色', '1', '1', '', '', '3', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('31', 'admin/role/edit', '编辑角色', '1', '1', '', '', '3', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('32', 'admin/role/del', '删除角色', '1', '1', '', '', '3', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('33', 'admin/role/status', '角色状态', '1', '1', '', '', '3', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('34', 'admin/role/giveAccess', '权限分配', '1', '1', '', '', '3', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('35', 'admin/menu/add', '添加菜单', '1', '1', '', '', '4', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('36', 'admin/menu/edit', '编辑菜单', '1', '1', '', '', '4', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('37', 'admin/menu/del', '删除菜单', '1', '1', '', '', '4', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('38', 'admin/menu/status', '菜单状态', '1', '1', '', '', '4', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('39', 'admin/menu/ruleorder', '菜单排序', '1', '1', '', '', '4', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('40', 'admin/articlecate/add', '添加分类', '1', '1', '', '', '25', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('41', 'admin/articlecate/edit', '编辑分类', '1', '1', '', '', '25', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('42', 'admin/articlecate/del', '删除分类', '1', '1', '', '', '25', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('43', 'admin/articlecate/status', '分类状态', '1', '1', '', '', '25', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('44', 'admin/article/add', '添加文章', '1', '1', '', '', '26', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('45', 'admin/article/edit', '编辑文章', '1', '1', '', '', '26', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('46', 'admin/article/del', '删除文章', '1', '1', '', '', '26', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('47', 'admin/article/status', '文章状态', '1', '1', '', '', '26', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('48', '#', '广告管理', '1', '1', 'fa fa-image', '', '0', '5', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('49', 'admin/adposition/index', '广告位', '1', '1', '', '', '48', '10', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('50', 'admin/adposition/add', '添加广告位', '1', '1', '', '', '49', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('51', 'admin/adposition/edit', '编辑广告位', '1', '1', '', '', '49', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('52', 'admin/adposition/del', '删除广告位', '1', '1', '', '', '49', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('53', 'admin/adposition/status', '广告位状态', '1', '1', '', '', '49', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('54', 'admin/ad/index', '广告列表', '1', '1', '', '', '48', '20', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('55', 'admin/ad/add', '添加广告', '1', '1', '', '', '54', '50', '1477640011', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('56', 'admin/ad/edit', '编辑广告', '1', '1', '', '', '54', '50', '1477640011', '1527765991');
INSERT INTO `think_auth_rule` VALUES ('57', 'admin/ad/del', '删除广告', '1', '1', '', '', '54', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('58', 'admin/ad/status', '广告状态', '1', '1', '', '', '54', '50', '1477640011', '1477640011');
INSERT INTO `think_auth_rule` VALUES ('83', '#', '示例', '1', '1', 'fa fa-paper-plane', '', '0', '100', '1505281878', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('84', 'admin/demo/sms', '发送短信', '1', '1', '', '', '83', '50', '1505281944', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('61', 'admin/config/index', '配置管理', '1', '1', '', '', '1', '50', '1479908607', '1479908607');
INSERT INTO `think_auth_rule` VALUES ('62', 'admin/config/index', '配置列表', '1', '1', '', '', '61', '50', '1479908607', '1487943813');
INSERT INTO `think_auth_rule` VALUES ('63', 'admin/config/save', '保存配置', '1', '1', '', '', '61', '50', '1479908607', '1487943831');
INSERT INTO `think_auth_rule` VALUES ('70', '#', '会员管理', '1', '1', 'fa fa-users', '', '0', '3', '1484103066', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('72', 'admin/group/add', '添加会员组', '1', '1', '', '', '71', '50', '1484103304', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('71', 'admin/group/index', '会员组', '1', '1', '', '', '70', '10', '1484103304', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('73', 'admin/group/edit', '编辑会员组', '1', '1', '', '', '71', '50', '1484103304', '1484103304');
INSERT INTO `think_auth_rule` VALUES ('74', 'admin/group/del', '删除会员组', '1', '1', '', '', '71', '50', '1484103304', '1528376598');
INSERT INTO `think_auth_rule` VALUES ('75', 'admin/user/index', '会员列表', '1', '1', '', '', '70', '20', '1484103304', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('76', 'admin/user/add', '添加会员', '1', '1', '', '', '75', '50', '1484103304', '1528374424');
INSERT INTO `think_auth_rule` VALUES ('77', 'admin/user/edit', '编辑会员', '1', '1', '', '', '75', '50', '1484103304', '1484103304');
INSERT INTO `think_auth_rule` VALUES ('78', 'admin/user/del', '删除会员', '1', '1', '', '', '75', '50', '1484103304', '1484103304');
INSERT INTO `think_auth_rule` VALUES ('79', 'admin/user/status', '会员状态', '1', '1', '', '', '75', '50', '1484103304', '1487937671');
INSERT INTO `think_auth_rule` VALUES ('80', 'admin/group/status', '会员组状态', '1', '1', '', '', '71', '50', '1484103304', '1484103304');
INSERT INTO `think_auth_rule` VALUES ('89', '#', '友情链接', '1', '1', 'fa fa-motorcycle', '', '0', '50', '1525078724', '1528426065');
INSERT INTO `think_auth_rule` VALUES ('93', 'admin/log/homelog', '前台日志', '1', '1', '', '', '13', '50', '1525508440', '1525508440');
INSERT INTO `think_auth_rule` VALUES ('92', 'admin/friendurl/index', '友情链接', '1', '1', '', '', '89', '50', '1525079963', '1525080640');
INSERT INTO `think_auth_rule` VALUES ('94', '#', '留言管理', '1', '1', 'fa fa-commenting', '', '0', '50', '1526124015', '1526124099');
INSERT INTO `think_auth_rule` VALUES ('95', 'admin/liuyan/index', '留言列表', '1', '1', '', '', '94', '50', '1526124047', '1526124399');
INSERT INTO `think_auth_rule` VALUES ('96', 'admin/liuyan/respondLiuyan', '回复留言', '1', '1', '', '', '95', '50', '1526895660', '1526895660');
INSERT INTO `think_auth_rule` VALUES ('97', 'admin/liuyan/del', '删除留言', '1', '1', '', '', '95', '44', '1526895714', '1528426589');
INSERT INTO `think_auth_rule` VALUES ('98', 'admin/friendurl/del', '删除友链', '1', '1', '', '', '92', '50', '1528342078', '1528342078');
INSERT INTO `think_auth_rule` VALUES ('99', 'admin/friendurl/edit', '修改友链', '1', '1', '', '', '92', '50', '1528342078', '1528342078');


-- ----------------------------
-- Table structure for think_comment
-- ----------------------------
DROP TABLE IF EXISTS `think_comment`;
CREATE TABLE `think_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(32) NOT NULL,
  `article_id` varchar(128) NOT NULL COMMENT '文章id',
  `comment` varchar(255) NOT NULL COMMENT '评论',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1开启 2：关闭',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='友情链接';

-- ----------------------------
-- Records of think_comment
-- ----------------------------
INSERT INTO `think_comment` VALUES ('29', '月卷瑟无', '250', '测试测评', '1', '1529722401', '1529722401');

-- ----------------------------
-- Table structure for think_config
-- ----------------------------
DROP TABLE IF EXISTS `think_config`;
CREATE TABLE `think_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_config
-- ----------------------------
INSERT INTO `think_config` VALUES ('1', 'web_site_title', '煮酒听雨博客');
INSERT INTO `think_config` VALUES ('2', 'web_site_description', '煮酒听雨博客');
INSERT INTO `think_config` VALUES ('3', 'web_site_keyword', '煮酒听雨博客');
INSERT INTO `think_config` VALUES ('4', 'web_site_icp', '粤ICP备17104967号-3');
INSERT INTO `think_config` VALUES ('5', 'web_site_cnzz', '');
INSERT INTO `think_config` VALUES ('6', 'web_site_copy', 'Copyright © 2018 煮酒听雨后台管理系统 All rights reserved.');
INSERT INTO `think_config` VALUES ('7', 'web_site_close', '1');
INSERT INTO `think_config` VALUES ('8', 'list_rows', '9');
INSERT INTO `think_config` VALUES ('9', 'admin_allow_ip', '');
INSERT INTO `think_config` VALUES ('10', 'alisms_appkey', 'LTAIaoSb5rbqE3vi');
INSERT INTO `think_config` VALUES ('11', 'alisms_appsecret', '1ebDBLPNAOWzY2PIAEYbpBAwizpovs');
INSERT INTO `think_config` VALUES ('12', 'alisms_signname', '煮酒听雨博客');
INSERT INTO `think_config` VALUES ('13', 'smtp_server', 'smtp.qq.com');
INSERT INTO `think_config` VALUES ('14', 'smtp_user', '2656682755@qq.com');
INSERT INTO `think_config` VALUES ('15', 'smtp_pwd', 'a50b87b9cc7dbaca0abc5a6fa25f8736');
INSERT INTO `think_config` VALUES ('16', 'test_eamil', '948043169@qq.com');
INSERT INTO `think_config` VALUES ('17', 'smtp_port', '465');
INSERT INTO `think_config` VALUES ('18', 'email_register_status', '0');
INSERT INTO `think_config` VALUES ('19', 'mobile_register_status', '1');
INSERT INTO `think_config` VALUES ('20', 'aboutsite', '<p>煮酒听雨博客，分享互联网开发的技术与经验</p><p style=\"color: rgb(255, 0, 0);\">欢迎加群：201216422，加群即可获取<span style=\"text-indent: 24px;\">百度云密码(群文件内自动查找对应的文件)，免费分享</span>教学视频</p><p><span style=\"color: rgb(255, 0, 0); text-decoration: underline;\"><a href=\"https://jq.qq.com/?_wv=1027&k=5x29z1o\" style=\"color: rgb(255, 0, 0); text-decoration: underline;\">点击链接加入群聊【PHP煮酒听雨交流群】</a></span></p><p style=\"\">欢迎有技术、有经验、有问题、有态度、有故事的你前来分享！</p><p>后台测试地址： <a href=\"http://zjty-demo.safeandsound.vip/admin.html\" target=\"_blank\">http://zjty-demo.safeandsound.vip/admin.html</a></p><p>帐号： test&nbsp; &nbsp;密码：123456</p><p><br/></p>');
INSERT INTO `think_config` VALUES ('21', 'alisms_templatecode', 'SMS_121851853');
INSERT INTO `think_config` VALUES ('22', 'login_verify_type', '0');
INSERT INTO `think_config` VALUES ('23', 'iscompatible', '2');
INSERT INTO `think_config` VALUES ('24', 'login_comment_status', '0');

-- ----------------------------
-- Table structure for think_friend_url
-- ----------------------------
DROP TABLE IF EXISTS `think_friend_url`;
CREATE TABLE `think_friend_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `friend_url` varchar(128) NOT NULL COMMENT '友情链接',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 1开启 2：关闭',
  `sort` smallint(6) NOT NULL DEFAULT '50' COMMENT '排序',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `friend_url` (`friend_url`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='友情链接';

-- ----------------------------
-- Records of think_friend_url
-- ----------------------------
INSERT INTO `think_friend_url` VALUES ('11', '煮酒听雨博客', 'http://zjty.safeandsound.vip', '1521521529', '1', '50', '1525507351');
INSERT INTO `think_friend_url` VALUES ('32', 'thinkphp官网', 'http://www.thinkphp.cn', '1521521529', '1', '50', '1521521529');

-- ----------------------------
-- Table structure for think_group
-- ----------------------------
DROP TABLE IF EXISTS `think_group`;
CREATE TABLE `think_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_group
-- ----------------------------
INSERT INTO `think_group` VALUES ('1', '普通会员', '1', '1441616559', '1528976003');
INSERT INTO `think_group` VALUES ('2', '系统组', '1', '1441617195', '1528976010');
INSERT INTO `think_group` VALUES ('3', 'VIP', '1', '1441769224', '1528788632');

-- ----------------------------
-- Table structure for think_liuyan
-- ----------------------------
DROP TABLE IF EXISTS `think_liuyan`;
CREATE TABLE `think_liuyan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uname` varchar(32) NOT NULL DEFAULT '匿名' COMMENT '留言人',
  `content` text NOT NULL COMMENT '留言内容',
  `email` char(20) NOT NULL COMMENT '留言',
  `ip` bigint(20) NOT NULL,
  `os` varchar(16) NOT NULL,
  `address` varchar(32) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '留言时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `respondcontent` text NOT NULL COMMENT '回复内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for think_log_admin
-- ----------------------------
DROP TABLE IF EXISTS `think_log_admin`;
CREATE TABLE `think_log_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `admin_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `ip` char(60) DEFAULT NULL COMMENT 'IP地址',
  `status` tinyint(1) DEFAULT NULL COMMENT '1 成功 2 失败',
  `create_time` int(10) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7419 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_log_admin
-- ----------------------------

INSERT INTO `think_log_admin` VALUES ('6507', '13', 'test', '查看管理员列表', '27.154.53.18', '1', '1531186101', null);
INSERT INTO `think_log_admin` VALUES ('6508', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186107', null);
INSERT INTO `think_log_admin` VALUES ('6509', '13', 'test', '查看菜单列表', '27.154.53.18', '1', '1531186110', null);
INSERT INTO `think_log_admin` VALUES ('6510', '13', 'test', '查看配置', '27.154.53.18', '1', '1531186118', null);
INSERT INTO `think_log_admin` VALUES ('6511', '13', 'test', '查看配置', '27.154.53.18', '1', '1531186118', null);
INSERT INTO `think_log_admin` VALUES ('6512', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186176', null);
INSERT INTO `think_log_admin` VALUES ('6513', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186188', null);
INSERT INTO `think_log_admin` VALUES ('6514', '13', 'test', '查看会员组列表', '27.154.53.18', '1', '1531186191', null);
INSERT INTO `think_log_admin` VALUES ('6515', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186195', null);
INSERT INTO `think_log_admin` VALUES ('6516', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186204', null);
INSERT INTO `think_log_admin` VALUES ('6517', '13', 'test', '查看角色--4', '27.154.53.18', '1', '1531186205', null);
INSERT INTO `think_log_admin` VALUES ('6518', '13', 'test', '查看角色列表', '27.154.53.18', '1', '1531186207', null);
INSERT INTO `think_log_admin` VALUES ('6519', '0', '', '数据库还原完成', '39.108.168.48', '1', '1531186262', null);
INSERT INTO `think_log_admin` VALUES ('6520', '13', 'test', '查看留言列表', '27.154.53.18', '1', '1531186331', null);
INSERT INTO `think_log_admin` VALUES ('6521', '13', 'test', '查看友情链接列表', '27.154.53.18', '1', '1531186338', null);
INSERT INTO `think_log_admin` VALUES ('6522', '13', 'test', '查看资源列表', '27.154.53.18', '1', '1531186342', null);
INSERT INTO `think_log_admin` VALUES ('6523', '13', 'test', '查看资源列表', '27.154.53.18', '1', '1531186379', null);
INSERT INTO `think_log_admin` VALUES ('6524', '0', '', '数据库还原完成', '39.108.168.48', '1', '1531188002', null);
INSERT INTO `think_log_admin` VALUES ('6525', '13', 'test', '管理员【test】登录成功', '121.13.21.110', '1', '1531188249', null);
INSERT INTO `think_log_admin` VALUES ('6526', '13', 'test', '查看后台首页', '121.13.21.110', '1', '1531188252', null);
INSERT INTO `think_log_admin` VALUES ('6527', '13', 'test', '管理员【test】登录成功', '101.95.166.54', '1', '1531189400', null);
INSERT INTO `think_log_admin` VALUES ('6528', '13', 'test', '查看后台首页', '101.95.166.54', '1', '1531189403', null);
INSERT INTO `think_log_admin` VALUES ('6529', '13', 'test', '查看管理员列表', '101.95.166.54', '1', '1531189411', null);
INSERT INTO `think_log_admin` VALUES ('6530', '13', 'test', '查看角色列表', '101.95.166.54', '1', '1531189422', null);
INSERT INTO `think_log_admin` VALUES ('6531', '13', 'test', '查看菜单列表', '101.95.166.54', '1', '1531189424', null);
INSERT INTO `think_log_admin` VALUES ('6532', '13', 'test', '查看配置', '101.95.166.54', '1', '1531189428', null);
INSERT INTO `think_log_admin` VALUES ('6533', '13', 'test', '概率性清除缓存数据', '101.95.166.54', '1', '1531189438', null);
INSERT INTO `think_log_admin` VALUES ('6534', '13', 'test', '查看文章分类列表', '101.95.166.54', '1', '1531189462', null);
INSERT INTO `think_log_admin` VALUES ('6535', '13', 'test', '禁用分类状态--1', '101.95.166.54', '1', '1531189465', null);
INSERT INTO `think_log_admin` VALUES ('6536', '13', 'test', '启用分类状态--1', '101.95.166.54', '1', '1531189468', null);
INSERT INTO `think_log_admin` VALUES ('6537', '13', 'test', '查看分类--1', '101.95.166.54', '1', '1531189470', null);
INSERT INTO `think_log_admin` VALUES ('6538', '13', 'test', '查看文章分类列表', '101.95.166.54', '1', '1531189474', null);
INSERT INTO `think_log_admin` VALUES ('6539', '13', 'test', '概率性清除缓存数据', '101.95.166.54', '1', '1531189480', null);
INSERT INTO `think_log_admin` VALUES ('6540', '13', 'test', '启用分类状态--2', '101.95.166.54', '1', '1531189499', null);
INSERT INTO `think_log_admin` VALUES ('6541', '13', 'test', '查看广告位列表', '101.95.166.54', '1', '1531189502', null);
INSERT INTO `think_log_admin` VALUES ('6542', '13', 'test', '查看广告列表', '101.95.166.54', '1', '1531189504', null);
INSERT INTO `think_log_admin` VALUES ('6543', '13', 'test', '查看广告位列表', '101.95.166.54', '1', '1531189507', null);


-- ----------------------------
-- Table structure for think_log_home
-- ----------------------------
DROP TABLE IF EXISTS `think_log_home`;
CREATE TABLE `think_log_home` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '1' COMMENT '用户id',
  `click_ip` bigint(10) unsigned NOT NULL COMMENT 'ip',
  `click_province` varchar(50) DEFAULT NULL COMMENT '登录地区',
  `os_broswer` varchar(64) DEFAULT NULL COMMENT '设备码',
  `do_content` varchar(500) NOT NULL COMMENT '操作内容',
  `click_time` int(10) unsigned NOT NULL COMMENT '点击时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3050 DEFAULT CHARSET=utf8 COMMENT='文章查看日志表';

-- ----------------------------
-- Records of think_log_home
-- ----------------------------

INSERT INTO `think_log_home` VALUES ('1609', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721429');
INSERT INTO `think_log_home` VALUES ('1610', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721485');
INSERT INTO `think_log_home` VALUES ('1611', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '访问首页!', '1528721489');
INSERT INTO `think_log_home` VALUES ('1612', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721491');
INSERT INTO `think_log_home` VALUES ('1613', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721520');
INSERT INTO `think_log_home` VALUES ('1614', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721605');
INSERT INTO `think_log_home` VALUES ('1615', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721724');
INSERT INTO `think_log_home` VALUES ('1616', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528721766');
INSERT INTO `think_log_home` VALUES ('1617', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '访问首页!', '1528721802');
INSERT INTO `think_log_home` VALUES ('1618', '2', '1900235211', '', 'Windows 7--Chrome(65.0.3325.181)', '访问关于我', '1528721804');
INSERT INTO `think_log_home` VALUES ('1619', '2', '1974213142', '', 'Windows NT--Chrome(67.0.3396.62)', '访问关于我', '1528722351');
INSERT INTO `think_log_home` VALUES ('1620', '2', '3704110054', '', 'Windows 7--Chrome(63.0.3239.132)', '访问关于我', '1528722379');
INSERT INTO `think_log_home` VALUES ('1621', '2', '3704110054', '', 'Windows 7--Chrome(63.0.3239.132)', '访问关于我', '1528722399');
INSERT INTO `think_log_home` VALUES ('1622', '2', '249016467', '', 'Windows 7--Firefox(43.0)', '访问关于我', '1528747377');
INSERT INTO `think_log_home` VALUES ('1623', '2', '1928054003', '', 'Windows 10--Chrome(67.0.3396.79)', '访问关于我', '1528763713');
INSERT INTO `think_log_home` VALUES ('1624', '2', '3722837478', '', 'Windows 7--Chrome(55.0.2883.87)', '访问关于我', '1528764342');
INSERT INTO `think_log_home` VALUES ('1625', '2', '2026037866', '', 'Windows 10--Chrome(58.0.3029.110)', '访问关于我', '1528766487');
INSERT INTO `think_log_home` VALUES ('1626', '2', '3071167710', '', 'Windows 10--Chrome(65.0.3325.181)', '访问关于我', '1528767319');
INSERT INTO `think_log_home` VALUES ('1627', '2', '710706082', '', 'Windows 10--Chrome(64.0.3282.186)', '访问关于我', '1528770256');
INSERT INTO `think_log_home` VALUES ('1628', '2', '1779163934', '', 'ios--其它浏览器', '访问首页!', '1528774865');
INSERT INTO `think_log_home` VALUES ('1629', '2', '720008030', '', 'Windows NT--Chrome(49.0.2623.221)', '访问关于我', '1528777679');
INSERT INTO `think_log_home` VALUES ('1630', '2', '720008030', '', 'Windows NT--Chrome(49.0.2623.221)', '访问关于我', '1528778010');
INSERT INTO `think_log_home` VALUES ('1631', '2', '975886574', '', 'Windows 10--Chrome(66.0.3359.139)', '访问关于我', '1528781172');
INSERT INTO `think_log_home` VALUES ('1632', '2', '244481634', '', 'other--Chrome(66.0.3359.139)', '访问关于我', '1528783852');
INSERT INTO `think_log_home` VALUES ('1633', '2', '2345610513', '', 'Windows 10--Edge(17.17134)', '访问关于我', '1528786396');
INSERT INTO `think_log_home` VALUES ('1634', '2', '1901783937', '', 'Windows 7--Chrome(66.0.3359.181)', '访问关于我', '1528788237');
INSERT INTO `think_log_home` VALUES ('1635', '2', '1900235708', '', 'Windows 7--Chrome(65.0.3325.181)', '访问首页!', '1528788888');
INSERT INTO `think_log_home` VALUES ('1636', '2', '1900235708', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528788890');
INSERT INTO `think_log_home` VALUES ('1637', '2', '180356071', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528788906');
INSERT INTO `think_log_home` VALUES ('1638', '2', '1900235708', '', 'Windows 7--Chrome(65.0.3325.181)', '访问首页!', '1528789043');
INSERT INTO `think_log_home` VALUES ('1639', '2', '1900235708', '', 'Windows 7--Chrome(65.0.3325.181)', '访问首页!', '1528789444');
INSERT INTO `think_log_home` VALUES ('1640', '2', '1900235708', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528789448');
INSERT INTO `think_log_home` VALUES ('1641', '2', '181211071', '', 'Windows 7--Chrome(65.0.3325.181)', '查看PHP文章ID --264', '1528789452');


-- ----------------------------
-- Records of think_liuyan
-- ----------------------------
INSERT INTO `think_liuyan` VALUES ('5', '匿名', '博主加个友链', '2656682755@qq.com', '1032646150', 'Win 10 ', '广东省广州市', '1521501500', '1528354340', '<p>回复你了</p>');
INSERT INTO `think_liuyan` VALUES ('83', 'flowerhua', '忍不住了点击来看下', '8755012888@qq.com', '1903022551', 'other', '广东省广州市', '1526638262', '1526722791', '<p>1</p>');
INSERT INTO `think_liuyan` VALUES ('84', '匿名', '感谢博主分享', '9487514827@qq.com', '1900235008', 'Windows 7', '广东省广州市', '1528975605', '1528975605', '');
INSERT INTO `think_liuyan` VALUES ('85', '驱蚊器翁去我', '呜呜呜呜', '1005988463@qq.com', '1901604641', 'Windows 7', '广东省深圳市', '1530238036', '1530238036', '');

-- ----------------------------
-- Table structure for think_news
-- ----------------------------
DROP TABLE IF EXISTS `think_news`;
CREATE TABLE `think_news` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `small_title` varchar(20) NOT NULL DEFAULT '',
  `catid` int(8) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_position` tinyint(1) NOT NULL DEFAULT '0',
  `is_head_figure` tinyint(1) NOT NULL DEFAULT '0',
  `is_allowcomments` tinyint(1) NOT NULL DEFAULT '0',
  `listorder` int(8) NOT NULL,
  `source_type` tinyint(1) DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `read_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `upvote_count` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_news
-- ----------------------------
INSERT INTO `think_news` VALUES ('1', '1', '2', '1', '', '<p>ttttttt</p>', 'ttt', '1', '0', '0', '0', '0', '1501439513', '1501634869', '-1', '7', '0', '0');
INSERT INTO `think_news` VALUES ('2', '1', '2', '1', '', '<p>tt</p>', 'tt', '0', '0', '0', '0', '0', '1501439814', '1501634848', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('3', '1', '2', '1', 'http://otwueljs0.bkt.clouddn.com/2017/07/a055e20170731023719851.jpg', '<p>ttt</p>', 't', '0', '0', '0', '0', '0', '1501439846', '1501439846', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('4', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '0', '1', '1', '0', '0', '1501441709', '1501441709', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('5', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '0', '1', '1', '0', '0', '1501441709', '1501441709', '1', '14', '0', '0');
INSERT INTO `think_news` VALUES ('6', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '0', '1', '1', '0', '0', '1501441709', '1501441709', '1', '0', '1', '0');
INSERT INTO `think_news` VALUES ('7', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '0', '1', '1', '0', '0', '1501441709', '1501441709', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('8', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '0', '1', '1', '0', '0', '1501441709', '1501441709', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('9', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '1', '1', '1', '0', '0', '1501441709', '1502972250', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('10', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '1', '1', '1', '0', '0', '1501441709', '1502972232', '1', '0', '0', '0');
INSERT INTO `think_news` VALUES ('11', '1', '2', '3', 'http://otwueljs0.bkt.clouddn.com/2017/07/ca132201707310308211515.jpg', '<p>ttttttt&#39;</p><p>gsdg</p>', 't', '1', '1', '1', '0', '0', '1501441709', '1504460156', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) DEFAULT NULL COMMENT '邮件或者手机',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `sex` int(10) DEFAULT '1' COMMENT '1男2女',
  `password` char(32) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `head_img` varchar(128) DEFAULT NULL COMMENT '头像',
  `integral` int(11) DEFAULT '0' COMMENT '积分',
  `money` int(11) DEFAULT '0' COMMENT '账户余额',
  `mobile` varchar(11) DEFAULT NULL COMMENT '认证的手机号码',
  `create_time` int(11) DEFAULT '0' COMMENT '注册时间',
  `update_time` int(11) DEFAULT NULL COMMENT '最后一次登录',
  `login_num` varchar(15) DEFAULT NULL COMMENT '登录次数',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常  0 禁用(待审核)   -1删除',
  `token` char(32) DEFAULT '0' COMMENT '令牌',
  `session_id` varchar(20) DEFAULT NULL,
  `visitor_num` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('22', '13922852654', '梦蝴思沧', '1', '21f7dff0460826dcc1d6b82e38389bf7', '1', null, '0', '0', null, '1530250511', '1530250511', null, '1', '0', null, '0');
INSERT INTO `think_user` VALUES ('2', '游客', '游客', '1', '', '1', '', '0', '0', '', '0', '0', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('3', '13456809021', '叶纯兮', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476676516', '1526960338', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('4', '15623580744', '墨宜修', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476425833', '1526960378', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('5', '12464565321', '上官晴妤', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476676464', '1526960335', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('6', '46521796132', '欧阳慕风', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476425750', '1526960386', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('7', '18809321929', '一川烟雨任沉浮', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476692255', '1526960356', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('8', '46512321103', '南音雨阁', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476692123', '1526960353', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('9', '18978924984', '阡陌凉笙', '1', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'http://q.qlogo.cn/qqapp/101250624/30ECD678B9626BBCFA4FA536E8F5D6A7/100', '0', '0', '', '1476433452', '1476433452', '0', '1', '0', '', '0');
INSERT INTO `think_user` VALUES ('11', '18573490929', '孤城潇陌', '1', '81e7ba022327ac349c21b5405b9cfa47', '1', null, '0', '0', '', '1528947715', '1528947715', '0', '1', '0', null, '0');
INSERT INTO `think_user` VALUES ('1', '2656682755@qq.com', '忘尘', '1', '81e7ba022327ac349c21b5405b9cfa47', '3', '', '0', '0', '', '1529736712', '1530157648', null, '1', '0', null, '0');
