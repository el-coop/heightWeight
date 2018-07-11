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
					'Questions / Suggestions',
					'New features',
				],

				copyingFields: false,
				copyingId: null,
				copying: false,
				submitting: false
			}
		},

		computed: {
			selectedTo() {
				return this.$refs.table.selectedTo;
			},

			tableFields() {
				return [
					{
						name: '__checkbox',
						titleClass: 'has-text-centered',
						dataClass: 'has-text-centered',
						visible: this.copyingFields
					},
					{
						name: 'image',
						callback: this.productIcon
					},
					{
						name: 'title'
					},
					{
						name: '__slot:productactions',
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

			startCopyingRow(data) {
				if (this.copyingFields) {
					this.copyingFields = false;
					return;
				}

				this.copyingFields = true;
				this.copyingId = data.id;
			},

			productIcon(value) {
				let src;
				if (!value) {
					src = '/images/noimg.jpg';
				} else {
					src = value.src;
				}

				return "<img src='" + src + "' class='product-preview'/>"
			},

			copyFields() {
				this.copying = true;
				axios.put('/store/products/copy/' + this.copyingId, {
					products: this.selectedTo
				}).then(() => {
					this.copying = false;
					this.copyingFields = false;
					this.$refs.table.refresh();
				}).catch(() => {
					this.copying = false;
					alert('An error occurred, please try again');
				})
			}
		}
	}
</script>
