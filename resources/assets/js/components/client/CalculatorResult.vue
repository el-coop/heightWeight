<template>
	<div>
		<div class="columns is-mobile">
			<div class="column is-four-fifths">
				<div class="subtitle is-size-6"></div>
			</div>
			<div class="column">
				<button class="button is-pulled-right" @click="$emit('reset')">
                    <span class="icon is-small">
                        <font-awesome-icon :icon="refresh"></font-awesome-icon>
                    </span>
				</button>
			</div>

		</div>
		<div class="columns is-mobile">
			<div class="column" :class="{'is-two-fifths': showMeasurements}">
				<div class="title is-size-5" v-text="translations.recommendedSize">

				</div>
				<div class="is-flex centered">
					<span class="is-size-2" v-html="displayedResult"></span>
				</div>
				<div style="margin-top: 30px">
					<span class="help is-danger" v-if="showWarning">It seems you are between sizes, please contact out store for your size before you place an order</span>
				</div>
			</div>
			<div class="column bordered-left" v-show="showMeasurements">
				<div class="title is-size-5" v-text="translations.productSizes">

				</div>
				<component :product="product" :user-data="userData"
						   @calculated="displayResult" :is="product.type">

				</component>
			</div>
		</div>
	</div>
</template>

<script>
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import faSync from '@fortawesome/fontawesome-free-solid/faSync'
	import TShirt from './measurements/Shirt';
	import Pants from './measurements/Pants';
	import Other from './measurements/Other';

	export default {
		name: "measurements",

		components: {
			FontAwesomeIcon,
			TShirt,
			Pants,
			Other
		},

		props: {
			product: {
				type: Object,
				required: true
			},
			userData: {
				type: Object,
				required: true
			},
			translations: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				displayedResult: ''
			}
		},

		methods: {
			displayResult(value) {
				this.displayedResult = value;
				window.parent.postMessage({'suggestedSize': this.displayedResult}, "*");
			}
		},

		computed: {
			refresh() {
				return faSync;
			},
			showMeasurements() {
				let count = 0;
				for (let size in this.product.data) {
					for (let category in this.product.data[size]) {
						if (category !== 'height' && category !== 'weight' && this.product.data[size][category]['min'] !== null) {
							count++;
						}
					}
				}

				return count > 0;
			},
			showWarning() {
				if (this.userData.bmi < 19 || this.userData.bmi >= 35) {
					return true;
				}
				return false;
			}
		},
	}
</script>

<style lang="scss" scoped>
	.bordered-left {
		border-left-color: hsl(0, 0, 80%);
		border-left-style: dashed;
		border-left-width: 1px;
	}

	.is-flex.centered {
		justify-content: center;
		align-items: center;
	}
</style>