<?php

/**
 * WooCommerce Template Functions
 */

function woocommerce_template_loop_product_thumbnail()
{
	global $product;

	$galleryImageIds = $product->get_gallery_image_ids();
	$hoverImageId = $galleryImageIds[0] ?? null; ?>

	<a href="<?= esc_url($product->get_permalink()); ?>" class="product-card__image relative block h-110 overflow-hidden">
		<?= $product->get_image('large', [
			'class' => 'pointer-events-none h-full w-full object-cover transition-opacity duration-500' . ($hoverImageId ? ' group-hover:opacity-0' : ''),
		]); ?>

		<?php if ($hoverImageId): ?>
			<?= wp_get_attachment_image($hoverImageId, 'large', false, [
				'class' => 'pointer-events-none absolute inset-0 h-full w-full object-cover opacity-0 transition-opacity duration-500 group-hover:opacity-100',
			]); ?>
		<?php endif; ?>
	</a>
<?php }

function woocommerce_template_loop_product_title()
{
	global $product; ?>

	<h2 class="product-card__name text-lg mb-1">
		<a href="<?= $product->get_permalink(); ?>">
			<?= $product->get_name(); ?>
		</a>
	</h2>
<?php }
