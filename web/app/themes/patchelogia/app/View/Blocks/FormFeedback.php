<?php

namespace App\View\Blocks;

class FormFeedback extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'form-feedback',
			'title' => __('Блок: Форма обратной связи'),
		];
	}
}
