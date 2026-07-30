<?php

namespace App\Mail;

abstract class Mailable
{
	protected string $view;
	protected string $subject;
	protected array $data = [];

	public function send(string $to): bool
	{
		add_filter('wp_mail_content_type', [$this, 'contentType']);

		$sent = wp_mail($to, $this->subject, $this->render());

		remove_filter('wp_mail_content_type', [$this, 'contentType']);

		return $sent;
	}

	public function contentType(): string
	{
		return 'text/html';
	}

	protected function render(): string
	{
		return (string) view($this->view, $this->data);
	}
}
