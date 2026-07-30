<?php

namespace App\Actions;

class CartQuantityAction extends Action
{
	protected ?array $cartItem = null;
	protected bool $removed = false;

	protected function sanitize(array $data): array
	{
		return [
			'cart_item_key' => sanitize_text_field($data['cart_item_key'] ?? ''),
			'quantity'      => isset($data['quantity']) ? absint($data['quantity']) : 0,
		];
	}

	protected function validate(array $data): ?string
	{
		if ($data['cart_item_key'] === '') {
			return 'Товар не найден в корзине.';
		}

		$cartItem = WC()->cart->get_cart_item($data['cart_item_key']);

		if (! $cartItem) {
			return 'Товар не найден в корзине.';
		}

		$product = $cartItem['data'];

		if ($product->is_sold_individually() && $data['quantity'] > 1) {
			return 'Этот товар можно добавить только в одном экземпляре.';
		}

		$maxQuantity = $product->get_max_purchase_quantity();

		if ($maxQuantity > -1 && $data['quantity'] > $maxQuantity) {
			return sprintf('Доступно не более %d шт.', $maxQuantity);
		}

		return null;
	}

	protected function persist(array $data): bool
	{
		if ($data['quantity'] <= 0) {
			$this->removed = WC()->cart->remove_cart_item($data['cart_item_key']);
			$this->cartItem = null;
		} else {
			$updated = WC()->cart->set_quantity($data['cart_item_key'], $data['quantity'], true);
			$this->cartItem = WC()->cart->get_cart_item($data['cart_item_key']);

			if (! $updated) {
				return false;
			}
		}

		WC()->cart->calculate_totals();

		return true;
	}

	protected function notify(array $data): bool
	{
		// Уведомлений тут не требуется — шаг обязателен по контракту,
		// просто подтверждаем успех.
		return true;
	}

	protected function persistErrorMessage(): string
	{
		return 'Не удалось обновить количество товара. Попробуйте ещё раз.';
	}

	protected function notifyErrorMessage(): string
	{
		return '';
	}

	protected function successMessage(): string
	{
		return '';
	}

	/**
	 * Extra data for the AJAX response, merged on top of handle()'s result
	 * by AjaxHandler since it doesn't fit the success/message contract.
	 */
	public function payload(array $data): array
	{
		$cartItemKey = sanitize_text_field($data['cart_item_key'] ?? '');

		return [
			'cart_item_key' => $cartItemKey,
			'removed'       => $this->removed,
			'subtotal'      => $this->cartItem
				? apply_filters(
					'woocommerce_cart_item_subtotal',
					WC()->cart->get_product_subtotal($this->cartItem['data'], $this->cartItem['quantity']),
					$this->cartItem,
					$cartItemKey,
				)
				: null,
			'cart_totals_html' => view('woocommerce.cart.cart-totals')->render(),
			'cart_count'        => WC()->cart->get_cart_contents_count(),
		];
	}
}
