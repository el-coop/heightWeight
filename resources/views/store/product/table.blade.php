<table class="table is-fullwidth is-bordered">
	<thead>
	<tr>
		<th>Variant:</th>
		@forelse($variants as $key => $products)
			<th class="has-text-centered">{{ $key }}</th>
		@empty
			<th class="has-text-centered">We couldn't find any option with the name "{{ $shop->size_name }}" on this
				product
			</th>
		@endforelse
	</tr>
	</thead>
	@include('store.product.table.tshirt', ['imagePrefix' => ''])
	@include('store.product.table.pants',  ['imagePrefix' => 'pants-'])
	@include('store.product.table.other')
</table>