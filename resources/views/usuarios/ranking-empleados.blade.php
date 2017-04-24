@extends('layouts.Template-home')

@section('content')
<div class="container continerWithSite containRTanks">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 captionPosteos captionRabkinEmpleados">
        @foreach($JoinTableUserDatosPersonalesDatosEmpleado as $UsersEmpleados)
          @if($UsersEmpleados->id_usuario == $UserMejorRanking['id_user'])
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 profilesRabking">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ProfileFotosStarts">
                 <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$UsersEmpleados->foto.'') }}</p>
                 <div class="label dataPrubeIm dataProfileRankingUser" style="background-image: url('data:{{ $UsersEmpleados->mime }};base64,{{ base64_encode($GetImage) }}')">
                 </div>
                 <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/profile-users/{{ $UsersEmpleados->id_usuario }}">
                   <p class="colorBlack fontMiriamProSemiBold">{{ $UsersEmpleados->nombre }} {{ $UsersEmpleados->apellidos }}</p>
                 </a>
                 
                 {{-- <p class="PuntuancionRanlinkNumber">4.5</p> --}}
                 @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                   @if($UsersEmpleados->id_usuario == $valueRankingGeneral['id_user'])
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
            </div>
          @endif
        @endforeach
        

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 profilesRabking profileMoreUSaer">
          @foreach($JoinTableUserDatosPersonalesDatosEmpleado as $UsersEmpleados)
            @if($UsersEmpleados->id_usuario != $idMejorRanking)
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ProfileFotosStartsMoreUser">
                 <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$UsersEmpleados->foto.'') }}</p>
                 <div class="label dataPrubeIm dataProfileRankingUser ranINDDS" style="background-image: url('data:{{ $UsersEmpleados->mime }};base64,{{ base64_encode($GetImage) }}')">
                 </div>
                 <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/profile-users/{{ $UsersEmpleados->id_usuario }}">
                  <p class="colorBlack fontMiriamProSemiBold">{{ $UsersEmpleados->nombre }} {{ $UsersEmpleados->apellidos }}</p>
                </a>
                 @foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) 
                  @if($UsersEmpleados->id_usuario == $valueRankingGeneral['id_user'])
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

      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 captionRecordNotas captionRanKingDats">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bloqueRecordatorios SuirRanking">
          <h1>¿Cómo puedes </br> subir de ranking?</h1>
          <ul>
              <li>Debes procurar seguir el reglamento de Grupo Valdez, para mayor infomración lee el el Manual de empleado y politicas de la empresa</li>
              <li>Ser proactivo y propósitivo en tu trabajo</li>
          </ul>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 Manuales">
            <a href="">
              <p>Ver Manual de Empleado</p>
            </a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 Manuales PoliTi">
            <a href="">
              <p>Ver políticas de la empresa</p>
            </a>
          </div>
          <h2>¡Los mejores empleados </br> recibiran excelentes regalos! </h2>
        </div>

        {{-- BLOQUE CALENDAR --}}
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 listConection liconnectRankin">
          <div class="col-xs-12 col-sm-12 col-md-12 backReturn">
            <a href="home">
              <p>Regresar a Board de trabajo</p>
            </a>
          </div>
        {{-- CAPTION USER LIVES --}}
          @include('usuarios.partials.fields-user-online')

        {{--ALL USERS --}}
          @include('usuarios.partials.fields-users-all-chat')

          {{-- ACTIVIDADES RECIENTES --}}
          @include('usuarios.partials.fields-actividades-recientes')

          {{-- SOLICITUD DE PERMISO --}}
          <div class="col-xs-12 col-sm-12 col-md-12 LinksForEmpleados ForEmpleadoRnakin">
            <ul>
                <li>
                  <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/pdf/Manual-de-empleado.pdf">
                   Manual de empleado
                  </a>
                </li>
                <li>
                  <a href="#!">
                   Reglamento institucional
                  </a>
                </li>
                <li>
                  <a href="#!">
                   Ayuda
                  </a>
                </li>
            </ul>
          </div>

          {{-- <div class="captionGaleriFotos">
            <h3 class="fontMiriamProSemiBold">Galería de fotos</h3>
            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/galeriFotos.jpg" alt="">
            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/galeriFotos.jpg" alt="">
          </div> --}}

        </div>
        
      </div>
    </div>

     <div class="col-md-12 datPublich">
       <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/IcoPublich.png" alt="" data-toggle="modal" data-target="#myModal">
     </div>

    </div>

    @include('usuarios.partials.field-public-post')
</div>

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>
{{-- Mensajes entrada salida --}}
@include('usuarios.partials.fields-entrada-salida-mensajes')

{{-- WINDOWS CHAT --}}
@include('usuarios.partials.fields-windows-chat')
@endsection
