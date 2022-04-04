<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 2:51 AM
 */

namespace app\core\exceptions;


class ForbiddenException extends \Exception
{
	protected $code = 403;
	protected $message = "You don't have permission to access this page!";
}