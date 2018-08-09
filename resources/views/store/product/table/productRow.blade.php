<td style="background-color: #efe3ff">
	<div class="level">
		<div class="level-item">
			{{ ucfirst($part) }}
		</div>
		<div class="level-item">
			<button v-tooltip="{html: true, content: `<div><p>{{ $data['description'] }}</p><img style='height: 400px' src='/images/product-tooltips/{{ $part }}.png' /></div>`}"
					class="button is-light is-rounded is-bold">i
			</button>
		</div>
	</div>
</td>

@foreach($variants as $key => $products)
	<td>
		<min-max-fields inline-template
						:metric="metric">
			<div>
				<a class="button is-warning is-block" style="margin-bottom: 5px" v-if="warning" href="#"
				   v-tooltip="'Warning! The difference between min and max values is big.'">
					WARNING
				</a>
				<div class="field-body">
					<div class="field">
						<cm-inch-field
								@focus="$emit('focus')"
								ref="min"
								:metric="metric"
								:has-error="{{ $errors->has("{$key}.{$part}.min") ? 'true' : 'false'}}"
								name="{{ $key }}[{{ $part }}][min]"
								start-value="{{ old("{$key}.{$part}.min", $productModel->data[$key][$part]['min'] ?? '') }}"
								placeholder="Min">
						</cm-inch-field>
						@if ($errors->has("{$key}.{$part}.min"))
							<p class="help is-danger">{{ $errors->first("{$key}.{$part}.min") }}</p>
						@endif
					</div>
					<label class="label">-&nbsp;&nbsp;</label>
					<div class="field">
						<cm-inch-field
								ref="max"
								:metric="metric"
								:has-error="{{ $errors->has("{$key}.{$part}.max.") ? 'true' : 'false'}}"
								name="{{ $key }}[{{ $part }}][max]"
								start-value="{{ old("{$key}.{$part}.max", $productModel->data[$key][$part]['max'] ?? '') }}"
								placeholder="Max">
						</cm-inch-field>
						@if ($errors->has("{$key}.{$part}.max"))
							<p class="help is-danger">{{ $errors->first("{$key}.{$part}.max") }}</p>
						@endif
					</div>
				</div>
			</div>
		</min-max-fields>
	</td>
@endforeach