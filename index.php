<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */
define('ROOT',dirname(__FILE__));//当前框架所在的根目录
define('CORE',ROOT.'/core');//框架的核心文件所处的目录
define('APP',ROOT.'/application');//项目文件（包括控制器、模型等）所处的目录

define('DEBUG',true);//是否要开启调试模式

//若开启调试模式，则开启错误显示；若关闭，不显示
if(DEBUG)
{
    ini_set('display_error','On');
} else {
    ini_set('display_error','Off');
}

// 加载配置文件
$config = require(ROOT . '/conf/config.php');

include CORE.'/common/function.php';//加载函数库
include CORE.'/Core.php';//加载框架的核心文件


spl_autoload_register('\core\Core::autoload');//当new一个类，而这个类不存在时，会触发这个方法

\core\Core::run();//启动框架




