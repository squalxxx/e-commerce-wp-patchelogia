<?php

namespace App\View\Blocks;

class HeroBanner extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'hero-banner',
			'title' => __('Блок: Главный баннер'),
		];
	}
}
