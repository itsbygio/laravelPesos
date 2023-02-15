<div>
    <div class="row">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-xl-5 col-lg-8 col-md-8 col-sm-8">
                    <div class="input-group d-flex w-100 float-start">
                        <input type="text" class="form-control border-end-0 my-2" placeholder="Buscar producto">
                        <button class="btn input-group-text bg-transparent border-start-0 text-muted my-2">
                            <i class="fe fe-search text-muted" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
    @foreach($productos as $producto)

        <div class="col-md-3 col-xl-3 col-sm-6">
            <div class="card">
                <div class="product-grid6">
                    <div class="product-image6 p-5">
                        <!-- <ul class="icons">
                            <li>
                                <a href="shop-description.html" class="btn btn-primary"> <i class="fe fe-eye"> </i> </a>
                            </li>
                            <li><a href="add-product.html" class="btn btn-success"><i class="fe fe-edit"></i></a></li>
                            <li><a href="javascript:void(0)" class="btn btn-danger"><i class="fe fe-x"></i></a></li>
                        </ul> -->
                        <a href="shop-description.html">
                            <img class="img-fluid br-7 w-100" src="/storage/productos/{{$producto->id}}{{$producto->ext}}" alt="img">
                        </a>
                    </div>
                    <div class="card-body pt-0">
                        <div class="product-content text-center">
                            <h1 class="title fw-bold fs-20"><a href="shop-description.html">{{$producto->titulo}}</a></h1>
                            <!-- <div class="mb-2 text-warning">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star-half-o text-warning"></i>
                                <i class="fa fa-star-o text-warning"></i>
                            </div> -->
                            <div class="price">{{$producto->precio}} COP <!--<span class="ms-4">$799</span>!-->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="cart.html" class="btn btn-primary mb-1"><i class="fe fe-shopping-cart mx-2"></i> Al Carrito</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>