@extends('layouts.client')

@section('content')
    <client-button product-id="{{ $product->shopify_id }}"></client-button>
@endsection