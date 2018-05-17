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
                    <input type="text" class="input" v-model="measuredCategory">
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
			result: {
				required: true,
				type: Number
			}
		},

		data() {
			return {
				sleeve: this.findMin('sleeve'),
				bust: this.findMin('bust'),
				length: this.findMin('length'),
				waist: this.findMin('waist')
			}
		},

		methods: {
			findMin(category) {
				let values = _.map(this.product.data, (size) => {
					return size[category].min;
				});
				return _.min(values);
			},

			findCategorySize(category, measurement) {
				let result = '';

				for (let size in this.product.data) {
					let min = 0;
					let max = 10000000;
					if (this.product.data[size][category].min) {
						min = this.product.data[size][category].min;
					}
					if (this.product.data[size][category].max) {
						max = this.product.data[size][category].max;
					}
					if (measurement <= max && measurement >= min) {
						result = size;
					}
				}

				return result;
			},

			findMaxCategory(...categories) {
				let result = '';
				categories.forEach((category) => {
					if (result === '') {
						result = category;
					} else if (category !== '') {
						if (this.product.data[category].sleeve.min > this.product.data[result].sleeve.max) {
							result = category;
						}
					}
				});

				return result;
			}
		},

		mounted() {
			this.$emit('calculated', this.findCategorySize('height', this.result));
		},

		computed: {
			measuredCategory() {
				let sleeveCategory = this.findCategorySize('sleeve', this.sleeve);
				let bustCategory = this.findCategorySize('bust', this.bust);
				let lengthCategory = this.findCategorySize('length', this.length);
				let waistCategory = this.findCategorySize('waist', this.waist);
				return this.findMaxCategory(sleeveCategory, bustCategory, lengthCategory, waistCategory);
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
