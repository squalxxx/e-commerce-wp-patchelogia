<?php

namespace App\View\Blocks;

class Slider extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'slider',
			'title' => __('Блок: Слайдер'),
		];
	}
}
