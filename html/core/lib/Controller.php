<?php
namespace core\lib;
/**
 *控制器基类
**/
class Controller
{
	 /**
     * @var \core\lib\View 视图类实例
     */
    protected $controller;
    protected $module;
    protected $view;

    public function __construct($module, $controller)
    {
    	$this->module = $module;
    	$this->controller = $controller;
    	$this->view = new \core\lib\View($this->module, $this->controller);
    }

    public function display($action)
    {
    	$this->view->display($action);
    }
}