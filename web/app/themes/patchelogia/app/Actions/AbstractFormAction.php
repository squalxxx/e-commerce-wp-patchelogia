<?php

namespace App\Actions;

abstract class AbstractFormAction extends AbstractAction
{
	final public function handle(...$arguments): array
	{
		$data = $arguments[0] ?? [];

		if (!is_array($data)) {
			return $this->error('Invalid action payload.');
		}

		$data = $this->sanitize($data);
		$error = $this->validate($data);

		if ($error !== null) {
			return $this->error($error);
		}

		$data = $this->prepare($data);

		if (!$this->save($data)) {
			return $this->error($this->saveErrorMessage());
		}

		if (!$this->send($data)) {
			$this->onSendFailed($data);

			return $this->error($this->sendErrorMessage());
		}

		return $this->success($this->successMessage());
	}

	protected function prepare(array $data): array
	{
		return $data;
	}

	protected function onSendFailed(array $data): void {}

	abstract protected function sanitize(array $data): array;

	abstract protected function validate(array $data): ?string;

	abstract protected function save(array $data): bool;
	abstract protected function saveErrorMessage(): string;

	abstract protected function send(array $data): bool;
	abstract protected function sendErrorMessage(): string;

	abstract protected function successMessage(): string;
}
