<?php

namespace App\View\Blocks;

use WP_Post;

class Reviews extends Block
{
	protected function options(): array
	{
		return [
			'name' => 'reviews',
			'title' => __('Блок: Отзывы'),
		];
	}

	protected function fields(): array
	{
		$fields = parent::fields();

		$fields['reviews'] = collect($fields['reviews'] ?? [])
			->map(function (WP_Post $review) {
				$reviewFields = get_fields($review->ID) ?: [];

				return [
					'id' => $review->ID,
					'name' => $review->post_title,

					'avatar' => mb_strtoupper(mb_substr($review->post_title, 0, 1)),

					'rating' => $reviewFields['rating'] ?? null,
					'content' => $reviewFields['content'] ?? null,
					'date' => $reviewFields['date'] ?? null,
					'city' => $reviewFields['city'] ?? null,
				];
			})
			->all();

		return $fields;
	}
}
