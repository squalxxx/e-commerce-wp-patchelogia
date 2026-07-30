<?php

namespace App\View\Blocks;

use App\Resources\ArticleResource;

class Articles extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'articles',
			'title' => __('Блок: Статьи из блога'),
		];
	}

	protected function fields(): array
	{
		$fields = parent::fields();

		$fields['articles'] = collect($fields['articles'] ?? [])
			->map(fn(\WP_Post $article) => ArticleResource::full($article))
			->all();

		return $fields;
	}
}
