<script>
	export default {
		name: "min-max-fields",

		props: {
			metric: {
				type: String,
				required: true
			}
		},

        data(){
		    return {
		    	isMounted: false
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

				return (this.$refs.max.value - this.$refs.min.value) > 15;
			}
		}
	}
</script>