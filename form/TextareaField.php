<?php
/**
 * Created by PhpStorm.
 * User: qasim
 * Date: 2022-04-04
 * Time: 8:42 PM
 */

namespace app\core\form;


class TextareaField extends Field
{
	public function renderField(): string
	{
		return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
			$this->attribute,
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
			$this->model->{$this->attribute}
		);
	}
}