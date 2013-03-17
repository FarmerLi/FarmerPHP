<?php
/**
 * DataAccessor.php
 * 
 * 数据存取器
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\Accessor;

use Framework\Exception\SystemException;

use \ArrayAccess;
use \Exception;

/**
 * Data Accessor
 * 
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class DataAccessor implements ArrayAccess
{
    private $_data = array();
    private $_accessorMethod = null;
    
    /**
     * 构造函数
     * 
     * @param array  $data           数据
     * @param string $accessorMethod 取数据的方法
     * 
     * @return void
     * @throws Exception
     */
    public function __construct($data, $accessorMethod = null)
    {
        $this->_data = $data;
        $this->_accessorMethod = $accessorMethod;
    }
    
    /**
     * 魔术方法, 设置值
     * 
     * @param string $name 键名
     * @param mixed  $val  键值
     * 
     * @return void
     */
    public function __set($name, $val)
    {
        $this->_data[$name] = $val;
    }
    
    /**
     * 魔术方法, 获取值
     * 
     * $param string $name 键名
     * 
     * @return void
     */
    public function __get($name)
    {
        if (null === $this->_accessorMethod) {
            return isset($this->_data[$name]) ? $this->_data[$name] : null;
        }
        return call_user_func_array(
            array($this->_data, $this->_accessorMethod),
            $name
        );
        
    }
    
    /**
     * 魔术方法, 判断键是否存在
     * 
     * @param $string $name 键名
     * 
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }
    
    /**
     * 魔术方法, 销毁指定键
     * 
     * @param $string $name 键名
     * 
     * @return bool
     */
    public function __unset($name)
    {
        if (isset($this->_data[$name])) {
            unset($this->_data[$name]);
        }
    }
    
    /**
     * 设置
     * 
     * @param string $name 名称 
     * @param mixed  $val  值
     */
    public function set($name, $val)
    {
        $this->$name = $val;
    }
    
    /**
     * 获取数据并格式化
     * 
     * @param string $name     键名
     * @param string $datatype 数据类型
     * @param mixed  $default  默认值
     * 
     * @return mixed
     * @throws SystemException
     */
    public function get($name, $datatype, $default = null) 
    {
        $value = $this->$name;
        switch ($datatype) {
            case 'string' : 
                null === $default && $default = '';
                $result = $value != null ? strval($value) : $default;
                break;
            case 'int' : 
            case 'intgeter' :
                null === $default && $default = 0;
                $result = $value != null ? intval($value) : $default;
                break;
            case 'double' :
            case 'float' : 
                null === $default && $default = 0.00;
                $result = $value != null ? floatval($value) : $default;
                break;
            case 'array' :
                null === $default && $default = array();
                $result = ($value != null && is_array($value)) ? $value : $default;
                break;    
            case 'bool' :
                null === $default && $default = false;
                $result = $default != null ? (bool)$value : $default;
                break;
            case 'object' :
                $result = ($value != null && is_object($value)) ? $value : $default;
                break;
            case 'json' :
                $result = $value != null ? json_decode($value) : $default;
                break;
            default:
                throw new SystemException(
                    '允许的数据类型: string, int, intgeter, 
                    double, float, array, bool, object, json'
                );
        }
        return $result;
    }
    
    /**
     * 统计
     * 
     * @return int
     */
    public function count()
    {
        return count($this->_data);
    }
    
    /**
     * 返回一个数组
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->_data;
    }
    
    /**
     * ====================================================
     * 实现 ArrayAccess 接口
     * ====================================================
     */
    
    /**
     * 用数组的方式来判断某个元素是否存在
     *
     * @param mixed $offset 属性名称
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
    
    /**
     * 用数组的方式访问某个属性
     *
     * @param string $offset 属性名称
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->$offset) ? $this->$offset : null;
    }
    
    /**
     * 通过数组的方式给属性赋值
     *
     * @param string $offset 属性名称
     * @param mixed  $value  属性值
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
    
    /**
     * 通过数组的方式删除某个属性
     *
     * @param string $offset 属性名称
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}
