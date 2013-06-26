<?php
/**
 * HttpController.php
 * 
 * HTTP控制器
 * 
 * @package    Framework
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Controller;

use Framework\Controller\ControllerBase;

/**
 * HTTP控制器
 * 
 * @package    Framework
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class HttpController extends ControllerBase
{
    static $defaultAction = 'index';
    
    public function validate($action)
    {
        return true;
    }
}
