<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-30
 * Time: 11:09 AM
 */

namespace app\core;


use app\models\User;
use app\core\db\Database;

class Application
{
	// for PHP 7.4
//	public Router $router;
//	public Request $request;
//	public Response $response;
//	public static Application $app;
//	public Controller $controller;
//	public Database $db;
//	public Session $session;
//	public ?UserModel $user;
//	public string $userClass;
//	public string $layout;
//	public View $view;

	public $router;
	public $request;
	public $response;
	public static $app;
	public static $ROOT_PATH;
	/**
	 * @var Controller
	 */
	public $controller;
	/**
	 * @var Session
	 */
	public $session;
	/**
	 * @var UserModel
	 */
	public $user;
	public $userClass;
	public $layout;
	/**
	 * @var View
	 */
	public $view;


	public function __construct($rootPath, array $config)
	{
		self::$app = $this;
		self::$ROOT_PATH = $rootPath;
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);
		$this->db = new Database($config['db']);
		$this->session = new Session();
		$this->userClass = $config['userClass'];
		$primaryKeyValue = $this->session->get('user');

		if($primaryKeyValue)
		{
			$primaryKey = $this->userClass::primaryKey();
			$this->user = $this->userClass::findOne([$primaryKey=> $primaryKeyValue]);
		}

		$this->layout = $config['layout'];

		$this->view = new View();
	}

	public function run()
	{
		try {
			echo $this->router->resolve();
		}
		catch (\Exception $e) {
			$this->response->setStatusCode($e->getCode());
			echo $this->view->renderView('_error', [
				'exception'=> $e
			]);
		}
	}

	public function login(UserModel $user)
	{
		$this->user = $user;
		$primaryKey = $user->primaryKey();
		$primaryKeyValue = $user->{$primaryKey};
		$this->session->set('user', $primaryKeyValue);

		return true;
	}

	public function logout()
	{
		$this->user = null;
		$this->session->remove('user');
	}

	public static function isGuest()
	{
		return !self::$app->user;
	}
}