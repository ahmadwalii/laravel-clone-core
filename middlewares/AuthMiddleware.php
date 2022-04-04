<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 2:40 AM
 */

namespace app\core\middlewares;


use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends Middleware
{
//	for PHP 7.4+
//	public array $actions = [];
	public $actions = [];

	public function __construct(array $actions = [])
	{
		$this->actions = $actions;
	}

	public function execute()
	{
		// if a user is not loggedIn (i.e. (s)he is a guest)
		if(Application::isGuest())
		{
			// if actions are empty OR
			// if current action is not present in the (registered) actions
			if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions))
			{
				throw new ForbiddenException();
			}
		}
	}
}