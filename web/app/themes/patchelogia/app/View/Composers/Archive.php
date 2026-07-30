<?php

namespace App\View\Composers;

use App\Resources\ArticleResource;
use Roots\Acorn\View\Composer;

class Archive extends Composer
{
	protected static $views = [
		'archive',
		'archive-articles',
	];

	protected function query(): \WP_Query
	{
		global $wp_query;

		return $wp_query;
	}

	public function articles(): array
	{
		return collect($this->query()->posts)
			->map(fn(\WP_Post $article) => ArticleResource::full($article))
			->all();
	}
}
