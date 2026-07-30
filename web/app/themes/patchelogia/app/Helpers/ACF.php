<?php

if (!function_exists('getOptionField')) {
	function getOptionField(string $field): mixed
	{
		return get_field($field, 'option');
	}
}

if (!function_exists('flexibleContentRender')) {
	function flexibleContentRender(string $fieldName, int|string|null $postId = null): void
	{
		if (!have_rows($fieldName, $postId)) {
			return;
		}

		while (have_rows($fieldName, $postId)) {
			the_row();

			$layout = get_row_layout();
			$view   = "blocks.{$layout}";

			if (!$layout || !view()->exists($view)) {
				continue;
			}

			echo view($view, [
				'fields' => get_row(true),
				'block'  => [
					'id' => "flex-{$layout}-" . uniqid(),
					'className' => '',
					'anchor' => '',
				],
			]);
		}
	}
}
