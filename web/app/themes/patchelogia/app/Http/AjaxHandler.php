<?php

namespace App\Http;

use App\Actions\AbstractAction;
use App\Actions\AddToCartAction;
use App\Actions\AmbassadorshipAction;
use App\Actions\CartQuantityAction;
use App\Actions\FeedbackAction;
use App\Actions\NewsletterAction;

class AjaxHandler
{
	public static function register(): void
	{
		self::registerAction(
			'newsletter',
			NewsletterAction::class,
		);

		self::registerAction(
			'feedback',
			FeedbackAction::class,
		);

		self::registerAction(
			'ambassadorship',
			AmbassadorshipAction::class,
		);

		self::registerAction(
			'update_cart_quantity',
			CartQuantityAction::class,
			'update_cart_quantity',
		);

		self::registerAction(
			'add_to_cart',
			AddToCartAction::class,
			'add_to_cart',
		);
	}

	private static function registerAction(
		string $hook,
		string $actionClass,
		?string $nonce = null,
	): void {
		$callback = static function () use ($actionClass, $nonce) {
			if ($nonce !== null) {
				check_ajax_referer($nonce, 'nonce');
			}

			/** @var AbstractAction $action */
			$action = new $actionClass();

			wp_send_json(
				$action->handle($_POST)
			);
		};

		add_action("wp_ajax_{$hook}", $callback);
		add_action("wp_ajax_nopriv_{$hook}", $callback);
	}
}
