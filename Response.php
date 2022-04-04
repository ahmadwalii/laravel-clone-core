<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-30
 * Time: 3:48 PM
 */

namespace app\core;


class Response
{
	public function setStatusCode(int $code)
	{
		http_response_code($code);
	}

	public function redirect(string $url)
	{
		header('Location: ' . $url);
		exit;
	}
}