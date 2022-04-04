<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 1:10 PM
 */

namespace app\core;


class View
{
	// for PHP 7.4+
//	public string $title;

	public $title;

	public function renderView($view, $params = [])
	{
//		$layoutContent = $this->renderLayout();
//		require_once Application::$ROOT_PATH . "/views/{$view}.php";
		$viewContent = $this->renderOnlyView($view, $params);

//		return str_replace('{{content}}', $viewContent, $layoutContent);

		return $this->renderContent($viewContent);
	}

	public function renderContent($viewContent)
	{
		$layoutContent = $this->renderLayout();

		return str_replace('{{content}}', $viewContent, $layoutContent);
	}

	protected function renderLayout()
	{
		$layout = Application::$app->layout;

		if(Application::$app->controller) {
			$layout = Application::$app->controller->layout;
		}

		// cache the output
		ob_start(); // start object buffer, so nothing will output, but instead it will write everything to the buffer
		require_once Application::$ROOT_PATH . "/views/layouts/$layout.php";
		return ob_get_clean(); // get the buffered data (and stop and clear the buffer)
	}

	protected function renderOnlyView($view, $params)
	{
		foreach ($params as $variableName=> $variableValue)
		{
			${$variableName} = $variableValue;
		}

		ob_start();
		require_once Application::$ROOT_PATH . "/views/{$view}.php";
		return ob_get_clean();
	}
}
