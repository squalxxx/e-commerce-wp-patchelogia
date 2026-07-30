<?php

namespace App\Actions;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;

class NewsletterAction extends Action
{
	protected function sanitize(array $data): array
	{
		return [
			'email' => sanitize_email($data['email'] ?? ''),
		];
	}

	protected function validate(array $data): ?string
	{
		if (empty($data['email'])) {
			return 'Увы, но не указана почта.';
		}

		if (!is_email($data['email'])) {
			return 'Пожалуйста, введите корректную почту.';
		}

		if (Newsletter::exists($data['email'])) {
			return 'К сожалению, Вы уже подписаны на рассылку!';
		}

		return null;
	}

	protected function prepare(array $data): array
	{
		$data['promo_code'] = $this->generatePromoCode();

		return $data;
	}

	protected function persist(array $data): bool
	{
		return (bool) Newsletter::create([
			'email' => $data['email'],
			'promo_code' => $data['promo_code'],
		]);
	}

	protected function notify(array $data): bool
	{
		return (new NewsletterMail($data['promo_code']))->send($data['email']);
	}

	protected function onNotifyFailed(array $data): void
	{
		Newsletter::delete($data['email']);
	}

	protected function persistErrorMessage(): string
	{
		return 'Извините, но произошла ошибка при оформлении подписки. Сообщите нам и мы обязательно поможем!';
	}

	protected function notifyErrorMessage(): string
	{
		return 'По каким-то причинам не удалось отправить письмо, но Вы можете написать нам и мы обязательно решим проблему!';
	}

	protected function successMessage(): string
	{
		return 'Промокод на скидку 10% отправлен на Вашу почту! Благодарим за Ваше доверие.';
	}

	private function generatePromoCode(): string
	{
		do {
			$code = 'PROMO' . strtoupper(wp_generate_password(6, false, false));
		} while (Newsletter::promoCodeExists($code));

		return $code;
	}
}
