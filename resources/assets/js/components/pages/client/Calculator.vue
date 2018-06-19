<template>
    <div class="section calculator">
        <measurements :start-metric="metric" v-if="step == 0" @next="incStep" @reset="resetSteps"
                      @user-data="userData"></measurements>
        <body-type v-if="step == 1" :product-gender="product.gender" @next="incStep" @reset="resetSteps"></body-type>
        <calculator-result v-if="step == 2" :product="product" :user-data="user"
                           @reset="resetSteps"></calculator-result>
    </div>
</template>

<script>
	import Measurements from '../../client/Measurements';
	import BodyType from '../../client/Body';
	import CalculatorResult from '../../client/CalculatorResult';

	export default {
		components: {
			Measurements,
			BodyType,
			CalculatorResult
		},
		props: {
			product: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				metric: 'metric',
				step: 0,
				user: {
					height: 0,
					bmi: 0,
					weight: 0
				}
			}
		},

		methods: {
			incStep() {
				this.step++;
			},

			resetSteps() {
				this.step = 0;
			},

			userData(value) {
				this.user = value;
			},

		},
	}
</script>

<style lang="scss" scoped>
    .calculator {
        padding-top: 10px;
        height: 100vh;
        width: 100vw;
    }
</style>

