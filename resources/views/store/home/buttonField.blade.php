<div class="is-pulled-right">
	<a target="_blank" href="https://heightandweight.co/docs/change-the-button-style/">
		<button v-tooltip="'Click for details.'"
				class="button is-rounded is-dark is-bold">?
		</button>
	</a>
</div>
<form method="post" action="{{ action('StoreController@updateButton') }}" style="margin-top: 5px">
	@csrf
	<div class="field">
		<label class="label">Choose the button's style</label>
	</div>
	<div class="field">
		<label class="label">Text</label>
		<div class="control">
			<input type="text" class="input" name="text" value="{{ $button->text }}">
		</div>
		@if($errors->has('text'))
			<p class="help is-danger">The text is required</p>
		@endif
	</div>
	<div class="field">
		<label class="label">Text Color</label>
		<div class="control">
			<input type="color" class="input" name="color" value="{{ $button->color }}">
		</div>
	</div>
	<div class="field">
		<label class="label">Background Color</label>
		<div class="control">
			<input type="color" name="background" class="input" value="{{ $button->background }}">
		</div>
	</div>
	<div class="field is-horizontal">
		<div class="field">
			<label class="label">Border Color</label>
			<div class="control">
				<label class="radio">
					<input value="white" type="radio" name="border" {{ $button->border == 'white' ? 'checked' : ''}}>
					White
				</label>
				<label class="radio">
					<input value="black" type="radio" name="border" {{ $button->border == 'black' ? 'checked' : ''}}>
					Black
				</label>
			</div>
		</div>
		<div class="field" style="align-self: center; flex-grow: 1">
			<p class="control is-pulled-right">
				<button class="button is-success">
					Update
				</button>
			</p>
		</div>
	</div>
</form>
