export default () => ({
	visible: false,
	success: true,
	message: '',
	timeout: null,

	show(event) {
		clearTimeout(this.timeout);

		this.message = event.detail.message;
		this.success = event.detail.success;
		this.visible = false;

		this.$nextTick(() => {
			this.visible = true;
		});

		this.timeout = setTimeout(() => {
			this.visible = false;
		}, 6000);
	},

	hide() {
		clearTimeout(this.timeout);
		this.visible = false;
	},
});