<?php
/**
 * ControllerBase.php
 * 
 * 控制器基类
 * 
 * @package    Framework
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Controller;

/**
 * 控制器基类
 * 
 * @package    Framework
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
abstract class ControllerBase
{
    static $defaultAction = null;
    
    abstract public function validate($action);
}
