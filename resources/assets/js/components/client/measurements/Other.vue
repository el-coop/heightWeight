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
				sizes: this.sortSizes('length'),
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
		},

		mounted() {
			let result = '';
			if (this.isDefined('height') && this.isDefined('weight')) {
				let resultCategory = this.findCategorySize('height', this.userData.height);
				let weightCategory = this.findCategorySize('weight', this.userData.weight);
				if (resultCategory !== weightCategory) {
					resultCategory = Math.max(resultCategory, weightCategory);
					if (resultCategory !== 0) {
						if (this.userData.bmi < 18.5) {
							resultCategory--;
						}
					}

					if (resultCategory !== (this.sizes.length - 1)) {
						if (this.userData.bmi > 24.9) {
							resultCategory++;
						}
					}

					if (resultCategory !== (this.sizes.length - 1)) {
						if (this.userData.bmi > 29) {
							resultCategory++;
						}
					}
				}
				result = this.sizes[resultCategory];
			} else {
				let devisor = 0.358;
				if (this.product.gender === 'make') {
					devisor = 0.37;
				}
				let resultCategory = this.findCategorySize('length', Math.ceil(this.userData.height * 0.366));
				result = this.sizes[resultCategory];
			}
			this.$emit('calculated', result);
			this.inseam = parseFloat(this.product.data[result].inseam.min);
			this.length = parseFloat(this.product.data[result].length.min);
			this.waist = parseFloat(this.product.data[result].waist.min);
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
