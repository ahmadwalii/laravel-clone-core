<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-30
 * Time: 4:45 PM
 */

namespace app\core;


use app\core\middlewares\Middleware;

class Controller
{
	# for php 7.4
//	public string $layout = 'main';
//	public array $middlewares = [];
	public $layout = 'main';
	/**
	 * @var \app\core\middlewares\Middleware[]
	 */
	protected $middlewares = [];

	public $action;

	public function render($view, $params = [])
	{
		return Application::$app->view->renderView($view, $params);
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	public function registerMiddleware(Middleware $middleware)
	{
		$this->middlewares[] = $middleware;
	}

	public function getMiddlewares(): array
	{
		return $this->middlewares;
	}
}