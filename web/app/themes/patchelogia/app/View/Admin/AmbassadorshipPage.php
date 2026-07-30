<?php

namespace App\View\Admin;

use App\Models\Ambassadors;

class AmbassadorshipPage
{
	private const SLUG = 'ambassadorship';

	public function __construct()
	{
		add_action('admin_menu', [$this, 'register']);
	}

	public function register(): void
	{
		add_menu_page(
			'Амбассадорство',
			'Амбассадорство',
			'manage_options',
			self::SLUG,
			[$this, 'render'],
			'dashicons-admin-users',
			3
		);
	}

	public function render(): void
	{
		echo view('admin.ambassadorship', [
			'ambassadors' => Ambassadors::all(),
		]);
	}
}
