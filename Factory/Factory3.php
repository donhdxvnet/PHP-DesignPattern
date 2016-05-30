<?php

	interface IUser
	{
		function getName();
	}

	class User implements IUser 
	{		
		public function __construct($id){}		
		
		public function getName()
		{
			return "Jack";
		}
	}
	
	class UserFactory
	{
		public static function Load($i)
		{
			return new User($id);
		}
		
		public static function Create()
		{
			return new User(null);
		}
	}
	
	$uo = UserFactory::Create();
	echo($uo->getName());
	
?>