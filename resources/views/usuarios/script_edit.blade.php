<script>
   


    function GetProductoByid(id) {
        


        axios.get(`user/${id}/edit`).then((response) => {
            
            console.log(user.ext);
            $('#FormEdit input#nombre').val(user.nombre)
            $('#FormEdit input#apellido').val(user.apellido)
            $('#FormEdit input#rol').val(user.rol)
            $('#FormEdit input#password').val(user.password)
            $('#FormEdit input#tipo_identificiacion').val(user.tipo_identificiacion)
            $('#FormEdit input#identificacion').val(user.identificacion)
            $('#FormEdit input#contacto').val(user.contacto)
            $('#FormEdit input#email').val(user.email)
            
          
            if (producto.ext != null && producto.ext != "" ) {
                // dropzoneUploadEdit.removeAllFiles();
                dropzoneUploadEdit.emit("addedfile", mockFile);
                dropzoneUploadEdit.emit("thumbnail", mockFile, "/storage/productos/" + id + producto.ext);
                dropzoneUploadEdit.emit("complete", mockFile);

            }
            if (galeria.length > 0) {
                //dropzoneUploadsEdit.removeAllFiles();

                response.data.galeria.forEach(element => {
                    mockFile = {
                        name: element.id + element.ext,
                        size: element.size_image
                    }
                    dropzoneUploadsEdit.emit("addedfile", mockFile);
                    dropzoneUploadsEdit.emit("thumbnail", mockFile, `/storage/productos/${id}/${element.id}${element.ext}`);
                    dropzoneUploadsEdit.emit("complete", mockFile);
                });
            }
        }).catch((error) => {
            console.log(err);

        });
    }

    function UpdatedUser() {
        let id = $('#FormEdit input#id').val();
        let dataString = $('#FormEdit').serialize();
        axios.put('../administrar/usuarios/' + id, dataString).then((response) => {
            swal("Felicidades!", "Su usuario ha sido editado de forma exitosa", "success");
            window.livewire.emit('render');
            CleanErrors();
            dropzoneUploadEdit.processQueue();
            if (dropzoneUploadsEdit.files.length > 0) {
                dropzoneUploadsEdit.processQueue();

            }

            DeleteImages();

        }).catch((error) => {
            validationErrorEdit(error);
        });

    }

    function validationSuccess() {
        $('#error_nombre').html("");
        $('#error_apelllido').html("");
        $('#error_rol').html("");
        $('#error_password').html("");
        $('#error_tipo_identificacion').html("");
        $('#error_identificacion').html("");
        $('#error_contacto').html("");
        $('#error_email').html("");
    }

    function validationErrors(error) {
        (typeof error.response.data.titulo != 'undefined') ? $('#FormEdit  span#error_nombre').html(error.response.data.titulo[0]): $('#FormEdit span#error_nombre').html("");
        (typeof error.response.data.precio != 'undefined') ? $('#FormEdit  span#error_apelllido').html(error.response.data.precio[0]): $('#FormEdit  span#error_apelllido').html("");
        (typeof error.response.data.sku != 'undefined') ? $('#FormEdit  span#error_rol').html(error.response.data.sku[0]): $('#FormEdit  span#error_rol').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormEdit  span#error_password').html(error.response.data.stock[0]): $('#FormEdit  span#error_password').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormEdit  span#error_tipo_identificacion').html(error.response.data.stock[0]): $('#FormEdit  span#error_tipo_identificacion').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormEdit  span#error_identificacion').html(error.response.data.stock[0]): $('#FormCrear  span#error_identificacion').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormEdit  span#error_contacto').html(error.response.data.stock[0]): $('#FormEdit  span#error_contacto').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormEdit  span#error_email').html(error.response.data.stock[0]): $('#FormEdit  span#error_email').html("");
    }
</script>