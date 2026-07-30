<?php

namespace App\Mail;

class FeedbackMail extends AbstractMailable
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
