<?php

namespace App\View\Blocks;

class Compare extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'compare',
			'title' => __('Блок: Сравнение'),
		];
	}
}
