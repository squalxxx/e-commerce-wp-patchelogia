<?php

if (!function_exists('incrementPostViews')) {
	function incrementPostViews(int $postId): void
	{
		if (is_admin()) {
			return;
		}

		$cookie = "article_viewed_{$postId}";

		if (isset($_COOKIE[$cookie])) {
			return;
		}

		global $wpdb;

		$metaKey = '_post_views';

		$updated = $wpdb->query($wpdb->prepare(
			"UPDATE {$wpdb->postmeta} SET meta_value = meta_value + 1 WHERE post_id = %d AND meta_key = %s",
			$postId,
			$metaKey
		));

		if (! $updated) {
			add_post_meta($postId, $metaKey, 1, true);
		}

		setcookie(
			$cookie,
			'1',
			[
				'expires' => time() + DAY_IN_SECONDS,
				'path' => COOKIEPATH ?: '/',
				'domain' => COOKIE_DOMAIN,
				'secure' => is_ssl(),
				'httponly' => true,
				'samesite' => 'Lax',
			]
		);
	}
}

if (!function_exists('getPostViews')) {
	function getPostViews(int $postId): int
	{
		return (int) get_post_meta($postId, '_post_views', true);
	}
}
