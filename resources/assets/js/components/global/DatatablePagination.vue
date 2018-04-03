<template>
    <nav class="pagination" role="navigation" aria-label="pagination">
        <a class="pagination-previous" @click="loadPage(1)">First</a>
        <a class="pagination-previous" @click="loadPage('prev')" :disabled="isOnFirstPage">Previous</a>
        <a class="pagination-next" @click="loadPage('next')" :disabled="isOnLastPage">Next page</a>
        <a class="pagination-next" @click="loadPage(totalPage)">Last</a>
        <ul class="pagination-list">
            <template v-if="notEnoughPages">
                <template v-for="n in totalPage">
                    <li  >
                        <a @click="loadPage(n)" class="pagination-link" :class="[isCurrentPage(n) ? 'is-current' : '']"
                           v-html="n">
                        </a>
                    </li>
                </template>
            </template>
            <template v-else>
                <template v-for="n in windowSize">
                    <li>
                        <a @click="loadPage(windowStart+n-1)" class="pagination-link" :class="[isCurrentPage(windowStart+n-1) ? 'is-current' : '']"
                           v-html="windowStart+n-1">
                        </a>
                    </li>
                </template>
            </template>
        </ul>
    </nav>
</template>

<script>
	import VuetablePaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin.vue';

	export default {
		mixins: [VuetablePaginationMixin],
	}
</script>
