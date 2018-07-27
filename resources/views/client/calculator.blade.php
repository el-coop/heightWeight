@extends('layouts.client')

@section('content')
    <client-calculator :product="{{ $product }}"
                       :translations="{
                            calculate: '@lang('calculator.calculate')',
                            insert: '@lang('calculator.insert')',
                            height: '@lang('calculator.height')',
                            weight: '@lang('calculator.weight')',
                            metric: '@lang('calculator.metric')',
                            imperial: '@lang('calculator.imperial')',
                            accurate: '@lang('calculator.accurate')',
                            wide: '@lang('calculator.wide')',
                            full: '@lang('calculator.full')',
                            submit: '@lang('calculator.submit')',
                            next: '@lang('calculator.next')',
                            recommendedSize: '@lang('calculator.recommendedSize')',
                            productSizes: '@lang('calculator.productSizes')'
                        }"
    ></client-calculator>
@endsection