<?php
/**
 * 系统级异常
 * 
 * php version 5.3+
 * 
 * @package    Framework
 * @subpackage Exception
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Exception;

/**
 * 系统级异常
 * 
 * @package    Framework
 * @subpackage Exception
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class SystemException extends \Exception
{
	// 未知错误
	const ERROT_UNKNOWN = 0;
	// 未知的类
	const CLASS_NOT_FOUND = 1;
	// 文件不存在
	const FILE_NOT_FOUND = 2;
}