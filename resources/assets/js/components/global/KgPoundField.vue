<template>
    <p class="control">
        <input v-show="metric == 'metric'"
               class="input" :class="{'is-danger': hasError}"
               :name="name"
               v-model="value"
               :placeholder="placeholder + ' kg'">
        <span v-show="metric == 'imperial'">
            <input class="input" :class="{'is-danger': hasError}"
                   v-model="lbs"
                   :placeholder="placeholder + ' Lbs'">
        </span>
    </p>

</template>

<script>
	export default {
		name: "kg-pound-field",

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
			lbs: {
				get() {
					if (Number.isNaN(this.value) || this.value == '') {
						return '';
					}
					return this.value * 2.205;
				},
				set(val) {
					if (Number.isNaN(val)) {
						this.value = 0;
						return;
					}
					this.value = val / 2.205;
				}
			}
		}
	}
</script>
