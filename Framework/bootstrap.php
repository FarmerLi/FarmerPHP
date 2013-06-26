<?php
/**
 * bootstrap.php
 * 
 * 系统引导程序
 * 
 * @package   Framework
 * @author 	  Farmer.Li<lixu_01@126.com>
 * @copyright Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version   FarmerPHP 0.1 2011-03-01 farmerli.com $
 */

/**
 * 获得框架所在目录的物理路径
 */
define('FRAMEWORK', dirname(__FILE__));

/**
 * 获得根目录的物理路径
 */
define('ROOT', dirname(FRAMEWORK));

/**
 * 设置项目所属路径
 */
define('PROJECTS', ROOT . '/Projects/');

/**
 * 设置日志保存路径
 */
define('LOGS', ROOT . '/Logs/');

/**
 * 注册自动加载
 */
include FRAMEWORK . '/System/AutoloadClass.php';
spl_autoload_register(array('\Framework\System\AutoloadClass', 'load'));

/**
 * 加载公共函数库
 */
include FRAMEWORK . '/System/CommonFunction.php';
