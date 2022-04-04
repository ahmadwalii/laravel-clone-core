<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-31
 * Time: 2:50 PM
 */

namespace app\core\form;


use app\core\Model;

class Form
{
	public static function begin($action, $method)
	{
		echo sprintf('<form  action="%s" method="%s">', $action, $method);
		return new Form();
	}

	public static function end()
	{
		return '</form>';
	}

	public function field(Model $model, string $attribute)
	{
		return new InputField($model, $attribute);
	}
}