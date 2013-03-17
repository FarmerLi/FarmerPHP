<?php
/**
 * XmlResolver.php
 * 
 * Xml 解析器
 * 
 * @package    Framework
 * @subpackage Library
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Library;

use \Framework\Exception\SystemException;
use \SimpleXMLElement;
use \stdClass;
/**
 * xml解析器
 * 
 * @package    Framework
 * @subpackage Library
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class XmlResolver
{
	private $_node;
	
	/**
	 * 构造
	 * 
	 * @param SimpleXMLElement $node
	 * 
	 * @return void
	 */
	private function __construct(SimpleXMLElement $node)
	{
		$this->_node = $node;
	}

	/**
	 * 模式方法 获取节点属性、值
	 * 
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function __get($name)
	{
	    $node = (array)$this->_node;
		if ('attributes' === $name) {
		    $attributes = isset($node['@attributes']) ? $node['@attributes'] : array();
		    return new XmlAttribute($attributes);
		}
		if ('text' === $name) {
		    return isset($node[0]) ? $node[0] : null;
		}
		
		if ('nodeName' == $name) {
		    return $this->_node->getName();
		}
	}
	
	/**
	 * 魔术方法 快捷查找节点
	 * 
	 * @param string $func 方法名
	 * @param array  $args 参数列表
	 * 
	 * @return mixed
	 */
	public function __call($func, $args)
	{
		$attr = isset($args[0]) ? $args[0] : '';
		$value = isset($args[1]) ? $args[1] : '';
		return $this->find($func, $attr, $value);
	}
	
	/**
	 * $attr == text 时 按xml值查找，其他的按属性
	 * 
	 * @param string $nodeName 节点名
	 * @param string $attr	   属性名
	 * @param string $value	   属性值
	 * 
	 * @return mixed
	 */
	public function find($nodeName, $attr = '', $value = '')
	{
	    $condition = '';
	    $path = '';
	    if ('' != $attr) {
		    $condition = '@' . $attr;
		}
		if (null != $value && '' != $attr) {
		    $condition .= '=\'' . $value . '\'';
		}
		$path = $nodeName;
		if ('' != $condition) {
		    $path .= '[' . $condition . ']';
		}
		$resolver = $this->xpath($path);
		return count($resolver) > 1 ? $resolver : $resolver[0];
	}
	
	/**
	 * 使用xpath进行查找
	 * 
	 * @param string $rule xpath规则串
	 * 
	 * @return array
	 */
	public function xpath($rule)
	{
		$nodes = $this->_node->xpath($rule);
		if (0 === count($nodes)) {
		    return null;
		}
		$resolver = array();
		foreach ($nodes as $node) {
		    $resolver[] = new XmlResolver($node);
		}
	    return $resolver;
	}
	
	public function getParent()
	{
	    var_dump($this->_node->xpath('app[host=\'example.php.com\']'));
	}
	
	/**
	 * 载入Xml文件
	 * 
	 * @param string $path xml文件地址
	 * 
	 * @return void
	 * @throws SystemException
	 */
	public static function load($path)
	{
		$lists = array();
		if (!isset($lists[$path])) {
			if (!is_file($path)) {
				throw new SystemException(
					'File(' . $path . ') Not Found', 
					SystemException::FILE_NOT_FOUND
				);
			}
			//@TODO try...catch..
			$xml = simplexml_load_file($path);
			$lists[$path] = new XmlResolver($xml);	
		}
		return $lists[$path];
	}
	
	/**
	 * 载入配置文件
	 * 
	 * @param string $type 配置文件类型
	 * 
	 * @return void
	 * @throws SystemException
	 */
	public static function loadConfig($type = 'Framework')
	{
		if ('Framework' === $type) {
			$path = FRAMEWORK . '/config/config.xml';
		} else {
			$path = PROJECTS . $type . '/Config/config.xml';
		}
		return self::load($path);
	}
}

/**
 * xml属性
 * 
 * @package    Framework
 * @subpackage Library
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class XmlAttribute 
{
    /**
     * 属性数组
     * @var private
     */
    private $_attributes = array();
    
    /**
     * 构造
     * 
     * @param array $attributes
     * 
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->_attributes = $attributes;
    }
    
    /**
     * 获取属性
     * 
     * @param string $name 属性名
     * 
     * @return string
     */
    public function __get($name) 
    {
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : null;
    }
}