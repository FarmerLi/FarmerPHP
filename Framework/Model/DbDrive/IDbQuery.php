<?php
/**
 * IDbQuery.php
 *
 * 数据库查询接口
 *
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Model\DbDrive;

/**
 * 数据库查询接口
 *
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
interface IDbQuery
{
    /**
     * 执行sql语句
     * 
     * @param string $sql sql语句
     * 
     * @return resource
     */
    public function execute($sql);
    
    /**
     * 将结果解析为数组
     * 
     * @param string $resource 资源
     * 
     * @return array
     */
    public function fetchArray($resource);
    
    /**
     * 获取最后插入数据行的ID
     * 
     * @return int
     */
    public function insertId();
}