<div>
    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataModalLabel">Create New Categoria</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="titulo"></label>
                            <input wire:model.defer="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo">@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="updateDataModal" bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Categoria</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model="selected_id">
                        <div class="form-group">
                            <label for="titulo"></label>
                            <input wire:model.defer="titulo" type="text" class="form-control" id="titulo" placeholder="">@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary">Guardar</button>
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
                        <input type="hidden" id="id">
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
                    <form id="FormDelete">
                        <input type="hidden" id="id">
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
</div>