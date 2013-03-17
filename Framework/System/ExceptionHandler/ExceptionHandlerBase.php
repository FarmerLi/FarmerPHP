<?php 
/**
 * ExceptionHandlerBase.php
 *
 * 异常处理基类
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\ExceptionHandler;

/**
 * 异常处理基类
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
abstract class ExceptionHandlerBase
{
    /**
     * 捕获未处理的PHP错误
     * 
     * @param int    $errno   错误号
     * @param string $errstr  错误消息
     * @param string $errfile 错误所属文件
     * @param int    $errline 错误所属行
     * 
     * @return void
     */
    abstract public function error($errno, $errstr, $errfile, $errline);
    
    /**
     * 捕获未处理的Exception
     * 
     * @param Exception $e 异常对象
     * 
     * @return void
     */
    abstract public function exception($e);
}
?>