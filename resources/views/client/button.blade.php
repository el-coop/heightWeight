@extends('layouts.client')

@section('content')
    <client-button product-id="{{ $product->shopify_id }}" button-text="@lang('calculator.calculate')"></client-button>
@endsection