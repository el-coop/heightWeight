<template>
    <div class="buttons is-centered">
        <button class="button">{{ rowData.percentCompleted}}%</button>
        <button class="button" @click="copying" :disabled="rowData.percentCompleted == 0">
            {{ copyActive ? 'Cancel' : 'Copy'}}
        </button>
        <button class="button"
                :disabled="rowData.percentCompleted === 0"
                :class="{ 'is-loading' : togglingVisibility, 'is-outlined is-primary': actualData.visible }"
                @click="toggleVisibility">
            {{actualData.visible ? 'Visible' : 'Not Visible'}}
        </button>
        <a class="button is-primary" :href="'/store/products/' + rowData.id">Edit</a>
    </div>
</template>

<script>
	export default {
		name: "actions",
		props: {
			rowData: {
				type: Object,
				required: true
			},
			rowIndex: {
				type: Number
			},
			copyActive: {
				type: Boolean,
				required: true
			}
		},

		data() {
			return {
				actualData: this.rowData,
				togglingVisibility: false
			}
		},

		methods: {

			copying() {
				this.$emit('copying', {
					name: 'copying',
					id: this.rowData.id
				});
			},

			toggleVisibility() {
				this.togglingVisibility = true;
				axios.put('/store/products/visible/' + this.rowData.id).then((response) => {
					this.actualData.visible = response.data.visible;
					this.togglingVisibility = false;
				}).catch(() => {
					alert('An error occurred, please try again.');
					this.togglingVisibility = false;
				});
			}
		}
	}
</script>