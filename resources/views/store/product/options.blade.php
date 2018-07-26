<div class="level">
    <div class="level-item has-text-centered">
        <div class="field is-horizontal">
            <a href="https://www.heightandweight.co/docs" target="_blank" v-tooltip="'Please place the product measurement in the table below.<br> Be sure to select the product type and product gender.<br> There are further instructions for each parameter.<br> check this page for more information: https://www.heightandweight.co/docs'"
               class="button is-light is-rounded is-bold">?
            </a>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div class="field is-horizontal">
            <div class="control">
                <label class="radio">
                    Metric
                    <input type="radio" name="measurement"
                           value="metric" v-model="metric">

                </label>
                <span>/</span>
                <label class="radio">
                    <input type="radio" name="measurement"
                           value="imperial" v-model="metric">
                    Imperial
                </label>
            </div>
            @if ($errors->has('measurement'))
                <p class="help is-danger">{{ $errors->first('measurement') }}</p>
            @endif
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div class="field is-horizontal">
            <label class="field-label label" style="white-space: nowrap">Product Type:</label>
            <div class="field-body">
                <div class="select">
                    <select name="type">
                        <option value="t-shirt" {{ old('type', $productModel->type) == 't-shirt' ? 'selected' : ''}}>
                            T-Shirt
                        </option>
                        <option value="shirt" {{ old('type', $productModel->type) == 'shirt' ? 'selected' : ''}}>Shirt
                        </option>
                        <option value="pants" {{ old('type', $productModel->type) == 'pants' ? 'selected' : ''}}>Pants
                        </option>
                        <option value="dress" {{ old('type', $productModel->type) == 'dress' ? 'selected' : ''}}>Dress
                        </option>
                    </select>
                </div>
                @if ($errors->has('type'))
                    <p class="help is-danger">{{ $errors->first('type') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div class="field is-horizontal">
            <label class="field-label label">Product Gender:</label>
            <div class="control">
                <label class="radio">
                    Male
                    <input type="radio" name="gender"
                           value="male" {{ old('gender', $productModel->gender) == 'male' ? 'checked' : ''}}>
                </label>
                <span>/</span>
                <label class="radio">
                    <input type="radio" name="gender"
                           value="female" {{ old('gender', $productModel->gender) == 'female' ? 'checked' : ''}}>
                    Female
                </label>
            </div>
            @if ($errors->has('gender'))
                <p class="help is-danger">{{ $errors->first('gender') }}</p>
            @endif
        </div>
    </div>
</div>
