<?php

namespace App\Mail;

abstract class AbstractMailable
{
	protected string $view;
	protected string $subject;
	protected array $data = [];

	public function send(string $to): bool
	{
		add_filter('wp_mail_content_type', [$this, 'contentType']);

		try {
			return wp_mail(
				$to,
				$this->subject,
				$this->render(),
			);
		} finally {
			remove_filter('wp_mail_content_type', [$this, 'contentType']);
		}
	}

	public  function contentType(): string
	{
		return 'text/html';
	}

	final protected function render(): string
	{
		return (string) view($this->view, $this->data);
	}
}
