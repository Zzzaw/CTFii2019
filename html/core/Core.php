<?php
namespace core;

class Core
{
	public static $classMap = array();//记录已通过load()来include的类文件

	static public function run()//启动框架
	{
		$route = new \core\lib\Route;//启动路由
		$module = $route->module;
		$controller = $route->controller;
		$action = $route->action;
		$param = $route->param;
		self::execController($module, $controller, $action, $param);

		
	}

	static public function execController($module, $controller, $action, $param)
	{
		//创建控制器并执行action(传入参数)
		$controllerClass = '\\application\\' . $module . '\\controller\\' . $controller;

		try{
			$parameters = (new \ReflectionClass($controllerClass))->getMethod($action)->getParameters();
        }
        catch(\ReflectionException $e)
        {
        	p('something wrong');
        	exit();
        }

    	
    	$dispatch = new $controllerClass($module,$controller);//创建控制器
    	if(!empty($parameters)){//有参方法
	    	foreach($parameters as $v) {
				//将param(键值对)中的参数值按控制器的方法的参数顺序排好
				if(isset($param[$v->name])){
					$param_list[] = $param[$v->name];
				}
			}
			//p($param_list);//test
			// 以下等同于：$dispatch->$action($param_list)
	        call_user_func_array(array($dispatch, $action), $param_list);
    	} else {//无参方法
    		$dispatch->$action();
    	}
	}

	static public function autoload($class)//自动加载类库//参数是要自动引用的类
    {
    	/**
         * 这个方法要实现的功能是：1.传入的类名转换为类文件地址； 2.include这个类文件
         * 如:传入的$class=\core\Route 转换为 ROOT/core/Route.php
         */
        
        if(isset($classMap[$class])) {
  			//引入前先判断classMap中是否已经有这个类，避免重复引入
            return true;
        } else {
            $class = str_replace('\\','/',$class);
            $file = ROOT . '/' . $class . '.php';
            if(is_file($file)) {
            	//判断文件是否存在
                include $file;             
                self::$classMap[$class] = $class;//引入后要记录到classMap中
            } else {
                exit('class ' . $class . ' does not exist');
                p('something wrong');
                exit();
            }
        }

    }
}