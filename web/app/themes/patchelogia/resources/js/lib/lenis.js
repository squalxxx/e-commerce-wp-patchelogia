import Lenis from 'lenis';
import 'lenis/dist/lenis.css';

export default function initLenis() {
	return new Lenis({
		autoRaf: true,
		autoToggle: true,
		anchors: true,
		allowNestedScroll: true,
		naiveDimensions: true,
		stopInertiaOnNavigate: true,
	});
}
