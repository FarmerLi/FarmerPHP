<?php
/**
 * IDbTool.php
 *
 * 数据库工具接口
 *
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Model\DbDrive;

/**
 * 数据库工具接口
 *
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
interface IDbTool
{
    /**
     * 创建一个新的数据库
     * 
     * @param string $dbName 数据库名
     * 
     * @return boolean
     */
    public function createDB($dbName);
    
    /**
     * 创建数据表
     * 
     * @param string $tableName 数据表名称
     * 
     * return boolean
     */
    public function createTable($tableName);
    
    /**
     * 查询当前连接下的所有库名
     * 
     * @return array
     */
    public function showDBs();
    
    /**
     * 查询当前库下的所有表名
     * 
     * @return array
     */
    public function showTables();
    
    /**
     * 删除数据库
     * 
     * @param string $dbName 数据库名
     * 
     * @return boolean
     */
    public function dropDB($dbName);
    
    /**
     * 删除数据表
     * 
     * @param string $tableName 表名
     * 
     * @return boolean
     */
    public function dropTable($tableName);
    
    /*public function alter();*/
}