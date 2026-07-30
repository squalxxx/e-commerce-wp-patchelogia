<?php

namespace App\Actions;

use App\Mail\FeedbacksMail;
use App\Models\Feedbacks;

class FeedbackAction extends Action
{
	protected function sanitize(array $data): array
	{
		return [
			'name' => sanitize_text_field($data['name'] ?? ''),
			'email' => sanitize_email($data['email'] ?? ''),
			'phone' => sanitize_text_field($data['phone'] ?? ''),
			'comment' => sanitize_textarea_field($data['comment'] ?? ''),
			'agreement' => !empty($data['agreement']),
		];
	}

	protected function validate(array $data): ?string
	{
		if (empty($data['name'])) {
			return 'Укажите как к Вам обращаться в поле "Имя".';
		}

		if (empty($data['email']) && empty($data['phone'])) {
			return 'Пожалуйста, укажите как с Вами связаться в полях "Почта" или "Телефон".';
		}

		if (!empty($data['email']) && !is_email($data['email'])) {
			return 'Проверьте корректность указанной почты.';
		}

		if (!$data['agreement']) {
			return 'К сожалению, без Вашего согласия с условиями оферты и политикой конфиденциальности мы не можем обработать Ваш запрос.';
		}

		return null;
	}

	protected function persist(array $data): bool
	{
		return (bool) Feedbacks::create([
			'name' => $data['name'],
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

		return (new FeedbacksMail($data['name']))->send($data['email']);
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
