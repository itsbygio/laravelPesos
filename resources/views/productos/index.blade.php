<x-app-layout>

@livewire('administrar.productos')
@include('modals.modaldelete')
@include('productos.addproducto')
@include('productos.editproducto')


@section('scripts')
@include('productos.script')
@include('productos.script_edit')

 @endsection
</x-app-layout>
