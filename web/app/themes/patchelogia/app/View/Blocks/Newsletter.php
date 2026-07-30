<?php

namespace App\View\Blocks;

class Newsletter extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'newsletter',
			'title' => __('Блок: Подписка на рассылку'),
		];
	}

	protected function fields(): array
	{
		$fields = parent::fields();

		return $fields;
	}
}
