<?php 
/**
 * AutoloadClass.php
 *
 * 类文件自动加载程序
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System;

use Framework\Application\HttpApplication;
use Framework\Library\XmlResolver;
use Framework\Exception\SystemException;
/**
 *
 * 类文件自动加载程序
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class AutoloadClass
{
    /**
     * 解决本类中要用到的类加载问题, 默认按namespace模式加载
     * 
     * @var private
     */
    private static $defaultLoadByNs = array(
        'Framework\Library\XmlResolver', 
        'Framework\Exception\SystemException'
    );
    
    /**
     * 加载文件
     * 
     * @param string $cls 类名
     * 
     * @return void
     * @throws SystemException
     */
    public static function load($cls)
    {
        $arr = explode('\\', $cls);
        $kls = array_pop($arr);
        $ns = implode('\\', $arr);
        
        $package = null;
        if (!in_array($cls, self::$defaultLoadByNs)) {
            $package = self::getPackage($ns);
        }
        if (null != $package) {
            $path = sprintf(
                '%s/%s/%s.php',
                ROOT,
                $package->attributes->path,
                $kls
            );
            
        } else {
            $path = sprintf("%s/%s/%s.php", ROOT, implode($arr, '/'), $kls);
        }
        if (file_exists($path)) {
            require $path;
        } else {
            throw new SystemException(
                sprintf(
                    "%s 文件不存在, 类( %s )加载失败!",
                    $path,
                    $cls
                ),
                SystemException::CLASS_NOT_FOUND
            );
        }
    }
    
    /**
     * 获取命名空间所属package
     * 一个命名空间只隶属于一个package
     * 项目下的packages.xml的优先级较框架的packages.xml高
     * 
     * @param string $ns 命名空间
     * 
     * @return XmlResolver
     * @throws SystemException
     */
    public static function getPackage($ns)
    {
        static $packages = null;
        if (null === $packages) {
            $frameworkPackages = FRAMEWORK . '/Config/packages.xml';
            /**
             * @TODO 引入App的Packages
             */
            //$app = HttpApplication::getInstance()->getApp();
            //$projectPackages = ROOT . 
            try {
                $packages = XmlResolver::load($frameworkPackages);
            } catch (SystemException $e) {
                if ($e->getCode() == SystemException::FILE_NOT_FOUND) {
                    return null;
                } else {
                    throw $e;
                }
            }
            $result = $packages->xpath("package[namespace=\"{$ns}\"]");
            if (count($result) > 0) {
                return $result[0];
            } else {
                return null;
            }
        }
    }
}
?>