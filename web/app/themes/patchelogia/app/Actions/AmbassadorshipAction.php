<?php

namespace App\Actions;

use App\Mail\AmbassadorshipMail;
use App\Models\Ambassadors;

class AmbassadorshipAction extends Action
{
	protected function sanitize(array $data): array
	{
		return [
			'name' => sanitize_text_field($data['name'] ?? ''),
			'link' => sanitize_text_field($data['link'] ?? ''),
			'email' => sanitize_email($data['email'] ?? ''),
			'phone' => sanitize_text_field($data['phone'] ?? ''),
			'comment' => sanitize_textarea_field($data['comment'] ?? ''),
			'agreement' => !empty($data['agreement']),
		];
	}

	protected function validate(array $data): ?string
	{
		if ($data['name'] === '' || $data['link'] === '' || $data['comment'] === '') {
			return 'Заполните обязательные поля.';
		}

		if ($data['email'] === '' && $data['phone'] === '') {
			return 'Укажите почту или телефон для связи.';
		}

		if ($data['email'] !== '' && !is_email($data['email'])) {
			return 'Введите корректный e-mail.';
		}

		if (!$data['agreement']) {
			return 'Подтвердите согласие с условиями оферты.';
		}

		if ($data['email'] !== '' && Ambassadors::exists($data['email'])) {
			return 'Вы уже подавали заявку с этой почтой.';
		}

		return null;
	}

	protected function persist(array $data): bool
	{
		return (bool) Ambassadors::create([
			'name' => $data['name'],
			'link' => $data['link'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'comment' => $data['comment'],
		]);
	}

	protected function notify(array $data): bool
	{
		if (empty($data['email'])) {
			return true;
		}

		return (new AmbassadorshipMail(
			$data['name'],
			$data['link'],
			$data['comment'],
			$data['email'],
			$data['phone']
		))->send($data['email']);
	}

	protected function persistErrorMessage(): string
	{
		return 'Извините, но произошла ошибка при создании заявки. Сообщите нам и мы обязательно поможем!';
	}

	protected function notifyErrorMessage(): string
	{
		return 'По каким-то причинам не удалось отправить заявку, но Вы можете написать нам и мы обязательно решим проблему!';
	}

	protected function successMessage(): string
	{
		return 'Спасибо! Ваша заявка отправлена — уже в ближайшее время мы с Вами свяжемся.';
	}
}
