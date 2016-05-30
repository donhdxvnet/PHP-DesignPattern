<?php
	
	//GOOD
	//A class cannot anticipate the type of objects it needs to create beforehand.
	//A class requires its subclasses to specify the objects it creates.
	//The application to localize the logic to instantiate a complex object.
	//Makes complex object creation easy through an interface that can bootstrap this process for you
	//Great for generating different objects based on the environment
	//Practical for components that require similar instantiation or methods
	//Great for decoupling components by bootstrapping the instantiation of a different object to carry out work for particular instances
	
	//BAD
	//Unit testing can be difficult as a direct result of the object creation process being hidden by the factory methods

	class HouseFactory
	{
		public function create()
		{
			$TVObj = new TV($param1, $param2, $param3);
			$LivingroomObj = new LivingRoom($TVObj, $param1, $param2);
			$KitchenroomObj = new Kitchen($param1, $param2);
			$HouseObj = new House($LivingroomObj, $KitchenroomObj);
			return $HouseObj;
		}
	}
	$houseFactory = new HouseFactory();
	$HouseObj = $houseFactory->create();

?>