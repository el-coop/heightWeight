<table class="table is-fullwidth is-bordered">
    <thead>
    <tr>
        <th>Variant:</th>
        @forelse($variants as $key => $products)
            <th class="has-text-centered">{{ $key }}</th>
        @empty
            <th class="has-text-centered">We couldn't find any option with the name "{{ $shop->size_name }}" on this
                product
            </th>
        @endforelse
    </tr>
    </thead>
    <tbody>
    @foreach(['Product Measurements' => ['view' => 'title'],'bust' => ['view' => 'product', 'description' => 'Enter the bust (chest) circumference of the product'],'waist' => ['view' => 'product', 'description' => 'Enter the waist circumference of the product'],'length' => ['view' => 'product','description' => 'Enter the vertical length of the product<br><small>*Mandatory variable</small>'],'shoulders' => ['view' => 'product','description' => 'Enter the shoulders width of the product'],'sleeve' => ['view' => 'product','description' => 'Enter the sleeve length of the product'],'Customer Measurements' => ['view' => 'title'],'height' => ['view' => 'customer','description' => 'Enter the height of the potential customer', 'field' => 'metric-imperial-field'],'weight' => ['view' => 'customer','description' => 'Enter the weight of the potential customer', 'field' => 'kg-pound-field']] as $part => $data)
        <tr>
            @component("store.product.table.{$data['view']}Row",compact('part','variants','data','productModel'))
            @endcomponent
        </tr>
    @endforeach
    </tbody>
</table>