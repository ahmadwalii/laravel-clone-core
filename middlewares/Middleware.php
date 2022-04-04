<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 2:38 AM
 */

namespace qasimlearner\laravelclone\middlewares;


abstract class Middleware
{
	abstract public function execute();
}