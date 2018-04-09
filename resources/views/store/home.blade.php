@extends('layouts.store')

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
                </div>
                <div class="column">
                    <div class="box">
                        @include('store.instructions.dropdown')
                        <div style="padding: 1rem 2px; overflow-x: hidden">
                            <transition name="component-fade" mode="out-in">
                                @include('store.instructions.installation')
                                @include('store.instructions.collections')
                                @include('store.instructions.edit')
                                @include('store.instructions.help')
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
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
                                Copy Products
                            </button>
                        </div>
                        <div class="control level-item">
                            <a href="https://{{$shop->shopify_domain}}/admin/collections/{{ $shop->collection_id }}"
                               target="_blank">
                                <button class="button is-dark">Add products</button>
                            </a>
                        </div>
                    </div>
                </datatable>
            </div>
        </div>
    </store-home-page>
@endsection