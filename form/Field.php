<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 8:31 PM
 */

namespace app\core\form;

use app\core\Model;

abstract class Field
{
	public $model;
	public $attribute;

	/**
	 * @return string
	 */
	abstract public function renderField(): string;

	/**
	 * Field constructor.
	 * @param Model $model
	 * @param string $attribute
	 */
	public function __construct(Model $model, string $attribute)
	{
		$this->model     = $model;
		$this->attribute = $attribute;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return sprintf('
			<div class="mb-3">
				<label class="form-label">%s</label>
				%s
				<div class="invalid-feedback">
					%s
				</div>
			</div>
			',
			$this->model->labels()[$this->attribute] ?? $this->attribute,
			$this->renderField(),
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
			$this->model->getFirstError($this->attribute)
		);
	}
}