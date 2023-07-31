<div>
    <div class="page-header">
        <h1 class="page-title">Administrar Categorias</h1>
        <!-- <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
            </ol>
        </div> -->
    </div>
    <div class="card">
    @include('livewire.admcategorias.modals')

        <div class="card-body">
            <div class="row">
                <div class="col-xl-2">
                    <div class="btn  btn-dark" data-bs-toggle="modal" data-bs-target="#createDataModal">
                        <i class="fa fa-plus"></i> Generar Categorias
                    </div>
                </div>

            </div>
            <br><br>
            <div class="row">

                <div class="col-xl-4 mb-2">

                    Mostrar
                    <select wire:model.defer="npagination" name="npagination" id="npagination" wire:change="change">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    registros por pagina

                </div>
                <div class="col-xl-6">
                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Categoria"><br>
                </div>
                <div class="col-xl-2" style="text-align:right">
                    <button style ="display:none" id="btn-trash"  data-bs-target="#MultipleDeleteModal" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>

                </div>
            </div>


            <div class="table-responsive">

                @if($categorias->count())

                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">

                    <thead>
                        <tr>
                            <th></th>
                            <!-- <th wire:click="order('id')">id <i class="fa fa-sort float-end sort" aria-hidden="true"></i></th> -->
                            <th wire:click="order('titulo')">titulo <i class="fa fa-sort float-end sort" aria-hidden="true"></i></th>
                            <th wire:click="order('created_at')">Creado <i class="fa fa-sort float-end sort" aria-hidden="true"></i> </th>
                            <th wire:click="order('updated_at')">Actualizado <i class="fa fa-sort float-end sort" aria-hidden="true"></i> </th>

                            <th>Opciones</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                             <td><input wire:click="checkbox('{{$categoria->id}}')" class='form-check-input' type='checkbox' id='flexCheckDefault'></td> 
                            <!-- <td>{{$categoria->id}}</td> -->
                            <td>{{$categoria->titulo}}</td>
                            <td>{{$categoria->created_at}}</td>
                            <td>{{$categoria->updated_at}}</td>

                            <td><button data-bs-toggle="modal" data-bs-target="#updateDataModal"  class='btn  btn-success btn-sm' wire:click.prevent="edit('{{$categoria->id}}')"><i class='fe fe-edit fs-14'></i></button>&nbsp&nbsp&nbsp&nbsp
                                <button type="button" data-bs-toggle="modal" wire:click="ChangeId('{{$categoria->id}}')" data-bs-target="#DeleteModal" class='btn btn-primary btn-sm drop-btn ml-2 '><i class='fe fe-trash-2 fs-14'></i></button></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <div class="float-end">{{ $categorias->links() }}</div>
                <div class="float-start">
                    Mostrando pagina {{$categorias->currentPage()}} de {{$categorias->lastPage()}} de un total de {{$categorias->total()}} registros
                </div>
                @else

                <p>No se ha encontrado ningun registro en la tabla</p>
                @endif
            </div>


        </div>
    </div>
</div>