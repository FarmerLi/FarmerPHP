<?php
/**
 * ControllerException.php
 * 字段异常
 * 
 * @package    Framework
 * @subpackage Exception
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\Exception;

/**
 * 字段异常
 * 
 * @package    Framework
 * @subpackage Exception
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class FieldException extends \Exception
{
    public $field = '';
    
    const FIELD_INVALID = 1;
    
    public function __construct($field, $message, $code)
    {
        $this->Field = $field;
        parent::__construct($message, $code); 
    }
}