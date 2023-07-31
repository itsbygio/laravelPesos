
<x-app-layout>
 @livewire('administrar.admusuarios')
@include('usuarios.addusuario')
@include('usuarios.editusuario')


@section('scripts')
@include('usuarios.script')
@include('usuarios.script_edit')

 @endsection
 </x-app-layout>