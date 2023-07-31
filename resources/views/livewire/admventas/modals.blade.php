<div>
    <div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataModalLabel"> Nueva Venta:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form >
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
                                <button style="display:none;" id="btn-trash" data-bs-target="#MultipleDeleteModal" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>
            
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                @if($productos->count())
                                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>cantidad</th>
                                            <th>Precio</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $producto)
                                            <tr>
                                              
                                                <td><img data-bs-toggle="modal" src="{{ asset('productos/' . $producto->size_image) }}" style="max-width: 80px;">{{ $producto->titulo }}</td>
                                                <td>      
                                                           <input type="number" class="form-control" style="max-width: 140px;" wire:model.defer="cantidad_vendida.{{ $producto->id }}" min="0" >
                                                            <h6 class="modal-title mb-3 mt-2" >Hay {{$producto->stock}} disponibles</h6>
                                                            
                                                </td>
                                                <td>{{$producto->precio}}</td>
                                                <td>
                                                    <input type="checkbox" class='form-check-input'  id='flexCheckDefault' wire:model.defer="productos_seleccionados" value="{{ $producto->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                    <div class="modal-footer">
                       <button type="button"  class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                       <button type="button" wire:click.prevent="store()" class="btn btn-primary">Agregar </button>
                   </div>
            </form>
            </div>
        </div>
        
    </div>
    <div wire:ignore.self class="modal fade" id="EditDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="EditDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDataModalLabel">Editar Venta:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
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
                                <button style="display:none;" id="btn-trash" data-bs-target="#MultipleDeleteModal" data-bs-toggle="modal" type="button" data-bs-whatever="@mdo" class="btn btn-outline-default"><i class="fe fe-trash"></i></button>
            
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                @if($productos->count())
                                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $producto)
                                            <tr>
                                                <td>
                                                    <img data-bs-toggle="modal" src="{{ asset('productos/' . $producto->size_image) }}" style="max-width: 80px;">{{ $producto->titulo }}
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" style="max-width: 140px;" wire:model.defer="cantidad_vendida.{{ $producto->id }}" min="0" value="{{ $cantidad_vendida[$producto->id] ?? '' }}">
                                                    <h6 class="modal-title mb-3 mt-2">Hay {{ $producto->stock }} disponibles</h6>
                                                </td>
                                                <td>
                                                    {{ $producto->precio }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" id="flexCheckDefault{{ $producto->id }}" wire:model.defer="productos_seleccionados" value="{{ $producto->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-end">{{ $productos->links() }}</div>
                                <div class="float-start">
                                    Mostrando pagina {{$productos->currentPage()}} de {{$productos->lastPage()}} de un total de {{$productos->total()}} registros
                                </div>
                                @else
                
                                <p>No se ha encontrado ningun registro en la tabla</p>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
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
    <div wire:ignore.self class="modal fade" id="factura" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDataModalLabel"> Detalles de la venta:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form >
                        
                        <div class="row">
                            <h4>Codigo de venta: {{$codigo}}</h4>
                            <div class="table-responsive">
                                <table class="table text-nowrap text-md-nowrap mb-0" style="width:100%">
                                    <thead>
                                      
                                        <tr>
                                            
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio unitario</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <tr>    
                                        @foreach ($productosVendidos as $producto)
                                               
                                                <td>{{ $producto['titulo'] }} </td>
                                                <td>{{ $producto['cantidad_vendida'] }} </td>
                                                <td><?php echo number_format($producto['precio'], 0, '.'); ?></td>
                                                <td><?php echo number_format($producto['total'], 0, '.'); ?> </td>   
                                            </tr>
                                        
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                          <td></td><td></td>
                                            <td>Total:</td>
                                            <td><?php echo number_format($total, 0, '.'); ?></td>
                                           <th>
                                          
                                        </th> 
                    
                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
                   
                </div>
                    <div class="modal-footer">
                       <button type="button"  class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                       <button type="button" wire:click="generarFacturaPdf('{{$ventaId}}')" class="btn  btn-dark "> Descargar factura <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
                   </div>
            </form>
            </div>
        </div>
        
    </div>
</div>
    