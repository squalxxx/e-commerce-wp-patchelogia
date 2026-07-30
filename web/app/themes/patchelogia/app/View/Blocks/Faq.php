<?php

namespace App\View\Blocks;

class Faq extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'faq',
			'title' => __('Блок: FAQ'),
		];
	}
}
