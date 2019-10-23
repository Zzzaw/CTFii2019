<?php
namespace core\lib;
/**
 *模型基类
**/
class Model
{
	private static $dbConfig;
	protected $db;
	private $table;
	

	public function __construct()
	{
		global $config;
		self::$dbConfig = $config['db'];

		$this->connect(self::$dbConfig['host'], 
        				self::$dbConfig['username'], 
        				self::$dbConfig['password'],
        				self::$dbConfig['dbname']);
		
	}

    //连接数据库(PDO)
    public function connect($host, $username, $password, $dbname)
    {
        
        try {
            //$conn = new PDO("mysql:host=$host;", $username, $password);
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbname);

            //$option = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC);
            //$this->_dbHandle = new \PDO($dsn, $username, $password, $option);
            $this->db = new \PDO($dsn, $username, $password);//短连接
            
        }
        catch(PDOException $e)
        {
            //p($e->getMessage());
        }
        
    }

    public function __destruct()
    {
        //释放连接
        $this->db = null;
    }
}