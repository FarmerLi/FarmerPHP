<?php
/**
 * AplicationBase.php
 * 
 * 应用程序基类
 * 
 * @package    Framework
 * @subpackage Application
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Application;

use Framework\Exception\SystemException;

use \Framework\Library\XmlResolver;

/**
 * 应用程序基类
 * 
 * @package    Framework
 * @subpackage Application
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
abstract class ApplicationBase
{ 
    /**
     * 应用名
     * 
     * @var string
     */
    public $appName = null;
    
    
    /**
     * 控制器
     *
     * @var string
     */
    public $controller = null;
    
    
    /**
     * 动作
     *
     * @var string
     */
    public $action = null;
    
    
    /**
     * 异常句柄
     *
     * @var string
     */
    static public $exceptionHandler = null;

    /**
     * 单例 获取应用程序实例
     * 
     * @return Application
     */
    public static function getInstance()
    {
   		static $instance = null;
		if (null !== $instance) {
			return $instance;
		}
		
		$cls = get_called_class();
        $appName = $cls::getAppName();
        if (null === $appName) {
            throw new SystemException('Not Found App!');
        }
        $className = substr($cls, strrpos($cls, '\\') + 1);
        $appClass = '\\Projects\\' . $appName . '\\Application\\' . $className;
        try {
            if (class_exists($appClass) ) {
                if (get_parent_class($appClass) === $cls) {
                    $cls = $appClass;
                } else {
                    throw new SystemException($appClass . ' must extends ' . $cls);
                }
            }
        } catch (SystemException $e) {
            if ($e->getCode() !== SystemException::CLASS_NOT_FOUND) {
                throw $e;
            }
        }
        $instance = new $cls;
        
        $instance->appName = $appName;
        return $instance;
    } 
    
	/**
	 * 运行应用程序
	 * 
	 * @return void
	 */
	public function run()
	{
	    $callable = $isVaild = null;
	    $callable = $this->getRouter()->getCallable();
	    if (!is_callable($callable)) {
	        throw new SystemException('未知的请求!');
	        //@TODO Show Not Found(404)
	    }
	    list($controller, $action) = $callable;
	    $controllerInstance = new $controller;
	    if (call_user_func_array(array($controllerInstance, 'validate'), array($action))) {
    	    /**
    	     * @todo Create action's paramList
    	     */
    	    $param = array();
    	    $this->controller = $controller;
    	    $this->action = $action;
    	    call_user_func_array(array($controllerInstance, $action), $param);
	    }
	}
	
	/**
	 * 获取当前应用的路由器
	 * 
	 * @return RouterBase
	 */
	abstract protected function getRouter();
	
	/**
     * 获取当前运行的app名
     * 
     * @return string
     */
	static public function getAppName()
	{
	    /**
	     * @todo return appName
	     */
	    return null;
	}
}
