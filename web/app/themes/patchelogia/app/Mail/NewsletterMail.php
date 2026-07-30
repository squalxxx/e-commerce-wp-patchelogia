<?php

namespace App\Mail;

class NewsletterMail extends AbstractMailable
{
	public function __construct(string $promoCode)
	{
		$this->subject = sprintf('Ваш промокод от %s', get_bloginfo('name'));
		$this->view = 'emails.newsletter';
		$this->data = [
			'promoCode' => $promoCode
		];
	}
}
