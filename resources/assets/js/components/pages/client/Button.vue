<template>
    <button class="button is-dark" @click="openWindow">Calculate weight and height</button>
</template>

<script>
	export default {
		props: {
			productId: {
				type: String,
				required: true
			}
		},

		methods: {
			openWindow() {
				window.open('https://app.seezerapps.com/client/calculator/' + this.productId,
					'_blank',
					'status=1,toolbar=0,menubar=0,resizeable=0,scrollbars=0,location=0,dependent=1,width=500,height=400');
			}
		}
	}
</script>

