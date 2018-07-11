<form method="post" action="{{ action('StoreController@contact') }}" @submit="submitting = true">
    @csrf
    <div class="field">
        <label class="label">Have a great idea? tell us!</label>
        <div class="control">
            <textarea class="textarea" placeholder="Textarea" name="message" required></textarea>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link" :class="{ 'is-loading' : submitting}">Submit
            </button>
        </div>
    </div>
</form>