<p class="gasper">{{ $totalNotifciaciones = 0}}</p>
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
      <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
      <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
     <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
      <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
      <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
        <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
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
        <p class="gasper">{{ $totalNotifciaciones = $totalNotifciaciones+1 }}</p>
      @endif
    @endif
  @endif

@endforeach

<p>{{$totalNotifciaciones}}</p>