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
         <h3>¡Recuerda que necesitas solicitar tu permiso 5 días antes!</h3>
       </div>
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 permission">
         <h3>Motivo de permiso</h3>
         <form class="formMotivoPermission" action="solicitud-permiso-send" method="post" accept-charset="utf-8">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">  
           <textarea name="descript_solicitud_permiso" placeholder="Describe el permiso" required=""></textarea>
           <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 blockSelectPermission">
             <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4 calendarPermission">
               <h1>Seleccionar fecha</h1>

               <div class="calendarCite" style="overflow:hidden;">
                 <div class="form-group">
                   <div class="row">
                     <div class="col-md-12">
                         <div id="datetimepicker12"></div>
                     </div>
                   </div>
                 </div>            
               </div>

             </div>
             <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 SelecHourPermission">
              <h1>Selecciona  hora</h1>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selecDatTime dayCompletoSelec">
                <a href="#!" >
                  <p>Día completo</p>
                </a>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selecDatTime dayMedioSelec">
                <a href="#!" >
                  <p>Medio día</p>
                </a>
              </div>               
             </div>
             <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4 SelecDescuentPermission">
               <h1>Selecciona el descuento</h1>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selecDatTime SelecVacations">
                 <a href="#!">
                   <p>Vacaciones</p>
                 </a>
                 <input type="hidden">
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selecDatTime selectDIaSeven">
                 <a href="#!">
                   <p>Día Septimo</p>
                 </a>
                 <input type="hidden">
               </div> 
             </div>

             <input type="hidden" name="tiempo_permiso" class="TimePermiso">
             <input type="hidden" name="type_descuento" class="TipeDescuento">
             <input type="hidden" name="id_tipo_solicitud" value="1">
             <input type="hidden" name="fecha_permiso" class="DtaPermiso" >

             <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 SubmitSolicituPermission">
              <input type="submit" value="Enviar solicitud" class="submitPermi">
             </div>
           </div>
         </form>
       </div>

      {{-- MENSAJE SOLICTUD ENVIADA --}}
        @if(Session::has('Create_Solicitud_permiso'))
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 SendSolicitud">
            <h1>¡Solicitud enviada con exito!</h1>
            <h4>Pronto se te notificará tu respuesta</h4>
           </div>
        @endif
       

       
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

{{-- WINDOWS CHAT --}}
@include('usuarios.partials.fields-windows-chat')
@endsection
