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
    @foreach(['bust','waist','length','shoulders','sleeve',false,'height'] as $part)
        <tr>
            <td>
                {{ ucfirst($part) }}
            </td>

            @foreach($variants as $key => $products)

                <td>
                    @if($part)
                        <min-max-fields inline-template
                                        :metric="metric">
                            <div>
                                <a class="button is-warning is-block" style="margin-bottom: 5px" v-if="warning" href="#"
                                   v-tooltip="'Warning! The difference between min and max values is big.'">
                                    WARNING
                                </a>
                                <div class="field-body">
                                    <div class="field">
                                        <metric-imperial-field
                                                ref="min"
                                                :metric="metric"
                                                :has-error="{{ $errors->has("{$key}.{$part}.min") ? 'true' : 'false'}}"
                                                name="{{ $key }}[{{ $part }}][min]"
                                                start-value="{{ old("{$key}.{$part}.min", $productModel->data[$key][$part]['min'] ?? '') }}"
                                                placeholder="Minimum">
                                        </metric-imperial-field>
                                        @if ($errors->has("{$key}.{$part}.min"))
                                            <p class="help is-danger">{{ $errors->first("{$key}.{$part}.min") }}</p>
                                        @endif
                                    </div>
                                    <label class="label">-&nbsp;&nbsp;</label>
                                    <div class="field">
                                        <metric-imperial-field
                                                ref="max"
                                                :metric="metric"
                                                :has-error="{{ $errors->has("{$key}.{$part}.max.") ? 'true' : 'false'}}"
                                                name="{{ $key }}[{{ $part }}][max]"
                                                start-value="{{ old("{$key}.{$part}.max", $productModel->data[$key][$part]['max'] ?? '') }}"
                                                placeholder="Maximum">
                                        </metric-imperial-field>
                                        @if ($errors->has("{$key}.{$part}.max"))
                                            <p class="help is-danger">{{ $errors->first("{$key}.{$part}.max") }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </min-max-fields>
                    @endif

                </td>
            @endforeach
        </tr>
    @endforeach
    <tr>
        <td>Width</td>
        @foreach($variants as $key => $products)
            <td>
                <div>
                    <min-max-fields inline-template
                                    init-min="{{ old("{$key}.weight.min", $productModel->data[$key]['weight']['min'] ?? '') }}"
                                    init-max="{{ old("{$key}.weight.max", $productModel->data[$key]['weight']['max'] ?? '') }}"
                                    :metric="metric">
                        <div>
                            <a class="button is-warning is-block" style="margin-bottom: 5px" v-if="warning" href="#"
                               v-tooltip="'Warning! The difference between min and max values is big.'">
                                WARNING
                            </a>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input{{ $errors->has("{$key}.weight.min") ? ' is-danger' : ''}}"
                                               name="{{ $key }}[weight][min]"
                                               v-model="min"
                                               value="{{ old("{$key}.weight.min", $productModel->data[$key]['weight']['min'] ?? '') }}">
                                    </p>
                                    @if ($errors->has("{$key}.weight.min"))
                                        <p class="help is-danger">{{ $errors->first("{$key}.weight.min") }}</p>
                                    @endif
                                </div>
                                <label class="label">-&nbsp;&nbsp;</label>
                                <div class="field">
                                    <p class="control">
                                        <input class="input{{ $errors->has("{$key}.weight.max") ? ' is-danger' : ''}}"
                                               name="{{ $key }}[weight][max]"
                                               v-model="max"
                                               value="{{ old("{$key}.weight.max", $productModel->data[$key]['weight']['max'] ?? '') }}">
                                    </p>
                                    @if ($errors->has("{$key}.weight.max"))
                                        <p class="help is-danger">{{ $errors->first("{$key}.weight.max") }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </min-max-fields>
                </div>
            </td>
        @endforeach
    </tr>
    </tbody>
</table>