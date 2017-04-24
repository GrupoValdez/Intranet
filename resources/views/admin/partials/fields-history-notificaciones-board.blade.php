<div class="captionActivitiesRecientes">
  <div class="notficiActivitie">
    <div class="ui relaxed divided list">
      @foreach($GetActividadesFechas as $activi)
        @if($activi->tipo_actividad == 4)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->descripcion_actividad == 'tienen una nueva')
              <div class="item PublicatiOn">
                <i class="large github middle aligned icoPubli"></i>
                <div class="content">
                  <a data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"><strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong> {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">
                  <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                  <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                  publicación</span></a>
                </div>
              </div>
            @elseif($activi->descripcion_actividad == 'Ha publicado nuevas')
               <div class="item NewFotos">
                  <i class="large github middle aligned icoFotos"></i>
                  <div class="content">
                    <a data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"><strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">fotos</span>
                    <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                    <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                    </a>
                  </div>
               </div>
            @elseif($activi->descripcion_actividad == 'Ha publicado un nuevo')
                <div class="item NewFotos">
                   <i class="large github middle aligned icoDocumn"></i>
                   <div class="content">
                     <a data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"><strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">documento</span>
                     <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                     <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                     </a>
                   </div>
                </div>
            @endif
          @endif
        @endif
        @if($activi->tipo_actividad == 5)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->descripcion_actividad == 'Tiene una publicación')
              <div class="item NewFotos">
                 <i class="large github middle aligned icoUrgente"></i>
                 <div class="content">
                   <a data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"><strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">urgente</span>
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
          @endif
        @endif
        @if($activi->tipo_actividad == 13)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->descripcion_actividad == 'Agrego un nuevo evento')
              <div class="item NewFotos">
                 <i class="large github middle aligned icoCalendar"></i>
                 <div class="content">
                   <a data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/calendario' href="#!" class="header datanotifiNew"><strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} <span class="typeAccionNotifi">al calendario</span>
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
          @endif
        @endif
        @if($activi->tipo_actividad == 10)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->descripcion_actividad == 'actualizó su perfil')
              <div class="item NewFotos">
                 <i class="large github middle aligned icoProFile"></i>
                 <div class="content">
                   <a data-href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/profile-users/{{ $activi->id_usuario}}" href="#!" class="header datanotifiNew"><strong class='nameUserNotifique ' >{{ $activi->nonbre_user}} </strong>  {{ $activi->descripcion_actividad }} 
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
          @endif
        @endif
        @if($activi->tipo_actividad == 14)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->descripcion_actividad == 'Hoy es el cumpleaños de')
              <div class="item NewFotos">
                 <i class="large github middle aligned icoCumple"></i>
                 <div class="content">
                   <a  data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"> {{ $activi->descripcion_actividad }} <strong class="nameUserNotifique ">{{ $activi->nonbre_user}} </strong>
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
          @endif
            
        @endif
        
        {{-- Notificacion de Likes --}}
        @if($activi->tipo_actividad == 11)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->id_usuario == Auth::user()->id)
              <div class="item NewFotos">
                 <i class="large github middle aligned icoLikes"></i>
                 <div class="content">
                   <a  data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew">{{ $activi->descripcion_actividad }} <span class="typeAccionNotifi ">les gusta tu publicación</span> 
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
         @endif
        @endif

        {{-- Notificacion de comentarios --}}
        @if($activi->tipo_actividad == 12)
          <p class="gasper">{{ $idUserLo = Auth::user()->id }}</p>
          <p class="gasper">{{ $idValidaView = false }}</p>
          @foreach(explode(',', $activi->id_users_view) as $userViews) 
            @if($userViews == $idUserLo)
              <p class="gasper"> {{ $idValidaView = true }} </p>
            @endif
          @endforeach
          @if( $idValidaView == false)
            @if($activi->id_usuario == Auth::user()->id)
              <div class="item NewFotos">
                 <i class="large github middle aligned icoComentarios"></i>
                 <div class="content">
                   <a  data-href='http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/preview-conte/data/viewDme/{{ $activi->id_usuario}}/{{ $activi->id_post}}' href="#!" class="header datanotifiNew"> <span class="typeAccionNotifi">{{ $activi->nonbre_user}}</span> {{ $activi->descripcion_actividad }} 
                   <input type="hidden" class="notifiview" name='datanotifi' value="{{  $activi->id }}">
                   <input type="hidden" class="notifiviewUser" name='datanotifi_iduser' value="{{  Auth::user()->id }}">
                   </a>
                 </div>
              </div>
            @endif
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
                         <a  data-href='' class="header"><strong class="nameUserNotifique">{{ $activi->nonbre_user}} </strong>  {{ $eve->descripcion_evento }} </a>
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