<?php

namespace App\View\Blocks;

class Video extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'video',
			'title' => __('Блок: Видео'),
		];
	}
}
