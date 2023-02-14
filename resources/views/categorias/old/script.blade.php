<script>
     let ModalEditar = new bootstrap.Modal(document.getElementById('editar_modal'), {
            keyboard: false,
            backdrop: 'static',

        });
        
    let Array_category_ids = [];
    let table = $('#categorias').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron registros coincidentes",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "emptyTable": "No hay datos",
            "processing": "",

            "infoEmpty": "No registros disponibles",
            "loadingRecords": "Loading...",

            "infoFiltered": "(filtrado de _MAX_ total de registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },

        ajax: {
            "url": "/getcategorias",
            "type": "GET",
            "dataSrc": "",
        },

        columns: [{
                "defaultContent": "<input onchange='EventoIdArray(event,this)' class='form-check-input' type='checkbox'  id='flexCheckDefault'>",
                "className": "text-center"
            },

            {
                "data": "id",
                "className": "d-none"
            },
            {
                "data": "titulo",

            },
            {
                "data": "created_at",
                render: $.fn.dataTable.render.moment("YYYY-MM-DDTHH:mm:ss.000000Z", "YYYY-MM-DD HH:mm:ss")
            },
            {
                "data": "updated_at",
                render: $.fn.dataTable.render.moment("YYYY-MM-DDTHH:mm:ss.000000Z", "YYYY-MM-DD HH:mm:ss")
            },

            {
                "defaultContent": "<button  class='btn  btn-success btn-sm' onclick='AbrirModalEditar(this)'><i class='fe fe-edit fs-14'></i></button>&nbsp&nbsp&nbsp&nbsp<button type='button' onclick='AbrirButtonModalDelete(this)'     class='btn btn-primary btn-sm drop-btn ml-2 '><i class='fe fe-trash-2 fs-14'></i></button>",
                "className": "text-center"
            },
        ],
    });

    function CrearCategoria() {
        let dataString = $('#FormCrear').serialize();
        axios.post("categorias/", dataString).then(function(response) {
            $("#FormCrear span#error_titulo").html("");
            document.getElementById('FormCrear').reset();
            table.ajax.reload();
            swal("Agregado", "Su categoria ha sido agregada exitosamente", "success");

        }).catch(err => {
            $("#FormCrear span#error_titulo").html(err.response.data.titulo[0]);
        });
    }

    function eliminar(s, mode) {
        let id = [];
        let parametro = [];
        if (mode == "check") {
            $('#delete_modals').modal('hide');
            parametro = Array_category_ids;
            swal("Removido!", "Sus registros han sido removidos exitosamente", "success");

        } else {
            id.push($("#FormDelete input#id").val());
            console.log(id);
            parametro=id;
            $('#delete_modal').modal('hide');

            swal("Removido!", "Sus registro han sido removido exitosamente", "success");


        }
        
        axios.delete("categorias/" + parametro).then(function(response) {
                table.ajax.reload();
         });
    
    }

    function EditarCategoria() {
        let id = $("#FormEditarCategoria input#id").val();
        let dataString = $('#FormEditarCategoria').serialize();

        axios.put("categorias/" + id, dataString).then(function(response) {
            $("#FormEditarCategoria span#error_titulo").html("");
            swal("Actualizado", "Su categoria ha sido actualizada exitosamente", "success");
            table.ajax.reload();

            //console.log(response);
        }).catch(err => {
            $("#FormEditarCategoria span#error_titulo").html(err.response.data.titulo[0]);

        });
    }


    function EventoIdArray(event, s) {
        let data = table.row($(s).parents('tr')).data();
        if (event.currentTarget.checked) {
            Array_category_ids.push(data.id);
            // console.log(Array_category_ids);
        } else {

            Array_category_ids = Array_category_ids.filter((item) => item !== data.id);
            // console.log(Array_category_ids);
        }
        if (Array_category_ids.length != 0) {
            $('#btn-trash').show();
        } else {
            $('#btn-trash').hide();

        }

    }


    function AbrirModalEditar(s) {
        let data = table.row($(s).parents('tr')).data();
        $("#FormEditarCategoria input#id").val(data.id);

        $("#FormEditarCategoria input#titulo").val(data.titulo);
        ModalEditar.show()
        $('#editar_modal').modal('hide');

    }

  

    function AbrirButtonModalDelete(s) {
        $('#delete_modal').modal('show');
        $('#FormDelete input#id').val(table.row($(s).parents('tr')).data().id);

    }
    function AbrirModalCrear() {
        document.getElementById('FormCrear').reset();
  
        }
 
</script>