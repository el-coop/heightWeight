<template>
	<div class="columns is-mobile">
		<div class="column" style="position: relative">
			<figure class="image is-square">
				<img src="/images/pants-measurements.jpg">
			</figure>
			<input class="input waist is-small" v-model="waist"/>
			<input class="input length is-small" v-model="length"/>
			<input class="input inseam is-small" v-model="inseam"/>
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
				sizes: this.sortSizes('height'),
				inseam: 0,
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
				console.log('height category', heightCategory);
				console.log('weight category', weightCategory);
				if (heightCategory === weightCategory) {
					resultCategory = heightCategory;
				} else {
					if (this.userData.bmi < 22) {
						resultCategory = Math.min(heightCategory, weightCategory);
					} else if (this.userData.bmi < 25) {
						if (heightCategory > weightCategory) {
							let minHigh = this.product.data[this.sizes[heightCategory]]['height'].min;
							let maxLow = this.product.data[this.sizes[weightCategory]]['weight'].max;
							if ((this.userData.height - minHigh) > (maxLow - this.userData.weight)) {
								resultCategory = heightCategory;
							} else {
								resultCategory = weightCategory;
							}
						} else {
							let maxLow = this.product.data[heightCategory]['height'].max;
							let minHigh = this.product.data[weightCategory]['weight'].min;
							if ((this.userData.weight - minHigh) > (maxLow - this.userData.height)) {
								resultCategory = weightCategory;
							} else {
								resultCategory = heightCategory;
							}
						}
					} else if (this.userData.bmi < 28.5) {
						resultCategory = Math.max(heightCategory, weightCategory);
					} else if (this.userData.bmi < 35) {
						resultCategory = Math.max(heightCategory, weightCategory);
						if (resultCategory + 1 < this.sizes.length && Math.abs(heightCategory - weightCategory) === 1) {
							resultCategory++;
						}
					} else {
						resultCategory = Math.max(heightCategory, weightCategory);
						if (resultCategory + 1 < this.sizes.length) {
							resultCategory++;
						}
					}
				}
				return this.sizes[resultCategory];
			},
		},

		mounted() {
			this.sizes = this.sortSizes('height');
			let result = this.calculateByHeightWeight();
			this.$emit('calculated', result);
			this.inseam = parseFloat(this.product.data[result].inseam.min || 0);
			this.length = parseFloat(this.product.data[result].length.min || 0);
			this.waist = parseFloat(this.product.data[result].waist.min || 0);
		},

		computed: {
			measuredCategory: {
				get() {
					let inseamCategory = -1;
					if (this.inseam) {
						inseamCategory = this.findCategorySize('inseam', this.inseam);
					}
					let lengthCategory = -1;
					if (this.length) {
						lengthCategory = this.findCategorySize('length', this.length);
					}
					let waistCategory = -1;
					if (this.waist) {
						waistCategory = this.findCategorySize('waist', this.waist);
					}
					return this.sizes[Math.max(inseamCategory, lengthCategory, waistCategory)];
				}
				,
				set(val) {
					this.inseam = parseFloat(this.product.data[val].inseam.min || 0);
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

	.inseam {
		position: absolute;
		width: 4ch;
		top: 84%;
		left: 71%;
	}

	.length {
		position: absolute;
		width: 5ch;
		top: 50%;
		left: 81%;
	}

	.waist {
		position: absolute;
		width: 5ch;
		top: 10%;
		left: 38%;
	}

</style>
