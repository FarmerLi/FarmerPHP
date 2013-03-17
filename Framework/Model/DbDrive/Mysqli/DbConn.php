<?php 
/**
 * DbConn.php
 * 
 * Mysqli数据库连接器
 * 
 * @package    Framework
 * @subpackage Library
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Model\DbDrive\Mysqli;

use Framework\Model\DbDrive\IDbConn;

/**
 * Mysqli数据库连接器
 * 
 * @package    Framework
 * @subpackage Library
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */

class DbConn implements IDbConn
{
    public $dbLink = null;
    
    /**
     * 连接数据库
     * 
     * @param array $config 配置
     * 
     * @return resource
     */
    public function connect($config)
    {
        
    }
    
    /**
     * 关闭连接
     * 
     * @return void
     */
    public function close()
    {
    
    }
    
    /**
     * 设置编码
     * 
     * @param string $charset 编码
     * 
     * @return void
     */
    public function setCharset($charset)
    {
    
    }
    
    /**
     * 选择库
     * @param string $dbName 数据库名
     * 
     * @return void
     */
    public function selectDB($dbName)
    {
    
    }
    
    
}