import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

export default function initSwipers() {
	const sliderSwiper = new Swiper('#sliderSwiper', {
		direction: 'horizontal',

		spaceBetween: 16,

		breakpoints: {
			0: {
				slidesPerView: 1,
			},
			480: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			1024: {
				slidesPerView: 4,
			},
			1280: {
				slidesPerView: 5,
			}
		}
	});

	const videoSwiper = new Swiper('#videoSwiper', {
		loop: true,
		centeredSlides: true,

		spaceBetween: 16,

		breakpoints: {
			0: {
				slidesPerView: 1,
			},
			480: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			1024: {
				slidesPerView: 4,
			},
			1280: {
				slidesPerView: 5,
			},
			1480: {
				slidesPerView: 6,
			}
		},

		on: {
			init(swiper) {
				updateVideos(swiper);
			},

			slideChangeTransitionEnd(swiper) {
				updateVideos(swiper);
			},
		},
	});

	function updateVideos(swiper) {
		swiper.slides.forEach((slide, index) => {
			const video = slide.querySelector('video');
			const image = slide.querySelector('img');

			if (!video || !image) {
				return;
			}

			if (index === swiper.activeIndex) {
				image.classList.add('opacity-0');

				video.classList.remove('hidden');
				video.currentTime = 0;
				video.play().catch(() => { });
			} else {
				image.classList.remove('opacity-0');

				video.pause();
				video.currentTime = 0;
				video.classList.add('hidden');
			}
		});
	}

	const productGallerySwiper = document.querySelector('#productGallerySwiper');
	if (productGallerySwiper) {
		new Swiper(productGallerySwiper, {
			direction: 'horizontal',
			autoplay: {
				delay: 3000,
			},

			slidesPerView: 1,
			spaceBetween: 16,

			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				640: {
					slidesPerView: 2,
				}
			},
		});
	}
}
