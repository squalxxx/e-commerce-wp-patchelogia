<?php

namespace App\View\Blocks;

class ListPhoto extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'list-photo',
			'title' => __('Блок: Список с фото'),
		];
	}
}
