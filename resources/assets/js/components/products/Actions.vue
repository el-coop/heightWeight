<template>
    <div class="buttons is-centered">
        <button class="button">0%</button>
        <button class="button">Copy</button>
        <button class="button">Show</button>
        <a class="button" :href="'/store/products/' + rowData.id">Edit</a>
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
			}
		},
	}
</script>