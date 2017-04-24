@extends('layouts.Template-admin')

@section('content')

{{-- SECTION MENU INTERNO HOME --}}
<section class="container-fluid">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionMenuInterno menuInernoBoard">
    <ul>
        <li><a href="">Home</a></li>
        <li class="active"><a href="">Board</a></li>
        <li><a href="">Usuarios</a></li>
    </ul>
  </div>
</section>
<section class="container-fluid containernavNotifis">
  <nav class="navbar navbar-default navbar-static-top navbarHome BgYellow">
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
                  <li class="colorBlack fontMiriamProRegular">¡Hola! {{ Auth::user()->name }}</li>
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
                          <a href="#" class="dropdown-toggle colorBlackSuave" data-toggle="dropdown" role="button" aria-expanded="false">
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

<div class="col-xs-12 col-sm-12 notifisMobile">
  <!-- Right Side Of Navbar -->
  <ul class="nav navbar-nav navbar-right navulRIght">
      <!-- Authentication Links -->
      @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
      @else
          <li class="icosMenus">
              <a href="#!">
                  <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/house-ido.png" class="img-responsive" alt="">                                    
              </a>
          </li>
          <div class="ui dropdown dropdownSemantic notifiICos fontMiriamProRegular">
            <a href="#!">
                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/notify-ico.png" class="img-responsive" alt="">
                <div class="notifiCount">
                    @include('admin.partials.fields-history-notificaciones-cantidad')
                </div>
            </a>
            <div class="menu">
              @include('admin.partials.fields-history-notificaciones-board')
            </div>
          </div>
      @endif
  </ul>
  
</div>

<div class="col-xs-12 col-sm-12 col-md-12 captionRecientesMobie">
  @include('admin.partials.fields-history-notificaciones-board')
</div>


{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa sectionPostDats">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionBoard">
     <div class="container continerWithSite">
         <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 captionPosteos">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                @foreach($DataArrayPostImpar as $dataArrPostImpar => $PostImpar)
                  @if($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['imagen'] != '')
                    @include('usuarios.partials.posts.fields-tipo-posnormal-impar')

                    {{-- @elseif($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['documentos'] != '')
                      @include('usuarios.partials.posts.fields-tipo-posnormal-impar-with-document-impar')
                      
                      
                    @elseif($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['imagen'] == '' && $PostImpar['documentos'] == '')
                     @include('usuarios.partials.posts.fields-tipo-posnormal-impar-with-document-imagen-impar') --}}
                    
                  {{-- Si el post es tipo vacaciones --}}
                  @elseif($PostImpar['id_tipo_publicacion'] == 4)
                    @include('usuarios.partials.posts.fields-tipo-vacaciones-impar')
                    
                    {{-- Si el post es tipo EVENTO --}}
                    @elseif($PostImpar['id_tipo_publicacion'] == 6)
                      @include('usuarios.partials.posts.fields-tipo-Eventos-IMPAR')

                  @elseif($PostImpar['id_tipo_publicacion'] == 5)
                    @include('usuarios.partials.posts.fields-tipo-cumple-impar')
                      
                  @endif
                @endforeach
              </div>

              {{-- BLOQUE LATERAL --}}
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                @foreach($DataArrayPostPar as $dataArrPostPar => $PostPar)
                  @if($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['imagen'] != '')
                    @include('usuarios.partials.posts.fields-tipo-posnormal-PAR')

                   {{--  @elseif($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['documentos'] != '')
                      @include('usuarios.partials.posts.fields-tipo-posnormal-par-with-document-PAR')

                    @elseif($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['imagen'] == '' && $PostPar['documentos'] == '')
                      @include('usuarios.partials.posts.fields-tipo-posnormal-par-with-document-imagen-PAR') --}}
                      
                  {{-- Si el post es tipo vacaciones --}}
                  @elseif($PostPar['id_tipo_publicacion'] == 4)
                    @include('usuarios.partials.posts.fields-tipo-vacaciones-PAR')
                    
                  {{-- Si el post es tipo EVENTO --}}
                  @elseif($PostPar['id_tipo_publicacion'] == 6)
                    @include('usuarios.partials.posts.fields-tipo-Eventos-PAR')

                  @elseif($PostPar['id_tipo_publicacion'] == 5)
                    @include('usuarios.partials.posts.fields-tipo-cumple-PAR')
                  @endif
                @endforeach
              </div>

           </div>

           <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 captionRecordNotas">
             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bloqueRecordatorios">
               <h1 class="fontMiriamProRegular">Recordatorios</h1> 
               <div class="captionAvisos">
                 <h1 class="fontMiriamProSemiBold">Avisos</h1>
                 <p class="fontMiriamProRegular">Oportunidad de empleo para asesores. Interesados contactarse con Lic. Marta Hercúles</p>
               </div>
               <div class="captionPromos">
                 <p class="fontMiriamProSemiBold">Promociones de hoy</p>
                 <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/promo-public.jpg">
                 <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/promo-public.jpg">
               </div>

               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionPublichIcos publichBoard">
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">          
                   <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/AnuncioPublicAdmin.png" alt="">
                 </div>
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/addpubliImgae.png" alt="" data-toggle="modal" data-target="#myModal">
                 </div>
               </div>

             </div>
             
           </div>
         </div>

         </div>

         <!-- Modal -->
         @include('usuarios.partials.field-public-post')
     </div>

    </div>

  </div>
</section>

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  
@endsection
