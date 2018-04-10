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
    @foreach(['height','bust','waist','length','shoulders','sleeve'] as $part)
        <tr>
            <td>
                {{ ucfirst($part) }}
            </td>
            @foreach($variants as $key => $products)
                <td>
                    <min-max-fields inline-template
                                    :metric="metric">
                        <div>
                            <a class="button is-warning is-block" style="margin-bottom: 5px" v-if="warning" href="#" v-tooltip="'Warning! The difference between min and max values is big.'">
                                WARNING
                            </a>
                            <div class="field-body">
                                <div class="field">
                                    <metric-imperial-field
                                            ref="min"
                                            :metric="metric"
                                            :has-error="{{ $errors->has("{$key}_{$part}_min") ? 'true' : 'false'}}"
                                            name="{{ $key }}_{{ $part }}_min"
                                            start-value="{{ old("{$key}_{$part}_min", $productModel->data[$key . '_' . $part . '_min'] ?? '') }}"
                                            placeholder="Minimum">
                                    </metric-imperial-field>
                                    @if ($errors->has("{$key}_{$part}_min"))
                                        <p class="help is-danger">{{ $errors->first("{$key}_{$part}_min") }}</p>
                                    @endif
                                </div>
                                <label class="label">-&nbsp;&nbsp;</label>
                                <div class="field">
                                    <metric-imperial-field
                                            ref="max"
                                            :metric="metric"
                                            :has-error="{{ $errors->has("{$key}_{$part}_max") ? 'true' : 'false'}}"
                                            name="{{ $key }}_{{ $part }}_max"
                                            start-value="{{ old("{$key}_{$part}_max", $productModel->data[$key . '_' . $part . '_max'] ?? '') }}"
                                            placeholder="Maximum">
                                    </metric-imperial-field>
                                    @if ($errors->has("{$key}_{$part}_max"))
                                        <p class="help is-danger">{{ $errors->first("{$key}_{$part}_max") }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </min-max-fields>
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>