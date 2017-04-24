@extends('layouts.Template-home')

@section('content')
<div class="container continerWithSite">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionPosteos captionProfiles">

        {{-- CAPTION USER LIVES --}}        
        @include('usuarios.partials.fields-users-all-chat')
        
        {{-- SOLICITUD EN PROCESO --}}
        @include('usuarios.partials.fields-solicitud-proceso')        

        {{-- HORARRIOS DE USURIOS --}}
        @include('usuarios.partials.fields-horarios')
        
        {{-- BUZON DE SUGERENCIAS , EMERGENCIAS Y SOLICITUDES--}}
        @include('usuarios.partials.fields-accione-permisos-sugerencias-andmore')
        
        {{-- Dias disponibles --}}
        @include('usuarios.partials.fields-day-vacaciones-users')
        

        {{-- Manuales --}}
        @include('usuarios.partials.fields-manuales')
        
        
     </div>

     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 sectionProfiles sectionPermissionRequest">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 remenber">
         <h3>¡Detalles de tu procesos de solicitudes!</h3>
       </div>
       @if(Session::has('Create_Comentario'))
         <p class="alert alert-success">{{Session::get('Create_Comentario')}}</p>
       @endif

       {{-- SOLICITUDES DE PERMISOS --}}
       @include('usuarios.partials.fields-ticket-solicitud-permiso')       

       {{-- SOLICITUDES DE EMERGENCIAS --}}
       @include('usuarios.partials.fields-ticket-solicitud-emergencias')

       {{-- SOLICITUDES DE SUGERENCIAS --}}
       @include('usuarios.partials.fields-ticket-solicitud-sugerencias')
       
       

     </div>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 captionRecordNotas SecCalendar">

        {{-- BLOQUE CALENDAR --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
          {{-- SECTION CALENDAR AND ADD EVENT CALENDAR --}}
          @include('usuarios.partials.fields-lateral-calendar')


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

{{-- WINDOWS CHAT --}}
@include('usuarios.partials.fields-windows-chat')
@endsection
