<?php
/**
 * HttpApplication.php
 * 
 * Http入口程序
 * 
 * @package    Framework
 * @subpackage Application
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Application;

use Framework\System\HttpRequest;
use Framework\Application\ApplicationBase;
use Framework\Library\XmlResolver;
use Framework\Exception\SystemException;
use Framework\System\Routers\HttpGetRouter;

/**
 * http入口程序
 * 
 * @package    Framework
 * @subpackage Application
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class HttpApplication extends ApplicationBase
{
    /**
     * 异常处理句柄
     * 
     * @var public
     */
    static public $exceptionHandler = '\\Framework\\System\\ExceptionHandler\\HttpExceptionHandler';
    
    /**
     * 获取当前运行的app名
     * 
     * @return string
     */
    static public function getAppName()
    {
        $host = HttpRequest::getInstance()->host;
		$domains = XmlResolver::loadConfig()->domains();
        $app = $domains->xpath("//app[host='{$host}']");
	    if (null === $app) {
	        throw new SystemException('未获取到域名对应的应用!');
	    }
        $app = current($app);
        return ucfirst($app->attributes->name);
    }
    
    /**
     * 获取当前应用路由器
     * Http应用程序默认使用 HttpGetRouter 方式路由
     * 
     * @return HttpRouter
     */
    public function getRouter()
    {
        return new HttpGetRouter();
    }
}
