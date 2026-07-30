<?php

namespace App\Resources;

class ArticleResource
{
	protected static function base(\WP_Post $article): array
	{
		return [
			'id' => $article->ID,
			'title' => $article->post_title,
			'url' => get_permalink($article),

			'preview_image_url' => get_the_post_thumbnail_url($article, 'full'),

			'publish_date' => get_field('date', $article),
		];
	}

	public static function compact(\WP_Post $article): array
	{
		return self::base($article);
	}

	protected static function excerptContent(\WP_Post $article): string
	{
		return html_entity_decode(
			wp_trim_words(wp_strip_all_tags($article->post_content), 23),
			ENT_QUOTES | ENT_HTML5,
			'UTF-8'
		);
	}

	public static function full(\WP_Post $article): array
	{
		return array_merge(self::base($article), [
			'content' => $article->post_content,
			'content_excerpt' => self::excerptContent($article),
		]);
	}
}
