@extends('layouts.Template-home')

@section('content')
<div class="container continerWithSite containBloquePro">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionPosteos captionProfiles">
        @foreach($JoinTableUserDatas as $dataUsers)
           @if($dataUsers->id_usuario == Auth::user()->id)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionProfileMy">
              <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$dataUsers->foto.'') }}</p>
              <div class="containerPhotoProfile" style="background-image: url('data:{{ $dataUsers->mime }};base64,{{ base64_encode($GetImage) }}')">
              </div>
              <p class="colorBlack fontMiriamProSemiBold">{{ $dataUsers->nombre }} {{ $dataUsers->apellidos }}</p>
              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/home" class="returnBoard">
                <p>Regresar a Board de trabajo</p>
              </a>
            </div>
           @endif
        @endforeach

        {{-- CAPTION USER LIVES --}}
        @include('usuarios.partials.fields-users-all-chat')
        
        {{-- HORARRIOS DE USURIOS --}}
        @include('usuarios.partials.fields-horarios-other-user')

        {{-- Manuales --}}
        @include('usuarios.partials.fields-manuales')

     </div>

     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 sectionProfiles">

        @foreach($JoinTableUserDatas as $dataUsers)
         @if($dataUsers->id_usuario == $idUserLogin)
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ProfileFotosStarts">
             <div class="containerPhotoProfile" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUsers->foto }}')">
             </div>
             <p class="colorBlack fontMiriamProSemiBold">{{ $dataUsers->nombre }} {{ $dataUsers->apellidos }}</p>
             @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
               @if($dataUsers->id_usuario == $valueRankingGeneral['id_user'])
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
            {{-- Information empleado --}}
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 InformacionEmpleado">
            <form action="profile_submit" method="get" class="profile_userEdit" accept-charset="utf-8">
               <input type="hidden" name="id_user_update" value="{{ $idUserLogin }}">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataEmpleados">
                {{-- ONE COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Departamento</p>
                    <input class="detallInformation dtaYesEdit" name="update_departament" type="text" value="{{ $dataUsers->area_departamento }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Cargo</p>
                    <input class="detallInformation" type="text" value="{{ $dataUsers->cargo }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Jefe inmediato</p>
                   @foreach($getUsers as $DataUsers)
                     @if($dataUsers->jefe_inmediato == $DataUsers->id_usuario)
                       <input class="detallInformation" type="text" name="" value="{{ $DataUsers->name }} {{ $DataUsers->apellidos }}" disabled="disabled">
                     @endif
                   @endforeach
                    
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">ADP</p>
                    <input class="detallInformation" type="text" value="Ninguno" disabled="disabled">
                  </div>
                </div>

                {{-- Two COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Género</p>
                    <input class="detallInformation dtaYesEdit" name="update_genero" type="text" value="{{ $dataUsers->genero }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Estado Civil</p>
                    <input class="detallInformation dtaYesEdit" name="update_estado_civil" type="text" value="{{ $dataUsers->estado_civil }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Dirección</p>
                    <input class="detallInformation dtaYesEdit" name="update_direccion" type="text" value="{{ $dataUsers->direccion }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Correo</p>
                    <input class="detallInformation" type="text" value="{{ $dataUsers->correo_corporativo }}" disabled="disabled">
                  </div>
                </div>

                {{-- Three COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Cumpleaños</p>
                    <input class="detallInformation dtaYesEdit" name="update_cumple" type="text" value="{{ $dataUsers->cumpleanos }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Número de celular</p>
                    <input class="detallInformation dtaYesEdit" name="update_cel" type="text" value="{{ $dataUsers->celular }}" disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Extención</p>
                    <input class="detallInformation dtaYesEdit" name="update_ext" type="text" value="{{ $dataUsers->extencion }}" disabled="disabled">
                  </div>

                </div>

              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataEmpleados TwoSection">
                {{-- ONE COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Técnico</p>
                    <input class="detallInformation dtaYesEdit" name="update_tecnico" type="text" value="@if($dataUsers->tecnico != '') {{ $dataUsers->tecnico }} @else -- @endif " disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Posgrado</p>
                    <input class="detallInformation dtaYesEdit" name="update_posgrado" type="text" value="@if($dataUsers->postgrado != '') {{ $dataUsers->postgrado }} @else -- @endif " disabled="disabled">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Diplomado</p>
                    <input class="detallInformation dtaYesEdit" name="update_diplomado" type="text" value="@if($dataUsers->diplomado != '') {{ $dataUsers->diplomado }} @else -- @endif " disabled="disabled">
                  </div>

                </div>

                {{-- Two COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Habilidades</p>
                    <input class="detallInformation dtaYesEdit" name="update_hibilidades" type="text" value="{{ $dataUsers->habilidades }}" disabled="disabled">
                  </div>

                </div>

                {{-- Three COLUMN --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ColumnsData">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ColumnsDataText">
                    <p class="titleInformation">Otros conocimientos</p>
                    <input class="detallInformation dtaYesEdit" name="update_other_conocimientos" type="text" value="@if($dataUsers->postgrado != '') {{ $dataUsers->other_conocimiento }} @else -- @endif " disabled="disabled">
                  </div>

                </div>

              </div>
            </form>
              
           </div>
         @endif
        @endforeach

       {{-- EVENTOS COMPARTIDOS --}}
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataEventos">
        <h3>Eventos compartidos</h3>
       </div>
       <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 captionPosteos captionPostesOfUser">
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             @foreach($DataArrayPostImpar as $dataArrPostImpar => $PostImpar)
               @if($PostImpar['id_usuario'] == $idUserLogin)
                 @if($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['imagen'] != '')
                   @include('usuarios.partials.posts.fields-tipo-posnormal-impar')

                 @elseif($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['documentos'] != '')
                    @include('usuarios.partials.posts.fields-tipo-posnormal-impar-with-document-impar')

                 @elseif($PostImpar['id_tipo_publicacion'] == 1 or $PostImpar['id_tipo_publicacion'] == 2 && $PostImpar['imagen'] == '' && $PostImpar['documentos'] == '')
                 @include('usuarios.partials.posts.fields-tipo-posnormal-impar-with-document-imagen-impar')

                 {{-- Si el post es tipo vacaciones --}}
                 @elseif($PostImpar['id_tipo_publicacion'] == 4)
                   @include('usuarios.partials.posts.fields-tipo-vacaciones-impar')
                   
                   {{-- Si el post es tipo EVENTO --}}
                   @elseif($PostImpar['id_tipo_publicacion'] == 6)
                     @include('usuarios.partials.posts.fields-tipo-Eventos-IMPAR')

                 @elseif($PostImpar['id_tipo_publicacion'] == 5)
                   @include('usuarios.partials.posts.fields-tipo-cumple-impar')
                   
                 @endif
               @endif
               
             @endforeach
           </div>

           {{-- BLOQUE LATERAL --}}
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

             @foreach($DataArrayPostPar as $dataArrPostPar => $PostPar)
              @if($PostPar['id_usuario'] == $idUserLogin)
                 @if($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['imagen'] != '')
                   @elseif($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['documentos'] != '')
                     @include('usuarios.partials.posts.fields-tipo-posnormal-par-with-document-PAR')

                   @elseif($PostPar['id_tipo_publicacion'] == 1 or $PostPar['id_tipo_publicacion'] == 2 && $PostPar['imagen'] == '' && $PostPar['documentos'] == '')
                    @include('usuarios.partials.posts.fields-tipo-posnormal-par-with-document-imagen-PAR')

                    {{-- Si el post es tipo vacaciones --}}
                    @elseif($PostPar['id_tipo_publicacion'] == 4)
                      @include('usuarios.partials.posts.fields-tipo-vacaciones-PAR')

                    {{-- Si el post es tipo EVENTO --}}
                    @elseif($PostPar['id_tipo_publicacion'] == 6)
                      @include('usuarios.partials.posts.fields-tipo-Eventos-PAR')

                    @elseif($PostPar['id_tipo_publicacion'] == 5)
                      @include('usuarios.partials.posts.fields-tipo-cumple-PAR')
                   
                 @endif
               @endif
             @endforeach
         </div>
       </div>
     </div>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionRecordNotas SecCalendar">

        {{-- BLOQUE CALENDAR --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          {{-- SECTION CALENDAR AND ADD EVENT CALENDAR --}}
          @include('usuarios.partials.fields-lateral-calendar')
          
          {{-- GALERIA DE FOTOS --}}
          @include('usuarios.partials.fields-galeria-fotos-user')

        </div>
        
      </div>
    </div>

     <div class="col-md-12 datPublich">
       <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/IcoPublich.png" alt="" data-toggle="modal" data-target="#myModal">
     </div>

    </div>

    <!-- Modal -->
    @include('usuarios.partials.field-public-post')
</div>

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>
{{-- Mensajes entrada salida --}}
@include('usuarios.partials.fields-entrada-salida-mensajes')

{{-- WINDOWS CHAT --}}
@include('usuarios.partials.fields-windows-chat')
@endsection
