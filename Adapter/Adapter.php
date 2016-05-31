<?php 

	/**
	 * Db Factory
	 */
	class Lib_Db
	{
		public $db;
		
		public function  __construct(Config $config)
		{
			$className = sprintf("Lib_Db_Adapter_%s", $config->driver);
			if (class_exists($className))
			{
				$this->db = new $className();
				$this->db->connect($config);				
			}
		}
		
		public function fetch($sql)
		{
			$this->db->fetch($mysql);
		}
	}
	
	interface Db_Adapter_Interface
	{
		public function connect(Config $config);
		public function fetch($sql);
	}
	/**
	 * MySQLi Adapter
	 */
	class Lib_Db_Adapter_Mysqli implements Db_Adapter_Interface
	{
		private $_mysqli;
	
		public function connect(Config $config)
		{
			$this->_mysqli = new mysqli($config->host, $config->user, $config->password
					, $config->dbscheme);
		}
		public function fetch($sql)
		{
			return $this->_mysqli->query($sql)->fetch_object();
		}
	
	}
	/**
	 * MySQLi Pdo
	 */
	class Lib_Db_Adapter_Pdo implements Db_Adapter_Interface
	{
		private $_dbh;
	
		public function connect(Config $config)
		{
			$dsn = sprintf('msqli::dbname=%s;host=%s', $config->dbscheme, $config->host);
			$this->_dbh = new PDO($dsn, $config->user, $config->password);
		}
		public function fetch($sql)
		{
			$sth = $this->_dbh->prepare($sql);
			$sth->execute();
			return $sth->fetch();
		}
	}
	/**
	 * Usage
	 */
	class Config
	{
		public $driver = 'Mysqli';
		public $host = 'localhost';
		public $user = 'test';
		public $password = 'test';
		public $dbscheme = 'test';
	}
	$config = new Config();
	
	$db = new Lib_Db($config);
	$db->fetch('SELECT * FROM `test`');

?>