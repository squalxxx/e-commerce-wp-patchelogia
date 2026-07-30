<?php

namespace App\Actions;

abstract class AbstractAction
{
	/**
	 * Execute action.
	 */
	abstract public function handle(...$arguments): mixed;

	protected function success(string $message, array $payload = []): array
	{
		return [
			'success' => true,
			'message' => $message,
			'payload' => $payload,
		];
	}

	protected function error(string $message): array
	{
		return [
			'success' => false,
			'message' => $message,
		];
	}
}
