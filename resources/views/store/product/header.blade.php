<div class="level">
	<div class="level-left">
		<div class="level-item">
			<img src="{{ $product->image ? $product->image->src : '/images/noimg.jpg' }}" class="product-image">
			<h3 class="is-size-3 is-inline-block">
				<a href="{{ $productModel->link }}" class="has-text-black" target="_blank">{{ $product->title }}</a>
				<a href="{{action('StoreController@home')}}" class="has-text-grey">| Products</a>
			</h3>
		</div>
	</div>
	<div class="level-right">
		<div class="level-item">
			<button class="button is-primary" @click="showMessage = false">SAVE</button>
		</div>
	</div>
</div>