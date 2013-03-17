<?php
/**
 * HttpRequest.php
 * 
 * HTTP Request
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System;

use \Framework\System\Accessor\DataAccessor;
use \Framework\Exception\SystemException;

/**
 * HTTP Request
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class HttpRequest
{
    private $_post = null;
    private $_get = null;
    private $_files = null;
    private $_cookie = null;
    
    /**
     * 构造函数
     * 
     * @return void
     */
	private function __construct()
	{
	    $this->_post = new DataAccessor($_POST);
	    $this->_get = new DataAccessor($_GET);
	    $this->_files = new DataAccessor($_FILES);
	    $this->_cookie = new DataAccessor($_COOKIE);
	    
	    unset($_POST, $_GET, $_FILES, $_COOKIE);
	}
	
	/**
	 * 获取单例
	 * 
	 * @return HttpRequest
	 */
	public static function getInstance()
	{
	    static $instance = null;
	    if (null == $instance) {
	        $instance = new self();
	    }
	    return $instance;
	}
	
	/**
	 * 获得属性的魔术方法
	 *
	 * @param string $name 属性名称
	 *
	 * @return mixed
	 * @throws SystemException
	 */
	public function __get($name)
	{
	    switch ($name) {
	        case 'ip':
	            return $this->_getIp();
	        case 'userAgent':
	            return $_SERVER['HTTP_USER_AGENT'];
	        case 'method':
	            return $_SERVER['REQUEST_METHOD'];
	        case 'uri':
	            return $_SERVER['REQUEST_URI'];
	        case 'referer':
	            return $_SERVER['HTTP_REFERER'];
	        case 'host' :
	            return $_SERVER['HTTP_HOST'];
	        case 'scriptName':
	            return $_SERVER['SCRIPT_NAME'];
	        case 'protocol':
	            $arr = explode('/', $_SERVER['SERVER_PROTOCOL']);
	            return $arr[0];
	        case 'scheme':
	            return (isset($_SERVER['SCHEME']) ? $_SERVER['SCHEME'] : 'http') . '://';
	        case 'time':
	            return $_SERVER['REQUEST_TIME'];
	        default:
	            throw new SystemException('HttpRequest 中并不存在指定的属性：' . $name);
	    }
	
	}
	
	/**
	 * 获取GET
	 * 
	 * @param string $name     键名
	 * @param string $datatype 类型
	 * @param mixed  $default  默认值
	 * 
	 * @return mixed
	 */
	public function get($name = '', $datatype = '', $default = null)
	{
	    if ('' == $name) {
	        return $this->_get->toArray();
	    }
	    return $this->_get->get($name, $datatype, $default);
	}
	
	/**
	 * 获取GET
	 *
	 * @param string $name     键名
	 * @param string $datatype 类型
	 * @param mixed  $default  默认值
	 *
	 * @return mixed
	 */
	public function post($name = '', $datatype = '', $default = null)
	{
	    
	    if ('' == $name) {
	        return $this->_post->toArray();
	    }
	    return $this->_post->get($name, $datatype, $default);
	}
	
	/**
	 * 获取FILES
	 *
	 * @param string $name     键名
	 *
	 * @return mixed
	 */
	public function files($name = '')
	{
	    
	    if ('' == $name) {
	        return $this->_files->toArray();
	    }
	    return $this->_files->get($name, 'array', array());
	}
	
	/**
	 * 获取GET
	 *
	 * @param string $name     键名
	 * @param string $datatype 类型
	 * @param mixed  $default  默认值
	 *
	 * @return mixed
	 */
	public function cookie($name = '', $datatype = '', $default = null)
	{
	    
	    if ('' == $name) {
	        return $this->_cookie->toArray();
	    }
	    return $this->_cookie->get($name, $datatype, $default);
	}
	
    /**
     * 获取IP
     * 
     * @return string
     */
	private function _getIp()
	{
	    
	    if (isset($_SERVER)) {
	        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	            $realip = $_SERVER['HTTP_CLIENT_IP'];
	        } else {
	            $realip = $_SERVER['REMOTE_ADDR'];
	        }
	    } else {
	        if (getenv("HTTP_X_FORWARDED_FOR")) {
	            $realip = getenv("HTTP_X_FORWARDED_FOR");
	        } elseif (getenv("HTTP_CLIENT_IP")) {
	            $realip = getenv("HTTP_CLIENT_IP");
	        } else {
	            $realip = getenv("REMOTE_ADDR");
	        }
	    }
	    
	    return $realip;
	}
	
	/**
	 * 是否是ajax访问
	 * 
	 * @return bool
	 */
    public function isAjax()
    {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
        ) {
            return true;
        } else {
            return false;
        }
    }
}
