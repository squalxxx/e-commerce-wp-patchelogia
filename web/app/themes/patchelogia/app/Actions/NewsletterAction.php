<?php

namespace App\Actions;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;

class NewsletterAction extends AbstractFormAction
{
	protected function sanitize(array $data): array
	{
		return [
			'email' => sanitize_email($data['email'] ?? ''),
		];
	}

	protected function validate(array $data): ?string
	{
		if ($data['email'] === '') {
			return 'Увы, но не указана почта.';
		}

		if (!is_email($data['email'])) {
			return 'Пожалуйста, введите корректную почту.';
		}

		if (Newsletter::exists($data['email'])) {
			return 'К сожалению, вы уже подписаны на рассылку!';
		}

		return null;
	}

	protected function prepare(array $data): array
	{
		$data['promo_code'] = $this->generatePromoCode();

		return $data;
	}

	protected function save(array $data): bool
	{
		return Newsletter::create([
			'email' => $data['email'],
			'promo_code' => $data['promo_code'],
		]) !== null;
	}

	protected function send(array $data): bool
	{
		return (new NewsletterMail($data['promo_code']))
			->send($data['email']);
	}

	protected function onSendFailed(array $data): void
	{
		Newsletter::delete($data['email']);
	}

	protected function saveErrorMessage(): string
	{
		return 'Извините, но произошла ошибка при оформлении подписки. Сообщите нам, и мы обязательно поможем!';
	}

	protected function sendErrorMessage(): string
	{
		return 'По каким-то причинам не удалось отправить письмо, но вы можете написать нам, и мы обязательно решим проблему!';
	}

	protected function successMessage(): string
	{
		return 'Промокод на скидку 10% отправлен на вашу почту! Благодарим за доверие.';
	}

	private function generatePromoCode(): string
	{
		do {
			$code = 'PROMO' . strtoupper(
				wp_generate_password(6, false, false)
			);
		} while (Newsletter::promoCodeExists($code));

		return $code;
	}
}
