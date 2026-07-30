<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
	protected static $views = [
		'sections.subheader',
		'sections.header',
	];

	public function marqueePhrases(): array
	{
		return getOptionField('subheader-marquee_phrases') ?: [];
	}

	public function mainMenu(): array
	{
		return getMenu('header_main_menu');
	}
}
