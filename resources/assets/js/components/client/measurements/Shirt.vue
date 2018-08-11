<template>
	<div class="columns is-mobile">
		<div class="column" style="position: relative">
			<figure class="image is-square">
				<img src="/images/shirt-measurements.png">
			</figure>
			<input class="input sleeve is-small" v-model="sleeve"/>
			<input class="input bust is-small" v-model="bust"/>
			<input class="input length is-small" v-model="length"/>
			<input class="input waist is-small" v-model="waist"/>
		</div>

		<div class="column is-3 is-flex" style="align-items: center; padding-left: 0">
			<div class="field">
				<div class="control">
					<div class="select">
						<select v-model="measuredCategory">
							<option v-for="size in sizes" :value="size" v-html="size"></option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	export default {
		name: "measurements",

		props: {
			product: {
				required: true,
				type: Object
			},
			userData: {
				required: true,
				type: Object
			}
		},

		data() {
			return {
				sizes: [],
				sleeve: 0,
				bust: 0,
				length: 0,
				waist: 0,
			}
		},

		methods: {
			sortSizes(category) {
				let result = _.keys(this.product.data);

				result.sort((a, b) => {
					if (parseFloat(this.product.data[a][category].min) < parseFloat(this.product.data[b][category].min)) {
						return -1;
					}

					if (parseFloat(this.product.data[a][category].min) > parseFloat(this.product.data[b][category].min)) {
						return 1;
					}
					return 0;
				});

				return result;
			},

			isDefined(category) {
				return (this.product.data[this.sizes[0]][category].min || this.product.data[this.sizes[1]][category].min);
			},

			findCategorySize(category, measurement) {

				let i = 0;

				while ((i + 1) !== this.sizes.length && parseFloat(this.product.data[this.sizes[i + 1]][category].min) <= measurement) {
					i++;
				}
				return i;
			},

			calculateByHeightWeight() {
				let resultCategory = 0;
				let heightCategory = this.findCategorySize('height', this.userData.height);
				let weightCategory = this.findCategorySize('weight', this.userData.weight);
				if (heightCategory === weightCategory) {
					resultCategory = heightCategory;
				} else {
					if (this.userData.bmi < 22) {
						resultCategory = Math.min(heightCategory, weightCategory);
					} else if (this.userData.bmi < 25 || Math.abs(heightCategory, weightCategory) > 1) {
						resultCategory = Math.max(heightCategory, weightCategory);
					} else {
						resultCategory = Math.max(heightCategory, weightCategory);
						if (resultCategory + 1 < this.sizes.length) {
							resultCategory++;
						}
					}
				}
				return this.sizes[resultCategory];
			},

			calculateByProductLength() {
				let divisor = 0.35856;
				if (this.product.gender === 'male') {
					divisor = 0.3686;
				}
				if (this.product.gender === 'unisex') {
					divisor = 0.36548;
				}
				if (this.userData.bmi > 31) {
					divisor += 0.02;
				}
				if (this.userData.bmi > 35) {
					divisor += 0.01;
				}
				let resultCategory = this.findCategorySize('length', Math.ceil(this.userData.height * divisor));
				return this.sizes[resultCategory];
			},

			calculateByLengthAndHeight() {
				let resultCategory = 0;
				let heightCategory = this.findCategorySize('height', this.userData.height);
				let weightCategory = this.findCategorySize('weight', this.userData.weight);
				if (heightCategory === weightCategory) {
					resultCategory = heightCategory;
				} else {
					if (this.userData.bmi < 22) {
						resultCategory = Math.min(heightCategory, weightCategory);
					} else if (this.userData.bmi < 26.5) {
						if (Math.abs(heightCategory, weightCategory) > 1) {
							resultCategory = this.calculateByProductLength();
						} else {
							resultCategory = Math.max(heightCategory, weightCategory);
						}
					} else {
						resultCategory = Math.max(heightCategory, weightCategory);
						if (resultCategory + 1 < this.sizes.length) {
							resultCategory++;
						}
					}
				}
				return this.sizes[resultCategory];
			}
		},

		mounted() {
			let result = '';
			if (this.isDefined('height') && this.isDefined('weight') && !this.isDefined('length')) {
				this.sizes = this.sortSizes('height');
				result = this.calculateByHeightWeight();
			} else if (!this.isDefined('height') && this.isDefined('length')) {
				this.sizes = this.sortSizes('length');
				result = this.calculateByProductLength();
			} else if (this.isDefined('height') && this.isDefined('length')) {

			}
			this.$emit('calculated', result);
			this.sleeve = parseFloat(this.product.data[result].sleeve.min);
			this.bust = parseFloat(this.product.data[result].bust.min);
			this.length = parseFloat(this.product.data[result].length.min);
			this.waist = parseFloat(this.product.data[result].waist.min);
		},

		computed: {
			measuredCategory: {
				get() {
					let sleeveCategory = -1;
					if (this.sleeve) {
						sleeveCategory = this.findCategorySize('sleeve', this.sleeve);
					}
					let bustCategory = -1;
					if (this.bust) {
						bustCategory = this.findCategorySize('bust', this.bust);
					}
					let lengthCategory = -1;
					if (this.length) {
						lengthCategory = this.findCategorySize('length', this.length);
					}
					let waistCategory = -1;
					if (this.waist) {
						waistCategory = this.findCategorySize('waist', this.waist);
					}
					return this.sizes[Math.max(sleeveCategory, bustCategory, lengthCategory, waistCategory)];
				}
				,
				set(val) {
					this.sleeve = parseFloat(this.product.data[val].sleeve.min || 0);
					this.bust = parseFloat(this.product.data[val].bust.min || 0);
					this.length = parseFloat(this.product.data[val].length.min || 0);
					this.waist = parseFloat(this.product.data[val].waist.min || 0);
					return val;
				}
			}
		}
		,

	}
</script>

<style lang="scss" scoped>
	div {
		position: relative;
	}

	.sleeve {
		position: absolute;
		width: 4ch;
		top: 23%;
	}

	.bust {
		position: absolute;
		width: 5ch;
		top: 34%;
		left: 40%;
	}

	.length {
		position: absolute;
		width: 5ch;
		top: 65%;
		left: 55%;
	}

	.waist {
		position: absolute;
		width: 5ch;
		top: 80%;
		left: 38%;
	}

</style>
