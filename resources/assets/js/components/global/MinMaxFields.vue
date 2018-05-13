<script>
	export default {
		name: "min-max-fields",

		props: {
			metric: {
				type: String,
				required: true
			},
			initMin: {
				required: false,
				default: 0
			}
			,
			initMax: {
				required: false,
				default: 0
			}
		},

		data() {
			return {
				isMounted: false,
				min: this.initMin,
				max: this.initMax
			}
		},

		mounted() {
			this.isMounted = true;
		},

		computed: {
			warning() {
				if (!this.isMounted) {
					return false;
				}
				if (this.$refs.max) {
					return (this.$refs.max.value - this.$refs.min.value) > 15;
				} else {
					return (this.max - this.min) > 15;
				}
			}
		}
	}
</script>