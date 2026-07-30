export default function initWooHandlers() {
	document.addEventListener('cart:updated', (event) => {
		cartUpdated(event);
	});

	document.addEventListener('cart:added', (event) => {
		cartAdded(event);
	});
}

function cartUpdated(event) {
	const { cart_item_key: key, subtotal, cart_totals_html: totalsHtml, cart_count: count } = event.detail;

	// Product line summary - both options (desktop + mobile double).
	if (subtotal !== null && subtotal !== undefined) {
		document.querySelectorAll(`[data-cart-item-key="${key}"]`).forEach((el) => {
			el.innerHTML = subtotal;
		});
	}

	// The summary block on the right (subtotal, shipping, total, coupons).
	if (totalsHtml) {
		const collaterals = document.querySelector('.cart_totals');
		if (collaterals) {
			collaterals.outerHTML = totalsHtml;
		}
	}

	// The product counter is in the header, if it is on the page.
	if (typeof count === 'number') {
		document.querySelectorAll('[data-cart-count] [data-roll-item]').forEach((node) => {
			node.textContent = count;
		});
	}
}

function cartAdded(event) {
	const {
		message,
		success,
		payload: {
			cart_count: count,
			cart_item_key: key,
		} = {},
	} = event.detail.result;

	if (typeof count === 'number') {
		document.querySelectorAll('[data-cart-count] [data-roll-item]').forEach((node) => {
			node.textContent = count;
		});
	}

	if (message) {
		document.dispatchEvent(
			new CustomEvent('ajax-form:message', {
				detail: { message, success },
				bubbles: true,
			}),
		);
	}
}

