<?php

namespace App\Actions;

abstract class Action
{
	final public function handle(array $data): array
	{
		$data = $this->sanitize($data);

		if ($error = $this->validate($data)) {
			return $this->error($error);
		}

		$data = $this->prepare($data);

		if (!$this->persist($data)) {
			return $this->error($this->persistErrorMessage());
		}

		if (!$this->notify($data)) {
			$this->onNotifyFailed($data);

			return $this->error($this->notifyErrorMessage());
		}

		return $this->success($this->successMessage());
	}

	protected function prepare(array $data): array
	{
		return $data;
	}

	protected function onNotifyFailed(array $data): void {}

	protected function success(string $message): array
	{
		return ['success' => true, 'message' => $message];
	}

	protected function error(string $message): array
	{
		return ['success' => false, 'message' => $message];
	}

	abstract protected function sanitize(array $data): array;
	abstract protected function validate(array $data): ?string;
	abstract protected function persist(array $data): bool;
	abstract protected function notify(array $data): bool;
	abstract protected function persistErrorMessage(): string;
	abstract protected function notifyErrorMessage(): string;
	abstract protected function successMessage(): string;
}
