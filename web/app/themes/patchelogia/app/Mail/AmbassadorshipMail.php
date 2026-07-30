<?php

namespace App\Mail;

class AmbassadorshipMail extends Mailable
{
	public function __construct(
		string $name,
		string $link,
		string $comment,
		string $email,
		string $phone
	) {
		$this->subject = sprintf('Новая заявка на амбассадорство — %s', $name);
		$this->view = 'emails.ambassadorship';
		$this->data = [
			'name' => $name,
			'link' => $link,
			'comment' => $comment,
			'email' => $email,
			'phone' => $phone,
		];
	}
}
