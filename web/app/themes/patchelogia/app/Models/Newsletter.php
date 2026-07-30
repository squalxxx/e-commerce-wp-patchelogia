<?php

namespace App\Models;

class Newsletter
{
	protected static function tableName(): string
	{
		global $wpdb;

		return $wpdb->prefix . 'newsletter';
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

					email VARCHAR(255) NOT NULL,
					promo_code VARCHAR(100) NOT NULL,
					
					activated_at DATETIME DEFAULT NULL,
					created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

					PRIMARY KEY (id),
					UNIQUE KEY email (email),
					UNIQUE KEY promo_code (promo_code)
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
				'email' => $data['email'],
				'promo_code' => $data['promo_code'],

				'created_at' => current_time('mysql'),
			],
			['%s', '%s', '%s']
		);
	}

	public static function delete(string $email): bool
	{
		global $wpdb;

		return (bool) $wpdb->delete(
			self::tableName(),
			['email' => $email],
			['%s']
		);
	}

	public static function exists(string $email): bool
	{
		global $wpdb;

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

	public static function activate(string $promoCode): bool
	{
		global $wpdb;

		return (bool) $wpdb->update(
			self::tableName(),
			[
				'activated_at' => current_time('mysql'),
			],
			[
				'promo_code' => $promoCode,
			],
			[
				'%s',
			],
			[
				'%s',
			]
		);
	}

	public static function count(): int
	{
		global $wpdb;

		return (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM " . self::tableName()
		);
	}

	public static function promoCodeExists(string $promoCode): bool
	{
		global $wpdb;

		return (bool) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM " . self::tableName() . " WHERE promo_code = %s",
				$promoCode
			)
		);
	}
}
