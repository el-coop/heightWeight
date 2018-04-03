<div class="level">
    <div class="level-left">
        <div class="level-item">
            <img src="{{ $product->image->src }}" class="product-image">
            <h3 class="is-size-3 is-inline-block">
                {{ $product->title }}
                <a href="{{action('StoreController@home')}}" class="has-text-grey">| Products</a>
            </h3>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <button class="button is-primary">SAVE</button>
        </div>
    </div>
</div>