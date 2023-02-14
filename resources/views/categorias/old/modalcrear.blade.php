<div class="modal fade" id="agregar_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nueva Categoria</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="FormCrear">
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Titulo </label>
                        <input type="text" class="form-control" name="titulo">
                        <span style="color:red" id="error_titulo"></span>

                      </div>
                    
                    </form>
                  </div>
                <div class="modal-footer">
                    <button   onclick="CrearCategoria()" class="btn ripple btn-success" type="button">Agregar</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Cerrar</button>
                </div>
            </div>
        </div>
    </div>