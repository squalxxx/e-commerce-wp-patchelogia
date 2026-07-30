<?php

namespace App\View\Blocks;

class Quote extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'quote',
			'title' => __('Блок: Цитата'),
		];
	}
}
