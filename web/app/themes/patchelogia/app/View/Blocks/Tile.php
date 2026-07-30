<?php

namespace App\View\Blocks;

class Tile extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'tile',
			'title' => __('Блок: Плитка'),
		];
	}

	protected function fields(): array
	{
		$fields = parent::fields();

		return $fields;
	}
}
