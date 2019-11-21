<?php

//数据库配置
$config['db']['host'] = 'localhost';
$config['db']['username'] = 'root';
$config['db']['password'] = 'password';
$config['db']['dbname'] = 'ctf_01';

// 默认控制器和操作名
$config['defaultModule'] = 'Ctf';
$config['defaultController'] = 'Index';
$config['defaultAction'] = 'index';

$config['min_points'] = 30;
$config['max_points'] = 500;

return $config;