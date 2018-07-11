@foreach([
    'Customers height and weight appear in purchase note (september 18)',
    'Chrome extension (january 18)'
] as $item)
    <label class="checkbox">
        <input type="checkbox" disabled>
        {{ $item }}
    </label><br>
@endforeach