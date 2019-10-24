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

//计算每个选手的分数
//根据分数排序
//分数相同的选手，根据最后更新时间排名
function sortByScore($user_list)
{
    function my_sort($a,$b)
    {
        if ($a->score==$b->score){
            for($i=0;$i<count($a->last_update_date);$i++){
                if($a->last_update_date[$i] == $b->last_update_date[$i]) continue;
                return ($a->last_update_date[$i] > $b->last_update_date[$i])? 1:-1;
            }
            return 0;
        }
        return ($a->score<$b->score)? 1:-1;
    }


    usort($user_list,"my_sort");
    return $user_list;
}

function get_Date()
{
    $t=time();
    date_default_timezone_set('PRC');
    return date("Y-m-d-G-i-s",$t);
}