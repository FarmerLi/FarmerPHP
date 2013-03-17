<?php
/**
 * Index.php
 * 
 * 首页
 * 
 * @package    Projects
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Projects\Example\Controller;

use Framework\Controller\HttpController;

/**
 * 首页
 * 
 * @package    Projects
 * @subpackage Controller
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class Index extends HttpController
{
    public function index()
    {
        echo 'holle world!';
    }
}
