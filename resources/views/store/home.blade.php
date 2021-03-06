@extends('layouts.store')

@section('title','Home')

@section('head')
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
		(function () {
			var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/5a65fa52d7591465c706faa6/default';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
@endsection

@section('content')
	<store-home-page inline-template>
		<div class="section">
			<div class="columns">
				<div class="column is-4">
					<div class="box">
						<p class="title">Plan Details:</p>
						<p>Service Plan : {{$shop->plan}}</p>
						<p>Total Products : {{ $shop->total_product_count }}</p>
						<p>Products imported app : {{$shop->product_count}}</p>
					</div>
					<div class="box">
						@include('store.home.buttonField')
					</div>
				</div>
				<div class="column">
					<div class="columns is-multiline">
						<div class="column is-full">
							<div class="box">
								@include('store.instructions.index')
							</div>
						</div>
						<div class="column is-half">
							<div class="box">
								@include('store.home.sizeField')
							</div>
						</div>
						<div class="column is-half">
							<div class="box">
								@include('store.home.languageField')
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box" id="product-table">
				<datatable url="{{ action('StoreController@products') }}"
						   :fields="tableFields"
						   :inline-forms="false"
						   empty-text="<a target='_blank' href='https://{{$shop->shopify_domain}}/admin/collections/{{ $shop->collection_id }}'>Click here to add items to the Height & Weight collection</a>"
						   class="mt-3"
						   :copy-active="copyingFields"
						   ref="table"
						   @copying="startCopyingRow">
					<div class="level-right" slot="extra-buttons">
						<div class="control level-item" v-if="copyingFields">
							<button class="button is-primary"
									:disabled="selectedTo.length == 0"
									@click="copyFields"
									:class="{ 'is-loading' : copying }">
								Paste
							</button>
						</div>
						<div class="control level-item">
							<a href="https://{{$shop->shopify_domain}}/admin/collections/{{ $shop->collection_id }}"
							   target="_blank">
								<button class="button is-dark">Add products</button>
							</a>
						</div>
						<div class="control level-item">
							<button class="button is-info"
									v-tooltip="'After you add a product to the collection, you can click here to refresh the table'"
									@click="$refs.table.refresh()">Refresh
							</button>
						</div>
					</div>
				</datatable>
			</div>
		</div>
	</store-home-page>
@endsection