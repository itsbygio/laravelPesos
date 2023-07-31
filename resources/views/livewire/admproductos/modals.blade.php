<div>
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"> Nuevo Producto:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-xl-6">
                            <h6 class="modal-title mb-3  mt-2">SKU del producto:</h6>
                            <input id="sku" wire:model.defer="sku" name="sku" class="form-control mb-3" type="text">
                            @error('sku') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Titulo del producto:</h6>
                            <input id="titulo"wire:model.defer="titulo" name="titulo" class="form-control  mb-3" type="text">
                            @error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Productos en Stock</h6>
                                <input id="stock" wire:model.defer="stock" name="stock" class="form-control  mb-3" type="number">
                                @error('stock') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Imagen del producto:</h6>
                            <input type="file"wire:model.defer="size_image" id='size_imagen' name="size_imagen"class="form-control  mb-3" >
                            @error('size_image') <span class="error text-danger">{{ $message }}</span> @enderror


                        </div>

                        <div class="col-xl-6">
                            <h6 class="modal-title mb-3 mt-2" >Precio:</h6>
                            <input type="text" wire:model.defer="precio" id="precio" name="precio" class="form-control mb-3">
                            @error('precio') <span class="error text-danger">{{ $message }}</span> @enderror

                                <h6 class="modal-title mb-3 mt-2" >Categoria del producto:</h6>

                                <select name="id_categoria"wire:model.defer="id_categoria" id="id_categoria" class="form-control mb-3">
                                    <option value=""> Ninguno</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}"> {{$categoria->titulo}}</option>
                                    @endforeach
                                </select>
                                @error('id_categoria') <span class="error text-danger">{{ $message }}</span> @enderror
                                
                                

                        </div>
                    </div>
                   
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" wire:click.prevent="store()" class="btn btn-primary">Agregar </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="EditDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDataModalLabel"> Editar Producto:</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                
                    <div class="row">
                        <div class="col-xl-6">
                            <input type="hidden" wire:model="id_producto">
                            
                            <h6 class="modal-title mb-3  mt-2">SKU del producto:</h6>
                            <input  wire:model.defer="sku" class="form-control mb-3" type="text">
                            @error('sku') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Titulo del producto:</h6>
                            <input wire:model.defer="titulo" class="form-control  mb-3" type="text">
                            @error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Productos en Stock</h6>
                                <input  type="number" wire:model.defer="stock"  class="form-control  mb-3" type="text">
                                @error('stock') <span class="error text-danger">{{ $message }}</span> @enderror
                                
                           
                        </div>
                        <div class="col-xl-6">
                            <h6 class="modal-title mb-3 mt-2" >Precio:</h6>
                            <input type="text" class="form-control" id="precio" wire:model.defer="precio" value="">

                            @error('precio') <span class="error text-danger">{{ $message }}</span> @enderror

                                <h6 class="modal-title mb-3 mt-2" >Categoria del producto:</h6>

                                <select wire:model.defer ="id_categoria" class="form-control mb-3">
                                    <option wire:model.defer ="id_categoria" value=""> Ninguno</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}"> {{$categoria->titulo}}</option>
                                    @endforeach
                                </select>
                                @error('id_categoria') <span class="error text-danger">{{ $message }}</span> @enderror
                               <h6 class="modal-title mb-3 mt-2 ">Imagen del producto:</h6>
                            <input type="text" data-bs-toggle="modal" data-bs-target="#updateImage" class="form-control  mb-3" disabled >
                            @error('size_image') <span class="error text-danger">{{ $message }}</span> @enderror
                                
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="update()">Guardar Cambios </button>
              
            </div>
            
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title text-center">¿Desea eliminar el registro seleccionado?</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body ">
                <form id="FormDelete">
                    <input type="hidden" id="id_user">
                    <h6>Una vez reallizada esta accion no podra recuperarlo</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                <button class="btn btn-primary" wire:click="destroy()" type="button">Eliminar</button>
            </div>
            </form>

        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="MultipleDeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title text-center">¿Desea eliminar el registro seleccionado?</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body ">
                <form enctype="multipart/form-data">
                    <input type="hidden" wire:model="id_producto">
                    <h6>Una vez reallizada esta accion no podra recuperarlo</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                <button wire:click="destroy('MultipleDelete')" class="btn btn-primary" type="button">Eliminar</button>


            </div>
            </form>

        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="updateImage">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title text-center">Editar imagen</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body ">
                <form enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xl-6">
                    <h6 class="modal-title mb-3 mt-2 ">Imagen del producto:</h6>
                    <input type="file" id="input-file" wire:model.defer="size_image"  class="form-control mb-3"  onchange="showFileName()">
                    <span id="file-name"></span>
                  
                    @if ($urlImagen)
                    <img src="{{ $urlImagen }}" alt="Imagen Actual" style="max-width: 450px;">
                    @error('size_image') <span class="error text-danger">{{ $message }}</span> @enderror
                    @else
                    <p>No hay imagen actual</p>
                
                  @endif
            </div>
                    </div>
                    
            <div class="modal-footer">
                <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                <button wire:click="updateImage()" class="btn btn-primary" type="button">Actualizar imagen</button>


            </div>
            </form>

        </div>
    </div>
</div>
</div>








