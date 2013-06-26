<?php 
/**
 * ExceptionHandler.php
 *
 * HTTP应用程序异常处理
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    FarmerPHP 0.1 2011-03-01 farmerli.com $
 */
namespace Framework\System\ExceptionHandler;

use Framework\System\HttpRequest;
use Framework\Library\XmlResolver;
use \ErrorException;
use Framework\Exception\SystemException;

/**
 * HTTP应用程序异常处理
 *
 * @package    Framework
 * @subpackage System
 * @author 	   Farmer.Li<lixu_01@126.com>
 * @copyright  Copyright (c) 2012-2013  (http://www.farmerli.com/farmerPHP)
 * @version    Release: 0.1
 */
class HttpExceptionHandler extends ExceptionHandlerBase
{
    /**
     * 捕获未处理的PHP错误
     * 
     * @param int    $errno   错误号
     * @param string $errstr  错误消息
     * @param string $errfile 错误所属文件
     * @param int    $errline 错误所属行
     * 
     * @return void
     * @throws ErrorException
     */
    public function error($errno, $errstr, $errfile, $errline)
    {
	    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
    
    /**
     * 捕获未处理的Exception
     * 
     * @return void
     */
    public function exception($e)
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Error', true, 500);
        if (XmlResolver::loadConfig()->environment()->debug()->text) {
            header('Content-Type:text/html; charset=utf-8');
            if (HttpRequest::getInstance()->isAjax()) {
                printf(
                    "Message: %s\nFile: %s(%s)\nTrace: %s",
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine(),
                    $e->getTraceAsString()
                ); 
            } else {
                $format = self::createPageFormat();
                printf(
                    $format,
                    $e->getMessage(),
                    get_class($e),
                    $e->getCode(),
                    $e->getFile(),
                    $e->getLine(),
                    $e->getTraceAsString()
                );
            }
        } else {
            echo '当前页面发生错误, 请尝试刷新页面或联系管理员!(HTTP 500)';
        }
    }
    
    /**
     * 创建debug页面
     * 
     * @return string
     */
    private function createPageFormat()
    {
        return '
        <html>
        <head>
            <title>HTTP ERROR 500</title>
        </head>
        <body>
            <div style="margin:40px auto;  border:2px solid #ccc; font-size:14px; line-height:1.5; overflow: auto;">
                <h3 style="font-size: 16px; padding: 0; margin:0; background: #FF6633">HTTP ERRNO: 500</h3>
                <div style="padding: 5px;">
                    <p><b>MESSAGE: </b>%s</p>
                    <p><b>EXCEPTION: </b>%s (<b>CODE:</b>%s)</p>
                    <p><b>FILE: </b>%s (<b>LINE: </b>%s)</p>
                    <pre>%s</pre>
                </div>
            </div>
        </body>
        </html>
        ';
    }
}
?>