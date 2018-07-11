@foreach([
    'Upgrading to 2nd version',
    'Edit option for other measurements (Bust,Waist,Length, Etc..)',
    'Two steps for Customers to fill info (front end)',
    'Auto install app code'
] as $item)
    <label class="checkbox is-completed">
        <input type="checkbox" checked disabled>
        {{ $item }}
    </label><br>
@endforeach