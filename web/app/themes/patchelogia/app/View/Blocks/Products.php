<?php

namespace App\View\Blocks;

class Products extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'products',
			'title' => __('Блок: Товары'),
		];
	}
}
