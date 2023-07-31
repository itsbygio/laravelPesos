<div>
    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="createDataModalLabel"> Nuevo Usuario:</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
               </div>
                <div class="modal-body">
                 <form>
                    <div class="row">
                        <div class="col-xl-6">

                            <h6 class="modal-title mb-3  mt-2">Nombre</h6>
                            <input id="nombre" wire:model.defer="nombre" class="form-control mb-3" type="text">
                            @error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror

                            <h6 class="modal-title mb-3 mt-2 ">Apellido</h6>
                             <input id="apellido" wire:model.defer="apellido" class="form-control  mb-3" type="text">
                             @error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror

                             
                             <h6 class="modal-title mb-3 mt-2 ">Rol</h6>
                                 <select id="rol" wire:model.defer="rol" class="form-control  mb-3" type="text">
                                 <option value="">Elegir Rol</option>
                                 <option value="SuperAdmin">Super admin</option>
                                 <option value="Admin" >Administrador</option>
                                 <option value="Fact">facturacion</option>
                                 </select>
 
                                 @error('rol') <span class="error text-danger">{{ $message }}</span> @enderror
                                 <h6 class="modal-title mb-3 mt-2 ">Contraseña</h6>
                                 <input id="password" wire:model.defer="password" type="password" class="form-control  mb-3" >
                                  @error('password') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>

                        <div class="col-xl-6">
                            

                            <h6 class="modal-title mb-3 mt-2 ">Tipo de Identificación</h6>
                            <select id="tipo_identidad" wire:model.defer="tipo_identidad" class="form-control  mb-3" type="text">
                                <option value="">Elegir tipo</option>
                                <option value="CC" >CC</option>
                                <option value="CC DIG">CC DIG</option>
                                <option value="CE">CE</option>
                                <option value="NUIP">NUIP</option>
                                <option value="TI">TI</option>
                                <option value="RC">RC</option>
                                </select>

                                @error('tipo_identidad') <span class="error text-danger">{{ $message }}</span> @enderror
                                <h6 class="modal-title mb-3 mt-2" >Identificaión</h6>
                         <input type=" text" id="identificacion" wire:model.defer="identificacion" class="form-control mb-3">
                                 @error('identificacion') <span class="error text-danger">{{ $message }}</span> @enderror
 
                                 <h6 class="modal-title mb-3 mt-2" >Contacto</h6>
                         <input type=" text" id="contacto" wire:model.defer="contacto" class="form-control mb-3">
                                 @error('contacto') <span class="error text-danger">{{ $message }}</span> @enderror
 
                                 <h6 class="modal-title mb-3 mt-2" >Email</h6>
                         <input type=" text" id="email" wire:model.defer="email" class="form-control mb-3">
                                 @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>    
                    </div>
                 </form>
                </div>
                 <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                     <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar </button>
                  </div>
                 
                 
            </div>
         </div>
     </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="updateDataModal" bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Editar usuario</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form>
                     
                        <div class="row">
                            <div class="col-xl-6">
                                <input type="hidden" wire:model="id_user">

                                <h6 class="modal-title mb-3  mt-2">Nombre</h6>
                                <input wire:model.defer='nombre' class="form-control mb-3" type="text" >
                                <span id="error_nombre"  class="mb-5 text-red"></span>

                                <h6 class="modal-title mb-3 mt-2 ">Apellido</h6>
                                <input  wire:model.defer='apellido' class="form-control  mb-3" type="text" >
                                <span id="error_apellido"  class="mb-3 text-red"></span>

                                <h6 class="modal-title mb-3 mt-2 ">Rol</h6>
                                    <select wire:model.defer='rol' class="form-control  mb-3" type="text" value="">
                                    <option wire:model.defer="rol"></option>
                                    
                                    <option value="SuperAdmin">Super admin</option>
                                   
                                    <option value="Admin" >Administrador</option>
                                    
                                    <option value="Fact">facturacion</option>
                                    
                                    </select>
                                    <span id="error_rol"  class="mb-3 text-red"></span>
                                    <h6 class="modal-title mb-3 mt-2 ">Tipo de Identificación</h6>
                                    <select  wire:model.defer="tipo_identidad" class="form-control  mb-3" type="text">
                                        <option wire:model.defer="tipo_identidad" ></option>
                                       
                                        <option value="CC" >CC</option>        
                                        <option value="CC DIG">CC DIG</option>
                                        <option value="CE">CE</option>
                                    
                                        
                                        <option value="NUIP">NUIP</option>
                                     
                                        <option value="TI">TI</option>
                                   
                                      
                                        <option value="RC">RC</option>
                                       
                                        </select>
                                        @error('tipo_identidad') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-xl-6">
                              
    
                                    <h6 class="modal-title mb-3 mt-2" >Identificaión</h6>
                                    <input type=" text"  wire:model.defer='identificacion' class="form-control mb-3">
                                    <span id="error_identificiacion" class="mb-5 text-red"></span>
    
                                    <h6 class="modal-title mb-3 mt-2" >Contacto</h6>
                                    <input type=" text"  wire:model.defer='contacto' class="form-control mb-3" >
                                    <span id="error_contacto" class="mb-5 text-red"></span>
    
                                    <h6 class="modal-title mb-3 mt-2" >Email</h6>
                                    <input type=" text"  wire:model.defer='email' class="form-control mb-3" >
                                    <span id="error_email" class="mb-5 text-red"></span> 
                            </div>
                        </div>        
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>  Actualizar usuario</button>
                </div>
                    <div class="modal-content">
                       <div class="modal-header">  
                          <h5 class="modal-title" id="createDataModalLabel"> Editar contraseña:</h5>
                       </div>
                       <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-xl-6">
                                       <h6 class="modal-title mb-3 mt-2 ">Contraseña</h6>
                                       <input id="password" wire:model.defer="password" type="password" class="form-control  mb-3" >
                                       @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" wire:click.prevent="updatePassword()" class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                             class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>Actualizar contraseña</button>
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
                    <button class="btn btn-primary" wire:click.prevent="destroy()" type="button">Eliminar</button>


                </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="MultipleDeleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="modal-title text-center">¿Desea eliminar el registro seleccionado?</h6>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body ">
                    <form >
                        <input type="hidden" wire:model="id">
                        <h6>Una vez reallizada esta accion no podra recuperarlo</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                    <button wire:click.prevent="destroy()" class="btn btn-primary" type="button">Eliminar</button>


                </div>
                </form>

            </div>
        </div>
    </div>
</div>