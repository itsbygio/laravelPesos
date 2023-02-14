<x-app-layout>
    <div class="page-header">
        <h1 class="page-title">Administrar Categorias</h1>
        <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
            </ol>
        </div>
    </div>
    <!--
        <div class="row">
           <div style="text-align:right" class="col-xl-12"><button  class="btn btn-primary "> Agregar Categoria</button></div>
        </div>
!-->
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6"><button onclick="AbrirModalCrear()" type="button" class="btn btn-blue me-3   btn-sm mb-5" data-bs-toggle="modal" data-bs-target="#agregar_modal" data-bs-whatever="@mdo">Agregar categoria</button></div>
                <div class="col-xl-6" style="text-align:right"><button id="btn-trash" data-bs-target="#delete_modals" data-bs-toggle="modal" type="button" style="display:none" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button></div>

            </div>


            <div class="table-responsive">


                <table class="table table-bordered  " id="categorias" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>

                            <th>titulo</th>
                            <th>Creacion</th>
                            <th>Actualizacion</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @include('categorias.modalcrear')
    @include('categorias.modaleditar')
    @include('modals.modaldelete')

    @section('scripts')
    @include('categorias.script')
    @endsection
</x-app-layout>