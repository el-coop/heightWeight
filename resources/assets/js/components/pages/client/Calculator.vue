<template>
    <div class="section calculator">
        <measurements :start-metric="metric" v-if="step == 0" @next="incStep" @reset="resetSteps"
                      @height="changeHeight"></measurements>
        <body-type v-if="step == 1" :product-gender="product.gender" @next="incStep" @reset="resetSteps"></body-type>
        <calculator-result v-if="step == 2" :product="product" :result="result" @reset="resetSteps"></calculator-result>
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
				height: 0,
			}
		},

		methods: {
			incStep() {
				this.step++;
			},

			resetSteps() {
				this.step = 0;
			},

			changeHeight(value) {
				this.height = value;
			},

		},

		computed: {
			result() {
				return Math.ceil(this.height * 0.366);
			}
		}
	}
</script>

<style lang="scss" scoped>
    .calculator {
        padding-top: 10px;
        height: 100vh;
        width: 100vw;
    }
</style>

