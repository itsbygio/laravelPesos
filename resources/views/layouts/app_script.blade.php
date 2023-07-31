   <script>
       let Arrayids = [];

       function AbrirModalDrop(id) {
           $('#FormDelete input#id').val(id);
           $('#delete_modal').modal('show');

       }

       function destroy(url) {
           id = $('#FormDelete input#id').val();
           axios.delete("../"+ url + "/" + id)
               .then((result) => {
                   swal("Removido!", "Sus registro han sido removido exitosamente", "success");
                   $('#delete_modal').modal('hide');

                   window.livewire.emit('render');

               }).catch((err) => {
                   console.log("error");

               });

       }
      function DropUserSystem(){ 
        axios.delete("" + "/" + id)
               .then((result) => {
                   swal("Removido!", "Sus registro han sido removido exitosamente", "success");
                   $('#delete_modal').modal('hide');

                   window.livewire.emit('render');

               }).catch((err) => {
                   console.log("error");

               });
       }
       function MultipleDestroy(url) {

           for (i = 0; i < Arrayids.length; i++) {
               axios.delete("../" + url + "/" + Arrayids[i]).then(function(response) {});
           }
           window.livewire.emit('render');

           $('#delete_modals').modal('hide');
           swal("Removido!", "Sus registro han sido removido exitosamente", "success")

       }

       function EventoIdArray(event, s) {
           let id = s.parentNode.parentNode.cells[1].innerHTML;



           if (event.currentTarget.checked) {
               Arrayids.push(id);
               console.log(Arrayids);
           } else {

               Arrayids = Arrayids.filter((item) => item !== id);
               console.log(Arrayids);
           }
           if (Arrayids.length != 0) {
               $('#btn-trash').show();
           } else {
               $('#btn-trash').hide();

           }
       }
       window.livewire.on('store', () => {
           swal("Guardado!", "Sus registro han sido guardado exitosamente", "success")
       });
       window.livewire.on('storeventa', () => {
           swal("Guardado!", "Sus Venta han sido guardada exitosamente", "success")
       });
       window.livewire.on('update', () => {
           swal("Actualizado!", "Sus registros han sido actualizado exitosamente", "success")
       });
       window.livewire.on('updateImage', () => {
           swal("Actualizado!", "Su imagen ha sido actualizada exitosamente", "success")
       });
       window.livewire.on('updatePassword', () => {
           swal("Actualizado!", "Su Contraseña ha sido actualizada exitosamente", "success")
       });
       window.livewire.on('delete', () => {
           swal("Removido!", "Su registro se ha  removido exitosamente", "success")
           $('#DeleteModal').modal('hide');

       });
       window.livewire.on('MultipleDelete', () => {
           swal("Removido!", "Sus registros se ha  removido exitosamente", "success")
           $('#MultipleDeleteModal').modal('hide');

       });
       window.livewire.on('errorVenta', () => {
           swal("Error!", "No hay sufucientes productos disponibles", "error")
       });
       Livewire.on('VisibilityMultipleButtonTrash', status => {
           if (status) {
               $('#btn-trash').show();

           } else {
               $('#btn-trash').hide();

           }
       })
       
   </script>