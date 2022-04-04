<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-03
 * Time: 4:21 AM
 */

namespace app\core\db;

use app\core\Model;
use app\core\Application;

abstract class DbModel extends Model
{
	// public function __construct(/*array $config*/)
	// {
//		parent::__construct($config);
	// }

	abstract public function tableName() : string;
	abstract public function attributes() : array;
	abstract public function primaryKey() : string;

	public function save()
	{
		$tableName = $this->tableName();
		$attributes = $this->attributes();
		$statement = self::prepare("INSERT INTO {$tableName} (" . implode(',', $attributes) . ") 
		VALUES (:" . implode(",:", $attributes) . ")");

		foreach ($attributes as $attribute)
		{
			$statement->bindValue(":{$attribute}", $this->{$attribute});
		}

		$statement->execute();

		return true;
	}

	public static function prepare($sql)
	{
		return Application::$app->db->pdo->prepare($sql);
	}

	public function findOne($where)
	{
		$tableName = static::tableName();
		$attributes = array_keys($where);
		$whereAttributes = array_map(function($attr) {
			return "{$attr}=:{$attr}";
		}, $attributes);
		$wherePart = implode(' AND ', $whereAttributes);
		$sql = "SELECT * FROM {$tableName} WHERE {$wherePart}";
		$statement = self::prepare($sql);

		foreach ($where as $key => $item) {
			$statement->bindValue(":{$key}", $item);
		}

		$statement->execute();

		return $statement->fetchObject(static::class);
	}
}