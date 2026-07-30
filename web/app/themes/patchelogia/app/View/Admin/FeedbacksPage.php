<?php

namespace App\View\Admin;

use App\Models\Feedback;

class FeedbacksPage
{
	private const SLUG = 'feedbacks';

	public function __construct()
	{
		add_action('admin_menu', [$this, 'register']);
	}

	public function register(): void
	{
		add_menu_page(
			'Отдел заботы',
			'Отдел заботы',
			'manage_options',
			self::SLUG,
			[$this, 'render'],
			'dashicons-admin-comments',
			3
		);
	}

	public function render(): void
	{
		echo view('admin.feedbacks', [
			'feedbacks' => Feedback::all(),
		]);
	}
}
