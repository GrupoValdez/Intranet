<div class="captionActivitiesRecientes captionReciennoneMobi">
  <h3 class="fontMiriamProSemiBold">Actividades recientes</h3>
  <div class="notficiActivitie">
    <div class="ui relaxed divided list">
      @foreach($Activities as $activi)
        @if($activi->tipo_actividad == 4)
          @if($activi->descripcion_actividad == 'tienen una nueva')
            <div class="item PublicatiOn">
              <i class="large github middle aligned icoPubli"></i>
              <div class="content">
                <a href="preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong> {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">
                publicación</span></a>
              </div>
            </div>
          @elseif($activi->descripcion_actividad == 'Ha publicado nuevas')
             <div class="item NewFotos">
                <i class="large github middle aligned icoFotos"></i>
                <div class="content">
                  <a href="preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">fotos</span></a>
                </div>
             </div>
          @elseif($activi->descripcion_actividad == 'Ha publicado un nuevo')
              <div class="item NewFotos">
                 <i class="large github middle aligned icoDocumn"></i>
                 <div class="content">
                   <a href="preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">documento</span></a>
                 </div>
              </div>
          @endif
        @endif
        @if($activi->tipo_actividad == 5)
          @if($activi->descripcion_actividad == 'Tiene una publicación')
            <div class="item NewFotos">
               <i class="large github middle aligned icoUrgente"></i>
               <div class="content">
                 <a href="preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">urgente</span></a>
               </div>
            </div>
          @endif
        @endif
        @if($activi->tipo_actividad == 13)
          @if($activi->descripcion_actividad == 'Agrego un nuevo evento')
            <div class="item NewFotos">
               <i class="large github middle aligned icoCalendar"></i>
               <div class="content">
                 <a href="calendario" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">al calendario</span></a>
               </div>
            </div>
          @endif
        @endif
        @if($activi->tipo_actividad == 10)
          @if($activi->descripcion_actividad == 'actualizó su perfil')
            <div class="item NewFotos">
               <i class="large github middle aligned icoProFile"></i>
               <div class="content">
                 <a href="profile-users/{{ $activi->id_usuario}}" class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} </a>
               </div>
            </div>
          @endif
        @endif
        <!-- @if($activi->tipo_actividad == 1)
          @if($activi->descripcion_actividad == 'evento')
            @foreach($AllPost as $post)
              @if($post->id == $activi->id_post)
                @foreach($NotifisEventos as $eve)
                  @if($post->id_tipo_evento == $eve->id)
                    <div class="item NewFotos">
                       <i class="large github middle aligned icoNotifiEvent"></i>
                       <div class="content">
                         <a class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $eve->descripcion_evento }} </a>
                       </div>
                    </div>
                  @endif
                @endforeach
              @endif
            @endforeach
          @endif
        @endif -->
      @endforeach

      {{-- <div class="item ActivitiPago">
        <i class="large github middle aligned icoPagos"></i>
        <div class="content">
          <a class="header">¡Se ha realizado el pago a las 7:00 P.M.!</a>
        </div>
      </div> --}}
    </div>
  </div>
</div>