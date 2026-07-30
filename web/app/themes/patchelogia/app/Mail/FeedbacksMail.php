<?php

namespace App\Mail;

class FeedbacksMail extends Mailable
{
	public function __construct(string $name)
	{
		$this->subject = sprintf('Ваше обращение в "Отдел заботы" на %s — получено!', get_bloginfo('name'));
		$this->view = 'emails.feedbacks';
		$this->data = [
			'name' => $name
		];
	}
}
