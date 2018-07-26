<script>
	export default {
		name: "product",

		props: {
			startMetric: {
				required: true,
				type: String
			}
		},

		data() {
			return {
				metric: this.startMetric,
				showMessage: false
			}
		},

		mounted() {
			this.addChangeListeners();
			window.onbeforeunload = () => {
				if (this.showMessage) {
					return "We detected you made some changes and didn't save. Are you sure you want to leave the page?";
				}
			};
		},

		methods: {
			addChangeListeners() {
				document.querySelectorAll('input, select').forEach((input) => {
					input.addEventListener('change', () => {
						this.showMessage = true;
					})
				});
			}
		}
	}
</script>