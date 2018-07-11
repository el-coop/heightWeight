@include('store.instructions.dropdown')
<div style="padding: 1rem 2px; overflow-x: hidden">
    <transition name="component-fade" mode="out-in">
        @include('store.instructions.installation')
        @include('store.instructions.collections')
        @include('store.instructions.edit')
        @include('store.instructions.help')
    </transition>
</div>
