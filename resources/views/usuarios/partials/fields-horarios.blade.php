<div class="col-xs-12 col-sm-12 col-md-12 HorariosUser">
  <div class="col-xs-12 col-sm-12 col-md-12 sectionHorarios">
    <p id='titleHorrarios' @if($Bguser != '') style="background: {{ $Bguser }} !important; @endif">Horarios</p>
    @foreach($HorariosUser as $DataHorarios)
      @if($DataHorarios->id_usuario == Auth::user()->id)
         @if($DataHorarios->bloq_horario1 != null)
          <div class="col-xs-12 col-sm-12 col-md-12 dtsss">
            <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horario1 }}</p>
            <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horario1Time}}</p>
          </div>
         @endif
         @if($DataHorarios->bloq_horario2 != null)
          <div class="col-xs-12 col-sm-12 col-md-12">
           <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horario2 }}</p>
           <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horario2Time}}</p>
          </div>
        @endif
        @if($DataHorarios->bloq_horario3 != null)
          <div class="col-xs-12 col-sm-12 col-md-12">
            <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horario3 }}</p>
            <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horario3Time}}</p>
          </div>
        @endif
        @if($DataHorarios->bloq_horarioMedio1 != null)
          <div class="col-xs-12 col-sm-12 col-md-12">
            <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horarioMedio1 }}</p>
            <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horarioMedio1Time}}</p>
          </div>
        @endif
        @if($DataHorarios->bloq_horarioMedio2 != null)
          <div class="col-xs-12 col-sm-12 col-md-12">
            <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horarioMedio2 }}</p>
            <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horarioMedio2Time}}</p>
          </div>
        @endif
        @if($DataHorarios->bloq_horarioMedio3 != null)
          <div class="col-xs-12 col-sm-12 col-md-12">
            <p class="ListDays fontMiriamProSemiBold">{{ $DataHorarios->bloq_horarioMedio3 }}</p>
            <p class="ListHours fontMiriamProRegular">{{ $DataHorarios->bloq_horarioMedio3Time}}</p>
          </div>
        @endif
                     
      @endif              
    @endforeach

    <div class="col-xs-12 col-sm-12 col-md-12">
      <p class="ListDays fontMiriamProSemiBold">Días de descanso</p>
      @foreach($arrayDaysDescansoUser as $descanso)
        <p class="gasper">{{ $descansosCan = count($descanso) }}</p>
        @for($des = 0; $des<$descansosCan; $des++)
         <p class="ListHours fontMiriamProRegular DayDescans">{{ $descanso[$des] }}</p>
        @endfor
      @endforeach    
    </div>  
  </div>          
</div>