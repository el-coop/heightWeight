<form method="post" action="{{ action('StoreController@updateLanguage') }}">
	@csrf
	<div class="field">
		<label class="label">Choose the calculator's language</label>
	</div>
	<div class="field has-addons is-expanded">
		<p class="select">
			<select name="language">
				<option disabled {{ $shop->language == null ? 'selected' : '' }}>Auto Detect
				</option>
				@foreach(['en' => 'English', 'fr' => 'French', 'de' => 'German', 'es' => 'Spanish'] as $code => $language)
					<option value="{{ $code }}" {{ $shop->language == $code ? 'selected' : '' }}>{{ $language }}</option>
				@endforeach
			</select>
		</p>
		<p class="control">
			<button class="button is-success">
				Update
			</button>
		</p>
	</div>
</form>