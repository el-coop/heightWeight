@extends('layouts.store')

@section('content')

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
@endsection