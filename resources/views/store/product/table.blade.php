<table class="table is-fullwidth is-bordered">
    <thead>
    <tr>
        <th>Variant:</th>
        @foreach($product->variants as $variant)
            <th class="has-text-centered">{{ $variant->title }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach(['height','weight','bust','waist','length','shoulders','sleeve'] as $part)
        <tr>
            <td>
                {{ ucfirst($part) }}
            </td>
            @foreach($product->variants as $variant)
                <td>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input{{ $errors->has("{$variant->title}_{$part}_min") ? ' is-danger' : ''}}"
                                       name="{{ $variant->title }}_{{ $part }}_min"
                                       value="{{ old("{$variant->title}_{$part}_min", $productModel->data[$variant->title . '_' . $part . '_min']) }}">
                            </p>
                            @if ($errors->has("{$variant->title}_{$part}_min"))
                                <p class="help is-danger">{{ $errors->first("{$variant->title}_{$part}_min") }}</p>
                            @endif
                        </div>
                        <label class="label">-&nbsp;&nbsp;</label>
                        <div class="field">
                            <p class="control">
                                <input class="input{{ $errors->has("{$variant->title}_{$part}_max") ? ' is-danger' : ''}}"
                                       name="{{ $variant->title }}_{{ $part }}_max"
                                       value="{{ old("{$variant->title}_{$part}_max", $productModel->data[$variant->title . '_' . $part . '_max']) }}">
                            </p>
                            @if ($errors->has("{$variant->title}_{$part}_max"))
                                <p class="help is-danger">{{ $errors->first("{$variant->title}_{$part}_max") }}</p>
                            @endif
                        </div>
                    </div>
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>