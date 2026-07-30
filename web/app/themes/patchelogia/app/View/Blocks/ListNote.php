<?php

namespace App\View\Blocks;

class ListNote extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'list-note',
			'title' => __('Блок: Список с заметкой'),
		];
	}
}
