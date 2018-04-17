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

        watch:{
			value(val){
				this.$emit('input',val);
            }
        },

		computed: {
			feetDisplay: {
				get() {
					if (Number.isNaN(this.inches) || this.inches == '') {
						return '';
					}
					return Math.floor(this.inches / 12);
				},
				set(val) {
					if (Number.isNaN(val)) {
						this.inches = this.inchDisplay;
						return;
					}
					this.inches = (parseFloat(val) * 12) + this.inchDisplay;
				}
			},
			inchDisplay: {
				get() {
					if (Number.isNaN(this.inches) || this.inches == '') {
						return '';
					}
					return Math.floor(this.inches % 12);
				},
				set(val) {
					if (Number.isNaN(val) || val == '') {
						this.inches = this.feetDisplay * 12;
						return
					}
					this.inches = this.feetDisplay * 12 + parseFloat(val);
				}
			},
			inches: {
				get() {
					if (Number.isNaN(this.value) || this.value == '') {
						return '';
					}
					return this.value * 0.393701;
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
