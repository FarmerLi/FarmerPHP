<?php
/**
 * index.php
 * 
 * 应用程序入口
 * 单入口模式, 所有应用必须由此派发
 * @TODO 如何将HTTP/CLI/REST合并成一个入口文件
 * 
 * @package   Framework
 * @author 	  Farmer.Li<lixu_01@126.com>
 * @copyright Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version   FarmerPHP 0.1 2011-03-01 farmerli.com $
 */

/**
 * 加载引导程序
 */
include './bootstrap.php';

/**
 * 运行应用程序
 */
$farmerPHP = Framework\System\FarmerPHP::getInstance();
$farmerPHP->runApplication();