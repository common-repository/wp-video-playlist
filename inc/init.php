<?php
/*
 * @package jPlayer
 */
namespace Inc;

final class Init
{
	 /**
	  * Store all class in an array.
	  * @return arry  List of classes.
	  */
	public static function getServices() {
		return [
			Base\Enqueue::class,
			Pages\Dashboard::class,
		];
	}

	/**
	 * Loop throught the all classes, initilize them,
	 * and call register() if it exists.
	 * @return
	 */
	public static function register_services() {
		foreach (self::getServices() as $class) {
			$service = self::instantiate($class);

			if(method_exists($service, 'register')):
				$service->register();
			endif;
		}
	}

	/**
	 * Initilize class.
	 * @param class $class  class from services array.
	 * @return class instance  New instance of the class.
	 */
	private static function instantiate($class) {
		return new $class();
	}
}