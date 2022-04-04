<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 2:05 AM
 */

namespace app\core;

use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
	abstract public function getDisplayName(): string;
}