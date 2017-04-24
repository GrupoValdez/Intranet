@extends('layouts.Template-home')

@section('content')
<div class="container continerWithSite">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionPosteos captionProfiles">
        {{-- Manuales DE PERMISO --}}
        <div class="col-xs-12 col-sm-12 col-md-12 LinksForEmpleados manualitiEvaluation evaluationEwstionMa">
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
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 EvaluationPersonal evaluationDetallQuestion">
         {{-- ALL AREAS detall --}}
         @foreach($EncargadosOfAreas as $encargado)
           @foreach($UsersAlls as $users)
             @if($encargado->id_encargardo == $users->id_usuario)
               <h3>Encargado de área: <span> {{ $users->nombre }} {{ $users->apellidos }} </span> </h3>
             @endif
           @endforeach  
         @endforeach
          
        @foreach($UsersEvaluacion as $UserEvalua)
          <form action="../../send_evaluacion" method="post" accept-charset="utf-8" class="formEvaliuacion">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
            <input type="hidden" name="_idencargado" value="{{ $idEncargado }}">  
            <input type="hidden" name="_iduser" value="{{ $idUserEvaluacion }}">  

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ProfileFotosStarts profilesForDetall">
              <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 detallImgProfile">
                <div class="label dataPrubeIm dataProfileEvaluacionesDetallUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $UserEvalua->foto }}')"></div>        
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

              @include('usuarios.partials.preguntas-evaluacion') 

            </div>

          </form>
        @endforeach
          
       </div>
     </div>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionRecordNotas SecCalendar">
         <div class="col-xs-12 col-sm-12 col-md-12 imagEvaluition ">
          <img class="img-responsive evaluationEwstionMa" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/IcoPublich.png" alt="" data-toggle="modal" data-target="#myModal">
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
