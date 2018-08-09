<template>
	<p class="control">
		<input v-show="metric == 'metric'"
			   class="input" :class="{'is-danger': hasError}"
			   :name="name"
			   onfocus="console.log('here')"
			   v-model="value"
			   :placeholder="placeholder + ' cm'">
		<span v-show="metric == 'imperial'">
            <input class="input" :class="{'is-danger': hasError}"
				   v-model="inches"
				   @focus="$emit('focus')"
				   :placeholder="placeholder + ' In'">
        </span>
	</p>

</template>

<script>
	export default {
		name: "cm-inch-field",

		props: {
			hasError: {
				type: Boolean,
				default: false
			},
			name: {
				type: String,
				required: true
			},

			startValue: {
				type: String,
				default: ''
			},

			placeholder: {
				type: String,
				default: ''
			},

			metric: {
				type: String,
				required: true
			}
		},

		data() {
			return {
				value: this.startValue
			}
		},

		watch: {
			value(val) {
				this.$emit('input', val);
			}
		},

		computed: {
			inches: {
				get() {
					if (Number.isNaN(this.value) || this.value == '') {
						return '';
					}
					let value = this.value * 0.393701;
					return (parseFloat(value.toFixed(2)));
				},
				set(val) {
					if (Number.isNaN(val)) {
						this.value = 0;
						return;
					}
					this.value = val / 0.393701;
				}
			}
		}
	}
</script>
