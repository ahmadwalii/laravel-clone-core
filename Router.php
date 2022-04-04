<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-30
 * Time: 11:09 AM
 */

namespace app\core;


use app\core\exceptions\NotFoundException;

class Router
{
	// for PHP 7.4+
//	protected array $routes = [
	protected $routes = [
		/*
		 * Example:
		 'get'=> [
			'/'=> callback,
			'/contact'=> callback
			...
		],
		'post'=> [
			'/add'=> callback,
			...
		]
		*/
		];
	// for PHP 7.4+
//	public Request $request;
	public $request;
	public $response;

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}

	public function get($path, $callback)
	{
		$this->routes['get'][$path] = $callback;
	}

	public function post($path, $callback)
	{
		$this->routes['post'][$path] = $callback;
	}

	public function resolve()
	{
//		echo '<pre>';
//		var_dump($_SERVER);
//		echo '</pre>';

		
		$path = $this->request->getPath();
		$method = $this->request->method();
		$callback = $this->routes[$method][$path] ?? false;

		if($callback === false)
		{
//			Application::$app->response->setStatusCode(404);
//			$this->response->setStatusCode(404);
//			return  $this->renderContent('Not found');

			throw new NotFoundException();
			return;
		}

		if(is_string($callback))
		{
			return Application::$app->view->renderView($callback);
		}

		if(is_array($callback))
		{
			Application::$app->controller = $callback[0] = new $callback[0]();
			Application::$app->controller->action = $callback[1];

			foreach (Application::$app->controller->getMiddlewares() as $middleware)
			{
				$middleware->execute();
			}
		}


		return call_user_func($callback, $this->request, $this->response);
//		echo '<pre>';
//		var_dump($callback);
//		echo '</pre>';
	}
}