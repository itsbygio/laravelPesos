<div>
    
    <div class="page-header">
        <script>
           function showFileName() {
  var inputFile = document.getElementById("input-file");
  var fileName = inputFile.value.split("\\").pop();
  var fileNameElement = document.getElementById("file-name");
  fileNameElement.innerHTML = fileName;
}
        </script>
        <h1 class="page-title">Administrar Productos</h1>
     
    </div>
    <div class="card">
        @include('livewire.admproductos.modals')
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2">
                    <div class="btn  btn-dark" data-bs-toggle="modal" data-bs-target="#createDataModal">
                        <i class="fa fa-plus"></i> Generar Productos
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
                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Producto"><br>
                    
                </div>
                <div class="col-xl-2" style="text-align:right">
                    <button  wire:click=" exportToExcel()" class='btn btn-dark btn-sm'> Generar reporte
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
                    <button style="display:none;" id="btn-trash" data-bs-target="#MultipleDeleteModal" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>

                </div>
               
            </div>


            <div class="table-responsive">

                @if($productos->count())

                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">

                    <thead>
                        <tr>
                            <th></th>
                            <th wire:click="order('id')">id <i class="fa fa-sort float-end sort"   aria-hidden="true"></i>
                            </th>
                            <th wire:click="order('sku')">Sku <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('stock')">En Stock <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('precio')">Precio <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th wire:click="order('titulo')">Titulo <i class="fa fa-sort float-end sort"   aria-hidden="true"></i></th>
                            <th>Categorias</th>

                            <th wire:click="order('created_at')" >Creado <i class="fa fa-sort float-end sort"   aria-hidden="true"></i> </th>
                            <th>Imagen</th>
                            <th>Opciones</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td><input onchange='EventoIdArray(event,this)' class='form-check-input' type='checkbox' id='flexCheckDefault'></td>
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->sku}}</td>
                            <td>{{$producto->stock}}</td>
                            <td>COP <?php echo number_format($producto->precio, 0, '.'); ?></td>
                            <td>{{$producto->titulo}}</td>
                           
                            <td>@if(isset($producto->categoria->titulo)){{$producto->categoria->titulo}} @else Sin categoria @endif</td>

                            <td>{{$producto->created_at}}</td>
                            <td><img data-bs-toggle="modal" wire:click.prevent="editImage('{{$producto->id}}')" data-bs-target="#updateImage" src="{{ asset('productos/' . $producto->size_image) }}" style="max-width: 80px;"></td>
                            <td><button data-bs-toggle="modal" wire:click.prevent="edit('{{$producto->id}}')" data-bs-target="#updateDataModal" class='btn  btn-success btn-sm'><i class='fe fe-edit fs-14'></i></button>&nbsp&nbsp&nbsp&nbsp
                                <button data-bs-toggle="modal" wire:click.prevent="ChangeId('{{$producto->id}}')" data-bs-target="#DeleteModal" class='btn btn-primary btn-sm drop-btn ml-2 '><i class='fe fe-trash-2 fs-14'></i></button></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <br>
                <div class="float-end">{{ $productos->links() }}</div>
                <div class="float-start">
                    Mostrando pagina {{$productos->currentPage()}} de {{$productos->lastPage()}} de un total de {{$productos->total()}} registros
                </div>
                @else

                <p>No se ha encontrado ningun registro en la tabla</p>
                @endif
            </div>
            

        </div>
    </div>
    

</div>
