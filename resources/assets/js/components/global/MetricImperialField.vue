<template>
    <p class="control">
        <input v-show="metric == 'metric'"
               class="input" :class="{'is-danger': hasError}"
               :name="name"
               v-model="value"
               :placeholder="placeholder + '(cm)'">
        <span v-show="metric == 'imperial'">
            <input class="input" :class="{'is-danger': hasError}"
                   v-model="feetDisplay"
                   :placeholder="placeholder + '(ft)'">
            <input class="input" :class="{'is-danger': hasError}"
                   v-model="inchDisplay"
                   :placeholder="placeholder + '(in)'">
        </span>
    </p>

</template>

<script>
	export default {
		name: "metric-imperial-field",

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

		computed: {
			feetDisplay: {
				get() {
					return this.inches.toString().split(".")[0];
				},
				set(val) {
					this.inches = parseFloat(val + '.' + this.inchDisplay);
				}
			},
			inchDisplay: {
				get() {
					return this.inches.toString().split(".")[1];
				},
				set(val) {
					this.inches = parseFloat(this.feetDisplay + '.' + val);
				}
			},
			inches: {
				get() {
					return this.value * 0.032808;
				},
				set(val) {
					this.value = val / 0.032808;
				}
			}
		}
	}
</script>
