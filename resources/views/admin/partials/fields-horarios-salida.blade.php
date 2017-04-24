<p class="gasper">{{ $date = new \Carbon\Carbon($asis->fecha) }}</p>
<p class="gasper">{{ $diaData = $date->format('l') }}</p>
@if($diaData == 'Monday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Lunes')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
              @if(in_array($asis->id, $arrayAdpsCreadas))
                {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
              @else
                 <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
              @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                  
          @endif
        @endif
      @endforeach      
  @endforeach
@endif
{{-- MARTES --}}
@if($diaData == 'Tuesday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Martes')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                  
          @endif
        @endif
      @endforeach      
  @endforeach
@endif
{{-- MIERCOLES --}}
@if($diaData == 'Wednesday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Miercoles')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                 
          @endif
        @endif
      @endforeach      
  @endforeach
@endif
{{-- JUEVES --}}
@if($diaData == 'Thursday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Jueves')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                 
          @endif
        @endif
      @endforeach
  @endforeach
@endif
{{-- VIERNES --}}
@if($diaData == 'Friday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Viernes')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                 
          @endif
        @endif
      @endforeach      
  @endforeach
@endif
{{-- SABADO --}}
@if($diaData == 'Saturday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Sabado')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                 
          @endif
        @endif
      @endforeach      
  @endforeach
@endif
{{-- DOMINGO --}}
@if($diaData == 'Sunday')
  @foreach($UserHorarios['horarios'] as $keyUserHorarios => $valueUserHorarios)
      @foreach(explode(',', $valueUserHorarios['dia']) as $infoDay) 
        @if($infoDay === 'Domingo')
          @if($asis->hora_salida >= $valueUserHorarios['salida'])
            @if($asis->hora_salida < '12:00')
             <h3>{{ $asis->hora_salida }} a.m</h3>
            @else
             <h3>{{ $asis->hora_salida }} p.m</h3>
            @endif
          @else
            @if($asis->hora_salida < '12:00')
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} a.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @else
             <h3 class="horaSalidaAntes">{{ $asis->hora_salida }} p.m</h3>
             @if(in_array($asis->id, $arrayAdpsCreadas))
               {{-- <p class="coloADP cololcaAdp">ADP Colocada</p> --}}
             @else
                <p class="coloADP" data-toggle="modal" data-target="#myModalSolicitudRespuesta{{ $asis->id }}">Colocar ADP</p>
             @endif
             {{-- Modal --}}
             @include('admin.partials.field-modal-option-adp-asistencias')  
            @endif                                 
          @endif
        @endif
      @endforeach      
  @endforeach
@endif