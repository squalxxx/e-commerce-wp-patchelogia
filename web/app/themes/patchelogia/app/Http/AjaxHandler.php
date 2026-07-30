<?php

namespace App\Http;

use App\Actions\AddToCartAction;
use App\Actions\AmbassadorshipAction;
use App\Actions\CartQuantityAction;
use App\Actions\FeedbackAction;
use App\Actions\NewsletterAction;

$newsletter = fn() => wp_send_json(
	(new NewsletterAction())->handle($_POST)
);
add_action('wp_ajax_newsletter', $newsletter);
add_action('wp_ajax_nopriv_newsletter', $newsletter);

$feedback = fn() => wp_send_json(
	(new FeedbackAction())->handle($_POST)
);
add_action('wp_ajax_feedback', $feedback);
add_action('wp_ajax_nopriv_feedback', $feedback);

$ambassadorship = fn() => wp_send_json(
	(new AmbassadorshipAction())->handle($_POST)
);
add_action('wp_ajax_ambassadorship', $ambassadorship);
add_action('wp_ajax_nopriv_ambassadorship', $ambassadorship);

$cartQuantity = function () {
	check_ajax_referer('update_cart_quantity', 'nonce');

	$action = new CartQuantityAction();
	$result = $action->handle($_POST);

	wp_send_json(array_merge($result, $action->payload($_POST)));
};
add_action('wp_ajax_update_cart_quantity', $cartQuantity);
add_action('wp_ajax_nopriv_update_cart_quantity', $cartQuantity);

$addToCart = function () {
	check_ajax_referer('add_to_cart', 'nonce');

	$action = new AddToCartAction();
	$result = $action->handle($_POST);

	wp_send_json(array_merge($result, $action->payload()));
};
add_action('wp_ajax_add_to_cart', $addToCart);
add_action('wp_ajax_nopriv_add_to_cart', $addToCart);
