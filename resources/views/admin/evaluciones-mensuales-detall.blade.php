@extends('layouts.Template-admin-edit-users')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Evaluaciones mensuales</h1>

      <form action="home_submit" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="get" accept-charset="utf-8">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" placeholder="Buscar">
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


{{-- SECTION EVALUCIONES ALL FOR AREA --}}
<section class="container-fluid sectionAdminNotifiMensa">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    @if(Session::has('Create_notify'))
      <p class="alert alert-success">{{Session::get('Create_notify')}}</p>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 OtherUserEdit lateEdiEvalution">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido sectionCenEdituse sectionEvalutionUSer evaluationDetyasll">
      {{-- ALL AREAS detall --}}
      @foreach($EncargadosOfAreas as $encargado)
        <h3>Área de {{ $encargado->area }}</h3>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 typeEncargado">
          <h3>Encargado de área</h3>
          @foreach($UsersAlls as $users)
            @if($encargado->id_encargardo == $users->id_usuario)
              <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 detallImgProfile">
                <div class="label dataPrubeIm dataProfileEvaluacionesDetall" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $users->foto }}')"></div>        
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 detallNameProfile">
                <p class="colorBlack fontMiriamProSemiBold">{{ $users->nombre }} {{ $users->apellidos }}</p>
                @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                  @if($users->id_usuario == $valueRankingGeneral['id_user'])
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
            @endif
          @endforeach           
        </div>

      @endforeach
      
      @foreach($UsersEvaluacion as $UserEvalua)
        <form action="../../send_evaluacion" method="post" accept-charset="utf-8" class="formEvaliuacion">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">  
          <input type="hidden" name="_idencargado" value="{{ $idEncargado }}">  
          <input type="hidden" name="_iduser" value="{{ $idUserEvaluacion }}">  
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 EvaluationPersonal evaluationDetallQuestion">
             <h3>Evaluación de: <span>{{ $UserEvalua->nombre }} {{ $UserEvalua->apellidos }} </span> </h3>

             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ProfileFotosStarts profilesForDetall roflDetallAd">
               <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 detallImgProfile">
                 <div class="label dataPrubeIm dataProfileEvaluacionesDetallEvaluando" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $UserEvalua->foto }}')"></div>        
               </div> 
               <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 detallNameProfile">
                 <p class="colorBlack fontMiriamProSemiBold">{{ $UserEvalua->nombre }} {{ $UserEvalua->apellidos }}</p>
                 @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                   @if($UserEvalua->id_usuario == $valueRankingGeneral['id_user'])
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
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textConesta TitleLISt">
                   <p>Contesta según nivel de desempeño, siendo malo el peor y excelente el mejor</p>    
               </div> 
               @include('admin.partials.preguntas-evaluacion') 

             </div>
          </div>
        </form>
        
      @endforeach
      
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
