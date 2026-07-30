<?php

namespace App\Actions;

use WC_Product;

class AddToCartAction extends AbstractAction
{
	protected ?string $cartItemKey = null;

	public function handle(...$arguments): array
	{
		$data = $this->sanitize($arguments[0] ?? []);
		$error = $this->validate($data);

		if ($error !== null) {
			return $this->error($error);
		}

		if (!$this->addToCart($data)) {
			return $this->error('Не удалось добавить товар в корзину. Попробуйте ещё раз.');
		}

		return $this->success(
			'Товар добавлен в корзину.',
			[
				'cart_item_key' => $this->cartItemKey,
				'cart_count' => WC()->cart->get_cart_contents_count(),
			]
		);
	}

	protected function sanitize(array $data): array
	{
		return [
			'product_id' => absint($data['product_id'] ?? 0),
			'quantity' => max(1, absint($data['quantity'] ?? 1)),
		];
	}

	protected function validate(array $data): ?string
	{
		$product = wc_get_product($data['product_id']);

		if (!$product instanceof WC_Product || !$product->exists()) {
			return 'Товар не найден.';
		}

		if (!$product->is_purchasable()) {
			return 'Этот товар недоступен для покупки.';
		}

		if (!$product->is_in_stock()) {
			return 'Товара нет в наличии.';
		}

		if ($product->is_sold_individually() && $data['quantity'] > 1) {
			return 'Этот товар можно добавить только в одном экземпляре.';
		}

		$maxQuantity = $product->get_max_purchase_quantity();

		if ($maxQuantity > -1 && $data['quantity'] > $maxQuantity) {
			return sprintf('Доступно не более %d шт.', $maxQuantity);
		}

		return null;
	}

	protected function addToCart(array $data): bool
	{
		$this->cartItemKey = WC()->cart->add_to_cart(
			$data['product_id'],
			$data['quantity']
		);

		return $this->cartItemKey !== null;
	}
}
