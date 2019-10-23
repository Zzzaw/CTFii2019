<?php

//未登录则终止脚本
function check_session_islogin()
{
	session_start();
	if(!$_SESSION['islogin']){
		exit('not logged in');
	}
}

//处理用户输入(去掉空格、转义)
function str_r($str)
{
	$str = str_replace(' ', '', $str);
	$str = addslashes($str);
	return $str;
}