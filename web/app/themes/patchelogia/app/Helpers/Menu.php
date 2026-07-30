<?php

if (!function_exists('getMenu')) {
	function getMenu(string $location): array
	{
		$locations = get_nav_menu_locations();

		if (!isset($locations[$location])) {
			return [
				'name' => '',
				'items' => [],
			];
		}

		$menu = wp_get_nav_menu_object($locations[$location]);

		$result = [
			'name' => $menu?->name ?? '',
			'items' => wp_get_nav_menu_items($menu?->term_id ?? 0) ?: [],
		];

		return $result;
	}
}

if (!function_exists('isActiveMenuItem')) {
	function isActiveMenuItem(string $itemUrl): bool
	{
		$currentUrl = untrailingslashit(url()->current());
		$targetUrl = untrailingslashit(url($itemUrl));

		if ($currentUrl === $targetUrl) {
			return true;
		}

		if (is_singular()) {
			$postType = get_post_type();

			if ($postType) {
				$archiveLink = get_post_type_archive_link($postType);

				if (
					$archiveLink &&
					untrailingslashit($archiveLink) === $targetUrl
				) {
					return true;
				}
			}
		}

		return false;
	}
}
