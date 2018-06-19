<template>
    <div class="columns is-mobile">
        <div class="column" style="position: relative">
            <figure class="image is-square">
                <img src="/images/shirt-measurments.jpg">
            </figure>
            <input class="input sleeve is-small" v-model="sleeve"/>
            <input class="input bust is-small" v-model="bust"/>
            <input class="input length is-small" v-model="length"/>
            <input class="input waist is-small" v-model="waist"/>
        </div>

        <div class="column is-3 is-flex" style="align-items: center">
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
		},

		mounted() {
			let result = '';
			if (this.isDefined('height') && this.isDefined('weight')) {
				let resultCategory = this.findCategorySize('height', this.userData.height);
				let weightCategory = this.findCategorySize('weight', this.userData.weight);
				if (resultCategory !== weightCategory) {
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
				},
				set(val) {
					this.sleeve = this.product.data[val].sleeve.min || 0;
					this.bust = this.product.data[val].bust.min || 0;
					this.length = this.product.data[val].length.min || 0;
					this.waist = this.product.data[val].waist.min || 0;
					return val;
				}
			}
		},

	}
</script>

<style lang="scss" scoped>
    div {
        position: relative;
    }

    .sleeve {
        position: absolute;
        width: 4ch;
        top: 42%;
    }

    .bust {
        position: absolute;
        width: 5ch;
        top: 44%;
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
        top: 73%;
        left: 38%;
    }

</style>
