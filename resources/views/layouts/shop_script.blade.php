<script>
    const cardBody = document.querySelector('#bodycard');
  
    const cardToggleBtn = document.querySelector('.card-header button');

    function toggleCardBody() {
        if (window.innerWidth < 1200) {
            cardBody.classList.toggle('show');
            if (cardBody.classList.contains('d-block')) {
                cardBody.classList.remove('d-block');
                cardBody.classList.add('d-none');

            } else {
                cardBody.classList.remove('d-none');
                cardBody.classList.add('d-block');
            }


        }
    }

    function detectarTecla(event) {
        cardBody.classList.remove('d-block');
        cardBody.classList.add('d-none');
        //   if (event.key === "Enter") {
        //     // Hacer algo cuando se presiona la tecla Enter
        //     console.log("Se presionó la tecla Enter");
        //   } else {
        //     // Hacer algo cuando se presiona otra tecla
        //     console.log(`Se presionó la tecla ${event.key}`);
        //   }
    }

    cardToggleBtn.addEventListener('click', toggleCardBody);
</script>

<script>
    let arrayCart = [];
    let cantidades;
    let total;
    let cart_template = document.querySelector('#cart_template');

    Init();

    function Init() {

        if (JSON.parse(localStorage.getItem("shopcart"))) {
            arrayCart = JSON.parse(localStorage.getItem("shopcart"));
            cantidades = sumarCantidades(arrayCart);
            total_cart = sumarPrecios(arrayCart);
            document.querySelector("#amounts_label").innerHTML = cantidades;
            document.querySelector("#total_label").innerHTML = 'Total:' + total_cart + ' COP';
            generateItemCart();
        } else {
            arrayCart = [];
        }
        //funciones
        stopPropagationCart();
    }



    function stopPropagationCart() {
        const form = document.querySelector('#cart_template');
        form.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

    function increase_amount(s) {
        for (let i = 0; i < arrayCart.length; i++) {
            if (arrayCart[i].id === s.toString()) { // Reemplaza "id" con el nombre de la propiedad que tiene el valor único
                arrayCart[i].cantidad++;
                generateItemCart();
                break;
            }
        }
    }


    function addtocart(id = "", precio = "", titulo = "", ext = "") {

        let index = arrayCart.findIndex(function(obj) {
            return obj.id === id;
        });
        if (index != -1) {
            arrayCart[index].ext = ext;
            arrayCart[index].cantidad++;
        } else {
            arrayCart.push({
                id: id,
                cantidad: 1,
                precio: precio,
                titulo: titulo,
                ext: ext,
            })
        }

        generateItemCart();

    }

    function sumarPrecios(array) {
        let total = 0;
        for (let i = 0; i < array.length; i++) {
            total += parseInt(array[i].precio) * parseInt(array[i].cantidad);
        }
        return total;
    }

    function restarCantidad(id) {
        const index = arrayCart.findIndex(objeto => objeto.id === id.toString());
        arrayCart[index].cantidad--;

        if (arrayCart[index].cantidad > 0) {
            generateItemCart();


        } else {
            DropItemCart(arrayCart[index].id);
        }

        // console.log(`Se ha restado una unidad del objeto con ID ${id}. Cantidad actual: ${arrayCart[index].cantidad}`);
    }


    function sumarCantidades(array) {
        let suma = 0;
        for (let i = 0; i < array.length; i++) {
            suma += array[i].cantidad;
        }
        return suma;
    }

    function generateItemCart() {
        localStorage.setItem("shopcart", JSON.stringify(arrayCart));
        total_cart = sumarPrecios(arrayCart);
        cantidades = sumarCantidades(arrayCart);
        document.querySelector("#amounts_label").innerHTML = cantidades;
        document.querySelector("#total_label").innerHTML = 'Total:' + total_cart + ' COP';
        cart_template.innerHTML = "";
        arrayCart.forEach(elemento => {
            cart_template.innerHTML += `<div class="dropdown-item d-flex p-4">
                    <span class="avatar avatar-xl br-5 me-3 align-self-center cover-image" data-bs-image-src="${(elemento.ext!=null && elemento.ext!= undefined && elemento.ext != "") ? 'storage/productos/'+elemento.id+elemento.ext : "/assets/images/pngs/4.jpg"}" style="background: url(${(elemento.ext!=null && elemento.ext!= undefined && elemento.ext != "") ? 'storage/productos/'+elemento.id+elemento.ext : '/assets/images/pngs/4.jpg'});"></span>
                    <div class="wd-50p">
                        <h5 class="mb-1">${elemento.titulo}</h5>
                        <p class="fs-13 text-muted mb-0">Cantidad:${elemento.cantidad} </p>
                        <a href="javascript:void(0)"  class="btn btn-primary btn-sm button-minus-cart" onclick="increase_amount(${elemento.id})" > <i class="fe fe-plus "></i></a>
                        <a href="javascript:void(0)"  class="btn btn-primary btn-sm button-minus-cart" onclick="restarCantidad(${elemento.id})" > <i class="fe fe-minus "></i></a>

                    </div>
                    <div class="ms-auto text-end d-flex fs-16">
                        <span class="fs-16 text-dark d-none d-sm-block px-4">
                        ${elemento.precio}
                        </span>
                        <a href="javascript:void(0)"  class="fs-16 btn p-0 cart-trash">
                            <i  onclick='DropItemCart(${elemento.id})' class="fe fe-trash-2 border text-danger brround d-block p-2"></i>

                        </a >
                    </div>
                </div>`
        });

    }

    function DropItemCart(s) {
        for (let i = 0; i < arrayCart.length; i++) {
            if (arrayCart[i].id === s.toString()) { // Reemplaza "id" con el nombre de la propiedad que tiene el valor único
                arrayCart.splice(i, 1);
                break;
            }
        }
        generateItemCart();
    }
</script>