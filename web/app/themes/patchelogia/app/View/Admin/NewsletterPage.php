<?php

namespace App\View\Admin;

use App\Models\Newsletter;

class NewsletterPage
{
	private const SLUG = 'newsletter';

	public function __construct()
	{
		add_action('admin_menu', [$this, 'register']);
	}

	public function register(): void
	{
		add_menu_page(
			'Рассылка',
			'Рассылка',
			'manage_options',
			self::SLUG,
			[$this, 'render'],
			'dashicons-email-alt',
			3
		);
	}

	public function render(): void
	{
		echo view('admin.newsletter', [
			'subscriptions' => Newsletter::all(),
		]);
	}
}
