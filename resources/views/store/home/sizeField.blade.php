<div class="is-pulled-right">
	<a target="_blank" href="https://heightandweight.co/docs/the-name-of-your-size-variant/">
		<button v-tooltip="'Click for details.'"
				class="button is-rounded is-dark is-bold">?
		</button>
	</a>
</div>
<form method="post" action="{{ action('StoreController@updateSizeName') }}">
	@csrf
	<div class="field">
		<label class="label">Tell us the name of your size option</label>
	</div>
	<div class="field has-addons is-expanded">
		<p class="control">
			<input class="input" name="size_name" required type="text"
				   value="{{ $shop->size_name }}">
		</p>
		<p class="control">
			<button class="button is-success">
				Update
			</button>
		</p>
	</div>
</form>
