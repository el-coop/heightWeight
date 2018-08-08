<div key="1" v-if="activeInstructions==='Select app products'" class="content">
    <h4>
        Control which products are added to the app with the
        <a href="https://{{$shop->shopify_domain}}/admin/collections/{{ $shop->collection_id }}" target="_blank">
            Height & Weight collection.
        </a>
    </h4>
    <ul>
        <li>Click on the link above. Or</li>
        <li>Go to <a href="https://{{$shop->shopify_domain}}/admin/collections" target="_blank">collections</a></li>
        <li>Click on the Height & Weight collection.</li>
        <li>Add the products you want to edit.</li>
        <li>The app will import only the products you have set in this collection to give you the fastest workflow.</li>
    </ul>
</div>