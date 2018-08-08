<div key="Docs Library" v-if="activeInstructions==='Docs Library'" class="content">
	<div class="content">
		<ul>
			@foreach([
				'Current screen explanation' => 'https://heightandweight.co/docs/backend/',
				'Edit a product' => 'https://heightandweight.co/docs/edit-product/',
				'How to make the app to work' => 'https://heightandweight.co/docs/how-to-make-the-app-to-work/',
				'Frontend explanation' => 'https://heightandweight.co/docs/frontend-explanation/',
				'Manual installation' => 'https://heightandweight.co/docs/manual-installation/'
			] as $docTitle => $docLink)
				<li><a target="_blank" href="{{ $docLink }}">{{ $docTitle }}</a></li>
			@endforeach
		</ul>
	</div>
</div>