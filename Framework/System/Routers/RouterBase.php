<?php
/**
 * RouterBase.php
 *
 * 路由器接口
 *
 * @package    Framework
 * @subpackage System
 * @author     Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\Routers;

/**
 * 路由器接口
 * 所有路由器必须实现此接口
 *
 * @package    Framework
 * @subpackage System
 * @author     Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
 use Framework\System\FarmerPHP;

abstract class RouterBase
 {
     /**
      * 要转向到默认页面的页面
      * 
      * @var array
      */
     protected $defaultIndexs = array(
         'index.htm',
         'index.html',
         'defualt.htm',
         'defualt.html'
     );
     /**
      * 默认页面
      * 
      * @var string
      */
     protected $defaultIndex = 'index';
     
     /**
      * 默认的文件访问后缀
      * 
      * @var string
      */
     protected $defaultExt = 'php';
     
     /**
      * 获取项目
      */
     protected function getProjectNamespace()
     {
         $application = FarmerPHP::getInstance()->getApplication();
         $appName = $application::getAppName();
         return '\\Projects\\' . $appName;
     }
     
     /**
      * 默认脚本文件
      * 
      * @return string
      */
     protected function getDefaultScript()
     {
         return $this->defaultIndex . '.' . $this->defaultExt;
     }
     
     /**
      * 获取回调控制器和方法
      * return data format: array(controller, action)
      * 
      * @return array
      */
     abstract public function getCallable();
 }
 ?>