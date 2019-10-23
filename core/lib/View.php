<?php
namespace core\lib;
/**
 *视图基类
**/
class View
{
	protected $module;
	protected $controller;
	protected $filePath;

	public function __construct($module, $controller)
	{
		$this->module = $module;
		$this->controller = $controller;
		$this->filePath = APP . '/' . $this->module . '/view/';
	}

	public function display($action)
	{
		$layoutFile = $this->filePath . $this->controller . '/' . $action . '.html';
		include($layoutFile);
		
	}
}