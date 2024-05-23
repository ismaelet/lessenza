<?php

namespace ViewManager;

class Admin {

	public static $buttonConfiguration;
	public static $formAddFunction;
	public static $additionalFormAddFunction;
	public static $formUpdateFunction;
	public static $additionalFormUpdateFunction;

	/*
	* Set methods
	*/
	public static function setButtonConfiguration(callable $function) {
		self::$buttonConfiguration = $function;

		return new static;
	}

	public static function setFormAddFunction(callable $function) {
		self::$formAddFunction = $function;

		return new static;
	}

	public static function setAdditionalFormAddFunction(callable $function) {
		self::$additionalFormAddFunction = $function;

		return new static;
	}

	public static function setFormUpdateFunction(callable $function) {
		self::$formUpdateFunction = $function;

		return new static;
	}

	public static function setAdditionalFormUpdateFunction(callable $function) {
		self::$additionalFormUpdateFunction = $function;

		return new static;
	}

	/*
	* Misc methods
	*/
	public static function runButtonConfiguration(array $button, int $buttonKey, array $queryRow) {
		return call_user_func(self::$buttonConfiguration, $button, $buttonKey, $queryRow);
	}

	public static function runFormAddFunction(array $inputs) {
		return call_user_func(self::$formAddFunction, $inputs);
	}

	public static function runAdditionalFormAddFunction(array $inputs, int $id) {
		return call_user_func(self::$additionalFormAddFunction, $inputs, $id);
	}

	public static function runFormUpdateFunction(array $inputs, int $id) {
		return call_user_func(self::$formUpdateFunction, $inputs, $id);
	}

	public static function runAdditionalFormUpdateFunction(array $inputs, int $id) {
		return call_user_func(self::$additionalFormUpdateFunction, $inputs, $id);
	}
}
