const phrases = [
	'Что это?',
	'Узнай больше',
	'Почему патчи?',
	'Как это работает?',
	'Листай ниже',
];

export default function heroScrollButton() {
	const hero = document.querySelector('.hero-banner');
	const button = document.querySelector('.hero-banner__scroll');
	const text = document.querySelector('.hero-banner__typing');

	if (!button || !hero || !text) {
		return;
	}

	let phraseIndex = 0;
	let charIndex = 0;
	let deleting = false;

	function type() {
		const phrase = phrases[phraseIndex];

		text.textContent = phrase.slice(0, charIndex);

		if (!deleting) {
			if (charIndex < phrase.length) {
				charIndex++;
				setTimeout(type, 80);
			} else {
				deleting = true;
				setTimeout(type, 1500);
			}
		} else {
			if (charIndex > 0) {
				charIndex--;
				setTimeout(type, 40);
			} else {
				deleting = false;
				phraseIndex = (phraseIndex + 1) % phrases.length;
				setTimeout(type, 400);
			}
		}
	}

	type();

	window.addEventListener('scroll', () => {
		const rect = hero.getBoundingClientRect();
		const progress = Math.min(
			Math.max(-rect.top / rect.height, 0),
			1,
		);
		const translateY = progress * -120;

		button.style.bottom = `${translateY}px`;
	});
}