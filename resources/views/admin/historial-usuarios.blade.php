@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite wirhSiteRankikng">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Historial de llegadas</h1>
      @include('admin.partials.fields-name-admin-login') 

      <form action="home_submit" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch formSearchRanking" method="get" accept-charset="utf-8">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input id="filtrarHistory" type="text" placeholder="Buscar">
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

     {{-- rankings --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloquesRankins">
        {{-- Bloque Subtitles sections --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueactionsTitles">
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3>Todos los contatos (50)</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3>Hora de entrada</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3>Hora de salida</h3>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3>Ranking</h3>
          </div>
        </div>
        {{-- END Bloque Subtitles sections --}}

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueUserRankings">
        
        @foreach($Asistencias as $asis)
          @foreach($UsersAlls as $datos)
            @if($asis->id_usuario == $datos->id_usuario)
              @foreach($arrayLosHorariosOfUser as $UserHorarios)
                @if($datos->id_usuario == $UserHorarios['id_user_h'])

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DataUserRankings DataUserRankingsHistory dataHitorySear">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueactionsRankingsSz searchHis">
                      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 UserImgData">
                        <div class="label dataPrubeIm dataProfileHistory" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datos->foto }}')">
                        </div>
                        {{-- <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                        <p class="fontMiriamProSemiBold nameUSerHisroty">{{ $datos->nombre }} {{ $datos->apellidos }}</p>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 horaEntrada">                        
                        @include('admin.partials.fields-horarios-entrada')
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 CountADP horaSalida">
                        @include('admin.partials.fields-horarios-salida')
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 starRankinHistiry">
                        @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                          @if($datos->id_usuario == $valueRankingGeneral['id_user'])
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
                        <div class="dropdown drowOptionHistriaul">
                          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li class="selecEdit">
                              <a href="history/{{ $datos->id_usuario }}">Ver historial</a>        
                              <a href="chat">Enviar mensaje</a>        
                            </li>
                          </ul>          
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
                    
                  @endforeach --}}
                @endif
              @endforeach
            @endif
            
          @endforeach
        @endforeach
        
        
          
        
        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DataUserRankings DataUserRankingsHistory">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueactionsRankingsSz">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 UserImgData">
              <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/profile-user-circle.png" alt="">
              <p class="fontMiriamProSemiBold">Lissette Rivas</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 horaEntrada">
              <p>8:50 a.m.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 CountADP horaSalida">
              <h3 class="horaSalidaAntes">6:00 p.m.</h3>
              <p class="coloADP">Colocar ADP</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 starRankinHistiry">
              <div class="ui star rating" data-rating="5"></div>
              <div class="dropdown drowOptionHistriaul">
                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                  <li class="selecEdit">
                    <a href="#!">Ver historial</a>        
                    <a href="#!">Enviar mensaje</a>        
                  </li>
                </ul>          
              </div>
            </div>
          </div>
        </div>
         -->


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

  @if(Session::has('Colocacion_Adp'))

    <!-- Modal -->
    <div class="modal fade" id="myModalSolicitudRespuestCorrect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog contAcotionModlas" role="document">
        <div class="modal-content">
          <div class="modal-body captionBodySolicRespuesa">
            <div class="col-xs-12 col-sm-12 col-md-12 contRevibeSOlic">
              <div class="col-xs-12 col-sm-12 col-md-12 clAdpsCLo">
                @foreach(Session::get('Colocacion_Adp') as $DataUserAdp)
                  <h5 class="aceptSol">La acción de personal fue colocado exitosamente a:</h5>
                  <div class="captionEvulveImg" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $DataUserAdp->foto }}')">              
                  </div>
                   <h4 class="nameSoliUser">{{ $DataUserAdp->nombre }} {{ $DataUserAdp->apellidos }}</h4>
                @endforeach                
                <p class="Aceptado" data-dismiss="modal">Aceptar</p>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
  
  
  
@endsection
