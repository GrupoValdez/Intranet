@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite wirhSiteRankikng">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Ranking</h1>
      @include('admin.partials.fields-name-admin-login') 

      <form action="home_submit" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch formSearchRanking" method="get" accept-charset="utf-8">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input id="filtrar" type="text" placeholder="Buscar">
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



{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa secNotifiRanking">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido conteniRanking">
      @if(Session::has('Colocacion_Adp_ranking'))
        <p class="alert alert-success">{{Session::get('Colocacion_Adp_ranking')}}</p>
      @endif
    
     {{-- rankings --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloquesRankins">
        {{-- Bloque Subtitles sections --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueactionsTitles">
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3>Todos los contatos (50)</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <h3>Ranking</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <h3>ADP</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
            <h3>Edición</h3>
          </div>
        </div>
        {{-- END Bloque Subtitles sections --}}

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueUserRankings">
          @foreach($JoinTableUserDatosPersonalesDatosEmpleado as $usersRanking)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DataUserRankings AlluserRankinSearch">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueactionsRankingsSz ranlingSty">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 UserImgData">
                  <div class="label dataPrubeIm dataProfileAllUsersRanking" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $usersRanking->foto }}')"></div>
                  <p class="fontMiriamProSemiBold">{{ $usersRanking->nombre }} {{ $usersRanking->apellidos }}</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 starRankin">
                  @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                    @if($usersRanking->id_usuario == $valueRankingGeneral['id_user'])
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
                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 CountADP">
                  <p class="gasper">{{ $totalAdps = 0}}</p>
                  @foreach($HistoryAdps as $adpsColocadas)
                    @if($usersRanking->id_usuario == $adpsColocadas->id_usuario)
                     <p class="gasper">{{ $totalAdps = $totalAdps+1 }}</p>
                    @endif
                  @endforeach
                  <h3>{{ $totalAdps }}</h3>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 editionAction">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 editerRabling">
                    <form action="ranking_adp" method="post" accept-charset="utf-8">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_id_usuario" value="{{ $usersRanking->id_usuario }}">
                      <select name="id_adp">
                        <option value="Colocar ADP">Colocar ADP</option>
                        @foreach($AllAdps as $adps)
                          @if($adps->tipo_adp != 'Llegadas tarde')
                            <option value="{{ $adps->id }}">{{ $adps->tipo_adp }}</option>
                          @endif
                        @endforeach
                      </select>
                      <input type="submit" value="Aceptar">
                    </form>                  
                  </div>
                </div>
              </div>
          </div>
          @endforeach
      </div>

      {{-- end section rankings --}}
      

    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">

    </div>
  </div>
</section>
  <div class="col-md-12 datPublich publishChatAdmin publishRanking">
    <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/addpubliImgae.png" alt="" data-toggle="modal" data-target="#myModal">
    <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/AnuncioPublicAdmin.png" alt=""  data-toggle="modal" data-target="#myModalNotifications">
  </div>

  <!-- Modal -->
  @include('usuarios.partials.field-public-post')

  <!-- Modal NOTIFICACIONES -->
  @include('admin.partials.fields-modal-notificaciones')
  
  <div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  

  
@endsection
