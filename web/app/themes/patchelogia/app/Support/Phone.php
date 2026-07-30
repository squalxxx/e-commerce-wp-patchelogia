<?php

if (!function_exists('formatPhone')) {
	function formatPhone(string $phone): string
	{
		$digits = preg_replace('/\D+/', '', $phone);

		if (strlen($digits) !== 11) {
			return $phone;
		}

		return sprintf(
			'+%s (%s) %s-%s-%s',
			substr($digits, 0, 1),
			substr($digits, 1, 3),
			substr($digits, 4, 3),
			substr($digits, 7, 2),
			substr($digits, 9, 2),
		);
	}
}

if (!function_exists('phoneHref')) {
	function phoneHref(string $phone): string
	{
		return 'tel:' . preg_replace('/\D+/', '', $phone);
	}
}
