<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 3:48 AM
 */

namespace qasimlearner\laravelclone\exceptions;


class NotFoundException extends \Exception
{
	protected $code = 404;
	protected $message = 'Not Found';
}