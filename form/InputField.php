<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-03-31
 * Time: 2:50 PM
 */

namespace app\core\form;


use app\core\Model;

class InputField extends Field
{
	// for PHP 7.4+
//	public Model $model;
//	public string $attribute;
//	public string $type;


	public $type;
	public const TYPE_TEXT     = 'text';
	public const TYPE_PASSWORD = 'password';
	public const TYPE_NUMBER   = 'number';
	public const TYPE_EMAIL    = 'email';

	/**
	 * @return string
	 */
	public function renderField(): string
	{
		return sprintf('
			<input type="%s" name="%s" value="%s" class="form-control%s">
			',
			$this->type,
			$this->attribute,
			$this->model->{$this->attribute},
			$this->model->hasError($this->attribute) ? ' is-invalid' : ''
		);
	}

	/**
	 * InputField constructor.
	 * @param Model $model
	 * @param string $attribute
	 */
	public function __construct(Model $model, string $attribute)
	{
		parent::__construct($model, $attribute);
		$this->type = self::TYPE_TEXT;
	}

	/**
	 * @return $this
	 */
	public function passwordField()
	{
		$this->type = self::TYPE_PASSWORD;

		return $this;
	}


	/**
	 * @return $this
	 */
	public function emailField()
	{
		$this->type = self::TYPE_EMAIL;

		return $this;
	}
}