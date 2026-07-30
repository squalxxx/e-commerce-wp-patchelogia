import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import mask from '@alpinejs/mask';

import notification from '../components/notification';
import cartQuantityStepper from '../components/cart-quantity-stepper';

export default function initAlpine() {
	Alpine.plugin(collapse);

	Alpine.data('notification', notification);
	Alpine.data('cartQuantityStepper', cartQuantityStepper);

	window.Alpine = Alpine;
	Alpine.start();
}
