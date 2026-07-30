<?php

namespace App\Actions;

use WC_Product;

class CartQuantityAction extends AbstractAction
{
	protected ?array $cartItem = null;

	protected bool $removed = false;

	public function handle(...$arguments): array
	{
		$data = $this->sanitize($arguments[0] ?? []);
		$error = $this->validate($data);

		if ($error !== null) {
			return $this->error($error);
		}

		if (!$this->updateQuantity($data)) {
			return $this->error('Не удалось обновить количество товара. Попробуйте ещё раз.');
		}

		return $this->success(
			'',
			[
				'cart_item_key' => $data['cart_item_key'],
				'removed' => $this->removed,
				'subtotal' => $this->cartItem
					? apply_filters(
						'woocommerce_cart_item_subtotal',
						WC()->cart->get_product_subtotal(
							$this->cartItem['data'],
							$this->cartItem['quantity'],
						),
						$this->cartItem,
						$data['cart_item_key'],
					)
					: null,
				'cart_totals_html' => view('woocommerce.cart.cart-totals')->render(),
				'cart_count' => WC()->cart->get_cart_contents_count(),
			]
		);
	}

	protected function sanitize(array $data): array
	{
		return [
			'cart_item_key' => sanitize_text_field($data['cart_item_key'] ?? ''),
			'quantity' => max(0, absint($data['quantity'] ?? 0)),
		];
	}

	protected function validate(array $data): ?string
	{
		if ($data['cart_item_key'] === '') {
			return 'Товар не найден в корзине.';
		}

		$cartItem = WC()->cart->get_cart_item($data['cart_item_key']);

		if (!$cartItem) {
			return 'Товар не найден в корзине.';
		}

		/** @var WC_Product $product */
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

	protected function updateQuantity(array $data): bool
	{
		if ($data['quantity'] === 0) {
			$this->removed = WC()->cart->remove_cart_item($data['cart_item_key']);
			$this->cartItem = null;
		} else {
			$updated = WC()->cart->set_quantity(
				$data['cart_item_key'],
				$data['quantity'],
				true,
			);

			if (! $updated) {
				return false;
			}

			$this->cartItem = WC()->cart->get_cart_item($data['cart_item_key']);
		}

		WC()->cart->calculate_totals();

		return true;
	}
}
