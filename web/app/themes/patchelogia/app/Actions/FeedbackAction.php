<?php

namespace App\Actions;

use App\Mail\FeedbackMail;
use App\Models\Feedback;

class FeedbackAction extends AbstractFormAction
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
		if ($data['name'] === '') {
			return 'Укажите как к Вам обращаться в поле «Имя».';
		}

		if ($data['email'] === '' && $data['phone'] === '') {
			return 'Пожалуйста, укажите как с Вами связаться в полях «Почта» или «Телефон».';
		}

		if ($data['email'] !== '' && !is_email($data['email'])) {
			return 'Проверьте корректность указанной почты.';
		}

		if (!$data['agreement']) {
			return 'К сожалению, без Вашего согласия с условиями оферты и политикой конфиденциальности мы не можем обработать Ваш запрос.';
		}

		return null;
	}

	protected function save(array $data): bool
	{
		return (bool) Feedback::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'comment' => $data['comment'],
		]);
	}

	protected function send(array $data): bool
	{
		if ($data['email'] === '') {
			return true;
		}

		return (new FeedbackMail($data['name']))
			->send($data['email']);
	}

	protected function saveErrorMessage(): string
	{
		return 'Извините, но произошла ошибка при создании заявки. Сообщите нам, и мы обязательно поможем!';
	}

	protected function sendErrorMessage(): string
	{
		return 'По каким-то причинам не удалось отправить заявку, но вы можете написать нам, и мы обязательно решим проблему!';
	}

	protected function successMessage(): string
	{
		return 'Спасибо! Ваша заявка отправлена — уже в ближайшее время мы с вами свяжемся.';
	}
}
