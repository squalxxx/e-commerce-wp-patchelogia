<?php

namespace App\View\Blocks;

class FormAmbassadorship extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'form-ambassadorship',
			'title' => __('Блок: Форма амбассадорства'),
		];
	}
}
