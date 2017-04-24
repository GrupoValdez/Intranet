@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>@if($totalUsers>1) {{ $totalUsers }} Usuarios @else {{ $totalUsers }} Usuario @endif</h1>
      @include('admin.partials.fields-name-admin-login')

      <form action="home_submit" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="get" accept-charset="utf-8">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input id="filtrarUser" type="text" placeholder="Buscar usuario">
        </div>
      </form>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <ul class="nav navbar-nav navbar-right navulRIght">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
          @else
            <li>
               <a href="{{ url('/logout') }}"
                 onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                 Salir
               </a>
               <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
             </li>
          @endif
      </ul>
    </div>
  </div>
</div>

{{-- SECTION MENU INTERNO HOME --}}
<section class="container-fluid">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionMenuInterno">
    <ul class="listActionDocuemntps">
        <li ><a href="home">Home</a></li>
        <li><a href="board">Board</a></li>
        <li class="active"><a href="usuarios">Usuarios</a></li>
        <li class="dreopDocument">
          <div class="dropdown dwropOptionMensgae">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <li class="selecEdit">
                <a href="#!">Seleccionar y editar</a>        
              </li>
            </ul>          
          </div>
        </li>
        <li class="GetGroup">
          <form action="usuarios/grupos/edit" method="post" accept-charset="utf-8" class="formSelectGropu">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
            <input type="submit" value="Editar usuarios seleccionados">
          </form>
        </li>
    </ul>
  </div>
</section>


{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido centerContentAllUSer">
      @if(Session::has('Create_Estado'))
        <p class="alert alert-success">{{Session::get('Create_Estado')}}</p>
      @endif
     {{-- Users --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueUsersAll">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 allDatasUserTitles">
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 ">
            <p>Todos los contatos <span>(50)</span> </p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <p>Correo</p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">
            <p>Celular</p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">
            <p>Ext.</p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <p>Ranking</p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">
            <p>ADP</p>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">
            <p>Nota</p>
          </div>
        </div>

        {{-- DATAS OF USERS --}}
        
        @foreach($JoinTableUserDatosPersonalesDatosEmpleado as $UserDatosPersonales)
          @if($UserDatosPersonales->estado == 1)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataAllUserSer">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 allDatasUser">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 imgAndNameUser">
                  <div class="dropdown DropOptinUsersD optionAllUsers">
                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                      <li>
                        <a href="usuarios/edit/{{ $UserDatosPersonales->id_usuario }}">Editar información</a>        
                      </li>
                      <li>
                        <a href="usuarios/editHorario/{{ $UserDatosPersonales->id_usuario }}">Editar horario</a>        
                      </li>
                      <li>
                        <form action="Desactive_Users" method="post" accept-charset="utf-8" class="removeUsers">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                          <input type="hidden" name='ide_user' value="{{ $UserDatosPersonales->id_usuario }}">
                          <input type="submit" value="Eliminar">
                        </form>         
                      </li>
                    </ul>          
                  </div>
                  <input type="checkbox" class="datSelectEdit"  value="{{ $UserDatosPersonales->id_usuario }}">
                  <div class="label dataPrubeIm dataProfileAllUsers" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $UserDatosPersonales->foto }}')"></div>
                  <p class="fontMiriamProSemiBold">{{ $UserDatosPersonales->nombre }} {{ $UserDatosPersonales->apellidos }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 EmailUser topDatasUser">
                  <p>{{ $UserDatosPersonales->correo_corporativo }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1 CelUsers topDatasUser">
                  <p>{{ $UserDatosPersonales->celular }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1 ExtUsers topDatasUser">
                  <p>{{ $UserDatosPersonales->extencion }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 RankinUsers topDatasUser">
                   @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                     @if($UserDatosPersonales->id_usuario == $valueRankingGeneral['id_user'])
                       @if($valueRankingGeneral['puntosRanking'] <= 15)
                         <div class="ui star rating" data-rating="1"></div>
                       @elseif ($valueRankingGeneral['puntosRanking'] > 15 && $valueRankingGeneral['puntosRanking'] <= 30) 
                         <div class="ui star rating" data-rating="2"></div>
                       @elseif ($valueRankingGeneral['puntosRanking'] > 30 && $valueRankingGeneral['puntosRanking'] <= 45) 
                         <div class="ui star rating" data-rating="3"></div>
                       @elseif ($valueRankingGeneral['puntosRanking'] > 45 && $valueRankingGeneral['puntosRanking'] < 75) 
                         <div class="ui star rating" data-rating="4"></div>
                       @elseif ($valueRankingGeneral['puntosRanking'] >= 75) 
                         <div class="ui star rating" data-rating="5"></div>
                       @endif
                     @endif
                   @endforeach
                </div>
                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1 AdpUsers topDatasUser">
                  <p class="gasper">{{ $totalAdps = 0}}</p>
                  @foreach($HistoryAdps as $adpsColocadas)
                    @if($UserDatosPersonales->id_usuario == $adpsColocadas->id_usuario)
                     <p class="gasper">{{ $totalAdps = $totalAdps+1 }}</p>
                    @endif
                  @endforeach
                  <p>{{ $totalAdps }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1 NotUses topDatasUser">
                  <p class="gasper"> {{ $verifiEvaluciaon = 0 }}</p>
                  @foreach ($GetEvaluaciones as $keyGetEvaluaciones)
                    @if($keyGetEvaluaciones->id_usuario == $UserDatosPersonales->id_usuario)
                      <p class="gasper">{{ $verifiEvaluciaon = $verifiEvaluciaon+1 }}</p>
                      <p>{{ $keyGetEvaluaciones->total }}</p>
                    @endif
                  @endforeach
                  @if($verifiEvaluciaon == 0)
                      <p>0</p>
                  @endif
                </div>
              </div>
            </div>
            
          @endif
        @endforeach

        
        {{-- END DATAS OF USERS --}}
        
      </div>

      {{-- end section Users --}}
      

    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 actionAllUsers">
      <a href="addUsers">
        <p>
          Nuevo usuario
        </p>
      </a>
      {{-- <a href="">
        <p>
          Editar
        </p>
      </a> --}}
    </div>
    <div class="col-md-12 datPublich publishChatAdmin publichDocuemnts">
      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/addpubliImgae.png" alt="" data-toggle="modal" data-target="#myModal">
      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/AnuncioPublicAdmin.png" alt=""  data-toggle="modal" data-target="#myModalNotifications">
    </div>
  </div>
</section>


<!-- Modal -->
@include('usuarios.partials.field-public-post')

<!-- Modal NOTIFICACIONES -->
@include('admin.partials.fields-modal-notificaciones')


<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  
  
@endsection
