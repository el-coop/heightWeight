<template>
    <div>
        <div class="columns is-mobile">
            <div class="column is-four-fifths">
                <div class="subtitle is-size-6" v-text="translations.insert"></div>
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
            <div class="column">
                <div class="field">
                    <div class="control">
                        <metric-imperial-field
                                v-model="height"
                                :metric="metric"
                                :has-error="false"
                                name="height"
                                start-value=""
                                :placeholder="translations.height">
                        </metric-imperial-field>

                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <div class="control">
                        <kg-pound-field :placeholder="translations.weight" v-model="weight" name="weight"
                                        :metric="metric"></kg-pound-field>
                    </div>
                </div>
            </div>
        </div>

        <div class="level is-mobile">
            <div class="level-left">
                <div class="control level-item">
                    <label class="radio">
                        {{ translations.metric }}
                        <input type="radio" name="measurement"
                               value="metric" v-model="metric">

                    </label>
                    <span>&nbsp;/&nbsp;</span>
                    <label class="radio">
                        <input type="radio" name="measurement"
                               value="imperial" v-model="metric">
                        {{ translations.imperial }}
                    </label>
                </div>
            </div>
            <div class="level-right">
                <div class="control level-item">
                    <button class="button is-dark" @click="calculateBmi()" :disabled="height == '' || weight == ''"
                            v-text="translations.next">
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import faSync from '@fortawesome/fontawesome-free-solid/faSync'

	export default {
		name: "measurements",

		components: {
			FontAwesomeIcon
		},

		props: {
			startMetric: {
				type: String,
				required: true
			},
			translations: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				metric: this.startMetric,
				weight: '',
				height: '',
				bmi: 0
			}
		},

		computed: {
			refresh() {
				return faSync;
			},
		},

		methods: {
			calculateBmi() {
				this.bmi = this.weight / (this.height-2) / this.height * 10000;
				this.$emit('user-data', {
					height: this.height,
					weight: this.weight,
					bmi: this.bmi
				});
				this.$emit('next');
			}
		},
	}
</script>
