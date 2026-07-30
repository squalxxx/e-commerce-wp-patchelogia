<?php

namespace App\Actions;

class AddToCartAction extends Action
{
	protected ?string $cartItemKey = null;

	protected function sanitize(array $data): array
	{
		return [
			'product_id' => isset($data['product_id']) ? absint($data['product_id']) : 0,
			'quantity'   => isset($data['quantity']) ? absint($data['quantity']) : 1,
		];
	}

	protected function validate(array $data): ?string
	{
		if ($data['product_id'] <= 0) {
			return 'Товар не найден.';
		}

		$product = wc_get_product($data['product_id']);

		if (! $product || ! $product->exists()) {
			return 'Товар не найден.';
		}

		if (! $product->is_purchasable()) {
			return 'Этот товар недоступен для покупки.';
		}

		if (! $product->is_in_stock()) {
			return 'Товара нет в наличии.';
		}

		$quantity = $data['quantity'] > 0 ? $data['quantity'] : 1;

		if ($product->is_sold_individually() && $quantity > 1) {
			return 'Этот товар можно добавить только в одном экземпляре.';
		}

		$maxQuantity = $product->get_max_purchase_quantity();

		if ($maxQuantity > -1 && $quantity > $maxQuantity) {
			return sprintf('Доступно не более %d шт.', $maxQuantity);
		}

		return null;
	}

	protected function persist(array $data): bool
	{
		$quantity = $data['quantity'] > 0 ? $data['quantity'] : 1;
		$this->cartItemKey = WC()->cart->add_to_cart($data['product_id'], $quantity);

		return (bool) $this->cartItemKey;
	}

	protected function notify(array $data): bool
	{
		return true;
	}

	protected function persistErrorMessage(): string
	{
		return 'Не удалось добавить товар в корзину. Попробуйте ещё раз.';
	}

	protected function notifyErrorMessage(): string
	{
		return '';
	}

	protected function successMessage(): string
	{
		return 'Товар добавлен в корзину.';
	}

	public function payload(): array
	{
		return [
			'cart_item_key' => $this->cartItemKey,
			'cart_count' => WC()->cart->get_cart_contents_count(),
		];
	}
}
