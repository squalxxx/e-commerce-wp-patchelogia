<?php

if (!function_exists('getOptionField')) {
	function getOptionField(string $field): mixed
	{
		return get_field($field, 'option');
	}
}
