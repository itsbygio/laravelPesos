@extends('layouts.modepublic')

@section('modepublic')
<div class="main-container container-fluid mt-5">

    <div class="row">
        <div class="col-xl-2">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Categorias</div>
                    <button class="btn btn-link d-xl-none" type="button" data-toggle="collapse" data-target="#cardBody" aria-expanded="false" aria-controls="cardBody">
                        <i class="fe fe-chevron-down"></i>
                    </button>
                </div>
                <div class="card-body collapse show" id="cardBody">
                    <ul class="list-group">
                        @foreach($categorias as $categoria)
                        <li style="cursor:pointer" class="list-group-item border-0 mb-4 p-0"> <a wire:click="searchcategorias('{{$categoria->id}}')"><i class="fe fe-chevron-right"></i> {{$categoria->titulo}} </a><!--<span class="product-label">22</span>!--> </li>
                        @endforeach
                        <li style="cursor:pointer" class="list-group-item border-0 mb-4 p-0"> <a wire:click="resetAll()"><i class="fe fe-chevron-right"></i> Todos </a><!--<span class="product-label">22</span>!--> </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-10">

            <div class="row">
                <div class="card p-0">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="input-group d-flex w-100 float-start">
                                    <input  type="text" class="form-control border-end-0 my-2" placeholder="Buscar producto">
                                    <button class="btn input-group-text bg-transparent border-start-0 text-muted my-2">
                                        <i class="fe fe-search text-muted" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($productos->count())
                @foreach($productos as $producto)

                <div class="col-md-3 col-xl-3 col-sm-6 col-xs-6">
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
                                    <img class="img-fluid br-7 w-100" src="@isset($producto->ext)/storage/productos/{{$producto->id}}{{$producto->ext}} @else /assets/images/pngs/9.jpg @endisset" alt="img">
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
                                <!-- <button type="button" onclick="addtocart('{{$producto->id}}','{{$producto->precio}}','{{$producto->titulo}}','{{$producto->ext}}')" class="btn btn-primary mb-1"><i class="fe fe-shopping-cart mx-2"></i> Al Carrito</button> -->
                                <a href="/producto/{{$producto->uri_producto}}" class="btn btn-primary y mb-1"><i class="fe fe-heart mx-2 wishlist-icon"></i>Ver Producto</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @endif

            </div>
            <div class="row">
                <div class="col-xl-12">
                    {{ $productos->links() }}

                </div>
            </div>


        </div>

    </div>

</div>

@endsection