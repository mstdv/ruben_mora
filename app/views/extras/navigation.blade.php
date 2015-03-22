<div class="mainnav">

    @if(Auth::user()->rol == 1)
    <ul>
        <li>
            <a href="#"><span class="icon16 icomoon-icon-cog"></span>Configuracion</a>
            <ul class="sub">
                <li><a href="{{URL::to('/configs')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Valores de agencia
                </a></li>
               <li>
                    <a href="{{URL::to('/admin-usuarios')}}">
                        <span class="icon16 icomoon-icon-arrow-right-3"></span>Gestion de usuarios
                    </a>
                </li>

                <li>
                    <a href="{{URL::to('/limites')}}">
                        <span class="icon16 icomoon-icon-arrow-right-3"></span>Limites
                    </a>
                </li>

                <li>
                    <a href="{{URL::to('/restriccions')}}">
                        <span class="icon16 icomoon-icon-arrow-right-3"></span>Restricciones
                    </a>
                </li>

            </ul>
        </li>

        <li>
            <a href="#"><span class="icon16 icomoon-icon-table-2"></span>Gestion de juegos</a>
            <ul class="sub">
                <li><a href="{{URL::to('/equipos-ligas')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Dep., ligas y equipos
                </a></li>
                <li><a href="{{URL::to('/logros')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Logros
                </a></li>
                <li><a href="{{URL::to('/resultados')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Resultados
                </a></li>
                <li><a href=""><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Cierre Diario
                </a></li>

            </ul>
        </li>
        <li>
            <a href="{{URL::to('/mensajes')}}">
                <span class="icon16 icomoon-icon-mail-2"></span>
                Mensaje
            </a>
        </li>
    </ul>




    <div class="sidebar-widget">
        <h5 class="title">Estadisticas rapidas</h5>
        <div class="content">

            <div class="stats">
                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Usuarios</div>
                    </div>
                    <span class="icon16 icomoon-icon-users left"></span>
                    <div class="number">{{User::count()}}</div>
                </div>

                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Pitchers</div>
                    </div>
                    <span class="icon16 brocco-icon-stats left"></span>
                    <div class="number">{{Pitcher::count()}}</div>
                </div>

                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Deportes</div>
                    </div>
                    <span class="icon16 brocco-icon-stats left"></span>
                    <div class="number">{{Deporte::count()}}</div>
                </div>

                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Ligas</div>
                    </div>
                    <span class="icon16 brocco-icon-stats left"></span>
                    <div class="number">{{Liga::count()}}</div>
                </div>

                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Equipos</div>
                    </div>
                    <span class="icon16 brocco-icon-stats left"></span>
                    <div class="number">{{Equipo::count()}}</div>
                </div>

                <div class="item">
                    <div class="head clearfix">
                        <div class="txt">Logros</div>
                    </div>
                    <span class="icon16 icomoon-icon-trophy-star left"></span>
                    <div class="number">{{Logro::count()}}</div>
                </div>

            </div>

        </div>

    </div><!-- End .sidenav-widget -->

    @elseif(Auth::user()->rol == 2)

    <ul>
       <li>
            <a href="#"><span class="icon16 icomoon-icon-profile"></span>Mi cuenta</a>
            <ul class="sub">
                <li><a href="{{URL::to('/users/info/'.Auth::user()->id)}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Informacion
                </a></li>
            </ul>
        </li>

        <li>
            <a href="/gastos">
                <span class="icon16 icomoon-icon-queen"></span>
                Gastos de Taquillas
            </a>
        <li>
        </li>
        <li>
            <a href="{{URL::to('/mensajes')}}">
                <span class="icon16 icomoon-icon-mail-2"></span>
                Mensaje
            </a>
        </li>

    </ul>

    @elseif(Auth::user()->rol == 3)

    <ul>
       <li>
            <a href="#"><span class="icon16 icomoon-icon-profile"></span>Mi cuenta</a>
            <ul class="sub">
                <li><a href="{{URL::to('/users/info/'.Auth::user()->id)}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Informacion
                </a></li>

                <li><a href="{{URL::to('/users/limite/'.Auth::user()->id)}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Mis limites
                </a></li>
            </ul>
        </li>

        <li>
            <a href="#"><span class="icon16 icomoon-icon-queen"></span>Apuestas</a>
            <ul class="sub">
                <li><a href="{{URL::to('/apuestas/create')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Apostar
                </a></li>

                <li><a href="{{URL::to('/ventas')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Ventas
                </a></li>

                <li><a href="{{URL::to('/tikets')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Tikets
                </a></li>
                <li><a href="{{URL::to('/configs')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Pagar Tikets
                </a></li>
                <li><a href="{{URL::to('/configs')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Anular Tikets
                </a></li>
                <li><a href="{{URL::to('/configs')}}"><span class="icon16 icomoon-icon-arrow-right-3"></span>
                    Reportar Tikets
                </a></li>
                <li>
                    <a href="{{URL::to('/gastos')}}">
                        <span class="icon16 icomoon-icon-arrow-right-3"></span>
                        Gastos de Taquilla
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{URL::to('/mensajes')}}">
                <span class="icon16 icomoon-icon-mail-2"></span>
                Mensaje
            </a>
        </li>

    </ul>

    @endif

</div>

