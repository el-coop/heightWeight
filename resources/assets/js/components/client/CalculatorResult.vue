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
            <div class="column is-two-fifths">
                <div class="title is-size-5">
                    Your recommended size is:
                </div>
                <div class="is-flex centered">
                    <span class="is-size-2" v-html="displayedResult"></span>
                </div>
            </div>
            <div class="column bordered-left">
                <div class="title is-size-5">
                    Product sizes:
                </div>
                <shirt-measurements :product="product" :user-data="userData" @calculated="displayResult">

                </shirt-measurements>
            </div>
        </div>
    </div>
</template>

<script>
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import faSync from '@fortawesome/fontawesome-free-solid/faSync'
	import ShirtMeasurements from './measurements/Shirt';

	export default {
		name: "measurements",

		components: {
			FontAwesomeIcon,
			ShirtMeasurements
		},

		props: {
			product: {
				type: Object,
				required: true
			},
			userData: {
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