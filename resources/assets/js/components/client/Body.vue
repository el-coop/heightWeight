<template>
    <div>
        <div class="columns is-mobile">
            <div class="column is-four-fifths">
                <div class="subtitle is-size-6" v-text="translations.accurate"></div>
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
            <div class="column is-two-thirds">
                <div class="level is-mobile" style="margin-left: 20px">
                    <label class="radio level-item">
                        <input type="radio" name="body">
                    </label>
                    <label class="radio level-item">
                        <input type="radio" name="body">
                    </label>
                    <label class="radio level-item">
                        <input type="radio" name="body">
                    </label>
                </div>
                <figure class="image is-5by4">
                    <img :src="imgSrc">
                </figure>
            </div>
            <div class="column">
                <div class="field">
                    <label class="label has-text-centered" v-text="translations.wide"></label>
                    <div class="control">
                        <input class="slider is-fullwidth" step="25" min="0" max="100" v-model="wide" type="range">
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-centered" v-text="translations.full"></label>
                    <div class="control">
                        <input class="slider is-fullwidth" step="25" min="0" max="100" v-model="full" type="range">
                    </div>
                </div>
                <div class="field" style="margin-top: 75%">
                    <div class="control has-text-right">
                        <button class="button is-dark" @click="$emit('next')" v-text="translations.submit"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import faSync from '@fortawesome/fontawesome-free-solid/faSync'

	export default {
		name: "body",

		components: {
			FontAwesomeIcon
		},

		props: {
			productGender: {
				required: true,
				type: String
			},
			translations: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				wide: 50,
				full: 50
			}
		},

		computed: {
			refresh() {
				return faSync;
			},
			imgSrc() {
				if (this.productGender == 'female') {
					return '/images/body-types-female.jpg'
				} else {
					return '/images/body-types-male.jpg'
				}
			}
		},
	}
</script>
