<div>
    
    <div class="page-header">
       
       
        <h1 class="page-title">Administrar Usuarios</h1>
        
    </div>
   
    <div class="card">
        @include('livewire.admusuarios.modals')
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2">
                    <div class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createDataModal">
                        <i class="fa fa-plus"></i> Generar Usuarios
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
                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar usuario"><br>
                </div>
                <div class="col-xl-2" style="text-align:right">
                    <button style="display:none;" id="btn-trash" data-bs-target="#MultipleDeleteModal" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>

                </div>
            </div>


            <div class="table-responsive">

                @if($users->count())

                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">

                    <thead>
                        <tr>
                            <th></th>
                            <th wire:click="order('id')">id <i class="fa fa-sort float-end sort"   aria-hidden="true"></i>
                            </th>
                            <th wire:click="order('nombre')">Nombre <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('apellido')">Apellido <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('rol')"> Rol <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th>Tipo de identificación</th>
                            <th wire:click="order('identificacion')">Identificación <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                           
                            <th wire:click="order('contacto')">Contacto <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('email')">email <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('created_at')" >Creado <i class="fa fa-sort float-end sort"   aria-hidden="true"></i> </th>
                            <th>Opciones</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><input onchange='EventoIdArray(event,this)' class='form-check-input' type='checkbox' id='flexCheckDefault'></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->nombre}}</td>
                            <td>{{$user->apellido}}</td>
                            <td>{{$user->rol}}</td>
                            <td>{{$user->tipo_identidad}}</td>
                            <td>{{$user->identificacion}}</td>             
                            <td>{{$user->contacto}}</td>
                            <td>{{$user->email}}</td>

                            <td>{{$user->created_at}}</td>
                            <td><button data-bs-toggle="modal" data-bs-target="#updateDataModal"  class='btn  btn-success btn-sm' wire:click.prevent="edit('{{$user->id}}')"><i class='fe fe-edit fs-14'></i></button>&nbsp&nbsp&nbsp&nbsp
                                <button type="button" data-bs-toggle="modal" wire:click.prevent="ChangeId('{{$user->id}}')" data-bs-target="#DeleteModal" class='btn btn-primary btn-sm drop-btn ml-2 '><i class='fe fe-trash-2 fs-14'></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <br>
                <div class="float-end">{{ $users->links() }}</div>
            <div class="float-start">
                Mostrando pagina {{$users->currentPage()}} de {{$users->lastPage()}} de un total de {{$users->total()}} registros
            </div>
                @else

                <p>No se ha encontrado ningun registro en la tabla</p>
                @endif

               
            </div>  
          
          
            
            
           
        </div>
    </div>

</div>
</div>
