<div class="modal fade" id="delete_modals">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title text-center">¿Desea eliminar los registros seleccionados?</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body ">
                <h6>Una vez reallizada esta accion no podra recuperarlos</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                <button onclick="MultipleDestroy('{{ Request::path() }}')" class="btn btn-primary" type="button">Eliminar</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title text-center">¿Desea eliminar el registro seleccionados?</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <form id="FormDelete">
         <input type="hidden" id="id">
            </form>
            <div class="modal-body ">
                <h6>Una vez reallizada esta accion no podra recuperarlos</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default-light" data-bs-dismiss="modal" type="button">Cerrar</button>
                <button onclick="destroy('{{ Request::path() }}')" class="btn btn-primary" type="button">Eliminar</button>
            </div>
        </div>
    </div>
</div>
