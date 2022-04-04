<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-30
 * Time: 12:04 PM
 */

namespace app\core;


class Request
{
	public function getPath()
	{
		$path = $_SERVER['REQUEST_URI'] ?? '/';
		$position = strpos($path, '?');

		if($position === false)
		{
			return $path;
		}

//		echo '<pre>';
//		var_dump($position);
//		echo '</pre>';

		$path = substr($path, 0, $position);

		return $path;
	}

	public function method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function isGet()
	{
		return $this->method() === 'get';
	}

	public function isPost()
	{
		return $this->method() === 'post';
	}

	public function getBody()
	{
		$method = $this->method();

		if($method == 'post')
		{
			return $this->getFilteredArray($_POST, INPUT_POST);
		}
		else if($method == 'get')
		{
			return $this->getFilteredArray($_GET, INPUT_GET);
		}

		return [];
	}

	protected function getFilteredArray(array $mainArray, $filterType = INPUT_GET)
	{
		$filteredArray = [];

		foreach ($mainArray as $key=> $value)
		{
			$filteredArray[$key] = filter_input($filterType, $key, FILTER_SANITIZE_SPECIAL_CHARS);
		}

		return $filteredArray;
	}
}