export default function initAjaxForms() {
	document.querySelectorAll('[data-ajax-form]').forEach(initForm);
}

function initForm(form) {
	const submitButton = form.querySelector('button[type="submit"], button:not([type])');
	const disableOnSuccess = form.hasAttribute('data-disable-on-success');

	form.addEventListener('submit', async (event) => {
		event.preventDefault();

		submitButton.disabled = true;

		const data = new FormData(form);

		data.append('action', form.dataset.action);
		data.append('_ajax_nonce', form.dataset.nonce);

		try {
			const response = await fetch(form.dataset.url, {
				method: 'POST',
				body: data,
			});

			const result = await response.json();

			dispatchMessage(form, result.message, result.success);

			if (result.success) {
				form.reset();

				if (!disableOnSuccess) {
					submitButton.disabled = false;
				}
			} else {
				submitButton.disabled = false;
			}
		} catch {
			dispatchMessage(form, 'Произошла ошибка. Попробуйте позже.', false);
			submitButton.disabled = false;
		}
	});
}

function dispatchMessage(form, message, success) {
	form.dispatchEvent(
		new CustomEvent('ajax-form:message', {
			detail: { message, success },
			bubbles: true,
		}),
	);
}