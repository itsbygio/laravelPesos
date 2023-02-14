<div class="modal fade" id="editar_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nueva Categoria</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="FormEditarCategoria">
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Titulo </label>
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="text" class="form-control" id="titulo" name="titulo">
                        <span style="color:red" id="error_titulo"></span>
                      </div>
                    
                    </form>
                  </div>
                <div class="modal-footer">
                    <button  onclick="EditarCategoria()" class="btn ripple btn-success" type="button">Guardar Cambios</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Cerrar</button>
                </div>
            </div>
        </div>
    </div>