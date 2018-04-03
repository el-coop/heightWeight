<script>
	export default {
		name: "home",

		data() {
			return {
				message: "&lt;div id=\"height_and_weight\"&gt;&lt;/div&gt;\n" +
				"{% assign height_and_weight_app_data = product.metafields.height_weight %}\n" +
				"&lt;input type=\"hidden\"\n" +
				"value='@{{ height_and_weight_app_data[\"height_and_weight_app_data\"] }}'\n" +
				"name=\"hidden_metafiled\"\n" +
				"class=\"height_weight_hide_meta\"&gt;",

				activeInstructions: 0,
				instructions: [
					'Installation instructions',
					'Select app products',
					'Edit your products',
					'Questions / Suggestions'
				],

				tableFields: [
					{
						name: '__checkbox',
						titleClass: 'has-text-centered',
						dataClass: 'has-text-centered',
						visible: false
					},
					{
						name: 'image',
                        callback: this.productIcon
					},
					{
						name: 'title'
					},
					{
						name: '__component:product-actions',
						title: 'Actions',
						titleClass: 'has-text-centered',
					}
				]
			}
		},

		methods: {
			onCopy: function (e) {
				this.$toasted.success('Copied', {
					duration: 5000,
				})
			},
			onError: function (e) {
				alert('Failed to copy texts')
			},

            productIcon(value){
				let src;
				if(! value){
					src = '/images/noimg.jpg';
                } else {
					src = value.src;
                }

                return "<img src='" + src +"' class='product-preview'/>"
            }
		}
	}
</script>
