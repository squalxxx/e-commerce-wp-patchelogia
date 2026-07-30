<?php

namespace App\View\Blocks;

class Widget extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'widget',
			'title' => __('Блок: Виджет'),
		];
	}

	protected function fields(): array
	{
		$fields = parent::fields();

		return $fields;
	}
}
