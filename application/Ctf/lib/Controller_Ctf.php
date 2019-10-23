<?php
namespace application\Ctf\lib;
use core\lib\Controller;

Class Controller_Ctf extends Controller
{
	//重写
	public function __construct($module, $controller)
    {
    	header("Content-Type:text/html;charset=utf-8");
    	require_once('application/Ctf/common/function/function.php');//TODO
    	parent::__construct($module, $controller); 

    }
	//重写
	public function display($action)
    {
    	session_start();
    	if($_SESSION['islogin']){
    		include('application/Ctf/view/common/header_logged_in.html');
    	}
    	else
    	{
    		include('application/Ctf/view/common/header.html');
    	}
    	
    	$this->view->display($action);
    	//include('application/Ctf/view/common/footer.html');
    }

}