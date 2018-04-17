@extends('layouts.client')

@section('content')
    <client-calculator :product="{{ $product }}"></client-calculator>
@endsection