<template>
	<div class="container is-fluid">
		<div class="columns is-multiline">
			<div class="column is-full">
				<div class="level">
					<div class="level-left">
						<div class="level-item">
							<div class="select">
								<select v-model="perPage">
									<option :value="20">10</option>
									<option :value="50">50</option>
									<option :value="100">100</option>
								</select>
							</div>
						</div>
						<div class="level-item">
							<div class="field has-addons">
								<div class="control">
									<input class="input" type="text" placeholder="Find a product" v-model="filter"
										   @keyup.enter="updateParams">
								</div>
								<div class="control">
									<button class="button is-info" type="button" @click="updateParams">
										Search
									</button>
								</div>
							</div>
						</div>
					</div>
					<slot name="extra-buttons"></slot>
				</div>
			</div>
			<div class="column is-full">
				<vuetable ref="table"
						  :api-url="url"
						  pagination-path=""
						  :css="css"
						  :fields="fields"
						  :per-page="perPage"
						  :append-params="params"
						  :no-data-template="emptyText"
						  @vuetable:pagination-data="paginationData"
						  @vuetable:loading='tableLoading'
						  @vuetable:loaded='tableLoaded'>
					<template slot="productactions" slot-scope="props">
						<actions :row-data="props.rowData" :copy-active="copyActive" @copying="amplifyEvent"></actions>
					</template>
				</vuetable>
			</div>
			<div class="column is-full">
				<vuetable-pagination ref="pagination"
									 :onEachSide="1"
									 @vuetable-pagination:change-page="changePage">
				</vuetable-pagination>
			</div>
		</div>
	</div>
</template>

<script>
	import Vuetable from 'vuetable-2/src/components/Vuetable.vue';
	import VuetablePagination from './DatatablePagination';
	import Actions from "../products/Actions";


	export default {
		name: "datatable",
		components: {
			Actions,
			Vuetable,
			VuetablePagination
		},
		props: {
			url: {
				type: String,
				required: true
			},
			fields: {
				type: Array,
				required: true
			},
			emptyText: {
				type: String,
				required: true
			},
			extraParams: {
				type: Object,
				default() {
					return {};
				}
			},
			copyActive: {
				type: Boolean,
				default: false
			}
		},

		data() {
			return {
				loading: false,
				css: {
					tableClass: 'table is-fullwidth is-striped'
				},
				params: this.extraParams,
				filter: null,
				perPage: 50
			}
		},

		computed: {
			selectedTo() {
				return this.$refs.table.selectedTo;
			}
		},

		watch: {
			fields() {
				window.setTimeout(() => {
					this.$refs.table.normalizeFields();
				}, 100);
			},
			perPage() {
				this.updateParams();
			}
		},

		methods: {
			updateParams() {
				this.params.filter = this.filter;
				Vue.nextTick(() => {
					this.$refs.table.refresh()
				})
			},
			paginationData(paginationData) {
				this.$refs.pagination.setPaginationData(paginationData);
			},
			changePage(page) {
				this.$refs.table.changePage(page);
			},
			tableLoading() {
				this.css.tableClass = 'table is-fullwidth is-striped loading';
			},
			tableLoaded() {
				this.css.tableClass = 'table is-fullwidth is-striped';
			},

			amplifyEvent(event) {
				this.$emit(event.name, event);
			},

			refresh() {
				this.$refs.table.refresh()
			}
		}

	}
</script>