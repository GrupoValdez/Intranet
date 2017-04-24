
{{-- MEDIOS DIAS --}}


  {{-- PRIMER BLOQUE MEDIO DIA --}}
@if($bloMedio1 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallMedioDia">
    <h4>Medio día</h4>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio1Edit">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime1[0] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>              
      </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
         <div class="form-group">
             <h4>Salida</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime1[1] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>
      </div> 

      <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>


      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
        <div class="form-group formSelectDays formseledDiasCOmple">
          <p class="gasper">{{ $TotalOneBlockMedio = count($bloMedio1) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b1m = 0; $b1m<$TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b1m = 0; $b1m< $TotalOneBlockMedio; $b1m++) @if($bloMedio1[$b1m] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>
       
  </div> 
@endif

{{-- 2 BLOQUE --}}

@if($bloMedio2 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallMedioDia">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio2Edit ">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime2[0] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>              
      </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
         <div class="form-group">
             <h4>Salida</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime2[1] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>
      </div> 

      <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>


      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
        <div class="form-group formSelectDays formseledDiasCOmple">
          <p class="gasper">{{ $TotalTwoBlockMedio = count($bloMedio2) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b2m = 0; $b2m<$TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b2m = 0; $b2m< $TotalTwoBlockMedio; $b2m++) @if($bloMedio2[$b2m] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>
       
  </div> 
@endif


{{-- 3 BLOQUE --}}

@if($bloMedio3 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallMedioDia">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio3Edit">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime3[0] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>              
      </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
         <div class="form-group">
             <h4>Salida</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloMedioTime3[1] }}">
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                     </span>
                 </div>
             </div>
         </div>
      </div> 

      <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>


      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
        <div class="form-group formSelectDays formseledDiasCOmple">
          <p class="gasper">{{ $TotalThreeBlockMedio = count($bloMedio3) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b3m = 0; $b3m<$TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b3m = 0; $b3m< $TotalThreeBlockMedio; $b3m++) @if($bloMedio3[$b3m] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>
       
  </div> 
@endif