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
			<div class="column" :class="{'is-two-fifths': product.type !== 'other'}">
				<div class="title is-size-5" v-text="translations.recommendedSize">

				</div>
				<div class="is-flex centered">
					<span class="is-size-2" v-html="displayedResult"></span>
				</div>
			</div>
			<div class="column bordered-left" v-if="product.type !== 'other'">
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

	export default {
		name: "measurements",

		components: {
			FontAwesomeIcon,
			TShirt,
			Pants
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