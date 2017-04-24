@extends('layouts.Template-admin-history')

@section('content')

{{-- SECTION MENU INTERNO HOME --}}
<section class="container-fluid containernavNotifis">
  <nav class="navbar navbar-default navbar-static-top navbarHome BgYellow BgHistiry">
      <div class="container">
          <div class="navbar-header">

              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <!-- Branding Image -->
              {{-- <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
              </a> --}}
          </div>

          <div class="collapse navbar-collapse collapseMenuUser" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <img class="paletaAdminBoard" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/ico-paleta.png" alt="Paleta-Colores">
              <ul class="centerNameUserMenu">
                  <li class="colorBlack fontMiriamProRegular">Historial de entrada y salidas</li>
              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right navulRIght">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ url('/login') }}">Login</a></li>
                      <li><a href="{{ url('/register') }}">Register</a></li>
                  @else
                      <li class="icosMenus">
                          <a href="#!">
                              <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/homeNotifiAdmin.png" class="img-responsive" alt="">                                    
                          </a>
                      </li>
                      <div class="ui dropdown dropdownSemantic notifiICos fontMiriamProRegular">
                        <a href="#!">
                            <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/campaniNotifiAdmin.png" class="img-responsive" alt="">
                            <div class="notifiCount">
                              @include('admin.partials.fields-history-notificaciones-cantidad')
                            </div>
                        </a>
                        <div class="menu">
                          @include('admin.partials.fields-history-notificaciones-board')
                        </div>
                      </div>
                      <li class="dropdown uSerLogue colorBlackSuave fontMiriamProRegular">
                          <a href="#" class="dropdown-toggle colorBlackSuave datUsesSa" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="{{ url('/logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                  @endif
              </ul>
          </div>
      </div>
  </nav>
</section>


{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa sectionPostDats">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 HistiResultUser">
    @foreach($UsersAlls as $DataUser)
      <h1>{{ $DataUser->nombre }} {{ $DataUser->apellidos }}</h1>
    @endforeach
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 RegistroFechas">
      <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 registerDays">
        <h3>Registro de</h3>
        <div class="datasEntradasSalidas">
          <h4>Entrada</h4>
          <h4>Salida</h4>          
        </div>
      </div>

      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 carouselhistirys">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
       
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              {{-- Obtenniendo la hora de entrada y salida del dia actual --}}
              @if($DataHistoryHoy >0)
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 registerDays">
                  <h3>Día de hoy</h3>
                  <div class="datasEntradasSalidas">
                    @if($DataHistoryHoy['hora_entrada'] < '12:00')
                      <h4>{{ $DataHistoryHoy['hora_entrada'] }} a.m.</h4>
                    @else
                     <h4>{{ $DataHistoryHoy['hora_entrada'] }} p.m.</h4>
                    @endif
                    
                    @if($DataHistoryHoy['hora_salida'] != null)
                      @if($DataHistoryHoy['hora_salida'] < '12:00')
                        <h4>{{ $DataHistoryHoy['hora_salida'] }} a.m.</h4>
                      @else
                       <h4>{{ $DataHistoryHoy['hora_salida'] }} p.m.</h4>
                      @endif 
                    @else
                      <h4>----</h4>
                    @endif                    
                  </div>
                </div>
              @else
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 registerDays">
                  <h3>Día de hoy</h3>
                  <div class="datasEntradasSalidas">
                    <h4>----</h4>
                    <h4>----</h4>
                  </div>
                </div>
              @endif

             {{-- Obtenniendo el historial de llegadas del usuario --}}
             <p class="gasper"> {{ $banderiHistory = 0}}</p>
             @foreach($AsistenciasAll as $asisAll)
               <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
               <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p> 
               @if($asisAll->fecha != $fechaActual)
                 @if($banderiHistory < 5)
                  <p class="gasper"> {{ $banderiHistory = $banderiHistory+1}}</p>
                  <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 registerDays">
                    <h3>{{ $asisAll->fecha }}</h3>
                    <div class="datasEntradasSalidas">
                      @if($asisAll->hora_entrada < '12:00')
                        <h4>{{ $asisAll->hora_entrada }} a.m.</h4>
                      @else
                       <h4>{{ $asisAll->hora_entrada }} p.m.</h4>
                      @endif
                      @if($asisAll->hora_salida < '12:00')
                         <h4>{{ $asisAll->hora_salida }} a.m.</h4>
                      @else
                        <h4>{{ $asisAll->hora_salida }} p.m.</h4>
                      @endif 
                    </div>
                  </div>
                  @elseif($banderiHistory == 5)
                    </div>
                    <p class="gasper"> {{ $banderiHistory = 0}}</p>
                    <div class="item">
                      <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 registerDays">
                        <h3>{{ $asisAll->fecha }}</h3>
                        <div class="datasEntradasSalidas">
                          @if($asisAll->hora_entrada < '12:00')
                            <h4>{{ $asisAll->hora_entrada }} a.m.</h4>
                          @else
                           <h4>{{ $asisAll->hora_entrada }} p.m.</h4>
                          @endif
                          @if($asisAll->hora_salida < '12:00')
                             <h4>{{ $asisAll->hora_salida }} a.m.</h4>
                          @else
                            <h4>{{ $asisAll->hora_salida }} p.m.</h4>
                          @endif 
                        </div>
                      </div>
                  @endif

               @endif
               
              @endforeach
              
              
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control controlsHistirys" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control controlsHistirys" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
  
@endsection
