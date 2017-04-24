@extends('layouts.Template-admin-edit-users')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Editar usuario</h1>
      @include('admin.partials.fields-name-admin-login')      
      @include('admin.partials.fields-search-usuarios')

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
<section class="container-fluid sectionAdminNotifiMensa">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
  @if(Session::has('Update_User'))
    <p class="alert alert-success">{{Session::get('Update_User')}}</p>
  @endif

    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 OtherUserEdit">
      @foreach($UsersAlls as $userEdits)
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataForUserdonw">
          <div class="label dataPrubeIm dataProfileEditUsersAlls" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $userEdits->foto }}')"></div>
          <a href="{{ $userEdits->id_usuario }}">
            <p class="fontMiriamProSemiBold">{{ $userEdits->nombre }} {{ $userEdits->apellidos }}</p>
          </a>
        </div>
      @endforeach
      <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataForUserdonw">
        <div class="dropdown dropOtherUsers">
          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dLabel">
            <li>
              <a href="#!">Eliminar</a>        
            </li>
            <li>
              <form action="home_submit" method="get" accept-charset="utf-8" class="removeMensage">
                <input type="submit" value="Mover a">
              </form>         
            </li>
          </ul>          
        </div> 
        <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/profile-user-circle.png" alt="">
        <a href="">
         <p class="fontMiriamProSemiBold">Lissette Rivas</p>            
        </a>
      </div> -->
 
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido sectionCenEdituser">
      
      <form action="{{$id}}/saveEditionHorario" method="post" accept-charset="utf-8" class="formEditUser">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        {{-- BLOCK EDIT USER --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataBloquesForEdit">
          <h3 class="editAs">Editar a</h3>
          @foreach($JoinTableUserDatosPersonalesDatosEmpleado as $DatasUser)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataImgAndranking">
              <input type="hidden" class="idUserEdits" value="{{ $DatasUser->id_usuario }}">
              <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 imgProfiEdit">
                <div class="label dataPrubeIm dataProfileEditUsers" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $DatasUser->foto }}')"></div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-5 col-lg-5 editRankinFoto">
                <h3>{{ $DatasUser->nombre }} {{ $DatasUser->apellidos }} </h3>
                <div class="contEditDatRanking">
                  @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                    @if($DatasUser->id_usuario == $valueRankingGeneral['id_user'])
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
                  {{-- <a href="">Editar ranking</a>               --}}
                </div> 
              </div>
            </div>

         @endforeach
        </div>

        {{-- END BLOCK EDIT USER --}}

        {{-- BLOCK CLOCK --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclock">
          @include('admin.partials.fields-edit-user-horarios-completos')
          @include('admin.partials.fields-edit-user-horarios-mediosdias')
          
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueAddHorarios">
            @foreach($Horarios as $UsserHorsr)
              @if($UsserHorsr->bloq_horario1 != '' && $UsserHorsr->bloq_horario1 != null)
                <input type="hidden" class="repeatBloqOneEdit" name="get_horariosc1" value="{{ $UsserHorsr->bloq_horario1 }}" />
                <input type="hidden" class="repeatBloqOneEditTime" name="get_horariosc1_time" value="{{ $UsserHorsr->bloq_horario1Time }}" />
              @endif
              @if($UsserHorsr->bloq_horario2 != '' && $UsserHorsr->bloq_horario2 != null)
                <input type="hidden" class="repeatBloqOneEdit2" name="get_horariosc2" value="{{ $UsserHorsr->bloq_horario2 }}" />
                <input type="hidden" class="repeatBloqOneEdit2Time" name="get_horariosc2_time"value="{{ $UsserHorsr->bloq_horario2Time }}" />
              @endif
              @if($UsserHorsr->bloq_horario3 != '' && $UsserHorsr->bloq_horario3 != null)
                <input type="hidden" class="repeatBloqOneEdit3" name="get_horariosc3" value="{{ $UsserHorsr->bloq_horario3 }}" />
                <input type="hidden" class="repeatBloqOneEdit3Time" name="get_horariosc3_time" value="{{ $UsserHorsr->bloq_horario3Time }}" />
              @endif
              @if($UsserHorsr->bloq_horarioMedio1 != '' && $UsserHorsr->bloq_horarioMedio1 != null)
                <input type="hidden" class="repeatBloqOneEditMedio" name="get_horarios_medioc1" value="{{ $UsserHorsr->bloq_horarioMedio1 }}" />
                <input type="hidden" class="repeatBloqOneEdit1TimeMedio" name="get_horariosc1_time_medio" value="{{ $UsserHorsr->bloq_horarioMedio1Time }}" />
              @endif
              @if($UsserHorsr->bloq_horarioMedio2 != '' && $UsserHorsr->bloq_horarioMedio2 != null)
                <input type="hidden" class="repeatBloqOneEdit2Medio" name="get_horarios_medioc2" value="{{ $UsserHorsr->bloq_horarioMedio2 }}" />
                <input type="hidden" class="repeatBloqOneEdit2TimeMedio" name="get_horariosc2_time_medio" value="{{ $UsserHorsr->bloq_horarioMedio2Time }}" />
              @endif
              @if($UsserHorsr->bloq_horarioMedio3 != '' && $UsserHorsr->bloq_horarioMedio3 != null)
                <input type="hidden" class="repeatBloqOneEdit3Medio" name="get_horariosc3_medio" value="{{ $UsserHorsr->bloq_horarioMedio3 }}" />
                <input type="hidden" class="repeatBloqOneEdit3TimeMedio" name="get_horariosc3_time_medio" value="{{ $UsserHorsr->bloq_horarioMedio3Time }}" />
              @endif
            @endforeach
          </div>
        </div>

        {{-- END BLOCK CLOCK --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 submitEditU">
          <input type="submit" value='Aceptar'>
        </div>
            

      </form>
    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog contPusblishDialogo" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12 continPublish">
          <form action="home_submit" method="get" class="sectionPublichUser" accept-charset="utf-8">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <textarea name="" placeholder="Escribe un comentario"></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 bloquesActions">
              <div class="col-md-6 actionpuBlish">
                <div class="col-md-2 Adjuntar">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="">
                </div>
                <div class="col-md-2 AdjuntarFoto">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="">
                </div>
                <div class="col-md-2 DestacarPuslish">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/destacarIco.png" alt="">
                </div>
                <div class="col-md-2 AlertPublish">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/alertIco.png" alt="">
                </div>
              </div>
              <div class="col-md-6 ButtinPublish">
                <input type="submit" value="Enviar"></input>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  
@endsection
