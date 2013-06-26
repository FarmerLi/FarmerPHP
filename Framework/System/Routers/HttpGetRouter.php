<?php
/**
 * HttpGetRouter.php
 *
 * Http GET方式路由器
 *
 * @package    Framework
 * @subpackage System\Routers
 * @author     Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\Routers;

use Framework\System\Routers\RouterBase;
use Framework\System\HttpRequest;
use Framework\Exception\SystemException;
/**
 * Http GET方式路由器
 * 此路由模式的URL格式：
 * http://www.exmple.com/CONTROLLER.php?a=ACTION
 *
 * @package    Framework
 * @subpackage System\Routers
 * @author     Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class HttpGetRouter extends RouterBase
{
    /**
     * 默认的action变量名
     * 
     * @var string
     */
    protected $defaultActionName = 'a';
    
    /**
     * 获取回调控制器和方法
     * return data format: array(controller, action)
     * 
     * @return array
     */
    public function getCallable()
    {
        $fullUrl = $this->getFullUrl();
        $parseResult = $this->parse($fullUrl);
        $defaultScript = $this->getDefaultScript();
        
        if ('/' == $parseResult['path'][strlen($parseResult['path']) - 1]) {
            $parseResult['path'] .= $defaultScript;
        }
        $scriptName = substr($parseResult['path'], strrpos($parseResult['path'], '/') + 1);
        if (in_array($scriptName, $this->defaultIndexs)) {
            $parseResult['path'] = str_replace($scriptName, $defaultScript, $parseResult['path']);
        }
        
        $pathinfo = pathinfo($parseResult['path']);
        if ($this->defaultExt != strtolower($pathinfo['extension'])) {
            return null;
        }
        $shotNs = $this->_getShotNsByDirName($pathinfo['dirname']);
        $controller = sprintf(
            "%s\\Controller%s%s",
            $this->getProjectNamespace(),
            $shotNs,
            ucfirst($pathinfo['filename'])
        );
        try {
            $defaultAction = $controller::$defaultAction ? $controller::$defaultAction : null;
        } catch (SystemException $e) {
            if ($e->getCode() == SystemException::CLASS_NOT_FOUND) {
                return null;
            } else {
                throw $e;
            }
        }
        $action = HttpRequest::getInstance()->get($this->defaultActionName, 'string', $defaultAction);
        
        if (null == $action) {
            return null;
        }
            
        return array(
            $controller,
            $action
        );
    }
    
    private function _getShotNsByDirName($dirname)
    {
        if ('' == $dirname) {
            return '\\';
        }
        $ns = str_replace('/', '\\', $dirname);
        if ('\\' != $dirname[strlen($dirname) - 1]) {
            $ns .= '\\';
        }
        return $ns;
    }
    
    /**
     * 获取完整地址
     * 
     * @return string
     */
    protected function getFullUrl()
    {
        $request = HttpRequest::getInstance();
        return sprintf(
        	"%s%s%s",
            $request->scheme,
            $request->host,
            $request->uri
        );
    }
    
    /**
     * 解析地址
     * 
     * @param string $url 地址
     * 
     * @return array
     */
    protected function parse($url)
    {
        return parse_url($url);
    }
    
}