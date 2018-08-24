<!DOCTYPE html>
<html lang="en">
<head>
    @if(config('shopify-app.esdk_enabled'))
        <script src="https://cdn.shopify.com/s/assets/external/app.js?{{ date('YmdH') }}"></script>
        <script type="text/javascript">
			ShopifyApp.init({
				apiKey: '{{ config('shopify-app.api_key') }}',
				shopOrigin: 'https://{{ ShopifyApp::shop()->shopify_domain }}',
				debug: false,
				forceRedirect: true
			});

			ShopifyApp.ready(function () {
				ShopifyApp.Bar.initialize({
					buttons: {
						primary: {
							label: "Edit your products",
							callback: function () {
								var element = document.getElementById("product-table");
								console.log('element ' + element);
								if (element) {
									element.scrollIntoView();
								} else {
									window.location.href = '/#product-table';
								}
							},
						},
					},
					title: '@yield('title')',
				})
			});
        </script>

        @include('shopify-app::partials.flash_messages')
    @endif

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('shopify-app.app_name') }}</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @yield('head')
</head>

<body>
<div id="app">
    @yield('content')
</div>

@include('shopify-app::partials.flash_messages')

<script src="{{ mix('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>