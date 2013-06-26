<?php
/**
 * CookieAccessor.php
 * 
 * Cookie存取器
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\Accessor;

use \Exception;
use \Framework\System\Accessor\DataAccessor;

/**
 * Cookie Accessor
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class CookieAccessor extends DataAccessor
{
    /**
     * (non-PHPdoc)
     * @see Framework\System\Accessor.DataAccessor::__set()
     */
    public function __set($name, $val)
    {
        throw new Exception('Cookie 请通过set()方法设置!');
    }
    
    /**
     * (non-PHPdoc)
     * @see Framework\System\Accessor.DataAccessor::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        throw new Exception('Cookie 请通过set()方法设置!');
    }
    
    /**
     * 设置cookie
     * 
     * @param string $name     键名
     * @param mixed  $val      值
     * @param int    $expire   生存周期
     * @param string $path     路径
     * @param string $domain   域名
     * @param bool   $secure   安全
     * @param bool   $httponly 是否只能通过HTTP协议访问
     * 
     * @return void
     */
    public function set(
        $name, 
        $val = null, 
        $expire = null, 
        $path = null, 
        $domain = null, 
        $secure = null, 
        $httponly = null
    )
    {
        setcookie($name, $val, $expire, $path, $domain, $secure, $httponly);
        if ($expire > 0) {
            $this->$name = $val;
        } else {
            unset($this->$name);
        }
    }
}
?>