<?php
/**
 * View.php
 *
 * 视图类
 *
 * @package    Framework
 * @subpackage View
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\View;

/**
 * 视图类
 *
 * @package    Framework
 * @subpackage View
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class View
{
    public $viewName = '';
    
    private $vars = array();
    
    public function __construct($viewName)
    {
        $this->viewName = $viewName;
    }
    
    public function assign($name, $value)
    {
        $this->vars[$name] = $value;
    }
    
    public function render()
    {
        
    }
}