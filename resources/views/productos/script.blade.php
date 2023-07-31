<script>
    let id_producto = '';
    const dropzoneUpload = new Dropzone('#FileInput', {
        url: "../administrar/gallery/SaveProduct",
        autoProcessQueue: false,
        dictDefaultMessage: 'Sube aquí tu imagen',
        acceptedFiles: ".png,.jpg,.jpeg,.webp",
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        },
        maxFiles: 1,
        init: function() {
            this.on("addedfile", function(file) { 
                  file.previewElement.classList.add('dz-complete');
                  });

            this.on("success", function(file, response) {
                //id_producto = response.id;
               // file.previewElement.innerHTML = "";
             //  file.previewElement.classList.add('dz-complete');

             this.removeFile(file);




            });
            this.on("error", function(file, response) {
              //  this.removeFile(file);
            });
            this.on("sending", function(file, xhr, formData) {
                formData.append("id_producto", id_producto);

                //  formData.append("sku", $('#FormCrear  input#sku').val());
                /// formData.append("descripcion", $('#FormCrear  textarea#descripcion').val());
                //formData.append("id_categoria", $('#FormCrear  select#id_categoria').val());
                //formData.append("precio", $('#FormCrear  input#precio').val());
                //formData.append("titulo", $('#FormCrear  input#titulo').val());

            });
        },
        maxfilesexceeded: function(files) {
            this.removeAllFiles();
            this.addFile(files);
        },

    });
    const dropzoneUploads = new Dropzone('#FilesInput', {
        url: "administrar/gallery/SaveProducts",
        dictDefaultMessage: 'Sube aquí tus imagenes',
        acceptedFiles: ".png,.jpg,.jpeg,.webp",
        autoProcessQueue: false,
        parallelUploads: 20,
        maxFiles: 10,
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        },
        init: function() {
            this.on("addedfile", function(file) { 
                  file.previewElement.classList.add('dz-complete');
             });
          
            this.on("maxfilesexceeded", function(files) {
                this.removeAllFiles();
                this.addFile(files);
            });
            this.on("success", function(file, response) {
              console.log(file);
             // file.previewElement.innerHTML = "";
             //file.previewElement.classList.add('dz-complete');
            //  this.removeFile(file);

            });
            this.on("error", function($file, response) {
               // this.removeFile(file);

            });
            this.on("sending", function(file, xhr, formData) {
                formData.append("id_producto", id_producto);
            });
        },



    });

    async function GuardarProducto() {


        axios.post('/administrar/productos/store', $('#FormCrear').serialize()).then((response) => {
            id_producto = response.data.id;
            dropzoneUpload.processQueue();
            dropzoneUploads.processQueue();
            validationSuccess();
            window.livewire.emit('render');
            swal("Felicidades!", "Su producto ha sido guardado de forma exitosa", "success")
            document.getElementById('FormCrear').reset();
            $('.richText-editor').html("");
            CleanInputsFile();
        }).catch((error) => {

            validationErrors(error);
        });
    }
    


    function validationSuccess() {
        $('#error_titulo').html("");
        $('#error_precio').html("");
        $('#error_sku').html("");
        $('#error_stock').html("");
    }

    function validationErrors(error) {
        (typeof error.response.data.titulo != 'undefined') ? $('#FormCrear  span#error_titulo').html(error.response.data.titulo[0]): $('#FormCrear span#error_titulo').html("");
        (typeof error.response.data.precio != 'undefined') ? $('#FormCrear  span#error_precio').html(error.response.data.precio[0]): $('#FormCrear  span#error_precio').html("");
        (typeof error.response.data.sku != 'undefined') ? $('#FormCrear  span#error_sku').html(error.response.data.sku[0]): $('#FormCrear  span#error_sku').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrear  span#error_stock').html(error.response.data.stock[0]): $('#FormCrear  span#error_stock').html("");
    }

    function CleanInputsFile(){
        let FileInput = document.querySelector("#FileInputEdit")
        let FilesInput = document.querySelector("#FilesInput");
        if (FileInput.childElementCount > 1) {
            FileInput.children[1].remove();
            FileInput.classList.remove('dz-started');
            dropzoneUploadEdit.removeAllFiles();
        }
        if (FilesInput.childElementCount > 1) {
            dropzoneUploadEdit.removeAllFiles();
            for (i = FilesInput.childElementCount - 1; i > 0; i--) {
                FilesInput.children[i].remove()
            }
            FilesInput.classList.remove('dz-started');
        }
    }

    async function GuardarUsuario() {


axios.post('/administrar/usuarios/store', $('#FormCrearuser').serialize()).then((response) => {
    
    validationSuccess();
    window.livewire.emit('render');
    swal("Felicidades!", "usuario agregado exitosamentes", "success")
    document.getElementById('FormCrearuser').reset();
    $('.richText-editor').html("");
    CleanInputsFile();
}).catch((error) => {

    validationErrors(error);
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
        (typeof error.response.data.titulo != 'undefined') ? $('#FormCrearuser  span#error_nombre').html(error.response.data.titulo[0]): $('#FormCrearuser span#error_nombre').html("");
        (typeof error.response.data.precio != 'undefined') ? $('#FormCrearuser  span#error_apelllido').html(error.response.data.precio[0]): $('#FormCrearuser  span#error_apelllido').html("");
        (typeof error.response.data.sku != 'undefined') ? $('#FormCrearuser  span#error_rol').html(error.response.data.sku[0]): $('#FormCrearuser  span#error_rol').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrearuser  span#error_password').html(error.response.data.stock[0]): $('#FormCrear  span#error_password').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrearuser  span#error_tipo_identificacion').html(error.response.data.stock[0]): $('#FormCrear  span#error_tipo_identificacion').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrearuser  span#error_identificacion').html(error.response.data.stock[0]): $('#FormCrear  span#error_identificacion').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrearuser  span#error_contacto').html(error.response.data.stock[0]): $('#FormCrear  span#error_contacto').html("");
        (typeof error.response.data.stock != 'undefined') ? $('#FormCrearuser  span#error_email').html(error.response.data.stock[0]): $('#FormCrear  span#error_email').html("");
    }
</script>