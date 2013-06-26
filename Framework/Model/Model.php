<?php
/**
 * Model.php
 * 模型基类
 * 
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
use Framework\Model\Entity;
namespace Framework\Model;

/**
 * 模型基类
 * 
 * @package    Framework
 * @subpackage Model
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
use Framework\Exception\FieldException;

class Model
{
    /**
     * 实体类
     * @var string
     */
    protected $entityClass = '\\Framework\\Model\\Entity';
    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * 当前模型数据库驱动类型
     * @var string
     */
    protected $dbDirverType = 'Mysql';
    /**
     * 构造
     * 
     * @return void
     */
    public function __construct()
    {
        $this->setFields();
        $this->setRelations();
    }
    
    /**
     * 设置模型字段属性
     * 
     * @return void
     */
    abstract protected function setFields()
    {
        
    }
    
    /**
     * 设置模型关系
     * 
     * @return void
     */
    protected function setRelations()
    {
        //Set Model Relations
    }
    
    /**
     * 创建当前模型的一个实体
     * 
     * @param array $data 实体数据
     * 
     * @return Entity
     */
    final public function create($data = array())
    {
        $entityClass = $this->$entityClass;
        $entity = new $entityClass($this);
        if ($data) {
            $entity->set_attributes($data);
        }
        return $entity;
    }
    
    /**
     * 保持一个实体
     * 
     * @param Entity $entity 实体
     * 
     * @return Entity
     * @throws FieldException
     */
    final public function save(Entity $entity)
    {
        if ($entity->{$this->primaryKey} <= 0) {
            $this->_insert(& $entity);
        } else {
            $this->_update(& $entity);
        }
        return $entity;
    }
    
    /**
     * 插入一个实体, 必须通过save()方法调用，不允许直接调用
     * 
     * @param Entity $entity 实体
     * 
     * @return void
     */
    final private function _insert(Entity & $entity)
    {
        $this->getDbDriver()->insert($entity);
    }
    
    /**
     * 更新一个实体, 必须通过save()方法调用，不允许直接调用
     * 
     * @param Entity $entity 实体
     * 
     * @return void
     * @throws FieldException
     */
    final private function _update(Entity & $entity)
    {
        $this->getDbDriver()->update($entity);
    }
    
    /**
     * 执行一个查询
     * 
     * @param int $num   查询的数量
     * @param int $start 开始的位置
     * 
     * @return Array
     */
    final public function fetch($num = null, $start = 0)
    {
        
    }
    
    /**
     * 删除一条记录
     * 
     * @param int $id 主键
     * 
     * @return void
     * @throws FieldException
     */
    final public function delete($id)
    {
        if ($id < 0) {
            throw new FieldException(
                $this->primaryKey, 
                '主键必须为正整数', 
                FieldException::FIELD_INVALID
            );
        }
        $this->getDbDriver()->where($this->primaryKey, $id)->delete();
        $this->_reset();
    }
    
    /**
     * 获取DB驱动
     * 
     * @return DbDriver
     */
    protected function getDbDriver()
    {
        return DbDriver::getInstance($this);
    }
    
    /**
     * 重置模型
     * 
     * @return void
     */
    final private function _reset()
    {
        
    }
}