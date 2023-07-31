<script>
    let id_producto_edit;
    let deleted_images = [];
    let galeria;
    const dropzoneUploadEdit = new Dropzone('#FileInputEdit', {
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

            });
            this.on("error", function(file, response) {});
            this.on("sending", function(file, xhr, formData) {
                formData.append("id_producto", id_producto_edit);
            });
        },
        maxfilesexceeded: function(files) {
            this.removeAllFiles();
            this.addFile(files);
        },

    });
    const dropzoneUploadsEdit = new Dropzone('#FilesInputEdit', {
        url: "../administrar/gallery/SaveProducts",
        dictDefaultMessage: 'Sube aquí tus imagenes',
        acceptedFiles: ".png,.jpg,.jpeg,.webp",
        autoProcessQueue: false,
        parallelUploads: 20,
        maxFiles: 20,
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
                //this.removeAllFiles();
                //this.addFile(files);
            });
            this.on("success", function(file, response) {
                this.removeFile(file);
                galeria = response.galleryxid;
                let url = `/storage/productos/${response.gallery.id_producto}/${response.gallery.id}${response.gallery.ext}`;
                // console.log(url);
                let mockFile = {
                    name: response.gallery.id + response.gallery.ext,
                    size: response.gallery.size_image
                }
                //console.log(mockFile);
                dropzoneUploadsEdit.displayExistingFile(mockFile, url);

            });
            this.on("removedfile", function(file) {
                const parts = file.name.split(".");
                console.log(parts);
                
                let existImage = galeria.find(image => image.id === parseInt(parts[0]));
                if (existImage) {
                    deleted_images.push(`${file.name}`);
                    console.log(deleted_images);
                }
                
               
                
            });
            this.on("error", function($file, response) {
                // this.removeFile(file);

            });
            this.on("sending", function(file, xhr, formData) {
                formData.append("id_producto", id_producto_edit);
            });
        },



    });


    function GetProductoByid(id) {
        deleted_images = [];
        id_producto_edit = id;
        $('#FormEdit input#id').val(id);
        let FileInput = document.querySelector("#FileInputEdit")
        let FilesInput = document.querySelector("#FilesInputEdit");
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


        axios.get(`productos/${id}/edit`).then((response) => {
            producto = response.data.producto;
            galeria = response.data.galeria;
            categoria = response.data?.categoria;
            console.log(producto.ext);
            $('#FormEdit input#titulo').val(producto.titulo)
            $('#FormEdit input#precio').val(producto.precio)
            $('#FormEdit input#sku').val(producto.sku)
            $('#FormEdit input#stock').val(producto.sku)
            if(categoria!=null){
                document.querySelector(`#FormEdit select[name='id_categoria'] option[value='${categoria.id}']`).setAttribute("selected", "")

            }
            $('.richText-editor').html(producto.descripcion)
            $("#FormEdit textarea#descripcion").val(producto.descripcion);
            mockFile = {
                name: id + producto.ext,
                size: producto.size_image
            };
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

    function UpdatedProduct() {
        let id = $('#FormEdit input#id').val();
        let dataString = $('#FormEdit').serialize();
        axios.put('../administrar/productos/' + id, dataString).then((response) => {
            swal("Felicidades!", "Su producto ha sido guardado de forma exitosa", "success");
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




    function DeleteImages() {
        if (deleted_images.length > 0) {
            deleted_images.forEach(function(element) {
                axios.post('../administrar/gallery/UpdateImagesGallery', {
                        name: element,
                        id_producto: id_producto_edit
                    })
                    .then((response) => {
                        galeria = response.data;
                        console.log(galeria);
                    })
                    .catch(error => {

                    });
            })
            deleted_images = [];
        }
    }

    function validationErrorEdit(error) {
        (typeof error.response.data.titulo != 'undefined') ? $('#FormEdit  span#error_titulo').html(error.response.data.titulo[0]): $('#FormEdit span#error_titulo').html("");
        (typeof error.response.data.precio != 'undefined') ? $('#FormEdit  span#error_precio').html(error.response.data.precio[0]): $('#FormEdit  span#error_precio').html("");
        (typeof error.response.data.sku != 'undefined') ? $('#FormEdit span#error_sku').html(error.response.data.sku[0]): $('#FormEdit  span#error_sku').html("");
    }

    function CleanErrors() {
        $('#FormEdit span#error_titulo').html("");
        $('#FormEdit  span#error_precio').html("");
        $('#FormEdit  span#error_sku').html("");
    }
</script>