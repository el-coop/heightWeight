<div class="level">
    <div class="level-item  has-text-centered">
        <div class="field">
            <div class="control">
                <label class="radio">
                    Metric
                    <input type="radio" name="measurement"
                           value="metric" {{ old('measurement', $productModel->measurement) == 'metric' ? 'checked' : ''}}>

                </label>
                <span>/</span>
                <label class="radio">
                    <input type="radio" name="measurement"
                           value="imperial"{{ old('measurement', $productModel->measurement) == 'imperial' ? 'checked' : ''}}>
                    Imperial
                </label>
            </div>
            @if ($errors->has('measurement'))
                <p class="help is-danger">{{ $errors->first('measurement') }}</p>
            @endif
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div class="field">
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
    <div class="level-item has-text-centered">
        <div class="field">
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
