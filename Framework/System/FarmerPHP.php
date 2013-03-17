<?php
/**
 * FarmerPHP.php
 *
 * 框架应用层
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System;

use Framework\Exception\SystemException;

/**
 * 框架应用层
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class FarmerPHP
{
    const APP_TYPE_CLI = 'cli';
    
    const APP_TYPE_HTTP = 'http';
    
    public $runEnvironment = 'http';
    
    public $applications = array(
        self::APP_TYPE_CLI => '\\Framework\\Application\\CliApplication',
        self::APP_TYPE_HTTP => '\\Framework\\Application\\HttpApplication'
    );
    
    /**
     * 构造函数
     * 
     * @return void
     */
    private function __construct()
    {
        $application = $this->getApplication();
        $handler = $application::$exceptionHandler;
        if (null == $handler) {
            throw new SystemException('未获取到异常处理句柄!');
        }
        $exception = new $handler;
        set_error_handler(array($exception, 'error'));
        set_exception_handler(array($exception, 'exception'));
        $this->runEnvironment = $this->_getEnvironment();
    }
    
    /**
     * 单例, 获取实例
     * 
     * @return FarmerPHP
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self;
        }
        return $instance;
    }
    
    /**
     * 运行应用程序
     * 
     * @return void
     */
    public function runApplication()
    {
        /**
         * @todo 应用程序执行前， 考虑是否加入钩子功能
         */
        
        $application = $this->getApplication();
        
        $application::getInstance()->run();
        
        /**
         * @todo 应用程序执行后
         */
    }
    
    /**
     * 获取应用程序
     * 
     * @return Application
     */
    public function getApplication()
    {
        if (isset($this->applications[$this->runEnvironment])) {
            return $this->applications[$this->runEnvironment];
        } else {
            throw new SystemException('Not Found Application');
        }
    }
    
    /**
     * 获取应用程序类型
     * 
     * return string
     */
    private function _getEnvironment()
    {
        $spai = php_sapi_name();
        if (self::APP_TYPE_CLI === $spai) {
            return self::APP_TYPE_CLI;
        } else {
            return self::APP_TYPE_HTTP;
        }
    }
}
?>