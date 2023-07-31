<div>
    <div class="page-header">
        <h1 class="page-title">Ventas  </h1>
        
    </div>
    <div class="card">

        @include('livewire.admventas.modals')

        <div class="card-body">
            <div class="row">
                <div class="col-xl-2">
                    <div class="btn  btn-dark" data-bs-toggle="modal" data-bs-target="#createDataModal">
                        <i class="fa fa-plus"></i> Generar Venta
                    </div>
                </div>
           <br><br>
            </div>
            <div class="row">

                <div class="col-xl-4 mb-2">

                    Mostrar
                    <select wire:model.defer="npagination" name="npagination" id="npagination" wire:change="change">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    registros por pagina

                </div>
                <div class="col-xl-6">
                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Producto"><br>
                </div>
                <div class="col-xl-2" style="text-align:right">
                    <button style="display:none;" id="btn-trash" data-bs-target="#delete_modals" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>

                </div>
            </div>
            <div class="table-responsive">

                @if($ventas->count())

                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">

                    <thead>
                        <tr>
                           <th></th>
                            <th wire:click="order('id')">id <i class="fa fa-sort float-end sort"   aria-hidden="true"></i>
                            </th>
                            <th wire:click="order('codigo')">Codigo de venta<i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                           
                          
                            <th wire:click="order('total')">valor total<i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('created_at')" >Creado <i class="fa fa-sort float-end sort"   aria-hidden="true"></i> </th>
                            <th wire:click="order('created_at')" >Actualizado <i class="fa fa-sort float-end sort"   aria-hidden="true"></i> </th>
                            <th>Opciones</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                        <tr>
                            <td><input onchange='EventoIdArray(event,this)' class='form-check-input' type='checkbox' id='flexCheckDefault'></td>
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->codigo}}</td>
                          
                            
                            <td>COP <?php echo number_format($venta->total, 0, '.'); ?></td>
                            <td>{{$venta->created_at}}</td>
                            <td>{{$venta->updated_at}}</td>
                          
                            <td>  <button wire:click="showVenta({{ $venta->id }})" data-bs-toggle="modal" data-bs-target="#factura" class='btn btn-dark btn-sm'> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></a>
                                <button data-bs-toggle="modal" wire:click="edit('{{$venta->id}}')" data-bs-target="#EditDataModal" class='btn  btn-success btn-sm'><i class='fe fe-edit fs-14'></i></button>
                                <button data-bs-toggle="modal" wire:click="ChangeId('{{$venta->id}}')" data-bs-target="#DeleteModal" class='btn btn-primary btn-sm drop-btn ml-2 '><i class='fe fe-trash-2 fs-14'></i></button>
                               </td>

                        </tr>
                          
                          
                          
                          @endforeach
                    </tbody>
                </table>
               
              
                <div class="float-end">{{ $ventas->links() }}</div>
                <div class="float-start">
                    Mostrando pagina {{$ventas->currentPage()}} de {{$ventas->lastPage()}} de un total de {{$ventas->total()}} registros
                </div>
                @else

                <p>No se ha encontrado ningun registro en la tabla</p>
                @endif
             
        </div>
    </div>
    
</div>
