@extends('layouts.store')
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
	<store-product-page inline-template
						start-type="{{ old('type', $productModel->type ?? 't-shirt') }}"
						start-metric="{{ old('measurement', $productModel->measurement ?? 'metric') == 'metric' ? 'metric' : 'imperial'}}">
		<form method="post" action="{{ action('ProductController@updateProduct', $product->id) }}">
			@csrf
			<section class="box">
				<div class="container is-fluid">
					@include('store.product.header')
				</div>
			</section>

			<section class="section">
				<div class="box">
					@include('store.product.options')
					@include('store.product.table')
				</div>
			</section>
		</form>
	</store-product-page>
@endsection