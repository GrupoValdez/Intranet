{{-- HORARIOS DIAS COMPLETOS --}}
@if($bloComplete1 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallDiasCompleto dayCOmpleTop">
    <h3>Horario</h3>
    <h4>Días completos</h4>    

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos bloOONes block1Edit">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloCompleteTime1[0] }}">
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
                     <input type="text" class="form-control" value="{{ $bloCompleteTime1[1] }}">
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
          <p class="gasper">{{ $TotalOneBlock = count($bloComplete1) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b1 = 0; $b1<$TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b1 = 0; $b1< $TotalOneBlock; $b1++) @if($bloComplete1[$b1] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>  

  </div>  
@endif


{{-- HORARIOS DIAS COMPLETOS 2bloque--}}
@if($bloComplete2 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallDiasCompleto dayCOmpleTop">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos bloOONes block2Edit">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloCompleteTime2[0] }}">
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
                     <input type="text" class="form-control" value="{{ $bloCompleteTime2[1] }}">
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
          <p class="gasper">{{ $TotalTwoBlock = count($bloComplete2) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b2 = 0; $b2<$TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b2 = 0; $b2< $TotalTwoBlock; $b2++) @if($bloComplete2[$b2] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>  

  </div>  
@endif


{{-- HORARIOS DIAS COMPLETOS 2bloque--}}
@if($bloComplete3 != '')
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallDiasCompleto dayCOmpleTop">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos bloOONes block3Edit">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
         <div class="form-group">
             <h4>Entrada</h4>
             <div class="clearfix">
                 <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                     <input type="text" class="form-control" value="{{ $bloCompleteTime3[0] }}">
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
                     <input type="text" class="form-control" value="{{ $bloCompleteTime3[1] }}">
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
          <p class="gasper">{{ $TotalThreeBlock = count($bloComplete3) }}</p>
            <h4 class="repetah4">Repetir</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
              <div class='DayForDayEdit domin  @for($b3 = 0; $b3<$TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Domingo') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Domingo">
                d
              </div>                        
              
              <div class='DayForDayEdit lune @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Lunes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Lunes">
                l
              </div>
              <div class='DayForDayEdit marte @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Martes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Martes">
                m
              </div>
              <div class='DayForDayEdit mierco @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Miercoles') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Miercoles">
                m
              </div>
              <div class='DayForDayEdit jueve @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Jueves') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Jueves">
                j
              </div>
              <div class='DayForDayEdit vierne @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Viernes') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Viernes">
                v
              </div>
              <div class='DayForDayEdit saba @for($b3 = 0; $b3< $TotalThreeBlock; $b3++) @if($bloComplete3[$b3] == 'Sabado') DaySelectActiveEdit @endif @endfor' data-time="" data-day="Sabado">
                s
              </div>
            </div>
         </div>                    
       </div> 

    </div>  

  </div>  
@endif

{{-- END HORARIOS DIAS COMPLETOS --}}