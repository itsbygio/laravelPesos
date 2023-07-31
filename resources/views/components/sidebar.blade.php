
<div class="sticky">
 
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header active " >
            <a class="header-brand1" href="index.html">
                 
            <img src="../assets/images/brand/sercolf.png" alt="logo" width="110" height="60">
            </a>
            <!-- LOGO -->   
        </div>
        
        <div class="main-sidemenu is-expanded">

            <div class="slide-left disabled active" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg></div>
                
            <ul class="side-menu open" style="margin-right: 0px; margin-left: 0px;">
                @if( Auth::user()->rol=='SuperAdmin' )
              <li class="sub-category  mt-3">
                    <h3 class="mt-5">Usuarios</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/administrar/usuarios"><i class="side-menu__icon  fa fa-circle-o"></i><span class="side-menu__label">Administrar Usuarios</span></a>
                </li>
                @endif
                @if( Auth::user()->rol=='SuperAdmin' || Auth::user()->rol=='Admin')
                <li class="sub-category  mt-3">
                    <h3 class="mt-5">Productos</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/administrar/productos"><i class="side-menu__icon  fa fa-circle-o"></i><span class="side-menu__label">Administrar Productos</span></a>
                </li>
                <li class="sub-category">
                    <h3>Categorias</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/administrar/categorias"><i class="side-menu__icon  fa fa-circle-o"></i><span class="side-menu__label">Administrar Categorias</span></a>
                </li>
                @endif  
                @if( Auth::user()->rol=='SuperAdmin' || Auth::user()->rol=='Admin'|| Auth::user()->rol=='Fact')
                <li class="sub-category">
                    <h3>Ventas</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/add/ventas"><i class="side-menu__icon  fa fa-circle-o"></i><span class="side-menu__label">Administrar Ventas</span></a>
                   
                </li>
            </ul>
            @endif
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </div>
    </div>
    