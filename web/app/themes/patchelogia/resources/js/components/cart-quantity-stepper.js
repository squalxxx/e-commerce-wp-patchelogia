export default function cartQuantityStepper({ key, quantity, min, max }) {
	return {
		key,
		quantity,
		min,
		max,
		loading: false,
		debounceTimer: null,

		increment() {
			if (this.max !== null && this.quantity >= this.max) return;
			this.quantity++;
			this.commit();
		},

		decrement() {
			if (this.quantity <= this.min) return;
			this.quantity--;
			this.commit();
		},

		commit() {
			if (this.quantity < this.min) this.quantity = this.min;
			if (this.max !== null && this.quantity > this.max) this.quantity = this.max;

			clearTimeout(this.debounceTimer);
			this.debounceTimer = setTimeout(() => this.update(), 400);
		},

		async update() {
			this.loading = true;

			try {
				const response = await fetch(window.cartAjax.url, {
					method: 'POST',
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					body: new URLSearchParams({
						action: 'update_cart_quantity',
						nonce: window.cartAjax.nonce,
						cart_item_key: this.key,
						quantity: this.quantity,
					}),
				});

				const result = await response.json();

				if (!result.success) {
					throw new Error(result.message || 'Cart update failed');
				}

				document.dispatchEvent(new CustomEvent('cart:updated', { detail: result }));
			} catch (error) {
				console.error(error);
				document.dispatchEvent(new CustomEvent('cart:update-failed', { detail: { key: this.key } }));
			} finally {
				this.loading = false;
			}
		},
	};
}