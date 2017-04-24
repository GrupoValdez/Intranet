@extends('layouts.Template-home')

@section('content')
<div class="container continerWithSite">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionPosteos captionProfiles">
        {{-- Manuales DE PERMISO --}}
        <div class="col-xs-12 col-sm-12 col-md-12 LinksForEmpleados manualitiEvaluation">
          <ul>
              <li>
                <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/pdf/Manual-de-empleado.pdf" target="_blank">
                 Manual de empleado
                </a>
              </li>
              <li>
                <a href="">
                 Reglamento institucional
                </a>
              </li>
              <li>
                <a href="">
                 Ayuda
                </a>
              </li>
          </ul>
        </div>
      </div>

     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 sectionProfiles sectionPermissionRequest sectionEvalutionToPersonal">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 EvaluationPersonal">
          @foreach($UsersLogiado as $logiado)
            @if(count($encargadoArea)>0)
              <h3>Encargado de área: <span> {{ $logiado->nombre }} {{ $logiado->apellidos }} </span> </h3>
            @endif          
          @endforeach
          <h3>Evaluar a:</h3>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ProfileFotosStarts">
            @foreach($encargadoArea as $encargados)
               @foreach($JoinTableUserDatas as $users)
                 @if($users->jefe_inmediato == $encargados->id_encargardo)
                   <p class="gasper"> {{ $validaIdUser = '' }} </p>
                   @foreach($HistorialEvaluaciones as $evaluaciones)
                     @if($evaluaciones->id_usuario == $users->id_usuario) 
                       <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                       <p class="gasper">{{ $MesActual = $carbon->now()->format('m') }}</p>
                       @if($evaluaciones->proxima_evaluacion > $MesActual)
                         @if($evaluaciones->mes_evaluacion == $MesActual)
                           <p class="gasper"> {{ $validaIdUser = $users->id_usuario }} </p>
                           <a href="evaluacion-a-personal/{{ $encargados->id_encargardo }}/{{$users->id_usuario}}" class="UserYarealizo">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                              <div class="label dataPrubeIm dataProfileEvaluaciones" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $users->foto }}')"></div>
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
                           </a>
                         @endif
                       @endif
                       
                     @endif
                   @endforeach
                   @if($validaIdUser != $users->id_usuario)
                     <a href="evaluacion-a-personal/{{ $encargados->id_encargardo }}/{{$users->id_usuario}}">
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="label dataPrubeIm dataProfileEvaluaciones" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $users->foto }}')"></div>
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
                     </a>
                   @endif
                 @endif
               @endforeach
            @endforeach
                         
          </div>
       </div>
     </div>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionRecordNotas SecCalendar">
         <div class="col-xs-12 col-sm-12 col-md-12 imagEvaluition">
          <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/IcoPublich.png" alt="" data-toggle="modal" data-target="#myModal">
         </div>
      </div>
    </div>
      @include('usuarios.partials.field-public-post')

    </div>

</div>

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>
{{-- Mensajes entrada salida --}}
@include('usuarios.partials.fields-entrada-salida-mensajes')

{{-- WINDOWS CHAT --}}
@include('usuarios.partials.fields-windows-chat')
@endsection
