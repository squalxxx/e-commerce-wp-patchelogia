<?php

namespace App\Models;

class Ambassador
{
	protected static function tableName(): string
	{
		global $wpdb;

		return $wpdb->prefix . 'ambassadors';
	}

	public static function createTable(): void
	{
		global $wpdb;

		$tableName = self::tableName();
		$charset = $wpdb->get_charset_collate();

		if ($wpdb->get_var("SHOW TABLES LIKE '{$tableName}'") !== $tableName) {
			$wpdb->query("
				CREATE TABLE {$tableName} (
					id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

					name VARCHAR(255) NOT NULL,
					link VARCHAR(255) NOT NULL,
					comment TEXT NOT NULL,
					email VARCHAR(255) DEFAULT NULL,
					phone VARCHAR(50) DEFAULT NULL,

					created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

					PRIMARY KEY (id)
				) {$charset};
			");
		}
	}

	public static function create(array $data): bool
	{
		global $wpdb;

		return (bool) $wpdb->insert(
			self::tableName(),
			[
				'name' => $data['name'],
				'link' => $data['link'],
				'comment' => $data['comment'],
				'email' => $data['email'] ?: null,
				'phone' => $data['phone'] ?: null,

				'created_at' => current_time('mysql'),
			],
			['%s', '%s', '%s', '%s', '%s', '%s']
		);
	}

	public static function exists(string $email): bool
	{
		global $wpdb;

		if ($email === '') {
			return false;
		}

		return (bool) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM " . self::tableName() . " WHERE email = %s",
				$email
			)
		);
	}

	public static function all(): array
	{
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . self::tableName() . " ORDER BY created_at DESC"
		);
	}

	public static function count(): int
	{
		global $wpdb;

		return (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM " . self::tableName()
		);
	}
}
