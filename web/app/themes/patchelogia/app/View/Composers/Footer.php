<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer
{
	protected static $views = [
		'sections.footer',
	];

	public function leftMenu(): array
	{
		return getMenu('footer_left_menu');
	}

	public function middleMenu(): array
	{
		return getMenu('footer_middle_menu');
	}

	public function rightMenu(): array
	{
		return getMenu('footer_right_menu');
	}
}
