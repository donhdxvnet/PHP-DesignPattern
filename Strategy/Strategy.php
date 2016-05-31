<?php

	interface IStrategy
	{
		function filter($record);
	}
	
	class FindAfterStrategy implements IStrategy
	{
		private $name;
		
		public function __construct($name)
		{
			$this->name = $name;
		}
		
		public function filter($record)
		{
			return strcmp($this->name, $record) <= 0;
		}
	}
	
	class RandomStrategy implements IStrategy
	{
		public function filter($record)
		{
			return rand(0, 1) >= 0.5;
		}
	}
	
	class UserList
	{
		private $list = array();
		
		public function __construct($names)
		{
			if ($names != null)
			{
				foreach ($names as $name)
				{
					$this->list[] = $name;
				}
				//print_r($this->list); //debug
			}
		}
		
		public function add($name)
		{
			$this->list[] = $name;
		}
		
		public function find($filter)
		{
			$recs = array();
			foreach ($this->list as $user)
			{	
				if ($filter->filter($user))
				{	
					$recs[] = $user;
				}
			}
			return $recs;
		}
	}
	
	$ul = new UserList( array( "Andy", "Jack", "Lori", "Megan" ) ); 
	$f1 = $ul->find( new FindAfterStrategy( "a" ) ); 
	print_r( $f1 );
	echo "<br>";
	
	$f2 = $ul->find( new RandomStrategy() );
	print_r( $f2 );

?>