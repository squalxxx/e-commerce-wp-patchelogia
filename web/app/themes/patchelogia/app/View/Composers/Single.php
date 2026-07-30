<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Single extends Composer
{
	protected static $views = [
		'single',
		'single-articles',
	];

	protected int $postId;

	public function __construct()
	{
		$this->postId = get_the_ID();

		if (is_singular('articles')) {
			incrementPostViews($this->postId);
		}
	}

	public function fields(): array
	{
		return get_fields() ?: [];
	}

	public function viewsCount(): int
	{
		return getPostViews($this->postId);
	}
}
