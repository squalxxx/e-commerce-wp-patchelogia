<?php

namespace App\View\Blocks;

abstract class Block
{
	/**
	 * The blocks ACF registration options, resolved once on instantiation.
	 */
	protected array $options;

	/**
	 * Resolve the blocks options and hook into ACF's block registration.
	 */
	public function __construct()
	{
		$this->options = $this->options();

		add_action('acf/init', [$this, 'register']);
	}

	/**
	 * The default options shared by every block.
	 * 
	 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	protected function defaultOptions(): array
	{
		return [
			'category' => 'theme',
			'icon' => 'block-default',
			'mode' => 'edit',
			'render_callback' => [$this, 'render'],
			'supports' => [
				'align' => ['wide', 'full'],
			],
		];
	}

	/**
	 * The block-specific options (name, title, etc).
	 * Must be implemented by every block.
	 * 
	 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	abstract protected function options(): array;

	/**
	 * Register the block with ACF.
	 */
	public function register(): void
	{
		if (!function_exists('acf_register_block_type')) {
			return;
		}

		acf_register_block_type(array_merge(
			$this->defaultOptions(),
			$this->options,
		));
	}

	/**
	 * The ACF fields available to the blocks view.
	 * Override in a child block to transform or extend the raw fields.
	 */
	protected function fields(): array
	{
		return get_fields() ?: [];
	}

	/**
	 * Render the blocks Blade view.
	 */
	public function render(array $block): void
	{
		echo view(
			sprintf('blocks.%s', $this->options['name']),
			[
				'block' => $block,
				'fields' => $this->fields(),
			]
		);
	}
}
