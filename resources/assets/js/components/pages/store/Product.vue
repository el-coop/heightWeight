<script>
	export default {
		name: "product",

        props: {
		    startMetric: {
		    	required: true,
                type: String
            }
        },

        data(){
			return {
				metric: this.startMetric
            }
        }
	}
</script>