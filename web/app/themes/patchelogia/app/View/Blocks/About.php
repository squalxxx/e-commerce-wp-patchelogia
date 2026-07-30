<?php

namespace App\View\Blocks;

class About extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'about',
			'title' => __('Блок: О бренде'),
		];
	}
}
