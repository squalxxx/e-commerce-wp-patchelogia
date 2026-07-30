<?php

namespace App\View\Blocks;

class InfoPanel extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'info-panel',
			'title' => __('Блок: Информационная панель'),
		];
	}
}
