async function addToCart(productId, quantity = 1) {
	const response = await fetch(window.cartAjax.url, {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: new URLSearchParams({
			action: 'add_to_cart',
			nonce: window.cartAjax.addToCartNonce,
			product_id: productId,
			quantity,
		}),
	});

	const result = await response.json();

	if (!result.success) {
		throw new Error(result.message || 'Add to cart failed');
	}

	document.dispatchEvent(new CustomEvent('cart:added', { detail: { productId, result } }));

	return result;
}

export default function initAddToCart() {
	document.querySelectorAll('form.cart').forEach((form) => {
		form.addEventListener('submit', async (event) => {
			event.preventDefault();

			const productId = form.querySelector('[name="add-to-cart"]')?.value;
			const quantity = form.querySelector('[name="quantity"]')?.value || 1;

			if (!productId) return;

			const button = form.querySelector('.single_add_to_cart_button');
			button?.classList.add('loading');

			try {
				await addToCart(productId, quantity);
			} catch (error) {
				console.error(error);
			} finally {
				button?.classList.remove('loading');
			}
		});
	});

	document.querySelectorAll('a.add_to_cart_button').forEach((link) => {
		link.addEventListener('click', async (event) => {
			event.preventDefault();

			const productId = link.dataset.product_id;
			const quantity = link.dataset.quantity || 1;

			if (!productId) return;

			link.classList.add('loading');

			try {
				const result = await addToCart(productId, quantity);
				link.classList.add('added');
			} catch (error) {
				console.error(error);
			} finally {
				link.classList.remove('loading');
			}
		});
	});
}